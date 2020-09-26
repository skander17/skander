CREATE TABLE `identificacion` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `telefono` bigint(20) DEFAULT NULL,
  `direccion` varchar(255),
  `correo` varchar(255) DEFAULT NULL,
  `NIT` varchar(255) DEFAULT NULL,
  `RIF` varchar(255) DEFAULT NULL,
  `CI` varchar(255) DEFAULT NULL
);

CREATE TABLE `cliente` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_deta` int(11) DEFAULT NULL
);

CREATE TABLE `proveedores` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(255) DEFAULT NULL,
  `id_deta` int(11) DEFAULT NULL
);

CREATE TABLE `categorias` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `code_cate` varchar(25) NOT NULL,
  `nombre_cate` varchar(255) DEFAULT NULL,
  `descripcion_cate` varchar(50) DEFAULT NULL
);

CREATE TABLE `productos` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nombre_prod` varchar(255) DEFAULT NULL,
  `id_cate` int(11) DEFAULT NULL,
  `precio_v` float(11,2) DEFAULT NULL,
  `precio_c` float(11,2) DEFAULT NULL,
  `disponible` boolean DEFAULT true
);

CREATE TABLE `inventario` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
);

CREATE TABLE `movimiento_inventario` (
  `id_movimiento` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `tipo` int(1),
  `usuario` int(11),
  `id_inventario` int(11)
);

CREATE TABLE `ventas` (
  `id_venta` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `monto_total` int(11),
  `recibo` varchar(255),
  `tipo_pago` varchar(255),
  `referencia` varchar(255) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `cliente` int(11)
);

CREATE TABLE `det_ventas` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_venta` int,
  `producto` varchar(255),
  `cantidad` int,
  `id_movimiento` int
);

CREATE TABLE `compras` (
  `id_compra` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `proveedor` int(11),
  `monto_total` float(11,2),
  `tipo_pago` varchar(255),
  `fecha` datetime
);

CREATE TABLE `det_compras` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_compra` int,
  `producto` varchar(255),
  `cantidad` int(11),
  `id_movimiento` int(11)
);

CREATE TABLE `monedas` (
  `id_monedas` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255),
  `simbolo` varchar(255),
  `tasa_cambio` int
);

CREATE TABLE `usuarios` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255),
  `correo` varchar(255),
  `contrasena` varchar(255),
  `token` varchar(255)
);

ALTER TABLE `cliente` ADD FOREIGN KEY (`id_deta`) REFERENCES `identificacion` (`id`);

ALTER TABLE `proveedores` ADD FOREIGN KEY (`id_deta`) REFERENCES `identificacion` (`id`);

ALTER TABLE `det_ventas` ADD FOREIGN KEY (`id_movimiento`) REFERENCES `movimiento_inventario` (`id_movimiento`);

ALTER TABLE `det_compras` ADD FOREIGN KEY (`id_movimiento`) REFERENCES `movimiento_inventario` (`id_movimiento`);

ALTER TABLE `movimiento_inventario` ADD FOREIGN KEY (`id_inventario`) REFERENCES `inventario` (`id`);

ALTER TABLE `det_ventas` ADD FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`);

ALTER TABLE `ventas` ADD FOREIGN KEY (`cliente`) REFERENCES `cliente` (`id`);

ALTER TABLE `compras` ADD FOREIGN KEY (`proveedor`) REFERENCES `proveedores` (`id`);

ALTER TABLE `inventario` ADD FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

ALTER TABLE `det_compras` ADD FOREIGN KEY (`id_compra`) REFERENCES `compras` (`id_compra`);

ALTER TABLE `productos` ADD FOREIGN KEY (`id_cate`) REFERENCES `categorias` (`id`);

ALTER TABLE `movimiento_inventario` ADD FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`);

CREATE INDEX `id_deta` ON `cliente` (`id_deta`);

CREATE INDEX `id_deta` ON `proveedores` (`id_deta`);

CREATE INDEX `code_cate` ON `categorias` (`code_cate`);

CREATE INDEX `id_cate` ON `productos` (`id_cate`);

CREATE INDEX `usuario` ON `movimiento_inventario` (`usuario`);

CREATE INDEX `tipo` ON `movimiento_inventario` (`tipo`);

CREATE INDEX `cliente` ON `ventas` (`cliente`);

CREATE INDEX `recibo` ON `ventas` (`recibo`);