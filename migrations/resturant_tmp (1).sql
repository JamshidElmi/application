-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2017 at 06:54 PM
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
-- Table structure for table `salary`
--

CREATE TABLE IF NOT EXISTS `salary` (
`sal_id` int(11) NOT NULL,
  `sal_amount` decimal(10,2) NOT NULL,
  `sal_remain` decimal(10,0) NOT NULL COMMENT 'باقیمانده معاش',
  `sal_tax` decimal(10,2) NOT NULL,
  `sal_bonus` decimal(10,2) NOT NULL,
  `sal_fine` decimal(10,2) NOT NULL,
  `sal_payable` decimal(10,2) NOT NULL,
  `sal_date` date NOT NULL,
  `sal_month` int(2) NOT NULL,
  `sal_desc` varchar(512) DEFAULT NULL,
  `sal_emp_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`sal_id`, `sal_amount`, `sal_remain`, `sal_tax`, `sal_bonus`, `sal_fine`, `sal_payable`, `sal_date`, `sal_month`, `sal_desc`, `sal_emp_id`) VALUES
(5, '10000.00', '5000', '0.00', '0.00', '0.00', '0.00', '1396-08-19', 8, 'sdf', 3),
(7, '10000.00', '5000', '0.00', '0.00', '0.00', '0.00', '1396-08-19', 8, 'fffffffff', 3),
(8, '10000.00', '3600', '1500.00', '200.00', '100.00', '13600.00', '1396-08-19', 3, 'ده هزار معاش', 6),
(9, '5000.00', '10000', '0.00', '0.00', '0.00', '0.00', '1396-08-19', 8, '', 1),
(10, '1500.00', '13499', '1.50', '0.00', '0.00', '14998.50', '1396-08-19', 6, '', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
 ADD PRIMARY KEY (`sal_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
MODIFY `sal_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
