-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2023 at 08:27 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `agency`
--

CREATE TABLE `agency` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agency_name` varchar(255) NOT NULL,
  `abbrev` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agency`
--

INSERT INTO `agency` (`id`, `agency_name`, `abbrev`) VALUES
(4, 'Philippine Council for Agriculture, Aquatic, and natural Resources Research and Development', 'PCAARRD'),
(5, 'Bulacan Agricultural State College', 'BASC'),
(6, 'Central Luzon State University', 'CLSU'),
(7, 'Pampanga State Agricultural University', 'PSAU'),
(8, 'Tarlac Agricultural University', 'TAU'),
(9, 'Aurora State College of Technology', 'ASCOT'),
(10, 'Bataan Peninsula State University', 'BPSU'),
(11, 'Nueva Ecija University of Science and Technology', 'NEUST'),
(12, 'President Ramon Magsaysay State University', 'PRMSU'),
(13, 'Department of Agriculture - Agricultural Training Institute 3', 'DA-ATI - Region 3'),
(14, 'Department of Agrarian Reform 3', 'DAR - Region 3'),
(15, 'Department of Science and Technology - Region 3', 'DOST - Region 3'),
(16, 'Philippine Carabao Center', 'PCC'),
(17, 'National Economic and Development Authority', 'NEDA'),
(18, 'Department of Environment and Natural Resources - Ecosystems Research and Development Bureau and Watershed Water Resources Research Center', 'DENR-ERDB-WWRC'),
(19, 'Philippine Center for Postharvest Research and Mechanization', 'PhilMech'),
(20, 'Philippine Rice Research Institute', 'PhilRice'),
(21, 'Nation Irrigation Administration - Region 3', 'NIA - Region 3'),
(22, 'Provincial Local Government Unit - Bataan', 'PLGU - Bataan'),
(23, 'Provincial Local Government Unit - Nueva Ecija', 'PLGU - Nueva Ecija'),
(24, 'Provincial Local Government Unit - Tarlac', 'PLGU - Tarlac'),
(25, 'Provincial Local Government Unit - Aurora', 'PLGU - Aurora'),
(26, 'Provincial Local Government Unit - Bulacan', 'PLGU - Bulacan'),
(27, 'Provincial Local Government Unit - Pampanga', 'PLGU - Pampanga'),
(28, 'Provincial Local Government Unit - Zambales', 'PLGU - Zambales'),
(29, 'Department of Budget and Management - Region 3', 'DBM - Region 3'),
(30, 'Department of Agriculture – Bureau of Agricultural Research', 'DA-BAR'),
(31, 'Department of Agriculture - Regional Field Office Region 3', 'DA-RFO - Region 3'),
(32, 'Bureau of Fisheries and Aquatic Resources Region 3', 'BFAR - Region 3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agency`
--
ALTER TABLE `agency`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agency`
--
ALTER TABLE `agency`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
