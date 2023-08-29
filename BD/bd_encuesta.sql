-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 29-08-2023 a las 05:01:53
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
(1, '88GwtCvH24iTW1EzmZuy', 'TE GUSTA PHP?', 'Seleccion multiple', NULL, NULL, NULL, NULL, NULL, '2023-08-28 00:40:11'),
(2, 'MKxxQLseS0WZYRDfbsU0', 'Te guta x?', 'Seleccion multiple', NULL, NULL, NULL, NULL, NULL, '2023-08-28 00:58:18'),
(3, 'PgnuFMSr3QwK3J0uNsEA', 'Encuesta x', 'Seleccion multiple', 0, 0, 'Siempre publico', NULL, NULL, '2023-08-29 00:28:48'),
(4, 'xlthAY1vOpzsY0ap1mm4', 'Encuesta6', 'Seleccion multiple', 1, 1, 'Siempre publico', NULL, NULL, '2023-08-29 01:15:16'),
(5, 'nYN9huZJ8gPWFrcjSps2', 'Treter', 'Seleccion multiple', 0, 1, 'Siempre publico', NULL, NULL, '2023-08-29 01:18:41'),
(6, '2R2Z1JMReGBlZWIur5AU', 'Hola', 'Seleccion multiple', 1, 0, 'Siempre publico', 'ip', NULL, '2023-08-29 01:20:33'),
(7, 'SdwE9jCtH0OQx8ZfcOrd', '445', 'Seleccion multiple', 1, 1, 'Público después del plazo', 'Direccion IP', NULL, '2023-08-29 01:23:02'),
(8, 'EyMO08KHixWjECoPtvDZ', '6546', 'Seleccion multiple', 0, 1, 'Siempre publico', 'Direccion IP', NULL, '2023-08-29 01:25:46'),
(9, 'xh9y1rAQ8j3sQUUpMeS7', '545', 'Encuesta de imagen', 1, 0, 'Siempre publico', 'Direccion IP', NULL, '2023-08-29 01:31:06'),
(10, 'HaW3IzIxzQ8ZZHFjxA61', '545', 'Encuesta de imagen', 1, 0, 'Siempre publico', 'Direccion IP', NULL, '2023-08-29 01:33:54'),
(11, 'kf9MvywSiC7ehJDBhqN1', '545', 'Encuesta de imagen', 1, 0, 'Siempre publico', 'Direccion IP', NULL, '2023-08-29 01:33:57'),
(12, 'QvCYRMIrWGNkoKV3wuCW', 'Fd', 'Encuesta de imagen', 1, 0, 'Siempre publico', 'Direccion IP', NULL, '2023-08-29 01:34:29'),
(13, '4mK7i4qNweffdH6sIvUs', 'Sasas', 'Seleccion multiple', 0, 1, 'Siempre publico', 'Direccion IP', '2023-08-28 06:40:00', '2023-08-29 01:35:57'),
(14, 'ku5yaatzQ5Z6v2yCehkb', 'Encuestasx', 'Seleccion multiple', 0, 1, 'Siempre publico', 'Direccion IP', '2023-08-31 06:55:00', '2023-08-29 01:50:30'),
(15, 'Pt8YTC8gu1b6jEyrDuOr', 'Rerewre', 'Seleccion multiple', 0, 0, 'Siempre publico', 'Direccion IP', '2023-08-30 06:04:00', '2023-08-29 01:59:13'),
(16, 'L2LeHa4qpwFzFjF7Y6i5', 'Rewr', 'Seleccion multiple', 0, 0, 'Siempre publico', 'Direccion IP', '2023-08-31 07:09:00', '2023-08-29 02:06:34'),
(17, '9TqWYMU9PciCpwvLkJWH', '5345', 'Seleccion multiple', 1, 1, 'Siempre publico', 'Direccion IP', '2023-09-01 02:16:00', '2023-08-29 02:16:40'),
(18, 'y3DnvXqXMW6r6XtNq4vN', 'Te gusta php?', 'Seleccion multiple', 0, 0, 'Siempre publico', 'Direccion IP', '2023-08-31 06:25:00', '2023-08-29 02:22:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_opciones_encuesta`
--

CREATE TABLE `tbl_opciones_encuesta` (
  `id_pregunta` int(11) UNSIGNED NOT NULL,
  `code_encuesta` varchar(100) DEFAULT NULL,
  `opcion_encuesta` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_opciones_encuesta`
--

INSERT INTO `tbl_opciones_encuesta` (`id_pregunta`, `code_encuesta`, `opcion_encuesta`) VALUES
(1, '88GwtCvH24iTW1EzmZuy', 'si'),
(2, '88GwtCvH24iTW1EzmZuy', 'no'),
(3, '88GwtCvH24iTW1EzmZuy', 'tal vez'),
(4, 'MKxxQLseS0WZYRDfbsU0', 'No'),
(5, 'MKxxQLseS0WZYRDfbsU0', 'Si'),
(6, 'PgnuFMSr3QwK3J0uNsEA', 'Si'),
(7, 'PgnuFMSr3QwK3J0uNsEA', 'No'),
(8, 'xlthAY1vOpzsY0ap1mm4', 'SI'),
(9, 'xlthAY1vOpzsY0ap1mm4', 'NO'),
(10, 'nYN9huZJ8gPWFrcjSps2', 'R'),
(11, 'nYN9huZJ8gPWFrcjSps2', '6575'),
(12, '2R2Z1JMReGBlZWIur5AU', 'A'),
(13, '2R2Z1JMReGBlZWIur5AU', 'B'),
(14, 'SdwE9jCtH0OQx8ZfcOrd', '5'),
(15, 'SdwE9jCtH0OQx8ZfcOrd', '4'),
(16, 'EyMO08KHixWjECoPtvDZ', '546'),
(17, 'EyMO08KHixWjECoPtvDZ', '654'),
(18, 'xh9y1rAQ8j3sQUUpMeS7', '45'),
(19, 'xh9y1rAQ8j3sQUUpMeS7', '54'),
(20, 'HaW3IzIxzQ8ZZHFjxA61', '45'),
(21, 'HaW3IzIxzQ8ZZHFjxA61', '54'),
(22, 'kf9MvywSiC7ehJDBhqN1', '45'),
(23, 'kf9MvywSiC7ehJDBhqN1', '54'),
(24, 'QvCYRMIrWGNkoKV3wuCW', 'F'),
(25, 'QvCYRMIrWGNkoKV3wuCW', 'Fd'),
(26, '4mK7i4qNweffdH6sIvUs', 'S'),
(27, '4mK7i4qNweffdH6sIvUs', 'Df'),
(28, 'ku5yaatzQ5Z6v2yCehkb', 'Si'),
(29, 'ku5yaatzQ5Z6v2yCehkb', 'N'),
(30, 'Pt8YTC8gu1b6jEyrDuOr', 'Rerw'),
(31, 'Pt8YTC8gu1b6jEyrDuOr', 'E'),
(32, 'L2LeHa4qpwFzFjF7Y6i5', 'Er'),
(33, 'L2LeHa4qpwFzFjF7Y6i5', 'Rew'),
(34, '9TqWYMU9PciCpwvLkJWH', '5'),
(35, '9TqWYMU9PciCpwvLkJWH', '4'),
(36, 'y3DnvXqXMW6r6XtNq4vN', 'Si me gusta'),
(37, 'y3DnvXqXMW6r6XtNq4vN', 'No me gusta');

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
(1, '88GwtCvH24iTW1EzmZuy', 'no', '::1', '2023-08-28 00:41:52'),
(2, 'MKxxQLseS0WZYRDfbsU0', 'Si', '::1', '2023-08-28 00:59:28'),
(3, 'ku5yaatzQ5Z6v2yCehkb', 'N', '186.155.161.59', '2023-08-29 01:50:34'),
(4, '9TqWYMU9PciCpwvLkJWH', '4', '186.155.161.59', '2023-08-29 02:19:58');

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `tbl_opciones_encuesta`
--
ALTER TABLE `tbl_opciones_encuesta`
  MODIFY `id_pregunta` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `tbl_respuestas_encuestas`
--
ALTER TABLE `tbl_respuestas_encuestas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
