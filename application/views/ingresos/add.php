
<div class="row" id="form" style="padding-left:15px;padding-right:15px;">

  
  <div class="box box-info">     

    <form class="form-horizontal">
      <div class="box-body">

        <div class="col-md-4">
          <div class="form-group" style="margin-bottom: 0px;">
            <div class="col-sm-4 col-xs-4">
              <label for="fecha_compra" class="control-label">Fecha Compra</label>  
            </div>
            <div class="col-sm-8 col-xs-8">
              <input type="date" class="form-control" id="fecha_compra" name="fecha_compra" value="<?php echo date('Y-m-d');?>" >               
            </div>
          </div>
          <div class="form-group" >
            <div class="col-sm-4 col-xs-4"> 
              <label for="fecha_recepcion" class="control-label">Fecha Recepción</label>  
            </div>
            <div class="col-sm-8 col-xs-8">              
              <input type="date" class="form-control" id="fecha_recepcion" name="fecha_recepcion" value="<?php echo date('Y-m-d');?>" >               
            </div>
          </div>

          <!--div class="form-group" style="margin-bottom: 0px;">
            <div class="col-sm-4 col-xs-4"> 
              <label for="descuento" class="control-label">SubTotal</label>
            </div>
            <div class="col-sm-8 col-xs-8">              
              <input type="number" class="form-control" id="subtotales" name="subtotales" value="0.00" readonly="readonly" >              
            </div>
          </div> 
          <div class="form-group" style="margin-bottom: 0px;">
            <div class="col-sm-4 col-xs-4"> 
              <label for="igv" class="control-label">IGV</label>
            </div>
            <div class="col-sm-8 col-xs-8">              
              <input type="number" class="form-control" id="igv" name="igv" value="0.00" readonly="readonly" >             
            </div>
          </div>
          <div class="form-group" >
            <div class="col-sm-4 col-xs-4"> 
              <label for="descuento" class="control-label">Descuento</label>
            </div>
            <div class="col-sm-8 col-xs-8">              
              <input type="number" class="form-control" id="descuento" name="descuento" value="0.00" onchange="calcular_total()">             
            </div>
          </div-->    

          <div class="form-group" style="margin-bottom: 0px;">
            <div class="col-sm-4 col-xs-4"> 
              <label for="periodo_pago" class="control-label">Periodo Pago</label>
            </div>
            <div class="col-sm-8 col-xs-8">              
              <select class="form-control" id="idperiodo_pago" name="idperiodo_pago" > 
                  <option value='1' > Contado </option>
                  <option value='2' > Crédito </option>
              </select>            
            </div>
          </div>   
          <div class="form-group" >
            <div class="col-sm-4 col-xs-4"> 
              <label for="fecha_pago" class="control-label">Fecha Pago</label>  
            </div>
            <div class="col-sm-8 col-xs-8">              
              <input type="date" class="form-control" id="fecha_recepcion" name="fecha_recepcion" value="<?php echo date('Y-m-d');?>" >             
            </div>
          </div>   
        </div>

        <div class="col-md-5"> 
          <?php echo $get_proveedores; ?>
        </div>

        <div class="col-md-3"> 

          <div class="form-group" >
            <div class="col-sm-4 col-xs-4" style="margin-bottom: 0px;"> 
              <label for="idserie" class="control-label">Comprobante</label>
            </div>
            <div class="col-sm-8 col-xs-8">              
              <select class="form-control" id="idserie" name="idserie" > 
                  <?php foreach($comprobantes as $tc) {
                    echo "<option value='{$tc->idtipo_comprobante}' > {$tc->tipo_comprobante} </option>";
                  }
                ?>
              </select>               
            </div>
          </div>
          <div class="form-group" style="margin-bottom: 0px;">
            <div class="col-sm-4 col-xs-4"> 
              <label for="nrocomprobante" class="control-label"> Número</label>
            </div>
            <div class="col-sm-8 col-xs-8">              
               <input type="text" class="form-control" id="nrocomprobante" name="nrocomprobante" placeholder="Nro Comprobante" value="0">               
            </div>
          </div>
          <div class="form-group" style="margin-bottom: 0px;">
            <div class="col-sm-4 col-xs-4"> 
              <label for="guia_remision_remitente" class="control-label">Guia Remitente</label>
            </div>
            <div class="col-sm-8 col-xs-8">              
              <input type="text" class="form-control" id="guia_remision_remitente" name="guia_remision_remitente" placeholder="Guia Remitente" value="0">               
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-4 col-xs-4"> 
              <label for="guia_remision_transportista" class="control-label">Guia Transportista</label>
            </div>
            <div class="col-sm-8 col-xs-8">              
              <input type="text" class="form-control" id="guia_remision_transportista" name="guia_remision_transportista" placeholder="Guia Transportista" value="0">              
            </div>
          </div>

        </div>

        <textarea class="form-control" rows="2" placeholder="Observaciones ..." id="observacion" name="observacion"></textarea>

      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <a href="<?php echo base_url('ventas/lista'); ?>">ir a Lista ingresos</a>
        <button type="button" class="btn btn-success pull-right" id="btn_save" onclick="save()">Guardar</button>

      </div>
      <!-- /.box-footer -->
    </form>
  </div>


    


  <!-- left column -->
  <div class="col-md-12">
    <div class="box box-success">
      <div class="box-header with-border">
        
        <?php echo $get_productos; ?>

      </div>
      <div class="box-body">

        <div id="div_detalle_venta">
          <table class="table table-striped" id="table_detalle_venta">
            
            <tbody>   
              <!--DETALLE DE VENTA-->
              
            </tbody>
          </table>
        </div>  
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="row">

          <div class="col-xs-4">
            <p># Articulos : <span id="cantidadItem">0</span></p>
          </div>
          <div class="col-xs-4 ">
            <!--h3 class="box-title" id="text_total_venta" > TOTAL S/. <span id="total_venta">0.00</span></h3-->
            <div class="form-group">
              <label for="text_total_venta">TOTAL      </label>
              <h3>S/. <span class="total">0.00</span></h3>
            </div>
          </div>  
          <div class="col-xs-4 ">
            <div class="form-group">
              <label for="efectivo">Efectivo</label>
              <input type="number" class="form-control" id="efectivo" placeholder="efectivo" tabindex="2">
            </div>
          </div>
        </div>
        
        <p><code>F9: Guardar venta</code></p>
        <p><code>Ctrl + B: Busqueda rápida</code></p>
      </div>

    </div>
  </div>

  

</div>

<script type="text/javascript"> base_url = "<?php echo base_url();  ?>"


</script>
