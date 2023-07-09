<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->controller = 'Inicio';//Siempre define las migagas de pan
        
    }


     public function index()
    {
        $this->load->model('marketplace');
        $parametros = [ 'order_by' => '', 
                'limit' => '10',
                'like' => 'Tanque'
        ];

        //$where = "name='Joe' AND status='boss' OR status='active'";
        $lista_producto = $this->marketplace->get_lista_producto( $parametros ) ;
        $this->load->view('marketplace/index',$parametros) ;
    }

    public function producto( $producto = "None")
    {
        echo $producto;
    }

    

}
