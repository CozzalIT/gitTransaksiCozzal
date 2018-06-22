-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2018 at 12:13 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

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
-- Table structure for table `tb_penawaran_owner`
--

CREATE TABLE `tb_penawaran_owner` (
  `kd_penawaran` int(4) NOT NULL,
  `kd_owner` int(4) NOT NULL,
  `kd_unit` int(4) NOT NULL,
  `judul` varchar(30) NOT NULL,
  `pesan` varchar(300) NOT NULL,
  `h_owner_wd` int(20) NOT NULL,
  `h_owner_we` int(20) NOT NULL,
  `h_owner_mg` int(20) NOT NULL,
  `h_owner_bln` int(20) NOT NULL,
  `status` char(1) NOT NULL COMMENT '0: Wait, 1:Acc, 2:rejected, 3:final',
  `tgl_penawaran` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_penawaran_owner`
--
ALTER TABLE `tb_penawaran_owner`
  ADD PRIMARY KEY (`kd_penawaran`),
  ADD KEY `kd_owner` (`kd_owner`),
  ADD KEY `kd_unit` (`kd_unit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_penawaran_owner`
--
ALTER TABLE `tb_penawaran_owner`
  MODIFY `kd_penawaran` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_penawaran_owner`
--
ALTER TABLE `tb_penawaran_owner`
  ADD CONSTRAINT `tb_penawaran_owner_ibfk_1` FOREIGN KEY (`kd_owner`) REFERENCES `tb_owner` (`kd_owner`),
  ADD CONSTRAINT `tb_penawaran_owner_ibfk_2` FOREIGN KEY (`kd_unit`) REFERENCES `tb_unit` (`kd_unit`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
