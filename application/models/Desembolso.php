<?php 
class Desembolso extends CI_Model {


    
    public function get_deudores_por_tipo_beneficiario($tipo_beneficiario)
    {   
        
        $where_filtro = " ( de.tipo_beneficiario = '{$tipo_beneficiario}' ) ";

        $this->db->select("de.iddesembolso as Id ,de.nombre_beneficiario as Beneficiario, de.fecha_pago_desembolso as Fecha_pago, de.pago_desembolso as Pago, de.saldo_a_cuenta as Deuda ");
        $this->db->from('desembolso as de');
        $this->db->where('de.estado','vigente');
        $this->db->where('de.saldo_a_cuenta > 0 ');
        $this->db->where($where_filtro);
        $this->db->order_by('de.fecha_pago_desembolso');
        $query = $this->db->get();
        return $query->result();
    }

    public function insert_desembolso()
    {   
        $this->tipo_beneficiario = $this->input->post('tipo_beneficiario');
        $this->nombre_beneficiario = $this->input->post('input_busqueda_general');
        $this->idbeneficiario = $this->input->post('id_result');   

        $this->fecha_pago_desembolso = $this->input->post('fecha_pago_desembolso');
        $this->metodo_pago = $this->input->post('metodo_pago');

        $this->nro_operacion_desembolso = $this->input->post('nro_operacion_desembolso');
        $this->pago_desembolso = $this->input->post('pago_desembolso');
        $this->saldo_a_cuenta = $this->input->post('saldo_a_cuenta');
        $this->saldo_a_cuenta_inicial = $this->input->post('saldo_a_cuenta');
        $this->concepto_desembolso = $this->input->post('concepto_desembolso');
        
        $this->fecha_registro = date('Y-m-d H:i:s');
        $this->estado = 'vigente';

        return  $this->db->insert('desembolso', $this);
    }

}

