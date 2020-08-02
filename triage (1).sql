-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 30-07-2020 a las 20:00:59
-- Versión del servidor: 5.7.30-0ubuntu0.18.04.1
-- Versión de PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Estructura de tabla para la tabla `Areas`
--

CREATE TABLE `Areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipo_dato` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Areas`
--

INSERT INTO `Areas` (`id`, `created_at`, `updated_at`, `tipo_dato`) VALUES
(5, NULL, NULL, 'Consultorio Externo'),
(6, NULL, NULL, 'Consultorio ambulatorio'),
(7, '2020-06-22 22:16:35', '2020-06-22 22:16:35', 'Internacion'),
(8, '2020-06-22 23:45:48', '2020-06-22 23:45:48', 'Quirofano');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Atencion`
--

CREATE TABLE `Atencion` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `id_protocolo` bigint(20) UNSIGNED DEFAULT NULL,
  `Paciente_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Atencion`
--

INSERT INTO `Atencion` (`id`, `created_at`, `updated_at`, `usuario_id`, `id_protocolo`, `Paciente_id`) VALUES
(32, '2020-06-21 09:03:42', '2020-06-21 09:04:30', 1, 25, 1),
(33, '2020-06-21 10:33:17', '2020-06-21 10:33:18', 1, 24, 1),
(34, '2020-06-21 10:35:43', '2020-06-21 10:35:44', 1, 26, 3),
(35, '2020-06-22 04:14:43', '2020-06-22 04:14:44', 1, 24, 1),
(36, '2020-06-22 04:36:18', '2020-06-22 04:36:18', 1, NULL, 3),
(37, '2020-06-22 04:36:34', '2020-06-22 04:36:35', 1, 25, 3),
(38, '2020-06-22 04:40:42', '2020-06-22 04:40:43', 1, 25, 3),
(39, '2020-06-22 04:59:31', '2020-06-22 04:59:31', 1, 25, 1),
(40, '2020-06-22 05:04:47', '2020-06-22 05:04:47', 1, 24, 1),
(41, '2020-06-22 05:12:14', '2020-06-22 05:12:15', 1, 24, 3),
(42, '2020-06-22 06:31:37', '2020-06-22 06:31:37', 1, 25, 1),
(43, '2020-06-22 06:41:34', '2020-06-22 06:41:34', 1, 24, 1),
(44, '2020-06-22 06:50:49', '2020-06-22 06:50:50', 1, 25, 1),
(45, '2020-06-22 07:38:22', '2020-06-22 07:38:22', 1, 27, 4),
(46, '2020-06-22 07:42:08', '2020-06-22 07:42:08', 1, 27, 6),
(47, '2020-06-22 07:51:42', '2020-06-22 07:51:43', 1, 24, 1),
(48, '2020-06-22 07:52:13', '2020-06-22 07:52:14', 1, 27, 3),
(49, '2020-06-22 07:53:01', '2020-06-22 07:53:02', 1, 25, 7),
(50, '2020-06-22 07:53:33', '2020-06-22 07:53:34', 1, 27, 6),
(51, '2020-06-22 09:46:35', '2020-06-22 09:46:35', 1, 24, 4),
(52, '2020-06-22 22:06:27', '2020-06-22 22:06:28', 1, 27, 1),
(53, '2020-06-22 22:52:49', '2020-06-22 22:52:50', 1, 27, 3),
(54, '2020-06-22 23:34:54', '2020-06-22 23:34:54', 1, 27, 1),
(55, '2020-06-22 23:35:24', '2020-06-22 23:35:24', 1, 25, 3),
(56, '2020-06-22 23:55:36', '2020-06-22 23:55:36', 1, 27, 6),
(57, '2020-06-22 23:59:35', '2020-06-22 23:59:35', 1, 27, 7),
(58, '2020-06-23 00:18:49', '2020-06-23 00:18:50', 1, 27, 1),
(59, '2020-06-23 00:19:03', '2020-06-23 00:19:03', 1, 27, 3),
(60, '2020-06-23 00:37:37', '2020-06-23 00:37:37', 1, 27, 4),
(61, '2020-06-23 00:53:54', '2020-06-23 00:53:55', 1, 25, 3),
(62, '2020-06-23 00:56:39', '2020-06-23 00:56:39', 1, 27, 5),
(63, '2020-06-23 01:00:51', '2020-06-23 01:00:51', 1, 27, 4),
(64, '2020-06-23 01:52:24', '2020-06-23 01:52:25', 1, 27, 1),
(65, '2020-06-23 02:17:44', '2020-06-23 02:17:45', 1, 24, 5),
(66, '2020-06-23 02:18:14', '2020-06-23 02:18:15', 1, 25, 3),
(67, '2020-06-23 02:18:42', '2020-06-23 02:18:43', 1, 27, 1),
(68, '2020-06-23 03:58:59', '2020-06-23 03:59:01', 1, 24, 5),
(69, '2020-06-23 03:59:25', '2020-06-23 03:59:26', 1, 25, 1),
(70, '2020-06-23 03:59:51', '2020-06-23 03:59:51', 1, 27, 3),
(71, '2020-06-23 04:15:46', '2020-06-23 04:15:47', 1, 24, 5),
(72, '2020-06-23 04:16:10', '2020-06-23 04:16:11', 1, 25, 1),
(73, '2020-06-23 04:16:34', '2020-06-23 04:16:34', 1, 27, 3),
(74, '2020-06-23 04:21:37', '2020-06-23 04:21:38', 1, 24, 5),
(75, '2020-06-23 04:22:01', '2020-06-23 04:22:02', 1, 27, 1),
(76, '2020-06-23 04:22:31', '2020-06-23 04:22:31', 1, 25, 3),
(77, '2020-06-29 01:32:19', '2020-06-29 01:32:20', 1, 24, 1),
(78, '2020-06-29 01:34:35', '2020-06-29 01:34:35', 1, 27, 1),
(79, '2020-06-29 02:05:30', '2020-06-29 02:05:31', 1, 27, 3),
(80, '2020-06-29 02:26:44', '2020-06-29 02:26:45', 1, 25, 5),
(81, '2020-07-03 16:58:25', '2020-07-03 16:58:26', 1, 24, 1),
(82, '2020-07-03 16:58:52', '2020-07-03 16:58:52', 1, 27, 3),
(83, '2020-07-08 08:36:37', '2020-07-08 08:36:38', 1, 27, 1),
(84, '2020-07-08 09:32:48', '2020-07-08 09:32:48', 1, NULL, 3),
(85, '2020-07-08 09:33:00', '2020-07-08 09:33:00', 1, 25, 3),
(86, '2020-07-08 22:01:36', '2020-07-08 22:01:36', 1, 24, 4),
(87, '2020-07-13 00:18:52', '2020-07-13 00:18:53', 1, 27, 5),
(88, '2020-07-13 00:29:03', '2020-07-13 00:29:03', 1, 29, 5),
(89, '2020-07-13 00:29:33', '2020-07-13 00:29:34', 1, 27, 5),
(90, '2020-07-13 00:39:08', '2020-07-13 00:39:09', 1, 24, 1),
(91, '2020-07-13 03:19:09', '2020-07-13 03:19:10', 1, 24, 1),
(92, '2020-07-13 03:20:54', '2020-07-13 03:20:54', 1, 27, 5),
(93, '2020-07-15 03:00:26', '2020-07-15 03:00:27', 1, 31, 1),
(94, '2020-07-15 03:03:06', '2020-07-15 03:03:06', 1, 26, 1),
(95, '2020-07-15 03:04:21', '2020-07-15 03:04:22', 1, 26, 1),
(96, '2020-07-15 22:27:22', '2020-07-15 22:27:22', 1, 27, 3),
(97, '2020-07-15 23:01:43', '2020-07-15 23:01:43', 1, 31, 1),
(98, '2020-07-19 00:38:57', '2020-07-19 00:38:57', 1, 27, 1),
(99, '2020-07-19 00:58:59', '2020-07-19 00:58:59', 1, 31, 4),
(100, '2020-07-18 23:00:51', '2020-07-18 23:00:51', 1, NULL, 8),
(101, '2020-07-18 23:02:28', '2020-07-18 23:02:28', 1, NULL, 9),
(102, '2020-07-18 23:02:49', '2020-07-18 23:02:49', 1, NULL, 10),
(103, '2020-07-18 23:03:08', '2020-07-18 23:03:08', 1, NULL, 11),
(104, '2020-07-18 23:03:59', '2020-07-18 23:03:59', 1, NULL, 12),
(105, '2020-07-18 23:04:43', '2020-07-18 23:04:43', 1, NULL, 13),
(106, '2020-07-18 23:07:31', '2020-07-18 23:07:31', 1, NULL, 14),
(107, '2020-07-20 08:26:51', '2020-07-20 08:26:51', 1, NULL, 15),
(108, '2020-07-20 08:30:36', '2020-07-20 08:30:36', 1, NULL, 16),
(109, '2020-07-20 08:38:31', '2020-07-20 08:38:31', 1, NULL, 17),
(110, '2020-07-20 08:40:17', '2020-07-20 08:40:17', 1, NULL, 18),
(111, '2020-07-20 08:41:45', '2020-07-20 08:41:45', 1, NULL, 19),
(112, '2020-07-20 08:42:55', '2020-07-20 08:42:55', 1, NULL, 20),
(113, '2020-07-20 08:55:57', '2020-07-20 08:55:57', 1, NULL, 21),
(114, '2020-07-23 00:09:24', '2020-07-23 00:09:25', 1, 31, 22),
(115, '2020-07-22 21:14:56', '2020-07-22 21:14:56', 1, NULL, 23),
(116, '2020-07-25 21:25:57', '2020-07-25 21:25:57', 1, NULL, 24),
(117, '2020-07-26 00:26:38', '2020-07-26 00:26:39', 1, 27, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cie`
--

CREATE TABLE `cie` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Estructura de tabla para la tabla `CodigosTriage`
--

CREATE TABLE `CodigosTriage` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `color` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tiempo_espera` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `CodigosTriage`
--

INSERT INTO `CodigosTriage` (`id`, `created_at`, `updated_at`, `color`, `tiempo_espera`) VALUES
(1, NULL, NULL, 'verde', '120 min'),
(2, NULL, NULL, 'amarillo', '30 min'),
(3, NULL, NULL, 'rojo', '10 min');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Detalles_Sintomas_Protocolos`
--

CREATE TABLE `Detalles_Sintomas_Protocolos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_protocolo` bigint(20) UNSIGNED NOT NULL,
  `id_sintoma` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Detalles_Sintomas_Protocolos`
--

INSERT INTO `Detalles_Sintomas_Protocolos` (`id`, `created_at`, `updated_at`, `id_protocolo`, `id_sintoma`) VALUES
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

CREATE TABLE `detalle_atencion` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_atencion` bigint(20) UNSIGNED NOT NULL,
  `id_det_profesional_sala` bigint(20) UNSIGNED DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_especialidad` bigint(20) UNSIGNED NOT NULL,
  `atendido` tinyint(1) NOT NULL,
  `estado` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_codigo_triage` bigint(20) UNSIGNED DEFAULT NULL,
  `sala` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operar` tinyint(1) NOT NULL DEFAULT '0',
  `respuestas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_atencion`
--

INSERT INTO `detalle_atencion` (`id`, `created_at`, `updated_at`, `id_atencion`, `id_det_profesional_sala`, `fecha`, `hora`, `id_especialidad`, `atendido`, `estado`, `id_codigo_triage`, `sala`, `operar`, `respuestas`) VALUES
(84, '2020-06-23 01:21:38', '2020-06-23 01:21:38', 74, NULL, '2020-06-22', '22:21', 5, 0, 'consulta', 1, NULL, 0, NULL),
(85, '2020-06-23 01:22:02', '2020-06-23 01:25:11', 75, NULL, '2020-06-22', '22:25', 7, 0, 'Operado', 2, '1', 0, NULL),
(86, '2020-06-23 01:22:32', '2020-06-23 01:24:52', 76, NULL, '2020-06-22', '22:24', 6, 0, 'Internado', 3, 'Box de varones', 0, NULL),
(88, '2020-06-28 22:34:36', '2020-06-28 22:52:33', 78, NULL, '2020-06-28', '19:52', 7, 0, 'Internado', 2, 'Box de varones', 0, NULL),
(89, '2020-06-28 23:05:31', '2020-06-28 23:06:03', 79, NULL, '2020-06-28', '20:06', 7, 0, 'Operar', 1, NULL, 0, NULL),
(90, '2020-06-28 23:26:45', '2020-06-28 23:26:45', 80, NULL, '2020-06-28', '20:26', 6, 0, 'consulta', 2, NULL, 0, NULL),
(91, '2020-07-03 13:58:27', '2020-07-03 13:58:27', 81, NULL, '2020-07-03', '10:58', 5, 0, 'consulta', 1, NULL, 0, NULL),
(92, '2020-07-03 13:58:53', '2020-07-03 13:58:53', 82, NULL, '2020-07-03', '10:58', 7, 0, 'consulta', 3, NULL, 0, NULL),
(93, '2020-07-08 05:36:38', '2020-07-08 18:59:20', 83, NULL, '2020-07-08', '15:59', 7, 0, 'Operado', 2, '1', 0, NULL),
(94, '2020-07-08 06:33:00', '2020-07-08 18:59:45', 85, NULL, '2020-07-08', '15:59', 6, 0, 'Internado', 3, 'Box de varones', 0, NULL),
(95, '2020-07-08 19:01:37', '2020-07-08 19:01:37', 86, NULL, '2020-07-08', '16:01', 5, 0, 'consulta', 1, NULL, 0, NULL),
(96, '2020-07-12 21:18:54', '2020-07-12 21:20:26', 87, NULL, '2020-07-12', '18:20', 7, 0, NULL, 1, NULL, 0, NULL),
(97, '2020-07-12 21:29:34', '2020-07-12 21:30:59', 89, NULL, '2020-07-12', '18:30', 7, 0, 'Internado', 3, 'Box de varones', 0, NULL),
(98, '2020-07-12 21:39:10', '2020-07-13 00:39:00', 90, NULL, '2020-07-12', '21:39', 5, 0, 'Internado', 3, 'Box de varones', 0, NULL),
(99, '2020-07-13 00:19:10', '2020-07-13 00:45:07', 91, NULL, '2020-07-12', '21:45', 5, 0, 'Operado', 1, '2', 0, NULL),
(100, '2020-07-13 00:20:55', '2020-07-13 00:21:14', 92, NULL, '2020-07-12', '21:21', 7, 0, 'Operar', 1, NULL, 0, NULL),
(102, '2020-07-15 00:08:39', '2020-07-15 00:08:39', 95, NULL, '2020-07-14', '21:08', 6, 0, 'consulta', 1, NULL, 0, NULL),
(103, '2020-07-15 19:27:23', '2020-07-15 19:27:23', 96, NULL, '2020-07-15', '16:27', 7, 0, 'consulta', 3, NULL, 0, NULL),
(105, '2020-07-18 21:38:58', '2020-07-18 21:58:36', 98, NULL, '2020-07-18', '18:58', 7, 1, 'Internar', 2, NULL, 1, 'asdasd'),
(106, '2020-07-18 21:58:59', '2020-07-18 21:59:17', 99, NULL, '2020-07-18', '18:59', 6, 1, 'alta', 3, NULL, 0, '13113311312'),
(108, '2020-07-18 23:03:59', '2020-07-18 23:03:59', 104, NULL, '2020-07-18', '20:03', 5, 0, 'Internar', 2, NULL, 1, NULL),
(109, '2020-07-18 23:04:43', '2020-07-18 23:04:43', 105, NULL, '2020-07-18', '20:04', 5, 0, 'Internar', 2, NULL, 1, NULL),
(110, '2020-07-18 23:07:31', '2020-07-18 23:07:31', 106, NULL, '2020-07-18', '20:07', 5, 0, 'Operar', 1, NULL, 0, NULL),
(111, '2020-07-20 08:26:52', '2020-07-20 08:26:52', 107, NULL, '2020-07-20', '05:26', 5, 0, 'Operar', 1, NULL, 0, NULL),
(112, '2020-07-20 08:30:36', '2020-07-20 08:30:36', 108, NULL, '2020-07-20', '05:30', 5, 0, 'Operar', 1, NULL, 0, NULL),
(113, '2020-07-20 08:38:31', '2020-07-20 08:38:31', 109, NULL, '2020-07-20', '05:38', 5, 0, 'Operar', 3, NULL, 0, NULL),
(114, '2020-07-20 08:40:17', '2020-07-20 08:40:33', 110, NULL, '2020-07-20', '05:40', 5, 0, 'Internado', 2, 'Box de varones', 0, NULL),
(115, '2020-07-20 08:41:45', '2020-07-20 08:41:45', 111, NULL, '2020-07-20', '05:41', 5, 0, 'Internar', 3, NULL, 1, NULL),
(116, '2020-07-20 08:42:55', '2020-07-20 08:42:55', 112, NULL, '2020-07-20', '05:42', 5, 0, 'Operar', 1, NULL, 0, NULL),
(117, '2020-07-20 08:55:57', '2020-07-20 08:55:57', 113, NULL, '2020-07-20', '05:55', 5, 0, 'Operar', 1, NULL, 0, NULL),
(118, '2020-07-22 21:09:26', '2020-07-22 21:13:32', 114, NULL, '2020-07-22', '18:13', 6, 1, 'Operado', 3, '1', 0, 'Interrogatorio 1\r\n123\r\nanalisi de orina : slioa'),
(119, '2020-07-22 21:14:56', '2020-07-22 21:14:56', 115, NULL, '2020-07-22', '18:14', 5, 0, 'Internar', 2, NULL, 0, NULL),
(120, '2020-07-25 21:25:57', '2020-07-25 21:26:24', 116, NULL, '2020-07-25', '18:26', 5, 0, 'Internado', 2, 'Box de varones', 0, NULL),
(121, '2020-07-25 21:26:39', '2020-07-25 21:28:18', 117, NULL, '2020-07-25', '18:28', 7, 1, 'Internado', 2, 'Box de varones', 1, 'dasda\r\nanalisis');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_especialidad_area`
--

CREATE TABLE `det_especialidad_area` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_especialidad` bigint(20) UNSIGNED NOT NULL,
  `id_area` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `det_profesionales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_profesional` bigint(20) UNSIGNED NOT NULL,
  `id_especialidad` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_profesionales_salas`
--

CREATE TABLE `det_profesionales_salas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_profesional` bigint(20) UNSIGNED NOT NULL,
  `id_sala` bigint(20) UNSIGNED NOT NULL,
  `disponibilidad` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_protocolos`
--

CREATE TABLE `det_protocolos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_especialidad` bigint(20) UNSIGNED NOT NULL,
  `id_protocolo` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Estructura de tabla para la tabla `Especialidades`
--

CREATE TABLE `Especialidades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Especialidades`
--

INSERT INTO `Especialidades` (`id`, `created_at`, `updated_at`, `nombre`, `descripcion`) VALUES
(5, NULL, '2020-07-15 04:00:26', 'Oftalmologia', 'Problemas de ojos'),
(6, NULL, '2020-07-15 04:22:09', 'Clinico', '1234'),
(7, NULL, NULL, 'Cardiologia', 'asda'),
(8, '2020-07-15 03:44:45', '2020-07-15 03:44:45', 'Traumatologia', 'Dolores de espalda, huesos,etc'),
(9, '2020-07-15 04:10:30', '2020-07-15 04:10:30', 'Cirugia General', 'Se encarga de tal....');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_cie` bigint(20) UNSIGNED DEFAULT NULL,
  `descripcion` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `id_detalle_atencion` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id`, `created_at`, `updated_at`, `id_cie`, `descripcion`, `fecha`, `hora`, `id_detalle_atencion`) VALUES
(36, '2020-06-23 01:23:50', '2020-06-23 01:23:50', 3, 'Observacion del medico, caso de operar indicar porque especilidad debe atenderse', '2020-06-22', '22:23:00', 85),
(37, '2020-06-23 01:24:28', '2020-06-23 01:24:28', 2, 'Observacion del medico', '2020-06-22', '22:24:00', 86),
(38, '2020-06-28 22:52:05', '2020-06-28 22:52:05', 1, 'Observacion', '2020-06-28', '19:52:00', 88),
(39, '2020-06-28 23:06:03', '2020-06-28 23:06:03', 1, 'asda', '2020-06-28', '20:06:00', 89),
(40, '2020-07-08 05:37:59', '2020-07-08 05:37:59', 4, 'sd', '2020-07-08', '02:37:00', 93),
(41, '2020-07-08 06:33:18', '2020-07-08 06:33:18', 4, 'asd', '2020-07-08', '03:33:00', 94),
(42, '2020-07-12 21:30:40', '2020-07-12 21:30:40', 5, 'Para operar de apendisiti', '2020-07-12', '18:30:00', 97),
(43, '2020-07-13 00:17:07', '2020-07-13 00:17:07', 1, 'qwdqweq', '2020-07-12', '21:17:00', 98),
(44, '2020-07-13 00:19:42', '2020-07-13 00:19:42', 1, 'asd', '2020-07-12', '21:19:00', 99),
(45, '2020-07-13 00:20:04', '2020-07-13 00:20:04', 1, 'asd', '2020-07-12', '21:20:00', 99),
(46, '2020-07-13 00:20:07', '2020-07-13 00:20:07', 1, 'asd', '2020-07-12', '21:20:00', 99),
(47, '2020-07-13 00:20:18', '2020-07-13 00:20:18', 1, 'asd', '2020-07-12', '21:20:00', 99),
(48, '2020-07-13 00:20:32', '2020-07-13 00:20:32', 1, 'asd', '2020-07-12', '21:20:00', 99),
(49, '2020-07-13 00:21:14', '2020-07-13 00:21:14', 1, 'asdasd', '2020-07-12', '21:21:00', 100),
(50, '2020-07-18 21:58:36', '2020-07-18 21:58:36', 1, 'asdasd', '2020-07-18', '18:58:00', 105),
(51, '2020-07-18 21:59:17', '2020-07-18 21:59:17', 4, 'qweqweqwe', '2020-07-18', '18:59:00', 106),
(52, '2020-07-18 23:04:43', '2020-07-18 23:04:43', NULL, 'Traumatismo', '2020-07-18', '20:04:00', 109),
(53, '2020-07-18 23:07:31', '2020-07-18 23:07:31', NULL, 'probando traumastimo', '2020-07-18', '20:07:00', 110),
(54, '2020-07-20 08:38:31', '2020-07-20 08:38:31', 2, 'Probando', '2020-07-20', '05:38:00', 113),
(55, '2020-07-20 08:40:17', '2020-07-20 08:40:17', 2, 'Dengue', '2020-07-20', '05:40:00', 114),
(56, '2020-07-20 08:41:45', '2020-07-20 08:41:45', 1, 'asd', '2020-07-20', '05:41:00', 115),
(57, '2020-07-20 08:42:55', '2020-07-20 08:42:55', 6, 'asda', '2020-07-20', '05:42:00', 116),
(58, '2020-07-20 08:55:57', '2020-07-20 08:55:57', 4, 'asd', '2020-07-20', '05:55:00', 117),
(59, '2020-07-22 21:12:15', '2020-07-22 21:12:15', 4, 'Debe sr atendio inmediamte. ...', '2020-07-22', '18:12:00', 118),
(60, '2020-07-22 21:14:56', '2020-07-22 21:14:56', 7, 'golpe en la cabeza...', '2020-07-22', '18:14:00', 119),
(61, '2020-07-25 21:25:57', '2020-07-25 21:25:57', 7, 'asdasda', '2020-07-25', '18:25:00', 120),
(62, '2020-07-25 21:28:00', '2020-07-25 21:28:00', 1, 'asdas', '2020-07-25', '18:28:00', 121);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(40, '2020_07_30_163553_edit_foreign_key_from_det_profesionales_salas', 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pacientes`
--

CREATE TABLE `Pacientes` (
  `Paciente_id` bigint(20) UNSIGNED NOT NULL,
  `dni` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechaNac` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domicilio` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Pacientes`
--

INSERT INTO `Pacientes` (`Paciente_id`, `dni`, `nombre`, `apellido`, `telefono`, `fechaNac`, `sexo`, `created_at`, `updated_at`, `domicilio`) VALUES
(1, 37190827, 'Alejandro', 'Gonzales', '156158339', '20/11/1992', 'Masculino', '2020-06-08 19:08:45', '2020-06-08 19:08:45', NULL),
(3, 45678900, 'Cristian', 'Zalazar', '5678', '01/01/1995', 'Masculino', '2020-06-18 21:58:57', '2020-06-18 21:58:57', NULL),
(4, 39590140, 'Juan', 'Perez', '12341234', '1996/11/03', 'Masculino', '2020-06-19 02:18:17', '2020-06-19 02:18:17', NULL),
(5, 25063824, 'Elena', 'Zalazar', '3875154444', '2000/03/11', 'Femenino', '2020-06-21 02:24:55', '2020-06-21 02:24:55', 'Coronel vidt 2250'),
(6, 39590141, 'Cristian', 'Ven', '3875154444', '2010/03/11', 'Masculino', '2020-06-21 02:26:56', '2020-06-21 02:26:56', 'Coronel vidt 2250'),
(7, 39590143, 'test', 'test', '3875154444', '10/20/1996', 'Masculino', '2020-06-21 02:51:21', '2020-06-21 02:51:21', 'Coronel vidt 2250'),
(8, 0, 'nn', 'nn', '1', '2020-07-18', 'Masculino', '2020-07-18 23:00:51', '2020-07-18 23:00:51', 'nn'),
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
(22, 42815935, 'Candela', 'Cardozo', '112312312', '2010/03/11', 'Femenino', '2020-07-23 00:08:58', '2020-07-23 00:08:58', 'limache'),
(23, 0, 'nn', 'nn', '1', '2020-07-22', 'Masculino', '2020-07-22 21:14:56', '2020-07-22 21:14:56', 'nn'),
(24, 0, 'nn', 'nn', '1', '2020-07-25', 'Masculino', '2020-07-25 21:25:57', '2020-07-25 21:25:57', 'nn');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_atencion` bigint(20) UNSIGNED NOT NULL,
  `id_sintoma` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `created_at`, `updated_at`, `id_atencion`, `id_sintoma`) VALUES
(30, '2020-06-21 09:03:43', '2020-06-21 09:03:43', 32, 4),
(31, '2020-06-21 09:03:43', '2020-06-21 09:03:43', 32, 3),
(32, '2020-06-21 10:33:18', '2020-06-21 10:33:18', 33, 1),
(33, '2020-06-21 10:33:18', '2020-06-21 10:33:18', 33, 2),
(34, '2020-06-21 10:35:43', '2020-06-21 10:35:43', 34, 5),
(35, '2020-06-22 04:14:43', '2020-06-22 04:14:43', 35, 2),
(36, '2020-06-22 04:14:43', '2020-06-22 04:14:43', 35, 1),
(37, '2020-06-22 04:36:18', '2020-06-22 04:36:18', 36, 4),
(38, '2020-06-22 04:36:18', '2020-06-22 04:36:18', 36, 5),
(39, '2020-06-22 04:36:34', '2020-06-22 04:36:34', 37, 4),
(40, '2020-06-22 04:36:34', '2020-06-22 04:36:34', 37, 3),
(41, '2020-06-22 04:40:42', '2020-06-22 04:40:42', 38, 4),
(42, '2020-06-22 04:40:43', '2020-06-22 04:40:43', 38, 3),
(43, '2020-06-22 04:59:31', '2020-06-22 04:59:31', 39, 4),
(44, '2020-06-22 04:59:31', '2020-06-22 04:59:31', 39, 3),
(45, '2020-06-22 05:04:47', '2020-06-22 05:04:47', 40, 1),
(46, '2020-06-22 05:04:47', '2020-06-22 05:04:47', 40, 2),
(47, '2020-06-22 05:12:14', '2020-06-22 05:12:14', 41, 2),
(48, '2020-06-22 05:12:14', '2020-06-22 05:12:14', 41, 1),
(49, '2020-06-22 06:31:37', '2020-06-22 06:31:37', 42, 4),
(50, '2020-06-22 06:31:37', '2020-06-22 06:31:37', 42, 3),
(51, '2020-06-22 06:41:34', '2020-06-22 06:41:34', 43, 2),
(52, '2020-06-22 06:41:34', '2020-06-22 06:41:34', 43, 1),
(53, '2020-06-22 06:50:50', '2020-06-22 06:50:50', 44, 4),
(54, '2020-06-22 06:50:50', '2020-06-22 06:50:50', 44, 3),
(55, '2020-06-22 07:38:22', '2020-06-22 07:38:22', 45, 6),
(56, '2020-06-22 07:42:08', '2020-06-22 07:42:08', 46, 6),
(57, '2020-06-22 07:51:42', '2020-06-22 07:51:42', 47, 2),
(58, '2020-06-22 07:51:42', '2020-06-22 07:51:42', 47, 1),
(59, '2020-06-22 07:52:13', '2020-06-22 07:52:13', 48, 6),
(60, '2020-06-22 07:53:01', '2020-06-22 07:53:01', 49, 4),
(61, '2020-06-22 07:53:02', '2020-06-22 07:53:02', 49, 3),
(62, '2020-06-22 07:53:33', '2020-06-22 07:53:33', 50, 6),
(63, '2020-06-22 09:46:35', '2020-06-22 09:46:35', 51, 1),
(64, '2020-06-22 09:46:35', '2020-06-22 09:46:35', 51, 2),
(65, '2020-06-22 22:06:27', '2020-06-22 22:06:27', 52, 6),
(66, '2020-06-22 22:52:49', '2020-06-22 22:52:49', 53, 6),
(67, '2020-06-22 23:34:54', '2020-06-22 23:34:54', 54, 6),
(68, '2020-06-22 23:35:24', '2020-06-22 23:35:24', 55, 4),
(69, '2020-06-22 23:35:24', '2020-06-22 23:35:24', 55, 3),
(70, '2020-06-22 23:55:36', '2020-06-22 23:55:36', 56, 6),
(71, '2020-06-22 23:59:35', '2020-06-22 23:59:35', 57, 6),
(72, '2020-06-23 00:18:49', '2020-06-23 00:18:49', 58, 6),
(73, '2020-06-23 00:19:03', '2020-06-23 00:19:03', 59, 6),
(74, '2020-06-23 00:37:37', '2020-06-23 00:37:37', 60, 6),
(75, '2020-06-23 00:53:54', '2020-06-23 00:53:54', 61, 4),
(76, '2020-06-23 00:53:54', '2020-06-23 00:53:54', 61, 3),
(77, '2020-06-23 00:56:39', '2020-06-23 00:56:39', 62, 6),
(78, '2020-06-23 01:00:51', '2020-06-23 01:00:51', 63, 6),
(79, '2020-06-23 01:52:24', '2020-06-23 01:52:24', 64, 6),
(80, '2020-06-23 02:17:44', '2020-06-23 02:17:44', 65, 2),
(81, '2020-06-23 02:17:44', '2020-06-23 02:17:44', 65, 1),
(82, '2020-06-23 02:18:14', '2020-06-23 02:18:14', 66, 4),
(83, '2020-06-23 02:18:14', '2020-06-23 02:18:14', 66, 3),
(84, '2020-06-23 02:18:42', '2020-06-23 02:18:42', 67, 6),
(85, '2020-06-23 03:59:00', '2020-06-23 03:59:00', 68, 2),
(86, '2020-06-23 03:59:00', '2020-06-23 03:59:00', 68, 1),
(87, '2020-06-23 03:59:25', '2020-06-23 03:59:25', 69, 4),
(88, '2020-06-23 03:59:25', '2020-06-23 03:59:25', 69, 3),
(89, '2020-06-23 03:59:51', '2020-06-23 03:59:51', 70, 6),
(90, '2020-06-23 04:15:46', '2020-06-23 04:15:46', 71, 1),
(91, '2020-06-23 04:15:46', '2020-06-23 04:15:46', 71, 2),
(92, '2020-06-23 04:16:11', '2020-06-23 04:16:11', 72, 4),
(93, '2020-06-23 04:16:11', '2020-06-23 04:16:11', 72, 3),
(94, '2020-06-23 04:16:34', '2020-06-23 04:16:34', 73, 6),
(95, '2020-06-23 04:21:37', '2020-06-23 04:21:37', 74, 1),
(96, '2020-06-23 04:21:37', '2020-06-23 04:21:37', 74, 2),
(97, '2020-06-23 04:22:01', '2020-06-23 04:22:01', 75, 6),
(98, '2020-06-23 04:22:31', '2020-06-23 04:22:31', 76, 4),
(99, '2020-06-23 04:22:31', '2020-06-23 04:22:31', 76, 3),
(100, '2020-06-29 01:32:19', '2020-06-29 01:32:19', 77, 2),
(101, '2020-06-29 01:32:19', '2020-06-29 01:32:19', 77, 1),
(102, '2020-06-29 01:34:35', '2020-06-29 01:34:35', 78, 6),
(103, '2020-06-29 02:05:31', '2020-06-29 02:05:31', 79, 6),
(104, '2020-06-29 02:26:45', '2020-06-29 02:26:45', 80, 4),
(105, '2020-06-29 02:26:45', '2020-06-29 02:26:45', 80, 3),
(106, '2020-07-03 16:58:25', '2020-07-03 16:58:25', 81, 1),
(107, '2020-07-03 16:58:25', '2020-07-03 16:58:25', 81, 2),
(108, '2020-07-03 16:58:52', '2020-07-03 16:58:52', 82, 6),
(109, '2020-07-08 08:36:38', '2020-07-08 08:36:38', 83, 6),
(110, '2020-07-08 09:32:48', '2020-07-08 09:32:48', 84, 3),
(111, '2020-07-08 09:33:00', '2020-07-08 09:33:00', 85, 3),
(112, '2020-07-08 09:33:00', '2020-07-08 09:33:00', 85, 4),
(113, '2020-07-08 22:01:36', '2020-07-08 22:01:36', 86, 1),
(114, '2020-07-08 22:01:36', '2020-07-08 22:01:36', 86, 2),
(115, '2020-07-13 00:18:52', '2020-07-13 00:18:52', 87, 6),
(116, '2020-07-13 00:29:03', '2020-07-13 00:29:03', 88, 9),
(117, '2020-07-13 00:29:03', '2020-07-13 00:29:03', 88, 7),
(118, '2020-07-13 00:29:33', '2020-07-13 00:29:33', 89, 6),
(119, '2020-07-13 00:39:09', '2020-07-13 00:39:09', 90, 1),
(120, '2020-07-13 00:39:09', '2020-07-13 00:39:09', 90, 2),
(121, '2020-07-13 03:19:09', '2020-07-13 03:19:09', 91, 1),
(122, '2020-07-13 03:19:09', '2020-07-13 03:19:09', 91, 2),
(123, '2020-07-13 03:20:54', '2020-07-13 03:20:54', 92, 6),
(124, '2020-07-15 03:00:26', '2020-07-15 03:00:26', 93, 3),
(125, '2020-07-15 03:03:06', '2020-07-15 03:03:06', 94, 5),
(126, '2020-07-15 03:04:21', '2020-07-15 03:04:21', 95, 5),
(127, '2020-07-15 22:27:22', '2020-07-15 22:27:22', 96, 6),
(128, '2020-07-15 23:01:43', '2020-07-15 23:01:43', 97, 3),
(129, '2020-07-19 00:38:57', '2020-07-19 00:38:57', 98, 6),
(130, '2020-07-19 00:58:59', '2020-07-19 00:58:59', 99, 3),
(131, '2020-07-23 00:09:24', '2020-07-23 00:09:24', 114, 3),
(132, '2020-07-26 00:26:38', '2020-07-26 00:26:38', 117, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesionales`
--

CREATE TABLE `profesionales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `matricula` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domicilio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disponibilidad` tinyint(1) NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesionales_horarios`
--

CREATE TABLE `profesionales_horarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_profesional` bigint(20) UNSIGNED NOT NULL,
  `hr_ini` time NOT NULL,
  `hr_fin` time NOT NULL,
  `dia` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Protocolos`
--

CREATE TABLE `Protocolos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_codigo_triage` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Protocolos`
--

INSERT INTO `Protocolos` (`id`, `created_at`, `updated_at`, `id_codigo_triage`, `descripcion`) VALUES
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
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `salas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_area` bigint(20) UNSIGNED NOT NULL,
  `disponibilidad` tinyint(1) NOT NULL,
  `camas` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `salas`
--

INSERT INTO `salas` (`id`, `created_at`, `updated_at`, `id_area`, `disponibilidad`, `camas`, `nombre`) VALUES
(1, NULL, '2020-06-22 07:01:27', 5, 1, 0, '1'),
(2, NULL, NULL, 6, 1, 0, '1'),
(3, '2020-06-22 22:16:53', '2020-06-22 22:16:53', 7, 1, 20, 'Box de varones'),
(4, '2020-06-22 22:17:31', '2020-07-08 21:58:20', 7, 1, 20, 'Box de mujeres'),
(5, '2020-06-22 23:46:05', '2020-07-22 21:13:32', 8, 0, 0, '1'),
(6, '2020-06-22 23:46:15', '2020-07-13 00:45:07', 8, 0, 0, '2'),
(7, NULL, NULL, 6, 1, 0, '2'),
(8, NULL, NULL, 6, 1, 0, '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Sintomas`
--

CREATE TABLE `Sintomas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `descripcion` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Sintomas`
--

INSERT INTO `Sintomas` (`id`, `created_at`, `updated_at`, `descripcion`) VALUES
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

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_rol` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `id_rol`, `remember_token`, `created_at`, `updated_at`, `estado`) VALUES
(16, 'Alejandro', 'admin', 'ale368_dvs@hotmail.com', NULL, '$2y$10$QrgZh2BXR8OEJ3YlM8bNi.ybFld2T4sSYsnHpuLDb9pYFTdd/jzLm', 1, NULL, '2020-07-30 16:45:16', '2020-07-30 16:45:16', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE `Usuarios` (
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `usuario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`usuario_id`, `usuario`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'borrar', 'borrar@gmail.com', NULL, '12345678', NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Areas`
--
ALTER TABLE `Areas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Atencion`
--
ALTER TABLE `Atencion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `atencion_usuario_id_foreign` (`usuario_id`),
  ADD KEY `atencion_id_procotocolo_foreign` (`id_protocolo`),
  ADD KEY `atencion_paciente_id_foreign` (`Paciente_id`);

--
-- Indices de la tabla `cie`
--
ALTER TABLE `cie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cie_codigo_unique` (`codigo`);

--
-- Indices de la tabla `CodigosTriage`
--
ALTER TABLE `CodigosTriage`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Detalles_Sintomas_Protocolos`
--
ALTER TABLE `Detalles_Sintomas_Protocolos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalles_sintomas_protocolos_id_protocolo_foreign` (`id_protocolo`),
  ADD KEY `detalles_sintomas_protocolos_id_sintoma_foreign` (`id_sintoma`);

--
-- Indices de la tabla `detalle_atencion`
--
ALTER TABLE `detalle_atencion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_atencion_id_atencion_foreign` (`id_atencion`),
  ADD KEY `detalle_atencion_id_det_profesional_sala_foreign` (`id_det_profesional_sala`),
  ADD KEY `detalle_atencion_id_especialidad_foreign` (`id_especialidad`);

--
-- Indices de la tabla `det_especialidad_area`
--
ALTER TABLE `det_especialidad_area`
  ADD PRIMARY KEY (`id`),
  ADD KEY `det_especialidad_area_id_especialidad_foreign` (`id_especialidad`),
  ADD KEY `det_especialidad_area_id_area_foreign` (`id_area`);

--
-- Indices de la tabla `det_profesionales`
--
ALTER TABLE `det_profesionales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `det_profesionales_id_profesional_foreign` (`id_profesional`),
  ADD KEY `det_profesionales_id_especialidad_foreign` (`id_especialidad`);

--
-- Indices de la tabla `det_profesionales_salas`
--
ALTER TABLE `det_profesionales_salas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `det_profesionales_salas_id_profesional_foreign` (`id_profesional`),
  ADD KEY `det_profesionales_salas_id_sala_foreign` (`id_sala`);

--
-- Indices de la tabla `det_protocolos`
--
ALTER TABLE `det_protocolos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `det_protocolos_id_especialidad_foreign` (`id_especialidad`),
  ADD KEY `det_protocolos_id_protocolo_foreign` (`id_protocolo`);

--
-- Indices de la tabla `Especialidades`
--
ALTER TABLE `Especialidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `historial_id_cie_foreign` (`id_cie`),
  ADD KEY `historial_id_detalle_atencion_foreign` (`id_detalle_atencion`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Pacientes`
--
ALTER TABLE `Pacientes`
  ADD PRIMARY KEY (`Paciente_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `preguntas_id_atencion_foreign` (`id_atencion`),
  ADD KEY `preguntas_id_sintoma_foreign` (`id_sintoma`);

--
-- Indices de la tabla `profesionales`
--
ALTER TABLE `profesionales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profesionales_id_user_foreign` (`id_user`);

--
-- Indices de la tabla `profesionales_horarios`
--
ALTER TABLE `profesionales_horarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profesionales_horarios_id_profesional_foreign` (`id_profesional`);

--
-- Indices de la tabla `Protocolos`
--
ALTER TABLE `Protocolos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `protocolos_id_codigo_triage_foreign` (`id_codigo_triage`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salas_id_area_foreign` (`id_area`);

--
-- Indices de la tabla `Sintomas`
--
ALTER TABLE `Sintomas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_id_rol_foreign` (`id_rol`);

--
-- Indices de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`usuario_id`),
  ADD UNIQUE KEY `usuarios_usuario_unique` (`usuario`),
  ADD UNIQUE KEY `usuarios_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Areas`
--
ALTER TABLE `Areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `Atencion`
--
ALTER TABLE `Atencion`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT de la tabla `cie`
--
ALTER TABLE `cie`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `CodigosTriage`
--
ALTER TABLE `CodigosTriage`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `Detalles_Sintomas_Protocolos`
--
ALTER TABLE `Detalles_Sintomas_Protocolos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `detalle_atencion`
--
ALTER TABLE `detalle_atencion`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT de la tabla `det_especialidad_area`
--
ALTER TABLE `det_especialidad_area`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `det_profesionales`
--
ALTER TABLE `det_profesionales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `det_profesionales_salas`
--
ALTER TABLE `det_profesionales_salas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `det_protocolos`
--
ALTER TABLE `det_protocolos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `Especialidades`
--
ALTER TABLE `Especialidades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `Pacientes`
--
ALTER TABLE `Pacientes`
  MODIFY `Paciente_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT de la tabla `profesionales`
--
ALTER TABLE `profesionales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `profesionales_horarios`
--
ALTER TABLE `profesionales_horarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Protocolos`
--
ALTER TABLE `Protocolos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `salas`
--
ALTER TABLE `salas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `Sintomas`
--
ALTER TABLE `Sintomas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `usuario_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Atencion`
--
ALTER TABLE `Atencion`
  ADD CONSTRAINT `atencion_id_procotocolo_foreign` FOREIGN KEY (`id_protocolo`) REFERENCES `Protocolos` (`id`),
  ADD CONSTRAINT `atencion_paciente_id_foreign` FOREIGN KEY (`Paciente_id`) REFERENCES `Pacientes` (`Paciente_id`),
  ADD CONSTRAINT `atencion_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`usuario_id`);

--
-- Filtros para la tabla `Detalles_Sintomas_Protocolos`
--
ALTER TABLE `Detalles_Sintomas_Protocolos`
  ADD CONSTRAINT `detalles_sintomas_protocolos_id_protocolo_foreign` FOREIGN KEY (`id_protocolo`) REFERENCES `Protocolos` (`id`),
  ADD CONSTRAINT `detalles_sintomas_protocolos_id_sintoma_foreign` FOREIGN KEY (`id_sintoma`) REFERENCES `Sintomas` (`id`);

--
-- Filtros para la tabla `detalle_atencion`
--
ALTER TABLE `detalle_atencion`
  ADD CONSTRAINT `detalle_atencion_id_atencion_foreign` FOREIGN KEY (`id_atencion`) REFERENCES `Atencion` (`id`),
  ADD CONSTRAINT `detalle_atencion_id_det_profesional_sala_foreign` FOREIGN KEY (`id_det_profesional_sala`) REFERENCES `det_profesionales_salas` (`id`),
  ADD CONSTRAINT `detalle_atencion_id_especialidad_foreign` FOREIGN KEY (`id_especialidad`) REFERENCES `Especialidades` (`id`);

--
-- Filtros para la tabla `det_especialidad_area`
--
ALTER TABLE `det_especialidad_area`
  ADD CONSTRAINT `det_especialidad_area_id_area_foreign` FOREIGN KEY (`id_area`) REFERENCES `Areas` (`id`),
  ADD CONSTRAINT `det_especialidad_area_id_especialidad_foreign` FOREIGN KEY (`id_especialidad`) REFERENCES `Especialidades` (`id`);

--
-- Filtros para la tabla `det_profesionales`
--
ALTER TABLE `det_profesionales`
  ADD CONSTRAINT `det_profesionales_id_especialidad_foreign` FOREIGN KEY (`id_especialidad`) REFERENCES `Especialidades` (`id`),
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
  ADD CONSTRAINT `det_protocolos_id_especialidad_foreign` FOREIGN KEY (`id_especialidad`) REFERENCES `Especialidades` (`id`),
  ADD CONSTRAINT `det_protocolos_id_protocolo_foreign` FOREIGN KEY (`id_protocolo`) REFERENCES `Protocolos` (`id`);

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
  ADD CONSTRAINT `preguntas_id_atencion_foreign` FOREIGN KEY (`id_atencion`) REFERENCES `Atencion` (`id`),
  ADD CONSTRAINT `preguntas_id_sintoma_foreign` FOREIGN KEY (`id_sintoma`) REFERENCES `Sintomas` (`id`);

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
-- Filtros para la tabla `Protocolos`
--
ALTER TABLE `Protocolos`
  ADD CONSTRAINT `protocolos_id_codigo_triage_foreign` FOREIGN KEY (`id_codigo_triage`) REFERENCES `CodigosTriage` (`id`);

--
-- Filtros para la tabla `salas`
--
ALTER TABLE `salas`
  ADD CONSTRAINT `salas_id_area_foreign` FOREIGN KEY (`id_area`) REFERENCES `Areas` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_rol_foreign` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
