
$(document).ready(function () {
    
    update_contenido_segun_serie();
    shortcut.add("F9",function() {
        save();
    });
        

});

/*
*/

function replace_variables_in_datos(){

    cont_variable_nombre_cliente  = 0;
    cont_variable_RUC_cliente  = 0;
    cont_variable_direccion_cliente  = 0;

    variable_nombre_cliente = "${VARIABLE_NOMBRE_CLIENTE}";
    valor_variable_nombre_cliente = $("#cliente").val();

    variable_RUC_cliente = "${VARIABLE_RUC_CLIENTE}";
    valor_variable_RUC_cliente = $("#ruc_cliente").val();

    variable_direccion_cliente = "${VARIABLE_DIRECCION_CLIENTE}";
    valor_variable_direccion_cliente = $("#direccion_cliente").val();

    $("[name='dato[]']").each(function(){
        campo_dato = $(this); 
        cadena_texto = campo_dato.text()

        if(campo_dato.is("input")){
            cadena_texto = campo_dato.val();            
        }

        if(cadena_texto.indexOf(variable_nombre_cliente) > 0 & valor_variable_nombre_cliente!=''){
            cont_variable_nombre_cliente = cont_variable_nombre_cliente + 1;
            campo_dato.text( campo_dato.text().replace(variable_nombre_cliente, valor_variable_nombre_cliente) );
        }

        if(cadena_texto.indexOf(variable_RUC_cliente) > 0 & valor_variable_RUC_cliente!=''){
            cont_variable_RUC_cliente = cont_variable_RUC_cliente + 1;
            campo_dato.text( campo_dato.text().replace(variable_RUC_cliente, valor_variable_RUC_cliente) );
        }

        if(cadena_texto.indexOf(variable_direccion_cliente) > 0 & valor_variable_direccion_cliente!=''){
            cont_variable_direccion_cliente = cont_variable_direccion_cliente + 1;
            campo_dato.text( campo_dato.text().replace(variable_direccion_cliente, valor_variable_direccion_cliente) );
        }
        
    });

    msj_alerta = " Se encontró "+cont_variable_nombre_cliente+" para nombre_cliente, ";
    msj_alerta += " se encontró "+cont_variable_nombre_cliente+" para RUC_cliente y ";
    msj_alerta += " se encontró "+cont_variable_nombre_cliente+" para direccion_cliente";

    alert(msj_alerta);
}

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

                if(e.tipo == 'img' ){
                    html += "<input type='hidden' name='iddato_"+e.tipo+"[]' value='"+e.iddato+"'>";
                                    
                }else {
                    html += "<input type='hidden' name='iddato[]' value='"+e.iddato+"'>";    
                }
                

                if(e.tipo == 'text' ){    
                    html += "<input type='"+e.tipo+"' class='form-control' id='dato_"+e.iddato+"' name='dato[]' placeholder='"+e.descripcion+"' value='"+e.valor+"'>";
                
                }else if(e.tipo == 'textarea' ){ 
                    html += "<textarea class='form-control' rows='4' id='dato_"+e.iddato+"' name='dato[]' >"+e.valor+"</textarea>";
                
                }else if(e.tipo == 'img' ){
                    html += "<input type='file' class='form-control dato_img' id='dato_"+e.tipo+"_"+e.iddato+"' name='dato_"+e.tipo+"[]' multiple >";
                
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

function is_peso_imagen_valido(maxSizeInMegaBytes){
    
    var inputsDatoImg = document.getElementsByClassName("dato_img"); 
    var maxSizeInBytes = (maxSizeInMegaBytes * 1048576) || 1048576; // 1 MB (1 megabyte = 1048576 bytes)
    var status = true;

    Array.prototype.forEach.call(inputsDatoImg, function(inputImg) {
        
        var files = inputImg.files;
        for (var i = 0; i < files.length; i++) {
            pesoImgBytes = files[i].size;
            if (files[i] && pesoImgBytes > maxSizeInBytes) {
                pesoImgMegabytes = Number((pesoImgBytes / 1024 /1024).toFixed(2));
                
                alerta("Peso de imagen invalido","El peso de la imagen "+i+" ("+pesoImgMegabytes+" MB) supera el peso permitido",'warning');
                return status = false;
            }
        }  

    });

    return status;
}

var save = function(){
    var fallas, total;

    //Validar campos 
    fallas=true; //true significa que hay fallas
    
    if($("#btn_save").is(":disabled") ){
        alerta("Procesando documento","En estos momentos se esta procesando el nuevo documento",'warning');
            return 0;
    }else{
        $("#btn_save").attr({'disabled':'disabled'});
    }

    if(  $("#idcliente").val()==""){
        alerta(" Cliente no valido","Debe seleccionar un cliente valido",'warning');
    } else {

        if(is_peso_imagen_valido(5)){
            fallas=false; //significa que no hay fallas
        }        
    }      
            
    if(!fallas){
        

        var obj = new Object();

        obj.type = 'POST';
        obj.url_save = base_url +'documentaciones/save';
        //obj.data = $('#form').find('select, textarea, input').serialize();

        var form_cabecera_documentacion = new FormData(document.getElementById('form_cabecera_documentacion'));
        var form_datos_documentacion = new FormData(document.getElementById('form_datos_documentacion'));

        form_datos_documentacion.forEach(function(value, key) {
            form_cabecera_documentacion.append(key, value);
        });


        obj.data = form_cabecera_documentacion;
        

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


