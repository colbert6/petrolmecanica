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
        $this->metodo = 'Lista Guias';//Siempre define las migagas de pan
        
        $this->load->library('grocery_CRUD');
        $this->load->js('assets/js/bootbox.min.js');
        $this->load->js('assets/myjs/groceryCRUD.js');
		$this->load->js('assets/myjs/guias.js');
        $crud = new grocery_CRUD();

        $crud->set_table('guia_remision');
        $crud->columns('fecha_comprobante','nro_documento', 'dir_partida', 'dir_destino');

        $crud->field_type('fecha_comprobante', 'datetime');

        $crud->add_action('Imprimir', '', base_url('guias/print_documento?idguia='),'fa fa-print imprimir');

        //$crud->unset_add_fields('texto','colaborador_idcolaborador', 'tienda_idtienda', 'fecha_creacion');
        //$crud->unset_edit_fields('colaborador_idcolaborador', 'tienda_idtienda', 'fecha_creacion');
        $crud->unset_delete();

        $crud->order_by('fecha_comprobante','desc');

        $output = $crud->render();
		
		$output->title = "<p>Generar guia ...</p> <input id='nro_comprobante_venta_generar_guia' placeholder='Num. comprobante venta' class=''> <input type='button' value='Generar nueva guia de remision' class='btn btn-info' onclick='referenciar_vista_para_crear_guia()'> ";
		
        $this->_init(true,true,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )
        $this->load->view('grocery_crud/basic_crud', (array)$output ) ;
        
    }

    public function add($nro_comprobante_venta = 'F001-1' )
    {
        
        $this->metodo = 'Nueva Guia Remisión';//Siempre define las migagas de pan

        $this->_init(true,false,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )

        $this->load->js('assets/myjs/genericos/calculos.js');//genericos
        $this->load->js('assets/myjs/genericos/get_data.js');//genericos
        $this->load->js('assets/myjs/genericos/set_data_up_level_2.js');//genericos
		$this->load->js('assets/myjs/guias.js');

        $this->load->js('assets/js/bootbox.min.js');

        //activación de teclas 
        //$this->load->js('assets/js/typeahead/typeahead.min.js');

        //Cargando modelos
		$this->load->model('venta');
		$this->load->model('det_venta');
		$this->load->model('almacen');
        $this->load->model('get_data');
		
		//Obtener información de la venta 
		$data_venta = $this->venta->get_data_venta_buscado_nro_comprobante($nro_comprobante_venta);
		$data_detalle_venta = $this->det_venta->get_data_venta_buscado_nro_comprobante($nro_comprobante_venta);
		$data_distrito_ubigeo = $this->get_data->get_data_ubigeo("distrito");
		
		if( count($data_venta)==0 OR count($data_detalle_venta)==0 OR count($data_distrito_ubigeo)==0 ){ die('NO SE ENCONTRARON RESULTADOS');};
		//print_r($data_detalle_venta1);exit();
		
        $output = array(
			'title' => 'Guia remisión', 
            'tiendas' => $this->almacen->get_tienda(),  
            'series' => $this->get_data->get_series(array( $this->id_guia_remision) ),
			'data_venta' =>  $data_venta,
            'data_detalle_venta' =>  $data_detalle_venta,
			'data_distrito_ubigeo' =>  $data_distrito_ubigeo
        ); 

        $this->load->view('guias/add', $output ) ;
    }

    public function save() {		
		
		//Preparación de datos de respuesta
			//estado_validacion => estado de las validaciones que se van realizando
			//estado => estado de toda la funcion
			//msj_success_true => Si "estado" = true, se muestra este valor
			//error => Si "estado" = false, se muestra este valor
		$return = array( 'estado_validacion' => true , 'estado' => false, 'msj_success_true' => '' , 'error'=> '' , 'idsave' => '' , 'enlace' => ''); 
		
		$mensaje_error = ''; //msj de error
		
		$this->db->trans_start();//Inicio de transaccion        
		
		try{
		
		//Obtener correlativo actual - para evitar problema de concurrencia
        $this->load->model('get_data');
        $idserie = $this->input->post('idserie');
        $serie = $this->get_data->get_correlativo($idserie); //obtener correlativo actualizado
		
		//Separar el correlativo de la serie, actualizando en la base de datos +1
        $this->load->model('comprobante');  
        $tipo_comprobante = $this->comprobante->get_tipo_serie($idserie);//Obtener tipo de comprobante         
        $this->comprobante->update_serie_correlativo($idserie,'correlativo','correlativo + 1' );//idserie , campo , valor 

        //Validaciones
		//--validar numero de caracteres segun el tipo de documento
		$tipo_documento_t = $this->input->post('id_tipo_documento_transporte');//6:RUC | 1:DNI
		$nro_documento_t =  $this->input->post('nro_documento_transporte'); //RUC: 11 caracteres | DNI (8 caracteres)
		
		$validar_ruc = ($tipo_documento_t==6 and strlen($nro_documento_t)==11);
		$validar_dni = ($tipo_documento_t==1 and strlen($nro_documento_t)==8);
		
		if( !($validar_ruc || $validar_dni) ){
			$mensaje_error = "RUC/DNI invalido. (".($tipo_documento_t).") (".($nro_documento_t).")" ;
			$return['estado_validacion'] = false;	
		}
		
		//CheckDie para las validaciones realizadas
        if(!$return['estado_validacion']){
			$this->db->trans_rollback();
			$return['error']= 'ERROR en VALIDACIONES :: '.$mensaje_error.".<br>";			
            print json_encode($return);
            die('');
        }		

        //Insert DB Guia
        $this->load->model('guia');        
        $this->guia->tipo_comprobante_idtipo_comprobante = $tipo_comprobante; 
		$this->guia->serie_comprobante_idserie_comprobante = $idserie; 
        $this->guia->nro_documento = $serie->correlativo;
        $result_guia_insert = $this->guia->insert();
        $idguia = $result_guia_insert["table_id"];
		
		//Insert DB documento_referencia_guia_remision 
        $this->load->model('documento_referencia_guia_remision');        
        $this->documento_referencia_guia_remision->guia_idguia_remision = $idguia; 
		$this->documento_referencia_guia_remision->id_motivotraslado = $this->input->post('id_motivotraslado'); 
		$result_documento_referencia_guia_insert =  $this->documento_referencia_guia_remision->insert();
		
		//Insert DB detalle_guia_remision 
		$this->load->model('detalle_guia_remision');        
        $this->detalle_guia_remision->guia_idguia_remision = $idguia; 
		$result_detalle_guia_insert = $this->detalle_guia_remision->insert();
		
		//CheckDie insert a DB
		if (!$result_guia_insert["status_script"] or !$result_documento_referencia_guia_insert["status_script"] or !$result_detalle_guia_insert["status_script"]) {		
			
			$mensaje_error .= $result_detalle_guia_insert['error_mensaje']."<br>".$result_documento_referencia_guia_insert['error_mensaje']."<br>".$result_guia_insert['error_mensaje']."<br>";
			$return['error']= 'ERROR en BASE DE DATOS :: '.$mensaje_error.".<br>";			
			$this->db->trans_rollback();
			print json_encode($return);
            die('');						
		}
		
		//Envio CPE a FACTURALAYA
		//-Obtener data guia (cabecera, detalle, cliente, documentos_referencia)
		$result_guia_get_format_cpe = $this->guia->get_format_cpe($idguia);				
		$result_documento_referencia_guia_get_format_cpe =  $this->documento_referencia_guia_remision->get_format_cpe($idguia);
		$result_documento_referencia_guia_get_format_cpe_cliente =  $this->documento_referencia_guia_remision->get_format_cpe_cliente($idguia);
		$result_detalle_guia_get_format_cpe = $this->detalle_guia_remision->get_format_cpe($idguia);
		
		//-Setear en formato array data obtenida
		$data_seteada_cpe = $result_guia_get_format_cpe;
		$data_seteada_cpe['cliente'] = $result_documento_referencia_guia_get_format_cpe_cliente;
		$data_seteada_cpe['docs_referencia'] = $result_documento_referencia_guia_get_format_cpe;
		$data_seteada_cpe['detalle'] = $result_detalle_guia_get_format_cpe;
		$data_seteada_cpe['numero_comprobante'] = $data_seteada_cpe['numero_comprobante'] * 1; //Casteo a int
		
		//-Invocar library
		$this->load->library('Facturalaya');
		$envio_cpe = new Facturalaya();
		$codigo_envio = "generar_guia_remision";
		
		//-Agregar data emisor
		$data_total_cpe = $envio_cpe->agregar_data_emisor($data_seteada_cpe);  
		
		//Solicitar data desde API 
		$result_curl = $envio_cpe->solicitar_respuesta_curl($data_total_cpe, $codigo_envio);

		//Cargar modelo de Envio_cpre para guardar los resultados de la rpta de API
		$this->load->model('envio_cpe');		
		$data_seteada_cpe["tipo_envio"] = $codigo_envio;
        $data_seteada_cpe["idmaster"] = $idguia;	
		
		//CheckDie respuesta de API FACTURALAYA
		if ( !($result_curl['respuesta']=='ok' && $result_curl['cod_sunat'] == 0) ) { 
			$this->db->trans_rollback();			
			$mensaje_error .= isset($result_curl['codigo'])? $result_curl['codigo']:$result_curl['cod_sunat'];
			$mensaje_error .= "<br>";
			$mensaje_error .= isset($result_curl['errores_curl'])? $result_curl['errores_curl']:$result_curl['mensaje'];
			
			$return['error']= 'ERROR en ENVIO SUNAT :: '.$mensaje_error.".<br>";
			$result['respuesta'] = 'error';			
			
			//Insert DB error_envio_electronico
			$this->envio_cpe->set_error($data_seteada_cpe, $result_curl);//guardar registro error envio
			
			print json_encode($return);
            die('');						
		}
		
		//Insert DB envio_electronico y update tabla venta|guia_remision
        $this->envio_cpe->set_envio($data_seteada_cpe, $result_curl);//guardar registro envio
        $this->envio_cpe->update_envio_cpe($idguia, $codigo_envio);//Actualizar en tabla venta
		
		//COMPLETAR TRANSACCION
		$this->db->trans_commit();//Para guardar la venta				
		$return['idsave'] = $idguia;
		$return['estado'] = true;
		
		$return['msj_success_true'] = '- GUIA DE REMISION GUARDADA -';
		print json_encode($return);
        die('');
					
        } catch (Exception $e) {

            $this->db->trans_rollback(); 
            $return['error']= "ERROR: Controller > ".$e->getMessage();
			print json_encode($return);
            die('');			
        }
        
    }  

	public function print_documento()
    {   
        $this->load->model('guia'); 
		$this->load->model('documento_referencia_guia_remision');     
		$this->load->model('detalle_guia_remision');

        //Get data de DB (cabecera, detalle, cliente, documentos_referencia)
        $data_guia = $this->guia->get_print_guia($this->input->get('idguia'));
        $data_det_guia = $this->detalle_guia_remision->get_print_guia($this->input->get('idguia'));
		//echo '<pre>'; print_r($data_det_guia);	exit();
		
		//CheckDie, si no hay data encontrado en DB 
        if( count($data_guia) == 0 OR count($data_det_guia) == 0 ){ die('NO SE ENCONTRARON RESULTADOS');};
        
		//Setear parametros
        $pdf_file_nombre  = 'Guia_'.$data_guia['Nro_documento_guia'];
		$orientation = isset($_GET['orientation'])? $this->input->get('orientation'):'P' ;
        $format = isset($_GET['format'])? $this->input->get('format'):'A4';
		
		//Inicializar la libreria
        $this->load->library('Pdf_comprobantes');
        $pdf = new Pdf_comprobantes($orientation, 'mm', $format , true, 'UTF-8', false);
	
		//Parametros del PDF
        $pdf->tipo_documento = 'Guia Remisión';
        $pdf->nro_documento = $data_guia['Nro_documento_guia'];

		//Construir PDF
        $pdf->SetTitle($pdf_file_nombre);
        
        $pdf->SetAutoPageBreak(TRUE, 10);
        $pdf->AddPage();

        $data_usuario_receptor = array(
								  'Fecha Comprobante' => array($data_guia['fecha_comprobante'],'1'),
								  '.' => array(".",'1'),
								  'RUC/DNI' => array($data_guia['cliente_numerodocumento'],'1'),
								  'Documento Referencia' => array($data_guia['numero_comprobante_referencia'],'1'),
								  'Cliente' => array($data_guia['cliente_nombre'],'2'),
								  'Dirección' => array($data_guia['cliente_direccion'],'2')
							);
        $pdf->receptor_data( 2 ,$data_usuario_receptor);

        
        $data_comprobante = array('Fecha Inicio Traslado ' => array($data_guia['fecha_traslado'],'1'),
								  '.' => array(".",'1'),
                                  'Motivo traslado' => array($data_guia['motivo_traslado'],'1'),   
								  'Modalidad traslado' => array($data_guia['modalidad_traslado'],'1'),   
								  'Transporte DNI/RUC' => array($data_guia['nro_documento_transporte'],'1'),   
								  'Transporte Nro Placa' => array($data_guia['transporte_nro_placa'],'1'),   
								  'Transporte Razon social' => array($data_guia['razon_social_transporte'],'2')
								);

        $pdf->comprobante_data( 2 ,$data_comprobante);
		
		$peso = $data_guia['peso'];
		
		$dir_partida = $data_guia['dir_partida']." - ".$data_guia['partida_descripcion_ubigeo'];
		$dir_destino = $data_guia['dir_destino']." - ".$data_guia['destino_descripcion_ubigeo'];
		$data_ruta = array('Punto de partida' => array($dir_partida,'1'),
							'Punto de destino' => array($dir_destino,'1'),
							'Numero de Paquetes' => array($data_guia['numero_paquetes']." (Peso ".$peso.")" ,'1')

							);

        $pdf->comprobante_data( 1 ,$data_ruta);
		
        $width_cols = array(  array('Descripcion',50, 'L'), array('Codigo',15 ,'R'), array('Medida',15,'R'), array('Cantidad',10,'R'), array('Peso',10,'R') );
        $pdf->data_table( $data_det_guia ,  $width_cols, true);       
        
        $qr_code = '';		
        $data_footer = array('observacion' => array( 'texto' =>  $data_guia['nota']));
        $pdf->data_table_footer( 'pie_guia',  $data_footer , 'msj');
		
         
        ob_end_clean();/* Limpiamos la salida del búfer y lo desactivamos */
        $pdf->Output($pdf_file_nombre.'.pdf', 'I');
    }
    


}
