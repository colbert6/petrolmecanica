
<div class="row" id="form">
  <!-- left column -->
  <div class="col-md-8">
    <div class="box box-info">
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

  <div class="col-md-4">
    <div class="box box-info">     

      <form class="form-horizontal">
        <div class="box-body">
		
          <div class="form-group">
            <div class="col-sm-2">
              <label for="fecha_venta" class="control-label">Fecha</label>
              <label for="tienda" class="control-label">Tienda</label>  
            </div>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="fecha_venta" name="fecha_venta" value="<?php echo date('Y-m-d');?>" >
              <select class="form-control" id="tienda" name="tienda">           
                <?php foreach ($tiendas as $data): ?>
                <option value="<?= $data['id'] ?>"><?= $data['descripcion'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-group">
		  
			<div class="col-sm-6">
              <select class="form-control" id="forma_pago" name="forma_pago">           
                <?php foreach ($forma_pago as $data): ?>
                <option value="<?= $data['id'] ?>"><?= $data['descripcion'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>			
            <div class="col-sm-6">
				<select class="form-control" id="tipo_moneda" name="tipo_moneda">           
					<?php foreach ($tipo_moneda as $data): ?>
					<option value="<?= $data['id'] ?>"><?= $data['descripcion'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			
            <div class="col-sm-6">             
				<select class="form-control" id="condicion_pago" name="condicion_pago">           
					<?php foreach ($condicion_pago as $data): ?>
					<option value="<?= $data['id'] ?>"><?= $data['descripcion'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="col-sm-6">	
              <input type="number" class="form-control" id="numero_cuotas" name="numero_cuotas" value="1" >
            </div>
          </div>

          <div class="form-group">
			
            <div class="col-sm-8">
				<select class="form-control" id="idserie" name="idserie"> 
					<?php foreach ($series as $data): ?>
					<option value="<?= $data['id'] ?>"><?= $data['descripcion'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="nro_guia_remision" name="nro_guia_remision" placeholder="Correlativo de Guia" readonly value="<?php echo $guia_remision; ?>">
              
            </div>
          </div>

          <?php echo $get_clientes; ?>

          <div class="form-group">
            <div class="col-sm-4">
              <label for="descuento" class="control-label">SubTotal</label><br>
              <label for="descuento" class="control-label">IGV</label><br>
              <label for="descuento" class="control-label">Descuento</label>
            </div>
            
            <div class="col-sm-8">
              <input type="number" class="form-control" id="subtotales" name="subtotales" value="0.00" readonly="readonly" >
              <input type="number" class="form-control" id="igv" name="igv" value="0.00" readonly="readonly" >
              <input type="number" class="form-control" id="descuento" name="descuento" value="0.00" onchange="calcular_total()">
            </div>
          </div>

          <textarea class="form-control" rows="2" placeholder="Observaciones ..." id="observacion" name="observacion"></textarea>
          

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="<?php echo base_url('ventas/lista'); ?>">ir a Lista ventas</a>
          <button type="button" class="btn btn-success pull-right" id="btn_save" onclick="save()">Vender</button>

        </div>
        <!-- /.box-footer -->
      </form>
    </div>

  </div>  

</div>

