-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 05, 2025 at 05:20 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jain_society`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `city_id` int NOT NULL AUTO_INCREMENT,
  `zone_id` int NOT NULL,
  `city_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`city_id`),
  KEY `zone_id` (`zone_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `zone_id`, `city_name`) VALUES
(1, 4, 'Bhopal'),
(2, 5, 'Durg'),
(3, 5, 'Kumhari'),
(4, 5, 'Jamul'),
(5, 5, 'Bhilai-3'),
(6, 6, 'Raipur'),
(7, 6, 'Arang'),
(8, 6, 'Tilda'),
(9, 6, 'Abhanpur'),
(10, 6, 'Naya Raipur'),
(11, 7, 'Bilaspur'),
(12, 7, 'Ratanpur'),
(13, 7, 'Takhtapur'),
(14, 7, 'Koni'),
(16, 8, 'Korba'),
(17, 5, 'Katghora'),
(18, 8, 'kusmunda'),
(19, 8, 'Deepka'),
(20, 8, 'Chhuri'),
(21, 9, 'Raigarh'),
(22, 10, 'Dantewada seher'),
(23, 11, 'Kondagaon'),
(24, 11, 'Bastar');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `event_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `event_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `event_time` time NOT NULL,
  `event_location` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_img` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `toshow_type` enum('all','zone','city','member') COLLATE utf8mb4_unicode_ci DEFAULT 'all',
  `toshow_id` int DEFAULT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `title`, `description`, `event_date`, `created_at`, `event_time`, `event_location`, `event_status`, `event_img`, `toshow_type`, `toshow_id`) VALUES
(2, 'Diwali 2025', 'We are going to celebrate Diwali this evening', '2025-10-20', '2025-12-03 17:57:19', '18:30:00', 'Club Hous', 'completed', '1764784639_a2.jpeg', 'zone', NULL),
(3, 'Fun fest', 'Fun and games', '2025-12-12', '2025-12-04 16:15:17', '21:46:00', 'Club', 'upcoming', 'AEGON_I.jpg', 'member', 8);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
CREATE TABLE IF NOT EXISTS `gallery` (
  `gallery_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `visibility_type` enum('all','zone','city','member') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zone_id` int DEFAULT NULL,
  `city_id` int DEFAULT NULL,
  `member_id` int DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`gallery_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`gallery_id`, `title`, `description`, `visibility_type`, `zone_id`, `city_id`, `member_id`, `image`, `created_at`) VALUES
(2, 'Diwali', 'Diwali Celebration 2k25', 'all', 0, 0, 0, '1764832607_a2.jpeg', '2025-12-04 12:46:47'),
(3, 'Holi', 'Holi 2k26', 'city', 0, 14, 0, '1764875203_wallpaperflare.com_wallpaper.jpg', '2025-12-05 00:36:43');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `member_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `zone_id` int NOT NULL,
  `city_id` int NOT NULL,
  `plan_id` int NOT NULL,
  `gender` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `membership_start` date DEFAULT NULL,
  `membership_end` date DEFAULT NULL,
  `phone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fullname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`member_id`),
  KEY `user_id` (`user_id`),
  KEY `zone_id` (`zone_id`),
  KEY `city_id` (`city_id`),
  KEY `plan_id` (`plan_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `user_id`, `zone_id`, `city_id`, `plan_id`, `gender`, `dob`, `membership_start`, `membership_end`, `phone`, `address`, `photo`, `created_at`, `fullname`) VALUES
(8, 6, 6, 7, 0, 'Male', '1555-08-18', '2025-12-04', NULL, '9479031012', 'Near Railway Station,durg', '1764859706_pic.jpg', '2025-12-04 14:48:26', 'Viserionr'),
(11, 9, 5, 4, 1, 'Male', '1988-09-01', '2025-12-04', '2026-12-04', '7985122998', 'Near Puri ITI,kohka', '1764877535_logo.png', '2025-12-04 19:45:35', 'Surya Naik'),
(7, 5, 5, 5, 1, 'Male', '1988-05-17', '2025-12-04', '2026-12-04', '1234567890', 'Kurud', '1764855137_AEGON_I.jpg', '2025-12-04 13:32:17', 'Vish'),
(10, 8, 7, 12, 1, 'Male', '2025-12-13', '2025-12-04', '2026-12-04', '1234567890', 'Near railway station', '1764877201_wallpaperflare.com_wallpaper (2).jpg', '2025-12-04 19:40:01', 'sonu kumar');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `news_date` date NOT NULL,
  `status` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `news_img` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `toshow_type` enum('all','zone','city','member') COLLATE utf8mb4_unicode_ci DEFAULT 'all',
  `toshow_id` int DEFAULT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `title`, `description`, `created_at`, `news_date`, `status`, `news_img`, `toshow_type`, `toshow_id`) VALUES
(1, 'Robbery in Homes', 'House break at 12A', '2025-12-03 18:08:01', '2024-11-03', '', '1819963171wallpaperflare.com_wallpaper.jpg', 'zone', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `pay_id` int NOT NULL AUTO_INCREMENT,
  `member_id` int NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `payment_for_year` int DEFAULT NULL,
  `receipt_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_by` int DEFAULT NULL,
  PRIMARY KEY (`pay_id`),
  UNIQUE KEY `receipt_no` (`receipt_no`),
  KEY `member_id` (`member_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`pay_id`, `member_id`, `amount`, `payment_date`, `payment_for_year`, `receipt_no`, `note`, `created_by`) VALUES
(1, 8, 500.00, '2025-12-04 00:00:00', 2026, '554', 'We got your Payment', 0),
(2, 7, 500.00, '2025-12-04 00:00:00', 2026, '492', 'Okay we got your money', 0),
(3, 7, 500.00, '2025-12-05 00:00:00', 2027, '645', 'We got you payment', 0);

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

DROP TABLE IF EXISTS `plans`;
CREATE TABLE IF NOT EXISTS `plans` (
  `plan_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration_days` int DEFAULT NULL,
  PRIMARY KEY (`plan_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`plan_id`, `name`, `price`, `duration_days`) VALUES
(1, 'Yearly', 500.00, 365),
(2, 'Lifetime', 5000.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `plan_requests`
--

DROP TABLE IF EXISTS `plan_requests`;
CREATE TABLE IF NOT EXISTS `plan_requests` (
  `req_id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_id` int DEFAULT NULL,
  `request_date` date DEFAULT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  PRIMARY KEY (`req_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plan_requests`
--

INSERT INTO `plan_requests` (`req_id`, `user_id`, `plan_id`, `request_date`, `status`) VALUES
(3, '7', 1, '2025-12-04', 'approved'),
(4, '10', 1, '2025-12-05', 'approved'),
(5, '11', 1, '2025-12-05', 'approved'),
(6, '7', 1, '2025-12-05', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
CREATE TABLE IF NOT EXISTS `requests` (
  `request_id` int NOT NULL AUTO_INCREMENT,
  `member_id` int NOT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `request_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `approved_date` datetime DEFAULT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`request_id`, `member_id`, `status`, `request_date`, `approved_date`) VALUES
(1, 4, 'approved', '2025-12-03 22:40:20', '2025-12-04 18:46:09'),
(2, 5, 'approved', '2025-12-04 18:57:37', NULL),
(3, 6, 'approved', '2025-12-04 19:01:11', NULL),
(4, 7, 'approved', '2025-12-04 19:02:17', '2025-12-05 09:33:54'),
(5, 8, 'approved', '2025-12-04 20:18:26', '2025-12-04 23:22:56'),
(6, 10, 'approved', '2025-12-05 01:10:01', '2025-12-05 01:10:01'),
(7, 11, 'approved', '2025-12-05 01:15:35', '2025-12-05 01:15:35');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
CREATE TABLE IF NOT EXISTS `states` (
  `state_id` int NOT NULL AUTO_INCREMENT,
  `state_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`state_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`state_id`, `state_name`, `created_at`) VALUES
(1, 'Chhattisgarh', '2025-12-03 06:35:42'),
(2, 'Chandigarh', '2025-12-03 06:35:51'),
(3, 'Madhya Pradesh', '2025-12-03 11:53:53'),
(4, 'Jharkhand', '2025-12-03 11:55:15'),
(5, 'Rajashthan', '2025-12-03 12:52:19'),
(7, 'Kerala', '2025-12-03 13:50:57'),
(9, 'Maharashtra', '2025-12-03 13:55:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '123456',
  `role` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `onboarding` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `onboarding`) VALUES
(1, 'admin', 'admin@example.com', 'a', 'admin', '2025-12-03 05:32:57', 1),
(5, 'vish', '123vishal18910@gmail.com', 'a', 'user', '2025-12-03 06:13:43', 1),
(6, 'vinujie', 'vishal2104821003patil@gmail.com', '123456', 'user', '2025-12-04 14:48:26', 1),
(7, 'ram', 'ram@gmail.com', '123456', 'user', '2025-12-04 19:35:49', 1),
(8, 'sonu', 'sonu@gmail.com', '123456', 'user', '2025-12-04 19:40:01', 1),
(9, 'surya', 'surya@gmail.com', '123456', 'user', '2025-12-04 19:45:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

DROP TABLE IF EXISTS `zones`;
CREATE TABLE IF NOT EXISTS `zones` (
  `zone_id` int NOT NULL AUTO_INCREMENT,
  `zone_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`zone_id`),
  UNIQUE KEY `name` (`zone_name`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zones`
--

INSERT INTO `zones` (`zone_id`, `zone_name`) VALUES
(5, 'Durg/Bhilai-Zone 1'),
(6, 'Raipur-Zone 2'),
(7, 'Bilaspur-Zone 3'),
(8, 'Korba-Zone 4'),
(9, 'Raigarh-Zone 5'),
(11, 'Jagdalpur-Zone 7');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
