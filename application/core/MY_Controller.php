<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    //constructor, debe llamar al constructor de la clase parent
    
    public $controller = '';
    public $metodo = '';
    public $menu = '';
    
    public $nombre_usuario = '';
    public $perfil_usuario = '';

    // Variables de sistema sobre la empresa
    public $sistema = '';
    public $sistema_pestania_nombre = '';
    public $sistema_pestania_icono = '';

    public $nombre_empresa = '';
    public $nombre_empresa_abreviado = '';
    public $logo_empresa = '';
    public $razon_social = '';
    public $ruc = '';
    public $direccion = '';
    public $direccion_adicional = '';
    public $contacto = '';
    public $rubro = '';

    public $certificate_path = '';
    public $primaryKey_path = '';
    public $import_key = '';
    public $sello_firma_path = '';
	public $icono_sistema = '';

    // Variables de sistema sobre comprobantes
    public $id_ticket = 1;
    public $id_boleta = 3;
    public $id_factura = 2;
    public $id_proforma = 4;
    public $id_nota_entrada = 5;
    public $id_nota_salida = 6;
    public $id_certificado = 7;
    public $id_constancia = 8;
    public $id_acta = 9;
    public $id_garantia = 10;
    public $id_guia_remision = 11;
    public $id_certificado_trabajo = 12;
    public $id_contrato = 13;
    public $id_servicio_correctivo = 14;
    public $id_certificado_operatividad_tablero_electrico = 16;

    public function __construct()
    {
        parent::__construct(); 
        
        $variables_sistema_default = array(
            "sistema" =>'PETROLMECANICA JC - TREBLOCs',            
            "sistema_pestania_nombre" =>'PETROLMECANICA JC',
            "sistema_pestania_icono" =>'assets/img/icono_sistema.png',
            "nombre_empresa" =>'PETROLMECANICA JC',
            "nombre_empresa_abreviado" =>'PETROLMECANICA JC',
            "logo_empresa" =>'assets/img/logo_empresa.png',
            "razon_social" =>'PETROLMECANICA JC S.A.C.',
            "ruc" =>'20602440908',
            "direccion" =>'Pj. La Amistad nro. 145 Bar. Mollepampa - Cajamarca - Cajamarca',
            "direccion_adicional" =>'Calle San francisco nro. 435 - urb. las palmeras - Jaen - Cajamarca',
            "contacto" =>'Cel.978833002 | Correos: edinson@petrolmecanicajc.com,  petrolmecanica.jc@gmail.com',
            "rubro" =>'Venta al por mayor de otros tipos de maquinaria y equipo <br> Fabricación de productos metalicos para uso estructural',
            "certificate_path" =>'assets/key-bkp/C22080467303.crt',
            "primaryKey_path" =>'assets/key-bkp/C22080467303.pem',
            "import_key" =>'Edinjigue03109001',
            "sello_firma_path" =>'assets/img/firma_petrolmecanicajc.png',
            "icono_sistema" =>'assets/img/icono_sistema.png'
        );

        $this->ci = &get_instance();
        
        foreach ($variables_sistema_default as $key => $value) {
            //echo $this->ci->config->item('MY_Controller_'.$key);
            $this->$key = $this->ci->config->item('MY_Controller_'.$key);
        } 
        
    }

    public function _init( $cargar_menu, $cargar_url, $cargar_template )
    {       
    	if( !$this->session->userdata('logeado_sis') ){        
            redirect('login', 'location’');   
        }

        $this->nombre_usuario  = $this->session->userdata('username');
        $this->perfil_usuario  = $this->session->userdata('perfil');
        if($cargar_menu) {$this->menu = $this->_get_menu();} //obtener menu para el usuario en sesion
        if($cargar_url) {$this->_request_url();}//obtengo el pedio URL y reemplaza el controlador y metodo    
        if($cargar_template) {$this->output->set_template('adminlte');}//Carga el template
           
    }

    public function show_status( $msj_return_save, $id_documento )
    {       
        $this->metodo = 'Mostrar resultado';//Siempre define las migagas de pan
        $this->_init(true,false,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )

        $output = array( 'msj'=> $msj_return_save , 'idsave' => $id_documento ); 

        $this->load->js('assets/js/bootbox.min.js');
        $this->load->view('principal/show_status', $output ) ;
           
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

    
    

}