<?php


$token_cliente = 'facturalaya_colbert_9DA7j3jOm82xFIK'; //TOKEN
$num_doc = '10730319342'; //NÚMERO DE DNI
$tipo = 'ruc'; // {dni, ruc}


if($tipo == 'dni') {
	$ruta = "https://facturalahoy.com/api/persona/".$num_doc.'/'.$token_cliente;	
} elseif ($tipo == 'ruc') {
	$ruta = "https://facturalahoy.com/api/empresa/".$num_doc.'/'.$token_cliente;
}

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