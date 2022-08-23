
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
} // -- end function create_box

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
} // -- end function create_box



?>

<div class="row" id="form">
  <!-- left column -->
  <div class="col-md-6">
    <div class="box box-info">     

      <form class="form-horizontal">
        <div class="box-body">
          <?php //generate_input_form( $name_input, $label_input, $type_input, $value_input, $other_options  ) ?>
          
          <?php generate_input_form( "tipo_beneficiario", "Tipo", "text", $tipo_beneficiario_default, "readonly" ); ?> 
          
          <?php echo $get_busqueda_general; ?>

          <?php generate_input_form( "fecha_pago_desembolso","Fecha pago", "date", date('Y-m-d'), "" ); ?> 

          <?php 
          $options_metodo_pago =  array(
            array('id'=>'deposito_bancario','texto'=>'deposito_bancario'),
            array('id'=>'efectivo','texto'=>'efectivo'),
            array('id'=>'otro','texto'=>'otro')
          );
          generate_select_form( "metodo_pago","Metodo", $options_metodo_pago,"" ); ?>  

          <?php generate_input_form( "nro_operacion_desembolso", "Nro_operacion desembolso", "text", "", "placeholder='BCP 1002456.. '" ); ?>

          <?php generate_input_form( "pago_desembolso", "Pago", "number", 0.00, "" ); ?> 

          <?php generate_input_form( "saldo_a_cuenta", "Saldo", "number", 0.00, "" ); ?>

          <textarea class="form-control" rows="2" placeholder="Tareas a realizar o Comprobantes..." id="concepto_desembolso" name="concepto_desembolso"></textarea>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="<?php echo base_url('desembolsos/agenda_general'); ?>">ir a Agenda general</a>
          <button type="button" class="btn btn-success pull-right" id="btn_save" onclick="save()">Generar</button>

        </div>
        <!-- /.box-footer -->
      </form>
    </div>

  </div>  

  

</div>

<script type="text/javascript"> base_url = "<?php echo base_url();  ?>"</script>

