/*
 Navicat Premium Data Transfer

 Source Server         : 35.188.181.162_3306
 Source Server Type    : MySQL
 Source Server Version : 50732
 Source Host           : 35.188.181.162:3306
 Source Schema         : admin_petromelcanica

 Target Server Type    : MySQL
 Target Server Version : 50732
 File Encoding         : 65001

 Date: 15/01/2021 22:24:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for categoria
-- ----------------------------
DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria`  (
  `idcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `descripcion` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `codsunat` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `estado` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  PRIMARY KEY (`idcategoria`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categoria
-- ----------------------------
INSERT INTO `categoria` VALUES (1, 'TUBERIA  Y CONEXIONES ROSCADAS SCH -40-80', NULL, NULL, 'Activo');
INSERT INTO `categoria` VALUES (2, 'ACCESORIOS DE CISTERNA ', NULL, NULL, 'Activo');
INSERT INTO `categoria` VALUES (3, 'ACCESORIOS DE TANQUES ENTERRADOS', NULL, NULL, 'Activo');
INSERT INTO `categoria` VALUES (4, 'ACCESORIOS PARA DISPENSADORES Y SURTIDORES', NULL, NULL, 'Activo');
INSERT INTO `categoria` VALUES (5, 'SISTEMA Y TELEMEDICION', NULL, NULL, 'Activo');
INSERT INTO `categoria` VALUES (6, 'CONEXIONES ELÉCTRICAS', NULL, NULL, 'Activo');
INSERT INTO `categoria` VALUES (7, 'TECHOS CANOPY', NULL, NULL, 'Activo');
INSERT INTO `categoria` VALUES (8, 'ACCESORIOS PARA TANQUE DE GLP ', NULL, NULL, 'Activo');
INSERT INTO `categoria` VALUES (9, 'SERVICIO', NULL, NULL, 'Activo');

-- ----------------------------
-- Table structure for cliente
-- ----------------------------
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente`  (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nombre_comercial` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ruc` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dni` varchar(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `direccion` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `contacto` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `correo` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fecha_nacimiento` date NULL DEFAULT NULL,
  `fecha_creacion` date NULL DEFAULT NULL,
  `estado` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  PRIMARY KEY (`idcliente`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cliente
-- ----------------------------
INSERT INTO `cliente` VALUES (0, 'BERTHA PADILLA GONZALES', NULL, '10277107681', NULL, 'CARR. JAEN  - SAN IGNACIOKM.26+401 SECTOR YANUYACU JAEN-JAEN-CAJAMARCA.', '-', '-', NULL, NULL, 'Activo');
INSERT INTO `cliente` VALUES (2, 'EMPRESA MULTISERVICIOS GENERALES 777 EL MAGNATE E.I.R.L.', NULL, '20605816305', NULL, 'KM. 2.5 CARRETERA A BAMBAMARCA CAS.SAN FRANCISCO DE ASIS CAJAMARCA  CAJAMARCA  CAJAMARCA', NULL, NULL, NULL, NULL, 'Activo');
INSERT INTO `cliente` VALUES (4, 'TRANSPORTES ACUARIO S.A.C.', 'TRANSPORTES ACUARIO S.A.C.', '20453556086', NULL, 'JIRON ANGAMOS N° 1108 CAJAMARCA-CAJAMARCA-CAJAMARXA', NULL, NULL, NULL, NULL, 'Activo');
INSERT INTO `cliente` VALUES (5, 'EL OVALO ESTACION & SERVICIOS GENERALES S.R.L.', 'EL OVALO', '20529654546', NULL, 'AV. SAN MARTIN DE PORRES N°2475 CAJAMARCA-CAJAMARCA-CAJAMARCA', NULL, NULL, NULL, NULL, 'Activo');
INSERT INTO `cliente` VALUES (6, 'SEGUNDO FABIAN CASTILLO MONTOYA', NULL, '10266343391', NULL, 'CARRETERA JESUS-CAJAMARCA KM 1264+145 CASERIO LA COLPA  JESUS-CAJAMARCA-CAJAMARCA', NULL, NULL, NULL, NULL, 'Activo');
INSERT INTO `cliente` VALUES (7, 'RAUL LUCHO CHAVEZ ALVAREZ', NULL, '10267334850', NULL, 'AV. VIA DE EVITAMIENTO NORTE N°621  CAJAMARCA-CAJAMARCA-CAJAMARCA', NULL, NULL, NULL, NULL, 'Activo');
INSERT INTO `cliente` VALUES (8, 'ELIZABETH AZULA PEREZ ', NULL, '10457728971', NULL, 'PREDIO MOCAN PARCELA 5003 SECTOR LA ARENITA CARRETERA PANAMERICANA NORTE PAIJAN  ASCOPE  LA LIBERTAD', NULL, NULL, NULL, NULL, 'Activo');
INSERT INTO `cliente` VALUES (9, 'GRIFO CONTINENTAL S.A.C.', NULL, '20453552846', NULL, 'JR.ANGAMOS N° 1108 CAJAMARCA  CAJAMARCA  CAJAMARCA ', NULL, NULL, NULL, NULL, 'Activo');
INSERT INTO `cliente` VALUES (10, 'SAN JUAN DE CHOTA DUQUE JAN E.I.R.L.', NULL, '20491685434', NULL, 'KM. 2.5 CARRETERA A BAMBAMARCA CAS.SAN FRANCISCO DE ASIS CAJAMARCA  CAJAMARCA  CAJAMARCA', NULL, NULL, NULL, NULL, 'Activo');
INSERT INTO `cliente` VALUES (11, 'EMPRESA MULTISERVICIOS GENERALES DUQUE JAN EL MAGNATE E.I.R.L.', NULL, '20601835089', NULL, 'CARRETERA CAJAMARCA CELENDIN SECTOR CHIMCHIM CHUQUIPUQUIO  CP PUYLLUCANA  BAÑOS DEL INCA  CAJAMARCA ', NULL, NULL, NULL, NULL, 'Activo');
INSERT INTO `cliente` VALUES (12, 'CODELMAR S.A.C.', NULL, '20603594267', NULL, 'AV. VIA DE EVITAMIENTO NORTE N° 1829 CAJAMARCA  CAJAMARCA  CAJAMARCA.', NULL, NULL, NULL, NULL, 'Activo');
INSERT INTO `cliente` VALUES (13, 'MALAVER SALAZAR ASOCIADOS SAC', NULL, '20495843182', NULL, 'AV, FRANCISCO JAVIER MARIATEG N° 789  DPTO. 704 URB. SANTA BEATRIZ LIMA-LIMA-JESUS MARIA', NULL, NULL, NULL, NULL, 'Activo');
INSERT INTO `cliente` VALUES (14, 'DIOMENEZ FERNANDEZ DIAZ', NULL, '10441581977', NULL, 'CARRETERA FERNANDO BELAUNDE TERRY Y A CALLE COMERCIO  CASERIO PUENTE TECHIN PUCARA_JAEN_CAJAMARCA', NULL, NULL, NULL, NULL, 'Activo');

-- ----------------------------
-- Table structure for colaborador
-- ----------------------------
DROP TABLE IF EXISTS `colaborador`;
CREATE TABLE `colaborador`  (
  `idcolaborador` int(11) NOT NULL AUTO_INCREMENT,
  `perfil` int(11) NULL DEFAULT NULL,
  `nombre` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `usuario` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `clave` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dni` varchar(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `contacto` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `correo` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fecha_nacimiento` date NULL DEFAULT NULL,
  `estado` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  PRIMARY KEY (`idcolaborador`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of colaborador
-- ----------------------------
INSERT INTO `colaborador` VALUES (1, 1, 'Yober Jimenez', 'yjimenez', 'yjimenez123', '', '', '	petrolmecanicajc.sac@gmail.com', '1996-05-01', 'Activo');
INSERT INTO `colaborador` VALUES (2, 2, 'Usuario 2', 'calampa', '1234', '12345678', '987567897', 'calampa@calampa.com', '1996-07-13', 'Activo');
INSERT INTO `colaborador` VALUES (3, 1, 'Colbert Calampa', 'admin', 'admin6', '73031934', '973949944', 'colbersiho@gmail.com', '1996-06-06', 'Activo');
INSERT INTO `colaborador` VALUES (4, 1, 'Diego Contreras', 'diego', 'diego', '-', '-', '-', '1996-06-06', 'Activo');

-- ----------------------------
-- Table structure for compra
-- ----------------------------
DROP TABLE IF EXISTS `compra`;
CREATE TABLE `compra`  (
  `idcompra` int(11) NOT NULL AUTO_INCREMENT,
  `tienda_idtienda` int(11) NULL DEFAULT NULL,
  `proveedor_idproveedor` int(11) NULL DEFAULT NULL,
  `colaborador_recepcion` int(11) NULL DEFAULT NULL,
  `colaborador_registro` int(11) NULL DEFAULT NULL,
  `tipo_comprobante_idtipo_comprobante` int(11) NULL DEFAULT NULL,
  `nrocomprobante` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `guia_remision` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fecha_compra` date NULL DEFAULT NULL,
  `fecha_recepcion` date NULL DEFAULT NULL,
  `observacion` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `total` decimal(18, 2) NULL DEFAULT NULL,
  `igv` decimal(18, 2) NULL DEFAULT NULL,
  `descuento` decimal(18, 2) NULL DEFAULT NULL,
  `subtotal` decimal(18, 2) NULL DEFAULT NULL,
  `fecha_creacion` datetime NULL DEFAULT NULL,
  `estado` enum('vigente','anulado') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'vigente',
  PRIMARY KEY (`idcompra`) USING BTREE,
  INDEX `proveedor_idproveedor`(`proveedor_idproveedor`) USING BTREE,
  INDEX `colaborador_recepcion`(`colaborador_recepcion`) USING BTREE,
  INDEX `colaborador_registro`(`colaborador_registro`) USING BTREE,
  INDEX `tipo_comprobante_idtipo_comprobante`(`tipo_comprobante_idtipo_comprobante`) USING BTREE,
  CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`proveedor_idproveedor`) REFERENCES `proveedor` (`idproveedor`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`colaborador_recepcion`) REFERENCES `colaborador` (`idcolaborador`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `compra_ibfk_3` FOREIGN KEY (`colaborador_registro`) REFERENCES `colaborador` (`idcolaborador`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `compra_ibfk_4` FOREIGN KEY (`tipo_comprobante_idtipo_comprobante`) REFERENCES `tipo_comprobante` (`idtipo_comprobante`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of compra
-- ----------------------------

-- ----------------------------
-- Table structure for dato
-- ----------------------------
DROP TABLE IF EXISTS `dato`;
CREATE TABLE `dato`  (
  `iddato` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tipo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `validacion` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `abreviatura` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `estado` enum('vigente','anulado') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `datos_documento` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`iddato`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dato
-- ----------------------------
INSERT INTO `dato` VALUES (1, 'Suscribe', 'textarea', NULL, NULL, 'vigente', 0);
INSERT INTO `dato` VALUES (2, 'Acuerdo', 'textarea', NULL, NULL, 'vigente', 0);
INSERT INTO `dato` VALUES (3, 'Conclusión', 'textarea', NULL, NULL, 'vigente', 0);
INSERT INTO `dato` VALUES (4, 'Caracteristicas', 'textarea', NULL, NULL, 'vigente', 0);
INSERT INTO `dato` VALUES (5, 'Usuario', 'textarea', NULL, NULL, 'vigente', 0);
INSERT INTO `dato` VALUES (6, 'Producto', 'text', NULL, NULL, 'vigente', 0);
INSERT INTO `dato` VALUES (7, 'Fabricante', 'text', NULL, NULL, 'vigente', 0);
INSERT INTO `dato` VALUES (8, 'Capacidad', 'text', NULL, NULL, 'vigente', 0);
INSERT INTO `dato` VALUES (9, 'Material', 'text', NULL, NULL, 'vigente', 0);
INSERT INTO `dato` VALUES (10, 'Norma Técnica', 'text', NULL, NULL, 'vigente', 0);
INSERT INTO `dato` VALUES (11, 'Año de Fabricación', 'text', NULL, NULL, 'vigente', 0);
INSERT INTO `dato` VALUES (12, 'Subtitulo 1', 'text', '0', 'sub', 'vigente', 0);
INSERT INTO `dato` VALUES (13, 'Medidas', 'text', '0', 'med', 'vigente', 0);
INSERT INTO `dato` VALUES (14, 'Acabado Exterior', 'text', '0', 'Acab ext.', 'vigente', 0);
INSERT INTO `dato` VALUES (15, 'Accesorios', 'textarea', '0', 'acces', 'vigente', 0);
INSERT INTO `dato` VALUES (16, 'Presión de Prueba en Maestranza', 'text', '0', 'presión', 'vigente', 0);
INSERT INTO `dato` VALUES (17, 'Tiempo de Prueba', 'text', '0', 'tiempo', 'vigente', 0);
INSERT INTO `dato` VALUES (18, 'N° de Serie', 'text', '0', 'serie', 'vigente', 0);
INSERT INTO `dato` VALUES (19, 'Subtitulo 2', 'text', '0', 'sub', 'vigente', 0);
INSERT INTO `dato` VALUES (20, 'DESCRIPCIÓN', 'textarea', '0', 'cab', 'vigente', 0);
INSERT INTO `dato` VALUES (21, 'Fecha documento', 'text', NULL, 'fecha_doc', 'vigente', 0);
INSERT INTO `dato` VALUES (22, 'PRIMERA', 'textarea', '0', 'PT', 'vigente', 0);
INSERT INTO `dato` VALUES (23, 'Introducción', 'textarea', '0', 'Int', 'vigente', 0);
INSERT INTO `dato` VALUES (24, 'SEGUNDA', 'textarea', '0', 'PT', 'vigente', 0);
INSERT INTO `dato` VALUES (25, 'TERCERA', 'textarea', '0', 'PT', 'vigente', 0);
INSERT INTO `dato` VALUES (26, 'CUARTA', 'textarea', '0', 'PT', 'vigente', 0);
INSERT INTO `dato` VALUES (27, 'QUINTA', 'textarea', '0', 'PT', 'vigente', 0);
INSERT INTO `dato` VALUES (28, 'SEXTA', 'textarea', '0', 'PT', 'vigente', 0);
INSERT INTO `dato` VALUES (29, 'SEPTIMA', 'textarea', '0', 'PT', 'vigente', 0);
INSERT INTO `dato` VALUES (30, 'OCTAVA', 'textarea', '0', 'PT', 'vigente', 0);
INSERT INTO `dato` VALUES (31, 'NOVENO', 'textarea', '0', 'PT', 'vigente', 0);
INSERT INTO `dato` VALUES (32, 'TIEMPO DE ENTREGA', 'textarea', '0', 'TENT', 'vigente', 0);

-- ----------------------------
-- Table structure for datos_documentacion
-- ----------------------------
DROP TABLE IF EXISTS `datos_documentacion`;
CREATE TABLE `datos_documentacion`  (
  `iddato` int(11) NOT NULL,
  `iddocumento` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `valor` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `add_descripcion` int(11) NULL DEFAULT 0,
  `add_borde` int(11) NULL DEFAULT 0,
  `salto_linea` int(11) NULL DEFAULT 2,
  `iddatos_documentacion` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`iddatos_documentacion`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 49 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of datos_documentacion
-- ----------------------------
INSERT INTO `datos_documentacion` VALUES (1, 7, 1, 'El que suscribe Gerente General de la empresa PETROLMECANICA JC SAC CON RUC N°\n20602440908.\n', 0, 0, 4, 1);
INSERT INTO `datos_documentacion` VALUES (1, 8, 1, 'El que suscribe Gerente General de la empresa PETROLMECANICA JC SAC CON RUC N°\r\n20602440908.\r', 0, 0, 2, 2);
INSERT INTO `datos_documentacion` VALUES (1, 9, 1, 'El que suscribe Gerente General de la empresa PETROLMECANICA JC SAC CON RUC N°\r\n20602440908.\r', 0, 0, 2, 3);
INSERT INTO `datos_documentacion` VALUES (1, 10, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 0, 0, 2, 4);
INSERT INTO `datos_documentacion` VALUES (2, 7, 2, 'Haber realizado XXXXXXXXXXXXXXXX.', 0, 0, 2, 5);
INSERT INTO `datos_documentacion` VALUES (2, 8, 2, 'Que realizó el XXXXXXXXXXXXXXXXXXXX. En el establecimiento comercial de la empresa SUSECION SANCHEZ SILVA BASILIO SAC CON RUC N° 20600633903ubicado en JR, amazonas n° 102  en el distrito y provincia de Celendín departamento de Cajamarca. Fecha de mantenimiento de los mismos   el .  En el que los equipos se quedan en perfecto estado.', 0, 0, 2, 6);
INSERT INTO `datos_documentacion` VALUES (2, 9, 2, 'Haber realizado XXXXXXXXXXXXXXXX.', 0, 0, 2, 7);
INSERT INTO `datos_documentacion` VALUES (3, 7, 9, 'Se expide el presente certificado para los fines que estime conveniente.\r', 0, 0, 2, 8);
INSERT INTO `datos_documentacion` VALUES (3, 8, 3, 'Se expide la presente constancia para los fines que estime conveniente.\r', 0, 0, 2, 9);
INSERT INTO `datos_documentacion` VALUES (3, 9, 9, 'Se expide el presente certificado para los fines que estime conveniente.\r', 0, 0, 2, 10);
INSERT INTO `datos_documentacion` VALUES (3, 10, 19, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.', 0, 0, 2, 11);
INSERT INTO `datos_documentacion` VALUES (4, 7, 4, 'Caracteristicas:', 0, 0, 2, 12);
INSERT INTO `datos_documentacion` VALUES (4, 9, 4, 'Caracteristicas:', 0, 0, 2, 13);
INSERT INTO `datos_documentacion` VALUES (5, 7, 3, 'PROPIETARIO: XXXXXXXXXXXXXXXXXXXXXX\r\nRUC: XXXXXXXXXXXXXXXXX\r\nDirección : XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX', 0, 0, 2, 14);
INSERT INTO `datos_documentacion` VALUES (5, 9, 3, 'PROPIETARIO: XXXXXXXXXXXXXXXXXXXXXX\r\nRUC: XXXXXXXXXXXXXXXXX\r\nDirección : XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX', 0, 0, 2, 15);
INSERT INTO `datos_documentacion` VALUES (5, 10, 3, 'PROPIETARIO: XXXXXXXXXXXXXXXXXXXXXX\r\nDirección : XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX', 0, 0, 4, 16);
INSERT INTO `datos_documentacion` VALUES (6, 10, 6, NULL, 1, 1, 0, 17);
INSERT INTO `datos_documentacion` VALUES (7, 10, 7, 'PETROLMECANICA JC S.A.C.', 1, 1, 0, 18);
INSERT INTO `datos_documentacion` VALUES (8, 10, 8, '', 1, 1, 0, 19);
INSERT INTO `datos_documentacion` VALUES (9, 10, 9, 'Acero ASTM A-36 de 1/4\" de espesor.', 1, 1, 0, 20);
INSERT INTO `datos_documentacion` VALUES (10, 10, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME sección\r\nIX', 1, 1, 0, 21);
INSERT INTO `datos_documentacion` VALUES (11, 10, 11, NULL, 1, 1, 0, 22);
INSERT INTO `datos_documentacion` VALUES (12, 10, 2, '1. DATOS GENERALES', 0, 0, 2, 23);
INSERT INTO `datos_documentacion` VALUES (13, 10, 12, 'L= 2.30 Mts. //  D= 2.30 Mts.', 1, 1, 0, 24);
INSERT INTO `datos_documentacion` VALUES (14, 10, 13, 'Zincromato epoxico // Coaltar C200 color negro.', 1, 1, 0, 25);
INSERT INTO `datos_documentacion` VALUES (15, 10, 14, 'Medición y tele medición 2\".\nDescarga 4\".\nVenteo 2\" .\nSucción 4\" .\nManhole 60 Cm.', 1, 1, 0, 26);
INSERT INTO `datos_documentacion` VALUES (16, 10, 15, 'Neumática 15 libras por pulgada cuadrada', 1, 1, 0, 27);
INSERT INTO `datos_documentacion` VALUES (17, 10, 16, '12 horas', 1, 1, 0, 28);
INSERT INTO `datos_documentacion` VALUES (18, 10, 17, NULL, 1, 1, 3, 29);
INSERT INTO `datos_documentacion` VALUES (19, 10, 4, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE\n', 0, 0, 2, 30);
INSERT INTO `datos_documentacion` VALUES (20, 10, 5, 'ESPECIFICACIONES\nTANQUE', 1, 1, 0, 31);
INSERT INTO `datos_documentacion` VALUES (1, 12, 1, 'Yo, XXXXXXXXXXXXXXXXXX, con cédula de identidad N° XXXXXXXXXx PROPIETARIA DE UNA VIVIENDA EN CONSTRUCCIÓN EN EL CANTÓN DE SUCUA, a petición verbal de la parte interesada.', 0, 0, 3, 32);
INSERT INTO `datos_documentacion` VALUES (12, 12, 2, 'CERTIFICO:', 0, 0, 3, 33);
INSERT INTO `datos_documentacion` VALUES (2, 12, 3, 'Que el señor JOSE ANTONIO PLAY CANTOS, cédula de identidad', 0, 0, 3, 34);
INSERT INTO `datos_documentacion` VALUES (3, 12, 4, 'Es todo cuanto puedo certificar en honor a la verdad, puediendo el interesado hacer uso del presente documento en lo que estime conveniente.', 0, 0, 12, 35);
INSERT INTO `datos_documentacion` VALUES (21, 12, 5, 'Cajamarca, xxxxx de XXXX del 2020', 0, 0, 3, 36);
INSERT INTO `datos_documentacion` VALUES (24, 13, 4, 'SEGUNDA: \nLOS COMITENTES, DESEAN CONSTRUIR Y PONER EN MARCHA UNA ESTACIÓN DE SERVICIOS PARA EL EXPENDIO DE COMBUSTIBLES LÍQUIDOS, EN EL INMUEBLE UBICADO EN CARRETERA JAEN-SAN IGNACIO KM. 26+401 SECTOR YANUYACU DEL DISTRITO Y PROVINCIA DE JAEN DEPARTAMENTO DE CAJAMARCA, DEBIDAMENTE INSCRITO EN LA PARTIDA ELECTRÓNICA N° 02167629, DEL REGISTRO DE PREDIOS DE CAJAMARCA; PARA LO CUAL PREVIAMENTE NECESITA TENER LOS EXPEDIENTES TECNICOS APROBADOS POR PARTE DE LA AUTORIDAD COMPETENTE (INFORME TECNICO FAVORABLE). ', 0, 0, 2, 37);
INSERT INTO `datos_documentacion` VALUES (23, 13, 2, 'CONSTE POR EL PRESENTE DOCUMENTO EL CONTRATO PRIVADO DE LOCACIÓN POR LA FABRICACION DE DOS TECHOS DE PROYECCION CANOPY DE LAS SIGUIENTES MEDIDAS TECHO 01 06 METROS DE LARGO, 19 DE ANCHO Y 07 METROS DE ALTURA; TECHO 02 17 METROS DE LARGO, 19 METROS DE ANCHO Y 05,80 METROS DE ALTO , QUE CELEBRA DE UNA PARTE LA SEÑORA , BERTHA PADILLA GONZALES.IDENTIFICADO CON DNI N° 26624911, DE NACIONALIDAD PERUANA, CON DOMICILIO EN CARRETERA JAEN-SAN IGNACIO KM. 26+401 SECTOR YANUYACU DEL DISTRITO Y PROVINCIA DE JAEN  DEPARTAMENTO DE CAJAMARCA, A QUIEN EN ADELANTE SE LE DENOMINARA EL COMITENTE; Y, DE LA OTRA PARTE LA EMPRESA DENOMINADA PETROLMECANICA JC S.A.C, CON RUC N° 20602440908, CON DOMICILIO EN EL PJ. LA AMISTAD N° 145, BAR. MOLLEPAMPA, DEL DISTRITO, PROVINCIA Y DEPARTAMENTO DE CAJAMARCA, DEBIDAMENTE REPRESENTADO POR SU GERENTE GENERAL EL SEÑOR YOBER EDINSON JIMENEZ GUEVARA, IDENTIFICADO CON DNI N° 46563140, DE NACIONALIDAD PERUANA, MAYOR DE EDAD, CON DOMICILIO EN LA CALLE SAN FRANCISCO N° 435, DISTRITO Y PROVINCIA DE JAÉN, DEL DEPARTAMENTO DE CAJAMARCA, CON PODERES DEBIDAMENTE INSCRITOS EN LA PARTIDA ELECTRÓNICA N° 11169531, DEL REGISTRO DE PERSONAS JURÍDICAS DE LA OFICINA REGISTRAL DE CAJAMARCA, A QUIEN EN ADELANTE SE LE DENOMINARÁ EL LOCADOR, EN LOS TÉRMINOS Y CONDICIONES SIGUIENTES EN LOS TÉRMINOS Y CONDICIONES SIGUIENTES: ', 0, 0, 2, 38);
INSERT INTO `datos_documentacion` VALUES (22, 13, 3, 'PRIMERA: \nEL LOCADOR, ES UNA PERSONA JURÍDICA DEDICADA A LA ELABORACIÓN DE INFORMES TÉCNICOS, INSTALACIÓN Y PUESTA EN MARCHA DE ESTACIÓN DE SERVICIOS PARA LA VENTA COMBUSTIBLES LÍQUIDOS Y GLP, FABRICACION DE TANQUES ESTACIONARIOS DE ALMACENAMIENTO DE COMBUSTIBLE LIQUIDO Y ESTRUCTURAS METALICAS EN GENERAL. \nLOS COMITENTES, SON PERSONAS NATURALES DEDICADAS A LA COMPRA Y VENTA, DISTRIBUCIÓN, REPRESENTACIÓN Y COMERCIALIZACIÓN AL POR MAYOR Y MENOR DE COMBUSTIBLES, TALES COMO PETRÓLEO, GASOLINA, Y LUBRICANTES EN GENERAL Y OTROS PRODUCTOS AFINES, ASÍ COMO AL TRANSPORTE DE COMBUSTIBLE. ', 0, 0, 2, 39);
INSERT INTO `datos_documentacion` VALUES (25, 13, 5, 'TERCERA:\nPOR EL PRESENTE DOCUMENTO EL COMITENTE CONTRATAN LOS SERVICIOS DE EL LOCADOR (EMPRESA PETROLMECANICA J.C S.A.C) PARA QUE, EN ADELANTE REALISE LA FABRICACION DE DOS TECHOS DE PROYECION CANOPY.', 0, 0, 2, 40);
INSERT INTO `datos_documentacion` VALUES (26, 13, 6, 'CUARTA: OBLIGACIONES DEL LOCADOR. \nPARA LOS EFECTOS DE LO DISPUESTO EN LA CLÁUSULA SEGUNDA Y TERCERA, EL LOCADOR ENTREGARA LO SIGUIENTE.\nADJUNTO.', 0, 0, 2, 41);
INSERT INTO `datos_documentacion` VALUES (27, 13, 7, 'QUINTA: \nAMBAS PARTES ESTABLECEN COMO PLAZO MÁXIMO LA FABRICACION DE LOS 2 TECHOS CON LAS MEDIDAS ESTIPULAS EN 50 DIAS (CINCUENTA) DÍAS QUE SE COMPUTARA A PARTIR DE LA SUSCRIPCIÓN DEL PRESENTE CONTRATO EN CORDINACION CON LOS TRABAJOS CIVILES (PARA LA COLOCACION DE LAS COLUMNAS ARMADAS DE CONCRETO)', 0, 0, 2, 42);
INSERT INTO `datos_documentacion` VALUES (28, 13, 8, 'SEXTA: RESOLUCION DEL CONTRATO \nSERÁ CAUSAL DE RESOLUCIÓN EL INCUMPLIMIENTO DE CUALQUIERA DE LAS OBLIGACIONES CONTRAÍDAS POR EL LOCADOR Y DE LOS PLAZOS ESTABLECIDOS EN EL PRESENTE CONTRATO, QUEDANDO EL COMITENTE FACULTADOS A INICIAR LAS ACCIONES LEGALES CORRESPONDIENTES AL RESARCIMIENTO DE LOS DAÑOS Y PERJUICIOS CAUSADOS.', 0, 0, 2, 43);
INSERT INTO `datos_documentacion` VALUES (29, 13, 9, 'SÉPTIMO: \nEL LOCADOR DECLARA CONTAR CON LA EXPERIENCIA, CONOCIMIENTOS Y MEDIOS NECESARIOS PARA LA ELABORACIÓN DEL PROYECTO COMPROMETIÉNDOSE A CUMPLIR CON LAS OBLIGACIONES ASUMIDAS EN EL PLAZO ACORDADO BAJO LOS ESTÁNDARES DE CALIDAD ESTABLECIDOS POR NORMA PERTINENTE. ', 0, 0, 2, 44);
INSERT INTO `datos_documentacion` VALUES (30, 13, 10, 'OCTAVO: \nEL COMITENTE Y EL LOCADOR CONVIENEN QUE EL PRECIO TOTAL POR EL TRABAJO CONTRATADO ES LA SUMA DE S/ 110,000.00 (CIENTO DIEZ MIL Y 00/100 SOLES) EL COSTO INCLUYE TODO LO ANTES MENCIONADO EN LA CLAUSULA CUARTA Y EL PAGO DE LA GRUA PARA LEVANTAR LA ESTRUCTURA A LAS COLUMNAS DE CONCRETO ARMADO. \nEL MONTO ANTES INDICADOS SE CANCELARÁ DE LA SIGUIENTE MANERA: \n-	S/ 80,000.00 (OCHENTA MIL CON 00/100 SOLES) A LA FIRMA DEL CONTRATO. \n-	S/ 10,000.00 (DIEZ MIL CON 00/100 SOLES) A QUINCE DESPUES DEL INICIO DE LA OBRA. \n-	S/. 10,000.00 (DIEZ MIL CON 00/100 SOLES) PARA EL CIELO RAZO. ==\n-	S/. 1O,000.00 (ONCE MIL CON 00/100 SOLES) AL LA ENTREGA DE OBRA TERMINADA.\n\nNOTA   \n-	EN EL MONTO ESTIPULADO NO INCLUYE TRABAJOS CIVILES (FOSA DE TANQUES ESCABACIONES CANALES DE CONCRETO Y PICADO DE PARED======\n-	LOS PRECIOS INCLUYEN IGV.\n-	NO INCLUYEN COLUMNAS DE FIERRO LAS CUALES SERAN PUESTAS POR EL CLIENTE Y SERAN DE CONCRETO ARMADO.\n-	NO INCLUYE CABLEADO DE CAMARAS DE SEGURIDAD NI PARLANTES NI CABLESPARA LOS MISMOS.\n', 0, 0, 2, 45);
INSERT INTO `datos_documentacion` VALUES (32, 13, 11, 'TIEMPO DE ENTREGA: \nEL TIEMPO DE ENTREGA SERA EN ACUERDO AL AVANCE DE TRABAJOS CIVILES ESTIPULADO EN LA CLAUSULA QUINTA. ', 0, 0, 2, 46);
INSERT INTO `datos_documentacion` VALUES (31, 13, 12, 'NOVENO: DISPOSICIONES COMPLEMENTARIAS \nLAS PARTES CONVIENEN QUE TODO LO NO ESTIPULADO EN EL PRESENTE CONTRATO, SE REGIRÁ POR LAS NORMAS CONTENIDAS EN EL CÓDIGO CIVIL Y NORMAS PENALES VIGENTES, SOMETIÉNDOSE AMBAS PARTES A LA JURISDICCIÓN DE LOS JUECES Y SALAS ESPECIALIZADAS DE LA CIUDAD DE JAEN. ', 0, 0, 2, 47);
INSERT INTO `datos_documentacion` VALUES (1, 13, 13, 'EN SEÑAL DE CONFORMIDAD, SE SUSCRIBE EL PRESENTE DOCUMENTO, EN LA CIUDAD DE CAJAMARCA, A TREINTA DÍAS DEL MES DE MAYO DEL DOS MIL VEINTE. \n\n\n\n\n\nLOS COMITENTES                                                      EL LOCADOR', 0, 0, 2, 48);

-- ----------------------------
-- Table structure for detalle_compra
-- ----------------------------
DROP TABLE IF EXISTS `detalle_compra`;
CREATE TABLE `detalle_compra`  (
  `iddetalle_compra` int(11) NOT NULL AUTO_INCREMENT,
  `producto_idproducto` int(11) NULL DEFAULT NULL,
  `tienda_idtienda` int(11) NULL DEFAULT NULL,
  `idpresentacion` int(11) NULL DEFAULT NULL,
  `cantidadxpresentacion` decimal(18, 2) NULL DEFAULT NULL,
  `precioxpresentacion` decimal(18, 2) NULL DEFAULT NULL,
  `cantidad` decimal(18, 2) NULL DEFAULT NULL,
  `descuento` decimal(18, 2) NULL DEFAULT NULL,
  `subtotal` decimal(18, 2) NULL DEFAULT NULL,
  `lote` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `estado` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  `compra_idcompra` int(11) NULL DEFAULT NULL,
  `descripcion` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fecha_vencimiento` date NULL DEFAULT NULL,
  PRIMARY KEY (`iddetalle_compra`) USING BTREE,
  INDEX `producto_idproducto`(`producto_idproducto`) USING BTREE,
  INDEX `tienda_idtienda`(`tienda_idtienda`) USING BTREE,
  CONSTRAINT `detalle_compra_ibfk_1` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `detalle_compra_ibfk_2` FOREIGN KEY (`tienda_idtienda`) REFERENCES `tienda` (`idtienda`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detalle_compra
-- ----------------------------

-- ----------------------------
-- Table structure for detalle_documentacion
-- ----------------------------
DROP TABLE IF EXISTS `detalle_documentacion`;
CREATE TABLE `detalle_documentacion`  (
  `iddetalle_documentacion` int(11) NOT NULL AUTO_INCREMENT,
  `documentacion_iddocumentacion` int(11) NULL DEFAULT NULL,
  `dato_iddato` int(11) NULL DEFAULT NULL,
  `valor` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `estado` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  `orden` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`iddetalle_documentacion`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 631 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detalle_documentacion
-- ----------------------------
INSERT INTO `detalle_documentacion` VALUES (1, 1, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (2, 1, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (3, 1, 5, 'PROPIETARIO: PEDRO BUSTAMANTE TERRONES. CON RUC N° 10428755168.\r\nDirección : Jr. Túpac Amaru S/N carretera a san Luis de Lucma, distrito de SOCOTA, provincia de CUTERVO, departamento de CAJAMARCA.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (4, 1, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (5, 1, 20, 'ESPECIFICACIONES\r\nTANQUE 01', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (6, 1, 6, 'DIESEL B5 S-50.', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (7, 1, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (8, 1, 8, '2,250 Galones.', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (9, 1, 9, 'Acero ASTM A-36 de 3/16” de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (10, 1, 10, 'Acorde con normas API.RP-1615  UL-58 codigo ASME sección IX.', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (11, 1, 11, 'Agosto del 2019.', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (12, 1, 13, 'L=3.23 Mts.  // D= 1.90 Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (13, 1, 14, 'Zincromato epoxico // Coaltar C200 color negro.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (14, 1, 15, 'Medición 2\"\r\nDescarga 4\"\r\nVenteo 2\"\r\nSucción 4\"\r\nManhole 60 Cm.', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (15, 1, 16, 'Neumática 15 libras por pulgada cuadrada.', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (16, 1, 17, '12 horas', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (17, 1, 18, '01-TK-PJC-2019', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (18, 1, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\nCajamarca, agosto del 2019.', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (19, 2, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (20, 2, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (21, 2, 5, 'PROPIETARIO: PEDRO BUSTAMANTE TERRONES. CON RUC N° 10428755168.\r\nDirección : Jr. Túpac Amaru S/N carretera a san Luis de Lucma, distrito de SOCOTA, provincia de CUTERVO, departamento de CAJAMARCA.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (22, 2, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (23, 2, 20, 'ESPECIFICACIONES\r\nTANQUE 02', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (24, 2, 6, 'GASOHOL 84 PLUS - GASOHOL 90 PLUS.', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (25, 2, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (26, 2, 8, '1,125 Galones // 1,125 Galones = 2, 250 Galones.', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (27, 2, 9, 'Acero ASTM A-36 de 3/16” de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (28, 2, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME secciónIX', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (29, 2, 11, 'Agosto del 2019.', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (30, 2, 13, 'L= 1.62 Mts. / L= 1.62 Mts.  LT = 3.24 Mts. ', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (31, 2, 14, 'Zincromato epoxico // Coaltar C200 color negro.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (32, 2, 15, 'Medición 2\"\r\nDescarga 4\"\r\nVenteo 2\"\r\nSucción 4\"\r\nManhole 60 Cm.\r\n', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (33, 2, 16, 'Neumática 15 libras por pulgada cuadrada', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (34, 2, 17, '12 horas', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (35, 2, 18, '02-TK-PJC-2019 // 03-TK-PJC-2019.', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (36, 2, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\nCajamarca, agosto del 2019.', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (37, 3, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (38, 3, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (39, 3, 5, 'PROPIETARIO: EL OVALO ESTACION & SERVICIOS GENERALES S.R.L. CON RUC N° 20529654546.\r\nDirección : AV SAN MARTIN DE PORRES  N° 2475-2485 ESQ. CON JR. SAN CAMILO N° 307-317\r\nEN EL DISTRITO DE CAJAMARCA, PROVINCIA DE CAJAMARCA, DEPARTAMENTO DE CAJAMARCA.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (40, 3, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (41, 3, 20, 'ESPECIFICACIONES\r\nTANQUE 05', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (42, 3, 6, 'GASOHOL 90 PLUS', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (43, 3, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (44, 3, 8, '7,800 Galones.', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (45, 3, 9, 'Acero ASTM A-36 de 1/4” de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (46, 3, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME secciónIX', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (47, 3, 11, 'Setiembre del 2019', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (48, 3, 13, 'L= 7.20 Mts.  //  D= 2.30 Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (49, 3, 14, 'Zincromato epoxico // Coaltar C200 color negro.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (50, 3, 15, 'Medición y/o Telemedición 2\".\r\nDescarga 4\".\r\nVenteo 2\"\r\nSuccion 4\".\r\nManhole 60Cm.', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (51, 3, 16, 'Neumática 15 libras por pulgada cuadrada', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (52, 3, 17, '12 horas', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (53, 3, 18, '04-TK-PJC-2019', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (54, 3, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\nCajamarca, setiembre del 2019.', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (55, 4, 1, 'El que suscribe Gerente General de la empresa PETROLMECANICA JC SAC CON RUC N°\r\n20602440908.\r\n', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (56, 4, 2, 'Certifica haber  realizado  el mantenimiento del sistema eléctrico  de los tableros  de distribución,estabilizador, transformador,y dispensador de combustible, quedando en óptimas condiciones. ', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (57, 4, 5, 'PROPIETARIO: JOSE ISIDRO SOLÓRZANO CERNA.\r\nRUC: 10266550117.\r\nDirección : JR. AREQUIPA N° 355 EN EL DISTRITO DE JESÚS, PROVINCIA DE CAJAMARCA, DEPARTAMENTO DE CAJAMARCA.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (58, 4, 4, 'Tablero de distribucion trifasico 24 polos.\r\nDispensador tokheim premier B.\r\nEstabilizador de 5000 kva variable.\r\nTransformador de aislamiento.', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (59, 4, 3, 'Se expide el presente certificado para los fines que estime conveniente.\r\n\r\nCajamarca,06 de setiembre del 2019.', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (60, 5, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (61, 5, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (62, 5, 5, 'PROPIETARIO: CLAUDIA KATIA SIGÜENZA ALVAREZ. CON DNI N° 46538150.\r\nDirección : CRUCE CARRETERA MARGINAL DE LA SIERRA (CARRETERA SAN MARCCOS-CAJABAMBA) CON CARRETERA A CHUQUIBAMBA LOTE N° 42 SECTOR POMABAMBA ,DISTRITO DE CONDEBAMBA, PROVINCIA DE CAJABAMBA, DEPARTAMENTO DE CAJAMARCA.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (63, 5, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (64, 5, 20, 'ESPECIFICACIONES\r\nTANQUE 01', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (65, 5, 6, 'DIESEL B5 S-50.', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (66, 5, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (67, 5, 8, '9.000 Galones.', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (68, 5, 9, 'Acero ASTM A-36 de 1/4” de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (69, 5, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME secciónIX', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (70, 5, 11, 'Setiembre del 2019.', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (71, 5, 13, 'L=11.20 Mts. // D= 2.00 Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (72, 5, 14, 'Zincromato epoxico // Coaltar C200 color negro.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (73, 5, 15, 'Medición 2\" \r\nDescarga 4\"\r\nVenteo 2\" \r\nSucción 4\"\r\nManhole 60 Cm.', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (74, 5, 16, 'Neumática 15 libras por pulgada cuadrada.', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (75, 5, 17, '12 horas', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (76, 5, 18, '05-TK-PJC-2019.', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (77, 5, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\nCajamarca, Setiembre del 2019.', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (78, 6, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (79, 6, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (80, 6, 5, 'PROPIETARIO: CLAUDIA KATIA SIGÜENZA ALVAREZ. CON DNI N° 46538150.\r\nDirección : CRUCE CARRETERA MARGINAL DE LA SIERRA (CARRETERA SAN MARCOS-CAJABAMBA) CON CARRETERA A CHUQUIBAMBA LOTE N° 42 SECTOR POMABAMBA ,DISTRITO DE CONDEBAMBA, PROVINCIA DE CAJABAMBA, DEPARTAMENTO DE CAJAMARCA.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (81, 6, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (82, 6, 20, 'ESPECIFICACIONES\r\nTANQUE 02', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (83, 6, 6, 'DIESEL B5 S-50.', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (84, 6, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (85, 6, 8, '6,500 Galones.', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (86, 6, 9, 'Acero ASTM A-36 de 1/4” de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (87, 6, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME secciónIX.', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (88, 6, 11, 'Setiembre del 2019.', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (89, 6, 13, 'L=6.14 Mts. // D= 2.30 Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (90, 6, 14, 'Zincromato epoxico // Coaltar C200 color plomo.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (91, 6, 15, 'Medición 2\" \r\n Descarga 4\" \r\nVenteo 2\"\r\nSucción 4\"\r\nManhole 60 Cm.', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (92, 6, 16, 'Neumática 15 libras por pulgada cuadrada.', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (93, 6, 17, '12 horas.', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (94, 6, 18, '06-TK-PJC-2019.', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (95, 6, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\nCajamarca, Setiembre del 2019.', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (96, 7, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (97, 7, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (98, 7, 5, 'PROPIETARIO: CLAUDIA KATIA SIGÜENZA ALVAREZ. CON DNI N° 46538150.\r\nDirección : CRUCE CARRETERA MARGINAL DE LA SIERRA (CARRETERA SAN MARCOS-CAJABAMBA) CON CARRETERA A CHUQUIBAMBA LOTE N° 42 SECTOR POMABAMBA, DISTRITO DE CONDEBAMBA, PROVINCIA DE CAJABAMBA, DEPARTAMENTO DE CAJAMARCA.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (99, 7, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (100, 7, 20, 'ESPECIFICACIONES\r\nTANQUE 03', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (101, 7, 6, 'DIESEL B5 S-50.', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (102, 7, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (103, 7, 8, '4,500 Galones.', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (104, 7, 9, 'Acero ASTM A-36 de 1/4” de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (105, 7, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME secciónIX', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (106, 7, 11, 'Setiembre del 2019.', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (107, 7, 13, 'L=6.02 Mts. // D= 2.00 Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (108, 7, 14, 'Zincromato epoxico // Coaltar C200 color plomo.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (109, 7, 15, ' Medición 2\" \r\n Descarga 4\" \r\nVenteo 2\"\r\nSucción 4\"\r\nManhole 60 Cm.\r\n', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (110, 7, 16, 'Neumática 15 libras por pulgada cuadrada', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (111, 7, 17, '12 horas', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (112, 7, 18, '07-TK-PJC-2019.', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (113, 7, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\nCajamarca, Setiembre del 2019.', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (114, 8, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (115, 8, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (116, 8, 5, 'PROPIETARIO: CLAUDIA KATIA SIGÜENZA ALVAREZ. CON DNI N° 46538150.\r\nDirección :CRUCE CARRETERA MARGINAL DE LA SIERRA (CARRETERA SAN MARCOS-CAJABAMBA) CON CARRETERA A CHUQUIBAMBA LOTE N° 42 SECTOR POMABAMBA, DISTRITO DE CONDEBAMBA, PROVINCIA DE CAJABAMBA, DEPARTAMENTO DE CAJAMARCA.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (117, 8, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (118, 8, 20, 'ESPECIFICACIONES\r\nTANQUE 04', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (119, 8, 6, ' GASOHOL 90 PLUS.', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (120, 8, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (121, 8, 8, '3,000 Galones.', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (122, 8, 9, 'Acero ASTM A-36 de 3/16” de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (123, 8, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME secciónIX', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (124, 8, 11, 'Setiembre del 2019.', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (125, 8, 13, ' L=5.00 Mts. // D= 1.90 Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (126, 8, 14, ' Zincromato epoxico // Coaltar C200 color plomo.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (127, 8, 15, ' Medición 2\" \r\n Descarga 4\" \r\nVenteo 2\"\r\nSucción 4\"\r\nManhole 60 Cm.\r\n', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (128, 8, 16, 'Neumática 15 libras por pulgada cuadrada', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (129, 8, 17, '12 horas', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (130, 8, 18, '08-TK-PJC-2019.', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (131, 8, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\nCajamarca, Setiembre del 2019.', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (132, 9, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (133, 9, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (134, 9, 5, 'PROPIETARIO: CLAUDIA KATIA SIGÜENZA ALVAREZ. CON DNI N° 46538150.\r\nDirección : CRUCE CARRETERA MARGINAL DE LA SIERRA (CARRETERA SAN MARCOS-CAJABAMBA) CON CARRETERA A CHUQUIBAMBA LOTE N° 42 SECTOR POMABAMBA, DISTRITO DE CONDEBAMBA, PROVINCIA DE CAJABAMBA, DEPARTAMENTO DE CAJAMARCA.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (135, 9, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (136, 9, 20, 'ESPECIFICACIONES\r\nTANQUE 05', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (137, 9, 6, ' GASOHOL 90 PLUS.', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (138, 9, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (139, 9, 8, '3,000 Galones.', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (140, 9, 9, 'Acero ASTM A-36 de 3/16” de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (141, 9, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME secciónIX', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (142, 9, 11, 'Setiembre del 2019.', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (143, 9, 13, ' L=4.80 Mts. // D= 1.90 Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (144, 9, 14, 'Zincromato epoxico // Coaltar C200 color plomo.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (145, 9, 15, 'Medición 2\" \r\n Descarga 4\" \r\nVenteo 2\"\r\nSucción 4\"\r\nManhole 60 Cm.\r\n', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (146, 9, 16, 'Neumática 15 libras por pulgada cuadrada', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (147, 9, 17, '12 horas', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (148, 9, 18, '09-TK-PJC-2019.', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (149, 9, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\nCajamarca, Setiembre del 2019.', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (150, 10, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (151, 10, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (152, 10, 5, 'PROPIETARIO: CLAUDIA KATIA SIGÜENZA ALVAREZ. CON DNI N° 46538150.\r\nDirección : CRUCE CARRETERA MARGINAL DE LA SIERRA (CARRETERA SAN MARCOS-CAJABAMBA) CON CARRETERA A CHUQUIBAMBA LOTE N° 42 SECTOR POMABAMBA, DISTRITO DE CONDEBAMBA, PROVINCIA DE CAJABAMBA, DEPARTAMENTO DE CAJAMARCA.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (153, 10, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (154, 10, 20, 'ESPECIFICACIONES\r\nTANQUE 06', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (155, 10, 6, 'GASOHOL 84 PLUS ', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (156, 10, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (157, 10, 8, '3,000 Galones.', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (158, 10, 9, 'Acero ASTM A-36 de 3/16” de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (159, 10, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME secciónIX', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (160, 10, 11, 'Setiembre del 2019.', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (161, 10, 13, ' L=4.83 Mts. // D= 1.90 Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (162, 10, 14, 'Zincromato epoxico // Coaltar C200 color plomo.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (163, 10, 15, ' Medición 2\" \r\n Descarga 4\" \r\nVenteo 2\"\r\nSucción 4\"\r\nManhole 60 Cm.\r\n', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (164, 10, 16, 'Neumática 15 libras por pulgada cuadrada', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (165, 10, 17, '12 horas', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (166, 10, 18, '10-TK-PJC-2019', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (167, 10, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\nCajamarca, Setiembre del 2019.', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (168, 11, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (169, 11, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (170, 11, 5, 'PROPIETARIO: CLAUDIA KATIA SIGÜENZA ALVAREZ. CON DNI N° 46538150.\r\nDirección : CRUCE CARRETERA MARGINAL DE LA SIERRA (CARRETERA SAN MARCOS-CAJABAMBA) CON CARRETERA A CHUQUIBAMBA LOTE N° 42 SECTOR POMABAMBA, DISTRITO DE CONDEBAMBA, PROVINCIA DE CAJABAMBA, DEPARTAMENTO DE CAJAMARCA.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (171, 11, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (172, 11, 20, 'ESPECIFICACIONES\r\nTANQUE 07', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (173, 11, 6, 'GASOHOL 95 PLUS.', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (174, 11, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (175, 11, 8, '3,000 Galones.', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (176, 11, 9, 'Acero ASTM A-36 de 3/16” de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (177, 11, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME secciónIX', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (178, 11, 11, 'Setiembre del 2019.', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (179, 11, 13, ' L=4.83 Mts. // D= 1.90 Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (180, 11, 14, ' Zincromato epoxico // Coaltar C200 color plomo.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (181, 11, 15, ' Medición 2\" \r\n Descarga 4\" \r\nVenteo 2\"\r\nSucción 4\"\r\nManhole 60 Cm.\r\n', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (182, 11, 16, 'Neumática 15 libras por pulgada cuadrada', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (183, 11, 17, '12 horas', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (184, 11, 18, '11-TK-PJC-2019.', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (185, 11, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\nCajamarca, Setiembre del 2019.', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (186, 12, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (187, 12, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (188, 12, 5, 'PROPIETARIO: TRANSPORTES ACUARIO S.A.C. CON RUC N° 20453556086. \r\nDirección : U. C.  N° 55725 PREDIO RUSTICO SUNCHUBAMBA SECTOR SUNCHUBAMBA CASERÍO HUACARIZ DISTRITO DE CAJAMARCA. PROVINCIA DE CAJAMARCA. DEPARTAMENTO DE CAJAMARCA.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (189, 12, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (190, 12, 20, 'ESPECIFICACIONES\r\nTANQUE 01', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (191, 12, 6, 'DIESEL B5 S-50.', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (192, 12, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (193, 12, 8, '10,000 Galones.', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (194, 12, 9, 'Acero ASTM  A-36 de 1/4\" de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (195, 12, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME sección IX.', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (196, 12, 11, 'Noviembre del 2019.', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (197, 12, 13, 'L= 9.20 Mts.  // D= 2.30 Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (198, 12, 14, 'Zincromato epoxico // Coaltar C200 color negro', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (199, 12, 15, 'Medición y tele medición 2\"\r\nDescarga 4\"\r\nVenteo 2\"\r\nSucción 4\"\r\nManhole 60 Cm.', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (200, 12, 16, 'Neumática 15 libras por pulgada cuadrada', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (201, 12, 17, '12 horas', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (202, 12, 18, '12-TK-PJC-2019', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (203, 12, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\nCajamarca, Noviembre del 2019.', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (204, 13, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (205, 13, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (206, 13, 5, 'PROPIETARIO:TRANSPORTES ACUARIO S.A.C. CON RUC N° 20453556086.\r\nDirección : U. C.  N° 55725 PREDIO RUSTICO SUNCHUBAMBA SECTOR SUNCHUBAMBA CASERÍO HUACARIZ DISTRITO DE CAJAMARCA. PROVINCIA DE CAJAMARCA. DEPARTAMENTO DE CAJAMARCA.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (207, 13, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (208, 13, 20, 'ESPECIFICACIONES\r\nTANQUE 02 \r\nCOMPARTIMIENTOS  01 // 02', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (209, 13, 6, 'GASOHOL 84 PLUS - GASOHOL 90 PLUS.', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (210, 13, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (211, 13, 8, '5,000 Galones // 5,000 Galones = 10,000 Galones.', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (212, 13, 9, 'Acero ASTM A-36 de 1/4\" de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (213, 13, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME secciónIX', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (214, 13, 11, 'Noviembre del 2019.', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (215, 13, 13, 'L= 4.60 Mts.  / L= 4.60 Mts. // LT. 9.20  Mts.  D= 2.30 Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (216, 13, 14, 'Zincromato epoxico // Coaltar C200 color negro.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (217, 13, 15, 'Medición y tele medición 2\"\r\nDescarga 4\"\r\nVenteo 2\"\r\nSucción 4\"\r\nManhole 60 Cm.\r\n', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (218, 13, 16, 'Neumática 15 libras por pulgada cuadrada', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (219, 13, 17, '12 horas', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (220, 13, 18, '13-TK-PJC-2019. // 14-TK-PJC-2019.', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (221, 13, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\nCajamarca, noviembre del 2019.\r\n', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (222, 14, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (223, 14, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (224, 14, 5, 'PROPIETARIO:TRANSPORTES ACUARIO S.A.C. CON RUC N° 20453556086.\r\nDirección :U. C.  N° 55725 PREDIO RUSTICO SUNCHUBAMBA SECTOR SUNCHUBAMBA CASERÍO HUACARIZ DISTRITO DE CAJAMARCA. PROVINCIA DE CAJAMARCA. DEPARTAMENTO DE CAJAMARCA.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (225, 14, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (226, 14, 20, 'ESPECIFICACIONES\r\nTANQUE 03\r\nCOMPARTIMIENTOS  01// 02 // 03', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (227, 14, 6, 'DIESEL B5 S-50. // GASOHOL 98 PLUS // GASOHOL 95 PLUS.', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (228, 14, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (229, 14, 8, '2,500 Galones // 2,500 Galones // 5,000 Galones.', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (230, 14, 9, 'Acero ASTM A-36 de 1/4\" de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (231, 14, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME secciónIX', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (232, 14, 11, 'Noviembre del 2019.', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (233, 14, 13, 'L= 2.30 Mts.  // L= 2.30 Mts.// L= 4.60 Mts.  // LT. 9.20 Mts    D= 2.30 Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (234, 14, 14, 'Zincromato epoxico // Coaltar C200 color negro.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (235, 14, 15, 'Medición y tele medición 2\"\r\nDescarga 4\"\r\nVenteo 2\"\r\nSucción 4\"\r\nManhole 60 Cm.\r\n', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (236, 14, 16, 'Neumática 15 libras por pulgada cuadrada.', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (237, 14, 17, '12 horas.', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (238, 14, 18, '15-TK-PJC-2019 // 16-TK-PJC-2019 // 17-TK-PJC-2019.', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (239, 14, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\nCajamarca, noviembre del 2019.', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (240, 15, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (241, 15, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (242, 15, 5, 'PROPIETARIO: ASOCIACION DE TRANSPORTISTAS LA PAZ CAJAMARCA. CON RUC N° 20605528709. \r\nDirección : AV. LA PAZ  S/N CUADRA 20 EN EL   DISTRITO  DE CAJAMARCA, PROVINCIA DE CAJAMARCA, DEPARTAMENTO DE CAJAMARCA.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (243, 15, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (244, 15, 20, 'ESPECIFICACIONES\r\nTANQUE  01 \r\nCOMPARTIMIENTO 01', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (245, 15, 6, 'GASOHOL 90 PLUS', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (246, 15, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (247, 15, 8, '4,000 Galones', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (248, 15, 9, 'Acero ASTM A-36 de 1/4\" de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (249, 15, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME secciónIX', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (250, 15, 11, 'Diciembre del 2019.', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (251, 15, 13, 'L= 3.80 Mts. //  D= 2.30 Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (252, 15, 14, 'Zincromato epoxico // Coaltar C200 color negro.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (253, 15, 15, 'Medición y tele medición 2\"\r\n Descarga 4\"\r\n Venteo 2\" \r\nSucción 4\" \r\nManhole 60 Cm.\r\n', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (254, 15, 16, 'Neumática 15 libras por pulgada cuadrada', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (255, 15, 17, '12 horas', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (256, 15, 18, '16-TK-PJC-2019.', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (257, 15, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\nCajamarca, diciembre del 2019.', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (258, 16, 12, 'CONTRATO DE XXXXX POR XXXXXX', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (259, 16, 23, 'CONSTE POR EL PRESENTE DOCUMENTO EL CONTRATO PRIVADO DE LOCACIÓN POR LA FABRICACION DE DOS TECHOS DE PROYECCION CANOPY DE LAS SIGUIENTES MEDIDAS TECHO 01 06 METROS DE LARGO, 19 DE ANCHO Y 07 METROS DE ALTURA; TECHO 02 17 METROS DE LARGO, 19 METROS DE ANCHO Y 05,80 METROS DE ALTO , QUE CELEBRA DE UNA PARTE LA SEÑORA , BERTHA PADILLA GONZALES.IDENTIFICADO CON DNI N° 26624911, DE NACIONALIDAD PERUANA, CON DOMICILIO EN CARRETERA JAEN-SAN IGNACIO KM. 26+401 SECTOR YANUYACU DEL DISTRITO Y PROVINCIA DE JAEN  DEPARTAMENTO DE CAJAMARCA, A QUIEN EN ADELANTE SE LE DENOMINARA EL COMITENTE; Y, DE LA OTRA PARTE LA EMPRESA DENOMINADA PETROLMECANICA JC S.A.C, CON RUC N° 20602440908, CON DOMICILIO EN EL PJ. LA AMISTAD N° 145, BAR. MOLLEPAMPA, DEL DISTRITO, PROVINCIA Y DEPARTAMENTO DE CAJAMARCA, DEBIDAMENTE REPRESENTADO POR SU GERENTE GENERAL EL SEÑOR YOBER EDINSON JIMENEZ GUEVARA, IDENTIFICADO CON DNI N° 46563140, DE NACIONALIDAD PERUANA, MAYOR DE EDAD, CON DOMICILIO EN LA CALLE SAN FRANCISCO N° 435, DISTRITO Y PROVINCIA DE JAÉN, DEL DEPARTAMENTO DE CAJAMARCA, CON PODERES DEBIDAMENTE INSCRITOS EN LA PARTIDA ELECTRÓNICA N° 11169531, DEL REGISTRO DE PERSONAS JURÍDICAS DE LA OFICINA REGISTRAL DE CAJAMARCA, A QUIEN EN ADELANTE SE LE DENOMINARÁ EL LOCADOR, EN LOS TÉRMINOS Y CONDICIONES SIGUIENTES EN LOS TÉRMINOS Y CONDICIONES SIGUIENTES: ', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (260, 16, 22, 'PRIMERA: \r\nEL LOCADOR, ES UNA PERSONA JURÍDICA DEDICADA A LA ELABORACIÓN DE INFORMES TÉCNICOS, INSTALACIÓN Y PUESTA EN MARCHA DE ESTACIÓN DE SERVICIOS PARA LA VENTA COMBUSTIBLES LÍQUIDOS Y GLP, FABRICACION DE TANQUES ESTACIONARIOS DE ALMACENAMIENTO DE COMBUSTIBLE LIQUIDO Y ESTRUCTURAS METALICAS EN GENERAL. \r\nLOS COMITENTES, SON PERSONAS NATURALES DEDICADAS A LA COMPRA Y VENTA, DISTRIBUCIÓN, REPRESENTACIÓN Y COMERCIALIZACIÓN AL POR MAYOR Y MENOR DE COMBUSTIBLES, TALES COMO PETRÓLEO, GASOLINA, Y LUBRICANTES EN GENERAL Y OTROS PRODUCTOS AFINES, ASÍ COMO AL TRANSPORTE DE COMBUSTIBLE. ', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (261, 17, 12, 'CONTRATO DE XXXXX POR XXXXXXss', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (262, 17, 23, 'CONSTE POR EL PRESENTE DOCUMENTO EL CONTRATO PRIVADO DE LOCACIÓN POR LA FABRICACION DE DOS TECHOS DE PROYECCION CANOPY DE LAS SIGUIENTES MEDIDAS TECHO 01 06 METROS DE LARGO, 19 DE ANCHO Y 07 METROS DE ALTURA; TECHO 02 17 METROS DE LARGO, 19 METROS DE ANCHO Y 05,80 METROS DE ALTO , QUE CELEBRA DE UNA PARTE LA SEÑORA , BERTHA PADILLA GONZALES.IDENTIFICADO CON DNI N° 26624911, DE NACIONALIDAD PERUANA, CON DOMICILIO EN CARRETERA JAEN-SAN IGNACIO KM. 26+401 SECTOR YANUYACU DEL DISTRITO Y PROVINCIA DE JAEN  DEPARTAMENTO DE CAJAMARCA, A QUIEN EN ADELANTE SE LE DENOMINARA EL COMITENTE; Y, DE LA OTRA PARTE LA EMPRESA DENOMINADA PETROLMECANICA JC S.A.C, CON RUC N° 20602440908, CON DOMICILIO EN EL PJ. LA AMISTAD N° 145, BAR. MOLLEPAMPA, DEL DISTRITO, PROVINCIA Y DEPARTAMENTO DE CAJAMARCA, DEBIDAMENTE REPRESENTADO POR SU GERENTE GENERAL EL SEÑOR YOBER EDINSON JIMENEZ GUEVARA, IDENTIFICADO CON DNI N° 46563140, DE NACIONALIDAD PERUANA, MAYOR DE EDAD, CON DOMICILIO EN LA CALLE SAN FRANCISCO N° 435, DISTRITO Y PROVINCIA DE JAÉN, DEL DEPARTAMENTO DE CAJAMARCA, CON PODERES DEBIDAMENTE INSCRITOS EN LA PARTIDA ELECTRÓNICA N° 11169531, DEL REGISTRO DE PERSONAS JURÍDICAS DE LA OFICINA REGISTRAL DE CAJAMARCA, A QUIEN EN ADELANTE SE LE DENOMINARÁ EL LOCADOR, EN LOS TÉRMINOS Y CONDICIONES SIGUIENTES EN LOS TÉRMINOS Y CONDICIONES SIGUIENTES: ', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (263, 17, 22, 'PRIMERA: \r\nEL LOCADOR, ES UNA PERSONA JURÍDICA DEDICADA A LA ELABORACIÓN DE INFORMES TÉCNICOS, INSTALACIÓN Y PUESTA EN MARCHA DE ESTACIÓN DE SERVICIOS PARA LA VENTA COMBUSTIBLES LÍQUIDOS Y GLP, FABRICACION DE TANQUES ESTACIONARIOS DE ALMACENAMIENTO DE COMBUSTIBLE LIQUIDO Y ESTRUCTURAS METALICAS EN GENERAL. \r\nLOS COMITENTES, SON PERSONAS NATURALES DEDICADAS A LA COMPRA Y VENTA, DISTRIBUCIÓN, REPRESENTACIÓN Y COMERCIALIZACIÓN AL POR MAYOR Y MENOR DE COMBUSTIBLES, TALES COMO PETRÓLEO, GASOLINA, Y LUBRICANTES EN GENERAL Y OTROS PRODUCTOS AFINES, ASÍ COMO AL TRANSPORTE DE COMBUSTIBLE. ', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (264, 18, 12, 'CONTRATO DE XXXXX POR XXXXXX', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (265, 18, 23, 'CONSTE POR EL PRESENTE DOCUMENTO EL CONTRATO PRIVADO DE LOCACIÓN POR LA FABRICACION DE DOS TECHOS DE PROYECCION CANOPY DE LAS SIGUIENTES MEDIDAS TECHO 01 06 METROS DE LARGO, 19 DE ANCHO Y 07 METROS DE ALTURA; TECHO 02 17 METROS DE LARGO, 19 METROS DE ANCHO Y 05,80 METROS DE ALTO , QUE CELEBRA DE UNA PARTE LA SEÑORA , BERTHA PADILLA GONZALES.IDENTIFICADO CON DNI N° 26624911, DE NACIONALIDAD PERUANA, CON DOMICILIO EN CARRETERA JAEN-SAN IGNACIO KM. 26+401 SECTOR YANUYACU DEL DISTRITO Y PROVINCIA DE JAEN  DEPARTAMENTO DE CAJAMARCA, A QUIEN EN ADELANTE SE LE DENOMINARA EL COMITENTE; Y, DE LA OTRA PARTE LA EMPRESA DENOMINADA PETROLMECANICA JC S.A.C, CON RUC N° 20602440908, CON DOMICILIO EN EL PJ. LA AMISTAD N° 145, BAR. MOLLEPAMPA, DEL DISTRITO, PROVINCIA Y DEPARTAMENTO DE CAJAMARCA, DEBIDAMENTE REPRESENTADO POR SU GERENTE GENERAL EL SEÑOR YOBER EDINSON JIMENEZ GUEVARA, IDENTIFICADO CON DNI N° 46563140, DE NACIONALIDAD PERUANA, MAYOR DE EDAD, CON DOMICILIO EN LA CALLE SAN FRANCISCO N° 435, DISTRITO Y PROVINCIA DE JAÉN, DEL DEPARTAMENTO DE CAJAMARCA, CON PODERES DEBIDAMENTE INSCRITOS EN LA PARTIDA ELECTRÓNICA N° 11169531, DEL REGISTRO DE PERSONAS JURÍDICAS DE LA OFICINA REGISTRAL DE CAJAMARCA, A QUIEN EN ADELANTE SE LE DENOMINARÁ EL LOCADOR, EN LOS TÉRMINOS Y CONDICIONES SIGUIENTES EN LOS TÉRMINOS Y CONDICIONES SIGUIENTES: ', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (266, 18, 22, 'PRIMERA: \r\nEL LOCADOR, ES UNA PERSONA JURÍDICA DEDICADA A LA ELABORACIÓN DE INFORMES TÉCNICOS, INSTALACIÓN Y PUESTA EN MARCHA DE ESTACIÓN DE SERVICIOS PARA LA VENTA COMBUSTIBLES LÍQUIDOS Y GLP, FABRICACION DE TANQUES ESTACIONARIOS DE ALMACENAMIENTO DE COMBUSTIBLE LIQUIDO Y ESTRUCTURAS METALICAS EN GENERAL. \r\nLOS COMITENTES, SON PERSONAS NATURALES DEDICADAS A LA COMPRA Y VENTA, DISTRIBUCIÓN, REPRESENTACIÓN Y COMERCIALIZACIÓN AL POR MAYOR Y MENOR DE COMBUSTIBLES, TALES COMO PETRÓLEO, GASOLINA, Y LUBRICANTES EN GENERAL Y OTROS PRODUCTOS AFINES, ASÍ COMO AL TRANSPORTE DE COMBUSTIBLE. ', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (267, 19, 23, 'CONSTE POR EL PRESENTE DOCUMENTO EL CONTRATO PRIVADO DE LOCACIÓN POR LA FABRICACION DE DOS TECHOS DE PROYECCION CANOPY DE LAS SIGUIENTES MEDIDAS TECHO 01 06 METROS DE LARGO, 19 DE ANCHO Y 07 METROS DE ALTURA; TECHO 02 17 METROS DE LARGO, 19 METROS DE ANCHO Y 05,80 METROS DE ALTO , QUE CELEBRA DE UNA PARTE LA SEÑORA , BERTHA PADILLA GONZALES.IDENTIFICADO CON DNI N° 26624911, DE NACIONALIDAD PERUANA, CON DOMICILIO EN CARRETERA JAEN-SAN IGNACIO KM. 26+401 SECTOR YANUYACU DEL DISTRITO Y PROVINCIA DE JAEN  DEPARTAMENTO DE CAJAMARCA, A QUIEN EN ADELANTE SE LE DENOMINARA EL COMITENTE; Y, DE LA OTRA PARTE LA EMPRESA DENOMINADA PETROLMECANICA JC S.A.C, CON RUC N° 20602440908, CON DOMICILIO EN EL PJ. LA AMISTAD N° 145, BAR. MOLLEPAMPA, DEL DISTRITO, PROVINCIA Y DEPARTAMENTO DE CAJAMARCA, DEBIDAMENTE REPRESENTADO POR SU GERENTE GENERAL EL SEÑOR YOBER EDINSON JIMENEZ GUEVARA, IDENTIFICADO CON DNI N° 46563140, DE NACIONALIDAD PERUANA, MAYOR DE EDAD, CON DOMICILIO EN LA CALLE SAN FRANCISCO N° 435, DISTRITO Y PROVINCIA DE JAÉN, DEL DEPARTAMENTO DE CAJAMARCA, CON PODERES DEBIDAMENTE INSCRITOS EN LA PARTIDA ELECTRÓNICA N° 11169531, DEL REGISTRO DE PERSONAS JURÍDICAS DE LA OFICINA REGISTRAL DE CAJAMARCA, A QUIEN EN ADELANTE SE LE DENOMINARÁ EL LOCADOR, EN LOS TÉRMINOS Y CONDICIONES SIGUIENTES EN LOS TÉRMINOS Y CONDICIONES SIGUIENTES: ', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (268, 19, 22, 'PRIMERA: \r\nEL LOCADOR, ES UNA PERSONA JURÍDICA DEDICADA A LA ELABORACIÓN DE INFORMES TÉCNICOS, INSTALACIÓN Y PUESTA EN MARCHA DE ESTACIÓN DE SERVICIOS PARA LA VENTA COMBUSTIBLES LÍQUIDOS Y GLP, FABRICACION DE TANQUES ESTACIONARIOS DE ALMACENAMIENTO DE COMBUSTIBLE LIQUIDO Y ESTRUCTURAS METALICAS EN GENERAL. \r\nLOS COMITENTES, SON PERSONAS NATURALES DEDICADAS A LA COMPRA Y VENTA, DISTRIBUCIÓN, REPRESENTACIÓN Y COMERCIALIZACIÓN AL POR MAYOR Y MENOR DE COMBUSTIBLES, TALES COMO PETRÓLEO, GASOLINA, Y LUBRICANTES EN GENERAL Y OTROS PRODUCTOS AFINES, ASÍ COMO AL TRANSPORTE DE COMBUSTIBLE. ', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (269, 19, 22, 'SEGUNDA: \r\nLOS COMITENTES, DESEAN CONSTRUIR Y PONER EN MARCHA UNA ESTACIÓN DE SERVICIOS PARA EL EXPENDIO DE COMBUSTIBLES LÍQUIDOS, EN EL INMUEBLE UBICADO EN CARRETERA JAEN-SAN IGNACIO KM. 26+401 SECTOR YANUYACU DEL DISTRITO Y PROVINCIA DE JAEN DEPARTAMENTO DE CAJAMARCA, DEBIDAMENTE INSCRITO EN LA PARTIDA ELECTRÓNICA N° 02167629, DEL REGISTRO DE PREDIOS DE CAJAMARCA; PARA LO CUAL PREVIAMENTE NECESITA TENER LOS EXPEDIENTES TECNICOS APROBADOS POR PARTE DE LA AUTORIDAD COMPETENTE (INFORME TECNICO FAVORABLE). ', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (270, 19, 22, 'TERCERA:\r\nPOR EL PRESENTE DOCUMENTO EL COMITENTE CONTRATAN LOS SERVICIOS DE EL LOCADOR (EMPRESA PETROLMECANICA J.C S.A.C) PARA QUE, EN ADELANTE REALISE LA FABRICACION DE DOS TECHOS DE PROYECION CANOPY.', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (271, 20, 23, 'CONSTE POR EL PRESENTE DOCUMENTO EL CONTRATO PRIVADO DE LOCACIÓN POR LA FABRICACION DE DOS TECHOS DE PROYECCION CANOPY DE LAS SIGUIENTES MEDIDAS TECHO 01 06 METROS DE LARGO, 19 DE ANCHO Y 07 METROS DE ALTURA; TECHO 02 17 METROS DE LARGO, 19 METROS DE ANCHO Y 05,80 METROS DE ALTO , QUE CELEBRA DE UNA PARTE LA SEÑORA , BERTHA PADILLA GONZALES.IDENTIFICADO CON DNI N° 26624911, DE NACIONALIDAD PERUANA, CON DOMICILIO EN CARRETERA JAEN-SAN IGNACIO KM. 26+401 SECTOR YANUYACU DEL DISTRITO Y PROVINCIA DE JAEN  DEPARTAMENTO DE CAJAMARCA, A QUIEN EN ADELANTE SE LE DENOMINARA EL COMITENTE; Y, DE LA OTRA PARTE LA EMPRESA DENOMINADA PETROLMECANICA JC S.A.C, CON RUC N° 20602440908, CON DOMICILIO EN EL PJ. LA AMISTAD N° 145, BAR. MOLLEPAMPA, DEL DISTRITO, PROVINCIA Y DEPARTAMENTO DE CAJAMARCA, DEBIDAMENTE REPRESENTADO POR SU GERENTE GENERAL EL SEÑOR YOBER EDINSON JIMENEZ GUEVARA, IDENTIFICADO CON DNI N° 46563140, DE NACIONALIDAD PERUANA, MAYOR DE EDAD, CON DOMICILIO EN LA CALLE SAN FRANCISCO N° 435, DISTRITO Y PROVINCIA DE JAÉN, DEL DEPARTAMENTO DE CAJAMARCA, CON PODERES DEBIDAMENTE INSCRITOS EN LA PARTIDA ELECTRÓNICA N° 11169531, DEL REGISTRO DE PERSONAS JURÍDICAS DE LA OFICINA REGISTRAL DE CAJAMARCA, A QUIEN EN ADELANTE SE LE DENOMINARÁ EL LOCADOR, EN LOS TÉRMINOS Y CONDICIONES SIGUIENTES EN LOS TÉRMINOS Y CONDICIONES SIGUIENTES: ', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (272, 20, 22, '<b>PRIMERA: </b>\r\nEL LOCADOR, ES UNA PERSONA JURÍDICA DEDICADA A LA ELABORACIÓN DE INFORMES TÉCNICOS, INSTALACIÓN Y PUESTA EN MARCHA DE ESTACIÓN DE SERVICIOS PARA LA VENTA COMBUSTIBLES LÍQUIDOS Y GLP, FABRICACION DE TANQUES ESTACIONARIOS DE ALMACENAMIENTO DE COMBUSTIBLE LIQUIDO Y ESTRUCTURAS METALICAS EN GENERAL. \r\nLOS COMITENTES, SON PERSONAS NATURALES DEDICADAS A LA COMPRA Y VENTA, DISTRIBUCIÓN, REPRESENTACIÓN Y COMERCIALIZACIÓN AL POR MAYOR Y MENOR DE COMBUSTIBLES, TALES COMO PETRÓLEO, GASOLINA, Y LUBRICANTES EN GENERAL Y OTROS PRODUCTOS AFINES, ASÍ COMO AL TRANSPORTE DE COMBUSTIBLE. ', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (273, 20, 24, 'SEGUNDA: \r\nLOS COMITENTES, DESEAN CONSTRUIR Y PONER EN MARCHA UNA ESTACIÓN DE SERVICIOS PARA EL EXPENDIO DE COMBUSTIBLES LÍQUIDOS, EN EL INMUEBLE UBICADO EN CARRETERA JAEN-SAN IGNACIO KM. 26+401 SECTOR YANUYACU DEL DISTRITO Y PROVINCIA DE JAEN DEPARTAMENTO DE CAJAMARCA, DEBIDAMENTE INSCRITO EN LA PARTIDA ELECTRÓNICA N° 02167629, DEL REGISTRO DE PREDIOS DE CAJAMARCA; PARA LO CUAL PREVIAMENTE NECESITA TENER LOS EXPEDIENTES TECNICOS APROBADOS POR PARTE DE LA AUTORIDAD COMPETENTE (INFORME TECNICO FAVORABLE). ', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (274, 20, 25, 'TERCERA:\r\nPOR EL PRESENTE DOCUMENTO EL COMITENTE CONTRATAN LOS SERVICIOS DE EL LOCADOR (EMPRESA PETROLMECANICA J.C S.A.C) PARA QUE, EN ADELANTE REALISE LA FABRICACION DE DOS TECHOS DE PROYECION CANOPY.', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (275, 20, 26, 'CUARTA: OBLIGACIONES DEL LOCADOR. \r\nPARA LOS EFECTOS DE LO DISPUESTO EN LA CLÁUSULA SEGUNDA Y TERCERA, EL LOCADOR ENTREGARA LO SIGUIENTE.\r\nADJUNTO.', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (276, 20, 27, 'QUINTA: \r\nAMBAS PARTES ESTABLECEN COMO PLAZO MÁXIMO LA FABRICACION DE LOS 2 TECHOS CON LAS MEDIDAS ESTIPULAS EN 50 DIAS (CINCUENTA) DÍAS QUE SE COMPUTARA A PARTIR DE LA SUSCRIPCIÓN DEL PRESENTE CONTRATO EN CORDINACION CON LOS TRABAJOS CIVILES (PARA LA COLOCACION DE LAS COLUMNAS ARMADAS DE CONCRETO)', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (277, 20, 28, 'SEXTA: RESOLUCION DEL CONTRATO \r\nSERÁ CAUSAL DE RESOLUCIÓN EL INCUMPLIMIENTO DE CUALQUIERA DE LAS OBLIGACIONES CONTRAÍDAS POR EL LOCADOR Y DE LOS PLAZOS ESTABLECIDOS EN EL PRESENTE CONTRATO, QUEDANDO EL COMITENTE FACULTADOS A INICIAR LAS ACCIONES LEGALES CORRESPONDIENTES AL RESARCIMIENTO DE LOS DAÑOS Y PERJUICIOS CAUSADOS.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (278, 20, 29, 'SÉPTIMO: \r\nEL LOCADOR DECLARA CONTAR CON LA EXPERIENCIA, CONOCIMIENTOS Y MEDIOS NECESARIOS PARA LA ELABORACIÓN DEL PROYECTO COMPROMETIÉNDOSE A CUMPLIR CON LAS OBLIGACIONES ASUMIDAS EN EL PLAZO ACORDADO BAJO LOS ESTÁNDARES DE CALIDAD ESTABLECIDOS POR NORMA PERTINENTE. ', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (279, 20, 30, 'OCTAVO: \r\nEL COMITENTE Y EL LOCADOR CONVIENEN QUE EL PRECIO TOTAL POR EL TRABAJO CONTRATADO ES LA SUMA DE S/ 110,000.00 (CIENTO DIEZ MIL Y 00/100 SOLES) EL COSTO INCLUYE TODO LO ANTES MENCIONADO EN LA CLAUSULA CUARTA Y EL PAGO DE LA GRUA PARA LEVANTAR LA ESTRUCTURA A LAS COLUMNAS DE CONCRETO ARMADO. \r\nEL MONTO ANTES INDICADOS SE CANCELARÁ DE LA SIGUIENTE MANERA: \r\n-	S/ 80,000.00 (OCHENTA MIL CON 00/100 SOLES) A LA FIRMA DEL CONTRATO. \r\n-	S/ 10,000.00 (DIEZ MIL CON 00/100 SOLES) A QUINCE DESPUES DEL INICIO DE LA OBRA. \r\n-	S/. 10,000.00 (DIEZ MIL CON 00/100 SOLES) PARA EL CIELO RAZO. ==\r\n-	S/. 1O,000.00 (ONCE MIL CON 00/100 SOLES) AL LA ENTREGA DE OBRA TERMINADA.\r\n\r\nNOTA   \r\n-	EN EL MONTO ESTIPULADO NO INCLUYE TRABAJOS CIVILES (FOSA DE TANQUES ESCABACIONES CANALES DE CONCRETO Y PICADO DE PARED======\r\n-	LOS PRECIOS INCLUYEN IGV.\r\n-	NO INCLUYEN COLUMNAS DE FIERRO LAS CUALES SERAN PUESTAS POR EL CLIENTE Y SERAN DE CONCRETO ARMADO.\r\n-	NO INCLUYE CABLEADO DE CAMARAS DE SEGURIDAD NI PARLANTES NI CABLESPARA LOS MISMOS.\r\n', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (280, 20, 32, 'TIEMPO DE ENTREGA: \r\nEL TIEMPO DE ENTREGA SERA EN ACUERDO AL AVANCE DE TRABAJOS CIVILES ESTIPULADO EN LA CLAUSULA QUINTA. ', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (281, 20, 31, 'NOVENO: DISPOSICIONES COMPLEMENTARIAS \r\nLAS PARTES CONVIENEN QUE TODO LO NO ESTIPULADO EN EL PRESENTE CONTRATO, SE REGIRÁ POR LAS NORMAS CONTENIDAS EN EL CÓDIGO CIVIL Y NORMAS PENALES VIGENTES, SOMETIÉNDOSE AMBAS PARTES A LA JURISDICCIÓN DE LOS JUECES Y SALAS ESPECIALIZADAS DE LA CIUDAD DE JAEN. ', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (282, 20, 1, 'EN SEÑAL DE CONFORMIDAD, SE SUSCRIBE EL PRESENTE DOCUMENTO, EN LA CIUDAD DE CAJAMARCA, A TREINTA DÍAS DEL MES DE MAYO DEL DOS MIL VEINTE. \r\n\r\n\r\n\r\n\r\n\r\nLOS COMITENTES                                                      EL LOCADOR', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (283, 21, 1, 'Yo, YOBER EDINSON JIMENEZ GUEVARA  , con documento de identidad N° 46563140 GERENTE GENERAL de la empresa \"PETROLMECANICA JC S.A.C.\" CON RUC N° 20602440908.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (284, 21, 12, 'CERTIFICO:', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (285, 21, 2, ' Haber realizado el mantenimiento de los tableros eléctricos. En el establecimiento comercial de la empresa ESTACION DE GASOLINA JESÚS DE NAZARETH E.I.R.L.    CON RUC N° 20491647770 ubicado en el km. 126 _c.p. san sebastián en el distrito de choropampa  en la provincia y departamento de cajamarca. Fecha de mantenimiento de los mismos   el 03 de octubre del 2020.  En el cual los interruptores termomagnéticos,contactores,fusibles,llave de fuerza y conmutador  dentro del tablero se quedan en perfecto estado.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (286, 21, 3, 'Es todo cuanto puedo certificar en honor a la verdad, puediendo el interesado hacer uso del presente documento en lo que estime conveniente.', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (287, 21, 21, 'Cajamarca, 08 de octubre del 2020.', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (288, 22, 1, 'Yo, YOBER EDINSON JIMENEZ GUEVARA , con documento de identidad N° 46563140 GERENTE\r\nGENERAL de la empresa \"PETROLMECANICA JC S.A.C.\" CON RUC N° 20602440908.\r\n', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (289, 22, 12, 'CERTIFICO:', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (290, 22, 2, ' Haber realizado el mantenimiento de los tableros eléctricos. En el establecimiento comercial de la empresa\r\nESTACION DE GASOLINA JESÚS DE NAZARETH S.R.L. CON RUC N° 20491647770 ubicado en el\r\nkm. 126 _c.p. san sebastián en el distrito de choropampa en la provincia y departamento de cajamarca.\r\nFecha de mantenimiento de los mismos el 03 de octubre del 2020. En el cual los interruptores\r\ntermomagnéticos,contactores,fusibles,llave de fuerza y conmutador dentro del tablero se quedan en\r\nperfecto estado.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (291, 22, 3, 'Es todo cuanto puedo certificar en honor a la verdad, pudiendo el interesado hacer uso del presente documento en lo que estime conveniente.', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (292, 22, 21, 'Cajamarca, 09 de octubre del 2020.', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (293, 23, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (294, 23, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (295, 23, 5, 'PROPIETARIO: BERTHA PADILLA GONZÁLEZ\r\nRUC: 10277107681\r\nDirección : CARR. JAÉN  - SAN IGNACIO KM.26+401 SECTOR YANAYACU JAEN-JAEN-CAJAMARCA.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (296, 23, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (297, 23, 20, 'ESPECIFICACIONES\r\nTANQUE:  01\r\nCOMPARTIMIENTO:  01', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (298, 23, 6, 'DIÉSEL B5 S-50.', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (299, 23, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (300, 23, 8, '10,000 GALONES', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (301, 23, 9, 'Acero ASTM A-36 de 1/4\" de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (302, 23, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME secciónIX', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (303, 23, 11, 'OCTUBRE 2020', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (304, 23, 13, 'L= 9.11 Mts. //  D= 2.30 Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (305, 23, 14, 'Zincromato epoxico // Coaltar C200 color negro.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (306, 23, 15, 'Medición y tele medición 2\".\r\nDescarga 4\".\r\nVenteo 2\" .\r\nSucción 4\" .\r\nManhole 60 Cm.', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (307, 23, 16, 'Neumática 15 libras por pulgada cuadrada', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (308, 23, 17, '12 horas', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (309, 23, 18, '18-TK-PJC-2020', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (310, 23, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\ncajamarca,octubre del 2020', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (311, 24, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (312, 24, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (313, 24, 5, 'PROPIETARIO: BERTHA PADILLA GONZÁLEZ\r\nRUC: 10277107681\r\nDIRECCIÓN : CARR. JAÉN - SAN IGNACIO KM.26+401 SECTOR YANAYACU JAEN-JAEN-CAJAMARCA.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (314, 24, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (315, 24, 20, 'ESPECIFICACIONES\r\nTANQUE:  02\r\nCOMPARTIMIENTO:  01', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (316, 24, 6, 'GASOHOL 90 PLUS', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (317, 24, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (318, 24, 8, '6,000 GALONES', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (319, 24, 9, 'Acero ASTM A-36 de 1/4\" de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (320, 24, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME secciónIX', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (321, 24, 11, 'OCTUBRE DEL 2020', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (322, 24, 13, 'L= 5.60 Mts. //  D= 2.30 Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (323, 24, 14, 'Zincromato epoxico // Coaltar C200 color negro.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (324, 24, 15, 'Medición y tele medición 2\".\r\nDescarga 4\".\r\nVenteo 2\" .\r\nSucción 4\" .\r\nManhole 60 Cm.', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (325, 24, 16, 'Neumática 15 libras por pulgada cuadrada', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (326, 24, 17, '12 horas', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (327, 24, 18, '19-TK-PJC-2020', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (328, 24, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\n\r\nCAJAMARCA, OCTUBRE DEL 2020', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (329, 25, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (330, 25, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (331, 25, 5, 'PROPIETARIO: BERTHA PADILLA GONZÁLEZ\r\nRUC: 10277107681\r\nDIRECCIÓN : CARR. JAÉN - SAN IGNACIO KM.26+401 SECTOR YANAYACU JAEN-JAEN-CAJAMARCA.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (332, 25, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (333, 25, 20, 'ESPECIFICACIONES\r\nTANQUE:  03\r\nCOMPARTIMIENTO:  01', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (334, 25, 6, 'GASOHOL 98 PLUS', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (335, 25, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (336, 25, 8, '3,000 GALONES', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (337, 25, 9, 'Acero ASTM A-36 de 1/4\" de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (338, 25, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME secciónIX', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (339, 25, 11, 'OCTUBRE DEL 2020', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (340, 25, 13, 'L= 2.87 Mts. //  D= 2.30 Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (341, 25, 14, 'Zincromato epoxico // Coaltar C200 color negro.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (342, 25, 15, 'Medición y tele medición 2\".\r\nDescarga 4\".\r\nVenteo 2\" .\r\nSucción 4\" .\r\nManhole 60 Cm.', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (343, 25, 16, 'Neumática 15 libras por pulgada cuadrada', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (344, 25, 17, '12 horas', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (345, 25, 18, '20-TK-PJC-2020', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (346, 25, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\n\r\nCAJAMARCA,OCTUBRE DEL 2020', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (347, 26, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (348, 26, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (349, 26, 5, 'PROPIETARIO: BERTHA PADILLA GONZÁLEZ\r\nRUC: 10277107681\r\nDIRECCIÓN : CARR. JAÉN - SAN IGNACIO KM.26+401 SECTOR YANAYACU JAEN-JAEN-CAJAMARCA.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (350, 26, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (351, 26, 20, 'ESPECIFICACIONES\r\nTANQUE:   04\r\nCOMPARTIMIENTOS:  01 // 02', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (352, 26, 6, 'GASOHOL 84 PLUS  //  GASOHOL 95 PLUS', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (353, 26, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (354, 26, 8, '3,000 GALONES // 3,000 GALONES', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (355, 26, 9, 'Acero ASTM A-36 de 1/4\" de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (356, 26, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME secciónIX', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (357, 26, 11, 'OCTUBRE 2020', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (358, 26, 13, 'L= 2.80 Mts. // L= 2. 76 Mts  // LT= 5.56 Mts  D= 2.30 Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (359, 26, 14, 'Zincromato epoxico // Coaltar C200 color negro.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (360, 26, 15, 'Medición y tele medición 2\".\r\nDescarga 4\".\r\nVenteo 2\" .\r\nSucción 4\" .\r\nManhole 60 Cm.', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (361, 26, 16, 'Neumática 15 libras por pulgada cuadrada', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (362, 26, 17, '12 horas', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (363, 26, 18, '21-TK-PJC-2020 // 22-TK-PJC-2020', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (364, 26, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\n\r\nCAJAMARCA,OCTUBRE DEL 2020.', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (365, 27, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (366, 27, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (367, 27, 5, 'PROPIETARIO: SEGUNDO FABIAN CASTILLO MONTOYA\r\nRUC: 10266343391\r\nDirección : CARRETERA JESUS-CAJAMARCA KM 1264+145 CASERIO LA COLPA  JESUS-CAJAMARCA-CAJAMARCA', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (368, 27, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (369, 27, 20, 'ESPECIFICACIONES\r\nTANQUE:  01\r\nCOMPARTIMIENTO :  01', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (370, 27, 6, 'GASOHOL 90 PLUS', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (371, 27, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (372, 27, 8, '6,000 GALONES', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (373, 27, 9, 'Acero ASTM A-36 de 1/4\" de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (374, 27, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME secciónIX', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (375, 27, 11, 'OCTUBRE 2020', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (376, 27, 13, 'L= 5.60 Mts. //  D= 2.30 Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (377, 27, 14, 'Zincromato epoxico // Coaltar C200 color negro.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (378, 27, 15, 'Medición y tele medición 2\".\r\nDescarga 4\".\r\nVenteo 2\" .\r\nSucción 4\" .\r\nManhole 60 Cm.', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (379, 27, 16, 'Neumática 15 libras por pulgada cuadrada', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (380, 27, 17, '12 horas', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (381, 27, 18, '23-TK-PJC-2020', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (382, 27, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\n\r\nCAJAMARCA,OCTUBRE DEL 2020', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (383, 28, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (384, 28, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (385, 28, 5, 'PROPIETARIO: SEGUNDO FABIAN CASTILLO MONTOYA\r\nRUC: 10266343391\r\nDirección : CARRETERA JESUS-CAJAMARCA KM 1264+145 CASERIO LA COLPA JESUS-CAJAMARCACAJAMARCA', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (386, 28, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (387, 28, 20, 'ESPECIFICACIONES\r\nTANQUE: 02\r\nCOMPARTIMIENTO : 01\r\n', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (388, 28, 6, 'GASOHOL 84 PLUS', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (389, 28, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (390, 28, 8, '4,000 GALONES', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (391, 28, 9, 'Acero ASTM A-36 de 1/4\" de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (392, 28, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME secciónIX', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (393, 28, 11, 'OCTUBRE DEL 2020', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (394, 28, 13, 'L= 3.82 Mts. //  D= 2.30 Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (395, 28, 14, 'Zincromato epoxico // Coaltar C200 color negro.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (396, 28, 15, 'Medición y tele medición 2\".\r\nDescarga 4\".\r\nVenteo 2\" .\r\nSucción 4\" .\r\nManhole 60 Cm.', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (397, 28, 16, 'Neumática 15 libras por pulgada cuadrada', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (398, 28, 17, '12 horas', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (399, 28, 18, '24-TK-PJC-2020', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (400, 28, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\n\r\nCAJAMARCA,OCTUBRE DEL 2020', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (401, 29, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (402, 29, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (403, 29, 5, 'PROPIETARIO: SEGUNDO FABIAN CASTILLO MONTOYA\r\nRUC: 10266343391\r\nDirección : CARRETERA JESUS CAJAMARCA KM 1264+145 CASERÍO LA COLPA JESUS CAJAMARCA CAJAMARCA', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (404, 29, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (405, 29, 20, 'ESPECIFICACIONES\r\nTANQUE: 03\r\nCOMPARTIMIENTO : 01', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (406, 29, 6, 'GASOHOL 95 PLUS', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (407, 29, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (408, 29, 8, '4,000 GALONES', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (409, 29, 9, 'Acero ASTM A-36 de 1/4\" de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (410, 29, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME secciónIX', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (411, 29, 11, 'OCTUBRE DEL 2020', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (412, 29, 13, 'L= 3.82 Mts. //  D= 2.30 Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (413, 29, 14, 'Zincromato epoxico // Coaltar C200 color negro.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (414, 29, 15, 'Medición y tele medición 2\".\r\nDescarga 4\".\r\nVenteo 2\" .\r\nSucción 4\" .\r\nManhole 60 Cm.', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (415, 29, 16, 'Neumática 15 libras por pulgada cuadrada', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (416, 29, 17, '12 horas', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (417, 29, 18, '25-TK-PJC-2020', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (418, 29, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\n\r\nCAJAMARCA,OCTUBRE DEL 2020', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (419, 30, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (420, 30, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (421, 30, 5, 'PROPIETARIO: SEGUNDO FABIAN CASTILLO MONTOYA\r\nRUC: 10266343391\r\nDirección : CARRETERA JESUS CAJAMARCA KM 1264+145 CASERÍO LA COLPA JESUS  CAJAMARCA\r\nCAJAMARCA', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (422, 30, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (423, 30, 20, 'ESPECIFICACIONES\r\nTANQUE: 04\r\nCOMPARTIMIENTO : 01', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (424, 30, 6, 'DIESEL B5 S-50.', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (425, 30, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (426, 30, 8, '8,000 GALONES', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (427, 30, 9, 'Acero ASTM A-36 de 1/4\" de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (428, 30, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME secciónIX', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (429, 30, 11, 'OCTUBRE DEL 2020', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (430, 30, 13, 'L= 7.65 Mts. //  D= 2.30 Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (431, 30, 14, 'Zincromato epoxico // Coaltar C200 color negro.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (432, 30, 15, 'Medición y tele medición 2\".\r\nDescarga 4\".\r\nVenteo 2\" .\r\nSucción 4\" .\r\nManhole 60 Cm.', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (433, 30, 16, 'Neumática 15 libras por pulgada cuadrada', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (434, 30, 17, '12 horas', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (435, 30, 18, '26_TK_PJC_2020', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (436, 30, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\n\r\nCAJAMARCA,OCTUBRE DEL 2020.', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (437, 31, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (438, 31, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (439, 31, 5, 'PROPIETARIO: RAUL LUCHO CHAVEZ ALVAREZ\r\nRUC: 10267334850\r\nDIRECCIÓN : AV. VÍA DE EVITAMIENTO NORTE N°621  CAJAMARCA  CAJAMARCA  CAJAMARCA', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (440, 31, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (441, 31, 20, 'ESPECIFICACIONES\r\nTANQUE: 01\r\nCOMPARTIMIENTO : 01\r\n', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (442, 31, 6, 'DIESEL B5 S-50.', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (443, 31, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (444, 31, 8, '7,000 GALONES', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (445, 31, 9, 'Acero ASTM A-36 de 1/4\" de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (446, 31, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME secciónIX', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (447, 31, 11, 'OCTUBRE DEL 2020', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (448, 31, 13, 'L= 6.66 Mts. //  D= 2.30 Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (449, 31, 14, 'Zincromato epoxico // Coaltar C200 color negro.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (450, 31, 15, 'Medición y tele medición 2\".\r\nDescarga 4\".\r\nVenteo 2\" .\r\nSucción 4\" .\r\nManhole 60 Cm.', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (451, 31, 16, 'Neumática 15 libras por pulgada cuadrada', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (452, 31, 17, '12 horas', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (453, 31, 18, '27_TK_PJC_2020', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (454, 31, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\n\r\nCAJAMARCA,OCTUBRE DEL 2020.', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (455, 32, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (456, 32, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (457, 32, 5, 'PROPIETARIO: RAUL LUCHO CHAVEZ ALVAREZ\r\nRUC: 10267334850\r\nDIRECCIÓN : AV. VÍA DE EVITAMIENTO NORTE N°621 CAJAMARCA CAJAMARCA CAJAMARCA', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (458, 32, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (459, 32, 20, 'ESPECIFICACIONES\r\nTANQUE: 02\r\nCOMPARTIMIENTO : 01', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (460, 32, 6, 'GASOHOL 90 PLUS', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (461, 32, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (462, 32, 8, '7,000 GALONES', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (463, 32, 9, 'Acero ASTM A-36 de 1/4\" de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (464, 32, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME secciónIX', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (465, 32, 11, 'OCTUBRE DEL 2020', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (466, 32, 13, 'L= 6.66 Mts. //  D= 2.30 Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (467, 32, 14, 'Zincromato epoxico // Coaltar C200 color negro.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (468, 32, 15, 'Medición y tele medición 2\".\r\nDescarga 4\".\r\nVenteo 2\" .\r\nSucción 4\" .\r\nManhole 60 Cm.', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (469, 32, 16, 'Neumática 15 libras por pulgada cuadrada', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (470, 32, 17, '12 horas', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (471, 32, 18, '28_TK_PJC_2020', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (472, 32, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\n\r\nCAJAMARCA,OCTUBRE DEL 2020', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (473, 33, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (474, 33, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (475, 33, 5, 'PROPIETARIO: RAUL LUCHO CHAVEZ ALVAREZ\r\nRUC: 10267334850\r\nDIRECCIÓN : AV. VÍA DE EVITAMIENTO NORTE N°621 CAJAMARCA CAJAMARCA CAJAMARCA', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (476, 33, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (477, 33, 20, 'ESPECIFICACIONES\r\nTANQUE: 03\r\nCOMPARTIMIENTO : 01 // 02 // 03', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (478, 33, 6, 'GASOHOL 84 PLUS //GASOHOL 95 PLUS // GASOHOL 97 PLUS', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (479, 33, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (480, 33, 8, '2,700 GALONES //  4,000 GALONES //  3,000 GALONES', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (481, 33, 9, 'Acero ASTM A-36 de 1/4\" de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (482, 33, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME secciónIX', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (483, 33, 11, '', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (484, 33, 13, 'L= 2.54 Mts. // L= 3.73 Mts.  //  L= 2.80 Mts. //  LT= 9.07 Mts.    D= 2.30 Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (485, 33, 14, 'Zincromato epoxico // Coaltar C200 color negro.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (486, 33, 15, 'Medición y tele medición 2\".\r\nDescarga 4\".\r\nVenteo 2\" .\r\nSucción 4\" .\r\nManhole 60 Cm.', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (487, 33, 16, 'Neumática 15 libras por pulgada cuadrada', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (488, 33, 17, '12 horas', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (489, 33, 18, '29-TK-PJC-2020 // 30-TK-PJC-2020 // 31-TK-PJC-2020', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (490, 33, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\n\r\nCAJAMARCA,OCTUBRE DEL 2020.', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (491, 34, 1, 'YYo, YOBER EDINSON JIMENEZ GUEVARA , con documento de identidad N° 46563140 GERENTE\r\nGENERAL de la empresa \"PETROLMECANICA JC S.A.C.\" CON RUC N° 20602440908.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (492, 34, 12, 'CERTIFICO:', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (493, 34, 2, ' Haber realizado el mantenimiento de los tableros eléctricos. En el establecimiento comercial de la empresa\r\nESTACION DE GASOLINA JESÚS DE NAZARETH S.R.L. CON RUC N° 20491647770 ubicado en el\r\nkm. 126 _c.p. san sebastián en el distrito de choropampa en la provincia y departamento de cajamarca.\r\nFecha de mantenimiento de los mismos el 03 de octubre del 2020. En el cual los interruptores\r\ntermomagnéticos,contactores,fusibles,llave de fuerza y conmutador dentro del tablero se quedan en\r\nperfecto estado.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (494, 34, 3, 'Es todo cuanto puedo certificar en honor a la verdad, puediendo el interesado hacer uso del presente documento en lo que estime conveniente.', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (495, 34, 21, 'Cajamarca, 09 de octubre del 2020.', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (496, 35, 1, 'Yo, YOBER EDINSON JIMENEZ GUEVARA , con documento de identidad N° 46563140 GERENTE\r\nGENERAL de la empresa \"PETROLMECANICA JC S.A.C.\" CON RUC N° 20602440908.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (497, 35, 12, 'CERTIFICO:', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (498, 35, 2, ' Haber realizado el mantenimiento de dos tableros eléctricos trifásicos general y distribución.\r\nEn el establecimiento comercial de la empresa:\r\nEMPRESA MULTISERVICIOS GENERALES DUQUE JAN EL MAGNATE E.I.R.L.. CON RUC N° 20601835089  ubicado en \r\nCARRETERA CAJAMARCA CELENDIN SECTOR CHIMCHIM CHUQUIPUQUIO  CP PUYLLUCANA  BAÑOS DEL INCA  CAJAMARCA CAJAMARCA.\r\nFecha de mantenimiento de los mismos el 05 de octubre del 2020. En el cual los interruptores\r\ntermomagnéticos, contactores, fusibles, llave de fuerza, conmutador parada de emergencia  en los tableros se quedan en perfecto estado.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (499, 35, 3, 'Es todo cuanto puedo certificar en honor a la verdad, puediendo el interesado hacer uso del presente documento en lo que estime conveniente.', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (500, 35, 21, 'Cajamarca, 14 de octubre del 2020.', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (501, 36, 1, 'Yo, YOBER EDINSON JIMENEZ GUEVARA , con documento de identidad N° 46563140 GERENTE\r\nGENERAL de la empresa \"PETROLMECANICA JC S.A.C.\" CON RUC N° 20602440908.\r\n', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (502, 36, 12, 'CERTIFICO:', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (503, 36, 2, ' Haber realizado el mantenimiento de dos tableros eléctricos trifásicos general y distribución.\r\nEn el establecimiento comercial de la empresa:\r\nSAN JUAN DE CHOTA DUQUE JAN E.I.R.L. CON RUC N°20491685434 ubicado en el\r\nKM. 2.5 CARRETERA A BAMBAMARCA CAS.SAN FRANCISCO DE ASIS CAJAMARCA  CAJAMARCA  CAJAMARCA\r\nFecha de mantenimiento de los mismos el 06 de octubre del 2020. En el cual los interruptores\r\ntermomagnéticos, contactores, fusibles, llave de fuerza, conmutador parada de emergencia en los tableros\r\nse quedan en perfecto estado.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (504, 36, 3, 'Es todo cuanto puedo certificar en honor a la verdad, puediendo el interesado hacer uso del presente documento en lo que estime conveniente.', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (505, 36, 21, 'Cajamarca, 14 de octubre del 2020.', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (506, 37, 1, 'Yo, YOBER EDINSON JIMENEZ GUEVARA , con documento de identidad N° 46563140 GERENTE\r\nGENERAL de la empresa \"PETROLMECANICA JC S.A.C.\" CON RUC N° 20602440908.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (507, 37, 12, 'CERTIFICO:', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (508, 37, 2, ' Haber realizado el mantenimiento de dos tableros eléctricos trifásicos general y distribución.\r\nEn el establecimiento comercial de la empresa:\r\nGRIFO CONTINENTAL S.A.C. CON RUC N°20453552846 ubicado en el\r\nJR.  ANGAMOS N° 1108 CAJAMARCA  CAJAMARCA  CAJAMARCA.\r\nFecha de mantenimiento de los mismos el 07 de octubre del 2020. En el cual los interruptores\r\ntermomagnéticos, contactores, fusibles, llave de fuerza, conmutador parada de emergencia en los tableros\r\nse quedan en perfecto estado.\r\n', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (509, 37, 3, 'Es todo cuanto puedo certificar en honor a la verdad, puediendo el interesado hacer uso del presente documento en lo que estime conveniente.', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (510, 37, 21, 'Cajamarca, 14 de octubre del 2020.', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (511, 38, 1, 'Yo, YOBER EDINSON JIMENEZ GUEVARA , con documento de identidad N° 46563140 GERENTE\r\nGENERAL de la empresa \"PETROLMECANICA JC S.A.C.\" CON RUC N° 20602440908.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (512, 38, 12, 'CERTIFICO:', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (513, 38, 2, ' Haber realizado el mantenimiento de dos tableros eléctricos trifásicos general y distribución.\r\nEn el establecimiento comercial de la empresa:\r\nGRIFO CONTINENTAL S.A.C. CON RUC N°20453552846 ubicado en la\r\nCARR.CIUDAD DE DIOS CAJAMARCA M5 VALLE JEQUETEPEQUE, PRED. LIMONCARRO  GUADALUPE LA LIBERTAD.\r\nFecha de mantenimiento de los mismos el 09 de octubre del 2020. En el cual los interruptores\r\ntermomagnéticos, contactores, fusibles, llave de fuerza, conmutador parada de emergencia en los tableros\r\nse quedan en perfecto estado.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (514, 38, 3, 'Es todo cuanto puedo certificar en honor a la verdad, puediendo el interesado hacer uso del presente documento en lo que estime conveniente.', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (515, 38, 21, 'Cajamarca, 14 de octubre del 2020', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (516, 39, 1, 'Yo, YOBER EDINSON JIMENEZ GUEVARA , con documento de identidad N° 46563140 GERENTE\r\nGENERAL de la empresa \"PETROLMECANICA JC S.A.C.\" CON RUC N° 20602440908.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (517, 39, 12, 'CERTIFICO:', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (518, 39, 2, ' Haber realizado el mantenimiento de dos tableros eléctricos trifásicos general y distribución.\r\nEn el establecimiento comercial de la empresa:\r\nGRIFO CONTINENTAL S.A.C. CON RUC N°20453552846 ubicado en \r\nAV. VÍA DE EVITAMIENTO NORTE S/N SECTOR 5  LA ALAMEDA 2DA ETAPA  CAJAMARCA CAJAMARCA CAJAMARCA.\r\nFecha de mantenimiento de los mismos el 10 de octubre del 2020. En el cual los interruptores\r\ntermomagnéticos, contactores, fusibles, llave de fuerza, conmutador y  parada de emergencia en los tableros\r\nse quedan en perfecto estado.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (519, 39, 3, 'Es todo cuanto puedo certificar en honor a la verdad, puediendo el interesado hacer uso del presente documento en lo que estime conveniente.', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (520, 39, 21, 'Cajamarca, 14 de octubre del 2020.', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (521, 40, 1, 'Yo, YOBER EDINSON JIMENEZ GUEVARA , con documento de identidad N° 46563140 GERENTE\r\nGENERAL de la empresa \"PETROLMECANICA JC S.A.C.\" CON RUC N° 20602440908.\r\n', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (522, 40, 12, 'CERTIFICO:', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (523, 40, 2, ' Haber realizado el mantenimiento de dos tableros eléctricos trifásicos general y distribución.\r\nEn el establecimiento comercial de la empresa:\r\nGRIFO CONTINENTAL S.A.C. CON RUC N°20453552846 ubicado en la \r\nCARR. CAJAMARCA CHILETE KM 2 SECTOR SUR  CAJAMARCA\r\nCAJAMARCA CAJAMARCA.\r\nFecha de mantenimiento de los mismos el 11 de octubre del 2020. En el cual los interruptores\r\ntermomagnéticos, contactores, fusibles, llave de fuerza, conmutador y parada de emergencia en los tableros\r\nse quedan en perfecto estado.\r\n', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (524, 40, 3, 'Es todo cuanto puedo certificar en honor a la verdad, puediendo el interesado hacer uso del presente documento en lo que estime conveniente.', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (525, 40, 21, 'Cajamarca, 14 de octubre del 2020.', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (526, 41, 1, 'Yo, YOBER EDINSON JIMENEZ GUEVARA , con documento de identidad N° 46563140 GERENTE\r\nGENERAL de la empresa \"PETROLMECANICA JC S.A.C.\" CON RUC N° 20602440908.\r\n', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (527, 41, 12, 'CERTIFICO:', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (528, 41, 2, ' Haber realizado el mantenimiento de dos tableros eléctricos trifásicos general y distribución.\r\nEn el establecimiento comercial de la empresa:\r\nEL OVALO ESTACION & SERVICIOS GENERALES S.R.L. CON RUC N°20529654546 ubicado en la\r\nAV. SAN MARTIN DE PORRES N°2475 CAJAMARCA-CAJAMARCA-CAJAMARCA.\r\nFecha de mantenimiento de los mismos el 13 de octubre del 2020. En el cual los interruptores\r\ntermomagnéticos, contactores, fusibles, llave de fuerza, conmutador y parada de emergencia en los tableros\r\nse quedan en perfecto estado.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (529, 41, 3, 'Es todo cuanto puedo certificar en honor a la verdad, puediendo el interesado hacer uso del presente documento en lo que estime conveniente.', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (530, 41, 21, 'Cajamarca, 14 de octubre del 2020.', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (531, 42, 1, 'Yo, YOBER EDINSON JIMENEZ GUEVARA , con documento de identidad N° 46563140 GERENTE\r\nGENERAL de la empresa \"PETROLMECANICA JC S.A.C.\" CON RUC N° 20602440908.\r\n', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (532, 42, 12, 'CERTIFICO:', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (533, 42, 2, ' Haber realizado el mantenimiento de dos tableros eléctricos trifásicos general y distribución.\r\nEn el establecimiento comercial de la empresa:\r\nCODELMAR S.A.C.  CON RUC N°20603594267 ubicado en la\r\nAV. VÍA DE EVITAMIENTO NORTE N° 1829 CAJAMARCA  CAJAMARCA  CAJAMARCA.\r\nFecha de mantenimiento de los mismos el 14 de octubre del 2020. En el cual los interruptores\r\ntermomagnéticos, contactores, fusibles, llave de fuerza, conmutador y parada de emergencia en los tableros\r\nse quedan en perfecto estado.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (534, 42, 3, 'Es todo cuanto puedo certificar en honor a la verdad, puediendo el interesado hacer uso del presente documento en lo que estime conveniente.', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (535, 42, 21, 'Cajamarca, 14 de octubre del 2020', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (536, 43, 1, 'Yo, YOBER EDINSON JIMENEZ GUEVARA , con documento de identidad N° 46563140 GERENTE\r\nGENERAL de la empresa \"PETROLMECANICA JC S.A.C.\" CON RUC N° 20602440908.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (537, 43, 12, 'CERTIFICO:', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (538, 43, 2, ' Haber realizado la limpieza de un tanque estacionario de almacenamiento de combustible líquido.\r\ndel las siguientes características:\r\nCAPACIDAD: 10,000 galones\r\nSERIE: n° FTS-2035-2017\r\nEn el establecimiento comercial de la empresa:\r\nINVERSIONES Y SERVICIOS LEO S.R.L.  CON RUC N°20529375663 ubicado en la\r\n CARRETERA A JAESUS  MZ A LOTE S/N  CAS. HUACARIZ  CAJAMARCA CAJAMARCA CAJAMARCA.\r\nFecha de limpieza del tanque 20 de octubre del 2020.  quedando el mismo en optimas condiciones.', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (539, 43, 3, 'Es todo cuanto puedo certificar en honor a la verdad, puediendo el interesado hacer uso del presente documento en lo que estime conveniente.', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (540, 43, 21, 'Cajamarca, 23 de octubre del 2020', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (541, 44, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (542, 44, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (543, 44, 5, 'PROPIETARIO: DIOMENEZ FERNANDEZ DIAZ\r\nRUC: 10441581977\r\nDirección : CARRETERA FERNANDO BELAUNDE TERRY Y A CALLE COMERCIO  CASERIO PUENTE TECHIN PUCARA_JAEN_CAJAMARCA', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (544, 44, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (545, 44, 20, 'ESPECIFICACIONES\r\nTANQUE: 01\r\nCOMPARTIMIENTO: 01', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (546, 44, 6, 'DIESEL B5 S-50', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (547, 44, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (548, 44, 8, '5,000 GALONES ', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (549, 44, 9, 'Acero ASTM A-36 de 1/4\" de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (550, 44, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME secciónIX', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (551, 44, 11, 'DICIEMBRE 2020', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (552, 44, 13, 'L= 5.07 Mts. //  D= 2.20 Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (553, 44, 14, 'Zincromato epoxico // Coaltar C200 color negro.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (554, 44, 15, 'Medición y tele medición 2\".\r\nDescarga 4\".\r\nVenteo 2\" .\r\nSucción 4\" .\r\nManhole 60 Cm.', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (555, 44, 16, 'Neumática 15 libras por pulgada cuadrada', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (556, 44, 17, '12 horas', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (557, 44, 18, '32-TK-PJC-2020', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (558, 44, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\n\r\n\r\nCAJAMARCA,DICIEMBRE 2010.', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (559, 45, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (560, 45, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (561, 45, 5, 'PROPIETARIO: DIOMENEZ FERNANDEZ DIAZ\r\nRUC: 10441581977\r\nDirección : CARRETERA FERNANDO BELAUNDE TERRY Y A CALLE COMERCIO CASERIO PUENTE\r\nTECHIN PUCARA_JAEN_CAJAMARCA', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (562, 45, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (563, 45, 20, 'ESPECIFICACIONES\r\nTANQUE: 02\r\nCOMPARTIMIENTO: 01\r\n', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (564, 45, 6, ' GASOHOL 90 PLUS', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (565, 45, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (566, 45, 8, '3,000 GALONES', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (567, 45, 9, 'Acero ASTM A-36 de 1/4\" de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (568, 45, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME secciónIX', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (569, 45, 11, 'DICIEMBRE 2020', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (570, 45, 13, 'L= 3.06 Mts. //  D= 2.20 Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (571, 45, 14, 'Zincromato epoxico // Coaltar C200 color negro.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (572, 45, 15, 'Medición y tele medición 2\".\r\nDescarga 4\".\r\nVenteo 2\" .\r\nSucción 4\" .\r\nManhole 60 Cm.', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (573, 45, 16, 'Neumática 15 libras por pulgada cuadrada', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (574, 45, 17, '12 horas', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (575, 45, 18, '33-TK-PJC-2020', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (576, 45, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\n\r\n\r\nCAJAMARCA,DICIEMBRE 2020', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (577, 46, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (578, 46, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (579, 46, 5, 'PROPIETARIO: DIOMENES FERNANDEZ DIAZ\r\nRUC: 10441581977\r\nDirección : CARRETERA FERNANDO BELAUNDE TERRY Y LA CALLE COMERCIO CASERIO PUENTE\r\nTECHIN PUCARA_JAEN_CAJAMARCA', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (580, 46, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (581, 46, 20, 'ESPECIFICACIONES\r\nTANQUE: 01\r\nCOMPARTIMIENTO: 01', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (582, 46, 6, ' DIESEL B5 S-50', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (583, 46, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (584, 46, 8, '5,000 GALONES', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (585, 46, 9, 'Acero ASTM A-36 de 1/4\" de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (586, 46, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME secciónIX', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (587, 46, 11, 'DICIEMBRE 2020', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (588, 46, 13, 'L= 5.07 Mts. //  D= 2.20 Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (589, 46, 14, 'Zincromato epoxico // Coaltar C200 color negro.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (590, 46, 15, 'Medición y tele medición 2\".\r\nDescarga 4\".\r\nVenteo 2\" .\r\nSucción 4\" .\r\nManhole 60 Cm.', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (591, 46, 16, 'Neumática 15 libras por pulgada cuadrada', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (592, 46, 17, '12 horas', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (593, 46, 18, '32-TK-PJC-2020', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (594, 46, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\n\r\n\r\nCAJAMARCA,DICIEMBRE 2020\r\n', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (595, 47, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (596, 47, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (597, 47, 5, 'PROPIETARIO: DIOMENES FERNANDEZ DIAZ\r\nRUC: 10441581977\r\nDirección : CARRETERA FERNANDO BELAUNDE TERRY Y LA CALLE COMERCIO CASERIO PUENTE\r\nTECHIN PUCARA_JAEN_CAJAMARCA', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (598, 47, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (599, 47, 20, 'ESPECIFICACIONES\r\nTANQUE: 02\r\nCOMPARTIMIENTO: 01', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (600, 47, 6, 'GASOHOL 84 PLUS .', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (601, 47, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (602, 47, 8, '3,000 GALONES', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (603, 47, 9, 'Acero ASTM A-36 de 1/4\" de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (604, 47, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME secciónIX', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (605, 47, 11, 'DICIEMBRE 2020', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (606, 47, 13, 'L= 3.06 Mts. //  D= 2.20  Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (607, 47, 14, 'Zincromato epoxico // Coaltar C200 color negro.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (608, 47, 15, 'Medición y tele medición 2\".\r\nDescarga 4\".\r\nVenteo 2\" .\r\nSucción 4\" .\r\nManhole 60 Cm.', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (609, 47, 16, 'Neumática 15 libras por pulgada cuadrada', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (610, 47, 17, '12 horas', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (611, 47, 18, '33-TK-PJC-2020', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (612, 47, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\n\r\n\r\nCAJAMARCA,DICIEMBRE 2020', 'Activo', 17);
INSERT INTO `detalle_documentacion` VALUES (613, 48, 1, 'Por medio del presente documento la empresa: PETROLMECANICA JC S.A.C. CON RUC N° 20602440908, Empresa dedicada al asesoramiento, elaboración y ejecución de proyectos para estación de servicios, venta de equipos industriales, instalación, mantenimiento y fabricación de tanques de combustible líquidos, GLP y estructuras metálicas en general, Certifica La Fabricación, Prueba en Maestranza y pintado del siguiente tanque de almacenamiento.', 'Activo', 0);
INSERT INTO `detalle_documentacion` VALUES (614, 48, 12, '1. DATOS GENERALES', 'Activo', 1);
INSERT INTO `detalle_documentacion` VALUES (615, 48, 5, 'PROPIETARIO: DIOMENES FERNANDEZ DIAZ\r\nRUC: 10441581977\r\nDirección : CARRETERA FERNANDO BELAUNDE TERRY Y LA CALLE COMERCIO CASERIO PUENTE\r\nTECHIN PUCARA_JAEN_CAJAMARCA', 'Activo', 2);
INSERT INTO `detalle_documentacion` VALUES (616, 48, 19, '2. DESCRIPCIÓN Y ESPECIFICACIONES DEL TANQUE', 'Activo', 3);
INSERT INTO `detalle_documentacion` VALUES (617, 48, 20, 'ESPECIFICACIONES\r\nTANQUE: 03\r\nCOMPARTIMIENTO: 01', 'Activo', 4);
INSERT INTO `detalle_documentacion` VALUES (618, 48, 6, ' GASOHOL 90 PLUS ', 'Activo', 5);
INSERT INTO `detalle_documentacion` VALUES (619, 48, 7, 'PETROLMECANICA JC S.A.C.', 'Activo', 6);
INSERT INTO `detalle_documentacion` VALUES (620, 48, 8, '2,000 GALONES', 'Activo', 7);
INSERT INTO `detalle_documentacion` VALUES (621, 48, 9, 'Acero ASTM A-36 de 1/4\" de espesor.', 'Activo', 8);
INSERT INTO `detalle_documentacion` VALUES (622, 48, 10, 'Acorde con normas API.RP-1615 UL-58 codigo ASME secciónIX', 'Activo', 9);
INSERT INTO `detalle_documentacion` VALUES (623, 48, 11, 'DICIEMBRE 2020', 'Activo', 10);
INSERT INTO `detalle_documentacion` VALUES (624, 48, 13, 'L= 3.07 Mts. //  D= 1.74 Mts.', 'Activo', 11);
INSERT INTO `detalle_documentacion` VALUES (625, 48, 14, 'Zincromato epoxico // Coaltar C200 color negro.', 'Activo', 12);
INSERT INTO `detalle_documentacion` VALUES (626, 48, 15, 'Medición y tele medición 2\".\r\nDescarga 4\".\r\nVenteo 2\" .\r\nSucción 4\" .\r\nManhole 60 Cm.', 'Activo', 13);
INSERT INTO `detalle_documentacion` VALUES (627, 48, 16, 'Neumática 15 libras por pulgada cuadrada', 'Activo', 14);
INSERT INTO `detalle_documentacion` VALUES (628, 48, 17, '12 horas', 'Activo', 15);
INSERT INTO `detalle_documentacion` VALUES (629, 48, 18, '34-TK-PJC-2020', 'Activo', 16);
INSERT INTO `detalle_documentacion` VALUES (630, 48, 3, 'Mediante la presente otorgamos el certificado de fabricación, prueba de maestranza y pintado de tanque.\r\n\r\n\r\n\r\nCAJAMARCA,DICIEMBRE 2020', 'Activo', 17);

-- ----------------------------
-- Table structure for detalle_movimiento
-- ----------------------------
DROP TABLE IF EXISTS `detalle_movimiento`;
CREATE TABLE `detalle_movimiento`  (
  `iddetalle_movimiento` int(11) NOT NULL AUTO_INCREMENT,
  `movimiento_idmovimiento` int(11) NULL DEFAULT NULL,
  `idpresentacion` int(11) NULL DEFAULT NULL,
  `cantidadxpresentacion` decimal(18, 2) NULL DEFAULT NULL,
  `precioxpresentacion` decimal(18, 2) NULL DEFAULT NULL,
  `cantidad` decimal(18, 2) NULL DEFAULT NULL,
  `subtotal` decimal(18, 2) NULL DEFAULT NULL,
  `estado` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  `tienda_idtienda` int(11) NULL DEFAULT NULL,
  `producto_idproducto` int(11) NULL DEFAULT NULL,
  `descripcion` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`iddetalle_movimiento`) USING BTREE,
  INDEX `movimiento_idmovimiento`(`movimiento_idmovimiento`) USING BTREE,
  CONSTRAINT `detalle_movimiento_ibfk_1` FOREIGN KEY (`movimiento_idmovimiento`) REFERENCES `movimiento` (`idmovimiento`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detalle_movimiento
-- ----------------------------

-- ----------------------------
-- Table structure for detalle_ordencompra
-- ----------------------------
DROP TABLE IF EXISTS `detalle_ordencompra`;
CREATE TABLE `detalle_ordencompra`  (
  `iddetalle_compra` int(11) NOT NULL AUTO_INCREMENT,
  `producto_idproducto` int(11) NULL DEFAULT NULL,
  `tienda_idtienda` int(11) NULL DEFAULT NULL,
  `cantidad` decimal(18, 2) NULL DEFAULT NULL,
  `descuento` decimal(18, 2) NULL DEFAULT NULL,
  `subtotal` decimal(18, 2) NULL DEFAULT NULL,
  `lote` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `estado` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  `compra_idcompra` int(11) NULL DEFAULT NULL,
  `descripcion` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fecha_vencimiento` date NULL DEFAULT NULL,
  `pc_actual` decimal(18, 2) NULL DEFAULT NULL,
  `pv_actual` decimal(18, 2) NULL DEFAULT NULL,
  `pc_anterior` decimal(18, 2) NULL DEFAULT NULL,
  `pv_anterior` decimal(18, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`iddetalle_compra`) USING BTREE,
  INDEX `producto_idproducto`(`producto_idproducto`) USING BTREE,
  INDEX `tienda_idtienda`(`tienda_idtienda`) USING BTREE,
  CONSTRAINT `detalle_ordencompra_ibfk_1` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `detalle_ordencompra_ibfk_2` FOREIGN KEY (`tienda_idtienda`) REFERENCES `tienda` (`idtienda`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detalle_ordencompra
-- ----------------------------

-- ----------------------------
-- Table structure for detalle_proforma
-- ----------------------------
DROP TABLE IF EXISTS `detalle_proforma`;
CREATE TABLE `detalle_proforma`  (
  `iddetalle_proforma` int(11) NOT NULL AUTO_INCREMENT,
  `proforma_idproforma` int(11) NULL DEFAULT NULL,
  `producto_idproducto` int(11) NULL DEFAULT NULL,
  `presentacion_idpresentacion` int(11) NULL DEFAULT NULL,
  `cantidadxpresentacion` decimal(18, 2) NULL DEFAULT NULL,
  `precioxpresentacion` decimal(18, 2) NULL DEFAULT NULL,
  `cantidad` decimal(18, 2) NULL DEFAULT NULL,
  `subtotal` decimal(18, 2) NULL DEFAULT NULL,
  `descuento` decimal(18, 2) NULL DEFAULT NULL,
  `estado` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  `tienda_idtienda` int(11) NULL DEFAULT NULL,
  `descripcion` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `idpresentacion` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`iddetalle_proforma`) USING BTREE,
  INDEX `proforma_idproforma`(`proforma_idproforma`) USING BTREE,
  INDEX `producto_idproducto`(`producto_idproducto`) USING BTREE,
  INDEX `presentacion_idpresentacion`(`presentacion_idpresentacion`) USING BTREE,
  CONSTRAINT `detalle_proforma_ibfk_2` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `detalle_proforma_ibfk_3` FOREIGN KEY (`presentacion_idpresentacion`) REFERENCES `presentacion` (`idpresentacion`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 296 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detalle_proforma
-- ----------------------------
INSERT INTO `detalle_proforma` VALUES (1, 1, 13, 16, 1.00, 6480.00, 3.00, 19440.00, 0.00, 'Activo', 1, 'bomba sumergible  3/4\" HP', 16);
INSERT INTO `detalle_proforma` VALUES (2, 1, 11, 16, 1.00, 7560.00, 1.00, 7560.00, 0.00, 'Activo', 1, 'bomba sumergible 1.5 HP', 16);
INSERT INTO `detalle_proforma` VALUES (3, 1, 20, 7, 1.00, 185.00, 45.00, 8325.00, 0.00, 'Activo', 1, 'tubo ac negro schedule sch-40  ASTM A53/A106 S/C 2\" x 6M  ', 7);
INSERT INTO `detalle_proforma` VALUES (4, 1, 21, 7, 1.00, 470.00, 1.00, 470.00, 0.00, 'Activo', 1, 'tubo ac negro  schedule sch-40 ASTM A53/A106 S/C 4\" x  6M  ', 7);
INSERT INTO `detalle_proforma` VALUES (5, 1, 104, 12, 1.00, 75.00, 7.00, 525.00, 0.00, 'Activo', 1, 'tubos conduit ', 12);
INSERT INTO `detalle_proforma` VALUES (6, 1, 22, 7, 1.00, 21.50, 50.00, 1075.00, 0.00, 'Activo', 1, 'codo x90° fierro negro class 150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (7, 1, 23, 7, 1.00, 21.50, 30.00, 645.00, 0.00, 'Activo', 1, 'codo x45° fierro negro class150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (8, 1, 32, 7, 1.00, 6.50, 25.00, 162.50, 0.00, 'Activo', 1, 'niple acero sch-40 2\" x 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (9, 1, 37, 7, 1.00, 10.30, 25.00, 257.50, 0.00, 'Activo', 1, 'niple acero sch-40 2\" x 6\"', 7);
INSERT INTO `detalle_proforma` VALUES (10, 1, 35, 7, 1.00, 7.60, 25.00, 190.00, 0.00, 'Activo', 1, 'niple acero sch-40 2\" x 4\"', 7);
INSERT INTO `detalle_proforma` VALUES (11, 1, 62, 7, 1.00, 230.00, 12.00, 2760.00, 0.00, 'Activo', 1, 'manguera flexible 11/2\" x 50cm ', 7);
INSERT INTO `detalle_proforma` VALUES (12, 1, 63, 7, 1.00, 250.00, 4.00, 1000.00, 0.00, 'Activo', 1, 'manguera flexible 2\" x 40 cm', 7);
INSERT INTO `detalle_proforma` VALUES (13, 1, 52, 7, 1.00, 85.00, 4.00, 340.00, 0.00, 'Activo', 1, 'adaptador c/ tapa hermetica 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (14, 1, 53, 7, 1.00, 190.00, 4.00, 760.00, 0.00, 'Activo', 1, 'adaptador c/ tapa 4\"', 7);
INSERT INTO `detalle_proforma` VALUES (15, 1, 71, 7, 1.00, 320.00, 3.00, 960.00, 0.00, 'Activo', 1, 'adaptador c/ tapa hermetica para RV 4\"', 7);
INSERT INTO `detalle_proforma` VALUES (16, 1, 70, 7, 1.00, 285.00, 3.00, 855.00, 0.00, 'Activo', 1, 'cruceta de valvula flotante 4\" x 4\" x 3\" x 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (17, 1, 55, 7, 1.00, 135.00, 1.00, 135.00, 0.00, 'Activo', 1, 'valvula de venteo diesel 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (18, 1, 56, 7, 1.00, 175.00, 3.00, 525.00, 0.00, 'Activo', 1, 'valvula de venteo gasolina (presion al vasio) 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (19, 1, 64, 7, 1.00, 160.00, 4.00, 640.00, 0.00, 'Activo', 1, 'manguera flexible 3/4\" x 50cm', 7);
INSERT INTO `detalle_proforma` VALUES (20, 1, 65, 7, 1.00, 195.00, 3.00, 585.00, 0.00, 'Activo', 1, 'manguera flexible de 1\" x 50 cm', 7);
INSERT INTO `detalle_proforma` VALUES (21, 1, 49, 7, 1.00, 80.00, 14.00, 1120.00, 0.00, 'Activo', 1, 'sello antiexplosivo conduit 3/4\"', 7);
INSERT INTO `detalle_proforma` VALUES (22, 1, 50, 7, 1.00, 95.00, 6.00, 570.00, 0.00, 'Activo', 1, 'sello antiexplosivo conduit 1\"', 7);
INSERT INTO `detalle_proforma` VALUES (23, 1, 51, 7, 1.00, 65.00, 13.00, 845.00, 0.00, 'Activo', 1, 'sello antiexplosivo conduit 1/2\"', 7);
INSERT INTO `detalle_proforma` VALUES (24, 1, 93, 12, 1.00, 285.00, 4.00, 1140.00, 0.00, 'Activo', 1, 'valvula esferica 2\" 600 wob ', 12);
INSERT INTO `detalle_proforma` VALUES (25, 1, 73, 7, 1.00, 170.00, 12.00, 2040.00, 0.00, 'Activo', 1, 'cable thw awg # 12', 7);
INSERT INTO `detalle_proforma` VALUES (26, 1, 74, 7, 1.00, 110.00, 8.00, 880.00, 0.00, 'Activo', 1, 'cable thw awg # 14', 7);
INSERT INTO `detalle_proforma` VALUES (27, 1, 75, 15, 1.00, 650.00, 2.00, 1300.00, 0.00, 'Activo', 1, 'cable ctp verde amarillo conexion tierra # 6', 15);
INSERT INTO `detalle_proforma` VALUES (28, 1, 76, 7, 1.00, 980.00, 2.00, 1960.00, 0.00, 'Activo', 1, 'cable thw awg # 4', 7);
INSERT INTO `detalle_proforma` VALUES (29, 1, 105, 12, 1.00, 600.00, 3.00, 1800.00, 0.00, 'Activo', 1, 'cable dixon cat 6 utp', 12);
INSERT INTO `detalle_proforma` VALUES (30, 1, 24, 7, 1.00, 52.00, 8.00, 416.00, 0.00, 'Activo', 1, 'union universal fierro negro class150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (31, 1, 25, 7, 1.00, 40.00, 12.00, 480.00, 0.00, 'Activo', 1, 'union universal fierro negro class150 1 1/2\"', 7);
INSERT INTO `detalle_proforma` VALUES (32, 1, 40, 7, 1.00, 14.80, 30.00, 444.00, 0.00, 'Activo', 1, 'union simple fierro negro class150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (33, 1, 96, 12, 1.00, 250.00, 11.00, 2750.00, 0.00, 'Activo', 1, 'contenedor nacional 13\" jg ', 12);
INSERT INTO `detalle_proforma` VALUES (34, 1, 39, 7, 1.00, 15.00, 8.00, 120.00, 0.00, 'Activo', 1, 'tee fierro negro cla150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (35, 1, 29, 7, 1.00, 13.50, 12.00, 162.00, 0.00, 'Activo', 1, 'reduccion bushing fierro negro class150 2\" x 1/2\"', 7);
INSERT INTO `detalle_proforma` VALUES (36, 1, 26, 7, 1.00, 19.00, 3.00, 57.00, 0.00, 'Activo', 1, 'tapon macho fierro negro class150 3\"', 7);
INSERT INTO `detalle_proforma` VALUES (37, 1, 58, 7, 1.00, 187.00, 12.00, 2244.00, 0.00, 'Activo', 1, 'valvula de emergencia 1 1/2\"', 7);
INSERT INTO `detalle_proforma` VALUES (38, 1, 77, 7, 1.00, 287.00, 21.00, 6027.00, 0.00, 'Activo', 1, 'anodo de magnesio para proteccion catodica', 7);
INSERT INTO `detalle_proforma` VALUES (39, 1, 72, 7, 1.00, 550.00, 3.00, 1650.00, 0.00, 'Activo', 1, 'varilla de cobre para poso tierra 5/8\"', 7);
INSERT INTO `detalle_proforma` VALUES (40, 1, 99, 12, 1.00, 276.00, 4.00, 1104.00, 0.00, 'Activo', 1, 'detector de fugas ', 12);
INSERT INTO `detalle_proforma` VALUES (41, 1, 60, 7, 1.00, 680.00, 3.00, 2040.00, 0.00, 'Activo', 1, 'spill container ', 7);
INSERT INTO `detalle_proforma` VALUES (42, 1, 57, 7, 1.00, 690.00, 4.00, 2760.00, 0.00, 'Activo', 1, 'valvula de sobrellenado 4\" j.s', 7);
INSERT INTO `detalle_proforma` VALUES (43, 1, 86, 7, 1.00, 3.50, 400.00, 1400.00, 0.00, 'Activo', 1, 'cinta teflon amarilla de 1/2\"', 7);
INSERT INTO `detalle_proforma` VALUES (44, 1, 101, 12, 1.00, 250.00, 4.00, 1000.00, 0.00, 'Activo', 1, 'GASOILA', 12);
INSERT INTO `detalle_proforma` VALUES (45, 1, 66, 7, 1.00, 1200.00, 1.00, 1200.00, 0.00, 'Activo', 1, 'estabilizador 110v 250v/ 5000w', 7);
INSERT INTO `detalle_proforma` VALUES (46, 1, 68, 7, 1.00, 1300.00, 1.00, 1300.00, 0.00, 'Activo', 1, 'transformador de aislamiento 5kva', 7);
INSERT INTO `detalle_proforma` VALUES (47, 1, 89, 7, 1.00, 3500.00, 1.00, 3500.00, 0.00, 'Activo', 1, 'tablero de distribución 24 polos  trifasico', 7);
INSERT INTO `detalle_proforma` VALUES (48, 1, 90, 7, 1.00, 3500.00, 1.00, 3500.00, 0.00, 'Activo', 1, 'tablero general 24 polos trifasico', 7);
INSERT INTO `detalle_proforma` VALUES (49, 1, 88, 7, 1.00, 23400.00, 3.00, 70200.00, 0.00, 'Activo', 1, 'dispensador gilbarco encore 500 s  4x8  repotenciado', 7);
INSERT INTO `detalle_proforma` VALUES (50, 1, 92, 7, 1.00, 15000.00, 1.00, 15000.00, 0.00, 'Activo', 1, 'servicio de instalaciones mecanica y electricas de grifo y estación de servicios hasta la puesta en ', 7);
INSERT INTO `detalle_proforma` VALUES (51, 2, 20, 7, 1.00, 185.00, 40.00, 7400.00, 0.00, 'Activo', 1, 'tubo ac negro schedule sch-40  ASTM A53/A106 S/C 2\" x 6M  ', 7);
INSERT INTO `detalle_proforma` VALUES (52, 2, 21, 7, 1.00, 470.00, 1.00, 470.00, 0.00, 'Activo', 1, 'tubo ac negro  schedule sch-40 ASTM A53/A106 S/C 4\" x  6M  ', 7);
INSERT INTO `detalle_proforma` VALUES (53, 2, 104, 12, 1.00, 75.00, 7.00, 525.00, 0.00, 'Activo', 1, 'tubos conduit ', 12);
INSERT INTO `detalle_proforma` VALUES (54, 2, 22, 7, 1.00, 21.50, 50.00, 1075.00, 0.00, 'Activo', 1, 'codo x90° fierro negro class 150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (55, 2, 23, 7, 1.00, 21.50, 30.00, 645.00, 0.00, 'Activo', 1, 'codo x45° fierro negro class150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (56, 2, 32, 7, 1.00, 6.50, 25.00, 162.50, 0.00, 'Activo', 1, 'niple acero sch-40 2\" x 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (57, 2, 37, 7, 1.00, 10.30, 25.00, 257.50, 0.00, 'Activo', 1, 'niple acero sch-40 2\" x 6\"', 7);
INSERT INTO `detalle_proforma` VALUES (58, 2, 35, 7, 1.00, 7.60, 25.00, 190.00, 0.00, 'Activo', 1, 'niple acero sch-40 2\" x 4\"', 7);
INSERT INTO `detalle_proforma` VALUES (59, 2, 62, 7, 1.00, 230.00, 12.00, 2760.00, 0.00, 'Activo', 1, 'manguera flexible 11/2\" x 50cm ', 7);
INSERT INTO `detalle_proforma` VALUES (60, 2, 63, 7, 1.00, 250.00, 4.00, 1000.00, 0.00, 'Activo', 1, 'manguera flexible 2\" x 40 cm', 7);
INSERT INTO `detalle_proforma` VALUES (61, 2, 52, 7, 1.00, 85.00, 4.00, 340.00, 0.00, 'Activo', 1, 'adaptador c/ tapa hermetica 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (62, 2, 53, 7, 1.00, 190.00, 4.00, 760.00, 0.00, 'Activo', 1, 'adaptador c/ tapa 4\"', 7);
INSERT INTO `detalle_proforma` VALUES (63, 2, 71, 7, 1.00, 320.00, 3.00, 960.00, 0.00, 'Activo', 1, 'adaptador c/ tapa hermetica para RV 4\"', 7);
INSERT INTO `detalle_proforma` VALUES (64, 2, 70, 7, 1.00, 285.00, 3.00, 855.00, 0.00, 'Activo', 1, 'cruceta de valvula flotante 4\" x 4\" x 3\" x 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (65, 2, 55, 7, 1.00, 135.00, 1.00, 135.00, 0.00, 'Activo', 1, 'valvula de venteo diesel 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (66, 2, 56, 7, 1.00, 175.00, 3.00, 525.00, 0.00, 'Activo', 1, 'valvula de venteo gasolina (presion al vasio) 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (67, 2, 64, 7, 1.00, 160.00, 4.00, 640.00, 0.00, 'Activo', 1, 'manguera flexible 3/4\" x 50cm', 7);
INSERT INTO `detalle_proforma` VALUES (68, 2, 65, 7, 1.00, 195.00, 3.00, 585.00, 0.00, 'Activo', 1, 'manguera flexible de 1\" x 50 cm', 7);
INSERT INTO `detalle_proforma` VALUES (69, 2, 49, 7, 1.00, 80.00, 14.00, 1120.00, 0.00, 'Activo', 1, 'sello antiexplosivo conduit 3/4\"', 7);
INSERT INTO `detalle_proforma` VALUES (70, 2, 50, 7, 1.00, 95.00, 6.00, 570.00, 0.00, 'Activo', 1, 'sello antiexplosivo conduit 1\"', 7);
INSERT INTO `detalle_proforma` VALUES (71, 2, 51, 7, 1.00, 65.00, 13.00, 845.00, 0.00, 'Activo', 1, 'sello antiexplosivo conduit 1/2\"', 7);
INSERT INTO `detalle_proforma` VALUES (72, 2, 93, 12, 1.00, 285.00, 4.00, 1140.00, 0.00, 'Activo', 1, 'valvula esferica 2\" 600 wob ', 12);
INSERT INTO `detalle_proforma` VALUES (73, 2, 73, 7, 1.00, 170.00, 12.00, 2040.00, 0.00, 'Activo', 1, 'cable thw awg # 12', 7);
INSERT INTO `detalle_proforma` VALUES (74, 2, 74, 7, 1.00, 110.00, 8.00, 880.00, 0.00, 'Activo', 1, 'cable thw awg # 14', 7);
INSERT INTO `detalle_proforma` VALUES (75, 2, 75, 15, 1.00, 650.00, 2.00, 1300.00, 0.00, 'Activo', 1, 'cable ctp verde amarillo conexion tierra # 6', 15);
INSERT INTO `detalle_proforma` VALUES (76, 2, 76, 7, 1.00, 980.00, 2.00, 1960.00, 0.00, 'Activo', 1, 'cable thw awg # 4', 7);
INSERT INTO `detalle_proforma` VALUES (77, 2, 105, 12, 1.00, 600.00, 3.00, 1800.00, 0.00, 'Activo', 1, 'cable dixon cat 6 utp', 12);
INSERT INTO `detalle_proforma` VALUES (78, 2, 24, 7, 1.00, 52.00, 8.00, 416.00, 0.00, 'Activo', 1, 'union universal fierro negro class150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (79, 2, 25, 7, 1.00, 40.00, 12.00, 480.00, 0.00, 'Activo', 1, 'union universal fierro negro class150 1 1/2\"', 7);
INSERT INTO `detalle_proforma` VALUES (80, 2, 40, 7, 1.00, 14.80, 30.00, 444.00, 0.00, 'Activo', 1, 'union simple fierro negro class150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (81, 2, 96, 12, 1.00, 250.00, 12.00, 3000.00, 0.00, 'Activo', 1, 'contenedor nacional 13\" jg ', 12);
INSERT INTO `detalle_proforma` VALUES (82, 2, 39, 7, 1.00, 15.00, 8.00, 120.00, 0.00, 'Activo', 1, 'tee fierro negro cla150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (83, 2, 29, 7, 1.00, 13.50, 12.00, 162.00, 0.00, 'Activo', 1, 'reduccion bushing fierro negro class150 2\" x 1/2\"', 7);
INSERT INTO `detalle_proforma` VALUES (84, 2, 26, 7, 1.00, 19.00, 3.00, 57.00, 0.00, 'Activo', 1, 'tapon macho fierro negro class150 3\"', 7);
INSERT INTO `detalle_proforma` VALUES (85, 2, 58, 7, 1.00, 187.00, 12.00, 2244.00, 0.00, 'Activo', 1, 'valvula de emergencia 1 1/2\"', 7);
INSERT INTO `detalle_proforma` VALUES (86, 2, 77, 7, 1.00, 287.00, 21.00, 6027.00, 0.00, 'Activo', 1, 'anodo de magnesio para proteccion catodica', 7);
INSERT INTO `detalle_proforma` VALUES (87, 2, 72, 7, 1.00, 550.00, 3.00, 1650.00, 0.00, 'Activo', 1, 'varilla de cobre para poso tierra 5/8\"', 7);
INSERT INTO `detalle_proforma` VALUES (88, 2, 99, 12, 1.00, 276.00, 4.00, 1104.00, 0.00, 'Activo', 1, 'detector de fugas ', 12);
INSERT INTO `detalle_proforma` VALUES (89, 2, 60, 7, 1.00, 680.00, 3.00, 2040.00, 0.00, 'Activo', 1, 'spill container ', 7);
INSERT INTO `detalle_proforma` VALUES (90, 2, 57, 7, 1.00, 690.00, 4.00, 2760.00, 0.00, 'Activo', 1, 'valvula de sobrellenado 4\" j.s', 7);
INSERT INTO `detalle_proforma` VALUES (91, 2, 86, 7, 1.00, 3.50, 400.00, 1400.00, 0.00, 'Activo', 1, 'cinta teflon amarilla de 1/2\"', 7);
INSERT INTO `detalle_proforma` VALUES (92, 2, 101, 12, 1.00, 250.00, 4.00, 1000.00, 0.00, 'Activo', 1, 'GASOILA', 12);
INSERT INTO `detalle_proforma` VALUES (93, 2, 89, 7, 1.00, 3750.00, 1.00, 3750.00, 0.00, 'Activo', 1, 'tablero de distribución 24 polos  trifasico', 7);
INSERT INTO `detalle_proforma` VALUES (94, 2, 90, 7, 1.00, 3750.00, 1.00, 3750.00, 0.00, 'Activo', 1, 'tablero general 24 polos trifasico', 7);
INSERT INTO `detalle_proforma` VALUES (95, 2, 92, 7, 1.00, 15000.00, 1.00, 15000.00, 0.00, 'Activo', 1, 'servicio de instalaciones mecanica y electricas de grifo y estación de servicios hasta la puesta en ', 7);
INSERT INTO `detalle_proforma` VALUES (96, 2, 94, 12, 1.00, 300.00, 1.00, 300.00, 0.00, 'Activo', 1, 'punta para rayos 3 pines ', 12);
INSERT INTO `detalle_proforma` VALUES (97, 3, 95, 9, 1.00, 2.69, 20500.00, 55145.00, 0.00, 'Activo', 1, 'tanque de almacenamiento de combustible plancha de 1/4\" de espesor 3 de 3500 galones y 1 de 10,000 galones', 9);
INSERT INTO `detalle_proforma` VALUES (98, 4, 102, 12, 1.00, 335.00, 324.00, 108540.00, 0.00, 'Activo', 1, 'TECHO DE PROYECCION CANOPY  324 m2', 12);
INSERT INTO `detalle_proforma` VALUES (99, 5, 102, 12, 1.00, 340.00, 400.00, 136000.00, 0.00, 'Activo', 1, 'TECHO DE PROYECCION CANOPY 400m2   20x20 mts', 12);
INSERT INTO `detalle_proforma` VALUES (100, 6, 107, 7, 1.00, 18000.00, 1.00, 18000.00, 0.00, 'Activo', 1, 'totem  panel de precios 2 x 9mts', 7);
INSERT INTO `detalle_proforma` VALUES (101, 7, 106, 7, 1.00, 40000.00, 1.00, 40000.00, 0.00, 'Activo', 1, 'totem led 2   panel de precios mts x 9mts ', 7);
INSERT INTO `detalle_proforma` VALUES (102, 8, 13, 16, 1.00, 6480.00, 3.00, 19440.00, 0.00, 'Activo', 1, 'bomba sumergible  3/4\" HP', 16);
INSERT INTO `detalle_proforma` VALUES (103, 8, 11, 16, 1.00, 7560.00, 1.00, 7560.00, 0.00, 'Activo', 1, 'bomba sumergible 1.5 HP', 16);
INSERT INTO `detalle_proforma` VALUES (104, 8, 20, 7, 1.00, 185.00, 43.00, 7955.00, 0.00, 'Activo', 1, 'tubo ac negro schedule sch-40  ASTM A53/A106 S/C 2\" x 6M  ', 7);
INSERT INTO `detalle_proforma` VALUES (105, 8, 21, 7, 1.00, 470.00, 2.00, 940.00, 0.00, 'Activo', 1, 'tubo ac negro  schedule sch-40 ASTM A53/A106 S/C 4\" x  6M  ', 7);
INSERT INTO `detalle_proforma` VALUES (106, 8, 104, 12, 1.00, 75.00, 7.00, 525.00, 0.00, 'Activo', 1, 'tubos conduit ', 12);
INSERT INTO `detalle_proforma` VALUES (107, 8, 22, 7, 1.00, 21.50, 50.00, 1075.00, 0.00, 'Activo', 1, 'codo x90° fierro negro class 150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (108, 8, 23, 7, 1.00, 21.50, 1.00, 21.50, 0.00, 'Activo', 1, 'codo x45° fierro negro class150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (109, 8, 32, 7, 1.00, 6.50, 25.00, 162.50, 0.00, 'Activo', 1, 'niple acero sch-40 2\" x 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (110, 8, 33, 7, 1.00, 7.20, 10.00, 72.00, 0.00, 'Activo', 1, 'niple acero sch-40 2\" x 3\"', 7);
INSERT INTO `detalle_proforma` VALUES (111, 8, 35, 7, 1.00, 7.60, 15.00, 114.00, 0.00, 'Activo', 1, 'niple acero sch-40 2\" x 4\"', 7);
INSERT INTO `detalle_proforma` VALUES (112, 8, 37, 7, 1.00, 10.30, 20.00, 206.00, 0.00, 'Activo', 1, 'niple acero sch-40 2\" x 6\"', 7);
INSERT INTO `detalle_proforma` VALUES (113, 8, 62, 7, 1.00, 230.00, 8.00, 1840.00, 0.00, 'Activo', 1, 'manguera flexible 11/2\" x 50cm ', 7);
INSERT INTO `detalle_proforma` VALUES (114, 8, 63, 7, 1.00, 250.00, 4.00, 1000.00, 0.00, 'Activo', 1, 'manguera flexible 2\" x 40 cm', 7);
INSERT INTO `detalle_proforma` VALUES (115, 8, 52, 7, 1.00, 85.00, 4.00, 340.00, 0.00, 'Activo', 1, 'adaptador c/ tapa hermetica 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (116, 8, 53, 7, 1.00, 190.00, 4.00, 760.00, 0.00, 'Activo', 1, 'adaptador c/ tapa 4\"', 7);
INSERT INTO `detalle_proforma` VALUES (117, 8, 71, 7, 1.00, 300.00, 3.00, 900.00, 0.00, 'Activo', 1, 'adaptador c/ tapa hermetica para RV 4\"', 7);
INSERT INTO `detalle_proforma` VALUES (118, 8, 70, 7, 1.00, 279.00, 3.00, 837.00, 0.00, 'Activo', 1, 'cruceta de valvula flotante 4\" x 4\" x 3\" x 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (119, 8, 55, 7, 1.00, 135.00, 1.00, 135.00, 0.00, 'Activo', 1, 'valvula de venteo diesel 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (120, 8, 56, 7, 1.00, 175.00, 3.00, 525.00, 0.00, 'Activo', 1, 'valvula de venteo gasolina (presion al vasio) 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (121, 8, 64, 7, 1.00, 160.00, 4.00, 640.00, 0.00, 'Activo', 1, 'manguera flexible 3/4\" x 50cm', 7);
INSERT INTO `detalle_proforma` VALUES (122, 8, 65, 7, 1.00, 195.00, 2.00, 390.00, 0.00, 'Activo', 1, 'manguera flexible de 1\" x 50 cm', 7);
INSERT INTO `detalle_proforma` VALUES (123, 8, 49, 7, 1.00, 80.00, 12.00, 960.00, 0.00, 'Activo', 1, 'sello antiexplosivo conduit 3/4\"', 7);
INSERT INTO `detalle_proforma` VALUES (124, 8, 50, 7, 1.00, 95.00, 4.00, 380.00, 0.00, 'Activo', 1, 'sello antiexplosivo conduit 1\"', 7);
INSERT INTO `detalle_proforma` VALUES (125, 8, 51, 7, 1.00, 65.00, 8.00, 520.00, 0.00, 'Activo', 1, 'sello antiexplosivo conduit 1/2\"', 7);
INSERT INTO `detalle_proforma` VALUES (126, 8, 93, 12, 1.00, 285.00, 4.00, 1140.00, 0.00, 'Activo', 1, 'valvula esferica 2\" 600 wob ', 12);
INSERT INTO `detalle_proforma` VALUES (127, 8, 73, 7, 1.00, 170.00, 6.00, 1020.00, 0.00, 'Activo', 1, 'cable thw awg # 12', 7);
INSERT INTO `detalle_proforma` VALUES (128, 8, 74, 7, 1.00, 110.00, 7.00, 770.00, 0.00, 'Activo', 1, 'cable thw awg # 14', 7);
INSERT INTO `detalle_proforma` VALUES (129, 8, 75, 15, 1.00, 650.00, 1.00, 650.00, 0.00, 'Activo', 1, 'cable ctp verde amarillo conexion tierra # 6', 15);
INSERT INTO `detalle_proforma` VALUES (130, 8, 105, 12, 1.00, 500.00, 2.00, 1000.00, 0.00, 'Activo', 1, 'cable dixon cat 6 utp', 12);
INSERT INTO `detalle_proforma` VALUES (131, 8, 76, 7, 1.00, 980.00, 2.00, 1960.00, 0.00, 'Activo', 1, 'cable thw awg # 4', 7);
INSERT INTO `detalle_proforma` VALUES (132, 8, 24, 7, 1.00, 42.00, 8.00, 336.00, 0.00, 'Activo', 1, 'union universal fierro negro class150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (133, 8, 25, 7, 1.00, 30.00, 8.00, 240.00, 0.00, 'Activo', 1, 'union universal fierro negro class150 1 1/2\"', 7);
INSERT INTO `detalle_proforma` VALUES (134, 8, 40, 7, 1.00, 14.80, 25.00, 370.00, 0.00, 'Activo', 1, 'union simple fierro negro class150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (135, 8, 96, 12, 1.00, 230.00, 11.00, 2530.00, 0.00, 'Activo', 1, 'contenedor nacional 13\" jg ', 12);
INSERT INTO `detalle_proforma` VALUES (136, 8, 39, 7, 1.00, 15.00, 8.00, 120.00, 0.00, 'Activo', 1, 'tee fierro negro cla150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (137, 8, 29, 7, 1.00, 13.50, 8.00, 108.00, 0.00, 'Activo', 1, 'reduccion bushing fierro negro class150 2\" x 1/2\"', 7);
INSERT INTO `detalle_proforma` VALUES (138, 8, 26, 7, 1.00, 19.00, 3.00, 57.00, 0.00, 'Activo', 1, 'tapon macho fierro negro class150 3\"', 7);
INSERT INTO `detalle_proforma` VALUES (139, 8, 58, 7, 1.00, 187.00, 8.00, 1496.00, 0.00, 'Activo', 1, 'valvula de emergencia 1 1/2\"', 7);
INSERT INTO `detalle_proforma` VALUES (140, 8, 77, 7, 1.00, 275.00, 21.00, 5775.00, 0.00, 'Activo', 1, 'anodo de magnesio para proteccion catodica', 7);
INSERT INTO `detalle_proforma` VALUES (141, 8, 72, 7, 1.00, 550.00, 3.00, 1650.00, 0.00, 'Activo', 1, 'varilla de cobre para poso tierra 5/8\"', 7);
INSERT INTO `detalle_proforma` VALUES (142, 8, 59, 7, 1.00, 275.00, 4.00, 1100.00, 0.00, 'Activo', 1, 'detector de fuga t/r jacket', 7);
INSERT INTO `detalle_proforma` VALUES (143, 8, 60, 7, 1.00, 680.00, 4.00, 2720.00, 0.00, 'Activo', 1, 'spill container ', 7);
INSERT INTO `detalle_proforma` VALUES (144, 8, 57, 7, 1.00, 690.00, 4.00, 2760.00, 0.00, 'Activo', 1, 'valvula de sobrellenado 4\" j.s', 7);
INSERT INTO `detalle_proforma` VALUES (145, 8, 86, 7, 1.00, 3.00, 400.00, 1200.00, 0.00, 'Activo', 1, 'cinta teflon amarilla de 1/2\"', 7);
INSERT INTO `detalle_proforma` VALUES (146, 8, 101, 12, 1.00, 250.00, 4.00, 1000.00, 0.00, 'Activo', 1, 'GASOILA', 12);
INSERT INTO `detalle_proforma` VALUES (147, 8, 66, 7, 1.00, 800.00, 1.00, 800.00, 0.00, 'Activo', 1, 'estabilizador 110v 250v/ 5000w', 7);
INSERT INTO `detalle_proforma` VALUES (148, 8, 68, 7, 1.00, 900.00, 1.00, 900.00, 0.00, 'Activo', 1, 'transformador de aislamiento 5kva', 7);
INSERT INTO `detalle_proforma` VALUES (149, 8, 89, 7, 1.00, 3500.00, 1.00, 3500.00, 0.00, 'Activo', 1, 'tablero de distribución 24 polos  trifasico', 7);
INSERT INTO `detalle_proforma` VALUES (150, 8, 90, 7, 1.00, 3500.00, 1.00, 3500.00, 0.00, 'Activo', 1, 'tablero general 24 polos trifasico', 7);
INSERT INTO `detalle_proforma` VALUES (151, 8, 92, 7, 1.00, 15000.00, 1.00, 15000.00, 0.00, 'Activo', 1, 'servicio de instalaciones mecanica y electricas de grifo y estación de servicios hasta la puesta en ', 7);
INSERT INTO `detalle_proforma` VALUES (152, 8, 88, 7, 1.00, 23000.00, 2.00, 46000.00, 0.00, 'Activo', 1, 'dispensador gilbarco encore 500 s  4x8  repotenciado', 7);
INSERT INTO `detalle_proforma` VALUES (153, 9, 107, 7, 1.00, 15000.00, 1.00, 15000.00, 0.00, 'Activo', 1, 'totem 1.70 x 7 mts acrilico 3mm', 7);
INSERT INTO `detalle_proforma` VALUES (154, 10, 102, 12, 1.00, 23000.00, 1.00, 23000.00, 0.00, 'Activo', 1, 'TECHO DE PROYECCION CANOPY  (SOLO INCLUYE 4 COLUMNAS 2 ISLAS 4 DEFENSAS Y 4 ANCLAJES DE COLUMNA )', 12);
INSERT INTO `detalle_proforma` VALUES (155, 11, 106, 7, 1.00, 25000.00, 1.00, 25000.00, 0.00, 'Activo', 1, 'tothem led 1.80 mts x 7mts  con panel de precios led 3 por lado ', 7);
INSERT INTO `detalle_proforma` VALUES (156, 12, 88, 7, 1.00, 19548.00, 1.00, 19548.00, 0.00, 'Activo', 1, 'dispensador gilbarco encore 500 s  MODELO NA  3 PRODUCTOS 6 MANGUERAS  repotenciado INCLUYE  PISTOLAS MANGUERAS   INSTALACION POR CUETA DEL CLIENTE', 7);
INSERT INTO `detalle_proforma` VALUES (157, 13, 24, 7, 1.00, 27.00, 8.00, 216.00, 0.00, 'Activo', 1, 'union universal fierro negro class150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (158, 13, 25, 7, 1.00, 19.50, 8.00, 156.00, 0.00, 'Activo', 1, 'union universal fierro negro class150 1 1/2\"', 7);
INSERT INTO `detalle_proforma` VALUES (159, 13, 40, 7, 1.00, 10.80, 6.00, 64.80, 0.00, 'Activo', 1, 'union simple fierro negro class150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (160, 13, 22, 7, 1.00, 11.50, 20.00, 230.00, 0.00, 'Activo', 1, 'codo x90° fierro negro class 150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (161, 13, 20, 7, 1.00, 155.00, 10.00, 1550.00, 0.00, 'Activo', 1, 'tubo ac negro schedule sch-40  ASTM A53/A106 S/C 2\" x 6M  ', 7);
INSERT INTO `detalle_proforma` VALUES (162, 13, 21, 7, 1.00, 430.00, 1.00, 430.00, 0.00, 'Activo', 1, 'tubo ac negro  schedule sch-40 ASTM A53/A106 S/C 4\" x  6M  ', 7);
INSERT INTO `detalle_proforma` VALUES (163, 13, 26, 7, 1.00, 19.00, 3.00, 57.00, 0.00, 'Activo', 1, 'tapon macho fierro negro class150 3\"', 7);
INSERT INTO `detalle_proforma` VALUES (164, 13, 32, 7, 1.00, 6.50, 18.00, 117.00, 0.00, 'Activo', 1, 'niple acero sch-40 2\" x 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (165, 13, 33, 7, 1.00, 7.20, 6.00, 43.20, 0.00, 'Activo', 1, 'niple acero sch-40 2\" x 3\"', 7);
INSERT INTO `detalle_proforma` VALUES (166, 13, 34, 7, 1.00, 10.20, 6.00, 61.20, 0.00, 'Activo', 1, 'niple acero sch-40 2\" x 4\"', 7);
INSERT INTO `detalle_proforma` VALUES (167, 13, 36, 7, 1.00, 11.40, 6.00, 68.40, 0.00, 'Activo', 1, 'niple acero sch-40 2\" x 5\"', 7);
INSERT INTO `detalle_proforma` VALUES (168, 13, 37, 7, 1.00, 13.30, 6.00, 79.80, 0.00, 'Activo', 1, 'niple acero sch-40 2\" x 6\"', 7);
INSERT INTO `detalle_proforma` VALUES (169, 13, 101, 12, 1.00, 250.00, 1.00, 250.00, 0.00, 'Activo', 1, 'GASOILA', 12);
INSERT INTO `detalle_proforma` VALUES (170, 13, 70, 7, 1.00, 240.00, 3.00, 720.00, 0.00, 'Activo', 1, 'cruceta de valvula flotante 4\" x 4\" x 3\" x 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (171, 13, 86, 7, 1.00, 3.50, 120.00, 420.00, 0.00, 'Activo', 1, 'cinta teflon amarilla de 1/2\"', 7);
INSERT INTO `detalle_proforma` VALUES (172, 13, 56, 7, 1.00, 155.00, 4.00, 620.00, 0.00, 'Activo', 1, 'valvula de venteo gasolina (presion al vasio) 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (173, 13, 71, 7, 1.00, 220.00, 3.00, 660.00, 0.00, 'Activo', 1, 'adaptador c/ tapa hermetica para RV 4\"', 7);
INSERT INTO `detalle_proforma` VALUES (174, 13, 53, 7, 1.00, 150.00, 8.00, 1200.00, 0.00, 'Activo', 1, 'adaptador c/ tapa 4\"', 7);
INSERT INTO `detalle_proforma` VALUES (175, 13, 93, 12, 1.00, 285.00, 4.00, 1140.00, 0.00, 'Activo', 1, 'válvula esférica 2\" 600 wob  DE BRONCE', 12);
INSERT INTO `detalle_proforma` VALUES (176, 13, 60, 7, 1.00, 600.00, 4.00, 2400.00, 0.00, 'Activo', 1, 'spill container ', 7);
INSERT INTO `detalle_proforma` VALUES (177, 13, 59, 7, 1.00, 275.00, 4.00, 1100.00, 0.00, 'Activo', 1, 'detector de fuga t/r jacket', 7);
INSERT INTO `detalle_proforma` VALUES (178, 13, 96, 12, 1.00, 200.00, 13.00, 2600.00, 0.00, 'Activo', 1, 'contenedor nacional 13\" jg ', 12);
INSERT INTO `detalle_proforma` VALUES (179, 13, 74, 7, 1.00, 110.00, 6.00, 660.00, 0.00, 'Activo', 1, 'cable thw awg # 14', 7);
INSERT INTO `detalle_proforma` VALUES (180, 13, 73, 7, 1.00, 170.00, 6.00, 1020.00, 0.00, 'Activo', 1, 'cable thw awg # 12', 7);
INSERT INTO `detalle_proforma` VALUES (181, 13, 49, 7, 1.00, 500.00, 6.00, 3000.00, 0.00, 'Activo', 1, 'sello antiexplosivo conduit 3/4\" KIT', 7);
INSERT INTO `detalle_proforma` VALUES (182, 13, 77, 7, 1.00, 260.00, 12.00, 3120.00, 0.00, 'Activo', 1, 'anodo de magnesio para proteccion catodica', 7);
INSERT INTO `detalle_proforma` VALUES (183, 13, 89, 7, 1.00, 3500.00, 1.00, 3500.00, 0.00, 'Activo', 1, 'tablero de distribución 24 polos  trifasico', 7);
INSERT INTO `detalle_proforma` VALUES (184, 13, 90, 7, 1.00, 3500.00, 1.00, 3500.00, 0.00, 'Activo', 1, 'tablero general 24 polos trifasico', 7);
INSERT INTO `detalle_proforma` VALUES (185, 13, 62, 7, 1.00, 140.00, 8.00, 1120.00, 0.00, 'Activo', 1, 'manguera flexible 11/2\" x 50cm ', 7);
INSERT INTO `detalle_proforma` VALUES (186, 13, 63, 7, 1.00, 150.00, 4.00, 600.00, 0.00, 'Activo', 1, 'manguera flexible 2\" x 40 cm', 7);
INSERT INTO `detalle_proforma` VALUES (187, 13, 58, 7, 1.00, 170.00, 8.00, 1360.00, 0.00, 'Activo', 1, 'valvula de emergencia 1 1/2\"', 7);
INSERT INTO `detalle_proforma` VALUES (188, 13, 13, 16, 1.00, 6120.00, 3.00, 18360.00, 0.00, 'Activo', 1, 'bomba sumergible  3/4\" HP', 16);
INSERT INTO `detalle_proforma` VALUES (189, 13, 14, 16, 1.00, 7020.00, 1.00, 7020.00, 0.00, 'Activo', 1, 'bomba sumergible 1.5HP', 16);
INSERT INTO `detalle_proforma` VALUES (190, 13, 66, 7, 1.00, 1200.00, 1.00, 1200.00, 0.00, 'Activo', 1, 'estabilizador 110v 250v/ 5000w', 7);
INSERT INTO `detalle_proforma` VALUES (191, 13, 68, 7, 1.00, 1300.00, 1.00, 1300.00, 0.00, 'Activo', 1, 'transformador de aislamiento 5kva', 7);
INSERT INTO `detalle_proforma` VALUES (192, 14, 20, 7, 1.00, 165.00, 80.00, 13200.00, 0.00, 'Activo', 1, 'tubo ac negro schedule sch-40  ASTM A53/A106 S/C 2\" x 6M  ', 7);
INSERT INTO `detalle_proforma` VALUES (193, 14, 21, 7, 1.00, 470.00, 2.00, 940.00, 0.00, 'Activo', 1, 'tubo ac negro  schedule sch-40 ASTM A53/A106 S/C 4\" x  6M  ', 7);
INSERT INTO `detalle_proforma` VALUES (194, 14, 22, 7, 1.00, 21.50, 60.00, 1290.00, 0.00, 'Activo', 1, 'codo x90° fierro negro class 150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (195, 14, 23, 7, 1.00, 21.50, 30.00, 645.00, 0.00, 'Activo', 1, 'codo x45° fierro negro class150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (196, 14, 32, 7, 1.00, 6.50, 25.00, 162.50, 0.00, 'Activo', 1, 'niple acero sch-40 2\" x 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (197, 14, 35, 7, 1.00, 8.60, 25.00, 215.00, 0.00, 'Activo', 1, 'niple acero sch-40 2\" x 4\"', 7);
INSERT INTO `detalle_proforma` VALUES (198, 14, 37, 7, 1.00, 13.30, 20.00, 266.00, 0.00, 'Activo', 1, 'niple acero sch-40 2\" x 6\"', 7);
INSERT INTO `detalle_proforma` VALUES (199, 14, 33, 7, 1.00, 7.20, 20.00, 144.00, 0.00, 'Activo', 1, 'niple acero sch-40 2\" x 3\"', 7);
INSERT INTO `detalle_proforma` VALUES (200, 14, 11, 16, 1.00, 7560.00, 1.00, 7560.00, 0.00, 'Activo', 1, 'bomba sumergible 1.5 HP', 16);
INSERT INTO `detalle_proforma` VALUES (201, 14, 13, 16, 1.00, 6480.00, 4.00, 25920.00, 0.00, 'Activo', 1, 'bomba sumergible  3/4\" HP', 16);
INSERT INTO `detalle_proforma` VALUES (202, 14, 62, 7, 1.00, 230.00, 10.00, 2300.00, 0.00, 'Activo', 1, 'manguera flexible 11/2\" x 50cm ', 7);
INSERT INTO `detalle_proforma` VALUES (203, 14, 63, 7, 1.00, 250.00, 5.00, 1250.00, 0.00, 'Activo', 1, 'manguera flexible 2\" x 40 cm', 7);
INSERT INTO `detalle_proforma` VALUES (204, 14, 53, 7, 1.00, 190.00, 5.00, 950.00, 0.00, 'Activo', 1, 'adaptador c/ tapa 4\"', 7);
INSERT INTO `detalle_proforma` VALUES (205, 14, 52, 7, 1.00, 85.00, 5.00, 425.00, 0.00, 'Activo', 1, 'adaptador c/ tapa hermetica 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (206, 14, 71, 7, 1.00, 320.00, 4.00, 1280.00, 0.00, 'Activo', 1, 'adaptador c/ tapa hermetica para RV 4\"', 7);
INSERT INTO `detalle_proforma` VALUES (207, 14, 70, 7, 1.00, 285.00, 4.00, 1140.00, 0.00, 'Activo', 1, 'cruceta de valvula flotante 4\" x 4\" x 3\" x 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (208, 14, 55, 7, 1.00, 135.00, 1.00, 135.00, 0.00, 'Activo', 1, 'valvula de venteo diesel 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (209, 14, 56, 7, 1.00, 175.00, 4.00, 700.00, 0.00, 'Activo', 1, 'valvula de venteo gasolina (presion al vasio) 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (210, 14, 49, 7, 1.00, 500.00, 5.00, 2500.00, 0.00, 'Activo', 1, 'sello antiexplosivo conduit 3/4\" completo', 7);
INSERT INTO `detalle_proforma` VALUES (211, 14, 50, 7, 1.00, 600.00, 3.00, 1800.00, 0.00, 'Activo', 1, 'sello antiexplosivo conduit 1\" ompleto', 7);
INSERT INTO `detalle_proforma` VALUES (212, 14, 103, 12, 1.00, 80.00, 8.00, 640.00, 0.00, 'Activo', 1, 'cajas rewalt 1/2\"', 12);
INSERT INTO `detalle_proforma` VALUES (213, 14, 93, 12, 1.00, 285.00, 5.00, 1425.00, 0.00, 'Activo', 1, 'valvula esferica 2\" 600 wob ', 12);
INSERT INTO `detalle_proforma` VALUES (214, 14, 73, 7, 1.00, 170.00, 25.00, 4250.00, 0.00, 'Activo', 1, 'cable thw awg # 12', 7);
INSERT INTO `detalle_proforma` VALUES (215, 14, 74, 7, 1.00, 110.00, 12.00, 1320.00, 0.00, 'Activo', 1, 'cable thw awg # 14', 7);
INSERT INTO `detalle_proforma` VALUES (216, 14, 40, 7, 1.00, 14.80, 50.00, 740.00, 0.00, 'Activo', 1, 'union simple fierro negro class150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (217, 14, 96, 12, 1.00, 250.00, 15.00, 3750.00, 0.00, 'Activo', 1, 'contenedor nacional 13\" jg ', 12);
INSERT INTO `detalle_proforma` VALUES (218, 14, 39, 7, 1.00, 15.00, 6.00, 90.00, 0.00, 'Activo', 1, 'tee fierro negro cla150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (219, 14, 98, 12, 1.00, 0.00, 1.00, 0.00, 0.00, 'Activo', 1, 'bushing de 2\" a  1 1/2\" 150 lbs ', 12);
INSERT INTO `detalle_proforma` VALUES (220, 14, 29, 7, 1.00, 13.50, 10.00, 135.00, 0.00, 'Activo', 1, 'reduccion bushing fierro negro class150 2\" x 1/2\"', 7);
INSERT INTO `detalle_proforma` VALUES (221, 14, 24, 7, 1.00, 52.00, 10.00, 520.00, 0.00, 'Activo', 1, 'union universal fierro negro class150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (222, 14, 25, 7, 1.00, 40.00, 10.00, 400.00, 0.00, 'Activo', 1, 'union universal fierro negro class150 1 1/2\"', 7);
INSERT INTO `detalle_proforma` VALUES (223, 14, 27, 7, 1.00, 12.00, 8.00, 96.00, 0.00, 'Activo', 1, 'tapon macho fierro negro class150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (224, 14, 26, 7, 1.00, 19.00, 4.00, 76.00, 0.00, 'Activo', 1, 'tapon macho fierro negro class150 3\"', 7);
INSERT INTO `detalle_proforma` VALUES (225, 14, 58, 7, 1.00, 187.00, 10.00, 1870.00, 0.00, 'Activo', 1, 'valvula de emergencia 1 1/2\"', 7);
INSERT INTO `detalle_proforma` VALUES (226, 14, 77, 7, 1.00, 287.00, 25.00, 7175.00, 0.00, 'Activo', 1, 'anodo de magnesio para proteccion catodica', 7);
INSERT INTO `detalle_proforma` VALUES (227, 14, 72, 7, 1.00, 550.00, 5.00, 2750.00, 0.00, 'Activo', 1, 'varilla de cobre para poso tierra 5/8\"', 7);
INSERT INTO `detalle_proforma` VALUES (228, 14, 99, 12, 1.00, 276.00, 5.00, 1380.00, 0.00, 'Activo', 1, 'detector de fugas ', 12);
INSERT INTO `detalle_proforma` VALUES (229, 14, 60, 7, 1.00, 680.00, 5.00, 3400.00, 0.00, 'Activo', 1, 'spill container ', 7);
INSERT INTO `detalle_proforma` VALUES (230, 14, 57, 7, 1.00, 690.00, 5.00, 3450.00, 0.00, 'Activo', 1, 'valvula de sobrellenado 4\" j.s', 7);
INSERT INTO `detalle_proforma` VALUES (231, 14, 86, 7, 1.00, 3.50, 500.00, 1750.00, 0.00, 'Activo', 1, 'cinta teflon amarilla de 1/2\"', 7);
INSERT INTO `detalle_proforma` VALUES (232, 14, 101, 12, 1.00, 250.00, 4.00, 1000.00, 0.00, 'Activo', 1, 'GASOILA', 12);
INSERT INTO `detalle_proforma` VALUES (233, 14, 66, 7, 1.00, 1200.00, 1.00, 1200.00, 0.00, 'Activo', 1, 'estabilizador 110v 250v/ 5000w', 7);
INSERT INTO `detalle_proforma` VALUES (234, 14, 68, 7, 1.00, 1300.00, 1.00, 1300.00, 0.00, 'Activo', 1, 'transformador de aislamiento 5kva', 7);
INSERT INTO `detalle_proforma` VALUES (235, 14, 89, 7, 1.00, 3500.00, 1.00, 3500.00, 0.00, 'Activo', 1, 'tablero de distribución 24 polos  trifasico', 7);
INSERT INTO `detalle_proforma` VALUES (236, 14, 90, 7, 1.00, 3500.00, 1.00, 3500.00, 0.00, 'Activo', 1, 'tablero general 24 polos trifasico', 7);
INSERT INTO `detalle_proforma` VALUES (237, 14, 105, 12, 1.00, 600.00, 6.00, 3600.00, 0.00, 'Activo', 1, 'cable dixon cat 6 utp', 12);
INSERT INTO `detalle_proforma` VALUES (238, 14, 88, 7, 1.00, 23400.00, 2.00, 46800.00, 0.00, 'Activo', 1, 'dispensador gilbarco encore 500 s  4x8  repotenciado', 7);
INSERT INTO `detalle_proforma` VALUES (239, 14, 87, 7, 1.00, 28000.00, 1.00, 28000.00, 0.00, 'Activo', 1, 'dispensador gilbarco encore 500 s  alto galonaje', 7);
INSERT INTO `detalle_proforma` VALUES (240, 14, 92, 7, 1.00, 19000.00, 1.00, 19000.00, 0.00, 'Activo', 1, 'servicio de instalaciones mecanica y electricas de grifo y estación de servicios hasta la puesta en ', 7);
INSERT INTO `detalle_proforma` VALUES (241, 15, 102, 12, 1.00, 410.00, 346.00, 141860.00, 0.00, 'Activo', 1, 'TECHO DE PROYECCION CANOPY de 346 M2 a todo costo incluye  tubos sch 40 de 14\" alucin  reflectores   columnas de fierro de ', 12);
INSERT INTO `detalle_proforma` VALUES (242, 16, 95, 9, 1.00, 3.00, 20000.00, 60000.00, 0.00, 'Activo', 1, 'tanque de almacenamiento de combustible plancha de 1/4\" de espesor 20 MIL, GALONES', 9);
INSERT INTO `detalle_proforma` VALUES (243, 17, 92, 7, 1.00, 290000.00, 1.00, 290000.00, 0.00, 'Activo', 1, 'servicio de instalaciones mecanica y electricas de grifo y estación de servicios hasta la puesta en MARCHA DE GASOCENTRO A TODO COSTO CON 2 DISPENSADO', 7);
INSERT INTO `detalle_proforma` VALUES (244, 18, 22, 7, 1.00, 21.50, 30.00, 645.00, 0.00, 'Activo', 1, 'codo x90° fierro negro class 150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (245, 18, 23, 7, 1.00, 21.50, 20.00, 430.00, 0.00, 'Activo', 1, 'codo x45° fierro negro class150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (246, 18, 20, 7, 1.00, 185.00, 26.00, 4810.00, 0.00, 'Activo', 1, 'tubo ac negro schedule sch-40  ASTM A53/A106 S/C 2\" x 6M  ', 7);
INSERT INTO `detalle_proforma` VALUES (247, 18, 21, 7, 1.00, 490.00, 2.00, 980.00, 0.00, 'Activo', 1, 'tubo ac negro  schedule sch-40 ASTM A53/A106 S/C 4\" x  6M  ', 7);
INSERT INTO `detalle_proforma` VALUES (248, 18, 32, 7, 1.00, 7.50, 20.00, 150.00, 0.00, 'Activo', 1, 'niple acero sch-40 2\" x 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (249, 18, 33, 7, 1.00, 8.20, 15.00, 123.00, 0.00, 'Activo', 1, 'niple acero sch-40 2\" x 3\"', 7);
INSERT INTO `detalle_proforma` VALUES (250, 18, 35, 7, 1.00, 9.60, 15.00, 144.00, 0.00, 'Activo', 1, 'niple acero sch-40 2\" x 4\"', 7);
INSERT INTO `detalle_proforma` VALUES (251, 18, 37, 7, 1.00, 10.30, 20.00, 206.00, 0.00, 'Activo', 1, 'niple acero sch-40 2\" x 6\"', 7);
INSERT INTO `detalle_proforma` VALUES (252, 18, 11, 16, 1.00, 7560.00, 1.00, 7560.00, 0.00, 'Activo', 1, 'bomba sumergible 1.5 HP', 16);
INSERT INTO `detalle_proforma` VALUES (253, 18, 13, 16, 1.00, 6480.00, 3.00, 19440.00, 0.00, 'Activo', 1, 'bomba sumergible  3/4\" HP', 16);
INSERT INTO `detalle_proforma` VALUES (254, 18, 70, 7, 1.00, 285.00, 3.00, 855.00, 0.00, 'Activo', 1, 'cruceta de valvula flotante 4\" x 4\" x 3\" x 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (255, 18, 62, 7, 1.00, 230.00, 8.00, 1840.00, 0.00, 'Activo', 1, 'manguera flexible 11/2\" x 50cm ', 7);
INSERT INTO `detalle_proforma` VALUES (256, 18, 63, 7, 1.00, 250.00, 4.00, 1000.00, 0.00, 'Activo', 1, 'manguera flexible 2\" x 40 cm', 7);
INSERT INTO `detalle_proforma` VALUES (257, 18, 52, 7, 1.00, 85.00, 4.00, 340.00, 0.00, 'Activo', 1, 'adaptador c/ tapa hermetica 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (258, 18, 53, 7, 1.00, 190.00, 4.00, 760.00, 0.00, 'Activo', 1, 'adaptador c/ tapa 4\"', 7);
INSERT INTO `detalle_proforma` VALUES (259, 18, 71, 7, 1.00, 320.00, 3.00, 960.00, 0.00, 'Activo', 1, 'adaptador c/ tapa hermetica para RV 4\"', 7);
INSERT INTO `detalle_proforma` VALUES (260, 18, 55, 7, 1.00, 135.00, 1.00, 135.00, 0.00, 'Activo', 1, 'valvula de venteo diesel 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (261, 18, 56, 7, 1.00, 175.00, 3.00, 525.00, 0.00, 'Activo', 1, 'valvula de venteo gasolina (presion al vasio) 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (262, 18, 64, 7, 1.00, 190.00, 4.00, 760.00, 0.00, 'Activo', 1, 'manguera flexible 3/4\" x 50cm', 7);
INSERT INTO `detalle_proforma` VALUES (263, 18, 65, 7, 1.00, 225.00, 2.00, 450.00, 0.00, 'Activo', 1, 'manguera flexible de 1\" x 50 cm', 7);
INSERT INTO `detalle_proforma` VALUES (264, 18, 49, 7, 1.00, 80.00, 12.00, 960.00, 0.00, 'Activo', 1, 'sello antiexplosivo conduit 3/4\"', 7);
INSERT INTO `detalle_proforma` VALUES (265, 18, 50, 7, 1.00, 95.00, 6.00, 570.00, 0.00, 'Activo', 1, 'sello antiexplosivo conduit 1\"', 7);
INSERT INTO `detalle_proforma` VALUES (266, 18, 51, 7, 1.00, 65.00, 10.00, 650.00, 0.00, 'Activo', 1, 'sello antiexplosivo conduit 1/2\"', 7);
INSERT INTO `detalle_proforma` VALUES (267, 18, 93, 12, 1.00, 285.00, 4.00, 1140.00, 0.00, 'Activo', 1, 'valvula esferica 2\" 600 wob ', 12);
INSERT INTO `detalle_proforma` VALUES (268, 18, 73, 7, 1.00, 170.00, 10.00, 1700.00, 0.00, 'Activo', 1, 'cable thw awg # 12', 7);
INSERT INTO `detalle_proforma` VALUES (269, 18, 74, 7, 1.00, 110.00, 7.00, 770.00, 0.00, 'Activo', 1, 'cable thw awg # 14', 7);
INSERT INTO `detalle_proforma` VALUES (270, 18, 76, 7, 1.00, 980.00, 2.00, 1960.00, 0.00, 'Activo', 1, 'cable thw awg # 6', 7);
INSERT INTO `detalle_proforma` VALUES (271, 18, 75, 15, 1.00, 650.00, 1.00, 650.00, 0.00, 'Activo', 1, 'cable ctp verde amarillo conexion tierra # 6', 15);
INSERT INTO `detalle_proforma` VALUES (272, 18, 40, 7, 1.00, 14.80, 25.00, 370.00, 0.00, 'Activo', 1, 'union simple fierro negro class150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (273, 18, 96, 12, 1.00, 250.00, 11.00, 2750.00, 0.00, 'Activo', 1, 'contenedor nacional 13\" jg ', 12);
INSERT INTO `detalle_proforma` VALUES (274, 18, 39, 7, 1.00, 15.00, 4.00, 60.00, 0.00, 'Activo', 1, 'tee fierro negro cla150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (275, 18, 29, 7, 1.00, 13.50, 8.00, 108.00, 0.00, 'Activo', 1, 'reduccion bushing fierro negro class150 2\" x 1/2\"', 7);
INSERT INTO `detalle_proforma` VALUES (276, 18, 28, 7, 1.00, 23.00, 8.00, 184.00, 0.00, 'Activo', 1, 'reduccion bushing fierro negro class150 4\" x 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (277, 18, 26, 7, 1.00, 19.00, 4.00, 76.00, 0.00, 'Activo', 1, 'tapon macho fierro negro class150 3\"', 7);
INSERT INTO `detalle_proforma` VALUES (278, 18, 27, 7, 1.00, 12.00, 10.00, 120.00, 0.00, 'Activo', 1, 'tapon macho fierro negro class150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (279, 18, 58, 7, 1.00, 187.00, 8.00, 1496.00, 0.00, 'Activo', 1, 'valvula de emergencia 1 1/2\"', 7);
INSERT INTO `detalle_proforma` VALUES (280, 18, 77, 7, 1.00, 287.00, 18.00, 5166.00, 0.00, 'Activo', 1, 'anodo de magnesio para proteccion catodica', 7);
INSERT INTO `detalle_proforma` VALUES (281, 18, 94, 12, 1.00, 300.00, 1.00, 300.00, 0.00, 'Activo', 1, 'punta para rayos 3 pines ', 12);
INSERT INTO `detalle_proforma` VALUES (282, 18, 60, 7, 1.00, 680.00, 4.00, 2720.00, 0.00, 'Activo', 1, 'spill container ', 7);
INSERT INTO `detalle_proforma` VALUES (283, 18, 57, 7, 1.00, 690.00, 4.00, 2760.00, 0.00, 'Activo', 1, 'valvula de sobrellenado 4\" j.s', 7);
INSERT INTO `detalle_proforma` VALUES (284, 18, 59, 7, 1.00, 275.00, 4.00, 1100.00, 0.00, 'Activo', 1, 'detector de fuga t/r jacket', 7);
INSERT INTO `detalle_proforma` VALUES (285, 18, 86, 7, 1.00, 3.50, 400.00, 1400.00, 0.00, 'Activo', 1, 'cinta teflon amarilla de 1/2\"', 7);
INSERT INTO `detalle_proforma` VALUES (286, 18, 101, 12, 1.00, 250.00, 3.00, 750.00, 0.00, 'Activo', 1, 'GASOILA', 12);
INSERT INTO `detalle_proforma` VALUES (287, 18, 89, 7, 1.00, 3500.00, 1.00, 3500.00, 0.00, 'Activo', 1, 'tablero de distribución 24 polos  trifasico', 7);
INSERT INTO `detalle_proforma` VALUES (288, 18, 90, 7, 1.00, 3500.00, 1.00, 3500.00, 0.00, 'Activo', 1, 'tablero general 24 polos trifasico', 7);
INSERT INTO `detalle_proforma` VALUES (289, 18, 66, 7, 1.00, 1200.00, 1.00, 1200.00, 0.00, 'Activo', 1, 'estabilizador 110v 250v/ 5000w', 7);
INSERT INTO `detalle_proforma` VALUES (290, 18, 68, 7, 1.00, 1300.00, 1.00, 1300.00, 0.00, 'Activo', 1, 'transformador de aislamiento 5kva', 7);
INSERT INTO `detalle_proforma` VALUES (291, 18, 88, 7, 1.00, 23600.00, 2.00, 47200.00, 0.00, 'Activo', 1, 'dispensador gilbarco encore 500 s  4x8  repotenciado', 7);
INSERT INTO `detalle_proforma` VALUES (292, 18, 92, 7, 1.00, 16000.00, 1.00, 16000.00, 0.00, 'Activo', 1, 'servicio de instalaciones mecanica y electricas de grifo y estación de servicios hasta la puesta en ', 7);
INSERT INTO `detalle_proforma` VALUES (293, 18, 24, 7, 1.00, 52.00, 8.00, 416.00, 0.00, 'Activo', 1, 'union universal fierro negro class150 2\"', 7);
INSERT INTO `detalle_proforma` VALUES (294, 18, 25, 7, 1.00, 40.00, 8.00, 320.00, 0.00, 'Activo', 1, 'union universal fierro negro class150 1 1/2\"', 7);
INSERT INTO `detalle_proforma` VALUES (295, 19, 102, 12, 1.00, 400.00, 112.00, 44800.00, 0.00, 'Activo', 1, 'TECHO DE PROYECCION CANOPY DE 14 X 8 MTS  INCLUYE LUMINARIAS CIELO RAZO Y PINTURA DE BASE     112M2 ', 12);

-- ----------------------------
-- Table structure for detalle_venta
-- ----------------------------
DROP TABLE IF EXISTS `detalle_venta`;
CREATE TABLE `detalle_venta`  (
  `iddetalle_venta` int(11) NOT NULL AUTO_INCREMENT,
  `venta_idventa` int(11) NULL DEFAULT NULL,
  `producto_idproducto` int(11) NULL DEFAULT NULL,
  `tienda_idtienda` int(11) NULL DEFAULT NULL,
  `descripcion` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tipo_producto` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `idpresentacion` int(11) NULL DEFAULT NULL,
  `cantidadxpresentacion` int(11) NULL DEFAULT NULL,
  `precioxpresentacion` decimal(18, 2) NULL DEFAULT NULL,
  `cantidad` decimal(18, 2) NULL DEFAULT NULL,
  `descuento` decimal(18, 2) NULL DEFAULT NULL,
  `subtotal` decimal(18, 2) NULL DEFAULT NULL,
  `estado` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  PRIMARY KEY (`iddetalle_venta`) USING BTREE,
  INDEX `venta_idventa`(`venta_idventa`) USING BTREE,
  INDEX `stock_idstock`(`tienda_idtienda`) USING BTREE,
  CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`venta_idventa`) REFERENCES `venta` (`idventa`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detalle_venta
-- ----------------------------

-- ----------------------------
-- Table structure for documentacion
-- ----------------------------
DROP TABLE IF EXISTS `documentacion`;
CREATE TABLE `documentacion`  (
  `iddocumentacion` int(11) NOT NULL AUTO_INCREMENT,
  `nro_documento` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nro_pre_documento` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cliente_razon_social` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cliente_documento` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cliente_direccion` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `contacto` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `colaborador_idcolaborador` int(11) NULL DEFAULT NULL,
  `texto` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `observacion` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `fecha_emision` date NULL DEFAULT NULL,
  `fecha_vencimiento` date NULL DEFAULT NULL,
  `total` decimal(18, 2) NULL DEFAULT NULL,
  `serie_comprobante_idserie_comprobante` int(11) NULL DEFAULT NULL,
  `tipo_comprobante_idtipo_comprobante` int(11) NULL DEFAULT NULL,
  `cliente_idcliente` int(11) NULL DEFAULT NULL,
  `tienda_idtienda` int(11) NULL DEFAULT NULL,
  `fecha_creacion` datetime NULL DEFAULT NULL,
  `estado` enum('vigente','anulado','atendido') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'vigente',
  PRIMARY KEY (`iddocumentacion`) USING BTREE,
  INDEX `colaborador_idcolaborador`(`colaborador_idcolaborador`) USING BTREE,
  INDEX `serie`(`serie_comprobante_idserie_comprobante`) USING BTREE,
  CONSTRAINT `documentacion_ibfk_2` FOREIGN KEY (`colaborador_idcolaborador`) REFERENCES `colaborador` (`idcolaborador`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `documentacion_ibfk_3` FOREIGN KEY (`serie_comprobante_idserie_comprobante`) REFERENCES `serie_comprobante` (`idserie_comprobante`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 49 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of documentacion
-- ----------------------------
INSERT INTO `documentacion` VALUES (1, 'CER-1', '', 'PEDRO BUSTAMANTE TERRONES', ' 1042875516', 'Jr. Túpac Amaru S/N carretera a san Luis de Lucma, distrito de SOCOTA, provincia de CUTERVO, departa', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO.', '', '2019-09-04', '2019-09-04', NULL, 10, 10, 0, 1, '2019-09-04 21:05:01', 'vigente');
INSERT INTO `documentacion` VALUES (2, 'CER-2', '', 'PEDRO BUSTAMANTE TERRONES', '10428755168', 'Jr. Túpac Amaru S/N carretera a san Luis de Lucma, distrito de SOCOTA, provincia de CUTERVO, departa', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO.', '', '2019-09-04', '2019-09-04', NULL, 10, 10, 0, 1, '2019-09-04 21:19:34', 'vigente');
INSERT INTO `documentacion` VALUES (3, 'CER-3', '', ' EL OVALO ESTACION & SERVICIOS GENERALES S.R.L', '20529654546', 'AV SAN MARTIN DE PORRES  N° 2475-2485 ESQ. CON JR. SAN CAMILO N° 307-317 EN EL DISTRITO DE CAJAMARCA', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO.', '', '2019-09-06', '2019-09-06', NULL, 10, 10, 0, 1, '2019-09-06 21:37:51', 'vigente');
INSERT INTO `documentacion` VALUES (4, 'CERT-1', '', 'JOSE ISIDRO SOLÓRZANO CERNA', '10266550117', 'JR. AREQUIPA N° 355 EN EL DISTRITO DE JESÚS, PROVINCIA DE CAJAMARCA, DEPARTAMENTO DE CAJAMARCA.', NULL, 1, ' Certificado ', '', '2019-09-06', '2019-09-06', NULL, 7, 7, 0, 1, '2019-09-06 21:59:29', 'vigente');
INSERT INTO `documentacion` VALUES (5, 'CER-4', '', 'CLAUDIA KATIA SIGÜENZA ALVAREZ', '46538150', 'CRUCE CARRETERA MARGINAL DE LA SIERRA (CARRETERA SAN MARCCOS-CAJABAMBA) CON CARRETERA A CHUQUIBAMBA ', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO.', '', '2019-09-23', '2019-09-23', NULL, 10, 10, 0, 1, '2019-09-23 17:10:45', 'vigente');
INSERT INTO `documentacion` VALUES (6, 'CER-5', '', ' CLAUDIA KATIA SIGÜENZA ALVAREZ', ' 4653815', 'CRUCE CARRETERA MARGINAL DE LA SIERRA (CARRETERA SAN MARCOS-CAJABAMBA) CON CARRETERA A CHUQUIBAMBA L', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO.', '', '2019-09-23', '2019-09-23', NULL, 10, 10, 0, 1, '2019-09-23 17:26:32', 'vigente');
INSERT INTO `documentacion` VALUES (7, 'CER-6', '', 'CLAUDIA KATIA SIGÜENZA ALVAREZ', '46538150', 'CRUCE CARRETERA MARGINAL DE LA SIERRA (CARRETERA SAN MARCOS-CAJABAMBA) CON CARRETERA A CHUQUIBAMBA L', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO.', '', '2019-09-23', '2019-09-23', NULL, 10, 10, 0, 1, '2019-09-23 17:37:21', 'vigente');
INSERT INTO `documentacion` VALUES (8, 'CER-7', '', 'CLAUDIA KATIA SIGÜENZA ALVAREZ', ' 4653815', 'CRUCE CARRETERA MARGINAL DE LA SIERRA (CARRETERA SAN MARCOS-CAJABAMBA) CON CARRETERA A CHUQUIBAMBA L', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO.', '', '2019-09-23', '2019-09-23', NULL, 10, 10, 0, 1, '2019-09-23 17:48:14', 'vigente');
INSERT INTO `documentacion` VALUES (9, 'CER-8', '', 'CLAUDIA KATIA SIGÜENZA ALVAREZ', '46538150', 'CRUCE CARRETERA MARGINAL DE LA SIERRA (CARRETERA SAN MARCOS-CAJABAMBA) CON CARRETERA A CHUQUIBAMBA L', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO.', '', '2019-09-23', '2019-09-23', NULL, 10, 10, 0, 1, '2019-09-23 17:54:54', 'vigente');
INSERT INTO `documentacion` VALUES (10, 'CER-9', '', ' CLAUDIA KATIA SIGÜENZA ALVAREZ', '46538150', 'CRUCE CARRETERA MARGINAL DE LA SIERRA (CARRETERA SAN MARCOS-CAJABAMBA) CON CARRETERA A CHUQUIBAMBA L', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO.', '', '2019-09-23', '2019-09-23', NULL, 10, 10, 0, 1, '2019-09-23 18:01:08', 'vigente');
INSERT INTO `documentacion` VALUES (11, 'CER-10', '', ' CLAUDIA KATIA SIGÜENZA ALVAREZ', '46538150', 'CRUCE CARRETERA MARGINAL DE LA SIERRA (CARRETERA SAN MARCOS-CAJABAMBA) CON CARRETERA A CHUQUIBAMBA L', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO.', '', '2019-09-23', '2019-09-23', NULL, 10, 10, 0, 1, '2019-09-23 18:06:21', 'vigente');
INSERT INTO `documentacion` VALUES (12, 'CER-11', '', 'TRANSPORTES ACUARIO S.A.C.', '20453556086', 'U. C.  N° 55725 PREDIO RUSTICO SUNCHUBAMBA SECTOR SUNCHUBAMBA CASERÍO HUACARIZ DISTRITO DE CAJAMARCA', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO.', '', '2019-11-06', '2019-11-06', NULL, 10, 10, 0, 1, '2019-11-06 18:55:22', 'vigente');
INSERT INTO `documentacion` VALUES (13, 'CER-12', '', 'TRANSPORTES ACUARIO S.A.C.', '20453556086', ' U. C.  N° 55725 PREDIO RUSTICO SUNCHUBAMBA SECTOR SUNCHUBAMBA CASERÍO HUACARIZ DISTRITO DE CAJAMARC', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO.', '', '2019-11-06', '2019-11-06', NULL, 10, 10, 0, 1, '2019-11-06 19:09:30', 'vigente');
INSERT INTO `documentacion` VALUES (14, 'CER-13', '', 'TRANSPORTES ACUARIO S.A.C.', '20453556086', 'U. C.  N° 55725 PREDIO RUSTICO SUNCHUBAMBA SECTOR SUNCHUBAMBA CASERÍO HUACARIZ DISTRITO DE CAJAMARCA', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO.', '', '2019-11-06', '2019-11-06', NULL, 10, 10, 0, 1, '2019-11-06 19:20:20', 'vigente');
INSERT INTO `documentacion` VALUES (15, 'CER-14', '', 'ASOCIACION DE TRANSPORTISTAS LA PAZ CAJAMARCA ', '20605528709', 'AV. LA PAZ  S/N CUADRA 20 EN EL   DISTRITO  DE CAJAMARCA, PROVINCIA DE CAJAMARCA, DEPARTAMENTO DE CA', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO.', '', '2019-12-18', '2019-12-18', NULL, 10, 10, 0, 1, '2019-12-18 21:06:04', 'vigente');
INSERT INTO `documentacion` VALUES (23, 'CER-15', '', 'BERTHA PADILLA GONZALES', '10277107681', 'CARR. JAEN  - SAN IGNACIO KM.26+401 SECTOR YANAYACU JAEN-JAEN-CAJAMARCA.', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO', '', '2020-10-09', '2020-10-09', NULL, 10, 10, 0, 1, '2020-10-09 21:24:39', 'vigente');
INSERT INTO `documentacion` VALUES (24, 'CER-16', '', 'BERTHA PADILLA GONZALES', '10277107681', 'CARR. JAÉN  - SAN IGNACIO KM.26+401 SECTOR YANAYACU JAEN-JAEN-CAJAMARCA.', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO', '', '2020-10-09', '2020-10-09', NULL, 10, 10, 0, 1, '2020-10-09 21:40:48', 'vigente');
INSERT INTO `documentacion` VALUES (25, 'CER-17', '', 'BERTHA PADILLA GONZALES', '10277107681', 'CARR. JAÉN  - SAN IGNACIO KM.26+401 SECTOR YANAYACU JAEN-JAEN-CAJAMARCA.', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO', '', '2020-10-09', '2020-10-09', NULL, 10, 10, 0, 1, '2020-10-09 21:46:52', 'vigente');
INSERT INTO `documentacion` VALUES (26, 'CER-18', '', 'BERTHA PADILLA GONZALES', '10277107681', 'CARR. JAÉN  - SAN IGNACIO KM.26+401 SECTOR YANAYACU JAEN-JAEN-CAJAMARCA.', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO', '', '2020-10-09', '2020-10-09', NULL, 10, 10, 0, 1, '2020-10-09 21:54:36', 'vigente');
INSERT INTO `documentacion` VALUES (27, 'CER-19', '', 'SEGUNDO FABIAN CASTILLO MONTOYA', '10266343391', 'CARRETERA JESUS-CAJAMARCA KM 1264+145 CASERIO LA COLPA  JESUS-CAJAMARCA-CAJAMARCA', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO', '', '2020-10-09', '2020-10-09', NULL, 10, 10, 6, 1, '2020-10-09 22:05:58', 'vigente');
INSERT INTO `documentacion` VALUES (28, 'CER-20', '', 'SEGUNDO FABIAN CASTILLO MONTOYA', '10266343391', 'CARRETERA JESUS-CAJAMARCA KM 1264+145 CASERIO LA COLPA  JESUS-CAJAMARCA-CAJAMARCA', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO', '', '2020-10-09', '2020-10-09', NULL, 10, 10, 6, 1, '2020-10-09 22:11:45', 'vigente');
INSERT INTO `documentacion` VALUES (29, 'CER-21', '', 'SEGUNDO FABIAN CASTILLO MONTOYA', '10266343391', 'CARRETERA JESUS-CAJAMARCA KM 1264+145 CASERÍO LA COLPA  JESUS CAJAMARCA CAJAMARCA', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO', '', '2020-10-09', '2020-10-09', NULL, 10, 10, 6, 1, '2020-10-09 22:16:47', 'vigente');
INSERT INTO `documentacion` VALUES (30, 'CER-22', '', 'SEGUNDO FABIAN CASTILLO MONTOYA', '10266343391', 'CARRETERA JESUS-CAJAMARCA KM 1264+145 CASERÍO LA COLPA  JESUS CAJAMARCA CAJAMARCA', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO', '', '2020-10-09', '2020-10-09', NULL, 10, 10, 6, 1, '2020-10-09 22:21:27', 'vigente');
INSERT INTO `documentacion` VALUES (31, 'CER-23', '', 'RAUL LUCHO CHAVEZ ALVAREZ', '10267334850', 'AV. VIA DE EVITAMIENTO NORTE N°621  CAJAMARCA-CAJAMARCA-CAJAMARCA', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO', '', '2020-10-09', '2020-10-09', NULL, 10, 10, 7, 1, '2020-10-09 22:30:03', 'vigente');
INSERT INTO `documentacion` VALUES (32, 'CER-24', '', 'RAUL LUCHO CHAVEZ ALVAREZ', '10267334850', 'AV. VIA DE EVITAMIENTO NORTE N°621  CAJAMARCA-CAJAMARCA-CAJAMARCA', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO', '', '2020-10-09', '2020-10-09', NULL, 10, 10, 7, 1, '2020-10-09 22:33:24', 'vigente');
INSERT INTO `documentacion` VALUES (33, 'CER-25', '', 'RAUL LUCHO CHAVEZ ALVAREZ', '10267334850', 'AV. VIA DE EVITAMIENTO NORTE N°621  CAJAMARCA-CAJAMARCA-CAJAMARCA', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO', '', '2020-10-09', '2020-10-09', NULL, 10, 10, 7, 1, '2020-10-09 22:51:33', 'vigente');
INSERT INTO `documentacion` VALUES (34, 'CT-1', '', 'ESTACION DE GASOLINA JESÚS DE NAZARETH S.R.L.', '20491647770', 'km. 126 _c.p. san sebastián  CHOROPAMPA  CAJAMARCA  CAJAMARCA ', NULL, 1, 'CERTIFICADO ', NULL, '2020-10-09', '2020-10-09', NULL, 12, 12, 0, 1, '2020-10-09 22:57:24', 'vigente');
INSERT INTO `documentacion` VALUES (35, 'CT-2', '', 'EMPRESA MULTISERVICIOS GENERALES DUQUE JAN EL MAGNATE E.I.R.L.', '20601835089', 'CARRETERA CAJAMARCA CELENDIN SECTOR CHIMCHIM CHUQUIPUQUIO  CP PUYLLUCANA  BAÑOS DEL INCA  CAJAMARCA ', NULL, 1, 'CERTIFICADO ', '', '2020-10-14', '2020-10-14', NULL, 12, 12, 11, 1, '2020-10-14 18:59:27', 'vigente');
INSERT INTO `documentacion` VALUES (36, 'CT-3', '', 'SAN JUAN DE CHOTA DUQUE JAN E.I.R.L.', '20491685434', 'KM. 2.5 CARRETERA A BAMBAMARCA CAS.SAN FRANCISCO DE ASIS CAJAMARCA  CAJAMARCA  CAJAMARCA', NULL, 1, 'CERTIFICADO ', '', '2020-10-14', '2020-10-14', NULL, 12, 12, 10, 1, '2020-10-14 19:06:07', 'vigente');
INSERT INTO `documentacion` VALUES (37, 'CT-4', '', 'GRIFO CONTINENTAL S.A.C.', '20453552846', 'JR .ANGAMOS N° 1108 CAJAMARCA  CAJAMARCA  CAJAMARCA ', NULL, 1, 'CERTIFICADO ', '', '2020-10-14', '2020-10-14', NULL, 12, 12, 9, 1, '2020-10-14 19:10:45', 'vigente');
INSERT INTO `documentacion` VALUES (38, 'CT-5', '', 'GRIFO CONTINENTAL S.A.C.', '20453552846', 'JCARR.CIUDAD DE DIOS CAJAMARCA M5 VALLE JEQUETEPEQUE, PRED. LIMONCARRO  GUADALUPE LA LIBERTAD.', NULL, 1, 'CERTIFICADO ', '', '2020-10-14', '2020-10-14', NULL, 12, 12, 9, 1, '2020-10-14 19:17:24', 'vigente');
INSERT INTO `documentacion` VALUES (39, 'CT-6', '', 'GRIFO CONTINENTAL S.A.C.', '20453552846', 'AV. VÍA DE EVITAMIENTO NORTE S/N SECTOR 5  LA ALAMEDA 2DA ETAPA  CAJAMARCA CAJAMARCA CAJAMARCA.', NULL, 1, 'CERTIFICADO ', '', '2020-10-14', '2020-10-14', NULL, 12, 12, 9, 1, '2020-10-14 19:22:19', 'vigente');
INSERT INTO `documentacion` VALUES (40, 'CT-7', '', 'GRIFO CONTINENTAL S.A.C.', '20453552846', 'CARR. CAJAMARCA CHILETE KM 2 SECTOR SUR  CAJAMARCA CAJAMARCA CAJAMARCA.', NULL, 1, 'CERTIFICADO ', '', '2020-10-14', '2020-10-14', NULL, 12, 12, 9, 1, '2020-10-14 19:27:05', 'vigente');
INSERT INTO `documentacion` VALUES (41, 'CT-8', '', 'EL OVALO ESTACION & SERVICIOS GENERALES S.R.L.', '20529654546', 'AV. SAN MARTIN DE PORRES N°2475 CAJAMARCA-CAJAMARCA-CAJAMARCA', NULL, 1, 'CERTIFICADO ', '', '2020-10-14', '2020-10-14', NULL, 12, 12, 5, 1, '2020-10-14 19:33:35', 'vigente');
INSERT INTO `documentacion` VALUES (42, 'CT-9', '', 'CODELMAR S.A.C.', '20603594267', 'AV. VIA DE EVITAMIENTO NORTE N° 1829 CAJAMARCA  CAJAMARCA  CAJAMARCA.', NULL, 1, 'CERTIFICADO ', '', '2020-10-14', '2020-10-14', NULL, 12, 12, 12, 1, '2020-10-14 22:18:09', 'vigente');
INSERT INTO `documentacion` VALUES (43, 'CT-10', '', 'INVERSIONES Y SERVICIOS LEO', '20529375663', 'CARRETERA A JAESUS  MZ A LOTE S/N  CAS. HUACARIZ  CAJAMARCA CAJAMARCA CAJAMARCA.', NULL, 1, 'CERTIFICADO ', '', '2020-10-23', '2020-10-23', NULL, 12, 12, 0, 1, '2020-10-23 19:53:37', 'vigente');
INSERT INTO `documentacion` VALUES (44, 'CER-26', '', 'DIOMENEZ FERNANDEZ DIAZ', '10441581977', 'CARRETERA FERNANDO BELAUNDE TERRY Y A CALLE COMERCIO  CASERIO PUENTE TECHIN PUCARA_JAEN_CAJAMARCA', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO', NULL, '2020-12-10', '2020-12-10', NULL, 10, 10, 14, 1, '2020-12-10 19:31:30', 'anulado');
INSERT INTO `documentacion` VALUES (45, 'CER-27', '', 'DIOMENEZ FERNANDEZ DIAZ', '10441581977', 'CARRETERA FERNANDO BELAUNDE TERRY Y A CALLE COMERCIO  CASERIO PUENTE TECHIN PUCARA_JAEN_CAJAMARCA', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO', NULL, '2020-12-10', '2020-12-10', NULL, 10, 10, 14, 1, '2020-12-10 19:37:35', 'anulado');
INSERT INTO `documentacion` VALUES (46, 'CER-28', '', 'DIOMENES FERNANDEZ DIAZ', '10441581977', 'CARRETERA FERNANDO BELAUNDE TERRY Y A CALLE COMERCIO  CASERIO PUENTE TECHIN PUCARA_JAEN_CAJAMARCA', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO', '', '2020-12-10', '2020-12-10', NULL, 10, 10, 14, 1, '2020-12-10 19:44:19', 'vigente');
INSERT INTO `documentacion` VALUES (47, 'CER-29', '', 'DIOMENEZ FERNANDEZ DIAZ', '10441581977', 'CARRETERA FERNANDO BELAUNDE TERRY Y A CALLE COMERCIO  CASERIO PUENTE TECHIN PUCARA_JAEN_CAJAMARCA', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO', '', '2020-12-10', '2020-12-10', NULL, 10, 10, 14, 1, '2020-12-10 19:50:17', 'vigente');
INSERT INTO `documentacion` VALUES (48, 'CER-30', '', 'DIOMENES FERNANDEZ DIAZ', '10441581977', 'CARRETERA FERNANDO BELAUNDE TERRY Y A CALLE COMERCIO  CASERIO PUENTE TECHIN PUCARA_JAEN_CAJAMARCA', NULL, 1, 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE ESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO', '', '2020-12-10', '2020-12-10', NULL, 10, 10, 14, 1, '2020-12-10 19:54:01', 'vigente');

-- ----------------------------
-- Table structure for empresa
-- ----------------------------
DROP TABLE IF EXISTS `empresa`;
CREATE TABLE `empresa`  (
  `idempresa` int(11) NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `direccion` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ruc` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `web` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `correo` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `contacto` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `frase` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`idempresa`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of empresa
-- ----------------------------

-- ----------------------------
-- Table structure for envio_electronico
-- ----------------------------
DROP TABLE IF EXISTS `envio_electronico`;
CREATE TABLE `envio_electronico`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idmaster` int(11) NULL DEFAULT NULL,
  `tipo` int(20) NULL DEFAULT NULL,
  `correlativo` int(11) NULL DEFAULT NULL,
  `serie` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `sunat_description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `sunat_note` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `sunat_responsecode` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `sunat_soap_error` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `aceptada_por_sunat` tinyint(1) NULL DEFAULT NULL,
  `usuario_envio` int(11) NULL DEFAULT NULL,
  `envio_pse` tinyint(1) NULL DEFAULT 0,
  `fecha_envio` datetime NULL DEFAULT NULL,
  `fecha_mod` datetime NULL DEFAULT NULL,
  `estado_envio` char(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `tipoenvio` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `fecha_emi` datetime NULL DEFAULT NULL,
  `enlace` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of envio_electronico
-- ----------------------------

-- ----------------------------
-- Table structure for error_envio_electronico
-- ----------------------------
DROP TABLE IF EXISTS `error_envio_electronico`;
CREATE TABLE `error_envio_electronico`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `errors` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `idmaster` int(255) NULL DEFAULT NULL,
  `fecha` datetime NULL DEFAULT NULL,
  `tipo_envio` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `codigo` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `usuario_envio` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of error_envio_electronico
-- ----------------------------

-- ----------------------------
-- Table structure for kardex
-- ----------------------------
DROP TABLE IF EXISTS `kardex`;
CREATE TABLE `kardex`  (
  `idkardex` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `producto_idproducto` int(11) NULL DEFAULT NULL,
  `tienda_idtienda` int(11) NULL DEFAULT NULL,
  `descripcion` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `idpresentacion` int(11) NULL DEFAULT NULL,
  `cantidaxpresentacion` int(255) NULL DEFAULT NULL,
  `precioxpresentacion` decimal(18, 2) NULL DEFAULT NULL,
  `cantidad` int(255) NULL DEFAULT NULL,
  `fecha_hora` datetime NULL DEFAULT NULL,
  `tipo_movimiento` enum('entrada','salida') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'salida',
  `motivo` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `codmotivo` int(11) NULL DEFAULT NULL,
  `stock_actual` int(11) NULL DEFAULT NULL,
  `estado` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  PRIMARY KEY (`idkardex`) USING BTREE,
  INDEX `producto_idproducto`(`producto_idproducto`) USING BTREE,
  INDEX `stock_idstock`(`tienda_idtienda`) USING BTREE,
  CONSTRAINT `kardex_ibfk_1` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kardex
-- ----------------------------

-- ----------------------------
-- Table structure for marca
-- ----------------------------
DROP TABLE IF EXISTS `marca`;
CREATE TABLE `marca`  (
  `idmarca` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `estado` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  PRIMARY KEY (`idmarca`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 57 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of marca
-- ----------------------------
INSERT INTO `marca` VALUES (1, 'RED JAKET ', 'Activo');
INSERT INTO `marca` VALUES (2, 'CIVACON', 'Activo');
INSERT INTO `marca` VALUES (3, 'FE PETRO', 'Activo');
INSERT INTO `marca` VALUES (4, 'CIM TEK', 'Activo');
INSERT INTO `marca` VALUES (5, 'OPW', 'Activo');
INSERT INTO `marca` VALUES (6, 'GENNERAL CABLE', 'Activo');
INSERT INTO `marca` VALUES (7, 'TOKHEIM', 'Activo');
INSERT INTO `marca` VALUES (8, 'GILBARCO VEEDER-ROOT', 'Activo');
INSERT INTO `marca` VALUES (9, 'WAYNE', 'Activo');
INSERT INTO `marca` VALUES (10, 'FILL-RITE', 'Activo');
INSERT INTO `marca` VALUES (11, 'DIXON PUMPS', 'Activo');
INSERT INTO `marca` VALUES (12, 'CATLOW', 'Activo');
INSERT INTO `marca` VALUES (13, 'SERAPHIN', 'Activo');
INSERT INTO `marca` VALUES (14, 'INCON', 'Activo');
INSERT INTO `marca` VALUES (15, 'CORKEN', 'Activo');
INSERT INTO `marca` VALUES (16, 'KOLOR KUT', 'Activo');
INSERT INTO `marca` VALUES (17, 'GASBOY', 'Activo');
INSERT INTO `marca` VALUES (18, 'BLACKMER', 'Activo');
INSERT INTO `marca` VALUES (19, 'EMCO', 'Activo');
INSERT INTO `marca` VALUES (20, 'EBLU', 'Activo');
INSERT INTO `marca` VALUES (21, 'SAMOA', 'Activo');
INSERT INTO `marca` VALUES (22, 'TRAVAINI PUMPS', 'Activo');
INSERT INTO `marca` VALUES (23, 'CHIBLI', 'Activo');
INSERT INTO `marca` VALUES (24, 'ILTRON', 'Activo');
INSERT INTO `marca` VALUES (25, 'RED SEAL MEASUREMENT', 'Activo');
INSERT INTO `marca` VALUES (26, 'SOTERA', 'Activo');
INSERT INTO `marca` VALUES (27, 'ADEL WIGGINS', 'Activo');
INSERT INTO `marca` VALUES (28, 'GASOILA', 'Activo');
INSERT INTO `marca` VALUES (29, 'GLOBAL KRAUS', 'Activo');
INSERT INTO `marca` VALUES (30, 'PREVENT', 'Activo');
INSERT INTO `marca` VALUES (31, 'GASLIN', 'Activo');
INSERT INTO `marca` VALUES (32, 'AILE', 'Activo');
INSERT INTO `marca` VALUES (33, 'MAIDE', 'Activo');
INSERT INTO `marca` VALUES (34, 'SOMAR', 'Activo');
INSERT INTO `marca` VALUES (35, 'MORRISON', 'Activo');
INSERT INTO `marca` VALUES (36, 'INDECO', 'Activo');
INSERT INTO `marca` VALUES (37, 'ABB', 'Activo');
INSERT INTO `marca` VALUES (38, 'SCHNEIDER', 'Activo');
INSERT INTO `marca` VALUES (39, 'SIEMENS', 'Activo');
INSERT INTO `marca` VALUES (40, 'GENERAL ELECTRIC', 'Activo');
INSERT INTO `marca` VALUES (41, 'CICLON', 'Activo');
INSERT INTO `marca` VALUES (42, 'APOLLO', 'Activo');
INSERT INTO `marca` VALUES (43, 'COLD WHITE', 'Activo');
INSERT INTO `marca` VALUES (44, 'REWALT', 'Activo');
INSERT INTO `marca` VALUES (45, 'ANODO DE MAGNESIO', 'Activo');
INSERT INTO `marca` VALUES (46, 'TUBO  SCH-40', 'Activo');
INSERT INTO `marca` VALUES (47, 'CIFUNZA', NULL);
INSERT INTO `marca` VALUES (48, 'MECH', 'Activo');
INSERT INTO `marca` VALUES (49, 'COOPER HINS', 'Activo');
INSERT INTO `marca` VALUES (50, 'APLETON', 'Activo');
INSERT INTO `marca` VALUES (51, 'GILBARCO', 'Activo');
INSERT INTO `marca` VALUES (52, 'BALFLEX', 'Activo');
INSERT INTO `marca` VALUES (53, 'ENERGIT', 'Activo');
INSERT INTO `marca` VALUES (54, 'AGA', 'Activo');
INSERT INTO `marca` VALUES (55, 'JG', 'Activo');
INSERT INTO `marca` VALUES (56, 'SERVICIO', 'Activo');

-- ----------------------------
-- Table structure for movimiento
-- ----------------------------
DROP TABLE IF EXISTS `movimiento`;
CREATE TABLE `movimiento`  (
  `idmovimiento` int(11) NOT NULL AUTO_INCREMENT,
  `tienda_idtienda` int(11) NULL DEFAULT NULL,
  `tipo_comprobante` int(11) NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `colaborador_idcolaborador` int(11) NULL DEFAULT NULL,
  `estado` enum('vigente','anulado') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'vigente',
  `nro_documento` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `total` decimal(18, 2) NULL DEFAULT NULL,
  `observacion` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fecha_creacion` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`idmovimiento`) USING BTREE,
  INDEX `tienda_idtienda`(`tienda_idtienda`) USING BTREE,
  INDEX `colaborador_idcolaborador`(`colaborador_idcolaborador`) USING BTREE,
  CONSTRAINT `movimiento_ibfk_1` FOREIGN KEY (`tienda_idtienda`) REFERENCES `tienda` (`idtienda`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `movimiento_ibfk_2` FOREIGN KEY (`colaborador_idcolaborador`) REFERENCES `colaborador` (`idcolaborador`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of movimiento
-- ----------------------------

-- ----------------------------
-- Table structure for orden_compra
-- ----------------------------
DROP TABLE IF EXISTS `orden_compra`;
CREATE TABLE `orden_compra`  (
  `idcompra` int(11) NOT NULL AUTO_INCREMENT,
  `tienda_idtienda` int(11) NULL DEFAULT NULL,
  `proveedor_idproveedor` int(11) NULL DEFAULT NULL,
  `observacion` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `total` decimal(18, 2) NULL DEFAULT NULL,
  `subtotal` decimal(18, 2) NULL DEFAULT NULL,
  `fecha_creacion` datetime NULL DEFAULT NULL,
  `estado` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  `correlativo` int(11) NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `nrocomprobante` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `autogenerado` enum('NO','SI') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `modificado` enum('NO','SI') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idcompra`) USING BTREE,
  INDEX `proveedor_idproveedor`(`proveedor_idproveedor`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orden_compra
-- ----------------------------

-- ----------------------------
-- Table structure for parametros
-- ----------------------------
DROP TABLE IF EXISTS `parametros`;
CREATE TABLE `parametros`  (
  `idparametro` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `valor` decimal(10, 4) NULL DEFAULT NULL,
  `texto` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `descripcion` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`idparametro`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of parametros
-- ----------------------------

-- ----------------------------
-- Table structure for periodo_pago
-- ----------------------------
DROP TABLE IF EXISTS `periodo_pago`;
CREATE TABLE `periodo_pago`  (
  `idperiodo_pago` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `abreviatura` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `estado` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  PRIMARY KEY (`idperiodo_pago`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of periodo_pago
-- ----------------------------
INSERT INTO `periodo_pago` VALUES (1, 'Contado', 'cont.', 'Activo');
INSERT INTO `periodo_pago` VALUES (2, 'Crédito', 'cred.', 'Activo');

-- ----------------------------
-- Table structure for presentacion
-- ----------------------------
DROP TABLE IF EXISTS `presentacion`;
CREATE TABLE `presentacion`  (
  `idpresentacion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `descripcion` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `abreviatura` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `codsunat` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `estado` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  PRIMARY KEY (`idpresentacion`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of presentacion
-- ----------------------------
INSERT INTO `presentacion` VALUES (1, 'KILOGRAMOS\r\n', '', 'KG', '01', 'Activo');
INSERT INTO `presentacion` VALUES (2, 'LIBRAS\r\n', '', 'LB', '02', 'Activo');
INSERT INTO `presentacion` VALUES (3, 'TONELADAS LARGAS\r\n', '', 'TL', '03', 'Activo');
INSERT INTO `presentacion` VALUES (4, 'TONELADAS MÉTRICAS\r\n', '', 'TM', '04', 'Activo');
INSERT INTO `presentacion` VALUES (5, 'TONELADAS CORTAS\r\n', '', 'TC', '05', 'Activo');
INSERT INTO `presentacion` VALUES (6, 'GRAMOS\r\n', '', 'GR', '06', 'Activo');
INSERT INTO `presentacion` VALUES (7, 'UNIDADES\r\n', '', 'UND', '07', 'Activo');
INSERT INTO `presentacion` VALUES (8, 'LITROS\r\n', '', 'LT', '08', 'Activo');
INSERT INTO `presentacion` VALUES (9, 'GALONES\r\n', '', 'GL', '09', 'Activo');
INSERT INTO `presentacion` VALUES (10, 'BARRILES\r\n', '', 'BR', '10', 'Activo');
INSERT INTO `presentacion` VALUES (11, 'LATAS\r\n', '', 'LAT', '11', 'Activo');
INSERT INTO `presentacion` VALUES (12, 'CAJAS\r\n', '', 'CJA', '12', 'Activo');
INSERT INTO `presentacion` VALUES (13, 'MILLARES\r\n', '', 'MIL', '13', 'Activo');
INSERT INTO `presentacion` VALUES (14, 'METROS CÚBICOS\r\n', '', 'MC3', '14', 'Activo');
INSERT INTO `presentacion` VALUES (15, 'METROS\r\n', '', 'MTS', '15', 'Activo');
INSERT INTO `presentacion` VALUES (16, 'OTROS (ESPECIFICAR)\r\n', '', ' ', '99', 'Activo');

-- ----------------------------
-- Table structure for producto
-- ----------------------------
DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto`  (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `marca_idmarca` int(11) NULL DEFAULT NULL,
  `categoria_idcategoria` int(11) NULL DEFAULT NULL,
  `tipo` enum('producto','servicio') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'producto',
  `codproducto` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `codbarras` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nombre` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `descripcion` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `presentacion_minima` int(11) NULL DEFAULT NULL,
  `foto` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `estado` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  PRIMARY KEY (`idproducto`) USING BTREE,
  INDEX `marca_idmarca`(`marca_idmarca`) USING BTREE,
  INDEX `categoria_idcategoria`(`categoria_idcategoria`) USING BTREE,
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`marca_idmarca`) REFERENCES `marca` (`idmarca`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`categoria_idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 109 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of producto
-- ----------------------------
INSERT INTO `producto` VALUES (1, 32, 4, 'producto', 'A2101-11A', NULL, 'pistola automática 3/4\"', NULL, 12, 'e354a-pistola.jpg', 'Activo');
INSERT INTO `producto` VALUES (2, 32, 4, 'producto', 'A2101-11A', NULL, 'codo giratorio 3/4\"', NULL, 12, '52a75-codo-giratorio.jpg', 'Activo');
INSERT INTO `producto` VALUES (3, 32, 4, 'producto', 'BC-YC 801', NULL, 'breakaway  3/4\"', NULL, 12, '6e7db-breacawey.jpg', 'Activo');
INSERT INTO `producto` VALUES (4, 4, 4, 'producto', '400-30    # 70016', NULL, 'filtro 1\"  70016', NULL, 12, '2ef02-filtros.jpg', 'Activo');
INSERT INTO `producto` VALUES (5, 4, 4, 'producto', '300-30 # 70012', NULL, 'filtro 3/4\" 70012', NULL, 12, '4fed1-filtros.jpg', 'Activo');
INSERT INTO `producto` VALUES (6, 4, 4, 'producto', '800-30 # 70020', NULL, 'filtro 1\" 70020', NULL, 12, '7ddd1-filtros.jpg', 'Activo');
INSERT INTO `producto` VALUES (7, 32, 4, 'producto', 'A-120L', NULL, 'pistola automatica 1\"', NULL, 12, 'c6e52-pistola.jpg', 'Activo');
INSERT INTO `producto` VALUES (8, 16, 4, 'producto', 'BOX 5415', NULL, 'pasta de medicion', NULL, 12, '90ab4-pastas.jpg', 'Activo');
INSERT INTO `producto` VALUES (9, 16, 4, 'producto', 'BOX- 5415', NULL, 'pasta prueba de agua', NULL, 12, '8f6d6-pastas.jpg', 'Activo');
INSERT INTO `producto` VALUES (10, 1, 3, 'producto', '0000', NULL, 'bomba sumergible  3/4\" HP', NULL, 16, '63eb2-bomba-sumerguible.jpg', 'Activo');
INSERT INTO `producto` VALUES (11, 1, 3, 'producto', '00000', NULL, 'bomba sumergible 1.5 HP', NULL, 16, 'e0877-bomba-sumerguible.jpg', 'Activo');
INSERT INTO `producto` VALUES (12, 1, 3, 'producto', '000000', NULL, 'bomba sumergible 2HP', NULL, 16, '94042-bomba-sumerguible.jpg', 'Activo');
INSERT INTO `producto` VALUES (13, 3, 3, 'producto', '0000', NULL, 'bomba sumergible  3/4\" HP', NULL, 16, '50d95-descarga.jpg', 'Activo');
INSERT INTO `producto` VALUES (14, 3, 3, 'producto', '000000', NULL, 'bomba sumergible 1.5HP', NULL, 16, 'bc05e-descarga.jpg', 'Activo');
INSERT INTO `producto` VALUES (15, 3, 3, 'producto', '0000', NULL, 'bomba sumergible  2\" HP', NULL, 16, 'c0fe6-descarga.jpg', 'Activo');
INSERT INTO `producto` VALUES (16, 1, 3, 'producto', '00000', NULL, 'cartucho 3/4 HP', NULL, 16, '707f5-cartucho.jpg', 'Activo');
INSERT INTO `producto` VALUES (17, 1, 3, 'producto', '0000', NULL, 'cartucho 1.5HP', NULL, 16, '6cc76-cartucho.jpg', 'Activo');
INSERT INTO `producto` VALUES (18, 1, 3, 'producto', '000', NULL, 'cartucho 2HP', NULL, 16, '68b83-cartucho.jpg', 'Activo');
INSERT INTO `producto` VALUES (19, 3, 3, 'producto', '0000', NULL, 'cartucho 3/4 HP', NULL, 16, 'e39ae-cartucho-fe-petro.jpg', 'Activo');
INSERT INTO `producto` VALUES (20, 46, 1, 'producto', NULL, NULL, 'tubo ac negro schedule sch-40  ASTM A53/A106 S/C 2\" x 6M  ', NULL, 7, '914be-tubo-sch-40-2.jpg', 'Activo');
INSERT INTO `producto` VALUES (21, 46, 1, 'producto', NULL, NULL, 'tubo ac negro  schedule sch-40 ASTM A53/A106 S/C 4\" x  6M  ', NULL, 7, 'af001-tubo-sch-40-4.jpeg', 'Activo');
INSERT INTO `producto` VALUES (22, 48, 1, 'producto', NULL, NULL, 'codo x90° fierro negro class 150 2\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (23, 48, 1, 'producto', NULL, NULL, 'codo x45° fierro negro class150 2\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (24, 48, 1, NULL, NULL, NULL, 'union universal fierro negro class150 2\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (25, 48, 1, 'producto', NULL, NULL, 'union universal fierro negro class150 1 1/2\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (26, 48, 1, 'producto', NULL, NULL, 'tapon macho fierro negro class150 3\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (27, 48, 1, 'producto', NULL, NULL, 'tapon macho fierro negro class150 2\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (28, 48, 1, 'producto', NULL, NULL, 'reduccion bushing fierro negro class150 4\" x 2\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (29, 48, 1, 'producto', NULL, NULL, 'reduccion bushing fierro negro class150 2\" x 1/2\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (30, 46, 1, 'producto', NULL, NULL, 'niple acero sch-40 1 1/2\" x 1 1/2\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (31, 46, 1, 'producto', NULL, NULL, 'niple acero sch-40 2\" x 1 1/2\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (32, 46, 1, 'producto', NULL, NULL, 'niple acero sch-40 2\" x 2\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (33, 46, 1, 'producto', NULL, NULL, 'niple acero sch-40 2\" x 3\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (34, 46, 1, 'producto', NULL, NULL, 'niple acero sch-40 2\" x 4\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (35, 46, 1, 'producto', NULL, NULL, 'niple acero sch-40 2\" x 4\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (36, 46, 1, 'producto', NULL, NULL, 'niple acero sch-40 2\" x 5\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (37, 46, 1, 'producto', NULL, NULL, 'niple acero sch-40 2\" x 6\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (38, 46, 1, 'producto', NULL, NULL, 'brida roscada sch-40 150lbs 2\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (39, 48, 1, 'producto', NULL, NULL, 'tee fierro negro cla150 2\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (40, 48, 1, 'producto', NULL, NULL, 'union simple fierro negro class150 2\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (41, 32, 2, 'producto', NULL, NULL, 'acople con espiga 4\" x 4\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (42, 32, 3, 'producto', NULL, NULL, 'codo para descarga de combustible (codo visor)', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (43, 52, 4, 'producto', NULL, NULL, 'manguera prensada de 3/4\" x 4M verde', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (44, 52, 4, 'producto', NULL, NULL, 'manguera prensada de 3/4\" x 4M roja', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (45, 52, 4, 'producto', NULL, NULL, 'manguera prensada de 3/4\" x 4M negra', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (46, 52, 4, 'producto', NULL, NULL, 'manguera prensada 3/4\" x 4M azul', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (47, 52, 2, 'producto', NULL, NULL, 'manguera de descarga con alambre de  pvc 4\"', NULL, 15, NULL, 'Activo');
INSERT INTO `producto` VALUES (48, 52, 2, 'producto', NULL, NULL, 'manguera turbo de recuperacion de vapor 3\"', NULL, 15, NULL, 'Activo');
INSERT INTO `producto` VALUES (49, 44, 6, 'producto', NULL, NULL, 'sello antiexplosivo conduit 3/4\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (50, 44, 6, 'producto', NULL, NULL, 'sello antiexplosivo conduit 1\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (51, 44, 6, 'producto', NULL, NULL, 'sello antiexplosivo conduit 1/2\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (52, 32, 3, 'producto', NULL, NULL, 'adaptador c/ tapa hermetica 2\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (53, 32, 3, 'producto', NULL, NULL, 'adaptador c/ tapa 4\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (54, 32, 3, 'producto', NULL, NULL, 'super cruceta npt importado 3\" x 3\" x 2\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (55, 32, 3, 'producto', NULL, NULL, 'valvula de venteo diesel 2\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (56, 32, 3, 'producto', NULL, NULL, 'valvula de venteo gasolina (presion al vasio) 2\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (57, 32, 3, 'producto', NULL, NULL, 'valvula de sobrellenado 4\" j.s', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (58, 32, 4, 'producto', NULL, NULL, 'valvula de emergencia 1 1/2\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (59, 1, 3, 'producto', NULL, NULL, 'detector de fuga t/r jacket', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (60, 32, 3, 'producto', NULL, NULL, 'spill container ', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (61, 28, 3, 'producto', NULL, NULL, 'sellador de tuberia de 1/2 pt 437 ml azul', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (62, 44, 4, 'producto', NULL, NULL, 'manguera flexible 11/2\" x 50cm ', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (63, 44, 4, 'producto', NULL, NULL, 'manguera flexible 2\" x 40 cm', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (64, 44, 6, 'producto', NULL, NULL, 'manguera flexible 3/4\" x 50cm', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (65, 44, 6, 'producto', NULL, NULL, 'manguera flexible de 1\" x 50 cm', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (66, 53, 6, 'producto', NULL, NULL, 'estabilizador 110v 250v/ 5000w', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (67, 53, 6, 'producto', NULL, NULL, 'estabilizador 110v 250v / 3000w', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (68, 53, 6, 'producto', NULL, NULL, 'transformador de aislamiento 5kva', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (69, 53, 6, 'producto', NULL, NULL, 'transformador de aislamiento de 3kva', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (70, 32, 3, 'producto', NULL, NULL, 'cruceta de valvula flotante 4\" x 4\" x 3\" x 2\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (71, 32, 3, 'producto', NULL, NULL, 'adaptador c/ tapa hermetica para RV 4\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (72, 38, 6, 'producto', NULL, NULL, 'varilla de cobre para poso tierra 5/8\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (73, 36, 6, 'producto', NULL, NULL, 'cable thw awg # 12', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (74, 36, 6, 'producto', NULL, NULL, 'cable thw awg # 14', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (75, 36, 6, 'producto', NULL, NULL, 'cable ctp verde amarillo conexion tierra # 6', NULL, 15, NULL, 'Activo');
INSERT INTO `producto` VALUES (76, 36, 6, 'producto', NULL, NULL, 'cable thw awg # 4', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (77, 45, 3, 'producto', NULL, NULL, 'anodo de magnesio para proteccion catodica', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (78, 53, 6, 'producto', NULL, NULL, 'reflector canopy led  gl-gs04  80w', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (79, 53, 6, 'producto', NULL, NULL, 'reflector canopy led gl-gs04  100w', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (80, 7, 4, 'producto', NULL, NULL, 'teclado tokheim premier b usa', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (81, 10, 2, 'producto', NULL, NULL, 'bomba t / fill rite 12v x 25 gpm', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (82, 50, 6, 'producto', NULL, NULL, 'compusto  sellante ', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (83, 8, 4, 'producto', NULL, NULL, 'teclado encore 500', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (84, 8, 4, 'producto', NULL, NULL, 'teclado de programación interna  encore 500', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (85, 8, 4, 'producto', NULL, NULL, 'teclado encore 300', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (86, 54, 3, 'producto', NULL, NULL, 'cinta teflon amarilla de 1/2\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (87, 8, 4, 'producto', NULL, NULL, 'dispensador gilbarco encore 500 s  4x8 ', '• Computador Electrónico Modular para 110V, 60Hz. Sistema de placas con microprocesadores.  • Electrónica LON (Local Operating Network)  • Diagnóstico o programación en forma remota  • Logs para almac', 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (88, 8, 4, 'producto', NULL, NULL, 'dispensador gilbarco encore 500 s  4x8  repotenciado', '• Computador Electrónico Modular para 110V, 60Hz. Sistema de placas con microprocesadores.  • Electrónica LON (Local Operating Network)  • Diagnóstico o programación en forma remota  • Logs para almac', 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (89, 55, 6, 'producto', NULL, NULL, 'tablero de distribución 24 polos  trifasico', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (90, 55, 6, 'producto', NULL, NULL, 'tablero general 24 polos trifasico', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (91, 55, 3, 'producto', NULL, NULL, 'tapas nacionales jg 13\"', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (92, 56, 9, 'servicio', NULL, NULL, 'servicio de instalaciones mecanica y electricas de grifo y estación de servicios hasta la puesta en ', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (93, 42, 3, 'producto', NULL, NULL, 'valvula esferica 2\" 600 wob ', NULL, 12, NULL, 'Activo');
INSERT INTO `producto` VALUES (94, 38, 4, 'producto', NULL, NULL, 'punta para rayos 3 pines ', NULL, 12, NULL, 'Activo');
INSERT INTO `producto` VALUES (95, 3, 3, 'producto', NULL, NULL, 'tanque de almacenamiento de combustible plancha de 1/4\" de espesor ', NULL, 9, NULL, 'Activo');
INSERT INTO `producto` VALUES (96, 55, 3, 'producto', NULL, NULL, 'contenedor nacional 13\" jg ', NULL, 12, NULL, 'Activo');
INSERT INTO `producto` VALUES (97, 55, 6, 'producto', NULL, NULL, 'tablero general 24 polos trifasico', NULL, 12, NULL, 'Activo');
INSERT INTO `producto` VALUES (98, 47, 3, 'producto', NULL, NULL, 'bushing de 2\" a  1 1/2\" 150 lbs ', NULL, 12, NULL, 'Activo');
INSERT INTO `producto` VALUES (99, 1, 3, 'producto', NULL, NULL, 'detector de fugas ', NULL, 12, NULL, 'Activo');
INSERT INTO `producto` VALUES (100, 54, 3, 'producto', NULL, NULL, 'teflon amarillo 1/2\"', NULL, 12, NULL, 'Activo');
INSERT INTO `producto` VALUES (101, 54, 3, 'producto', NULL, NULL, 'GASOILA', NULL, 12, NULL, 'Activo');
INSERT INTO `producto` VALUES (102, 55, 9, 'servicio', NULL, NULL, 'TECHO DE PROYECCION CANOPY', NULL, 12, NULL, 'Activo');
INSERT INTO `producto` VALUES (103, 50, 6, 'producto', NULL, NULL, 'cajas rewalt 1/2\"', NULL, 12, NULL, 'Activo');
INSERT INTO `producto` VALUES (104, 50, 6, 'producto', NULL, NULL, 'tubos conduit ', NULL, 12, NULL, 'Activo');
INSERT INTO `producto` VALUES (105, 55, 6, 'producto', NULL, NULL, 'cable dixon cat 6 utp', NULL, 12, NULL, 'Activo');
INSERT INTO `producto` VALUES (106, 55, 6, NULL, NULL, NULL, 'tothem led 2 mts x 9mts ', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (107, 55, 6, 'servicio', NULL, NULL, 'tothem 2 x 9mts', NULL, 7, NULL, 'Activo');
INSERT INTO `producto` VALUES (108, 8, 4, NULL, 'DISPENSADOR ENCORE 500S NA3', NULL, '•	Computador Electrónico Modular para 220V, 60Hz. Sistema de placas con microprocesadores. •	Electró', NULL, 7, NULL, 'Activo');

-- ----------------------------
-- Table structure for proforma
-- ----------------------------
DROP TABLE IF EXISTS `proforma`;
CREATE TABLE `proforma`  (
  `idproforma` int(11) NOT NULL AUTO_INCREMENT,
  `nro_documento` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nro_pre_documento` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cliente_razon_social` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cliente_documento` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cliente_direccion` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `contacto` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `colaborador_idcolaborador` int(11) NULL DEFAULT NULL,
  `observacion` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fecha_emision` date NULL DEFAULT NULL,
  `fecha_vencimiento` date NULL DEFAULT NULL,
  `total` decimal(18, 2) NULL DEFAULT NULL,
  `serie_comprobante_idserie_comprobante` int(11) NULL DEFAULT NULL,
  `tipo_comprobante_idtipo_comprobante` int(11) NULL DEFAULT NULL,
  `periodo_pago_idperiodo_pago` int(11) NULL DEFAULT NULL,
  `tipo_pago_idtipo_pago` int(11) NULL DEFAULT NULL,
  `cliente_idcliente` int(11) NULL DEFAULT NULL,
  `tienda_idtienda` int(11) NULL DEFAULT NULL,
  `fecha_creacion` datetime NULL DEFAULT NULL,
  `subtotal` decimal(18, 2) NULL DEFAULT NULL,
  `igv` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `descuento` decimal(18, 2) NULL DEFAULT NULL,
  `estado` enum('vigente','anulado','atendido') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'vigente',
  PRIMARY KEY (`idproforma`) USING BTREE,
  INDEX `colaborador_idcolaborador`(`colaborador_idcolaborador`) USING BTREE,
  INDEX `serie`(`serie_comprobante_idserie_comprobante`) USING BTREE,
  INDEX `tipo_pago`(`tipo_pago_idtipo_pago`) USING BTREE,
  INDEX `periodo_pago`(`periodo_pago_idperiodo_pago`) USING BTREE,
  CONSTRAINT `periodo_pago` FOREIGN KEY (`periodo_pago_idperiodo_pago`) REFERENCES `periodo_pago` (`idperiodo_pago`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `proforma_ibfk_1` FOREIGN KEY (`colaborador_idcolaborador`) REFERENCES `colaborador` (`idcolaborador`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `serie` FOREIGN KEY (`serie_comprobante_idserie_comprobante`) REFERENCES `serie_comprobante` (`idserie_comprobante`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of proforma
-- ----------------------------
INSERT INTO `proforma` VALUES (1, '001-1', '001-1', 'ELIZABETH AZULA PEREZ ', '10457728971', 'PREDIO MOCAN PARCELA 5003 SECTOR LA ARENITA CARRETERA PANAMERICANA NORTE PAIJAN  ASCOPE  LA LIBERTAD', NULL, 1, '', '2020-10-13', '2020-10-13', 176219.00, 2, 2, 1, 1, 8, 1, '2020-10-13 19:44:36', 149338.14, '26880.86', 0.00, 'vigente');
INSERT INTO `proforma` VALUES (2, '001-1', '001-1', 'EMPRESA MULTISERVICIOS GENERALES 777 EL MAGNATE E.I.R.L.', '20605816305', 'KM. 2.5 CARRETERA A BAMBAMARCA CAS.SAN FRANCISCO DE ASIS CAJAMARCA  CAJAMARCA  CAJAMARCA', NULL, 1, '', '2020-10-13', '2020-10-13', 76644.00, 2, 2, 1, 1, 2, 1, '2020-10-13 19:56:24', 64952.54, '11691.46', 0.00, 'vigente');
INSERT INTO `proforma` VALUES (3, '001-3', '001-3', 'ELIZABETH AZULA PEREZ ', '10457728971', 'PREDIO MOCAN PARCELA 5003 SECTOR LA ARENITA CARRETERA PANAMERICANA NORTE PAIJAN  ASCOPE  LA LIBERTAD', NULL, 1, '', '2020-10-13', '2020-10-13', 55145.00, 2, 2, 1, 1, 8, 1, '2020-10-13 20:02:46', 46733.05, '8411.95', 0.00, 'vigente');
INSERT INTO `proforma` VALUES (4, '001-4', '001-4', 'ELIZABETH AZULA PEREZ ', '10457728971', 'PREDIO MOCAN PARCELA 5003 SECTOR LA ARENITA CARRETERA PANAMERICANA NORTE PAIJAN  ASCOPE  LA LIBERTAD', NULL, 1, '', '2020-10-13', '2020-10-13', 108540.00, 2, 2, 1, 1, 8, 1, '2020-10-13 20:07:39', 91983.05, '16556.95', 0.00, 'vigente');
INSERT INTO `proforma` VALUES (5, '001-5', '001-5', 'EMPRESA MULTISERVICIOS GENERALES 777 EL MAGNATE E.I.R.L.', '20605816305', 'KM. 2.5 CARRETERA A BAMBAMARCA CAS.SAN FRANCISCO DE ASIS CAJAMARCA  CAJAMARCA  CAJAMARCA', NULL, 1, '', '2020-10-13', '2020-10-13', 136000.00, 2, 2, 1, 1, 2, 1, '2020-10-13 20:10:30', 115254.24, '20745.76', 0.00, 'vigente');
INSERT INTO `proforma` VALUES (6, '001-6', '001-6', 'EMPRESA MULTISERVICIOS GENERALES 777 EL MAGNATE E.I.R.L.', '20605816305', 'KM. 2.5 CARRETERA A BAMBAMARCA CAS.SAN FRANCISCO DE ASIS CAJAMARCA  CAJAMARCA  CAJAMARCA', NULL, 1, '', '2020-10-13', '2020-10-13', 18000.00, 2, 2, 1, 1, 2, 1, '2020-10-13 20:15:43', 15254.24, '2745.76', 0.00, 'vigente');
INSERT INTO `proforma` VALUES (7, '001-7', '001-7', 'ELIZABETH AZULA PEREZ ', '10457728971', 'PREDIO MOCAN PARCELA 5003 SECTOR LA ARENITA CARRETERA PANAMERICANA NORTE PAIJAN  ASCOPE  LA LIBERTAD', NULL, 1, '', '2020-10-13', '2020-10-13', 40000.00, 2, 2, 1, 1, 8, 1, '2020-10-13 20:17:02', 33898.31, '6101.69', 0.00, 'vigente');
INSERT INTO `proforma` VALUES (8, '001-8', '001-8', 'ELIZABETH AZULA PEREZ ', '10457728971', 'PREDIO MOCAN PARCELA 5003 SECTOR LA ARENITA CARRETERA PANAMERICANA NORTE PAIJAN  ASCOPE  LA LIBERTAD', NULL, 1, '', '2020-10-14', '2020-10-14', 145000.00, 2, 2, 1, 1, 8, 1, '2020-10-14 21:55:04', 122881.36, '22118.64', 0.00, 'vigente');
INSERT INTO `proforma` VALUES (9, '001-9', '001-9', 'ELIZABETH AZULA PEREZ ', '10457728971', 'PREDIO MOCAN PARCELA 5003 SECTOR LA ARENITA CARRETERA PANAMERICANA NORTE PAIJAN  ASCOPE  LA LIBERTAD', NULL, 1, '', '2020-10-14', '2020-10-14', 15000.00, 2, 2, 1, 1, 8, 1, '2020-10-14 22:01:03', 12711.86, '2288.14', 0.00, 'vigente');
INSERT INTO `proforma` VALUES (10, '001-10', '001-10', 'ELIZABETH AZULA PEREZ ', '10457728971', 'PREDIO MOCAN PARCELA 5003 SECTOR LA ARENITA CARRETERA PANAMERICANA NORTE PAIJAN  ASCOPE  LA LIBERTAD', NULL, 1, '', '2020-10-14', '2020-10-14', 23000.00, 2, 2, 1, 1, 8, 1, '2020-10-14 22:07:39', 19491.53, '3508.47', 0.00, 'vigente');
INSERT INTO `proforma` VALUES (11, '001-11', '001-11', 'GRIFO CONTINENTAL S.A.C.', '20453552846', 'JR.ANGAMOS N° 1108 CAJAMARCA  CAJAMARCA  CAJAMARCA ', NULL, 1, '', '2020-10-23', '2020-10-23', 25000.00, 2, 2, 1, 1, 9, 1, '2020-10-23 20:00:26', 21186.44, '3813.56', 0.00, 'vigente');
INSERT INTO `proforma` VALUES (12, '001-12', '001-12', 'GRIFO CONTINENTAL S.A.C.', '20453552846', 'JR.ANGAMOS N° 1108 CAJAMARCA  CAJAMARCA  CAJAMARCA ', NULL, 1, '', '2020-10-23', '2020-10-23', 19548.00, 2, 2, 1, 1, 9, 1, '2020-10-23 20:06:43', 16566.10, '2981.90', 0.00, 'vigente');
INSERT INTO `proforma` VALUES (13, '001-13', '001-13', 'MALAVER SALAZAR ASOCIADOS SAC', '20495843182', 'AV, FRANCISCO JAVIER MARIATEG N° 789  DPTO. 704 URB. SANTA BEATRIZ LIMA-LIMA-JESUS MARIA', NULL, 1, '', '2020-11-20', '2020-11-20', 59943.40, 2, 2, 1, 1, 13, 1, '2020-11-20 15:03:35', 50799.49, '9143.91', 0.00, 'vigente');
INSERT INTO `proforma` VALUES (14, '001-14', '001-14', 'ESTACION DE SERVICIOS ATAHUALPA', '00000000000', 'CHIMBOTE', NULL, 1, '', '2020-11-20', '2020-11-20', 205939.50, 2, 2, 1, 1, 0, 1, '2020-11-20 15:57:15', 174525.00, '31414.50', 0.00, 'vigente');
INSERT INTO `proforma` VALUES (15, '001-15', '001-15', 'ESTACION DE SERVICIOS ATAHUALPA', '0000000000', '', NULL, 1, '', '2020-11-20', '2020-11-20', 141860.00, 2, 2, 1, 1, 0, 1, '2020-11-20 16:04:12', 120220.34, '21639.66', 0.00, 'vigente');
INSERT INTO `proforma` VALUES (16, '001-16', '001-16', 'ESTACION DE SERVICIOS ATAHUALPA', '0000000', '', NULL, 1, '', '2020-11-20', '2020-11-20', 60000.00, 2, 2, 1, 1, 0, 1, '2020-11-20 16:05:35', 50847.46, '9152.54', 0.00, 'vigente');
INSERT INTO `proforma` VALUES (17, '001-17', '001-17', 'ESTACION DE SERVICIS ATAHUALPA', '00000000', '', NULL, 1, '', '2020-11-20', '2020-11-20', 290000.00, 2, 2, 1, 1, 0, 1, '2020-11-20 16:07:17', 245762.71, '44237.29', 0.00, 'vigente');
INSERT INTO `proforma` VALUES (18, '001-18', '001-18', 'CARLOS ALFREDO FAVIAN ', '00000000', '', NULL, 1, '', '2021-01-03', '2021-01-03', 143309.00, 2, 2, 1, 1, 0, 1, '2021-01-03 12:57:13', 121448.31, '21860.69', 0.00, 'vigente');
INSERT INTO `proforma` VALUES (19, '001-19', '001-19', 'CARLOS ALFREDO FAVIAN ROJALES', '00000000', 'CAJABAMBA', NULL, 1, '', '2021-01-03', '2021-01-03', 44800.00, 2, 2, 1, 1, 0, 1, '2021-01-03 13:01:26', 37966.10, '6833.90', 0.00, 'vigente');

-- ----------------------------
-- Table structure for proveedor
-- ----------------------------
DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE `proveedor`  (
  `idproveedor` int(11) NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nombre_comercial` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ruc` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `direccion` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `contacto` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fecha_creacion` datetime NULL DEFAULT NULL,
  `estado` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  PRIMARY KEY (`idproveedor`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of proveedor
-- ----------------------------
INSERT INTO `proveedor` VALUES (1, 'DIVISIÓN G1 SAC ', 'DIVISIÓN G1 SAC ', '20546947093', 'AV.ARGENTINA Nº 575 INT. ', '964593148', NULL, 'Activo');
INSERT INTO `proveedor` VALUES (2, 'PROVEEDORES HRNOS EIRL', NULL, '20541269783', 'Jr. Juan de la Riva 125', '963548723', NULL, 'Activo');

-- ----------------------------
-- Table structure for seg_acciones
-- ----------------------------
DROP TABLE IF EXISTS `seg_acciones`;
CREATE TABLE `seg_acciones`  (
  `id_accion` int(11) NOT NULL AUTO_INCREMENT,
  `id_modulo` int(11) NULL DEFAULT NULL,
  `nombre` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `regex` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_accion`) USING BTREE,
  INDEX `modulo`(`id_modulo`) USING BTREE,
  CONSTRAINT `seg_acciones_ibfk_1` FOREIGN KEY (`id_modulo`) REFERENCES `seg_modulo` (`id_modulo`) ON DELETE RESTRICT ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of seg_acciones
-- ----------------------------

-- ----------------------------
-- Table structure for seg_menus
-- ----------------------------
DROP TABLE IF EXISTS `seg_menus`;
CREATE TABLE `seg_menus`  (
  `id_modulo` int(11) NULL DEFAULT NULL,
  `id_perfil` int(11) NULL DEFAULT NULL,
  `priority` int(11) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of seg_menus
-- ----------------------------
INSERT INTO `seg_menus` VALUES (2, 1, 28);
INSERT INTO `seg_menus` VALUES (3, 1, 26);
INSERT INTO `seg_menus` VALUES (5, 1, 27);
INSERT INTO `seg_menus` VALUES (6, 1, 25);
INSERT INTO `seg_menus` VALUES (8, 1, 21);
INSERT INTO `seg_menus` VALUES (10, 1, 22);
INSERT INTO `seg_menus` VALUES (7, 1, 23);
INSERT INTO `seg_menus` VALUES (9, 1, 24);
INSERT INTO `seg_menus` VALUES (11, 1, 19);
INSERT INTO `seg_menus` VALUES (13, 1, 20);
INSERT INTO `seg_menus` VALUES (18, 1, 16);
INSERT INTO `seg_menus` VALUES (17, 1, 17);
INSERT INTO `seg_menus` VALUES (14, 1, 18);
INSERT INTO `seg_menus` VALUES (16, 1, 15);
INSERT INTO `seg_menus` VALUES (21, 1, 14);
INSERT INTO `seg_menus` VALUES (17, 3, 0);
INSERT INTO `seg_menus` VALUES (16, 3, 1);
INSERT INTO `seg_menus` VALUES (3, 2, 16);
INSERT INTO `seg_menus` VALUES (8, 2, 17);
INSERT INTO `seg_menus` VALUES (10, 2, 18);
INSERT INTO `seg_menus` VALUES (11, 2, 19);
INSERT INTO `seg_menus` VALUES (18, 2, 20);
INSERT INTO `seg_menus` VALUES (17, 2, 21);
INSERT INTO `seg_menus` VALUES (14, 2, 22);
INSERT INTO `seg_menus` VALUES (21, 2, 23);
INSERT INTO `seg_menus` VALUES (16, 2, 24);
INSERT INTO `seg_menus` VALUES (2, 2, 25);
INSERT INTO `seg_menus` VALUES (7, 2, 26);
INSERT INTO `seg_menus` VALUES (13, 2, 27);
INSERT INTO `seg_menus` VALUES (23, 1, 12);
INSERT INTO `seg_menus` VALUES (22, 1, 13);
INSERT INTO `seg_menus` VALUES (24, 1, 11);
INSERT INTO `seg_menus` VALUES (25, 1, 10);
INSERT INTO `seg_menus` VALUES (26, 1, 9);
INSERT INTO `seg_menus` VALUES (27, 1, 8);
INSERT INTO `seg_menus` VALUES (28, 1, 7);
INSERT INTO `seg_menus` VALUES (29, 1, 6);
INSERT INTO `seg_menus` VALUES (30, 1, 5);
INSERT INTO `seg_menus` VALUES (31, 1, 4);
INSERT INTO `seg_menus` VALUES (29, 2, 4);
INSERT INTO `seg_menus` VALUES (31, 2, 5);
INSERT INTO `seg_menus` VALUES (27, 2, 6);
INSERT INTO `seg_menus` VALUES (5, 2, 7);
INSERT INTO `seg_menus` VALUES (25, 2, 8);
INSERT INTO `seg_menus` VALUES (26, 2, 9);
INSERT INTO `seg_menus` VALUES (30, 2, 10);
INSERT INTO `seg_menus` VALUES (6, 2, 11);
INSERT INTO `seg_menus` VALUES (24, 2, 12);
INSERT INTO `seg_menus` VALUES (9, 2, 13);
INSERT INTO `seg_menus` VALUES (23, 2, 14);
INSERT INTO `seg_menus` VALUES (22, 2, 15);
INSERT INTO `seg_menus` VALUES (32, 1, 3);
INSERT INTO `seg_menus` VALUES (35, 1, 1);
INSERT INTO `seg_menus` VALUES (34, 1, 2);
INSERT INTO `seg_menus` VALUES (32, 2, 1);
INSERT INTO `seg_menus` VALUES (35, 2, 2);
INSERT INTO `seg_menus` VALUES (34, 2, 3);
INSERT INTO `seg_menus` VALUES (36, 1, 0);
INSERT INTO `seg_menus` VALUES (36, 2, 0);

-- ----------------------------
-- Table structure for seg_modulo
-- ----------------------------
DROP TABLE IF EXISTS `seg_modulo`;
CREATE TABLE `seg_modulo`  (
  `id_modulo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `url` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nivel` enum('primer','segundo','tercer') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `icono` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_modulo_padre` int(11) NULL DEFAULT NULL,
  `orden` int(11) NULL DEFAULT NULL,
  `descripcion` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id_modulo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of seg_modulo
-- ----------------------------
INSERT INTO `seg_modulo` VALUES (1, 'Administrativo', '#', 'primer', ' fa-wrench', NULL, 2, NULL);
INSERT INTO `seg_modulo` VALUES (2, 'Marcas', 'marcas/lista', 'segundo', 'fa-key', 1, 1, NULL);
INSERT INTO `seg_modulo` VALUES (3, 'Categorias', 'categorias/lista', 'segundo', 'fa-tags', 1, 2, NULL);
INSERT INTO `seg_modulo` VALUES (4, 'Seguridad', '#', 'primer', 'fa-key', NULL, 1, NULL);
INSERT INTO `seg_modulo` VALUES (5, 'Modulos', 'seguridad/modulos', 'segundo', 'fa-tasks', 4, 1, NULL);
INSERT INTO `seg_modulo` VALUES (6, 'Perfiles', 'seguridad/perfiles', 'segundo', 'fa fa-users', 4, 2, NULL);
INSERT INTO `seg_modulo` VALUES (7, 'Productos', 'productos/lista', 'segundo', 'fa-cubes', 1, 3, NULL);
INSERT INTO `seg_modulo` VALUES (8, 'Clientes', 'clientes/lista', 'segundo', 'fa-male', 1, 4, NULL);
INSERT INTO `seg_modulo` VALUES (9, 'Proveedores', 'proveedores/lista', 'segundo', 'fa-bus', 1, 5, NULL);
INSERT INTO `seg_modulo` VALUES (10, 'Colaboradores', 'colaboradores/lista', 'segundo', 'fa-home', 4, 6, NULL);
INSERT INTO `seg_modulo` VALUES (11, 'Comprobantes', 'comprobantes/lista', 'segundo', 'fa-file-text-o', 1, 6, NULL);
INSERT INTO `seg_modulo` VALUES (12, 'Almacén', '#', 'primer', 'fa-angle-left pull-right', NULL, 3, NULL);
INSERT INTO `seg_modulo` VALUES (13, 'Stock', 'almacenes/stock', 'segundo', 'fa-sort', 12, 1, NULL);
INSERT INTO `seg_modulo` VALUES (14, 'Kardex', 'kardex/lista', 'segundo', 'fa-exchange', 12, 2, NULL);
INSERT INTO `seg_modulo` VALUES (15, 'Venta', '#', 'primer', 'fa-shopping-cart', NULL, 4, NULL);
INSERT INTO `seg_modulo` VALUES (16, 'Lista ventas', 'ventas/lista', 'segundo', 'fa-tasks', 15, 1, NULL);
INSERT INTO `seg_modulo` VALUES (17, 'Crear venta', 'ventas/add', 'segundo', 'fa-shopping-cart', 15, 2, NULL);
INSERT INTO `seg_modulo` VALUES (18, 'Control venta', 'ventas/control', 'segundo', 'fa-search-plus', 15, 3, NULL);
INSERT INTO `seg_modulo` VALUES (19, 'Compras', '#', 'primer', 'fa-suitcase', NULL, 5, NULL);
INSERT INTO `seg_modulo` VALUES (20, 'Reportes', '#', 'primer', 'fa-text', NULL, 6, NULL);
INSERT INTO `seg_modulo` VALUES (21, 'Lista compras', 'compras/lista', 'segundo', 'fa-list', 19, 1, NULL);
INSERT INTO `seg_modulo` VALUES (22, 'Reporte ventas', 'reporte_ventas', 'segundo', 'fa fa-money', 20, 1, NULL);
INSERT INTO `seg_modulo` VALUES (23, 'Reporte Compras', 'reporte_compras', 'segundo', 'fa fa-search', 20, 2, NULL);
INSERT INTO `seg_modulo` VALUES (24, 'Precios', 'precios/historial', 'segundo', 'fa-money', 12, 3, NULL);
INSERT INTO `seg_modulo` VALUES (25, 'Movimientos', 'movimientos/lista', 'segundo', 'fa-file-text-o', 12, 4, NULL);
INSERT INTO `seg_modulo` VALUES (26, 'Orden Compra', 'Orden_compras/lista', 'segundo', 'fa fa-pencil', 19, 2, NULL);
INSERT INTO `seg_modulo` VALUES (27, 'Lista proforrmas', 'proformas/lista', 'segundo', 'fa fa-edit', 15, 4, NULL);
INSERT INTO `seg_modulo` VALUES (28, 'CPE', '#', 'primer', 'fa fa-cloud', NULL, 9, NULL);
INSERT INTO `seg_modulo` VALUES (29, 'enviados', 'Envio_cpes/lista_enviados', 'segundo', 'fa', 28, 1, NULL);
INSERT INTO `seg_modulo` VALUES (30, 'pendientes', 'Envio_cpes/lista_pendientes', 'segundo', 'fa', 28, 2, NULL);
INSERT INTO `seg_modulo` VALUES (31, 'errores', 'Envio_cpes/lista_errores', 'segundo', 'fa', 28, 3, NULL);
INSERT INTO `seg_modulo` VALUES (32, 'Crear doc', 'documentaciones/lista', 'segundo', 'fa-file-word-o', 33, 5, NULL);
INSERT INTO `seg_modulo` VALUES (33, 'Documentación', '#', 'primer', 'fa-key', NULL, 8, NULL);
INSERT INTO `seg_modulo` VALUES (34, 'Tipo datos', 'documentaciones/tipo_datos', 'segundo', 'fa-tags', 33, 1, NULL);
INSERT INTO `seg_modulo` VALUES (35, 'Datos default', 'documentaciones/datos_documento', 'segundo', 'fa-text', 33, 2, NULL);
INSERT INTO `seg_modulo` VALUES (36, 'Crear Servicio corre', 'ServicioCorrectivo/lista', 'segundo', 'fa-file-word-o', 33, 6, NULL);

-- ----------------------------
-- Table structure for seg_perfil
-- ----------------------------
DROP TABLE IF EXISTS `seg_perfil`;
CREATE TABLE `seg_perfil`  (
  `id_perfil` int(255) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `descripcion` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id_perfil`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of seg_perfil
-- ----------------------------
INSERT INTO `seg_perfil` VALUES (1, 'Master', NULL);
INSERT INTO `seg_perfil` VALUES (2, 'Administrador', NULL);
INSERT INTO `seg_perfil` VALUES (3, 'Vendedor', NULL);

-- ----------------------------
-- Table structure for seg_restricciones
-- ----------------------------
DROP TABLE IF EXISTS `seg_restricciones`;
CREATE TABLE `seg_restricciones`  (
  `id_accion` int(255) NULL DEFAULT NULL,
  `id_perfil` int(255) NULL DEFAULT NULL,
  `priority` int(11) NULL DEFAULT NULL,
  INDEX `accion`(`id_accion`) USING BTREE,
  INDEX `perfiles`(`id_perfil`) USING BTREE,
  CONSTRAINT `seg_restricciones_ibfk_1` FOREIGN KEY (`id_accion`) REFERENCES `seg_acciones` (`id_accion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `seg_restricciones_ibfk_2` FOREIGN KEY (`id_perfil`) REFERENCES `seg_perfil` (`id_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of seg_restricciones
-- ----------------------------

-- ----------------------------
-- Table structure for serie_comprobante
-- ----------------------------
DROP TABLE IF EXISTS `serie_comprobante`;
CREATE TABLE `serie_comprobante`  (
  `idserie_comprobante` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_comprobante_idtipocomprobante` int(11) NULL DEFAULT NULL,
  `serie` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `correlativo` int(11) NULL DEFAULT NULL,
  `fecha_creacion` datetime NULL DEFAULT NULL,
  `estado` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  `titulo` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idserie_comprobante`) USING BTREE,
  INDEX `tipo_comprobante_idtipocomprobante`(`tipo_comprobante_idtipocomprobante`) USING BTREE,
  CONSTRAINT `serie_comprobante_ibfk_1` FOREIGN KEY (`tipo_comprobante_idtipocomprobante`) REFERENCES `tipo_comprobante` (`idtipo_comprobante`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of serie_comprobante
-- ----------------------------
INSERT INTO `serie_comprobante` VALUES (1, 1, '001', 1, NULL, 'Activo', NULL);
INSERT INTO `serie_comprobante` VALUES (2, 2, 'F001', 1, NULL, 'Activo', NULL);
INSERT INTO `serie_comprobante` VALUES (3, 3, 'B001', 1, NULL, 'Activo', NULL);
INSERT INTO `serie_comprobante` VALUES (4, 4, '001', 20, NULL, 'Activo', NULL);
INSERT INTO `serie_comprobante` VALUES (5, 5, 'NE', 1, NULL, 'Activo', NULL);
INSERT INTO `serie_comprobante` VALUES (6, 6, 'NS', 1, NULL, 'Activo', NULL);
INSERT INTO `serie_comprobante` VALUES (7, 7, 'CERT', 2, NULL, 'Activo', NULL);
INSERT INTO `serie_comprobante` VALUES (8, 8, 'CONST', 1, NULL, 'Inactivo', 'constancia');
INSERT INTO `serie_comprobante` VALUES (9, 9, 'ACT', 1, NULL, 'Inactivo', NULL);
INSERT INTO `serie_comprobante` VALUES (10, 10, 'CER', 31, NULL, 'Activo', 'CERTIFICADO DE FABRICACIÓN Y PRUEBA EN MAESTRANZA DE TANQUE\r\nESTACIONARIO DE ALMACENAMIENTO DE COMBUSTIBLE LÍQUIDO');
INSERT INTO `serie_comprobante` VALUES (11, 11, 'G001', 1, NULL, 'Activo', NULL);
INSERT INTO `serie_comprobante` VALUES (12, 12, 'CT', 11, NULL, 'Activo', 'CERTIFICADO DE TRABAJO');
INSERT INTO `serie_comprobante` VALUES (13, 13, 'CONT', 1, '2020-09-09 11:31:05', 'Activo', 'CONTRATO');
INSERT INTO `serie_comprobante` VALUES (14, 14, 'SVC', 3, '2020-09-09 11:31:05', 'Activo', 'Servicio correctivo');
INSERT INTO `serie_comprobante` VALUES (15, 14, 'SVC', 1, '2020-09-23 23:48:28', 'Inactivo', 'SERVICIO CORRECTIVO');

-- ----------------------------
-- Table structure for servicio_correctivo
-- ----------------------------
DROP TABLE IF EXISTS `servicio_correctivo`;
CREATE TABLE `servicio_correctivo`  (
  `idservicio_correctivo` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_emision` date NULL DEFAULT NULL,
  `correlativo` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `hora` time NULL DEFAULT NULL,
  `ruc_cliente` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cliente` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `idcliente` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `direccion_cliente` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `distrito` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `telefono` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `servicio_realizado_tipo_1_1` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `servicio_realizado_tipo_1_2` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `servicio_realizado_tipo_1_3` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `marca_1` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `modelo_1` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `serie_1` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `desperfecto_1` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `trabajo_realizado_1` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `med_producto_1_1` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_alto_caudal_1_1` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_bajo_caudal_1_1` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_sello_1_1` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_producto_1_2` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_alto_caudal_1_2` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_bajo_caudal_1_2` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_sello_1_2` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_producto_1_3` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_alto_caudal_1_3` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_bajo_caudal_1_3` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_sello_1_3` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_producto_1_4` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_alto_caudal_1_4` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_bajo_caudal_1_4` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_sello_1_4` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_producto_1_5` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_alto_caudal_1_5` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_bajo_caudal_1_5` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_sello_1_5` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_producto_1_6` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_alto_caudal_1_6` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_bajo_caudal_1_6` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_sello_1_6` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_producto_2_1` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_alto_caudal_2_1` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_bajo_caudal_2_1` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_sello_2_1` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_producto_2_2` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_alto_caudal_2_2` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_bajo_caudal_2_2` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_sello_2_2` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_producto_2_3` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_alto_caudal_2_3` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_bajo_caudal_2_3` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_sello_2_3` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_producto_2_4` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_alto_caudal_2_4` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_bajo_caudal_2_4` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_sello_2_4` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_producto_2_5` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_alto_caudal_2_5` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_bajo_caudal_2_5` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_sello_2_5` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_producto_2_6` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_alto_caudal_2_6` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_bajo_caudal_2_6` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_sello_2_6` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `observacion_1` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `servicio_realizado_tipo_2_1` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `servicio_realizado_tipo_2_2` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `servicio_realizado_tipo_2_3` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `marca_2` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `modelo_2` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `serie_2` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `desperfecto_2` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `trabajo_realizado_2` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `med_producto_3_1` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_alto_caudal_3_1` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_bajo_caudal_3_1` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_sello_3_1` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_producto_3_2` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_alto_caudal_3_2` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_bajo_caudal_3_2` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_sello_3_2` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_producto_3_3` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_alto_caudal_3_3` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_bajo_caudal_3_3` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_sello_3_3` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_producto_3_4` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_alto_caudal_3_4` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_bajo_caudal_3_4` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_sello_3_4` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_producto_3_5` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_alto_caudal_3_5` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_bajo_caudal_3_5` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_sello_3_5` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_producto_3_6` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_alto_caudal_3_6` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_bajo_caudal_3_6` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_sello_3_6` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_producto_4_1` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_alto_caudal_4_1` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_bajo_caudal_4_1` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_sello_4_1` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_producto_4_2` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_alto_caudal_4_2` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_bajo_caudal_4_2` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_sello_4_2` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_producto_4_3` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_alto_caudal_4_3` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_bajo_caudal_4_3` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_sello_4_3` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_producto_4_4` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_alto_caudal_4_4` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_bajo_caudal_4_4` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_sello_4_4` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_producto_4_5` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_alto_caudal_4_5` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_bajo_caudal_4_5` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_sello_4_5` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_producto_4_6` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_alto_caudal_4_6` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_bajo_caudal_4_6` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `med_sello_4_6` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `observacion_2` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `fecha_visita` date NULL DEFAULT NULL,
  `est_equipo_bueno_1_1` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `est_equipo_malo_1_1` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `est_observacion_1_1` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `est_equipo_bueno_1_2` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `est_equipo_malo_1_2` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `est_observacion_1_2` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `est_equipo_bueno_1_3` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `est_equipo_malo_1_3` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `est_observacion_1_3` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fecha_creacion` datetime NULL DEFAULT CURRENT_TIMESTAMP,
  `estado_servicio` enum('vigente','pendiente','anulado') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'vigente',
  PRIMARY KEY (`idservicio_correctivo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of servicio_correctivo
-- ----------------------------
INSERT INTO `servicio_correctivo` VALUES (1, '2020-09-25', 'SVC-1', '2020-09-25', '23:09:00', '1073031934', 'Colbert Calampa Tantachuco', '2', 'Comercio 523', '', '', NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '2020-09-26 04:39:45', 'vigente');
INSERT INTO `servicio_correctivo` VALUES (2, '2020-09-25', 'SVC-1', '2020-09-25', '23:58:00', '1073031934', 'Colbert Calampa Tantachuco', '2', 'Comercio 523', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-26 04:41:56', 'vigente');

-- ----------------------------
-- Table structure for stock
-- ----------------------------
DROP TABLE IF EXISTS `stock`;
CREATE TABLE `stock`  (
  `idstock` int(11) NOT NULL AUTO_INCREMENT,
  `tienda_idtienda` int(11) NULL DEFAULT NULL,
  `producto_idproducto` int(11) NULL DEFAULT NULL,
  `stock_almacen` int(11) NULL DEFAULT NULL,
  `stock_mostrador` decimal(18, 2) NULL DEFAULT NULL,
  `ultimo_ingreso` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idstock`) USING BTREE,
  INDEX `tienda_idtienda`(`tienda_idtienda`) USING BTREE,
  INDEX `producto_idproducto`(`producto_idproducto`) USING BTREE,
  CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`tienda_idtienda`) REFERENCES `tienda` (`idtienda`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of stock
-- ----------------------------

-- ----------------------------
-- Table structure for tienda
-- ----------------------------
DROP TABLE IF EXISTS `tienda`;
CREATE TABLE `tienda`  (
  `idtienda` int(11) NOT NULL AUTO_INCREMENT,
  `codtienda` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `descripcion` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `observacion` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `estado` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  PRIMARY KEY (`idtienda`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tienda
-- ----------------------------
INSERT INTO `tienda` VALUES (1, '001', 'Tienda 1', NULL, 'Activo');
INSERT INTO `tienda` VALUES (2, '002', 'tienda 2', NULL, 'Inactivo');

-- ----------------------------
-- Table structure for tipo_comprobante
-- ----------------------------
DROP TABLE IF EXISTS `tipo_comprobante`;
CREATE TABLE `tipo_comprobante`  (
  `idtipo_comprobante` int(11) NOT NULL AUTO_INCREMENT,
  `codsunat` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `descripcion` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `abreviatura` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `estado` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  `codigo_nubefact` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idtipo_comprobante`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tipo_comprobante
-- ----------------------------
INSERT INTO `tipo_comprobante` VALUES (1, NULL, 'Ticket', 'TIC', 'Activo', NULL);
INSERT INTO `tipo_comprobante` VALUES (2, '01', 'Factura', 'FAC', 'Activo', 1);
INSERT INTO `tipo_comprobante` VALUES (3, '03', 'Boleta', 'BOL', 'Activo', 2);
INSERT INTO `tipo_comprobante` VALUES (4, NULL, 'Proforma', 'PRO', 'Activo', NULL);
INSERT INTO `tipo_comprobante` VALUES (5, NULL, 'Nota entrada', 'NE', 'Activo', NULL);
INSERT INTO `tipo_comprobante` VALUES (6, NULL, 'Nota salida', 'NS', 'Activo', NULL);
INSERT INTO `tipo_comprobante` VALUES (7, NULL, 'Certificado', 'CTF', 'Activo', NULL);
INSERT INTO `tipo_comprobante` VALUES (8, NULL, 'Constancia', 'CTC', 'Activo', NULL);
INSERT INTO `tipo_comprobante` VALUES (9, NULL, 'Acta', 'Acta', 'Activo', NULL);
INSERT INTO `tipo_comprobante` VALUES (10, NULL, 'Certificado', 'CER', 'Activo', NULL);
INSERT INTO `tipo_comprobante` VALUES (11, NULL, 'Guia remisión', 'GUIA', 'Activo', NULL);
INSERT INTO `tipo_comprobante` VALUES (12, NULL, 'Cert_Trabajo', 'CTRA', 'Activo', NULL);
INSERT INTO `tipo_comprobante` VALUES (13, NULL, 'Contrato', 'Cont', 'Activo', NULL);
INSERT INTO `tipo_comprobante` VALUES (14, NULL, 'Servicio Correctivo', 'SVC', 'Activo', NULL);

-- ----------------------------
-- Table structure for tipo_pago
-- ----------------------------
DROP TABLE IF EXISTS `tipo_pago`;
CREATE TABLE `tipo_pago`  (
  `idtipo_pago` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `abreviatura` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `estado` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  PRIMARY KEY (`idtipo_pago`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tipo_pago
-- ----------------------------
INSERT INTO `tipo_pago` VALUES (1, 'Soles', 'S/.', 'Activo');
INSERT INTO `tipo_pago` VALUES (2, 'Dolares', '$', 'Activo');
INSERT INTO `tipo_pago` VALUES (3, 'Euros', 'eu', 'Activo');

-- ----------------------------
-- Table structure for unidad_medida
-- ----------------------------
DROP TABLE IF EXISTS `unidad_medida`;
CREATE TABLE `unidad_medida`  (
  `idunidad_medida` int(11) NOT NULL AUTO_INCREMENT,
  `presentacion_idpresentacion` int(11) NULL DEFAULT NULL,
  `producto_idproducto` int(11) NULL DEFAULT NULL,
  `cantidad` decimal(18, 2) NULL DEFAULT NULL,
  `precio_compra` decimal(18, 2) NULL DEFAULT NULL,
  `precio_venta` decimal(18, 2) NULL DEFAULT NULL,
  `utilidad` decimal(18, 2) NULL DEFAULT NULL,
  `estado` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  `fecha_modificacion` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`idunidad_medida`) USING BTREE,
  INDEX `presentacion_idpresentacion`(`presentacion_idpresentacion`) USING BTREE,
  INDEX `producto_idproducto`(`producto_idproducto`) USING BTREE,
  CONSTRAINT `unidad_medida_ibfk_1` FOREIGN KEY (`presentacion_idpresentacion`) REFERENCES `presentacion` (`idpresentacion`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `unidad_medida_ibfk_2` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 117 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of unidad_medida
-- ----------------------------
INSERT INTO `unidad_medida` VALUES (1, 7, 1, 1.00, 0.00, 1600.00, 0.00, 'Inactivo', '2019-04-13 06:05:12');
INSERT INTO `unidad_medida` VALUES (2, 7, 3, 1.00, 0.00, 35.00, 0.00, 'Inactivo', '2019-04-13 06:05:51');
INSERT INTO `unidad_medida` VALUES (3, 7, 2, 1.00, 0.00, 100.00, 0.00, 'Inactivo', '2019-04-13 06:06:03');
INSERT INTO `unidad_medida` VALUES (4, 7, 1, 1.00, 900.00, 1600.00, 0.00, 'Inactivo', '2019-04-13 06:10:56');
INSERT INTO `unidad_medida` VALUES (5, 7, 3, 1.00, 20.00, 35.00, 0.00, 'Inactivo', '2019-04-13 06:10:56');
INSERT INTO `unidad_medida` VALUES (6, NULL, NULL, 1.00, 0.00, 28.00, 0.00, 'Activo', '2019-04-28 11:17:54');
INSERT INTO `unidad_medida` VALUES (7, 7, 3, 1.00, 20.00, 25.00, 0.00, 'Inactivo', '2019-04-28 11:19:27');
INSERT INTO `unidad_medida` VALUES (8, 7, 5, 1.00, 0.00, 2.00, 0.00, 'Activo', '2019-04-28 11:33:43');
INSERT INTO `unidad_medida` VALUES (9, 7, 1, 1.00, 10.00, 1600.00, 0.00, 'Inactivo', '2019-05-22 21:13:32');
INSERT INTO `unidad_medida` VALUES (10, 7, 9, 1.00, 0.00, 50.00, 0.00, 'Activo', '2019-06-02 16:13:54');
INSERT INTO `unidad_medida` VALUES (11, 7, 10, 1.00, 0.00, 250.00, 0.00, 'Inactivo', '2019-06-08 23:22:39');
INSERT INTO `unidad_medida` VALUES (12, 7, 20, 1.00, 0.00, 165.00, 0.00, 'Inactivo', '2019-10-15 22:03:46');
INSERT INTO `unidad_medida` VALUES (13, 7, 21, 1.00, 0.00, 375.00, 0.00, 'Inactivo', '2019-10-15 22:05:35');
INSERT INTO `unidad_medida` VALUES (14, 7, 22, 1.00, 0.00, 21.50, 0.00, 'Activo', '2019-10-15 22:05:56');
INSERT INTO `unidad_medida` VALUES (15, 7, 23, 1.00, 0.00, 21.50, 0.00, 'Activo', '2019-10-15 22:06:10');
INSERT INTO `unidad_medida` VALUES (16, 7, 30, 1.00, 0.00, 4.50, 0.00, 'Activo', '2019-10-15 22:06:31');
INSERT INTO `unidad_medida` VALUES (17, 7, 31, 1.00, 0.00, 4.80, 0.00, 'Activo', '2019-10-15 22:06:46');
INSERT INTO `unidad_medida` VALUES (18, 7, 32, 1.00, 0.00, 6.50, 0.00, 'Activo', '2019-10-15 22:06:59');
INSERT INTO `unidad_medida` VALUES (19, 7, 33, 1.00, 0.00, 7.20, 0.00, 'Activo', '2019-10-15 22:07:11');
INSERT INTO `unidad_medida` VALUES (20, 7, 35, 1.00, 0.00, 7.60, 0.00, 'Activo', '2019-10-15 22:07:22');
INSERT INTO `unidad_medida` VALUES (21, 7, 36, 1.00, 0.00, 8.40, 0.00, 'Activo', '2019-10-15 22:07:47');
INSERT INTO `unidad_medida` VALUES (22, 7, 37, 1.00, 0.00, 9.60, 0.00, 'Inactivo', '2019-10-15 22:08:03');
INSERT INTO `unidad_medida` VALUES (23, 7, 63, 1.00, 0.00, 230.00, 0.00, 'Inactivo', '2019-10-15 22:09:00');
INSERT INTO `unidad_medida` VALUES (24, 7, 62, 1.00, 0.00, 190.00, 0.00, 'Inactivo', '2019-10-15 22:09:13');
INSERT INTO `unidad_medida` VALUES (25, 7, 46, 1.00, 0.00, 140.00, 0.00, 'Activo', '2019-10-15 22:10:01');
INSERT INTO `unidad_medida` VALUES (26, 7, 45, 1.00, 0.00, 140.00, 0.00, 'Inactivo', '2019-10-15 22:10:12');
INSERT INTO `unidad_medida` VALUES (27, 7, 45, 1.00, 0.00, 140.00, 0.00, 'Activo', '2019-10-15 22:10:40');
INSERT INTO `unidad_medida` VALUES (28, 7, 44, 1.00, 0.00, 140.00, 0.00, 'Activo', '2019-10-15 22:11:04');
INSERT INTO `unidad_medida` VALUES (29, 7, 43, 1.00, 0.00, 140.00, 0.00, 'Activo', '2019-10-15 22:11:15');
INSERT INTO `unidad_medida` VALUES (30, 15, 48, 1.00, 0.00, 90.00, 0.00, 'Activo', '2019-10-15 22:11:36');
INSERT INTO `unidad_medida` VALUES (31, 15, 47, 1.00, 0.00, 130.00, 0.00, 'Activo', '2019-10-15 22:11:48');
INSERT INTO `unidad_medida` VALUES (32, 7, 64, 1.00, 0.00, 160.00, 0.00, 'Activo', '2019-10-15 22:13:12');
INSERT INTO `unidad_medida` VALUES (33, 7, 65, 1.00, 0.00, 195.00, 0.00, 'Activo', '2019-10-15 22:13:24');
INSERT INTO `unidad_medida` VALUES (34, 7, 73, 1.00, 0.00, 160.00, 0.00, 'Inactivo', '2019-10-15 22:13:47');
INSERT INTO `unidad_medida` VALUES (35, 7, 74, 1.00, 0.00, 110.00, 0.00, 'Activo', '2019-10-15 22:13:59');
INSERT INTO `unidad_medida` VALUES (36, 7, 76, 1.00, 0.00, 980.00, 0.00, 'Activo', '2019-10-15 22:14:20');
INSERT INTO `unidad_medida` VALUES (37, 7, 71, 1.00, 0.00, 295.00, 0.00, 'Inactivo', '2019-10-15 22:14:51');
INSERT INTO `unidad_medida` VALUES (38, 7, 52, 1.00, 0.00, 85.00, 0.00, 'Activo', '2019-10-15 22:15:06');
INSERT INTO `unidad_medida` VALUES (39, 7, 53, 1.00, 0.00, 175.00, 0.00, 'Inactivo', '2019-10-15 22:15:21');
INSERT INTO `unidad_medida` VALUES (40, 7, 38, 1.00, 0.00, 120.00, 0.00, 'Activo', '2019-10-15 22:15:48');
INSERT INTO `unidad_medida` VALUES (41, 7, 55, 1.00, 0.00, 125.00, 0.00, 'Inactivo', '2019-10-15 22:16:21');
INSERT INTO `unidad_medida` VALUES (42, 7, 56, 1.00, 0.00, 175.00, 0.00, 'Activo', '2019-10-15 22:16:34');
INSERT INTO `unidad_medida` VALUES (43, 7, 57, 1.00, 0.00, 690.00, 0.00, 'Activo', '2019-10-15 22:16:59');
INSERT INTO `unidad_medida` VALUES (44, 7, 61, 1.00, 0.00, 193.00, 0.00, 'Activo', '2019-10-15 22:17:47');
INSERT INTO `unidad_medida` VALUES (45, 7, 49, 1.00, 0.00, 80.00, 0.00, 'Activo', '2019-10-15 22:18:01');
INSERT INTO `unidad_medida` VALUES (46, 7, 50, 1.00, 0.00, 95.00, 0.00, 'Activo', '2019-10-15 22:18:22');
INSERT INTO `unidad_medida` VALUES (47, 7, 51, 1.00, 0.00, 65.00, 0.00, 'Activo', '2019-10-15 22:18:38');
INSERT INTO `unidad_medida` VALUES (48, 7, 82, 1.00, 0.00, 200.00, 0.00, 'Activo', '2019-10-15 22:18:48');
INSERT INTO `unidad_medida` VALUES (49, 7, 24, 1.00, 0.00, 52.00, 0.00, 'Activo', '2019-10-15 22:19:08');
INSERT INTO `unidad_medida` VALUES (50, 7, 25, 1.00, 0.00, 40.00, 0.00, 'Activo', '2019-10-15 22:19:25');
INSERT INTO `unidad_medida` VALUES (51, 7, 40, 1.00, 0.00, 14.80, 0.00, 'Activo', '2019-10-15 22:19:58');
INSERT INTO `unidad_medida` VALUES (52, 7, 72, 1.00, 0.00, 315.00, 0.00, 'Inactivo', '2019-10-15 22:20:48');
INSERT INTO `unidad_medida` VALUES (53, 7, 70, 1.00, 0.00, 270.00, 0.00, 'Inactivo', '2019-10-15 22:21:08');
INSERT INTO `unidad_medida` VALUES (54, 7, 54, 1.00, 0.00, 270.00, 0.00, 'Activo', '2019-10-15 22:21:25');
INSERT INTO `unidad_medida` VALUES (55, 7, 91, 1.00, 0.00, 170.00, 0.00, 'Activo', '2019-10-15 22:22:13');
INSERT INTO `unidad_medida` VALUES (56, 7, 26, 1.00, 0.00, 19.00, 0.00, 'Activo', '2019-10-15 22:22:53');
INSERT INTO `unidad_medida` VALUES (57, 7, 27, 1.00, 0.00, 12.00, 0.00, 'Activo', '2019-10-15 22:23:08');
INSERT INTO `unidad_medida` VALUES (58, 7, 59, 1.00, 0.00, 275.00, 0.00, 'Activo', '2019-10-15 22:23:31');
INSERT INTO `unidad_medida` VALUES (59, 7, 58, 1.00, 0.00, 175.00, 0.00, 'Inactivo', '2019-10-15 22:24:02');
INSERT INTO `unidad_medida` VALUES (60, 7, 60, 1.00, 0.00, 680.00, 0.00, 'Activo', '2019-10-15 22:24:24');
INSERT INTO `unidad_medida` VALUES (61, 7, 86, 1.00, 0.00, 3.50, 0.00, 'Activo', '2019-10-15 22:24:41');
INSERT INTO `unidad_medida` VALUES (62, 7, 28, 1.00, 0.00, 23.00, 0.00, 'Activo', '2019-10-15 22:25:08');
INSERT INTO `unidad_medida` VALUES (63, 7, 29, 1.00, 0.00, 13.50, 0.00, 'Activo', '2019-10-15 22:25:23');
INSERT INTO `unidad_medida` VALUES (64, 7, 89, 1.00, 0.00, 3500.00, 0.00, 'Activo', '2019-10-15 22:25:42');
INSERT INTO `unidad_medida` VALUES (65, 7, 90, 1.00, 0.00, 3500.00, 0.00, 'Activo', '2019-10-15 22:25:54');
INSERT INTO `unidad_medida` VALUES (66, 7, 66, 1.00, 0.00, 1200.00, 0.00, 'Activo', '2019-10-15 22:26:10');
INSERT INTO `unidad_medida` VALUES (67, 7, 67, 1.00, 0.00, 800.00, 0.00, 'Activo', '2019-10-15 22:26:22');
INSERT INTO `unidad_medida` VALUES (68, 7, 68, 1.00, 0.00, 1300.00, 0.00, 'Activo', '2019-10-15 22:26:43');
INSERT INTO `unidad_medida` VALUES (69, 7, 69, 1.00, 0.00, 900.00, 0.00, 'Activo', '2019-10-15 22:26:53');
INSERT INTO `unidad_medida` VALUES (70, 7, 88, 1.00, 0.00, 20280.00, 0.00, 'Inactivo', '2019-10-15 22:28:50');
INSERT INTO `unidad_medida` VALUES (71, 7, 92, 1.00, 0.00, 15000.00, 0.00, 'Activo', '2019-10-15 22:29:20');
INSERT INTO `unidad_medida` VALUES (72, 7, 10, 1.00, 0.00, 5577.00, 0.00, 'Inactivo', '2019-10-15 22:30:22');
INSERT INTO `unidad_medida` VALUES (73, 16, 11, 1.00, 0.00, 6760.00, 0.00, 'Inactivo', '2019-10-15 22:30:43');
INSERT INTO `unidad_medida` VALUES (74, 7, 1, 1.00, 10.00, 95.00, 0.00, 'Activo', '2020-09-27 17:12:35');
INSERT INTO `unidad_medida` VALUES (75, 12, 7, 1.00, 0.00, 220.00, 0.00, 'Inactivo', '2020-09-27 17:12:52');
INSERT INTO `unidad_medida` VALUES (76, 7, 78, 1.00, 0.00, 500.00, 0.00, 'Activo', '2020-09-27 17:13:35');
INSERT INTO `unidad_medida` VALUES (77, 7, 79, 1.00, 0.00, 700.00, 0.00, 'Activo', '2020-09-27 17:13:51');
INSERT INTO `unidad_medida` VALUES (78, 7, 2, 1.00, 0.00, 50.00, 0.00, 'Inactivo', '2020-09-27 17:14:03');
INSERT INTO `unidad_medida` VALUES (79, 7, 42, 1.00, 0.00, 750.00, 0.00, 'Activo', '2020-09-27 17:14:25');
INSERT INTO `unidad_medida` VALUES (80, 16, 13, 1.00, 0.00, 6480.00, 0.00, 'Activo', '2020-09-27 17:14:58');
INSERT INTO `unidad_medida` VALUES (81, 16, 11, 1.00, 0.00, 7560.00, 0.00, 'Activo', '2020-09-27 17:15:22');
INSERT INTO `unidad_medida` VALUES (82, 16, 12, 1.00, 0.00, 9000.00, 0.00, 'Activo', '2020-09-27 17:15:59');
INSERT INTO `unidad_medida` VALUES (83, 16, 14, 1.00, 0.00, 7920.00, 0.00, 'Activo', '2020-09-27 17:16:24');
INSERT INTO `unidad_medida` VALUES (84, 16, 15, 1.00, 0.00, 9360.00, 0.00, 'Activo', '2020-09-27 17:16:47');
INSERT INTO `unidad_medida` VALUES (85, 7, 81, 1.00, 0.00, 5400.00, 0.00, 'Activo', '2020-09-27 17:17:07');
INSERT INTO `unidad_medida` VALUES (86, 7, 10, 1.00, 0.00, 6350.00, 0.00, 'Activo', '2020-09-27 17:17:39');
INSERT INTO `unidad_medida` VALUES (87, 7, 3, 1.00, 20.00, 55.00, 0.00, 'Inactivo', '2020-09-27 17:18:25');
INSERT INTO `unidad_medida` VALUES (88, 7, 3, 1.00, 20.00, 55.00, 0.00, 'Activo', '2020-09-27 17:18:41');
INSERT INTO `unidad_medida` VALUES (89, 7, 2, 1.00, 0.00, 50.00, 0.00, 'Inactivo', '2020-09-27 17:18:57');
INSERT INTO `unidad_medida` VALUES (90, 12, 7, 1.00, 0.00, 220.00, 0.00, 'Activo', '2020-09-27 17:19:24');
INSERT INTO `unidad_medida` VALUES (91, 7, 2, 1.00, 0.00, 50.00, 0.00, 'Activo', '2020-10-13 19:04:10');
INSERT INTO `unidad_medida` VALUES (92, 7, 20, 1.00, 0.00, 185.00, 0.00, 'Activo', '2020-10-13 19:04:59');
INSERT INTO `unidad_medida` VALUES (93, 7, 21, 1.00, 0.00, 470.00, 0.00, 'Activo', '2020-10-13 19:05:36');
INSERT INTO `unidad_medida` VALUES (94, 12, 104, 1.00, 0.00, 75.00, 0.00, 'Activo', '2020-10-13 19:05:51');
INSERT INTO `unidad_medida` VALUES (95, 7, 37, 1.00, 0.00, 10.30, 0.00, 'Activo', '2020-10-13 19:06:31');
INSERT INTO `unidad_medida` VALUES (96, 7, 62, 1.00, 0.00, 230.00, 0.00, 'Activo', '2020-10-13 19:07:51');
INSERT INTO `unidad_medida` VALUES (97, 7, 63, 1.00, 0.00, 250.00, 0.00, 'Activo', '2020-10-13 19:08:13');
INSERT INTO `unidad_medida` VALUES (98, 7, 53, 1.00, 0.00, 190.00, 0.00, 'Activo', '2020-10-13 19:08:57');
INSERT INTO `unidad_medida` VALUES (99, 7, 71, 1.00, 0.00, 320.00, 0.00, 'Activo', '2020-10-13 19:09:14');
INSERT INTO `unidad_medida` VALUES (100, 7, 70, 1.00, 0.00, 285.00, 0.00, 'Activo', '2020-10-13 19:09:35');
INSERT INTO `unidad_medida` VALUES (101, 7, 55, 1.00, 0.00, 135.00, 0.00, 'Activo', '2020-10-13 19:09:53');
INSERT INTO `unidad_medida` VALUES (102, 12, 93, 1.00, 0.00, 285.00, 0.00, 'Activo', '2020-10-13 19:10:27');
INSERT INTO `unidad_medida` VALUES (103, 7, 73, 1.00, 0.00, 170.00, 0.00, 'Activo', '2020-10-13 19:10:41');
INSERT INTO `unidad_medida` VALUES (104, 15, 75, 1.00, 0.00, 650.00, 0.00, 'Activo', '2020-10-13 19:11:05');
INSERT INTO `unidad_medida` VALUES (105, 12, 96, 1.00, 0.00, 250.00, 0.00, 'Activo', '2020-10-13 19:11:48');
INSERT INTO `unidad_medida` VALUES (106, 7, 39, 1.00, 0.00, 15.00, 0.00, 'Activo', '2020-10-13 19:12:10');
INSERT INTO `unidad_medida` VALUES (107, 7, 58, 1.00, 0.00, 187.00, 0.00, 'Activo', '2020-10-13 19:13:10');
INSERT INTO `unidad_medida` VALUES (108, 7, 77, 1.00, 0.00, 287.00, 0.00, 'Activo', '2020-10-13 19:13:29');
INSERT INTO `unidad_medida` VALUES (109, 12, 94, 1.00, 0.00, 300.00, 0.00, 'Activo', '2020-10-13 19:14:00');
INSERT INTO `unidad_medida` VALUES (110, 7, 72, 1.00, 0.00, 550.00, 0.00, 'Activo', '2020-10-13 19:14:16');
INSERT INTO `unidad_medida` VALUES (111, 12, 99, 1.00, 0.00, 276.00, 0.00, 'Activo', '2020-10-13 19:14:35');
INSERT INTO `unidad_medida` VALUES (112, 12, 101, 1.00, 0.00, 250.00, 0.00, 'Activo', '2020-10-13 19:15:55');
INSERT INTO `unidad_medida` VALUES (113, 7, 88, 1.00, 0.00, 23400.00, 0.00, 'Activo', '2020-10-13 19:17:02');
INSERT INTO `unidad_medida` VALUES (114, 12, 105, 1.00, 0.00, 600.00, 0.00, 'Activo', '2020-10-13 19:18:30');
INSERT INTO `unidad_medida` VALUES (115, 7, 106, 1.00, 0.00, 40000.00, 0.00, 'Activo', '2020-10-13 20:13:58');
INSERT INTO `unidad_medida` VALUES (116, 7, 107, 1.00, 0.00, 18000.00, 0.00, 'Activo', '2020-10-13 20:14:29');

-- ----------------------------
-- Table structure for venta
-- ----------------------------
DROP TABLE IF EXISTS `venta`;
CREATE TABLE `venta`  (
  `idventa` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime NULL DEFAULT NULL,
  `serie_comprobante_idserie_comprobante` int(11) NULL DEFAULT NULL,
  `tipo_comprobante_idtipo_comprobante` int(11) NULL DEFAULT NULL,
  `tienda_idtienda` int(11) NULL DEFAULT NULL,
  `cliente_idcliente` int(11) NULL DEFAULT NULL,
  `cliente_razon_social` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cliente_documento` char(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cliente_direccion` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nro_guia_remision` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nro_documento` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nro_pre_documento` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `colaborador_idcolaborador` int(11) NULL DEFAULT NULL,
  `fecha_venta` datetime NULL DEFAULT NULL,
  `observacion` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `subtotal` decimal(18, 2) NULL DEFAULT NULL,
  `igv` decimal(18, 2) NULL DEFAULT NULL,
  `descuento` decimal(18, 2) NULL DEFAULT NULL,
  `total` decimal(18, 2) NULL DEFAULT NULL,
  `estado` enum('vigente','anulado') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'vigente',
  `cliente_email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idventa`) USING BTREE,
  UNIQUE INDEX `nro_documento_unico`(`nro_documento`) USING BTREE,
  INDEX `serie_comprobante_idserie_comprobante`(`serie_comprobante_idserie_comprobante`) USING BTREE,
  INDEX `tipo_comprobante_idtipo_comprobante`(`tipo_comprobante_idtipo_comprobante`) USING BTREE,
  INDEX `cliente_idcliente`(`cliente_idcliente`) USING BTREE,
  INDEX `colaborador_idcolaborador`(`colaborador_idcolaborador`) USING BTREE,
  CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`serie_comprobante_idserie_comprobante`) REFERENCES `serie_comprobante` (`idserie_comprobante`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`tipo_comprobante_idtipo_comprobante`) REFERENCES `tipo_comprobante` (`idtipo_comprobante`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `venta_ibfk_3` FOREIGN KEY (`cliente_idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `venta_ibfk_4` FOREIGN KEY (`colaborador_idcolaborador`) REFERENCES `colaborador` (`idcolaborador`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of venta
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
