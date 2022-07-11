<?php 
class Get_data extends CI_Model {


    
    public function get_clientes($valor)
    {   
        $where_filtro = " ( cli.dni LIKE '{$valor}%' OR cli.ruc LIKE '{$valor}%' OR cli.razon_social LIKE '%{$valor}%' OR cli.nombre_comercial LIKE '%{$valor}%' ) ";

        //$query = $this->db->get('producto', 10);
        $this->db->select("cli.idcliente as idcliente, cli.dni, cli.ruc, cli.razon_social as razon_social, cli.nombre_comercial as nombre_comercial,  cli.direccion as direccion ");
        $this->db->from('cliente as cli');
        $this->db->where('cli.estado','Activo');
        $this->db->where($where_filtro);
        $this->db->order_by(' cli.razon_social ');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_proveedores($valor)
    {   
        $where_filtro = " ( pro.ruc LIKE '{$valor}%' OR pro.razon_social LIKE '%{$valor}%' OR pro.nombre_comercial LIKE '%{$valor}%' ) ";

        //$query = $this->db->get('producto', 10);
        $this->db->select("pro.idproveedor as idproveedor , pro.ruc, pro.razon_social as razon_social, pro.nombre_comercial as nombre_comercial,  pro.direccion as direccion ");
        $this->db->from('proveedor as pro');
        $this->db->where('pro.estado','Activo');
        $this->db->where($where_filtro);
        $this->db->order_by(' pro.razon_social ');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_cliente_document($tipo,$doc)
    {   
        $where_filtro = " ( cli.{$tipo} = '{$doc}' ) ";

        //$query = $this->db->get('producto', 10);
        $this->db->select("cli.idcliente as idcliente, cli.dni, cli.ruc, cli.razon_social as razon_social, cli.nombre_comercial as nombre_comercial,  cli.direccion as direccion ");
        $this->db->from('cliente as cli');
        $this->db->where('cli.estado','Activo');
        $this->db->where($where_filtro);
        $this->db->order_by(' cli.razon_social ');
        $query = $this->db->get();
        return $query->row();
    }

    public function get_productos($valor, $filtro = '')
    {   
        if( $filtro =='codbarras'){
            $where_filtro = " ( pro.codbarras = '{$valor}' ) ";
        }else{
            $where_filtro = " ( cat.nombre LIKE '%{$valor}%' OR mar.nombre LIKE '%{$valor}%' OR pro.nombre LIKE '%{$valor}%' ) ";
        }   
        
        //CONCAT(cat.nombre,' ',mar.nombre,' ',pro.nombre,' S/.', COALESCE(med.precio_venta,0) ) as texto
        // CONCAT(cat.nombre,' ',mar.nombre,' ',pro.nombre) as producto
        // COALESCE('(',pre.descripcion,') ',0)
        $this->db->select("pro.idproducto as idproducto, CONCAT( pro.nombre, ' (',COALESCE(pre.abreviatura,''),') ',' S/.', COALESCE(med.precio_venta,0) ) as texto,  , CONCAT(pro.nombre) as producto, pro.presentacion_minima, COALESCE(med.precio_venta,0) as precio_venta ");
        $this->db->from('producto as  pro');
        $this->db->join('marca as mar', 'mar.idmarca = pro.marca_idmarca');
        $this->db->join('categoria as cat', 'cat.idcategoria = pro.categoria_idcategoria');
        $this->db->join('unidad_medida as med',"med.producto_idproducto = pro.idproducto AND med.presentacion_idpresentacion = pro.presentacion_minima AND med.estado = 'Activo' ","LEFT");
        $this->db->join('presentacion as pre',"pro.presentacion_minima = pre.idpresentacion ","LEFT");
        $this->db->where('pro.estado','Activo');
        
        if($valor !=''){
            $this->db->where($where_filtro);
        }        
        
        $query = $this->db->get();
        return $query->result();
    }

    public function get_series($idtipocomprobante = '%')//segun el tipo de comprobante
    {
        $this->db->select("serie.idserie_comprobante as idserie, tipo_comp.idtipo_comprobante, tipo_comp.abreviatura, tipo_comp.descripcion as tipo_comprobante, CONCAT( serie.serie,'-',serie.correlativo ) as correlativo ");
        $this->db->from('tipo_comprobante as tipo_comp');
         $this->db->join('serie_comprobante as serie', 'tipo_comp.idtipo_comprobante = serie.tipo_comprobante_idtipocomprobante');
        $this->db->where('serie.estado','Activo');
        $this->db->where('tipo_comp.estado','Activo');

        if( $idtipocomprobante !=  '%') {
            $where = ' tipo_comp.idtipo_comprobante IN (';

            if(is_array($idtipocomprobante)){

                foreach ($idtipocomprobante as $key => $value) {
                    $where .= $value.',';
                }                    
            }else{

                $where .= $idtipocomprobante.',';
            }
            $where = substr($where, 0, -1);
            $where .= ')';
            $this->db->where($where);
        }             
        
        $query = $this->db->get();
        return $query->result();
    }

    public function get_tipocomprobantes($idtipocomprobante = '%')//segun el tipo de comprobante
    {
        $this->db->select("tipo_comp.idtipo_comprobante, tipo_comp.abreviatura, tipo_comp.descripcion as tipo_comprobante ");
        $this->db->from('tipo_comprobante as tipo_comp');
        $this->db->where('tipo_comp.estado','Activo');

        if( $idtipocomprobante !=  '%') {
            $where = ' tipo_comp.idtipo_comprobante IN (';

            if(is_array($idtipocomprobante)){

                foreach ($idtipocomprobante as $key => $value) {
                    $where .= $value.',';
                }                    
            }else{

                $where .= $idtipocomprobante.',';
            }
            $where = substr($where, 0, -1);
            $where .= ')';
            $this->db->where($where);
        }             
        
        $query = $this->db->get();
        return $query->result();
    }

    public function get_correlativo($idserie)
    {
        //$query = $this->db->get('producto', 10);
        $this->db->select(" CONCAT( serie.serie,'-',serie.correlativo ) as correlativo , serie.titulo , serie.correlativo as correlativo_solo  ");
        $this->db->from('serie_comprobante as serie');
        $this->db->where('serie.idserie_comprobante',$idserie);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_tipo_pagos($id = '%')
    {
        //$query = $this->db->get('producto', 10);
        $this->db->select(" idtipo_pago as id, descripcion, abreviatura ");
        $this->db->from('tipo_pago as tp');
        if( $id != '%'){
            $this->db->where('tp.idtipo_pago',$id);
        }
        $this->db->where('tp.estado','Activo');
        
        $query = $this->db->get();
        return $query->result();
    }

    public function get_forma_pago($id = '%')
    {
        $this->db->select(" idforma_pago as id, descripcion ");
        $this->db->from('forma_pago as fp');
        if( $id != '%'){
            $this->db->where('tp.idforma_pago',$id);
        }
        $this->db->where('fp.estado','Activo');
        $this->db->order_by('idforma_pago', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_tipo_moneda($id = '%')
    {
        $this->db->select(" idtipo_moneda as id, descripcion ");
        $this->db->from('tipo_moneda as tm');
        if( $id != '%'){
            $this->db->where('tm.idtipo_moneda',$id);
        }
        $this->db->where('tm.estado','Activo');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_periodo_pagos($id = '%')
    {
        $this->db->select(" idperiodo_pago as id, descripcion, abreviatura, codigo_facturalaya ");
        $this->db->from('periodo_pago as pp');

        if( $id != '%'){
            $this->db->where('pp.idperiodo_pago',$id);
        }
        $this->db->where('pp.estado','Activo');

        $query = $this->db->get();
        return $query->result();
    }

    public function get_datos_documentacion($idserie)
    {
        
        $this->db->select(" dat.iddato, dat.descripcion, dd.priority as orden, dat.tipo, dat.abreviatura, dat.validacion, COALESCE(dd.valor,'') as valor ");

        $this->db->from('datos_documentacion as dd');
        $this->db->join('dato as dat', 'dd.iddato = dat.iddato');
        $this->db->where('dat.estado','vigente');
        $this->db->where('dd.iddocumento',$idserie);

        $this->db->order_by(' orden ASC');

        $query = $this->db->get();

        return $query->result();
    }

    public function get_proforma_documento($tipo_doc, $numero_doc)
    {
        
        $this->db->select(" pro.idproforma,
                pro.estado as Estado,
                pro.fecha_creacion as Fecha, 
                pro.cliente_razon_social as Cliente, 
                pro.cliente_documento as 'Ruc',
                pro.cliente_direccion as Direccion,
                pp.descripcion as Periodo_pago,
                pp.idperiodo_pago as idperiodo_pago,
                tp.descripcion as Tipo_pago,
                tp.idtipo_pago as idtipo_moneda,
                tc.descripcion Comprobante, 
                pro.nro_documento as Nro_documento, 
                pro.total as Total,
                pro.observacion as Observacion ");

        $this->db->from('proforma pro');
        $this->db->join('tipo_comprobante tc', 'tc.idtipo_comprobante = pro.tipo_comprobante_idtipo_comprobante');
        $this->db->join('tipo_pago tp', 'tp.idtipo_pago = pro.tipo_pago_idtipo_pago');
        $this->db->join('periodo_pago pp', 'pp.idperiodo_pago = pro.periodo_pago_idperiodo_pago');
        $this->db->where('pro.'.$tipo_doc,$numero_doc);
        $query = $this->db->get();

        return $query->row();

    }

    public function find_datos_documentacion_existente($nro_documento) // para realizar importaciones
    {
        
        $this->db->select(" dat.iddato, dat.descripcion, docu_det.orden as orden, dat.tipo, dat.abreviatura, dat.validacion, COALESCE(docu_det.valor,'') as valor ");

        $this->db->from('documentacion as docu');
        $this->db->join('detalle_documentacion as docu_det', 'docu.iddocumentacion = docu_det.documentacion_iddocumentacion');
        $this->db->join('dato as dat', 'dat.iddato = docu_det.dato_iddato');
        $this->db->where('docu.nro_documento',$nro_documento);

        $this->db->order_by(' orden ASC');

        $query = $this->db->get();

        return $query->result();
    }


        public function get_basic_info_documento_existente($tipo_doc, $numero_doc)
    {
        
        $this->db->select(" docu.serie_comprobante_idserie_comprobante ");
        $this->db->from('documentacion as docu');
        $this->db->where('docu.'.$tipo_doc,$numero_doc);

        $query = $this->db->get();

        return $query->row();

    }


}

