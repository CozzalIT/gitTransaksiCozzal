-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2018 at 10:19 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

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
-- Table structure for table `tb_request_listing`
--

CREATE TABLE `tb_request_listing` (
  `kd_request_listing` int(5) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `alamat` varchar(60) NOT NULL,
  `no_tlp` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `apartemen` varchar(30) NOT NULL,
  `tipe` varchar(20) NOT NULL,
  `lantai` int(11) NOT NULL,
  `kondisi` varchar(20) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_request_listing`
--

INSERT INTO `tb_request_listing` (`kd_request_listing`, `nama`, `alamat`, `no_tlp`, `email`, `apartemen`, `tipe`, `lantai`, `kondisi`, `status`) VALUES
(1, 'Farhan Hanif Alaudin', 'Margahayu', '089652281077', 'abc@gmail.com', 'Jardin', '', 12, 'Half Furnish', 'Pribadi'),
(2, 'Imron', 'Banjaran', '123456789', 'abc@gmail.com', 'Gateway', '', 24, 'Half Furnish', 'Pribadi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_request_listing`
--
ALTER TABLE `tb_request_listing`
  ADD PRIMARY KEY (`kd_request_listing`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_request_listing`
--
ALTER TABLE `tb_request_listing`
  MODIFY `kd_request_listing` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
