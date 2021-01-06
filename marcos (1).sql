-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 06-01-2021 a las 19:56:07
-- Versión del servidor: 5.7.17-log
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `marcos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abonos`
--

CREATE TABLE `abonos` (
  `id_abonos` int(11) NOT NULL,
  `id_apartado` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `cantidad` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apartados`
--

CREATE TABLE `apartados` (
  `id_apartados` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `id_ventas` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `descripcion`, `id_grupo`, `status`) VALUES
(1, 'disfrute', 1, 0),
(2, 'otros', 1, 0),
(3, 'Proveedores', 2, 0),
(4, 'Internet', 2, 0),
(5, 'Agua potable', 2, 0),
(6, 'Energia Electrica', 2, 0),
(7, 'Otros', 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `domicilio` varchar(50) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `codigopostal` int(11) NOT NULL,
  `telefono` int(11) NOT NULL,
  `editable` tinyint(1) NOT NULL,
  `permisos` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `apellidos`, `domicilio`, `ciudad`, `estado`, `codigopostal`, `telefono`, `editable`, `permisos`, `status`) VALUES
(1, 'Ocasional', '', '', '', '', 0, 0, 0, '', 0)

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventas`
--

CREATE TABLE `detalleventas` (
  `id_detalleventas` int(11) NOT NULL,
  `id_ventas` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `preciounitario` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `domicilio` varchar(50) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `codigopostal` varchar(10) NOT NULL,
  `tipo_usuario` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `nombre`, `apellidos`, `domicilio`, `ciudad`, `estado`, `telefono`, `codigopostal`, `tipo_usuario`, `status`, `password`, `usuario`) VALUES
(1, 'Administrador', '', '', '', '', '', '', 'Administrador', 1, '2a2e9a58102784ca18e2605a4e727b5f', 'administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `id_gastos` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id_grupo` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id_grupo`, `descripcion`, `status`) VALUES
(1, 'ventas', 0),
(2, 'gastos', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `costo` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `stock_max` int(11) NOT NULL,
  `stock_min` int(11) NOT NULL,
  `existencia` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametro`
--

CREATE TABLE `parametro` (
  `id_parametro` int(11) NOT NULL,
  `nombre_empresa` varchar(255) NOT NULL,
  `domicilio` varchar(50) NOT NULL,
  `telefono` int(11) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `ciudad` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedidos` int(11) NOT NULL,
  `id_inventario` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `observaciones` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `domicilio` varchar(50) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `codigopostal` int(11) NOT NULL,
  `telefono` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_ventas` int(11) NOT NULL,
  `folio` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `cliente` int(11) NOT NULL,
  `empleado` int(11) NOT NULL,
  `descuento` varchar(10) NOT NULL,
  `porcentaje` int(11) NOT NULL,
  `tipo` varchar(35) NOT NULL,
  `total` int(11) NOT NULL,
  `pago` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vta_sales`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vta_sales` (
`folio` int(11)
,`fecha` datetime
,`descuento` varchar(10)
,`total` int(11)
,`status` int(11)
,`preciounitario` int(11)
,`cantidad` int(11)
,`nombre_producto` varchar(50)
,`nombre_cliente` varchar(20)
,`pago` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_apartados`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_apartados` (
`id_cliente` int(11)
,`nombre_cliente` varchar(71)
,`fecha` datetime
,`descripcion` varchar(50)
,`cantidad` int(11)
,`total` int(11)
,`id_apartados` int(11)
,`folio` int(11)
,`nombre_empleado` varchar(71)
,`descuento` varchar(10)
,`porcentaje` int(11)
,`importe_total` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_inventario`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_inventario` (
`id_inventario` int(11)
,`descripcion` varchar(50)
,`codigo` varchar(50)
,`precio` int(11)
,`costo` int(11)
,`stock_min` int(11)
,`stock_max` int(11)
,`existencia` int(11)
,`status` int(11)
,`nombre_proveedor` varchar(255)
,`nombre_categoria` varchar(255)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vta_sales`
--
DROP TABLE IF EXISTS `vta_sales`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vta_sales`  AS  select `vta`.`folio` AS `folio`,`vta`.`fecha` AS `fecha`,`vta`.`descuento` AS `descuento`,`vta`.`total` AS `total`,`vta`.`status` AS `status`,`dv`.`preciounitario` AS `preciounitario`,`dv`.`cantidad` AS `cantidad`,`i`.`descripcion` AS `nombre_producto`,`c`.`nombre` AS `nombre_cliente`,`vta`.`pago` AS `pago` from (((`ventas` `vta` join `detalleventas` `dv` on((`vta`.`id_ventas` = `dv`.`id_ventas`))) join `inventario` `i` on((`dv`.`producto` = `i`.`id_inventario`))) join `cliente` `c` on((`c`.`id_cliente` = `vta`.`cliente`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_apartados`
--
DROP TABLE IF EXISTS `v_apartados`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_apartados`  AS  select `c`.`id_cliente` AS `id_cliente`,concat(`c`.`nombre`,' ',`c`.`apellidos`) AS `nombre_cliente`,`vta`.`fecha` AS `fecha`,`i`.`descripcion` AS `descripcion`,`dv`.`cantidad` AS `cantidad`,`dv`.`total` AS `total`,`a`.`id_apartados` AS `id_apartados`,`vta`.`folio` AS `folio`,concat(`e`.`nombre`,' ',`e`.`apellidos`) AS `nombre_empleado`,`vta`.`descuento` AS `descuento`,`vta`.`porcentaje` AS `porcentaje`,`vta`.`total` AS `importe_total` from ((((((`apartados` `a` join `ventas` `vta` on((`a`.`id_ventas` = `vta`.`id_ventas`))) join `cliente` `c` on((`c`.`id_cliente` = `a`.`cliente`))) join `detalleventas` `dv` on((`dv`.`id_ventas` = `a`.`id_ventas`))) join `empleados` `e` on((`e`.`id_empleado` = `vta`.`empleado`))) join `inventario` `i` on((`i`.`id_inventario` = `dv`.`producto`))) left join `abonos` `ab` on((`a`.`id_apartados` = `ab`.`id_apartado`))) where ((`vta`.`status` = 2) and (`a`.`status` = 0)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_inventario`
--
DROP TABLE IF EXISTS `v_inventario`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_inventario`  AS  select `inv`.`id_inventario` AS `id_inventario`,`inv`.`descripcion` AS `descripcion`,`inv`.`codigo` AS `codigo`,`inv`.`precio` AS `precio`,`inv`.`costo` AS `costo`,`inv`.`stock_min` AS `stock_min`,`inv`.`stock_max` AS `stock_max`,`inv`.`existencia` AS `existencia`,`inv`.`status` AS `status`,`p`.`nombre` AS `nombre_proveedor`,`cat`.`descripcion` AS `nombre_categoria` from ((`inventario` `inv` join `proveedor` `p` on((`inv`.`id_proveedor` = `p`.`id_proveedor`))) join `categoria` `cat` on((`inv`.`id_categoria` = `cat`.`id_categoria`))) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abonos`
--
ALTER TABLE `abonos`
  ADD PRIMARY KEY (`id_abonos`),
  ADD KEY `FK` (`id_apartado`);

--
-- Indices de la tabla `apartados`
--
ALTER TABLE `apartados`
  ADD PRIMARY KEY (`id_apartados`),
  ADD KEY `cliente` (`cliente`),
  ADD KEY `id_ventas` (`id_ventas`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `detalleventas`
--
ALTER TABLE `detalleventas`
  ADD PRIMARY KEY (`id_detalleventas`),
  ADD KEY `id_ventas` (`id_ventas`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id_gastos`),
  ADD KEY `FK` (`id_empleado`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`),
  ADD KEY `FK` (`id_proveedor`),
  ADD KEY `FK1` (`id_categoria`);

--
-- Indices de la tabla `parametro`
--
ALTER TABLE `parametro`
  ADD PRIMARY KEY (`id_parametro`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedidos`),
  ADD KEY `FK` (`id_inventario`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_ventas`),
  ADD KEY `id_empleado` (`empleado`),
  ADD KEY `id_cliente` (`cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abonos`
--
ALTER TABLE `abonos`
  MODIFY `id_abonos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `apartados`
--
ALTER TABLE `apartados`
  MODIFY `id_apartados` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `detalleventas`
--
ALTER TABLE `detalleventas`
  MODIFY `id_detalleventas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `id_gastos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `parametro`
--
ALTER TABLE `parametro`
  MODIFY `id_parametro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedidos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_ventas` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `abonos`
--
ALTER TABLE `abonos`
  ADD CONSTRAINT `apartado` FOREIGN KEY (`id_apartado`) REFERENCES `apartados` (`id_apartados`);

--
-- Filtros para la tabla `apartados`
--
ALTER TABLE `apartados`
  ADD CONSTRAINT `cliente` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `categoria_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`);

--
-- Filtros para la tabla `detalleventas`
--
ALTER TABLE `detalleventas`
  ADD CONSTRAINT `id_ventas` FOREIGN KEY (`id_ventas`) REFERENCES `ventas` (`id_ventas`);

--
-- Filtros para la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD CONSTRAINT `empleado` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gastos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `inventarios` FOREIGN KEY (`id_inventario`) REFERENCES `inventario` (`id_inventario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `id_cliente` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `id_empleado` FOREIGN KEY (`empleado`) REFERENCES `empleados` (`id_empleado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
