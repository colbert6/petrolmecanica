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
        $tipo_documento = $this->input->get('tipo');
        $numero_documento = $this->input->get('numero');
        $return = array('estado' => false, 'mensaje' => '');
        
        switch (strlen($numero_documento)) {
			case 11:// para ruc buscar en empresa
				$tipo_documento = "ruc";
				break;			
			case 8:// para dni buscar en persona
				$tipo_documento = "dni";
				break;
		}

        //1er pasa debemos validar si el cliente ya existe en nuestra BD
        $this->load->model('cliente');
        $result_cliente_registrado = $this->cliente->validar_registro_cliente(" $tipo_documento = $numero_documento ");
        
        if( !is_null($result_cliente_registrado) ){// validar data obtenida desde la BD
            $return['estado']= false;
            $return['mensaje'] = "AVISO: Cliente YA EXISTE en la base de datos. <br>";
            $return['mensaje'] .= " >> Razón social : ". $result_cliente_registrado['cliente_nombre'];
            print json_encode($return);
            die('');
        }

        //2do buscar información en URL api
        $result_cliente_consultado = array();
        $this->load->library('Facturalaya');
        $envio_cpe = new Facturalaya();
        $result_cliente_consultado = $envio_cpe->buscar_cliente_por_nro_documento($numero_documento);
        
        if( isset($result_cliente_consultado['respuesta']) ){// respuesta
            if( $result_cliente_consultado['respuesta']=='error' ){
                $return['estado']= false;
                $return['mensaje'] = "ERROR: ".$result_cliente_consultado['mensaje'].". <br>";
                $return['mensaje'] .= $result_cliente_consultado['errores_curl'] ?? 'No existe';

            }else{
                // separar las respuestas según resultado de consulta EMPRESA/PERSONA
                $r_c_c = $result_cliente_consultado;
                //print_r($r_c_c);
                $return['estado']= true;

                $r_data = array();
                $r_data['razon_social'] = $r_c_c['razon_social']?? $r_c_c['ap_paterno']." ".$r_c_c['ap_materno']." ".$r_c_c['nombres'];
                $r_data['nombre_comercial'] = $r_c_c['nombre_comercial']?? $r_c_c['nombres']." ".$r_c_c['ap_paterno']." ".$r_c_c['ap_materno'];
                $r_data['ruc'] = $r_c_c['ruc']?? '';
                $r_data['dni'] = $r_c_c['dni']?? '';
                $r_data['direccion'] = $r_c_c['direccion']?? '';
                $r_data['contacto'] = $r_c_c['telefono']?? '';
                $r_data['correo'] = ''?? '';
                $r_data['fecha_nacimiento'] = $r_c_c['fecha_nacimiento']?? '';

                if(isset($r_c_c['fecha_nacimiento']) ){
                    $fecha_nacimiento = date_create_from_format('d/m/Y', $r_data['fecha_nacimiento']);
                    $fecha_nacimiento = date_format($fecha_nacimiento, 'd-m-Y');
                }
                $r_data['fecha_nacimiento'] = $fecha_nacimiento??'';                
                $r_data['codigo_ubigeo'] = $r_c_c['codigo_ubigeo']?? '';

                $return['data'] = $r_data;
            }

        }else{
            $return['estado']= false;
            $return['mensaje'] = "ERROR: Error en respuesta .";
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
