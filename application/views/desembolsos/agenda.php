<?php 

function generate_input_form( $name_input, $label_input, $type_input, $value_input, $other_options  ) {
?>

<div class="form-group" >
  <label for="<?php echo $name_input;?>" class="col-xs-4 col-sm-2 control-label"><?php echo $label_input;?></label>
  <div class="col-xs-8 col-sm-10">
    <input type="<?php echo $type_input;?>" class="form-control" id="<?php echo $name_input;?>" name="<?php echo $name_input;?>" value="<?php echo $value_input;?>" <?php echo $other_options;?> >
  </div>
</div>

<?php 
} // -- end function generate_input_form


function generate_select_form( $name_input, $label_input, $array_value_input, $other_options  ) {
?>

<div class="form-group">
  <label for="<?php echo $name_input;?>" class="col-sm-2 control-label"><?php echo $label_input;?></label>

  <div class="col-sm-10">
    <select class="form-control" id="<?php echo $name_input;?>" name="<?php echo $name_input;?>" > 
        <?php 
        $id = 'id'; $texto = 'texto';
        foreach($array_value_input as $option) {
          echo "<option value='{$option[$id]}' > {$option[$texto]} </option>";
        }
      ?>
    </select>
  </div>
</div>

<?php 
} // -- end function select form


function create_box( $title_box_text, $th_thead_string, $td_tr_tbody_string ) {

?>

<div class="col-md-6">
  <div class="box">
    <div class="box-header">
        <h3 class="box-title"> <?php echo $title_box_text; ?> </h3>
        <div class="box-tools">        
          <div class="btn-group pull-right">
            <a type="button" class="btn btn-primary" href="<?php echo base_url('desembolsos/add_desembolso/'.$title_box_text); ?>">Nuevo</a>
          </div>
        </div>
    </div>

    <div class="box-body no-padding">
      <table class="table table-striped" >
        <thead>
          <tr> <?php echo html_entity_decode($th_thead_string); ?> </tr>
        </thead>          
        <tbody>
          <?php echo html_entity_decode($td_tr_tbody_string); ?> 
        </tbody>
      </table>

    </div>

  </div>

</div>

<?php 
} // -- end function create_box

function create_cabecera_th_thead_string( $columnas_cabecera ) {
  $th_thead_string = "";
  foreach ($columnas_cabecera as $key => $value) {
    $th_thead_string .= "<th> {$key} </th>";
  }
  return $th_thead_string ;

} // -- end function create_cabecera_th_thead_html


function create_data_td_tr_tbody_string( $data_cuerpo) {
  $td_tr_tbody_string = "";
  $sep = ",";

  foreach ($data_cuerpo as $key => $value) {
    $iddesembolso = $value['Id'];

    $td_tr_tbody_string .= '<tr id="desembolso_'.$iddesembolso .'" >';
    $parametros_para_modal_pago = $iddesembolso;

    foreach ($value as $skey => $svalue) {
      $td_tr_tbody_string .= "<td> {$svalue} </td>";
    }
    $td_tr_tbody_string .=  '<td><button type="button" class="btn btn-block btn-success btn-xs" 
    onclick="open_seteo_modal_pago('.$parametros_para_modal_pago.')" >Pagar </button></td>';
    $td_tr_tbody_string .= "</tr>";
  }
  return $td_tr_tbody_string;
} // -- end function create_data_td_tbody_html


?>


<div class="row">
  
    <?php 
      foreach ($data_tables as $key => $value) {

        $cabecera_th_thead_string = !empty($value) ? create_cabecera_th_thead_string( reset($value)) : "";
        $data_td_tr_tbody_string = !empty($value) ? create_data_td_tr_tbody_string( $value  ) :  "";

        create_box( 
          $key, 
          $cabecera_th_thead_string, 
          $data_td_tr_tbody_string
        );
      }
    ?>
</div>



<div class="modal fade" id="modal-pago_desembolso" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Registrar nuevo pago</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-hover">
          <?php echo $cabecera_th_thead_string; ?>   
          
          <tr id="detalle_desembolso_para_modal_pago"></tr>
        </table>

        <form class="form-horizontal" id="form_modal_pago_desembolso" style="background-color: #CCCCCC;">

          <input type="hidden" id="iddesembolso_a_pagar" name="iddesembolso_a_pagar" value="0">

          <?php generate_select_form( "metodo_pago","Metodo", $options_metodo_pago,"" ); ?>  

          <?php generate_input_form( "monto_pago", "Monto pago", "number", 0.00, "" ); ?> 
          
          <?php generate_input_form( "nro_operacion_pago", "Nro_operacion pago", "text", "", "placeholder='BCP 1002456.. '" ); ?>

          <textarea class="form-control" rows="2" placeholder="Observaciones..." id="observacion_pago" name="observacion_pago"></textarea>
  
        </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btn_save_modal_pago" onclick="save_pago_modal()">Registrar</button>
      </div>
    </div>

  </div>

</div>
