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



CREATE TABLE `admin_petromelcanica`.`forma_pago` (
  `idforma_pago` INT NOT NULL AUTO_INCREMENT,
  `cod_forma_pago` VARCHAR(5) NULL,
  `descripcion` VARCHAR(450) NULL,
  PRIMARY KEY (`idforma_pago`));

INSERT INTO `admin_petromelcanica`.`forma_pago`
(`cod_forma_pago`,
`descripcion`)
VALUES
('001', 'DEPÓSITO EN CUENTA'),
('002', 'GIRO'),
('003', 'TRANSFERENCIA DE FONDOS'),
('004', 'ORDEN DE PAGO'),
('005', 'TARJETA DE DÉBITO'),
('006', 'TARJETA DE CRÉDITO EMITIDA EN EL PAÍS POR UNA EMPRESA DEL SISTEMA FINANCIERO'),
('007', 'CHEQUES CON LA CLÁUSULA DE "NO NEGOCIABLE", "INTRANSFERIBLES", "NO A LA ORDEN" U OTRA EQUIVALENTE, A QUE SE REFIERE EL INCISO G) DEL ARTICULO 5° DE LA LEY'),
('008', 'EFECTIVO, POR OPERACIONES EN LAS QUE NO EXISTE OBLIGACIÓN DE UTILIZAR MEDIO DE PAGO'),
('009', 'EFECTIVO, EN LOS DEMÁS CASOS'),
('010', 'MEDIOS DE PAGO USADOS EN COMERCIO EXTERIOR'),
('011', 'DOCUMENTOS EMITIDOS POR LAS EDPYMES Y LAS COOPERATIVAS DE AHORRO Y CRÉDITO NO AUTORIZADAS A CAPTAR DEPÓSITOS DEL PÚBLICO'),
('012', 'TARJETA DE CRÉDITO EMITIDA EN EL PAÍS O EN EL EXTERIOR POR UNA EMPRESA NO PERTENECIENTE AL SISTEMA FINANCIERO, CUYO OBJETO PRINCIPAL SEA LA EMISIÓN Y ADMINISTRACIÓN DE TARJETAS DE CRÉDITO'),
('013', 'TARJETAS DE CRÉDITO EMITIDAS EN EL EXTERIOR POR EMPRESAS BANCARIAS O FINANCIERAS NO DOMICILIADAS'),
('101', 'TRANSFERENCIAS - COMERCIO EXTERIOR'),
('102', 'CHEQUES BANCARIOS  - COMERCIO EXTERIOR'),
('103', 'ORDEN DE PAGO SIMPLE  - COMERCIO EXTERIOR'),
('104', 'ORDEN DE PAGO DOCUMENTARIO  - COMERCIO EXTERIOR'),
('105', 'REMESA SIMPLE  - COMERCIO EXTERIOR'),
('106', 'REMESA DOCUMENTARIA  - COMERCIO EXTERIOR'),
('107', 'CARTA DE CRÉDITO SIMPLE  - COMERCIO EXTERIOR'),
('108', 'CARTA DE CRÉDITO DOCUMENTARIO  - COMERCIO EXTERIOR'),
('999', 'OTROS MEDIOS DE PAGO');

ALTER TABLE `admin_petromelcanica`.`forma_pago` 
ADD COLUMN `estado` ENUM('Activo', 'Inactivo') NULL DEFAULT 'Activo' AFTER `descripcion`;



CREATE TABLE `admin_petromelcanica`.`tipo_moneda` (
  `idtipo_moneda` INT NOT NULL AUTO_INCREMENT,
  `cod_tipo_moneda` VARCHAR(5)  NOT NULL,
  `descripcion` VARCHAR(150) NULL,
  PRIMARY KEY (`idtipo_moneda`));

INSERT INTO `admin_petromelcanica`.`tipo_moneda`
(`cod_tipo_moneda`,
`descripcion`)
VALUES
('PEN', 'Soles');

ALTER TABLE `admin_petromelcanica`.`tipo_moneda` 
ADD COLUMN `estado` ENUM('Activo', 'Inactivo') NULL DEFAULT 'Activo' AFTER `descripcion`;


ALTER TABLE `admin_petromelcanica`.`periodo_pago` 
ADD COLUMN `codigo_facturalaya` VARCHAR(45) NULL COMMENT 'codigo usado para json del cpe proveedor facturalaya' AFTER `estado`;

UPDATE `admin_petromelcanica`.`periodo_pago` SET `codigo_facturalaya` = 'contado' WHERE (`idperiodo_pago` = '1');
UPDATE `admin_petromelcanica`.`periodo_pago` SET `codigo_facturalaya` = 'credito' WHERE (`idperiodo_pago` = '2');
UPDATE `admin_petromelcanica`.`forma_pago` 
SET `estado` = 'Inactivo' WHERE `idforma_pago` NOT IN (1,8) ;


UPDATE `admin_petromelcanica`.`forma_pago` SET `descripcion` = 'EFECTIVO' WHERE (`idforma_pago` = '008');


ALTER TABLE `admin_petromelcanica`.`venta` 
ADD COLUMN `idforma_pago` VARCHAR(5) NULL AFTER `envio_cpe_emision`,
ADD COLUMN `idtipo_moneda` VARCHAR(5) NULL AFTER `idforma_pago`,
ADD COLUMN `idperiodo_pago` INT NULL AFTER `idtipo_moneda`;
ALTER TABLE `admin_petromelcanica`.`venta` 
ADD COLUMN `nro_cuotas` int DEFAULT 1 AFTER `idperiodo_pago`;

