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

          1 AS ITEM_DET,
          IF(tipo_producto = "servicio", "ZZ" ,"NIU" ) as UNIDAD_MEDIDA_DET,
          "01" as PRECIO_TIPO_CODIGO,
          "10" as COD_TIPO_OPERACION_DET,
          ROUND(detv.cantidad)  as CANTIDAD_DET,
          detv.precioxpresentacion  as PRECIO_DET,
          ROUND((ROUND(detv.precioxpresentacion, 2) - ROUND(detv.precioxpresentacion/1.18, 2)) * detv.cantidad, 2) as IGV_DET,
          "0" as ICBPER_DET,
          "0" as ISC_DET,
          ROUND(detv.precioxpresentacion / 1.18, 2) as PRECIO_SIN_IGV_DET,
          TRUNCATE(ROUND(detv.precioxpresentacion / 1.18, 2) * detv.cantidad,2) as IMPORTE_DET,
          detv.producto_idproducto as "CODIGO_DET",
          detv.descripcion  as "DESCRIPCION_DET",
          "no" as DESCUENTO_ITEM,
          "0" as PORCENTAJE_DESCUENTO,
          "0" as MONTO_DESCUENTO,
          "00" as CODIGO_DESCUENTO

        ');

        $this->db->from('detalle_venta detv');   
        $this->db->join('producto pp', 'pp.idproducto = detv.producto_idproducto');
        $this->db->where('detv.venta_idventa',$idventa);

        $query = $this->db->get();
        $det_venta_cpe = $query->result_array();
        $tam_det_venta_cpe = count($det_venta_cpe);

        for ($i=0; $i < $tam_det_venta_cpe; $i++) { 
          $det_venta_cpe[$i]['ITEM_DET'] = $i + 1;
        }

        return $det_venta_cpe;
    }

}

