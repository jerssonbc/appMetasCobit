-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-09-2015 a las 19:39:46
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `cobit`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dimensiones`
--

CREATE TABLE IF NOT EXISTS `dimensiones` (
  `iddimension` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`iddimension`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `dimensiones`
--

INSERT INTO `dimensiones` (`iddimension`, `nombre`) VALUES
(1, 'Financiera'),
(2, 'Cliente'),
(3, 'Interna'),
(4, 'Aprendizaje y Crecimiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `idempresa` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `ruc` varchar(15) NOT NULL,
  PRIMARY KEY (`idempresa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`idempresa`, `idUsuario`, `nombre`, `direccion`, `ruc`) VALUES
(1, 1, 'SENCICO', 'Av EspaÃ±a Cuadra 3', '5478541247');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objetivocorporativo`
--

CREATE TABLE IF NOT EXISTS `objetivocorporativo` (
  `idobjetivocorporativo` int(11) NOT NULL AUTO_INCREMENT,
  `idEmpresa` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `iddimension` int(11) NOT NULL,
  PRIMARY KEY (`idobjetivocorporativo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `objetivocorporativo`
--

INSERT INTO `objetivocorporativo` (`idobjetivocorporativo`, `idEmpresa`, `nombre`, `iddimension`) VALUES
(1, 1, 'Valor para las partes interesadas de las inversiones de negocio', 1),
(2, 1, 'Cartera de productos y servicios competitivos', 1),
(3, 1, 'Riesgos de negocio gestionados (salvaguarda de activo)', 1),
(4, 1, 'Cumplimiento de leyes y regulaciones externas', 1),
(5, 1, 'Transparencia financiera', 1),
(6, 1, 'Cultura de servicio orientada al cliente', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objetivoti`
--

CREATE TABLE IF NOT EXISTS `objetivoti` (
  `idObjetivo` int(11) NOT NULL AUTO_INCREMENT,
  `idEmpresa` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `iddimension` int(11) NOT NULL,
  PRIMARY KEY (`idObjetivo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `objetivoti`
--

INSERT INTO `objetivoti` (`idObjetivo`, `idEmpresa`, `nombre`, `iddimension`) VALUES
(1, 1, 'Alineamiento de TI y estrategia de negocio', 1),
(2, 1, 'Cumplimiento y soporte de la TI al cumplimiento del negocio de las leyes y regulaciones externas', 1),
(3, 1, 'Compromiso de la direcciÃ³n ejecutiva para tomar decisiones relacionadas con TI', 1),
(4, 1, 'Riesgos de negocio relacionados con las TI gestionados', 1),
(5, 1, 'RealizaciÃ³n de beneficios del portafolio de Inversiones y Servicios relacionados con las TI', 1),
(6, 1, 'Transparencia de los costes, beneficios y riesgos de las TI', 1),
(7, 1, 'Entrega de servicios de TI de acuerdo a los requisitos del negocio', 2),
(8, 1, 'Uso adecuado de aplicaciones, informaciÃ³n y soluciones tecnolÃ³gicas', 2),
(9, 1, 'Agilidad de las TI', 3),
(10, 1, 'Seguridad de la informaciÃ³n, infraestructura de procesamiento y aplicaciones', 3),
(11, 1, 'OptimizaciÃ³n de activos, recursos y capacidades de las TI', 3),
(12, 1, 'CapacitaciÃ³n y soporte de procesos de negocio integrando aplicaciones y tecnologÃ­a en procesos de negocio', 3),
(13, 1, 'Entrega de Programas que proporcionen beneficios a tiempo, dentro del presupuesto y satisfaciendo los requisitos y\nnormas de calidad.', 3),
(14, 1, 'Disponibilidad de informaciÃ³n Ãºtil y relevante para la toma de decisiones', 3),
(15, 1, 'Cumplimiento de las polÃ­ticas internas por parte de las TI', 3),
(16, 1, 'Personal del negocio y de las TI competente y motivado', 4),
(17, 1, 'Conocimiento, experiencia e iniciativas para la innovaciÃ³n de negocio', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacionobjetivos`
--

CREATE TABLE IF NOT EXISTS `relacionobjetivos` (
  `idrelacion` int(11) NOT NULL AUTO_INCREMENT,
  `idobjetivocorporativo` int(11) NOT NULL,
  `idobjetivoti` int(11) NOT NULL,
  `descripcion` varchar(20) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`idrelacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `usu_nick` varchar(50) NOT NULL,
  `usu_clave` varchar(100) NOT NULL,
  `usu_estado` int(11) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `usu_nick`, `usu_clave`, `usu_estado`) VALUES
(1, 'edgarCtz', 'e10adc3949ba59abbe56e057f20f883e', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
