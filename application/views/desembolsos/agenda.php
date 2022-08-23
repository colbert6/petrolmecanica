
<?php 

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
      <table class="table table-striped">
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


function create_data_td_tr_tbody_string( $data_cuerpo ) {
  $td_tr_tbody_string = "";
  foreach ($data_cuerpo as $key => $value) {
    $td_tr_tbody_string .= "<tr>";
    foreach ($value as $skey => $svalue) {
      $td_tr_tbody_string .= "<td> {$svalue} </td>";
    }
    $td_tr_tbody_string .=  '<td><button type="button" class="btn btn-block btn-success btn-xs">Pagar </button></td>';
    $td_tr_tbody_string .= "</tr>";
  }
  return $td_tr_tbody_string;
} // -- end function create_data_td_tbody_html


?>


<div class="row">
  
    <?php 
      foreach ($data_tables as $key => $value) {

        $cabecera_th_thead_string = !empty($value) ? create_cabecera_th_thead_string( reset($value)) : "";
        $data_td_tr_tbody_string = !empty($value) ? create_data_td_tr_tbody_string( $value ) :  "";

        create_box( 
          $key, 
          $cabecera_th_thead_string, 
          $data_td_tr_tbody_string
        );
      }
    ?>
</div>
