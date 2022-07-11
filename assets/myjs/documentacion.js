
$(document).ready(function () {
    
    update_contenido_segun_serie();
    shortcut.add("F9",function() {
        save();
    });
   	 	

});

function input_key_value_import_documento(){
        //10730319342
        bootbox.prompt({
            title: "Ingrese el ID DOCUMENTO a importar", 
            //inputType: 'number',
            callback: function(result){ 
                url_consulta = "get_datas/find_datos_documentacion_existente";
                get_contenido_ajax(url_consulta , result );  
            }
        });
    }

function update_contenido_segun_serie(){

    idserie = $('#idserie').val();
    serie_text = $('#idserie>option:selected').text(); 
    $('#texto').val(serie_text);

    url_consulta = "get_datas/get_datos_default_documentacion";

    get_contenido_ajax( url_consulta,  idserie  );

}

function get_contenido_ajax( url_consulta, key_consulta ){

    $.ajax({
        url: base_url + url_consulta,
        type: 'GET',
        data: {idserie:key_consulta},
        dataType: 'JSON',
        async: true,
        success: function (data_response) {

            serie = data_response.get_correlativo;

            if( serie.titulo !== null){ 
                $("#texto").val(serie.titulo);
                $('#correlativo').val(serie.correlativo); 
            }
            if( url_consulta !== "get_datas/get_datos_default_documentacion"){
                $('#idserie').val(data_response.id_serie);
                
            }

            data = data_response.get_datos_documentacion;


            html = "<form role='form'>";

            data.forEach(function(e) {                

                html += "<div class='form-group' id='form_dato_"+e.iddato+"'>";
                html += "<label for='dato_"+e.iddato+"'>"+e.descripcion+" <a onclick='remover_item("+e.iddato+")'> (Quitar) </a></label>";
               
                html += "<div >";
                html += "<input type='hidden' name='iddato[]' value='"+e.iddato+"'>";

                if(e.tipo == 'text' ){    
                    html += "<input type='"+e.tipo+"' class='form-control' id='dato_"+e.iddato+"' name='dato[]' placeholder='"+e.descripcion+"' value='"+e.valor+"'>";
                
                }else if(e.tipo == 'textarea' ){ 
                    html += "<textarea class='form-control' rows='4' id='dato_"+e.iddato+"' name='dato[]' >"+e.valor+"</textarea>";
                }

                html += "</div>";
                html += "</div> ";
            });

            html += "</form>";

            $("#div_detalle_documentacion").html(html);
        }
    });
}

function remover_item(iddato){
    $('div[id="form_dato_'+iddato+'"]').remove();
}


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
        obj.url_save = base_url +'documentaciones/save';
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


