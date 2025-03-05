-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jan 29, 2017 at 03:26 AM
-- Server version: 10.1.9-MariaDB-log
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sja`
--

-- --------------------------------------------------------

--
-- Table structure for table `cabang`
--

CREATE TABLE `cabang` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode_cabang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama_cabang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `divisi` int(11) NOT NULL,
  `utama` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cabang`
--

INSERT INTO `cabang` (`id`, `kode_cabang`, `nama_cabang`, `divisi`, `utama`, `created_at`, `updated_at`) VALUES
(1, 'BGD1', 'Bandung 1', 1, 0, '2017-01-25 11:31:34', '2017-01-25 11:31:34'),
(2, 'BGD2', 'Bandung 2', 1, 0, '2017-01-25 11:31:34', '2017-01-25 11:31:34'),
(3, 'KAL1', 'Kalimantan 1', 2, 0, '2017-01-25 11:31:34', '2017-01-25 11:31:34');

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_divisi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id`, `nama_divisi`, `created_at`, `updated_at`) VALUES
(1, 'Samudera Jaya Abadi', '2017-01-25 11:31:33', '2017-01-25 11:31:33'),
(2, 'Samudera Atlantik', '2017-01-25 11:31:34', '2017-01-25 11:31:34');

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id` int(10) UNSIGNED NOT NULL,
  `no_polisi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama_kendaraan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `supir` int(11) NOT NULL,
  `notelp_supir` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kernet` int(11) NOT NULL,
  `notelp_kernet` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grup` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cabang` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id`, `no_polisi`, `nama_kendaraan`, `supir`, `notelp_supir`, `kernet`, `notelp_kernet`, `grup`, `cabang`, `created_at`, `updated_at`) VALUES
(1, 'D 6543 SIN', 'Serba Guna Abadi', 4, '085643212345', 5, '087765433456', 'Endah Mekar Jaya Surapati Core Edan Eling', 1, '2017-01-26 02:51:49', '2017-01-26 05:13:01');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(10, '2014_10_12_000000_create_users_table', 1),
(11, '2014_10_12_100000_create_password_resets_table', 1),
(12, '2017_01_24_091404_entrust_setup_tables', 1),
(13, '2017_01_25_140515_create_table_divisi', 1),
(14, '2017_01_25_143257_create_table_cabang', 1),
(15, '2017_01_25_175957_create_table_penjualan', 1),
(16, '2017_01_26_093717_create_table_kendaraan', 2),
(17, '2017_01_26_135107_create_truck_table', 3),
(20, '2017_01_29_081744_create_table_req_pengambilan_barang', 4),
(21, '2017_01_29_110635_create_table_pengambilan_barang', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengambilan_barang`
--

CREATE TABLE `pengambilan_barang` (
  `id` int(10) UNSIGNED NOT NULL,
  `no_pengambilan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pengirim` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `supir` int(11) NOT NULL,
  `kernet` int(11) NOT NULL,
  `kendaraan` int(11) NOT NULL,
  `waktu_berangkat` datetime NOT NULL,
  `waktu_pulang` datetime NOT NULL,
  `tanggal` date NOT NULL,
  `cabang` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(10) UNSIGNED NOT NULL,
  `stt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kantor_asal` int(11) DEFAULT NULL,
  `kantor_tujuan` int(11) DEFAULT NULL,
  `pengirim` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `penerima` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alamat_penerima` text COLLATE utf8_unicode_ci,
  `penerus` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kode_penerus` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama_barang` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jumlah_colly` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `packing` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `berat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `harga_per_kilo` int(11) DEFAULT NULL,
  `harga_total` int(11) DEFAULT NULL,
  `ket_tambahan` text COLLATE utf8_unicode_ci,
  `kontak_penerima` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `cabang` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `stt`, `kantor_asal`, `kantor_tujuan`, `pengirim`, `penerima`, `alamat_penerima`, `penerus`, `kode_penerus`, `nama_barang`, `payment_type`, `jumlah_colly`, `packing`, `berat`, `harga_per_kilo`, `harga_total`, `ket_tambahan`, `kontak_penerima`, `user`, `cabang`, `created_at`, `updated_at`) VALUES
(3, '77852', 1, 3, 'Nanang', 'Muhridin', 'Jl. Onta nonggeng', '', NULL, 'Onta', 'Cash', '100', 'bal', '10.0', 50000, 500000, 'ga ada', '08972346234', 1, 1, '2017-01-27 07:36:55', '2017-01-28 07:30:41'),
(4, '40828', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5', 'bal', '100.0', NULL, NULL, NULL, NULL, NULL, 1, '2017-01-27 07:50:48', '2017-01-27 07:50:48'),
(5, '77624', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100', 'bal', '5.0', NULL, NULL, NULL, NULL, NULL, 1, '2017-01-27 07:52:39', '2017-01-27 07:52:39'),
(6, '88161', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8', 'bb', '3.0', NULL, NULL, NULL, NULL, NULL, 2, '2017-01-27 07:53:19', '2017-01-27 07:53:19'),
(7, '58567', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '22', 'gf', '2.0', NULL, NULL, NULL, NULL, NULL, 2, '2017-01-27 07:53:32', '2017-01-27 07:53:32'),
(8, '58551', 3, 1, 'Endang', 'Rahmat', 'cimahi', 'jne', '74', 'Peuyeum', 'cash', '800', 'karung/roll', '5.0', 500000, 2500000, 'Peuyeum kalimanten', '089656052522', 2, 3, '2017-01-27 07:54:31', '2017-01-28 12:39:09'),
(9, '08824', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9', 'bal', '20.0', NULL, NULL, NULL, NULL, NULL, 1, '2017-01-27 07:56:22', '2017-01-27 07:56:22');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'role', 'Role', 'Akses semua fitur role', '2017-01-25 11:39:53', '2017-01-25 11:39:53'),
(2, 'permission', 'Permission', 'Akses semua fitur permission', '2017-01-25 11:40:19', '2017-01-25 11:40:19'),
(3, 'divisi:create', 'Membuat Divisi', 'Akses fitur input divisi', '2017-01-25 11:41:21', '2017-01-25 11:41:21'),
(4, 'divisi:read', 'Melihat Divisi', 'Akses fitur lihat divisi', '2017-01-25 11:41:59', '2017-01-25 11:41:59'),
(5, 'divisi:update', 'Mengubah Divisi', 'Akses fitur ubah divisi', '2017-01-25 11:42:38', '2017-01-25 11:42:38'),
(6, 'divisi:delete', 'Menghapus Divisi', 'Akses fitur hapus divisi', '2017-01-25 11:43:03', '2017-01-25 11:43:03');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `req_pengambilan_barang`
--

CREATE TABLE `req_pengambilan_barang` (
  `id` int(10) UNSIGNED NOT NULL,
  `pengirim` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `penerima` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alamat_pengambilan` text COLLATE utf8_unicode_ci NOT NULL,
  `tujuan` text COLLATE utf8_unicode_ci NOT NULL,
  `jumlah_colly` int(11) NOT NULL,
  `cabang` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `user` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `req_pengambilan_barang`
--

INSERT INTO `req_pengambilan_barang` (`id`, `pengirim`, `penerima`, `alamat_pengambilan`, `tujuan`, `jumlah_colly`, `cabang`, `status`, `tanggal`, `user`, `created_at`, `updated_at`) VALUES
(1, 'Nurdin', 'Rahman', 'Jl. Pengambilan No. 189, Bandung', 'Jl. Tujuan No. 199, Kalimantan', 500, 1, 'done', '2017-01-29', 1, '2017-01-29 03:50:50', '2017-01-29 03:55:18'),
(2, 'Abdur', 'Dulce', 'Jl. Bandung No.1, Bandung', 'Jl. Bandung No.2, Bandung', 500, 1, 'new', '2017-01-29', 1, '2017-01-29 03:54:44', '2017-01-29 03:54:44');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', 'Akses semua fitur', '2017-01-25 11:37:49', '2017-01-25 11:37:49'),
(2, 'kepala-cabang', 'Kepala Cabang', 'CRUD cabang', '2017-01-25 11:38:34', '2017-01-25 12:13:05'),
(3, 'supir', 'Supir', 'Pengendara kendaraan / truck', '2017-01-26 00:53:27', '2017-01-26 00:53:27'),
(4, 'kernet', 'Kernet', 'Asisten Supir', '2017-01-26 00:53:45', '2017-01-26 00:53:45'),
(5, 'checker', 'Checker', 'Pengecek', '2017-01-26 09:26:18', '2017-01-26 09:26:18');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(3, 1),
(4, 3),
(5, 4),
(6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `truck`
--

CREATE TABLE `truck` (
  `id` int(10) UNSIGNED NOT NULL,
  `no_polisi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama_kendaraan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `supir` int(11) NOT NULL,
  `notelp_supir` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kernet` int(11) NOT NULL,
  `notelp_kernet` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grup` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `truck`
--

INSERT INTO `truck` (`id`, `no_polisi`, `nama_kendaraan`, `supir`, `notelp_supir`, `kernet`, `notelp_kernet`, `grup`, `created_at`, `updated_at`) VALUES
(1, 'D 9988 NN', 'Cinta Tak Terbalas', 4, '085643212345', 5, '087765433456', 'Anskilll', '2017-01-26 10:18:39', '2017-01-26 10:18:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cabang` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `cabang`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Septia Permana', 'septiapermana@gmail.com', '$2y$10$pBEGYvob6XvCap8h82viceMa2nW6YlW4Ly8qP9g19Xo2q.wzIhZq.', 1, 'mVmWkraqYw0pWhteFjcw1mZ3SXTmwXfaoXRBgiRLP5eUhSbAPGqT14BR4bIo', '2017-01-25 11:31:34', '2017-01-25 12:19:28'),
(2, 'Sani Sahidah', 'sani.sahidah@gmail.com', '$2y$10$55v2LToiIxSBMylFYMb4b.srZKBeKzxlAY6SVLcYDrySp.RZzI7Cu', 3, '4rKiFscsUcRFslODdfEAR5jDLDpmLC7Ek0qWqPiODIwK47eAeE3cw97XMhNn', '2017-01-25 11:58:31', '2017-01-26 02:31:12'),
(3, 'Delly Fathurachman', 'dellyarts@gmail.com', '$2y$10$QZd4Ya/okNEOFB3nXzLPpOMAAx4y9WOswN/P6kSnF3ZGG6xbZu8Pu', 2, NULL, '2017-01-25 11:58:56', '2017-01-25 11:59:25'),
(4, 'Dadang', 'dadangsuparmin@gmail.com', '$2y$10$HXBTxXH0ib0zrZnE9mpsaut4WF/bRNf0h2npvbQKwGWa9f8DP83VC', 1, NULL, '2017-01-26 00:54:21', '2017-01-26 00:54:21'),
(5, 'Suparmin', 'suparmin@gmail.com', '$2y$10$kPDwNgJR0N3UucQ5y6qugOcXCMinCk4tRGdMhJ5s6lzxPhc/W5M2y', 1, NULL, '2017-01-26 00:55:15', '2017-01-26 00:55:15'),
(6, 'Checker', 'checker@gmail.com', '$2y$10$am34vSLrWOy/kM8juZ5nqOTPSCFwwDhD6jf3Ljr0yDKKiLJ02npoK', 1, NULL, '2017-01-27 03:58:08', '2017-01-27 03:58:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
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
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `pengambilan_barang`
--
ALTER TABLE `pengambilan_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `req_pengambilan_barang`
--
ALTER TABLE `req_pengambilan_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `truck`
--
ALTER TABLE `truck`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `cabang`
--
ALTER TABLE `cabang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `pengambilan_barang`
--
ALTER TABLE `pengambilan_barang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `req_pengambilan_barang`
--
ALTER TABLE `req_pengambilan_barang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `truck`
--
ALTER TABLE `truck`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
