<?php 
class Det_venta extends CI_Model {

    public $venta_idventa;
    public $producto_idproducto;
    public $tienda_idtienda;
    public $descripcion;
    public $cantidadxpresentacion;
    public $precioxpresentacion;
    public $cantidad;
    public $descuento;
    public $subtotal;
    public $estado;

    
    public function insert_det_venta()
    {   
        $cont = count($this->input->post('idprod'));

        for ($i=0; $i < $cont ; $i++) { 
            # code..
            $this->producto_idproducto =  $_POST['idprod'][$i];
            $this->tienda_idtienda = $this->input->post('tienda');

            $producto = $this->db->get_where('producto', array('idproducto' => $_POST['idprod'][$i] ))->row(); 
            $this->idpresentacion = $producto->presentacion_minima;
            $this->tipo_producto = $producto->tipo;
            $this->descripcion = $_POST['prodtext'][$i];
            $this->cantidadxpresentacion = 1;

            $this->precioxpresentacion = $_POST['prec'][$i];

            $this->cantidad = $_POST['cant'][$i];

            $this->descuento = 0;
            $this->subtotal = $_POST['prec'][$i] * $_POST['cant'][$i];
            
            $this->estado = 'Activo';

            $this->db->insert('detalle_venta', $this);
        }


    }

    public function det_venta_byId($idventa)
    {        
        $this->db->select("
                        
                        detv.descripcion as descripcion,
                        detv.cantidad as cantidad,
                        detv.precioxpresentacion as 'precio',
                        detv.subtotal as subtotal    ");
        $this->db->from('detalle_venta detv');    

        $this->db->where('detv.venta_idventa',$idventa);
        $query = $this->db->get();

        return $query->result_array();
    }
    

    public function anular_det_venta($idventa)
    {   
        $this->db->set('estado', 'Inactivo');
        $this->db->where('venta_idventa',$idventa);
        $this->db->update('detalle_venta');
    }

    public function cpe_detventa($idventa)
    {    
        $this->db->select('
            detv.producto_idproducto as codigo_interno,
            detv.descripcion  as descripcion,
            ""  as codigo_producto_sunat,
            IF(tipo_producto = "servicio", "ZZ" ,"NIU" ) as unidad_de_medida,
            ROUND(detv.cantidad)  as cantidad,
            ROUND(detv.precioxpresentacion/ 1.18, 2) as valor_unitario,
            "01" as codigo_tipo_precio, 
            detv.precioxpresentacion as precio_unitario,
            "10" as codigo_tipo_afectacion_igv, 
            ROUND( ROUND(detv.precioxpresentacion * detv.cantidad,2) / 1.18, 2) as total_base_igv, 
            18 as porcentaje_igv,
            ROUND(detv.precioxpresentacion * detv.cantidad,2) - ROUND( ROUND(detv.precioxpresentacion * detv.cantidad,2) / 1.18, 2) as total_igv,
            ROUND(detv.precioxpresentacion * detv.cantidad,2) - ROUND( ROUND(detv.precioxpresentacion * detv.cantidad,2) / 1.18, 2) as total_impuestos,
            ROUND( ROUND(detv.precioxpresentacion * detv.cantidad,2) / 1.18, 2) as total_valor_item,
            ROUND(detv.precioxpresentacion * detv.cantidad,2) as total_item
        ');

        $this->db->from('detalle_venta detv');   
        $this->db->join('producto pp', 'pp.idproducto = detv.producto_idproducto');
        $this->db->where('detv.venta_idventa',$idventa);

        $query = $this->db->get();
        $det_venta_cpe = [];
        
        foreach ($query->result_array() as $key => $item) {
            $det_venta_cpe[] = [
                "codigo_interno" => $item['codigo_interno'],
                "descripcion" => $item['descripcion'],
                "codigo_producto_sunat" => $item['codigo_producto_sunat'],
                "unidad_de_medida" => $item['unidad_de_medida'],
                "cantidad" => (int)$item['cantidad'],
                "valor_unitario" => (float)$item['valor_unitario'],
                "codigo_tipo_precio" => $item['codigo_tipo_precio'],
                "precio_unitario" => (float)$item['precio_unitario'],
                "codigo_tipo_afectacion_igv" => $item['codigo_tipo_afectacion_igv'],
                "total_base_igv" => (float)$item['total_base_igv'],
                "porcentaje_igv" => (int)$item['porcentaje_igv'],
                "total_igv" => (float)$item['total_igv'],
                "total_impuestos" => (float)$item['total_impuestos'],
                "total_valor_item" => (float)$item['total_valor_item'],
                "total_item" => (float)$item['total_item']
            ];
        }
        
        return $det_venta_cpe;
    }
	
	public function get_data_venta_buscado_nro_comprobante($nro_comprobante_venta)
    {	
		$this->db->select(" det_vent.* ");
        $this->db->from('venta vent');
		$this->db->join('detalle_venta det_vent', 'vent.idventa = det_vent.venta_idventa');
        $this->db->where('vent.nro_documento',$nro_comprobante_venta);
        $query = $this->db->get();
		
		return $query->result_array();
	}

}

