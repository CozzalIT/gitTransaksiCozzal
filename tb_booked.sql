-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2018 at 05:27 PM
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
-- Table structure for table `tb_booked`
--

CREATE TABLE `tb_booked` (
  `kd_booked` int(4) NOT NULL,
  `kd_unit` int(4) DEFAULT NULL,
  `kd_apt` int(4) DEFAULT NULL,
  `penyewa` varchar(25) DEFAULT NULL,
  `no_tlp` varchar(20) DEFAULT NULL,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_booked`
--
ALTER TABLE `tb_booked`
  ADD PRIMARY KEY (`kd_booked`),
  ADD KEY `kd_unit` (`kd_unit`),
  ADD KEY `kd_apt` (`kd_apt`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_booked`
--
ALTER TABLE `tb_booked`
  MODIFY `kd_booked` int(4) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_booked`
--
ALTER TABLE `tb_booked`
  ADD CONSTRAINT `tb_booked_ibfk_1` FOREIGN KEY (`kd_unit`) REFERENCES `tb_unit` (`kd_unit`),
  ADD CONSTRAINT `tb_booked_ibfk_2` FOREIGN KEY (`kd_apt`) REFERENCES `tb_apt` (`kd_apt`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
