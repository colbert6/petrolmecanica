<?php

$data['token_cliente'] = ''; //KEY para que puedas consumir nuestra api
$data['ruc_proveedor'] = ""; //Tu número de RUC, el cuál será responsable por los datos enviados en todos los json

$data['secret_data'] = array(
	"tipo_certificado"		=> "pse_facturalaya", //no cambiar
	"tipo_proceso" 			=> "produccion", //prueba, produccion: aquí si deseas enviar en prueba o producción
);

//Todos los campos son obligatorios
$data['emisor'] = array(
	'ruc' 						=> '10470297081', //RUC del contribuyente, de tu cliente
	'tipo_doc' 					=> '6', //no cambiar (6: RUC)
);

$data['documento'] = array(
	'id_tipo_doc_electronico' => '01',
	'documento_serie' => 'F001',
	'documento_numero' => '225',
	'documento_fecha' => 1, //En formato: d/m/Y
	'documento_total' => 1 //Total del comprobante
);

$data['cliente'] = array( //Si es una boleta anónima se debe ingresar en id_doc = '', y num_doc = '', ambos valores vacios.
	'id_doc' => '6',
	'num_doc' => '20604209987'
);

$ruta = 'https://facturalahoy.com/api/facturalaya/validar_cpe';
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