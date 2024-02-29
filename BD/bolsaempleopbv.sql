-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 29, 2024 at 02:18 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bolsaempleopbv`
--
CREATE DATABASE IF NOT EXISTS `bolsaempleopbv` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bolsaempleopbv`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `dni` varchar(9) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`dni`, `clave`, `nombre`, `apellidos`, `email`) VALUES
('28380897R', '$2y$10$as1tjGTS0tFVPmZTqW1GOe5Lsdkdblr5ZLtP/vsI6tJ29/bMHIslK', 'Giga', 'Chad', 'gigachad@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `alumno`
--

CREATE TABLE `alumno` (
  `dni` varchar(9) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `disponibilidad` tinyint(1) NOT NULL,
  `ultimoAcceso` date NOT NULL,
  `estudiosExternos` varchar(1000) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alumno`
--

INSERT INTO `alumno` (`dni`, `clave`, `nombre`, `apellidos`, `email`, `disponibilidad`, `ultimoAcceso`, `estudiosExternos`, `activo`) VALUES
('05319965L', '$2y$10$wBSNpZUcKavYeepET2tZ5O.FvrK4i6V4WYGogfFwUwlcSkvKrrYsK', 'Ted', 'Kaczynsksi', 'tedkaczynski@example.com', 0, '2024-02-29', '3 meses en Softtek', 1),
('11949813W', '$2y$10$egREaRBpUHSN68PbhZVyIu7FKY6COwfCIAQtwdbZZJ4j4p5yYe1oq', 'John', 'Doe', 'john.doe@example.com', 1, '2024-02-29', 'Nada', 1),
('52439891Y', '$2y$10$Vm9Yav3dunofsX7vr5iDMe7gw9PZgm9JLeQx56K2um3UbvfhlH1kK', 'Charlie', 'Brown', 'charlie.brown@example.com', 1, '2023-02-28', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `alumno_estudios`
--

CREATE TABLE `alumno_estudios` (
  `id` int(5) NOT NULL,
  `alumno` varchar(9) NOT NULL,
  `estudios` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alumno_estudios`
--

INSERT INTO `alumno_estudios` (`id`, `alumno`, `estudios`) VALUES
(8, '05319965L', 20),
(9, '05319965L', 21),
(10, '05319965L', 22),
(11, '11949813W', 22),
(12, '52439891Y', 21);

-- --------------------------------------------------------

--
-- Table structure for table `aviso`
--

CREATE TABLE `aviso` (
  `id` int(5) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aviso`
--

INSERT INTO `aviso` (`id`, `email`, `fecha`) VALUES
(5, 'charlie.brown@example.com', '2024-02-29');

-- --------------------------------------------------------

--
-- Table structure for table `contrato`
--

CREATE TABLE `contrato` (
  `id` int(11) NOT NULL,
  `empleado` varchar(9) NOT NULL,
  `empresa` int(5) NOT NULL,
  `tipoContrato` varchar(100) NOT NULL,
  `fechaContrato` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contrato`
--

INSERT INTO `contrato` (`id`, `empleado`, `empresa`, `tipoContrato`, `fechaContrato`) VALUES
(16, '05319965L', 12345, 'indefinido', '2024-02-29');

-- --------------------------------------------------------

--
-- Table structure for table `empresa`
--

CREATE TABLE `empresa` (
  `cif` int(5) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ultimaPeticion` date NOT NULL,
  `empleadora` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `empresa`
--

INSERT INTO `empresa` (`cif`, `clave`, `nombre`, `email`, `ultimaPeticion`, `empleadora`) VALUES
(12345, '$2y$10$gotJtJZiBwAf4NNS185TweJJTAEm4QEGxq5IvinIvTLhEq4wQEwAm', 'Empresa S.L.', 'empresasl@example.com', '2024-02-29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `estudios`
--

CREATE TABLE `estudios` (
  `id` int(5) NOT NULL,
  `nombre` varchar(10) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estudios`
--

INSERT INTO `estudios` (`id`, `nombre`, `descripcion`) VALUES
(20, 'DAW', 'Desarrollo de Aplicaciones Web'),
(21, 'DAM', 'Desarrollo de Aplicaciones Multiplataforma'),
(22, 'ASIR', 'Administración de Sistemas Informáticos en Red');

-- --------------------------------------------------------

--
-- Table structure for table `fct`
--

CREATE TABLE `fct` (
  `id` int(5) NOT NULL,
  `alumno` varchar(9) NOT NULL,
  `empresa` int(5) NOT NULL,
  `modalidadFct` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fct`
--

INSERT INTO `fct` (`id`, `alumno`, `empresa`, `modalidadFct`) VALUES
(12, '05319965L', 12345, 'dualTec');

-- --------------------------------------------------------

--
-- Table structure for table `registroalumnos`
--

CREATE TABLE `registroalumnos` (
  `dni` varchar(9) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `titulado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registroalumnos`
--

INSERT INTO `registroalumnos` (`dni`, `nombre`, `apellidos`, `email`, `titulado`) VALUES
('05319965L', 'Ted', 'Kaczynsksi', 'tedkaczynski@example.com', 1),
('11949813W', 'John', 'Doe', 'john.doe@example.com', 1),
('14399207B', 'Jane', 'Doe', 'jane.doe@example.com', 0),
('28380897R', 'Bob', 'Johnson', 'bob.johnson@example.com', 0),
('52439891Y', 'Charlie', 'Brown', 'charlie.brown@example.com', 1),
('56990880P', 'Tom', 'Hatton', 'tomhatton@example.com', 1),
('95448959V', 'Alice', 'Smith', 'alice.smith@example.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `solicitudempleo`
--

CREATE TABLE `solicitudempleo` (
  `id` int(11) NOT NULL,
  `empresaSolicitante` int(5) NOT NULL,
  `perfilProfesional` int(5) NOT NULL,
  `experiencia` varchar(100) NOT NULL,
  `posibilidadViajar` tinyint(1) NOT NULL,
  `residenciaFavorita` varchar(100) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `activa` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `solicitudempleo`
--

INSERT INTO `solicitudempleo` (`id`, `empresaSolicitante`, `perfilProfesional`, `experiencia`, `posibilidadViajar`, `residenciaFavorita`, `descripcion`, `activa`) VALUES
(17, 12345, 20, 'Sin experiencia', 1, 'Albacete', 'Ingenierio de Front\r\n', 0);

-- --------------------------------------------------------

--
-- Table structure for table `solicitudfct`
--

CREATE TABLE `solicitudfct` (
  `id` int(5) NOT NULL,
  `empresaSolicitante` int(5) NOT NULL,
  `nAlumnosPorEstudios` varchar(1000) NOT NULL,
  `modalidadFct` varchar(100) NOT NULL,
  `nAlumnosPorEstudiosRestante` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `solicitudfct`
--

INSERT INTO `solicitudfct` (`id`, `empresaSolicitante`, `nAlumnosPorEstudios`, `modalidadFct`, `nAlumnosPorEstudiosRestante`) VALUES
(18, 12345, 'a:3:{i:20;i:2;i:21;i:1;i:22;i:0;}', 'dualTec', 'a:3:{i:20;i:1;i:21;i:1;i:22;i:0;}');

-- --------------------------------------------------------

--
-- Table structure for table `tutor`
--

CREATE TABLE `tutor` (
  `dni` varchar(9) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `estudiosTutoria` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tutor`
--

INSERT INTO `tutor` (`dni`, `clave`, `nombre`, `apellidos`, `email`, `estudiosTutoria`) VALUES
('76110594Y', '$2y$10$as1tjGTS0tFVPmZTqW1GOe5Lsdkdblr5ZLtP/vsI6tJ29/bMHIslK', 'Locura', 'Gonzalez', 'locuragonzalez@example.com', 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`dni`);

--
-- Indexes for table `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`dni`);

--
-- Indexes for table `alumno_estudios`
--
ALTER TABLE `alumno_estudios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_alumno2` (`alumno`),
  ADD KEY `FK_estudios` (`estudios`);

--
-- Indexes for table `aviso`
--
ALTER TABLE `aviso`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_empleado` (`empleado`),
  ADD KEY `FK_empresa` (`empresa`);

--
-- Indexes for table `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`cif`);

--
-- Indexes for table `estudios`
--
ALTER TABLE `estudios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fct`
--
ALTER TABLE `fct`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_alumno` (`alumno`),
  ADD KEY `FK_empresa3` (`empresa`);

--
-- Indexes for table `registroalumnos`
--
ALTER TABLE `registroalumnos`
  ADD PRIMARY KEY (`dni`);

--
-- Indexes for table `solicitudempleo`
--
ALTER TABLE `solicitudempleo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_empresaSolicitante` (`empresaSolicitante`),
  ADD KEY `FK_perfilProfesional` (`perfilProfesional`);

--
-- Indexes for table `solicitudfct`
--
ALTER TABLE `solicitudfct`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_empresaSolicitante2` (`empresaSolicitante`);

--
-- Indexes for table `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`dni`),
  ADD KEY `FK_estudiosTutoria` (`estudiosTutoria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumno_estudios`
--
ALTER TABLE `alumno_estudios`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `aviso`
--
ALTER TABLE `aviso`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contrato`
--
ALTER TABLE `contrato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `estudios`
--
ALTER TABLE `estudios`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `fct`
--
ALTER TABLE `fct`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `solicitudempleo`
--
ALTER TABLE `solicitudempleo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `solicitudfct`
--
ALTER TABLE `solicitudfct`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumno_estudios`
--
ALTER TABLE `alumno_estudios`
  ADD CONSTRAINT `FK_alumno2` FOREIGN KEY (`alumno`) REFERENCES `alumno` (`dni`),
  ADD CONSTRAINT `FK_estudios` FOREIGN KEY (`estudios`) REFERENCES `estudios` (`id`);

--
-- Constraints for table `contrato`
--
ALTER TABLE `contrato`
  ADD CONSTRAINT `FK_empleado` FOREIGN KEY (`empleado`) REFERENCES `alumno` (`dni`),
  ADD CONSTRAINT `FK_empresa` FOREIGN KEY (`empresa`) REFERENCES `empresa` (`cif`);

--
-- Constraints for table `fct`
--
ALTER TABLE `fct`
  ADD CONSTRAINT `FK_alumno` FOREIGN KEY (`alumno`) REFERENCES `alumno` (`dni`),
  ADD CONSTRAINT `FK_empresa3` FOREIGN KEY (`empresa`) REFERENCES `empresa` (`cif`);

--
-- Constraints for table `solicitudempleo`
--
ALTER TABLE `solicitudempleo`
  ADD CONSTRAINT `FK_empresaSolicitante` FOREIGN KEY (`empresaSolicitante`) REFERENCES `empresa` (`cif`),
  ADD CONSTRAINT `FK_perfilProfesional` FOREIGN KEY (`perfilProfesional`) REFERENCES `estudios` (`id`);

--
-- Constraints for table `solicitudfct`
--
ALTER TABLE `solicitudfct`
  ADD CONSTRAINT `FK_empresaSolicitante2` FOREIGN KEY (`empresaSolicitante`) REFERENCES `empresa` (`cif`);

--
-- Constraints for table `tutor`
--
ALTER TABLE `tutor`
  ADD CONSTRAINT `FK_estudiosTutoria` FOREIGN KEY (`estudiosTutoria`) REFERENCES `estudios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
