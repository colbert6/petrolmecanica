<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->controller = 'Productos';//Siempre define las migagas de pan
        
    }


    public function lista()
    {
        
        $this->metodo = 'Lista';//Siempre define las migagas de pan

        $this->load->library('grocery_CRUD');
        $this->load->js('assets/myjs/groceryCRUD.js');
        $crud = new grocery_CRUD();

        $crud->set_table('producto');
        $crud->columns('codbarras','marca_idmarca','categoria_idcategoria','nombre','estado');

        $crud->display_as('marca_idmarca','Marca');
        $crud->display_as('categoria_idcategoria','Categoria',null,'nombre ASC');
        $crud->unset_fields('codproducto');


        $crud->set_subject('Producto');
        $crud->set_relation('marca_idmarca','marca','nombre');
        $crud->set_relation('categoria_idcategoria','categoria','nombre');   
        $crud->set_relation('presentacion_minima','presentacion','nombre'); 
        //$crud->set_relation('codproducto','categorias_sunat','descripcion');        

        $crud->required_fields('nombre','categoria_idcategoria','presentacion_minima');//'codbarras','marca_idmarca'

        //$crud->required_fields(array('codbarras','nombre'));
        $crud->unique_fields(array('codbarras'));

        $crud->set_field_upload('foto','assets/uploads/productos');

        $crud->order_by('marca_idmarca','desc');

        $crud->add_action('Etiqueta QR', '', base_url('productos/print_etiqueta_qr?idproducto='),'fa fa-print imprimir');

        $crud->unset_add_fields('estado');
        
        $crud->unset_delete();
        $output = $crud->render();
        $output->title = 'Productos';

        $this->_init(true,true,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )
        $this->load->view('grocery_crud/basic_crud', (array)$output ) ;
    }

    public function print_etiqueta_qr()
    {   

        $this->load->model('producto');

        $orientation = 'P' ;
        $format = 'A4';
        if(isset($_GET['orientation'])){
            $orientation = $this->input->get('orientation');

        }
        if(isset($_GET['format'])){
            $format = $this->input->get('format');
        }
        
        $format = 'Ticket_A';

        $producto = $this->producto->get_print_etiqueta_qr($this->input->get('idproducto'));
        
        if( empty($producto) ){ die('<h3>NO SE ENCONTRARON RESULTADOS</h3>'); exit();};

        $nombrepdf  = $producto['nombre_completo'];

        //echo '<pre>';print_r($producto);exit();
        $this->load->library('Pdf_productos');
        $pdf = new Pdf_productos($orientation, 'mm', $format , true, 'UTF-8', false);
   

        //Parametros del PDF
        $pdf->SetTitle($nombrepdf);
        
        $pdf->SetAutoPageBreak(TRUE, 10);
        $pdf->AddPage();


        $data_resumen = "https://www.petrolmecanicajc.com";//.$producto['nombre_completo'];
        $qr_code = $this->crear_qr($data_resumen); 


        $data_footer = array('qr_code' =>  $qr_code   );
        $pdf->add_etiqueta_qr(  $data_footer );


         /* Limpiamos la salida del búfer y lo desactivamos */
        ob_end_clean();
        $pdf->Output($nombrepdf.'.pdf', 'I');
    }


    public function crear_qr($data_text = 'hola Petrolmecanica', $name_file='qr_code'){

        $this->load->library('ciqrcode');

        $codeContents = $data_text;
        $tempDir = 'public/qr_code/';//EXAMPLE_TMP_SERVERPATH; 
        $fileName = $name_file.'.jpg'; 
        $outerFrame = 0; //tamaño de borde
        $pixelPerPoint = 6; //tamaño de los pixeles por point
        $jpegQuality = 150;  // calidad de imagen

        // generating frame 
        $frame = QRcode::text($codeContents, false, QR_ECLEVEL_M); 
        // rendering frame with GD2 (that should be function by real impl.!!!) 
        $h = count($frame); 
        $w = strlen($frame[0]); 
         
        $imgW = $w + 2*$outerFrame; 
        $imgH = $h + 2*$outerFrame; 
         
        $base_image = imagecreate($imgW, $imgH); 
         
        $col[0] = imagecolorallocate($base_image,255,255,255); // BG, white  
        $col[1] = imagecolorallocate($base_image,0,0,0);     // FG, Black 

        imagefill($base_image, 0, 0, $col[0]); 

        for($y=0; $y<$h; $y++) { 
            for($x=0; $x<$w; $x++) { 
                if ($frame[$y][$x] == '1') { 
                    imagesetpixel($base_image,$x+$outerFrame,$y+$outerFrame,$col[1]);  
                } 
            } 
        } 
         
        // saving to file 
        $target_image = imagecreate($imgW * $pixelPerPoint, $imgH * $pixelPerPoint); 
        imagecopyresized( 
            $target_image,  
            $base_image,  
            0, 0, 0, 0,  
            $imgW * $pixelPerPoint, $imgH * $pixelPerPoint, $imgW, $imgH 
        ); 
        imagedestroy($base_image); 
        imagejpeg($target_image, $tempDir.$fileName, $jpegQuality); 
        imagedestroy($target_image); 

        $path = $tempDir.$fileName;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);

        //$qr_code= 'data:image/' . $type . ';base64,' . base64_encode($data);
        //echo '<img src="' . $qr_code . '">';
        $qr_code= base64_encode($data);
        return $qr_code;
    }
    
    public function json_lista_id($id=""){
        $this->load->model('producto');
        print json_encode($this->producto->get_lista_id($id));
    }

    public function json_lista_barras($id=""){
        $this->load->model('producto');
        print json_encode($this->producto->get_lista_barras($id));
    }


    

}
