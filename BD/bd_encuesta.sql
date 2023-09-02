-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 02-09-2023 a las 23:16:26
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
(3, 'IKGFe8rkIz8YquReAxxy', 'Te gusta Nodejs?', 'Encuesta de imagen', 1, 1, 'Siempre publico', 'Direccion IP', '2023-09-23 20:27:00', '2023-09-02 20:28:02');

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
(10, 'IKGFe8rkIz8YquReAxxy', 'No lo conozco', '64f39ad2eaa69.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_respuestas_encuestas`
--

CREATE TABLE `tbl_respuestas_encuestas` (
  `id` int(11) UNSIGNED NOT NULL,
  `code_encuesta` varchar(100) DEFAULT NULL,
  `respuesta_encuesta` mediumtext DEFAULT NULL,
  `ip_votacion` varchar(20) DEFAULT NULL,
  `created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_respuestas_encuestas`
--

INSERT INTO `tbl_respuestas_encuestas` (`id`, `code_encuesta`, `respuesta_encuesta`, `ip_votacion`, `created`) VALUES
(1, 'IKGFe8rkIz8YquReAxxy', 'No lo conozco', '186.155.161.59', '2023-09-02 21:14:26');

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_opciones_encuesta`
--
ALTER TABLE `tbl_opciones_encuesta`
  MODIFY `id_pregunta` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tbl_respuestas_encuestas`
--
ALTER TABLE `tbl_respuestas_encuestas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
