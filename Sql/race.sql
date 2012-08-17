-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 14, 2012 at 05:02 PM
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
-- Table structure for table `race`
--

CREATE TABLE IF NOT EXISTS `race` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `racing_number` tinyint(3) unsigned DEFAULT NULL,
  `racing_time` tinyint(3) unsigned DEFAULT NULL,
  `racing_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `duration` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `race`
--

INSERT INTO `race` (`id`, `racing_number`, `racing_time`, `racing_date`, `duration`) VALUES
(1, 123, 12, '10.08.2012', 30),
(2, 123, 12, '11.08.2012', 30),
(3, 123, 12, '30.09.2012', 30),
(4, 123, 12, '10.10.2012', 30);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
