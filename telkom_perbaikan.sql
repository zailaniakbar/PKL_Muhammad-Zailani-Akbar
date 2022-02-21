-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jan 2022 pada 04.26
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `telkom_perbaikan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ganti_ont`
--

CREATE TABLE `ganti_ont` (
  `id` int(11) NOT NULL,
  `ont_baru_id` int(11) DEFAULT NULL,
  `sn_lama` varchar(100) DEFAULT NULL,
  `tgl_ganti` date DEFAULT NULL,
  `ket` text DEFAULT NULL,
  `pengaduan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ganti_ont`
--

INSERT INTO `ganti_ont` (`id`, `ont_baru_id`, `sn_lama`, `tgl_ganti`, `ket`, `pengaduan_id`) VALUES
(2, 2, '12', '2021-12-15', '1', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ganti_stb`
--

CREATE TABLE `ganti_stb` (
  `id` int(11) NOT NULL,
  `stb_baru_id` int(11) DEFAULT NULL,
  `sn_lama` varchar(100) DEFAULT NULL,
  `tgl_ganti` date DEFAULT NULL,
  `ket` text DEFAULT NULL,
  `pengaduan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ganti_stb`
--

INSERT INTO `ganti_stb` (`id`, `stb_baru_id`, `sn_lama`, `tgl_ganti`, `ket`, `pengaduan_id`) VALUES
(2, 9, 'aa', '2021-12-01', 'abcv', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `no_hp` varchar(25) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `tim` varchar(100) DEFAULT NULL,
  `area` varchar(10) DEFAULT NULL,
  `foto` varchar(250) DEFAULT NULL,
  `username` varchar(150) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id`, `nama`, `nik`, `no_hp`, `alamat`, `jabatan`, `tim`, `area`, `foto`, `username`, `password`) VALUES
(1, '1', '1', '1', '1', 'admin', 'bjm', 'bjm', '1', 'admin', 'admin'),
(2, 'udin', 'udin', '090', 'abc', 'teknisi', 'a', 'b', '96548Asus-Logo.png', 'teknisi', 'teknisi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `nik` varchar(150) DEFAULT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `hp` varchar(18) DEFAULT NULL,
  `tgl_daftar` date DEFAULT NULL,
  `no_internet` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `kode`, `nik`, `nama`, `alamat`, `hp`, `tgl_daftar`, `no_internet`) VALUES
(5, 'P0001', '123', 'Riky', 'Jl. Ayani', '123', NULL, NULL),
(6, 'P0002', 'pelanggan', 'Dino', 'Jl. Ayani', '0822448533', NULL, '123'),
(7, 'P0003', '4666', 'Hanif', 'Banjarmasin', '0821445575', NULL, '213'),
(8, 'P0004', '4666', 'Udin', 'Palembang', '0822575577', NULL, '22'),
(9, 'P0005', '111', 'Adi', 'Jakarta', '0821755671', NULL, NULL),
(10, 'P0006', '111', 'Usai', 'Jakarta', '0821755671', NULL, NULL),
(11, 'P0007', '111', 'Rizk', 'Jakarta', '0821755671', NULL, NULL),
(13, 'P0008', '22', '22', '22', '22', '2021-12-16', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` int(11) NOT NULL,
  `pelanggan_id` int(11) DEFAULT NULL,
  `no_tiket` varchar(50) NOT NULL,
  `kat_layanan` varchar(150) DEFAULT NULL,
  `kat_gangguan` varchar(150) DEFAULT NULL,
  `keluhan` text DEFAULT NULL,
  `tgl_pengaduan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengaduan`
--

INSERT INTO `pengaduan` (`id`, `pelanggan_id`, `no_tiket`, `kat_layanan`, `kat_gangguan`, `keluhan`, `tgl_pengaduan`) VALUES
(4, 7, 'IN00001', 'INTERNET', 'UNDERSPEK', 'rusak ok', '2021-12-30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perbaikan`
--

CREATE TABLE `perbaikan` (
  `id` int(11) NOT NULL,
  `pengaduan_id` int(11) NOT NULL,
  `teknisi_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `foto` varchar(250) DEFAULT NULL,
  `tgl_rencana_perbaikan` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `perbaikan`
--

INSERT INTO `perbaikan` (`id`, `pengaduan_id`, `teknisi_id`, `status`, `foto`, `tgl_rencana_perbaikan`, `tgl_selesai`, `keterangan`) VALUES
(1, 4, 2, 'ON PROGRESS', NULL, '2021-12-23', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_ont`
--

CREATE TABLE `stok_ont` (
  `id` int(11) NOT NULL,
  `tipe` varchar(150) DEFAULT NULL,
  `sn` varchar(150) DEFAULT NULL,
  `status` enum('0','1') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `stok_ont`
--

INSERT INTO `stok_ont` (`id`, `tipe`, `sn`, `status`) VALUES
(2, 'aa', 'bb', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_stb`
--

CREATE TABLE `stok_stb` (
  `id` int(11) NOT NULL,
  `tipe` varchar(150) DEFAULT NULL,
  `sn` varchar(150) DEFAULT NULL,
  `status` enum('0','1') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `stok_stb`
--

INSERT INTO `stok_stb` (`id`, `tipe`, `sn`, `status`) VALUES
(8, 'NOKIA', '9912', '0'),
(9, 'abc', '9912', '0'),
(10, 'aaa', '11', '1'),
(12, '22', 'bb', NULL),
(13, '98', 'kj', NULL),
(14, 'Nokia1', '9901', NULL),
(15, 'a', '222', '1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `ganti_ont`
--
ALTER TABLE `ganti_ont`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stb_baru_id` (`ont_baru_id`),
  ADD KEY `perbaikan_id` (`pengaduan_id`);

--
-- Indeks untuk tabel `ganti_stb`
--
ALTER TABLE `ganti_stb`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stb_baru_id` (`stb_baru_id`),
  ADD KEY `perbaikan_id` (`pengaduan_id`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indeks untuk tabel `perbaikan`
--
ALTER TABLE `perbaikan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengaduan_id` (`pengaduan_id`),
  ADD KEY `teknisi_id` (`teknisi_id`);

--
-- Indeks untuk tabel `stok_ont`
--
ALTER TABLE `stok_ont`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stok_stb`
--
ALTER TABLE `stok_stb`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `ganti_ont`
--
ALTER TABLE `ganti_ont`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `ganti_stb`
--
ALTER TABLE `ganti_stb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `perbaikan`
--
ALTER TABLE `perbaikan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `stok_ont`
--
ALTER TABLE `stok_ont`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `stok_stb`
--
ALTER TABLE `stok_stb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `ganti_ont`
--
ALTER TABLE `ganti_ont`
  ADD CONSTRAINT `ganti_ont_ibfk_1` FOREIGN KEY (`ont_baru_id`) REFERENCES `stok_ont` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ganti_ont_ibfk_2` FOREIGN KEY (`pengaduan_id`) REFERENCES `pengaduan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ganti_stb`
--
ALTER TABLE `ganti_stb`
  ADD CONSTRAINT `ganti_stb_ibfk_1` FOREIGN KEY (`stb_baru_id`) REFERENCES `stok_stb` (`id`),
  ADD CONSTRAINT `ganti_stb_ibfk_2` FOREIGN KEY (`pengaduan_id`) REFERENCES `pengaduan` (`id`);

--
-- Ketidakleluasaan untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD CONSTRAINT `pengaduan_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `perbaikan`
--
ALTER TABLE `perbaikan`
  ADD CONSTRAINT `perbaikan_ibfk_1` FOREIGN KEY (`pengaduan_id`) REFERENCES `pengaduan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `perbaikan_ibfk_2` FOREIGN KEY (`teknisi_id`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
