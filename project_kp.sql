-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Okt 2021 pada 09.25
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
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `nama`) VALUES
(1, 'Administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `nip` int(11) NOT NULL,
  `nama_guru` varchar(200) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `alamat` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id`, `nip`, `nama_guru`, `id_kelas`, `alamat`) VALUES
(198, 111111, 'Maman', 1, 'Jl.Mekar Sari D5 No. 10'),
(199, 222222, 'Dadang', 2, '');

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
(18, '01-10-2021', 12345, 63, 'Ya'),
(19, '01-10-2021', 12345, 65, 'Tidak'),
(20, '01-10-2021', 12345, 66, 'Tidak'),
(21, '01-10-2021', 12345, 69, 'Ya'),
(22, '01-10-2021', 12345, 70, 'Ya'),
(23, '04-10-2021', 12345, 63, 'Ya'),
(24, '04-10-2021', 12345, 65, 'Ya'),
(25, '04-10-2021', 12345, 66, 'Ya'),
(26, '04-10-2021', 12345, 69, 'Ya'),
(27, '04-10-2021', 12345, 70, 'Tidak'),
(28, '05-10-2021', 12345, 63, 'Ya'),
(29, '05-10-2021', 12345, 65, 'Tidak'),
(30, '05-10-2021', 12345, 66, 'Ya'),
(31, '05-10-2021', 12345, 69, 'Ya'),
(32, '05-10-2021', 12345, 70, 'Ya'),
(33, '06-10-2021', 12345, 63, 'Ya'),
(34, '06-10-2021', 12345, 65, 'Ya'),
(35, '06-10-2021', 12345, 66, 'Ya'),
(36, '06-10-2021', 12345, 69, 'Ya'),
(37, '06-10-2021', 12345, 70, 'Ya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` int(10) NOT NULL,
  `nama_kegiatan` text NOT NULL,
  `ket` text NOT NULL,
  `id_kelas` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `nama_kegiatan`, `ket`, `id_kelas`) VALUES
(63, 'Salat subuh', '-\r\n', 1),
(64, 'Merapihkan Kamar', '-', 2),
(65, 'Membereskan kamar tidur', '-', 1),
(66, 'Mandi pagi', '-', 1),
(67, 'Sarapan pagi', '-', 2),
(68, 'Olahraga pagi', '-', 2),
(69, 'Sarapan pagi', '-', 1),
(70, 'Olahraga', '-', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`) VALUES
(1, '1A'),
(2, '1B');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `nis` int(15) NOT NULL,
  `nama_siswa` varchar(200) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `alamat` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id`, `nis`, `nama_siswa`, `id_kelas`, `alamat`) VALUES
(200, 12345, 'Febrian', 1, 'Jl. Dipati Ukur No.19'),
(201, 12346, 'Dzikri', 2, ''),
(202, 12347, 'Abduh', 1, ''),
(203, 12348, 'Mawar', 1, ''),
(204, 12349, 'Amel', 2, ''),
(205, 12350, 'Agnes', 2, ''),
(206, 12351, 'Annisa', 1, ''),
(207, 12352, 'Ghea', 2, ''),
(208, 12353, 'Rizki', 2, ''),
(209, 12354, 'Desta', 1, '');

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
(1, 'admin@admin.com', 'default.jpg', '$2y$10$ikjZu973cHvkThxXsrZV/ONKKJ6ulms6ZOUjKYVH6BrxLCLMi2yO2', 1),
(198, 'maman@gmail.com', '198.png', '$2y$10$Fd82K8YY5lCwEDUklotwYef5.63fVlPxyckmJDL7otLi3utsQA3EO', 2),
(199, 'dadang@gmail.com', 'default.jpg', '$2y$10$wYdkC9S/2WL4b1DnC7ybcO.xbK0rTEM1bdWcWumW4XmMR.tcZDYS.', 2),
(200, 'febrian@gmail.com', '200.png', '$2y$10$nM99JIUANMWCZDrKKOgxNu2TR2IyJktA0sLPMDdNe3jeIu2GqrBsK', 3),
(201, 'dzikri@gmail.com', 'default.jpg', '$2y$10$ekweCrwOxyXHQ4sFz1MNPOdT1hfUHiQKXo5wdJvyvaIILBp4y7682', 3),
(202, 'abduh@gmail.com', 'default.jpg', '$2y$10$PJTbkYvabLJFQSGl9IKXS.uVwP4u1q/FANrJ2mmrNZlUAxN64yweS', 3),
(203, '', 'default.jpg', '', 3),
(204, '', 'default.jpg', '', 3),
(205, '', 'default.jpg', '', 3),
(206, '', 'default.jpg', '', 3),
(207, '', 'default.jpg', '', 3),
(208, '', 'default.jpg', '', 3),
(209, '', 'default.jpg', '', 3);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD KEY `id_kelas` (`id_kelas`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_guru` (`id_kelas`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nis` (`nis`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `isi_kegiatan`
--
ALTER TABLE `isi_kegiatan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `isi_kegiatan`
--
ALTER TABLE `isi_kegiatan`
  ADD CONSTRAINT `isi_kegiatan_ibfk_1` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `isi_kegiatan_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD CONSTRAINT `kegiatan_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
