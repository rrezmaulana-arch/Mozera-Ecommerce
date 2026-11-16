-- ==========================================================
-- MOZÉRA (ITSFRIDAY) E-Commerce & WMS Database Dump
-- Compatible with MySQL 5.7 / 8.0+ and phpMyAdmin
-- Generated: 2026-11-17 04:36:44
-- ==========================================================

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";

-- --------------------------------------------------------
-- Table structure for table `users`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ulid` varchar(255) NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'store_admin',
  `phone` varchar(255) NULL DEFAULT NULL,
  `is_active` bigint(20) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `users`
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `ulid`, `role`, `phone`, `is_active`) VALUES
(1, 'Miftah Afreza Maulana', 'miftah@itsfriday.id', NULL, '$2y$12$Qg6iWLEYKW8BxWY/zSNjt.AeGKX7QkhcypV2cCjr/zCmgYp8jg486', NULL, '2026-11-17 00:32:34', '2026-11-17 00:32:34', '01M7JPNWFNQTQPFRMZB42GNZ5B', 'owner', '081234567890', 1),
(2, 'Sarah Store Admin', 'toko@itsfriday.id', NULL, '$2y$12$gZxpc9V0wu2t7Ub2AzuAleFk9ENmDapKarn3eYFbee.zvi2YOH.WO', NULL, '2026-11-17 00:32:34', '2026-11-17 00:32:34', '01M7JPNWZ7X9A20KSWSZ7XJ2EZ', 'store_admin', '081234567891', 1),
(3, 'Budi Staf Gudang', 'gudang@itsfriday.id', NULL, '$2y$12$aQmBBODPPiHbjE/hFbLPouLsuE9cmMAuvKn9jC4qT0fiKpm6dP7lu', NULL, '2026-11-17 00:32:35', '2026-11-17 00:32:35', '01M7JPNXEA2YP25VV83RFKAQ60', 'warehouse_staff', '081234567892', 1),
(4, 'Dinda CRM & Marketing', 'crm@itsfriday.id', NULL, '$2y$12$XdQ63qJokHSt/RXRn0Wt/ehUwYkqXHL8rEPz8S5ZXvC.V9I4QfV1O', NULL, '2026-11-17 00:32:35', '2026-11-17 00:32:35', '01M7JPNXX7MVW097GESSYE06ME', 'crm_marketer', '081234567893', 1);

-- --------------------------------------------------------
-- Table structure for table `password_reset_tokens`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `sessions`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NULL DEFAULT NULL,
  `ip_address` varchar(255) NULL DEFAULT NULL,
  `user_agent` text NULL DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `sessions`
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('cvshYSAmXNtF6decMSJGl2FOVkII4CE2LM2swgMG', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMzZUQnJPb2ZpSlBhVnhnS3dSRmJKY1hXNTFFYTRnN1BjWHJaRUtFMiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo5OiJzaG9wLmhvbWUiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjY0OiI2ZjJkMmI2MmY5Y2ViYzI0M2ZiNzc5ZGQwZWM5YWIxYjZlNWZlMGE3OWNkMGM3MmZkM2Y4N2JmMDM3NjQ5NjllIjt9', 1794862402);

-- --------------------------------------------------------
-- Table structure for table `cache`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `cache`
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('mozera-cache-5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1794852023;', 1794852023),
('mozera-cache-5c785c036466adea360111aa28563bfd556b5fba', 'i:1;', 1794852023);

-- --------------------------------------------------------
-- Table structure for table `cache_locks`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `jobs`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` text NOT NULL,
  `attempts` bigint(20) NOT NULL,
  `reserved_at` bigint(20) NULL DEFAULT NULL,
  `available_at` bigint(20) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `job_batches`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `total_jobs` bigint(20) NOT NULL,
  `pending_jobs` bigint(20) NOT NULL,
  `failed_jobs` bigint(20) NOT NULL,
  `failed_job_ids` text NOT NULL,
  `options` text NULL DEFAULT NULL,
  `cancelled_at` bigint(20) NULL DEFAULT NULL,
  `created_at` bigint(20) NOT NULL,
  `finished_at` bigint(20) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `failed_jobs`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` text NOT NULL,
  `exception` text NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `channels`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `channels`;
CREATE TABLE `channels` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NULL DEFAULT NULL,
  `is_active` bigint(20) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `channels`
INSERT INTO `channels` (`id`, `code`, `name`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'web', 'ITSFRIDAY Official Store (Web)', 'Toko online direct-to-consumer', 1, '2026-11-17 00:32:35', '2026-11-17 00:32:35'),
(2, 'shopee', 'Shopee Official Store', 'Marketplace Shopee', 1, '2026-11-17 00:32:35', '2026-11-17 00:32:35'),
(3, 'tiktok', 'TikTok Shop', 'Marketplace TikTok Shop', 1, '2026-11-17 00:32:35', '2026-11-17 00:32:35'),
(4, 'bazar', 'Pop-up Bazar (SBY, Solo, MLG)', 'Penjualan event offline', 1, '2026-11-17 00:32:35', '2026-11-17 00:32:35'),
(5, 'reseller', 'Mitra Reseller', 'Penjualan grosir reseller', 1, '2026-11-17 00:32:35', '2026-11-17 00:32:35');

-- --------------------------------------------------------
-- Table structure for table `customers`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ulid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NULL DEFAULT NULL,
  `tags` text NULL DEFAULT NULL,
  `is_active` bigint(20) NOT NULL DEFAULT '1',
  `notes` text NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `customers`
INSERT INTO `customers` (`id`, `ulid`, `name`, `email`, `phone`, `tags`, `is_active`, `notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '01M7JPNZT0WS38NJN18YR9H9TF', 'Aulia Rahmawati', 'aulia.rahma@gmail.com', '081122334455', '[\"VIP\",\"Scarf Lover\",\"Surabaya\"]', 1, 'Pelanggan setia sejak 2021, suka warna pastel.', '2026-11-17 00:32:37', '2026-11-17 00:32:37', NULL),
(2, '01M7JPNZXZYVXMB61NBB678RXA', 'Citra Kirana Lestari', 'citra.kirana@yahoo.com', '085711223344', '[\"Outerwear Fan\",\"Solo\"]', 1, 'Beli saat pop-up bazar di Solo.', '2026-11-17 00:32:37', '2026-11-17 00:32:37', NULL),
(3, '01M7JPP00JNTEGKK90Q40CDXKZ', 'Nadia Amanda Putri', 'nadia.putri@outlook.com', '082199887766', '[\"At Risk\",\"High Spender\"]', 1, 'Pernah belanja Rp 1.5jt tahun lalu, sudah 120 hari belum order kembali.', '2026-11-17 00:32:37', '2026-11-17 00:32:37', NULL);

-- --------------------------------------------------------
-- Table structure for table `series`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `series`;
CREATE TABLE `series` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ulid` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NULL DEFAULT NULL,
  `banner_image` varchar(255) NULL DEFAULT NULL,
  `is_active` bigint(20) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `series`
INSERT INTO `series` (`id`, `ulid`, `code`, `name`, `description`, `banner_image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '01M7JPNYNGPWSV3QBVXAVCFKRJ', 'PUSPA', 'PUSPA Series', 'Koleksi elegan terinspirasi motif flora Nusantara dengan material premium yang sejuk dan jatuh anggun.', '/images/models/look-1-terracotta.png', 1, '2026-11-17 00:32:35', '2026-11-17 00:32:35'),
(2, '01M7JPNYPJXNHKN07XKMVS7GE0', 'ISLA', 'ISLA Collection', 'Siluet santai dan minimalis untuk tampilan effortless chic sehari-hari (#everydayitsfriday).', '/images/models/look-2-sage.png', 1, '2026-11-17 00:32:35', '2026-11-17 00:32:35'),
(3, '01M7JPNYQK58HNZJXZWEZD42ZE', 'SEPT_DROPS', 'Sept Drops', 'Koleksi edisi terbatas rilisan September dengan kuota eksklusif dan material linen pilihan.', '/images/models/look-4-parang.png', 1, '2026-11-17 00:32:35', '2026-11-17 00:32:35');

-- --------------------------------------------------------
-- Table structure for table `products`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ulid` varchar(255) NOT NULL,
  `series_id` bigint(20) NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'outerwear',
  `description` text NULL DEFAULT NULL,
  `material` varchar(255) NULL DEFAULT NULL,
  `care_instructions` text NULL DEFAULT NULL,
  `length_cm` bigint(20) NULL DEFAULT NULL,
  `is_preorder` bigint(20) NOT NULL DEFAULT '0',
  `preorder_lead_days` bigint(20) NOT NULL DEFAULT '0',
  `primary_image` varchar(255) NULL DEFAULT NULL,
  `gallery_images` text NULL DEFAULT NULL,
  `is_active` bigint(20) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `products`
INSERT INTO `products` (`id`, `ulid`, `series_id`, `name`, `slug`, `category`, `description`, `material`, `care_instructions`, `length_cm`, `is_preorder`, `preorder_lead_days`, `primary_image`, `gallery_images`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '01M7JPNYRTDASPMKSCVS9H5DST', 1, 'PUSPA Floral Outer Kimono', 'puspa-floral-outer-kimono', 'outerwear', 'Outer berpotongan kimono dengan detail print eksklusif flora terakota hangat. Siluet longgar santun yang cocok dipadukan dengan inner atau celana kulot untuk beragam acara.', 'Premium Rayon Twill (Lembut, dingin, tidak menerawang)', 'Cuci tangan dengan air dingin, jemur di tempat teduh, setrika suhu sedang.', 110, 0, 0, '/images/models/look-1-terracotta.png', '[\"\\/images\\/models\\/look-1-terracotta.png\",\"\\/images\\/models\\/look-2-sage.png\",\"\\/images\\/models\\/look-3-navy.png\"]', 1, '2026-11-17 00:32:35', '2026-11-17 00:32:35'),
(2, '01M7JPNYXS3XPMJFKZ4TXHC06X', 1, 'PUSPA Voal Printed Scarf 120x120', 'puspa-voal-printed-scarf', 'scarf', 'Scarf hijab segiempat bermotif anggun flora Nusantara dengan finishing lasercut rapi. Mudah dibentuk, tegak di dahi dan tidak kedap suara.', 'Voal Ultrafine Glow Premium', 'Cuci dengan sampo lembut, hindari memeras terlalu kencang.', 120, 0, 0, '/images/models/puspa-scarf-voal.png', '[\"\\/images\\/models\\/puspa-scarf-voal.png\",\"\\/images\\/models\\/look-1-terracotta.png\"]', 1, '2026-11-17 00:32:36', '2026-11-17 00:32:36'),
(3, '01M7JPNZ1352RVVY1TZDMJRXQB', 2, 'ISLA Geometrik Kimono Outer', 'isla-geometrik-kimono-outer', 'outerwear', 'Atasan kimono bermotif geometrik modern bernuansa sage green sejuk. Siluet santai wudhu-friendly untuk tampilan effortless chic sehari-hari (#everydaymozera).', 'Pure Crinkle Airflow & Rayon Twill (Tanpa perlu disetrika)', 'Cuci mesin putaran lembut.', 105, 1, 10, '/images/models/look-2-sage.png', '[\"\\/images\\/models\\/look-2-sage.png\"]', 1, '2026-11-17 00:32:36', '2026-11-17 00:32:36'),
(4, '01M7JPNZ42K1CH6J59QG14H9PJ', 3, 'Sept Drops Heritage Parang Trench Outer', 'sept-drops-heritage-linen-trench', 'outerwear', 'Trench outer berstruktur kokoh dengan motif parang heritage modern. Dilengkapi sabuk serut untuk siluet ramping dan santun.', '100% Belgian Washed Linen & Heritage Batik Print', 'Dry clean direkomendasikan.', 115, 0, 0, '/images/models/look-4-parang.png', '[\"\\/images\\/models\\/look-4-parang.png\"]', 1, '2026-11-17 00:32:36', '2026-11-17 00:32:36');

-- --------------------------------------------------------
-- Table structure for table `skus`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `skus`;
CREATE TABLE `skus` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ulid` varchar(255) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `sku_code` varchar(255) NOT NULL,
  `barcode` varchar(255) NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `color` varchar(255) NULL DEFAULT NULL,
  `size` varchar(255) NULL DEFAULT NULL,
  `price_idr` bigint(20) NOT NULL,
  `cost_idr` bigint(20) NOT NULL DEFAULT '0',
  `weight_grams` bigint(20) NOT NULL DEFAULT '300',
  `image_url` varchar(255) NULL DEFAULT NULL,
  `is_active` bigint(20) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `skus`
INSERT INTO `skus` (`id`, `ulid`, `product_id`, `sku_code`, `barcode`, `name`, `color`, `size`, `price_idr`, `cost_idr`, `weight_grams`, `image_url`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '01M7JPNYSQ7392C7ZFVN4B49XD', 1, 'PUSPA-OUT-SGE-ALL', '8991001001', 'PUSPA Floral Outer - Sage Green (All Size)', 'Sage Green', 'All Size', 389000, 175000, 350, '/images/models/look-2-sage.png', 1, '2026-11-17 00:32:36', '2026-11-17 00:32:36'),
(2, '01M7JPNYV6JTJZAVZSB50MWTZQ', 1, 'PUSPA-OUT-TRC-ALL', '8991001002', 'PUSPA Floral Outer - Terracotta (All Size)', 'Terracotta', 'All Size', 389000, 175000, 350, '/images/models/look-1-terracotta.png', 1, '2026-11-17 00:32:36', '2026-11-17 00:32:36'),
(3, '01M7JPNYWND7CNWJVW14SC3W06', 1, 'PUSPA-OUT-NVY-ALL', '8991001003', 'PUSPA Floral Outer - Indigo Navy (All Size)', 'Indigo Navy', 'All Size', 389000, 175000, 350, '/images/models/look-3-navy.png', 1, '2026-11-17 00:32:36', '2026-11-17 00:32:36'),
(4, '01M7JPNYYTAK7YDWFCQPEZCF55', 2, 'PUSPA-SCF-DPK-120', '8991002001', 'PUSPA Scarf - Dusty Pink (120x120)', 'Dusty Pink', '120x120', 149000, 60000, 120, '/images/models/puspa-scarf-voal.png', 1, '2026-11-17 00:32:36', '2026-11-17 00:32:36'),
(5, '01M7JPNYZXCK7V9MA27YWX1ZAF', 2, 'PUSPA-SCF-OLV-120', '8991002002', 'PUSPA Scarf - Olive Ash (120x120)', 'Olive Ash', '120x120', 149000, 60000, 120, '/images/models/puspa-scarf-voal.png', 1, '2026-11-17 00:32:36', '2026-11-17 00:32:36'),
(6, '01M7JPNZ24T03TJ2CKQTA3B7ST', 3, 'ISLA-DRS-OAT-SM', '8991003001', 'ISLA Geometrik Outer - Sage Green (S/M)', 'Sage Green', 'S/M', 429000, 195000, 450, '/images/models/look-2-sage.png', 1, '2026-11-17 00:32:36', '2026-11-17 00:32:36'),
(7, '01M7JPNZ31Y0NQZMYEC3ZQ276F', 3, 'ISLA-DRS-OAT-LXL', '8991003002', 'ISLA Geometrik Outer - Sage Green (L/XL)', 'Sage Green', 'L/XL', 429000, 195000, 480, '/images/models/look-2-sage.png', 1, '2026-11-17 00:32:36', '2026-11-17 00:32:36'),
(8, '01M7JPNZ592FARB6SJMB8TFRFJ', 4, 'SEPT-TRN-SND-ALL', '8991004001', 'Sept Drops Trench - Heritage Parang (All Size)', 'Heritage Parang', 'All Size', 549000, 240000, 550, '/images/models/look-4-parang.png', 1, '2026-11-17 00:32:36', '2026-11-17 00:32:36');

-- --------------------------------------------------------
-- Table structure for table `locations`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `locations`;
CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'warehouse',
  `address` text NULL DEFAULT NULL,
  `is_active` bigint(20) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `locations`
INSERT INTO `locations` (`id`, `code`, `name`, `type`, `address`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'PUSAT', 'Gudang Pusat Surabaya', 'warehouse', 'Jl. Rungkut Industri Raya No. 45, Surabaya', 1, '2026-11-17 00:32:35', '2026-11-17 00:32:35'),
(2, 'BAZAR_SBY', 'Titik Bazar Surabaya', 'popup_store', 'Tunjungan Plaza, Surabaya', 1, '2026-11-17 00:32:35', '2026-11-17 00:32:35'),
(3, 'BAZAR_SOLO', 'Titik Bazar Solo', 'popup_store', 'The Park Mall Solo Baru', 1, '2026-11-17 00:32:35', '2026-11-17 00:32:35'),
(4, 'BAZAR_MLG', 'Titik Bazar Malang', 'popup_store', 'Mall Olympic Garden, Malang', 1, '2026-11-17 00:32:35', '2026-11-17 00:32:35');

-- --------------------------------------------------------
-- Table structure for table `orders`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ulid` varchar(255) NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `channel_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NULL DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NULL DEFAULT NULL,
  `shipping_address` text NULL DEFAULT NULL,
  `shipping_city` varchar(255) NULL DEFAULT NULL,
  `shipping_province` varchar(255) NULL DEFAULT NULL,
  `shipping_courier` varchar(255) NULL DEFAULT NULL,
  `shipping_service` varchar(255) NULL DEFAULT NULL,
  `subtotal_idr` bigint(20) NOT NULL DEFAULT '0',
  `discount_idr` bigint(20) NOT NULL DEFAULT '0',
  `shipping_cost_idr` bigint(20) NOT NULL DEFAULT '0',
  `grand_total_idr` bigint(20) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT 'pending_payment',
  `notes` text NULL DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `orders`
INSERT INTO `orders` (`id`, `ulid`, `order_number`, `channel_id`, `customer_id`, `customer_name`, `customer_email`, `customer_phone`, `shipping_address`, `shipping_city`, `shipping_province`, `shipping_courier`, `shipping_service`, `subtotal_idr`, `discount_idr`, `shipping_cost_idr`, `grand_total_idr`, `status`, `notes`, `paid_at`, `cancelled_at`, `created_at`, `updated_at`) VALUES
(1, '01M7JPP07YMYNQ4RKWEX5BQA25', 'ORD-20261110-001', 1, 1, 'Aulia Rahmawati', 'aulia.rahma@gmail.com', '081122334455', 'Jl. Dharmahusada Indah Barat II No. 12, Gubeng, Surabaya', 'Surabaya', 'Jawa Timur', 'JNE', 'REG', 538000, 0, 15000, 553000, 'delivered', NULL, '2026-11-13 00:32:37', NULL, '2026-11-12 00:32:37', '2026-11-17 00:32:37'),
(2, '01M7JPP0DJEYCRF3P49RB1M7QE', 'ORD-20261115-002', 1, 2, 'Citra Kirana Lestari', 'citra.kirana@yahoo.com', '085711223344', 'Jl. Slamet Riyadi No. 88, Solo', 'Surakarta', 'Jawa Tengah', 'SiCepat', 'BEST', 389000, 0, 18000, 407000, 'picking', NULL, '2026-11-16 22:32:37', NULL, '2026-11-16 21:32:37', '2026-11-17 00:32:37'),
(3, '01M7JPP0J5VKPX2JWC4MXF08W4', 'ORD-20260715-099', 1, 3, 'Nadia Amanda Putri', 'nadia.putri@outlook.com', '082199887766', 'Jl. Ijen No. 14, Malang', 'Malang', 'Jawa Timur', 'JNE', 'REG', 1367000, 0, 15000, 1382000, 'completed', NULL, '2026-07-20 00:32:37', NULL, '2026-07-20 00:32:37', '2026-11-17 00:32:37');

-- --------------------------------------------------------
-- Table structure for table `order_items`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `sku_id` bigint(20) NULL DEFAULT NULL,
  `sku_code` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `variant_name` varchar(255) NULL DEFAULT NULL,
  `unit_price_idr` bigint(20) NOT NULL,
  `cost_idr` bigint(20) NOT NULL DEFAULT '0',
  `quantity` bigint(20) NOT NULL,
  `subtotal_idr` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `order_items`
INSERT INTO `order_items` (`id`, `order_id`, `sku_id`, `sku_code`, `product_name`, `variant_name`, `unit_price_idr`, `cost_idr`, `quantity`, `subtotal_idr`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'PUSPA-OUT-SGE-ALL', 'PUSPA Floral Outer Kimono', 'Sage Green (All Size)', 389000, 175000, 1, 389000, '2026-11-17 00:32:37', '2026-11-17 00:32:37'),
(2, 1, 4, 'PUSPA-SCF-DPK-120', 'PUSPA Voal Printed Scarf 120x120', 'Dusty Pink', 149000, 60000, 1, 149000, '2026-11-17 00:32:37', '2026-11-17 00:32:37'),
(3, 2, 2, 'PUSPA-OUT-TRC-ALL', 'PUSPA Floral Outer Kimono', 'Terracotta (All Size)', 389000, 175000, 1, 389000, '2026-11-17 00:32:37', '2026-11-17 00:32:37'),
(4, 3, 8, 'SEPT-TRN-SND-ALL', 'Sept Drops Heritage Parang Trench Outer', 'Sand Beige', 549000, 240000, 2, 1098000, '2026-11-17 00:32:37', '2026-11-17 00:32:37');

-- --------------------------------------------------------
-- Table structure for table `payments`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ulid` varchar(255) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `gateway` varchar(255) NOT NULL DEFAULT 'midtrans',
  `transaction_id` varchar(255) NULL DEFAULT NULL,
  `payment_method` varchar(255) NULL DEFAULT NULL,
  `amount_idr` bigint(20) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `idempotency_key` varchar(255) NULL DEFAULT NULL,
  `payload` text NULL DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `payments`
INSERT INTO `payments` (`id`, `ulid`, `order_id`, `gateway`, `transaction_id`, `payment_method`, `amount_idr`, `status`, `idempotency_key`, `payload`, `paid_at`, `created_at`, `updated_at`) VALUES
(1, '01M7JPP0BFNAEJ512GGN66VA0R', 1, 'midtrans', 'MID-TRANS-20261110-001', 'qris', 553000, 'paid', NULL, NULL, '2026-11-13 00:32:37', '2026-11-17 00:32:37', '2026-11-17 00:32:37'),
(2, '01M7JPP0FTV0W35N6QDQFDV5SB', 2, 'midtrans', 'MID-TRANS-20261115-002', 'bca_va', 407000, 'paid', NULL, NULL, '2026-11-16 22:32:37', '2026-11-17 00:32:37', '2026-11-17 00:32:37');

-- --------------------------------------------------------
-- Table structure for table `carts`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) NOT NULL,
  `customer_id` bigint(20) NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `carts`
INSERT INTO `carts` (`id`, `session_id`, `customer_id`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'cvshYSAmXNtF6decMSJGl2FOVkII4CE2LM2swgMG', NULL, '2026-11-24 01:00:32', '2026-11-17 01:00:32', '2026-11-17 01:00:32');

-- --------------------------------------------------------
-- Table structure for table `cart_items`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cart_items`;
CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cart_id` bigint(20) NOT NULL,
  `sku_id` bigint(20) NOT NULL,
  `quantity` bigint(20) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `vouchers`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `vouchers`;
CREATE TABLE `vouchers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `discount_type` varchar(255) NOT NULL DEFAULT 'fixed',
  `discount_amount` bigint(20) NOT NULL,
  `min_purchase_idr` bigint(20) NOT NULL DEFAULT '0',
  `max_discount_idr` bigint(20) NULL DEFAULT NULL,
  `quota` bigint(20) NULL DEFAULT NULL,
  `used_count` bigint(20) NOT NULL DEFAULT '0',
  `starts_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `is_active` bigint(20) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `vouchers`
INSERT INTO `vouchers` (`id`, `code`, `name`, `discount_type`, `discount_amount`, `min_purchase_idr`, `max_discount_idr`, `quota`, `used_count`, `starts_at`, `expires_at`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'EVERYDAYFRIDAY', 'Diskon Sambutan Komunitas #everydayitsfriday', 'percentage', 10, 300000, 50000, 200, 14, NULL, NULL, 1, '2026-11-17 00:32:37', '2026-11-17 00:32:37'),
(2, 'PUSPA50K', 'Voucher Eksklusif Seri PUSPA', 'fixed', 50000, 350000, NULL, 100, 8, NULL, NULL, 1, '2026-11-17 00:32:37', '2026-11-17 00:32:37');

-- --------------------------------------------------------
-- Table structure for table `voucher_redemptions`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `voucher_redemptions`;
CREATE TABLE `voucher_redemptions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `voucher_id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NULL DEFAULT NULL,
  `discount_idr` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `drops`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `drops`;
CREATE TABLE `drops` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ulid` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NULL DEFAULT NULL,
  `banner_url` varchar(255) NULL DEFAULT NULL,
  `drop_time` timestamp NOT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `is_active` bigint(20) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `drops`
INSERT INTO `drops` (`id`, `ulid`, `code`, `title`, `description`, `banner_url`, `drop_time`, `end_time`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '01M7JPP0PJ6TYQ6H5K2JKW99NY', 'SEPT-DROP-EXCLUSIVE', 'Sept Drops: Limited Outerwear Release', 'Rilisan terbatas mantel linen premium edisi September. Tersedia hanya 20 pcs nasional.', '/images/models/look-4-parang.png', '2026-11-15 00:32:37', '2026-11-22 00:32:37', 1, '2026-11-17 00:32:37', '2026-11-17 00:32:37');

-- --------------------------------------------------------
-- Table structure for table `stock_balances`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `stock_balances`;
CREATE TABLE `stock_balances` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `location_id` bigint(20) NOT NULL,
  `sku_id` bigint(20) NOT NULL,
  `physical_qty` bigint(20) NOT NULL DEFAULT '0',
  `reserved_qty` bigint(20) NOT NULL DEFAULT '0',
  `available_qty` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `stock_balances`
INSERT INTO `stock_balances` (`id`, `location_id`, `sku_id`, `physical_qty`, `reserved_qty`, `available_qty`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 45, 0, 45, '2026-11-17 00:32:36', '2026-11-17 00:32:36'),
(2, 1, 2, 38, 0, 38, '2026-11-17 00:32:36', '2026-11-17 00:32:36'),
(3, 1, 3, 30, 0, 30, '2026-11-17 00:32:36', '2026-11-17 00:32:36'),
(4, 1, 4, 80, 0, 80, '2026-11-17 00:32:36', '2026-11-17 00:32:36'),
(5, 1, 5, 65, 0, 65, '2026-11-17 00:32:36', '2026-11-17 00:32:36'),
(6, 1, 6, 25, 0, 25, '2026-11-17 00:32:36', '2026-11-17 00:32:36'),
(7, 1, 7, 4, 0, 4, '2026-11-17 00:32:36', '2026-11-17 00:32:36'),
(8, 1, 8, 20, 0, 20, '2026-11-17 00:32:37', '2026-11-17 00:32:37');

-- --------------------------------------------------------
-- Table structure for table `stock_movements`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `stock_movements`;
CREATE TABLE `stock_movements` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ulid` varchar(255) NOT NULL,
  `location_id` bigint(20) NOT NULL,
  `sku_id` bigint(20) NOT NULL,
  `movement_type` varchar(255) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `reference_type` varchar(255) NULL DEFAULT NULL,
  `reference_id` varchar(255) NULL DEFAULT NULL,
  `notes` text NULL DEFAULT NULL,
  `created_by` bigint(20) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `stock_movements`
INSERT INTO `stock_movements` (`id`, `ulid`, `location_id`, `sku_id`, `movement_type`, `quantity`, `reference_type`, `reference_id`, `notes`, `created_by`, `created_at`) VALUES
(1, '01M7JPNZA11T5G9J1CG00JHNHZ', 1, 1, 'INBOUND', 45, 'Inbound', 'INB-202611-001', 'Barang masuk batch BATCH-202611-01', 3, '2026-11-17 00:32:36'),
(2, '01M7JPNZCBGT27W8DX9A3PSGNS', 1, 2, 'INBOUND', 38, 'Inbound', 'INB-202611-001', 'Barang masuk batch BATCH-202611-01', 3, '2026-11-17 00:32:36'),
(3, '01M7JPNZE5Y7HE6KCDR2JH5R96', 1, 3, 'INBOUND', 30, 'Inbound', 'INB-202611-001', 'Barang masuk batch BATCH-202611-01', 3, '2026-11-17 00:32:36'),
(4, '01M7JPNZGEM6SJ1SHVDKA00K42', 1, 4, 'INBOUND', 80, 'Inbound', 'INB-202611-001', 'Barang masuk batch BATCH-202611-01', 3, '2026-11-17 00:32:36'),
(5, '01M7JPNZJRR0V4Z610CJC3Q0PJ', 1, 5, 'INBOUND', 65, 'Inbound', 'INB-202611-001', 'Barang masuk batch BATCH-202611-01', 3, '2026-11-17 00:32:36'),
(6, '01M7JPNZMW0GF667ZG1MZXG16V', 1, 6, 'INBOUND', 25, 'Inbound', 'INB-202611-001', 'Barang masuk batch BATCH-202611-01', 3, '2026-11-17 00:32:36'),
(7, '01M7JPNZPP2JNFJAD8EM8A261F', 1, 7, 'INBOUND', 4, 'Inbound', 'INB-202611-001', 'Barang masuk batch BATCH-202611-01', 3, '2026-11-17 00:32:36'),
(8, '01M7JPNZRZH6FT24P4SSBCHX9M', 1, 8, 'INBOUND', 20, 'Inbound', 'INB-202611-001', 'Barang masuk batch BATCH-202611-01', 3, '2026-11-17 00:32:37');

-- --------------------------------------------------------
-- Table structure for table `consents`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `consents`;
CREATE TABLE `consents` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) NOT NULL,
  `consent_type` varchar(255) NOT NULL,
  `is_granted` bigint(20) NOT NULL DEFAULT '0',
  `version` varchar(255) NOT NULL DEFAULT 'v1.0',
  `ip_address` varchar(255) NULL DEFAULT NULL,
  `user_agent` text NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `consents`
INSERT INTO `consents` (`id`, `customer_id`, `consent_type`, `is_granted`, `version`, `ip_address`, `user_agent`, `updated_at`) VALUES
(1, 1, 'transactional_email', 1, 'v1.0', NULL, NULL, '2026-11-16 17:32:37'),
(2, 1, 'marketing_email', 1, 'v1.0', NULL, NULL, '2026-11-16 17:32:37'),
(3, 2, 'transactional_email', 1, 'v1.0', NULL, NULL, '2026-11-16 17:32:37'),
(4, 2, 'marketing_email', 1, 'v1.0', NULL, NULL, '2026-11-16 17:32:37'),
(5, 3, 'transactional_email', 1, 'v1.0', NULL, NULL, '2026-11-16 17:32:37'),
(6, 3, 'marketing_email', 1, 'v1.0', NULL, NULL, '2026-11-16 17:32:37');

-- --------------------------------------------------------
-- Table structure for table `domain_events`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `domain_events`;
CREATE TABLE `domain_events` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ulid` varchar(255) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `payload` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `attempts` bigint(20) NOT NULL DEFAULT '0',
  `error_message` text NULL DEFAULT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `migrations`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `migrations`
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_11_15_000001_create_core_tables', 1),
(5, '2026_11_15_000002_create_store_tables', 1),
(6, '2026_11_15_000003_create_wms_tables', 1),
(7, '2026_11_15_000004_create_crm_tables', 1),
(8, '2026_11_15_000005_create_ledger_immutability_triggers', 1);

-- --------------------------------------------------------
-- Table structure for table `customer_identities`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `customer_identities`;
CREATE TABLE `customer_identities` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) NOT NULL,
  `channel_code` varchar(255) NOT NULL,
  `external_id` varchar(255) NOT NULL,
  `identifier_value` varchar(255) NULL DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `addresses`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) NOT NULL,
  `label` varchar(255) NOT NULL DEFAULT 'Rumah',
  `receiver_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `street_address` text NOT NULL,
  `subdistrict` varchar(255) NULL DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `is_default` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `addresses`
INSERT INTO `addresses` (`id`, `customer_id`, `label`, `receiver_name`, `phone`, `street_address`, `subdistrict`, `city`, `province`, `postal_code`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 1, 'Rumah Utama', 'Aulia Rahmawati', '081122334455', 'Jl. Dharmahusada Indah Barat II No. 12', 'Gubeng', 'Surabaya', 'Jawa Timur', '60285', 1, '2026-11-17 00:32:37', '2026-11-17 00:32:37');

-- --------------------------------------------------------
-- Table structure for table `shipments`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `shipments`;
CREATE TABLE `shipments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ulid` varchar(255) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `courier_name` varchar(255) NOT NULL,
  `tracking_number` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'label_created',
  `shipped_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `shipments`
INSERT INTO `shipments` (`id`, `ulid`, `order_id`, `courier_name`, `tracking_number`, `status`, `shipped_at`, `delivered_at`, `created_at`, `updated_at`) VALUES
(1, '01M7JPP0CH5YGFHWDE1JMCEF2Z', 1, 'JNE', 'JNE-SUB-99882211', 'delivered', '2026-11-14 00:32:37', '2026-11-16 00:32:37', '2026-11-17 00:32:37', '2026-11-17 00:32:37');

-- --------------------------------------------------------
-- Table structure for table `audit_logs`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `audit_logs`;
CREATE TABLE `audit_logs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NULL DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `entity_type` varchar(255) NOT NULL,
  `entity_id` bigint(20) NULL DEFAULT NULL,
  `old_values` text NULL DEFAULT NULL,
  `new_values` text NULL DEFAULT NULL,
  `ip_address` varchar(255) NULL DEFAULT NULL,
  `user_agent` text NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `drop_items`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `drop_items`;
CREATE TABLE `drop_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `drop_id` bigint(20) NOT NULL,
  `sku_id` bigint(20) NOT NULL,
  `drop_quota` bigint(20) NOT NULL DEFAULT '0',
  `sold_count` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `drop_items`
INSERT INTO `drop_items` (`id`, `drop_id`, `sku_id`, `drop_quota`, `sold_count`, `created_at`, `updated_at`) VALUES
(1, 1, 8, 20, 2, '2026-11-17 00:32:38', '2026-11-17 00:32:38');

-- --------------------------------------------------------
-- Table structure for table `waitlist_entries`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `waitlist_entries`;
CREATE TABLE `waitlist_entries` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `drop_id` bigint(20) NULL DEFAULT NULL,
  `sku_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NULL DEFAULT NULL,
  `consent_given` bigint(20) NOT NULL DEFAULT '1',
  `notified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `return_requests`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `return_requests`;
CREATE TABLE `return_requests` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ulid` varchar(255) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'submitted',
  `reason` varchar(255) NOT NULL,
  `notes` text NULL DEFAULT NULL,
  `photo_url` varchar(255) NULL DEFAULT NULL,
  `admin_notes` text NULL DEFAULT NULL,
  `return_tracking_number` varchar(255) NULL DEFAULT NULL,
  `received_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `return_requests`
INSERT INTO `return_requests` (`id`, `ulid`, `order_id`, `customer_id`, `status`, `reason`, `notes`, `photo_url`, `admin_notes`, `return_tracking_number`, `received_at`, `completed_at`, `created_at`, `updated_at`) VALUES
(1, '01M7JPP0RWY2A5CWENJVW04XS8', 1, 1, 'submitted', 'Tukar Ukuran / Ingin Varian Warna Berbeda', 'Bahan kimono sangat bagus, namun saya ingin tukar warna ke Terracotta jika masih ada stok.', '/images/models/look-3-navy.png', NULL, NULL, NULL, NULL, '2026-11-17 00:32:38', '2026-11-17 00:32:38');

-- --------------------------------------------------------
-- Table structure for table `return_items`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `return_items`;
CREATE TABLE `return_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `return_request_id` bigint(20) NOT NULL,
  `sku_id` bigint(20) NOT NULL,
  `quantity` bigint(20) NOT NULL DEFAULT '1',
  `disposition` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `return_items`
INSERT INTO `return_items` (`id`, `return_request_id`, `sku_id`, `quantity`, `disposition`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'pending', '2026-11-17 00:32:38', '2026-11-17 00:32:38');

-- --------------------------------------------------------
-- Table structure for table `stock_reservations`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `stock_reservations`;
CREATE TABLE `stock_reservations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `sku_id` bigint(20) NOT NULL,
  `location_id` bigint(20) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `expires_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `batches`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `batches`;
CREATE TABLE `batches` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `batch_number` varchar(255) NOT NULL,
  `supplier_name` varchar(255) NULL DEFAULT NULL,
  `notes` text NULL DEFAULT NULL,
  `received_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `batches`
INSERT INTO `batches` (`id`, `batch_number`, `supplier_name`, `notes`, `received_at`, `created_at`, `updated_at`) VALUES
(1, 'BATCH-202611-01', 'Konveksi Hijab Mandiri Pekalongan', 'Produksi rilis PUSPA dan restock ISLA', '2026-11-12 00:32:36', '2026-11-17 00:32:36', '2026-11-17 00:32:36');

-- --------------------------------------------------------
-- Table structure for table `inbounds`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `inbounds`;
CREATE TABLE `inbounds` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ulid` varchar(255) NOT NULL,
  `inbound_number` varchar(255) NOT NULL,
  `batch_id` bigint(20) NULL DEFAULT NULL,
  `location_id` bigint(20) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'completed',
  `notes` text NULL DEFAULT NULL,
  `created_by` bigint(20) NULL DEFAULT NULL,
  `received_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `inbounds`
INSERT INTO `inbounds` (`id`, `ulid`, `inbound_number`, `batch_id`, `location_id`, `status`, `notes`, `created_by`, `received_at`, `created_at`, `updated_at`) VALUES
(1, '01M7JPNZ7EQGFZHVECPDNEGRCV', 'INB-202611-001', 1, 1, 'completed', 'Penerimaan QC lolos 100%', 3, '2026-11-12 00:32:36', '2026-11-17 00:32:36', '2026-11-17 00:32:36');

-- --------------------------------------------------------
-- Table structure for table `inbound_items`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `inbound_items`;
CREATE TABLE `inbound_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `inbound_id` bigint(20) NOT NULL,
  `sku_id` bigint(20) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `cost_idr` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `inbound_items`
INSERT INTO `inbound_items` (`id`, `inbound_id`, `sku_id`, `quantity`, `cost_idr`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 45, 150000, '2026-11-17 00:32:36', '2026-11-17 00:32:36'),
(2, 1, 2, 38, 150000, '2026-11-17 00:32:36', '2026-11-17 00:32:36'),
(3, 1, 3, 30, 150000, '2026-11-17 00:32:36', '2026-11-17 00:32:36'),
(4, 1, 4, 80, 150000, '2026-11-17 00:32:36', '2026-11-17 00:32:36'),
(5, 1, 5, 65, 150000, '2026-11-17 00:32:36', '2026-11-17 00:32:36'),
(6, 1, 6, 25, 150000, '2026-11-17 00:32:36', '2026-11-17 00:32:36'),
(7, 1, 7, 4, 150000, '2026-11-17 00:32:36', '2026-11-17 00:32:36'),
(8, 1, 8, 20, 150000, '2026-11-17 00:32:36', '2026-11-17 00:32:36');

-- --------------------------------------------------------
-- Table structure for table `pick_packs`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `pick_packs`;
CREATE TABLE `pick_packs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ulid` varchar(255) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `assigned_to` bigint(20) NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `picked_at` timestamp NULL DEFAULT NULL,
  `packed_at` timestamp NULL DEFAULT NULL,
  `notes` text NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `pick_packs`
INSERT INTO `pick_packs` (`id`, `ulid`, `order_id`, `assigned_to`, `status`, `picked_at`, `packed_at`, `notes`, `created_at`, `updated_at`) VALUES
(1, '01M7JPP0GZZABCREGF0J2HKYZD', 2, 3, 'picking', NULL, NULL, NULL, '2026-11-17 00:32:37', '2026-11-17 00:32:37');

-- --------------------------------------------------------
-- Table structure for table `pick_scans`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `pick_scans`;
CREATE TABLE `pick_scans` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pick_pack_id` bigint(20) NOT NULL,
  `sku_id` bigint(20) NOT NULL,
  `barcode_scanned` varchar(255) NOT NULL,
  `scanned_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `stocktakes`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `stocktakes`;
CREATE TABLE `stocktakes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ulid` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `location_id` bigint(20) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `notes` text NULL DEFAULT NULL,
  `created_by` bigint(20) NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `stocktake_lines`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `stocktake_lines`;
CREATE TABLE `stocktake_lines` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `stocktake_id` bigint(20) NOT NULL,
  `sku_id` bigint(20) NOT NULL,
  `expected_qty` bigint(20) NOT NULL DEFAULT '0',
  `counted_qty` bigint(20) NOT NULL DEFAULT '0',
  `difference_qty` bigint(20) NOT NULL DEFAULT '0',
  `notes` text NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `channel_quotas`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `channel_quotas`;
CREATE TABLE `channel_quotas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `channel_id` bigint(20) NOT NULL,
  `sku_id` bigint(20) NOT NULL,
  `allocated_qty` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `sku_mappings`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `sku_mappings`;
CREATE TABLE `sku_mappings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `channel_id` bigint(20) NOT NULL,
  `external_sku` varchar(255) NOT NULL,
  `internal_sku_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `marketplace_imports`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `marketplace_imports`;
CREATE TABLE `marketplace_imports` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ulid` varchar(255) NOT NULL,
  `channel_id` bigint(20) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `total_rows` bigint(20) NOT NULL DEFAULT '0',
  `success_rows` bigint(20) NOT NULL DEFAULT '0',
  `duplicate_rows` bigint(20) NOT NULL DEFAULT '0',
  `error_rows` bigint(20) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT 'completed',
  `logs` text NULL DEFAULT NULL,
  `created_by` bigint(20) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `purchase_orders`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `purchase_orders`;
CREATE TABLE `purchase_orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ulid` varchar(255) NOT NULL,
  `po_number` varchar(255) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `total_cost_idr` bigint(20) NOT NULL DEFAULT '0',
  `expected_arrival_date` varchar(255) NULL DEFAULT NULL,
  `notes` text NULL DEFAULT NULL,
  `created_by` bigint(20) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `purchase_order_items`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `purchase_order_items`;
CREATE TABLE `purchase_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `purchase_order_id` bigint(20) NOT NULL,
  `sku_id` bigint(20) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `cost_idr` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `event_logs`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `event_logs`;
CREATE TABLE `event_logs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) NULL DEFAULT NULL,
  `session_id` varchar(255) NOT NULL,
  `event_type` varchar(255) NOT NULL,
  `metadata` text NULL DEFAULT NULL,
  `ip_address` varchar(255) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `customer_metrics`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `customer_metrics`;
CREATE TABLE `customer_metrics` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) NOT NULL,
  `recency_days` bigint(20) NOT NULL DEFAULT '0',
  `frequency_count` bigint(20) NOT NULL DEFAULT '0',
  `monetary_total_idr` bigint(20) NOT NULL DEFAULT '0',
  `r_score` bigint(20) NOT NULL DEFAULT '1',
  `f_score` bigint(20) NOT NULL DEFAULT '1',
  `m_score` bigint(20) NOT NULL DEFAULT '1',
  `segment` varchar(255) NOT NULL DEFAULT 'new',
  `rhythm_days` bigint(20) NULL DEFAULT NULL,
  `predicted_next_purchase` varchar(255) NULL DEFAULT NULL,
  `last_calculated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `customer_metrics`
INSERT INTO `customer_metrics` (`id`, `customer_id`, `recency_days`, `frequency_count`, `monetary_total_idr`, `r_score`, `f_score`, `m_score`, `segment`, `rhythm_days`, `predicted_next_purchase`, `last_calculated_at`, `created_at`, `updated_at`) VALUES
(1, 1, -5, 1, 553000, 5, 2, 3, 'potential', NULL, NULL, '2026-11-17 00:32:38', '2026-11-17 00:32:38', '2026-11-17 00:32:38'),
(2, 2, 0, 1, 407000, 5, 2, 2, 'potential', NULL, NULL, '2026-11-17 00:32:38', '2026-11-17 00:32:38', '2026-11-17 00:32:38'),
(3, 3, -120, 1, 1382000, 5, 2, 4, 'potential', NULL, NULL, '2026-11-17 00:32:38', '2026-11-17 00:32:38', '2026-11-17 00:32:38');

-- --------------------------------------------------------
-- Table structure for table `segments`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `segments`;
CREATE TABLE `segments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NULL DEFAULT NULL,
  `criteria` text NULL DEFAULT NULL,
  `is_active` bigint(20) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `segment_members`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `segment_members`;
CREATE TABLE `segment_members` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `segment_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `flows`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `flows`;
CREATE TABLE `flows` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `trigger_event` varchar(255) NOT NULL,
  `delay_hours` bigint(20) NOT NULL DEFAULT '0',
  `requires_approval` bigint(20) NOT NULL DEFAULT '0',
  `is_active` bigint(20) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `flows`
INSERT INTO `flows` (`id`, `code`, `name`, `trigger_event`, `delay_hours`, `requires_approval`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'welcome', 'Welcome Series (Pelanggan Baru)', 'customer.registered', 0, 0, 1, '2026-11-17 00:32:38', '2026-11-17 00:32:38'),
(2, 'post_purchase', 'Post-Purchase Care & Styling Tips', 'order.paid', 24, 0, 1, '2026-11-17 00:32:38', '2026-11-17 00:32:38'),
(3, 'win_back', 'Win-Back Personal Touch (Pelanggan Lama)', 'rfm.at_risk', 0, 1, 1, '2026-11-17 00:32:38', '2026-11-17 00:32:38');

-- --------------------------------------------------------
-- Table structure for table `email_templates`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE `email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `preview_text` text NULL DEFAULT NULL,
  `body_html` text NOT NULL,
  `is_active` bigint(20) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `email_templates`
INSERT INTO `email_templates` (`id`, `code`, `subject`, `preview_text`, `body_html`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'TMPL_WELCOME', 'Selamat datang di ITSFRIDAY — Cerita di Balik #everydayitsfriday', 'Terima kasih telah bergabung di lingkaran keluarga ITSFRIDAY.', '<div style=\"font-family: sans-serif; max-width: 600px; margin: auto; padding: 24px; color: #2D3748;\">\r\n                <h2 style=\"color: #1A202C;\">Halo {{ customer_name }},</h2>\r\n                <p>Selamat datang di <strong>ITSFRIDAY</strong>. Bagi kami, rasa nyaman, percaya diri, dan kehangatan akhir pekan seharusnya bisa Anda rasakan setiap hari (#everydayitsfriday).</p>\r\n                <p>Nikmati voucher sambutan 10% dengan kode: <strong style=\"background: #EDF2F7; padding: 4px 8px; border-radius: 4px;\">EVERYDAYFRIDAY</strong></p>\r\n                <p>Salam hangat,<br><strong>Tim ITSFRIDAY</strong></p>\r\n            </div>', 1, '2026-11-17 00:32:38', '2026-11-17 00:32:38'),
(2, 'TMPL_POST_PURCHASE', 'Panduan Perawatan dan Styling Produk ITSFRIDAY Anda', 'Tips agar kain rayon twill dan voal Anda tetap selembut hari pertama.', '<div style=\"font-family: sans-serif; max-width: 600px; margin: auto; padding: 24px;\">\r\n                <h2>Terima kasih atas pesanan Anda!</h2>\r\n                <p>Kami harap produk ITSFRIDAY melengkapi hari-hari Anda dengan sempurna.</p>\r\n                <p>Ingat untuk mencuci dengan air dingin dan hindari penjemuran langsung di bawah terik matahari agar warna tetap awet.</p>\r\n            </div>', 1, '2026-11-17 00:32:38', '2026-11-17 00:32:38');

-- --------------------------------------------------------
-- Table structure for table `flow_runs`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `flow_runs`;
CREATE TABLE `flow_runs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `flow_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `reference_type` varchar(255) NULL DEFAULT NULL,
  `reference_id` bigint(20) NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'scheduled',
  `scheduled_for` timestamp NOT NULL,
  `approved_by` bigint(20) NULL DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `sent_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `flow_runs`
INSERT INTO `flow_runs` (`id`, `flow_id`, `customer_id`, `reference_type`, `reference_id`, `status`, `scheduled_for`, `approved_by`, `approved_at`, `sent_at`, `created_at`, `updated_at`) VALUES
(1, 3, 3, 'Customer', 3, 'pending_approval', '2026-11-18 00:32:38', NULL, NULL, NULL, '2026-11-17 00:32:38', '2026-11-17 00:32:38');

-- --------------------------------------------------------
-- Table structure for table `messages`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ulid` varchar(255) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `flow_run_id` bigint(20) NULL DEFAULT NULL,
  `template_id` bigint(20) NULL DEFAULT NULL,
  `channel` varchar(255) NOT NULL DEFAULT 'email',
  `recipient` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body_html` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `error_message` text NULL DEFAULT NULL,
  `sent_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `message_events`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `message_events`;
CREATE TABLE `message_events` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `message_id` bigint(20) NOT NULL,
  `event_type` varchar(255) NOT NULL,
  `ip_address` varchar(255) NULL DEFAULT NULL,
  `occurred_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `loyalty_ledgers`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `loyalty_ledgers`;
CREATE TABLE `loyalty_ledgers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) NOT NULL,
  `points` bigint(20) NOT NULL,
  `transaction_type` varchar(255) NOT NULL,
  `reference_id` varchar(255) NULL DEFAULT NULL,
  `notes` text NULL DEFAULT NULL,
  `created_by` bigint(20) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `loyalty_ledgers`
INSERT INTO `loyalty_ledgers` (`id`, `customer_id`, `points`, `transaction_type`, `reference_id`, `notes`, `created_by`, `created_at`) VALUES
(1, 1, 55, 'EARN_PURCHASE', 'ORD-20261110-001', 'Poin transaksi order #ORD-20261110-001', NULL, '2026-11-13 00:32:38');

-- --------------------------------------------------------
-- Table structure for table `affiliates`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `affiliates`;
CREATE TABLE `affiliates` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `customer_id` bigint(20) NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `bank_name` varchar(255) NULL DEFAULT NULL,
  `bank_account_number` varchar(255) NULL DEFAULT NULL,
  `bank_account_holder` varchar(255) NULL DEFAULT NULL,
  `commission_rate` decimal(14,2) NOT NULL DEFAULT '10',
  `total_commission_idr` bigint(20) NOT NULL DEFAULT '0',
  `total_paid_idr` bigint(20) NOT NULL DEFAULT '0',
  `is_active` bigint(20) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `affiliates`
INSERT INTO `affiliates` (`id`, `code`, `customer_id`, `name`, `email`, `bank_name`, `bank_account_number`, `bank_account_holder`, `commission_rate`, `total_commission_idr`, `total_paid_idr`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'AULIAFRIDAY', 1, 'Aulia Rahmawati (Creator)', 'aulia.rahma@gmail.com', 'BCA', '8290123456', 'Aulia Rahmawati', 10, 55300, 0, 1, '2026-11-17 00:32:38', '2026-11-17 00:32:38');

-- --------------------------------------------------------
-- Table structure for table `referrals`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `referrals`;
CREATE TABLE `referrals` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `affiliate_id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `order_total_idr` bigint(20) NOT NULL,
  `commission_amount_idr` bigint(20) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `action_items`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `action_items`;
CREATE TABLE `action_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ulid` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `priority` varchar(255) NOT NULL DEFAULT 'medium',
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `action_url` varchar(255) NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `resolved_at` timestamp NULL DEFAULT NULL,
  `resolved_by` bigint(20) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `action_items`
INSERT INTO `action_items` (`id`, `ulid`, `category`, `priority`, `title`, `description`, `action_url`, `status`, `resolved_at`, `resolved_by`, `created_at`, `updated_at`) VALUES
(1, '01M7JPP17YBHF45RA38CDTNFN2', 'REORDER_LOW_STOCK', 'high', 'Stok Menipis: ISLA-DRS-OAT-LXL (ISLA Geometrik Outer - Sage Green (L/XL))', 'Tersisa 4 pcs di gudang. Segera buat purchase order ke penjahit/supplier.', '/admin/wms/reorder?sku_id=7', 'pending', NULL, NULL, '2026-11-17 00:32:38', '2026-11-17 00:32:38'),
(2, '01M7JPP18YVT936G9ZJ00MAT1C', 'PENDING_RETURN', 'high', 'Permintaan Retur Baru: Order #ORD-20261110-001', 'Alasan: Tukar Ukuran / Ingin Varian Warna Berbeda. Pelanggan menunggu konfirmasi instruksi pengiriman barang.', '/admin/store/returns/1', 'pending', NULL, NULL, '2026-11-17 00:32:38', '2026-11-17 00:32:38'),
(3, '01M7JPP19RJTD2B0TWEAW4J2PB', 'FLOW_APPROVAL', 'medium', 'Persetujuan Kampanye: Win-Back Personal Touch (Pelanggan Lama)', 'Pesan email untuk pelanggan Nadia Amanda Putri (nadia.putri@outlook.com) siap dikirim setelah persetujuan pemilik.', '/admin/crm/flows', 'pending', NULL, NULL, '2026-11-17 00:32:38', '2026-11-17 00:32:38'),
(4, '01M7JQZQTMH67B6T3NRBMH7CG5', 'FLOW_APPROVAL', 'medium', 'Persetujuan Kampanye: Win-Back Personal Touch (Pelanggan Lama)', 'Pesan email untuk pelanggan Nadia Amanda Putri (nadia.putri@outlook.com) siap dikirim setelah persetujuan pemilik.', '/admin/crm/flows', 'pending', NULL, NULL, '2026-11-17 00:55:25', '2026-11-17 00:55:25'),
(5, '01M7JR72JCMV3STC9BXTZ8TRTS', 'FLOW_APPROVAL', 'medium', 'Persetujuan Kampanye: Win-Back Personal Touch (Pelanggan Lama)', 'Pesan email untuk pelanggan Nadia Amanda Putri (nadia.putri@outlook.com) siap dikirim setelah persetujuan pemilik.', '/admin/crm/flows', 'pending', NULL, NULL, '2026-11-17 00:59:25', '2026-11-17 00:59:25'),
(6, '01M7K1Z2S2CFBEZE42G8037KVT', 'FLOW_APPROVAL', 'medium', 'Persetujuan Kampanye: Win-Back Personal Touch (Pelanggan Lama)', 'Pesan email untuk pelanggan Nadia Amanda Putri (nadia.putri@outlook.com) siap dikirim setelah persetujuan pemilik.', '/admin/crm/flows', 'pending', NULL, NULL, '2026-11-17 03:49:49', '2026-11-17 03:49:49');

-- --------------------------------------------------------
-- Table structure for table `dsr_requests`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `dsr_requests`;
CREATE TABLE `dsr_requests` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ulid` varchar(255) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `request_type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'submitted',
  `reason` text NULL DEFAULT NULL,
  `result_url` varchar(255) NULL DEFAULT NULL,
  `processed_by` bigint(20) NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS=1;
COMMIT;
