-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-09-2015 a las 20:42:05
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `formacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE IF NOT EXISTS `cursos` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `profesor` int(3) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `duracion` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `profesor` (`profesor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `profesor`, `nombre`, `duracion`) VALUES
(1, 1, 'Dreamweaver', 40),
(2, 2, 'Office', 25),
(3, 1, 'Office', 25),
(5, 8, 'MySQL', 35),
(6, 8, 'Dreamweaver', 35),
(16, 3, 'Sap Inicial', 70);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE IF NOT EXISTS `profesores` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `calle` varchar(100) NOT NULL,
  `cp` char(5) NOT NULL,
  `poblacion` varchar(50) NOT NULL,
  `nacimiento` date NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `sueldo` int(6) NOT NULL,
  `foto` varchar(80) NOT NULL DEFAULT 'fotos/profesor.jpg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`id`, `nombre`, `apellido`, `calle`, `cp`, `poblacion`, `nacimiento`, `sexo`, `sueldo`, `foto`) VALUES
(1, 'Juan', 'López', 'Alcala, 365', '28001', 'Madrid', '1980-01-12', 'hombre', 1400, 'fotos/profesor.jpg'),
(2, 'Marta', 'Perez Garcia', 'Diagonal, 65', '8002', 'Barcelona', '1985-09-17', 'mujer', 1800, 'fotos/marta-perez-garcia.jpg'),
(3, 'Cristina', 'Garcia', 'Jacometrezo, 14', '28003', 'Madrid', '1992-04-12', 'mujer', 1000, 'fotos/cristina-garcia.jpg'),
(6, 'José Luis', 'López Vázquez', 'Vuelta de la Esquina, 33', '28909', 'Madrid', '1934-11-07', 'hombre', 1100, 'fotos/profesor.jpg'),
(8, 'Alfredo', 'Hurtado', 'Ronda segovia, 12', '28015', 'Madrid', '1969-09-08', 'hombre', 1600, 'fotos/alfredo-hurtado.jpg'),
(24, 'Perico', 'Palotes', 'Alegria', '23456', 'Madrid', '1990-01-02', 'hombre', 1500, 'fotos/perico-palotes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuario` varchar(12) NOT NULL,
  `clave` varchar(12) NOT NULL,
  PRIMARY KEY (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `clave`) VALUES
('jean', 'jean');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`profesor`) REFERENCES `profesores` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
