-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Feb 2023 pada 03.26
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

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
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_masyarakat`
--

INSERT INTO `tb_masyarakat` (`id_m`, `nik`, `nama`, `uname`, `password`, `telp`, `created_at`) VALUES
(41615, '234322342235443', 'Raka Prihantoro', 'raka', '$2y$10$VsnbX.1/BJTzNTtAOzNBh.LZBxbxmvjGcWCCWePZFAkBTr/T26wcq', '+6285172343233', '2023-01-25'),
(55433, '234322342235443', 'Arief Prasetyo', 'arep', '$2y$10$8QtDOy6ZllAUWOxr9KF1n.UWiIdEMZZN6LFPTzUi1fRzvU7xQihUy', '+62883243235434', '2023-01-25'),
(56945, '33080843203212', 'Bima Tio Rachman', 'bimm', '$2y$10$A/BkjKVqjtnaaUVrxuUr0.9Xx1TiVbhIIF4C4X0lJ8x1p.hR5ITce', '+6288802791267', '2023-02-03'),
(90306, '1234324345332', 'Zaenal Arifien', 'ipen', '$2y$10$nKA2fyfBYLAaSF8rqsMPveu3a3SAgnJOGP6BHtns24IH65HG.dPVi', '+62883243235434', '2023-01-25'),
(90965, '532680', 'Andi', 'andi', '$2y$10$13yolzfMXJUqoE1v3th62eDlxMBfSQjlHn8Zs/ewZOt0/YvdRmFNW', '236784', '2023-02-06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengaduan`
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
-- Dumping data untuk tabel `tb_pengaduan`
--

INSERT INTO `tb_pengaduan` (`id_p`, `id_m`, `tgl_pengaduan`, `judul_pengaduan`, `isi_laporan`, `foto`, `status`) VALUES
(18292, 56945, '2023-02-03', 'Asdasdasdasdasdasd', '<p>aasdasd<b>sadasdasdasdasdassdassd<u>asdasdasdasdasd</u></b></p>', 'laporan0294.png', 'a'),
(20325, 41615, '2023-02-06', 'Jembatan Roboh', '<p>jembatan Ngarepan Ambruk&nbsp;&nbsp;&nbsp;&nbsp;</p>', 'laporan1534.png', 'a'),
(24791, 56945, '2023-02-03', 'Ipen Turu', '&lt;p&gt;ipen Turu Nang Banyu&amp;nbsp;&lt;/p&gt;', 'laporan9300.jpg', 'a'),
(47063, 41615, '2023-02-03', 'Turu Deeckkkkkk', '<p>Dfyhfj</p>', 'laporan8601.png', 'a'),
(56602, 90965, '2023-02-06', 'Erhje', '<p>heuis</p>', 'laporan6035.png', 'a'),
(79527, 90306, '2023-02-03', 'Sadasdasdasdasd', '&lt;p&gt;asdasdasd&lt;/p&gt;', 'laporan5210.png', 'a'),
(96392, 41615, '2023-02-03', 'Asdasdasdasdasdasd', '<p>asdasdassdasd</p>', 'laporan3063.png', 'a');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_setting`
--

CREATE TABLE `tb_setting` (
  `nama_web` varchar(100) NOT NULL,
  `slogan` text NOT NULL,
  `singkatan` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `logo` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_setting`
--

INSERT INTO `tb_setting` (`nama_web`, `slogan`, `singkatan`, `deskripsi`, `logo`, `updated_at`) VALUES
('Aplikasi Pelaporan Pengaduan Masyarakat', '', 'APPM', '<b>APPM adalah APLIKASI PELAPORAN PENGADUAN BERBASIS WEBSITE&nbsp;</b>,yang dapat memudahkan anda jika disekitar anda terdapat masalah yang bisa dilaporkan!\r\n\r\n', 'logo8875.png', '2023-02-06 02:09:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tanggapan`
--

CREATE TABLE `tb_tanggapan` (
  `id_t` int(11) NOT NULL,
  `id_p` int(11) NOT NULL,
  `tgl_tanggapan` date NOT NULL,
  `tanggapan` text NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_tanggapan`
--

INSERT INTO `tb_tanggapan` (`id_t`, `id_p`, `tgl_tanggapan`, `tanggapan`, `uid`) VALUES
(31229, 56602, '2023-02-06', '<p>hujjugtghhjjk</p><p><br></p>', 58188),
(36174, 47063, '2023-02-03', '<p>ygyfgygyg</p>', 58188),
(44920, 18292, '2023-02-03', '<p>asdasdasd</p>', 58188),
(57351, 20325, '2023-02-06', '<p><b>OTW BANTER</b></p>', 41615),
(77976, 24791, '2023-02-03', '<p>Kon Tangi</p>', 58188),
(88938, 96392, '2023-02-06', '<p>OTW BANTER</p>', 58188),
(96573, 79527, '2023-02-03', '<p>asda</p>', 58188);

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
(9120, 'Bima Tio Rachman', 'Petugas', '$2y$10$BpVy62Ma/IoZpscN8BCkGuPCe9pA7pYDAfC.Zl4pTQVyKyHfs43TS', '+62883243235434', 'p', '25-01-2023 16:51:19'),
(58188, 'Bim', 'Adm', '$2y$10$jY1Pa92ScjCkJfAPNjIcUOVGgl5l.wAvWMdKk1BZ6CWCdNK34gvqW', '088802781213', 'a', '2023-01-23');

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
