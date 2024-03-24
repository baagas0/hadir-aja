-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 24, 2024 at 10:15 PM
-- Server version: 10.6.15-MariaDB-cll-lve
-- PHP Version: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webditya_hadir_aja`
--

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
(1, '2014_10_11_000000_create_roles_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_12_07_151055_create_schools_table', 1),
(7, '2023_12_07_151056_create_school_group_roles_table', 1),
(8, '2023_12_07_151097_create_school_shifts_table', 1),
(9, '2023_12_07_151098_create_school_shift_hours_table', 1),
(10, '2023_12_07_151099_create_school_groups_table', 1),
(11, '2023_12_07_151100_create_school_positions_table', 1),
(12, '2023_12_07_151101_create_school_locations_table', 1),
(13, '2023_12_07_151102_create_school_users_table', 2),
(17, '2023_12_07_151338_create_school_billings_table', 2),
(18, '2023_12_07_151343_create_school_billing_quotas_table', 2),
(19, '2023_12_07_151348_create_school_billing_quota_transactions_table', 2),
(20, '2014_10_12_100000_create_password_resets_table', 3),
(21, '2023_12_07_151305_create_services_table', 3),
(22, '2023_12_07_151313_create_packages_table', 3),
(23, '2023_12_07_151316_create_package_services_table', 3),
(24, '2023_12_30_020529_create_presence_dailies_table', 4),
(25, '2023_12_31_153704_create_presence_logs_table', 5),
(26, '2024_01_02_183037_create_presence_barcodes_table', 5),
(27, '2024_01_02_183045_create_presence_barcode_school_users_table', 5),
(28, '2024_01_12_021124_create_payments_table', 5),
(29, '2024_03_24_150939_add_fields_schools_table', 6),
(30, '2024_03_24_152948_add_fields_2_schools_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED DEFAULT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `one_time_attemp` tinyint(1) NOT NULL DEFAULT 0,
  `bundling_price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `school_id`, `code`, `name`, `icon`, `description`, `one_time_attemp`, `bundling_price`, `created_at`, `updated_at`) VALUES
(1, NULL, 'PKG-TRIAL', 'Paket Trial 30 Hari', '-', '-', 1, 0, NULL, NULL),
(2, NULL, 'PKG-SMART', 'Paket Smart', '-', '-', 0, 300000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `package_services`
--

CREATE TABLE `package_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `limit_quota` int(11) NOT NULL,
  `user_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_services`
--

INSERT INTO `package_services` (`id`, `package_id`, `service_id`, `limit_quota`, `user_count`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 18000, 300, NULL, NULL),
(2, 1, 2, 18000, 300, NULL, NULL),
(3, 2, 1, 6000, 100, NULL, NULL),
(4, 2, 2, 6000, 100, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `school_id` bigint(20) UNSIGNED DEFAULT NULL,
  `package_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment` varchar(255) NOT NULL,
  `merchant_ref` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `amount` decimal(13,2) DEFAULT NULL,
  `amount_received` decimal(13,2) NOT NULL,
  `status` enum('UNPAID','PAID','REFUND','EXPIRED','FAILED') DEFAULT 'UNPAID',
  `approval_status` tinyint(4) NOT NULL DEFAULT 0,
  `approval_at` timestamp NULL DEFAULT NULL,
  `expired_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `school_id`, `package_id`, `payment`, `merchant_ref`, `reference`, `amount`, `amount_received`, `status`, `approval_status`, `approval_at`, `expired_at`, `created_at`, `updated_at`) VALUES
(5, 1, 1, 2, 'PERMATAVA', 'INV-11710666677', 'DEV-T3202148043EO688', 304250.00, 300000.00, 'UNPAID', 1, '2024-03-17 10:47:46', '2024-03-18 09:11:17', '2024-03-17 09:11:17', '2024-03-17 10:47:46'),
(6, 1, 1, 2, 'CIMBVA', 'INV-11710703907', 'DEV-T3202148154BYVAO', 304250.00, 300000.00, 'UNPAID', 1, '2024-03-17 19:32:29', '2024-03-18 19:31:47', '2024-03-17 19:31:48', '2024-03-17 19:32:29');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `presence_barcodes`
--

CREATE TABLE `presence_barcodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `school_position_id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `date` date NOT NULL,
  `day` varchar(255) NOT NULL,
  `actual_hour_in` time NOT NULL COMMENT 'dari shift_hour_id',
  `actual_hour_out` time NOT NULL COMMENT 'dari shift_hour_id',
  `actual_duration` int(11) NOT NULL COMMENT 'dari shift_hour_id - satuan menit',
  `qr_code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `presence_barcodes`
--

INSERT INTO `presence_barcodes` (`id`, `school_id`, `service_id`, `school_position_id`, `title`, `description`, `date`, `day`, `actual_hour_in`, `actual_hour_out`, `actual_duration`, `qr_code`, `created_at`, `updated_at`) VALUES
(9, 1, 2, 4, 'Presensi Fisika', NULL, '2024-01-03', 'Wednesday', '12:31:00', '16:12:00', 221, '6R17KBJ55BZL0HDI53IGZ', '2024-01-02 20:01:28', '2024-01-10 07:07:46'),
(10, 1, 2, 4, 'Manajemen Proyek', NULL, '2024-01-10', 'Wednesday', '12:00:00', '15:00:00', 180, 'R998YEDEE2EP5LFATL709', '2024-01-09 18:06:37', '2024-01-15 08:24:01'),
(11, 1, 2, 4, 'Uas Manpro', NULL, '2024-01-10', 'Wednesday', '12:00:00', '15:00:00', 180, 'QD8ZBMN6C52AUZBGUX4GC', '2024-01-10 07:07:50', '2024-01-10 07:07:50'),
(13, 1, 2, 3, 'Kalkulus 1', NULL, '2024-01-15', 'Monday', '15:00:00', '18:00:00', 180, 'VB1KM9ZPR1FZFS3H19XX6', '2024-01-15 08:07:16', '2024-01-15 18:06:43'),
(14, 1, 2, 4, 'Kalkulus 2', NULL, '2024-01-15', 'Monday', '15:15:00', '18:00:00', 165, 'ZWMG5TRQLZ2UONEOWCV1A', '2024-01-15 08:26:53', '2024-01-15 08:43:46'),
(15, 1, 2, 4, 'FIsika', NULL, '2024-01-15', 'Monday', '15:00:00', '18:00:00', 180, '3RA26IELKB1DZZ9Q2CD3I', '2024-01-15 08:44:12', '2024-01-15 16:33:07'),
(16, 1, 2, 4, 'Ngoding', NULL, '2024-01-15', 'Monday', '09:32:00', '23:59:00', 867, 'HKOQLEK9HMUG32CONEWVY', '2024-01-15 16:32:53', '2024-01-15 16:48:01'),
(17, 1, 2, 4, 'Basis Data', NULL, '2024-01-15', 'Monday', '12:12:00', '14:14:00', 122, 'ESC4W0MDYG8EWI76VVFCD', '2024-01-15 16:49:11', '2024-01-15 18:07:00'),
(18, 1, 2, 4, 'Kalkulus3', NULL, '2024-01-16', 'Tuesday', '12:12:00', '14:14:00', 122, 'N3M2VBZ5D1L8DX9MUITLW', '2024-01-15 18:07:17', '2024-01-15 18:10:23'),
(19, 1, 2, 4, 'Presensi Bahasa Ingris', NULL, '2024-01-16', 'Tuesday', '01:00:00', '03:00:00', 120, '21LJHA0ICKLR3JH5F3NBJ', '2024-01-15 18:09:58', '2024-01-15 18:15:21'),
(20, 1, 2, 4, 'Presensi Dinacom 2024', NULL, '2024-01-21', 'Sunday', '12:12:00', '15:15:00', 183, 'NQQ6MH9IFDHBXMEJ9RB5E', '2024-01-20 19:19:59', '2024-01-24 10:09:35'),
(21, 1, 2, 4, 'Test 1', NULL, '2024-01-24', 'Wednesday', '17:09:00', '18:30:00', 81, 'DB4O515Z7NNV656J2P137', '2024-01-24 10:09:35', '2024-03-20 05:55:38'),
(22, 1, 2, 4, 'Test 2', NULL, '2024-01-24', 'Wednesday', '15:00:00', '16:00:00', 60, '21D5P1AOIKU49GXFQATZY', '2024-01-24 10:11:03', '2024-01-24 10:12:20'),
(23, 1, 2, 4, 'Test 3', NULL, '2024-01-24', 'Wednesday', '23:00:00', '12:30:00', 510, 'CXR02OLT0KIVHE6DJLFR8', '2024-01-24 15:44:21', '2024-01-25 16:41:42');

-- --------------------------------------------------------

--
-- Table structure for table `presence_barcode_school_users`
--

CREATE TABLE `presence_barcode_school_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_user_id` bigint(20) UNSIGNED NOT NULL,
  `presence_barcode_id` bigint(20) UNSIGNED NOT NULL,
  `hour_in` time DEFAULT NULL,
  `hour_out` time DEFAULT NULL,
  `duration` int(11) NOT NULL DEFAULT 0 COMMENT 'satuan menit',
  `state` enum('tidak diketahui','masuk','pulang') NOT NULL DEFAULT 'tidak diketahui',
  `status` enum('hadir','izin','mangkir') NOT NULL DEFAULT 'mangkir',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `presence_barcode_school_users`
--

INSERT INTO `presence_barcode_school_users` (`id`, `school_user_id`, `presence_barcode_id`, `hour_in`, `hour_out`, `duration`, `state`, `status`, `created_at`, `updated_at`) VALUES
(2, 2, 9, '13:48:00', '15:24:21', 96, 'pulang', 'hadir', NULL, '2024-01-15 08:24:21'),
(3, 2, 10, '13:48:20', '14:19:16', 30, 'pulang', 'hadir', NULL, '2024-01-15 07:19:16'),
(4, 2, 11, '15:24:09', NULL, 0, 'masuk', 'hadir', NULL, '2024-01-15 08:24:09'),
(5, 3, 11, NULL, NULL, 0, 'tidak diketahui', 'mangkir', NULL, NULL),
(6, 4, 13, NULL, NULL, 0, 'tidak diketahui', 'mangkir', NULL, NULL),
(7, 2, 14, '15:27:15', '15:43:28', 16, 'pulang', 'hadir', NULL, '2024-01-15 08:43:28'),
(8, 3, 14, NULL, NULL, 0, 'tidak diketahui', 'mangkir', NULL, NULL),
(9, 2, 15, '15:44:43', '15:44:56', 0, 'pulang', 'hadir', NULL, '2024-01-15 08:44:56'),
(10, 3, 15, NULL, NULL, 0, 'tidak diketahui', 'mangkir', NULL, NULL),
(11, 2, 16, NULL, NULL, 0, 'tidak diketahui', 'mangkir', NULL, NULL),
(12, 3, 16, NULL, NULL, 0, 'tidak diketahui', 'mangkir', NULL, NULL),
(13, 5, 16, '23:33:26', '23:33:39', 0, 'pulang', 'hadir', NULL, '2024-01-15 16:33:39'),
(14, 2, 17, NULL, NULL, 0, 'tidak diketahui', 'mangkir', NULL, NULL),
(15, 3, 17, NULL, NULL, 0, 'tidak diketahui', 'mangkir', NULL, NULL),
(16, 5, 17, '23:49:48', '23:49:55', 0, 'pulang', 'hadir', NULL, '2024-01-15 16:49:55'),
(17, 2, 18, NULL, NULL, 0, 'tidak diketahui', 'mangkir', NULL, NULL),
(18, 3, 18, NULL, NULL, 0, 'tidak diketahui', 'mangkir', NULL, NULL),
(19, 5, 18, '01:10:10', NULL, 0, 'masuk', 'hadir', NULL, '2024-01-15 18:10:10'),
(20, 2, 19, NULL, NULL, 0, 'tidak diketahui', 'mangkir', NULL, NULL),
(21, 3, 19, NULL, NULL, 0, 'tidak diketahui', 'mangkir', NULL, NULL),
(22, 5, 19, '01:12:07', '01:12:30', 0, 'pulang', 'hadir', NULL, '2024-01-15 18:12:30'),
(23, 2, 20, '02:24:01', '02:24:23', 0, 'pulang', 'hadir', NULL, '2024-01-20 19:24:23'),
(24, 3, 20, NULL, NULL, 0, 'tidak diketahui', 'mangkir', NULL, NULL),
(25, 5, 20, '17:08:28', '17:08:39', 0, 'pulang', 'hadir', NULL, '2024-01-24 10:08:39'),
(26, 2, 21, NULL, NULL, 0, 'tidak diketahui', 'mangkir', NULL, NULL),
(27, 3, 21, NULL, NULL, 0, 'tidak diketahui', 'mangkir', NULL, NULL),
(28, 5, 21, '17:09:46', '17:09:52', 0, 'pulang', 'hadir', NULL, '2024-01-24 10:09:52'),
(29, 2, 22, NULL, NULL, 0, 'tidak diketahui', 'mangkir', NULL, NULL),
(30, 3, 22, NULL, NULL, 0, 'tidak diketahui', 'mangkir', NULL, NULL),
(31, 5, 22, '17:11:33', '17:11:37', 0, 'pulang', 'hadir', NULL, '2024-01-24 10:11:37'),
(32, 2, 23, NULL, NULL, 0, 'tidak diketahui', 'mangkir', NULL, NULL),
(33, 3, 23, NULL, NULL, 0, 'tidak diketahui', 'mangkir', NULL, NULL),
(34, 5, 23, '23:33:58', '23:34:55', 0, 'pulang', 'hadir', NULL, '2024-01-24 16:34:55');

-- --------------------------------------------------------

--
-- Table structure for table `presence_dailies`
--

CREATE TABLE `presence_dailies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `school_user_id` bigint(20) UNSIGNED NOT NULL,
  `presence_location_id` bigint(20) UNSIGNED DEFAULT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `school_shift_id` bigint(20) UNSIGNED NOT NULL,
  `school_shift_hour_id` bigint(20) UNSIGNED NOT NULL,
  `day` varchar(255) NOT NULL COMMENT 'dari shift_hour_id',
  `actual_hour_in` time NOT NULL COMMENT 'dari shift_hour_id',
  `actual_hour_out` time NOT NULL COMMENT 'dari shift_hour_id',
  `actual_duration` int(11) NOT NULL COMMENT 'dari shift_hour_id - satuan menit',
  `presence_date` date NOT NULL,
  `presence_day` varchar(255) NOT NULL,
  `attachment_in` varchar(255) DEFAULT NULL,
  `hour_in` time DEFAULT NULL,
  `lat_in` varchar(255) DEFAULT NULL,
  `long_in` varchar(255) DEFAULT NULL,
  `attachment_out` varchar(255) DEFAULT NULL,
  `hour_out` time DEFAULT NULL,
  `lat_out` varchar(255) DEFAULT NULL,
  `long_out` varchar(255) DEFAULT NULL,
  `duration` int(11) NOT NULL DEFAULT 0 COMMENT 'satuan menit',
  `state` enum('tidak diketahui','masuk','pulang') NOT NULL DEFAULT 'tidak diketahui',
  `status` enum('hadir','izin','sakit','mangkir') NOT NULL DEFAULT 'mangkir',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `face_match_in_response` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `face_match_out_response` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ;

--
-- Dumping data for table `presence_dailies`
--

INSERT INTO `presence_dailies` (`id`, `school_id`, `school_user_id`, `presence_location_id`, `service_id`, `school_shift_id`, `school_shift_hour_id`, `day`, `actual_hour_in`, `actual_hour_out`, `actual_duration`, `presence_date`, `presence_day`, `attachment_in`, `hour_in`, `lat_in`, `long_in`, `attachment_out`, `hour_out`, `lat_out`, `long_out`, `duration`, `state`, `status`, `created_at`, `updated_at`, `face_match_in_response`, `face_match_out_response`) VALUES
(6, 1, 1, 13, 1, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-01-07', 'Minggu', '1704572349 6 in base64_selfie_img.png', '03:19:17', '-7.0630630630631', '110.42354414889', '1704572430 6 out base64_selfie_img.png', '03:20:32', '-7.0630630630631', '110.42354414889', 1, 'pulang', 'hadir', '2024-01-06 19:57:03', '2024-01-06 20:20:32', '{\"data\":{\"error_procentage\":0.4269424900344951,\"match\":true},\"message\":\"Berhasil mendeteksi wajah\",\"success\":true}', '{\"data\":{\"error_procentage\":0.470896802399617,\"match\":true},\"message\":\"Berhasil mendeteksi wajah\",\"success\":true}'),
(14, 1, 2, 13, 1, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-01-07', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'izin', '2024-01-06 19:57:03', '2024-01-15 06:24:25', NULL, NULL),
(15, 1, 1, 13, 1, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-01-08', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-07 17:01:03', '2024-01-07 17:01:03', NULL, NULL),
(16, 1, 2, NULL, 2, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-01-08', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-07 17:01:03', '2024-01-07 17:01:03', NULL, NULL),
(17, 1, 1, 13, 1, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-01-09', 'Selasa', '1704812805 17 in base64_selfie_img.png', '22:06:46', '-7.0630630630631', '110.40538835406', '1704812870 17 out base64_selfie_img.png', '22:07:51', '-7.0630630630631', '110.40538835406', 1, 'pulang', 'hadir', '2024-01-08 17:01:02', '2024-01-09 15:07:51', '{\"data\":{\"error_procentage\":0.36735188017933945,\"match\":true},\"message\":\"Berhasil mendeteksi wajah\",\"success\":true}', '{\"data\":{\"error_procentage\":0.4769607563004665,\"match\":true},\"message\":\"Berhasil mendeteksi wajah\",\"success\":true}'),
(18, 1, 2, NULL, 2, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-01-09', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-08 17:01:02', '2024-01-08 17:01:02', NULL, NULL),
(19, 1, 1, 13, 1, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-01-10', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-09 17:01:02', '2024-01-10 06:46:40', NULL, NULL),
(20, 1, 2, NULL, 2, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-01-10', 'Rabu', '1704869863 20 in base64_selfie_img.png', '13:57:44', '-6.972972972973', '110.4021721301', NULL, NULL, NULL, NULL, 0, 'masuk', 'hadir', '2024-01-09 17:01:02', '2024-01-10 06:57:44', '{\"data\":{\"error_procentage\":0.3833357329030774,\"match\":true},\"message\":\"Berhasil mendeteksi wajah\",\"success\":true}', NULL),
(21, 1, 1, 13, 1, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-01-11', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-10 17:01:02', '2024-01-10 17:01:02', NULL, NULL),
(22, 1, 2, NULL, 2, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-01-11', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-10 17:01:02', '2024-01-10 17:01:02', NULL, NULL),
(23, 1, 3, NULL, 2, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-01-11', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-10 17:01:02', '2024-01-10 17:01:02', NULL, NULL),
(24, 1, 1, 13, 1, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-01-12', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-11 17:01:02', '2024-01-11 17:01:02', NULL, NULL),
(25, 1, 2, NULL, 2, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-01-12', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-11 17:01:02', '2024-01-11 17:01:02', NULL, NULL),
(26, 1, 3, NULL, 2, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-01-12', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-11 17:01:02', '2024-01-11 17:01:02', NULL, NULL),
(27, 1, 1, 13, 1, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-01-13', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-12 17:01:02', '2024-01-12 17:01:02', NULL, NULL),
(28, 1, 2, NULL, 2, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-01-13', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-12 17:01:02', '2024-01-12 17:01:02', NULL, NULL),
(29, 1, 3, NULL, 2, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-01-13', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-12 17:01:02', '2024-01-12 17:01:02', NULL, NULL),
(30, 1, 1, 13, 1, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-01-14', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-13 17:01:02', '2024-01-13 17:01:02', NULL, NULL),
(31, 1, 2, NULL, 2, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-01-14', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-13 17:01:02', '2024-01-13 17:01:02', NULL, NULL),
(32, 1, 3, NULL, 2, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-01-14', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-13 17:01:02', '2024-01-13 17:01:02', NULL, NULL),
(33, 1, 1, 13, 1, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-01-15', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-14 17:01:02', '2024-01-14 17:01:02', NULL, NULL),
(34, 1, 2, NULL, 2, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-01-15', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-14 17:01:02', '2024-01-14 17:01:02', NULL, NULL),
(35, 1, 3, NULL, 2, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-01-15', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-14 17:01:02', '2024-01-14 17:01:02', NULL, NULL),
(36, 1, 5, NULL, 2, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-01-15', 'Senin', '1705335442 36 in base64_selfie_img.png', '23:17:24', '-7.009009009009', '110.37437982664', '1705335478 36 out base64_selfie_img.png', '23:17:59', '-7.009009009009', '110.37437982664', 0, 'pulang', 'hadir', '2024-01-14 17:01:02', '2024-01-15 16:17:59', '{\"data\":{\"error_procentage\":0.4213934378000001,\"match\":true},\"message\":\"Berhasil mendeteksi wajah\",\"success\":true}', '{\"data\":{\"error_procentage\":0.3700428609157514,\"match\":true},\"message\":\"Berhasil mendeteksi wajah\",\"success\":true}'),
(37, 1, 1, 13, 1, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-01-16', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-15 17:01:02', '2024-01-15 17:01:02', NULL, NULL),
(38, 1, 2, NULL, 2, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-01-16', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-15 17:01:02', '2024-01-15 17:01:02', NULL, NULL),
(39, 1, 3, NULL, 2, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-01-16', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-15 17:01:02', '2024-01-15 17:01:02', NULL, NULL),
(40, 1, 5, 15, 2, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-01-16', 'Selasa', '1705341934 40 in base64_selfie_img.png', '01:05:36', '-7.0074123', '110.3769787', '1705341950 40 out base64_selfie_img.png', '01:05:51', '-7.0074194', '110.3769767', 0, 'pulang', 'hadir', '2024-01-15 17:01:02', '2024-01-15 18:05:51', '{\"data\":{\"error_procentage\":0.45299813740897943,\"match\":true},\"message\":\"Berhasil mendeteksi wajah\",\"success\":true}', '{\"data\":{\"error_procentage\":0.3982987143739614,\"match\":true},\"message\":\"Berhasil mendeteksi wajah\",\"success\":true}'),
(41, 1, 1, 13, 1, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-01-17', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-16 17:01:03', '2024-01-16 17:01:03', NULL, NULL),
(42, 1, 2, NULL, 2, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-01-17', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-16 17:01:03', '2024-01-16 17:01:03', NULL, NULL),
(43, 1, 3, NULL, 2, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-01-17', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-16 17:01:03', '2024-01-16 17:01:03', NULL, NULL),
(44, 1, 5, 15, 2, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-01-17', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-16 17:01:03', '2024-01-16 17:01:03', NULL, NULL),
(45, 1, 1, 13, 1, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-01-18', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-17 17:01:02', '2024-01-17 17:01:02', NULL, NULL),
(46, 1, 2, NULL, 2, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-01-18', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-17 17:01:02', '2024-01-17 17:01:02', NULL, NULL),
(47, 1, 3, NULL, 2, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-01-18', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-17 17:01:02', '2024-01-17 17:01:02', NULL, NULL),
(48, 1, 5, 15, 2, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-01-18', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-17 17:01:02', '2024-01-17 17:01:02', NULL, NULL),
(49, 1, 1, 13, 1, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-01-19', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-18 17:01:03', '2024-01-18 17:01:03', NULL, NULL),
(50, 1, 2, NULL, 2, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-01-19', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-18 17:01:03', '2024-01-18 17:01:03', NULL, NULL),
(51, 1, 3, NULL, 2, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-01-19', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-18 17:01:03', '2024-01-18 17:01:03', NULL, NULL),
(52, 1, 5, 15, 2, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-01-19', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-18 17:01:03', '2024-01-18 17:01:03', NULL, NULL),
(53, 1, 1, 13, 1, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-01-20', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-19 17:01:02', '2024-01-19 17:01:02', NULL, NULL),
(54, 1, 2, NULL, 2, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-01-20', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-19 17:01:02', '2024-01-19 17:01:02', NULL, NULL),
(55, 1, 3, NULL, 2, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-01-20', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-19 17:01:02', '2024-01-19 17:01:02', NULL, NULL),
(56, 1, 5, 15, 2, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-01-20', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-19 17:01:02', '2024-01-19 17:01:02', NULL, NULL),
(57, 1, 1, 13, 1, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-01-21', 'Minggu', '1705778496 57 in base64_selfie_img.png', '02:21:38', '-7.7657657657658', '110.34533760436', '1705778537 57 out base64_selfie_img.png', '02:22:19', '-7.7657657657658', '110.34533760436', 0, 'pulang', 'hadir', '2024-01-20 17:01:02', '2024-01-20 19:22:19', '{\"data\":{\"error_procentage\":0.37937308432180605,\"match\":true},\"message\":\"Berhasil mendeteksi wajah\",\"success\":true}', '{\"data\":{\"error_procentage\":0.4004548663888957,\"match\":true},\"message\":\"Berhasil mendeteksi wajah\",\"success\":true}'),
(58, 1, 2, NULL, 2, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-01-21', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-20 17:01:02', '2024-01-20 18:50:46', NULL, NULL),
(59, 1, 3, NULL, 2, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-01-21', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-20 17:01:02', '2024-01-20 17:01:02', NULL, NULL),
(60, 1, 5, 15, 2, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-01-21', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-20 17:01:02', '2024-01-20 17:01:02', NULL, NULL),
(61, 1, 1, 13, 1, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-01-22', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-21 17:01:03', '2024-01-21 17:01:03', NULL, NULL),
(62, 1, 2, NULL, 2, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-01-22', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-21 17:01:03', '2024-01-21 17:01:03', NULL, NULL),
(63, 1, 3, NULL, 2, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-01-22', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-21 17:01:03', '2024-01-21 17:01:03', NULL, NULL),
(64, 1, 5, 15, 2, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-01-22', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-21 17:01:03', '2024-01-21 17:01:03', NULL, NULL),
(65, 1, 1, 13, 1, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-01-23', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-22 17:01:02', '2024-01-22 17:01:02', NULL, NULL),
(66, 1, 2, NULL, 2, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-01-23', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-22 17:01:02', '2024-01-22 17:01:02', NULL, NULL),
(67, 1, 3, NULL, 2, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-01-23', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-22 17:01:02', '2024-01-22 17:01:02', NULL, NULL),
(68, 1, 5, 15, 2, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-01-23', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-22 17:01:02', '2024-01-22 17:01:02', NULL, NULL),
(69, 1, 1, 13, 1, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-01-24', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-23 17:01:02', '2024-01-23 17:01:02', NULL, NULL),
(70, 1, 2, NULL, 2, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-01-24', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-23 17:01:02', '2024-01-23 17:01:02', NULL, NULL),
(71, 1, 3, NULL, 2, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-01-24', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-23 17:01:02', '2024-01-23 17:01:02', NULL, NULL),
(72, 1, 5, 15, 2, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-01-24', 'Rabu', '1706113992 72 in base64_selfie_img.png', '23:33:13', '-7.0634224', '110.4152431', NULL, NULL, NULL, NULL, 0, 'masuk', 'hadir', '2024-01-23 17:01:02', '2024-01-24 16:33:13', '{\"data\":{\"error_procentage\":0.30580310706622327,\"match\":true},\"message\":\"Berhasil mendeteksi wajah\",\"success\":true}', NULL),
(73, 1, 1, 13, 1, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-01-25', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-24 17:01:03', '2024-01-24 17:01:03', NULL, NULL),
(74, 1, 2, NULL, 2, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-01-25', 'Kamis', '1706147370 74 in base64_selfie_img.png', '08:49:31', '-6.972972972973', '110.4021721301', '1706152680 74 out base64_selfie_img.png', '10:18:01', '-6.972972972973', '110.4021721301', 88, 'pulang', 'hadir', '2024-01-24 17:01:03', '2024-01-25 03:18:01', '{\"data\":{\"error_procentage\":0.4014397871764025,\"match\":true},\"message\":\"Berhasil mendeteksi wajah\",\"success\":true}', '{\"data\":{\"error_procentage\":0.4297121330496813,\"match\":true},\"message\":\"Berhasil mendeteksi wajah\",\"success\":true}'),
(75, 1, 3, NULL, 2, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-01-25', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-24 17:01:03', '2024-01-24 17:01:03', NULL, NULL),
(76, 1, 5, NULL, 2, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-01-25', 'Kamis', '1706153302 76 in base64_selfie_img.png', '10:28:23', '-6.9807779', '110.4089327', '1706153320 76 out base64_selfie_img.png', '10:28:41', '-6.9807766', '110.4089103', 0, 'pulang', 'hadir', '2024-01-24 17:01:03', '2024-01-25 03:28:41', '{\"data\":{\"error_procentage\":0.33763489249203993,\"match\":true},\"message\":\"Berhasil mendeteksi wajah\",\"success\":true}', '{\"data\":{\"error_procentage\":0.43514955138739553,\"match\":true},\"message\":\"Berhasil mendeteksi wajah\",\"success\":true}'),
(77, 1, 1, 13, 1, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-01-26', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-25 17:01:02', '2024-01-25 17:01:02', NULL, NULL),
(78, 1, 2, NULL, 2, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-01-26', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-25 17:01:02', '2024-01-25 17:01:02', NULL, NULL),
(79, 1, 3, NULL, 2, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-01-26', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-25 17:01:02', '2024-01-25 17:01:02', NULL, NULL),
(80, 1, 5, NULL, 2, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-01-26', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-25 17:01:02', '2024-01-25 17:01:02', NULL, NULL),
(81, 1, 1, 13, 1, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-01-27', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-26 17:01:03', '2024-01-26 17:01:03', NULL, NULL),
(82, 1, 2, NULL, 2, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-01-27', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-26 17:01:03', '2024-01-26 17:01:03', NULL, NULL),
(83, 1, 3, NULL, 2, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-01-27', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-26 17:01:03', '2024-01-26 17:01:03', NULL, NULL),
(84, 1, 5, NULL, 2, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-01-27', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-26 17:01:03', '2024-01-26 17:01:03', NULL, NULL),
(85, 1, 1, 13, 1, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-01-28', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-27 17:01:02', '2024-01-27 17:01:02', NULL, NULL),
(86, 1, 2, NULL, 2, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-01-28', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-27 17:01:02', '2024-01-27 17:01:02', NULL, NULL),
(87, 1, 3, NULL, 2, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-01-28', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-27 17:01:02', '2024-01-27 17:01:02', NULL, NULL),
(88, 1, 5, NULL, 2, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-01-28', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-27 17:01:02', '2024-01-27 17:01:02', NULL, NULL),
(89, 1, 1, 13, 1, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-01-29', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-28 17:01:02', '2024-01-28 17:01:02', NULL, NULL),
(90, 1, 2, NULL, 2, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-01-29', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-28 17:01:02', '2024-01-28 17:01:02', NULL, NULL),
(91, 1, 3, NULL, 2, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-01-29', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-28 17:01:02', '2024-01-28 17:01:02', NULL, NULL),
(92, 1, 5, NULL, 2, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-01-29', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-28 17:01:02', '2024-01-28 17:01:02', NULL, NULL),
(93, 1, 1, 13, 1, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-01-30', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-29 17:01:02', '2024-01-29 17:01:02', NULL, NULL),
(94, 1, 2, NULL, 2, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-01-30', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-29 17:01:02', '2024-01-29 17:01:02', NULL, NULL),
(95, 1, 3, NULL, 2, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-01-30', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-29 17:01:02', '2024-01-29 17:01:02', NULL, NULL),
(96, 1, 5, NULL, 2, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-01-30', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-29 17:01:02', '2024-01-29 17:01:02', NULL, NULL),
(97, 1, 1, 13, 1, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-01-31', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-30 17:01:02', '2024-01-30 17:01:02', NULL, NULL),
(98, 1, 2, NULL, 2, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-01-31', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-30 17:01:02', '2024-01-30 17:01:02', NULL, NULL),
(99, 1, 3, NULL, 2, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-01-31', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-30 17:01:02', '2024-01-30 17:01:02', NULL, NULL),
(100, 1, 5, NULL, 2, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-01-31', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-30 17:01:02', '2024-01-30 17:01:02', NULL, NULL),
(101, 1, 1, 13, 1, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-02-01', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-31 17:01:02', '2024-01-31 17:01:02', NULL, NULL),
(102, 1, 2, NULL, 2, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-02-01', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-31 17:01:02', '2024-01-31 17:01:02', NULL, NULL),
(103, 1, 3, NULL, 2, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-02-01', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-31 17:01:02', '2024-01-31 17:01:02', NULL, NULL),
(104, 1, 5, NULL, 2, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-02-01', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-01-31 17:01:02', '2024-01-31 17:01:02', NULL, NULL),
(105, 1, 1, 13, 1, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-02-02', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-01 17:01:02', '2024-02-01 17:01:02', NULL, NULL),
(106, 1, 2, NULL, 2, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-02-02', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-01 17:01:02', '2024-02-01 17:01:02', NULL, NULL),
(107, 1, 3, NULL, 2, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-02-02', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-01 17:01:02', '2024-02-01 17:01:02', NULL, NULL),
(108, 1, 5, NULL, 2, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-02-02', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-01 17:01:02', '2024-02-01 17:01:02', NULL, NULL),
(109, 1, 1, 13, 1, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-02-03', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-02 17:01:03', '2024-02-02 17:01:03', NULL, NULL),
(110, 1, 2, NULL, 2, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-02-03', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-02 17:01:03', '2024-02-02 17:01:03', NULL, NULL),
(111, 1, 3, NULL, 2, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-02-03', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-02 17:01:03', '2024-02-02 17:01:03', NULL, NULL),
(112, 1, 5, NULL, 2, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-02-03', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-02 17:01:03', '2024-02-02 17:01:03', NULL, NULL),
(113, 1, 1, 13, 1, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-02-04', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-03 17:01:02', '2024-02-03 17:01:02', NULL, NULL),
(114, 1, 2, NULL, 2, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-02-04', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-03 17:01:02', '2024-02-03 17:01:02', NULL, NULL),
(115, 1, 3, NULL, 2, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-02-04', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-03 17:01:02', '2024-02-03 17:01:02', NULL, NULL),
(116, 1, 5, NULL, 2, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-02-04', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-03 17:01:02', '2024-02-03 17:01:02', NULL, NULL),
(117, 1, 1, 13, 1, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-02-05', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-04 17:01:02', '2024-02-04 17:01:02', NULL, NULL),
(118, 1, 2, NULL, 2, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-02-05', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-04 17:01:02', '2024-02-04 17:01:02', NULL, NULL),
(119, 1, 3, NULL, 2, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-02-05', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-04 17:01:02', '2024-02-04 17:01:02', NULL, NULL),
(120, 1, 5, NULL, 2, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-02-05', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-04 17:01:02', '2024-02-04 17:01:02', NULL, NULL),
(121, 1, 1, 13, 1, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-02-06', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-05 17:01:02', '2024-02-05 17:01:02', NULL, NULL),
(122, 1, 2, NULL, 2, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-02-06', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-05 17:01:02', '2024-02-05 17:01:02', NULL, NULL),
(123, 1, 3, NULL, 2, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-02-06', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-05 17:01:02', '2024-02-05 17:01:02', NULL, NULL),
(124, 1, 5, NULL, 2, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-02-06', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-05 17:01:02', '2024-02-05 17:01:02', NULL, NULL),
(125, 1, 1, 13, 1, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-02-07', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-06 17:01:02', '2024-02-06 17:01:02', NULL, NULL),
(126, 1, 2, NULL, 2, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-02-07', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-06 17:01:02', '2024-02-06 17:01:02', NULL, NULL),
(127, 1, 3, NULL, 2, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-02-07', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-06 17:01:02', '2024-02-06 17:01:02', NULL, NULL),
(128, 1, 5, NULL, 2, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-02-07', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-06 17:01:02', '2024-02-06 17:01:02', NULL, NULL),
(129, 1, 1, 13, 1, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-02-08', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-07 17:01:03', '2024-02-07 17:01:03', NULL, NULL),
(130, 1, 2, NULL, 2, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-02-08', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-07 17:01:03', '2024-02-07 17:01:03', NULL, NULL),
(131, 1, 3, NULL, 2, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-02-08', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-07 17:01:03', '2024-02-07 17:01:03', NULL, NULL),
(132, 1, 5, NULL, 2, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-02-08', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-07 17:01:03', '2024-02-07 17:01:03', NULL, NULL),
(133, 1, 1, 13, 1, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-02-09', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-08 17:01:03', '2024-02-08 17:01:03', NULL, NULL),
(134, 1, 2, NULL, 2, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-02-09', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-08 17:01:03', '2024-02-08 17:01:03', NULL, NULL),
(135, 1, 3, NULL, 2, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-02-09', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-08 17:01:03', '2024-02-08 17:01:03', NULL, NULL),
(136, 1, 5, NULL, 2, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-02-09', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-08 17:01:03', '2024-02-08 17:01:03', NULL, NULL),
(137, 1, 1, 13, 1, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-02-10', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-09 17:01:02', '2024-02-09 17:01:02', NULL, NULL),
(138, 1, 2, NULL, 2, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-02-10', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-09 17:01:02', '2024-02-09 17:01:02', NULL, NULL),
(139, 1, 3, NULL, 2, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-02-10', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-09 17:01:02', '2024-02-09 17:01:02', NULL, NULL),
(140, 1, 5, NULL, 2, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-02-10', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-09 17:01:02', '2024-02-09 17:01:02', NULL, NULL),
(141, 1, 1, 13, 1, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-02-11', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-10 17:01:02', '2024-02-10 17:01:02', NULL, NULL),
(142, 1, 2, NULL, 2, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-02-11', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-10 17:01:02', '2024-02-10 17:01:02', NULL, NULL),
(143, 1, 3, NULL, 2, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-02-11', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-10 17:01:02', '2024-02-10 17:01:02', NULL, NULL),
(144, 1, 5, NULL, 2, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-02-11', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-10 17:01:02', '2024-02-10 17:01:02', NULL, NULL),
(145, 1, 1, 13, 1, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-02-12', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-11 17:01:02', '2024-02-11 17:01:02', NULL, NULL),
(146, 1, 2, NULL, 2, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-02-12', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-11 17:01:02', '2024-02-11 17:01:02', NULL, NULL),
(147, 1, 3, NULL, 2, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-02-12', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-11 17:01:02', '2024-02-11 17:01:02', NULL, NULL),
(148, 1, 5, NULL, 2, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-02-12', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-11 17:01:02', '2024-02-11 17:01:02', NULL, NULL),
(149, 1, 1, 13, 1, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-02-13', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-12 17:01:02', '2024-02-12 17:01:02', NULL, NULL),
(150, 1, 2, NULL, 2, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-02-13', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-12 17:01:02', '2024-02-12 17:01:02', NULL, NULL),
(151, 1, 3, NULL, 2, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-02-13', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-12 17:01:02', '2024-02-12 17:01:02', NULL, NULL),
(152, 1, 5, NULL, 2, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-02-13', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-12 17:01:02', '2024-02-12 17:01:02', NULL, NULL),
(153, 1, 1, 13, 1, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-02-27', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-26 17:01:02', '2024-02-26 17:01:02', NULL, NULL),
(154, 1, 2, NULL, 2, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-02-27', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-26 17:01:02', '2024-02-26 17:01:02', NULL, NULL),
(155, 1, 3, NULL, 2, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-02-27', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-26 17:01:02', '2024-02-26 17:01:02', NULL, NULL),
(156, 1, 5, NULL, 2, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-02-27', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-26 17:01:02', '2024-02-26 17:01:02', NULL, NULL),
(157, 1, 1, 13, 1, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-02-28', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-27 17:01:02', '2024-02-27 17:01:02', NULL, NULL),
(158, 1, 2, NULL, 2, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-02-28', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-27 17:01:02', '2024-02-27 17:01:02', NULL, NULL),
(159, 1, 3, NULL, 2, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-02-28', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-27 17:01:02', '2024-02-27 17:01:02', NULL, NULL),
(160, 1, 5, NULL, 2, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-02-28', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-27 17:01:02', '2024-02-27 17:01:02', NULL, NULL),
(161, 1, 1, 13, 1, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-02-29', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-28 17:01:02', '2024-02-28 17:01:02', NULL, NULL),
(162, 1, 2, NULL, 2, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-02-29', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-28 17:01:02', '2024-02-28 17:01:02', NULL, NULL),
(163, 1, 3, NULL, 2, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-02-29', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-28 17:01:02', '2024-02-28 17:01:02', NULL, NULL),
(164, 1, 5, NULL, 2, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-02-29', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-28 17:01:02', '2024-02-28 17:01:02', NULL, NULL),
(165, 1, 1, 13, 1, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-03-01', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-29 17:01:02', '2024-02-29 17:01:02', NULL, NULL),
(166, 1, 2, NULL, 2, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-03-01', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-29 17:01:02', '2024-02-29 17:01:02', NULL, NULL),
(167, 1, 3, NULL, 2, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-03-01', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-29 17:01:02', '2024-02-29 17:01:02', NULL, NULL),
(168, 1, 5, NULL, 2, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-03-01', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-02-29 17:01:02', '2024-02-29 17:01:02', NULL, NULL),
(169, 1, 1, 13, 1, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-03-02', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-01 17:01:02', '2024-03-01 17:01:02', NULL, NULL),
(170, 1, 2, NULL, 2, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-03-02', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-01 17:01:02', '2024-03-01 17:01:02', NULL, NULL),
(171, 1, 3, NULL, 2, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-03-02', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-01 17:01:02', '2024-03-01 17:01:02', NULL, NULL),
(172, 1, 5, NULL, 2, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-03-02', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-01 17:01:02', '2024-03-01 17:01:02', NULL, NULL),
(173, 1, 1, 13, 1, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-03-03', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-02 17:01:02', '2024-03-02 17:01:02', NULL, NULL),
(174, 1, 2, NULL, 2, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-03-03', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-02 17:01:02', '2024-03-02 17:01:02', NULL, NULL),
(175, 1, 3, NULL, 2, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-03-03', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-02 17:01:02', '2024-03-02 17:01:02', NULL, NULL),
(176, 1, 5, NULL, 2, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-03-03', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-02 17:01:02', '2024-03-02 17:01:02', NULL, NULL),
(177, 1, 1, 13, 1, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-03-04', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-03 17:01:02', '2024-03-03 17:01:02', NULL, NULL),
(178, 1, 2, NULL, 2, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-03-04', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-03 17:01:02', '2024-03-03 17:01:02', NULL, NULL),
(179, 1, 3, NULL, 2, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-03-04', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-03 17:01:02', '2024-03-03 17:01:02', NULL, NULL),
(180, 1, 5, NULL, 2, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-03-04', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-03 17:01:02', '2024-03-03 17:01:02', NULL, NULL),
(181, 1, 1, 13, 1, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-03-05', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-04 17:01:02', '2024-03-04 17:01:02', NULL, NULL),
(182, 1, 2, NULL, 2, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-03-05', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-04 17:01:02', '2024-03-04 17:01:02', NULL, NULL),
(183, 1, 3, NULL, 2, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-03-05', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-04 17:01:02', '2024-03-04 17:01:02', NULL, NULL),
(184, 1, 5, NULL, 2, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-03-05', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-04 17:01:02', '2024-03-04 17:01:02', NULL, NULL),
(185, 1, 1, 13, 1, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-03-06', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-05 17:01:02', '2024-03-05 17:01:02', NULL, NULL),
(186, 1, 2, NULL, 2, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-03-06', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-05 17:01:02', '2024-03-05 17:01:02', NULL, NULL),
(187, 1, 3, NULL, 2, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-03-06', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-05 17:01:02', '2024-03-05 17:01:02', NULL, NULL),
(188, 1, 5, NULL, 2, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-03-06', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-05 17:01:02', '2024-03-05 17:01:02', NULL, NULL),
(189, 1, 1, 13, 1, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-03-07', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-06 17:01:02', '2024-03-06 17:01:02', NULL, NULL),
(190, 1, 2, NULL, 2, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-03-07', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-06 17:01:02', '2024-03-06 17:01:02', NULL, NULL),
(191, 1, 3, NULL, 2, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-03-07', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-06 17:01:02', '2024-03-06 17:01:02', NULL, NULL),
(192, 1, 5, NULL, 2, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-03-07', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-06 17:01:02', '2024-03-06 17:01:02', NULL, NULL),
(193, 1, 1, 13, 1, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-03-08', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-07 17:01:02', '2024-03-07 17:01:02', NULL, NULL),
(194, 1, 2, NULL, 2, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-03-08', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-07 17:01:02', '2024-03-07 17:01:02', NULL, NULL),
(195, 1, 3, NULL, 2, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-03-08', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-07 17:01:02', '2024-03-07 17:01:02', NULL, NULL),
(196, 1, 5, NULL, 2, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-03-08', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-07 17:01:02', '2024-03-07 17:01:02', NULL, NULL),
(197, 1, 1, 13, 1, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-03-09', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-08 17:01:02', '2024-03-08 17:01:02', NULL, NULL),
(198, 1, 2, NULL, 2, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-03-09', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-08 17:01:02', '2024-03-08 17:01:02', NULL, NULL),
(199, 1, 3, NULL, 2, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-03-09', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-08 17:01:02', '2024-03-08 17:01:02', NULL, NULL),
(200, 1, 5, NULL, 2, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-03-09', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-08 17:01:02', '2024-03-08 17:01:02', NULL, NULL),
(201, 1, 1, 13, 1, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-03-10', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-09 17:01:02', '2024-03-09 17:01:02', NULL, NULL),
(202, 1, 2, NULL, 2, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-03-10', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-09 17:01:02', '2024-03-09 17:01:02', NULL, NULL),
(203, 1, 3, NULL, 2, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-03-10', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-09 17:01:02', '2024-03-09 17:01:02', NULL, NULL),
(204, 1, 5, NULL, 2, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-03-10', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-09 17:01:02', '2024-03-09 17:01:02', NULL, NULL),
(205, 1, 1, 13, 1, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-03-11', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-10 17:01:02', '2024-03-10 17:01:02', NULL, NULL),
(206, 1, 2, NULL, 2, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-03-11', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-10 17:01:02', '2024-03-10 17:01:02', NULL, NULL),
(207, 1, 3, NULL, 2, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-03-11', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-10 17:01:02', '2024-03-10 17:01:02', NULL, NULL),
(208, 1, 5, NULL, 2, 5, 8, 'Senin', '09:00:00', '15:00:00', 360, '2024-03-11', 'Senin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-10 17:01:02', '2024-03-10 17:01:02', NULL, NULL),
(209, 1, 1, 13, 1, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-03-12', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-11 17:01:02', '2024-03-11 17:01:02', NULL, NULL),
(210, 1, 2, NULL, 2, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-03-12', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-11 17:01:02', '2024-03-11 17:01:02', NULL, NULL),
(211, 1, 3, NULL, 2, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-03-12', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-11 17:01:02', '2024-03-11 17:01:02', NULL, NULL),
(212, 1, 5, NULL, 2, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-03-12', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-11 17:01:02', '2024-03-11 17:01:02', NULL, NULL),
(213, 1, 1, 13, 1, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-03-13', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-12 17:01:02', '2024-03-12 17:01:02', NULL, NULL),
(214, 1, 2, NULL, 2, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-03-13', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-12 17:01:02', '2024-03-12 17:01:02', NULL, NULL),
(215, 1, 3, NULL, 2, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-03-13', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-12 17:01:02', '2024-03-12 17:01:02', NULL, NULL),
(216, 1, 5, NULL, 2, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-03-13', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-12 17:01:02', '2024-03-12 17:01:02', NULL, NULL),
(217, 1, 1, 13, 1, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-03-14', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-13 17:01:02', '2024-03-13 17:01:02', NULL, NULL),
(218, 1, 2, NULL, 2, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-03-14', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-13 17:01:02', '2024-03-13 17:01:02', NULL, NULL);
INSERT INTO `presence_dailies` (`id`, `school_id`, `school_user_id`, `presence_location_id`, `service_id`, `school_shift_id`, `school_shift_hour_id`, `day`, `actual_hour_in`, `actual_hour_out`, `actual_duration`, `presence_date`, `presence_day`, `attachment_in`, `hour_in`, `lat_in`, `long_in`, `attachment_out`, `hour_out`, `lat_out`, `long_out`, `duration`, `state`, `status`, `created_at`, `updated_at`, `face_match_in_response`, `face_match_out_response`) VALUES
(219, 1, 3, NULL, 2, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-03-14', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-13 17:01:02', '2024-03-13 17:01:02', NULL, NULL),
(220, 1, 5, NULL, 2, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-03-14', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-13 17:01:02', '2024-03-13 17:01:02', NULL, NULL),
(221, 1, 1, 13, 1, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-03-15', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-14 17:01:02', '2024-03-14 17:01:02', NULL, NULL),
(222, 1, 2, NULL, 2, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-03-15', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-14 17:01:02', '2024-03-14 17:01:02', NULL, NULL),
(223, 1, 3, NULL, 2, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-03-15', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-14 17:01:02', '2024-03-14 17:01:02', NULL, NULL),
(224, 1, 5, NULL, 2, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-03-15', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-14 17:01:02', '2024-03-14 17:01:02', NULL, NULL),
(225, 1, 1, 13, 1, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-03-16', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-15 17:01:02', '2024-03-15 17:01:02', NULL, NULL),
(226, 1, 2, NULL, 2, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-03-16', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-15 17:01:02', '2024-03-15 17:01:02', NULL, NULL),
(227, 1, 3, NULL, 2, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-03-16', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-15 17:01:02', '2024-03-15 17:01:02', NULL, NULL),
(228, 1, 5, NULL, 2, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-03-16', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-15 17:01:02', '2024-03-15 17:01:02', NULL, NULL),
(229, 1, 1, 13, 1, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-03-17', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-16 17:01:02', '2024-03-16 17:01:02', NULL, NULL),
(230, 1, 2, NULL, 2, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-03-17', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-16 17:01:02', '2024-03-16 17:01:02', NULL, NULL),
(231, 1, 3, NULL, 2, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-03-17', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-16 17:01:02', '2024-03-16 17:01:02', NULL, NULL),
(232, 1, 5, NULL, 2, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-03-17', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-16 17:01:02', '2024-03-16 17:01:02', NULL, NULL),
(233, 1, 1, 13, 1, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-03-19', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-18 17:01:02', '2024-03-18 17:01:02', NULL, NULL),
(234, 1, 2, NULL, 2, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-03-19', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-18 17:01:02', '2024-03-18 17:01:02', NULL, NULL),
(235, 1, 3, NULL, 2, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-03-19', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-18 17:01:02', '2024-03-18 17:01:02', NULL, NULL),
(236, 1, 5, NULL, 2, 5, 9, 'Selasa', '05:00:00', '20:00:00', 900, '2024-03-19', 'Selasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-18 17:01:02', '2024-03-18 17:01:02', NULL, NULL),
(237, 1, 1, 13, 1, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-03-20', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-19 17:01:03', '2024-03-19 17:01:03', NULL, NULL),
(238, 1, 2, NULL, 2, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-03-20', 'Rabu', '1710905744 238 in base64_selfie_img.png', '10:35:47', '-7.0630630630631', '110.40538835406', '1710908016 238 out base64_selfie_img.png', '11:13:38', '-7.0630630630631', '110.40538835406', 37, 'pulang', 'hadir', '2024-03-19 17:01:03', '2024-03-20 04:13:38', '{\"data\":{\"error_procentage\":0.4759975214760512,\"match\":true},\"message\":\"Berhasil mendeteksi wajah\",\"success\":true}', '{\"data\":{\"error_procentage\":0.34578410316371144,\"match\":true},\"message\":\"Berhasil mendeteksi wajah\",\"success\":true}'),
(239, 1, 3, NULL, 2, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-03-20', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-19 17:01:03', '2024-03-19 17:01:03', NULL, NULL),
(240, 1, 5, NULL, 2, 5, 10, 'Rabu', '08:00:00', '16:00:00', 480, '2024-03-20', 'Rabu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-19 17:01:03', '2024-03-19 17:01:03', NULL, NULL),
(241, 1, 1, 13, 1, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-03-21', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-20 17:01:02', '2024-03-20 17:01:02', NULL, NULL),
(242, 1, 2, NULL, 2, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-03-21', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-20 17:01:02', '2024-03-20 17:01:02', NULL, NULL),
(243, 1, 3, NULL, 2, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-03-21', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-20 17:01:02', '2024-03-20 17:01:02', NULL, NULL),
(244, 1, 5, NULL, 2, 5, 11, 'Kamis', '11:00:00', '15:00:00', 240, '2024-03-21', 'Kamis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-20 17:01:02', '2024-03-20 17:01:02', NULL, NULL),
(245, 1, 1, 13, 1, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-03-22', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-21 17:01:02', '2024-03-21 17:01:02', NULL, NULL),
(246, 1, 2, NULL, 2, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-03-22', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-21 17:01:02', '2024-03-21 17:01:02', NULL, NULL),
(247, 1, 3, NULL, 2, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-03-22', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-21 17:01:02', '2024-03-21 17:01:02', NULL, NULL),
(248, 1, 5, NULL, 2, 5, 12, 'Jumat', '07:00:00', '12:00:00', 300, '2024-03-22', 'Jumat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-21 17:01:02', '2024-03-21 17:01:02', NULL, NULL),
(249, 1, 1, 13, 1, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-03-23', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-22 17:01:02', '2024-03-22 17:01:02', NULL, NULL),
(250, 1, 2, NULL, 2, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-03-23', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-22 17:01:02', '2024-03-22 17:01:02', NULL, NULL),
(251, 1, 3, NULL, 2, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-03-23', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-22 17:01:02', '2024-03-22 17:01:02', NULL, NULL),
(252, 1, 5, NULL, 2, 5, 13, 'Sabtu', '07:00:00', '15:00:00', 480, '2024-03-23', 'Sabtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-22 17:01:03', '2024-03-22 17:01:03', NULL, NULL),
(253, 1, 1, 13, 1, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-03-24', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-23 17:01:02', '2024-03-23 17:01:02', NULL, NULL),
(254, 1, 2, NULL, 2, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-03-24', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-23 17:01:02', '2024-03-23 17:01:02', NULL, NULL),
(255, 1, 3, NULL, 2, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-03-24', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-23 17:01:02', '2024-03-23 17:01:02', NULL, NULL),
(256, 1, 5, NULL, 2, 5, 14, 'Minggu', '07:00:00', '12:00:00', 300, '2024-03-24', 'Minggu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tidak diketahui', 'mangkir', '2024-03-23 17:01:02', '2024-03-23 17:01:02', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `presence_logs`
--

CREATE TABLE `presence_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_user_id` bigint(20) UNSIGNED NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `ref_table` varchar(255) NOT NULL,
  `ref_id` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'Super Admin', NULL, NULL),
(2, 'school_manager', 'Pengelola Sekolah', NULL, NULL),
(3, 'user', 'Pengguna', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `active_billing_id` bigint(20) DEFAULT NULL,
  `school_level` varchar(255) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `school_address` varchar(255) NOT NULL,
  `pic_name` varchar(255) NOT NULL,
  `register_ref_code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pic_address` varchar(255) NOT NULL,
  `pic_phone_number` varchar(255) NOT NULL,
  `pic_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `active_billing_id`, `school_level`, `school_name`, `school_address`, `pic_name`, `register_ref_code`, `created_at`, `updated_at`, `pic_address`, `pic_phone_number`, `pic_email`) VALUES
(1, 4, 'SMK', 'SMK Wikrama 1 Jepara', 'Jl. Kelet Ploso KM 36, Kelet, Keling, Karang Anyar, Kelet', 'Joko', 'XXXX', NULL, '2024-03-17 19:32:29', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `school_billings`
--

CREATE TABLE `school_billings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `price` double NOT NULL,
  `billing_code` varchar(255) DEFAULT NULL,
  `payment_duration` int(11) NOT NULL DEFAULT 1 COMMENT '1 bulan - 3 bulan - 6 bulan',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('pending','paid','expired','suspend') NOT NULL,
  `issue_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `merchant_ref` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_billings`
--

INSERT INTO `school_billings` (`id`, `school_id`, `package_id`, `price`, `billing_code`, `payment_duration`, `start_date`, `end_date`, `status`, `issue_date`, `due_date`, `created_at`, `updated_at`, `merchant_ref`) VALUES
(1, 1, 1, 0, 'BC00010911226', 1, '2023-12-26', '2024-01-26', 'paid', '2023-12-26', '2024-01-02', '2023-12-25 21:59:46', '2023-12-25 21:59:46', NULL),
(2, 1, 2, 300000, 'BC00020920317', 1, '2024-03-17', '2024-04-17', 'pending', '2024-03-17', '2024-03-24', '2024-03-17 08:50:41', '2024-03-17 08:50:41', 'INV-11710665440'),
(3, 1, 2, 300000, 'BC00030920317', 1, '2024-03-17', '2024-04-17', 'paid', '2024-03-17', '2024-03-24', '2024-03-17 09:11:17', '2024-03-17 10:47:46', 'INV-11710666677'),
(4, 1, 2, 300000, 'BC00040920318', 1, '2024-03-18', '2024-04-18', 'paid', '2024-03-18', '2024-03-25', '2024-03-17 19:31:48', '2024-03-17 19:32:29', 'INV-11710703907');

-- --------------------------------------------------------

--
-- Table structure for table `school_billing_quotas`
--

CREATE TABLE `school_billing_quotas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_billing_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `service_code` varchar(255) NOT NULL,
  `user_count` int(11) NOT NULL,
  `limit_quota` int(11) NOT NULL,
  `used_quota` int(11) NOT NULL,
  `remaining_quota` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_billing_quotas`
--

INSERT INTO `school_billing_quotas` (`id`, `school_billing_id`, `package_id`, `service_id`, `service_code`, `user_count`, `limit_quota`, `used_quota`, `remaining_quota`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'PRS-FCN', 300, 18000, 17, 17989, NULL, '2024-01-20 19:22:19'),
(2, 1, 1, 2, 'PRS-BRC', 300, 18000, 42, 17958, NULL, '2024-01-25 03:28:41'),
(3, 2, 2, 1, 'PRS-FCN', 100, 6000, 0, 6000, NULL, NULL),
(4, 2, 2, 2, 'PRS-BRC', 100, 6000, 0, 6000, NULL, NULL),
(5, 3, 2, 1, 'PRS-FCN', 100, 6000, 0, 6000, NULL, NULL),
(6, 3, 2, 2, 'PRS-BRC', 100, 6000, 0, 6000, NULL, NULL),
(7, 4, 2, 1, 'PRS-FCN', 100, 6000, 0, 6000, NULL, NULL),
(8, 4, 2, 2, 'PRS-BRC', 100, 6000, 3, 5997, NULL, '2024-03-20 04:13:38');

-- --------------------------------------------------------

--
-- Table structure for table `school_billing_quota_transactions`
--

CREATE TABLE `school_billing_quota_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `school_billing_id` bigint(20) UNSIGNED NOT NULL,
  `school_billing_quota_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `school_user_id` bigint(20) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `ref_table` varchar(255) NOT NULL,
  `ref_id` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_billing_quota_transactions`
--

INSERT INTO `school_billing_quota_transactions` (`id`, `school_id`, `school_billing_id`, `school_billing_quota_id`, `service_id`, `school_user_id`, `datetime`, `ref_table`, `ref_id`, `type`, `created_at`, `updated_at`) VALUES
(5, 1, 1, 1, 1, 1, '2024-01-07 03:19:09', 'presence_dailies', '6', 'in', '2024-01-06 20:19:17', '2024-01-06 20:19:17'),
(6, 1, 1, 1, 1, 1, '2024-01-07 03:20:30', 'presence_dailies', '6', 'out', '2024-01-06 20:20:32', '2024-01-06 20:20:32'),
(7, 1, 1, 1, 1, 1, '2024-01-09 22:06:45', 'presence_dailies', '17', 'in', '2024-01-09 15:06:46', '2024-01-09 15:06:46'),
(8, 1, 1, 1, 1, 1, '2024-01-09 22:07:50', 'presence_dailies', '17', 'out', '2024-01-09 15:07:51', '2024-01-09 15:07:51'),
(13, 1, 1, 1, 1, 1, '2024-01-10 13:46:39', 'presence_dailies', '19', 'in', '2024-01-10 06:46:40', '2024-01-10 06:46:40'),
(14, 1, 1, 2, 2, 2, '2024-01-10 13:48:00', 'presence_barcode_school_users', '2', 'in', '2024-01-10 06:48:00', '2024-01-10 06:48:00'),
(15, 1, 1, 2, 2, 2, '2024-01-10 13:48:20', 'presence_barcode_school_users', '3', 'in', '2024-01-10 06:48:20', '2024-01-10 06:48:20'),
(16, 1, 1, 2, 2, 2, '2024-01-10 13:57:43', 'presence_dailies', '20', 'in', '2024-01-10 06:57:44', '2024-01-10 06:57:44'),
(17, 1, 1, 2, 2, 2, '2024-01-15 14:19:16', 'presence_barcode_school_users', '3', 'out', '2024-01-15 07:19:16', '2024-01-15 07:19:16'),
(18, 1, 1, 2, 2, 2, '2024-01-15 15:24:09', 'presence_barcode_school_users', '4', 'in', '2024-01-15 08:24:09', '2024-01-15 08:24:09'),
(19, 1, 1, 2, 2, 2, '2024-01-15 15:24:21', 'presence_barcode_school_users', '2', 'out', '2024-01-15 08:24:21', '2024-01-15 08:24:21'),
(20, 1, 1, 2, 2, 2, '2024-01-15 15:27:15', 'presence_barcode_school_users', '7', 'in', '2024-01-15 08:27:15', '2024-01-15 08:27:15'),
(21, 1, 1, 2, 2, 2, '2024-01-15 15:43:28', 'presence_barcode_school_users', '7', 'out', '2024-01-15 08:43:28', '2024-01-15 08:43:28'),
(22, 1, 1, 2, 2, 2, '2024-01-15 15:44:43', 'presence_barcode_school_users', '9', 'in', '2024-01-15 08:44:43', '2024-01-15 08:44:43'),
(23, 1, 1, 2, 2, 2, '2024-01-15 15:44:56', 'presence_barcode_school_users', '9', 'out', '2024-01-15 08:44:56', '2024-01-15 08:44:56'),
(24, 1, 1, 2, 2, 5, '2024-01-15 22:31:38', 'presence_dailies', '36', 'in', '2024-01-15 15:31:40', '2024-01-15 15:31:40'),
(25, 1, 1, 2, 2, 5, '2024-01-15 22:32:10', 'presence_dailies', '36', 'out', '2024-01-15 15:32:12', '2024-01-15 15:32:12'),
(26, 1, 1, 2, 2, 5, '2024-01-15 23:17:22', 'presence_dailies', '36', 'in', '2024-01-15 16:17:24', '2024-01-15 16:17:24'),
(27, 1, 1, 2, 2, 5, '2024-01-15 23:17:58', 'presence_dailies', '36', 'out', '2024-01-15 16:17:59', '2024-01-15 16:17:59'),
(28, 1, 1, 2, 2, 5, '2024-01-15 23:33:26', 'presence_barcode_school_users', '13', 'in', '2024-01-15 16:33:26', '2024-01-15 16:33:26'),
(29, 1, 1, 2, 2, 5, '2024-01-15 23:33:39', 'presence_barcode_school_users', '13', 'out', '2024-01-15 16:33:39', '2024-01-15 16:33:39'),
(30, 1, 1, 2, 2, 5, '2024-01-15 23:49:48', 'presence_barcode_school_users', '16', 'in', '2024-01-15 16:49:48', '2024-01-15 16:49:48'),
(31, 1, 1, 2, 2, 5, '2024-01-15 23:49:55', 'presence_barcode_school_users', '16', 'out', '2024-01-15 16:49:55', '2024-01-15 16:49:55'),
(32, 1, 1, 2, 2, 5, '2024-01-16 01:05:34', 'presence_dailies', '40', 'in', '2024-01-15 18:05:36', '2024-01-15 18:05:36'),
(33, 1, 1, 2, 2, 5, '2024-01-16 01:05:50', 'presence_dailies', '40', 'out', '2024-01-15 18:05:51', '2024-01-15 18:05:51'),
(34, 1, 1, 2, 2, 5, '2024-01-16 01:10:10', 'presence_barcode_school_users', '19', 'in', '2024-01-15 18:10:10', '2024-01-15 18:10:10'),
(35, 1, 1, 2, 2, 5, '2024-01-16 01:12:07', 'presence_barcode_school_users', '22', 'in', '2024-01-15 18:12:07', '2024-01-15 18:12:07'),
(36, 1, 1, 2, 2, 5, '2024-01-16 01:12:30', 'presence_barcode_school_users', '22', 'out', '2024-01-15 18:12:30', '2024-01-15 18:12:30'),
(38, 1, 1, 1, 1, 1, '2024-01-21 02:21:36', 'presence_dailies', '57', 'in', '2024-01-20 19:21:38', '2024-01-20 19:21:38'),
(39, 1, 1, 1, 1, 1, '2024-01-21 02:22:17', 'presence_dailies', '57', 'out', '2024-01-20 19:22:19', '2024-01-20 19:22:19'),
(40, 1, 1, 2, 2, 2, '2024-01-21 02:24:01', 'presence_barcode_school_users', '23', 'in', '2024-01-20 19:24:01', '2024-01-20 19:24:01'),
(41, 1, 1, 2, 2, 2, '2024-01-21 02:24:23', 'presence_barcode_school_users', '23', 'out', '2024-01-20 19:24:23', '2024-01-20 19:24:23'),
(42, 1, 1, 2, 2, 5, '2024-01-24 17:08:28', 'presence_barcode_school_users', '25', 'in', '2024-01-24 10:08:28', '2024-01-24 10:08:28'),
(43, 1, 1, 2, 2, 5, '2024-01-24 17:08:39', 'presence_barcode_school_users', '25', 'out', '2024-01-24 10:08:39', '2024-01-24 10:08:39'),
(44, 1, 1, 2, 2, 5, '2024-01-24 17:09:46', 'presence_barcode_school_users', '28', 'in', '2024-01-24 10:09:46', '2024-01-24 10:09:46'),
(45, 1, 1, 2, 2, 5, '2024-01-24 17:09:52', 'presence_barcode_school_users', '28', 'out', '2024-01-24 10:09:52', '2024-01-24 10:09:52'),
(46, 1, 1, 2, 2, 5, '2024-01-24 17:11:33', 'presence_barcode_school_users', '31', 'in', '2024-01-24 10:11:33', '2024-01-24 10:11:33'),
(47, 1, 1, 2, 2, 5, '2024-01-24 17:11:37', 'presence_barcode_school_users', '31', 'out', '2024-01-24 10:11:37', '2024-01-24 10:11:37'),
(48, 1, 1, 2, 2, 5, '2024-01-24 17:53:02', 'presence_dailies', '72', 'in', '2024-01-24 10:53:03', '2024-01-24 10:53:03'),
(49, 1, 1, 2, 2, 5, '2024-01-24 23:33:12', 'presence_dailies', '72', 'in', '2024-01-24 16:33:13', '2024-01-24 16:33:13'),
(50, 1, 1, 2, 2, 5, '2024-01-24 23:33:58', 'presence_barcode_school_users', '34', 'in', '2024-01-24 16:33:58', '2024-01-24 16:33:58'),
(51, 1, 1, 2, 2, 5, '2024-01-24 23:34:55', 'presence_barcode_school_users', '34', 'out', '2024-01-24 16:34:55', '2024-01-24 16:34:55'),
(52, 1, 1, 2, 2, 2, '2024-01-25 08:34:40', 'presence_dailies', '74', 'in', '2024-01-25 01:34:42', '2024-01-25 01:34:42'),
(53, 1, 1, 2, 2, 2, '2024-01-25 08:37:27', 'presence_dailies', '74', 'out', '2024-01-25 01:37:29', '2024-01-25 01:37:29'),
(54, 1, 1, 2, 2, 2, '2024-01-25 08:49:30', 'presence_dailies', '74', 'in', '2024-01-25 01:49:31', '2024-01-25 01:49:31'),
(55, 1, 1, 2, 2, 2, '2024-01-25 10:18:00', 'presence_dailies', '74', 'out', '2024-01-25 03:18:01', '2024-01-25 03:18:01'),
(56, 1, 1, 2, 2, 5, '2024-01-25 10:28:22', 'presence_dailies', '76', 'in', '2024-01-25 03:28:23', '2024-01-25 03:28:23'),
(57, 1, 1, 2, 2, 5, '2024-01-25 10:28:40', 'presence_dailies', '76', 'out', '2024-01-25 03:28:41', '2024-01-25 03:28:41'),
(58, 1, 4, 8, 2, 2, '2024-03-20 10:35:44', 'presence_dailies', '238', 'in', '2024-03-20 03:35:47', '2024-03-20 03:35:47'),
(59, 1, 4, 8, 2, 2, '2024-03-20 11:05:46', 'presence_dailies', '238', 'out', '2024-03-20 04:05:49', '2024-03-20 04:05:49'),
(60, 1, 4, 8, 2, 2, '2024-03-20 11:13:36', 'presence_dailies', '238', 'out', '2024-03-20 04:13:38', '2024-03-20 04:13:38');

-- --------------------------------------------------------

--
-- Table structure for table `school_groups`
--

CREATE TABLE `school_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `group_code` varchar(255) NOT NULL,
  `school_shift_id` bigint(20) UNSIGNED NOT NULL,
  `daily_presence_service_id` bigint(20) UNSIGNED NOT NULL,
  `is_can_create_presence` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_groups`
--

INSERT INTO `school_groups` (`id`, `school_id`, `group_name`, `group_code`, `school_shift_id`, `daily_presence_service_id`, `is_can_create_presence`, `created_at`, `updated_at`) VALUES
(1, 1, 'Guru', 'GR', 5, 1, 1, '2023-12-09 11:40:49', '2023-12-09 11:40:49'),
(2, 1, 'Peserta Didik', 'PD', 5, 1, 0, '2023-12-09 11:49:36', '2024-03-23 19:21:51');

-- --------------------------------------------------------

--
-- Table structure for table `school_group_roles`
--

CREATE TABLE `school_group_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school_locations`
--

CREATE TABLE `school_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `location` text NOT NULL,
  `lat` varchar(255) NOT NULL,
  `long` varchar(255) NOT NULL,
  `radius_distance` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_locations`
--

INSERT INTO `school_locations` (`id`, `school_id`, `title`, `address`, `location`, `lat`, `long`, `radius_distance`, `created_at`, `updated_at`) VALUES
(13, 1, 'Gedung ABC', 'Jl. kemayoran', 'Banyumanik, Semarang City, Central Java 50263, Indonesia', '-7.062907456686763', '110.4134376951127', 99999, '2023-12-09 01:29:47', '2024-01-15 15:29:13'),
(15, 1, 'Gedung B', 'tess', 'Menteng, Central Jakarta City, Jakarta 10310, Indonesia', '-6.1944491', '106.8229198', 999999, '2023-12-09 03:02:27', '2023-12-09 03:02:27'),
(16, 1, 'Udinus', 'Gedung D', 'Semarang Regency, Central Java 50131, Indonesia', '-6.980755320501181', '110.40854534586954', 99999, '2024-01-24 10:40:10', '2024-01-24 16:32:32'),
(17, 1, 'gedeng e', 'jl udinus', 'Semarang Regency, Central Java 50131, Indonesia', '-6.981119045601237', '110.40838218039553', 300, '2024-01-25 03:36:06', '2024-01-25 03:36:06');

-- --------------------------------------------------------

--
-- Table structure for table `school_positions`
--

CREATE TABLE `school_positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `position_code` varchar(255) NOT NULL,
  `position_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_positions`
--

INSERT INTO `school_positions` (`id`, `school_id`, `position_code`, `position_name`, `created_at`, `updated_at`) VALUES
(2, 1, 'Karyawan', 'Karyawan', '2023-12-25 12:50:08', '2023-12-25 12:50:08'),
(3, 1, 'KLS-VII-A', 'Kelas VII/7 A', '2024-01-02 11:43:48', '2024-01-02 11:44:25'),
(4, 1, 'KLS-VIII-A', 'Kelas VIII/8 A', '2024-01-02 11:44:04', '2024-01-02 11:44:39');

-- --------------------------------------------------------

--
-- Table structure for table `school_shifts`
--

CREATE TABLE `school_shifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `shift_name` varchar(255) NOT NULL,
  `time_tolerance` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_shifts`
--

INSERT INTO `school_shifts` (`id`, `school_id`, `shift_name`, `time_tolerance`, `created_at`, `updated_at`) VALUES
(5, 1, 'Reguler', 30, '2023-12-09 10:10:30', '2023-12-09 10:10:30'),
(7, 1, 'Siang', 25, '2023-12-09 11:04:47', '2023-12-09 11:04:47');

-- --------------------------------------------------------

--
-- Table structure for table `school_shift_hours`
--

CREATE TABLE `school_shift_hours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `school_shift_id` bigint(20) UNSIGNED NOT NULL,
  `day` varchar(255) NOT NULL,
  `day_in` int(11) NOT NULL,
  `hour_in` time NOT NULL,
  `hour_out` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_shift_hours`
--

INSERT INTO `school_shift_hours` (`id`, `school_id`, `school_shift_id`, `day`, `day_in`, `hour_in`, `hour_out`, `created_at`, `updated_at`) VALUES
(8, 1, 5, 'Senin', 1, '09:00:00', '15:00:00', NULL, '2023-12-09 10:34:21'),
(9, 1, 5, 'Selasa', 2, '05:00:00', '20:00:00', NULL, '2023-12-09 10:34:21'),
(10, 1, 5, 'Rabu', 3, '08:00:00', '16:00:00', NULL, '2023-12-09 10:34:21'),
(11, 1, 5, 'Kamis', 4, '11:00:00', '15:00:00', NULL, '2023-12-09 10:34:21'),
(12, 1, 5, 'Jumat', 5, '07:00:00', '12:00:00', NULL, '2023-12-09 10:34:21'),
(13, 1, 5, 'Sabtu', 6, '07:00:00', '15:00:00', NULL, '2023-12-09 10:34:21'),
(14, 1, 5, 'Minggu', 7, '07:00:00', '12:00:00', NULL, '2023-12-09 10:34:21'),
(50, 1, 6, 'Senin', 1, '09:00:00', '15:00:00', NULL, NULL),
(51, 1, 6, 'Selasa', 2, '05:00:00', '20:00:00', NULL, NULL),
(52, 1, 6, 'Rabu', 3, '08:00:00', '16:00:00', NULL, NULL),
(53, 1, 6, 'Kamis', 4, '11:00:00', '15:00:00', NULL, NULL),
(54, 1, 6, 'Jumat', 5, '07:00:00', '12:00:00', NULL, NULL),
(55, 1, 6, 'Sabtu', 6, '07:00:00', '15:00:00', NULL, NULL),
(56, 1, 6, 'Minggu', 7, '07:00:00', '12:00:00', NULL, NULL),
(57, 1, 7, 'Senin', 1, '07:00:00', '15:00:00', NULL, NULL),
(58, 1, 7, 'Selasa', 2, '07:00:00', '15:00:00', NULL, NULL),
(59, 1, 7, 'Rabu', 3, '07:00:00', '15:00:00', NULL, NULL),
(60, 1, 7, 'Kamis', 4, '07:00:00', '15:00:00', NULL, NULL),
(61, 1, 7, 'Jumat', 5, '07:00:00', '15:00:00', NULL, NULL),
(62, 1, 7, 'Sabtu', 6, '07:00:00', '15:00:00', NULL, NULL),
(63, 1, 7, 'Minggu', 7, '07:00:00', '15:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `school_users`
--

CREATE TABLE `school_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `student_number` varchar(255) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `school_group_id` bigint(20) UNSIGNED NOT NULL,
  `school_position_id` bigint(20) UNSIGNED NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `selfie_img` varchar(255) DEFAULT NULL,
  `is_all_location_presence` tinyint(1) DEFAULT 0,
  `school_location_id` bigint(20) UNSIGNED DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_users`
--

INSERT INTO `school_users` (`id`, `school_id`, `student_number`, `student_name`, `school_group_id`, `school_position_id`, `gender`, `email`, `phone_number`, `birth_date`, `selfie_img`, `is_all_location_presence`, `school_location_id`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, '11800659', 'William Trijanto Dwi Putra', 1, 2, 'Laki Laki', 'william@gmail.com', '089506373551', '2023-12-26', 'selfie-1703876333.png', 0, 13, '$2y$12$Q5MeMlpwn00be3JYS1gA/.FtP0h3.sgI7BV5hiY4r6o6tt4KgjAWK', '2023-12-25 13:11:04', '2024-03-17 07:24:38'),
(2, 1, '211401056', 'Putri Jaya Usman', 2, 4, 'Perempuan', 'putri@gmail.com', '0895063735511', '2024-01-02', 'selfie-1710905730.png', 1, 13, '$2y$12$iDPLbJIFR1FWIvegC4CtROrjzVa5YzhVcVlZZd0c7C.Rjc7nL0IHu', '2024-01-02 11:45:21', '2024-03-20 03:35:30'),
(3, 1, 'A11.2021.13874', 'Fredyan', 2, 4, 'Laki Laki', 'fred@gmail.com', '089506373551', '2024-01-09', NULL, 1, 13, '$2y$12$.ldUkfCkdy1oWU8gOub0beUQf.eo9MVFdWFSwanq62cVEcrNRkxGC', '2024-01-10 05:26:35', '2024-01-10 05:26:35'),
(5, 1, 'A11.2021.13932', 'Zidni Ilma', 2, 4, 'Laki Laki', 'ziddma@gmail.com', '081225161191', '2000-10-18', 'selfie-1706113554.png', 1, 16, '$2y$12$utS/BZn0lzh9wKmVG2lDT.tAC.LnguLHUiVVCS5jZ6YduYevdamg6', '2024-01-24 16:20:09', '2024-01-24 16:25:54');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `type_service` enum('metode_presence','addon') NOT NULL,
  `type_price` enum('monthly','quota') NOT NULL,
  `plotting_group_role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `code`, `name`, `description`, `price`, `type_service`, `type_price`, `plotting_group_role_id`, `created_at`, `updated_at`) VALUES
(1, 'PRS-FCN', 'Face Recognition', 'Absensi wajah', 2500, 'metode_presence', 'quota', 1, NULL, NULL),
(2, 'PRS-BRC', 'Barcode Scan', 'Barcode Scanner', 0, 'metode_presence', 'quota', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `ref_code` varchar(255) DEFAULT NULL,
  `backoffice_login` tinyint(1) NOT NULL DEFAULT 0,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `device_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `school_id`, `role_id`, `name`, `ref_code`, `backoffice_login`, `email`, `email_verified_at`, `password`, `remember_token`, `device_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Administrator', NULL, 1, 'admin@gmail.com', NULL, '$2y$12$hhYPG4F0V1Bj6eiErgYdzO3fwePw2SKl/W1KmfgAGJWyGtgnfGdXK', NULL, NULL, '2023-12-08 00:35:49', '2023-12-08 00:35:49');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_services`
--
ALTER TABLE `package_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payments_reference_unique` (`reference`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `presence_barcodes`
--
ALTER TABLE `presence_barcodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `presence_barcode_school_users`
--
ALTER TABLE `presence_barcode_school_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `presence_dailies`
--
ALTER TABLE `presence_dailies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `presence_logs`
--
ALTER TABLE `presence_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_billings`
--
ALTER TABLE `school_billings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_billing_quotas`
--
ALTER TABLE `school_billing_quotas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_billing_quota_transactions`
--
ALTER TABLE `school_billing_quota_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_groups`
--
ALTER TABLE `school_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_group_roles`
--
ALTER TABLE `school_group_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_locations`
--
ALTER TABLE `school_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_positions`
--
ALTER TABLE `school_positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_shifts`
--
ALTER TABLE `school_shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_shift_hours`
--
ALTER TABLE `school_shift_hours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_users`
--
ALTER TABLE `school_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `school_users_student_number_unique` (`student_number`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_ref_code_unique` (`ref_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `package_services`
--
ALTER TABLE `package_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `presence_barcodes`
--
ALTER TABLE `presence_barcodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `presence_barcode_school_users`
--
ALTER TABLE `presence_barcode_school_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `presence_dailies`
--
ALTER TABLE `presence_dailies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `presence_logs`
--
ALTER TABLE `presence_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `school_billings`
--
ALTER TABLE `school_billings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `school_billing_quotas`
--
ALTER TABLE `school_billing_quotas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `school_billing_quota_transactions`
--
ALTER TABLE `school_billing_quota_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `school_groups`
--
ALTER TABLE `school_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `school_group_roles`
--
ALTER TABLE `school_group_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_locations`
--
ALTER TABLE `school_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `school_positions`
--
ALTER TABLE `school_positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `school_shifts`
--
ALTER TABLE `school_shifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `school_shift_hours`
--
ALTER TABLE `school_shift_hours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `school_users`
--
ALTER TABLE `school_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
