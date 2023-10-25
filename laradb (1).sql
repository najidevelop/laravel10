-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 24, 2023 at 02:18 PM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laradb`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `desc` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `sequence` int DEFAULT NULL,
  `updateuserid` int DEFAULT NULL,
  `createuserid` int DEFAULT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `desc`, `parent_id`, `sequence`, `updateuserid`, `createuserid`, `status`, `created_at`, `updated_at`) VALUES
(11, 'electronic', 'electronic', NULL, 0, 0, 2, NULL, 1, '2023-07-20 16:27:40', '2023-07-26 14:06:18'),
(12, 'mobile', 'mobile', '<p>lojun</p>', 11, 0, 2, NULL, 1, '2023-07-20 16:28:11', '2023-07-26 14:06:18'),
(13, 'TV1', 'tv1', '<p>wqfwqf</p>', 11, 1, NULL, NULL, 1, '2023-07-20 16:55:26', '2023-07-26 14:06:18'),
(14, '43inch', '43inch', NULL, 13, 2, 2, NULL, 1, '2023-07-20 16:56:37', '2023-07-26 14:06:18'),
(15, 'home devices', 'home-devices', NULL, 0, 1, 2, NULL, 1, '2023-07-23 08:42:52', '2023-07-26 14:07:12'),
(16, 'مواد غذائية', 'moad-ghthayy', NULL, 0, 2, 2, NULL, 1, '2023-07-23 08:45:38', '2023-07-27 06:33:24'),
(17, 'samsung', 'samsung', NULL, 12, 1, 2, NULL, 1, '2023-07-23 13:43:47', '2023-07-26 14:06:18'),
(18, 'A series', 'a-series', NULL, 17, 2, 2, NULL, 1, '2023-07-23 13:48:15', '2023-07-26 14:06:18'),
(19, 'J series', 'j-series', NULL, 17, 4, 2, NULL, 1, '2023-07-24 13:16:50', '2023-10-20 11:38:49'),
(20, 'Note', 'note', NULL, 17, 3, NULL, NULL, 1, '2023-07-24 13:17:10', '2023-10-20 11:38:49'),
(22, 'new cat', '12ww', NULL, 0, 0, 2, 2, 1, '2023-07-26 09:43:14', '2023-07-26 14:06:52'),
(24, 'لحوم', 'lhom', NULL, 16, 0, 2, 2, 1, '2023-07-26 13:48:47', '2023-07-27 06:43:16'),
(25, 'معلبات', 'maalbat', NULL, 16, 1, 2, 2, 1, '2023-07-26 13:49:01', '2023-07-27 06:43:16'),
(26, 'دجاج', 'dgag', NULL, 24, 2, 2, 2, 1, '2023-07-26 13:49:31', '2023-07-27 06:43:16'),
(27, 'غنم', 'ghnm', NULL, 24, 1, 2, 2, 1, '2023-07-26 13:49:52', '2023-07-27 06:43:16'),
(28, 'طون', 'ton', NULL, 25, 2, 2, 2, 1, '2023-07-26 13:50:22', '2023-07-27 06:43:16'),
(29, 'مرتديلا', 'mrtdyla', NULL, 25, 0, 2, 2, 0, '2023-07-26 13:50:40', '2023-07-27 06:34:01'),
(30, 'post1', 'post1', NULL, 25, 0, 2, 2, 1, '2023-10-20 15:37:41', '2023-10-20 15:37:41'),
(31, 'new', 'new', '<p>cc</p>', 11, 0, 2, 2, 1, '2023-10-22 09:03:32', '2023-10-22 09:03:32');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(15, '2014_10_12_000000_create_users_table', 1),
(16, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(17, '2019_08_19_000000_create_failed_jobs_table', 1),
(18, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(19, '2023_07_08_202700_create_categories_table', 1),
(20, '2023_07_08_202739_create_posts_table', 1),
(21, '2023_07_25_124026_add_status_to_categories_table', 2),
(22, '2023_07_25_124026_add_create_to_categories_table', 3),
(23, '2023_07_26_084407_add_status_to_posts_table', 4),
(24, '2023_07_26_084653_add_status_to_users_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('najyms@gmail.com', '$2y$10$RVaIZ5TUU8uYd0btikvTAu6p5z3vEDZ8MgbA/JdNd/ig4oYK.8dOa', '2023-10-20 11:25:01');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb3_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `content` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `sequence` int DEFAULT NULL,
  `updateuserid` int DEFAULT NULL,
  `createuserid` int DEFAULT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `content`, `category_id`, `sequence`, `updateuserid`, `createuserid`, `status`, `created_at`, `updated_at`) VALUES
(2, 'new22', 'new22', '<p>vvvv</p>', 11, 1, 2, 2, 1, '2023-10-22 09:13:23', '2023-10-22 16:04:14'),
(4, 'samsung', 'samsung', '<p>zxzd</p>', 12, 0, 2, 2, 1, '2023-10-22 09:24:26', '2023-10-22 11:20:36'),
(6, 'Apple', 'apple', '<p>mobile</p>', 12, 0, 2, 2, 1, '2023-10-22 11:59:34', '2023-10-22 11:59:34'),
(7, 'post2', 'post2', '<p>dwfw</p>', 13, 0, 2, 2, 1, '2023-10-22 15:39:29', '2023-10-22 15:39:29'),
(8, 'electpost', 'electpost', '<p>626</p>', 11, 0, 2, 2, 1, '2023-10-22 15:59:50', '2023-10-22 16:04:03'),
(9, 'electpost2', 'electpost2', '<p>51b</p>', 11, 2, 2, 2, 1, '2023-10-22 16:00:10', '2023-10-22 16:04:14'),
(10, 'no category', 'no-category', '<p>uyvuy</p>', 0, 0, 2, 2, 1, '2023-10-22 16:44:47', '2023-10-22 16:44:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `role` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updateuserid` int DEFAULT NULL,
  `createuserid` int DEFAULT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `last_name`, `email`, `address`, `country`, `city`, `mobile`, `phone`, `photo`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `updateuserid`, `createuserid`, `status`) VALUES
(2, 'admin', NULL, NULL, 'najyms@gmail.com', NULL, 'syria', 'halab', NULL, NULL, '363682.png', 'admin', NULL, '$2y$10$QgMvP81Hhqjc4b.6JwDIBO2lVKxOPJNp5WPEjPTMuld5ZbE7aXz5S', '9jO0zXAhuQ1OXOer96rj0UJibFGZZbNylBmVmnfjjU7OekQNdhc4wdmOsqWI', '2023-07-17 16:17:11', '2023-07-17 16:18:36', NULL, NULL, 0),
(3, 'ahmad', 'ahmad', 'ms', 'admin@gmail.com', NULL, 'syria', 'halab', NULL, NULL, NULL, 'admin', NULL, '$2y$10$qUxPKJtWVzUT73m73J95heW2e8cZWRsozdzaPhamXnV3JybHVcFnS', NULL, '2023-07-17 16:21:13', '2023-07-17 16:21:13', NULL, NULL, 0),
(5, '2ahmad', NULL, NULL, 'dsw@ononon.com', NULL, NULL, NULL, NULL, NULL, NULL, 'customer', NULL, '$2y$10$QgMvP81Hhqjc4b.6JwDIBO2lVKxOPJNp5WPEjPTMuld5ZbE7aXz5S', NULL, '2023-10-20 11:35:10', '2023-10-20 11:35:10', NULL, NULL, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
