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

	protected $ci;

    public function __construct() {
        $this->ci = &get_instance();
    }

	private function get_token_cliente() {
		if ( $this->ci->config->item('Facturalaya_Secret_data_Tipo_proceso') ){
			$tipo_proceso = $this->ci->config->item('Facturalaya_Secret_data_Tipo_proceso');
		} else{
			echo "Variable no declarada :> Facturalaya_Secret_data_Tipo_proceso";
		}


		$data = array();
		$data['token_cliente'] = 'facturalaya_colbert_9DA7j3jOm82xFIK'; //KEY para que puedas consumir nuestra api
		$data['ruc_proveedor'] = "10730319342"; //Tu número de RUC, el cuál será responsable por los datos enviados en todos los json
		$data['secret_data'] = array(
			"tipo_certificado"		=> "pse_facturalaya", //no cambiar
			"tipo_proceso" 			=> $tipo_proceso, //prueba, produccion: aquí si deseas enviar en prueba o producción
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
				switch ($data_cpe["cod_tipo_documento"]) {
					case '01':
						$ruta = 'https://facturalahoy.com/api/facturalaya/factura';
						break;
					case '03':
						$ruta = 'https://facturalahoy.com/api/facturalaya/boleta';
						break;
					default:
						return 0;
						break;
				} 
    			break;
    		case 'generar_anulacion':
    			$ruta = 'https://facturalahoy.com/api/facturalaya/comunicacion_baja';
    			break;
    		case 'generar_guia_remision':
    			$ruta = 'https://facturalahoy.com/api/facturalaya/guia_remision';
    			break;			
			
    		default:
    			return 0;
    			break;
    	}
    	
    	$data = array_merge($data_cpe, $this->get_token_cliente());
		$data["emisor"] = $this->get_data_emisor();

		$result_send_cpe = $this->send_cpe($data, $data['token_cliente'], $ruta);
		$result_send_cpe_array = json_decode($result_send_cpe, true);

		if (is_array($result_send_cpe_array)) {
			return $result_send_cpe_array; 
		}

		$result_send_cpe_array["msj_sunat"] = $result_send_cpe;
		
    	return $result_send_cpe_array;
		
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

		
       
    }
  
    public function generar_cuotas($data_venta){

    	if($data_venta['forma_de_pago'] == 'credito'){

    		$nro_cuotas = $nro_cuotas_cont = $data_venta["nro_cuotas"];	
			$monto_venta = $data_venta["total"];
			$monto_cuota_promedio = round($monto_venta / $nro_cuotas, 2);
			$monto_amortizado = 0;

    		$fecha_vencimiento = $data_venta['fecha_comprobante'];
    		$detalle_cuotas = array();

    		while ( $nro_cuotas_cont >= 1) {
    			$fecha_vencimiento = date("Y-m-d", strtotime($fecha_vencimiento."+ 1 month")); 

    			$monto_cuota = $monto_cuota_promedio;
    			if($nro_cuotas_cont > 1){  // la cuota 1 debe ser igual al restante de lo que no se ha amortizado  				
    				$monto_amortizado += $monto_cuota_promedio;
    			}else{
    				$monto_cuota = $monto_venta - $monto_amortizado ;
    			}
    			
    			$detalle_cuotas[] = array('fecha_vencimiento' => $fecha_vencimiento,  'monto_cuota'=> $monto_cuota);
    			$nro_cuotas_cont--;
    		}

    		$data_venta['monto_deuda_total'] = $monto_venta;
    		$data_venta['detalle_cuotas'] = $detalle_cuotas;

    	}else{
			$data_venta['detalle_cuotas'] =  array();
		}

    	unset($data_venta["nro_cuotas"]);    	

    	return $data_venta;
    }

    public function generar_comprobante_json($idventa, $ci){ 
       
        //FACTURA O BOLETA
        $ci->load->model('venta');
        $ci->load->model('det_venta');

        $data = $ci->venta->cpe_venta($idventa); 
		//print_r($data);exit();

        if( count($data) ) {

        	$data = $this->generar_cuotas($data);//generar cuotas si es necesario

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
	
	
	/*-----------USADO COMO API---------------------*/
	public function buscar_cliente_por_nro_documento($numero_documento) {

        $data_emisor = $this->get_token_cliente();
        $token_cliente = $data_emisor['token_cliente'];

		switch (strlen($numero_documento)) {
			case 11:// para ruc buscar en empresa
				$ruta = "https://facturalahoy.com/api/empresa/".$numero_documento.'/'.$token_cliente;
				break;
			
			case 8:// para dni buscar en persona
				$ruta = "https://facturalahoy.com/api/persona/".$numero_documento.'/'.$token_cliente;
				break;
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

        $respuesta = curl_exec($curl);
        if (curl_error($curl)) {
            $error_msg = curl_error($curl);
        }

        if (isset($error_msg)) {
            $resp['respuesta'] = 'error';
            $resp['titulo'] = 'Error';
            $resp['data'] = '';
            $resp['encontrado'] = false;
            $resp['mensaje'] = 'Error en Api de Búsqueda';
            $resp['errores_curl'] = $error_msg;
            
            $respuesta = $resp;
        }else{
			$respuesta = json_decode($respuesta, true); //
		}
    
        return $respuesta;
    }

	public function agregar_data_emisor($data_documento){		
    	$data_documento["emisor"] = $this->get_data_emisor();
    	return $data_documento;	
    }
	
	public function definir_ruta_envio($codigo_envio){		
		$ruta = "";
		switch ($codigo_envio) {
    		case 'generar_comprobante':
    			$ruta = 'https://facturalahoy.com/api/facturalaya/factura';
    			break;
    		case 'generar_anulacion':
    			$ruta = 'https://facturalahoy.com/api/facturalaya/comunicacion_baja';
    			break;
    		case 'generar_guia_remision':
    			$ruta = 'https://facturalahoy.com/api/facturalaya/guia_remision';
    			break;	
    	}
		return $ruta;
	}
	
	public function solicitar_respuesta_curl($data_inicial, $codigo_envio) {
		
		$token = $this->get_token_cliente();
		
		$data_agregada = array_merge($data_inicial, $this->get_token_cliente());
		$ruta = $this->definir_ruta_envio($codigo_envio);
		$data_json_encode = json_encode($data_agregada);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $ruta);
		curl_setopt(
			$ch, CURLOPT_HTTPHEADER, array(
			'Authorization: Token token="'.$token['token_cliente'].'"',
			'Content-Type: application/json',
			)
		);
		
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json_encode);
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
			$respuesta = json_encode($resp); // setear al mismo formato que $respuesta  = curl_exec($ch);
		}
	
		return json_decode($respuesta, true); // setear a formato array

		//echo $respuesta;exit();
       
    }
  
	
}
