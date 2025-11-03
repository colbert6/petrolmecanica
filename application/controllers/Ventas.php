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

        $this->metodo = 'Listar ventas';//Siempre define las migagas de pan
        
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
        //$crud->add_action('Guia', '', base_url('ventas/print_guia?idventa='),'fa fa-bus guia');

        $crud->unset_add();
        $crud->unset_edit();
        $crud->unset_clone();
        $crud->unset_delete();

        $crud->order_by('fecha_creacion','desc');

        $output = $crud->render();

        $output->title = "Ventas :: <a href='".base_url('ventas/add')."'> Crear nueva venta</a>";

        $this->_init(true,true,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )
        $this->load->view('grocery_crud/basic_crud', (array)$output ) ;
        
    }

    public function add()
    {
        
        $this->metodo = 'Crear venta';//Siempre define las migagas de pan

        $this->_init(true,false,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )

        $this->load->js('assets/myjs/genericos/calculos.js');//genericos
        $this->load->js('assets/myjs/genericos/get_data.js');//genericos
        $this->load->js('assets/myjs/genericos/set_data_v2.js');//genericos
        $this->load->js('assets/myjs/movimientos.js');

        $this->load->js('assets/myjs/venta/ventas_crear.js');
        $this->load->js('assets/js/bootbox.min.js');

        $this->load->js('assets/js/shortcut.js');//activación de teclas 
        $this->load->js('assets/js/typeahead/typeahead.min.js');

        //Cargando modelos
        $this->load->model('cliente');
        $this->load->model('get_data');

        $output = array('cliente_base' => $this->cliente->get_cliente('idcliente',1) ); 
        $get_clientes = $this->load->view('get_data/clientes', $output,true) ;

        $output = array( 'onSelected' => 'add_detalle(obj);' ); //cuando se seleccione el valor
        $get_productos = $this->load->view('get_data/productos', $output,true) ;
		
		$serie_correlativo_guia = $this->get_data->get_series_correlativos("$this->id_guia_remision", "tipo_comprobante_idtipocomprobante" );
	
        $output = array( 
            'tiendas' => $this->get_data->get_tiendas(),  
			'tipo_moneda' => $this->get_data->get_tipos_monedas(),
            'condicion_pago' => $this->get_data->get_periodos_pagos(),
            'forma_pago' => $this->get_data->get_formas_pagos(False, '', 'idforma_pago desc'),			
            'series' => $this->get_data->get_comprobantes_series_correlativo(
			"$this->id_boleta, $this->id_factura", "tipo_comprobante_idtipocomprobante", 'tipo_comprobante_idtipocomprobante asc' ),
			
            'guia_remision' => $serie_correlativo_guia[0]['descripcion'], //correlativo actual de guia,
            'get_clientes' =>  $get_clientes,
            'get_productos' =>  $get_productos            
        ); 

        $this->load->view('ventas/add', $output ) ;
    }

	private function validar_guardado($nro_documento_cliente, $tipo_comprobante, $total_venta)
	{
		// Validaciones
		$cantidad_digitos_ruc = 11;
		$cantidad_digitos_dni = 8;
		$monto_limite_para_identificacion = 700.00;
		$array_documentos_dummy = array("00000000000", "99999999999", "00000000", "99999999");
		
		$return = array( 
			'estado' => true, 'mensaje' => '' 
		); 
		
        if( $tipo_comprobante == $this->id_factura){//validación para facturas
			if( in_array($nro_documento_cliente, $array_documentos_dummy) ){
                $return['mensaje']= 'ERROR: Número de documento incorrecto, cliente no identificado';
                $return['estado'] = false;     
            }
			if( strlen($nro_documento_cliente) != $cantidad_digitos_ruc ){
                $return['mensaje']= 'ERROR: Cantidad de digitos del documento incorrecto, RUC deben ser 11 digitos.';
                $return['estado'] = false;     
            }
        }else if( $total_venta >= $monto_limite_para_identificacion ){//validación para comprobantes mayores a limite
            if( $tipo_comprobante == $this->id_boleta){//validación para boletas

                if( in_array($nro_documento_cliente, $array_documentos_dummy)){
                    $return['mensaje']= "ERROR: Número de documento incorrecto, cliente no identificado para montos mayores a $monto_limite_para_identificacion soles.";
					$return['estado'] = false;
                }
				if( !in_array(strlen($nro_documento_cliente), array(8,11) ) ){                    
                    $return['mensaje']= "ERROR: Cantidad de digitos del documento incorrecto, para ventas mayores a $monto_limite_para_identificacion soles.";
                    $return['estado'] = false;
                }
            }
        }
		
		return $return;
	}

    public function save()  {	
		
		$return = array( 
			'estado' => false, 
			'mensaje' => '' , 
			'id_transaccion' => '' , 
			'enlace' => ''
		);  

        // Obtener parametros para crear venta - validar_envio_cpe
        $this->load->model('get_data');
		$serie_correlativo_envio_cpe = $this->get_data->get_series_correlativos(" 'E_CPE' ", "serie" );
		$validar_envio_cpe = $serie_correlativo_envio_cpe[0]['correlativo'];
		
		// Obtener parametros para crear venta - tipo_comprobante
		$this->load->model('comprobante');  
		$idserie = $this->input->post('idserie');//id serie de la venta
        $tipo_comprobante = $this->comprobante->get_tipo_serie($idserie); //Obtener tipo de comprobante 
		
		// Obtener parametros para crear venta - nro documento cliente

		$nro_documento_cliente = $this->input->post('ruc_cliente');
        if( $tipo_comprobante == $this->id_boleta){
            $nro_documento_cliente = $this->input->post('dni_cliente');
        }

		$total_venta = ($this->input->post('subtotales')-$this->input->post('descuento')+$this->input->post('igv'));
		
		// Validaciones de negocio
		$result_validacion = self::validar_guardado($nro_documento_cliente, $tipo_comprobante, $total_venta);
		if( $result_validacion['estado'] == false){ // No paso validacion
			$return['estado'] = $result_validacion['estado'];
			$return['mensaje'] = $result_validacion['mensaje'];
			print json_encode($return);
            die('');
		}		
		
		try{		
			// Guardar venta en Base de Datos
			$this->db->trans_start(); //Inicio de transaccion 
			
			$serie_correlativo_venta = $this->get_data->get_series_correlativos("$idserie", "idserie_comprobante");
			$correlativo_actual = $serie_correlativo_venta[0]['descripcion'];//Obtener serie + correlativo actual venta       

			//Guardar Venta
			$this->load->model('venta');        
			$this->venta->tipo_comprobante_idtipo_comprobante = $tipo_comprobante; 
			$this->venta->nro_documento = $correlativo_actual;   
			$this->venta->nro_guia_remision = "-";  
			$this->venta->cliente_documento = $nro_documento_cliente;    
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
			
			//Actualizar correlativo de la serie de la venta       
			$this->comprobante->update_serie_correlativo($idserie, 'correlativo', 'correlativo + 1' );//idserie , campo , valor 	
			
			$return['idsave'] = $idventa;
			if ($this->db->trans_status() == false) { // Validaciones de inserción
				$error = $this->db->error();
				$return['estado'] = false;
				$return['mensaje'] = 'ERROR: Fallo en peraciones de base de datos. <br> ('.$error['message'].') ';
                $this->db->trans_rollback();
				print json_encode($return);
				die('');				
			}
			
			if($validar_envio_cpe){//Flag para activar envio CPE
 
				$tipo_envio = "generar_comprobante";   
				$result_envio_cpe = $this->enviar_comprobante_proveedor_cpe($tipo_envio, $idventa);

				if($result_envio_cpe['respuesta'] == 'ok' && $this->db->trans_status() !== false){
					$this->db->trans_commit();
					$return['estado'] = true;
					$return['mensaje'] = 'VENTA GUARDADA <br> Envio comprobante electrónico EXITOSO';
				}else{
					$error = $this->db->error();
					$return['estado'] = false;
					$return['mensaje'] = 'ERROR en Envio comprobante electrónico. <br> INFO: <br>'.$result_envio_cpe['mensaje'].'';
                    //print_r($result_envio_cpe);
					$this->db->trans_rollback();


				}

			}else{
				//Si $validar_envio_cpe = 0, la venta NO incluye el envio CPE
				$this->db->trans_commit();
				$return['estado']=true;				
				$return['mensaje'] = 'VENTA GUARDADA <br> Envio comprobante electrónico PENDIENTE.';		
			} 

        } catch (Exception $e) {
			
            $this->db->trans_rollback(); 
			$return['mensaje'] = "ERROR: Error en codigo (".$e->getMessage().")";	
			$return['estado']=true;
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
                $result_envio_cpe = $this->enviar_comprobante_proveedor_cpe($tipo_envio,$idventa); 

                if($result_envio_cpe['respuesta'] == 'ok' && $this->db->trans_status() !== FALSE){

                    $this->db->trans_commit();
                    //$this->db->trans_rollback(); 
                    $return['estado'] = true;
                    $return['msj'] = 'VENTA ANULADA'; 

                }else{

                    $error = $this->db->error();
                    $this->db->trans_rollback(); 
                    $return['msj'] = $return['error'] = 'ERROR: Envio electrónico. <br>- '.$result_envio_cpe['mensaje'].'<br>- '.$error['message']; 
					$return['estado'] = false;					
                }
            }

        }else{

            $return['msj'] = $return['error'] = 'ERROR: La venta debe estar vigente.'; 
        } 

        print json_encode($return);
        
    }

    public function control()
    {

        $this->metodo = 'Control de ventas por día';//Siempre define las migagas de pan

        $this->load->js('assets/myjs/ventas_control.js');
        
        $output = array('title' => "<a href='".base_url('ventas/lista')."'> Ir a lista de ventas</a>");

        $this->_init(true,false,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )
        $this->load->view('ventas/control', (array)$output ) ;
    }
    
    //--PEDIDOS AJAX
     
    public function control_ventas()
    {   
        $fecha = $this->input->get('fecha');
        $this->load->model('venta');
        print json_encode($this->venta->control($fecha));
    }

    public function generar_cuotas_print($data_venta){

        $Idperiodo_pago = $data_venta['Idperiodo_pago'];
        $Nro_cuotas = $data_venta['Nro_cuotas'];
        $Total = $data_venta['Total'];
        $Fecha = $data_venta['Fecha'];

        $detalle_cuotas = array();

        if($Idperiodo_pago == '2'){

            $nro_cuotas = $nro_cuotas_cont = $Nro_cuotas; 
            $monto_venta = $Total;
            $monto_cuota_promedio = round($monto_venta / $nro_cuotas, 2);
            $monto_amortizado = 0;

            $fecha_vencimiento = $Fecha;            

            while ( $nro_cuotas_cont >= 1) {
                $fecha_vencimiento = date("Y-m-d", strtotime($fecha_vencimiento."+ 1 month")); 

                $monto_cuota = $monto_cuota_promedio;
                if($nro_cuotas_cont > 1){  // la cuota 1 debe ser igual al restante de lo que no se ha amortizado               
                    $monto_amortizado += $monto_cuota_promedio;
                }else{
                    $monto_cuota = $monto_venta - $monto_amortizado ;
                }
                
                $detalle_cuotas[] = array('fecha_vencimiento' => $fecha_vencimiento,  'monto_cuota'=> $monto_cuota);
                $nro_cuotas_cont--;
            }

            $print_cuotas = "<br> Monto Pendiente Pago: (".$Total.")  / Nro Cuotas (".$Nro_cuotas.") : <br>";
            foreach ($detalle_cuotas as $key => $value) {
                $monto_cuota = number_format($value['monto_cuota'], 2, '.', '');
                $print_cuotas .= " (".$value['fecha_vencimiento'].") ".$monto_cuota." / ";

            }

        }

        

        return $print_cuotas;
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

        $print_cuota = $this->generar_cuotas_print($venta);
        
        $vendedor_fijo = "Edinson Jimenez" ;//$venta['Usuario']
        $data_comprobante = array('Emitido' => array($venta['Fecha'],'1'),
                                  'Tienda' => array($venta['Tienda'],'1'),  
                                  'Vendedor' => array($vendedor_fijo,'1'),
                                  'Condición pago' => array($venta['condicion_pago'],'1'),
                                  'Forma pago' => array($venta['forma_pago'],'1'), 
                                  'Moneda' => array($venta['moneda'],'1'),
                                  'Observacion' => array($venta['Observacion'].$print_cuota,'3')  );
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

     public function print_guia() //copia de venta
    {   
        return "";
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

   public function enviar_comprobante_proveedor_cpe( $tipo_envio, $idventa) {

        //Parametros
        /*$idventa = $this->input->get('id');
        $tipo_envio = $this->input->get('tipo_envio');   */     
        $data_json = array();
        $this->load->library('Facturalaya');
        $envio_cpe = new Facturalaya();

        switch ($tipo_envio) {
            case "generar_comprobante":
                $data_json = $envio_cpe->generar_comprobante_json($idventa, $this);
                if (isset($data_json["numero_comprobante"])) {
                    $data_json["numero_comprobante"] = $data_json["numero_comprobante"] * 1;
                }
                break;
            
            case "generar_anulacion":
                $data_json = $envio_cpe->generar_anulacion_json($idventa, $this);
                break;
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
		$cod_sunat = isset($result['cod_sunat'])? $result['cod_sunat']:999;
		$msj_sunat = isset($result['msj_sunat'])? $result['msj_sunat']:'error';
        $respuesta_sunat = isset($result['respuesta'])? $result['respuesta']:'error';
	
        
        if($respuesta_sunat == 'ok' &&  $cod_sunat == 0 ){ //Guardar
            $this->envio_cpe->set_envio($data_json, $result);//guardar registro envio
            $this->envio_cpe->update_envio_cpe($idventa, $tipo_envio);//Actualizar en tabla venta

            if ($tipo_envio == "generar_comprobante"){
                $sunat_files_down = [$result['ruta_xml'],$result['ruta_cdr']];
                $comprobante_name_file_sunat =  $data_json["serie_comprobante"].$data_json["numero_comprobante"];

                // Carpeta de destino en tu proyecto (asegúrate que tenga permisos de escritura)
                $destino = FCPATH . 'public/cpe_sunat/';  // FCPATH apunta a la carpeta public/ en CodeIgniter 4
                if (!is_dir($destino)) {
                    mkdir($destino, 0777, true);
                }

                foreach ($sunat_files_down as $url) {
                    // Obtener nombre de archivo de la URL

                    $nombreArchivo = $comprobante_name_file_sunat.basename(parse_url($url, PHP_URL_PATH)).".zip";
                    $rutaLocal = $destino . $nombreArchivo;

                    // Descargar archivo
                    $archivo = fopen($rutaLocal, 'w+');
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_FILE, $archivo);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                    curl_exec($ch);
                    curl_close($ch);
                    fclose($archivo);

                    #echo "Archivo guardado: " . $url . "<br>";
                }
            }


        }else{ //No debería ingresar, ya que toda venta debe ser enviada  
			
            $result['mensaje'] = is_array($result)? implode(",", $result):$msj_sunat;
            $this->envio_cpe->set_error($data_json, $result);//guardar registro error envio
            $result['respuesta'] = 'error';
            $result['codigo'] = $cod_sunat;
            
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
