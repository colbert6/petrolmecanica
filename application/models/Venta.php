<?php 
class Venta extends CI_Model {

    public $serie_comprobante_idserie_comprobante;
    public $tipo_comprobante_idtipo_comprobante;
    public $cliente_idcliente;
    public $tienda_idtienda;
    public $cliente_razon_social;
    public $cliente_documento;
    public $cliente_direccion;
    public $nro_documento;
    public $nro_pre_documento;
    public $colaborador_idcolaborador;
    public $fecha_venta;
    public $observacion;
    public $subtotal;
    public $igv;
    public $total;
    public $descuento;
    public $fecha_creacion;
    public $estado;

    
    public function insert_venta()
    {   
        $this->fecha_venta = $this->input->post('fecha_venta'); //date('Y-m-d H:i:s');//
        $this->serie_comprobante_idserie_comprobante = $this->input->post('idserie');
        $this->tienda_idtienda = $this->input->post('tienda');

        $this->nro_pre_documento = $this->nro_documento;

        $this->igv = $this->input->post('igv');
        $this->subtotal = $this->input->post('subtotales');
        $this->descuento = $this->input->post('descuento');
        $this->total = ($this->input->post('subtotales') - $this->input->post('descuento')+$this->input->post('igv'));
        
        $this->cliente_idcliente = $this->input->post('idcliente');//FALTA
        $this->cliente_razon_social = $this->input->post('cliente');
        
        $this->cliente_direccion = $this->input->post('direccion_cliente');
        $this->colaborador_idcolaborador = $this->session->userdata('id_user');//FALTA

        $this->idtipo_moneda = $this->input->post('tipo_moneda');
        $this->idforma_pago = $this->input->post('forma_pago');
        $this->idperiodo_pago = $this->input->post('condicion_pago');
        $this->nro_cuotas = $this->input->post('numero_cuotas');
        $this->cliente_direccion = $this->input->post('direccion_cliente');
        
        $this->observacion = $this->input->post('observacion');     
        
        $this->fecha_creacion = date('Y-m-d H:i:s');
        $this->estado = 'vigente';

        return  $this->db->insert('venta', $this);
    }

    public function anular_venta($idventa)
    {   
        $this->db->set('estado', 'anulado');
        $this->db->where('idventa',$idventa);
        $this->db->update('venta');
    }

    public function control($fecha)
    {

        $this->db->select(" COALESCE(SUM(vent.total),0) as total_venta_fecha  ");
        $this->db->from('venta vent');
        $this->db->where('vent.estado','Vigente');
        $this->db->where('DATE_FORMAT(vent.fecha_venta,"%Y-%m-%d") = DATE_FORMAT("'.$fecha.'","%Y-%m-%d")');
        $result[] = $this->db->get()->row();

        $this->db->select(" COALESCE(SUM(vent.total),0) as total_venta_mes  ");
        $this->db->from('venta vent');
        $this->db->where('vent.estado','Vigente');
        $this->db->where('DATE_FORMAT(vent.fecha_venta,"%Y-%m") = DATE_FORMAT("'.$fecha.'","%Y-%m")');
        $result[] = $this->db->get()->row();
      
        return $result;
    }

    public function get_ventas($fecha_inicio,$fecha_fin)
    {   

        $this->db->select("DATE_FORMAT(vent.fecha_venta,'%Y-%m-%d') as Fecha, cliente_razon_social as Cliente, cliente_documento as Cliente_documento, nro_documento as Nro_documento, total as Total, vent.estado as Estado ");
        $this->db->from('venta vent');
        $this->db->where('DATE_FORMAT(vent.fecha_venta,"%Y-%m-%d") BETWEEN DATE_FORMAT("'.$fecha_inicio.'","%Y-%m-%d") AND DATE_FORMAT("'.$fecha_fin.'","%Y-%m-%d")' );
        #vent.estado="Vigente" AND 
        $this->db->order_by('fecha_creacion','desc');
        $result = $this->db->get()->result_array();        
      
        return $result;
    }

    public function get_detalleventas($fecha_inicio,$fecha_fin)    {   

        $this->db->select("vent.fecha_creacion as Fecha, vent.nro_documento as Nro_documento, dv.descripcion as Producto, cantidad as Cant, precioxpresentacion as Precio, total as Total");
        $this->db->from('venta vent');
        $this->db->join('detalle_venta dv','dv.venta_idventa = vent.idventa');
        $this->db->where('vent.estado="Vigente" AND dv.estado="Activo" AND DATE_FORMAT(vent.fecha_venta,"%Y-%m-%d") BETWEEN DATE_FORMAT("'.$fecha_inicio.'","%Y-%m-%d") AND DATE_FORMAT("'.$fecha_fin.'","%Y-%m-%d")' );
        $this->db->order_by('fecha_creacion','desc');
        $result = $this->db->get()->result_array();        
      
        return $result;
    }

    public function get_ventas_productos($fecha_inicio,$fecha_fin, $order)    {   

        $this->db->select("CONCAT(cat.nombre,' ',mar.nombre,' ',pro.nombre) as Producto,
            SUM(dv.cantidad) Cant_Vendida,
            SUM(dv.subtotal) Monto_Vendido");
        $this->db->from('venta vent');
        $this->db->join('detalle_venta dv','dv.venta_idventa = vent.idventa');
        $this->db->join('producto pro','dv.producto_idproducto = pro.idproducto');
        $this->db->join('categoria cat','cat.idcategoria = pro.categoria_idcategoria');
        $this->db->join('marca mar','mar.idmarca = pro.marca_idmarca');


        $this->db->where('vent.estado="Vigente" AND dv.estado="Activo" AND DATE_FORMAT(vent.fecha_venta,"%Y-%m-%d") BETWEEN DATE_FORMAT("'.$fecha_inicio.'","%Y-%m-%d") AND DATE_FORMAT("'.$fecha_fin.'","%Y-%m-%d")' );
        $this->db->group_by("pro.idproducto");
        $this->db->order_by($order,'desc');

        $result = $this->db->get()->result_array();        
      
        return $result;
    }

    public function get_print_venta($idventa)
    {        
        $this->db->select(" vent.estado as Estado,
                tt.descripcion as Tienda,
                DATE_FORMAT(vent.fecha_venta, '%Y-%m-%d') as Fecha, 
                vent.cliente_razon_social as Cliente, 
                vent.cliente_documento as 'RUC/DNI',
                vent.cliente_direccion as Direccion,
                col.nombre as Usuario,
                tc.descripcion Comprobante, 
                tc.codsunat codsunat, 
                fp.descripcion as forma_pago,
                tm.descripcion as moneda,
                pp.descripcion as condicion_pago,
                vent.nro_documento as Nro_documento, 
                vent.total as Total,
                vent.subtotal as Subtotal,
                vent.igv as Igv,
                vent.observacion as Observacion,
                vent.nro_guia_remision as Nro_guia,
                vent.nro_cuotas as Nro_cuotas,
                vent.idperiodo_pago as Idperiodo_pago  ");

        $this->db->from('venta vent');
        $this->db->join('tienda tt', 'tt.idtienda = vent.tienda_idtienda');
        $this->db->join('tipo_comprobante tc', 'tc.idtipo_comprobante = vent.tipo_comprobante_idtipo_comprobante');
        $this->db->join('colaborador col', 'col.idcolaborador = vent.colaborador_idcolaborador');
        $this->db->join('forma_pago fp', 'fp.idforma_pago = vent.idforma_pago','left');
        $this->db->join('tipo_moneda tm', 'tm.idtipo_moneda = vent.idtipo_moneda','left');
        $this->db->join('periodo_pago pp', 'pp.idperiodo_pago = vent.idperiodo_pago','left');
        $this->db->where('vent.idventa',$idventa);
        $query = $this->db->get();

        return $query->row_array();
    }
    

    public function venta_byId($idventa)
    {        
        $this->db->select(" vent.estado,
                tt.descripcion ,
                tc.idtipo_comprobante ,
                vent.fecha_creacion, 
                vent.cliente_razon_social , 
                vent.cliente_documento,
                vent.cliente_direccion ,
                col.nombre ,
                tc.descripcion , 
                vent.nro_documento , 
                vent.total,
                vent.subtotal ,
                vent.igv ,
                vent.observacion   ");

        $this->db->from('venta vent');
        $this->db->join('tienda tt', 'tt.idtienda = vent.tienda_idtienda');
        $this->db->join('tipo_comprobante tc', 'tc.idtipo_comprobante = vent.tipo_comprobante_idtipo_comprobante');
        $this->db->join('colaborador col', 'col.idcolaborador = vent.colaborador_idcolaborador');
        $this->db->where('vent.idventa',$idventa);
        $query = $this->db->get();

        return $query->row_array();
    }
	
	public function get_data_venta_buscado_nro_comprobante ($nro_comprobante_venta)
    {	
		$this->db->select(" vent.* ");
        $this->db->from('venta vent');
        $this->db->where('vent.nro_documento',$nro_comprobante_venta);
        $query = $this->db->get();
		
		return $query->row_array();
	}

    public function cpe_venta($idventa)
    {        
        $this->db->select('   
            SUBSTRING_INDEX(vent.nro_documento,"-",1)  AS  serie_documento,
            (SUBSTRING_INDEX(vent.nro_documento,"-",-1) * 1) as numero_documento,
            DATE_FORMAT( vent.fecha_venta,"%Y-%m-%d") as fecha_de_emision, 
            DATE_FORMAT( vent.fecha_venta,"%H:%i:%s") as hora_de_emision, 
            "0101" as  codigo_tipo_operacion,
            "01" as  codigo_tipo_documento,
            tm.cod_tipo_moneda as codigo_tipo_moneda,
            DATE_FORMAT( vent.fecha_venta,"%Y-%m-%d") as fecha_de_vencimiento,
            LPAD(vent.idventa, 10, "0") as  numero_orden_de_compra,            
            LPAD(pp.idperiodo_pago, 2, "0") as codigo_condicion_de_pago,
            CONCAT("Forma de pago:", fp.descripcion,"|Caja: 1") as informacion_adicional,

            IF( LENGTH( vent.cliente_documento) = 11, 6, IF( LENGTH( vent.cliente_documento ) = 8, 1,  "-" )  ) AS codigo_tipo_documento_identidad,
            IF( LENGTH( vent.cliente_documento) > 0, vent.cliente_documento, "0")  AS numero_documento_cliente,
            vent.cliente_razon_social as apellidos_y_nombres_o_razon_social,
            "PE" as codigo_pais,
            coalesce(cli.cod_ubigeo,"") as ubigeo,
            vent.cliente_direccion as direccion, 
            cli.correo as correo_electronico,
            cli.contacto as telefono, 

            0 as total_exportacion, 
            vent.subtotal as total_operaciones_gravadas,
            0 as total_operaciones_inafectas,
            0 as total_operaciones_exoneradas,
            0 as total_operaciones_gratuitas,            
            vent.igv as total_igv,
            vent.igv as total_impuestos,
            vent.subtotal as total_valor,
            vent.total as total_venta,
            
            "" as item
        ');

        $this->db->from('venta vent');
        $this->db->join('tienda tt', 'tt.idtienda = vent.tienda_idtienda');
        $this->db->join('cliente cli', 'cli.idcliente = vent.cliente_idcliente', 'left');
        $this->db->join('tipo_comprobante tc', 'tc.idtipo_comprobante = vent.tipo_comprobante_idtipo_comprobante');
        $this->db->join('forma_pago fp', 'fp.idforma_pago = vent.idforma_pago');
        $this->db->join('tipo_moneda tm', 'tm.idtipo_moneda = vent.idtipo_moneda');
        $this->db->join('periodo_pago pp', 'pp.idperiodo_pago = vent.idperiodo_pago');
        $this->db->where('vent.idventa',$idventa);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function cpe_venta_anulacion($idventa)
    {        
        $this->db->select('
            external_id,
            DATE_FORMAT( vent.fecha_venta,"%Y-%m-%d") as fecha_comprobante,
            "ERROR EN EL PEDIDO" as motivo_anulacion
        ');

        $this->db->from('venta as vent');
        $this->db->join('tipo_comprobante tipo_comp', 'tipo_comp.idtipo_comprobante = vent.tipo_comprobante_idtipo_comprobante');
        $this->db->where('vent.idventa',$idventa);

        $query = $this->db->get();

        return $query->row_array();
    }
    
    
    

}

