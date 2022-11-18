-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2022 a las 01:46:24
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `duelyst`
--

create database duelyst;
use duelyst;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `existir`
--

CREATE TABLE `existir` (
  `id_partida` int(11) NOT NULL,
  `id_heroe_enemigo` int(11) NOT NULL,
  `id_heroe_amigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `heroes`
--

CREATE TABLE `heroes` (
  `id_heroe` int(11) NOT NULL,
  `nombre_heroe` varchar(50) NOT NULL,
  `ruta_heroe` varchar(100) NOT NULL,
  `ataque_heroe` int(11) NOT NULL,
  `defensa_heroe` int(11) NOT NULL,
  `mana_heroe` int(11) NOT NULL,
  `vida_heroe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `heroes`
--

INSERT INTO `heroes` (`id_heroe`, `nombre_heroe`, `ruta_heroe`, `ataque_heroe`, `defensa_heroe`, `mana_heroe`, `vida_heroe`) VALUES
(1, 'Ace', 'ace.png', 7, 7, 50, 20),
(2, 'Bakezori', 'bakezori.png', 3, 4, 50, 20),
(3, 'Black solus', 'black_solus.png', 2, 3, 50, 20),
(4, 'Calligrapher', 'calligrapher.png', 4, 6, 50, 20),
(5, 'Chakri avatar', 'chakri_avatar.png', 4, 6, 50, 20),
(6, 'Coalfist', 'coalfist.png', 2, 25, 50, 20),
(7, 'Desolator', 'desolator.png', 2, 4, 50, 20),
(8, 'Dusk rigger', 'dusk_rigger.png', 2, 2, 50, 20),
(9, 'Flamewreath', 'flamewreath.png', 8, 6, 50, 20),
(10, 'Furiosa', 'furiosa.png', 6, 6, 50, 20),
(11, 'Geomancer', 'geomancer.png', 1, 1, 50, 20),
(12, 'Gore horn', 'gore_horn.png', 3, 3, 50, 20),
(13, 'Heartseeker', 'heartseeker.png', 1, 4, 50, 20),
(14, 'Jade monk', 'jade_monk.png', 1, 5, 50, 20),
(15, 'Kaido_expert', 'kaido_expert.png', 6, 6, 50, 20),
(16, 'Katara', 'katara.png', 2, 25, 50, 20),
(17, 'Ki beholder', 'ki_beholder.png', 4, 3, 50, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugar`
--

CREATE TABLE `jugar` (
  `id_usuario` int(11) NOT NULL,
  `id_partida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida`
--

CREATE TABLE `partida` (
  `id_partida` int(11) NOT NULL,
  `serial_partida` varchar(20) NOT NULL,
  `estado_partida` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `email`, `password`, `fecha_registro`) VALUES
(1, 'testing_game@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2022-11-14');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `existir`
--
ALTER TABLE `existir`
  ADD PRIMARY KEY (`id_partida`,`id_heroe_enemigo`),
  ADD KEY `id_heroe` (`id_heroe_enemigo`);

--
-- Indices de la tabla `heroes`
--
ALTER TABLE `heroes`
  ADD PRIMARY KEY (`id_heroe`);

--
-- Indices de la tabla `jugar`
--
ALTER TABLE `jugar`
  ADD PRIMARY KEY (`id_usuario`,`id_partida`),
  ADD KEY `id_partida` (`id_partida`);

--
-- Indices de la tabla `partida`
--
ALTER TABLE `partida`
  ADD PRIMARY KEY (`id_partida`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `heroes`
--
ALTER TABLE `heroes`
  MODIFY `id_heroe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `partida`
--
ALTER TABLE `partida`
  MODIFY `id_partida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `existir`
--
ALTER TABLE `existir`
  ADD CONSTRAINT `existir_ibfk_1` FOREIGN KEY (`id_partida`) REFERENCES `partida` (`id_partida`) ON DELETE CASCADE,
  ADD CONSTRAINT `existir_ibfk_2` FOREIGN KEY (`id_heroe_enemigo`) REFERENCES `heroes` (`id_heroe`);

--
-- Filtros para la tabla `jugar`
--
ALTER TABLE `jugar`
  ADD CONSTRAINT `jugar_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `jugar_ibfk_2` FOREIGN KEY (`id_partida`) REFERENCES `partida` (`id_partida`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
