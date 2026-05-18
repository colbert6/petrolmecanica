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
  "codigo_modo_transporte": "02",
  "codigo_motivo_traslado": "05",
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
  "chofer": {
    "codigo_tipo_documento_identidad": "1",
    "numero_documento": "41784439",
    "nombres": "JUAN",
    "apellidos": "PEREZ",
    "numero_licencia": "Q41784439"
  },
  "numero_de_placa": "A011254",
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
    "number": "T001-6",
    "filename": "20123123123-09-T001-6",
    "external_id": "bdd93d40-076f-4c1c-80ca-4f4dc906ceb0"
  }
}