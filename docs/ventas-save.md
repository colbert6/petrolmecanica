# Flujo de `Ventas::save()`

Documenta el proceso completo que ocurre al guardar una venta nueva, desde la recepción del POST hasta la respuesta JSON al cliente.

---

## Diagrama general

```
POST /ventas/save
        │
        ▼
┌───────────────────┐
│  Validaciones     │  ← validar_guardado()
│  previas          │
└────────┬──────────┘
         │ ok
         ▼
┌───────────────────┐
│  Transacción BD   │  ← trans_start()
│  ┌─────────────┐  │
│  │ insert venta│  │  ← Venta::insert_venta()
│  │ insert det. │  │  ← Det_venta::insert_det_venta()
│  │ modif. stock│  │  ← Stock::modificar_stock("-")
│  │ insert kardex│ │  ← Kardex::insert_kardex("S","venta")
│  │ upd. correl.│  │  ← Comprobante::update_serie_correlativo()
│  └─────────────┘  │
└────────┬──────────┘
         │
         ├── CPE desactivado ──► trans_commit() ──► OK
         │
         └── CPE activado ───► enviar_comprobante_proveedor_cpe()
                                        │
                               ┌────────┴────────┐
                               │  preparar_datos  │  ← Venta::cpe_venta()
                               │  _cpe()          │  ← Det_venta::cpe_detventa()
                               └────────┬─────────┘
                                        │
                               ┌────────┴────────┐
                               │ FacturaloPeru    │  ← HTTP POST → nubox360 API
                               │ builder_cpe()    │
                               └────────┬─────────┘
                                        │
                               ┌────────┴─────────┐
                               │ guardar_resultado │  ← Envio_cpe::set_envio()
                               │ _cpe()            │  ← Envio_cpe::update_envio_cpe()
                               └────────┬──────────┘
                                        │
                               descargar_archivos_sunat()
                               (XML + ZIP via curl)
                                        │
                                   trans_commit()
```

---

## Paso a paso

### 1. Verificar si el envío CPE está activo

```php
$serie_correlativo_envio_cpe = $this->get_data->get_series_correlativos(" 'E_CPE' ", "serie");
$validar_envio_cpe = $serie_correlativo_envio_cpe[0]['correlativo'];
```

**Modelo:** `Get_data::get_series_correlativos()`  
**Tabla:** `serie_comprobante`  
**Lógica:** Busca una fila cuya columna `serie` sea `E_CPE`. El valor del campo `correlativo` (0 o 1) actúa como un flag de encendido/apagado del envío electrónico.

---

### 2. Determinar tipo de comprobante y documento del cliente

```php
$idserie          = $this->input->post('idserie');
$tipo_comprobante = $this->comprobante->get_tipo_serie($idserie);
```

**Modelo:** `Comprobante::get_tipo_serie()`  
**Tabla:** `serie_comprobante`  
Devuelve el `tipo_comprobante_idtipocomprobante` asociado a la serie seleccionada por el usuario.

Con ese tipo se decide qué campo de documento leer del POST:

| `$tipo_comprobante`    | Campo POST       |
|------------------------|------------------|
| `$this->id_factura`    | `ruc_cliente`    |
| `$this->id_boleta`     | `dni_cliente`    |

---

### 3. Validaciones de negocio

```php
$result_validacion = $this->validar_guardado($nro_documento_cliente, $tipo_comprobante, $total_venta);
```

**Función privada:** `Ventas::validar_guardado()`  
Ejecuta reglas antes de abrir la transacción:

| Escenario                              | Regla                                                     |
|----------------------------------------|-----------------------------------------------------------|
| Tipo **Factura**                       | Documento debe ser RUC (11 dígitos), no puede ser dummy   |
| Tipo **Boleta** con total ≥ S/ 700     | Documento debe ser DNI (8) o RUC (11), no puede ser dummy |
| Tipo **Boleta** con total < S/ 700     | Sin restricción de documento                              |

Si falla, retorna JSON con `estado: false` y `mensaje` de error sin abrir transacción.

---

### 4. Inicio de transacción y obtención del correlativo

```php
$this->db->trans_start();
$serie_correlativo_venta = $this->get_data->get_series_correlativos("$idserie", "idserie_comprobante");
$correlativo_actual      = $serie_correlativo_venta[0]['descripcion'];
```

**Tabla:** `serie_comprobante`  
Obtiene el número de documento actual en formato `F001-00042`. Este valor se asigna a `$this->venta->nro_documento` antes de insertar.

---

### 5. Insertar la venta principal

```php
$this->venta->tipo_comprobante_idtipo_comprobante = $tipo_comprobante;
$this->venta->nro_documento                       = $correlativo_actual;
$this->venta->cliente_documento                   = $nro_documento_cliente;
$this->venta->insert_venta();
$idventa = $this->db->insert_id();
```

**Modelo:** `Venta::insert_venta()`  
**Tabla:** `venta`  

El modelo lee directamente el POST para los campos restantes:

| Campo BD                      | Fuente                            |
|-------------------------------|-----------------------------------|
| `fecha_venta`                 | POST `fecha_venta`                |
| `tienda_idtienda`             | POST `tienda`                     |
| `igv`, `subtotal`, `descuento`, `total` | POST correspondientes   |
| `cliente_idcliente`           | POST `idcliente`                  |
| `cliente_razon_social`        | POST `cliente`                    |
| `colaborador_idcolaborador`   | Sesión `id_user`                  |
| `idtipo_moneda`, `idforma_pago`, `idperiodo_pago`, `nro_cuotas` | POST |
| `estado`                      | Hardcodeado: `'vigente'`          |
| `fecha_creacion`              | `date('Y-m-d H:i:s')` en el modelo |

---

### 6. Insertar el detalle de venta

```php
$this->det_venta->venta_idventa = $idventa;
$this->det_venta->insert_det_venta();
```

**Modelo:** `Det_venta::insert_det_venta()`  
**Tabla:** `detalle_venta`  

Itera sobre los arrays del POST (`idprod[]`, `cant[]`, `prec[]`, `prodtext[]`) e inserta una fila por cada ítem. Para cada producto consulta la tabla `producto` para obtener `presentacion_minima` y `tipo`.

---

### 7. Modificar stock

```php
$this->stock->modificar_stock("-");
```

**Modelo:** `Stock::modificar_stock()`  
**Tabla:** `stock`  

Recorre los mismos arrays del POST. Por cada ítem:
- Si no existe fila en `stock` para esa tienda/producto, la crea con valores 0.
- Ejecuta: `stock_almacen = stock_almacen - cantidad`.

---

### 8. Registrar en kardex

```php
$this->kardex->codmotivo = $idventa;
$this->kardex->insert_kardex("S", "venta");
```

**Modelo:** `Kardex::insert_kardex()`  
**Tabla:** `kardex`  

Inserta un movimiento de tipo **salida** por cada ítem del POST. Guarda el stock actual al momento del movimiento consultando la tabla `stock`.

---

### 9. Incrementar el correlativo de la serie

```php
$this->comprobante->update_serie_correlativo($idserie, 'correlativo', 'correlativo + 1');
```

**Modelo:** `Comprobante::update_serie_correlativo()`  
**Tabla:** `serie_comprobante`  

Ejecuta un `UPDATE serie_comprobante SET correlativo = correlativo + 1 WHERE idserie_comprobante = ?`. La expresión se pasa sin escapar (`FALSE`) para que el motor de BD evalúe la suma.

---

### 10. Verificar estado de la transacción

```php
if ($this->db->trans_status() === false) {
    $this->db->trans_rollback();
    // retorna error
}
```

Si cualquiera de los pasos 5–9 falló a nivel de BD, se hace rollback antes de intentar el envío CPE.

---

### 11. Envío CPE (condicional)

Dependiendo del flag de la etapa 1:

#### 11a. CPE desactivado (`correlativo = 0`)
```php
$this->db->trans_commit();
// mensaje: "VENTA GUARDADA. Envío comprobante electrónico PENDIENTE."
```

#### 11b. CPE activado (`correlativo = 1`)
```php
$result_envio_cpe = $this->enviar_comprobante_proveedor_cpe("generar_comprobante", $idventa);
```

Se delega a tres métodos privados encadenados:

**`preparar_datos_cpe("generar_comprobante", $idventa, $envio_cpe_fp)`**

| Llamada                                   | Modelo / Tabla involucrada            |
|-------------------------------------------|---------------------------------------|
| `Venta::cpe_venta($idventa)`              | JOIN: `venta`, `tienda`, `cliente`, `tipo_comprobante`, `forma_pago`, `tipo_moneda`, `periodo_pago` |
| `Det_venta::cpe_detventa($idventa)`       | JOIN: `detalle_venta`, `producto`     |
| `calcular_cuotas()` (si `nro_cuotas > 1`) | Lógica interna, sin BD                |
| `FacturaloPeru::formatear_venta_estructura()` | Transforma los datos al formato JSON de la API |

**`FacturaloPeru::builder_cpe($data_json, "generar_comprobante")`**  
→ `send_cpe($data, 'https://petrolmecanica.nubox360.com/api/documents')`  
Realiza un HTTP POST con el JSON armado. Cabeceras: `Content-Type: application/json` + `Authorization: Bearer <token>`.

**`guardar_resultado_cpe($data_json, $result_builder_cpe, $idventa, $tipo_envio)`**

| Llamada                                             | Efecto                                                          |
|-----------------------------------------------------|-----------------------------------------------------------------|
| `Envio_cpe::set_envio($data_json, $result)`         | Inserta en `envio_electronico` el registro completo del envío   |
| `Envio_cpe::update_envio_cpe($idventa, tipo, external_id)` | Actualiza `venta.envio_cpe_emision = 1` y guarda `external_id` |
| `descargar_archivos_sunat($archivos)`               | Descarga `<filename>.xml` y `<filename>.zip` vía curl a `public/cpe_sunat/` |

**Resultado del envío CPE:**

| Condición                                      | Acción                          |
|------------------------------------------------|---------------------------------|
| `respuesta == 'ok'` y `trans_status !== false` | `trans_commit()` → éxito total  |
| Cualquier error                                | `trans_rollback()` → error      |

---

## Tablas de BD involucradas

| Tabla               | Operación   | Responsable                        |
|---------------------|-------------|------------------------------------|
| `serie_comprobante` | SELECT      | `Get_data::get_series_correlativos()` |
| `serie_comprobante` | SELECT      | `Comprobante::get_tipo_serie()`    |
| `serie_comprobante` | SELECT      | `Get_data::get_series_correlativos()` (correlativo actual) |
| `serie_comprobante` | UPDATE (+1) | `Comprobante::update_serie_correlativo()` |
| `venta`             | INSERT      | `Venta::insert_venta()`            |
| `venta`             | UPDATE      | `Envio_cpe::update_envio_cpe()`    |
| `detalle_venta`     | INSERT      | `Det_venta::insert_det_venta()`    |
| `stock`             | INSERT/UPDATE | `Stock::modificar_stock()`       |
| `kardex`            | INSERT      | `Kardex::insert_kardex()`          |
| `envio_electronico` | INSERT      | `Envio_cpe::set_envio()`           |
| `producto`          | SELECT      | Dentro de `Det_venta` y `Kardex`   |

---

## Escenarios de error y rollback

```
Error en validar_guardado()
    └── Retorna JSON error SIN abrir transacción

Error en BD (pasos 5–9)
    └── trans_rollback() → retorna JSON error

Error curl en FacturaloPeru::send_cpe()
    └── trans_rollback() → retorna "Error en respuesta curl"

Respuesta 'success: false' de la API nubox360
    └── trans_rollback() → retorna "Error en respuesta de proveedor"

Excepción PHP no capturada
    └── catch(Exception $e) → trans_rollback() → retorna mensaje de excepción
```

---

## Diagrama de secuencia detallado

```
Cliente          Ventas::save()     BD (trans)     FacturaloPeru     nubox360 API
   │                   │                │                │                │
   │── POST ──────────►│                │                │                │
   │                   │── get E_CPE ──►│                │                │
   │                   │◄─ flag ────────│                │                │
   │                   │── get_tipo_serie ──►│            │                │
   │                   │◄─ tipo_comp ───│                │                │
   │                   │                │                │                │
   │                   │[validar_guardado()]             │                │
   │                   │                │                │                │
   │                   │── trans_start()►│                │                │
   │                   │── get correlativo►│              │                │
   │                   │── insert venta ►│                │                │
   │                   │── insert detventa►│              │                │
   │                   │── update stock ►│                │                │
   │                   │── insert kardex►│                │                │
   │                   │── update serie ►│                │                │
   │                   │                │                │                │
   │                   │[si CPE activo]  │                │                │
   │                   │── cpe_venta() ─►│                │                │
   │                   │── cpe_detventa()►│               │                │
   │                   │── formatear_venta_estructura() ─►│                │
   │                   │                │── builder_cpe()►│── POST JSON ──►│
   │                   │                │                │◄── respuesta ───│
   │                   │                │◄─ result ───────│                │
   │                   │── set_envio() ─►│                │                │
   │                   │── update_envio_cpe►│             │                │
   │                   │── curl XML/ZIP ─────────────────────────────────►│
   │                   │── trans_commit()►│               │                │
   │◄── JSON ok ───────│                │                │                │
```
