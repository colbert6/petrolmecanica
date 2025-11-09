<style>
.input-required{
	border-color: #a94442;
}
</style>

<div class="row" id="form">
  <!-- left column -->
  <div class="col-md-4">
    <div class="box box-info">
      <form class="form-horizontal">
        <div class="box-body">
		  
          <div class="form-group" >
            <div class="col-sm-5">
              <label for="fecha_comprobante" class="control-label">Fecha_Comprobante</label>
              <label for="fecha_traslado" class="control-label">Fecha_traslado</label>
            </div>
            <div class="col-sm-7">
              <input type="date" class="form-control" id="fecha_comprobante" name="fecha_comprobante" value="<?php echo date('Y-m-d');?>" readonly="readonly">
              <input type="date" class="form-control" id="fecha_traslado" name="fecha_traslado" value="<?php echo date('Y-m-d');?>" >
              <input type="hidden" class="form-control" id="tienda" name="tienda" value="1" >              
            </div>
          </div>
		  
		  <div class="form-group">
            <label for="idserie" class="col-sm-4 control-label">Comprobante</label>

            <div class="col-sm-8">
              <select class="form-control" id="idserie" name="idserie" onchange="get_correlativo();"> 
                  <?php foreach($series as $tc) {
                    echo "<option value='{$tc->idserie}' > {$tc->tipo_comprobante} </option>";
                  }
                ?>
              </select>
              <input type="text" class="form-control" id="correlativo" name="correlativo" placeholder="Correlativo" readonly="readonly" value="<?php echo $series[0]->correlativo; ?>">
			  <input type="hidden" id="cod_tipo_documento" name="cod_tipo_documento" value="09" >
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-5">
              <label for="id_motivotraslado" class="control-label">Motivo_traslado</label>
              <label for="peso" class="control-label">Peso (Kg)</label>
              <label for="numero_paquetes" class="control-label">Numero_paquetes</label>
              <label for="id_modalidadtraslado" class="control-label">Modalidad_Traslado</label>
            </div>
            <div class="col-sm-7">
              <select class="form-control" id="id_motivotraslado" name="id_motivotraslado">
                <?php $motivo_traslado = array("01"=>"VENTA")?>           
                <?php foreach ($motivo_traslado as $key => $val): ?>
                <option value="<?= $key ?>"><?= $val ?></option>
                <?php endforeach; ?>
              </select>
			  <input type="hidden" id="motivo_traslado" name="motivo_traslado" value="VENTA" >
              <input type="number" class="form-control" id="peso" name="peso" value="1" >
              <input type="number" class="form-control" id="numero_paquetes" name="numero_paquetes" value="1" > 

              <select class="form-control" id="id_modalidadtraslado" name="id_modalidadtraslado">
                <?php $modalidad_traslado = array("01"=> "Transporte público", "02"=> "Transporte privado")?>           
                <?php foreach ($modalidad_traslado as $key => $val): ?>
                <option value="<?= $key ?>"><?= $val ?></option>
                <?php endforeach; ?>
              </select>


              <input type="hidden" class="form-control" id="id_codigopuerto" name="id_codigopuerto" value="" >
              <input type="hidden" class="form-control" id="numero_contenedor" name="numero_contenedor" value="" >

            </div>
          </div>
		  
		</div><!-- /.box-body --> 
	  </form>
	</div><!-- /.box-info --> 
  </div>

  <div class="col-md-4">
    <div class="box box-info">
      <form class="form-horizontal">
        <div class="box-body">

          <label> Datos de transporte</label>
		  <div class="form-group">
            <div class="col-sm-4">
              <label for="id_tipo_documento_transporte" class="control-label">Tipo_Doc </label> 
              <label for="nro_documento_transporte" class="control-label">Nro_documento </label>

              <label for="razon_social_transporte" class="control-label">Razon_social</label> 
              <label for="transporte_nro_placa" class="control-label">Numero_placa</label>
            </div>
            <div class="col-sm-8">
              <select class="form-control" id="id_tipo_documento_transporte" name="id_tipo_documento_transporte">
                <?php $tipo_documento_transporte = array(6=>"RUC", 1=>"DNI")?>
                <?php foreach ($tipo_documento_transporte as $key => $val): ?>
                <option value="<?= $key ?>"><?= $val ?></option>
                <?php endforeach; ?>
              </select>

              <input type="text" class="form-control" id="nro_documento_transporte" name="nro_documento_transporte" value="" placeholder="DNI si transporte es privado">
              <input type="text" class="form-control" id="razon_social_transporte" name="razon_social_transporte" value="" >
              <input type="text" class="form-control" id="transporte_nro_placa" name="transporte_nro_placa" value="" placeholder="Solo si transporte es privado">             
              
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-4">              

              <label for="id_ubigeo_partida" class="control-label">Ubigeo_partida</label> 
              <label for="dir_partida" class="control-label">Direccion_Partida</label>
			  
			  <label for="id_ubigeo_destino" class="control-label">Ubigeo_destino</label> 
              <label for="dir_destino" class="control-label">Direccion_Destino</label>
            </div>
            <div class="col-sm-8">             
			  
			  <select class="form-control" id="id_ubigeo_partida" name="id_ubigeo_partida">
                <?php foreach ($data_distrito_ubigeo as $key): ?>
                <option value="<?= $key['codigo_ubigeo'] ?>"><?= $key['descripcion_ubigeo'] ?></option>
                <?php endforeach; ?>
              </select>
              <input type="text" class="form-control" id="dir_partida" name="dir_partida" value="Pasaje La amistad #145, barrio Mollepampa" placeholder="DIRECCION DE PARTIDA"> 
			  
			  <select class="form-control" id="id_ubigeo_destino" name="id_ubigeo_destino">
                <?php foreach ($data_distrito_ubigeo as $key): ?>
                <option value="<?= $key['codigo_ubigeo'] ?>"><?= $key['descripcion_ubigeo'] ?></option>
                <?php endforeach; ?>
              </select>
              <input type="text" class="form-control" id="dir_destino" name="dir_destino" value="" placeholder="DIRECCION DE DESTINO FINAL">
            </div>
			
          </div>

		</div><!-- /.box-body --> 
	  </form>
	</div><!-- /.box-info --> 
  </div>

  <div class="col-md-4">
    <div class="box box-info">
      <form class="form-horizontal">
        <div class="box-body">          
		  
		  <label> Documento Referencia </label>
		  <div class="form-group">
            <div class="col-sm-4">
              <label for="docs_referencia_serie_comprobante" class="control-label">Serie_comp.</label>
              <label for="docs_referencia_numero_comprobante" class="control-label">Numero_comp.</label> 
            </div>
            <div class="col-sm-8">
              <input type="hidden" class="form-control" id="docs_referencia_id_tipodoc_electronico" name="docs_referencia_id_tipodoc_electronico[]" value="09" >
              <input type="text" class="form-control" id="docs_referencia_serie_comprobante" name="docs_referencia_serie_comprobante[]" value="<?= (explode("-", $data_venta['nro_documento']))[0] ?>" readonly>
              <input type="text" class="form-control" id="docs_referencia_numero_comprobante" name="docs_referencia_numero_comprobante[]" value="<?= (explode("-", $data_venta['nro_documento']))[1] ?>" readonly>
			  
			  <input type="hidden" id="docs_referencia_venta_idventa" name="docs_referencia_venta_idventa[]" value="<?= $data_venta['idventa'] ?>" >
            </div>
          </div>
		  
		  <div class="form-group">
            <div class="col-sm-4">
			  <label for="docs_referencia_cliente_tipodocumento_desc" class="control-label">Tipo_Doc</label> 	
              <label for="docs_referencia_cliente_numerodocumento" class="control-label">Doc_cliente</label> 
              <label for="docs_referencia_cliente_nombre" class="control-label">Cliente</label>
			  <label for="docs_referencia_cliente_codigoubigeo" class="control-label">Cliente_Ubigeo</label>
			  <label for="docs_referencia_cliente_codigoubigeo" class="control-label">Cliente_Dirección</label>
			  
            </div>
            <div class="col-sm-8">
              <input type="hidden" class="form-control" id="docs_referencia_cliente_tipodocumento" name="docs_referencia_cliente_tipodocumento[]" value="6" >
			  
			  <input type="text" class="form-control" id="docs_referencia_cliente_tipodocumento_desc" name="docs_referencia_cliente_tipodocumento_desc[]" value="RUC" readonly>
              <input type="text" class="form-control" id="docs_referencia_cliente_numerodocumento" name="docs_referencia_cliente_numerodocumento[]" value="<?= $data_venta['cliente_documento'] ?>" readonly>
              <input type="text" class="form-control" id="docs_referencia_cliente_nombre" name="docs_referencia_cliente_nombre[]" value="<?= $data_venta['cliente_razon_social'] ?>" readonly>
			  
			  <input type="hidden" class="form-control" id="docs_referencia_cliente_pais" name="docs_referencia_cliente_pais[]" value="PE" >
			  
			  <select class="form-control" id="docs_referencia_cliente_codigoubigeo" name="docs_referencia_cliente_codigoubigeo[]">
                <?php foreach ($data_distrito_ubigeo as $key): ?>
                <option value="<?= $key['codigo_ubigeo'] ?>"><?= $key['descripcion_ubigeo'] ?></option>
                <?php endforeach; ?>
              </select>
			  
			  <input type="text" class="form-control" id="docs_referencia_cliente_direccion" name="docs_referencia_cliente_direccion[]" value="<?= $data_venta['cliente_direccion'] ?>" >
            </div>
			
          </div class="form-group">
		  <div>
			<div class="col-sm-12">
				<textarea id="nota" name="nota" placeholder="Escriba aquí - Nota que se comunica a SUNAT" class="form-control" ></textarea>  
			</div>
		  </div>


        </div> <!-- /.box-body -->
      </form>
    </div>

  </div>  

  
  <div class="col-md-12">
    <div class="box box-success">
    
      <div class="box-body">

        <div id="div_detalle_venta">
		
		<?php 
		$ITEM_DET = 0;
		foreach ($data_detalle_venta as $val): 
		$ITEM_DET++;		
		?>
		
        <div class="row">
		
		<input type="hidden" name="ITEM_DET[]" value="<?= $ITEM_DET ?>">
		<input type="hidden" name="CODIGO_PRODUCTO[]" value="<?= $val['producto_idproducto']  ?>">
		
		<div class="col-xs-12 col-md-6 item" style="padding-bottom: 4px;" id_prod="<?= $val['producto_idproducto']  ?>">
			<div class="input-group">
			<span class="input-group-btn">
			<button type="button" class="btn btn-danger btn-flat"><i class="fa fa-times" onclick="remover_detalle_venta(<?= $val['producto_idproducto']  ?>)"></i></button>
			</span>
			<input class="form-control" name="DESCRIPCION_DET[]" value="<?= $val['descripcion'] ?>" readonly>
			</div>  
		</div>  
		<div class="col-xs-4 col-md-2 item_cantidad" style="padding-bottom: 4px;" >
			<input type="number" name="CANTIDAD_DET[]" class="form-control" placeholder="Cantidad" tabindex="-1" value="<?= $val['cantidad']  ?>" readonly></div>
		<div class="col-xs-4 col-md-2 item_precio" style="padding-bottom: 4px;" >				
			<select class="form-control" id="UNIDAD_MEDIDA_DET" name="UNIDAD_MEDIDA_DET[]">
                <?php $unidad_medida_det = array("NIU"=>"	UNIDAD (BIENES)", "KGM"=>"KILOGRAMO")?>           
                <?php foreach ($unidad_medida_det as $key_med => $val_med): ?>
                <option value="<?= $key_med ?>"><?= $val_med ?></option>
                <?php endforeach; ?>
              </select>
		</div>
		<div class="col-xs-4 col-md-2 item_subtotal" style="padding-bottom: 4px;" >	
			<input type="number" name="PESO_DET[]" class="form-control" placeholder="PESO_DET" tabindex="-1" value="<?= $val['cantidad']  ?>" >
		</div>
		
		</div>
		<?php endforeach; ?>
		
		</div> 
      </div>
      <!-- /.box-body -->
	  
	  <div class="box-footer">
          <a href="<?php echo base_url('guias/lista'); ?>">ir a Lista guias</a>
          <button type="button" class="btn btn-success pull-right" id="btn_save" onclick="save()">Guardar</button>

        </div>

    </div>
  </div>

  
</div>

<script type="text/javascript"> base_url = "<?php echo base_url();  ?>"</script>
