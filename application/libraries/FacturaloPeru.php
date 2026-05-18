<?php

class FacturaloPeru {

    const BASE_URL = 'https://petrolmecanica.nubox360.com/api';
    const TOKEN    = 'enBLG3Jub2kf7CaRJ2KUAHoLUnckT3WJ59RTfAhGGF7GWm1iWT';
    const TIMEOUT  = 30;

    public function formatear_venta_estructura($row_venta, $row_detventa, $idventa, $cuotas = array())
    {
        $data = [
            "serie_documento"            => $row_venta['serie_documento'],
            "numero_documento"           => $row_venta['numero_documento'],
            "fecha_de_emision"           => $row_venta['fecha_de_emision'],
            "hora_de_emision"            => $row_venta['hora_de_emision'],
            "codigo_tipo_operacion"      => $row_venta['codigo_tipo_operacion'],
            "codigo_tipo_documento"      => $row_venta['codigo_tipo_documento'],
            "codigo_tipo_moneda"         => $row_venta['codigo_tipo_moneda'],
            "fecha_de_vencimiento"       => $row_venta['fecha_de_vencimiento'],
            "numero_orden_de_compra"     => $row_venta['numero_orden_de_compra'],
            "codigo_condicion_de_pago"   => $row_venta['codigo_condicion_de_pago'],

            "datos_del_cliente_o_receptor" => [
                "codigo_tipo_documento_identidad"      => (string) $row_venta['codigo_tipo_documento_identidad'],
                "numero_documento"                     => $row_venta['numero_documento_cliente'],
                "apellidos_y_nombres_o_razon_social"   => $row_venta['apellidos_y_nombres_o_razon_social'],
                "codigo_pais"                          => $row_venta['codigo_pais'],
                "ubigeo"                               => $row_venta['ubigeo'],
                "direccion"                            => $row_venta['direccion'],
                "correo_electronico"                   => $row_venta['correo_electronico'],
                "telefono"                             => $row_venta['telefono'],
            ],

            "totales" => [
                "total_exportacion"            => (float) $row_venta['total_exportacion'],
                "total_operaciones_gravadas"   => (float) $row_venta['total_operaciones_gravadas'],
                "total_operaciones_inafectas"  => (float) $row_venta['total_operaciones_inafectas'],
                "total_operaciones_exoneradas" => (float) $row_venta['total_operaciones_exoneradas'],
                "total_operaciones_gratuitas"  => (float) $row_venta['total_operaciones_gratuitas'],
                "total_igv"                    => (float) $row_venta['total_igv'],
                "total_impuestos"              => (float) $row_venta['total_impuestos'],
                "total_valor"                  => (float) $row_venta['total_valor'],
                "total_venta"                  => (float) $row_venta['total_venta'],
            ],

            "items"                => $row_detventa,
            "informacion_adicional" => $row_venta['informacion_adicional'],
        ];

        if (!empty($cuotas)) {
            $data['cuotas'] = $cuotas;
        }

        return $data;
    }

    public function formatear_anulacion_venta_estructura($row_venta, $idventa)
    {
        return [
            "fecha_de_emision_de_documentos" => $row_venta['fecha_emision'],
            "documentos" => [
                [
                    "external_id"      => $row_venta['external_id'],
                    "motivo_anulacion" => $row_venta['motivo_anulacion'],
                ],
            ],
        ];
    }

    public function formatear_guia_estructura($data_guia, $idguia)
    {
        $cliente = $data_guia['cliente'];
        $doc_ref = $data_guia['docs_referencia'][0];
        $detalle = $data_guia['detalle'];

        $datos_emisor = [
            'codigo_pais'                 => 'PE',
            'ubigeo'                      => '060101',
            'direccion'                   => 'PJ. LA AMISTAD NRO. 145 BAR. MOLLEPAMPA',
            'correo_electronico'          => 'petrolmecanica.jc@gmail.com',
            'telefono'                    => '978833002',
            'codigo_del_domicilio_fiscal' => '0000',
        ];

        $data = [
            'serie_documento'              => $data_guia['serie_comprobante'],
            'numero_documento'             => '#',
            'fecha_de_emision'             => $data_guia['fecha_comprobante'],
            'hora_de_emision'              => date('H:i:s'),
            'codigo_tipo_documento'        => '09',
            'datos_del_emisor'             => $datos_emisor,
            'datos_del_cliente_o_receptor' => [
                'codigo_tipo_documento_identidad'    => (string) $cliente['cliente_tipodocumento'],
                'numero_documento'                   => $cliente['cliente_numerodocumento'],
                'apellidos_y_nombres_o_razon_social' => $cliente['cliente_nombre'],
                'nombre_comercial'                   => $cliente['cliente_nombre'],
                'codigo_pais'                        => $cliente['cliente_pais'],
                'ubigeo'                             => $cliente['cliente_codigoubigeo'],
                'direccion'                          => $cliente['cliente_direccion'],
                'correo_electronico'                 => '',
                'telefono'                           => '',
            ],
            'observaciones'               => $data_guia['nota'],
            'codigo_modo_transporte'      => $data_guia['id_modalidadtraslado'],
            'codigo_motivo_traslado'      => $data_guia['id_motivotraslado'],
            'descripcion_motivo_traslado' => $data_guia['motivo_traslado'],
            'fecha_de_traslado'           => $data_guia['fecha_traslado'],
            'codigo_de_puerto'            => $data_guia['id_codigopuerto'],
            'indicador_de_transbordo'     => false,
            'unidad_peso_total'           => 'KGM',
            'peso_total'                  => (float) $data_guia['peso'],
            'numero_de_bultos'            => (int) $data_guia['numero_paquetes'],
            'numero_de_contenedor'        => $data_guia['numero_contenedor'],
            'direccion_partida' => [
                'ubigeo'                      => $data_guia['id_ubigeo_partida'],
                'direccion'                   => $data_guia['dir_partida'],
                'codigo_del_domicilio_fiscal' => '0000',
            ],
            'direccion_llegada' => [
                'ubigeo'                      => $data_guia['id_ubigeo_destino'],
                'direccion'                   => $data_guia['dir_destino'],
                'codigo_del_domicilio_fiscal' => '0000',
            ],
            'items' => array_map(function ($item) {
                return [
                    'codigo_interno' => $item['CODIGO_PRODUCTO'],
                    'cantidad'       => (int) $item['CANTIDAD_DET'],
                ];
            }, $detalle),
            'documento_afectado' => [
                'serie_documento'       => $doc_ref['serie_comprobante'],
                'numero_documento'      => (string) $doc_ref['numero_comprobante'],
                'codigo_tipo_documento' => $doc_ref['id_tipodoc_electronico'],
            ],
        ];

        if ($data_guia['id_modalidadtraslado'] === '02') {
            $data['chofer'] = [
                'codigo_tipo_documento_identidad' => (string) $data_guia['id_tipo_documento_transporte'],
                'numero_documento'                => $data_guia['nro_documento_transporte'],
                'nombres'                         => $data_guia['nombres_chofer'],
                'apellidos'                       => $data_guia['apellidos_chofer'],
                'numero_licencia'                 => $data_guia['numero_licencia'],
            ];
            $data['numero_de_placa'] = $data_guia['transporte_nro_placa'];
        } else {
            $data['transportista'] = [
                'codigo_tipo_documento_identidad'    => (string) $data_guia['id_tipo_documento_transporte'],
                'numero_documento'                   => $data_guia['nro_documento_transporte'],
                'apellidos_y_nombres_o_razon_social' => $data_guia['razon_social_transporte'],
                'numero_mtc'                         => $data_guia['numero_mtc'],
            ];
        }

        return $data;
    }

    public function builder_cpe($data, $tipo_envio)
    {
        $rutas = [
            'generar_comprobante' => self::BASE_URL . '/documents',
            'generar_anulacion'   => self::BASE_URL . '/voided',
            'generar_guia'        => self::BASE_URL . '/dispatches',
        ];

        if (!isset($rutas[$tipo_envio])) {
            return array('mensaje' => 'El tipo de envio de comprobante no definido.');
        }

        return $this->send_cpe($data, $rutas[$tipo_envio]);
    }

    private function send_cpe($data, $ruta_url)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL            => $ruta_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => self::TIMEOUT,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => json_encode($data),
            CURLOPT_HTTPHEADER     => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . self::TOKEN,
            ),
        ));

        $response = curl_exec($curl);
        $error    = curl_error($curl);
        curl_close($curl);

        if ($error) {
            return array('respuesta_curl' => 'error', 'error_curl' => $error);
        }

        return array_merge(
            array('respuesta_curl' => 'ok'),
            json_decode($response, true)
        );
    }
}
