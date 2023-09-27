# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.4.28-MariaDB)
# Base de datos: bd_encuesta
# Tiempo de Generación: 2023-09-27 02:16:35 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla tbl_comentarios_encuesta
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_comentarios_encuesta`;

CREATE TABLE `tbl_comentarios_encuesta` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code_encuesta_comentario` varchar(50) DEFAULT NULL,
  `nombre_votante_comentario` varchar(200) DEFAULT NULL,
  `comentario_encuesta` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Volcado de tabla tbl_encuestas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_encuestas`;

CREATE TABLE `tbl_encuestas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code_encuesta` varchar(100) DEFAULT NULL,
  `titulo_encuesta` varchar(250) NOT NULL DEFAULT '',
  `tipo_encuesta` varchar(80) DEFAULT NULL,
  `solicitar_nombre_participante` int(11) DEFAULT 0,
  `permitir_comentarios` int(11) DEFAULT 0,
  `visibilidad_resultados` varchar(100) DEFAULT NULL,
  `duplicados_de_voz` varchar(60) DEFAULT NULL,
  `seguridad_cookies` int(11) DEFAULT 0,
  `seguridad_user_agents` int(11) DEFAULT 0,
  `validar_vpn` int(11) DEFAULT 0,
  `fecha_finalizacion` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `tbl_encuestas` WRITE;
/*!40000 ALTER TABLE `tbl_encuestas` DISABLE KEYS */;

INSERT INTO `tbl_encuestas` (`id`, `code_encuesta`, `titulo_encuesta`, `tipo_encuesta`, `solicitar_nombre_participante`, `permitir_comentarios`, `visibilidad_resultados`, `duplicados_de_voz`, `seguridad_cookies`, `seguridad_user_agents`, `validar_vpn`, `fecha_finalizacion`, `created_at`)
VALUES
	(1,'UZeV9AS71Avsrau4kuG3','Te gusta Python?','Seleccion multiple',0,0,'Siempre publico','Direccion IP',1,1,1,'2023-09-24 10:10:00','2023-09-22 22:20:21'),
	(2,'hnc7JEtNyExlmlxRFhnh','Rewrwe','Seleccion multiple',0,0,'Siempre publico','Direccion IP',1,1,1,'2023-09-28 09:09:00','2023-09-22 22:25:30'),
	(3,'Ja30fPgQLlFIgMt72yoM','Jose','Seleccion multiple',0,0,'Siempre publico','Direccion IP',1,1,1,'2023-09-22 10:10:00','2023-09-22 22:36:31'),
	(4,'IveY03teDuyni0oNm4mX','Html','Seleccion multiple',0,0,'Siempre publico','Direccion IP',1,1,1,'2023-09-23 10:10:00','2023-09-22 22:38:37'),
	(5,'iu2eBT1lwTtFU1o1MXpA','Prueba','Seleccion multiple',0,0,'Siempre publico','Direccion IP',1,1,1,'2023-09-28 10:10:00','2023-09-26 19:01:04'),
	(6,'LBgT7TDRSdLf2ZAfQAa6','Te gusta la Mac?','Seleccion multiple',0,0,'Siempre publico','Direccion IP',1,1,1,'2023-09-28 10:10:00','2023-09-26 20:35:00');

/*!40000 ALTER TABLE `tbl_encuestas` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla tbl_opciones_encuesta
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_opciones_encuesta`;

CREATE TABLE `tbl_opciones_encuesta` (
  `id_pregunta` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code_encuesta` varchar(100) DEFAULT NULL,
  `opcion_encuesta` mediumtext DEFAULT NULL,
  `imagen_encuesta` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_pregunta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `tbl_opciones_encuesta` WRITE;
/*!40000 ALTER TABLE `tbl_opciones_encuesta` DISABLE KEYS */;

INSERT INTO `tbl_opciones_encuesta` (`id_pregunta`, `code_encuesta`, `opcion_encuesta`, `imagen_encuesta`)
VALUES
	(1,'UZeV9AS71Avsrau4kuG3','Si',NULL),
	(2,'UZeV9AS71Avsrau4kuG3','No',NULL),
	(3,'hnc7JEtNyExlmlxRFhnh','Rewr',NULL),
	(4,'hnc7JEtNyExlmlxRFhnh','Rwer',NULL),
	(5,'Ja30fPgQLlFIgMt72yoM','Si',NULL),
	(6,'Ja30fPgQLlFIgMt72yoM','No',NULL),
	(7,'IveY03teDuyni0oNm4mX','Si',NULL),
	(8,'IveY03teDuyni0oNm4mX','No',NULL),
	(9,'iu2eBT1lwTtFU1o1MXpA','Si',NULL),
	(10,'iu2eBT1lwTtFU1o1MXpA','No',NULL),
	(11,'LBgT7TDRSdLf2ZAfQAa6','Si',NULL),
	(12,'LBgT7TDRSdLf2ZAfQAa6','No',NULL);

/*!40000 ALTER TABLE `tbl_opciones_encuesta` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla tbl_respuestas_encuestas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_respuestas_encuestas`;

CREATE TABLE `tbl_respuestas_encuestas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code_encuesta` varchar(100) DEFAULT NULL,
  `respuesta_encuesta` mediumtext DEFAULT NULL,
  `nombre_votante` varchar(100) DEFAULT NULL,
  `ip_votacion` varchar(20) DEFAULT NULL,
  `user_agent` mediumtext DEFAULT NULL,
  `created` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `tbl_respuestas_encuestas` WRITE;
/*!40000 ALTER TABLE `tbl_respuestas_encuestas` DISABLE KEYS */;

INSERT INTO `tbl_respuestas_encuestas` (`id`, `code_encuesta`, `respuesta_encuesta`, `nombre_votante`, `ip_votacion`, `user_agent`, `created`)
VALUES
	(1,'LBgT7TDRSdLf2ZAfQAa6','Si','','186.155.161.59','mozilla/5.0 (macintosh; intel mac os x 10.15; rv:109.0) gecko/20100101 firefox/118.0','2023-09-26 21:16:00');

/*!40000 ALTER TABLE `tbl_respuestas_encuestas` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
