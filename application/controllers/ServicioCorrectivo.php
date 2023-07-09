<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ServicioCorrectivo extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->controller = 'Servicio Correctivo';//Siempre define las migagas de pan
    }
  
    public function lista()
    {

        $this->metodo = 'Lista';//Siempre define las migagas de pan
        

        $this->load->library('grocery_CRUD');
        $this->load->js('assets/js/bootbox.min.js');
        $this->load->js('assets/myjs/groceryCRUD.js');
        $crud = new grocery_CRUD();

        $crud->set_table('servicio_correctivo');
        $crud->columns('fecha_creacion', 'fecha','correlativo','cliente', 'estado_servicio');

        $crud->set_subject('Servicio correctivo');

        $crud->field_type('fecha_creacion', 'datetime');

        //acciones js revisar groceryCRUD.js
        $crud->add_action('Anular servicio correctivo', '', base_url('ServicioCorrectivo/anular?idservicio='),'fa fa-close anular');
        $crud->add_action('Imprimir', '', base_url('ServicioCorrectivo/print_servicio_correctivo?idservicio='),'fa fa-print imprimir');

        $crud->unset_add();
//         $crud->unset_edit();
        $crud->unset_clone();
        $crud->unset_delete();

        $crud->order_by('fecha_creacion','desc');

        $output = $crud->render();


        $output->title = "Servicio :: <a href='".base_url('ServicioCorrectivo/add')."'> crear nuevo Servicio correctivo</a>";

        $this->_init(true,true,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )
        $this->load->view('grocery_crud/basic_crud', (array)$output ) ;
        
    } 
  
    public function add()
    {
        
        $this->metodo = 'Nuevo registro';//Siempre define las migagas de pan

        $this->_init(true,false,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )

        //Cargando js y css
        $this->load->js('assets/myjs/genericos/calculos.js');//genericos
        $this->load->js('assets/myjs/genericos/get_data.js');//genericos
        $this->load->js('assets/myjs/genericos/set_data.js');//genericos
        $this->load->js('assets/myjs/servicio_correctivo.js');
        
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

        $output = array('title' => 'Servicio Correctivo', 
                        'series' => $this->get_data->get_series(array($this->id_boleta,$this->id_factura) ),                        
                        'get_clientes' =>  $get_clientes,
                        'get_productos' =>  $get_productos,
                        'tipo_pagos' =>  $this->get_data->get_tipo_pagos('%'),//'%' es todos
                        'periodo_pagos' =>  $this->get_data->get_periodo_pagos('%'),
                        'correlativo_proforma' => $this->get_data->get_series($this->id_servicio_correctivo)
                        ); 
        //Cargando ultima
        $this->load->view('servicio_correctivo/add', $output ) ;
    }
  
    public function save()
    {   
        $this->db->trans_start();
      
        //print_r($this->input->post());
        //exit;
        //Guardar Venta
        $this->load->model('servicio_correctivo');        
        $this->servicio_correctivo->insert_servicio($this->input->post());
        $idservicio = $this->db->insert_id();
        
        $this->load->model('comprobante');    
        $this->comprobante->update_serie_correlativo($this->id_servicio_correctivo,'correlativo','correlativo + 1' );//idserie , campo , valor 
        

        $return = array('estado' => false, 'msj' => '' , 'error'=> '' , 'idsave' => $idservicio);
        
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
        $this->session->set_flashdata('msj_notificacion_grocery', 'Servicio anulado');
        
        $this->load->model('servicio_correctivo');  
        $pro = $this->servicio_correctivo->servicio_byId($this->input->get('idservicio'));

        
        if($pro['estado_servicio'] != 'anulado'){

            //Anular servicio
            $idservicio = $this->servicio_correctivo->anular_servicio($this->input->get('idservicio'));

        }else{

            $this->session->set_flashdata('notificacion_grocery', 'error');
            $this->session->set_flashdata('msj_notificacion_grocery', 'El servicio ya estaba anulado.');
        } 

        //redirect('ServicioCorrectivo/lista', 'location');
    }
    
    public function print_servicio_correctivo()
    {   

        $this->load->model('servicio_correctivo');

        $orientation = 'P' ;
        $format = 'A4';
        if(isset($_GET['orientation'])){
            $orientation = $this->input->get('orientation');

        }
        if(isset($_GET['format'])){
            $format = $this->input->get('format');
        }
        
        // Get data
        $servicio = $this->servicio_correctivo->servicio_byId($this->input->get('idservicio'));
        //echo "<pre>";print_r($servicio);exit();

        // Format data
        $ds = $servicio;
        $det_medidores_a = $det_medidores_b = array();
        for ($i=1; $i <= 6; $i++) { 
            $det_medidores_a[] = array($i,$ds['med_producto_1_'.$i], $ds['med_alto_caudal_1_'.$i], $ds['med_bajo_caudal_1_'.$i], $i,$ds['med_producto_2_'.$i], $ds['med_alto_caudal_2_'.$i], $ds['med_bajo_caudal_2_'.$i]);

            $det_medidores_b[] = array($i,$ds['med_producto_3_'.$i], $ds['med_alto_caudal_3_'.$i], $ds['med_bajo_caudal_3_'.$i], $i,$ds['med_producto_4_'.$i], $ds['med_alto_caudal_4_'.$i], $ds['med_bajo_caudal_4_'.$i]);
        }

        // Format data
        $est_equipos  = array();
        for ($i=1; $i <= 3; $i++) { 
            $est_equipos[] = array( 'Equipo N°'.$i, $ds['est_equipo_bueno_1_'.$i], $ds['est_equipo_malo_1_'.$i] , $ds['est_observacion_1_'.$i]);            
        }

        
        // Create of file pdf
        $nombrepdf  = 'Servicio _ '.$servicio['correlativo'];

        $this->load->library('Pdf_servicios');
        $pdf = new Pdf_servicios($orientation, 'mm', $format , true, 'UTF-8', false);

        $pdf->tipo_documento = 'SERVICIO CORRECTIVO';
        $pdf->nro_documento = $servicio['correlativo'];       

        //Parametros del PDF
        $pdf->SetTitle($nombrepdf);
        
        $pdf->SetAutoPageBreak(TRUE, 10);
        $pdf->AddPage();

        $pdf->receptor_data( $servicio);

        $pdf->servicios_data( $servicio, 1);

        $width_cols = array(  array('Medidor',7 ,'L') , array('Producto',23, 'C'),array('Alto caudal',10,'R'),array('Bajo caudal',10,'R'),array('Medidor',7 ,'L') , array('Producto',23, 'C'),array('Alto caudal',10,'R'),array('Bajo caudal',10,'R') );

        $pdf->data_table( $det_medidores_a ,  $width_cols, false); 

        $tam_wi = 190;
        $pdf->MultiCell($tam_wi*0.15, 0,'OBSERVACIÓN : ', 0, 'L',0,0);  
        $pdf->MultiCell($tam_wi*0.85, 0,$servicio['observacion_1'], 'B', 'L',0,1);  
        $pdf->Ln();

        //$pdf->servicios_data( $servicio, 2);

        //$pdf->data_table( $det_medidores_b ,  $width_cols, false);  

        /*$pdf->MultiCell($tam_wi*0.1, 0,'OBSERVACIÓN : ', 0, 'L',0,0);  
        $pdf->MultiCell($tam_wi*0.9, 0,$servicio['observacion_2'], 'B', 'L',0,1); 
        $pdf->Ln();*/


        $width_cols_equipos = array(  array(' ', 15 ,'L') , array('Bueno',12, 'C'),array('Malo',12,'R'),array('Observacion',21,'C'));

        $pdf->data_table( $est_equipos ,  $width_cols_equipos, false); 

        $pdf->Ln();
        $pdf->MultiCell($tam_wi*0.2, 0,'Fecha de Visita : ', 0, 'L',0,0);  
        $pdf->MultiCell($tam_wi*0.3, 0,$servicio['fecha_visita'], 'B', 'L',0,1); 

        $pdf->add_firma_digital(); 


        ob_end_clean();
        $pdf->Output($nombrepdf, 'I');
    }
    
}