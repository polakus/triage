-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 23-10-2020 a las 19:27:20
-- Versión del servidor: 8.0.18
-- Versión de PHP: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `triage`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

DROP TABLE IF EXISTS `areas`;
CREATE TABLE IF NOT EXISTS `areas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipo_dato` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `created_at`, `updated_at`, `tipo_dato`) VALUES
(5, NULL, NULL, 'Consultorio Externo'),
(6, NULL, NULL, 'Consultorio ambulatorio'),
(7, '2020-06-22 22:16:35', '2020-06-22 22:16:35', 'Internacion'),
(8, '2020-06-22 23:45:48', '2020-06-22 23:45:48', 'Quirofano'),
(9, '2020-10-20 16:16:49', '2020-10-20 16:16:49', 'borrar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atencion`
--

DROP TABLE IF EXISTS `atencion`;
CREATE TABLE IF NOT EXISTS `atencion` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_protocolo` bigint(20) UNSIGNED DEFAULT NULL,
  `Paciente_id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `atencion_id_procotocolo_foreign` (`id_protocolo`),
  KEY `atencion_paciente_id_foreign` (`Paciente_id`),
  KEY `atencion_usuario_id_foreign` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `atencion`
--

INSERT INTO `atencion` (`id`, `created_at`, `updated_at`, `id_protocolo`, `Paciente_id`, `usuario_id`) VALUES
(130, '2020-08-04 03:50:18', '2020-08-04 03:50:18', 31, 22, 18),
(131, '2020-08-04 04:45:16', '2020-08-04 04:45:17', 27, 22, 18),
(132, '2020-08-04 18:51:08', '2020-08-04 18:51:08', 31, 4, 23),
(133, '2020-08-04 19:18:45', '2020-08-04 19:18:46', 27, 5, 23),
(134, '2020-08-05 00:26:40', '2020-08-05 00:26:41', 27, 1, 18),
(135, '2020-08-05 00:35:23', '2020-08-05 00:35:52', NULL, 1, 1),
(136, '2020-08-18 22:26:54', '2020-08-18 22:26:54', 24, 22, 1),
(137, '2020-08-18 19:41:37', '2020-08-18 19:41:37', NULL, 1, 1),
(138, '2020-09-18 12:47:49', '2020-09-18 12:47:49', NULL, 1, 1),
(139, '2020-09-18 12:58:54', '2020-09-18 12:58:55', 24, 1, 1),
(140, '2020-09-18 12:59:43', '2020-09-18 12:59:43', 24, 22, 1),
(141, '2020-09-18 13:01:28', '2020-09-18 13:01:28', 25, 5, 1),
(142, '2020-09-18 14:07:50', '2020-09-18 14:07:50', NULL, 1, 1),
(143, '2020-10-21 01:43:22', '2020-10-21 01:43:22', NULL, 32, 1),
(144, '2020-10-21 01:44:17', '2020-10-21 01:44:17', NULL, 33, 1),
(145, '2020-10-21 01:46:46', '2020-10-22 15:43:45', NULL, 31, 1),
(146, '2020-10-21 22:26:11', '2020-10-21 22:26:11', NULL, 22, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cie`
--

DROP TABLE IF EXISTS `cie`;
CREATE TABLE IF NOT EXISTS `cie` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cie_codigo_unique` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cie`
--

INSERT INTO `cie` (`id`, `descripcion`, `codigo`, `created_at`, `updated_at`) VALUES
(1, 'Colera', 'A00', NULL, '2020-07-15 03:28:09'),
(2, 'Fiebre del dengue', 'A90', NULL, NULL),
(3, 'Angina de pecho', 'I20', NULL, NULL),
(4, 'Fiebres tifoidea y paratifoidea', 'A01', '2020-06-26 06:51:08', '2020-06-29 03:54:52'),
(5, 'Otras infecciones debidas a Salmonella', 'A02', '2020-06-26 06:51:08', '2020-06-26 06:51:08'),
(6, 'Apendicitis aguda', 'k35', '2020-07-13 00:32:14', '2020-07-13 00:32:14'),
(7, 'otras', 'k361', '2020-07-15 22:24:51', '2020-07-15 22:24:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigostriage`
--

DROP TABLE IF EXISTS `codigostriage`;
CREATE TABLE IF NOT EXISTS `codigostriage` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `color` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tiempo_espera` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `codigostriage`
--

INSERT INTO `codigostriage` (`id`, `created_at`, `updated_at`, `color`, `tiempo_espera`) VALUES
(1, NULL, NULL, 'verde', '120 min'),
(2, NULL, NULL, 'amarillo', '30 min'),
(3, NULL, NULL, 'rojo', '10 min');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_sintomas_protocolos`
--

DROP TABLE IF EXISTS `detalles_sintomas_protocolos`;
CREATE TABLE IF NOT EXISTS `detalles_sintomas_protocolos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_protocolo` bigint(20) UNSIGNED NOT NULL,
  `id_sintoma` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `detalles_sintomas_protocolos_id_protocolo_foreign` (`id_protocolo`),
  KEY `detalles_sintomas_protocolos_id_sintoma_foreign` (`id_sintoma`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalles_sintomas_protocolos`
--

INSERT INTO `detalles_sintomas_protocolos` (`id`, `created_at`, `updated_at`, `id_protocolo`, `id_sintoma`) VALUES
(1, '2020-06-21 02:38:00', '2020-06-21 02:38:00', 24, 1),
(2, '2020-06-21 02:38:00', '2020-06-21 02:38:00', 24, 2),
(3, '2020-06-21 06:41:26', '2020-06-21 06:41:26', 25, 3),
(4, '2020-06-21 06:41:27', '2020-06-21 06:41:27', 25, 4),
(5, '2020-06-21 10:35:29', '2020-06-21 10:35:29', 26, 5),
(6, '2020-06-22 07:38:06', '2020-06-22 07:38:06', 27, 6),
(7, '2020-06-23 04:26:32', '2020-06-23 04:26:32', 28, 5),
(8, '2020-06-23 04:26:32', '2020-06-23 04:26:32', 28, 7),
(9, '2020-07-13 00:28:24', '2020-07-13 00:28:24', 29, 7),
(10, '2020-07-13 00:28:24', '2020-07-13 00:28:24', 29, 9),
(11, '2020-07-15 02:51:32', '2020-07-15 02:51:32', 30, 1),
(12, '2020-07-15 02:51:32', '2020-07-15 02:51:32', 30, 2),
(13, '2020-07-15 02:51:32', '2020-07-15 02:51:32', 30, 3),
(14, '2020-07-15 02:51:32', '2020-07-15 02:51:32', 30, 4),
(15, '2020-07-15 02:51:32', '2020-07-15 02:51:32', 30, 5),
(16, '2020-07-15 03:00:17', '2020-07-15 03:00:17', 31, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_atencion`
--

DROP TABLE IF EXISTS `detalle_atencion`;
CREATE TABLE IF NOT EXISTS `detalle_atencion` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_atencion` bigint(20) UNSIGNED NOT NULL,
  `id_det_profesional_sala` bigint(20) UNSIGNED DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_especialidad` bigint(20) UNSIGNED NOT NULL,
  `atendido` tinyint(1) NOT NULL,
  `estado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_codigo_triage` bigint(20) UNSIGNED DEFAULT NULL,
  `sala` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operar` tinyint(1) NOT NULL DEFAULT '0',
  `respuestas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detalle_atencion_id_atencion_foreign` (`id_atencion`),
  KEY `detalle_atencion_id_det_profesional_sala_foreign` (`id_det_profesional_sala`),
  KEY `detalle_atencion_id_especialidad_foreign` (`id_especialidad`)
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_atencion`
--

INSERT INTO `detalle_atencion` (`id`, `created_at`, `updated_at`, `id_atencion`, `id_det_profesional_sala`, `fecha`, `hora`, `id_especialidad`, `atendido`, `estado`, `id_codigo_triage`, `sala`, `operar`, `respuestas`) VALUES
(132, '2020-08-04 03:50:19', '2020-08-04 20:46:57', 130, NULL, '2020-08-04', '17:46', 6, 1, 'Internado', 3, 'Box de varones', 0, NULL),
(133, '2020-08-04 04:45:17', '2020-08-04 04:46:18', 131, NULL, '2020-08-04', '01:46', 7, 1, 'Internar', 2, NULL, 0, NULL),
(134, '2020-08-04 18:51:09', '2020-08-04 18:51:09', 132, NULL, '2020-08-04', '15:51', 6, 0, 'consulta', 2, NULL, 0, NULL),
(135, '2020-08-04 19:18:46', '2020-08-04 21:15:50', 133, NULL, '2020-08-04', '18:15', 7, 1, 'alta', 1, NULL, 0, NULL),
(136, '2020-08-05 00:26:41', '2020-08-05 00:26:41', 134, NULL, '2020-08-04', '21:26', 7, 0, 'consulta', 3, NULL, 0, NULL),
(137, '2020-08-05 00:35:23', '2020-08-05 00:35:37', 135, NULL, '2020-08-04', '21:35', 5, 0, 'Operado', 3, '1', 0, NULL),
(138, '2020-08-18 22:26:54', '2020-08-18 22:26:54', 136, NULL, '2020-08-18', '22:26', 5, 0, 'consulta', 1, NULL, 0, NULL),
(139, '2020-08-18 19:41:51', '2020-08-18 19:41:51', 137, NULL, '2020-08-18', '19:41', 5, 0, 'consulta', 1, NULL, 0, NULL),
(141, '2020-09-18 12:59:43', '2020-09-18 12:59:43', 140, NULL, '2020-09-18', '12:59', 5, 0, 'consulta', 1, NULL, 0, NULL),
(142, '2020-09-18 13:01:29', '2020-09-18 13:01:29', 141, NULL, '2020-09-18', '13:01', 6, 0, 'consulta', 2, NULL, 0, NULL),
(143, '2020-10-21 01:43:22', '2020-10-21 01:43:22', 143, NULL, '2020-10-20', '22:43', 5, 0, 'Operar', 1, NULL, 0, NULL),
(144, '2020-10-21 01:44:17', '2020-10-21 01:44:17', 144, NULL, '2020-10-20', '22:44', 5, 0, 'Operar', 1, NULL, 0, NULL),
(145, '2020-10-21 01:46:46', '2020-10-21 01:46:46', 145, NULL, '2020-10-20', '22:46', 5, 0, 'Operar', 1, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_especialidad_area`
--

DROP TABLE IF EXISTS `det_especialidad_area`;
CREATE TABLE IF NOT EXISTS `det_especialidad_area` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_especialidad` bigint(20) UNSIGNED NOT NULL,
  `id_area` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `det_especialidad_area_id_especialidad_foreign` (`id_especialidad`),
  KEY `det_especialidad_area_id_area_foreign` (`id_area`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `det_especialidad_area`
--

INSERT INTO `det_especialidad_area` (`id`, `created_at`, `updated_at`, `id_especialidad`, `id_area`) VALUES
(1, NULL, NULL, 6, 6),
(2, NULL, NULL, 5, 5),
(3, NULL, NULL, 7, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_profesionales`
--

DROP TABLE IF EXISTS `det_profesionales`;
CREATE TABLE IF NOT EXISTS `det_profesionales` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_profesional` bigint(20) UNSIGNED NOT NULL,
  `id_especialidad` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `det_profesionales_id_profesional_foreign` (`id_profesional`),
  KEY `det_profesionales_id_especialidad_foreign` (`id_especialidad`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `det_profesionales`
--

INSERT INTO `det_profesionales` (`id`, `created_at`, `updated_at`, `id_profesional`, `id_especialidad`) VALUES
(25, '2020-07-30 21:27:03', '2020-07-30 21:27:03', 18, 6),
(26, '2020-08-03 02:20:30', '2020-08-03 02:20:30', 19, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_profesionales_salas`
--

DROP TABLE IF EXISTS `det_profesionales_salas`;
CREATE TABLE IF NOT EXISTS `det_profesionales_salas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_profesional` bigint(20) UNSIGNED NOT NULL,
  `id_sala` bigint(20) UNSIGNED NOT NULL,
  `disponibilidad` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `det_profesionales_salas_id_profesional_foreign` (`id_profesional`),
  KEY `det_profesionales_salas_id_sala_foreign` (`id_sala`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `det_profesionales_salas`
--

INSERT INTO `det_profesionales_salas` (`id`, `created_at`, `updated_at`, `id_profesional`, `id_sala`, `disponibilidad`) VALUES
(16, '2020-08-03 02:07:43', '2020-08-05 00:31:51', 18, 8, 1),
(17, '2020-08-03 02:21:40', '2020-08-04 20:05:16', 19, 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_protocolos`
--

DROP TABLE IF EXISTS `det_protocolos`;
CREATE TABLE IF NOT EXISTS `det_protocolos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_especialidad` bigint(20) UNSIGNED NOT NULL,
  `id_protocolo` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `det_protocolos_id_especialidad_foreign` (`id_especialidad`),
  KEY `det_protocolos_id_protocolo_foreign` (`id_protocolo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `det_protocolos`
--

INSERT INTO `det_protocolos` (`id`, `created_at`, `updated_at`, `id_especialidad`, `id_protocolo`) VALUES
(1, NULL, NULL, 5, 24),
(2, NULL, NULL, 6, 25),
(3, NULL, NULL, 7, 27),
(4, '2020-07-15 02:51:33', '2020-07-15 02:51:33', 6, 30),
(5, '2020-07-15 03:00:17', '2020-07-15 03:00:17', 6, 31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades`
--

DROP TABLE IF EXISTS `especialidades`;
CREATE TABLE IF NOT EXISTS `especialidades` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nombre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `especialidades`
--

INSERT INTO `especialidades` (`id`, `created_at`, `updated_at`, `nombre`, `descripcion`) VALUES
(5, NULL, '2020-07-15 04:00:26', 'Oftalmologia', 'Problemas de ojos'),
(6, NULL, '2020-07-15 04:22:09', 'Clinico', '1234'),
(7, NULL, NULL, 'Cardiologia', 'asda'),
(8, '2020-07-15 03:44:45', '2020-07-15 03:44:45', 'Traumatologia', 'Dolores de espalda, huesos,etc'),
(9, '2020-07-15 04:10:30', '2020-07-15 04:10:30', 'Cirugia General', 'Se encarga de tal....');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

DROP TABLE IF EXISTS `historial`;
CREATE TABLE IF NOT EXISTS `historial` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_cie` bigint(20) UNSIGNED DEFAULT NULL,
  `descripcion` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `id_detalle_atencion` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `historial_id_cie_foreign` (`id_cie`),
  KEY `historial_id_detalle_atencion_foreign` (`id_detalle_atencion`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id`, `created_at`, `updated_at`, `id_cie`, `descripcion`, `fecha`, `hora`, `id_detalle_atencion`) VALUES
(70, '2020-08-04 04:44:15', '2020-08-04 04:44:15', 1, 'Colera', '2020-08-04', '01:44:00', 132),
(71, '2020-08-04 04:46:19', '2020-08-04 04:46:19', 3, 'nada grave', '2020-08-04', '01:46:00', 133),
(72, '2020-08-04 21:15:50', '2020-08-04 21:15:50', 6, 'nnn', '2020-08-04', '18:15:00', 135),
(73, '2020-08-05 00:35:23', '2020-08-05 00:35:23', 1, 'traumatismo', '2020-08-04', '21:35:00', 137),
(74, '2020-10-21 01:46:46', '2020-10-21 01:46:46', 1, 'asfd', '2020-10-20', '22:46:00', 145);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_05_08_181340_create_cie_table', 1),
(2, '2020_05_13_220822_create_profesionales_table', 1),
(3, '2020_05_13_223404_create_salas_table', 1),
(4, '2020_05_13_232935_create_det_profesionales_salas_table', 1),
(5, '2020_05_14_034510_create_detalle_atencion_table', 1),
(6, '2020_05_19_221359_create_sintomas_table', 1),
(7, '2020_05_19_221526_create_detalles_sintomas_protocolos_table', 1),
(8, '2020_05_21_211227_create_preguntas_table', 1),
(13, '2020_06_20_224138_create_det_profesionales', 2),
(14, '2020_06_20_224337_create_table_profesionales_horarios', 2),
(15, '2020_06_20_224746_create_historial_table', 2),
(16, '2020_06_20_225234_create_table_det_protocolos', 2),
(17, '2020_06_21_021412_add_votes_to_detalle_atencion_table', 3),
(18, '2020_06_21_032838_add_votes_atendido_to_detalle_atencion_table', 4),
(19, '2020_06_21_044200_create_detalle_especialidad_area', 5),
(20, '2020_06_21_232605_add_estado_to_detalle_atencion_table', 6),
(21, '2020_06_21_234446_add_color_to_detalle_atencion_table', 7),
(22, '2020_06_22_031207_add_detalle_to_historial_table', 8),
(23, '2020_06_22_032013_add_detalle_to_historial_table', 9),
(24, '2020_06_22_032614_drop_ids_to_historial_table', 9),
(25, '2020_06_22_185513_add_sala_to_detalle_atencion_table', 10),
(26, '2020_06_22_185916_add_sala_to_detalle_atencion_table', 11),
(27, '2020_06_22_203043_del_sala_to_detalle_atencion_table', 12),
(28, '2020_06_22_203135_add_sala_to_detalle_atencion_table', 13),
(29, '2020_06_21_213946_create_failed_jobs_table', 14),
(30, '2020_06_21_213946_create_password_resets_table', 14),
(31, '2020_06_21_213946_create_roles_table', 14),
(32, '2020_06_21_213946_create_users_table', 14),
(33, '2020_06_24_024309_add_vote_id_profesional_to_table', 15),
(34, '2020_06_21_173808_add_votes_to_salas_table', 16),
(35, '2020_06_22_004740_add_color_to_detalle_atencion_table', 17),
(36, '2020_07_12_224914_add_operar_to_detalleatencion_table', 17),
(37, '2020_07_18_212532_add_preguntas_to_detalle_atencion_table', 18),
(38, '2020_07_28_141420_edit_foreign_key_from_det_profesionales', 19),
(39, '2020_07_29_113329_add_vote_estado_to_users', 20),
(40, '2020_07_30_163553_edit_foreign_key_from_det_profesionales_salas', 21),
(41, '2020_08_04_004410_drop_user_to_atencion_table', 22),
(42, '2020_08_04_004913_add_user_to_atencion_table', 23),
(43, '2020_08_08_194021_create_prueba_table', 24),
(44, '2020_10_16_233426_edit_foreign_key_from_det_protocolos', 25),
(45, '2020_10_22_172823_add_vote_fecha_nac_to_table_pacientes', 26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
CREATE TABLE IF NOT EXISTS `pacientes` (
  `Paciente_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dni` int(11) NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechaNac` date NOT NULL,
  `sexo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domicilio` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Paciente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`Paciente_id`, `dni`, `nombre`, `apellido`, `telefono`, `fechaNac`, `sexo`, `created_at`, `updated_at`, `domicilio`) VALUES
(1, 37190827, 'Alejandro', 'Gonzales', '1', '2020-10-01', 'Masculino', '2020-06-08 19:08:45', '2020-10-23 00:47:33', 'Acevedo 368'),
(3, 45678900, 'Cristian', 'Zalazar', '5678', '2020-07-20', 'Masculino', '2020-06-18 21:58:57', '2020-06-18 21:58:57', NULL),
(4, 39590140, 'Juan', 'Perez', '12341234', '2020-07-20', 'Masculino', '2020-06-19 02:18:17', '2020-06-19 02:18:17', NULL),
(5, 25063824, 'Elena', 'Zalazar', '3875154444', '2020-07-20', 'Femenino', '2020-06-21 02:24:55', '2020-06-21 02:24:55', 'Coronel vidt 2250'),
(6, 39590141, 'Cristian', 'Ven', '3875154444', '2020-07-20', 'Masculino', '2020-06-21 02:26:56', '2020-06-21 02:26:56', 'Coronel vidt 2250'),
(7, 39590143, 'test', 'test', '3875154444', '2020-07-20', 'Masculino', '2020-06-21 02:51:21', '2020-06-21 02:51:21', 'Coronel vidt 2250'),
(8, 0, 'nn', 'nn', '1', '2020-07-20', 'Masculino', '2020-07-18 23:00:51', '2020-07-18 23:00:51', 'nn'),
(9, 0, 'nn', 'nn', '1', '2020-07-18', 'Masculino', '2020-07-18 23:02:28', '2020-07-18 23:02:28', 'nn'),
(10, 0, 'nn', 'nn', '1', '2020-07-18', 'Masculino', '2020-07-18 23:02:49', '2020-07-18 23:02:49', 'nn'),
(11, 0, 'nn', 'nn', '1', '2020-07-18', 'Masculino', '2020-07-18 23:03:08', '2020-07-18 23:03:08', 'nn'),
(12, 0, 'nn', 'nn', '1', '2020-07-18', 'Masculino', '2020-07-18 23:03:59', '2020-07-18 23:03:59', 'nn'),
(13, 0, 'nn', 'nn', '1', '2020-07-18', 'Masculino', '2020-07-18 23:04:42', '2020-07-18 23:04:42', 'nn'),
(14, 0, 'nn', 'nn', '1', '2020-07-18', 'Masculino', '2020-07-18 23:07:31', '2020-07-18 23:07:31', 'nn'),
(15, 0, 'nn', 'nn', '1', '2020-07-20', 'Masculino', '2020-07-20 08:26:51', '2020-07-20 08:26:51', 'nn'),
(16, 0, 'nn', 'nn', '1', '2020-07-20', 'Masculino', '2020-07-20 08:30:36', '2020-07-20 08:30:36', 'nn'),
(17, 0, 'nn', 'nn', '1', '2020-07-20', 'Masculino', '2020-07-20 08:38:31', '2020-07-20 08:38:31', 'nn'),
(18, 0, 'nn', 'nn', '1', '2020-07-20', 'Masculino', '2020-07-20 08:40:17', '2020-07-20 08:40:17', 'nn'),
(19, 0, 'nn', 'nn', '1', '2020-07-20', 'Masculino', '2020-07-20 08:41:45', '2020-07-20 08:41:45', 'nn'),
(20, 0, 'nn', 'nn', '1', '2020-07-20', 'Masculino', '2020-07-20 08:42:55', '2020-07-20 08:42:55', 'nn'),
(21, 0, 'nn', 'nn', '1', '2020-07-20', 'Masculino', '2020-07-20 08:55:57', '2020-07-20 08:55:57', 'nn'),
(22, 42815935, 'Candela', 'Cardozo', '112312312', '2020-07-20', 'Femenino', '2020-07-23 00:08:58', '2020-07-23 00:08:58', 'limache'),
(23, 0, 'nn', 'nn', '1', '2020-07-22', 'Masculino', '2020-07-22 21:14:56', '2020-07-22 21:14:56', 'nn'),
(24, 0, 'nn', 'nn', '1', '2020-07-25', 'Masculino', '2020-07-25 21:25:57', '2020-07-25 21:25:57', 'nn'),
(25, 0, 'nn', 'nn', '1', '2020-07-30', 'Masculino', '2020-07-30 21:32:18', '2020-07-30 21:32:18', 'nn'),
(26, 0, 'nn', 'nn', '1', '2020-07-30', 'Masculino', '2020-07-30 21:35:59', '2020-07-30 21:35:59', 'nn'),
(27, 0, 'nn', 'nn', '1', '2020-07-31', 'Masculino', '2020-07-31 21:52:08', '2020-07-31 21:52:08', 'nn'),
(28, 0, 'nn', 'nn', '1', '2020-08-02', 'Masculino', '2020-08-03 02:27:46', '2020-08-03 02:27:46', 'nn'),
(29, 0, 'nn', 'nn', '1', '2020-08-04', 'Masculino', '2020-08-05 00:35:22', '2020-08-05 00:35:22', 'nn'),
(31, 39590142, 'prueba', 'prueba', '140', '2020-10-07', 'Masculino', '2020-10-21 01:24:37', '2020-10-21 01:24:37', 'Acevedo 368'),
(32, 0, 'nn', 'nn', '1', '2020-10-20', 'Masculino', '2020-10-21 01:43:22', '2020-10-21 01:43:22', 'nn'),
(33, 0, 'nn', 'nn', '1', '2020-10-20', 'Masculino', '2020-10-21 01:44:17', '2020-10-21 01:44:17', 'nn'),
(34, 0, 'nn', 'nn', '1', '2020-10-20', 'Masculino', '2020-10-21 01:46:46', '2020-10-21 01:46:46', 'nn');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

DROP TABLE IF EXISTS `preguntas`;
CREATE TABLE IF NOT EXISTS `preguntas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_atencion` bigint(20) UNSIGNED NOT NULL,
  `id_sintoma` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `preguntas_id_atencion_foreign` (`id_atencion`),
  KEY `preguntas_id_sintoma_foreign` (`id_sintoma`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `created_at`, `updated_at`, `id_atencion`, `id_sintoma`) VALUES
(139, '2020-08-04 03:50:18', '2020-08-04 03:50:18', 130, 3),
(140, '2020-08-04 04:45:17', '2020-08-04 04:45:17', 131, 6),
(141, '2020-08-04 18:51:08', '2020-08-04 18:51:08', 132, 3),
(142, '2020-08-04 19:18:45', '2020-08-04 19:18:45', 133, 6),
(143, '2020-08-05 00:26:40', '2020-08-05 00:26:40', 134, 6),
(144, '2020-08-18 22:26:54', '2020-08-18 22:26:54', 136, 1),
(145, '2020-08-18 22:26:54', '2020-08-18 22:26:54', 136, 2),
(146, '2020-08-18 19:41:37', '2020-08-18 19:41:37', 137, 1),
(147, '2020-08-18 19:41:37', '2020-08-18 19:41:37', 137, 4),
(148, '2020-09-18 12:47:49', '2020-09-18 12:47:49', 138, 1),
(149, '2020-09-18 12:58:54', '2020-09-18 12:58:54', 139, 1),
(150, '2020-09-18 12:58:54', '2020-09-18 12:58:54', 139, 2),
(151, '2020-09-18 12:59:43', '2020-09-18 12:59:43', 140, 1),
(152, '2020-09-18 12:59:43', '2020-09-18 12:59:43', 140, 2),
(153, '2020-09-18 13:01:28', '2020-09-18 13:01:28', 141, 3),
(154, '2020-09-18 13:01:28', '2020-09-18 13:01:28', 141, 4),
(155, '2020-09-18 14:07:50', '2020-09-18 14:07:50', 142, 1),
(156, '2020-10-21 22:26:12', '2020-10-21 22:26:12', 146, 6),
(157, '2020-10-21 22:26:12', '2020-10-21 22:26:12', 146, 2),
(158, '2020-10-21 22:26:12', '2020-10-21 22:26:12', 146, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesionales`
--

DROP TABLE IF EXISTS `profesionales`;
CREATE TABLE IF NOT EXISTS `profesionales` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `matricula` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `domicilio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `disponibilidad` tinyint(1) NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `profesionales_id_user_foreign` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `profesionales`
--

INSERT INTO `profesionales` (`id`, `created_at`, `updated_at`, `matricula`, `nombre`, `apellido`, `domicilio`, `disponibilidad`, `id_user`) VALUES
(18, '2020-07-30 21:27:03', '2020-08-04 02:33:53', '1', 'juan', 'mendez', 'coronel vidt', 1, 18),
(19, '2020-08-03 02:20:30', '2020-08-04 21:37:51', '123', 'candela', 'cardozo', 'limache', 0, 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesionales_horarios`
--

DROP TABLE IF EXISTS `profesionales_horarios`;
CREATE TABLE IF NOT EXISTS `profesionales_horarios` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_profesional` bigint(20) UNSIGNED NOT NULL,
  `hr_ini` time NOT NULL,
  `hr_fin` time NOT NULL,
  `dia` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `profesionales_horarios_id_profesional_foreign` (`id_profesional`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `protocolos`
--

DROP TABLE IF EXISTS `protocolos`;
CREATE TABLE IF NOT EXISTS `protocolos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_codigo_triage` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `protocolos_id_codigo_triage_foreign` (`id_codigo_triage`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `protocolos`
--

INSERT INTO `protocolos` (`id`, `created_at`, `updated_at`, `id_codigo_triage`, `descripcion`) VALUES
(24, '2020-06-21 02:38:00', '2020-06-21 02:38:00', 1, 'Primer protocolo'),
(25, '2020-06-21 06:41:26', '2020-06-21 06:41:26', 2, 'Segundo protocolo'),
(26, '2020-06-21 10:35:29', '2020-06-21 10:35:29', 1, 'Segundo protocolo'),
(27, '2020-06-22 07:38:06', '2020-06-22 07:38:06', 3, 'Cuarto protocolo'),
(28, '2020-06-23 04:26:32', '2020-06-23 04:26:32', 2, 'Dolores abdominales'),
(29, '2020-07-13 00:28:24', '2020-07-13 00:28:24', 3, 'Apendisiti'),
(30, '2020-07-15 02:51:32', '2020-07-15 02:51:32', 2, 'probando'),
(31, '2020-07-15 03:00:17', '2020-07-15 03:00:17', 2, 'probando2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pruebas`
--

DROP TABLE IF EXISTS `pruebas`;
CREATE TABLE IF NOT EXISTS `pruebas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `atributo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pruebas`
--

INSERT INTO `pruebas` (`id`, `atributo`, `created_at`, `updated_at`) VALUES
(1, 'hola', NULL, NULL),
(2, 'khe', NULL, NULL),
(3, 'prr', NULL, NULL),
(4, 'nuevo', '2020-08-14 02:43:29', '2020-08-14 02:43:29'),
(5, 'nuevo', '2020-08-14 02:43:55', '2020-08-14 02:43:55'),
(6, 'nuevo', '2020-08-14 00:11:00', '2020-08-14 00:11:00'),
(7, 'nuevo', '2020-08-14 00:12:31', '2020-08-14 00:12:31'),
(8, 'nuevo', '2020-08-14 00:13:58', '2020-08-14 00:13:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `created_at`, `updated_at`, `nombre`) VALUES
(1, '2020-07-27 01:01:42', '2020-07-27 01:01:48', 'Administrador'),
(2, '2020-07-27 01:01:15', '2020-07-27 01:01:15', 'Profesional');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salas`
--

DROP TABLE IF EXISTS `salas`;
CREATE TABLE IF NOT EXISTS `salas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_area` bigint(20) UNSIGNED NOT NULL,
  `disponibilidad` tinyint(1) NOT NULL,
  `camas` int(11) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `salas_id_area_foreign` (`id_area`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `salas`
--

INSERT INTO `salas` (`id`, `created_at`, `updated_at`, `id_area`, `disponibilidad`, `camas`, `nombre`) VALUES
(1, NULL, '2020-06-22 07:01:27', 5, 1, 0, '1'),
(2, NULL, NULL, 6, 1, 0, '1'),
(3, '2020-06-22 22:16:53', '2020-06-22 22:16:53', 7, 1, 20, 'Box de varones'),
(4, '2020-06-22 22:17:31', '2020-07-08 21:58:20', 7, 1, 20, 'Box de mujeres'),
(5, '2020-06-22 23:46:05', '2020-08-05 00:35:37', 8, 0, 0, '1'),
(6, '2020-06-22 23:46:15', '2020-08-04 05:18:59', 8, 0, 0, '2'),
(7, NULL, NULL, 6, 1, 0, '2'),
(8, NULL, NULL, 6, 1, 0, '3'),
(9, '2020-08-03 02:26:01', '2020-08-04 05:18:57', 8, 1, 1, '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sintomas`
--

DROP TABLE IF EXISTS `sintomas`;
CREATE TABLE IF NOT EXISTS `sintomas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `descripcion` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sintomas`
--

INSERT INTO `sintomas` (`id`, `created_at`, `updated_at`, `descripcion`) VALUES
(1, '2020-06-21 02:29:17', '2020-06-21 02:29:17', 'Dolor en el ojo'),
(2, '2020-06-21 02:29:17', '2020-06-21 02:29:17', 'Picazon en el ojo'),
(3, '2020-06-21 06:41:05', '2020-06-21 06:41:05', 'Fiebre'),
(4, '2020-06-21 06:41:06', '2020-06-21 06:41:06', 'Dolor de cabeza'),
(5, '2020-06-21 10:35:14', '2020-06-21 10:35:14', 'dolor de estomago'),
(6, '2020-06-22 07:37:51', '2020-06-22 07:37:51', 'Dolor del corazon'),
(7, '2020-06-23 04:25:58', '2020-06-23 04:25:58', 'Nauseas'),
(9, '2020-07-13 00:27:59', '2020-07-13 00:27:59', 'dolor en el fosa iliaca derecha'),
(10, '2020-07-27 03:11:58', '2020-07-27 03:11:58', 'vómito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_rol` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_id_rol_foreign` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `id_rol`, `remember_token`, `created_at`, `updated_at`, `estado`) VALUES
(1, 'Alejandro', 'admin', 'ale368_dvs@hotmail.com', NULL, '$2y$10$QrgZh2BXR8OEJ3YlM8bNi.ybFld2T4sSYsnHpuLDb9pYFTdd/jzLm', 1, NULL, '2020-07-30 16:45:16', '2020-07-30 16:45:16', 1),
(17, 'cristian', 'cristian', 'cristian_vp_salta@hotmail.com', NULL, '$2y$10$3vsMH.mR2Teiy7ppaGuCH.ANcQlEz2QBJTYsbeLd6DGKh4xdM4UoO', 1, NULL, '2020-07-30 21:20:32', '2020-07-30 21:20:32', 1),
(18, 'probando', 'probando', 'zalazarcris96@gmail.com', NULL, '$2y$10$AS9nnU8t6cok8MRrbP2It.7c0pT860KuR4Xl6C6MOcEXB1J7kfMaS', 2, NULL, '2020-07-30 21:21:56', '2020-07-30 21:21:56', 1),
(19, 'probando2', 'probando2', 'zalazarcris97@gmail.com', NULL, '$2y$10$QFSuflwPEpWF/XBF5iGVpO/9BdHeH7urhz2OM3nZqatDmnKcoojbO', 2, NULL, '2020-07-30 22:49:29', '2020-07-30 22:49:29', 0),
(20, 'doctor', 'doctor', 'doctor@gmail.com', NULL, '$2y$10$nn1BAYzKaW4A8sHS74Ln1elh7zKpywgAhSvUuomVcwFZwDL/g0Oh.', 2, NULL, '2020-08-03 02:11:43', '2020-08-03 02:11:43', 0),
(21, 'doctor', 'doctor1', 'doctor1@gmail.com', NULL, '$2y$10$J72h4MM2h6Uk86K9PJg0cuAkjChsp5SraE5L7zNZnqOrqeuBYR8ea', 2, NULL, '2020-08-03 02:12:30', '2020-08-03 02:12:30', 0),
(22, 'doctor', 'doctor3', 'doctor2@gmail.com', NULL, '$2y$10$0f6sWA7BHcgPqK5YaE65tOGcCX0msbqyNqUEG8YPgxCgd/MjAVZjK', 2, NULL, '2020-08-03 02:14:39', '2020-08-03 02:14:39', 0),
(23, 'candela', 'candela', 'candela@gmail.com', NULL, '$2y$10$FzHAxnphNBG5u1g0V3/IZ.QAx5e8K7V0Z/lqfeMjurUjWtxEkjEDe', 2, NULL, '2020-08-03 02:18:27', '2020-08-03 02:19:03', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuario_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `usuarios_usuario_unique` (`usuario`),
  UNIQUE KEY `usuarios_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `usuario`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'borrar', 'borrar@gmail.com', NULL, '12345678', NULL, NULL, NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `atencion`
--
ALTER TABLE `atencion`
  ADD CONSTRAINT `atencion_id_procotocolo_foreign` FOREIGN KEY (`id_protocolo`) REFERENCES `protocolos` (`id`),
  ADD CONSTRAINT `atencion_paciente_id_foreign` FOREIGN KEY (`Paciente_id`) REFERENCES `pacientes` (`Paciente_id`),
  ADD CONSTRAINT `atencion_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalles_sintomas_protocolos`
--
ALTER TABLE `detalles_sintomas_protocolos`
  ADD CONSTRAINT `detalles_sintomas_protocolos_id_protocolo_foreign` FOREIGN KEY (`id_protocolo`) REFERENCES `protocolos` (`id`),
  ADD CONSTRAINT `detalles_sintomas_protocolos_id_sintoma_foreign` FOREIGN KEY (`id_sintoma`) REFERENCES `sintomas` (`id`);

--
-- Filtros para la tabla `detalle_atencion`
--
ALTER TABLE `detalle_atencion`
  ADD CONSTRAINT `detalle_atencion_id_atencion_foreign` FOREIGN KEY (`id_atencion`) REFERENCES `atencion` (`id`),
  ADD CONSTRAINT `detalle_atencion_id_det_profesional_sala_foreign` FOREIGN KEY (`id_det_profesional_sala`) REFERENCES `det_profesionales_salas` (`id`),
  ADD CONSTRAINT `detalle_atencion_id_especialidad_foreign` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidades` (`id`);

--
-- Filtros para la tabla `det_especialidad_area`
--
ALTER TABLE `det_especialidad_area`
  ADD CONSTRAINT `det_especialidad_area_id_area_foreign` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id`),
  ADD CONSTRAINT `det_especialidad_area_id_especialidad_foreign` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidades` (`id`);

--
-- Filtros para la tabla `det_profesionales`
--
ALTER TABLE `det_profesionales`
  ADD CONSTRAINT `det_profesionales_id_especialidad_foreign` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidades` (`id`),
  ADD CONSTRAINT `det_profesionales_id_profesional_foreign` FOREIGN KEY (`id_profesional`) REFERENCES `profesionales` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `det_profesionales_salas`
--
ALTER TABLE `det_profesionales_salas`
  ADD CONSTRAINT `det_profesionales_salas_id_profesional_foreign` FOREIGN KEY (`id_profesional`) REFERENCES `profesionales` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `det_profesionales_salas_id_sala_foreign` FOREIGN KEY (`id_sala`) REFERENCES `salas` (`id`);

--
-- Filtros para la tabla `det_protocolos`
--
ALTER TABLE `det_protocolos`
  ADD CONSTRAINT `det_protocolos_id_protocolo_foreign` FOREIGN KEY (`id_protocolo`) REFERENCES `protocolos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `historial_id_cie_foreign` FOREIGN KEY (`id_cie`) REFERENCES `cie` (`id`),
  ADD CONSTRAINT `historial_id_detalle_atencion_foreign` FOREIGN KEY (`id_detalle_atencion`) REFERENCES `detalle_atencion` (`id`);

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `preguntas_id_atencion_foreign` FOREIGN KEY (`id_atencion`) REFERENCES `atencion` (`id`),
  ADD CONSTRAINT `preguntas_id_sintoma_foreign` FOREIGN KEY (`id_sintoma`) REFERENCES `sintomas` (`id`);

--
-- Filtros para la tabla `profesionales`
--
ALTER TABLE `profesionales`
  ADD CONSTRAINT `profesionales_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `profesionales_horarios`
--
ALTER TABLE `profesionales_horarios`
  ADD CONSTRAINT `profesionales_horarios_id_profesional_foreign` FOREIGN KEY (`id_profesional`) REFERENCES `profesionales` (`id`);

--
-- Filtros para la tabla `protocolos`
--
ALTER TABLE `protocolos`
  ADD CONSTRAINT `protocolos_id_codigo_triage_foreign` FOREIGN KEY (`id_codigo_triage`) REFERENCES `codigostriage` (`id`);

--
-- Filtros para la tabla `salas`
--
ALTER TABLE `salas`
  ADD CONSTRAINT `salas_id_area_foreign` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_rol_foreign` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
