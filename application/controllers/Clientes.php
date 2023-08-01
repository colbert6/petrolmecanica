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


        //$crud->required_fields('ruc','razon_social');//Requeridos
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
        $return = array('estado' => false, 'mensaje' => '', 'idsave' => 0);       
        
        $numero_documento = $this->input->post('ruc');
        $tipo_documento = "ruc";
        if(strlen($numero_documento) != 11 ){
            $numero_documento = $this->input->post('dni');
            $tipo_documento = "dni";
        } 

        $result_cliente_registrado = $this->cliente->validar_registro_cliente(" $tipo_documento = $numero_documento "); 

        if( !is_null($result_cliente_registrado) ){
            $return['estado']= false;
            $return['mensaje'] = "AVISO: Cliente YA EXISTE en la base de datos. <br>";
            $return['mensaje'] .= " >> Razón social : ". $result_cliente_registrado['cliente_nombre'];
            print json_encode($return);
            die('');

        }else{
            $this->cliente->insert_cliente();
            $idcliente = $this->db->insert_id();

            if ($this->db->trans_status() === FALSE) {                
                $error = $this->db->error();
				$return['estado'] = false;
				$return['mensaje'] = 'ERROR: Fallo en peraciones de base de datos. <br> ('.$error['message'].') ';
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
                $return['estado']=true;
                $return['mensaje'] = "Se ha registrado nuevo cliente.";
            }
        }        
        print json_encode($return);
        
    }

}
