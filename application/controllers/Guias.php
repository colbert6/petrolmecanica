<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guias extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->controller = 'Guias_remision';
        $this->load->library('grocery_CRUD');
    }

    public function lista()
    {
        $this->metodo = 'Lista Guias';

        $this->load->library('grocery_CRUD');
        $this->load->js('assets/js/bootbox.min.js');
        $this->load->js('assets/myjs/groceryCRUD.js');
        $this->load->js('assets/myjs/guias.js');
        $crud = new grocery_CRUD();

        $crud->set_table('guia_remision');
        $crud->columns('fecha_comprobante', 'nro_documento', 'dir_partida', 'dir_destino');

        $crud->field_type('fecha_comprobante', 'datetime');

        $crud->add_action('Imprimir', '', base_url('guias/print_documento?idguia='), 'fa fa-print imprimir');

        $crud->unset_delete();
        $crud->order_by('fecha_comprobante', 'desc');

        $output = $crud->render();

        $output->title = "<p>Generar guia ...</p> <input id='nro_comprobante_venta_generar_guia' placeholder='Num. comprobante venta' class=''> <input type='button' value='Generar nueva guia de remision' class='btn btn-info' onclick='referenciar_vista_para_crear_guia()'> ";

        $this->_init(true, true, true);
        $this->load->view('grocery_crud/basic_crud', (array) $output);
    }

    public function add($nro_comprobante_venta = 'F001-1')
    {
        $this->metodo = 'Nueva Guia Remisión';

        $this->_init(true, false, true);

        $this->load->js('assets/myjs/genericos/calculos.js');
        $this->load->js('assets/myjs/genericos/get_data.js');
        $this->load->js('assets/myjs/genericos/set_data_up_level_2.js');
        $this->load->js('assets/myjs/guias.js');
        $this->load->js('assets/js/bootbox.min.js');

        $this->load->model('venta');
        $this->load->model('det_venta');
        $this->load->model('almacen');
        $this->load->model('get_data');

        $data_venta          = $this->venta->get_data_venta_buscado_nro_comprobante($nro_comprobante_venta);
        $data_detalle_venta  = $this->det_venta->get_data_venta_buscado_nro_comprobante($nro_comprobante_venta);
        $data_distrito_ubigeo = $this->get_data->get_data_ubigeo("distrito");

        if (count($data_venta) == 0 || count($data_detalle_venta) == 0 || count($data_distrito_ubigeo) == 0) {
            die('NO SE ENCONTRARON RESULTADOS');
        }

        $output = array(
            'title'               => 'Guia remisión',
            'tiendas'             => $this->almacen->get_tienda(),
            'series'              => $this->get_data->get_series(array($this->id_guia_remision)),
            'data_venta'          => $data_venta,
            'data_detalle_venta'  => $data_detalle_venta,
            'data_distrito_ubigeo' => $data_distrito_ubigeo,
        );

        $this->load->view('guias/add', $output);
    }

    public function save()
    {
        $return = array('estado_validacion' => true, 'estado' => false, 'msj_success_true' => '', 'error' => '', 'idsave' => '', 'enlace' => '');
        $mensaje_error = '';

        $this->db->trans_start();

        try {

            // Correlativo
            $this->load->model('get_data');
            $idserie = $this->input->post('idserie');
            $serie   = $this->get_data->get_correlativo($idserie);

            $this->load->model('comprobante');
            $tipo_comprobante = $this->comprobante->get_tipo_serie($idserie);
            $this->comprobante->update_serie_correlativo($idserie, 'correlativo', 'correlativo + 1');

            // Validar documento de transporte
            $tipo_documento_t = $this->input->post('id_tipo_documento_transporte');
            $nro_documento_t  = $this->input->post('nro_documento_transporte');
            $validar_ruc = ($tipo_documento_t == 6 && strlen($nro_documento_t) == 11);
            $validar_dni = ($tipo_documento_t == 1 && strlen($nro_documento_t) == 8);

            if (!($validar_ruc || $validar_dni)) {
                $mensaje_error = "RUC/DNI invalido. ({$tipo_documento_t}) ({$nro_documento_t})";
                $return['estado_validacion'] = false;
            }

            if (!$return['estado_validacion']) {
                $this->db->trans_rollback();
                $return['error'] = 'ERROR en VALIDACIONES :: ' . $mensaje_error . '.<br>';
                print json_encode($return);
                return;
            }

            // Insert guia
            $this->load->model('guia');
            $this->guia->tipo_comprobante_idtipo_comprobante   = $tipo_comprobante;
            $this->guia->serie_comprobante_idserie_comprobante = $idserie;
            $this->guia->nro_documento                         = $serie->correlativo;
            $result_guia_insert = $this->guia->insert();
            $idguia = $result_guia_insert['table_id'];

            // Insert documento_referencia
            $this->load->model('documento_referencia_guia_remision');
            $this->documento_referencia_guia_remision->guia_idguia_remision = $idguia;
            $this->documento_referencia_guia_remision->id_motivotraslado    = $this->input->post('id_motivotraslado');
            $result_docref_insert = $this->documento_referencia_guia_remision->insert();

            // Insert detalle
            $this->load->model('detalle_guia_remision');
            $this->detalle_guia_remision->guia_idguia_remision = $idguia;
            $result_detalle_insert = $this->detalle_guia_remision->insert();

            if (!$result_guia_insert['status_script'] || !$result_docref_insert['status_script'] || !$result_detalle_insert['status_script']) {
                $mensaje_error .= $result_detalle_insert['error_mensaje'] . '<br>' . $result_docref_insert['error_mensaje'] . '<br>' . $result_guia_insert['error_mensaje'] . '<br>';
                $return['error'] = 'ERROR en BASE DE DATOS :: ' . $mensaje_error . '.<br>';
                $this->db->trans_rollback();
                print json_encode($return);
                return;
            }

            // Obtener data para CPE
            $data_guia    = $this->guia->get_format_cpe($idguia);
            $data_cliente = $this->documento_referencia_guia_remision->get_format_cpe_cliente($idguia);
            $data_docrefs = $this->documento_referencia_guia_remision->get_format_cpe($idguia);
            $data_detalle = $this->detalle_guia_remision->get_format_cpe($idguia);

            $data_guia['cliente']         = $data_cliente;
            $data_guia['docs_referencia'] = $data_docrefs;
            $data_guia['detalle']         = $data_detalle;
            $data_guia['idmaster']        = $idguia;
            $data_guia['tipo_envio']      = 'generar_guia';

            // Formatear y enviar via FacturaloPeru
            $this->load->library('FacturaloPeru');
            $fp         = new FacturaloPeru();
            $data_json  = $fp->formatear_guia_estructura($data_guia, $idguia);
            $result_cpe = $fp->builder_cpe($data_json, 'generar_guia');

            $this->load->model('envio_cpe');

            if ($result_cpe['respuesta_curl'] != 'ok') {
                $this->db->trans_rollback();
                $return['error'] = 'ERROR en ENVIO SUNAT (curl) :: ' . json_encode($result_cpe) . '.<br>';
                $this->envio_cpe->set_error($data_guia, $result_cpe);
                print json_encode($return);
                return;
            }

            if (!$result_cpe['success']) {
                $this->db->trans_rollback();
                $return['error'] = 'ERROR en ENVIO SUNAT :: ' . json_encode($result_cpe) . '.<br>';
                $this->envio_cpe->set_error($data_guia, $result_cpe);
                print json_encode($return);
                return;
            }

            // Guardar resultado
            $this->envio_cpe->set_envio($data_guia, $result_cpe);
            $this->envio_cpe->update_envio_cpe($idguia, 'generar_guia_remision', $result_cpe['data']['external_id']);

            $this->db->trans_commit();

            $return['idsave']           = $idguia;
            $return['estado']           = true;
            $return['msj_success_true'] = '- GUIA DE REMISION GUARDADA -';
            print json_encode($return);

        } catch (Exception $e) {
            $this->db->trans_rollback();
            $return['error'] = 'ERROR: Controller > ' . $e->getMessage();
            print json_encode($return);
        }
    }

    public function print_documento()
    {
        $this->load->model('guia');
        $this->load->model('documento_referencia_guia_remision');
        $this->load->model('detalle_guia_remision');

        $data_guia     = $this->guia->get_print_guia($this->input->get('idguia'));
        $data_det_guia = $this->detalle_guia_remision->get_print_guia($this->input->get('idguia'));

        if (count($data_guia) == 0 || count($data_det_guia) == 0) {
            die('NO SE ENCONTRARON RESULTADOS');
        }

        $pdf_file_nombre = 'Guia_' . $data_guia['Nro_documento_guia'];
        $orientation     = isset($_GET['orientation']) ? $this->input->get('orientation') : 'P';
        $format          = isset($_GET['format']) ? $this->input->get('format') : 'A4';

        $this->load->library('Pdf_comprobantes');
        $pdf = new Pdf_comprobantes($orientation, 'mm', $format, true, 'UTF-8', false);

        $pdf->tipo_documento = 'Guia Remisión';
        $pdf->nro_documento  = $data_guia['Nro_documento_guia'];

        $pdf->SetTitle($pdf_file_nombre);
        $pdf->SetAutoPageBreak(TRUE, 10);
        $pdf->AddPage();

        $data_usuario_receptor = array(
            'Fecha Comprobante'   => array($data_guia['fecha_comprobante'], '1'),
            '.'                   => array('.', '1'),
            'RUC/DNI'             => array($data_guia['cliente_numerodocumento'], '1'),
            'Documento Referencia' => array($data_guia['numero_comprobante_referencia'], '1'),
            'Cliente'             => array($data_guia['cliente_nombre'], '2'),
            'Dirección'           => array($data_guia['cliente_direccion'], '2'),
        );
        $pdf->receptor_data(2, $data_usuario_receptor);

        $data_comprobante = array(
            'Fecha Inicio Traslado' => array($data_guia['fecha_traslado'], '1'),
            '.'                     => array('.', '1'),
            'Motivo traslado'       => array($data_guia['motivo_traslado'], '1'),
            'Modalidad traslado'    => array($data_guia['modalidad_traslado'], '1'),
            'Transporte DNI/RUC'    => array($data_guia['nro_documento_transporte'], '1'),
            'Transporte Nro Placa'  => array($data_guia['transporte_nro_placa'], '1'),
            'Transporte Razon social' => array($data_guia['razon_social_transporte'], '2'),
        );
        $pdf->comprobante_data(2, $data_comprobante);

        $peso       = $data_guia['peso'];
        $dir_partida = $data_guia['dir_partida'] . ' - ' . $data_guia['partida_descripcion_ubigeo'];
        $dir_destino = $data_guia['dir_destino'] . ' - ' . $data_guia['destino_descripcion_ubigeo'];

        $data_ruta = array(
            'Punto de partida'  => array($dir_partida, '1'),
            'Punto de destino'  => array($dir_destino, '1'),
            'Numero de Paquetes' => array($data_guia['numero_paquetes'] . ' (Peso ' . $peso . ')', '1'),
        );
        $pdf->comprobante_data(1, $data_ruta);

        $width_cols = array(
            array('Descripcion', 50, 'L'),
            array('Codigo', 15, 'R'),
            array('Medida', 15, 'R'),
            array('Cantidad', 10, 'R'),
            array('Peso', 10, 'R'),
        );
        $pdf->data_table($data_det_guia, $width_cols, true);

        $qr_code = '';
        if (!empty($data_guia['url_sunat_guia'])) {
            $this->load->library('Qr_comprobante');
            $qr_code = $this->qr_comprobante->crear($data_guia['url_sunat_guia'], 'url_sunat_guia');
        }

        $data_footer = array(
            'observacion' => array('texto' => $data_guia['nota']),
            'qr_code'     => $qr_code,
        );
        $pdf->data_table_footer('pie_guia', $data_footer, 'msj');

        ob_end_clean();
        $pdf->Output($pdf_file_nombre . '.pdf', 'I');
    }

}
