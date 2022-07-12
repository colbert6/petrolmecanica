<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proformas extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->controller = 'Proformas';//Siempre define las migagas de pan
    }

    public function lista()
    {

        $this->metodo = 'Lista';//Siempre define las migagas de pan
        

        $this->load->library('grocery_CRUD');
        $this->load->js('assets/js/bootbox.min.js');
        $this->load->js('assets/myjs/groceryCRUD.js');
        $crud = new grocery_CRUD();

        $crud->set_table('proforma');
        $crud->columns('fecha_creacion','cliente_razon_social',/* 'tipo_comprobante_idtipo_comprobante',*/  'nro_documento','total','estado');

        //$crud->display_as('fecha_creacion','Fecha');
        $crud->display_as('cliente_razon_social','Cliente');
        //$crud->display_as('tipo_comprobante_idtipo_comprobante','Tipo Comp.');
        //$crud->display_as('serie_comprobante_idserie_comprobante','Serie');

        $crud->set_subject('proforma');
        $crud->set_relation('tienda_idtienda','tienda','descripcion');
        //$crud->set_relation('tipo_comprobante_idtipo_comprobante','tipo_comprobante','descripcion');
        //$crud->set_relation('serie_comprobante_idserie_comprobante','serie_comprobante','serie');

        $crud->field_type('fecha_creacion', 'datetime');

        //acciones js revisar groceryCRUD.js
        $crud->add_action('Anular proforma', '', base_url('proformas/anular?idproforma='),'fa fa-close anular');
        $crud->add_action('Imprimir', '', base_url('proformas/print_proforma?idproforma='),'fa fa-print imprimir');

        $crud->unset_add();
        $crud->unset_edit();
        $crud->unset_clone();
        $crud->unset_delete();

        $crud->order_by('fecha_creacion','desc');

        $output = $crud->render();


        $output->title = "Proforma :: <a href='".base_url('proformas/add')."'> crear nueva proforma</a>";

        $this->_init(true,true,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )
        $this->load->view('grocery_crud/basic_crud', (array)$output ) ;
        
    }   

    public function add()
    {
        
        $this->metodo = 'Nueva Proforma';//Siempre define las migagas de pan

        $this->_init(true,false,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )

        //Cargando js y css
        $this->load->js('assets/myjs/genericos/calculos.js');//genericos
        $this->load->js('assets/myjs/genericos/get_data.js');//genericos
        $this->load->js('assets/myjs/genericos/set_data.js');//genericos
        $this->load->js('assets/myjs/proformas.js');
        
        $this->load->js('assets/js/bootbox.min.js');
        $this->load->js('assets/js/typeahead/typeahead.min.js');
        $this->load->js('assets/js/shortcut.js');//actiacion de teclasv


        $this->load->model('almacen');
        $this->load->model('get_data');
        $this->load->model('cliente');


        $output = array(); 
        $get_clientes = $this->load->view('get_data/clientes', $output,true) ;

        $output = array( 'onSelected' => 'add_detalle(obj);' ); //cuando se seleccione el valor
        $get_productos = $this->load->view('get_data/productos', $output,true) ;

        $output = array('title' => 'Proforma', 
                        'series' => $this->get_data->get_series(array($this->id_boleta,$this->id_factura) ),                        
                        'get_clientes' =>  $get_clientes,
                        'get_productos' =>  $get_productos,
                        'tipo_pagos' =>  $this->get_data->get_tipo_pagos('%'),//'%' es todos
                        'periodo_pagos' =>  $this->get_data->get_periodo_pagos('%'),
                        'correlativo_proforma' => $this->get_data->get_series($this->id_proforma)
                        ); 
        //Cargando ultima
        $this->load->view('proformas/add', $output ) ;
    }

    public function save()
    {   
        $this->db->trans_start();

        //Guardar Venta
        $this->load->model('proforma');        
        $this->proforma->insert_proforma();
        $idproforma = $this->db->insert_id();
        
        //Guardar Detalle Venta
        $this->load->model('det_proforma');   
        $this->det_proforma->proforma_idproforma = $idproforma;     
        $this->det_proforma->insert_det_proforma();

        $this->load->model('comprobante');    
        $this->comprobante->update_serie_correlativo($this->id_proforma,'correlativo','correlativo + 1' );//idserie , campo , valor 
        

        $return = array('estado' => false, 'msj' => '' , 'error'=> '' , 'idsave' => $idproforma);
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $return['msj']= $error['message'];
        } else {

            $this->db->trans_commit();
            $return['estado']=true;
        }
        print json_encode($return);
        
    }

    public function anular()
    {   

        $this->session->set_flashdata('notificacion_grocery', 'success');
        $this->session->set_flashdata('msj_notificacion_grocery', 'Proforma eliminada');
        
        $this->load->model('proforma');  
        $pro = $this->proforma->proforma_byId($this->input->get('idproforma'));

        
        if($pro['estado'] == 'vigente'){

            //Anular Venta
            $idproforma = $this->proforma->anular_proforma($this->input->get('idproforma'));

        }else{

            $this->session->set_flashdata('notificacion_grocery', 'error');
            $this->session->set_flashdata('msj_notificacion_grocery', 'La proforma ya estaba anulada.');
        } 

        redirect('proformas/lista', 'location');
    }

     public function exportar_proforma_detalle()
    {   

        $this->load->model('det_proforma');

        if(substr($this->input->get('nro_documento'), 0,4) == "F001"){
            //obtener un comprobante ya existente como proforma
           $det_proforma = $this->det_proforma->get_exportar_det_comprobante_como_proforma($this->input->get('idproforma'));
        } else {
            $det_proforma = $this->det_proforma->get_exportar_det_proforma($this->input->get('idproforma'));
        }

        print json_encode($det_proforma);
    }

     public function print_proforma()
    {   

        $this->load->model('proforma');
        $this->load->model('det_proforma');
        $this->load->helper('calculo');

        $orientation = 'P' ;
        $format = 'A4';
        if(isset($_GET['orientation'])){
            $orientation = $this->input->get('orientation');

        }
        if(isset($_GET['format'])){
            $format = $this->input->get('format');
        }
        
        //$orientation = ())? $this->input->get('orientation') : 'P' ;
        //$format = (isset($this->input->get('format')))? $this->input->get('format'):'A4';

        $proforma = $this->proforma->get_print_proforma($this->input->get('idproforma'));
        $det_proforma = $this->det_proforma->get_print_det_proforma($this->input->get('idproforma'));
        $det_proforma_info = $this->det_proforma->get_print_det_proforma_info($this->input->get('idproforma'));

        //echo "<pre>";print_r($det_venta);exit();
        $nombrepdf  = 'Proforma _ '.$proforma['Nro_documento']; ;

        $this->load->library('Pdf_comprobantes');
        $pdf = new Pdf_comprobantes($orientation, 'mm', $format , true, 'UTF-8', false);

        $pdf->tipo_documento = 'proforma';
        $pdf->nro_documento = $proforma['Nro_documento'];       

        //Parametros del PDF
        $pdf->SetTitle($nombrepdf);
        
        $pdf->SetAutoPageBreak(TRUE, 15);
        $pdf->AddPage();

        $pdf->add_imagen();

        $data_usuario_receptor = array('Cliente' => array($proforma['Cliente'],'1'),
                                  'RUC' => array($proforma['RUC/DNI'],'1'),
                                  'Dirección' => array($proforma['Direccion'],'1')  );
        $pdf->receptor_data( 1 ,$data_usuario_receptor);

        $vendedor_fijo = "Edinson Jimenez" ;//$proforma['Usuario']
        $fecha_vencimiento =  date("Y-m-d",strtotime(substr($proforma['Fecha'], 0,10)."+ 5 days")); 
        $data_comprobante = array('Emitido' => array($proforma['Fecha'],'2'),
                                  'Vencimiento' => array($fecha_vencimiento,'2'),
                                  //'Tienda' => array($proforma['Tienda'],'1'),  
                                  'Vendedor' => array($vendedor_fijo,'2'),
                                  //'Comprobante' => array($proforma['Comprobante'],'1'),
                                  'Moneda' => array($proforma['Tipo_pago'],'2'),//Tipo pago
                                  //'Periodo pago' => array($proforma['Periodo_pago'],'1'),
                                   );
        $pdf->comprobante_data( 4 ,$data_comprobante);

        $width_cols = array(  array('Descripcion',60 ,'L') , array('Cant.',10, 'R'),array('P.unit',15,'R'),array('Subtotal',15,'R') );

        $pdf->data_table( $det_proforma , $width_cols, true);//data , headers, data añadir a columna, indice
	$descripcion_moneda = strtoupper($proforma['Tipo_pago']);
	$simbolo_moneda =  $descripcion_moneda == 'DOLARES' ? '$ ' : 'S/ ';
       
        $data_footer = array('monto_letra' => array( 'texto' => num_to_letras($proforma['Total'],'',$descripcion_moneda)),
                            'monto' => array('op_importe'=>$simbolo_moneda.$proforma['Total']),
                            'observacion' => array( 'texto' =>  $proforma['Observacion'])  
                               );
        $pdf->data_table_footer( 'pie_proforma',  $data_footer , 'msj');
        if( count($det_proforma_info)){
          $pdf->anexo_informacion( $det_proforma_info, true);//data , headers, data añadir a columna, indice
        }
        ob_end_clean();
        $pdf->Output($nombrepdf.'.pdf', 'I');
    }

   
	

}
