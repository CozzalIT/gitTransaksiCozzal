-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2018 at 11:18 AM
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
-- Table structure for table `tb_cancel_transaksi`
--

CREATE TABLE `tb_cancel_transaksi` (
  `kd_cancel_transaksi` int(4) NOT NULL,
  `kd_penyewa` int(4) NOT NULL,
  `kd_apt` int(4) NOT NULL,
  `kd_unit` int(4) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `hari_weekend` int(4) NOT NULL,
  `hari_weekday` int(4) NOT NULL,
  `hari` int(3) NOT NULL,
  `harga_sewa_weekend` int(20) NOT NULL,
  `harga_sewa` int(20) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `diskon` int(20) NOT NULL,
  `ekstra_charge` int(20) NOT NULL,
  `kd_kas` int(4) NOT NULL,
  `tamu` int(11) NOT NULL,
  `kd_booking` int(5) NOT NULL,
  `dp` int(20) NOT NULL,
  `total_tagihan` int(20) NOT NULL,
  `sisa_pelunasan` int(20) NOT NULL,
  `catatan` varchar(50) NOT NULL,
  `pembayaran` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_cancel_transaksi`
--
ALTER TABLE `tb_cancel_transaksi`
  ADD PRIMARY KEY (`kd_cancel_transaksi`),
  ADD KEY `kd_penyewa` (`kd_penyewa`),
  ADD KEY `kd_apt` (`kd_apt`),
  ADD KEY `kd_unit` (`kd_unit`),
  ADD KEY `kd_kas` (`kd_kas`),
  ADD KEY `kd_booking` (`kd_booking`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_cancel_transaksi`
--
ALTER TABLE `tb_cancel_transaksi`
  ADD CONSTRAINT `tb_cancel_transaksi_ibfk_1` FOREIGN KEY (`kd_apt`) REFERENCES `tb_apt` (`kd_apt`),
  ADD CONSTRAINT `tb_cancel_transaksi_ibfk_2` FOREIGN KEY (`kd_booking`) REFERENCES `tb_booking_via` (`kd_booking`),
  ADD CONSTRAINT `tb_cancel_transaksi_ibfk_3` FOREIGN KEY (`kd_kas`) REFERENCES `tb_kas` (`kd_kas`),
  ADD CONSTRAINT `tb_cancel_transaksi_ibfk_4` FOREIGN KEY (`kd_unit`) REFERENCES `tb_unit` (`kd_unit`),
  ADD CONSTRAINT `tb_cancel_transaksi_ibfk_5` FOREIGN KEY (`kd_penyewa`) REFERENCES `tb_penyewa` (`kd_penyewa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
