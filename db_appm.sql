-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2023 at 12:23 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_appm`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_masyarakat`
--

CREATE TABLE `tb_masyarakat` (
  `id_m` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_masyarakat`
--

INSERT INTO `tb_masyarakat` (`id_m`, `nik`, `nama`, `uname`, `password`, `telp`, `created_at`) VALUES
(41615, '234322342235443', 'Raka Prihantoro', 'raka', '$2y$10$VsnbX.1/BJTzNTtAOzNBh.LZBxbxmvjGcWCCWePZFAkBTr/T26wcq', '+6285172343233', '2023-01-25'),
(55433, '234322342235443', 'Arief Prasetyo', 'arep', '$2y$10$8QtDOy6ZllAUWOxr9KF1n.UWiIdEMZZN6LFPTzUi1fRzvU7xQihUy', '+62883243235434', '2023-01-25'),
(90306, '1234324345332', 'Zaenal Arifien', 'ipen', '$2y$10$nKA2fyfBYLAaSF8rqsMPveu3a3SAgnJOGP6BHtns24IH65HG.dPVi', '+62883243235434', '2023-01-25');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengaduan`
--

CREATE TABLE `tb_pengaduan` (
  `id_p` int(11) NOT NULL,
  `id_m` int(11) NOT NULL,
  `tgl_pengaduan` date NOT NULL,
  `judul_pengaduan` varchar(50) NOT NULL,
  `isi_laporan` text NOT NULL,
  `foto` varchar(100) NOT NULL,
  `status` enum('p','a') NOT NULL COMMENT 'p = pending a = acc'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pengaduan`
--

INSERT INTO `tb_pengaduan` (`id_p`, `id_m`, `tgl_pengaduan`, `judul_pengaduan`, `isi_laporan`, `foto`, `status`) VALUES
(23414, 41615, '2023-01-21', 'terst', 'asdsdffgfdgfdgfd', 'ja.obs', 'p'),
(32564, 41615, '2023-01-23', 'Test Date', 'TEST CURDATE', 'cd.jpg', 'p');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tanggapan`
--

CREATE TABLE `tb_tanggapan` (
  `id_t` int(11) NOT NULL,
  `id_p` int(11) NOT NULL,
  `tgl_tanggapan` date NOT NULL,
  `tanggapan` text NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `uid` int(11) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `level` enum('a','p') NOT NULL COMMENT 'a = admin p = petugas',
  `created_at` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`uid`, `nama`, `uname`, `password`, `telp`, `level`, `created_at`) VALUES
(9120, 'Bima Tio Rachman', 'Petugas', '$2y$10$BpVy62Ma/IoZpscN8BCkGuPCe9pA7pYDAfC.Zl4pTQVyKyHfs43TS', '+62883243235434', 'p', '25-01-2023 16:51:19'),
(58188, 'Bima Tio Rachman', 'Admin', '$2y$10$jY1Pa92ScjCkJfAPNjIcUOVGgl5l.wAvWMdKk1BZ6CWCdNK34gvqW', '+6288802791267', 'a', '2023-01-23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_masyarakat`
--
ALTER TABLE `tb_masyarakat`
  ADD PRIMARY KEY (`id_m`);

--
-- Indexes for table `tb_pengaduan`
--
ALTER TABLE `tb_pengaduan`
  ADD PRIMARY KEY (`id_p`);

--
-- Indexes for table `tb_tanggapan`
--
ALTER TABLE `tb_tanggapan`
  ADD PRIMARY KEY (`id_t`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
