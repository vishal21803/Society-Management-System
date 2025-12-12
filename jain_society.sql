-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 12, 2025 at 05:26 AM
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
-- Table structure for table `sens_bills`
--

DROP TABLE IF EXISTS `sens_bills`;
CREATE TABLE IF NOT EXISTS `sens_bills` (
  `bill_id` int NOT NULL AUTO_INCREMENT,
  `member_id` int NOT NULL,
  `bill_date` datetime NOT NULL,
  `bill_amount` int NOT NULL,
  `bill_purpose` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bill_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sens_bills`
--

INSERT INTO `sens_bills` (`bill_id`, `member_id`, `bill_date`, `bill_amount`, `bill_purpose`, `created_by`, `bill_type`) VALUES
(12, 18, '2025-12-06 11:19:30', 200, 'diwali event', '', ''),
(11, 18, '2025-12-06 11:18:29', 500, 'Membership yearly fees', '', 'Yearly Fee'),
(13, 18, '2025-12-06 11:19:55', 100, 'Monthly Cleaning', '', ''),
(14, 18, '2025-12-06 11:37:29', 150, 'Holi Celebration 2k26', '', ''),
(15, 18, '2025-12-07 13:32:35', 500, 'Monthly maintainance ', '', ''),
(16, 18, '2025-12-07 13:33:00', 100, 'Tree plantation fee', '', ''),
(17, 11, '2025-12-08 06:17:45', 500, 'yearly Membership fees', 'admin', ''),
(18, 19, '2025-12-08 06:28:01', 100, 'Monthly Cleaning Fee ', 'acc', ''),
(19, 20, '2025-12-08 06:47:14', 400, 'yearly Membership fees', 'admin', 'Yearly Fee'),
(20, 18, '2025-12-08 08:39:13', 500, 'ye aapka 500 rs ka yearly membership fee h jisse apko pay krna h ', 'admin', 'Yearly Fee');

-- --------------------------------------------------------

--
-- Table structure for table `sens_cities`
--

DROP TABLE IF EXISTS `sens_cities`;
CREATE TABLE IF NOT EXISTS `sens_cities` (
  `city_id` int NOT NULL AUTO_INCREMENT,
  `zone_id` int NOT NULL,
  `city_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cstatus` int NOT NULL DEFAULT '1',
  `created_by` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`city_id`),
  KEY `zone_id` (`zone_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sens_cities`
--

INSERT INTO `sens_cities` (`city_id`, `zone_id`, `city_name`, `cstatus`, `created_by`) VALUES
(1, 4, 'Bhopal', 1, ''),
(2, 5, 'Durg', 1, ''),
(3, 5, 'Kumhari', 1, ''),
(4, 5, 'Jamul', 1, ''),
(5, 5, 'Bhilai-3', 1, ''),
(6, 6, 'Raipur', 1, ''),
(7, 6, 'Arang', 1, ''),
(8, 6, 'Tilda', 1, ''),
(9, 6, 'Abhanpur', 1, ''),
(10, 6, 'Naya Raipur', 1, ''),
(11, 7, 'Bilaspur', 1, ''),
(12, 7, 'Ratanpur', 1, ''),
(35, 7, 'Takhtapur', 1, 'admin'),
(14, 7, 'Koni', 1, ''),
(16, 8, 'Korba', 1, ''),
(17, 5, 'Katghora', 1, ''),
(18, 8, 'kusmunda', 1, ''),
(19, 8, 'Deepka', 1, ''),
(20, 8, 'Chhuri', 1, ''),
(21, 9, 'Raigarh', 1, ''),
(22, 10, 'Dantewada seher', 1, ''),
(23, 11, 'Kondagaon', 1, ''),
(24, 11, 'Bastar', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `sens_commity`
--

DROP TABLE IF EXISTS `sens_commity`;
CREATE TABLE IF NOT EXISTS `sens_commity` (
  `comi_id` int NOT NULL AUTO_INCREMENT,
  `comi_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comi_gender` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comi_post` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comi_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `comi_zone` int NOT NULL,
  `comi_city` int NOT NULL,
  `comi_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `comi_priority` int NOT NULL,
  `comi_duration` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`comi_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sens_commity`
--

INSERT INTO `sens_commity` (`comi_id`, `comi_name`, `comi_gender`, `comi_post`, `comi_img`, `comi_zone`, `comi_city`, `comi_address`, `comi_priority`, `comi_duration`, `created_by`) VALUES
(6, 'Sandeep Singh', 'Male', 'Karya Adhyaksh', 'comi_1765380804.png', 11, 24, 'Near Jungle Area', 22, '2021-Present', 'admin'),
(5, 'vish', 'Male', 'Sah Mantri', 'wallpaperflare.com_wallpaper.jpg', 5, 2, 'wdwt', 44, '2022-2023', ''),
(7, 'Ramesh Jain', 'Male', 'Koshadhyaksh', 'default.png', 5, 5, '123 Main Street', 1, '2025-2028', '1'),
(8, 'Sita Mehta', 'Female', 'Mahamantri', 'default.png', 11, 23, '45 Park Avenue', 2, '2025-2028', '1'),
(9, 'Ajay Sharma', 'Male', 'Sah Sabhapati', 'default.png', 6, 8, '78 Elm Street', 3, '2025-2028', '1'),
(10, 'dfefefef', 'Male', 'Sabhapati', '1765465674_wallpaperflare.com_wallpaper.jpg', 11, 24, 'fefeeff', 445, '1919-1920', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `sens_contact`
--

DROP TABLE IF EXISTS `sens_contact`;
CREATE TABLE IF NOT EXISTS `sens_contact` (
  `con_id` int NOT NULL AUTO_INCREMENT,
  `con_phone` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `con_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `con_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`con_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sens_contact`
--

INSERT INTO `sens_contact` (`con_id`, `con_phone`, `con_name`, `con_desc`) VALUES
(12, '5555555555', 'message2', 'messagemessagemessagemessagemessagemessagemessage'),
(11, '1111111111', 'message', 'message messagemessagemessagemessagemessage');

-- --------------------------------------------------------

--
-- Table structure for table `sens_downloads`
--

DROP TABLE IF EXISTS `sens_downloads`;
CREATE TABLE IF NOT EXISTS `sens_downloads` (
  `id` int NOT NULL AUTO_INCREMENT,
  `topic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `downshow` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sens_downloads`
--

INSERT INTO `sens_downloads` (`id`, `topic`, `remark`, `file_name`, `created_at`, `downshow`, `created_by`) VALUES
(1, 'Maintenance Bill-15324', 'This is the receipt of yearly maintenance in our society.', '1764937140_My Resume.pdf', '2025-12-05 12:11:53', 'general', ''),
(3, 'Rozjaar yojna', 'Fill the Form to get a Job', '1765465561_wallpaperflare.com_wallpaper.jpg', '2025-12-06 07:31:08', 'members', '');

-- --------------------------------------------------------

--
-- Table structure for table `sens_events`
--

DROP TABLE IF EXISTS `sens_events`;
CREATE TABLE IF NOT EXISTS `sens_events` (
  `event_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `event_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `event_time` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_location` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_img` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `toshow_type` enum('all','zone','city','member') COLLATE utf8mb4_unicode_ci DEFAULT 'all',
  `toshow_id` int DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sens_events`
--

INSERT INTO `sens_events` (`event_id`, `title`, `description`, `event_date`, `created_at`, `event_time`, `event_location`, `event_status`, `event_img`, `toshow_type`, `toshow_id`, `created_by`, `video_link`) VALUES
(12, 'Diwali 2k25', 'A peaceful spiritual gathering where members participated in Samayik, followed by an enlightening Pravachan by respected Jain scholars.', '2025-11-11', '2025-12-09 08:05:41', '', 'Club House', 'upcoming', '1764832607_a2.jpeg', 'all', 0, 'admin', 'https://youtu.be/LTeO_TNDJWI?si=-SqKVrHWk4T18cJl'),
(13, 'Annual Samayik & Pravachan Day', 'A peaceful spiritual gathering where members participated in Samayik, followed by an enlightening Pravachan by respected Jain scholars.', '2025-08-08', '2025-12-09 12:18:21', '', 'Circus Ground', '', 'logo.png', 'all', 0, 'admin', 'https://youtu.be/LTeO_TNDJWI?si=-SqKVrHWk4T18cJl'),
(14, 'Health Check-up Camp', 'A free community health camp organized to promote wellness, including general health tests and doctor consultations.  A free community health camp organized to promote wellness, including general health tests and doctor consultations.  A free community health camp organized to promote wellness, including general health tests and doctor consultations.  A free community health camp organized to promote wellness, including general health tests and doctor consultations.', '2024-10-09', '2025-12-09 12:20:10', '', 'Jain Conference Cente', '', '1765095426_2171-blood-donation.jpg', 'all', 0, 'admin', 'https://youtu.be/jhBAUzoXj_A?si=qzF4dPoZX84XbD7D'),
(17, 'fffffffffffffff', 'qqe', '2008-08-08', '2025-12-11 14:56:09', '', 'Jain Conference Cente', '', '1765465194_wallpaperflare.com_wallpaper (1).jpg', 'all', 0, 'admin', ''),
(15, 'fef', 'fef', '2024-10-09', '2025-12-11 14:50:16', '', 'India Expo Mart', '', '', 'all', 0, 'admin', 'https://youtu.be/LTeO_TNDJWI?si=-SqKVrHWk4T18cJl'),
(16, 'fffffffff', 'd', '2010-10-10', '2025-12-11 14:52:14', '', 'ss', '', 'WIN_20240504_16_34_38_Pro.jpg', 'all', 0, 'admin', '');

-- --------------------------------------------------------

--
-- Table structure for table `sens_family`
--

DROP TABLE IF EXISTS `sens_family`;
CREATE TABLE IF NOT EXISTS `sens_family` (
  `fam_id` int NOT NULL AUTO_INCREMENT,
  `member_id` int NOT NULL,
  `fam_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fam_gender` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fam_phone` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fam_relation` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fam_dob` date NOT NULL,
  `fam_education` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`fam_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sens_family`
--

INSERT INTO `sens_family` (`fam_id`, `member_id`, `fam_name`, `fam_gender`, `fam_phone`, `fam_relation`, `created_by`, `fam_dob`, `fam_education`) VALUES
(1, 18, 'Mary Jones', 'Female', '9874563311', 'Wife', 'jon', '1997-08-21', 'B.tech');

-- --------------------------------------------------------

--
-- Table structure for table `sens_gallery`
--

DROP TABLE IF EXISTS `sens_gallery`;
CREATE TABLE IF NOT EXISTS `sens_gallery` (
  `gallery_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `visibility_type` enum('all','zone','city','member') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zone_id` int DEFAULT NULL,
  `city_id` int DEFAULT NULL,
  `member_id` int DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int NOT NULL,
  PRIMARY KEY (`gallery_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sens_gallery`
--

INSERT INTO `sens_gallery` (`gallery_id`, `title`, `description`, `visibility_type`, `zone_id`, `city_id`, `member_id`, `image`, `created_at`, `created_by`, `priority`) VALUES
(5, 'Mahavir Jayanti Celebration', 'A nationwide celebration of Lord Mahavir Jayanti observed with grand processions, special prayers, pravachans, bhajan sandhya, and community service activities across Jain temples in India. Devotees participated with devotion, peace, and spiritual enthusiasm.', 'all', 0, 0, 0, '1765093066_mahavir-jayanti-f.webp', '2025-12-07 13:07:46', NULL, 100),
(6, 'Diwali & Nirvan Divas Mahotsav', 'Diwali was celebrated across the Jain community as the Nirvan Divas of Lord Mahavir with deep spiritual significance. Temples were illuminated with diyas, special pujas were performed, and messages of non-violence, truth, and self-discipline were spread.', 'all', 0, 0, 0, '1765093175_diwal.jpg', '2025-12-07 13:09:35', NULL, 0),
(7, 'Festival of Colors – Holi Utsav', 'The festival of Holi was celebrated with joy, unity, and cultural programs. Community members enjoyed flower Holi, traditional music, dance performances, and social bonding while promoting harmony and brotherhood.', 'all', 0, 0, 0, '1765093215_holi.webp', '2025-12-07 13:10:15', NULL, 0),
(8, 'Zone Level Jain Sports Meet', '', 'zone', 5, 0, 0, '1765095294_sports.jpg', '2025-12-07 13:44:54', NULL, 0),
(9, ' City Jain Blood Donation Camp', '', 'city', 0, 12, 0, '1765095426_2171-blood-donation.jpg', '2025-12-07 13:47:06', NULL, 0),
(10, 'My Personal Membership Anniversary', '', 'member', 0, 0, 18, '1765095510_flower.webp', '2025-12-07 13:48:30', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sens_members`
--

DROP TABLE IF EXISTS `sens_members`;
CREATE TABLE IF NOT EXISTS `sens_members` (
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
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'default.png',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fullname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance_amount` float NOT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `education` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`member_id`),
  KEY `user_id` (`user_id`),
  KEY `zone_id` (`zone_id`),
  KEY `city_id` (`city_id`),
  KEY `plan_id` (`plan_id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sens_members`
--

INSERT INTO `sens_members` (`member_id`, `user_id`, `zone_id`, `city_id`, `plan_id`, `gender`, `dob`, `membership_start`, `membership_end`, `phone`, `address`, `photo`, `created_at`, `fullname`, `balance_amount`, `created_by`, `business`, `education`) VALUES
(11, 9, 5, 4, 2, 'Male', '1988-09-01', '2025-12-04', '2026-11-04', '7985122998', 'Near Puri ITI,kohka', '1764877535_logo.png', '2025-12-04 19:45:35', 'Surya Naik', 500, NULL, '', ''),
(7, 5, 5, 5, 1, 'Male', '1999-05-17', '2025-12-04', '2026-12-04', '1234567890', 'Kurud', '1764855137_AEGON_I.jpg', '2025-12-04 13:32:17', 'Vish', 0, NULL, 'Web Developer Freelancing', 'B.Tech '),
(10, 8, 7, 12, 1, 'Male', '2025-12-13', '2025-12-04', '2026-12-04', '8234567890', 'Near railway station,Kohka', '1764877201_wallpaperflare.com_wallpaper (2).jpg', '2025-12-04 19:40:01', 'Sonu kumar', 0, NULL, '', ''),
(13, 12, 6, 6, 1, 'Male', '1991-11-19', '2025-12-05', '2026-12-05', '1234567890', 'Near magneto', '1764919049_logo.png', '2025-12-05 07:17:29', 'Rajiv', 0, NULL, '', ''),
(18, 15, 7, 14, 1, 'Male', '1994-11-03', '2025-12-04', '2026-12-04', '1234567894', 'Near Station', '1764942326_wallpaperflare.com_wallpaper.jpg', '2025-12-05 13:45:26', 'Jon Snow', -650, NULL, 'CEO', 'B.tech_AI'),
(19, 16, 5, 17, 1, 'Male', '2000-10-10', '2025-12-07', '2026-12-07', '7321456980', 'Avanti bai chowk,kohka,Bhilai', '1765115919pray.jpg', '2025-12-07 13:49:57', 'Shiv kumar', 100, NULL, '', ''),
(20, 17, 7, 14, 1, 'Male', '1989-04-14', '2025-12-07', '2026-12-07', '7321456980', 'Near China Market', '1765121172_flower.webp', '2025-12-07 15:26:12', 'Rajendra Kumar', -1250, NULL, '', ''),
(37, 35, 5, 5, 2, '', '0000-00-00', NULL, NULL, '1234567898', NULL, 'default.png', '2025-12-11 15:36:40', 'efefef', 0, NULL, '', ''),
(23, 21, 5, 17, 2, '', '1994-06-15', '2025-12-08', NULL, '9479031444', 'Near hanuman Madir', NULL, '2025-12-08 11:16:40', 'Ravi Kumar', 0, NULL, 'dvd', 'dvd'),
(27, 25, 6, 7, 1, '', '0000-00-00', '2025-12-08', NULL, '8888844444', NULL, NULL, '2025-12-08 18:30:56', 'efefee', 0, NULL, '', ''),
(35, 33, 7, 11, 2, '', '0000-00-00', '2025-12-11', NULL, '123', NULL, 'default.png', '2025-12-11 06:16:01', 'Ravi kumar patni', 0, NULL, '', ''),
(28, 26, 5, 4, 2, '', '0000-00-00', '2025-12-09', NULL, '7896412307', NULL, 'default.png', '2025-12-09 16:50:09', 'pp', 0, NULL, '', ''),
(29, 27, 5, 3, 1, 'Male', '1955-05-11', '2025-12-09', NULL, '8877799999', 'Casterly Rock,Westelands', '1765301392_1764875203_wallpaperflare.com_wallpaper.jpg', '2025-12-09 17:29:52', 'Tywin Lanister', -200, 'admin', '', ''),
(31, 29, 7, 14, 2, '', '0000-00-00', '2025-12-09', NULL, '8788787454', NULL, 'default.png', '2025-12-09 17:44:10', 'Cersie', 0, NULL, '', ''),
(38, 36, 7, 11, 2, '', '0000-00-00', NULL, NULL, '1478520000', NULL, 'default.png', '2025-12-11 15:44:33', 'ahoy', 0, NULL, '', ''),
(33, 31, 5, 5, 2, '', '0000-00-00', '2025-12-10', '0000-00-00', '1234567890', 'Dragonstone', 'default.png', '2025-12-10 12:36:05', 'Aegon Targaryen', 0, NULL, '', ''),
(36, 34, 5, 5, 2, '', '0000-00-00', NULL, NULL, '4440004400', NULL, 'default.png', '2025-12-11 15:24:37', 'end', 0, NULL, '', ''),
(39, 38, 7, 11, 2, 'okadda44', '0000-00-00', '2025-12-11', NULL, '1234567885', NULL, 'default.png', '2025-12-11 15:57:13', '', 0, 'admin', '', ''),
(40, 39, 7, 14, 2, 'Ravi Husain', '0000-00-00', '2025-12-11', NULL, '1839721354', NULL, 'default.png', '2025-12-11 16:02:20', '', 0, 'admin', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sens_messages`
--

DROP TABLE IF EXISTS `sens_messages`;
CREATE TABLE IF NOT EXISTS `sens_messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sender_id` int NOT NULL,
  `sender_type` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver_id` int NOT NULL,
  `receiver_type` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('unread','read') COLLATE utf8mb4_unicode_ci DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sens_messages`
--

INSERT INTO `sens_messages` (`id`, `sender_id`, `sender_type`, `receiver_id`, `receiver_type`, `subject`, `message`, `status`, `created_at`, `created_by`) VALUES
(8, 15, 'user', 1, 'admin', 'Payment issue', 'update my dashboard', 'unread', '2025-12-07 13:01:10', NULL),
(12, 15, 'user', 1, 'admin', 'hmm', 'thik h', 'unread', '2025-12-09 18:00:35', 'jon'),
(6, 1, 'admin', 15, 'user', 'We hear your Complain.', 'We will soon update your payment in your dashboard', 'unread', '2025-12-07 12:54:33', NULL),
(11, 15, 'user', 1, 'admin', 'hi', 'hello', 'unread', '2025-12-08 08:52:48', 'jon'),
(13, 1, 'admin', 15, 'user', 'ok', 'ahoy', 'unread', '2025-12-09 18:01:13', 'admin'),
(14, 1, 'admin', 15, 'user', 'tu samjha ', 'ya ni', 'unread', '2025-12-09 18:01:27', 'admin'),
(15, 1, 'admin', 15, 'user', 'nh', 'hh', 'unread', '2025-12-10 07:29:08', 'admin'),
(16, 1, 'admin', 15, 'user', 'ff', 'kj', 'unread', '2025-12-10 07:32:35', 'admin'),
(17, 30, 'user', 1, 'admin', 'Payment issue', 'update my dashboard', 'unread', '2025-12-10 07:38:06', 'toren'),
(18, 1, 'admin', 30, 'user', 'Reply to toren', 'we will soon update your dashboard', 'unread', '2025-12-10 07:38:56', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `sens_news`
--

DROP TABLE IF EXISTS `sens_news`;
CREATE TABLE IF NOT EXISTS `sens_news` (
  `news_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `news_date` date NOT NULL,
  `status` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `news_img` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `toshow_type` enum('all','zone','city','member') COLLATE utf8mb4_unicode_ci DEFAULT 'all',
  `toshow_id` int DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sens_news`
--

INSERT INTO `sens_news` (`news_id`, `title`, `description`, `created_at`, `news_date`, `status`, `news_img`, `toshow_type`, `toshow_id`, `created_by`) VALUES
(4, 'National Jain Education Mission Announced', 'The All India Jain Federation officially announced the National Jain Education Mission 2026, a landmark nationwide initiative aimed at uplifting Jain students through structured educational support. Under this mission, thousands of deserving students from economically weaker backgrounds will receive merit-based and need-based scholarships for school, college, and professional courses such as engineering, medical, law, and management.\r\n\r\nIn addition to financial aid, the mission will also provide free digital learning resources, online coaching for competitive exams, career mentorship programs, and guidance sessions conducted by industry experts and senior academicians. The initiative focuses on empowering youth with ethical values, modern education tools, and career-oriented skills, strengthening the future of the Jain community across India.', '2025-12-06 19:37:50', '2026-02-12', 'active', '1740376392wallpaperflare.com_wallpaper.jpg', 'all', 0, NULL),
(5, 'All India Jain Digital Donation Platform Launched', 'To bring transparency, convenience, and national-level unity in social service, the Jain community launched a centralized All India Digital Donation Platform in 2026. This secure system allows devotees and donors from anywhere in the country to contribute directly to verified Jain religious trusts, temples, educational institutions, medical services, and disaster relief programs.\r\n\r\nThe platform supports UPI, debit/credit cards, net banking, and international donations, ensuring easy and fast transactions. Every donation is tracked with digital receipts and real-time fund utilization updates. This initiative strengthens trust, accountability, and participation among community members while promoting large-scale humanitarian and welfare projects across India.', '2025-12-06 19:38:27', '2026-06-07', 'active', '1019412388wallpaperflare.com_wallpaper.jpg', 'all', 0, NULL),
(6, 'Jain Community Leads National Tree Plantation Drive', 'In an inspiring step towards environmental responsibility, the Jain community launched a nationwide eco-awareness and plantation campaign named “Green Jain Bharat Mission” in 2026. Thousands of volunteers across multiple states participated in mass plantation drives near temples, schools, highways, villages, and public parks.\r\n\r\nThe campaign focuses on promoting non-violence towards nature, climate awareness, water conservation, and sustainable living among youth and families. Educational workshops, eco-pledge programs, and plastic-free awareness drives were also conducted alongside the plantation events. This movement highlights the Jain philosophy of “Ahimsa towards all living beings,” including nature itself, making it a powerful symbol of spiritual and environmental harmony.', '2025-12-06 19:38:51', '2026-10-18', 'active', '65492357wallpaperflare.com_wallpaper.jpg', 'all', 0, NULL),
(7, 'Urgent Medical Help Required for Society Member', 'Our respected society member is currently undergoing critical medical treatment and urgently requires financial and emotional support. The Jain Society has initiated a special assistance drive for this purpose. All members are requested to come forward with whatever contribution they can make. Even a small help can save a life. Society will ensure complete transparency in fund utilization and regular health updates will be shared with contributors.', '2025-12-07 09:20:38', '2026-09-25', 'active', '1765099238_wallpaperflare.com_wallpaper.jpg', 'zone', 0, NULL),
(8, 'Water Supply & Cleanliness Issue Raised in City Area', 'Several society members from the city have raised concerns regarding irregular water supply and poor sanitation conditions in residential areas. The Jain Society local committee has officially submitted a complaint to the municipal corporation. A city-level inspection will be conducted soon. Residents are requested to cooperate with officials and report any further issues for faster resolution.', '2025-12-07 09:21:36', '2026-03-12', 'active', '1765099296_wallpaperflare.com_wallpaper (2).jpg', 'city', 14, NULL),
(9, 'Illegal Construction & Noise Pollution Issue Reported in Zone', 'Multiple complaints regarding illegal construction activities and late-night noise pollution have been received from different cities within the zone. The Jain Society Zone Committee has taken this matter seriously and has scheduled a joint action meeting with local authorities. Strict action will be taken against violations. Members are advised to maintain discipline and report such issues responsibly.', '2025-12-07 09:22:41', '2026-02-01', 'active', '1765099361_flower.webp', 'member', 18, NULL),
(10, 'rrrfv', 'ewe', '2025-12-11 15:01:46', '2005-08-08', 'active', '1588781114wallpaperflare.com_wallpaper.jpg', 'all', 0, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `sens_past_commity`
--

DROP TABLE IF EXISTS `sens_past_commity`;
CREATE TABLE IF NOT EXISTS `sens_past_commity` (
  `comi_id` int NOT NULL AUTO_INCREMENT,
  `comi_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comi_gender` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comi_post` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comi_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comi_zone` int DEFAULT NULL,
  `comi_city` int DEFAULT NULL,
  `comi_address` text COLLATE utf8mb4_unicode_ci,
  `comi_priority` int DEFAULT '0',
  `comi_duration` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`comi_id`),
  KEY `comi_zone` (`comi_zone`),
  KEY `comi_city` (`comi_city`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sens_past_commity`
--

INSERT INTO `sens_past_commity` (`comi_id`, `comi_name`, `comi_gender`, `comi_post`, `comi_img`, `comi_zone`, `comi_city`, `comi_address`, `comi_priority`, `comi_duration`, `created_by`) VALUES
(2, 'Surya Pratap', 'Male', 'Karya Adhyaksh', 'comi_1765381125.jpg', 8, 19, 'Near Railway Station', 10, '1919-1921', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `sens_payments`
--

DROP TABLE IF EXISTS `sens_payments`;
CREATE TABLE IF NOT EXISTS `sens_payments` (
  `pay_id` int NOT NULL AUTO_INCREMENT,
  `member_id` int NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `payment_for_year` int DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_by` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receipt_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`pay_id`),
  UNIQUE KEY `receipt_no` (`receipt_no`),
  KEY `member_id` (`member_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sens_payments`
--

INSERT INTO `sens_payments` (`pay_id`, `member_id`, `amount`, `payment_date`, `payment_for_year`, `note`, `created_by`, `receipt_no`, `status`) VALUES
(1, 8, 500.00, '2025-12-04 00:00:00', 2026, 'We got your Payment', '0', NULL, ''),
(2, 7, 500.00, '2025-12-04 00:00:00', 2026, 'Okay we got your money', '0', NULL, ''),
(3, 7, 500.00, '2025-12-05 00:00:00', 2027, 'We got you payment', '0', NULL, ''),
(25, 18, 500.00, '2025-12-05 00:00:00', 2025, NULL, NULL, 'JS380611', '');

--
-- Triggers `sens_payments`
--
DROP TRIGGER IF EXISTS `auto_receipt_no`;
DELIMITER $$
CREATE TRIGGER `auto_receipt_no` BEFORE INSERT ON `sens_payments` FOR EACH ROW BEGIN
   SET NEW.receipt_no = CONCAT(
        'JS',
        FLOOR(100000 + RAND() * 900000)
   );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sens_plans`
--

DROP TABLE IF EXISTS `sens_plans`;
CREATE TABLE IF NOT EXISTS `sens_plans` (
  `plan_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration_days` int DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`plan_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sens_plans`
--

INSERT INTO `sens_plans` (`plan_id`, `name`, `price`, `duration_days`, `created_by`) VALUES
(1, 'Yearly', 500.00, 365, NULL),
(2, 'Lifetime', 5100.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sens_plan_requests`
--

DROP TABLE IF EXISTS `sens_plan_requests`;
CREATE TABLE IF NOT EXISTS `sens_plan_requests` (
  `req_id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_id` int DEFAULT NULL,
  `request_date` date DEFAULT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`req_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sens_plan_requests`
--

INSERT INTO `sens_plan_requests` (`req_id`, `user_id`, `plan_id`, `request_date`, `status`, `created_by`) VALUES
(3, '7', 1, '2025-12-04', 'approved', NULL),
(4, '10', 1, '2025-12-05', 'approved', NULL),
(5, '11', 1, '2025-12-05', 'approved', NULL),
(6, '7', 1, '2025-12-05', 'pending', NULL),
(8, '13', 1, '2025-12-05', 'approved', NULL),
(15, '19', 1, '2025-12-07', 'approved', NULL),
(14, '18', 1, NULL, 'approved', NULL),
(16, '', 0, NULL, 'approved', NULL),
(17, '', 0, NULL, 'approved', NULL),
(18, '', 0, NULL, 'approved', NULL),
(19, '', 0, NULL, 'approved', NULL),
(20, '', 0, NULL, 'approved', NULL),
(21, '20', 1, NULL, 'approved', NULL),
(22, '21', 2, NULL, 'approved', NULL),
(23, '24', 2, NULL, 'approved', 'admin'),
(24, '', 0, NULL, 'approved', 'admin'),
(25, '', 0, NULL, 'approved', 'admin'),
(26, '', 0, NULL, 'approved', 'admin'),
(27, '', 0, NULL, 'approved', 'admin'),
(28, '', 0, NULL, 'approved', 'admin'),
(29, '', 0, NULL, 'approved', 'admin'),
(30, '29', 1, '2025-12-09', 'approved', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `sens_receipt`
--

DROP TABLE IF EXISTS `sens_receipt`;
CREATE TABLE IF NOT EXISTS `sens_receipt` (
  `receipt_id` int NOT NULL AUTO_INCREMENT,
  `member_id` int NOT NULL,
  `receipt_date` datetime NOT NULL,
  `receipt_amount` int NOT NULL,
  `purpose` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `manualID` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receipt_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recdate` date NOT NULL,
  PRIMARY KEY (`receipt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=165 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sens_receipt`
--

INSERT INTO `sens_receipt` (`receipt_id`, `member_id`, `receipt_date`, `receipt_amount`, `purpose`, `manualID`, `created_by`, `receipt_type`, `recdate`) VALUES
(155, 18, '2025-12-06 11:19:02', 500, 'Membership yearly fees received-Cash', '186', NULL, '', '0000-00-00'),
(156, 18, '2025-12-06 11:20:41', 100, 'Monthly Cleaning Fee received', '188', NULL, '', '0000-00-00'),
(157, 18, '2025-12-06 11:38:39', 350, 'Payment received for both diwali event 2k25 and up', '236', NULL, '', '0000-00-00'),
(158, 18, '2025-12-07 13:33:21', 100, 'plantation fee received', '568', NULL, '', '0000-00-00'),
(159, 20, '2025-12-08 09:00:19', 1500, 'mujhe aapka 3 saal ka paisa mil chuka h', '5645', 'admin', 'Yearly Fee', '0000-00-00'),
(160, 18, '2025-12-08 09:01:11', 1500, 'mujhe aapka 3 saal ka paisa mil chuka h', '999', 'admin', 'Yearly Fee', '0000-00-00'),
(161, 20, '2025-12-08 09:26:13', 150, 'ye fee society k personal reasons se kata h', '54', 'admin', 'Others', '0000-00-00'),
(162, 29, '2025-12-11 10:09:03', 200, 'Money received by Tywin', '8753', 'admin', 'Yearly Fee', '0000-00-00'),
(163, 18, '2025-12-11 18:04:06', 100, 'Monthly Cleaning', '4102', 'admin', 'Others', '2025-12-11'),
(164, 18, '2025-12-11 18:05:11', 50, 'holi chanda', '780', 'admin', 'Others', '2025-12-09');

-- --------------------------------------------------------

--
-- Table structure for table `sens_requests`
--

DROP TABLE IF EXISTS `sens_requests`;
CREATE TABLE IF NOT EXISTS `sens_requests` (
  `request_id` int NOT NULL AUTO_INCREMENT,
  `member_id` int NOT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `request_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `approved_date` datetime DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sens_requests`
--

INSERT INTO `sens_requests` (`request_id`, `member_id`, `status`, `request_date`, `approved_date`, `created_by`) VALUES
(1, 4, 'approved', '2025-12-03 22:40:20', '2025-12-04 18:46:09', NULL),
(2, 5, 'approved', '2025-12-04 18:57:37', NULL, NULL),
(3, 6, 'approved', '2025-12-04 19:01:11', NULL, NULL),
(4, 7, 'approved', '2025-12-04 19:02:17', '2025-12-05 09:33:54', NULL),
(5, 8, 'approved', '2025-12-04 20:18:26', '2025-12-04 23:22:56', NULL),
(6, 10, 'approved', '2025-12-05 01:10:01', '2025-12-05 01:10:01', NULL),
(7, 11, 'approved', '2025-12-05 01:15:35', '2025-12-05 01:15:35', NULL),
(9, 13, 'approved', '2025-12-05 12:47:29', '2025-12-05 12:47:29', NULL),
(16, 20, 'approved', '2025-12-07 20:56:12', '2025-12-07 21:18:57', NULL),
(15, 19, 'approved', '2025-12-07 19:19:57', '2025-12-07 19:19:57', NULL),
(14, 18, 'approved', '2025-12-05 19:15:26', '2025-12-06 00:19:47', NULL),
(17, 21, 'approved', '2025-12-07 22:43:30', '2025-12-07 22:43:53', NULL),
(18, 22, 'approved', '2025-12-07 23:27:49', NULL, NULL),
(19, 23, 'approved', '2025-12-08 16:46:40', NULL, NULL),
(33, 37, 'pending', '2025-12-11 21:06:40', NULL, NULL),
(31, 35, 'approved', '2025-12-11 11:46:01', NULL, 'admin'),
(23, 27, 'approved', '2025-12-09 00:00:56', NULL, NULL),
(24, 28, 'approved', '2025-12-09 22:20:09', NULL, 'admin'),
(25, 29, 'approved', '2025-12-09 22:59:52', '2025-12-09 22:59:52', 'admin'),
(26, 30, 'approved', '2025-12-09 23:08:08', NULL, NULL),
(27, 31, 'approved', '2025-12-09 23:14:10', NULL, 'admin'),
(34, 38, 'pending', '2025-12-11 21:14:33', NULL, NULL),
(29, 33, 'approved', '2025-12-10 18:06:05', NULL, 'admin'),
(32, 36, 'pending', '2025-12-11 20:54:37', NULL, NULL),
(35, 39, 'approved', '2025-12-11 21:27:13', '2025-12-11 21:27:13', 'admin'),
(36, 40, 'approved', '2025-12-11 21:32:20', '2025-12-11 21:32:20', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `sens_states`
--

DROP TABLE IF EXISTS `sens_states`;
CREATE TABLE IF NOT EXISTS `sens_states` (
  `state_id` int NOT NULL AUTO_INCREMENT,
  `state_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sens_states`
--

INSERT INTO `sens_states` (`state_id`, `state_name`, `created_at`, `created_by`) VALUES
(1, 'Chhattisgarh', '2025-12-03 06:35:42', NULL),
(2, 'Chandigarh', '2025-12-03 06:35:51', NULL),
(3, 'Madhya Pradesh', '2025-12-03 11:53:53', NULL),
(4, 'Jharkhand', '2025-12-03 11:55:15', NULL),
(5, 'Rajashthan', '2025-12-03 12:52:19', NULL),
(7, 'Kerala', '2025-12-03 13:50:57', NULL),
(9, 'Maharashtra', '2025-12-03 13:55:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sens_users`
--

DROP TABLE IF EXISTS `sens_users`;
CREATE TABLE IF NOT EXISTS `sens_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '123456',
  `role` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `onboarding` int NOT NULL DEFAULT '0',
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sens_users`
--

INSERT INTO `sens_users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `onboarding`, `created_by`) VALUES
(1, 'admin', 'admin@example.com', 'a', 'admin', '2025-12-03 05:32:57', 1, NULL),
(5, 'vish', '123vishal18910@gmail.co', 'a', 'user', '2025-12-03 06:13:43', 1, NULL),
(6, 'vinujie', 'vishal2104821003patil@gmail.com', '123456', 'user', '2025-12-04 14:48:26', 1, NULL),
(7, 'ram', 'ram@gmail.com', '123456', 'user', '2025-12-04 19:35:49', 1, NULL),
(8, 'sonu', 'sonu@gmail.com', '123456', 'user', '2025-12-04 19:40:01', 1, NULL),
(9, 'surya', 'surya@gmail.com', '123456', 'user', '2025-12-04 19:45:35', 1, NULL),
(18, 'ef', 'radm@gmail.com', 'a', 'user', '2025-12-07 17:13:30', 0, NULL),
(12, 'raj', '000mayank10000@gmail.com', '123456', 'user', '2025-12-05 07:17:29', 1, NULL),
(17, 'rajen', 'rajen@gmail.com', 'a', 'user', '2025-12-07 15:26:12', 0, NULL),
(16, 'shiv', 'shiva@gmail.com', 'a', 'user', '2025-12-07 13:49:57', 1, NULL),
(15, 'jon', 'jon@gmail.com', 'a', 'user', '2025-12-05 13:44:29', 1, NULL),
(19, 'fe', 'jofe@gmail.com', 'fe', 'user', '2025-12-07 17:57:49', 0, NULL),
(20, 'acc', 'acc@gmail,com', 'a', 'accountant', '2025-12-08 06:23:28', 1, 'admin'),
(21, 'Ravi Kumar', 'ravi@gmail.com', '123456', 'user', '2025-12-08 11:16:40', 0, NULL),
(22, 'bb', 'b@gmail.com', '123456', 'user', '2025-12-08 11:25:59', 0, NULL),
(33, 'Ravi kumar patni', 'ravi23@gmail.com', '123456', 'user', '2025-12-11 06:16:01', 0, NULL),
(34, 'end', '', '123456', 'user', '2025-12-11 15:24:37', 0, NULL),
(25, 'efefee', 'e@gmail.com', '123456', 'user', '2025-12-08 18:30:56', 0, NULL),
(26, 'pp', 'p@gmail.com', '123456', 'user', '2025-12-09 16:50:09', 0, NULL),
(27, 'Tywin Lanister', '123vishal184910@gmail.com', '123456', 'user', '2025-12-09 17:29:52', 1, 'admin'),
(29, 'Cersie', '123vis7hal18910@gmail.com', '123456', 'user', '2025-12-09 17:44:10', 0, NULL),
(30, 'toren', 'to@gmail.com', '123456', 'user', '2025-12-10 07:12:09', 0, NULL),
(31, 'Aegon Targaryen', '123vis55hal18910@gmail.com', '123456', 'user', '2025-12-10 12:36:05', 0, NULL),
(35, 'efefef', '', '123456', 'user', '2025-12-11 15:36:40', 0, NULL),
(36, 'ahoy', '', '123456', 'user', '2025-12-11 15:44:33', 0, NULL),
(37, 'okadda', '', '123456', 'user', '2025-12-11 15:56:24', 1, 'admin'),
(38, 'okadda44', '', '123456', 'user', '2025-12-11 15:57:13', 1, 'admin'),
(39, 'Ravi Husain', '', '123456', 'user', '2025-12-11 16:02:20', 1, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `sens_wallet`
--

DROP TABLE IF EXISTS `sens_wallet`;
CREATE TABLE IF NOT EXISTS `sens_wallet` (
  `wallet_id` int NOT NULL AUTO_INCREMENT,
  `member_id` int NOT NULL,
  `amount` int NOT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`wallet_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sens_wallet`
--

INSERT INTO `sens_wallet` (`wallet_id`, `member_id`, `amount`, `created_by`) VALUES
(1, 18, 1500, NULL),
(2, 0, 0, NULL),
(3, 0, 0, NULL),
(4, 0, 0, NULL),
(5, 0, 0, NULL),
(6, 0, 0, NULL),
(7, 20, 0, NULL),
(8, 21, 0, NULL),
(9, 24, 0, 'admin'),
(10, 0, 0, 'admin'),
(11, 0, 0, 'admin'),
(12, 0, 0, 'admin'),
(13, 0, 0, 'admin'),
(14, 0, 0, 'admin'),
(15, 0, 0, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `sens_zones`
--

DROP TABLE IF EXISTS `sens_zones`;
CREATE TABLE IF NOT EXISTS `sens_zones` (
  `zone_id` int NOT NULL AUTO_INCREMENT,
  `zone_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `zstatus` int NOT NULL DEFAULT '1',
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`zone_id`),
  UNIQUE KEY `name` (`zone_name`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sens_zones`
--

INSERT INTO `sens_zones` (`zone_id`, `zone_name`, `zstatus`, `created_by`) VALUES
(5, 'Zone 1', 1, NULL),
(6, 'Zone 2', 1, NULL),
(7, 'Zone 3', 1, 'admin'),
(8, 'Zone 4', 1, NULL),
(9, 'Zone 5', 1, NULL),
(11, 'Zone 7', 1, 'admin'),
(13, 'Zone 67', 1, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
