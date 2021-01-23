<?php

$data['token_cliente'] = ''; //KEY para que puedas consumir nuestra api
$data['ruc_proveedor'] = ""; //Tu número de RUC, el cuál será responsable por los datos enviados en todos los json

$data['secret_data'] = array(
	"tipo_certificado"		=> "pse_facturalaya", //no cambiar
	"tipo_proceso" 			=> "prueba", //prueba, produccion: aquí si deseas enviar en prueba o producción
);

//Datos del Receptor del comprobante de pago
$data['receptor'] = array(
	'ruc' 						=> '78946514878', //RUC del contribuyente, de tu cliente
	'tipo_doc' 					=> '6', //no cambiar (6: RUC)
);

//Datos para recuperar el comprobante electrónico
$data['ruc_emisor'] = '20495836135'; //RUC del Proveedor
$data['serie'] = 'F001'; //Serie del Comprobante
$data['correlativo'] = '2166'; //Correlativo del comprobante electrónico
$data['sol_ruc'] = '20570554485'; //RUC SOL PRINCIPAL
$data['sol_user'] = 'AGROINDU'; //USUARIO SOL PRINCIPAL
$data['sol_password'] = '976882110'; //PASSOWORD USUARIO SOL PRINCIPAL

$ruta = 'https://facturalahoy.com/api/facturalaya/recuperar_cpe';
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