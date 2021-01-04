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
        
        //$orientation = ())? $this->input->get('orientation') : 'P' ;
        //$format = (isset($this->input->get('format')))? $this->input->get('format'):'A4';
        
        $servicio = $this->servicio_correctivo->servicio_byId($this->input->get('idservicio'));
        //$det_proforma = $this->det_proforma->get_print_det_proforma($this->input->get('idproforma'));

        //echo "<pre>";print_r($det_venta);exit();
        $nombrepdf  = 'Servicio _ '.$servicio['correlativo']; ;

        $this->load->library('Pdf_servicios');
        $pdf = new Pdf_servicios($orientation, 'mm', $format , true, 'UTF-8', false);

        $pdf->tipo_documento = 'SERVICIO CORRECTIVO';
        $pdf->nro_documento = $servicio['correlativo'];       

        //Parametros del PDF
        $pdf->SetTitle($nombrepdf);
        
        $pdf->SetAutoPageBreak(TRUE, 10);
        $pdf->AddPage();

        /*$nuevo = $pdf->MultiCell(10,'','hola que tal ashdasdasdas', 1,'L',0,0);
        $nuevo = $pdf->MultiCell(10,'','hola que t222al ashdasdasdas', 1,'L',0,0);
        $nuevo = $pdf->MultiCell(10,'','hola que ta2l 2ashd11asdaaasdas', 1,'L',0,1);*/

        $data_usuario_receptor = array('Fecha' => array('fecha','1'),
                                  'Hora' => array('hora','1'),
                                  ' ' => array(' ','2'),
                                  'Cliente' => array('cliente','3'),
                                  'R.U.C.' => array('ruc','1'),
                                  'Dirección' => array('direccion','2'),
                                  'Distrito' => array('distrito','1'),
                                  'Telef.' => array('tele','1'),
                                      );
        $pdf->receptor_data( $data_usuario_receptor);
      
        $pdf->servicios_data( $data_usuario_receptor);
      
        //Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')

        // test Cell stretching
        //$pdf->Cell(0, 0, 'Fecha ', 1, 1, 'C', 0, '', 0);

        /*$vendedor_fijo = "Edinson Jimenez" ;//$proforma['Usuario']
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
        $pdf->data_table( $det_proforma ,  $width_cols, true);//data , headers, indice

       
        $data_footer = array('monto_letra' => array( 'texto' => num_to_letras($proforma['Total'])),
                            'monto' => array('op_importe'=>$proforma['Total']),
                            'observacion' => array( 'texto' =>  $proforma['Observacion'])  
                               );
        $pdf->data_table_footer( 'pie_proforma',  $data_footer , 'msj');*/
        
        $pdf->Output($nombrepdf, 'I');
    }
    
}