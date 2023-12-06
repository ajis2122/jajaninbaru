-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Des 2023 pada 01.51
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jajanin`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(25) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `nama`, `username`, `password`, `jenis_kelamin`) VALUES
(3, 'fikri1', 'defik', '1234', 'Perempuan'),
(9, 'faizal', 'faizal', '221', 'Laki-Laki'),
(10, 'pulan', 'pulan', 'pulan121', 'Laki-Laki'),
(12, 'nadia', 'nadia', 'syalala', 'Perempuan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `nama_penjual` varchar(255) NOT NULL,
  `gambar_produk` varchar(255) DEFAULT NULL,
  `harga_jual` varchar(255) NOT NULL,
  `no_telpone` varchar(22) NOT NULL,
  `dana` varchar(15) NOT NULL,
  `stok` int(11) NOT NULL,
  `deksripsi_barang` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `nama_penjual`, `gambar_produk`, `harga_jual`, `no_telpone`, `dana`, `stok`, `deksripsi_barang`) VALUES
(23, 'basreng', 'af snack', 'basreng_original_1.png', '11000', '+6281024146860', 'jppppp.jpeg', 25, 'enak hhhh'),
(24, 'makaroni', 'af snack', 'makaroni.jpg', '5000', '+6287774353805', 'jppppp.jpeg', 35, 'yuiop'),
(25, 'Kulit ayam ', 'af snack', 'kulit_crispy_1.png', '12000', '+6285697718607', 'jppppp.jpeg', 25, 'rtyuiop'),
(27, 'cimol', 'af snack', 'cimol1.png', '12000', '+62881024146860', 'jppppp.jpeg', 25, 'rterkhm');

-- --------------------------------------------------------

--
-- Struktur dari tabel `recap`
--

CREATE TABLE `recap` (
  `id_recap` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` text DEFAULT NULL,
  `tempat_lahir` varchar(25) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `no_telepon` int(15) DEFAULT NULL,
  `jenis_kelamin` text DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `tempat_lahir`, `tanggal_lahir`, `no_telepon`, `jenis_kelamin`, `alamat`, `username`, `password`) VALUES
(9, 'soleh', 'jerman', '2023-11-02', 2147483647, 'Perempuan', 'cikeas udik', 'makima', '12345'),
(10, 'ada', 'kota', '2023-11-06', 2147483647, 'Laki-laki', 'hgfds', 'ada', '12'),
(11, 'imin', 'jerman', '2023-11-17', 2147483647, 'Laki-laki', 'jhgvfc', 'dodi', 'da21'),
(12, 'erer', 'amerika', '2023-12-02', 2147483647, 'laki', 'wertyui', 'ada', 'sa213'),
(14, 'alim', 'malaysia', '2023-11-22', 2147483647, 'laki', 'dfres', 'alim', 'ali432'),
(15, 'jajang', 'tasik', '2000-02-11', 2147483647, 'laki', 'kampung tasik', 'jajang', 'jajang2'),
(21, 'ADANG', 'amerika', '1999-12-12', 2147483647, 'perempuan', 'dddddd', 'adang2', 'adang2'),
(22, 'alfa', 'korea', '2023-02-15', 2147483647, 'laki', 'seoul city', 'alfakim', '12345'),
(23, 'dede', 'malaysia', '2023-11-30', 2147483647, 'laki', 'ghj', 'dede', 'dede'),
(24, 'sera', 'swis', '2023-02-20', 84897565, 'perempuan', 'korea utara', 'sera', 'kepo123'),
(25, 'aji', 'bogor', '1999-11-21', 2147483647, 'laki', 'cikeas', 'aji', 'aji');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `recap`
--
ALTER TABLE `recap`
  ADD PRIMARY KEY (`id_recap`),
  ADD UNIQUE KEY `id_barang` (`id_barang`,`id`),
  ADD UNIQUE KEY `id` (`id`);

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
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `recap`
--
ALTER TABLE `recap`
  MODIFY `id_recap` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `recap`
--
ALTER TABLE `recap`
  ADD CONSTRAINT `recap_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recap_ibfk_2` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
