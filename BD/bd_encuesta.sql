-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 28-08-2023 a las 02:35:52
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
  `fecha_finalizacion` timestamp NULL DEFAULT NULL,
  `visibilidad_resultados` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_opciones_encuesta`
--

CREATE TABLE `tbl_opciones_encuesta` (
  `id_pregunta` int(11) UNSIGNED NOT NULL,
  `code_encuesta` varchar(100) DEFAULT NULL,
  `opcion_encuesta` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_opciones_encuesta`
--
ALTER TABLE `tbl_opciones_encuesta`
  MODIFY `id_pregunta` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_respuestas_encuestas`
--
ALTER TABLE `tbl_respuestas_encuestas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
