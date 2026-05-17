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

    public function builder_cpe($data, $tipo_envio)
    {
        $rutas = [
            'generar_comprobante' => self::BASE_URL . '/documents',
            'generar_anulacion'   => self::BASE_URL . '/voided',
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
