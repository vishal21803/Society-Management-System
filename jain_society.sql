-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 07, 2025 at 11:32 AM
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
-- Table structure for table `bills`
--

DROP TABLE IF EXISTS `bills`;
CREATE TABLE IF NOT EXISTS `bills` (
  `bill_id` int NOT NULL AUTO_INCREMENT,
  `member_id` int NOT NULL,
  `bill_date` datetime NOT NULL,
  `bill_amount` int NOT NULL,
  `bill_purpose` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`bill_id`, `member_id`, `bill_date`, `bill_amount`, `bill_purpose`) VALUES
(12, 18, '2025-12-06 11:19:30', 200, 'diwali event'),
(11, 18, '2025-12-06 11:18:29', 500, 'Membership yearly fees'),
(13, 18, '2025-12-06 11:19:55', 100, 'Monthly Cleaning'),
(14, 18, '2025-12-06 11:37:29', 150, 'Holi Celebration 2k26');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `city_id` int NOT NULL AUTO_INCREMENT,
  `zone_id` int NOT NULL,
  `city_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cstatus` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`city_id`),
  KEY `zone_id` (`zone_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `zone_id`, `city_name`, `cstatus`) VALUES
(1, 4, 'Bhopal', 1),
(2, 5, 'Durg', 1),
(3, 5, 'Kumhari', 1),
(4, 5, 'Jamul', 1),
(5, 5, 'Bhilai-3', 1),
(6, 6, 'Raipur', 1),
(7, 6, 'Arang', 1),
(8, 6, 'Tilda', 1),
(9, 6, 'Abhanpur', 1),
(10, 6, 'Naya Raipur', 1),
(11, 7, 'Bilaspur', 1),
(12, 7, 'Ratanpur', 1),
(13, 7, 'Takhtapur', 1),
(14, 7, 'Koni', 1),
(16, 8, 'Korba', 1),
(17, 5, 'Katghora', 1),
(18, 8, 'kusmunda', 1),
(19, 8, 'Deepka', 1),
(20, 8, 'Chhuri', 1),
(21, 9, 'Raigarh', 1),
(22, 10, 'Dantewada seher', 1),
(23, 11, 'Kondagaon', 1),
(24, 11, 'Bastar', 1);

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

DROP TABLE IF EXISTS `downloads`;
CREATE TABLE IF NOT EXISTS `downloads` (
  `id` int NOT NULL AUTO_INCREMENT,
  `topic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `downshow` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `downloads`
--

INSERT INTO `downloads` (`id`, `topic`, `remark`, `file_name`, `created_at`, `downshow`) VALUES
(1, 'Maintenance Bill-15324', 'This is the receipt of yearly maintenance in our society.', '1764937140_My Resume.pdf', '2025-12-05 12:11:53', 'general'),
(3, 'Rozjaar yojna', 'Fill the Form to get a Job', '1765006268_wallpaperflare.com_wallpaper.jpg', '2025-12-06 07:31:08', 'members');

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
  `event_time` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_location` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_img` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `toshow_type` enum('all','zone','city','member') COLLATE utf8mb4_unicode_ci DEFAULT 'all',
  `toshow_id` int DEFAULT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `title`, `description`, `event_date`, `created_at`, `event_time`, `event_location`, `event_status`, `event_img`, `toshow_type`, `toshow_id`) VALUES
(5, 'Annual Jain Dharma Pravachan', 'An inspirational spiritual discourse on positive living, self-control, and inner peace.', '2026-01-21', '2025-12-06 19:21:29', '6:30 PM – 8:30 PM', 'Jain Community Hall', 'upcoming', 'pray.jpg', 'city', 2),
(6, 'Jain Matrimonial Meet 2026', 'A well-organized matrimonial interaction program for Jain youth from various cities.', '2026-03-08', '2025-12-06 19:26:18', '10:00 AM – 4:00 PM', 'Grand Banqut Hall', 'upcoming', '', 'zone', 5),
(7, 'Jain Business Network Meet', 'A professional networking event for Jain entrepreneurs and business owners.', '2026-06-12', '2025-12-06 19:27:54', '11:00 AM - 5:00 PM', 'Jain Conference Center', 'upcoming', '', 'member', 10),
(8, 'All India Jain Dharma Mahasangam 2026', 'A grand three-day national-level Jain spiritual gathering with Pravachans, cultural programs, youth activities, and social awareness sessions attended by Jain communities from across India.', '2026-01-24', '2025-12-06 19:32:25', '10:00 AM – 8:00 PM', 'National Convention Center, India', 'upcoming', '', 'all', 0),
(9, 'National Jain Youth Leadership Summit', 'A leadership and personality development summit for Jain youth focused on entrepreneurship, ethics, career growth, and innovation.', '2026-05-15', '2025-12-06 19:33:20', '9:00 AM – 6:00 PM', 'India International Convention Venue', 'upcoming', '', 'all', 0),
(10, 'All India Jain Business & Startup Expo', 'A nationwide business exhibition featuring Jain entrepreneurs, manufacturers, startups, and investors to promote trade and collaboration', '2026-09-20', '2025-12-06 19:34:08', '10:00 AM – 7:00 PM', 'India Expo Mart', 'upcoming', '', 'all', 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`gallery_id`, `title`, `description`, `visibility_type`, `zone_id`, `city_id`, `member_id`, `image`, `created_at`) VALUES
(5, 'Mahavir Jayanti Celebration', 'A nationwide celebration of Lord Mahavir Jayanti observed with grand processions, special prayers, pravachans, bhajan sandhya, and community service activities across Jain temples in India. Devotees participated with devotion, peace, and spiritual enthusiasm.', 'all', 0, 0, 0, '1765093066_mahavir-jayanti-f.webp', '2025-12-07 13:07:46'),
(6, 'Diwali & Nirvan Divas Mahotsav', 'Diwali was celebrated across the Jain community as the Nirvan Divas of Lord Mahavir with deep spiritual significance. Temples were illuminated with diyas, special pujas were performed, and messages of non-violence, truth, and self-discipline were spread.', 'all', 0, 0, 0, '1765093175_diwal.jpg', '2025-12-07 13:09:35'),
(7, 'Festival of Colors – Holi Utsav', 'The festival of Holi was celebrated with joy, unity, and cultural programs. Community members enjoyed flower Holi, traditional music, dance performances, and social bonding while promoting harmony and brotherhood.', 'all', 0, 0, 0, '1765093215_holi.webp', '2025-12-07 13:10:15'),
(8, 'Zone Level Jain Sports Meet', '', 'zone', 5, 0, 0, '1765095294_sports.jpg', '2025-12-07 13:44:54'),
(9, ' City Jain Blood Donation Camp', '', 'city', 0, 12, 0, '1765095426_2171-blood-donation.jpg', '2025-12-07 13:47:06'),
(10, 'My Personal Membership Anniversary', '', 'member', 0, 0, 18, '1765095510_flower.webp', '2025-12-07 13:48:30');

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
  `balance_amount` float NOT NULL,
  PRIMARY KEY (`member_id`),
  KEY `user_id` (`user_id`),
  KEY `zone_id` (`zone_id`),
  KEY `city_id` (`city_id`),
  KEY `plan_id` (`plan_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `user_id`, `zone_id`, `city_id`, `plan_id`, `gender`, `dob`, `membership_start`, `membership_end`, `phone`, `address`, `photo`, `created_at`, `fullname`, `balance_amount`) VALUES
(11, 9, 5, 4, 2, 'Male', '1988-09-01', '2025-12-04', '2026-11-04', '7985122998', 'Near Puri ITI,kohka', '1764877535_logo.png', '2025-12-04 19:45:35', 'Surya Naik', 0),
(7, 5, 5, 5, 1, 'Male', '1999-05-17', '2025-12-04', '2026-12-04', '1234567890', 'Kurud', '1764855137_AEGON_I.jpg', '2025-12-04 13:32:17', 'Vish', 0),
(10, 8, 7, 12, 1, 'Male', '2025-12-13', '2025-12-04', '2026-12-04', '8234567890', 'Near railway station,Kohka', '1764877201_wallpaperflare.com_wallpaper (2).jpg', '2025-12-04 19:40:01', 'Sonu kumar', 0),
(13, 12, 6, 6, 1, 'Male', '1991-11-19', '2025-12-05', '2026-12-05', '1234567890', 'Near magneto', '1764919049_logo.png', '2025-12-05 07:17:29', 'Rajiv', 0),
(18, 15, 7, 14, 1, 'Male', '1994-11-11', '2025-12-04', '2026-12-04', '1234567890', 'Near Station', '1764942326_wallpaperflare.com_wallpaper.jpg', '2025-12-05 13:45:26', 'Jon Snow', 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `title`, `description`, `created_at`, `news_date`, `status`, `news_img`, `toshow_type`, `toshow_id`) VALUES
(4, 'National Jain Education Mission Announced', 'The All India Jain Federation officially announced the National Jain Education Mission 2026, a landmark nationwide initiative aimed at uplifting Jain students through structured educational support. Under this mission, thousands of deserving students from economically weaker backgrounds will receive merit-based and need-based scholarships for school, college, and professional courses such as engineering, medical, law, and management.\r\n\r\nIn addition to financial aid, the mission will also provide free digital learning resources, online coaching for competitive exams, career mentorship programs, and guidance sessions conducted by industry experts and senior academicians. The initiative focuses on empowering youth with ethical values, modern education tools, and career-oriented skills, strengthening the future of the Jain community across India.', '2025-12-06 19:37:50', '2026-02-12', 'active', '1740376392wallpaperflare.com_wallpaper.jpg', 'all', 0),
(5, 'All India Jain Digital Donation Platform Launched', 'To bring transparency, convenience, and national-level unity in social service, the Jain community launched a centralized All India Digital Donation Platform in 2026. This secure system allows devotees and donors from anywhere in the country to contribute directly to verified Jain religious trusts, temples, educational institutions, medical services, and disaster relief programs.\r\n\r\nThe platform supports UPI, debit/credit cards, net banking, and international donations, ensuring easy and fast transactions. Every donation is tracked with digital receipts and real-time fund utilization updates. This initiative strengthens trust, accountability, and participation among community members while promoting large-scale humanitarian and welfare projects across India.', '2025-12-06 19:38:27', '2026-06-07', 'active', '1019412388wallpaperflare.com_wallpaper.jpg', 'all', 0),
(6, 'Jain Community Leads National Tree Plantation Drive', 'In an inspiring step towards environmental responsibility, the Jain community launched a nationwide eco-awareness and plantation campaign named “Green Jain Bharat Mission” in 2026. Thousands of volunteers across multiple states participated in mass plantation drives near temples, schools, highways, villages, and public parks.\r\n\r\nThe campaign focuses on promoting non-violence towards nature, climate awareness, water conservation, and sustainable living among youth and families. Educational workshops, eco-pledge programs, and plastic-free awareness drives were also conducted alongside the plantation events. This movement highlights the Jain philosophy of “Ahimsa towards all living beings,” including nature itself, making it a powerful symbol of spiritual and environmental harmony.', '2025-12-06 19:38:51', '2026-10-18', 'active', '65492357wallpaperflare.com_wallpaper.jpg', 'all', 0),
(7, 'Urgent Medical Help Required for Society Member', 'Our respected society member is currently undergoing critical medical treatment and urgently requires financial and emotional support. The Jain Society has initiated a special assistance drive for this purpose. All members are requested to come forward with whatever contribution they can make. Even a small help can save a life. Society will ensure complete transparency in fund utilization and regular health updates will be shared with contributors.', '2025-12-07 09:20:38', '2026-09-25', 'active', '1765099238_wallpaperflare.com_wallpaper.jpg', 'zone', 0),
(8, 'Water Supply & Cleanliness Issue Raised in City Area', 'Several society members from the city have raised concerns regarding irregular water supply and poor sanitation conditions in residential areas. The Jain Society local committee has officially submitted a complaint to the municipal corporation. A city-level inspection will be conducted soon. Residents are requested to cooperate with officials and report any further issues for faster resolution.', '2025-12-07 09:21:36', '2026-03-12', 'active', '1765099296_wallpaperflare.com_wallpaper (2).jpg', 'city', 14),
(9, 'Illegal Construction & Noise Pollution Issue Reported in Zone', 'Multiple complaints regarding illegal construction activities and late-night noise pollution have been received from different cities within the zone. The Jain Society Zone Committee has taken this matter seriously and has scheduled a joint action meeting with local authorities. Strict action will be taken against violations. Members are advised to maintain discipline and report such issues responsibly.', '2025-12-07 09:22:41', '2026-02-01', 'active', '1765099361_flower.webp', 'member', 18);

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
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_by` int DEFAULT NULL,
  `receipt_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`pay_id`),
  UNIQUE KEY `receipt_no` (`receipt_no`),
  KEY `member_id` (`member_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`pay_id`, `member_id`, `amount`, `payment_date`, `payment_for_year`, `note`, `created_by`, `receipt_no`, `status`) VALUES
(1, 8, 500.00, '2025-12-04 00:00:00', 2026, 'We got your Payment', 0, NULL, ''),
(2, 7, 500.00, '2025-12-04 00:00:00', 2026, 'Okay we got your money', 0, NULL, ''),
(3, 7, 500.00, '2025-12-05 00:00:00', 2027, 'We got you payment', 0, NULL, ''),
(25, 18, 500.00, '2025-12-05 00:00:00', 2025, NULL, NULL, 'JS380611', '');

--
-- Triggers `payments`
--
DROP TRIGGER IF EXISTS `auto_receipt_no`;
DELIMITER $$
CREATE TRIGGER `auto_receipt_no` BEFORE INSERT ON `payments` FOR EACH ROW BEGIN
   SET NEW.receipt_no = CONCAT(
        'JS',
        FLOOR(100000 + RAND() * 900000)
   );
END
$$
DELIMITER ;

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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plan_requests`
--

INSERT INTO `plan_requests` (`req_id`, `user_id`, `plan_id`, `request_date`, `status`) VALUES
(3, '7', 1, '2025-12-04', 'approved'),
(4, '10', 1, '2025-12-05', 'approved'),
(5, '11', 1, '2025-12-05', 'approved'),
(6, '7', 1, '2025-12-05', 'pending'),
(8, '13', 1, '2025-12-05', 'approved'),
(14, '18', 1, NULL, 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

DROP TABLE IF EXISTS `receipt`;
CREATE TABLE IF NOT EXISTS `receipt` (
  `receipt_id` int NOT NULL AUTO_INCREMENT,
  `member_id` int NOT NULL,
  `receipt_date` datetime NOT NULL,
  `receipt_amount` int NOT NULL,
  `purpose` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `manualID` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`receipt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=158 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`receipt_id`, `member_id`, `receipt_date`, `receipt_amount`, `purpose`, `manualID`) VALUES
(155, 18, '2025-12-06 11:19:02', 500, 'Membership yearly fees received-Cash', '186'),
(156, 18, '2025-12-06 11:20:41', 100, 'Monthly Cleaning Fee received', '188'),
(157, 18, '2025-12-06 11:38:39', 350, 'Payment received for both diwali event 2k25 and up', '236');

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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(7, 11, 'approved', '2025-12-05 01:15:35', '2025-12-05 01:15:35'),
(9, 13, 'approved', '2025-12-05 12:47:29', '2025-12-05 12:47:29'),
(14, 18, 'approved', '2025-12-05 19:15:26', '2025-12-06 00:19:47');

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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `onboarding`) VALUES
(1, 'admin', 'admin@example.com', 'a', 'admin', '2025-12-03 05:32:57', 1),
(5, 'vish', '123vishal18910@gmail.com', 'a', 'user', '2025-12-03 06:13:43', 1),
(6, 'vinujie', 'vishal2104821003patil@gmail.com', '123456', 'user', '2025-12-04 14:48:26', 1),
(7, 'ram', 'ram@gmail.com', '123456', 'user', '2025-12-04 19:35:49', 1),
(8, 'sonu', 'sonu@gmail.com', '123456', 'user', '2025-12-04 19:40:01', 1),
(9, 'surya', 'surya@gmail.com', '123456', 'user', '2025-12-04 19:45:35', 1),
(12, 'raj', '000mayank10000@gmail.com', '123456', 'user', '2025-12-05 07:17:29', 1),
(15, 'jon', 'jon@gmail.com', 'a', 'user', '2025-12-05 13:44:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

DROP TABLE IF EXISTS `wallet`;
CREATE TABLE IF NOT EXISTS `wallet` (
  `wallet_id` int NOT NULL AUTO_INCREMENT,
  `member_id` int NOT NULL,
  `amount` int NOT NULL,
  PRIMARY KEY (`wallet_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`wallet_id`, `member_id`, `amount`) VALUES
(1, 18, 1500);

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

DROP TABLE IF EXISTS `zones`;
CREATE TABLE IF NOT EXISTS `zones` (
  `zone_id` int NOT NULL AUTO_INCREMENT,
  `zone_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `zstatus` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`zone_id`),
  UNIQUE KEY `name` (`zone_name`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zones`
--

INSERT INTO `zones` (`zone_id`, `zone_name`, `zstatus`) VALUES
(5, 'Durg/Bhilai-Zone 1', 1),
(6, 'Raipur-Zone 2', 1),
(7, 'Bilaspur-Zone 3', 1),
(8, 'Korba-Zone 4', 1),
(9, 'Raigarh-Zone 5', 1),
(11, 'Jagdalpur-Zone 7', 1),
(13, 'zone 67', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
