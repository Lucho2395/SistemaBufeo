-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-09-2020 a las 05:46:10
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemabufeo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoryp`
--

CREATE TABLE `categoryp` (
  `id_categoryp` int(11) NOT NULL,
  `categoryp_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `categoryp_description` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categoryp`
--

INSERT INTO `categoryp` (`id_categoryp`, `categoryp_name`, `categoryp_description`) VALUES
(1, 'GENERAL', 'VARIOS'),
(2, 'LACTEOS', '--'),
(3, 'FRITURAS', '--');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `client_razonsocial` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `client_razonsocial_sunat` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `client_name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `client_type` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `id_tipodocumento` int(11) NOT NULL,
  `client_number` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `client_correo` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `client_address` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_telephone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `client_estado` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`id_client`, `client_razonsocial`, `client_razonsocial_sunat`, `client_name`, `client_type`, `id_tipodocumento`, `client_number`, `client_correo`, `client_address`, `client_telephone`, `client_date`, `client_estado`) VALUES
(1, '', '', 'ANONIMO', 'PERSONA', 2, '11111111', '', '', '', '2020-09-03 22:59:40', 1),
(2, '', '', 'Luis', 'PERSONA', 2, '71106432', '', 'Alzamora 958', '953295553', '2020-09-03 22:59:40', 1),
(3, '', '', 'Adrian Salazar', 'PERSONA', 4, '10767676765', '', 'Av. siempre viva', '965732145', '2020-09-03 22:59:40', 1),
(18, '', '', 'Fiorela Ayala', 'PERSONA', 2, '71025800', '', 'Circunvalacion', '9316152632', '2020-09-03 22:59:40', 1),
(19, '', '', 'Emma Bartra', 'PERSONA', 2, '05329838', '', 'alzamora', '923261522', '2020-09-03 22:59:40', 1),
(20, '', '', 'Clever', 'PERSONA', 2, '04321212', '', 'alalalala', '91919191', '2020-09-03 22:59:40', 1),
(21, '', '', 'Mechon asass', 'PERSONA', 4, '17110673632', '', 'San juan', '965656565', '2020-09-03 22:59:40', 1),
(22, '', '', 'Judhit Linares', 'EMPRESA', 2, '27110640', '', 'sdgsfd', '987654345', '2020-09-03 22:59:40', 1),
(23, '', '', 'Mercedes', 'PERSONA', 2, '71106431', '', 'dfgdfgg', '3534545', '2020-09-03 22:59:40', 1),
(24, '', '', 'Gabriel', 'PERSONA', 4, '20110643211', '', 'sdfsfd', '345543', '2020-09-03 22:59:40', 1),
(25, '', '', 'sfdsff', 'PERSONA', 4, '71106432222', '', 'sdfsdf', '45345435', '2020-09-03 22:59:40', 1),
(26, '', '', 'dsfdsfdsf', 'PERSONA', 4, '71106432110', '', 'sdfgddg', '354545', '2020-09-03 22:59:40', 1),
(27, '', '', 'sffgdfgdfgdfg', 'PERSONA', 2, '71106400', '', 'dgdfgdfgdfg', '345345345', '2020-09-03 22:59:40', 1),
(28, '', '', 'FHL', 'EMPRESA', 4, '10711064325', '', 'bermudez 1010', '123456789', '2020-09-03 22:59:40', 1),
(29, 'HIPERMERCADO PRECIO UNO', 'HIPERMERCADO PRECIO UNO', 'HIPERMERCADO PRECIO UNO', 'EMPRESA', 4, '20778654516', '', 'aV. DEL eJERCITO 1289', '162537445', '2020-09-03 22:59:40', 1),
(30, 'BUFEO TEC', 'BUFEO TEC', 'BUFEO TEC', 'EMPRESA', 4, '20987654823', '', 'PEvas 1654', '987654321', '2020-09-03 22:59:40', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correlative`
--

CREATE TABLE `correlative` (
  `id_correlative` int(11) NOT NULL,
  `correlative_b` int(11) NOT NULL,
  `correlative_f` int(11) NOT NULL,
  `correlative_in` int(11) NOT NULL,
  `correlative_out` int(11) NOT NULL,
  `correlative_p` int(11) NOT NULL,
  `correlative_nc` int(11) NOT NULL,
  `correlative_nd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `correlative`
--

INSERT INTO `correlative` (`id_correlative`, `correlative_b`, `correlative_f`, `correlative_in`, `correlative_out`, `correlative_p`, `correlative_nc`, `correlative_nd`) VALUES
(1, 100121, 100032, 100009, 100006, 100008, 100003, 100003);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `debt`
--

CREATE TABLE `debt` (
  `id_debt` int(11) NOT NULL,
  `id_saleproduct` int(11) NOT NULL,
  `debt_total` double NOT NULL,
  `debt_cancelled` double NOT NULL,
  `debt_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `debtpay`
--

CREATE TABLE `debtpay` (
  `id_debtpay` int(11) NOT NULL,
  `id_debt` int(11) NOT NULL,
  `id_turn` int(11) NOT NULL,
  `debtpay_mont` double NOT NULL,
  `debtpay_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `debtrent`
--

CREATE TABLE `debtrent` (
  `id_debtrent` int(11) NOT NULL,
  `id_salerent` int(11) NOT NULL,
  `debtrent_total` double NOT NULL,
  `debtrent_cancelled` double NOT NULL,
  `debtrent_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `debtrentpay`
--

CREATE TABLE `debtrentpay` (
  `id_debtrentpay` int(11) NOT NULL,
  `id_debtrent` int(11) NOT NULL,
  `id_turn` int(11) NOT NULL,
  `debtrentpay_mont` double NOT NULL,
  `debtrent_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `empresa_nombre` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `empresa_nombrecomercial` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `empresa_descripcion` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_ruc` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `empresa_domiciliofiscal` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_telefono1` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_telefono2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_celular1` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_celular2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_foto` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_correo` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `empresa_estado` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `empresa_nombre`, `empresa_nombrecomercial`, `empresa_descripcion`, `empresa_ruc`, `empresa_domiciliofiscal`, `empresa_telefono1`, `empresa_telefono2`, `empresa_celular1`, `empresa_celular2`, `empresa_foto`, `empresa_correo`, `empresa_date`, `empresa_estado`) VALUES
(1, 'SOFCON E.I.R.L.', 'GNIO CONSULTORES', 'GNIO CONSULTORES', '20601898447', 'JR. CAHUIDE NRO. 226 - PISO 3', NULL, NULL, '953295553', NULL, NULL, 'luis.salazarbartra01.ls@gmail.com', '2020-08-30 17:16:47', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expense`
--

CREATE TABLE `expense` (
  `id_expense` int(11) NOT NULL,
  `id_turn` int(11) NOT NULL,
  `expense_mont` double NOT NULL,
  `expense_description` varchar(120) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `expense`
--

INSERT INTO `expense` (`id_expense`, `id_turn`, `expense_mont`, `expense_description`) VALUES
(1, 5, 5, 'gasolina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `igv`
--

CREATE TABLE `igv` (
  `id_igv` int(11) NOT NULL,
  `igv_codigo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `igv_codigoafectacion` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '10',
  `igv_descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `igv_codigoInternacional` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `igv_nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tipodeafectacion_igv` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `igv_estado` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `igv`
--

INSERT INTO `igv` (`id_igv`, `igv_codigo`, `igv_codigoafectacion`, `igv_descripcion`, `igv_codigoInternacional`, `igv_nombre`, `tipodeafectacion_igv`, `igv_estado`) VALUES
(1, '1000', '10', 'IGV Impuesto General a las Ventas', 'VAT', 'IGV', 'Gravado - Operación Onerosa', 1),
(2, '9998', '30', 'Inafecta', 'FRE', 'INA', 'Inafecto - Operación Onerosa', 1),
(3, '9997', '20', 'Exonerado', 'VAT', 'EXO', 'Exonerado - Operación Onerosa', 1),
(4, '9996', '11', 'Gratuito', 'FRE', 'GRA', 'Gravado - Retiro por premio', 1),
(5, '9996', '12', 'Gratuito', 'FRE', 'GRA', 'Gravado - Retiro por donación', 1),
(6, '9996', '13', 'Gratuito', 'FRE', 'GRA', 'Gravado - Retiro', 1),
(7, '9996', '14', 'Gratuito', 'FRE', 'GRA', 'Gravado - Retiro por publicidad', 1),
(8, '9996', '15', 'Gratuito', 'FRE', 'GRA', 'Gravado - Bonificaciones', 1),
(9, '9996', '16', 'Gratuito', 'FRE', 'GRA', 'Gravado - Retiro por entrega a trabajadores', 1),
(10, '1016', '17', 'Impuesto a la Venta Arroz Pilado', 'VAT', 'IVAP', 'Gravado - IVAP', 1),
(11, '9996', '21', 'Gratuita', 'FRE', 'GRA', 'Exonerado - Transferencia gratuita', 1),
(12, '9996', '31', 'Gratuito', 'FRE', 'GRA', 'Inafecta - Retiro por Bonificación', 1),
(13, '9996', '32', 'Gratuito', 'FRE', 'GRA', 'Inafecto - Retiro', 1),
(14, '9996', '33', 'Gratuito', 'FRE', 'GRA', 'Inafecto - Retiro por Muestras Médicas', 1),
(15, '9996', '34', 'Gratuito', 'FRE', 'GRA', 'Inafecto - Retiro por Convenio Colectivo', 1),
(16, '9996', '35', 'Gratuito', 'FRE', 'GRA', 'Inafecto - Retiro por premio', 1),
(17, '9996', '36', 'Gratuito', 'FRE', 'GRA', 'Inafecto - Retiro por publicidad', 1),
(18, '9996', '37', 'Gratuito', 'FRE', 'GRA', 'Inafecto - Transferencia gratuita', 1),
(19, '9995', '40', 'Exportación', 'FRE', 'EXP', 'Exportación de Bienes o Servicios', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `location`
--

CREATE TABLE `location` (
  `id_location` int(11) NOT NULL,
  `id_typelocation` int(11) NOT NULL,
  `location_name` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `location_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locationrent`
--

CREATE TABLE `locationrent` (
  `id_locationrent` int(11) NOT NULL,
  `id_salerent` int(11) NOT NULL,
  `id_location` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medida`
--

CREATE TABLE `medida` (
  `medida_id` int(11) NOT NULL,
  `medida_codigo_unidad` varchar(100) COLLATE utf32_unicode_ci NOT NULL,
  `medida_nombre` varchar(50) COLLATE utf32_unicode_ci DEFAULT NULL,
  `medida_activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Volcado de datos para la tabla `medida`
--

INSERT INTO `medida` (`medida_id`, `medida_codigo_unidad`, `medida_nombre`, `medida_activo`) VALUES
(1, '4A', 'BOBINAS                                           ', 0),
(2, 'BJ', 'BALDE                                             ', 0),
(3, 'BLL', 'BARRILES                                          ', 0),
(4, 'BG', 'BOLSA                                             ', 0),
(5, 'BO', 'BOTELLAS                                          ', 1),
(6, 'BX', 'CAJA                                              ', 1),
(7, 'CT', 'CARTONES                                          ', 0),
(8, 'CMK', 'CENTIMETRO CUADRADO                               ', 0),
(9, 'CMQ', 'CENTIMETRO CUBICO                                 ', 0),
(10, 'CMT', 'CENTIMETRO LINEAL                                 ', 0),
(11, 'CEN', 'CIENTO DE UNIDADES                                ', 0),
(12, 'CY', 'CILINDRO                                          ', 0),
(13, 'CJ', 'CONOS                                             ', 0),
(14, 'DZN', 'DOCENA                                            ', 0),
(15, 'DZP', 'DOCENA POR 10**6                                  ', 0),
(16, 'BE', 'FARDO                                             ', 0),
(17, 'GLI', 'GALON INGLES (4,545956L)', 0),
(18, 'GRM', 'GRAMO                                             ', 0),
(19, 'GRO', 'GRUESA                                            ', 0),
(20, 'HLT', 'HECTOLITRO                                        ', 0),
(21, 'LEF', 'HOJA                                              ', 0),
(22, 'SET', 'JUEGO                                             ', 0),
(23, 'KGM', 'KILOGRAMO                                         ', 0),
(24, 'KTM', 'KILOMETRO                                         ', 0),
(25, 'KWH', 'KILOVATIO HORA                                    ', 0),
(26, 'KT', 'KIT                                               ', 0),
(27, 'CA', 'LATAS                                             ', 0),
(28, 'LBR', 'LIBRAS                                            ', 0),
(29, 'LTR', 'LITRO                                             ', 1),
(30, 'MWH', 'MEGAWATT HORA                                     ', 0),
(31, 'MTR', 'METRO                                             ', 1),
(32, 'MTK', 'METRO CUADRADO                                    ', 0),
(33, 'MTQ', 'METRO CUBICO                                      ', 0),
(34, 'MGM', 'MILIGRAMOS                                        ', 0),
(35, 'MLT', 'MILILITRO                                         ', 0),
(36, 'MMT', 'MILIMETRO                                         ', 0),
(37, 'MMK', 'MILIMETRO CUADRADO                                ', 0),
(38, 'MMQ', 'MILIMETRO CUBICO                                  ', 0),
(39, 'MLL', 'MILLARES                                          ', 0),
(40, 'UM', 'MILLON DE UNIDADES                                ', 0),
(41, 'ONZ', 'ONZAS                                             ', 0),
(42, 'PF', 'PALETAS                                           ', 0),
(43, 'PK', 'PAQUETE                                           ', 0),
(44, 'PR', 'PAR                                               ', 0),
(45, 'FOT', 'PIES                                              ', 0),
(46, 'FTK', 'PIES CUADRADOS                                    ', 0),
(47, 'FTQ', 'PIES CUBICOS                                      ', 0),
(48, 'C62', 'PIEZAS                                            ', 0),
(49, 'PG', 'PLACAS                                            ', 0),
(50, 'ST', 'PLIEGO                                            ', 0),
(51, 'INH', 'PULGADAS                                          ', 0),
(52, 'RM', 'RESMA                                             ', 0),
(53, 'DR', 'TAMBOR                                            ', 0),
(54, 'STN', 'TONELADA CORTA                                    ', 0),
(55, 'LTN', 'TONELADA LARGA                                    ', 0),
(56, 'TNE', 'TONELADAS                                         ', 0),
(57, 'TU', 'TUBOS                                             ', 0),
(58, 'NIU', 'UNIDAD (BIENES)                                   ', 1),
(59, 'ZZ', 'UNIDAD (SERVICIOS) ', 1),
(60, 'GLL', 'US GALON (3,7843 L)', 0),
(61, 'YRD', 'YARDA                                             ', 0),
(62, 'YDK', 'YARDA CUADRADA                                    ', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `menu_name` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `menu_icon` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `menu_controller` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `menu_order` int(11) NOT NULL,
  `menu_status` tinyint(4) NOT NULL,
  `menu_show` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id_menu`, `menu_name`, `menu_icon`, `menu_controller`, `menu_order`, `menu_status`, `menu_show`) VALUES
(1, 'Login', '-', 'Login', 0, 1, 0),
(2, 'Cierre de Sesion', 'fa fa-sign-out', 'Logout', 1000, 1, 1),
(3, 'Panel de Inicio', 'fa fa-dashboard', 'Admin', 1, 1, 1),
(4, 'Roles de Usuario', 'fa fa-user-secret', 'Role', 3, 1, 1),
(5, 'Gestion Menú', 'fa fa-desktop', 'Menu', 2, 1, 1),
(9, 'Personas', 'fa fa-group', 'Person', 4, 1, 1),
(10, 'Usuarios', 'fa fa-odnoklassniki', 'User', 4, 1, 1),
(11, 'Editar Datos', 'fa fa-external-link', 'Edit', 9, 1, 1),
(12, 'Inventario', 'fa fa-industry', 'Inventory', 3, 1, 1),
(13, 'Ventas', 'fa fa-credit-card', 'Sell', 4, 1, 1),
(14, 'Apertura de Caja', 'fa fa-link', 'Turn', 6, 1, 1),
(15, 'Reporte', 'fa fa-calendar-minus-o', 'Report', 7, 1, 1),
(16, 'Egresos', 'fa fa-folder-o', 'Expense', 9, 1, 1),
(17, 'Gestion de Usuarios', 'fa fa-users', 'Userg', 8, 1, 1),
(18, 'Clientes', 'fa fa-child', 'Client', 6, 1, 1),
(19, 'Correlativos', 'fa fa-caret-square-o-right', 'Correlative', 10, 1, 1),
(20, 'Categorias Producto', 'fa fa-tags', 'Categoryp', 4, 1, 1),
(21, 'Proveedor', 'fa fa-qq', 'Proveedor', 3, 1, 1),
(22, 'Venta de Gas', 'fa fa-plus', 'SellGas', 4, 1, 1),
(23, 'Negocios', 'fa fa- creative-commons', 'Negocio', 3, 0, 0),
(24, 'Unidad de Medidas', 'fa fa-qrcode', 'UnidadMedida', 5, 1, 1),
(25, 'Unidad de Medidas', 'fa fa-qrcode', 'UnidadMedida', 5, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monedas`
--

CREATE TABLE `monedas` (
  `id` int(11) NOT NULL,
  `moneda` varchar(50) NOT NULL,
  `abreviado` varchar(10) NOT NULL,
  `abrstandar` varchar(10) NOT NULL,
  `simbolo` varchar(2) NOT NULL,
  `activo` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `monedas`
--

INSERT INTO `monedas` (`id`, `moneda`, `abreviado`, `abrstandar`, `simbolo`, `activo`) VALUES
(1, 'soles', 'sol', 'PEN', 'S/', '1'),
(2, 'dólares', 'dol', 'USD', '$', '1'),
(3, 'euros', 'eur', 'EUR', 'E', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `object`
--

CREATE TABLE `object` (
  `id_object` int(11) NOT NULL,
  `object_name` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `object_description` varchar(600) COLLATE utf8_spanish_ci NOT NULL,
  `object_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `optionm`
--

CREATE TABLE `optionm` (
  `id_optionm` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `optionm_name` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `optionm_function` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `optionm_show` tinyint(1) NOT NULL,
  `optionm_status` tinyint(4) NOT NULL,
  `optionm_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `optionm`
--

INSERT INTO `optionm` (`id_optionm`, `id_menu`, `optionm_name`, `optionm_function`, `optionm_show`, `optionm_status`, `optionm_order`) VALUES
(1, 1, 'Iniciar Sesion', 'index', 0, 1, 0),
(2, 2, 'Finalizar Sesion', 'singOut', 1, 1, 1),
(3, 3, 'Inicio', 'index', 1, 1, 1),
(4, 4, 'Agregar Rol', 'add', 1, 1, 1),
(5, 4, 'Ver Roles', 'all', 1, 1, 2),
(6, 4, 'Editar Rol', 'edit', 0, 1, 0),
(7, 5, 'Ver Todo', 'list', 1, 1, 2),
(8, 5, 'Iconos del Sistema', 'icons', 1, 1, 5),
(9, 5, 'Agregar Menu', 'add', 1, 1, 1),
(10, 5, 'Editar Menú', 'edit', 0, 1, 1),
(11, 5, 'Gestion Accesos Por Roles', 'role', 0, 1, 5),
(12, 5, 'Ver Opciones Menú', 'functions', 0, 1, 1),
(13, 5, 'Agregar Opción', 'addf', 0, 1, 1),
(14, 5, 'Editar Opción', 'editf', 0, 1, 1),
(15, 5, 'Ver Permisos de Opción', 'listp', 0, 1, 1),
(16, 5, 'Agregar Permiso', 'addp', 0, 1, 1),
(17, 5, 'Editar Permiso', 'editp', 0, 1, 1),
(18, 9, 'Agregar Persona', 'add', 1, 1, 1),
(19, 9, 'Editar Persona', 'edit', 0, 1, 3),
(20, 9, 'Ver Personas', 'all', 1, 1, 2),
(22, 10, 'Agregar Usuario', 'add', 1, 1, 1),
(23, 10, 'Ver Usuarios', 'all', 1, 1, 2),
(24, 10, 'Editar Usuario', 'edit', 0, 1, 3),
(25, 10, 'Cambiar Contraseña', 'changep', 0, 1, 4),
(26, 11, 'Editar Datos Personales', 'info', 1, 1, 1),
(27, 11, 'Cambiar Nombre de Usuario', 'changeUser', 1, 1, 2),
(28, 11, 'Cambiar Contraseña', 'changepass', 1, 1, 3),
(35, 4, 'Gestionar Opciones', 'options', 0, 1, 3),
(36, 12, 'Listar Productos', 'listProducts', 1, 1, 2),
(37, 12, 'Agregar Producto', 'addProduct', 1, 1, 1),
(38, 12, 'Editar Producto', 'editProduct', 0, 1, 1),
(39, 12, 'Ver Costo de Venta', 'productForsale', 0, 1, 1),
(40, 12, 'Agregar Precio de Venta', 'addProductforsale', 0, 1, 1),
(41, 12, 'Editar Precio de Venta', 'editProductforsale', 0, 1, 1),
(42, 13, 'Realizar Venta', 'fastSell', 1, 1, 1),
(43, 14, 'Agregar Turno', 'add', 0, 1, 1),
(44, 14, 'Ver Turnos', 'seeAll', 1, 1, 2),
(45, 12, 'Agregar Stock de Producto', 'addProductstock', 0, 1, 1),
(46, 15, 'Ver Reporte del Dia', 'day', 1, 1, 1),
(47, 15, 'Ver Reporte Por Turnos', 'all', 1, 1, 2),
(48, 16, 'Agregar Egreso', 'add', 1, 1, 1),
(49, 16, 'Ver Egresos', 'all', 1, 1, 2),
(50, 16, 'Editar Egreso', 'edit', 0, 1, 1),
(51, 17, 'Ver Usuarios', 'all', 1, 1, 2),
(52, 17, 'Agregar Usuario', 'addu', 1, 1, 1),
(53, 17, 'Editar Persona', 'editpu', 0, 1, 1),
(54, 17, 'Editar Usuario', 'edituu', 0, 1, 1),
(55, 18, 'Agregar Cliente', 'add', 1, 1, 1),
(56, 18, 'Ver Clientes', 'all', 1, 1, 2),
(57, 18, 'Editar Cliente', 'edit', 0, 1, 1),
(58, 13, 'Productos A Vender', 'table_products', 0, 1, 1),
(60, 13, 'Ver Detalle de Venta', 'viewSale', 0, 1, 1),
(61, 15, 'Ingresos y Egresos', 'income_expenses', 1, 1, 3),
(62, 15, 'Ingresos y Egresos PDF', 'income_expenses_PDF', 0, 1, 4),
(63, 15, 'Inventario', 'inventory', 1, 1, 5),
(64, 15, 'inventary_PDF', 'inventary_PDF', 0, 1, 6),
(65, 12, 'Salida de Producto', 'outProductstock', 0, 1, 1),
(66, 13, 'Ver Historial de Ventas', 'viewhistory', 1, 1, 2),
(67, 15, 'Kardex Por Producto', 'kardex_product', 1, 1, 7),
(68, 15, 'kardex_product_table', 'kardex_product_table', 0, 1, 8),
(69, 19, 'Editar Correlativos', 'show', 1, 1, 1),
(70, 15, 'Imprimir', 'print_sale', 0, 1, 9),
(71, 15, 'Day PDF', 'day_PDF', 0, 1, 10),
(72, 15, 'All PDF', 'all_PDF', 0, 1, 11),
(73, 15, 'Kardex Por Producto PDF', 'kardex_por_producto_PDF', 0, 1, 12),
(74, 20, 'Agregar Categoria', 'add', 1, 1, 1),
(75, 20, 'Ver Categorias', 'all', 1, 1, 2),
(76, 20, 'Editar Categorias', 'edit', 0, 1, 3),
(77, 21, 'Agregar Proveedor', 'add', 1, 1, 1),
(78, 21, 'Listar Proveedores', 'all', 1, 1, 2),
(79, 21, 'Editar Proveedor', 'edit', 0, 1, 3),
(80, 22, 'Realizar Venta de Gas', 'fastSell', 1, 1, 1),
(81, 22, 'Producto Gas a Vender', 'table_productsGas', 0, 1, 2),
(82, 22, 'Ver Detalle de Venta', 'viewSale', 0, 1, 3),
(83, 22, 'Ver Historial de Venta', 'viewhistory', 1, 1, 4),
(84, 22, 'Ver Pedidos', 'viewhistorypedido', 1, 1, 5),
(85, 22, 'tabla_filtro_pedido', 'viewhistorypedidofiltro', 0, 1, 5),
(86, 22, 'Pedidos Pendientes', 'pedidospendientes', 1, 1, 6),
(87, 22, 'exportar_filtro_pdf', 'historypedidos_pdf', 0, 1, 6),
(88, 22, 'exportar_filtro_excel', 'exportarhistorypedidos_excel', 0, 1, 7),
(89, 22, 'Imprimir_filtro', 'imprimir_tabla_filtro', 0, 1, 7),
(90, 22, 'SUNAT', 'facturador_sunat', 0, 0, 0),
(91, 24, 'Ver Todo', 'listmedidas', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidoproduct`
--

CREATE TABLE `pedidoproduct` (
  `id_pedidoproduct` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_turn` int(11) NOT NULL,
  `pedidoproduct_direccion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pedidoproduct_type` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `pedidoproduct_correlativo` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `pedidoproduct_total` float(10,2) NOT NULL,
  `pedidoproduct_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `pedidoproduct_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedidoproduct`
--

INSERT INTO `pedidoproduct` (`id_pedidoproduct`, `id_client`, `id_user`, `id_turn`, `pedidoproduct_direccion`, `pedidoproduct_type`, `pedidoproduct_correlativo`, `pedidoproduct_total`, `pedidoproduct_date`, `pedidoproduct_estado`) VALUES
(1, 2, 1, 12, 'alzamora 958', 'BOLETA', '100009', 51.00, '2020-07-28 13:21:14', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permit`
--

CREATE TABLE `permit` (
  `id_permit` int(11) NOT NULL,
  `id_optionm` int(11) NOT NULL,
  `permit_action` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `permit_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `permit`
--

INSERT INTO `permit` (`id_permit`, `id_optionm`, `permit_action`, `permit_status`) VALUES
(1, 1, 'singIn', 1),
(2, 2, 'singOut', 1),
(3, 4, 'save', 1),
(4, 5, 'delete', 1),
(6, 9, 'save', 1),
(7, 11, 'insertRole', 1),
(8, 11, 'deleteRole', 1),
(9, 13, 'saveOption', 1),
(10, 12, 'deleteOption', 1),
(11, 16, 'savePermit', 1),
(12, 15, 'deletePermit', 1),
(15, 22, 'save', 1),
(16, 23, 'delete', 1),
(17, 25, 'changepass', 1),
(18, 18, 'save', 1),
(19, 20, 'delete', 1),
(20, 26, 'save', 1),
(21, 27, 'saveNewNick', 1),
(22, 28, 'chgpass', 1),
(26, 35, 'addRelation', 1),
(27, 35, 'deleteRelation', 1),
(29, 37, 'saveProduct', 1),
(30, 36, 'deleteProduct', 1),
(31, 40, 'saveProductprice', 1),
(32, 39, 'deleteProductprice', 1),
(33, 43, 'save', 1),
(34, 44, 'delete', 1),
(35, 44, 'change', 1),
(36, 45, 'saveProductstock', 1),
(37, 48, 'save', 1),
(38, 49, 'delete', 1),
(39, 52, 'new', 1),
(40, 53, 'save_edit_personu', 1),
(41, 54, 'save_edit_useru', 1),
(42, 51, 'reset_pass', 1),
(43, 51, 'change_status', 1),
(44, 56, 'delete', 1),
(45, 55, 'save', 1),
(46, 47, 'set_turn', 1),
(47, 42, 'addProduct', 1),
(48, 42, 'deleteProduct', 1),
(49, 42, 'sellProduct', 1),
(50, 37, 'saveProductwithprice', 1),
(51, 65, 'saveoutProductstock', 1),
(52, 3, 'openBox', 1),
(53, 60, 'revokeSale', 1),
(54, 69, 'save', 1),
(55, 74, 'save', 1),
(56, 42, 'search_by_barcode', 1),
(57, 77, 'save', 1),
(58, 78, 'delete', 1),
(59, 80, 'addProductGas', 1),
(60, 80, 'deleteProduct', 1),
(61, 80, 'sellProduct', 1),
(62, 80, 'search_by_barcode', 1),
(63, 82, 'revokeSale', 1),
(65, 84, 'viewhistorypedidofiltro', 1),
(66, 86, 'estadoentregado', 1),
(67, 83, 'crear_ArchivosPlanos', 1),
(68, 91, 'Cambiarestado', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `person`
--

CREATE TABLE `person` (
  `id_person` int(11) NOT NULL,
  `person_name` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `person_surname` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `person_dni` char(8) COLLATE utf8_spanish_ci NOT NULL,
  `person_birth` date NOT NULL,
  `person_number_phone` varchar(24) COLLATE utf8_spanish_ci DEFAULT NULL,
  `person_genre` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `person_address` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `person`
--

INSERT INTO `person` (`id_person`, `person_name`, `person_surname`, `person_dni`, `person_birth`, `person_number_phone`, `person_genre`, `person_address`) VALUES
(1, 'César José', 'Ruiz', '12', '1995-09-03', '969902084', 'M', 'Calle Estado de Israel #256'),
(2, 'Pedro', 'Lopez', '76512412', '2019-04-10', '987636363', 'M', 'GG 234'),
(3, 'Angelo', 'Tapullima', '11111111', '1996-10-13', '999999', 'M', 'Calle SiempreViva 669'),
(7, 'Luis', 'Salazar Bartra', '71106432', '1995-11-23', '953295553', 'M', 'ALZAMORA 958'),
(8, 'Fiorela', 'Ayala Linares', '71025364', '1999-03-20', '934849444', 'F', 'dfgfgfg'),
(9, 'Adrian', 'Salazar', '70101010', '2000-09-13', '982323232', 'M', 'adfsd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `id_categoryp` int(11) NOT NULL,
  `product_barcode` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `product_name` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `product_description` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `product_unid_type` int(11) NOT NULL,
  `product_stock` double NOT NULL,
  `product_created_at` datetime NOT NULL,
  `id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id_product`, `id_categoryp`, `product_barcode`, `product_name`, `product_description`, `product_unid_type`, `product_stock`, `product_created_at`, `id_proveedor`) VALUES
(13, 2, '132', 'HELADO CHOCOKRISPIS', '--', 58, 188, '2019-05-16 21:59:01', 3),
(14, 1, '133', 'Balon GLP 10kg', '--', 58, 133, '2020-07-25 17:17:45', 3),
(20, 1, '134', 'Balon GLP 45KG', '--', 58, 194, '2020-07-27 00:53:58', 4),
(22, 3, '131', 'Hamburguesa Royal carne', '--', 58, 199, '2020-08-02 19:31:17', 13),
(24, 3, '135', 'Brosther', '--', 58, 169, '2020-08-02 20:47:34', 13),
(25, 1, '136', 'Seguridad Informática', '--', 59, 193, '2020-08-03 13:47:31', 4),
(26, 1, '137', 'Balon de Gas GLP 10 kg', '--', 58, 246, '2020-08-03 20:21:51', 3),
(27, 1, '111', 'Teclado Cybertel', '--', 6, 90, '2020-08-31 23:22:06', 8),
(28, 1, '1111', 'Bolsa Mediana', '--', 58, 97, '2020-09-09 10:29:50', 12),
(29, 1, '2222', 'Bolsa Grande', '--', 58, 95, '2020-09-09 10:30:35', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productforsale`
--

CREATE TABLE `productforsale` (
  `id_productforsale` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `product_unid` int(11) NOT NULL,
  `product_price` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productforsale`
--

INSERT INTO `productforsale` (`id_productforsale`, `id_product`, `product_unid`, `product_price`) VALUES
(1, 13, 1, 3.50),
(2, 14, 1, 51.00),
(3, 20, 1, 150.00),
(5, 22, 1, 5.50),
(7, 24, 1, 10.00),
(8, 25, 1, 140.00),
(9, 26, 1, 43.00),
(10, 27, 1, 35.00),
(11, 28, 1, 0.10),
(12, 29, 1, 0.20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `proveedor_ruc` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_provee` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `contacto_provee` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono_provee` bigint(11) DEFAULT NULL,
  `direccion_provee` text COLLATE utf8_spanish_ci,
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `proveedor_ruc`, `nombre_provee`, `contacto_provee`, `telefono_provee`, `direccion_provee`, `date_add`) VALUES
(3, '12345678901', 'LLAMAGAS', 'Emma Bartra', 923261373, 'Santa Clara km 10', '2020-07-25 17:29:53'),
(4, '10987654321', 'SOLGAS', 'Edgar Bartra', 965010101, 'Alzamora 958, Iquitos', '2020-07-25 17:30:49'),
(5, '71106432', 'Amazon Gas', 'Luis Antonio', 123456789, 'alzamora', '2020-07-26 00:57:13'),
(8, '214748364', 'BufeoTec', 'Clever', 965626263, 'pevas 1890', '2020-07-26 14:12:20'),
(12, '10711064325', 'FHL', 'Luis', 98787653, 'laolsjs', '2020-08-02 17:22:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rent`
--

CREATE TABLE `rent` (
  `id_rent` int(11) NOT NULL,
  `rent_name` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `rent_description` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `rent_timeminutes` int(11) NOT NULL,
  `rent_cost` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `role_name` varchar(32) COLLATE utf8_spanish_ci DEFAULT NULL,
  `role_description` varchar(126) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`id_role`, `role_name`, `role_description`) VALUES
(1, 'Free', 'Rol usado por los usuarios sin credenciales'),
(2, 'SuperAdmin', 'Administra Todo'),
(3, 'Admin', 'Administrar con Limite'),
(4, 'Vendedor', 'Rol Para Usuario de Venta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rolemenu`
--

CREATE TABLE `rolemenu` (
  `id_rolemenu` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rolemenu`
--

INSERT INTO `rolemenu` (`id_rolemenu`, `id_role`, `id_menu`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 3),
(4, 2, 4),
(5, 2, 5),
(7, 2, 9),
(8, 2, 10),
(11, 2, 11),
(20, 2, 12),
(21, 2, 13),
(22, 2, 14),
(23, 2, 15),
(24, 2, 16),
(25, 3, 2),
(26, 3, 3),
(29, 3, 11),
(30, 3, 12),
(31, 3, 13),
(32, 3, 14),
(33, 3, 15),
(34, 3, 16),
(35, 2, 17),
(36, 3, 17),
(37, 2, 18),
(38, 3, 18),
(39, 2, 19),
(40, 3, 19),
(41, 2, 20),
(42, 3, 20),
(43, 4, 2),
(44, 4, 3),
(45, 4, 11),
(46, 4, 13),
(47, 4, 14),
(48, 4, 15),
(49, 4, 16),
(50, 4, 18),
(51, 2, 21),
(52, 2, 22),
(53, 3, 23),
(54, 4, 22),
(55, 3, 22),
(56, 2, 24),
(57, 3, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saledetail`
--

CREATE TABLE `saledetail` (
  `id_saledetail` int(11) NOT NULL,
  `id_saleproduct` int(11) DEFAULT NULL,
  `id_productforsale` int(11) NOT NULL,
  `sale_productname` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `sale_unid` double NOT NULL,
  `sale_price` float(10,2) NOT NULL,
  `sale_productscant` double NOT NULL,
  `sale_productstotalselled` double NOT NULL,
  `sale_productstotalprice` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `saledetail`
--

INSERT INTO `saledetail` (`id_saledetail`, `id_saleproduct`, `id_productforsale`, `sale_productname`, `sale_unid`, `sale_price`, `sale_productscant`, `sale_productstotalselled`, `sale_productstotalprice`) VALUES
(1, 1, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, 3.50),
(2, 1, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 19, 19, 66.50),
(3, 3, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, 3.50),
(4, 4, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 4, 4, 14.00),
(5, 5, 3, 'Balon GLP 45KG X 1 UND', 1, 150.00, 1, 1, 150.00),
(6, 5, 2, 'Balon GLP 10kg X 1 UND', 1, 49.00, 1, 1, 49.00),
(7, 6, 2, 'Balon GLP 10kg X 1 UND', 1, 51.00, 1, 1, 51.00),
(8, 7, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, 3.50),
(9, 7, 2, 'Balon GLP 10kg X 1 UND', 1, 51.00, 5, 5, 255.00),
(10, 8, 3, 'Balon GLP 45KG X 1 UND', 1, 150.00, 1, 1, 150.00),
(11, 9, 2, 'Balon GLP 10kg X 1 UND', 1, 51.00, 1, 1, 51.00),
(12, 9, 3, 'Balon GLP 45KG X 1 UND', 1, 150.00, 1, 1, 150.00),
(13, 10, 2, 'Balon GLP 10kg X 1 UND', 1, 51.00, 1, 1, 51.00),
(14, 11, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, 3.50),
(15, 11, 2, 'Balon GLP 10kg X 1 UND', 1, 51.00, 1, 1, 51.00),
(16, 11, 3, 'Balon GLP 45KG X 1 UND', 1, 150.00, 2, 2, 300.00),
(17, 12, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, 3.50),
(18, 13, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, 3.50),
(19, 14, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, 3.50),
(20, 15, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, 3.50),
(22, NULL, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, 3.50),
(23, NULL, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, 3.50),
(24, 20, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, 3.50),
(25, 21, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, 3.50),
(26, 22, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 3, 3, 10.50),
(27, 23, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, 3.50),
(28, 24, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, 3.50),
(29, 24, 2, 'Balon GLP 10kg X 1 UND', 1, 51.00, 1, 1, 51.00),
(30, 25, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, 3.50),
(31, 26, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, 3.50),
(32, 27, 7, 'Brosther X 1 uni', 1, 10.00, 2, 2, 20.00),
(33, 28, 1, 'HELADO CHOCOKRISPIS X 1 58', 1, 3.50, 1, 1, 3.50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saledetailgas`
--

CREATE TABLE `saledetailgas` (
  `id_saledetailgas` int(11) NOT NULL,
  `id_saleproductgas` int(11) NOT NULL,
  `id_productforsale` int(11) NOT NULL,
  `sale_productnamegas` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `id_medida` int(11) NOT NULL,
  `sale_pricegas` float(10,2) NOT NULL,
  `sale_productscantgas` double NOT NULL,
  `sale_productstotalselledgas` double NOT NULL,
  `precio_base` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'precio del porducto/servicio sin igv',
  `precio_producto` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'precio unitario del producto',
  `subtotal` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'precio_base por cantidad(sin considerar igv)',
  `igv` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'igv total, cantidad por precio por igv',
  `igv_tipoigv` int(11) NOT NULL DEFAULT '1',
  `total_icbper` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sale_productstotalpricegas` float(10,2) NOT NULL DEFAULT '0.00' COMMENT 'subtotal mas igv'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `saledetailgas`
--

INSERT INTO `saledetailgas` (`id_saledetailgas`, `id_saleproductgas`, `id_productforsale`, `sale_productnamegas`, `id_medida`, `sale_pricegas`, `sale_productscantgas`, `sale_productstotalselledgas`, `precio_base`, `precio_producto`, `subtotal`, `igv`, `igv_tipoigv`, `total_icbper`, `sale_productstotalpricegas`) VALUES
(5, 7, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 3.50),
(6, 7, 2, 'Balon GLP 10kg X 1 UND', 1, 51.00, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 51.00),
(7, 8, 7, 'Brosther X 1 uni', 1, 10.00, 2, 2, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 20.00),
(8, 8, 5, 'Hamburguesa Royal carne X 1 UNI', 1, 5.50, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 5.50),
(9, 9, 2, 'Balon GLP 10kg X 1 UND', 1, 51.00, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 51.00),
(10, 10, 7, 'Brosther X 1 uni', 1, 10.00, 2, 2, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 20.00),
(11, 11, 7, 'Brosther X 1 uni', 1, 10.00, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 10.00),
(16, 15, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 3.50),
(17, 16, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 2, 2, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 7.00),
(18, 17, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 3.50),
(19, 17, 2, 'Balon GLP 10kg X 1 UND', 1, 51.00, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 51.00),
(20, 17, 3, 'Balon GLP 45KG X 1 UND', 1, 150.00, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 150.00),
(21, 18, 8, 'lo X 1 tyyt', 1, 3.00, 4, 4, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 12.00),
(22, 19, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 2, 2, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 7.00),
(23, 20, 8, 'lo X 1 tyyt', 1, 4.00, 5, 5, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 20.00),
(27, 22, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 3.50),
(30, 24, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 3.50),
(31, 25, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 3.50),
(32, 26, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 3.50),
(33, 27, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 3.50),
(34, 27, 2, 'Balon GLP 10kg X 1 UND', 1, 51.00, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 51.00),
(35, 28, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 3.50),
(36, 29, 7, 'Brosther X 1 uni', 1, 10.00, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 10.00),
(37, 30, 8, 'lo X 1 tyyt', 1, 4.00, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 4.00),
(38, 31, 8, 'lo X 1 tyyt', 1, 4.00, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 4.00),
(39, 31, 9, 'Balon de Gas GLP 10 kg X 1 we', 1, 43.00, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 43.00),
(40, 32, 8, 'lo X 1 tyyt', 1, 4.00, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 4.00),
(41, 33, 9, 'Balon de Gas GLP 10 kg X 1 we', 1, 43.00, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 43.00),
(42, 34, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 3.50),
(43, 35, 8, 'lo X 1 tyyt', 1, 4.00, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 4.00),
(44, 36, 9, 'Balon de Gas GLP 10 kg X 1 we', 1, 43.00, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 43.00),
(45, 37, 5, 'Hamburguesa Royal carne X 1 UNI', 1, 5.50, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 5.50),
(46, 38, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 3.50),
(47, 38, 5, 'Hamburguesa Royal carne X 1 UNI', 1, 5.50, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 5.50),
(48, 39, 8, 'lo X 1 UND', 1, 4.00, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 4.00),
(49, 39, 9, 'Balon de Gas GLP 10 kg X 1 UND', 1, 43.00, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 43.00),
(50, 40, 10, 'Teclado Cybertel X 1 6', 1, 35.00, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 35.00),
(51, 40, 3, 'Balon GLP 45KG X 1 58', 1, 150.00, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 150.00),
(52, 40, 8, 'Seguridad Informática X 1 59', 1, 140.00, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 140.00),
(53, 41, 2, 'Balon GLP 10kg X 1 58', 1, 51.00, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 51.00),
(54, 41, 7, 'Brosther X 1 58', 1, 10.00, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 10.00),
(55, 41, 8, 'Seguridad Informática X 1 59', 1, 140.00, 1, 1, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 140.00),
(56, 43, 7, 'Brosther NIU', 1, 10.00, 1, 0, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 10.00),
(57, 43, 8, 'Seguridad Informática ZZ', 1, 140.00, 1, 0, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 140.00),
(58, 44, 9, 'Balon de Gas GLP 10 kg NIU', 58, 43.00, 1, 58, '0.00', '0.00', '0.00', '0.00', 1, '0.00', 43.00),
(59, 45, 1, 'HELADO CHOCOKRISPIS NIU', 58, 3.50, 2, 116, '3.50', '2.97', '5.93', '1.07', 1, '0.00', 7.00),
(60, 45, 7, 'Brosther NIU', 58, 10.00, 2, 116, '10.00', '8.47', '16.95', '3.05', 1, '0.00', 20.00),
(61, 46, 8, 'Seguridad Informática ZZ', 59, 140.00, 3, 3, '118.64', '140.00', '355.93', '64.07', 1, '0.00', 420.00),
(62, 47, 9, 'Balon de Gas GLP 10 kg NIU', 58, 43.00, 1, 1, '36.44', '43.00', '36.44', '6.56', 1, '0.00', 43.00),
(63, 48, 10, 'Teclado Cybertel BX', 1, 35.00, 1, 1, '29.66', '35.00', '29.66', '5.34', 1, '0.00', 35.00),
(64, 49, 3, 'Balon GLP 45KG NIU', 1, 150.00, 1, 1, '127.12', '150.00', '127.12', '22.88', 1, '0.00', 150.00),
(65, 50, 3, 'Balon GLP 45KG NIU', 1, 150.00, 1, 1, '127.12', '150.00', '127.12', '22.88', 1, '0.00', 150.00),
(66, 51, 5, 'Hamburguesa Royal carne NIU', 1, 5.50, 1, 1, '4.66', '5.50', '4.66', '0.84', 1, '0.00', 5.50),
(67, 52, 3, 'Balon GLP 45KG NIU', 1, 150.00, 1, 1, '127.12', '150.00', '127.12', '22.88', 1, '0.00', 150.00),
(68, 52, 1, 'HELADO CHOCOKRISPIS NIU', 1, 3.50, 1, 1, '2.97', '3.50', '2.97', '0.53', 1, '0.00', 3.50),
(69, 53, 10, 'Teclado Cybertel BX', 1, 35.00, 1, 1, '29.66', '35.00', '29.66', '5.34', 1, '0.00', 35.00),
(70, 53, 8, 'Seguridad Informática ZZ', 1, 140.00, 1, 1, '118.64', '140.00', '118.64', '21.36', 1, '0.00', 140.00),
(71, 55, 2, 'Balon GLP 10kg NIU', 1, 51.00, 1, 1, '43.22', '51.00', '43.22', '7.78', 1, '0.00', 51.00),
(72, 56, 10, 'Teclado Cybertel BX', 1, 35.00, 1, 1, '29.66', '35.00', '29.66', '5.34', 1, '0.00', 35.00),
(73, 56, 1, 'HELADO CHOCOKRISPIS NIU', 1, 3.50, 1, 1, '2.97', '3.50', '2.97', '0.53', 1, '0.00', 3.50),
(74, 56, 2, 'Balon GLP 10kg NIU', 1, 51.00, 1, 1, '43.22', '51.00', '43.22', '7.78', 1, '0.00', 51.00),
(76, 58, 1, 'HELADO CHOCOKRISPIS NIU', 1, 3.50, 1, 1, '2.97', '3.50', '2.97', '0.53', 1, '0.00', 3.50),
(77, 59, 2, 'Balon GLP 10kg NIU', 1, 51.00, 1, 1, '43.22', '51.00', '43.22', '7.78', 1, '0.00', 51.00),
(78, 60, 7, 'Brosther NIU', 1, 10.00, 1, 1, '8.47', '10.00', '8.47', '1.53', 1, '0.00', 10.00),
(85, 66, 1, 'HELADO CHOCOKRISPIS NIU', 1, 3.50, 1, 1, '2.97', '3.50', '2.97', '0.53', 1, '0.00', 3.50),
(87, 68, 2, 'Balon GLP 10kg NIU', 58, 51.00, 1, 1, '43.22', '51.00', '43.22', '7.78', 1, '0.00', 51.00),
(88, 69, 7, 'Brosther NIU', 58, 10.00, 1, 1, '8.47', '10.00', '8.47', '1.53', 1, '0.00', 10.00),
(89, 69, 1, 'HELADO CHOCOKRISPIS NIU', 58, 3.50, 2, 2, '2.97', '3.50', '5.93', '1.07', 1, '0.00', 7.00),
(90, 70, 1, 'HELADO CHOCOKRISPIS', 1, 3.50, 1, 1, '2.97', '3.50', '2.97', '0.53', 1, '0.00', 3.50),
(91, 70, 3, 'Balon GLP 45KG', 58, 150.00, 1, 1, '127.12', '150.00', '127.12', '22.88', 1, '0.00', 150.00),
(92, 71, 8, 'Seguridad Informática', 59, 140.00, 1, 1, '118.64', '140.00', '118.64', '21.36', 1, '0.00', 140.00),
(93, 72, 1, 'HELADO CHOCOKRISPIS', 58, 3.50, 1, 1, '2.97', '3.50', '2.97', '0.53', 1, '0.00', 3.50),
(94, 73, 1, 'HELADO CHOCOKRISPIS', 1, 3.50, 1, 1, '2.97', '3.50', '2.97', '0.53', 1, '0.00', 3.50),
(95, 74, 2, 'Balon GLP 10kg', 1, 51.00, 1, 1, '43.22', '51.00', '43.22', '7.78', 1, '0.00', 51.00),
(96, 75, 1, 'HELADO CHOCOKRISPIS', 58, 3.50, 1, 1, '2.97', '3.50', '2.97', '0.53', 1, '0.00', 3.50),
(97, 75, 2, 'Balon GLP 10kg', 58, 51.00, 1, 1, '43.22', '51.00', '43.22', '7.78', 1, '0.00', 51.00),
(98, 76, 8, 'Seguridad Informática', 59, 140.00, 1, 1, '118.64', '140.00', '118.64', '21.36', 1, '0.00', 140.00),
(99, 77, 3, 'Balon GLP 45KG', 58, 150.00, 1, 1, '127.12', '150.00', '127.12', '22.88', 1, '0.00', 150.00),
(100, 78, 7, 'Brosther', 58, 10.00, 1, 1, '8.47', '10.00', '8.47', '1.53', 1, '0.00', 10.00),
(101, 78, 9, 'Balon de Gas GLP 10 kg', 58, 43.00, 1, 1, '36.44', '43.00', '36.44', '6.56', 1, '0.00', 43.00),
(102, 79, 2, 'Balon GLP 10kg', 58, 51.00, 1, 1, '43.22', '51.00', '43.22', '7.78', 1, '0.00', 51.00),
(103, 80, 7, 'Brosther', 58, 10.00, 1, 1, '8.47', '10.00', '8.47', '1.53', 1, '0.00', 10.00),
(104, 81, 7, 'Brosther', 58, 10.00, 2, 2, '8.47', '10.00', '16.95', '3.05', 1, '0.00', 20.00),
(105, 82, 3, 'Balon GLP 45KG', 58, 150.00, 1, 1, '127.12', '150.00', '127.12', '22.88', 1, '0.00', 150.00),
(106, 82, 7, 'Brosther', 58, 10.00, 1, 1, '8.47', '10.00', '8.47', '1.53', 1, '0.00', 10.00),
(107, 82, 8, 'Seguridad Informática', 59, 140.00, 2, 2, '118.64', '140.00', '237.29', '42.71', 1, '0.00', 280.00),
(108, 83, 9, 'Balon de Gas GLP 10 kg', 58, 43.00, 1, 1, '36.44', '43.00', '36.44', '6.56', 1, '0.00', 43.00),
(109, 84, 9, 'Balon de Gas GLP 10 kg', 58, 43.00, 1, 1, '36.44', '43.00', '36.44', '6.56', 1, '0.00', 43.00),
(110, 85, 8, 'Seguridad Informática', 59, 140.00, 1, 1, '118.64', '140.00', '118.64', '21.36', 1, '0.00', 140.00),
(111, 86, 10, 'Teclado Cybertel', 6, 35.00, 1, 1, '29.66', '35.00', '29.66', '5.34', 1, '0.00', 35.00),
(112, 87, 7, 'Brosther', 58, 10.00, 1, 1, '8.47', '10.00', '8.47', '1.53', 1, '0.00', 10.00),
(113, 88, 7, 'Brosther', 58, 10.00, 1, 1, '8.47', '10.00', '8.47', '1.53', 1, '0.00', 10.00),
(114, 89, 7, 'Brosther', 58, 10.00, 2, 2, '8.47', '10.00', '16.95', '3.05', 1, '0.00', 20.00),
(115, 90, 1, 'HELADO CHOCOKRISPIS', 58, 3.50, 1, 1, '2.97', '3.50', '2.97', '0.53', 1, '0.00', 3.50),
(116, 91, 3, 'Balon GLP 45KG', 58, 150.00, 1, 1, '127.12', '150.00', '127.12', '22.88', 1, '0.00', 150.00),
(117, 92, 7, 'Brosther', 58, 10.00, 2, 2, '8.47', '10.00', '16.95', '3.05', 1, '0.00', 20.00),
(118, 93, 8, 'Seguridad Informática', 59, 140.00, 1, 1, '118.64', '140.00', '118.64', '21.36', 1, '0.00', 140.00),
(119, 94, 2, 'Balon GLP 10kg', 58, 51.00, 1, 1, '43.22', '51.00', '43.22', '7.78', 1, '0.00', 51.00),
(120, 95, 10, 'Teclado Cybertel', 6, 35.00, 1, 1, '29.66', '35.00', '29.66', '5.34', 1, '0.00', 35.00),
(121, 96, 1, 'HELADO CHOCOKRISPIS', 58, 3.50, 1, 1, '2.97', '3.50', '2.97', '0.53', 1, '0.00', 3.50),
(122, 97, 2, 'Balon GLP 10kg', 58, 51.00, 1, 1, '43.22', '51.00', '43.22', '7.78', 1, '0.00', 51.00),
(123, 98, 1, 'HELADO CHOCOKRISPIS', 58, 3.50, 1, 1, '2.97', '3.50', '2.97', '0.53', 1, '0.00', 3.50),
(124, 98, 7, 'Brosther', 58, 10.00, 1, 1, '8.47', '10.00', '8.47', '1.53', 1, '0.00', 10.00),
(125, 101, 1, 'HELADO CHOCOKRISPIS', 58, 3.50, 1, 1, '2.97', '3.50', '2.97', '0.53', 1, '0.00', 3.50),
(126, 102, 7, 'Brosther', 58, 10.00, 1, 1, '8.47', '10.00', '9.99', '0.00', 2, '0.00', 10.00),
(127, 103, 1, 'HELADO CHOCOKRISPIS', 58, 3.50, 1, 1, '2.97', '3.50', '3.50', '0.00', 2, '0.00', 3.50),
(128, 104, 7, 'Brosther', 58, 10.00, 1, 1, '8.47', '10.00', '8.47', '1.53', 1, '0.00', 10.00),
(129, 105, 7, 'Brosther', 58, 10.00, 1, 1, '8.47', '10.00', '9.99', '0.00', 2, '0.00', 10.00),
(130, 106, 7, 'Brosther', 58, 10.00, 2, 2, '8.47', '10.00', '19.99', '0.00', 2, '0.00', 20.00),
(131, 107, 7, 'Brosther', 58, 10.00, 1, 1, '8.47', '10.00', '9.99', '0.00', 2, '0.00', 10.00),
(132, 108, 3, 'Balon GLP 45KG', 58, 150.00, 3, 3, '127.12', '150.00', '450.00', '0.00', 2, '0.00', 450.00),
(133, 109, 7, 'Brosther', 58, 10.00, 3, 3, '8.47', '10.00', '25.42', '4.58', 1, '0.00', 30.00),
(134, 110, 2, 'Balon GLP 10kg', 58, 51.00, 2, 2, '43.22', '51.00', '102.00', '0.00', 2, '0.00', 102.00),
(135, 111, 7, 'Brosther', 58, 10.00, 2, 2, '10.00', '10.00', '20.00', '0.00', 2, '0.00', 20.00),
(136, 112, 7, 'Brosther', 58, 10.00, 1, 1, '10.00', '10.00', '10.00', '0.00', 2, '0.00', 10.00),
(137, 113, 8, 'Seguridad Informática', 59, 140.00, 1, 1, '140.00', '140.00', '140.00', '0.00', 2, '0.00', 140.00),
(138, 114, 2, 'Balon GLP 10kg', 58, 51.00, 1, 1, '43.22', '51.00', '43.22', '7.78', 1, '0.00', 51.00),
(139, 115, 8, 'Seguridad Informática', 59, 140.00, 1, 1, '140.00', '140.00', '140.00', '0.00', 2, '0.00', 140.00),
(140, 116, 1, 'HELADO CHOCOKRISPIS', 58, 3.50, 1, 1, '3.50', '3.50', '3.50', '0.00', 2, '0.00', 3.50),
(141, 116, 2, 'Balon GLP 10kg', 58, 51.00, 1, 1, '51.00', '51.00', '51.00', '0.00', 2, '0.00', 51.00),
(142, 118, 2, 'Balon GLP 10kg', 58, 51.00, 1, 1, '51.00', '51.00', '51.00', '0.00', 3, '0.00', 51.00),
(143, 119, 1, 'HELADO CHOCOKRISPIS', 58, 3.50, 1, 1, '3.50', '3.50', '3.50', '0.00', 3, '0.00', 3.50),
(144, 120, 8, 'Seguridad Informática', 59, 140.00, 1, 1, '140.00', '140.00', '140.00', '0.00', 2, '0.00', 140.00),
(145, 121, 7, 'Brosther', 58, 10.00, 4, 4, '10.00', '10.00', '40.00', '0.00', 3, '0.00', 40.00),
(146, 124, 7, 'Brosther', 58, 10.00, 1, 1, '10.00', '10.00', '10.00', '0.00', 3, '0.00', 10.00),
(147, 124, 11, 'Bolsa Mediana', 58, 0.10, 1, 1, '0.10', '0.10', '0.10', '0.00', 3, '0.20', 0.30),
(148, 125, 7, 'Brosther', 58, 10.00, 1, 1, '10.00', '10.00', '10.00', '0.00', 3, '0.00', 10.00),
(149, 125, 11, 'Bolsa Mediana', 58, 0.10, 1, 1, '0.10', '0.10', '0.10', '0.00', 3, '0.20', 0.30),
(150, 125, 12, 'Bolsa Grande', 58, 0.20, 3, 3, '0.20', '0.20', '0.60', '0.00', 3, '0.80', 1.40),
(151, 126, 10, 'Teclado Cybertel', 6, 35.00, 2, 2, '35.00', '35.00', '70.00', '0.00', 3, '0.00', 70.00),
(152, 126, 12, 'Bolsa Grande', 58, 0.20, 2, 2, '0.20', '0.20', '0.40', '0.00', 3, '0.40', 0.80),
(153, 127, 1, 'HELADO CHOCOKRISPIS', 58, 3.50, 3, 3, '3.50', '3.50', '10.50', '0.00', 3, '0.00', 10.50),
(154, 127, 11, 'Bolsa Mediana', 58, 0.10, 1, 1, '0.10', '0.10', '0.10', '0.00', 3, '0.20', 0.30),
(155, 128, 8, 'Seguridad Informática', 59, 140.00, 1, 1, '140.00', '140.00', '140.00', '0.00', 3, '0.00', 140.00),
(156, 129, 10, 'Teclado Cybertel', 6, 35.00, 2, 2, '35.00', '35.00', '70.00', '0.00', 3, '0.00', 70.00),
(157, 130, 7, 'Brosther', 58, 10.00, 1, 1, '10.00', '10.00', '10.00', '0.00', 3, '0.00', 10.00),
(158, 131, 3, 'Balon GLP 45KG', 58, 150.00, 1, 1, '150.00', '150.00', '150.00', '0.00', 3, '0.00', 150.00),
(159, 133, 9, 'Balon de Gas GLP 10 kg', 58, 43.00, 1, 1, '43.00', '43.00', '43.00', '0.00', 3, '0.00', 43.00),
(160, 134, 10, 'Teclado Cybertel', 6, 35.00, 1, 1, '35.00', '35.00', '35.00', '0.00', 3, '0.00', 35.00),
(161, 135, 8, 'Seguridad Informática', 59, 140.00, 1, 1, '140.00', '140.00', '140.00', '0.00', 3, '0.00', 140.00),
(162, 136, 7, 'Brosther', 58, 10.00, 1, 1, '10.00', '10.00', '10.00', '0.00', 3, '0.00', 10.00),
(163, 137, 9, 'Balon de Gas GLP 10 kg', 58, 43.00, 2, 2, '43.00', '43.00', '86.00', '0.00', 3, '0.00', 86.00),
(164, 138, 1, 'HELADO CHOCOKRISPIS', 58, 3.50, 1, 1, '3.50', '3.50', '3.50', '0.00', 3, '0.00', 3.50),
(165, 138, 2, 'Balon GLP 10kg', 58, 51.00, 1, 1, '51.00', '51.00', '51.00', '0.00', 3, '0.00', 51.00),
(166, 139, 3, 'Balon GLP 45KG', 58, 150.00, 1, 1, '150.00', '150.00', '150.00', '0.00', 3, '0.00', 150.00),
(167, 139, 5, 'Hamburguesa Royal carne', 58, 5.50, 1, 1, '5.50', '5.50', '5.50', '0.00', 3, '0.00', 5.50),
(168, 140, 2, 'Balon GLP 10kg', 58, 51.00, 1, 1, '51.00', '51.00', '51.00', '0.00', 3, '0.00', 51.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saleproduct`
--

CREATE TABLE `saleproduct` (
  `id_saleproduct` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_turn` int(11) NOT NULL,
  `saleproduct_type` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `saleproduct_correlative` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `saleproduct_total` double NOT NULL,
  `saleproduct_date` datetime NOT NULL,
  `saleproduct_cancelled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `saleproduct`
--

INSERT INTO `saleproduct` (`id_saleproduct`, `id_client`, `id_user`, `id_turn`, `saleproduct_type`, `saleproduct_correlative`, `saleproduct_total`, `saleproduct_date`, `saleproduct_cancelled`) VALUES
(1, 1, 1, 2, 'BOLETA', 'BN° 100010', 70, '2019-05-17 19:58:24', 1),
(2, 2, 1, 5, 'BOLETA', 'BN° 100011', 3.5, '2020-07-24 11:52:06', 1),
(3, 2, 1, 5, 'BOLETA', 'BN° 100011', 3.5, '2020-07-24 11:52:15', 1),
(4, 2, 1, 5, 'BOLETA', 'BN° 100012', 14, '2020-07-24 14:34:48', 1),
(5, 2, 1, 8, 'BOLETA', 'BN° 100013', 199, '2020-07-27 11:44:58', 0),
(6, 1, 1, 8, 'BOLETA', 'BN° 100014', 51, '2020-07-27 16:13:12', 1),
(7, 1, 1, 8, 'BOLETA', 'BN° 100015', 258.5, '2020-07-27 16:21:12', 1),
(8, 3, 1, 8, 'FACTURA', 'FN° 100002', 150, '2020-07-27 19:35:09', 1),
(9, 1, 1, 8, 'BOLETA', 'BN° 100016', 201, '2020-07-27 23:24:21', 1),
(10, 1, 1, 9, 'BOLETA', 'BN° 100017', 51, '2020-07-28 13:03:10', 1),
(11, 1, 1, 13, 'BOLETA', 'BN° 100018', 354.5, '2020-07-29 12:10:14', 1),
(12, 1, 1, 13, 'BOLETA', 'BN° 100019', 3.5, '2020-07-29 13:22:04', 1),
(13, 1, 1, 13, 'BOLETA', 'BN° 100020', 3.5, '2020-07-29 15:20:09', 1),
(14, 1, 1, 13, 'BOLETA', 'BN° 100021', 3.5, '2020-07-29 16:25:44', 1),
(15, 1, 1, 13, 'BOLETA', 'BN° 100022', 3.5, '2020-07-29 19:28:26', 1),
(16, 1, 1, 14, 'BOLETA', 'BN° 100023', 3.5, '2020-07-30 12:51:38', 1),
(17, 1, 1, 14, 'BOLETA', 'BN° 100023', 3.5, '2020-07-30 12:53:14', 1),
(18, 1, 1, 14, 'BOLETA', 'BN° 100024', 3.5, '2020-07-30 12:56:47', 1),
(19, 2, 1, 14, 'BOLETA', 'BN° 100025', 3.5, '2020-07-30 12:58:18', 1),
(20, 1, 1, 14, 'BOLETA', 'BN° 100026', 3.5, '2020-07-30 13:05:21', 1),
(21, 1, 1, 14, 'BOLETA', 'BN° 100027', 3.5, '2020-07-30 17:33:56', 1),
(22, 1, 1, 14, 'BOLETA', 'BN° 100028', 10.5, '2020-07-30 20:42:15', 1),
(23, 1, 1, 15, 'BOLETA', 'BN° 100034', 3.5, '2020-07-31 09:20:02', 1),
(24, 1, 1, 15, 'BOLETA', 'BN° 100035', 54.5, '2020-07-31 12:25:50', 1),
(25, 1, 7, 15, 'BOLETA', 'BN° 100036', 3.5, '2020-07-31 12:53:01', 1),
(26, 1, 7, 15, 'BOLETA', 'BN° 100037', 3.5, '2020-07-31 12:53:51', 1),
(27, 24, 1, 19, 'BOLETA', 'BN° 100041', 20, '2020-08-04 15:44:21', 1),
(28, 1, 1, 48, 'BOLETA', 'BN° 100116', 3.5, '2020-09-12 12:32:53', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saleproductgas`
--

CREATE TABLE `saleproductgas` (
  `id_saleproductgas` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_turn` int(11) NOT NULL,
  `id_moneda` int(11) NOT NULL DEFAULT '1',
  `saleproductgas_direccion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `saleproductgas_telefono` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `saleproductgas_type` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `saleproductgas_naturaleza` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `saleproductgas_correlativo` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `saleproductgas_totalexonerada` decimal(10,2) NOT NULL DEFAULT '0.00',
  `saleproductgas_totalinafecta` decimal(10,2) NOT NULL DEFAULT '0.00',
  `saleproductgas_totalgravada` decimal(10,2) NOT NULL DEFAULT '0.00',
  `saleproductgas_totaligv` decimal(10,2) NOT NULL DEFAULT '0.00',
  `incluye_igv` tinyint(2) NOT NULL DEFAULT '1',
  `total_descuentos` decimal(10,2) NOT NULL DEFAULT '0.00',
  `saleproductgas_icbper` decimal(10,2) NOT NULL DEFAULT '0.00',
  `saleproductgas_total` float(10,2) NOT NULL,
  `id_empresa` int(11) DEFAULT '1',
  `saleproductgas_date` datetime NOT NULL,
  `tipo_nota_id` int(11) DEFAULT NULL,
  `enviado_sunat` tinyint(4) NOT NULL DEFAULT '0' COMMENT ' en caso de boletas 1 es cuando es enviado a sunat, 2 cuando es enviado a rsumenes, 0 falta enviar a resumenes. en caso de factura 1 cuando es enviado a sunat, 0 falta enviar facturador ',
  `saleproductgas_estado` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `saleproductgas_cancelled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `saleproductgas`
--

INSERT INTO `saleproductgas` (`id_saleproductgas`, `id_client`, `id_user`, `id_turn`, `id_moneda`, `saleproductgas_direccion`, `saleproductgas_telefono`, `saleproductgas_type`, `saleproductgas_naturaleza`, `saleproductgas_correlativo`, `saleproductgas_totalexonerada`, `saleproductgas_totalinafecta`, `saleproductgas_totalgravada`, `saleproductgas_totaligv`, `incluye_igv`, `total_descuentos`, `saleproductgas_icbper`, `saleproductgas_total`, `id_empresa`, `saleproductgas_date`, `tipo_nota_id`, `enviado_sunat`, `saleproductgas_estado`, `saleproductgas_cancelled`) VALUES
(7, 1, 1, 15, 1, 'San Roma 1980', '', 'BOLETA', 'PEDIDO', 'BN° 100033', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 54.50, 1, '2020-07-31 09:17:57', NULL, 0, '0', 0),
(8, 1, 1, 19, 1, 'alzaomra', '965656565', 'BOLETA', 'PEDIDO', 'BN° 100038', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 25.50, 1, '2020-08-04 10:33:44', NULL, 0, '0', 0),
(9, 3, 1, 19, 1, 'Av. siempre viva', '', 'BOLETA', 'PEDIDO', 'BN° 100039', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 51.00, 1, '2020-08-04 11:50:27', NULL, 0, '1', 1),
(10, 24, 1, 19, 1, 'sdfsfd', '', 'BOLETA', 'PEDIDO', 'BN° 100040', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 20.00, 1, '2020-08-04 12:11:43', NULL, 0, '1', 1),
(11, 22, 1, 19, 1, 'sdgsfd', '987654321', 'BOLETA', 'PEDIDO', 'BN° 100042', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 10.00, 1, '2020-08-04 15:46:17', NULL, 0, '1', 1),
(15, 1, 1, 21, 1, '', '065231453', 'BOLETA', 'OFICINA', 'BN° 100045', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 3.50, 1, '2020-08-06 10:48:36', NULL, 0, '0', 0),
(16, 1, 1, 21, 1, '', '923262626', 'BOLETA', 'PEDIDO', 'BN° 100046', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 7.00, 1, '2020-08-06 10:58:19', NULL, 0, '1', 1),
(17, 1, 1, 21, 1, 'Freire 1202', '953295553', 'BOLETA', 'PEDIDO', 'BN° 100047', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 204.50, 1, '2020-08-06 15:12:12', NULL, 0, '1', 1),
(18, 1, 1, 21, 1, '', '', 'BOLETA', 'OFICINA', 'BN° 100048', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 12.00, 1, '2020-08-06 15:14:31', NULL, 0, '1', 1),
(19, 3, 1, 22, 1, '965732145', '965732145', 'BOLETA', 'PEDIDO', 'BN° 100049', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 7.00, 1, '2020-08-07 00:05:02', NULL, 0, '1', 1),
(20, 19, 1, 22, 1, 'alzamora', '923261522', 'BOLETA', 'PEDIDO', 'BN° 100050', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 20.00, 1, '2020-08-07 00:08:41', NULL, 0, '0', 0),
(22, 1, 1, 22, 1, '', '', 'BOLETA', 'OFICINA', 'BN° 100052', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 3.50, 1, '2020-08-07 10:52:55', NULL, 0, '1', 1),
(24, 1, 1, 22, 1, '', '', 'BOLETA', 'OFICINA', 'BN° 100054', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 3.50, 1, '2020-08-07 11:27:31', NULL, 0, '1', 1),
(25, 20, 1, 22, 1, 'alalalala', '91919191', 'BOLETA', 'PEDIDO', 'BN° 100055', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 3.50, 1, '2020-08-07 13:03:35', NULL, 0, '0', 0),
(26, 19, 7, 25, 1, 'alzamora', '923261522', 'BOLETA', 'PEDIDO', 'BN° 100056', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 3.50, 1, '2020-08-11 18:14:16', NULL, 0, '1', 1),
(27, 21, 1, 26, 1, 'San juan', '965656565', 'BOLETA', 'OFICINA', 'BN° 100057', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 54.50, 1, '2020-08-12 22:34:19', NULL, 0, '1', 1),
(28, 2, 1, 26, 1, 'Alzamora 958', '953295553', 'BOLETA', 'OFICINA', 'BN° 100058', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 3.50, 1, '2020-08-12 22:34:37', NULL, 0, '1', 0),
(29, 2, 1, 26, 1, 'Alzamora 958', '953295553', 'BOLETA', 'PEDIDO', 'BN° 100059', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 10.00, 1, '2020-08-12 22:37:33', NULL, 0, '0', 0),
(30, 22, 1, 30, 1, 'sdgsfd', '45355', 'BOLETA', 'PEDIDO', 'BN° 100060', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 4.00, 1, '2020-08-18 10:52:35', NULL, 0, '0', 0),
(31, 2, 6, 30, 1, 'Alzamora 958', '953295553', 'BOLETA', 'PEDIDO', 'BN° 100061', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 47.00, 1, '2020-08-18 11:35:38', NULL, 0, '1', 1),
(32, 22, 6, 30, 1, 'sdgsfd', '45355', 'BOLETA', 'PEDIDO', 'BN° 100062', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 4.00, 1, '2020-08-18 18:38:35', NULL, 0, '1', 1),
(33, 24, 6, 31, 1, 'Cáceres mañana', '345543', 'BOLETA', 'OFICINA', 'BN° 100063', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 43.00, 1, '2020-08-19 18:41:13', NULL, 0, '1', 1),
(34, 28, 1, 31, 1, 'bermudez 1010', '123456789', 'BOLETA', 'PEDIDO', 'BN° 100064', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 3.50, 1, '2020-08-19 19:25:40', NULL, 0, '1', 1),
(35, 19, 1, 32, 1, 'alzamora', '923261522', 'BOLETA', 'OFICINA', 'BN° 100065', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 4.00, 1, '2020-08-20 23:37:17', NULL, 1, '1', 1),
(36, 3, 1, 32, 1, 'Av. siempre viva', '965732145', 'BOLETA', 'OFICINA', 'BN° 100066', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 43.00, 1, '2020-08-20 23:37:42', NULL, 0, '1', 1),
(37, 2, 1, 32, 1, 'Alzamora 958', '953295553', 'BOLETA', 'PEDIDO', 'BN° 100067', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 5.50, 1, '2020-08-20 23:37:58', NULL, 0, '1', 1),
(38, 28, 1, 33, 1, 'bermudez 1010', '123456789', 'FACTURA', 'PEDIDO', 'FN° 100003', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 9.00, 1, '2020-08-21 22:38:31', NULL, 0, '1', 1),
(39, 28, 1, 35, 1, 'bermudez 1010', '123456789', 'FACTURA', 'PEDIDO', 'FN° 100004', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 47.00, 1, '2020-08-30 18:33:56', NULL, 0, '0', 0),
(40, 26, 1, 37, 1, 'sdfgddg', '354545', 'FACTURA', 'PEDIDO', 'F001-100005', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 325.00, 1, '2020-09-01 23:57:39', NULL, 0, '0', 0),
(41, 30, 1, 38, 1, 'PEvas 1654', '987654321', 'BOLETA', 'OFICINA', 'B001-100068', '0.00', '0.00', '164.82', '36.18', 0, '0.00', '0.00', 201.00, 1, '2020-09-02 22:27:48', NULL, 0, '1', 1),
(42, 1, 1, 38, 1, '', '', 'BOLETA', 'OFICINA', 'B001-100069', '0.00', '0.00', '123.00', '27.00', 0, '0.00', '0.00', 150.00, 1, '2020-09-03 00:01:56', NULL, 0, '1', 1),
(43, 1, 1, 39, 1, '', '', 'BOLETA', 'OFICINA', 'B001-100069', '0.00', '0.00', '123.00', '27.00', 0, '0.00', '0.00', 150.00, 1, '2020-09-03 00:03:18', NULL, 0, '1', 1),
(44, 29, 1, 39, 1, 'aV. DEL eJERCITO 1289', '162537445', 'FACTURA', 'OFICINA', 'F001-100006', '0.00', '0.00', '35.26', '7.74', 0, '0.00', '0.00', 43.00, 1, '2020-09-03 00:08:31', NULL, 0, '1', 1),
(45, 1, 1, 39, 1, '', '', 'BOLETA', 'OFICINA', 'B001-100070', '0.00', '0.00', '22.88', '4.12', 0, '0.00', '0.00', 27.00, 1, '2020-09-03 01:44:21', NULL, 0, '1', 1),
(46, 28, 1, 39, 1, 'bermudez 1010', '123456789', 'FACTURA', 'PEDIDO', 'F001-100007', '0.00', '0.00', '355.93', '64.07', 0, '0.00', '0.00', 420.00, 1, '2020-09-03 01:50:00', NULL, 0, '1', 1),
(47, 1, 1, 39, 1, '', '', '1', 'OFICINA', 'F001-100008', '0.00', '0.00', '36.44', '6.56', 0, '0.00', '0.00', 43.00, 1, '2020-09-03 12:09:05', NULL, 0, '1', 1),
(48, 30, 1, 39, 1, 'PEvas 1654', '987654321', '1', 'OFICINA', 'F001-100009', '0.00', '0.00', '29.66', '5.34', 0, '0.00', '0.00', 35.00, 1, '2020-09-03 23:05:58', NULL, 0, '1', 1),
(49, 1, 1, 39, 1, '', '', '03', 'OFICINA', 'B001-100071', '0.00', '0.00', '127.12', '22.88', 0, '0.00', '0.00', 150.00, 1, '2020-09-03 23:31:47', NULL, 0, '1', 1),
(50, 30, 1, 40, 1, 'PEvas 1654', '987654321', '1', 'OFICINA', 'F001-100011', '0.00', '0.00', '127.12', '22.88', 0, '0.00', '0.00', 150.00, 1, '2020-09-04 01:41:01', NULL, 0, '1', 1),
(51, 20, 1, 40, 1, 'alalalala', '91919191', '03', 'OFICINA', 'B001-100071', '0.00', '0.00', '4.66', '0.84', 0, '0.00', '0.00', 5.50, 1, '2020-09-04 10:04:49', NULL, 0, '1', 1),
(52, 29, 1, 40, 1, 'aV. DEL eJERCITO 1289', '162537445', '03', 'OFICINA', 'B001-100071', '0.00', '0.00', '130.08', '23.42', 0, '0.00', '0.00', 153.50, 1, '2020-09-04 10:11:05', NULL, 0, '1', 1),
(53, 29, 1, 40, 1, 'aV. DEL eJERCITO 1289', '162537445', '03', 'OFICINA', 'B001-100071', '0.00', '0.00', '148.31', '26.69', 0, '0.00', '0.00', 175.00, 1, '2020-09-04 10:19:59', NULL, 0, '1', 1),
(54, 29, 1, 40, 1, 'aV. DEL eJERCITO 1289', '162537445', '03', 'OFICINA', 'B001-100071', '0.00', '0.00', '148.31', '26.69', 0, '0.00', '0.00', 175.00, 1, '2020-09-04 10:32:35', NULL, 0, '1', 1),
(55, 30, 1, 40, 1, 'PEvas 1654', '987654321', '03', 'OFICINA', 'B001-100071', '0.00', '0.00', '161.86', '29.14', 0, '0.00', '0.00', 191.00, 1, '2020-09-04 10:57:09', NULL, 0, '1', 1),
(56, 29, 1, 40, 1, 'aV. DEL eJERCITO 1289', '162537445', '03', 'OFICINA', 'B001-100071', '0.00', '0.00', '75.85', '13.65', 0, '0.00', '0.00', 89.50, 1, '2020-09-04 11:46:46', NULL, 0, '1', 1),
(57, 3, 1, 40, 1, 'Av. siempre viva', '965732145', '03', 'OFICINA', 'B001-100071', '0.00', '0.00', '43.22', '7.78', 0, '0.00', '0.00', 51.00, 1, '2020-09-04 12:34:09', NULL, 0, '1', 1),
(58, 3, 1, 40, 1, 'Av. siempre viva', '965732145', '03', 'OFICINA', 'B001-100071', '0.00', '0.00', '2.97', '0.53', 1, '0.00', '0.00', 3.50, 1, '2020-09-04 12:35:14', NULL, 0, '1', 1),
(59, 3, 1, 40, 1, 'Av. siempre viva', '965732145', '03', 'OFICINA', 'B001-100072', '0.00', '0.00', '43.22', '7.78', 1, '0.00', '0.00', 51.00, 1, '2020-09-04 12:38:00', NULL, 0, '1', 1),
(60, 30, 1, 40, 1, 'PEvas 1654', '987654321', '01', 'OFICINA', 'F001-100016', '0.00', '0.00', '8.47', '1.53', 1, '0.00', '0.00', 10.00, 1, '2020-09-04 12:39:06', NULL, 0, '1', 1),
(61, 29, 1, 40, 1, 'aV. DEL eJERCITO 1289', '162537445', '01', 'OFICINA', 'F001-100017', '0.00', '0.00', '2.97', '0.53', 1, '0.00', '0.00', 3.50, 1, '2020-09-04 12:40:08', NULL, 0, '1', 1),
(62, 29, 1, 40, 1, 'aV. DEL eJERCITO 1289', '162537445', '01', 'OFICINA', 'F001-100017', '0.00', '0.00', '2.97', '0.53', 1, '0.00', '0.00', 3.50, 1, '2020-09-04 12:40:46', NULL, 0, '1', 1),
(63, 1, 1, 40, 1, '', '', '03', 'OFICINA', 'B001-100073', '0.00', '0.00', '2.97', '0.53', 1, '0.00', '0.00', 3.50, 1, '2020-09-04 12:41:05', NULL, 0, '1', 1),
(64, 1, 1, 40, 1, '', '', '03', 'OFICINA', 'B001-100073', '0.00', '0.00', '46.19', '8.31', 1, '0.00', '0.00', 54.50, 1, '2020-09-04 12:41:17', NULL, 0, '1', 1),
(65, 1, 1, 40, 1, '', '', '03', 'OFICINA', 'B001-100073', '0.00', '0.00', '43.22', '7.78', 1, '0.00', '0.00', 51.00, 1, '2020-09-04 12:41:24', NULL, 0, '1', 1),
(66, 1, 1, 40, 1, '', '', '03', 'OFICINA', 'B001-100073', '0.00', '0.00', '2.97', '0.53', 1, '0.00', '0.00', 3.50, 1, '2020-09-04 12:41:35', NULL, 0, '1', 1),
(67, 1, 1, 40, 1, '', '', '03', 'OFICINA', 'B001-100074', '0.00', '0.00', '127.12', '22.88', 1, '0.00', '0.00', 150.00, 1, '2020-09-04 12:43:10', NULL, 0, '1', 1),
(68, 1, 1, 40, 1, '', '', '03', 'OFICINA', 'B001-100074', '0.00', '0.00', '43.22', '7.78', 1, '0.00', '0.00', 51.00, 1, '2020-09-04 13:14:42', NULL, 0, '1', 1),
(69, 18, 1, 40, 1, 'Circunvalacion', '9316152632', '03', 'OFICINA', 'B001-100075', '0.00', '0.00', '14.41', '2.59', 1, '0.00', '0.00', 17.00, 1, '2020-09-04 22:42:16', NULL, 0, '1', 1),
(70, 1, 1, 41, 1, '', '', '03', 'OFICINA', 'B001-100076', '0.00', '0.00', '130.08', '23.42', 1, '0.00', '0.00', 153.50, 1, '2020-09-05 00:40:09', NULL, 0, '1', 1),
(71, 1, 1, 41, 1, '', '', '03', 'OFICINA', 'B001-100077', '0.00', '0.00', '118.64', '21.36', 1, '0.00', '0.00', 140.00, 1, '2020-09-05 00:42:19', NULL, 0, '1', 1),
(72, 1, 1, 41, 1, '', '', '03', 'OFICINA', 'B001-100078', '0.00', '0.00', '2.97', '0.53', 1, '0.00', '0.00', 3.50, 1, '2020-09-05 00:42:40', NULL, 0, '1', 1),
(73, 1, 1, 41, 1, '', '', '03', 'OFICINA', 'B001-100079', '0.00', '0.00', '2.97', '0.53', 1, '0.00', '0.00', 3.50, 1, '2020-09-05 00:44:01', NULL, 0, '1', 1),
(74, 1, 1, 41, 1, '', '', '03', 'OFICINA', 'B001-100080', '0.00', '0.00', '43.22', '7.78', 1, '0.00', '0.00', 51.00, 1, '2020-09-05 00:45:08', NULL, 0, '1', 1),
(75, 1, 1, 41, 1, '', '', '03', 'OFICINA', 'B001-100081', '0.00', '0.00', '46.19', '8.31', 1, '0.00', '0.00', 54.50, 1, '2020-09-05 00:55:02', NULL, 0, '1', 1),
(76, 1, 1, 41, 1, '', '', '03', 'OFICINA', 'B001-100082', '0.00', '0.00', '118.64', '21.36', 1, '0.00', '0.00', 140.00, 1, '2020-09-05 18:11:26', NULL, 0, '1', 1),
(77, 1, 1, 42, 1, '', '', '03', 'OFICINA', 'B001-100083', '0.00', '0.00', '127.12', '22.88', 1, '0.00', '0.00', 150.00, 1, '2020-09-06 11:05:44', NULL, 0, '1', 1),
(78, 30, 1, 42, 1, 'PEvas 1654', '987654321', '03', 'OFICINA', 'B001-100084', '0.00', '0.00', '44.92', '8.08', 1, '0.00', '0.00', 53.00, 1, '2020-09-06 14:06:17', NULL, 0, '1', 1),
(79, 1, 1, 42, 1, '', '', '03', 'OFICINA', 'B001-100085', '0.00', '0.00', '43.22', '7.78', 1, '0.00', '0.00', 51.00, 1, '2020-09-06 19:00:55', NULL, 0, '1', 1),
(80, 1, 1, 42, 1, '', '', '03', 'OFICINA', 'B001-100086', '0.00', '0.00', '8.47', '1.53', 1, '0.00', '0.00', 10.00, 1, '2020-09-06 19:13:15', NULL, 0, '1', 1),
(81, 1, 1, 42, 1, '', '', '03', 'OFICINA', 'B001-100087', '0.00', '0.00', '16.95', '3.05', 1, '0.00', '0.00', 20.00, 1, '2020-09-06 19:31:17', NULL, 0, '1', 1),
(82, 1, 1, 42, 1, '', '', '03', 'OFICINA', 'B001-100088', '0.00', '0.00', '372.88', '67.12', 1, '0.00', '0.00', 440.00, 1, '2020-09-06 19:58:26', NULL, 0, '1', 1),
(83, 29, 1, 42, 1, 'aV. DEL eJERCITO 1289', '162537445', '01', 'OFICINA', 'F001-100017', '0.00', '0.00', '36.44', '6.56', 1, '0.00', '0.00', 43.00, 1, '2020-09-06 20:35:20', NULL, 0, '1', 1),
(84, 30, 1, 42, 1, 'PEvas 1654', '987654321', '01', 'OFICINA', 'F001-100018', '0.00', '0.00', '36.44', '6.56', 1, '0.00', '0.00', 43.00, 1, '2020-09-06 20:56:36', NULL, 0, '1', 1),
(85, 3, 1, 42, 1, 'Av. siempre viva', '965732145', '01', 'OFICINA', 'F001-100019', '0.00', '0.00', '118.64', '21.36', 1, '0.00', '0.00', 140.00, 1, '2020-09-06 22:33:58', NULL, 0, '1', 1),
(86, 28, 1, 42, 1, 'bermudez 1010', '123456789', '03', 'OFICINA', 'B001-100089', '0.00', '0.00', '29.66', '5.34', 1, '0.00', '0.00', 35.00, 1, '2020-09-06 22:37:34', NULL, 0, '1', 1),
(87, 24, 1, 42, 1, 'sdfsfd', '345543', '03', 'OFICINA', 'B001-100090', '0.00', '0.00', '8.47', '1.53', 1, '0.00', '0.00', 10.00, 1, '2020-09-06 23:18:26', NULL, 0, '1', 1),
(88, 24, 1, 42, 1, 'sdfsfd', '345543', '01', 'OFICINA', 'F001-100020', '0.00', '0.00', '8.47', '1.53', 1, '0.00', '0.00', 10.00, 1, '2020-09-06 23:19:51', NULL, 0, '1', 1),
(89, 28, 1, 42, 1, 'bermudez 1010', '123456789', '03', 'OFICINA', 'B001-100091', '0.00', '0.00', '16.95', '3.05', 1, '0.00', '0.00', 20.00, 1, '2020-09-06 23:29:18', NULL, 1, '1', 1),
(90, 30, 1, 43, 1, 'PEvas 1654', '987654321', '03', 'OFICINA', 'B001-100092', '0.00', '0.00', '2.97', '0.53', 1, '0.00', '0.00', 3.50, 1, '2020-09-07 10:21:52', NULL, 1, '1', 1),
(91, 29, 1, 43, 1, 'aV. DEL eJERCITO 1289', '162537445', '01', 'OFICINA', 'F001-100021', '0.00', '0.00', '127.12', '22.88', 1, '0.00', '0.00', 150.00, 1, '2020-09-07 10:27:52', NULL, 1, '1', 1),
(92, 29, 1, 43, 1, 'aV. DEL eJERCITO 1289', '162537445', '01', 'PEDIDO', 'F001-100022', '0.00', '0.00', '16.95', '3.05', 1, '0.00', '0.00', 20.00, 1, '2020-09-07 11:59:50', NULL, 1, '1', 1),
(93, 30, 1, 43, 1, 'PEvas 1654', '987654321', '03', 'OFICINA', 'B001-100093', '0.00', '0.00', '118.64', '21.36', 1, '0.00', '0.00', 140.00, 1, '2020-09-07 12:28:46', NULL, 1, '1', 1),
(94, 29, 1, 43, 1, 'aV. DEL eJERCITO 1289', '162537445', '01', 'OFICINA', 'F001-100023', '0.00', '0.00', '43.22', '7.78', 1, '0.00', '0.00', 51.00, 1, '2020-09-07 12:33:40', NULL, 1, '1', 1),
(95, 3, 1, 43, 1, 'Av. siempre viva', '965732145', '01', 'OFICINA', 'F001-100024', '0.00', '0.00', '29.66', '5.34', 1, '0.00', '0.00', 35.00, 1, '2020-09-07 12:44:17', NULL, 1, '1', 1),
(96, 30, 1, 43, 1, 'PEvas 1654', '987654321', '03', 'OFICINA', 'B001-100094', '0.00', '0.00', '2.97', '0.53', 1, '0.00', '0.00', 3.50, 1, '2020-09-07 13:23:30', NULL, 1, '1', 1),
(97, 29, 1, 43, 1, 'aV. DEL eJERCITO 1289', '162537445', '01', 'OFICINA', 'F001-100025', '0.00', '0.00', '43.22', '7.78', 1, '0.00', '0.00', 51.00, 1, '2020-09-07 13:29:12', NULL, 1, '1', 1),
(98, 1, 1, 44, 1, '', '', '01', 'OFICINA', 'F001-100026', '0.00', '0.00', '13.50', '0.00', 1, '0.00', '0.00', 13.50, 1, '2020-09-08 00:10:30', NULL, 0, '1', 1),
(101, 1, 1, 44, 1, '', '', '03', 'OFICINA', 'B001-100095', '0.00', '0.00', '0.00', '0.53', 1, '0.00', '0.00', 3.50, 1, '2020-09-08 11:59:17', NULL, 0, '1', 1),
(102, 1, 1, 44, 1, '', '', '03', 'OFICINA', 'B001-100096', '0.00', '0.00', '10.00', '0.00', 1, '0.00', '0.00', 10.00, 1, '2020-09-08 11:59:33', NULL, 0, '1', 1),
(103, 1, 1, 44, 1, '', '', '03', 'OFICINA', 'B001-100097', '0.00', '3.50', '0.00', '0.00', 1, '0.00', '0.00', 3.50, 1, '2020-09-08 12:18:24', NULL, 0, '1', 1),
(104, 1, 1, 44, 1, '', '', '03', 'OFICINA', 'B001-100098', '0.00', '0.00', '8.47', '1.53', 1, '0.00', '0.00', 10.00, 1, '2020-09-08 12:24:16', NULL, 0, '1', 1),
(105, 1, 1, 44, 1, '', '', '03', 'OFICINA', 'B001-100099', '0.00', '10.00', '0.00', '0.00', 1, '0.00', '0.00', 10.00, 1, '2020-09-08 12:34:39', NULL, 0, '1', 1),
(106, 1, 1, 44, 1, '', '', '03', 'OFICINA', 'B001-100100', '0.00', '20.00', '0.00', '0.00', 1, '0.00', '0.00', 20.00, 1, '2020-09-08 13:21:39', NULL, 1, '1', 1),
(107, 1, 1, 44, 1, '', '', '03', 'OFICINA', 'B001-100101', '0.00', '10.00', '0.00', '0.00', 1, '0.00', '0.00', 10.00, 1, '2020-09-08 13:28:29', NULL, 1, '1', 1),
(108, 3, 1, 44, 1, 'Av. siempre viva', '965732145', '03', 'OFICINA', 'B001-100102', '0.00', '450.00', '0.00', '0.00', 1, '0.00', '0.00', 450.00, 1, '2020-09-08 13:41:35', NULL, 0, '1', 1),
(109, 28, 1, 44, 1, 'bermudez 1010', '123456789', '01', 'OFICINA', 'F001-100027', '0.00', '0.00', '25.42', '4.58', 1, '0.00', '0.00', 30.00, 1, '2020-09-08 13:41:58', NULL, 1, '1', 1),
(110, 30, 1, 44, 1, 'PEvas 1654', '987654321', '03', 'OFICINA', 'B001-100103', '0.00', '102.00', '0.00', '0.00', 1, '0.00', '0.00', 102.00, 1, '2020-09-08 13:49:11', NULL, 1, '1', 1),
(111, 3, 1, 44, 1, 'Av. siempre viva', '965732145', '01', 'OFICINA', 'F001-100028', '0.00', '20.00', '0.00', '0.00', 1, '0.00', '0.00', 20.00, 1, '2020-09-08 16:02:16', NULL, 1, '1', 1),
(112, 1, 1, 44, 1, '', '', '03', 'OFICINA', 'B001-100104', '0.00', '10.00', '0.00', '0.00', 1, '0.00', '0.00', 10.00, 1, '2020-09-08 17:33:07', NULL, 1, '1', 1),
(113, 1, 1, 44, 1, '', '', '03', 'OFICINA', 'B001-100105', '0.00', '140.00', '0.00', '0.00', 1, '0.00', '0.00', 140.00, 1, '2020-09-08 18:09:14', NULL, 1, '1', 1),
(114, 1, 1, 44, 1, '', '', '03', 'OFICINA', 'B001-100106', '0.00', '0.00', '43.22', '7.78', 1, '0.00', '0.00', 51.00, 1, '2020-09-08 18:26:34', NULL, 1, '1', 1),
(115, 1, 1, 44, 1, '', '', '03', 'OFICINA', 'B001-100107', '0.00', '140.00', '0.00', '0.00', 1, '0.00', '0.00', 140.00, 1, '2020-09-08 18:26:52', NULL, 1, '1', 1),
(116, 1, 1, 44, 1, '', '', '03', 'OFICINA', 'B001-100108', '0.00', '54.50', '0.00', '0.00', 1, '0.00', '0.00', 54.50, 1, '2020-09-08 18:31:04', NULL, 1, '1', 1),
(117, 1, 1, 44, 1, '', '', '03', 'OFICINA', 'B001-100109', '10.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', 10.00, 1, '2020-09-08 22:31:39', NULL, 0, '1', 1),
(118, 1, 1, 44, 1, '', '', '03', 'OFICINA', 'B001-100109', '51.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', 51.00, 1, '2020-09-08 22:37:33', NULL, 1, '1', 1),
(119, 30, 1, 44, 1, 'PEvas 1654', '987654321', '03', 'OFICINA', 'B001-100110', '3.50', '0.00', '0.00', '0.00', 1, '0.00', '0.00', 3.50, 1, '2020-09-08 23:03:57', NULL, 1, '1', 1),
(120, 29, 1, 44, 1, 'aV. DEL eJERCITO 1289', '162537445', '03', 'OFICINA', 'B001-100111', '0.00', '140.00', '0.00', '0.00', 1, '0.00', '0.00', 140.00, 1, '2020-09-08 23:09:15', NULL, 1, '1', 1),
(121, 30, 1, 44, 1, 'PEvas 1654', '987654321', '01', 'OFICINA', 'F001-100029', '40.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', 40.00, 1, '2020-09-08 23:12:25', NULL, 1, '1', 1),
(122, 1, 1, 45, 1, '', '', '03', 'OFICINA', 'B001-100112', '3.60', '0.00', '0.00', '0.00', 1, '0.00', '0.20', 3.80, 1, '2020-09-09 13:00:07', NULL, 0, '1', 1),
(123, 29, 1, 45, 1, 'aV. DEL eJERCITO 1289', '162537445', '03', 'OFICINA', 'B001-100112', '10.10', '0.00', '0.00', '0.00', 1, '0.00', '0.20', 10.30, 1, '2020-09-09 13:02:48', NULL, 0, '1', 1),
(124, 30, 1, 45, 1, 'PEvas 1654', '987654321', '03', 'OFICINA', 'B001-100112', '10.10', '0.00', '0.00', '0.00', 1, '0.00', '0.20', 10.30, 1, '2020-09-09 13:07:39', NULL, 1, '1', 1),
(125, 1, 1, 45, 1, '', '', '03', 'OFICINA', 'B001-100113', '10.70', '0.00', '0.00', '0.00', 1, '0.00', '0.80', 11.70, 1, '2020-09-09 13:21:48', NULL, 1, '1', 1),
(126, 1, 1, 46, 1, '', '', '03', 'OFICINA', 'B001-100114', '70.40', '0.00', '0.00', '0.00', 1, '0.00', '0.40', 70.80, 1, '2020-09-10 15:28:31', NULL, 1, '1', 1),
(127, 30, 1, 46, 1, 'PEvas 1654', '987654321', '01', 'OFICINA', 'F001-100030', '10.60', '0.00', '0.00', '0.00', 1, '0.00', '0.20', 10.80, 1, '2020-09-10 15:46:22', NULL, 1, '1', 1),
(128, 1, 1, 47, 1, '', '', '03', 'OFICINA', 'B001-100115', '140.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', 140.00, 1, '2020-09-11 15:37:52', NULL, 1, '1', 1),
(129, 30, 1, 48, 1, 'PEvas 1654', '987654321', '01', 'OFICINA', 'F001-100031', '70.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', 70.00, 1, '2020-09-12 12:29:42', NULL, 0, '1', 1),
(130, 20, 1, 48, 1, 'alalalala', '91919191', '03', 'PEDIDO', 'B001-100117', '10.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', 10.00, 1, '2020-09-12 15:34:42', NULL, 0, '2', 1),
(131, 1, 6, 49, 1, '', '', '03', 'PEDIDO', 'B001-100118', '150.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', 150.00, 1, '2020-09-13 15:47:53', 0, 0, '2', 1),
(132, 3, 6, 49, 1, 'Av. siempre viva', '965732145', '07', 'OFICINA', 'C001-100000', '0.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', 0.00, 1, '2020-09-13 15:49:07', 6, 0, '1', 1),
(133, 1, 1, 49, 1, '', '', '08', 'OFICINA', 'D001-100000', '43.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', 43.00, 1, '2020-09-13 15:59:29', 3, 0, '1', 1),
(134, 26, 1, 49, 1, 'sdfgddg', '354545', '07', 'OFICINA', 'C001-100000', '35.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', 35.00, 1, '2020-09-13 16:02:24', 4, 0, '1', 1),
(135, 20, 1, 49, 1, 'alalalala', '91919191', '08', 'OFICINA', 'D001-100001', '140.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', 140.00, 1, '2020-09-13 16:04:28', 2, 1, '1', 1),
(136, 18, 1, 49, 1, 'Circunvalacion', '9316152632', '07', 'OFICINA', 'C001-100001', '10.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', 10.00, 1, '2020-09-13 16:04:51', 1, 1, '1', 1),
(137, 1, 6, 49, 1, '', '', '07', 'OFICINA', 'C001-100002', '86.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', 86.00, 1, '2020-09-13 16:05:46', 9, 1, '1', 1),
(138, 29, 1, 49, 1, 'aV. DEL eJERCITO 1289', '162537445', '03', 'OFICINA', 'B001-100119', '54.50', '0.00', '0.00', '0.00', 1, '0.00', '0.00', 54.50, 1, '2020-09-13 20:51:40', 0, 1, '1', 1),
(139, 30, 1, 49, 1, 'PEvas 1654', '987654321', '03', 'OFICINA', 'B001-100120', '155.50', '0.00', '0.00', '0.00', 1, '0.00', '0.00', 155.50, 1, '2020-09-13 21:02:07', 0, 1, '1', 1),
(140, 26, 1, 49, 1, 'sdfgddg', '354545', '08', 'OFICINA', 'D001-100002', '51.00', '0.00', '0.00', '0.00', 1, '0.00', '0.00', 51.00, 1, '2020-09-13 22:43:05', 2, 1, '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salerent`
--

CREATE TABLE `salerent` (
  `id_salerent` int(11) NOT NULL,
  `id_rent` int(11) NOT NULL,
  `id_person` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_location` int(11) NOT NULL,
  `id_turn` int(11) NOT NULL,
  `salerent_date` date NOT NULL,
  `salerent_start` time NOT NULL,
  `salerent_finish` time NOT NULL,
  `salerent_total` double NOT NULL,
  `salerent_finished` tinyint(1) NOT NULL,
  `salerent_cancelled` varchar(5) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `startproduct`
--

CREATE TABLE `startproduct` (
  `id_startproduct` int(11) NOT NULL,
  `id_turn` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `startproduct_stock` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `startproduct`
--

INSERT INTO `startproduct` (`id_startproduct`, `id_turn`, `id_product`, `startproduct_stock`) VALUES
(1, 1, 13, 20),
(2, 2, 13, 20),
(3, 3, 13, 100),
(4, 4, 13, 100),
(5, 5, 13, 100),
(6, 6, 13, 95),
(7, 6, 14, 10),
(8, 7, 13, 95),
(9, 7, 14, 10),
(10, 8, 13, 95),
(11, 8, 14, 10),
(12, 8, 20, 5),
(13, 8, 14, 20),
(14, 9, 13, 94),
(15, 9, 14, 13),
(16, 9, 20, 3),
(17, 9, 13, 94),
(18, 9, 14, 13),
(19, 9, 20, 3),
(20, 9, 13, 94),
(21, 9, 14, 13),
(22, 9, 20, 3),
(23, 9, 13, 94),
(24, 9, 14, 13),
(25, 9, 20, 3),
(26, 13, 13, 94),
(27, 13, 14, 12),
(28, 13, 20, 3),
(29, 14, 13, 79),
(30, 14, 14, 11),
(31, 14, 20, 1),
(32, 15, 13, 62),
(33, 15, 14, 11),
(34, 15, 20, 1),
(35, 16, 13, 56),
(36, 16, 14, 9),
(37, 16, 20, 1),
(39, 17, 13, 56),
(40, 17, 14, 9),
(41, 17, 20, 1),
(42, 17, 22, 50),
(43, 17, 22, 50),
(44, 17, 22, 50),
(45, 17, 22, 50),
(47, 17, 24, 12),
(48, 17, 24, 12),
(49, 17, 24, 12),
(50, 17, 24, 12),
(51, 17, 14, 9),
(52, 17, 14, 9),
(53, 17, 24, 12),
(54, 18, 13, 56),
(55, 18, 14, 9),
(56, 18, 20, 1),
(57, 18, 22, 50),
(58, 18, 24, 12),
(59, 18, 25, 434),
(60, 18, 25, 434),
(61, 18, 25, 434),
(62, 18, 25, 434),
(63, 18, 25, 434),
(64, 18, 20, 1),
(65, 18, 26, 24),
(66, 19, 13, 56),
(67, 19, 14, 9),
(68, 19, 20, 1),
(69, 19, 22, 50),
(70, 19, 24, 12),
(71, 19, 25, 434),
(72, 19, 26, 24),
(73, 20, 13, 56),
(74, 20, 14, 9),
(75, 20, 20, 1),
(76, 20, 22, 50),
(77, 20, 24, 10),
(78, 20, 25, 434),
(79, 20, 26, 24),
(80, 21, 13, 56),
(81, 21, 14, 7),
(82, 21, 20, 1),
(83, 21, 22, 50),
(84, 21, 24, 8),
(85, 21, 25, 432),
(86, 21, 26, 24),
(87, 22, 13, 52),
(88, 22, 14, 6),
(89, 22, 20, 0),
(90, 22, 22, 50),
(91, 22, 24, 8),
(92, 22, 25, 428),
(93, 22, 26, 24),
(94, 22, 25, 428),
(95, 23, 13, 41),
(96, 23, 14, 4),
(97, 23, 20, 0),
(98, 23, 22, 50),
(99, 23, 24, 7),
(100, 23, 25, 98),
(101, 23, 26, 24),
(102, 24, 13, 41),
(103, 24, 14, 4),
(104, 24, 20, 0),
(105, 24, 22, 50),
(106, 24, 24, 7),
(107, 24, 25, 98),
(108, 24, 26, 24),
(109, 25, 13, 41),
(110, 25, 14, 4),
(111, 25, 20, 0),
(112, 25, 22, 50),
(113, 25, 24, 7),
(114, 25, 25, 98),
(115, 25, 26, 24),
(116, 26, 13, 40),
(117, 26, 14, 4),
(118, 26, 20, 0),
(119, 26, 22, 50),
(120, 26, 24, 7),
(121, 26, 25, 98),
(122, 26, 26, 24),
(123, 27, 13, 39),
(124, 27, 14, 3),
(125, 27, 20, 0),
(126, 27, 22, 50),
(127, 27, 24, 6),
(128, 27, 25, 98),
(129, 27, 26, 24),
(130, 27, 13, 39),
(131, 27, 14, 3),
(132, 27, 20, 0),
(133, 27, 22, 50),
(134, 27, 24, 6),
(135, 27, 25, 98),
(136, 27, 26, 24),
(137, 29, 13, 39),
(138, 29, 14, 3),
(139, 29, 20, 0),
(140, 29, 22, 50),
(141, 29, 24, 6),
(142, 29, 25, 98),
(143, 29, 26, 24),
(144, 30, 13, 39),
(145, 30, 14, 3),
(146, 30, 20, 0),
(147, 30, 22, 50),
(148, 30, 24, 6),
(149, 30, 25, 98),
(150, 30, 26, 24),
(151, 31, 13, 39),
(152, 31, 14, 3),
(153, 31, 20, 0),
(154, 31, 22, 50),
(155, 31, 24, 6),
(156, 31, 25, 95),
(157, 31, 26, 23),
(158, 32, 13, 40),
(159, 32, 14, 4),
(160, 32, 20, 0),
(161, 32, 22, 50),
(162, 32, 24, 7),
(163, 32, 25, 96),
(164, 32, 26, 22),
(165, 33, 13, 40),
(166, 33, 14, 4),
(167, 33, 20, 0),
(168, 33, 22, 49),
(169, 33, 24, 7),
(170, 33, 25, 95),
(171, 33, 26, 21),
(172, 34, 13, 39),
(173, 34, 14, 4),
(174, 34, 20, 0),
(175, 34, 22, 48),
(176, 34, 24, 7),
(177, 34, 25, 95),
(178, 34, 26, 21),
(179, 35, 13, 39),
(180, 35, 14, 4),
(181, 35, 20, 0),
(182, 35, 22, 48),
(183, 35, 24, 7),
(184, 35, 25, 95),
(185, 35, 26, 21),
(186, 36, 13, 39),
(187, 36, 14, 4),
(188, 36, 20, 0),
(189, 36, 22, 48),
(190, 36, 24, 7),
(191, 36, 25, 94),
(192, 36, 26, 20),
(193, 36, 27, 100),
(194, 36, 25, 94),
(195, 37, 13, 39),
(196, 37, 14, 104),
(197, 37, 20, 100),
(198, 37, 22, 48),
(199, 37, 24, 57),
(200, 37, 25, 94),
(201, 37, 26, 20),
(202, 37, 27, 100),
(203, 38, 13, 39),
(204, 38, 14, 104),
(205, 38, 20, 99),
(206, 38, 22, 48),
(207, 38, 24, 57),
(208, 38, 25, 93),
(209, 38, 26, 20),
(210, 38, 27, 99),
(211, 39, 13, 39),
(212, 39, 14, 103),
(213, 39, 20, 99),
(214, 39, 22, 48),
(215, 39, 24, 56),
(216, 39, 25, 92),
(217, 39, 26, 20),
(218, 39, 27, 99),
(219, 40, 13, 76),
(220, 40, 14, 103),
(221, 40, 20, 98),
(222, 40, 22, 48),
(223, 40, 24, 60),
(224, 40, 25, 85),
(225, 40, 26, -20),
(226, 40, 27, 98),
(227, 41, 13, -44),
(228, 41, 14, 43),
(229, 41, 20, 96),
(230, 41, 22, 47),
(231, 41, 24, 1),
(232, 41, 25, 84),
(233, 41, 26, -20),
(234, 41, 27, 96),
(235, 42, 13, -1),
(236, 42, 14, -16),
(237, 42, 20, 38),
(238, 42, 22, 47),
(239, 42, 24, 1),
(240, 42, 25, -34),
(241, 42, 26, 20),
(242, 42, 27, 96),
(243, 43, 13, 200),
(244, 43, 14, 142),
(245, 43, 20, 199),
(246, 43, 22, 200),
(247, 43, 24, 192),
(248, 43, 25, 197),
(249, 43, 26, 198),
(250, 43, 27, 95),
(251, 44, 13, 198),
(252, 44, 14, 140),
(253, 44, 20, 198),
(254, 44, 22, 200),
(255, 44, 24, 190),
(256, 44, 25, 196),
(257, 44, 26, 198),
(258, 44, 27, 94),
(259, 45, 13, 193),
(260, 45, 14, 135),
(261, 45, 20, 195),
(262, 45, 22, 200),
(263, 45, 24, 173),
(264, 45, 25, 193),
(265, 45, 26, 198),
(266, 45, 27, 94),
(267, 45, 28, 100),
(268, 45, 29, 100),
(269, 46, 13, 193),
(270, 46, 14, 135),
(271, 46, 20, 196),
(272, 46, 22, 200),
(273, 46, 24, 171),
(274, 46, 25, 195),
(275, 46, 26, 199),
(276, 46, 27, 95),
(277, 46, 28, 98),
(278, 46, 29, 97),
(279, 47, 13, 190),
(280, 47, 14, 135),
(281, 47, 20, 196),
(282, 47, 22, 200),
(283, 47, 24, 171),
(284, 47, 25, 195),
(285, 47, 26, 199),
(286, 47, 27, 93),
(287, 47, 28, 97),
(288, 47, 29, 95),
(289, 48, 13, 190),
(290, 48, 14, 135),
(291, 48, 20, 196),
(292, 48, 22, 200),
(293, 48, 24, 171),
(294, 48, 25, 194),
(295, 48, 26, 199),
(296, 48, 27, 93),
(297, 48, 28, 97),
(298, 48, 29, 95),
(299, 49, 13, 189),
(300, 49, 14, 135),
(301, 49, 20, 196),
(302, 49, 22, 200),
(303, 49, 24, 170),
(304, 49, 25, 194),
(305, 49, 26, 249),
(306, 49, 27, 91),
(307, 49, 28, 97),
(308, 49, 29, 95);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stocklog`
--

CREATE TABLE `stocklog` (
  `id_stocklog` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_turn` int(11) NOT NULL,
  `stocklog_added` double NOT NULL,
  `stocklog_guide` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `stocklog_description` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `stocklog_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `stocklog`
--

INSERT INTO `stocklog` (`id_stocklog`, `id_product`, `id_turn`, `stocklog_added`, `stocklog_guide`, `stocklog_description`, `stocklog_date`) VALUES
(1, 13, 2, 100, 'GE-2019-05-17-100003', '--', '2019-05-17 19:59:37'),
(2, 14, 8, 10, 'GE-2020-07-27-100004', '--', '2020-07-27 11:41:46'),
(3, 20, 8, 1, 'INGRESO POR ANULACION DE VENTA', 'INGRESO POR ANULACION DE VENTA', '2020-07-27 16:41:45'),
(4, 14, 8, 1, 'INGRESO POR ANULACION DE VENTA', 'INGRESO POR ANULACION DE VENTA', '2020-07-27 16:41:45'),
(5, 24, 19, 2, 'INGRESO POR ANULACION DE VENTA', 'INGRESO POR ANULACION DE VENTA', '2020-08-04 12:58:57'),
(6, 22, 19, 1, 'INGRESO POR ANULACION DE VENTA', 'INGRESO POR ANULACION DE VENTA', '2020-08-04 12:58:59'),
(7, 14, 19, 1, 'INGRESO POR ANULACION DE VENTA', 'INGRESO POR ANULACION DE VENTA', '2020-08-04 15:32:47'),
(8, 24, 19, 1, 'INGRESO POR ANULACION DE VENTA', 'INGRESO POR ANULACION DE VENTA', '2020-08-04 15:49:08'),
(9, 24, 19, 2, 'INGRESO POR ANULACION DE VENTA', 'INGRESO POR ANULACION DE VENTA', '2020-08-04 15:50:00'),
(10, 24, 19, 1, 'INGRESO POR ANULACION DE VENTA', 'INGRESO POR ANULACION DE VENTA', '2020-08-04 15:58:12'),
(11, 25, 22, 5, 'INGRESO POR ANULACION DE VENTA', 'INGRESO POR ANULACION DE VENTA', '2020-08-07 14:15:58'),
(12, 13, 26, 1, 'INGRESO POR ANULACION DE VENTA', 'INGRESO POR ANULACION DE VENTA', '2020-08-12 22:34:56'),
(13, 24, 31, 1, 'INGRESO POR ANULACION DE VENTA', 'INGRESO POR ANULACION DE VENTA', '2020-08-19 19:10:57'),
(14, 25, 31, 1, 'INGRESO POR ANULACION DE VENTA', 'INGRESO POR ANULACION DE VENTA', '2020-08-19 19:11:08'),
(15, 13, 31, 1, 'INGRESO POR ANULACION DE VENTA', 'INGRESO POR ANULACION DE VENTA', '2020-08-19 19:17:05'),
(16, 14, 31, 1, 'INGRESO POR ANULACION DE VENTA', 'INGRESO POR ANULACION DE VENTA', '2020-08-19 19:17:06'),
(17, 13, 31, 1, 'INGRESO POR ANULACION DE VENTA', 'INGRESO POR ANULACION DE VENTA', '2020-08-19 21:33:51'),
(18, 20, 36, 100, 'GE-2020-08-31-100005', '--', '2020-08-31 23:38:50'),
(19, 14, 36, 100, 'GE-2020-08-31-100006', '--', '2020-08-31 23:39:01'),
(20, 24, 36, 50, 'GE-2020-08-31-100007', '--', '2020-08-31 23:39:11'),
(21, 13, 39, 1, 'INGRESO POR ANULACION DE VENTA', 'INGRESO POR ANULACION DE VENTA', '2020-09-03 01:50:51'),
(22, 27, 45, 1, 'INGRESO POR ANULACION DE VENTA', 'INGRESO POR ANULACION DE VENTA', '2020-09-09 11:52:00'),
(23, 20, 45, 1, 'INGRESO POR ANULACION DE VENTA', 'INGRESO POR ANULACION DE VENTA', '2020-09-09 11:52:00'),
(24, 25, 45, 1, 'INGRESO POR ANULACION DE VENTA', 'INGRESO POR ANULACION DE VENTA', '2020-09-09 11:52:00'),
(25, 25, 45, 1, 'INGRESO POR ANULACION DE VENTA', 'INGRESO POR ANULACION DE VENTA', '2020-09-09 11:55:31'),
(26, 26, 45, 1, 'INGRESO POR ANULACION DE VENTA', 'INGRESO POR ANULACION DE VENTA', '2020-09-09 11:55:32'),
(27, 26, 48, 50, 'GE-2020-09-12-100008', '--', '2020-09-12 12:06:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stockout`
--

CREATE TABLE `stockout` (
  `id_stockout` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_turn` int(11) NOT NULL,
  `stockout_out` double NOT NULL,
  `stockout_guide` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `stockout_description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `stockout_destiny` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
  `stockout_ruc` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `stockout_origin` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
  `stockout_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `stockout`
--

INSERT INTO `stockout` (`id_stockout`, `id_product`, `id_turn`, `stockout_out`, `stockout_guide`, `stockout_description`, `stockout_destiny`, `stockout_ruc`, `stockout_origin`, `stockout_date`) VALUES
(0, 13, 13, 10, 'GS-2020-07-29-100004', 'prestar', 'ValeGas', '134678014578', 'ChatoGas', '2020-07-29 09:01:33'),
(0, 25, 22, 330, 'GS-2020-08-07-100005', 'sfsdf', 'LLAMA GAs', '12345678901', 'Gas Al toque', '2020-08-07 00:08:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id_tipodocumento` int(11) NOT NULL,
  `tipodocumento_codigo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `tipodocumento_identidad` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `tipodocumento_estado` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id_tipodocumento`, `tipodocumento_codigo`, `tipodocumento_identidad`, `tipodocumento_estado`) VALUES
(1, '0', 'DOC.TRIB.NO.DOM.SIN.RUC', 1),
(2, '1', 'Documento Nacional de Identidad', 1),
(3, '4', 'Carnet de extranjería', 1),
(4, '6', 'Registro Unico de Contributentes', 1),
(5, '7', 'Pasaporte', 1),
(6, 'A', 'Cédula Diplomática de identidad', 1),
(7, 'B', 'DOC.IDENT.PAIS.RESIDENCIA-NO.D', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_ncreditos`
--

CREATE TABLE `tipo_ncreditos` (
  `id` int(11) UNSIGNED NOT NULL,
  `codigo` varchar(10) DEFAULT NULL,
  `tipo_nota_descripcion` varchar(60) DEFAULT NULL,
  `eliminado` tinyint(4) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_ncreditos`
--

INSERT INTO `tipo_ncreditos` (`id`, `codigo`, `tipo_nota_descripcion`, `eliminado`) VALUES
(1, '01', 'Anulación de la operacion', 0),
(2, '02', 'Anulación por error en el RUC', 0),
(3, '03', 'Corrección por error en la descripcion', 0),
(4, '04', 'Descuento Global', 0),
(5, '05', 'Descuento por ítem', 0),
(6, '06', 'Devolución total', 0),
(7, '07', 'Devolución por ítem', 0),
(8, '08', 'Bonificación', 0),
(9, '09', 'Disminición en el valor', 0),
(10, '10', 'Otros conceptos', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_ndebitos`
--

CREATE TABLE `tipo_ndebitos` (
  `id` int(11) UNSIGNED NOT NULL,
  `codigo` varchar(10) DEFAULT NULL,
  `tipo_nota_descripcion` varchar(60) DEFAULT NULL,
  `eliminado` tinyint(4) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_ndebitos`
--

INSERT INTO `tipo_ndebitos` (`id`, `codigo`, `tipo_nota_descripcion`, `eliminado`) VALUES
(1, '01', 'Intereses por mora', 0),
(2, '02', 'Aumento en el valor', 0),
(3, '03', 'Penalidades / Otros conceptos', 0),
(4, '11', 'Ajustes de operaciones de exportación', 0),
(5, '12', 'Ajustes afectos al IVAP', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turn`
--

CREATE TABLE `turn` (
  `id_turn` int(11) NOT NULL,
  `turn_datestart` date NOT NULL,
  `turn_inicialcash` double NOT NULL,
  `turn_active` tinyint(1) NOT NULL,
  `turn_open` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `turn`
--

INSERT INTO `turn` (`id_turn`, `turn_datestart`, `turn_inicialcash`, `turn_active`, `turn_open`) VALUES
(1, '2019-05-16', 0, 0, 0),
(2, '2019-05-17', 0, 0, 0),
(3, '2019-05-22', 0, 0, 0),
(4, '2020-07-23', 0, 0, 0),
(5, '2020-07-24', 100, 0, 1),
(6, '2020-07-25', 100, 0, 1),
(7, '2020-07-26', 0, 0, 0),
(8, '2020-07-27', 0, 0, 0),
(9, '2020-07-28', 100, 0, 1),
(10, '2020-07-28', 0, 0, 0),
(11, '2020-07-28', 0, 0, 0),
(12, '2020-07-28', 0, 0, 0),
(13, '2020-07-29', 0, 0, 0),
(14, '2020-07-30', 0, 0, 0),
(15, '2020-07-31', 100, 0, 1),
(16, '2020-08-01', 0, 0, 0),
(17, '2020-08-02', 0, 0, 0),
(18, '2020-08-03', 0, 0, 0),
(19, '2020-08-04', 0, 0, 0),
(20, '2020-08-05', 0, 0, 0),
(21, '2020-08-06', 0, 0, 0),
(22, '2020-08-07', 0, 0, 0),
(23, '2020-08-08', 0, 0, 0),
(24, '2020-08-10', 0, 0, 0),
(25, '2020-08-11', 0, 0, 0),
(26, '2020-08-12', 0, 0, 0),
(27, '2020-08-13', 0, 0, 0),
(28, '2020-08-13', 0, 0, 0),
(29, '2020-08-14', 100, 0, 1),
(30, '2020-08-18', 100, 0, 1),
(31, '2020-08-19', 0, 0, 0),
(32, '2020-08-20', 0, 0, 0),
(33, '2020-08-21', 0, 0, 0),
(34, '2020-08-24', 0, 0, 0),
(35, '2020-08-30', 100, 0, 1),
(36, '2020-08-31', 0, 0, 0),
(37, '2020-09-01', 0, 0, 0),
(38, '2020-09-02', 0, 0, 0),
(39, '2020-09-03', 0, 0, 0),
(40, '2020-09-04', 0, 0, 0),
(41, '2020-09-05', 0, 0, 0),
(42, '2020-09-06', 0, 0, 0),
(43, '2020-09-07', 0, 0, 0),
(44, '2020-09-08', 0, 0, 0),
(45, '2020-09-09', 0, 0, 0),
(46, '2020-09-10', 0, 0, 0),
(47, '2020-09-11', 0, 0, 0),
(48, '2020-09-12', 0, 0, 0),
(49, '2020-09-13', 0, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `typelocation`
--

CREATE TABLE `typelocation` (
  `id_typelocation` int(11) NOT NULL,
  `typelocation_name` varchar(120) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_person` int(11) DEFAULT NULL,
  `id_role` int(11) NOT NULL,
  `user_nickname` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `user_password` varchar(64) COLLATE utf8_spanish_ci DEFAULT NULL,
  `user_email` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `user_image` varchar(126) COLLATE utf8_spanish_ci DEFAULT NULL,
  `user_status` tinyint(1) DEFAULT NULL,
  `user_created_at` datetime NOT NULL,
  `user_last_login` datetime NOT NULL,
  `user_modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_user`, `id_person`, `id_role`, `user_nickname`, `user_password`, `user_email`, `user_image`, `user_status`, `user_created_at`, `user_last_login`, `user_modified_at`) VALUES
(1, 1, 2, 'admin', '$2y$10$cjeJI.2TafCsVo.diLD3iuR7rtE0.Qm3zb6EPPcVssybJesNQAUWK', 'cesar.ruiz39124@gmail.com', 'media/user/1/user.jpg', 1, '2018-11-26 00:00:00', '2019-04-05 08:40:29', '2019-05-17 20:01:14'),
(2, 3, 3, 'vendedor', '$2y$10$ZiKA/ZQRTeS1IlZbQnD8R.90vE0NOOxVh29fTsyZvL6FNrhM6NV3u', 'admin@a.com', 'media/user/1/user.jpg', 1, '2019-04-17 11:55:39', '0000-00-00 00:00:00', '2020-07-25 16:42:23'),
(6, 7, 3, 'lucho', '$2y$10$PTeT584Mmtb6Tzns1GLwd.S5X46ZPOiS3v.DwcR/7nCEDiVtFhdyC', 'luissalazar@gmail.com', 'media/user/1/user.jpg', 1, '2020-07-25 09:59:31', '0000-00-00 00:00:00', '2020-07-27 15:59:26'),
(7, 8, 4, 'fio', '$2y$10$2p6gQZSL0AeNzRX2dxW/neKh9sPv7oRlZTVEvM46lgWJZwOutj.Z.', 'asdsdd@asdad.com', 'media/user/1/user.jpg', 1, '2020-07-31 12:51:43', '0000-00-00 00:00:00', '2020-08-04 00:14:54');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoryp`
--
ALTER TABLE `categoryp`
  ADD PRIMARY KEY (`id_categoryp`);

--
-- Indices de la tabla `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`),
  ADD KEY `client_tipodocumento` (`id_tipodocumento`),
  ADD KEY `client_tipodocumento_2` (`id_tipodocumento`);

--
-- Indices de la tabla `correlative`
--
ALTER TABLE `correlative`
  ADD PRIMARY KEY (`id_correlative`);

--
-- Indices de la tabla `debt`
--
ALTER TABLE `debt`
  ADD PRIMARY KEY (`id_debt`),
  ADD KEY `id_saleproduct` (`id_saleproduct`);

--
-- Indices de la tabla `debtpay`
--
ALTER TABLE `debtpay`
  ADD PRIMARY KEY (`id_debtpay`),
  ADD KEY `id_debt` (`id_debt`),
  ADD KEY `id_turn` (`id_turn`);

--
-- Indices de la tabla `debtrent`
--
ALTER TABLE `debtrent`
  ADD PRIMARY KEY (`id_debtrent`),
  ADD KEY `id_salerent` (`id_salerent`);

--
-- Indices de la tabla `debtrentpay`
--
ALTER TABLE `debtrentpay`
  ADD PRIMARY KEY (`id_debtrentpay`),
  ADD KEY `id_debtrent` (`id_debtrent`),
  ADD KEY `id_turn` (`id_turn`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id_expense`),
  ADD KEY `id_turn` (`id_turn`);

--
-- Indices de la tabla `igv`
--
ALTER TABLE `igv`
  ADD PRIMARY KEY (`id_igv`);

--
-- Indices de la tabla `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id_location`),
  ADD KEY `id_typelocation` (`id_typelocation`);

--
-- Indices de la tabla `locationrent`
--
ALTER TABLE `locationrent`
  ADD PRIMARY KEY (`id_locationrent`),
  ADD KEY `locationrent_ibfk_1` (`id_location`),
  ADD KEY `locationrent_ibfk_2` (`id_salerent`);

--
-- Indices de la tabla `medida`
--
ALTER TABLE `medida`
  ADD PRIMARY KEY (`medida_id`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indices de la tabla `monedas`
--
ALTER TABLE `monedas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `object`
--
ALTER TABLE `object`
  ADD PRIMARY KEY (`id_object`);

--
-- Indices de la tabla `optionm`
--
ALTER TABLE `optionm`
  ADD PRIMARY KEY (`id_optionm`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indices de la tabla `pedidoproduct`
--
ALTER TABLE `pedidoproduct`
  ADD PRIMARY KEY (`id_pedidoproduct`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_turn` (`id_turn`);

--
-- Indices de la tabla `permit`
--
ALTER TABLE `permit`
  ADD PRIMARY KEY (`id_permit`),
  ADD KEY `id_optionm` (`id_optionm`);

--
-- Indices de la tabla `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id_person`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `id_categoryp` (`id_categoryp`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `product_unid_type` (`product_unid_type`);

--
-- Indices de la tabla `productforsale`
--
ALTER TABLE `productforsale`
  ADD PRIMARY KEY (`id_productforsale`),
  ADD KEY `id_product` (`id_product`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `rent`
--
ALTER TABLE `rent`
  ADD PRIMARY KEY (`id_rent`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indices de la tabla `rolemenu`
--
ALTER TABLE `rolemenu`
  ADD PRIMARY KEY (`id_rolemenu`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indices de la tabla `saledetail`
--
ALTER TABLE `saledetail`
  ADD PRIMARY KEY (`id_saledetail`),
  ADD KEY `id_saleproduct` (`id_saleproduct`),
  ADD KEY `id_productforsale` (`id_productforsale`);

--
-- Indices de la tabla `saledetailgas`
--
ALTER TABLE `saledetailgas`
  ADD PRIMARY KEY (`id_saledetailgas`),
  ADD KEY `id_saleproductgas` (`id_saleproductgas`),
  ADD KEY `id_productforsale` (`id_productforsale`),
  ADD KEY `id_medida` (`id_medida`);

--
-- Indices de la tabla `saleproduct`
--
ALTER TABLE `saleproduct`
  ADD PRIMARY KEY (`id_saleproduct`),
  ADD KEY `id_person` (`id_client`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_turn` (`id_turn`);

--
-- Indices de la tabla `saleproductgas`
--
ALTER TABLE `saleproductgas`
  ADD PRIMARY KEY (`id_saleproductgas`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_turn` (`id_turn`),
  ADD KEY `id_empresa` (`id_empresa`),
  ADD KEY `moneda_id` (`id_moneda`);

--
-- Indices de la tabla `salerent`
--
ALTER TABLE `salerent`
  ADD PRIMARY KEY (`id_salerent`),
  ADD KEY `id_rent` (`id_rent`),
  ADD KEY `id_person` (`id_person`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_location` (`id_location`),
  ADD KEY `id_turn` (`id_turn`);

--
-- Indices de la tabla `startproduct`
--
ALTER TABLE `startproduct`
  ADD PRIMARY KEY (`id_startproduct`),
  ADD KEY `id_turn` (`id_turn`),
  ADD KEY `id_product` (`id_product`);

--
-- Indices de la tabla `stocklog`
--
ALTER TABLE `stocklog`
  ADD PRIMARY KEY (`id_stocklog`),
  ADD KEY `id_turn` (`id_turn`),
  ADD KEY `id_product` (`id_product`);

--
-- Indices de la tabla `stockout`
--
ALTER TABLE `stockout`
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_turn` (`id_turn`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id_tipodocumento`);

--
-- Indices de la tabla `tipo_ncreditos`
--
ALTER TABLE `tipo_ncreditos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_ndebitos`
--
ALTER TABLE `tipo_ndebitos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `turn`
--
ALTER TABLE `turn`
  ADD PRIMARY KEY (`id_turn`);

--
-- Indices de la tabla `typelocation`
--
ALTER TABLE `typelocation`
  ADD PRIMARY KEY (`id_typelocation`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `R_2` (`id_person`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoryp`
--
ALTER TABLE `categoryp`
  MODIFY `id_categoryp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `correlative`
--
ALTER TABLE `correlative`
  MODIFY `id_correlative` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `debt`
--
ALTER TABLE `debt`
  MODIFY `id_debt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `debtpay`
--
ALTER TABLE `debtpay`
  MODIFY `id_debtpay` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `debtrent`
--
ALTER TABLE `debtrent`
  MODIFY `id_debtrent` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `debtrentpay`
--
ALTER TABLE `debtrentpay`
  MODIFY `id_debtrentpay` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `expense`
--
ALTER TABLE `expense`
  MODIFY `id_expense` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `igv`
--
ALTER TABLE `igv`
  MODIFY `id_igv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `location`
--
ALTER TABLE `location`
  MODIFY `id_location` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `locationrent`
--
ALTER TABLE `locationrent`
  MODIFY `id_locationrent` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `medida`
--
ALTER TABLE `medida`
  MODIFY `medida_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `object`
--
ALTER TABLE `object`
  MODIFY `id_object` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `optionm`
--
ALTER TABLE `optionm`
  MODIFY `id_optionm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de la tabla `pedidoproduct`
--
ALTER TABLE `pedidoproduct`
  MODIFY `id_pedidoproduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permit`
--
ALTER TABLE `permit`
  MODIFY `id_permit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `person`
--
ALTER TABLE `person`
  MODIFY `id_person` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `productforsale`
--
ALTER TABLE `productforsale`
  MODIFY `id_productforsale` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `rent`
--
ALTER TABLE `rent`
  MODIFY `id_rent` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rolemenu`
--
ALTER TABLE `rolemenu`
  MODIFY `id_rolemenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `saledetail`
--
ALTER TABLE `saledetail`
  MODIFY `id_saledetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `saledetailgas`
--
ALTER TABLE `saledetailgas`
  MODIFY `id_saledetailgas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT de la tabla `saleproduct`
--
ALTER TABLE `saleproduct`
  MODIFY `id_saleproduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `saleproductgas`
--
ALTER TABLE `saleproductgas`
  MODIFY `id_saleproductgas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT de la tabla `salerent`
--
ALTER TABLE `salerent`
  MODIFY `id_salerent` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `startproduct`
--
ALTER TABLE `startproduct`
  MODIFY `id_startproduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=309;

--
-- AUTO_INCREMENT de la tabla `stocklog`
--
ALTER TABLE `stocklog`
  MODIFY `id_stocklog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id_tipodocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipo_ncreditos`
--
ALTER TABLE `tipo_ncreditos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tipo_ndebitos`
--
ALTER TABLE `tipo_ndebitos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `turn`
--
ALTER TABLE `turn`
  MODIFY `id_turn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `typelocation`
--
ALTER TABLE `typelocation`
  MODIFY `id_typelocation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`id_tipodocumento`) REFERENCES `tipo_documento` (`id_tipodocumento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `debt`
--
ALTER TABLE `debt`
  ADD CONSTRAINT `debt_ibfk_1` FOREIGN KEY (`id_saleproduct`) REFERENCES `saleproduct` (`id_saleproduct`);

--
-- Filtros para la tabla `debtpay`
--
ALTER TABLE `debtpay`
  ADD CONSTRAINT `debtpay_ibfk_1` FOREIGN KEY (`id_debt`) REFERENCES `debt` (`id_debt`),
  ADD CONSTRAINT `debtpay_ibfk_2` FOREIGN KEY (`id_turn`) REFERENCES `turn` (`id_turn`);

--
-- Filtros para la tabla `debtrent`
--
ALTER TABLE `debtrent`
  ADD CONSTRAINT `debtrent_ibfk_1` FOREIGN KEY (`id_salerent`) REFERENCES `salerent` (`id_salerent`);

--
-- Filtros para la tabla `debtrentpay`
--
ALTER TABLE `debtrentpay`
  ADD CONSTRAINT `debtrentpay_ibfk_1` FOREIGN KEY (`id_debtrent`) REFERENCES `debtrent` (`id_debtrent`),
  ADD CONSTRAINT `debtrentpay_ibfk_2` FOREIGN KEY (`id_turn`) REFERENCES `turn` (`id_turn`);

--
-- Filtros para la tabla `expense`
--
ALTER TABLE `expense`
  ADD CONSTRAINT `expense_ibfk_1` FOREIGN KEY (`id_turn`) REFERENCES `turn` (`id_turn`);

--
-- Filtros para la tabla `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`id_typelocation`) REFERENCES `typelocation` (`id_typelocation`);

--
-- Filtros para la tabla `locationrent`
--
ALTER TABLE `locationrent`
  ADD CONSTRAINT `locationrent_ibfk_1` FOREIGN KEY (`id_location`) REFERENCES `location` (`id_location`) ON DELETE NO ACTION,
  ADD CONSTRAINT `locationrent_ibfk_2` FOREIGN KEY (`id_salerent`) REFERENCES `salerent` (`id_salerent`) ON DELETE NO ACTION;

--
-- Filtros para la tabla `optionm`
--
ALTER TABLE `optionm`
  ADD CONSTRAINT `optionm_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`);

--
-- Filtros para la tabla `pedidoproduct`
--
ALTER TABLE `pedidoproduct`
  ADD CONSTRAINT `pedidoproduct_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `pedidoproduct_ibfk_2` FOREIGN KEY (`id_turn`) REFERENCES `turn` (`id_turn`),
  ADD CONSTRAINT `pedidoproduct_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Filtros para la tabla `permit`
--
ALTER TABLE `permit`
  ADD CONSTRAINT `permit_ibfk_1` FOREIGN KEY (`id_optionm`) REFERENCES `optionm` (`id_optionm`);

--
-- Filtros para la tabla `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_categoryp`) REFERENCES `categoryp` (`id_categoryp`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`product_unid_type`) REFERENCES `medida` (`medida_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productforsale`
--
ALTER TABLE `productforsale`
  ADD CONSTRAINT `productforsale_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rolemenu`
--
ALTER TABLE `rolemenu`
  ADD CONSTRAINT `rolemenu_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`),
  ADD CONSTRAINT `rolemenu_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`);

--
-- Filtros para la tabla `saledetail`
--
ALTER TABLE `saledetail`
  ADD CONSTRAINT `saledetail_ibfk_2` FOREIGN KEY (`id_productforsale`) REFERENCES `productforsale` (`id_productforsale`),
  ADD CONSTRAINT `saledetail_ibfk_3` FOREIGN KEY (`id_saleproduct`) REFERENCES `saleproduct` (`id_saleproduct`);

--
-- Filtros para la tabla `saledetailgas`
--
ALTER TABLE `saledetailgas`
  ADD CONSTRAINT `saledetailgas_ibfk_1` FOREIGN KEY (`id_productforsale`) REFERENCES `productforsale` (`id_productforsale`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `saledetailgas_ibfk_2` FOREIGN KEY (`id_saleproductgas`) REFERENCES `saleproductgas` (`id_saleproductgas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `saledetailgas_ibfk_3` FOREIGN KEY (`id_medida`) REFERENCES `medida` (`medida_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `saleproduct`
--
ALTER TABLE `saleproduct`
  ADD CONSTRAINT `saleproduct_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `saleproduct_ibfk_3` FOREIGN KEY (`id_turn`) REFERENCES `turn` (`id_turn`),
  ADD CONSTRAINT `saleproduct_ibfk_4` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);

--
-- Filtros para la tabla `saleproductgas`
--
ALTER TABLE `saleproductgas`
  ADD CONSTRAINT `saleproductgas_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `saleproductgas_ibfk_2` FOREIGN KEY (`id_turn`) REFERENCES `turn` (`id_turn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `saleproductgas_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `saleproductgas_ibfk_4` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `salerent`
--
ALTER TABLE `salerent`
  ADD CONSTRAINT `salerent_ibfk_1` FOREIGN KEY (`id_rent`) REFERENCES `rent` (`id_rent`),
  ADD CONSTRAINT `salerent_ibfk_2` FOREIGN KEY (`id_person`) REFERENCES `person` (`id_person`),
  ADD CONSTRAINT `salerent_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `salerent_ibfk_4` FOREIGN KEY (`id_location`) REFERENCES `location` (`id_location`),
  ADD CONSTRAINT `salerent_ibfk_5` FOREIGN KEY (`id_turn`) REFERENCES `turn` (`id_turn`);

--
-- Filtros para la tabla `startproduct`
--
ALTER TABLE `startproduct`
  ADD CONSTRAINT `startproduct_ibfk_1` FOREIGN KEY (`id_turn`) REFERENCES `turn` (`id_turn`),
  ADD CONSTRAINT `startproduct_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `stocklog`
--
ALTER TABLE `stocklog`
  ADD CONSTRAINT `stocklog_ibfk_1` FOREIGN KEY (`id_turn`) REFERENCES `turn` (`id_turn`),
  ADD CONSTRAINT `stocklog_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`);

--
-- Filtros para la tabla `stockout`
--
ALTER TABLE `stockout`
  ADD CONSTRAINT `stockout_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`),
  ADD CONSTRAINT `stockout_ibfk_2` FOREIGN KEY (`id_turn`) REFERENCES `turn` (`id_turn`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `R_2` FOREIGN KEY (`id_person`) REFERENCES `person` (`id_person`),
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
