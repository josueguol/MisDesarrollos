-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 02-10-2020 a las 17:46:52
-- Versión del servidor: 10.3.22-MariaDB-1ubuntu1
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `trendings`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `behavior`
--

CREATE TABLE `behavior` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_noticia` int(10) UNSIGNED NOT NULL,
  `token` varchar(256) NOT NULL,
  `fecha_visita` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `behavior`
--

INSERT INTO `behavior` (`id`, `id_noticia`, `token`, `fecha_visita`) VALUES
(1, 4, 'abc123', '2020-09-29 13:56:17'),
(2, 3, 'abc123', '2020-09-29 15:13:19'),
(3, 15, 'abc123', '2020-09-29 15:13:20'),
(4, 7, 'abc123', '2020-09-29 15:13:22'),
(5, 4, 'abc123', '2020-09-29 15:13:25'),
(6, 3, 'abc123', '2020-09-29 15:36:12'),
(7, 3, 'abc123', '2020-09-29 15:36:12'),
(8, 3, 'abc123', '2020-09-29 15:37:03'),
(9, 3, 'abc123', '2020-09-29 15:38:24'),
(10, 3, 'abc123', '2020-09-29 15:39:42'),
(11, 3, 'abc123', '2020-09-29 15:40:49'),
(12, 3, 'abc123', '2020-09-29 15:45:24'),
(13, 3, 'abc123', '2020-09-29 15:50:14'),
(14, 3, 'abc123', '2020-09-29 19:21:00'),
(15, 3, 'abc123', '2020-09-29 19:31:23'),
(16, 3, 'abc123', '2020-09-29 19:53:36'),
(17, 3, 'abc123', '2020-09-29 19:55:11'),
(18, 3, 'abc123', '2020-09-29 19:59:36'),
(19, 3, 'abc123', '2020-09-29 20:01:28'),
(20, 8, 'abc123', '2020-09-29 20:03:34'),
(21, 8, 'abc123', '2020-09-29 20:09:39'),
(22, 8, 'abc123', '2020-09-29 20:12:27'),
(23, 8, 'abc123', '2020-09-29 20:38:24'),
(24, 16, 'abc123', '2020-09-29 20:42:48'),
(25, 1, 'abc123', '2020-09-29 20:43:15'),
(26, 8, 'abc123', '2020-09-29 20:43:36'),
(27, 7, 'abc123', '2020-09-29 20:44:39'),
(28, 1, 'abc123', '2020-09-29 20:44:41'),
(29, 3, 'abc123', '2020-09-29 20:44:44'),
(30, 4, 'abc123', '2020-09-29 20:44:45'),
(31, 4, 'abc123', '2020-09-29 20:44:46'),
(32, 4, 'abc123', '2020-09-29 20:44:46'),
(33, 4, 'abc123', '2020-09-29 20:44:47'),
(34, 4, 'abc123', '2020-09-29 20:44:47'),
(35, 3, 'abc123', '2020-09-29 20:45:10'),
(36, 3, 'abc123', '2020-09-29 20:45:10'),
(37, 3, 'abc123', '2020-09-29 20:45:11'),
(38, 3, 'abc123', '2020-09-29 20:45:12'),
(39, 3, 'abc123', '2020-09-29 20:45:13'),
(40, 3, 'abc123', '2020-09-29 21:05:30'),
(41, 1, 'abc123', '2020-09-29 21:05:38'),
(42, 3, 'abc123', '2020-09-29 21:24:22'),
(43, 4, 'abc123', '2020-09-29 21:24:29'),
(44, 4, 'abc123', '2020-09-29 21:25:56'),
(45, 1, 'abc123', '2020-09-29 21:27:34'),
(46, 3, 'abc123', '2020-09-29 21:27:37'),
(47, 4, 'abc123', '2020-09-29 21:27:39'),
(48, 16, 'abc123', '2020-09-30 13:28:10'),
(49, 16, 'abc123', '2020-09-30 13:28:10'),
(50, 16, 'abc123', '2020-09-30 13:28:10'),
(51, 16, 'abc123', '2020-09-30 13:28:11'),
(52, 16, 'abc123', '2020-09-30 13:28:11'),
(53, 16, 'abc123', '2020-09-30 13:28:11'),
(54, 16, 'abc123', '2020-09-30 13:28:11'),
(55, 7, 'abc123', '2020-09-30 13:29:56'),
(56, 8, 'abc123', '2020-09-30 13:36:32'),
(57, 8, 'abc123', '2020-09-30 13:49:18'),
(58, 1, 'abc123', '2020-09-30 13:50:24'),
(59, 1, 'abc123', '2020-09-30 13:50:41'),
(60, 16, 'abc123', '2020-09-30 13:52:26'),
(61, 16, 'abc123', '2020-09-30 14:01:03'),
(62, 16, 'abc123', '2020-09-30 14:01:13'),
(63, 1, 'abc123', '2020-09-30 14:01:15'),
(64, 15, 'abc123', '2020-09-30 14:01:21'),
(65, 8, 'abc123', '2020-09-30 14:01:42'),
(66, 4, 'abc123', '2020-09-30 14:05:38'),
(67, 4, 'abc123', '2020-09-30 14:07:44'),
(68, 3, 'abc123', '2020-09-30 14:07:54'),
(69, 1, 'abc123', '2020-09-30 14:08:00'),
(70, 16, 'abc123', '2020-09-30 14:08:08'),
(71, 2, 'abc123', '2020-09-30 14:09:07'),
(72, 2, 'abc123', '2020-09-30 14:10:31'),
(73, 2, 'abc123', '2020-09-30 14:11:28'),
(74, 2, 'abc123', '2020-09-30 14:11:28'),
(75, 2, 'abc123', '2020-09-30 14:11:28'),
(76, 4, 'abc123', '2020-09-30 16:13:42'),
(77, 4, 'abc123', '2020-09-30 16:13:42'),
(78, 1, 'abc123', '2020-09-30 16:15:49'),
(79, 1, 'abc123', '2020-09-30 16:15:49'),
(80, 1, 'abc123', '2020-09-30 16:15:49'),
(81, 1, 'abc123', '2020-09-30 16:15:50'),
(82, 1, 'abc123', '2020-09-30 16:15:50'),
(83, 7, 'abc123', '2020-09-30 16:19:01'),
(84, 7, 'abc123', '2020-09-30 16:19:01'),
(85, 7, 'abc123', '2020-09-30 16:19:01'),
(86, 7, 'abc123', '2020-09-30 16:19:01'),
(87, 7, 'abc123', '2020-09-30 16:19:02'),
(88, 7, 'abc123', '2020-09-30 16:19:02'),
(89, 7, 'abc123', '2020-09-30 16:19:02'),
(90, 7, 'abc123', '2020-09-30 16:19:02'),
(91, 7, 'abc123', '2020-09-30 16:19:02'),
(92, 7, 'abc123', '2020-09-30 16:19:02'),
(93, 7, 'abc123', '2020-09-30 16:19:03'),
(94, 7, 'abc123', '2020-09-30 16:19:03'),
(95, 7, 'abc123', '2020-09-30 16:19:03'),
(96, 7, 'abc123', '2020-09-30 16:19:03'),
(97, 7, 'abc123', '2020-09-30 16:19:04'),
(98, 7, 'abc123', '2020-09-30 16:19:04'),
(99, 7, 'abc123', '2020-09-30 16:19:04'),
(100, 7, 'abc123', '2020-09-30 16:19:04'),
(101, 7, 'abc123', '2020-09-30 16:19:04'),
(102, 7, 'abc123', '2020-09-30 16:19:04'),
(103, 7, 'abc123', '2020-09-30 16:19:05'),
(104, 7, 'abc123', '2020-09-30 16:19:05'),
(105, 7, 'abc123', '2020-09-30 16:19:05'),
(106, 7, 'abc123', '2020-09-30 16:19:05'),
(107, 7, 'abc123', '2020-09-30 16:19:05'),
(108, 7, 'abc123', '2020-09-30 16:19:05'),
(109, 7, 'abc123', '2020-09-30 16:19:05'),
(110, 7, 'abc123', '2020-09-30 16:19:06'),
(111, 7, 'abc123', '2020-09-30 16:19:06'),
(112, 7, 'abc123', '2020-09-30 16:19:06'),
(113, 7, 'abc123', '2020-09-30 16:19:06'),
(114, 7, 'abc123', '2020-09-30 16:19:06'),
(115, 7, 'abc123', '2020-09-30 16:19:07'),
(116, 7, 'abc123', '2020-09-30 16:19:07'),
(117, 7, 'abc123', '2020-09-30 16:19:07'),
(118, 7, 'abc123', '2020-09-30 16:19:07'),
(119, 7, 'abc123', '2020-09-30 16:19:07'),
(120, 7, 'abc123', '2020-09-30 16:19:07'),
(121, 7, 'abc123', '2020-09-30 16:19:08'),
(122, 7, 'abc123', '2020-09-30 16:19:08'),
(123, 7, 'abc123', '2020-09-30 16:19:08'),
(124, 7, 'abc123', '2020-09-30 16:19:08'),
(125, 7, 'abc123', '2020-09-30 16:19:08'),
(126, 7, 'abc123', '2020-09-30 16:19:09'),
(127, 7, 'abc123', '2020-09-30 16:19:09'),
(128, 7, 'abc123', '2020-09-30 16:19:18'),
(129, 7, 'abc123', '2020-09-30 16:19:18'),
(130, 7, 'abc123', '2020-09-30 16:19:18'),
(131, 7, 'abc123', '2020-09-30 16:19:18'),
(132, 7, 'abc123', '2020-09-30 16:19:18'),
(133, 7, 'abc123', '2020-09-30 16:19:18'),
(134, 7, 'abc123', '2020-09-30 16:19:19'),
(135, 7, 'abc123', '2020-09-30 16:19:19'),
(136, 7, 'abc123', '2020-09-30 16:19:19'),
(137, 7, 'abc123', '2020-09-30 16:19:19'),
(138, 7, 'abc123', '2020-09-30 16:19:19'),
(139, 7, 'abc123', '2020-09-30 16:19:20'),
(140, 7, 'abc123', '2020-09-30 16:19:20'),
(141, 7, 'abc123', '2020-09-30 16:20:10'),
(142, 7, 'abc123', '2020-09-30 16:20:10'),
(143, 7, 'abc123', '2020-09-30 16:20:10'),
(144, 7, 'abc123', '2020-09-30 16:20:10'),
(145, 7, 'abc123', '2020-09-30 16:20:11'),
(146, 7, 'abc123', '2020-09-30 16:20:11'),
(147, 7, 'abc123', '2020-09-30 16:20:11'),
(148, 7, 'abc123', '2020-09-30 16:20:11'),
(149, 7, 'abc123', '2020-09-30 16:20:11'),
(150, 7, 'abc123', '2020-09-30 16:20:12'),
(151, 7, 'abc123', '2020-09-30 16:20:12'),
(152, 7, 'abc123', '2020-09-30 16:20:12'),
(153, 7, 'abc123', '2020-09-30 16:20:12'),
(154, 7, 'abc123', '2020-09-30 16:20:12'),
(155, 7, 'abc123', '2020-09-30 16:20:13'),
(156, 7, 'abc123', '2020-09-30 16:20:13'),
(157, 7, 'abc123', '2020-09-30 16:20:13'),
(158, 7, 'abc123', '2020-09-30 16:20:13'),
(159, 7, 'abc123', '2020-09-30 16:20:13'),
(160, 7, 'abc123', '2020-09-30 16:20:13'),
(161, 7, 'abc123', '2020-09-30 16:20:13'),
(162, 7, 'abc123', '2020-09-30 16:20:14'),
(163, 7, 'abc123', '2020-09-30 16:20:14'),
(164, 7, 'abc123', '2020-09-30 16:20:14'),
(165, 7, 'abc123', '2020-09-30 16:20:14'),
(166, 7, 'abc123', '2020-09-30 16:20:14'),
(167, 7, 'abc123', '2020-09-30 16:20:15'),
(168, 7, 'abc123', '2020-09-30 16:20:15'),
(169, 7, 'abc123', '2020-09-30 16:20:15'),
(170, 7, 'abc123', '2020-09-30 16:20:15'),
(171, 7, 'abc123', '2020-09-30 16:20:15'),
(172, 7, 'abc123', '2020-09-30 16:20:15'),
(173, 7, 'abc123', '2020-09-30 16:20:16'),
(174, 7, 'abc123', '2020-09-30 16:20:16'),
(175, 7, 'abc123', '2020-09-30 16:20:16'),
(176, 7, 'abc123', '2020-09-30 16:20:16'),
(177, 7, 'abc123', '2020-09-30 16:21:11'),
(178, 7, 'abc123', '2020-09-30 16:21:11'),
(179, 7, 'abc123', '2020-09-30 16:21:11'),
(180, 7, 'abc123', '2020-09-30 16:21:12'),
(181, 7, 'abc123', '2020-09-30 16:21:12'),
(182, 7, 'abc123', '2020-09-30 16:21:12'),
(183, 7, 'abc123', '2020-09-30 16:21:12'),
(184, 7, 'abc123', '2020-09-30 16:21:12'),
(185, 8, 'abc123', '2020-09-30 16:22:56'),
(186, 7, 'abc123', '2020-09-30 16:30:30'),
(187, 3, 'abc123', '2020-10-02 13:16:57'),
(188, 1, 'abc123', '2020-10-02 13:16:57'),
(189, 4, 'abc123', '2020-10-02 13:16:57'),
(190, 3, 'abc123', '2020-10-02 13:16:57'),
(191, 4, 'abc123', '2020-10-02 13:17:42'),
(192, 4, 'abc123', '2020-10-02 13:17:43'),
(193, 4, 'abc123', '2020-10-02 13:17:44'),
(194, 1, 'abc123', '2020-10-02 13:17:44'),
(195, 1, 'abc123', '2020-10-02 13:17:45'),
(196, 1, 'abc123', '2020-10-02 13:17:45'),
(197, 3, 'abc123', '2020-10-02 13:17:47'),
(198, 3, 'abc123', '2020-10-02 13:17:47'),
(199, 3, 'abc123', '2020-10-02 13:17:47'),
(200, 3, 'abc123', '2020-10-02 13:17:48'),
(201, 3, 'abc123', '2020-10-02 13:17:48'),
(202, 3, 'abc123', '2020-10-02 13:17:48'),
(203, 4, 'abc123', '2020-10-02 13:19:07'),
(204, 1, 'abc123', '2020-10-02 13:19:10'),
(205, 4, 'abc123', '2020-10-02 13:19:28'),
(206, 3, 'abc123', '2020-10-02 13:19:29'),
(207, 17, 'abc123', '2020-10-02 13:19:39'),
(208, 4, 'abc123', '2020-10-02 13:19:45'),
(209, 4, 'abc123', '2020-10-02 13:20:00'),
(210, 3, 'abc123', '2020-10-02 13:20:02'),
(211, 4, 'abc123', '2020-10-02 13:20:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `behavior_bucket`
--

CREATE TABLE `behavior_bucket` (
  `token` varchar(512) NOT NULL,
  `keywords` varchar(2048) NOT NULL,
  `classification` varchar(128) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `behavior_bucket`
--

INSERT INTO `behavior_bucket` (`token`, `keywords`, `classification`, `active`) VALUES
('abc123', 'presupuesto enfrentar doble crisis dulce maria sauri riancho presidenta', 'Política,Finanzas,México,Tecnología,Internacional', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historico_busquedas`
--

CREATE TABLE `historico_busquedas` (
  `id` int(10) UNSIGNED NOT NULL,
  `palabras` varchar(512) NOT NULL,
  `fecha_alta` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `historico_busquedas`
--

INSERT INTO `historico_busquedas` (`id`, `palabras`, `fecha_alta`) VALUES
(1, 'nieto peña presidente', '2020-09-13 12:33:21'),
(2, 'amlo festeja grito', '2020-09-13 12:45:12'),
(3, 'pemex', '2020-09-14 11:40:09'),
(4, 'covid muertes', '2020-09-14 11:43:49'),
(5, 'presupuesto', '2020-09-14 11:47:49'),
(10, 'enfermedad', '2020-09-21 20:45:44'),
(13, 'costal gatos perros', '2020-09-21 20:52:34'),
(14, 'covid virus', '2020-09-22 14:54:04'),
(15, 'nieto peña', '2020-09-22 16:39:57'),
(16, 'covid', '2020-09-22 17:42:14'),
(17, 'politica', '2020-09-22 19:57:58'),
(18, 'presidente', '2020-09-22 19:58:12'),
(19, 'amlo', '2020-09-22 19:58:18'),
(20, 'lopez', '2020-09-22 19:58:28'),
(21, 'enfermos', '2020-09-22 19:58:33'),
(22, 'herrera', '2020-09-22 19:58:44'),
(23, 'manuel', '2020-09-22 19:58:57'),
(24, 'javir', '2020-09-22 19:59:10'),
(25, 'javier', '2020-09-22 19:59:13'),
(26, 'jorge', '2020-09-22 19:59:17'),
(28, 'salud', '2020-09-22 19:59:25'),
(29, 'egresos presupuesto', '2020-09-22 20:00:10'),
(30, 'mesa presidneta', '2020-09-22 20:00:19'),
(31, 'gobierno', '2020-09-22 20:00:39'),
(32, 'gobierno mexico pemex', '2020-09-22 20:00:53'),
(33, 'presidenta', '2020-09-22 20:02:41'),
(34, 'economico paquete', '2020-09-22 20:02:54'),
(35, 'cancer', '2020-09-22 20:03:35'),
(36, 'ahi los', '2020-09-22 21:06:49'),
(37, 'los', '2020-09-22 21:29:37'),
(38, 'camino lucas san', '2020-09-22 21:30:27'),
(39, 'asdasda', '2020-09-23 14:08:14'),
(40, 'suiza', '2020-09-23 19:27:32'),
(41, 'mexico', '2020-09-23 19:27:41'),
(42, 'carros electricos', '2020-09-23 19:28:06'),
(43, 'carros', '2020-09-23 19:28:14'),
(44, 'autos', '2020-09-23 19:28:17'),
(45, 'auto', '2020-09-23 19:28:19'),
(46, 'autos deportivos', '2020-09-23 19:28:28'),
(47, 'deportivos', '2020-09-23 19:28:33'),
(48, 'futuro modelos', '2020-09-23 19:28:57'),
(49, 'superdeportivos', '2020-09-23 19:29:40'),
(50, 'trump', '2020-09-23 20:32:52'),
(51, 'muere', '2020-09-23 20:56:19'),
(52, 'meico', '2020-09-24 17:17:16'),
(53, 'mexico presupuesto', '2020-09-25 17:20:03'),
(54, 'egresos', '2020-09-25 17:38:30'),
(55, 'arturo', '2020-09-29 13:53:49'),
(56, 'supermodelo', '2020-09-30 13:03:47'),
(57, 'superauto', '2020-09-30 13:03:51'),
(58, 'superdeportivo', '2020-09-30 13:03:54'),
(59, 'deportivo', '2020-09-30 13:03:57'),
(60, 'finanzas', '2020-09-30 14:09:01'),
(61, 'crisis', '2020-09-30 16:15:46'),
(62, 'mexico despide mundial', '2020-10-02 13:17:37'),
(63, 'economia', '2020-10-02 13:19:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Titulo` varchar(128) NOT NULL,
  `Extracto` varchar(512) DEFAULT NULL,
  `Contenido` mediumtext DEFAULT NULL,
  `Programa` varchar(128) NOT NULL,
  `Seccion` varchar(128) NOT NULL,
  `Categoria` varchar(512) NOT NULL,
  `Cubeta` varchar(13107) DEFAULT NULL,
  `NoticiaImportante` tinyint(1) NOT NULL DEFAULT 0,
  `Tipo` enum('nota','video','galeria','infografia') NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaPublicacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  `Activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`Id`, `Titulo`, `Extracto`, `Contenido`, `Programa`, `Seccion`, `Categoria`, `Cubeta`, `NoticiaImportante`, `Tipo`, `FechaCreacion`, `FechaPublicacion`, `FechaActualizacion`, `Activo`) VALUES
(1, 'Pemex, “el mayor dolor de cabeza” del gobierno: Jonathan Heath', 'Aún se está a tiempo de que la petrolera no se vuelva “una migraña”, incluso “un “cáncer incurable”, por ello se necesita “un acuerdo definitorio, estructural, permanente” a este problema, dijo Jonathan Heath.', 'Ciudad de México. En el marco de una recuperación económica que podría durar de dos hasta seis años, Petróleos Mexicanos (Pemex) “es el mayor dolor de cabeza de este gobierno”, aseguró Jonathan Heath, subgobernador del Banco de México.\r\n\r\nAgregó que el problema es la diferencia de perspectiva. El gobierno no lo ve como un dolor de cabeza, sino como un motor de crecimiento hacia el futuro, “lo cual es prácticamente imposible”, zanjó el economista.\r\n\r\nAún se está a tiempo de que la petrolera no se vuelva “una migraña” incluso “un “cáncer incurable”, por ello se necesita “un acuerdo definitorio, estructural, permanente” a este problema, dijo en un seminario convocado por la firma de riesgo Moody’s.\r\n\r\nPor su parte, Ariane Ortiz-Bollin, analista senior de Riesgo Soberano en la calificadora, recalcó que el principal factor de riesgo para la nota crediticia de México son los recursos de salvamento a Pemex.\r\n\r\nEl apoyo es “sustancial y recurrente” e implica de uno a dos por ciento del producto interno bruto (PIB). El problema es que las transferencias de recursos sólo van a tapar los huecos de deuda que brotan de la petrolera y no se dirigen a incrementar producción y reservas, agregó.\r\n\r\nHacienda “más optimista que el optimista”\r\n\r\nTras advertir que los supuestos macroeconómicos de los que partió la Secretaría de Hacienda y Crédito Público (SHCP) para diseñar el paquete económico implican “presupuestos difíciles de lograr”, ya que sólo la caída de 8 por ciento prevista para 2020 es “más optimista que el más optimista” diagnóstico de instituciones financieras, Jonathan Heath destacó que hay tres preocupaciones centrales para el marco macroeconómico: el crecimiento, que se recupere el consumo sumado al empleo y la inflación.\r\n\r\nHeath advirtió que 2021 “será casi igual de difícil que 2020”. Y “va a marcar la diferencia entre un escenario de recuperación de dos a seis años”. Gran parte depende de las medidas que tome el gobierno federal porque del lado del Banco de México “no hay mucho más que podamos hacer”, pues la política monetaria ya prácticamente es expansiva.\r\n\r\nEn el corto plazo subrayó que las exportaciones se perfilan a ser el único motor de crecimiento; en el mediano será fundamental la reactivación del consumo de los hogares –y aparejado a ello del empleo– y en adelante también gira en torno a incentivar la inversión.\r\n\r\nSobre los precios al consumidor, dijo que más allá de un fenómeno inflacionario se está viviendo recomposición de los precios relativos por consumo demanda y cambio en los patrones de consumo, lo cual no se estabilizará sino hasta que termine el confinamiento impuesto por la pandemia de coronavirus.\r\n\r\nOrtiz-Bollin recalcó que lejos del gasto y la austeridad, por el momento lo que más preocupa en el caso de México es la tasa de crecimiento. Según las estimaciones de Moody’s, el país arrastrará la recuperación más lenta del G-20; se estima que la crisis dure hasta tres años.\r\n\r\nLa firma prevé que la economía mexicana caiga hasta 10 por ciento en 2020 y se dé una recuperación en V a 3.6 por ciento en 2021. De ahí en adelante crecerá debajo de 2 por ciento, según las proyecciones de la calificadora.\r\n\r\nSubrayó que la austeridad con la que se maneja el gobierno federal “no es sostenible en el tiempo”, ya sea con el uso del Fondo de Estabilización de Ingresos Presupuestarios (FEIP) o con el remanente del Banco de México. Son recursos de una vez. Mientras lo que Moody’s revisa es la sostenibilidad a largo plazo, dijo.\r\n\r\nSin embargo, Ortiz-Bollin reconoció que el país tiene mejores indicadores que otras economías con las que comparte su calificación Baa1 –la cual se dio en abril, tras caer de A3. Declaró que esta nota, tres escalones por encima de grado especulativo– probablemente no se moverá en 18 meses o más.', '', 'México', '', 'abril acuerdo adelante advertir advirtio agrego ahi analista años aparejado apoyo ariane arrastrara aseguro aun austeridad baa banco brotan bruto cabeza caer caida caiga calificacion calificadora cambio cancer casi caso centrales ciento ciudad comparte confinamiento consumidor consumo convocado coronavirus corto crecera crecimiento crediticia credito crisis debajo declaro definitorio demanda depende destaco deuda diagnostico diferencia dificil dificiles dijo dio dirigen diseñar dolor dos durar dure economia economias economica economico economista embargo empleo encima es escalones escenario especulativo estabilizacion estabilizara estima estimaciones estructural expansiva exportaciones factor federal feip fenomeno financieras firma fondo fundamental futuro gasto gira gobierno gobierno: grado gran hacer hacienda hay heath hogares huecos igual implica implican imposible impuesto incentivar incluso incrementar incurable indicadores inflacion inflacionario ingresos instituciones interno inversion jonathan lado largo lenta lograr los macroeconomico: macroeconomicos maneja marcar marco mayor mediano medidas mejores meses mexicana mexicanos mexico mientras migraña momento monetaria moodys motor movera necesita nota optimista ortizbollin otras pais pandemia paquete parte partio patrones pemex perfilan permanente perspectiva petroleos petrolera pib plazo podamos podria politica practicamente precios preocupa preocupaciones presupuestarios presupuestos preve prevista principal probablemente problema produccion producto proyecciones publico reactivacion recalco recomposicion reconocio recuperacion recupere recurrente recursos relativos remanente reservas revisa riesgo salvamento sea secretaria seis seminario senior ser sera shcp soberano solo son sostenibilidad sostenible su subgobernador subrayo sumado supuestos sustancial tambien tapar tasa termine tiempo tiene tome torno transferencias tres una unico uno uso va van ve vez viviendo vuelva zanjo', 1, 'nota', '2020-09-09 13:25:52', '2020-09-09 13:25:52', '2020-09-09 13:25:52', 1),
(2, 'Covid-19 deja más de 190 mil muertes en EU', 'Actualmente Iowa registra una de las tasas más elevadas de infecciones en la nación: un 15% de los tests realizados la semana pasada dieron positivo.', 'Las muertes por coronavirus en Estados Unidos superaron las 190 mil el miércoles, luego de un alza en los nuevos casos en estados del Medio Oeste como Iowa y Dakota del Sur, que están emergiendo como nuevos focos de contagio en las últimas semanas.\r\n\r\nActualmente Iowa registra una de las tasas más elevadas de infecciones en la nación: un 15% de los tests realizados la semana pasada dieron positivo. Dakota del Sur tiene una tasa de tests positivos de 19% y Dakota del Norte está en 18%, según un análisis de Reuters.\r\n\r\nEl incremento en Iowa y Dakota del Sur probablemente se relaciona con la reapertura de las universidades en Iowa y con una rally anual de motos el mes pasado en Sturgis, Dakota del Sur.\r\n\r\nKansas, Idaho y Misuri también figuran entre los 10 estados con porcentajes más altos de tests positivos.\r\n\r\nLos nuevos casos de coronavirus han declinado por siete semanas seguidas en Estados Unidos. La tasa de mortalidad por Covid-19 estuvo en torno a 6 mil 100 por semana en el último mes.\r\n\r\nEn una medición per cápita, Estados Unidos se ubica en la posición 12 en el mundo por número de decesos, con 58 muertes por 100 mil personas. Está en décimo primer lugar a nivel mundial por casos, con mil 933 infecciones por 100 mil residentes, según un análisis de Reuters.\r\n\r\nEstados Unidos registra más de 6.3 millones de casos, la cifra más alta en el mundo, seguido por India con 4.3 millones y Brasil con 4,1 millones. La cifra de fallecimientos de Estados Unidos también es la más alta del mundo.\r\n\r\nLos Centros para el Control y la Prevención de Enfermedades (CDC) de Estados Unidos calcularon el mes pasado que la cifra de muertes en la nación llegará a entre 200 mil y 211 mil para el 26 de septiembre.\r\n\r\nLa semana pasada, el instituto de salud de la Universidad de Washington pronosticó que las muertes en el país por el coronavirus llegarán a 410 mil para fines de año.', '', 'Internacional', '', 'actualmente alta altos alza analisis año anual brasil calcularon capita casos cdc centros cifra contagio control coronavirus covid dakota decesos decimo declinado deja dieron elevadas emergiendo enfermedades es estados estan estuvo eu fallecimientos figuran fines focos han idaho incremento india infecciones instituto iowa kansas llegara llegaran los lugar medicion medio mes miercoles mil millones misuri mortalidad motos muertes mundial mundo nacion nacion: nivel norte nuevos numero oeste pais pasada pasado per personas porcentajes posicion positivo positivos prevencion primer probablemente pronostico rally realizados reapertura registra relaciona residentes reuters salud seguidas seguido semana semanas septiembre siete sturgis superaron sur tambien tasa tasas tests tiene torno ubica ultimas ultimo una unidos universidad universidades washington', 0, 'nota', '2020-09-09 13:28:06', '2020-09-09 13:28:06', '2020-09-09 13:28:06', 1),
(3, 'Banca entró a la crisis en una posición sólida: BdeM', 'Fachada del Banco de México, en el Centro Histórico de la capital del país.', 'Ciudad de México. La banca mexicana entró a la crisis económica derivada de la pandemia de Covid-19 en una posición sólida por las reformas nacionales e internacionales que ha adoptado el sistema financiero a lo largo de las últimas décadas, afirmó Fabrizio López-Gallo, director de estabilidad financiera del Banco de México (BdeM).\r\n\r\n“Una de las cosas que ha ayudado a que la banca mexicana pueda enfrentar esta coyuntura con una posición de capital y de liquidez muy sólidas, pues son todas las reformas que el sistema financiero mexicano empezó después de la crisis del 95 y consolidó en los primeros años de 2000”, dijo el directivo del banco central.\r\n\r\nDurante su participación en el Seminario Anual de Moody´s, realizado de forma virtual, López-Gallo comentó que a esto se le deben sumar todas las reformas internacionales y la introducción de nuevos estándares como son los de liquidez que surgieron a raíz de la pos crisis de 2008 “encontramos a una banca que tiene unos niveles y una calidad de capital y de activos líquidos que no tenía en los dos episodios anteriores”.\r\n\r\nDestacó que pese al impacto de la crisis, las autoridades financieras del país actuaron rápido para aminorar los impactos de la misma.\r\n\r\n“Creo que lo que todos tenemos en mente es evitar que el sistema financiero fuera excesivamente pro cíclico y dejara de cumplir su misión como puente entre ahorradores y demandantes del crédito para que, una vez que tengamos un poco más de certeza o menos incertidumbre, la recuperación sea lo más rápido posible considerando el tamaño del choque y la incertidumbre que todavía tenemos”, dijo.\r\n\r\nLópez-Gallo precisó que una vez las condiciones de la economía sean mejores, las autoridades financieras seguirán de cerca los niveles de liquidez y de la cartera de crédito de la banca comercial. Será importante ver, consideró, cómo se desarrolla el crédito y cuáles son los impactos por los apoyos que las instituciones dieron a los clientes.\r\n\r\n“Hay que seguir de cerca cómo van despertando estas carteras y cuál es el impacto en rentabilidad y morosidad de la banca”, refirió.\r\n\r\nEl directivo del banco central comentó que se deben buscar los mejores esquemas de solución para que los usuarios del servicio que hayan sido más afectados por la crisis tengan la capacidad de hacer frente a sus pagos de deuda y en un futuro no se “cierre la llave del crédito”.\r\n\r\n“Creo que es una de las lecciones dolorosas que no hay que olvidar de los 90, que es la cantidad de gente que estuvo fuera del acceso a crédito por mucho tiempo, dada la magnitud de la crisis. Entonces hacia adelante hay instrumentos para que se maneje esto de manera adecuada, la banca está generando ya reservas, y hay que ver cuál es el despertar de estas carteras en términos de regreso a cierta rentabilidad y de aumento de morosidad”, añadió.', '', 'Finanzas', '', 'acceso activos actuaron adecuada adelante adoptado afectados afirmo ahorradores aminorar añadio años anteriores anual apoyos aumento autoridades ayudado banca banco bdem buscar calidad cantidad capacidad capital cartera carteras central centro certeza choque ciclico cierre cierta ciudad clientes comento comercial condiciones considerando considero consolido cosas covid coyuntura credito creo crisis cuales cumplir dada deben decadas dejara demandantes derivada desarrolla despertando despertar despues destaco deuda dieron dijo directivo director dolorosas dos durante economia economica empezo encontramos enfrentar entonces entro episodios es esquemas estabilidad estandares esto estuvo evitar excesivamente fabrizio fachada financiera financieras financiero forma frente fuera futuro generando gente ha hacer hay hayan historico impacto impactos importante incertidumbre instituciones instrumentos internacionales introduccion largo lecciones liquidez liquidos llave lopezgallo los magnitud maneje manera mejores menos mente mexicana mexicano mexico mision misma moody´s morosidad muy nacionales niveles nuevos olvidar pagos pais pandemia participacion pese pos posible posicion preciso primeros pro pueda puente raiz rapido realizado recuperacion refirio reformas regreso rentabilidad reservas sea sean seguir seguiran seminario sera servicio sido sistema solida solida: solidas solucion son su sumar surgieron sus tamaño tenemos tengamos tengan tenia terminos tiempo tiene todas todavia todos ultimas una unos usuarios van ver vez virtual', 0, 'nota', '2020-09-09 13:29:48', '2020-09-09 13:29:48', '2020-09-09 13:29:48', 1),
(4, 'El presupuesto de 2021, para enfrentar la doble crisis', 'Dulce María Sauri Riancho, presidenta de la mesa directiva en San Lázaro, recibe el paquete económico 2021 del titular de Hacienda, Arturo Herrera.', 'Ciudad de México. El Presupuesto de Egresos de la Federación (PEF) 2021, que asciende a 6 billones 295 mil millones de pesos –188 mil millones más que el vigente–, se propone balanceado y sensible para enfrentar las dos crisis simultáneas, la sanitaria y económica, que vive el país, sostiene la Secretaría de Hacienda en el proyecto entregado este martes a la Cámara de Diputados.\r\n\r\nEn este contexto, el gasto dará prioridad a atender la emergencia por el coronavirus, buscará soportar la recuperación económica y reforzar la red social que atiende a los más vulnerables, manteniendo la política de austeridad y de combate a la corrupción.\r\n\r\nCon ello se prevé atender como prioridad tres objetivos de política pública: ampliar y fortalecer las capacidades del sistema de salud; promover una reactivación rápida y sostenida del empleo y de la actividad económica, y continuar reduciendo la desigualdad.\r\n\r\nEl gasto corriente se plantea en 2.4 billones de pesos y los principales incrementos que el Ejecutivo federal propone a la Cámara de Diputados se encuentran en salud, educación, bienestar y turismo.\r\n\r\nEn contraste, se disminuye el gasto federalizado, al que se aplica un recorte de 100 mil millones de pesos, y de 60 mil millones en las participaciones a estados y municipios. La Oficina de la Presidencia tendrá una disminución de 113 millones de pesos respecto de lo autorizado para este año; Gobernación, de 91 millones; Relaciones Exteriores, de 602 millones; la Secretaría del Trabajo, de 5 mil 61 millones; Hacienda, de 3 mil 428 millones, y Energía, de 447 millones.\r\n\r\nComo parte de las prioridades del gobierno federal, la Secretaría de Salud tendrá un incremento de 16 mil 588 millones; Educación, 11 mil 764 millones; Marina, más de mil 919 millones, y Bienestar, más de 8 mil 13 millones.\r\n\r\nRespecto del impulso económico a la política de carácter social, el proyecto plantea que el regreso a la nueva normalidad debe ir acompañado de la convicción de profundizar en los cambios ya iniciados por el gobierno y avanzar en la construcción de un estado de bienestar que permita reducir el impacto de los factores externos en la economía nacional y las condiciones de vida de la población.\r\n\r\nSeñala que se propone reordenar las políticas públicas y la asignación de los recursos asociados a éstas, con objeto de reflejar un equilibrio entre las necesidades de la población y de la economía.\r\n\r\nLa expectativa gubernamental es que el próximo año continuará la reactivación iniciada en el segundo semestre de 2020, a medida que las unidades económicas se adapten al nuevo entorno y que la contención del coronavirus en México y en el exterior permita la recuperación paulatina de la capacidad productiva instalada.\r\n\r\nTambién se espera que el tratado comercial México-Estados Unidos-Canadá potencie al sector integrado a la economía global y a la inversión estratégica en el país, sustentado en políticas activas de atracción de empresas.\r\n\r\nOtra de las perspectivas se finca en que la inversión pública y privada en infraestructura impulsen la generación de empleos y tengan efectos sobre otros sectores, además de que el sector financiero mantenga el flujo adecuado de recursos hacia hogares, empresas y proyectos productivos.', '', 'Política', '', 'acompañado activas actividad adapten adecuado ademas ampliar año aplica arturo asciende asignacion asociados atender atiende atraccion austeridad autorizado avanzar balanceado bienestar billones buscara camara cambios capacidad capacidades caracter ciudad combate comercial condiciones construccion contencion contexto continuar continuara contraste conviccion coronavirus corriente corrupcion crisis dara debe desigualdad diputados directiva disminucion disminuye doble dos dulce economia economica economicas economico educacion efectos egresos ejecutivo emergencia empleo empleos empresas encuentran energia enfrentar entorno entregado equilibrio es espera estado estados estrategica expectativa exterior exteriores externos factores federacion federal federalizado financiero finca flujo fortalecer gasto generacion global gobernacion gobierno gubernamental hacienda herrera hogares impacto impulsen impulso incremento incrementos infraestructura iniciada iniciados instalada integrado inversion ir lazaro los mantenga manteniendo maria marina martes medida mesa mexico mexicoestados mil millones municipios nacional necesidades normalidad nueva nuevo objetivos objeto oficina otra otros pais paquete parte participaciones paulatina pef permita perspectivas pesos plantea poblacion politica politicas potencie presidencia presidenta presupuesto preve principales prioridad prioridades privada productiva productivos profundizar promover propone proximo proyecto proyectos publica publica: publicas rapida reactivacion recibe recorte recuperacion recursos red reduciendo reducir reflejar reforzar regreso relaciones reordenar respecto riancho salud san sanitaria sauri secretaria sector sectores segundo semestre señala sensible simultaneas sistema social soportar sostenida sostiene sustentado tambien tendra tengan titular trabajo tratado tres turismo una unidades unidoscanada vida vigente vive vulnerables', 1, 'nota', '2020-09-09 13:30:59', '2020-09-09 13:30:59', '2020-09-09 13:30:59', 1),
(5, 'Feministas acuden a dialogar con Sánchez Cordero pero sin negociar \'okupa\'', 'Durante la mesa de diálogo entre las feministas y autoridades de Gobernación.', 'Un grupo de las activistas y familiares de víctimas que mantienen ocupada la sede de la Comisión Nacional de los Derechos Humanos (CNDH) en el Centro Histórico de la capital salió esta mañana para reunirse con la titular de la Secretaría de Gobernación, Olga Sánchez Cordero, a quien le expondrán su pliego petitorio, pero sin negociar la entrega del inmueble de República de Cuba 60.', '', 'Política', '', 'activistas acuden autoridades capital centro cndh comision cordero cuba derechos dialogar dialogo durante entrega expondran familiares feministas gobernacion grupo historico humanos inmueble los mañana mantienen mesa nacional negociar ocupada okupa olga petitorio pliego republica reunirse salio sanchez secretaria sede su titular victimas', 1, 'nota', '2020-09-09 21:01:13', '2020-09-09 13:30:00', '2020-09-09 21:01:13', 1),
(7, 'Hispano Suiza llega a México para electrificar a los superdeportivos', 'El primer modelo, llamado Carmen, vale 1.5 millones de euros y está limitado a 19 unidades en el mundo', 'Cuando pensamos en lujo, refinamiento y desempeño se nos vienen a la mente un sin número de marcas alemanas, italianas o francesas, pero a muchos jamás se les ocurrió echarle un ojo a Hispano Suiza. \n\nLa firma española que nació a principios del siglo pasado en Barcelona pasó por una larga pausa pero resurgieron en 2019 con la presentación del Carmen en el Salón de Ginebra, un hiperdeportivo eléctrico personalizable que llega a México para comenzar con el camino de la marca en suelos aztecas. \n\nPara esto, José San Vicente será el encargado de comercializar las unidades en México y nos confirmó mediante una entrevista que una de la 19 unidades destinadas para todo el mundo ya fue ordenada en nuestro país y se encuentra al 95 por ciento de su avance.\n\nEsta unidad destinada a México se espera para abril de 2021 y, según palabras de la marca, planean una expansión con más modelos a futuro enfocados al lujo y desempeño. \n\n“En México tenemos un gran mercado, es por eso que hemos hecho una proyección directa con Hispano Suiza y decidimos lanzar la marca aquí de manera oficial,” comentó José durante la entrevista. ', '', 'Tecnología', '', 'abril alemanas avance aztecas barcelona camino carmen ciento comento comenzar comercializar confirmo cuando decidimos desempeño destinada destinadas directa durante echarle electrico electrificar encargado encuentra enfocados entrevista es eso española espera esto euros expansion firma francesas fue futuro ginebra gran hecho hemos hiperdeportivo hispano italianas jose lanzar larga les limitado llamado llega lujo manera marca marcas mediante mente mercado mexico millones modelo modelos muchos mundo nacio numero ocurrio oficial ojo ordenada pais palabras pasado paso pausa pensamos personalizable planean presentacion primer principios proyeccion refinamiento resurgieron salon san sera siglo su suelos suiza superdeportivos tenemos todo una unidad unidades vale vicente vienen', 0, 'nota', '2020-09-23 19:25:23', '2020-08-03 19:25:23', '2020-09-23 19:25:23', 1),
(8, 'Hay nuevas luces sobre la verdad del caso Iguala: Sánchez Cordero', 'La titular de Segob, Olga Sánchez Cordero durante su comparecencia en el Senado. Foto Cristina Rodríguez', 'Ciudad de México. Al comparecer en el Senado, la secretaria de Gobernación, Olga Sánchez Cordero, resaltó que la dependencia a su cargo cuenta “con información que arroja luces sobre lo verdaderamente ocurrido” la trágica noche en Iguala en que desaparecieron los 43 jóvenes normalistas de Ayotzinapa.\n\nEn el sexto aniversario de esos hechos, “ se seguirá haciendo todo lo posible, dentro de la ley, para poner a los responsables intelectuales y materiales ante la justicia”, recalcó en su intervención inicial.\n\nSánchez Cordero dejó además claro que el gobierno federal respetará a las leyes y autoridades electorales en el proceso comicial del próximo año, por el que se renovará la Cámara de Diputados,15 gobiernos estatales y los congresos locales. “Estamos ante los comicios más grandes, por número de cargos a elegir y por población en edad de votar, de nuestra historia.”.\n\n“Como responsable de la Política Interior comprometo el respeto del gobierno federal a las leyes y autoridades electorales, a las que daremos la colaboración y apoyo que nos requieran”.\n\nEn su mensaje inicial, al comparecer ante la Comisión de Gobernación del Senado, Sánchez Cordero,se refirió también a otro de los temas que han provocado controversia en los días recientes y refrendó “ el compromiso del presidente López Obrador con el respeto pleno, irrestricto a la libertad de expresión y al libre ejercicio del periodismo y la crítica, en todos los medios de comunicación social y en las manifestaciones y reuniones de pocos o miles de ciudadanos”.\n\nAdvirtió que “la libertad de expresión es un camino de ida y vuelta, en su ejercicio se opina y analiza, desde el primer día, sobre la conferencia de prensa que el Presidente sostiene de lunes a viernes con reporteros y representantes de los medios de comunicación. La llamada conferencia mañanera”.\n\nSostengo, dijo, “ que se trata de un ejercicio al mismo tiempo informativo y de rendición de cuentas, en donde cada día el Presidente aborda temas que son de interés general. Los reporteros le preguntan sobre los temas por él planteados, o sobre los que libremente ellos deciden. Al respecto, existe incluso una sentencia de la Sala Regional Especializada del Tribunal Electoral”R.\n\nEn igual tono, recalcó: “La pregunta que dejo aquí planteada es si los servidores públicos, empezando por el Presidente de la República, tenemos libertad de expresión y al hacer uso de ella el derecho a dar respuesta a las críticas, dentro de los límites constitucionales”.\n\nLa polémica está abierta, agregó y “de ella habrán de surgir no sólo respetables puntos de vista, sino que está en práctica una relación nueva, diferente, entre el Presidente y la sociedad, que pasa por el tamiz de los medios de comunicación. Una relación en la que la libertad de expresión, de todos, se ejerce sin cortapisa, como a diario lo vemos en los medios de comunicación masiva, la televisión, la radio y la prensa escrita, y los nuevos medios, las benditas redes sociales, como las llama nuestro Presidente”.', '', 'Política', '', 'abierta aborda ademas advirtio agrego analiza aniversario año apoyo arroja autoridades ayotzinapa benditas cada camara camino cargo cargos caso ciudad ciudadanos claro colaboracion comicial comicios comision comparecencia comparecer comprometo compromiso comunicacion conferencia congresos constitucionales controversia cordero corderose cortapisa cristina critica criticas cuenta cuentas dar daremos deciden dejo dentro dependencia derecho desaparecieron dia diario dias diferente dijo diputados durante edad ejerce ejercicio electorales electoralr elegir ella empezando es escrita especializada estamos estatales existe expresion federal foto general gobernacion gobierno gobiernos grandes habran hacer haciendo han hay hechos historia ida igual iguala iguala: incluso informacion informativo inicial intelectuales interes interior intervencion irrestricto jovenes justicia ley leyes libertad libre libremente limites llama llamada locales lopez luces lunes mañanera manifestaciones masiva materiales medios mensaje mexico miles mismo noche normalistas nuestra nueva nuevas nuevos numero obrador ocurrido olga opina otro pasa periodismo planteada planteados pleno poblacion pocos polemica politica poner posible practica pregunta preguntan prensa presidente primer proceso provocado proximo publicos puntos radio recalco recalco: recientes redes refirio refrendo regional relacion rendicion renovara reporteros representantes republica requieran resalto respecto respetables respetara respeto responsable responsables respuesta reuniones rodriguez sala sanchez secretaria segob seguira senado sentencia servidores sexto social sociales sociedad solo son sostengo sostiene su surgir tambien tamiz television temas tenemos tiempo titular todo todos tono tragica trata tribunal una uso vemos verdad verdaderamente viernes vista votar vuelta', 0, 'nota', '2020-09-23 19:56:00', '2020-08-03 19:56:00', '2020-09-23 19:56:00', 1),
(9, 'Se derrite el casquete polar ártico; registra su segunda área más baja en 42 años', 'El rompehielos finlandés \'MSV Nordica\' cruza el Paso del Noroeste a través del Estrecho de Victoria en el archipiélago ártico canadiense. Foto Ap', 'Nueva York. El casquete polar ártico registró este verano boreal su segunda menor superficie desde que comenzaron a empadronarlas hace 42 años, señalaron el lunes científicos estadunidenses.\n\nEste año, el área mínima se constató el 15 de septiembre, en 3.74 millones de kilómetros cuadrados, según el Centro Nacional de Nieve y Hielo (NSIDC, por sus siglas en inglés) de la universidad de Colorado Boulder.\n\nEl casquete polar ártico es la capa de hielo que se forma en el mar en esas altas latitudes y cada año una parte se derrite en verano para volver a formarse en invierno.\n\nSin embargo, con el calentamiento global, cada verano se derrite una porción mayor que no alcanza a recomponerse en el invierno, reduciendo cada vez más su superficie.\n\nLos satélites observan estas áreas con mucha precisión desde 1979, y la tendencia a la baja es clara.\n\nHa sido un año loco en el norte, con el hielo marino casi en el nivel más bajo de la historia, olas de calor en Siberia y enormes incendios forestales, afirmó Mark Serreze, director del NSIDC.\n\nNos enfilamos hacia un océano Ártico sin hielo estacional, sostuvo.\n\nGroenlandia se está calentando dos veces más rápido que el resto del planeta.\n\nEl deshielo no contribuye directamente al aumento del nivel del mar, pues el hielo ya está en el agua; lo hace en forma indirecta, porque cuanto menos hay, los rayos solares se reflejan menos y son absorbidos en mayor medida por los océanos, aumentando su temperatura.', '', 'Internacional', '', 'absorbidos afirmo agua alcanza altas año años ap archipielago area areas artico aumentando aumento baja boreal boulder cada calentamiento calentando calor canadiense capa casi casquete centro cientificos clara colorado comenzaron constato contribuye cruza cuadrados derrite deshielo directamente director dos embargo empadronarlas enfilamos enormes es estacional estadunidenses estrecho finlandes forestales forma formarse foto global groenlandia ha hace hay hielo historia incendios indirecta ingles invierno kilometros latitudes loco lunes mar marino mark mayor medida menor menos millones minima msv mucha nacional nieve nivel nordica noroeste norte nsidc nueva observan oceano oceanos olas parte paso planeta polar porcion precision rapido rayos recomponerse reduciendo reflejan registra registro resto rompehielos satelites segunda señalaron septiembre serreze siberia sido siglas solares son sostuvo su superficie sus temperatura tendencia traves una universidad verano vez victoria volver york', 0, 'nota', '2020-09-23 20:23:25', '2020-08-03 20:23:25', '2020-09-23 20:23:25', 1),
(10, 'Trump proclama que defenderá a EU de \"los marxistas\"', 'Donald Trump, presidente de EU participó en un homenaje a los veteranos de la operación de Bahía de Cochinos, Cuba de 1961. Foto Ap', 'Nueva York. Donald Trump rindió homenaje a los veteranos de la invasión ilegal y fallida contra la Revolución Cubana declarando que “muy pronto” esa isla será “libre” y proclamó que defenderá a Estados Unidos contra “los marxistas”, todo mientras procede con su intención de descarrilar y sabotear el proceso democrático en Estados Unidos.\n\nEl acto en la Casa Blanca para honrar a los veteranos cubanoestadunidenses de la operación dirigida y financiada por Washington de bahía de Cochinos en 1961 fue diseñado exclusivamente para efectos electorales en Florida, estado clave en la elección presidencial del 3 de noviembre.\n\nTrump declaró que “mi gobierno está con cada ciudadano de Cuba, Nicaragua y Venezuela en la lucha por la libertad”, subrayó que “muy pronto” habrá una “Cuba libre” y señaló que “hay muchos cosas que están ocurriendo ahora mismo de las cuales no les puedo contar, pero pronto lo haré”.\n\nInformó de las nuevas medidas anunciadas hoy por el Departamento de Tesoro para continuar con su desmantelamiento del acuerdo bilateral para normalizar relaciones bajo el gobierno de Barack Obama, incluyendo ahora una prohibición para ciudadanos estadunidenses de alojarse en hoteles y otras propiedades del gobierno de Cuba y mayores restricciones a la importación de ron y puros de la isla.\n\nPero el destinatario del discurso y las medidas no es Cuba sino Miami. La contienda sigue muy cerrada en Florida según sondeos recientes, el candidato demócrata Joe Biden goza de una ventaja de sólo 1.5 puntos en el promedio de las encuestas. Trump mantiene una ventaja entre algunos sectores latinos, sobre todo los cubanos pero también los nicaragüenses y venezolanos en la zona de Miami que son tradicionalmente fieles a los republicanos.\n\nTrump, empapado de nostalgia por la guerra fría, sostuvo que “los valientes veteranos que hoy están aquí son testigos de cómo el socialismo, las turbas radicales y comunistas violentas arruinan una nación” y acusó que “ahora el Partido Demócrata está desatando el socialismo aunque dentro de nuestro hermoso país”.\n\nProclamó: “Estados Unidos jamaá será un país socialista o comunista” y afirmó que “no luchamos contra la tiranía en el extranjero solo para dejar que los marxistas destruyan nuestro país”.\n\nHablando de tiranía y destrucción de países, Trump reiteró hoy su constante acusación de que el proceso electoral será viciado por fraude y corrupción -de lo cual hay nula evidencia- minando la credibilidad de los comicios estadunidenses de una manera que no tiene precedente.\n\nHoy admitió abiertamente cuál es su prisa para instalar a un nuevo integrante de la Suprema Corte antes de las elecciones: pronosticó que ahí llegará la disputa sobre el resultado de las elecciones. “Creo que esto acabará en la Suprema Corte, y creo que es muy importante que contemos con nueve jueces”, respondió a periodistas. Reiteró: “esta estafa que buscan los demócratas… se presentará ante la Suprema Corte de Estados Unidos”.\n\nTrump tiene la intención de anunciar su nominación a la Suprema Corte el sábado y ha indicado que será una mujer. El liderazgo republicano del Senado cuenta, por ahora, con suficientes votos para ratificar a la propuesta del presidente, y con ello obtener una mayoría conservadora de seis contra tres en el máximo tribunal nacional.\n\nUna de las candidatas es hija de cubanoestadunidenses y algunos aliados del presidente la están promoviendo no por sus capacidades, sino por el voto en Florida.\n\nPero Trump no ha conquistado a todo su partido. Hoy decidió atacar a la viuda del ex senador y candidato presidencial republicano John McCain. Después de enterarse que Cindy McCain había endosado a su contrincante demócrata, Trump tuiteó que Biden “era el perrito de John McCain” y agregó que “nunca fui fanático de John. Cindy puede quedarse con el Joe Soñoliento [su apodo para su contrincante]”.', '', 'Internacional', '', 'abiertamente acabara acto acuerdo acusacion acuso admitio afirmo agrego ahora algunos aliados alojarse antes anunciadas anunciar ap apodo arruinan atacar bahia barack biden bilateral blanca buscan cada candidatas candidato capacidades casa cerrada cindy ciudadano ciudadanos clave cochinos comicios comunista comunistas conquistado conservadora constante contar contemos contienda continuar contrincante corrupcion corte cosas credibilidad creo cuales cuba cubana cubanoestadunidenses cubanos cuenta decidio declarando declaro defendera dejar democrata democratas… democratico dentro departamento desatando descarrilar desmantelamiento despues destinatario destruccion destruyan dirigida discurso diseñado disputa donald efectos eleccion elecciones elecciones: electoral electorales empapado encuestas endosado enterarse era es esa estado estados estadunidenses estafa estan esto eu evidencia ex exclusivamente extranjero fallida fanatico fieles financiada florida foto fraude fria fue fui gobierno goza guerra ha habia hablando habra hare hay hermoso hija homenaje honrar hoteles ilegal importacion importante incluyendo indicado informo instalar integrante intencion invasion isla jamaa joe john jueces latinos les libertad libre liderazgo llegara lucha luchamos manera mantiene marxistas maximo mayores mayoria mccain medidas miami mientras minando mismo muchos mujer muy nacion nacional nicaragua nicaraguenses nominacion normalizar nostalgia noviembre nueva nuevas nueve nuevo nula obama obtener ocurriendo operacion otras pais paises participo partido periodistas perrito precedente presentara presidencial presidente prisa procede proceso proclama proclamo proclamo: prohibicion promedio promoviendo pronostico pronto propiedades propuesta puede puedo puntos puros quedarse radicales ratificar recientes reitero reitero: relaciones republicano republicanos respondio restricciones resultado revolucion rindio ron sabado sabotear sectores seis senado senador señalo sera sigue socialismo socialista solo son sondeos soñoliento sostuvo su subrayo suficientes suprema sus tambien tesoro testigos tiene tirania todo tradicionalmente tres tribunal trump tuiteo turbas una unidos valientes venezolanos venezuela ventaja veteranos viciado violentas viuda voto votos washington york zona', 0, 'nota', '2020-09-23 20:30:20', '2020-08-03 20:30:20', '2020-09-23 20:30:20', 1),
(12, 'CNTE negocia con Michoacán creación de plazas para normalistas', 'Maestros de la sección 18 de la CNTE de Michoacán, bloquearon Paseo de la Reforma de la CDMX en agosto pasado. Foto Víctor Camacho', 'Morelia, Mich. Maestros de la Coordinadora Nacional de Trabajadores de la Educación (CNTE) se reunieron con autoridades educativas y funcionarios del gobierno estatal con el fin de solicitar el trámite de contratación para egresados normalistas de las generaciones 2019 y 2020, ya que más de mil jóvenes tienen pendiente asignación de clave para ingreso al sistema magisterial.\n\n“Queremos que se reconozca su contrato desde hace casi un año, porque los egresados no han cobrado un solo peso. Gastan para trasladarse a comunidades, para la compra de material y viáticos, por lo que es urgente se les pague su sueldo”, dijo el dirigente centista Gamaliel Guzmán Cruz.\n\nLos maestros y un grupo de normalistas marcharon por la Calzada Juárez hasta Palacio de Gobierno, luego de unos minutos fueron atendidos por el secretario de Educación estatal, Héctor Ayala, y por otros funcionarios de la Secretaría de Educación Pública y del gobierno de Michoacán.\n\nEl secretario técnico de la CNTE, Lev Velázquez, declaró que se pide garantía de pago de salarios y prestaciones devengados a todos los maestros, así como el reconocimiento oficial a los programas alternativos de educación.\n\n“Estamos en disposición de dialogar y exigir lo que por derecho corresponde, porque de acuerdo a la Constitución, las plazas vacantes por jubilación deben ser reasignadas”, señaló.\n\nVelázquez reiteró que está agendada a fin de mes y a principios de octubre una reunión de la dirigencia de la CNTE con el secretario de Educación, Esteban Moctezuma, y con el presidente Andrés Manuel López Obrador.', '', 'México', '', 'acuerdo agendada agosto alternativos andres año asignacion atendidos autoridades ayala bloquearon calzada camacho casi cdmx centista clave cnte cobrado compra comunidades constitucion contratacion contrato coordinadora corresponde creacion cruz deben declaro derecho devengados dialogar dijo dirigencia dirigente disposicion educacion educativas egresados es estamos estatal esteban exigir fin foto fueron funcionarios gamaliel garantia gastan generaciones gobierno grupo guzman hace han hector ingreso jovenes juarez jubilacion les lev lopez maestros magisterial manuel marcharon material mes mich michoacan mil minutos moctezuma morelia nacional negocia normalistas obrador octubre oficial otros pago pague palacio pasado paseo pendiente peso pide plazas presidente prestaciones principios programas publica queremos reasignadas reconocimiento reconozca reforma reitero reunieron reunion salarios seccion secretaria secretario señalo ser sistema solicitar solo su sueldo tecnico tienen todos trabajadores tramite trasladarse una unos urgente vacantes velazquez viaticos victor', 0, 'nota', '2020-09-23 20:32:28', '2020-08-03 20:32:28', '2020-09-23 20:32:28', 1),
(13, 'Japón pedirá test de Covid-19 a atletas en Juegos Olímpicos', 'Los organizadores de los postergados Juegos Olímpicos del próximo año solicitarán pruebas de coronavirus a los atletas extranjeros a su llegada a Japón, según un borrador de las medidas. Foto Ap / Archivo', 'Tokio. Los organizadores de los postergados Juegos Olímpicos del próximo año solicitarán pruebas de coronavirus a los atletas extranjeros a su llegada a Japón, según muestra un borrador de las medidas publicado este miércoles.\n\nLos atletas japoneses y otros participantes que viven en Japón enfrentarán los mismos requisitos, según las medidas que aún se están discutiendo.\n\nAunque los atletas extranjeros y otros participantes no tendrán que someterse a un período de cuarentena de dos semanas, se requerirán pruebas de coronavirus a la llegada y salida, según el plan.\n\nLos organizadores también proponen restringir los viajes dentro de Japón para los atletas, que estarán limitados a ciudades que albergan a las delegaciones nacionales y centros de entrenamiento.\n\nLa pandemia, que ha infectado a más de 31.3 millones de personas y ha matado a unas 964 mil en todo el mundo, ha generado fuertes cuestionamientos sobre la viabilidad de los Juegos del próximo año, incluso cuando el nuevo primer ministro Yoshihide Suga ha enfatizado su importancia.\n\nJapón ha evitado un brote explosivo como los que han sufrido naciones como Estados Unidos, India y Brasil, al reportar aproximadamente 80 mil infecciones y alrededor de mil 500 muertes hasta la fecha.', '', 'Internacional', '', 'albergan alrededor año ap aproximadamente archivo atletas aun borrador brasil brote centros ciudades coronavirus covid cuando cuarentena cuestionamientos delegaciones dentro discutiendo dos enfatizado enfrentaran entrenamiento estados estan estaran evitado explosivo extranjeros fecha foto fuertes generado ha han importancia incluso india infecciones infectado japon japoneses juegos limitados llegada matado medidas miercoles mil millones ministro mismos muertes muestra mundo nacionales naciones nuevo olimpicos organizadores otros pandemia participantes pedira periodo personas plan postergados primer proponen proximo pruebas publicado reportar requeriran requisitos restringir salida semanas solicitaran someterse su sufrido suga tambien tendran test todo tokio unas unidos viabilidad viajes viven yoshihide', 1, 'nota', '2020-09-23 20:38:50', '2020-08-03 20:38:49', '2020-09-23 20:38:50', 1),
(14, 'Muere a los 93 años Juliette Greco, la diva de la canción francesa', 'La exitosa carrera de Juliette Greco se prolongó durante medio siglo, hasta 2016, cuando sufrió a los 89 años un accidente cardiovascular. Foto Ap', 'París. La gran estrella de la canción francesa Juliette Greco, célebre intérprete de obras de Léo Ferré o Jacques Prévert, falleció este miércoles a los 93 años, anunció su familia a la AFP.\n\n\"Juliette Greco murió rodeada de sus familiares en su amada casa de Ramatuelle (sureste de Francia). Su vida fue extraordinaria\", dijo la familia en un texto transmitido a la AFP.\n\nSu carrera, jalonada de éxitos, se prolongó durante medio siglo, hasta 2016, cuando sufrió a los 89 años un accidente cardiovascular.\n\nHasta ese año, en que también perdió a su hija única, Laurence-Marie, Greco \"siguió alumbrando a la canción francesa\", explicó el comunicado de la familia.\n\n\"Lo echo en falta enormemente. ¡Mi razón de ser es cantar! Cantar es lo máximo, utilizas el cuerpo, el instinto, la mente\", declaraba la cantante en una entrevista publicada el pasado mes de julio.', '', 'Entretenimiento', '', 'accidente afp alumbrando amada año años anuncio ap cancion cantante cantar cardiovascular carrera casa celebre comunicado cuando cuerpo declaraba dijo diva durante echo enormemente entrevista es estrella exitos exitosa explico extraordinaria fallecio falta familia familiares ferre foto francesa francia fue gran greco hija instinto interprete jacques jalonada juliette julio laurencemarie leo maximo medio mente mes miercoles muere murio obras paris pasado perdio prevert prolongo publicada ramatuelle razon rodeada ser siglo siguio su sufrio sureste sus tambien texto transmitido una unica utilizas vida', 1, 'nota', '2020-09-23 20:56:08', '2020-08-03 20:56:08', '2020-09-23 20:56:08', 1),
(15, 'México próxima potencia mundial', 'El peso muestra fortaleza ante la pandemia, lo que hace que inversionistas miren México como un buen lugar para la creación de nuevas empresas.', 'Ciudad de México. El sector privado es la “única esperanza” de crecimiento que tiene el país, por lo cual se trabaja en un gabinete que elimine todas las barreras para la inversión, aseguró Alfonso Romo, jefe de la Oficina de Presidencia de la República.\n\n“No tengo duda, pese a la dialéctica, de que el sector privado es la única esperanza para crecer que tiene el país, el sector público no tiene recursos suficientes”, indicó el funcionario en una reunión virtual con el Consejo Nacional Agropecuario.\n\nEn este sentido explicó que es consciente de las limitaciones presupuestales del gobierno, dado que 13 por ciento de presupuesto de inversión del siguiente año está enfocado en proyectos estratégicos.\n\n“Si la inversión pública está etiquetada, y el gasto restringido, lo único que tiene México para crecer es la inversión privada, sobre todo la nacional, nadie hará más por México que lo que los mexicanos podemos hacer”, apuntó.\n\nDe esta forma, indicó que el país no tiene otra salida que dar certidumbre al sector privado, por lo cual se deben tener cero barreras a la inversión y brindar la mayor estabilidad al sector empresarial. \n\nNo obstante, Romo pidió a los empresarios que los temas álgidos se toquen en privado: “No queremos guerras psicológicas que a nada nos lleva. \n\nSe sienten golpeados\n\nPor su parte, Bosco de la Vega, presidente del CNA, dijo al jefe de la Oficina de la Presidencia de la República, que como sector se sienten atacados por el gobierno federal, dado que no ha dejado de embestirlos.\n\nEn este sentido, resaltó el recorte al presupuesto del campo, el nuevo etiquetado y la prohibición de productos calóricos en estados como Oaxaca, entre otras cosas. \n\n“Hay un gobierno de un solo hombre, que no escucha al sector privado. Hemos presentado tres propuestas que no han sido tomadas en cuenta. La relación entre el gobierno y el sector empresarial en sectores estratégicos no se ha dado”, apuntó el dirigente.', '', 'México', '', 'agropecuario alfonso algidos año apunto aseguro atacados barreras bosco brindar buen caloricos campo cero certidumbre ciento ciudad cna consciente consejo cosas creacion crecer crecimiento cuenta dado dar deben dejado dialectica dijo dirigente duda elimine embestirlos empresarial empresarios empresas enfocado es escucha esperanza estabilidad estados estrategicos etiquetada etiquetado explico federal forma fortaleza funcionario gabinete gasto gobierno golpeados guerras ha hace hacer han hara hay hemos hombre indico inversion inversionistas jefe limitaciones lleva lugar mayor mexicanos mexico miren muestra mundial nacional nada nadie nuevas nuevo oaxaca obstante oficina otra otras pais pandemia parte pese peso pidio podemos potencia presentado presidencia presidente presupuestales presupuesto privada privado productos prohibicion propuestas proxima proyectos psicologicas publica publico queremos recorte recursos relacion republica resalto restringido reunion romo salida sector sectores sentido sido sienten siguiente sobre solo su suficientes temas tener tengo tiene todas todo tomadas toquen trabaja tres una unica unico vega virtual', 1, 'nota', '2020-09-24 19:18:00', '2020-08-04 19:18:00', '2020-09-24 19:18:00', 1);
INSERT INTO `noticias` (`Id`, `Titulo`, `Extracto`, `Contenido`, `Programa`, `Seccion`, `Categoria`, `Cubeta`, `NoticiaImportante`, `Tipo`, `FechaCreacion`, `FechaPublicacion`, `FechaActualizacion`, `Activo`) VALUES
(16, 'México y la \"caida\" del peso', 'La moneda mexicana se deprecia 0.80% al cotizar a 22.58 por dólar. La BMV presenta marginal pérdida de 0.01 por ciento.', 'Ciudad de México. El peso mexicano continúa con su mala racha. A la apertura, el tipo de cambio comenzó la sesión con una depreciación de 0.80 por ciento o 17.9 centavos al cotizar a 22.58 unidades por dólar.\n\nGabriela Siller, economista en jefe de Banco Base, calificó la caída que ha tenido el peso en los últimos días como un “tsunami cambiario” que puede estar reflejando rápidos movimientos de capitales por los cambios en la aversión al riesgo global.\n\nEsto debido a que el peso se apreció con fuerza, para después depreciarse en la misma proporción en pocos días.\n\nEsta nueva caída se da después de que en Estados Unidos se publicó el reporte semanal de empleo, correspondiente a la semana que terminó el 19 de septiembre.\n\nLas solicitudes iniciales de beneficio por desempleo para la semana que terminó el 19 de septiembre se ubicaron en 870 mil, aumentando en 4 mil con respecto a la semana anterior.\n\nLas solicitudes se han mantenido cerca del nivel de 850 mil por cuatro semanas seguidas, mostrando un estancamiento en la recuperación el mercado laboral.\n\nAsimismo, las solicitudes continuas de apoyo por desempleo, de aquellas personas que ya están recibiendo el apoyo o continúan a la espera, disminuyeron de 12 mil 747 millones a 12 mil 580 millones.\n\nSiller explicó que los mercados también están reaccionando con cautela, pues es probable que durante octubre sigan elevándose los nuevos casos de coronavirus.\n\nEsto al mismo tiempo que la atención estará puesta en las elecciones en Estados Unidos cuyo desenlace es incierto y que ha politizado varias cosas, desde la aprobación de estímulos fiscales hasta la autorización de una vacuna contra el coronavirus.\n\nLa analista dijo que lo anterior propicia que los inversionistas sigan asumiendo posiciones en activos de menor riesgo y que se abandonen posiciones en instrumentos del mercado de capitales y en divisas de economías emergentes.\n\n\"De seguir el nerviosismo, el tipo de cambio seguiría enfrentando presiones al alza, acercándose a niveles de 23.00 pesos por dólar en el corto plazo\", advirtió.\n\nEn este contexto, la Bolsa Mexicana de Valores comenzó la jornada con una marginal pérdida de 0.01 por ciento.', '', 'Finanzas', '', 'abandonen acercandose activos advirtio alza analista anterior apertura apoyo aprecio aprobacion asimismo asumiendo atencion aumentando autorizacion aversion banco base beneficio bmv bolsa caida califico cambiario cambio cambios capitales casos cautela centavos ciento ciudad comenzo contexto continua continuan continuas contra coronavirus correspondiente corto cosas cotizar cuatro da debido deprecia depreciacion depreciarse desempleo desenlace despues dias dijo disminuyeron divisas dolar durante economias economista elecciones elevandose emergentes empleo enfrentando es espera estados estan estancamiento estar estara estimulos esto explico fiscales fuerza gabriela global ha han incierto iniciales instrumentos inversionistas jefe jornada laboral mala mantenido marginal menor mercado mercados mexicana mexicano mexico mil millones misma mismo moneda mostrando movimientos nerviosismo nivel niveles nueva nuevos octubre perdida personas peso pesos plazo pocos politizado posiciones presenta presiones probable propicia proporcion publico puede puesta racha rapidos reaccionando recibiendo recuperacion reflejando reporte respecto riesgo seguidas seguir seguiria semana semanal semanas septiembre sesion sigan siller solicitudes su tambien tenido termino tiempo tipo tsunami ubicaron ultimos una unidades unidos vacuna valores varias', 1, 'nota', '2020-09-24 19:22:27', '2020-08-04 19:22:27', '2020-09-24 19:22:27', 1),
(17, 'AMLO llama a la Corte a \"no dejarse intimidar\" y oír al pueblo', 'El presidente Andrés Manuel López Obrador durante la conferencia matutina en Palacio Nacional. Foto Cuartoscuro', 'Viernes 25 de septiembre de 2020. El presidente Andrés Manuel López Obrador pidió a integrantes de la Suprema Corte de Justicia de la Nación que no se dejen intimidar, que actúen con criterio y tomen en cuenta el sentimiento del pueblo al resolver conforme a la ley la solicitud de la consulta para enjuiciar a ex mandatarios, después de que el ministro Luis María Aguilar propuso declarar anticonstitucional el ejercicio ciudadano.\nA una semana de que someta a votación la propuesta de Aguilar, el mandatario manifestó que los argumentos del ministro, de que se afectan los derechos humanos y las garantías para la protección de las personas, son parecidos a lo que “manejó desde el principio Felipe Calderón.\n\nYo opino distinto, pero vamos a esperar que el pleno de la Corte resuelva el próximo jueves, porque en la decisión no sólo interviene un ministro, y hasta ahora es sólo un proyecto.\n\n–¿Qué les diría a los ministros?\n\n–Que actúen con estricto apego a la ley, que no se dejen intimidar, que actúen con criterio. Aunque ellos resuelven de conformidad con lo establecido en las leyes, en este caso en el artículo 35 de la Constitución y en la Ley de Consulta Ciudadana, que tomen en cuenta el sentimiento del pueblo.\n\n“Ya sé que tienen que resolver con apego a la legalidad, que no necesitan leerme el artículo de la Constitución, el 35, que establece que no se deben de violar los derechos humanos.\n\nConsidero que no existe ninguna violación a derechos humanos, a las garantías de los ciudadanos, porque en el caso de que se lleven a cabo estos juicios los tiene que hacer la autoridad competente en el marco de la legalidad que prevalece, dándole al implicado las garantías de defensa, de que no se violen sus derechos humanos. Pero este es un proyecto, hay que esperar.\n\nPlanteó que el primero de octubre se someta a votación el proyecto. “Ahí se va a saber… Hay algunos proyectos que se aprueban y otros que no, y tiene que decidirse por mayoría. Hay que tener confianza en la Corte”, resaltó.', '', 'Política', '', 'actuen afectan aguilar ahora algunos amlo andres anticonstitucional apego aprueban argumentos articulo autoridad cabo calderon caso ciudadana ciudadano ciudadanos competente conferencia confianza conforme conformidad considero constitucion consulta corte criterio cuartoscuro cuenta dandole deben decidirse decision declarar defensa dejarse dejen derechos despues diria distinto durante ejercicio enjuiciar es esperar establece establecido estricto ex existe felipe foto garantias hacer hay humanos implicado integrantes interviene intimidar jueves juicios justicia leerme legalidad les ley leyes llama lleven lopez luis mandatario mandatarios manejo manifesto manuel marco maria matutina mayoria ministro ministros nacion nacional necesitan ninguna obrador octubre oir opino otros palacio parecidos personas pidio planteo pleno presidente prevalece primero principio propuesta propuso proteccion proximo proyecto proyectos pueblo resalto resolver resuelva resuelven saber… semana sentimiento septiembre solicitud solo someta son suprema sus tener tiene tienen tomen una va viernes violacion violar violen votacion', 1, 'nota', '2020-09-25 13:36:18', '2020-08-05 13:36:18', '2020-09-25 13:36:18', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tendencias`
--

CREATE TABLE `tendencias` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_busqueda` int(10) UNSIGNED NOT NULL,
  `fecha_busqueda` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tendencias`
--

INSERT INTO `tendencias` (`id`, `id_busqueda`, `fecha_busqueda`) VALUES
(1, 3, '2020-09-14 13:45:00'),
(2, 4, '2020-09-14 13:46:00'),
(3, 5, '2020-09-14 13:47:00'),
(4, 3, '2020-09-21 19:53:00'),
(7, 10, '2020-09-21 20:45:00'),
(8, 10, '2020-09-21 20:48:00'),
(9, 11, '2020-09-21 20:48:00'),
(10, 12, '2020-09-21 20:52:00'),
(11, 13, '2020-09-21 20:52:00'),
(12, 13, '2020-09-22 14:30:00'),
(13, 3, '2020-09-22 14:30:00'),
(14, 14, '2020-09-22 14:54:00'),
(15, 15, '2020-09-22 16:39:00'),
(16, 14, '2020-09-22 16:40:00'),
(17, 10, '2020-09-22 17:42:00'),
(18, 16, '2020-09-22 17:42:00'),
(19, 15, '2020-09-22 18:05:00'),
(20, 16, '2020-09-22 18:26:00'),
(21, 16, '2020-09-22 18:28:00'),
(22, 16, '2020-09-22 18:33:00'),
(23, 16, '2020-09-22 18:34:00'),
(24, 16, '2020-09-22 18:34:00'),
(25, 16, '2020-09-22 18:36:00'),
(26, 16, '2020-09-22 18:37:00'),
(27, 3, '2020-09-22 18:38:00'),
(28, 16, '2020-09-22 18:42:00'),
(29, 16, '2020-09-22 18:44:00'),
(30, 16, '2020-09-22 18:44:00'),
(31, 16, '2020-09-22 18:44:00'),
(32, 16, '2020-09-22 18:44:00'),
(33, 16, '2020-09-22 18:44:00'),
(34, 16, '2020-09-22 18:46:00'),
(35, 16, '2020-09-22 18:51:00'),
(36, 16, '2020-09-22 18:52:00'),
(37, 16, '2020-09-22 18:58:00'),
(38, 16, '2020-09-22 18:58:00'),
(39, 16, '2020-09-22 18:58:00'),
(40, 16, '2020-09-22 18:58:00'),
(41, 16, '2020-09-22 18:58:00'),
(42, 16, '2020-09-22 18:58:00'),
(43, 16, '2020-09-22 18:58:00'),
(44, 16, '2020-09-22 18:58:00'),
(45, 16, '2020-09-22 18:58:00'),
(46, 16, '2020-09-22 19:38:00'),
(47, 16, '2020-09-22 19:50:00'),
(48, 16, '2020-09-22 19:54:00'),
(49, 4, '2020-09-22 19:56:00'),
(50, 4, '2020-09-22 19:56:00'),
(51, 4, '2020-09-22 19:56:00'),
(52, 4, '2020-09-22 19:56:00'),
(53, 4, '2020-09-22 19:56:00'),
(54, 4, '2020-09-22 19:56:00'),
(55, 4, '2020-09-22 19:56:00'),
(56, 3, '2020-09-22 19:56:00'),
(57, 17, '2020-09-22 19:57:00'),
(58, 5, '2020-09-22 19:58:00'),
(59, 18, '2020-09-22 19:58:00'),
(60, 19, '2020-09-22 19:58:00'),
(61, 19, '2020-09-22 19:58:00'),
(62, 20, '2020-09-22 19:58:00'),
(63, 21, '2020-09-22 19:58:00'),
(64, 22, '2020-09-22 19:58:00'),
(65, 23, '2020-09-22 19:58:00'),
(66, 18, '2020-09-22 19:59:00'),
(67, 24, '2020-09-22 19:59:00'),
(68, 25, '2020-09-22 19:59:00'),
(69, 26, '2020-09-22 19:59:00'),
(70, 27, '2020-09-22 19:59:00'),
(71, 28, '2020-09-22 19:59:00'),
(72, 29, '2020-09-22 20:00:00'),
(73, 30, '2020-09-22 20:00:00'),
(74, 31, '2020-09-22 20:00:00'),
(75, 32, '2020-09-22 20:00:00'),
(76, 27, '2020-09-22 20:01:00'),
(77, 27, '2020-09-22 20:01:00'),
(78, 27, '2020-09-22 20:01:00'),
(79, 27, '2020-09-22 20:01:00'),
(80, 27, '2020-09-22 20:01:00'),
(81, 27, '2020-09-22 20:01:00'),
(82, 27, '2020-09-22 20:01:00'),
(83, 33, '2020-09-22 20:02:00'),
(84, 34, '2020-09-22 20:02:00'),
(85, 35, '2020-09-22 20:03:00'),
(86, 35, '2020-09-22 20:34:00'),
(87, 3, '2020-09-22 20:34:00'),
(88, 16, '2020-09-22 20:34:00'),
(89, 5, '2020-09-22 20:34:00'),
(90, 16, '2020-09-22 21:06:00'),
(91, 36, '2020-09-22 21:06:00'),
(92, 37, '2020-09-22 21:29:00'),
(93, 37, '2020-09-22 21:29:00'),
(94, 37, '2020-09-22 21:29:00'),
(95, 38, '2020-09-22 21:30:00'),
(96, 15, '2020-09-23 14:06:00'),
(97, 5, '2020-09-23 14:06:00'),
(98, 5, '2020-09-23 14:08:00'),
(99, 5, '2020-09-23 14:08:00'),
(100, 5, '2020-09-23 14:08:00'),
(101, 5, '2020-09-23 14:08:00'),
(102, 5, '2020-09-23 14:08:00'),
(103, 39, '2020-09-23 14:08:00'),
(104, 39, '2020-09-23 14:08:00'),
(105, 39, '2020-09-23 14:08:00'),
(106, 39, '2020-09-23 14:08:00'),
(107, 5, '2020-09-23 14:08:00'),
(108, 40, '2020-09-23 19:27:00'),
(109, 41, '2020-09-23 19:27:00'),
(110, 29, '2020-09-23 19:27:00'),
(111, 42, '2020-09-23 19:28:00'),
(112, 43, '2020-09-23 19:28:00'),
(113, 44, '2020-09-23 19:28:00'),
(114, 45, '2020-09-23 19:28:00'),
(115, 46, '2020-09-23 19:28:00'),
(116, 47, '2020-09-23 19:28:00'),
(117, 48, '2020-09-23 19:28:00'),
(118, 49, '2020-09-23 19:29:00'),
(119, 50, '2020-09-23 20:32:00'),
(120, 50, '2020-09-23 20:55:00'),
(121, 51, '2020-09-23 20:56:00'),
(122, 5, '2020-09-24 13:09:00'),
(123, 5, '2020-09-24 13:32:00'),
(124, 5, '2020-09-24 13:40:00'),
(125, 5, '2020-09-24 13:40:00'),
(126, 5, '2020-09-24 13:40:00'),
(127, 5, '2020-09-24 13:40:00'),
(128, 41, '2020-09-24 13:46:00'),
(129, 41, '2020-09-24 14:08:00'),
(130, 41, '2020-09-24 16:08:00'),
(131, 41, '2020-09-24 17:12:00'),
(132, 41, '2020-09-24 17:12:00'),
(133, 41, '2020-09-24 17:13:00'),
(134, 52, '2020-09-24 17:17:00'),
(135, 41, '2020-09-24 17:17:00'),
(136, 41, '2020-09-24 17:22:00'),
(137, 41, '2020-09-24 17:55:00'),
(138, 41, '2020-09-24 17:59:00'),
(139, 41, '2020-09-24 19:06:00'),
(140, 41, '2020-09-24 19:06:00'),
(141, 41, '2020-09-24 19:08:00'),
(142, 41, '2020-09-24 19:19:00'),
(143, 41, '2020-09-24 19:22:00'),
(144, 19, '2020-09-25 13:39:00'),
(145, 19, '2020-09-25 13:45:00'),
(146, 19, '2020-09-25 13:48:00'),
(147, 19, '2020-09-25 13:52:00'),
(148, 19, '2020-09-25 16:08:00'),
(149, 19, '2020-09-25 16:09:00'),
(150, 19, '2020-09-25 16:09:00'),
(151, 19, '2020-09-25 16:09:00'),
(152, 41, '2020-09-25 17:08:00'),
(153, 53, '2020-09-25 17:20:00'),
(154, 29, '2020-09-25 17:27:00'),
(155, 54, '2020-09-25 17:38:00'),
(156, 54, '2020-09-25 17:38:00'),
(157, 54, '2020-09-25 17:38:00'),
(158, 54, '2020-09-25 17:38:00'),
(159, 54, '2020-09-25 17:38:00'),
(160, 5, '2020-09-25 17:38:00'),
(161, 54, '2020-09-25 17:38:00'),
(162, 19, '2020-09-29 13:01:00'),
(163, 19, '2020-09-29 13:17:00'),
(164, 5, '2020-09-29 13:25:00'),
(165, 5, '2020-09-29 13:52:00'),
(166, 55, '2020-09-29 13:53:00'),
(167, 41, '2020-09-29 15:13:00'),
(168, 41, '2020-09-29 15:45:00'),
(169, 41, '2020-09-29 15:50:00'),
(170, 41, '2020-09-29 19:31:00'),
(171, 56, '2020-09-30 13:03:00'),
(172, 57, '2020-09-30 13:03:00'),
(173, 58, '2020-09-30 13:03:00'),
(174, 59, '2020-09-30 13:03:00'),
(175, 45, '2020-09-30 13:04:00'),
(176, 41, '2020-09-30 13:05:00'),
(177, 60, '2020-09-30 14:09:00'),
(178, 60, '2020-09-30 14:09:00'),
(179, 28, '2020-09-30 14:09:00'),
(180, 49, '2020-09-30 16:04:00'),
(181, 41, '2020-09-30 16:04:00'),
(182, 61, '2020-09-30 16:15:00'),
(183, 41, '2020-09-30 16:17:00'),
(184, 41, '2020-09-30 16:21:00'),
(185, 41, '2020-10-02 13:16:00'),
(186, 41, '2020-10-02 13:17:00'),
(187, 62, '2020-10-02 13:17:00'),
(188, 62, '2020-10-02 13:17:00'),
(189, 62, '2020-10-02 13:18:00'),
(190, 41, '2020-10-02 13:19:00'),
(191, 60, '2020-10-02 13:19:00'),
(192, 63, '2020-10-02 13:19:00'),
(193, 19, '2020-10-02 13:19:00'),
(194, 41, '2020-10-02 13:19:00'),
(195, 62, '2020-10-02 13:19:00'),
(196, 41, '2020-10-02 13:20:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trendings`
--

CREATE TABLE `trendings` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_noticias` int(10) UNSIGNED NOT NULL,
  `id_busqueda` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(128) NOT NULL,
  `extracto` varchar(512) NOT NULL,
  `programa` varchar(64) NOT NULL,
  `seccion` varchar(64) NOT NULL,
  `categoria` varchar(64) NOT NULL,
  `busqueda` varchar(512) NOT NULL,
  `tipo` varchar(16) NOT NULL,
  `link` varchar(2048) NOT NULL,
  `fecha_trending` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `trendings`
--

INSERT INTO `trendings` (`id`, `id_noticias`, `id_busqueda`, `titulo`, `extracto`, `programa`, `seccion`, `categoria`, `busqueda`, `tipo`, `link`, `fecha_trending`) VALUES
(1, 0, 0, '', '', '', '', '', 'mexico despide mundial', '', '', '2020-10-02 00:00:00'),
(2, 0, 0, '', '', '', '', '', 'mexico', '', '', '2020-10-02 00:00:00'),
(3, 0, 0, '', '', '', '', '', 'economia', '', '', '2020-10-02 00:00:00'),
(4, 0, 0, '', '', '', '', '', 'amlo', '', '', '2020-10-02 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE `visitas` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_noticia` int(10) NOT NULL,
  `id_busqueda` int(10) UNSIGNED NOT NULL,
  `link` varchar(2048) NOT NULL,
  `fecha_visita` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `visitas`
--

INSERT INTO `visitas` (`id`, `id_noticia`, `id_busqueda`, `link`, `fecha_visita`) VALUES
(5, 17, 19, '05-08-2020-13-36-18/amlo-llama-a-la-corte-a--no-dejarse-intimidar--y-oir-al-pueblo', '2020-09-25 16:08:55'),
(6, 17, 19, '05-08-2020-13-36-18/amlo-llama-a-la-corte-a--no-dejarse-intimidar--y-oir-al-pueblo', '2020-09-25 17:07:04'),
(7, 17, 19, '05-08-2020-13-36-18/amlo-llama-a-la-corte-a--no-dejarse-intimidar--y-oir-al-pueblo', '2020-09-25 17:07:05'),
(8, 17, 19, '05-08-2020-13-36-18/amlo-llama-a-la-corte-a--no-dejarse-intimidar--y-oir-al-pueblo', '2020-09-25 17:07:06'),
(9, 1, 41, '09-09-2020-13-25-52/pemex---el-mayor-dolor-de-cabeza--del-gobierno--jonathan-heath', '2020-09-25 17:08:43'),
(10, 1, 41, '09-09-2020-13-25-52/pemex---el-mayor-dolor-de-cabeza--del-gobierno--jonathan-heath', '2020-09-25 17:08:43'),
(11, 1, 41, '09-09-2020-13-25-52/pemex---el-mayor-dolor-de-cabeza--del-gobierno--jonathan-heath', '2020-09-25 17:08:43'),
(12, 1, 41, '09-09-2020-13-25-52/pemex---el-mayor-dolor-de-cabeza--del-gobierno--jonathan-heath', '2020-09-25 17:08:43'),
(13, 1, 41, '09-09-2020-13-25-52/pemex---el-mayor-dolor-de-cabeza--del-gobierno--jonathan-heath', '2020-09-25 17:08:43'),
(14, 1, 41, '09-09-2020-13-25-52/pemex---el-mayor-dolor-de-cabeza--del-gobierno--jonathan-heath', '2020-09-25 17:08:43'),
(15, 1, 41, '09-09-2020-13-25-52/pemex---el-mayor-dolor-de-cabeza--del-gobierno--jonathan-heath', '2020-09-25 17:08:43'),
(16, 4, 41, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 17:08:44'),
(17, 4, 41, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 17:08:45'),
(18, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-09-25 17:08:45'),
(19, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-09-25 17:08:45'),
(20, 15, 41, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-25 17:08:46'),
(21, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-25 17:08:49'),
(22, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-25 17:08:49'),
(23, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-25 17:08:49'),
(24, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-25 17:08:49'),
(25, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-25 17:08:49'),
(26, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-25 17:08:50'),
(27, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-25 17:08:50'),
(28, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-25 17:08:50'),
(29, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-25 17:08:50'),
(30, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-25 17:08:50'),
(31, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-25 17:08:50'),
(32, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-25 17:08:51'),
(33, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-25 17:08:51'),
(34, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-25 17:08:51'),
(35, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-25 17:08:51'),
(36, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-25 17:08:51'),
(37, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-25 17:08:52'),
(38, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-25 17:08:52'),
(39, 4, 53, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 17:20:05'),
(40, 3, 53, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-09-25 17:20:06'),
(41, 1, 53, '09-09-2020-13-25-52/pemex---el-mayor-dolor-de-cabeza--del-gobierno--jonathan-heath', '2020-09-25 17:20:07'),
(42, 16, 53, '04-08-2020-19-22-27/mexico-y-la--caida--del-peso', '2020-09-25 17:20:08'),
(43, 15, 53, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-25 17:20:09'),
(44, 8, 53, '03-08-2020-19-56-00/hay-nuevas-luces-sobre-la-verdad-del-caso-iguala--sanchez-cordero', '2020-09-25 17:20:10'),
(45, 16, 53, '04-08-2020-19-22-27/mexico-y-la--caida--del-peso', '2020-09-25 17:20:11'),
(46, 16, 53, '04-08-2020-19-22-27/mexico-y-la--caida--del-peso', '2020-09-25 17:20:12'),
(47, 16, 53, '04-08-2020-19-22-27/mexico-y-la--caida--del-peso', '2020-09-25 17:20:12'),
(48, 16, 53, '04-08-2020-19-22-27/mexico-y-la--caida--del-peso', '2020-09-25 17:20:12'),
(49, 16, 53, '04-08-2020-19-22-27/mexico-y-la--caida--del-peso', '2020-09-25 17:20:12'),
(50, 16, 53, '04-08-2020-19-22-27/mexico-y-la--caida--del-peso', '2020-09-25 17:20:12'),
(51, 1, 53, '09-09-2020-13-25-52/pemex---el-mayor-dolor-de-cabeza--del-gobierno--jonathan-heath', '2020-09-25 17:20:13'),
(52, 1, 53, '09-09-2020-13-25-52/pemex---el-mayor-dolor-de-cabeza--del-gobierno--jonathan-heath', '2020-09-25 17:20:13'),
(53, 1, 53, '09-09-2020-13-25-52/pemex---el-mayor-dolor-de-cabeza--del-gobierno--jonathan-heath', '2020-09-25 17:20:14'),
(54, 16, 53, '04-08-2020-19-22-27/mexico-y-la--caida--del-peso', '2020-09-25 17:20:25'),
(55, 16, 53, '04-08-2020-19-22-27/mexico-y-la--caida--del-peso', '2020-09-25 17:20:26'),
(56, 16, 53, '04-08-2020-19-22-27/mexico-y-la--caida--del-peso', '2020-09-25 17:20:26'),
(57, 16, 53, '04-08-2020-19-22-27/mexico-y-la--caida--del-peso', '2020-09-25 17:20:26'),
(58, 16, 53, '04-08-2020-19-22-27/mexico-y-la--caida--del-peso', '2020-09-25 17:20:26'),
(59, 8, 53, '03-08-2020-19-56-00/hay-nuevas-luces-sobre-la-verdad-del-caso-iguala--sanchez-cordero', '2020-09-25 17:20:27'),
(60, 8, 53, '03-08-2020-19-56-00/hay-nuevas-luces-sobre-la-verdad-del-caso-iguala--sanchez-cordero', '2020-09-25 17:20:27'),
(61, 8, 53, '03-08-2020-19-56-00/hay-nuevas-luces-sobre-la-verdad-del-caso-iguala--sanchez-cordero', '2020-09-25 17:20:27'),
(62, 8, 53, '03-08-2020-19-56-00/hay-nuevas-luces-sobre-la-verdad-del-caso-iguala--sanchez-cordero', '2020-09-25 17:20:28'),
(63, 8, 53, '03-08-2020-19-56-00/hay-nuevas-luces-sobre-la-verdad-del-caso-iguala--sanchez-cordero', '2020-09-25 17:20:28'),
(64, 4, 29, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 17:27:41'),
(65, 4, 29, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 17:27:42'),
(66, 4, 29, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 17:27:42'),
(67, 4, 29, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 17:27:42'),
(68, 4, 29, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 17:27:42'),
(69, 4, 29, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 17:27:42'),
(70, 4, 29, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 17:27:42'),
(71, 4, 29, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 17:27:43'),
(72, 4, 29, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 17:27:43'),
(73, 15, 29, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-25 17:27:43'),
(74, 15, 29, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-25 17:27:44'),
(75, 15, 29, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-25 17:27:44'),
(76, 15, 29, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-25 17:27:44'),
(77, 15, 29, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-25 17:27:44'),
(78, 15, 29, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-25 17:27:44'),
(79, 15, 29, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-25 17:27:45'),
(80, 15, 29, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-25 17:27:45'),
(81, 4, 29, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 17:27:46'),
(82, 4, 29, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 17:27:46'),
(83, 4, 29, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 17:27:46'),
(84, 15, 5, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-25 17:38:42'),
(85, 15, 5, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-25 17:38:42'),
(86, 15, 5, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-25 17:38:42'),
(87, 15, 5, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-25 17:38:42'),
(88, 15, 5, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-25 17:38:43'),
(89, 15, 5, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-25 17:38:43'),
(90, 15, 5, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-25 17:38:43'),
(91, 15, 5, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-25 17:38:43'),
(92, 15, 5, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-25 17:38:44'),
(93, 4, 54, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 17:38:49'),
(94, 4, 54, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 17:38:49'),
(95, 4, 54, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 17:38:49'),
(96, 4, 54, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 17:38:49'),
(97, 4, 54, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 17:38:50'),
(98, 4, 54, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 17:38:50'),
(99, 4, 54, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 18:50:59'),
(100, 4, 54, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 18:50:59'),
(101, 4, 54, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 18:50:59'),
(102, 4, 54, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 18:50:59'),
(103, 4, 54, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 18:51:00'),
(104, 4, 54, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 20:23:48'),
(105, 4, 54, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 20:23:48'),
(106, 4, 54, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 20:23:49'),
(107, 4, 54, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 20:23:49'),
(108, 4, 54, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-25 20:23:49'),
(109, 17, 19, '05-08-2020-13-36-18/amlo-llama-a-la-corte-a--no-dejarse-intimidar--y-oir-al-pueblo', '2020-09-29 13:01:19'),
(110, 17, 19, '05-08-2020-13-36-18/amlo-llama-a-la-corte-a--no-dejarse-intimidar--y-oir-al-pueblo', '2020-09-29 13:01:19'),
(111, 17, 19, '05-08-2020-13-36-18/amlo-llama-a-la-corte-a--no-dejarse-intimidar--y-oir-al-pueblo', '2020-09-29 13:01:19'),
(112, 17, 19, '05-08-2020-13-36-18/amlo-llama-a-la-corte-a--no-dejarse-intimidar--y-oir-al-pueblo', '2020-09-29 13:01:20'),
(113, 17, 19, '05-08-2020-13-36-18/amlo-llama-a-la-corte-a--no-dejarse-intimidar--y-oir-al-pueblo', '2020-09-29 13:01:20'),
(114, 17, 19, '05-08-2020-13-36-18/amlo-llama-a-la-corte-a--no-dejarse-intimidar--y-oir-al-pueblo', '2020-09-29 13:01:20'),
(115, 17, 19, '05-08-2020-13-36-18/amlo-llama-a-la-corte-a--no-dejarse-intimidar--y-oir-al-pueblo', '2020-09-29 13:01:20'),
(116, 17, 19, '05-08-2020-13-36-18/amlo-llama-a-la-corte-a--no-dejarse-intimidar--y-oir-al-pueblo', '2020-09-29 13:01:20'),
(117, 17, 19, '05-08-2020-13-36-18/amlo-llama-a-la-corte-a--no-dejarse-intimidar--y-oir-al-pueblo', '2020-09-29 13:01:20'),
(118, 17, 19, '05-08-2020-13-36-18/amlo-llama-a-la-corte-a--no-dejarse-intimidar--y-oir-al-pueblo', '2020-09-29 13:01:21'),
(119, 17, 19, '05-08-2020-13-36-18/amlo-llama-a-la-corte-a--no-dejarse-intimidar--y-oir-al-pueblo', '2020-09-29 13:01:21'),
(120, 17, 19, '05-08-2020-13-36-18/amlo-llama-a-la-corte-a--no-dejarse-intimidar--y-oir-al-pueblo', '2020-09-29 13:01:21'),
(121, 15, 5, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-29 13:26:01'),
(122, 15, 5, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-29 13:26:01'),
(123, 15, 5, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-29 13:26:01'),
(124, 15, 5, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-29 13:26:01'),
(125, 15, 5, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-29 13:26:01'),
(126, 15, 5, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-29 13:26:01'),
(127, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:26:02'),
(128, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:26:02'),
(129, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:26:03'),
(130, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:26:03'),
(131, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:26:03'),
(132, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:26:03'),
(133, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:26:03'),
(134, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:26:03'),
(135, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:26:03'),
(136, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:26:04'),
(137, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:26:04'),
(138, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:26:04'),
(139, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:26:04'),
(140, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:26:04'),
(141, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:26:05'),
(142, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:26:05'),
(143, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:26:05'),
(144, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:26:05'),
(145, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:26:05'),
(146, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:26:05'),
(147, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:26:06'),
(148, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:26:06'),
(149, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:26:06'),
(150, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:26:06'),
(151, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:26:06'),
(152, 15, 5, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-29 13:34:35'),
(153, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:34:36'),
(154, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:52:37'),
(155, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:52:38'),
(156, 4, 5, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:52:38'),
(157, 15, 5, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-29 13:52:51'),
(158, 4, 55, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:53:54'),
(159, 4, 55, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 13:56:17'),
(160, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-09-29 15:13:18'),
(161, 15, 41, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-29 15:13:20'),
(162, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-29 15:13:22'),
(163, 4, 41, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 15:13:25'),
(164, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-09-29 15:36:12'),
(165, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-09-29 15:36:12'),
(166, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-09-29 15:37:03'),
(167, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-09-29 15:38:24'),
(168, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-09-29 15:39:42'),
(169, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-09-29 15:40:49'),
(170, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-09-29 15:45:24'),
(171, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-09-29 15:50:14'),
(172, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-09-29 19:21:00'),
(173, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-09-29 19:31:23'),
(174, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-09-29 19:53:36'),
(175, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-09-29 19:55:11'),
(176, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-09-29 19:59:36'),
(177, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-09-29 20:01:28'),
(178, 8, 41, '03-08-2020-19-56-00/hay-nuevas-luces-sobre-la-verdad-del-caso-iguala--sanchez-cordero', '2020-09-29 20:03:34'),
(179, 8, 41, '03-08-2020-19-56-00/hay-nuevas-luces-sobre-la-verdad-del-caso-iguala--sanchez-cordero', '2020-09-29 20:09:39'),
(180, 8, 41, '03-08-2020-19-56-00/hay-nuevas-luces-sobre-la-verdad-del-caso-iguala--sanchez-cordero', '2020-09-29 20:12:27'),
(181, 8, 41, '03-08-2020-19-56-00/hay-nuevas-luces-sobre-la-verdad-del-caso-iguala--sanchez-cordero', '2020-09-29 20:38:24'),
(182, 16, 41, '04-08-2020-19-22-27/mexico-y-la--caida--del-peso', '2020-09-29 20:42:48'),
(183, 1, 41, '09-09-2020-13-25-52/pemex---el-mayor-dolor-de-cabeza--del-gobierno--jonathan-heath', '2020-09-29 20:43:15'),
(184, 8, 41, '03-08-2020-19-56-00/hay-nuevas-luces-sobre-la-verdad-del-caso-iguala--sanchez-cordero', '2020-09-29 20:43:36'),
(185, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-29 20:44:39'),
(186, 1, 41, '09-09-2020-13-25-52/pemex---el-mayor-dolor-de-cabeza--del-gobierno--jonathan-heath', '2020-09-29 20:44:41'),
(187, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-09-29 20:44:44'),
(188, 4, 41, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 20:44:45'),
(189, 4, 41, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 20:44:46'),
(190, 4, 41, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 20:44:46'),
(191, 4, 41, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 20:44:47'),
(192, 4, 41, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 20:44:47'),
(193, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-09-29 20:45:10'),
(194, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-09-29 20:45:10'),
(195, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-09-29 20:45:11'),
(196, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-09-29 20:45:12'),
(197, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-09-29 20:45:13'),
(198, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-09-29 21:05:30'),
(199, 1, 41, '09-09-2020-13-25-52/pemex---el-mayor-dolor-de-cabeza--del-gobierno--jonathan-heath', '2020-09-29 21:05:38'),
(200, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-09-29 21:24:22'),
(201, 4, 41, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 21:24:29'),
(202, 4, 41, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 21:25:56'),
(203, 1, 41, '09-09-2020-13-25-52/pemex---el-mayor-dolor-de-cabeza--del-gobierno--jonathan-heath', '2020-09-29 21:27:34'),
(204, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-09-29 21:27:37'),
(205, 4, 41, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-29 21:27:39'),
(206, 16, 41, '04-08-2020-19-22-27/mexico-y-la--caida--del-peso', '2020-09-30 13:28:10'),
(207, 16, 41, '04-08-2020-19-22-27/mexico-y-la--caida--del-peso', '2020-09-30 13:28:10'),
(208, 16, 41, '04-08-2020-19-22-27/mexico-y-la--caida--del-peso', '2020-09-30 13:28:10'),
(209, 16, 41, '04-08-2020-19-22-27/mexico-y-la--caida--del-peso', '2020-09-30 13:28:11'),
(210, 16, 41, '04-08-2020-19-22-27/mexico-y-la--caida--del-peso', '2020-09-30 13:28:11'),
(211, 16, 41, '04-08-2020-19-22-27/mexico-y-la--caida--del-peso', '2020-09-30 13:28:11'),
(212, 16, 41, '04-08-2020-19-22-27/mexico-y-la--caida--del-peso', '2020-09-30 13:28:11'),
(213, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 13:29:56'),
(214, 8, 41, '03-08-2020-19-56-00/hay-nuevas-luces-sobre-la-verdad-del-caso-iguala--sanchez-cordero', '2020-09-30 13:36:32'),
(215, 8, 41, '03-08-2020-19-56-00/hay-nuevas-luces-sobre-la-verdad-del-caso-iguala--sanchez-cordero', '2020-09-30 13:49:18'),
(216, 1, 41, '09-09-2020-13-25-52/pemex---el-mayor-dolor-de-cabeza--del-gobierno--jonathan-heath', '2020-09-30 13:50:41'),
(217, 16, 41, '04-08-2020-19-22-27/mexico-y-la--caida--del-peso', '2020-09-30 13:52:26'),
(218, 16, 41, '04-08-2020-19-22-27/mexico-y-la--caida--del-peso', '2020-09-30 14:01:03'),
(219, 16, 41, '04-08-2020-19-22-27/mexico-y-la--caida--del-peso', '2020-09-30 14:01:13'),
(220, 1, 41, '09-09-2020-13-25-52/pemex---el-mayor-dolor-de-cabeza--del-gobierno--jonathan-heath', '2020-09-30 14:01:15'),
(221, 15, 41, '04-08-2020-19-18-00/mexico-proxima-potencia-mundial', '2020-09-30 14:01:21'),
(222, 8, 41, '03-08-2020-19-56-00/hay-nuevas-luces-sobre-la-verdad-del-caso-iguala--sanchez-cordero', '2020-09-30 14:01:42'),
(223, 4, 41, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-30 14:05:38'),
(224, 4, 41, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-30 14:07:44'),
(225, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-09-30 14:07:54'),
(226, 1, 41, '09-09-2020-13-25-52/pemex---el-mayor-dolor-de-cabeza--del-gobierno--jonathan-heath', '2020-09-30 14:08:00'),
(227, 16, 41, '04-08-2020-19-22-27/mexico-y-la--caida--del-peso', '2020-09-30 14:08:08'),
(228, 2, 28, '09-09-2020-13-28-06/covid-19-deja-mas-de-190-mil-muertes-en-eu', '2020-09-30 14:09:07'),
(229, 2, 28, '09-09-2020-13-28-06/covid-19-deja-mas-de-190-mil-muertes-en-eu', '2020-09-30 14:10:31'),
(230, 2, 28, '09-09-2020-13-28-06/covid-19-deja-mas-de-190-mil-muertes-en-eu', '2020-09-30 14:11:28'),
(231, 2, 28, '09-09-2020-13-28-06/covid-19-deja-mas-de-190-mil-muertes-en-eu', '2020-09-30 14:11:28'),
(232, 2, 28, '09-09-2020-13-28-06/covid-19-deja-mas-de-190-mil-muertes-en-eu', '2020-09-30 14:11:28'),
(233, 4, 41, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-30 16:13:42'),
(234, 4, 41, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-09-30 16:13:42'),
(235, 1, 61, '09-09-2020-13-25-52/pemex---el-mayor-dolor-de-cabeza--del-gobierno--jonathan-heath', '2020-09-30 16:15:49'),
(236, 1, 61, '09-09-2020-13-25-52/pemex---el-mayor-dolor-de-cabeza--del-gobierno--jonathan-heath', '2020-09-30 16:15:49'),
(237, 1, 61, '09-09-2020-13-25-52/pemex---el-mayor-dolor-de-cabeza--del-gobierno--jonathan-heath', '2020-09-30 16:15:49'),
(238, 1, 61, '09-09-2020-13-25-52/pemex---el-mayor-dolor-de-cabeza--del-gobierno--jonathan-heath', '2020-09-30 16:15:50'),
(239, 1, 61, '09-09-2020-13-25-52/pemex---el-mayor-dolor-de-cabeza--del-gobierno--jonathan-heath', '2020-09-30 16:15:50'),
(240, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:01'),
(241, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:01'),
(242, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:01'),
(243, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:01'),
(244, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:02'),
(245, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:02'),
(246, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:02'),
(247, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:02'),
(248, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:02'),
(249, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:02'),
(250, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:03'),
(251, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:03'),
(252, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:03'),
(253, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:03'),
(254, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:04'),
(255, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:04'),
(256, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:04'),
(257, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:04'),
(258, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:04'),
(259, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:04'),
(260, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:05'),
(261, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:05'),
(262, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:05'),
(263, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:05'),
(264, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:05'),
(265, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:05'),
(266, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:05'),
(267, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:06'),
(268, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:06'),
(269, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:06'),
(270, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:06'),
(271, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:06'),
(272, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:07'),
(273, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:07'),
(274, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:07'),
(275, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:07'),
(276, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:07'),
(277, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:07'),
(278, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:08'),
(279, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:08'),
(280, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:08'),
(281, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:08'),
(282, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:08'),
(283, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:09'),
(284, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:09'),
(285, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:18'),
(286, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:18'),
(287, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:18'),
(288, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:18'),
(289, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:18'),
(290, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:18'),
(291, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:19'),
(292, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:19'),
(293, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:19'),
(294, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:19'),
(295, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:19'),
(296, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:20'),
(297, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:19:20'),
(298, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:10'),
(299, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:10'),
(300, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:10'),
(301, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:10'),
(302, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:11'),
(303, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:11'),
(304, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:11'),
(305, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:11'),
(306, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:11'),
(307, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:12'),
(308, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:12'),
(309, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:12'),
(310, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:12'),
(311, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:12'),
(312, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:13'),
(313, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:13'),
(314, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:13'),
(315, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:13'),
(316, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:13'),
(317, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:13'),
(318, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:13'),
(319, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:14'),
(320, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:14'),
(321, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:14'),
(322, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:14'),
(323, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:14'),
(324, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:15'),
(325, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:15'),
(326, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:15'),
(327, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:15'),
(328, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:15'),
(329, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:15'),
(330, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:16'),
(331, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:16'),
(332, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:16'),
(333, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:20:16'),
(334, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:21:11'),
(335, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:21:11'),
(336, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:21:11'),
(337, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:21:12'),
(338, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:21:12'),
(339, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:21:12'),
(340, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:21:12'),
(341, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:21:12'),
(342, 8, 41, '03-08-2020-19-56-00/hay-nuevas-luces-sobre-la-verdad-del-caso-iguala--sanchez-cordero', '2020-09-30 16:22:56'),
(343, 7, 41, '03-08-2020-19-25-23/hispano-suiza-llega-a-mexico-para-electrificar-a-los-superdeportivos', '2020-09-30 16:30:30'),
(344, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-10-02 13:16:57'),
(345, 3, 41, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-10-02 13:16:57'),
(346, 1, 41, '09-09-2020-13-25-52/pemex---el-mayor-dolor-de-cabeza--del-gobierno--jonathan-heath', '2020-10-02 13:16:57'),
(347, 4, 41, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-10-02 13:16:57'),
(348, 4, 62, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-10-02 13:17:42'),
(349, 4, 62, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-10-02 13:17:43'),
(350, 4, 62, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-10-02 13:17:44'),
(351, 1, 62, '09-09-2020-13-25-52/pemex---el-mayor-dolor-de-cabeza--del-gobierno--jonathan-heath', '2020-10-02 13:17:44'),
(352, 1, 62, '09-09-2020-13-25-52/pemex---el-mayor-dolor-de-cabeza--del-gobierno--jonathan-heath', '2020-10-02 13:17:45'),
(353, 1, 62, '09-09-2020-13-25-52/pemex---el-mayor-dolor-de-cabeza--del-gobierno--jonathan-heath', '2020-10-02 13:17:45'),
(354, 3, 62, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-10-02 13:17:47'),
(355, 3, 62, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-10-02 13:17:47'),
(356, 3, 62, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-10-02 13:17:47'),
(357, 3, 62, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-10-02 13:17:48'),
(358, 3, 62, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-10-02 13:17:48'),
(359, 3, 62, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-10-02 13:17:48'),
(360, 4, 41, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-10-02 13:19:07'),
(361, 1, 41, '09-09-2020-13-25-52/pemex---el-mayor-dolor-de-cabeza--del-gobierno--jonathan-heath', '2020-10-02 13:19:10'),
(362, 4, 63, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-10-02 13:19:28'),
(363, 3, 63, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-10-02 13:19:29'),
(364, 17, 19, '05-08-2020-13-36-18/amlo-llama-a-la-corte-a--no-dejarse-intimidar--y-oir-al-pueblo', '2020-10-02 13:19:39'),
(365, 4, 41, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-10-02 13:19:45'),
(366, 4, 62, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-10-02 13:20:00'),
(367, 3, 62, '09-09-2020-13-29-48/banca-entro-a-la-crisis-en-una-posicion-solida--bdem', '2020-10-02 13:20:02'),
(368, 4, 41, '09-09-2020-13-30-59/el-presupuesto-de-2021--para-enfrentar-la-doble-crisis', '2020-10-02 13:20:07');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `behavior`
--
ALTER TABLE `behavior`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `behavior_bucket`
--
ALTER TABLE `behavior_bucket`
  ADD PRIMARY KEY (`token`);

--
-- Indices de la tabla `historico_busquedas`
--
ALTER TABLE `historico_busquedas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `palabras` (`palabras`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `titulo_idx` (`Titulo`),
  ADD KEY `extracto_idx` (`Extracto`);
ALTER TABLE `noticias` ADD FULLTEXT KEY `cubeta_idx` (`Cubeta`);

--
-- Indices de la tabla `tendencias`
--
ALTER TABLE `tendencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trendings`
--
ALTER TABLE `trendings`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `visitas` ADD FULLTEXT KEY `url` (`link`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `behavior`
--
ALTER TABLE `behavior`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT de la tabla `historico_busquedas`
--
ALTER TABLE `historico_busquedas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `tendencias`
--
ALTER TABLE `tendencias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT de la tabla `trendings`
--
ALTER TABLE `trendings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=369;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
