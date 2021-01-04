<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte_compras extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->controller = 'Reporte_compras';//Siempre define las migagas de pan
    }


    public function index()
    {

        $this->metodo = 'Ver reporte';//Siempre define las migagas de pan

        $this->_init(true,true,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )
        $output = array('title' => 'Reporte Compras' ); 

        $this->load->js('assets/myjs/reporte_compras.js');

        $this->load->view('reporte_compras/index', $output ) ;
    }

    public function get_reporte_compras(){

        $fecha_inicio = $this->input->get("fi");
        $fecha_fin = $this->input->get("ff");
        $tipo = $this->input->get("tr");

        $this->load->model('compra');

        $data ;
        if( $tipo == 'General' ){
            $data = $this->compra->get_compras($fecha_inicio,$fecha_fin);//retornar en array
        }else if( $tipo == 'Detallado' ) {
            $data = $this->compra->get_detallecompras($fecha_inicio,$fecha_fin);
        }
        

        if( count($data) == 0 ){
            echo "<h3>No se encontró resultados</h3>";
        }else{
            $output['title'] = 'Compras vigentes del '.$fecha_inicio.' al '.$fecha_fin.', tipo '.$tipo;
            $output['data'] = $data;
            $output['campo_suma'] = 'Total';
            //echo "<pre>";print_r($data);
            $this->load->view('themes/table_basic', $output ) ;
        }

        

    }



	

}
