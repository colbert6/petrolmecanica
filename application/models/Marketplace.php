<?php 
class Marketplace extends CI_Model {

   public function get_lista_producto( $parametros )
    {       
        $this->db->select("pro.idproducto as id_producto,  pro.codbarras as codbarra, CONCAT(cat.nombre,' ',mar.nombre,' ',pro.nombre,' ',pres.abreviatura ) as nombre_producto ");
        $this->db->from('producto as  pro');
        $this->db->join('marca as mar', 'mar.idmarca = pro.marca_idmarca');
        $this->db->join('categoria as cat', 'cat.idcategoria = pro.categoria_idcategoria');
        $this->db->join("unidad_medida as med","med.producto_idproducto = pro.idproducto AND med.presentacion_idpresentacion = pro.presentacion_minima AND med.estado = 'Activo' ", 'left');
        $this->db->join('presentacion as pres', 'pres.idpresentacion = pro.presentacion_minima');
        $this->db->where('pro.estado','Activo');
        

        if ( $parametros['order_by'] != '' ) {
            $this->db->order_by( $parametros['order_by'] );
        } else {
            $this->db->order_by('cat.nombre','asc');    
        }

        if ( $parametros['limit'] != '' ) {
            $this->db->limit( $parametros['limit'] );
        }

        if ( $parametros['like'] != '' ) {
            $this->db->like( "CONCAT(cat.nombre,' ',mar.nombre,' ',pro.nombre,' ',pres.abreviatura )",$parametros['like'] );
        }

        $query = $this->db->get();
        return $query->result();
    } 
   
    

}

