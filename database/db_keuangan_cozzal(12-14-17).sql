-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 14 Des 2017 pada 10.08
-- Versi Server: 10.1.26-MariaDB
-- PHP Version: 7.1.9

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
(1, 'Newton', ''),
(2, 'Jardin', ''),
(3, 'Metro The Suite', ''),
(4, 'Gateway', '');

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
(5, 'BRI'),
(6, 'BCA');

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
(1, 'Airbnb'),
(2, 'Cozzal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_owner`
--

CREATE TABLE `tb_owner` (
  `kd_owner` int(4) NOT NULL,
  `kd_apt` int(4) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_tlp` varchar(15) NOT NULL,
  `kd_bank` int(4) NOT NULL,
  `no_rek` varchar(20) NOT NULL,
  `tgl_gabung` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Farhan Hanif Alaudin', 'Margahayu', '089652281077', 'Laki-laki', '', '2017-10-04'),
(3, 'Annisa Diah', 'Jakarta', '081315797957', 'Perempuan', 'annisa_diah@gmail.com', '2017-10-12'),
(4, 'Gardina Dewi', 'Jawa Timur', '084541121', 'Perempuan', '', '2017-10-18'),
(5, 'Irham A', 'Margaasih', '0812236654', 'Laki-laki', '', '2017-10-06'),
(6, 'Ridwan Remin', 'Jakarta', '0823336566', 'Laki-laki', '', '2017-10-21'),
(8, 'Uye Uyay', 'Sorenyang', '0822155663', 'Laki-laki', '', '0000-00-00'),
(9, 'Udin Samsudin', 'Kebayoran Lama', '081255469', 'Laki-laki', '', '0000-00-00'),
(10, 'Fauziyah Astuti', 'Sekeloa', '0856663998', 'Perempuan', '', '0000-00-00'),
(11, 'Michele', 'Inggris', '0836658997', 'Laki-laki', '', '0000-00-00'),
(12, 'Iman', 'Margahayu', '0812266', 'Laki-laki', '', '0000-00-00'),
(13, 'Budi Raharjo', 'Sukasuka', '0819785263', 'Laki-laki', '', '0000-00-00'),
(14, 'ivan', 'asd', 'asdasda', 'Laki-laki', '', '0000-00-00'),
(15, 'Agung Sandylea', 'Majalaya', '081222566', 'Laki-laki', '', '0000-00-00'),
(16, 'Abduh Surabduh', 'Margahayu', '089652281077', 'Laki-laki', '', '0000-00-00'),
(17, 'Rohmana Aisyah', 'Margaluyu', '082233369', 'Perempuan', '', '0000-00-00'),
(18, 'Bangbang', 'Ciroyom', '021-000', 'Laki-laki', '', '0000-00-00'),
(20, 'Abdul Rojak', 'Jakarta', '082222', 'Laki-laki', '', '0000-00-00');

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
  `catatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`kd_transaksi`, `kd_penyewa`, `kd_apt`, `kd_unit`, `check_in`, `check_out`, `hari`, `harga_sewa`, `tgl_transaksi`, `diskon`, `ekstra_charge`, `kd_bank`, `tamu`, `kd_booking`, `dp`, `total_tagihan`, `sisa_pelunasan`, `catatan`) VALUES
(40, 3, 1, 1, '2017-12-15', '2017-12-16', 0, 500000, '0000-00-00', 0, 150000, 5, 3, 1, 200000, 0, 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_unit`
--

CREATE TABLE `tb_unit` (
  `kd_unit` int(4) NOT NULL,
  `kd_apt` int(4) NOT NULL,
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

INSERT INTO `tb_unit` (`kd_unit`, `kd_apt`, `no_unit`, `h_sewa_wd`, `h_sewa_we`, `h_owner_wd`, `h_owner_we`, `ekstra_charge`) VALUES
(1, 1, '18BF', 500000, 600000, 400000, 500000, 150000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`) VALUES
(1, 'admin1', 'cozzaldotcom'),
(2, 'admin2', 'cozzal123');

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
-- Indexes for table `tb_owner`
--
ALTER TABLE `tb_owner`
  ADD PRIMARY KEY (`kd_owner`),
  ADD KEY `kd_bank` (`kd_bank`),
  ADD KEY `kd_apt` (`kd_apt`);

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
  ADD KEY `kd_apt` (`kd_apt`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_apt`
--
ALTER TABLE `tb_apt`
  MODIFY `kd_apt` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_bank`
--
ALTER TABLE `tb_bank`
  MODIFY `kd_bank` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_blacklist`
--
ALTER TABLE `tb_blacklist`
  MODIFY `kd_blacklist` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_booking_via`
--
ALTER TABLE `tb_booking_via`
  MODIFY `kd_booking` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_owner`
--
ALTER TABLE `tb_owner`
  MODIFY `kd_owner` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_penyewa`
--
ALTER TABLE `tb_penyewa`
  MODIFY `kd_penyewa` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_recommended`
--
ALTER TABLE `tb_recommended`
  MODIFY `kd_recommended` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `kd_transaksi` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tb_unit`
--
ALTER TABLE `tb_unit`
  MODIFY `kd_unit` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_blacklist`
--
ALTER TABLE `tb_blacklist`
  ADD CONSTRAINT `tb_blacklist_ibfk_1` FOREIGN KEY (`kd_penyewa`) REFERENCES `tb_penyewa` (`kd_penyewa`);

--
-- Ketidakleluasaan untuk tabel `tb_owner`
--
ALTER TABLE `tb_owner`
  ADD CONSTRAINT `tb_owner_ibfk_2` FOREIGN KEY (`kd_apt`) REFERENCES `tb_apt` (`kd_apt`),
  ADD CONSTRAINT `tb_owner_ibfk_3` FOREIGN KEY (`kd_bank`) REFERENCES `tb_bank` (`kd_bank`);

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
  ADD CONSTRAINT `tb_unit_ibfk_1` FOREIGN KEY (`kd_apt`) REFERENCES `tb_apt` (`kd_apt`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
