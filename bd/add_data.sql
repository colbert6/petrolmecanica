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
