-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jan 2023 pada 07.55
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.2

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
-- Struktur dari tabel `tb_masyarakat`
--

CREATE TABLE `tb_masyarakat` (
  `id_m` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `created_at` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_masyarakat`
--

INSERT INTO `tb_masyarakat` (`id_m`, `nik`, `nama`, `uname`, `password`, `telp`, `created_at`) VALUES
(1, '234345342346653', 'Bimatio', 'bim', '123', '435345435546', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengaduan`
--

CREATE TABLE `tb_pengaduan` (
  `id_p` int(11) NOT NULL,
  `id_m` int(11) NOT NULL,
  `tgl_pengaduan` varchar(30) NOT NULL,
  `judul_pengaduan` varchar(50) NOT NULL,
  `isi_laporan` text NOT NULL,
  `foto` varchar(100) NOT NULL,
  `status` enum('p','a') NOT NULL COMMENT 'p = pending a = acc'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pengaduan`
--

INSERT INTO `tb_pengaduan` (`id_p`, `id_m`, `tgl_pengaduan`, `judul_pengaduan`, `isi_laporan`, `foto`, `status`) VALUES
(34523, 1, '01-20-2023', 'Jalan Berlubang', 'Jalan xyz berlubang mohon segera perbaiki', 'pengaduan.jpg', 'p');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tanggapan`
--

CREATE TABLE `tb_tanggapan` (
  `id_t` int(11) NOT NULL,
  `id_p` int(11) NOT NULL,
  `tgl_tanggapan` varchar(35) NOT NULL,
  `tanggapan` text NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
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
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`uid`, `nama`, `uname`, `password`, `telp`, `level`, `created_at`) VALUES
(28537, 'Bima Tio Rachman', 'Adm', '$2y$10$Y/QZTn4CdfaN0GgvWXQoaOQdCLCTjcgcktbD18Akb8q1KTKLUBE.u', '+6281234', 'a', '20-01-2023 10:16:25'),
(41615, 'Zaenal Arifien', 'Ipen', '$2y$10$ViAGPsyNAOwBSgab4GUPl.m2efd9pj7Xayw9Cfz6XFgg/63jMBwMK', '+62324324324', 'p', '20-01-2023 11:26:55'),
(58188, 'Bima Tio Rachman', 'Admin', '$2y$10$jY1Pa92ScjCkJfAPNjIcUOVGgl5l.wAvWMdKk1BZ6CWCdNK34gvqW', '+6288802791267', 'a', '20-01-2023 09:41:07');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_masyarakat`
--
ALTER TABLE `tb_masyarakat`
  ADD PRIMARY KEY (`id_m`);

--
-- Indeks untuk tabel `tb_pengaduan`
--
ALTER TABLE `tb_pengaduan`
  ADD PRIMARY KEY (`id_p`);

--
-- Indeks untuk tabel `tb_tanggapan`
--
ALTER TABLE `tb_tanggapan`
  ADD PRIMARY KEY (`id_t`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
