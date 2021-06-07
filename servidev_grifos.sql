-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-06-2021 a las 17:43:58
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `servidev_grifos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aqperfiles`
--

CREATE TABLE `aqperfiles` (
  `idperfil` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `permiso` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `idarticulo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `idtipo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `precioventa` float NOT NULL,
  `valorventa` float NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `unidad` text COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` float NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`idarticulo`, `idtipo`, `precioventa`, `valorventa`, `descripcion`, `unidad`, `cantidad`, `estado`) VALUES
('1', '02', 20, 16.94, 'Aceite Shell Helix Ultra', 'Uni', 10, 0),
('7891191003111', '04', 10, 8.2, 'Durex Clímax Mutuo', 'Uni', 10, 0),
('7891191003744', '01', 50, 42.37, 'Gasoline 84 octane', 'Gal', 10, 0),
('7891191003755', '01', 50, 42.37, 'Gasoline 90 octane', 'Gal', 10, 0),
('8', '03', 30, 25.42, 'Petróleo', 'Gal', 10, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `idcaja` int(11) NOT NULL,
  `idusuario` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `saldo` float NOT NULL,
  `fechaapertura` date NOT NULL DEFAULT current_timestamp(),
  `horaapertura` time NOT NULL DEFAULT current_timestamp(),
  `fechacierre` date NOT NULL DEFAULT current_timestamp(),
  `horacierre` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`idcaja`, `idusuario`, `saldo`, `fechaapertura`, `horaapertura`, `fechacierre`, `horacierre`) VALUES
(86, '88', 0, '2021-05-24', '12:26:41', '2021-05-24', '11:28:36'),
(87, '88', 0, '2021-05-24', '12:27:38', '2021-05-24', '11:37:46'),
(88, '88', 0, '2021-05-24', '12:30:06', '2021-05-24', '12:30:06'),
(89, '3', 0, '2021-05-24', '12:37:52', '2021-05-24', '12:37:52'),
(90, '3', 0, '2021-05-26', '08:54:43', '2021-05-26', '09:31:51'),
(91, '3', 0, '2021-05-26', '10:32:02', '2021-05-26', '09:37:22'),
(92, '3', 0, '2021-05-26', '10:37:26', '2021-05-26', '10:37:26'),
(93, '3', 0, '2021-05-28', '08:55:20', '2021-05-28', '08:55:20'),
(94, '3', 0, '2021-05-31', '10:25:29', '2021-06-02', '10:26:28'),
(95, '3', 900, '2021-06-02', '11:26:32', '2021-06-02', '11:26:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cardex`
--

CREATE TABLE `cardex` (
  `idcardex` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `tipo` enum('01','03') COLLATE utf8_spanish_ci NOT NULL,
  `serie` enum('Boleta','Factura') COLLATE utf8_spanish_ci NOT NULL,
  `codeSerie` int(11) NOT NULL,
  `tipoOperacion` enum('01','99') CHARACTER SET utf32 COLLATE utf32_spanish_ci NOT NULL,
  `cantidadEntradas` float NOT NULL,
  `costoUnitarioE` float NOT NULL,
  `costoTotalE` float NOT NULL,
  `totalEntradas` float NOT NULL,
  `cantidadSalidas` float NOT NULL,
  `costoUnitarioS` float NOT NULL,
  `costoTotalS` float NOT NULL,
  `totalSalidas` float NOT NULL,
  `cantidadSaldo` float NOT NULL,
  `costoUnitarioSaldo` float NOT NULL,
  `costoTotalSaldo` float NOT NULL,
  `totalSaldo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idcliente` int(11) NOT NULL,
  `documento` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `ndocumento` varchar(13) COLLATE utf8_spanish_ci NOT NULL,
  `razonsocial` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(13) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` text COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idcliente`, `documento`, `ndocumento`, `razonsocial`, `direccion`, `telefono`, `email`) VALUES
(1, 'DNI', '23', 'asdf', 'asdf', '000000000', 'sdf@sfg.gh'),
(2, 'RUC', '343', 'dffg', 'asf', '000000000', 'asdffj.lk'),
(3, 'RUC', '123412', 'sadfasf', 'adfasdd', '3245', 'sd@sdf.vm'),
(4, 'DNI', '45454545', 'aaaaaaaaaa', 'asdasd', '3453445', 'asdasdsa'),
(5, 'DNI', '72172392', 'aaaaaaaaaaa', 'asdsadsa', '345621', 'asdasda'),
(6, '', '72172395', 'ARIANA ALEXANDRA CAMACHO ORTIZ', '', '', ''),
(7, '', '72172391', 'PATRICIA SOLANGE HUANCA AGUILAR', '', '', ''),
(8, '', '72172393', 'YANIXA ALEXANDRA CASTILLO VALENCIA', '', '', ''),
(9, '', '72172394', 'JOHN ABNER CASTILLO VALENCIA', '', '', ''),
(10, '', '72172345', 'NICOLLETTE MILAGROS GUTIERREZ LLALLICO', '', '', ''),
(11, 'DNI', '72172359', 'PAOLA BEATRIZ LOZADA YARLEQUE', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `idcompra` int(11) NOT NULL,
  `idusuario` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `idproveedor` varchar(13) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `lote` text COLLATE utf8_spanish_ci NOT NULL,
  `observacion` text COLLATE utf8_spanish_ci NOT NULL,
  `impuesto` float NOT NULL,
  `neto` float NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuentos`
--

CREATE TABLE `descuentos` (
  `idusuario` int(11) NOT NULL,
  `descuento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `descuentos`
--

INSERT INTO `descuentos` (`idusuario`, `descuento`) VALUES
(1, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallecompra`
--

CREATE TABLE `detallecompra` (
  `id_detalle_compra` int(11) NOT NULL,
  `idcompra` int(11) NOT NULL,
  `idarticulo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_c` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE `detallepedido` (
  `idpedido` int(11) NOT NULL,
  `idarticulo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `unidad` text COLLATE utf8_spanish_ci NOT NULL,
  `valorUnitario` int(11) NOT NULL,
  `desUnitario` int(11) NOT NULL,
  `valorUnitarioNeto` int(11) NOT NULL,
  `cantingresada` int(11) NOT NULL,
  `cantanulada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detallepedido`
--

INSERT INTO `detallepedido` (`idpedido`, `idarticulo`, `cantidad`, `unidad`, `valorUnitario`, `desUnitario`, `valorUnitarioNeto`, `cantingresada`, `cantanulada`) VALUES
(27, '7891191003111 ', 1, ' Uni ', 0, 0, 0, 0, 0),
(27, '1 ', 1, ' Uni ', 0, 0, 0, 0, 0),
(28, '7891191003744 ', 1, ' Gal ', 0, 0, 0, 0, 0),
(28, '7891191003755 ', 1, ' Gal ', 0, 0, 0, 0, 0),
(29, '8 ', 1, ' Gal ', 0, 0, 0, 0, 0),
(29, '7891191003755 ', 1, ' Gal ', 0, 0, 0, 0, 0),
(29, '7891191003744 ', 1, ' Gal ', 0, 0, 0, 0, 0),
(30, '7891191003744 ', 1, ' Gal ', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventa`
--

CREATE TABLE `detalleventa` (
  `idventa` int(11) NOT NULL,
  `idarticulo` varchar(13) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `precioventa` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `totalcompra` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `rucempresa` varchar(13) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `domiciliofiscal` text COLLATE utf8_spanish_ci NOT NULL,
  `monto` float NOT NULL,
  `montorestante` float NOT NULL,
  `montofaltante` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`rucempresa`, `nombre`, `domiciliofiscal`, `monto`, `montorestante`, `montofaltante`) VALUES
('123456789', 'MR JHON', 'Piura, la esquina del susto', 1000, 0, 0),
('32098627172', 'MR JED', 'Piura, los Ficus II', 10000, 0, 0),
('9830182938473', 'MR ALAMA', 'Tambogrande', 1000, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `idhorario` int(11) NOT NULL,
  `nhoras` int(11) NOT NULL,
  `nombrehorario` varchar(8) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`idhorario`, `nhoras`, `nombrehorario`) VALUES
(1, 12, '12 Horas'),
(2, 8, '8 Horas'),
(3, 4, '4 Horas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `islas`
--

CREATE TABLE `islas` (
  `idisla` char(2) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `montoscaja`
--

CREATE TABLE `montoscaja` (
  `idusuario` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `idcaja` int(11) NOT NULL,
  `monto` float NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `montoscaja`
--

INSERT INTO `montoscaja` (`idusuario`, `idcaja`, `monto`, `fecha`) VALUES
('1', 88, 1000, '2021-06-02 10:42:01'),
('3', 88, 900, '2021-06-02 12:05:55'),
('3', 95, 132, '2021-06-02 12:25:12'),
('3', 95, 980, '2021-06-02 12:25:34'),
('3', 95, 1500, '2021-06-02 12:26:27'),
('3', 95, 870, '2021-06-02 12:29:09'),
('3', 95, 10, '2021-06-03 08:08:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `idpedido` int(11) NOT NULL,
  `idusuario` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `idproveedor` varchar(13) COLLATE utf8_spanish_ci NOT NULL,
  `descuento` float NOT NULL,
  `subtotal` float NOT NULL,
  `igv` float NOT NULL,
  `estado` bit(1) NOT NULL,
  `total` float NOT NULL,
  `observacion` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `fechaentrega` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`idpedido`, `idusuario`, `idproveedor`, `descuento`, `subtotal`, `igv`, `estado`, `total`, `observacion`, `fecha`, `fechaentrega`) VALUES
(27, '1', '123456789', 0, 237.8, 52.2, b'0', 290, '', '2021-05-26 10:40:52', '2021-05-30'),
(28, '1', '0938471823904', 0, 2050, 450, b'0', 2500, '', '2021-05-26 13:36:48', '2021-05-31'),
(29, '1', '0938471823904', 0, 3280, 720, b'0', 4000, '', '2021-05-26 13:45:49', '2021-05-31'),
(30, '1', '12345678', 0, 984, 216, b'0', 1200, '', '2021-05-26 13:53:51', '2021-06-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `idperfil` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `description` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`idperfil`, `description`) VALUES
('01', 'admin'),
('02', 'vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `idproveedor` varchar(13) COLLATE utf8_spanish_ci NOT NULL,
  `razonsocial` text COLLATE utf8_spanish_ci NOT NULL,
  `domfiscal` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(13) COLLATE utf8_spanish_ci NOT NULL,
  `email` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`idproveedor`, `razonsocial`, `domfiscal`, `telefono`, `email`) VALUES
('0938471823904', 'ORGANIZACIÓN ISA', 'Piura x16', '987654321', 'isa@isa.com'),
('12345678', 'Mr Elar', 'sdf', '276890765', 'mrelar@mrelar.net'),
('123456789', 'Mr Jed', 'ssfedgfeftrtr', '693217853', 'razonx1@prekab.net'),
('873487', 'Team RED', 'Piura Castilla La Colmena', '999999999', 'teamred.suport@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `surtidores`
--

CREATE TABLE `surtidores` (
  `idsurtidor` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `idisla` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `lado` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoarticulo`
--

CREATE TABLE `tipoarticulo` (
  `idtipo` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipoarticulo`
--

INSERT INTO `tipoarticulo` (`idtipo`, `descripcion`) VALUES
('01', 'Combustible'),
('02', 'Aceite'),
('03', 'Petróleo'),
('04', 'Condones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadoresempresa`
--

CREATE TABLE `trabajadoresempresa` (
  `dnitrabajador` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `nombres` text COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` text CHARACTER SET utf32 COLLATE utf32_spanish_ci NOT NULL,
  `rucempresa` varchar(13) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `trabajadoresempresa`
--

INSERT INTO `trabajadoresempresa` (`dnitrabajador`, `nombres`, `apellidos`, `rucempresa`) VALUES
('12345678', 'Tuca ', 'Chero Martínez', '32098627172');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `user` varchar(7) COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `nombres` text COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` text COLLATE utf8_spanish_ci NOT NULL,
  `idperfil` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(1) NOT NULL,
  `caja` int(11) NOT NULL,
  `idhorario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `user`, `password`, `nombres`, `apellidos`, `idperfil`, `foto`, `estado`, `caja`, `idhorario`) VALUES
('1', 'juan', '$2a$07$asxx54ahjppf45sd87a5auwRi.z6UsW7kVIpm0CUEuCpmsvT2sG6O', 'Juan Pablo', 'De La Torre Valdez', '01', 'views/img/usuarios/juan/249.jpg', 0, 0, 3),
('3', 'elar', '$2a$07$asxx54ahjppf45sd87a5au9jQEm.1RCmNVNfqy62MdIG5dCwvHs/u', 'Elar', 'López', '02', 'views/img/usuarios/elar/642.jpg', 0, 95, 1),
('88', 'alama', '$2a$07$asxx54ahjppf45sd87a5auyKYmBFXgS1lw6v0G3NoOarrLEJFDQfy', 'alama', 'alama', '02', '', 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vales`
--

CREATE TABLE `vales` (
  `idvale` int(11) NOT NULL,
  `idventa` int(11) NOT NULL,
  `rucempresa` int(11) NOT NULL,
  `idtrabajador` int(11) NOT NULL,
  `idvehiculo` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `idvehiculo` varchar(7) COLLATE utf8_spanish_ci NOT NULL,
  `km` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `rucempresa` varchar(13) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`idvehiculo`, `km`, `rucempresa`) VALUES
('A00-000', '100', '32098627172'),
('B00-201', '', '32098627172');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `idventa` int(11) NOT NULL,
  `idusuario` varchar(7) COLLATE utf8_spanish_ci NOT NULL,
  `idcliente` int(11) DEFAULT NULL,
  `fechaemision` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fechacancelacion` datetime DEFAULT current_timestamp(),
  `comprobante` enum('','Boleta','Factura') COLLATE utf8_spanish_ci NOT NULL,
  `codecomprobante` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `productos` text COLLATE utf8_spanish_ci NOT NULL,
  `metpago` enum('Efectivo','TC','TD') COLLATE utf8_spanish_ci NOT NULL,
  `codetransaccion` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `subtotal` float NOT NULL,
  `descuento` float DEFAULT NULL,
  `igv` float NOT NULL,
  `total` float NOT NULL,
  `estado` text COLLATE utf8_spanish_ci NOT NULL,
  `estadoec` text COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`idventa`, `idusuario`, `idcliente`, `fechaemision`, `fechacancelacion`, `comprobante`, `codecomprobante`, `productos`, `metpago`, `codetransaccion`, `subtotal`, `descuento`, `igv`, `total`, `estado`, `estadoec`) VALUES
(127, '1', 11, '2021-06-04 18:14:06', '2021-06-04 13:14:51', 'Boleta', '1', 'fgfdgfd', 'Efectivo', NULL, 10, 0, 1.8, 11.8, 'realizada', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aqperfiles`
--
ALTER TABLE `aqperfiles`
  ADD KEY `pkperfilpermiso` (`idperfil`);

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`idarticulo`),
  ADD KEY `pktipoarticulo` (`idtipo`);

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`idcaja`),
  ADD KEY `pk_idusuario_caja` (`idusuario`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idcliente`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`idcompra`),
  ADD KEY `pk_usuarios` (`idusuario`),
  ADD KEY `pk_proveedor` (`idproveedor`);

--
-- Indices de la tabla `detallecompra`
--
ALTER TABLE `detallecompra`
  ADD PRIMARY KEY (`id_detalle_compra`),
  ADD KEY `detalle_articulo` (`idarticulo`),
  ADD KEY `pk_detalle_compra` (`idcompra`);

--
-- Indices de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD KEY `fk_idarticulo_detallepedido` (`idarticulo`),
  ADD KEY `fk_id_detallepedido` (`idpedido`);

--
-- Indices de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD KEY `pk_detalle_idarticulo` (`idarticulo`),
  ADD KEY `fk_detalle_idventa` (`idventa`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`rucempresa`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`idhorario`);

--
-- Indices de la tabla `islas`
--
ALTER TABLE `islas`
  ADD PRIMARY KEY (`idisla`);

--
-- Indices de la tabla `montoscaja`
--
ALTER TABLE `montoscaja`
  ADD KEY `fk_idusuario_caja` (`idusuario`),
  ADD KEY `fk_idcaja_monto` (`idcaja`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idpedido`),
  ADD KEY `fk_uer_pedido` (`idusuario`),
  ADD KEY `fk_proveedor_pedido` (`idproveedor`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`idperfil`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`idproveedor`);

--
-- Indices de la tabla `surtidores`
--
ALTER TABLE `surtidores`
  ADD PRIMARY KEY (`idsurtidor`);

--
-- Indices de la tabla `tipoarticulo`
--
ALTER TABLE `tipoarticulo`
  ADD PRIMARY KEY (`idtipo`);

--
-- Indices de la tabla `trabajadoresempresa`
--
ALTER TABLE `trabajadoresempresa`
  ADD PRIMARY KEY (`dnitrabajador`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `pk_idperfil_usuario` (`idperfil`);

--
-- Indices de la tabla `vales`
--
ALTER TABLE `vales`
  ADD PRIMARY KEY (`idvale`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`idvehiculo`),
  ADD KEY `fk_ruc_empresa` (`rucempresa`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`idventa`),
  ADD KEY `pk_venta_idusuario` (`idusuario`),
  ADD KEY `fk_idcliente` (`idcliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `idcaja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `detallecompra`
--
ALTER TABLE `detallecompra`
  MODIFY `id_detalle_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idpedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `idventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aqperfiles`
--
ALTER TABLE `aqperfiles`
  ADD CONSTRAINT `pkperfilpermiso` FOREIGN KEY (`idperfil`) REFERENCES `perfiles` (`idperfil`);

--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `pktipoarticulo` FOREIGN KEY (`idtipo`) REFERENCES `tipoarticulo` (`idtipo`);

--
-- Filtros para la tabla `caja`
--
ALTER TABLE `caja`
  ADD CONSTRAINT `pk_idusuario_caja` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `pk_proveedor` FOREIGN KEY (`idproveedor`) REFERENCES `proveedores` (`idproveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pk_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detallecompra`
--
ALTER TABLE `detallecompra`
  ADD CONSTRAINT `detalle_articulo` FOREIGN KEY (`idarticulo`) REFERENCES `articulos` (`idarticulo`) ON DELETE CASCADE,
  ADD CONSTRAINT `pk_detalle_compra` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD CONSTRAINT `fk_id_detallepedido` FOREIGN KEY (`idpedido`) REFERENCES `pedidos` (`idpedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idarticulo_detallepedido` FOREIGN KEY (`idarticulo`) REFERENCES `articulos` (`idarticulo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD CONSTRAINT `fk_detalle_idventa` FOREIGN KEY (`idventa`) REFERENCES `ventas` (`idventa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pk_detalle_idarticulo` FOREIGN KEY (`idarticulo`) REFERENCES `articulos` (`idarticulo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `montoscaja`
--
ALTER TABLE `montoscaja`
  ADD CONSTRAINT `fk_idcaja_monto` FOREIGN KEY (`idcaja`) REFERENCES `caja` (`idcaja`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_idusuario_caja` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_proveedor_pedido` FOREIGN KEY (`idproveedor`) REFERENCES `proveedores` (`idproveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_uer_pedido` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `pk_idperfil_usuario` FOREIGN KEY (`idperfil`) REFERENCES `perfiles` (`idperfil`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `fk_ruc_empresa` FOREIGN KEY (`rucempresa`) REFERENCES `empresas` (`rucempresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_idcliente` FOREIGN KEY (`idcliente`) REFERENCES `clientes` (`idcliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pk_venta_idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
