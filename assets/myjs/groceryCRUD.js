
//IMPORTANTES Considerar el file flexigrid.js para no perder los eventos posterior a refresh ajax

//assets/grocery_crud/themes/flexigrid/js/flexigrid.js

$(document).ready(function () {


    $('.anular').on('click', function (e){

        e.preventDefault();

        href = $(this).attr('href'); 

        bootbox.confirm({
            message: "Seguro de eliminar registro?",
            buttons: {
                cancel: {
                    label: 'No',
                    className: 'btn-default'
                },
                confirm: {
                    label: 'Yes',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                
                if(result){
                    $.ajax({
                        url: href,
                        type: 'GET',
                        dataType: 'JSON',
                        async: true,
                        success: function (result) {
                            //  var rpta = JSON.parse(datos);

                            bootbox.dialog({
                                title: 'Solicitud de anulacion',
                                message: result.msj
                            });
                        }
                    });
                }                

            }
        });


    })

    $('.imprimir , .guia').on('click', function (e){
        e.preventDefault();
        href = $(this).attr('href'); 
        window.open(href, '_blank');
    })

    $('.ruta_result').on('click', function (e){

        e.preventDefault();
        href = $(this).attr('href'); 
        url = href.split('ir=');   //console.log(url)
        window.open(url[1], '_blank');

    })


    $('.cpe_consulta').on('click', function (e){

        e.preventDefault();

        href = $(this).attr('href'); 

        $.ajax({
            url: href,
            type: 'GET',
            dataType: 'JSON',
            async: true,
            success: function (datos) {
                //  var rpta = JSON.parse(datos);
                texto = JSON.stringify(datos, null, '    ');


                bootbox.dialog({
                    title: "Consulta de CPE",
                    message: "<pre>"+texto,
                    size: 'large',
                    buttons: {
                        confirm: {
                            label: '<i class="fa fa-check"></i> Aceptar'
                        }
                    },
                });
            }
        });
     

    })


    $('.cpe_envio').on('click', function (e){

        e.preventDefault();

        href = $(this).attr('href'); 

        $.ajax({
            url: href,
            type: 'GET',
            dataType: 'JSON',
            async: true,
            beforeSend: function(){
                msj_proceso = bootbox.alert({
                    title: 'Solicitud enviada',
                    message: "<p id='carga_msj'> <i class='fa fa-spin fa-spinner'></i> Procesando ...</p>",
                    closeButton: false
                }); 
           },
            success: function (datos) {
                //  var rpta = JSON.parse(datos);
                texto = JSON.stringify(datos, null, '    ');
                bootbox.dialog({
                    title: "Consulta de CPE",
                    message: "<pre>"+texto,
                    size: 'large',
                    buttons: {
                        confirm: {
                            label: '<i class="fa fa-check"></i> Aceptar'
                        }
                    },
                });
            },
            error:function (result) {
                texto = JSON.stringify(datos, null, '    ');
                bootbox.dialog({
                    title: "Consulta de CPE - ERROR",
                    message: "<pre>"+texto,
                    size: 'large',
                    buttons: {
                        confirm: {
                            label: '<i class="fa fa-check"></i> Aceptar'
                        }
                    },
                });
            },
            complete: function(){
             // Handle the complete event
             msj_proceso.modal('hide');
           }
        });
     

    })

	
});


function consulta_servidor(href){
    $.ajax({
        url: href,
        type: 'GET',
        dataType: 'JSON',
        async: true,
        success: function (datos) {
            texto = JSON.stringify(datos, null, '    ');

            bootbox.dialog({
                title: "Respuesta deL SERVIDOR",
                message: "<pre>"+texto,
                size: 'large',
                buttons: {
                    confirm: {
                        label: '<i class="fa fa-check"></i> Aceptar'
                    }
                },
            });
        }
    });
}
