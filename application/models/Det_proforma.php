<?php 
class Det_proforma extends CI_Model {

    public $proforma_idproforma;
    public $producto_idproducto;
    public $tienda_idtienda;
    public $descripcion;
    public $cantidadxpresentacion;
    public $precioxpresentacion;
    public $cantidad;
    public $descuento;
    public $subtotal;
    public $estado;

    
    public function insert_det_proforma()
    {   
        $cont = count($this->input->post('idprod'));

        for ($i=0; $i < $cont ; $i++) { 
            # code..
            $this->producto_idproducto =  $_POST['idprod'][$i];
            $this->tienda_idtienda = 1;

            $producto = $this->db->get_where('producto', array('idproducto' => $_POST['idprod'][$i] ))->row(); 
            $this->presentacion_idpresentacion = $producto->presentacion_minima;
            $this->idpresentacion = $producto->presentacion_minima;
            $this->descripcion = $_POST['prodtext'][$i];
            $this->informacion = $_POST['info_item'][$i];
            $this->cantidadxpresentacion = 1;

            $this->precioxpresentacion = $_POST['prec'][$i];

            $this->cantidad = $_POST['cant'][$i];

            $this->descuento = 0;
            $this->subtotal = $_POST['prec'][$i] * $_POST['cant'][$i];
            
            $this->estado = 'Activo';

            $this->db->insert('detalle_proforma', $this);
        }


        //return  $this->db->insert('venta', $this);
    }

    public function get_print_det_proforma($idproforma)
    {        
        $this->db->select("
                        
                        detp.descripcion as descripcion,
                        detp.cantidad as cantidad,
                        detp.precioxpresentacion as 'precio',
                        detp.subtotal as subtotal    ");
        $this->db->from('detalle_proforma detp');    

        $this->db->where('detp.proforma_idproforma',$idproforma);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_print_det_proforma_info($idproforma)
    {        
        $this->db->select("
                        
                        detp.descripcion as descripcion,
                        detp.cantidad as cantidad,
                        detp.precioxpresentacion as 'precio',
                        detp.informacion as info,
                        detp.subtotal as subtotal    ");
        $this->db->from('detalle_proforma detp');    

        $this->db->where('detp.proforma_idproforma',$idproforma);
        $this->db->where('detp.informacion !=', '');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_exportar_det_proforma($idproforma)
    {        
        
         $this->db->select("
            pro.idproducto as idproducto, 
            CONCAT(pro.nombre) as producto, 
            detp.precioxpresentacion as precio_venta,
            detp.cantidad as cantproducto,
            detp.subtotal as subtotal
               ");
        $this->db->from('detalle_proforma as  detp');
        $this->db->join('producto as pro',"detp.producto_idproducto = pro.idproducto ","INNER");
        $this->db->where('detp.proforma_idproforma',$idproforma);
        
        $query = $this->db->get();

        return $query->result();
    }

    public function get_exportar_det_comprobante_como_proforma($idproforma)
    {        
        
         $this->db->select("
            pro.idproducto as idproducto, 
            CONCAT(pro.nombre) as producto, 
            detp.precioxpresentacion as precio_venta,
            detp.cantidad as cantproducto,
            detp.subtotal as subtotal
               ");
        $this->db->from('detalle_venta as  detp');
        $this->db->join('producto as pro',"detp.producto_idproducto = pro.idproducto ","INNER");
        $this->db->where('detp.venta_idventa',$idproforma);
        
        $query = $this->db->get();

        return $query->result();
    }


}

