-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 12, 2025 at 08:14 AM
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
-- Database: `db-pesan`
--

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int NOT NULL,
  `bank_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `rekening` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `bank_name`, `rekening`) VALUES
(1, 'BCA', '1234567890'),
(2, 'BRI', '9876543210'),
(3, 'BNI', '1122334455'),
(4, 'mandiri', '5678901234');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'Riki Kurniawan', 'riki16004@gmail.com', '082181050791', '2024-10-02 07:55:10', '2024-10-02 07:55:10'),
(2, 'Ari Kenyot', 'arikenyot84@gmail.com', '082181050791', '2024-10-02 07:56:52', '2024-10-02 07:56:52'),
(3, 'Ari Kenyot', 'arikenyot84@gmail.com', '082181050791', '2024-10-02 08:02:57', '2024-10-02 08:02:57'),
(4, 'Ari Kenyot', 'arikenyot84@gmail.com', '082181050791', '2024-10-02 08:03:03', '2024-10-02 08:03:03'),
(5, 'Ari Kenyot', 'arikenyot84@gmail.com', '082181050791', '2024-10-02 08:04:31', '2024-10-02 08:04:31'),
(6, 'Ari Kenyot', 'arikenyot84@gmail.com', '085609725797', '2024-10-02 08:06:54', '2024-10-02 08:06:54');

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `bank` enum('bca','bni','bri','mandiri') NOT NULL,
  `rekening` varchar(50) NOT NULL,
  `nominal` int NOT NULL,
  `status` varchar(50) DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('sent','failed') COLLATE utf8mb4_general_ci DEFAULT 'sent',
  `send_status` enum('send','failed') COLLATE utf8mb4_general_ci DEFAULT 'send',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `message`, `status`, `send_status`, `created_at`, `updated_at`) VALUES
(2, 'Ari Kenyot', 'arikenyot84@gmail.com', 'hello bro', 'sent', 'send', NULL, NULL),
(3, 'Riki kurniawan', 'arikenyot84@gmail.com', 'hello whatsapp bro', 'sent', 'send', NULL, NULL),
(4, 'Ari Kenyot', 'arikenyot84@gmail.com', 'hello brow', 'sent', 'send', NULL, NULL),
(5, 'Ari Kenyot', 'arikenyot84@gmail.com', 'ini adalah tes', 'sent', 'send', NULL, NULL),
(7, 'riki', 'dian@gmail.com', 'test', 'sent', 'send', NULL, NULL),
(8, 'aditya', 'aditya@gmail.com', 'hallo bro', 'sent', 'send', NULL, NULL),
(9, 'aditya', 'aditya@gmail.com', 'hallo bro', 'sent', 'send', NULL, NULL),
(10, 'aditya', 'aditya@gmail.com', 'hallo bro', 'sent', 'send', NULL, NULL),
(11, 'aditya', 'aditya@gmail.com', 'hallo bro', 'sent', 'send', NULL, NULL),
(12, 'aditya', 'aditya@gmail.com', 'hallo bro', 'sent', 'send', NULL, NULL),
(13, 'iqbal rangga saputra', 'iqbalranggamusthofik@gmail.com', 'hallo bos', 'sent', 'send', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2024-08-21-093449', 'App\\Database\\Migrations\\CreateMessagesTable', 'default', 'App', 1724233340, 1),
(2, '2024-09-21-174838', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1726941047, 2);

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int NOT NULL,
  `message_id` int UNSIGNED NOT NULL,
  `reply` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `message_id`, `reply`, `created_at`) VALUES
(4, 8, 'ya', '2024-08-22 11:11:57'),
(5, 13, 'ya anj', '2024-08-22 13:41:22');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int NOT NULL,
  `nama_user` varchar(25) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `no_hp` varchar(25) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  `level` int DEFAULT NULL,
  `poto` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `email`, `no_hp`, `password`, `level`, `poto`) VALUES
(3, 'Budi', 'uchihairsal@gmail.com', '082181050791', '1234', 3, 'user2.png'),
(4, 'Riki Kurniawan', 'arikenyot84@gmail.com', '082181050791', '1234', 2, 'user1.png'),
(5, 'Riki Kurniawan', 'riki16004@gmail.com', '082181050791', '1234', 1, 'user.png');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `type` enum('deposit','belanja') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `details` text NOT NULL,
  `status` enum('pending','sukses','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deposit_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `type`, `amount`, `details`, `status`, `created_at`, `deposit_id`) VALUES
(90, 4, 'deposit', '19000000.00', 'Deposit ke BCA - Rekening: 1234567890', 'pending', '2025-03-11 08:38:51', NULL),
(91, 4, 'deposit', '1999.00', 'Deposit ke BCA - Rekening: 1234567890', 'pending', '2025-03-11 08:53:10', NULL),
(92, 4, 'deposit', '100000.00', 'Deposit ke BCA - Rekening: 1234567890', 'pending', '2025-03-11 08:58:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `saldo` bigint NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `skin` enum('merah','biru','kuning','hijau','black') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'black',
  `level` tinyint(1) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `registered_at` datetime DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `reset_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `saldo`, `phone`, `email`, `username`, `password`, `skin`, `level`, `status`, `registered_at`, `photo`, `created_at`, `updated_at`, `reset_token`) VALUES
(4, 'ayunda rara', 6450250140, '082181050792', 'uchihairsal@gmail.com', 'rara', '$2y$10$O5b4Amoxleb05q5w2MddguPB3m7brXyCO3dCYEB5bVJ2nvi3s0q0i', 'black', 3, 'inactive', '2024-09-23 00:59:53', 'user1.png', '2024-09-23 07:59:53', '2025-03-11 14:16:42', NULL),
(8, 'Riki Kurniawan', 10000, '082181050791', 'riki16004@gmail.com', 'admin', '$2y$10$qLCk1BcU9/V7KzYpTlaUV.Clm6eLVKMmwNRwkqKAG5CLOUJUUAI3S', 'black', 1, 'inactive', '2024-10-02 15:37:26', '1727883446_89ca96d5cb4843bcf2ff.jpg', '2024-10-02 22:37:26', '2025-03-10 12:08:25', '7f5c130678462a91b60a20d14f8241d727d4a17941b3aa6b5b9d0fb7adc5ccc32a66ac5628e61c397bc414978522bcfaf08c'),
(9, 'ayunda', 199000, '0821810507912', 'erwin.saktia.putra@gmail.com', 'ayundarara', '$2y$10$5U3pVq5kSu0GTxgNxAJ8B.u3nEG1lr/7MX35CpmMPrm9MPgky1IAS', 'black', 1, 'inactive', '2025-02-17 02:24:07', '1739759047_a124a969deabf77777aa.jpg', '2025-02-17 09:24:07', '2025-03-10 12:06:45', 'a280247992c0145cb82f8dbda8179d9712f279bdf9341b62c0953ee23a8d78910451d7f9f4aedb4eb8c485392537fc289071'),
(10, 'sukasuka', 0, '08888888888888888', 'erpan@gmail.com', 'sukaku', '$2y$10$waxTjsnDjZ6ejk/rAzxEQ.mVbg6.lvTWRylJOwgGvelqYWmEEBz9i', 'black', 3, 'inactive', '2025-03-05 06:52:57', '1741157577_71dc5d63c0287e7902ac.jpg', '2025-03-05 13:52:57', '2025-03-05 13:52:57', NULL),
(11, 'JOKO', 0, '08218105079122', 'arikenyot84@gmail.com', 'JOKO', '$2y$10$wHtnqAqeMtK8t8z9tjVTN.CR6SjFIIDUb6q8tlAS.vgY2T7Uy0CjK', 'black', 3, 'inactive', '2025-03-10 12:13:08', '1741583587_93af04d1ddaa041e7fa2.jpg', '2025-03-10 12:13:08', '2025-03-10 12:14:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `skin` varchar(50) DEFAULT NULL,
  `level` int NOT NULL,
  `registered_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `saldo` int NOT NULL DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `phone`, `email`, `username`, `password`, `skin`, `level`, `registered_at`, `photo`, `created_at`, `updated_at`, `saldo`, `status`) VALUES
(1, 'Riki Kurniawan', '082181050791', 'riki16004@gmail.com', 'riki16004', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'default_skin_color', 1, '2024-09-21 18:37:33', 'user.png', '2024-09-21 18:37:33', '2024-09-21 18:37:33', 0, 'active'),
(4, 'Ayunda Rara', '081234567890', 'rara@example.com', 'rara', 'hashed_password', 'default_skin', 3, '2025-03-04 21:51:46', 'user1.png', '2025-03-04 21:51:46', '2025-03-10 05:06:09', 19999, 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_id` (`message_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_deposit` (`deposit_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_deposit` FOREIGN KEY (`deposit_id`) REFERENCES `deposits` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
