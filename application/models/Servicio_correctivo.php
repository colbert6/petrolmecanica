<?php 
class Servicio_correctivo extends CI_Model {

  
  public function insert_servicio($data)
  { 
    return  $this->db->insert('servicio_correctivo', $data);
  }
  
  public function servicio_byId($id)
    {        
        $this->db->select(" ser.*  ");

        $this->db->from('servicio_correctivo ser');
        $this->db->where('ser.idservicio_correctivo',$id);
        $query = $this->db->get();

        return $query->row_array();
    }
  
  
  public function anular_servicio($id)
    {   
        $this->db->set('estado_servicio', 'anulado');
        $this->db->where('idservicio_correctivo',$id);
        $this->db->update('servicio_correctivo');
    }
  
}