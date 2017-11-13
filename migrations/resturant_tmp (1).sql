-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2017 at 03:28 AM
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
  `acc_date` date NOT NULL,
  `acc_type` tinyint(4) NOT NULL COMMENT 'عدد 0 برای صندوق اصلی عدد 1 برای حساب همکاران عدد 2 برای حساب مشتریان'
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`acc_id`, `acc_name`, `acc_amount`, `acc_description`, `acc_date`, `acc_type`) VALUES
(20, 'حساب اصلی', '12275.00', 'حساب اصلی شرکت \r\n', '1396-11-22', 0),
(21, 'همکار شماره یک', '10600.00', 'افتتاح حساب', '1396-08-20', 1),
(22, 'همکار شماره دو', '50000.00', 'افتتاح حساب همکار', '1396-08-20', 1),
(23, 'مشتری شماره یک', '2000.00', 'افتتاح حساب', '1396-08-21', 2),
(24, 'همکار شماره سه', '5000.00', 'افتتاح حساب همکار 3', '1396-08-21', 1),
(25, 'مشتری شماره دو', '2500.00', 'افتتاح حساب مشتری 2', '1396-08-21', 2);

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE IF NOT EXISTS `bills` (
`bill_id` int(11) NOT NULL,
  `bill_no` varchar(64) DEFAULT NULL,
  `bill_shop` varchar(256) DEFAULT NULL,
  `bill_date` date NOT NULL,
  `bill_desc` varchar(512) DEFAULT NULL,
  `bill_total_amount` decimal(10,2) NOT NULL,
  `bill_type` tinyint(4) NOT NULL COMMENT 'عدد 0 برای کثر عدد 1 برای خرید گدام'
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`bill_id`, `bill_no`, `bill_shop`, `bill_date`, `bill_desc`, `bill_total_amount`, `bill_type`) VALUES
(16, '45854', 'دوکان مصارف روزانه', '1396-04-05', 'صرف پنج قلم جنس صحت است مجموع خریداری 2495 افغانی', '1925.00', 0),
(17, '23622', 'دوکان همکار صداقت', '1396-06-13', '4 قلم جنس صحت است مصارف گدام و خریداری برای گدام از همکار شماره یک', '7200.00', 1);

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
  `ci_constitute_date` date NOT NULL COMMENT 'سال تاسیس',
  `ci_website` varchar(64) NOT NULL,
  `ci_type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
`cus_id` int(11) NOT NULL,
  `cus_name` varchar(128) NOT NULL,
  `cus_lname` varchar(128) NOT NULL,
  `cus_job` varchar(256) DEFAULT NULL,
  `cus_join_date` date NOT NULL,
  `cus_org_place` varchar(512) DEFAULT NULL,
  `cus_cur_place` varchar(512) DEFAULT NULL,
  `cus_address` text NOT NULL,
  `cus_email` varchar(128) DEFAULT NULL,
  `cus_phones` varchar(128) DEFAULT NULL,
  `cus_gendar` tinyint(1) NOT NULL DEFAULT '1',
  `cus_picture` varchar(256) DEFAULT NULL,
  `cus_biography` text,
  `cus_messengers` varchar(512) DEFAULT NULL,
  `cus_nantional_id` varchar(16) DEFAULT NULL,
  `cus_org_name` varchar(256) DEFAULT NULL,
  `cus_ref_full_name` varchar(128) DEFAULT NULL,
  `cus_ref_phone` varchar(16) DEFAULT NULL,
  `cus_ref_address` text,
  `cus_unique_id` varchar(16) NOT NULL,
  `cus_acc_id` int(11) NOT NULL COMMENT 'ای دی صندوق مشتری'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `emp_join_date` date DEFAULT NULL,
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
(1, 'علی رضا', 'سامیار', 'مدیر گدام', '15000', '1397-11-21', 'کابل', 'هرات', 'شهر نو کابل افغانستان ین قالب به صورت هست و برای بخش کنترل پنل و مدیریت سایت های مختلف مناسب می باشد.\r\n\r\nنسخه اصلی این قالب می باشد که توسط به صورت رایگان قرار داده شده است. شهر نو کابل افغانستان ین قالب به صورت هست و برای بخش کنترل پنل و مدیریت سایت های مختلف مناسب می باشد.\r\n\r\nنسخه اصلی این قالب می باشد که توسط به صورت رایگان قرار داده شده است.', 'email@domain.com', '0780525265', 1, 'avatar51.png', '0255', 'شهر نو کابل افغانستان ین قالب به صورت هست و برای بخش کنترل پنل و مدیریت سایت های مختلف مناسب می باشد.\r\n\r\nنسخه اصلی این قالب می باشد که توسط به صورت رایگان قرار داده شده است. شهر نو کابل افغانستان ین قالب به صورت هست و برای بخش کنترل پنل و مدیریت سایت های مختلف مناسب می باشد. نسخه اصلی این قالب می باشد که توسط به صورت رایگان قرار داده شده است. شهر نو کابل افغانستان ین قالب به صورت هست و برای بخش کنترل پنل و مدیریت سایت های مختلف مناسب می باشد.\r\n\r\nنسخه اصلی این قالب می باشد که توسط به صورت رایگان قرار داده شده است.', 0),
(3, 'سارا', 'شهیدی', 'سر آشپز', '10000', '1396-08-20', 'کابل', 'هرات', 'شهر نو کابل افغانستان', 'email@domain.com', '0780525265', 0, 'avatar2.png', '456789', '', 1),
(6, 'محمد', 'میرزائی', 'مدیر مسئول', '18000', '1396-11-15', 'دایکندی ', 'کابل', 'کابل چهار قلعه وزیر آباد کوچه گل شب بو پلاک 52 نرسیده به سرک 7 بیست متری کوکاکولا.', 'email@domain.com', '078585454', 1, 'avatar04.png', '5865485', 'ویژگی های قالب و تفاوت های آن با قالب اصلی:\r\n\r\n۱- قالب به صورت کامل و حرفه ای فارسی و راست چین شده.\r\n\r\n۲- انتخاب تاریخ به صورت شمسی یا دیتا پیکر توسط کتاب خانه باباخانی اضافه شده.\r\n\r\n۳- ویرایشگر CK Editor فارسی و راست چین شده.\r\n\r\n۴- ویرایشگر TinyMCE فارسی و راست چین شده و به قالب اضافه شده.\r\n\r\n۵- همچنین فونت فارسی برای خوانایی بیشتر حروف و اعداد فارسی به قالب افزوده شد.\r\n\r\n', 1),
(7, 'رضا', 'شایان', 'مدیر گدام', '12000', '1396-01-10', 'بامیان', 'کابل ', 'چهار قلعه وزیر آباد فلان سرک فلان کوچه ', 'reza@farakhaan.com', '078565475', 1, 'avatar.png', '45685', 'کارمند خوب', 0);

-- --------------------------------------------------------

--
-- Table structure for table `expences`
--

CREATE TABLE IF NOT EXISTS `expences` (
`dex_id` int(11) NOT NULL,
  `dex_name` varchar(256) NOT NULL,
  `dex_st_unit` int(11) DEFAULT NULL COMMENT 'ای دی واحد جنس گدام',
  `dex_price` decimal(10,2) NOT NULL,
  `dex_count` int(11) NOT NULL,
  `dex_unit` int(11) NOT NULL COMMENT 'واحد مقیاسی',
  `dex_total_amount` decimal(10,2) NOT NULL,
  `dex_bill_id` int(11) NOT NULL COMMENT 'ای دی فاکتور',
  `dex_tr_id` int(11) DEFAULT NULL COMMENT 'ای دی تراکنش'
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expences`
--

INSERT INTO `expences` (`dex_id`, `dex_name`, `dex_st_unit`, `dex_price`, `dex_count`, `dex_unit`, `dex_total_amount`, `dex_bill_id`, `dex_tr_id`) VALUES
(37, 'پیاز 1', NULL, '120.00', 5, 16, '600.00', 16, 49),
(38, 'کچالو', NULL, '350.00', 2, 19, '700.00', 16, 49),
(39, 'گوشت سینه مرغ', NULL, '125.00', 5, 15, '625.00', 16, 49),
(42, 'آرد درجه دوم', 6, '80.00', 5, 24, '400.00', 17, 50),
(43, 'آرد درجه یک', 5, '1200.00', 3, 19, '3600.00', 17, 50),
(44, 'روغن نباتی', 7, '800.00', 4, 23, '3200.00', 17, 50);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
`job_id` int(11) NOT NULL,
  `job_name` varchar(256) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

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

CREATE TABLE IF NOT EXISTS `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE IF NOT EXISTS `salary` (
`sal_id` int(11) NOT NULL,
  `sal_amount` decimal(10,2) NOT NULL,
  `sal_remain` decimal(10,2) NOT NULL,
  `sal_tax` decimal(10,2) NOT NULL,
  `sal_bonus` decimal(10,2) NOT NULL,
  `sal_fine` decimal(10,2) NOT NULL,
  `sal_payable` decimal(10,2) NOT NULL,
  `sal_date` date NOT NULL,
  `sal_month` int(2) NOT NULL,
  `sal_desc` varchar(512) DEFAULT NULL,
  `sal_emp_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`sal_id`, `sal_amount`, `sal_remain`, `sal_tax`, `sal_bonus`, `sal_fine`, `sal_payable`, `sal_date`, `sal_month`, `sal_desc`, `sal_emp_id`) VALUES
(20, '7000.00', '7600.00', '450.00', '200.00', '150.00', '14400.00', '1396-08-21', 8, 'پرداخت ابتدائی ', 1),
(21, '8000.00', '6430.00', '750.00', '300.00', '120.00', '14130.00', '1396-08-21', 1, 'پرداخت اولیه', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock_units`
--

CREATE TABLE IF NOT EXISTS `stock_units` (
`st_id` int(11) NOT NULL,
  `st_name` varchar(256) NOT NULL,
  `st_unit` varchar(256) NOT NULL COMMENT 'واحد مقیاسی',
  `st_max_count` int(11) NOT NULL COMMENT 'حد اکثر مقدار قابل گنجایش در گدام',
  `st_min_count` int(11) NOT NULL COMMENT 'تعداد قابل هشدار'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

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

CREATE TABLE IF NOT EXISTS `transections` (
`tr_id` int(11) NOT NULL,
  `tr_desc` varchar(512) DEFAULT NULL,
  `tr_amount` decimal(10,2) NOT NULL,
  `tr_type` varchar(32) NOT NULL COMMENT 'نوعیت تراکنش: معاش/برداشت/ جمع/ مصارف/',
  `tr_date` date NOT NULL,
  `tr_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'عدد 2 برای برداشت عدد 1 برای جمع',
  `tr_acc_id` int(11) DEFAULT NULL COMMENT 'ای دی صندوق',
  `bill_id` int(11) DEFAULT NULL COMMENT 'ای دی بل',
  `tr_sal_id` int(11) DEFAULT NULL COMMENT 'ای دی معاش کارمند'
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transections`
--

INSERT INTO `transections` (`tr_id`, `tr_desc`, `tr_amount`, `tr_type`, `tr_date`, `tr_status`, `tr_acc_id`, `bill_id`, `tr_sal_id`) VALUES
(44, 'افتتاح حساب', '15000.00', 'credit_debit', '1396-08-20', 1, 21, NULL, NULL),
(45, 'افتتاح حساب', '50000.00', 'credit_debit', '1396-08-20', 1, 22, NULL, NULL),
(47, '3000 جمع برای همکار', '3000.00', 'credit_debit', '1396-08-21', 1, 21, NULL, NULL),
(48, '1000 برداشت از همکار', '1000.00', 'credit_debit', '1396-08-20', 2, 21, NULL, NULL),
(49, 'صرف پنج قلم جنس صحت است مجموع خریداری 2495 افغانی', '1925.00', 'daily_expence', '1396-04-05', 2, 20, 16, NULL),
(50, '4 قلم جنس صحت است مصارف گدام و خریداری برای گدام از همکار شماره یک', '7200.00', 'buy_stocks', '1396-06-13', 2, 21, 17, NULL),
(51, NULL, '6760.00', '', '0000-00-00', 0, NULL, NULL, NULL),
(52, 'پرداخت ابتدائی ', '5000.00', 'salary', '1396-08-21', 2, 20, NULL, 20),
(53, '2000 پرداخت دوباره ', '2000.00', 'salary', '1396-08-21', 2, 20, NULL, 20),
(54, 'پرداخت اولیه', '5000.00', 'salary', '1396-08-21', 2, 20, NULL, 21),
(55, '3000 پرداخت ', '3000.00', 'salary', '1396-08-21', 2, 20, NULL, 21),
(58, 'افتتاح حساب', '2000.00', 'credit_debit', '1396-08-21', 1, 23, NULL, NULL),
(59, 'افتتاح حساب', '5000.00', 'credit_debit', '1396-08-21', 1, 24, NULL, NULL),
(60, 'افتتاح حساب', '2500.00', 'credit_debit', '1396-08-21', 1, 25, NULL, NULL),
(61, '', '5000.00', 'credit_debit', '1396-08-21', 1, 20, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE IF NOT EXISTS `units` (
`unit_id` int(11) NOT NULL,
  `unit_name` varchar(256) NOT NULL,
  `unit_type` tinyint(1) NOT NULL COMMENT 'آشپزخانه/رستورانت'
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

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
-- Indexes for table `customers`
--
ALTER TABLE `customers`
 ADD PRIMARY KEY (`cus_id`), ADD UNIQUE KEY `cus_unique_id` (`cus_unique_id`), ADD KEY `cus_acc_id` (`cus_acc_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
 ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `expences`
--
ALTER TABLE `expences`
 ADD PRIMARY KEY (`dex_id`), ADD KEY `dex_unit` (`dex_unit`), ADD KEY `dex_bill_id` (`dex_bill_id`), ADD KEY `dex_st_unit` (`dex_st_unit`), ADD KEY `dex_tr_id` (`dex_tr_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
 ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
 ADD PRIMARY KEY (`sal_id`);

--
-- Indexes for table `stock_units`
--
ALTER TABLE `stock_units`
 ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `transections`
--
ALTER TABLE `transections`
 ADD PRIMARY KEY (`tr_id`), ADD KEY `tr_acc_id` (`tr_acc_id`), ADD KEY `bill_id` (`bill_id`), ADD KEY `tr_sal_id` (`tr_sal_id`);

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
MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `company_info`
--
ALTER TABLE `company_info`
MODIFY `ci_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `expences`
--
ALTER TABLE `expences`
MODIFY `dex_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
MODIFY `sal_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `stock_units`
--
ALTER TABLE `stock_units`
MODIFY `st_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `transections`
--
ALTER TABLE `transections`
MODIFY `tr_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
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
ADD CONSTRAINT `TRANS_FK_BILL` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`bill_id`) ON DELETE CASCADE,
ADD CONSTRAINT `TRANS_FK_SAL` FOREIGN KEY (`tr_sal_id`) REFERENCES `salary` (`sal_id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
ADD CONSTRAINT `USER_FK_EMP` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
