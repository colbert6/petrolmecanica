<?php

$data['token_cliente'] = ''; //KEY para que puedas consumir nuestra api
$data['ruc_proveedor'] = ""; //Tu número de RUC, el cuál será responsable por los datos enviados en todos los json

$data['secret_data'] = array(
	"tipo_certificado"		=> "pse_facturalaya",
	"tipo_proceso" 			=> "prueba", //prueba, produccion
);

//Todos los campos son obligatorios
$data['emisor'] = array(
	'ruc' 						=> '78946514878',
	'tipo_doc' 					=> '6',
	'email'						=> 'aquino.alex@gmail.com',
	'nom_comercial' 			=> 'Nombre Comercial SRL',
	'razon_social' 				=> 'Razón Social Empresa SRL',
	'codigo_ubigeo' 			=> '784598',
	'direccion' 				=> 'Jr. Puno N° 768',
	'modalidad_envio_sunat' 	=> 'inmediato',
	'direccion_departamento' 	=> 'Cusco',
	'direccion_provincia' 		=> 'Cusco',
	'direccion_distrito' 		=> 'Santiago',
	'direccion_codigopais' 		=> 'PE'
);

$cliente = array(
	"cliente_tipodocumento" 	=> "6",
	"cliente_numerodocumento" 	=> "20103290601",
	"cliente_nombre" 			=> "ALIANZA FRANCESA DE CHICLAYO",
	"cliente_direccion" 		=> "", //obligatorio solo con RUC
	"cliente_pais" 				=> "PE",
	"cliente_ciudad" 			=> "", //opcional
	"cliente_codigoubigeo" 		=> "", //obligatorio solo con RUC
	"cliente_departamento" 		=> "", //opcional
	"cliente_provincia" 		=> "", //opcional
	"cliente_distrito" 			=> "", //opcional
);

$data = array_merge($data, $cliente);

//item 1
$detalle[] = array(
	"ITEM_DET" => "1", //correlativo 2 para el segundo item
	"UNIDAD_MEDIDA_DET" => "NIU", //Catálogo No. 03 (NIU para unidades), (ZZ para servicios)
	"PRECIO_TIPO_CODIGO" => "01", //Catálogo No. 16: Códigos – Tipo de Precio de Venta Unitario (normalmente es 01)
	"COD_TIPO_OPERACION_DET" => "10", //Catálogo No. 07: Códigos de Tipo de Afectación del IGV
	"CANTIDAD_DET" => 1, //Cantidad vendida
	"PRECIO_DET" => 45, //Valor del Producto: Mayor a Cero y hasta 10 decimales
	"IGV_DET" => 6.86, //valor IGV: Hasta 2 decimales, debe ser mayora cero para operaciones gravadas
	"ICBPER_DET" => 0, //Impuesto ICBPER
	"ISC_DET" => 0, //Impuesto Selectivo al Consumo
	"PRECIO_SIN_IGV_DET" => 38.14, //Valor del producto sin IGV
	"IMPORTE_DET" => 38.14, //Importe sin IGV (cantidad x precio_sin_igv_det)
	"CODIGO_DET" => "COD_INTERNO_P2",  //Código interno del producto, entre 1 y 30 caracteres
	"DESCRIPCION_DET" => "Producto 02", //Nombre del producto hasta 300 caracteres

	"DESCUENTO_ITEM" => 'no', //si, no ==> si tiene descuento por item debe indicar "si", y deben llenarse los demás campos
	"PORCENTAJE_DESCUENTO" => 0, //Porcentaje, ejem. 10 (para 10%), 20 (para 20%) (si es CERO se condisera que no existe descuento por ITEM) (máximo dos decimiales)
	"MONTO_DESCUENTO"	=> 0, //máximo dos decimales
	"CODIGO_DESCUENTO" => '00' //Código de descuento según tabla N° 53 (normalmente es 00)
);

//item 2
$detalle[] = array(
	"ITEM_DET" => "2", //correlativo 2 para el segundo item
	"UNIDAD_MEDIDA_DET" => "NIU", //Catálogo No. 03 (NIU para unidades), (ZZ para servicios)
	"PRECIO_TIPO_CODIGO" => "01", //Catálogo No. 16: Códigos – Tipo de Precio de Venta Unitario (normalmente es 01)
	"COD_TIPO_OPERACION_DET" => "10", //Catálogo No. 07: Códigos de Tipo de Afectación del IGV
	"CANTIDAD_DET" => 1, //Cantidad vendida
	"PRECIO_DET" => 45, //Valor del Producto: Mayor a Cero y hasta 10 decimales
	"IGV_DET" => 6.86, //valor IGV: Hasta 2 decimales, debe ser mayora cero para operaciones gravadas
	"ICBPER_DET" => 0, //Impuesto ICBPER
	"ISC_DET" => 0, //Impuesto Selectivo al Consumo
	"PRECIO_SIN_IGV_DET" => 38.14, //Valor del producto sin IGV
	"IMPORTE_DET" => 38.14, //Importe sin IGV (cantidad x precio_sin_igv_det)
	"CODIGO_DET" => "S8UAROB",  //Código interno del producto, entre 1 y 30 caracteres
	"DESCRIPCION_DET" => "Producto 01", //Nombre del producto hasta 300 caracteres

	"DESCUENTO_ITEM" => 'no', //si, no ==> si tiene descuento por item debe indicar "si", y deben llenarse los demás campos
	"PORCENTAJE_DESCUENTO" => 0, //Porcentaje, ejem. 10 (para 10%), 20 (para 20%) (si es CERO se condisera que no existe descuento por ITEM) (máximo dos decimiales)
	"MONTO_DESCUENTO"	=> 0, //máximo dos decimales
	"CODIGO_DESCUENTO" => '00' //Código de descuento según tabla N° 53 (normalmente es 00)
);

$data['detalle'] = $detalle;

$data['tipo_operacion'] 	= '0101'; //Catálogo No. 51: Código de tipo de operación (solo se aceptan: 0101, 1001, 1002, 1003, 1004, 2001), normalmente es 0101 (venta interna)
$data['total_gravadas'] 	= 88.98; //Igual o mayor a cero
$data['total_inafecta'] 	= 0; //Igual o mayor a cero
$data['total_exoneradas'] 	= 0; //Igual o mayor a cero
$data['total_gratuitas'] 	= 0; //Igual o mayor a cero
$data['total_exportacion'] 	= 0; //Igual o mayor a cero
$data['total_isc'] 			= 0; //por defecto es cero
$data['total_icbper'] 		= 0; //por defecto es cero
$data['total_otr_imp'] 		= 0; //por defecto es cero
$data['total_descuento'] 	= 0;
$data['impuesto_icbper'] 	= 0.10; //El impuesto del icbper de acuerdo al año (2019: S/. 0.10, 2020: S/. 0.2, 2021: S/. 0.3)
$data['porcentaje_igv'] 	= 18; //Porcentaje del IGV
$data['total_igv'] 			= 16.02; //El monto total de IGV
$data['sub_total'] 			= 88.98; //Total sin IGV
$data['total'] 				= 105.00; //El total del documento
$data['total_letras'] 		= "SON CIENTO CINCO  CON 00/100"; //opcional

//opcional
$data['docs_referencia'][] 	= array(
									"id_tipodoc_electronico" 	=> '09',
									"serie_comprobante" 		=> 'T001',
									"numero_comprobante" 		=> 8
								);
//opcional
$data['docs_referencia'][] 	= array(
									"id_tipodoc_electronico" 	=> '09',
									"serie_comprobante" 		=> 'T001',
									"numero_comprobante" 		=> 9
								);

$data['nro_otr_comprobante'] 	= ''; //opcional
$data['transporte_nro_placa'] 	= ''; //opcional
$data['cod_moneda'] 			= 'PEN';
$data['cod_sucursal_sunat'] 	= '0000'; //Aquí se debe ubicar el código de la sucursal declarada en sunat, en caso no tengas ninguna sucursal entonces se debe colocar 0000
$data['fecha_comprobante'] 		= date("Y-m-d"); //la fecha debe tener el formato Y-m-d
$data['fecha_vto_comprobante'] 	= date("Y-m-d"); //la fecha de vencimiento debe tener el formato Y-m-d

//Tipo del documento electrónico, serie y número
$data['cod_tipo_documento'] 	= "07";
$data['serie_comprobante'] 		= "FC01"; //se recomienda utilizar una serie que inicie con FC para notas de crédito de Facturas, y una serie BC para notas de crédito de boletas.
$data['numero_comprobante'] 	= 5;

//la data que se aplica solo a notas de crédito
$data['tipo_comprobante_modifica'] 	= "01"; //obligatorio
$data['nro_documento_modifica'] 	= "F001-4"; //obligatorio
$data['cod_tipo_motivo'] 			= "02"; //obligatorio
$data['descripcion_motivo'] 		= "Anulación por error en el RUC"; //obligatorio

$ruta = 'https://facturalahoy.com/api/facturalaya/nota_credito';
$data_json = json_encode($data);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $ruta);
curl_setopt(
	$ch, CURLOPT_HTTPHEADER, array(
	'Authorization: Token token="'.$token.'"',
	'Content-Type: application/json',
	)
);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$respuesta  = curl_exec($ch);
if (curl_error($ch)) {
	$error_msg = curl_error($ch);
}
curl_close($ch);
if (isset($error_msg)) {
	$resp['respuesta'] = 'error';
	$resp['titulo'] = 'Error';
	$resp['data'] = '';
	$resp['encontrado'] = false;
	$resp['mensaje'] = 'Error en Api de Búsqueda';
	$resp['errores_curl'] = $error_msg;
	echo json_encode($resp);
	exit();
}

echo $respuesta;
exit();
?>