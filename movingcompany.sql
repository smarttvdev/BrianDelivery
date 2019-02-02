-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2019 at 03:22 PM
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
(169, 'Oni', 'Angel', 'female', 'images.jpg', '2019-02-02 14:21:19', '2019-02-28', 'active', 'cash', '2019-02-02 04:34:35', '2019-02-02 06:21:19'),
(170, 'Zhe', 'Zui', 'male', 'main-qimg-0af9be6ece34143f5ea71b59f3c30f60.png', '2019-02-02 12:35:39', '2019-02-23', 'active', 'cash', '2019-02-02 04:35:39', '2019-02-02 04:35:58');

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
(255, 170, 5, 4, 'beginner', 12, 1, 1, 1, 1, '2019-02-02 04:35:39', '2019-02-02 04:35:39'),
(256, 170, 5, 4, 'promote', 12, 1, 1, 1, 1, '2019-02-02 04:35:40', '2019-02-02 04:35:40'),
(257, 169, 6, 5, 'beginner', 12, 1, 1, 1, 1, '2019-02-02 06:09:31', '2019-02-02 06:21:19'),
(259, 169, 6, 7, 'beginner', 12, 1, 1, 1, 1, '2019-02-02 06:09:47', '2019-02-02 06:21:19'),
(263, 169, 7, 4, 'promote', 12, 1, 1, 1, 1, '2019-02-02 06:18:13', '2019-02-02 06:18:13'),
(265, 169, 6, 5, 'promote', 12, 1, 1, 1, 1, '2019-02-02 06:21:19', '2019-02-02 06:21:19'),
(266, 169, 6, 7, 'promote', 12, 1, 1, 1, 1, '2019-02-02 06:21:19', '2019-02-02 06:21:19');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `jobs` (`id`, `category`, `name`, `pay_amount`, `bonus`, `extra`, `packing`, `service`, `created_at`, `updated_at`) VALUES
(5, 'Flat', 'regular', 12, 1, 1, 1, 1, '2019-01-29 20:30:35', '2019-01-30 07:17:02'),
(6, 'Hourly', 'regular', 10, 10, 10, 10, 10, '2019-01-30 07:17:21', '2019-02-01 02:00:02'),
(7, 'Flat', 'Commerical', 12, 1, 1, 1, 1, '2019-02-01 02:00:36', '2019-02-01 02:00:36');

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
(5, '2019_01_30_012544_create_jobs_table', 2),
(6, '2019_01_30_012627_create_postions_table', 2),
(7, '2019_02_01_152149_create_employee_jobs_table', 3);

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
(2, 'Oni Angel', 'oni@gmail.com', NULL, '$2y$10$YgwpSh.NKXfcPAglcuNXFekTCQis57CYfy76RR7WK5mD75lmTTmz2', 'XiYV55PFX87dxWHD7e83wtFbPTOx1O9iZgWlS2OYvtCyLXTeKH0p0SGh8RPU', '2019-01-29 01:19:16', '2019-01-29 01:19:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_jobs`
--
ALTER TABLE `employee_jobs`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `employee_jobs`
--
ALTER TABLE `employee_jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
