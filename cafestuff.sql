-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 12, 2023 at 04:51 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafestuff`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(125) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `username`, `password`) VALUES
(1, 'Fathur Rizqi G.', 'fathur', '123');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `hari` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id`, `id_produk`, `id_user`, `hari`, `total`, `jumlah`, `id_transaksi`) VALUES
(1, 5, 18, 2, 1600000, 2, 2),
(2, 4, 18, 4, 2400000, 3, 2),
(4, 5, 18, 2, 1600000, 2, 3),
(5, 4, 18, 4, 2400000, 3, 3),
(7, 4, 18, 3, 1200000, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_produk`
--

INSERT INTO `kategori_produk` (`id`, `nama`) VALUES
(1, 'Cofee Grinder'),
(2, 'Espresso Machine'),
(3, 'Barista Tools'),
(4, 'Kitchen Tools'),
(5, 'Freezer');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `hari` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `gambar` varchar(125) NOT NULL,
  `nama` varchar(125) NOT NULL,
  `harga` int(225) NOT NULL,
  `stok` int(225) NOT NULL,
  `deskripsi` text NOT NULL,
  `kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `gambar`, `nama`, `harga`, `stok`, `deskripsi`, `kategori`) VALUES
(4, '648539c2e07a7_download.jpeg', 'Feima - Coffee Grinder 600N', 200000, 8, 'Feima - Coffee Grinder 600N adalah mesin penggiling kopi yang handal dan efisien untuk penggemar kopi sejati. Didesain dengan presisi, grinder ini menawarkan kinerja yang konsisten dan hasil giling yang tepat sesuai keinginan Anda.\r\n\r\nDilengkapi dengan motor kuat, Feima - Coffee Grinder 600N dapat dengan mudah menggiling biji kopi menjadi bubuk halus dalam waktu singkat. Pengaturan kehalusan gilingannya yang dapat disesuaikan memungkinkan Anda mengendalikan tingkat kehalusan sesuai dengan preferensi rasa kopi Anda.', 1),
(5, '648531cd80613_Maquinos_M38_Coffee_Grinder_Mesin_Penggiling_Kopi_Dosser_Gri.jpg', 'Maquinos - Coffee Grinder M38', 400000, 10, 'Maquinos - Coffee Grinder M38 adalah mesin penggiling kopi yang inovatif dan handal, dirancang untuk memberikan hasil penggilingan kopi yang berkualitas tinggi. Mesin ini dilengkapi dengan teknologi canggih yang memungkinkan pengguna untuk mengatur tingkat kehalusan gilingan sesuai dengan preferensi pribadi mereka. Dengan desain yang elegan dan kompak, Maquinos - Coffee Grinder M38 cocok untuk digunakan di rumah, kafe, atau restoran.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total` int(11) NOT NULL,
  `status` varchar(225) DEFAULT 'PENDING'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_user`, `tanggal`, `total`, `status`) VALUES
(2, 18, '2023-06-12 14:32:37', 4000000, 'RETURNED'),
(3, 18, '2023-06-12 14:45:12', 4000000, 'SUCCESS'),
(4, 18, '2023-06-12 12:34:47', 1200000, 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(125) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(8) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `alamat`) VALUES
(1, 'Fathur ginanjar', 'fathur', '123 rete', 'Desa Kalibaru Kulon, Kec. Kalibaru, Kab. Banyuwangi'),
(7, 'Maulana Malik Ibrahimofsfsdf', 'malik', '123iutu7', 'kalibaru kulon'),
(18, 'useredit', 'user', '123', 'kalibaru');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_idproduk` (`id_produk`),
  ADD KEY `fk_idusr` (`id_user`),
  ADD KEY `fk_idtrx` (`id_transaksi`);

--
-- Indexes for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kategori_produk` (`kategori`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_idusers` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `fk_idproduk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`),
  ADD CONSTRAINT `fk_idtrx` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`),
  ADD CONSTRAINT `fk_idusr` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `fk_kategori_produk` FOREIGN KEY (`kategori`) REFERENCES `kategori_produk` (`id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_idusers` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
