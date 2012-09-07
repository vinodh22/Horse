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
-- Table structure for table `horse`
--

CREATE TABLE IF NOT EXISTS `horse` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `horse_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `horse_number` tinyint(3) unsigned DEFAULT NULL,
  `race_number` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

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
(16, 'Carry', 6, 22);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
