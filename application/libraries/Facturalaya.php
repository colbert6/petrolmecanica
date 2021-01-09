<?php

// Pagina web :: https://facturalaya.com/servicio-de-facturacion-electronica/

//Definir los comprobantes que emite ? FAC, Nota debito
//En su comprobante va declara productos y servicios? si
//Definir su ubigeo

//Consultar como obtener el ubigeo de mi cliente
//Consultar la guia de remisión tabién debe declararse


class Facturalaya{

	private function get_token_cliente() {
		$data = array();
		$data['token_cliente'] = $token ='facturalaya_colbert_9DA7j3jOm82xFIK'; //KEY para que puedas consumir nuestra api
		$data['ruc_proveedor'] = "20602440908"; //Tu número de RUC, el cuál será responsable por los datos enviados en todos los json
		$data['secret_data'] = array(
			"tipo_certificado"		=> "pse_facturalaya", //no cambiar
			"tipo_proceso" 			=> "prueba", //prueba, produccion: aquí si deseas enviar en prueba o producción
		);
		return $data;
	}

	public function get_data_emisor() {

        $data_emisor = array(
			'ruc' 						=> '20602440908', //RUC del contribuyente, de tu cliente
			'tipo_doc' 					=> '6', //no cambiar (6: RUC)
			'email'						=> 'petrolmecanica.jc@gmail.com', //correo
			'nom_comercial' 			=> 'PETROLMECANICA JC S.A.C.', //Nombre Comercial
			'razon_social' 				=> 'PETROLMECANICA JC S.A.C.', //Razón Social
			'codigo_ubigeo' 			=> '060102',
			'direccion' 				=> 'PJ. LA AMISTAD NRO. 145 BAR. MOLLEPAMPA',
			'modalidad_envio_sunat' 	=> 'inmediato', //no cambiar
			'direccion_departamento' 	=> 'CAJAMARCA', //del ubigeo
			'direccion_provincia' 		=> 'CAJAMARCA', //del ubigeo
			'direccion_distrito' 		=> 'ASUNCION', //del ubigeo
			'direccion_codigopais' 		=> 'PE' //no cambiar
		);
		return $data_emisor;
    }

    public function builder_cpe(){
    	$ruta = 'https://facturalahoy.com/api/facturalaya/factura';
		
    }

	public function send_cpe($data, $token, $ruta) {

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
       
    }
}
