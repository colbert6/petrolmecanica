CREATE OR REPLACE VIEW producto_stock 
AS 

SELECT 
    pro.codbarras as codbarras,
    cat.nombre as categoria,
    mar.nombre as marca, 
    pro.nombre as producto,
    pro.idproducto as idproducto,
    
    pre.nombre as presentacion,
    COALESCE(med.precio_venta,0) as precio,
    s.stock_almacen AS stock, 
    ti.descripcion as  tienda

FROM stock as s
LEFT JOIN producto as pro ON s.producto_idproducto = pro.idproducto
LEFT JOIN presentacion as pre ON pro.presentacion_minima = pre.idpresentacion 
LEFT JOIN unidad_medida as med ON med.producto_idproducto = pro.idproducto AND med.presentacion_idpresentacion = pro.presentacion_minima AND med.estado = 'Activo'
LEFT JOIN tienda as ti ON s.tienda_idtienda = ti.idtienda
LEFT JOIN marca as mar ON  mar.idmarca = pro.marca_idmarca
LEFT JOIN categoria as cat  ON  cat.idcategoria = pro.categoria_idcategoria

ORDER BY cat.nombre ASC, mar.nombre ASC, pro.nombre ASC;

-----


CREATE OR REPLACE VIEW cpe_envio_pendientes 
AS 

SELECT ve.idventa as idmaster, ve.fecha_venta as fecha_emision, ve.nro_documento as comprobante, ve.estado as estado
FROM venta as ve
WHERE (ve.envio_cpe_emision = 0) or (ve.envio_cpe_baja = 0 and ve.estado ='anulado')
ORDER BY ve.fecha_venta ASC;

DROP TABLE IF EXISTS `envio_electronico`;
CREATE TABLE `envio_electronico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idmaster` int(11) DEFAULT NULL,
  `tipo` int(20) DEFAULT NULL,
  `correlativo` int(11) DEFAULT NULL,
  `serie` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,

  `cod_sunat` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `msj_sunat` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `ruta_xml` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ruta_cdr` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ruta_pdf` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,

  `tipoenvio` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_emi` date DEFAULT NULL,
  `fecha_envio` datetime DEFAULT NULL,
  `data_result` text COLLATE utf8_unicode_ci DEFAULT NULL,

  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;