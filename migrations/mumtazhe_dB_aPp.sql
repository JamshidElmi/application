-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 24, 2018 at 05:13 AM
-- Server version: 5.6.32-78.1
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mumtazhe_dB_aPp`
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;

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
  `bill_type` tinyint(4) NOT NULL COMMENT 'عدد 0 برای مصارف روزانه عدد 1 برای خرید گدام',
  `bill_dex_type` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `desks`
--

CREATE TABLE IF NOT EXISTS `desks` (
  `desk_id` int(11) NOT NULL,
  `desk_name` varchar(512) NOT NULL,
  `desk_capacity` int(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE IF NOT EXISTS `discounts` (
  `disc_id` int(11) NOT NULL,
  `disc_name` varchar(64) NOT NULL,
  `disc_persent` decimal(10,2) NOT NULL COMMENT 'درصد تخفیف'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='جدول تخفیفات';

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `expence_category`
--

CREATE TABLE IF NOT EXISTS `expence_category` (
  `exp_cat_id` int(11) NOT NULL,
  `exp_cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `extra_expences`
--

CREATE TABLE IF NOT EXISTS `extra_expences` (
  `exp_id` int(11) NOT NULL,
  `exp_disc` text,
  `exp_amount` decimal(10,2) NOT NULL,
  `exp_date` date NOT NULL,
  `exp_cat_id` int(11) DEFAULT NULL COMMENT 'ای دی کتگوری مصرف'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `job_id` int(11) NOT NULL,
  `job_name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menu_category`
--

CREATE TABLE IF NOT EXISTS `menu_category` (
  `mc_id` int(11) NOT NULL,
  `mc_name` varchar(256) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='نوع منو یا اسم نوعیت منو که زیر شاخه این جدول لیست منو میباش';

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
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8 COMMENT='جدول سفارشات';

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE IF NOT EXISTS `partners` (
  `part_id` int(11) NOT NULL,
  `part_amount` decimal(10,2) NOT NULL COMMENT 'مقدار سهام',
  `part_persent` decimal(10,2) NOT NULL COMMENT 'درصدی سهامدار',
  `part_emp_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sub_base_menu`
--

CREATE TABLE IF NOT EXISTS `sub_base_menu` (
  `sbm_id` int(11) NOT NULL,
  `sbm_bm_id` int(11) NOT NULL COMMENT 'ای دی منوی اصلی',
  `sbm_sm_id` int(11) NOT NULL COMMENT 'ای دی منوی فرعی'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='جدول ایتم های انتخابی از منو برای جدول سفارشات';

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
) ENGINE=InnoDB AUTO_INCREMENT=179 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE IF NOT EXISTS `units` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(256) NOT NULL,
  `unit_type` tinyint(1) NOT NULL COMMENT 'آشپزخانه/رستورانت'
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

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
-- Indexes for table `expence_category`
--
ALTER TABLE `expence_category`
  ADD PRIMARY KEY (`exp_cat_id`);

--
-- Indexes for table `extra_expences`
--
ALTER TABLE `extra_expences`
  ADD PRIMARY KEY (`exp_id`), ADD KEY `exp_cat_id` (`exp_cat_id`), ADD KEY `exp_cat_id_2` (`exp_cat_id`);

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
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `base_menus`
--
ALTER TABLE `base_menus`
  MODIFY `bm_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `company_info`
--
ALTER TABLE `company_info`
  MODIFY `ci_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `desks`
--
ALTER TABLE `desks`
  MODIFY `desk_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `disc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `expences`
--
ALTER TABLE `expences`
  MODIFY `dex_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `expence_category`
--
ALTER TABLE `expence_category`
  MODIFY `exp_cat_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `extra_expences`
--
ALTER TABLE `extra_expences`
  MODIFY `exp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu_category`
--
ALTER TABLE `menu_category`
  MODIFY `mc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ord_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=111;
--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `part_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `sal_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stock_units`
--
ALTER TABLE `stock_units`
  MODIFY `st_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `sub_base_menu`
--
ALTER TABLE `sub_base_menu`
  MODIFY `sbm_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sub_menus`
--
ALTER TABLE `sub_menus`
  MODIFY `sm_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `sub_orders`
--
ALTER TABLE `sub_orders`
  MODIFY `sord_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transections`
--
ALTER TABLE `transections`
  MODIFY `tr_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=179;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
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
-- Constraints for table `extra_expences`
--
ALTER TABLE `extra_expences`
ADD CONSTRAINT `EXP_CAT` FOREIGN KEY (`exp_cat_id`) REFERENCES `expence_category` (`exp_cat_id`);

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
