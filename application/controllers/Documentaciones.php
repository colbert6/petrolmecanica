<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documentaciones extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->controller = 'Documentacion';//Siempre define las migagas de pan
        $this->load->library('grocery_CRUD');

        $this->id_dato_img = 33; //importante no modificar
        $this->id_serie_mantenimiento_calibracion = 18; //importante no modificar
    }

    public function lista()
    {

        $this->metodo = 'Lista';//Siempre define las migagas de pan
        
        $this->load->library('grocery_CRUD');
        $this->load->js('assets/js/bootbox.min.js');
        $this->load->js('assets/myjs/groceryCRUD.js');
        $crud = new grocery_CRUD();

        $crud->set_table('documentacion');
        $crud->columns('fecha_creacion','cliente_razon_social', 'tipo_comprobante_idtipo_comprobante',  'nro_documento','estado');

        //$crud->display_as('fecha_creacion','Fecha');
        $crud->display_as('cliente_razon_social','Cliente');
        $crud->display_as('tipo_comprobante_idtipo_comprobante','Tipo Comp.');
        $crud->display_as('serie_comprobante_idserie_comprobante','Serie');

        $crud->set_subject('Documentacion');
        $crud->set_relation('tienda_idtienda','tienda','descripcion');
        $crud->set_relation('tipo_comprobante_idtipo_comprobante','tipo_comprobante','descripcion');
        $crud->set_relation('serie_comprobante_idserie_comprobante','serie_comprobante','serie');

        $crud->field_type('fecha_creacion', 'datetime');

        //acciones js revisar groceryCRUD.js
        $crud->add_action('Imprimir', '', base_url('documentaciones/print_documentacion?iddocumentacion='),'fa fa-print imprimir');

        $crud->unset_add();
        //$crud->unset_edit();
        $crud->unset_clone();
        //$crud->unset_delete();

        $crud->edit_fields('texto','observacion','estado');

        $crud->order_by('fecha_creacion','desc');

        $output = $crud->render();

        $output->title = "Documentacion :: <a href='".base_url('documentaciones/add')."'> crear nuevo documento</a>"; 

        $this->_init(true,true,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )
        $this->load->view('grocery_crud/basic_crud', (array)$output ) ;
        
    }

    public function lista_tipos()
    {
        
        $this->metodo = 'Lista ';//Siempre define las migagas de pan

        $crud = new grocery_CRUD();

        $crud->set_table('serie_comprobante');

        $crud->columns( 'tipo_comprobante_idtipocomprobante','serie','correlativo','estado');

        $crud->display_as('tipo_comprobante_idtipocomprobante','Tipo');

        $crud->set_subject('Serie');
        $crud->set_relation('tipo_comprobante_idtipocomprobante','tipo_comprobante','descripcion');

        $crud->where('idtipo_comprobante',$this->id_certificado);
        $crud->or_where('idtipo_comprobante',$this->id_constancia);
        $crud->or_where('idtipo_comprobante',$this->id_acta);



        $crud->unset_add();
        $crud->unset_clone();
        $crud->unset_delete();        

        $output = $crud->render();
        $output->title = 'Tipo documentación';
        //validación del tipo de comprbante de documento de cliente es ventas.js


        $this->_init(true,true,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )
        $this->load->view('grocery_crud/basic_crud', (array)$output ) ;
    
    }

    public function tipo_datos()
    {
        $this->metodo = 'Lista';//Siempre define las migagas de pan

        $crud = new grocery_CRUD();
        $crud->set_table('dato');
        
        $crud->columns('descripcion','tipo', 'estado');
        $crud->unset_delete();
        $crud->unique_fields(array('descripcion'));
        $output = $crud->render();
        $output->title = 'Tipos de Datos';

        $this->_init(true,true,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )
        $this->load->view('grocery_crud/basic_crud', (array)$output ) ;
    }

    public function datos_documento()
    {
        $this->metodo = 'Lista';//Siempre define las migagas de pan

        $crud = new grocery_CRUD();
        $crud->set_table('datos_documentacion');

        $crud->required_fields('iddocumento','priority' );

        $crud->set_relation('iddato','dato','descripcion');
        $crud->set_relation('iddocumento','serie_comprobante','serie');

         $crud->unset_texteditor(array('valor','full_text'));

        $crud->display_as('priority','Orden');
        //$crud->columns('descripcion','tipo', 'estado');
        $crud->unset_delete();
        //$crud->unique_fields(array(''));}

        $crud->order_by('priority','asc');
        $crud->order_by('iddocumento','asc');
        $output = $crud->render();
        $output->title = 'Datos x Documento';

        $this->_init(true,true,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )
        $this->load->view('grocery_crud/basic_crud', (array)$output ) ;
    }

    public function add()
    {
        
        $this->metodo = 'Nuevo Documento';//Siempre define las migagas de pan

        $this->_init(true,false,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )

        //Cargando js y css
        $this->load->js('assets/myjs/genericos/get_data.js');//genericos
        $this->load->js('assets/myjs/genericos/set_data_documentacion.js');//genericos
        $this->load->js('assets/myjs/documentacion.js');
        
        $this->load->js('assets/js/bootbox.min.js');
        $this->load->js('assets/js/typeahead/typeahead.min.js');
        $this->load->js('assets/js/shortcut.js');//actiacion de teclasv
        

        //$this->load->model('almacen');
        $this->load->model('get_data');
        $this->load->model('cliente');

        $list_btns_info = array( 
                            array('value' =>'- Importar documento -' ,'onclick_function' =>'input_key_value_import_documento()' )
        );
        $output = array('flag_show_btn_importar_proforma'=> false, 'list_btns_info' =>  $list_btns_info
        ); 
        $get_clientes = $this->load->view('get_data/clientes', $output,true) ;

        /*$output = array( 'onSelected' => 'add_detalle(obj);' ); //cuando se seleccione el valor
        $get_productos = $this->load->view('get_data/productos', $output,true) ;*/
        $output = array('title' => 'Documentacion', 
                        'series' => $this->get_data->get_series(array($this->id_certificado,$this->id_constancia, $this->id_contrato, $this->id_acta,$this->id_garantia, $this->id_certificado_operatividad_tablero_electrico) ),                        
                        'get_clientes' =>  $get_clientes,
                        /*'get_productos' =>  $get_productos,
                        'tipo_pagos' =>  $this->get_data->get_tipo_pagos('%'),//'%' es todos
                        'periodo_pagos' =>  $this->get_data->get_periodo_pagos('%'),
                        'correlativo_proforma' => $this->get_data->get_series($this->id_proforma)*/
                        ); 
        //Cargando ultima
        $this->load->view('documentacion/add', $output ) ;
    }

    public function add_calibracion_tanque(){
        
        $this->metodo = 'Nueva calibracion tanques';//Siempre define las migagas de pan

        $this->_init(true,false,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )

        //Cargando js y css
        $this->load->js('assets/myjs/genericos/get_data.js');//genericos
        $this->load->js('assets/myjs/genericos/set_data.js');//genericos
        //$this->load->js('assets/myjs/documentacion_calibracion_tanque.js');
        
        $this->load->js('assets/js/bootbox.min.js');
        $this->load->js('assets/js/typeahead/typeahead.min.js');
        $this->load->js('assets/js/shortcut.js');//actiacion de teclasv
        

        //$this->load->model('almacen');
        $this->load->model('get_data');
        $this->load->model('cliente');

        $list_btns_info = array();

        $output = array('flag_show_btn_importar_proforma'=> false, 'list_btns_info' =>  $list_btns_info); 
        $get_clientes = $this->load->view('get_data/clientes', $output,true) ;

        
        $idserie = $this->id_serie_mantenimiento_calibracion;
        $output = array('title' => 'Nueva calibracion tanques', 
                        'idserie' => $idserie,
                        'serie_data' => $this->get_data->get_correlativo($idserie),                        
                        'get_clientes' =>  $get_clientes, 
                        'idcalibracion_tanque' => 'nuevo',
                        'msj_return_save'=> ''
        ); 
        //Cargando ultima
        
        $this->load->view('documentacion/add_calibracion_tanque', $output ) ;
    }


    public function save_calibracion_tanque($idcalibracion_tanque = 'nuevo'){

        $iddocumentacion = $idcalibracion_tanque;
        $msj_return_save = "Documento Guardado con éxito.";
        $iddato = $this->id_dato_img;
        $data = [];
   
        $count = count($_FILES['files']['name']);
    
        for($i=0;$i<$count;$i++){
    
            if(!empty($_FILES['files']['name'][$i])){
    
            $_FILES['file']['name'] = $_FILES['files']['name'][$i];
            $_FILES['file']['type'] = $_FILES['files']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
            $_FILES['file']['error'] = $_FILES['files']['error'][$i];
            $_FILES['file']['size'] = $_FILES['files']['size'][$i];

            $extension_file = substr($_FILES['files']['name'][$i], -4);
            if(  in_array($extension_file, array('jpeg') ) ){
                $extension_file = ".".$extension_file;
            }
            $name_file_formated = $this->input->post('serie_correlativo')."_".strval($i).$extension_file; 

            $config['upload_path'] = 'assets/uploads/calibracion_tanque/'; 
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = '5000';            
            $config['file_name'] = $name_file_formated;
   
            $this->load->library('upload',$config); 
    
                if($this->upload->do_upload('file')){
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];

                    $data['totalFiles'][] = $filename;
                }
            }

            $_POST['iddato'][$i] = $iddato;
            $_POST['dato'][$i] = $filename; //valor de dato

        }
        //print_r($_POST['iddato']);// print_r($_POST['dato']);

        if($idcalibracion_tanque == 'nuevo'){            

            $this->db->trans_start();//Inicio de transaccion

            $this->load->model('get_data');
            $idserie = $this->input->post('idserie');
            $serie = $this->get_data->get_correlativo($idserie);//Obtener correlativo actual

            $this->load->model('comprobante');  
            $tipo_comprobante = $this->comprobante->get_tipo_serie($idserie);//Obtener tipo de comprobante         
            $this->comprobante->update_serie_correlativo($idserie,'correlativo','correlativo + 1' );//idserie , campo , valor //Actualizar el correlativo de la serie 

            $ruc_cliente = $this->input->post('ruc_cliente');
            $dni_cliente = $this->input->post('dni_cliente');

            if( $ruc_cliente != '00000000000' AND strlen($ruc_cliente) == 11 ){
                $nro_documento_cliente = $ruc_cliente;
            }else if($dni_cliente != '00000000' AND strlen($dni_cliente) == 8){
                $nro_documento_cliente = $dni_cliente;                          
            }else{
                $nro_documento_cliente = '-' ;    
            }        

            //Guardar Venta
            $this->load->model('documentacion');        
            $this->documentacion->tipo_comprobante_idtipo_comprobante = $tipo_comprobante; 
            $this->documentacion->nro_documento = $serie->correlativo;   
            $this->documentacion->serie_comprobante_idserie_comprobante = $idserie;          
            $this->documentacion->cliente_documento = $nro_documento_cliente;
            
            $this->documentacion->insert_documentacion();
            $iddocumentacion = $this->db->insert_id();

            //Guardar Detalle Venta
            $this->load->model('det_documentacion');   
            $this->det_documentacion->documentacion_iddocumentacion = $iddocumentacion;     
            $this->det_documentacion->insert_det_documentacion();

            if ($this->db->trans_status() === FALSE) { 
                $error = $this->db->error();
                $msj_return_save = "ERROR => ". $error['message'];
                $this->db->trans_rollback();
                $iddocumentacion = 0;

            } else {
                $this->db->trans_commit();//$this->db->trans_rollback(); 
                $msj_return_save = "EXITO => Documento de Calibración guardado con éxito.";
            }

        
        }

        
        $id_documento = 109;
        $msj_return_save = "EXITO => Documento de Calibración guardado con éxito.";
        $this->show_status($msj_return_save, $iddocumentacion);
        //$this->lista();
    }



    public function save()
    {   
        // la tabla datos_documentacion es la tabla intermedia entrre la relacion entre datos (tipos de datos ) y la tabla serie_comproante
        // debido a que la tabla serie_comprobante, representa a cada tipo de documento que se puede crear

        //print_r($_FILES);print_r($_POST); echo "separador";//exit();

        // Ruta donde se guardarán las imágenes
        $uploadPath = 'assets/uploads/documentacion/'; 
        $iddato_deafult = isset($this->id_dato_img) ? $this->id_dato_img : '0';

        // Array para almacenar los nombres de las imágenes subidas
        //$uploadedImages = array();

        // Procesa cada imagen enviada
        if (!empty($_FILES['dato_img']['name'])) {
            $filesCount = count($_FILES['dato_img']['name']);
            for ($i = 0; $i < $filesCount; $i++) {
                $_FILES['userfile']['name']     = $_FILES['dato_img']['name'][$i];
                $_FILES['userfile']['type']     = $_FILES['dato_img']['type'][$i];
                $_FILES['userfile']['tmp_name'] = $_FILES['dato_img']['tmp_name'][$i];
                $_FILES['userfile']['error']    = $_FILES['dato_img']['error'][$i];
                $_FILES['userfile']['size']     = $_FILES['dato_img']['size'][$i];

                $imagenTypeExtension = substr($_FILES['dato_img']['name'][$i], -4);
                if(  in_array($imagenTypeExtension, array('jpeg') ) ){
                    $imagenTypeExtension = ".".$imagenTypeExtension;
                }
                $imagenNameFormated = $this->input->post('correlativo')."_".strval($i).$imagenTypeExtension; 

                $config['upload_path']   = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['file_name'] = $imagenNameFormated;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('userfile')) {
                    $imageData = $this->upload->data();

                    // Guarda el nombre de la imagen en el array
                    //$uploadedImages[] = $imageData['file_name'];
                    $imageData_filename = $imageData['file_name'];

                    //Generar metadata para guardar en BD
                    $iddato_img = isset($_POST['iddato_img'][$i]) ? $_POST['iddato_img'][$i] : $iddato_deafult;
                    $_POST['iddato'][] = $iddato_img;
                    $_POST['dato'][] = $uploadPath.$imageData_filename; //valor de dato
                }
            }
            
        }

        $return = array( 'estado_validacion' => true , 
            'estado' => false, 
            'msj' => '' , 
            'error'=> '' , 
            'idsave' => '' , 
            'enlace' => '');  

        //VALIDACIONES

        //Guardar movimiento
        $this->db->trans_start();//Inicio de transaccion

        $this->load->model('get_data');
        $idserie = $this->input->post('idserie');
        $serie = $this->get_data->get_correlativo($idserie);//Obtener correlativo actual

        $this->load->model('comprobante');  
        $tipo_comprobante = $this->comprobante->get_tipo_serie($idserie);//Obtener tipo de comprobante         
        $this->comprobante->update_serie_correlativo($idserie,'correlativo','correlativo + 1' );//idserie , campo , valor //Actualizar el correlativo de la serie 

        $ruc_cliente = $this->input->post('ruc_cliente');
        $dni_cliente = $this->input->post('dni_cliente');

        if( $ruc_cliente != '00000000000' AND strlen($ruc_cliente) == 11 ){
            $nro_documento_cliente = $ruc_cliente;
        }else if($dni_cliente != '00000000' AND strlen($dni_cliente) == 8){
            $nro_documento_cliente = $dni_cliente;                          
        }else{
            $nro_documento_cliente = '-' ;    
        }        

        //Guardar Venta
        $this->load->model('documentacion');        
        $this->documentacion->tipo_comprobante_idtipo_comprobante = $tipo_comprobante; 
        $this->documentacion->nro_documento = $serie->correlativo;   
        $this->documentacion->serie_comprobante_idserie_comprobante = $idserie;   
      
        $this->documentacion->cliente_documento = $nro_documento_cliente;
        
           
        $this->documentacion->insert_documentacion();
        $iddocumentacion = $this->db->insert_id();

        //Guardar Detalle Venta
        $this->load->model('det_documentacion');   
        $this->det_documentacion->documentacion_iddocumentacion = $iddocumentacion;     
        $this->det_documentacion->insert_det_documentacion();
            
        $return['idsave'] = $iddocumentacion;
       
        if ($this->db->trans_status() === FALSE) { 

            $error = $this->db->error();
            $return['msj']= $error['message'];
            $return['error']= $error['message'];           
            $this->db->trans_rollback(); 

        } else {

            $this->db->trans_commit();
            //$this->db->trans_rollback(); 
            $return['estado']=true;

        }       

        print json_encode($return);
    }
    
    public function print_documentacion()
    {   

        $this->load->model('documentacion');
        $this->load->model('det_documentacion');
        $this->load->helper('calculo');
      
        //$this->det_documentacion->actualizar();exit();

        $orientation = 'P' ;
        $format = 'A4';
        if(isset($_GET['orientation'])){
            $orientation = $this->input->get('orientation');

        }
        if(isset($_GET['format'])){
            $format = $this->input->get('format');
        }

        $documentacion = $this->documentacion->get_print_documentacion($this->input->get('iddocumentacion'));
        $det_documentacion = $this->det_documentacion->get_print_det_documentacion($this->input->get('iddocumentacion'));
        //echo '<pre>';print_r($documentacion);print_r($det_documentacion);exit();
        //!!!!!Alerta no deben haber dos datos default con el mismo iddato sino se duplican
      

        if( count($documentacion) == 0 OR count($det_documentacion) == 0 ){ die('NO SE ENCONTRARON RESULTADOS'); exit();};

        //$orientation = ())? $this->input->get('orientation') : 'P' ;
        //$format = (isset($this->input->get('format')))? $this->input->get('format'):'A4';
        
        $nombrepdf  = $documentacion['Comprobante'].'_'.$documentacion['Nro_documento'];
        
        $this->load->library('Pdf_documentacion');
        $pdf = new Pdf_documentacion($orientation, 'mm', $format , true, 'UTF-8', false);

        $pdf->tipo_documento = $documentacion['Comprobante'];
        $pdf->nro_documento = $documentacion['Nro_documento'];
        
        //Parametros del PDF
        $pdf->SetTitle($nombrepdf);
        
        $pdf->SetAutoPageBreak(TRUE, 15);
        $pdf->AddPage();

        $pdf->comprobante_data_title($documentacion['Texto']);
        //$pdf->comprobante_data_title($documentacion['Texto']);

        $pdf->Ln(12);     
        
        $pdf->comprobante_data($det_documentacion);

        $pdf->add_firma_digital(); 

         /* Limpiamos la salida del búfer y lo desactivamos */
        ob_end_clean();
        $pdf->Output($nombrepdf.'.pdf', 'I');
    }
	

}
