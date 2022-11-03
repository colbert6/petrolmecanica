<?php 
class Detalle_guia_remision extends CI_Model {

    
    public function insert()
    {   
        $cont = count($this->input->post('CODIGO_PRODUCTO'));
        for ($i=0; $i < $cont ; $i++) {
			
			$this->item_detalle =  $_POST['ITEM_DET'][$i];
			$this->codigo_producto =  $_POST['CODIGO_PRODUCTO'][$i];
			$this->descripcion_detalle =  $_POST['DESCRIPCION_DET'][$i];
			$this->cantidad_detalle =  $_POST['CANTIDAD_DET'][$i];
			$this->unidad_medida_detalle =  $_POST['UNIDAD_MEDIDA_DET'][$i];
			$this->peso_detalle =  $_POST['PESO_DET'][$i];
			$this->estado =  "vigente";
			
			$this->db->insert('detalle_guia_remision', $this);
        }
		
		$error_array = $this->db->error()  ;
		return  array("status_script" => $this->db->trans_status(), "error_mensaje" => $error_array['message']  );
    }

    public function get_format_cpe($idguia_remision)
    {   
        $this->db->select(' 
            det_guia.item_detalle as ITEM_DET,
			det_guia.unidad_medida_detalle as UNIDAD_MEDIDA_DET,
			det_guia.cantidad_detalle as CANTIDAD_DET,
			det_guia.codigo_producto as CODIGO_PRODUCTO,
			det_guia.descripcion_detalle as DESCRIPCION_DET,
			det_guia.peso_detalle as PESO_DET	
		');

        $this->db->from('detalle_guia_remision det_guia');
        $this->db->where('det_guia.guia_idguia_remision',$idguia_remision);
        $query = $this->db->get();

        return $query->result_array();
    } 

	public function get_print_guia($idguia_remision)
    {   
        $this->db->select(' 
            det_guia.descripcion_detalle as Descripcion,
			LPAD(det_guia.codigo_producto,5,"0") as Codigo,			
			det_guia.unidad_medida_detalle as Medida,
			det_guia.cantidad_detalle as Cantidad,			
			det_guia.peso_detalle  as Peso
		');

        $this->db->from('detalle_guia_remision det_guia');
        $this->db->where('det_guia.guia_idguia_remision',$idguia_remision);
		//$this->db->order_by('det_guia.item_detalle');
        $query = $this->db->get();

        return $query->result_array();
    } 	
    
    

}

