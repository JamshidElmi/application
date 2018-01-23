-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2018 at 07:33 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
  `acc_date` date NOT NULL,
  `acc_type` tinyint(4) NOT NULL COMMENT 'عدد 0 برای صندوق اصلی عدد 1 برای حساب همکاران عدد 2 برای حساب مشتریان'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`acc_id`, `acc_name`, `acc_amount`, `acc_description`, `acc_date`, `acc_type`) VALUES
(1, 'ممتاز هرات', '29182.00', 'افتتاح حساب', '1396-10-17', 0),
(2, 'حساب کاظم', '-3100.00', 'افتتاح حساب', '1396-10-17', 2),
(3, 'حساب همکار 1', '2000.00', 'افتتاح حساب همکار ', '1396-10-17', 1),
(4, 'حساب کریم', '-17067.00', 'افتتاح حساب', '1396-10-17', 2),
(5, 'حساب همکار 2', '0.00', 'یبلیسل', '1396-10-23', 2),
(6, 'همکار شماه3', '-1400.00', 'یبلی', '1396-10-23', 1),
(7, '', '30148.00', NULL, '0000-00-00', 0),
(8, '', '30148.00', NULL, '0000-00-00', 0),
(9, '', '30148.00', NULL, '0000-00-00', 0),
(10, '', '30148.00', NULL, '0000-00-00', 0),
(11, '', '30148.00', NULL, '0000-00-00', 0),
(12, '', '30148.00', NULL, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `base_menus`
--

CREATE TABLE `base_menus` (
  `bm_id` int(11) NOT NULL,
  `bm_name` varchar(512) NOT NULL,
  `bm_price` decimal(10,2) DEFAULT NULL,
  `bm_desc` varchar(512) DEFAULT NULL,
  `bm_picture` varchar(256) DEFAULT NULL,
  `bm_type` tinyint(1) NOT NULL COMMENT 'عدد صفر برای آشپزخانه عدد یک برای رستورانت',
  `bm_unit_id` int(11) DEFAULT NULL COMMENT 'ای دی واحدات',
  `bm_cat_id` int(11) DEFAULT NULL COMMENT 'ای دی کتگوری منو'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `base_menus`
--

INSERT INTO `base_menus` (`bm_id`, `bm_name`, `bm_price`, `bm_desc`, `bm_picture`, `bm_type`, `bm_unit_id`, `bm_cat_id`) VALUES
(1, 'منوی درجه اول', NULL, 'منوی درجه اول برای با پنج قلم خوراکی', '22222.jpg', 0, NULL, NULL),
(2, 'منوی درجه دوم', NULL, 'منوی درجه دوم با چهار قلم خوراکی', '3333.jpg', 0, NULL, NULL),
(3, 'نوشابه سوپرکولا', '20.00', 'یک بوتل', '2.jpg', 1, 3, 1),
(4, 'نوشابه بزرگ کوکاکولا', '50.00', '', '3.jpg', 1, 3, 1),
(5, 'نوشابه کوچک کوکاکولا', '20.00', '', '5.jpg', 1, 3, 1),
(6, 'کباب شامی ', '120.00', 'شش سیخ', 'menu-default.png', 1, 1, 2),
(10, 'منوی ویژه', NULL, 'منوی ویژه شامل تمام زیرمنو های آشپزخانه میشود.', 'menu-default.png', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `bill_id` int(11) NOT NULL,
  `bill_no` varchar(64) DEFAULT NULL,
  `bill_shop` varchar(256) DEFAULT NULL,
  `bill_date` date NOT NULL,
  `bill_desc` varchar(512) DEFAULT NULL,
  `bill_total_amount` decimal(10,2) NOT NULL,
  `bill_type` tinyint(4) NOT NULL COMMENT 'عدد 0 برای مصارف روزانه عدد 1 برای خرید گدام',
  `bill_dex_type` tinyint(1) DEFAULT NULL COMMENT 'عدد 0 برای آشپزخانه عدد 1 برای رستورانت'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`bill_id`, `bill_no`, `bill_shop`, `bill_date`, `bill_desc`, `bill_total_amount`, `bill_type`, `bill_dex_type`) VALUES
(1, '1020', 'دوکان برادران احمدی', '1396-10-17', 'خرید اول برای رستورانت', '6250.00', 0, NULL),
(2, '1030', 'دوکان همکار صداقت', '1396-10-17', '', '1500.00', 1, NULL),
(3, '45643', '', '1396-10-23', '', '1400.00', 1, NULL),
(4, '3452', 'دوکا احمد', '1396-10-29', 'خرید بادام', '1500.00', 1, 1),
(6, '4345', 'دوکان علی داد ', '1396-11-03', '', '80.00', 0, NULL),
(7, '345', 'دوکان سخی داد', '1396-11-03', 'فقط یادداشت', '40.00', 0, 1),
(8, '', '', '1396-11-03', 'برای رستورانت', '200.00', 0, NULL),
(9, '3452', 'علی داد ', '1396-11-03', 'یادداشت', '40.00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `company_info`
--

CREATE TABLE `company_info` (
  `ci_id` int(11) NOT NULL,
  `ci_full_name` varchar(256) NOT NULL,
  `ci_full_name_en` varchar(256) NOT NULL,
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

--
-- Dumping data for table `company_info`
--

INSERT INTO `company_info` (`ci_id`, `ci_full_name`, `ci_full_name_en`, `ci_boss_name`, `ci_manager_name`, `ci_address`, `ci_phones`, `ci_emails`, `ci_logo`, `ci_constitute_date`, `ci_website`, `ci_type`) VALUES
(1, 'آشپزخانه و رستورانت ممتاز هرات', 'Mumtaz Herat Resturant & Catering', 'محمد میرزائی', 'رضا شایان', 'کابل، کارته3، چهارراهی پل سرخ، جوار شفاخانه KMC و شفاخانه علی سینا', ' 71 71 11 0786 – 31 33 251 020 ', 'facebook.com/id', 'FINAL_Without_English_SM11.png', '1396-11-01', 'http://mumtazherat.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cus_id` int(11) NOT NULL,
  `cus_unique_id` varchar(16) NOT NULL,
  `cus_name` varchar(128) NOT NULL,
  `cus_lname` varchar(128) NOT NULL,
  `cus_national_id` varchar(16) DEFAULT NULL,
  `cus_job` varchar(256) DEFAULT NULL,
  `cus_org_name` varchar(256) DEFAULT NULL,
  `cus_org_place` varchar(512) DEFAULT NULL,
  `cus_cur_place` varchar(512) DEFAULT NULL,
  `cus_address` text NOT NULL,
  `cus_email` varchar(128) DEFAULT NULL,
  `cus_site` varchar(128) DEFAULT NULL,
  `cus_phones` varchar(128) DEFAULT NULL,
  `cus_join_date` date NOT NULL,
  `cus_gendar` tinyint(1) NOT NULL DEFAULT '1',
  `cus_picture` varchar(256) DEFAULT NULL,
  `cus_biography` text,
  `cus_ref_full_name` varchar(128) DEFAULT NULL,
  `cus_ref_phone` varchar(16) DEFAULT NULL,
  `cus_ref_address` text,
  `cus_type` tinyint(1) NOT NULL COMMENT 'عدد صفر آشپزخانه عدد یک رستورانت ',
  `cus_acc_id` int(11) NOT NULL COMMENT 'ای دی صندوق مشتری'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cus_id`, `cus_unique_id`, `cus_name`, `cus_lname`, `cus_national_id`, `cus_job`, `cus_org_name`, `cus_org_place`, `cus_cur_place`, `cus_address`, `cus_email`, `cus_site`, `cus_phones`, `cus_join_date`, `cus_gendar`, `cus_picture`, `cus_biography`, `cus_ref_full_name`, `cus_ref_phone`, `cus_ref_address`, `cus_type`, `cus_acc_id`) VALUES
(2, '2', 'کریم', 'کریمی', '9978', 'دوکاندار', '', 'کابل', 'کابل', 'شهر نو', 'email@domain.com', '', '0777181828', '1396-10-17', 1, 'avatar.png', '', '', '', '', 1, 4),
(20001, '3', 'کریم', 'کریمی', '9978', 'دوکاندار', '', 'کابل', 'کابل', 'شهر نو', 'email@domain.com', '', '0777181828', '1396-10-17', 1, 'avatar.png', '', '', '', '', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `desks`
--

CREATE TABLE `desks` (
  `desk_id` int(11) NOT NULL,
  `desk_name` varchar(512) NOT NULL,
  `desk_capacity` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `desks`
--

INSERT INTO `desks` (`desk_id`, `desk_name`, `desk_capacity`) VALUES
(1, 'میز (1)', 6),
(2, 'میز (2)', 6),
(3, 'میز (3)', 6),
(4, 'میز (4)', 12),
(5, 'میز (5)', 12);

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `disc_id` int(11) NOT NULL,
  `disc_name` varchar(64) NOT NULL,
  `disc_persent` decimal(10,2) NOT NULL COMMENT 'درصد تخفیف'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='جدول تخفیفات';

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`disc_id`, `disc_name`, `disc_persent`) VALUES
(1, 'بدون تخفیف', '0.00'),
(2, 'تخفیف مهمان', '20.00'),
(3, 'تخفیف ویژه', '50.00'),
(4, 'رایگان', '100.00');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_id`, `emp_name`, `emp_lname`, `emp_position`, `emp_salary`, `emp_join_date`, `emp_org_place`, `emp_cur_place`, `emp_address`, `emp_email`, `emp_phone`, `emp_gendar`, `emp_picture`, `emp_national_id`, `emp_biography`, `emp_type`) VALUES
(2, 'کاظم', 'کاظمی', 'مدیر گدام', '15000', '1396-10-17', 'غزنی ', 'کابل ', 'کابل چهارراهی صدارت', 'emain@domain.com', '0777181828', 1, 'avatar.png', '45648', 'کارمند با معاض عالی', 0),
(3, 'جواد', 'جوادی', 'گارسون', '8000', '1396-10-26', 'کابل', 'کابل ', 'بیست متری کوکاکولا', 'emain@domain.com', '078586858', 1, 'avatar1.png', '3452', 'کارمند خوب', 1),
(20, 'محمد', 'میرزائی', 'مدیر کل', '10000', '1396-10-20', 'کابل', 'کابل', 'کابل، کارته3، چهارراهی پل سرخ، جوار شفاخانه KMC و شفاخانه علی سینا', 'email@domain.com', '0777181828', 1, 'avatar5.png', '1234', 'کارمند خوبی است', 0);

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
(1, 'روغن', NULL, '150.00', 5, 10, '750.00', 1, 5),
(2, 'آرد', NULL, '500.00', 10, 7, '5000.00', 1, 5),
(3, 'نوشابه', NULL, '100.00', 5, 8, '500.00', 1, 5),
(4, 'تخم مرغ', 1, '100.00', 2, 9, '1000.00', 2, 6),
(5, 'نوشابه سوپرکولا', 2, '50.00', 10, 8, '500.00', 2, 6),
(6, 'نوشابه سوپرکولا', 2, '20.00', 10, 8, '400.00', 3, 22),
(7, 'روغن', 3, '500.00', 2, 3, '1000.00', 3, 22),
(8, 'بادام', 5, '15.00', 100, 13, '1500.00', 4, 36),
(11, 'جنس', NULL, '40.00', 2, 8, '80.00', 6, 52),
(12, 'مربا', NULL, '2.00', 20, 6, '40.00', 7, 53),
(13, 'شکر', NULL, '20.00', 10, 8, '200.00', 8, 54),
(14, 'عسل ', NULL, '20.00', 2, 8, '40.00', 9, 55);

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
(1, 'مدیر کل'),
(2, 'مدیر گدام'),
(3, 'آشپز'),
(4, 'سرآشپز'),
(5, 'گارسون'),
(6, 'سهامدار'),
(7, 'سهامدار');

-- --------------------------------------------------------

--
-- Table structure for table `menu_category`
--

CREATE TABLE `menu_category` (
  `mc_id` int(11) NOT NULL,
  `mc_name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='نوع منو یا اسم نوعیت منو که زیر شاخه این جدول لیست منو میباش';

--
-- Dumping data for table `menu_category`
--

INSERT INTO `menu_category` (`mc_id`, `mc_name`) VALUES
(1, 'نوشیدنی ها'),
(2, 'کباب ها'),
(3, 'برنج'),
(4, 'سالاد');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ord_id` int(11) NOT NULL,
  `ord_desc` varchar(512) DEFAULT NULL,
  `ord_created_date` date NOT NULL COMMENT 'تاریخ ثبت سفارش',
  `ord_date` date NOT NULL,
  `ord_time` time NOT NULL,
  `ord_price` decimal(10,0) NOT NULL,
  `ord_ext_charges` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'مصارف متفرقه',
  `ord_discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ord_type` varchar(16) NOT NULL COMMENT 'نوعیت سفارش آشپزخانه / رستورانت',
  `ord_desk_id` int(11) DEFAULT NULL COMMENT 'ای دی میز',
  `ord_cus_id` int(11) DEFAULT NULL COMMENT 'ای دی مشتری'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='جدول سفارشات';

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ord_id`, `ord_desc`, `ord_created_date`, `ord_date`, `ord_time`, `ord_price`, `ord_ext_charges`, `ord_discount`, `ord_type`, `ord_desk_id`, `ord_cus_id`) VALUES
(14, 'توضیحات اضافی', '0000-00-00', '1396-12-20', '15:34:00', '180', '0.00', '0.00', 'resturant', 1, 1),
(15, 'توضیحات بی فایده ', '0000-00-00', '1396-11-28', '23:35:00', '140', '0.00', '0.00', 'resturant', 0, 1),
(16, 'کریم جان کریمی', '0000-00-00', '1396-11-20', '23:35:00', '210', '0.00', '0.00', 'resturant', 2, 2),
(17, 'توضیحات .........', '0000-00-00', '1396-10-29', '23:36:00', '320', '0.00', '0.00', 'resturant', 0, 20001),
(18, 'توضیحات برای سفارش ', '1396-10-28', '1396-11-28', '21:39:00', '4640', '200.00', '20.00', 'kitchen', NULL, 2),
(19, 'توضیحات کریمی 3', '1396-10-28', '1396-10-28', '15:40:00', '2200', '500.00', '0.00', 'kitchen', NULL, 20001),
(20, 'sdfs fsdf', '1396-11-02', '1396-11-02', '21:17:00', '6560', '50.00', '20.00', 'kitchen', NULL, 2),
(21, 'dfsd', '1396-11-02', '1396-11-02', '21:17:00', '5000', '5000.00', '0.00', 'kitchen', NULL, 2),
(22, '101010', '1396-11-02', '1396-11-02', '21:19:00', '2900', '10.00', '0.00', 'kitchen', NULL, 2),
(23, 'sdf wer', '1396-11-02', '1396-11-02', '21:32:00', '2320', '10.00', '20.00', 'kitchen', NULL, 2),
(24, 'dfg', '1396-11-02', '1396-11-02', '21:38:00', '928', '4.00', '20.00', 'kitchen', NULL, 2),
(25, '55', '1396-11-02', '1396-11-02', '21:38:00', '1450', '5.00', '0.00', 'kitchen', NULL, 20001),
(26, 'asdsd', '0000-00-00', '1396-11-02', '21:59:00', '64', '0.00', '20.00', 'resturant', 2, 2),
(27, 'fgh', '0000-00-00', '1396-11-02', '22:03:00', '480', '0.00', '0.00', 'resturant', 3, 2),
(28, 'zd', '0000-00-00', '1396-11-02', '22:04:00', '100', '0.00', '0.00', 'resturant', 2, 2),
(29, 'sdf', '0000-00-00', '1396-11-02', '22:06:00', '40', '0.00', '0.00', 'resturant', 2, 2),
(30, 'df', '0000-00-00', '1396-11-02', '22:06:00', '40', '0.00', '0.00', 'resturant', 3, 2),
(31, '4', '0000-00-00', '1396-11-02', '22:07:00', '150', '0.00', '0.00', 'resturant', 3, 2),
(32, '44', '0000-00-00', '1396-11-02', '22:07:00', '400', '0.00', '0.00', 'resturant', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `part_id` int(11) NOT NULL,
  `part_amount` decimal(10,2) NOT NULL COMMENT 'مقدار سهام',
  `part_persent` decimal(10,2) NOT NULL COMMENT 'درصدی سهامدار',
  `part_emp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`part_id`, `part_amount`, `part_persent`, `part_emp_id`) VALUES
(1, '5000.00', '38.46', 20),
(3, '2000.00', '25.00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`sal_id`, `sal_amount`, `sal_remain`, `sal_tax`, `sal_bonus`, `sal_fine`, `sal_payable`, `sal_date`, `sal_month`, `sal_desc`, `sal_emp_id`) VALUES
(1, '7000.00', '3000.00', '0.00', '0.00', '0.00', '10000.00', '1396-10-04', 2, 'نصف معاش پرداخت شد', 1),
(2, '7000.00', '3000.00', '0.00', '0.00', '0.00', '10000.00', '1396-11-02', 2, 'نصف معاش پرداخت شد', 1),
(3, '7000.00', '3000.00', '0.00', '0.00', '0.00', '10000.00', '1396-02-11', 2, 'نصف معاش پرداخت شد', 1),
(4, '5000.00', '5000.00', '0.00', '0.00', '0.00', '10000.00', '1396-11-12', 5, '', 1),
(5, '2222.00', '7778.00', '0.00', '0.00', '0.00', '10000.00', '1396-11-07', 12, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `stock_id` int(11) NOT NULL,
  `stock_count` int(11) NOT NULL,
  `stock_total_price` decimal(10,2) NOT NULL,
  `stock_date` date DEFAULT NULL,
  `stock_type` varchar(32) NOT NULL COMMENT 'نوعیت مصارف گدام: فست  فود/ رستوزانت/ آشپزخانه',
  `stock_st_id` int(11) NOT NULL,
  `stock_ord_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`stock_id`, `stock_count`, `stock_total_price`, `stock_date`, `stock_type`, `stock_st_id`, `stock_ord_id`) VALUES
(1, 10, '1000.00', '1396-10-17', 'resturant', 1, NULL),
(2, 5, '250.00', '1396-10-17', 'resturant', 2, NULL),
(3, 2, '500.00', '1396-10-17', 'fast_food', 3, NULL),
(4, 10, '150.00', '1396-10-29', 'resturant', 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock_units`
--

CREATE TABLE `stock_units` (
  `st_id` int(11) NOT NULL,
  `st_name` varchar(256) NOT NULL,
  `st_price` decimal(10,2) NOT NULL,
  `st_unit` varchar(256) NOT NULL COMMENT 'واحد مقیاسی',
  `st_max_count` int(11) NOT NULL COMMENT 'حد اکثر مقدار قابل گنجایش در گدام',
  `st_count` int(11) NOT NULL COMMENT 'تعداد موجود در گدام',
  `st_min_count` int(11) NOT NULL COMMENT 'تعداد قابل هشدار'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock_units`
--

INSERT INTO `stock_units` (`st_id`, `st_name`, `st_price`, `st_unit`, `st_max_count`, `st_count`, `st_min_count`) VALUES
(1, 'تخم مرغ', '100.00', '9', 50, 0, 30),
(2, 'نوشابه سوپرکولا', '20.00', '8', 1000, 600, 600),
(3, 'روغن', '500.00', '3', 20, 15, 5),
(4, 'بکینک پورد', '120.00', '8', 200, 80, 100),
(5, 'بادام', '15.00', '12', 500, 90, 10);

-- --------------------------------------------------------

--
-- Table structure for table `sub_base_menu`
--

CREATE TABLE `sub_base_menu` (
  `sbm_id` int(11) NOT NULL,
  `sbm_bm_id` int(11) NOT NULL COMMENT 'ای دی منوی اصلی',
  `sbm_sm_id` int(11) NOT NULL COMMENT 'ای دی منوی فرعی'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_base_menu`
--

INSERT INTO `sub_base_menu` (`sbm_id`, `sbm_bm_id`, `sbm_sm_id`) VALUES
(10, 1, 2),
(11, 1, 3),
(12, 1, 4),
(9, 1, 5),
(13, 1, 6),
(5, 2, 2),
(6, 2, 4),
(7, 2, 5),
(8, 2, 6),
(17, 10, 1),
(18, 10, 2),
(19, 10, 3),
(20, 10, 4),
(21, 10, 5),
(22, 10, 6);

-- --------------------------------------------------------

--
-- Table structure for table `sub_menus`
--

CREATE TABLE `sub_menus` (
  `sm_id` int(11) NOT NULL,
  `sm_name` varchar(256) NOT NULL,
  `sm_count` decimal(10,1) NOT NULL DEFAULT '1.0',
  `sm_price` decimal(10,2) DEFAULT NULL,
  `sm_desc` varchar(512) DEFAULT NULL,
  `sm_unit_id` int(11) NOT NULL COMMENT 'ای دی واحد '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_menus`
--

INSERT INTO `sub_menus` (`sm_id`, `sm_name`, `sm_count`, `sm_price`, `sm_desc`, `sm_unit_id`) VALUES
(1, 'کباب', '1.0', '120.00', 'کباب تکه 6 سیخ', 1),
(2, 'کباب شامی', '1.0', '150.00', '6 سیخ برای هر خوراک', 1),
(3, 'نوشابه', '2.0', '40.00', '2 بوتل نوشابه سوپرکولای خورد', 3),
(4, 'ماست', '1.0', '50.00', 'یک بوتل ماست پگاه', 3),
(5, 'نان', '2.0', '20.00', 'دو عدد نان تاقه ایی برای هر نفر', 15),
(6, 'سالاد', '1.0', '30.00', 'یک بشقاب سالاد برای دو نفر', 13);

-- --------------------------------------------------------

--
-- Table structure for table `sub_orders`
--

CREATE TABLE `sub_orders` (
  `sord_id` int(11) NOT NULL,
  `sord_bm_id` int(11) NOT NULL,
  `sord_sm_id` int(11) DEFAULT NULL COMMENT 'ای دی زیرمنو',
  `sord_count` int(11) DEFAULT NULL,
  `sord_price` int(11) DEFAULT NULL,
  `sord_ord_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='جدول ایتم های انتخابی از منو برای جدول سفارشات';

--
-- Dumping data for table `sub_orders`
--

INSERT INTO `sub_orders` (`sord_id`, `sord_bm_id`, `sord_sm_id`, `sord_count`, `sord_price`, `sord_ord_id`) VALUES
(30, 3, NULL, 2, 40, 14),
(31, 4, NULL, 2, 100, 14),
(32, 5, NULL, 2, 40, 14),
(33, 4, NULL, 2, 100, 15),
(34, 5, NULL, 2, 40, 15),
(35, 3, NULL, 3, 60, 16),
(36, 4, NULL, 3, 150, 16),
(37, 4, NULL, 4, 200, 17),
(38, 5, NULL, 3, 60, 17),
(39, 3, NULL, 3, 60, 17),
(40, 1, 2, 20, 290, 18),
(41, 1, 3, 20, 290, 18),
(42, 1, 4, 20, 290, 18),
(43, 1, 5, 20, 290, 18),
(44, 1, 6, 20, 290, 18),
(45, 2, 2, 10, 220, 19),
(46, 2, 4, 10, 220, 19),
(47, 2, 5, 10, 220, 19),
(48, 10, 1, 20, 410, 20),
(49, 10, 2, 20, 410, 20),
(50, 10, 3, 20, 410, 20),
(51, 10, 4, 20, 410, 20),
(52, 10, 5, 20, 410, 20),
(53, 10, 6, 20, 410, 20),
(54, 2, 2, 20, 250, 21),
(55, 2, 4, 20, 250, 21),
(56, 2, 5, 20, 250, 21),
(57, 2, 6, 20, 250, 21),
(58, 1, 2, 10, 290, 22),
(59, 1, 3, 10, 290, 22),
(60, 1, 4, 10, 290, 22),
(61, 1, 5, 10, 290, 22),
(62, 1, 6, 10, 290, 22),
(63, 1, 2, 10, 290, 23),
(64, 1, 3, 10, 290, 23),
(65, 1, 4, 10, 290, 23),
(66, 1, 5, 10, 290, 23),
(67, 1, 6, 10, 290, 23),
(68, 1, 2, 4, 290, 24),
(69, 1, 3, 4, 290, 24),
(70, 1, 4, 4, 290, 24),
(71, 1, 5, 4, 290, 24),
(72, 1, 6, 4, 290, 24),
(73, 1, 2, 5, 290, 25),
(74, 1, 3, 5, 290, 25),
(75, 1, 4, 5, 290, 25),
(76, 1, 5, 5, 290, 25),
(77, 1, 6, 5, 290, 25),
(78, 3, NULL, 4, 80, 26),
(79, 6, NULL, 4, 480, 27),
(80, 4, NULL, 2, 100, 28),
(81, 3, NULL, 2, 40, 29),
(82, 3, NULL, 2, 40, 30),
(83, 4, NULL, 3, 150, 31),
(84, 4, NULL, 4, 200, 32),
(85, 3, NULL, 4, 80, 32),
(86, 5, NULL, 6, 120, 32);

-- --------------------------------------------------------

--
-- Table structure for table `transections`
--

CREATE TABLE `transections` (
  `tr_id` int(11) NOT NULL,
  `tr_desc` varchar(512) DEFAULT NULL,
  `tr_amount` decimal(10,2) NOT NULL,
  `tr_type` varchar(32) NOT NULL COMMENT 'نوعیت تراکنش: معاش/برداشت/ جمع/ مصارف/',
  `tr_date` date NOT NULL,
  `tr_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'عدد 2 برای برداشت عدد 1 برای جمع',
  `tr_acc_id` int(11) DEFAULT NULL COMMENT 'ای دی صندوق',
  `bill_id` int(11) DEFAULT NULL COMMENT 'ای دی بل',
  `tr_sal_id` int(11) DEFAULT NULL COMMENT 'ای دی معاش کارمند',
  `tr_ord_id` int(11) DEFAULT NULL COMMENT 'ای دی سفارش',
  `tr_part_id` int(11) DEFAULT NULL COMMENT 'ای دی سهامداران'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transections`
--

INSERT INTO `transections` (`tr_id`, `tr_desc`, `tr_amount`, `tr_type`, `tr_date`, `tr_status`, `tr_acc_id`, `bill_id`, `tr_sal_id`, `tr_ord_id`, `tr_part_id`) VALUES
(1, 'ثبت شریک', '5000.00', 'partner_credit_debit', '1396-10-17', 1, 1, NULL, NULL, NULL, 1),
(2, 'مقدار پول جمع شد در حساب', '50000.00', 'credit_debit', '1396-10-17', 1, 1, NULL, NULL, NULL, NULL),
(3, 'افتتاح حساب', '2000.00', 'credit_debit', '1396-10-17', 1, 2, NULL, NULL, NULL, NULL),
(4, 'افتتاح حساب', '5000.00', 'credit_debit', '1396-10-17', 1, 3, NULL, NULL, NULL, NULL),
(5, 'خرید اول برای رستورانت', '6250.00', 'daily_expence', '1396-10-17', 2, 1, 1, NULL, NULL, NULL),
(6, '', '1500.00', 'buy_stocks', '1396-10-17', 2, 3, 2, NULL, NULL, NULL),
(9, 'افتتاح حساب', '1000.00', 'credit_debit', '1396-10-17', 1, 4, NULL, NULL, NULL, NULL),
(11, 'نصف معاش پرداخت شد', '5000.00', 'salary', '1396-10-17', 2, 1, NULL, 1, NULL, NULL),
(12, '', '2000.00', 'salary', '1396-10-17', 2, 1, NULL, 1, NULL, NULL),
(13, '', '5000.00', 'salary', '1396-12-16', 2, 1, NULL, 4, NULL, NULL),
(14, '', '2222.00', 'salary', '1396-12-07', 2, 1, NULL, 5, NULL, NULL),
(19, 'یبل', '2000.00', 'partner_credit_debit', '1396-10-23', 1, 1, NULL, NULL, NULL, 3),
(20, 'افتتاح حساب', '0.00', 'credit_debit', '1396-10-23', 1, 5, NULL, NULL, NULL, NULL),
(21, 'افتتاح حساب', '0.00', 'credit_debit', '1396-10-23', 1, 6, NULL, NULL, NULL, NULL),
(22, '', '1400.00', 'buy_stocks', '1396-10-23', 2, 6, 3, NULL, NULL, NULL),
(30, 'توضیحات اضافی', '100.00', 'resturant', '1396-10-28', 2, 1, NULL, NULL, 14, NULL),
(31, 'توضیحات بی فایده ', '100.00', 'resturant', '1396-10-28', 2, 1, NULL, NULL, 15, NULL),
(32, 'کریم جان کریمی', '200.00', 'resturant', '1396-10-28', 1, 4, NULL, NULL, 16, NULL),
(33, 'توضیحات .........', '300.00', 'resturant', '1396-10-28', 1, 4, NULL, NULL, 17, NULL),
(34, 'توضیحات برای سفارش ', '4000.00', 'kitchen_order', '1396-10-28', 1, 4, NULL, NULL, 18, NULL),
(35, 'توضیحات کریمی 3', '2500.00', 'kitchen_order', '1396-10-28', 1, 4, NULL, NULL, 19, NULL),
(36, 'خرید بادام', '1500.00', 'buy_stocks', '1396-10-29', 2, 3, 4, NULL, NULL, NULL),
(37, '', '50.00', 'resturant', '1396-11-01', 2, 1, NULL, NULL, 14, NULL),
(38, 'sdfs fsdf', '500.00', 'kitchen_order', '1396-11-02', 1, 4, NULL, NULL, 20, NULL),
(39, 'dfsd', '10000.00', 'kitchen_order', '1396-11-02', 1, 4, NULL, NULL, 21, NULL),
(40, '101010', '10.00', 'kitchen_order', '1396-11-02', 1, 4, NULL, NULL, 22, NULL),
(41, 'sdf wer', '50.00', 'kitchen_order', '1396-11-02', 1, 4, NULL, NULL, 23, NULL),
(42, 'dfg', '44.00', 'kitchen_order', '1396-11-02', 1, 4, NULL, NULL, 24, NULL),
(43, '55', '55.00', 'kitchen_order', '1396-11-02', 1, 4, NULL, NULL, 25, NULL),
(44, 'asdsd', '50.00', 'resturant', '1396-11-02', 1, 4, NULL, NULL, 26, NULL),
(45, 'fgh', '20.00', 'resturant', '1396-11-02', 1, 4, NULL, NULL, 27, NULL),
(46, 'zd', '50.00', 'resturant', '1396-11-02', 1, 4, NULL, NULL, 28, NULL),
(47, 'sdf', '20.00', 'resturant', '1396-11-02', 1, 4, NULL, NULL, 29, NULL),
(48, 'df', '4.00', 'resturant', '1396-11-02', 1, 4, NULL, NULL, 30, NULL),
(49, '4', '44.00', 'resturant', '1396-11-02', 1, 4, NULL, NULL, 31, NULL),
(50, '44', '44.00', 'resturant', '1396-11-02', 2, 1, NULL, NULL, 32, NULL),
(52, '', '80.00', 'daily_expence', '1396-11-03', 2, 1, 6, NULL, NULL, NULL),
(53, 'فقط یادداشت', '40.00', 'daily_expence', '1396-11-03', 2, 1, 7, NULL, NULL, NULL),
(54, 'برای رستورانت', '200.00', 'daily_expence', '1396-11-03', 2, 1, 8, NULL, NULL, NULL),
(55, 'یادداشت', '40.00', 'daily_expence', '1396-11-03', 2, 1, 9, NULL, NULL, NULL);

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
(1, 'خوراک', 1),
(2, 'بسته', 1),
(3, 'بوتل', 1),
(5, 'گیلاس', 1),
(6, 'کیلو', 0),
(7, 'سیر', 0),
(8, 'بسته', 0),
(9, 'کریت', 0),
(10, 'کارتن', 0),
(11, 'چهاریک', 0),
(12, 'پاو', 0),
(13, 'عدد', 1),
(14, 'عدد', 0),
(15, 'پارچه', 1),
(16, 'پارچه', 0);

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
(4, 'kazem', '2', 'kazem@1231', 2),
(5, 'jawad', '3', 'admin@1231', 3),
(6, 'admin', '1', 'admin@1231', 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `base_menus`
--
ALTER TABLE `base_menus`
  ADD PRIMARY KEY (`bm_id`),
  ADD KEY `SB_FK_SM` (`bm_cat_id`),
  ADD KEY `bm_cat_id` (`bm_cat_id`),
  ADD KEY `bm_unit_id` (`bm_unit_id`);

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
  ADD PRIMARY KEY (`cus_id`),
  ADD UNIQUE KEY `cus_unique_id` (`cus_unique_id`),
  ADD KEY `cus_acc_id` (`cus_acc_id`),
  ADD KEY `cus_acc_id_2` (`cus_acc_id`);

--
-- Indexes for table `desks`
--
ALTER TABLE `desks`
  ADD PRIMARY KEY (`desk_id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`disc_id`);

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
-- Indexes for table `menu_category`
--
ALTER TABLE `menu_category`
  ADD PRIMARY KEY (`mc_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ord_id`),
  ADD KEY `ord_cus_id` (`ord_cus_id`),
  ADD KEY `ord_desk_id` (`ord_desk_id`),
  ADD KEY `ord_desk_id_2` (`ord_desk_id`),
  ADD KEY `ord_cus_id_2` (`ord_cus_id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`part_id`),
  ADD KEY `PARTNER_FK_EMP` (`part_emp_id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`sal_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `stock_st_id` (`stock_st_id`),
  ADD KEY `STOCK_FK_ORD` (`stock_ord_id`);

--
-- Indexes for table `stock_units`
--
ALTER TABLE `stock_units`
  ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `sub_base_menu`
--
ALTER TABLE `sub_base_menu`
  ADD PRIMARY KEY (`sbm_id`),
  ADD KEY `sbm_bm_id` (`sbm_bm_id`,`sbm_sm_id`),
  ADD KEY `sbm_sm_id` (`sbm_sm_id`);

--
-- Indexes for table `sub_menus`
--
ALTER TABLE `sub_menus`
  ADD PRIMARY KEY (`sm_id`),
  ADD KEY `sm_unit_id` (`sm_unit_id`);

--
-- Indexes for table `sub_orders`
--
ALTER TABLE `sub_orders`
  ADD PRIMARY KEY (`sord_id`),
  ADD KEY `SORF_FK_ORD` (`sord_ord_id`),
  ADD KEY `sord_ord_id` (`sord_ord_id`),
  ADD KEY `sord_sm_id` (`sord_sm_id`),
  ADD KEY `sord_bm_id` (`sord_bm_id`);

--
-- Indexes for table `transections`
--
ALTER TABLE `transections`
  ADD PRIMARY KEY (`tr_id`),
  ADD KEY `tr_acc_id` (`tr_acc_id`),
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `tr_sal_id` (`tr_sal_id`),
  ADD KEY `TR_FK_ORD` (`tr_ord_id`),
  ADD KEY `TRANS_FK_PART` (`tr_part_id`);

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
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `base_menus`
--
ALTER TABLE `base_menus`
  MODIFY `bm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `company_info`
--
ALTER TABLE `company_info`
  MODIFY `ci_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20002;

--
-- AUTO_INCREMENT for table `desks`
--
ALTER TABLE `desks`
  MODIFY `desk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `disc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `expences`
--
ALTER TABLE `expences`
  MODIFY `dex_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `menu_category`
--
ALTER TABLE `menu_category`
  MODIFY `mc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ord_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `part_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `sal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock_units`
--
ALTER TABLE `stock_units`
  MODIFY `st_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sub_base_menu`
--
ALTER TABLE `sub_base_menu`
  MODIFY `sbm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sub_menus`
--
ALTER TABLE `sub_menus`
  MODIFY `sm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sub_orders`
--
ALTER TABLE `sub_orders`
  MODIFY `sord_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `transections`
--
ALTER TABLE `transections`
  MODIFY `tr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `base_menus`
--
ALTER TABLE `base_menus`
  ADD CONSTRAINT `BM_FK_MC` FOREIGN KEY (`bm_cat_id`) REFERENCES `menu_category` (`mc_id`),
  ADD CONSTRAINT `BM_FK_UNITS` FOREIGN KEY (`bm_unit_id`) REFERENCES `units` (`unit_id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`cus_acc_id`) REFERENCES `accounts` (`acc_id`);

--
-- Constraints for table `expences`
--
ALTER TABLE `expences`
  ADD CONSTRAINT `DEX_FK_BILL` FOREIGN KEY (`dex_bill_id`) REFERENCES `bills` (`bill_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `DEX_FK_ST` FOREIGN KEY (`dex_st_unit`) REFERENCES `stock_units` (`st_id`),
  ADD CONSTRAINT `DEX_FK_TRANS` FOREIGN KEY (`dex_tr_id`) REFERENCES `transections` (`tr_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `DEX_FK_UNIT` FOREIGN KEY (`dex_unit`) REFERENCES `units` (`unit_id`);

--
-- Constraints for table `partners`
--
ALTER TABLE `partners`
  ADD CONSTRAINT `PARTNER_FK_EMP` FOREIGN KEY (`part_emp_id`) REFERENCES `employees` (`emp_id`);

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `STOCK_FK_ORDER` FOREIGN KEY (`stock_ord_id`) REFERENCES `orders` (`ord_id`),
  ADD CONSTRAINT `STOCK_FK_ST` FOREIGN KEY (`stock_st_id`) REFERENCES `stock_units` (`st_id`);

--
-- Constraints for table `sub_base_menu`
--
ALTER TABLE `sub_base_menu`
  ADD CONSTRAINT `SBM_FK_BM` FOREIGN KEY (`sbm_bm_id`) REFERENCES `base_menus` (`bm_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `SBM_FK_SM` FOREIGN KEY (`sbm_sm_id`) REFERENCES `sub_menus` (`sm_id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_menus`
--
ALTER TABLE `sub_menus`
  ADD CONSTRAINT `SM_FK_UNITS` FOREIGN KEY (`sm_unit_id`) REFERENCES `units` (`unit_id`);

--
-- Constraints for table `sub_orders`
--
ALTER TABLE `sub_orders`
  ADD CONSTRAINT `SORD_FK_BM` FOREIGN KEY (`sord_bm_id`) REFERENCES `base_menus` (`bm_id`),
  ADD CONSTRAINT `SORD_FK_ORD` FOREIGN KEY (`sord_ord_id`) REFERENCES `orders` (`ord_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `SORD_FK_SM` FOREIGN KEY (`sord_sm_id`) REFERENCES `sub_menus` (`sm_id`);

--
-- Constraints for table `transections`
--
ALTER TABLE `transections`
  ADD CONSTRAINT `TRANS_FK_ACC` FOREIGN KEY (`tr_acc_id`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `TRANS_FK_BILL` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`bill_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `TRANS_FK_ORD` FOREIGN KEY (`tr_ord_id`) REFERENCES `orders` (`ord_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `TRANS_FK_PART` FOREIGN KEY (`tr_part_id`) REFERENCES `partners` (`part_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `TRANS_FK_SAL` FOREIGN KEY (`tr_sal_id`) REFERENCES `salary` (`sal_id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `USER_FK_EMP` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
