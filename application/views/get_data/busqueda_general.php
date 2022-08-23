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


<div class="form-group" >
    <label for="input_busqueda_general" class="col-xs-10 col-sm-2 control-label"><?php echo $label_text;  ?> </label>
    <div class="col-xs-12 col-sm-10">      
        <input type="text" class="form-control tt-query" id="input_busqueda_general" name="input_busqueda_general" value="<?php echo $input_busqueda_general_value_default; ?>" autocomplete="off">
        <input type="hidden" name="id_result" id="id_result" >            
    </div>
</div>

<script type="text/javascript"> url_get_data = "<?php echo $url_get_data;  ?>"</script>

<script type="text/javascript">
  
  $(document).ready(function () {   

    $('#input_busqueda_general').typeahead({
        source: function (query, process) {
            $.ajax({
                url: base_url + url_get_data,
                type: 'GET',
                data: 'query=' + query,
                dataType: 'JSON',
                async: true,
                success: function (data) {
                    objects = [];
                    map = {};
                    $.each(data, function (i, object) {
                        map[object.texto_result] = object;
                        objects.push(object.texto_result);
                    });
                    process(objects);
                }
            });
        },
        items: 10,
        minLength:3,
        updater: function (item ) {
            obj = map[item];
            $('#id_result').val(obj.id_result);
            return item;
        }

    }); 

  });


</script>

