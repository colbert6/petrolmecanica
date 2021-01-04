<style type="text/css">
 

</style>


<div class="row" id="form">
  <!-- left column -->
  <div class="col-md-4">
    <div class="box box-info">     

      <form class="form-horizontal">
        <div class="box-body">

          <div class="form-group" style="margin-bottom: 0px;">
            <label for="fecha_venta" class="col-xs-4 col-sm-2 control-label">Hoy</label>
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
          
          <div class="form-group" style="margin-bottom: 0px;">
            <label for="fecha_venta" class="col-xs-4 col-sm-2 control-label">Fecha</label>
            <div class="col-xs-8 col-sm-10">
              <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo date('Y-m-d');?>" >
            </div>
          </div>
          
          <div class="form-group" >
            <label for="fecha_venta" class="col-xs-4 col-sm-2 control-label">Hora</label>
            <div class="col-xs-8 col-sm-10">
              <input type="time" class="form-control" id="hora" name="hora" value="<?php echo date('H:s');?>" >
            </div>
          </div>       
          <!--textarea class="form-control" rows="2" placeholder="Observaciones ..." id="observacion" name="observacion"></textarea-->
          
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="<?php echo base_url('ServicioCorrectivo/lista'); ?>">ir a lista de servicios</a>
          <button type="button" class="btn btn-success pull-right" id="btn_save" onclick="save()">Generar</button>

        </div>
        <!-- /.box-footer -->
      </form>
    </div>

  </div>  
  
  <div class="col-md-8">
    <div class="box box-success">
      <div class="box-body">          
        
          <?php echo $get_clientes; ?>
                
          <div class="form-group" >
            <label for="fecha_venta" class="col-xs-4 col-sm-2 control-label">Distrito</label>
            <div class="col-xs-8 col-sm-4">
              <input type="text" class="form-control" id="distrito" name="distrito" >
            </div>
            
            <label for="fecha_venta" class="col-xs-4 col-sm-2 control-label">Telef.</label>
            <div class="col-xs-8 col-sm-4">
              <input type="text" class="form-control" id="telefono" name="telefono" >
            </div>
          </div>        
        
      </div>
    </div>
  </div>
  
  <div class="col-md-12">
    <div class="box box-warning">
      <div class="box-header with-border">
        <b>Servicios Solicitados / Trabajos realizados</b>
        <?php $seccion = 1; ?>
      </div>
      <form class="form-horizontal">
      <div class="box-body">   
        
        <div class="form-group" >
          <div class="col-xs-12 col-sm-3">
            <input type="checkbox" name="servicio_realizado_tipo_<?=$seccion?>_1" value="Disp.">
            <label for="servicio_realizado_tipo_<?=$seccion?>_1">Disp. </label> <br>
            
            <input type="checkbox" name="servicio_realizado_tipo_<?=$seccion?>_2" value="Surt.">
            <label for="servicio_realizado_tipo_<?=$seccion?>_2">Surt. </label> <br>
            
            <input type="checkbox" name="servicio_realizado_tipo_3" value="Otros">
            <label for="servicio_realizado_tipo_<?=$seccion?>_3">Otros </label>
          </div>
          
          <div class="col-xs-12 col-sm-3">
            <label for="fecha_venta" class="col-xs-4 col-sm-2 control-label">Marca</label>            
              <input type="text" class="form-control" id="marca_<?=$seccion?>" name="marca_<?=$seccion?>" >
          </div>
          <div class="col-xs-12 col-sm-3">  
            <label for="fecha_venta" class="col-xs-4 col-sm-2 control-label">Modelo</label>
            <input type="text" class="form-control" id="modelo_<?=$seccion?>" name="modelo_<?=$seccion?>" >
          </div>
          <div class="col-xs-12 col-sm-3">  
            <label for="fecha_venta" class="col-xs-4 col-sm-2 control-label">Serie</label>
            <input type="text" class="form-control" id="serie_<?=$seccion?>" name="serie_<?=$seccion?>" >
          </div>
       </div> 
       
       <div class="form-group" >
          <label for="fecha_venta" class="col-xs-4 col-sm-2 control-label">Desperfecto</label>
          <div class="col-xs-8 col-sm-10">
            <textarea class="form-control" rows="2" placeholder="Desperfecto ..." id="desperfecto_<?=$seccion?>" name="desperfecto_<?=$seccion?>"></textarea>
          </div>
       </div> 
        
       <div class="form-group" >
          <label for="fecha_venta" class="col-xs-4 col-sm-2 control-label">Trabajo realizado</label>
          <div class="col-xs-8 col-sm-10">
            <textarea class="form-control" rows="3" placeholder="Trabajo realizado ..." id="trabajo_realizado_<?=$seccion?>" name="trabajo_realizado_<?=$seccion?>"></textarea>
          </div>
       </div> 
        
      </div>
      </form>  
    </div>
  </div>
  
  <div class="col-md-12">
    <div class="box box-danger">
      <div class="box-header with-border">
        <b>Aferición de Medidores</b>
      </div>
      <form class="form-horizontal">
      <div class="box-body">
        
        <div class="col-md-6">
          <table class="table table-striped medidor">
            <thead>
              <tr>
                  <th>Medidor</th>
                  <th>Producto</th>
                  <th style="width:10%">Alto caudal</th>
                  <th style="width:10%">Bajo caudal</th>
                  <th>Sello</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach ( array(1, 2, 3, 4, 5, 6) as $item) {  $seccion = 1; ?>                
              <tr>
                  <td style="text-align:right"><?=$item?> </td>
                  <td><input style="width:100%" id="med_producto_<?=$seccion?>_<?=$item?>" name="med_producto_<?=$seccion?>_<?=$item?>"></td>
                  <td><input style="width:100%" id="med_alto_caudal_<?=$seccion?>_<?=$item?>" name="med_alto_caudal_<?=$seccion?>_<?=$item?>"></td>
                  <td><input style="width:100%" id="med_bajo_caudal_<?=$seccion?>_<?=$item?>" name="med_bajo_caudal_<?=$seccion?>_<?=$item?>"></td>
                  <td><input style="width:100%" id="med_sello_<?=$seccion?>_<?=$item?>" name="med_sello_<?=$seccion?>_<?=$item?>"></td>
              </tr>              
               <?php } ?>
            </tbody>
          </table>
        </div>
        
        <div class="col-md-6">
          <table class="table table-striped medidor">
            <thead>
              <tr>
                  <th>Medidor</th>
                  <th>Producto</th>
                  <th style="width:10%">Alto caudal</th>
                  <th style="width:10%">Bajo caudal</th>
                  <th>Sello</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach ( array(1, 2, 3, 4, 5, 6) as $item) {  $seccion = 2; ?>                
              <tr>
                  <td style="text-align:right"><?=$item?> </td>
                  <td><input style="width:100%" id="med_producto_<?=$seccion?>_<?=$item?>" name="med_producto_<?=$seccion?>_<?=$item?>"></td>
                  <td><input style="width:100%" id="med_alto_caudal_<?=$seccion?>_<?=$item?>" name="med_alto_caudal_<?=$seccion?>_<?=$item?>"></td>
                  <td><input style="width:100%" id="med_bajo_caudal_<?=$seccion?>_<?=$item?>" name="med_bajo_caudal_<?=$seccion?>_<?=$item?>"></td>
                  <td><input style="width:100%" id="med_sello_<?=$seccion?>_<?=$item?>" name="med_sello_<?=$seccion?>_<?=$item?>"></td>
              </tr>              
               <?php } ?>
            </tbody>
          </table>
        </div>
        
        <div class="form-group" >
          <label for="fecha_venta" class="col-xs-4 col-sm-2 control-label">Observación</label>
          <div class="col-xs-8 col-sm-10">
            <textarea class="form-control" rows="3" placeholder="Observaciones ..." id="observacion_1" name="observacion_1"></textarea>
          </div>
        </div> 
        
      </div>
      </form>
    </div>
  </div>
  
  
  <div class="col-md-12">
    <div class="box box-warning">
      <div class="box-header with-border">
        <b>Servicios Solicitados / Trabajos realizados</b>
        <?php $seccion = 2; ?>
      </div>
      <form class="form-horizontal">
      <div class="box-body">   
        
        <div class="form-group" >
          <div class="col-xs-12 col-sm-3">
            <input type="checkbox" name="servicio_realizado_tipo_<?=$seccion?>_1" value="Disp.">
            <label for="servicio_realizado_tipo_<?=$seccion?>_1">Disp. </label> <br>
            
            <input type="checkbox" name="servicio_realizado_tipo_<?=$seccion?>_2" value="Surt.">
            <label for="servicio_realizado_tipo_<?=$seccion?>_2">Surt. </label> <br>
            
            <input type="checkbox" name="servicio_realizado_tipo_3" value="Otros">
            <label for="servicio_realizado_tipo_<?=$seccion?>_3">Otros </label>
          </div>
          
          <div class="col-xs-12 col-sm-3">
            <label for="fecha_venta" class="col-xs-4 col-sm-2 control-label">Marca</label>            
              <input type="text" class="form-control" id="marca_<?=$seccion?>" name="marca_<?=$seccion?>" >
          </div>
          <div class="col-xs-12 col-sm-3">  
            <label for="fecha_venta" class="col-xs-4 col-sm-2 control-label">Modelo</label>
            <input type="text" class="form-control" id="modelo_<?=$seccion?>" name="modelo_<?=$seccion?>" >
          </div>
          <div class="col-xs-12 col-sm-3">  
            <label for="fecha_venta" class="col-xs-4 col-sm-2 control-label">Serie</label>
            <input type="text" class="form-control" id="serie_<?=$seccion?>" name="serie_<?=$seccion?>" >
          </div>
       </div> 
       
       <div class="form-group" >
          <label for="fecha_venta" class="col-xs-4 col-sm-2 control-label">Desperfecto</label>
          <div class="col-xs-8 col-sm-10">
            <textarea class="form-control" rows="2" placeholder="Desperfecto ..." id="desperfecto_<?=$seccion?>" name="desperfecto_<?=$seccion?>"></textarea>
          </div>
       </div> 
        
       <div class="form-group" >
          <label for="fecha_venta" class="col-xs-4 col-sm-2 control-label">Trabajo realizado</label>
          <div class="col-xs-8 col-sm-10">
            <textarea class="form-control" rows="3" placeholder="Trabajo realizado ..." id="trabajo_realizado_<?=$seccion?>" name="trabajo_realizado_<?=$seccion?>"></textarea>
          </div>
       </div> 
        
      </div>
      </form>  
    </div>
  </div>
  
  <div class="col-md-12">
    <div class="box box-danger">
      <div class="box-header with-border">
        <b>Aferición de Medidores</b>
      </div>
      <form class="form-horizontal">
      <div class="box-body">
        
        <div class="col-md-6">
          <table class="table table-striped medidor">
            <thead>
              <tr>
                  <th>Medidor</th>
                  <th>Producto</th>
                  <th style="width:10%">Alto caudal</th>
                  <th style="width:10%">Bajo caudal</th>
                  <th>Sello</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach ( array(1, 2, 3, 4, 5, 6) as $item) {  $seccion = 3; ?>                
              <tr>
                  <td style="text-align:right"><?=$item?> </td>
                  <td><input style="width:100%" id="med_producto_<?=$seccion?>_<?=$item?>" name="med_producto_<?=$seccion?>_<?=$item?>"></td>
                  <td><input style="width:100%" id="med_alto_caudal_<?=$seccion?>_<?=$item?>" name="med_alto_caudal_<?=$seccion?>_<?=$item?>"></td>
                  <td><input style="width:100%" id="med_bajo_caudal_<?=$seccion?>_<?=$item?>" name="med_bajo_caudal_<?=$seccion?>_<?=$item?>"></td>
                  <td><input style="width:100%" id="med_sello_<?=$seccion?>_<?=$item?>" name="med_sello_<?=$seccion?>_<?=$item?>"></td>
              </tr>              
               <?php } ?>
            </tbody>
          </table>
        </div>
        
        <div class="col-md-6">
          <table class="table table-striped medidor">
            <thead>
              <tr>
                  <th>Medidor</th>
                  <th>Producto</th>
                  <th style="width:10%">Alto caudal</th>
                  <th style="width:10%">Bajo caudal</th>
                  <th>Sello</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach ( array(1, 2, 3, 4, 5, 6) as $item) {  $seccion = 4; ?>                
              <tr>
                  <td style="text-align:right"><?=$item?> </td>
                  <td><input style="width:100%" id="med_producto_<?=$seccion?>_<?=$item?>" name="med_producto_<?=$seccion?>_<?=$item?>"></td>
                  <td><input style="width:100%" id="med_alto_caudal_<?=$seccion?>_<?=$item?>" name="med_alto_caudal_<?=$seccion?>_<?=$item?>"></td>
                  <td><input style="width:100%" id="med_bajo_caudal_<?=$seccion?>_<?=$item?>" name="med_bajo_caudal_<?=$seccion?>_<?=$item?>"></td>
                  <td><input style="width:100%" id="med_sello_<?=$seccion?>_<?=$item?>" name="med_sello_<?=$seccion?>_<?=$item?>"></td>
              </tr>              
               <?php } ?>
            </tbody>
          </table>
        </div>
        
        <div class="form-group" >
          <label for="fecha_venta" class="col-xs-4 col-sm-2 control-label">Observación</label>
          <div class="col-xs-8 col-sm-10">
            <textarea class="form-control" rows="3" placeholder="Observaciones ..." id="observacion_2" name="observacion_2"></textarea>
          </div>
        </div> 
        
      </div>
      </form>
    </div>
  </div>
  
  <div class="col-md-12">
    <div class="box box-success">
      <div class="box-body">  
        
          <div class="col-md-6">
            <div class="form-group" >
              <label for="fecha_venta" class="col-xs-4 col-sm-2 control-label">Fecha visita</label>
              <div class="col-xs-8 col-sm-10">
                <input type="date" class="form-control" id="fecha_visita" name="fecha_visita" >
              </div>
            </div> 
          </div>
                
          <div class="col-md-6">
            Estado de los Equipos (Después de la Reparación)
          <table class="table table-striped medidor">
            <thead>
              <tr>
                  <th>----------</th>
                  <th style="width:20%">Bueno</th>
                  <th style="width:20%">Malo</th>
                  <th>En observacion</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach ( array(1, 2, 3) as $item) {  $seccion = 1; ?>                
              <tr>
                  <td style="text-align:right">Equipo N° <?=$item?> </td>
                  <td><input style="width:100%" id="est_equipo_bueno_<?=$seccion?>_<?=$item?>" name="est_equipo_bueno_<?=$seccion?>_<?=$item?>"></td>
                  <td><input style="width:100%" id="est_equipo_malo_<?=$seccion?>_<?=$item?>" name="est_equipo_malo_<?=$seccion?>_<?=$item?>"></td>
                  <td><input style="width:100%" id="est_observacion_<?=$seccion?>_<?=$item?>" name="est_observacion_<?=$seccion?>_<?=$item?>"></td>
              </tr>              
               <?php } ?>
            </tbody>
          </table>
        </div>        
        
      </div>
    </div>
  </div>

</div>

<script type="text/javascript"> base_url = "<?php echo base_url();  ?>"</script>
