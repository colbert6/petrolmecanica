<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Almacenes extends MY_Controller {

  function __construct()
  {
      parent::__construct();
      $this->controller = 'Almacenes';//Siempre define las migagas de pan
  }

  public function stock( $idtienda = 1 )
  {

      // CARGANDO MODELO DE ALMACENES
        
        $this->load->model('almacen');        
        $this->metodo = 'Stock';//Siempre define las migagas de pan
        $this->_init(true,false,true);//Carga el tema ( $cargar_menu, $cargar_url, $cargar_template )
        
        // ACCEDIENDO A LOS MODELOS           
        $this->load->library('grocery_CRUD');

        $crud = new grocery_CRUD(); 


        $crud->columns('categoria_nombre','marca_nombre', 'producto_nombre', 'presentacion_nombre', 'producto_precio_venta','producto_stock', 'tienda_descripcion');

        $crud->display_as('producto_codigo_barras','Cod_barras');
        $crud->display_as('categoria_nombre','Categoria');
        $crud->display_as('marca_nombre','Marca');
        $crud->display_as('producto_nombre','Producto');
        $crud->display_as('presentacion_nombre','Medida');
        $crud->display_as('producto_precio_venta','Precio_venta');
        $crud->display_as('producto_stock','Stock');
        $crud->display_as('tienda_descripcion','Tienda');

        $crud->set_table('producto_stock'); //Change to your table name
        $crud->set_primary_key('producto_codigo_barras');

        $crud->order_by('categoria_nombre','asc');

        $crud->unset_operations();
        $output = $crud->render();

        $tiendas = $this->almacen->get_tienda();

        $output->title = 'Stock :: ';
        $output->tiendas = $tiendas;
        $output->idtienda = $idtienda;

        // CARGANDO TEMPLATE DEL SISTEMA    
        $this->load->view('almacenes/stock', $output ) ;
    }    
    
    public function lista_productos_cf()
    {
       $tienda = $this->input->get("t");
       $categoria = $this->input->get("c");
       $marca = $this->input->get("m");
       $this->load->model('almacen');
       $data["data"] = $this->almacen->get_productos_cfilter($tienda,$categoria,$marca);
       $this->load->view('almacenes/tabla.view.php',$data) ;
    }


}
