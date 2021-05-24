<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->controller = 'Clientes';//Siempre define las migagas de pan
        $this->load->library('grocery_CRUD');
    }


    public function lista()
    {
        $this->metodo = 'Lista';//Siempre define las migagas de pan

        $crud = new grocery_CRUD();

        $crud->set_table('cliente');
        $crud->columns('razon_social','ruc','dni'); //,'nombre_comercial'


        $crud->required_fields('ruc','razon_social', 'ubigeo');//Requeridos
        $crud->unique_fields(array('razon_social','ruc','dni'));//unicos
        
        $crud->unset_add_fields('nombre_comercial','estado');
        
        $crud->unset_delete();
        $output = $crud->render();
        $output->title = 'Cliente';

        $this->_init(true,true,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )
        $this->load->view('grocery_crud/basic_crud', (array)$output ) ;
    }

    public function add_cliente_from_info_sunat()
    {   
        $this->db->trans_start();

        $this->load->model('cliente'); 

        $return = array('estado' => false, 'msj' => '' , 'error'=> '' , 'idsave' => 0);

        $flag_valid_cliente = $this->cliente->valid_cliente('ruc',$this->input->post('ruc')); 

        if(count($flag_valid_cliente)){
            $return['msj']= "Cliente YA EXISTE";
        }else{
            $this->cliente->insert_cliente();
            $idcliente = $this->db->insert_id();

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $return['msj']= $error['message'];
            } else {

                $this->db->trans_commit();
                $return['estado']=true;
            }

        }
        
        print json_encode($return);
        
    }

	

}
