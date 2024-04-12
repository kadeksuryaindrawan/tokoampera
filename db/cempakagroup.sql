-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 12, 2024 at 10:08 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cempakagroup`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('tampil','tidak tampil') COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `judul`, `deskripsi`, `status`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Test Judul Pengumuman', 'mantap sekali', 'tampil', '6ab068897bc027fb7077d243fc85f3f5_Blog_3.jpg', '2024-04-06 07:23:25', '2024-04-12 16:29:00'),
(2, 'Test Judul Pengumuman 2', 'awdawddaw', 'tampil', '85c37af86fca96a5246267022f75ccf1_Blog_1.jpg', '2024-04-06 07:23:37', '2024-04-06 07:23:37'),
(3, 'Test Judul Pengumuman 3', 'awdwaddaw waodjaowjdawd oakwoakwdokaw awdoioawdk adwijaodw oawkdoawkd oakwdokawd', 'tampil', 'fa718bbf75cddc7289d3d34d9a0c7615_Blog_4.jpg', '2024-04-06 07:23:48', '2024-04-06 07:23:48');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `qty` int NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `customer_id`, `product_id`, `qty`, `total`, `created_at`, `updated_at`) VALUES
(40, 4, 3, 1, 1000000, '2024-04-12 21:38:57', '2024-04-12 21:38:57'),
(41, 6, 4, 2, 4000000, '2024-04-12 22:02:01', '2024-04-12 22:02:01'),
(42, 6, 2, 3, 600000, '2024-04-12 22:02:05', '2024-04-12 22:02:28'),
(43, 4, 2, 1, 200000, '2024-04-12 22:03:03', '2024-04-12 22:03:03');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Fotografi', '2024-04-06 06:24:39', '2024-04-06 06:24:39'),
(2, 'Arsitektur', '2024-04-06 06:24:47', '2024-04-06 06:24:47'),
(3, 'Minimalis', '2024-04-06 07:16:25', '2024-04-06 07:16:25');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `img_profile` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `nama_lengkap`, `telp`, `tempat_lahir`, `tanggal_lahir`, `img_profile`, `created_at`, `updated_at`) VALUES
(4, 5, 'I Kadek Surya Indrawan', '0892383983', NULL, NULL, NULL, '2024-04-08 07:40:21', '2024-04-08 07:40:21'),
(5, 6, 'kadek surya', '0872818327', NULL, NULL, NULL, '2024-04-09 16:51:09', '2024-04-09 16:51:09'),
(6, 1, 'Admin Cempaka', '08738438273', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_addresses`
--

CREATE TABLE `customer_addresses` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `nama_alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `long` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_addresses`
--

INSERT INTO `customer_addresses` (`id`, `customer_id`, `nama_alamat`, `alamat`, `lat`, `long`, `created_at`, `updated_at`) VALUES
(1, 4, 'Denpasar', 'Jalan Sidakarya gang 70', '-8.700765299230328', '115.22692948579791', '2024-04-09 18:42:39', '2024-04-09 19:26:45'),
(2, 4, 'Badung', 'Jalan bukit jimbaran', '-8.778273495910957', '115.17122268676759', '2024-04-09 18:51:36', '2024-04-09 18:51:36'),
(4, 5, 'Denpasar', 'Jalan Sidakarya', '-8.702121748091635', '115.2129364013672', '2024-04-10 17:43:52', '2024-04-10 17:43:52');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_04_02_182312_create_categories_table', 1),
(6, '2024_04_02_182333_create_products_table', 1),
(7, '2024_04_02_182348_create_customers_table', 1),
(8, '2024_04_02_182420_create_customer_addresses_table', 1),
(9, '2024_04_02_182442_create_orders_table', 1),
(10, '2024_04_02_182501_create_order_products_table', 1),
(11, '2024_04_02_182514_create_vouchers_table', 1),
(12, '2024_04_02_182525_create_blogs_table', 1),
(13, '2024_04_06_141036_create_carts_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `invoice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_sebelum_discount` double NOT NULL,
  `total` double NOT NULL,
  `status` enum('pending','menunggu pembayaran','konfirmasi pembayaran','terbayar','terkirim','diterima','ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `long` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `voucher` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `shipping_courier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_price` double DEFAULT NULL,
  `nama_bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pemilik_bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bukti_bayar` text COLLATE utf8mb4_unicode_ci,
  `tanggal_bayar` datetime DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `resi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `invoice`, `total_sebelum_discount`, `total`, `status`, `alamat`, `long`, `lat`, `voucher`, `discount`, `shipping_courier`, `shipping_price`, `nama_bank`, `no_bank`, `pemilik_bank`, `bukti_bayar`, `tanggal_bayar`, `catatan`, `resi`, `created_at`, `updated_at`) VALUES
(9, 5, 'CMPK/04/2024/sShTU', 4400000, 4380000, 'diterima', 'Jalan Sidakarya', '115.2129364013672', '-8.702121748091635', 'INIVOUCHER', 20000, 'JNE', 25000, 'Mandiri', '827387328', 'Kadek Surya', '611a328a8d7ec79c079aaafd4eaf31095_Bukti_Bayar_destination-7.jpg', '2024-04-12 00:43:10', NULL, '872387234', '2024-04-10 18:06:50', '2024-04-11 18:53:30'),
(10, 4, 'CMPK/04/2024/8y07Y', 100000, 100000, 'terkirim', 'Jalan Sidakarya gang 70', '115.22692948579791', '-8.700765299230328', NULL, NULL, 'JNT EXPRESS', 20000, 'BCA', '87823723', 'I Kadek Surya Indrawan', '013442a2c9dc92f4b33ce844efc4b37f4_Bukti_Bayar_destination-3.jpg', '2024-04-11 23:25:27', NULL, '892839323', '2024-04-10 18:30:18', '2024-04-11 16:14:13'),
(12, 4, 'CMPK/04/2024/UhpFe', 4600000, 4580000, 'diterima', 'Jalan bukit jimbaran', '115.17122268676759', '-8.778273495910957', 'INIVOUCHER', 20000, 'JNE', 30000, 'Mandiri', '23132', 'I Kadek Surya Indrawan', '26bdd9e69179faefa418d951b885a5364_Bukti_Bayar_destination-8.jpg', '2024-04-12 03:01:53', NULL, '342423454', '2024-04-11 19:00:07', '2024-04-11 19:51:18'),
(15, 5, 'CMPK/04/2024/3nt9w', 1200000, 1180000, 'pending', 'Jalan Sidakarya', '115.2129364013672', '-8.702121748091635', 'INIVOUCHER', 20000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-04-12 06:25:08', '2024-04-12 06:25:08'),
(16, 6, 'CMPK/04/2024/zZqdv', 2500000, 2480000, 'diterima', NULL, NULL, NULL, 'INIVOUCHER', 20000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-04-12 13:58:23', '2024-04-12 13:58:23'),
(17, 6, 'CMPK/04/2024/fDRbF', 1300000, 1300000, 'diterima', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-04-12 15:41:23', '2024-04-12 15:41:23');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `qty` int NOT NULL,
  `total` double NOT NULL,
  `rating` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review` text COLLATE utf8mb4_unicode_ci,
  `media` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_id`, `qty`, `total`, `rating`, `review`, `media`, `created_at`, `updated_at`) VALUES
(17, 9, 2, 2, 400000, '5', NULL, NULL, '2024-04-10 18:06:50', '2024-04-11 18:56:31'),
(18, 9, 4, 2, 4000000, '4', NULL, NULL, '2024-04-10 18:06:50', '2024-04-11 18:56:31'),
(19, 10, 1, 1, 100000, NULL, NULL, NULL, '2024-04-10 18:30:18', '2024-04-11 18:56:31'),
(21, 12, 4, 2, 4000000, '1', 'produknya kureng', 'a3e8caf5c836401ae9a827e333cae0d3_Media_destination-6.jpg', '2024-04-11 19:00:07', '2024-04-11 19:51:18'),
(22, 12, 2, 3, 600000, '1', NULL, 'a3e8caf5c836401ae9a827e333cae0d3_Media_destination-11.jpg', '2024-04-11 19:00:07', '2024-04-11 19:51:18'),
(26, 15, 3, 1, 1000000, NULL, NULL, NULL, '2024-04-12 06:25:08', '2024-04-12 06:25:08'),
(27, 15, 1, 2, 200000, NULL, NULL, NULL, '2024-04-12 06:25:08', '2024-04-12 06:25:08'),
(28, 16, 2, 1, 200000, NULL, NULL, NULL, '2024-04-12 13:58:23', '2024-04-12 13:58:23'),
(29, 16, 1, 3, 300000, NULL, NULL, NULL, '2024-04-12 13:58:23', '2024-04-12 13:58:23'),
(30, 16, 3, 2, 2000000, NULL, NULL, NULL, '2024-04-12 13:58:23', '2024-04-12 13:58:23'),
(31, 17, 1, 3, 300000, NULL, NULL, NULL, '2024-04-12 15:41:23', '2024-04-12 15:41:23'),
(32, 17, 3, 1, 1000000, NULL, NULL, NULL, '2024-04-12 15:41:23', '2024-04-12 15:41:23');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `status` enum('active','deactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int NOT NULL,
  `rated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `nama_produk`, `deskripsi`, `price`, `status`, `img`, `stok`, `rated`, `created_at`, `updated_at`) VALUES
(1, 2, 'Test produk', 'mantap', 100000, 'active', 'da175819e25fbb96d59dbd22f445b661_Foto_Produk_5.jpg', 7, NULL, '2024-04-06 07:21:46', '2024-04-12 15:41:23'),
(2, 1, 'jdjdnd', 'wadwad', 200000, 'active', '6532a050288a241633163ae1b9f39a1c_Foto_Produk_7.jpg', 25, '3', '2024-04-06 07:22:13', '2024-04-12 13:58:23'),
(3, 1, 'GOD', 'awdawdawd', 1000000, 'active', '24a765d60a364ffabfefb39887f0f05a_Foto_Produk_3.jpg', 35, NULL, '2024-04-06 07:22:37', '2024-04-12 15:41:23'),
(4, 2, 'aiwjdaw', 'dawwad', 2000000, 'active', '3ca37d4f20627ddd096d6df68d30ed9f_Foto_Produk_2.jpg', 16, '2.5', '2024-04-06 07:23:06', '2024-04-11 19:51:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','customer') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$GLur4tvYvMQUTUNRuVNBxu7rtBMB6yWz1QOIWer32oid1F.lm51Yy', 'admin', NULL, '2024-04-06 06:23:29', '2024-04-06 06:23:29'),
(5, 'surya', 'surya@gmail.com', NULL, '$2y$10$wHQi/1zgrZnZ/I6dChXbP.ZXTfOFCKOTGLaX29bNvciyiBjHR3W8C', 'customer', NULL, '2024-04-08 07:40:21', '2024-04-08 07:40:21'),
(6, 'kadek', 'kadek@gmail.com', NULL, '$2y$10$be9/hOyZIPhPiaxn9Umy6ONUCDjKdb/yBaZSnWXm9e6qXsNyVEaVS', 'customer', NULL, '2024-04-09 16:51:09', '2024-04-09 16:51:09');

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` double NOT NULL,
  `status` enum('tersedia','tidak tersedia') COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar_voucher` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id`, `nama`, `nominal`, `status`, `deskripsi`, `gambar_voucher`, `created_at`, `updated_at`) VALUES
(1, 'INIVOUCHER', 20000, 'tersedia', 'awddawdaw', '9cd0b414a3a8f71cde6488dfdbe53af5_Voucher_5.jpg', '2024-04-06 08:23:18', '2024-04-06 08:23:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
