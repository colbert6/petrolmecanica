<?php 
class Envio_cpe extends CI_Model {
  
    public function set_error($data_envio, $data_result)
    {   

        if(isset($data_result['mensaje'])){
            $this->errors =  $data_result['mensaje'];
        }else if(isset($data_result['msj_sunat']) ){
            $this->errors =  $data_result['msj_sunat'];
        }else{
            $this->errors = "-";
        }

        $this->tipo_envio = $data_envio['tipo_envio'];
        $this->idmaster = $data_envio['idmaster'];
        $this->fecha = date("Y-m-d H:i:s");
        if(isset($data_result['codigo'])){
            $this->codigo =  $data_result['codigo'];
        }else if(isset($data_result['cod_sunat']) ){
            $this->codigo =  $data_result['cod_sunat'];
        }else{
            $this->codigo = "-";
        }

        $this->usuario_envio =  0;
        $this->data_result =  json_encode($data_result);

        return  $this->db->insert('error_envio_electronico', $this);
    }

    public function set_envio($data_envio, $data_result)
    {   
        $this->idmaster = $data_envio['idmaster'];
        $this->tipo = isset($data_envio['cod_tipo_documento'])?$data_envio['cod_tipo_documento']:0;
        $this->correlativo = isset($data_envio['numero_comprobante'])?$data_envio['numero_comprobante']:0; 
        $this->serie = isset($data_envio['serie_comprobante'])?$data_envio['serie_comprobante']:"0";

        $this->cod_sunat =isset($data_result['cod_sunat'])?$data_result['cod_sunat']:"0";
        $this->msj_sunat = isset($data_result['msj_sunat'])?$data_result['msj_sunat']:" "; 
        $this->ruta_xml = isset($data_result['ruta_xml'])?$data_result['ruta_xml']:"0";
        $this->ruta_cdr = isset($data_result['ruta_cdr'])?$data_result['ruta_cdr']:"0";
        $this->ruta_pdf = isset($data_result['ruta_pdf'])?$data_result['ruta_pdf']:"0";

        $this->tipoenvio = $data_envio['tipo_envio'];
        $this->fecha_envio = date("Y-m-d H:i:s");
        $this->fecha_emi = isset($data_envio['fecha_comprobante'])?$data_envio['fecha_comprobante']:""; 
        $this->data_result =  json_encode($data_result);

        return  $this->db->insert('envio_electronico', $this);
    }

    public function set_envio_update($data,$id )
    {   

        $this->db->set($data);
        $this->db->where('id',$id);
        $this->db->update('envio_electronico');

        return  1;
    }

    public function update_envio_cpe($idventa, $tipo)
    {   

        switch ($tipo) {
            case 'generar_comprobante':
                $campo = 'envio_cpe_emision';
                break;

             case 'generar_anulacion':
                $campo = 'envio_cpe_baja';
                break;
            
            default:
                $campo = '';
                break;
        }
        if($campo != '' ){
            $this->db->set($campo, 1);
            $this->db->where('idventa',$idventa);
            $this->db->update('venta');
        }
        

        return  1;
    }    


}

