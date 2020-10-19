-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: dbtrapeca
-- Tiempo de generación: 10-10-2020 a las 22:55:56
-- Versión del servidor: 8.0.21
-- Versión de PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `trapeca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int NOT NULL,
  `code_cate` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_cate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion_cate` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `code_cate`, `nombre_cate`, `descripcion_cate`) VALUES
(1, 'Ferre01', 'Ferretería', 'Área de Ferretería'),
(2, 'medi1', 'Farmacia', 'Área de Farmacia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int NOT NULL,
  `id_deta` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `id_deta`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_compra` int NOT NULL,
  `proveedor` int DEFAULT NULL,
  `monto_total` float(11,2) DEFAULT NULL,
  `tipo_pago` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_compras`
--

CREATE TABLE `det_compras` (
  `id` int NOT NULL,
  `id_compra` int DEFAULT NULL,
  `producto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `id_movimiento` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_ventas`
--

CREATE TABLE `det_ventas` (
  `id` int NOT NULL,
  `id_venta` int DEFAULT NULL,
  `producto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `id_movimiento` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `identificacion`
--

CREATE TABLE `identificacion` (
  `id` int NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` bigint DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dni` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `identificacion`
--

INSERT INTO `identificacion` (`id`, `nombre`, `apellido`, `telefono`, `direccion`, `correo`, `dni`) VALUES
(1, 'Miguel', 'Escalante', 12345, 'Barrio el Rio', 'skander1705@gmail.com', '27989234'),
(2, NULL, NULL, 912931923, 'Barrio el Rio ', 'miguels@gmail.com', '123123123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_producto` int DEFAULT NULL,
  `cantidad` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `code`, `id_producto`, `cantidad`) VALUES
(1, '100000', 13, 1),
(2, NULL, 18, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monedas`
--

CREATE TABLE `monedas` (
  `id_monedas` int NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `simbolo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tasa_cambio` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento_inventario`
--

CREATE TABLE `movimiento_inventario` (
  `id_movimiento` int NOT NULL,
  `cantidad` int NOT NULL,
  `tipo` int DEFAULT NULL,
  `usuario` int DEFAULT NULL,
  `id_inventario` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `movimiento_inventario`
--

INSERT INTO `movimiento_inventario` (`id_movimiento`, `cantidad`, `tipo`, `usuario`, `id_inventario`) VALUES
(31, 10, 1, 2, 1),
(32, 60, 1, 2, 1),
(33, 69, 2, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int NOT NULL,
  `nombre_prod` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_cate` int DEFAULT NULL,
  `precio_v` float(11,2) DEFAULT NULL,
  `precio_c` float(11,2) DEFAULT NULL,
  `disponible` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre_prod`, `id_cate`, `precio_v`, `precio_c`, `disponible`) VALUES
(13, 'Llave Inglesa', 1, 5.00, 4.00, 1),
(17, 'Atamel 500mg', 2, 3.00, 2.00, 1),
(18, 'Alcohol 600ml', 2, 3.00, 2.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int NOT NULL,
  `razon_social` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_deta` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `razon_social`, `id_deta`) VALUES
(1, 'Miguel\'s ', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `slug`) VALUES
(1, 'Administrador', 'administrador', 'admin'),
(2, 'Operador', 'Operador', 'operator'),
(3, 'Usuario', 'Usuario', 'user');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_movimiento`
--

CREATE TABLE `tipo_movimiento` (
  `id_tipo` int NOT NULL,
  `nombre_tipo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_movimiento`
--

INSERT INTO `tipo_movimiento` (`id_tipo`, `nombre_tipo`) VALUES
(4, 'Autoconsumo'),
(1, 'Entrada'),
(3, 'Retiro'),
(2, 'Salida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rol` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `password`, `rol`, `status`, `token`) VALUES
(2, 'Miguel', 'Escalante', 'skander1705@gmail.com', '123456', 1, 1, NULL),
(3, 'Migeu', NULL, 'asdasd@gmail.com', NULL, 3, 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int NOT NULL,
  `monto_total` int DEFAULT NULL,
  `recibo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_pago` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `referencia` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `cliente` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code_cate` (`code_cate`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_deta` (`id_deta`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `proveedor` (`proveedor`);

--
-- Indices de la tabla `det_compras`
--
ALTER TABLE `det_compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_movimiento` (`id_movimiento`),
  ADD KEY `id_compra` (`id_compra`);

--
-- Indices de la tabla `det_ventas`
--
ALTER TABLE `det_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_movimiento` (`id_movimiento`),
  ADD KEY `id_venta` (`id_venta`);

--
-- Indices de la tabla `identificacion`
--
ALTER TABLE `identificacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `monedas`
--
ALTER TABLE `monedas`
  ADD PRIMARY KEY (`id_monedas`);

--
-- Indices de la tabla `movimiento_inventario`
--
ALTER TABLE `movimiento_inventario`
  ADD PRIMARY KEY (`id_movimiento`),
  ADD KEY `id_inventario` (`id_inventario`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `tipo` (`tipo`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cate` (`id_cate`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_deta` (`id_deta`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_movimiento`
--
ALTER TABLE `tipo_movimiento`
  ADD PRIMARY KEY (`id_tipo`),
  ADD KEY `nombre` (`nombre_tipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol` (`rol`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `cliente` (`cliente`),
  ADD KEY `recibo` (`recibo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `det_compras`
--
ALTER TABLE `det_compras`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `det_ventas`
--
ALTER TABLE `det_ventas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `identificacion`
--
ALTER TABLE `identificacion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `monedas`
--
ALTER TABLE `monedas`
  MODIFY `id_monedas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `movimiento_inventario`
--
ALTER TABLE `movimiento_inventario`
  MODIFY `id_movimiento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_movimiento`
--
ALTER TABLE `tipo_movimiento`
  MODIFY `id_tipo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`id_deta`) REFERENCES `identificacion` (`id`);

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`proveedor`) REFERENCES `proveedores` (`id`);

--
-- Filtros para la tabla `det_compras`
--
ALTER TABLE `det_compras`
  ADD CONSTRAINT `det_compras_ibfk_1` FOREIGN KEY (`id_movimiento`) REFERENCES `movimiento_inventario` (`id_movimiento`),
  ADD CONSTRAINT `det_compras_ibfk_2` FOREIGN KEY (`id_compra`) REFERENCES `compras` (`id_compra`);

--
-- Filtros para la tabla `det_ventas`
--
ALTER TABLE `det_ventas`
  ADD CONSTRAINT `det_ventas_ibfk_1` FOREIGN KEY (`id_movimiento`) REFERENCES `movimiento_inventario` (`id_movimiento`),
  ADD CONSTRAINT `det_ventas_ibfk_2` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`);

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `movimiento_inventario`
--
ALTER TABLE `movimiento_inventario`
  ADD CONSTRAINT `movimiento_inventario_ibfk_1` FOREIGN KEY (`id_inventario`) REFERENCES `inventario` (`id`),
  ADD CONSTRAINT `movimiento_inventario_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_cate`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD CONSTRAINT `proveedores_ibfk_1` FOREIGN KEY (`id_deta`) REFERENCES `identificacion` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `roles` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `clientes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
