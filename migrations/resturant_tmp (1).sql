-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2017 at 05:49 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `resturant_tmp`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
`emp_id` int(11) NOT NULL,
  `emp_name` varchar(256) NOT NULL,
  `emp_lname` varchar(256) NOT NULL,
  `emp_position` varchar(120) NOT NULL,
  `emp_salary` decimal(10,0) NOT NULL,
  `emp_join_date` varchar(16) DEFAULT NULL,
  `emp_org_place` varchar(256) NOT NULL,
  `emp_cur_place` varchar(256) NOT NULL,
  `emp_address` text NOT NULL,
  `emp_email` varchar(256) DEFAULT NULL,
  `emp_phone` char(16) NOT NULL,
  `emp_gendar` tinyint(1) NOT NULL,
  `emp_picture` varchar(256) NOT NULL,
  `emp_national_id` char(16) DEFAULT NULL,
  `emp_biography` text,
  `emp_type` tinyint(1) NOT NULL COMMENT 'آشپزخانه یا رستورانت'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_id`, `emp_name`, `emp_lname`, `emp_position`, `emp_salary`, `emp_join_date`, `emp_org_place`, `emp_cur_place`, `emp_address`, `emp_email`, `emp_phone`, `emp_gendar`, `emp_picture`, `emp_national_id`, `emp_biography`, `emp_type`) VALUES
(1, 'احمد', 'احمدی', 'گارسون', '15000', '2017-10-21 22:16', 'کابل', 'هرات', 'شهر نو کابل افغانستان', 'email@domain.com', '0780525265', 0, 'picture.jpg', '456789', NULL, 0),
(3, 'احمد', 'احمدی', 'مدیر کل', '15000', '2017-10-21 22:16', 'کابل', 'هرات', 'شهر نو کابل افغانستان', 'email@domain.com', '0780525265', 0, 'picture.jpg', '456789', NULL, 1),
(4, 'احمد', 'احمدی', 'گارسون', '15000', '2017-10-21 22:16', 'کابل', 'هرات', 'شهر نو کابل افغانستان', 'email@domain.com', '0780525265', 0, 'picture.jpg', '456789', NULL, 0),
(6, 'محمد', 'میرزائی', 'مدیر مسئول', '15000', '0000-00-00 00:00', 'دایکندی ', 'کابل', 'کابل چهار قلعه وزیر آباد کوچه گل شب بو پلاک 52 نرسیده به سرک 7 بیست متری کوکاکولا.', 'email@domain.com', '078585454', 1, 'avatar04.png', '5865485', 'ویژگی های قالب و تفاوت های آن با قالب اصلی:\r\n\r\n۱- قالب به صورت کامل و حرفه ای فارسی و راست چین شده.\r\n\r\n۲- انتخاب تاریخ به صورت شمسی یا دیتا پیکر توسط کتاب خانه باباخانی اضافه شده.\r\n\r\n۳- ویرایشگر CK Editor فارسی و راست چین شده.\r\n\r\n۴- ویرایشگر TinyMCE فارسی و راست چین شده و به قالب اضافه شده.\r\n\r\n۵- همچنین فونت فارسی برای خوانایی بیشتر حروف و اعداد فارسی به قالب افزوده شد.\r\n\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
`job_id` int(11) NOT NULL,
  `job_name` varchar(256) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `job_name`) VALUES
(1, 'مدیر مسئول'),
(2, 'مدیر مالی'),
(3, 'مدیر گدام'),
(4, 'آشپز'),
(5, 'سر آشپز'),
(6, 'صفاکار'),
(7, 'درایور');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(5) unsigned NOT NULL,
  `user_name` varchar(256) NOT NULL,
  `user_type` varchar(256) NOT NULL,
  `user_pass` varchar(256) NOT NULL,
  `emp_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_type`, `user_pass`, `emp_id`) VALUES
(3, 'djamshidelmio', '1', '12311231', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
 ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
 ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`), ADD KEY `emp_id` (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
