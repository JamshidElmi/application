-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2018 at 08:10 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`acc_id`, `acc_name`, `acc_amount`, `acc_description`, `acc_date`, `acc_type`) VALUES
(20, 'حساب رستورانت', '10100.00', 'حساب اصلی شرکت \r\n', '1396-11-22', 0),
(21, 'همکار شماره یک', '-400.00', 'افتتاح حساب', '1396-08-20', 1),
(22, 'همکار شماره دو', '50000.00', 'افتتاح حساب همکار', '1396-08-20', 1),
(23, 'مشتری شماره یک', '249560.00', 'افتتاح حساب', '1396-08-21', 2),
(24, 'همکار شماره سه', '5000.00', 'افتتاح حساب همکار 3', '1396-08-21', 1),
(25, 'مشتری شماره دو', '11744.00', 'افتتاح حساب مشتری 2', '1396-08-21', 2),
(26, 'صندوق مشتری جدید', '88289.00', 'افتتاح حساب', '1396-08-23', 2),
(30, 'سمیه جون', '30000.00', 'مشتری خیلی خوبی است و خوش حساب و شکیل و شکیبا میباشد.', '1396-10-03', 2);

-- --------------------------------------------------------

--
-- Table structure for table `base_menus`
--

CREATE TABLE IF NOT EXISTS `base_menus` (
`bm_id` int(11) NOT NULL,
  `bm_name` varchar(512) NOT NULL,
  `bm_price` decimal(10,2) DEFAULT NULL,
  `bm_desc` varchar(512) DEFAULT NULL,
  `bm_picture` varchar(256) DEFAULT NULL,
  `bm_type` tinyint(1) NOT NULL COMMENT 'عدد صفر برای آشپزخانه عدد یک برای رستورانت',
  `bm_unit_id` int(11) DEFAULT NULL COMMENT 'ای دی واحدات',
  `bm_cat_id` int(11) DEFAULT NULL COMMENT 'ای دی کتگوری منو'
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `base_menus`
--

INSERT INTO `base_menus` (`bm_id`, `bm_name`, `bm_price`, `bm_desc`, `bm_picture`, `bm_type`, `bm_unit_id`, `bm_cat_id`) VALUES
(1, 'منوی درجه اول', '456.00', '', '11111.jpg', 0, 20, NULL),
(5, 'منوی درجه دوم', '560.00', 'توضیحات', '22222.jpg', 0, 19, NULL),
(6, 'کوکاکولا', '20.00', 'توضیحات لازم و ضروری', '3.jpg', 1, 12, 4),
(7, 'منوی درجه سوم', '560.00', '', '3333.jpg', 0, 20, NULL),
(8, 'منوی درجه چهارم', '456.00', '', '5555.jpg', 0, 18, NULL),
(9, 'چلو کباب ایرانی', '120.00', 'چلو کباب اصل ایرانی', '9.jpg', 1, 19, 3),
(10, 'جوجه کباب', '200.00', 'اختصاصی', '15.jpg', 1, 18, 1),
(11, 'کوکاکولا متوسط', '30.00', 'کافی ', '4.jpg', 1, 16, 4),
(12, 'اسپرایت', '50.00', 'کافی', '2.jpg', 1, 12, 4),
(13, 'زرشک پلو', '20.00', 'نوشابه', '16.jpg', 1, 4, 4),
(14, 'برگر متوسط', '25.00', 'جوس', '13.jpg', 1, 15, 4),
(15, 'قابلی', '250.00', '', '8.jpg', 1, 20, 3),
(16, 'کباب گوساله', '520.00', '', '7.jpg', 1, 22, 1),
(17, 'برگر', '50.00', '', '10.jpg', 1, 23, 1),
(24, 'منوی بدون عکس', NULL, 'شش زیر منو موجود است', 'Profile-sm10.jpg', 0, 24, NULL),
(25, 'کباب شامی', '220.00', 'یک خوراک با دو عدد لیمو رایگان', 'avatar042.png', 1, 13, 1);

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
  `bill_type` tinyint(4) NOT NULL COMMENT 'عدد 0 برای مصارف روزانه عدد 1 برای خرید گدام'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

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

CREATE TABLE IF NOT EXISTS `company_info` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company_info`
--

INSERT INTO `company_info` (`ci_id`, `ci_full_name`, `ci_full_name_en`, `ci_boss_name`, `ci_manager_name`, `ci_address`, `ci_phones`, `ci_emails`, `ci_logo`, `ci_constitute_date`, `ci_website`, `ci_type`) VALUES
(1, 'آشپزخانه و رستورانت ممتاز هرات ', 'Mumtaz Herat Restaurant & Catering', 'محمد میرزائی', 'رضا شایان', ' کابل، کارته3، چهارراهی پل سرخ، جوار شفاخانه KMC و شفاخانه علی سینا', ' 71 71 11 0799 – 71 71 11 0786 – 31 33 251 020 ', 'info@mumtazherat.com', 'FINAL_Without_English_SM1.png', '1396-09-28', 'http://www.mumtazherat.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cus_id`, `cus_unique_id`, `cus_name`, `cus_lname`, `cus_national_id`, `cus_job`, `cus_org_name`, `cus_org_place`, `cus_cur_place`, `cus_address`, `cus_email`, `cus_site`, `cus_phones`, `cus_join_date`, `cus_gendar`, `cus_picture`, `cus_biography`, `cus_ref_full_name`, `cus_ref_phone`, `cus_ref_address`, `cus_type`, `cus_acc_id`) VALUES
(1, 'OGoYC8', 'احمد', 'احمدی', '146486', 'کارمند دولت', 'شرکت مشارکت ', 'کابل ', 'غزنی ', 'کابل کوته سنگی سرک اول', 'email@domain.com', 'www.domain.com', '0777181828', '1396-08-23', 1, 'avatar2.png', 'مشتری خوب حساب است', 'ضامن ', '0785864255', 'آدرس کامل موجود نیست ', 0, 26),
(3, 'uStjnc', 'احسان جدید', 'ابراهیمی', '3453', 'کارمند دولت ', 'وطن ', 'کابل ', 'غزنی ', '       چوک غزنی ', 'email@domain.com', '', '0785865844', '1396-08-23', 0, 'avatar5.png', 'پسر خوب', '', '', '', 1, 25),
(5, '8kIXLt', 'مهدی', 'رحیمی', '34563', 'دانشجو', '', 'کابل ', 'بامیان ', 'آدرس دقیق مهدی جان', 'email@domain.com', '', '078595485-02015458455', '1396-08-24', 1, 'avatar04.png', '', '', '', '', 1, 23),
(6, 'JTmZ2r4k', 'سمیه', 'سمیه پور', '141485', 'محصل', 'شرکت خصوصی برادران شکوری بجز سمیه', 'هرات', 'کابل', 'کابل قلعه فتح الله', 'somaye@gmail.com', '', '0788658585', '1396-10-03', 0, 'avatar2.png', 'دختر خوب و زیبایی هست.', '', '', '', 1, 30);

-- --------------------------------------------------------

--
-- Table structure for table `desks`
--

CREATE TABLE IF NOT EXISTS `desks` (
`desk_id` int(11) NOT NULL,
  `desk_name` varchar(512) NOT NULL,
  `desk_capacity` int(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `desks`
--

INSERT INTO `desks` (`desk_id`, `desk_name`, `desk_capacity`) VALUES
(1, 'میز', 4),
(4, 'میز شماره یک', 6),
(5, 'میز فامیلی وی آی پی', 12);

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE IF NOT EXISTS `discounts` (
  `disc_id` int(11) NOT NULL,
  `disc_name` varchar(64) NOT NULL,
  `disc_persent` decimal(10,2) NOT NULL COMMENT 'درصد تخفیف'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='جدول تخفیفات';

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`disc_id`, `disc_name`, `disc_persent`) VALUES
(0, 'تخفیف مهمان', '50.00'),
(1, 'بدون تخفیف', '0.00'),
(2, 'تخفیف درجه یک فامیلی', '30.00'),
(4, 'تخفیف ویژه', '100.00');

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
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expences`
--

INSERT INTO `expences` (`dex_id`, `dex_name`, `dex_st_unit`, `dex_price`, `dex_count`, `dex_unit`, `dex_total_amount`, `dex_bill_id`, `dex_tr_id`) VALUES
(37, 'پیاز 1', NULL, '120.00', 5, 16, '600.00', 16, 49),
(38, 'کچالو', NULL, '350.00', 2, 19, '700.00', 16, 49),
(39, 'گوشت سینه مرغ', NULL, '125.00', 5, 13, '625.00', 16, 49),
(42, 'آرد درجه دوم', 6, '80.00', 5, 24, '400.00', 17, 50),
(43, 'آرد درجه یک', 5, '1200.00', 3, 19, '3600.00', 17, 50),
(44, 'روغن نباتی', 7, '800.00', 4, 23, '3200.00', 17, 50),
(45, 'آرد درجه یک', 5, '1500.00', 5, 19, '7500.00', 18, 86),
(46, 'آرد درجه یک', 5, '1300.00', 2, 19, '2600.00', 18, 86),
(47, 'نوشابه سوپرکولا', 3, '900.00', 1, 12, '900.00', 18, 86);

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
(11, 'گارسون');

-- --------------------------------------------------------

--
-- Table structure for table `menu_category`
--

CREATE TABLE IF NOT EXISTS `menu_category` (
`mc_id` int(11) NOT NULL,
  `mc_name` varchar(256) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='نوع منو یا اسم نوعیت منو که زیر شاخه این جدول لیست منو میباش';

--
-- Dumping data for table `menu_category`
--

INSERT INTO `menu_category` (`mc_id`, `mc_name`) VALUES
(1, 'کباب'),
(3, 'کباب با برنج '),
(4, 'نوشیدنی ها'),
(5, 'سالاد');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COMMENT='جدول سفارشات';

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ord_id`, `ord_desc`, `ord_created_date`, `ord_date`, `ord_time`, `ord_price`, `ord_ext_charges`, `ord_discount`, `ord_type`, `ord_desk_id`, `ord_cus_id`) VALUES
(39, 'توضیحات...', '1396-09-29', '1396-09-29', '21:21:00', '2300', '0.00', '30.00', 'kitchen', NULL, 1),
(40, '800 قیمت اصلی 30% تخفیف 440 افغانی 500 رسید 60 افغانی باقی یک قلم زیرمنو', '1396-09-30', '1396-09-30', '18:15:00', '560', '0.00', '30.00', 'kitchen', NULL, 5),
(41, 'توضیحات خاص', '1396-09-30', '1396-09-30', '23:49:00', '22841', '0.00', '30.00', 'kitchen', NULL, 3),
(42, 'توضیحات آخر', '0000-00-00', '1396-09-30', '23:58:00', '858', '0.00', '30.00', 'resturant', 4, 1),
(43, 'در اسرع وقت رسیدگی شود سپاس', '1396-10-03', '1396-10-03', '19:01:00', '2505', '250.00', '0.00', 'kitchen', NULL, 6),
(44, '250 قیمت هر نفر 350.70000000005 قیمت مجموعی با 30% تخفیف 200 مصارف متفرقه 500 رسید 50.700000000005 باقیمانده ', '1396-10-08', '1396-10-08', '14:22:00', '251', '300.00', '50.00', 'kitchen', NULL, 3),
(45, 'پرداخت اولیه ', '0000-00-00', '1396-10-12', '23:14:00', '410', '0.00', '50.00', 'resturant', 4, 20);

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE IF NOT EXISTS `partners` (
`part_id` int(11) NOT NULL,
  `part_amount` decimal(10,2) NOT NULL COMMENT 'مقدار سهام',
  `part_persent` decimal(10,2) NOT NULL COMMENT 'درصدی سهامدار',
  `part_emp_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`part_id`, `part_amount`, `part_persent`, `part_emp_id`) VALUES
(7, '1050.00', '12.80', 1),
(13, '5150.00', '62.80', 3),
(14, '2000.00', '24.39', 6);

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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`sal_id`, `sal_amount`, `sal_remain`, `sal_tax`, `sal_bonus`, `sal_fine`, `sal_payable`, `sal_date`, `sal_month`, `sal_desc`, `sal_emp_id`) VALUES
(20, '7000.00', '7600.00', '450.00', '200.00', '150.00', '14400.00', '1396-08-21', 8, 'پرداخت ابتدائی ', 1),
(21, '8000.00', '6430.00', '750.00', '300.00', '120.00', '14130.00', '1396-08-21', 1, 'پرداخت اولیه', 1),
(22, '10000.00', '4250.00', '450.00', '200.00', '500.00', '14050.00', '1396-09-02', 10, '', 1),
(23, '10000.00', '4950.00', '450.00', '500.00', '100.00', '14450.00', '1396-09-14', 5, '', 1),
(24, '10000.00', '0.00', '0.00', '0.00', '0.00', '10000.00', '1396-09-14', 1, '', 3),
(25, '2000.00', '8000.00', '0.00', '0.00', '0.00', '10000.00', '1396-09-14', 2, '', 3),
(26, '2000.00', '8000.00', '0.00', '0.00', '0.00', '10000.00', '1396-09-14', 3, '', 3),
(27, '3000.00', '7000.00', '0.00', '0.00', '0.00', '10000.00', '1396-09-14', 9, '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE IF NOT EXISTS `stocks` (
`stock_id` int(11) NOT NULL,
  `stock_count` int(11) NOT NULL,
  `stock_total_price` decimal(10,2) NOT NULL,
  `stock_date` date DEFAULT NULL,
  `stock_type` varchar(32) NOT NULL COMMENT 'نوعیت مصارف گدام: فست  فود/ رستوزانت/ آشپزخانه',
  `stock_st_id` int(11) NOT NULL,
  `stock_ord_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`stock_id`, `stock_count`, `stock_total_price`, `stock_date`, `stock_type`, `stock_st_id`, `stock_ord_id`) VALUES
(15, 5, '100.00', NULL, 'resturant', 3, NULL),
(16, 1, '1000.00', NULL, 'resturant', 5, NULL),
(17, 3, '750.00', NULL, 'resturant', 7, NULL),
(18, 10, '200.00', '1396-09-22', 'fast_food', 3, NULL),
(19, 1, '1000.00', '1396-09-22', 'fast_food', 5, NULL),
(20, 3, '750.00', '1396-09-22', 'fast_food', 7, NULL),
(21, 1, '1100.00', NULL, 'kitchen', 6, 44),
(22, 2, '500.00', NULL, 'kitchen', 7, 44),
(23, 20, '400.00', '1396-10-08', 'resturant', 3, NULL),
(24, 1, '1100.00', '1396-10-08', 'resturant', 6, NULL),
(26, 50, '1000.00', '1396-10-08', 'resturant', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock_units`
--

CREATE TABLE IF NOT EXISTS `stock_units` (
`st_id` int(11) NOT NULL,
  `st_name` varchar(256) NOT NULL,
  `st_price` decimal(10,2) NOT NULL,
  `st_unit` varchar(256) NOT NULL COMMENT 'واحد مقیاسی',
  `st_max_count` int(11) NOT NULL COMMENT 'حد اکثر مقدار قابل گنجایش در گدام',
  `st_count` int(11) NOT NULL COMMENT 'تعداد موجود در گدام',
  `st_min_count` int(11) NOT NULL COMMENT 'تعداد قابل هشدار'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock_units`
--

INSERT INTO `stock_units` (`st_id`, `st_name`, `st_price`, `st_unit`, `st_max_count`, `st_count`, `st_min_count`) VALUES
(3, 'نوشابه سوپرکولا', '20.00', '12', 150, -5, 5),
(5, 'آرد درجه یک', '1000.00', '19', 50, 3, 5),
(6, 'آرد درجه دوم', '1100.00', '24', 85, 6, 3),
(7, 'روغن نباتی', '250.00', '23', 50, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sub_base_menu`
--

CREATE TABLE IF NOT EXISTS `sub_base_menu` (
`sbm_id` int(11) NOT NULL,
  `sbm_bm_id` int(11) NOT NULL COMMENT 'ای دی منوی اصلی',
  `sbm_sm_id` int(11) NOT NULL COMMENT 'ای دی منوی فرعی'
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_base_menu`
--

INSERT INTO `sub_base_menu` (`sbm_id`, `sbm_bm_id`, `sbm_sm_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 7),
(5, 1, 9),
(66, 5, 13),
(67, 7, 1),
(68, 7, 2),
(69, 7, 7),
(70, 7, 9),
(71, 7, 10),
(72, 7, 11),
(73, 7, 12),
(74, 7, 13),
(75, 7, 14),
(76, 24, 1),
(77, 24, 7),
(80, 24, 9),
(81, 24, 12),
(78, 24, 13),
(79, 24, 14);

-- --------------------------------------------------------

--
-- Table structure for table `sub_menus`
--

CREATE TABLE IF NOT EXISTS `sub_menus` (
`sm_id` int(11) NOT NULL,
  `sm_name` varchar(256) NOT NULL,
  `sm_count` decimal(10,1) NOT NULL DEFAULT '1.0',
  `sm_price` decimal(10,2) DEFAULT NULL,
  `sm_desc` varchar(512) DEFAULT NULL,
  `sm_unit_id` int(11) NOT NULL COMMENT 'ای دی واحد '
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_menus`
--

INSERT INTO `sub_menus` (`sm_id`, `sm_name`, `sm_count`, `sm_price`, `sm_desc`, `sm_unit_id`) VALUES
(1, 'زیر منوی 1', '1.5', '120.50', 'توضیحات اول', 18),
(2, 'زیر منوی 2', '1.0', '25.00', 'توضیحات دوم', 17),
(7, 'زیر منوی 3', '1.0', '25.00', 'توضیحات', 18),
(9, 'زیر منوی 5', '1.0', '80.00', 'توضیحات 8', 20),
(10, 'زیر منوی 6', '1.0', '20.00', 'توضیحات منوی 8-2', 22),
(11, 'زیر منوی 7', '1.0', '50.00', 'توضیحات 3', 23),
(12, 'زیر منوی 8', '1.0', '50.00', 'توضیحات ... ', 16),
(13, 'زیر منوی 9', '1.0', '15.00', 'یک قطی برای دو نفر', 17),
(14, 'زیر منوی 10', '1.0', '120.00', 'برای هر نفر یک عدد', 16),
(15, 'زیر منوی 2', '1.0', '25.00', 'توضیحات دومfd', 16);

-- --------------------------------------------------------

--
-- Table structure for table `sub_orders`
--

CREATE TABLE IF NOT EXISTS `sub_orders` (
`sord_id` int(11) NOT NULL,
  `sord_bm_id` int(11) NOT NULL,
  `sord_sm_id` int(11) DEFAULT NULL COMMENT 'ای دی زیرمنو',
  `sord_count` int(11) DEFAULT NULL,
  `sord_price` int(11) DEFAULT NULL,
  `sord_ord_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 COMMENT='جدول ایتم های انتخابی از منو برای جدول سفارشات';

--
-- Dumping data for table `sub_orders`
--

INSERT INTO `sub_orders` (`sord_id`, `sord_bm_id`, `sord_sm_id`, `sord_count`, `sord_price`, `sord_ord_id`) VALUES
(50, 1, 1, 10, 230, 39),
(51, 1, 2, 10, 230, 39),
(52, 1, 7, 10, 230, 39),
(53, 1, 9, 10, 230, 39),
(54, 24, 9, 10, 80, 40),
(55, 24, 9, 251, 130, 41),
(56, 24, 12, 251, 130, 41),
(57, 15, NULL, 5, 1250, 42),
(58, 9, NULL, 6, 720, 42),
(59, 6, NULL, 2, 40, 42),
(60, 11, NULL, 1, 30, 42),
(68, 1, 1, 10, 251, 43),
(69, 1, 2, 10, 251, 43),
(70, 1, 7, 10, 251, 43),
(71, 1, 9, 10, 251, 43),
(76, 1, 1, 2, 251, 44),
(77, 1, 2, 2, 251, 44),
(78, 1, 7, 2, 251, 44),
(79, 1, 9, 2, 251, 44),
(80, 15, NULL, 2, 500, 45),
(81, 15, NULL, 2, 500, 45),
(82, 12, NULL, 2, 100, 45);

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
  `tr_sal_id` int(11) DEFAULT NULL COMMENT 'ای دی معاش کارمند',
  `tr_ord_id` int(11) DEFAULT NULL COMMENT 'ای دی سفارش',
  `tr_part_id` int(11) DEFAULT NULL COMMENT 'ای دی سهامداران'
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transections`
--

INSERT INTO `transections` (`tr_id`, `tr_desc`, `tr_amount`, `tr_type`, `tr_date`, `tr_status`, `tr_acc_id`, `bill_id`, `tr_sal_id`, `tr_ord_id`, `tr_part_id`) VALUES
(44, 'افتتاح حساب', '15000.00', 'credit_debit', '1396-08-20', 1, 21, NULL, NULL, NULL, NULL),
(45, 'افتتاح حساب', '50000.00', 'credit_debit', '1396-08-20', 1, 22, NULL, NULL, NULL, NULL),
(47, '3000 جمع برای همکار', '3000.00', 'credit_debit', '1396-08-21', 1, 21, NULL, NULL, NULL, NULL),
(48, '1000 برداشت از همکار', '1000.00', 'credit_debit', '1396-08-20', 2, 21, NULL, NULL, NULL, NULL),
(49, 'صرف پنج قلم جنس صحت است مجموع خریداری 2495 افغانی', '1925.00', 'daily_expence', '1396-04-05', 2, 20, 16, NULL, NULL, NULL),
(50, '4 قلم جنس صحت است مصارف گدام و خریداری برای گدام از همکار شماره یک', '7200.00', 'buy_stocks', '1396-06-13', 2, 21, 17, NULL, NULL, NULL),
(51, NULL, '6760.00', '', '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL),
(52, 'پرداخت ابتدائی ', '5000.00', 'salary', '1396-08-21', 2, 20, NULL, 20, NULL, NULL),
(53, '2000 پرداخت دوباره ', '2000.00', 'salary', '1396-08-21', 2, 20, NULL, 20, NULL, NULL),
(54, 'پرداخت اولیه', '5000.00', 'salary', '1396-08-21', 2, 20, NULL, 21, NULL, NULL),
(55, '3000 پرداخت ', '3000.00', 'salary', '1396-08-21', 2, 20, NULL, 21, NULL, NULL),
(58, 'افتتاح حساب', '2000.00', 'credit_debit', '1396-08-21', 1, 23, NULL, NULL, NULL, NULL),
(59, 'افتتاح حساب', '5000.00', 'credit_debit', '1396-08-21', 1, 24, NULL, NULL, NULL, NULL),
(60, 'افتتاح حساب', '2500.00', 'credit_debit', '1396-08-21', 1, 25, NULL, NULL, NULL, NULL),
(61, '', '5000.00', 'credit_debit', '1396-08-21', 1, 20, NULL, NULL, NULL, NULL),
(62, 'افتتاح حساب', '50000.00', 'credit_debit', '1396-08-23', 1, 26, NULL, NULL, NULL, NULL),
(63, '', '5000.00', 'salary', '1396-09-02', 2, 20, NULL, 22, NULL, NULL),
(64, '', '5000.00', 'salary', '1396-09-02', 2, 20, NULL, 22, NULL, NULL),
(86, 'یبل سییب', '11000.00', 'buy_stocks', '1396-09-09', 2, 21, 18, NULL, NULL, NULL),
(87, '', '5000.00', 'salary', '1396-09-14', 2, 20, NULL, 23, NULL, NULL),
(88, '', '5000.00', 'salary', '1396-09-14', 2, 20, NULL, 23, NULL, NULL),
(89, '', '2000.00', 'salary', '1396-09-14', 2, 20, NULL, 24, NULL, NULL),
(90, '', '2000.00', 'salary', '1396-09-14', 2, 20, NULL, 25, NULL, NULL),
(91, '', '2000.00', 'salary', '1396-09-14', 2, 20, NULL, 26, NULL, NULL),
(92, '', '3000.00', 'salary', '1396-09-14', 2, 20, NULL, 27, NULL, NULL),
(93, '', '8000.00', 'salary', '1396-09-14', 2, 20, NULL, 24, NULL, NULL),
(105, '', '50.00', 'partner_credit_debit', '1396-09-19', 1, 20, NULL, NULL, NULL, 7),
(106, '', '50.00', 'partner_credit_debit', '1396-09-19', 1, 20, NULL, NULL, NULL, 7),
(107, '', '100.00', 'partner_credit_debit', '1396-09-19', 1, 20, NULL, NULL, NULL, 7),
(109, '', '200.00', 'partner_credit_debit', '1396-09-19', 2, 20, NULL, NULL, NULL, 7),
(117, 'fdg', '100.00', 'partner_credit_debit', '1396-09-20', 1, 20, NULL, NULL, NULL, 7),
(118, 'df', '500.00', 'partner_credit_debit', '1396-09-20', 1, 20, NULL, NULL, NULL, 7),
(124, '', '2000.00', 'partner_credit_debit', '1396-09-20', 1, 20, NULL, NULL, NULL, 14),
(127, 'توضیحات...', '1000.00', 'kitchen_order', '1396-09-29', 1, 26, NULL, NULL, 39, NULL),
(128, '800 قیمت اصلی 30% تخفیف 440 افغانی 500 رسید 60 افغانی باقی یک قلم زیرمنو', '500.00', 'kitchen_order', '1396-09-30', 1, 23, NULL, NULL, 40, NULL),
(129, 'توضیحات خاص', '250.00', 'kitchen_order', '1396-09-30', 1, 25, NULL, NULL, 41, NULL),
(130, 'توضیحات آخر', '700.00', 'resturant', '1396-09-30', 1, 26, NULL, NULL, 42, NULL),
(131, '11 افغانی ', '11.00', 'resturant', '1396-10-01', 2, 26, NULL, NULL, 42, NULL),
(132, 'افتتاح حساب', '30000.00', 'credit_debit', '1396-10-03', 1, 30, NULL, NULL, NULL, NULL),
(133, 'در اسرع وقت رسیدگی شود سپاس', '0.00', 'kitchen_order', '1396-10-03', 1, 30, NULL, NULL, 43, NULL),
(134, '250 قیمت هر نفر 350.70000000005 قیمت مجموعی با 30% تخفیف 200 مصارف متفرقه 500 رسید 50.700000000005 باقیمانده ', '500.00', 'kitchen_order', '1396-10-08', 1, 25, NULL, NULL, 44, NULL),
(135, '26 رسید برای دوم', '26.00', 'kitchen_order', '1396-10-08', 2, 25, NULL, NULL, 44, NULL),
(136, 'صفر ساختن صندوق', '24575.00', 'credit_debit', '1396-10-12', 1, 20, NULL, NULL, NULL, NULL),
(137, 'جمع شد', '10000.00', 'credit_debit', '1396-10-12', 1, 20, NULL, NULL, NULL, NULL),
(138, 'پرداخت اولیه ', '100.00', 'resturant', '1396-10-12', 2, 20, NULL, NULL, 45, NULL),
(139, '', '5000.00', 'partner_credit_debit', '1396-10-12', 1, 20, NULL, NULL, NULL, 13);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_type`, `user_pass`, `emp_id`) VALUES
(3, '1231', '1', '1231', 1),
(4, 'mohammad', '2', '123112311231', 6);

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
 ADD PRIMARY KEY (`bm_id`), ADD KEY `SB_FK_SM` (`bm_cat_id`), ADD KEY `bm_cat_id` (`bm_cat_id`), ADD KEY `bm_unit_id` (`bm_unit_id`);

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
 ADD PRIMARY KEY (`cus_id`), ADD UNIQUE KEY `cus_unique_id` (`cus_unique_id`), ADD KEY `cus_acc_id` (`cus_acc_id`), ADD KEY `cus_acc_id_2` (`cus_acc_id`);

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
 ADD PRIMARY KEY (`dex_id`), ADD KEY `dex_unit` (`dex_unit`), ADD KEY `dex_bill_id` (`dex_bill_id`), ADD KEY `dex_st_unit` (`dex_st_unit`), ADD KEY `dex_tr_id` (`dex_tr_id`);

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
 ADD PRIMARY KEY (`ord_id`), ADD KEY `ord_cus_id` (`ord_cus_id`), ADD KEY `ord_desk_id` (`ord_desk_id`), ADD KEY `ord_desk_id_2` (`ord_desk_id`), ADD KEY `ord_cus_id_2` (`ord_cus_id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
 ADD PRIMARY KEY (`part_id`), ADD KEY `PARTNER_FK_EMP` (`part_emp_id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
 ADD PRIMARY KEY (`sal_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
 ADD PRIMARY KEY (`stock_id`), ADD KEY `stock_st_id` (`stock_st_id`), ADD KEY `STOCK_FK_ORD` (`stock_ord_id`);

--
-- Indexes for table `stock_units`
--
ALTER TABLE `stock_units`
 ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `sub_base_menu`
--
ALTER TABLE `sub_base_menu`
 ADD PRIMARY KEY (`sbm_id`), ADD KEY `sbm_bm_id` (`sbm_bm_id`,`sbm_sm_id`), ADD KEY `sbm_sm_id` (`sbm_sm_id`);

--
-- Indexes for table `sub_menus`
--
ALTER TABLE `sub_menus`
 ADD PRIMARY KEY (`sm_id`), ADD KEY `sm_unit_id` (`sm_unit_id`);

--
-- Indexes for table `sub_orders`
--
ALTER TABLE `sub_orders`
 ADD PRIMARY KEY (`sord_id`), ADD KEY `SORF_FK_ORD` (`sord_ord_id`), ADD KEY `sord_ord_id` (`sord_ord_id`), ADD KEY `sord_sm_id` (`sord_sm_id`), ADD KEY `sord_bm_id` (`sord_bm_id`);

--
-- Indexes for table `transections`
--
ALTER TABLE `transections`
 ADD PRIMARY KEY (`tr_id`), ADD KEY `tr_acc_id` (`tr_acc_id`), ADD KEY `bill_id` (`bill_id`), ADD KEY `tr_sal_id` (`tr_sal_id`), ADD KEY `TR_FK_ORD` (`tr_ord_id`), ADD KEY `TRANS_FK_PART` (`tr_part_id`);

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
MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `base_menus`
--
ALTER TABLE `base_menus`
MODIFY `bm_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `company_info`
--
ALTER TABLE `company_info`
MODIFY `ci_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `desks`
--
ALTER TABLE `desks`
MODIFY `desk_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `expences`
--
ALTER TABLE `expences`
MODIFY `dex_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `menu_category`
--
ALTER TABLE `menu_category`
MODIFY `mc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
MODIFY `ord_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
MODIFY `part_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
MODIFY `sal_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `stock_units`
--
ALTER TABLE `stock_units`
MODIFY `st_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `sub_base_menu`
--
ALTER TABLE `sub_base_menu`
MODIFY `sbm_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `sub_menus`
--
ALTER TABLE `sub_menus`
MODIFY `sm_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `sub_orders`
--
ALTER TABLE `sub_orders`
MODIFY `sord_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `transections`
--
ALTER TABLE `transections`
MODIFY `tr_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=140;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
