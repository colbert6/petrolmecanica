# Flujo de `Ventas::anular()`

Documenta el proceso completo que ocurre al anular una venta existente, desde la recepción del GET hasta la respuesta JSON al cliente.

> **Diferencia clave con `save()`:** No existe un flag de activación CPE. El envío de baja electrónica **siempre** se intenta. Además, los datos para la baja dependen del `external_id` generado durante el envío original del comprobante.

---

## Diagrama general

```
GET /ventas/anular?idventa=X
        │
        ▼
┌───────────────────────┐
│ Verificar estado      │  ← Venta::venta_byId()
│ venta == 'vigente'?   │
└────────┬──────────────┘
         │ no vigente ──────────────────────► JSON error (sin transacción)
         │ vigente
         ▼
┌───────────────────────┐
│  Transacción BD        │  ← trans_start()
│  ┌──────────────────┐  │
│  │ devolver stock   │  │  ← Stock::devolver_stock()
│  │ kardex entrada   │  │  ← Kardex::insert_devolucion_kardex()
│  │ anular venta     │  │  ← Venta::anular_venta()
│  │ anular detalle   │  │  ← Det_venta::anular_det_venta()
│  └──────────────────┘  │
└────────┬───────────────┘
         │ error BD ────────────────────────► trans_rollback() ──► JSON error
         │ ok
         ▼
enviar_comprobante_proveedor_cpe("generar_anulacion", $idventa)
         │
┌────────┴────────┐
│ preparar_datos  │  ← Venta::cpe_venta_anulacion()
│ _cpe()          │  (lee external_id de la tabla venta)
└────────┬────────┘
         │
┌────────┴────────┐
│ FacturaloPeru   │  ← HTTP POST → nubox360 /api/voided
│ builder_cpe()   │
└────────┬────────┘
         │
┌────────┴──────────┐
│ guardar_resultado │  ← Envio_cpe::set_envio()
│ _cpe()            │  ← Envio_cpe::update_envio_cpe() → venta.envio_cpe_baja = 1
└────────┬──────────┘
         │ (NO descarga archivos en anulación)
         │
    trans_commit()
         │
    JSON: VENTA ANULADA
```

---

## Paso a paso

### 1. Recibir el ID de venta

```php
$return  = array('estado' => false, 'msj' => '', 'error' => '');
$idventa = $this->input->get('idventa');

$this->load->model('venta');
$this->load->model('stock');
$this->load->model('kardex');
$this->load->model('det_venta');
```

El `idventa` llega por **query string GET** (a diferencia de `save()` que usa POST). No hay validación de formato; si el valor es inválido, la consulta del paso 2 simplemente devuelve vacío.

Los cuatro modelos se cargan juntos al inicio, antes de cualquier lógica. El array `$return` ya no incluye `idsave` ni `enlace` — esos campos son exclusivos de `save()` y nunca se asignaban aquí.

---

### 2. Verificar que la venta esté vigente

```php
$this->load->model('venta');
$venta = $this->venta->venta_byId($idventa);

if ($venta['estado'] == 'vigente') { ... }
```

**Modelo:** `Venta::venta_byId()`  
**Tabla:** `venta` + JOINs: `tienda`, `tipo_comprobante`, `colaborador`

Si el estado no es `'vigente'` (por ejemplo, ya fue anulada), se retorna JSON de error **sin abrir transacción**. Esto evita dobles anulaciones.

---

### 3. Inicio de transacción y devolución de stock

```php
$this->db->trans_start();
$this->stock->devolver_stock('venta anulada', $idventa);
```

**Modelo:** `Stock::devolver_stock()`  
**Tablas:** `detalle_venta` (SELECT), `stock` (UPDATE)

A diferencia de `save()`, aquí **no** se usan arrays del POST. El modelo consulta la BD directamente:

1. Obtiene todos los ítems activos en `detalle_venta` donde `venta_idventa = $idventa`.
2. Por cada ítem ejecuta: `stock_almacen = stock_almacen + cantidad` para la tienda correspondiente.

---

### 4. Registrar devolución en kardex

```php
$this->kardex->insert_devolucion_kardex('venta', $idventa);
```

**Modelo:** `Kardex::insert_devolucion_kardex()`  
**Tablas:** `detalle_venta` (SELECT), `producto` (SELECT), `stock` (SELECT), `kardex` (INSERT)

Inserta un movimiento de tipo **entrada** con motivo `'venta anulada'` por cada ítem del detalle. Registra el stock actual al momento del movimiento.

Comparación con el kardex de venta normal:

| Aspecto           | `save()` → `insert_kardex()`         | `anular()` → `insert_devolucion_kardex()` |
|-------------------|---------------------------------------|-------------------------------------------|
| Fuente de datos   | Arrays del POST                       | Consulta BD por `idventa`                 |
| Tipo movimiento   | `'salida'`                            | `'entrada'`                               |
| Motivo            | `'venta'`                             | `'venta anulada'`                         |

---

### 5. Cambiar estado de la venta a anulado

```php
$this->venta->anular_venta($idventa);
```

**Modelo:** `Venta::anular_venta()`  
**Tabla:** `venta`

Ejecuta: `UPDATE venta SET estado = 'anulado' WHERE idventa = ?`

---

### 6. Inactivar el detalle de venta

```php
$this->det_venta->anular_det_venta($idventa);
```

**Modelo:** `Det_venta::anular_det_venta()`  
**Tabla:** `detalle_venta`

Ejecuta: `UPDATE detalle_venta SET estado = 'Inactivo' WHERE venta_idventa = ?`

---

### 7. Verificar estado de la transacción

```php
if ($this->db->trans_status() === FALSE) {
    $this->db->trans_rollback();
    // retorna JSON error
}
```

Si cualquiera de los pasos 3–6 falló a nivel de BD se hace rollback inmediato. No se intenta el envío CPE.

---

### 8. Envío de baja CPE (siempre se ejecuta si la BD fue exitosa)

```php
$result_envio_cpe = $this->enviar_comprobante_proveedor_cpe("generar_anulacion", $idventa);
```

A diferencia de `save()`, **no hay flag** que pueda saltarse este paso. Si la BD fue bien, el envío CPE siempre se intenta.

Se delega a los mismos métodos privados pero con datos diferentes:

#### `preparar_datos_cpe("generar_anulacion", $idventa, $envio_cpe_fp)`

```php
$data_venta = $this->venta->cpe_venta_anulacion($idventa);
return $envio_cpe_fp->formatear_anulacion_venta_estructura($data_venta, $idventa);
```

**Modelo:** `Venta::cpe_venta_anulacion()`  
**Tabla:** `venta` + JOIN `tipo_comprobante`

Campos que devuelve la consulta:

| Campo SQL             | Descripción                                           |
|-----------------------|-------------------------------------------------------|
| `external_id`         | ID del comprobante en nubox360, guardado al emitir    |
| `fecha_emision`       | Fecha de la venta original                            |
| `motivo_anulacion`    | Hardcodeado: `"ERROR EN EL PEDIDO"`                   |

> **Dependencia crítica:** el campo `external_id` de la tabla `venta` **debe existir** (fue guardado por `Envio_cpe::update_envio_cpe()` durante el `save()`). Si la venta nunca tuvo un envío CPE exitoso, este campo estará vacío y la baja será rechazada por la API.

El JSON resultante tiene esta estructura:

```json
{
  "fecha_de_emision_de_documentos": "2024-03-15",
  "documentos": [
    {
      "external_id": "abc-123-xyz",
      "motivo_anulacion": "ERROR EN EL PEDIDO"
    }
  ]
}
```

#### `FacturaloPeru::builder_cpe($data_json, "generar_anulacion")`

Apunta a un endpoint diferente al de emisión:

| `tipo_envio`          | Endpoint                                         |
|-----------------------|--------------------------------------------------|
| `generar_comprobante` | `https://petrolmecanica.nubox360.com/api/documents` |
| `generar_anulacion`   | `https://petrolmecanica.nubox360.com/api/voided`    |

#### `guardar_resultado_cpe($data_json, $result, $idventa, "generar_anulacion")`

| Llamada                              | Efecto en BD                                              |
|--------------------------------------|-----------------------------------------------------------|
| `Envio_cpe::set_envio()`             | INSERT en `envio_electronico` con tipo `generar_anulacion` |
| `Envio_cpe::update_envio_cpe()`      | UPDATE `venta SET envio_cpe_baja = 1` (no guarda `external_id`) |

> **No se descargan archivos.** El bloque `descargar_archivos_sunat()` solo se ejecuta cuando `tipo_envio === 'generar_comprobante'`. La baja no genera XML/ZIP descargable.

---

### 9. Commit o rollback final

| Condición                                          | Resultado                   |
|----------------------------------------------------|-----------------------------|
| CPE responde `'ok'` y `trans_status !== false`     | `trans_commit()` → éxito    |
| CPE falla (curl o API) o BD deteriorada            | `trans_rollback()` → error  |

---

## Tablas de BD involucradas

| Tabla               | Operación | Responsable                          |
|---------------------|-----------|--------------------------------------|
| `venta`             | SELECT    | `Venta::venta_byId()` (verificar estado) |
| `detalle_venta`     | SELECT    | `Stock::devolver_stock()` y `Kardex::insert_devolucion_kardex()` |
| `stock`             | UPDATE    | `Stock::devolver_stock()`            |
| `producto`          | SELECT    | `Kardex::insert_devolucion_kardex()` |
| `kardex`            | INSERT    | `Kardex::insert_devolucion_kardex()` |
| `venta`             | UPDATE    | `Venta::anular_venta()` (`estado = 'anulado'`) |
| `detalle_venta`     | UPDATE    | `Det_venta::anular_det_venta()` (`estado = 'Inactivo'`) |
| `venta`             | SELECT    | `Venta::cpe_venta_anulacion()` (leer `external_id`) |
| `envio_electronico` | INSERT    | `Envio_cpe::set_envio()`             |
| `venta`             | UPDATE    | `Envio_cpe::update_envio_cpe()` (`envio_cpe_baja = 1`) |

---

## Escenarios de error y rollback

```
Venta no vigente (ya anulada u otro estado)
    └── Retorna JSON error SIN abrir transacción

Error BD en pasos 3–6
    └── trans_rollback() → retorna "ERROR: Operaciones de Base de Datos"

external_id vacío (venta emitida sin CPE exitoso)
    └── La API nubox360 rechaza la baja → trans_rollback() → error de proveedor

Error curl en FacturaloPeru::send_cpe()
    └── trans_rollback() → retorna "Error en respuesta curl"

Respuesta 'success: false' de la API nubox360
    └── trans_rollback() → retorna "Error en respuesta de proveedor"
```

---

## Comparativa `save()` vs `anular()`

| Aspecto                       | `save()`                              | `anular()`                            |
|-------------------------------|---------------------------------------|---------------------------------------|
| Método HTTP de entrada        | POST                                  | GET (`?idventa=X`)                    |
| Validación previa             | Documento cliente + montos            | Estado == `'vigente'`                 |
| Flag CPE                      | Sí (`E_CPE` en `serie_comprobante`)   | No, siempre se envía                  |
| Tipo CPE                      | `generar_comprobante`                 | `generar_anulacion`                   |
| Endpoint API                  | `/api/documents`                      | `/api/voided`                         |
| Fuente de datos para CPE      | POST del formulario                   | `external_id` guardado en `venta`     |
| Incremento de correlativo     | Sí                                    | No                                    |
| Descarga XML/ZIP              | Sí                                    | No                                    |
| Campo de control en `venta`   | `envio_cpe_emision = 1`               | `envio_cpe_baja = 1`                  |
| Movimiento stock              | Salida (descuenta)                    | Entrada (devuelve)                    |
| Movimiento kardex             | `'salida'` / motivo `'venta'`         | `'entrada'` / motivo `'venta anulada'`|

---

## Diagrama de secuencia detallado

```
Cliente       Ventas::anular()     BD (trans)     FacturaloPeru     nubox360 API
   │                  │                 │                │                │
   │── GET ?id ──────►│                 │                │                │
   │                  │── venta_byId() ►│                │                │
   │                  │◄─ {estado} ─────│                │                │
   │                  │                 │                │                │
   │         [si estado != 'vigente']   │                │                │
   │◄── JSON error ───│                 │                │                │
   │                  │                 │                │                │
   │         [si vigente]               │                │                │
   │                  │── trans_start() ►│               │                │
   │                  │── devolver_stock►│               │                │
   │                  │   (lee detalle_venta, upd stock) │                │
   │                  │── insert_devolucion_kardex ──────►│               │
   │                  │   (lee detalle_venta, prod, stock, ins kardex)    │
   │                  │── anular_venta()►│               │                │
   │                  │── anular_det_venta►│             │                │
   │                  │                 │                │                │
   │         [trans_status == false]    │                │                │
   │◄── JSON error ───│── rollback ────►│                │                │
   │                  │                 │                │                │
   │         [trans ok]                 │                │                │
   │                  │── cpe_venta_anulacion() ────────►│               │
   │                  │◄─ {external_id, fecha, motivo} ──│               │
   │                  │── formatear_anulacion_estructura()►│              │
   │                  │                 │── builder_cpe()►│── POST ──────►│
   │                  │                 │                │◄── respuesta ──│
   │                  │                 │◄─ result ───────│               │
   │                  │── set_envio() ──►│                │                │
   │                  │── update_envio_cpe (baja=1) ─────►│               │
   │                  │── trans_commit()►│                │                │
   │◄── JSON ok ──────│                 │                │                │
```
