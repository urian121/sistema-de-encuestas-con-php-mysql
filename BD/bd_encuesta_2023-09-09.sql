# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.4.28-MariaDB)
# Base de datos: bd_encuesta
# Tiempo de Generación: 2023-09-10 03:46:08 +0000
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

LOCK TABLES `tbl_comentarios_encuesta` WRITE;
/*!40000 ALTER TABLE `tbl_comentarios_encuesta` DISABLE KEYS */;

INSERT INTO `tbl_comentarios_encuesta` (`id`, `code_encuesta_comentario`, `nombre_votante_comentario`, `comentario_encuesta`, `created_at`)
VALUES
	(1,'79sI1BStUNzjOZQdlqo2','7657','6767yuytuytu','2023-09-03 09:04:32'),
	(2,'79sI1BStUNzjOZQdlqo2','Uriany Viera','Lorem ipsum es el texto que se usa habitualmente en diseño gráfico en demostraciones de tipografías o de borradores de diseño para probar el diseño visual antes de insertar el texto final.','2023-09-03 09:34:08'),
	(3,'79sI1BStUNzjOZQdlqo2','Oascar','Lorem ipsum es el texto que se usa habitualmente en diseño gráfico en demostraciones de tipografías o de borradores de diseño para probar el diseño visual antes de insertar el texto final.','2023-09-03 09:34:19'),
	(4,'79sI1BStUNzjOZQdlqo2','Luis Host','Lorem ipsum es el texto que se usa habitualmente en diseño gráfico en demostraciones de tipografías o de borradores de diseño para probar el diseño visual antes de insertar el texto final.','2023-09-03 09:34:32'),
	(5,'79sI1BStUNzjOZQdlqo2','Holaaa','ser','2023-09-03 09:43:16'),
	(6,'79sI1BStUNzjOZQdlqo2','8768678','bghfghfghgfh','2023-09-03 09:44:32'),
	(7,'79sI1BStUNzjOZQdlqo2','456','456456','2023-09-03 09:44:40'),
	(8,'79sI1BStUNzjOZQdlqo2','Tyrty','tyrty','2023-09-03 09:45:55'),
	(9,'79sI1BStUNzjOZQdlqo2','657657','ytutyu','2023-09-03 09:46:14'),
	(10,'79sI1BStUNzjOZQdlqo2','5464','56456','2023-09-03 09:47:35'),
	(11,'79sI1BStUNzjOZQdlqo2','Ogfdgd','fdgdf','2023-09-03 09:52:22'),
	(12,'79sI1BStUNzjOZQdlqo2','Oscar Urriola','Todos estos candidatos no sirve para un coño e la madre ?.','2023-09-03 09:55:00'),
	(13,'79sI1BStUNzjOZQdlqo2','Full Stack Urian Viera','Soy el desarrollador de esta hermosa plataforma ?.','2023-09-03 09:55:43'),
	(14,'79sI1BStUNzjOZQdlqo2','Uriany','hola atodos','2023-09-03 10:03:50'),
	(15,'79sI1BStUNzjOZQdlqo2','Alejandro Torres','Hola a todos jajajajaj ?.','2023-09-03 10:06:11'),
	(16,'lsuzlQt0jcyeggKYK31d','Tetr','ret','2023-09-04 20:12:03'),
	(17,'lsuzlQt0jcyeggKYK31d','456456','6546','2023-09-04 20:12:47'),
	(18,'lsuzlQt0jcyeggKYK31d','Urian jose','LOréal es una empresa francesa de cosméticos y belleza, creada en 1909 por el químico Eugene Schueller. Con sede en Clichy, ​ es la compañía de cosméticos más grande del mundo, y cuenta con una sede social en París','2023-09-04 20:13:44');

/*!40000 ALTER TABLE `tbl_comentarios_encuesta` ENABLE KEYS */;
UNLOCK TABLES;


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
	(1,'eddUA0gVcXICA4LzF1OI','Te gusta html?','Encuesta de imagen',1,1,'Siempre publico','Direccion IP',NULL,NULL,NULL,'2023-09-30 15:23:00','2023-09-02 15:23:54'),
	(2,'hixjjmOLlAnsHQ7agNCm','Te gustaphp?','Seleccion multiple',1,1,'Siempre publico','Direccion IP',NULL,NULL,NULL,'2023-09-16 15:29:00','2023-09-02 15:26:11'),
	(3,'IKGFe8rkIz8YquReAxxy','Te gusta Nodejs?','Encuesta de imagen',1,1,'Siempre publico','Direccion IP',NULL,NULL,NULL,'2023-09-23 15:27:00','2023-09-02 15:28:02'),
	(4,'qn9kF96PK4ujTOLJXZVO','Te gusta css?','Seleccion multiple',0,0,'Siempre publico','Direccion IP',NULL,NULL,NULL,'2023-09-09 16:57:00','2023-09-02 16:57:54'),
	(5,'ar9vdOdUSqH45ttCHQxL','Te gusta HTML?','Seleccion multiple',1,0,'Siempre publico','Direccion IP',NULL,NULL,NULL,'2023-10-27 18:42:00','2023-09-02 18:42:20'),
	(6,'yNPQLDdwtP7vabhFlu2B','Te gusta python?','Seleccion multiple',0,1,'Siempre publico','Direccion IP',NULL,NULL,NULL,'2023-09-09 18:43:00','2023-09-02 18:43:47'),
	(7,'8tcR2waanJEqsuBEX50m','T like?','Seleccion multiple',0,0,'Siempre publico','Direccion IP',NULL,NULL,NULL,'2023-09-23 20:04:00','2023-09-02 20:04:49'),
	(8,'c2lxZ6p9p5nRpYS2hbFk','Asasa','Encuesta de imagen',0,0,'Siempre publico','Direccion IP',NULL,NULL,NULL,'2023-09-15 20:06:00','2023-09-02 20:06:14'),
	(9,'YFbiMHOMPFVuD6o7sTfj','Cual candidato a Gobernación prefieres?','Encuesta de imagen',0,0,'Siempre publico','Direccion IP',NULL,NULL,NULL,'2023-09-30 02:09:00','2023-09-02 20:09:35'),
	(10,'ySZAshAVbEYWo46BnncI','Dsd','Seleccion multiple',1,0,'Siempre publico','Direccion IP',NULL,NULL,NULL,'2023-09-07 20:11:00','2023-09-02 20:11:28'),
	(11,'SvEA68hrTMv8FTwBRIT5','Rtyrty','Seleccion multiple',0,1,'Siempre publico','Direccion IP',NULL,NULL,NULL,'2023-09-15 20:11:00','2023-09-02 20:12:03'),
	(12,'t8fNUWyC4BK3MLTxS3II','6456','Seleccion multiple',0,0,'Siempre publico','Direccion IP',NULL,NULL,NULL,'2023-09-09 20:18:00','2023-09-02 20:19:10'),
	(13,'0V7bv1Ng7HEFWhyrMmVZ','Trtert','Seleccion multiple',0,0,'Siempre publico','Direccion IP',NULL,NULL,NULL,'2023-09-22 20:19:00','2023-09-02 20:19:32'),
	(14,'R4astAJVCmDHudmZALTO','Tretret','Encuesta de imagen',0,0,'Siempre publico','Direccion IP',NULL,NULL,NULL,'2023-09-23 20:22:00','2023-09-02 20:22:43'),
	(15,'0HGTCBCYbmfMxK0Iaj5Z','Te gusta html?','Seleccion multiple',0,0,'Siempre publico','Direccion IP',NULL,NULL,NULL,'2023-09-05 20:40:00','2023-09-02 20:40:33'),
	(16,'uqtyVafXvy5lNsU7zeFD','Te gusta Youtube?','Encuesta de imagen',1,0,'Siempre publico','Direccion IP',NULL,NULL,NULL,'2023-09-03 22:44:00','2023-09-02 20:42:53'),
	(17,'XJCbwF5fAsfIgyZ4749o','T gusta nodejs?','Encuesta de imagen',0,1,'Siempre publico','Direccion IP',NULL,NULL,NULL,'2023-09-29 20:51:00','2023-09-02 20:51:19'),
	(18,'79sI1BStUNzjOZQdlqo2','Te gusta Youtube?','Encuesta de imagen',0,1,'Siempre publico','Direccion IP',NULL,NULL,NULL,'2023-09-14 21:16:00','2023-09-02 21:16:54'),
	(19,'AzSqpnK45Qxd7v3GdRlT','6546645','Seleccion multiple',1,0,'Siempre publico','Direccion IP',NULL,NULL,NULL,'2023-09-19 22:14:00','2023-09-04 19:11:19'),
	(20,'5sPZ158pIEYtuzZLyAG3','66','Encuesta de imagen',0,0,'Siempre publico','Direccion IP',NULL,NULL,NULL,'2023-09-22 20:09:00','2023-09-04 20:09:55'),
	(21,'2fjhPKvrdK0vqymS4BfG','5tter','Seleccion multiple',1,0,'Siempre publico','Direccion IP',NULL,NULL,NULL,'2023-09-29 01:11:00','2023-09-04 20:11:13'),
	(22,'lsuzlQt0jcyeggKYK31d','Yrtytry','Seleccion multiple',0,1,'Siempre publico','Direccion IP',NULL,NULL,NULL,'2023-09-21 20:11:00','2023-09-04 20:11:50'),
	(23,'WPJvumMAshGnvvS7VImd','Cual candidato te gusta mas?','Encuesta de imagen',0,0,'Siempre publico','Direccion IP',NULL,NULL,NULL,'2023-09-29 01:38:00','2023-09-04 20:38:21'),
	(24,'17bzKoEtSoos74BCpg8S','Te gusta React?','Seleccion multiple',0,0,'Siempre publico','Direccion IP',NULL,NULL,NULL,'2023-09-15 06:53:00','2023-09-09 17:51:08'),
	(25,'NYPZ3bnTbfBLIxBJFTp8','Treter','Seleccion multiple',0,0,'Siempre publico','Direccion IP',NULL,NULL,NULL,'2023-09-13 10:10:00','2023-09-09 18:15:13'),
	(26,'fFBgBM6AdnwHxaey09nF','Hola','Seleccion multiple',0,0,'Siempre publico','Direccion IP',0,0,1,'2023-09-15 23:08:00','2023-09-09 20:05:29'),
	(27,'UB4C0j2ZZbjFMvPMBOJi','Te gusta html?','Seleccion multiple',0,0,'Siempre publico','Direccion IP',1,0,0,'2023-09-06 10:12:00','2023-09-09 20:15:19'),
	(28,'yMCLtymJN482rQDl3cem','Hola','Seleccion multiple',0,0,'Siempre publico','Direccion IP',0,1,0,'2023-09-28 12:10:00','2023-09-09 21:58:07');

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
	(1,'eddUA0gVcXICA4LzF1OI','Si','64f399da3bc31.jpg'),
	(2,'eddUA0gVcXICA4LzF1OI','No','64f399da3c19d.png'),
	(3,'eddUA0gVcXICA4LzF1OI','No se que es','64f399da3c3f3.png'),
	(4,'hixjjmOLlAnsHQ7agNCm','Si',NULL),
	(5,'hixjjmOLlAnsHQ7agNCm','No',NULL),
	(6,'hixjjmOLlAnsHQ7agNCm','Tal ez',NULL),
	(7,'hixjjmOLlAnsHQ7agNCm','No lo conozco',NULL),
	(8,'IKGFe8rkIz8YquReAxxy','Si','64f39ad2ea364.png'),
	(9,'IKGFe8rkIz8YquReAxxy','No','64f39ad2ea7d8.jpg'),
	(10,'IKGFe8rkIz8YquReAxxy','No lo conozco','64f39ad2eaa69.png'),
	(11,'qn9kF96PK4ujTOLJXZVO','Si',NULL),
	(12,'qn9kF96PK4ujTOLJXZVO','No',NULL),
	(13,'ar9vdOdUSqH45ttCHQxL','Si',NULL),
	(14,'ar9vdOdUSqH45ttCHQxL','No',NULL),
	(15,'yNPQLDdwtP7vabhFlu2B','Si',NULL),
	(16,'yNPQLDdwtP7vabhFlu2B','No',NULL),
	(17,'8tcR2waanJEqsuBEX50m','Si',NULL),
	(18,'8tcR2waanJEqsuBEX50m','No',NULL),
	(19,'8tcR2waanJEqsuBEX50m','Sss',NULL),
	(20,'c2lxZ6p9p5nRpYS2hbFk','S','64f3dc06ce768.png'),
	(21,'c2lxZ6p9p5nRpYS2hbFk','N','64f3dc06cecf3.png'),
	(22,'YFbiMHOMPFVuD6o7sTfj','Aberto','64f3dccfd4fc5.jpeg'),
	(23,'YFbiMHOMPFVuD6o7sTfj','Andrea','64f3dccfd55c7.jpg'),
	(24,'YFbiMHOMPFVuD6o7sTfj','Jorge','64f3dccfd5773.jpeg'),
	(25,'YFbiMHOMPFVuD6o7sTfj','Chevez','64f3dccfd58fb.png'),
	(26,'ySZAshAVbEYWo46BnncI','Dsd',NULL),
	(27,'ySZAshAVbEYWo46BnncI','Sd',NULL),
	(28,'SvEA68hrTMv8FTwBRIT5','Rty',NULL),
	(29,'SvEA68hrTMv8FTwBRIT5','Tyr',NULL),
	(30,'t8fNUWyC4BK3MLTxS3II','5645',NULL),
	(31,'t8fNUWyC4BK3MLTxS3II','546',NULL),
	(32,'0V7bv1Ng7HEFWhyrMmVZ','Ert',NULL),
	(33,'0V7bv1Ng7HEFWhyrMmVZ','Ert',NULL),
	(34,'R4astAJVCmDHudmZALTO','R','64f3dfe3626a0.jpeg'),
	(35,'R4astAJVCmDHudmZALTO','N','64f3dfe362935.jpg'),
	(36,'0HGTCBCYbmfMxK0Iaj5Z','Si',NULL),
	(37,'0HGTCBCYbmfMxK0Iaj5Z','No',NULL),
	(38,'0HGTCBCYbmfMxK0Iaj5Z','No lo conozco',NULL),
	(39,'uqtyVafXvy5lNsU7zeFD','Any','64f3e49d7fcc2.jpg'),
	(40,'uqtyVafXvy5lNsU7zeFD','Jose','64f3e49d80427.jpeg'),
	(41,'uqtyVafXvy5lNsU7zeFD','Victor','64f3e49d809b4.jpeg'),
	(42,'XJCbwF5fAsfIgyZ4749o','Si','64f3e697182a2.jpeg'),
	(43,'XJCbwF5fAsfIgyZ4749o','No','64f3e69718567.jpeg'),
	(44,'79sI1BStUNzjOZQdlqo2','Evelyn Fernandez Circ 1 PRM','64f3ec9612077.jpeg'),
	(45,'79sI1BStUNzjOZQdlqo2','Derik Baez Circ 1 PRM','64f3ec961239e.jpg'),
	(46,'AzSqpnK45Qxd7v3GdRlT','6456',NULL),
	(47,'AzSqpnK45Qxd7v3GdRlT','654',NULL),
	(48,'5sPZ158pIEYtuzZLyAG3','E','64f67fe374c5c.jpg'),
	(49,'5sPZ158pIEYtuzZLyAG3','T','64f67fe3752c4.jpeg'),
	(50,'2fjhPKvrdK0vqymS4BfG','Tr',NULL),
	(51,'2fjhPKvrdK0vqymS4BfG','Tyr',NULL),
	(52,'lsuzlQt0jcyeggKYK31d','Yrty',NULL),
	(53,'lsuzlQt0jcyeggKYK31d','Tt',NULL),
	(54,'WPJvumMAshGnvvS7VImd','Diego Host','64f6868d0b3e5.jpeg'),
	(55,'WPJvumMAshGnvvS7VImd','Fernado Torres','64f6868d0b7ae.jpeg'),
	(56,'17bzKoEtSoos74BCpg8S','Si',NULL),
	(57,'17bzKoEtSoos74BCpg8S','No',NULL),
	(58,'NYPZ3bnTbfBLIxBJFTp8','Trettre',NULL),
	(59,'NYPZ3bnTbfBLIxBJFTp8','Tretret',NULL),
	(60,'fFBgBM6AdnwHxaey09nF','78',NULL),
	(61,'fFBgBM6AdnwHxaey09nF','8',NULL),
	(62,'UB4C0j2ZZbjFMvPMBOJi','Si',NULL),
	(63,'UB4C0j2ZZbjFMvPMBOJi','No',NULL),
	(64,'yMCLtymJN482rQDl3cem','S',NULL),
	(65,'yMCLtymJN482rQDl3cem','N',NULL);

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
  `created` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `tbl_respuestas_encuestas` WRITE;
/*!40000 ALTER TABLE `tbl_respuestas_encuestas` DISABLE KEYS */;

INSERT INTO `tbl_respuestas_encuestas` (`id`, `code_encuesta`, `respuesta_encuesta`, `nombre_votante`, `ip_votacion`, `created`)
VALUES
	(1,'UB4C0j2ZZbjFMvPMBOJi','No','','186.155.161.59','2023-09-09 21:57:40'),
	(2,'yMCLtymJN482rQDl3cem','S','','186.155.161.59','2023-09-09 21:58:14');

/*!40000 ALTER TABLE `tbl_respuestas_encuestas` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
