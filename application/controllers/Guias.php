<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guias extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->controller = 'Guias_remision';//Siempre define las migagas de pan
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

    public function add()
    {

        
        $this->metodo = 'Nueva Guia Remisión';//Siempre define las migagas de pan

        $this->_init(true,false,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )

        $this->load->js('assets/myjs/genericos/calculos.js');//genericos
        $this->load->js('assets/myjs/genericos/get_data.js');//genericos
        $this->load->js('assets/myjs/genericos/set_data_v2.js');//genericos

        $this->load->js('assets/js/bootbox.min.js');

        $this->load->js('assets/js/shortcut.js');//activación de teclas 
        //$this->load->js('assets/js/typeahead/typeahead.min.js');

        //Cargando modelos
        $this->load->model('cliente');
        $this->load->model('almacen');
        $this->load->model('get_data');

        $output = array('cliente_base' => $this->cliente->get_cliente('idcliente',1) ); 
        $get_clientes = $this->load->view('get_data/clientes', $output,true) ;

        $output = array( 'onSelected' => 'add_detalle(obj);' ); //cuando se seleccione el valor
        $get_productos = $this->load->view('get_data/productos', $output,true) ;

        $output = array('title' => 'Venta', 

            'tiendas' => $this->almacen->get_tienda(),  
            'series' => $this->get_data->get_series(array( $this->id_factura,$this->id_boleta) ),
            'guia_remision' => $this->get_data->get_series(array( $this->id_guia_remision) ), //$this->id_ticket,
            'get_clientes' =>  $get_clientes,
            'get_productos' =>  $get_productos,
            'tipo_moneda' => $this->get_data->get_tipo_moneda(),
            'condicion_pago' => $this->get_data->get_periodo_pagos(),
            'forma_pago' =>$this->get_data->get_forma_pago()
              ); 

        $this->load->view('guias/add', $output ) ;
    }

    function save($post_array) {
        //NO OLVIDAR motivo_traslado texto
        ////validar id_tipo_documento_transporte :: si id_modalidadtraslado = 01, entonces aquí debe ingresar el tipo 6 (RUC), si el id_modalidadtraslado = 02, entonces el tipo de documento debe ser 1 DNI 
        //nro_documento_transporte :: si el id_tipo_documento_transporte es 1 entonces aquí DNI, si es 6 entonces aquí el RUC.
        //transporte_nro_placa :: Requerido solo cuando el transporte es privado

        $idmodelo_contratos = $post_array['modelo_contratos_idmodelo_contratos'];

        $modelo = $this->db->get_where('modelo_contratos', array('idmodelo_contratos' => $idmodelo_contratos ))->row(); 

        $post_array['colaborador_idcolaborador'] = $this->session->userdata('id_user');
        $post_array['texto'] = $modelo->valor;
         
        return $this->db->insert('contratos',$post_array);
    }      


}
