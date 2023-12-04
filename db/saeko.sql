-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-12-2023 a las 05:37:02
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `saeko`
--
CREATE DATABASE IF NOT EXISTS `saeko` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `saeko`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(226) NOT NULL,
  `matricula` int(18) NOT NULL,
  `grado` varchar(226) NOT NULL,
  `id_materia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `nombre`, `matricula`, `grado`, `id_materia`) VALUES
(1, 'Israel Lara', 2147483647, '5D', 1),
(3, 'Edgar Flores Lira', 2147483643, '5D', 2),
(5, 'Roberto Calzada', 2147483642, '5D', 1),
(28, 'Martin Meza', 2147483647, '5D', 1),
(29, 'Martin Meza', 2147483647, '5D', 2),
(30, 'Martin Meza', 2147483647, '5D', 3),
(31, 'Martin Meza', 2147483647, '5D', 4),
(32, 'Martin Meza', 2147483647, '5D', 5),
(33, 'Martin Meza', 2147483647, '5D', 6),
(34, 'Martin Meza', 2147483647, '5D', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos2`
--

CREATE TABLE `alumnos2` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `matricula` int(226) NOT NULL,
  `grado` varchar(226) NOT NULL,
  `correo` varchar(226) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos2`
--

INSERT INTO `alumnos2` (`id`, `nombre`, `matricula`, `grado`, `correo`) VALUES
(1, 'Israel Lara', 2147483647, '5D', 'isra@gmail.com'),
(2, 'Edgar Flores Lira', 2147483643, '5D', 'edgar@gmail.com'),
(7, 'Martin Meza', 2147483647, '5D', 'a@a.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `id` int(11) NOT NULL,
  `id_materia` int(11) DEFAULT NULL,
  `id_alumno` varchar(50) NOT NULL,
  `calificacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`id`, `id_materia`, `id_alumno`, `calificacion`) VALUES
(28, 1, '1', 10),
(29, 1, '5', 4),
(30, 1, '6', 0),
(35, 2, '3', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestros`
--

CREATE TABLE `maestros` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `maestros`
--

INSERT INTO `maestros` (`id`, `nombre`, `email`, `contrasena`) VALUES
(2, 'prof1', 'a@a.com', '12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `grado` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id`, `nombre`, `grado`) VALUES
(1, 'Fisica', '5D'),
(2, 'Matematicas', '5D'),
(3, 'Historia', ''),
(4, 'Geografia', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajos`
--

CREATE TABLE `trabajos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(226) NOT NULL,
  `descripcion` varchar(226) NOT NULL,
  `fecha_entrega` int(10) NOT NULL,
  `archivo_adjunto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `trabajos`
--

INSERT INTO `trabajos` (`id`, `titulo`, `descripcion`, `fecha_entrega`, `archivo_adjunto`) VALUES
(10, 'Actividad 1', 'realiza la actividad', 2023, 'archivos_adjuntos/');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(226) NOT NULL,
  `apellido` varchar(226) NOT NULL,
  `password` varchar(226) NOT NULL,
  `matricula` int(18) NOT NULL,
  `correo` varchar(226) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `apellido`, `password`, `matricula`, `correo`) VALUES
(1, 'Windows', 'Dell', 'hola', 2147483647, 'a@a.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `alumnos2`
--
ALTER TABLE `alumnos2`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumno_id` (`id_materia`);

--
-- Indices de la tabla `maestros`
--
ALTER TABLE `maestros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trabajos`
--
ALTER TABLE `trabajos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `alumnos2`
--
ALTER TABLE `alumnos2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `maestros`
--
ALTER TABLE `maestros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `trabajos`
--
ALTER TABLE `trabajos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
