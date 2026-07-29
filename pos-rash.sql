-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2021 at 07:11 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos-rash`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_ecer` int(11) NOT NULL,
  `harga_grosir` int(11) NOT NULL,
  `harga_agen` int(11) NOT NULL,
  `profit_harga_ecer` int(11) NOT NULL,
  `profit_harga_grosir` int(11) NOT NULL,
  `profit_harga_agen` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `stok_minimal` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kategori_id`, `kode_barang`, `nama_barang`, `harga_beli`, `harga_ecer`, `harga_grosir`, `harga_agen`, `profit_harga_ecer`, `profit_harga_grosir`, `profit_harga_agen`, `deskripsi`, `stok`, `stok_minimal`, `created_at`, `updated_at`) VALUES
(1, 1, 'KDBRG-1', 'MOUSE LOGITECH B100', 10000, 12000, 14000, 16000, 2000, 4000, 6000, '-', 485, 50, '2021-09-17 07:44:36', '2021-09-18 21:54:07'),
(2, 1, 'KDBRG-2', 'MOUSEPAD FANTECH', 20000, 22000, 24000, 26000, 2000, 4000, 6000, '-', 500, 50, '2021-09-17 07:45:40', '2021-09-18 21:50:01'),
(3, 1, 'KDBRG-3', 'FLASHDISK SANDISK 16GB', 30000, 32000, 34000, 36000, 2000, 4000, 6000, '-', 525, 50, '2021-09-17 07:46:31', '2021-09-18 21:50:17'),
(4, 1, 'KDBRG-4', 'HEADPHONE FANTECH HG20', 40000, 42000, 44000, 46000, 2000, 4000, 6000, '-', 535, 50, '2021-09-17 07:47:37', '2021-09-18 21:51:32'),
(5, 1, 'KDBRG-5', 'SPEAKER ROBOT', 50000, 52000, 54000, 56000, 2000, 4000, 6000, '-', 545, 50, '2021-09-17 07:48:30', '2021-09-18 21:51:46'),
(6, 1, 'KDBRG-6', 'KABEL HDMI', 60000, 62000, 64000, 66000, 2000, 4000, 6000, '-', 500, 50, '2021-09-17 12:48:47', '2021-09-18 02:07:34'),
(7, 1, 'KDBRG-7', 'CHARGER LAPTOP ASUS', 70000, 72000, 74000, 76000, 2000, 4000, 6000, '-', 500, 50, '2021-09-17 12:49:54', '2021-09-18 00:51:50'),
(8, 1, 'KDBRG-8', 'KABEL VGA', 80000, 82000, 84000, 86000, 2000, 4000, 6000, '-', 500, 50, '2021-09-17 12:51:07', '2021-09-18 00:54:43'),
(9, 1, 'KDBRG-9', 'KEYBOARD GAMING FANTECH 1822', 90000, 92000, 94000, 96000, 2000, 4000, 6000, '-', 500, 50, '2021-09-17 12:52:27', '2021-09-18 00:56:39');

-- --------------------------------------------------------

--
-- Table structure for table `detail_hutang`
--

CREATE TABLE `detail_hutang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_invoice` varchar(20) NOT NULL,
  `pembayaran` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_hutang`
--

INSERT INTO `detail_hutang` (`id`, `no_invoice`, `pembayaran`, `created_at`, `updated_at`) VALUES
(1, 'INV1809210004', 60000, '2021-09-18 06:36:15', '2021-09-18 06:36:15'),
(2, 'INV1809210004', 4000, '2021-09-18 06:36:55', '2021-09-18 06:36:55');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id` int(11) NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `no_pembelian` varchar(30) NOT NULL,
  `total_pembayaran` int(11) NOT NULL,
  `pembayaran` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id`, `supplier_id`, `no_pembelian`, `total_pembayaran`, `pembayaran`, `kembalian`, `created_at`, `updated_at`) VALUES
(1, 1, 'NOP-1709210001', 1500000, 1500000, 0, '2021-09-17 08:05:07', '2021-09-17 08:05:07');

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id` int(11) NOT NULL,
  `no_invoice` varchar(20) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `potongan` int(11) DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `jenis` varchar(20) DEFAULT NULL,
  `profit` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id`, `no_invoice`, `kode_barang`, `harga`, `qty`, `potongan`, `total_harga`, `jenis`, `profit`, `created_at`, `updated_at`) VALUES
(1, 'INV1809210001', 'KDBRG-1', 12000, 5, 2000, 58000, 'ecer', 2000, '2021-09-18 06:27:41', '2021-09-18 06:28:01'),
(2, 'INV1809210001', 'KDBRG-2', 22000, 5, 1000, 109000, 'ecer', 2000, '2021-09-18 06:28:43', '2021-09-18 06:28:43'),
(3, 'INV1809210002', 'KDBRG-1', 12000, 5, 0, 60000, 'ecer', 2000, '2021-09-18 06:30:06', '2021-09-18 06:30:06'),
(4, 'INV1809210002', 'KDBRG-2', 22000, 5, 0, 110000, 'ecer', 2000, '2021-09-18 06:30:18', '2021-09-18 06:30:18'),
(5, 'INV1809210003', 'KDBRG-1', 12000, 5, NULL, 60000, 'ecer', 2000, '2021-09-18 06:31:37', '2021-09-18 06:31:37'),
(6, 'INV1809210003', 'KDBRG-2', 22000, 5, 0, 110000, 'ecer', 2000, '2021-09-18 06:31:48', '2021-09-18 06:31:48'),
(7, 'INV1809210004', 'KDBRG-1', 12000, 5, 1000, 59000, 'ecer', 2000, '2021-09-18 06:34:21', '2021-09-18 06:34:21'),
(8, 'INV1909210001', 'KDBRG-1', 12000, 5, 1000, 59000, 'ecer', 2000, '2021-09-18 21:49:46', '2021-09-18 21:49:46'),
(9, 'INV1909210001', 'KDBRG-2', 22000, 5, 0, 110000, 'ecer', 2000, '2021-09-18 21:50:01', '2021-09-18 21:50:01'),
(10, 'INV1909210001', 'KDBRG-3', 32000, 5, 0, 160000, 'ecer', 2000, '2021-09-18 21:50:17', '2021-09-18 21:50:17'),
(11, 'INV1909210002', 'KDBRG-4', 42000, 5, 500, 209500, 'ecer', 2000, '2021-09-18 21:51:32', '2021-09-18 21:51:32'),
(12, 'INV1909210002', 'KDBRG-5', 52000, 5, 500, 259500, 'ecer', 2000, '2021-09-18 21:51:46', '2021-09-18 21:51:46');

-- --------------------------------------------------------

--
-- Table structure for table `detail_retur_barang`
--

CREATE TABLE `detail_retur_barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_retur` varchar(20) NOT NULL,
  `no_invoice` varchar(20) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hutang`
--

CREATE TABLE `hutang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pelanggan_id` int(11) DEFAULT NULL,
  `no_invoice` varchar(20) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `pembayaran` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hutang`
--

INSERT INTO `hutang` (`id`, `user_id`, `pelanggan_id`, `no_invoice`, `sub_total`, `pembayaran`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'INV1809210003', 170000, NULL, 0, '2021-09-18 06:32:09', '2021-09-18 06:32:09'),
(2, 1, 3, 'INV1809210004', 64000, 64000, 1, '2021-09-18 06:34:43', '2021-09-18 06:36:55');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'ECER', '2021-09-17 07:24:33', '2021-09-17 07:24:33'),
(2, 'GROSIR', '2021-09-17 07:24:33', '2021-09-17 07:24:33'),
(3, 'AGEN', '2021-09-17 07:24:33', '2021-09-17 07:24:33');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `no_hp`, `email`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'Umum', NULL, NULL, NULL, '2021-09-18 01:22:36', '2021-09-18 01:22:36'),
(2, 'Pelanggan 1', '081', 'pelanggan1@gmail.com', NULL, '2021-09-18 01:23:40', '2021-09-18 01:23:40'),
(3, 'Pelanggan 2', '082', 'pelanggan2@gmail.com', NULL, '2021-09-18 01:23:40', '2021-09-18 01:23:40'),
(4, 'Pelanggan 3', '083', 'pelanggan3@gmail.com', NULL, '2021-09-18 01:23:40', '2021-09-18 01:23:40'),
(5, 'Pelanggan 4', '082', 'pelanggan4@gmail.com', NULL, '2021-09-18 01:23:40', '2021-09-18 01:23:40');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL,
  `no_pembelian` varchar(30) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `no_pembelian`, `kode_barang`, `qty`, `total_harga`, `created_at`, `updated_at`) VALUES
(1, 'NOP-1709210001', 'KDBRG-1', 10, 100000, '2021-09-17 08:03:00', '2021-09-17 08:03:00'),
(2, 'NOP-1709210001', 'KDBRG-2', 20, 200000, '2021-09-17 08:03:16', '2021-09-17 08:03:16'),
(3, 'NOP-1709210001', 'KDBRG-3', 30, 300000, '2021-09-17 08:03:28', '2021-09-17 08:03:28'),
(4, 'NOP-1709210001', 'KDBRG-4', 40, 400000, '2021-09-17 08:03:40', '2021-09-17 08:03:40'),
(5, 'NOP-1709210001', 'KDBRG-5', 50, 500000, '2021-09-17 08:03:50', '2021-09-17 08:03:50');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_pengeluaran` varchar(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `pelanggan_id` int(11) DEFAULT NULL,
  `no_invoice` varchar(20) NOT NULL,
  `total_pembayaran` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `pembayaran` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `jenis` enum('cash','hutang','transfer') DEFAULT NULL,
  `jenis_bank` varchar(50) DEFAULT NULL,
  `biaya_pengiriman` int(11) DEFAULT NULL,
  `bukti_transfer` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `user_id`, `pelanggan_id`, `no_invoice`, `total_pembayaran`, `sub_total`, `pembayaran`, `kembalian`, `jenis`, `jenis_bank`, `biaya_pengiriman`, `bukti_transfer`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'INV1809210001', 167000, 172000, 180000, 8000, 'cash', NULL, 5000, NULL, '2021-09-18 06:29:21', '2021-09-18 06:29:21'),
(2, 1, 2, 'INV1809210002', 170000, 182000, 200000, 18000, 'transfer', 'MANDIRI', 12000, '1631946675_753267.jpg', '2021-09-18 06:31:15', '2021-09-18 06:31:15'),
(3, 1, NULL, 'INV1809210003', 170000, 170000, 200000, 30000, 'hutang', NULL, NULL, NULL, '2021-09-18 06:32:09', '2021-09-18 06:32:09'),
(4, 1, 3, 'INV1809210004', 59000, 59000, 100000, 36000, 'hutang', NULL, NULL, NULL, '2021-09-18 06:34:43', '2021-09-18 06:34:43'),
(5, 1, NULL, 'INV1909210001', 329000, 341000, 350000, 9000, 'cash', NULL, 12000, NULL, '2021-09-18 21:50:42', '2021-09-18 21:50:42'),
(6, 1, 5, 'INV1909210002', 469000, 474000, 500000, 26000, 'cash', NULL, 5000, NULL, '2021-09-18 21:52:53', '2021-09-18 21:52:53');

-- --------------------------------------------------------

--
-- Table structure for table `retur_barang`
--

CREATE TABLE `retur_barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `no_retur` varchar(20) NOT NULL,
  `total_pembayaran` int(11) NOT NULL,
  `pembayaran` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stok_barang`
--

CREATE TABLE `stok_barang` (
  `id` bigint(20) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rekening` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rekening_atas_nama` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_pos` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `no_hp`, `email`, `no_rekening`, `rekening_atas_nama`, `bank`, `kode_pos`, `alamat`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Supplier 1', '081', 'supplier1@gmail.com', '001', 'Supplier 1', 'BRI', '-', '-', '-', '2021-09-17 07:22:41', '2021-09-17 07:22:41'),
(2, 'Supplier 2', '082', 'supplier2@gmail.com', '002', 'Supplier 2', 'BNI', '-', '-', '-', '2021-09-17 07:22:41', '2021-09-17 07:22:41'),
(3, 'Supplier 3', '083', 'supplier3@gmail.com', '003', 'Supplier 3', 'BCA', '-', '-', '-', '2021-09-17 07:22:41', '2021-09-17 07:22:41'),
(4, 'Supplier 4', '084', 'supplier4@gmail.com', '004', 'Supplier 4', 'MANDIRI', '-', '-', '-', '2021-09-17 07:22:41', '2021-09-17 07:22:41');

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `id` bigint(20) NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `total` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `bukti` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'Admin RASH', 'adminrash@gmail.com', '2021-05-14 16:57:43', '$2y$10$rxnBp2FsSXeE38dkYohi4OYc07WwigPy6ZIU2i.wlPxpvwNQk/OLm', 'Saebc41xQc7zdMj35kHpn7K2W40LqUbMbJH0wKJuuYTdrMsImiO31oaj1M5x', 'admin', '1621202596_WhatsApp Image 2020-11-09 at 07.17.58.jpeg', NULL, '2021-05-16 17:27:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indexes for table `detail_hutang`
--
ALTER TABLE `detail_hutang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_retur_barang`
--
ALTER TABLE `detail_retur_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hutang`
--
ALTER TABLE `hutang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `retur_barang`
--
ALTER TABLE `retur_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indexes for table `stok_barang`
--
ALTER TABLE `stok_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `detail_hutang`
--
ALTER TABLE `detail_hutang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `detail_retur_barang`
--
ALTER TABLE `detail_retur_barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hutang`
--
ALTER TABLE `hutang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `retur_barang`
--
ALTER TABLE `retur_barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stok_barang`
--
ALTER TABLE `stok_barang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`);

--
-- Constraints for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `detail_pembelian_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`);

--
-- Constraints for table `hutang`
--
ALTER TABLE `hutang`
  ADD CONSTRAINT `hutang_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`),
  ADD CONSTRAINT `hutang_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`),
  ADD CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `retur_barang`
--
ALTER TABLE `retur_barang`
  ADD CONSTRAINT `retur_barang_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`);

--
-- Constraints for table `transfer`
--
ALTER TABLE `transfer`
  ADD CONSTRAINT `transfer_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
