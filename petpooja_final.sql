-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2025 at 02:17 PM
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
-- Database: `petpooja_final`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `area_name` varchar(255) NOT NULL,
  `area_slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `area_name`, `area_slug`, `created_at`, `updated_at`) VALUES
(1, 'Ahmedabad', 'ahmedabad', '2025-02-03 11:06:54', '2025-02-03 11:06:54'),
(14, 'Dadar', 'dadar', '2025-02-13 00:12:55', '2025-02-13 00:12:55'),
(16, 'Chandkheda', 'chandkheda', '2025-02-13 01:48:26', '2025-02-13 01:48:26'),
(18, 'HSR Layout', 'hsr-layout', '2025-02-14 06:20:21', '2025-02-14 06:20:21');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('mukeshbhavsar210@gmail.com|127.0.0.1', 'i:2;', 1739971039),
('mukeshbhavsar210@gmail.com|127.0.0.1:timer', 'i:1739971038;', 1739971038),
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:19:{i:0;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:15:\"delete articles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}i:1;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:12:\"create roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:3;i:1;i:8;}}i:2;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:10:\"view roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:3;i:1;i:8;}}i:3;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:10:\"edit roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:3;i:1;i:8;}}i:4;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:12:\"delete roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}i:5;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:10:\"view users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}i:6;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:10:\"edit users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:3;i:1;i:8;}}i:7;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:16:\"view permissions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:3;i:1;i:8;}}i:8;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:18:\"create permissions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}i:9;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:16:\"edit permissions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}i:10;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:18:\"delete permissions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}i:11;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:16:\"Can create video\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:8;i:1;i:9;}}i:12;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:14:\"Can edit video\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:8;i:1;i:9;}}i:13;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:12:\"create users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:3;i:1;i:8;}}i:14;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:11:\"create post\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:8;}}i:15;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:9:\"edit post\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:8;}}i:16;a:3:{s:1:\"a\";i:22;s:1:\"b\";s:11:\"delete post\";s:1:\"c\";s:3:\"web\";}i:17;a:3:{s:1:\"a\";i:23;s:1:\"b\";s:11:\"create news\";s:1:\"c\";s:3:\"web\";}i:18;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:15:\"create category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:8;}}}s:5:\"roles\";a:3:{i:0;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:5:\"Admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:8;s:1:\"b\";s:7:\"Manager\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:9;s:1:\"b\";s:6:\"Editor\";s:1:\"c\";s:3:\"web\";}}}', 1739709404);

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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `created_at`, `updated_at`) VALUES
(198, 'Biriyani', 'biriyani', NULL, '2025-02-14 07:35:33', '2025-02-14 07:35:33'),
(199, 'Roti', 'roti', NULL, '2025-02-14 07:35:42', '2025-02-14 07:35:42'),
(200, 'Pulao', 'pulao', NULL, '2025-02-14 07:35:50', '2025-02-14 07:35:50'),
(201, 'Tea', 'tea', 'tea_1739540481.jpg', '2025-02-14 08:11:21', '2025-02-14 08:11:21'),
(202, 'Thali', 'thali', 'gujarathi-thali_1739604431.jpg', '2025-02-15 01:57:11', '2025-02-15 01:57:11');

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

CREATE TABLE `configurations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `sidebar` varchar(100) DEFAULT NULL,
  `taxes` varchar(100) DEFAULT NULL,
  `percentages` varchar(100) DEFAULT NULL,
  `plan` enum('Free','Weekly','Monthly','Yearly') NOT NULL DEFAULT 'Free',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`id`, `name`, `image`, `email`, `phone`, `address`, `sidebar`, `taxes`, `percentages`, `plan`, `created_at`, `updated_at`) VALUES
(81, 'Dhruv Bhavsar', 'Dhruv Bhavsar_1739703114.jpg', 'dhruvbhavsar210@gmail.com', '09978835005', 'Keerthi Royal Palms, Keerthi Royal Palms, Keerthi Royal Palms, Keerthi Royal Palms,', NULL, NULL, NULL, 'Free', '2025-02-16 05:21:54', '2025-02-16 05:21:54');

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
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `slug`, `category_id`, `created_at`, `updated_at`) VALUES
(94, 'Gujarathi Thali', 'gujarathi-thali', 202, '2025-02-16 04:58:47', '2025-02-16 04:58:47');

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
(4, '2025_01_16_051332_create_products_table', 1),
(5, '2025_01_26_135904_create_permission_tables', 2),
(6, '2025_01_27_085544_create_articles_table', 3),
(7, '2025_02_07_053307_create_configurations_table', 4),
(8, '2025_02_07_064057_create_taxes_table', 5),
(9, '2025_02_10_104544_create_views_table', 6),
(10, '2025_02_14_110036_create_payments_table', 7),
(11, '2025_02_15_105842_create_order_items_table', 8),
(12, '2025_02_16_104104_create_themes_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(3, 'App\\Models\\User', 6),
(6, 'App\\Models\\User', 4),
(8, 'App\\Models\\User', 2),
(8, 'App\\Models\\User', 3),
(8, 'App\\Models\\User', 6);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `order_type` enum('Dinein','Takeaway','Delivery') NOT NULL DEFAULT 'Dinein',
  `delivery_name` varchar(255) DEFAULT NULL,
  `delivery_phone` varchar(255) DEFAULT NULL,
  `delivery_email` varchar(255) DEFAULT NULL,
  `takeaway_name` varchar(255) DEFAULT NULL,
  `takeaway_phone` varchar(255) DEFAULT NULL,
  `takeaway_email` varchar(255) DEFAULT NULL,
  `ready_time` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `shipping` double(10,2) DEFAULT NULL,
  `shipped_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `gst` int(100) NOT NULL DEFAULT 18,
  `sgst` int(100) NOT NULL DEFAULT 9,
  `cgst` int(20) NOT NULL DEFAULT 9,
  `total` double(10,2) DEFAULT NULL,
  `payment` enum('paid','not paid') NOT NULL DEFAULT 'not paid',
  `status` enum('running','pending','shipped','delivered') NOT NULL DEFAULT 'running',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `session_id`, `order_type`, `delivery_name`, `delivery_phone`, `delivery_email`, `takeaway_name`, `takeaway_phone`, `takeaway_email`, `ready_time`, `address`, `notes`, `shipping`, `shipped_date`, `gst`, `sgst`, `cgst`, `total`, `payment`, `status`, `created_at`, `updated_at`) VALUES
(21, '1249643046', 'Dinein', NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, '1', NULL, NULL, 18, 9, 9, NULL, 'not paid', 'running', '2025-02-15 05:43:45', '2025-02-15 05:43:45'),
(22, '9869424665', 'Dinein', NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, '1', NULL, NULL, 18, 9, 9, NULL, 'not paid', 'running', '2025-02-15 05:46:58', '2025-02-15 05:46:58'),
(23, '2035499723', 'Dinein', NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, '1', NULL, NULL, 18, 9, 9, NULL, 'not paid', 'running', '2025-02-15 05:50:46', '2025-02-15 05:50:46'),
(24, '4952001061', 'Dinein', NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, '1', NULL, NULL, 18, 9, 9, NULL, 'not paid', 'running', '2025-02-15 05:51:14', '2025-02-15 05:51:14'),
(25, '9773563925', 'Dinein', NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 'I want spicy biriyani', NULL, '2025-02-15 11:36:29', 18, 9, 9, 723.00, 'not paid', 'delivered', '2025-02-15 06:04:31', '2025-02-15 06:06:29'),
(26, '3610854311', 'Dinein', NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, '1', NULL, NULL, 18, 9, 9, 380.00, 'not paid', 'running', '2025-02-16 06:00:47', '2025-02-16 06:00:47'),
(27, '6501164033', 'Dinein', NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, '1', NULL, NULL, 18, 9, 9, 380.00, 'not paid', 'running', '2025-02-16 06:05:10', '2025-02-16 06:05:10'),
(28, '4990693824', 'Dinein', NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, '1', NULL, NULL, 18, 9, 9, 380.00, 'not paid', 'running', '2025-02-16 06:06:14', '2025-02-16 06:06:14'),
(29, '9159412220', 'Dinein', NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, '1', NULL, NULL, 18, 9, 9, 380.00, 'not paid', 'running', '2025-02-16 06:08:25', '2025-02-16 06:08:25'),
(30, '7332503762', 'Dinein', NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, '1', NULL, NULL, 18, 9, 9, 380.00, 'not paid', 'running', '2025-02-16 06:45:21', '2025-02-16 06:45:21'),
(31, '7208881693', 'Dinein', NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, '1', NULL, NULL, 18, 9, 9, 380.00, 'not paid', 'running', '2025-02-16 06:45:59', '2025-02-16 06:45:59'),
(32, '3541874761', 'Dinein', NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, '1', NULL, NULL, 18, 9, 9, 380.00, 'not paid', 'running', '2025-02-16 06:47:13', '2025-02-16 06:47:13');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `seat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `area_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `price` double NOT NULL,
  `total` double NOT NULL,
  `status` enum('available','running','pending','shipped','delivered') NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `seat_id`, `area_id`, `name`, `image`, `qty`, `price`, `total`, `status`, `created_at`, `updated_at`) VALUES
(12, 22, 52, 18, 'Pulao', 'pulao_1739597979.jpg', 1, 233, 233, 'running', '2025-02-15 05:46:58', '2025-02-15 05:46:58'),
(13, 24, 52, NULL, 'Chicken Biriyani', 'chicken-biriyani_1739538802.jpg', 1, 490, 490, 'available', '2025-02-15 05:51:14', '2025-02-15 05:51:14'),
(14, 25, 52, NULL, 'Pulao', 'pulao_1739597979.jpg', 1, 233, 233, 'available', '2025-02-15 06:04:31', '2025-02-15 06:04:31'),
(15, 25, 52, NULL, 'Chicken Biriyani', 'chicken-biriyani_1739538802.jpg', 1, 490, 490, 'available', '2025-02-15 06:04:31', '2025-02-15 06:04:31'),
(16, 26, 52, NULL, 'Gujarathi Thali', 'gujarathi-thali_1739701744.jpg', 1, 380, 380, 'available', '2025-02-16 06:00:47', '2025-02-16 06:00:47'),
(17, 27, 52, NULL, 'Gujarathi Thali', 'gujarathi-thali_1739701744.jpg', 1, 380, 380, 'available', '2025-02-16 06:05:10', '2025-02-16 06:05:10'),
(18, 28, 50, NULL, 'Gujarathi Thali', 'gujarathi-thali_1739701744.jpg', 1, 380, 380, 'available', '2025-02-16 06:06:14', '2025-02-16 06:06:14'),
(19, 29, 50, NULL, 'Gujarathi Thali', 'gujarathi-thali_1739701744.jpg', 1, 380, 380, 'available', '2025-02-16 06:08:25', '2025-02-16 06:08:25'),
(20, 30, 52, NULL, 'Gujarathi Thali', 'gujarathi-thali_1739701744.jpg', 1, 380, 380, 'available', '2025-02-16 06:45:21', '2025-02-16 06:45:21'),
(21, 31, 52, NULL, 'Gujarathi Thali', 'gujarathi-thali_1739701744.jpg', 1, 380, 380, 'available', '2025-02-16 06:45:59', '2025-02-16 06:45:59'),
(22, 32, 52, NULL, 'Gujarathi Thali', 'gujarathi-thali_1739701744.jpg', 1, 380, 380, 'available', '2025-02-16 06:47:13', '2025-02-16 06:47:13');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `content`, `created_at`, `updated_at`) VALUES
(2, 'About us', 'about-us', '<p><strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p><p><strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"><br></span><br></p>', '2023-12-01 03:33:50', '2023-12-01 03:33:50'),
(3, 'Contact', 'contact-us', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content.</p>\r\n                    <address>\r\n                    Mukesh Bhavsar<br>\r\n                    711-2880 Nulla St.<br>\r\n                    Mankato Mississippi 96522<br>\r\n                    <a href=\"tel:+xxxxxxxx\">(XXX) 555-2368</a><br>\r\n                    <a href=\"mailto:jim@rock.com\">jim@rock.com</a>\r\n                    </address>', '2023-12-01 03:44:47', '2024-11-20 23:54:11'),
(4, 'Terms', 'terms', '<p>terms</p>', '2023-12-27 08:59:35', '2023-12-27 08:59:35');

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
  `your_key_id` varchar(255) DEFAULT NULL,
  `your_key_secret` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `your_key_id`, `your_key_secret`, `created_at`, `updated_at`) VALUES
(2, '123', NULL, '2025-02-14 05:42:56', '2025-02-14 05:42:56');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(6, 'delete articles', 'web', '2025-01-27 04:57:46', '2025-01-27 04:57:46'),
(7, 'create roles', 'web', '2025-01-27 04:57:59', '2025-01-27 04:57:59'),
(8, 'view roles', 'web', '2025-01-27 04:58:06', '2025-01-27 04:58:06'),
(9, 'edit roles', 'web', '2025-01-27 04:58:12', '2025-01-27 04:58:12'),
(10, 'delete roles', 'web', '2025-01-27 04:58:18', '2025-01-27 04:58:18'),
(11, 'view users', 'web', '2025-01-27 04:58:25', '2025-01-27 04:58:25'),
(12, 'edit users', 'web', '2025-01-27 04:58:31', '2025-01-27 04:58:31'),
(13, 'view permissions', 'web', '2025-01-27 04:58:37', '2025-01-27 04:58:37'),
(14, 'create permissions', 'web', '2025-01-27 04:58:42', '2025-01-27 04:59:04'),
(15, 'edit permissions', 'web', '2025-01-27 04:58:51', '2025-01-27 04:58:51'),
(16, 'delete permissions', 'web', '2025-01-27 04:59:12', '2025-01-27 04:59:12'),
(17, 'Can create video', 'web', '2025-01-27 06:05:50', '2025-01-27 06:05:50'),
(18, 'Can edit video', 'web', '2025-01-27 06:06:53', '2025-01-27 06:06:53'),
(19, 'create users', 'web', '2025-02-02 03:33:01', '2025-02-02 03:33:48'),
(20, 'create post', 'web', '2025-02-03 06:21:35', '2025-02-03 06:21:35'),
(21, 'edit post', 'web', '2025-02-03 06:21:47', '2025-02-03 06:21:47'),
(22, 'delete post', 'web', '2025-02-03 06:21:58', '2025-02-03 06:21:58'),
(23, 'create news', 'web', '2025-02-03 06:31:38', '2025-02-03 06:31:38'),
(27, 'create category', 'web', '2025-02-14 06:31:59', '2025-02-14 06:31:59');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` double(10,2) NOT NULL,
  `compare_price` double(10,2) DEFAULT NULL,
  `veg_nonveg` enum('Veg','Non-veg','Egg') NOT NULL DEFAULT 'Veg',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `seat_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `image`, `category_id`, `menu_id`, `description`, `price`, `compare_price`, `veg_nonveg`, `status`, `created_at`, `updated_at`, `seat_id`) VALUES
(22, 'Gujarathi Thali', 'gujarathi-thali', 'gujarathi-thali_1739701744.jpg', 202, 94, NULL, 380.00, 370.00, 'Veg', 1, '2025-02-16 04:59:04', '2025-02-16 04:59:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(3, 'Admin', 'web', '2025-01-27 04:24:06', '2025-01-27 04:24:06'),
(6, 'Super Admin', 'web', '2025-02-02 02:38:00', '2025-02-02 02:38:00'),
(8, 'Manager', 'web', '2025-02-05 05:30:51', '2025-02-05 05:30:51'),
(9, 'Editor', 'web', '2025-02-13 02:07:34', '2025-02-13 02:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(6, 3),
(7, 3),
(7, 8),
(8, 3),
(8, 8),
(9, 3),
(9, 8),
(10, 3),
(11, 3),
(12, 3),
(12, 8),
(13, 3),
(13, 8),
(14, 3),
(15, 3),
(16, 3),
(17, 8),
(17, 9),
(18, 8),
(18, 9),
(19, 3),
(19, 8),
(20, 8),
(21, 8),
(27, 8);

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `table_name` varchar(255) DEFAULT NULL,
  `table_slug` varchar(100) DEFAULT NULL,
  `area_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `seating_capacity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id`, `table_name`, `table_slug`, `area_id`, `status`, `seating_capacity`, `created_at`, `updated_at`) VALUES
(1, 'Table 1', 'table_1', 1, 'available', 2, '2025-02-06 07:16:14', '2025-02-06 07:16:14'),
(49, 'Table 2', 'table-2', 1, 'available', 2, '2025-02-06 02:01:44', '2025-02-06 02:01:44'),
(50, 'Table 1', 'table-1', NULL, 'available', 4, '2025-02-06 02:03:07', '2025-02-06 02:03:07'),
(51, 'Table 2', 'table-2', NULL, 'available', 2, '2025-02-06 02:03:41', '2025-02-06 02:03:41'),
(52, 'Table 3', 'table-3', NULL, 'running', 6, '2025-02-13 01:32:47', '2025-02-13 01:32:47'),
(54, 'Table 1', 'table-1', 18, 'available', 2, '2025-02-14 06:21:42', '2025-02-14 06:21:42'),
(55, 'Table 2', 'table-2', 18, 'available', 6, '2025-02-14 06:24:28', '2025-02-14 06:24:28');

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
('ESI9aSZc0NNv8j2Tq87hbdIW1qJ3X3EyqKb54Zl1', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiS1UxOTFzV0JEajkyNXFIYnVBVFcwb25neHprc2duSVZJVjM3NHRueiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NDoiY2FydCI7YToxOntpOjIyO2E6NDp7czo0OiJuYW1lIjtzOjE1OiJHdWphcmF0aGkgVGhhbGkiO3M6ODoicXVhbnRpdHkiO2k6MTtzOjU6InByaWNlIjtkOjM4MDtzOjU6ImltYWdlIjtzOjMwOiJndWphcmF0aGktdGhhbGlfMTczOTcwMTc0NC5qcGciO319fQ==', 1739970983);

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `primary_color` varchar(255) NOT NULL DEFAULT '#007bff',
  `secondary_color` varchar(255) NOT NULL DEFAULT '#6c757d',
  `sidebar_color` varchar(255) NOT NULL DEFAULT '#999999',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Priyanka Bhavsar', 'p.bhavsar2610@gmail.com', NULL, '$2y$12$5AeijLSFTncgwDG83ZC7auuYdKaAjwhXVDX/2q2cYqZnOYsnt5yG6', NULL, '2025-01-27 05:00:57', '2025-01-27 05:00:57'),
(3, 'Dhruv Bhavsar', 'dhruvbhavsar210@gmail.com', NULL, '$2y$12$OwfIY3oOU2ptWnqWQwlMc.p3iDkMVEd7fQbQYpe.wz6hnVLt9KMG2', NULL, '2025-01-27 06:04:37', '2025-01-27 06:04:37'),
(4, 'SuperAdmin', 'superadmin@gmail.com', NULL, '$2y$12$MaiiJOFFex7YJZPQFGBOueaDrabJW.Vip8SvJe2NW7paQkZ.0tQLW', NULL, '2025-02-02 02:52:17', '2025-02-02 02:52:17'),
(6, 'Sona Bhavsar', 'sona@gmail.com', NULL, '$2y$12$l2lCyofG2OPfxnrUOEDzau4/H5vR72urVDW4bW5ycGERBq2t61/1W', NULL, '2025-02-03 06:24:10', '2025-02-03 06:24:10');

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `view` enum('Grid','Table') NOT NULL DEFAULT 'Table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`id`, `view`, `created_at`, `updated_at`) VALUES
(1, 'Grid', '2025-02-10 10:49:16', '2025-02-10 10:49:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configurations`
--
ALTER TABLE `configurations`
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
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menus_category_id_foreign` (`category_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_seat_id_foreign` (`seat_id`),
  ADD KEY `order_items_area_id_foreign` (`area_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
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
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tables_area_id_foreign` (`area_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `configurations`
--
ALTER TABLE `configurations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

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
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_seat_id_foreign` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `tables_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
