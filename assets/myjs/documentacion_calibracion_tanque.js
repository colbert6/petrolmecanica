
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
        alerta("Procesando proforma","En estos momentos se esta procesando la venta",'warning');
            return 0;
    }else{
        $("#btn_save").attr({'disabled':'disabled'});

        fallas=false;
    }      
            
    if(!fallas){
        

        var obj = new Object();

        obj.type = 'POST';
        obj.url_save = base_url +'documentaciones/save_calibra';
        obj.data = $('#form').find('select, textarea, input').serialize();
        obj.async = true;
        obj.url_reload = base_url +'documentaciones/add';
        obj.msj_success_true = 'Documento guardado';
        obj.btn_disabled = 'btn_save';

        obj.buttons_respuesta = {
                                    imprimir: {
                                      label: "Imprimir",
                                      className: 'btn-info',
                                      callback: function() {
                                            open_imprimir('documentaciones/print_documentacion?iddocumentacion=', idsave);   
                                      }
                                    },
                                    
                                    refrescar: {
                                      label: "Aceptar",
                                      className: 'btn-default',
                                      callback: function() {
                                         //$(location).attr('href', url_reload);    
                                      }
                                    }

                                    
                                };

    

        set_data(obj);
        
    }else{
        $("#btn_save").removeAttr('disabled');
    }

    //Validar segun el comprobante

}


