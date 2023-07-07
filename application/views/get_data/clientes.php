<style type="text/css">

    .typeahead{
            font-size: 16px;
            width: 100%;
        }
    .dropdown-menu>li>a {
        white-space: normal !important;
    }    
    .typeahead>li:nth-child(odd) {
        background-color:#fbfbfb;
    }
    .typeahead, .tt-query, .tt-hint {
        width: 100%;    
    }

</style>

<?php
    
    $dni = isset($cliente_base[0]->dni)? $cliente_base[0]->dni: '';
    $idcliente = isset($cliente_base[0]->idcliente)? $cliente_base[0]->idcliente: '';
    $ruc = isset($cliente_base[0]->ruc)? $cliente_base[0]->ruc: '';
    $razon_social = isset($cliente_base[0]->razon_social)? $cliente_base[0]->razon_social: '';
    $direccion = isset($cliente_base[0]->direccion)? $cliente_base[0]->direccion: '';

    $flag_show_btn_importar_proforma = isset($flag_show_btn_importar_proforma)? $flag_show_btn_importar_proforma: true;
    $list_btns_info =  isset($list_btns_info)? $list_btns_info: array();
?>


 <div class="form-group" >
    
    

    <?php if($flag_show_btn_importar_proforma ){  ?>
    <div class="col-xs-6 col-sm-6" >
        <input type="button" value="- Importar Proforma -" class="btn btn-primary" onclick="get_correlativo_proforma_info()">
    </div>
    <?php } // endif -> $flag_show_btn_importar_proforma  ?>

    <?php foreach ($list_btns_info as $clave => $valor){  ?>
    <div class="col-xs-6 col-sm-6" >
        <input type="button" value="<?php echo $valor['value']; ?>" class="btn btn-primary" 
        onclick="<?php echo $valor['onclick_function']; ?>" >
    </div>
    <?php } // foreach -> $list_btns_info  ?>

    <div class="col-xs-6 col-sm-6" >
        <input type="button" value="- Nuevo cliente -" class="btn btn-info" onclick="abrir_modal_busqueda_cliente()">
    </div>
    
 </div>

 <div class="form-group" style="margin-bottom: 0px;">
    <div class="col-sm-2">
        <label for="ruc_cliente" class="control-label" >Ruc </label>
    </div>
    <div class="col-sm-10" >
        <input type="text" class="form-control" id="ruc_cliente" name="ruc_cliente" placeholder="Ruc" value="<?php echo $ruc; ?>" onkeypress="soloNumeros(event,'ruc')" maxlength="11"> 
        </div>    
 </div>

 <div class="form-group" style="margin-bottom: 0px;">
    <div class="col-sm-2">
        <label for="dni_cliente" class="control-label" >Dni </label>
    </div>
    <div class="col-sm-10" >
        <input type="text" class="form-control" id="dni_cliente" name="dni_cliente" placeholder="Dni" value="<?php echo $dni; ?>" onkeypress="soloNumeros(event,'dni')" maxlength="8"> 
    </div>    
 </div>


<div class="form-group" style="margin-bottom: 0px;">
    <label for="cliente" class="col-xs-10 col-sm-2 control-label">Cliente </label>
    <div class="col-xs-12 col-sm-10">      
        <input type="text" class="form-control tt-query" id="cliente" name="cliente" value="<?php echo $razon_social; ?>" autocomplete="off">
        <input type="hidden" name="idcliente" id="idcliente" value="<?php echo $idcliente; ?>">            
    </div>
</div>

<div class="form-group" >
    <label for="dirección_cliente" class="col-xs-8 col-sm-2 control-label">Direccion </label>
    <div class="col-xs-12 col-sm-12">
      <input type="text" class="form-control input-sm" id="direccion_cliente" name="direccion_cliente" placeholder="Dirección" value="<?php echo $direccion; ?>" >
    </div>
</div>



<script type="text/javascript">
  
  $(document).ready(function () {   

    $('#cliente').typeahead({
        source: function (query, process) {
            $.ajax({
                url: base_url + 'get_datas/get_clientes',
                type: 'GET',
                data: 'query=' + query,
                dataType: 'JSON',
                async: true,
                success: function (data) {
                    objects = [];
                    map = {};
                    $.each(data, function (i, object) {
                        map[object.razon_social] = object;
                        objects.push(object.razon_social);
                    });
                    process(objects);
                }
            });
        },
        items: 10,
        minLength:3,
        updater: function (item ) {
            obj = map[item];
            $('#idcliente').val(obj.idcliente);
            $('#dni_cliente').val(obj.dni);
            $('#ruc_cliente').val(obj.ruc);
            $('#direccion_cliente').val(obj.direccion);
            return item;
        }

    }); 

  });


    //----- Solo permite introducir numeros.
    function soloNumeros(e , tipo){
      var key = window.event ? e.which : e.keyCode;
      if(key == 13 ){
        get_cliente_document(tipo);
      }
      if (key < 48 || key > 57) {
        e.preventDefault();
      }
    }

    function get_cliente_document(tipo){

        //String valor;
        valor = $('#'+tipo+'_cliente').val();


        if( valor.length != $('#'+tipo+'_cliente').attr('maxlength')){
            alerta("Valor Incorrecto","El número de digitos no corresponde al tipo de documento",'warning');

        }else{
            //String valor = $('#'+tipo+'_cliente').val();

            $.ajax({
                url: base_url + 'get_datas/get_cliente_document',
                type: 'GET',
                data: 'tipo='+tipo+'&numero='+valor,
                dataType: 'JSON',
                success: function (obj) {
                    if(obj=== null){
                        alerta("No encontrado","No se encontro cliente con el documento indicado",'warning');
                    }else{
                        $('#idcliente').val(obj.idcliente);
                        $('#dni_cliente').val(obj.dni);
                        $('#ruc_cliente').val(obj.ruc);
                        $('#direccion_cliente').val(obj.direccion)
                        $('#cliente').val(obj.razon_social);

                    }
                    
                }
            });
        }
        

    }
    //-----

    //---- Add new client ---- 
    function abrir_modal_busqueda_cliente(){
        //10730319342
        bootbox.prompt({
            title: "Ingrese el RUC/DNI del cliente a buscar", 
            inputType: 'number',
            callback: function(result){ //result = numero_documento
                get_informacion_cliente(result);  
            }
        });
    }

    function get_informacion_cliente(numero_documento){
        
        cantidad_digitos_dni = 8;
        cantidad_digitos_ruc = 11;

        if( numero_documento.length != cantidad_digitos_dni &&  numero_documento.length != cantidad_digitos_ruc){
            alerta("ALERTA", "ERROR: Cantidad de digitos del documento incorrecto, RUC=11 / DNI=8.", 'warning');

        }else{
            //String valor = $('#'+tipo+'_cliente').val();
            $.ajax({
                url: base_url + 'get_datas/get_cliente_document_info_sunat',
                type: 'GET',
                data: 'tipo=na&numero='+numero_documento,
                dataType: 'JSON',
                success: function (obj) {
                    if(obj === null){
                        bootbox.alert("ERROR: No se encontro información para el número de documento indicado.");
                    }else if(obj.estado === false){
                        bootbox.alert(obj.mensaje);
                    }else{
                        html = "DATA ENCONTRADA <br> ---------------<br>";
                        for (var campo in obj.data){
                            html += "<br> <b>"+campo.toUpperCase()+":</b> "+obj.data[campo];
                        }
                        html += "<br><br> ¿Desea registrar como nuevo cliente?  <br>";
                        confirm_client_finded(html, obj.data);
                    }
                    
                }
            });
        }
    }

    function confirm_client_finded(html_client_info, obj_client_info){
        bootbox.confirm({
            message: html_client_info,
            buttons: {
                confirm: {
                    label: 'Registrar nuevo CLIENTE',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'Cancelar',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if(result){
                    $.ajax({
                        url: base_url + 'clientes/add_cliente_from_info_sunat',
                        type: 'POST',
                        data: obj_client_info,
                        dataType: 'JSON',
                        success: function (obj) {                            
                            if(obj.estado=== false){
                                bootbox.alert(obj.mensaje);                               
                            }else{
                                alerta("RESPUESTA","Se ha registrado nuevo cliente",'success');
                            }
                        }
                    });
                }
            }
        });
    }
    //----


    //--- //---- Add exportar proforma ---- 
    function get_correlativo_proforma_info(){
        //10730319342
        bootbox.prompt({
            title: "Ingrese el ID PROFORMA o NRO DOC COMPROBANTE a buscar", 
            //inputType: 'number',
            callback: function(result){ 
                identificador_proforma='correlativo_proforma';
                get_proforma_info(identificador_proforma, result);  
            }
        });
    }


    //-------PROFORMA-----------
    function get_proforma_info(tipo_documento, numero_documento){

        //String valor = $('#'+tipo+'_cliente').val();
        $.ajax({
            url: base_url + 'get_datas/get_proforma_info',
            type: 'GET',
            data: 'tipo='+tipo_documento+'&numero='+numero_documento,
            dataType: 'JSON',
            success: function (obj) {
                if(obj=== null){
                    bootbox.alert("No se encontro datos de la proforma");
                }if(obj.respuesta === "error"){
                    bootbox.alert(obj.mensaje);
                }else{
                    html = "PROFORMA " +obj.Nro_documento+" ENCONTRADA<br> ---------------<br>";
                    html += "Cliente: "+obj.Cliente+" <br>";
                    html += "Ruc: "+obj.Ruc+" <br>";
                    html += "Direccion: "+obj.Direccion+" <br>";
                    html += "Comprobante: "+obj.Comprobante+" <br>";
                    html += "Fecha: "+obj.Fecha+" <br>";
                    html += "Observacion: "+obj.Observacion+" <br>";
                    html += "Periodo_pago: "+obj.Periodo_pago+" <br>";
                    html += "Tipo_pago: "+obj.Tipo_pago+" <br>";
                    html += "Total: "+obj.Total+" <br>";
                    html += "<br><br> Es CORRECTA la información?  <br>";
                    confirm_proforma_finded(html, obj);
                }
                
            }
        });
        
    }

    function confirm_proforma_finded(html_client_info, obj_client_info){
        bootbox.confirm({
            message: html_client_info,
            buttons: {
                confirm: {
                    label: 'Importar PROFORMA',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'NO',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if(result){
                    $('#ruc_cliente').val(obj_client_info.Ruc);
                    $('#tipo_moneda').val(obj_client_info.idtipo_moneda);
                    $('#condicion_pago').val(obj_client_info.idperiodo_pago);
                    get_cliente_document('ruc');
                    buscar_importar_proforma(obj_client_info.idproforma, obj_client_info.Nro_documento)
                    
                }
            }
        });
    }

    function buscar_importar_proforma(idproforma, nro_documento){
        $.ajax({
            url: base_url + 'proformas/exportar_proforma_detalle',
            type: 'GET',
            data: 'idproforma='+idproforma+'&nro_documento='+nro_documento,
            dataType: 'JSON',
            success: function (obj) {                            
                

                obj.forEach(element => add_detalle(element));
            },

        });
    }

</script>

