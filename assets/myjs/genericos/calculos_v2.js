var calcular_subtotal = function(idproducto){    
    
    var cantidad=$('.item_cantidad[id_prod="'+idproducto+'"]').find('input').val();
    var pv=$('.item_precio[id_prod='+idproducto+']').find('input').val();

    pv = isNaN(pv) || pv=='' ?0:parseFloat(pv);        
    cantidad = isNaN(cantidad) || cantidad=='' || !Number.isInteger(parseFloat(cantidad))?0:parseFloat(cantidad); 

    var subtotal = pv * cantidad ; 

    $('.item_subtotal[id_prod='+idproducto+']').find('input').val(subtotal.toFixed(2));  
    calcular_total(); 
}

var calcular_total=function(){
    var subtotales = 0;
    var descuento = $('#descuento').val() || 0;
    var igv =  0;
    var total = 0;

    //calcular la sumatoria del igv y el subtotal 
    //en base al calculo de cada item

    $(".item_subtotal").each(function(){
        var id_atributo_s = $(this).attr('id_prod');
        var cantidad_s=$('.item_cantidad[id_prod="'+id_atributo_s+'"]').find('input').val();
        var pv_s=$('.item_precio[id_prod='+id_atributo_s+']').find('input').val();

        var precio_base =  (parseFloat(pv_s) / 1.18).toFixed(2) ;
        var igv_base =  (parseFloat(pv_s) - parseFloat(precio_base) ).toFixed(2) ;

        var subtotal_det = precio_base * cantidad_s;
        var igv_det = igv_base * cantidad_s;

        if (!isNaN(precio_base) && precio_base!=''){
            subtotales=parseFloat(subtotales)+parseFloat(subtotal_det);
            igv=parseFloat(igv)+parseFloat(igv_det);
        }        
    });  

    descuento = 0; //parseFloat(descuento).toFixed(2);

    total = (parseFloat(subtotales) + parseFloat(igv));

    console.log('des:'+descuento+'igv:'+igv+'tot:'+total);
    $("#igv").val(parseFloat(igv).toFixed(2));  
    $("#subtotales").val(parseFloat(subtotales).toFixed(2));  

    $(".total").html(parseFloat(total).toFixed(2)); //si es texto grande  
    $("#total").val(parseFloat(total).toFixed(2));  //si es un input 

    return total;


}



