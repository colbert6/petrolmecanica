<?php

class FacturaloPeru{

    protected $ci;

    public function __construct() {
        $this->ci = &get_instance();
    }

    private function get_token_cliente(){
        return 'enBLG3Jub2kf7CaRJ2KUAHoLUnckT3WJ59RTfAhGGF7GWm1iWT';
    }

    public function formatear_venta_estructura($row_venta, $row_detventa, $idventa, $cuotas = array()) {
        // Obtener items de la venta

        // Estructura principal
        $data = [
            "serie_documento" => $row_venta['serie_documento'],
            "numero_documento" => $row_venta['numero_documento'],
            "fecha_de_emision" => $row_venta['fecha_de_emision'],
            "hora_de_emision" => $row_venta['hora_de_emision'],
            "codigo_tipo_operacion" => $row_venta['codigo_tipo_operacion'],
            "codigo_tipo_documento" => $row_venta['codigo_tipo_documento'],
            "codigo_tipo_moneda" => $row_venta['codigo_tipo_moneda'],
            "fecha_de_vencimiento" => $row_venta['fecha_de_vencimiento'],
            "numero_orden_de_compra" => $row_venta['numero_orden_de_compra'],
            "codigo_condicion_de_pago" => $row_venta['codigo_condicion_de_pago'],
            
            // Datos del cliente
            "datos_del_cliente_o_receptor" => [
                "codigo_tipo_documento_identidad" => (string)$row_venta['codigo_tipo_documento_identidad'],
                "numero_documento" => $row_venta['numero_documento_cliente'],
                "apellidos_y_nombres_o_razon_social" => $row_venta['apellidos_y_nombres_o_razon_social'],
                "codigo_pais" => $row_venta['codigo_pais'],
                "ubigeo" => $row_venta['ubigeo'],
                "direccion" => $row_venta['direccion'],
                "correo_electronico" => $row_venta['correo_electronico'],
                "telefono" => $row_venta['telefono']
            ],
            
            // Totales
            "totales" => [
                "total_exportacion" => (float)$row_venta['total_exportacion'],
                "total_operaciones_gravadas" => (float)$row_venta['total_operaciones_gravadas'],
                "total_operaciones_inafectas" => (float)$row_venta['total_operaciones_inafectas'],
                "total_operaciones_exoneradas" => (float)$row_venta['total_operaciones_exoneradas'],
                "total_operaciones_gratuitas" => (float)$row_venta['total_operaciones_gratuitas'],
                "total_igv" => (float)$row_venta['total_igv'],
                "total_impuestos" => (float)$row_venta['total_impuestos'],
                "total_valor" => (float)$row_venta['total_valor'],
                "total_venta" => (float)$row_venta['total_venta']
            ],
            
            // Items
            "items" => $row_detventa,
            
            // Información adicional
            "informacion_adicional" => $row_venta['informacion_adicional']
        ];
        
        if (!empty($cuotas)) {
            $data['cuotas'] = $cuotas;
        }

        return $data;
    }

    public function formatear_anulacion_venta_estructura($row_venta, $idventa){

        // Estructura principal
        $data = [
            "fecha_de_emision_de_documentos" => $row_venta['fecha_emision'],
            "documentos" => [
                [  // Array indexado (genera corchetes en JSON)
                    "external_id" => $row_venta['external_id'],
                    "motivo_anulacion" => $row_venta['motivo_anulacion']
                ]
            ],
        ];

        return $data;
    }

    public function builder_cpe($data, $tipo_envio) {

        switch ($tipo_envio) {
    		case 'generar_comprobante':
                $ruta =  'https://petrolmecanica.nubox360.com/api/documents';
    			break;
    		case 'generar_anulacion':
    			$ruta = 'https://petrolmecanica.nubox360.com/api/voided';
    			break;
    		case 'generar_guia_remision':
    			$ruta = 'https://facturalahoy.com/api/facturalaya/guia_remision';
    			break;			
			
    		default:
                return array('mensaje'=> 'El tipo de envio de comprobante no definido.');
    			break;
    	}
    	
    	$token_cliente = $this->get_token_cliente();

		$response_send_cpe = $this->send_cpe($data, $token_cliente, $ruta);        

		return $response_send_cpe;
    
    }


    public function send_cpe($data, $token, $ruta_url) {
        
        //$token = 'enBLG3Jub2kf7CaRJ2KUAHoLUnckT3WJ59RTfAhGGF7GWm1iWT';
        //$ruta_url =  'https://petrolmecanica.nubox360.com/api/documents';
        $this_response = array('respuesta_curl'=>'');
        $data_json = json_encode($data);

        //print_r($data_json); die(); // debug

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $ruta_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data_json,
            CURLOPT_HTTPHEADER => array(  
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token, 
            )
        ));

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        if ($error) {
            $this_response['respuesta_curl'] = 'error';
            $this_response['error_curl'] = $error;

        } else {
            $this_response['respuesta_curl'] = 'ok';
            $response_array = json_decode($response, true);
            $this_response = array_merge($this_response, $response_array);
        }

        return $this_response;

       
    }


}

