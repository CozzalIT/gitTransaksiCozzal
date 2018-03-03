-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 28 Feb 2018 pada 23.52
-- Versi Server: 10.1.13-MariaDB
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
-- Struktur dari tabel `tb_task_unit`
--

CREATE TABLE `tb_task_unit` (
  `kd_unit` int(4) DEFAULT NULL,
  `kd_task` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_task_unit`
--
ALTER TABLE `tb_task_unit`
  ADD KEY `kd_unit` (`kd_unit`),
  ADD KEY `kd_task` (`kd_task`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_task_unit`
--
ALTER TABLE `tb_task_unit`
  ADD CONSTRAINT `tb_task_unit_ibfk_1` FOREIGN KEY (`kd_unit`) REFERENCES `tb_unit` (`kd_unit`),
  ADD CONSTRAINT `tb_task_unit_ibfk_2` FOREIGN KEY (`kd_task`) REFERENCES `tb_task` (`kd_task`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
