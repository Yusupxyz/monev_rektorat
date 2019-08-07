-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Aug 07, 2019 at 09:04 AM
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
(1, 92),
(2, 92),
(1, 91),
(2, 91),
(1, 90),
(2, 90),
(3, 90),
(4, 90),
(1, 94),
(2, 94),
(3, 94),
(4, 94),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(1, 95),
(2, 95),
(1, 93),
(2, 93);

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
(34, '042.01.01', '-', '-', 910375000, 0, 0, 0, 15, 1),
(35, '5742', '-', '-', 910375000, 0, 0, 0, 15, 1),
(36, '5742.001', '14300', 'Mahasiswa', 642375000, 0, 0, 0, 15, 1),
(37, '5742.001.002', '-', '-', 642375000, 0, 0, 0, 15, 1),
(38, '5742.002', '1', 'Layanan', 268000000, 0, 0, 0, 15, 1),
(55, '042.01.01', '-', '-', 483865000, 20, 3, 100000, 16, 1),
(56, '5742', '-', '-', 483865000, 20, 3, 100000, 16, 1),
(57, '5742.001', '-', '-', 399865000, 20, 3, 100000, 16, 1),
(59, '5742.001.002', '-', '-', 399865000, 20, 3, 100000, 16, 1),
(60, '5742.002', '-', '-', 84000000, 0, 0, 0, 16, 1),
(63, '042.01.01', '-', '-', 0, 0, 0, 0, 17, 1),
(64, '5742', '-', '-', 0, 0, 0, 0, 17, 1),
(65, '042.01.01', '-', '-', 0, 0, 0, 0, 19, 1),
(66, '2642', '-', '-', 0, 0, 0, 0, 19, 1),
(67, '2642.001', '-', '-', 0, 0, 0, 0, 19, 1),
(68, '2642.002.001', '-', '-', 0, 0, 0, 0, 19, 1),
(69, '042.01.01', '-', '-', 1184900000, 0, 0, 0, 32, 1),
(70, '2642', '-', '-', 1184900000, 0, 0, 0, 32, 1),
(71, '2642.001', '-', '-', 1184900000, 0, 0, 0, 32, 1),
(72, '2642.001.001', '-', '-', 1184900000, 0, 0, 0, 32, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_rektorat`
--

CREATE TABLE `kegiatan_rektorat` (
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
-- Dumping data for table `kegiatan_rektorat`
--

INSERT INTO `kegiatan_rektorat` (`id_kegiatan`, `kode_m_dat`, `volume`, `satuan`, `jumlah`, `rencana_capaian`, `capaian`, `jumlah_capaian`, `id_unit`, `id_tahun`) VALUES
(1, '042.01.01', '-', '-', 0, 16, 10, 100000, 0, 1),
(3, '2642', '-', '-', 0, 16, 10, 100000, 0, 1),
(5, '2642.001', '-', '-', 0, 16, 10, 100000, 0, 1),
(6, '2642.001.001', '-', '-', 0, 26, 10, 100000, 0, 1);

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
(1, 37, '051', 'Penerimaan Mahasiswa Baru', '-', '-', 60000000, 0, 0, 0),
(2, 37, '052', 'Proses Belajar Mengajar', '-', '-', 582375000, 0, 0, 0),
(3, 38, '051', 'Penyelenggaraan Operasional Perkantoran\r\n', '-', '-', 268000000, 0, 0, 0),
(5, 59, '051', 'Penerimaan Mahasiswa Baru', '-', '-', 20000000, 15, 3, 100000),
(6, 59, '052', 'Proses Belajar Mengajar\r\n', '-', '-', 326925000, 0, 0, 0),
(7, 37, '057', 'Administrasi Pendidikan\r\n', '-', '-', 0, 0, 0, 0),
(8, 37, '053', 'Wisuda dan Yudisium\r\n', '-', '-', 0, 0, 0, 0),
(9, 59, '053', 'Wisuda dan Yudisium\r\n', '-', '-', 52940000, 5, 0, 0),
(10, 60, '056', 'Penerbitan Jurnal\r\n', '-', '-', 84000000, 0, 0, 0),
(11, 67, 'Q', 'Q', '-', '-', 0, 0, 0, 0),
(12, 72, '051', 'Operasional dan Pemeliharaan Perkantoran\r\n', '-', '-', 1184900000, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `komponen_rektorat`
--

CREATE TABLE `komponen_rektorat` (
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
-- Dumping data for table `komponen_rektorat`
--

INSERT INTO `komponen_rektorat` (`id_komponen`, `id_kegiatan`, `kode_komponen`, `uraian_kegiatan`, `volume`, `satuan`, `jumlah`, `rencana_capaian`, `capaian`, `jumlah_capaian`) VALUES
(1, 6, '051', 'asas', '-', '-', 0, 22, 10, 100000),
(2, 6, '052', 'as', 's', 's', 0, 4, 0, 0);

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

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(4, '::1', 'admin@admin', 1565159976);

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
(40, 6, 1, 0, 'empty', 'SETTING', '#', '#', 1),
(42, 10, 2, 40, 'fas fa-users-cog', 'User', '#', '1', 1),
(43, 11, 3, 42, 'fas fa-angle-double-right', 'Users', 'users', '1', 1),
(44, 12, 3, 42, 'fas fa-angle-double-right', 'Groups', 'groups', '2', 1),
(89, 8, 2, 40, 'fas fa-th-list', 'Menu Type', 'menu_type', 'menu_type', 1),
(90, 2, 1, 0, 'empty', 'UTAMA', '#', '#', 1),
(91, 4, 2, 90, 'fas fa-building', 'Unit Kerja', 'unit', '1', 1),
(92, 5, 2, 90, 'fab fa-cc-mastercard', 'Master Data', 'M_dat', '1', 1),
(93, 1, 2, 90, 'fas fa-database', 'Atur Tahun', 'tahun', '1', 1),
(94, 3, 2, 90, 'fas fa-align-right', 'Capaian & Realisasi', 'kegiatan', '1', 1),
(95, 2, 2, 90, 'far fa-calendar-alt', 'Atur Perwaktuan', 'setting_waktu', '1', 1);

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
(1, 1, 12, 16, 5, '-', 1, 100000, '-', '-', '-'),
(2, 2, 12, 16, 10, '-', 2, 0, '-', '-', '-'),
(3, 3, 12, 16, 0, '-', 0, 0, '-', '-', '-'),
(4, 4, 12, 16, 0, '-', 0, 0, '-', '-', '-'),
(5, 5, 12, 16, 0, '-', 0, 0, '-', '-', '-'),
(6, 6, 12, 16, 0, '-', 0, 0, '-', '-', '-'),
(7, 7, 12, 16, 0, '-', 0, 0, '-', '-', '-'),
(8, 8, 12, 16, 0, '-', 0, 0, '-', '-', '-'),
(9, 9, 12, 16, 0, '-', 0, 0, '-', '-', '-'),
(10, 10, 12, 16, 0, '-', 0, 0, '-', '-', '-'),
(11, 11, 12, 16, 0, '-', 0, 0, '-', '-', '-'),
(12, 12, 12, 16, 0, '-', 0, 0, '-', '-', '-'),
(13, 1, 13, 16, 0, '-', 0, 0, '-', '-', '-'),
(14, 2, 13, 16, 0, '-', 0, 0, '-', '-', '-'),
(15, 3, 13, 16, 0, '-', 0, 0, '-', '-', '-'),
(16, 4, 13, 16, 0, '-', 0, 0, '-', '-', '-'),
(17, 5, 13, 16, 0, '-', 0, 0, '-', '-', '-'),
(18, 6, 13, 16, 0, '-', 0, 0, '-', '-', '-'),
(19, 7, 13, 16, 0, '-', 0, 0, '-', '-', '-'),
(20, 8, 13, 16, 0, '-', 0, 0, '-', '-', '-'),
(21, 9, 13, 16, 0, '-', 0, 0, '-', '-', '-'),
(22, 10, 13, 16, 0, '-', 0, 0, '-', '-', '-'),
(23, 11, 13, 16, 0, '-', 0, 0, '-', '-', '-'),
(24, 12, 13, 16, 0, '-', 0, 0, '-', '-', '-'),
(25, 1, 14, 16, 5, '-', 0, 0, '-', '-', '-'),
(26, 2, 14, 16, 0, '-', 0, 0, '-', '-', '-'),
(27, 3, 14, 16, 0, '-', 0, 0, '-', '-', '-'),
(28, 4, 14, 16, 0, '-', 0, 0, '-', '-', '-'),
(29, 5, 14, 16, 0, '-', 0, 0, '-', '-', '-'),
(30, 6, 14, 16, 0, '-', 0, 0, '-', '-', '-'),
(31, 7, 14, 16, 0, '-', 0, 0, '-', '-', '-'),
(32, 8, 14, 16, 0, '-', 0, 0, '-', '-', '-'),
(33, 9, 14, 16, 0, '-', 0, 0, '-', '-', '-'),
(34, 10, 14, 16, 0, '-', 0, 0, '-', '-', '-'),
(35, 11, 14, 16, 0, '-', 0, 0, '-', '-', '-'),
(36, 12, 14, 16, 0, '-', 0, 0, '-', '-', '-'),
(37, 1, 15, 16, 0, '-', 0, 0, '-', '-', '-'),
(38, 2, 15, 16, 0, '-', 0, 0, '-', '-', '-'),
(39, 3, 15, 16, 0, '-', 0, 0, '-', '-', '-'),
(40, 4, 15, 16, 0, '-', 0, 0, '-', '-', '-'),
(41, 5, 15, 16, 0, '-', 0, 0, '-', '-', '-'),
(42, 6, 15, 16, 0, '-', 0, 0, '-', '-', '-'),
(43, 7, 15, 16, 0, '-', 0, 0, '-', '-', '-'),
(44, 8, 15, 16, 0, '-', 0, 0, '-', '-', '-'),
(45, 9, 15, 16, 0, '-', 0, 0, '-', '-', '-'),
(46, 10, 15, 16, 0, '-', 0, 0, '-', '-', '-'),
(47, 11, 15, 16, 0, '-', 0, 0, '-', '-', '-'),
(48, 12, 15, 16, 0, '-', 0, 0, '-', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `realisasi_rektorat`
--

CREATE TABLE `realisasi_rektorat` (
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
-- Dumping data for table `realisasi_rektorat`
--

INSERT INTO `realisasi_rektorat` (`id_realisasi`, `id_bulan`, `id_subkomponen`, `id_unit`, `rencana_capaian`, `ukuran_keberhasilan`, `realisasi_capaian`, `realisasi_jumlah`, `uraian_hasil`, `kendala`, `keterangan`) VALUES
(1, 1, 1, 0, 5, '-', 5, 0, '-', '-', '-'),
(2, 2, 1, 0, 0, '-', 0, 0, '-', '-', '-'),
(3, 3, 1, 0, 0, '-', 0, 0, '-', '-', '-'),
(4, 4, 1, 0, 0, '-', 0, 0, '-', '-', '-'),
(5, 5, 1, 0, 0, '-', 0, 0, '-', '-', '-'),
(6, 6, 1, 0, 0, '-', 0, 0, '-', '-', '-'),
(7, 7, 1, 0, 0, '-', 0, 0, '-', '-', '-'),
(8, 8, 1, 0, 0, '-', 0, 0, '-', '-', '-'),
(9, 9, 1, 0, 0, '-', 0, 0, '-', '-', '-'),
(10, 10, 1, 0, 0, '-', 0, 0, '-', '-', '-'),
(11, 11, 1, 0, 0, '-', 0, 0, '-', '-', '-'),
(12, 12, 1, 0, 0, '-', 0, 0, '-', '-', '-'),
(13, 1, 2, 0, 2, '-', 2, 0, '-', '-', '-'),
(14, 2, 2, 0, 0, '-', 0, 0, '-', '-', '-'),
(15, 3, 2, 0, 0, '-', 0, 0, '-', '-', '-'),
(16, 4, 2, 0, 0, '-', 0, 0, '-', '-', '-'),
(17, 5, 2, 0, 0, '-', 0, 0, '-', '-', '-'),
(18, 6, 2, 0, 0, '-', 0, 0, '-', '-', '-'),
(19, 7, 2, 0, 0, '-', 0, 0, '-', '-', '-'),
(20, 8, 2, 0, 0, '-', 0, 0, '-', '-', '-'),
(21, 9, 2, 0, 0, '-', 0, 0, '-', '-', '-'),
(22, 10, 2, 0, 0, '-', 0, 0, '-', '-', '-'),
(23, 11, 2, 0, 0, '-', 0, 0, '-', '-', '-'),
(24, 12, 2, 0, 0, '-', 0, 0, '-', '-', '-'),
(25, 1, 4, 0, 0, '-', 0, 0, '-', '-', '-'),
(26, 2, 4, 0, 0, '-', 0, 0, '-', '-', '-'),
(27, 3, 4, 0, 0, '-', 0, 0, '-', '-', '-'),
(28, 4, 4, 0, 0, '-', 0, 0, '-', '-', '-'),
(29, 5, 4, 0, 0, '-', 0, 0, '-', '-', '-'),
(30, 6, 4, 0, 0, '-', 0, 0, '-', '-', '-'),
(31, 7, 4, 0, 0, '-', 0, 0, '-', '-', '-'),
(32, 8, 4, 0, 0, '-', 0, 0, '-', '-', '-'),
(33, 9, 4, 0, 0, '-', 0, 0, '-', '-', '-'),
(34, 10, 4, 0, 0, '-', 0, 0, '-', '-', '-'),
(35, 11, 4, 0, 0, '-', 0, 0, '-', '-', '-'),
(36, 12, 4, 0, 0, '-', 0, 0, '-', '-', '-'),
(37, 1, 3, 0, 4, '-', 0, 0, '-', '-', '-'),
(38, 2, 3, 0, 0, '-', 0, 0, '-', '-', '-'),
(39, 3, 3, 0, 0, '-', 0, 0, '-', '-', '-'),
(40, 4, 3, 0, 0, '-', 0, 0, '-', '-', '-'),
(41, 5, 3, 0, 0, '-', 0, 0, '-', '-', '-'),
(42, 6, 3, 0, 0, '-', 0, 0, '-', '-', '-'),
(43, 7, 3, 0, 0, '-', 0, 0, '-', '-', '-'),
(44, 8, 3, 0, 0, '-', 0, 0, '-', '-', '-'),
(45, 9, 3, 0, 0, '-', 0, 0, '-', '-', '-'),
(46, 10, 3, 0, 0, '-', 0, 0, '-', '-', '-'),
(47, 11, 3, 0, 0, '-', 0, 0, '-', '-', '-'),
(48, 12, 3, 0, 0, '-', 0, 0, '-', '-', '-');

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
(5, 'Waktu Pengisian Rencana Capaian', '2019-07-20', '2019-09-05'),
(7, 'Waktu Pengisian Realisasi Capaian Fisik', '2019-08-22', '2019-09-14');

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
(12, 5, 'DA', 'Pengenalan Kehidupan Kampus Bagi Mahasiswa Baru (PKKMB)\r\n', '-', '-', 20000000, 15, 3, 100000),
(13, 6, 'DA', 'Ujian Tengah dan Ujian Akhir Semester Fakultas Ekonomi dan Bisnis\r\n', '-', '-', 326925000, 0, 0, 0),
(14, 9, 'DA', 'Yudisium dan Pelepasan Alumni Mahasiswa Fakultas Ekonomi dan Bisnis\r\n', '-', '-', 52940000, 5, 0, 0),
(15, 10, 'DA', 'Publikasi Ilmiah Bagi Dosen 3 Jurusan di FEB\r\n', '-', '-', 84000000, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sub_komponen_rektorat`
--

CREATE TABLE `sub_komponen_rektorat` (
  `id_subkomponen` int(5) NOT NULL,
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
-- Dumping data for table `sub_komponen_rektorat`
--

INSERT INTO `sub_komponen_rektorat` (`id_subkomponen`, `id_komponen`, `kode_subkomponen`, `uraian_kegiatan`, `volume`, `satuan`, `jumlah`, `rencana_capaian`, `capaian`, `jumlah_capaian`) VALUES
(1, 1, 'EA', 'sd', 'd', 'd', 522550000, 5, 5, 0),
(2, 1, 'EB', 'dd', '-', '-', 522550000, 2, 2, 0),
(3, 2, 'EB', 'ss', 's', '-', 522550000, 4, 0, 0),
(4, 1, 'EA', 's', 's', '-', 0, 0, 0, 0);

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
  `id_unit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `id_unit`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', 'm0vyKu2zW7L8PTG20bquF.707e055aeea8a30aca', 1541329145, 'XfERkEq7bkuTwbgQGlGLFe', 1268889823, 1565159985, 1, 'Admin', 'istratorr', 'ADMIN', '0', 0),
(2, '127.0.0.1', 'member', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'member@member.com', '', 'm0vyKu2zW7L8PTG20bquF.707e055aeea8a30aca', 1541329145, 'lHtbqmxsnla1izZ5LcXd9O', 1268889823, 1563305013, 1, 'Operator', 'Fisip', 'Prodi', '0', 18),
(5, '::1', 'admin12@admin.com', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', NULL, 'admin12@admin.com', NULL, NULL, NULL, 'oFOO1kuHokNrnFHMZTHP4u', 1562004896, 1565158480, 1, 'admin', 'rektorat', 'Prodi', '12424', 0),
(6, '::1', 'yusufxyz114@gmail.com', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', NULL, 'yusufxyz114@gmail.com', NULL, NULL, NULL, 'dggqPO3Ak20f7bqgSeUeYe', 1562813018, 1565159586, 1, 'Operator', 'Ekonomi', 'Prodi Ekonomi', '12424', 16),
(7, '::1', 'fh@fh.com', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', NULL, 'fh@fh.com', NULL, NULL, NULL, NULL, 1562813184, NULL, 1, 'Operator', 'Hukum', 'Fakultas Hukum', '12345', 17),
(8, '::1', 'wn@mail.com', '$2y$08$LyBlida.clkVxc1OXyqn9ujaslxF7EUml/Qu.4oKhHNvJy8keC.1K', NULL, 'wn@mail.com', NULL, NULL, NULL, NULL, 1563138912, 1565158464, 1, 'Waluya', 'N', 'Prodi', '1', 16);

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
(45, 8, 3);

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
-- Indexes for table `kegiatan_rektorat`
--
ALTER TABLE `kegiatan_rektorat`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `komponen`
--
ALTER TABLE `komponen`
  ADD PRIMARY KEY (`id_komponen`),
  ADD KEY `id_kegiatan` (`id_kegiatan`);

--
-- Indexes for table `komponen_rektorat`
--
ALTER TABLE `komponen_rektorat`
  ADD PRIMARY KEY (`id_komponen`);

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
-- Indexes for table `realisasi_rektorat`
--
ALTER TABLE `realisasi_rektorat`
  ADD PRIMARY KEY (`id_realisasi`);

--
-- Indexes for table `setting_waktu`
--
ALTER TABLE `setting_waktu`
  ADD PRIMARY KEY (`id_setting_waktu`);

--
-- Indexes for table `sub_komponen`
--
ALTER TABLE `sub_komponen`
  ADD PRIMARY KEY (`id_subkomponen`),
  ADD KEY `id_komponen` (`id_komponen`);

--
-- Indexes for table `sub_komponen_rektorat`
--
ALTER TABLE `sub_komponen_rektorat`
  ADD PRIMARY KEY (`id_subkomponen`);

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
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_kegiatan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `kegiatan_rektorat`
--
ALTER TABLE `kegiatan_rektorat`
  MODIFY `id_kegiatan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `komponen`
--
ALTER TABLE `komponen`
  MODIFY `id_komponen` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `komponen_rektorat`
--
ALTER TABLE `komponen_rektorat`
  MODIFY `id_komponen` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `menu_type`
--
ALTER TABLE `menu_type`
  MODIFY `id_menu_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `realisasi`
--
ALTER TABLE `realisasi`
  MODIFY `id_realisasi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `realisasi_rektorat`
--
ALTER TABLE `realisasi_rektorat`
  MODIFY `id_realisasi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `setting_waktu`
--
ALTER TABLE `setting_waktu`
  MODIFY `id_setting_waktu` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sub_komponen`
--
ALTER TABLE `sub_komponen`
  MODIFY `id_subkomponen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sub_komponen_rektorat`
--
ALTER TABLE `sub_komponen_rektorat`
  MODIFY `id_subkomponen` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

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
-- Constraints for table `realisasi`
--
ALTER TABLE `realisasi`
  ADD CONSTRAINT `realisasi_ibfk_2` FOREIGN KEY (`id_bulan`) REFERENCES `bulan` (`id_bulan`),
  ADD CONSTRAINT `realisasi_ibfk_3` FOREIGN KEY (`id_subkomponen`) REFERENCES `sub_komponen` (`id_subkomponen`);

--
-- Constraints for table `sub_komponen`
--
ALTER TABLE `sub_komponen`
  ADD CONSTRAINT `sub_komponen_ibfk_1` FOREIGN KEY (`id_komponen`) REFERENCES `komponen` (`id_komponen`);

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
