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
        $tipo_doc = $this->input->get('tipo');
        $numero_doc = $this->input->get('numero');

        $data_json = array();
        $this->load->library('Facturalaya');
        $envio_cpe = new Facturalaya();
        $data_json = $envio_cpe->get_client_info_sunat($tipo_doc, $numero_doc);
        print ($data_json);
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
        print json_encode($this->get_data->get_proforma_documento($tipo_doc, $numero_doc) );
    }






	

}
