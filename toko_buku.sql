-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2023 at 10:06 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_buku`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `nama_buku` varchar(255) NOT NULL,
  `pengarang` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `nama_buku`, `pengarang`, `harga`, `stok`) VALUES
(3, 'The DaVinci Code', 'Dan Brown', 2500000, 8),
(4, 'New Moon ', 'Stephanie Meyer', 150000, 0),
(5, 'Angels and Demon', 'Dan Brown', 100000, 0),
(7, 'One Day', 'David Nicchols', 500000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `email`, `alamat`, `no_hp`) VALUES
(1, 'Rahayu Diah Utami', 'diah@email.com', 'Jln Raya Bogor, Depok', 820202020),
(2, 'Rahmad Hidayat', 'rahmad@email.com', 'Jln Raya Sawangan Depok', 2586666),
(8, 'Rusliyadi', 'rusli@email.com', 'Jl. Bedahan Sawangan', 2147483647),
(9, 'Fahri', 'fahri@email.com', 'Jl. Jakarta Raya', 823448484);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pelanggan`, `id_buku`, `kuantitas`, `harga`, `total_harga`) VALUES
(34, 1, 5, 1, 100000, 100000),
(35, 9, 5, 2, 100000, 200000),
(37, 9, 3, 2, 100000, 200000);

--
-- Triggers `transaksi`
--
DELIMITER $$
CREATE TRIGGER `stok1` AFTER INSERT ON `transaksi` FOR EACH ROW BEGIN
UPDATE buku 
SET stok = stok - NEW.kuantitas
WHERE id_buku= NEW.id_buku;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `stok2` BEFORE DELETE ON `transaksi` FOR EACH ROW BEGIN
UPDATE buku 
SET stok = stok + OLD.kuantitas
WHERE id_buku= OLD.id_buku;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_lengkap`, `email`, `password`) VALUES
(1, 'Alan Budikusuma', 'alan@alan.com', 'rahasia'),
(2, 'Susi Susanti', 'susi@susi.com', 'rahasia'),
(3, 'Taufik Hidayat', 'taufik@taufik.com', '$2y$10$aRCFr.HFBDipgu2uv4cdfOM2ELqVGfZIb.dGtvDyYIkuktGNJok6K'),
(4, 'Lionel Messi', 'messi@messi.com', '$2y$10$IUO0TTT7u5z3HSwPy1vzS.Fl/ALryqI0e4FNDCNGRgautO6C5yfoa'),
(5, 'Alan Budikusuma', 'budi@email.com', '$2y$10$oxmENFEp94HFSaVLkK5D2exzWvfekSs9A08HhdCw0lKrLXpqiQPay'),
(6, 'Ahmad Faisal', 'faisal@gmail.com', '$2y$10$IXkJugOmKqy21r.QFAS54.1kVR8qQLkMeb4hAosL7hsFf3SMDwvMu'),
(7, 'Siska Rahmadani', 'siska@email.com', '$2y$10$1zl8Bx.kfLOQ9UWSSTpzr.7iDcJDFL8wzxlYspJbpNcGiZt9qAMZe'),
(8, 'wewe', 'wewe@wewe.com', 'e10adc3949ba59abbe56e057f20f883e'),
(9, 'siska', 'siska@siska.com', '$2y$10$T9df9K7pvDXbKVaqveDyFOjO3gKlcCJM6fcSJaONGXHzdg5R5aINu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pelanggan` (`id_pelanggan`,`id_buku`),
  ADD KEY `transaksi_ibfk_1` (`id_buku`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
