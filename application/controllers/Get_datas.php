<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_datas extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->controller = 'Get_datas';//Siempre define las migagas de pan
    }


    public function get_clientes()
    {
        $get_query = $this->input->get('query');
        $this->load->model('get_data');
        print json_encode($this->get_data->get_clientes($get_query) );
    }

    public function get_cliente_document_info_sunat()
    {
        $numero_documento = $this->input->get('numero');
        $return = array('estado' => false, 'mensaje' => '');
        
        // 1. Configuración según el tipo de documento
        $apiKey = "c9c4d0cf-6553-4746-93a7-e683bc0bd6c2"; 
        $url = "";
        $postData = ["token" => $apiKey];

        switch (strlen($numero_documento)) {
            case 11:
                $url = "https://api.consultaperuapi.com/api/v1/consultas";
                $postData["ruc"] = $numero_documento;
                $tipo_doc = "ruc";
                break;          
            case 8:
                $url = "https://api.consultaperuapi.com/api/v1/consultas-dni";
                $postData["dni"] = $numero_documento;
                $tipo_doc = "dni";
                break;
            default:
                $return['mensaje'] = "Número de documento inválido.";
                print json_encode($return);
                return;
        }

        // 2. Validar si ya existe en tu BD
        $this->load->model('cliente');
        $result_cliente_registrado = $this->cliente->validar_registro_cliente(" $tipo_doc = $numero_documento ");
        
        if( !is_null($result_cliente_registrado) ){
            $return['mensaje'] = "AVISO: Cliente YA EXISTE. <br> >> " . $result_cliente_registrado['cliente_nombre'];
            print json_encode($return);
            die('');
        }

        sleep(1);

        // 3. Consulta cURL
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_HTTPHEADER     => ["Content-Type: application/json"],
            CURLOPT_POSTFIELDS     => json_encode($postData),
            CURLOPT_TIMEOUT        => 15
        ]);

        $response = curl_exec($ch);

        curl_close($ch);
        $data_api = json_decode($response);

        // 4. Procesar Respuesta
        // Para RUC, el API devuelve la data directamente. Para DNI, viene con success:true y data: {...}
        $is_ruc_ok = ($tipo_doc == "ruc" && isset($data_api->ruc));
        $is_dni_ok = ($tipo_doc == "dni" && isset($data_api->success) && $data_api->success);

        if ($is_ruc_ok || $is_dni_ok) {
            $return['estado'] = true;
            $r_data = array();

            if ($tipo_doc == "ruc") {
                // Estructura para RUC (Directa)
                $r_data['razon_social']     = $data_api->razon_social;
                $r_data['nombre_comercial'] = $data_api->razon_social;
                $r_data['ruc']              = $data_api->ruc;
                $r_data['dni']              = '';
                
                // Procesar dirección de RUC (que es un objeto según tu raw)
                $dir = $data_api->direccion;
                if (is_object($dir)) {
                    $r_data['direccion'] = trim(($dir->tipo_via ?? '') . " " . ($dir->nom_via ?? '') . " " . ($dir->nro ?? ''));
                } else {
                    $r_data['direccion'] = $dir;
                }
                $r_data['codigo_ubigeo']    = $data_api->ubigeo ?? '';
            } else {
                // Estructura para DNI (Dentro de 'data')
                $info = $data_api->data;
                $r_data['razon_social']     = $info->nombreCompleto;
                $r_data['nombre_comercial'] = $info->nombres;
                $r_data['ruc']              = '';
                $r_data['dni']              = $info->dni;
                $r_data['direccion']        = $info->direccion ?? '';
                $r_data['codigo_ubigeo']    = $info->ubigeo ?? '';
            }

            $r_data['contacto']         = '';
            $r_data['correo']           = '';
            $r_data['fecha_nacimiento'] = ''; 

            $return['data'] = $r_data;
            $return['mensaje'] = "Consulta exitosa"; // Limpiamos mensaje de error previo
        } else {
            $msg_api = $data_api->message ?? "No se encontraron resultados.";
            $return['mensaje'] = "ERROR: " . $msg_api;
        }

        print json_encode($return);
    }

    public function get_cliente_document()
    {
        $tipo_doc = $this->input->get('tipo');
        $numero_doc = $this->input->get('numero');
        $this->load->model('get_data');
        print json_encode($this->get_data->get_cliente_document($tipo_doc, $numero_doc) );
    }

    public function get_productos()
    {
        $get_query = $this->input->get('query');
        $filtro = isset($_GET['filtro'])? $this->input->get('filtro'): '';

        $this->load->model('get_data');
        print json_encode($this->get_data->get_productos($get_query,$filtro) );
    }

    public function get_correlativo()
    {
        $idserie = $this->input->get('idserie');
        $this->load->model('get_data');
        print json_encode($this->get_data->get_correlativo($idserie) );
    }

    public function get_datos_default_documentacion()
    {   
        // get datos configurados para cada tipo de documentacion
        $result = array();
        $idserie = $this->input->get('idserie');
        $this->load->model('get_data');
        $result['get_datos_documentacion'] = $this->get_data->get_datos_documentacion($idserie);
        $result['get_correlativo'] = $this->get_data->get_correlativo($idserie);
        $result['idserie'] = $idserie;

        print json_encode($result);
    }

    public function find_datos_documentacion_existente()
    {   
        // para realizar importaciones
        $result = array();
        $this->load->model('get_data');

        $tipo_doc = 'nro_documento';//$this->input->get('tipo');
        $numero_doc = trim($this->input->get('idserie'));

        $info_basic_documento = $this->get_data->get_basic_info_documento_existente($tipo_doc,$numero_doc);
        $result['get_datos_documentacion'] = $this->get_data->find_datos_documentacion_existente($numero_doc);
        $result['get_correlativo'] = $this->get_data->get_correlativo($info_basic_documento->serie_comprobante_idserie_comprobante);
        $result['id_serie'] = $info_basic_documento->serie_comprobante_idserie_comprobante;

        print json_encode($result);
    }

    public function get_proforma_info()
    {
        $tipo_doc = 'nro_documento';//$this->input->get('tipo');
        $numero_doc = trim($this->input->get('numero'));
        $this->load->model('get_data');
        

        if(substr($numero_doc, 0,4) == "F001"){
            //obtener un comprobante ya existen como proforma
            print json_encode($this->get_data->get_comprobante_como_proforma_documento($tipo_doc, $numero_doc) );
        } else {
            print json_encode($this->get_data->get_proforma_documento($tipo_doc, $numero_doc) );
        }

        
    }

    public function get_busqueda_general($table)
    {
        $get_query = $this->input->get('query');
        $this->load->model('get_data');
        print json_encode($this->get_data->get_busqueda_general($table, $get_query) );
    }



	

}
