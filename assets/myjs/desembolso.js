var save = function(){
    var fallas, total;

    //Validar campos 
    fallas=true;
    
    if($("#btn_save").is(":disabled") ){
        alerta("Procesando Desembolso","En estos momentos se esta procesando el desembolso",'warning');
        return 0;
    }else{
        $("#btn_save").attr({'disabled':'disabled'});
    }
    
    if( parseFloat($("#importe_total").val()) <= 0   ){
        alerta("Monto invalido","Importe total debe ser mayor a cero",'warning');

    }else if( $("#input_busqueda_general").val() == ''   ){
        alerta("Campo en Blanco","Nombre de beneficiario debe tener valor ",'warning');

    }else{
        fallas=false;
    }
          
    if(!fallas){      

        var obj = new Object();

        obj.type = 'POST';
        obj.url_save = base_url +'desembolsos/save_desembolso';
        obj.data = $('#form').find('select, textarea, input').serialize();
        obj.async = true;
        obj.url_reload = base_url +'desembolsos/agenda_general';
        obj.msj_success_true = 'Desembolso registrado';
        obj.btn_disabled = 'btn_save';

        obj.buttons_respuesta = {
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