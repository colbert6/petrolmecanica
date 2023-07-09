

$(document).ready(function () {
	codigo_ubigeo_cajamarca = "060101";
	$("#id_ubigeo_destino").val(codigo_ubigeo_cajamarca);
	$("#id_ubigeo_partida").val(codigo_ubigeo_cajamarca);
	$("#docs_referencia_cliente_codigoubigeo").val(codigo_ubigeo_cajamarca);

  });


function remover_detalle_venta(idproducto){
	$('div[id_prod='+idproducto+']').remove();
}

function referenciar_vista_para_crear_guia(){
	controlador_funcion_ruta = "guias/add/"
	valor_nro_comprobante = ($("#nro_comprobante_venta_generar_guia").val()).trim();
	if( valor_nro_comprobante == "" ){		
		$("#nro_comprobante_venta_generar_guia").addClass("input-required");
		return 0
    }
	$("#nro_comprobante_venta_generar_guia").removeClass("input-required");
    url_reload = base_url + controlador_funcion_ruta  + valor_nro_comprobante;
    //window.open(url);
    $(location).attr('href', url_reload);   
}



var save = function(){

	var fallas, total;
	//Deshabilitar boton

	if($("#btn_save").is(":disabled") ){
            alerta("Procesando Guía","En estos momentos se esta procesando la venta",'warning');
            return 0;
	}else{
		$("#btn_save").attr({'disabled':'disabled'});
		$(".input-required").removeClass("input-required");
	}

    //Validar campos 
    fallas=true;

    if(  $("#peso").val()<=0 || 
            $("#numero_paquetes").val()<=0 ||
            $("#nro_documento_transporte").val() == "" ||
            $("#razon_social_transporte").val() == "" ||
			$("#dir_partida").val() == "" ||
            $("#dir_destino").val() == "" ){
        alerta("Campos en Blanco","Llene todos los Campos",'warning');
		
		$("#numero_paquetes, #nro_documento_transporte").addClass("input-required");
		$("#dir_partida, #dir_destino, #razon_social_transporte").addClass("input-required");

    }else if( ($("#id_modalidadtraslado").val()=='01' && $("#id_tipo_documento_transporte").val()!=6) || 
			($("#id_modalidadtraslado").val()=='02' && $("#id_tipo_documento_transporte").val()!=1)
		)
	{
        alerta("No corresponde modalidad traslado con el documento transporte","Si el transporte es publico el doumento debe ser RUC, Si el transporte es privado el documento debe ser DNI",'warning');
		$("#id_modalidadtraslado, #id_tipo_documento_transporte").addClass("input-required");

    } else if ( $("#id_modalidadtraslado").val()=='02' && $("#transporte_nro_placa").val() == "" ){
    	alerta("NRO de placa requerido","Si el transporte es privado, se requiere llenar el campo NRO PLACA",'warning');
		$("#id_modalidadtraslado, #transporte_nro_placa").addClass("input-required");

    } else {  
		fallas=false;
    }

    if(!fallas){
		
		//mover motivo traslado texto a campo hidden
    	id_motivotraslado_text = $( "#id_motivotraslado option:selected" ).text();
		$("#motivo_traslado").val(id_motivotraslado_text);

		text_carga = "<h4> Procesando creación de guia de remisión:  </h4>";

		var obj = new Object();

        obj.type = 'POST';
        obj.url_save = base_url +'guias/save';
        obj.data = $('#form').find('select, textarea, input').serialize();
        obj.async = true;
        obj.url_reload = base_url +'guias/lista';
        obj.msj_success_true = 'Guia guardada';
        obj.text_carga = text_carga;
        obj.btn_disabled = 'btn_save';

        obj.buttons_respuesta = {
                                    imprimir: {
                                      label: "Imprimir",
                                      className: 'btn-info',
                                      callback: function() {
                                            //open_imprimir('ventas/print_venta?idventa=', idsave); 
                                            open_imprimir('guias/print_documento?idguia=', idsave); 
                                      }
                                    },
                                    
                                    refrescar: {
                                      label: "Aceptar",
                                      className: 'btn-default',
                                      callback: function() {
                                         $(location).attr('href', url_reload);    
                                      }
                                    }

                                    
                                }


        set_data(obj);
        //$("#btn_save").removeAttr('disabled');
    }else{
    	$("#btn_save").removeAttr('disabled');
    }

    //Validar segun el comprobante


    
}



