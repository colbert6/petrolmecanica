
$(document).ready(function () {

  
    shortcut.add("F9",function() {
        save();
    });
   	 	

});



var save = function(){
    var fallas, total;

    //Validar campos 
    fallas=true;
    
    if($("#btn_save").is(":disabled") ){
            alerta("Procesando servicio correctivo","En estos momentos se esta procesando",'warning');
            return 0;
    }else{
        $("#btn_save").attr({'disabled':'disabled'});
    }
    
    
    if( $("#cliente").val() == ""  ){
        alerta("Campos en Blanco","Llene todos los Campos",'warning');

    } else {
		total = calcular_total();        
        fallas=false;
        
    }

            
    if(!fallas){
    	

        var obj = new Object();

        obj.type = 'POST';
        obj.url_save = base_url +'ServicioCorrectivo/save';
        obj.data = $('#form').find('select, textarea, input').serialize();
        obj.async = true;
        obj.url_reload = base_url +'ServicioCorrectivo/add';
        obj.msj_success_true = 'Servicio Correctivo guardado';
        obj.btn_disabled = 'btn_save';

        obj.buttons_respuesta = {
                                    imprimir: {
                                      label: "Imprimir",
                                      className: 'btn-info',
                                      callback: function() {
                                            open_imprimir('ServicioCorrectivo/print_servicio_correctivo?idservicio=', idsave);   
                                      }
                                    },
                                    
                                    refrescar: {
                                      label: "Aceptar",
                                      className: 'btn-default',
                                      callback: function() {
                                         $(location).attr('href', url_reload);    
                                      }
                                    }

                                    
                                };

	

        set_data(obj);
    	
    }else{
        $("#btn_save").removeAttr('disabled');
    }

    //Validar segun el comprobante


}


