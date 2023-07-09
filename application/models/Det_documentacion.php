<?php 
class Det_documentacion extends CI_Model {

    public $documentacion_iddocumentacion;
    public $dato_iddato;
    public $valor;
    public $estado;
    public $orden;

    /*
    Table "dato" ._  contiene los tipos de datos 
    */
    
    public function insert_det_documentacion()
    {   
        $cont = count($this->input->post('iddato'));

        for ($i=0; $i < $cont ; $i++) { 
            # code..
            $this->dato_iddato = $this->input->post('iddato')[$i];
            $this->valor = $this->input->post('dato')[$i];
            $this->estado = 'Activo';
            $this->orden = $i;

            $this->db->insert('detalle_documentacion', $this);
        }
    }

    public function get_print_det_documentacion($iddocumentacion)
    {        
        $this->db->select("                        
                        detc.dato_iddato as iddato,
                        detc.documentacion_iddocumentacion as iddocumentacion,
                        dat_doc.priority, 
                        coalesce(dat_doc.add_descripcion,0) as add_descripcion,
                        coalesce(dat_doc.add_borde,0) as add_borde,
                        coalesce(dat_doc.salto_linea,1) as salto_linea,
                        dat_doc.iddatos_documentacion,

                        detc.estado as estado,
                        detc.dato_iddato as iddato ,
                        detc.valor as valor,

                        dat.descripcion as  descripcion_dato ,
                        dat.tipo
                          ");
        $this->db->from('detalle_documentacion detc');
        $this->db->join('documentacion doc', 'doc.iddocumentacion = detc.documentacion_iddocumentacion');
        $this->db->join('dato dat', 'dat.iddato = detc.dato_iddato'); //dato  

        $this->db->join('datos_documentacion dat_doc', ' doc.serie_comprobante_idserie_comprobante = dat_doc.iddocumento AND dat_doc.iddato = detc.dato_iddato ', 'left'); // datos_documentacion da el formato de impresion 

        
        $this->db->where('detc.documentacion_iddocumentacion',$iddocumentacion);
    
        $this->db->order_by('detc.orden','ASC');
        
        $query = $this->db->get();

        return $query->result_array();
    }
  
    public function get_print_det_documentacion_all($iddocumentacion)
    {        
        /*$this->db->select("   
                       
                        detc.documentacion_iddocumentacion
                          ");
        //$this->db->from('documentacion doc ');
        $this->db->from('detalle_documentacion detc ');
        //$this->db->join('datos_documentacion dat_doc', ' doc.serie_comprobante_idserie_comprobante = dat_doc.iddocumento AND dat_doc.iddato = detc.dato_iddato ','left');
      
        //$this->db->join('detalle_documentacion detc', 'doc.iddocumentacion = detc.documentacion_iddocumentacion');
        $this->db->join('datos_documentacion dat_doc', ' dat_doc.iddato = detc.dato_iddato ');


        
        $this->db->where('detc.documentacion_iddocumentacion',$iddocumentacion);*/
        
        /*$this->db->select("  *          ");
        $this->db->from('datos_documentacion');
      
        $query = $this->db->get();*/
        $query =  $this->db->query('SELECT * FROM detalle_documentacion as detc WHERE detc.documentacion_iddocumentacion=19');
      

        return $query->result_array();
    }
  
    public function actualizar()
    {        
        //$this->db->query('UPDATE documentacion SET serie_comprobante_idserie_comprobante =  13 WHERE iddocumentacion >= 16');

        //return $query->result_array();
    }

}

