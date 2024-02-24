-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2024 at 01:06 PM
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
  `clave` varchar(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `disponibilidad` tinyint(1) NOT NULL,
  `ultimoAcceso` date NOT NULL,
  `estudios` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alumno`
--

INSERT INTO `alumno` (`dni`, `clave`, `nombre`, `apellidos`, `email`, `disponibilidad`, `ultimoAcceso`, `estudios`) VALUES
('42417960A', 'ashjbd1233', 'John', 'Marston', 'johnmarston@gmail.com', 0, '2024-01-28', 5),
('76110594Y', 'sdfsf344', 'Pablo', 'Belló', 'pablobello0997@gmail.com', 1, '2024-01-29', 9);

-- --------------------------------------------------------

--
-- Table structure for table `estudios`
--

CREATE TABLE `estudios` (
  `id` int(5) NOT NULL,
  `estudiosCentro` varchar(50) NOT NULL,
  `estudiosExternos` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estudios`
--

INSERT INTO `estudios` (`id`, `estudiosCentro`, `estudiosExternos`) VALUES
(5, 'ASIR', 'mmmmm'),
(6, 'DAW', 'asdad51213'),
(7, 'DAW', 'pola'),
(8, 'DAW', 'asdadad'),
(9, 'DAW', 'asdad'),
(10, 'DAW', ''),
(11, 'DAW', ''),
(12, 'DAW', ''),
(13, 'DAW', ''),
(14, 'DAW', ''),
(15, 'DAW', ''),
(16, 'DAW', ''),
(17, 'ASIR', '');

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
('95448959V', 'Alice', 'Smith', 'alice.smith@example.com', 1),
('28380897R', 'Bob', 'Johnson', 'bob.johnson@example.com', 0),
('52439891Y', 'Charlie', 'Brown', 'charlie.brown@example.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumno`
--
ALTER TABLE `alumno`
  ADD KEY `estudios` (`estudios`);

--
-- Indexes for table `estudios`
--
ALTER TABLE `estudios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `estudios`
--
ALTER TABLE `estudios`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`estudios`) REFERENCES `estudios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
