-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2017 at 12:45 PM
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
(1, 'منوی درجه یک', '456.00', 'sdfsd', 'avatar041.png', 0, NULL),
(5, 'منوی درجه چهار', '560.00', 'توضیحات', 'avatar3.png', 0, NULL),
(6, 'کوکاکولا', '20.00', 'توضیحات لازم و ضروری', 'avatar1.png', 1, 1),
(7, 'منوی درجه چهارم', '560.00', 'توضیخات', 'avatar5.png', 0, NULL),
(8, 'منوی درجه هشت', '456.00', '', 'avatar1.png', 0, NULL),
(9, 'چلو کباب ایرانی', '120.00', 'چلو کباب اصل ایرانی', 'avatar3.png', 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `base_menus`
--
ALTER TABLE `base_menus`
  ADD PRIMARY KEY (`bm_id`),
  ADD KEY `SB_FK_SM` (`bm_cat_id`),
  ADD KEY `bm_cat_id` (`bm_cat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `base_menus`
--
ALTER TABLE `base_menus`
  MODIFY `bm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `base_menus`
--
ALTER TABLE `base_menus`
  ADD CONSTRAINT `BM_FK_MC` FOREIGN KEY (`bm_cat_id`) REFERENCES `menu_category` (`mc_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
