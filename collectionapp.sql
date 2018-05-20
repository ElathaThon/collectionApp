-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2018 a las 19:40:08
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `collectionapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `collection`
--

CREATE TABLE `collection` (
  `id` int(11) NOT NULL,
  `uuid` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `collection`
--

INSERT INTO `collection` (`id`, `uuid`, `name`) VALUES
(1, '', 'patataes'),
(2, '', 'objectes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `uuidItem` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL,
  `uuid` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `image`
--

INSERT INTO `image` (`id`, `uuidItem`, `url`, `uuid`) VALUES
(30, '5ae9e64c8d275', '5ae9ff523cf88.jpg', '5ae9ff523cf88'),
(31, '5ae9e64c8d275', '5ae9ff523d581.jpg', '5ae9ff523d581'),
(32, '5ae9e64c8d275', '5ae9ff523dad4.jpg', '5ae9ff523dad4'),
(33, '5aea00011c133', '5aea00096523e.jpg', '5aea00096523e'),
(34, '5aea00011c133', '5aea000967507.jpg', '5aea000967507');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `uuid` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `item`
--

INSERT INTO `item` (`id`, `uuid`, `name`, `description`) VALUES
(21, '5ae8b57abcc4a', 'hola', 'bon dia'),
(22, '5ae9e64c8d275', 'kitty', 'es un gat rosa'),
(23, '5ae9ffe444f34', '', ''),
(24, '5aea00011c133', 'dasda', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_collection`
--

CREATE TABLE `item_collection` (
  `id` int(11) NOT NULL,
  `idItem` int(11) NOT NULL,
  `idCollection` int(11) NOT NULL,
  `uuidItem` varchar(250) NOT NULL,
  `uuidCollection` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `item_collection`
--

INSERT INTO `item_collection` (`id`, `idItem`, `idCollection`, `uuidItem`, `uuidCollection`) VALUES
(1, 1, 2, '', ''),
(2, 2, 2, '', ''),
(3, 3, 2, '', ''),
(4, 4, 2, '', ''),
(5, 5, 2, '', ''),
(6, 6, 2, '', ''),
(7, 7, 2, '', ''),
(8, 8, 2, '', ''),
(9, 9, 2, '', ''),
(10, 17, 1, '', ''),
(11, 18, 1, '', ''),
(12, 19, 1, '', ''),
(13, 20, 1, '', ''),
(14, 21, 1, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `uuid` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `pass` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `uuid`, `name`, `pass`) VALUES
(1, 'aaaaa', 'user 01', '1'),
(2, 'bbbb', 'user 02', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_items`
--

CREATE TABLE `user_items` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idItem` int(11) NOT NULL,
  `uuidUser` varchar(250) NOT NULL,
  `uuidItem` varchar(250) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `item_collection`
--
ALTER TABLE `item_collection`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user_items`
--
ALTER TABLE `user_items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `collection`
--
ALTER TABLE `collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `item_collection`
--
ALTER TABLE `item_collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user_items`
--
ALTER TABLE `user_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
