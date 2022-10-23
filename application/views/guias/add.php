
<div class="row" id="form">
  <!-- left column -->
  <div class="col-md-7">
    <div class="box box-success">
      <div class="box-header with-border">
        
        <?php echo "get_productos"; ?>

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

  <div class="col-md-5">
    <div class="box box-info">     

      <form class="form-horizontal">
        <div class="box-body">
          <div class="form-group">
            <div class="col-sm-5">
              <label for="fecha_comprobante" class="control-label">Fecha_Comprobante</label>
              <label for="fecha_traslado" class="control-label">Fecha_traslado</label>
            </div>
            <div class="col-sm-7">
              <input type="date" class="form-control" id="fecha_comprobante" name="fecha_venta" value="<?php echo date('Y-m-d');?>" readonly="readonly">
              <input type="date" class="form-control" id="fecha_comprobante" name="fecha_venta" value="<?php echo date('Y-m-d');?>" >
              <input type="hidden" class="form-control" id="tienda" name="tienda" value="1" >              
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-5">
              <label for="id_motivo_traslado" class="control-label">Motivo_traslado</label>
              <label for="peso" class="control-label">Peso (Kg)</label>
              <label for="numero_paquetes" class="control-label">Numero_paquetes</label>
              <label for="id_modalidadtraslado" class="control-label">Modalidad_Traslado</label>
            </div>
            <div class="col-sm-7">
              <select class="form-control" id="tienda" name="tienda">
                <?php $motivo_traslado = array("01"=>"VENTA")?>
           
                <?php foreach ($motivo_traslado as $key => $val): ?>
                <option value="<?= $key ?>"><?= $val ?></option>
                <?php endforeach; ?>
              </select>

              <input type="number" class="form-control" id="peso" name="peso" value="1" >
              <input type="number" class="form-control" id="numero_paquetes" name="numero_paquetes" value="1" > 

              <select class="form-control" id="tienda" name="tienda">
                <?php $modalidad_traslado = array("01"=> "Transporte público", "02"=> "Transporte privado")?>
           
                <?php foreach ($modalidad_traslado as $key => $val): ?>
                <option value="<?= $key ?>"><?= $val ?></option>
                <?php endforeach; ?>
              </select>


              <input type="hidden" class="form-control" id="id_codigopuerto" name="id_codigopuerto" value="" >
              <input type="hidden" class="form-control" id="numero_contenedor" name="numero_contenedor" value="" >

            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-4">
              <label for="id_tipo_documento_transporte" class="control-label">Tipo_Doc_transporte</label> 
              <label for="nro_documento_transporte" class="control-label">Nro_documento_transporte</label>

              <label for="razon_social_transporte" class="control-label">Razon_social_transporte</label> 
              <label for="transporte_nro_placa" class="control-label">transporte_nro_placa</label>
            </div>
            <div class="col-sm-8">
              <select class="form-control" id="id_tipo_documento_transporte" name="id_tipo_documento_transporte">
                <?php $tipo_documento_transporte = array(6=>"RUC", 1=>"DNI")?>
                <?php foreach ($tipo_documento_transporte as $key => $val): ?>
                <option value="<?= $key ?>"><?= $val ?></option>
                <?php endforeach; ?>
              </select>

              <input type="text" class="form-control" id="nro_documento_transporte" name="nro_documento_transporte" value="" >
              <input type="text" class="form-control" id="razon_social_transporte" name="razon_social_transporte" value="" >
              <input type="text" class="form-control" id="transporte_nro_placa" name="transporte_nro_placa" value="" placeholder="Requerido solo cuando el transporte es privado">             
              
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-4">
              <label for="id_ubigeo_destino" class="control-label">Ubigeo_destino</label> 
              <label for="dir_destino" class="control-label">Direccion_Destino</label>

              <label for="id_ubigeo_partida" class="control-label">Razon_social_transporte</label> 
              <label for="dir_partida" class="control-label">Direccion_Partida</label>
            </div>
            <div class="col-sm-8">

              <input type="text" class="form-control" id="id_ubigeo_destino" name="id_ubigeo_destino" value="" placeholder="010105">
              <input type="text" class="form-control" id="dir_destino" name="dir_destino" value="" placeholder="JR. AQUÍ LA DIRECCION DE DESTINO FINAL">
              <input type="text" class="form-control" id="id_ubigeo_partida" name="id_ubigeo_partida" value="" placeholder="060101" >
              <input type="text" class="form-control" id="dir_partida" name="dir_partida" value="" placeholder="AQUÍ LA DIRECCION DE PARTIDA"> 
              <textarea id="nota" name="nota" placeholder="Escriba aquí - Nota que se comunica a SUNAT" class="form-control" ></textarea>  
              
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-4">
              <label for="docs_referencia_id_tipodoc_electronico" class="control-label">Tipo_documento</label> 
              <label for="docs_referencia_serie_comprobante" class="control-label">Serie_comprobante</label>
              <label for="docs_referencia_numero_comprobante" class="control-label">Numero_comprobante</label> 
            </div>
            <div class="col-sm-8">
              <input type="hidden" class="form-control" id="docs_referencia_id_tipodoc_electronico" name="docs_referencia_id_tipodoc_electronico" value="" >
              <input type="text" class="form-control" id="docs_referencia_serie_comprobante" name="docs_referencia_serie_comprobante" value="F001" readonly>
              <input type="text" class="form-control" id="docs_referencia_numero_comprobante" name="docs_referencia_numero_comprobante" value="12" readonly>
            </div>
          </div>




          <div class="form-group">
            <label for="idserie" class="col-sm-2 control-label">Comp.</label>

            <div class="col-sm-10">
              <select class="form-control" id="idserie" name="idserie" onchange="get_correlativo();"> 
                  <?php foreach($series as $tc) {
                    echo "<option value='{$tc->idserie}' > {$tc->tipo_comprobante} </option>";
                  }
                ?>
              </select>
              <input type="text" class="form-control" id="correlativo" name="correlativo" placeholder="Correlativo" readonly="readonly" value="<?php echo $series[0]->correlativo; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="idserie" class="col-sm-2 control-label">Guia</label>

            
          </div>


        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="<?php echo base_url('guias/lista'); ?>">ir a Lista GUÍAS</a>
          <button type="button" class="btn btn-success pull-right" id="btn_save" onclick="save()">Crear</button>

        </div>
        <!-- /.box-footer -->
      </form>
    </div>

  </div>  

</div>

<script type="text/javascript"> base_url = "<?php echo base_url();  ?>"</script>
