-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 20-06-2020 a las 20:55:06
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
(1, NULL, NULL, 'Consultorio Externo'),
(2, NULL, NULL, 'Quirofanos'),
(3, '2020-06-10 16:51:55', '2020-06-10 16:51:55', 'Clínica'),
(4, '2020-06-10 16:52:58', '2020-06-10 16:52:58', 'Shock Room');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Atencion`
--

CREATE TABLE `Atencion` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `id_procotocolo` bigint(20) UNSIGNED DEFAULT NULL,
  `Paciente_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Atencion`
--

INSERT INTO `Atencion` (`id`, `created_at`, `updated_at`, `usuario_id`, `id_procotocolo`, `Paciente_id`) VALUES
(2, '2020-06-19 00:56:54', '2020-06-19 00:56:54', 1, NULL, 1),
(3, '2020-06-19 01:03:58', '2020-06-19 01:03:58', 1, NULL, 1),
(4, '2020-06-19 01:05:36', '2020-06-19 01:05:36', 1, NULL, 1),
(5, '2020-06-19 01:06:53', '2020-06-19 01:06:53', 1, NULL, 1),
(6, '2020-06-19 01:33:42', '2020-06-19 01:33:42', 1, NULL, 1),
(7, '2020-06-19 01:36:03', '2020-06-19 01:36:03', 1, NULL, 1),
(8, '2020-06-19 01:37:59', '2020-06-19 01:37:59', 1, NULL, 3),
(9, '2020-06-19 01:43:25', '2020-06-19 01:43:25', 1, NULL, 1),
(10, '2020-06-19 02:19:23', '2020-06-19 02:19:23', 1, NULL, 4),
(11, '2020-06-19 02:21:53', '2020-06-19 02:21:53', 1, NULL, 4),
(12, '2020-06-19 02:24:07', '2020-06-19 02:24:07', 1, NULL, 1),
(13, '2020-06-19 02:25:48', '2020-06-19 02:25:48', 1, NULL, 1);

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
(9, '2020-06-18 21:50:48', '2020-06-18 21:50:48', 14, 4),
(10, '2020-06-18 21:50:48', '2020-06-18 21:50:48', 14, 5),
(11, '2020-06-18 21:50:48', '2020-06-18 21:50:48', 14, 6),
(12, '2020-06-18 22:07:24', '2020-06-18 22:07:24', 15, 1),
(13, '2020-06-18 22:08:03', '2020-06-18 22:08:03', 16, 3),
(14, '2020-06-18 22:09:05', '2020-06-18 22:09:05', 17, 13),
(15, '2020-06-18 22:11:15', '2020-06-18 22:11:15', 18, 1),
(16, '2020-06-18 22:11:15', '2020-06-18 22:11:15', 18, 3),
(17, '2020-06-18 22:11:39', '2020-06-18 22:11:39', 19, 3),
(18, '2020-06-18 22:11:39', '2020-06-18 22:11:39', 19, 13),
(23, '2020-06-18 22:13:11', '2020-06-18 22:13:11', 21, 1),
(24, '2020-06-18 22:13:11', '2020-06-18 22:13:11', 21, 3),
(25, '2020-06-18 22:13:11', '2020-06-18 22:13:11', 21, 7),
(26, '2020-06-18 22:13:11', '2020-06-18 22:13:11', 21, 13),
(27, '2020-06-19 00:30:56', '2020-06-19 00:30:56', 22, 16),
(28, '2020-06-19 00:30:56', '2020-06-19 00:30:56', 22, 17),
(29, '2020-06-19 00:47:44', '2020-06-19 00:47:44', 23, 18),
(30, '2020-06-19 00:47:44', '2020-06-19 00:47:44', 23, 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Detalle_Atencion`
--

CREATE TABLE `Detalle_Atencion` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_atencion` bigint(20) UNSIGNED NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Detalle_Horarios`
--

CREATE TABLE `Detalle_Horarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_atencion` bigint(20) UNSIGNED NOT NULL,
  `id_horarios` bigint(20) UNSIGNED NOT NULL,
  `atendido` tinyint(1) NOT NULL DEFAULT '0',
  `start` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Detalle_Horarios`
--

INSERT INTO `Detalle_Horarios` (`id`, `created_at`, `updated_at`, `id_atencion`, `id_horarios`, `atendido`, `start`) VALUES
(1, NULL, '2020-06-19 01:37:00', 7, 6, 1, '2020-06-18'),
(2, NULL, NULL, 8, 9, 0, '2020-06-24'),
(3, NULL, '2020-06-18 19:02:26', 9, 8, 1, '2020-06-18'),
(4, NULL, '2020-06-19 02:04:39', 9, 10, 1, '2020-06-18'),
(5, NULL, '2020-06-19 02:11:37', 9, 10, 1, '2020-06-18'),
(6, NULL, '2020-06-19 02:28:08', 10, 6, 1, '2020-06-18'),
(7, NULL, NULL, 11, 9, 0, '2020-06-24'),
(8, NULL, '2020-06-18 19:27:13', 13, 8, 1, '2020-06-18'),
(9, NULL, NULL, 13, 10, 0, '2020-06-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Detalle_Salas`
--

CREATE TABLE `Detalle_Salas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_protocolo` bigint(20) UNSIGNED NOT NULL,
  `id_salas` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Detalle_Salas`
--

INSERT INTO `Detalle_Salas` (`id`, `created_at`, `updated_at`, `id_protocolo`, `id_salas`) VALUES
(1, NULL, NULL, 18, 6),
(2, NULL, NULL, 21, 6),
(3, NULL, NULL, 15, 5),
(4, NULL, NULL, 22, 5),
(5, NULL, NULL, 23, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Enfermedades`
--

CREATE TABLE `Enfermedades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_enfermedad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, NULL, NULL, 'Cirugía General', 'Es la especialidad médica que abarca las operaciones del aparato digestivo ...'),
(2, NULL, NULL, 'Clínica Médica', 'Atiende integralmente los problemas de salud en pacientes adultos...'),
(3, NULL, NULL, 'Oftalmología', 'Es la especialidad médica que estudia las enfermedades de ojo y su tratamiento ...'),
(4, NULL, NULL, 'Traumatología', 'Revisión de traumas corporales');

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
-- Estructura de tabla para la tabla `Horarios`
--

CREATE TABLE `Horarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_medico` bigint(20) UNSIGNED NOT NULL,
  `id_salas` bigint(20) UNSIGNED NOT NULL,
  `fechas` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `horaInicio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `horaFin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disponibilidad` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Horarios`
--

INSERT INTO `Horarios` (`id`, `created_at`, `updated_at`, `id_medico`, `id_salas`, `fechas`, `horaInicio`, `horaFin`, `disponibilidad`) VALUES
(3, '2020-06-18 20:34:39', '2020-06-18 20:34:39', 1, 1, 'Lunes', '10', '20', 1),
(4, '2020-06-18 20:34:39', '2020-06-18 20:34:39', 2, 5, 'Martes', '8', '16', 1),
(5, NULL, NULL, 2, 5, 'Viernes', '00', '23', 1),
(6, NULL, NULL, 2, 5, 'Jueves', '00', '23', 1),
(7, NULL, NULL, 2, 6, 'Viernes', '00', '24', 1),
(8, NULL, NULL, 2, 6, 'Jueves', '00', '24', 1),
(9, NULL, NULL, 1, 7, 'Miercoles', '10', '20', 1),
(10, NULL, NULL, 2, 3, 'Jueves', '00', '24', 1),
(11, NULL, NULL, 1, 4, 'Viernes', '00', '24', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Medicos`
--

CREATE TABLE `Medicos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `matricula_med` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_med` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_med` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FechaInicio` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Medicos`
--

INSERT INTO `Medicos` (`id`, `created_at`, `updated_at`, `matricula_med`, `nombre_med`, `apellido_med`, `FechaInicio`) VALUES
(1, NULL, NULL, '1111', 'Alberto', 'Gomez', '2020-06-19'),
(2, NULL, NULL, '1112', 'Fernando', 'Terraza', '2020-05-20');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_05_08_180849_create_pacientes_table', 1),
(5, '2020_05_08_181340_create_enfermedades_table', 1),
(6, '2020_05_13_220117_create_areas_table', 1),
(7, '2020_05_13_220822_create_medicos_table', 1),
(8, '2020_05_13_221231_create_especialidades_table', 1),
(9, '2020_05_13_221734_create_codigo_triage_table', 1),
(10, '2020_05_13_223404_create_salas_table', 1),
(11, '2020_05_13_232935_create_horarios_table', 1),
(12, '2020_05_14_015908_create_protocolos_table', 1),
(13, '2020_05_14_032843_create_atencion_table', 1),
(14, '2020_05_14_034510_create_detalle_atencion_table', 1),
(15, '2020_05_16_224527_create_detalle_sala_tablle', 1),
(16, '2020_05_19_221359_create_sintomas_table', 1),
(17, '2020_05_19_221526_create_detalles_sintomas_protocolos_table', 1),
(18, '2020_05_21_211227_create_preguntas_table', 1),
(19, '2020_05_26_014051_create_detalle_horarios_table', 1),
(20, '2020_06_08_172204_create_probando_table', 1),
(22, '2020_06_08_224754_add_votes_to_salas_table', 2),
(23, '2020_06_16_130852_add_votes_to_protocolos_table', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pacientes`
--

CREATE TABLE `Pacientes` (
  `Paciente_id` bigint(20) UNSIGNED NOT NULL,
  `dni` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechaNac` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Pacientes`
--

INSERT INTO `Pacientes` (`Paciente_id`, `dni`, `nombre`, `apellido`, `direccion`, `telefono`, `fechaNac`, `sexo`, `created_at`, `updated_at`) VALUES
(1, 37190827, 'Alejandro', 'Gonzales', 'Acevedo 368', '156158339', '20/11/1992', 'Masculino', '2020-06-08 19:08:45', '2020-06-08 19:08:45'),
(3, 45678900, 'Cristian', 'Zalazar', 'Calle Falsa 123', '5678', '01/01/1995', 'Masculino', '2020-06-18 21:58:57', '2020-06-18 21:58:57'),
(4, 39590140, 'Juan', 'Perez', 'Calle Falsa 123', '12341234', '1996/11/03', 'Masculino', '2020-06-19 02:18:17', '2020-06-19 02:18:17');

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
(1, '2020-06-19 00:56:54', '2020-06-19 00:56:54', 2, 16),
(2, '2020-06-19 00:56:54', '2020-06-19 00:56:54', 2, 17),
(3, '2020-06-19 01:03:58', '2020-06-19 01:03:58', 3, 16),
(4, '2020-06-19 01:03:58', '2020-06-19 01:03:58', 3, 17),
(5, '2020-06-19 01:05:36', '2020-06-19 01:05:36', 4, 16),
(6, '2020-06-19 01:05:36', '2020-06-19 01:05:36', 4, 17),
(7, '2020-06-19 01:06:53', '2020-06-19 01:06:53', 5, 16),
(8, '2020-06-19 01:06:53', '2020-06-19 01:06:53', 5, 17),
(9, '2020-06-19 01:33:42', '2020-06-19 01:33:42', 6, 16),
(10, '2020-06-19 01:33:42', '2020-06-19 01:33:42', 6, 17),
(11, '2020-06-19 01:36:03', '2020-06-19 01:36:03', 7, 16),
(12, '2020-06-19 01:36:03', '2020-06-19 01:36:03', 7, 17),
(13, '2020-06-19 01:37:59', '2020-06-19 01:37:59', 8, 18),
(14, '2020-06-19 01:37:59', '2020-06-19 01:37:59', 8, 19),
(15, '2020-06-19 01:43:25', '2020-06-19 01:43:25', 9, 1),
(16, '2020-06-19 01:43:25', '2020-06-19 01:43:25', 9, 3),
(17, '2020-06-19 01:43:25', '2020-06-19 01:43:25', 9, 13),
(18, '2020-06-19 01:43:25', '2020-06-19 01:43:25', 9, 7),
(19, '2020-06-19 02:19:23', '2020-06-19 02:19:23', 10, 16),
(20, '2020-06-19 02:19:23', '2020-06-19 02:19:23', 10, 17),
(21, '2020-06-19 02:21:53', '2020-06-19 02:21:53', 11, 18),
(22, '2020-06-19 02:21:53', '2020-06-19 02:21:53', 11, 19),
(23, '2020-06-19 02:24:08', '2020-06-19 02:24:08', 12, 3),
(24, '2020-06-19 02:24:08', '2020-06-19 02:24:08', 12, 1),
(25, '2020-06-19 02:24:08', '2020-06-19 02:24:08', 12, 18),
(26, '2020-06-19 02:24:08', '2020-06-19 02:24:08', 12, 7),
(27, '2020-06-19 02:25:48', '2020-06-19 02:25:48', 13, 1),
(28, '2020-06-19 02:25:48', '2020-06-19 02:25:48', 13, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Probando`
--

CREATE TABLE `Probando` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(14, '2020-06-18 21:50:48', '2020-06-18 21:50:48', 3, 'Covid-19'),
(15, '2020-06-18 22:07:24', '2020-06-18 22:07:24', 1, 'Primer Protocolo'),
(16, '2020-06-18 22:08:03', '2020-06-18 22:08:03', 1, 'Segundo Protocolo'),
(17, '2020-06-18 22:09:05', '2020-06-18 22:09:05', 1, 'Tercer Protocolo'),
(18, '2020-06-18 22:11:15', '2020-06-18 22:11:15', 2, 'Cuarto Protocolo'),
(19, '2020-06-18 22:11:39', '2020-06-18 22:11:39', 1, 'Quinto Protocolo'),
(21, '2020-06-18 22:13:11', '2020-06-18 22:13:11', 3, 'Sexto Protocolo'),
(22, '2020-06-19 00:30:56', '2020-06-19 00:30:56', 1, 'Septimo Protocolo'),
(23, '2020-06-19 00:47:44', '2020-06-19 00:47:44', 1, 'Octavo Protocolo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Salas`
--

CREATE TABLE `Salas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_area` bigint(20) UNSIGNED NOT NULL,
  `id_especialidades` bigint(20) UNSIGNED NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Salas`
--

INSERT INTO `Salas` (`id`, `created_at`, `updated_at`, `id_area`, `id_especialidades`, `estado`, `nombre`) VALUES
(1, NULL, '2020-06-10 01:18:55', 1, 1, 0, '1'),
(2, NULL, '2020-06-12 20:13:56', 1, 2, 0, '2'),
(3, NULL, '2020-06-19 02:04:27', 2, 1, 0, '1'),
(4, NULL, '2020-06-19 02:11:37', 2, 2, 0, '2'),
(5, NULL, '2020-06-11 22:24:46', 1, 3, 1, '3'),
(6, '2020-06-18 23:47:00', '2020-06-18 23:47:00', 3, 2, 1, '1'),
(7, '2020-06-19 00:45:24', '2020-06-19 00:45:24', 1, 4, 1, '4');

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
(1, '2020-06-08 19:09:48', '2020-06-08 19:09:48', 'Dolor de cabeza'),
(3, '2020-06-08 19:10:12', '2020-06-08 19:10:12', 'Dolor de estomago'),
(4, '2020-06-18 21:45:38', '2020-06-18 21:45:38', 'Fiebre'),
(5, '2020-06-18 21:45:38', '2020-06-18 21:45:38', 'Tos Seca'),
(6, '2020-06-18 21:45:38', '2020-06-18 21:45:38', 'Cansancio'),
(7, '2020-06-18 21:45:38', '2020-06-18 21:45:38', 'Dolor de garganta'),
(8, '2020-06-18 21:45:38', '2020-06-18 21:45:38', 'Diarrea'),
(9, '2020-06-18 21:45:38', '2020-06-18 21:45:38', 'Conjuntivitis'),
(10, '2020-06-18 21:45:38', '2020-06-18 21:45:38', 'Perdida del sentido del gusto'),
(11, '2020-06-18 21:45:38', '2020-06-18 21:45:38', 'Perdida del sentido del olfato'),
(12, '2020-06-18 21:45:38', '2020-06-18 21:45:38', 'Dificultad para respirar'),
(13, '2020-06-18 21:45:38', '2020-06-18 21:45:38', 'Dolor de pecho'),
(14, '2020-06-18 21:45:38', '2020-06-18 21:45:38', 'Perdida del habla'),
(15, '2020-06-18 21:45:38', '2020-06-18 21:45:38', 'Perdida del movimiento'),
(16, '2020-06-19 00:30:22', '2020-06-19 00:30:22', 'Dolor del ojo'),
(17, '2020-06-19 00:30:22', '2020-06-19 00:30:22', 'Picazón en el ojo'),
(18, '2020-06-19 00:47:12', '2020-06-19 00:47:12', 'Dolor de espalda'),
(19, '2020-06-19 00:47:12', '2020-06-19 00:47:12', 'Dolor muscular');

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
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`usuario_id`, `usuario`, `email`, `email_verified_at`, `password`, `direccion`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'borrar', 'borrar@gmail.com', NULL, '12345678', 'calle falsa', NULL, NULL, NULL);

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
  ADD KEY `atencion_id_procotocolo_foreign` (`id_procotocolo`),
  ADD KEY `atencion_paciente_id_foreign` (`Paciente_id`);

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
-- Indices de la tabla `Detalle_Atencion`
--
ALTER TABLE `Detalle_Atencion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_atencion_id_atencion_foreign` (`id_atencion`);

--
-- Indices de la tabla `Detalle_Horarios`
--
ALTER TABLE `Detalle_Horarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_horarios_id_atencion_foreign` (`id_atencion`),
  ADD KEY `detalle_horarios_id_horarios_foreign` (`id_horarios`);

--
-- Indices de la tabla `Detalle_Salas`
--
ALTER TABLE `Detalle_Salas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_salas_id_protocolo_foreign` (`id_protocolo`),
  ADD KEY `detalle_salas_id_salas_foreign` (`id_salas`);

--
-- Indices de la tabla `Enfermedades`
--
ALTER TABLE `Enfermedades`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `Horarios`
--
ALTER TABLE `Horarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `horarios_id_medico_foreign` (`id_medico`),
  ADD KEY `horarios_id_salas_foreign` (`id_salas`);

--
-- Indices de la tabla `Medicos`
--
ALTER TABLE `Medicos`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `Probando`
--
ALTER TABLE `Probando`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Protocolos`
--
ALTER TABLE `Protocolos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `protocolos_id_codigo_triage_foreign` (`id_codigo_triage`);

--
-- Indices de la tabla `Salas`
--
ALTER TABLE `Salas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salas_id_area_foreign` (`id_area`),
  ADD KEY `salas_id_especialidades_foreign` (`id_especialidades`);

--
-- Indices de la tabla `Sintomas`
--
ALTER TABLE `Sintomas`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `Atencion`
--
ALTER TABLE `Atencion`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `CodigosTriage`
--
ALTER TABLE `CodigosTriage`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `Detalles_Sintomas_Protocolos`
--
ALTER TABLE `Detalles_Sintomas_Protocolos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `Detalle_Atencion`
--
ALTER TABLE `Detalle_Atencion`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Detalle_Horarios`
--
ALTER TABLE `Detalle_Horarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `Detalle_Salas`
--
ALTER TABLE `Detalle_Salas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `Enfermedades`
--
ALTER TABLE `Enfermedades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Especialidades`
--
ALTER TABLE `Especialidades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Horarios`
--
ALTER TABLE `Horarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `Medicos`
--
ALTER TABLE `Medicos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `Pacientes`
--
ALTER TABLE `Pacientes`
  MODIFY `Paciente_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `Probando`
--
ALTER TABLE `Probando`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Protocolos`
--
ALTER TABLE `Protocolos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `Salas`
--
ALTER TABLE `Salas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `Sintomas`
--
ALTER TABLE `Sintomas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
  ADD CONSTRAINT `atencion_id_procotocolo_foreign` FOREIGN KEY (`id_procotocolo`) REFERENCES `Protocolos` (`id`),
  ADD CONSTRAINT `atencion_paciente_id_foreign` FOREIGN KEY (`Paciente_id`) REFERENCES `Pacientes` (`Paciente_id`),
  ADD CONSTRAINT `atencion_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`usuario_id`);

--
-- Filtros para la tabla `Detalles_Sintomas_Protocolos`
--
ALTER TABLE `Detalles_Sintomas_Protocolos`
  ADD CONSTRAINT `detalles_sintomas_protocolos_id_protocolo_foreign` FOREIGN KEY (`id_protocolo`) REFERENCES `Protocolos` (`id`),
  ADD CONSTRAINT `detalles_sintomas_protocolos_id_sintoma_foreign` FOREIGN KEY (`id_sintoma`) REFERENCES `Sintomas` (`id`);

--
-- Filtros para la tabla `Detalle_Atencion`
--
ALTER TABLE `Detalle_Atencion`
  ADD CONSTRAINT `detalle_atencion_id_atencion_foreign` FOREIGN KEY (`id_atencion`) REFERENCES `Atencion` (`id`);

--
-- Filtros para la tabla `Detalle_Horarios`
--
ALTER TABLE `Detalle_Horarios`
  ADD CONSTRAINT `detalle_horarios_id_atencion_foreign` FOREIGN KEY (`id_atencion`) REFERENCES `Atencion` (`id`),
  ADD CONSTRAINT `detalle_horarios_id_horarios_foreign` FOREIGN KEY (`id_horarios`) REFERENCES `Horarios` (`id`);

--
-- Filtros para la tabla `Detalle_Salas`
--
ALTER TABLE `Detalle_Salas`
  ADD CONSTRAINT `detalle_salas_id_protocolo_foreign` FOREIGN KEY (`id_protocolo`) REFERENCES `Protocolos` (`id`),
  ADD CONSTRAINT `detalle_salas_id_salas_foreign` FOREIGN KEY (`id_salas`) REFERENCES `Salas` (`id`);

--
-- Filtros para la tabla `Horarios`
--
ALTER TABLE `Horarios`
  ADD CONSTRAINT `horarios_id_medico_foreign` FOREIGN KEY (`id_medico`) REFERENCES `Medicos` (`id`),
  ADD CONSTRAINT `horarios_id_salas_foreign` FOREIGN KEY (`id_salas`) REFERENCES `Salas` (`id`);

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `preguntas_id_atencion_foreign` FOREIGN KEY (`id_atencion`) REFERENCES `Atencion` (`id`),
  ADD CONSTRAINT `preguntas_id_sintoma_foreign` FOREIGN KEY (`id_sintoma`) REFERENCES `Sintomas` (`id`);

--
-- Filtros para la tabla `Protocolos`
--
ALTER TABLE `Protocolos`
  ADD CONSTRAINT `protocolos_id_codigo_triage_foreign` FOREIGN KEY (`id_codigo_triage`) REFERENCES `CodigosTriage` (`id`);

--
-- Filtros para la tabla `Salas`
--
ALTER TABLE `Salas`
  ADD CONSTRAINT `salas_id_area_foreign` FOREIGN KEY (`id_area`) REFERENCES `Areas` (`id`),
  ADD CONSTRAINT `salas_id_especialidades_foreign` FOREIGN KEY (`id_especialidades`) REFERENCES `Especialidades` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
