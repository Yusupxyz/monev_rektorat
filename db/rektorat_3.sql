-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jul 09, 2019 at 01:27 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rektorat_3`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'Rektorat', 'Admin Rektorat'),
(3, 'Dekan', 'Dekan Fakultas Universitas Palangka Raya'),
(4, 'Operator', 'Operator Unit');

-- --------------------------------------------------------

--
-- Table structure for table `groups_menu`
--

CREATE TABLE `groups_menu` (
  `id_groups` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups_menu`
--

INSERT INTO `groups_menu` (`id_groups`, `id_menu`) VALUES
(1, 8),
(1, 89),
(1, 42),
(1, 43),
(1, 44),
(1, 40),
(1, 4),
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(1, 90),
(2, 90),
(3, 90),
(4, 90),
(1, 9),
(2, 9),
(3, 9),
(4, 9),
(1, 91),
(4, 91),
(1, 92),
(4, 92);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` int(4) NOT NULL,
  `kode_m_dat` varchar(200) NOT NULL,
  `volume` varchar(50) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `jumlah` varchar(30) NOT NULL,
  `id_unit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `kode_m_dat`, `volume`, `satuan`, `jumlah`, `id_unit`) VALUES
(28, '042.01.01', '-', '-', '822820000', 15),
(29, '5742', '-', '-', '822820000', 15),
(30, '5742.001', '14300', 'Mahasiswa', '460000000', 15),
(31, '5742.994', '1', 'Layanan', '362820000', 15),
(32, '5742.001.002', '-', '-', '460000000', 15);

-- --------------------------------------------------------

--
-- Table structure for table `komponen`
--

CREATE TABLE `komponen` (
  `id_komponen` int(5) NOT NULL,
  `id_kegiatan` int(11) NOT NULL,
  `kode_komponen` varchar(10) NOT NULL,
  `uraian_kegiatan` varchar(500) NOT NULL,
  `volume` varchar(100) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `jumlah` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komponen`
--

INSERT INTO `komponen` (`id_komponen`, `id_kegiatan`, `kode_komponen`, `uraian_kegiatan`, `volume`, `satuan`, `jumlah`) VALUES
(2, 32, '051', 'Penerimaan Mahasiswa Baru', '-', '-', '60000000'),
(3, 32, '052', 'Proses Belajar Mengajar', '-', '-', '400000000'),
(4, 31, '051', 'Penyelenggaraan Operasional Perkantoran', '-', '-', '362820000');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '99',
  `level` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `icon` varchar(125) NOT NULL,
  `label` varchar(25) NOT NULL,
  `link` varchar(125) NOT NULL,
  `id` varchar(25) NOT NULL DEFAULT '#',
  `id_menu_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `sort`, `level`, `parent_id`, `icon`, `label`, `link`, `id`, `id_menu_type`) VALUES
(1, 0, 1, 0, 'empty', 'MAIN NAVIGATION', '#', '#', 1),
(3, 1, 2, 1, 'fas fa-tachometer-alt', 'Dashboard', 'dashboard', '#', 1),
(4, 9, 2, 40, 'fas fa-table', 'CRUD Generator', 'crudbuilder', '1', 1),
(8, 7, 2, 40, 'fas fa-bars', 'Menu', 'cms/menu/side-menu', 'navMenu', 1),
(9, 3, 2, 90, 'fab fa-galactic-republic', 'Kegiatan', 'kegiatan', '1', 1),
(40, 6, 1, 0, 'empty', 'SETTING', '#', '#', 1),
(42, 10, 2, 40, 'fas fa-users-cog', 'User', '#', '1', 1),
(43, 11, 3, 42, 'fas fa-angle-double-right', 'Users', 'users', '1', 1),
(44, 12, 3, 42, 'fas fa-angle-double-right', 'Groups', 'groups', '2', 1),
(89, 8, 2, 40, 'fas fa-th-list', 'Menu Type', 'menu_type', 'menu_type', 1),
(90, 2, 1, 0, 'empty', 'UTAMA', '#', '#', 1),
(91, 4, 2, 90, 'fas fa-building', 'Unit Kerja', 'unit', '1', 1),
(92, 5, 2, 90, 'fab fa-cc-mastercard', 'Master Data', 'M_dat', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_type`
--

CREATE TABLE `menu_type` (
  `id_menu_type` int(11) NOT NULL,
  `type` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_type`
--

INSERT INTO `menu_type` (`id_menu_type`, `type`) VALUES
(1, 'Side menu');

-- --------------------------------------------------------

--
-- Table structure for table `m_dat`
--

CREATE TABLE `m_dat` (
  `kode` varchar(200) NOT NULL,
  `ket` text NOT NULL,
  `induk` varchar(200) NOT NULL,
  `jenis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_dat`
--

INSERT INTO `m_dat` (`kode`, `ket`, `induk`, `jenis`) VALUES
('042.01.01', 'Program Dukungan Manajemen dan Pelaksanaan Tugas Teknis Lainnya Kementerian Riset, Teknologi dan Pendidikan Tinggi', '0', 1),
('2642', 'Penyediaan Dana Bantuan Operasional untuk Perguruan Tinggi Negeri dan Bantuan Pendanaan PTN-BH', '042.01.01', 2),
('2642.001', 'Layanan Perkantoran Satker\r\n[Base Line]', '2642', 3),
('2642.001.001', 'Operasional dan Pemeliharaan Perkantoran', '2642.001', 4),
('2642.002', 'Layanan Pembelajaran\r\n[Base Line]', '2642', 3),
('2642.002.001', 'Proses Belajar Mengajar', '2642.002', 4),
('2642.002.002', 'Wisuda dan Yudisium', '2642.003', 4),
('2642.004', 'Laporan Kegiatan Mahasiswa\r\n[Base Line]', '2642', 3),
('2642.004.001', 'Unit Kegiatan Mahasiswa dan Organisasi Kemahasiswaan', '2642.004', 4),
('2642.004.002', 'Kegiatan Kemahasiswaan', '2642.004', 4),
('2642.004.003', 'Kompetisi/Lomba Mahasiswa', '2642.004', 4),
('2642.007', 'Layanan Pengembangan Sistem Tata Kelola, Kelembagaan, dan SDM [Base Line]', '2642', 3),
('2642.007.001', 'Penjaminan Mutu Tata Kelola Kelembagaan dan Pendidikan', '2642.007', 4),
('2642.007.002', 'Penjaminan Mutu Sumber Daya Manusia', '2642.007', 4),
('2642.008', 'Sarana dan Prasarana Pembelajaran\r\n[Base Line]', '2642', 3),
('2642.008.002', 'Peralatan Pendukung Pembelajaran', '2642.008', 4),
('2642.008.004', 'Gedung dan Bangunan Pendukung Pembelajaran', '2642.008', 4),
('5741', 'Dukungan Manajemen PTN/Kopertis', '042.01.01', 2),
('5741.994', 'Layanan Perkantoran\r\n[Base Line]', '5741', 3),
('5742', 'Peningkatan Layanan Tridharma Perguruan Tinggi', '042.01.01', 2),
('5742.001', 'Layanan Pendidikan\r\n[Base Line]', '5742', 3),
('5742.001.002', 'Layanan Pendidikan Program Sarjana', '5742.001', 4),
('5742.001.003', 'Layanan Pendidikan Program Pascasarjana', '5742.001', 4),
('5742.002', 'Penelitian\r\n[Base Line]', '5742', 3),
('5742.003', 'Pengabdian Masyarakat\r\n[Base Line]', '5742', 3),
('5742.004', 'Sarana/Prasarana Pendukung Pembelajaran\r\n[Base Line]', '5742', 3),
('5742.005', 'Sarana/Prasarana Pendukung Perkantoran\r\n[Base Line]', '5742', 3),
('5742.994', 'Layanan Perkantoran\r\n[Base Line]', '5742', 3);

-- --------------------------------------------------------

--
-- Table structure for table `realisasi`
--

CREATE TABLE `realisasi` (
  `id_realisasi` int(5) NOT NULL,
  `id_ref` int(5) NOT NULL,
  `realisasi_keuangan` varchar(30) NOT NULL,
  `persentase_apk_1` varchar(5) NOT NULL,
  `persentase_apk_2` varchar(5) NOT NULL,
  `persentase_apk_3` varchar(5) NOT NULL,
  `persentase_apk_4` varchar(5) NOT NULL,
  `persentase_rpk` varchar(5) NOT NULL,
  `persentase_edp` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sub_komponen`
--

CREATE TABLE `sub_komponen` (
  `id_subkomponen` int(11) NOT NULL,
  `id_komponen` int(11) NOT NULL,
  `kode_subkomponen` varchar(10) NOT NULL,
  `uraian_kegiatan` varchar(500) NOT NULL,
  `volume` varchar(50) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `jumlah` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_komponen`
--

INSERT INTO `sub_komponen` (`id_subkomponen`, `id_komponen`, `kode_subkomponen`, `uraian_kegiatan`, `volume`, `satuan`, `jumlah`) VALUES
(1, 2, 'EA', 'Program Pengenalan Kampus Mahasiswa Baru (PPKMB) Fakultas Pertanian', '-', '-', '60000000'),
(2, 3, 'EA', 'Praktikum Pada Fakultas Pertanian', '-', '-', '400000000'),
(3, 4, 'EA', 'Keperluan Perkantoran dan Kerumahtanggaan Fakultas Pertanian', '-', '-', '362820000');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id_unit` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id_unit`, `nama`, `deskripsi`) VALUES
(15, 'E', 'Faperta'),
(16, 'D', 'Fakultas Ekonomi');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `id_unit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `id_unit`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', 'm0vyKu2zW7L8PTG20bquF.707e055aeea8a30aca', 1541329145, 'XfERkEq7bkuTwbgQGlGLFe', 1268889823, 1562628147, 1, 'Admin', 'istrator', 'ADMIN', '0', 0),
(2, '127.0.0.1', 'member', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'member@member.com', '', 'm0vyKu2zW7L8PTG20bquF.707e055aeea8a30aca', 1541329145, 'lHtbqmxsnla1izZ5LcXd9O', 1268889823, 1562613389, 1, 'Operator', 'Apps', 'Prodi', '0', 15),
(3, '127.0.0.1', 'adeade', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', 'adeade', 'ade.chandra.saputra.tumbai@gmail.com', NULL, 'ads', 0, 'ad', 0, 1562344978, 1, 'ad', 'e', 'adecs', '12424', 0),
(5, '::1', 'admin12@admin.com', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', NULL, 'admin12@admin.com', NULL, NULL, NULL, NULL, 1562004896, 1562344996, 1, 'rudi', 'rudi', 'Prodi', '12424', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(3, 1, 1),
(31, 2, 4),
(32, 3, 3),
(30, 5, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`),
  ADD KEY `kode_m_dat` (`kode_m_dat`);

--
-- Indexes for table `komponen`
--
ALTER TABLE `komponen`
  ADD PRIMARY KEY (`id_komponen`),
  ADD KEY `id_kegiatan` (`id_kegiatan`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `menu_type`
--
ALTER TABLE `menu_type`
  ADD PRIMARY KEY (`id_menu_type`);

--
-- Indexes for table `m_dat`
--
ALTER TABLE `m_dat`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `realisasi`
--
ALTER TABLE `realisasi`
  ADD PRIMARY KEY (`id_realisasi`);

--
-- Indexes for table `sub_komponen`
--
ALTER TABLE `sub_komponen`
  ADD PRIMARY KEY (`id_subkomponen`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_unit` (`id_unit`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_kegiatan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `komponen`
--
ALTER TABLE `komponen`
  MODIFY `id_komponen` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `menu_type`
--
ALTER TABLE `menu_type`
  MODIFY `id_menu_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `realisasi`
--
ALTER TABLE `realisasi`
  MODIFY `id_realisasi` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_komponen`
--
ALTER TABLE `sub_komponen`
  MODIFY `id_subkomponen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD CONSTRAINT `kegiatan_ibfk_1` FOREIGN KEY (`kode_m_dat`) REFERENCES `m_dat` (`kode`);

--
-- Constraints for table `komponen`
--
ALTER TABLE `komponen`
  ADD CONSTRAINT `komponen_ibfk_1` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id_kegiatan`);

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
