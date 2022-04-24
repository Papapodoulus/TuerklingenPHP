-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-04-2022 a las 03:06:32
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `timbrephp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `firmas`
--

CREATE TABLE `firmas` (
  `Id` int(11) NOT NULL,
  `Firma` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `firmas`
--

INSERT INTO `firmas` (`Id`, `Firma`) VALUES
(1, 'firma1'),
(2, 'firma2'),
(3, 'firma3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `raeume`
--

CREATE TABLE `raeume` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Id_firma` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `raeume`
--

INSERT INTO `raeume` (`Id`, `Name`, `Id_firma`) VALUES
(1, 'raum1', 1),
(2, 'raum2', 1),
(3, 'raum3', 1),
(4, 'raum4', 2),
(5, 'raum5', 2),
(6, 'raum6', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tablets`
--

CREATE TABLE `tablets` (
  `Id` int(11) NOT NULL,
  `Tablet` varchar(255) DEFAULT NULL,
  `Raum` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tablets`
--

INSERT INTO `tablets` (`Id`, `Tablet`, `Raum`) VALUES
(10, 'tablet1', 1),
(11, 'tablet2', 1),
(12, 'tablet3', 2),
(13, 'tablet4', 3),
(16, 'tablet7', 4),
(17, 'tablet8', 6),
(18, 'tablet9', 6),
(19, 'tablet99', 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `firmas`
--
ALTER TABLE `firmas`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `raeume`
--
ALTER TABLE `raeume`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_firma` (`Id_firma`);

--
-- Indices de la tabla `tablets`
--
ALTER TABLE `tablets`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `RaumId` (`Raum`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tablets`
--
ALTER TABLE `tablets`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `raeume`
--
ALTER TABLE `raeume`
  ADD CONSTRAINT `raeume_ibfk_1` FOREIGN KEY (`Id_firma`) REFERENCES `firmas` (`ID`);

--
-- Filtros para la tabla `tablets`
--
ALTER TABLE `tablets`
  ADD CONSTRAINT `RaumId` FOREIGN KEY (`Raum`) REFERENCES `raeume` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
