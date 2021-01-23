<?php

$data['token_cliente'] = '';
$data['ruc_proveedor'] = "";

$data['secret_data'] = array(
	"tipo_certificado"		=> "pse_facturalaya",
	"tipo_proceso" 			=> "prueba", //prueba, produccion
);

//Todos los campos son obligatorios
$data['emisor'] = array(
	'ruc' 						=> '20496022271',
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

$detalle[] = array(
	"ITEM_DET" => "1", //correlativo 1 para el primer item
	"UNIDAD_MEDIDA_DET" => "KGM", //Catálogo No. 03 (KGM para Kilogramos)
	"CANTIDAD_DET" => 1, //Cantidad
	"CODIGO_PRODUCTO" => "COD_INTERNO_P1",  //Código interno del producto, entre 1 y 30 caracteres
	"DESCRIPCION_DET" => "Producto 01", //Nombre del producto hasta 300 caracteres
	"PESO_DET"	=> 15
);

$detalle[] = array(
	"ITEM_DET" => "1", //correlativo 1 para el primer item
	"UNIDAD_MEDIDA_DET" => "KGM", //Catálogo No. 03 (KGM para Kilogramos)
	"CANTIDAD_DET" => 1, //Cantidad
	"CODIGO_PRODUCTO" => "COD_INTERNO_P2",  //Código interno del producto, entre 1 y 30 caracteres
	"DESCRIPCION_DET" => "Producto 02", //Nombre del producto hasta 300 caracteres
	"PESO_DET"	=> 10
);

$data['detalle'] = $detalle;

//Datos del Traslado
$data["id_motivotraslado"] 		= '01'; //Catálogo N° 20 - Motivos de Traslado
$data["motivo_traslado"] 		= 'VENTA'; //Catálogo N° 20 - Motivos de Traslado
$data["peso"] 					= 25; //Peso Total (suma pesos del detalle en KGM (kilogramos masa))
$data["numero_paquetes"] 		= 2; //números de paquetes
$data["id_codigopuerto"] 		= ""; //Código de puerto (solo en casos de importación)
$data["numero_contenedor"] 		= ""; //(solo en casos de importación)
$data["id_modalidadtraslado"] 	= "02"; //01: Transporte público, 02: Transporte privado
$data["fecha_traslado"] 		= "2020-05-14"; //Fecha de inicio de traslado

//Transportista
$data["id_tipo_documento_transporte"] 	= "1"; //si id_modalidadtraslado = 01, entonces aquí debe ingresar el tipo 6 (RUC), si el id_modalidadtraslado = 02, entonces el tipo de documento debe ser 1 DNI 
$data["nro_documento_transporte"] 		= "44359648";  //si el id_tipo_documento_transporte es 1 entonces aquí DNI, si es 6 entonces aquí el RUC.
$data["razon_social_transporte"] 		= "JUAN ANDREZ PEREZ"; //Nombre transportista o Razón Social Empresa
$data['transporte_nro_placa'] 			= "DRD78"; //Requerido solo cuando el transporte es privado

//Punto Llegada
$data["id_ubigeo_destino"] 				= "010105";
$data["dir_destino"] 					= "JR. AQUÍ LA DIRECCION DE DESTINO FINAL";

//Punto Partida
$data["id_ubigeo_partida"] 				= "060101";
$data["dir_partida"] 					= "AQUÍ LA DIRECCION DE PARTIDA";

$data["nota"] 							= "Nota que se comunica a SUNAT";

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

$data["serie_comprobante"] 		=	"T001";
$data["numero_comprobante"] 	= 	1;
$data["fecha_comprobante"] 		= "2020-05-14";
$data["cod_tipo_documento"] 	= "09";

$data['cliente'] = $cliente;

$ruta = 'https://facturalahoy.com/api/facturalaya/guia_remision';
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