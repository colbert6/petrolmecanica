    <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->controller = 'Ventas';//Siempre define las migagas de pan
    }


    public function lista()
    {

        $this->metodo = 'Lista';//Siempre define las migagas de pan
        

        $this->load->library('grocery_CRUD');
        $this->load->js('assets/js/bootbox.min.js');
        $this->load->js('assets/myjs/groceryCRUD.js');
        $crud = new grocery_CRUD();

        $crud->set_table('venta');
        $crud->columns('fecha_creacion','cliente_razon_social', 'tipo_comprobante_idtipo_comprobante',  'nro_documento','total','estado');

        //$crud->display_as('fecha_creacion','Fecha');
        $crud->display_as('cliente_razon_social','Cliente');
        $crud->display_as('tipo_comprobante_idtipo_comprobante','Tipo Comp.');
        $crud->display_as('serie_comprobante_idserie_comprobante','Serie');

        $crud->set_subject('Venta');
        $crud->set_relation('tienda_idtienda','tienda','descripcion');
        $crud->set_relation('tipo_comprobante_idtipo_comprobante','tipo_comprobante','descripcion');
        $crud->set_relation('serie_comprobante_idserie_comprobante','serie_comprobante','serie');

        $crud->field_type('fecha_creacion', 'datetime');

        //acciones js revisar groceryCRUD.js
        $crud->add_action('Anular venta', '', base_url('ventas/anular?idventa='),'fa fa-close anular');
        $crud->add_action('Imprimir', '', base_url('ventas/print_venta?idventa='),'fa fa-print imprimir');
        $crud->add_action('Guia', '', base_url('ventas/print_guia?idventa='),'fa fa-bus guia');

        $crud->unset_add();
        $crud->unset_edit();
        $crud->unset_clone();
        $crud->unset_delete();

        $crud->order_by('fecha_creacion','desc');

        $output = $crud->render();

        $output->title = "Ventas :: <a href='".base_url('ventas/add')."'> crear nueva venta</a>";

        $this->_init(true,true,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )
        $this->load->view('grocery_crud/basic_crud', (array)$output ) ;
        
    }

    public function add()
    {

        
        $this->metodo = 'Nueva venta';//Siempre define las migagas de pan

        $this->_init(true,false,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )

        $this->load->js('assets/myjs/genericos/calculos.js');//genericos
        $this->load->js('assets/myjs/genericos/get_data.js');//genericos
        $this->load->js('assets/myjs/genericos/set_data.js');//genericos
        $this->load->js('assets/myjs/movimientos.js');

        $this->load->js('assets/myjs/ventas_.js');
        $this->load->js('assets/js/bootbox.min.js');

        $this->load->js('assets/js/shortcut.js');//activación de teclas 
        $this->load->js('assets/js/typeahead/typeahead.min.js');

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

        $this->load->view('ventas/add', $output ) ;
    }

    public function control()
    {

        $this->metodo = 'Control';//Siempre define las migagas de pan

        $this->load->js('assets/myjs/ventas_control.js');
        
        $output = array('title' => "Ventas :: <a href='".base_url('ventas/lista')."'> listar ventas</a>");

        $this->_init(true,true,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )
        $this->load->view('ventas/control', (array)$output ) ;
    }

    private function check_venta($datos){

        return false;
    }

    public function save()
    {   
        
        $validar_envio_cpe = 1;
        $return = array( 'estado_validacion' => true , 'estado' => false, 'msj' => '' , 'error'=> '' , 'idsave' => '' , 'enlace' => '');  

        //VALIDACIONES
        $this->load->model('get_data');
        $idserie = '16';
        $serie = $this->get_data->get_correlativo($idserie);
        $validar_envio_cpe =  $serie->correlativo_solo;

        //Guardar movimiento
        $this->db->trans_start();//Inicio de transaccion        

        try{

        //$this->load->model('get_data');
        $idserie = $this->input->post('idserie');
        $serie = $this->get_data->get_correlativo($idserie);//Obtener correlativo actual

        $this->load->model('comprobante');  
        $tipo_comprobante = $this->comprobante->get_tipo_serie($idserie);//Obtener tipo de comprobante         
        $this->comprobante->update_serie_correlativo($idserie,'correlativo','correlativo + 1' );//idserie , campo , valor //Actualizar el correlativo de la serie 

        $this->comprobante->update_serie_correlativo($this->id_guia_remision,'correlativo','correlativo + 1' );//

        //VALIDACIONES
        $total_venta = ($this->input->post('subtotales') - $this->input->post('descuento')+$this->input->post('igv'));

        $ruc_cliente = $this->input->post('ruc_cliente');
        $dni_cliente = $this->input->post('dni_cliente');        
        $nro_documento_cliente  ;

        if( $tipo_comprobante == $this->id_factura){
            if( $ruc_cliente != '00000000000' AND strlen($ruc_cliente) == 11 ){
                $nro_documento_cliente = $ruc_cliente;
            }else{
                $return['error']= 'ERROR: Número de RUC incorrecto.';
                $return['estado_validacion'] = false;     
            }

        }else if( $total_venta >= 700 ){

            if( $tipo_comprobante == $this->id_boleta){

                if( $ruc_cliente != '00000000000' AND strlen($ruc_cliente) == 11 ){
                    $nro_documento_cliente = $ruc_cliente;
                }else if($dni_cliente != '00000000' AND strlen($dni_cliente) == 8){
                    $nro_documento_cliente = $dni_cliente;                          
                }else{
                    $return['error']= 'ERROR: Debe ingresar número de documento valido para ventas mayores a 700 soles.';
                    $return['estado_validacion'] = false;
                }
            }

        }else{

            if( strlen($ruc_cliente) == 11 ){
                $nro_documento_cliente = $ruc_cliente;
            }else if( strlen($dni_cliente) == 8){
                 $nro_documento_cliente = $dni_cliente;     
            }else{
                $nro_documento_cliente = '000000000';  
            }

        }

        if(!$return['estado_validacion']){
            print json_encode($return);
            die('');
        }  

        //Guardar Venta
        $this->load->model('venta');        
        $this->venta->tipo_comprobante_idtipo_comprobante = $tipo_comprobante; 
        $this->venta->nro_documento = $serie->correlativo;   

        $this->venta->nro_guia_remision = $this->input->post('nro_guia_remision');   
        
        $this->venta->cliente_documento = $nro_documento_cliente;// ($tipo_comprobante == $this->id_factura ) ? $this->input->post('ruc_cliente') : $this->input->post('dni_cliente');    
        $this->venta->insert_venta();
        $idventa = $this->db->insert_id();

        //Guardar Detalle Venta
        $this->load->model('det_venta');   
        $this->det_venta->venta_idventa = $idventa;     
        $this->det_venta->insert_det_venta();
    
        //Modificar Stock
        $this->load->model('stock');       
        $this->stock->modificar_stock("-");

        //Agregar Kardex
        $this->load->model('kardex');      
        $this->kardex->codmotivo = $idventa;
        $this->kardex->insert_kardex("S","venta");
	
        
        $return['idsave'] = $idventa;
        if ($this->db->trans_status() === FALSE) { 

            $error = $this->db->error();
            $return['msj'] = $return['error']= 'ERROR: Operaciones de Base de Datos. <br>'.$error['message'];           
            $this->db->trans_rollback(); 

        } else {

            if($validar_envio_cpe){//Envio exitoso obligatorio para crear una venta
		
                //Envio CPE
                $tipo_envio="generar_comprobante";   
                $result_envio_cpe = $this->primer_envio_cpe($tipo_envio,$idventa);

                if($result_envio_cpe['respuesta'] == 'ok' && $this->db->trans_status() !== FALSE){
                    $this->db->trans_commit();
                    $return['estado']=true;
                }else{
                    $error = $this->db->error();
                    $this->db->trans_rollback(); 
                    $return['msj'] =  $return['error'] = 'ERROR: Envio electrónico. <br>- '.$result_envio_cpe['mensaje'].'<br>- '.$error['message'];  
                }

            }else{
                //Si no se desea validar el envio a cpe, $validar_envio_cp=0
                $this->db->trans_commit(); 
                $return['estado']=true;
            }
                
        }

        } catch (Exception $e) {

            $this->db->trans_rollback(); 
            $return['error']= "ERROR: Controller > ".$e->getMessage(); 
        }

       

        print json_encode($return);
            
    }

    public function anular()
    {   

        $return = array('estado' => false, 'msj' => '' , 'error'=> '' , 'idsave' => '' , 'enlace' => '');        
        $idventa = $this->input->get('idventa');

        $this->load->model('venta');  
        $venta = $this->venta->venta_byId($idventa);
        
        if($venta['estado'] == 'vigente'){     

            //Guardar movimiento
            $this->db->trans_start();//Inicio de transaccion         

            //Modificar Stock
            $this->load->model('stock');       
            $this->stock->devolver_stock('venta anulada',$idventa);

            //Agregar Kardex
            $this->load->model('kardex');      
            $this->kardex->insert_devolucion_kardex('venta',$idventa);

            //Anular Venta
            $this->venta->anular_venta($idventa);
            
            //anular detalle ventas
            $this->load->model('det_venta');    
            $this->det_venta->anular_det_venta($idventa);

            //if($venta['idtipo_comprobante'] == $this->id_factura || $venta['idtipo_comprobante'] == $this->id_boleta ){}

            if ($this->db->trans_status() === FALSE) {

                $error = $this->db->error();
                $return['msj'] = $return['error']= "ERROR: Operaciones de Base de Datos. <br>".$error['message'];  
                $this->db->trans_rollback(); 

            }else{        

                //Envio anulacion CPE
                $tipo_envio="generar_anulacion";   
                $result_envio_cpe = $this->primer_envio_cpe($tipo_envio,$idventa); 

                if($result_envio_cpe['respuesta'] == 'ok' && $this->db->trans_status() !== FALSE){

                    $this->db->trans_commit();
                    //$this->db->trans_rollback(); 
                    $return['estado'] = true;
                    $return['msj'] = 'VENTA ANULADA'; 

                }else{

                    $error = $this->db->error();
                    $this->db->trans_rollback(); 
                    $return['msj'] = $return['error'] = 'ERROR: Envio electrónico. <br>- '.$result_envio_cpe['mensaje'].'<br>- '.$error['message'];    
                }
            }

        }else{

            $return['msj'] = $return['error'] = 'ERROR: La venta debe estar vigente.'; 
        } 

        print json_encode($return);
        
    }

    //--PEDIDOS AJAX
     
    public function control_ventas()
    {   
        $fecha = $this->input->get('fecha');
        $this->load->model('venta');
        print json_encode($this->venta->control($fecha));
    }

  
    public function print_venta()
    {   

        $this->load->model('venta');
        $this->load->model('det_venta');
        $this->load->helper('calculo');

        $orientation = 'P' ;
        $format = 'A4';
        if(isset($_GET['orientation'])){
            $orientation = $this->input->get('orientation');

        }
        if(isset($_GET['format'])){
            $format = $this->input->get('format');
        }
        
        $venta = $this->venta->get_print_venta($this->input->get('idventa'));
        $det_venta = $this->det_venta->det_venta_byId($this->input->get('idventa'));

        if( count($venta) == 0 OR count($det_venta) == 0 ){ die('NO SE ENCONTRARON RESULTADOS'); exit();};

        //$orientation = ())? $this->input->get('orientation') : 'P' ;
        //$format = (isset($this->input->get('format')))? $this->input->get('format'):'A4';
        
        $nombrepdf  = $venta['Comprobante'].'_'.$venta['Nro_documento'];

        //echo '<pre>';print_r($venta);print_r($det_venta);exit();
        $this->load->library('Pdf_comprobantes');
        $pdf = new Pdf_comprobantes($orientation, 'mm', $format , true, 'UTF-8', false);

        $pdf->tipo_documento = $venta['Comprobante'];
        $pdf->nro_documento = $venta['Nro_documento'];       

        //Parametros del PDF
        $pdf->SetTitle($nombrepdf);
        
        $pdf->SetAutoPageBreak(TRUE, 10);
        $pdf->AddPage();

        $pdf->add_imagen();

        $data_usuario_receptor = array('Cliente' => array($venta['Cliente'],'4'),
                                  'RUC' => array($venta['RUC/DNI'],'1'),
                                  'Dirección' => array($venta['Direccion'],'5')  );
        $pdf->receptor_data( 5 ,$data_usuario_receptor);
        
        $vendedor_fijo = "Edinson Jimenez" ;//$venta['Usuario']
        $data_comprobante = array('Emitido' => array($venta['Fecha'],'1'),
                                  'Tienda' => array($venta['Tienda'],'1'),  
                                  'Vendedor' => array($vendedor_fijo,'1'),
                                  'Condición pago' => array($venta['condicion_pago'],'1'),
                                  'Forma pago' => array($venta['forma_pago'],'1'), 
                                  'Moneda' => array($venta['moneda'],'1'),
                                  'Observacion' => array($venta['Observacion'],'3')  );
        $pdf->comprobante_data( 3 ,$data_comprobante);

        $width_cols = array(  array('Descripcion',40 ,'L') , array('Cant.',20, 'R'),array('P.unit',20,'R'),array('Subtotal',20,'R') );
        $pdf->data_table( $det_venta ,  $width_cols, true);       
        
      


        $cod_documento_client = '0';
        if( strlen($venta['RUC/DNI']) == 11 ){
            $cod_documento_client = '6';
        }else if( strlen($venta['RUC/DNI']) ==8) {
            $cod_documento_client = '1';
        }


        $comprobante = explode("-", $venta['Nro_documento']); // Separamos serie de correlativo

        $data_resumen = $this->ruc.'|'.$venta['codsunat'].'|'.$comprobante[0].'|'.$comprobante[1].'|'.$venta['Igv'].'|'.$venta['Total'].'|'.$venta['Fecha'].'|'.$cod_documento_client.'|'.$venta['RUC/DNI'].'|' ;
        $qr_code = $this->crear_qr($data_resumen); 
	
	$descripcion_moneda = strtoupper($venta['moneda']);
        $simbolo_moneda =  $descripcion_moneda == 'DOLARES' ? '$ ' : 'S/ ';

        /*$data_footer = array('monto_letra' => array( 'texto' => num_to_letras($venta['Total'])),
                            'monto' => array('op_importe'=>$venta['Total'] ,  'op_gravada'=>$venta['Subtotal'] , 'op_igv'=>$venta['Igv'] , ) ,
                            'qr_code' =>  $qr_code   );
        $pdf->data_table_footer( 'monto_venta',  $data_footer , 'msj');*/
	$data_footer = array('monto_letra' => array( 'texto' => num_to_letras($venta['Total'],'',$descripcion_moneda) ),
                            'monto' => array('op_importe'=>$simbolo_moneda.$venta['Total'] ,  
                                            'op_gravada'=>$simbolo_moneda.$venta['Subtotal'] , 
                                            'op_igv'=>$simbolo_moneda.$venta['Igv'] ) ,
                            'qr_code' =>  $qr_code   );

        $pdf->data_table_footer( 'monto_venta',  $data_footer , 'msj');


         /* Limpiamos la salida del búfer y lo desactivamos */
        ob_end_clean();
        $pdf->Output($nombrepdf.'.pdf', 'I');
    }

     public function print_guia()
    {   

        $this->load->model('venta');
        $this->load->model('det_venta');
        $this->load->helper('calculo');

        $orientation = 'P' ;
        $format = 'A4';
        if(isset($_GET['orientation'])){
            $orientation = $this->input->get('orientation');

        }
        if(isset($_GET['format'])){
            $format = $this->input->get('format');
        }
        
        $venta = $this->venta->get_print_venta($this->input->get('idventa'));
        $det_venta = $this->det_venta->det_venta_byId($this->input->get('idventa'));

        if( count($venta) == 0 OR count($det_venta) == 0 ){ die('NO SE ENCONTRARON RESULTADOS'); exit();};

        //$orientation = ())? $this->input->get('orientation') : 'P' ;
        //$format = (isset($this->input->get('format')))? $this->input->get('format'):'A4';
        
        $nombrepdf  = 'Guia_'.$venta['Nro_guia'];

        //echo '<pre>';print_r($venta);print_r($det_venta);exit();
        $this->load->library('Pdf_comprobantes');
        $pdf = new Pdf_comprobantes($orientation, 'mm', $format , true, 'UTF-8', false);

        $pdf->tipo_documento = 'Guia Remisión';
        $pdf->nro_documento = $venta['Nro_guia'];       

        //Parametros del PDF
        $pdf->SetTitle($nombrepdf);
        
        $pdf->SetAutoPageBreak(TRUE, 10);
        $pdf->AddPage();

        $data_usuario_receptor = array('Cliente' => array($venta['Cliente'],'4'),
                                  'RUC/DNI' => array($venta['RUC/DNI'],'1'),
                                  'Dirección' => array($venta['Direccion'],'5')  );
        $pdf->receptor_data( 5 ,$data_usuario_receptor);

        
        $data_comprobante = array('Fecha inicio traslado ' => array($venta['Fecha'],'2'),
                                  'Documento referencia' => array($venta['Nro_documento'],'1'),   
                                  'Punto de partida' => array($this->direccion,'3'),
                                  'Punto de llegada' => array($venta['Direccion'],'3')  );

        $pdf->comprobante_data( 3 ,$data_comprobante);

        $width_cols = array(  array('Descripcion',40 ,'L') , array('Cant.',20, 'R'),array('P.unit',20,'R'),array('Subtotal',20,'R') );
        $pdf->data_table( $det_venta ,  $width_cols, true);       
        

       
        $qr_code = '';

        
        $data_footer = array(/*'monto_letra' => array( 'texto' => num_to_letras($venta['Total'])),
                            'monto' => array('op_importe'=>$venta['Total'] ,  'op_gravada'=>$venta['Subtotal'] , 'op_igv'=>$venta['Igv'] , ) ,
                            'qr_code' =>  $qr_code  */
                            'monto_letra' => array( 'texto' => num_to_letras($venta['Total'])),
                            'monto' => array('op_importe'=>$venta['Total']),
                            'observacion' => array( 'texto' =>  '')  
                            );
        $pdf->data_table_footer( 'pie_guia',  $data_footer , 'msj');


         /* Limpiamos la salida del búfer y lo desactivamos */
        ob_end_clean();
        $pdf->Output($nombrepdf.'.pdf', 'I');
    }


    //---------CPE

    ///--------------------------CPE--------------------


   public function primer_envio_cpe($tipo_envio,$idventa) {

        //Parametros
        /*$idventa = $this->input->get('id');
        $tipo_envio = $this->input->get('tipo_envio');   */     
        $data_json = array();
        $this->load->library('Facturalaya');
        $envio_cpe = new Facturalaya();

        //Creamos el array con la data del cpe
        if($tipo_envio == "generar_comprobante"){
            $data_json = $envio_cpe->generar_comprobante_json($idventa, $this);
            if (isset($data_json["numero_comprobante"])) {
                $data_json["numero_comprobante"] = $data_json["numero_comprobante"] * 1;
            }
            
        }else if($tipo_envio =="generar_anulacion"){
            $data_json = $envio_cpe->generar_anulacion_json($idventa, $this);
        }

        //print_r($data_json);die();
	
	

        //Validación - Problema con data del cpe
        if(count($data_json) &&  $data_json != 'null' ){
            $result = $envio_cpe->builder_cpe($data_json, $tipo_envio);
            
        }else{
            $result = array('mensaje'=>'No se encontro datos del comprobante.', 
                'respuesta'=> "error", 'titulo'=> "error",'cod_sunat'=> "error local" , 'codigo'=> "error local");            
        }

        $this->load->model('envio_cpe');
        $data_json["tipo_envio"] = $tipo_envio;
        $data_json["idmaster"] = $idventa;	
	
        
        if($result['respuesta'] == 'ok' &&  $result['cod_sunat'] == 0 ){ //Guardar
            $this->envio_cpe->set_envio($data_json, $result);//guardar registro envio
            $this->envio_cpe->update_envio_cpe($idventa, $tipo_envio);//Actualizar en tabla venta


        }else{ //No debería ingresar, ya que toda venta debe ser enviada  
	    
            $result['codigo'] = isset($result['codigo'])? $result['codigo']:$result['cod_sunat'];
            $result['mensaje'] = isset($result['mensaje'])? $result['mensaje']:$result['msj_sunat'];
            $this->envio_cpe->set_error($data_json, $result);//guardar registro error envio
            $result['respuesta'] = 'error';

        }

        return $result;

    }
    

    //CREAMOS EL CODIGO QR PARA LA FACTURA ELECTRONICA
    public function crear_qr($data_text, $name_file='qr_code'){

        $this->load->library('ciqrcode');

        $codeContents = $data_text;
        $tempDir = 'public/qr_code/';//EXAMPLE_TMP_SERVERPATH; 
        $fileName = $name_file.'.jpg'; 
        $outerFrame = 0; //tamaño de borde
        $pixelPerPoint = 6; //tamaño de los pixeles por point
        $jpegQuality = 150;  // calidad de imagen

        // generating frame 
        $frame = QRcode::text($codeContents, false, QR_ECLEVEL_M); 
        // rendering frame with GD2 (that should be function by real impl.!!!) 
        $h = count($frame); 
        $w = strlen($frame[0]); 
         
        $imgW = $w + 2*$outerFrame; 
        $imgH = $h + 2*$outerFrame; 
         
        $base_image = imagecreate($imgW, $imgH); 
         
        $col[0] = imagecolorallocate($base_image,255,255,255); // BG, white  
        $col[1] = imagecolorallocate($base_image,0,0,0);     // FG, Black 

        imagefill($base_image, 0, 0, $col[0]); 

        for($y=0; $y<$h; $y++) { 
            for($x=0; $x<$w; $x++) { 
                if ($frame[$y][$x] == '1') { 
                    imagesetpixel($base_image,$x+$outerFrame,$y+$outerFrame,$col[1]);  
                } 
            } 
        } 
         
        // saving to file 
        $target_image = imagecreate($imgW * $pixelPerPoint, $imgH * $pixelPerPoint); 
        imagecopyresized( 
            $target_image,  
            $base_image,  
            0, 0, 0, 0,  
            $imgW * $pixelPerPoint, $imgH * $pixelPerPoint, $imgW, $imgH 
        ); 
        imagedestroy($base_image); 
        imagejpeg($target_image, $tempDir.$fileName, $jpegQuality); 
        imagedestroy($target_image); 

        $path = $tempDir.$fileName;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);

        //$qr_code= 'data:image/' . $type . ';base64,' . base64_encode($data);
        //echo '<img src="' . $qr_code . '">';
        $qr_code= base64_encode($data);
        return $qr_code;
    }

	

}
