-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2021 at 04:58 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tp01`
--

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `codigo_de_barra` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `precio` float NOT NULL,
  `fecha_de_creacion` date NOT NULL DEFAULT current_timestamp(),
  `fecha_de_modificacion` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`id`, `codigo_de_barra`, `nombre`, `tipo`, `stock`, `precio`, `fecha_de_creacion`, `fecha_de_modificacion`) VALUES
(1001, 77900361, 'Odex', 'Solido', 10, 80, '2021-02-09', '2021-04-25'),
(1002, 77900362, 'Spirit', 'solido', 45, 69.74, '2020-09-18', '2020-04-14'),
(1003, 77900363, 'Newgrosh', 'polvo', 12, 68.19, '2020-11-29', '2021-02-11'),
(1004, 77900364, 'McNickle', 'polvo', 19, 53.51, '2020-11-28', '2020-04-17'),
(1005, 77900365, 'Hudd', 'solido', 68, 26.56, '2020-12-19', '2020-06-19'),
(1006, 77900366, 'Schrader', 'polvo', 17, 96.54, '2020-08-02', '2020-04-18'),
(1007, 77900367, 'Bachellier', 'solido', 59, 69.17, '2021-01-30', '2020-06-07'),
(1008, 77900368, 'Fleming', 'solido', 38, 66.77, '2020-10-26', '2020-10-03'),
(1009, 77900369, 'CocaCola', 'liquido', 90, 130, '2020-07-04', '2021-04-26'),
(1010, 77900310, 'Krauss', 'polvo', 73, 35.73, '2021-03-03', '2020-08-30'),
(1015, 1010101, 'ProductoA', 'polvo', 2000, 2.7, '2021-04-25', '2021-04-25');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` int(11) NOT NULL,
  `mail` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_de_registro` date NOT NULL DEFAULT current_timestamp(),
  `localidad` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `clave`, `mail`, `fecha_de_registro`, `localidad`) VALUES
(101, 'Mariano', 'Kautor', 123456, 'dkantor0@example.com', '2021-01-07', 'Quilmes'),
(102, 'German', 'Gerram', 123456, 'ggerram1@hud.gov', '2020-05-08', 'Berazategui'),
(103, 'Deloris', 'Fosis', 123456, 'bsharpe2@wisc.edu', '2020-11-28', 'Avellaneda'),
(104, 'Brok', 'Neiner', 123456, 'bblazic3@desdev.cn', '2020-12-08', 'Quilmes'),
(105, 'Garrick', 'Brent', 123456, 'gbrent4@theguardian.', '2020-12-17', 'Moron'),
(106, 'Bili', 'Baus', 999999, 'bhoff5@addthis.com', '2020-11-27', 'Moreno'),
(115, 'Pablo', 'Gomez', 1234, 'pg@mail.com', '2021-04-26', 'Avellaneda'),
(116, 'Pablo', 'Gomez', 1234, 'pg@mail.com', '2021-04-26', 'Avellaneda');

-- --------------------------------------------------------

--
-- Table structure for table `venta`
--

CREATE TABLE `venta` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_de_venta` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `venta`
--

INSERT INTO `venta` (`id`, `id_producto`, `id_usuario`, `cantidad`, `fecha_de_venta`) VALUES
(1, 1001, 101, 2, '2020-07-19'),
(2, 1008, 102, 3, '2020-08-16'),
(3, 1007, 102, 4, '2021-01-24'),
(4, 1006, 103, 5, '2021-01-14'),
(5, 1003, 104, 6, '2021-03-20'),
(6, 1005, 105, 7, '2021-02-22'),
(7, 1003, 104, 6, '2020-12-02'),
(8, 1003, 106, 6, '2020-06-10'),
(9, 1002, 106, 6, '2021-02-04'),
(10, 1001, 106, 1, '2020-05-17'),
(11, 1002, 101, 3, '2021-04-25'),
(13, 1003, 103, 2, '2021-04-25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1016;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `venta`
--
ALTER TABLE `venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
