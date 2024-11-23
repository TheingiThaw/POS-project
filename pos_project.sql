-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2024 at 02:43 PM
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
-- Database: `pos_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `action_logs`
--

CREATE TABLE `action_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `action` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Sugar Apple', '2024-11-23 03:49:49', '2024-11-23 03:49:49'),
(2, 'Banana', '2024-11-23 03:49:53', '2024-11-23 03:49:53'),
(3, 'Papaya', '2024-11-23 03:50:00', '2024-11-23 03:50:00'),
(4, 'Mango', '2024-11-23 03:50:20', '2024-11-23 03:50:20'),
(5, 'Jackfruit', '2024-11-23 03:50:27', '2024-11-23 03:50:27'),
(6, 'Guava', '2024-11-23 03:50:32', '2024-11-23 03:50:32');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `product_id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 4, 3, 'Really like it', '2024-11-23 05:18:50', '2024-11-23 05:18:50');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_11_04_055121_create_categories_table', 1),
(5, '2024_11_04_074748_create_products_table', 1),
(6, '2024_11_04_075023_create_discounts_table', 1),
(7, '2024_11_04_075140_create_comments_table', 1),
(8, '2024_11_04_075153_create_ratings_table', 1),
(9, '2024_11_04_075326_create_carts_table', 1),
(10, '2024_11_04_075433_create_payments_table', 1),
(11, '2024_11_04_075625_create_orders_table', 1),
(12, '2024_11_04_075737_create_contacts_table', 1),
(13, '2024_11_04_075858_create_action_logs_table', 1),
(14, '2024_11_18_093351_create_payment_histories_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `user_id`, `count`, `status`, `order_code`, `created_at`, `updated_at`) VALUES
(1, 10, 2, 4, '2', 'OC-POS-8758420', '2024-11-23 04:11:16', '2024-11-23 07:10:04'),
(2, 6, 2, 3, '2', 'OC-POS-8758420', '2024-11-23 04:11:16', '2024-11-23 07:10:04'),
(3, 1, 2, 3, '2', 'OC-POS-2128019', '2024-11-23 04:13:06', '2024-11-23 07:09:55'),
(4, 4, 2, 2, '2', 'OC-POS-2128019', '2024-11-23 04:13:06', '2024-11-23 07:09:55'),
(5, 8, 2, 3, '2', 'OC-POS-2128019', '2024-11-23 04:13:06', '2024-11-23 07:09:55'),
(6, 4, 3, 2, '1', 'OC-POS-5425362', '2024-11-23 05:20:00', '2024-11-23 06:52:53'),
(7, 8, 3, 7, '1', 'OC-POS-5425362', '2024-11-23 05:20:00', '2024-11-23 06:52:53');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `type` char(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `account_number`, `account_name`, `type`, `created_at`, `updated_at`) VALUES
(1, '09787878654', 'Giselle', 'Kpay', '2024-11-23 03:51:12', '2024-11-23 03:51:12'),
(2, '09454545231', 'Giselle', 'AYA Pay', '2024-11-23 03:51:33', '2024-11-23 03:51:33'),
(3, '000067583627322', 'Crystal', 'CB Bank', '2024-11-23 03:52:03', '2024-11-23 03:52:03'),
(4, '000046568390004', 'Jessica', 'KBZ Bank', '2024-11-23 03:52:28', '2024-11-23 03:52:28');

-- --------------------------------------------------------

--
-- Table structure for table `payment_histories`
--

CREATE TABLE `payment_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `payslip_image` varchar(255) NOT NULL,
  `total_amt` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_histories`
--

INSERT INTO `payment_histories` (`id`, `user_name`, `phone`, `address`, `payment_method`, `order_code`, `payslip_image`, `total_amt`, `created_at`, `updated_at`) VALUES
(1, 'Vernon', '09123123123', 'New York', 'Kpay', 'OC-POS-8758420', '6741b14c0504cimages (1).png', '14000', '2024-11-23 04:11:16', '2024-11-23 04:11:16'),
(2, 'Vernon', '09678678678', 'Mosco', 'KBZ Bank', 'OC-POS-2128019', '6741b1ba34eccimages (1).png', '61000', '2024-11-23 04:13:06', '2024-11-23 04:13:06'),
(3, 'Joshua', '09123456789', 'East Los Angeles', 'AYA Pay', 'OC-POS-5425362', '6741c168337beimages (1).png', '20000', '2024-11-23 05:20:00', '2024-11-23 05:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` bigint(20) NOT NULL,
  `description` longtext NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `category_id`, `stock`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Jackfruit L', 15000, 'Ripe yellow jackfruit has a subtly sweet flavor,as a combination of banana, apple, and mango. Young green jackfruit has a neutral flavor and texture similar to shredded meat, making it a popular meat substitute in savory dishes.', '1', 20, '6741ad9999b4b1709276392114.jpg', '2024-11-23 03:55:29', '2024-11-23 05:40:12'),
(2, 'Jackfruit S', 10000, 'Ripe yellow jackfruit has a subtly sweet flavor,as a combination of banana, apple, and mango. Young green jackfruit has a neutral flavor and texture similar to shredded meat, making it a popular meat substitute in savory dishes.', '5', 10, '6741adc1d098a11.web_images_junejuly24_655x368_aisles_4_things_jackfruit.jpg', '2024-11-23 03:56:09', '2024-11-23 03:56:09'),
(3, 'Banana', 3000, 'melon, pineapple, candy and clove flavour notes. Yellow bananas have higher sugar concentrations and therefore taste sweeter.', '2', 10, '6741adec9f961new_ambon-banana-thumbnail.png', '2024-11-23 03:56:52', '2024-11-23 03:56:52'),
(4, 'Burmese Banana', 4000, 'melon, pineapple, candy and clove flavour notes. Yellow bananas have higher sugar concentrations and therefore taste sweeter.', '1', 1, '6741ae10163f9images.jpg', '2024-11-23 03:57:28', '2024-11-23 06:52:53'),
(5, 'Papaya', 3000, 'a ripened papaya will be juicy, sweet and similar to cantaloupe in flavor, although some types may be musky', '3', 15, '6741ae4b64bfepapaya-health-benefits.jpg', '2024-11-23 03:58:27', '2024-11-23 03:58:27'),
(6, 'Sugar apple S', 1000, 'its flesh has a pleasant sweet flavor and a highly juicy texture. for most, its taste is distinctly creamy, like that of custard.', '1', 7, '6741aeb270d8ecustard-apple-1.jpg', '2024-11-23 04:00:10', '2024-11-23 04:00:10'),
(7, 'Sugar Apple L', 1500, 'its flesh has a pleasant sweet flavor and a highly juicy texture. for most, its taste is distinctly creamy, like that of custard.', '1', 13, '6741aed76ad4961PYVsMCdHL._AC_UF894,1000_QL80_.jpg', '2024-11-23 04:00:47', '2024-11-23 04:00:47'),
(8, 'Yin Kwal', 1000, 'soft & juicy and emits a sweet fragrance. It has a fresh and sweet taste and depending on the variety, its colour ranges from matte green to pale orange and sunshine yellow. The texture is fibrous, and its consistency is buttery.', '4', 23, '6741af20cc1admango-1-1024x673.jpg', '2024-11-23 04:02:00', '2024-11-23 06:52:53'),
(9, 'Ma Chit Su', 1000, 'soft & juicy and emits a sweet fragrance. It has a fresh and sweet taste and depending on the variety, its colour ranges from matte green to pale orange and sunshine yellow. The texture is fibrous, and its consistency is buttery.', '4', 20, '6741af3a4714cproduct-packshot-mango.jpg', '2024-11-23 04:02:26', '2024-11-23 04:02:26'),
(10, 'Diamond Mango', 1500, 'soft & juicy and emits a sweet fragrance. It has a fresh and sweet taste and depending on the variety, its colour ranges from matte green to pale orange and sunshine yellow. The texture is fibrous, and its consistency is buttery.', '1', 3, '6741af6216d65yellow-mango.jpeg', '2024-11-23 04:03:06', '2024-11-23 05:36:03');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `product_id`, `user_id`, `count`, `created_at`, `updated_at`) VALUES
(1, 4, 3, 3, '2024-11-23 05:18:35', '2024-11-23 05:18:35'),
(2, 1, 2, 4, '2024-11-23 07:13:09', '2024-11-23 07:13:09');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('bClt1upXMNAaPrrBKwBu1h3VBBHK73cuP8GVKtd5', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoia1V0SGZJSlZkOXoyeXJ1MXI0eEMwVHlnV2FCcEo5cnkwWG1YN09PcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1732362669),
('zIBZ3bg8OxjdVzajFjXI0OeDPZkWkMx0zxehhbsD', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSEQxcGFHTEd1ZDM5dUtobm1sd3ZtelU2Zml3b045S3ROV3Q0ZDhTUCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1732369413);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT 'user',
  `provider` varchar(255) NOT NULL DEFAULT 'simple',
  `provider_id` varchar(255) DEFAULT NULL,
  `provider_token` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `nickname`, `email`, `email_verified_at`, `password`, `phone`, `address`, `profile`, `role`, `provider`, `provider_id`, `provider_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'superadmin', 'superadmin@gmail.com', NULL, '$2y$12$lR3fvpmdsQFQYXxUp9tJ7uF38pI4XNH9JmaXc9yciGp1yPRrY6NeW', '09456456456', 'Hong Kong', NULL, 'superadmin', 'simple', NULL, NULL, NULL, NULL, '2024-11-23 00:29:37'),
(2, 'Vernon', NULL, 'vernon218@gmail.com', NULL, '$2y$12$ek5GwCuL0zwdTwSZ.iUNk.4FcdGCncBzQEZhGaQvRbjg/1KEYd5UO', '09656565656', 'New York', '6741b0e766553XNe1X_5f.jpg', 'user', 'simple', NULL, NULL, NULL, '2024-11-23 04:07:11', '2024-11-23 04:09:35'),
(3, 'Joshua', NULL, 'joshua@gmail.com', NULL, '$2y$12$792vjd5nZlDFw5zmNfTLjO.VF0VZ8WpJ4d8kzwBDJuI9LKIBKO0pC', '09456456456', NULL, NULL, 'user', 'simple', NULL, NULL, NULL, '2024-11-23 04:13:42', '2024-11-23 04:13:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_logs`
--
ALTER TABLE `action_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

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
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_histories`
--
ALTER TABLE `payment_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `action_logs`
--
ALTER TABLE `action_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_histories`
--
ALTER TABLE `payment_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
