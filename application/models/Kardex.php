<?php 
class Kardex extends CI_Model {

    public $producto_idproducto;
    public $tienda_idtienda;
    public $idpresentacion;
    public $cantidaxpresentacion;
    public $precioxpresentacion;
    public $cantidad;
    public $fecha_hora;
    public $tipo_movimiento;
    public $motivo;
    public $codmotivo;
    public $estado;

    
    public function insert_kardex($movimiento,$motivo="")
    {   
        // DATOS DE MOVIMIENTO
        if($movimiento == "E"){
            $tipo_movimiento = 'entrada';
        }else if($movimiento == "S"){
             $tipo_movimiento = 'salida';
        }
        // DATOS DE MOTIVO
        if($motivo=="compra"){
            $pc_actual = $this->input->post('prec_c_act');
        }else if($motivo=="venta"){
            $pc_actual = $this->input->post('prec');
        }else{
            $pc_actual = $this->input->post('prec');
        }
        
        
        $cont = count($this->input->post('idprod'));

        for ($i=0; $i < $cont ; $i++) { 
            # code..
            $this->producto_idproducto =  $_POST['idprod'][$i];
            $this->tienda_idtienda = $this->input->post('tienda');

            $producto = $this->db->get_where('producto', array('idproducto' => $_POST['idprod'][$i] ))->row(); 
            $this->idpresentacion = $producto->presentacion_minima;
            $this->descripcion = $_POST['prodtext'][$i];
            $this->cantidaxpresentacion = 1;

            $this->precioxpresentacion = $pc_actual[$i] ;

            $this->cantidad =  $_POST['cant'][$i];

            $this->fecha_hora = date('Y-m-d H:i:s');
            $this->tipo_movimiento = $tipo_movimiento;
            $this->motivo = $motivo;

            $stock = $this->db->get_where('stock', array('producto_idproducto' => $_POST['idprod'][$i],'tienda_idtienda' => $this->input->post('tienda')  ))->row();
            $this->stock_actual = $stock->stock_almacen;
            $this->estado = 'Activo';

            $this->db->insert('kardex', $this);
        }


        //return  $this->db->insert('venta', $this);
    }

    public function insert_devolucion_kardex($tipo , $id)
    {   
        $lista_producto =  array();
        
        if($tipo=='venta'){
            $lista_producto = $this->db->get_where('detalle_venta', array('venta_idventa' =>$id,'estado' =>'Activo'))->result();
            $tipo_movimiento = 'entrada';
            $motivo = 'venta anulada';
        }

        foreach ($lista_producto as $key => $value) {


            $this->producto_idproducto = $value->producto_idproducto;
            $this->tienda_idtienda =  $value->tienda_idtienda;

            $producto = $this->db->get_where('producto', array('idproducto' => $value->producto_idproducto ))->row(); 
            $this->idpresentacion = $producto->presentacion_minima;
            $this->descripcion = $value->descripcion;
            $this->cantidaxpresentacion = 1;

            $this->precioxpresentacion = $value->precioxpresentacion ;

            $this->cantidad = $value->cantidad;

            $this->fecha_hora = date('Y-m-d H:i:s');
            $this->tipo_movimiento = $tipo_movimiento;
            $this->motivo = $motivo;

            $stock = $this->db->get_where('stock', array('producto_idproducto' => $value->producto_idproducto,'tienda_idtienda' => $value->tienda_idtienda  ))->row();
            $this->stock_actual = $stock->stock_almacen;
            $this->estado = 'Activo';

            $this->db->insert('kardex', $this);  
        }
    }

}

