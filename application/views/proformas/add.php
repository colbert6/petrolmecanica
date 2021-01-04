<style type="text/css">
  #div_detalle_venta{
    max-height: 350px;
    overflow-y: scroll;  
  }


</style>


<div class="row" id="form">
  <!-- left column -->
  <div class="col-md-4">
    <div class="box box-info">     

      <form class="form-horizontal">
        <div class="box-body">

          <div class="form-group" style="margin-bottom: 0px;">
            <label for="fecha_venta" class="col-xs-4 col-sm-2 control-label">Fecha</label>
            <div class="col-xs-8 col-sm-10">
              <input type="date" class="form-control" id="fecha_emision" name="fecha_emision" value="<?php echo date('Y-m-d');?>" readonly="readonly">
            </div>
          </div>

          <div class="form-group">
            <label for="idserie" class="col-xs-4 col-sm-2 control-label">Cod.</label>
            <div class="col-xs-8 col-sm-10">              
              <input type="text" class="form-control" id="correlativo" name="correlativo" placeholder="Correlativo" readonly="readonly" value="<?php echo $correlativo_proforma[0]->correlativo; ?>">
            </div>
          </div>

          <?php echo $get_clientes; ?>

          <div class="form-group" style="margin-bottom: 0px;display: none">
            <label for="idserie" class="col-xs-5 col-sm-5 control-label">T. Comprobante</label>
            <div class="col-xs-7 col-sm-7">
              <select class="form-control" id="idserie" name="idserie" > 
                  <?php foreach($series as $tc) {
                    echo "<option value='{$tc->idserie}' > {$tc->tipo_comprobante} </option>";
                  }
                ?>
              </select>
            </div>
          </div>  

          <div class="form-group" style="margin-bottom: 0px;">
            <label for="tipo_pago" class="col-xs-5 col-sm-5 control-label">Moneda<!--Tipo Pago--></label>
            <div class="col-xs-7 col-sm-7">
               <select class="form-control" id="idtipo_pago" name="idtipo_pago" > 
                  <?php foreach($tipo_pagos as $tp) {
                    echo "<option value='{$tp->id}' > {$tp->descripcion} </option>";
                  }
                ?>
              </select>
            </div>
          </div> 

          <div class="form-group"  style="display: none">
            <label for="tipo_pago" class="col-xs-5 col-sm-5 control-label">Periodo Pago</label>
            <div class="col-xs-7 col-sm-7">
              <select class="form-control" id="idperiodo_pago" name="idperiodo_pago" > 
                  <?php foreach($periodo_pagos as $pp) {
                    echo "<option value='{$pp->id}' > {$pp->descripcion} </option>";
                  }
                ?>
              </select>
            </div>
          </div>         

          <textarea class="form-control" rows="2" placeholder="Observaciones ..." id="observacion" name="observacion"></textarea>
          

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="<?php echo base_url('proformas/lista'); ?>">ir a Lista proformas</a>
          <button type="button" class="btn btn-success pull-right" id="btn_save" onclick="save()">Generar</button>

        </div>
        <!-- /.box-footer -->
      </form>
    </div>

  </div>  

  <div class="col-md-8">
    <div class="box box-success">
      <div class="box-header with-border">

        <?php echo $get_productos; ?>
        
      </div>
      <div class="box-body">

        <div id="div_detalle_venta">

            
        <div class="col-xs-12 col-md-6 item" style="padding-right: 0px;padding-bottom: 4px;" id_prod="1">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="button" class="btn btn-danger btn-flat">
                <i class="fa fa-times" onclick="remover_detalle_venta(1)"></i></button></span>
                <input class="form-control" name="prodtext[]" value="pistola automática 3/4&quot;"><input type="hidden" name="idprod[]" value="1">
            <span class="input-group-btn">
              <button type="button" class="btn btn-info btn-flat">
                <i class="fa fa-sort-amount-desc" onclick="add_descripcion_producto_venta(1)"></i></button></span>
          </div>  
        </div>  

        <div class="col-xs-4 col-md-2 item_cantidad" style="padding-right: 0px;padding-bottom: 4px;" id_prod="1"><input type="number" name="cant[]" class="form-control" placeholder="Cantidad" value="1" onkeyup="calcular_subtotal(1)" onchange="calcular_subtotal(1)"></div><div class="col-xs-4 col-md-2 item_precio" style="padding-right: 0px;padding-bottom: 4px;" id_prod="1"><input type="number" name="prec[]" class="form-control" placeholder="Precio" value="0.00" onkeyup="calcular_subtotal(1)" onchange="calcular_subtotal(1)"></div><div class="col-xs-4 col-md-2 item_subtotal" style="padding-right: 0px;padding-bottom: 4px;" id_prod="1"><input type="number" class="form-control" readonly="" tabindex="-1" value="0.00"></div>

        <div class="col-xs-12 col-md-12 item" style="padding-right: 0px;padding-bottom: 4px;" id_prod="1">
          <textarea class="form-control"></textarea>
        </div>

            
        </div>  


      </div>
      <!-- /.box-body -->
      <div class="box-footer">

        <label style="text-align: right;"> # Articulos : <span id="cantidadItem">0</span></label>

        <div class="row">

            <div class="form-group" style="margin-bottom: 0px;">
              <label for="subtotales" class="col-xs-4 col-sm-2 control-label" >SubTotal </label>
              <div class="col-xs-8 col-sm-4">
                <input type="number" class="form-control" id="subtotales" name="subtotales" value="0.00" readonly="readonly" >
              </div>
            </div>

            <div class="form-group" style="margin-bottom: 0px;">
              <label for="igv" class="col-xs-4 col-sm-2 control-label" >IGV </label>
              <div class="col-xs-8 col-sm-4">
                <input type="number" class="form-control" id="igv" name="igv" value="0.00" readonly="readonly" >
              </div>
            </div>

            <div class="form-group" style="margin-bottom: 0px;">
              <label for="descuento" class="col-xs-4 col-sm-2 control-label" >Descuento </label>
              <div class="col-xs-8 col-sm-4">
                <input type="number" class="form-control" id="descuento" name="descuento" value="0.00" onchange="calcular_total()" readonly="readonly">
              </div>
            </div>

            <div class="form-group" style="margin-bottom: 0px;">
              <label for="total_proforma" class="col-xs-4 col-sm-2 control-label" >Total </label>
              <div class="col-xs-8 col-sm-4">
                <input type="number" class="form-control" id="total" name="total" value="0.00" readonly="readonly" >
              </div>
            </div>            
        </div>
        
        <p><code>F9: Guardar proforma</code></p>
        <p><code>Ctrl + B: Busqueda rápida</code></p>
      </div>

    </div>
  </div>

  

</div>

<script type="text/javascript"> base_url = "<?php echo base_url();  ?>"</script>
