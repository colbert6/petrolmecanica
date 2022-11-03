<?php 
class Documento_referencia_guia_remision extends CI_Model {

    
    public function insert()
    {   
        $cont = count($this->input->post('docs_referencia_id_tipodoc_electronico'));
        for ($i=0; $i < $cont ; $i++) {
			
			$this->id_tipodoc_electronico =  $_POST['docs_referencia_id_tipodoc_electronico'][$i];
			$this->serie_comprobante =  $_POST['docs_referencia_serie_comprobante'][$i];
			$this->numero_comprobante =  $_POST['docs_referencia_numero_comprobante'][$i];
			$this->idcomprobante_referencia =  $_POST['docs_referencia_venta_idventa'][$i];
			$this->cliente_tipodocumento =  $_POST['docs_referencia_cliente_tipodocumento'][$i];
			$this->cliente_numerodocumento =  $_POST['docs_referencia_cliente_numerodocumento'][$i];
			$this->cliente_nombre =  $_POST['docs_referencia_cliente_nombre'][$i];
			$this->cliente_pais =  $_POST['docs_referencia_cliente_pais'][$i];
			$this->cliente_direccion =  $_POST['docs_referencia_cliente_direccion'][$i];
			$this->cliente_codigoubigeo =  $_POST['docs_referencia_cliente_codigoubigeo'][$i];			
			$this->db->insert('documento_referencia_guia_remision', $this);	
        }
		$error_array = $this->db->error()  ;
		return  array("status_script" => $this->db->trans_status(), "error_mensaje" => $error_array['message']  );
    }
	
	public function get_format_cpe($idguia_remision)
    {        
        $this->db->select(' 
            doc_ref_guia.id_tipodoc_electronico as id_tipodoc_electronico,
			doc_ref_guia.serie_comprobante as serie_comprobante,
			(doc_ref_guia.numero_comprobante * 1) as numero_comprobante		
		');
		

        $this->db->from('documento_referencia_guia_remision doc_ref_guia');
        $this->db->where('doc_ref_guia.guia_idguia_remision',$idguia_remision);
        $query = $this->db->get();

        return $query->result_array();
    }   
	
	public function get_format_cpe_cliente($idguia_remision)
    {        
        $this->db->select('
			doc_ref_guia.cliente_tipodocumento as cliente_tipodocumento,
			doc_ref_guia.cliente_numerodocumento as cliente_numerodocumento,
			doc_ref_guia.cliente_nombre as cliente_nombre,
			doc_ref_guia.cliente_pais as cliente_pais,
			doc_ref_guia.cliente_codigoubigeo as cliente_codigoubigeo			
		');
        $this->db->from('documento_referencia_guia_remision doc_ref_guia');
        $this->db->where('doc_ref_guia.guia_idguia_remision',$idguia_remision);
        $query = $this->db->get();

        return $query->row_array();
    }   
    
    

}

