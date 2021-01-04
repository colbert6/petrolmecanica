
  
 <!-- Default box -->
  <div class="box">
      <div class="box-header with-border">
          <h3 class="box-title"> Bienvenido <?php echo $this->session->userdata('username') ?> </h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
      </div>
      <div class="box-body" >
      <div class="row">
        <div class="col-lg-2 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>Nueva Venta </h3>

              <p>Crear una venta</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="<?php echo base_url('ventas/add');?>" class="small-box-footer">ir a <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-2 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>Lista Compra </h3>

              <p>Lista de compras</p>
            </div>
            <div class="icon">
              <i class="fa fa-truck"></i>
            </div>
            <a href="<?php echo base_url('compras/lista');?>" class="small-box-footer">ir a <i class="fa fa-arrow-circle-right"></i></a>
          </div>

        </div>

      
        <div class="col-lg-2 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>Stock  </h3>

              <p>Ver stock de Productos</p>
            </div>
            <div class="icon">
              <i class="fa fa-sort"></i>
            </div>
            <a href="<?php echo base_url('almacenes/stock');?>" class="small-box-footer">ir a <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-2 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>Precios </h3>

              <p>Modificar el precio de los productos</p>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            <a href="<?php echo base_url('precios/historial');?>" class="small-box-footer">ir a <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      </div>
      <!-- /.box-body -->
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->

