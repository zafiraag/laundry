-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jun 2021 pada 11.24
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_laundry`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanan`
--

CREATE TABLE `layanan` (
  `layanan_id` int(11) NOT NULL,
  `nama_layanan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `layanan`
--

INSERT INTO `layanan` (`layanan_id`, `nama_layanan`) VALUES
(11, 'Kilo Laundry Premium'),
(12, 'Laundry/Cuci Karpet'),
(13, 'Laundry Satuan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_layanan`
--

CREATE TABLE `sub_layanan` (
  `sub_layanan_id` int(11) NOT NULL,
  `layanan_id` int(11) DEFAULT NULL,
  `nama_sub_layanan` varchar(255) DEFAULT NULL,
  `harga` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sub_layanan`
--

INSERT INTO `sub_layanan` (`sub_layanan_id`, `layanan_id`, `nama_sub_layanan`, `harga`) VALUES
(14, 11, 'Cuci karpet', 10000),
(15, 12, 'Karpet masjid', 20000),
(16, 13, 'Baju anak', 10000),
(17, 12, 'Karpet ultra', 50000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_akun`
--

CREATE TABLE `tb_akun` (
  `id_akun` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` int(1) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_akun`
--

INSERT INTO `tb_akun` (`id_akun`, `username`, `password`, `role`) VALUES
(3, 'admin', '123\r\n', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_order`
--

CREATE TABLE `tb_order` (
  `order_id` int(11) NOT NULL,
  `nama_sub_layanan` int(11) NOT NULL,
  `tanggal_order` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `telpon` int(100) DEFAULT NULL,
  `pesan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_order`
--

INSERT INTO `tb_order` (`order_id`, `nama_sub_layanan`, `tanggal_order`, `alamat`, `nama`, `telpon`, `pesan`) VALUES
(129, 15, '2021-06-19', '1', '1', 2, '1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`layanan_id`);

--
-- Indeks untuk tabel `sub_layanan`
--
ALTER TABLE `sub_layanan`
  ADD PRIMARY KEY (`sub_layanan_id`),
  ADD KEY `FK_ca292355-85b8-4d9a-919e-fa4a61d8ddbe` (`layanan_id`);

--
-- Indeks untuk tabel `tb_akun`
--
ALTER TABLE `tb_akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indeks untuk tabel `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `nama_sub_layanan` (`nama_sub_layanan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `layanan`
--
ALTER TABLE `layanan`
  MODIFY `layanan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `sub_layanan`
--
ALTER TABLE `sub_layanan`
  MODIFY `sub_layanan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tb_akun`
--
ALTER TABLE `tb_akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `sub_layanan`
--
ALTER TABLE `sub_layanan`
  ADD CONSTRAINT `FK_ca292355-85b8-4d9a-919e-fa4a61d8ddbe` FOREIGN KEY (`layanan_id`) REFERENCES `layanan` (`layanan_id`);

--
-- Ketidakleluasaan untuk tabel `tb_order`
--
ALTER TABLE `tb_order`
  ADD CONSTRAINT `tb_order_ibfk_1` FOREIGN KEY (`nama_sub_layanan`) REFERENCES `sub_layanan` (`sub_layanan_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
