-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 09 Mar 2018 pada 04.56
-- Versi Server: 5.6.32-78.1
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cozza3kq_cozzal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_apt`
--

CREATE TABLE IF NOT EXISTS `tb_apt` (
  `kd_apt` int(4) NOT NULL,
  `nama_apt` varchar(30) NOT NULL,
  `alamat_apt` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_apt`
--

INSERT INTO `tb_apt` (`kd_apt`, `nama_apt`, `alamat_apt`) VALUES
(1, 'Newton Hybrid Residence', 'Buah Batu'),
(6, 'The Jarrdin', 'Cihampelas'),
(7, 'Gateway Ahmad Yani', 'Cicadas'),
(8, 'Metro The Suit', 'Sukarno Hatta');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bank`
--

CREATE TABLE IF NOT EXISTS `tb_bank` (
  `kd_bank` int(4) NOT NULL,
  `nama_bank` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_bank`
--

INSERT INTO `tb_bank` (`kd_bank`, `nama_bank`) VALUES
(5, 'Danamon'),
(6, 'BCA'),
(7, 'Mandiri'),
(9, 'BNI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_blacklist`
--

CREATE TABLE IF NOT EXISTS `tb_blacklist` (
  `kd_blacklist` int(11) NOT NULL,
  `kd_penyewa` int(4) NOT NULL,
  `reason_bl` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_booking_via`
--

CREATE TABLE IF NOT EXISTS `tb_booking_via` (
  `kd_booking` int(5) NOT NULL,
  `booking_via` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_booking_via`
--

INSERT INTO `tb_booking_via` (`kd_booking`, `booking_via`) VALUES
(1, 'Offline'),
(3, 'Airbnb'),
(8, 'Security');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_catatan`
--

CREATE TABLE IF NOT EXISTS `tb_catatan` (
  `kd_catatan` int(4) NOT NULL,
  `kd_unit` int(4) DEFAULT NULL,
  `catatan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_confirm_transaksi`
--

CREATE TABLE IF NOT EXISTS `tb_confirm_transaksi` (
  `kd_confirm_transaksi` int(4) NOT NULL,
  `kd_penyewa` int(4) NOT NULL,
  `kd_apt` int(4) NOT NULL,
  `kd_unit` int(4) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `hari_weekend` int(4) NOT NULL,
  `hari_weekday` int(4) NOT NULL,
  `hari` int(3) NOT NULL,
  `harga_sewa` int(20) NOT NULL,
  `harga_sewa_weekend` int(20) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `diskon` int(20) NOT NULL,
  `ekstra_charge` int(20) NOT NULL,
  `kd_bank` int(4) NOT NULL,
  `kd_kas` int(4) NOT NULL,
  `tamu` int(11) NOT NULL,
  `kd_booking` int(5) NOT NULL,
  `dp` int(20) NOT NULL,
  `total_tagihan` int(20) NOT NULL,
  `sisa_pelunasan` int(20) NOT NULL,
  `catatan` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_confirm_transaksi`
--

INSERT INTO `tb_confirm_transaksi` (`kd_confirm_transaksi`, `kd_penyewa`, `kd_apt`, `kd_unit`, `check_in`, `check_out`, `hari_weekend`, `hari_weekday`, `hari`, `harga_sewa`, `harga_sewa_weekend`, `tgl_transaksi`, `diskon`, `ekstra_charge`, `kd_bank`, `kd_kas`, `tamu`, `kd_booking`, `dp`, `total_tagihan`, `sisa_pelunasan`, `catatan`) VALUES
(4, 57, 6, 23, '2018-02-01', '2018-02-02', 0, 1, 1, 375000, 400000, '2018-02-24', 75000, 0, 5, 5, 5, 1, 350000, 300000, -50000, ''),
(5, 57, 7, 20, '2018-02-01', '2018-02-04', 2, 1, 3, 350000, 350000, '2018-02-24', 132000, 0, 5, 5, 5, 1, 0, 1018000, 1018000, ''),
(6, 57, 1, 12, '2018-02-02', '2018-02-04', 2, 0, 2, 400000, 400000, '2018-02-24', 0, 0, 5, 5, 5, 1, 800000, 800000, 0, ''),
(7, 57, 1, 9, '2018-02-03', '2018-02-04', 1, 0, 1, 350000, 350000, '2018-02-24', 0, 0, 5, 5, 5, 1, 350000, 350000, 0, ''),
(8, 57, 1, 19, '2018-02-03', '2018-02-04', 1, 0, 1, 350000, 400000, '2018-02-24', 27000, 0, 5, 5, 5, 3, 373000, 373000, 0, ''),
(9, 57, 1, 24, '2018-02-03', '2018-02-04', 1, 0, 1, 350000, 400000, '2018-02-24', 0, 0, 5, 5, 5, 1, 400000, 400000, 0, ''),
(10, 57, 7, 26, '2018-02-03', '2018-02-04', 1, 0, 1, 350000, 300000, '2018-02-25', 0, 0, 5, 5, 5, 3, 388000, 388000, 0, ''),
(11, 57, 1, 19, '2018-02-08', '2018-02-11', 2, 1, 3, 350000, 400000, '2018-02-25', 100000, 0, 5, 5, 5, 1, 1050000, 1050000, 0, ''),
(12, 57, 1, 12, '2018-02-09', '2018-02-11', 2, 0, 2, 400000, 400000, '2018-02-25', 0, 0, 5, 5, 5, 1, 800000, 800000, 0, ''),
(13, 57, 6, 23, '2018-02-07', '2018-02-08', 0, 1, 1, 375000, 400000, '2018-02-25', 0, 0, 5, 5, 5, 1, 375000, 375000, 0, ''),
(14, 57, 6, 23, '2018-02-09', '2018-02-11', 2, 0, 2, 375000, 400000, '2018-02-25', 0, 0, 5, 5, 5, 3, 727500, 800000, 72500, ''),
(15, 63, 6, 23, '2018-03-05', '2018-03-07', 0, 2, 2, 375000, 400000, '2018-02-28', 0, 0, 9, 9, 5, 1, 300000, 800000, 500000, ''),
(16, 57, 1, 9, '2018-02-08', '2018-02-09', 0, 1, 1, 350000, 350000, '2018-02-25', 0, 0, 5, 5, 5, 1, 350000, 350000, 0, ''),
(17, 57, 1, 9, '2018-02-10', '2018-02-11', 1, 0, 1, 350000, 350000, '2018-02-25', 60500, 0, 5, 5, 5, 3, 339500, 339500, 0, ''),
(18, 57, 1, 11, '2018-02-03', '2018-02-04', 1, 0, 1, 400000, 400000, '2018-02-24', 0, 0, 5, 5, 5, 1, 400000, 400000, 0, ''),
(19, 57, 1, 11, '2018-02-09', '2018-02-10', 1, 0, 1, 400000, 400000, '2018-02-25', 0, 0, 5, 5, 5, 1, 400000, 400000, 0, ''),
(20, 57, 1, 11, '2018-02-12', '2018-02-13', 0, 2, 2, 400000, 400000, '2018-02-25', 0, 100000, 5, 5, 5, 1, 900000, 900000, 0, ''),
(21, 57, 1, 12, '2018-02-04', '2018-02-05', 0, 1, 1, 400000, 400000, '2018-02-25', 17000, 0, 5, 5, 5, 3, 383000, 383000, 0, ''),
(22, 72, 1, 12, '2018-02-24', '2018-02-25', 1, 0, 1, 400000, 400000, '2018-03-03', 16850, 0, 5, 5, 5, 3, 0, 383150, 0, ''),
(23, 57, 1, 19, '2018-02-15', '2018-02-16', 1, 1, 2, 350000, 400000, '2018-02-25', 0, 0, 5, 5, 5, 1, 770000, 770000, 0, ''),
(24, 57, 6, 23, '2018-02-03', '2018-02-05', 1, 2, 3, 375000, 400000, '2018-02-25', 59000, 0, 5, 5, 5, 3, 1091000, 1091000, 0, ''),
(25, 57, 7, 22, '2018-02-03', '2018-02-04', 1, 0, 1, 400000, 400000, '2018-02-25', 12000, 0, 5, 5, 5, 3, 388000, 388000, 0, ''),
(26, 60, 7, 20, '2018-02-15', '2018-02-16', 0, 1, 1, 350000, 350000, '2018-02-25', 10500, 0, 5, 5, 5, 3, 0, 339500, 0, ''),
(27, 57, 1, 24, '2018-02-10', '2018-02-11', 1, 0, 1, 350000, 400000, '2018-02-25', 0, 0, 5, 5, 5, 1, 400000, 400000, 0, ''),
(28, 59, 1, 12, '2018-03-03', '2018-03-04', 1, 0, 1, 400000, 400000, '2018-02-25', 5000, 0, 7, 7, 5, 1, 150000, 395000, 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_unit`
--

CREATE TABLE IF NOT EXISTS `tb_detail_unit` (
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
  `img` varchar(200) DEFAULT NULL,
  `isi` char(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_detail_unit`
--

INSERT INTO `tb_detail_unit` (`kd_detail_unit`, `kd_unit`, `lantai`, `jml_kmr`, `jml_bed`, `jml_ac`, `water_heater`, `dapur`, `wifi`, `tv`, `amenities`, `merokok`, `type`, `img`, `isi`) VALUES
(1, 11, 12, 2, 5, 1, 'Y', 'Y', 'Y', 'Y', 'N', 'N', '', '2502180116230.png', ''),
(2, 12, 12, 2, 4, 2, 'Y', 'Y', 'Y', 'Y', 'Y', 'N', '', '2102180033180.jpg', ''),
(3, 9, 9, 2, 3, 3, 'Y', 'Y', 'Y', 'N', 'N', 'N', '2BR', '1602182333430.12', 'Y'),
(4, 24, 8, 2, 2, 3, 'Y', 'Y', 'Y', 'N', 'N', 'N', '2BR', '1702180019400.12', 'Y'),
(5, 19, 18, 2, 4, 2, 'Y', 'Y', 'Y', 'N', 'N', 'N', '2BR', '2302181012090.12', 'Y'),
(6, 23, 0, 0, 0, 0, 'X', 'X', 'X', 'X', 'X', 'X', 'X', 'None', 'N'),
(7, 20, 0, 0, 0, 0, 'X', 'X', 'X', 'X', 'X', 'X', 'X', '2102180035180.jpg', 'N'),
(8, 22, 0, 0, 0, 0, 'X', 'X', 'X', 'X', 'X', 'X', 'X', '2102180035580.jpg', 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kas`
--

CREATE TABLE IF NOT EXISTS `tb_kas` (
  `kd_kas` int(4) NOT NULL,
  `sumber_dana` varchar(20) NOT NULL,
  `saldo` int(20) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kas`
--

INSERT INTO `tb_kas` (`kd_kas`, `sumber_dana`, `saldo`, `tanggal`) VALUES
(5, 'Danamon', 0, '2018-03-06 00:00:00'),
(7, 'Mandiri', 0, '2018-03-09 18:51:38'),
(9, 'BNI', 0, '2018-03-09 18:55:11'),
(12, 'Cash Operasional', 0, '2018-03-06 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mod_calendar`
--

CREATE TABLE IF NOT EXISTS `tb_mod_calendar` (
  `kd_mod_calendar` int(4) NOT NULL,
  `kd_unit` int(4) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `note` varchar(30) NOT NULL,
  `jenis` char(1) NOT NULL COMMENT '1:maintenance, 2:owner_blok, 3:admin_blok'
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_mod_calendar`
--

INSERT INTO `tb_mod_calendar` (`kd_mod_calendar`, `kd_unit`, `start_date`, `end_date`, `note`, `jenis`) VALUES
(12, 25, '2018-02-01', '2018-02-17', 'bocor air', '1'),
(13, 22, '2018-02-01', '2018-02-02', 'manual', '3'),
(15, 20, '2018-02-04', '2018-02-06', 'tamu sendiri', '2'),
(16, 20, '2018-02-10', '2018-02-11', 'manual', '3'),
(17, 26, '2018-02-10', '2018-05-10', 'tamu Rian', '3'),
(18, 22, '2018-02-10', '2018-02-11', 'manual', '3'),
(19, 20, '2018-02-16', '2018-02-18', 'Tamu Bu Nurul', '3'),
(20, 20, '2018-02-18', '2018-02-19', 'Bu Nurul', '1'),
(30, 20, '2018-03-06', '2018-03-07', 'dipake ', ''),
(31, 9, '0000-00-00', '0000-00-00', '', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mutasi_kas`
--

CREATE TABLE IF NOT EXISTS `tb_mutasi_kas` (
  `kd_mutasi_kas` int(4) NOT NULL,
  `kd_kas` int(4) NOT NULL,
  `mutasi_dana` int(20) NOT NULL,
  `jenis` char(1) NOT NULL COMMENT '1:masuk, 2:keluar',
  `tanggal` datetime NOT NULL,
  `keterangan` varchar(10) NOT NULL COMMENT '1:kas, 2:non-kas, 3:TU, 4:owner, 5:karyawan'
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_owner`
--

CREATE TABLE IF NOT EXISTS `tb_owner` (
  `kd_owner` int(4) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_tlp` varchar(15) NOT NULL,
  `kd_bank` int(4) NOT NULL,
  `no_rek` varchar(20) NOT NULL,
  `tgl_gabung` date NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `jumlah_unit` int(11) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_owner`
--

INSERT INTO `tb_owner` (`kd_owner`, `nama`, `alamat`, `no_tlp`, `kd_bank`, `no_rek`, `tgl_gabung`, `email`, `jenis_kelamin`, `jumlah_unit`, `username`) VALUES
(3, 'Triana Rezza', 'Antapani', '081809824448', 5, 'Antapani', '2017-12-22', 'mengmenggarlo@gmail.com', 'Perempuan', 4, 'owner'),
(4, 'Samun Djaja Rahardja', 'Margahayu', '08122003228', 9, '0022891252', '2017-12-25', 'harja_63@yahoo.com', 'Laki-laki', 1, 'samun'),
(5, 'Nurul Wikantyasning', 'Sukamiskin', '08112031314', 6, '0860270145', '2018-01-13', 'dummy@gmail.com', 'Perempuan', 2, 'nurul'),
(6, 'Ermawati', 'Margacinta', '081320704243', 6, '7750674164', '2018-01-20', 'ermaw078@gmail.com', 'Perempuan', 1, 'Erma'),
(7, 'Susanti', 'Pulo Laut', '0817611187', 7, '1310070077708', '2018-01-20', 'dummy@gmail.com', 'Perempuan', -1, 'susan'),
(8, 'Netty', 'Gateway', '08127102146', 6, '7401195622', '2018-01-20', 'dummy@gmail.com', 'Perempuan', 3, 'netty'),
(9, 'Boyke Fransiscus Setiawan', 'Kotabaru Parahyangan', '08118468634', 7, '9000019125401', '2018-01-20', 'simpliminimali@gmail.com', 'Laki-laki', 1, 'frans'),
(10, 'Nani Nofiar', 'Jakarta', '0811775117', 6, '3801188492', '2018-01-20', 'dummy@gmail.com', 'Perempuan', 2, 'nani'),
(11, 'Lily Catarina', 'Batununggal', '0816613417', 6, '0161775427', '2018-01-20', 'lilicatarina@gmail.com', 'Perempuan', 2, 'lily');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penyewa`
--

CREATE TABLE IF NOT EXISTS `tb_penyewa` (
  `kd_penyewa` int(4) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_tlp` varchar(15) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `tgl_gabung` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_penyewa`
--

INSERT INTO `tb_penyewa` (`kd_penyewa`, `nama`, `alamat`, `no_tlp`, `jenis_kelamin`, `email`, `tgl_gabung`) VALUES
(54, 'Muhamad Lokman', 'Johor, Malaysia', '+60127967065', 'Laki-laki', 'airbnb@airbnb.com', '2018-02-18'),
(55, 'Delfina Paramita', 'Jakarta', '08129091669', 'Perempuan', 'airbnb@airbnb.com', '2018-02-18'),
(56, 'test data', 'apakah sudah bisa', '081234567', 'Laki-laki', 'test@cozzal.com', '2018-02-20'),
(57, 'Tamu', 'Alamat Tamu', '0812345678', 'Laki-laki', 'tamu@cozzal.com', '2018-02-24'),
(58, 'Tamu Bulanan', 'Bandung', '0812345678', 'Laki-laki', 'tamubulanan@cozzal.com', '2018-02-25'),
(59, 'Dhiyan', 'Jakarta', '085710641678', 'Laki-laki', 'dummy@cozzal.com', '2018-02-25'),
(60, 'Rameo Putra', 'Jakarta', '085351222348', 'Laki-laki', 'dummy@cozzal.com', '2018-02-25'),
(61, 'juwanda', 'jawa barat', '085319333541', 'Laki-laki', 'dummy@cozzal.com', '2018-02-26'),
(62, 'ameerah samsudin', 'kuala lumpur', '+60123409900', 'Perempuan', 'dummy@cozzal.com', '2018-02-26'),
(63, 'Ahmad Zaim', 'Jakarta', '081212499732', 'Laki-laki', 'dummy@cozzal.com', '2018-02-28'),
(64, 'warjino', 'jakarta', 'ke anna', 'Laki-laki', 'dummy@cozzal.com', '2018-02-28'),
(65, 'Ilvan Faozan', 'Jawa Barat', '083820551553', 'Laki-laki', 'dummy@airbnb.com', '2018-02-28'),
(66, 'Erlita', 'Jakarta', 'ke anna', 'Perempuan', 'dummy@cozzal.com', '2018-02-28'),
(67, 'Nova', 'Bandung', 'ke anna', 'Laki-laki', 'dummy@cozzal.com', '2018-02-28'),
(68, 'PLN', 'Jakarta', 'ke anna', 'Laki-laki', 'dummy@cozzal.com', '2018-02-28'),
(69, 'Asna Fauziah', 'Yogyakarta', '081804291994', 'Perempuan', 'dummy@cozzal.com', '2018-02-28'),
(70, 'Rifta Silvia', 'Jakarta', '087877131715', 'Perempuan', 'dummy@cozzal.com', '2018-02-28'),
(71, 'Mirda Damayanti', 'Jakarta', '087880607758', 'Perempuan', 'dummy@airbnb.com', '2018-03-01'),
(72, 'rizka fitriani', 'Jakarta', '081321142435', 'Perempuan', 'dummy@gmail.com', '2018-03-03'),
(73, 'Joshua', 'Banten', '081298356756', 'Laki-laki', 'dummy@cozzal.com', '2018-03-05'),
(76, 'Fadil J&T', 'Jakarta', 'ke anna', 'Laki-laki', 'dummy@cozzal.com', '2018-03-05'),
(77, 'Andriani', 'Jawa Barat', '081290689592', 'Perempuan', 'dummy@cozzal.com', '2018-03-06'),
(79, 'Nadya', 'Jakarta', '081295999628', 'Perempuan', 'dummy@cozzal.com', '2018-03-06'),
(80, 'mirda', 'jakarta', '087880607758', 'Perempuan', 'dummy@gmail.com', '2018-03-06'),
(81, 'Faiz Kurniawan', 'Jakarta', ' 0856 9147 5405', 'Laki-laki', 'airbnb@airbnb.com', '2018-03-06'),
(82, 'Fatmawati Karima', 'Jakarta', '0811 265 2617', 'Perempuan', 'dummy@airbnb.com', '2018-03-07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_recommended`
--

CREATE TABLE IF NOT EXISTS `tb_recommended` (
  `kd_recommended` int(4) NOT NULL,
  `kd_penyewa` int(4) NOT NULL,
  `last_stay1` date NOT NULL,
  `last_stay2` date NOT NULL,
  `last_stay3` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_request_listing`
--

CREATE TABLE IF NOT EXISTS `tb_request_listing` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_request_listing`
--

INSERT INTO `tb_request_listing` (`kd_request_listing`, `nama`, `alamat`, `no_tlp`, `email`, `apartemen`, `tipe`, `lantai`, `kondisi`, `status`) VALUES
(1, 'Farhan Hanif Alaudin', 'Margahayu', '089652281077', 'abc@gmail.com', 'Jardin', '', 12, 'Half Furnish', 'Pribadi'),
(2, 'Imron', 'Banjaran', '123456789', 'abc@gmail.com', 'Gateway', '', 24, 'Half Furnish', 'Pribadi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_reservasi`
--

CREATE TABLE IF NOT EXISTS `tb_reservasi` (
  `kd_reservasi` int(4) NOT NULL,
  `kd_apt` int(4) NOT NULL,
  `kd_unit` int(4) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `nama` varchar(20) NOT NULL,
  `no_tlp` varchar(15) NOT NULL,
  `tgl_reservasi` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_reservasi`
--

INSERT INTO `tb_reservasi` (`kd_reservasi`, `kd_apt`, `kd_unit`, `check_in`, `check_out`, `nama`, `no_tlp`, `tgl_reservasi`) VALUES
(24, 5, 15, '2018-01-23', '2018-01-24', 'Dummy', '123456789', '2018-01-22'),
(25, 2, 18, '2018-01-27', '2018-01-30', 'Dummy', '123456789', '2018-01-22'),
(26, 2, 0, '2018-01-23', '2018-01-24', 'adfadfa', 'adfadfa', '2018-01-22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_task`
--

CREATE TABLE IF NOT EXISTS `tb_task` (
  `kd_task` int(11) NOT NULL,
  `task` varchar(100) DEFAULT NULL,
  `unit` varchar(5) DEFAULT NULL,
  `sifat` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_task`
--

INSERT INTO `tb_task` (`kd_task`, `task`, `unit`, `sifat`) VALUES
(1, 'Ganti Seprai dan Sarung Bantal', 'Semua', 'Rutin'),
(2, 'Sapu tiap Ruang', 'Semua', 'Rutin'),
(3, 'Cuci Piring', 'Semua', 'Rutin'),
(4, 'Pel Tiap Ruangan', 'Semua', 'Rutin'),
(5, 'Bersihkan Kamar Mandi', 'Semua', 'Rutin'),
(6, 'Buang Sampah', 'Semua', 'Rutin'),
(7, 'Cek Meteran Listrik', '20', 'Rutin'),
(8, 'Cek Meteran Listrik', '23', 'Rutin'),
(9, 'Cek Galon, Gas, dan Amenities', 'Semua', 'Rutin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_task_unit`
--

CREATE TABLE IF NOT EXISTS `tb_task_unit` (
  `kd_unit` int(4) DEFAULT NULL,
  `kd_task` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_task_unit`
--

INSERT INTO `tb_task_unit` (`kd_unit`, `kd_task`) VALUES
(11, 1),
(11, 2),
(11, 3),
(11, 4),
(11, 5),
(11, 6),
(11, 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE IF NOT EXISTS `tb_transaksi` (
  `kd_transaksi` int(4) NOT NULL,
  `kd_penyewa` int(4) NOT NULL,
  `kd_apt` int(4) NOT NULL,
  `kd_unit` int(4) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `hari_weekend` int(4) NOT NULL,
  `hari_weekday` int(4) NOT NULL,
  `hari` int(3) NOT NULL,
  `harga_sewa` int(20) NOT NULL,
  `harga_sewa_weekend` int(20) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `diskon` int(20) NOT NULL,
  `ekstra_charge` int(20) NOT NULL,
  `kd_bank` int(4) NOT NULL,
  `kd_kas` int(4) NOT NULL,
  `tamu` int(11) NOT NULL,
  `kd_booking` int(5) NOT NULL,
  `dp` int(20) NOT NULL,
  `total_tagihan` int(20) NOT NULL,
  `sisa_pelunasan` int(20) NOT NULL,
  `catatan` varchar(50) NOT NULL,
  `pembayaran` int(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`kd_transaksi`, `kd_penyewa`, `kd_apt`, `kd_unit`, `check_in`, `check_out`, `hari_weekend`, `hari_weekday`, `hari`, `harga_sewa`, `harga_sewa_weekend`, `tgl_transaksi`, `diskon`, `ekstra_charge`, `kd_bank`, `kd_kas`, `tamu`, `kd_booking`, `dp`, `total_tagihan`, `sisa_pelunasan`, `catatan`, `pembayaran`) VALUES
(66, 55, 1, 24, '2018-02-24', '2018-02-25', 1, 0, 1, 350000, 400000, '2018-02-18', 61000, 0, 5, 5, 4, 3, 0, 339000, 339000, '', 0),
(88, 58, 1, 9, '2018-02-15', '2018-03-15', 8, 20, 28, 350000, 350000, '2018-02-25', 0, 0, 5, 5, 5, 1, 7000000, 62300000, 55300000, '', 0),
(93, 61, 7, 20, '2018-03-01', '2018-03-05', 2, 3, 5, 350000, 350000, '2018-02-26', 152500, 0, 5, 5, 5, 3, 0, 1697500, 1697500, '', 0),
(94, 62, 1, 11, '2018-03-07', '2018-03-10', 1, 2, 3, 400000, 400000, '2018-02-26', 0, 0, 5, 5, 5, 3, 0, 1200000, 1200000, '', 0),
(96, 64, 6, 23, '2018-03-16', '2018-03-17', 2, 0, 2, 375000, 400000, '2018-02-28', 50000, 0, 5, 5, 5, 1, 375000, 750000, 375000, '', 0),
(98, 66, 1, 12, '2018-03-10', '2018-03-11', 1, 1, 2, 400000, 400000, '2018-02-28', 0, 0, 5, 5, 5, 1, 450000, 900000, 450000, '', 0),
(99, 67, 1, 24, '2018-02-28', '2018-03-29', 8, 22, 30, 350000, 400000, '2018-02-28', 5900000, 0, 5, 5, 5, 1, 5000000, 5000000, 0, '', 0),
(100, 68, 1, 19, '2018-03-02', '2018-03-03', 2, 0, 2, 350000, 400000, '2018-02-28', 0, 0, 5, 5, 5, 1, 300000, 800000, 500000, '', 0),
(101, 69, 6, 23, '2018-03-30', '2018-03-31', 2, 0, 2, 375000, 400000, '2018-02-28', 69000, 0, 5, 5, 5, 3, 0, 731000, 731000, '', 0),
(102, 70, 7, 20, '2018-03-30', '2018-04-01', 2, 1, 3, 350000, 350000, '2018-02-28', 32000, 0, 5, 5, 5, 3, 0, 1018000, 1018000, '', 0),
(103, 71, 1, 9, '2018-03-23', '2018-03-24', 2, 0, 2, 350000, 350000, '2018-03-01', 89000, 0, 5, 5, 5, 3, 0, 611000, 611000, '', 0),
(105, 73, 6, 23, '2018-03-09', '2018-03-10', 2, 0, 2, 375000, 400000, '2018-03-05', 24000, 0, 5, 5, 5, 3, 0, 776000, 776000, '', 0),
(108, 76, 1, 19, '2018-03-16', '2018-03-17', 1, 0, 1, 350000, 400000, '2018-03-05', 0, 0, 5, 5, 5, 1, 0, 400000, 400000, '', 0),
(109, 76, 1, 12, '2018-03-16', '2018-03-17', 1, 0, 1, 400000, 400000, '2018-03-05', 0, 0, 5, 5, 5, 1, 0, 400000, 400000, '', 0),
(110, 77, 1, 19, '2018-03-10', '2018-03-11', 1, 0, 1, 350000, 400000, '2018-03-06', 26550, 0, 5, 5, 5, 3, 0, 373450, 373450, '', 0),
(111, 79, 1, 12, '2018-03-27', '2018-03-28', 0, 2, 2, 400000, 400000, '2018-03-06', 0, 0, 5, 5, 5, 3, 0, 900000, 900000, '', 0),
(113, 81, 1, 11, '2018-03-10', '2018-03-11', 1, 0, 1, 400000, 400000, '2018-03-07', 16850, 0, 5, 5, 5, 3, 0, 383150, 383150, '', 0),
(114, 82, 7, 20, '2018-03-10', '2018-03-11', 1, 0, 1, 350000, 350000, '2018-03-07', 10500, 0, 5, 5, 5, 3, 0, 339500, 339500, '', 0),
(115, 73, 6, 23, '2018-03-08', '2018-03-09', 0, 1, 1, 375000, 400000, '2018-03-07', 175000, 0, 5, 5, 5, 1, 0, 200000, 200000, '', 0),
(117, 76, 1, 11, '2018-03-15', '2018-03-17', 1, 1, 2, 400000, 400000, '2018-03-07', 0, 0, 5, 5, 5, 1, 500000, 800000, 300000, '', 0),
(118, 76, 1, 11, '2018-03-18', '2018-03-19', 0, 1, 1, 400000, 400000, '2018-03-07', 0, 0, 5, 5, 5, 1, 0, 400000, 400000, '', 0),
(119, 68, 1, 19, '2018-03-08', '2018-03-10', 1, 1, 2, 350000, 400000, '2018-03-07', 0, 0, 5, 5, 5, 1, 0, 750000, 750000, '', 0),
(120, 68, 7, 22, '2018-03-08', '2018-03-12', 2, 2, 4, 400000, 400000, '2018-03-07', 0, 0, 5, 5, 5, 1, 0, 1600000, 1600000, '', 0),
(121, 56, 1, 9, '2018-03-20', '2018-03-21', 0, 1, 1, 350000, 0, '2018-03-08', 0, 0, 5, 5, 5, 1, 0, 350000, 350000, '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi_umum`
--

CREATE TABLE IF NOT EXISTS `tb_transaksi_umum` (
  `kd_transaksi_umum` int(4) NOT NULL,
  `kd_kas` int(4) NOT NULL,
  `kebutuhan` varchar(20) NOT NULL,
  `harga` int(20) NOT NULL,
  `jumlah` int(4) NOT NULL,
  `keterangan` varchar(30) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_unit`
--

CREATE TABLE IF NOT EXISTS `tb_unit` (
  `kd_unit` int(4) NOT NULL,
  `kd_apt` int(4) NOT NULL,
  `kd_owner` int(4) DEFAULT NULL,
  `no_unit` varchar(15) NOT NULL,
  `h_sewa_wd` int(10) NOT NULL,
  `h_sewa_we` int(10) NOT NULL,
  `h_owner_wd` int(10) NOT NULL,
  `h_owner_we` int(10) NOT NULL,
  `ekstra_charge` int(10) NOT NULL,
  `tgl_task` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_unit`
--

INSERT INTO `tb_unit` (`kd_unit`, `kd_apt`, `kd_owner`, `no_unit`, `h_sewa_wd`, `h_sewa_we`, `h_owner_wd`, `h_owner_we`, `ekstra_charge`, `tgl_task`) VALUES
(9, 1, 4, '9BJ', 350000, 350000, 275000, 275000, 25000, '2018-02-11'),
(11, 1, 6, '12BD', 400000, 400000, 250000, 300000, 25000, '2018-03-09'),
(12, 1, 9, '16BE', 400000, 400000, 275000, 325000, 25000, '2018-03-04'),
(19, 1, 3, '18BF', 350000, 400000, 275000, 300000, 25000, '2018-03-03'),
(20, 7, 5, 'SA 07 09', 350000, 350000, 275000, 275000, 25000, '2018-03-05'),
(22, 7, 7, 'EC 6 21', 400000, 400000, 300000, 300000, 25000, '2018-02-04'),
(23, 6, 3, 'A133', 375000, 400000, 275000, 300000, 25000, '2018-03-09'),
(24, 1, 10, '8BG', 350000, 400000, 300000, 300000, 25000, '2018-02-25'),
(25, 1, 11, '32BF', 400000, 450000, 300000, 300000, 25000, '0000-00-00'),
(26, 7, 8, 'SA-6-5', 350000, 300000, 270000, 300000, 25000, '2018-02-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_unit_kotor`
--

CREATE TABLE IF NOT EXISTS `tb_unit_kotor` (
  `kd_unit` int(4) DEFAULT NULL,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_unit_kotor`
--

INSERT INTO `tb_unit_kotor` (`kd_unit`, `check_in`, `check_out`) VALUES
(9, '2018-02-15', '2018-03-15'),
(11, '2018-03-07', '2018-03-09'),
(23, '2018-03-16', '2018-03-17'),
(12, '2018-03-10', '2018-03-11'),
(24, '2018-02-28', '2018-03-29'),
(23, '2018-03-30', '2018-03-31'),
(20, '2018-03-30', '2018-04-01'),
(23, '2018-03-09', '2018-03-10'),
(19, '2018-03-16', '2018-03-17'),
(12, '2018-03-16', '2018-03-17'),
(19, '2018-03-10', '2018-03-11'),
(12, '2018-03-27', '2018-03-28'),
(12, '2018-03-23', '2018-03-24'),
(11, '2018-03-10', '2018-03-11'),
(20, '2018-03-10', '2018-03-11'),
(11, '2018-03-15', '2018-03-17'),
(11, '2018-03-18', '2018-03-19'),
(19, '2018-03-08', '2018-03-10'),
(22, '2018-03-08', '2018-03-12'),
(9, '2018-03-20', '2018-03-21'),
(23, '2018-06-21', '2018-06-25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `hak_akses` varchar(20) NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`username`, `password`, `hak_akses`, `status`) VALUES
('admin1', 'cozzal%lotuve', 'superadmin', '3'),
('admin2', 'cozzal123', 'admin', '3'),
('anna', 'anna123', 'manager', '3'),
('Erma', 'erma123', 'owner', '1'),
('frans', 'frans123', 'owner', '1'),
('lily', 'lily123', 'owner', '1'),
('lina', 'lina123', 'admin', '3'),
('manager', 'manager1', 'manager', '3'),
('maya', 'maya123', 'cleaner', '3'),
('nani', 'nani123', 'owner', '1'),
('netty', 'netty123', 'owner', '1'),
('nurul', 'nurul123', 'owner', '1'),
('owner', 'owner', 'owner', '1'),
('samun', 'samun123', 'owner', '1'),
('susan', 'susan123', 'owner', '1'),
('yusuf', 'yusuf123', 'superadmin', '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_apt`
--
ALTER TABLE `tb_apt`
  ADD PRIMARY KEY (`kd_apt`);

--
-- Indexes for table `tb_bank`
--
ALTER TABLE `tb_bank`
  ADD PRIMARY KEY (`kd_bank`);

--
-- Indexes for table `tb_blacklist`
--
ALTER TABLE `tb_blacklist`
  ADD PRIMARY KEY (`kd_blacklist`), ADD KEY `kd_nama` (`kd_penyewa`), ADD KEY `kd_nama_2` (`kd_penyewa`);

--
-- Indexes for table `tb_booking_via`
--
ALTER TABLE `tb_booking_via`
  ADD PRIMARY KEY (`kd_booking`);

--
-- Indexes for table `tb_catatan`
--
ALTER TABLE `tb_catatan`
  ADD PRIMARY KEY (`kd_catatan`), ADD KEY `kd_unit` (`kd_unit`);

--
-- Indexes for table `tb_confirm_transaksi`
--
ALTER TABLE `tb_confirm_transaksi`
  ADD PRIMARY KEY (`kd_confirm_transaksi`), ADD KEY `kd_penyewa` (`kd_penyewa`), ADD KEY `kd_apt` (`kd_apt`), ADD KEY `kd_unit` (`kd_unit`), ADD KEY `kd_bank` (`kd_bank`), ADD KEY `kd_booking` (`kd_booking`), ADD KEY `kd_kas` (`kd_kas`);

--
-- Indexes for table `tb_detail_unit`
--
ALTER TABLE `tb_detail_unit`
  ADD PRIMARY KEY (`kd_detail_unit`), ADD KEY `kd_unit` (`kd_unit`);

--
-- Indexes for table `tb_kas`
--
ALTER TABLE `tb_kas`
  ADD PRIMARY KEY (`kd_kas`);

--
-- Indexes for table `tb_mod_calendar`
--
ALTER TABLE `tb_mod_calendar`
  ADD PRIMARY KEY (`kd_mod_calendar`), ADD KEY `kd_unit` (`kd_unit`);

--
-- Indexes for table `tb_mutasi_kas`
--
ALTER TABLE `tb_mutasi_kas`
  ADD PRIMARY KEY (`kd_mutasi_kas`), ADD KEY `kd_kas` (`kd_kas`);

--
-- Indexes for table `tb_owner`
--
ALTER TABLE `tb_owner`
  ADD PRIMARY KEY (`kd_owner`), ADD KEY `kd_bank` (`kd_bank`), ADD KEY `username` (`username`);

--
-- Indexes for table `tb_penyewa`
--
ALTER TABLE `tb_penyewa`
  ADD PRIMARY KEY (`kd_penyewa`);

--
-- Indexes for table `tb_recommended`
--
ALTER TABLE `tb_recommended`
  ADD PRIMARY KEY (`kd_recommended`), ADD KEY `kd_penyewa` (`kd_penyewa`);

--
-- Indexes for table `tb_request_listing`
--
ALTER TABLE `tb_request_listing`
  ADD PRIMARY KEY (`kd_request_listing`);

--
-- Indexes for table `tb_reservasi`
--
ALTER TABLE `tb_reservasi`
  ADD PRIMARY KEY (`kd_reservasi`), ADD KEY `kd_apt` (`kd_apt`), ADD KEY `kd_unit` (`kd_unit`);

--
-- Indexes for table `tb_task`
--
ALTER TABLE `tb_task`
  ADD PRIMARY KEY (`kd_task`);

--
-- Indexes for table `tb_task_unit`
--
ALTER TABLE `tb_task_unit`
  ADD KEY `kd_unit` (`kd_unit`), ADD KEY `kd_task` (`kd_task`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`kd_transaksi`), ADD KEY `kd_penyewa` (`kd_penyewa`), ADD KEY `kd_unit` (`kd_unit`), ADD KEY `kd_apt` (`kd_apt`), ADD KEY `kd_booking` (`kd_booking`), ADD KEY `kd_bank` (`kd_bank`), ADD KEY `kd_kas` (`kd_kas`);

--
-- Indexes for table `tb_transaksi_umum`
--
ALTER TABLE `tb_transaksi_umum`
  ADD PRIMARY KEY (`kd_transaksi_umum`), ADD KEY `kd_kas` (`kd_kas`);

--
-- Indexes for table `tb_unit`
--
ALTER TABLE `tb_unit`
  ADD PRIMARY KEY (`kd_unit`), ADD KEY `kd_apt` (`kd_apt`), ADD KEY `kd_owner` (`kd_owner`);

--
-- Indexes for table `tb_unit_kotor`
--
ALTER TABLE `tb_unit_kotor`
  ADD KEY `kd_unit` (`kd_unit`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_apt`
--
ALTER TABLE `tb_apt`
  MODIFY `kd_apt` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tb_bank`
--
ALTER TABLE `tb_bank`
  MODIFY `kd_bank` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tb_blacklist`
--
ALTER TABLE `tb_blacklist`
  MODIFY `kd_blacklist` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_booking_via`
--
ALTER TABLE `tb_booking_via`
  MODIFY `kd_booking` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tb_catatan`
--
ALTER TABLE `tb_catatan`
  MODIFY `kd_catatan` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_confirm_transaksi`
--
ALTER TABLE `tb_confirm_transaksi`
  MODIFY `kd_confirm_transaksi` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `tb_detail_unit`
--
ALTER TABLE `tb_detail_unit`
  MODIFY `kd_detail_unit` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tb_kas`
--
ALTER TABLE `tb_kas`
  MODIFY `kd_kas` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tb_mod_calendar`
--
ALTER TABLE `tb_mod_calendar`
  MODIFY `kd_mod_calendar` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `tb_mutasi_kas`
--
ALTER TABLE `tb_mutasi_kas`
  MODIFY `kd_mutasi_kas` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tb_owner`
--
ALTER TABLE `tb_owner`
  MODIFY `kd_owner` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tb_penyewa`
--
ALTER TABLE `tb_penyewa`
  MODIFY `kd_penyewa` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `tb_recommended`
--
ALTER TABLE `tb_recommended`
  MODIFY `kd_recommended` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_request_listing`
--
ALTER TABLE `tb_request_listing`
  MODIFY `kd_request_listing` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_reservasi`
--
ALTER TABLE `tb_reservasi`
  MODIFY `kd_reservasi` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `tb_task`
--
ALTER TABLE `tb_task`
  MODIFY `kd_task` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `kd_transaksi` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=125;
--
-- AUTO_INCREMENT for table `tb_transaksi_umum`
--
ALTER TABLE `tb_transaksi_umum`
  MODIFY `kd_transaksi_umum` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tb_unit`
--
ALTER TABLE `tb_unit`
  MODIFY `kd_unit` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_blacklist`
--
ALTER TABLE `tb_blacklist`
ADD CONSTRAINT `tb_blacklist_ibfk_1` FOREIGN KEY (`kd_penyewa`) REFERENCES `tb_penyewa` (`kd_penyewa`);

--
-- Ketidakleluasaan untuk tabel `tb_catatan`
--
ALTER TABLE `tb_catatan`
ADD CONSTRAINT `tb_catatan_ibfk_1` FOREIGN KEY (`kd_unit`) REFERENCES `tb_unit` (`kd_unit`);

--
-- Ketidakleluasaan untuk tabel `tb_confirm_transaksi`
--
ALTER TABLE `tb_confirm_transaksi`
ADD CONSTRAINT `tb_confirm_transaksi_ibfk_1` FOREIGN KEY (`kd_unit`) REFERENCES `tb_unit` (`kd_unit`),
ADD CONSTRAINT `tb_confirm_transaksi_ibfk_2` FOREIGN KEY (`kd_apt`) REFERENCES `tb_apt` (`kd_apt`),
ADD CONSTRAINT `tb_confirm_transaksi_ibfk_3` FOREIGN KEY (`kd_penyewa`) REFERENCES `tb_penyewa` (`kd_penyewa`),
ADD CONSTRAINT `tb_confirm_transaksi_ibfk_5` FOREIGN KEY (`kd_booking`) REFERENCES `tb_booking_via` (`kd_booking`),
ADD CONSTRAINT `tb_confirm_transaksi_ibfk_6` FOREIGN KEY (`kd_kas`) REFERENCES `tb_kas` (`kd_kas`);

--
-- Ketidakleluasaan untuk tabel `tb_detail_unit`
--
ALTER TABLE `tb_detail_unit`
ADD CONSTRAINT `tb_detail_unit_ibfk_1` FOREIGN KEY (`kd_unit`) REFERENCES `tb_unit` (`kd_unit`);

--
-- Ketidakleluasaan untuk tabel `tb_mod_calendar`
--
ALTER TABLE `tb_mod_calendar`
ADD CONSTRAINT `tb_mod_calendar_ibfk_1` FOREIGN KEY (`kd_unit`) REFERENCES `tb_unit` (`kd_unit`);

--
-- Ketidakleluasaan untuk tabel `tb_mutasi_kas`
--
ALTER TABLE `tb_mutasi_kas`
ADD CONSTRAINT `tb_mutasi_kas_ibfk_1` FOREIGN KEY (`kd_kas`) REFERENCES `tb_kas` (`kd_kas`);

--
-- Ketidakleluasaan untuk tabel `tb_owner`
--
ALTER TABLE `tb_owner`
ADD CONSTRAINT `tb_owner_ibfk_3` FOREIGN KEY (`kd_bank`) REFERENCES `tb_bank` (`kd_bank`),
ADD CONSTRAINT `tb_owner_ibfk_4` FOREIGN KEY (`username`) REFERENCES `tb_user` (`username`);

--
-- Ketidakleluasaan untuk tabel `tb_recommended`
--
ALTER TABLE `tb_recommended`
ADD CONSTRAINT `tb_recommended_ibfk_1` FOREIGN KEY (`kd_penyewa`) REFERENCES `tb_penyewa` (`kd_penyewa`);

--
-- Ketidakleluasaan untuk tabel `tb_task_unit`
--
ALTER TABLE `tb_task_unit`
ADD CONSTRAINT `tb_task_unit_ibfk_1` FOREIGN KEY (`kd_unit`) REFERENCES `tb_unit` (`kd_unit`),
ADD CONSTRAINT `tb_task_unit_ibfk_2` FOREIGN KEY (`kd_task`) REFERENCES `tb_task` (`kd_task`);

--
-- Ketidakleluasaan untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
ADD CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`kd_penyewa`) REFERENCES `tb_penyewa` (`kd_penyewa`),
ADD CONSTRAINT `tb_transaksi_ibfk_2` FOREIGN KEY (`kd_unit`) REFERENCES `tb_unit` (`kd_unit`),
ADD CONSTRAINT `tb_transaksi_ibfk_3` FOREIGN KEY (`kd_apt`) REFERENCES `tb_apt` (`kd_apt`),
ADD CONSTRAINT `tb_transaksi_ibfk_6` FOREIGN KEY (`kd_booking`) REFERENCES `tb_booking_via` (`kd_booking`),
ADD CONSTRAINT `tb_transaksi_ibfk_7` FOREIGN KEY (`kd_kas`) REFERENCES `tb_kas` (`kd_kas`);

--
-- Ketidakleluasaan untuk tabel `tb_unit`
--
ALTER TABLE `tb_unit`
ADD CONSTRAINT `tb_unit_ibfk_1` FOREIGN KEY (`kd_apt`) REFERENCES `tb_apt` (`kd_apt`),
ADD CONSTRAINT `tb_unit_ibfk_2` FOREIGN KEY (`kd_owner`) REFERENCES `tb_owner` (`kd_owner`);

--
-- Ketidakleluasaan untuk tabel `tb_unit_kotor`
--
ALTER TABLE `tb_unit_kotor`
ADD CONSTRAINT `tb_unit_kotor_ibfk_1` FOREIGN KEY (`kd_unit`) REFERENCES `tb_unit` (`kd_unit`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
