-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2017 at 07:35 PM
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
-- Table structure for table `discounts`
--

CREATE TABLE IF NOT EXISTS `discounts` (
`disc_id` int(11) NOT NULL,
  `disc_name` varchar(64) NOT NULL,
  `disc_persent` decimal(10,2) NOT NULL COMMENT 'درصد تخفیف'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='جدول تخفیفات';

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`disc_id`, `disc_name`, `disc_persent`) VALUES
(1, 'تخفیف درجه یک', '50.00'),
(2, 'تخفیف درجه یک فامیلی', '30.00'),
(4, 'تخفیف ویژه', '100.00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`ord_id` int(11) NOT NULL,
  `ord_desc` varchar(512) DEFAULT NULL,
  `ord_date` date NOT NULL,
  `ord_time` time NOT NULL,
  `ord_price` decimal(10,0) NOT NULL,
  `ord_discount` decimal(10,2) NOT NULL COMMENT 'مقدار تخفیف بر حسب فیصد',
  `ord_type` varchar(16) NOT NULL COMMENT 'نوعیت سفارش آشپزخانه / رستورانت',
  `ord_desk_id` int(11) DEFAULT NULL COMMENT 'ای دی میز',
  `ord_cus_id` int(11) DEFAULT NULL COMMENT 'ای دی مشتری'
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COMMENT='جدول سفارشات';

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ord_id`, `ord_desc`, `ord_date`, `ord_time`, `ord_price`, `ord_discount`, `ord_type`, `ord_desk_id`, `ord_cus_id`) VALUES
(31, '200 رسید', '1396-09-04', '00:00:00', '400', '0.00', 'resturant', 0, 20),
(32, '50 pary', '1396-09-07', '20:06:00', '80', '0.00', 'resturant', 4, 5),
(33, 'محفل مهدی رحیمی  22800 هزینه کلی و 20000 پراخت نمود', '1396-09-11', '18:20:00', '22800', '0.00', 'kitchen', NULL, 5),
(34, '50% تخفیف 5000 قیمت اصلی 500 باقی', '1396-09-14', '22:54:00', '2500', '50.00', 'kitchen', NULL, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
 ADD PRIMARY KEY (`disc_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`ord_id`), ADD KEY `ord_cus_id` (`ord_cus_id`), ADD KEY `ord_desk_id` (`ord_desk_id`), ADD KEY `ord_desk_id_2` (`ord_desk_id`), ADD KEY `ord_cus_id_2` (`ord_cus_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
MODIFY `disc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
MODIFY `ord_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
