CREATE VIEW producto_stock AS 
SELECT pro.codbarras producto_codigo_barras,  
  CONCAT(cat.nombre,' ',mar.nombre,' ',pro.nombre ) as producto_descripcion, 
  pro.nombre as producto_nombre, 
  cat.nombre as categoria_nombre,
  mar.nombre as marca_nombre ,
  pres.nombre as presentacion_nombre,
  COALESCE(med.precio_venta,0.00) as producto_precio_venta,
  st.stock_almacen as producto_stock,
  tie.descripcion AS tienda_descripcion   
FROM stock st 
LEFT JOIN tienda tie ON tie.idtienda = st.tienda_idtienda
LEFT JOIN producto pro ON pro.idproducto = st.producto_idproducto
LEFT JOIN marca mar ON mar.idmarca = pro.marca_idmarca
LEFT JOIN categoria as cat ON cat.idcategoria = pro.categoria_idcategoria
LEFT JOIN unidad_medida as med ON med.producto_idproducto = pro.idproducto AND med.presentacion_idpresentacion = pro.presentacion_minima AND  med.estado ='Activo'
LEFT JOIN presentacion as pres ON pres.idpresentacion = pro.presentacion_minima
