-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-05-2019 a las 22:19:41
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `grupo52`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `elementos_por_pagina` int(10) NOT NULL,
  `habilitado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `titulo`, `descripcion`, `email`, `elementos_por_pagina`, `habilitado`) VALUES
(1, 'Trabajo parala cursada de proyecto', 'haciendo un camcio\r\n    \r\n    \r\n    \r\n    \r\n    \r\n    \r\n    \r\n    \r\n    \r\n    \r\n    \r\n   \r\n    ', 'sistemas@unlp.com', 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id`, `nombre`) VALUES
(1, 'tesina_destroy'),
(2, 'tesina_index'),
(3, 'tesina_show'),
(4, 'tesina_update'),
(5, 'tesina_new'),
(6, 'usuario_index'),
(7, 'usuario_new'),
(8, 'usuario_destroy'),
(9, 'usuario_update'),
(10, 'usuario_show'),
(11, 'usuario_bloquear'),
(12, 'configuracion'),
(13, 'tesina_rechazar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`) VALUES
(1, 'admin'),
(2, 'alumno'),
(3, 'administracion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_tiene_permiso`
--

CREATE TABLE `rol_tiene_permiso` (
  `rol_id` int(11) NOT NULL,
  `permiso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `rol_tiene_permiso`
--

INSERT INTO `rol_tiene_permiso` (`rol_id`, `permiso_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(2, 5),
(3, 4),
(3, 6),
(3, 8),
(3, 9),
(3, 11),
(3, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tesina`
--

CREATE TABLE `tesina` (
  `id_tesina` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `objetivos` varchar(255) NOT NULL,
  `motivacion` varchar(255) NOT NULL,
  `propuesta` varchar(255) NOT NULL,
  `resultados` varchar(255) NOT NULL,
  `clasificacion` varchar(255) NOT NULL,
  `meses` varchar(200) NOT NULL,
  `director` varchar(200) NOT NULL,
  `codirector` varchar(200) NOT NULL,
  `aprofesional` varchar(255) NOT NULL,
  `estado` varchar(200) NOT NULL,
  `motivo_rechazo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tesina`
--

INSERT INTO `tesina` (`id_tesina`, `titulo`, `objetivos`, `motivacion`, `propuesta`, `resultados`, `clasificacion`, `meses`, `director`, `codirector`, `aprofesional`, `estado`, `motivo_rechazo`) VALUES
(211, 'modificando', 'modificando', 'modificanco', 'modificando', 'modificando', 'InvestigaciÃ³n aplicada', '5', 'Pepe gomes', 'reoberto Gonazales', 'Contreras Julio', 'Propuesta Entregada', ''),
(212, 'lkjl', 'ljkkjlkl', 'lkjkljkl', 'jlkjlk', 'jlkjklj', 'select de InvestigaciÃ³n teÃ³rica', '1', 'lkjlk', 'jlkjlkj', 'lkjlkj', 'Propuesta Entregada', ''),
(213, 'lkjl', 'ljkkjlkl', 'lkjkljkl', 'jlkjlk', 'jlkjklj', 'select de InvestigaciÃ³n teÃ³rica', '1', 'lkjlk', 'jlkjlkj', 'lkjlkj', 'Propuesta Entregada', ''),
(214, 'lkjl', 'ljkkjlkl', 'lkjkljkl', 'jlkjlk', 'jlkjklj', 'select de InvestigaciÃ³n teÃ³rica', '1', 'lkjlk', 'jlkjlkj', 'lkjlkj', 'Propuesta Entregada', ''),
(215, 'lkjl', 'ljkkjlkl', 'lkjkljkl', 'jlkjlk', 'jlkjklj', 'select de InvestigaciÃ³n teÃ³rica', '1', 'lkjlk', 'jlkjlkj', 'lkjlkj', 'Propuesta Entregada', ''),
(216, 'lkjl', 'ljkkjlkl', 'lkjkljkl', 'jlkjlk', 'jlkjklj', 'select de InvestigaciÃ³n teÃ³rica', '1', 'lkjlk', 'jlkjlkj', 'lkjlkj', 'Propuesta Entregada', ''),
(217, 'lkjl', 'ljkkjlkl', 'lkjkljkl', 'jlkjlk', 'jlkjklj', 'select de InvestigaciÃ³n teÃ³rica', '1', 'lkjlk', 'jlkjlkj', 'lkjlkj', 'Propuesta Entregada', ''),
(218, 'mmmmm', 'mm', 'mmm', 'mmm', 'mmm', 'select de InvestigaciÃ³n teÃ³rica', '1', 'nnnn', 'nnn', 'nnn', 'Propuesta Entregada', ''),
(219, '987897', '9879879', '87987987', '987987', '9879879', 'select de InvestigaciÃ³n teÃ³rica', '1', '987987897', '9879879', '987987', 'Propuesta Entregada', ''),
(220, '987897', '9879879', '87987987', '987987', '9879879', 'select de InvestigaciÃ³n teÃ³rica', '1', '987987897', '9879879', '987987', 'Propuesta Entregada', ''),
(221, '987897', '9879879', '87987987', '987987', '9879879', 'select de InvestigaciÃ³n teÃ³rica', '1', '987987897', '9879879', '987987', 'Propuesta Entregada', ''),
(222, '987897', '9879879', '87987987', '987987', '9879879', 'select de InvestigaciÃ³n teÃ³rica', '1', '987987897', '9879879', '987987', 'Propuesta Entregada', ''),
(223, '987897', '9879879', '87987987', '987987', '9879879', 'select de InvestigaciÃ³n teÃ³rica', '1', '987987897', '9879879', '987987', 'Propuesta Entregada', ''),
(224, '987897', '9879879', '87987987', '987987', '9879879', 'select de InvestigaciÃ³n teÃ³rica', '1', '987987897', '9879879', '987987', 'Propuesta Entregada', ''),
(225, 'julio', 'julio', 'julio', 'julio', 'julio', 'select de InvestigaciÃ³n teÃ³rica', '1', 'julio', 'julio', 'julio', 'Propuesta Entregada', ''),
(226, 'julio', 'julio', 'julio', 'julio', 'julio', 'select de InvestigaciÃ³n teÃ³rica', '1', 'julio', 'julio', 'julio', 'Propuesta Entregada', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tesina_alumno`
--

CREATE TABLE `tesina_alumno` (
  `id_tesina` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `activado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tesina_alumno`
--

INSERT INTO `tesina_alumno` (`id_tesina`, `id_alumno`, `activado`) VALUES
(211, 90, 1),
(211, 90, 1),
(211, 90, 1),
(211, 90, 1),
(211, 90, 1),
(211, 90, 1),
(211, 90, 1),
(218, 91, 1),
(219, 91, 1),
(219, 91, 1),
(219, 91, 1),
(219, 91, 1),
(219, 91, 1),
(219, 91, 1),
(224, 90, 1),
(224, 101, 1),
(224, 102, 1),
(211, 101, 1),
(211, 102, 1),
(225, 94, 1),
(225, 94, 1),
(211, 94, 1),
(211, 101, 1),
(211, 102, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `username`, `password`, `activo`, `updated_at`, `created_at`, `first_name`, `last_name`) VALUES
(90, 'admin@gmail.com', 'admin', 'admin', 1, NULL, NULL, 'admin', 'admin'),
(91, 'administracion@gmail.com', 'administracion', '1', 0, NULL, NULL, 'administracion', 'administracion'),
(94, 'alumno@gmail.com', 'Alumno', '1', 0, NULL, NULL, 'alumno', 'alumno'),
(101, 'alumno1@gmail.com', 'Alumno1', '1', 0, NULL, NULL, 'alumno1', 'alumno1'),
(102, 'alumno2@gmail.com', 'alumno2', '1', 0, NULL, NULL, 'alumno2', 'alumno2'),
(103, 'julio.unlp2010@gmail.com', 'lkjklj', 'klklj', 0, NULL, NULL, 'Julio CÃ¨sar', 'Benitez'),
(104, 'g@gmail.com', 'jj', 'jjj', 0, NULL, NULL, 'jj', 'jjj');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_tiene_rol`
--

CREATE TABLE `usuario_tiene_rol` (
  `usuario_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario_tiene_rol`
--

INSERT INTO `usuario_tiene_rol` (`usuario_id`, `rol_id`) VALUES
(90, 1),
(91, 3),
(94, 2),
(101, 2),
(102, 2),
(104, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol_tiene_permiso`
--
ALTER TABLE `rol_tiene_permiso`
  ADD PRIMARY KEY (`rol_id`,`permiso_id`),
  ADD KEY `FK_permiso_id` (`permiso_id`);

--
-- Indices de la tabla `tesina`
--
ALTER TABLE `tesina`
  ADD PRIMARY KEY (`id_tesina`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `username` (`username`);

--
-- Indices de la tabla `usuario_tiene_rol`
--
ALTER TABLE `usuario_tiene_rol`
  ADD PRIMARY KEY (`usuario_id`,`rol_id`),
  ADD KEY `FK_rol_utp_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tesina`
--
ALTER TABLE `tesina`
  MODIFY `id_tesina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `rol_tiene_permiso`
--
ALTER TABLE `rol_tiene_permiso`
  ADD CONSTRAINT `FK_permiso_id` FOREIGN KEY (`permiso_id`) REFERENCES `permiso` (`id`),
  ADD CONSTRAINT `FK_rol_id` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`);

--
-- Filtros para la tabla `usuario_tiene_rol`
--
ALTER TABLE `usuario_tiene_rol`
  ADD CONSTRAINT `FK_rol_utp_id` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`),
  ADD CONSTRAINT `FK_usuario_utp_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
