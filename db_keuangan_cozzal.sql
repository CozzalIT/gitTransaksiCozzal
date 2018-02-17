-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 17 Feb 2018 pada 05.29
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
-- Struktur dari tabel `tb_apt`
--

CREATE TABLE `tb_apt` (
  `kd_apt` int(4) NOT NULL,
  `nama_apt` varchar(30) NOT NULL,
  `alamat_apt` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_apt`
--

INSERT INTO `tb_apt` (`kd_apt`, `nama_apt`, `alamat_apt`) VALUES
(0, 'Semua Apartemen', '-'),
(1, 'Newton', 'Buah Jambu'),
(2, 'Jardin', 'Cihampelas'),
(4, 'Metro The Suite', 'Margahayu Raya'),
(6, 'MeiJuni', 'Jakarta'),
(7, 'Gateway', 'Cicadas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bank`
--

CREATE TABLE `tb_bank` (
  `kd_bank` int(4) NOT NULL,
  `nama_bank` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_bank`
--

INSERT INTO `tb_bank` (`kd_bank`, `nama_bank`) VALUES
(5, 'Muamalat'),
(6, 'BCA'),
(7, 'BRI'),
(9, 'Mandiri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_blacklist`
--

CREATE TABLE `tb_blacklist` (
  `kd_blacklist` int(11) NOT NULL,
  `kd_penyewa` int(4) NOT NULL,
  `reason_bl` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_booking_via`
--

CREATE TABLE `tb_booking_via` (
  `kd_booking` int(5) NOT NULL,
  `booking_via` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_booking_via`
--

INSERT INTO `tb_booking_via` (`kd_booking`, `booking_via`) VALUES
(1, 'Offlin2'),
(3, 'Airbnb');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_confirm_transaksi`
--

CREATE TABLE `tb_confirm_transaksi` (
  `kd_confirm_transaksi` int(4) NOT NULL,
  `kd_penyewa` int(4) NOT NULL,
  `kd_apt` int(4) NOT NULL,
  `kd_unit` int(4) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `hari` int(3) NOT NULL,
  `harga_sewa` int(20) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `diskon` int(20) NOT NULL,
  `ekstra_charge` int(20) NOT NULL,
  `kd_bank` int(4) NOT NULL,
  `tamu` int(11) NOT NULL,
  `kd_booking` int(5) NOT NULL,
  `dp` int(20) NOT NULL,
  `total_tagihan` int(20) NOT NULL,
  `sisa_pelunasan` int(20) NOT NULL,
  `catatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_confirm_transaksi`
--

INSERT INTO `tb_confirm_transaksi` (`kd_confirm_transaksi`, `kd_penyewa`, `kd_apt`, `kd_unit`, `check_in`, `check_out`, `hari`, `harga_sewa`, `tgl_transaksi`, `diskon`, `ekstra_charge`, `kd_bank`, `tamu`, `kd_booking`, `dp`, `total_tagihan`, `sisa_pelunasan`, `catatan`) VALUES
(1, 32, 2, 5, '2018-01-30', '2018-02-02', 3, 100000, '2018-01-27', 100000, 400000, 5, 7, 1, 120000, 700000, 580000, ''),
(2, 20, 2, 5, '2018-02-04', '2018-02-05', 1, 200000, '2018-02-04', 0, 200000, 7, 5, 1, 200000, 200000, 0, ''),
(3, 20, 2, 5, '2018-02-06', '2018-02-07', 1, 200000, '2018-02-06', 0, 0, 6, 5, 1, 2000, 200000, 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_unit`
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
  `img` varchar(200) DEFAULT NULL,
  `isi` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_detail_unit`
--

INSERT INTO `tb_detail_unit` (`kd_detail_unit`, `kd_unit`, `lantai`, `jml_kmr`, `jml_bed`, `jml_ac`, `water_heater`, `dapur`, `wifi`, `tv`, `amenities`, `merokok`, `type`, `img`, `isi`) VALUES
(6, 9, 1, 1, 1, 1, 'Y', 'Y', 'Y', 'Y', 'Y', 'N', '1BR', 'None', 'Y'),
(7, 7, 1, 1, 1, 2, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', '2BR', '1002180522411.jpg+1002180529573.jpg+1602180145221.jpg', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_owner`
--

CREATE TABLE `tb_owner` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_owner`
--

INSERT INTO `tb_owner` (`kd_owner`, `nama`, `alamat`, `no_tlp`, `kd_bank`, `no_rek`, `tgl_gabung`, `email`, `jenis_kelamin`, `jumlah_unit`, `username`) VALUES
(0, '-', '-', '-', 6, '-', '0000-00-00', '-', 'Laki-Laki', -1, NULL),
(3, 'Mamang Abeh', 'Parahiyangan', '079070', 9, '12131', '2017-12-22', 'jjajah@gmail.com', 'Laki-laki', 2, 'owner'),
(4, 'Ujang Ganteng', 'Cipendeuy', '0887067', 7, '677444', '2017-12-25', 'ujangtamvan@yahoo.com', 'Laki-laki', 3, NULL),
(5, 'Joko Pintar', 'Banyuwangi', '0223353463', 9, '72876870', '2017-12-29', 'ayamapatelur@gmail.com', 'Laki-laki', 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penyewa`
--

CREATE TABLE `tb_penyewa` (
  `kd_penyewa` int(4) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_tlp` varchar(15) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `tgl_gabung` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_penyewa`
--

INSERT INTO `tb_penyewa` (`kd_penyewa`, `nama`, `alamat`, `no_tlp`, `jenis_kelamin`, `email`, `tgl_gabung`) VALUES
(3, 'Annisa Diah', 'Jakarta', '081315797957', 'Perempuan', 'annisa_diah@gmail.com', '2017-10-12'),
(4, 'Gardina Dewi', 'Jawa Timur', '084541121', 'Perempuan', '', '2017-10-18'),
(8, 'Uye Uyay', 'Sorenyang', '0822155663', 'Laki-laki', '', '0000-00-00'),
(15, 'Agung Sandylea', 'Majalaya', '081222566', 'Laki-laki', '', '0000-00-00'),
(18, 'Bangbang', 'Ciroyom', '021-000', 'Laki-laki', '92083', '0000-00-00'),
(20, 'Abdul Rojak', 'Jakarta', '082222', 'Laki-laki', '', '0000-00-00'),
(21, 'Udin Samsudin', 'Sekeloa Barat', '0812236655', 'Laki-laki', '', '0000-00-00'),
(22, 'AA Abidi', 'Jalan Pungkur', '082666544', 'Laki-laki', '090777', '0000-00-00'),
(23, 'Maman', '-', '-', 'Laki-laki', '', '0000-00-00'),
(29, 'Johana', 'Leuwi Gajah', '0997899', 'Laki-laki', '', '0000-00-00'),
(30, 'Encep', 'Tangerang', '91411496', 'Laki-laki', '', '0000-00-00'),
(31, 'Ujang Karoke', 'Banjarmasin', '097252', 'Laki-laki', '', '0000-00-00'),
(32, 'Adminnin', 'jambi', '0897665787867', 'Perempuan', '', '0000-00-00'),
(35, 'Agus', 'Jalan jalan', '088080', 'Laki-laki', 'aknadasd', '2018-02-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_recommended`
--

CREATE TABLE `tb_recommended` (
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
-- Dumping data untuk tabel `tb_request_listing`
--

INSERT INTO `tb_request_listing` (`kd_request_listing`, `nama`, `alamat`, `no_tlp`, `email`, `apartemen`, `tipe`, `lantai`, `kondisi`, `status`) VALUES
(1, 'Farhan Hanif Alaudin', 'Margahayu', '089652281077', 'abc@gmail.com', 'Jardin', '', 12, 'Half Furnish', 'Pribadi'),
(2, 'Imron', 'Banjaran', '123456789', 'abc@gmail.com', 'Gateway', '', 24, 'Half Furnish', 'Pribadi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_reservasi`
--

CREATE TABLE `tb_reservasi` (
  `kd_reservasi` int(4) NOT NULL,
  `kd_apt` int(4) NOT NULL,
  `kd_unit` int(4) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `nama` varchar(20) NOT NULL,
  `no_tlp` varchar(15) NOT NULL,
  `tgl_reservasi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_reservasi`
--

INSERT INTO `tb_reservasi` (`kd_reservasi`, `kd_apt`, `kd_unit`, `check_in`, `check_out`, `nama`, `no_tlp`, `tgl_reservasi`) VALUES
(16, 4, 6, '2018-01-07', '2018-01-08', 'Ahmaf', '0982252535', NULL),
(17, 1, 1, '2018-01-07', '2018-01-08', 'Jono', '79559', NULL),
(18, 1, 1, '2018-01-08', '2018-01-09', 'Jhono', '251512', NULL),
(19, 1, 1, '2018-01-08', '2018-01-23', 'jabfasf', '982323', NULL),
(20, 1, 1, '2018-01-08', '2018-01-09', 'jkjk', '987070', NULL),
(21, 1, 1, '2018-01-08', '2018-01-09', 'jkjk', '987070', NULL),
(22, 1, 1, '2018-01-08', '2018-01-09', 'jkjk', '987070', NULL),
(23, 1, 1, '2018-01-08', '2018-01-09', 'jkjk', '987070', NULL),
(24, 4, 6, '2018-01-08', '2018-01-09', 'hjhj', '679697', NULL),
(25, 4, 6, '2018-01-08', '2018-01-09', 'hjhj', '679697', NULL),
(26, 1, 1, '2018-01-09', '2018-01-10', 'Johan', '213123', NULL),
(27, 1, 1, '2018-01-08', '2018-01-09', 'joono', '12124', NULL),
(28, 1, 1, '2018-01-08', '2018-01-09', 'joono', '12124', NULL),
(29, 1, 1, '2018-01-08', '2018-01-09', 'joono', '12124', NULL),
(30, 2, 5, '2018-01-09', '2018-01-11', 'ygjg', '23477898', NULL),
(31, 2, 5, '2018-01-10', '2018-01-12', 'afasf', '214124', NULL),
(32, 1, 1, '2018-01-09', '2018-01-10', 'gffg1', 'hmvhjv', NULL),
(33, 1, 0, '2018-01-12', '2018-01-13', 'Coba1', '023525', NULL),
(34, 1, 0, '2018-01-12', '2018-01-13', 'Cobajadi1', '234124', NULL),
(35, 4, 6, '2018-01-12', '2018-01-13', 'Manis', '04', '2018-01-12'),
(36, 4, 6, '2018-01-14', '2018-01-15', 'Siapa', '68124124', '2018-01-14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `kd_transaksi` int(4) NOT NULL,
  `kd_penyewa` int(4) NOT NULL,
  `kd_apt` int(4) NOT NULL,
  `kd_unit` int(4) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `hari` int(3) NOT NULL,
  `harga_sewa` int(20) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `diskon` int(20) NOT NULL,
  `ekstra_charge` int(20) NOT NULL,
  `kd_bank` int(4) NOT NULL,
  `tamu` int(11) NOT NULL,
  `kd_booking` int(5) NOT NULL,
  `dp` int(20) NOT NULL,
  `total_tagihan` int(20) NOT NULL,
  `sisa_pelunasan` int(20) NOT NULL,
  `catatan` varchar(50) NOT NULL,
  `pembayaran` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`kd_transaksi`, `kd_penyewa`, `kd_apt`, `kd_unit`, `check_in`, `check_out`, `hari`, `harga_sewa`, `tgl_transaksi`, `diskon`, `ekstra_charge`, `kd_bank`, `tamu`, `kd_booking`, `dp`, `total_tagihan`, `sisa_pelunasan`, `catatan`, `pembayaran`) VALUES
(2, 32, 2, 5, '2018-02-27', '2018-02-28', 1, 200000, '2018-02-11', 0, 0, 5, 5, 1, 16000, 200000, 184000, '', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_unit`
--

CREATE TABLE `tb_unit` (
  `kd_unit` int(4) NOT NULL,
  `kd_apt` int(4) NOT NULL,
  `kd_owner` int(4) DEFAULT NULL,
  `no_unit` varchar(10) NOT NULL,
  `h_sewa_wd` int(10) NOT NULL,
  `h_sewa_we` int(10) NOT NULL,
  `h_owner_wd` int(10) NOT NULL,
  `h_owner_we` int(10) NOT NULL,
  `ekstra_charge` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_unit`
--

INSERT INTO `tb_unit` (`kd_unit`, `kd_apt`, `kd_owner`, `no_unit`, `h_sewa_wd`, `h_sewa_we`, `h_owner_wd`, `h_owner_we`, `ekstra_charge`) VALUES
(0, 0, 0, 'Semua Unit', 0, 0, 0, 0, 0),
(5, 2, 5, '6DGJ', 200000, 200000, 200000, 200000, 200000),
(7, 7, 3, '2GHS', 500000, 500000, 400000, 500000, 40000),
(9, 4, 3, 'MSG-17', 10000, 11000, 10000, 10000, 10000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `hak_akses` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`username`, `password`, `hak_akses`) VALUES
('admin2', 'cozzal123', 'admin'),
('manager', 'manager', 'manager'),
('owner', 'owner', 'owner'),
('superadmin', 'superadmin', 'superadmin');

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
  ADD PRIMARY KEY (`kd_blacklist`),
  ADD KEY `kd_nama` (`kd_penyewa`),
  ADD KEY `kd_nama_2` (`kd_penyewa`);

--
-- Indexes for table `tb_booking_via`
--
ALTER TABLE `tb_booking_via`
  ADD PRIMARY KEY (`kd_booking`);

--
-- Indexes for table `tb_confirm_transaksi`
--
ALTER TABLE `tb_confirm_transaksi`
  ADD PRIMARY KEY (`kd_confirm_transaksi`),
  ADD KEY `kd_penyewa` (`kd_penyewa`),
  ADD KEY `kd_apt` (`kd_apt`),
  ADD KEY `kd_unit` (`kd_unit`),
  ADD KEY `kd_bank` (`kd_bank`),
  ADD KEY `kd_booking` (`kd_booking`);

--
-- Indexes for table `tb_detail_unit`
--
ALTER TABLE `tb_detail_unit`
  ADD PRIMARY KEY (`kd_detail_unit`),
  ADD KEY `kd_unit` (`kd_unit`);

--
-- Indexes for table `tb_owner`
--
ALTER TABLE `tb_owner`
  ADD PRIMARY KEY (`kd_owner`),
  ADD KEY `kd_bank` (`kd_bank`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `tb_penyewa`
--
ALTER TABLE `tb_penyewa`
  ADD PRIMARY KEY (`kd_penyewa`);

--
-- Indexes for table `tb_recommended`
--
ALTER TABLE `tb_recommended`
  ADD PRIMARY KEY (`kd_recommended`),
  ADD KEY `kd_penyewa` (`kd_penyewa`);

--
-- Indexes for table `tb_request_listing`
--
ALTER TABLE `tb_request_listing`
  ADD PRIMARY KEY (`kd_request_listing`);

--
-- Indexes for table `tb_reservasi`
--
ALTER TABLE `tb_reservasi`
  ADD PRIMARY KEY (`kd_reservasi`),
  ADD KEY `kd_apt` (`kd_apt`),
  ADD KEY `kd_unit` (`kd_unit`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`kd_transaksi`),
  ADD KEY `kd_penyewa` (`kd_penyewa`),
  ADD KEY `kd_unit` (`kd_unit`),
  ADD KEY `kd_apt` (`kd_apt`),
  ADD KEY `kd_booking` (`kd_booking`),
  ADD KEY `kd_bank` (`kd_bank`);

--
-- Indexes for table `tb_unit`
--
ALTER TABLE `tb_unit`
  ADD PRIMARY KEY (`kd_unit`),
  ADD KEY `kd_apt` (`kd_apt`),
  ADD KEY `kd_owner` (`kd_owner`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_apt`
--
ALTER TABLE `tb_apt`
  MODIFY `kd_apt` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_bank`
--
ALTER TABLE `tb_bank`
  MODIFY `kd_bank` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tb_blacklist`
--
ALTER TABLE `tb_blacklist`
  MODIFY `kd_blacklist` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_booking_via`
--
ALTER TABLE `tb_booking_via`
  MODIFY `kd_booking` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_confirm_transaksi`
--
ALTER TABLE `tb_confirm_transaksi`
  MODIFY `kd_confirm_transaksi` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_detail_unit`
--
ALTER TABLE `tb_detail_unit`
  MODIFY `kd_detail_unit` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_owner`
--
ALTER TABLE `tb_owner`
  MODIFY `kd_owner` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_penyewa`
--
ALTER TABLE `tb_penyewa`
  MODIFY `kd_penyewa` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `tb_recommended`
--
ALTER TABLE `tb_recommended`
  MODIFY `kd_recommended` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_request_listing`
--
ALTER TABLE `tb_request_listing`
  MODIFY `kd_request_listing` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_reservasi`
--
ALTER TABLE `tb_reservasi`
  MODIFY `kd_reservasi` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `kd_transaksi` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_unit`
--
ALTER TABLE `tb_unit`
  MODIFY `kd_unit` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_blacklist`
--
ALTER TABLE `tb_blacklist`
  ADD CONSTRAINT `tb_blacklist_ibfk_1` FOREIGN KEY (`kd_penyewa`) REFERENCES `tb_penyewa` (`kd_penyewa`);

--
-- Ketidakleluasaan untuk tabel `tb_confirm_transaksi`
--
ALTER TABLE `tb_confirm_transaksi`
  ADD CONSTRAINT `tb_confirm_transaksi_ibfk_1` FOREIGN KEY (`kd_unit`) REFERENCES `tb_unit` (`kd_unit`),
  ADD CONSTRAINT `tb_confirm_transaksi_ibfk_2` FOREIGN KEY (`kd_apt`) REFERENCES `tb_apt` (`kd_apt`),
  ADD CONSTRAINT `tb_confirm_transaksi_ibfk_3` FOREIGN KEY (`kd_penyewa`) REFERENCES `tb_penyewa` (`kd_penyewa`),
  ADD CONSTRAINT `tb_confirm_transaksi_ibfk_4` FOREIGN KEY (`kd_bank`) REFERENCES `tb_bank` (`kd_bank`),
  ADD CONSTRAINT `tb_confirm_transaksi_ibfk_5` FOREIGN KEY (`kd_booking`) REFERENCES `tb_booking_via` (`kd_booking`);

--
-- Ketidakleluasaan untuk tabel `tb_detail_unit`
--
ALTER TABLE `tb_detail_unit`
  ADD CONSTRAINT `tb_detail_unit_ibfk_1` FOREIGN KEY (`kd_unit`) REFERENCES `tb_unit` (`kd_unit`);

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
-- Ketidakleluasaan untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`kd_penyewa`) REFERENCES `tb_penyewa` (`kd_penyewa`),
  ADD CONSTRAINT `tb_transaksi_ibfk_2` FOREIGN KEY (`kd_unit`) REFERENCES `tb_unit` (`kd_unit`),
  ADD CONSTRAINT `tb_transaksi_ibfk_3` FOREIGN KEY (`kd_apt`) REFERENCES `tb_apt` (`kd_apt`),
  ADD CONSTRAINT `tb_transaksi_ibfk_5` FOREIGN KEY (`kd_bank`) REFERENCES `tb_bank` (`kd_bank`),
  ADD CONSTRAINT `tb_transaksi_ibfk_6` FOREIGN KEY (`kd_booking`) REFERENCES `tb_booking_via` (`kd_booking`);

--
-- Ketidakleluasaan untuk tabel `tb_unit`
--
ALTER TABLE `tb_unit`
  ADD CONSTRAINT `tb_unit_ibfk_1` FOREIGN KEY (`kd_apt`) REFERENCES `tb_apt` (`kd_apt`),
  ADD CONSTRAINT `tb_unit_ibfk_2` FOREIGN KEY (`kd_owner`) REFERENCES `tb_owner` (`kd_owner`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
