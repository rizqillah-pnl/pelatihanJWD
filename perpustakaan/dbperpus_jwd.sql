-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Agu 2022 pada 12.02
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbperpus_jwd`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_anggota`
--

CREATE TABLE `tb_anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jkel` enum('L','P') DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `tempat_lahir` varchar(200) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `nohp` varchar(15) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `deleted` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_buku`
--

CREATE TABLE `tb_buku` (
  `id` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `penerbit` varchar(200) NOT NULL,
  `isbn` varchar(100) DEFAULT NULL,
  `pengarang` varchar(200) NOT NULL,
  `jumlah_halaman` int(4) NOT NULL,
  `jumlah_stok` int(3) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `sinopsis` text DEFAULT NULL,
  `gambar` varchar(200) DEFAULT NULL,
  `deleted` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_peminjaman`
--

CREATE TABLE `tb_peminjaman` (
  `id` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('0','1') NOT NULL,
  `jumlah` int(1) NOT NULL,
  `buku_id` int(11) NOT NULL,
  `anggota_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deleted` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengembalian`
--

CREATE TABLE `tb_pengembalian` (
  `id` int(11) NOT NULL,
  `peminjaman_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `deleted` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hak_akses` enum('1','2') NOT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `deleted` enum('0','1') NOT NULL,
  `last_log` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `username`, `password`, `hak_akses`, `foto`, `deleted`, `last_log`) VALUES
(1, 'Administrator', 'admin', '$2y$10$B5kx6twekqxxRrZDK/lE5Og/lA6ufBWVR5b.Eyqlau/RavuA1H2Ee', '1', '23-08-2022 14-14-15Profil.jpg', '0', '2022-08-24 17:01:00'),
(2, 'rizqillah', 'rizqi', '$2y$10$fU7oIwA88dQ.ZjhsAG8qe.eow7PcixGMyUV.OHfa0Xyjyqz8hubZm', '2', 'image2.jpg', '0', '0000-00-00 00:00:00'),
(4, 'sadasdsa', 'dsadsad', 'asdasd', '1', '3.jpg', '1', '0000-00-00 00:00:00'),
(8, 'Aasd', 'aasd', '$2y$10$fO0zAGzWriqCMu28zHsrIO.cc3e/3NSJUHCJ07xVPf5VblP2hcYyW', '2', '21-08-2022 12-01-22simboljurusan.png.png', '1', '0000-00-00 00:00:00'),
(11, 'Iki', 'iki', '$2y$10$oS8JNTxJz6gJOvHB7AhTD.CRRTCXGfgn.6cI27iAP/apsrvKIVhzu', '2', '21-08-2022 13-00-11Profil.jpg.jpg', '0', '0000-00-00 00:00:00'),
(12, 'PNL', 'PNL', '$2y$10$WLxkNopER6CJB/sAKoFIAemsqfj23OY8kAnoyW.vVpdvBQnjTE2e6', '1', '24-08-2022 10-10-55logo politkenik (1).png', '0', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `tb_buku`
--
ALTER TABLE `tb_buku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buku` (`buku_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `anggota` (`anggota_id`);

--
-- Indeks untuk tabel `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjaman` (`peminjaman_id`),
  ADD KEY `user` (`user_id`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_anggota`
--
ALTER TABLE `tb_anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_buku`
--
ALTER TABLE `tb_buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD CONSTRAINT `anggota` FOREIGN KEY (`anggota_id`) REFERENCES `tb_anggota` (`id_anggota`) ON UPDATE CASCADE,
  ADD CONSTRAINT `buku` FOREIGN KEY (`buku_id`) REFERENCES `tb_buku` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  ADD CONSTRAINT `peminjaman` FOREIGN KEY (`peminjaman_id`) REFERENCES `tb_peminjaman` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
