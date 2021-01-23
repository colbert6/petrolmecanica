<?php

$data['token_cliente'] = ''; //KEY para que puedas consumir nuestra api
$data['ruc_proveedor'] = ""; //Tu número de RUC, el cuál será responsable por los datos enviados en todos los json

$data['secret_data'] = array(
	"tipo_certificado"		=> "pse_facturalaya", //no cambiar
	"tipo_proceso" 			=> "prueba", //prueba, produccion: aquí si deseas enviar en prueba o producción
);

//Todos los campos son obligatorios
$data['emisor'] = array(
	'ruc' 						=> '10470297081', //RUC del contribuyente, de tu cliente
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

$data['cabecera'] = array(
	"codigo"						=> 'RA', 
	"serie"							=> date('Ymd'), //La serie se genera con el AÑO, MES, DÍA, todo junto sin espacios
	"secuencia"             		=> 1, //La secuencia es diaria
	"fecha_referencia"             	=> date('Y-m-d'), //Fecha de Emisión del Documento Electrónico o documentos electrónicos
	"fecha_baja"          			=> date('Y-m-d') //Fecha de generación de la comunicación de baja (yyyy-mm-dd)
);

$detalle[] = array (
	"ITEM_DET"          	=> 1,
	"TIPO_COMPROBANTE"  	=> '01',
	"SERIE"           		=> 'F001',
	"NUMERO"            	=> 1,
	"MOTIVO"          		=> 'Aquí el motivo de la comunicación de baja, puede ser: Error en el RUC, Error en la generación del comprobante, etc.'
);

$data['detalle'] = $detalle;

$ruta = 'https://facturalahoy.com/api/facturalaya/comunicacion_baja';

/***/
echo "<pre>";
print_r($data);exit();
/**/

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