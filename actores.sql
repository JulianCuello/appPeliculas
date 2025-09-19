-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-09-2025 a las 23:46:29
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `peliculas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actores`
--

CREATE TABLE `actores` (
  `id_actor` int(200) NOT NULL,
  `nombre_actor` varchar(200) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `nacionalidad` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actores`
--
ALTER TABLE `actores`
  ADD PRIMARY KEY (`id_actor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actores`
--
ALTER TABLE `actores`
  MODIFY `id_actor` int(200) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actores`
--
ALTER TABLE `actores`
  ADD CONSTRAINT `actores_ibfk_1` FOREIGN KEY (`id_actor`) REFERENCES `peli` (`id_actor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
