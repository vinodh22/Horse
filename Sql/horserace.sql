-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 06, 2012 at 07:21 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `horse`
--

CREATE TABLE IF NOT EXISTS `horse` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `horse_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `horse_number` tinyint(3) unsigned DEFAULT NULL,
  `race_number` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `horse`
--

INSERT INTO `horse` (`id`, `horse_name`, `horse_number`, `race_number`) VALUES
(1, 'Henry', 1, 123),
(2, 'Huge', 2, 123),
(3, 'Thomas', 3, 123),
(4, 'Gary', 4, 123),
(5, 'Jockey', 6, 123),
(6, 'Jim', 12, 123),
(7, 'Harry', 16, 123),
(8, 'Tom', 56, 123),
(9, 'Jasmin', 66, 123),
(10, 'King', 89, 123),
(11, 'Rino', 1, 22),
(12, 'Tom', 2, 22),
(13, 'Jim', 3, 22),
(14, 'Jerry', 4, 22),
(15, 'Huge', 5, 22),
(16, 'Carry', 6, 22),
(18, 'xxxx', 12, 16);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `name`) VALUES
(1, '1Vinodh'),
(2, '2Ram'),
(3, '3Jhon'),
(4, 'Rahim'),
(5, 'Ramesh'),
(6, 'salim'),
(9, 'vengat'),
(10, 'suresh'),
(13, 'ibrahim'),
(16, 'Harish'),
(19, 'ragav'),
(23, 'Lawrence'),
(24, '2Mark'),
(25, '16Henry'),
(26, 'Mark'),
(27, 'Senthil');

-- --------------------------------------------------------

--
-- Table structure for table `race`
--

CREATE TABLE IF NOT EXISTS `race` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `racing_number` tinyint(3) unsigned DEFAULT NULL,
  `racing_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `racing_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `race`
--

INSERT INTO `race` (`id`, `racing_number`, `racing_time`, `racing_date`, `duration`) VALUES
(1, 123, '12:00', '10.08.2012', '30'),
(5, 22, '12:30', '15.09.2012', '00:30'),
(7, 16, '07:45', '15.09.2012', '00:30');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
