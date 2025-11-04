<?php 
class Guia extends CI_Model {

    
    public function insert()
    {   
        $this->fecha_comprobante = date('Y-m-d H:i:s');		
        $this->fecha_traslado = $this->input->post('fecha_traslado');
        $this->tienda_idtienda = $this->input->post('tienda');
		
        $this->campo_libre = "test";
		
		$this->id_motivotraslado = $this->input->post('id_motivotraslado');
        $this->motivo_traslado = $this->input->post('motivo_traslado');
		$this->peso = $this->input->post('peso');
		$this->numero_paquetes = $this->input->post('numero_paquetes');
		
		$this->id_modalidadtraslado = $this->input->post('id_modalidadtraslado');
        $this->id_codigopuerto = $this->input->post('id_codigopuerto');
		$this->numero_contenedor = $this->input->post('numero_contenedor');
		$this->id_tipo_documento_transporte = $this->input->post('id_tipo_documento_transporte');
		        
        $this->nro_documento_transporte = $this->input->post('nro_documento_transporte');
		$this->razon_social_transporte = $this->input->post('razon_social_transporte');
        $this->transporte_nro_placa = strtoupper($this->input->post('transporte_nro_placa'));
        $this->id_ubigeo_destino = $this->input->post('id_ubigeo_destino');
        $this->dir_destino = $this->input->post('dir_destino');
        $this->id_ubigeo_partida = $this->input->post('id_ubigeo_partida');
        $this->dir_partida = $this->input->post('dir_partida');
                
		$this->envio_cpe_emision = 0;
		$this->nota = $this->input->post('nota');     
        $this->colaborador_idcolaborador = $this->session->userdata('id_user');
        $this->estado = 'vigente';
		
		$this->db->insert('guia_remision', $this);
		
		$error_array = $this->db->error()  ;
		
        return  array("status_script" => $this->db->trans_status(), 
						"table_id" => $this->db->insert_id(),
						"error_mensaje" => $error_array['message']  );
    }

	public function get_format_cpe($idguia_remision)
    {        
        $this->db->select(' 

            guia.id_motivotraslado as id_motivotraslado,
			guia.motivo_traslado as motivo_traslado,
			guia.peso as peso,
			guia.numero_paquetes as numero_paquetes,
			guia.id_codigopuerto as id_codigopuerto,
			guia.numero_contenedor as numero_contenedor,
			guia.id_modalidadtraslado as id_modalidadtraslado,
			guia.fecha_traslado as fecha_traslado,
			guia.id_tipo_documento_transporte as id_tipo_documento_transporte,
			guia.nro_documento_transporte as nro_documento_transporte,
			guia.razon_social_transporte as razon_social_transporte,
			guia.transporte_nro_placa as transporte_nro_placa,
			guia.id_ubigeo_destino as id_ubigeo_destino,
			guia.dir_destino as dir_destino,
			guia.id_ubigeo_partida as id_ubigeo_partida,
			guia.dir_partida as dir_partida,
			guia.nota as nota,
			SUBSTRING(guia.nro_documento, 1, 4) as serie_comprobante,
            (SUBSTRING(guia.nro_documento, 6, 8) * 1) as numero_comprobante,
			 DATE_FORMAT( guia.fecha_comprobante,"%Y-%m-%d") as fecha_comprobante,
			"09" as cod_tipo_documento
		');

        $this->db->from('guia_remision guia');
        $this->db->where('guia.idguia_remision',$idguia_remision);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function get_print_guia($idguia_remision){
		$this->db->select(' 

            doc_ref_guia.cliente_nombre as cliente_nombre,
			doc_ref_guia.cliente_numerodocumento as cliente_numerodocumento,
			doc_ref_guia.cliente_direccion as cliente_direccion,
			CONCAT(doc_ref_guia.serie_comprobante,"-",doc_ref_guia.numero_comprobante) as numero_comprobante_referencia,
			
			guia.fecha_traslado as fecha_traslado,			
			guia.motivo_traslado as motivo_traslado,
			IF(guia.id_modalidadtraslado="01","Transporte_publico","Transporte_privado") as modalidad_traslado,
			guia.nro_documento_transporte as nro_documento_transporte,
			guia.razon_social_transporte as razon_social_transporte,
			guia.transporte_nro_placa as transporte_nro_placa,
			ubi_dest.descripcion_ubigeo as destino_descripcion_ubigeo,
			guia.dir_destino as dir_destino,
			ubi_part.descripcion_ubigeo as partida_descripcion_ubigeo,
			guia.dir_partida as dir_partida,
			
			guia.peso as peso,
			guia.numero_paquetes as numero_paquetes,
			guia.id_codigopuerto as id_codigopuerto,
			guia.numero_contenedor as numero_contenedor,
			guia.nota as nota,
			guia.url_sunat_guia as url_sunat_guia,
			
			SUBSTRING(guia.nro_documento, 1, 4) as serie_comprobante,
            (SUBSTRING(guia.nro_documento, 6, 8) * 1) as numero_comprobante,
			guia.nro_documento  as Nro_documento_guia,
			DATE_FORMAT( guia.fecha_comprobante,"%Y-%m-%d") as fecha_comprobante
		');

        $this->db->from('guia_remision guia');
		$this->db->join('documento_referencia_guia_remision doc_ref_guia', 'guia.idguia_remision = doc_ref_guia.guia_idguia_remision');
		$this->db->join('sunat_ubigeo ubi_dest', 'ubi_dest.codigo_ubigeo = guia.id_ubigeo_destino', 'left');
		$this->db->join('sunat_ubigeo ubi_part', 'ubi_part.codigo_ubigeo = guia.id_ubigeo_partida', 'left');
        $this->db->where('guia.idguia_remision',$idguia_remision);
        $query = $this->db->get();

        return $query->row_array();
	}
    
    

}

