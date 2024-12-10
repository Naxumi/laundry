-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2024 at 12:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `nama`, `username`, `email`, `password`, `alamat`, `no_hp`, `created_at`) VALUES
(1, 'Muhammad Hafizh Al Furqon', 'hafizhalfurqon', 'hafizh@gmail.com', '$2y$10$QNQuC/HNcUDNuNEXiaaSCuF7VU.d.0U5qZH5jUzhXVLjrnGmulX6W', 'jalan panjaitan gang no 17', '085943692062', '2024-05-23 06:05:27'),
(2, 'Muhammad Furqon Furqon', 'furqon', 'furqon@gmail.com', '$2y$10$TZ/RuKAMy4ArsLjjQrQqm.yhfFtzfrjYOqO1WuRZRCMBsclFLtPxq', 'furqong gankster', '085943692062', '2024-05-29 07:10:31'),
(4, 'zeka', 'zekazeka', 'zekazeka@gmail.com', '$2y$10$DvK6dY0MBlZowt7qZ4/LRuJJ16J5szmVWbxWPjvrSSkUn216dl6Sm', 'zeka', '666', '2024-06-01 08:01:16'),
(5, 'naxumi lengkap', 'naxumi', 'naxumi@gmail.com', '$2y$10$OhWGnjR7.qyMvMe2ujpkpOCnBYbFfn20JqLJEYhaiDlaGGE/del1q', 'panjaitan', '666', '2024-06-02 16:13:26');

-- --------------------------------------------------------

--
-- Table structure for table `jenislaundry`
--

CREATE TABLE `jenislaundry` (
  `jenis_id` int(11) NOT NULL,
  `nama_layanan` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenislaundry`
--

INSERT INTO `jenislaundry` (`jenis_id`, `nama_layanan`, `deskripsi`, `harga`) VALUES
(1, 'Cuci Reguler', ' Layanan cuci dan kering pakaian biasa.', 7000.00),
(2, 'Cuci Express', 'Layanan cuci, kering, lipat, dan setrika pakaian', 12000.00),
(3, 'Cuci Sepatu', 'Layanan khusus cuci sepatu.', 15000.00);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `petugas_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('operator','admin') NOT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`petugas_id`, `nama`, `username`, `email`, `password`, `role`, `no_hp`, `created_at`) VALUES
(1, 'hafizh super admin', 'hafizhalfurqon', 'hafizhalfurqon@gmail.com', '$2y$10$lwQN.Gidxn/vMg.FcbXGIed617JfE3SO46Y5w9To4RXT6eO754mbe', 'admin', '085943692062', '2024-05-29 05:50:24'),
(2, 'operatorfurqon', 'operatorfurqon', 'operatorfurqon@gmail.com', '$2y$10$/zivEObMomHVCfQ1x6gyu.cE09uCQPfUOuR1uJHMCVx7Mk85LKUAi', 'operator', '089539232', '2024-05-29 10:42:09');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksi_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `petugas_id` int(11) DEFAULT NULL,
  `jenis_id` int(11) NOT NULL,
  `tanggal_pemesanan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tanggal_pengambilan` timestamp NULL DEFAULT current_timestamp(),
  `tanggal_pengantaran` timestamp NULL DEFAULT current_timestamp(),
  `status` enum('konfirmasi','diterima','dicuci','disetrika','dalam pengiriman','selesai','gagal') DEFAULT 'konfirmasi',
  `kuantitas` int(11) NOT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `client_id`, `petugas_id`, `jenis_id`, `tanggal_pemesanan`, `tanggal_pengambilan`, `tanggal_pengantaran`, `status`, `kuantitas`, `total_harga`) VALUES
(21, 1, 1, 1, '2024-06-02 15:28:58', '2024-06-02 15:28:19', '2024-06-02 15:28:33', 'selesai', 3, 21000.00),
(22, 5, 1, 1, '2024-06-02 16:16:40', '2024-06-02 16:15:08', '2024-06-02 16:15:28', 'selesai', 3, 21000.00),
(23, 5, 1, 1, '2024-06-02 16:28:49', '2024-06-02 16:27:24', '2024-06-02 16:28:09', 'selesai', 3, 21000.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `jenislaundry`
--
ALTER TABLE `jenislaundry`
  ADD PRIMARY KEY (`jenis_id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`petugas_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `petugas_id` (`petugas_id`),
  ADD KEY `jenis_id` (`jenis_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jenislaundry`
--
ALTER TABLE `jenislaundry`
  MODIFY `jenis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `petugas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`petugas_id`),
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`jenis_id`) REFERENCES `jenislaundry` (`jenis_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
