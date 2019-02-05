-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2019 at 06:13 PM
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
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'male',
  `pictureID` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employeement_time` datetime NOT NULL,
  `promotion_date` date DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `paid_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `gender`, `pictureID`, `employeement_time`, `promotion_date`, `state`, `paid_method`, `created_at`, `updated_at`) VALUES
(184, 'Bai', 'MaoLi', 'male', 'sehun-tc-candler-768x768.jpg', '2019-02-04 04:56:38', NULL, 'active', 'cash', '2019-02-03 20:49:43', '2019-02-03 20:56:38'),
(185, 'Zhe', 'Zui', 'male', 'aa.jpg', '2019-02-05 06:53:48', NULL, 'active', 'cash', '2019-02-03 20:51:43', '2019-02-04 22:53:48');

-- --------------------------------------------------------

--
-- Table structure for table `employee_events`
--

CREATE TABLE `employee_events` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `pay_amount` double NOT NULL,
  `bonus` double NOT NULL DEFAULT '0',
  `extra` double NOT NULL DEFAULT '0',
  `packing` double NOT NULL DEFAULT '0',
  `service` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_jobs`
--

INSERT INTO `employee_jobs` (`id`, `employee_id`, `job_id`, `position_id`, `employeement_state`, `pay_amount`, `bonus`, `extra`, `packing`, `service`, `created_at`, `updated_at`) VALUES
(267, 184, 2, 4, 'beginner', 15, 2, 1, 1, 1, '2019-02-03 20:49:43', '2019-02-03 20:50:01'),
(268, 184, 2, 3, 'promote', 15, 2, 1, 1, 1, '2019-02-03 20:49:43', '2019-02-03 20:49:43'),
(269, 185, 3, 3, 'beginner', 21, 1, 1, 1, 1, '2019-02-03 20:51:43', '2019-02-03 20:51:43'),
(270, 185, 3, 3, 'promote', 21, 1, 1, 1, 1, '2019-02-03 20:51:43', '2019-02-03 20:51:43'),
(271, 185, 2, 4, 'beginner', 15, 2, 1, 1, 1, '2019-02-03 20:51:51', '2019-02-03 20:51:51'),
(272, 185, 2, 4, 'promote', 15, 2, 1, 1, 1, '2019-02-03 20:51:51', '2019-02-03 20:51:51'),
(273, 185, 1, 4, 'promote', 12, 1, 0, 1, 1, '2019-02-03 20:52:02', '2019-02-03 20:52:02');

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
  `pick_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `drop_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `finish_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `labor_hours` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `travel_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_hours` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` double NOT NULL DEFAULT '0',
  `job_total` double NOT NULL,
  `truck_license` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tips` double NOT NULL DEFAULT '0',
  `bonus` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attach_file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `non_profit` double NOT NULL DEFAULT '0',
  `job_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_amount` double NOT NULL DEFAULT '0',
  `bonus` double NOT NULL DEFAULT '0',
  `extra` double NOT NULL DEFAULT '0',
  `packing` double NOT NULL DEFAULT '0',
  `service` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `type`, `variation`, `pay_amount`, `bonus`, `extra`, `packing`, `service`, `created_at`, `updated_at`) VALUES
(1, 'Flat', NULL, 12, 1, 0, 1, 1, '2019-02-03 20:33:25', '2019-02-05 09:01:29'),
(2, 'Flat', 'Commerical', 15, 2, 1, 1, 1, '2019-02-03 20:34:00', '2019-02-03 20:35:29'),
(3, 'Flat', NULL, 21, 1, 1, 1, 1, '2019-02-03 20:34:19', '2019-02-03 20:34:19'),
(4, 'Hourly', 'Professional', 25, 1, 2, 1, 1, '2019-02-03 20:34:38', '2019-02-03 20:34:38');

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
(4, '2019_01_30_000825_create_employees_table', 2),
(6, '2019_01_30_012627_create_postions_table', 2),
(7, '2019_02_01_152149_create_employee_jobs_table', 3),
(10, '2019_01_30_012544_create_jobs_table', 6),
(11, '2019_02_04_002319_create_events_table', 7),
(12, '2019_02_04_010203_create_employee_events_table', 7),
(13, '2019_02_04_090533_create_employee_pays_table', 7);

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
(1, 'Bai MaoLi', 'baimaoli9@gmail.com', NULL, '$2y$10$.LYa6lp1btAmpIEe/fTddOUhh5agDMQDdY9mekKyqkF3TDWfbxeVq', 'IiFXoql9GvJNMF3gv9HSMLnirdaseyUlXm0Ysiar4aFVImoh9TBtYJ0hhG3s', '2019-01-28 01:55:10', '2019-01-28 01:55:10'),
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `employee_events`
--
ALTER TABLE `employee_events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_jobs`
--
ALTER TABLE `employee_jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=274;

--
-- AUTO_INCREMENT for table `employee_pays`
--
ALTER TABLE `employee_pays`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
