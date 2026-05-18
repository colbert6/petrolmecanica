Example Request
curl --location 'https://demo.factprox.com/api/dispatches' \
--data-raw '{
  "serie_documento": "T001",
  "numero_documento": "#",
  "fecha_de_emision": "2022-12-02",
  "hora_de_emision": "10:11:11",
  "codigo_tipo_documento": "09",
  "datos_del_emisor": {
    "codigo_pais": "PE",
    "ubigeo": "150101",
    "direccion": "Av. 2 de Mayo",
    "correo_electronico": "demo@gmail.com",
    "telefono": "427-1148",
    "codigo_del_domicilio_fiscal": "0000"
  },
  "datos_del_cliente_o_receptor":{
    "codigo_tipo_documento_identidad": "6",
    "numero_documento": "20601274133",
    "apellidos_y_nombres_o_razon_social": "EMPRESA XYZ S.A.",
    "nombre_comercial": "EMPRESA XYZ",
    "codigo_pais": "PE",
    "ubigeo": "150101",
    "direccion": "Av. 2 de Mayo",
    "correo_electronico": "demo@gmail.com",
    "telefono": "427-1148"
  },
  "observaciones": "aaaaaaaaaaaaaaa",
  "codigo_modo_transporte": "01",
  "codigo_motivo_traslado": "01",
  "descripcion_motivo_traslado": "El cliente solicito envia a su trabajo en ...",
  "fecha_de_traslado": "2022-12-02",
  "codigo_de_puerto": "",
  "indicador_de_transbordo": false,
  "unidad_peso_total": "KGM",
  "peso_total": 30.00,
  "numero_de_bultos": 1,
  "numero_de_contenedor": "",
  "direccion_partida": {
    "ubigeo": "150101",
    "direccion": "PUNTO A",
    "codigo_del_domicilio_fiscal": "0000"
  },
  "direccion_llegada": {
    "ubigeo": "150101",
    "direccion": "PUNTO 2",
    "codigo_del_domicilio_fiscal": "0000"
  },
  "transportista": {
    "codigo_tipo_documento_identidad": "6",
    "numero_documento": "20100686814",
    "apellidos_y_nombres_o_razon_social": "OLVA COURIER S.A.C",
    "numero_mtc": "1518996CNG"
  },
  "items":[
    {
      "codigo_interno": "00024",
      "cantidad": 2
    }
  ],
   "documento_afectado": {
    "serie_documento": "F001",
    "numero_documento": "190",
    "codigo_tipo_documento": "01"
  }
}'

Example Response
{
  "success": true,
  "data": {
    "number": "T001-7",
    "filename": "20123123123-09-T001-7",
    "external_id": "eddfac83-a0bf-4a37-b137-812366ed8d08"
  }
}