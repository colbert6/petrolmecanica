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

function open_seteo_modal_pago (iddesembolso_a_pagar){
    //un Desembolso puede tener N pagos, la suma de los montos pagos deberia ser igual al saldo inicial

    $("#iddesembolso_a_pagar").val(iddesembolso_a_pagar);
    $("#monto_pago").val(0);
    
    $("#detalle_desembolso_para_modal_pago").html($("#desembolso_"+iddesembolso_a_pagar).html());

    

    $("#modal-pago_desembolso").modal({show: true})

}


var save_pago_modal = function(){
    var fallas, total;

    //Validar campos 
    fallas=true;
    btn_save = 'btn_save_modal_pago';
    
    if($("#"+btn_save).is(":disabled") ){
        alerta("Procesando pago","En estos momentos se esta procesando el pago",'warning');
        return 0;
    }else{
        $("#"+btn_save).attr({'disabled':'disabled'});
    }
    
    if( parseFloat($("#monto_pago").val()) <= 0   ){
        alerta("Monto invalido","Importe total debe ser mayor a cero",'warning');

    }else{
        fallas=false;
    }
          
    if(!fallas){      

        var obj = new Object();

        obj.type = 'POST';
        obj.url_save = base_url +'desembolsos/save_pago_desembolso';
        obj.data = $('#form_modal_pago_desembolso').find('select, textarea, input').serialize();
        obj.async = true;
        obj.url_reload = base_url +'desembolsos/agenda_general';
        obj.msj_success_true = 'Pago registrado';
        obj.btn_disabled = btn_save;

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
        $("#"+btn_save).removeAttr('disabled');
    }

    //Validar segun el comprobante

}