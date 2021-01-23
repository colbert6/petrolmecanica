<?php
$token_cliente = ''; //KEY para que puedas consumir nuestra api
$placa = '';
$ruta = "https://facturalahoy.com/api/apisunarp/index/$token_cliente/$placa";

$curl = curl_init();
curl_setopt_array($curl, array(
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_URL => $ruta,
	CURLOPT_USERAGENT => 'Consulta Datos',
	CURLOPT_CONNECTTIMEOUT => 0,
	CURLOPT_TIMEOUT => 400,
	CURLOPT_FAILONERROR => true
));

$response = curl_exec($curl);
if (curl_error($curl)) {
	$error_msg = curl_error($curl);
}

curl_close($curl);

if (isset($error_msg)) {
	$resp['respuesta'] = 'error';
	$resp['titulo'] = 'Error';
	$resp['data'] = $response;
	$resp['encontrado'] = false;
	$resp['mensaje'] = 'Error en Api de Búsqueda';
	$resp['errores_curl'] = $error_msg;
	return $resp;
}

echo $response;
exit();
?>