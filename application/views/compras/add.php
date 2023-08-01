<?php 

?>

<div class="row">
  
 <div class="form-horizontal" id="form-compras">    
    
    <div class="col-md-12">
        <div class="box box-info">          
                
            <div class="box-body">
                  
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-xs-3 col-sm-2 control-label">Orden de compra </label>
                        <div class=" col-xs-3 col-sm-4">                            
                            <button type="button" class="btn btn-success " id='torden' name='torden' ></button>
                        </div>
                         <div class="col-sm-6">
                            <div class="input-group">
                                <input type="hidden" name="idorden" id="idorden" />
                                <input class="form-control" type="text" name="codorden" id="codorden" placeholder="Ingrese nro de orden de compra" value="" />
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info btn-flat" onclick="get_search_orden()">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                       
                    <input type="hidden" class="form-control" id="fecha_compra" name="fecha_compra" onblur="updateData()" value="<?php echo date('Y-m-d');?>" >
                    
                    <div class="form-group" style="background-color: silver;">
                        <label for="colaborador_almacen" class="col-xs-12 col-sm-2 control-label">Datos de recepción</label>
                        
                        <div class="col-sm-3">
                          <select class="form-control" id="tienda" name="tienda">           
                            <?php foreach ($tiendas as $data): ?>
                            <option value="<?= $data['id'] ?>"><?= $data['descripcion'] ?></option>
                            <?php endforeach; ?>
                          </select>

                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" id="colaborador_almacen" name="colaborador_almacen">           
                                <?php foreach ($colaboradores_recepcion as $data): ?>
                                <option value="<?= $data['id'] ?>"><?= $data['descripcion'] ?></option>
                                <?php endforeach; ?>
                              </select>
                        </div>
                        <div class="col-sm-3">
                          <input type="date" class="form-control" id="fecha_almacen" name="fecha_almacen" value="<?php echo date('Y-m-d');?>">
                        </div>                       
                        
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="idproveedor" class="col-sm-2 control-label">Datos de proveedor</label>

                        <div class="col-xs-12 col-sm-6">
                            <select class="form-control" id="idproveedor" name="idproveedor" onchange="asignaNroDoc()" >
                                <option></option>
                            </select>
                        </div>
                        <div class="col-xs-8 col-sm-2">                         
                          <input type="text" class="form-control" id="numdoc_proveedor" placeholder="RUC" readonly="readonly">
                        </div>
                        <div class="col-xs-4 col-sm-2">                            
                            <button type="button" class="btn btn-info " id='registrar_nuevo_proveedor'> Nuevo proveedor</button>
                        </div>
                    </div> 

                    <div class="form-group" style="background-color: silver;">
                        <label for="" class="col-sm-2 control-label">Datos de comprobante</label>

                        <div class="col-sm-3">
                            <select class="form-control" id='tipo_comprobante' name='tipo_comprobante'>
                                <?php foreach ($tipos_comprobantes as $data): ?>
                                <option value="<?= $data['id'] ?>"><?= $data['descripcion'] ?></option>
                                <?php endforeach; ?>
                            </select>                      
                        </div>

                        <div class="col-sm-3">
                            <input class="form-control" id="nro_comprobante_compra" name="nro_comprobante_compra" placeholder="Nro comprobante">
                        </div>
                             
                        <div class="col-sm-3">
                            <input class="form-control" id="guia_remision" name="guia_remision" placeholder="Guia Remision">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="idproveedor" class="col-sm-2 control-label">Observaciones </label> 

                        <div class="col-sm-9">
                            <textarea class="form-control" id="obs_compra" name="obs_compra"  placeholder="Ingrese observaciones sobre la compra"></textarea>
                        </div>
                    </div>
                    

            </div><!-- /.box-body -->
      
        </div>
    </div>  
 
    
    <div class="col-md-12">
    
      <div class="box box-warning">
          
        
          
            <div class="box-header with-border">
              <h3 class="box-title">PRODUCTOS ENTRANTES</h3>
            </div>
            <div class="box-body">

          
                <div class="box-body">
                  

                    <div class='col-sm-6'>
                        <!--div class="form-group">
                        <label for="inputPassword3" class="control-label">Nombre del Producto </label>

                        <select class="form-control" id="input_buscar_producto" onchange="table()">
                            <option value="0"></option>
                        </select>

                      </div-->
                        <div class="form-group">
                        <label for="exampleInputEmail1">Producto</label>
                        <div class="input-group input-group-sm">
                            <select class="form-control" id="input_buscar_producto" onchange="table(this)">
                                <option value="0"></option>
                            </select>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info btn-flat" onclick="get_lista_productos()">
                                    <i class="fa fa-refresh"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                    </div>
                    <div class='col-sm-6'>
                        <div class="form-group">
                        <label for="inputPassword3" class="control-label">Codigo Barras de Producto </label>


                        <input type="text" class="form-control" id="codbarras" onkeyup="get_listproduct()" y placeholder="Codigo de Barras">

                      </div>
                    </div>
                    
                    <div id="div_detalle_compra">
                        <table class="table table-bordered" id="detalle_compra">
                          <thead>
                            <tr>
                                <th class="text-center" rowspan="2" style="width:10%">Producto</th>
                                <th class="text-center" rowspan="2" style="width:7%">Und. Paq</th>
                                <th class="text-center" rowspan="2" style="width:7%">Total Paq</th>
                                <th class="text-center" colspan="2" style="width:7%">Precio Actual (UNT)</th>
                                <th class="text-center" colspan="2" style="width:7%">Precio Anterior (UNT)</th>
                                
                                <th class="text-center" rowspan="2" style="width:7%">Lote</th>
                                <th class="text-center" rowspan="2" style="width:7%">Vencimiento</th>
                                <th class="text-center" rowspan="2" style="width:7%">Eliminar</th>
                            </tr>
                            <tr>
                                <th class="text-center" style="width:7%">PC</th>
                                <th class="text-center" style="width:7%">PV</th>
                                <th class="text-center" style="width:7%">PC</th>
                                <th class="text-center" style="width:7%">PV</th>
                            </tr>
                          </thead>
                          <tbody id="table_detalle_compra">   
                            <!--DETALLE DE COMPRA-->

                          </tbody>
                        </table>
                      </div>  
                    
                    <div class="box-footer">
                        <div class="row">

                          <div class="col-xs-2">
                            <p>Articulos : <span id="cantidadItem">0</span></p>
                          </div>  
                           
                           <div class="col-xs-6">
                             <p>Leyenda:
                                <code>PC: Precio de Compra</code>
                                <code>PV: Precio de Venta</code>
                              </p>
                              <p>
                                  <code>F9: Guardar Compra</code>
                                <code>Ctrl + B: Busqueda rápida</code>
                              </p>
                          </div>  
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-6 control-label"> SUBTOTAL (S/.) </label>

                                    <div class="col-sm-6">

                                        <input type="number" onchange="updateData()" class="form-control" id="subtotal" name="subtotal" readonly value="0.00">
                                    </div>
                                </div>
                          </div> 
                   
                        </div>

                       
                      </div>
                  
                    
                    
                  

                  
               

                </div>
                
      </div>
      <!-- /.box-body -->
    </div>
  </div> 
    <div class="col-md-12">
    
      <div class="box box-warning">
          
  
            <div class="box-body">

          
                <div class="box-body">
                  
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="inputPassword3" class="control-label"> IGV (+) </label>
                            <input type="number" class="form-control" id="igv" name="igv" onblur="neto_pagar()" value="0.00">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="inputPassword3" class="control-label"> DESCUENTO (-) </label>
                            <input type="number" class="form-control" id="descuento" onblur="neto_pagar()"  name="descuento" value="0.00">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="inputPassword3" class="control-label"> NETO A PAGAR </label>
                            <input type="number" class="form-control" readonly id="neto_compra" name="neto_compra" placeholder="Total" value="0.00">   
                        </div>
                    </div>
              
                    
                  
                    
                    
                    
                  

                  
               

                </div>
                <button type="button" class="btn btn-danger" onclick="cancelarOrden()">Cancelar</button>
                <button type="button" class="btn btn-success pull-right" id="btn_save" onclick="save()">Compra</button>
                
      </div>
      <!-- /.box-body -->
    </div>
  </div>
    
    </div>
</div>

<script type="text/javascript"> base_url = "<?php echo base_url();  ?>"</script>
