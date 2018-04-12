-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 23-01-2017 a las 12:30:11
-- Versión del servidor: 10.1.20-MariaDB
-- Versión de PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bomberosbalzargo_SistemaBombero`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesos`
--

CREATE TABLE IF NOT EXISTS `accesos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `MContribuyente` int(11) NOT NULL,
  `MContribuyenteA` int(11) NOT NULL,
  `MContribuyenteE` int(11) NOT NULL,
  `MContribuyenteD` int(11) NOT NULL,
  `MBienes` int(11) NOT NULL,
  `MBienesA` int(11) NOT NULL,
  `MBienesE` int(11) NOT NULL,
  `MBienesD` int(11) NOT NULL,
  `MPFuncionamiento` int(11) NOT NULL,
  `MPFuncionamientoA` int(11) NOT NULL,
  `MPFuncionamientoE` int(11) NOT NULL,
  `MPFuncionamientoD` int(11) NOT NULL,
  `MPRodaje` int(11) NOT NULL,
  `MPRodajeA` int(11) NOT NULL,
  `MPRodajeE` int(11) NOT NULL,
  `MPRodajeD` int(11) NOT NULL,
  `MPContruccion` int(11) NOT NULL,
  `MPContruccionA` int(11) NOT NULL,
  `MPContruccionE` int(11) NOT NULL,
  `MPContruccionD` int(11) NOT NULL,
  `MPOcasional` int(11) NOT NULL,
  `MPOcasionalA` int(11) NOT NULL,
  `MPOcasionalE` int(11) NOT NULL,
  `MPOcasionalD` int(11) NOT NULL,
  `MSistema` int(11) NOT NULL,
  `MSistemaA` int(11) NOT NULL,
  `MSistemaE` int(11) NOT NULL,
  `MSistemaD` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `accesos`
--

INSERT INTO `accesos` (`ID`, `token`, `MContribuyente`, `MContribuyenteA`, `MContribuyenteE`, `MContribuyenteD`, `MBienes`, `MBienesA`, `MBienesE`, `MBienesD`, `MPFuncionamiento`, `MPFuncionamientoA`, `MPFuncionamientoE`, `MPFuncionamientoD`, `MPRodaje`, `MPRodajeA`, `MPRodajeE`, `MPRodajeD`, `MPContruccion`, `MPContruccionA`, `MPContruccionE`, `MPContruccionD`, `MPOcasional`, `MPOcasionalA`, `MPOcasionalE`, `MPOcasionalD`, `MSistema`, `MSistemaA`, `MSistemaE`, `MSistemaD`) VALUES
(1, '$2a$08$P4WSq65FdhWeeACUKCVLmOQb8i6ctdOFMTdxAqm4EmCNLx9xNhbQa', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, '$2a$08$L1rlhxBkjSS9Qinwo.MWJeFVaoT/8A9FX3ki.8EN/.1SepSOT5qp.', 1, 1, 1, 1, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0),
(3, '$2a$08$NoOsiuDbvRG8BVD8awDOWe1zcK15lH7eAEFgRR1EahMMzgSx1HWhi', 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0),
(4, '$2a$08$N2/b1oMbc0jXujAgNycKSOjE9ilcpC1mfbDrO1Awr.A/cgjxuElAi', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banners`
--

CREATE TABLE IF NOT EXISTS `banners` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `banners`
--

INSERT INTO `banners` (`ID`, `titulo`, `imagen`, `codigo`) VALUES
(1, 'Trabajamos por la seguridad', 'banner-lGknzk.jpg', 'lGknzk'),
(2, 'Visite nuestras instalaciones', 'banner-DqOyor.jpg', 'DqOyor'),
(3, 'Cumplimos la Ley', 'banner-fbebl8.jpg', 'fbebl8'),
(4, 'Capacitamos', 'banner-4dDMSs.JPG', '4dDMSs');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_riesgo`
--

CREATE TABLE IF NOT EXISTS `categoria_riesgo` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_comercial` varchar(100) NOT NULL,
  `id_permiso` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `categoria_riesgo`
--

INSERT INTO `categoria_riesgo` (`ID`, `nombre_comercial`, `id_permiso`) VALUES
(1, 'ABACERIA, TIENDAS DE ABARROTES O FRUTERIAS', 100),
(2, 'AGENCIAS DE VIAJE Y TURISMO', 100),
(3, 'TRANSPORTE DE GAS CILINDROS', 300),
(4, 'CONSTRUCCION MENOR', 200),
(5, 'JUEGOS MECANICOS', 400),
(6, 'LECHERIAS ', 100),
(7, 'CYBER', 100),
(8, 'CONSTRUCCION MAYOR', 200),
(9, 'ESPECTACULOS PUBLICOS', 400),
(10, 'TRANSPORTE DE CARBON', 300),
(11, 'TRANSPORTE DE METANO', 300),
(12, 'BINGO', 400),
(13, 'BAILE PUBLICO', 400),
(14, 'QUEMAS DE PIROTECNIAS', 400),
(15, 'TRANSPORTE DE PERSONAS', 300),
(16, 'TRANSPORTE DE MATERIALES INFLAMABLES', 300),
(17, 'AGROQUIMICAS', 100),
(18, 'ANTENAS DE MEDIOS DE COMUNICACIÓN', 100),
(19, 'GASOLINERAS', 100),
(20, 'GIMNASIOS, CENTROS DE MASAJES, SAUNA - VAPOR', 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `código_permisos`
--

CREATE TABLE IF NOT EXISTS `código_permisos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `permiso` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=601 ;

--
-- Volcado de datos para la tabla `código_permisos`
--

INSERT INTO `código_permisos` (`ID`, `permiso`) VALUES
(100, 'Permiso de funcionamiento'),
(200, 'Permiso de construcción '),
(300, 'Permiso de rodaje'),
(400, 'Permiso ocasional'),
(600, 'Certificado de no Adeudar'),
(500, 'Solicitud de inspección ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ruc` varchar(50) NOT NULL,
  `nombre_empresa` varchar(100) NOT NULL,
  `cedula` varchar(50) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ruc` (`ruc`),
  UNIQUE KEY `cedula` (`cedula`),
  UNIQUE KEY `correo` (`correo`),
  KEY `cedula_2` (`cedula`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`ID`, `ruc`, `nombre_empresa`, `cedula`, `nombres`, `apellidos`, `telefono`, `correo`, `direccion`) VALUES
(2, '0912206786001', 'Comercial Orozco', '0912206786', 'SIXTA HILARIA', 'OROZCO ESPANA', 993783924, 'sixtaorozco14@hotmail.com', 'San Jacinto Sur y Via a Daule'),
(3, '0921398814001', 'AGUAYO SA', '0921398814', 'JULIAN', 'AGUAYO', 42030099, 'julianagauyo@yahoo.com', 'AV DEL ESTUDIANTE Y OLMEDO'),
(4, '0915735799001', 'Mercado Central', '0915735799', 'Esteban Jose', 'Alcivar Cedeno', 42030894, 'alcivar@yahoo.com', 'Balzar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `infoempresa`
--

CREATE TABLE IF NOT EXISTS `infoempresa` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `mision` varchar(1000) NOT NULL,
  `vision` varchar(1000) NOT NULL,
  `objetivo` varchar(1000) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `infoempresa`
--

INSERT INTO `infoempresa` (`ID`, `mision`, `vision`, `objetivo`) VALUES
(1, 'Brindar a la comunidad una atención efectiva en los casos emergentes -incendios, rescates u otros para ello cuenta con un recurso humano permanentemente capacitado a fin de proporcionar un excelente servicio en pos de Salvaguardar las vidas y propiedades de la ciudadanía en general.', 'Ser la primera institución de respuesta a las emergencias y desastres en forma inmediata, oportuna y gestión de riesgos a nivel nacional por un servicio efectivo con altos índices de calidad vinculado a la comunidad, dentro de un ambiente profesional y ético con abnegación y disciplina, acorde al avance tecnológico, que resulta en usuarios satisfechos dentro de un contexto de desarrollo sostenible y sustentable del País.', 'Detectar las causas y las condiciones inseguras que originan los siniestros y accidentes en los sitios de trabajo, realizando las inspecciones respectivas, analizando y evaluando los proyectos de seguridad, a fin de minimizar el riesgo de cualquier contingencia laboral y de otra índole que altere la normalidad en las actividades de la ciudadanía.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles`
--

CREATE TABLE IF NOT EXISTS `inmuebles` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_propietario` varchar(50) NOT NULL,
  `clase_bien` varchar(100) NOT NULL,
  `tipo_bien` varchar(100) NOT NULL,
  `clave_catastral` varchar(50) NOT NULL,
  `actividad_economica` varchar(100) NOT NULL,
  `id_actividad_economica` int(11) NOT NULL,
  `categoria_riesgo` varchar(5) NOT NULL,
  `ubicacion` varchar(100) NOT NULL,
  `limites` varchar(100) NOT NULL,
  `area_propiedad` varchar(100) NOT NULL,
  `area_construccion` varchar(100) NOT NULL,
  `caracteristicas` varchar(500) NOT NULL,
  `estado` int(11) NOT NULL COMMENT '(0)cerrado,(1)activo,(2)clausurado',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT 'para saber si se le realizo un permiso a este inmueble',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `clave_catastral` (`clave_catastral`),
  KEY `id_propietario` (`id_propietario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `inmuebles`
--

INSERT INTO `inmuebles` (`ID`, `id_propietario`, `clase_bien`, `tipo_bien`, `clave_catastral`, `actividad_economica`, `id_actividad_economica`, `categoria_riesgo`, `ubicacion`, `limites`, `area_propiedad`, `area_construccion`, `caracteristicas`, `estado`, `status`) VALUES
(9, '0926687856001', 'Establecimientos', 'Urbano', '222', 'ABACERIA, TIENDAS DE ABARROTES O FRUTERIAS', 1, '2', 'asaS', '2323', '23', '23', 'asdasds', 1, 0),
(10, '0926687856001', 'Establecimientos', 'Urbano', '8', 'ABACERIA, TIENDAS DE ABARROTES O FRUTERIAS', 1, '1', 'assa', 'sss', '3434', '232', 'zfsadfsd', 1, 0),
(13, '0925175853', 'Establecimientos', 'Rural', '288', 'LECHERIAS ', 6, '1', 'PUERTO GRANDE', '23', '200', '200', 'VENTA DE LECHE', 1, 1),
(14, '0915735799001', 'Establecimientos', 'Urbano', '8999', 'ABACERIA, TIENDAS DE ABARROTES O FRUTERIAS', 1, '3', 'MERCADO CENTRAL', '27 ', '389', '380', 'VENTA DE PRODUCTOS TERMINADOS', 1, 1),
(15, '0925175853', 'Casa', 'Urbano', '28882', 'BINGO', 12, '2', 'CENTRAL', '992', '23', '23', 'BINGOS ', 1, 1),
(17, '0925175853', 'Casa', 'Rural', '233', 'CONSTRUCCION MENOR', 4, '2', 'PUEBLITO', '22', '234', '233', 'CASA DE CONSTRUCCION ', 1, 0),
(20, '0921398814001', 'Establecimientos', 'Urbano', '500', 'AGROQUIMICAS', 17, '1', 'CENTRAL', 'NORTE 200', '200', '200', 'AGROQUIMICOS', 1, 1),
(21, '0912206786001', 'Casa', 'Urbano', '5667892', 'ABACERIA, TIENDAS DE ABARROTES O FRUTERIAS', 1, '1', 'xxxxxxxxx', 'xxxxxxxxx', '12121', '121212', 'xxxxxxxxxxxxxx', 1, 0),
(22, '0921398814001', 'Establecimientos', 'Urbano', '777', 'CYBER', 7, '1', 'CENTRAL', 'TYY6', '567', '500', 'CYBER', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento_inmuebles`
--

CREATE TABLE IF NOT EXISTS `mantenimiento_inmuebles` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_imueble` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `mantenimiento_inmuebles`
--

INSERT INTO `mantenimiento_inmuebles` (`ID`, `tipo_imueble`) VALUES
(1, 'Casa'),
(2, 'Establecimientos'),
(3, 'Hospitales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento_muebles`
--

CREATE TABLE IF NOT EXISTS `mantenimiento_muebles` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_mueble` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `mantenimiento_muebles`
--

INSERT INTO `mantenimiento_muebles` (`ID`, `tipo_mueble`) VALUES
(1, 'Camionetas'),
(2, 'Buses');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento_rubro`
--

CREATE TABLE IF NOT EXISTS `mantenimiento_rubro` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `periodo` int(11) NOT NULL,
  `id_periodo` int(11) NOT NULL,
  `permiso` varchar(100) NOT NULL,
  `id_permiso` int(11) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `subcategoria` varchar(100) NOT NULL,
  `id_subcategoria` int(11) NOT NULL,
  `valor` double NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '(0)no usada,(1)usada',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `mantenimiento_rubro`
--

INSERT INTO `mantenimiento_rubro` (`ID`, `periodo`, `id_periodo`, `permiso`, `id_permiso`, `categoria`, `id_categoria`, `subcategoria`, `id_subcategoria`, `valor`, `status`) VALUES
(1, 2017, 1, 'Permiso de funcionamiento', 100, 'ABACERIA, TIENDAS DE ABARROTES O FRUTERIAS', 1, 'A', 1, 20, 1),
(2, 2017, 1, 'Permiso de funcionamiento', 100, 'AGENCIAS DE VIAJE Y TURISMO', 2, 'A', 1, 20, 1),
(3, 2017, 1, 'Permiso de funcionamiento', 100, 'ABACERIA, TIENDAS DE ABARROTES O FRUTERIAS', 1, 'B', 2, 30, 1),
(4, 2017, 1, 'Permiso de funcionamiento', 100, 'ABACERIA, TIENDAS DE ABARROTES O FRUTERIAS', 1, 'C', 3, 40, 1),
(5, 2017, 1, 'Permiso de funcionamiento', 100, 'LECHERIAS ', 6, 'A', 1, 20, 1),
(6, 2017, 1, 'Permiso de funcionamiento', 100, 'CYBER', 7, 'A', 1, 10, 0),
(7, 2017, 1, 'Permiso de funcionamiento', 100, 'CYBER', 7, 'B', 2, 15, 0),
(8, 2017, 1, 'Permiso de funcionamiento', 100, 'CYBER', 7, 'C', 3, 20, 0),
(9, 2016, 2, 'Permiso de funcionamiento', 100, 'AGENCIAS DE VIAJE Y TURISMO', 2, 'A', 1, 10, 0),
(10, 2016, 2, 'Permiso de construcción ', 200, 'CONSTRUCCION MENOR', 4, 'A', 1, 20, 0),
(14, 2017, 1, 'Permiso de rodaje', 300, 'TRANSPORTE DE GAS CILINDROS', 3, 'C', 3, 100, 0),
(15, 2017, 1, 'Permiso de rodaje', 300, 'TRANSPORTE DE CARBON', 10, 'C', 3, 80, 1),
(16, 2017, 1, 'Permiso ocasional', 400, 'ESPECTACULOS PUBLICOS', 9, 'B', 2, 50, 0),
(17, 2017, 1, 'Permiso ocasional', 400, 'BINGO', 12, 'B', 2, 50, 1),
(18, 2017, 1, 'Permiso ocasional', 400, 'JUEGOS MECANICOS', 5, 'B', 2, 40, 0),
(19, 2017, 1, 'Permiso de rodaje', 300, 'TRANSPORTE DE PERSONAS', 15, 'B', 2, 35, 0),
(20, 2016, 2, 'Permiso de funcionamiento', 100, 'AGROQUIMICAS', 17, 'A', 1, 100, 1),
(21, 2015, 3, 'Permiso de funcionamiento', 100, 'CYBER', 7, 'A', 1, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mueble`
--

CREATE TABLE IF NOT EXISTS `mueble` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_propietario` varchar(30) NOT NULL,
  `clase_bien` varchar(100) NOT NULL,
  `placa` varchar(7) NOT NULL,
  `tipo_bien` varchar(100) NOT NULL,
  `actividad_economica` varchar(100) NOT NULL,
  `id_actividad_economica` int(11) NOT NULL,
  `categoria_riesgo` varchar(5) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `fecha_fabricacion` date NOT NULL,
  `numero_motor` bigint(20) NOT NULL,
  `numero_chasis` bigint(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT 'campo para validar si ya se hizo un permiso a este mueble',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `placa` (`placa`),
  UNIQUE KEY `numero_motor` (`numero_motor`),
  UNIQUE KEY `numero_chasis` (`numero_chasis`),
  KEY `id_propietario` (`id_propietario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `mueble`
--

INSERT INTO `mueble` (`ID`, `id_propietario`, `clase_bien`, `placa`, `tipo_bien`, `actividad_economica`, `id_actividad_economica`, `categoria_riesgo`, `marca`, `modelo`, `fecha_fabricacion`, `numero_motor`, `numero_chasis`, `status`) VALUES
(3, '0920032703', 'Camionetas', 'GSG6400', ' terrestre ', 'TRANSPORTE DE GAS CILINDROS', 3, '3', 'HYUNDAI', 'TORRENTE', '2014-12-12', 738837718282, 383837773, 0),
(4, '0915735799001', 'Camionetas', 'GSG5680', ' terrestre ', 'TRANSPORTE DE CARBON', 10, '3', 'HYUNDAI', 'GILS', '2000-10-20', 289393, 38934948949494, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`ID`, `titulo`, `descripcion`, `imagen`, `codigo`) VALUES
(1, 'CAMPAÑAS DE PREVENCIÓN', 'EL Cuerpo de Bomberos de Balzar dice no a la pirotécnia. \r\nSe realizan campañas de prevención para el correcto uso de juegos pirotécnicos.', 'noticia-01rD32.jpg', '01rD32'),
(2, 'CAPACITACIÓN', 'Con el compromiso de servir mejor a la comunidad, el CBB se capacita constantemente para estar preparados.', 'noticia-RdijOl.jpg', 'RdijOl'),
(3, 'SIMULACROS', 'Se realizan simulacros y orientación junto a otras instituciones del orden y autoridades.', 'noticia-TSrX6C.jpg', 'TSrX6C'),
(4, 'CHARLAS', 'Se realizan charlas de prevención dirigidas a estudiantes de distintas instituciones.', 'noticia-3BKG0x.jpg', '3BKG0x');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pdfs`
--

CREATE TABLE IF NOT EXISTS `pdfs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `pdfs`
--

INSERT INTO `pdfs` (`ID`, `titulo`, `imagen`, `codigo`) VALUES
(4, 'Rendicion de Cuentas 2014', 'pdf-PuAaqZ.pdf', 'PuAaqZ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodos`
--

CREATE TABLE IF NOT EXISTS `periodos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `periodo` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '(0)no usado,(1)si usado',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `periodos`
--

INSERT INTO `periodos` (`ID`, `periodo`, `status`) VALUES
(1, 2017, 1),
(2, 2016, 1),
(3, 2015, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_construccion`
--

CREATE TABLE IF NOT EXISTS `permiso_construccion` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `contribuyente` varchar(30) NOT NULL COMMENT 'codigo del contribuyente',
  `activo` varchar(100) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_caducidad` date NOT NULL,
  `informe_inspeccion` varchar(100) NOT NULL,
  `pago_impuesto` varchar(100) NOT NULL,
  `plan_contigencia` varchar(100) NOT NULL,
  `cedula` varchar(100) NOT NULL,
  `papeleta_votacion` varchar(100) NOT NULL,
  `contrucciones_planos` varchar(100) NOT NULL,
  `status` int(11) NOT NULL COMMENT '(0)pendiente,(1)procesada,(2)anulada',
  `total_permiso` double NOT NULL,
  `n_permiso` varchar(100) NOT NULL,
  `categoria` varchar(5) NOT NULL,
  `id_cate_riesgo` int(11) NOT NULL,
  `id_bien` varchar(50) NOT NULL,
  `periodo` int(11) NOT NULL,
  `id_periodo` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `n_permiso` (`n_permiso`),
  KEY `contribuyente` (`contribuyente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_funcionamiento`
--

CREATE TABLE IF NOT EXISTS `permiso_funcionamiento` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `contribuyente` varchar(30) NOT NULL,
  `activo` varchar(100) NOT NULL COMMENT 'activo que posee el contribuyente',
  `fecha_creacion` date NOT NULL,
  `fecha_caducidad` date DEFAULT NULL,
  `informe_inspeccion` varchar(100) NOT NULL,
  `ruc_rise` varchar(100) NOT NULL,
  `pago_impuesto` varchar(100) NOT NULL,
  `tasa_bombero` varchar(100) NOT NULL,
  `cedula` varchar(100) NOT NULL,
  `papeleta_votacion` varchar(100) NOT NULL,
  `factura_extintor` varchar(100) NOT NULL,
  `status` int(11) NOT NULL COMMENT '(0)pendiente,(1)precesada,(2)anulada',
  `total_permiso` double NOT NULL COMMENT 'total del permiso adquirido',
  `n_permiso` varchar(100) NOT NULL,
  `categoria` varchar(5) NOT NULL,
  `id_cate_riesgo` int(11) NOT NULL,
  `id_bien` varchar(50) NOT NULL,
  `periodo` int(11) NOT NULL,
  `id_periodo` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `n_permiso` (`n_permiso`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `permiso_funcionamiento`
--

INSERT INTO `permiso_funcionamiento` (`ID`, `contribuyente`, `activo`, `fecha_creacion`, `fecha_caducidad`, `informe_inspeccion`, `ruc_rise`, `pago_impuesto`, `tasa_bombero`, `cedula`, `papeleta_votacion`, `factura_extintor`, `status`, `total_permiso`, `n_permiso`, `categoria`, `id_cate_riesgo`, `id_bien`, `periodo`, `id_periodo`) VALUES
(1, '1303753618', 'Casa', '2017-01-22', '2017-12-31', 'img|1303753618|100-1-1-9762.jpg', 'img|1303753618|100-1-1-97621.jpg', 'img|1303753618|100-1-1-97624.jpg', 'img|1303753618|100-1-1-97625.jpg', 'img|1303753618|100-1-1-97622.jpg', 'img|1303753618|100-1-1-97623.jpg', 'img|1303753618|100-1-1-97626.jpg', 1, 20, '100-1-1-9762', '1', 1, '09876', 2017, 1),
(3, '0925175853', 'Establecimientos', '2017-01-23', '2017-12-31', 'img|0925175853|100-6-1-5692.jpg', 'img|0925175853|100-6-1-56921.jpg', 'img|0925175853|100-6-1-56924.jpg', 'img|0925175853|100-6-1-56925.jpg', 'img|0925175853|100-6-1-56922.jpg', 'img|0925175853|100-6-1-56923.jpg', 'img|0925175853|100-6-1-56926.jpg', 1, 20, '100-6-1-5692', '1', 6, '288', 2017, 1),
(4, '0915735799001', 'Establecimientos', '2017-01-23', '2017-12-31', 'img|0915735799001|100-1-3-2773.jpg', 'img|0915735799001|100-1-3-27731.jpg', 'img|0915735799001|100-1-3-27734.jpg', 'img|0915735799001|100-1-3-27735.jpg', 'img|0915735799001|100-1-3-27732.jpg', 'img|0915735799001|100-1-3-27733.jpg', 'img|0915735799001|100-1-3-27736.jpg', 1, 40, '100-1-3-2773', '3', 1, '8999', 2017, 1),
(5, '0921398814001', 'Establecimientos', '2017-01-23', '2017-12-31', 'img|0921398814001|100-17-1-3413.jpg', 'img|0921398814001|100-17-1-34131.jpg', 'img|0921398814001|100-17-1-34134.jpg', 'img|0921398814001|100-17-1-34135.jpg', 'img|0921398814001|100-17-1-34132.jpg', 'img|0921398814001|100-17-1-34133.jpg', 'img|0921398814001|100-17-1-34136.jpg', 1, 100, '100-17-1-3413', '1', 17, '500', 2016, 2),
(6, '0921398814001', 'Establecimientos', '2017-01-23', '2017-12-31', 'img|0921398814001|100-7-1-6.jpg', 'img|0921398814001|100-7-1-61.jpg', 'img|0921398814001|100-7-1-64.jpg', 'img|0921398814001|100-7-1-65.jpg', 'img|0921398814001|100-7-1-62.jpg', 'img|0921398814001|100-7-1-63.jpg', 'img|0921398814001|100-7-1-66.jpg', 1, 5, '100-7-1-6', '1', 7, '777', 2015, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_ocasional`
--

CREATE TABLE IF NOT EXISTS `permiso_ocasional` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `contribuyente` varchar(50) NOT NULL COMMENT 'codigo del contribuyente',
  `activo` varchar(100) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_caducidad` date NOT NULL,
  `cedula` varchar(100) NOT NULL,
  `papeleta_votacion` varchar(100) NOT NULL,
  `plan_contingencia` varchar(100) NOT NULL,
  `factura_extintor` varchar(100) NOT NULL,
  `status` int(11) NOT NULL COMMENT '(0)pendiente,(1)procesada,(2)anulada',
  `total_permiso` double NOT NULL,
  `n_permiso` varchar(100) NOT NULL,
  `categoria` int(11) NOT NULL,
  `id_cate_riesgo` int(11) NOT NULL,
  `id_bien` varchar(50) NOT NULL,
  `periodo` int(11) NOT NULL,
  `id_periodo` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `contribuyente` (`contribuyente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `permiso_ocasional`
--

INSERT INTO `permiso_ocasional` (`ID`, `contribuyente`, `activo`, `fecha_creacion`, `fecha_caducidad`, `cedula`, `papeleta_votacion`, `plan_contingencia`, `factura_extintor`, `status`, `total_permiso`, `n_permiso`, `categoria`, `id_cate_riesgo`, `id_bien`, `periodo`, `id_periodo`) VALUES
(1, '0925175853', 'Casa', '2017-01-23', '2017-12-31', 'img|0925175853|400-12-2-6927.jpg', 'img|0925175853|400-12-2-69271.jpg', 'img|0925175853|400-12-2-69272.jpg', 'img|0925175853|400-12-2-69273.jpg', 0, 50, '400-12-2-6927', 2, 12, 'undefined', 2017, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_rodaje`
--

CREATE TABLE IF NOT EXISTS `permiso_rodaje` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `contribuyente` varchar(50) NOT NULL COMMENT 'codigo del contribuyente',
  `activo` varchar(100) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_caducidad` date NOT NULL,
  `informe_inspeccion` varchar(100) NOT NULL,
  `matricula` varchar(100) NOT NULL,
  `licencia_conducir` varchar(100) NOT NULL,
  `cedula` varchar(100) NOT NULL,
  `papeleta_votacion` varchar(100) NOT NULL,
  `status` int(11) NOT NULL COMMENT '(0)pendiente,(1)procesada,(2)anulada',
  `fotovehiculo1` varchar(100) NOT NULL,
  `fotovehiculo2` varchar(100) NOT NULL,
  `fotovehiculo3` varchar(100) NOT NULL,
  `total_permiso` double NOT NULL,
  `n_permiso` varchar(100) NOT NULL,
  `categoria` varchar(5) NOT NULL,
  `id_cate_riesgo` int(11) NOT NULL,
  `id_bien` varchar(50) NOT NULL,
  `periodo` int(11) NOT NULL,
  `id_periodo` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `contribuyente` (`contribuyente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `permiso_rodaje`
--

INSERT INTO `permiso_rodaje` (`ID`, `contribuyente`, `activo`, `fecha_creacion`, `fecha_caducidad`, `informe_inspeccion`, `matricula`, `licencia_conducir`, `cedula`, `papeleta_votacion`, `status`, `fotovehiculo1`, `fotovehiculo2`, `fotovehiculo3`, `total_permiso`, `n_permiso`, `categoria`, `id_cate_riesgo`, `id_bien`, `periodo`, `id_periodo`) VALUES
(1, '0915735799001', 'Camionetas', '2017-01-23', '2017-12-31', 'img|0915735799001|00001.jpg', 'img|0915735799001|000013.jpg', 'img|0915735799001|000014.jpg', 'img|0915735799001|000011.jpg', 'img|0915735799001|000012.jpg', 1, 'img|0915735799001|000015.jpg', 'img|0915735799001|000016.jpg', 'img|0915735799001|000017.jpg', 80, '300-10-3-1401', '3', 10, 'GSG5680', 2017, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(30) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `sexo` varchar(5) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `correo` (`correo`),
  UNIQUE KEY `cedula_2` (`cedula`),
  KEY `cedula` (`cedula`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`ID`, `cedula`, `nombres`, `apellidos`, `sexo`, `telefono`, `correo`, `direccion`) VALUES
(3, '0925175853', 'Erika', 'Espinoza Orozco', 'F', 42030036, 'ericka_lovely_girl@hotmail.com', 'Balzar'),
(5, '0920032703', 'Pedro Elias', 'Arellano Bedon', 'M', 42030036, 'pepe_arellano2011@hotmail.com', 'Balzar Puerto Grande'),
(6, '0920111531', 'evelyn', 'cherrez', 'F', 967009466, 'esolis@uagraria.edu.ec', 'El recreo'),
(7, '0912206786', 'SIXTA HILARIA', 'OROZCO ESPANIA', 'F', 998947477, 'sixtaorozco14@hotmail.com', 'SAN JACINTO SUR'),
(8, '0919041723', 'JENIIFER', 'JURADO ALCIVAR', 'F', 42903993, 'pepearellano2011@hotmail.com', 'balzar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes_ingresos`
--

CREATE TABLE IF NOT EXISTS `reportes_ingresos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `permiso` varchar(100) NOT NULL,
  `id_permiso` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `valor` double NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `reportes_ingresos`
--

INSERT INTO `reportes_ingresos` (`ID`, `permiso`, `id_permiso`, `fecha`, `valor`) VALUES
(1, 'Permiso de funcionamiento', 100, '2017-01-21', 10000),
(2, 'Permiso de funcionamiento', 100, '2017-01-21', 10000),
(3, 'Permiso de funcionamiento', 100, '2017-01-21', 121212),
(4, 'Permiso de funcionamiento', 100, '2017-01-21', 40000),
(7, 'Permiso de funcionamiento', 100, '2017-01-22', 20),
(6, 'Permiso de construcción', 200, '2017-01-21', 20),
(8, 'Permiso de rodaje', 300, '2017-01-22', 15),
(9, 'Permiso de funcionamiento', 100, '2017-01-22', 40000),
(10, 'Permiso Ocasional', 400, '2017-01-22', 20),
(11, 'Permiso de funcionamiento', 100, '2017-01-23', 20),
(12, 'Permiso de funcionamiento', 100, '2017-01-23', 40),
(13, 'Permiso Ocasional', 400, '2017-01-23', 50),
(14, 'Permiso de construcción', 200, '2017-01-23', 50),
(15, 'Permiso de construcción', 200, '2017-01-23', 20),
(16, 'Permiso de construcción', 200, '2017-01-23', 20),
(17, 'Permiso de construcción', 200, '2017-01-23', 20),
(18, 'Permiso de funcionamiento', 100, '2017-01-23', 100),
(19, 'Permiso de rodaje', 300, '2017-01-23', 80),
(20, 'Permiso de funcionamiento', 100, '2017-01-23', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

CREATE TABLE IF NOT EXISTS `subcategoria` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `subcategoria` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '(0)no usada,(1)usada',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`ID`, `subcategoria`, `status`) VALUES
(1, 'A', 1),
(2, 'B', 1),
(3, 'C', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_inmuebles`
--

CREATE TABLE IF NOT EXISTS `tipo_inmuebles` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_imueble` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tipo_inmuebles`
--

INSERT INTO `tipo_inmuebles` (`ID`, `tipo_imueble`) VALUES
(1, 'Urbano'),
(2, 'Rural');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_muebles`
--

CREATE TABLE IF NOT EXISTS `tipo_muebles` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_mueble` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tipo_muebles`
--

INSERT INTO `tipo_muebles` (`ID`, `tipo_mueble`) VALUES
(1, ' terrestre '),
(2, 'fluvial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `activo` int(11) NOT NULL COMMENT '(1)activo,(0)desactivado',
  `rol` varchar(50) NOT NULL,
  `token` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `correo` (`correo`),
  UNIQUE KEY `usuario` (`usuario`),
  UNIQUE KEY `token_2` (`token`),
  KEY `token` (`token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `usuario`, `clave`, `correo`, `activo`, `rol`, `token`) VALUES
(3, 'admin', 'tsJDkvSwhA3Pe8nGFeTVFqQby3LIgOQpbxX8C3KFYY9L1TgPc0IZYUDd1syqWFcFtrNvQTbTL2QFoPa+m0/Eow==', 'admin@ava.com', 1, 'Administrador', '$2a$08$P4WSq65FdhWeeACUKCVLmOQb8i6ctdOFMTdxAqm4EmCNLx9xNhbQa'),
(6, 'ANITA', 'DaP8XF3G9OWCQ8zuaZF2uhXXKglOiuPYYcNlpF6BfRzYjWvwtV7ZkGbw4pK8Q3addZjrx8au978Kq8zVAg2uJg==', 'anita@hotmail.com', 1, 'Usuario', '$2a$08$N2/b1oMbc0jXujAgNycKSOjE9ilcpC1mfbDrO1Awr.A/cgjxuElAi');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
