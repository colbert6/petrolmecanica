<?php

// Pagina web :: https://facturalaya.com/servicio-de-facturacion-electronica/

//Definir los comprobantes que emite ? FAC, Nota debito
//En su comprobante va declara productos y servicios? si
//Definir su ubigeo?  060101
// Comunicar que los clientes deben tener ubigeo--- importante
//definir el cod sucursal

//Consultar como obtener el ubigeo de mi cliente? 
//	-> https://www.reniec.gob.pe/Adherentes/jsp/ListaUbigeos.jsp
//Consultar la guia de remisión tabién debe declararse
//  -> puede ser manual
//Tengo que enviar el mismo día? Desde el primero de abril si, por ahora tienes hasta 7 días
//Enviara la guia, son bastantes datos


//Envio cpe -- ok
//Envio anulacion cpe -- ok
//Se insert los envios_electronico -- ok
//Se insert los errores_envios_electronico -- ok
//Automatizar Envio cpe al crear la venta -- ok
//Lista de pendientes -- ok
//Lista de enviados -- ok
//Lista de errores -- ok

//Envio guia remision -- pendiente definir
//Consulta de cpe -- pendiente definir
//validar que se envio -- pediente

class Facturalaya{

	private function get_token_cliente() {
		$data = array();
		$data['token_cliente'] = 'facturalaya_colbert_9DA7j3jOm82xFIK'; //KEY para que puedas consumir nuestra api
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
			'codigo_ubigeo' 			=> '060101',
			'direccion' 				=> 'PJ. LA AMISTAD NRO. 145 BAR. MOLLEPAMPA',
			'modalidad_envio_sunat' 	=> 'inmediato', //no cambiar
			'direccion_departamento' 	=> 'CAJAMARCA', //del ubigeo
			'direccion_provincia' 		=> 'CAJAMARCA', //del ubigeo
			'direccion_distrito' 		=> 'CAJAMARCA', //del ubigeo
			'direccion_codigopais' 		=> 'PE' //no cambiar
		);
		return $data_emisor;
    }

    public function builder_cpe($data_cpe, $tipo){

    	switch ($tipo) {
    		case 'generar_comprobante':
    			$ruta = 'https://facturalahoy.com/api/facturalaya/factura';
    			break;
    		case 'generar_anulacion':
    			$ruta = 'https://facturalahoy.com/api/facturalaya/comunicacion_baja';
    			break;
    		
    		default:
    			return 0;
    			break;
    	}
    	
    	$data = array_merge($data_cpe, $this->get_token_cliente());
    	$data["emisor"] = $this->get_data_emisor();

    	return json_decode($this->send_cpe($data, $data['token_cliente'], $ruta), true);
		
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
			/*echo json_encode($resp);
			exit();*/
			$respuesta = json_encode($resp);
		}
	
		return $respuesta;

		//echo $respuesta;exit();
       
    }


     public function generar_comprobante_json($idventa, $ci){ 
       
        //FACTURA O BOLETA
        $ci->load->model('venta');
        $ci->load->model('det_venta');

        $data = $ci->venta->cpe_venta($idventa);        

        if( count($data) ) {
            $data_det = $ci->det_venta->cpe_detventa($idventa);
            $data["detalle"]= $data_det;
        }else{
            $data = array();
        }

        return $data;
    }   

    public function generar_anulacion_json($idventa,$ci){

        $ci->load->model('venta');

        $detalle = $ci->venta->cpe_venta_anulacion($idventa);

        if( isset($detalle) && count($detalle) ) {

            $data['cabecera'] = array(
                "codigo"                        => 'RA', 
                "serie"                         => date('Ymd'), //La serie se genera con el AÑO, MES, DÍA, todo junto sin espacios
                "secuencia"                     => 1, //La secuencia es diaria
                "fecha_referencia"              => date('Y-m-d'), //Fecha de Emisión del Documento Electrónico o documentos electrónicos
                "fecha_baja"                    => date('Y-m-d') //Fecha de generación de la comunicación de baja (yyyy-mm-dd)
            );

            $data["cabecera"]["fecha_referencia"] = $detalle["fecha_comprobante"];
            unset($detalle["fecha_comprobante"]);
            $data["detalle"][] = $detalle;
        }else{
            $data = array();
        }

        return $data;
    }

}
