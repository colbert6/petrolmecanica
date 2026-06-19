
$(document).ready(function () {
    var codigo_ubigeo_cajamarca = "060101";
    $("#id_ubigeo_destino").val(codigo_ubigeo_cajamarca);
    $("#id_ubigeo_partida").val(codigo_ubigeo_cajamarca);
    $("#docs_referencia_cliente_codigoubigeo").val(codigo_ubigeo_cajamarca);

    // Mostrar sección correcta según modalidad inicial
    toggleSeccionTransporte($("#id_modalidadtraslado").val());

    // Cambio de modalidad
    $("#id_modalidadtraslado").on('change', function () {
        toggleSeccionTransporte($(this).val());
    });
});

function toggleSeccionTransporte(modalidad) {
    if (modalidad === '02') { // privado
        $("#seccion_publico").hide();
        $("#seccion_privado").show();
        $("#id_tipo_documento_transporte").val(1); // DNI
    } else { // publico
        $("#seccion_privado").hide();
        $("#seccion_publico").show();
        $("#id_tipo_documento_transporte").val(6); // RUC
    }
}

function remover_detalle_venta(idproducto) {
    $('div[id_prod=' + idproducto + ']').remove();
}

function referenciar_vista_para_crear_guia() {
    var controlador_funcion_ruta = "guias/add/";
    var valor_nro_comprobante = ($("#nro_comprobante_venta_generar_guia").val()).trim();
    if (valor_nro_comprobante === "") {
        $("#nro_comprobante_venta_generar_guia").addClass("input-required");
        return 0;
    }
    $("#nro_comprobante_venta_generar_guia").removeClass("input-required");
    var url_reload = base_url + controlador_funcion_ruta + valor_nro_comprobante;
    $(location).attr('href', url_reload);
}


var save = function () {

    if ($("#btn_save").is(":disabled")) {
        alerta("Procesando Guía", "En estos momentos se esta procesando la venta", 'warning');
        return 0;
    } else {
        $("#btn_save").attr({'disabled': 'disabled'});
        $(".input-required").removeClass("input-required");
    }

    var modalidad = $("#id_modalidadtraslado").val();
    var fallas = false;

    // Validaciones comunes
    if ($("#peso").val() <= 0 ||
        $("#numero_paquetes").val() <= 0 ||
        $("#nro_documento_transporte").val() === "" ||
        $("#dir_partida").val() === "" ||
        $("#dir_destino").val() === "") {
        alerta("Campos en Blanco", "Llene todos los Campos", 'warning');
        $("#numero_paquetes, #nro_documento_transporte").addClass("input-required");
        $("#dir_partida, #dir_destino").addClass("input-required");
        fallas = true;

    } else if (modalidad === '01') { // Transporte público
        if ($("#razon_social_transporte").val() === "" || $("#numero_mtc").val() === "") {
            alerta("Campos en Blanco", "Para transporte público se requiere Razón social y Nro MTC", 'warning');
            $("#razon_social_transporte, #numero_mtc").addClass("input-required");
            fallas = true;
        } else if ($("#id_tipo_documento_transporte").val() != 6) {
            alerta("Documento incorrecto", "Para transporte público el documento debe ser RUC", 'warning');
            $("#id_tipo_documento_transporte").addClass("input-required");
            fallas = true;
        }

    } else if (modalidad === '02') { // Transporte privado
        if ($("#nombres_chofer").val() === "" ||
            $("#apellidos_chofer").val() === "" ||
            $("#numero_licencia").val() === "" ||
            $("#transporte_nro_placa").val() === "") {
            alerta("Campos en Blanco", "Para transporte privado se requieren todos los datos del chofer", 'warning');
            $("#nombres_chofer, #apellidos_chofer, #numero_licencia, #transporte_nro_placa").addClass("input-required");
            fallas = true;
        } else if ($("#id_tipo_documento_transporte").val() != 1) {
            alerta("Documento incorrecto", "Para transporte privado el documento debe ser DNI", 'warning');
            $("#id_tipo_documento_transporte").addClass("input-required");
            fallas = true;
        }
    }

    if (!fallas) {
        // Pasar descripción del motivo al campo hidden
        $("#motivo_traslado").val($("#id_motivotraslado option:selected").text());

        var text_carga = "<h4> Procesando creación de guia de remisión: </h4>";

        var obj = new Object();
        obj.type         = 'POST';
        obj.url_save     = base_url + 'guias/save';
        obj.data         = $('#form').find('select, textarea, input').serialize();
        obj.async        = true;
        obj.url_reload   = base_url + 'guias/lista';
        obj.msj_success_true = 'Guia guardada';
        obj.text_carga   = text_carga;
        obj.btn_disabled = 'btn_save';

        obj.buttons_respuesta = {
            imprimir: {
                label: "Imprimir",
                className: 'btn-info',
                callback: function () {
                    open_imprimir('guias/print_documento?idguia=', idsave);
                }
            },
            refrescar: {
                label: "Aceptar",
                className: 'btn-default',
                callback: function () {
                    $(location).attr('href', url_reload);
                }
            }
        };

        set_data(obj);
    } else {
        $("#btn_save").removeAttr('disabled');
    }
};
