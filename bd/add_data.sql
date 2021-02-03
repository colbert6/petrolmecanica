ALTER TABLE `detalle_proforma` ADD `informacion` TEXT NOT NULL DEFAULT '' AFTER `estado`;


INSERT INTO `cliente` (`idcliente`, `razon_social`, `nombre_comercial`, `ruc`, `dni`, `direccion`, `contacto`, `correo`, `fecha_nacimiento`, `fecha_creacion`, `estado`) VALUES ('1', 'CLIENTE', 'CLIENTE', '00000000000', '00000000', 'SIN DIRECCION', '973949944', 'petrolmecanica.jc@gmail.com', '1999-01-01', '2020-06-06', 'Activo');


ALTER TABLE `venta` ADD `envio_cpe_emision` INT(4) NOT NULL DEFAULT '0' COMMENT '0->pendiente\r\n1->enviado' AFTER `cliente_email`;
ALTER TABLE `venta` ADD `envio_cpe_baja` INT(4) NOT NULL DEFAULT '0' COMMENT '0->pendiente\r\n1->enviado' AFTER `cliente_email`;



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

DROP TABLE IF EXISTS `error_envio_electronico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `error_envio_electronico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `errors` varchar(500) DEFAULT NULL,
  `idmaster` int(255) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `tipo_envio` varchar(50) DEFAULT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `usuario_envio` int(11) DEFAULT NULL,
  `data_result` text COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


ALTER TABLE `cliente` ADD `cod_ubigeo`  varchar(6) NOT NULL DEFAULT '060101' AFTER `estado`;

-- ejecutado