-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2022 at 01:17 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `codigo` int(4) DEFAULT NULL,
  `nom` varchar(25) DEFAULT NULL,
  `ape` varchar(31) DEFAULT NULL,
  `sede` varchar(20) DEFAULT NULL,
  `carrera` varchar(34) DEFAULT NULL,
  `rut` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`codigo`, `nom`, `ape`, `sede`, `carrera`, `rut`) VALUES
(2035, 'Patricia Alejandra', 'Ortiz Ortiz', 'Vi?a del Mar', 'Educacion Parvularia', '18.272.685-0'),
(2034, 'Ellen Margarita', 'Barraza Torres', 'La Calera', 'Contabilidad General', '15.062.360-k'),
(2033, 'Juan Carlos', 'Andrade Parada', 'Central - Valparaiso', 'Construccion', '18.546.522-5'),
(2032, 'Jaime Rodrigo', 'Garcia Alvarez', 'Central - Valparaiso', 'Comercio Exterior', '18.902.321-9'),
(2031, 'Luisa Estefania', 'Zepeda Pasten', 'Central - Valparaiso', 'Operaciones Mineras', '18.254.926-6'),
(2030, 'Jose Armando', 'Gomez Vallejo', 'Vi?a del Mar', 'Prevencion de Riesgos Industriales', '13.997.150-7'),
(2029, 'Jorge Luis', 'Flores Lagos', 'Central - Valparaiso', 'Prevencion', '18.272.786-5'),
(2005, 'Ricardo Antonio', 'Guerrero Pe?a;Central - Valpara', 'Construccion', '10.924.537-2', NULL),
(2004, 'Carlos Humberto', 'Ortega Gonzalez', 'Vi?a del Mar', 'Construccion', '10.345.243-0'),
(2003, 'Karina Elena', 'Mu?oz Barahona', 'Vi?a del Mar', 'Educacion Parvularia', '11.824.499-0'),
(2002, 'Ninoska Alejandra', 'Urrea Salas', 'Central - Valparaiso', 'Administracion de Empresas', '18.784.258-1'),
(2001, 'Maria Del Pilar', 'Carcamo Gaete', 'Central - Valparaiso', 'Administracion de Empresas', '13.653.631-1'),
(2000, 'Maria Jesus', 'Arriagada Schmelzer', 'Central - Valparaiso', 'Administracion de Empresas', '16.969.228-9'),
(1999, 'Claudia Cristina', 'Neira Mu?oz;Vi?a del mar', 'Turismo y Hoteleria', '12.028.465-7', NULL),
(1998, 'Vladimir Enrique', 'Gonzalez Contreras', 'Vi?a del mar', 'Turismo y Hoteleria', '18.916.217-0'),
(1997, 'Lissete Alexia Del Carmen', 'Medina Caro', 'Vi?a del mar', 'Turismo y Hoteleria', '18.918.692-4'),
(1996, 'Carolina Belen', 'Mu?oz Escobar', 'Vi?a del mar', 'Educacion Parvularia', '18.782.697-7'),
(1995, 'Thiara Andrea', 'Morales Rodriguez', 'Vi?a del mar', 'Educacion Parvularia', '19.015.226-k'),
(1994, 'Carolina Andrea', 'Silva Rojas', 'Central - Valparaiso', 'Administracion de Empresas', '13.878.253-0'),
(1993, 'Byron Jesus', 'Jauregui Tobar', 'Central - Valparaiso', 'Operaciones Mineras', '18.268.703-0'),
(1992, 'Jonatan Enrique', 'Navarrete Ordenes', 'Central - Valparaiso', 'Construccion', '18.705.867-8'),
(1991, 'Karina Tamara', 'Molina Araya', 'Central - Valparaiso', 'Prevencion de Riesgos Industriales', '19.014.975-7'),
(1990, 'Ismael Gamalier', 'Seco Torres', 'Central - Valparaiso', 'Prevencion de Riesgos Industriales', '17.793.571-9'),
(1989, 'Diego Antonio', 'Ferrada Reyes', 'La Calera', 'Administracion de Empresas', '18.559.150-4'),
(1988, 'Alejandra Andrea', 'Aspe Mu?oz;La Calera', 'Educacion Parvularia', '16.890.634-k', NULL),
(1987, 'Pedro Pablo', 'Sepulveda Oelckers', 'La Calera', 'Administracion de Empresas', '18.283.535-8'),
(1986, 'Geries Jacobo', 'Hasbun Olivares', 'La Calera', 'Prevencion de Riesgos Industriales', '18.607.879-k'),
(1985, 'Jocelyn Mirian', 'Suarez Pacheco', 'La Calera', 'Prevencion de Riesgos Industriales', '16.819.233-9'),
(1982, 'Alexandra Monserrat', 'A?azco Moreno', 'Vi?a del Mar', 'Prevencion De Riesgos Industriales', '18.998.041-8'),
(1981, 'Selomit Banit', 'Astorga Gallardo', 'Central - Valparaiso', 'Prevencion De Riesgos Industriales', '18.272.537-4'),
(1980, 'Jacqueline Del Pilar', 'Aguirre Lopez', 'Vi?a del Mar', 'Prevencion De Riesgos Industriales', '17.354.153-8'),
(1979, 'Cinthia Alexandra', 'Bernal Vial', 'Vi?a del Mar', 'Prevencion De Riesgos Industriales', '16.677.713-5'),
(1978, 'Alvaro Alonso', 'Quezada Osorio', 'La Calera', 'Administracion de Empresas', '11.223.365-2'),
(1977, 'Jean Pierre', 'Zamora Aros', 'La Calera', 'Prevencion de Riesgos Industriales', '15.836.101-9'),
(1976, 'Jaime Ivan', 'Gonzalez Villarroel', 'La Calera', 'Operaciones Mineras', '18.420.710-9'),
(1975, 'Dahiana Scarlet', 'Diaz Morna', 'La Calera', 'Educacion Parvularia', '13.983.335-k'),
(1974, 'Daniela Carmen', 'Herrera Leiva', 'La Calera', 'Educacion Parvularia', '19.047.469-0'),
(1973, 'Francisco Javier', 'Ramirez Olivares', 'Central - Valparaiso', 'Logistica', '15.808.583-6'),
(1972, 'Wanda carmen', 'Guerrero orellana', 'Central - Valparaiso', 'Logista', '12.848.831-6'),
(111111, 'asdasd', 'asd', 'Viña del Mar', 'Tecnico en Enfermeria', '111111'),
(22222222, 'asdasd', 'asdasd', 'Viña del Mar', 'Tecnico en Enfermeria', '222222222'),
(66666, 'qqqqqq', 'aaaaaa', 'La Calera', 'Tecnico en Enfermeria', '222222'),
(123, 'ffff', '', 'Viña del Mar', NULL, '194498438'),
(1, 'fabian', 'niclouss', 'Viña del Mar', 'construccion', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `rut` int(11) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `rol` varchar(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`rut`, `clave`, `rol`, `nombre`, `foto`) VALUES
(12345, '$2y$10$aiRkQfOnJGTyf4peIxj7d.l0ZPk5.O9y65W83V88JvhxgmqC3XfJW', 'user', '', ''),
(194498438, '$2y$10$GEhwCtSC3Pbl.NEpfHsaMePLL28UAlzn0Hi3z4db3Wwh/ruGznnRy', 'user', 'fabian', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`rut`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
