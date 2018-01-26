-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2018 at 02:37 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_keuangan_cozzal`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_unit`
--

CREATE TABLE `tb_detail_unit` (
  `kd_unit` int(4) NOT NULL,
  `lantai` int(11) NOT NULL,
  `jml_kmr` int(11) NOT NULL,
  `jml_bed` int(11) NOT NULL,
  `jml_ac` int(11) NOT NULL,
  `water_heater` char(1) NOT NULL,
  `dapur` char(1) NOT NULL,
  `wifi` char(1) NOT NULL,
  `tv` char(1) NOT NULL,
  `amenities` char(1) NOT NULL,
  `merokok` char(1) NOT NULL,
  `img` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_detail_unit`
--

INSERT INTO `tb_detail_unit` (`kd_unit`, `lantai`, `jml_kmr`, `jml_bed`, `jml_ac`, `water_heater`, `dapur`, `wifi`, `tv`, `amenities`, `merokok`, `img`) VALUES
(1, 2, 1, 1, 1, 'Y', 'Y', 'Y', 'Y', 'Y', 'N', NULL),
(7, 1, 1, 1, 2, 'Y', 'Y', 'Y', 'N', 'N', 'N', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_detail_unit`
--
ALTER TABLE `tb_detail_unit`
  ADD PRIMARY KEY (`kd_unit`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
