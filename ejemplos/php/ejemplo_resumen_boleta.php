<?php

$data['token_cliente'] = ''; //KEY para que puedas consumir nuestra api
$data['ruc_proveedor'] = ""; //Tu número de RUC, el cuál será responsable por los datos enviados en todos los json

$data['secret_data'] = array(
	"tipo_certificado"		=> "pse_facturalaya", //no cambiar
	"tipo_proceso" 			=> "prueba", //prueba, produccion: aquí si deseas enviar en prueba o producción
);

//Todos los campos son obligatorios
$data['emisor'] = array(
	'ruc' 						=> '78946514878', //RUC del contribuyente, de tu cliente
	'tipo_doc' 					=> '6', //no cambiar (6: RUC)
	'email'						=> 'aquino.alex@gmail.com', //correo
	'nom_comercial' 			=> 'Nombre Comercial SRL', //Nombre Comercial
	'razon_social' 				=> 'Razón Social Empresa SRL', //Razón Social
	'codigo_ubigeo' 			=> '784598',
	'direccion' 				=> 'Jr. Puno N° 768',
	'modalidad_envio_sunat' 	=> 'inmediato', //no cambiar
	'direccion_departamento' 	=> 'Cusco', //del ubigeo
	'direccion_provincia' 		=> 'Cusco', //del ubigeo
	'direccion_distrito' 		=> 'Santiago', //del ubigeo
	'direccion_codigopais' 		=> 'PE' //no cambiar
);

//cabecera del resumen diario
$data['codigo'] = 'RC';
$data['serie'] = date("Ymd"); //la serie está compuesta por la fecha sin espacios ni guiones (yyyymmdd)
$data['secuencia'] = 1; //la secuencia es diaria
$data['fecha_referencia'] = date("Y-m-d"); //Fecha de emisión de los documentos (yyyy-mm-dd)
$data['fecha_documento'] = date("Y-m-d"); //Fecha de generación del resumen (yyyy-mm-dd)

$detalle[] = array(
	"ITEM_DET"				=>	1,
	"TIPO_COMPROBANTE"		=>	"03",
	"NRO_COMPROBANTE"		=>	"B001-298",
	"NRO_DOCUMENTO"			=>	"99785544",
	"TIPO_DOCUMENTO"		=>	"1",
	"NRO_COMPROBANTE_REF"	=>	"",
	"TIPO_COMPROBANTE_REF"	=>	"",
	"STATUS"				=>	1, //1: Adicionar, 2: Modificar, 3: Anulado
	"COD_MONEDA"			=>	"PEN",
	"TOTAL"					=> 16.73,
	"GRAVADA"				=> 14.18,
	"EXONERADO"				=> 0,
	"INAFECTO"				=> 0,
	"EXPORTACION"			=> 0,
	"ICBPER"				=> 0,
	"GRATUITAS"				=> 0,
	"IGV"					=> 2.55,
	"MONTO_CARGO_X_ASIG"	=>	"0",
	"CARGO_X_ASIGNACION"	=>	"0",
	"ISC"					=>	0,
	"OTROS"					=>	0
);

$data['detalle'] = $detalle;

$ruta = 'https://facturalahoy.com/api/facturalaya/resumen_boletas';
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