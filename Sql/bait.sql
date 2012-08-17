-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 14, 2012 at 05:00 PM
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
-- Table structure for table `bait`
--

CREATE TABLE IF NOT EXISTS `bait` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `odds` double DEFAULT NULL,
  `bait_amount` int(11) unsigned DEFAULT NULL,
  `member_id` tinyint(3) unsigned DEFAULT NULL,
  `horse_id` tinyint(3) unsigned DEFAULT NULL,
  `race_id` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34 ;

--
-- Dumping data for table `bait`
--

INSERT INTO `bait` (`id`, `odds`, `bait_amount`, `member_id`, `horse_id`, `race_id`) VALUES
(1, 5, 5, 1, 4, 123),
(2, 5, 5, 2, 4, 123),
(3, 5, 5, 3, 4, 123),
(4, 5, 5, 2, 16, 123),
(5, 5, 5, 3, 16, 123),
(6, 5, 5, 4, 16, 123),
(7, 5, 5, 1, 5, 123),
(8, 5, 5, 3, 5, 123),
(9, 5, 5, 4, 5, 123),
(10, 5, 5, 1, 3, 123),
(11, 5, 5, 3, 3, 123),
(12, 5, 5, 2, 6, 123),
(13, 5, 5, 4, 6, 123),
(14, 5, 5, 1, 12, 123),
(15, 5, 5, 4, 12, 123),
(16, 5, 5, 2, 1, 123),
(17, 5, 5, 3, 1, 123),
(18, 5, 5, 1, 2, 123),
(19, 5, 5, 2, 2, 123),
(20, 5, 5, 3, 2, 123),
(21, 5, 5, 4, 2, 123),
(22, 2, 5000, 1, 1, 123),
(23, 5, 5, 1, 6, 123),
(24, 5, 5, 1, 66, 123),
(25, 5, 5, 2, 66, 123),
(26, 0.65, 5800, 3, 12, 123),
(27, 5, 5, 4, 1, 123),
(28, 5, 5, 1, 56, 123),
(29, 5, 5, 2, 56, 123),
(30, 5, 5, 2, 89, 123),
(31, 5, 5, 1, 89, 123),
(32, 5, 5, 1, 7, 123),
(33, 5, 5, 4, 7, 123);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
