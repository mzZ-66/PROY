-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2024 at 02:19 PM
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
-- Database: `redempleo`
--

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
  `estudiosCentro` int(5) NOT NULL,
  `estudiosExternos` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alumno`
--

INSERT INTO `alumno` (`dni`, `clave`, `nombre`, `apellidos`, `email`, `disponibilidad`, `ultimoAcceso`, `estudiosCentro`, `estudiosExternos`) VALUES
('11949813W', '$2y$10$qV62gT4bOh9pKFB/miEa0OEcKkcoQh/dsGZYEPvp0yptW9xKnhA9q', 'John', 'Doe', 'john.doe@example.com', 1, '2024-02-06', 21, 'DAW en Cuenca'),
('49215264W', '$2y$10$P/wrg7WeSMKUde4A4AFGsOuVJ2wuBc.YR4YxOzLAy0M/9fPE/t41q', 'Pablo', 'Belló', 'pablobello0997@gmail.com', 1, '2024-02-06', 20, 'SISISISISISI');

-- --------------------------------------------------------

--
-- Table structure for table `empresa`
--

CREATE TABLE `empresa` (
  `cif` int(5) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ultimaPeticion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `empresa`
--

INSERT INTO `empresa` (`cif`, `clave`, `nombre`, `email`, `ultimaPeticion`) VALUES
(12345, '$2y$10$hAvtIFd5FHq6lYRNs0AhT.BEAklD6pw7D5pxHZ5.pXtR/Bq6XemWm', 'Combinados Vargas', 'pablobello0997@gmail.com', '2024-02-05');

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
('11949813W', 'John', 'Doe', 'john.doe@example.com', 1),
('14399207B', 'Jane', 'Doe', 'jane.doe@example.com', 0),
('28380897R', 'Bob', 'Johnson', 'bob.johnson@example.com', 0),
('52439891Y', 'Charlie', 'Brown', 'charlie.brown@example.com', 1),
('95448959V', 'Alice', 'Smith', 'alice.smith@example.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`dni`),
  ADD KEY `FK_estudiosCentro` (`estudiosCentro`);

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
-- Indexes for table `registroalumnos`
--
ALTER TABLE `registroalumnos`
  ADD PRIMARY KEY (`dni`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `estudios`
--
ALTER TABLE `estudios`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `FK_estudiosCentro` FOREIGN KEY (`estudiosCentro`) REFERENCES `estudios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
