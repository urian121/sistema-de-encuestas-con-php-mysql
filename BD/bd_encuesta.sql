-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 03-09-2023 a las 03:20:44
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
-- Base de datos: `bd_encuesta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_encuestas`
--

CREATE TABLE `tbl_encuestas` (
  `id` int(11) UNSIGNED NOT NULL,
  `code_encuesta` varchar(100) DEFAULT NULL,
  `titulo_encuesta` varchar(250) NOT NULL DEFAULT '',
  `tipo_encuesta` varchar(80) DEFAULT NULL,
  `solicitar_nombre_participante` int(11) DEFAULT 0,
  `permitir_comentarios` int(11) DEFAULT 0,
  `visibilidad_resultados` varchar(100) DEFAULT NULL,
  `duplicados_de_voz` varchar(60) DEFAULT NULL,
  `fecha_finalizacion` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_encuestas`
--

INSERT INTO `tbl_encuestas` (`id`, `code_encuesta`, `titulo_encuesta`, `tipo_encuesta`, `solicitar_nombre_participante`, `permitir_comentarios`, `visibilidad_resultados`, `duplicados_de_voz`, `fecha_finalizacion`, `created_at`) VALUES
(1, 'eddUA0gVcXICA4LzF1OI', 'Te gusta html?', 'Encuesta de imagen', 1, 1, 'Siempre publico', 'Direccion IP', '2023-09-30 20:23:00', '2023-09-02 20:23:54'),
(2, 'hixjjmOLlAnsHQ7agNCm', 'Te gustaphp?', 'Seleccion multiple', 1, 1, 'Siempre publico', 'Direccion IP', '2023-09-16 20:29:00', '2023-09-02 20:26:11'),
(3, 'IKGFe8rkIz8YquReAxxy', 'Te gusta Nodejs?', 'Encuesta de imagen', 1, 1, 'Siempre publico', 'Direccion IP', '2023-09-23 20:27:00', '2023-09-02 20:28:02'),
(4, 'qn9kF96PK4ujTOLJXZVO', 'Te gusta css?', 'Seleccion multiple', 0, 0, 'Siempre publico', 'Direccion IP', '2023-09-09 21:57:00', '2023-09-02 21:57:54'),
(5, 'ar9vdOdUSqH45ttCHQxL', 'Te gusta HTML?', 'Seleccion multiple', 1, 0, 'Siempre publico', 'Direccion IP', '2023-10-27 23:42:00', '2023-09-02 23:42:20'),
(6, 'yNPQLDdwtP7vabhFlu2B', 'Te gusta python?', 'Seleccion multiple', 0, 1, 'Siempre publico', 'Direccion IP', '2023-09-09 23:43:00', '2023-09-02 23:43:47'),
(7, '8tcR2waanJEqsuBEX50m', 'T like?', 'Seleccion multiple', 0, 0, 'Siempre publico', 'Direccion IP', '2023-09-24 01:04:00', '2023-09-03 01:04:49'),
(8, 'c2lxZ6p9p5nRpYS2hbFk', 'Asasa', 'Encuesta de imagen', 0, 0, 'Siempre publico', 'Direccion IP', '2023-09-16 01:06:00', '2023-09-03 01:06:14'),
(9, 'YFbiMHOMPFVuD6o7sTfj', 'Cual candidato a Gobernación prefieres?', 'Encuesta de imagen', 0, 0, 'Siempre publico', 'Direccion IP', '2023-09-30 07:09:00', '2023-09-03 01:09:35'),
(10, 'ySZAshAVbEYWo46BnncI', 'Dsd', 'Seleccion multiple', 1, 0, 'Siempre publico', 'Direccion IP', '2023-09-08 01:11:00', '2023-09-03 01:11:28'),
(11, 'SvEA68hrTMv8FTwBRIT5', 'Rtyrty', 'Seleccion multiple', 0, 1, 'Siempre publico', 'Direccion IP', '2023-09-16 01:11:00', '2023-09-03 01:12:03'),
(12, 't8fNUWyC4BK3MLTxS3II', '6456', 'Seleccion multiple', 0, 0, 'Siempre publico', 'Direccion IP', '2023-09-10 01:18:00', '2023-09-03 01:19:10'),
(13, '0V7bv1Ng7HEFWhyrMmVZ', 'Trtert', 'Seleccion multiple', 0, 0, 'Siempre publico', 'Direccion IP', '2023-09-23 01:19:00', '2023-09-03 01:19:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_opciones_encuesta`
--

CREATE TABLE `tbl_opciones_encuesta` (
  `id_pregunta` int(11) UNSIGNED NOT NULL,
  `code_encuesta` varchar(100) DEFAULT NULL,
  `opcion_encuesta` mediumtext DEFAULT NULL,
  `imagen_encuesta` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_opciones_encuesta`
--

INSERT INTO `tbl_opciones_encuesta` (`id_pregunta`, `code_encuesta`, `opcion_encuesta`, `imagen_encuesta`) VALUES
(1, 'eddUA0gVcXICA4LzF1OI', 'Si', '64f399da3bc31.jpg'),
(2, 'eddUA0gVcXICA4LzF1OI', 'No', '64f399da3c19d.png'),
(3, 'eddUA0gVcXICA4LzF1OI', 'No se que es', '64f399da3c3f3.png'),
(4, 'hixjjmOLlAnsHQ7agNCm', 'Si', NULL),
(5, 'hixjjmOLlAnsHQ7agNCm', 'No', NULL),
(6, 'hixjjmOLlAnsHQ7agNCm', 'Tal ez', NULL),
(7, 'hixjjmOLlAnsHQ7agNCm', 'No lo conozco', NULL),
(8, 'IKGFe8rkIz8YquReAxxy', 'Si', '64f39ad2ea364.png'),
(9, 'IKGFe8rkIz8YquReAxxy', 'No', '64f39ad2ea7d8.jpg'),
(10, 'IKGFe8rkIz8YquReAxxy', 'No lo conozco', '64f39ad2eaa69.png'),
(11, 'qn9kF96PK4ujTOLJXZVO', 'Si', NULL),
(12, 'qn9kF96PK4ujTOLJXZVO', 'No', NULL),
(13, 'ar9vdOdUSqH45ttCHQxL', 'Si', NULL),
(14, 'ar9vdOdUSqH45ttCHQxL', 'No', NULL),
(15, 'yNPQLDdwtP7vabhFlu2B', 'Si', NULL),
(16, 'yNPQLDdwtP7vabhFlu2B', 'No', NULL),
(17, '8tcR2waanJEqsuBEX50m', 'Si', NULL),
(18, '8tcR2waanJEqsuBEX50m', 'No', NULL),
(19, '8tcR2waanJEqsuBEX50m', 'Sss', NULL),
(20, 'c2lxZ6p9p5nRpYS2hbFk', 'S', '64f3dc06ce768.png'),
(21, 'c2lxZ6p9p5nRpYS2hbFk', 'N', '64f3dc06cecf3.png'),
(22, 'YFbiMHOMPFVuD6o7sTfj', 'Aberto', '64f3dccfd4fc5.jpeg'),
(23, 'YFbiMHOMPFVuD6o7sTfj', 'Andrea', '64f3dccfd55c7.jpg'),
(24, 'YFbiMHOMPFVuD6o7sTfj', 'Jorge', '64f3dccfd5773.jpeg'),
(25, 'YFbiMHOMPFVuD6o7sTfj', 'Chevez', '64f3dccfd58fb.png'),
(26, 'ySZAshAVbEYWo46BnncI', 'Dsd', NULL),
(27, 'ySZAshAVbEYWo46BnncI', 'Sd', NULL),
(28, 'SvEA68hrTMv8FTwBRIT5', 'Rty', NULL),
(29, 'SvEA68hrTMv8FTwBRIT5', 'Tyr', NULL),
(30, 't8fNUWyC4BK3MLTxS3II', '5645', NULL),
(31, 't8fNUWyC4BK3MLTxS3II', '546', NULL),
(32, '0V7bv1Ng7HEFWhyrMmVZ', 'Ert', NULL),
(33, '0V7bv1Ng7HEFWhyrMmVZ', 'Ert', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_respuestas_encuestas`
--

CREATE TABLE `tbl_respuestas_encuestas` (
  `id` int(11) UNSIGNED NOT NULL,
  `code_encuesta` varchar(100) DEFAULT NULL,
  `respuesta_encuesta` mediumtext DEFAULT NULL,
  `nombre_votante` varchar(100) DEFAULT NULL,
  `comentario_encuesta` mediumtext DEFAULT NULL,
  `ip_votacion` varchar(20) DEFAULT NULL,
  `created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_respuestas_encuestas`
--

INSERT INTO `tbl_respuestas_encuestas` (`id`, `code_encuesta`, `respuesta_encuesta`, `nombre_votante`, `comentario_encuesta`, `ip_votacion`, `created`) VALUES
(1, '8tcR2waanJEqsuBEX50m', 'Sss', '', '', '186.155.161.59', '2023-09-03 01:05:26'),
(2, 'YFbiMHOMPFVuD6o7sTfj', 'Andrea', '', '', '186.155.161.59', '2023-09-03 01:11:02'),
(3, 'ySZAshAVbEYWo46BnncI', 'Dsd', 'Joseee', '', '186.155.161.59', '2023-09-03 01:11:44'),
(4, 'SvEA68hrTMv8FTwBRIT5', 'Tyr', 'Ytrytry', '', '186.155.161.59', '2023-09-03 01:13:03'),
(5, '0V7bv1Ng7HEFWhyrMmVZ', 'Ert', '', '', '186.155.161.59', '2023-09-03 01:19:36');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_encuestas`
--
ALTER TABLE `tbl_encuestas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_opciones_encuesta`
--
ALTER TABLE `tbl_opciones_encuesta`
  ADD PRIMARY KEY (`id_pregunta`);

--
-- Indices de la tabla `tbl_respuestas_encuestas`
--
ALTER TABLE `tbl_respuestas_encuestas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_encuestas`
--
ALTER TABLE `tbl_encuestas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tbl_opciones_encuesta`
--
ALTER TABLE `tbl_opciones_encuesta`
  MODIFY `id_pregunta` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `tbl_respuestas_encuestas`
--
ALTER TABLE `tbl_respuestas_encuestas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
