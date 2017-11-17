-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2017 a las 16:38:39
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `1718_projecte_2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_recurso`
--

CREATE TABLE `tbl_recurso` (
  `Id_Recurso` int(30) NOT NULL,
  `Nombre_Recurso` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Descripcion_Recurso` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Fotos_Recurso` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Tipo_Recurso` enum('Aula','Material informático','Aula con material informático') COLLATE utf8_unicode_ci NOT NULL,
  `Disponibilidad_Recurso` enum('Si','No') COLLATE utf8_unicode_ci NOT NULL,
  `Uso_Recurso` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_recurso`
--

INSERT INTO `tbl_recurso` (`Id_Recurso`, `Nombre_Recurso`, `Descripcion_Recurso`, `Fotos_Recurso`, `Tipo_Recurso`, `Disponibilidad_Recurso`, `Uso_Recurso`) VALUES
(1, 'AulaA ', 'Aula A sin proyector, ocupación para 50 alumnos', 'aulaA.jpg', 'Aula', 'Si', '00:00:00'),
(2, 'AulaB', 'Aula B con proyector, ocupación para 40 alumnos', 'aulaB.jpg', 'Aula con material informático', 'Si', '00:00:00'),
(3, 'AulaC', 'Aula C con proyector, disponibilidad para 17 alumnos.', 'aulaC.jpg', 'Aula con material informático', 'Si', '00:00:00'),
(4, 'AulaInformaticaA', 'Aula Informática A con 30 ordenadores', 'infoA.jpg', 'Aula con material informático', 'Si', '00:00:00'),
(5, 'AulaInformaticaB', 'Aula Informática B con 15 ordenadores', 'infoB.jpg', 'Aula con material informático', 'Si', '00:00:00'),
(6, 'DespachoEntrevistaA', 'Despacho para entrevistas de trabajo, para contratar al personal', 'despA.jpg', 'Aula', 'Si', '00:00:00'),
(7, 'DespachoEntrevistaB', 'Despacho para reuniones de profesores', 'despB.jpg', 'Aula', 'Si', '21:56:00'),
(8, 'SalaReunion', 'Sala para hacer reuniones del departamento.', 'sala.jpg', 'Aula', 'Si', '00:00:00'),
(9, 'Proyector', 'Proyector portátil Epson EB 98H, (proyector portátil )', 'proyector.jpg', 'Material informático', 'Si', '00:00:00'),
(10, 'CarroPortatiles', 'Carro de portátiles con 15 ordenadores', 'carro.jpg', 'Material informático', 'Si', '00:00:00'),
(11, 'PortatilA', 'lenovo i7 8GB Ram 1TB disco duro y pantalla de 15\'6\"', 'lenovo.jpg', 'Material informático', 'Si', '00:00:00'),
(12, 'PortatilB', 'asus i5 6GB Ram 500GB de disco duro y pantalla de 13\"', 'asus.jpg', 'Material informático', 'Si', '00:00:00'),
(13, 'PortatilC', 'Hp i3 2GB Ram 500GB de disco duro y pantalla de 15.6\" ', 'hp.jpg', 'Material informático', 'Si', '00:00:00'),
(14, 'MobilA', 'Apple Iphone 8 128GB Gris Espacial, pantalla 4,7\"', 'iphone.jpg', 'Material informático', 'Si', '00:00:00'),
(15, 'MobilB', 'Xiaomi Mi5 3GB Ram 64GB Rom, pantalla de 5,2\"', 'xiaomi.jpg', 'Material informático', 'Si', '00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_reserva`
--

CREATE TABLE `tbl_reserva` (
  `Id_Reserva` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_reserva`
--

INSERT INTO `tbl_reserva` (`Id_Reserva`, `Id_Usuario`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_reserva_recurso`
--

CREATE TABLE `tbl_reserva_recurso` (
  `Id_Reserva_Recurso` int(11) NOT NULL,
  `Fecha_Fin` datetime NOT NULL,
  `Fecha_Ini` datetime NOT NULL,
  `Id_Reserva` int(11) NOT NULL,
  `Id_Recurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_reserva_recurso`
--

INSERT INTO `tbl_reserva_recurso` (`Id_Reserva_Recurso`, `Fecha_Fin`, `Fecha_Ini`, `Id_Reserva`, `Id_Recurso`) VALUES
(1, '2017-11-17 16:21:33', '2017-11-16 18:24:44', 1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_user`
--

CREATE TABLE `tbl_user` (
  `Id_Usuario` int(11) NOT NULL,
  `Nombre_Usuario` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `Apellido1_Usuario` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `Apellido2_Usuario` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `Login_Usuario` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `Password_Usuario` varchar(9) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_user`
--

INSERT INTO `tbl_user` (`Id_Usuario`, `Nombre_Usuario`, `Apellido1_Usuario`, `Apellido2_Usuario`, `Login_Usuario`, `Password_Usuario`) VALUES
(1, 'Andrés', 'González', 'Pradas', 'agonzalez', 'qweQWE123'),
(2, 'Daniel', 'Molina', 'Blasco', 'dmolina', 'asdASD123'),
(3, 'Alberto', 'Fernandez', 'Rodriguez', 'afernandez', 'zxcZXC123'),
(4, 'Oscar', 'Sole ', 'Castilla', 'osole', 'qazQAZ123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_recurso`
--
ALTER TABLE `tbl_recurso`
  ADD PRIMARY KEY (`Id_Recurso`);

--
-- Indices de la tabla `tbl_reserva`
--
ALTER TABLE `tbl_reserva`
  ADD PRIMARY KEY (`Id_Reserva`),
  ADD KEY `FK_Id_Usuario` (`Id_Usuario`);

--
-- Indices de la tabla `tbl_reserva_recurso`
--
ALTER TABLE `tbl_reserva_recurso`
  ADD PRIMARY KEY (`Id_Reserva_Recurso`),
  ADD KEY `FK_Id_Reserva` (`Id_Reserva`),
  ADD KEY `FK_Id_Recurso` (`Id_Recurso`);

--
-- Indices de la tabla `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`Id_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_recurso`
--
ALTER TABLE `tbl_recurso`
  MODIFY `Id_Recurso` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tbl_reserva`
--
ALTER TABLE `tbl_reserva`
  MODIFY `Id_Reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_reserva_recurso`
--
ALTER TABLE `tbl_reserva_recurso`
  MODIFY `Id_Reserva_Recurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `Id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_reserva`
--
ALTER TABLE `tbl_reserva`
  ADD CONSTRAINT `FK_Id_Usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_user` (`Id_Usuario`);

--
-- Filtros para la tabla `tbl_reserva_recurso`
--
ALTER TABLE `tbl_reserva_recurso`
  ADD CONSTRAINT `FK_Id_Recurso` FOREIGN KEY (`Id_Recurso`) REFERENCES `tbl_recurso` (`Id_Recurso`),
  ADD CONSTRAINT `FK_Id_Reserva` FOREIGN KEY (`Id_Reserva`) REFERENCES `tbl_reserva` (`Id_Reserva`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
