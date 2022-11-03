<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
 
class Pdf_comprobantes extends TCPDF
{
    function __construct($orientation='P', $unit='mm', $format='A4', $unicode=true, $encoding='UTF-8', $diskcache=false, $pdfa=false)
    {
        
        $this->format = $format ;
        $this->orientation = $orientation ;

        if( $orientation == 'L' ){
            $this->max_width = 287;  
            $this->max_heigth = 200;   
        }
        if( $format == 'Ticket_A' ){
            $format = array(60, 150);
            $this->max_width = 50;   
        }


        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);

        $MY_controller = & get_instance();
        //Parametros de la cabecera
        $this->sistema = $MY_controller->sistema ;
        $this->logo_empresa = $MY_controller->logo_empresa ;
        $this->razon_social = $MY_controller->razon_social ;
        $this->ruc = $MY_controller->ruc ;
        $this->rubro = $MY_controller->rubro ;
        $this->direccion = $MY_controller->direccion;
        $this->direccion_adicional = $MY_controller->direccion_adicional;
        $this->contacto = $MY_controller->contacto ;

        $this->certificate_path = $MY_controller->certificate_path;
        $this->primaryKey_path = $MY_controller->primaryKey_path;
        $this->import_key = $MY_controller->import_key;
        $this->sello_firma_path = $MY_controller->sello_firma_path; 
    }

    public $motivo = 'venta';
    public $max_width = 200;
    public $max_heigth = 287;
    public $h_footer = -12;
    public $pos_y=3.5;
    public $pos_x=5;

    public $orientation ;
    public $format  ;

    public $sistema;

    public $logo_empresa;
    public $razon_social;
    public $ruc;
    public $rubro;
    public $direccion;
    public $direccion_adicional;
    public $contacto;

    public $tipo_documento;
    public $nro_documento;
  
    //public $cuentas_bancarias = "Cuenta corriente BCP : 245-2459385-0-18 <br>Cuenta CCI BCP : 00224500245938501893 <br>Cuenta de detracciones BN : 00761153560<br> <br>Cuenta DÓLARES BCP: 395-9405242-1-51<br>Cuenta DÓLARES CCI BCP : 00239500940524215121<br>Cuenta SOLES Interbank : 7653004235004<br>Cuenta SOLES CCI Interbank : 003-765003004235004-58 ";        
    public $cuentas_bancarias = "Cuenta corriente BCP : 245-2459385-0-18 <br>Cuenta CCI BCP : 00224500245938501893 <br>Cuenta de detracciones BN : 00761153560<br> <br>Cuenta DÓLARES BCP: 395-9405242-1-51<br>Cuenta DÓLARES CCI BCP : 00239500940524215121<br>Cuenta SOLES Interbank : 7653004235004<br>Cuenta SOLES CCI Interbank : 003-765003004235004-58 <br>Cuenta DÓLARES Interbank : 7653004235011<br>Cuenta DÓLARES CCI Interbank : 003-765003004235011-53 ";   

    /* ---Sectores del comprobante ---*/

    public $logo_data = array ( 'mostrar'=> true , 'w'=> 45 , 'y' => 15);
    public $empresa_data = array ( 'align'=> 'J', 'w'=> 100 , 'ln' => 0 , 'font_h'=> 9 );
    public $comprobante_id = array ( 'border' => 1,'w' => 50, 'ln'=> 1, 'font_h'=> 10 );       
    public $receptor_data = array ( 'max_col'=>0,'border' => 1, 'ln' => 1 ,'w' => 200, 'font_h'=> 10);       
    public $comprobante_data = array ( 'max_col'=>0,'border' => 1, 'ln' => 1 ,'w' => 200, 'font_h'=> 10);      
    public $comprobante_table_head = array('font_h'=> 10 , 'max_w' => 200, 'border'=>1 , 'h'=>5 );     
    public $comprobante_table_body =array('font_h'=> 10 , 'border'=>'LR' , 'h'=>5 );      
    public $comprobante_table_footer_letras =array('w'=> 130 , 'border'=>1 , 'h'=>5 , 'ln' => false);           
    public $comprobante_table_footer_totales =array( 'align'=> 'R','w' => 70,'border'=>1 , 'h'=>5 , 'ln'=> 1 );  
    public $comprobante_codigo_qr = array( 'align'=> 'C','w' => 25,'border'=>0 ,'ln'=>0 , 'h'=>25);    
    public $comprobante_mensaje = array( 'align'=> 'L','w' =>  90,'border'=>1 ,'ln'=>0 ,'font_h'=> 10 , 'pos_x' => 5  );public $cuentas_bancarias_pie_pagina = array("file_path"=> "assets/img/petrolmecanicajc_cuentas_bancarias.jpg", 
							 "w" => 130 , "h" => 45 , "pos_x" => 5	);
    /* -- Firma digital parametros -- */
    public $certificate_path , $primaryKey_path, $import_key, $sello_firma_path ; 
    

    public function Header() {        

        $this->SetAuthor($this->razon_social);
        $this->SetSubject('Comprobante Electrónico');
        $this->SetKeywords('Comprobante, Electrónico');

        $this->set_formato($this->format);

        
        $h = 15;

        $this->SetXY($this->pos_x,$this->pos_y);

        if( $this->format == 'A4'){
            if($this->orientation == 'L'){
                $this->empresa_data['w'] = 160;
                $this->comprobante_id['w'] = 80;
            }

        }else if ( $this->format == 'Ticket_A' ){

            $this->logo_data['mostrar'] = false;
            $this->empresa_data['align'] = 'C';
            $this->empresa_data['w'] = $this->max_width;
            $this->empresa_data['ln'] = 1;
            $this->empresa_data['font_h'] = 7;
            $this->comprobante_id['font_h'] = 8;            
            $this->comprobante_id['border'] = 'TB';
            $this->comprobante_id['w'] = $this->max_width;
        }
        
        if($this->logo_data['mostrar']){
            $ld = $this->logo_data ;
            $this->Image($this->logo_empresa, $this->pos_x, $this->pos_y, $ld['w'], $ld['y'], 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);    
        }         


        $ed = $this->empresa_data;
        $this->SetFont('helvetica', '', $ed['font_h']);
        $text="<strong> {$this->razon_social} </strong><br>" ;
        switch ($this->tipo_documento) {
            case 'proforma':
                $text.=" {$this->direccion}<br>" ;
                $text.=" {$this->direccion_adicional}<br>";
                break;            
            default:
                $text.=" {$this->direccion}<br>" ;
                break;       
        }
        $text.=" {$this->contacto}<br>" ;
        //$text.=" www.petrolmecanicajc.com" ;
        $this->MultiCell( $ed['w'],'', $text,0, $ed['align'], 0, $ed['ln'], '','' , true,1,true  );


        switch ($this->motivo) {
            case 'venta':
                $text="<strong> R.U.C {$this->ruc} </strong><br>";
                $text.=" {$this->tipo_documento}<br>" ;
                $text.=" {$this->nro_documento} " ;
                break;

            case 'compra':
                $text="<strong> DOC. DE COMPRA </strong><br>";
                $text.=" {$this->tipo_documento}<br>" ;
                $text.=" {$this->nro_documento} " ;
                break;
            
            default:
                $text=" No identificado ";
                break;       
        }
        $ci = $this->comprobante_id;
        $this->SetFont('helvetica', '', $ci['font_h']);
        $this->MultiCell(  $ci['w'] , '', $text,  $ci['border'], 'C', 0, $ci['ln'], '','', true,1,true  );
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $mostrar_pie = true;
        if ( $this->format == 'Ticket_A' ){
            $mostrar_pie = false;
        }

        if($mostrar_pie){
            $this->SetY($this->h_footer);
            $this->Setx($this->pos_x);
            // Set font
            $this->SetFont('helvetica', 'I', 8);
            $text=" {$this->direccion} - " ;
            $text.=" {$this->contacto}" ;

            $this->MultiCell(80  * ($this->max_width/100), 8, $text, 1, 'L', 0 , 0);

            $this->MultiCell(20  * ($this->max_width/100), 8, 'Pagina '.$this->getAliasNumPage().' de '.$this->getAliasNbPages(), 1, 'R', 0 ,0);
        }
    }

    public function set_formato($formato = 'A4_V') {
        
        if( $formato == 'A4'){
            $this->setCellPaddings(1, 1.5, 1, '');
            $this->SetMargins(5, 23,5 );
        }else if($formato == 'Ticket_A'){
            $this->SetMargins(5, 30,5 );
        }
    }

    public function receptor_data($n_col , $data , $ln = true) {
        $this->set_formato($this->format);

        if($ln){
            $this->Ln(1);
        }else{
            $this->SetX( $this->GetX() + 5);   
        }
        
        if( $this->format == 'A4'){
            if($this->orientation == 'L'){
                $this->receptor_data['w'] = 140;
                $this->receptor_data['ln'] = 0;
            }

        }else if ( $this->format == 'Ticket_A' ){
            $this->receptor_data['w'] = $this->max_width;
            $this->receptor_data['font_h'] = 7;
            $this->receptor_data['max_col'] = 1;
            $this->receptor_data['border'] = 'B';
        }        

        $colspan = $i_row= 0;
        $max_colspan = array_sum( array_column($data, '1'));
        $max_rows = count($data);
        $rd = $this->receptor_data;

        $text= '<table>';
        $text.= '<tr>';

        foreach ($data as $key => $value) {

            if(!$rd['max_col']){
                $text.="<th colspan='".$value[1]."' > ".$key." : ".$value[0]."</th>" ;
                $colspan += $value[1];
                if($colspan % $n_col == 0  &&  $colspan < $max_colspan ) {
                    $text.= '</tr><tr>';
                }
            }else if($rd['max_col']){
                $i_row++;
                $text.="<th> ".$key." : ".$value[0]."</th>" ;
                if( $i_row < $max_rows ) {
                    $text.= '</tr><tr>';
                }
            }            
        }

        $text.='</tr>';
        $text.='</table>';
        
        $this->SetFont('helvetica', '', $rd['font_h']);
        $this->MultiCell( $rd['w'], '', $text, $rd['border'], 'L', 0,$rd['ln'], '', '', false, 0,true );      
        //echo $text;      exit();   
    }

    public function comprobante_data($n_col , $data ) {
        $this->set_formato($this->format);               

        $ln = true;//Salto de linea pdebajo del cuadro receptor data

        if( $this->format == 'A4'){
            if($this->orientation == 'L'){
                $this->comprobante_data['w'] = 140;
                $ln = false;
            }

        }else if ( $this->format == 'Ticket_A' ){
            $this->comprobante_data['w'] = $this->max_width;
            $this->comprobante_data['font_h'] = 7;
            $this->comprobante_data['max_col'] = 1;
            $this->comprobante_data['border'] = 'B';
        }

        if($ln){
            $this->Ln(1);  
        }else{
            $this->SetX( $this->GetX() + 5);   
        }         

        $colspan = $i_row= 0;
        $max_colspan = array_sum( array_column($data, '1'));
        $max_rows = count($data);
        $cd = $this->comprobante_data;

        $text= '<table>';
        $text.= '<tr>';

        foreach ($data as $key => $value) {

            if(!$cd['max_col']){
                $text.='<td colspan="'.$value[1].'" > '.$key.' : '.$value[0].'</td>' ;
                $colspan += $value[1];
                if($colspan % $n_col == 0  &&  $colspan < $max_colspan ) {
                    $text.= '</tr><tr>';
                }
            }else if($cd['max_col']){
                $i_row++;
                $text.='<td> '.$key.' : '.$value[0].'</td>' ;
                if( $i_row < $max_rows ) {
                    $text.= '</tr><tr>';
                }
            }            
        }

        $text.='</tr>';
        $text.='</table>';

       
        $this->SetFont('helvetica', '', $cd['font_h']);
        $this->MultiCell( $cd['w'], '', $text, $cd['border'], 'L', 0,$cd['ln'], '', '', false, 0,true );      
        //echo "<code>".$text."</code>";      exit();   
    }

    public function data_table( $data, $head_cols, $flag_nro_item = false ) {//suma de $widthcols = 200 - $flag_nro_item
        $this->set_formato($this->format);

        $this->Ln(1);        
        $this->SetFillColor(241, 241, 241);//color

        if( $this->format == 'A4'){
            if($this->orientation == 'L'){
                $this->comprobante_table_head['max_w'] = 285;
                $this->comprobante_table_head['border'] = 1;
            }

        }else if ( $this->format == 'Ticket_A' ){
            $this->comprobante_table_head['h'] = 4;
            $this->comprobante_table_head['border'] = 0;
            $this->comprobante_table_head['max_w'] = $this->max_width;
            $this->comprobante_table_head['font_h'] = 7;
            $this->comprobante_table_body['border'] = 0;
            $this->comprobante_table_body['h'] = 4;

            $flag_nro_item = false;
            $count_head_cols = count($head_cols) ;            


        } 
        //Calcular espacio libre y de saltos
        if ( $this->format == 'Ticket_A' ){

            $espacio_libre = $ind_esp_libre = $espacio_repartir= 0;
            for ($i=0; $i < $count_head_cols; $i++) {                 
                if( $head_cols[$i][1] >= 30 ){
                    $espacio_libre += $head_cols[$i][1];
                    $head_cols[$i][1] = 100; // % porcentaje
                    $ind_esp_libre ++;
                }
            }

            $espacio_repartir = number_format($espacio_libre / ( $count_head_cols - ($ind_esp_libre) ),2);

            for ($i=0; $i < $count_head_cols; $i++) {                 
                if( $head_cols[$i][1] < 30 ){                   
                    $head_cols[$i][1] += $espacio_repartir; // % porcentaje
                }
            }

        } 
        
        $th = $this->comprobante_table_head;
        $this->SetFont('helvetica', '', $th['font_h']);


        $nro_item_w = 0; //el width de item
        if($flag_nro_item){ //Mostrar nro de item
            $nro_item_w = 5 * ($th['max_w']/100);
            $this->comprobante_table_head['max_w'] -= $nro_item_w;

            $this->Cell($nro_item_w, $th['h'], 'Item', $th['border'], 0, 'C', 1); 
        }

        $th = $this->comprobante_table_head;

        //print_r($head_cols);exit();        
        foreach ($head_cols as $key => $value) {
            $cell_w = $value[1] * ($th['max_w']/100);//Calculo el espacio en porcetanje
            $align_td = ( isset($value[2]))? $value[2] :'C';
            $this->Cell($cell_w, $th['h'],  $value[0], $th['border'], 0, $align_td, 1);
            if($cell_w >=$th['max_w']){
                $this->Ln(); 
            }
        }        
        $this->Ln();
               
        

        $tb = $this->comprobante_table_body;
        $fill = $nro_item =  0;       

        foreach ($data as $key => $val) {

            $hc_i = 0;
            $h_min = 0;//heigt minimo

            foreach ($val as $skey => $svalue) {

                $cell_w = $head_cols[$hc_i][1] * ($th['max_w']/100);
                $new_h = $this->getNumLines($svalue,$cell_w);
                $h_min = ($new_h>$h_min)?$new_h:$h_min;
            }

            $h_min *= 6;//heigt minimo

            //Mostrar nro de item
            if($flag_nro_item){$this->Cell($nro_item_w, $h_min, ++$nro_item, $tb['border'], 0, 'R', $fill);}
            

            foreach ($val as $skey => $svalue) {
                $cell_w = $head_cols[$hc_i][1] * ($th['max_w']/100);                
                $align_td = ( isset($head_cols[$hc_i][2]))? $head_cols[$hc_i][2] :'L';

                $tb['h'] = $h_min;//heigt minimo
                $ln_new = 0;

                if($cell_w >=$th['max_w']){
                   $ln_new = 1;
                }
                //$this->Cell($cell_w, $tb['h'], $svalue, $tb['border'], 0,$align_td , $fill);
                $nuevo = $this->MultiCell($cell_w, $h_min, $svalue , $tb['border'], $align_td , $fill, $ln_new);
                
                $hc_i++;
                
            }
            $this->Ln(); 
             

            $fill = !$fill; //Flag de coor de celda  
        }

        $this->Cell($th['max_w'] + $nro_item_w, 2, '', 'T',0); 
        $this->Ln(1); 
             
//        
    }

    public function data_table_informacion( $data, $head_cols, $col_add_data, $flag_nro_item = false ) {//suma de $widthcols = 200 - $flag_nro_item
        $this->set_formato($this->format);

        $this->Ln(1);        
        $this->SetFillColor(241, 241, 241);//color

        if( $this->format == 'A4'){
            if($this->orientation == 'L'){
                $this->comprobante_table_head['max_w'] = 285;
                $this->comprobante_table_head['border'] = 1;
            }

        }else if ( $this->format == 'Ticket_A' ){
            $this->comprobante_table_head['h'] = 4;
            $this->comprobante_table_head['border'] = 0;
            $this->comprobante_table_head['max_w'] = $this->max_width;
            $this->comprobante_table_head['font_h'] = 7;
            $this->comprobante_table_body['border'] = 0;
            $this->comprobante_table_body['h'] = 4;

            $flag_nro_item = false;
            $count_head_cols = count($head_cols) ;            


        } 
        //Calcular espacio libre y de saltos
        if ( $this->format == 'Ticket_A' ){

            $espacio_libre = $ind_esp_libre = $espacio_repartir= 0;
            for ($i=0; $i < $count_head_cols; $i++) {                 
                if( $head_cols[$i][1] >= 30 ){
                    $espacio_libre += $head_cols[$i][1];
                    $head_cols[$i][1] = 100; // % porcentaje
                    $ind_esp_libre ++;
                }
            }

            $espacio_repartir = number_format($espacio_libre / ( $count_head_cols - ($ind_esp_libre) ),2);

            for ($i=0; $i < $count_head_cols; $i++) {                 
                if( $head_cols[$i][1] < 30 ){                   
                    $head_cols[$i][1] += $espacio_repartir; // % porcentaje
                }
            }

        } 
        
        $th = $this->comprobante_table_head;
        $this->SetFont('helvetica', '', $th['font_h']);


        $nro_item_w = 0; //el width de item
        if($flag_nro_item){ //Mostrar nro de item
            $nro_item_w = 5 * ($th['max_w']/100);
            $this->comprobante_table_head['max_w'] -= $nro_item_w;

            $this->Cell($nro_item_w, $th['h'], 'Item', $th['border'], 0, 'C', 1); 
        }

        $th = $this->comprobante_table_head;

        //print_r($head_cols);exit();        
        foreach ($head_cols as $key => $value) {
            $cell_w = $value[1] * ($th['max_w']/100);//Calculo el espacio en porcetanje
            $align_td = ( isset($value[2]))? $value[2] :'C';
            $this->Cell($cell_w, $th['h'],  $value[0], $th['border'], 0, $align_td, 1);
            if($cell_w >=$th['max_w']){
                $this->Ln(); 
            }
        }        
        $this->Ln();

        $tb = $this->comprobante_table_body;
        $fill = $nro_item =  0;       

        foreach ($data as $key => $val) {

            $hc_i = 0; // order de width para las cabecera
            $h_min = 0;//heigt minimo

            //Eliminar parte de array 
            $data_add = trim($val[$col_add_data["data"]]);
            unset($val[$col_add_data["data"]]);

            foreach ($val as $skey => $svalue) {

                $cell_w = $head_cols[$hc_i][1] * ($th['max_w']/100);
                $new_h = $this->getNumLines($svalue,$cell_w);
                $h_min = ($new_h>$h_min)?$new_h:$h_min;

            }

            $h_min *= 6;//heigt minimo

            //Mostrar nro de item
            if($flag_nro_item){$this->Cell($nro_item_w, $h_min, ++$nro_item, $tb['border'], 0, 'R', $fill);}    

            foreach ($val as $skey => $svalue) {
                $cell_w = $head_cols[$hc_i][1] * ($th['max_w']/100);                
                $align_td = ( isset($head_cols[$hc_i][2]))? $head_cols[$hc_i][2] :'L';

                $tb['h'] = $h_min;//heigt minimo
                $ln_new = 0;

                if($cell_w >=$th['max_w']){
                   $ln_new = 1;
                }
                //$this->Cell($cell_w, $tb['h'], $svalue, $tb['border'], 0,$align_td , $fill);
                $nuevo = $this->MultiCell($cell_w, $h_min, $svalue , $tb['border'], $align_td , $fill, $ln_new);
                
                $hc_i++;
                
            }
            $this->Ln(); 

            if(trim($data_add)!= '' && !is_null($data_add) ){

                $hc_i = 0; // order de width para las cabecera
                $h_min = 0;//heigt minimo

                foreach ($val as $skey => $svalue) {

                    $val_data_add = $skey == $col_add_data['col_add'] ? $data_add : '';

                    $cell_w = $head_cols[$hc_i][1] * ($th['max_w']/100);
                    $new_h = $this->getNumLines($val_data_add,$cell_w);
                    $h_min = ($new_h>$h_min)?$new_h:$h_min;
                    $hc_i++;
                }

                if( $h_min > 5 ){
                    $data_add = "[...]";
                    $h_min = 1;
                }


                $h_min *= 4;//heigt minimo

                $hc_i = 0;
                $this->SetFont('helvetica', '', $th['font_h'] - 2);

                if($flag_nro_item){$this->Cell($nro_item_w, $h_min, '', $tb['border'], 0, 'R', $fill);}
                
                foreach ($val as $skey => $svalue) {
                    $cell_w = $head_cols[$hc_i][1] * ($th['max_w']/100);                
                    $align_td = ( isset($head_cols[$hc_i][2]))? $head_cols[$hc_i][2] :'L';

                    $tb['h'] = $h_min;//heigt minimo
                    $ln_new = 0;

                    if($cell_w >=$th['max_w']){ $ln_new = 1;}

                    $val_data_add = $skey == $col_add_data['col_add'] ? "  ".$data_add : '';
                    
                    $nuevo = $this->MultiCell($cell_w, $h_min, $val_data_add , $tb['border'], $align_td , $fill, $ln_new);
                    
                    $hc_i++;
                    
                }
                $this->SetFont('helvetica', '', $th['font_h']);


                $this->Ln(); 
            }


            $fill = !$fill; //Flag de coor de celda  
        }

        $this->Cell($th['max_w'] + $nro_item_w, 2, '', 'T',0); 
        $this->Ln(1); 
             
//        
    }

    public function data_table_footer( $formato, $data ,$msj) {

        if( $this->format == 'A4'){
           
            $this->comprobante_codigo_qr['w'] = 25;
            $this->comprobante_codigo_qr['h'] = 25;

            if($this->orientation == 'L'){
                $this->comprobante_table_footer_letras['w'] = 215;
                $this->comprobante_table_footer_totales['w'] = 70;
                $this->comprobante_table_footer_letras['h'] = 5;
                $this->comprobante_table_footer_totales['h'] = 5;
                $this->comprobante_mensaje['w'] = 170;
            }
            if($this->getY() > $this->max_heigth ){
                $this->Ln(5);
            }            

            $pos_y_footer = $this->getY();
            $pos_x_footer = $this->getX();         

            $this->comprobante_codigo_qr['pos_y'] = $pos_y_footer + 8;
            $this->comprobante_mensaje['pos_y'] = $pos_y_footer + 8;
            $this->comprobante_mensaje['pos_x'] = $pos_x_footer +  $this->comprobante_codigo_qr['w'] + 10;

        }elseif ( $this->format == 'Ticket_A' ){
            $this->comprobante_table_footer_letras['w'] = $this->max_width;
            $this->comprobante_table_footer_letras['h'] = 4;
            $this->comprobante_table_footer_letras['ln'] = 1;
            $this->comprobante_table_footer_totales['w'] = $this->max_width;
            
            $this->comprobante_table_footer_letras['border'] = 0; 
            $this->comprobante_codigo_qr['w'] = $this->max_width ;
            $this->comprobante_codigo_qr['ln'] = 1;
            $this->comprobante_codigo_qr['align'] = 'C';
            $this->comprobante_codigo_qr['pos_y'] = '';

            $this->comprobante_mensaje['w'] = $this->max_width;
            $this->comprobante_mensaje['align'] = 'C';
            $this->comprobante_mensaje['border'] = 0;

        }

        $ctfl = $this->comprobante_table_footer_letras;
        $ctft = $this->comprobante_table_footer_totales;
        $cqr = $this->comprobante_codigo_qr;
        $cm = $this->comprobante_mensaje;
		$cta_bcas = $this->cuentas_bancarias_pie_pagina;


        if($formato == 'monto_venta'){

            
            $texto_letras = (isset($data['monto_letra']['texto'])) ? $data['monto_letra']['texto'] : ' - '  ;
           
            $this->MultiCell( $ctfl['w'] , $ctfl['h'], 'son : '.$texto_letras, $ctfl['border'], 'L',false,$ctfl['ln'],'','',true,0,true );

            $op_gravada = (isset($data['monto']['op_gravada'])) ? $data['monto']['op_gravada'] : '0.00'  ;
            $op_gratuitas = (isset($data['monto']['op_gratuitas'])) ? $data['monto']['op_gratuitas'] : '0.00'  ;
            $op_exonerados = (isset($data['monto']['op_exonerados'])) ? $data['monto']['op_exonerados'] : '0.00'  ;
            $op_inafectas = (isset($data['monto']['op_inafectas'])) ? $data['monto']['op_inafectas'] : '0.00'  ;
            $op_igv = (isset($data['monto']['op_igv'])) ? $data['monto']['op_igv'] : '0.00'  ;
            $op_importe = (isset($data['monto']['op_importe'])) ? $data['monto']['op_importe'] : '0.00'  ;

            $text= "<table>";
            $text.="<tr><th>GRAVADA   </th>    <td>$op_gravada</td></tr>";
            //$text.="<tr><th>OP. Gratuitas   </th>    <td>$op_gratuitas</td></tr>";
            $text.="<tr><th>EXONERADA  </th>    <td>$op_exonerados</td></tr>";
            //$text.="<tr><th>OP. Inafectas   </th>    <td>$op_inafectas</td></tr>";
            $text.="<tr><th>I.G.V (18%)     </th>    <td>$op_igv</td></tr>";
            $text.="<tr><th>TOTAL   </th>    <td>$op_importe</td></tr>";
            $text.="</table>";


            $this->MultiCell( $ctft['w'],'', $text,$ctft['border'], $ctft['align'],false,$ctft['ln'],'','',true,0,true );

            $imgdata = base64_decode($data['qr_code']);
            //$this->Image('@'.$imgdata, 10,245 , 28, 28);

            $this->Image('@'.$imgdata, '', $cqr['pos_y'] , $cqr['w'], $cqr['h']   );
           
            //$this->MultiCell( $cqr['w'], '', 'QR' , $cqr['border'], $cqr['align'],false,$cqr['ln'],'', $cqr['pos_y'],true,0,true );

            $this->SetFont('', '', 7);
            //$text= "Bienes transferidos en la amazonía para ser consumidos en la misma<br>";
            $text= "Agradecemos su preferencia<br>";
            $text.="Representación de Comprobante Electrónico<br>";
            $text.="Generado por {$this->sistema} <br>";
            //$text.="Representación impresa de la FACTURA ELECTRÓNICA, visita www.nubefact.com/20602440908 ";
            //$text.="<br>".$this->cuentas_bancarias;
            $this->MultiCell( $cm['w'], '', $text,  $cm['border'],  $cm['align'],false, 1,$cm['pos_x'], $cm['pos_y'] ,true,0,true );
			
			$eje_x_cta_bca_img = $cm['pos_x'];
			$eje_y_cta_bca_img = $this->GetY() + 1;
			$this->Image($cta_bcas["file_path"], $eje_x_cta_bca_img, $eje_y_cta_bca_img, $cta_bcas["w"], $cta_bcas["h"], 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
			

        }elseif($formato =='pie_movimiento'){

            $cm['w'] = $ctfl['w'];
            $cm['border'] = 0;

            $this->SetFont('', '', 8);
            $text= "*Este documento representa un movimiento en almacén <br>";
            $this->MultiCell( $cm['w'], '', $text,  $cm['border'],  $cm['align'],false,0,'', '',true,0,true );


            $op_importe = (isset($data['monto']['op_importe'])) ? $data['monto']['op_importe'] : '0.00'  ;

            $this->SetFont('', '', 9);
            $text= "<table>";
            $text.="<tr><th>TOTAL  </th>    <td>$op_importe</td></tr>";
            $text.="</table>";
            $this->MultiCell( $ctft['w'],'', $text,$ctft['border'], $ctft['align'],false,$ctft['ln'],'','',true,0,true );

        }elseif( $formato == 'pie_proforma'){
            
            $cm['border'] = 1;


            $this->SetFont('', '', 10);

            $texto_letras = (isset($data['monto_letra']['texto'])) ? $data['monto_letra']['texto'] : ' - '  ;
           
            $this->MultiCell( $ctfl['w'] , $ctfl['h'], 'son : '.$texto_letras, $ctfl['border'], 'L',false,$ctfl['ln'],'','',true,0,true );

            $op_importe = (isset($data['monto']['op_importe'])) ? $data['monto']['op_importe'] : '0.00'  ;

            
            $text= "<table>";
            $text.="<tr><th>TOTAL</th> <th>   </th>    <td>$op_importe</td></tr>";
            $text.="</table>";
            $this->MultiCell( $ctft['w'],$ctft['h'], $text,$ctft['border'], $ctft['align'],false,$ctft['ln'],'','',true,0,true );
            $this->Ln();

            $observacion = (isset($data['observacion']['texto'])) ? $data['observacion']['texto'] : '  '  ;

            $this->SetFont('', '', $cm['font_h']);
            $text= "Obs : ".$observacion." <br>";
            $text.="<br>".$this->cuentas_bancarias;
            $this->MultiCell( $ctfl['w'] + $ctft['w'], '', $text,  $cm['border'],  $cm['align'],false,1,'', '',true,0,true );

        }   elseif( $formato == 'pie_guia'){
			
            
			
            $observacion = (isset($data['observacion']['texto'])) ? $data['observacion']['texto'] : '  '  ;
            $this->SetFont('', '', $cm['font_h']);
            $text= "Observaciones .: ".$observacion." <br>";
			$this->MultiCell( $this->max_width, '', $text,  $cm['border'],  $cm['align'],false,1,'', '',true,0,true );
			
			$eje_x_cta_bca_img = $this->GetX();
			$eje_y_cta_bca_img = $this->GetY() + 1;
			$this->Image($cta_bcas["file_path"], $eje_x_cta_bca_img, $eje_y_cta_bca_img, $cta_bcas["w"], $cta_bcas["h"], 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);    


        }    

        $this->Ln(1);    


    }

    public function add_firma_digital() {

        $certificate = 'file://'.realpath($this->certificate_path);
        $primaryKey = 'file://'.realpath($this->primaryKey_path);
        $import_key = $this->import_key; //'Edinjigue03109001';//'colbert1234';
        $sello_firma_path = $this->sello_firma_path;// 'assets/img/firma_petrolmecanicajc.png';
        
        $sello_firma_tamanio_porcentaje = 0.14;
        $sello_firma_ancho_tamanio = 497 * $sello_firma_tamanio_porcentaje;
        $sello_firma_altura_tamanio = 159 * $sello_firma_tamanio_porcentaje;
        $sello_firma_pos_x = 110;        
        $sello_firma_pos_y = $this->GetY() >= 245 ? 255 : $this->GetY() + 5;

        $firma_array_info = array();        

        $this->Image($sello_firma_path, $sello_firma_pos_x , $sello_firma_pos_y,  $sello_firma_ancho_tamanio, $sello_firma_altura_tamanio, 'PNG');
        $this->setSignature($certificate, $primaryKey, $import_key, '', 2, $firma_array_info);
        $this->setSignatureAppearance($sello_firma_pos_x , $sello_firma_pos_y,  $sello_firma_ancho_tamanio, $sello_firma_altura_tamanio);        
    }

    public function add_imagen(){ //add_imagenes de logos de empresa en cabecera
        $this->Ln(1);
        
        $imags = array( array('img' => 'aile.jpg', 'w'=> 20, 'h' => 10, 'esp' => 1  ),
            array('img' => 'blue_retina.png', 'w'=> 17.65, 'h' => 10, 'esp' => 1  ),
            array('img' => 'cim_tek.png', 'w'=> 27, 'h' => 9.72, 'esp' => 1  ),
            array('img' => 'dresser.png', 'w'=> 21, 'h' => 10, 'esp' => 1   ),            
            array('img' => 'GVR_logo.jpg', 'w'=> 20, 'h' => 10, 'esp' => 1   ),
            array('img' => 'kolorkut.jpg', 'w'=> 38, 'h' => 10, 'esp' => 1   ),
            array('img' => 'fe_petro.jpg', 'w'=> 33, 'h' => 10, 'esp' => 1   ),
            array('img' => 'Kraus.jpg', 'w'=> 25, 'h' => 10, 'esp' => 1  ),
            array('img' => 'opw.jpg', 'w'=> 38, 'h' => 9, 'esp' => 1  ),
            array('img' => 'red_jacket.jpg', 'w'=> 29, 'h' => 6, 'esp' => 1  ),
            array('img' => 'tokheim.jpg', 'w'=> 26, 'h' => 10, 'esp' => 1  ),
         );


        $x_default = $pos_x =$this->GetX() - 5;
        $y_default = $this->GetY();

        $salto_linea = 10;
        foreach ($imags as $key => $val) { 

            $path_img = 'assets/img_logos/'.$val['img'];            
            $this->Image($path_img,$x_default,$y_default,$val['w'],$val['h'],'', '', '', false, 300, '', false, false, 0);
            $x_default+= $val['w'] + $val['esp'];

            if ($x_default > $this->max_width - 15) {

                $x_default = $pos_x;
                $y_default += 10;
                $salto_linea +=11;
            }
        }

        $this->Ln($salto_linea );
    }

    public function anexo_informacion( $data, $flag_nro_item = false ) {//suma de $widthcols = 200 - $flag_nro_item
        /*$this->SetAutoPageBreak(TRUE, 10);
        $this->AddPage();*/
        
        $this->Ln(10);
        //echo "string".$this->GetY();   
        $this->Sety($this->GetY());
        $this->Setx($this->pos_x);
        
        $this->Ln(1);
        $this->Cell(0, 6, 'ANEXO - DETALLE DE PRODUCTOS', 0, 1, 'C', 1); 
        $this->Ln(1); 

        $tb = $this->comprobante_table_body;
        $fill = $nro_item =  0;       

        foreach ($data as $key => $val) {

            $nro_item++;
            $this->SetFont('helvetica', '', 10);
            $this->Setx($this->pos_x);
            $producto = $nro_item.".- ".$val['descripcion'];
            $this->Cell(0, 6, $producto, 'LTR', 1, 'L', $fill); 
            //$w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false,
            
            $this->SetFont('helvetica', '', 8);  
            $info = str_replace("\n", "<br>",$val['info']);
            $this->writeHTML($info, 1, 0, 1, 0, 'J');            
            $this->Ln(1);              

            $fill = !$fill; //Flag de coor de celda  
        }

        $this->Ln(1); 
             
//        
    }

}
