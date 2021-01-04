<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contratos extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->controller = 'Contratos';//Siempre define las migagas de pan
        $this->load->library('grocery_CRUD');
    }

    public function lista()
    {

        $this->metodo = 'Lista';//Siempre define las migagas de pan
        
        $this->load->library('grocery_CRUD');
        $this->load->js('assets/js/bootbox.min.js');
        $this->load->js('assets/myjs/groceryCRUD.js');
        $crud = new grocery_CRUD();

        $crud->set_table('contratos');
        $crud->columns('fecha_creacion','cliente_idcliente', 'modelo_contratos_idmodelo_contratos', 'estado');

        //$crud->display_as('fecha_creacion','Fecha');
        $crud->display_as('cliente_idcliente','Cliente');
        $crud->display_as('modelo_contratos_idmodelo_contratos','Modelo');

        $crud->set_relation('cliente_idcliente','cliente','razon_social');
        $crud->set_relation('modelo_contratos_idmodelo_contratos','modelo_contratos','descripcion');

        $crud->field_type('fecha_creacion', 'datetime');

        //acciones js revisar groceryCRUD.js
        $crud->add_action('Imprimir', '', base_url('contratos/print_documentacion?iddocumentacion='),'fa fa-print imprimir');


        $crud->unset_add_fields('texto','colaborador_idcolaborador', 'tienda_idtienda', 'fecha_creacion');
        $crud->unset_edit_fields('colaborador_idcolaborador', 'tienda_idtienda', 'fecha_creacion');
        $crud->callback_insert(array($this,'save'));
 
        $crud->unset_delete();


        $crud->order_by('fecha_creacion','desc');

        $output = $crud->render();

        $this->_init(true,true,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )
        $this->load->view('grocery_crud/basic_crud', (array)$output ) ;
        
    }

    function save($post_array) {

        $idmodelo_contratos = $post_array['modelo_contratos_idmodelo_contratos'];

        $modelo = $this->db->get_where('modelo_contratos', array('idmodelo_contratos' => $idmodelo_contratos ))->row(); 

        $post_array['colaborador_idcolaborador'] = $this->session->userdata('id_user');
        $post_array['texto'] = $modelo->valor;
         
        return $this->db->insert('contratos',$post_array);
    }      


}
