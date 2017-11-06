-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2017 at 12:30 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resturant_tmp`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `acc_id` int(11) NOT NULL,
  `acc_name` varchar(256) NOT NULL,
  `acc_amount` decimal(10,2) NOT NULL,
  `acc_description` varchar(512) DEFAULT NULL COMMENT 'توضیحات',
  `acc_date` varchar(16) NOT NULL,
  `acc_type` tinyint(4) NOT NULL COMMENT 'عدد 0 برای صندوق اصلی عدد 1 برای حساب همکاران عدد 2 برای حساب مشتریان'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`acc_id`, `acc_name`, `acc_amount`, `acc_description`, `acc_date`, `acc_type`) VALUES
(15, 'صندوق همکار 1', '2148.00', '', '1509469146', 1),
(18, 'صندوق اصلی', '-459618.00', '', '1509481173', 0),
(19, 'صندوق همکار 2', '200.00', '', '1509815480', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `bill_id` int(11) NOT NULL,
  `bill_no` varchar(64) DEFAULT NULL,
  `bill_shop` varchar(256) DEFAULT NULL,
  `bill_date` varchar(32) NOT NULL,
  `bill_desc` varchar(512) DEFAULT NULL,
  `bill_total_amount` decimal(10,2) NOT NULL,
  `bill_type` tinyint(4) NOT NULL COMMENT 'عدد 0 برای کثر عدد 1 برای خرید گدام'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`bill_id`, `bill_no`, `bill_shop`, `bill_date`, `bill_desc`, `bill_total_amount`, `bill_type`) VALUES
(8, '564', 'دوکان مصرف روزانه', '1509958722', '150 افغانی از 950صندوق اصلی کثر شد مصرف روزانه\r\n', '100.00', 0),
(11, '3453', 'دوکان 1', '1509962332', 'یبلیس', '676.00', 1),
(12, '44', 'دوکان 4', '1509962433', 'سیبسیشب', '500.00', 1),
(13, '4564', 'دوکان علی', '1509962777', 'خرید از دوکان علی ', '300.00', 1),
(14, '456465', 'دوکان اکبر', '1509962926', 'نتیسشب ', '270.00', 0),
(15, '4535', 'hjgjhghf', '1509963883', 'jhnnkhkjhgjkgb', '98.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `company_info`
--

CREATE TABLE `company_info` (
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
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_id`, `emp_name`, `emp_lname`, `emp_position`, `emp_salary`, `emp_join_date`, `emp_org_place`, `emp_cur_place`, `emp_address`, `emp_email`, `emp_phone`, `emp_gendar`, `emp_picture`, `emp_national_id`, `emp_biography`, `emp_type`) VALUES
(1, 'کریم', 'کاظمی', 'مدیر گدام', '15000', '1508956089', 'کابل', 'هرات', 'شهر نو کابل افغانستان ین قالب به صورت هست و برای بخش کنترل پنل و مدیریت سایت های مختلف مناسب می باشد.\r\n\r\nنسخه اصلی این قالب می باشد که توسط به صورت رایگان قرار داده شده است. شهر نو کابل افغانستان ین قالب به صورت هست و برای بخش کنترل پنل و مدیریت سایت های مختلف مناسب می باشد.\r\n\r\nنسخه اصلی این قالب می باشد که توسط به صورت رایگان قرار داده شده است.', 'email@domain.com', '0780525265', 1, 'avatar51.png', '0255', 'شهر نو کابل افغانستان ین قالب به صورت هست و برای بخش کنترل پنل و مدیریت سایت های مختلف مناسب می باشد.\r\n\r\nنسخه اصلی این قالب می باشد که توسط به صورت رایگان قرار داده شده است. شهر نو کابل افغانستان ین قالب به صورت هست و برای بخش کنترل پنل و مدیریت سایت های مختلف مناسب می باشد. نسخه اصلی این قالب می باشد که توسط به صورت رایگان قرار داده شده است. شهر نو کابل افغانستان ین قالب به صورت هست و برای بخش کنترل پنل و مدیریت سایت های مختلف مناسب می باشد.\r\n\r\nنسخه اصلی این قالب می باشد که توسط به صورت رایگان قرار داده شده است.', 0),
(3, 'سارا', 'شهیدی', 'سر آشپز', '15000', '1508863039', 'کابل', 'هرات', 'شهر نو کابل افغانستان', 'email@domain.com', '0780525265', 0, 'avatar2.png', '456789', '', 0),
(6, 'محمد', 'میرزائی', 'مدیر مسئول', '15000', '1509475427', 'دایکندی ', 'کابل', 'کابل چهار قلعه وزیر آباد کوچه گل شب بو پلاک 52 نرسیده به سرک 7 بیست متری کوکاکولا.', 'email@domain.com', '078585454', 1, 'avatar04.png', '5865485', 'ویژگی های قالب و تفاوت های آن با قالب اصلی:\r\n\r\n۱- قالب به صورت کامل و حرفه ای فارسی و راست چین شده.\r\n\r\n۲- انتخاب تاریخ به صورت شمسی یا دیتا پیکر توسط کتاب خانه باباخانی اضافه شده.\r\n\r\n۳- ویرایشگر CK Editor فارسی و راست چین شده.\r\n\r\n۴- ویرایشگر TinyMCE فارسی و راست چین شده و به قالب اضافه شده.\r\n\r\n۵- همچنین فونت فارسی برای خوانایی بیشتر حروف و اعداد فارسی به قالب افزوده شد.\r\n\r\n', 1),
(7, 'رضا', 'شایان', 'مدیر گدام', '5000', '1509375783', 'بامیان', 'کابل ', 'چهار قلعه وزیر آباد فلان سرک فلان کوچه ', 'reza@farakhaan.com', '078565475', 1, 'avatar.png', '45685', 'کارمند خوب', 0);

-- --------------------------------------------------------

--
-- Table structure for table `expences`
--

CREATE TABLE `expences` (
  `dex_id` int(11) NOT NULL,
  `dex_name` varchar(256) NOT NULL,
  `dex_st_unit` int(11) DEFAULT NULL COMMENT 'ای دی واحد جنس گدام',
  `dex_price` decimal(10,2) NOT NULL,
  `dex_count` int(11) NOT NULL,
  `dex_unit` int(11) NOT NULL COMMENT 'واحد مقیاسی',
  `dex_total_amount` decimal(10,2) NOT NULL,
  `dex_bill_id` int(11) NOT NULL COMMENT 'ای دی فاکتور',
  `dex_tr_id` int(11) DEFAULT NULL COMMENT 'ای دی تراکنش'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expences`
--

INSERT INTO `expences` (`dex_id`, `dex_name`, `dex_st_unit`, `dex_price`, `dex_count`, `dex_unit`, `dex_total_amount`, `dex_bill_id`, `dex_tr_id`) VALUES
(15, 'جنس 2', NULL, '20.00', 5, 18, '100.00', 8, 21),
(26, 'آرد درجه یک', 5, '10.00', 50, 19, '500.00', 11, 24),
(27, 'نوشابه سوپرکولا', 3, '44.00', 4, 12, '176.00', 11, 24),
(28, 'آرد درجه یک', 5, '100.00', 5, 19, '500.00', 12, 25),
(30, 'آرد درجه یک', 5, '20.00', 5, 19, '100.00', 13, 26),
(31, 'آرد درجه دوم', 6, '40.00', 5, 24, '200.00', 13, 26),
(32, 'جنس 1', NULL, '100.00', 2, 4, '200.00', 14, 27),
(33, 'جنس 2', NULL, '10.00', 2, 16, '20.00', 14, 27),
(34, 'جنس 3', NULL, '10.00', 5, 22, '50.00', 14, 27),
(35, 'fdr', NULL, '10.00', 5, 4, '50.00', 15, 28),
(36, 'fgt', NULL, '8.00', 6, 4, '48.00', 15, 28);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `job_name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `job_name`) VALUES
(2, 'مدیر مالی'),
(3, 'مدیر گدام'),
(4, 'آشپز'),
(5, 'سر آشپز'),
(6, 'صفاکار'),
(7, 'درایور'),
(8, 'اجیر'),
(10, 'سرباز'),
(11, 'گارد');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `stock_units`
--

CREATE TABLE `stock_units` (
  `st_id` int(11) NOT NULL,
  `st_name` varchar(256) NOT NULL,
  `st_unit` varchar(256) NOT NULL COMMENT 'واحد مقیاسی',
  `st_max_count` int(11) NOT NULL COMMENT 'حد اکثر مقدار قابل گنجایش در گدام',
  `st_min_count` int(11) NOT NULL COMMENT 'تعداد قابل هشدار'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock_units`
--

INSERT INTO `stock_units` (`st_id`, `st_name`, `st_unit`, `st_max_count`, `st_min_count`) VALUES
(3, 'نوشابه سوپرکولا', '12', 50, 5),
(5, 'آرد درجه یک', '19', 50, 5),
(6, 'آرد درجه دوم', '24', 85, 3),
(7, 'روغن نباتی', '23', 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `transections`
--

CREATE TABLE `transections` (
  `tr_id` int(11) NOT NULL,
  `tr_desc` varchar(512) DEFAULT NULL,
  `tr_amount` decimal(10,2) NOT NULL,
  `tr_type` varchar(32) NOT NULL COMMENT 'نوعیت تراکنش: معاش/برداشت/ جمع/ مصارف/',
  `tr_date` varchar(16) NOT NULL,
  `tr_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'عدد 2 برای برداشت عدد 1 برای جمع',
  `tr_acc_id` int(11) DEFAULT NULL COMMENT 'ای دی صندوق',
  `bill_id` int(11) DEFAULT NULL COMMENT 'ای دی بل'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transections`
--

INSERT INTO `transections` (`tr_id`, `tr_desc`, `tr_amount`, `tr_type`, `tr_date`, `tr_status`, `tr_acc_id`, `bill_id`) VALUES
(21, '150 افغانی از 950صندوق اصلی کثر شد مصرف روزانه\r\n', '100.00', 'daily_expence', '1509958722', 2, 18, 8),
(24, 'یبلیس', '676.00', 'buy_stocks', '1509962332', 2, 15, 11),
(25, 'سیبسیشب', '500.00', 'buy_stocks', '1509962433', 2, 19, 12),
(26, 'خرید از دوکان علی ', '300.00', 'buy_stocks', '1509962777', 2, 19, 13),
(27, 'نتیسشب ', '270.00', 'daily_expence', '1509962926', 2, 18, 14),
(28, 'jhnnkhkjhgjkgb', '98.00', 'daily_expence', '1509963883', 2, 18, 15),
(29, 'dfg', '460000.00', 'credit_debit', '1509967713', 2, 18, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(256) NOT NULL,
  `unit_type` tinyint(1) NOT NULL COMMENT 'آشپزخانه/رستورانت'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(23, 'درجن', 0),
(24, 'بوجی', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(5) UNSIGNED NOT NULL,
  `user_name` varchar(256) NOT NULL,
  `user_type` varchar(256) NOT NULL,
  `user_pass` varchar(256) NOT NULL,
  `emp_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`bill_id`);

--
-- Indexes for table `company_info`
--
ALTER TABLE `company_info`
  ADD PRIMARY KEY (`ci_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `expences`
--
ALTER TABLE `expences`
  ADD PRIMARY KEY (`dex_id`),
  ADD KEY `dex_unit` (`dex_unit`),
  ADD KEY `dex_bill_id` (`dex_bill_id`),
  ADD KEY `dex_st_unit` (`dex_st_unit`),
  ADD KEY `dex_tr_id` (`dex_tr_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `stock_units`
--
ALTER TABLE `stock_units`
  ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `transections`
--
ALTER TABLE `transections`
  ADD PRIMARY KEY (`tr_id`),
  ADD KEY `tr_acc_id` (`tr_acc_id`),
  ADD KEY `bill_id` (`bill_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `emp_id_2` (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `company_info`
--
ALTER TABLE `company_info`
  MODIFY `ci_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `expences`
--
ALTER TABLE `expences`
  MODIFY `dex_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `stock_units`
--
ALTER TABLE `stock_units`
  MODIFY `st_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `transections`
--
ALTER TABLE `transections`
  MODIFY `tr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `expences`
--
ALTER TABLE `expences`
  ADD CONSTRAINT `DEX_FK_BILL` FOREIGN KEY (`dex_bill_id`) REFERENCES `bills` (`bill_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `DEX_FK_TRANS` FOREIGN KEY (`dex_tr_id`) REFERENCES `transections` (`tr_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `DEX_FK_UNIT` FOREIGN KEY (`dex_unit`) REFERENCES `units` (`unit_id`);

--
-- Constraints for table `transections`
--
ALTER TABLE `transections`
  ADD CONSTRAINT `TRANS_FK_ACC` FOREIGN KEY (`tr_acc_id`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `TRANS_FK_BILL` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`bill_id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `USER_FK_EMP` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
