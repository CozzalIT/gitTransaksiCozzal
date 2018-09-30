-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Inang: localhost
-- Waktu pembuatan: 30 Sep 2018 pada 09.17
-- Versi Server: 5.5.61-0ubuntu0.14.04.1
-- Versi PHP: 5.5.9-1ubuntu4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `db_keuangan_cozzal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_apt`
--

CREATE TABLE IF NOT EXISTS `tb_apt` (
  `kd_apt` int(4) NOT NULL AUTO_INCREMENT,
  `nama_apt` varchar(30) NOT NULL,
  `alamat_apt` varchar(50) NOT NULL,
  PRIMARY KEY (`kd_apt`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `tb_apt`
--

INSERT INTO `tb_apt` (`kd_apt`, `nama_apt`, `alamat_apt`) VALUES
(1, 'Newton Hybrid Residence', 'Buah Batu'),
(6, 'The Jarrdin', 'Cihampelas'),
(7, 'Gateway Ahmad Yani', 'Cicadas'),
(8, 'Metro The Suit', 'Soekarno Hatta');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bank`
--

CREATE TABLE IF NOT EXISTS `tb_bank` (
  `kd_bank` int(4) NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(20) NOT NULL,
  PRIMARY KEY (`kd_bank`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

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
  `kd_blacklist` int(11) NOT NULL AUTO_INCREMENT,
  `kd_penyewa` int(4) NOT NULL,
  `reason_bl` varchar(50) NOT NULL,
  PRIMARY KEY (`kd_blacklist`),
  KEY `kd_nama` (`kd_penyewa`),
  KEY `kd_nama_2` (`kd_penyewa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_booked`
--

CREATE TABLE IF NOT EXISTS `tb_booked` (
  `kd_booked` int(4) NOT NULL AUTO_INCREMENT,
  `kd_unit` int(4) DEFAULT NULL,
  `kd_apt` int(4) DEFAULT NULL,
  `penyewa` varchar(25) DEFAULT NULL,
  `no_tlp` varchar(20) DEFAULT NULL,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `kd_url` int(4) DEFAULT NULL,
  PRIMARY KEY (`kd_booked`),
  KEY `kd_unit` (`kd_unit`),
  KEY `kd_apt` (`kd_apt`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=362 ;

--
-- Dumping data untuk tabel `tb_booked`
--

INSERT INTO `tb_booked` (`kd_booked`, `kd_unit`, `kd_apt`, `penyewa`, `no_tlp`, `check_in`, `check_out`, `status`, `kd_url`) VALUES
(11, 12, 1, 'Beben Sugeh', ' +62 878 7085 3368', '2019-01-11', '2019-01-12', '0', NULL),
(12, 12, 1, 'Enrico Chendra', ' +62 813 1593 1132', '2018-01-18', '2018-01-19', '0', NULL),
(13, 12, 1, 'Jonathan Edward Hartono', ' +62 877 8240 3933', '2018-02-18', '2018-02-19', '0', NULL),
(14, 12, 1, 'Muhamad Lokman', ' +60 12 796 7065', '2018-02-19', '2018-02-23', '0', NULL),
(15, 19, 1, 'Herman Ferdiansyah', ' +62 812 1000 2299', '2018-01-13', '2018-01-14', '0', NULL),
(16, 19, 1, 'Pipi Zacky', ' +62 899 771 1282', '2018-01-20', '2018-01-21', '0', NULL),
(17, 19, 1, 'Agnes Jessica', ' +62 812 901 3821', '2018-01-27', '2018-01-28', '0', NULL),
(18, 19, 1, 'Hasan Fitrahman', ' +62 878 7086 4498', '2018-02-17', '2018-02-18', '0', NULL),
(19, 20, 7, 'Toha Lane', ' +62 811 881 440', '2018-01-10', '2018-01-11', '0', NULL),
(20, 20, 7, 'Andreas Andreas', ' +62 878 7888 2599', '2018-01-20', '2018-01-21', '0', NULL),
(21, 20, 7, 'Tereza Kavinska', ' +62 858 9469 2205', '2018-01-26', '2018-01-27', '0', NULL),
(22, 9, 1, 'Alhavid Adrian', ' +62 812 3767 7750', '2018-01-08', '2018-01-11', '0', NULL),
(23, 9, 1, 'Dinda Hapsari', ' +62 811 978 2600', '2018-01-13', '2018-01-14', '0', NULL),
(24, 9, 1, 'Bambang Widodo', ' +62 817 900 5746', '2018-01-20', '2018-01-22', '0', NULL),
(25, 9, 1, 'Dhimas Prasetya', ' +62 812 1852 4676', '2018-01-27', '2018-01-28', '0', NULL),
(26, 9, 1, 'Delfina Paramita', ' +62 812 909 1669', '2018-02-24', '2018-02-25', '0', NULL),
(27, 9, 1, 'Mirda Damayanti', ' +62 878 8060 7758', '2018-03-23', '2018-03-25', '0', NULL),
(29, 22, 7, 'Nadine Maulida', ' +62 812 3875 1862', '2018-02-21', '2018-02-23', '0', NULL),
(30, 22, 7, 'Sekar W Farrythama', ' +62 812 940 9194', '2018-02-24', '2018-02-25', '0', NULL),
(31, 23, 6, 'Adriena Amoretta', ' +62 816 516 163', '2018-01-07', '2018-01-08', '0', NULL),
(32, 23, 6, 'M. Iqbal Anshory', ' +62 852 4229 3933', '2018-01-08', '2018-01-10', '0', NULL),
(33, 23, 6, 'Dewi Putri Ibnu', ' +62 857 3977 8938', '2018-01-12', '2018-01-14', '0', NULL),
(34, 23, 6, 'Galuh Hapsari', ' +62 856 9222 2129', '2018-01-14', '2018-01-17', '0', NULL),
(35, 23, 6, 'Stephen Harris', ' +62 878 8550 3590', '2018-01-27', '2018-01-28', '0', NULL),
(36, 23, 6, 'Asmee Fadhilaa', ' +62 878 8562 5232', '2018-02-16', '2018-02-17', '0', NULL),
(37, 24, 1, 'Canesya Adzani', ' +62 878 8525 2852', '2018-01-20', '2018-01-21', '0', NULL),
(38, 24, 1, 'Shervynn Lee', ' +60 14 671 3997', '2018-02-16', '2018-02-19', '0', NULL),
(39, 25, 1, 'Dea Azalia', ' +62 899 747 0324', '2018-03-24', '2018-03-25', '0', NULL),
(40, 11, 1, 'Aprianto Arisetiaji', ' +62 812 943 4455', '2018-01-20', '2018-01-21', '0', NULL),
(41, 11, 1, 'Ardita Amanda', ' +62 857 1628 7172', '2018-01-26', '2018-01-28', '0', NULL),
(68, 23, 6, 'Maisarah Kamal', ' +60 19 386 4352', '2018-02-03', '2018-02-06', '0', NULL),
(149, 24, 1, 'Rika Ikeda', ' +62 812 2042 7936', '2018-06-29', '2018-07-06', '0', 19),
(325, 12, 1, 'Sofian Alim', ' +62 812 2010 7297', '2018-07-06', '2018-07-08', '0', 55),
(327, 22, 7, 'Afrizal Muharam', ' +62 819 3696 9932', '2018-07-15', '2018-07-17', '0', 57),
(361, 12, 1, 'Fahmi Kurniawan', ' +62 821 1843 1589', '2018-06-12', '2018-06-13', '0', 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_booking_via`
--

CREATE TABLE IF NOT EXISTS `tb_booking_via` (
  `kd_booking` int(5) NOT NULL AUTO_INCREMENT,
  `booking_via` varchar(25) NOT NULL,
  PRIMARY KEY (`kd_booking`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `tb_booking_via`
--

INSERT INTO `tb_booking_via` (`kd_booking`, `booking_via`) VALUES
(1, 'Offline'),
(3, 'Airbnb'),
(8, 'Security'),
(9, 'Travelio');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_catatan`
--

CREATE TABLE IF NOT EXISTS `tb_catatan` (
  `kd_catatan` int(4) NOT NULL AUTO_INCREMENT,
  `kd_unit` int(4) DEFAULT NULL,
  `catatan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kd_catatan`),
  KEY `kd_unit` (`kd_unit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_unit`
--

CREATE TABLE IF NOT EXISTS `tb_detail_unit` (
  `kd_detail_unit` int(4) NOT NULL AUTO_INCREMENT,
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
  `isi` char(1) NOT NULL,
  PRIMARY KEY (`kd_detail_unit`),
  KEY `kd_unit` (`kd_unit`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `tb_detail_unit`
--

INSERT INTO `tb_detail_unit` (`kd_detail_unit`, `kd_unit`, `lantai`, `jml_kmr`, `jml_bed`, `jml_ac`, `water_heater`, `dapur`, `wifi`, `tv`, `amenities`, `merokok`, `type`, `img`, `isi`) VALUES
(1, 11, 12, 2, 5, 1, 'Y', 'Y', 'Y', 'Y', 'N', 'N', '', '2502180116230.png', ''),
(2, 12, 16, 2, 4, 2, 'Y', 'Y', 'Y', 'Y', 'Y', 'N', '', 'None', ''),
(3, 9, 9, 2, 3, 3, 'Y', 'Y', 'Y', 'N', 'N', 'N', '2BR', '1602182333430.12', 'Y'),
(4, 24, 8, 2, 2, 3, 'Y', 'Y', 'Y', 'N', 'N', 'N', '2BR', '1702180019400.12', 'Y'),
(5, 19, 18, 2, 4, 2, 'Y', 'Y', 'Y', 'N', 'N', 'N', '2BR', '2302181012090.12', 'Y'),
(6, 23, 1, 2, 5, 1, 'Y', 'Y', 'N', 'N', 'N', 'N', '2BR', 'None', 'Y'),
(7, 20, 7, 2, 4, 1, 'Y', 'Y', 'N', 'Y', 'N', 'N', '2BR', '2102180035180.jpg', 'Y'),
(8, 22, 0, 0, 0, 0, 'X', 'X', 'X', 'X', 'X', 'X', 'X', '2102180035580.jpg', 'N'),
(9, 29, 3, 1, 2, 1, 'Y', 'Y', 'N', 'N', 'N', 'N', '1BR', 'None', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kas`
--

CREATE TABLE IF NOT EXISTS `tb_kas` (
  `kd_kas` int(4) NOT NULL AUTO_INCREMENT,
  `sumber_dana` varchar(20) NOT NULL,
  `saldo` int(20) NOT NULL,
  `tanggal` datetime NOT NULL,
  PRIMARY KEY (`kd_kas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data untuk tabel `tb_kas`
--

INSERT INTO `tb_kas` (`kd_kas`, `sumber_dana`, `saldo`, `tanggal`) VALUES
(5, 'Danamon', 70309086, '2018-09-22 08:01:15'),
(7, 'Mandiri', -2912800, '2018-07-27 13:03:18'),
(9, 'BNI', 4839000, '2018-09-22 08:01:56'),
(12, 'Cash Operasional', 12082938, '2018-08-25 11:04:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_logs_system`
--

CREATE TABLE IF NOT EXISTS `tb_logs_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `actions` varchar(255) NOT NULL,
  `tables` varchar(30) NOT NULL,
  `users` varchar(255) NOT NULL,
  `descriptions` text NOT NULL,
  `contents` text NOT NULL,
  `conditions` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=89 ;

--
-- Dumping data untuk tabel `tb_logs_system`
--

INSERT INTO `tb_logs_system` (`id`, `actions`, `tables`, `users`, `descriptions`, `contents`, `conditions`, `created_at`) VALUES
(1, 'Tambah user', 'tb_user', '{"username":"admin1","hak_akses":"superadmin","status":"3"}', 'Menambahkan akun baru', '{"username":"adminasdfasd","status":"3","hak_akses":"admin"}', '', '2018-06-20 20:10:12'),
(3, 'Ubah status user', 'tb_user', '{"username":"admin1","hak_akses":"superadmin","status":"3"}', 'Ubah status user menjadi 3', '{"username":"adminasdfasd","status":"3"}', '', '2018-06-21 03:18:24'),
(4, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["2018-07-15"]', '', '2018-07-15 17:00:50'),
(5, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["9","2018-07-15"]', '', '2018-07-15 17:00:51'),
(6, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["12","2018-07-15"]', '', '2018-07-15 17:00:51'),
(7, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["23","2018-07-15"]', '', '2018-07-15 17:00:51'),
(8, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["24","2018-07-15"]', '', '2018-07-15 17:00:51'),
(9, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["29","2018-07-15"]', '', '2018-07-15 17:00:51'),
(10, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["2018-07-15"]', '', '2018-07-15 17:01:04'),
(11, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["9","2018-07-15"]', '', '2018-07-15 17:01:05'),
(12, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["12","2018-07-15"]', '', '2018-07-15 17:01:05'),
(13, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["23","2018-07-15"]', '', '2018-07-15 17:01:05'),
(14, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["24","2018-07-15"]', '', '2018-07-15 17:01:05'),
(15, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["29","2018-07-15"]', '', '2018-07-15 17:01:06'),
(16, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["2018-07-15"]', '', '2018-07-15 17:02:29'),
(17, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["9","2018-07-15"]', '', '2018-07-15 17:02:31'),
(18, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["12","2018-07-15"]', '', '2018-07-15 17:02:31'),
(19, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["23","2018-07-15"]', '', '2018-07-15 17:02:31'),
(20, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["24","2018-07-15"]', '', '2018-07-15 17:02:31'),
(21, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["29","2018-07-15"]', '', '2018-07-15 17:02:31'),
(22, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["2018-07-15"]', '', '2018-07-15 17:03:12'),
(23, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["9","2018-07-15"]', '', '2018-07-15 17:03:13'),
(24, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["12","2018-07-15"]', '', '2018-07-15 17:03:13'),
(25, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["23","2018-07-15"]', '', '2018-07-15 17:03:13'),
(26, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["24","2018-07-15"]', '', '2018-07-15 17:03:13'),
(27, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["29","2018-07-15"]', '', '2018-07-15 17:03:13'),
(28, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["12","18"]', '', '2018-07-15 17:03:31'),
(29, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["12","19"]', '', '2018-07-15 17:03:31'),
(30, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["12","20"]', '', '2018-07-15 17:03:31'),
(31, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["12","22"]', '', '2018-07-15 17:03:31'),
(32, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["12","23"]', '', '2018-07-15 17:03:31'),
(33, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["12","25"]', '', '2018-07-15 17:03:31'),
(34, 'Update', 'tb_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data unit', '["12","2018-07-15"]', '', '2018-07-15 17:03:31'),
(35, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["12","2018-07-15"]', '', '2018-07-15 17:03:31'),
(36, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["2018-07-15"]', '', '2018-07-15 17:04:33'),
(37, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["9","2018-07-15"]', '', '2018-07-15 17:04:34'),
(38, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["23","2018-07-15"]', '', '2018-07-15 17:04:34'),
(39, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["24","2018-07-15"]', '', '2018-07-15 17:04:35'),
(40, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["29","2018-07-15"]', '', '2018-07-15 17:04:35'),
(41, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["2018-07-15"]', '', '2018-07-15 17:19:22'),
(42, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["9","2018-07-15"]', '', '2018-07-15 17:19:24'),
(43, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["23","2018-07-15"]', '', '2018-07-15 17:19:24'),
(44, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["24","2018-07-15"]', '', '2018-07-15 17:19:24'),
(45, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["29","2018-07-15"]', '', '2018-07-15 17:19:24'),
(46, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["2018-07-15"]', '', '2018-07-15 17:21:27'),
(47, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["23","2018-07-15"]', '', '2018-07-15 17:21:28'),
(48, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["9","2018-07-15"]', '', '2018-07-15 17:21:28'),
(49, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["29","2018-07-15"]', '', '2018-07-15 17:21:29'),
(50, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["24","2018-07-15"]', '', '2018-07-15 17:21:29'),
(51, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["9","18"]', '', '2018-07-15 17:21:42'),
(52, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["9","19"]', '', '2018-07-15 17:21:42'),
(53, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["9","20"]', '', '2018-07-15 17:21:42'),
(54, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["9","22"]', '', '2018-07-15 17:21:42'),
(55, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["9","23"]', '', '2018-07-15 17:21:42'),
(56, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["9","25"]', '', '2018-07-15 17:21:42'),
(57, 'Update', 'tb_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data unit', '["9","2018-07-15"]', '', '2018-07-15 17:21:42'),
(58, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["9","2018-07-15"]', '', '2018-07-15 17:21:42'),
(59, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["2018-07-15"]', '', '2018-07-15 17:21:46'),
(60, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["23","2018-07-15"]', '', '2018-07-15 17:21:48'),
(61, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["29","2018-07-15"]', '', '2018-07-15 17:21:48'),
(62, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["24","2018-07-15"]', '', '2018-07-15 17:21:48'),
(63, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["2018-07-15"]', '', '2018-07-15 23:13:42'),
(64, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["23","2018-07-15"]', '', '2018-07-15 23:13:43'),
(65, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["29","2018-07-15"]', '', '2018-07-15 23:13:43'),
(66, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["24","2018-07-15"]', '', '2018-07-15 23:13:43'),
(67, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["23","18"]', '', '2018-07-15 23:13:56'),
(68, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["23","19"]', '', '2018-07-15 23:13:56'),
(69, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["23","20"]', '', '2018-07-15 23:13:56'),
(70, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["23","21"]', '', '2018-07-15 23:13:56'),
(71, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["23","22"]', '', '2018-07-15 23:13:56'),
(72, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["23","23"]', '', '2018-07-15 23:13:56'),
(73, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["23","25"]', '', '2018-07-15 23:13:56'),
(74, 'Update', 'tb_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data unit', '["23","2018-07-15"]', '', '2018-07-15 23:13:56'),
(75, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["23","2018-07-15"]', '', '2018-07-15 23:13:56'),
(76, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["2018-07-15"]', '', '2018-07-15 23:14:07'),
(77, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["24","2018-07-15"]', '', '2018-07-15 23:14:09'),
(78, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["29","2018-07-15"]', '', '2018-07-15 23:14:09'),
(79, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["24","18"]', '', '2018-07-15 23:14:21'),
(80, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["24","19"]', '', '2018-07-15 23:14:21'),
(81, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["24","20"]', '', '2018-07-15 23:14:21'),
(82, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["24","22"]', '', '2018-07-15 23:14:21'),
(83, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["24","23"]', '', '2018-07-15 23:14:21'),
(84, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["24","25"]', '', '2018-07-15 23:14:21'),
(85, 'Update', 'tb_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data unit', '["24","2018-07-15"]', '', '2018-07-15 23:14:21'),
(86, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["24","2018-07-15"]', '', '2018-07-15 23:14:21'),
(87, 'Delete', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Delete data task unit', '["2018-07-15"]', '', '2018-07-15 23:14:25'),
(88, 'Update', 'tb_task_unit', '{"username":null,"hak_akses":null,"status":null}', 'Update data task unit', '["29","2018-07-15"]', '', '2018-07-15 23:14:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mod_calendar`
--

CREATE TABLE IF NOT EXISTS `tb_mod_calendar` (
  `kd_mod_calendar` int(4) NOT NULL AUTO_INCREMENT,
  `kd_unit` int(4) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `note` varchar(30) NOT NULL,
  `jenis` char(1) NOT NULL COMMENT '1:maintenance, 2:owner_blok, 3:admin_blok',
  PRIMARY KEY (`kd_mod_calendar`),
  KEY `kd_unit` (`kd_unit`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=445 ;

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
(31, 9, '0000-00-00', '0000-00-00', '', '1'),
(32, 25, '2018-03-01', '2018-03-31', 'masih bocor', '1'),
(33, 20, '2018-05-03', '2018-05-09', 'dipake bu nurul', '3'),
(34, 22, '2018-05-03', '2018-05-09', 'dipake bu susan', '3'),
(41, 19, '2018-04-04', '2018-04-05', 'tante lena pindahan 12bd semal', '3'),
(42, 24, '2018-04-04', '2018-04-06', 'dipake pak iwan ', '3'),
(94, 12, '2018-04-16', '2018-04-16', 'Dipake Pak Frans', '3'),
(95, 23, '2018-04-16', '2018-04-18', 'benerin wastafel yang bocor', '1'),
(96, 12, '2018-04-17', '2018-04-17', 'Self blocked', '2'),
(107, 23, '2018-05-01', '2018-05-02', 'Pintu Kamar Utama Lepas', '1'),
(113, 20, '2018-05-12', '2018-05-13', 'dipake bu nurul', ''),
(114, 20, '2018-05-12', '2018-05-13', 'dipake bu nurul', ''),
(115, 20, '2018-05-12', '2018-05-12', 'Dipaké Bu Nurul', '3'),
(130, 23, '2018-06-09', '2018-06-09', 'Maintenance', '3'),
(131, 23, '0000-00-00', '0000-00-00', '', '3'),
(147, 29, '2018-06-20', '2018-06-21', 'Biar pamela ga early chek in', '1'),
(151, 22, '2018-06-29', '2018-06-29', 'Maintenance hg ad yg anter kun', '1'),
(152, 29, '2018-07-02', '2018-07-02', 'cc bu anna', '3'),
(153, 29, '2018-07-02', '2018-07-02', 'cc bu anna', '3'),
(154, 29, '2018-07-05', '2018-07-05', 'maintence by anna', '3'),
(155, 20, '2018-07-07', '2018-07-07', 'tamu bu nurul,nu nurul lagi di', '3'),
(240, 23, '2018-07-19', '2018-07-21', 'maintenance', '1'),
(437, 23, '2018-07-23', '2018-07-23', 'cc bu anna', '1'),
(438, 19, '2018-09-09', '2018-09-11', 'BEbas', '2'),
(439, 11, '2018-09-11', '2018-09-20', 'Tes21', '3'),
(443, 23, '2018-09-27', '2018-09-28', 'hh', '2'),
(444, 19, '2018-09-17', '2018-09-18', 'j', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mod_harga`
--

CREATE TABLE IF NOT EXISTS `tb_mod_harga` (
  `kd_mod_harga` int(4) NOT NULL AUTO_INCREMENT,
  `kd_unit` int(4) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `harga_sewa` int(20) NOT NULL,
  `harga_owner` int(20) NOT NULL,
  `note` varchar(30) NOT NULL,
  PRIMARY KEY (`kd_mod_harga`),
  KEY `kd_unit` (`kd_unit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mutasi_kas`
--

CREATE TABLE IF NOT EXISTS `tb_mutasi_kas` (
  `kd_mutasi_kas` int(4) NOT NULL AUTO_INCREMENT,
  `kd_kas` int(4) NOT NULL,
  `mutasi_dana` int(20) NOT NULL,
  `jenis` char(1) NOT NULL COMMENT '1:masuk, 2:keluar',
  `tanggal` datetime NOT NULL,
  `keterangan` varchar(15) NOT NULL COMMENT '1:kas, 2:non-kas, 3:TU, 4:owner, 5:karyawan, 6:Transaksi, 7:Pembayaran, 8:Setlement, 9:tUnitL, 10:tUnitBL ',
  PRIMARY KEY (`kd_mutasi_kas`),
  KEY `kd_kas` (`kd_kas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=783 ;

--
-- Dumping data untuk tabel `tb_mutasi_kas`
--

INSERT INTO `tb_mutasi_kas` (`kd_mutasi_kas`, `kd_kas`, `mutasi_dana`, `jenis`, `tanggal`, `keterangan`) VALUES
(22, 5, 4503000, '1', '2018-03-10 13:46:46', '2'),
(26, 5, 0, '1', '2018-03-10 17:43:13', '6/93'),
(27, 5, 0, '1', '2018-03-10 17:46:30', '6/66'),
(28, 5, 7000000, '1', '2018-03-10 17:50:03', '6/88'),
(29, 5, 0, '1', '2018-03-10 18:13:48', '6/120'),
(30, 5, 0, '1', '2018-03-10 18:14:43', '6/119'),
(31, 5, -7000000, '1', '2018-03-10 18:17:11', '2'),
(32, 5, 600000, '1', '2018-03-10 19:28:33', '6/125'),
(33, 5, 0, '1', '2018-03-10 19:29:27', '6/126'),
(34, 5, 400000, '1', '2018-03-10 21:30:20', '6/111'),
(35, 5, 800000, '1', '2018-03-10 21:32:00', '6/127'),
(38, 5, 0, '1', '2018-03-10 21:46:36', '6/129'),
(40, 5, 375000, '1', '2018-03-10 21:53:42', '6/96'),
(41, 5, 0, '1', '2018-03-10 21:54:05', '6/101'),
(42, 5, 0, '1', '2018-03-10 21:57:14', '6/130'),
(43, 5, 450000, '1', '2018-03-10 21:58:16', '6/98'),
(44, 5, 0, '1', '2018-03-10 22:01:44', '6/131'),
(49, 12, 1000000, '1', '2018-03-11 15:02:24', '2'),
(51, 5, 0, '1', '2018-03-11 17:03:42', '6/102'),
(52, 5, 0, '1', '2018-03-12 16:26:55', '6/135'),
(53, 5, 0, '1', '2018-03-12 16:29:19', '6/128'),
(55, 5, 0, '1', '2018-03-12 16:34:03', '6/137'),
(56, 12, 137500, '2', '2018-03-13 16:46:23', '9/12'),
(57, 12, 177600, '2', '2018-03-13 16:47:46', '3'),
(58, 12, 300000, '2', '2018-03-13 16:48:41', '3'),
(59, 5, 200000, '1', '2018-03-14 09:02:59', '6/138'),
(60, 7, 0, '1', '2018-03-14 09:08:22', '6/139'),
(61, 5, 0, '1', '2018-03-18 14:10:34', '6/142'),
(62, 7, 0, '1', '2018-03-18 14:21:06', '6/143'),
(63, 5, 0, '1', '2018-03-18 14:26:46', '6/144'),
(65, 5, 0, '1', '2018-03-19 13:19:06', '6/118'),
(66, 5, 25000, '2', '2018-03-19 13:59:56', '8/138'),
(67, 5, 100000, '1', '2018-03-19 16:55:57', '6/211'),
(68, 5, 100000, '1', '2018-03-19 16:59:20', '6/213'),
(69, 5, 100000, '2', '2018-03-19 17:00:20', '8/213'),
(71, 7, 280000, '1', '2018-03-19 22:18:03', '6/214'),
(72, 5, 400000, '1', '2018-03-19 23:02:10', '7/137'),
(73, 9, 800000, '1', '2018-03-19 23:03:26', '7/135'),
(74, 9, 1750000, '1', '2018-03-19 23:04:14', '7/128'),
(75, 7, 700000, '1', '2018-03-19 23:04:58', '7/118'),
(76, 5, 300000, '1', '2018-03-19 23:05:21', '7/117'),
(77, 5, 339500, '1', '2018-03-19 23:07:26', '7/114'),
(78, 5, 375000, '1', '2018-03-19 23:09:59', '7/105'),
(79, 5, 0, '1', '2018-03-19 23:10:43', '6/105'),
(80, 9, 200000, '1', '2018-03-19 23:11:54', '7/105'),
(81, 5, 0, '1', '2018-03-19 23:13:33', '6/115'),
(82, 5, 776000, '1', '2018-03-19 23:13:56', '7/115'),
(83, 5, 383150, '1', '2018-03-19 23:14:58', '7/113'),
(84, 5, 373450, '1', '2018-03-19 23:15:48', '7/110'),
(85, 5, 350000, '1', '2018-03-19 23:16:58', '7/98'),
(86, 5, 400000, '1', '2018-03-20 08:18:25', '7/109'),
(87, 5, 400000, '1', '2018-03-20 08:19:58', '7/108'),
(88, 12, 1100000, '1', '2018-03-20 09:31:50', '2'),
(89, 12, 36400, '2', '2018-03-20 09:32:53', '3'),
(90, 12, 20000, '2', '2018-03-20 09:33:37', '3'),
(93, 12, 100000, '1', '2018-03-20 10:06:18', '6/215'),
(94, 12, -1100000, '1', '2018-03-20 10:07:40', '2'),
(95, 9, 1000000, '2', '2018-03-20 10:08:04', '1'),
(96, 12, 1000000, '1', '2018-03-20 10:08:04', '1'),
(97, 12, 42000, '2', '2018-03-20 15:15:05', '3'),
(98, 12, 100000, '2', '2018-03-20 15:19:34', '3'),
(99, 12, -1600, '1', '2018-03-20 15:51:39', '2'),
(103, 12, 200000, '1', '2018-03-20 17:02:04', '2'),
(106, 7, 635000, '1', '2018-03-21 08:57:38', '6/217'),
(107, 9, -380000, '1', '2018-03-21 08:58:15', '7/217'),
(108, 12, 137500, '2', '2018-03-21 13:57:53', '10/19'),
(109, 5, 0, '1', '2018-03-22 13:42:29', '6/103'),
(110, 7, 400000, '1', '2018-03-22 15:15:03', '6/220'),
(111, 5, 250000, '1', '2018-03-23 08:35:27', '7/215'),
(112, 5, 0, '1', '2018-03-23 08:40:10', '6/145'),
(113, 5, 373450, '1', '2018-03-23 08:40:27', '7/145'),
(114, 5, 350000, '1', '2018-03-23 08:42:56', '7/218'),
(115, 5, 590000, '2', '2018-03-23 09:38:46', '9/24'),
(116, 5, 587500, '2', '2018-03-23 09:39:37', '9/9'),
(117, 5, 434000, '2', '2018-03-23 09:40:21', '9/11'),
(118, 5, 338586, '2', '2018-03-23 09:41:16', '10/19'),
(119, 5, 375000, '1', '2018-03-23 14:36:28', '7/221'),
(120, 12, 105000, '2', '2018-03-23 15:11:43', '9/11'),
(121, 5, 275000, '2', '2018-03-23 17:11:55', '4'),
(122, 5, 275000, '2', '2018-03-23 17:13:06', '4'),
(123, 5, 2600000, '2', '2018-03-23 23:36:51', '4'),
(124, 5, 875000, '2', '2018-03-23 23:38:59', '4'),
(125, 7, 400000, '1', '2018-03-24 14:10:53', '7/224'),
(126, 12, 21500, '2', '2018-03-25 08:53:31', '3'),
(127, 12, 50000, '1', '2018-03-25 15:11:29', '7/212'),
(129, 12, 165000, '1', '2018-03-26 09:55:44', '2'),
(130, 5, 2200000, '2', '2018-03-26 10:23:56', '4'),
(131, 7, 600000, '2', '2018-03-26 13:37:10', '4'),
(132, 7, 300000, '2', '2018-03-26 13:44:35', '4'),
(133, 5, 1900000, '2', '2018-03-26 13:58:45', '4'),
(134, 5, 300000, '2', '2018-03-26 13:59:44', '4'),
(135, 5, 1100000, '2', '2018-03-26 14:31:21', '4'),
(136, 5, 825000, '2', '2018-03-26 14:32:29', '4'),
(142, 5, 300000, '1', '2018-03-27 09:42:26', '7/125'),
(143, 5, 400000, '1', '2018-03-27 09:43:02', '7/229'),
(144, 5, 339500, '1', '2018-03-27 10:54:47', '7/212'),
(145, 5, 611100, '1', '2018-03-27 10:55:35', '7/103'),
(146, 5, 100000, '1', '2018-03-27 13:40:16', '6/231'),
(147, 5, 50000, '1', '2018-03-27 13:44:37', '7/231'),
(148, 5, -50000, '1', '2018-03-27 13:48:54', '7/231'),
(149, 5, 100000, '2', '2018-03-27 13:49:17', '8/231'),
(151, 5, 0, '1', '2018-03-27 20:27:14', '6/173'),
(152, 5, 350000, '1', '2018-03-27 20:28:29', '6/232'),
(153, 5, 700000, '1', '2018-03-27 22:26:04', '6/216'),
(154, 5, 700000, '2', '2018-03-27 23:39:35', '8/216'),
(155, 5, 700000, '1', '2018-03-27 23:41:50', '6/234'),
(158, 7, 400000, '1', '2018-03-28 10:23:21', '6/235'),
(159, 5, 500000, '1', '2018-03-28 10:50:22', '6/236'),
(160, 5, 1200000, '1', '2018-03-28 11:02:28', '6/237'),
(161, 12, 68100, '2', '2018-03-28 12:36:27', '3'),
(162, 12, 7500, '2', '2018-03-28 12:37:00', '3'),
(163, 5, 339000, '1', '2018-03-29 18:26:59', '7/226'),
(164, 5, 500, '1', '2018-03-29 18:27:21', '7/226'),
(165, 7, 300000, '2', '2018-03-30 12:51:28', '4'),
(166, 7, 275000, '2', '2018-03-30 12:59:06', '4'),
(167, 12, 18800, '2', '2018-03-30 14:34:05', '9/22'),
(168, 12, 50000, '2', '2018-03-30 14:36:18', '10/19'),
(169, 12, 100000, '2', '2018-03-30 14:40:41', '3'),
(170, 12, 100000, '2', '2018-03-30 14:41:25', '3'),
(171, 12, 50000, '2', '2018-03-30 14:41:59', '3'),
(172, 12, 50000, '2', '2018-03-30 14:42:00', '3'),
(173, 12, 4500, '2', '2018-03-30 14:42:34', '3'),
(174, 12, 106000, '2', '2018-03-30 14:43:17', '3'),
(175, 12, 26600, '2', '2018-03-30 14:43:51', '3'),
(176, 9, 550000, '2', '2018-03-30 16:03:10', '4'),
(177, 5, 400000, '1', '2018-03-30 16:16:46', '7/236'),
(178, 12, 7500, '2', '2018-03-30 18:13:16', '3'),
(179, 12, 19500, '2', '2018-03-30 18:16:37', '3'),
(180, 9, 150000, '1', '2018-03-31 14:44:06', '6/239'),
(181, 9, 150000, '1', '2018-03-31 14:46:01', '6/240'),
(182, 9, 200000, '1', '2018-03-31 14:49:08', '6/241'),
(183, 5, 450000, '1', '2018-03-31 14:52:19', '6/242'),
(184, 12, 58600, '2', '2018-03-31 17:01:54', '3'),
(185, 7, 800000, '1', '2018-04-01 08:35:54', '7/219'),
(186, 5, 1600000, '1', '2018-04-01 09:23:56', '6/243'),
(188, 12, 130000, '2', '2018-04-01 15:38:33', '3'),
(189, 12, 20500, '2', '2018-04-01 15:39:13', '3'),
(190, 9, 150000, '1', '2018-04-01 15:39:43', '6/246'),
(191, 12, 19500, '2', '2018-04-01 15:42:01', '3'),
(192, 12, 25000, '1', '2018-04-01 15:45:11', '7/101'),
(194, 7, 600000, '2', '2018-04-02 08:31:25', '4'),
(195, 5, 378300, '1', '2018-04-02 08:54:59', '7/230'),
(196, 5, 766300, '1', '2018-04-02 08:56:33', '7/223'),
(197, 5, 1018500, '1', '2018-04-02 08:58:02', '7/102'),
(198, 5, 1100000, '2', '2018-04-02 09:26:40', '4'),
(201, 9, 3500000, '2', '2018-04-03 10:30:16', '4'),
(202, 12, 55000, '2', '2018-04-03 10:36:29', '3'),
(203, 5, 400000, '1', '2018-04-03 11:03:39', '6/251'),
(204, 9, 250000, '1', '2018-04-04 14:51:43', '7/246'),
(207, 7, 400000, '1', '2018-04-04 15:09:20', '6/252'),
(208, 5, 7000000, '1', '2018-04-04 16:41:07', '6/255'),
(209, 12, 1500000, '1', '2018-04-05 11:15:58', '2'),
(210, 12, 25500, '2', '2018-04-05 17:14:47', '3'),
(211, 7, 385000, '1', '2018-04-05 20:07:00', '6/259'),
(212, 12, 90000, '2', '2018-04-06 14:22:23', '3'),
(213, 12, 45000, '2', '2018-04-06 14:23:07', '3'),
(214, 5, 400000, '1', '2018-04-06 22:46:16', '6/260'),
(215, 5, 375000, '1', '2018-04-06 22:49:06', '6/261'),
(216, 5, 730805, '1', '2018-04-06 23:06:31', '7/101'),
(217, 12, 42000, '2', '2018-04-07 09:28:35', '3'),
(218, 12, 80000, '2', '2018-04-07 17:52:59', '3'),
(219, 12, 33500, '2', '2018-04-07 17:53:40', '3'),
(220, 12, 400000, '1', '2018-04-09 14:23:38', '7/258'),
(221, 12, 400000, '1', '2018-04-09 14:24:08', '7/253'),
(222, 5, 300000, '1', '2018-04-09 18:01:13', '6/274'),
(223, 12, 219800, '2', '2018-04-09 21:32:33', '3'),
(224, 12, 19800, '2', '2018-04-10 09:00:49', '3'),
(225, 12, 30000, '2', '2018-04-10 17:38:00', '3'),
(226, 5, 225000, '1', '2018-04-10 19:13:38', '6/278'),
(227, 5, 3711000, '2', '2018-04-10 19:26:30', '4'),
(228, 7, 375000, '1', '2018-04-11 12:03:03', '6/279'),
(229, 12, 100000, '2', '2018-04-11 12:03:17', '3'),
(231, 12, 1188000, '2', '2018-04-11 12:04:49', '3'),
(232, 12, 20000, '2', '2018-04-12 11:29:49', '3'),
(233, 12, 19200, '2', '2018-04-12 11:30:19', '3'),
(234, 5, -4000000, '1', '2018-04-12 14:55:34', '7/255'),
(235, 12, 50000, '2', '2018-04-12 15:34:53', '3'),
(236, 12, 75000, '2', '2018-04-13 17:17:06', '3'),
(237, 5, 425000, '1', '2018-04-14 10:41:46', '6/285'),
(238, 12, 105000, '2', '2018-04-14 18:35:43', '3'),
(239, 12, 50000, '2', '2018-04-14 18:36:20', '3'),
(241, 5, 339500, '1', '2018-04-15 03:16:08', '7/273'),
(242, 5, 339500, '1', '2018-04-15 03:18:05', '7/268'),
(243, 7, 540000, '2', '2018-04-15 03:19:59', '4'),
(244, 5, 400000, '1', '2018-04-15 09:03:15', '6/288'),
(245, 12, 52000, '2', '2018-04-15 09:24:11', '3'),
(248, 12, 200000, '1', '2018-04-15 10:37:57', '7/241'),
(249, 12, 230000, '1', '2018-04-15 10:38:20', '7/240'),
(250, 12, 220000, '1', '2018-04-15 10:40:01', '7/239'),
(251, 5, 373450, '1', '2018-04-16 00:19:03', '7/270'),
(252, 5, 388000, '1', '2018-04-16 00:19:44', '7/269'),
(253, 5, 194000, '1', '2018-04-16 00:20:21', '7/277'),
(254, 5, 291000, '1', '2018-04-16 00:21:38', '7/280'),
(255, 12, 43500, '2', '2018-04-16 16:43:56', '3'),
(256, 5, 400000, '1', '2018-04-17 09:26:46', '6/290'),
(258, 5, 6500000, '1', '2018-04-17 11:46:57', '6/291'),
(260, 5, 250000, '1', '2018-04-17 17:40:18', '6/293'),
(261, 7, 300000, '2', '2018-04-17 17:51:03', '4'),
(262, 12, 56500, '2', '2018-04-19 09:21:28', '3'),
(264, 5, 348800, '2', '2018-04-19 09:22:59', '3'),
(265, 5, 400000, '1', '2018-04-19 09:43:23', '6/295'),
(266, 5, 300000, '1', '2018-04-19 12:26:26', '6/297'),
(269, 5, 325000, '1', '2018-04-19 16:08:42', '6/298'),
(271, 12, 128000, '2', '2018-04-20 12:31:28', '3'),
(272, 5, 200000, '1', '2018-04-20 13:02:47', '6/301'),
(273, 5, 20000, '1', '2018-04-21 13:18:02', '6/303'),
(274, 5, 20000, '2', '2018-04-21 13:19:17', '8/303'),
(275, 5, 567450, '1', '2018-04-21 13:40:37', '7/284'),
(276, 12, 76900, '2', '2018-04-22 18:22:09', '3'),
(277, 12, 196000, '2', '2018-04-22 18:36:42', '3'),
(278, 5, 400000, '1', '2018-04-23 12:01:29', '6/306'),
(279, 5, 400000, '1', '2018-04-23 12:03:44', '6/307'),
(280, 9, 4800000, '2', '2018-04-23 12:15:56', '4'),
(281, 5, 407400, '1', '2018-04-23 12:18:52', '7/282'),
(282, 7, 800000, '1', '2018-04-23 12:20:48', '7/252'),
(283, 5, 383150, '1', '2018-04-23 12:22:06', '7/286'),
(284, 5, 378300, '1', '2018-04-23 12:23:04', '7/283'),
(285, 5, 339500, '1', '2018-04-23 12:24:00', '7/281'),
(286, 5, 1400000, '1', '2018-04-23 12:39:05', '6/287'),
(287, 5, 1400000, '1', '2018-04-23 12:43:11', '7/287'),
(288, 12, 200000, '1', '2018-04-23 12:46:46', '7/301'),
(289, 5, 450000, '1', '2018-04-23 12:47:37', '7/298'),
(290, 5, 400000, '1', '2018-04-23 12:48:48', '7/295'),
(291, 12, 100000, '1', '2018-04-23 20:03:47', '6/308'),
(292, 5, 400000, '1', '2018-04-24 13:13:28', '6/310'),
(295, 5, 400000, '1', '2018-04-24 13:15:18', '6/311'),
(296, 5, 350000, '1', '2018-04-24 13:18:25', '6/312'),
(298, 5, 200000, '1', '2018-04-24 16:35:21', '6/313'),
(299, 5, 200000, '1', '2018-04-25 09:18:25', '6/317'),
(300, 12, 300000, '1', '2018-04-25 15:38:50', '6/319'),
(301, 5, 0, '1', '2018-04-25 16:56:21', '7/320'),
(302, 5, 250000, '1', '2018-04-25 16:57:14', '6/320'),
(303, 5, 0, '1', '2018-04-25 16:57:24', '7/320'),
(304, 5, 400000, '1', '2018-04-25 16:59:43', '7/315'),
(305, 5, 0, '1', '2018-04-25 17:00:46', '7/315'),
(306, 5, 400000, '1', '2018-04-25 17:18:02', '7/267'),
(307, 5, 400000, '1', '2018-04-25 18:31:40', '6/321'),
(308, 5, 679000, '1', '2018-04-25 21:19:43', '7/302'),
(309, 5, 150000, '1', '2018-04-26 10:07:25', '7/320'),
(310, 5, 150000, '1', '2018-04-26 11:39:26', '7/313'),
(311, 5, 350000, '1', '2018-04-26 11:40:39', '7/314'),
(312, 5, 300000, '1', '2018-04-26 12:17:59', '7/318'),
(313, 12, 70700, '2', '2018-04-26 20:34:02', '3'),
(314, 5, 810000, '2', '2018-04-27 18:17:00', '4'),
(315, 5, 800000, '1', '2018-04-27 18:44:14', '7/324'),
(316, 5, 4410000, '2', '2018-04-27 18:49:23', '4'),
(317, 5, 375000, '1', '2018-04-27 18:51:51', '6/325'),
(318, 5, 375000, '1', '2018-04-27 19:09:17', '6/326'),
(319, 12, 150000, '2', '2018-04-28 09:03:40', '3'),
(320, 12, 29800, '2', '2018-04-28 09:04:16', '3'),
(321, 5, 400000, '1', '2018-04-28 12:20:08', '7/309'),
(322, 5, 400000, '1', '2018-04-28 12:23:22', '6/323'),
(323, 5, 400000, '1', '2018-04-28 12:49:32', '7/320'),
(324, 12, 250000, '1', '2018-04-28 15:59:41', '7/308'),
(325, 12, 150000, '1', '2018-04-28 16:01:51', '7/317'),
(327, 12, 175000, '2', '2018-04-28 16:05:10', '3'),
(328, 12, 51700, '2', '2018-04-28 17:06:29', '3'),
(329, 12, 25000, '1', '2018-04-29 10:35:38', '7/317'),
(330, 12, 75000, '1', '2018-04-29 12:57:10', '7/322'),
(331, 5, 430000, '1', '2018-04-29 13:53:10', '6/328'),
(332, 5, 350000, '1', '2018-04-29 18:16:14', '6/329'),
(333, 12, 137500, '2', '2018-04-29 20:33:22', '3'),
(334, 12, 61500, '2', '2018-04-29 21:00:49', '3'),
(335, 5, 400000, '1', '2018-04-30 00:19:29', '7/323'),
(336, 12, 31600, '2', '2018-04-30 11:35:36', '3'),
(337, 12, 50000, '2', '2018-04-30 16:20:10', '3'),
(338, 12, 22000, '2', '2018-04-30 16:20:59', '3'),
(339, 5, 600000, '1', '2018-05-01 08:13:56', '6/335'),
(340, 5, 407400, '1', '2018-05-01 09:20:47', '7/304'),
(341, 5, 644710, '2', '2018-05-01 09:30:32', '9/24'),
(342, 7, 2962500, '2', '2018-05-01 10:15:03', '4'),
(343, 5, 5255290, '2', '2018-05-01 11:05:12', '4'),
(344, 5, 1350000, '1', '2018-05-01 11:16:11', '7/330'),
(345, 5, 524886, '2', '2018-05-01 11:19:55', '9/11'),
(347, 12, 600000, '1', '2018-05-01 16:37:01', '7/335'),
(348, 12, 400000, '1', '2018-05-01 16:37:26', '6/334'),
(349, 5, 400000, '1', '2018-05-01 21:43:42', '7/309'),
(350, 5, 1341025, '1', '2018-05-02 08:03:34', '7/296'),
(351, 5, 776300, '1', '2018-05-02 08:04:15', '7/322'),
(352, 12, 23900, '2', '2018-05-02 08:56:47', '3'),
(354, 5, 1164000, '1', '2018-05-02 10:38:50', '7/294'),
(355, 5, 339500, '1', '2018-05-03 08:55:05', '7/332'),
(356, 7, 1181200, '2', '2018-05-03 09:05:55', '4'),
(357, 5, 540000, '2', '2018-05-03 09:27:54', '4'),
(358, 5, 450000, '1', '2018-05-03 16:42:27', '7/330'),
(360, 12, 23300, '2', '2018-05-03 16:44:03', '3'),
(361, 12, 170000, '2', '2018-05-05 10:47:08', '3'),
(362, 5, 291000, '1', '2018-05-06 17:58:24', '7/327'),
(363, 7, 400000, '1', '2018-05-08 11:03:16', '6/341'),
(364, 5, 425000, '1', '2018-05-08 14:16:48', '6/342'),
(366, 7, 400000, '1', '2018-05-09 15:25:37', '6/343'),
(367, 5, 900000, '2', '2018-05-09 21:21:38', '4'),
(368, 5, 200000, '1', '2018-05-10 08:35:32', '6/345'),
(369, 5, 200000, '1', '2018-05-10 08:36:27', '6/346'),
(370, 5, 350000, '1', '2018-05-10 08:40:07', '6/347'),
(371, 12, 75000, '2', '2018-05-10 09:11:24', '3'),
(372, 12, 50000, '2', '2018-05-10 09:12:09', '3'),
(373, 12, 73300, '2', '2018-05-10 09:12:43', '3'),
(374, 12, 80650, '2', '2018-05-10 09:14:14', '3'),
(375, 12, 15000, '1', '2018-05-10 09:42:07', '7/259'),
(376, 12, 200000, '1', '2018-05-10 17:45:29', '7/346'),
(377, 12, 200000, '1', '2018-05-10 17:45:50', '7/345'),
(378, 12, 38300, '2', '2018-05-11 08:59:35', '3'),
(379, 12, 22000, '2', '2018-05-11 09:00:51', '3'),
(380, 12, 50000, '2', '2018-05-11 09:01:46', '3'),
(381, 12, 20000, '1', '2018-05-11 11:34:34', '2'),
(382, 7, 365600, '2', '2018-05-11 17:40:28', '3'),
(383, 12, 33000, '2', '2018-05-11 17:41:23', '3'),
(384, 12, 58900, '2', '2018-05-11 17:43:27', '3'),
(385, 12, 15000, '2', '2018-05-11 22:51:27', '3'),
(386, 12, 385000, '1', '2018-05-12 15:17:02', '6/350'),
(387, 12, 100000, '2', '2018-05-12 16:03:17', '3'),
(388, 7, 360000, '1', '2018-05-12 21:01:21', '6/351'),
(390, 5, 388000, '1', '2018-05-13 11:55:58', '7/331'),
(391, 5, 814800, '1', '2018-05-13 11:56:28', '7/336'),
(392, 5, 766000, '1', '2018-05-13 11:58:36', '7/316'),
(393, 5, 339500, '1', '2018-05-13 12:00:06', '7/292'),
(394, 12, 82000, '2', '2018-05-13 17:25:13', '3'),
(395, 5, 5825114, '2', '2018-05-13 22:59:42', '4'),
(396, 12, 37300, '2', '2018-05-15 16:16:34', '3'),
(397, 5, 2020025, '1', '2018-05-17 11:42:39', '7/305'),
(398, 5, 388000, '1', '2018-05-17 11:43:11', '7/339'),
(399, 5, 3500000, '1', '2018-05-17 11:45:56', '7/338'),
(400, 7, 400000, '1', '2018-05-17 11:49:46', '7/341'),
(401, 5, 291000, '1', '2018-05-17 11:52:08', '7/344'),
(402, 7, 300000, '1', '2018-05-17 17:51:12', '6/354'),
(403, 12, 400000, '1', '2018-05-18 13:45:04', '7/354'),
(404, 7, 770000, '1', '2018-05-18 14:15:58', '6/356'),
(405, 12, 6300000, '1', '2018-05-18 14:58:41', '2'),
(406, 12, 1500000, '2', '2018-05-18 15:00:00', '3'),
(407, 12, 472918, '2', '2018-05-18 15:18:18', '10/19'),
(408, 12, 1211062, '2', '2018-05-18 15:19:54', '10/11'),
(409, 12, 479786, '2', '2018-05-18 15:20:46', '10/24'),
(410, 12, 762606, '2', '2018-05-18 15:29:38', '9/9'),
(411, 12, 300000, '2', '2018-05-18 15:31:15', '9/9'),
(412, 12, 300000, '2', '2018-05-18 15:32:52', '10/24'),
(413, 12, 300000, '2', '2018-05-18 15:33:30', '10/11'),
(414, 12, 213888, '1', '2018-05-18 16:19:28', '2'),
(415, 5, 2566000, '2', '2018-05-18 16:21:18', '1'),
(416, 12, 2566000, '1', '2018-05-18 16:21:18', '1'),
(417, 12, 134300, '1', '2018-05-18 16:39:06', '2'),
(418, 12, 100000, '2', '2018-05-18 16:39:54', '3'),
(419, 12, 15500, '2', '2018-05-18 16:40:39', '3'),
(420, 12, 18800, '2', '2018-05-18 16:41:06', '3'),
(421, 7, 300000, '1', '2018-05-18 17:30:08', '6/357'),
(425, 5, 339500, '1', '2018-05-24 10:33:15', '7/349'),
(426, 5, 388000, '1', '2018-05-24 10:34:13', '7/348'),
(427, 5, 388000, '1', '2018-05-24 10:34:13', '7/348'),
(428, 5, 388000, '1', '2018-05-24 10:34:55', '7/353'),
(429, 5, 388000, '1', '2018-05-24 10:35:35', '7/340'),
(430, 12, 350000, '1', '2018-05-24 10:37:23', '6/360'),
(431, 12, 350000, '1', '2018-05-24 10:37:50', '6/359'),
(432, 12, 51700, '2', '2018-05-24 16:11:11', '3'),
(433, 12, 282000, '1', '2018-05-25 14:49:38', '6/361'),
(434, 12, 25000, '2', '2018-05-26 09:29:27', '3'),
(435, 5, 1050000, '1', '2018-05-26 10:23:47', '6/352'),
(436, 5, 800000, '1', '2018-05-26 10:24:24', '6/358'),
(437, 12, 350000, '1', '2018-05-26 23:18:46', '6/362'),
(438, 12, 150000, '2', '2018-05-27 17:24:33', '3'),
(439, 12, 63000, '2', '2018-05-27 17:25:10', '3'),
(440, 12, 88500, '2', '2018-05-27 17:52:33', '3'),
(441, 12, 400000, '1', '2018-05-27 20:27:55', '6/368'),
(442, 12, 350000, '1', '2018-05-28 22:28:35', '6/369'),
(443, 12, 300000, '1', '2018-05-28 22:32:19', '6/370'),
(444, 12, 600000, '1', '2018-05-30 00:04:32', '6/372'),
(445, 5, 600000, '1', '2018-05-30 10:09:44', '6/373'),
(446, 12, 26000, '2', '2018-05-31 09:26:29', '3'),
(449, 12, 89500, '2', '2018-05-31 09:29:26', '3'),
(450, 12, 140500, '2', '2018-05-31 13:41:42', '3'),
(451, 5, 300000, '1', '2018-06-01 04:34:01', '6/380'),
(452, 7, 300000, '1', '2018-06-01 04:47:47', '7/357'),
(454, 9, 375000, '1', '2018-06-02 10:16:55', '6/382'),
(455, 5, 810000, '2', '2018-06-02 11:26:50', '4'),
(456, 7, 1200000, '2', '2018-06-02 12:47:40', '9/9'),
(457, 7, 1200000, '2', '2018-06-02 12:48:23', '10/19'),
(458, 5, 500000, '1', '2018-06-02 12:53:23', '6/386'),
(459, 5, 500000, '2', '2018-06-02 13:03:41', '8/386'),
(460, 7, 2100000, '1', '2018-06-02 14:42:33', '6/387'),
(461, 9, 400000, '1', '2018-06-02 15:27:16', '6/388'),
(462, 7, 350000, '1', '2018-06-02 17:29:30', '6/389'),
(463, 12, 88000, '2', '2018-06-03 09:46:44', '3'),
(464, 12, 51700, '2', '2018-06-03 09:47:12', '3'),
(465, 12, 170000, '2', '2018-06-03 10:12:44', '3'),
(466, 5, 0, '2', '2018-06-05 12:42:30', '9/9'),
(467, 5, 0, '2', '2018-06-05 12:43:08', '9/9'),
(468, 5, 0, '2', '2018-06-05 12:43:53', '10/11'),
(469, 5, 0, '2', '2018-06-05 12:44:28', '10/11'),
(470, 5, 0, '2', '2018-06-05 12:45:17', '10/19'),
(471, 5, 0, '2', '2018-06-05 12:46:20', '10/24'),
(472, 5, 0, '2', '2018-06-05 12:46:53', '10/24'),
(473, 12, 275000, '2', '2018-06-06 09:21:03', '10/19'),
(474, 5, 1155000, '1', '2018-06-07 10:49:44', '6/393'),
(475, 12, 38300, '2', '2018-06-07 11:26:10', '3'),
(476, 12, 105000, '2', '2018-06-07 11:28:32', '10/19'),
(477, 12, 230000, '2', '2018-06-07 11:29:39', '3'),
(478, 12, 41000, '2', '2018-06-07 11:30:41', '3'),
(479, 12, 427900, '2', '2018-06-07 13:29:45', '3'),
(481, 9, 350000, '1', '2018-06-08 14:09:01', '6/397'),
(484, 5, 727500, '1', '2018-06-09 16:07:34', '7/367'),
(485, 5, 766300, '1', '2018-06-09 16:08:29', '7/333'),
(486, 5, 1091250, '1', '2018-06-09 16:12:02', '7/371'),
(487, 5, 1222200, '1', '2018-06-09 16:13:10', '7/379'),
(488, 5, 388000, '1', '2018-06-09 16:15:37', '7/381'),
(489, 5, 664450, '1', '2018-06-09 16:17:20', '7/391'),
(490, 5, 4700000, '2', '2018-06-09 22:22:33', '4'),
(491, 5, 3094908, '2', '2018-06-09 22:24:16', '4'),
(492, 7, 300000, '2', '2018-06-09 22:26:04', '4'),
(493, 12, 175000, '2', '2018-06-10 09:02:28', '3'),
(494, 12, 45000, '2', '2018-06-10 09:03:15', '3'),
(495, 12, 1000000, '2', '2018-06-10 09:05:19', '3'),
(496, 12, 1000000, '2', '2018-06-10 09:06:01', '3'),
(497, 12, 1000000, '2', '2018-06-10 09:08:11', '3'),
(498, 12, 7000, '2', '2018-06-10 09:09:11', '3'),
(499, 12, 50000, '2', '2018-06-10 16:20:11', '3'),
(500, 5, 500000, '1', '2018-06-10 16:28:13', '6/405'),
(501, 9, 350000, '1', '2018-06-10 16:30:05', '7/397'),
(502, 12, 26000, '2', '2018-06-10 16:38:33', '3'),
(503, 5, 0, '2', '2018-06-11 11:15:04', '3'),
(504, 5, 0, '2', '2018-06-11 11:17:06', '3'),
(505, 12, 150000, '2', '2018-06-11 16:25:21', '10/9'),
(506, 12, 780622, '2', '2018-06-11 16:25:32', '10/11'),
(507, 12, 150000, '2', '2018-06-11 16:25:41', '10/11'),
(508, 12, 515706, '2', '2018-06-11 16:25:51', '10/19'),
(511, 12, 452446, '2', '2018-06-11 16:26:22', '10/9'),
(512, 12, 100000, '2', '2018-06-11 16:30:35', '3'),
(513, 12, 500000, '1', '2018-06-12 17:35:55', '6/410'),
(514, 12, 0, '1', '2018-06-12 17:37:29', '6/400'),
(515, 12, 18500, '2', '2018-06-12 20:45:53', '3'),
(516, 12, 489000, '2', '2018-06-12 20:46:41', '3'),
(517, 5, 339500, '1', '2018-06-13 09:12:50', '7/399'),
(518, 12, 30000, '2', '2018-06-13 10:43:16', '3'),
(519, 7, 1200000, '1', '2018-06-13 11:18:32', '6/407'),
(520, 5, 400000, '1', '2018-06-13 21:33:14', '6/411'),
(521, 7, 350000, '1', '2018-06-14 12:31:03', '6/412'),
(522, 12, 1200000, '1', '2018-06-14 12:56:17', '6/413'),
(523, 5, 400000, '1', '2018-06-17 17:00:33', '6/420'),
(524, 5, 800000, '1', '2018-06-17 23:10:48', '7/373'),
(525, 7, 250000, '1', '2018-06-19 13:49:51', '6/423'),
(526, 7, 250000, '1', '2018-06-19 13:51:37', '6/424'),
(527, 12, 350000, '1', '2018-06-20 11:16:09', '7/425'),
(528, 5, 727500, '1', '2018-06-20 11:17:23', '7/403'),
(529, 12, 500000, '1', '2018-06-20 18:22:21', '7/405'),
(530, 7, 300000, '1', '2018-06-21 08:12:45', '6/427'),
(531, 12, 650000, '1', '2018-06-21 12:17:29', '7/410'),
(532, 12, 700000, '1', '2018-06-21 12:18:08', '7/400'),
(533, 12, 23000, '2', '2018-06-21 12:53:22', '3'),
(534, 12, 38400, '2', '2018-06-21 12:54:04', '3'),
(535, 12, 79500, '2', '2018-06-21 12:54:53', '3'),
(536, 12, 204900, '2', '2018-06-21 12:57:10', '9/12'),
(537, 12, 83500, '2', '2018-06-21 12:57:57', '3'),
(538, 12, 106500, '2', '2018-06-21 12:58:37', '3'),
(539, 12, 51500, '2', '2018-06-21 12:59:04', '3'),
(540, 12, 95500, '2', '2018-06-21 12:59:32', '3'),
(541, 12, 88000, '2', '2018-06-21 13:00:15', '3'),
(542, 12, 100000, '2', '2018-06-21 13:01:23', '10/23'),
(544, 12, 350000, '1', '2018-06-22 11:33:24', '6/431'),
(545, 9, 375000, '1', '2018-06-22 19:40:36', '6/432'),
(546, 5, 400000, '1', '2018-06-23 14:47:26', '6/394'),
(547, 5, 400000, '1', '2018-06-23 14:53:19', '6/433'),
(548, 5, 727500, '1', '2018-06-23 16:45:15', '7/415'),
(549, 5, 1455000, '1', '2018-06-23 16:46:54', '7/392'),
(550, 12, 100000, '1', '2018-06-24 11:10:47', '7/427'),
(551, 12, 400000, '1', '2018-06-24 11:25:20', '7/436'),
(552, 5, 1200000, '1', '2018-06-24 13:26:34', '7/406'),
(553, 7, 300000, '1', '2018-06-24 13:47:56', '6/443'),
(554, 5, 1000000, '1', '2018-06-24 14:10:55', '7/407'),
(555, 12, 1200000, '1', '2018-06-24 15:04:02', '7/372'),
(556, 5, 776000, '1', '2018-06-24 15:05:00', '7/414'),
(557, 5, 2037000, '1', '2018-06-24 15:05:49', '7/385'),
(558, 5, 679000, '1', '2018-06-24 15:07:01', '7/408'),
(559, 5, 485000, '1', '2018-06-24 15:08:21', '7/417'),
(560, 5, 776000, '1', '2018-06-24 15:09:10', '7/396'),
(561, 12, 236800, '2', '2018-06-24 19:43:55', '3'),
(562, 12, 100000, '2', '2018-06-24 19:44:46', '10/23'),
(563, 12, 109000, '2', '2018-06-24 19:45:31', '3'),
(564, 12, 156000, '2', '2018-06-24 19:46:09', '3'),
(565, 12, 23000, '2', '2018-06-24 19:46:46', '3'),
(566, 12, 26800, '2', '2018-06-24 19:47:27', '3'),
(567, 12, 10000, '1', '2018-06-24 19:58:39', '2'),
(568, 7, 350000, '1', '2018-06-25 09:32:44', '6/448'),
(569, 5, 375000, '1', '2018-06-25 10:12:25', '6/449'),
(570, 5, 375000, '1', '2018-06-25 10:15:54', '6/450'),
(571, 12, 375000, '1', '2018-06-26 12:04:08', '7/429'),
(572, 12, 900000, '1', '2018-06-26 13:27:36', '7/448'),
(573, 7, 400000, '1', '2018-06-27 01:31:04', '6/451'),
(574, 5, 339500, '1', '2018-06-27 10:41:37', '7/418'),
(575, 5, 727500, '1', '2018-06-27 10:42:17', '7/409'),
(576, 5, 679000, '1', '2018-06-27 10:43:23', '7/402'),
(577, 5, 776000, '1', '2018-06-27 10:44:12', '7/390'),
(578, 5, 776000, '1', '2018-06-27 10:45:05', '7/419'),
(579, 5, 533500, '1', '2018-06-27 10:45:55', '7/416'),
(580, 5, 776000, '1', '2018-06-27 10:46:52', '7/271'),
(581, 5, 824500, '1', '2018-06-27 10:47:37', '7/426'),
(582, 5, 776000, '1', '2018-06-27 10:52:43', '7/428'),
(583, 5, 388000, '1', '2018-06-27 10:54:00', '7/435'),
(584, 12, 350000, '1', '2018-06-27 10:55:57', '7/434'),
(585, 5, 425000, '1', '2018-06-27 10:57:35', '7/411'),
(586, 5, 425000, '1', '2018-06-27 10:57:42', '7/411'),
(587, 12, 328000, '2', '2018-06-27 11:04:20', '3'),
(588, 5, 375000, '1', '2018-06-27 23:22:52', '6/456'),
(589, 5, 1014000, '1', '2018-06-28 20:18:30', '6/421'),
(590, 12, 400000, '1', '2018-06-28 20:55:42', '6/458'),
(591, 12, 1025000, '1', '2018-06-29 06:16:59', '2'),
(592, 12, 115000, '2', '2018-06-29 06:18:26', '9/29'),
(593, 12, 200000, '2', '2018-06-29 06:19:09', '9/29'),
(594, 12, 193000, '2', '2018-06-29 06:23:49', '9/29'),
(595, 12, 30500, '2', '2018-06-29 06:27:23', '3'),
(596, 12, 30500, '2', '2018-06-29 06:28:29', '3'),
(597, 12, 25000, '2', '2018-06-29 06:29:19', '3'),
(598, 12, 22500, '2', '2018-06-29 06:29:56', '9/9'),
(599, 12, 67000, '2', '2018-06-29 06:31:07', '3'),
(600, 12, 142500, '2', '2018-06-29 06:32:01', '3'),
(601, 12, 10000, '2', '2018-06-29 06:33:14', '3'),
(602, 12, 75000, '2', '2018-06-29 06:34:04', '3'),
(603, 12, 75000, '2', '2018-06-29 06:35:29', '3'),
(604, 12, 25000, '2', '2018-06-29 06:36:09', '3'),
(605, 12, 35000, '2', '2018-06-29 06:36:45', '3'),
(606, 12, 50000, '2', '2018-06-29 06:37:30', '3'),
(607, 12, 75000, '2', '2018-06-29 09:21:18', '9/29'),
(608, 12, 50000, '2', '2018-06-29 09:21:50', '9/29'),
(609, 12, 12000, '2', '2018-06-29 09:22:26', '9/29'),
(610, 12, 50000, '2', '2018-06-29 09:37:05', '9/29'),
(611, 5, 375000, '1', '2018-06-29 10:59:10', '6/462'),
(612, 5, 1620000, '2', '2018-06-29 15:18:58', '4'),
(614, 5, 800000, '1', '2018-06-29 22:38:19', '6/466'),
(615, 5, 400000, '1', '2018-06-29 22:41:21', '6/467'),
(617, 5, 339500, '1', '2018-06-30 15:05:50', '7/463'),
(618, 5, 270000, '2', '2018-06-30 15:06:24', '4'),
(619, 12, 45000, '2', '2018-06-30 21:26:11', '3'),
(620, 5, 388000, '1', '2018-07-01 10:09:27', '7/460'),
(621, 5, 3870100, '2', '2018-07-01 11:25:59', '4'),
(622, 5, 2675054, '2', '2018-07-01 11:27:04', '4'),
(623, 5, 776000, '1', '2018-07-02 10:35:56', '7/429'),
(624, 5, 339500, '1', '2018-07-02 10:48:20', '7/469'),
(625, 5, 388000, '1', '2018-07-02 10:49:00', '7/464'),
(626, 5, 388000, '1', '2018-07-02 10:49:42', '7/461'),
(627, 5, 388000, '1', '2018-07-02 10:50:11', '7/459'),
(628, 5, 388000, '1', '2018-07-02 10:51:07', '7/457'),
(629, 9, 800000, '1', '2018-07-02 15:51:34', '6/482'),
(630, 12, 105000, '2', '2018-07-02 16:52:19', '10/9'),
(631, 12, 60000, '2', '2018-07-02 16:52:43', '3'),
(632, 12, 41900, '2', '2018-07-02 16:53:47', '3'),
(633, 12, 26000, '2', '2018-07-02 16:55:40', '10/20'),
(634, 12, 23000, '2', '2018-07-02 16:57:47', '3'),
(635, 7, 400000, '1', '2018-07-03 11:35:22', '7/443'),
(636, 12, 20900, '2', '2018-07-03 17:32:19', '3'),
(637, 12, 350000, '1', '2018-07-04 11:55:23', '6/487'),
(638, 5, 1125000, '1', '2018-07-05 17:28:05', '7/462'),
(639, 7, 125000, '1', '2018-07-05 17:34:59', '7/424'),
(640, 7, 125000, '1', '2018-07-05 17:35:23', '7/423'),
(641, 12, 470000, '2', '2018-07-05 18:30:12', '3'),
(642, 12, 125000, '2', '2018-07-05 18:31:20', '3'),
(643, 12, 375000, '1', '2018-07-06 12:41:15', '6/493'),
(644, 5, 1091250, '1', '2018-07-06 12:48:38', '7/470'),
(645, 5, 388000, '1', '2018-07-06 12:49:13', '7/488'),
(646, 5, 388000, '1', '2018-07-06 12:50:00', '7/491'),
(647, 12, 75500, '2', '2018-07-06 13:21:14', '3'),
(648, 12, 100000, '2', '2018-07-06 13:21:47', '10/23'),
(649, 5, 246400, '2', '2018-07-06 13:22:52', '3'),
(650, 5, 679000, '1', '2018-07-06 19:28:24', '7/486'),
(651, 9, 375000, '1', '2018-07-07 09:17:09', '6/494'),
(652, 5, 0, '2', '2018-07-07 11:05:57', '10/19'),
(654, 5, 0, '2', '2018-07-07 11:10:19', '10/24'),
(656, 5, 0, '2', '2018-07-07 11:10:55', '10/24'),
(659, 5, 0, '2', '2018-07-07 11:16:51', '9/11'),
(660, 5, 0, '2', '2018-07-07 11:29:47', '10/9'),
(661, 5, 0, '2', '2018-07-07 11:30:30', '10/9'),
(662, 5, 2473500, '1', '2018-07-07 12:33:48', '7/465'),
(663, 12, 1188000, '2', '2018-07-08 10:22:50', '10/23'),
(664, 12, 248200, '2', '2018-07-08 10:24:22', '10/23'),
(665, 12, 50000, '2', '2018-07-08 10:24:40', '3'),
(666, 12, 27500, '2', '2018-07-08 10:25:37', '3'),
(667, 5, 388000, '1', '2018-07-08 12:14:36', '7/492'),
(668, 7, 2700000, '2', '2018-07-08 12:21:15', '4'),
(669, 7, 1501500, '2', '2018-07-08 12:23:52', '4'),
(671, 12, 2400000, '1', '2018-07-08 12:26:59', '7/458'),
(672, 7, 400000, '1', '2018-07-08 12:28:56', '6/497'),
(673, 5, 0, '2', '2018-07-08 16:51:35', '9/29'),
(674, 5, 3800000, '2', '2018-07-08 17:54:07', '4'),
(675, 5, 1818750, '1', '2018-07-08 18:09:11', '7/483'),
(676, 12, 87000, '2', '2018-07-08 22:18:38', '3'),
(677, 12, 100000, '2', '2018-07-08 22:26:32', '10/29'),
(678, 5, 727500, '1', '2018-07-09 12:45:18', '7/490'),
(679, 12, 400000, '1', '2018-07-09 22:53:06', '6/500'),
(680, 5, 400000, '1', '2018-07-10 15:38:52', '6/501'),
(681, 5, 727500, '1', '2018-07-10 15:45:12', '7/496'),
(682, 5, 679000, '1', '2018-07-10 15:46:11', '7/495'),
(683, 5, 388000, '1', '2018-07-10 15:46:52', '7/485'),
(684, 12, 60000, '2', '2018-07-10 18:12:19', '3'),
(685, 12, 30000, '2', '2018-07-10 18:12:52', '3'),
(686, 5, 375000, '1', '2018-07-11 11:39:57', '6/507'),
(687, 12, 100000, '2', '2018-07-11 15:39:33', '3'),
(688, 12, 27500, '2', '2018-07-11 15:40:10', '3'),
(689, 12, 375000, '1', '2018-07-11 16:57:12', '6/508'),
(690, 5, 400000, '1', '2018-07-12 20:37:21', '6/510'),
(691, 5, 1358000, '1', '2018-07-13 17:10:59', '7/489'),
(692, 5, 750000, '1', '2018-07-13 17:28:29', '6/513'),
(693, 7, 810000, '2', '2018-07-13 17:59:15', '4'),
(694, 5, 6487636, '2', '2018-07-13 18:01:49', '4'),
(695, 5, 388000, '1', '2018-07-13 18:03:45', '7/502'),
(696, 12, 180000, '2', '2018-07-13 18:32:06', '10/23'),
(697, 12, 161000, '2', '2018-07-13 18:33:47', '3'),
(698, 12, 150000, '2', '2018-07-13 18:34:25', '10/24'),
(699, 12, 414546, '2', '2018-07-13 18:34:36', '10/24'),
(700, 12, 881742, '2', '2018-07-13 18:35:07', '10/11'),
(701, 12, 150000, '2', '2018-07-13 18:36:15', '10/9'),
(702, 12, 424546, '2', '2018-07-13 18:36:24', '10/19'),
(703, 12, 518806, '2', '2018-07-13 18:36:38', '10/9'),
(704, 5, 2400000, '2', '2018-07-13 23:00:30', '4'),
(706, 5, 800000, '1', '2018-07-13 23:13:53', '7/499'),
(707, 5, 776000, '1', '2018-07-13 23:17:25', '7/498'),
(708, 12, 35000, '2', '2018-07-14 19:08:53', '3'),
(709, 5, 150000, '1', '2018-07-15 18:50:32', '6/538'),
(710, 12, 300000, '1', '2018-07-15 18:52:52', '6/539'),
(711, 5, 425000, '1', '2018-07-16 19:57:11', '6/554'),
(712, 5, 375000, '1', '2018-07-16 21:22:05', '6/555'),
(713, 9, 800000, '1', '2018-07-17 11:29:02', '6/556'),
(714, 7, 200000, '1', '2018-07-17 13:07:37', '7/518'),
(715, 12, 6200000, '1', '2018-07-17 17:03:35', '6/558'),
(716, 5, 400000, '1', '2018-07-17 17:51:09', '6/559'),
(717, 9, 350000, '1', '2018-07-18 08:15:47', '6/560'),
(718, 5, 400000, '1', '2018-07-18 12:51:16', '6/561'),
(719, 7, 350000, '1', '2018-07-18 13:24:03', '6/562'),
(720, 5, 388000, '1', '2018-07-18 14:02:34', '7/505'),
(721, 5, 746900, '1', '2018-07-18 14:03:34', '7/484'),
(722, 5, 388000, '1', '2018-07-18 14:31:49', '7/511'),
(723, 5, 388000, '1', '2018-07-18 14:32:43', '7/519'),
(724, 5, 776000, '1', '2018-07-18 14:34:32', '7/509'),
(725, 5, 766300, '1', '2018-07-18 14:36:29', '7/514'),
(726, 5, 388000, '1', '2018-07-18 14:37:09', '7/517'),
(727, 5, 1200000, '1', '2018-07-18 20:12:40', '7/559'),
(728, 7, 450000, '1', '2018-07-18 21:02:25', '6/563'),
(729, 7, 250000, '1', '2018-07-19 07:40:40', '6/564'),
(730, 7, 900000, '1', '2018-07-19 16:25:48', '6/567'),
(731, 5, 400000, '1', '2018-07-19 19:39:47', '6/569'),
(732, 5, 350, '1', '2018-07-19 19:40:25', '7/568'),
(733, 5, 350000, '1', '2018-07-19 19:40:57', '7/568'),
(734, 9, 450000, '1', '2018-07-19 21:10:20', '6/570'),
(735, 5, 800000, '1', '2018-07-20 07:42:39', '7/566'),
(736, 12, 55000, '2', '2018-07-20 11:48:41', '3'),
(737, 12, 64000, '2', '2018-07-20 11:49:18', '3'),
(738, 5, 1552000, '1', '2018-07-20 19:46:40', '7/515'),
(739, 5, 1940000, '1', '2018-07-20 19:49:05', '7/512'),
(740, 5, 200000, '1', '2018-07-20 23:20:41', '7/538'),
(741, 5, 766300, '1', '2018-07-21 00:29:07', '7/571'),
(742, 5, 1200000, '1', '2018-07-21 20:07:05', '6/576'),
(743, 5, 300000, '1', '2018-07-23 17:06:40', '6/580'),
(744, 5, 400000, '1', '2018-07-24 08:46:49', '7/573'),
(745, 5, 800000, '1', '2018-07-25 12:29:40', '7/572'),
(746, 5, 339500, '1', '2018-07-25 12:30:29', '7/565'),
(747, 5, 800000, '1', '2018-07-25 12:31:51', '7/510'),
(748, 5, 776000, '1', '2018-07-25 12:32:43', '7/503'),
(749, 5, 746900, '1', '2018-07-25 12:33:23', '7/577'),
(750, 12, 1350000, '2', '2018-07-25 18:35:06', '3'),
(751, 12, 50000, '2', '2018-07-25 18:35:41', '3'),
(752, 12, 23000, '2', '2018-07-25 18:36:23', '3'),
(753, 12, 302000, '2', '2018-07-25 18:37:09', '3'),
(754, 12, 100000, '2', '2018-07-25 18:37:53', '10/23'),
(755, 12, 50000, '2', '2018-07-25 18:38:30', '3'),
(756, 12, 79000, '2', '2018-07-25 18:40:21', '3'),
(757, 12, 100000, '2', '2018-07-25 18:40:55', '3'),
(758, 12, 39000, '2', '2018-07-25 18:41:29', '3'),
(759, 12, 25000, '2', '2018-07-25 18:41:59', '3'),
(760, 12, 25000, '2', '2018-07-25 18:42:30', '3'),
(761, 12, 175000, '2', '2018-07-25 18:43:35', '3'),
(762, 12, 470000, '2', '2018-07-25 18:44:54', '3'),
(763, 12, 200000, '2', '2018-07-25 18:45:19', '3'),
(764, 12, 20000, '2', '2018-07-25 18:45:57', '3'),
(765, 12, 94500, '2', '2018-07-25 18:47:42', '10/11'),
(767, 5, 2000000, '1', '2018-07-26 10:43:38', '7/584'),
(768, 5, 700000, '1', '2018-07-26 10:43:57', '7/583'),
(769, 5, 375000, '1', '2018-07-26 10:45:19', '7/581'),
(770, 12, 350000, '1', '2018-07-27 08:58:55', '6/591'),
(771, 7, 325000, '1', '2018-07-27 11:32:04', '6/592'),
(772, 7, 400000, '1', '2018-07-27 13:03:18', '6/593'),
(773, 5, 824500, '1', '2018-07-28 10:12:02', '7/578'),
(774, 5, 399000, '1', '2018-09-03 10:01:02', '7/597'),
(775, 5, 1000, '1', '2018-09-03 10:01:13', '7/597'),
(776, 9, 500000, '1', '2018-09-04 07:34:46', '7/596'),
(777, 5, 0, '2', '2018-09-18 11:24:36', '4'),
(778, 5, 270000, '2', '2018-09-18 11:33:58', '4'),
(779, 5, 1675000, '2', '2018-09-18 11:47:53', '4'),
(780, 5, 300000, '2', '2018-09-18 12:36:12', '4'),
(781, 5, 350000, '2', '2018-09-22 08:01:15', '3'),
(782, 9, 350000, '2', '2018-09-22 08:01:56', '3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_owner`
--

CREATE TABLE IF NOT EXISTS `tb_owner` (
  `kd_owner` int(4) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_tlp` varchar(15) NOT NULL,
  `kd_bank` int(4) NOT NULL,
  `no_rek` varchar(20) NOT NULL,
  `tgl_gabung` date NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `jumlah_unit` int(11) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`kd_owner`),
  KEY `kd_bank` (`kd_bank`),
  KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data untuk tabel `tb_owner`
--

INSERT INTO `tb_owner` (`kd_owner`, `nama`, `alamat`, `no_tlp`, `kd_bank`, `no_rek`, `tgl_gabung`, `email`, `jenis_kelamin`, `jumlah_unit`, `username`) VALUES
(3, 'Triana Rezza', 'Antapani', '081809824448', 5, '00358735414', '2017-12-22', 'mengmenggarlo@gmail.com', 'Perempuan', 4, 'owner'),
(4, 'Samun Djaja Rahardja', 'Margahayu', '08122003228', 9, '0022891252', '2017-12-25', 'harja_63@yahoo.com', 'Laki-laki', 1, 'samun'),
(5, 'Nurul Wikantyasning', 'Sukamiskin', '08112031314', 6, '0860270145', '2018-01-13', 'dummy@gmail.com', 'Perempuan', 2, 'nurul'),
(6, 'Ermawati', 'Margacinta', '081320704243', 6, '7750674164', '2018-01-20', 'ermaw078@gmail.com', 'Perempuan', 1, 'Erma'),
(7, 'Susanti', 'Pulo Laut', '0817611187', 7, '1310070077708', '2018-01-20', 'dummy@gmail.com', 'Perempuan', 0, 'susan'),
(8, 'Netty', 'Gateway', '08127102146', 6, '7401195622', '2018-01-20', 'dummy@gmail.com', 'Perempuan', 3, 'netty'),
(9, 'Boyke Fransiscus Setiawan', 'Kotabaru Parahyangan', '08118468634', 7, '9000019125401', '2018-01-20', 'simpliminimali@gmail.com', 'Laki-laki', 2, 'frans'),
(10, 'Nani Nofiar', 'Jakarta', '0811775117', 6, '3801188492', '2018-01-20', 'dummy@gmail.com', 'Perempuan', 2, 'nani'),
(11, 'Lily Catarina', 'Batununggal', '0816613417', 6, '0161775427', '2018-01-20', 'lilicatarina@gmail.com', 'Perempuan', 2, 'lily'),
(13, 'Erwin', 'Buahbatu Regency', '081221914890', 7, '12345678', '2018-06-03', 'owner@cozzal.com', 'Perempuan', 0, 'erwin'),
(14, 'Mia Amelia', 'Lebak Bulus', '08164810493', 6, '12345678', '2018-07-19', 'owner@cozzal.com', 'Perempuan', 1, 'mia'),
(15, 'Nova Newton', 'Bandung', '0878255514469', 6, '0086157947', '2018-07-22', 'owner@cozzal.com', 'Laki-laki', 1, 'nova');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_owner_payment`
--

CREATE TABLE IF NOT EXISTS `tb_owner_payment` (
  `kd_owner_payment` varchar(200) NOT NULL,
  `kd_owner` int(4) NOT NULL,
  `tgl_pembayaran` datetime NOT NULL,
  `jumlah_transaksi` int(5) NOT NULL,
  `nominal` int(20) NOT NULL,
  `status` char(1) NOT NULL COMMENT '1:Paid, 2:Wait, 3:Reject, 4:Confirm',
  `nominal_asli` int(11) NOT NULL,
  `keterangan` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`kd_owner_payment`),
  KEY `kd_owner` (`kd_owner`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_owner_payment`
--

INSERT INTO `tb_owner_payment` (`kd_owner_payment`, `kd_owner`, `tgl_pembayaran`, `jumlah_transaksi`, `nominal`, `status`, `nominal_asli`, `keterangan`) VALUES
('102a226x', 5, '2018-04-02 09:26:40', 2, 1100000, '', 1100000, NULL),
('103a108x', 3, '2018-05-09 21:03:02', 2, 900000, '1', 900000, NULL),
('113a117a118a125a137a177a179a223x20b22', 6, '2018-04-10 19:26:30', 10, 3711000, '', 3711000, NULL),
('129x', 4, '2018-04-03 10:30:16', 1, 3500000, '', 3500000, NULL),
('145x', 3, '2018-03-30 12:59:06', 1, 275000, '2', 275000, NULL),
('151a172a173a261a324x18', 10, '2018-04-27 18:49:23', 6, 4410000, '', 4410000, NULL),
('174a176x', 3, '2018-09-19 16:20:34', 2, 1170000, '2', 1175000, 'Eigth Man'),
('214a217x', 3, '2018-03-30 16:03:10', 2, 550000, '', 550000, NULL),
('229x', 7, '2018-03-30 12:51:28', 1, 300000, '', 300000, NULL),
('230a234a240a242a253a283a291a325x78', 10, '2018-05-01 11:05:12', 9, 5255290, '', 5255290, NULL),
('232a302x', 5, '2018-04-27 18:17:00', 2, 810000, '', 810000, NULL),
('235x', 7, '2018-04-17 17:51:03', 1, 300000, '', 300000, NULL),
('236x', 7, '2018-04-02 08:31:25', 1, 600000, '', 600000, NULL),
('239a243a255a286a287a296a320a322x79', 6, '2018-05-11 16:42:35', 9, 5825114, '1', 5825114, NULL),
('241a246a251a260a267a279a282a304a311a315x10', 9, '2018-05-01 10:15:03', 11, 2962500, '', 2962500, NULL),
('259a305a329a331a333a353a358a379a385a393a422a426a429a461x210b211', 6, '2018-07-13 18:01:49', 16, 6487636, '1', 6487636, NULL),
('268a273x', 5, '2018-04-15 03:19:59', 2, 540000, '', 540000, NULL),
('281a297a298a312a314a317a319a330a346a347a357a360a361a369x107b108b124', 4, '2018-06-09 22:24:16', 17, 3094908, '1', 3094908, NULL),
('285a301a323x26', 7, '2018-05-03 09:05:55', 4, 1181200, '', 1181200, NULL),
('308a332x', 5, '2018-05-03 09:27:54', 2, 540000, '', 540000, NULL),
('334a336a338a362a371x', 9, '2018-06-09 22:22:33', 5, 4700000, '1', 4700000, NULL),
('349a354x', 5, '2018-06-02 11:26:50', 2, 810000, '1', 810000, NULL),
('359a392a410a415a436x', 10, '2018-07-13 23:00:30', 5, 2400000, '1', 2400000, NULL),
('359a392a410a415a436x134b135', 10, '2018-06-24 15:22:01', 7, 2043652, '3', 2043652, NULL),
('372a399a400a405a417a432a434a467x129b130bbb179', 4, '2018-07-01 11:27:04', 13, 2675054, '1', 2675054, NULL),
('381x', 7, '2018-06-09 22:26:04', 1, 300000, '1', 300000, NULL),
('388a390a394a403a406a420a435a448a460x159', 9, '2018-07-01 11:25:59', 10, 3870100, '1', 3870100, NULL),
('396a414a419a428a431x', 7, '2018-07-08 12:21:15', 5, 2700000, '1', 2700000, NULL),
('402a408a412a425x', 5, '2018-06-29 15:18:58', 4, 1620000, '1', 1620000, NULL),
('413a416a418a421x173b174b175b188b189b190b191', 7, '2018-07-08 12:23:52', 11, 1501500, '1', 1501500, NULL),
('458a464a424a443a492a497x218', 7, '2018-07-08 17:54:07', 7, 3800000, '1', 3800000, NULL),
('463x', 5, '2018-06-30 15:06:24', 1, 270000, '1', 270000, NULL),
('469a486x', 5, '2018-07-13 17:59:15', 2, 810000, '1', 810000, NULL),
('565x', 5, '2018-09-18 11:27:02', 1, 270000, '2', 270000, NULL),
('88x19', 4, '2018-04-02 17:33:27', 2, 2912500, '', 2912500, NULL),
('98a109a111a127a135a170a178a219a220a306a307x', 9, '2018-04-23 12:15:56', 11, 4850000, '', 4850000, NULL),
('x196', 5, '2018-09-19 13:15:34', 1, -26000, '2', 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penawaran_owner`
--

CREATE TABLE IF NOT EXISTS `tb_penawaran_owner` (
  `kd_penawaran` int(4) NOT NULL AUTO_INCREMENT,
  `kd_owner` int(4) NOT NULL,
  `kd_unit` int(4) NOT NULL,
  `judul` varchar(30) NOT NULL,
  `pesan` varchar(300) NOT NULL,
  `h_owner_wd` int(20) NOT NULL,
  `h_owner_we` int(20) NOT NULL,
  `h_owner_mg` int(20) NOT NULL,
  `h_owner_bln` int(20) NOT NULL,
  `status` char(1) NOT NULL COMMENT '0: Wait, 1:Acc, 2:rejected, 3:final',
  `tgl_penawaran` datetime NOT NULL,
  PRIMARY KEY (`kd_penawaran`),
  KEY `kd_owner` (`kd_owner`),
  KEY `kd_unit` (`kd_unit`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `tb_penawaran_owner`
--

INSERT INTO `tb_penawaran_owner` (`kd_penawaran`, `kd_owner`, `kd_unit`, `judul`, `pesan`, `h_owner_wd`, `h_owner_we`, `h_owner_mg`, `h_owner_bln`, `status`, `tgl_penawaran`) VALUES
(1, 3, 19, 'Turunkan Harga Beras', 'Pada bulan ini beras sedang mengalami kenaikan harga, alagkah baiknya turunkan harga yang saudara jual,', 280000, 0, 0, 3000000, '0', '0000-00-00 00:00:00'),
(3, 3, 23, 'Stay With ME', 'Dapatkan Hadiah menarik setelah menyalakan obor asian games :v', 200000, 300000, 0, 20000, '0', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penyewa`
--

CREATE TABLE IF NOT EXISTS `tb_penyewa` (
  `kd_penyewa` int(4) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_tlp` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `tgl_gabung` date NOT NULL,
  PRIMARY KEY (`kd_penyewa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=378 ;

--
-- Dumping data untuk tabel `tb_penyewa`
--

INSERT INTO `tb_penyewa` (`kd_penyewa`, `nama`, `alamat`, `no_tlp`, `jenis_kelamin`, `email`, `tgl_gabung`) VALUES
(54, 'Muhamad Lokman', 'Johor, Malaysia', '+60127967065', 'Laki-laki', 'airbnb@airbnb.com', '2018-02-18'),
(55, 'Delfina Paramita', 'Jakarta', '08129091669', 'Perempuan', 'airbnb@airbnb.com', '2018-02-18'),
(56, 'test data', 'apakah sudah bisa', '081234567', 'Laki-laki', 'test@cozzal.com', '2018-02-20'),
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
(76, 'Fadil J and T', 'Jakarta', 'ke anna', 'Laki-laki', 'dummy@cozzal.com', '2018-03-05'),
(77, 'Andriani', 'Jawa Barat', '081290689592', 'Perempuan', 'dummy@cozzal.com', '2018-03-06'),
(79, 'Nadya', 'Jakarta', '081295999628', 'Perempuan', 'dummy@cozzal.com', '2018-03-06'),
(81, 'Faiz Kurniawan', 'Jakarta', ' 0856 9147 5405', 'Laki-laki', 'airbnb@airbnb.com', '2018-03-06'),
(82, 'Fatmawati Karima', 'Jakarta', '0811 265 2617', 'Perempuan', 'dummy@airbnb.com', '2018-03-07'),
(83, 'Sarwendah', 'Jakarta', 'ke anna', 'Perempuan', 'dummy@cozzal.com', '2018-03-10'),
(88, 'siti khairul bariyyah', 'jakarta', '08179988127', 'Perempuan', 'dummy@gmail.com', '2018-03-18'),
(89, 'christine permatasari', 'jakarta barat', '081310494188', 'Perempuan', 'dummy@gmail.com', '2018-03-18'),
(92, 'dea azalia', 'bandung', '08997470324', 'Perempuan', 'dummy@gmail.com', '2018-03-19'),
(93, 'Andini', 'Jakarta', '085945600293', 'Perempuan', 'dummy@cozzal.com', '2018-03-19'),
(94, 'yuni', 'bandung', 'ke anna', 'Perempuan', 'dummy@gmail.com', '2018-03-20'),
(95, 'pake kerudung', 'bandung', 'ke anna', 'Perempuan', 'dummy@gmail.com', '2018-03-20'),
(96, 'caca', 'jakarta', '081318072613', 'Perempuan', 'du', '2018-03-20'),
(97, 'Miranti', 'Jakarta', '08170819621', 'Perempuan', 'dummy@cozzal.com', '2018-03-21'),
(98, 'dewi', 'bandung', 'ke anna', 'Perempuan', 'dummy@gmail.com', '2018-03-21'),
(99, 'Ridwan', 'Jakarta', '081388842257', 'Laki-laki', 'dummy@cozzal.com', '2018-03-22'),
(100, 'Rani', 'Jakarta', 'ke anna', 'Perempuan', 'dummy@cozzal.com', '2018-03-23'),
(101, 'Randhika Ryan', 'Banten', '0812 9163 5184', 'Laki-laki', 'dummy@airbnb.com', '2018-03-23'),
(102, 'Tedi', 'Jakarta', 'ke anna', 'Laki-laki', 'dummy@cozzal.com', '2018-03-23'),
(103, 'nadia', 'Jakarta', 'ke anna', 'Perempuan', 'dummy@cozzal.com', '2018-03-23'),
(105, 'alvin', 'bekasi', '081218644453', 'Laki-laki', 'dummy@gmail.com', '2018-03-25'),
(106, 'Fenta Pertiwi', 'Jakarta', '0857 7777 4788', 'Perempuan', 'dummy@airbnb.com', '2018-03-26'),
(107, 'Fandi', 'Jakarta', 'ke anna', 'Laki-laki', 'dummy@cozzal.com', '2018-03-27'),
(109, 'fini', 'jakarta', '081911813801', 'Perempuan', 'dummy@gmail.com', '2018-03-28'),
(111, 'sisi', 'jakarta', '08114440903', 'Perempuan', 'dummy@gmail.com', '2018-03-28'),
(112, 'Nita Thesiana', 'Jakarta', '0877 8817 0999', 'Perempuan', 'dummy@airbnb.com', '2018-03-28'),
(113, 'Zakky Yoga', 'Jakarta', ' 0857-2622-1535', 'Laki-laki', 'dummy@cozzal.com', '2018-03-31'),
(114, 'Bambang Budiarjo', 'Jakarta', '085711192494', 'Laki-laki', 'dummy@cozzal.com', '2018-03-31'),
(115, 'Hanna S', 'Jakarta', '087788877438', 'Perempuan', 'dummy@cozzal.com', '2018-04-01'),
(120, 'echa', 'jakarta ', '089601820493', 'Perempuan', 'dummy@gmail.com', '2018-04-04'),
(121, 'lena', 'jakarta', '085378905111', 'Perempuan', 'dummy@gmail.com', '2018-04-04'),
(127, 'Hari Susanto', 'Jakarta', '0813-1506-1560', 'Laki-laki', 'dummy@cozzal.com', '2018-04-05'),
(128, 'Dedi Newton', 'Bandung', 'ke anna', 'Laki-laki', 'guest@cozzal.com', '2018-04-06'),
(134, 'Priska Susanti Darma', 'Jakarta', ' +62 878 8190 2', 'Perempuan', 'guest@airbnb.com', '2018-04-08'),
(135, 'Ayu Ferabianie', 'Jakarta', ' +62 816 148 33', 'Perempuan', 'guest@airbnb.com', '2018-04-08'),
(136, 'Fadhil Berylian', 'Jakarta', ' +62 812 8002 8', 'Laki-laki', 'guest@airbnb.com', '2018-04-08'),
(137, 'Dimas Aji', 'Jakarta', ' +62 813 1048 2659', 'Laki-laki', 'guest@airbnb.com', '2018-04-08'),
(139, 'Arief Wiriadinata', 'Jakarta', ' +62 811 495 777', 'Laki-laki', 'guest@airbnb.com', '2018-04-09'),
(140, 'Arief Umar', 'Jakarta', ' +62 813 4240 6132', 'Laki-laki', 'guest@airbnb.com', '2018-04-09'),
(141, 'Acoy', 'Bandung', '081394268987', 'Laki-laki', 'guest@cozzal.com', '2018-04-09'),
(143, 'Bill Nahuway-Ramschie', 'Jakarta', ' +62 812 9920 6037', 'Laki-laki', 'guest@airbnb.com', '2018-04-10'),
(144, 'Nikita Camila', 'Jakarta', '081296647982', 'Perempuan', 'guest@cozzal.com', '2018-04-10'),
(145, 'Hania Puspita', 'Jakarta', '087878081997', 'Perempuan', 'guest@cozzal.com', '2018-04-11'),
(146, 'Arif Karim', 'Jakarta', ' +62 812 1800 5646', 'Laki-laki', 'guest@airbnb.com', '2018-04-11'),
(148, 'Rangga Pradipta', 'Jakarta', ' +62 857 3101 3115', 'Laki-laki', 'guest@airbnb.com', '2018-04-11'),
(149, 'Jeremy Widjaja', 'Jakarta', ' +62 818 0804 4275', 'Laki-laki', 'guest@airbnb.com', '2018-04-11'),
(150, 'Dicky Gusman', 'Jakarta', ' +62 857 1171 0994', 'Laki-laki', 'guest@airbnb.com', '2018-04-12'),
(152, 'Purnima Iyer', 'Kolkata, India', '+919738368317', 'Perempuan', 'dummy@cozzal.com', '2018-04-13'),
(153, 'puji', 'bandung', '08129351634', 'Perempuan', 'dummy@gmail.com', '2018-04-14'),
(154, 'Teguh Prayitno', 'Jakarta', ' +62 878 7377 9023', 'Laki-laki', 'guest@airbnb.com', '2018-04-14'),
(155, 'elis', 'jakarta', '083876798809', 'Perempuan', 'unknown@gmail.com', '2018-04-14'),
(158, 'Widya Nisa', 'Jakarta', '081319259887', 'Perempuan', 'guest@cozzal.com', '2018-04-15'),
(160, 'fitri hardigaluh', 'jl.kenari n0 224 depok utara', 'ke anna', 'Perempuan', 'unknown@gmail.com', '2018-04-17'),
(161, 'Andika Pratama', 'Jakarta', ' +62 811 126 0092', 'Perempuan', 'guest@airbnb.com', '2018-04-17'),
(162, 'Tieke', 'Bandung', '081394887780', 'Perempuan', 'Unknown@gmail.com', '2018-04-17'),
(163, 'Bima Satria Surya Wardhan', 'Jakarta', ' +62 812 8285 3165', 'Laki-laki', 'guest@airbnb.com', '2018-04-18'),
(164, 'azwar', 'jakarta', '083896366299', 'Laki-laki', 'unknown@gmail.com', '2018-04-19'),
(165, 'Ida Winingsih', 'Jakarta', ' +62 812 2426 6276', 'Perempuan', 'guest@airbnb.com', '2018-04-18'),
(168, 'bambang', 'jakarta', '081772313340', 'Laki-laki', 'unknown@gmail.com', '2018-04-20'),
(170, 'Wahyu Handriana', 'Jakarta', ' +62 856 2425 5392', 'Laki-laki', 'guest@airbnb.com', '2018-04-20'),
(172, 'Ari Heryanto', 'Jakarta', ' +62 821 1116 6622', 'Laki-laki', 'guest@airbnb.com', '2018-04-21'),
(173, 'Salma Osanar Kunju', 'Kuala Lumpur ', ' +60 11 616 15015', 'Perempuan', 'guest@airbnb.com', '2018-04-21'),
(174, 'Veranissa', 'Jakarta', '082208220390', 'Perempuan', 'guest@cozzal.com', '2018-04-23'),
(175, 'Reno Repeat', 'Jakarta', '0895320540544', 'Laki-laki', 'guest@cozzal.com', '2018-04-23'),
(176, 'indri', 'jakarta', '087885783865', 'Perempuan', 'unknown@gmail.com', '2018-04-24'),
(179, 'joko wardhoyo', 'jakarta', '089660275466', 'Laki-laki', 'unknown@gmail.com', '2018-04-24'),
(182, 'LASYA/PT ANEKA', 'jakarta ', '081210392021', 'Laki-laki', 'unknown@gmail.com', '2018-04-24'),
(183, 'Astrid Tampilunik', 'Jakarta', ' +62 815 901 0310', 'Perempuan', 'guest@airbnb.com', '2018-04-24'),
(184, 'Nurul', 'Jakarta', '08978570539', 'Perempuan', 'guest@cozzal.com', '2018-04-25'),
(185, 'iwan', 'jakarta', '082127019133', 'Laki-laki', 'unknown@gmail.com', '2018-04-25'),
(186, 'Adit', 'bandung', '082150409878', 'Laki-laki', 'unknown@gmail.com', '2018-04-25'),
(188, 'Ratih', 'Jakarta', '081212836578', 'Perempuan', 'unknown@gmail.com', '2018-04-25'),
(189, 'Putri Gempitasari', 'Jakarta', ' +62 878 7799 4297', 'Perempuan', 'guest@airbnb.com', '2018-04-26'),
(190, 'shervyn', 'Jakarta', '+60126827209', 'Laki-laki', 'unknown@gmail.com', '2018-04-27'),
(191, 'farah saufika', 'Jakarta', '081214526729', 'Perempuan', 'unknown@gmail.com', '2018-04-27'),
(192, 'Wahyu Novian Saputra', 'Jakarta', ' +62 857 2408 8566', 'Laki-laki', 'guest@airbnb.com', '2018-04-28'),
(193, 'Windri', 'jakarta', '087889479450', 'Perempuan', 'unknown@gmail.com', '2018-04-29'),
(195, 'sofa', 'jakarta', '123456', 'Perempuan', 'unk', '2018-04-29'),
(196, 'Winni', 'Bandung', 'O82127019133', 'Perempuan', 'Unknown@gmail.com', '2018-04-30'),
(197, 'Alfian Ian', 'Jakarta', ' +62 822 4690 5499', 'Laki-laki', 'guest@airbnb.com', '2018-04-30'),
(198, 'Yuli Widyanti', 'Jakarta', ' +62 812 9521 3813', 'Perempuan', 'guest@airbnb.com', '2018-04-30'),
(199, 'bonur manik', 'gunung putri indonesia', '081808986607', 'Perempuan', 'guest@airbnb.com', '2018-04-30'),
(200, 'Rouline', 'Medan', '087808596670', 'Perempuan', 'guest@cozzal.com', '2018-05-01'),
(201, 'Latitia Pramudito', 'Jakarta', ' +62 812 8377 2029', 'Perempuan', 'guest@airbnb.com', '2018-05-03'),
(202, 'Selina Moll', 'Germany', ' +84 128 2416497', 'Perempuan', 'guest@airbnb.com', '2018-05-07'),
(203, 'Suryanto Aripin', 'Jakarta', ' +62 896 8735 2954', 'Laki-laki', 'guest@airbnb.com', '2018-05-07'),
(204, 'nadia disti', 'jakarta', '081295999628', 'Perempuan', 'unknown@gmail.com', '2018-05-08'),
(205, 'edi', 'jakarta', '0812345678', 'Laki-laki', 'unknown@gmail.com', '2018-05-08'),
(206, 'Gumilang', 'Jakarta', '087788535001', 'Laki-laki', 'Guest.cozzal@gmail.com', '2018-05-08'),
(208, 'Lutfi Maulana', 'Jakarta', '087870696645', 'Laki-laki', 'Guest.cozzal@gmail.com', '2018-05-09'),
(209, 'Syiifa Salma', 'Jakarta', ' +62 812 1829 9131', 'Perempuan', 'guest@airbnb.com', '2018-05-09'),
(210, 'Syifa Salma', 'Jakarta', '081218299131', 'Perempuan', 'Guestbnb@gmail.com', '2018-05-09'),
(215, 'Citra', 'Jakarta', '08568402267', 'Laki-laki', 'guest@cozzal.com', '2018-05-10'),
(216, 'Edi Prasetyo', 'Jakarta', '082234010210', 'Laki-laki', 'guest@cozzal.com', '2018-05-10'),
(217, 'Jonathan Maulino', 'Jakarta', ' +1 (925) 997-2383', 'Laki-laki', 'guest@airbnb.com', '2018-05-10'),
(218, 'Teun Wildemans', 'Jakarta', ' +62 838 7722 1526', 'Laki-laki', 'guest@airbnb.com', '2018-05-10'),
(219, 'muhamad ardiansyah', 'jakarta', '087711236247', 'Laki-laki', 'unknown@gmail.com', '2018-05-12'),
(220, 'Alfie', 'Jakarta', '+62 877-4848-3923', 'Laki-laki', 'guest@cozzal.com', '2018-05-12'),
(221, 'Lutfiah Hanunah', 'Lampung', '082234199990', 'Perempuan', 'guest@cozzal.com', '2018-05-13'),
(222, 'Decky Prasetya', 'Jakarta', ' +62 811 187 8999', 'Laki-laki', 'guest@airbnb.com', '2018-05-13'),
(223, 'Inas Khairunnisa', 'Bangka Belitung', '082186673995', 'Perempuan', 'guest@cozzal.com', '2018-05-17'),
(224, 'Hari Hadi', 'Jakarta', ' +62 817 724 735', 'Laki-laki', 'guest@airbnb.com', '2018-05-17'),
(225, 'Moses', 'Jakarta', '+62 857-8117-6457', 'Laki-laki', 'guest@cozzal.com', '2018-05-18'),
(226, 'tri', 'jakarta', '08179184581', 'Perempuan', 'guest@cozzal.com', '2018-05-25'),
(227, 'Anastasia Magdalena', 'Jakarta', '08119133505', 'Perempuan', 'guest@cozzal.com', '2018-05-26'),
(228, 'Putri Wulan Apsari', 'Jakarta', '+62 878 9380 8097', 'Perempuan', 'guest@airbnb.com', '2018-05-26'),
(229, 'Iman', 'Jakarta', '081299068254', 'Laki-laki', 'Guest@cozzal.com', '2018-05-27'),
(230, 'Qotrun', 'jakarta', '085773497516', 'Perempuan', 'guest@cozzal.com', '2018-05-28'),
(233, 'Fahmi Kurniawan', 'Takarazuka, Japan', '+62 821 1843 1589', 'Laki-laki', 'guest@airbnb.com', '2018-05-29'),
(234, 'siska', 'jakarta', '088980202268', 'Laki-laki', 'guest@gmail.com', '2018-05-30'),
(235, 'Alvin L', 'Jakarta', '+62 812-4503-9558', 'Laki-laki', 'guest@cozzal.com', '2018-05-30'),
(236, 'Heri Efendi', 'Jakarta', '+62 813 8163 8843', 'Laki-laki', 'guest@airbnb.com', '2018-05-31'),
(241, 'Robby', 'Jakarta', '081310404414', 'Laki-laki', 'guest@cozzal.com', '2018-06-01'),
(242, 'johan', 'garut', '087883460706', 'Laki-laki', 'guest@airbnb.com', '2018-06-01'),
(243, 'leo', 'Jakarta', '082114869309', 'Laki-laki', 'guestbnb@gmail.com', '2018-06-02'),
(244, 'Nana Resna', 'Jakarta', '+62 859 5931 1845', 'Perempuan', 'guest@airbnb.com', '2018-06-02'),
(245, 'Leo Raynaldi', 'Jakarta', '081298638623', 'Laki-laki', 'guest@cozzal.com', '2018-06-02'),
(246, 'Lily Nuaraini', 'Jakarta', '08128130149', 'Laki-laki', 'guest@cozzal.com', '2018-06-02'),
(247, 'Cicilia Gunawan', 'Jakarta', '+62 819 1101 7116', 'Perempuan', 'guest@airbnb.com', '2018-06-02'),
(248, 'Madelene Pagan', 'Kailua, Hawaii', '+62 878 7161 5706', 'Perempuan', 'guest@airbnb.com', '2018-06-05'),
(249, 'Rizki Gutama', 'Jakarta', '+62 815 873 8468', 'Laki-laki', 'guest@airbnb.com', '2018-06-06'),
(250, 'M. Chandru fachrani', 'Jakarta', '0123', 'Laki-laki', 'Guestcozzal@gmail.com', '2018-06-07'),
(251, 'Ria Soraya', 'Jakarta', '+62 811 910 0371', 'Perempuan', 'guest@airbnb.com', '2018-06-07'),
(252, 'Ananta Rezky', 'Jakarta', '+62 812 8529 9191', 'Perempuan', 'guest@airbnb.com', '2018-06-08'),
(253, 'Ari Mulya', 'Jakarta', '0811200512', 'Laki-laki', 'Guestbn@gmail.com', '2018-06-08'),
(254, 'Ananta Rezky', 'Jakarta', '+62 812 8529 9191', 'Laki-laki', 'guest@airbnb.com', '2018-06-08'),
(255, 'Ananta Rezky', 'Jakarta', '+62 812 8529 9191', 'Laki-laki', 'guest@airbnb.com', '2018-06-08'),
(256, 'Jade Putra', 'Jakarta', '081288459500', 'Laki-laki', 'Guest.cozzal@gmail.com', '2018-06-08'),
(257, 'Dini Arthalini', 'Jakarta', '+62 816 132 9933', 'Perempuan', 'guest@airbnb.com', '2018-06-08'),
(258, 'Travelio', 'Jakarta', 'agent', 'Laki-laki', 'guest@travelio.com', '2018-06-10'),
(259, 'asep samsudin', 'jakarta', '087883751402', 'Laki-laki', 'guestcozzal.com', '2018-06-10'),
(260, 'Ratna', 'Travelio', '081332872094', 'Perempuan', 'guest@travelio.com', '2018-06-11'),
(261, 'Irmatati Tjuatja', 'Jakarta', '+62 816 194 8311', 'Perempuan', 'guest@airbnb.com', '2018-06-11'),
(262, 'Fahmi Kurniawan', 'Jakarta', '+62 821 1843 1589', 'Laki-laki', 'guest@airbnb.com', '2018-06-11'),
(263, 'Doddy Prasetyo', 'Jakarta', '+62 815 954 1451', 'Laki-laki', 'guest@airbnb.com', '2018-06-11'),
(264, 'indri dwiputri', 'jakarta', '087887047743', 'Perempuan', 'guest@gmail.com', '2018-06-13'),
(265, 'Willy', 'Jakarta', '085655501552', 'Laki-laki', 'guest@cozzal.com', '2018-06-14'),
(266, 'Lindana', 'Jakarta', '082312987828', 'Perempuan', 'guest@cozzal.com', '2018-06-14'),
(267, 'Intan Anggita', 'Jakarta', '+62 812 1932 6998', 'Perempuan', 'guest@airbnb.com', '2018-06-14'),
(268, 'Paulina Paulina', 'Jakarta', '+62 812 8095 7582', 'Perempuan', 'guest@airbnb.com', '2018-06-14'),
(269, 'Sigit Aprianto', 'Jakarta', '+62 857 7818 4953', 'Laki-laki', 'guest@airbnb.com', '2018-06-16'),
(270, 'Budiyanto Budiyanto', 'Jakarta', '+62 818 678 745', 'Laki-laki', 'guest@airbnb.com', '2018-06-16'),
(271, 'Sahat Hutajulu', 'Jakarta', '+62 818 0860 4533', 'Laki-laki', 'guest@airbnb.com', '2018-06-17'),
(272, 'Estu Suparmaji', 'Jakarta', '+62 811 559 001', 'Laki-laki', 'guest@airbnb.com', '2018-06-17'),
(273, 'pamela', 'jakarta', '081908624211', 'Perempuan', 'guestcozzal.com', '2018-06-17'),
(274, 'Septi anggraeni', 'Jakarta', '085697430950', 'Perempuan', 'Guest@cozzal.com', '2018-06-19'),
(275, 'Esha', 'Bandung', '087770983361', 'Perempuan', 'Guest@cozzal.com', '2018-06-19'),
(276, 'Murdani Gh', 'Jakarta', '+62 811 816 201', 'Laki-laki', 'guest@airbnb.com', '2018-06-20'),
(277, 'Marifah', 'Jakarta', '081380037670', 'Perempuan', 'guest@cozzal.com', '2018-06-21'),
(278, 'Vera Valentine', 'Jakarta', '+62 878 7856 5106', 'Perempuan', 'guest@airbnb.com', '2018-06-20'),
(279, 'Theresia Diana', 'Jakarta', '0899 897 8272', 'Perempuan', 'guest@airbnb.com', '2018-06-21'),
(280, 'lita', 'bandung', '08179203525', 'Perempuan', 'guestcozzal.com', '2018-06-21'),
(281, 'Marita', 'Jakarta', 'Ke teh anna', 'Perempuan', 'Guestbnb@gnail.com', '2018-06-22'),
(282, 'Endar', 'Jakarta', '+62 812-9040-7471', 'Laki-laki', 'guest@cozzal.com', '2018-06-22'),
(283, 'Andreas', 'Jkrt', '08974208030', 'Laki-laki', 'Guest@cozzal.com', '2018-06-23'),
(284, 'Boma Anindito', 'Jakarta', '+62 812 919 5183', 'Laki-laki', 'guest@airbnb.com', '2018-06-23'),
(285, 'Rana Fitri Athaya', 'Jakarta', ' 0812-9923-2075', 'Perempuan', 'guest@cozzal.com', '2018-06-24'),
(286, 'Rival (Alim) ', 'Jakarta', '081287261949', 'Perempuan', 'guest@cozzal.com', '2018-06-25'),
(287, 'Heri Efendi', 'Jakarta', '087824981802', 'Laki-laki', 'guest@cozzal.com', '2018-06-25'),
(288, 'Shandy', 'jakarta', '08998863638', 'Laki-laki', 'guest@gmail.com', '2018-06-27'),
(294, 'Theresia Anggreani', 'Jakarta', '081314660188', 'Laki-laki', 'guest@airbnb.com', '2018-06-27'),
(295, 'Linda Permatasari', 'jakarta', '081809824448', 'Laki-laki', 'guest@gmail.com', '2018-06-27'),
(296, 'Maria', 'Jakarta', '081273841209', 'Perempuan', 'unknown@gmail.com', '2018-06-28'),
(297, 'Liz Citraningrum', 'Jakarta', '081945526737', 'Perempuan', 'guest@airbnb.com', '2018-06-28'),
(298, 'Liz Citraningrum', 'Jakarta', '081945526737', 'Perempuan', 'guest@airbnb.com', '2018-06-28'),
(299, 'Indira Shalwa', 'Jakarta', '081318011455', 'Perempuan', 'guest@airbnb.com', '2018-06-28'),
(300, 'Shamira Aziek', 'Jakarta', '081285498544', 'Perempuan', 'guest@airbnb.com', '2018-06-28'),
(301, 'Jessica', 'Jakarta', '081264883334', 'Perempuan', 'unknown@gmail.com', '2018-06-29'),
(302, 'Riris Hutapea', 'Jakarta', '081317172473', 'Perempuan', 'guest@airbnb.com', '2018-06-29'),
(303, 'Abe Doel', 'Jakarta', '08111180837', 'Laki-laki', 'guest@airbnb.com', '2018-06-29'),
(304, 'Rika Ikeda', 'Jakarta', '081220427936', 'Perempuan', 'guest@airbnb.com', '2018-06-29'),
(305, 'Melvien Welang', 'Jakarta', '0811950119', 'Perempuan', 'guest@airbnb.com', '2018-06-30'),
(306, 'Andry Chaidar', 'Jakarta', '082195856328', 'Laki-laki', 'guest@airbnb.com', '2018-06-30'),
(307, 'Elsya Saktya N', 'Jakarta', '081221153644', 'Perempuan', 'guest@cozzal.com', '2018-07-02'),
(309, 'Nella Mosses', 'Jakarta', '081311214577', 'Laki-laki', 'unknown@gmail.com', '2018-07-03'),
(310, 'Makky Ananda', 'Jakarta', '08129144662', 'Perempuan', 'unknown@gmail.com', '2018-07-03'),
(311, 'Rustian Sitorus', 'Jakarta', '087784600551', 'Laki-laki', 'guest@airbnb.com', '2018-07-03'),
(312, 'faisal', 'jakarta', '08986182869', 'Laki-laki', 'guest@bnb', '2018-07-04'),
(313, 'shandy/mirza', 'jakarta', '08984805584', 'Laki-laki', 'guestcozzal.com', '2018-07-04'),
(314, 'Nikolas Benyamin', 'Jakarta', '083822709165', 'Laki-laki', 'guest@airbnb.com', '2018-07-04'),
(315, 'Adelina Anastasia', 'Jakarta', '081807498089', 'Perempuan', 'guest@airbnb.com', '2018-07-04'),
(316, 'solomon', 'jakarta', '+62 857 1908 8888', 'Laki-laki', 'guest@airbnb.com', '2018-07-05'),
(317, 'Rizal Zj', 'Jakarta', '081224544341', 'Laki-laki', 'guest@airbnb.com', '2018-07-05'),
(318, 'opik', 'bandung', '081222818993', 'Laki-laki', 'guestcozzal.com', '2018-07-06'),
(319, 'Muhammad Rizal', 'Jakarta', '081234341015', 'Laki-laki', 'guest@airbnb.com', '2018-07-06'),
(320, 'sofian alim', 'jakarta', '081220107297', 'Laki-laki', 'guest@airbnb.com', '2018-07-07'),
(321, 'Irfan Budiman', 'Jakarta', '08122384799', 'Laki-laki', 'guest@airbnb.com', '2018-07-08'),
(322, 'ronny/ilham', 'jakarta', '083822709165', 'Laki-laki', 'unknown@gmail.com', '2018-07-09'),
(323, 'poy', 'jakarta', '087881268989', 'Laki-laki', 'unknown@gmail.com', '2018-07-09'),
(324, 'farah', 'jakarta', '082240205206', 'Perempuan', 'guestcozzal.com', '2018-07-10'),
(325, 'Ronny Boni', 'Jakarta', '081297448355', 'Laki-laki', 'guest@airbnb.com', '2018-07-10'),
(326, 'Gary Ega', 'Jakarta', '085711919121', 'Laki-laki', 'unknown@gmail.com', '2018-07-11'),
(327, 'Zairul', 'Malaysia', '+60174121723', 'Laki-laki', 'unknown@gmail.com', '2018-07-11'),
(328, 'Yulia Nadrah', 'Jakarta', '081361447144', 'Perempuan', 'guest@airbnb.com', '2018-07-10'),
(329, 'Zairul Najmi', 'Jakarta', '+60174121723', 'Laki-laki', 'guest@airbnb.com', '2018-07-10'),
(330, 'nova newton', 'bandung', '087825514469', 'Laki-laki', 'unknown@gmail.com', '2018-07-11'),
(331, 'Fera', 'Jakarta', '081289061330', 'Perempuan', 'guestbnb@gmail.com', '2018-07-11'),
(332, 'Tia Latief', 'Jakarta', '082211791361', 'Perempuan', 'unknown@gmail.com', '2018-07-12'),
(333, 'Ade Agustian Pramana', 'Jakarta', '082332526262', 'Laki-laki', 'guest@airbnb.com', '2018-07-13'),
(334, 'Mohammed Harthy', 'Jakarta', '087721924969', 'Laki-laki', 'guest@airbnb.com', '2018-07-13'),
(335, 'Andi Anju', 'Jakarta', '085721109300', 'Laki-laki', 'unknown@gmail.com', '2018-07-13'),
(336, 'Afrizal Muharam', 'Jakarta', '081936969932', 'Laki-laki', 'guest@airbnb.com', '2018-07-13'),
(337, 'Fitria Tarmizie', 'Jakarta', '081317977254', 'Perempuan', 'guest@airbnb.com', '2018-07-13'),
(338, 'Dzulfikar', 'Banten', '081318340482', 'Laki-laki', 'guest@cozzal.com', '2018-07-13'),
(339, 'Lalitya Pramudita', 'Jakarta', '081212005063', 'Perempuan', 'guest@airbnb.com', '2018-07-13'),
(340, 'Sakinah', 'Depok', '082299593926', 'Perempuan', 'guest@cozzal,com', '2018-07-15'),
(341, 'Cindhy', 'Jakarta', '085697545080', 'Perempuan', 'guest@cozzal.com', '2018-07-15'),
(342, 'Fajar Mars', 'Jakarta', '081261683349', 'Laki-laki', 'unknown@gmail.com', '2018-07-16'),
(343, 'Sova Iklima', 'Jakarta', '089634349686', 'Perempuan', 'unknown@gmail.com', '2018-07-16'),
(344, 'Dina Hafsah', 'Jakarta', '081290912735', 'Perempuan', 'guest@cozzal.com', '2018-07-17'),
(347, 'Alexander Wibisono', 'Jakarta', '08159407601', 'Laki-laki', 'guest@airbnb.com', '2018-07-17'),
(348, 'yanti ', 'jakarta', '081998888500', 'Perempuan', 'guest@cozzal.com', '2018-07-17'),
(349, 'Dhamar sumarwan', 'Jakarta', '081291107430', 'Laki-laki', 'Guest@cozzal.com', '2018-07-17'),
(350, 'Heni ', 'Jakarta', '082153715798', 'Perempuan', 'guest@cozzal.com', '2018-07-18'),
(351, 'Rian', 'Jakarta', '083896366299', 'Laki-laki', 'unknown@gmail.com', '2018-07-18'),
(352, 'Iska Sri Marwani', 'Jakarta', '081214714985', 'Perempuan', 'unknown@gmail.com', '2018-07-18'),
(353, 'Donny Riyanto', 'Jakarta', '82164000411', 'Laki-laki', 'unknown@gmail.com', '2018-07-19'),
(354, 'Syarief Abdurrachman', 'Jakarta', '087825755002', 'Laki-laki', 'guest@airbnb.com', '2018-07-19'),
(355, 'Yuna Surya Pramesti', 'Jakarta', '081299074158', 'Perempuan', 'guest@cozzal.com', '2018-07-19'),
(356, 'Turenti', 'Jakarta', '081517063598', 'Perempuan', 'guest@cozzal.com', '2018-07-19'),
(357, 'Safira Adnan', 'Medan', '08116144198', 'Perempuan', 'guest@airbnb.com', '2018-07-19'),
(358, 'Rachman Rizky', 'Jakarta', '+62 831 2100 3745', 'Laki-laki', 'unknown@gmail.com', '2018-07-20'),
(359, 'Anbya Tiara Paradiesa', 'Jakarta', ' +62 811 156 1468', 'Perempuan', 'guest@airbnb.com', '2018-07-21'),
(360, 'Sulina Alex', 'Jakarta', '081585924453', 'Perempuan', 'unknown@gmail.com', '2018-07-21'),
(361, 'Wahyu Pamungkas', 'Jakarta', '0895640411452', 'Laki-laki', 'guest@airbnb.com', '2018-07-21'),
(362, 'wahyu Pamungkas', 'Jakarta', '083822709165', 'Laki-laki', 'unknown@gmail.com', '2018-07-22'),
(363, 'wahyu Pamungkas', 'Jakarta', '083822709165', 'Laki-laki', 'unknown@gmail.com', '2018-07-22'),
(364, 'Niqo Kintaro', 'Jakarta', '083811081563', 'Laki-laki', 'guest@airbnb.com', '2018-07-24'),
(365, 'Yandri PLN', 'Jakarta', '08111072009', 'Laki-laki', 'unknown@gmail.com', '2018-07-24'),
(366, 'Kevin Goenawan', 'Jakarta', '081219899777', 'Laki-laki', 'guest@airbnb.com', '2018-07-24'),
(367, 'Esther', 'BSD', 'ke Yusuf', 'Perempuan', 'guest@cozzal.com', '2018-07-25'),
(368, 'yunan PLN', 'Jakarta', '081325548019', 'Laki-laki', 'unknown@gmail.com', '2018-07-25'),
(369, 'Anna Widiasih', 'Jakarta', '085222800280', 'Perempuan', 'guest@airbnb.com', '2018-07-26'),
(370, 'Rastie Lanina', 'Jakarta', '081398007414', 'Perempuan', 'guest@airbnb.com', '2018-07-26'),
(371, 'Niklas Eberhardt', 'Luar Nagreg', '+4917664778230', 'Laki-laki', 'guest@airbnb.com', '2018-07-27'),
(372, 'Gunawan', 'Jakarta', '082213399022', 'Laki-laki', 'guest@cozzal.com', '2018-07-27'),
(373, 'Selvina', 'jakarta', '087781548805', 'Perempuan', 'guest@cozzal.com', '2018-07-27'),
(374, 'Rachmawati', 'Bogor', '08568733664', 'Perempuan', 'guest@cozzal.com', '2018-07-27'),
(375, 'Beben Sugeh', 'Jakarta', '087870853368', 'Laki-laki', 'guest@airbnb.com', '2018-08-12'),
(376, 'imron', 'ganteng', '09214124', 'Laki-laki', 'cenah@gmail.com', '2018-09-30'),
(377, 'imron', 'ganteng', '094124', 'Laki-laki', 'cenah@gmail.com', '2018-09-30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_recommended`
--

CREATE TABLE IF NOT EXISTS `tb_recommended` (
  `kd_recommended` int(4) NOT NULL AUTO_INCREMENT,
  `kd_penyewa` int(4) NOT NULL,
  `last_stay1` date NOT NULL,
  `last_stay2` date NOT NULL,
  `last_stay3` date NOT NULL,
  PRIMARY KEY (`kd_recommended`),
  KEY `kd_penyewa` (`kd_penyewa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_request_listing`
--

CREATE TABLE IF NOT EXISTS `tb_request_listing` (
  `kd_request_listing` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(40) NOT NULL,
  `alamat` varchar(60) NOT NULL,
  `no_tlp` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `apartemen` varchar(30) NOT NULL,
  `tipe` varchar(20) NOT NULL,
  `lantai` int(11) NOT NULL,
  `kondisi` varchar(20) NOT NULL,
  `status` varchar(15) NOT NULL,
  PRIMARY KEY (`kd_request_listing`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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
  `kd_reservasi` int(4) NOT NULL AUTO_INCREMENT,
  `kd_apt` int(4) NOT NULL,
  `kd_unit` int(4) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `nama` varchar(20) NOT NULL,
  `no_tlp` varchar(15) NOT NULL,
  `tgl_reservasi` date NOT NULL,
  PRIMARY KEY (`kd_reservasi`),
  KEY `kd_apt` (`kd_apt`),
  KEY `kd_unit` (`kd_unit`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

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
  `kd_task` int(11) NOT NULL AUTO_INCREMENT,
  `task` varchar(100) DEFAULT NULL,
  `unit` varchar(30) DEFAULT NULL,
  `sifat` varchar(10) DEFAULT NULL,
  `tgl_task` date DEFAULT NULL,
  PRIMARY KEY (`kd_task`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data untuk tabel `tb_task`
--

INSERT INTO `tb_task` (`kd_task`, `task`, `unit`, `sifat`, `tgl_task`) VALUES
(19, 'Buang Sampah', '!20!22', 'Rutin', NULL),
(20, 'Cek Galon, Gas dan Amenities', 'Semua', 'Rutin', NULL),
(21, 'Cek Meteran Listrik', '&20&22&23&26', 'Rutin', NULL),
(22, 'Cuci Piring dan Bersihkan Dapur', '!20!22', 'Rutin', NULL),
(23, 'Ganti Sprei dan Sarung Bantal', '!20!22', 'Rutin', NULL),
(24, 'Kembalikan Kunci', '&20&22', 'Rutin', NULL),
(25, 'Sapu dan Pel Tiap Ruangan', '!20!22', 'Rutin', NULL),
(26, 'Bebas Aja Ya', 'Semua', 'Sekali', '2018-08-28'),
(27, 'Coba1', '&11&12&19', 'Sekali', '2018-08-31'),
(28, 'qwdqwd', 'Semua', 'Rutin', NULL),
(29, 'handawe', 'Semua', 'Rutin', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_task_unit`
--

CREATE TABLE IF NOT EXISTS `tb_task_unit` (
  `kd_unit` int(4) DEFAULT NULL,
  `kd_task` int(4) DEFAULT NULL,
  `status` char(1) DEFAULT NULL COMMENT 'D = Done; null = Undone',
  KEY `kd_unit` (`kd_unit`),
  KEY `kd_task` (`kd_task`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_task_unit`
--

INSERT INTO `tb_task_unit` (`kd_unit`, `kd_task`, `status`) VALUES
(9, 19, NULL),
(9, 20, NULL),
(9, 22, NULL),
(9, 23, NULL),
(9, 25, NULL),
(23, 19, NULL),
(23, 20, NULL),
(23, 21, NULL),
(23, 22, NULL),
(23, 23, NULL),
(23, 25, NULL),
(22, 20, NULL),
(22, 21, NULL),
(22, 24, NULL),
(12, 19, NULL),
(12, 20, NULL),
(12, 22, NULL),
(12, 23, NULL),
(12, 25, NULL),
(24, 19, NULL),
(24, 20, NULL),
(24, 22, NULL),
(24, 23, NULL),
(24, 25, NULL),
(30, 19, NULL),
(30, 20, NULL),
(30, 22, NULL),
(30, 23, NULL),
(30, 25, NULL),
(11, 19, NULL),
(11, 20, NULL),
(11, 22, NULL),
(11, 23, NULL),
(11, 25, NULL),
(20, 20, NULL),
(20, 21, NULL),
(20, 24, NULL),
(19, 19, NULL),
(19, 20, NULL),
(19, 22, NULL),
(19, 23, NULL),
(19, 25, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_token_fcm`
--

CREATE TABLE IF NOT EXISTS `tb_token_fcm` (
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `tb_token_fcm`
--

INSERT INTO `tb_token_fcm` (`username`, `token`) VALUES
('samun', 'eq38tYyaWPU:APA91bHw351gsf_lfjC2vFJ9Y7yT1m3cgYnYoJ8R5NSt6USVmoe12BZNvU4aM4LXH6prvLG9JMqnNWrShjXM9rK9T4SeG534PI2tGQZa3x4Z4RUl-T4lAdn11-7KMwBVHCYdLX272Qw3gUx38mp6_B1hqqaER56TYw'),
('owner', 'cXi0IuaK2mg:APA91bHdQPt1388NWBYXhncj9AC8H49tzHzMeIKcCsC9UVbCZVrGYncVuyc6D1dhAsa5aV_OMIdYEnOpoTThlJb9o2_0Jy1k4iXneCJEdNeq4sZ6WoC4dmyDBBcw8NomCdgIKVqkj_vwJIxe8KFalo5O2xddHEvYIg'),
('owner', 'cN7Vq9RdENs:APA91bHCvse9wlXZaa96Wxep3aCM2d8Eks3quSDnNapjDKbQ_Pie9aIA0GVuI-jup6PoGSWF-pdzvHmLanOwu7EnGSgZIewNEfIagtLvdC-uQea-SD3TJz4tee5kqyNW072c7CvsX2rNVI9GP65VggY8u_Qq_Xo0Ng'),
('owner', 'eq38tYyaWPU:APA91bHw351gsf_lfjC2vFJ9Y7yT1m3cgYnYoJ8R5NSt6USVmoe12BZNvU4aM4LXH6prvLG9JMqnNWrShjXM9rK9T4SeG534PI2tGQZa3x4Z4RUl-T4lAdn11-7KMwBVHCYdLX272Qw3gUx38mp6_B1hqqaER56TYw'),
('owner', 'fvqPy4fYTEg:APA91bEQpNr3t2aSedgvT4WESLGvz9cb0PVqp_dxc0ZV5UEGV3ToliJziQO6B8GxMOOg6f2F3l_4Vo-yT0mYEXNvuq_ZG_e0hihgzbwMseqV3F_eP-M1jVvzc8C86pfSLfye9dL3iixkiW5Xs6bSNmNT51ju8SOxRQ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE IF NOT EXISTS `tb_transaksi` (
  `kd_transaksi` int(4) NOT NULL AUTO_INCREMENT,
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
  `harga_sewa_gbg` int(11) NOT NULL,
  `harga_owner` int(20) NOT NULL,
  `harga_owner_weekend` int(20) NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  `diskon` int(20) NOT NULL,
  `ekstra_charge` int(20) NOT NULL,
  `kd_bank` int(4) NOT NULL,
  `kd_kas` int(4) NOT NULL,
  `tamu` int(11) NOT NULL,
  `kd_booking` int(5) NOT NULL,
  `dp` int(20) NOT NULL,
  `setlement_dp` int(20) NOT NULL,
  `deposit` int(11) NOT NULL,
  `setlement_deposit` int(11) NOT NULL,
  `total_tagihan` int(20) NOT NULL,
  `total_harga_owner` int(20) NOT NULL,
  `sisa_pelunasan` int(20) NOT NULL,
  `catatan` varchar(300) NOT NULL,
  `pembayaran` int(20) NOT NULL,
  `status` char(5) NOT NULL COMMENT '1:Book, 2:Cancel, 3:Setlement, 41:CPaid, 42:CUnpaid',
  PRIMARY KEY (`kd_transaksi`),
  KEY `kd_penyewa` (`kd_penyewa`),
  KEY `kd_unit` (`kd_unit`),
  KEY `kd_apt` (`kd_apt`),
  KEY `kd_booking` (`kd_booking`),
  KEY `kd_bank` (`kd_bank`),
  KEY `kd_kas` (`kd_kas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=598 ;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`kd_transaksi`, `kd_penyewa`, `kd_apt`, `kd_unit`, `check_in`, `check_out`, `hari_weekend`, `hari_weekday`, `hari`, `harga_sewa`, `harga_sewa_weekend`, `harga_sewa_gbg`, `harga_owner`, `harga_owner_weekend`, `tgl_transaksi`, `diskon`, `ekstra_charge`, `kd_bank`, `kd_kas`, `tamu`, `kd_booking`, `dp`, `setlement_dp`, `deposit`, `setlement_deposit`, `total_tagihan`, `total_harga_owner`, `sisa_pelunasan`, `catatan`, `pembayaran`, `status`) VALUES
(88, 58, 1, 9, '2018-02-15', '2018-03-15', 8, 20, 28, 350000, 350000, 0, 275000, 275000, '2018-02-25 00:00:00', 2800000, 0, 5, 5, 5, 1, 7000000, 0, 0, 0, 7000000, 3500000, 0, '', 0, '41'),
(98, 66, 1, 12, '2018-03-10', '2018-03-12', 1, 1, 2, 400000, 400000, 0, 275000, 325000, '2018-02-28 00:00:00', 0, 0, 5, 5, 5, 1, 450000, 0, 0, 0, 800000, 0, 0, '', 350000, '41'),
(101, 69, 6, 23, '2018-03-30', '2018-04-01', 2, 0, 2, 0, 400000, 0, 275000, 300000, '2018-02-28 00:00:00', 44195, 0, 5, 5, 5, 3, 0, 0, 0, 0, 755805, 0, 0, '', 755805, '42'),
(102, 70, 7, 20, '2018-03-30', '2018-04-02', 2, 1, 3, 350000, 350000, 0, 275000, 275000, '2018-02-28 00:00:00', 31500, 0, 5, 5, 5, 3, 0, 0, 0, 0, 1018500, 0, 0, '', 1018500, '41'),
(103, 71, 1, 19, '2018-03-23', '2018-03-25', 2, 0, 2, 0, 400000, 0, 275000, 300000, '2018-03-01 00:00:00', 188900, 0, 5, 5, 5, 3, 0, 0, 0, 0, 611100, 0, 0, '', 611100, '41'),
(105, 73, 6, 23, '2018-03-08', '2018-03-09', 0, 1, 1, 375000, 0, 0, 275000, 300000, '2018-03-05 00:00:00', 175000, 0, 5, 5, 5, 1, 0, 0, 0, 0, 200000, 0, 0, '', 575000, '42'),
(108, 76, 1, 19, '2018-03-16', '2018-03-17', 1, 0, 1, 350000, 400000, 0, 275000, 300000, '2018-03-05 00:00:00', 0, 0, 5, 5, 5, 1, 0, 0, 0, 0, 400000, 0, 0, '', 400000, '41'),
(109, 76, 1, 12, '2018-03-16', '2018-03-17', 1, 0, 1, 400000, 400000, 0, 275000, 325000, '2018-03-05 00:00:00', 0, 0, 5, 5, 5, 1, 0, 0, 0, 0, 400000, 0, 0, '', 400000, '41'),
(110, 77, 1, 19, '2018-03-10', '2018-03-11', 1, 0, 1, 350000, 400000, 0, 275000, 300000, '2018-03-06 00:00:00', 26550, 0, 5, 5, 5, 3, 0, 0, 0, 0, 373450, 0, 0, '', 373450, '41'),
(111, 79, 1, 12, '2018-03-26', '2018-03-27', 0, 1, 1, 400000, 0, 0, 275000, 325000, '2018-03-06 00:00:00', 0, 0, 5, 5, 5, 1, 400000, 0, 0, 0, 400000, 0, 0, '', 0, '41'),
(113, 81, 1, 11, '2018-03-10', '2018-03-11', 1, 0, 1, 400000, 400000, 0, 250000, 300000, '2018-03-07 00:00:00', 16850, 0, 5, 5, 5, 3, 0, 0, 0, 0, 383150, 0, 0, '', 383150, '41'),
(114, 82, 7, 20, '2018-03-10', '2018-03-11', 1, 0, 1, 350000, 350000, 0, 275000, 275000, '2018-03-07 00:00:00', 10500, 0, 5, 5, 5, 3, 0, 0, 0, 0, 339500, 0, 0, '', 339500, '41'),
(115, 73, 6, 23, '2018-03-09', '2018-03-11', 2, 0, 2, 0, 400000, 0, 275000, 300000, '2018-03-07 00:00:00', 24000, 0, 5, 5, 5, 3, 0, 0, 0, 0, 776000, 0, 0, '', 776000, '42'),
(117, 76, 1, 11, '2018-03-16', '2018-03-17', 1, 1, 2, 400000, 400000, 0, 250000, 300000, '2018-03-07 00:00:00', 0, 0, 5, 5, 5, 1, 500000, 0, 0, 0, 800000, 0, 0, '', 300000, '41'),
(118, 76, 1, 11, '2018-03-17', '2018-03-19', 0, 2, 2, 400000, 0, 0, 250000, 300000, '2018-03-07 00:00:00', 100000, 0, 5, 5, 5, 1, 0, 0, 0, 0, 700000, 0, 0, '', 700000, '41'),
(125, 83, 1, 11, '2018-03-26', '2018-03-28', 0, 2, 2, 450000, 0, 0, 250000, 300000, '2018-03-10 00:00:00', 0, 0, 0, 5, 5, 1, 600000, 0, 0, 0, 900000, 0, 0, '', 300000, '41'),
(127, 58, 1, 12, '2018-03-30', '2018-04-01', 2, 0, 2, 0, 400000, 0, 275000, 325000, '2018-03-10 00:00:00', 0, 0, 0, 5, 5, 1, 800000, 0, 0, 0, 800000, 0, 0, '', 0, '41'),
(128, 68, 1, 19, '2018-03-11', '2018-03-16', 0, 5, 5, 350000, 0, 0, 275000, 300000, '2018-03-10 00:00:00', 0, 0, 0, 5, 5, 1, 0, 0, 0, 0, 1750000, 0, 0, '', 1750000, '41'),
(129, 58, 1, 9, '2018-03-15', '2018-04-14', 9, 21, 30, 350000, 350000, 0, 275000, 275000, '2018-03-10 00:00:00', 6000000, 0, 0, 5, 5, 1, 0, 0, 0, 0, 4500000, 3500000, 4500000, '', 0, '41'),
(135, 68, 1, 12, '2018-03-13', '2018-03-15', 0, 2, 2, 400000, 0, 0, 275000, 325000, '2018-03-12 00:00:00', 0, 0, 0, 5, 5, 1, 0, 0, 0, 0, 800000, 0, 0, '', 800000, '41'),
(137, 68, 1, 11, '2018-03-14', '2018-03-15', 0, 1, 1, 400000, 0, 0, 250000, 300000, '2018-03-12 00:00:00', 0, 0, 0, 5, 5, 1, 0, 0, 0, 0, 400000, 0, 0, '', 400000, '41'),
(144, 88, 1, 19, '2018-03-30', '2018-03-31', 1, 0, 1, 0, 400000, 0, 275000, 300000, '2018-03-18 00:00:00', 0, 0, 0, 5, 3, 3, 0, 0, 0, 0, 400000, 0, 400000, '', 0, '41'),
(145, 89, 1, 19, '2018-03-18', '2018-03-19', 0, 1, 1, 350000, 0, 0, 275000, 300000, '2018-03-18 00:00:00', 0, 0, 0, 5, 5, 3, 0, 0, 0, 0, 373450, 0, 0, '', 373450, '41'),
(146, 58, 6, 23, '2018-02-01', '2018-02-02', 0, 1, 1, 375000, 400000, 0, 275000, 300000, '2018-02-24 00:00:00', 75000, 0, 0, 5, 5, 1, 350000, 0, 0, 0, 300000, 0, -50000, '', 0, '41'),
(147, 58, 7, 20, '2018-02-01', '2018-02-04', 2, 1, 3, 350000, 350000, 0, 275000, 275000, '2018-02-24 00:00:00', 132000, 0, 0, 5, 5, 1, 0, 0, 0, 0, 1018000, 0, 1018000, '', 0, '41'),
(148, 58, 1, 12, '2018-02-02', '2018-02-04', 2, 0, 2, 400000, 400000, 0, 275000, 325000, '2018-03-26 13:58:45', 0, 0, 0, 5, 5, 1, 800000, 0, 0, 0, 800000, 0, 0, '', 0, '41'),
(149, 58, 1, 9, '2018-02-03', '2018-02-04', 1, 0, 1, 350000, 350000, 0, 275000, 275000, '2018-03-26 14:32:29', 0, 0, 0, 5, 5, 1, 350000, 0, 0, 0, 350000, 0, 0, '', 0, '41'),
(150, 58, 1, 19, '2018-02-03', '2018-02-04', 1, 0, 1, 350000, 400000, 0, 275000, 300000, '2018-02-24 00:00:00', 27000, 0, 0, 5, 5, 3, 373000, 0, 0, 0, 373000, 0, 0, '', 0, '41'),
(151, 58, 1, 24, '2018-02-03', '2018-02-04', 1, 0, 1, 350000, 400000, 0, 300000, 300000, '2018-02-24 00:00:00', 0, 0, 0, 5, 5, 1, 400000, 0, 0, 0, 400000, 0, 0, '', 0, '41'),
(152, 58, 7, 26, '2018-02-03', '2018-02-04', 1, 0, 1, 350000, 300000, 0, 270000, 300000, '2018-03-26 13:59:44', 0, 0, 0, 5, 5, 3, 388000, 0, 0, 0, 388000, 0, 0, '', 0, '41'),
(153, 58, 1, 19, '2018-02-08', '2018-02-11', 2, 1, 3, 350000, 400000, 0, 275000, 300000, '2018-02-25 00:00:00', 100000, 0, 0, 5, 5, 1, 1050000, 0, 0, 0, 1050000, 0, 0, '', 0, '41'),
(154, 58, 1, 12, '2018-02-09', '2018-02-11', 2, 0, 2, 400000, 400000, 0, 275000, 325000, '2018-03-26 13:58:45', 0, 0, 0, 5, 5, 1, 800000, 0, 0, 0, 800000, 0, 0, '', 0, '41'),
(155, 58, 6, 23, '2018-02-07', '2018-02-08', 0, 1, 1, 375000, 400000, 0, 275000, 300000, '2018-02-25 00:00:00', 0, 0, 0, 5, 5, 1, 375000, 0, 0, 0, 375000, 0, 0, '', 0, '42'),
(156, 58, 6, 23, '2018-02-09', '2018-02-11', 2, 0, 2, 375000, 400000, 0, 275000, 300000, '2018-02-25 00:00:00', 0, 0, 0, 5, 5, 3, 727500, 0, 0, 0, 800000, 0, 72500, '', 0, '41'),
(157, 63, 6, 23, '2018-03-05', '2018-03-07', 0, 2, 2, 375000, 400000, 0, 275000, 300000, '2018-02-28 00:00:00', 0, 0, 0, 9, 5, 1, 300000, 0, 0, 0, 800000, 0, 500000, '', 0, '42'),
(158, 58, 1, 9, '2018-02-08', '2018-02-09', 0, 1, 1, 350000, 350000, 0, 275000, 275000, '2018-03-26 14:32:29', 0, 0, 0, 5, 5, 1, 350000, 0, 0, 0, 350000, 0, 0, '', 0, '41'),
(159, 58, 1, 9, '2018-02-10', '2018-02-11', 1, 0, 1, 350000, 350000, 0, 275000, 275000, '2018-03-26 14:32:29', 60500, 0, 0, 5, 5, 3, 339500, 0, 0, 0, 339500, 0, 0, '', 0, '41'),
(160, 58, 1, 11, '2018-02-03', '2018-02-04', 1, 0, 1, 400000, 400000, 0, 250000, 300000, '2018-03-26 14:31:21', 0, 0, 0, 5, 5, 1, 400000, 0, 0, 0, 400000, 0, 0, '', 0, '41'),
(161, 58, 1, 11, '2018-02-09', '2018-02-10', 1, 0, 1, 400000, 400000, 0, 250000, 300000, '2018-03-26 14:31:21', 0, 0, 0, 5, 5, 1, 400000, 0, 0, 0, 400000, 0, 0, '', 0, '41'),
(162, 58, 1, 11, '2018-02-12', '2018-02-13', 0, 2, 2, 400000, 400000, 0, 250000, 300000, '2018-03-26 14:31:21', 0, 100000, 0, 5, 5, 1, 900000, 0, 0, 0, 900000, 0, 0, '', 0, '41'),
(163, 58, 1, 12, '2018-02-04', '2018-02-05', 0, 1, 1, 400000, 400000, 0, 275000, 325000, '2018-03-26 13:58:45', 17000, 0, 0, 5, 5, 3, 383000, 0, 0, 0, 383000, 0, 0, '', 0, '41'),
(164, 72, 1, 12, '2018-02-24', '2018-02-25', 1, 0, 1, 400000, 400000, 0, 275000, 325000, '2018-03-26 13:58:45', 16850, 0, 0, 5, 5, 3, 0, 0, 0, 0, 383150, 0, 0, '', 0, '41'),
(165, 58, 1, 19, '2018-02-15', '2018-02-16', 1, 1, 2, 350000, 400000, 0, 275000, 300000, '2018-02-25 00:00:00', 0, 0, 0, 5, 5, 1, 770000, 0, 0, 0, 770000, 0, 0, '', 0, '41'),
(166, 58, 6, 23, '2018-02-03', '2018-02-05', 1, 2, 3, 375000, 400000, 0, 275000, 300000, '2018-02-25 00:00:00', 59000, 0, 0, 5, 5, 3, 1091000, 0, 0, 0, 1091000, 0, 0, '', 0, '41'),
(167, 58, 7, 22, '2018-02-03', '2018-02-04', 1, 0, 1, 400000, 400000, 0, 300000, 300000, '2018-03-26 13:37:10', 12000, 0, 0, 5, 5, 3, 388000, 0, 0, 0, 388000, 0, 0, '', 0, '41'),
(168, 60, 7, 20, '2018-02-15', '2018-02-16', 0, 1, 1, 350000, 350000, 0, 275000, 275000, '2018-02-25 00:00:00', 10500, 0, 0, 5, 5, 3, 0, 0, 0, 0, 339500, 0, 0, '', 0, '41'),
(170, 59, 1, 12, '2018-03-03', '2018-03-04', 1, 0, 1, 400000, 400000, 0, 275000, 325000, '2018-02-25 00:00:00', 5000, 0, 0, 7, 5, 1, 150000, 0, 0, 0, 395000, 0, 0, '', 0, '41'),
(171, 61, 7, 20, '2018-03-01', '2018-03-05', 2, 2, 4, 350000, 350000, 0, 275000, 275000, '2018-02-26 00:00:00', 42000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 1358000, 0, 0, '', 0, '41'),
(172, 55, 1, 24, '2018-02-18', '2018-02-19', 1, 0, 1, 350000, 400000, 0, 300000, 300000, '2018-02-18 00:00:00', 61000, 0, 0, 5, 4, 3, 0, 0, 0, 0, 339000, 0, 0, '', 0, '41'),
(173, 67, 1, 24, '2018-02-28', '2018-03-27', 8, 19, 27, 350000, 400000, 0, 300000, 300000, '2018-02-28 00:00:00', 4850000, 0, 0, 5, 5, 1, 4600000, 0, 0, 0, 4600000, 3500000, 0, '', 0, '41'),
(174, 68, 1, 19, '2018-03-02', '2018-03-03', 2, 0, 2, 350000, 400000, 0, 275000, 300000, '2018-02-28 00:00:00', 0, 0, 0, 5, 5, 1, 300000, 0, 0, 0, 800000, 0, 0, '', 0, '42'),
(175, 68, 7, 22, '2018-03-10', '2018-03-11', 1, 0, 1, 0, 400000, 0, 300000, 300000, '2018-03-26 13:37:10', 0, 0, 0, 5, 5, 1, 0, 0, 0, 0, 400000, 0, 0, '', 0, '41'),
(176, 68, 1, 19, '2018-03-08', '2018-03-10', 1, 1, 2, 350000, 400000, 0, 275000, 300000, '2018-03-07 00:00:00', 50000, 0, 0, 5, 5, 1, 0, 0, 0, 0, 700000, 0, 0, '', 0, '42'),
(177, 68, 1, 11, '2018-03-12', '2018-03-14', 0, 3, 3, 400000, 0, 0, 250000, 300000, '2018-03-10 00:00:00', 0, 0, 0, 5, 5, 1, 0, 0, 0, 0, 1200000, 0, 0, '', 0, '41'),
(178, 68, 1, 12, '2018-03-08', '2018-03-10', 1, 1, 2, 400000, 400000, 0, 275000, 325000, '2018-03-10 00:00:00', 0, 0, 0, 5, 5, 1, 0, 0, 0, 0, 800000, 0, 0, '', 0, '41'),
(179, 62, 1, 11, '2018-03-07', '2018-03-10', 1, 2, 3, 400000, 400000, 0, 250000, 300000, '2018-02-26 00:00:00', 0, 0, 0, 5, 5, 3, 0, 0, 0, 0, 1200000, 0, 1200000, '', 0, '41'),
(212, 92, 6, 23, '2018-03-24', '2018-03-25', 1, 0, 1, 0, 400000, 0, 275000, 300000, '2018-03-19 00:00:00', 10500, 0, 0, 5, 5, 3, 0, 0, 0, 0, 389500, 0, 0, '', 389500, '42'),
(214, 93, 1, 19, '2018-03-19', '2018-03-20', 0, 1, 1, 350000, 0, 0, 275000, 300000, '2018-03-19 00:00:00', 70000, 0, 0, 7, 5, 1, 280000, 0, 0, 0, 280000, 0, 0, '', 0, '41'),
(215, 94, 7, 20, '2018-03-17', '2018-03-18', 1, 0, 1, 0, 350000, 0, 275000, 275000, '2018-03-20 00:00:00', 0, 0, 0, 12, 5, 1, 100000, 0, 0, 0, 350000, 0, 0, '', 250000, '41'),
(217, 96, 1, 19, '2018-03-20', '2018-03-21', 0, 1, 1, 350000, 0, 0, 275000, 300000, '2018-03-20 00:00:00', 95000, 0, 0, 7, 5, 1, 635000, 0, 0, 0, 255000, 0, 0, '', -380000, '41'),
(218, 97, 1, 19, '2018-03-21', '2018-03-22', 0, 1, 1, 350000, 0, 0, 275000, 300000, '2018-03-21 00:00:00', 0, 0, 0, 5, 5, 1, 0, 0, 0, 0, 350000, 0, 0, '', 350000, '42'),
(219, 98, 1, 12, '2018-03-27', '2018-03-29', 0, 2, 2, 400000, 0, 0, 275000, 325000, '2018-03-21 00:00:00', 0, 0, 0, 5, 5, 1, 0, 0, 0, 0, 800000, 0, 0, '', 800000, '41'),
(220, 99, 1, 12, '2018-03-23', '2018-03-24', 1, 0, 1, 0, 400000, 0, 275000, 325000, '2018-03-22 00:00:00', 0, 0, 0, 7, 5, 1, 400000, 0, 0, 0, 400000, 0, 0, '', 0, '41'),
(221, 100, 1, 19, '2018-03-22', '2018-03-23', 0, 1, 1, 350000, 0, 0, 275000, 300000, '2018-03-23 00:00:00', 0, 0, 0, 5, 5, 1, 0, 0, 0, 0, 375000, 0, 0, '', 375000, '42'),
(223, 101, 1, 11, '2018-03-30', '2018-04-01', 2, 0, 2, 0, 400000, 0, 250000, 300000, '2018-03-23 00:00:00', 33700, 0, 0, 5, 5, 3, 0, 0, 0, 0, 766300, 0, 0, '', 766300, '41'),
(224, 102, 7, 22, '2018-03-24', '2018-03-25', 1, 0, 1, 0, 400000, 0, 300000, 300000, '2018-03-26 13:44:35', 0, 0, 0, 5, 5, 1, 0, 0, 0, 0, 400000, 0, 0, '', 400000, '41'),
(226, 105, 7, 20, '2018-03-26', '2018-03-27', 0, 1, 1, 350000, 0, 0, 275000, 275000, '2018-03-25 00:00:00', 10500, 0, 0, 5, 5, 3, 0, 0, 0, 0, 339500, 0, 0, '', 339500, '41'),
(229, 83, 7, 22, '2018-03-27', '2018-03-28', 0, 1, 1, 400000, 0, 0, 300000, 300000, '2018-03-26 00:00:00', 0, 0, 0, 5, 5, 1, 0, 0, 0, 0, 400000, 0, 0, '', 400000, '41'),
(230, 106, 1, 24, '2018-03-30', '2018-03-31', 1, 0, 1, 0, 400000, 0, 300000, 300000, '2018-03-26 20:36:16', 21700, 0, 0, 5, 5, 3, 0, 0, 0, 0, 378300, 0, 0, '', 378300, '41'),
(232, 107, 7, 20, '2018-04-14', '2018-04-15', 1, 0, 1, 0, 350000, 0, 275000, 275000, '2018-03-27 20:28:29', 0, 0, 0, 5, 5, 1, 350000, 0, 0, 0, 350000, 0, 0, '', 0, '41'),
(234, 95, 1, 24, '2018-03-27', '2018-03-29', 0, 2, 2, 350000, 0, 0, 300000, 300000, '2018-03-27 23:41:50', 0, 0, 0, 5, 5, 1, 700000, 0, 0, 0, 700000, 0, 0, '', 0, '41'),
(235, 109, 7, 22, '2018-04-07', '2018-04-08', 1, 0, 1, 0, 400000, 0, 300000, 300000, '2018-03-28 10:16:55', 0, 0, 0, 7, 5, 1, 400000, 0, 0, 0, 400000, 0, 0, '', 0, '41'),
(236, 164, 7, 22, '2018-03-30', '2018-04-01', 2, 0, 2, 0, 400000, 0, 300000, 300000, '2018-03-28 10:25:47', 0, 0, 0, 5, 5, 1, 500000, 0, 0, 0, 900000, 0, 0, '', 400000, '41'),
(237, 111, 1, 19, '2018-03-31', '2018-04-03', 1, 2, 3, 350000, 400000, 0, 275000, 300000, '2018-03-28 11:02:28', 0, 0, 0, 5, 5, 1, 1200000, 0, 0, 0, 1200000, 0, 0, '', 0, '42'),
(239, 113, 1, 11, '2018-04-13', '2018-04-14', 1, 0, 1, 0, 400000, 0, 250000, 300000, '2018-03-31 14:44:06', 30000, 0, 0, 9, 5, 1, 150000, 0, 0, 0, 370000, 0, 0, '', 220000, '41'),
(240, 113, 1, 24, '2018-04-13', '2018-04-14', 1, 0, 1, 0, 400000, 0, 300000, 300000, '2018-03-31 14:46:01', 20000, 0, 0, 9, 5, 1, 150000, 0, 0, 0, 380000, 0, 0, '', 230000, '41'),
(241, 113, 1, 12, '2018-04-13', '2018-04-14', 1, 0, 1, 0, 400000, 0, 275000, 325000, '2018-03-31 14:49:08', 0, 0, 0, 9, 5, 1, 200000, 0, 0, 0, 400000, 0, 0, '', 200000, '41'),
(242, 114, 1, 24, '2018-03-31', '2018-04-01', 1, 0, 1, 0, 400000, 0, 300000, 300000, '2018-03-31 14:52:19', 0, 0, 0, 5, 5, 1, 450000, 0, 0, 0, 450000, 0, 0, '', 0, '41'),
(243, 114, 1, 11, '2018-04-01', '2018-04-05', 0, 4, 4, 400000, 0, 0, 250000, 300000, '2018-04-01 09:23:56', 0, 0, 0, 5, 5, 1, 1600000, 0, 0, 0, 1600000, 0, 0, '', 0, '41'),
(246, 115, 1, 12, '2018-04-07', '2018-04-08', 1, 0, 1, 0, 400000, 0, 275000, 325000, '2018-04-01 15:39:43', 0, 0, 0, 9, 5, 1, 150000, 0, 0, 0, 400000, 0, 0, '', 250000, '41'),
(251, 111, 1, 12, '2018-04-03', '2018-04-04', 0, 1, 1, 400000, 0, 0, 275000, 325000, '2018-04-03 11:03:39', 0, 0, 0, 5, 5, 1, 400000, 0, 0, 0, 400000, 0, 0, '', 0, '41'),
(252, 120, 6, 23, '2018-04-13', '2018-04-16', 2, 1, 3, 375000, 400000, 0, 275000, 300000, '2018-04-04 14:56:17', 0, 0, 0, 7, 5, 1, 400000, 0, 0, 0, 1200000, 0, 0, '', 800000, '42'),
(253, 121, 1, 24, '2018-04-07', '2018-04-08', 1, 0, 1, 0, 400000, 0, 300000, 300000, '2018-04-04 15:05:03', 0, 0, 0, 5, 5, 1, 0, 0, 0, 0, 400000, 0, 0, '', 400000, '41'),
(255, 121, 1, 11, '2018-04-05', '2018-04-11', 2, 4, 6, 400000, 400000, 0, 250000, 300000, '2018-04-04 16:41:07', 0, 0, 0, 5, 5, 1, 7000000, 0, 0, 0, 2400000, 0, -600000, '', -4000000, '41'),
(258, 121, 1, 19, '2018-04-07', '2018-04-08', 1, 0, 1, 0, 400000, 0, 275000, 300000, '2018-04-05 16:17:43', 0, 0, 0, 5, 5, 1, 0, 0, 0, 0, 400000, 0, 0, '', 400000, '42'),
(259, 127, 1, 11, '2018-05-05', '2018-05-06', 1, 0, 1, 0, 400000, 0, 250000, 300000, '2018-04-05 20:07:00', 0, 0, 0, 7, 5, 1, 385000, 0, 0, 0, 400000, 0, 0, '', 15000, '41'),
(260, 111, 1, 12, '2018-04-06', '2018-04-07', 1, 0, 1, 0, 400000, 0, 275000, 325000, '2018-04-06 22:46:16', 0, 0, 0, 5, 5, 1, 400000, 0, 0, 0, 400000, 0, 0, '', 0, '41'),
(261, 128, 1, 24, '2018-02-08', '2018-02-09', 1, 0, 1, 0, 400000, 0, 300000, 300000, '2018-04-06 22:49:06', 25000, 0, 0, 5, 5, 1, 375000, 0, 0, 0, 375000, 0, 0, '', 0, '41'),
(267, 134, 1, 12, '2018-04-21', '2018-04-22', 1, 0, 1, 0, 400000, 0, 275000, 325000, '2018-04-08 13:14:26', 0, 0, 0, 5, 5, 3, 0, 0, 0, 0, 400000, 325000, 0, '', 400000, '41'),
(268, 135, 7, 20, '2018-04-07', '2018-04-08', 1, 0, 1, 0, 350000, 0, 275000, 275000, '2018-04-08 19:07:25', 10500, 0, 0, 5, 5, 3, 0, 0, 0, 0, 339500, 0, 0, '', 339500, '41'),
(269, 136, 6, 23, '2018-04-07', '2018-04-08', 1, 0, 1, 0, 400000, 0, 275000, 300000, '2018-04-09 06:46:17', 12000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 388000, 0, 0, '', 388000, '42'),
(270, 137, 1, 19, '2018-04-06', '2018-04-07', 1, 0, 1, 0, 400000, 0, 275000, 300000, '2018-04-09 11:08:34', 26550, 0, 0, 5, 5, 3, 0, 0, 0, 0, 373450, 0, 0, '', 373450, '42'),
(271, 112, 6, 23, '2018-06-20', '2018-06-22', 0, 2, 2, 375000, 0, 0, 275000, 300000, '2018-04-09 11:49:16', 0, 0, 0, 5, 5, 3, 0, 0, 0, 0, 776000, 0, 0, '', 776000, '42'),
(273, 140, 7, 20, '2018-04-06', '2018-04-07', 1, 0, 1, 0, 350000, 0, 275000, 275000, '2018-04-09 14:07:54', 10500, 0, 0, 5, 5, 3, 0, 0, 0, 0, 339500, 0, 0, '', 339500, '41'),
(274, 141, 1, 19, '2018-04-09', '2018-04-10', 0, 1, 1, 350000, 0, 0, 275000, 300000, '2018-04-09 18:01:13', 50000, 0, 0, 5, 5, 1, 300000, 0, 0, 0, 300000, 0, 0, '', 0, '42'),
(277, 143, 6, 23, '2018-04-09', '2018-04-10', 0, 1, 1, 375000, 0, 0, 275000, 300000, '2018-04-10 17:23:30', 181000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 194000, 0, 0, '', 194000, '42'),
(278, 144, 1, 19, '2018-04-10', '2018-04-11', 0, 1, 1, 350000, 0, 0, 275000, 300000, '2018-04-10 19:13:38', 125000, 0, 0, 5, 5, 1, 225000, 0, 0, 0, 225000, 0, 0, '', 0, '42'),
(279, 145, 1, 12, '2018-04-12', '2018-04-13', 0, 1, 1, 375000, 0, 0, 275000, 325000, '2018-04-11 12:03:03', 25000, 0, 0, 7, 5, 1, 375000, 0, 0, 0, 375000, 0, 0, '', 0, '41'),
(280, 146, 6, 23, '2018-04-11', '2018-04-12', 0, 1, 1, 375000, 0, 0, 275000, 300000, '2018-04-11 13:59:17', 84000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 291000, 0, 0, '', 291000, '42'),
(281, 148, 1, 9, '2018-04-14', '2018-04-15', 1, 0, 1, 0, 350000, 0, 275000, 275000, '2018-04-11 23:04:33', 10500, 0, 0, 5, 5, 3, 0, 0, 0, 0, 339500, 0, 0, '', 339500, '41'),
(282, 149, 1, 12, '2018-04-14', '2018-04-15', 1, 0, 1, 0, 400000, 0, 275000, 325000, '2018-04-11 23:05:24', 0, 0, 0, 5, 5, 3, 0, 0, 0, 0, 407400, 0, 0, '', 407400, '41'),
(283, 150, 1, 24, '2018-04-14', '2018-04-15', 1, 0, 1, 0, 400000, 0, 300000, 300000, '2018-04-12 14:42:50', 21700, 0, 0, 5, 5, 3, 0, 0, 0, 0, 378300, 0, 0, '', 378300, '41'),
(284, 152, 1, 19, '2018-04-12', '2018-04-14', 1, 1, 2, 350000, 400000, 0, 275000, 300000, '2018-04-13 16:11:45', 182550, 0, 0, 5, 5, 3, 0, 0, 0, 0, 567450, 0, 0, '', 567450, '42'),
(285, 153, 7, 22, '2018-04-14', '2018-04-15', 1, 0, 1, 0, 400000, 0, 300000, 300000, '2018-04-14 10:41:46', 0, 0, 0, 5, 5, 1, 425000, 0, 0, 0, 425000, 0, 0, '', 0, '41'),
(286, 154, 1, 11, '2018-04-14', '2018-04-15', 1, 0, 1, 0, 400000, 0, 250000, 300000, '2018-04-14 18:38:26', 16850, 0, 0, 5, 5, 3, 0, 0, 0, 0, 383150, 0, 0, '', 383150, '41'),
(287, 155, 1, 11, '2018-04-15', '2018-04-23', 2, 6, 8, 400000, 400000, 0, 250000, 300000, '2018-04-14 18:44:00', 400000, 0, 0, 5, 5, 1, 1400000, 0, 0, 0, 2800000, 1800000, 0, '', 1400000, '41'),
(288, 158, 1, 19, '2018-04-14', '2018-04-15', 1, 0, 1, 0, 400000, 0, 275000, 300000, '2018-04-15 09:03:15', 0, 0, 0, 5, 5, 1, 400000, 0, 0, 0, 400000, 0, 0, '', 0, '42'),
(290, 58, 6, 23, '2018-04-21', '2018-04-22', 1, 0, 1, 0, 400000, 0, 275000, 300000, '2018-04-17 09:26:46', 0, 0, 0, 5, 5, 1, 400000, 0, 0, 0, 400000, 0, 0, '', 0, '42'),
(291, 160, 1, 24, '2018-04-16', '2018-05-16', 8, 22, 30, 350000, 400000, 0, 300000, 300000, '2018-04-17 11:31:07', 6400000, 0, 0, 5, 5, 1, 6500000, 0, 0, 0, 4500000, 3500000, -2000000, '', 0, '41'),
(292, 161, 1, 19, '2018-05-05', '2018-05-06', 1, 0, 1, 0, 400000, 0, 275000, 300000, '2018-04-17 17:31:40', 60500, 0, 0, 5, 5, 3, 0, 0, 0, 0, 339500, 0, 0, '', 339500, '42'),
(293, 162, 1, 19, '2018-04-17', '2018-04-18', 0, 1, 1, 350000, 0, 0, 275000, 300000, '2018-04-17 17:40:18', 100000, 0, 0, 5, 5, 1, 250000, 0, 0, 0, 250000, 0, 0, '', 0, '42'),
(294, 163, 6, 23, '2018-04-27', '2018-04-30', 2, 1, 3, 375000, 400000, 0, 275000, 300000, '2018-04-18 20:25:38', 11000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 1164000, 0, 0, '', 1164000, '42'),
(295, 164, 1, 19, '2018-04-20', '2018-04-22', 2, 0, 2, 0, 400000, 0, 275000, 300000, '2018-04-19 09:43:23', 0, 0, 0, 5, 5, 1, 400000, 0, 0, 0, 800000, 0, 0, '', 400000, '42'),
(296, 165, 1, 11, '2018-04-24', '2018-04-25', 0, 1, 1, 400000, 0, 0, 250000, 300000, '2018-04-19 11:28:34', 0, 0, 0, 5, 5, 3, 0, 0, 0, 0, 1341025, 0, 0, '', 1341025, '41'),
(297, 141, 1, 9, '2018-04-19', '2018-04-20', 0, 1, 1, 350000, 0, 0, 275000, 275000, '2018-04-19 12:26:26', 50000, 0, 0, 5, 5, 1, 300000, 0, 0, 0, 300000, 0, 0, '', 0, '41'),
(298, 79, 1, 9, '2018-04-20', '2018-04-22', 2, 0, 2, 0, 350000, 0, 275000, 275000, '2018-04-19 16:05:27', 0, 0, 0, 5, 5, 1, 325000, 0, 0, 0, 775000, 0, 0, '', 450000, '41'),
(301, 168, 7, 22, '2018-04-20', '2018-04-21', 1, 0, 1, 0, 400000, 0, 300000, 300000, '2018-04-20 13:02:47', 0, 0, 0, 5, 5, 1, 200000, 0, 0, 0, 400000, 0, 0, '', 200000, '41'),
(302, 170, 7, 20, '2018-04-20', '2018-04-22', 2, 0, 2, 0, 350000, 0, 270000, 270000, '2018-04-20 13:52:36', 21000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 679000, 0, 0, '', 679000, '41'),
(304, 172, 1, 12, '2018-04-28', '2018-04-29', 1, 0, 1, 0, 407400, 0, 275000, 325000, '2018-04-21 13:36:55', 0, 0, 0, 5, 5, 3, 0, 0, 0, 0, 407400, 0, 0, '', 407400, '41'),
(305, 173, 1, 11, '2018-05-06', '2018-05-13', 2, 5, 7, 400000, 400000, 0, 250000, 300000, '2018-04-22 04:26:29', 779975, 0, 0, 5, 5, 3, 0, 0, 0, 0, 2020025, 1500000, 0, 'di airbnb dari lt 9 dipindah ke 12BD, mudah2an cepet check out', 2020025, '41'),
(306, 58, 1, 12, '2018-03-24', '2018-03-25', 1, 0, 1, 0, 400000, 0, 275000, 325000, '2018-04-23 12:01:29', 0, 0, 0, 5, 5, 1, 400000, 0, 0, 0, 400000, 0, 0, '', 0, '41'),
(307, 58, 1, 12, '2018-03-15', '2018-03-16', 0, 1, 1, 400000, 0, 0, 275000, 325000, '2018-04-23 12:03:44', 0, 0, 0, 5, 5, 1, 400000, 0, 0, 0, 400000, 325000, 0, '', 0, '41'),
(308, 174, 7, 20, '2018-04-28', '2018-04-29', 1, 0, 1, 0, 350000, 0, 270000, 270000, '2018-04-23 20:03:47', 0, 0, 0, 12, 5, 1, 100000, 0, 0, 0, 350000, 0, 0, '', 250000, '41'),
(309, 175, 1, 19, '2018-04-30', '2018-05-02', 0, 2, 2, 400000, 0, 0, 275000, 300000, '2018-04-23 20:19:22', 0, 0, 0, 5, 5, 1, 0, 0, 0, 0, 800000, 0, 0, '', 800000, '42'),
(310, 176, 1, 19, '2018-04-27', '2018-04-28', 1, 0, 1, 0, 400000, 0, 275000, 300000, '2018-04-24 13:13:28', 0, 0, 0, 5, 5, 1, 400000, 0, 0, 0, 400000, 0, 0, '', 0, '42'),
(311, 176, 1, 12, '2018-04-27', '2018-04-28', 1, 0, 1, 0, 400000, 0, 275000, 325000, '2018-04-24 13:13:28', 0, 0, 0, 5, 5, 1, 400000, 0, 0, 0, 400000, 0, 0, '', 0, '41'),
(312, 176, 1, 9, '2018-04-27', '2018-04-28', 1, 0, 1, 0, 350000, 0, 275000, 275000, '2018-04-24 13:18:25', 0, 0, 0, 5, 5, 1, 350000, 0, 0, 0, 350000, 0, 0, '', 0, '41'),
(313, 179, 1, 19, '2018-04-24', '2018-04-25', 0, 1, 1, 350000, 0, 0, 275000, 300000, '2018-04-24 15:13:28', 0, 0, 0, 5, 5, 1, 200000, 0, 0, 0, 350000, 0, 0, '', 150000, '42'),
(314, 179, 1, 9, '2018-04-24', '2018-04-25', 0, 1, 1, 350000, 0, 0, 275000, 275000, '2018-04-24 15:16:11', 0, 0, 0, 5, 5, 1, 0, 0, 0, 0, 350000, 0, 0, '', 350000, '41'),
(315, 182, 1, 12, '2018-04-24', '2018-04-25', 0, 1, 1, 375000, 0, 0, 275000, 325000, '2018-04-24 15:22:49', 25000, 0, 0, 5, 5, 1, 0, 0, 0, 0, 375000, 0, -25000, '', 400000, '41'),
(316, 183, 6, 23, '2018-05-04', '2018-05-06', 2, 0, 2, 0, 400000, 0, 275000, 300000, '2018-04-24 16:15:46', 34000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 766000, 0, 0, '', 766000, '42'),
(317, 184, 1, 9, '2018-04-28', '2018-04-29', 1, 0, 1, 0, 350000, 0, 275000, 275000, '2018-04-25 09:18:25', 0, 0, 0, 5, 5, 1, 200000, 0, 0, 0, 375000, 0, 0, '', 175000, '41'),
(318, 141, 1, 19, '2018-04-25', '2018-04-26', 0, 1, 1, 300000, 0, 0, 275000, 300000, '2018-04-25 13:42:02', 50000, 0, 0, 5, 5, 1, 0, 0, 0, 0, 300000, 0, 0, '', 300000, '42'),
(319, 186, 1, 9, '2018-04-25', '2018-04-26', 0, 1, 1, 350000, 0, 0, 275000, 275000, '2018-04-25 15:38:50', 50000, 0, 0, 12, 5, 1, 300000, 0, 0, 0, 300000, 0, 0, '', 0, '41'),
(320, 185, 1, 11, '2018-04-25', '2018-04-27', 0, 2, 2, 400000, 0, 0, 250000, 300000, '2018-04-25 16:47:46', 0, 0, 0, 5, 5, 1, 250000, 0, 0, 0, 800000, 0, 0, '', 550000, '41'),
(321, 188, 1, 19, '2018-04-26', '2018-04-27', 0, 1, 1, 400000, 0, 0, 275000, 300000, '2018-04-25 18:29:25', 0, 0, 0, 5, 5, 1, 400000, 0, 0, 0, 400000, 0, 0, '', 0, '42'),
(322, 189, 1, 11, '2018-04-27', '2018-04-29', 2, 0, 2, 0, 400000, 0, 250000, 300000, '2018-04-26 20:43:26', 0, 0, 0, 5, 5, 3, 0, 0, 0, 0, 851300, 0, 0, '', 851300, '41'),
(323, 185, 7, 22, '2018-04-27', '2018-04-29', 2, 0, 2, 0, 400000, 0, 300000, 300000, '2018-04-27 12:47:12', 0, 0, 0, 5, 5, 1, 400000, 0, 0, 0, 800000, 0, 0, '', 400000, '41'),
(324, 190, 1, 24, '2018-02-16', '2018-02-18', 2, 0, 2, 0, 400000, 0, 300000, 300000, '2018-04-27 18:41:45', 0, 0, 0, 5, 5, 3, 0, 0, 0, 0, 800000, 0, 0, '', 800000, '41'),
(325, 128, 1, 24, '2018-04-06', '2018-04-07', 1, 0, 1, 0, 400000, 0, 300000, 300000, '2018-04-27 18:51:51', 25000, 0, 0, 5, 5, 1, 375000, 0, 0, 0, 375000, 0, 0, '', 0, '41'),
(326, 191, 1, 19, '2018-04-28', '2018-04-29', 1, 0, 1, 0, 400000, 0, 275000, 300000, '2018-04-27 19:09:17', 25000, 0, 0, 5, 5, 1, 375000, 0, 0, 0, 375000, 0, 0, '', 0, '42'),
(327, 192, 1, 19, '2018-04-29', '2018-04-30', 0, 1, 1, 350000, 0, 0, 275000, 300000, '2018-04-29 06:49:57', 59000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 291000, 0, 0, '', 291000, '42'),
(328, 193, 6, 23, '2018-04-30', '2018-05-01', 0, 1, 1, 430000, 0, 0, 275000, 300000, '2018-04-29 13:53:10', 0, 0, 0, 5, 5, 1, 430000, 0, 0, 0, 430000, 300000, 0, '', 0, '42'),
(329, 195, 1, 11, '2018-05-01', '2018-05-02', 0, 1, 1, 400000, 0, 0, 250000, 300000, '2018-04-29 18:16:14', 50000, 0, 0, 5, 5, 1, 350000, 0, 0, 0, 350000, 0, 0, '', 0, '41'),
(330, 185, 1, 9, '2018-04-29', '2018-05-06', 2, 5, 7, 350000, 350000, 0, 275000, 275000, '2018-04-30 00:16:55', 650000, 0, 0, 5, 5, 1, 0, 0, 0, 0, 1800000, 0, 0, '', 1800000, '41'),
(331, 197, 1, 11, '2018-05-02', '2018-05-03', 0, 1, 1, 400000, 0, 0, 250000, 300000, '2018-04-30 13:37:02', 12000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 388000, 0, 0, '', 388000, '41'),
(332, 198, 7, 20, '2018-04-30', '2018-05-01', 0, 1, 1, 350000, 0, 0, 270000, 270000, '2018-04-30 14:31:16', 10500, 0, 0, 5, 5, 3, 0, 0, 0, 0, 339500, 0, 0, '', 339500, '41'),
(333, 199, 1, 11, '2018-05-27', '2018-05-29', 0, 2, 2, 400000, 0, 0, 250000, 300000, '2018-04-30 16:56:51', 33700, 0, 0, 5, 5, 3, 0, 0, 0, 0, 766300, 0, 0, '', 766300, '41'),
(334, 200, 1, 12, '2018-05-01', '2018-05-02', 0, 1, 1, 400000, 0, 0, 275000, 325000, '2018-05-01 08:11:28', 0, 0, 0, 12, 5, 1, 400000, 0, 0, 0, 400000, 0, 0, '', 0, '41'),
(335, 200, 1, 19, '2018-05-02', '2018-05-05', 1, 2, 3, 400000, 400000, 0, 275000, 300000, '2018-05-01 08:13:56', 0, 0, 0, 5, 5, 1, 600000, 0, 0, 0, 1200000, 0, 0, '', 600000, '42'),
(336, 201, 1, 12, '2018-05-04', '2018-05-06', 2, 0, 2, 0, 400000, 0, 275000, 325000, '2018-05-03 12:12:04', 0, 0, 0, 5, 5, 3, 0, 0, 0, 0, 814800, 0, 0, '', 814800, '41'),
(337, 164, 1, 11, '2018-05-04', '2018-05-05', 1, 0, 1, 0, 400000, 0, 250000, 300000, '2018-05-03 12:32:06', 0, 0, 0, 5, 5, 1, 0, 0, 0, 0, 400000, 0, 400000, '', 0, '3'),
(338, 185, 1, 12, '2018-05-07', '2018-05-16', 2, 7, 9, 400000, 400000, 0, 275000, 325000, '2018-05-07 07:52:02', 100000, 0, 0, 5, 5, 1, 0, 0, 0, 0, 3500000, 0, 0, 'Tambahkan Deposit 2jt, cek unit sebelum kembalikan uang deposit\r\n\r\nga jadi sewa 1 bulan chek out  hari rabu tgl 16 mei 2018 9 hari x Rp.400.000=Rp.3.600.000', 3500000, '41'),
(339, 202, 6, 23, '2018-05-07', '2018-05-08', 0, 1, 1, 375000, 0, 0, 275000, 300000, '2018-05-07 16:55:58', 0, 0, 0, 5, 5, 3, 0, 0, 0, 0, 388000, 0, 0, '', 388000, '42'),
(340, 203, 6, 23, '2018-05-11', '2018-05-12', 1, 0, 1, 0, 400000, 0, 275000, 300000, '2018-05-07 21:29:11', 12000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 388000, 0, 0, '', 388000, '42'),
(341, 204, 1, 19, '2018-05-08', '2018-05-10', 0, 2, 2, 350000, 0, 0, 275000, 300000, '2018-05-08 11:03:16', 0, 0, 0, 7, 5, 1, 400000, 0, 0, 0, 800000, 0, 0, '', 400000, '42'),
(342, 206, 6, 23, '2018-05-08', '2018-05-09', 0, 1, 1, 425000, 0, 0, 275000, 300000, '2018-05-08 14:16:48', 0, 0, 0, 5, 5, 1, 425000, 0, 0, 0, 425000, 0, 0, '', 0, '42'),
(343, 208, 1, 19, '2018-05-13', '2018-05-14', 0, 1, 1, 350000, 0, 0, 275000, 300000, '2018-05-09 15:23:39', 0, 0, 0, 7, 5, 1, 400000, 0, 0, 0, 400000, 0, 0, '', 0, '42'),
(344, 209, 6, 23, '2018-05-09', '2018-05-10', 0, 1, 1, 291000, 0, 0, 275000, 300000, '2018-05-09 18:14:05', 84000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 291000, 241000, 0, '', 291000, '42'),
(345, 215, 1, 19, '2018-05-10', '2018-05-11', 0, 1, 1, 400000, 0, 0, 275000, 300000, '2018-05-10 08:35:32', 0, 0, 0, 5, 5, 1, 200000, 0, 0, 0, 400000, 0, 0, '2 unit dengan 9BJ', 200000, '42'),
(346, 215, 1, 9, '2018-05-10', '2018-05-11', 0, 1, 1, 400000, 0, 0, 275000, 275000, '2018-05-10 08:36:27', 0, 0, 0, 5, 5, 1, 200000, 0, 0, 0, 400000, 0, 0, '2 unit dengan 18BF', 200000, '41'),
(347, 216, 1, 9, '2018-05-12', '2018-05-13', 1, 0, 1, 0, 350000, 0, 275000, 275000, '2018-05-10 08:40:07', 0, 0, 0, 5, 5, 1, 350000, 0, 0, 0, 350000, 0, 0, '', 0, '41'),
(348, 217, 1, 19, '2018-05-11', '2018-05-12', 1, 0, 1, 0, 400000, 0, 275000, 300000, '2018-05-11 09:07:14', 12000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 388000, 0, 0, 'minta rekomendasi barista coffe luwak,dan tempat makan di bandung', 776000, '42'),
(349, 218, 7, 20, '2018-05-11', '2018-05-12', 1, 0, 1, 0, 350000, 0, 270000, 270000, '2018-05-11 09:08:03', 10500, 0, 0, 5, 5, 3, 0, 0, 0, 0, 339500, 0, 0, 'chekin jam 2 siang', 339500, '41'),
(350, 219, 1, 19, '2018-05-12', '2018-05-13', 1, 0, 1, 0, 400000, 0, 275000, 300000, '2018-05-12 15:17:02', 15000, 0, 0, 12, 5, 1, 385000, 0, 0, 0, 385000, 0, 0, 'Bayar cash ditempat dititip maya,tamu dr jakarta chek in jam 15.00 wib ', 0, '42'),
(351, 220, 6, 23, '2018-05-12', '2018-05-13', 1, 0, 1, 0, 360000, 0, 275000, 300000, '2018-05-12 21:01:21', 40000, 0, 0, 7, 5, 1, 360000, 0, 0, 0, 360000, 0, 0, 'check out jam 2, alasannya baru check in jam 5 pagi', 0, '42'),
(352, 221, 1, 19, '2018-05-24', '2018-05-27', 2, 1, 3, 350000, 400000, 0, 275000, 300000, '2018-05-13 11:52:57', 100000, 0, 0, 5, 5, 1, 1050000, 0, 0, 0, 1050000, 0, 0, 'demam minta reschedule,di input tgl 23mei\r\ndiperpanjang 1hari lunas', 0, '42'),
(353, 222, 1, 11, '2018-05-14', '2018-05-15', 0, 1, 1, 400000, 0, 0, 250000, 300000, '2018-05-13 15:27:03', 12000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 388000, 0, 0, 'Check in jam 5', 388000, '41'),
(354, 223, 7, 20, '2018-05-18', '2018-05-20', 2, 0, 2, 0, 350000, 0, 270000, 270000, '2018-05-17 17:51:12', 0, 0, 0, 7, 5, 1, 300000, 0, 0, 0, 700000, 0, 0, '', 400000, '41'),
(356, 224, 1, 19, '2018-05-18', '2018-05-20', 2, 0, 2, 0, 400000, 0, 275000, 300000, '2018-05-18 14:15:58', 30000, 0, 0, 7, 5, 1, 770000, 0, 0, 0, 770000, 0, 0, 'asal dari bnb jadi via offline,alhamdulilah sholeh,\r\n2hari lunas via mandiri\r\n', 0, '42'),
(357, 225, 1, 9, '2018-05-31', '2018-06-02', 1, 1, 2, 350000, 350000, 0, 275000, 275000, '2018-05-18 17:30:08', 100000, 0, 0, 7, 5, 1, 300000, 0, 0, 0, 600000, 0, 0, 'Check in subuh, sisa pembayaran cash', 300000, '41'),
(358, 164, 1, 11, '2018-05-25', '2018-05-27', 2, 0, 2, 0, 400000, 0, 250000, 300000, '2018-05-20 20:19:52', 0, 0, 0, 5, 5, 1, 800000, 0, 0, 0, 800000, 0, 0, 'Kasih amenities ', 0, '41'),
(359, 128, 1, 24, '2018-05-21', '2018-05-22', 0, 1, 1, 350000, 0, 0, 300000, 300000, '2018-05-21 15:28:19', 0, 0, 0, 12, 5, 1, 350000, 0, 0, 0, 350000, 0, 0, 'Pak dedi newton ci lt 8bg+9bj besok co', 0, '41'),
(360, 128, 1, 9, '2018-05-21', '2018-05-22', 0, 1, 1, 350000, 0, 0, 275000, 275000, '2018-05-21 15:32:05', 0, 0, 0, 12, 5, 1, 350000, 0, 0, 0, 350000, 0, 0, 'Pak dedi newton bayar ke atm bca teh lina, sewa 2unit (9bj+8bg) co besok', 0, '41'),
(361, 226, 1, 9, '2018-05-26', '2018-05-27', 1, 0, 1, 0, 350000, 0, 275000, 275000, '2018-05-25 14:49:38', 68000, 0, 0, 12, 5, 1, 282000, 0, 0, 0, 282000, 0, 0, 'booking via offline lunas dpt diskon', 0, '41'),
(362, 227, 1, 12, '2018-05-26', '2018-05-27', 1, 0, 1, 0, 400000, 400000, 275000, 325000, '2018-05-26 23:18:46', 50000, 0, 0, 12, 5, 1, 350000, 0, 0, 0, 350000, 0, 0, '', 0, '41'),
(367, 228, 6, 23, '2018-05-26', '2018-05-27', 1, 0, 1, 0, 400000, 0, 275000, 300000, '2018-05-27 12:35:19', 0, 0, 0, 5, 5, 3, 0, 0, 0, 0, 727500, 0, 0, 'Dipercepat 1 hari', 727500, '42'),
(368, 229, 6, 23, '2018-05-27', '2018-05-28', 0, 1, 1, 375000, 0, 375000, 275000, 300000, '2018-05-27 20:27:55', 0, 0, 0, 12, 5, 1, 400000, 0, 0, 0, 400000, 0, 0, 'Cek in malam ,co besok,byr via bca transfer ke lina', 0, '42'),
(369, 128, 1, 9, '2018-05-28', '2018-05-29', 0, 1, 1, 350000, 0, 350000, 275000, 275000, '2018-05-28 22:28:35', 0, 0, 0, 12, 5, 1, 350000, 0, 0, 0, 350000, 0, 0, 'transfer ke bca lina', 0, '41'),
(370, 230, 1, 19, '2018-05-28', '2018-05-29', 0, 1, 1, 350000, 0, 350000, 275000, 300000, '2018-05-28 22:32:19', 50000, 0, 0, 12, 5, 1, 300000, 0, 0, 0, 300000, 0, 0, 'transfer ke rekening lina', 0, '42'),
(371, 233, 1, 12, '2018-05-30', '2018-06-02', 1, 2, 3, 400000, 400000, 0, 275000, 325000, '2018-05-29 22:14:53', 108750, 0, 0, 5, 5, 3, 0, 0, 0, 0, 1091250, 0, 0, 'Fahmi book by bnb total biaya rp.1.091.250.00 (16be)', 1091250, '41'),
(372, 234, 1, 9, '2018-06-13', '2018-06-16', 1, 2, 3, 350000, 350000, 0, 275000, 275000, '2018-05-30 00:04:32', 0, 0, 0, 12, 5, 1, 600000, 0, 0, 0, 1800000, 0, 0, 'transfer ke bca lina', 1200000, '41'),
(373, 235, 6, 23, '2018-06-15', '2018-06-17', 2, 0, 2, 0, 700000, 0, 275000, 300000, '2018-05-30 10:09:44', 0, 0, 0, 5, 5, 1, 600000, 0, 0, 0, 1400000, 0, 0, 'Sisa saat check in. CP Dani', 800000, '42'),
(379, 236, 1, 11, '2018-05-31', '2018-06-03', 2, 1, 3, 400000, 400000, 0, 250000, 300000, '2018-05-31 15:56:40', 0, 0, 0, 5, 5, 3, 0, 0, 0, 0, 1222200, 0, 0, '', 1222200, '41'),
(380, 241, 1, 11, '2018-08-17', '2018-08-19', 2, 0, 2, 0, 400000, 0, 250000, 300000, '2018-06-01 04:34:01', 0, 0, 0, 5, 5, 1, 300000, 0, 0, 0, 800000, 0, 500000, '', 0, '1'),
(381, 242, 7, 22, '2018-06-01', '2018-06-02', 1, 0, 1, 0, 400000, 400000, 300000, 300000, '2018-06-01 14:28:58', 12000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 388000, 0, 0, 'ci jam 4 dari air bnb,', 388000, '41'),
(382, 243, 6, 23, '2018-06-01', '2018-06-02', 1, 0, 1, 0, 400000, 0, 275000, 300000, '2018-06-02 09:59:48', 25000, 0, 0, 9, 5, 3, 375000, 0, 0, 0, 375000, 0, 0, 'lunas', 0, '42'),
(385, 244, 1, 11, '2018-06-14', '2018-06-17', 2, 1, 3, 400000, 400000, 0, 250000, 300000, '2018-06-02 12:40:09', 0, 0, 0, 5, 5, 3, 0, 0, 0, 0, 2037000, 0, 0, '', 2037000, '41'),
(387, 245, 1, 19, '2018-06-16', '2018-06-19', 1, 2, 3, 700000, 700000, 0, 275000, 300000, '2018-06-02 14:42:33', 0, 0, 0, 7, 5, 1, 2100000, 0, 0, 0, 2100000, 0, 0, '', 0, '42'),
(388, 246, 1, 12, '2018-06-15', '2018-06-16', 1, 0, 1, 0, 400000, 0, 275000, 325000, '2018-06-02 15:27:16', 0, 0, 0, 9, 5, 1, 400000, 0, 0, 0, 400000, 0, 0, '', 0, '41'),
(389, 145, 1, 19, '2018-06-04', '2018-06-05', 0, 1, 1, 350000, 0, 350000, 275000, 300000, '2018-06-02 17:29:30', 0, 0, 0, 7, 5, 1, 350000, 0, 0, 0, 350000, 0, 0, '', 0, '42'),
(390, 247, 1, 12, '2018-06-17', '2018-06-19', 0, 2, 2, 400000, 0, 0, 275000, 325000, '2018-06-03 03:59:00', 24000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 776000, 0, 0, '', 776000, '41'),
(391, 248, 1, 19, '2018-06-05', '2018-06-07', 0, 2, 2, 350000, 0, 0, 275000, 300000, '2018-06-05 22:35:05', 35550, 0, 0, 5, 5, 3, 0, 0, 0, 0, 664450, 0, 0, 'Book by bnb', 664450, '42'),
(392, 249, 1, 24, '2018-06-16', '2018-06-18', 1, 1, 2, 350000, 400000, 0, 300000, 300000, '2018-06-06 15:02:41', 0, 0, 0, 5, 5, 3, 0, 0, 0, 0, 1455000, 0, 0, '', 1455000, '41'),
(393, 236, 1, 11, '2018-06-07', '2018-06-10', 2, 1, 3, 400000, 400000, 1200000, 250000, 300000, '2018-06-07 10:49:44', 45000, 0, 0, 5, 5, 1, 1155000, 0, 0, 0, 1155000, 0, 0, 'booking lewat bu anna,ci kamis co minggu transfer via danamon lunas', 0, '41'),
(394, 250, 1, 12, '2018-06-22', '2018-06-23', 1, 0, 1, 0, 400000, 0, 275000, 325000, '2018-06-07 18:39:28', 0, 0, 0, 5, 5, 1, 400000, 0, 0, 0, 400000, 0, 0, 'Lunas via danamon bu ana', 0, '41'),
(396, 251, 7, 22, '2018-06-16', '2018-06-18', 1, 1, 2, 400000, 400000, 0, 300000, 300000, '2018-06-07 18:44:43', 24000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 776000, 0, 0, 'Ci 16 Juni co 18juni', 776000, '41'),
(397, 253, 6, 23, '2018-06-07', '2018-06-09', 1, 1, 2, 375000, 400000, 0, 275000, 300000, '2018-06-08 14:09:01', 75000, 0, 0, 9, 5, 1, 350000, 0, 0, 0, 700000, 0, 0, 'Extend hrs nya co hari ini kurang 350rb\r\n\r\nsudah lunas', 350000, '42'),
(399, 255, 1, 9, '2018-06-08', '2018-06-09', 1, 0, 1, 350000, 0, 0, 275000, 275000, '2018-06-08 14:16:00', 10500, 0, 0, 5, 5, 3, 0, 0, 0, 0, 339500, 0, 0, 'book by airbnb', 339500, '41'),
(400, 256, 1, 9, '2018-06-17', '2018-06-18', 0, 2, 2, 350000, 0, 0, 275000, 275000, '2018-06-08 16:39:41', 0, 0, 0, 12, 5, 1, 0, 0, 0, 0, 700000, 0, 0, '', 700000, '41'),
(402, 257, 7, 20, '2018-06-17', '2018-06-19', 0, 2, 2, 350000, 0, 0, 270000, 270000, '2018-06-09 10:56:19', 21000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 679000, 0, 0, 'ci 17juni co 19 juni ', 679000, '41'),
(403, 233, 1, 12, '2018-06-09', '2018-06-11', 1, 1, 2, 400000, 400000, 0, 275000, 325000, '2018-06-09 21:08:40', 72500, 0, 0, 5, 5, 3, 0, 0, 0, 0, 727500, 0, 0, 'Kalénder unit kedua blm masuk', 727500, '41'),
(405, 259, 1, 9, '2018-06-18', '2018-06-20', 0, 2, 2, 350000, 0, 0, 275000, 275000, '2018-06-10 16:28:13', 0, 0, 0, 5, 5, 1, 500000, 0, 0, 0, 1000000, 0, 0, 'br dp 500rb,krg 550rb ci 18 juni co 20 juni \r\nke anna offline\r\nK\r\nJadinya diskon 50.000 total.biaya jd 1.000.000 bukan 1.050.000', 500000, '41'),
(406, 68, 1, 12, '2018-06-11', '2018-06-13', 0, 2, 2, 400000, 0, 0, 275000, 325000, '2018-06-11 12:31:02', 0, 0, 0, 5, 5, 3, 0, 0, 0, 0, 1200000, 0, 0, 'ini tamu sebenarnya Fahmi. ', 1200000, '41'),
(407, 260, 1, 19, '2018-06-12', '2018-06-16', 1, 3, 4, 350000, 400000, 0, 275000, 300000, '2018-06-11 13:20:33', 0, 0, 0, 7, 5, 9, 1200000, 0, 0, 0, 2200000, 0, 0, 'Lewat Travelio 1 malam, 3 malam offline', 1000000, '42'),
(408, 261, 7, 20, '2018-06-15', '2018-06-17', 2, 0, 2, 0, 350000, 0, 270000, 270000, '2018-06-12 11:24:34', 21000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 679000, 0, 0, 'book by airbnb', 679000, '41'),
(409, 263, 6, 23, '2018-06-17', '2018-06-19', 0, 2, 2, 375000, 0, 0, 275000, 300000, '2018-06-12 11:27:43', 22500, 0, 0, 5, 5, 3, 0, 0, 0, 0, 727500, 0, 0, '2hari,,', 727500, '42'),
(410, 256, 1, 24, '2018-06-18', '2018-06-20', 0, 2, 2, 350000, 0, 700000, 300000, 300000, '2018-06-12 17:35:55', 0, 0, 0, 12, 5, 1, 500000, 0, 0, 0, 1150000, 0, 0, 'pindahan 9BJ ', 650000, '41'),
(411, 264, 1, 19, '2018-06-21', '2018-06-23', 1, 1, 2, 350000, 400000, 750000, 275000, 300000, '2018-06-13 21:33:14', 0, 0, 0, 5, 5, 1, 400000, 0, 0, 0, 825000, 0, 0, 'ke yusuf', 850000, '42'),
(412, 265, 7, 20, '2018-06-14', '2018-06-15', 0, 1, 1, 350000, 0, 350000, 270000, 270000, '2018-06-14 12:31:03', 0, 0, 0, 7, 5, 1, 350000, 0, 0, 0, 350000, 0, 0, '', 0, '41'),
(413, 266, 6, 29, '2018-06-15', '2018-06-17', 2, 0, 2, 0, 400000, 800000, 300000, 300000, '2018-06-14 12:56:17', 0, 0, 0, 12, 5, 1, 1200000, 0, 0, 0, 1200000, 0, 0, 'CP: Anna\r\n', 0, '41'),
(414, 267, 7, 22, '2018-06-14', '2018-06-16', 1, 1, 2, 400000, 400000, 0, 300000, 300000, '2018-06-14 22:47:03', 24000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 776000, 0, 0, 'Check in malam', 776000, '41'),
(415, 268, 1, 24, '2018-06-14', '2018-06-16', 1, 1, 2, 350000, 400000, 0, 300000, 300000, '2018-06-14 22:47:46', 22500, 0, 0, 5, 5, 3, 0, 0, 0, 0, 727500, 0, 0, 'Komplen kasur', 727500, '41'),
(416, 269, 6, 29, '2018-06-18', '2018-06-19', 0, 1, 1, 350000, 0, 0, 300000, 300000, '2018-06-16 17:39:42', 0, 0, 0, 5, 5, 3, 0, 0, 0, 0, 533500, 0, 0, 'Via bnb ', 533500, '41'),
(417, 270, 1, 9, '2018-06-16', '2018-06-17', 1, 0, 1, 0, 350000, 0, 275000, 275000, '2018-06-16 20:22:37', 0, 0, 0, 5, 5, 3, 0, 0, 0, 0, 485000, 0, 0, 'Book by airbnb', 485000, '41'),
(418, 271, 6, 29, '2018-06-17', '2018-06-18', 0, 1, 1, 350000, 0, 0, 300000, 300000, '2018-06-17 13:31:47', 10500, 0, 0, 5, 5, 3, 0, 0, 0, 0, 339500, 0, 0, '', 339500, '41'),
(419, 272, 7, 22, '2018-06-18', '2018-06-20', 0, 2, 2, 400000, 0, 0, 300000, 300000, '2018-06-17 13:32:18', 24000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 776000, 0, 0, '', 776000, '41'),
(420, 268, 1, 12, '2018-06-16', '2018-06-17', 1, 0, 1, 0, 400000, 400000, 275000, 325000, '2018-06-17 17:00:33', 0, 0, 0, 5, 5, 1, 400000, 0, 0, 0, 400000, 0, 0, 'di isi dulu tamabahan pindahan dari 8bg,harga sewa belum tau', 0, '41'),
(421, 273, 6, 29, '2018-06-21', '2018-06-24', 2, 1, 3, 350000, 400000, 0, 300000, 300000, '2018-06-17 17:36:33', 136000, 0, 0, 5, 5, 1, 1014000, 0, 0, 0, 1014000, 0, 0, 'done, dikembalikan 150 waktu itu', 0, '41'),
(422, 241, 1, 11, '2018-06-17', '2018-06-19', 0, 2, 2, 400000, 0, 0, 250000, 300000, '2018-06-19 11:51:30', 800000, 0, 0, 5, 5, 1, 0, 0, 0, 0, 0, 0, 0, 'Ini salah input, sebenernya Agustus, tapi kalau2 Owner jadi curiga aja', 0, '41'),
(423, 274, 6, 23, '2018-07-04', '2018-07-05', 0, 1, 1, 375000, 0, 0, 275000, 300000, '2018-06-19 13:49:51', 0, 0, 0, 7, 5, 1, 250000, 0, 0, 0, 375000, 0, 0, 'Dp 500 dbagi 2 sama b 0305 \r\nSewa 2 unit\r\nCP : Yusuf', 125000, '42'),
(424, 274, 6, 29, '2018-07-04', '2018-07-05', 0, 1, 1, 350000, 0, 0, 300000, 300000, '2018-06-19 13:51:37', 0, 0, 0, 7, 5, 1, 250000, 0, 0, 0, 375000, 0, 0, 'Dp 500 dibagi 2 sama a133,sewa 2 unit\r\nCP : Yusuf', 125000, '41'),
(425, 275, 7, 20, '2018-06-19', '2018-06-20', 0, 1, 1, 350000, 0, 350000, 270000, 270000, '2018-06-19 18:58:15', 0, 0, 0, 12, 5, 1, 0, 0, 0, 0, 350000, 0, 0, 'Mw bayar cash dtg jam 9an,titip a rian', 350000, '41'),
(426, 276, 1, 11, '2018-06-21', '2018-06-23', 1, 1, 2, 400000, 400000, 0, 250000, 300000, '2018-06-20 13:42:20', 0, 0, 0, 5, 5, 3, 0, 0, 0, 0, 824500, 0, 0, 'CP : Anna', 824500, '41'),
(427, 277, 6, 23, '2018-06-22', '2018-06-23', 1, 0, 1, 0, 400000, 0, 275000, 300000, '2018-06-21 08:12:45', 0, 0, 0, 7, 5, 1, 300000, 0, 0, 0, 400000, 0, 0, 'CP : Yusuf\r\njumlah tamu 6', 100000, '42'),
(428, 278, 7, 22, '2018-06-22', '2018-06-24', 2, 0, 2, 0, 400000, 0, 300000, 300000, '2018-06-21 08:13:29', 24000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 776000, 0, 0, 'CP: Anna\r\nawalnya mau cancel, tapi ga jadi', 776000, '41'),
(429, 279, 1, 11, '2018-06-24', '2018-06-27', 0, 3, 3, 400000, 0, 0, 250000, 300000, '2018-06-21 08:18:08', 49000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 1151000, 0, 0, 'CP : Anna\r\nada di unit yang sudah di unlist\r\n2 hari lewat airbnb, 1 hari booking langsung (375rb)', 1151000, '41'),
(431, 280, 7, 22, '2018-06-21', '2018-06-22', 0, 1, 1, 400000, 0, 0, 300000, 300000, '2018-06-21 16:09:08', 50000, 0, 0, 12, 5, 1, 350000, 0, 0, 0, 350000, 0, 0, 'Lunas ke rek bca lina 350.000,1 hari\r\ncp :bu anna ', 0, '41'),
(432, 282, 1, 9, '2018-06-22', '2018-06-23', 1, 0, 1, 0, 350000, 350000, 275000, 275000, '2018-06-22 19:40:36', 0, 0, 0, 9, 5, 1, 375000, 0, 0, 0, 375000, 0, 0, 'Cp Yusuf. Lunas', 0, '41'),
(433, 250, 6, 23, '2018-06-23', '2018-06-24', 1, 0, 1, 0, 400000, 400000, 275000, 300000, '2018-06-23 14:53:19', 0, 0, 0, 5, 5, 1, 400000, 0, 0, 0, 400000, 0, 0, 'CP  Anna\r\npindahan dari 16BE', 0, '42'),
(434, 283, 1, 9, '2018-06-23', '2018-06-24', 1, 0, 1, 0, 350000, 350000, 275000, 275000, '2018-06-23 18:50:10', 0, 0, 0, 12, 5, 1, 0, 0, 0, 0, 350000, 0, 0, 'Dibayar besok pagee\r\nCp anna', 350000, '41'),
(435, 284, 1, 12, '2018-06-23', '2018-06-24', 1, 0, 1, 0, 400000, 0, 275000, 325000, '2018-06-23 23:32:24', 12000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 388000, 0, 0, 'Banyak Request', 388000, '41'),
(436, 164, 1, 24, '2018-06-23', '2018-06-24', 1, 0, 1, 0, 400000, 400000, 300000, 300000, '2018-06-23 23:56:39', 0, 0, 0, 5, 5, 1, 0, 0, 0, 0, 400000, 0, 0, 'Cp Anna\r\nNama tamu sebenarnya Merits, \r\nBelum bayar', 400000, '41'),
(443, 285, 6, 29, '2018-06-29', '2018-07-01', 2, 0, 2, 0, 400000, 800000, 300000, 300000, '2018-06-24 13:47:56', 100000, 0, 0, 7, 5, 1, 300000, 0, 0, 0, 700000, 0, 0, 'CP Yusuf\r\nrencana check out pagi', 400000, '41'),
(448, 286, 1, 12, '2018-06-25', '2018-06-27', 0, 2, 2, 400000, 0, 0, 275000, 325000, '2018-06-25 09:32:44', 0, 125000, 0, 7, 10, 1, 350000, 0, 0, 0, 1250000, 750000, 0, 'Cp : Anna\r\n10 tamu, charge ke Pak Frans 100rb', 900000, '41'),
(449, 287, 1, 24, '2018-06-25', '2018-06-26', 0, 1, 1, 350000, 0, 350000, 300000, 300000, '2018-06-25 10:12:25', 0, 0, 0, 5, 5, 1, 375000, 0, 0, 0, 375000, 0, 0, 'Cp Anna\r\nLunas, masuk pagi', 0, '42'),
(450, 236, 1, 19, '2018-06-25', '2018-06-26', 0, 1, 1, 350000, 0, 350000, 275000, 300000, '2018-06-25 10:15:54', 0, 0, 0, 5, 5, 1, 375000, 0, 0, 0, 375000, 0, 0, 'Cp Anna\r\nLunas, masuk pagi ambil 2 unit sama 8BG', 0, '42'),
(451, 288, 6, 23, '2018-06-27', '2018-06-28', 0, 1, 1, 375000, 0, 375000, 275000, 300000, '2018-06-27 01:31:04', 0, 25000, 0, 7, 6, 1, 400000, 0, 0, 0, 400000, 0, 0, '', 0, '42'),
(453, 288, 1, 19, '2018-06-30', '2018-07-01', 1, 0, 1, 0, 400000, 0, 275000, 300000, '2018-06-27 10:21:28', 26550, 0, 0, 5, 5, 3, 0, 0, 0, 0, 373450, 0, 373450, 'CP : Anna', 0, '3'),
(454, 288, 6, 23, '2018-06-30', '2018-07-01', 1, 0, 1, 0, 400000, 0, 275000, 300000, '2018-06-27 11:21:03', 12000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 388000, 0, 388000, '', 0, '3'),
(456, 295, 6, 23, '2018-06-29', '2018-06-30', 1, 0, 1, 0, 400000, 400000, 275000, 300000, '2018-06-27 23:22:52', 25000, 0, 0, 5, 5, 1, 375000, 0, 0, 0, 375000, 0, 0, '', 0, '42'),
(457, 294, 6, 23, '2018-06-30', '2018-07-01', 1, 0, 1, 0, 400000, 0, 275000, 300000, '2018-06-28 16:09:37', 12000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 388000, 0, 0, 'CP Anna\r\n', 388000, '42'),
(458, 296, 7, 22, '2018-07-01', '2018-07-08', 2, 5, 7, 0, 0, 2800000, 300000, 300000, '2018-06-28 20:55:42', 0, 0, 0, 12, 5, 1, 400000, 0, 0, 0, 2800000, 2100000, 0, 'cp anna', 4800000, '41'),
(459, 298, 1, 19, '2018-06-30', '2018-07-01', 1, 0, 1, 0, 400000, 0, 275000, 300000, '2018-06-29 10:29:48', 12000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 388000, 0, 0, '', 388000, '42'),
(460, 299, 1, 12, '2018-06-30', '2018-07-01', 1, 0, 1, 0, 400000, 0, 275000, 325000, '2018-06-29 10:31:00', 12000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 388000, 0, 0, 'perempuan by bnb', 388000, '41'),
(461, 300, 1, 11, '2018-06-30', '2018-07-01', 1, 0, 1, 0, 400000, 0, 250000, 300000, '2018-06-29 10:31:36', 12000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 388000, 0, 0, 'by bnb ', 388000, '41'),
(462, 301, 1, 19, '2018-07-01', '2018-07-05', 0, 4, 4, 350000, 0, 1400000, 275000, 300000, '2018-06-29 10:59:10', 0, 0, 0, 5, 5, 1, 375000, 0, 0, 0, 1500000, 0, 0, 'cp Anna', 1125000, '42'),
(463, 302, 7, 20, '2018-06-29', '2018-06-30', 1, 0, 1, 0, 350000, 0, 270000, 270000, '2018-06-29 13:13:10', 10500, 0, 0, 5, 5, 3, 0, 0, 0, 0, 339500, 0, 0, '', 339500, '41'),
(464, 303, 7, 22, '2018-06-30', '2018-07-01', 1, 0, 1, 0, 400000, 0, 300000, 300000, '2018-06-29 15:09:05', 12000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 388000, 0, 0, 'by bnb', 388000, '41'),
(465, 304, 1, 24, '2018-06-29', '2018-07-06', 2, 5, 7, 350000, 400000, 0, 300000, 300000, '2018-06-29 15:24:14', 76500, 0, 0, 5, 5, 3, 0, 0, 0, 0, 2473500, 1500000, 0, 'by bnb', 2473500, '42'),
(466, 76, 1, 11, '2018-07-01', '2018-07-03', 0, 2, 2, 400000, 0, 0, 250000, 300000, '2018-06-29 22:20:52', 0, 0, 0, 5, 5, 1, 800000, 0, 0, 0, 800000, 0, 0, 'cp anna\r\nhari pertama nya di 9bj dl', 0, '42'),
(467, 76, 1, 9, '2018-06-30', '2018-07-01', 1, 0, 1, 0, 350000, 350000, 275000, 275000, '2018-06-29 22:41:21', 0, 0, 0, 5, 5, 1, 400000, 0, 0, 0, 400000, 0, 0, 'cp anna, 1 hari di 9bj, lanjut di 12bd', 0, '41'),
(469, 305, 7, 20, '2018-06-30', '2018-07-01', 1, 0, 1, 0, 350000, 0, 270000, 270000, '2018-06-30 14:51:49', 10500, 0, 0, 5, 5, 3, 0, 0, 0, 0, 339500, 0, 0, 'cp anna', 339500, '41'),
(470, 306, 6, 23, '2018-07-01', '2018-07-04', 0, 3, 3, 375000, 0, 0, 275000, 300000, '2018-07-01 00:08:53', 33750, 0, 0, 5, 5, 3, 0, 0, 0, 0, 1091250, 0, 0, 'cp anna', 1091250, '42'),
(482, 307, 6, 23, '2018-07-06', '2018-07-08', 2, 0, 2, 0, 400000, 800000, 275000, 300000, '2018-07-02 15:51:34', 0, 0, 0, 9, 5, 1, 800000, 0, 0, 0, 800000, 0, 0, 'CP : Yusuf\r\nLunas, pengen early check in, tapi di cek dulu', 0, '42'),
(483, 309, 1, 12, '2018-07-03', '2018-07-08', 2, 3, 5, 400000, 400000, 2000000, 275000, 325000, '2018-07-03 12:39:33', 181250, 0, 0, 5, 5, 3, 0, 0, 0, 0, 1818750, 0, 0, 'cp anna', 1818750, '42'),
(484, 310, 1, 19, '2018-07-07', '2018-07-09', 1, 1, 2, 350000, 400000, 750000, 275000, 300000, '2018-07-03 12:42:20', 3100, 0, 0, 5, 5, 3, 0, 0, 0, 0, 746900, 0, 0, 'cp anna', 746900, '42'),
(485, 311, 1, 24, '2018-07-07', '2018-07-08', 1, 0, 1, 0, 400000, 0, 300000, 300000, '2018-07-04 10:45:53', 12000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 388000, 0, 0, 'CP Anna, pengen early checkin', 388000, '42'),
(486, 312, 7, 20, '2018-07-04', '2018-07-06', 0, 2, 2, 350000, 0, 700000, 270000, 270000, '2018-07-04 11:42:41', 21000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 679000, 0, 0, 'cp bu anna', 679000, '41'),
(487, 313, 1, 9, '2018-07-14', '2018-07-15', 1, 0, 1, 0, 350000, 350000, 275000, 275000, '2018-07-04 11:55:23', 0, 0, 0, 12, 5, 1, 350000, 0, 0, 0, 350000, 0, 0, 'cp anna via bca lina', 0, '42'),
(488, 314, 1, 11, '2018-07-04', '2018-07-05', 0, 1, 1, 400000, 0, 0, 250000, 300000, '2018-07-04 15:46:49', 12000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 388000, 0, 0, 'Cp anna ', 388000, '42'),
(489, 315, 1, 19, '2018-07-09', '2018-07-13', 0, 4, 4, 350000, 0, 0, 275000, 300000, '2018-07-05 09:05:20', 42000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 1358000, 0, 0, 'Cp anna', 1358000, '42'),
(490, 314, 1, 19, '2018-07-05', '2018-07-07', 1, 1, 2, 350000, 400000, 0, 275000, 300000, '2018-07-05 11:10:36', 22500, 0, 0, 5, 5, 3, 0, 0, 0, 0, 727500, 0, 0, 'Cp anna booking buat tmn nyakk', 727500, '42'),
(491, 316, 6, 23, '2018-07-05', '2018-07-06', 0, 1, 1, 375000, 0, 375000, 275000, 300000, '2018-07-05 12:10:17', 0, 0, 0, 5, 5, 3, 0, 0, 0, 0, 388000, 0, 0, 'cp anna book by bnb', 388000, '42'),
(492, 317, 6, 29, '2018-07-07', '2018-07-08', 1, 0, 1, 0, 400000, 0, 300000, 300000, '2018-07-06 07:26:20', 12000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 388000, 0, 0, 'Cp pa yusuf', 388000, '41'),
(493, 318, 1, 9, '2018-07-04', '2018-07-05', 0, 1, 1, 350000, 0, 350000, 275000, 275000, '2018-07-06 12:41:15', 0, 0, 0, 12, 5, 1, 375000, 0, 0, 0, 375000, 0, 0, 'cp anna offline transfer via bca lina', 0, '42'),
(494, 282, 1, 9, '2018-07-06', '2018-07-07', 1, 0, 1, 0, 350000, 350000, 275000, 275000, '2018-07-07 09:17:09', 0, 0, 0, 9, 5, 1, 375000, 0, 0, 0, 375000, 0, 0, 'CP : Yusuf\r\nLunas, check in Pagi', 0, '42');
INSERT INTO `tb_transaksi` (`kd_transaksi`, `kd_penyewa`, `kd_apt`, `kd_unit`, `check_in`, `check_out`, `hari_weekend`, `hari_weekday`, `hari`, `harga_sewa`, `harga_sewa_weekend`, `harga_sewa_gbg`, `harga_owner`, `harga_owner_weekend`, `tgl_transaksi`, `diskon`, `ekstra_charge`, `kd_bank`, `kd_kas`, `tamu`, `kd_booking`, `dp`, `setlement_dp`, `deposit`, `setlement_deposit`, `total_tagihan`, `total_harga_owner`, `sisa_pelunasan`, `catatan`, `pembayaran`, `status`) VALUES
(495, 319, 1, 9, '2018-07-07', '2018-07-09', 1, 1, 2, 350000, 350000, 0, 275000, 275000, '2018-07-07 09:19:53', 21000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 679000, 0, 0, 'CP : Anna', 679000, '42'),
(496, 320, 1, 11, '2018-07-06', '2018-07-08', 2, 0, 2, 0, 400000, 800000, 250000, 300000, '2018-07-07 10:02:57', 72500, 0, 0, 5, 5, 3, 0, 0, 0, 0, 727500, 0, 0, 'cp anna', 727500, '42'),
(497, 307, 6, 29, '2018-07-08', '2018-07-09', 0, 1, 1, 350000, 0, 350000, 300000, 300000, '2018-07-08 12:28:56', 0, 0, 0, 7, 5, 1, 400000, 0, 0, 0, 400000, 0, 0, 'lunas cp anna', 0, '41'),
(498, 321, 1, 12, '2018-07-11', '2018-07-13', 0, 2, 2, 400000, 0, 0, 275000, 325000, '2018-07-08 13:23:20', 24000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 776000, 0, 0, '', 776000, '42'),
(499, 322, 1, 12, '2018-07-09', '2018-07-11', 0, 2, 2, 400000, 0, 800000, 275000, 325000, '2018-07-09 16:55:55', 0, 0, 0, 5, 5, 3, 0, 0, 0, 0, 800000, 0, 0, 'cp anna', 800000, '42'),
(500, 323, 1, 11, '2018-07-09', '2018-07-10', 0, 1, 1, 400000, 0, 400000, 250000, 300000, '2018-07-09 22:53:06', 0, 0, 0, 12, 5, 1, 400000, 0, 0, 0, 400000, 0, 0, 'cp anna rese super rese se rese rese nya...', 0, '42'),
(501, 324, 1, 19, '2018-08-13', '2018-08-15', 0, 2, 2, 350000, 0, 0, 275000, 300000, '2018-07-10 15:38:52', 0, 0, 0, 5, 5, 1, 400000, 0, 0, 0, 800000, 0, 400000, 'cp anna ', 0, '1'),
(502, 325, 1, 11, '2018-07-11', '2018-07-12', 0, 1, 1, 400000, 0, 0, 250000, 300000, '2018-07-11 08:45:25', 12000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 388000, 0, 0, 'cp anna', 388000, '42'),
(503, 326, 6, 23, '2018-07-21', '2018-07-23', 1, 1, 2, 375000, 400000, 775000, 275000, 300000, '2018-07-11 08:50:04', 0, 0, 0, 5, 5, 3, 0, 0, 0, 0, 776000, 0, 0, 'cp anna', 776000, '42'),
(505, 328, 6, 23, '2018-07-14', '2018-07-15', 1, 0, 1, 0, 400000, 0, 275000, 300000, '2018-07-11 09:08:11', 12000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 388000, 0, 0, 'CP : Anna', 388000, '42'),
(506, 329, 1, 9, '2018-08-14', '2018-08-16', 0, 2, 2, 350000, 0, 0, 275000, 275000, '2018-07-11 09:21:10', 21000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 679000, 0, 679000, 'CP : Yusuf/Anna', 0, '1'),
(507, 330, 1, 12, '2018-08-13', '2018-08-16', 0, 3, 3, 400000, 0, 0, 275000, 325000, '2018-07-11 11:39:57', 75000, 0, 0, 5, 5, 1, 375000, 0, 0, 0, 1125000, 0, 750000, 'cp anna\r\n', 0, '1'),
(508, 331, 1, 24, '2018-07-11', '2018-07-12', 0, 1, 1, 350000, 0, 350000, 300000, 300000, '2018-07-11 16:57:12', 0, 0, 0, 12, 5, 1, 375000, 0, 0, 0, 375000, 0, 0, 'CP Teh Anna, uang pembayaran di Teh Anna ', 0, '42'),
(509, 332, 6, 23, '2018-07-11', '2018-07-13', 0, 2, 2, 375000, 0, 750000, 275000, 300000, '2018-07-12 00:00:59', 0, 0, 0, 5, 5, 3, 0, 0, 0, 0, 776000, 0, 0, 'cp anna', 776000, '42'),
(510, 164, 1, 11, '2018-07-21', '2018-07-24', 1, 2, 3, 400000, 400000, 1200000, 250000, 300000, '2018-07-12 20:37:21', 0, 0, 0, 5, 5, 1, 400000, 0, 0, 0, 1200000, 0, 0, 'CP: Anna', 800000, '42'),
(511, 333, 1, 12, '2018-07-13', '2018-07-14', 1, 0, 1, 0, 400000, 0, 275000, 325000, '2018-07-13 12:30:23', 12000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 388000, 0, 0, '', 388000, '42'),
(512, 334, 1, 11, '2018-07-13', '2018-07-18', 2, 3, 5, 400000, 400000, 0, 250000, 300000, '2018-07-13 17:01:01', 60000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 1940000, 0, 0, '', 1940000, '42'),
(513, 287, 1, 19, '2018-07-14', '2018-07-16', 1, 1, 2, 350000, 400000, 750000, 275000, 300000, '2018-07-13 17:28:29', 0, 0, 0, 5, 5, 1, 750000, 0, 0, 0, 750000, 0, 0, 'cp anna', 0, '42'),
(514, 335, 1, 24, '2018-07-13', '2018-07-15', 2, 0, 2, 0, 400000, 800000, 300000, 300000, '2018-07-13 17:36:49', 33700, 0, 0, 5, 5, 3, 0, 0, 0, 0, 766300, 0, 0, 'cp anna', 766300, '42'),
(515, 336, 7, 22, '2018-07-13', '2018-07-17', 2, 2, 4, 400000, 400000, 0, 300000, 300000, '2018-07-13 22:39:06', 48000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 1552000, 0, 0, 'cp: Anna\r\nAIR BNB  DUA BOOKING 2 PAYMENT', 1552000, '42'),
(517, 337, 6, 29, '2018-07-14', '2018-07-15', 1, 0, 1, 0, 400000, 0, 300000, 300000, '2018-07-13 22:44:41', 12000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 388000, 0, 0, 'CP: Anna', 388000, '42'),
(518, 338, 1, 19, '2018-07-13', '2018-07-14', 1, 0, 1, 0, 400000, 400000, 275000, 300000, '2018-07-13 23:05:47', 200000, 0, 0, 5, 5, 1, 0, 0, 0, 0, 200000, 0, 0, 'CP : Yusuf', 200000, '42'),
(519, 339, 1, 12, '2018-07-14', '2018-07-15', 1, 0, 1, 0, 400000, 0, 275000, 325000, '2018-07-14 10:02:06', 12000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 388000, 0, 0, 'cp : Yusuf', 388000, '42'),
(538, 340, 1, 9, '2018-07-19', '2018-07-20', 0, 1, 1, 350000, 0, 350000, 275000, 275000, '2018-07-15 18:50:32', 0, 0, 0, 5, 5, 1, 150000, 0, 0, 0, 350000, 0, 0, 'CP : Yusuf', 200000, '42'),
(539, 341, 6, 23, '2018-07-30', '2018-07-31', 0, 1, 1, 375000, 0, 375000, 275000, 300000, '2018-07-15 18:52:52', 0, 0, 0, 12, 5, 1, 300000, 0, 0, 0, 375000, 0, 75000, 'CP : Yusuf', 0, '1'),
(554, 342, 6, 23, '2018-08-10', '2018-08-12', 2, 0, 2, 0, 400000, 800000, 275000, 300000, '2018-07-16 19:57:11', 0, 0, 0, 5, 5, 1, 425000, 0, 0, 0, 850000, 0, 425000, 'rempong abies...\r\nCp Anna', 0, '1'),
(555, 343, 1, 9, '2018-07-21', '2018-07-22', 1, 0, 1, 0, 350000, 350000, 275000, 275000, '2018-07-16 21:22:05', 0, 0, 0, 5, 5, 1, 375000, 0, 0, 0, 375000, 0, 0, 'cp anna', 0, '42'),
(556, 344, 1, 12, '2018-07-17', '2018-07-19', 0, 2, 2, 400000, 0, 800000, 275000, 325000, '2018-07-17 11:29:02', 0, 0, 0, 9, 5, 1, 800000, 0, 0, 0, 800000, 0, 0, 'CP : Yusuf\r\nLunas', 0, '42'),
(557, 347, 1, 19, '2018-07-27', '2018-07-29', 2, 0, 2, 0, 400000, 0, 275000, 300000, '2018-07-17 15:41:11', 24000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 776000, 0, 776000, 'CP: Anna', 0, '1'),
(558, 348, 1, 24, '2018-07-17', '2018-08-16', 8, 22, 30, 0, 0, 0, 300000, 300000, '2018-07-17 17:03:35', 0, 0, 0, 12, 5, 1, 6200000, 0, 1500000, 0, 4700000, 3500000, 1500000, 'cp anna  bayar via bca ,6,2jt deposit 1,5jt,sewa 4,7jt', 0, '1'),
(559, 349, 1, 19, '2018-07-17', '2018-07-21', 1, 3, 4, 350000, 400000, 0, 275000, 300000, '2018-07-17 17:51:09', 0, 0, 0, 5, 5, 1, 400000, 0, 0, 0, 1600000, 0, 0, 'Cp anna\r\nextend sampai sabtu sisa 1,2jt', 1200000, '42'),
(560, 350, 1, 9, '2018-07-27', '2018-07-28', 1, 0, 1, 0, 350000, 350000, 275000, 275000, '2018-07-18 08:15:47', 0, 0, 0, 9, 5, 1, 350000, 0, 0, 0, 350000, 0, 0, 'CP : Yusuf\r\nLunas', 0, '1'),
(561, 351, 1, 12, '2018-07-19', '2018-07-20', 0, 1, 1, 400000, 0, 400000, 275000, 325000, '2018-07-18 12:51:16', 0, 0, 0, 5, 5, 1, 400000, 0, 0, 0, 400000, 0, 0, 'cp anna temennya azwar', 0, '42'),
(562, 204, 1, 9, '2018-07-18', '2018-07-19', 0, 1, 1, 350000, 0, 350000, 275000, 275000, '2018-07-18 13:24:03', 0, 0, 0, 7, 5, 1, 350000, 0, 0, 0, 350000, 0, 0, 'cp anna', 0, '42'),
(563, 352, 1, 11, '2018-08-13', '2018-08-15', 0, 2, 2, 400000, 0, 800000, 250000, 300000, '2018-07-18 21:02:25', 0, 0, 0, 7, 5, 1, 450000, 0, 0, 0, 900000, 0, 450000, 'Cp Anna', 0, '1'),
(564, 353, 6, 23, '2018-07-18', '2018-07-19', 0, 1, 1, 375000, 0, 375000, 275000, 300000, '2018-07-19 07:40:40', 125000, 0, 0, 7, 5, 1, 250000, 0, 0, 0, 250000, 0, 0, 'cp anna', 0, '42'),
(565, 354, 7, 20, '2018-07-21', '2018-07-22', 1, 0, 1, 0, 350000, 0, 270000, 270000, '2018-07-19 09:52:48', 10500, 0, 0, 5, 5, 3, 0, 0, 0, 0, 339500, 0, 0, 'CP : Yusuf', 339500, '41'),
(566, 349, 1, 11, '2018-07-19', '2018-07-21', 1, 1, 2, 400000, 400000, 800000, 250000, 300000, '2018-07-19 10:09:54', 0, 0, 0, 5, 5, 1, 0, 0, 0, 0, 800000, 0, 0, 'cp anna\r\ndhamar 18 BF tambah unit', 800000, '42'),
(567, 355, 1, 12, '2018-07-29', '2018-08-04', 1, 5, 6, 400000, 400000, 2400000, 275000, 325000, '2018-07-19 16:25:48', 0, 0, 0, 7, 5, 1, 900000, 0, 0, 0, 2400000, 0, 1500000, 'CP: Yusuf', 0, '1'),
(568, 287, 1, 9, '2018-07-20', '2018-07-21', 1, 0, 1, 0, 350000, 350000, 275000, 275000, '2018-07-19 19:36:33', 0, 0, 0, 5, 5, 1, 0, 0, 0, 0, 350000, 0, -350, 'cp anna', 350350, '42'),
(569, 287, 1, 19, '2018-07-21', '2018-07-22', 1, 0, 1, 0, 400000, 400000, 275000, 300000, '2018-07-19 19:39:47', 0, 0, 0, 5, 5, 1, 400000, 0, 0, 0, 400000, 0, 0, 'cp anna', 0, '42'),
(570, 356, 1, 19, '2018-08-02', '2018-08-05', 2, 1, 3, 350000, 400000, 1150000, 275000, 300000, '2018-07-19 21:10:20', 0, 0, 0, 9, 5, 1, 450000, 0, 0, 0, 1150000, 0, 700000, 'CP : Yusuf', 0, '1'),
(571, 357, 1, 30, '2018-07-19', '2018-07-21', 1, 1, 2, 400000, 425000, 825000, 275000, 325000, '2018-07-19 22:52:22', 58700, 0, 0, 5, 5, 3, 0, 0, 0, 0, 766300, 0, 0, 'CP : Yusuf', 766300, '42'),
(572, 358, 1, 12, '2018-07-20', '2018-07-22', 2, 0, 2, 0, 400000, 800000, 275000, 325000, '2018-07-20 09:47:43', 0, 0, 0, 5, 5, 3, 0, 0, 0, 0, 800000, 0, 0, 'cp anna', 800000, '42'),
(573, 349, 1, 30, '2018-07-21', '2018-07-22', 1, 0, 1, 0, 425000, 425000, 275000, 325000, '2018-07-20 23:05:53', 25000, 0, 0, 5, 5, 1, 0, 0, 0, 0, 400000, 0, 0, 'cp anna', 400000, '42'),
(574, 359, 1, 9, '2018-07-28', '2018-08-07', 2, 8, 10, 350000, 350000, 0, 275000, 275000, '2018-07-21 08:45:48', 436643, 0, 0, 5, 5, 3, 0, 0, 0, 0, 3063357, 0, 3063357, 'CP: Anna', 0, '1'),
(576, 360, 1, 11, '2018-07-27', '2018-07-30', 2, 1, 3, 400000, 400000, 1200000, 250000, 300000, '2018-07-21 20:07:05', 0, 0, 0, 5, 5, 1, 1200000, 0, 0, 0, 1200000, 0, 0, 'cp anna\r\nini ibu mertuanya alexander', 0, '1'),
(577, 361, 1, 19, '2018-07-22', '2018-07-24', 0, 2, 2, 350000, 0, 0, 275000, 300000, '2018-07-21 20:18:10', 0, 0, 0, 5, 5, 3, 0, 0, 0, 0, 746900, 0, 0, 'CP : Anna', 746900, '42'),
(578, 363, 1, 30, '2018-07-23', '2018-07-25', 0, 2, 2, 400000, 0, 800000, 275000, 325000, '2018-07-22 11:14:33', 0, 0, 0, 5, 5, 3, 0, 0, 0, 0, 824500, 0, 0, 'cp anna\r\nilham', 824500, '42'),
(579, 363, 1, 30, '2018-07-23', '2018-07-25', 0, 2, 2, 400000, 0, 800000, 275000, 325000, '2018-07-22 11:14:35', 0, 0, 0, 5, 5, 3, 0, 0, 0, 0, 824500, 0, 824500, 'cp anna\r\nilham', 0, '2'),
(580, 141, 1, 9, '2018-07-23', '2018-07-24', 0, 1, 1, 350000, 0, 350000, 275000, 275000, '2018-07-23 17:06:40', 50000, 0, 0, 5, 5, 1, 300000, 0, 0, 0, 300000, 0, 0, 'Cp anna', 0, '42'),
(581, 301, 1, 19, '2018-08-10', '2018-08-12', 2, 0, 2, 0, 400000, 800000, 275000, 300000, '2018-07-23 20:25:48', 50000, 0, 0, 5, 5, 1, 0, 0, 0, 0, 750000, 0, 375000, 'CP : Anna', 375000, '1'),
(582, 364, 1, 19, '2018-07-25', '2018-07-27', 0, 2, 2, 350000, 0, 0, 275000, 300000, '2018-07-24 08:45:53', 21000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 679000, 0, 679000, 'cp anna', 0, '1'),
(583, 365, 1, 9, '2018-07-24', '2018-07-26', 0, 2, 2, 350000, 0, 700000, 275000, 275000, '2018-07-24 17:17:50', 0, 0, 0, 5, 5, 1, 0, 0, 0, 0, 700000, 0, 0, 'cp anna', 700000, '42'),
(584, 365, 1, 30, '2018-07-26', '2018-07-31', 2, 3, 5, 400000, 425000, 2050000, 275000, 325000, '2018-07-24 17:18:53', 50000, 0, 0, 5, 5, 1, 0, 0, 0, 0, 2000000, 0, 0, 'cp anna', 2000000, '1'),
(585, 366, 6, 23, '2018-07-28', '2018-07-29', 1, 0, 1, 0, 400000, 0, 275000, 300000, '2018-07-24 17:37:39', 12000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 388000, 0, 388000, '', 0, '1'),
(586, 367, 6, 23, '2018-09-01', '2018-09-02', 1, 0, 1, 0, 400000, 400000, 275000, 300000, '2018-07-25 08:09:50', 0, 0, 0, 5, 5, 1, 0, 0, 0, 0, 400000, 0, 400000, 'Blok dulu, orang Synergy', 0, '1'),
(587, 368, 1, 12, '2018-07-25', '2018-07-29', 2, 2, 4, 400000, 400000, 1600000, 275000, 325000, '2018-07-25 12:34:28', 0, 0, 0, 5, 5, 1, 0, 0, 0, 0, 1600000, 0, 1600000, 'Temnnya Heri Cp Anna', 0, '1'),
(588, 369, 7, 20, '2018-07-28', '2018-07-29', 1, 0, 1, 0, 350000, 0, 270000, 270000, '2018-07-26 08:55:31', 10500, 0, 0, 5, 5, 3, 0, 0, 0, 0, 339500, 0, 339500, 'CP : Anna', 0, '1'),
(589, 370, 1, 11, '2018-08-04', '2018-08-06', 1, 1, 2, 400000, 400000, 0, 250000, 300000, '2018-07-26 08:58:36', 24000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 776000, 0, 776000, 'CP : Anna', 0, '1'),
(590, 371, 6, 23, '2018-07-27', '2018-07-28', 1, 0, 1, 0, 400000, 0, 275000, 300000, '2018-07-27 08:44:11', 12000, 0, 0, 5, 5, 3, 0, 0, 0, 0, 388000, 0, 388000, 'CP : Anna', 0, '1'),
(591, 372, 6, 23, '2018-07-29', '2018-07-30', 0, 1, 1, 375000, 0, 375000, 275000, 300000, '2018-07-27 08:58:55', 25000, 0, 0, 12, 5, 1, 350000, 0, 0, 0, 350000, 0, 0, 'CP : Yusuf, late check in (subuh)', 0, '1'),
(592, 373, 1, 11, '2018-08-02', '2018-08-03', 0, 1, 1, 400000, 0, 400000, 250000, 300000, '2018-07-27 11:32:04', 75000, 0, 0, 7, 5, 1, 325000, 0, 0, 0, 325000, 0, 0, 'CP : Yusuf, Lunas, Check in pagi, Check out Sore tanggal 2', 0, '1'),
(593, 374, 7, 22, '2018-07-27', '2018-07-28', 1, 0, 1, 0, 400000, 400000, 300000, 300000, '2018-07-27 13:03:18', 0, 0, 0, 7, 5, 1, 400000, 0, 0, 0, 400000, 0, 0, 'CP : Yusuf, Lunas, check in Sore (sekitar jam 5).', 0, '1'),
(594, 303, 6, 23, '2018-08-27', '2018-08-30', 0, 3, 3, 375000, 0, 1125000, 275000, 300000, '2018-08-25 19:31:52', 0, 0, 0, 5, 5, 1, 10000, 0, 0, 0, 1125000, 0, 1115000, '', 0, '1'),
(595, 141, 6, 29, '2018-08-25', '2018-08-27', 1, 1, 2, 350000, 400000, 750000, 300000, 300000, '2018-08-25 19:42:25', 0, 0, 0, 7, 5, 1, 1000000, 0, 0, 0, 750000, 0, -250000, '', 0, '1'),
(596, 141, 6, 31, '2018-08-27', '2018-08-28', 0, 1, 1, 250000, 0, 250000, 200000, 250000, '2018-08-25 19:43:00', 0, 0, 0, 7, 5, 9, 10000, 0, 0, 0, 250000, 0, -260000, '', 500000, '1'),
(597, 197, 1, 11, '2018-08-28', '2018-08-29', 0, 1, 1, 400000, 0, 400000, 250000, 300000, '2018-08-25 19:44:03', 0, 0, 0, 7, 5, 1, 1000, 0, 0, 0, 400000, 0, -1000, '', 400000, '42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi_umum`
--

CREATE TABLE IF NOT EXISTS `tb_transaksi_umum` (
  `kd_transaksi_umum` int(4) NOT NULL AUTO_INCREMENT,
  `kd_kas` int(4) NOT NULL,
  `kebutuhan` varchar(20) NOT NULL,
  `harga` int(20) NOT NULL,
  `jumlah` int(4) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `tanggal` datetime NOT NULL,
  `status` char(5) NOT NULL COMMENT '1 = bill, 51 = bill paid un settled, 52 = bill paid and settled, 9 = cancel',
  `jatuh_tempo` date NOT NULL,
  PRIMARY KEY (`kd_transaksi_umum`),
  KEY `kd_kas` (`kd_kas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=247 ;

--
-- Dumping data untuk tabel `tb_transaksi_umum`
--

INSERT INTO `tb_transaksi_umum` (`kd_transaksi_umum`, `kd_kas`, `kebutuhan`, `harga`, `jumlah`, `keterangan`, `tanggal`, `status`, `jatuh_tempo`) VALUES
(10, 12, 'unit/12', 137500, 1, 'bayar internet', '2018-03-13 16:46:23', '', '0000-00-00'),
(11, 12, 'umum', 177600, 1, 'laundry dr tgl 3 maret- 13mare', '2018-03-13 16:47:46', '', '0000-00-00'),
(12, 12, 'umum', 300000, 1, 'bayar unit sb 11 no 1(a rian)', '2018-03-13 16:48:41', '', '0000-00-00'),
(13, 12, 'umum', 36400, 1, 'laundry tgl 19 maret 2018', '2018-03-20 09:32:53', '', '0000-00-00'),
(14, 12, 'umum', 20000, 1, 'grab ke newtown tgl 16 maret 2', '2018-03-20 09:33:37', '', '0000-00-00'),
(15, 12, 'umum', 42000, 1, 'laundry tgl 17 maret 2018', '2018-03-20 15:15:05', '', '0000-00-00'),
(16, 12, 'umum', 100000, 1, 'persiapan beli galon di newtow', '2018-03-20 15:19:34', '', '0000-00-00'),
(17, 12, 'unit/19', 137500, 1, 'internet Im2', '2018-03-21 13:57:53', '', '0000-00-00'),
(18, 5, 'unit/24', 590000, 1, 'Listrik dan Air Pemakaian Feb 2018', '2018-03-23 09:38:46', '', '0000-00-00'),
(19, 5, 'unit/9', 587500, 1, 'Listrik dan Air Pemakaian Feb 2018', '2018-03-23 09:39:37', '', '0000-00-00'),
(20, 5, 'unit/11', 434000, 1, 'Listrik dan Air pemakaian Feb 2018', '2018-03-23 09:40:21', '', '0000-00-00'),
(21, 5, 'unit/19', 338586, 1, 'Listrik dan Air Pemakaian Feb 2018', '2018-03-23 09:41:16', '', '0000-00-00'),
(22, 12, 'unit/11', 105000, 1, 'ganti gas 12 bd', '2018-03-23 15:11:43', '', '0000-00-00'),
(23, 12, 'umum', 21500, 1, 'laundry tgl 20 maret 2018', '2018-03-25 08:53:31', '', '0000-00-00'),
(24, 12, 'umum', 68100, 1, 'laundry tgl 25&28maret 2018', '2018-03-28 12:36:27', '', '0000-00-00'),
(25, 12, 'umum', 7500, 1, 'parkir motor tgl 28 maret', '2018-03-28 12:37:00', '', '0000-00-00'),
(26, 12, 'unit/22', 18800, 1, 'beli aqua galon 30maret 2018', '2018-03-30 14:34:05', '', '0000-00-00'),
(27, 12, 'unit/19', 50000, 1, 'beli aqua galon 9 maret 2018', '2018-03-30 14:36:18', '', '0000-00-00'),
(28, 12, 'umum', 25000, 4, 'beli aqua galon 10maret 2018', '2018-03-30 14:40:41', '', '0000-00-00'),
(29, 12, 'umum', 25000, 4, 'beli  aqua galon tgl 15 maret ', '2018-03-30 14:41:25', '', '0000-00-00'),
(30, 12, 'umum', 25000, 2, 'beli aqua galon tgl 24 maret 2', '2018-03-30 14:41:59', '', '0000-00-00'),
(32, 12, 'umum', 4500, 1, 'parkir motor tgl 29 maret', '2018-03-30 14:42:34', '', '0000-00-00'),
(33, 12, 'umum', 106000, 1, 'konsumsi meeting tgl 30 maret', '2018-03-30 14:43:17', '', '0000-00-00'),
(34, 12, 'umum', 26600, 1, 'laundry tgl 29 maret 2018', '2018-03-30 14:43:51', '', '0000-00-00'),
(35, 12, 'umum', 7500, 1, 'parkir tgl 27 maret ', '2018-03-30 18:13:16', '', '0000-00-00'),
(36, 12, 'umum', 19500, 1, 'beli aqua galon unit ec 8-6', '2018-03-30 18:16:37', '', '0000-00-00'),
(37, 12, 'umum', 58600, 1, 'laundry bedcover tgl 30&tgl 31', '2018-03-31 17:01:54', '', '0000-00-00'),
(38, 12, 'umum', 130000, 1, 'bayar makan IT ke arian', '2018-04-01 15:38:33', '', '0000-00-00'),
(39, 12, 'umum', 20500, 1, 'bayar galon sa 07 tgl 01 april', '2018-04-01 15:39:13', '', '0000-00-00'),
(40, 12, 'umum', 19500, 1, 'aqua galon kantor', '2018-04-01 15:42:01', '', '0000-00-00'),
(41, 12, 'umum', 55000, 1, 'Laundry tanggal 1April 2018', '2018-04-03 10:36:29', '', '0000-00-00'),
(42, 12, 'umum', 25500, 1, 'laundry tgl 5 april sesi 1', '2018-04-05 17:14:47', '', '0000-00-00'),
(43, 12, 'umum', 90000, 1, 'bayar parkir langganan IT farh', '2018-04-06 14:22:23', '', '0000-00-00'),
(44, 12, 'umum', 45000, 1, 'bayar parkir langganan IT imro', '2018-04-06 14:23:07', '', '0000-00-00'),
(45, 12, 'umum', 42000, 1, 'laundry tgl 5 sesi 2 dan tgl 7', '2018-04-07 09:28:35', '', '0000-00-00'),
(46, 12, 'umum', 80000, 1, 'parkir langganan mobil bu anna', '2018-04-07 17:52:59', '', '0000-00-00'),
(47, 12, 'umum', 33500, 1, 'laundry tgl 7 april 2018 sore', '2018-04-07 17:53:40', '', '0000-00-00'),
(48, 12, 'umum', 219800, 1, 'Beli handuk 6 pcs dan sunligt ', '2018-04-09 21:32:33', '', '0000-00-00'),
(49, 12, 'umum', 19800, 1, 'laundry tgl 10 april 2018', '2018-04-10 09:00:49', '', '0000-00-00'),
(50, 12, 'umum', 30000, 1, 'ongkos gojek dan angkot ke jar', '2018-04-10 17:38:00', '', '0000-00-00'),
(51, 12, 'unit/23', 100000, 1, 'bayar listrik tgl 10 april', '2018-04-11 12:03:17', '', '0000-00-00'),
(53, 12, 'unit/23', 1188000, 1, 'service charge ', '2018-04-11 12:04:49', '', '0000-00-00'),
(54, 12, 'umum', 20000, 1, 'aqua galon di jardin tgl 11 ap', '2018-04-12 11:29:49', '', '0000-00-00'),
(55, 12, 'umum', 19200, 1, 'laundry sesi 2 tgl 10 april 20', '2018-04-12 11:30:19', '', '0000-00-00'),
(56, 12, 'umum', 50000, 1, 'laundry tgl 12 april 2018', '2018-04-12 15:34:53', '', '0000-00-00'),
(57, 12, 'umum', 75000, 1, 'beli aqua 3pcs,tgl 13 april 20', '2018-04-13 17:17:06', '', '0000-00-00'),
(58, 12, 'unit/9', 105000, 1, 'beli gas ', '2018-04-14 18:35:43', '', '0000-00-00'),
(59, 12, 'umum', 50000, 1, 'beli aqua galon 2pcs', '2018-04-14 18:36:20', '', '0000-00-00'),
(60, 12, 'umum', 52000, 1, 'laundry tgl 14 april 2018', '2018-04-15 09:24:11', '', '0000-00-00'),
(61, 12, 'umum', 43500, 1, 'laundry tgl 16april 2018(dr ne', '2018-04-16 16:43:56', '', '0000-00-00'),
(62, 12, 'umum', 56500, 1, 'laundry tgl 17/4/2018', '2018-04-19 09:21:28', '', '0000-00-00'),
(63, 12, 'umum', 56500, 1, 'laundry tgl 17/4/2018', '2018-04-19 09:21:29', '', '0000-00-00'),
(64, 5, 'umum', 348800, 1, 'amenities', '2018-04-19 09:22:59', '', '0000-00-00'),
(65, 12, 'umum', 128000, 1, 'uang makan it tgl 14-15 april ', '2018-04-20 12:31:28', '', '0000-00-00'),
(66, 12, 'umum', 76900, 1, 'Laundry tgl 22 april', '2018-04-22 18:22:09', '', '0000-00-00'),
(67, 12, 'umum', 196000, 1, 'makan it tgl 21&22 april 2018', '2018-04-22 18:36:42', '', '0000-00-00'),
(68, 12, 'umum', 70700, 1, 'Laundry tgl 25 april +karpet 12bd', '2018-04-26 20:34:02', '', '0000-00-00'),
(69, 12, 'umum', 150000, 1, 'kasi pa ade (jardin)untuk benerin wastafel', '2018-04-28 09:03:40', '', '0000-00-00'),
(70, 12, 'umum', 29800, 1, 'laundry tgl 28 april 2018', '2018-04-28 09:04:16', '', '0000-00-00'),
(71, 12, 'umum', 175000, 1, 'beli aqua galon 7 tgl 28 april 2018', '2018-04-28 16:05:10', '', '0000-00-00'),
(72, 12, 'umum', 51700, 1, 'laundry tgl 28 april 2018 sore', '2018-04-28 17:06:29', '', '0000-00-00'),
(73, 12, 'unit/19', 137500, 1, 'Bayar internet IM2', '2018-04-29 20:33:22', '', '0000-00-00'),
(74, 12, 'unit/11', 61500, 1, 'Shower mandi pluto', '2018-04-29 21:00:49', '', '0000-00-00'),
(75, 12, 'umum', 31600, 1, 'laundry tgl 30 april 2018', '2018-04-30 11:35:36', '', '0000-00-00'),
(76, 12, 'unit/23', 50000, 1, 'beli token listrik ', '2018-04-30 16:20:10', '', '0000-00-00'),
(77, 12, 'umum', 22000, 1, 'beli aqua jardin tgl 30 april 2018', '2018-04-30 16:20:59', '', '0000-00-00'),
(78, 5, 'unit/24', 644710, 1, 'Listrik air dan internet pemakaian Maret 2018', '2018-05-01 09:30:32', '', '0000-00-00'),
(79, 5, 'unit/11', 524886, 1, 'Listrik air dan internet pemakaian Maret 2018', '2018-05-01 11:19:55', '', '0000-00-00'),
(80, 12, 'umum', 23900, 1, 'laundry tgl 2 mei 2018', '2018-05-02 08:56:47', '', '0000-00-00'),
(83, 12, 'umum', 23300, 1, 'laundry tgl 3 mei 2018', '2018-05-03 16:44:03', '', '0000-00-00'),
(84, 12, 'umum', 170000, 1, 'parkir langganan mobil bu anna,motor maya dan it farhan bulan mei 2018', '2018-05-05 10:47:08', '', '0000-00-00'),
(85, 12, 'umum', 75000, 1, 'beli aqua  galon tg; 6 mei 2018', '2018-05-10 09:11:24', '', '0000-00-00'),
(86, 12, 'umum', 50000, 1, 'beli aquagalon tgl 7 mei 2018', '2018-05-10 09:12:09', '', '0000-00-00'),
(87, 12, 'umum', 73300, 1, 'laundry tgl8 mei 2018', '2018-05-10 09:12:43', '', '0000-00-00'),
(88, 12, 'umum', 80650, 1, 'beli bantal dan sambungan/kabel perpanjangan tgl 9 mei 2018(untuk 9bj)', '2018-05-10 09:14:14', '', '0000-00-00'),
(89, 12, 'umum', 38300, 1, 'laundy tgl 10 mei 2018', '2018-05-11 08:59:35', '', '0000-00-00'),
(90, 12, 'umum', 22000, 1, 'aqua galon jardin tgl 10 mei 2018', '2018-05-11 09:00:51', '', '0000-00-00'),
(91, 12, 'unit/23', 50000, 1, 'isi token listrik tgl 10 mei 2018', '2018-05-11 09:01:46', '', '0000-00-00'),
(92, 7, 'umum', 365600, 1, 'beli amenities tgl 11 mei 2018', '2018-05-11 17:40:28', '', '0000-00-00'),
(93, 12, 'umum', 33000, 1, 'beli plastik untuk amenities 2 ukuran', '2018-05-11 17:41:23', '', '0000-00-00'),
(94, 12, 'umum', 58900, 1, 'laundry tgl 11 mei 2018', '2018-05-11 17:43:27', '', '0000-00-00'),
(95, 12, 'umum', 15000, 1, 'Beli battre A3 utk jardin dan SA 7 9 tgl 11 mei 2018', '2018-05-11 22:51:27', '', '0000-00-00'),
(96, 12, 'unit/23', 100000, 1, 'isi token listrik tgl 12 mei 2018', '2018-05-12 16:03:17', '', '0000-00-00'),
(97, 12, 'umum', 82000, 1, 'laundry tgl 12 dan 13 mei 2018', '2018-05-13 17:25:13', '', '0000-00-00'),
(98, 12, 'umum', 37300, 1, 'laundry tgl 15 mei 2018', '2018-05-15 16:16:34', '', '0000-00-00'),
(99, 12, 'umum', 1500000, 1, 'uang spj anak it ke yogya', '2018-05-18 15:00:00', '0', '0000-00-00'),
(100, 12, 'unit/19', 967948, 1, 'pembayarn listrik dan air bulan maret-april 2018', '2018-05-18 15:18:18', '0', '0000-00-00'),
(101, 12, 'unit/11', 1211062, 1, 'pembayaran listrik maret-april 2018', '2018-05-18 15:19:54', '0', '0000-00-00'),
(102, 12, 'unit/24', 479786, 1, 'pembayaran listrik dan air bulan april 2018', '2018-05-18 15:20:46', '0', '0000-00-00'),
(107, 12, 'unit/9', 1455092, 1, 'pembayaran listrik dan air bulan maret-april 2018', '2018-05-18 15:29:38', '0', '0000-00-00'),
(108, 12, 'unit/9', 300000, 1, 'internet bulan april-mei 2018', '2018-05-18 15:31:15', '0', '0000-00-00'),
(109, 12, 'unit/24', 300000, 1, 'internet bulan april-mei 2018', '2018-05-18 15:32:52', '0', '0000-00-00'),
(110, 12, 'unit/11', 300000, 1, 'internet bulan april-mei 2018', '2018-05-18 15:33:30', '0', '0000-00-00'),
(111, 12, 'umum', 100000, 1, 'isi token listrik kantor tgl 18 mei 2018', '2018-05-18 16:39:54', '0', '0000-00-00'),
(112, 12, 'umum', 15500, 1, 'beli aqua galon kantor tgl 18 mei 2018', '2018-05-18 16:40:39', '0', '0000-00-00'),
(113, 12, 'umum', 18800, 1, 'laundry tgl 18 mei 2018', '2018-05-18 16:41:06', '0', '0000-00-00'),
(114, 12, 'umum', 51700, 1, 'laundry tgl 22 mei 2018', '2018-05-24 16:11:11', '0', '0000-00-00'),
(115, 12, 'umum', 25000, 1, 'laundry tgl 26 mei 2018', '2018-05-26 09:29:27', '0', '0000-00-00'),
(116, 12, 'umum', 150000, 1, 'beli aqua galon 6pcs tgl 27 mei 2018', '2018-05-27 17:24:33', '0', '0000-00-00'),
(117, 12, 'umum', 63000, 1, 'laundry tgl 27 mei 2018', '2018-05-27 17:25:10', '0', '0000-00-00'),
(118, 12, 'umum', 88500, 1, 'Beli makan a rian tuk pa dani', '2018-05-27 17:52:33', '0', '0000-00-00'),
(119, 12, 'umum', 26000, 1, 'laundry tgl 28 mei 2018', '2018-05-31 09:26:29', '0', '0000-00-00'),
(120, 12, 'umum', 12000, 1, 'laundry tgl 29 mei 2018', '2018-05-31 09:27:10', '0', '0000-00-00'),
(122, 12, 'umum', 89500, 1, 'parkir maya tgl 27-29 mei 2018 dan keyboard', '2018-05-31 09:29:26', '0', '0000-00-00'),
(123, 12, 'umum', 140500, 1, 'beli lakban dan makan di antapani tgl 30mei 2018', '2018-05-31 13:41:42', '0', '0000-00-00'),
(124, 7, 'unit/9', 1200000, 1, 'pemasangan greas trapp', '2018-06-02 12:47:40', '0', '0000-00-00'),
(125, 7, 'unit/19', 1200000, 1, 'pemasangan greas trapp', '2018-06-02 12:48:23', '0', '0000-00-00'),
(126, 12, 'umum', 88000, 1, 'bayar makan buka puasa tgl 2 juni 2018', '2018-06-03 09:46:44', '0', '0000-00-00'),
(127, 12, 'umum', 51700, 1, 'laundry tgl 3 juni 2018', '2018-06-03 09:47:12', '0', '0000-00-00'),
(128, 12, 'umum', 170000, 1, 'bayar abodemen parkir bulan juni,maya,farhan dan bu anna', '2018-06-03 10:12:44', '0', '0000-00-00'),
(129, 12, 'unit/9', 452446, 1, 'tagihan listrik bulan mei 2018', '2018-06-05 12:42:30', '0', '2018-06-10'),
(130, 12, 'unit/9', 150000, 1, 'tagihan internet bulan mei 2018', '2018-06-05 12:43:08', '0', '2018-06-10'),
(131, 12, 'unit/11', 780622, 1, 'tagihan listrik bulan mei 2018', '2018-06-05 12:43:53', '0', '2018-06-10'),
(132, 12, 'unit/11', 150000, 1, 'tagihan internet bulan mei 2018', '2018-06-05 12:44:28', '0', '2018-06-10'),
(133, 12, 'unit/19', 515706, 1, 'tagihan listrik dan air bulan mei 2018', '2018-06-05 12:45:17', '0', '2018-06-10'),
(134, 12, 'unit/24', 206348, 1, 'tagihan listrik dan air bulan mei 2018', '2018-06-05 12:46:20', '0', '2018-06-10'),
(135, 12, 'unit/24', 150000, 1, 'tagihan internet bulan mei 2018', '2018-06-05 12:46:53', '0', '2018-06-10'),
(136, 12, 'unit/19', 275000, 1, 'bayar internet 2 bulan ', '2018-06-06 09:21:03', '0', '0000-00-00'),
(137, 12, 'umum', 38300, 1, 'laundry tgl 5 juni 2018', '2018-06-07 11:26:10', '0', '0000-00-00'),
(138, 12, 'unit/19', 105000, 1, 'beli gas tgl 31 mei 2018', '2018-06-07 11:28:32', '0', '0000-00-00'),
(139, 12, 'umum', 230000, 1, 'untuk a wildan tanggal 3 juni 2018', '2018-06-07 11:29:39', '0', '0000-00-00'),
(140, 12, 'umum', 41000, 1, 'beli lakban tgl 6 juni 2018 (untuk parcel)', '2018-06-07 11:30:41', '0', '0000-00-00'),
(141, 12, 'umum', 427900, 1, 'beli toples untuk parcel tgl 6 juni 2018', '2018-06-07 13:29:45', '0', '0000-00-00'),
(142, 12, 'umum', 175000, 1, 'beli sd card tgl 9 juni 2018', '2018-06-10 09:02:28', '0', '0000-00-00'),
(143, 12, 'umum', 45000, 1, 'beli lampu tgl 9 juni 2018(u/diantapani)', '2018-06-10 09:03:15', '0', '0000-00-00'),
(144, 12, 'umum', 1000000, 1, 'beli kursi tgl 7 juni 2018', '2018-06-10 09:05:19', '0', '0000-00-00'),
(145, 12, 'umum', 1000000, 1, 'a dani cash bon tgl 7 juni 2018', '2018-06-10 09:06:01', '0', '0000-00-00'),
(146, 12, 'umum', 1000000, 1, 'bu anna pinjem (buat nukerin uang baru )', '2018-06-10 09:08:11', '0', '0000-00-00'),
(147, 12, 'umum', 7000, 1, 'laundry tgl 9 juni 2018', '2018-06-10 09:09:11', '0', '0000-00-00'),
(148, 12, 'umum', 50000, 1, 'Beli aqua galon 2pcs tgl 10 juni 2018', '2018-06-10 16:20:11', '0', '0000-00-00'),
(149, 12, 'umum', 26000, 1, 'laundry tgl 10 juni 2018', '2018-06-10 16:38:33', '0', '0000-00-00'),
(150, 5, 'umum', 350000, 1, 'Server Cloud', '2018-06-11 11:15:04', '0', '2018-07-22'),
(151, 9, 'umum', 350000, 1, 'SSL Server Security (Comodo)', '2018-06-11 11:17:06', '0', '2018-08-01'),
(152, 12, 'umum', 100000, 1, 'bensin mobil bu anna tgl 10juni 2018', '2018-06-11 16:30:35', '0', '0000-00-00'),
(153, 12, 'umum', 18500, 1, 'Bu anna ke eyang', '2018-06-12 20:45:53', '0', '0000-00-00'),
(154, 12, 'umum', 489000, 1, 'Beli memory u laptop tgl 12 juni 2018', '2018-06-12 20:46:41', '0', '0000-00-00'),
(155, 12, 'umum', 30000, 1, 'duplikat kunci 2pcs tgl 13 juni 2018', '2018-06-13 10:43:16', '0', '0000-00-00'),
(156, 12, 'umum', 23000, 1, 'beli aqua galon jardin b0305 tgl 18 juni 2018', '2018-06-21 12:53:22', '0', '0000-00-00'),
(157, 12, 'umum', 38400, 1, 'laundry tgl 20 juni 2018', '2018-06-21 12:54:04', '0', '0000-00-00'),
(158, 12, 'umum', 79500, 1, 'beli handuk 2 pcs tgl 16 juni 2018', '2018-06-21 12:54:53', '0', '0000-00-00'),
(159, 12, 'unit/12', 204900, 1, 'beli showerset kriss dan travel adapter tgl  16 juni 2018', '2018-06-21 12:57:10', '0', '0000-00-00'),
(160, 12, 'umum', 83500, 1, 'beli shower tuk ec 621', '2018-06-21 12:57:57', '0', '0000-00-00'),
(161, 12, 'umum', 106500, 1, 'laundry tgl19 juni 2018', '2018-06-21 12:58:37', '0', '0000-00-00'),
(162, 12, 'umum', 51500, 1, 'laundry tgl  19 juni 2018', '2018-06-21 12:59:04', '0', '0000-00-00'),
(163, 12, 'umum', 95500, 1, 'laundry tgl 16 juni 2018', '2018-06-21 12:59:32', '0', '0000-00-00'),
(164, 12, 'umum', 88000, 1, 'laundry tgl 17 juni 2018', '2018-06-21 13:00:15', '0', '0000-00-00'),
(165, 12, 'unit/23', 100000, 1, 'beli token listrik tgl 17 juni 2018', '2018-06-21 13:01:23', '0', '0000-00-00'),
(166, 12, 'umum', 236800, 1, 'Makan bersama tgl 23 juni di antapani', '2018-06-24 19:43:55', '0', '0000-00-00'),
(167, 12, 'unit/23', 100000, 1, 'Token listrik tgl 23 juni 2018', '2018-06-24 19:44:46', '0', '0000-00-00'),
(168, 12, 'umum', 109000, 1, 'Laundry tgl 23 juni 2018', '2018-06-24 19:45:31', '0', '0000-00-00'),
(169, 12, 'umum', 156000, 1, 'Beli aqua 6pcs tgl 23 juni 2018', '2018-06-24 19:46:09', '0', '0000-00-00'),
(170, 12, 'umum', 23000, 1, 'Beli aqua unit b 305', '2018-06-24 19:46:46', '0', '0000-00-00'),
(171, 12, 'umum', 26800, 1, 'Laundry tgl 24 juni 2018', '2018-06-24 19:47:27', '0', '0000-00-00'),
(172, 12, 'umum', 328000, 1, 'beli bantal 6 pcs tgl 26 juni 2018', '2018-06-27 11:04:20', '0', '0000-00-00'),
(173, 12, 'unit/29', 115000, 1, 'Beli regulator gas ', '2018-06-29 06:18:26', '0', '0000-00-00'),
(174, 12, 'unit/29', 200000, 1, 'Beli gas 3 kg', '2018-06-29 06:19:09', '0', '0000-00-00'),
(175, 12, 'unit/29', 96500, 1, 'Beli tempat sampah 2 pcs', '2018-06-29 06:23:49', '0', '0000-00-00'),
(176, 12, 'umum', 30500, 1, 'Beli keset 2 psc ', '2018-06-29 06:27:23', '0', '0000-00-00'),
(177, 12, 'umum', 30500, 1, 'Beli sikat wc 3pcs', '2018-06-29 06:28:29', '0', '0000-00-00'),
(178, 12, 'umum', 25000, 1, 'Beli soklin lantai dan harpic@2pcs', '2018-06-29 06:29:19', '0', '0000-00-00'),
(179, 12, 'unit/9', 22500, 1, 'Antena tv', '2018-06-29 06:29:56', '0', '0000-00-00'),
(180, 12, 'umum', 67000, 1, 'Beli kanebo 4 pcs', '2018-06-29 06:31:07', '0', '0000-00-00'),
(181, 12, 'umum', 142500, 1, 'Beli gembok kode 3 pcs', '2018-06-29 06:32:01', '0', '0000-00-00'),
(182, 12, 'umum', 10000, 1, 'Beli  2pcs untuk psg gembok ', '2018-06-29 06:33:14', '0', '0000-00-00'),
(183, 12, 'umum', 75000, 1, 'Beli aqua galon tgl 14 juni 2018 3pcs', '2018-06-29 06:34:04', '0', '0000-00-00'),
(184, 12, 'umum', 75000, 1, 'Beli aqua galon tgl 23juni 2018 3 pcs', '2018-06-29 06:35:29', '0', '0000-00-00'),
(185, 12, 'umum', 25000, 1, 'Beli lap piring 2 pcs', '2018-06-29 06:36:09', '0', '0000-00-00'),
(186, 12, 'umum', 35000, 1, 'Grab 2x', '2018-06-29 06:36:45', '0', '0000-00-00'),
(187, 12, 'umum', 50000, 1, 'Beli bakso untuk tester bu anna', '2018-06-29 06:37:30', '0', '0000-00-00'),
(188, 12, 'unit/29', 75000, 1, 'beli remote AC ', '2018-06-29 09:21:18', '0', '0000-00-00'),
(189, 12, 'unit/29', 50000, 1, 'beli antena tv', '2018-06-29 09:21:50', '0', '0000-00-00'),
(190, 12, 'unit/29', 12000, 1, 'beli batt untuk remote ac', '2018-06-29 09:22:26', '0', '0000-00-00'),
(191, 12, 'unit/29', 50000, 1, 'beli aqua galon', '2018-06-29 09:37:05', '0', '0000-00-00'),
(192, 12, 'umum', 45000, 1, 'Laundry+bed cover tgl 30 juni 2018', '2018-06-30 21:26:11', '0', '0000-00-00'),
(193, 12, 'unit/9', 105000, 1, 'beli gas 12kg tgl 02 juli 2018', '2018-07-02 16:52:19', '0', '0000-00-00'),
(194, 12, 'umum', 60000, 1, 'laundry tgl 02 juli 2018', '2018-07-02 16:52:43', '0', '0000-00-00'),
(195, 12, 'umum', 41900, 1, 'beli amenities 3pcs tgl 02 juli 2018', '2018-07-02 16:53:47', '0', '0000-00-00'),
(196, 12, 'unit/20', 26000, 1, 'beli gas 3kg tgl 02 juli 2018', '2018-07-02 16:55:40', '0', '0000-00-00'),
(197, 12, 'umum', 23000, 1, 'Beli aqua galon jardin 133 tgl 30 juni 2018', '2018-07-02 16:57:47', '0', '0000-00-00'),
(198, 12, 'umum', 20900, 1, 'Beli pengharum ruangan ', '2018-07-03 17:32:19', '0', '0000-00-00'),
(199, 12, 'umum', 470000, 1, 'beli seprai tgl 5 juli 2018', '2018-07-05 18:30:12', '0', '0000-00-00'),
(200, 12, 'umum', 125000, 1, 'beli aqua galon  5 pcs tgl 5 juli 2018', '2018-07-05 18:31:20', '0', '0000-00-00'),
(201, 12, 'umum', 75500, 1, 'laundry tgl 5 juli 2018', '2018-07-06 13:21:14', '0', '0000-00-00'),
(202, 12, 'unit/23', 100000, 1, 'token listrik tgl 4 juli 2018', '2018-07-06 13:21:47', '0', '0000-00-00'),
(203, 5, 'umum', 246400, 1, 'amenities ', '2018-07-06 13:22:52', '0', '0000-00-00'),
(204, 12, 'unit/19', 424546, 1, 'taguhan listrik dan air bulan juni 2018(tagih bln juli)', '2018-07-07 11:05:57', '0', '2018-07-20'),
(206, 12, 'unit/24', 414546, 1, 'tagihan listrik dan air bulan juni (tagih bulan jul 2018)', '2018-07-07 11:10:19', '0', '2018-07-20'),
(208, 12, 'unit/24', 150000, 1, 'tagihan internet bulan juni 2108', '2018-07-07 11:10:55', '0', '2018-07-20'),
(211, 12, 'unit/11', 881742, 1, 'Tagihan Listrik bulan Juli (pemakaian Juni)', '2018-07-07 11:16:51', '0', '2018-07-20'),
(212, 12, 'unit/9', 518806, 1, 'tagihan listrik dan air bulan juni (tagih bulan jul 2018)', '2018-07-07 11:29:47', '0', '2018-07-20'),
(213, 12, 'unit/9', 150000, 1, 'tagihan internet bulan juni 2018', '2018-07-07 11:30:30', '0', '2018-07-20'),
(214, 12, 'unit/23', 1188000, 1, 'service charge dan sinking fund bln april-juni 2018', '2018-07-08 10:22:50', '0', '0000-00-00'),
(215, 12, 'unit/23', 248200, 1, 'tagihan air bulan mei dan juni 2018', '2018-07-08 10:24:22', '0', '0000-00-00'),
(216, 12, 'umum', 50000, 1, 'bu anna pinjam', '2018-07-08 10:24:40', '0', '0000-00-00'),
(217, 12, 'umum', 27500, 1, 'laundry tgl 6 juni 2018', '2018-07-08 10:25:37', '0', '0000-00-00'),
(218, 7, 'unit/29', 100000, 1, 'Beli token listrik tanggal 8 Juni', '2018-07-08 16:51:35', '0', '2018-07-08'),
(219, 12, 'umum', 87000, 1, 'Laundry tgl 8 juli 2018', '2018-07-08 22:18:38', '0', '0000-00-00'),
(220, 12, 'unit/29', 100000, 1, 'Beli token listrik tgl 8 juli 2018', '2018-07-08 22:26:32', '0', '0000-00-00'),
(221, 12, 'umum', 60000, 1, 'Untuk makan it 2 org tgl 10 juli 2018', '2018-07-10 18:12:19', '0', '0000-00-00'),
(222, 12, 'umum', 30000, 1, 'Grab pp k newton tgl 10 juli 2018', '2018-07-10 18:12:52', '0', '0000-00-00'),
(223, 12, 'umum', 100000, 1, 'Beli aqua 4 pcs tgl 9 juli 2018', '2018-07-11 15:39:33', '0', '0000-00-00'),
(224, 12, 'umum', 27500, 1, 'Laundry tgl 9 juli 2018', '2018-07-11 15:40:10', '0', '0000-00-00'),
(225, 12, 'unit/23', 180000, 1, 'beli gas 12kg tgl 13 juli 2018', '2018-07-13 18:32:06', '0', '0000-00-00'),
(226, 12, 'umum', 161000, 1, 'laundry tgl 13 juli 2018', '2018-07-13 18:33:47', '0', '0000-00-00'),
(228, 12, 'umum', 35000, 1, 'Laundry +bed cover tgl 14juli 2018', '2018-07-14 19:08:53', '0', '0000-00-00'),
(229, 12, 'umum', 55000, 1, 'laundry tgl 19 juli 2018', '2018-07-20 11:48:41', '0', '0000-00-00'),
(230, 12, 'umum', 64000, 1, 'laundry tgl 15juli', '2018-07-20 11:49:18', '0', '0000-00-00'),
(231, 12, 'umum', 1350000, 1, 'Sepatu satpam newton 10pcs', '2018-07-25 18:35:06', '0', '0000-00-00'),
(232, 12, 'umum', 50000, 1, 'Beli aqua galon tgl 18juli 2018', '2018-07-25 18:35:41', '0', '0000-00-00'),
(233, 12, 'umum', 23000, 1, 'Galon jardin 133 tgl 19 juli 2018', '2018-07-25 18:36:23', '0', '0000-00-00'),
(234, 12, 'umum', 302000, 1, 'Beli bakso,pulsa dan arisan bu anna tgl 22 juli 2018', '2018-07-25 18:37:09', '0', '0000-00-00'),
(235, 12, 'unit/23', 100000, 1, 'Beli token listrik tgl 21 juli 2018', '2018-07-25 18:37:53', '0', '0000-00-00'),
(236, 12, 'umum', 50000, 1, 'Ngasih ke pa ade jardin', '2018-07-25 18:38:30', '0', '0000-00-00'),
(237, 12, 'umum', 79000, 1, 'Laundry tgl 21 juli 2018', '2018-07-25 18:40:21', '0', '0000-00-00'),
(238, 12, 'umum', 100000, 1, 'Beli aqua galon 4pcs tgl 21 juli 2018', '2018-07-25 18:40:55', '0', '0000-00-00'),
(239, 12, 'umum', 39000, 1, 'Laundry tgl 20 juli 2018', '2018-07-25 18:41:29', '0', '0000-00-00'),
(240, 12, 'umum', 25000, 1, 'Beli aqua galon tgl 20 juli 2018', '2018-07-25 18:41:59', '0', '0000-00-00'),
(241, 12, 'umum', 25000, 1, 'Laundry tgl 22 juli 2018', '2018-07-25 18:42:30', '0', '0000-00-00'),
(242, 12, 'umum', 175000, 1, 'Beli aqua galon 2 pcs dan minuman,makanan jg selotip plus bungkus kado u/diantapani', '2018-07-25 18:43:35', '0', '0000-00-00'),
(243, 12, 'umum', 470000, 1, 'Beli makan dan kasih buat ridwan(ibenk)', '2018-07-25 18:44:54', '0', '0000-00-00'),
(244, 12, 'umum', 200000, 1, 'Buat bensin maya', '2018-07-25 18:45:19', '0', '0000-00-00'),
(245, 12, 'umum', 20000, 1, 'Buat tip yg anter kulkas ', '2018-07-25 18:45:57', '0', '0000-00-00'),
(246, 12, 'unit/11', 94500, 1, 'Beli bidet shower', '2018-07-25 18:47:42', '0', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_unit`
--

CREATE TABLE IF NOT EXISTS `tb_unit` (
  `kd_unit` int(4) NOT NULL AUTO_INCREMENT,
  `kd_apt` int(4) NOT NULL,
  `kd_owner` int(4) DEFAULT NULL,
  `no_unit` varchar(15) NOT NULL,
  `h_sewa_wd` int(10) NOT NULL,
  `h_sewa_we` int(10) NOT NULL,
  `h_sewa_mg` int(11) NOT NULL,
  `h_sewa_bln` int(11) NOT NULL,
  `h_owner_wd` int(10) NOT NULL,
  `h_owner_we` int(10) NOT NULL,
  `h_owner_mg` int(11) NOT NULL,
  `h_owner_bln` int(11) NOT NULL,
  `ekstra_charge` int(10) NOT NULL,
  `tgl_task` date DEFAULT NULL,
  `ready` char(1) DEFAULT NULL,
  `tgl_lihat` date DEFAULT NULL,
  `url_cozzal` varchar(50) DEFAULT NULL,
  `url_bnb` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`kd_unit`),
  KEY `kd_apt` (`kd_apt`),
  KEY `kd_owner` (`kd_owner`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data untuk tabel `tb_unit`
--

INSERT INTO `tb_unit` (`kd_unit`, `kd_apt`, `kd_owner`, `no_unit`, `h_sewa_wd`, `h_sewa_we`, `h_sewa_mg`, `h_sewa_bln`, `h_owner_wd`, `h_owner_we`, `h_owner_mg`, `h_owner_bln`, `ekstra_charge`, `tgl_task`, `ready`, `tgl_lihat`, `url_cozzal`, `url_bnb`) VALUES
(9, 1, 4, '9BJ', 350000, 350000, 1500000, 4500000, 275000, 275000, 1500000, 3500000, 25000, '2018-05-06', 'Y', '2018-07-26', 'transaksi.cozzal.com/ics/listing/9.ics', 'https://www.airbnb.com/calendar/ical/16171524.ics?s=2225fb77ce2852dd0a022b2cc18f7ab5'),
(11, 1, 6, '12BD', 400000, 400000, 2000000, 5000000, 250000, 300000, 1500000, 4000000, 25000, '2018-05-06', 'Y', '2018-07-24', 'transaksi.cozzal.com/ics/listing/11.ics', 'https://www.airbnb.com/calendar/ical/24702768.ics?s=35b8b24509f65d126d4685d69c726680'),
(12, 1, 9, '16BE', 400000, 400000, 2500000, 5500000, 275000, 325000, 2000000, 4000000, 25000, '2018-05-06', 'Y', '2018-07-22', 'transaksi.cozzal.com/ics/listing/12.ics', 'https://www.airbnb.com/calendar/ical/18692173.ics?s=6852877d0416d184d910fb30c18b3112'),
(19, 1, 3, '18BF', 350000, 400000, 2000000, 500000, 275000, 300000, 1500000, 5000000, 25000, '2018-05-06', 'Y', '2018-07-24', 'transaksi.cozzal.com/ics/listing/19.ics', 'https://www.airbnb.com/calendar/ical/15965145.ics?s=cc3fc0be5faa5a91854bbfc188a25887'),
(20, 7, 5, 'SA 07 09', 350000, 350000, 2450000, 10500000, 270000, 270000, 1890000, 0, 25000, '2018-05-01', 'Y', '2018-07-23', 'transaksi.cozzal.com/ics/listing/20.ics', 'https://www.airbnb.com/calendar/ical/16739376.ics?s=f9d7abb99b71cf59aa142da8b50cd31e'),
(22, 7, 7, 'EC 6 21', 400000, 400000, 2800000, 12000000, 300000, 300000, 2100000, 0, 25000, '2018-04-29', 'Y', '2018-07-18', 'transaksi.cozzal.com/ics/listing/22.ics', 'https://www.airbnb.com/calendar/ical/20430049.ics?s=07e0f55e91fd1e3265688567abb78b13'),
(23, 6, 3, 'A133', 375000, 400000, 2000000, 5000000, 275000, 300000, 1500000, 5000000, 25000, '2018-05-09', 'Y', '2018-07-24', 'transaksi.cozzal.com/ics/listing/23.ics', 'https://www.airbnb.com/calendar/ical/16796363.ics?s=ccd666a8fc8daeae9d25e41d72160383'),
(24, 1, 10, '8BG', 350000, 400000, 1500000, 4500000, 300000, 300000, 1500000, 3500000, 25000, '2018-04-15', 'Y', '2018-07-15', 'transaksi.cozzal.com/ics/listing/24.ics', 'https://www.airbnb.com/calendar/ical/21636481.ics?s=f19e16e971ba35ca9ee4c302bf1ff73c'),
(25, 1, 11, '32BF', 400000, 450000, 0, 0, 300000, 300000, 0, 0, 25000, '2018-03-25', 'Y', '2018-04-08', 'transaksi.cozzal.com/ics/listing/25.ics', 'https://www.airbnb.com/calendar/ical/20971733.ics?s=346167373444c7922c50fa70ebe1f8d4'),
(26, 7, 8, 'SA-6-5', 350000, 300000, 0, 0, 270000, 300000, 0, 0, 25000, '2018-02-04', '', '0000-00-00', 'transaksi.cozzal.com/ics/listing/26.ics', 'https://www.airbnb.com/calendar/ical/22403546.ics?s=a0a43932d1e76b2fdcfd2beb10513d79'),
(29, 6, 7, 'B305', 350000, 400000, 2500000, 5000000, 300000, 300000, 2100000, 4000000, 25000, NULL, 'Y', '2018-07-18', 'transaksi.cozzal.com/ics/listing/29.ics', 'https://www.airbnb.com/calendar/ical/25992751.ics?s=6a05f88985a6c31ef0d497a1cc7b330a'),
(30, 1, 14, '28BD', 400000, 425000, 2700000, 6000000, 275000, 325000, 2000000, 4500000, 25000, NULL, 'Y', '2018-07-26', NULL, NULL),
(31, 6, 9, 'A123', 250000, 300000, 0, 0, 200000, 250000, 0, 0, 25000, NULL, NULL, NULL, NULL, NULL),
(32, 1, 15, '7BG', 350000, 375000, 0, 0, 300000, 300000, 0, 0, 25000, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_unit_kotor`
--

CREATE TABLE IF NOT EXISTS `tb_unit_kotor` (
  `kd_unit` int(4) DEFAULT NULL,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL,
  `jam_check_out` time DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  KEY `kd_unit` (`kd_unit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_unit_kotor`
--

INSERT INTO `tb_unit_kotor` (`kd_unit`, `check_in`, `check_out`, `jam_check_out`, `status`) VALUES
(11, '2018-08-17', '2018-08-19', NULL, NULL),
(19, '2018-09-07', '2018-09-08', NULL, NULL),
(19, '2018-09-07', '2018-09-08', NULL, NULL),
(19, '2018-09-07', '2018-09-08', NULL, NULL),
(19, '2018-09-07', '2018-09-08', NULL, NULL),
(12, '2018-06-25', '2018-06-27', NULL, 'D'),
(23, '2018-06-27', '2018-06-28', NULL, 'D'),
(23, '2018-06-29', '2018-06-30', NULL, 'D'),
(23, '2018-06-30', '2018-07-01', '09:00:00', 'D'),
(19, '2018-06-30', '2018-07-01', '10:00:00', 'D'),
(12, '2018-06-30', '2018-07-01', NULL, 'D'),
(20, '2018-06-29', '2018-06-30', NULL, 'D'),
(9, '2018-06-30', '2018-07-01', NULL, 'D'),
(19, '2019-01-19', '2019-01-20', NULL, NULL),
(19, '2019-01-19', '2019-01-20', NULL, NULL),
(19, '2019-01-19', '2019-01-20', NULL, NULL),
(19, '2019-01-19', '2019-01-20', NULL, NULL),
(19, '2019-01-26', '2019-01-27', NULL, NULL),
(19, '2019-01-26', '2019-01-27', NULL, NULL),
(19, '2019-01-26', '2019-01-27', NULL, NULL),
(19, '2018-11-09', '2018-11-10', NULL, NULL),
(19, '2018-11-09', '2018-11-10', NULL, NULL),
(23, '2018-07-06', '2018-07-08', NULL, 'D'),
(12, '2018-07-03', '2018-07-08', NULL, 'D'),
(19, '2018-07-07', '2018-07-09', NULL, 'D'),
(11, '2018-06-24', '2018-06-27', NULL, 'D'),
(29, '2018-06-29', '2018-07-01', NULL, 'D'),
(11, '2018-06-30', '2018-07-01', NULL, 'D'),
(22, '2018-06-30', '2018-07-01', NULL, 'D'),
(11, '2018-07-01', '2018-07-03', NULL, 'D'),
(20, '2018-06-30', '2018-07-01', NULL, 'D'),
(20, '2018-07-04', '2018-07-06', NULL, 'D'),
(9, '2018-07-14', '2018-07-15', '09:00:00', 'D'),
(23, '2018-07-04', '2018-07-05', '08:00:00', 'D'),
(29, '2018-07-04', '2018-07-05', '11:14:00', 'D'),
(22, '2018-07-01', '2018-07-08', NULL, 'D'),
(19, '2018-07-01', '2018-07-05', NULL, 'D'),
(24, '2018-06-29', '2018-07-06', NULL, 'D'),
(23, '2018-07-01', '2018-07-04', NULL, 'D'),
(24, '2018-07-07', '2018-07-08', NULL, 'D'),
(11, '2018-07-04', '2018-07-05', NULL, 'D'),
(19, '2018-07-09', '2018-07-13', NULL, 'D'),
(19, '2018-07-05', '2018-07-07', NULL, 'D'),
(23, '2018-07-05', '2018-07-06', '11:00:00', 'D'),
(29, '2018-07-07', '2018-07-08', NULL, 'D'),
(9, '2018-07-04', '2018-07-05', NULL, 'D'),
(9, '2018-07-06', '2018-07-07', NULL, 'D'),
(11, '2018-07-06', '2018-07-08', NULL, 'D'),
(9, '2018-07-07', '2018-07-09', NULL, 'D'),
(29, '2018-07-08', '2018-07-09', NULL, 'D'),
(12, '2018-07-11', '2018-07-13', NULL, 'D'),
(12, '2018-07-09', '2018-07-11', NULL, 'D'),
(11, '2018-07-09', '2018-07-10', NULL, 'D'),
(19, '2018-08-13', '2018-08-15', NULL, NULL),
(11, '2018-07-11', '2018-07-12', NULL, 'D'),
(23, '2018-07-21', '2018-07-23', NULL, 'D'),
(23, '2018-07-14', '2018-07-15', '10:00:00', 'D'),
(9, '2018-08-14', '2018-08-16', NULL, NULL),
(12, '2018-08-13', '2018-08-16', NULL, NULL),
(24, '2018-07-11', '2018-07-12', NULL, 'D'),
(23, '2018-07-11', '2018-07-13', NULL, 'D'),
(11, '2018-07-21', '2018-07-24', '09:30:00', 'D'),
(12, '2018-07-13', '2018-07-14', NULL, 'D'),
(11, '2018-07-13', '2018-07-18', NULL, 'D'),
(19, '2018-07-14', '2018-07-16', NULL, 'D'),
(24, '2018-07-13', '2018-07-15', NULL, 'D'),
(22, '2018-07-13', '2018-07-17', NULL, 'D'),
(29, '2018-07-14', '2018-07-15', NULL, 'D'),
(19, '2018-07-13', '2018-07-14', '10:42:00', 'D'),
(12, '2018-07-14', '2018-07-15', '07:30:00', 'D'),
(19, '2019-04-12', '2019-04-13', NULL, NULL),
(19, '2019-05-17', '2019-05-18', NULL, NULL),
(19, '2019-05-17', '2019-05-18', NULL, NULL),
(19, '2019-05-17', '2019-05-18', NULL, NULL),
(19, '2019-05-17', '2019-05-18', NULL, NULL),
(19, '2020-03-07', '2020-03-08', NULL, NULL),
(19, '2020-03-07', '2020-03-08', NULL, NULL),
(19, '2019-02-15', '2019-02-16', NULL, NULL),
(19, '2019-02-15', '2019-02-16', NULL, NULL),
(19, '2019-02-15', '2019-02-16', NULL, NULL),
(19, '2018-10-19', '2018-10-20', NULL, NULL),
(19, '2018-10-19', '2018-10-20', NULL, NULL),
(19, '2018-10-19', '2018-10-20', NULL, NULL),
(19, '2018-10-19', '2018-10-20', NULL, NULL),
(19, '2018-10-19', '2018-10-20', NULL, NULL),
(19, '2018-10-19', '2018-10-20', NULL, NULL),
(19, '2018-10-19', '2018-10-20', NULL, NULL),
(19, '2018-10-19', '2018-10-20', NULL, NULL),
(9, '2018-07-19', '2018-07-20', NULL, 'D'),
(23, '2018-07-30', '2018-07-31', NULL, NULL),
(23, '2019-03-22', '2019-03-23', NULL, NULL),
(23, '2019-03-22', '2019-03-23', NULL, NULL),
(23, '2019-03-22', '2019-03-23', NULL, NULL),
(23, '2019-03-22', '2019-03-23', NULL, NULL),
(23, '2019-03-22', '2019-03-23', NULL, NULL),
(23, '2019-03-22', '2019-03-23', NULL, NULL),
(23, '2019-03-22', '2019-03-23', NULL, NULL),
(23, '2019-03-22', '2019-03-23', NULL, NULL),
(23, '2019-03-22', '2019-03-23', NULL, NULL),
(23, '2019-03-22', '2019-03-23', NULL, NULL),
(23, '2019-03-22', '2019-03-23', NULL, NULL),
(23, '2019-03-22', '2019-03-23', NULL, NULL),
(9, '2020-04-23', '2020-04-24', NULL, NULL),
(9, '2019-10-25', '2019-10-26', NULL, NULL),
(23, '2018-08-10', '2018-08-12', NULL, NULL),
(9, '2018-07-21', '2018-07-22', '08:00:00', 'D'),
(12, '2018-07-17', '2018-07-19', NULL, 'D'),
(19, '2018-07-27', '2018-07-29', NULL, NULL),
(24, '2018-07-17', '2018-08-16', NULL, NULL),
(19, '2018-07-17', '2018-07-21', NULL, 'D'),
(9, '2018-07-27', '2018-07-28', '09:30:00', NULL),
(12, '2018-07-19', '2018-07-20', NULL, 'D'),
(9, '2018-07-18', '2018-07-19', NULL, 'D'),
(11, '2018-08-13', '2018-08-15', NULL, NULL),
(23, '2018-07-18', '2018-07-19', NULL, 'D'),
(20, '2018-07-21', '2018-07-22', NULL, 'D'),
(11, '2018-07-19', '2018-07-21', NULL, 'D'),
(12, '2018-07-29', '2018-08-04', NULL, NULL),
(9, '2018-07-20', '2018-07-21', NULL, 'D'),
(19, '2018-07-21', '2018-07-22', '10:15:00', 'D'),
(19, '2018-08-02', '2018-08-05', NULL, NULL),
(30, '2018-07-19', '2018-07-21', NULL, 'D'),
(12, '2018-07-20', '2018-07-22', '09:00:00', 'D'),
(30, '2018-07-21', '2018-07-22', '12:46:00', 'D'),
(9, '2018-07-28', '2018-08-07', NULL, NULL),
(11, '2018-07-27', '2018-07-30', NULL, NULL),
(19, '2018-07-22', '2018-07-24', NULL, 'D'),
(30, '2018-07-23', '2018-07-25', NULL, 'D'),
(30, '2018-07-23', '2018-07-25', NULL, 'D'),
(9, '2018-07-23', '2018-07-24', '08:15:00', 'D'),
(19, '2018-08-10', '2018-08-12', NULL, NULL),
(19, '2018-07-25', '2018-07-27', NULL, 'D'),
(9, '2018-07-24', '2018-07-26', '10:00:00', 'D'),
(30, '2018-07-26', '2018-07-31', NULL, NULL),
(23, '2018-07-28', '2018-07-29', NULL, NULL),
(23, '2018-09-01', '2018-09-02', NULL, NULL),
(12, '2018-07-25', '2018-07-29', NULL, NULL),
(20, '2018-07-28', '2018-07-29', NULL, NULL),
(11, '2018-08-04', '2018-08-06', NULL, NULL),
(23, '2018-07-27', '2018-07-28', NULL, NULL),
(23, '2018-07-29', '2018-07-30', NULL, NULL),
(11, '2018-08-02', '2018-08-03', NULL, NULL),
(22, '2018-07-27', '2018-07-28', NULL, NULL),
(23, '2018-08-27', '2018-08-30', NULL, NULL),
(29, '2018-08-25', '2018-08-27', NULL, NULL),
(31, '2018-08-27', '2018-08-28', NULL, NULL),
(11, '2018-08-28', '2018-08-29', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_unit_partner`
--

CREATE TABLE IF NOT EXISTS `tb_unit_partner` (
  `username` varchar(30) NOT NULL,
  `kd_unit` int(4) NOT NULL,
  KEY `username` (`username`),
  KEY `kd_unit` (`kd_unit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_unit_partner`
--

INSERT INTO `tb_unit_partner` (`username`, `kd_unit`) VALUES
('partner', 19),
('hans', 31),
('riki', 30);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_url_unit`
--

CREATE TABLE IF NOT EXISTS `tb_url_unit` (
  `kd_url` int(4) NOT NULL AUTO_INCREMENT,
  `kd_unit` int(4) DEFAULT NULL,
  `title` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jenis` char(1) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '0 : URL Sistem; 1 : URL Non Sistem',
  `url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_update` int(1) DEFAULT NULL,
  PRIMARY KEY (`kd_url`),
  KEY `kd_unit` (`kd_unit`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=60 ;

--
-- Dumping data untuk tabel `tb_url_unit`
--

INSERT INTO `tb_url_unit` (`kd_url`, `kd_unit`, `title`, `jenis`, `url`, `group_update`) VALUES
(1, 9, 'Cozzal Sys', '0', 'transaksi.cozzal.com/ics/shared_ics.php?request=9', 0),
(2, 11, 'Cozzal Sys', '0', 'transaksi.cozzal.com/ics/shared_ics.php?request=11', 0),
(3, 12, 'Cozzal Sys', '0', 'transaksi.cozzal.com/ics/shared_ics.php?request=12', 0),
(4, 19, 'Cozzal Sys', '0', 'transaksi.cozzal.com/ics/shared_ics.php?request=19', 0),
(5, 24, 'Cozzal Sys', '0', 'transaksi.cozzal.com/ics/shared_ics.php?request=24', 0),
(6, 25, 'Cozzal Sys', '0', 'transaksi.cozzal.com/ics/shared_ics.php?request=25', 0),
(7, 23, 'Cozzal Sys', '0', 'transaksi.cozzal.com/ics/shared_ics.php?request=23', 0),
(8, 29, 'Cozzal Sys', '0', 'transaksi.cozzal.com/ics/shared_ics.php?request=29', 0),
(9, 20, 'Cozzal Sys', '0', 'transaksi.cozzal.com/ics/shared_ics.php?request=20', 0),
(10, 22, 'Cozzal Sys', '0', 'transaksi.cozzal.com/ics/shared_ics.php?request=22', 0),
(11, 26, 'Cozzal Sys', '0', 'transaksi.cozzal.com/ics/shared_ics.php?request=26', 0),
(12, 9, 'Air Bnb', '1', 'https://www.airbnb.com/calendar/ical/16171524.ics?s=2225fb77ce2852dd0a022b2cc18f7ab5', 3),
(13, 11, 'Air Bnb', '1', 'https://www.airbnb.com/calendar/ical/24702768.ics?s=35b8b24509f65d126d4685d69c726680', 1),
(14, 12, 'Air Bnb', '1', 'https://www.airbnb.com/calendar/ical/18692173.ics?s=6852877d0416d184d910fb30c18b3112', 2),
(15, 19, 'Air Bnb', '1', 'https://www.airbnb.com/calendar/ical/15965145.ics?s=cc3fc0be5faa5a91854bbfc188a25887', 3),
(16, 20, 'Air Bnb', '1', 'https://www.airbnb.com/calendar/ical/16739376.ics?s=f9d7abb99b71cf59aa142da8b50cd31e', 1),
(17, 22, 'Air Bnb', '1', 'https://www.airbnb.com/calendar/ical/20430049.ics?s=07e0f55e91fd1e3265688567abb78b13', 2),
(18, 23, 'Air Bnb', '1', 'https://www.airbnb.com/calendar/ical/16796363.ics?s=ccd666a8fc8daeae9d25e41d72160383', 2),
(19, 24, 'Air Bnb', '1', 'https://www.airbnb.com/calendar/ical/21636481.ics?s=f19e16e971ba35ca9ee4c302bf1ff73c', 2),
(20, 25, 'Air Bnb', '1', 'https://www.airbnb.com/calendar/ical/20971733.ics?s=346167373444c7922c50fa70ebe1f8d4', 2),
(21, 26, 'Air Bnb', '1', 'https://www.airbnb.com/calendar/ical/22403546.ics?s=a0a43932d1e76b2fdcfd2beb10513d79', 1),
(22, 29, 'Air Bnb', '1', 'https://www.airbnb.com/calendar/ical/25992751.ics?s=6a05f88985a6c31ef0d497a1cc7b330a', 1),
(23, 9, 'Airbnb 2', '1', 'https://www.airbnb.com/calendar/ical/25016255.ics?s=aed7c2e2b2754fd17e9cbfa041f4290e', 3),
(25, 23, 'airbnb2', '1', 'https://www.airbnb.com/calendar/ical/25061952.ics?s=f00bcbd8f6597adee4dda5dca', 1),
(26, 12, 'Airbnb 2', '1', 'https://www.airbnb.com/calendar/ical/25062991.ics?s=f419b644b3d20f4a3b9c8f433dc01437', 2),
(30, 24, 'Airbnb 2', '1', 'https://www.airbnb.com/calendar/ical/25058199.ics?s=2839f77b6ed1b7ee65c10de1db4a0606', 1),
(54, 20, 'Airbnb 2', '1', 'https://www.airbnb.com/calendar/ical/26508933.ics?s=4830c0e9a2a4ab5cfb184ce85f8ed7c2', 1),
(49, 22, 'Airbnb 2', '1', 'https://www.airbnb.com/calendar/ical/25062991.ics?s=f419b644b3d20f4a3b9c8f433dc01437', 3),
(35, 19, 'Airbnb 2', '1', 'https://www.airbnb.com/calendar/ical/25057921.ics?s=6e733c506e5e302955383a7ad17822e5', 1),
(42, 29, 'airbnb2', '1', 'https://www.airbnb.com/calendar/ical/25992751.ics?s=6a05f88985a6c31ef0d497a1cc7b330a', 2),
(53, 11, 'Airbnb 2', '1', 'https://www.airbnb.com/calendar/ical/20139723.ics?s=d67f1289597423512a3d031dd820cbc7', 1),
(56, 11, 'Airbnb 3', '1', 'https://www.airbnb.com/calendar/ical/25058463.ics?s=718ac8649efb351e0e4ab975e8470b12', 3),
(55, 12, 'Airbnb 3', '1', 'https://www.airbnb.com/calendar/ical/26509208.ics?s=9f056c1359ae97a5c6ca24fdc05d4215', 3),
(57, 22, 'Airbnb 3', '1', 'https://www.airbnb.com/calendar/ical/26509571.ics?s=550b956fcb810ab35c7f37283f36bd36', 3),
(58, 30, 'Cozzal Sys', '0', 'transaksi.cozzal.com/ics/shared_ics.php?request=30', 0),
(59, 30, 'Airbnb', '1', 'https://www.airbnb.com/calendar/ical/27030385.ics?s=5940c6b8d91dc0d14550608ce446146e', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `hak_akses` varchar(20) NOT NULL,
  `status` char(1) NOT NULL COMMENT '1 = aktif dan terelasi 2 = non akif  3 = Tidak terelasi; Owner:nonaktif; !Owner:Aktif',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`username`, `password`, `hak_akses`, `status`) VALUES
('admin1', 'admin123', 'superadmin', '3'),
('admin2', 'cozzal123', 'admin', '3'),
('anna', 'cozzal@bandung', 'manager', '3'),
('cleaner', 'cleaner', 'cleaner', '3'),
('Erma', 'erma123', 'owner', '1'),
('erwin', 'erwin123', 'owner', '1'),
('frans', 'frans123', 'owner', '1'),
('hans', 'hans098', 'partner', '3'),
('lily', 'lily123', 'owner', '1'),
('lina', 'cozzal@bandung', 'admin', '3'),
('manager', 'manager1', 'manager', '3'),
('maya', 'cozzal@bandung', 'admin', '3'),
('mia', 'mia123', 'owner', '1'),
('nani', 'nani123', 'owner', '1'),
('netty', 'netty123', 'owner', '1'),
('nova', 'nova098', 'owner', '1'),
('nurul', 'nurul123', 'owner', '1'),
('owner', 'owner', 'owner', '1'),
('partner', 'partner123', 'partner', '3'),
('riki', 'riki098', 'partner', '3'),
('samun', 'samun123', 'owner', '1'),
('susan', 'susan123', 'owner', '1'),
('yusuf', 'ys231108', 'superadmin', '3');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_blacklist`
--
ALTER TABLE `tb_blacklist`
  ADD CONSTRAINT `tb_blacklist_ibfk_1` FOREIGN KEY (`kd_penyewa`) REFERENCES `tb_penyewa` (`kd_penyewa`);

--
-- Ketidakleluasaan untuk tabel `tb_booked`
--
ALTER TABLE `tb_booked`
  ADD CONSTRAINT `tb_booked_ibfk_1` FOREIGN KEY (`kd_unit`) REFERENCES `tb_unit` (`kd_unit`),
  ADD CONSTRAINT `tb_booked_ibfk_2` FOREIGN KEY (`kd_apt`) REFERENCES `tb_apt` (`kd_apt`);

--
-- Ketidakleluasaan untuk tabel `tb_catatan`
--
ALTER TABLE `tb_catatan`
  ADD CONSTRAINT `tb_catatan_ibfk_1` FOREIGN KEY (`kd_unit`) REFERENCES `tb_unit` (`kd_unit`);

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
-- Ketidakleluasaan untuk tabel `tb_mod_harga`
--
ALTER TABLE `tb_mod_harga`
  ADD CONSTRAINT `tb_mod_harga_ibfk_1` FOREIGN KEY (`kd_unit`) REFERENCES `tb_unit` (`kd_unit`);

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
-- Ketidakleluasaan untuk tabel `tb_owner_payment`
--
ALTER TABLE `tb_owner_payment`
  ADD CONSTRAINT `tb_owner_payment_ibfk_1` FOREIGN KEY (`kd_owner`) REFERENCES `tb_owner` (`kd_owner`);

--
-- Ketidakleluasaan untuk tabel `tb_penawaran_owner`
--
ALTER TABLE `tb_penawaran_owner`
  ADD CONSTRAINT `tb_penawaran_owner_ibfk_1` FOREIGN KEY (`kd_owner`) REFERENCES `tb_owner` (`kd_owner`),
  ADD CONSTRAINT `tb_penawaran_owner_ibfk_2` FOREIGN KEY (`kd_unit`) REFERENCES `tb_unit` (`kd_unit`);

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
-- Ketidakleluasaan untuk tabel `tb_transaksi_umum`
--
ALTER TABLE `tb_transaksi_umum`
  ADD CONSTRAINT `tb_transaksi_umum_ibfk_1` FOREIGN KEY (`kd_kas`) REFERENCES `tb_kas` (`kd_kas`);

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
