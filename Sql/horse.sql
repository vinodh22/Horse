-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 14, 2012 at 05:01 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `horserace`
--

-- --------------------------------------------------------

--
-- Table structure for table `horse`
--

CREATE TABLE IF NOT EXISTS `horse` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `horse_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `horse_number` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `horse`
--

INSERT INTO `horse` (`id`, `horse_name`, `horse_number`) VALUES
(1, 'aa', 1),
(2, 'bb', 2),
(3, 'cc', 3),
(4, 'dd', 4),
(5, 'ee', 12),
(6, 'ff', 56),
(7, 'gg', 66),
(8, 'hh', 89),
(9, 'ii', 6),
(10, 'jj', 7);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
