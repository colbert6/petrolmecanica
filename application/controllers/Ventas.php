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

    private function calcular_cuotas($monto_total, $nro_cuotas, $fecha_inicio)
    {
        $cuotas              = array();
        $monto_cuota_promedio = round($monto_total / $nro_cuotas, 2);
        $monto_amortizado    = 0;
        $fecha_vencimiento   = $fecha_inicio;
        $contador            = $nro_cuotas;

        while ($contador >= 1) {
            $fecha_vencimiento = date("Y-m-d", strtotime($fecha_vencimiento . "+ 1 month"));

            if ($contador > 1) {
                $monto_cuota       = $monto_cuota_promedio;
                $monto_amortizado += $monto_cuota_promedio;
            } else {
                $monto_cuota = $monto_total - $monto_amortizado;
            }

            $cuotas[] = array('fecha' => $fecha_vencimiento, 'monto' => $monto_cuota);
            $contador--;
        }

        return $cuotas;
    }

    public function save()
    {
        $return = array(
            'estado'  => false,
            'mensaje' => '',
            'idsave'  => '',
            'enlace'  => ''
        );

        // Cargar modelos al inicio
        $this->load->model('get_data');
        $this->load->model('comprobante');
        $this->load->model('venta');
        $this->load->model('det_venta');
        $this->load->model('stock');
        $this->load->model('kardex');

        // Flag de envío CPE
        $serie_correlativo_envio_cpe = $this->get_data->get_series_correlativos(" 'E_CPE' ", "serie");
        $validar_envio_cpe = $serie_correlativo_envio_cpe[0]['correlativo'];

        // Tipo de comprobante y documento del cliente
        $idserie          = $this->input->post('idserie');
        $tipo_comprobante = $this->comprobante->get_tipo_serie($idserie);

        $nro_documento_cliente = $this->input->post('ruc_cliente');
        if ($tipo_comprobante == $this->id_boleta) {
            $nro_documento_cliente = $this->input->post('dni_cliente');
        }

        $total_venta = $this->input->post('subtotales') - $this->input->post('descuento') + $this->input->post('igv');

        // Validaciones de negocio
        $result_validacion = $this->validar_guardado($nro_documento_cliente, $tipo_comprobante, $total_venta);
        if ($result_validacion['estado'] == false) {
            $return['mensaje'] = $result_validacion['mensaje'];
            print json_encode($return);
            return;
        }

        try {
            $this->db->trans_start();

            $serie_correlativo_venta = $this->get_data->get_series_correlativos("$idserie", "idserie_comprobante");
            $correlativo_actual      = $serie_correlativo_venta[0]['descripcion'];

            // Guardar venta
            $this->venta->tipo_comprobante_idtipo_comprobante = $tipo_comprobante;
            $this->venta->nro_documento                       = $correlativo_actual;
            $this->venta->nro_guia_remision                   = "-";
            $this->venta->cliente_documento                   = $nro_documento_cliente;
            $this->venta->insert_venta();
            $idventa = $this->db->insert_id();

            // Guardar detalle de venta
            $this->det_venta->venta_idventa = $idventa;
            $this->det_venta->insert_det_venta();

            // Modificar stock
            $this->stock->modificar_stock("-");

            // Agregar kardex
            $this->kardex->codmotivo = $idventa;
            $this->kardex->insert_kardex("S", "venta");

            // Actualizar correlativo de la serie
            $this->comprobante->update_serie_correlativo($idserie, 'correlativo', 'correlativo + 1');

            $return['idsave'] = $idventa;

            if ($this->db->trans_status() === false) {
                $error            = $this->db->error();
                $return['mensaje'] = 'ERROR: Fallo en operaciones de base de datos. <br> (' . $error['message'] . ')';
                $this->db->trans_rollback();
                print json_encode($return);
                return;
            }

            if ($validar_envio_cpe) {
                $result_envio_cpe = $this->enviar_comprobante_proveedor_cpe("generar_comprobante", $idventa);

                if ($result_envio_cpe['respuesta'] == 'ok' && $this->db->trans_status() !== false) {
                    $this->db->trans_commit();
                    $return['estado']  = true;
                    $return['mensaje'] = 'VENTA GUARDADA <br> Envio comprobante electrónico EXITOSO';
                } else {
                    $return['estado']  = false;
                    $return['mensaje'] = 'ERROR en Envio comprobante electrónico. <br> INFO: <br>' . $result_envio_cpe['mensaje'];
                    $this->db->trans_rollback();
                }
            } else {
                $this->db->trans_commit();
                $return['estado']  = true;
                $return['mensaje'] = 'VENTA GUARDADA <br> Envio comprobante electrónico PENDIENTE.';
            }

        } catch (Exception $e) {
            $this->db->trans_rollback();
            $return['estado']  = false;
            $return['mensaje'] = 'ERROR: Error en código (' . $e->getMessage() . ')';
        }

        print json_encode($return);
    }

    public function anular()
    {
        $return = array('estado' => false, 'msj' => '', 'error' => '');

        $idventa = $this->input->get('idventa');

        $this->load->model('venta');
        $this->load->model('stock');
        $this->load->model('kardex');
        $this->load->model('det_venta');

        $venta = $this->venta->venta_byId($idventa);

        if ($venta['estado'] != 'vigente') {
            $return['msj'] = $return['error'] = 'ERROR: La venta debe estar vigente.';
            print json_encode($return);
            return;
        }

        $this->db->trans_start();

        $this->stock->devolver_stock('venta anulada', $idventa);
        $this->kardex->insert_devolucion_kardex('venta', $idventa);
        $this->venta->anular_venta($idventa);
        $this->det_venta->anular_det_venta($idventa);

        if ($this->db->trans_status() === false) {
            $error = $this->db->error();
            $return['msj'] = $return['error'] = 'ERROR: Operaciones de Base de Datos. <br>' . $error['message'];
            $this->db->trans_rollback();
            print json_encode($return);
            return;
        }

        $result_envio_cpe = $this->enviar_comprobante_proveedor_cpe('generar_anulacion', $idventa);

        if ($result_envio_cpe['respuesta'] == 'ok' && $this->db->trans_status() !== false) {
            $this->db->trans_commit();
            $return['estado'] = true;
            $return['msj']    = 'VENTA ANULADA';
        } else {
            $error = $this->db->error();
            $this->db->trans_rollback();
            $return['msj'] = $return['error'] = 'ERROR: Envio electrónico. <br>- ' . $result_envio_cpe['mensaje'] . '<br>- ' . $error['message'];
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

    public function generar_cuotas_print($data_venta)
    {
        $print_cuotas = '';

        if ($data_venta['Idperiodo_pago'] == '2') {
            $cuotas       = $this->calcular_cuotas($data_venta['Total'], $data_venta['Nro_cuotas'], $data_venta['Fecha']);
            $print_cuotas = "<br> Monto Pendiente Pago: ({$data_venta['Total']}) / Nro Cuotas ({$data_venta['Nro_cuotas']}) : <br>";

            foreach ($cuotas as $cuota) {
                $monto_cuota   = number_format($cuota['monto'], 2, '.', '');
                $print_cuotas .= " ({$cuota['fecha']}) {$monto_cuota} / ";
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
        $this->load->library('Qr_comprobante');
        $qr_code = $this->qr_comprobante->crear($data_resumen);
	
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

    //---------CPE

    public function enviar_comprobante_proveedor_cpe($tipo_envio, $idventa)
    {
        $this->load->library('FacturaloPeru');
        $this->load->model('venta');
        $this->load->model('det_venta');

        $envio_cpe_fp  = new FacturaloPeru();
        $this_response = array('respuesta' => 'error');

        $data_json = $this->preparar_datos_cpe($tipo_envio, $idventa, $envio_cpe_fp);

        if ($data_json === null) {
            $this_response['mensaje'] = 'El tipo de envio de comprobante no definido.';
            return $this_response;
        }

        if (empty($data_json)) {
            $this_response['mensaje'] = 'No se encontro datos del comprobante en la base de datos.';
            return $this_response;
        }

        $result_builder_cpe = $envio_cpe_fp->builder_cpe($data_json, $tipo_envio);

        if ($result_builder_cpe['respuesta_curl'] != 'ok') {
            $this_response['mensaje'] = 'Error en respuesta curl. <br>' . json_encode($result_builder_cpe);
            $this_response['detalle'] = $result_builder_cpe;
            return $this_response;
        }

        if (!$result_builder_cpe['success']) {
            $this_response['mensaje'] = 'Error en respuesta de proveedor. <br>' . json_encode($result_builder_cpe);
            $this_response['detalle'] = $result_builder_cpe;
            return $this_response;
        }

        $this->guardar_resultado_cpe($data_json, $result_builder_cpe, $idventa, $tipo_envio);
        $this_response['respuesta'] = 'ok';

        return $this_response;
    }

    private function preparar_datos_cpe($tipo_envio, $idventa, $envio_cpe_fp)
    {
        switch ($tipo_envio) {
            case 'generar_comprobante':
                $data_venta    = $this->venta->cpe_venta($idventa);
                $data_detventa = $this->det_venta->cpe_detventa($idventa);
                $detalle_cuotas = array();

                if ($data_venta['nro_cuotas'] > 1) {
                    $cuotas_base = $this->calcular_cuotas($data_venta['total_venta'], $data_venta['nro_cuotas'], $data_venta['fecha_de_emision']);
                    foreach ($cuotas_base as $cuota) {
                        $detalle_cuotas[] = array('fecha' => $cuota['fecha'], 'monto' => $cuota['monto'], 'codigo_tipo_moneda' => 'PEN');
                    }
                }

                unset($data_venta['nro_cuotas']);
                return $envio_cpe_fp->formatear_venta_estructura($data_venta, $data_detventa, $idventa, $detalle_cuotas);

            case 'generar_anulacion':
                $data_venta = $this->venta->cpe_venta_anulacion($idventa);
                return $envio_cpe_fp->formatear_anulacion_venta_estructura($data_venta, $idventa);

            default:
                return null;
        }
    }

    private function guardar_resultado_cpe($data_json, $result_builder_cpe, $idventa, $tipo_envio)
    {
        $this->load->model('envio_cpe');

        $data_json['idmaster']   = $idventa;
        $data_json['tipo_envio'] = $tipo_envio;
        unset($result_builder_cpe['data']['qr']); // tamaño excesivo para guardar en bd

        $this->envio_cpe->set_envio($data_json, $result_builder_cpe);
        $this->envio_cpe->update_envio_cpe($idventa, $tipo_envio, $result_builder_cpe['data']['external_id']);

        if ($tipo_envio === 'generar_comprobante') {
            $archivos = [
                $result_builder_cpe['data']['filename'] . '.xml' => $result_builder_cpe['links']['xml'],
                $result_builder_cpe['data']['filename'] . '.zip' => $result_builder_cpe['links']['cdr'],
            ];
            $this->descargar_archivos_sunat($archivos);
        }
    }

    private function descargar_archivos_sunat($archivos)
    {
        $ruta_destino = FCPATH . 'public/cpe_sunat/';
        if (!is_dir($ruta_destino)) {
            mkdir($ruta_destino, 0777, true);
        }

        foreach ($archivos as $nombre => $url) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $contenido   = curl_exec($ch);
            $codigo_http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($codigo_http === 200) {
                file_put_contents($ruta_destino . $nombre, $contenido);
            }
        }
    }
    
}
