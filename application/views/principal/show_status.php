
  
 <!-- Default box -->
  <div class="box">
      <div class="box-header with-border">
          <h3 class="box-title"> RESULTADO </h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
      </div>
      <div class="box-body" >
      <div class="row">

        <input type="hidden" name="msj" id="msj" value="<?php echo $msj ?>">
        <input type="hidden" name="idsave" id="idsave" value="<?php echo $idsave ?>">

      
       

      </div>
      </div>
      <!-- /.box-body -->
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->

<script type="text/javascript">
  

  $(document).ready(function () {
  
    bootbox.dialog({
        title: 'Respuesta ',
        closeButton: false,
        message: $("#msj").val(),
        buttons: {
          OK: {
            label: "OK",
            className: 'btn-info',
            callback: function() {
                
                if($("#idsave").val()>0){
                  console.log("holaa"+$("#idsave").val())
                  url = base_url + 'documentaciones/print_documentacion?iddocumentacion='+ $("#idsave").val();
                  window.open(url);
                }
                url_reload = base_url +'documentaciones/add_calibracion_tanque';
                $(location).attr('href', url_reload);
                
            }
          }

          
      }
    });
  });


</script>
