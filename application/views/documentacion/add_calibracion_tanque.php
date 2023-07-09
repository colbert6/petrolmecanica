

<div class="row" id="form">

<strong><?php if(isset($msj_return_save)) echo $msj_return_save; ?></strong>


<form method='post' action='/sistem/documentaciones/save_calibracion_tanque/<?php echo $idcalibracion_tanque;?>' enctype='multipart/form-data' class="form-horizontal">
  <!-- left column -->



  <?php  $notificacion_grocery = $this->session->flashdata('notificacion_grocery');
   if ($notificacion_grocery )  :   ?>
      <div class="col-md-12">
      <div class="box box-warning"> 
        <div class="box-body">
        <div id="report-<?php echo $notificacion_grocery ?>" class="report-div <?php echo $notificacion_grocery ?>" style="display: block;">

          <p><?php echo $this->session->flashdata('msj_notificacion_grocery'); 
          unset($_SESSION['notificacion_grocery']);
          ?></p>
          </div>

        </div>
      </div>

      </div>
  <?php endif;   ?> 


  <div class="col-md-4">
    <div class="box box-info">     

      
        <div class="box-body">

          <?php  $notificacion_grocery = $this->session->flashdata('notificacion_grocery');
            if ($notificacion_grocery )  :   ?>
            <div id="report-<?php echo $notificacion_grocery ?>" class="report-div <?php echo $notificacion_grocery ?>" style="display: block;">
              
              <p><?php echo $this->session->flashdata('msj_notificacion_grocery') ?></p>
            </div>           
          <?php endif;   ?> 


          <div class="form-group" >
            <label for="fecha_venta" class="col-xs-4 col-sm-2 control-label">Fecha</label>
            <div class="col-xs-8 col-sm-10">
              <input type="date" class="form-control" id="fecha_emision" name="fecha_emision" value="<?php echo date('Y-m-d');?>" readonly="readonly">
            </div>
          </div>

          <div class="form-group">
            <label for="idserie" class="col-sm-2 control-label">Comp.</label>

            <div class="col-sm-10">
              <input type="hidden" class="form-control" id="idserie" name="idserie" readonly="readonly" value="<?php echo $idserie; ?>">
              <input type="text" class="form-control" id="serie_titulo" name="serie_titulo" readonly="readonly" value="<?php echo  $serie_data->titulo; ?>">              
              <input type="text" class="form-control" id="serie_correlativo" name="serie_correlativo" placeholder="Correlativo" readonly="readonly" value="<?php echo $serie_data->correlativo; ?>">
            </div>
          </div>        

          <?php echo $get_clientes; ?>

          <textarea class="form-control" rows="2" placeholder="Observaciones ..." id="observacion" name="observacion"></textarea>
          

        </div>
        <!-- /.box-body -->

    </div>

  </div>  

  <div class="col-md-8">
    <div class="box box-success">

      <div class="box-header with-border">
        <div class="form-group" >
          <label for="texto" class="col-xs-4 col-sm-2 control-label">Titulo</label>
          <div class="col-xs-8 col-sm-10">
            <input type="text" class="form-control" id="texto" name="texto" value="CALIBRACIÓN DE TANQUE" >
          </div>
        </div>  
      </div>
      

      <div class="box-body" role="form">

        
          <!--form method='post' action='/sistem/documentaciones/save_calibracion_tanque' enctype='multipart/form-data'>

        	<input type='file' name='files[]' multiple=""> <br/><br/>
	  		  
         </form-->

         <div class="form-group" style="margin-left: 0px">
            <label for="exampleInputFile">Imagenes de tablas de calibración</label>
            <input type="file" name='files[]' multiple="">
            <p class="help-block">Seleccione todos los archivos que corresponden a las tablas de calibración.</p>
          </div>
      </div>

      <div class="box-footer">
        <a href="<?php echo base_url('documentaciones/lista'); ?>">ir a Lista documentos</a>
        <button type="submit" class="btn btn-success pull-right" id="btn_save" >Guardar</button>

      </div>
      <!-- /.box-footer -->

      

    </div>
  </div>

</form>

</div>

<script type="text/javascript"> base_url = "<?php echo base_url();  ?>"</script>
