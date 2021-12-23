-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2021 at 05:08 PM
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
-- Database: `asofrutj`
--

-- --------------------------------------------------------

--
-- Table structure for table `adecuacionrenovacions`
--

CREATE TABLE `adecuacionrenovacions` (
  `id` int(10) UNSIGNED NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `finca_id` int(10) UNSIGNED NOT NULL,
  `fechaRegistro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adecuacionrenovacions`
--

INSERT INTO `adecuacionrenovacions` (`id`, `productor_id`, `finca_id`, `fechaRegistro`, `created_at`, `updated_at`) VALUES
(1, 5, 1, '2021-11-29', '2021-11-29 19:52:53', '2021-11-29 19:52:53');

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

--
-- Dumping data for table `cadenas`
--

INSERT INTO `cadenas` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Mora', NULL, NULL),
(2, 'Gulupa', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categoriamoras`
--

CREATE TABLE `categoriamoras` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valorUnitario` decimal(11,0) NOT NULL,
  `ValorDonacion` decimal(11,0) NOT NULL,
  `valorTransporte` decimal(11,0) NOT NULL,
  `valorAsohof` decimal(11,2) NOT NULL,
  `valorCuatroPorMil` decimal(11,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categoriamoras`
--

INSERT INTO `categoriamoras` (`id`, `nombre`, `valorUnitario`, `ValorDonacion`, `valorTransporte`, `valorAsohof`, `valorCuatroPorMil`, `created_at`, `updated_at`) VALUES
(1, 'Mora de primera', '2300', '120', '88', '0.01', '0.0040', '2020-12-07 22:28:36', '2020-12-12 02:33:11'),
(2, 'Mora de segunda', '2000', '120', '88', '0.01', '0.0040', '2020-12-07 22:29:26', '2020-12-12 02:33:54');

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
-- Table structure for table `comercializacionproductos`
--

CREATE TABLE `comercializacionproductos` (
  `id` int(10) UNSIGNED NOT NULL,
  `comercializacion_id` int(10) UNSIGNED NOT NULL,
  `productosComers_id` int(10) UNSIGNED NOT NULL,
  `cantidad` decimal(11,2) NOT NULL,
  `valorUnitario` decimal(11,2) NOT NULL,
  `otro` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comercializacionproductos`
--

INSERT INTO `comercializacionproductos` (`id`, `comercializacion_id`, `productosComers_id`, `cantidad`, `valorUnitario`, `otro`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '5.00', '14000.00', '', '2021-12-21 03:58:03', '2021-12-21 03:58:03'),
(2, 3, 2, '3.00', '2432.00', '', '2021-12-21 03:58:03', '2021-12-21 03:58:03'),
(3, 4, 2, '4.00', '2432.00', '', '2021-12-21 04:07:51', '2021-12-21 04:07:51'),
(4, 4, 1, '2.00', '14000.00', '', '2021-12-21 04:07:51', '2021-12-21 04:07:51'),
(5, 5, 2, '2.00', '2432.00', '', '2021-12-21 05:13:23', '2021-12-21 05:13:23'),
(6, 5, 1, '4.00', '14000.00', '', '2021-12-21 05:13:23', '2021-12-21 05:13:23'),
(7, 6, 2, '5.00', '2432.00', '', '2021-12-21 05:16:14', '2021-12-21 05:16:14'),
(8, 6, 1, '6.00', '14000.00', '', '2021-12-21 05:16:14', '2021-12-21 05:16:14');

-- --------------------------------------------------------

--
-- Table structure for table `comercializacions`
--

CREATE TABLE `comercializacions` (
  `id` int(10) UNSIGNED NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `otro` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechaVenta` date NOT NULL,
  `totalVenta` decimal(11,2) NOT NULL,
  `totalUnidades` decimal(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comercializacions`
--

INSERT INTO `comercializacions` (`id`, `productor_id`, `otro`, `fechaVenta`, `totalVenta`, `totalUnidades`, `created_at`, `updated_at`) VALUES
(3, 22, 'da', '2021-12-20', '77296.00', '8.00', '2021-12-21 03:58:03', '2021-12-21 03:58:03'),
(4, 13, NULL, '2021-12-20', '37728.00', '6.00', '2021-12-21 04:07:51', '2021-12-21 04:07:51'),
(5, 22, NULL, '2021-12-21', '60864.00', '6.00', '2021-12-21 05:13:23', '2021-12-21 05:13:23'),
(6, 22, NULL, '2021-12-21', '96160.00', '11.00', '2021-12-21 05:16:14', '2021-12-21 05:16:14');

-- --------------------------------------------------------

--
-- Table structure for table `conceptogastos`
--

CREATE TABLE `conceptogastos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conceptogastos`
--

INSERT INTO `conceptogastos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Compra / Alquiler terrenos', '2021-11-29 18:20:17', '2021-11-29 18:20:17'),
(2, 'Infraestructuras', '2021-11-29 18:20:17', '2021-11-29 18:20:17'),
(3, 'Materiales', '2021-11-29 18:20:17', '2021-11-29 18:20:17'),
(4, 'Herramientas / Equipos', '2021-11-29 18:20:17', '2021-11-29 18:20:17'),
(5, 'Suministros', '2021-11-29 18:20:17', '2021-11-29 18:20:17'),
(6, 'Insumos', '2021-11-29 18:20:17', '2021-11-29 18:20:17'),
(7, 'Mano de obra externa', '2021-11-29 18:20:17', '2021-11-29 18:20:17'),
(8, 'Material vegetal', '2021-11-29 18:20:17', '2021-11-29 18:20:17'),
(9, 'Transporte', '2021-11-29 18:20:17', '2021-11-29 18:20:17');

-- --------------------------------------------------------

--
-- Table structure for table `cosechas`
--

CREATE TABLE `cosechas` (
  `id` int(10) UNSIGNED NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `finca_id` int(10) UNSIGNED NOT NULL,
  `frecuencia` int(11) DEFAULT NULL,
  `clasificacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `empaque` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transporte` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kilogramoMoraPrimera` int(11) DEFAULT NULL,
  `kilogramoMoraSegunda` int(11) DEFAULT NULL,
  `mesesProduccion` int(11) DEFAULT NULL,
  `clientes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiempoPago` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoPago` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cosechas`
--

INSERT INTO `cosechas` (`id`, `productor_id`, `finca_id`, `frecuencia`, `clasificacion`, `empaque`, `transporte`, `kilogramoMoraPrimera`, `kilogramoMoraSegunda`, `mesesProduccion`, `clientes`, `tiempoPago`, `tipoPago`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 11, 'Si', 'Canastilla', 'moto', 11, 11, 2, 'Plaza de mercado', 'Contraentrega', 'Efectivo', '2020-12-21 20:04:25', '2020-12-21 20:04:25');

-- --------------------------------------------------------

--
-- Table structure for table `cultivos`
--

CREATE TABLE `cultivos` (
  `id` int(10) UNSIGNED NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `finca_id` int(10) UNSIGNED NOT NULL,
  `cadena_id` int(10) UNSIGNED NOT NULL,
  `areaSembrada` decimal(11,2) NOT NULL,
  `fechaSiembra` date NOT NULL,
  `numeroPlantulasArboles` int(11) NOT NULL,
  `totalVentasKgAnioAnterior` decimal(11,2) NOT NULL,
  `precioPromedio` decimal(11,2) NOT NULL,
  `TotalVentasAnioAnterior` decimal(11,2) NOT NULL,
  `lugarVenta_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cultivos`
--

INSERT INTO `cultivos` (`id`, `productor_id`, `finca_id`, `cadena_id`, `areaSembrada`, `fechaSiembra`, `numeroPlantulasArboles`, `totalVentasKgAnioAnterior`, `precioPromedio`, `TotalVentasAnioAnterior`, `lugarVenta_id`, `created_at`, `updated_at`) VALUES
(1, 5, 3, 1, '500.00', '2020-10-10', 500, '200.00', '200.00', '40000.00', 2, '2020-12-07 22:27:17', '2020-12-22 16:10:28');

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
(1, 'CAUCA', '2020-12-07 22:04:32', '2020-12-07 22:04:32'),
(2, 'AMAZONAS', '2020-12-07 22:04:32', '2020-12-07 22:04:32'),
(3, 'ANTIOQUIA', '2020-12-07 22:04:32', '2020-12-07 22:04:32'),
(4, 'ARAUCA', '2020-12-07 22:04:32', '2020-12-07 22:04:32'),
(5, 'ATLANTICO', '2020-12-07 22:04:32', '2020-12-07 22:04:32'),
(6, 'BOLIVAR', '2020-12-07 22:04:32', '2020-12-07 22:04:32'),
(7, 'BOYACA', '2020-12-07 22:04:32', '2020-12-07 22:04:32'),
(8, 'CALDAS', '2020-12-07 22:04:32', '2020-12-07 22:04:32'),
(9, 'CAQUETA', '2020-12-07 22:04:32', '2020-12-07 22:04:32'),
(10, 'CASANARE', '2020-12-07 22:04:32', '2020-12-07 22:04:32'),
(11, 'CESAR', '2020-12-07 22:04:32', '2020-12-07 22:04:32'),
(12, 'CHOCO', '2020-12-07 22:04:33', '2020-12-07 22:04:33'),
(13, 'CORDOBA', '2020-12-07 22:04:33', '2020-12-07 22:04:33'),
(14, 'CUNDINAMARCA', '2020-12-07 22:04:33', '2020-12-07 22:04:33'),
(15, 'GUAINIA', '2020-12-07 22:04:33', '2020-12-07 22:04:33'),
(16, 'GUAJIRA', '2020-12-07 22:04:33', '2020-12-07 22:04:33'),
(17, 'GUAVIARE', '2020-12-07 22:04:33', '2020-12-07 22:04:33'),
(18, 'HUILA', '2020-12-07 22:04:33', '2020-12-07 22:04:33'),
(19, 'MAGDALENA', '2020-12-07 22:04:33', '2020-12-07 22:04:33'),
(20, 'META', '2020-12-07 22:04:33', '2020-12-07 22:04:33'),
(21, 'N SANTANDER', '2020-12-07 22:04:33', '2020-12-07 22:04:33'),
(22, 'NARINO', '2020-12-07 22:04:33', '2020-12-07 22:04:33'),
(23, 'PUTUMAYO', '2020-12-07 22:04:33', '2020-12-07 22:04:33'),
(24, 'QUINDIO', '2020-12-07 22:04:33', '2020-12-07 22:04:33'),
(25, 'RISARALDA', '2020-12-07 22:04:33', '2020-12-07 22:04:33'),
(26, 'SAN ANDRES', '2020-12-07 22:04:33', '2020-12-07 22:04:33'),
(27, 'SANTANDER', '2020-12-07 22:04:33', '2020-12-07 22:04:33'),
(28, 'SUCRE', '2020-12-07 22:04:34', '2020-12-07 22:04:34'),
(29, 'TOLIMA', '2020-12-07 22:04:34', '2020-12-07 22:04:34'),
(30, 'VALLE DEL CAUCA', '2020-12-07 22:04:34', '2020-12-07 22:04:34'),
(31, 'VAUPES', '2020-12-07 22:04:34', '2020-12-07 22:04:34'),
(32, 'VICHADA', '2020-12-07 22:04:34', '2020-12-07 22:04:34');

-- --------------------------------------------------------

--
-- Table structure for table `encuestaasofruts`
--

CREATE TABLE `encuestaasofruts` (
  `id` int(10) UNSIGNED NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `finca_id` int(10) UNSIGNED NOT NULL,
  `certificacion1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificacion2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ecosistemas1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ecosistemas2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ecosistemas3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ecosistemas4` int(11) DEFAULT NULL,
  `ecosistemas5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ecosistemas6` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ecosistemas7` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ecosistemas8` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `silvestre1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `silvestre2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `silvestre3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `silvestre4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `silvestre5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `silvestre6` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `silvestre7` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `silvestre8` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `silvestre9` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `silvestre10` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `silvestre11` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `silvestre12` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `silvestre13` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `silvestre14` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `silvestre15` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `silvestre16` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `silvestre17` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `silvestre18` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `silvestre19` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `silvestre20` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conservacion1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conservacion2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conservacion3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conservacion4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conservacion5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conservacion6` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desechos1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desechos2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desechos3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desechos4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cultivo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `encuestaasofruts`
--

INSERT INTO `encuestaasofruts` (`id`, `productor_id`, `finca_id`, `certificacion1`, `certificacion2`, `ecosistemas1`, `ecosistemas2`, `ecosistemas3`, `ecosistemas4`, `ecosistemas5`, `ecosistemas6`, `ecosistemas7`, `ecosistemas8`, `silvestre1`, `silvestre2`, `silvestre3`, `silvestre4`, `silvestre5`, `silvestre6`, `silvestre7`, `silvestre8`, `silvestre9`, `silvestre10`, `silvestre11`, `silvestre12`, `silvestre13`, `silvestre14`, `silvestre15`, `silvestre16`, `silvestre17`, `silvestre18`, `silvestre19`, `silvestre20`, `conservacion1`, `conservacion2`, `conservacion3`, `conservacion4`, `conservacion5`, `conservacion6`, `desechos1`, `desechos2`, `desechos3`, `desechos4`, `cultivo`, `created_at`, `updated_at`) VALUES
(2, 5, 1, 'Si', 'Si', 'Si', 'Si', 'Si', 5, 'Si', 'Si', 'No', 'Si', 'Si', 'Si', 'Si', 'No', 'Roceria', 'No', 'Biologicos', 'Si', 'No', 'Regular', 'Acueducto Familiar', 'casa', 'Si', 'casa', 'Si', 'Si', 'perro', 'No', '0', '0', 'Si', 'no', 'Si', 'Si', 'Si', 'Si', 'Abono', 'Entierra', 'Vende', 'Si', 'Quema', '2020-12-21 05:06:40', '2020-12-21 05:06:40'),
(3, 5, 3, 'Si', 'Si', 'Si', 'Si', 'No', 5, 'Si', 'Si', 'No', 'No', 'Si', 'Si', 'Si', 'No', 'Guadana', 'No', 'Biologicos', 'Si', 'No', 'Bueno', 'Acueducto Veredal', 'casa', 'Si', 'prueba', 'Si', 'Si', 'gato', 'Si', '0', '0', 'No', 'ninguna', 'No', 'Si', 'Si', 'Si', 'Abono', 'Vende', 'Acopio', 'Si', NULL, '2021-03-04 03:47:16', '2021-03-04 03:47:16');

-- --------------------------------------------------------

--
-- Table structure for table `encuesta_fitosanitarias`
--

CREATE TABLE `encuesta_fitosanitarias` (
  `id` int(10) UNSIGNED NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `finca_id` int(10) UNSIGNED NOT NULL,
  `fechaControl` date NOT NULL,
  `productoSembrado` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lote` int(11) DEFAULT NULL,
  `linea_id` int(10) UNSIGNED NOT NULL,
  `numeroPlantas` int(11) DEFAULT NULL,
  `producto_fitosanitario_id` int(10) UNSIGNED NOT NULL,
  `cantidad_dosis` decimal(11,2) DEFAULT NULL,
  `unidad_dosis_id` int(10) UNSIGNED DEFAULT NULL,
  `cantidad_aplicacion` decimal(11,2) DEFAULT NULL,
  `unidad_aplicaciones_id` int(10) UNSIGNED DEFAULT NULL,
  `equipo_aplicaciones_id` int(10) UNSIGNED DEFAULT NULL,
  `metodo_aplicaciones_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `encuesta_fitosanitarias`
--

INSERT INTO `encuesta_fitosanitarias` (`id`, `productor_id`, `finca_id`, `fechaControl`, `productoSembrado`, `lote`, `linea_id`, `numeroPlantas`, `producto_fitosanitario_id`, `cantidad_dosis`, `unidad_dosis_id`, `cantidad_aplicacion`, `unidad_aplicaciones_id`, `equipo_aplicaciones_id`, `metodo_aplicaciones_id`, `created_at`, `updated_at`) VALUES
(1, 5, 1, '2020-12-02', 'lluca', 1, 1, 6, 131, '15.00', 1, '15.00', 1, 2, 2, NULL, NULL),
(2, 5, 1, '2020-12-02', 'platano', 2, 1, 100, 75, '500.00', 1, '15.00', 1, 1, 1, '2020-12-20 20:37:12', '2020-12-20 20:37:12');

-- --------------------------------------------------------

--
-- Table structure for table `enfermedads`
--

CREATE TABLE `enfermedads` (
  `id` int(10) UNSIGNED NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `finca_id` int(10) UNSIGNED NOT NULL,
  `monitoreo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frecuenciaMonitoreo` int(11) DEFAULT NULL,
  `antracnosis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoManejoAntra` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frecuenciaAntra` int(11) DEFAULT NULL,
  `botritys` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoManejoBotritys` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frecuenciaBotritys` int(11) DEFAULT NULL,
  `mildeo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoManejoMildeo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frecuenciaMildeo` int(11) DEFAULT NULL,
  `mildeoVelloso` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoManejoMildeoVelloso` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frecuenciaMildeoVelloso` int(11) DEFAULT NULL,
  `adherentes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombreAdherente` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dosisAplicacion` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enfermedads`
--

INSERT INTO `enfermedads` (`id`, `productor_id`, `finca_id`, `monitoreo`, `frecuenciaMonitoreo`, `antracnosis`, `tipoManejoAntra`, `frecuenciaAntra`, `botritys`, `tipoManejoBotritys`, `frecuenciaBotritys`, `mildeo`, `tipoManejoMildeo`, `frecuenciaMildeo`, `mildeoVelloso`, `tipoManejoMildeoVelloso`, `frecuenciaMildeoVelloso`, `adherentes`, `nombreAdherente`, `dosisAplicacion`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'Si', 5, 'Si', 'Trampas', 2, 'Si', 'Biopreparados', 5, 'No', 'Biologicos', 2, 'Si', 'Agroquimicos', 1, 'Si', 'quimico', 50, '2021-03-04 20:17:51', '2021-03-04 20:17:51');

-- --------------------------------------------------------

--
-- Table structure for table `equipo_aplicaciones`
--

CREATE TABLE `equipo_aplicaciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `equipo_aplicaciones`
--

INSERT INTO `equipo_aplicaciones` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Estacionaria', '2020-12-16 19:36:23', '2020-12-16 19:36:23'),
(2, 'Bomba de espalda', '2020-12-16 19:36:23', '2020-12-16 19:36:23'),
(3, 'Manual', '2020-12-16 19:36:23', '2020-12-16 19:36:23'),
(4, 'Drench', '2020-12-16 19:36:23', '2020-12-16 19:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `establecimientoconceptos`
--

CREATE TABLE `establecimientoconceptos` (
  `id` int(10) UNSIGNED NOT NULL,
  `gastosEstablecimiento_id` int(10) UNSIGNED NOT NULL,
  `conceptoGasto_id` int(10) UNSIGNED NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otro` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valorTotal` decimal(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `establecimientoconceptos`
--

INSERT INTO `establecimientoconceptos` (`id`, `gastosEstablecimiento_id`, `conceptoGasto_id`, `descripcion`, `otro`, `valorTotal`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'compra terreno', '100 metros cuadrados', '321321.00', '2021-11-29 18:21:09', '2021-11-29 18:21:09'),
(2, 1, 1, 'sda', 'asd', '131241.00', '2021-11-29 18:21:09', '2021-11-29 18:21:09');

-- --------------------------------------------------------

--
-- Table structure for table `estadoventas`
--

CREATE TABLE `estadoventas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `estadoventas`
--

INSERT INTO `estadoventas` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'ACOPIO', '2020-12-07 22:04:38', '2020-12-07 22:04:38'),
(2, 'TRAMITE FACTURACION', '2020-12-07 22:04:38', '2020-12-07 22:04:38'),
(3, 'DISPONIBLE PARA PAGO', '2020-12-07 22:04:38', '2020-12-07 22:04:38'),
(4, 'PAGADO', '2020-12-07 22:04:38', '2020-12-07 22:04:38'),
(5, 'ANULADO', NULL, NULL);

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
(1, 'Indigena', '2020-12-07 22:04:31', '2020-12-07 22:04:31');

-- --------------------------------------------------------

--
-- Table structure for table `fincas`
--

CREATE TABLE `fincas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `linea_id` int(10) UNSIGNED NOT NULL,
  `areaPredio` decimal(11,2) NOT NULL,
  `longitudPredio` decimal(11,6) NOT NULL,
  `latitudPredio` decimal(11,6) NOT NULL,
  `altitudPredio` decimal(11,2) NOT NULL,
  `departamento_id` int(10) UNSIGNED NOT NULL,
  `municipio_id` int(10) UNSIGNED NOT NULL,
  `vereda_id` int(10) UNSIGNED NOT NULL,
  `resguardo_id` int(10) UNSIGNED NOT NULL,
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

INSERT INTO `fincas` (`id`, `nombre`, `productor_id`, `linea_id`, `areaPredio`, `longitudPredio`, `latitudPredio`, `altitudPredio`, `departamento_id`, `municipio_id`, `vereda_id`, `resguardo_id`, `posesion_id`, `distanciaAlLote`, `distanciaLoteVia`, `coordenadasFinca`, `created_at`, `updated_at`) VALUES
(1, 'Finca Julian Silva', 5, 1, '500.00', '-76.890000', '3.141600', '500.00', 1, 1, 6, 2, 2, '500.00', '500.00', 'coord', '2020-12-07 22:22:34', '2020-12-10 09:01:14'),
(2, 'El rancho', 13, 1, '3000.00', '-76.150000', '3.140000', '3000.00', 1, 1, 1, 1, 1, '100.00', '300.00', 'gg', '2020-12-22 13:38:55', '2020-12-22 13:38:55'),
(3, 'El ROBLE', 5, 1, '300.00', '-76.310000', '3.141600', '2980.00', 1, 1, 1, 1, 1, '100.00', '500.00', 'gg', '2020-12-22 16:10:02', '2020-12-22 16:10:02'),
(4, 'El ramo', 13, 1, '312.00', '-76.340000', '3.141600', '1234.00', 1, 1, 1, 1, 3, '20.00', '11.00', 'Rio rojo', '2021-08-06 15:40:26', '2021-08-06 15:40:26');

-- --------------------------------------------------------

--
-- Table structure for table `gastosestablecimientos`
--

CREATE TABLE `gastosestablecimientos` (
  `id` int(10) UNSIGNED NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `finca_id` int(10) UNSIGNED NOT NULL,
  `fechaRegistro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gastosestablecimientos`
--

INSERT INTO `gastosestablecimientos` (`id`, `productor_id`, `finca_id`, `fechaRegistro`, `created_at`, `updated_at`) VALUES
(1, 5, 1, '2021-11-29', '2021-11-29 18:21:09', '2021-11-29 18:21:09');

-- --------------------------------------------------------

--
-- Table structure for table `gastosproduccions`
--

CREATE TABLE `gastosproduccions` (
  `id` int(10) UNSIGNED NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `finca_id` int(10) UNSIGNED NOT NULL,
  `fechaRegistro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gastosproduccions`
--

INSERT INTO `gastosproduccions` (`id`, `productor_id`, `finca_id`, `fechaRegistro`, `created_at`, `updated_at`) VALUES
(1, 13, 4, '2021-11-29', '2021-11-29 20:07:05', '2021-11-29 20:07:05'),
(2, 13, 2, '2021-11-29', '2021-11-29 20:07:40', '2021-11-29 20:07:40');

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

--
-- Dumping data for table `gpxs`
--

INSERT INTO `gpxs` (`id`, `productor_id`, `finca_id`, `latitud`, `longitud`, `created_at`, `updated_at`) VALUES
(1, 5, 1, '3.4295550000000000000', '-76.5242060000000000000', '2020-12-30 04:56:06', '2020-12-30 04:56:06'),
(2, 5, 1, '3.4495550000000000000', '-76.5242060000000000000', '2020-12-30 04:56:10', '2020-12-30 04:56:10'),
(3, 5, 3, '3.4298150000000000000', '-76.5248020000000000000', '2021-01-18 15:26:37', '2021-01-18 15:26:37'),
(4, 5, 3, '3.4295550000000000000', '-76.5242060000000000000', '2021-01-18 20:10:29', '2021-01-18 20:10:29'),
(5, 5, 3, '3.4295550000000000000', '-76.5242060000000000000', '2021-01-18 20:18:03', '2021-01-18 20:18:03'),
(6, 5, 1, '3.4295550000000000000', '-76.5242060000000000000', '2021-08-05 15:34:07', '2021-08-05 15:34:07'),
(7, 13, 2, '2.9548295140000000000', '-76.2694989220000000000', '2021-08-05 16:02:34', '2021-08-05 16:02:34');

-- --------------------------------------------------------

--
-- Table structure for table `gpxzones`
--

CREATE TABLE `gpxzones` (
  `id` int(10) UNSIGNED NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `finca_id` int(10) UNSIGNED NOT NULL,
  `linea` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gpxzones`
--

INSERT INTO `gpxzones` (`id`, `productor_id`, `finca_id`, `linea`, `created_at`, `updated_at`) VALUES
(19, 5, 3, '[{\"lat\":3.4298101533,\"lng\":-76.5247765370},{\"lat\":3.4298083931,\"lng\":-76.5247526485},{\"lat\":3.4298121650,\"lng\":-76.5247606952},{\"lat\":3.4298414178,\"lng\":-76.5247724298},{\"lat\":3.4298303537,\"lng\":-76.5247838292},{\"lat\":3.4298209660,\"lng\":-76.5247870144},{\"lat\":3.4298269171,\"lng\":-76.5248000901},{\"lat\":3.4298302699,\"lng\":-76.5247928817},{\"lat\":3.4298314434,\"lng\":-76.5247871820},{\"lat\":3.4298342094,\"lng\":-76.5247859247},{\"lat\":3.4298089799,\"lng\":-76.5247687418},{\"lat\":3.4297234844,\"lng\":-76.5246218909},{\"lat\":3.4297673218,\"lng\":-76.5246140119},{\"lat\":3.4297404997,\"lng\":-76.5245608706}]', '2021-08-11 02:25:12', '2021-08-11 02:25:12'),
(20, 5, 1, '[{\"lat\":3.4298420046,\"lng\":-76.5247974079},{\"lat\":3.4298464470,\"lng\":-76.5248016827},{\"lat\":3.4298852552,\"lng\":-76.5247644670},{\"lat\":3.4298787173,\"lng\":-76.5248207934},{\"lat\":3.4298837464,\"lng\":-76.5248159319},{\"lat\":3.4298408311,\"lng\":-76.5247883555},{\"lat\":3.4298051242,\"lng\":-76.5248104837},{\"lat\":3.4298125841,\"lng\":-76.5248062089},{\"lat\":3.4297845885,\"lng\":-76.5247650538},{\"lat\":3.4298335388,\"lng\":-76.5248547401},{\"lat\":3.4298384003,\"lng\":-76.5248265769},{\"lat\":3.4297809843,\"lng\":-76.5247973241},{\"lat\":3.4297965746,\"lng\":-76.5247927979},{\"lat\":3.4298150986,\"lng\":-76.5247991681},{\"lat\":3.4297975805,\"lng\":-76.5248106513},{\"lat\":3.4297890309,\"lng\":-76.5248336177},{\"lat\":3.4298194572,\"lng\":-76.5248156805},{\"lat\":3.4298300184,\"lng\":-76.5247917082},{\"lat\":3.4298408311,\"lng\":-76.5248176083},{\"lat\":3.4298401605,\"lng\":-76.5248133335},{\"lat\":3.4297155216,\"lng\":-76.5247262456},{\"lat\":3.4297397453,\"lng\":-76.5247308556},{\"lat\":3.4298057947,\"lng\":-76.5248035267},{\"lat\":3.4298008494,\"lng\":-76.5248043649},{\"lat\":3.4298104048,\"lng\":-76.5248559974},{\"lat\":3.4298383165,\"lng\":-76.5248155128},{\"lat\":3.4298277553,\"lng\":-76.5247891936}]', '2021-08-11 03:42:13', '2021-08-11 03:42:13');

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
(1, 'Primaria Incompleta', '2020-12-07 22:04:31', '2020-12-07 22:04:31'),
(2, 'Primaria', '2020-12-07 22:04:31', '2020-12-07 22:04:31'),
(3, 'Bachiller Incompleto', '2020-12-07 22:04:31', '2020-12-07 22:04:31'),
(4, 'Bachiller', '2020-12-07 22:04:32', '2020-12-07 22:04:32'),
(5, 'Tecnico Incompleto', '2020-12-07 22:04:32', '2020-12-07 22:04:32'),
(6, 'Tecnico', '2020-12-07 22:04:32', '2020-12-07 22:04:32'),
(7, 'Tecnologo Incompleto', '2020-12-07 22:04:32', '2020-12-07 22:04:32'),
(8, 'Tecnologo', '2020-12-07 22:04:32', '2020-12-07 22:04:32'),
(9, 'Universitario Incompleto', '2020-12-07 22:04:32', '2020-12-07 22:04:32'),
(10, 'Universitario', '2020-12-07 22:04:32', '2020-12-07 22:04:32');

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

--
-- Dumping data for table `lineas`
--

INSERT INTO `lineas` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Mora', NULL, NULL);

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

--
-- Dumping data for table `lugarventas`
--

INSERT INTO `lugarventas` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Exportacion y nacional', NULL, NULL),
(2, 'Fxize', NULL, NULL),
(3, 'Listo y fresco', NULL, NULL),
(4, 'Pulpi fres', NULL, '2020-12-15 07:21:03'),
(5, 'Sky', NULL, NULL),
(6, 'Plaza o intermediarios', NULL, NULL),
(7, 'LA 14', '2020-12-15 07:23:10', '2020-12-15 07:23:10');

-- --------------------------------------------------------

--
-- Table structure for table `metodo_aplicaciones`
--

CREATE TABLE `metodo_aplicaciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `metodo_aplicaciones`
--

INSERT INTO `metodo_aplicaciones` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Aspercion foliar', '2020-12-16 19:36:23', '2020-12-16 19:36:23'),
(2, 'Drench', '2020-12-16 19:36:23', '2020-12-16 19:36:23');

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
(4, '2020_11_27_132839_create_asofrut_core', 1),
(5, '2020_12_02_034407_create_roles_table', 1),
(6, '2020_12_03_000000_create_users_table', 1),
(8, '2020_12_15_153538_create_encuesta_fitosanitaria', 2),
(9, '2020_12_19_184847_create_encuesta_asofrut', 3),
(10, '2020_12_21_031155_create_caracterizacion', 4),
(12, '2020_12_29_180038_create_gpx_upload', 5),
(13, '2021_02_10_091513_create_enfermedades', 6),
(15, '2021_03_04_110723_update_enfermedades', 7),
(16, '2021_08_09_222410_create_gpx_zone', 8),
(18, '2021_11_10_083751_create_gastos', 9),
(19, '2021_11_29_112011_create_gastos_otras', 10),
(20, '2021_12_18_123838_create_comercializacion', 11);

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
(1, 'TORIBIO', 1, '2020-12-07 22:04:34', '2020-12-07 22:04:34'),
(2, 'ALMAGUER', 1, '2020-12-07 22:04:34', '2020-12-07 22:04:34'),
(3, 'ARGELIA', 1, '2020-12-07 22:04:34', '2020-12-07 22:04:34'),
(4, 'BALBOA', 1, '2020-12-07 22:04:34', '2020-12-07 22:04:34'),
(5, 'BOLIVAR', 1, '2020-12-07 22:04:35', '2020-12-07 22:04:35'),
(6, 'BUENOS AIRES', 1, '2020-12-07 22:04:35', '2020-12-07 22:04:35'),
(7, 'CAJIBIO', 1, '2020-12-07 22:04:35', '2020-12-07 22:04:35'),
(8, 'CALDONO', 1, '2020-12-07 22:04:35', '2020-12-07 22:04:35'),
(9, 'CALOTO', 1, '2020-12-07 22:04:35', '2020-12-07 22:04:35'),
(10, 'CORINTO', 1, '2020-12-07 22:04:35', '2020-12-07 22:04:35'),
(11, 'EL TAMBO', 1, '2020-12-07 22:04:35', '2020-12-07 22:04:35'),
(12, 'FLORENCIA', 1, '2020-12-07 22:04:35', '2020-12-07 22:04:35'),
(13, 'GUAPI', 1, '2020-12-07 22:04:35', '2020-12-07 22:04:35'),
(14, 'INZA', 1, '2020-12-07 22:04:35', '2020-12-07 22:04:35'),
(15, 'JAMBALO', 1, '2020-12-07 22:04:35', '2020-12-07 22:04:35'),
(16, 'LA SIERRA', 1, '2020-12-07 22:04:35', '2020-12-07 22:04:35'),
(17, 'LA VEGA', 1, '2020-12-07 22:04:35', '2020-12-07 22:04:35'),
(18, 'LOPEZ', 1, '2020-12-07 22:04:35', '2020-12-07 22:04:35'),
(19, 'MERCADERES', 1, '2020-12-07 22:04:35', '2020-12-07 22:04:35'),
(20, 'MIRANDA', 1, '2020-12-07 22:04:35', '2020-12-07 22:04:35'),
(21, 'MORALES', 1, '2020-12-07 22:04:35', '2020-12-07 22:04:35'),
(22, 'PADILLA', 1, '2020-12-07 22:04:35', '2020-12-07 22:04:35'),
(23, 'PAEZ', 1, '2020-12-07 22:04:35', '2020-12-07 22:04:35'),
(24, 'PATIA', 1, '2020-12-07 22:04:35', '2020-12-07 22:04:35'),
(25, 'PIAMONTE', 1, '2020-12-07 22:04:35', '2020-12-07 22:04:35'),
(26, 'PIENDAMO', 1, '2020-12-07 22:04:36', '2020-12-07 22:04:36'),
(27, 'POPAYAN', 1, '2020-12-07 22:04:36', '2020-12-07 22:04:36'),
(28, 'PUERTO TEJADA', 1, '2020-12-07 22:04:36', '2020-12-07 22:04:36'),
(29, 'PURACE', 1, '2020-12-07 22:04:36', '2020-12-07 22:04:36'),
(30, 'ROSAS', 1, '2020-12-07 22:04:36', '2020-12-07 22:04:36'),
(31, 'SAN SEBASTIAN', 1, '2020-12-07 22:04:36', '2020-12-07 22:04:36'),
(32, 'SANTA ROSA', 1, '2020-12-07 22:04:36', '2020-12-07 22:04:36'),
(33, 'SANTANDER DE QUILICHAO', 1, '2020-12-07 22:04:36', '2020-12-07 22:04:36'),
(34, 'SILVIA', 1, '2020-12-07 22:04:36', '2020-12-07 22:04:36'),
(35, 'SOTARA', 1, '2020-12-07 22:04:36', '2020-12-07 22:04:36'),
(36, 'SUAREZ', 1, '2020-12-07 22:04:36', '2020-12-07 22:04:36'),
(37, 'SUCRE', 1, '2020-12-07 22:04:36', '2020-12-07 22:04:36'),
(38, 'TIMBIO', 1, '2020-12-07 22:04:36', '2020-12-07 22:04:36'),
(39, 'TIMBIQUI', 1, '2020-12-07 22:04:36', '2020-12-07 22:04:36'),
(40, 'TOTORO', 1, '2020-12-07 22:04:36', '2020-12-07 22:04:36'),
(41, 'VILLA RICA', 1, '2020-12-07 22:04:36', '2020-12-07 22:04:36');

-- --------------------------------------------------------

--
-- Table structure for table `nutricions`
--

CREATE TABLE `nutricions` (
  `id` int(10) UNSIGNED NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `finca_id` int(10) UNSIGNED NOT NULL,
  `analisis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechaAnalisis` date DEFAULT NULL,
  `fertilizaAnalisis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aplicacionesCal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aplicoSiembraCal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dosisAplicacionCal` decimal(11,2) DEFAULT NULL,
  `formaAplicacionCal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frecuenciaAplicacionCal` int(11) DEFAULT NULL,
  `fechaCal` date DEFAULT NULL,
  `aplicacionesMateriaOrganica` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aplicoSiembraMateriaOrganica` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dosisAplicacionMateriaOrganica` decimal(11,2) DEFAULT NULL,
  `formaAplicacionMateriaOrganica` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frecuenciaAplicacionMateriaOrganica` int(11) DEFAULT NULL,
  `fechaMateriaOrganica` date DEFAULT NULL,
  `fechaUltimaFertilizacion` date DEFAULT NULL,
  `formaAplicacionFert` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frecuenciaAplicacionFert` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nutricions`
--

INSERT INTO `nutricions` (`id`, `productor_id`, `finca_id`, `analisis`, `fechaAnalisis`, `fertilizaAnalisis`, `aplicacionesCal`, `aplicoSiembraCal`, `dosisAplicacionCal`, `formaAplicacionCal`, `frecuenciaAplicacionCal`, `fechaCal`, `aplicacionesMateriaOrganica`, `aplicoSiembraMateriaOrganica`, `dosisAplicacionMateriaOrganica`, `formaAplicacionMateriaOrganica`, `frecuenciaAplicacionMateriaOrganica`, `fechaMateriaOrganica`, `fechaUltimaFertilizacion`, `formaAplicacionFert`, `frecuenciaAplicacionFert`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'Si', '2020-12-02', 'Si', 'Si', 'Si', '5.00', 'Plato', 3, '2020-12-08', 'Si', 'No', '3.00', 'Plato', 2, '2020-12-02', '2020-12-08', 'Liquida', 3, '2020-12-26 18:36:54', '2020-12-26 18:36:54');

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
(1, 'Admin', 1, '1107090570', 'cll 123', '3015562152', 'admin@sistemas.com', NULL, NULL),
(2, 'Admin Sistemas', 1, '1006017055', 'cra 26 #17-31', '3015562152', 'admin@sistemas.com', '2020-12-07 22:15:15', '2020-12-07 22:15:15'),
(3, 'Extensionista', 1, '1006017055', 'cll 23 #12-50', '3103861474', 'extensionista@asofrut.org', '2020-12-07 22:16:25', '2020-12-07 22:16:25'),
(4, 'Comercial', 1, '1110678909', 'cll 123', '42412412', 'comercial@asofrut.org', '2020-12-07 22:17:28', '2020-12-07 22:17:28'),
(5, 'Productor', 1, '1006017055', 'cll 120', '3305890', 'productor@asofrut.org', '2020-12-07 22:18:51', '2020-12-10 09:37:12'),
(6, 'Pedro Perez', 1, '1107090570', 'cll 10', '3306789', 'pedro@gmail.com', '2020-12-10 09:36:39', '2020-12-10 09:36:39'),
(13, 'lola', 1, '124124', 'cll 1233', '24235232', 'lola@gmail.com', '2020-12-10 10:35:51', '2020-12-10 10:35:51'),
(22, 'Juan Perez', 1, '1107090541', 'cll 123', '3389012', 'juan@hotmail.com', '2020-12-12 00:47:21', '2020-12-12 00:47:21'),
(23, 'Productor Ejemplo', 2, '1006017055', 'cll 123', '33090412', 'ejemplo@gmail.com', '2020-12-12 02:29:30', '2020-12-12 03:01:15'),
(24, 'Contador', 1, '1107090212', 'cll 124', '3305678', 'contador@asofrut.org', '2020-12-22 17:00:49', '2020-12-22 17:00:49'),
(26, 'No aplica', 1, '0000000', 'cll 123', '000000000', 'noaplica@asofrut.org', '2021-12-21 05:18:25', '2021-12-21 05:18:25'),
(28, 'NO VALIDO', 1, '000000000000000', 'cc', '4', 'ffff@gmail.com', '2021-12-21 05:19:58', '2021-12-21 05:20:47');

-- --------------------------------------------------------

--
-- Table structure for table `plagas`
--

CREATE TABLE `plagas` (
  `id` int(10) UNSIGNED NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `finca_id` int(10) UNSIGNED NOT NULL,
  `monitoreo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frecuenciaMonitoreo` int(11) DEFAULT NULL,
  `perlaTierra` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoManejoPerla` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frecuenciaAplicacionPerla` int(11) DEFAULT NULL,
  `barrenadorCultivo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoManejoBarrenador` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frecuenciaAplicacionBarrenador` int(11) DEFAULT NULL,
  `tripsCultivo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoManejoTrips` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frecuenciaAplicacionTrips` int(11) DEFAULT NULL,
  `afidiosCultivos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoManejoAfidios` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frecuenciaAplicacionAfidios` int(11) DEFAULT NULL,
  `acarosCultivos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoManejoAcaros` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frecuenciaAplicacionAcaros` int(11) DEFAULT NULL,
  `cochinillaCultivos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoManejoCochinilla` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frecuenciaAplicacionCochinilla` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plagas`
--

INSERT INTO `plagas` (`id`, `productor_id`, `finca_id`, `monitoreo`, `frecuenciaMonitoreo`, `perlaTierra`, `tipoManejoPerla`, `frecuenciaAplicacionPerla`, `barrenadorCultivo`, `tipoManejoBarrenador`, `frecuenciaAplicacionBarrenador`, `tripsCultivo`, `tipoManejoTrips`, `frecuenciaAplicacionTrips`, `afidiosCultivos`, `tipoManejoAfidios`, `frecuenciaAplicacionAfidios`, `acarosCultivos`, `tipoManejoAcaros`, `frecuenciaAplicacionAcaros`, `cochinillaCultivos`, `tipoManejoCochinilla`, `frecuenciaAplicacionCochinilla`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'Si', 3, 'Si', 'Caldos minerales', 3, 'Si', 'Biologicos', 3, 'Si', 'Agroquimicos', 1, 'Si', 'Caldos minerales', 2, 'Si', 'Biologicos', 2, 'Si', 'Trampas', 3, '2020-12-22 03:12:14', '2020-12-22 03:12:14');

-- --------------------------------------------------------

--
-- Table structure for table `podas`
--

CREATE TABLE `podas` (
  `id` int(10) UNSIGNED NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `finca_id` int(10) UNSIGNED NOT NULL,
  `estadoVegetativo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `podaFormacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `podaAclareo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frecuenciaAclareo` int(11) DEFAULT NULL,
  `podaMantenimiento` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frecuenciaMantenimiento` int(11) DEFAULT NULL,
  `podaFitosanitaria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frecuenciaFitosanitaria` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `podas`
--

INSERT INTO `podas` (`id`, `productor_id`, `finca_id`, `estadoVegetativo`, `podaFormacion`, `podaAclareo`, `frecuenciaAclareo`, `podaMantenimiento`, `frecuenciaMantenimiento`, `podaFitosanitaria`, `frecuenciaFitosanitaria`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'Levante', 'Si', 'Si', 2, 'Si', 3, 'Si', 3, '2020-12-21 23:27:35', '2020-12-21 23:27:35');

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
(3, 'Herencia', NULL, NULL),
(4, 'Adjudicacion', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `practicas`
--

CREATE TABLE `practicas` (
  `id` int(10) UNSIGNED NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `finca_id` int(10) UNSIGNED NOT NULL,
  `vivenda` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `viveSitio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bateriaSanitaria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pozoSeptico` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zonaBarbecho` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usaBarbecho` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agroquimicos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mezclaAgroquimicos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usaAgroquimicos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bodegaMateriales` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usaBodega` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `canastillas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usaCanastillas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trajeProteccion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usaTraje` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `puntoEcologico` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usaPuntoEcologico` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `botiquin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usaBotiquin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extintor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usaExtintor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capacitacionesBPA` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificadas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institucionCertificado` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiempo` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `practicas`
--

INSERT INTO `practicas` (`id`, `productor_id`, `finca_id`, `vivenda`, `viveSitio`, `bateriaSanitaria`, `pozoSeptico`, `zonaBarbecho`, `usaBarbecho`, `agroquimicos`, `mezclaAgroquimicos`, `usaAgroquimicos`, `bodegaMateriales`, `usaBodega`, `canastillas`, `usaCanastillas`, `trajeProteccion`, `usaTraje`, `puntoEcologico`, `usaPuntoEcologico`, `botiquin`, `usaBotiquin`, `extintor`, `usaExtintor`, `capacitacionesBPA`, `certificadas`, `institucionCertificado`, `tiempo`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'No', 'Si', 'No', 'No', 'Si', 'No', 'Si', 'No', 'Si', 'No', 'Si', NULL, 'Si', 'Si', 'Si', 'Si', 'SENA', NULL, '2020-12-27 05:55:19', '2020-12-27 05:55:19'),
(2, 5, 1, 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'No', 'No', 'Si', 'Si', 'No', 'Si', 'Si', 'No', 'Si', 'No', 'Si', 'Si', 'No', 'Si', 'Si', 'Si', 'Unicauca', NULL, '2020-12-27 06:03:32', '2020-12-27 06:03:32'),
(3, 5, 1, 'Si', 'Si', 'Si', 'Si', 'No', 'No', 'Si', 'Si', 'Si', 'Si', 'No', 'Si', 'No', 'Si', 'No', 'Si', 'Si', 'No', 'No', 'Si', 'Si', 'Si', 'Si', 'sena', 2, '2021-03-04 04:47:55', '2021-03-04 04:47:55');

-- --------------------------------------------------------

--
-- Table structure for table `prediocultivos`
--

CREATE TABLE `prediocultivos` (
  `id` int(10) UNSIGNED NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `finca_id` int(10) UNSIGNED NOT NULL,
  `areaSembradaPredio` decimal(11,2) NOT NULL,
  `fechaSiembra` date NOT NULL,
  `numeroPlantasTotales` int(11) DEFAULT NULL,
  `numeroPlantasProduccion` int(11) DEFAULT NULL,
  `plantasErradicadas` int(11) DEFAULT NULL,
  `plantasLevante` int(11) DEFAULT NULL,
  `TipoMora` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vereda_id` int(10) UNSIGNED DEFAULT NULL,
  `tipoReproduccion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bolsa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prediocultivos`
--

INSERT INTO `prediocultivos` (`id`, `productor_id`, `finca_id`, `areaSembradaPredio`, `fechaSiembra`, `numeroPlantasTotales`, `numeroPlantasProduccion`, `plantasErradicadas`, `plantasLevante`, `TipoMora`, `vereda_id`, `tipoReproduccion`, `bolsa`, `created_at`, `updated_at`) VALUES
(1, 5, 1, '112.00', '2020-12-02', 11, 23, 33, 11, 'Con espinas', 1, 'prueba', 'Si', '2020-12-21 22:22:02', '2020-12-21 22:22:02'),
(2, 5, 3, '112.00', '2020-12-02', 11, 23, 33, 11, 'Con espinas', 1, 'prueba', 'Si', '2021-02-03 02:05:52', '2021-02-03 02:05:52'),
(3, 13, 2, '112.00', '2020-12-02', 11, 23, 33, 11, 'Con espinas', 1, 'prueba', 'Si', '2021-02-16 09:06:30', '2021-02-16 09:06:30');

-- --------------------------------------------------------

--
-- Table structure for table `produccionconceptos`
--

CREATE TABLE `produccionconceptos` (
  `id` int(10) UNSIGNED NOT NULL,
  `gastosproduccion_id` int(10) UNSIGNED NOT NULL,
  `conceptoGasto_id` int(10) UNSIGNED NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otro` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valorTotal` decimal(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produccionconceptos`
--

INSERT INTO `produccionconceptos` (`id`, `gastosproduccion_id`, `conceptoGasto_id`, `descripcion`, `otro`, `valorTotal`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'prueba', 'probando', '213453.00', '2021-11-29 20:07:05', '2021-11-29 20:07:05'),
(2, 1, 4, 'prueba', 'sda', '231541.00', '2021-11-29 20:07:05', '2021-11-29 20:07:05'),
(3, 2, 9, 'movimientos', 'mov', '312451.00', '2021-11-29 20:07:41', '2021-11-29 20:07:41'),
(4, 2, 3, 'pro', 'd', '214535.00', '2021-11-29 20:07:41', '2021-11-29 20:07:41');

-- --------------------------------------------------------

--
-- Table structure for table `productors`
--

CREATE TABLE `productors` (
  `id` int(10) UNSIGNED NOT NULL,
  `fechaExpedicion` date NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `sexo_id` int(10) UNSIGNED NOT NULL,
  `etnia_id` int(10) UNSIGNED NOT NULL,
  `escolaridad_id` int(10) UNSIGNED NOT NULL,
  `departamento_id` int(10) UNSIGNED NOT NULL,
  `municipio_id` int(10) UNSIGNED NOT NULL,
  `vereda_id` int(10) UNSIGNED NOT NULL,
  `resguardo_id` int(10) UNSIGNED NOT NULL,
  `fechaIngreso` date NOT NULL,
  `fotocopiaCedula` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productors`
--

INSERT INTO `productors` (`id`, `fechaExpedicion`, `fechaNacimiento`, `sexo_id`, `etnia_id`, `escolaridad_id`, `departamento_id`, `municipio_id`, `vereda_id`, `resguardo_id`, `fechaIngreso`, `fotocopiaCedula`) VALUES
(5, '2020-10-10', '2020-10-10', 1, 1, 6, 1, 1, 15, 2, '2020-02-02', 'foto'),
(6, '2020-10-10', '2020-10-10', 1, 1, 8, 1, 1, 13, 1, '2020-10-10', 'foto'),
(13, '2020-11-12', '2020-10-10', 1, 1, 1, 1, 1, 1, 1, '2020-10-15', '2020-10-10'),
(22, '2004-05-01', '1974-05-01', 1, 1, 8, 1, 1, 1, 2, '2020-12-02', 'foto'),
(23, '1994-05-12', '1994-05-11', 1, 1, 6, 1, 1, 2, 2, '2001-05-02', 'foto'),
(28, '2021-12-01', '2021-12-01', 1, 1, 1, 1, 1, 1, 2, '2021-12-02', 'fff');

-- --------------------------------------------------------

--
-- Table structure for table `productoscomers`
--

CREATE TABLE `productoscomers` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valorUnitario` decimal(11,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productoscomers`
--

INSERT INTO `productoscomers` (`id`, `nombre`, `valorUnitario`, `created_at`, `updated_at`) VALUES
(1, 'Producto', '14000', '2021-12-21 02:25:02', '2021-12-21 02:25:02'),
(2, 'Fertilizante pa', '2432', '2021-12-21 02:39:46', '2021-12-21 02:41:02');

-- --------------------------------------------------------

--
-- Table structure for table `producto_fitosanitarios`
--

CREATE TABLE `producto_fitosanitarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `producto_fitosanitarios`
--

INSERT INTO `producto_fitosanitarios` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'ABAFED 18EC', '2020-12-16 19:29:46', '2021-01-21 12:06:13'),
(2, 'ACAEMIC  ', '2020-12-16 19:29:46', '2020-12-16 19:29:46'),
(3, 'ACARISTOP SC  ', '2020-12-16 19:29:46', '2020-12-16 19:29:46'),
(4, 'ACORBAT MZ 69%W.P  ', '2020-12-16 19:29:47', '2020-12-16 19:29:47'),
(5, 'ACTARA 25 WG  ', '2020-12-16 19:29:47', '2020-12-16 19:29:47'),
(6, 'ACTELLIC 50 EC  ', '2020-12-16 19:29:47', '2020-12-16 19:29:47'),
(7, 'ACUAFIN 440 EW  ', '2020-12-16 19:29:47', '2020-12-16 19:29:47'),
(8, 'AFUGAN 30 EC  ', '2020-12-16 19:29:47', '2020-12-16 19:29:47'),
(9, 'AGENT-48 EC  ', '2020-12-16 19:29:47', '2020-12-16 19:29:47'),
(10, 'AGRIDOR 350 EC  ', '2020-12-16 19:29:47', '2020-12-16 19:29:47'),
(11, 'AGRIFOS SL  ', '2020-12-16 19:29:47', '2020-12-16 19:29:47'),
(12, 'AGRIMEC 1.8% CE  ', '2020-12-16 19:29:47', '2020-12-16 19:29:47'),
(13, 'AGRIXON EC  ', '2020-12-16 19:29:47', '2020-12-16 19:29:47'),
(14, 'AGRODYNE SL  ', '2020-12-16 19:29:47', '2020-12-16 19:29:47'),
(15, 'AGROMETOX E-40 EC  ', '2020-12-16 19:29:47', '2020-12-16 19:29:47'),
(16, 'AGROMIDOR 60 SL  ', '2020-12-16 19:29:47', '2020-12-16 19:29:47'),
(17, 'AGROMIFOS 600 SL  ', '2020-12-16 19:29:47', '2020-12-16 19:29:47'),
(18, 'AGROPER 250 E.C.  ', '2020-12-16 19:29:47', '2020-12-16 19:29:47'),
(19, 'AGROPYRIFOS 480 EC  ', '2020-12-16 19:29:47', '2020-12-16 19:29:47'),
(20, 'AGROTOX 58.8% WP  ', '2020-12-16 19:29:47', '2020-12-16 19:29:47'),
(23, 'AGROZIM 50 WP  ', '2020-12-16 19:32:06', '2020-12-16 19:32:06'),
(24, 'AGROZIM 500 SC  ', '2020-12-16 19:32:06', '2020-12-16 19:32:06'),
(25, 'AGROZUL 720 SC  ', '2020-12-16 19:32:06', '2020-12-16 19:32:06'),
(26, 'ALARM SC  ', '2020-12-16 19:32:06', '2020-12-16 19:32:06'),
(27, 'ALEF 600 SL  ', '2020-12-16 19:32:06', '2020-12-16 19:32:06'),
(28, 'ALFA POINT 10 EC  ', '2020-12-16 19:32:06', '2020-12-16 19:32:06'),
(29, 'ALGODONERO 630 UL  ', '2020-12-16 19:32:06', '2020-12-16 19:32:06'),
(30, 'ALIETTE 80 WP  ', '2020-12-16 19:32:06', '2020-12-16 19:32:06'),
(31, 'ALSYSTIN SC 480  ', '2020-12-16 19:32:06', '2020-12-16 19:32:06'),
(32, 'ALSYSTIN WP 25  ', '2020-12-16 19:32:06', '2020-12-16 19:32:06'),
(33, 'ALTIMA 500 SC  ', '2020-12-16 19:32:06', '2020-12-16 19:32:06'),
(34, 'ALTO SL  ', '2020-12-16 19:32:06', '2020-12-16 19:32:06'),
(35, 'ALTO 100 SL  ', '2020-12-16 19:32:06', '2020-12-16 19:32:06'),
(36, 'AMIDOR 60 SL  ', '2020-12-16 19:32:06', '2020-12-16 19:32:06'),
(37, 'AMIFED 200 EC  ', '2020-12-16 19:32:06', '2020-12-16 19:32:06'),
(38, 'AMISTAR 250 SC  ', '2020-12-16 19:32:06', '2020-12-16 19:32:06'),
(39, 'AMISTAR 50 WG  ', '2020-12-16 19:32:06', '2020-12-16 19:32:06'),
(40, 'ANTRACOL WP 70  ', '2020-12-16 19:32:06', '2020-12-16 19:32:06'),
(41, 'ANVIL 250 SC  ', '2020-12-16 19:32:06', '2020-12-16 19:32:06'),
(42, 'ANVIL 5SC  ', '2020-12-16 19:32:06', '2020-12-16 19:32:06'),
(43, 'APACHE 20 EC  ', '2020-12-16 19:32:07', '2020-12-16 19:32:07'),
(44, 'ARCADO SC 150  ', '2020-12-16 19:32:07', '2020-12-16 19:32:07'),
(45, 'ARCADO SC 300  ', '2020-12-16 19:32:07', '2020-12-16 19:32:07'),
(46, 'ARRIERAFIN 2% DP  ', '2020-12-16 19:32:07', '2020-12-16 19:32:07'),
(47, 'ARRIERO 2.5 DP  ', '2020-12-16 19:32:07', '2020-12-16 19:32:07'),
(48, 'ARRIVO 200 EC  ', '2020-12-16 19:32:07', '2020-12-16 19:32:07'),
(49, 'ATABRON  ', '2020-12-16 19:32:07', '2020-12-16 19:32:07'),
(50, 'ATHRIN 50 EC  ', '2020-12-16 19:32:07', '2020-12-16 19:32:07'),
(51, 'ATILON 600 SL  ', '2020-12-16 19:32:07', '2020-12-16 19:32:07'),
(52, 'ATTA-KILL  ', '2020-12-16 19:32:07', '2020-12-16 19:32:07'),
(53, 'AVAUNT WG  ', '2020-12-16 19:32:07', '2020-12-16 19:32:07'),
(54, 'AVISO WG  ', '2020-12-16 19:32:07', '2020-12-16 19:32:07'),
(55, 'AVOID 1.8% EC  ', '2020-12-16 19:32:07', '2020-12-16 19:32:07'),
(56, 'AZODRIN 400 SL  ', '2020-12-16 19:32:07', '2020-12-16 19:32:07'),
(57, 'AZODRIN 600 SL  ', '2020-12-16 19:32:07', '2020-12-16 19:32:07'),
(58, 'AZUCO  ', '2020-12-16 19:32:07', '2020-12-16 19:32:07'),
(59, 'AZUFRE 720  ', '2020-12-16 19:32:07', '2020-12-16 19:32:07'),
(60, 'BAMBOLERO 3% GR  ', '2020-12-16 19:32:07', '2020-12-16 19:32:07'),
(61, 'BAMBUCO  3% DP  ', '2020-12-16 19:32:07', '2020-12-16 19:32:07'),
(62, 'BANKIT 25 SC  ', '2020-12-16 19:32:07', '2020-12-16 19:32:07'),
(63, 'BASUDIN 600 EC  ', '2020-12-16 19:32:08', '2020-12-16 19:32:08'),
(64, 'BAVISTIN WP  ', '2020-12-16 19:32:08', '2020-12-16 19:32:08'),
(65, 'BAYCOR DC 300  ', '2020-12-16 19:32:08', '2020-12-16 19:32:08'),
(66, 'BAYFIDAN DC 250  ', '2020-12-16 19:32:08', '2020-12-16 19:32:08'),
(67, 'BAYLETON EC 250  ', '2020-12-16 19:32:08', '2020-12-16 19:32:08'),
(68, 'BAYLETON GR 1%  ', '2020-12-16 19:32:08', '2020-12-16 19:32:08'),
(69, 'BAYLETON WP 25  ', '2020-12-16 19:32:08', '2020-12-16 19:32:08'),
(70, 'BAYTAN DS 15  ', '2020-12-16 19:32:08', '2020-12-16 19:32:08'),
(71, 'BAYTHION EC 500  ', '2020-12-16 19:32:08', '2020-12-16 19:32:08'),
(72, 'BAYTROID TM SL 525  ', '2020-12-16 19:32:08', '2020-12-16 19:32:08'),
(73, 'BAYTROIDE EC 050  ', '2020-12-16 19:32:08', '2020-12-16 19:32:08'),
(74, 'BAITROIDE EC 100  ', '2020-12-16 19:32:08', '2020-12-16 19:32:08'),
(75, 'BELLKUTE 30 SC  ', '2020-12-16 19:32:08', '2020-12-16 19:32:08'),
(76, 'BELLKUTE 40 WP  ', '2020-12-16 19:32:08', '2020-12-16 19:32:08'),
(77, 'BELMARK 30 EC  ', '2020-12-16 19:32:08', '2020-12-16 19:32:08'),
(78, 'BENOAGRO 50 WP  ', '2020-12-16 19:32:08', '2020-12-16 19:32:08'),
(79, 'BENOMYL 50 WP AGRICENSE  ', '2020-12-16 19:32:08', '2020-12-16 19:32:08'),
(80, 'BENOMYL CELLS 50 WP  ', '2020-12-16 19:32:08', '2020-12-16 19:32:08'),
(81, 'BENOMYL 50 WP ECIFONPA  ', '2020-12-16 19:32:08', '2020-12-16 19:32:08'),
(82, 'BENOMYL 50 WP LIMOR  ', '2020-12-16 19:32:09', '2020-12-16 19:32:09'),
(83, 'BENOPOINT 50 WP  ', '2020-12-16 19:32:09', '2020-12-16 19:32:09'),
(84, 'BETA - BAYTROIDE SC 125  ', '2020-12-16 19:32:09', '2020-12-16 19:32:09'),
(85, 'BEZIL 50 WP  ', '2020-12-16 19:32:09', '2020-12-16 19:32:09'),
(86, 'BIM 75 WP  ', '2020-12-16 19:32:09', '2020-12-16 19:32:09'),
(87, 'BIRLANE 240 EC  ', '2020-12-16 19:32:09', '2020-12-16 19:32:09'),
(88, 'BOLIDO SC  ', '2020-12-16 19:32:09', '2020-12-16 19:32:09'),
(89, 'BOLSTAR EC 720  ', '2020-12-16 19:32:09', '2020-12-16 19:32:09'),
(90, 'BORNEO 11 SC  ', '2020-12-16 19:32:09', '2020-12-16 19:32:09'),
(91, 'BRAVO 2787 W-75  ', '2020-12-16 19:32:09', '2020-12-16 19:32:09'),
(92, 'BRAVO 500 SC  ', '2020-12-16 19:32:09', '2020-12-16 19:32:09'),
(93, 'BRAVO 75 WP  ', '2020-12-16 19:32:09', '2020-12-16 19:32:09'),
(94, 'BRAVO S SC  ', '2020-12-16 19:32:09', '2020-12-16 19:32:09'),
(95, 'BRAVONIL 720 SC  ', '2020-12-16 19:32:09', '2020-12-16 19:32:09'),
(96, 'BRAVONIL 500 SC  ', '2020-12-16 19:32:09', '2020-12-16 19:32:09'),
(97, 'BRAVONIL 720 SC COLJAP  ', '2020-12-16 19:32:09', '2020-12-16 19:32:09'),
(98, 'BRAVONIL 825 WG  ', '2020-12-16 19:32:09', '2020-12-16 19:32:09'),
(99, 'BRESTANID 500 SC  ', '2020-12-16 19:32:09', '2020-12-16 19:32:09'),
(100, 'BRODIONE SC  ', '2020-12-16 19:32:09', '2020-12-16 19:32:09'),
(101, 'BULLDOCK EC 025  ', '2020-12-16 19:32:09', '2020-12-16 19:32:09'),
(102, 'BULLDOCK SC 025  ', '2020-12-16 19:32:09', '2020-12-16 19:32:09'),
(103, 'BUMPER 25 EC  ', '2020-12-16 19:32:09', '2020-12-16 19:32:09'),
(104, 'CABO SC 500  ', '2020-12-16 19:32:09', '2020-12-16 19:32:09'),
(105, 'CALIDAN SC  ', '2020-12-16 19:32:09', '2020-12-16 19:32:09'),
(106, 'CALIXIN EC  ', '2020-12-16 19:32:09', '2020-12-16 19:32:09'),
(107, 'CAPTAM 50% PROFICOL WP  ', '2020-12-16 19:32:09', '2020-12-16 19:32:09'),
(108, 'CAPTAN 50 WP FERSAGRO  ', '2020-12-16 19:32:09', '2020-12-16 19:32:09'),
(109, 'CARAMBA 90 SL  ', '2020-12-16 19:32:10', '2020-12-16 19:32:10'),
(110, 'CARBARYL INVEQUIMICA  ', '2020-12-16 19:32:10', '2020-12-16 19:32:10'),
(111, 'CARBENDACROP 500 SC  ', '2020-12-16 19:32:10', '2020-12-16 19:32:10'),
(112, 'CARBENDAZIM  ', '2020-12-16 19:32:10', '2020-12-16 19:32:10'),
(113, 'CARBENDAZIM FEDEARROZ  ', '2020-12-16 19:32:10', '2020-12-16 19:32:10'),
(114, 'CARBENDAZIM CROPTECH 50  WP  ', '2020-12-16 19:32:10', '2020-12-16 19:32:10'),
(115, 'CARBENDAZIM CROPTECH 500 SC  ', '2020-12-16 19:32:10', '2020-12-16 19:32:10'),
(116, 'CARBENDAZIM DUPONT  ', '2020-12-16 19:32:10', '2020-12-16 19:32:10'),
(117, 'CARBENDAZIM POINT 50 WP  ', '2020-12-16 19:32:10', '2020-12-16 19:32:10'),
(118, 'CARBENDAZIM POINT 500 SC  ', '2020-12-16 19:32:10', '2020-12-16 19:32:10'),
(119, 'CARBIN 50 WP  ', '2020-12-16 19:32:10', '2020-12-16 19:32:10'),
(120, 'CARBIN 500 SC  ', '2020-12-16 19:32:10', '2020-12-16 19:32:10'),
(121, 'CARBOFED 3 GR  ', '2020-12-16 19:32:10', '2020-12-16 19:32:10'),
(122, 'CARBOFED 330 SC  ', '2020-12-16 19:32:10', '2020-12-16 19:32:10'),
(123, 'CARBOFURAN 3 G QUIMOR  ', '2020-12-16 19:32:10', '2020-12-16 19:32:10'),
(124, 'CARBOFURAN 3GR  ', '2020-12-16 19:32:10', '2020-12-16 19:32:10'),
(125, 'CARBOFURAN 330 SC  ', '2020-12-16 19:32:11', '2020-12-16 19:32:11'),
(126, 'CARBOFURAN AGROGEN 330 SC  ', '2020-12-16 19:32:11', '2020-12-16 19:32:11'),
(127, 'CARBOGROZ 3 GR  ', '2020-12-16 19:32:11', '2020-12-16 19:32:11'),
(128, 'CARBOGROZ 330 SC  ', '2020-12-16 19:32:11', '2020-12-16 19:32:11'),
(129, 'CARBOTER 330 SC  ', '2020-12-16 19:32:11', '2020-12-16 19:32:11'),
(130, 'CARBOTOX 330 SC  ', '2020-12-16 19:32:11', '2020-12-16 19:32:11'),
(131, 'CASCADE DC  ', '2020-12-16 19:32:11', '2020-12-16 19:32:11'),
(132, 'CATOMBE 2.8% CE  ', '2020-12-16 19:32:11', '2020-12-16 19:32:11'),
(133, 'CAZADOR 80 WG  ', '2020-12-16 19:32:11', '2020-12-16 19:32:11'),
(134, 'CALEST 025 FS  ', '2020-12-16 19:32:11', '2020-12-16 19:32:11'),
(135, 'CENTAURO 720 SC  ', '2020-12-16 19:32:11', '2020-12-16 19:32:11'),
(136, 'CHAMP SC  ', '2020-12-16 19:32:11', '2020-12-16 19:32:11'),
(137, 'CHAMPION WP  ', '2020-12-16 19:32:11', '2020-12-16 19:32:11'),
(138, 'CHLORPYRIFOS AGROGEN 480% EC  ', '2020-12-16 19:32:11', '2020-12-16 19:32:11'),
(139, 'CIPERMETRINA AGROGEN 200 EC  ', '2020-12-16 19:32:11', '2020-12-16 19:32:11'),
(140, 'CIROMEX 75 WP  ', '2020-12-16 19:32:11', '2020-12-16 19:32:11'),
(141, 'CITROEMULSION  ', '2020-12-16 19:32:11', '2020-12-16 19:32:11'),
(142, 'CLORFOS 2.5 DP  ', '2020-12-16 19:32:11', '2020-12-16 19:32:11'),
(143, 'CLORFOS 48 EC  ', '2020-12-16 19:32:11', '2020-12-16 19:32:11'),
(144, 'CLOROTALONIL 500 FW MORE  ', '2020-12-16 19:32:11', '2020-12-16 19:32:11'),
(145, 'CLOROTALONIL 75 WP LIMOR  ', '2020-12-16 19:32:11', '2020-12-16 19:32:11'),
(146, 'CLORPIRICOL 4 EC  ', '2020-12-16 19:32:11', '2020-12-16 19:32:11'),
(147, 'CLORPIRIFOS 48 EC ECIFONPA  ', '2020-12-16 19:32:11', '2020-12-16 19:32:11'),
(148, 'CLORPIRIGROZ 480 EC  ', '2020-12-16 19:32:12', '2020-12-16 19:32:12'),
(149, 'CLORTOCAFFARO 500 SC  ', '2020-12-16 19:32:12', '2020-12-16 19:32:12'),
(150, 'CLORTOCAFFARO 75 WP  ', '2020-12-16 19:32:12', '2020-12-16 19:32:12'),
(151, 'CLOROSIP 720 SC  ', '2020-12-16 19:32:12', '2020-12-16 19:32:12'),
(152, 'COBRETHANE  ', '2020-12-16 19:32:12', '2020-12-16 19:32:12'),
(153, 'COLIMYL 50 WP  ', '2020-12-16 19:32:12', '2020-12-16 19:32:12'),
(154, 'COLIZYM 500 SC  ', '2020-12-16 19:32:12', '2020-12-16 19:32:12'),
(155, 'CONFIDOR SC 350  ', '2020-12-16 19:32:12', '2020-12-16 19:32:12'),
(156, 'CONFIRM  ', '2020-12-16 19:32:12', '2020-12-16 19:32:12'),
(157, 'CONTROL - S  ', '2020-12-16 19:32:12', '2020-12-16 19:32:12'),
(158, 'CONTROL 500 SC  ', '2020-12-16 19:32:12', '2020-12-16 19:32:12'),
(159, 'CONTROL 720 SC  ', '2020-12-16 19:32:12', '2020-12-16 19:32:12'),
(160, 'CONTROL 75% WP  ', '2020-12-16 19:32:12', '2020-12-16 19:32:12'),
(161, 'COPER PRO 40 WG  ', '2020-12-16 19:32:12', '2020-12-16 19:32:12'),
(162, 'COPPER FLOW 24 SC  ', '2020-12-16 19:32:12', '2020-12-16 19:32:12'),
(163, 'COPPER PRO 28 WG  ', '2020-12-16 19:32:12', '2020-12-16 19:32:12'),
(164, 'COSMO OIL EMULSION EO  ', '2020-12-16 19:32:12', '2020-12-16 19:32:12'),
(165, 'COTNIO - METHIL 20 SC  ', '2020-12-16 19:32:12', '2020-12-16 19:32:12'),
(166, 'COUNTER 10 G  ', '2020-12-16 19:32:12', '2020-12-16 19:32:12'),
(167, 'COUNTER 10% G  ', '2020-12-16 19:32:12', '2020-12-16 19:32:12'),
(168, 'COUNTER FC 16 GR  ', '2020-12-16 19:32:12', '2020-12-16 19:32:12'),
(169, 'CRASTAN EC  ', '2020-12-16 19:32:12', '2020-12-16 19:32:12'),
(170, 'CROPTHION EC  ', '2020-12-16 19:32:12', '2020-12-16 19:32:12'),
(171, 'CRYZUFRE 720  ', '2020-12-16 19:32:12', '2020-12-16 19:32:12'),
(172, 'CUPROZATE  ', '2020-12-16 19:32:13', '2020-12-16 19:32:13'),
(173, 'CURACARB 50 WP  ', '2020-12-16 19:32:13', '2020-12-16 19:32:13'),
(174, 'CURACARB 500 SC  ', '2020-12-16 19:32:13', '2020-12-16 19:32:13'),
(175, 'CURACRON 500 EC  ', '2020-12-16 19:32:13', '2020-12-16 19:32:13'),
(176, 'CURATER GR 10  ', '2020-12-16 19:32:13', '2020-12-16 19:32:13'),
(177, 'CURATER GR 3  ', '2020-12-16 19:32:13', '2020-12-16 19:32:13'),
(178, 'CURATER GR 5  ', '2020-12-16 19:32:13', '2020-12-16 19:32:13'),
(179, 'CURATER SC 330  ', '2020-12-16 19:32:13', '2020-12-16 19:32:13'),
(180, 'CURATHANE  ', '2020-12-16 19:32:13', '2020-12-16 19:32:13'),
(181, 'CURAXIL  ', '2020-12-16 19:32:13', '2020-12-16 19:32:13'),
(182, 'CURZATE M-8  ', '2020-12-16 19:32:13', '2020-12-16 19:32:13'),
(183, 'CYCO  ', '2020-12-16 19:32:13', '2020-12-16 19:32:13'),
(184, 'CYMBUSH EC  ', '2020-12-16 19:32:13', '2020-12-16 19:32:13'),
(185, 'CYMOGRIZEB CM-8  ', '2020-12-16 19:32:13', '2020-12-16 19:32:13'),
(186, 'CYPERMON EC  ', '2020-12-16 19:32:13', '2020-12-16 19:32:13'),
(187, 'CYPERWEST 20 EC  ', '2020-12-16 19:32:13', '2020-12-16 19:32:13'),
(188, 'DACONIL 500 SC  ', '2020-12-16 19:32:13', '2020-12-16 19:32:13'),
(189, 'DACONIL 720 SC  ', '2020-12-16 19:32:13', '2020-12-16 19:32:13'),
(190, 'DACONIL 825 WG  ', '2020-12-16 19:32:13', '2020-12-16 19:32:13'),
(191, 'DACONIL S SC  ', '2020-12-16 19:32:13', '2020-12-16 19:32:13'),
(192, 'DALE 2.5 DP  ', '2020-12-16 19:32:13', '2020-12-16 19:32:13'),
(193, 'DALE 48 EC  ', '2020-12-16 19:32:13', '2020-12-16 19:32:13'),
(194, 'DANITOL 10 EC  ', '2020-12-16 19:32:13', '2020-12-16 19:32:13'),
(195, 'DART 15 SC  ', '2020-12-16 19:32:13', '2020-12-16 19:32:13'),
(196, 'DECIS 2.5 EC  ', '2020-12-16 19:32:13', '2020-12-16 19:32:13'),
(197, 'DELSENE M-200  ', '2020-12-16 19:32:14', '2020-12-16 19:32:14'),
(198, 'DELTAPOINT 2.5 WP  ', '2020-12-16 19:32:14', '2020-12-16 19:32:14'),
(199, 'DEROSAL 60 WP  ', '2020-12-16 19:32:14', '2020-12-16 19:32:14'),
(200, 'ANVIL 5 SC  ', '2020-12-16 19:32:14', '2020-12-16 19:32:14'),
(201, 'DETRIN 2.5 EC  ', '2020-12-16 19:32:14', '2020-12-16 19:32:14'),
(202, 'DHIMEFO 4% DP  ', '2020-12-16 19:32:14', '2020-12-16 19:32:14'),
(203, 'DIAZINON 600 FEDEARROZ EC  ', '2020-12-16 19:32:14', '2020-12-16 19:32:14'),
(204, 'DIAZINON PROFICOL 60 EC  ', '2020-12-16 19:32:14', '2020-12-16 19:32:14'),
(205, 'DIAZOL EC  ', '2020-12-16 19:32:14', '2020-12-16 19:32:14'),
(206, 'DICLAN 500 SC  ', '2020-12-16 19:32:14', '2020-12-16 19:32:14'),
(207, 'DIMETOX E-40 EC  ', '2020-12-16 19:32:14', '2020-12-16 19:32:14'),
(208, 'DIMILIN 25% WP  ', '2020-12-16 19:32:14', '2020-12-16 19:32:14'),
(209, 'DIMILIN SC 48%  ', '2020-12-16 19:32:14', '2020-12-16 19:32:14'),
(210, 'DIPTEREX SL 500  ', '2020-12-16 19:32:14', '2020-12-16 19:32:14'),
(211, 'DIPTEREX SP 80  ', '2020-12-16 19:32:14', '2020-12-16 19:32:14'),
(212, 'DITHANE F-448 SC  ', '2020-12-16 19:32:14', '2020-12-16 19:32:14'),
(213, 'DITHANE F-MB  ', '2020-12-16 19:32:14', '2020-12-16 19:32:14'),
(214, 'DITHANE M-45  ', '2020-12-16 19:32:14', '2020-12-16 19:32:14'),
(215, 'DITHANE M-45 WP NT  ', '2020-12-16 19:32:14', '2020-12-16 19:32:14'),
(216, 'DOMARK 40 EW  ', '2020-12-16 19:32:14', '2020-12-16 19:32:14'),
(217, 'DOMINEX 10 EC  ', '2020-12-16 19:32:14', '2020-12-16 19:32:14'),
(218, 'DOS BANG 2.5 DP  ', '2020-12-16 19:32:14', '2020-12-16 19:32:14'),
(219, 'DOS BANG 48 EC  ', '2020-12-16 19:32:14', '2020-12-16 19:32:14'),
(220, 'DUETT SC  ', '2020-12-16 19:32:14', '2020-12-16 19:32:14'),
(224, 'DURSBAN 50 WP  ', '2020-12-16 19:33:54', '2020-12-16 19:33:54'),
(225, 'DUTER 20 %  ', '2020-12-16 19:33:54', '2020-12-16 19:33:54'),
(226, 'DYSISTON GR 5  ', '2020-12-16 19:33:54', '2020-12-16 19:33:54'),
(227, 'ECHO 720 SC  ', '2020-12-16 19:33:54', '2020-12-16 19:33:54'),
(228, 'ECIMETRINA 20 EC  ', '2020-12-16 19:33:55', '2020-12-16 19:33:55'),
(229, 'EFECTRINA 200   ', '2020-12-16 19:33:55', '2020-12-16 19:33:55'),
(230, 'ELANCRON 60 SL  ', '2020-12-16 19:33:55', '2020-12-16 19:33:55'),
(231, 'ELOCROP 720  ', '2020-12-16 19:33:55', '2020-12-16 19:33:55'),
(232, 'ELOSAL 720 SC  ', '2020-12-16 19:33:55', '2020-12-16 19:33:55'),
(233, 'ELSAN 50 EC  ', '2020-12-16 19:33:55', '2020-12-16 19:33:55'),
(234, 'ELTRA 48 EC  ', '2020-12-16 19:33:55', '2020-12-16 19:33:55'),
(235, 'EMERALD PRO SE  ', '2020-12-16 19:33:55', '2020-12-16 19:33:55'),
(236, 'ENGEO  ', '2020-12-16 19:33:55', '2020-12-16 19:33:55'),
(237, 'EPINGLE 10 EC  ', '2020-12-16 19:33:55', '2020-12-16 19:33:55'),
(238, 'EQUATION PRO  ', '2020-12-16 19:33:55', '2020-12-16 19:33:55'),
(239, 'ESCORT 30 EC  ', '2020-12-16 19:33:55', '2020-12-16 19:33:55'),
(240, 'ETRAM 50 WP  ', '2020-12-16 19:33:55', '2020-12-16 19:33:55'),
(241, 'EUPAREN WP 50  ', '2020-12-16 19:33:55', '2020-12-16 19:33:55'),
(242, 'EVISECT S  ', '2020-12-16 19:33:55', '2020-12-16 19:33:55'),
(243, 'FASTAC 10 EC  ', '2020-12-16 19:33:55', '2020-12-16 19:33:55'),
(244, 'FENOTHION 50 EC  ', '2020-12-16 19:33:55', '2020-12-16 19:33:55'),
(245, 'FENTOPEN 500 EC  ', '2020-12-16 19:33:55', '2020-12-16 19:33:55'),
(246, 'FERSACRON 60 SL  ', '2020-12-16 19:33:55', '2020-12-16 19:33:55'),
(247, 'FITORAZ WP 76  ', '2020-12-16 19:33:55', '2020-12-16 19:33:55'),
(248, 'FOLI-R-FOS 400 SL  ', '2020-12-16 19:33:55', '2020-12-16 19:33:55'),
(249, 'FOLICUR EC 250  ', '2020-12-16 19:33:55', '2020-12-16 19:33:55'),
(250, 'FOLICUR EW 250  ', '2020-12-16 19:33:55', '2020-12-16 19:33:55'),
(251, 'FOLIMAT SL 500  ', '2020-12-16 19:33:56', '2020-12-16 19:33:56'),
(252, 'FOLPAN 48 SC  ', '2020-12-16 19:33:56', '2020-12-16 19:33:56'),
(253, 'FOLPAN 80 WP  ', '2020-12-16 19:33:56', '2020-12-16 19:33:56'),
(254, 'FONGARID 25 WP  ', '2020-12-16 19:33:56', '2020-12-16 19:33:56'),
(255, 'FORE  ', '2020-12-16 19:33:56', '2020-12-16 19:33:56'),
(256, 'FORMAT 70 WP  ', '2020-12-16 19:33:56', '2020-12-16 19:33:56'),
(257, 'FORTUNE 5 SC  ', '2020-12-16 19:33:56', '2020-12-16 19:33:56'),
(258, 'FORUM 500 WP  ', '2020-12-16 19:33:56', '2020-12-16 19:33:56'),
(259, 'FOSETAL  ', '2020-12-16 19:33:56', '2020-12-16 19:33:56'),
(260, 'FOSFACRON 60 SL  ', '2020-12-16 19:33:56', '2020-12-16 19:33:56'),
(261, 'FOSFAMAG FT  ', '2020-12-16 19:33:56', '2020-12-16 19:33:56'),
(262, 'FOSFAMIN - A  ', '2020-12-16 19:33:56', '2020-12-16 19:33:56'),
(263, 'FUDIOLAN 40 EC  ', '2020-12-16 19:33:56', '2020-12-16 19:33:56'),
(264, 'FULGOR 20 EC  ', '2020-12-16 19:33:56', '2020-12-16 19:33:56'),
(265, 'FUNCLORAZ 40 EC  ', '2020-12-16 19:33:57', '2020-12-16 19:33:57'),
(266, 'FUNGAZIL 100 SL  ', '2020-12-16 19:33:57', '2020-12-16 19:33:57'),
(267, 'FUNGAZIL75 SP  ', '2020-12-16 19:33:57', '2020-12-16 19:33:57'),
(268, 'FUNGITANE 430 SC  ', '2020-12-16 19:33:57', '2020-12-16 19:33:57'),
(269, 'FUNGITANE 80 WP  ', '2020-12-16 19:33:57', '2020-12-16 19:33:57'),
(270, 'FUNLATE 50 WP  ', '2020-12-16 19:33:57', '2020-12-16 19:33:57'),
(271, 'FURADAN 10 GR  ', '2020-12-16 19:33:57', '2020-12-16 19:33:57'),
(272, 'FURADAN 3 SC  ', '2020-12-16 19:33:57', '2020-12-16 19:33:57'),
(273, 'FURADAN 4 SC  ', '2020-12-16 19:33:57', '2020-12-16 19:33:57'),
(274, 'FURADAN 5 GRANULADO  ', '2020-12-16 19:33:57', '2020-12-16 19:33:57'),
(275, 'FURALIMOR SC  ', '2020-12-16 19:33:57', '2020-12-16 19:33:57'),
(276, 'FURSEM SC  ', '2020-12-16 19:33:57', '2020-12-16 19:33:57'),
(277, 'GALBEN MZ - 10 - 48  ', '2020-12-16 19:33:57', '2020-12-16 19:33:57'),
(278, 'GASTION  ', '2020-12-16 19:33:57', '2020-12-16 19:33:57'),
(279, 'GAUCHO FS 600  ', '2020-12-16 19:33:57', '2020-12-16 19:33:57'),
(280, 'GOLDZIM 500 SC  ', '2020-12-16 19:33:57', '2020-12-16 19:33:57'),
(281, 'GRANIT SC  ', '2020-12-16 19:33:57', '2020-12-16 19:33:57'),
(282, 'GRIZEB 75WP  ', '2020-12-16 19:33:57', '2020-12-16 19:33:57'),
(283, 'GRIZEB 80 WP  ', '2020-12-16 19:33:57', '2020-12-16 19:33:57'),
(284, 'GROLAN WP  ', '2020-12-16 19:33:57', '2020-12-16 19:33:57'),
(285, 'GUSATHION EC 200  ', '2020-12-16 19:33:57', '2020-12-16 19:33:57'),
(286, 'HALMARK 10% EC  ', '2020-12-16 19:33:57', '2020-12-16 19:33:57'),
(287, 'HARPON 66 WP  ', '2020-12-16 19:33:57', '2020-12-16 19:33:57'),
(288, 'HELCOZEB 80 WP  ', '2020-12-16 19:33:57', '2020-12-16 19:33:57'),
(289, 'HELMISTIN 500 SC  ', '2020-12-16 19:33:57', '2020-12-16 19:33:57'),
(290, 'HELMOBEN 50 WP  ', '2020-12-16 19:33:58', '2020-12-16 19:33:58'),
(291, 'HELMOFOS 48 EC  ', '2020-12-16 19:33:58', '2020-12-16 19:33:58'),
(292, 'HELMONIL 500 SC  ', '2020-12-16 19:33:58', '2020-12-16 19:33:58'),
(293, 'HIDROXICUB 101 WP  ', '2020-12-16 19:33:58', '2020-12-16 19:33:58'),
(294, 'HINOSAN EC 500  ', '2020-12-16 19:33:58', '2020-12-16 19:33:58'),
(295, 'HORKIL  ', '2020-12-16 19:33:58', '2020-12-16 19:33:58'),
(296, 'HOSTATHION 1% GR  ', '2020-12-16 19:33:58', '2020-12-16 19:33:58'),
(297, 'HOSTATHION 2-1  ', '2020-12-16 19:33:58', '2020-12-16 19:33:58'),
(298, 'HOSTATHION 40 EC  ', '2020-12-16 19:33:58', '2020-12-16 19:33:58'),
(299, 'HYDRO FLOW 24 SC  ', '2020-12-16 19:33:58', '2020-12-16 19:33:58'),
(300, 'HYDRO PRO 35 WG  ', '2020-12-16 19:33:58', '2020-12-16 19:33:58'),
(301, 'HYPERKILL 25 EC  ', '2020-12-16 19:33:58', '2020-12-16 19:33:58'),
(302, 'IMIDACLOPRID OMA 350 SC  ', '2020-12-16 19:33:58', '2020-12-16 19:33:58'),
(303, 'INDAR 2 OF  ', '2020-12-16 19:33:58', '2020-12-16 19:33:58'),
(304, 'INDAR 50 OF  ', '2020-12-16 19:33:58', '2020-12-16 19:33:58'),
(305, 'INISAN 60 SL  ', '2020-12-16 19:33:58', '2020-12-16 19:33:58'),
(306, 'INITHION 50 EC  ', '2020-12-16 19:33:58', '2020-12-16 19:33:58'),
(307, 'INSECTRINA 20 EC  ', '2020-12-16 19:33:58', '2020-12-16 19:33:58'),
(308, 'INTREPID 2-F  ', '2020-12-16 19:33:58', '2020-12-16 19:33:58'),
(309, 'INVENTO WP 66.8  ', '2020-12-16 19:33:59', '2020-12-16 19:33:59'),
(310, 'INVEZEB 80 WP  ', '2020-12-16 19:33:59', '2020-12-16 19:33:59'),
(311, 'JADE WG 70  ', '2020-12-16 19:33:59', '2020-12-16 19:33:59'),
(312, 'K-OBIOL 25 EC  ', '2020-12-16 19:33:59', '2020-12-16 19:33:59'),
(313, 'K-OTHRINE ® SO SC   ', '2020-12-16 19:33:59', '2020-12-16 19:33:59'),
(314, 'K-SIDOR 60 SL  ', '2020-12-16 19:33:59', '2020-12-16 19:33:59'),
(315, 'KANPAI 5% SC  ', '2020-12-16 19:33:59', '2020-12-16 19:33:59'),
(316, 'KARATE EC  ', '2020-12-16 19:33:59', '2020-12-16 19:33:59'),
(317, 'KARATE ZEON CS  ', '2020-12-16 19:33:59', '2020-12-16 19:33:59'),
(318, 'KASUMIN 2% SL  ', '2020-12-16 19:33:59', '2020-12-16 19:33:59'),
(319, 'KASUMIN - P  ', '2020-12-16 19:33:59', '2020-12-16 19:33:59'),
(320, 'KENDO  ', '2020-12-16 19:33:59', '2020-12-16 19:33:59'),
(321, 'KIMATIO SC  ', '2020-12-16 19:33:59', '2020-12-16 19:33:59'),
(322, 'KITAZIN 48 EC  ', '2020-12-16 19:33:59', '2020-12-16 19:33:59'),
(323, 'KOCIDE 101  ', '2020-12-16 19:33:59', '2020-12-16 19:33:59'),
(324, 'KOCIDE 2000 WG  ', '2020-12-16 19:33:59', '2020-12-16 19:33:59'),
(325, 'KUMULUS DF  ', '2020-12-16 19:33:59', '2020-12-16 19:33:59'),
(326, 'LANCERO 500 EC  ', '2020-12-16 19:33:59', '2020-12-16 19:33:59'),
(327, 'LANNATE 40 SP  ', '2020-12-16 19:33:59', '2020-12-16 19:33:59'),
(328, 'LANNATE SL  ', '2020-12-16 19:33:59', '2020-12-16 19:33:59'),
(329, 'LANZETA 48 EC  ', '2020-12-16 19:33:59', '2020-12-16 19:33:59'),
(330, 'LARVIN 375 SC  ', '2020-12-16 19:34:00', '2020-12-16 19:34:00'),
(331, 'LATIGO EC  ', '2020-12-16 19:34:00', '2020-12-16 19:34:00'),
(332, 'LEBAYCID EC 500  ', '2020-12-16 19:34:00', '2020-12-16 19:34:00'),
(333, 'LIMBER 15 WP  ', '2020-12-16 19:34:00', '2020-12-16 19:34:00'),
(334, 'LORSBAN 2.5% G  ', '2020-12-16 19:34:00', '2020-12-16 19:34:00'),
(335, 'LORSBAN 240 EC  ', '2020-12-16 19:34:00', '2020-12-16 19:34:00'),
(336, 'LORSBAN 4 EC  ', '2020-12-16 19:34:00', '2020-12-16 19:34:00'),
(337, 'MAESTRO 50% WP  ', '2020-12-16 19:34:00', '2020-12-16 19:34:00'),
(338, 'MAGESTIC 75% SP  ', '2020-12-16 19:34:00', '2020-12-16 19:34:00'),
(339, 'MAGNATE SULFATO 75 SP  ', '2020-12-16 19:34:00', '2020-12-16 19:34:00'),
(340, 'MAKIO 500 SC  ', '2020-12-16 19:34:00', '2020-12-16 19:34:00'),
(341, 'MALATHION 57 EC  ', '2020-12-16 19:34:00', '2020-12-16 19:34:00'),
(342, 'MALATHION LIMOR  ', '2020-12-16 19:34:00', '2020-12-16 19:34:00'),
(343, 'MANAZEB 80 WP QUIMOR  ', '2020-12-16 19:34:00', '2020-12-16 19:34:00'),
(344, 'MANCOLJAP WP 80%  ', '2020-12-16 19:34:00', '2020-12-16 19:34:00'),
(345, 'MANCOZEB 80  ', '2020-12-16 19:34:00', '2020-12-16 19:34:00'),
(346, 'MANCOZEB 80 WP  ', '2020-12-16 19:34:00', '2020-12-16 19:34:00'),
(347, 'MANCOZEB AGROGEN 430 SC  ', '2020-12-16 19:34:00', '2020-12-16 19:34:00'),
(348, 'MANCOZEB AGROGEN 80% WP  ', '2020-12-16 19:34:00', '2020-12-16 19:34:00'),
(349, 'MANCOZEB FEDEARROZ 430 SC  ', '2020-12-16 19:34:00', '2020-12-16 19:34:00'),
(350, 'MANCOZEB FEDEARROZ 80% WP  ', '2020-12-16 19:34:00', '2020-12-16 19:34:00'),
(351, 'MANCOZEB POINT 80 WP  ', '2020-12-16 19:34:00', '2020-12-16 19:34:00'),
(352, 'MANCROP 80 WP  ', '2020-12-16 19:34:00', '2020-12-16 19:34:00'),
(353, 'MANGRICEN 80 SC  ', '2020-12-16 19:34:00', '2020-12-16 19:34:00'),
(354, 'MANGRICEN 80 WP  ', '2020-12-16 19:34:01', '2020-12-16 19:34:01'),
(355, 'MANZATE 200 SC  ', '2020-12-16 19:34:01', '2020-12-16 19:34:01'),
(356, 'MANZATE 200 WG  ', '2020-12-16 19:34:01', '2020-12-16 19:34:01'),
(357, 'MANZATE 200 WP  ', '2020-12-16 19:34:01', '2020-12-16 19:34:01'),
(358, 'MANZATE OWS  ', '2020-12-16 19:34:01', '2020-12-16 19:34:01'),
(359, 'MANZATE SC  ', '2020-12-16 19:34:01', '2020-12-16 19:34:01'),
(360, 'MATCH 50 EC  ', '2020-12-16 19:34:01', '2020-12-16 19:34:01'),
(361, 'MAVRIK 2 EC  ', '2020-12-16 19:34:01', '2020-12-16 19:34:01'),
(362, 'MAVRIK AQUAFLOW  ', '2020-12-16 19:34:01', '2020-12-16 19:34:01'),
(363, 'MEDIFOS 600 SL  ', '2020-12-16 19:34:01', '2020-12-16 19:34:01'),
(364, 'MELTAFUN EC  ', '2020-12-16 19:34:01', '2020-12-16 19:34:01'),
(365, 'MERCAMIL CS 220  ', '2020-12-16 19:34:01', '2020-12-16 19:34:01'),
(366, 'MERPAN 48 SC  ', '2020-12-16 19:34:01', '2020-12-16 19:34:01'),
(367, 'MERPAN 80 WG  ', '2020-12-16 19:34:01', '2020-12-16 19:34:01'),
(368, 'MERTECT 20 SL  ', '2020-12-16 19:34:01', '2020-12-16 19:34:01'),
(369, 'MERTEC 500 SC  ', '2020-12-16 19:34:01', '2020-12-16 19:34:01'),
(370, 'MESUROL SC 500  ', '2020-12-16 19:34:01', '2020-12-16 19:34:01'),
(371, 'MESUROL WP 50  ', '2020-12-16 19:34:01', '2020-12-16 19:34:01'),
(372, 'METACAP 450 CS  ', '2020-12-16 19:34:01', '2020-12-16 19:34:01'),
(373, 'METACIDE EC 480  ', '2020-12-16 19:34:01', '2020-12-16 19:34:01'),
(374, 'METACROP 600 SL  ', '2020-12-16 19:34:02', '2020-12-16 19:34:02'),
(375, 'METAMIDOFOS 600 PROFICOL  ', '2020-12-16 19:34:02', '2020-12-16 19:34:02'),
(376, 'METAMIDOFOS POINT 60 SL  ', '2020-12-16 19:34:02', '2020-12-16 19:34:02'),
(377, 'METASYSTOX R EC 250  ', '2020-12-16 19:34:02', '2020-12-16 19:34:02'),
(378, 'METHAVIN 40 SP  ', '2020-12-16 19:34:02', '2020-12-16 19:34:02'),
(379, 'METHAVIN 90 SP  ', '2020-12-16 19:34:02', '2020-12-16 19:34:02'),
(380, 'METHION 48 EC  ', '2020-12-16 19:34:02', '2020-12-16 19:34:02'),
(381, 'METHOMEX 20 SL  ', '2020-12-16 19:34:02', '2020-12-16 19:34:02'),
(382, 'METIL PARATION PROFICOL EC  ', '2020-12-16 19:34:02', '2020-12-16 19:34:02'),
(383, 'METIL PARATION 48 EC  ', '2020-12-16 19:34:02', '2020-12-16 19:34:02'),
(384, 'METIL PARATION 48% EC  ', '2020-12-16 19:34:02', '2020-12-16 19:34:02'),
(385, 'MOETOMIL SL 216 BAYER  ', '2020-12-16 19:34:02', '2020-12-16 19:34:02'),
(386, 'MICROAZUFRE  ', '2020-12-16 19:34:02', '2020-12-16 19:34:02'),
(387, 'MICRORRIEGO INICIO   ', '2020-12-16 19:34:02', '2020-12-16 19:34:02'),
(388, 'MICRORRIEGO PRODUCCION   ', '2020-12-16 19:34:02', '2020-12-16 19:34:02'),
(389, 'MICRIRRIEGO MENORES   ', '2020-12-16 19:34:02', '2020-12-16 19:34:02'),
(390, 'MICRORRIEGO CA-MG  ', '2020-12-16 19:34:02', '2020-12-16 19:34:02'),
(391, 'MICROTHIOL 80 WG  ', '2020-12-16 19:34:02', '2020-12-16 19:34:02'),
(392, 'MIDAS WG  ', '2020-12-16 19:34:02', '2020-12-16 19:34:02'),
(393, 'MILBEKNOCK 1 EC  ', '2020-12-16 19:34:02', '2020-12-16 19:34:02'),
(394, 'MILDEX WG  ', '2020-12-16 19:34:02', '2020-12-16 19:34:02'),
(395, 'MIMIC 2 F  ', '2020-12-16 19:34:02', '2020-12-16 19:34:02'),
(396, 'MIRAGE 45 EC  ', '2020-12-16 19:34:02', '2020-12-16 19:34:02'),
(397, 'MITAC 20 EC  ', '2020-12-16 19:34:02', '2020-12-16 19:34:02'),
(398, 'MITECLEAN 10 SX  ', '2020-12-16 19:34:03', '2020-12-16 19:34:03'),
(399, 'MOLTO EC (NA)  ', '2020-12-16 19:34:03', '2020-12-16 19:34:03'),
(400, 'MONCEREN E WS 70  ', '2020-12-16 19:34:03', '2020-12-16 19:34:03'),
(401, 'MONCEREN SC 250  ', '2020-12-16 19:34:03', '2020-12-16 19:34:03'),
(402, 'MONCEREN WP 25  ', '2020-12-16 19:34:03', '2020-12-16 19:34:03'),
(403, 'MONCUT 20 SC  ', '2020-12-16 19:34:03', '2020-12-16 19:34:03'),
(404, 'MONITOR PROFICOL  ', '2020-12-16 19:34:03', '2020-12-16 19:34:03'),
(405, 'MONOCRON SL  ', '2020-12-16 19:34:03', '2020-12-16 19:34:03'),
(406, 'MONOCROTOFOS 600 FEDEARROZ  ', '2020-12-16 19:34:03', '2020-12-16 19:34:03'),
(407, 'MONOCROTOFOS PROFICOL 600 SL  ', '2020-12-16 19:34:03', '2020-12-16 19:34:03'),
(408, 'MURALLA EC 100  ', '2020-12-16 19:34:03', '2020-12-16 19:34:03'),
(409, 'NADIR 600 SL  ', '2020-12-16 19:34:03', '2020-12-16 19:34:03'),
(410, 'NERISECT  ', '2020-12-16 19:34:03', '2020-12-16 19:34:03'),
(411, 'NIFEREX 48 EC  ', '2020-12-16 19:34:03', '2020-12-16 19:34:03'),
(412, 'NINJA ®  EC  ', '2020-12-16 19:34:03', '2020-12-16 19:34:03'),
(413, 'NISSORUM EC  ', '2020-12-16 19:34:03', '2020-12-16 19:34:03'),
(414, 'NOBLETE 75 WP  ', '2020-12-16 19:34:03', '2020-12-16 19:34:03'),
(415, 'NUDRIN 216 SL  ', '2020-12-16 19:34:03', '2020-12-16 19:34:03'),
(416, 'NUFOS 4 EC  ', '2020-12-16 19:34:03', '2020-12-16 19:34:03'),
(417, 'NURELLE 250 EC  ', '2020-12-16 19:34:03', '2020-12-16 19:34:03'),
(418, 'NUVACRON 40 SL  ', '2020-12-16 19:34:03', '2020-12-16 19:34:03'),
(419, 'OCTAVE 50 WP  ', '2020-12-16 19:34:03', '2020-12-16 19:34:03'),
(420, 'OMITE 6 EC  ', '2020-12-16 19:34:04', '2020-12-16 19:34:04'),
(421, 'OPUS 7.5 EC  ', '2020-12-16 19:34:04', '2020-12-16 19:34:04'),
(422, 'ORNAMITE 30% CR  ', '2020-12-16 19:34:04', '2020-12-16 19:34:04'),
(423, 'ORTHENE 75% SP  ', '2020-12-16 19:34:04', '2020-12-16 19:34:04'),
(424, 'ORTHOCIDE 50% PROFICOL  ', '2020-12-16 19:34:04', '2020-12-16 19:34:04'),
(425, 'OXICLOR *35WP  ', '2020-12-16 19:34:04', '2020-12-16 19:34:04'),
(426, 'OXICLOR 50 WP  ', '2020-12-16 19:34:04', '2020-12-16 19:34:04'),
(427, 'OXICLORURO DE COBRE 35% DISMO  ', '2020-12-16 19:34:04', '2020-12-16 19:34:04'),
(428, 'OXICLORURO DE COBRE 58.8% WP  ', '2020-12-16 19:34:04', '2020-12-16 19:34:04'),
(429, 'OXICLORURO DE COBRE 58.8% PERTIQUIM  ', '2020-12-16 19:34:04', '2020-12-16 19:34:04'),
(430, 'OXICLORURO DE COBRE 58.8% WP VITAGRO  ', '2020-12-16 19:34:04', '2020-12-16 19:34:04'),
(431, 'OXICLORURO DE COBRE 84% PROFIC  ', '2020-12-16 19:34:04', '2020-12-16 19:34:04'),
(432, 'OXICLORURO DE COBRE OLIAGRO 58.8%  ', '2020-12-16 19:34:04', '2020-12-16 19:34:04'),
(433, 'OXICLORURO LIMOR  ', '2020-12-16 19:34:04', '2020-12-16 19:34:04'),
(434, 'OXICOB WP  ', '2020-12-16 19:34:04', '2020-12-16 19:34:04'),
(435, 'OXICRON 58.8 WP  ', '2020-12-16 19:34:04', '2020-12-16 19:34:04'),
(436, 'PADAN 50 SP  ', '2020-12-16 19:34:04', '2020-12-16 19:34:04'),
(437, 'PARATION METILICO 48% EC  ', '2020-12-16 19:34:04', '2020-12-16 19:34:04'),
(438, 'PENNCAP-M  ', '2020-12-16 19:34:04', '2020-12-16 19:34:04'),
(439, 'PERFEKTION  ', '2020-12-16 19:34:04', '2020-12-16 19:34:04'),
(440, 'PEROPAL WP 25  ', '2020-12-16 19:34:05', '2020-12-16 19:34:05'),
(441, 'PHOSTOXIN  ', '2020-12-16 19:34:05', '2020-12-16 19:34:05'),
(442, 'PILARMATE EC  ', '2020-12-16 19:34:05', '2020-12-16 19:34:05'),
(443, 'PIPRON SL  ', '2020-12-16 19:34:05', '2020-12-16 19:34:05'),
(444, 'PIRESTAR 38 EC  ', '2020-12-16 19:34:05', '2020-12-16 19:34:05'),
(445, 'PIRIFOS 48 EC  ', '2020-12-16 19:34:05', '2020-12-16 19:34:05'),
(446, 'PIRIMOR WG  ', '2020-12-16 19:34:05', '2020-12-16 19:34:05'),
(447, 'PLANTVAX 5% GR  ', '2020-12-16 19:34:05', '2020-12-16 19:34:05'),
(448, 'PLANTVAX 75%  ', '2020-12-16 19:34:05', '2020-12-16 19:34:05'),
(449, 'POLO 250 SC  ', '2020-12-16 19:34:05', '2020-12-16 19:34:05'),
(450, 'POLYRAM DF  ', '2020-12-16 19:34:05', '2020-12-16 19:34:05'),
(451, 'POLYTHION SC  ', '2020-12-16 19:34:05', '2020-12-16 19:34:05'),
(452, 'POLYTRIN 200 EC  ', '2020-12-16 19:34:05', '2020-12-16 19:34:05'),
(453, 'POSITRON WP 69  ', '2020-12-16 19:34:05', '2020-12-16 19:34:05'),
(454, 'PREVICUR N SL  ', '2020-12-16 19:34:05', '2020-12-16 19:34:05'),
(455, 'PRO-GRO  ', '2020-12-16 19:34:05', '2020-12-16 19:34:05'),
(456, 'PRODION 500 SC  ', '2020-12-16 19:34:05', '2020-12-16 19:34:05'),
(457, 'PROFITOX 80 SP  ', '2020-12-16 19:34:05', '2020-12-16 19:34:05'),
(458, 'PROFIZEB 80% WP  ', '2020-12-16 19:34:05', '2020-12-16 19:34:05'),
(459, 'PROHORTICOLA  ', '2020-12-16 19:34:05', '2020-12-16 19:34:05'),
(460, 'PROPARGITE  ', '2020-12-16 19:34:05', '2020-12-16 19:34:05'),
(461, 'PROPICONAZOLE AGROGEN 250 EC  ', '2020-12-16 19:34:05', '2020-12-16 19:34:05'),
(462, 'PROPIZOLE 250 CE  ', '2020-12-16 19:34:05', '2020-12-16 19:34:05'),
(463, 'PROTOFOS 600  ', '2020-12-16 19:34:05', '2020-12-16 19:34:05'),
(464, 'PROVADO OCMBI SC 112.5  ', '2020-12-16 19:34:06', '2020-12-16 19:34:06'),
(465, 'PUGIL 75 WG  ', '2020-12-16 19:34:06', '2020-12-16 19:34:06'),
(466, 'PULSAR 20 EC  ', '2020-12-16 19:34:06', '2020-12-16 19:34:06'),
(467, 'PULSOR 2 SC  ', '2020-12-16 19:34:06', '2020-12-16 19:34:06'),
(468, 'PUNCH 40 EC  ', '2020-12-16 19:34:06', '2020-12-16 19:34:06'),
(469, 'PUNTO WP 50.3  ', '2020-12-16 19:34:06', '2020-12-16 19:34:06'),
(470, 'PYRICRON EC  ', '2020-12-16 19:34:06', '2020-12-16 19:34:06'),
(471, 'PYRICROP 48 EC  ', '2020-12-16 19:34:06', '2020-12-16 19:34:06'),
(472, 'PYRINEX EC  ', '2020-12-16 19:34:06', '2020-12-16 19:34:06'),
(474, 'QUATIM  ', '2020-12-16 19:35:05', '2020-12-16 19:35:05'),
(475, 'RP METHIL 48 EC  ', '2020-12-16 19:35:05', '2020-12-16 19:35:05'),
(476, 'RABCIDE 20 EC  ', '2020-12-16 19:35:05', '2020-12-16 19:35:05'),
(477, 'RAFAGA® 4 EC   ', '2020-12-16 19:35:05', '2020-12-16 19:35:05'),
(478, 'RALLY 40 WP  ', '2020-12-16 19:35:05', '2020-12-16 19:35:05'),
(479, 'RAMBLER   ', '2020-12-16 19:35:05', '2020-12-16 19:35:05'),
(480, 'REGENT SC  ', '2020-12-16 19:35:05', '2020-12-16 19:35:05'),
(481, 'REGNUM EC  ', '2020-12-16 19:35:05', '2020-12-16 19:35:05'),
(482, 'RELAMPAGO 550 EC  ', '2020-12-16 19:35:05', '2020-12-16 19:35:05'),
(483, 'RESCATE 200 SP  ', '2020-12-16 19:35:05', '2020-12-16 19:35:05'),
(484, 'RHODAX 70 WP  ', '2020-12-16 19:35:05', '2020-12-16 19:35:05'),
(487, 'RHODAX WP  ', '2020-12-16 19:36:17', '2020-12-16 19:36:17'),
(488, 'RHYZOLENC SC  ', '2020-12-16 19:36:17', '2020-12-16 19:36:17'),
(489, 'RIDODUR 40 SC  ', '2020-12-16 19:36:17', '2020-12-16 19:36:17'),
(490, 'RIDODUR 80 WP  ', '2020-12-16 19:36:17', '2020-12-16 19:36:17'),
(491, 'RIDOMIL GOLD MZ 68 WP  ', '2020-12-16 19:36:17', '2020-12-16 19:36:17'),
(492, 'RIDONATE 500 SC  ', '2020-12-16 19:36:17', '2020-12-16 19:36:17'),
(493, 'RIDONATE 720 SC  ', '2020-12-16 19:36:17', '2020-12-16 19:36:17'),
(494, 'RIMON 10 EC  ', '2020-12-16 19:36:17', '2020-12-16 19:36:17'),
(495, 'RIPCORD 20 EC  ', '2020-12-16 19:36:17', '2020-12-16 19:36:17'),
(496, 'RIZOLEX 75 WP  ', '2020-12-16 19:36:17', '2020-12-16 19:36:17'),
(497, 'ROBENDAZIM 50 WP  ', '2020-12-16 19:36:18', '2020-12-16 19:36:18'),
(498, 'ROBENDAZIM 500 SC  ', '2020-12-16 19:36:18', '2020-12-16 19:36:18'),
(499, 'RODAZIM 50 WP  ', '2020-12-16 19:36:18', '2020-12-16 19:36:18'),
(500, 'RODAZIM 500 SC  ', '2020-12-16 19:36:18', '2020-12-16 19:36:18'),
(501, 'RODAZIM SC  ', '2020-12-16 19:36:18', '2020-12-16 19:36:18'),
(502, 'RODAZIM WP  ', '2020-12-16 19:36:18', '2020-12-16 19:36:18'),
(503, 'ROMECTIN 1.8 EC  ', '2020-12-16 19:36:18', '2020-12-16 19:36:18'),
(504, 'ROMITE 1.8 EC  ', '2020-12-16 19:36:18', '2020-12-16 19:36:18'),
(505, 'RONECRON 600 SL  ', '2020-12-16 19:36:18', '2020-12-16 19:36:18'),
(506, 'ROVRAL 50 WP  ', '2020-12-16 19:36:18', '2020-12-16 19:36:18'),
(507, 'ROVRAL FLO  ', '2020-12-16 19:36:18', '2020-12-16 19:36:18'),
(508, 'ROXION 40 EC  ', '2020-12-16 19:36:18', '2020-12-16 19:36:18'),
(509, 'RUBIGAN B EC  ', '2020-12-16 19:36:18', '2020-12-16 19:36:18'),
(510, 'RUBIGAN 12 EC  ', '2020-12-16 19:36:18', '2020-12-16 19:36:18'),
(511, 'RUFAST AVANCE  ', '2020-12-16 19:36:18', '2020-12-16 19:36:18'),
(512, 'SAAT POLKA 500 SC  ', '2020-12-16 19:36:18', '2020-12-16 19:36:18'),
(513, 'SABITHANE  ', '2020-12-16 19:36:18', '2020-12-16 19:36:18'),
(514, 'SANDOFAN M PROFICOL WP  ', '2020-12-16 19:36:18', '2020-12-16 19:36:18'),
(515, 'SANDOFAN M WP  ', '2020-12-16 19:36:18', '2020-12-16 19:36:18'),
(516, 'SANMITE EC  ', '2020-12-16 19:36:18', '2020-12-16 19:36:18'),
(517, 'SAPROL DC  ', '2020-12-16 19:36:18', '2020-12-16 19:36:18'),
(518, 'SCALA 40 SC  ', '2020-12-16 19:36:18', '2020-12-16 19:36:18'),
(519, 'SCORE 250 EC  ', '2020-12-16 19:36:19', '2020-12-16 19:36:19'),
(520, 'SEVIN 80 WP  ', '2020-12-16 19:36:19', '2020-12-16 19:36:19'),
(521, 'SHERPA 25 EC  ', '2020-12-16 19:36:19', '2020-12-16 19:36:19'),
(522, 'SIALEX 50 SC  ', '2020-12-16 19:36:19', '2020-12-16 19:36:19'),
(523, 'SICO 250 EC  ', '2020-12-16 19:36:19', '2020-12-16 19:36:19'),
(524, 'SIGANEX 60 SC  ', '2020-12-16 19:36:19', '2020-12-16 19:36:19'),
(525, 'SILVACUR COMBI EC 300  ', '2020-12-16 19:36:19', '2020-12-16 19:36:19'),
(526, 'SISCROP 40 EC  ', '2020-12-16 19:36:19', '2020-12-16 19:36:19'),
(527, 'SISTEMIN 40 EC  ', '2020-12-16 19:36:19', '2020-12-16 19:36:19'),
(528, 'SISTOATO 40 EC  ', '2020-12-16 19:36:19', '2020-12-16 19:36:19'),
(529, 'SPIGAR SE  ', '2020-12-16 19:36:19', '2020-12-16 19:36:19'),
(530, 'SPLENDOUR 25 EC  ', '2020-12-16 19:36:19', '2020-12-16 19:36:19'),
(531, 'SPOCK 18 EW  ', '2020-12-16 19:36:19', '2020-12-16 19:36:19'),
(532, 'SPORTAK 45 EC  ', '2020-12-16 19:36:19', '2020-12-16 19:36:19'),
(533, 'STOPPER 200 SC  ', '2020-12-16 19:36:19', '2020-12-16 19:36:19'),
(534, 'STRATEGO 250 DC  ', '2020-12-16 19:36:19', '2020-12-16 19:36:19'),
(535, 'STRIKE 250 EC  ', '2020-12-16 19:36:19', '2020-12-16 19:36:19'),
(536, 'STROBY * SC  ', '2020-12-16 19:36:19', '2020-12-16 19:36:19'),
(537, 'STROBY WG  ', '2020-12-16 19:36:19', '2020-12-16 19:36:19'),
(538, 'SUFFA 720 SC  ', '2020-12-16 19:36:19', '2020-12-16 19:36:19'),
(539, 'SULFAPLANT 720  ', '2020-12-16 19:36:19', '2020-12-16 19:36:19'),
(540, 'SUMI 8 WP  ', '2020-12-16 19:36:19', '2020-12-16 19:36:19'),
(541, 'SUMI-8 25 WP  ', '2020-12-16 19:36:19', '2020-12-16 19:36:19'),
(542, 'SUMILEX 50 WP  ', '2020-12-16 19:36:20', '2020-12-16 19:36:20'),
(543, 'SUMITHION 40 WP  ', '2020-12-16 19:36:20', '2020-12-16 19:36:20'),
(544, 'SUNFIRE 24 SC  ', '2020-12-16 19:36:20', '2020-12-16 19:36:20'),
(545, 'SUPERCON MTD 600 SL  ', '2020-12-16 19:36:20', '2020-12-16 19:36:20'),
(546, 'SWITCH 62.5 WG  ', '2020-12-16 19:36:20', '2020-12-16 19:36:20'),
(547, 'TAIREL WP  ', '2020-12-16 19:36:20', '2020-12-16 19:36:20'),
(548, 'TAMARON SL 400  ', '2020-12-16 19:36:20', '2020-12-16 19:36:20'),
(549, 'TASPA 500 EC  ', '2020-12-16 19:36:20', '2020-12-16 19:36:20'),
(550, 'TATTO M  ', '2020-12-16 19:36:20', '2020-12-16 19:36:20'),
(551, 'TECNOMYL 50 WP  ', '2020-12-16 19:36:20', '2020-12-16 19:36:20'),
(552, 'TEDION V-18 EC  ', '2020-12-16 19:36:20', '2020-12-16 19:36:20'),
(553, 'TEGA 075 EC  ', '2020-12-16 19:36:20', '2020-12-16 19:36:20'),
(554, 'TEISCO 720 SC  ', '2020-12-16 19:36:20', '2020-12-16 19:36:20'),
(555, 'TELDOR COMBI SC 416.7  ', '2020-12-16 19:36:20', '2020-12-16 19:36:20'),
(556, 'TELDOR SC 500  ', '2020-12-16 19:36:20', '2020-12-16 19:36:20'),
(557, 'THOREX 480 SC  ', '2020-12-16 19:36:20', '2020-12-16 19:36:20'),
(558, 'THRUDER 48% SC  ', '2020-12-16 19:36:20', '2020-12-16 19:36:20'),
(559, 'THRUDER WP  ', '2020-12-16 19:36:20', '2020-12-16 19:36:20'),
(560, 'TIFON 50 WP  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(561, 'TILT 250 EC  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(562, 'TIMSEN  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(563, 'TIRO M-8WP  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(564, 'TITAN 430 SC  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(565, 'TITAN 80 WP  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(566, 'TOP-COP  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(567, 'TOP-SUL SC  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(568, 'TOPAS 100 EC  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(569, 'TOPSIN M70 WP  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(570, 'TOPSIN M-50 SC  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(571, 'TORQUE 500 SC  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(572, 'TRACER 120 SC  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(573, 'TRAPPER EC  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(574, 'TREBON 10 EC  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(575, 'TRIFMINE 15 EC  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(576, 'TRIGARD 75 WP  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(577, 'TRIMATON 51  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(578, 'TRIMILTOX  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(579, 'TRIZEB 80 WP  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(580, 'TRUENO 100 EC  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(581, 'UNDAZIM 500 SC  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(582, 'VALIDACIN SL  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(583, 'VAPONA 24 EC  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(584, 'VERTIMEC 1.8%EC  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(585, 'VEXTER 4 EC  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(586, 'VEXTER 550 EC  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(587, 'VISADO 75WP  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(588, 'VISADO AGROSER  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(589, 'VITAVAX  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(590, 'VITIGRAN 3 SC  ', '2020-12-16 19:36:21', '2020-12-16 19:36:21'),
(591, 'VITIGRAN 35% WP  ', '2020-12-16 19:36:22', '2020-12-16 19:36:22'),
(592, 'VITIGRAN 50% WP  ', '2020-12-16 19:36:22', '2020-12-16 19:36:22'),
(593, 'VOLLEY 88 OL  ', '2020-12-16 19:36:22', '2020-12-16 19:36:22'),
(594, 'VONDOZEB 42 SC  ', '2020-12-16 19:36:22', '2020-12-16 19:36:22'),
(595, 'VONDOZEB 75 DG  ', '2020-12-16 19:36:22', '2020-12-16 19:36:22'),
(596, 'VONDOZEB 80 WP   ', '2020-12-16 19:36:22', '2020-12-16 19:36:22'),
(597, 'VULCANO 420 EC  ', '2020-12-16 19:36:22', '2020-12-16 19:36:22'),
(598, 'W12 EC  ', '2020-12-16 19:36:22', '2020-12-16 19:36:22'),
(599, 'ZIRAM 76 WG BARPEN  ', '2020-12-16 19:36:22', '2020-12-16 19:36:22'),
(600, 'ZOLONE 35 EC  ', '2020-12-16 19:36:22', '2020-12-16 19:36:22'),
(601, 'PP', '2021-01-21 12:04:34', '2021-01-21 12:04:34');

-- --------------------------------------------------------

--
-- Table structure for table `renovacionconceptos`
--

CREATE TABLE `renovacionconceptos` (
  `id` int(10) UNSIGNED NOT NULL,
  `adecuacionrenovacion_id` int(10) UNSIGNED NOT NULL,
  `conceptoGasto_id` int(10) UNSIGNED NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otro` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valorTotal` decimal(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `renovacionconceptos`
--

INSERT INTO `renovacionconceptos` (`id`, `adecuacionrenovacion_id`, `conceptoGasto_id`, `descripcion`, `otro`, `valorTotal`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'probando', 'prueba', '231904.00', '2021-11-29 19:52:53', '2021-11-29 19:52:53');

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
(1, 'TACUEYO', '2020-12-07 22:04:37', '2020-12-07 22:04:37'),
(2, 'TORIBIO', '2020-12-07 22:04:37', '2020-12-07 22:04:37'),
(3, 'SAN FRANCISCO', '2020-12-07 22:04:37', '2020-12-07 22:04:37');

-- --------------------------------------------------------

--
-- Table structure for table `riegos`
--

CREATE TABLE `riegos` (
  `id` int(10) UNSIGNED NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `finca_id` int(10) UNSIGNED NOT NULL,
  `riego` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adquisicion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frecuencia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiempo` int(11) DEFAULT NULL,
  `jornales` int(11) DEFAULT NULL,
  `reservorio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capacidadR` int(11) DEFAULT NULL,
  `alturaR` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `riegos`
--

INSERT INTO `riegos` (`id`, `productor_id`, `finca_id`, `riego`, `adquisicion`, `frecuencia`, `tipo`, `tiempo`, `jornales`, `reservorio`, `capacidadR`, `alturaR`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'Si', 'Inversion propia', '3', 'Aspersion', 45, 2, NULL, NULL, NULL, '2020-12-27 03:12:23', '2020-12-27 03:12:23'),
(2, 5, 1, 'Si', 'Inversion propia', '5', 'Aspersion', 200, 2, 'Si', 12, 54, '2021-03-04 14:44:43', '2021-03-04 14:44:43');

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
(4, 'Productor', 'Productores de asofrut', 1),
(5, 'Contador', 'Encargado de cambiar estados de venta', 1);

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
(1, 'Masculino', '2020-12-07 22:04:31', '2020-12-07 22:04:31'),
(2, 'Femenino', '2020-12-07 22:04:31', '2020-12-07 22:04:31');

-- --------------------------------------------------------

--
-- Table structure for table `suelos`
--

CREATE TABLE `suelos` (
  `id` int(10) UNSIGNED NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `finca_id` int(10) UNSIGNED NOT NULL,
  `curvasNivel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controlArvenses` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frecuencia` int(11) DEFAULT NULL,
  `herbicida` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dosisAplicacionCal` decimal(11,2) DEFAULT NULL,
  `frecuenciaHerbicida` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suelos`
--

INSERT INTO `suelos` (`id`, `productor_id`, `finca_id`, `curvasNivel`, `controlArvenses`, `frecuencia`, `herbicida`, `dosisAplicacionCal`, `frecuenciaHerbicida`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'Si', 'Manual', 5, 'herbivoro', '2.00', 3, '2020-12-28 09:48:05', '2020-12-28 09:48:05'),
(2, 5, 1, 'Curvas en contorno', 'Manual', 3, 'dsada', '2.00', 2, '2021-03-04 04:13:19', '2021-03-04 04:13:19');

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
(1, 'Cedula de ciudadania', '2020-12-07 22:04:31', '2020-12-07 22:04:31'),
(2, 'Tarjeta de identidad', '2020-12-07 22:04:31', '2020-12-07 22:04:31');

-- --------------------------------------------------------

--
-- Table structure for table `tutorados`
--

CREATE TABLE `tutorados` (
  `id` int(10) UNSIGNED NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `finca_id` int(10) UNSIGNED NOT NULL,
  `tutorado` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoTutorado` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoMadera` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tutorados`
--

INSERT INTO `tutorados` (`id`, `productor_id`, `finca_id`, `tutorado`, `tipoTutorado`, `tipoMadera`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'Si', 'Espaldera sencilla', 'Nativo', '2020-12-26 22:56:40', '2020-12-26 22:56:40'),
(2, 5, 1, NULL, NULL, NULL, '2020-12-27 03:08:07', '2020-12-27 03:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `unidad_aplicaciones`
--

CREATE TABLE `unidad_aplicaciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unidad_aplicaciones`
--

INSERT INTO `unidad_aplicaciones` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Bomba 20L', NULL, NULL),
(2, 'Caneca 200L', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `unidad_dosis`
--

CREATE TABLE `unidad_dosis` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unidad_dosis`
--

INSERT INTO `unidad_dosis` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Centimetros cubicos', '2020-12-16 19:36:22', '2020-12-16 19:36:22'),
(2, 'Gramos/litro', '2020-12-16 19:36:22', '2020-12-16 19:36:22');

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
(28, '000000000000000', '$2y$10$3XYHq5Pvd1CGLDNY2lvZOOaLW/T0o4WQmdW6I2mCY6KRKLr/LJxJu', 1, 4, NULL, NULL, NULL),
(2, 'admin@sistemas.com', '$2y$10$sugk64mZOHhSV63KYO8oveXEv1Uuvs9NOSAU0pwh6beuAWZUZBZDW', 1, 1, 'OwK9GRViuP99iw6rgWBoTHZ376G1ChX1xsPsn6EZNDvWscVZo0Sb8FcKaRBx', NULL, NULL),
(4, 'comercial@asofrut.org', '$2y$10$Hzb1GLR3KCUBWiCrwPsEd.0Atxw3rMpncKt2XA9x7q9D1VAfu87/y', 1, 2, 'Tfn1Zy0VcSLgKqRgI74tjSngLw0m0zTDBOzvSc47wUOiCOK2Q1pO4MsvpXQd', NULL, NULL),
(24, 'contador@asofrut.org', '$2y$10$PJXkHpLQSnlYZMWuB2sY2OyOWG0uWy.OWA5OPhH8K58r5DkJiGDh.', 1, 5, '8csyMU6r0i7G3MSYNSqC3I4Pysc5AO0XSvc8Fy8jpEWGzTTJCcFayV1kwkIK', NULL, NULL),
(23, 'ejemplo@gmail.com', '$2y$10$0tPxypQEziI/wDiQ/2w9vOHVFuarKdIaLAAmve9d9JCS5BIPnLBPi', 0, 4, NULL, NULL, NULL),
(3, 'extensionista@asofrut.org', '$2y$10$e3dSMtnV5uDqIkMqXn1GKOb8q34dRec/3tXLY7fE8VW4EHdQKic.C', 1, 3, '9389PWVwOpbNmABunObCUPm5xOwoAyN3mhuTzWxyueiXN7tyGnNqtj8V5Em3', NULL, NULL),
(1, 'jcarlosad7', '$2y$10$Yt1HHnF.zHONEx9ayMimCO0Tu9jUcielbsBFItHXTFL4kDSu4U.0i', 0, 1, 'juzgt12Z2gxHWSdZZ89SZ3P2HkwECzdnfH9lC0gSP9MPFrN8ScVpqMlkpgeU', NULL, NULL),
(22, 'juan@hotmail.com', '$2y$10$QcgJ5LFotbEf9ZmruZ0W5e6fawVQCMBwt88cmj2YtyFKxzGPeAOh2', 1, 4, 'lvDIED1py2h6kxjepBMKPBGUZAQXsoHeTXmqBxxcAzK6HwROnkFkTT9SFcmA', NULL, NULL),
(13, 'lola@gmail.com', '$2y$10$qu43tgSEwkSNTYxQ1bGAx.bM5wPj4mvJzNtVk2MS9gSI3GqxlwV2C', 1, 4, NULL, NULL, NULL),
(26, 'noaplica@asofrut.org', '$2y$10$hCj4RuMtd/kcy6YleWmEaOpgppYiI0Hyrx/zj0uOdidnFHTu/JkjS', 0, 4, NULL, NULL, NULL),
(6, 'pedro@gmail.com', '$2y$10$NvyQXLPUJMCx5/nmWBUSXOm3RTOdo5fQHXlCS7K44Mf1n/QxMDXCW', 1, 4, NULL, NULL, NULL),
(5, 'productor@asofrut.org', '$2y$10$AyYmNXtl7kPjGYyW9wnoGeftKD/JaNbO6rUuF8FFTLihTclZuTVF.', 1, 4, '4yPG2PMGKHX9oLFI9axbZT5MepFh4669SMi9Zi0dv621DxsTdCraUy5XuuSb', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ventas`
--

CREATE TABLE `ventas` (
  `id` int(10) UNSIGNED NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `linea_id` int(10) UNSIGNED NOT NULL,
  `fechaVenta` datetime NOT NULL,
  `lugarVenta_id` int(10) UNSIGNED NOT NULL,
  `totalVenta` decimal(11,2) NOT NULL,
  `totalKilos` decimal(11,2) NOT NULL,
  `totalDonacion` decimal(11,2) NOT NULL,
  `totalTransporte` decimal(11,2) NOT NULL,
  `totalAsohof` decimal(11,2) NOT NULL,
  `totalCuatroXmil` decimal(11,2) NOT NULL,
  `estado_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ventas`
--

INSERT INTO `ventas` (`id`, `productor_id`, `linea_id`, `fechaVenta`, `lugarVenta_id`, `totalVenta`, `totalKilos`, `totalDonacion`, `totalTransporte`, `totalAsohof`, `totalCuatroXmil`, `estado_id`, `created_at`, `updated_at`) VALUES
(1, 5, 1, '2020-12-08 00:00:00', 1, '300000.00', '10.00', '0.00', '0.00', '0.00', '0.00', 5, NULL, '2020-12-10 07:52:36'),
(15, 5, 1, '2020-12-09 00:00:00', 3, '181384.00', '95.00', '0.00', '0.00', '0.00', '0.00', 2, '2020-12-09 11:50:20', '2020-12-10 08:24:08'),
(16, 5, 1, '2020-12-09 00:00:00', 1, '37045.20', '21.00', '2520.00', '1848.00', '471.00', '188.40', 4, '2020-12-09 21:40:27', '2020-12-13 07:46:06'),
(17, 5, 1, '2020-12-09 00:00:00', 1, '103009.60', '58.00', '6960.00', '5104.00', '1308.00', '523.20', 2, '2020-12-09 21:47:49', '2020-12-22 17:02:12'),
(18, 5, 1, '2020-12-09 12:04:45', 1, '100428.00', '60.00', '7200.00', '5280.00', '1290.00', '516.00', 4, '2020-12-09 22:04:45', '2020-12-10 08:33:09'),
(19, 5, 1, '2020-12-09 22:41:34', 3, '43546.00', '25.00', '3000.00', '2200.00', '555.00', '222.00', 5, '2020-12-10 08:41:34', '2020-12-10 19:40:03'),
(20, 5, 1, '2020-12-09 22:46:58', 3, '35420.00', '20.00', '2400.00', '1760.00', '450.00', '180.00', 4, '2020-12-10 08:46:58', '2020-12-10 19:39:44'),
(21, 6, 1, '2020-12-10 09:41:06', 3, '272940.00', '150.00', '18000.00', '13200.00', '3450.00', '1380.00', 4, '2020-12-10 19:41:06', '2020-12-22 21:22:26'),
(22, 5, 1, '2020-12-10 09:41:45', 3, '53130.00', '30.00', '3600.00', '2640.00', '675.00', '270.00', 4, '2020-12-10 19:41:45', '2020-12-12 02:38:24'),
(23, 23, 1, '2020-12-11 16:35:32', 1, '243780.00', '150.00', '18000.00', '13200.00', '3150.00', '1260.00', 5, '2020-12-12 02:35:32', '2020-12-12 02:36:21'),
(24, 6, 1, '2020-12-11 16:51:45', 2, '301972.00', '169.00', '20280.00', '14872.00', '3830.00', '1532.00', 1, '2020-12-12 02:51:45', '2020-12-12 02:51:45'),
(25, 6, 1, '2020-12-13 23:51:38', 1, '61794.00', '30.00', '3600.00', '2640.00', '690.00', '276.00', 1, '2020-12-14 09:51:38', '2020-12-14 09:51:38'),
(26, 22, 1, '2020-12-14 11:05:13', 3, '205980.00', '100.00', '12000.00', '8800.00', '2300.00', '920.00', 3, '2020-12-14 21:05:13', '2021-01-18 20:23:43');

-- --------------------------------------------------------

--
-- Table structure for table `ventas_categorias`
--

CREATE TABLE `ventas_categorias` (
  `id` int(10) UNSIGNED NOT NULL,
  `ventas_id` int(10) UNSIGNED NOT NULL,
  `categoria_id` int(10) UNSIGNED NOT NULL,
  `peso` decimal(11,2) NOT NULL,
  `valorUnitario` decimal(11,2) NOT NULL,
  `subtotal` decimal(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ventas_categorias`
--

INSERT INTO `ventas_categorias` (`id`, `ventas_id`, `categoria_id`, `peso`, `valorUnitario`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 15, 1, '15.00', '2400.00', '0.00', '2020-12-09 11:50:20', '2020-12-09 11:50:20'),
(2, 15, 2, '80.00', '2100.00', '0.00', '2020-12-09 11:50:20', '2020-12-09 11:50:20'),
(3, 16, 1, '10.00', '2400.00', '24000.00', '2020-12-09 21:40:27', '2020-12-09 21:40:27'),
(4, 16, 2, '11.00', '2100.00', '23100.00', '2020-12-09 21:40:27', '2020-12-09 21:40:27'),
(5, 17, 1, '30.00', '2400.00', '72000.00', '2020-12-09 21:47:49', '2020-12-09 21:47:49'),
(6, 17, 2, '28.00', '2100.00', '58800.00', '2020-12-09 21:47:49', '2020-12-09 21:47:49'),
(7, 18, 1, '10.00', '2400.00', '24000.00', '2020-12-09 22:04:45', '2020-12-09 22:04:45'),
(8, 18, 2, '50.00', '2100.00', '105000.00', '2020-12-09 22:04:45', '2020-12-09 22:04:45'),
(9, 19, 1, '10.00', '2400.00', '24000.00', '2020-12-10 08:41:34', '2020-12-10 08:41:34'),
(10, 19, 2, '15.00', '2100.00', '31500.00', '2020-12-10 08:41:34', '2020-12-10 08:41:34'),
(11, 20, 1, '10.00', '2400.00', '24000.00', '2020-12-10 08:46:58', '2020-12-10 08:46:58'),
(12, 20, 2, '10.00', '2100.00', '21000.00', '2020-12-10 08:46:58', '2020-12-10 08:46:58'),
(13, 21, 1, '100.00', '2400.00', '240000.00', '2020-12-10 19:41:06', '2020-12-10 19:41:06'),
(14, 21, 2, '50.00', '2100.00', '105000.00', '2020-12-10 19:41:06', '2020-12-10 19:41:06'),
(15, 22, 1, '15.00', '2400.00', '36000.00', '2020-12-10 19:41:45', '2020-12-10 19:41:45'),
(16, 22, 2, '15.00', '2100.00', '31500.00', '2020-12-10 19:41:45', '2020-12-10 19:41:45'),
(17, 23, 1, '50.00', '2300.00', '115000.00', '2020-12-12 02:35:32', '2020-12-12 02:35:32'),
(18, 23, 2, '100.00', '2000.00', '200000.00', '2020-12-12 02:35:32', '2020-12-12 02:35:32'),
(19, 24, 1, '150.00', '2300.00', '345000.00', '2020-12-12 02:51:45', '2020-12-12 02:51:45'),
(20, 24, 2, '19.00', '2000.00', '38000.00', '2020-12-12 02:51:45', '2020-12-12 02:51:45'),
(21, 25, 1, '30.00', '2300.00', '69000.00', '2020-12-14 09:51:38', '2020-12-14 09:51:38'),
(22, 26, 1, '100.00', '2300.00', '230000.00', '2020-12-14 21:05:13', '2020-12-14 21:05:13');

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
(1, 'CULEBRERO', 1, '2020-12-07 22:04:36', '2020-12-07 22:04:36'),
(2, 'El FLAYO', 1, '2020-12-07 22:04:36', '2020-12-07 22:04:36'),
(3, 'GARGANTILLAS', 1, '2020-12-07 22:04:36', '2020-12-07 22:04:36'),
(4, 'HIMICUETO', 1, '2020-12-07 22:04:36', '2020-12-07 22:04:36'),
(5, 'HUTLA', 1, '2020-12-07 22:04:36', '2020-12-07 22:04:36'),
(6, 'LA CALERA', 1, '2020-12-07 22:04:37', '2020-12-07 22:04:37'),
(7, 'LA CAPILLA', 1, '2020-12-07 22:04:37', '2020-12-07 22:04:37'),
(8, 'LA ESTRELLA', 1, '2020-12-07 22:04:37', '2020-12-07 22:04:37'),
(9, 'LA JULIA', 1, '2020-12-07 22:04:37', '2020-12-07 22:04:37'),
(10, 'LA PALMA', 1, '2020-12-07 22:04:37', '2020-12-07 22:04:37'),
(11, 'LA PLAYA', 1, '2020-12-07 22:04:37', '2020-12-07 22:04:37'),
(12, 'LA PRIMICIA', 1, '2020-12-07 22:04:37', '2020-12-07 22:04:37'),
(13, 'LA SUSANA', 1, '2020-12-07 22:04:37', '2020-12-07 22:04:37'),
(14, 'LOPEZ', 1, '2020-12-07 22:04:37', '2020-12-07 22:04:37'),
(15, 'QUINAMAYO', 1, '2020-12-07 22:04:37', '2020-12-07 22:04:37'),
(16, 'SESTADERO', 1, '2020-12-07 22:04:37', '2020-12-07 22:04:37'),
(17, 'TACUEYO', 1, '2020-12-07 22:04:37', '2020-12-07 22:04:37'),
(18, 'TORIBIO', 1, '2020-12-07 22:04:37', '2020-12-07 22:04:37'),
(19, 'TRAPICHE', 1, '2020-12-07 22:04:37', '2020-12-07 22:04:37'),
(20, 'ULLUCOS', 1, '2020-12-07 22:04:37', '2020-12-07 22:04:37'),
(21, 'VICHIQUI', 1, '2020-12-07 22:04:37', '2020-12-07 22:04:37');

-- --------------------------------------------------------

--
-- Table structure for table `vocacions`
--

CREATE TABLE `vocacions` (
  `id` int(10) UNSIGNED NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `finca_id` int(10) UNSIGNED NOT NULL,
  `vocacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiempo` int(11) DEFAULT NULL,
  `practicaBasica` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capacitacionRefuerzo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temasRefuerzo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diasMora` int(11) DEFAULT NULL,
  `labores` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `motivo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vocacions`
--

INSERT INTO `vocacions` (`id`, `productor_id`, `finca_id`, `vocacion`, `tiempo`, `practicaBasica`, `capacitacionRefuerzo`, `temasRefuerzo`, `diasMora`, `labores`, `motivo`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'Cultivador', 3, 'Si', 'Si', 'Tecnologias Mora', 4, 'siembra', 'buena remuneracion', '2020-12-28 08:02:06', '2020-12-28 08:02:06'),
(2, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-28 09:46:42', '2020-12-28 09:46:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adecuacionrenovacions`
--
ALTER TABLE `adecuacionrenovacions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adecuacionrenovacions_productor_id_foreign` (`productor_id`),
  ADD KEY `adecuacionrenovacions_finca_id_foreign` (`finca_id`);

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
-- Indexes for table `categoriamoras`
--
ALTER TABLE `categoriamoras`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categoriamoras_nombre_unique` (`nombre`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comercializacionproductos`
--
ALTER TABLE `comercializacionproductos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comercializacionproductos_comercializacion_id_foreign` (`comercializacion_id`),
  ADD KEY `comercializacionproductos_productoscomers_id_foreign` (`productosComers_id`);

--
-- Indexes for table `comercializacions`
--
ALTER TABLE `comercializacions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comercializacions_productor_id_foreign` (`productor_id`);

--
-- Indexes for table `conceptogastos`
--
ALTER TABLE `conceptogastos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `conceptogastos_nombre_unique` (`nombre`);

--
-- Indexes for table `cosechas`
--
ALTER TABLE `cosechas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cosechas_productor_id_foreign` (`productor_id`),
  ADD KEY `cosechas_finca_id_foreign` (`finca_id`);

--
-- Indexes for table `cultivos`
--
ALTER TABLE `cultivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cultivos_productor_id_foreign` (`productor_id`),
  ADD KEY `cultivos_finca_id_foreign` (`finca_id`),
  ADD KEY `cultivos_cadena_id_foreign` (`cadena_id`),
  ADD KEY `cultivos_lugarventa_id_foreign` (`lugarVenta_id`);

--
-- Indexes for table `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departamentos_nombre_unique` (`nombre`);

--
-- Indexes for table `encuestaasofruts`
--
ALTER TABLE `encuestaasofruts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `encuestaasofruts_productor_id_foreign` (`productor_id`),
  ADD KEY `encuestaasofruts_finca_id_foreign` (`finca_id`);

--
-- Indexes for table `encuesta_fitosanitarias`
--
ALTER TABLE `encuesta_fitosanitarias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `encuesta_fitosanitarias_productor_id_foreign` (`productor_id`),
  ADD KEY `encuesta_fitosanitarias_finca_id_foreign` (`finca_id`),
  ADD KEY `encuesta_fitosanitarias_linea_id_foreign` (`linea_id`),
  ADD KEY `encuesta_fitosanitarias_producto_fitosanitario_id_foreign` (`producto_fitosanitario_id`),
  ADD KEY `encuesta_fitosanitarias_unidad_dosis_id_foreign` (`unidad_dosis_id`),
  ADD KEY `encuesta_fitosanitarias_unidad_aplicaciones_id_foreign` (`unidad_aplicaciones_id`),
  ADD KEY `encuesta_fitosanitarias_equipo_aplicaciones_id_foreign` (`equipo_aplicaciones_id`),
  ADD KEY `encuesta_fitosanitarias_metodo_aplicaciones_id_foreign` (`metodo_aplicaciones_id`);

--
-- Indexes for table `enfermedads`
--
ALTER TABLE `enfermedads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enfermedads_productor_id_foreign` (`productor_id`),
  ADD KEY `enfermedads_finca_id_foreign` (`finca_id`);

--
-- Indexes for table `equipo_aplicaciones`
--
ALTER TABLE `equipo_aplicaciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `equipo_aplicaciones_nombre_unique` (`nombre`);

--
-- Indexes for table `establecimientoconceptos`
--
ALTER TABLE `establecimientoconceptos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `establecimientoconceptos_gastosestablecimiento_id_foreign` (`gastosEstablecimiento_id`),
  ADD KEY `establecimientoconceptos_conceptogasto_id_foreign` (`conceptoGasto_id`);

--
-- Indexes for table `estadoventas`
--
ALTER TABLE `estadoventas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `etnias`
--
ALTER TABLE `etnias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `etnias_nombre_unique` (`nombre`);

--
-- Indexes for table `fincas`
--
ALTER TABLE `fincas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fincas_productor_id_foreign` (`productor_id`),
  ADD KEY `fincas_linea_id_foreign` (`linea_id`),
  ADD KEY `fincas_departamento_id_foreign` (`departamento_id`),
  ADD KEY `fincas_municipio_id_foreign` (`municipio_id`),
  ADD KEY `fincas_vereda_id_foreign` (`vereda_id`),
  ADD KEY `fincas_resguardo_id_foreign` (`resguardo_id`),
  ADD KEY `fincas_posesion_id_foreign` (`posesion_id`);

--
-- Indexes for table `gastosestablecimientos`
--
ALTER TABLE `gastosestablecimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gastosestablecimientos_productor_id_foreign` (`productor_id`),
  ADD KEY `gastosestablecimientos_finca_id_foreign` (`finca_id`);

--
-- Indexes for table `gastosproduccions`
--
ALTER TABLE `gastosproduccions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gastosproduccions_productor_id_foreign` (`productor_id`),
  ADD KEY `gastosproduccions_finca_id_foreign` (`finca_id`);

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
-- Indexes for table `metodo_aplicaciones`
--
ALTER TABLE `metodo_aplicaciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `metodo_aplicaciones_nombre_unique` (`nombre`);

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
-- Indexes for table `nutricions`
--
ALTER TABLE `nutricions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nutricions_productor_id_foreign` (`productor_id`),
  ADD KEY `nutricions_finca_id_foreign` (`finca_id`);

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
-- Indexes for table `plagas`
--
ALTER TABLE `plagas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plagas_productor_id_foreign` (`productor_id`),
  ADD KEY `plagas_finca_id_foreign` (`finca_id`);

--
-- Indexes for table `podas`
--
ALTER TABLE `podas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `podas_productor_id_foreign` (`productor_id`),
  ADD KEY `podas_finca_id_foreign` (`finca_id`);

--
-- Indexes for table `posesions`
--
ALTER TABLE `posesions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posesions_nombre_unique` (`nombre`);

--
-- Indexes for table `practicas`
--
ALTER TABLE `practicas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `practicas_productor_id_foreign` (`productor_id`),
  ADD KEY `practicas_finca_id_foreign` (`finca_id`);

--
-- Indexes for table `prediocultivos`
--
ALTER TABLE `prediocultivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prediocultivos_productor_id_foreign` (`productor_id`),
  ADD KEY `prediocultivos_finca_id_foreign` (`finca_id`),
  ADD KEY `prediocultivos_vereda_id_foreign` (`vereda_id`);

--
-- Indexes for table `produccionconceptos`
--
ALTER TABLE `produccionconceptos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produccionconceptos_gastosproduccion_id_foreign` (`gastosproduccion_id`),
  ADD KEY `produccionconceptos_conceptogasto_id_foreign` (`conceptoGasto_id`);

--
-- Indexes for table `productors`
--
ALTER TABLE `productors`
  ADD KEY `productors_id_foreign` (`id`),
  ADD KEY `productors_sexo_id_foreign` (`sexo_id`),
  ADD KEY `productors_etnia_id_foreign` (`etnia_id`),
  ADD KEY `productors_escolaridad_id_foreign` (`escolaridad_id`),
  ADD KEY `productors_departamento_id_foreign` (`departamento_id`),
  ADD KEY `productors_municipio_id_foreign` (`municipio_id`),
  ADD KEY `productors_vereda_id_foreign` (`vereda_id`),
  ADD KEY `productors_resguardo_id_foreign` (`resguardo_id`);

--
-- Indexes for table `productoscomers`
--
ALTER TABLE `productoscomers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `productoscomers_nombre_unique` (`nombre`);

--
-- Indexes for table `producto_fitosanitarios`
--
ALTER TABLE `producto_fitosanitarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `producto_fitosanitarios_nombre_unique` (`nombre`);

--
-- Indexes for table `renovacionconceptos`
--
ALTER TABLE `renovacionconceptos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `renovacionconceptos_adecuacionrenovacion_id_foreign` (`adecuacionrenovacion_id`),
  ADD KEY `renovacionconceptos_conceptogasto_id_foreign` (`conceptoGasto_id`);

--
-- Indexes for table `resguardos`
--
ALTER TABLE `resguardos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `resguardos_nombre_unique` (`nombre`);

--
-- Indexes for table `riegos`
--
ALTER TABLE `riegos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `riegos_productor_id_foreign` (`productor_id`),
  ADD KEY `riegos_finca_id_foreign` (`finca_id`);

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
-- Indexes for table `suelos`
--
ALTER TABLE `suelos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suelos_productor_id_foreign` (`productor_id`),
  ADD KEY `suelos_finca_id_foreign` (`finca_id`);

--
-- Indexes for table `tipoids`
--
ALTER TABLE `tipoids`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tipoids_nombre_unique` (`nombre`);

--
-- Indexes for table `tutorados`
--
ALTER TABLE `tutorados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tutorados_productor_id_foreign` (`productor_id`),
  ADD KEY `tutorados_finca_id_foreign` (`finca_id`);

--
-- Indexes for table `unidad_aplicaciones`
--
ALTER TABLE `unidad_aplicaciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unidad_aplicaciones_nombre_unique` (`nombre`);

--
-- Indexes for table `unidad_dosis`
--
ALTER TABLE `unidad_dosis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unidad_dosis_nombre_unique` (`nombre`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `users_usuario_unique` (`usuario`),
  ADD KEY `users_id_foreign` (`id`),
  ADD KEY `users_idrol_foreign` (`idrol`);

--
-- Indexes for table `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ventas_productor_id_foreign` (`productor_id`),
  ADD KEY `ventas_linea_id_foreign` (`linea_id`),
  ADD KEY `ventas_lugarventa_id_foreign` (`lugarVenta_id`),
  ADD KEY `ventas_estado_id_foreign` (`estado_id`);

--
-- Indexes for table `ventas_categorias`
--
ALTER TABLE `ventas_categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ventas_categorias_ventas_id_foreign` (`ventas_id`),
  ADD KEY `ventas_categorias_categoria_id_foreign` (`categoria_id`);

--
-- Indexes for table `veredas`
--
ALTER TABLE `veredas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `veredas_nombre_unique` (`nombre`),
  ADD KEY `veredas_municipio_id_foreign` (`municipio_id`);

--
-- Indexes for table `vocacions`
--
ALTER TABLE `vocacions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vocacions_productor_id_foreign` (`productor_id`),
  ADD KEY `vocacions_finca_id_foreign` (`finca_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adecuacionrenovacions`
--
ALTER TABLE `adecuacionrenovacions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cadenas`
--
ALTER TABLE `cadenas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categoriamoras`
--
ALTER TABLE `categoriamoras`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comercializacionproductos`
--
ALTER TABLE `comercializacionproductos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comercializacions`
--
ALTER TABLE `comercializacions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `conceptogastos`
--
ALTER TABLE `conceptogastos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cosechas`
--
ALTER TABLE `cosechas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cultivos`
--
ALTER TABLE `cultivos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `encuestaasofruts`
--
ALTER TABLE `encuestaasofruts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `encuesta_fitosanitarias`
--
ALTER TABLE `encuesta_fitosanitarias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enfermedads`
--
ALTER TABLE `enfermedads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `equipo_aplicaciones`
--
ALTER TABLE `equipo_aplicaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `establecimientoconceptos`
--
ALTER TABLE `establecimientoconceptos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `estadoventas`
--
ALTER TABLE `estadoventas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `etnias`
--
ALTER TABLE `etnias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fincas`
--
ALTER TABLE `fincas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gastosestablecimientos`
--
ALTER TABLE `gastosestablecimientos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gastosproduccions`
--
ALTER TABLE `gastosproduccions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gpxs`
--
ALTER TABLE `gpxs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gpxzones`
--
ALTER TABLE `gpxzones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `gradoescolaridads`
--
ALTER TABLE `gradoescolaridads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `lineas`
--
ALTER TABLE `lineas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lugarventas`
--
ALTER TABLE `lugarventas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `metodo_aplicaciones`
--
ALTER TABLE `metodo_aplicaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `nutricions`
--
ALTER TABLE `nutricions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `plagas`
--
ALTER TABLE `plagas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `podas`
--
ALTER TABLE `podas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posesions`
--
ALTER TABLE `posesions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `practicas`
--
ALTER TABLE `practicas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prediocultivos`
--
ALTER TABLE `prediocultivos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produccionconceptos`
--
ALTER TABLE `produccionconceptos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `productoscomers`
--
ALTER TABLE `productoscomers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `producto_fitosanitarios`
--
ALTER TABLE `producto_fitosanitarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=602;

--
-- AUTO_INCREMENT for table `renovacionconceptos`
--
ALTER TABLE `renovacionconceptos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `resguardos`
--
ALTER TABLE `resguardos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `riegos`
--
ALTER TABLE `riegos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sexos`
--
ALTER TABLE `sexos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suelos`
--
ALTER TABLE `suelos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tipoids`
--
ALTER TABLE `tipoids`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tutorados`
--
ALTER TABLE `tutorados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `unidad_aplicaciones`
--
ALTER TABLE `unidad_aplicaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `unidad_dosis`
--
ALTER TABLE `unidad_dosis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `ventas_categorias`
--
ALTER TABLE `ventas_categorias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `veredas`
--
ALTER TABLE `veredas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `vocacions`
--
ALTER TABLE `vocacions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adecuacionrenovacions`
--
ALTER TABLE `adecuacionrenovacions`
  ADD CONSTRAINT `adecuacionrenovacions_finca_id_foreign` FOREIGN KEY (`finca_id`) REFERENCES `fincas` (`id`),
  ADD CONSTRAINT `adecuacionrenovacions_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`);

--
-- Constraints for table `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `articulos_idcategoria_foreign` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`id`);

--
-- Constraints for table `comercializacionproductos`
--
ALTER TABLE `comercializacionproductos`
  ADD CONSTRAINT `comercializacionproductos_comercializacion_id_foreign` FOREIGN KEY (`comercializacion_id`) REFERENCES `comercializacions` (`id`),
  ADD CONSTRAINT `comercializacionproductos_productoscomers_id_foreign` FOREIGN KEY (`productosComers_id`) REFERENCES `productoscomers` (`id`);

--
-- Constraints for table `comercializacions`
--
ALTER TABLE `comercializacions`
  ADD CONSTRAINT `comercializacions_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`);

--
-- Constraints for table `cosechas`
--
ALTER TABLE `cosechas`
  ADD CONSTRAINT `cosechas_finca_id_foreign` FOREIGN KEY (`finca_id`) REFERENCES `fincas` (`id`),
  ADD CONSTRAINT `cosechas_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`);

--
-- Constraints for table `cultivos`
--
ALTER TABLE `cultivos`
  ADD CONSTRAINT `cultivos_cadena_id_foreign` FOREIGN KEY (`cadena_id`) REFERENCES `cadenas` (`id`),
  ADD CONSTRAINT `cultivos_finca_id_foreign` FOREIGN KEY (`finca_id`) REFERENCES `fincas` (`id`),
  ADD CONSTRAINT `cultivos_lugarventa_id_foreign` FOREIGN KEY (`lugarVenta_id`) REFERENCES `lugarventas` (`id`),
  ADD CONSTRAINT `cultivos_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`);

--
-- Constraints for table `encuestaasofruts`
--
ALTER TABLE `encuestaasofruts`
  ADD CONSTRAINT `encuestaasofruts_finca_id_foreign` FOREIGN KEY (`finca_id`) REFERENCES `fincas` (`id`),
  ADD CONSTRAINT `encuestaasofruts_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`);

--
-- Constraints for table `encuesta_fitosanitarias`
--
ALTER TABLE `encuesta_fitosanitarias`
  ADD CONSTRAINT `encuesta_fitosanitarias_equipo_aplicaciones_id_foreign` FOREIGN KEY (`equipo_aplicaciones_id`) REFERENCES `equipo_aplicaciones` (`id`),
  ADD CONSTRAINT `encuesta_fitosanitarias_finca_id_foreign` FOREIGN KEY (`finca_id`) REFERENCES `fincas` (`id`),
  ADD CONSTRAINT `encuesta_fitosanitarias_linea_id_foreign` FOREIGN KEY (`linea_id`) REFERENCES `lineas` (`id`),
  ADD CONSTRAINT `encuesta_fitosanitarias_metodo_aplicaciones_id_foreign` FOREIGN KEY (`metodo_aplicaciones_id`) REFERENCES `metodo_aplicaciones` (`id`),
  ADD CONSTRAINT `encuesta_fitosanitarias_producto_fitosanitario_id_foreign` FOREIGN KEY (`producto_fitosanitario_id`) REFERENCES `producto_fitosanitarios` (`id`),
  ADD CONSTRAINT `encuesta_fitosanitarias_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`),
  ADD CONSTRAINT `encuesta_fitosanitarias_unidad_aplicaciones_id_foreign` FOREIGN KEY (`unidad_aplicaciones_id`) REFERENCES `unidad_aplicaciones` (`id`),
  ADD CONSTRAINT `encuesta_fitosanitarias_unidad_dosis_id_foreign` FOREIGN KEY (`unidad_dosis_id`) REFERENCES `unidad_dosis` (`id`);

--
-- Constraints for table `enfermedads`
--
ALTER TABLE `enfermedads`
  ADD CONSTRAINT `enfermedads_finca_id_foreign` FOREIGN KEY (`finca_id`) REFERENCES `fincas` (`id`),
  ADD CONSTRAINT `enfermedads_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`);

--
-- Constraints for table `establecimientoconceptos`
--
ALTER TABLE `establecimientoconceptos`
  ADD CONSTRAINT `establecimientoconceptos_conceptogasto_id_foreign` FOREIGN KEY (`conceptoGasto_id`) REFERENCES `conceptogastos` (`id`),
  ADD CONSTRAINT `establecimientoconceptos_gastosestablecimiento_id_foreign` FOREIGN KEY (`gastosEstablecimiento_id`) REFERENCES `gastosestablecimientos` (`id`);

--
-- Constraints for table `fincas`
--
ALTER TABLE `fincas`
  ADD CONSTRAINT `fincas_departamento_id_foreign` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`),
  ADD CONSTRAINT `fincas_linea_id_foreign` FOREIGN KEY (`linea_id`) REFERENCES `lineas` (`id`),
  ADD CONSTRAINT `fincas_municipio_id_foreign` FOREIGN KEY (`municipio_id`) REFERENCES `municipios` (`id`),
  ADD CONSTRAINT `fincas_posesion_id_foreign` FOREIGN KEY (`posesion_id`) REFERENCES `posesions` (`id`),
  ADD CONSTRAINT `fincas_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`),
  ADD CONSTRAINT `fincas_resguardo_id_foreign` FOREIGN KEY (`resguardo_id`) REFERENCES `resguardos` (`id`),
  ADD CONSTRAINT `fincas_vereda_id_foreign` FOREIGN KEY (`vereda_id`) REFERENCES `veredas` (`id`);

--
-- Constraints for table `gastosestablecimientos`
--
ALTER TABLE `gastosestablecimientos`
  ADD CONSTRAINT `gastosestablecimientos_finca_id_foreign` FOREIGN KEY (`finca_id`) REFERENCES `fincas` (`id`),
  ADD CONSTRAINT `gastosestablecimientos_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`);

--
-- Constraints for table `gastosproduccions`
--
ALTER TABLE `gastosproduccions`
  ADD CONSTRAINT `gastosproduccions_finca_id_foreign` FOREIGN KEY (`finca_id`) REFERENCES `fincas` (`id`),
  ADD CONSTRAINT `gastosproduccions_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`);

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
-- Constraints for table `nutricions`
--
ALTER TABLE `nutricions`
  ADD CONSTRAINT `nutricions_finca_id_foreign` FOREIGN KEY (`finca_id`) REFERENCES `fincas` (`id`),
  ADD CONSTRAINT `nutricions_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`);

--
-- Constraints for table `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `personas_tipo_id_foreign` FOREIGN KEY (`tipo_id`) REFERENCES `tipoids` (`id`);

--
-- Constraints for table `plagas`
--
ALTER TABLE `plagas`
  ADD CONSTRAINT `plagas_finca_id_foreign` FOREIGN KEY (`finca_id`) REFERENCES `fincas` (`id`),
  ADD CONSTRAINT `plagas_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`);

--
-- Constraints for table `podas`
--
ALTER TABLE `podas`
  ADD CONSTRAINT `podas_finca_id_foreign` FOREIGN KEY (`finca_id`) REFERENCES `fincas` (`id`),
  ADD CONSTRAINT `podas_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`);

--
-- Constraints for table `practicas`
--
ALTER TABLE `practicas`
  ADD CONSTRAINT `practicas_finca_id_foreign` FOREIGN KEY (`finca_id`) REFERENCES `fincas` (`id`),
  ADD CONSTRAINT `practicas_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`);

--
-- Constraints for table `prediocultivos`
--
ALTER TABLE `prediocultivos`
  ADD CONSTRAINT `prediocultivos_finca_id_foreign` FOREIGN KEY (`finca_id`) REFERENCES `fincas` (`id`),
  ADD CONSTRAINT `prediocultivos_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`),
  ADD CONSTRAINT `prediocultivos_vereda_id_foreign` FOREIGN KEY (`vereda_id`) REFERENCES `veredas` (`id`);

--
-- Constraints for table `produccionconceptos`
--
ALTER TABLE `produccionconceptos`
  ADD CONSTRAINT `produccionconceptos_conceptogasto_id_foreign` FOREIGN KEY (`conceptoGasto_id`) REFERENCES `conceptogastos` (`id`),
  ADD CONSTRAINT `produccionconceptos_gastosproduccion_id_foreign` FOREIGN KEY (`gastosproduccion_id`) REFERENCES `gastosproduccions` (`id`);

--
-- Constraints for table `productors`
--
ALTER TABLE `productors`
  ADD CONSTRAINT `productors_departamento_id_foreign` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`),
  ADD CONSTRAINT `productors_escolaridad_id_foreign` FOREIGN KEY (`escolaridad_id`) REFERENCES `gradoescolaridads` (`id`),
  ADD CONSTRAINT `productors_etnia_id_foreign` FOREIGN KEY (`etnia_id`) REFERENCES `etnias` (`id`),
  ADD CONSTRAINT `productors_id_foreign` FOREIGN KEY (`id`) REFERENCES `personas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `productors_municipio_id_foreign` FOREIGN KEY (`municipio_id`) REFERENCES `municipios` (`id`),
  ADD CONSTRAINT `productors_resguardo_id_foreign` FOREIGN KEY (`resguardo_id`) REFERENCES `resguardos` (`id`),
  ADD CONSTRAINT `productors_sexo_id_foreign` FOREIGN KEY (`sexo_id`) REFERENCES `sexos` (`id`),
  ADD CONSTRAINT `productors_vereda_id_foreign` FOREIGN KEY (`vereda_id`) REFERENCES `veredas` (`id`);

--
-- Constraints for table `renovacionconceptos`
--
ALTER TABLE `renovacionconceptos`
  ADD CONSTRAINT `renovacionconceptos_adecuacionrenovacion_id_foreign` FOREIGN KEY (`adecuacionrenovacion_id`) REFERENCES `adecuacionrenovacions` (`id`),
  ADD CONSTRAINT `renovacionconceptos_conceptogasto_id_foreign` FOREIGN KEY (`conceptoGasto_id`) REFERENCES `conceptogastos` (`id`);

--
-- Constraints for table `riegos`
--
ALTER TABLE `riegos`
  ADD CONSTRAINT `riegos_finca_id_foreign` FOREIGN KEY (`finca_id`) REFERENCES `fincas` (`id`),
  ADD CONSTRAINT `riegos_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`);

--
-- Constraints for table `suelos`
--
ALTER TABLE `suelos`
  ADD CONSTRAINT `suelos_finca_id_foreign` FOREIGN KEY (`finca_id`) REFERENCES `fincas` (`id`),
  ADD CONSTRAINT `suelos_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`);

--
-- Constraints for table `tutorados`
--
ALTER TABLE `tutorados`
  ADD CONSTRAINT `tutorados_finca_id_foreign` FOREIGN KEY (`finca_id`) REFERENCES `fincas` (`id`),
  ADD CONSTRAINT `tutorados_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_foreign` FOREIGN KEY (`id`) REFERENCES `personas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_idrol_foreign` FOREIGN KEY (`idrol`) REFERENCES `roles` (`id`);

--
-- Constraints for table `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `estadoventas` (`id`),
  ADD CONSTRAINT `ventas_linea_id_foreign` FOREIGN KEY (`linea_id`) REFERENCES `lineas` (`id`),
  ADD CONSTRAINT `ventas_lugarventa_id_foreign` FOREIGN KEY (`lugarVenta_id`) REFERENCES `lugarventas` (`id`),
  ADD CONSTRAINT `ventas_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`);

--
-- Constraints for table `ventas_categorias`
--
ALTER TABLE `ventas_categorias`
  ADD CONSTRAINT `ventas_categorias_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categoriamoras` (`id`),
  ADD CONSTRAINT `ventas_categorias_ventas_id_foreign` FOREIGN KEY (`ventas_id`) REFERENCES `ventas` (`id`);

--
-- Constraints for table `veredas`
--
ALTER TABLE `veredas`
  ADD CONSTRAINT `veredas_municipio_id_foreign` FOREIGN KEY (`municipio_id`) REFERENCES `municipios` (`id`);

--
-- Constraints for table `vocacions`
--
ALTER TABLE `vocacions`
  ADD CONSTRAINT `vocacions_finca_id_foreign` FOREIGN KEY (`finca_id`) REFERENCES `fincas` (`id`),
  ADD CONSTRAINT `vocacions_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productors` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
