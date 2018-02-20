-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2018 at 09:54 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Table structure for table `tb_mod_calendar`
--

CREATE TABLE `tb_mod_calendar` (
  `kd_mod_calendar` int(4) NOT NULL,
  `kd_unit` int(4) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `note` varchar(30) NOT NULL,
  `jenis` char(1) NOT NULL COMMENT '1:maintenance, 2:owner_blok, 3:admin_blok'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_mod_calendar`
--
ALTER TABLE `tb_mod_calendar`
  ADD PRIMARY KEY (`kd_mod_calendar`),
  ADD KEY `kd_unit` (`kd_unit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_mod_calendar`
--
ALTER TABLE `tb_mod_calendar`
  MODIFY `kd_mod_calendar` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_mod_calendar`
--
ALTER TABLE `tb_mod_calendar`
  ADD CONSTRAINT `tb_mod_calendar_ibfk_1` FOREIGN KEY (`kd_unit`) REFERENCES `tb_unit` (`kd_unit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
