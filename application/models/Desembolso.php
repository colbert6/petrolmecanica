<?php 
class Desembolso extends CI_Model {


    
    public function get_deudores_por_tipo_beneficiario($tipo_beneficiario)
    {   
        
        $where_filtro = " ( de.tipo_beneficiario = '{$tipo_beneficiario}' ) ";

        $this->db->select("de.iddesembolso as Id ,de.nombre_beneficiario as Beneficiario, de.concepto_desembolso as Concepto, de.fecha_pago_desembolso as Fecha_pago, de.importe_total as Importe, de.pago_acumulado as Pago, de.saldo_a_cuenta as Deuda ");
        $this->db->from('desembolso as de');
        $this->db->where('de.estado','vigente');
        $this->db->where('(de.importe_total - de.pago_acumulado) > 0 ');
        $this->db->where($where_filtro);
        $this->db->order_by('de.fecha_pago_desembolso');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_desembolso()
    {   
        $this->tipo_beneficiario = $this->input->post('tipo_beneficiario');
        $this->nombre_beneficiario = $this->input->post('input_busqueda_general');
        $this->idbeneficiario = $this->input->post('id_result');   

        $this->fecha_pago_desembolso = $this->input->post('fecha_pago_desembolso');
        $this->metodo_pago = $this->input->post('metodo_pago');

        $this->nro_operacion_desembolso = $this->input->post('nro_operacion_desembolso');
        $this->comprobantes_a_pagar = $this->input->post('comprobantes_a_pagar');
        $this->importe_total = $this->input->post('importe_total');
        $this->pago_desembolso = $this->input->post('pago_desembolso');
        $this->pago_acumulado = $this->input->post('pago_desembolso');
        $this->saldo_a_cuenta = $this->input->post('importe_total') - $this->input->post('pago_desembolso');
        $this->saldo_a_cuenta_inicial = $this->input->post('importe_total') - $this->input->post('pago_desembolso');;
        $this->concepto_desembolso = $this->input->post('concepto_desembolso');
        
        $this->fecha_registro = date('Y-m-d H:i:s');
        $this->iduser_registro = $this->session->userdata('id_user');
        $this->estado = 'vigente';

        return  $this->db->insert('desembolso', $this);
    }

    public function insert_desembolso_pago()
    {   
        $this->metodo_pago = $this->input->post('metodo_pago');
        $this->iddesembolso_a_pagar = $this->input->post('iddesembolso_a_pagar');
        $this->monto_pago = $this->input->post('monto_pago');   
        $this->nro_operacion_pago = $this->input->post('nro_operacion_pago');
        $this->observacion_pago = $this->input->post('observacion_pago');        
        $this->fecha_registro = date('Y-m-d H:i:s');
        $this->iduser_registro = $this->session->userdata('id_user');

        return  $this->db->insert('desembolso_pago', $this);
    }

    public function update_add_pago_desembolso($iddesembolso_a_pagar, $monto_pago){
        
        $this->db->set('saldo_a_cuenta', 'importe_total - (pago_acumulado + '.$monto_pago.")",FALSE);
        $this->db->set('pago_acumulado', 'pago_acumulado + '.$monto_pago,FALSE);
        $this->db->where('iddesembolso', $iddesembolso_a_pagar);
        $this->db->update('desembolso');  
    }

    public function get_desembolso_pagos($iddesembolso){
        
        $where_desembolso_filtro = " ( dp.iddesembolso = '{$iddesembolso}' ) ";
		$where_filtro = " ( dp.iddesembolso_a_pagar = '{$iddesembolso}' ) ";
		
		$this->db->select("dp.fecha_pago_desembolso as fecha_pago_desembolso, dp.metodo_pago, dp.pago_desembolso as monto_pago_inicial, dp.nro_operacion_desembolso, dp.concepto_desembolso, dp.comprobantes_a_pagar ");
        $this->db->from('desembolso dp');
        $this->db->where($where_desembolso_filtro);
        $this->db->order_by('dp.fecha_registro', 'desc');
        $query = $this->db->get();
		$desembolso = $query->result_array();
		
		
        $this->db->select("dp.fecha_registro, dp.metodo_pago, dp.monto_pago, dp.nro_operacion_pago, dp.observacion_pago ");
        $this->db->from('desembolso_pago dp');
        $this->db->where($where_filtro);
        $this->db->order_by('dp.fecha_registro', 'desc');
        $query = $this->db->get();
		$desembolso_pagos = $query->result_array();
        
        return array_merge($desembolso, $desembolso_pagos);  
    }


}

