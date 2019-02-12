-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2019 at 10:34 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movingcompany`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bonus` double NOT NULL DEFAULT '0',
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'male',
  `pictureID` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employeement_time` datetime NOT NULL,
  `promotion_date` date DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'activate',
  `paid_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `bonus`, `gender`, `pictureID`, `employeement_time`, `promotion_date`, `state`, `paid_method`, `created_at`, `updated_at`) VALUES
(2, 'Bai', 'MaoLi', 0, 'male', 'natural-landscape-background_23-2147499882.jpg', '2019-02-07 22:30:06', NULL, 'activate', 'cash', '2019-02-07 13:25:57', '2019-02-07 14:30:06'),
(3, 'Oni', 'Angel', 1, 'male', NULL, '2019-02-11 07:51:52', '2019-02-07', 'activate', 'cash', '2019-02-10 23:51:52', '2019-02-10 23:52:00'),
(4, 'Zhe', 'Zui', 0, 'male', NULL, '2019-02-11 09:41:46', NULL, 'activate', 'cash', '2019-02-11 01:41:46', '2019-02-11 01:41:46');

-- --------------------------------------------------------

--
-- Table structure for table `employee_events`
--

CREATE TABLE `employee_events` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `start_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `finish_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `travel_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_hours` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `labor_hours` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `non_profit_percent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hourly_pay` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hourly_percent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flat_percent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_percent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `packing_percent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_percent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tips` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hourly_rate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bonus` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_total` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_events`
--

INSERT INTO `employee_events` (`id`, `event_id`, `employee_id`, `job_id`, `position_id`, `start_time`, `finish_time`, `travel_time`, `total_hours`, `labor_hours`, `non_profit_percent`, `hourly_pay`, `hourly_percent`, `flat_percent`, `extra_percent`, `packing_percent`, `service_percent`, `tips`, `hourly_rate`, `discount`, `bonus`, `job_total`, `payment_description`, `created_at`, `updated_at`) VALUES
(3, 4, 4, 3, 4, NULL, NULL, '0', '0', '0', '5', '22', '1', '1', '1', '1', '1', '0', '0', '0', '0', '5', NULL, '2019-02-11 23:22:09', '2019-02-11 23:22:18'),
(4, 2, 4, 3, 4, NULL, NULL, '3', '5', '6', '14', '22', '1', '1', '1', '1', '1', '2', '0', '15', '0', '5', 'Zhe Zui is working hard', '2019-02-12 01:30:07', '2019-02-12 01:30:23');

-- --------------------------------------------------------

--
-- Table structure for table `employee_jobs`
--

CREATE TABLE `employee_jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `employeement_state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hourly_pay` double NOT NULL,
  `hourly_percent` double NOT NULL DEFAULT '0',
  `flat_percent` double NOT NULL DEFAULT '0',
  `extra_percent` double NOT NULL DEFAULT '0',
  `packing_percent` double NOT NULL DEFAULT '0',
  `service_percent` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_jobs`
--

INSERT INTO `employee_jobs` (`id`, `employee_id`, `job_id`, `position_id`, `employeement_state`, `hourly_pay`, `hourly_percent`, `flat_percent`, `extra_percent`, `packing_percent`, `service_percent`, `created_at`, `updated_at`) VALUES
(4, 2, 4, 4, 'beginner', 25, 2, 2, 2, 1, 1, '2019-02-07 13:25:57', '2019-02-07 13:43:51'),
(5, 2, 3, 3, 'promote', 22, 1, 1, 1, 2, 1, '2019-02-07 13:25:57', '2019-02-07 13:44:02'),
(8, 2, 1, 4, 'promote', 16, 1, 1, 0, 1, 1, '2019-02-07 13:45:07', '2019-02-07 13:51:22'),
(9, 3, 3, 3, 'beginner', 22, 1, 1, 1, 1, 1, '2019-02-10 23:51:52', '2019-02-10 23:51:52'),
(10, 3, 3, 3, 'promote', 22, 1, 1, 1, 1, 1, '2019-02-10 23:51:52', '2019-02-10 23:51:52'),
(11, 4, 3, 4, 'beginner', 22, 1, 1, 1, 1, 1, '2019-02-11 01:41:46', '2019-02-11 01:41:46'),
(12, 4, 3, 4, 'promote', 22, 1, 1, 1, 1, 1, '2019-02-11 01:41:46', '2019-02-11 01:41:46');

-- --------------------------------------------------------

--
-- Table structure for table `employee_pays`
--

CREATE TABLE `employee_pays` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `pay_amount` double NOT NULL,
  `bonus` double NOT NULL DEFAULT '0',
  `extra` double NOT NULL DEFAULT '0',
  `packing` double NOT NULL DEFAULT '0',
  `service` double NOT NULL DEFAULT '0',
  `tips` double NOT NULL DEFAULT '0',
  `non_profit` double NOT NULL DEFAULT '0',
  `discount` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `pick_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `drop_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stop_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `packing` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `non_profit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `truck_license` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attach_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `pick_address`, `drop_address`, `stop_address`, `flat`, `extra`, `packing`, `service`, `non_profit`, `truck_license`, `comment`, `state`, `attach_file`, `created_at`, `updated_at`) VALUES
(2, 'ShenYang', 'DanDong', 'AiZhen', '3', '12', '7', '7', '15', '12345', 'Zhe Zui and Oni\'s Task', 'close', NULL, '2019-02-11 23:05:31', '2019-02-12 01:32:16'),
(3, NULL, NULL, NULL, '0', '0', '0', '0', '0', NULL, NULL, 'close', NULL, '2019-02-11 23:05:57', '2019-02-11 23:05:57'),
(4, NULL, NULL, NULL, '0', '0', '0', '0', '0', NULL, NULL, 'close', NULL, '2019-02-11 23:22:09', '2019-02-11 23:22:09'),
(5, 'ShenYang', 'DanDong', 'AiZhen', '3', '4', '4', '6', '10', '12345', 'First Comment Part', 'close', NULL, '2019-02-12 01:18:49', '2019-02-12 01:18:49');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hourly_pay` double NOT NULL DEFAULT '0',
  `hourly_percent` double NOT NULL DEFAULT '0',
  `flat_percent` double NOT NULL DEFAULT '0',
  `extra_percent` double NOT NULL DEFAULT '0',
  `packing_percent` double NOT NULL DEFAULT '0',
  `service_percent` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `type`, `variation`, `hourly_pay`, `hourly_percent`, `flat_percent`, `extra_percent`, `packing_percent`, `service_percent`, `created_at`, `updated_at`) VALUES
(1, 'Hourly', NULL, 16, 1, 1, 1, 1, 1, '2019-02-07 11:38:31', '2019-02-07 11:39:07'),
(2, 'Hourly', 'Commerical', 20, 2, 1, 1, 1, 1, '2019-02-07 11:38:57', '2019-02-07 11:38:57'),
(3, 'Flat', NULL, 22, 1, 1, 1, 1, 1, '2019-02-07 11:42:28', '2019-02-07 11:42:28'),
(4, 'Flat', 'Professional', 25, 2, 2, 2, 1, 1, '2019-02-07 11:47:38', '2019-02-07 11:47:55');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(6, '2019_01_30_012627_create_postions_table', 2),
(13, '2019_02_04_090533_create_employee_pays_table', 7),
(14, '2019_01_30_000825_create_employees_table', 8),
(15, '2019_01_30_012544_create_jobs_table', 8),
(16, '2019_02_01_152149_create_employee_jobs_table', 8),
(19, '2019_02_04_002319_create_events_table', 9),
(22, '2019_02_04_010203_create_employee_events_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `postions`
--

CREATE TABLE `postions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `postions`
--

INSERT INTO `postions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'Forman', '2019-01-30 07:25:06', '2019-02-01 01:04:15'),
(4, 'Driver', '2019-01-30 07:25:12', '2019-02-01 01:04:24'),
(5, 'Forman / Driver', '2019-02-01 01:04:41', '2019-02-01 01:04:41'),
(6, 'Helper', '2019-02-01 01:04:56', '2019-02-01 01:04:56'),
(7, 'Sales Person', '2019-02-01 01:05:08', '2019-02-01 01:05:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Bai MaoLi', 'baimaoli9@gmail.com', NULL, '$2y$10$.LYa6lp1btAmpIEe/fTddOUhh5agDMQDdY9mekKyqkF3TDWfbxeVq', 'C9TaNg3mQS0G96cJFT2un8SwuzmnmcQ38xRYMthLLUyLH00KUOL3kSFpwvYV', '2019-01-28 01:55:10', '2019-01-28 01:55:10'),
(2, 'Oni Angel', 'oni@gmail.com', NULL, '$2y$10$YgwpSh.NKXfcPAglcuNXFekTCQis57CYfy76RR7WK5mD75lmTTmz2', 'fKgIC8RtwLkeYtgKwnkBNhUvVhRBxXrIrlBBa8eJpgTZUXxvRC5FAqIrsiGO', '2019-01-29 01:19:16', '2019-01-29 01:19:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_events`
--
ALTER TABLE `employee_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_jobs`
--
ALTER TABLE `employee_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_pays`
--
ALTER TABLE `employee_pays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
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
-- Indexes for table `postions`
--
ALTER TABLE `postions`
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
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee_events`
--
ALTER TABLE `employee_events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee_jobs`
--
ALTER TABLE `employee_jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `employee_pays`
--
ALTER TABLE `employee_pays`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `postions`
--
ALTER TABLE `postions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
