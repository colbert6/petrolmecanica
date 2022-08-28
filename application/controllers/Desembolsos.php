<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desembolsos extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->controller = 'Desembolsos';//Siempre define las migagas de pan
        $this->load->library('grocery_CRUD');

        $this->options_metodo_pago =  array(
            array('id'=>'deposito_bancario','texto'=>'deposito_bancario'),
            array('id'=>'efectivo','texto'=>'efectivo'),
            array('id'=>'otro','texto'=>'otro')
          );
    }


    public function lista()
    {
        $this->metodo = 'Lista';//Siempre define las migagas de pan

        $crud = new grocery_CRUD();
        $crud->set_table('desembolso');
        
        $crud->columns('fecha_registro','fecha_pago_desembolso', 'tipo_beneficiario', 'nombre_beneficiario', 'importe_total', 'pago_acumulado', 'saldo_a_cuenta');

        $crud->unset_delete();

        $crud->unset_texteditor(array('concepto_desembolso','full_text'));

        $crud->add_fields(array('tipo_beneficiario','idbeneficiario', 'nombre_beneficiario', 'fecha_pago_desembolso' ,'metodo_pago', 'nro_operacion_desembolso', 'importe_total', 'pago_desembolso', 'pago_acumulado', 'saldo_a_cuenta', 'saldo_a_cuenta_inicial', 'comprobantes_a_pagar',  'concepto_desembolso', 'iddesembolso_principal'));
        $crud->edit_fields(array('tipo_beneficiario','idbeneficiario', 'nombre_beneficiario', 'fecha_pago_desembolso' ,'metodo_pago', 'nro_operacion_desembolso', 'importe_total', 'pago_desembolso', 'pago_acumulado', 'saldo_a_cuenta', 'saldo_a_cuenta_inicial', 'comprobantes_a_pagar',  'concepto_desembolso', 'iddesembolso_principal','estado'));

        $crud->order_by('fecha_registro','desc');

        $output = $crud->render();
        $output->title = 'Desembolsos';

        $this->_init(true,true,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )
        $this->load->view('grocery_crud/basic_crud', (array)$output ) ;
    }

    public function agenda_general()
    {
        $this->metodo = 'Agenda general';//Siempre define las migagas de pan

        $this->_init(true,false,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )

        $this->load->js('assets/myjs/genericos/set_data.js');//genericos
        $this->load->js('assets/myjs/desembolso.js');
        $this->load->js('assets/js/bootbox.min.js');

        //Cargando modelos
        $this->load->model('desembolso');        

        $data_tables = array(
            'Cliente' => $this->desembolso->get_deudores_por_tipo_beneficiario("cliente"),
            'Proveedor' => $this->desembolso->get_deudores_por_tipo_beneficiario("proveedor") ,
            'Colaborador' => $this->desembolso->get_deudores_por_tipo_beneficiario("colaborador") 
        );

        $output = array('title' => 'Agenda general', 
            'data_tables' => $data_tables,
            'options_metodo_pago' => $this->options_metodo_pago
        ); 

        $this->load->view('desembolsos/agenda', $output ) ;
    }


    public function add_desembolso($tipo_beneficiario)
    {
        $this->metodo = 'Nuevo desembolso';//Siempre define las migagas de pan

        $this->_init(true,false,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )

        
        $this->load->js('assets/myjs/genericos/set_data.js');//genericos
        $this->load->js('assets/myjs/desembolso.js');
        $this->load->js('assets/js/bootbox.min.js');    
        $this->load->js('assets/js/typeahead/typeahead.min.js');

        //Cargando modelos
        $this->load->model('desembolso');

        $output_get_data = array(
            'label_text' => "Clientes",
            'input_busqueda_general_value_default' => "",
            'url_get_data' => 'get_datas/get_busqueda_general/'.strtolower($tipo_beneficiario)

        );

        $get_busqueda_general = $this->load->view('get_data/busqueda_general', $output_get_data,true) ;

        $output = array(
            'title' => 'Nuevo desembolso', 
            'get_busqueda_general' => $get_busqueda_general,
            'tipo_beneficiario_default' => strtolower($tipo_beneficiario),
            'options_metodo_pago' => $this->options_metodo_pago  
        ); 

        $this->load->view('desembolsos/add_desembolso', $output ) ;
    }

    public function save_desembolso(){

        $this->db->trans_start();

        //Guardar Venta
        $this->load->model('desembolso');        
        $this->desembolso->insert_desembolso();
        $iddesembolso = $this->db->insert_id();
        

        $return = array('estado' => false, 'msj' => '' , 'error'=> '' , 'idsave' => $iddesembolso);
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $return['msj']= $error['message'];
        } else {

            $this->db->trans_commit();
            $return['estado']=true;
        }
        print json_encode($return);
    }

    public function save_pago_desembolso(){
        $this->db->trans_start();

        //Guardar Venta
        $this->load->model('desembolso');        
        $this->desembolso->insert_desembolso_pago();
        $iddesembolso_pago = $this->db->insert_id();
        

        $return = array('estado' => false, 'msj' => '' , 'error'=> '' , 'idsave' => $iddesembolso_pago);
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $return['msj']= $error['message'];
        } else {

            $this->desembolso->update_add_pago_desembolso(
                $this->input->post('iddesembolso_a_pagar'), 
                $this->input->post('monto_pago')
            )
            ;
            $this->db->trans_commit();
            $return['estado']=true;
        }
        print json_encode($return);
        
    }


	

}
