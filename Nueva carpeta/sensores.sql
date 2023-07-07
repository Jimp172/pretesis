-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-04-2022 a las 17:01:21
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sensores`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id_historial` int(255) NOT NULL,
  `id_sensor` int(11) DEFAULT NULL,
  `temperatura` varchar(255) DEFAULT '',
  `ph` varchar(255) DEFAULT NULL,
  `oxigeno` varchar(11) DEFAULT '',
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id_historial`, `id_sensor`, `temperatura`, `ph`, `oxigeno`, `fecha`, `hora`) VALUES
(1, 4, '10', '2', '4', '2022-03-16', '12:20:12'),
(2, 7, '4', '40', '2', '2022-03-14', '22:00:00'),
(3, 4, '14', '10', '23', '2022-03-16', '12:22:38'),
(5, 4, '2', '12', '25', '2022-03-16', '12:24:54'),
(6, 4, '45', '65', '25', '2022-03-16', '12:24:54'),
(7, 4, '58', '87', '25', '2022-03-16', '12:26:54'),
(8, 4, '23', '45', '25', '2022-03-16', '12:28:54'),
(9, 4, '12', '7.2', '66', '2022-03-16', '12:30:54'),
(17, 6, '15.19', '2.55', '4', '2022-03-19', '12:49:22'),
(18, 6, '13.45', '2.96', '9', '2022-03-19', '12:49:26'),
(19, 6, '8.03', '4.44', '6', '2022-03-19', '12:49:30'),
(20, 6, '19.52', '12.41', '2', '2022-03-19', '12:49:30'),
(21, 6, '12.50', '0.72', '9', '2022-03-19', '12:49:33'),
(22, 6, '17.06', '9.96', '11', '2022-03-19', '12:50:21'),
(23, 6, '13.91', '4.51', '7', '2022-03-19', '12:50:24'),
(24, 6, '19.78', '7.21', '7', '2022-03-19', '12:50:28'),
(25, 6, '10.64', '5.51', '7', '2022-03-19', '12:50:28'),
(26, 6, '10.98', '4.07', '7', '2022-03-19', '12:50:32'),
(27, 6, '6.18', '12.95', '3', '2022-03-19', '12:50:35'),
(28, 6, '4.92', '5.85', '3', '2022-03-19', '12:50:39'),
(29, 6, '17.77', '11.86', '7', '2022-03-19', '12:50:45'),
(30, 6, '9.67', '0.61', '6', '2022-03-19', '12:50:52'),
(31, 6, '18.34', '0.93', '9', '2022-03-19', '12:50:57'),
(32, 6, '9.03', '5.81', '9', '2022-03-19', '12:51:27'),
(33, 6, '8.13', '11.03', '10', '2022-03-19', '12:51:36'),
(34, 6, '4.15', '3.05', '2', '2022-03-19', '12:53:29'),
(35, 6, '13.30', '12.58', '2', '2022-03-19', '12:58:12'),
(36, 6, '14.11', '7.40', '5', '2022-03-19', '12:58:43'),
(37, 6, '4.11', '10.32', '8', '2022-03-19', '12:58:48'),
(38, 6, '8.73', '7.79', '2', '2022-03-19', '12:58:51'),
(39, 6, '9.04', '1.01', '1', '2022-03-19', '12:58:58'),
(40, 6, '19.36', '5.03', '8', '2022-03-19', '12:59:03'),
(41, 6, '18.15', '5.12', '1', '2022-03-19', '12:59:09'),
(42, 6, '14.31', '9.60', '3', '2022-03-19', '13:05:42'),
(43, 6, '17.28', '6.15', '4', '2022-03-19', '13:06:36'),
(44, 4, '13', '6.83', '66', '2022-03-19', '13:12:09'),
(45, 6, '10.14', '8.16', '5', '2022-03-19', '13:28:01'),
(46, 6, '17.76', '8.40', '7', '2022-03-19', '14:12:04'),
(47, 6, '12', '7', '66', '2022-03-19', '14:31:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sensor`
--

CREATE TABLE `sensor` (
  `id_sensor` int(255) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `codigo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sensor`
--

INSERT INTO `sensor` (`id_sensor`, `nombre`, `codigo`) VALUES
(4, 'sensor 3', 'NR3'),
(6, 'sensor 2', 'NR2'),
(7, 'sensor numero 1', 'NR 1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipo` int(11) NOT NULL,
  `detalle_tipo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo`, `detalle_tipo`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'USUARIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(255) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `ci_ruc` varchar(10) DEFAULT NULL,
  `nick` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `id_telegram` varchar(255) DEFAULT NULL,
  `canal_telegram` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `direccion`, `ci_ruc`, `nick`, `pass`, `id_tipo`, `id_telegram`, `canal_telegram`) VALUES
(1, 'ADMINISTRADOR', 'DIRECCION DE ADMINISTRADOR', '111111111', 'ADMIN', 'ADMIN', 1, '1153509143', NULL),
(2, 'PACO', 'CALDERON', '1722221450', 'PACO', 'PEPE', 2, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `FK_HISTORIAL_SENSOR` (`id_sensor`);

--
-- Indices de la tabla `sensor`
--
ALTER TABLE `sensor`
  ADD PRIMARY KEY (`id_sensor`),
  ADD KEY `id_sensor` (`id_sensor`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `FK_TIPO_USUARIO` (`id_tipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id_historial` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `sensor`
--
ALTER TABLE `sensor`
  MODIFY `id_sensor` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `FK_HISTORIAL_SENSOR` FOREIGN KEY (`id_sensor`) REFERENCES `sensor` (`id_sensor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_usuario` (`id_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
