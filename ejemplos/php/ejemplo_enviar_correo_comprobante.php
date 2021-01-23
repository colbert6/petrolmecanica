<?php
$data['token_cliente'] = '';
$data['ruc_proveedor'] = "";

//Datos del Emisor
$data['asunto'] = 'Comprobante Electronico';
$data['emisor_idcontribuyente'] = '5'; //código interno no utilizado (opcional)
$data['emisor_email'] = ''; //Email de la empresa emisora
$data['emisor_razon_social'] = ''; //Razón Social o Nombre Comercial Empresa Emisora
$data['emisor_num_doc'] = ""; //RUC
	
//Datos del Receptor del Email
$data['cliente_email'] = "";
$data['cliente_razon_social'] = ""; //Nombre o Razón Social
$data['documento_nombre'] = 'Factura'; //Factura, Boleta, Nota de Crédito, Débito, Guía de Remisión
$data['documento_serie_numero'] = 'F001-45'; //Serie y Número del Documento
$data['documento_fecha'] = '15/05/2020'; //Fecha del Documento
$data['documento_total'] = 78; //Monto total del comprobante
$data['documento_moneda'] = 'PEN'; //USD, PEN
$data['documento_pdf_a4'] = '<a href="#">Ver PDF - A4</a>';
$data['documento_pdf_ticket'] = '<a href="#">Ver PDF - Ticket</a>';
$data['documento_xml'] = '<a href="#">Descargar XML</a>';
$data['accion'] = 'enviar_comprobante_cliente';

$ruta = 'https://facturalahoy.com/api/facturalaya/enviar_email_documento';
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
echo $respuesta;
exit();
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