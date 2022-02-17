-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2022 at 02:00 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `caucahassfl`
--

-- --------------------------------------------------------

--
-- Table structure for table `aplquimicos`
--

CREATE TABLE `aplquimicos` (
  `id` int(10) UNSIGNED NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `finca_id` int(10) UNSIGNED NOT NULL,
  `fechaAplicacion` date NOT NULL,
  `quimico_id` int(10) UNSIGNED NOT NULL,
  `nombreIngenieroAgronomo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `concentracion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RegistroICA` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Dosis` int(11) NOT NULL,
  `periodoCarencia` int(11) NOT NULL,
  `periodoEntrada` int(11) NOT NULL,
  `formaAplicacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recomendo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Aplico` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aplquimicos`
--

INSERT INTO `aplquimicos` (`id`, `productor_id`, `finca_id`, `fechaAplicacion`, `quimico_id`, `nombreIngenieroAgronomo`, `concentracion`, `RegistroICA`, `Dosis`, `periodoCarencia`, `periodoEntrada`, `formaAplicacion`, `recomendo`, `Aplico`, `created_at`, `updated_at`) VALUES
(2, 3, 1, '2022-01-01', 1, 'JAIME', '34-2-3', 'ABS456', 34, 4, 3, 'BOMBA DE ESPADA', 'JULIO', 'JAIME', '2022-01-25 21:14:32', '2022-01-25 21:14:32');

-- --------------------------------------------------------

--
-- Table structure for table `articulos`
--

CREATE TABLE `articulos` (
  `id` int(10) UNSIGNED NOT NULL,
  `idcategoria` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio_venta` decimal(11,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `descripcion` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cadenas`
--

CREATE TABLE `cadenas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departamentos`
--

CREATE TABLE `departamentos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departamentos`
--

INSERT INTO `departamentos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'CAUCA', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(2, 'AMAZONAS', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(3, 'ANTIOQUIA', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(4, 'ARAUCA', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(5, 'ATLANTICO', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(6, 'BOLIVAR', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(7, 'BOYACA', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(8, 'CALDAS', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(9, 'CAQUETA', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(10, 'CASANARE', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(11, 'CESAR', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(12, 'CHOCO', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(13, 'CORDOBA', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(14, 'CUNDINAMARCA', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(15, 'GUAINIA', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(16, 'GUAJIRA', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(17, 'GUAVIARE', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(18, 'HUILA', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(19, 'MAGDALENA', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(20, 'META', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(21, 'N SANTANDER', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(22, 'NARINO', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(23, 'PUTUMAYO', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(24, 'QUINDIO', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(25, 'RISARALDA', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(26, 'SAN ANDRES', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(27, 'SANTANDER', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(28, 'SUCRE', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(29, 'TOLIMA', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(30, 'VALLE DEL CAUCA', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(31, 'VAUPES', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(32, 'VICHADA', '2022-01-25 12:57:05', '2022-01-25 12:57:05');

-- --------------------------------------------------------

--
-- Table structure for table `etnias`
--

CREATE TABLE `etnias` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `etnias`
--

INSERT INTO `etnias` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Indigena', '2022-01-25 12:57:05', '2022-01-25 12:57:05');

-- --------------------------------------------------------

--
-- Table structure for table `fertilizantes`
--

CREATE TABLE `fertilizantes` (
  `id` int(10) UNSIGNED NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `finca_id` int(10) UNSIGNED NOT NULL,
  `fechaAplicacion` date NOT NULL,
  `nombreProducto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombreIngenieroAgronomo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `concentracion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RegistroICA` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Dosis` int(11) NOT NULL,
  `formaAplicacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recomendo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Aplico` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fertilizantes`
--

INSERT INTO `fertilizantes` (`id`, `productor_id`, `finca_id`, `fechaAplicacion`, `nombreProducto`, `nombreIngenieroAgronomo`, `concentracion`, `RegistroICA`, `Dosis`, `formaAplicacion`, `recomendo`, `Aplico`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2022-01-01', 'PRODUCTO', 'JAIME', '25-24-3', 'RN325', 43, 'EDAFICA', 'JULIO', 'JAIME', '2022-01-25 19:59:40', '2022-01-25 19:59:40'),
(2, 3, 1, '2021-12-02', 'PRRE', 'JULIAN', '12-45-2', 'RS431', 31, 'FOLIAR', 'JULIO', 'JULIAN', '2022-01-25 20:23:02', '2022-01-25 20:23:02'),
(3, 3, 1, '2022-01-02', 'Fertilizante', 'jaime', '25-40-54', 'rn4213551', 321, 'EDAFICA', 'juan', 'jaime', '2022-01-26 00:56:22', '2022-01-26 00:56:22');

-- --------------------------------------------------------

--
-- Table structure for table `fincas`
--

CREATE TABLE `fincas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `areaPredio` decimal(11,2) NOT NULL,
  `longitudPredio` decimal(11,6) NOT NULL,
  `latitudPredio` decimal(11,6) NOT NULL,
  `altitudPredio` decimal(11,2) NOT NULL,
  `departamento_id` int(10) UNSIGNED NOT NULL,
  `municipio_id` int(10) UNSIGNED NOT NULL,
  `vereda` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posesion_id` int(10) UNSIGNED NOT NULL,
  `distanciaAlLote` decimal(11,2) NOT NULL,
  `distanciaLoteVia` decimal(11,2) NOT NULL,
  `coordenadasFinca` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fincas`
--

INSERT INTO `fincas` (`id`, `nombre`, `productor_id`, `areaPredio`, `longitudPredio`, `latitudPredio`, `altitudPredio`, `departamento_id`, `municipio_id`, `vereda`, `posesion_id`, `distanciaAlLote`, `distanciaLoteVia`, `coordenadasFinca`, `created_at`, `updated_at`) VALUES
(1, 'PRUEBA', 3, '42342.00', '-3.450000', '76.430000', '1590.00', 1, 5, 'VEREDITA', 1, '423.00', '33.00', 'CHORRERA', '2022-01-25 18:45:38', '2022-01-25 19:03:06');

-- --------------------------------------------------------

--
-- Table structure for table `gpxs`
--

CREATE TABLE `gpxs` (
  `id` int(10) UNSIGNED NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `finca_id` int(10) UNSIGNED NOT NULL,
  `latitud` decimal(20,19) NOT NULL,
  `longitud` decimal(21,19) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gpxzones`
--

CREATE TABLE `gpxzones` (
  `id` int(10) UNSIGNED NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `finca_id` int(10) UNSIGNED NOT NULL,
  `linea` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gradoescolaridads`
--

CREATE TABLE `gradoescolaridads` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gradoescolaridads`
--

INSERT INTO `gradoescolaridads` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Primaria Incompleta', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(2, 'Primaria', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(3, 'Bachiller Incompleto', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(4, 'Bachiller', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(5, 'Tecnico Incompleto', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(6, 'Tecnico', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(7, 'Tecnologo Incompleto', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(8, 'Tecnologo', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(9, 'Universitario Incompleto', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(10, 'Universitario', '2022-01-25 12:57:05', '2022-01-25 12:57:05');

-- --------------------------------------------------------

--
-- Table structure for table `lineas`
--

CREATE TABLE `lineas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lugarventas`
--

CREATE TABLE `lugarventas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2020_10_20_163925_create_categorias_table', 1),
(3, '2020_10_21_194417_create_articulos_table', 1),
(4, '2020_11_25_071247_create_caucahass_core', 1),
(5, '2020_12_02_034407_create_roles_table', 1),
(6, '2020_12_03_000000_create_users_table', 1),
(7, '2020_12_29_180038_create_gpx_upload', 1),
(8, '2021_08_09_222410_create_gpx_zone', 1),
(9, '2022_01_25_191335_create_fertilizantes', 2);

-- --------------------------------------------------------

--
-- Table structure for table `municipios`
--

CREATE TABLE `municipios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departamento_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `municipios`
--

INSERT INTO `municipios` (`id`, `nombre`, `departamento_id`, `created_at`, `updated_at`) VALUES
(1, 'TORIBIO', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(2, 'ALMAGUER', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(3, 'ARGELIA', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(4, 'BALBOA', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(5, 'BOLIVAR', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(6, 'BUENOS AIRES', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(7, 'CAJIBIO', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(8, 'CALDONO', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(9, 'CALOTO', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(10, 'CORINTO', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(11, 'EL TAMBO', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(12, 'FLORENCIA', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(13, 'GUAPI', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(14, 'INZA', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(15, 'JAMBALO', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(16, 'LA SIERRA', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(17, 'LA VEGA', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(18, 'LOPEZ', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(19, 'MERCADERES', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(20, 'MIRANDA', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(21, 'MORALES', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(22, 'PADILLA', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(23, 'PAEZ', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(24, 'PATIA', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(25, 'PIAMONTE', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(26, 'PIENDAMO', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(27, 'POPAYAN', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(28, 'PUERTO TEJADA', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(29, 'PURACE', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(30, 'ROSAS', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(31, 'SAN SEBASTIAN', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(32, 'SANTA ROSA', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(33, 'SANTANDER DE QUILICHAO', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(34, 'SILVIA', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(35, 'SOTARA', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(36, 'SUAREZ', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(37, 'SUCRE', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(38, 'TIMBIO', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(39, 'TIMBIQUI', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(40, 'TOTORO', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(41, 'VILLA RICA', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personas`
--

CREATE TABLE `personas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_id` int(10) UNSIGNED NOT NULL,
  `num_documento` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personas`
--

INSERT INTO `personas` (`id`, `nombre`, `tipo_id`, `num_documento`, `direccion`, `telefono`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 1, '1107090570', 'cll 123', NULL, NULL, NULL, NULL),
(3, 'PSFA', 1, '2342432432', 'Cra 26 #17-31', '3155644407', 'Millansantiago15@gmail.com', '2022-01-25 13:14:18', '2022-01-25 13:14:18');

-- --------------------------------------------------------

--
-- Table structure for table `posesions`
--

CREATE TABLE `posesions` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posesions`
--

INSERT INTO `posesions` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Arriendo', NULL, NULL),
(2, 'Compra', NULL, NULL),
(3, 'Herencia', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `productors`
--

CREATE TABLE `productors` (
  `id` int(10) UNSIGNED NOT NULL,
  `fechaExpedicion` date NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `sexo_id` int(10) UNSIGNED NOT NULL,
  `departamento_id` int(10) UNSIGNED NOT NULL,
  `municipio_id` int(10) UNSIGNED NOT NULL,
  `vereda` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechaIngreso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productors`
--

INSERT INTO `productors` (`id`, `fechaExpedicion`, `fechaNacimiento`, `sexo_id`, `departamento_id`, `municipio_id`, `vereda`, `fechaIngreso`) VALUES
(3, '2022-01-01', '2022-01-06', 1, 1, 8, 'vereda', '2022-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `productosfertilizantes`
--

CREATE TABLE `productosfertilizantes` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productosfertilizantes`
--

INSERT INTO `productosfertilizantes` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Fertilizante', '2022-01-26 00:40:19', '2022-01-26 00:40:19'),
(2, 'PRUEBA', '2022-01-26 00:53:47', '2022-01-26 00:53:47');

-- --------------------------------------------------------

--
-- Table structure for table `quimicos`
--

CREATE TABLE `quimicos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quimicos`
--

INSERT INTO `quimicos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'PRUEBA', NULL, NULL),
(2, 'quimico', '2022-01-25 21:55:50', '2022-01-25 21:55:50'),
(3, 'producto quimico', '2022-01-25 22:11:04', '2022-01-25 22:11:04');

-- --------------------------------------------------------

--
-- Table structure for table `resguardos`
--

CREATE TABLE `resguardos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resguardos`
--

INSERT INTO `resguardos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'TACUEYO', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(2, 'TORIBIO', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(3, 'SAN FRANCISCO', '2022-01-25 12:57:05', '2022-01-25 12:57:05');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `condicion`) VALUES
(1, 'Administrador', 'Administrador del sistema', 1),
(2, 'Tecnico Comercial', 'Tecnicos que realizan ventas', 1),
(3, 'Tecnico Extensionista', 'Tecnico encargado de los levantamientos', 1),
(4, 'Productor', 'Productores de asofrut', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sexos`
--

CREATE TABLE `sexos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sexos`
--

INSERT INTO `sexos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Masculino', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(2, 'Femenino', '2022-01-25 12:57:05', '2022-01-25 12:57:05');

-- --------------------------------------------------------

--
-- Table structure for table `tipoids`
--

CREATE TABLE `tipoids` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tipoids`
--

INSERT INTO `tipoids` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Cedula de ciudadania', '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(2, 'Tarjeta de identidad', '2022-01-25 12:57:05', '2022-01-25 12:57:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1,
  `idrol` int(10) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usuario`, `password`, `condicion`, `idrol`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, '2342432432', '$2y$10$ZTfm0Zxg93Qo5Zf6eqJmKulJD5VPMTmjNLN5OkxmuQy5IlJl2JLYe', 1, 4, NULL, NULL, NULL),
(1, 'admin@sistemas.com', '$2y$10$sugk64mZOHhSV63KYO8oveXEv1Uuvs9NOSAU0pwh6beuAWZUZBZDW', 1, 1, 'ffOUUJPcdwkHKSttrHs8BPxMPbutHTZQZZloJ0CR6utuGcYeyhQnwuicTiX1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `veredas`
--

CREATE TABLE `veredas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `municipio_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `veredas`
--

INSERT INTO `veredas` (`id`, `nombre`, `municipio_id`, `created_at`, `updated_at`) VALUES
(1, 'CULEBRERO', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(2, 'El FLAYO', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(3, 'GARGANTILLAS', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(4, 'HIMICUETO', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(5, 'HUTLA', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(6, 'LA CALERA', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(7, 'LA CAPILLA', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(8, 'LA ESTRELLA', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(9, 'LA JULIA', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(10, 'LA PALMA', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(11, 'LA PLAYA', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(12, 'LA PRIMICIA', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(13, 'LA SUSANA', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(14, 'LOPEZ', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(15, 'QUINAMAYO', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(16, 'SESTADERO', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(17, 'TACUEYO', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(18, 'TORIBIO', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(19, 'TRAPICHE', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(20, 'ULLUCOS', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05'),
(21, 'VICHIQUI', 1, '2022-01-25 12:57:05', '2022-01-25 12:57:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aplquimicos`
--
ALTER TABLE `aplquimicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aplquimicos_productor_id_foreign` (`productor_id`),
  ADD KEY `aplquimicos_finca_id_foreign` (`finca_id`),
  ADD KEY `aplquimicos_quimico_id_foreign` (`quimico_id`);

--
-- Indexes for table `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `articulos_nombre_unique` (`nombre`),
  ADD KEY `articulos_idcategoria_foreign` (`idcategoria`);

--
-- Indexes for table `cadenas`
--
ALTER TABLE `cadenas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cadenas_nombre_unique` (`nombre`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departamentos_nombre_unique` (`nombre`);

--
-- Indexes for table `etnias`
--
ALTER TABLE `etnias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `etnias_nombre_unique` (`nombre`);

--
-- Indexes for table `fertilizantes`
--
ALTER TABLE `fertilizantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fertilizantes_productor_id_foreign` (`productor_id`),
  ADD KEY `fertilizantes_finca_id_foreign` (`finca_id`);

--
-- Indexes for table `fincas`
--
ALTER TABLE `fincas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fincas_productor_id_foreign` (`productor_id`),
  ADD KEY `fincas_departamento_id_foreign` (`departamento_id`),
  ADD KEY `fincas_municipio_id_foreign` (`municipio_id`),
  ADD KEY `fincas_posesion_id_foreign` (`posesion_id`);

--
-- Indexes for table `gpxs`
--
ALTER TABLE `gpxs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gpxs_productor_id_foreign` (`productor_id`),
  ADD KEY `gpxs_finca_id_foreign` (`finca_id`);

--
-- Indexes for table `gpxzones`
--
ALTER TABLE `gpxzones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gpxzones_productor_id_foreign` (`productor_id`),
  ADD KEY `gpxzones_finca_id_foreign` (`finca_id`);

--
-- Indexes for table `gradoescolaridads`
--
ALTER TABLE `gradoescolaridads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gradoescolaridads_nombre_unique` (`nombre`);

--
-- Indexes for table `lineas`
--
ALTER TABLE `lineas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lineas_nombre_unique` (`nombre`);

--
-- Indexes for table `lugarventas`
--
ALTER TABLE `lugarventas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lugarventas_nombre_unique` (`nombre`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `municipios_nombre_unique` (`nombre`),
  ADD KEY `municipios_departamento_id_foreign` (`departamento_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personas_nombre_unique` (`nombre`),
  ADD KEY `personas_tipo_id_foreign` (`tipo_id`);

--
-- Indexes for table `posesions`
--
ALTER TABLE `posesions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posesions_nombre_unique` (`nombre`);

--
-- Indexes for table `productors`
--
ALTER TABLE `productors`
  ADD KEY `productors_id_foreign` (`id`),
  ADD KEY `productors_sexo_id_foreign` (`sexo_id`),
  ADD KEY `productors_departamento_id_foreign` (`departamento_id`),
  ADD KEY `productors_municipio_id_foreign` (`municipio_id`);

--
-- Indexes for table `productosfertilizantes`
--
ALTER TABLE `productosfertilizantes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `productosfertilizantes_nombre_unique` (`nombre`);

--
-- Indexes for table `quimicos`
--
ALTER TABLE `quimicos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `quimicos_nombre_unique` (`nombre`);

--
-- Indexes for table `resguardos`
--
ALTER TABLE `resguardos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `resguardos_nombre_unique` (`nombre`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_nombre_unique` (`nombre`);

--
-- Indexes for table `sexos`
--
ALTER TABLE `sexos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sexos_nombre_unique` (`nombre`);

--
-- Indexes for table `tipoids`
--
ALTER TABLE `tipoids`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tipoids_nombre_unique` (`nombre`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `users_usuario_unique` (`usuario`),
  ADD KEY `users_id_foreign` (`id`),
  ADD KEY `users_idrol_foreign` (`idrol`);

--
-- Indexes for table `veredas`
--
ALTER TABLE `veredas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `veredas_nombre_unique` (`nombre`),
  ADD KEY `veredas_municipio_id_foreign` (`municipio_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aplquimicos`
--
ALTER TABLE `aplquimicos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cadenas`
--
ALTER TABLE `cadenas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `etnias`
--
ALTER TABLE `etnias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fertilizantes`
--
ALTER TABLE `fertilizantes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fincas`
--
ALTER TABLE `fincas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gpxs`
--
ALTER TABLE `gpxs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gpxzones`
--
ALTER TABLE `gpxzones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gradoescolaridads`
--
ALTER TABLE `gradoescolaridads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `lineas`
--
ALTER TABLE `lineas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lugarventas`
--
ALTER TABLE `lugarventas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posesions`
--
ALTER TABLE `posesions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `productosfertilizantes`
--
ALTER TABLE `productosfertilizantes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quimicos`
--
ALTER TABLE `quimicos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `resguardos`
--
ALTER TABLE `resguardos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sexos`
--
ALTER TABLE `sexos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tipoids`
--
ALTER TABLE `tipoids`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `veredas`
--
ALTER TABLE `veredas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aplquimicos`
--
ALTER TABLE `aplquimicos`
  ADD CONSTRAINT `aplquimicos_finca_id_foreign` FOREIGN KEY (`finca_id`) REFERENCES `fincas` (`id`),
  ADD CONSTRAINT `aplquimicos_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`),
  ADD CONSTRAINT `aplquimicos_quimico_id_foreign` FOREIGN KEY (`quimico_id`) REFERENCES `quimicos` (`id`);

--
-- Constraints for table `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `articulos_idcategoria_foreign` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`id`);

--
-- Constraints for table `fertilizantes`
--
ALTER TABLE `fertilizantes`
  ADD CONSTRAINT `fertilizantes_finca_id_foreign` FOREIGN KEY (`finca_id`) REFERENCES `fincas` (`id`),
  ADD CONSTRAINT `fertilizantes_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`);

--
-- Constraints for table `fincas`
--
ALTER TABLE `fincas`
  ADD CONSTRAINT `fincas_departamento_id_foreign` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`),
  ADD CONSTRAINT `fincas_municipio_id_foreign` FOREIGN KEY (`municipio_id`) REFERENCES `municipios` (`id`),
  ADD CONSTRAINT `fincas_posesion_id_foreign` FOREIGN KEY (`posesion_id`) REFERENCES `posesions` (`id`),
  ADD CONSTRAINT `fincas_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`);

--
-- Constraints for table `gpxs`
--
ALTER TABLE `gpxs`
  ADD CONSTRAINT `gpxs_finca_id_foreign` FOREIGN KEY (`finca_id`) REFERENCES `fincas` (`id`),
  ADD CONSTRAINT `gpxs_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`);

--
-- Constraints for table `gpxzones`
--
ALTER TABLE `gpxzones`
  ADD CONSTRAINT `gpxzones_finca_id_foreign` FOREIGN KEY (`finca_id`) REFERENCES `fincas` (`id`),
  ADD CONSTRAINT `gpxzones_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`);

--
-- Constraints for table `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `municipios_departamento_id_foreign` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`);

--
-- Constraints for table `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `personas_tipo_id_foreign` FOREIGN KEY (`tipo_id`) REFERENCES `tipoids` (`id`);

--
-- Constraints for table `productors`
--
ALTER TABLE `productors`
  ADD CONSTRAINT `productors_departamento_id_foreign` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`),
  ADD CONSTRAINT `productors_id_foreign` FOREIGN KEY (`id`) REFERENCES `personas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `productors_municipio_id_foreign` FOREIGN KEY (`municipio_id`) REFERENCES `municipios` (`id`),
  ADD CONSTRAINT `productors_sexo_id_foreign` FOREIGN KEY (`sexo_id`) REFERENCES `sexos` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_foreign` FOREIGN KEY (`id`) REFERENCES `personas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_idrol_foreign` FOREIGN KEY (`idrol`) REFERENCES `roles` (`id`);

--
-- Constraints for table `veredas`
--
ALTER TABLE `veredas`
  ADD CONSTRAINT `veredas_municipio_id_foreign` FOREIGN KEY (`municipio_id`) REFERENCES `municipios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
