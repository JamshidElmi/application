-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2017 at 08:16 PM
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
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
`acc_id` int(11) NOT NULL,
  `acc_name` varchar(256) NOT NULL,
  `acc_amount` decimal(10,2) NOT NULL,
  `acc_description` varchar(512) DEFAULT NULL COMMENT 'توضیحات',
  `acc_date` varchar(16) NOT NULL,
  `acc_type` tinyint(4) NOT NULL COMMENT 'عدد 0 برای صندوق اصلی عدد 1 برای حساب همکاران عدد 2 برای حساب مشتریان'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`acc_id`, `acc_name`, `acc_amount`, `acc_description`, `acc_date`, `acc_type`) VALUES
(14, 'صندوق', '1000.00', '', '1509303898', 0);

-- --------------------------------------------------------

--
-- Table structure for table `company_info`
--

CREATE TABLE IF NOT EXISTS `company_info` (
`ci_id` int(11) NOT NULL,
  `ci_full_name` varchar(256) NOT NULL,
  `ci_boss_name` varchar(256) NOT NULL,
  `ci_manager_name` varchar(256) NOT NULL,
  `ci_address` text NOT NULL,
  `ci_phones` varchar(128) NOT NULL,
  `ci_emails` varchar(256) NOT NULL,
  `ci_logo` varchar(256) NOT NULL,
  `ci_constitute_date` varchar(16) NOT NULL COMMENT 'سال تاسیس',
  `ci_website` varchar(64) NOT NULL,
  `ci_type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `daily_expences`
--

CREATE TABLE IF NOT EXISTS `daily_expences` (
`dex_id` int(11) NOT NULL,
  `dex_bill_no` varchar(16) DEFAULT NULL,
  `dex_shop` varchar(256) DEFAULT NULL COMMENT 'اگر از بیرون بود نام دوکان/اگر از داخل بود فقط کلمه گدام',
  `dex_name` varchar(256) NOT NULL,
  `dex_price` decimal(10,2) NOT NULL,
  `dex_count` int(11) NOT NULL,
  `dex_unit` int(11) NOT NULL COMMENT 'واحد مقیاسی',
  `dex_total_amount` decimal(10,2) NOT NULL,
  `dex_desc` varchar(512) NOT NULL,
  `dex_date` varchar(16) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `daily_expences`
--

INSERT INTO `daily_expences` (`dex_id`, `dex_bill_no`, `dex_shop`, `dex_name`, `dex_price`, `dex_count`, `dex_unit`, `dex_total_amount`, `dex_desc`, `dex_date`) VALUES
(2, '3453', 'sdf', 'sdf', '44.00', 4, 13, '444.00', 'asdfas adf', '34523452'),
(3, '3453', 'sdf', 'sdf', '44.00', 4, 16, '444.00', 'asdfas adf', '34523452'),
(4, '3453', 'sdf', 'sdf', '44.00', 4, 19, '444.00', 'asdfas adf', '34523452'),
(5, '3453', 'sdf', 'sdf', '44.00', 4, 19, '444.00', 'asdfas adf', '34523452'),
(6, '3453', 'sdf', 'sdf', '44.00', 4, 19, '444.00', 'asdfas adf', '34523452'),
(7, '3453', 'sdf', 'sdf', '44.00', 4, 13, '444.00', 'asdfas adf', '34523452'),
(8, '3453', 'sdf', 'sdf', '44.00', 4, 19, '444.00', 'asdfas adf', '34523452'),
(9, '3453', 'sdf', 'sdf', '44.00', 4, 19, '444.00', 'asdfas adf', '34523452');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_id`, `emp_name`, `emp_lname`, `emp_position`, `emp_salary`, `emp_join_date`, `emp_org_place`, `emp_cur_place`, `emp_address`, `emp_email`, `emp_phone`, `emp_gendar`, `emp_picture`, `emp_national_id`, `emp_biography`, `emp_type`) VALUES
(1, 'کریم', 'کاظمی', 'مدیر گدام', '15000', '1508956089', 'کابل', 'هرات', 'شهر نو کابل افغانستان ین قالب به صورت هست و برای بخش کنترل پنل و مدیریت سایت های مختلف مناسب می باشد.\r\n\r\nنسخه اصلی این قالب می باشد که توسط به صورت رایگان قرار داده شده است. شهر نو کابل افغانستان ین قالب به صورت هست و برای بخش کنترل پنل و مدیریت سایت های مختلف مناسب می باشد.\r\n\r\nنسخه اصلی این قالب می باشد که توسط به صورت رایگان قرار داده شده است.', 'email@domain.com', '0780525265', 1, 'avatar51.png', '0255', 'شهر نو کابل افغانستان ین قالب به صورت هست و برای بخش کنترل پنل و مدیریت سایت های مختلف مناسب می باشد.\r\n\r\nنسخه اصلی این قالب می باشد که توسط به صورت رایگان قرار داده شده است. شهر نو کابل افغانستان ین قالب به صورت هست و برای بخش کنترل پنل و مدیریت سایت های مختلف مناسب می باشد. نسخه اصلی این قالب می باشد که توسط به صورت رایگان قرار داده شده است. شهر نو کابل افغانستان ین قالب به صورت هست و برای بخش کنترل پنل و مدیریت سایت های مختلف مناسب می باشد.\r\n\r\nنسخه اصلی این قالب می باشد که توسط به صورت رایگان قرار داده شده است.', 0),
(3, 'سارا', 'شهیدی', 'سر آشپز', '15000', '1508863039', 'کابل', 'هرات', 'شهر نو کابل افغانستان', 'email@domain.com', '0780525265', 0, 'avatar2.png', '456789', '', 0),
(6, 'محمد', 'میرزائی', 'مدیر مسئول', '15000', '1508863321', 'دایکندی ', 'کابل', 'کابل چهار قلعه وزیر آباد کوچه گل شب بو پلاک 52 نرسیده به سرک 7 بیست متری کوکاکولا.', 'email@domain.com', '078585454', 1, 'avatar04.png', '5865485', 'ویژگی های قالب و تفاوت های آن با قالب اصلی:\r\n\r\n۱- قالب به صورت کامل و حرفه ای فارسی و راست چین شده.\r\n\r\n۲- انتخاب تاریخ به صورت شمسی یا دیتا پیکر توسط کتاب خانه باباخانی اضافه شده.\r\n\r\n۳- ویرایشگر CK Editor فارسی و راست چین شده.\r\n\r\n۴- ویرایشگر TinyMCE فارسی و راست چین شده و به قالب اضافه شده.\r\n\r\n۵- همچنین فونت فارسی برای خوانایی بیشتر حروف و اعداد فارسی به قالب افزوده شد.\r\n\r\n', 0),
(7, 'رضا', 'شایان', 'مدیر گدام', '5000', '1509375783', 'بامیان', 'کابل ', 'چهار قلعه وزیر آباد فلان سرک فلان کوچه ', 'reza@farakhaan.com', '078565475', 1, 'avatar.png', '45685', 'کارمند خوب', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
`job_id` int(11) NOT NULL,
  `job_name` varchar(256) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

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
(7, 'درایور'),
(8, 'اجیر'),
(10, 'سرباز'),
(11, 'گارد'),
(13, 'وظیفه جدید');

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
-- Table structure for table `stocks`
--

CREATE TABLE IF NOT EXISTS `stocks` (
`st_id` int(11) NOT NULL,
  `st_name` varchar(256) NOT NULL,
  `st_unit` varchar(256) NOT NULL COMMENT 'واحد مقیاسی',
  `st_count` int(11) NOT NULL,
  `st_price` decimal(10,2) NOT NULL,
  `st_total_price` decimal(10,0) NOT NULL COMMENT 'قیمت مجموعی از یک واحد جنس',
  `st_max_count` int(11) NOT NULL COMMENT 'حد اکثر مقدار قابل گنجایش در گدام',
  `st_min_count` int(11) NOT NULL COMMENT 'تعداد قابل هشدار',
  `st_date` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transections`
--

CREATE TABLE IF NOT EXISTS `transections` (
`tr_id` int(11) NOT NULL,
  `tr_desc` varchar(512) DEFAULT NULL,
  `tr_amount` decimal(10,2) NOT NULL,
  `tr_type` varchar(32) NOT NULL COMMENT 'نوعیت تراکنش: معاش/برداشت/ جمع/ مصارف/',
  `tr_date` varchar(16) NOT NULL,
  `tr_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'عدد 2 برای برداشت عدد 1 برای جمع',
  `tr_acc_id` int(11) DEFAULT NULL COMMENT 'ای دی صندوق'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transections`
--

INSERT INTO `transections` (`tr_id`, `tr_desc`, `tr_amount`, `tr_type`, `tr_date`, `tr_status`, `tr_acc_id`) VALUES
(1, '', '1000.00', 'credit_debit', '1509372633', 1, 14);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE IF NOT EXISTS `units` (
`unit_id` int(11) NOT NULL,
  `unit_name` varchar(256) NOT NULL,
  `unit_type` tinyint(1) NOT NULL COMMENT 'آشپزخانه/رستورانت'
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_id`, `unit_name`, `unit_type`) VALUES
(4, 'عدد', 0),
(12, 'بسته', 1),
(13, 'خوراک', 1),
(15, 'بسته', 0),
(16, 'سیت', 1),
(17, 'کریت', 1),
(18, 'کیلو', 0),
(19, 'سیر', 0),
(20, 'پاو', 0),
(21, 'چهاریک', 0),
(22, 'دقیقه', 0),
(23, 'درجن', 0);

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
(3, '1231', '1', '1231', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
 ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `company_info`
--
ALTER TABLE `company_info`
 ADD PRIMARY KEY (`ci_id`);

--
-- Indexes for table `daily_expences`
--
ALTER TABLE `daily_expences`
 ADD PRIMARY KEY (`dex_id`), ADD KEY `dex_unit` (`dex_unit`);

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
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
 ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `transections`
--
ALTER TABLE `transections`
 ADD PRIMARY KEY (`tr_id`), ADD KEY `tr_acc_id` (`tr_acc_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
 ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`), ADD KEY `emp_id` (`emp_id`), ADD KEY `emp_id_2` (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `company_info`
--
ALTER TABLE `company_info`
MODIFY `ci_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `daily_expences`
--
ALTER TABLE `daily_expences`
MODIFY `dex_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
MODIFY `st_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transections`
--
ALTER TABLE `transections`
MODIFY `tr_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `daily_expences`
--
ALTER TABLE `daily_expences`
ADD CONSTRAINT `DEX_FK_UNIT` FOREIGN KEY (`dex_unit`) REFERENCES `units` (`unit_id`);

--
-- Constraints for table `transections`
--
ALTER TABLE `transections`
ADD CONSTRAINT `TRANS_FK_ACC` FOREIGN KEY (`tr_acc_id`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
ADD CONSTRAINT `USER_FK_EMP` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
