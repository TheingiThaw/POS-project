-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2024 at 03:37 PM
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
(1, 'Guava', '2024-12-22 07:40:55', '2024-12-22 07:40:55'),
(2, 'Banana', '2024-12-22 07:41:03', '2024-12-22 07:41:03'),
(3, 'Mango', '2024-12-22 07:41:08', '2024-12-22 07:41:08'),
(4, 'Suger Apple', '2024-12-22 07:41:19', '2024-12-22 07:41:19'),
(5, 'Jack Fruit', '2024-12-22 07:41:25', '2024-12-22 07:41:25'),
(6, 'Papaya', '2024-12-22 07:41:31', '2024-12-22 07:41:31');

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
(1, 7, 3, 2, '1', 'OC-POS-8281088', '2024-12-22 08:03:26', '2024-12-22 08:06:19'),
(2, 10, 3, 2, '1', 'OC-POS-8281088', '2024-12-22 08:03:26', '2024-12-22 08:06:19');

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
(1, '09987654321', 'Luna', 'Kpay', '2024-12-22 07:41:49', '2024-12-22 07:41:49'),
(2, '000034567890100', 'Ember', 'CBPay', '2024-12-22 07:42:00', '2024-12-22 07:42:00'),
(3, '09123456789', 'Crystal', 'AYAPay', '2024-12-22 07:42:09', '2024-12-22 07:42:09'),
(4, '000034567890100', 'Jessica', 'KBZ Bank', '2024-12-22 07:42:40', '2024-12-22 07:42:40');

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
(1, 'gi genevieve', '09123456789', 'Hendon, London', 'Kpay', 'OC-POS-8281088', '67682336c5baaimages (1).png', '39000', '2024-12-22 08:03:26', '2024-12-22 08:03:26');

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
(1, 'Diamond Mango', 1500, 'The flesh is firm, fiberless, and sweet with terrific Indochinese-hybrid type flavor. It is comparable to Dupuis Saigon. It contains a seed that is sometimes polyembryonic.', '3', 20, '67681ee8e8fe0yellow-mango.jpeg', '2024-12-22 07:45:04', '2024-12-22 07:45:04'),
(2, 'Ma Chit su', 1000, 'yellow to orange flesh that is aqueous, fibreless, and soft with a tender, succulent consistency when ripe', '3', 3, '67681f4a39ec7product-packshot-mango.jpg', '2024-12-22 07:46:42', '2024-12-22 07:46:42'),
(3, 'Yin Kwal', 1000, 'Myanmar mangoes release a fragrant aroma when ripe and are traditionally sweet and subtly sour with tangy, fruity, turpentine, and floral nuances.', '3', 30, '67681f7a43defmango-1-1024x673.jpg', '2024-12-22 07:47:30', '2024-12-22 07:47:30'),
(4, 'Sugar Apple S', 1000, 'soft to touch, and the segments slightly separate from the rest of the skin, exposing the pale interior. They contain several black oblong seeds that are inedible and potentially toxic', '4', 35, '67681fc0d1e8361PYVsMCdHL._AC_UF894,1000_QL80_.jpg', '2024-12-22 07:48:40', '2024-12-22 07:48:40'),
(5, 'Sugar Apple M', 1500, 'soft to touch, and the segments slightly separate from the rest of the skin, exposing the pale interior. They contain several black oblong seeds that are inedible and potentially toxic', '4', 3, '67681feb4906acustard-apple-1.jpg', '2024-12-22 07:49:23', '2024-12-22 07:49:23'),
(6, 'Papaya', 3000, 'has a sweet-tart flavor that is similar to cantaloupe or a more exotic mango. The taste of papaya can vary depending on the cultivar and production location', '6', 10, '6768201dab775papaya-health-benefits.jpg', '2024-12-22 07:50:13', '2024-12-22 07:50:13'),
(7, 'Burmese Banana', 4000, 'The fruit is nutritious and versatile, a source of essential nutrients and vitamins.', '2', 8, '676820afdb5e7images.jpg', '2024-12-22 07:52:39', '2024-12-22 08:06:19'),
(8, 'Banana', 3000, 'The fruit is nutritious and versatile, a source of essential nutrients and vitamins.', '2', 16, '676820d355cfanew_ambon-banana-thumbnail.png', '2024-12-22 07:53:15', '2024-12-22 07:53:15'),
(9, 'Jack Fruit S', 7000, 'an exotic fruit with a unique shredded meat-like texture', '5', 12, '676820fc1759011.web_images_junejuly24_655x368_aisles_4_things_jackfruit.jpg', '2024-12-22 07:53:56', '2024-12-22 07:53:56'),
(10, 'Jack Fruit L', 13000, 'an exotic fruit with a unique shredded meat-like texture', '5', 5, '6768211e74d181709276392114.jpg', '2024-12-22 07:54:30', '2024-12-22 08:06:19');

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
(1, 7, 3, 3, '2024-12-22 08:02:26', '2024-12-22 08:02:26');

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
('XW0W71p4zJNz2T3e2om5p7XxiG5ATLihUzSkMC6c', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQXdPM3dvamhEQXhlMjAxMWJkcEZ6bTlxNWhjUWxtc2piVkFNWXBJNyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1734878236);

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
(1, 'superadmin1', 'superadmin1', 'superadmin1@gmail.com', NULL, '$2y$12$ecOpBTikNhcRCv1vsg7obeNYu8h86MN0jAgkKXKkBJamwxUs42wxu', '09123456789', 'New York', NULL, 'superadmin', 'simple', NULL, NULL, NULL, NULL, '2024-12-22 07:40:41'),
(2, 'admin1', NULL, 'admin1@fruitables.com', NULL, '$2y$12$Tg.quIslv9bClEamwO60resPC25jeK8pd8ZSJCFJBkleG8OB7tjd.', NULL, NULL, NULL, 'admin', 'simple', NULL, NULL, NULL, '2024-12-22 07:57:57', '2024-12-22 07:57:57'),
(3, 'gi genevieve', NULL, 'gignvv@gmail.com', NULL, NULL, NULL, NULL, 'https://lh3.googleusercontent.com/a/ACg8ocK9J9Vw4_lBYCNqj3IhPQQf6NCJI8QPYeKoM8Oz8Bwl5srPVw=s96-c', 'user', 'google', '110030719820820425385', 'ya29.a0ARW5m75CmGp9yGEfmXtWj6MatWEdAJ0zOWBzfuhldW-69YUnoy2hOOyY5JJaD2NNyKeKfWeiOXFkTxoMg9pssX9MUrWQ487YKWaFQlu4IVGEku5p3CExFMYNd2j34fKHhfzFhsV3kebgETNlw5ODGwSSFugVGQUmrzoaCgYKAXcSARASFQHGX2MiA6dghxxU2yHF_BMhJwpMGg0170', NULL, '2024-12-22 08:00:03', '2024-12-22 08:00:03');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_histories`
--
ALTER TABLE `payment_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
