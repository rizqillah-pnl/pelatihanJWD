-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Agu 2022 pada 07.17
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
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_anggota`
--

INSERT INTO `tb_anggota` (`id_anggota`, `nama`, `jkel`, `email`, `tgl_lahir`, `tempat_lahir`, `alamat`, `nohp`, `foto`, `status`) VALUES
(1, 'Rizqillah', 'L', NULL, NULL, NULL, 'Jl. Blang Mee, No. 33, Desa Ujong, Kec. Samudera, Kab. Aceh Utara, Aceh 24374', '082165517433', '12-08-2022 12-12-47DFD - Project BPS.drawio (4).png.png', NULL),
(3, 'Rahmaini Salsabila Sari', 'P', NULL, NULL, NULL, 'Asrama Poltek Lhokseumawe', '081145321452120', '12-08-2022 13-34-51ERD.drawio (2).png.png', NULL),
(4, 'Rizky Fahlevi', 'L', NULL, NULL, NULL, 'Jl. Panglateh', '054171724', '12-08-2022 13-48-28DFD - Project BPS.drawio (4).png.png', NULL),
(8, 'Sadasd', 'P', NULL, NULL, NULL, 'sadasd', '35345', '12-08-2022 14-08-18IMG-20220707-WA0010.jpg.jpg', NULL),
(14, 'Nursella Indah Armaya', 'P', NULL, NULL, NULL, 'sadsadsad', '082165517433', '16-08-2022 11-00-05991px-Lambang_Badan_Pusat_Statistik_(BPS)_Indonesia.svg.png.png', NULL),
(16, 'Dasasd', 'P', NULL, NULL, NULL, 'dadad', '242343', '19-08-2022 10-56-21banner keyvisual_VSGA-01.png.png', NULL);

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
  `gambar` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_buku`
--

INSERT INTO `tb_buku` (`id`, `judul`, `penerbit`, `isbn`, `pengarang`, `jumlah_halaman`, `jumlah_stok`, `tahun_terbit`, `sinopsis`, `gambar`) VALUES
(1, 'AI', 'Aku', '21894-13321-112331', 'Adasjhjadasdas', 83, 40, 2017, 'Dadasdjhajsdas', '19-08-2022 11-49-40RIZQILLAH.png.png'),
(4, 'Asdas', 'Jhhasjd', '7872', '66767', 66, 667, 0000, '667766', '19-08-2022 11-18-50banner keyvisual_VSGA-01.png.png'),
(5, 'Asdasd', 'Hjjhasdas', 'Jhasjhasdj', 'Hhjjh', 7878, 787, 1978, '7877', '19-08-2022 11-22-58WhatsApp Image 2022-06-17 at 14.11.06.jpeg.jpeg'),
(6, 'Adashdas', 'Ahadshjads', 'Sahdasdhh', 'Hsahasdh', 8933, 666, 2067, '766767', '19-08-2022 11-23-26WhatsApp Image 2022-06-17 at 14.11.06.jpeg.jpeg'),
(7, 'Adassa', 'Asdas', 'Hj', 'Adasd', 67, 676, 2010, 'Sadasddsa', '19-08-2022 11-31-34banner keyvisual_VSGA-01.png.png'),
(8, 'Adad', 'Jh', 'Hjhjhjh', 'Hhjhj', 7382, 737, 2022, 'Adada', '19-08-2022 11-39-51banner keyvisual_VSGA-01.png.png'),
(9, 'Sadasdasd', 'Sahdahdaj', 'Ajdjasdjs', 'Jjasdja', 47, 788, 0000, 'Hdjasd', '19-08-2022 11-40-27banner keyvisual_VSGA-01.png.png'),
(10, 'Asdasd', 'Jhhjashda', 'Jhahshja', 'Hhjdsad', 556, 565, 2022, '55665', '19-08-2022 12-06-40banner keyvisual_VSGA-01.png.png'),
(11, 'Asdansdm', 'Hjjasdsja', 'Jhsahdh', 'Hhhj', 566, 565, 2022, '5656', '19-08-2022 12-07-01IMG-20220719-WA0000.jpg.jpg'),
(12, 'Adasdhj', 'J', 'Hjhj', 'Hhhj', 67, 667, 2022, '7778', '19-08-2022 12-07-21banner keyvisual_VSGA-01.png.png'),
(13, 'Dsjaj', 'Jhjhdsah', 'Hjhasjd', '6', 6767, 667, 2022, '6676', '19-08-2022 12-07-48WhatsApp Image 2022-06-17 at 14.11.06.jpeg.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_peminjaman`
--

CREATE TABLE `tb_peminjaman` (
  `id` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `keterangan` text NOT NULL,
  `status` enum('dipinjam','dikembalikan') NOT NULL,
  `jumlah` int(3) NOT NULL,
  `buku_id` int(11) NOT NULL,
  `anggota_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengembalian`
--

CREATE TABLE `tb_pengembalian` (
  `id` int(11) NOT NULL,
  `peminjaman_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal_kembali` date NOT NULL
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
  `foto` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `username`, `password`, `hak_akses`, `foto`) VALUES
(1, 'Administrator', 'admin', '$2y$10$Qw6PjSyp/XJErK57uR8wv.pAFfqd8AJ5NJykv2bInbjOjYUi0N2nG', '1', '1.jpg'),
(2, 'rizqillah', 'rizqi', '$2y$10$fU7oIwA88dQ.ZjhsAG8qe.eow7PcixGMyUV.OHfa0Xyjyqz8hubZm', '2', 'image2.jpg');

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
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_buku`
--
ALTER TABLE `tb_buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
