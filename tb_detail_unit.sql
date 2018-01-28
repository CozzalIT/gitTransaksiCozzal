-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2018 at 06:07 AM
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
  `kd_detail_unit` int(4) NOT NULL,
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
  `type` varchar(15) NOT NULL,
  `img` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_detail_unit`
--
ALTER TABLE `tb_detail_unit`
  ADD PRIMARY KEY (`kd_detail_unit`),
  ADD KEY `kd_unit` (`kd_unit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_detail_unit`
--
ALTER TABLE `tb_detail_unit`
  MODIFY `kd_detail_unit` int(4) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_detail_unit`
--
ALTER TABLE `tb_detail_unit`
  ADD CONSTRAINT `tb_detail_unit_ibfk_1` FOREIGN KEY (`kd_unit`) REFERENCES `tb_unit` (`kd_unit`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
