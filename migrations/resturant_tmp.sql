-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2017 at 12:41 PM
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
  `acc_date` date NOT NULL,
  `acc_type` tinyint(4) NOT NULL COMMENT 'عدد 0 برای صندوق اصلی عدد 1 برای حساب همکاران عدد 2 برای حساب مشتریان'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`acc_id`, `acc_name`, `acc_amount`, `acc_description`, `acc_date`, `acc_type`) VALUES
(20, ' حساب اصلی جدید', '2525.00', 'حساب اصلی شرکت \r\n', '1396-11-22', 0),
(21, 'همکار شماره یک', '-400.00', 'افتتاح حساب', '1396-08-20', 1),
(22, 'همکار شماره دو', '50000.00', 'افتتاح حساب همکار', '1396-08-20', 1),
(23, 'مشتری شماره یک', '-9940.00', 'افتتاح حساب', '1396-08-21', 2),
(24, 'همکار شماره سه', '5000.00', 'افتتاح حساب همکار 3', '1396-08-21', 1),
(25, 'مشتری شماره دو', '2500.00', 'افتتاح حساب مشتری 2', '1396-08-21', 2),
(26, 'صندوق مشتری جدید', '50000.00', 'افتتاح حساب', '1396-08-23', 2);

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
  `bm_cat_id` int(11) DEFAULT NULL COMMENT 'ای دی کتگوری منو'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `base_menus`
--

INSERT INTO `base_menus` (`bm_id`, `bm_name`, `bm_price`, `bm_desc`, `bm_picture`, `bm_type`, `bm_cat_id`) VALUES
(1, 'منوی درجه اول', '456.00', '', '11111.jpg', 0, NULL),
(5, 'منوی درجه دوم', '560.00', 'توضیحات', '22222.jpg', 0, NULL),
(6, 'کوکاکولا', '20.00', 'توضیحات لازم و ضروری', '3.jpg', 1, 4),
(7, 'منوی درجه سوم', '560.00', '', '3333.jpg', 0, NULL),
(8, 'منوی درجه چهارم', '456.00', '', '5555.jpg', 0, NULL),
(9, 'چلو کباب ایرانی', '120.00', 'چلو کباب اصل ایرانی', '9.jpg', 1, 3),
(10, 'جوجه کباب', '200.00', 'اختصاصی', '15.jpg', 1, 1),
(11, 'کوکاکولا متوسط', '30.00', 'کافی ', '4.jpg', 1, 4),
(12, 'اسپرایت', '50.00', 'کافی', '2.jpg', 1, 4),
(13, 'زرشک پلو', '20.00', 'نوشابه', '16.jpg', 1, 4),
(14, 'برگر متوسط', '25.00', 'جوس', '13.jpg', 1, 4),
(15, 'قابلی', '250.00', '', '8.jpg', 1, 3),
(16, 'کباب گوساله', '520.00', '', '7.jpg', 1, 1),
(17, 'برگر', '50.00', '', '10.jpg', 1, 1);

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
  `bill_type` tinyint(4) NOT NULL COMMENT 'عدد 0 برای مصارف روزانه عدد 1 برای خرید گدام'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`bill_id`, `bill_no`, `bill_shop`, `bill_date`, `bill_desc`, `bill_total_amount`, `bill_type`) VALUES
(16, '45854', 'دوکان مصارف روزانه', '1396-04-05', 'صرف پنج قلم جنس صحت است مجموع خریداری 2495 افغانی', '1925.00', 0),
(17, '23622', 'دوکان همکار صداقت', '1396-06-13', '4 قلم جنس صحت است مصارف گدام و خریداری برای گدام از همکار شماره یک', '7200.00', 1),
(18, '34875', 'دوکان احمد', '1396-09-09', 'یبل سییب', '11000.00', 1);

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
  `ci_constitute_date` date NOT NULL COMMENT 'سال تاسیس',
  `ci_website` varchar(64) NOT NULL,
  `ci_type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'OGoYC8', 'احمد', 'احمدی', '146486', 'کارمند دولت', 'شرکت مشارکت ', 'کابل ', 'غزنی ', 'کابل کوته سنگی سرک اول', 'email@domain.com', 'www.domain.com', '0777181828', '1396-08-23', 1, 'avatar2.png', 'مشتری خوب حساب است', 'ضامن ', '0785864255', 'آدرس کامل موجود نیست ', 0, 26),
(3, 'uStjnc', 'احسان جدید', 'ابراهیمی', '3453', 'کارمند دولت ', 'وطن ', 'کابل ', 'غزنی ', '       چوک غزنی ', 'email@domain.com', '', '0785865844', '1396-08-23', 0, 'avatar5.png', 'پسر خوب', '', '', '', 1, 25),
(5, '8kIXLt', 'مهدی', 'رحیمی', '34563', 'دانشجو', '', 'کابل ', 'بامیان ', 'آدرس دقیق مهدی جان', 'email@domain.com', '', '078595485#02015458455', '1396-08-24', 1, 'avatar04.png', '', '', '', '', 1, 23);

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
(1, 'میز', 4),
(4, 'میز شماره یک', 6),
(5, 'میز فامیلی وی آی پی', 12);

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
(1, 'علی رضا', 'سامیار', 'مدیر گدام', '15000', '1397-11-21', 'کابل', 'هرات', 'شهر نو کابل افغانستان ین قالب به صورت هست و برای بخش کنترل پنل و مدیریت سایت های مختلف مناسب می باشد.\r\n\r\nنسخه اصلی این قالب می باشد که توسط به صورت رایگان قرار داده شده است. شهر نو کابل افغانستان ین قالب به صورت هست و برای بخش کنترل پنل و مدیریت سایت های مختلف مناسب می باشد.\r\n\r\nنسخه اصلی این قالب می باشد که توسط به صورت رایگان قرار داده شده است.', 'email@domain.com', '0780525265', 1, 'avatar51.png', '0255', 'شهر نو کابل افغانستان ین قالب به صورت هست و برای بخش کنترل پنل و مدیریت سایت های مختلف مناسب می باشد.\r\n\r\nنسخه اصلی این قالب می باشد که توسط به صورت رایگان قرار داده شده است. شهر نو کابل افغانستان ین قالب به صورت هست و برای بخش کنترل پنل و مدیریت سایت های مختلف مناسب می باشد. نسخه اصلی این قالب می باشد که توسط به صورت رایگان قرار داده شده است. شهر نو کابل افغانستان ین قالب به صورت هست و برای بخش کنترل پنل و مدیریت سایت های مختلف مناسب می باشد.\r\n\r\nنسخه اصلی این قالب می باشد که توسط به صورت رایگان قرار داده شده است.', 0),
(3, 'سارا', 'شهیدی', 'سر آشپز', '10000', '1396-08-20', 'کابل', 'هرات', 'شهر نو کابل افغانستان', 'email@domain.com', '0780525265', 0, 'avatar2.png', '456789', '', 1),
(6, 'محمد', 'میرزائی', 'مدیر مسئول', '18000', '1396-11-15', 'دایکندی ', 'کابل', 'کابل چهار قلعه وزیر آباد کوچه گل شب بو پلاک 52 نرسیده به سرک 7 بیست متری کوکاکولا.', 'email@domain.com', '078585454', 1, 'avatar04.png', '5865485', 'ویژگی های قالب و تفاوت های آن با قالب اصلی:\r\n\r\n۱- قالب به صورت کامل و حرفه ای فارسی و راست چین شده.\r\n\r\n۲- انتخاب تاریخ به صورت شمسی یا دیتا پیکر توسط کتاب خانه باباخانی اضافه شده.\r\n\r\n۳- ویرایشگر CK Editor فارسی و راست چین شده.\r\n\r\n۴- ویرایشگر TinyMCE فارسی و راست چین شده و به قالب اضافه شده.\r\n\r\n۵- همچنین فونت فارسی برای خوانایی بیشتر حروف و اعداد فارسی به قالب افزوده شد.\r\n\r\n', 1),
(7, 'رضا', 'شایان', 'مدیر گدام', '12000', '1396-01-10', 'بامیان', 'کابل ', 'چهار قلعه وزیر آباد فلان سرک فلان کوچه ', 'reza@farakhaan.com', '078565475', 1, 'avatar.png', '45685', 'کارمند خوب', 0);

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
(37, 'پیاز 1', NULL, '120.00', 5, 16, '600.00', 16, 49),
(38, 'کچالو', NULL, '350.00', 2, 19, '700.00', 16, 49),
(39, 'گوشت سینه مرغ', NULL, '125.00', 5, 15, '625.00', 16, 49),
(42, 'آرد درجه دوم', 6, '80.00', 5, 24, '400.00', 17, 50),
(43, 'آرد درجه یک', 5, '1200.00', 3, 19, '3600.00', 17, 50),
(44, 'روغن نباتی', 7, '800.00', 4, 23, '3200.00', 17, 50),
(45, 'آرد درجه یک', 5, '1500.00', 5, 19, '7500.00', 18, 86),
(46, 'آرد درجه یک', 5, '1300.00', 2, 19, '2600.00', 18, 86),
(47, 'آرد درجه یک', 5, '900.00', 1, 19, '900.00', 18, 86);

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
(10, 'سرباز');

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
(1, 'کباب'),
(3, 'کباب با برنج '),
(4, 'نوشیدنی ها');

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
  `ord_date` date NOT NULL,
  `ord_time` time NOT NULL,
  `ord_price` decimal(10,0) NOT NULL,
  `ord_type` varchar(16) NOT NULL COMMENT 'نوعیت سفارش آشپزخانه / رستورانت',
  `ord_desk_id` int(11) DEFAULT NULL COMMENT 'ای دی میز',
  `ord_cus_id` int(11) DEFAULT NULL COMMENT 'ای دی مشتری'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='جدول سفارشات';

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ord_id`, `ord_desc`, `ord_date`, `ord_time`, `ord_price`, `ord_type`, `ord_desk_id`, `ord_cus_id`) VALUES
(31, '200 رسید', '1396-09-04', '00:00:00', '380', 'resturant', 0, 20),
(32, '50 pary', '1396-09-07', '20:06:00', '60', 'resturant', 4, 5),
(33, 'محفل مهدی رحیمی  22800 هزینه کلی و 20000 پراخت نمود', '1396-09-11', '18:20:00', '22800', 'kitchen', NULL, 5);

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
(20, '7000.00', '7600.00', '450.00', '200.00', '150.00', '14400.00', '1396-08-21', 8, 'پرداخت ابتدائی ', 1),
(21, '8000.00', '6430.00', '750.00', '300.00', '120.00', '14130.00', '1396-08-21', 1, 'پرداخت اولیه', 1),
(22, '10000.00', '4250.00', '450.00', '200.00', '500.00', '14050.00', '1396-09-02', 10, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `stock_id` int(11) NOT NULL,
  `stock_count` int(11) NOT NULL,
  `stock_st_id` int(11) NOT NULL,
  `stock_ord_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(3, 'نوشابه سوپرکولا', '20.00', '12', 50, 0, 5),
(5, 'آرد درجه یک', '1000.00', '19', 50, 6, 5),
(6, 'آرد درجه دوم', '1100.00', '24', 85, 0, 3),
(7, 'روغن نباتی', '250.00', '23', 5, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sub_menus`
--

CREATE TABLE `sub_menus` (
  `sm_id` int(11) NOT NULL,
  `sm_name` varchar(256) NOT NULL,
  `sm_desc` varchar(512) DEFAULT NULL,
  `sm_bm_id` int(11) DEFAULT NULL COMMENT 'ای دی منوی اصلی'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_menus`
--

INSERT INTO `sub_menus` (`sm_id`, `sm_name`, `sm_desc`, `sm_bm_id`) VALUES
(1, 'زیر منوی اول', 'توضیحات اول', 1),
(2, 'زیر منوی دوم', 'توضیحات دوم', 1),
(7, 'زیر منوی 1', 'توضیحات', 5),
(8, 'زیر منوی 4', '', 5),
(9, 'زیر منو برای 8', 'توضیحات 8', 8),
(10, 'زیر منو برای 8', 'توضیحات منوی 8-2', 8),
(11, 'زیر منو برای 8', 'توضیحات 3', 8);

-- --------------------------------------------------------

--
-- Table structure for table `sub_orders`
--

CREATE TABLE `sub_orders` (
  `sord_id` int(11) NOT NULL,
  `sord_bm_id` int(11) NOT NULL,
  `sord_count` int(11) NOT NULL,
  `sord_price` int(11) NOT NULL,
  `sord_ord_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='جدول ایتم های انتخابی از منو برای جدول سفارشات';

--
-- Dumping data for table `sub_orders`
--

INSERT INTO `sub_orders` (`sord_id`, `sord_bm_id`, `sord_count`, `sord_price`, `sord_ord_id`) VALUES
(27, 6, 3, 60, 31),
(28, 11, 4, 120, 31),
(29, 12, 4, 200, 31),
(30, 6, 3, 60, 32),
(31, 1, 50, 22800, 33);

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
  `tr_ord_id` int(11) DEFAULT NULL COMMENT 'ای دی سفارش'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transections`
--

INSERT INTO `transections` (`tr_id`, `tr_desc`, `tr_amount`, `tr_type`, `tr_date`, `tr_status`, `tr_acc_id`, `bill_id`, `tr_sal_id`, `tr_ord_id`) VALUES
(44, 'افتتاح حساب', '15000.00', 'credit_debit', '1396-08-20', 1, 21, NULL, NULL, NULL),
(45, 'افتتاح حساب', '50000.00', 'credit_debit', '1396-08-20', 1, 22, NULL, NULL, NULL),
(47, '3000 جمع برای همکار', '3000.00', 'credit_debit', '1396-08-21', 1, 21, NULL, NULL, NULL),
(48, '1000 برداشت از همکار', '1000.00', 'credit_debit', '1396-08-20', 2, 21, NULL, NULL, NULL),
(49, 'صرف پنج قلم جنس صحت است مجموع خریداری 2495 افغانی', '1925.00', 'daily_expence', '1396-04-05', 2, 20, 16, NULL, NULL),
(50, '4 قلم جنس صحت است مصارف گدام و خریداری برای گدام از همکار شماره یک', '7200.00', 'buy_stocks', '1396-06-13', 2, 21, 17, NULL, NULL),
(51, NULL, '6760.00', '', '0000-00-00', 0, NULL, NULL, NULL, NULL),
(52, 'پرداخت ابتدائی ', '5000.00', 'salary', '1396-08-21', 2, 20, NULL, 20, NULL),
(53, '2000 پرداخت دوباره ', '2000.00', 'salary', '1396-08-21', 2, 20, NULL, 20, NULL),
(54, 'پرداخت اولیه', '5000.00', 'salary', '1396-08-21', 2, 20, NULL, 21, NULL),
(55, '3000 پرداخت ', '3000.00', 'salary', '1396-08-21', 2, 20, NULL, 21, NULL),
(58, 'افتتاح حساب', '2000.00', 'credit_debit', '1396-08-21', 1, 23, NULL, NULL, NULL),
(59, 'افتتاح حساب', '5000.00', 'credit_debit', '1396-08-21', 1, 24, NULL, NULL, NULL),
(60, 'افتتاح حساب', '2500.00', 'credit_debit', '1396-08-21', 1, 25, NULL, NULL, NULL),
(61, '', '5000.00', 'credit_debit', '1396-08-21', 1, 20, NULL, NULL, NULL),
(62, 'افتتاح حساب', '50000.00', 'credit_debit', '1396-08-23', 1, 26, NULL, NULL, NULL),
(63, '', '5000.00', 'salary', '1396-09-02', 2, 20, NULL, 22, NULL),
(64, '', '5000.00', 'salary', '1396-09-02', 2, 20, NULL, 22, NULL),
(83, '200 رسید', '200.00', 'resturant', '1396-09-04', 2, 20, NULL, NULL, 31),
(84, '50 pary', '50.00', 'resturant', '1396-09-07', 1, 23, NULL, NULL, 32),
(85, 'محفل مهدی رحیمی  22800 هزینه کلی و 20000 پراخت نمود', '20000.00', 'kitchen_order', '1396-09-11', 1, 23, NULL, NULL, 33),
(86, 'یبل سییب', '11000.00', 'buy_stocks', '1396-09-09', 2, 21, 18, NULL, NULL);

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
-- Indexes for table `base_menus`
--
ALTER TABLE `base_menus`
  ADD PRIMARY KEY (`bm_id`),
  ADD KEY `SB_FK_SM` (`bm_cat_id`),
  ADD KEY `bm_cat_id` (`bm_cat_id`);

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
-- Indexes for table `sub_menus`
--
ALTER TABLE `sub_menus`
  ADD PRIMARY KEY (`sm_id`),
  ADD KEY `SM_FK_BM` (`sm_bm_id`);

--
-- Indexes for table `sub_orders`
--
ALTER TABLE `sub_orders`
  ADD PRIMARY KEY (`sord_id`),
  ADD KEY `SORF_FK_ORD` (`sord_ord_id`),
  ADD KEY `sord_ord_id` (`sord_ord_id`);

--
-- Indexes for table `transections`
--
ALTER TABLE `transections`
  ADD PRIMARY KEY (`tr_id`),
  ADD KEY `tr_acc_id` (`tr_acc_id`),
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `tr_sal_id` (`tr_sal_id`),
  ADD KEY `TR_FK_ORD` (`tr_ord_id`);

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
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `base_menus`
--
ALTER TABLE `base_menus`
  MODIFY `bm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `company_info`
--
ALTER TABLE `company_info`
  MODIFY `ci_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `desks`
--
ALTER TABLE `desks`
  MODIFY `desk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `expences`
--
ALTER TABLE `expences`
  MODIFY `dex_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `menu_category`
--
ALTER TABLE `menu_category`
  MODIFY `mc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ord_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `sal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stock_units`
--
ALTER TABLE `stock_units`
  MODIFY `st_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `sub_menus`
--
ALTER TABLE `sub_menus`
  MODIFY `sm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `sub_orders`
--
ALTER TABLE `sub_orders`
  MODIFY `sord_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `transections`
--
ALTER TABLE `transections`
  MODIFY `tr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
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
-- Constraints for table `base_menus`
--
ALTER TABLE `base_menus`
  ADD CONSTRAINT `BM_FK_MC` FOREIGN KEY (`bm_cat_id`) REFERENCES `menu_category` (`mc_id`);

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
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `STOCK_FK_ST` FOREIGN KEY (`stock_st_id`) REFERENCES `stock_units` (`st_id`);

--
-- Constraints for table `sub_menus`
--
ALTER TABLE `sub_menus`
  ADD CONSTRAINT `SM_FK_BM` FOREIGN KEY (`sm_bm_id`) REFERENCES `base_menus` (`bm_id`);

--
-- Constraints for table `sub_orders`
--
ALTER TABLE `sub_orders`
  ADD CONSTRAINT `SORD_FK_ORD` FOREIGN KEY (`sord_ord_id`) REFERENCES `orders` (`ord_id`) ON DELETE CASCADE;

--
-- Constraints for table `transections`
--
ALTER TABLE `transections`
  ADD CONSTRAINT `TRANS_FK_ACC` FOREIGN KEY (`tr_acc_id`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `TRANS_FK_BILL` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`bill_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `TRANS_FK_SAL` FOREIGN KEY (`tr_sal_id`) REFERENCES `salary` (`sal_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `TR_FK_ORD` FOREIGN KEY (`tr_ord_id`) REFERENCES `orders` (`ord_id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `USER_FK_EMP` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
