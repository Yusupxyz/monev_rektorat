-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Aug 28, 2019 at 05:16 PM
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
-- Database: `rektorat`
--

-- --------------------------------------------------------

--
-- Table structure for table `bulan`
--

CREATE TABLE `bulan` (
  `id_bulan` int(5) NOT NULL,
  `bulan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bulan`
--

INSERT INTO `bulan` (`id_bulan`, `bulan`) VALUES
(1, 'Januari'),
(2, 'Februari'),
(3, 'Maret'),
(4, 'April'),
(5, 'Mei'),
(6, 'Juni'),
(7, 'Juli'),
(8, 'Agustus'),
(9, 'September'),
(10, 'Oktober'),
(11, 'Nopember'),
(12, 'Desember');

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
(4, 'Operator', 'Operator Unit'),
(5, 'Rektorat Lv 2', 'Pejabat Rektorat');

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
(1, 92),
(2, 92),
(1, 91),
(2, 91),
(1, 90),
(2, 90),
(3, 90),
(4, 90),
(1, 95),
(2, 95),
(1, 93),
(2, 93),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(1, 96),
(2, 96),
(5, 96),
(1, 97),
(2, 97),
(3, 97),
(4, 97),
(5, 97);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` int(4) NOT NULL,
  `kode_m_dat` varchar(200) NOT NULL,
  `volume` varchar(50) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `jumlah` bigint(30) NOT NULL,
  `rencana_capaian` int(5) NOT NULL,
  `capaian` int(5) NOT NULL,
  `jumlah_capaian` bigint(30) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `id_tahun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `kode_m_dat`, `volume`, `satuan`, `jumlah`, `rencana_capaian`, `capaian`, `jumlah_capaian`, `id_unit`, `id_tahun`) VALUES
(85, '042.01.01', '-', '-', 3016332003, 0, 0, 0, 0, 1),
(86, '2642', '-', '-', 3016332000, 0, 0, 0, 0, 1),
(87, '2642.001', '-', '-', 1184900000, 0, 0, 0, 0, 1),
(88, '2642.001.001', '-', '-', 1184900000, 0, 0, 0, 0, 1),
(90, '5742.001', '-', '-', 3, 0, 0, 0, 0, 1),
(92, '5742.001.002', '-', '-', 3, 0, 0, 0, 0, 1),
(93, '042.01.01', '-', '-', 361121000, 3, 1, 6000000, 16, 1),
(94, '5742', '-', '-', 361121000, 3, 1, 6000000, 16, 1),
(95, '5742.001', '-', '-', 361121000, 3, 1, 6000000, 16, 1),
(96, '5742.001.002', 'Layanan Pendidikan Program Sarjana', '-', 361121000, 3, 1, 6000000, 16, 1),
(97, '2642.002', '-', '-', 1831432000, 0, 0, 0, 0, 1),
(98, '2642.002.001', '-', '-', 1222378000, 0, 0, 0, 0, 1),
(99, '2642.002.002', '-', '-', 609054000, 0, 0, 0, 0, 1);

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
  `jumlah` bigint(30) NOT NULL,
  `rencana_capaian` int(5) NOT NULL,
  `capaian` int(5) NOT NULL,
  `jumlah_capaian` bigint(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komponen`
--

INSERT INTO `komponen` (`id_komponen`, `id_kegiatan`, `kode_komponen`, `uraian_kegiatan`, `volume`, `satuan`, `jumlah`, `rencana_capaian`, `capaian`, `jumlah_capaian`) VALUES
(27, 92, '051', 'Penerimaan Mahasiswa Baru', '-', '-', 2, 0, 0, 0),
(28, 92, '052', 'Proses Belajar Mengajar', '-', '-', 1, 0, 0, 0),
(29, 92, '053', 'Wisuda dan Yudisium', '-', '-', 0, 0, 0, 0),
(30, 96, '051', 'Penerimaan Mahasiswa Baru', '-', '-', 20000000, 5, 1, 5000000),
(31, 96, '052', 'Proses Belajar Mengajar', '-', '-', 326925000, 5, 1, 1000000),
(32, 96, '057', 'Administrasi Pendidikan', '-', '-', 14196000, 0, 0, 0),
(33, 96, '053', 'Wisuda dan Yudisium', '-', '-', 0, 0, 0, 0),
(34, 88, '004', 'Dukungan Operasional Penyelenggaraan Pendidikan', '-', '-', 1184900000, 0, 0, 0),
(35, 98, '004', 'Dukungan Operasional Penyelenggaraan Pendidikan', '-', '-', 1222378000, 0, 0, 0),
(37, 99, '004', 'Dukungan Operasional Penyelenggaraan Pendidikan', '-', '-', 609054000, 0, 0, 0);

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
(8, 7, 2, 40, 'fas fa-bars', 'Menu', 'cms/menu/side-menu', 'navMenu', 1),
(40, 6, 1, 0, 'empty', 'SETTING', '#', '#', 1),
(42, 10, 2, 40, 'fas fa-users-cog', 'User', '#', '1', 1),
(43, 11, 3, 42, 'fas fa-angle-double-right', 'Users', 'users', '1', 1),
(44, 12, 3, 42, 'fas fa-angle-double-right', 'Groups', 'groups', '2', 1),
(89, 8, 2, 40, 'fas fa-th-list', 'Menu Type', 'menu_type', 'menu_type', 1),
(90, 2, 1, 0, 'empty', 'UTAMA', '#', '#', 1),
(91, 4, 2, 90, 'fas fa-building', 'Unit Kerja', 'unit', '1', 1),
(92, 5, 2, 90, 'fab fa-cc-mastercard', 'Master Data', 'M_dat', '1', 1),
(93, 1, 2, 90, 'fas fa-database', 'Atur Tahun', 'tahun', '1', 1),
(95, 2, 2, 90, 'far fa-calendar-alt', 'Atur Perwaktuan', 'setting_waktu', '1', 1),
(96, 1, 2, 90, 'fas fa-align-justify', 'Resume', 'resume', '1', 1),
(97, 1, 2, 90, 'fas fa-arrow-up', 'Capaian & Realisasi', 'kegiatan', '1', 1);

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
('2642.002.002', 'Wisuda dan Yudisium', '2642.002', 4),
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
  `id_bulan` int(5) NOT NULL,
  `id_subkomponen` int(5) NOT NULL,
  `id_unit` int(5) NOT NULL,
  `rencana_capaian` int(5) NOT NULL,
  `ukuran_keberhasilan` text NOT NULL,
  `realisasi_capaian` int(5) NOT NULL,
  `realisasi_jumlah` int(50) NOT NULL,
  `uraian_hasil` text NOT NULL,
  `kendala` varchar(500) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `realisasi`
--

INSERT INTO `realisasi` (`id_realisasi`, `id_bulan`, `id_subkomponen`, `id_unit`, `rencana_capaian`, `ukuran_keberhasilan`, `realisasi_capaian`, `realisasi_jumlah`, `uraian_hasil`, `kendala`, `keterangan`) VALUES
(73, 1, 56, 16, 5, '-', 1, 5000000, '-', '-', '-'),
(74, 2, 56, 16, 0, '-', 0, 0, '-', '-', '-'),
(75, 3, 56, 16, 0, '-', 0, 0, '-', '-', '-'),
(76, 4, 56, 16, 0, '-', 0, 0, '-', '-', '-'),
(77, 5, 56, 16, 0, '-', 0, 0, '-', '-', '-'),
(78, 6, 56, 16, 0, '-', 0, 0, '-', '-', '-'),
(79, 7, 56, 16, 0, '-', 0, 0, '-', '-', '-'),
(80, 8, 56, 16, 0, '-', 0, 0, '-', '-', '-'),
(81, 9, 56, 16, 0, '-', 0, 0, '-', '-', '-'),
(82, 10, 56, 16, 0, '-', 0, 0, '-', '-', '-'),
(83, 11, 56, 16, 0, '-', 0, 0, '-', '-', '-'),
(84, 12, 56, 16, 0, '-', 0, 0, '-', '-', '-'),
(85, 1, 57, 16, 5, '-', 1, 1000000, '-', '-', '-'),
(86, 2, 57, 16, 0, '-', 0, 0, '-', '-', '-'),
(87, 3, 57, 16, 0, '-', 0, 0, '-', '-', '-'),
(88, 4, 57, 16, 0, '-', 0, 0, '-', '-', '-'),
(89, 5, 57, 16, 0, '-', 0, 0, '-', '-', '-'),
(90, 6, 57, 16, 0, '-', 0, 0, '-', '-', '-'),
(91, 7, 57, 16, 0, '-', 0, 0, '-', '-', '-'),
(92, 8, 57, 16, 0, '-', 0, 0, '-', '-', '-'),
(93, 9, 57, 16, 0, '-', 0, 0, '-', '-', '-'),
(94, 10, 57, 16, 0, '-', 0, 0, '-', '-', '-'),
(95, 11, 57, 16, 0, '-', 0, 0, '-', '-', '-'),
(96, 12, 57, 16, 0, '-', 0, 0, '-', '-', '-'),
(97, 1, 58, 16, 0, '-', 0, 0, '-', '-', '-'),
(98, 2, 58, 16, 0, '-', 0, 0, '-', '-', '-'),
(99, 3, 58, 16, 0, '-', 0, 0, '-', '-', '-'),
(100, 4, 58, 16, 0, '-', 0, 0, '-', '-', '-'),
(101, 5, 58, 16, 0, '-', 0, 0, '-', '-', '-'),
(102, 6, 58, 16, 0, '-', 0, 0, '-', '-', '-'),
(103, 7, 58, 16, 0, '-', 0, 0, '-', '-', '-'),
(104, 8, 58, 16, 0, '-', 0, 0, '-', '-', '-'),
(105, 9, 58, 16, 0, '-', 0, 0, '-', '-', '-'),
(106, 10, 58, 16, 0, '-', 0, 0, '-', '-', '-'),
(107, 11, 58, 16, 0, '-', 0, 0, '-', '-', '-'),
(108, 12, 58, 16, 0, '-', 0, 0, '-', '-', '-'),
(109, 1, 59, 16, 0, '-', 0, 0, '-', '-', '-'),
(110, 2, 59, 16, 0, '-', 0, 0, '-', '-', '-'),
(111, 3, 59, 16, 0, '-', 0, 0, '-', '-', '-'),
(112, 4, 59, 16, 0, '-', 0, 0, '-', '-', '-'),
(113, 5, 59, 16, 0, '-', 0, 0, '-', '-', '-'),
(114, 6, 59, 16, 0, '-', 0, 0, '-', '-', '-'),
(115, 7, 59, 16, 0, '-', 0, 0, '-', '-', '-'),
(116, 8, 59, 16, 0, '-', 0, 0, '-', '-', '-'),
(117, 9, 59, 16, 0, '-', 0, 0, '-', '-', '-'),
(118, 10, 59, 16, 0, '-', 0, 0, '-', '-', '-'),
(119, 11, 59, 16, 0, '-', 0, 0, '-', '-', '-'),
(120, 12, 59, 16, 0, '-', 0, 0, '-', '-', '-'),
(229, 1, 127, 0, 0, '-', 0, 0, '-', '-', '-'),
(230, 2, 127, 0, 0, '-', 0, 0, '-', '-', '-'),
(231, 3, 127, 0, 0, '-', 0, 0, '-', '-', '-'),
(232, 4, 127, 0, 0, '-', 0, 0, '-', '-', '-'),
(233, 5, 127, 0, 0, '-', 0, 0, '-', '-', '-'),
(234, 6, 127, 0, 0, '-', 0, 0, '-', '-', '-'),
(235, 7, 127, 0, 0, '-', 0, 0, '-', '-', '-'),
(236, 8, 127, 0, 0, '-', 0, 0, '-', '-', '-'),
(237, 9, 127, 0, 0, '-', 0, 0, '-', '-', '-'),
(238, 10, 127, 0, 0, '-', 0, 0, '-', '-', '-'),
(239, 11, 127, 0, 0, '-', 0, 0, '-', '-', '-'),
(240, 12, 127, 0, 0, '-', 0, 0, '-', '-', '-'),
(241, 1, 184, 0, 0, '-', 0, 0, '-', '-', '-'),
(242, 2, 184, 0, 0, '-', 0, 0, '-', '-', '-'),
(243, 3, 184, 0, 0, '-', 0, 0, '-', '-', '-'),
(244, 4, 184, 0, 0, '-', 0, 0, '-', '-', '-'),
(245, 5, 184, 0, 0, '-', 0, 0, '-', '-', '-'),
(246, 6, 184, 0, 0, '-', 0, 0, '-', '-', '-'),
(247, 7, 184, 0, 0, '-', 0, 0, '-', '-', '-'),
(248, 8, 184, 0, 0, '-', 0, 0, '-', '-', '-'),
(249, 9, 184, 0, 0, '-', 0, 0, '-', '-', '-'),
(250, 10, 184, 0, 0, '-', 0, 0, '-', '-', '-'),
(251, 11, 184, 0, 0, '-', 0, 0, '-', '-', '-'),
(252, 12, 184, 0, 0, '-', 0, 0, '-', '-', '-'),
(289, 1, 191, 0, 0, '-', 0, 0, '-', '-', '-'),
(290, 2, 191, 0, 0, '-', 0, 0, '-', '-', '-'),
(291, 3, 191, 0, 0, '-', 0, 0, '-', '-', '-'),
(292, 4, 191, 0, 0, '-', 0, 0, '-', '-', '-'),
(293, 5, 191, 0, 0, '-', 0, 0, '-', '-', '-'),
(294, 6, 191, 0, 0, '-', 0, 0, '-', '-', '-'),
(295, 7, 191, 0, 0, '-', 0, 0, '-', '-', '-'),
(296, 8, 191, 0, 0, '-', 0, 0, '-', '-', '-'),
(297, 9, 191, 0, 0, '-', 0, 0, '-', '-', '-'),
(298, 10, 191, 0, 0, '-', 0, 0, '-', '-', '-'),
(299, 11, 191, 0, 0, '-', 0, 0, '-', '-', '-'),
(300, 12, 191, 0, 0, '-', 0, 0, '-', '-', '-'),
(349, 1, 211, 0, 0, '-', 0, 0, '-', '-', '-'),
(350, 2, 211, 0, 0, '-', 0, 0, '-', '-', '-'),
(351, 3, 211, 0, 0, '-', 0, 0, '-', '-', '-'),
(352, 4, 211, 0, 0, '-', 0, 0, '-', '-', '-'),
(353, 5, 211, 0, 0, '-', 0, 0, '-', '-', '-'),
(354, 6, 211, 0, 0, '-', 0, 0, '-', '-', '-'),
(355, 7, 211, 0, 0, '-', 0, 0, '-', '-', '-'),
(356, 8, 211, 0, 0, '-', 0, 0, '-', '-', '-'),
(357, 9, 211, 0, 0, '-', 0, 0, '-', '-', '-'),
(358, 10, 211, 0, 0, '-', 0, 0, '-', '-', '-'),
(359, 11, 211, 0, 0, '-', 0, 0, '-', '-', '-'),
(360, 12, 211, 0, 0, '-', 0, 0, '-', '-', '-'),
(361, 1, 212, 0, 0, '-', 0, 0, '-', '-', '-'),
(362, 2, 212, 0, 0, '-', 0, 0, '-', '-', '-'),
(363, 3, 212, 0, 0, '-', 0, 0, '-', '-', '-'),
(364, 4, 212, 0, 0, '-', 0, 0, '-', '-', '-'),
(365, 5, 212, 0, 0, '-', 0, 0, '-', '-', '-'),
(366, 6, 212, 0, 0, '-', 0, 0, '-', '-', '-'),
(367, 7, 212, 0, 0, '-', 0, 0, '-', '-', '-'),
(368, 8, 212, 0, 0, '-', 0, 0, '-', '-', '-'),
(369, 9, 212, 0, 0, '-', 0, 0, '-', '-', '-'),
(370, 10, 212, 0, 0, '-', 0, 0, '-', '-', '-'),
(371, 11, 212, 0, 0, '-', 0, 0, '-', '-', '-'),
(372, 12, 212, 0, 0, '-', 0, 0, '-', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `setting_waktu`
--

CREATE TABLE `setting_waktu` (
  `id_setting_waktu` int(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `waktu_awal` date NOT NULL,
  `waktu_akhir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting_waktu`
--

INSERT INTO `setting_waktu` (`id_setting_waktu`, `nama`, `waktu_awal`, `waktu_akhir`) VALUES
(5, 'Waktu Pengisian Rencana Capaian', '2019-08-01', '2019-08-31'),
(7, 'Waktu Pengisian Realisasi Capaian Fisik', '2019-08-01', '2019-08-31');

-- --------------------------------------------------------

--
-- Table structure for table `set_unit_chart`
--

CREATE TABLE `set_unit_chart` (
  `id` int(3) NOT NULL,
  `id_unit` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `set_unit_chart`
--

INSERT INTO `set_unit_chart` (`id`, `id_unit`) VALUES
(1, 16);

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
  `jumlah` bigint(30) NOT NULL,
  `rencana_capaian` int(5) NOT NULL,
  `capaian` int(5) NOT NULL,
  `jumlah_capaian` bigint(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_komponen`
--

INSERT INTO `sub_komponen` (`id_subkomponen`, `id_komponen`, `kode_subkomponen`, `uraian_kegiatan`, `volume`, `satuan`, `jumlah`, `rencana_capaian`, `capaian`, `jumlah_capaian`) VALUES
(56, 30, 'DA', 'Pengenalan Kehidupan Kampus Bagi Mahasiswa Baru (PKKMB)', '-', '-', 20000000, 5, 1, 5000000),
(57, 31, 'DA', 'Ujian Tengah dan Ujian Akhir Semester Fakultas Ekonomi dan Bisnis', '-', '-', 326925000, 5, 1, 1000000),
(58, 32, 'DA', 'Penyusunan Buku Panduan Penulisan Proposal dan Skripsi Fakultas Ekonomi dan Bisnis', '-', '-', 3200000, 0, 0, 0),
(59, 32, 'DB', 'Pembuatan Buku Profil Fakultas Ekonomi dan Bisnis', '-', '-', 10996000, 0, 0, 0),
(127, 34, 'A', 'PERAWATAN SARANA GEDUNG', '-', '-', 1184900000, 0, 0, 0),
(184, 35, 'A', 'Bahan Penunjang Pelaksanaan Pendidikan', '-', '-', 1222378000, 0, 0, 0),
(191, 37, 'A', 'Wisuda (S1 dan S2) (Keperluan lainnya di PNBP)', '-', '-', 609054000, 0, 0, 0),
(211, 27, 'sds', 'dsds', '-', '-', 2, 0, 0, 0),
(212, 28, 'asa', 'asa', '-', '-', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tahun`
--

CREATE TABLE `tahun` (
  `id_tahun` int(5) NOT NULL,
  `tahun` int(4) NOT NULL,
  `aktif` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun`
--

INSERT INTO `tahun` (`id_tahun`, `tahun`, `aktif`) VALUES
(1, 2019, '1'),
(2, 2018, '0'),
(3, 2020, '0'),
(4, 2021, '0'),
(5, 2022, '0');

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
(0, 'A', 'Rektorat'),
(15, 'E', 'Fakultas Pertanian'),
(16, 'D', 'Fakultas Ekonomi'),
(17, 'H', 'Fakultas Hukum'),
(18, 'I', 'Fakultas Ilmu Sosial dan Ilmu Politik'),
(19, 'J', 'Fakultas Kedokteran'),
(20, 'C', 'Fakultas Keguruan dan Ilmu Pendidikan'),
(21, 'L', 'Fakultas Matematikan dan Ilmu Pengetahuan Alam'),
(22, 'F', 'Fakultas Teknik'),
(23, 'K', 'Program Pasca Sarjana'),
(24, 'T', 'LAB ALAM'),
(25, 'V', 'UPT Bahasa'),
(26, 'S', 'LAB TERPADU'),
(27, 'Q', 'UPT Laboratorium Lahan Gambut'),
(28, 'N', 'LP3MP'),
(29, 'M', 'LPPM'),
(30, 'Y', 'UPT Perpustakaan'),
(31, 'R', 'UPT TIK');

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
  `id_unit` int(11) NOT NULL,
  `foto` longtext NOT NULL,
  `foto_nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `id_unit`, `foto`, `foto_nama`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', 'm0vyKu2zW7L8PTG20bquF.707e055aeea8a30aca', 1541329145, 'XfERkEq7bkuTwbgQGlGLFe', 1268889823, 1566913269, 1, 'Admin', 'istratorr', 'ADMIN', '0', 0, '', ''),
(2, '127.0.0.1', 'member', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'member@member.com', '', 'm0vyKu2zW7L8PTG20bquF.707e055aeea8a30aca', 1541329145, 'lHtbqmxsnla1izZ5LcXd9O', 1268889823, 1563305013, 1, 'Operator', 'Fisip', 'Prodi Fisip', '0', 18, '', ''),
(5, '::1', 'rektorat@rektorat.com', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', NULL, 'rektorat@rektorat.com', NULL, NULL, NULL, 'oFOO1kuHokNrnFHMZTHP4u', 1562004896, 1566996253, 1, 'admin', 'rektorat', 'Rektorat', '12424', 0, '', ''),
(6, '::1', 'ekonomi@ekonomi.com', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', NULL, 'ekonomi@ekonomi.com', NULL, NULL, NULL, 'dggqPO3Ak20f7bqgSeUeYe', 1562813018, 1566913238, 1, 'Operator', 'Ekonomi', 'Prodi Ekonomi', '12424', 16, '', ''),
(7, '::1', 'fh@fh.com', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', NULL, 'fh@fh.com', NULL, NULL, NULL, NULL, 1562813184, NULL, 1, 'Operator', 'Hukum', 'Fakultas Hukum', '12345', 17, '', '');
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `id_unit`, `foto`, `foto_nama`) VALUES
(8, '::1', 'dekanekonomi@ekonomi.com', '$2y$08$QaqSOi5n9W7H2KAPbcw0yuLq6ahAUK2XVSnKKMWuPuhmWs3Mb0FdW', NULL, 'dekanekonomi@ekonomi.com', NULL, NULL, NULL, NULL, 1563138912, 1566877954, 1, 'Dekan', 'Ekonomi', 'Dekan Prodi Ekonomi', '123344', 16, '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', 'bioflok-bartim-696x522.jpg');
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `id_unit`, `foto`, `foto_nama`) VALUES
(9, '::1', 'a@rektorat.com', '$2y$08$nFtcCH5MsPydkpt4V0DdTu5g1rH7YeccTcJhY1OwH8.hr7RTzT21O', NULL, 'a@rektorat.com', NULL, NULL, NULL, NULL, 1566121035, 1566877970, 1, 'A', 'B', 'Rektorat', 'admin@admin.com', 0, '', '');

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
(43, 1, 1),
(41, 2, 4),
(39, 5, 2),
(42, 6, 4),
(36, 7, 4),
(45, 8, 3),
(47, 9, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id_bulan`);

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
  ADD PRIMARY KEY (`id_realisasi`),
  ADD KEY `id_bulan` (`id_bulan`),
  ADD KEY `id_subkomponen` (`id_subkomponen`);

--
-- Indexes for table `setting_waktu`
--
ALTER TABLE `setting_waktu`
  ADD PRIMARY KEY (`id_setting_waktu`);

--
-- Indexes for table `set_unit_chart`
--
ALTER TABLE `set_unit_chart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_komponen`
--
ALTER TABLE `sub_komponen`
  ADD PRIMARY KEY (`id_subkomponen`),
  ADD KEY `id_komponen` (`id_komponen`);

--
-- Indexes for table `tahun`
--
ALTER TABLE `tahun`
  ADD PRIMARY KEY (`id_tahun`);

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
-- AUTO_INCREMENT for table `bulan`
--
ALTER TABLE `bulan`
  MODIFY `id_bulan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_kegiatan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `komponen`
--
ALTER TABLE `komponen`
  MODIFY `id_komponen` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `menu_type`
--
ALTER TABLE `menu_type`
  MODIFY `id_menu_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `realisasi`
--
ALTER TABLE `realisasi`
  MODIFY `id_realisasi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=373;

--
-- AUTO_INCREMENT for table `setting_waktu`
--
ALTER TABLE `setting_waktu`
  MODIFY `id_setting_waktu` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `set_unit_chart`
--
ALTER TABLE `set_unit_chart`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_komponen`
--
ALTER TABLE `sub_komponen`
  MODIFY `id_subkomponen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `tahun`
--
ALTER TABLE `tahun`
  MODIFY `id_tahun` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD CONSTRAINT `kegiatan_ibfk_1` FOREIGN KEY (`kode_m_dat`) REFERENCES `m_dat` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komponen`
--
ALTER TABLE `komponen`
  ADD CONSTRAINT `komponen_ibfk_1` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id_kegiatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `realisasi`
--
ALTER TABLE `realisasi`
  ADD CONSTRAINT `realisasi_ibfk_2` FOREIGN KEY (`id_bulan`) REFERENCES `bulan` (`id_bulan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `realisasi_ibfk_3` FOREIGN KEY (`id_subkomponen`) REFERENCES `sub_komponen` (`id_subkomponen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_komponen`
--
ALTER TABLE `sub_komponen`
  ADD CONSTRAINT `sub_komponen_ibfk_1` FOREIGN KEY (`id_komponen`) REFERENCES `komponen` (`id_komponen`) ON DELETE CASCADE ON UPDATE CASCADE;

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
