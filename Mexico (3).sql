-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 17-04-2024 a las 05:24:34
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Mexico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_ventas`
--

CREATE TABLE `detalles_ventas` (
  `id_detalle` int(11) NOT NULL,
  `id_venta` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_unitario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ropas`
--

CREATE TABLE `ropas` (
  `id` int(11) NOT NULL,
  `Tipo_de_prenda` varchar(50) NOT NULL,
  `Genero` varchar(30) NOT NULL,
  `Talla` varchar(50) NOT NULL,
  `Color` varchar(30) NOT NULL,
  `Precio` bigint(255) NOT NULL,
  `Stock` int(255) NOT NULL,
  `Fecha_de_entrada` date NOT NULL,
  `Proveedor` varchar(100) NOT NULL,
  `Detalles` text NOT NULL,
  `Imagen` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ropas`
--

INSERT INTO `ropas` (`id`, `Tipo_de_prenda`, `Genero`, `Talla`, `Color`, `Precio`, `Stock`, `Fecha_de_entrada`, `Proveedor`, `Detalles`, `Imagen`) VALUES
(14, 'Vestido', 'Hombre', 'EXG', 'Negro', 12, 1212, '2024-04-03', 'Provedor B', 'jhbdwkj edkbc ed', 'WhatsApp Image 2024-04-09 at 11.28.45 PM.jpeg'),
(15, 'Vestido', 'Hombre', 'M', 'Rojo', 300, 12, '2024-04-09', 'Provedor A', 'Vestido navideño', 'WhatsApp Image 2024-04-09 at 1.12.23 AM.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  `rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contraseña`, `rol`) VALUES
(1, 'Salvador Arevalo Navarro', 'salvador.arevalonavarro@gmail.com', 'chava2003', 'Administrador'),
(2, 'Mariano LLanass Ramirez', 'mariano.llanas@gmail.com', '232323', 'Administrador'),
(3, 'Tuly', 'tuly.arevalo@gmail.com', '4231', 'Administrador'),
(4, 'Noe Isaac Estrada de Leon', 'noe.estrada@gmail.com', 'noe1234', 'Usuario'),
(13, 'as', 'as@gmail.com', '1234', 'Usuario'),
(18, 'mau', 'mau@gmail.com', '1234', 'Usuario'),
(35, 'Lucas', 'lucas@gmail.com', '1234', 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(250) NOT NULL,
  `id_usuario` int(200) NOT NULL,
  `nombre_cliente` text NOT NULL,
  `fecha_venta` date NOT NULL,
  `ganancia` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_usuario`, `nombre_cliente`, `fecha_venta`, `ganancia`) VALUES
(1, 4, 'Noe Isaac Estrada de Leon', '2024-04-05', 3),
(6, 18, 'mau', '2024-04-04', 878),
(7, 35, 'Lucass', '2024-04-16', 928),
(8, 35, 'Lucass', '2024-04-16', 928),
(9, 35, 'Lucass', '2024-04-16', 928);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalles_ventas`
--
ALTER TABLE `detalles_ventas`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `fk_venta` (`id_venta`),
  ADD KEY `fk_producto` (`id_producto`);

--
-- Indices de la tabla `ropas`
--
ALTER TABLE `ropas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `fk_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalles_ventas`
--
ALTER TABLE `detalles_ventas`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ropas`
--
ALTER TABLE `ropas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles_ventas`
--
ALTER TABLE `detalles_ventas`
  ADD CONSTRAINT `fk_producto` FOREIGN KEY (`id_producto`) REFERENCES `ropas` (`id`),
  ADD CONSTRAINT `fk_venta` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
