<?php 
class Cliente extends CI_Model {

    public $razon_social;
    public $nombre_comercial;
    public $ruc;
    public $dni;
    public $direccion;
    public $contacto;
    public $correo;

    public $fecha_nacimiento;
    public $fecha_creacion;
    public $cod_ubigeo;

    
    public function get_cliente($filtro, $valor)
    {   
        $where_filtro = '';
        if( $filtro == 'dni' || $filtro == 'ruc' ){
            $where_filtro = " cli.{$filtro} = '{$valor}' ";
        }if( $filtro == 'nombre' ){
            $where_filtro = " cli.razon_social LIKE '%{$valor}%' OR cli.nombre_comercial LIKE '%{$valor}%' "; ;
        }else{
            $where_filtro = " cli.{$filtro} = '{$valor}' ";
        }

        //$query = $this->db->get('producto', 10);
        $this->db->select("cli.idcliente as idcliente, cli.dni, cli.ruc, cli.razon_social as razon_social, cli.nombre_comercial as nombre_comercial,  cli.direccion as direccion ");
        $this->db->from('cliente as cli');
        $this->db->where('cli.estado','Activo');
        $this->db->where($where_filtro);
        $query = $this->db->get();
        return $query->result();
    }

    public function validar_registro_cliente( $condicion_validacion_cliente )
    {   
        
        $this->db->select("razon_social as cliente_nombre");
        $this->db->from('cliente');
        $this->db->where('estado','Activo');
        $this->db->where($condicion_validacion_cliente);
        $query = $this->db->get();
        return $query->row_array();
    }

   
    public function insert_cliente()
    {   
        $this->razon_social = $this->input->post('razon_social');
        $this->nombre_comercial = $this->input->post('nombre_comercial');
        $this->ruc = $this->input->post('ruc');        
        $this->dni = $this->input->post('dni');
        $this->direccion = $this->input->post('direccion');        
        $this->contacto = $this->input->post('contacto');
        $this->correo = $this->input->post('correo');        
        $this->fecha_nacimiento = $this->input->post('fecha_nacimiento');
        $this->fecha_creacion = date('Y-m-d H:i:s');
        $this->cod_ubigeo = $this->input->post('codigo_ubigeo');
        $this->estado = 'Activo';

        return  $this->db->insert('cliente', $this);
    }
    


}

