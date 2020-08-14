-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-07-2020 a las 20:16:16
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bufeosalebd-e`
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
  `client_name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `client_type` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `client_number` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `client_address` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_telephone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`id_client`, `client_name`, `client_type`, `client_number`, `client_address`, `client_telephone`) VALUES
(1, 'ANONIMO', 'PERSONA', '11111111', '', ''),
(2, 'Luis', 'PERSONA', '71106432', 'Alzamora 958', '953295553'),
(3, 'Adrian Salazar', 'PERSONA', '10767676765', 'Av. siempre viva', '965732145');

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
  `correlative_p` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `correlative`
--

INSERT INTO `correlative` (`id_correlative`, `correlative_b`, `correlative_f`, `correlative_in`, `correlative_out`, `correlative_p`) VALUES
(1, 100038, 100003, 100005, 100005, 100008);

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
(22, 'Venta de Gas', 'fa fa-plus', 'SellGas', 4, 1, 0);

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
(82, 22, 'Ver Detalle de Venta', 'viewSale', 0, 1, 3);

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
  `pedidoproduct_date` datetime DEFAULT current_timestamp(),
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
(63, 82, 'revokeSale', 1);

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
(7, 'Luis Antonio', 'Salazar Bartra', '71106432', '1995-11-23', '953295553', 'M', 'ALZAMORA 958');

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
  `product_unid_type` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `product_stock` double NOT NULL,
  `product_created_at` datetime NOT NULL,
  `id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id_product`, `id_categoryp`, `product_barcode`, `product_name`, `product_description`, `product_unid_type`, `product_stock`, `product_created_at`, `id_proveedor`) VALUES
(13, 2, '132', 'HELADO CHOCOKRISPIS', '--', 'UND', 56, '2019-05-16 21:59:01', 3),
(14, 1, '133', 'Balon GLP 10kg', '--', 'UND', 9, '2020-07-25 17:17:45', 3),
(20, 1, '134', 'Balon GLP 45KG', '--', 'UND', 1, '2020-07-27 00:53:58', 4);

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
(3, 20, 1, 150.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_provee` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `contacto_provee` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono_provee` bigint(11) DEFAULT NULL,
  `direccion_provee` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `date_add` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nombre_provee`, `contacto_provee`, `telefono_provee`, `direccion_provee`, `date_add`) VALUES
(3, 'LLAMAGAS', 'Emma Bartra', 923261373, 'Santa Clara km 10', '2020-07-25 17:29:53'),
(4, 'SOLGAS', 'Edgar Bartra', 965010101, 'Alzamora 958, Iquitos', '2020-07-25 17:30:49'),
(5, 'Amazon Gas', 'Luis', 123456789, 'alzamora', '2020-07-26 00:57:13'),
(8, 'BufeoTec', 'Clever', 965626263, 'pevas 1890', '2020-07-26 14:12:20'),
(9, 'Caletita', 'Milagros', 123456789, 'San Juan km 09', '2020-07-26 21:52:26'),
(10, 'Fasanando', 'sdfsfff', 23421342, 'Dos de Mayo', '2020-07-26 21:52:46');

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
(52, 2, 22);

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
(31, 26, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, 3.50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saledetailgas`
--

CREATE TABLE `saledetailgas` (
  `id_saledetailgas` int(11) NOT NULL,
  `id_saleproductgas` int(11) NOT NULL,
  `id_productforsale` int(11) NOT NULL,
  `sale_productnamegas` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `sale_unidgas` double NOT NULL,
  `sale_pricegas` float(10,2) NOT NULL,
  `sale_productscantgas` double NOT NULL,
  `sale_productstotalselledgas` double NOT NULL,
  `sale_productstotalpricegas` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `saledetailgas`
--

INSERT INTO `saledetailgas` (`id_saledetailgas`, `id_saleproductgas`, `id_productforsale`, `sale_productnamegas`, `sale_unidgas`, `sale_pricegas`, `sale_productscantgas`, `sale_productstotalselledgas`, `sale_productstotalpricegas`) VALUES
(1, 3, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, 3.50),
(2, 4, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 4, 4, 14.00),
(3, 5, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 4, 4, 14.00),
(4, 6, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, 3.50),
(5, 7, 1, 'HELADO CHOCOKRISPIS X 1 UND', 1, 3.50, 1, 1, 3.50),
(6, 7, 2, 'Balon GLP 10kg X 1 UND', 1, 51.00, 1, 1, 51.00);

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
(26, 1, 7, 15, 'BOLETA', 'BN° 100037', 3.5, '2020-07-31 12:53:51', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saleproductgas`
--

CREATE TABLE `saleproductgas` (
  `id_saleproductgas` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_turn` int(11) NOT NULL,
  `saleproductgas_direccion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `saleproductgas_type` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `saleproductgas_naturaleza` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `saleproductgas_correlativo` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `saleproductgas_total` float(10,2) NOT NULL,
  `saleproductgas_date` datetime NOT NULL,
  `saleproductgas_cancelled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `saleproductgas`
--

INSERT INTO `saleproductgas` (`id_saleproductgas`, `id_client`, `id_user`, `id_turn`, `saleproductgas_direccion`, `saleproductgas_type`, `saleproductgas_naturaleza`, `saleproductgas_correlativo`, `saleproductgas_total`, `saleproductgas_date`, `saleproductgas_cancelled`) VALUES
(2, 1, 1, 14, 'gfgffg', 'BOLETA', 'PEDIDO', 'BN° 100029', 3.50, '2020-07-30 21:03:53', 1),
(3, 1, 1, 14, '', 'BOLETA', 'PEDIDO', 'BN° 100029', 3.50, '2020-07-30 21:06:05', 1),
(4, 1, 1, 14, 'Castilla 1312', 'BOLETA', 'PEDIDO', 'BN° 100030', 14.00, '2020-07-30 21:08:21', 1),
(5, 1, 1, 14, 'mariscal caceres 2013', 'BOLETA', 'PEDIDO', 'BN° 100031', 14.00, '2020-07-30 22:51:46', 1),
(6, 1, 1, 15, '', 'BOLETA', 'PEDIDO', 'BN° 100032', 3.50, '2020-07-31 08:53:44', 1),
(7, 1, 1, 15, 'San Roma 1980', 'BOLETA', 'PEDIDO', 'BN° 100033', 54.50, '2020-07-31 09:17:57', 1);

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
(34, 15, 20, 1);

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
(4, 14, 8, 1, 'INGRESO POR ANULACION DE VENTA', 'INGRESO POR ANULACION DE VENTA', '2020-07-27 16:41:45');

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
(0, 13, 13, 10, 'GS-2020-07-29-100004', 'prestar', 'ValeGas', '134678014578', 'ChatoGas', '2020-07-29 09:01:33');

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
(15, '2020-07-31', 100, 1, 1);

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
(7, 2, 4, 'luis', '$2y$10$2p6gQZSL0AeNzRX2dxW/neKh9sPv7oRlZTVEvM46lgWJZwOutj.Z.', 'luis', 'media/user/1/user.jpg', 1, '2020-07-31 12:51:43', '0000-00-00 00:00:00', '2020-07-31 12:51:43');

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
  ADD PRIMARY KEY (`id_client`);

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
-- Indices de la tabla `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id_expense`),
  ADD KEY `id_turn` (`id_turn`);

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
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

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
  ADD KEY `id_proveedor` (`id_proveedor`);

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
  ADD KEY `id_productforsale` (`id_productforsale`);

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
  ADD KEY `id_turn` (`id_turn`);

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
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT de la tabla `expense`
--
ALTER TABLE `expense`
  MODIFY `id_expense` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `object`
--
ALTER TABLE `object`
  MODIFY `id_object` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `optionm`
--
ALTER TABLE `optionm`
  MODIFY `id_optionm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de la tabla `pedidoproduct`
--
ALTER TABLE `pedidoproduct`
  MODIFY `id_pedidoproduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permit`
--
ALTER TABLE `permit`
  MODIFY `id_permit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `person`
--
ALTER TABLE `person`
  MODIFY `id_person` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `productforsale`
--
ALTER TABLE `productforsale`
  MODIFY `id_productforsale` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `id_rolemenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `saledetail`
--
ALTER TABLE `saledetail`
  MODIFY `id_saledetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `saledetailgas`
--
ALTER TABLE `saledetailgas`
  MODIFY `id_saledetailgas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `saleproduct`
--
ALTER TABLE `saleproduct`
  MODIFY `id_saleproduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `saleproductgas`
--
ALTER TABLE `saleproductgas`
  MODIFY `id_saleproductgas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `salerent`
--
ALTER TABLE `salerent`
  MODIFY `id_salerent` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `startproduct`
--
ALTER TABLE `startproduct`
  MODIFY `id_startproduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `stocklog`
--
ALTER TABLE `stocklog`
  MODIFY `id_stocklog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `turn`
--
ALTER TABLE `turn`
  MODIFY `id_turn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productforsale`
--
ALTER TABLE `productforsale`
  ADD CONSTRAINT `productforsale_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`);

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
  ADD CONSTRAINT `saledetailgas_ibfk_1` FOREIGN KEY (`id_productforsale`) REFERENCES `productforsale` (`id_productforsale`),
  ADD CONSTRAINT `saledetailgas_ibfk_2` FOREIGN KEY (`id_saleproductgas`) REFERENCES `saleproductgas` (`id_saleproductgas`);

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
  ADD CONSTRAINT `saleproductgas_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `saleproductgas_ibfk_2` FOREIGN KEY (`id_turn`) REFERENCES `turn` (`id_turn`),
  ADD CONSTRAINT `saleproductgas_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

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
  ADD CONSTRAINT `startproduct_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`);

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
