-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Des 2024 pada 20.07
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petshop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `detail_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(15,2) NOT NULL,
  `total_price` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`detail_id`, `transaction_id`, `produk_id`, `quantity`, `unit_price`, `total_price`) VALUES
(1, 6, 22, 10, 12000.00, 120000.00),
(2, 6, 24, 10, 400000.00, 4000000.00),
(3, 6, 26, 10, 40000.00, 400000.00),
(4, 7, 25, 10, 12500.00, 125000.00),
(5, 8, 22, 10, 12000.00, 120000.00),
(6, 9, 22, 1, 12000.00, 12000.00),
(7, 9, 23, 5, 42000.00, 210000.00),
(8, 9, 24, 5, 400000.00, 2000000.00),
(9, 10, 22, 5, 12000.00, 60000.00),
(10, 10, 27, 5, 20000.00, 100000.00),
(11, 10, 32, 10, 15000.00, 150000.00),
(12, 11, 31, 4, 26000.00, 104000.00),
(13, 11, 32, 5, 15000.00, 75000.00),
(14, 12, 22, 5, 12000.00, 60000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_produk`
--

CREATE TABLE `jenis_produk` (
  `id_jenis_barang` int(11) NOT NULL,
  `nama_jenis_produk` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jenis_produk`
--

INSERT INTO `jenis_produk` (`id_jenis_barang`, `nama_jenis_produk`) VALUES
(1, 'makanan kering anjing'),
(2, 'makanan kering kucing'),
(3, 'makanan basah kucing'),
(4, 'makanan basah anjing'),
(5, 'aksesoris anjing'),
(6, 'aksesoris kucing'),
(7, 'obat kucing & anjing');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `produk_id` int(11) NOT NULL,
  `nama_produk` varchar(100) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `id_jenis_barang` int(11) DEFAULT NULL,
  `foto_produk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`produk_id`, `nama_produk`, `harga`, `stok`, `id_jenis_barang`, `foto_produk`) VALUES
(22, 'meo', 12000.00, 10, 3, '6756fd0963fe8.jpg'),
(23, 'meo', 42000.00, 5, 2, '6756fd80d9ccd.png'),
(24, 'royal canin', 400000.00, 10, 2, '6756fdabcf121.png'),
(25, 'life cat', 12500.00, 20, 3, '6756fdde31c76.jpeg'),
(26, 'pedigree', 40000.00, 10, 1, '6756fe1956057.jpg'),
(27, 'pedigree', 20000.00, 10, 4, '6756fe4c5bf69.jpeg'),
(28, 'well', 24000.00, 5, 7, '6756fe7853cf2.jpg'),
(29, 'royal care', 30000.00, 3, 7, '6756feaba0db5.jpeg'),
(31, 'bulu bergoyang', 26000.00, 0, 6, '6756ff1184528.jpeg'),
(32, 'cat coize', 15000.00, 5, 1, '6756ff97438cd.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_harga` decimal(15,2) NOT NULL,
  `payment_method` enum('E Wallet','Transfer Bank','Tunai') NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`transaction_id`, `user_id`, `total_harga`, `payment_method`, `created_at`) VALUES
(6, 1, 4520000.00, 'E Wallet', '2024-12-10 01:17:56'),
(7, 1, 125000.00, 'Transfer Bank', '2024-12-10 01:19:26'),
(8, 1, 120000.00, 'E Wallet', '2024-12-10 01:24:18'),
(9, 1, 2222000.00, 'Tunai', '2024-12-10 01:26:37'),
(10, 1, 310000.00, 'E Wallet', '2024-12-10 01:28:26'),
(11, 1, 179000.00, 'E Wallet', '2024-12-10 02:01:36'),
(12, 1, 60000.00, 'E Wallet', '2024-12-10 02:02:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `nama_user` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','karyawan') NOT NULL DEFAULT 'karyawan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `nama_user`, `password`, `role`) VALUES
(1, 'bismoaryob', '$2y$10$blqCFKgLWrC.idpdqLBfZOcM.oAzUpiu1EJCwDfzTRtps1o6QfZhG', 'karyawan'),
(2, 'bsm.aryob', '$2y$10$rhf1X4utPUuMtTj3uGWBnOMHN8m6v7M3rtH8Had.XmzcCh0LnZ9Fq', 'karyawan'),
(3, 'BaaniKontol', '$2y$10$olyNOzy7ItRsJqXlnSNmx.BQek9C2v5kEeS1Hl0GrS5vDosyEsUQC', 'karyawan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indeks untuk tabel `jenis_produk`
--
ALTER TABLE `jenis_produk`
  ADD PRIMARY KEY (`id_jenis_barang`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`produk_id`),
  ADD KEY `fk_jenis_produk` (`id_jenis_barang`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `jenis_produk`
--
ALTER TABLE `jenis_produk`
  MODIFY `id_jenis_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transaksi` (`transaction_id`),
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`produk_id`);

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `fk_jenis_produk` FOREIGN KEY (`id_jenis_barang`) REFERENCES `jenis_produk` (`id_jenis_barang`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
