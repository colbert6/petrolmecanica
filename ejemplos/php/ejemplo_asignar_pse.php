<?php

$data['token_cliente'] = ''; //KEY para que puedas consumir nuestra api
$data['ruc_proveedor'] = ""; //Tu número de RUC, el cuál será responsable por los datos enviados en todos los json

$data['secret_data'] = array(
	"tipo_certificado"		=> "pse_facturalaya", //no cambiar
	"tipo_proceso" 			=> "prueba", //prueba, produccion: aquí si deseas enviar en prueba o producción
);

$data['ruc_cliente'] = '';  //RUC de la empresa de tu cliente
$data['usuario_sol_cliente'] = ''; //Usuario sol de la empresa de tu cliente
$data['password_sol_cliente'] = ''; //Password del usuario SOL

$ruta = 'https://facturalahoy.com/api/facturalaya/asignar_pse_facturalaya';
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