-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Sep 2021 pada 10.04
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_kp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `nip` int(25) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id`, `nip`, `nama`, `kelas`) VALUES
(2, 112233, 'Gunawan', '10'),
(3, 321321, 'Hidayat', '10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `isi_kegiatan`
--

CREATE TABLE `isi_kegiatan` (
  `id` int(10) NOT NULL,
  `tgl` varchar(20) NOT NULL,
  `nis` int(15) NOT NULL,
  `id_kegiatan` int(10) NOT NULL,
  `tindakan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `isi_kegiatan`
--

INSERT INTO `isi_kegiatan` (`id`, `tgl`, `nis`, `id_kegiatan`, `tindakan`) VALUES
(933, '02-08-2021', 123123, 15, 'Ya'),
(934, '02-08-2021', 123123, 16, 'Tidak'),
(935, '02-08-2021', 123123, 17, 'Tidak'),
(936, '02-08-2021', 123123, 18, 'Ya'),
(940, '03-08-2021', 123123, 15, 'Tidak'),
(941, '03-08-2021', 123123, 16, 'Ya'),
(942, '03-08-2022', 123123, 17, 'Ya'),
(943, '03-08-2022', 123123, 18, 'Tidak'),
(944, '02-09-2021', 123123, 15, 'Ya'),
(945, '02-09-2021', 123123, 16, 'Tidak'),
(946, '02-09-2021', 123123, 17, 'Ya'),
(947, '02-09-2021', 123123, 18, 'Ya'),
(948, '02-09-2021', 123123, 19, 'Ya'),
(949, '02-09-2021', 123123, 20, 'Ya'),
(950, '02-09-2021', 123123, 21, 'Ya'),
(951, '02-09-2021', 123123, 22, 'Ya'),
(952, '02-09-2021', 123123, 23, 'Ya'),
(953, '02-09-2021', 123123, 24, 'Ya'),
(954, '02-09-2021', 123123, 25, 'Ya'),
(955, '02-09-2021', 123123, 54, 'Ya'),
(956, '02-09-2021', 123123, 57, 'Ya'),
(957, '02-09-2021', 123123, 58, 'Ya'),
(958, '03-09-2021', 123123, 15, 'Ya'),
(959, '03-09-2021', 123123, 16, 'Ya'),
(960, '03-09-2021', 123123, 17, 'Tidak'),
(961, '03-09-2021', 123123, 18, 'Tidak'),
(962, '03-09-2021', 123123, 19, 'Tidak'),
(963, '03-09-2021', 123123, 20, 'Ya'),
(964, '03-09-2021', 123123, 21, 'Ya'),
(965, '03-09-2021', 123123, 22, 'Ya'),
(966, '03-09-2021', 123123, 23, 'Tidak'),
(967, '03-09-2021', 123123, 24, 'Tidak'),
(968, '03-09-2021', 123123, 25, 'Ya'),
(969, '03-09-2021', 123123, 54, 'Ya'),
(970, '03-09-2021', 123123, 57, 'Ya'),
(971, '03-09-2021', 123123, 58, 'Ya'),
(972, '01-09-2021', 123123, 15, 'Ya'),
(973, '01-09-2021', 123123, 16, 'Tidak'),
(974, '01-09-2021', 123123, 17, 'Tidak'),
(975, '01-09-2021', 123123, 18, 'Tidak'),
(976, '01-09-2021', 123123, 19, 'Ya'),
(977, '01-09-2021', 123123, 20, 'Ya'),
(978, '01-09-2021', 123123, 21, 'Ya'),
(979, '01-09-2021', 123123, 22, 'Ya'),
(980, '01-09-2021', 123123, 23, 'Ya'),
(981, '01-09-2021', 123123, 24, 'Tidak'),
(982, '01-09-2021', 123123, 25, 'Ya'),
(983, '01-09-2021', 123123, 54, 'Tidak'),
(984, '01-09-2021', 123123, 57, 'Tidak'),
(985, '01-09-2021', 123123, 58, 'Ya'),
(986, '06-09-2021', 123123, 15, 'Ya'),
(987, '06-09-2021', 123123, 16, 'Ya'),
(988, '06-09-2021', 123123, 17, 'Tidak'),
(989, '06-09-2021', 123123, 18, 'Tidak'),
(990, '06-09-2021', 123123, 19, 'Tidak'),
(991, '06-09-2021', 123123, 20, 'Ya'),
(992, '06-09-2021', 123123, 21, 'Ya'),
(993, '06-09-2021', 123123, 22, 'Ya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` int(10) NOT NULL,
  `nama_kegiatan` text NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `nama_kegiatan`, `ket`) VALUES
(15, 'Salat subuh dan berdoa', '-'),
(16, 'Merapikan kamar dan barang pribadi', '-'),
(17, 'Olahraga', '-'),
(18, 'Mandi pagi', '-'),
(19, 'Sarapan pagi', '-'),
(20, 'Salat dhuha', '-'),
(21, 'Pembelajaran jarak jauh \r\n', '-'),
(22, 'Freeplay', '-'),
(23, 'Salat dzuhur', '-'),
(24, 'Makan siang', '-'),
(25, 'Tidur siang', '-'),
(54, 'Baca buku', '-'),
(57, 'Salat ashar', '-'),
(58, 'Salat magrib', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id`, `nis`, `nama`, `kelas`) VALUES
(1, 123123, 'Febrian', 'IF-5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `email`, `image`, `password`, `role_id`) VALUES
(1, 'febrian@gmail.com', 'default.jpg', '$2y$10$qWAt/NDU1IcdLh3nOMbCee6PcbmrS62a43vP5dTdq3z46VwL/Yjli', 3),
(2, 'gunawan@gmail.com', 'default.jpg', '$2y$10$AXA4OsUzm0Pr60Xq1pY8y.Qaop1OiTXezT1ExsA2xb5HaHHW285Zi', 2),
(3, 'hidayat@gmail.com', 'default.jpg', '$2y$10$8B4CL8y55b0An812ubGuzOnCCbNSbNBE7FLEOm7OaOa6v8uEBieL6', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`);

--
-- Indeks untuk tabel `isi_kegiatan`
--
ALTER TABLE `isi_kegiatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nis` (`nis`),
  ADD KEY `id_kegiatan` (`id_kegiatan`);

--
-- Indeks untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nis` (`nis`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `isi_kegiatan`
--
ALTER TABLE `isi_kegiatan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=994;

--
-- AUTO_INCREMENT untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `isi_kegiatan`
--
ALTER TABLE `isi_kegiatan`
  ADD CONSTRAINT `isi_kegiatan_ibfk_1` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `isi_kegiatan_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
