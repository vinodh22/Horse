-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 06, 2012 at 06:35 PM
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
  `win_or_place` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=42 ;

--
-- Dumping data for table `bait`
--

INSERT INTO `bait` (`id`, `odds`, `bait_amount`, `member_id`, `horse_id`, `race_id`, `win_or_place`) VALUES
(1, 0.86, 8600, 13, 1, 123, 1),
(2, 0.88, 8700, 1, 1, 123, 0),
(3, 0.89, 3800, 9, 2, 123, 1),
(4, 0.87, 9700, 1, 2, 123, 0),
(5, 0.76, 7700, 10, 3, 123, 1),
(6, 0.75, 6600, 4, 3, 123, 0),
(8, 0.88, 6800, 10, 4, 123, 0),
(10, 0.86, 8800, 16, 6, 123, 1),
(11, 0.88, 9900, 3, 6, 123, 0),
(12, 0.88, 7500, 6, 12, 123, 1),
(13, 0.88, 8800, 2, 12, 123, 0),
(14, 0.77, 9700, 1, 16, 123, 1),
(15, 0.86, 6700, 10, 16, 123, 0),
(16, 0.82, 8800, 4, 56, 123, 1),
(17, 0.82, 7600, 4, 56, 123, 0),
(18, 0.92, 8600, 10, 66, 123, 1),
(20, 0.85, 7600, 1, 66, 123, 0),
(21, 0.77, 9500, 1, 89, 123, 1),
(22, 0.75, 8800, 10, 89, 123, 1),
(23, 0.85, 8800, 4, 89, 123, 0),
(24, 0.75, 7700, 13, 89, 123, 1),
(28, 0.85, 6800, 6, 89, 123, 0),
(29, 0.88, 7200, 13, 4, 123, 0),
(30, 0.75, 8800, 1, 3, 123, 0),
(31, 0.88, 9800, 2, 1, 123, 0),
(33, 0.85, 8800, 3, 66, 123, 1),
(34, 0.86, 7700, 3, 1, 123, 1),
(35, 0.88, 6800, 19, 4, 123, 1),
(36, 0.88, 7800, 26, 4, 123, 1),
(37, 0.88, 8000, 9, 4, 123, 1),
(38, 0.88, 9800, 23, 4, 123, 1),
(39, 0.88, 7700, 25, 4, 123, 1),
(40, 0.86, 9000, 1, 1, 22, 1),
(41, 0.76, 8800, 25, 3, 123, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
