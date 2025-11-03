<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Envio_cpes extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->controller = 'Envio_cpes';//Siempre define las migagas de pan
        $this->load->library('grocery_CRUD');
    }


    public function lista_enviados() {
        $this->metodo = 'Lista';//Siempre define las migagas de pan

        $this->load->js('assets/myjs/groceryCRUD.js');
        $this->load->js('assets/js/bootbox.min.js');

        $crud = new grocery_CRUD();

        $crud->set_table('envio_electronico');
        $crud->columns('fecha_envio','serie','correlativo', 'tipoenvio', 'msj_sunat');
        
        $crud->order_by('fecha_envio','desc');

        $crud->add_action('consulta cpe', '', base_url('Envio_cpes/consultar_cpe?id='),'fa fa-deaf cpe_consulta');
        $crud->add_action('PDF', '', '','fa fa-file-pdf-o ruta_result',array($this,'add_ruta_result_pdf'));
        $crud->add_action('CDR', '', '','fa fa-file-archive-o ruta_result',array($this,'add_ruta_result_cdr'));
        $crud->add_action('XML', '', '','fa fa-file-excel-o ruta_result',array($this,'add_ruta_result_xml'));

        
        $crud->unset_delete();
        $crud->unset_clone();

        $output = $crud->render();
        $output->title = 'Enviados cpe';

        $this->_init(true,true,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )
        
        $this->load->view('grocery_crud/basic_crud', (array)$output ) ;
    }

    function add_ruta_result_pdf($primary_key , $row)
    {
        return "ir=".$row->ruta_pdf;
    }
    function add_ruta_result_xml($primary_key , $row)
    {
        return "ir=".$row->ruta_xml;
    }
    function add_ruta_result_cdr($primary_key , $row)
    {
        return "ir=".$row->ruta_cdr;
    }
  


    public function lista_pendientes() {

        $this->metodo = 'Lista';//Siempre define las migagas de pan

        $this->load->js('assets/myjs/groceryCRUD.js');
        $this->load->js('assets/js/bootbox.min.js');

        $crud = new grocery_CRUD();        

        $crud->columns('idmaster','fecha_emision','comprobante' , 'estado');
        $crud->set_table('cpe_envio_pendientes');
        $crud->set_primary_key('idmaster');
        //$crud->set_relation('usuario_envio','colaborador','nombre');
        
        $crud->unset_delete();
        $crud->unset_edit();

        $crud->order_by('fecha_emision','desc');

        $crud->add_action('envio cpe anulacion', '', base_url('Envio_cpes/envio_cpe_mostrar/generar_anulacion/'),'fa fa-close cpe_envio');
        $crud->add_action('envio cpe', '', base_url('Envio_cpes/envio_cpe_mostrar/generar_comprobante/'),'fa fa-send cpe_envio');

        $crud->unset_delete();
        $crud->unset_clone();

        $output = $crud->render();
        $output->title = 'Pendientes cpe';

        $this->_init(true,true,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )
        $this->load->view('grocery_crud/basic_crud', (array)$output ) ;
        

    }
    public function lista_errores() {
       
        $this->metodo = 'Lista';//Siempre define las migagas de pan

        $crud = new grocery_CRUD();

        $crud->set_table('error_envio_electronico');
        $crud->columns('errors','idmaster','fecha','tipo_envio', 'codigo', 'usuario_envio');
        $crud->set_relation('usuario_envio','colaborador','nombre');
        
        $crud->unset_delete();

        $crud->order_by('fecha','desc');

        $output = $crud->render();
        $output->title = 'Errores envios cpe';

        $this->_init(true,true,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )
        $this->load->view('grocery_crud/basic_crud', (array)$output ) ;
    }

    

    //--------------------------CPE--------------------

    

    public function envio_cpe($tipo_envio,$idventa) {

        //Parametros
        /*$idventa = $this->input->get('id');
        $tipo_envio = $this->input->get('tipo_envio');   */     
        $data_json = array();
        $this->load->library('Facturalaya');
        $envio_cpe = new Facturalaya();

        //Creamos el array con la data del cpe
        if($tipo_envio == "generar_comprobante"){
            $data_json = $envio_cpe->generar_comprobante_json($idventa, $this);
            if (isset($data_json["numero_comprobante"])) {
                $data_json["numero_comprobante"] = $data_json["numero_comprobante"] * 1;
            }
            
        }else if($tipo_envio =="generar_anulacion"){
            $data_json = $envio_cpe->generar_anulacion_json($idventa, $this);
        }
        //print_r($data_json);  die();

        //Validación - Problema con data del cpe
        if(count($data_json) &&  $data_json != 'null' ){
            $result = $envio_cpe->builder_cpe($data_json, $tipo_envio);
            
        }else{
            $result = array('mensaje'=>'No se encontro datos del comprobante.', 
                'respuesta'=> "error", 'titulo'=> "error",'cod_sunat'=> "error local" , 'codigo'=> "error local");            
        }

        $this->load->model('envio_cpe');
        $data_json["tipo_envio"] = $tipo_envio;
        $data_json["idmaster"] = $idventa;
		$cod_sunat = isset($result['cod_sunat'])? $result['cod_sunat']:999;
		$msj_sunat = isset($result['msj_sunat'])? $result['msj_sunat']:'error';
        
        if($result['respuesta'] == 'ok' &&  $result['cod_sunat'] == 0 ){ //Guardar 
            $this->envio_cpe->set_envio($data_json, $result);//guardar registro envio
            $this->envio_cpe->update_envio_cpe($idventa, $tipo_envio);//Actualizar en tabla venta

        }else{
            $result['codigo'] = isset($result['codigo'])? $result['codigo']:$cod_sunat;
            $result['mensaje'] = isset($result['mensaje'])? $result['mensaje']:$msj_sunat;
            $this->envio_cpe->set_error($data_json, $result);//guardar registro error envio
            $result['respuesta'] = 'error';
        }

        return $result;

    }

    public function envio_cpe_mostrar($tipo_envio,$idventa){

        $result = $this->envio_cpe($tipo_envio,$idventa);

        echo json_encode($result);
    }



    public function generar_comprobante_json_($idventa){ 
       
        //FACTURA O BOLETA
        $this->load->model('venta');
        $this->load->model('det_venta');

        $data = $this->venta->cpe_venta($idventa);        

        if( count($data) ) {
            $data_det = $this->det_venta->cpe_detventa($idventa);
            $data["detalle"]= $data_det;
        }else{
            $data = array();
        }

        return $data;
    }   

    public function generar_anulacion_json_($idventa){

        $this->load->model('venta');

        $detalle = $this->venta->cpe_venta_anulacion($idventa);

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


    public function consultar_cpe(){

        $idenvio = $this->input->get('id');
        //$idenvio = $_POST["idenvio"];
        $this->load->helper('nubefact');

        $sql = "SELECT IF( tipoenvio = 'generar_comprobante', 'consultar_comprobante' , 'consultar_anulacion') as operacion, 
                       tipo as tipo_de_comprobante,          
                       serie as serie,
                       correlativo as numero  

                FROM envio_electronico 
                WHERE id = ".$idenvio ;
        
        $data = $this->db->query($sql)->row_array();

        //print_r($data);
        $data_json = json_encode($data);   

        $respuesta = envio_json($data_json);



        if ( isset($respuesta["aceptada_por_sunat"]) &&  $respuesta["aceptada_por_sunat"] ) {

            $this->load->model('envio_cpe');

            $datos_result_cpe = array(  
                'fecha_mod'=>date("Y-m-d H:i:s"),
                'aceptada_por_sunat'=>$respuesta["aceptada_por_sunat"],
                'estado_envio' => 'ACEPTADO'                
            );
            $this->envio_cpe->set_envio_update($datos_result_cpe, $idenvio);           
        }

        print_r(json_encode($respuesta));
        
    }



}


/*
vista pendientes
SELECT ve.idventa as idmaster, ve.fecha_venta as fecha_emision, ve.nro_documento as comprobante, ve.estado as estado
FROM venta as ve
WHERE (ve.envio_cpe_emision = 0) or (ve.envio_cpe_baja = 0 and ve.estado ='anulado')
ORDER BY ve.fecha_venta ASC

*/