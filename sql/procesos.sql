-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-07-2015 a las 12:09:13
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `procesos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE IF NOT EXISTS `actividades` (
  `idActividad` int(11) NOT NULL AUTO_INCREMENT,
  `Actividad` varchar(100) NOT NULL,
  `Rol` varchar(50) NOT NULL,
  `flujo` varchar(50) NOT NULL,
  `tiempo` decimal(9,3) NOT NULL,
  `tipoProceso` int(11) NOT NULL,
  `idProceso` int(11) NOT NULL,
  PRIMARY KEY (`idActividad`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`idActividad`, `Actividad`, `Rol`, `flujo`, `tiempo`, `tipoProceso`, `idProceso`) VALUES
(1, 'Analizar cronograma recepcion', 'Asignar', 'operacion', '0.000', 1, 304),
(2, 'Analizar cronograma recepcion s', 'Auditor', 'operacion', '0.400', 1, 304),
(3, 'Analizar cronograma recepcion w', 'Asignar', 'inspeccion', '0.600', 1, 304),
(4, 'control de almacen', 'Gerencia', 'inspeccion', '5.600', 1, 304),
(6, 'control envio', 'Auditor', 'inspeccion', '1.000', 1, 304),
(7, 'control', 'Asignar', 'inspeccion', '0.000', 1, 304),
(8, 'Ingresar Pedido', 'Asignar', 'operacion', '0.000', 2, 200),
(9, 'aaa', 'Asignar', 'demora', '0.000', 2, 200),
(10, 'Ingresar Botellas', 'Asignar', 'operacion', '0.000', 2, 200),
(11, 'Obtener la informacion actual de la empresa', 'Asignar', 'demora', '1.000', 1, 301),
(12, 'Identificar los permisos Legales fiscales', 'Asignar', 'demora', '0.000', 1, 320),
(13, 'actividad 1', 'Asignar', 'inspeccion', '4.000', 1, 321),
(14, 'Identificar Procesos No fiscales', 'Asignar', 'almacenaje', '0.000', 1, 320),
(15, 'Firmar los contratos', 'Asignar', 'demora', '5.000', 1, 307),
(16, 'reportar Firmas de contrato', 'Asignar', 'trasporte', '8.000', 1, 307),
(17, 'Supervisar softwars', 'Asignar', 'demora', '0.000', 3, 131),
(18, 'Monitorear la red', 'Asignar', 'inspeccion', '0.000', 3, 131),
(19, 'Agregar Carritos', 'Gerente de TI', 'combo', '0.000', 3, 131);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apoyo`
--

CREATE TABLE IF NOT EXISTS `apoyo` (
  `idapoyo` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(45) DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL,
  `loc` varchar(45) DEFAULT NULL,
  `text` varchar(45) DEFAULT NULL,
  `group` varchar(10) DEFAULT NULL,
  `idempresa` int(11) NOT NULL,
  PRIMARY KEY (`idapoyo`),
  KEY `fk_apoyo_empresa1_idx` (`idempresa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=141 ;

--
-- Volcado de datos para la tabla `apoyo`
--

INSERT INTO `apoyo` (`idapoyo`, `key`, `category`, `loc`, `text`, `group`, `idempresa`) VALUES
(130, '-3', 'Apoyo', '35.000000000000014 479.99999999999955', 'GestiÃ³n de Capital Humano', '0', 16),
(131, '-5', 'Apoyo', '132.00000000000014 533.0000000000002', 'GestiÃ³n de TI', '0', 16),
(132, '-6', 'Apoyo', '511.99999999999983 526.0000000000006', 'Recursos FÃ­sicos', '0', 16),
(133, '-20', 'Apoyo', '462.9999999999999 465.6000061035157', 'GestiÃ³n Logistica', '0', 16),
(134, '-29', 'Apoyo', '283 503.6000061035156', 'GestiÃ³n de la Seguridad', '0', 16),
(135, '-3', 'Apoyo', '39.00000000000001 509.99999999999966', 'Proceso de Apoyo', '0', 18),
(136, '-5', 'Apoyo', '234 512.0000000000002', 'Proceso de Apoyo', '0', 18),
(137, '-6', 'Apoyo', '446.9999999999999 514.0000000000005', 'Proceso de Apoyo', '0', 18),
(138, '-3', 'Apoyo', '39.00000000000001 509.99999999999966', 'Proceso de Apoyo', '0', 17),
(139, '-5', 'Apoyo', '234 512.0000000000002', 'Proceso de Apoyo', '0', 17),
(140, '-6', 'Apoyo', '446.9999999999999 514.0000000000005', 'Proceso de Apoyo', '0', 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallerol`
--

CREATE TABLE IF NOT EXISTS `detallerol` (
  `der_idUsuario` int(11) NOT NULL,
  `der_idrol` int(11) NOT NULL,
  `der_estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`der_idUsuario`,`der_idrol`),
  KEY `fk_Usuario_has_rol_rol1_idx` (`der_idrol`),
  KEY `fk_Usuario_has_rol_Usuario_idx` (`der_idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `idempresa` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `ruc` varchar(45) DEFAULT NULL,
  `direccion` varchar(55) DEFAULT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idempresa`),
  KEY `fk_empresa_Usuario1_idx` (`idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`idempresa`, `nombre`, `ruc`, `direccion`, `idUsuario`) VALUES
(16, 'LINDLEY SA', '456123', 'direccion', 30),
(17, 'Los Girasoles', '123456', 'av los girasoles', 31),
(18, 'orlando', '123', '123', 32);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estrategico`
--

CREATE TABLE IF NOT EXISTS `estrategico` (
  `idestrategico` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(45) DEFAULT NULL,
  `text` varchar(45) DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL,
  `loc` varchar(45) DEFAULT NULL,
  `group` int(11) DEFAULT NULL,
  `idempresa` int(11) NOT NULL,
  PRIMARY KEY (`idestrategico`),
  KEY `fk_estrategico_empresa1_idx` (`idempresa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=326 ;

--
-- Volcado de datos para la tabla `estrategico`
--

INSERT INTO `estrategico` (`idestrategico`, `key`, `text`, `category`, `loc`, `group`, `idempresa`) VALUES
(298, '-2', 'Enjoy!', 'ContenedorPrimario', '270.9999999999998 257.0000000000005', 0, 16),
(299, '-17', 'End', 'ContenedorApoyo', '273.99999999999994 499.9999999999998', 0, 16),
(300, '-18', 'End', 'ContenedorEstrategico', '274 11', 0, 16),
(301, '-15', 'GestiÃ³n de la AdministraciÃ³n', 'Estrategicos', '-1.9999999999999858 -24.99999999999994', 0, 16),
(302, '-7', 'GestiÃ³n Legal', 'Estrategicos', '127.99999999999989 34.999999999999986', 0, 16),
(303, '-8', 'GestiÃ³n Financiera', 'Estrategicos', '281.00000000000006 -26', 0, 16),
(304, '-9', 'GestiÃ³n de Calidad', 'Estrategicos', '404.99999999999966 40.00000000000006', 0, 16),
(305, '-1', 'Start', 'Start', '-121 264', 0, 16),
(306, '-19', 'End', 'End', '665 251', 0, 16),
(307, '-28', 'GestiÃ³n de la Sustentabilidad', 'Estrategicos', '526 -23.399993896484375', 0, 16),
(308, '-2', 'Enjoy!', 'ContenedorPrimario', '274.9999999999999 258.00000000000045', 0, 18),
(309, '-17', 'End', 'ContenedorApoyo', '278.99999999999994 518.9999999999998', 0, 18),
(310, '-18', 'End', 'ContenedorEstrategico', '274 11', 0, 18),
(311, '-15', 'Estrategico', 'Estrategicos', '-7.999999999999986 9.000000000000057', 0, 18),
(312, '-7', 'Estrategico', 'Estrategicos', '163.99999999999994 8.999999999999986', 0, 18),
(313, '-8', 'Estrategico', 'Estrategicos', '321.0000000000001 8', 0, 18),
(314, '-9', 'Estrategico', 'Estrategicos', '499.99999999999966 9.000000000000057', 0, 18),
(315, '-1', 'Start', 'Start', '-127 261', 0, 18),
(316, '-19', 'End', 'End', '685 254', 0, 18),
(317, '-2', 'Enjoy!', 'ContenedorPrimario', '274.9999999999999 258.00000000000045', 0, 17),
(318, '-17', 'End', 'ContenedorApoyo', '278.99999999999994 518.9999999999998', 0, 17),
(319, '-18', 'End', 'ContenedorEstrategico', '274 11', 0, 17),
(320, '-15', 'Gestion Legal', 'Estrategicos', '-7.999999999999986 9.000000000000057', 0, 17),
(321, '-7', 'Estrategico', 'Estrategicos', '163.99999999999994 8.999999999999986', 0, 17),
(322, '-8', 'Estrategico', 'Estrategicos', '321.0000000000001 8', 0, 17),
(323, '-9', 'Estrategico', 'Estrategicos', '499.99999999999966 9.000000000000057', 0, 17),
(324, '-1', 'Start', 'Start', '-127 261', 0, 17),
(325, '-19', 'End', 'End', '685 254', 0, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indicador`
--

CREATE TABLE IF NOT EXISTS `indicador` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `unidad` varchar(50) NOT NULL,
  `responsable` varchar(50) NOT NULL,
  `formula` int(11) DEFAULT NULL,
  `lineaBase` varchar(50) DEFAULT NULL,
  `valorMeta` varchar(50) DEFAULT NULL,
  `Frecuencia` varchar(50) DEFAULT NULL,
  `rojo` varchar(50) DEFAULT NULL,
  `amarillo` varchar(50) DEFAULT NULL,
  `verde` varchar(50) DEFAULT NULL,
  `objetivo` varchar(200) DEFAULT NULL,
  `proceso_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `indicador`
--

INSERT INTO `indicador` (`id`, `nombre`, `codigo`, `unidad`, `responsable`, `formula`, `lineaBase`, `valorMeta`, `Frecuencia`, `rojo`, `amarillo`, `verde`, `objetivo`, `proceso_id`, `created_at`, `updated_at`) VALUES
(1, 'Botellas sin deficiencia', '10001', '%', 'Jefe de Calidad', 10001, '90%', 'Mas del 99%', 'Diario', '<90%', '90-99%', '>99%', 'ddd', 304, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Calidad de materia prima recepcionada', '10002', '%', 'Jefe de Calidad', 10002, '90%', 'Mas del 99%', 'Diario', '<90%', '90-80%', '>98%', NULL, 304, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Cumplimiento de especificaciones', '10003', '%', 'Jefe de Calidad', 10003, '90%', 'Mas del 99%', 'Diario', '<90%', '90-80%', '>98%', NULL, 304, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Indicador de botellas lavadas con defectos', '20001', '%', 'Jefe', 20001, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 201, '2015-07-02 05:00:00', '0000-00-00 00:00:00'),
(5, 'Indicador de botellas carbonatas producidas sin defectos', '20002', '%', 'Jefe de ProducciÃ³n', 20002, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 201, '2015-07-02 05:00:00', '0000-00-00 00:00:00'),
(6, 'Indicador 3', '20003', '%', 'Jefe de producciÃ³n', 20003, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 201, '2015-07-02 05:00:00', '0000-00-00 00:00:00'),
(7, 'Indice de crecimiento de Venas', '30001', '%', 'Gerencia General', 30001, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 199, '2015-07-02 05:00:00', '0000-00-00 00:00:00'),
(8, 'Cumplimiento de plazos', '30002', '%', 'Gerencia General', 30002, '3%', '5%', 'MENSUAL', 'Menores  del 3%', 'Del 3% al 5%', 'MÃ¡s del 5%', 'Mejorar el porcentaje de cumplimiento de plazos  de pedidos realizados', 199, '2015-07-02 05:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `macroprocesos`
--

CREATE TABLE IF NOT EXISTS `macroprocesos` (
  `idmacro` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) NOT NULL,
  `text` varchar(100) NOT NULL,
  `key` int(11) NOT NULL,
  `idempresa` int(11) NOT NULL,
  PRIMARY KEY (`idmacro`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `macroprocesos`
--

INSERT INTO `macroprocesos` (`idmacro`, `category`, `text`, `key`, `idempresa`) VALUES
(15, 'MacroProceso', 'Almacen', -4, 16),
(16, 'MacroProceso', 'ProducciÃ³n', -27, 16),
(17, 'MacroProceso', 'Ventas', -25, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `primarios`
--

CREATE TABLE IF NOT EXISTS `primarios` (
  `idprimarios` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(45) DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL,
  `text` varchar(45) DEFAULT NULL,
  `loc` varchar(45) DEFAULT NULL,
  `group` int(11) DEFAULT NULL,
  `idempresa` int(11) NOT NULL,
  PRIMARY KEY (`idprimarios`),
  KEY `fk_primarios_empresa1_idx` (`idempresa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=217 ;

--
-- Volcado de datos para la tabla `primarios`
--

INSERT INTO `primarios` (`idprimarios`, `key`, `category`, `text`, `loc`, `group`, `idempresa`) VALUES
(198, '-14', 'Primario', 'Aprovicionamiento', '17.999999999999723 192.0000000000002', -4, 16),
(199, '-10', 'Primario', 'GestiÃ³n de almacen', '28.999999999999723 252.0000000000002', -4, 16),
(200, '-11', 'Primario', 'Pedidos', '-19.000000000000277 312.00000000000017', -4, 16),
(201, '-13', 'Primario', 'Produccion de bebidas carbonatadas', '228.00000000000014 179', -27, 16),
(202, '-16', 'Primario', 'Control de produccion', '230.00000000000014 245.54999999999998', -27, 16),
(203, '-21', 'Primario', 'ProducciÃ³n de bebidas no carbonatadas', '230.00000000000017 321.44999999999993', -27, 16),
(204, '-23', 'Primario', 'Gestion de venta', '528.5 272.18858235436164', -25, 16),
(205, '-24', 'Primario', 'DistribuciÃ³n', '510.5 332.18858235436164', -25, 16),
(206, '-26', 'Primario', 'Servicio al Cliente', '436 179.86666870117188', 0, 16),
(207, '-14', 'Primario', 'Primario', '63 223.00000000000017', 0, 18),
(208, '-10', 'Primario', 'Primario', '242.99999999999986 176', 0, 18),
(209, '-11', 'Primario', 'Primario', '242.99999999999986 264.00000000000006', 0, 18),
(210, '-13', 'Primario', 'Primario', '376.0000000000002 200.00000000000006', 0, 18),
(211, '-16', 'Primario', 'Primario', '524 229', 0, 18),
(212, '-14', 'Primario', 'Primario', '63 223.00000000000017', 0, 17),
(213, '-10', 'Primario', 'Primario', '242.99999999999986 176', 0, 17),
(214, '-11', 'Primario', 'Primario', '242.99999999999986 264.00000000000006', 0, 17),
(215, '-13', 'Primario', 'Primario', '376.0000000000002 200.00000000000006', 0, 17),
(216, '-16', 'Primario', 'Primario', '524 229', 0, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacion`
--

CREATE TABLE IF NOT EXISTS `relacion` (
  `idrelacion` int(11) NOT NULL AUTO_INCREMENT,
  `from` varchar(45) DEFAULT NULL,
  `to` varchar(45) DEFAULT NULL,
  `fromPort` varchar(45) DEFAULT NULL,
  `toPort` varchar(10) NOT NULL,
  `points` varchar(45) DEFAULT NULL,
  `idempresa` int(11) NOT NULL,
  PRIMARY KEY (`idrelacion`),
  KEY `fk_relacion_empresa1_idx` (`idempresa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=471 ;

--
-- Volcado de datos para la tabla `relacion`
--

INSERT INTO `relacion` (`idrelacion`, `from`, `to`, `fromPort`, `toPort`, `points`, `idempresa`) VALUES
(441, '-1', '-18', 'T', 'L', '', 16),
(442, '-19', '-18', 'T', 'R', '', 16),
(443, '-1', '-14', 'R', 'L', '', 16),
(444, '-1', '-11', 'R', 'L', '', 16),
(445, '-24', '-19', 'R', 'L', '', 16),
(446, '-23', '-19', 'R', 'L', '', 16),
(447, '-13', '-16', 'B', 'T', '', 16),
(448, '-10', '-16', 'R', 'L', '', 16),
(449, '-21', '-16', 'T', 'B', '', 16),
(450, '-11', '-10', 'T', 'B', '', 16),
(451, '-14', '-10', 'B', 'T', '', 16),
(452, '-16', '-26', 'R', 'L', '', 16),
(453, '-26', '-24', 'B', 'L', '', 16),
(454, '-26', '-23', 'B', 'L', '', 16),
(455, '-14', '-10', 'R', 'L', '', 18),
(456, '-10', '-11', 'B', 'T', '', 18),
(457, '-11', '-13', 'R', 'L', '', 18),
(458, '-13', '-16', 'R', 'L', '', 18),
(459, '-1', '-18', 'T', 'L', '', 18),
(460, '-19', '-18', 'T', 'R', '', 18),
(461, '-1', '-14', 'R', 'L', '', 18),
(462, '-16', '-19', 'R', 'L', '', 18),
(463, '-14', '-10', 'R', 'L', '', 17),
(464, '-10', '-11', 'B', 'T', '', 17),
(465, '-11', '-13', 'R', 'L', '', 17),
(466, '-13', '-16', 'R', 'L', '', 17),
(467, '-1', '-18', 'T', 'L', '', 17),
(468, '-19', '-18', 'T', 'R', '', 17),
(469, '-1', '-14', 'R', 'L', '', 17),
(470, '-16', '-19', 'R', 'L', '', 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `idrol` int(11) NOT NULL AUTO_INCREMENT,
  `rol_descripcion` varchar(45) DEFAULT NULL,
  `rol_estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `usu_nick` varchar(45) DEFAULT NULL,
  `usu_clave` varchar(45) DEFAULT NULL,
  `usu_estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `usu_nick`, `usu_clave`, `usu_estado`) VALUES
(30, 'Edgar', '123', 1),
(31, 'Carlos', '123456', 1),
(32, 'orlando', '123', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `apoyo`
--
ALTER TABLE `apoyo`
  ADD CONSTRAINT `fk_apoyo_empresa1` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`idempresa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detallerol`
--
ALTER TABLE `detallerol`
  ADD CONSTRAINT `fk_Usuario_has_rol_rol1` FOREIGN KEY (`der_idrol`) REFERENCES `rol` (`idrol`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuario_has_rol_Usuario` FOREIGN KEY (`der_idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `fk_empresa_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `estrategico`
--
ALTER TABLE `estrategico`
  ADD CONSTRAINT `fk_estrategico_empresa1` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`idempresa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `primarios`
--
ALTER TABLE `primarios`
  ADD CONSTRAINT `fk_primarios_empresa1` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`idempresa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `relacion`
--
ALTER TABLE `relacion`
  ADD CONSTRAINT `fk_relacion_empresa1` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`idempresa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
