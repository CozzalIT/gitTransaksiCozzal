-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 03 Mar 2018 pada 02.28
-- Versi Server: 10.1.30-MariaDB
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
-- Struktur dari tabel `tb_mutasi_kas`
--

CREATE TABLE `tb_mutasi_kas` (
  `kd_mutasi_kas` int(4) NOT NULL,
  `kd_kas` int(4) NOT NULL,
  `mutasi_dana` int(20) NOT NULL,
  `jenis` char(1) NOT NULL COMMENT '1:masuk, 2:keluar',
  `tanggal` date NOT NULL,
  `keterangan` char(1) NOT NULL COMMENT '1:kas, 2:non-kas, 3:TU, 4:owner, 5:karyawan'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_mutasi_kas`
--

INSERT INTO `tb_mutasi_kas` (`kd_mutasi_kas`, `kd_kas`, `mutasi_dana`, `jenis`, `tanggal`, `keterangan`) VALUES
(1, 6, 20000000, '1', '2018-03-02', '2'),
(2, 7, 50000000, '1', '2018-03-02', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_mutasi_kas`
--
ALTER TABLE `tb_mutasi_kas`
  ADD PRIMARY KEY (`kd_mutasi_kas`),
  ADD KEY `kd_kas` (`kd_kas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_mutasi_kas`
--
ALTER TABLE `tb_mutasi_kas`
  MODIFY `kd_mutasi_kas` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_mutasi_kas`
--
ALTER TABLE `tb_mutasi_kas`
  ADD CONSTRAINT `tb_mutasi_kas_ibfk_1` FOREIGN KEY (`kd_kas`) REFERENCES `tb_kas` (`kd_kas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
