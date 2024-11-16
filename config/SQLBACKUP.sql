-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.22-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para db_digiturno
CREATE DATABASE IF NOT EXISTS `db_digiturno` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `db_digiturno`;

-- Volcando estructura para tabla db_digiturno.db_clientes
CREATE TABLE IF NOT EXISTS `db_clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `documento` varchar(50) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `pnombre` varchar(50) DEFAULT NULL,
  `snombre` varchar(50) DEFAULT NULL,
  `papellido` varchar(50) DEFAULT NULL,
  `sapellido` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` varchar(50) DEFAULT NULL,
  `sexo` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `numero` (`numero`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla db_digiturno.db_clientes: ~17 rows (aproximadamente)
INSERT INTO `db_clientes` (`id`, `documento`, `numero`, `pnombre`, `snombre`, `papellido`, `sapellido`, `fecha_nacimiento`, `sexo`, `estado`, `fecha_registro`) VALUES
	(1, 'CC', 123, 'ANDRES', 'DAVID', 'AGUILAR', 'REALES', '2020-05-03', 'F', 'A', '2021-01-17'),
	(2, 'CC', 1234, 'AVIS', 'RAFAEL', 'BARRIOS', 'RAMOS', '2022-09-15', 'F', 'A', '2021-01-17'),
	(59, 'CC', 12345, 'prueba', 'nueva', 'owewo', 'asda', '2021-05-24', 'F', 'A', '2021-05-24'),
	(60, 'CC', 123123, 'ldasd', 'alsfsl', 'sldfsld', 'sldkfs', '2021-05-24', 'M', 'A', '2021-05-24'),
	(61, 'CC', 10342765, 'DANIEL', 'gyu', 'CARDONA', 'RAMOS', '2021-05-06', 'F', 'I', '2021-05-24'),
	(65, 'CC', 1045307, 'DANIEL', '', 'YEPES', 'RAMOS', '2021-05-24', 'F', 'A', '2021-05-24'),
	(66, 'CC', 1, 'ANDRES', 'ANDRES', 'AGUILA', 'RAMOS', '2022-09-08', 'M', 'A', '2021-11-16'),
	(67, 'CC', 2, 'javier', 'andres', 'nuevo', 'gaitan', '2021-05-24', 'M', 'I', '2021-11-16'),
	(68, 'CC', 3, 'raul', 'andres', 'aguirre', 'sierra', '2021-05-24', 'M', 'I', '2021-11-16'),
	(69, 'CC', 5, 'roman', 'andres', 'tejeda', 'perez', '2021-05-24', 'M', 'A', '2021-11-16'),
	(70, 'CC', 4, 'juan', 'andres', 'mercado', 'bogota', '2021-05-24', 'M', 'A', '2021-11-16'),
	(71, 'CC', 43634634, 'BRAYAN', 'ANDRES', 'REAL', 'RAMOS', '2022-09-07', 'M', 'A', '2022-09-14'),
	(72, 'CC', 234234, '234A', 'ASFASF', 'ASFASF', 'ASFASFASF', '2022-09-06', 'M', 'A', '2022-09-14'),
	(73, 'CC', 5423323, 'CVFXCBCV', 'XCXCBXBC', 'XDSDGDS', 'SDSDGD', '2022-09-01', 'F', 'A', '2022-09-14'),
	(74, 'TI', 2134, 'AVIS', 'JOSEASD', 'REAL', 'VASQUEZ', '2022-09-01', 'M', 'A', '2022-09-14'),
	(79, 'CC', 1112222, 'AAAAAAAAAAA', 'DDDDDDDD', 'GGGGGGGGGG', 'UUUUUU', NULL, NULL, 'A', '2022-09-28'),
	(80, 'TI', 23435423, 'AAAAAAAA', 'AAAAAA', 'AAAAAAA', 'AAAAAAA', NULL, NULL, 'A', '2022-09-28');

-- Volcando estructura para tabla db_digiturno.db_modulos
CREATE TABLE IF NOT EXISTS `db_modulos` (
  `id_modulo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_modulo` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`id_modulo`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla db_digiturno.db_modulos: ~3 rows (aproximadamente)
INSERT INTO `db_modulos` (`id_modulo`, `nombre_modulo`, `estado`, `fecha_registro`) VALUES
	(1, '205', 'A', NULL),
	(5, '306', 'I', '2022-09-26 11:31:15'),
	(6, '103', 'A', '2022-09-26 14:37:51');

-- Volcando estructura para tabla db_digiturno.db_nivel_acceso
CREATE TABLE IF NOT EXISTS `db_nivel_acceso` (
  `id_nivel` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_nivel` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_nivel`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla db_digiturno.db_nivel_acceso: ~3 rows (aproximadamente)
INSERT INTO `db_nivel_acceso` (`id_nivel`, `nombre_nivel`, `estado`) VALUES
	(1, 'ADMINISTRADOR', 'A'),
	(2, 'ACCESO 1', 'A'),
	(3, 'ACCESO 2', 'A');

-- Volcando estructura para tabla db_digiturno.db_servicios
CREATE TABLE IF NOT EXISTS `db_servicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_servicio` varchar(50) DEFAULT NULL,
  `color_servicio` varchar(50) DEFAULT NULL,
  `icono_servicio` varchar(50) DEFAULT NULL,
  `letra_servicio` varchar(50) DEFAULT NULL,
  `id_servicio` int(11) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla db_digiturno.db_servicios: ~6 rows (aproximadamente)
INSERT INTO `db_servicios` (`id`, `nombre_servicio`, `color_servicio`, `icono_servicio`, `letra_servicio`, `id_servicio`, `estado`, `fecha_registro`) VALUES
	(1, 'CONSULTORIO', 'success', 'bxl-codepen', 'C', 1, 'A', '2022-09-27 13:14:52'),
	(2, 'MEDICINA', 'primary', 'bx-plus-medical', 'M', 2, 'A', '2022-09-27 13:28:29'),
	(3, 'TERAPIA', 'info', 'bxl-html5', 'T', 3, 'A', '2022-09-27 13:28:30'),
	(4, 'FARMACIA', 'warning', 'bxs-capsule', 'F', 4, 'A', '2022-09-27 13:28:31'),
	(5, 'AGRICULTURA', 'danger', 'bxs-sun', 'A', 5, 'A', '2022-09-26 11:31:15'),
	(6, 'NUEVO', 'dark', 'bxl-opera', 'N', NULL, 'A', '2022-09-28 13:32:02');

-- Volcando estructura para tabla db_digiturno.db_turnos
CREATE TABLE IF NOT EXISTS `db_turnos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_servicio` varchar(50) DEFAULT NULL,
  `estado_turno` varchar(50) DEFAULT NULL,
  `turno` varchar(50) DEFAULT NULL,
  `modulo` varchar(50) DEFAULT NULL,
  `documento` int(11) DEFAULT NULL,
  `usuario_atendio` varchar(50) DEFAULT NULL,
  `tiempo_ingreso` datetime DEFAULT NULL,
  `tiempo_atender` datetime DEFAULT NULL,
  `tiempo_salida` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla db_digiturno.db_turnos: ~38 rows (aproximadamente)
INSERT INTO `db_turnos` (`id`, `tipo_servicio`, `estado_turno`, `turno`, `modulo`, `documento`, `usuario_atendio`, `tiempo_ingreso`, `tiempo_atender`, `tiempo_salida`) VALUES
	(1, '1', 'FINALIZADO', 'C001', '306A', 123, 'yordis', '2022-04-07 13:19:13', '2022-04-07 13:20:36', '2022-04-07 13:28:04'),
	(2, '1', 'FINALIZADO', 'C002', '306A', 1234, 'jesus.martinez', '2022-04-07 13:19:21', '2022-04-07 16:25:18', '2022-04-07 16:25:25'),
	(3, '1', 'ESPERE', 'C003', NULL, 1234, NULL, '2022-04-07 13:19:26', NULL, NULL),
	(4, '1', 'ESPERE', 'C004', NULL, 123, NULL, '2022-04-07 13:20:17', NULL, NULL),
	(5, '1', 'FINALIZADO', 'C001', '306A', 1234, 'jesus.martinez', '2022-04-08 07:12:12', '2022-04-08 07:12:43', '2022-04-08 07:13:23'),
	(6, '1', 'ESPERE', 'C002', NULL, 123, NULL, '2022-04-08 07:12:18', NULL, NULL),
	(7, NULL, 'A', 'C001', NULL, 123, NULL, '2022-09-28 15:15:05', NULL, NULL),
	(8, NULL, 'A', 'C001', NULL, 123, NULL, '2022-09-28 15:17:22', NULL, NULL),
	(9, '1', 'A', 'C001', NULL, 123, NULL, '2022-09-28 15:20:28', NULL, NULL),
	(10, '1', 'A', 'C002', NULL, 123, NULL, '2022-09-28 15:23:37', NULL, NULL),
	(11, '1', 'A', 'C003', NULL, 123, NULL, '2022-09-28 15:23:43', NULL, NULL),
	(12, '2', 'A', 'M001', NULL, 123, NULL, '2022-09-28 15:23:49', NULL, NULL),
	(13, '2', 'A', 'M002', NULL, 123, NULL, '2022-09-28 15:23:52', NULL, NULL),
	(14, '2', 'A', 'M003', NULL, 123, NULL, '2022-09-28 15:34:41', NULL, NULL),
	(15, '5', 'A', 'A001', NULL, 123, NULL, '2022-09-28 15:34:46', NULL, NULL),
	(16, '5', 'A', 'A002', NULL, 123, NULL, '2022-09-28 15:34:48', NULL, NULL),
	(17, '1', 'A', 'C004', NULL, 123, NULL, '2022-09-28 15:35:33', NULL, NULL),
	(18, '1', 'A', 'C005', NULL, 123, NULL, '2022-09-28 15:37:38', NULL, NULL),
	(19, '3', 'A', 'T001', NULL, 123, NULL, '2022-09-28 15:37:42', NULL, NULL),
	(20, '4', 'A', 'F001', NULL, 123, NULL, '2022-09-28 15:37:45', NULL, NULL),
	(21, '6', 'A', 'N001', NULL, 123, NULL, '2022-09-28 15:37:48', NULL, NULL),
	(22, '5', 'A', 'A003', NULL, 123, NULL, '2022-09-28 15:37:51', NULL, NULL),
	(23, '2', 'A', 'M004', NULL, 1112222, NULL, '2022-09-28 15:41:54', NULL, NULL),
	(24, '2', 'A', 'M005', NULL, 23435423, NULL, '2022-09-28 15:53:53', NULL, NULL),
	(25, '1', 'A', 'C006', NULL, 123, NULL, '2022-09-28 16:00:49', NULL, NULL),
	(26, '1', 'F', 'C001', '5', 123, 'yordis', '2022-09-29 10:59:32', '2022-09-29 14:29:50', '2022-09-29 14:42:02'),
	(27, '3', 'A', 'T001', NULL, 123, NULL, '2022-09-29 10:59:36', NULL, NULL),
	(28, '3', 'A', 'T002', NULL, 123, NULL, '2022-09-29 10:59:39', NULL, NULL),
	(29, '1', 'F', 'C002', '5', 123, 'yordis', '2022-09-29 10:59:42', '2022-09-29 14:31:14', '2022-09-29 14:42:02'),
	(30, '3', 'A', 'T003', NULL, 123, NULL, '2022-09-29 10:59:44', NULL, NULL),
	(31, '2', 'A', 'M001', NULL, 123, NULL, '2022-09-29 10:59:46', NULL, NULL),
	(32, '2', 'A', 'M002', NULL, 123, NULL, '2022-09-29 10:59:49', NULL, NULL),
	(33, '3', 'A', 'T004', NULL, 123, NULL, '2022-09-29 10:59:51', NULL, NULL),
	(34, '1', 'F', 'C003', '5', 123, 'yordis', '2022-09-29 14:40:52', '2022-09-29 14:41:52', '2022-09-29 14:42:02'),
	(35, '1', 'F', 'C004', '5', 123, 'yordis', '2022-09-29 14:40:55', '2022-09-29 14:46:10', '2022-09-29 14:46:19'),
	(36, '1', 'F', 'C005', '5', 123, 'yordis', '2022-09-29 14:40:57', '2022-09-29 14:46:26', '2022-09-29 14:46:32'),
	(37, '1', 'F', 'C006', '5', 123, 'yordis', '2022-09-29 14:47:06', '2022-09-29 14:47:19', '2022-09-29 14:47:22'),
	(38, '1', 'F', 'C007', '5', 123, 'yordis', '2022-09-29 14:47:09', '2022-09-29 14:47:29', '2022-09-29 14:47:34'),
	(39, '1', 'M', 'C001', '5', 123, 'yordis', '2022-09-30 08:01:13', '2022-09-30 08:02:07', '2022-09-30 08:02:11'),
	(40, '1', 'F', 'C002', '5', 123, 'yordis', '2022-09-30 08:01:16', '2022-09-30 08:02:29', '2022-09-30 08:02:31'),
	(41, '2', 'F', 'M001', '5', 123, 'yordis', '2022-09-30 08:01:19', '2022-09-30 13:28:18', '2022-09-30 13:28:20'),
	(42, '2', 'F', 'M002', '5', 123, 'yordis', '2022-09-30 08:01:21', '2022-09-30 13:28:23', '2022-09-30 13:28:25'),
	(43, '2', 'F', 'M003', '5', 123, 'yordis', '2022-09-30 08:01:27', '2022-09-30 13:28:27', '2022-09-30 13:28:29'),
	(44, '2', 'F', 'M004', '5', 123, 'yordis', '2022-09-30 08:01:33', '2022-09-30 13:28:31', '2022-09-30 13:28:33'),
	(45, '1', 'A', 'C001', NULL, 123, NULL, '2022-10-03 07:11:59', NULL, NULL),
	(46, '2', 'F', 'M001', '5', 123, 'yordis', '2022-10-03 07:12:02', '2022-10-03 07:12:14', '2022-10-03 07:12:18'),
	(47, '6', 'A', 'N001', NULL, 123, NULL, '2022-10-03 07:12:04', NULL, NULL),
	(48, '2', 'F', 'M002', '5', 123, 'yordis', '2022-10-03 07:12:07', '2022-10-03 07:12:21', '2022-10-03 07:12:23'),
	(49, '1', 'A', 'C002', NULL, 123, NULL, '2022-10-03 07:12:10', NULL, NULL),
	(50, '2', 'F', 'M003', '5', 123, 'yordis', '2022-10-03 08:51:42', '2022-10-03 08:52:18', '2022-10-03 08:52:44'),
	(51, '2', 'F', 'M004', '5', 123, 'yordis', '2022-10-03 08:51:45', '2022-10-03 08:56:34', '2022-10-03 08:58:47'),
	(52, '2', 'M', 'M005', '5', 123, 'yordis', '2022-10-03 08:51:48', '2022-10-03 08:58:50', NULL);

-- Volcando estructura para tabla db_digiturno.db_usuarios
CREATE TABLE IF NOT EXISTS `db_usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) DEFAULT NULL,
  `cedula` int(11) DEFAULT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `servicio` varchar(60) DEFAULT NULL,
  `modulo` varchar(60) DEFAULT NULL,
  `estado` varchar(60) DEFAULT NULL,
  `nivel` int(11) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  PRIMARY KEY (`id_usuario`) USING BTREE,
  UNIQUE KEY `usuario` (`usuario`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla db_digiturno.db_usuarios: 6 rows
/*!40000 ALTER TABLE `db_usuarios` DISABLE KEYS */;
INSERT INTO `db_usuarios` (`id_usuario`, `usuario`, `cedula`, `nombres`, `apellidos`, `password`, `servicio`, `modulo`, `estado`, `nivel`, `fecha_registro`) VALUES
	(1, 'yordis', 1012356555, 'Yordis Escorcia', 'Escorcia', '$2y$12$JyUl.ziGLFXpHbiQwD2PQ.yntLbM4A/XRO7vNj9cqZHbuXDWY51Si', '2', '5', 'A', 1, NULL),
	(98, 'amalin.florez', 1042446778, 'amalin florez', 'nuevo', '$2y$12$vViynJPf8AJQE5G58b0PuOl59VOgD8msS8YTgDdD.Ld8/EUsYbNw6', '1', '1', 'A', 3, NULL),
	(97, 'monica.marino', 32624689, 'monica marino', NULL, '$2y$12$NEOExCEzFXxoCf26QpDczeKgRMhSdzhYbITRJUgntWv7A55UiMZB6', '1', '1', 'A', 2, NULL),
	(99, 'jesus.martinez', 1001896534, 'jesus martinez', NULL, '$2y$12$GVSz1S1.S5JXmWoG/KLYWejumwckdK9.IVopKyVOV6hlrE6jSshLW', '1', '6', 'A', 2, NULL),
	(100, 'nayis.miranda', 49724947, 'NAYIS MIRANDA', NULL, '$2y$12$lGtHoPpY9U2QdAvjTuV3kej2sHjB2nfEYlxbfy1oq8uJ.vqAHBP4i', '1', '1', 'A', 2, NULL),
	(101, 'admin', 123123, 'PEDRO', 'VECINO', '$2y$12$lbGJYKzZ5SwulUZYlIAwa./pqGSgtYW9KOM5n0tlCx7/EEL8M2wjO', '5', '5', 'I', 2, '2022-09-14');
/*!40000 ALTER TABLE `db_usuarios` ENABLE KEYS */;

-- Volcando estructura para procedimiento db_digiturno.pr_actualizar_turno
DELIMITER //
CREATE PROCEDURE `pr_actualizar_turno`(
	IN `tramite` VARCHAR(50),
	IN `estadoturno` VARCHAR(50),
	IN `usuario` VARCHAR(50),
	IN `moduloatender` VARCHAR(50)
)
BEGIN
DECLARE numerodeturno VARCHAR(50);

SELECT t.turno INTO numerodeturno
FROM db_turnos t INNER JOIN db_servicios s ON t.tipo_tramite=s.id_servicio 
WHERE s.nombre_servicio = tramite AND t.estado_turno = estadoturno
and DATE_FORMAT(tiempo_ingreso, '%Y-%m-%d') = CURDATE() ORDER BY tiempo_ingreso ASC LIMIT 1;

UPDATE  db_turnos  
SET estado_turno = 'PASE', usuario_atendio = usuario, modulo = moduloatender, tiempo_atender = NOW() 
WHERE turno = numerodeturno and DATE_FORMAT(tiempo_ingreso, '%Y-%m-%d') = CURDATE();
END//
DELIMITER ;

-- Volcando estructura para procedimiento db_digiturno.pr_atender_turno
DELIMITER //
CREATE PROCEDURE `pr_atender_turno`(
	IN `turnoingreso` VARCHAR(50)
)
BEGIN
UPDATE  db_turnos  SET estado_turno = 'ATENDIENDO', tiempo_salida = NOW() WHERE turno = turnoingreso and DATE_FORMAT(tiempo_ingreso, '%Y-%m-%d') = CURDATE();
END//
DELIMITER ;

-- Volcando estructura para procedimiento db_digiturno.pr_consultar_turno
DELIMITER //
CREATE PROCEDURE `pr_consultar_turno`(
	IN `usuario` VARCHAR(50)
)
BEGIN
SELECT turno,estado_turno,tiempo_ingreso,pnombre
FROM db_turnos WHERE usuario_atendio=usuario and  estado_turno IN ('PASE','ATENDIENDO') and DATE_FORMAT(tiempo_ingreso, '%Y-%m-%d') = CURDATE();
END//
DELIMITER ;

-- Volcando estructura para procedimiento db_digiturno.pr_descargar_reporte
DELIMITER //
CREATE PROCEDURE `pr_descargar_reporte`(
	IN `fechainicio` VARCHAR(50),
	IN `fechafin` VARCHAR(50)
)
BEGIN
SELECT * FROM db_turnos WHERE DATE_FORMAT(tiempo_ingreso, '%Y-%m-%d') BETWEEN fechainicio AND fechafin;
END//
DELIMITER ;

-- Volcando estructura para procedimiento db_digiturno.pr_finalizar_turno
DELIMITER //
CREATE PROCEDURE `pr_finalizar_turno`(
	IN `turnofinalizar` VARCHAR(50)
)
BEGIN
UPDATE  db_turnos  SET estado_turno = 'FINALIZADO', tiempo_salida = NOW() WHERE turno = turnofinalizar and DATE_FORMAT(tiempo_ingreso, '%Y-%m-%d') = CURDATE();
END//
DELIMITER ;

-- Volcando estructura para procedimiento db_digiturno.pr_insert_usuarios
DELIMITER //
CREATE PROCEDURE `pr_insert_usuarios`(
	IN `usuarioinsert` VARCHAR(50),
	IN `cedulainsert` INT,
	IN `nombreinsert` VARCHAR(50),
	IN `contrasena` VARCHAR(50),
	IN `tramiteinsert` VARCHAR(50),
	IN `moduloinsert` VARCHAR(50),
	IN `nivelinsert` INT,
	OUT `datosalida` VARCHAR(50)
)
BEGIN

DECLARE datosalida VARCHAR(50);

INSERT INTO usuarios_db (usuario,cedula, nombre, password,tramite,modulo,nivel) 
VALUES (usuarioinsert,cedulainsert,nombreinsert,contrasena,tramiteinsert,moduloinsert,nivelinsert);

SET datosalida=1;
END//
DELIMITER ;

-- Volcando estructura para procedimiento db_digiturno.pr_logue_usuario
DELIMITER //
CREATE PROCEDURE `pr_logue_usuario`(
	IN `usuario1` VARCHAR(50)
)
BEGIN
SELECT u.usuario,u.nombre,u.password,u.modulo,u.nivel,s.nombre_servicio
    FROM usuarios_db u
    INNER JOIN db_servicios s ON u.tramite=s.id_servicio
    WHERE u.usuario = usuario1;
END//
DELIMITER ;

-- Volcando estructura para procedimiento db_digiturno.pr_turnos_ver_hoy_atendidos
DELIMITER //
CREATE PROCEDURE `pr_turnos_ver_hoy_atendidos`()
BEGIN
SELECT tu.estado_turno, tu.turno, tu.documento,tu.pnombre,tu.usuario_atendio,tu.tiempo_ingreso,tu.tiempo_atender,tu.tiempo_salida
FROM db_turnos tu 
WHERE tu.estado_turno IN ('ESPERE','FINALIZADO')
and DATE_FORMAT(tu.tiempo_ingreso, '%Y-%m-%d') = CURDATE();
END//
DELIMITER ;

-- Volcando estructura para procedimiento db_digiturno.pr_update_usuarios
DELIMITER //
CREATE PROCEDURE `pr_update_usuarios`(
	IN `upusuario` VARCHAR(50),
	IN `upcedula` VARCHAR(50),
	IN `upnombre` VARCHAR(50),
	IN `upmodulo` VARCHAR(50),
	IN `upestatus` VARCHAR(50),
	IN `upnivel` VARCHAR(50)
)
BEGIN
UPDATE  usuarios_db  SET 
usuario = upusuario, nombre = upnombre, 
modulo = upmodulo, status = upestatus, nivel = upnivel
WHERE cedula = upcedula;
END//
DELIMITER ;

-- Volcando estructura para procedimiento db_digiturno.pr_ver_afiliados
DELIMITER //
CREATE PROCEDURE `pr_ver_afiliados`()
BEGIN
SELECT * FROM db_afiliados;
END//
DELIMITER ;

-- Volcando estructura para procedimiento db_digiturno.pr_ver_graficos
DELIMITER //
CREATE PROCEDURE `pr_ver_graficos`()
BEGIN
SELECT s.nombre_servicio, t.tipo_tramite, COUNT(*) AS total_turnos, 
sum(t.estado_turno='ESPERE')  AS en_espera,
sum(t.estado_turno='FINALIZADO') AS atendidos
  FROM db_turnos t
  INNER JOIN db_servicios s ON t.tipo_tramite = s.id_servicio
  WHERE t.tipo_tramite is not null
  GROUP BY t.tipo_tramite;
END//
DELIMITER ;

-- Volcando estructura para procedimiento db_digiturno.pr_ver_graficos_inicio_fin
DELIMITER //
CREATE PROCEDURE `pr_ver_graficos_inicio_fin`(
	IN `fechainicio` VARCHAR(50),
	IN `fechafin` VARCHAR(50)
)
BEGIN
SELECT s.nombre_servicio, t.tipo_tramite, COUNT(*) AS total_turnos, 
sum(t.estado_turno='ESPERE')  AS en_espera,
sum(t.estado_turno='FINALIZADO') AS atendidos
FROM db_turnos t
INNER JOIN db_servicios s ON t.tipo_tramite = s.id_servicio
WHERE DATE_FORMAT(t.tiempo_ingreso, '%Y-%m-%d') BETWEEN fechainicio AND fechafin
GROUP BY t.tipo_tramite;
END//
DELIMITER ;

-- Volcando estructura para procedimiento db_digiturno.pr_ver_reporte_turnos
DELIMITER //
CREATE PROCEDURE `pr_ver_reporte_turnos`(
	IN `fechainicio` VARCHAR(50),
	IN `fechafin` VARCHAR(50),
	IN `estadoturno` VARCHAR(50)
)
BEGIN
SELECT * FROM db_turnos WHERE DATE_FORMAT(tiempo_ingreso, '%Y-%m-%d') 
BETWEEN fechainicio AND fechafin and estado_turno=estadoturno ORDER BY pnombre ASC;
END//
DELIMITER ;

-- Volcando estructura para procedimiento db_digiturno.pr_ver_servicios
DELIMITER //
CREATE PROCEDURE `pr_ver_servicios`()
BEGIN
SELECT * FROM db_servicios;
END//
DELIMITER ;

-- Volcando estructura para procedimiento db_digiturno.pr_ver_total_turnos
DELIMITER //
CREATE PROCEDURE `pr_ver_total_turnos`()
BEGIN
SELECT s.nombre_servicio, t.tipo_tramite, COUNT(*) AS total_turnos, 
    sum(t.estado_turno='ACTIVO')  AS en_espera,
    sum(t.estado_turno='FINALIZADO') AS atendidos
      FROM db_turnos t
      INNER JOIN db_servicios s ON t.tipo_tramite = s.id_servicio
      WHERE t.tipo_tramite is not null
      GROUP BY t.tipo_tramite;
END//
DELIMITER ;

-- Volcando estructura para procedimiento db_digiturno.pr_ver_turnos_hoy
DELIMITER //
CREATE PROCEDURE `pr_ver_turnos_hoy`()
BEGIN
-- SELECT t.estado_turno,t.turno,t.documento, CONCAT(t.pnombre," ",t.papellido) AS nombre,s.nombre_servicio, t.tiempo_ingreso
-- FROM db_turnos t
-- INNER JOIN db_servicios s ON t.tipo_tramite=s.id_servicio
-- WHERE t.estado_turno IN ('ESPERE','FINALIZADO')
-- and DATE_FORMAT(t.tiempo_ingreso, '%Y-%m-%d') = CURDATE();

SELECT r.idReverva, r.descripcion, r.fechaReserva, r.movilSMSCliente 
FROM reservacitas r
WHERE DATE_FORMAT(r.fechaReserva, '%Y-%m-%d') = CURDATE();
END//
DELIMITER ;

-- Volcando estructura para procedimiento db_digiturno.pr_ver_turnos_pantalla
DELIMITER //
CREATE PROCEDURE `pr_ver_turnos_pantalla`(
	IN `tipollamado` VARCHAR(50)
)
BEGIN
SELECT estado_turno, pnombre,papellido, turno, modulo FROM db_turnos WHERE estado_turno = tipollamado and DATE_FORMAT(tiempo_ingreso, '%Y-%m-%d') = CURDATE();
END//
DELIMITER ;

-- Volcando estructura para procedimiento db_digiturno.pr_ver_turnos_pantalla2
DELIMITER //
CREATE PROCEDURE `pr_ver_turnos_pantalla2`()
BEGIN
SELECT turno,modulo,estado_turno 
FROM db_turnos where estado_turno IN ('ESPERE','PASE') and DATE_FORMAT(tiempo_ingreso, '%Y-%m-%d') = CURDATE() order by tiempo_ingreso asc LIMIT 5;
END//
DELIMITER ;

-- Volcando estructura para procedimiento db_digiturno.pr_ver_usuarios
DELIMITER //
CREATE PROCEDURE `pr_ver_usuarios`()
BEGIN
SELECT u.cedula, u.id_admin, u.usuario, u.nombre, u.modulo, s.nombre_servicio,u.status,u.nivel
FROM usuarios_db u
INNER JOIN db_servicios s ON u.tramite=s.id_servicio;
END//
DELIMITER ;

-- Volcando estructura para procedimiento db_digiturno.sp_update_password
DELIMITER //
CREATE PROCEDURE `sp_update_password`(
	IN `contrasena` VARCHAR(50),
	IN `usuario1` VARCHAR(50)
)
BEGIN
UPDATE  usuarios_db  SET  password = contrasena, editado = NOW() WHERE usuario = usuario1;
END//
DELIMITER ;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
