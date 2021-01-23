<?php
$token_cliente = ''; //TOKEN
$num_doc = ''; //NÚMERO DE DNI
$ruta = "https://facturalahoy.com/api/apipersona/busqueda_avanzada/$token_cliente/$num_doc";	

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

echo $response;
exit();
?>