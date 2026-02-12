-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Feb 2026 pada 10.23
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_aspirasi_ukom26`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `feedback_chat`
--

CREATE TABLE `feedback_chat` (
  `id_chat` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `pesan` text NOT NULL,
  `pengirim` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `feedback_chat`
--

INSERT INTO `feedback_chat` (`id_chat`, `user_id`, `admin_id`, `pesan`, `pengirim`, `created_at`) VALUES
(1, 3, 5, 'WOI DIN', 'admin', '2026-02-11 04:50:26'),
(2, 3, NULL, 'WOI', 'siswa', '2026-02-11 04:54:19'),
(3, 3, NULL, 'STOP PDF', 'siswa', '2026-02-11 05:00:43'),
(4, 3, 5, 'LU PDF', 'admin', '2026-02-11 05:01:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_aspirasi`
--

CREATE TABLE `tb_aspirasi` (
  `id_aspirasi` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `lokasi` varchar(50) NOT NULL,
  `isi_aspirasi` varchar(100) NOT NULL,
  `status` enum('menunggu','selesai','diproses','ditolak') DEFAULT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_aspirasi`
--

INSERT INTO `tb_aspirasi` (`id_aspirasi`, `id_user`, `id_kategori`, `lokasi`, `isi_aspirasi`, `status`, `foto`, `created_at`, `update_at`) VALUES
(1, 4, 1, 'Lapangan', 'Lapangan licin ', 'menunggu', '1770784577_BWM M5.jpg', '2026-02-11 04:36:17', '2026-02-11 04:36:17'),
(2, 3, 2, 'Lapangan', 'fgfcffcdwad', 'menunggu', '1770784937_75659a69-dd91-4bef-b83c-4ffa9bb9f1e8.jpg', '2026-02-11 04:42:17', '2026-02-11 04:42:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_feedback`
--

CREATE TABLE `tb_feedback` (
  `id_feedback` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_aspirasi` int(11) NOT NULL,
  `isi_feedback` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `ket_kategori` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `ket_kategori`, `created_at`) VALUES
(1, 'sarana', '2026-02-11 04:34:55'),
(2, 'prasarana', '2026-02-11 04:34:55'),
(3, 'Anu', '2026-02-11 06:17:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  `tahun_ajaran` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`, `tahun_ajaran`, `created_at`) VALUES
(1, 'admin', '2000/2001', '2026-02-02 08:20:35'),
(2, 'XII RPL 2', '2023/2026', '2026-02-11 04:21:43'),
(3, 'XII RPL 1', '2023/2026', '2026-02-11 04:21:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nis` varchar(15) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `jenis_kelamin` enum('P','L') NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `role` enum('admin','siswa') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nis`, `nama`, `email`, `password`, `jenis_kelamin`, `id_kelas`, `role`, `created_at`) VALUES
(2, '1', 'Rehan Elvaretta', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'L', 1, 'admin', '2026-02-02 08:26:10'),
(3, '54321', 'Sudin', 'sudin@gmail.com', '3d2c70e5b6d12643d49638e6840df320', 'L', 2, 'siswa', '2026-02-11 04:22:28'),
(4, '34526', 'Bayem', 'bayem@gmail.com', '7fd1462309b396475f08386c774d73a2', 'L', 3, 'siswa', '2026-02-11 04:27:12'),
(5, '67548', 'Lance Boti', 'lance@mlbb.com', '21232f297a57a5a743894a0e4a801fc3', 'P', 1, 'admin', '2026-02-11 04:28:07'),
(6, '325232', 'Iya', 'iya@gmail.com', '3afa0d81296a4f17d477ec823261b1ec', 'L', 3, '', '2026-02-11 08:52:23'),
(7, '72137612', 'ikan', 'augdag@gmail.com', '2fea6c02a98d6318d44cdf150775f07a', 'L', 3, 'siswa', '2026-02-11 08:59:00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `feedback_chat`
--
ALTER TABLE `feedback_chat`
  ADD PRIMARY KEY (`id_chat`);

--
-- Indeks untuk tabel `tb_aspirasi`
--
ALTER TABLE `tb_aspirasi`
  ADD PRIMARY KEY (`id_aspirasi`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_feedback`
--
ALTER TABLE `tb_feedback`
  ADD PRIMARY KEY (`id_feedback`),
  ADD KEY `id_feedback` (`id_feedback`),
  ADD KEY `id_user` (`id_user`,`id_aspirasi`),
  ADD KEY `id_aspirasi` (`id_aspirasi`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `feedback_chat`
--
ALTER TABLE `feedback_chat`
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_aspirasi`
--
ALTER TABLE `tb_aspirasi`
  MODIFY `id_aspirasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_feedback`
--
ALTER TABLE `tb_feedback`
  MODIFY `id_feedback` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_aspirasi`
--
ALTER TABLE `tb_aspirasi`
  ADD CONSTRAINT `tb_aspirasi_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_aspirasi_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_feedback`
--
ALTER TABLE `tb_feedback`
  ADD CONSTRAINT `tb_feedback_ibfk_1` FOREIGN KEY (`id_aspirasi`) REFERENCES `tb_aspirasi` (`id_aspirasi`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_feedback_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
