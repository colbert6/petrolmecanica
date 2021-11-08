<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    
    // Variables del sistema
    public $controller, $metodo, $menu;

    // Variables de sesión del sistema
    public $nombre_usuario, $perfil_usuario;

    // Variables de empresa usuaria 
    public $sistema, $nombre_empresa, $nombre_empresa_abreviado;
    public $empresa, $logo_empresa, $razon_social, $ruc;
    public $direccion, $direccion_adicional, $contacto, $rubro;

    public $id_ticket,   $id_boleta,   $id_factura; 
    public $id_proforma,   $id_nota_entrada,   $id_nota_salida;
    public $id_certificado,   $id_constancia,   $id_acta;  
    public $id_garantia,   $id_guia_remision,   $id_certificado_trabajo; 
    public $id_contrato,   $id_servicio_correctivo; 

    public $parametros_trebloc = array();

    public function __construct()
    {
        parent::__construct();     

        $this->_set_value_variable_globals(); 
        
    }

    public function _init( $cargar_menu, $cargar_url, $cargar_template )
    {   
        //Validar sesion este abierta    
    	$this->_valid_session_open();        

        // Obtener menu para el usuario en sesion
        if($cargar_menu) {$this->menu = $this->_get_menu();} 

        // Obtengo la URL y reemplaza los valores correspondientes a controlador y metodo
        if($cargar_url) {$this->_request_url();}    

        // Carga el template por defecto
        if($cargar_template) {$this->output->set_template('adminlte');}
           
    }

    
    private function _request_url()
    {
        $url = $this->input->server('REQUEST_URI'); 
        $url_solicitados = explode("/", $url);

        $this->controller =  isset($url_solicitados[2])?ucwords($url_solicitados[2]):'';
        $this->metodo =  isset($url_solicitados[3])?ucwords($url_solicitados[3]):'';
    } 


    private function _get_menu()
    {        
                 
        $this->load->model('menus');
        $menu_usuario = $this->menus->get_menu($this->session->userdata('id_perfil'));

        $modulo_papa_flag = '';
        $menu = '';     

        foreach ( $menu_usuario as $modulo) {

            if( $modulo_papa_flag != $modulo->papa ){

                if($modulo_papa_flag != '' ){
                        $menu .="</ul> </li>";                            
                }

                $menu .= "<li class='treeview'>
                <a href='#'>
                    <i class='fa fa-reorder'></i> <span> {$modulo->papa} </span>
                    <span class='pull-right-container'>
                      <i class='fa fa-angle-left pull-right'></i>
                    </span>
                  </a>
                  <ul class='treeview-menu'>";
                $modulo_papa_flag = $modulo->papa;   

            }
            $menu .=  "<li><a href='".base_url($modulo->url)."'><i class='fa {$modulo->icono}'></i> {$modulo->nombre}</a></li>"; 

        }

        return $menu;
        // exit();
    } 


    public function _set_value_variable_globals()
    {   
        $variables_not_defined  = array();

        // --Variables del sistema
        $variables_sistema = array(
            'controller'=>'','metodo'=>'','menu'=>'',
            'nombre_usuario'=>'', 'perfil_usuario'=>'' 
        );
        $this->_set_default_value_variable_globals($variables_sistema);


        // --Variables de identificadores_comprobantes
        $variables_identificadores_comprobantes = array(
            'id_ticket' => 1,   'id_boleta' => 3,   'id_factura' => 2,   
            'id_proforma' => 4,   'id_nota_entrada' => 5,   'id_nota_salida' => 6,   
            'id_certificado' => 7,   'id_constancia' => 8,   'id_acta' => 9,   
            'id_garantia' => 10,   'id_guia_remision' => 11,   'id_certificado_trabajo' => 12,   
            'id_contrato' => 13,   'id_servicio_correctivo' => 14 
        ); 
        $this->_set_default_value_variable_globals($variables_identificadores_comprobantes);


        // --Variables de empresa usuaria 
        $this->load->model('get_data');
        $variable_empresa_usuaria_bd = $this->get_data->get_data_parametros_bd();

        $variables_empresa_usuaria = array(
            'sistema'=> 'TREBLOC-Sis', 'nombre_empresa'=> 'TREBLOC', 
            'logo_empresa'=> 'assets/img/logo_empresa.jpg',
            'razon_social' => '', 'ruc' => '', 
            'direccion' => 'Humbolt Nro.1218 puerta B - La victoria - Lima',
            'direccion_adicional' => 's/n',
            'contacto'=>'Cel. 999 888 456 - colbersiho@gmail.com',
            'rubro' => 'Desarrollo web'
        );

        foreach ($variable_empresa_usuaria_bd as $key => $value) {

            $nombre_variable = $value['nombre'];

            if(isset($this->$nombre_variable)){                
                $this->$nombre_variable = $value['texto'];
                unset($variables_empresa_usuaria[$value['nombre']]);
            }else{
                $this->parametros_trebloc[$value['nombre']]=$value['texto'];
            }
        }

        $variables_not_defined = $variables_empresa_usuaria;
        if(count($variables_not_defined)>0){
            $this->_set_default_value_variable_globals($variables_not_defined);
            $this->_alert_variables_not_defined($variables_not_defined);
        }
        
              
        /*public $sistema = 'PETROLMECANICA JC - TREBLOCs';
        public $nombre_empresa = 'PETROLMECANICA JC';
        public $nombre_empresa_abreviado = 'PETROLMECANICA JC';
        public $logo_empresa = 'assets/img/logo_empresa.jpg';
        public $razon_social = 'PETROLMECANICA JC S.A.C.';
        public $ruc = '20602440908';

        public $direccion = 'Pj. La Amistad nro. 145 Bar. Mollepampa - Cajamarca - Cajamarca';//'Jr. Alfonso ugarte Nro. 1800, Bar. Shucapampa - CAJAMARCA';
        public $direccion_adicional = 'Calle San francisco nro. 435 - urb. las palmeras - Jaen - Cajamarca';
        public $contacto = 'Telf.76622268 - cel.978833002 - petrolmecanica.jc@gmail.com';
        public $rubro = 'Venta al por mayor de otros tipos de maquinaria y equipo <br> Fabricación de productos metalicos para uso estructural';*/

             
    }

    //-------------------FUNCIONES OPERATIVAS --------------------

    public function _valid_session_open()
    {   
        if( !$this->session->userdata('logeado_sis') ){        
            redirect('login', 'location’');   

        }else{
            $this->nombre_usuario  = $this->session->userdata('username');
            $this->perfil_usuario  = $this->session->userdata('perfil');
        }

    }

    public function _set_default_value_variable_globals($default_values)
    {   
        foreach ($default_values as $key => $value) {
            $this->$key  = $value;
        }
    }

    public function _alert_variables_not_defined($values_not_defined)
    {   
        $list_variable_not_defined = '';
        foreach ($values_not_defined as $key => $value) {
            $list_variable_not_defined .= "<br> - ".$key;
        }

        $msg_login = " No se definieron valores para los parametros:  ".$list_variable_not_defined;
        $this->session->set_flashdata('error_login', $msg_login);
    }



  

}