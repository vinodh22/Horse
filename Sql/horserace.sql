-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 17, 2012 at 02:30 PM
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
  `odds` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bait_amount` int(11) unsigned DEFAULT NULL,
  `member_id` tinyint(3) unsigned DEFAULT NULL,
  `horse_id` tinyint(3) unsigned DEFAULT NULL,
  `race_id` int(11) unsigned DEFAULT NULL,
  `win_or_place` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=184 ;

--
-- Dumping data for table `bait`
--

INSERT INTO `bait` (`id`, `odds`, `bait_amount`, `member_id`, `horse_id`, `race_id`, `win_or_place`) VALUES
(1, '0.86', 8600, 13, 1, 123, 1),
(3, '0.86', 3800, 9, 2, 123, 1),
(10, '0.86', 8800, 16, 6, 123, 1),
(11, '0.88', 9900, 3, 6, 123, 0),
(12, '0.88', 7500, 6, 12, 123, 1),
(14, '0.77', 9700, 1, 16, 123, 1),
(15, '0.86', 6700, 10, 16, 123, 0),
(16, '0.82', 8800, 4, 56, 123, 1),
(17, '0.82', 7600, 4, 56, 123, 0),
(18, '0.92', 8600, 10, 66, 123, 1),
(20, '0.85', 8500, 1, 66, 123, 0),
(21, '0.77', 9500, 1, 89, 123, 1),
(23, '0.85', 8800, 4, 89, 123, 0),
(24, '0.75', 8500, 13, 89, 123, 1),
(28, '0.85', 6800, 6, 89, 123, 0),
(31, '0.88', 9800, 2, 1, 123, 0),
(34, '0.86', 7700, 3, 1, 123, 1),
(40, '0.86', 9000, 1, 1, 22, 1),
(42, '0.75', 8600, 1, 3, 22, 0),
(43, '0.88', 8500, 1, 12, 123, 1),
(49, '0.89', 7500, 25, 2, 123, 1),
(51, '0.86', 7800, 1, 6, 123, 1),
(61, '0.88', 8500, 25, 6, 123, 0),
(67, '0.86', 9000, 25, 6, 123, 1),
(96, '0.76', 9300, 36, 4, 123, 0),
(97, '0.75', 240, 75, 3, 22, 0),
(98, '0.75', 8700, 77, 3, 22, 0),
(100, '0.86', 8500, 78, 1, 123, 1),
(122, '0.76', 8700, 111, 4, 123, 0),
(123, '0.85', 8600, 81, 3, 123, 1),
(126, '0.96', 7500, 9, 2, 35, 0),
(127, '0.78', 6800, 13, 1, 35, 1),
(128, '0.92', 5800, 27, 2, 35, 1),
(129, '0.92', 7900, 114, 2, 35, 1),
(157, '0.76', 5600, 95, 2, 16, 1),
(158, '0.78', 7500, 6, 3, 16, 1),
(159, '0.76', 7800, 10, 3, 16, 0),
(161, '0.78', 8600, 27, 2, 16, 0),
(164, '0.85', 9800, 10, 3, 123, 1),
(166, '0.76', 7800, 75, 4, 123, 0),
(171, '0.86', 8200, 81, 12, 123, 0),
(172, '0.86', 7800, 27, 12, 123, 0),
(173, '0.76', 7800, 95, 2, 123, 0),
(174, '0.86', 7800, 27, 3, 123, 0),
(176, '0.85', 6800, 13, 3, 123, 1),
(177, '0.85', 6700, 27, 3, 123, 1),
(178, '0.85', 7600, 6, 3, 123, 1),
(181, '0.85', 3500, 4, 3, 123, 1),
(183, '0.76', 8600, 19, 4, 123, 1);

-- --------------------------------------------------------

--
-- Table structure for table `horse`
--

CREATE TABLE IF NOT EXISTS `horse` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `horse_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `horse_number` tinyint(3) unsigned DEFAULT NULL,
  `race_number` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=219 ;

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
(18, 'xxxx', 2, 16),
(141, 'qwert', 5, 3),
(142, 'qsdc', 1, 3),
(143, 'wdfc', 2, 3),
(144, 'q', 1, 1),
(145, 'w', 2, 1),
(146, 'e', 3, 1),
(147, 'r', 4, 1),
(148, 't', 5, 1),
(150, 'sdfds', 12, 1),
(151, 'q', 1, 124),
(152, 'e', 2, 124),
(153, 'q', 1, 1244),
(154, 'w', 2, 1244),
(155, 'e', 3, 1244),
(156, 'r', 4, 1244),
(157, 't', 5, 1244),
(158, 'y', 6, 1244),
(159, 'u', 7, 1244),
(160, 'i', 8, 1244),
(161, 'o', 9, 1244),
(162, 'a', 1, 1234),
(163, 'b', 2, 1234),
(164, 'c', 3, 1234),
(165, 'Hello', 1, 12),
(166, 'q', 2, 12),
(167, 'w', 3, 12),
(168, 'r', 4, 12),
(181, 'q', 1, 121),
(182, 'w', 2, 121),
(183, 'q', 1, 121),
(184, 'w', 2, 121),
(185, 'q', 1, 121),
(186, 'w', 2, 121),
(187, 'q', 1, 85),
(188, 'w', 2, 85),
(189, 'MUNIYANDI', 1, 543),
(190, 'ganeshan', 2, 543),
(191, 'krishanan', 3, 543),
(192, 'kuamran', 4, 543),
(193, 'jonhy', 5, 543),
(194, 'bunny', 6, 543),
(216, 'q', 1, 35),
(217, 'w', 2, 35),
(218, 'rg', 3, 16);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=115 ;

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
(27, 'Senthil'),
(30, '1qwerty'),
(35, 'Henry'),
(36, '09Henry'),
(75, 'qwerty'),
(76, 'asdf'),
(77, 'jksf'),
(81, 'vinodh'),
(82, '1vinodh'),
(83, '22.vinodh'),
(93, 'harish'),
(95, 'qwe'),
(96, 'qwerty'),
(97, '12.harish'),
(98, 'harish'),
(99, 'harish'),
(100, 'harish'),
(101, 'harish'),
(102, 'harish'),
(103, 'harish'),
(104, 'harish'),
(105, '1hatri'),
(106, 'jhhasd'),
(107, 'hrmi'),
(108, 'Dev'),
(109, 'Senthjil'),
(110, '1.Vinodh'),
(111, 'Vinodh'),
(112, '11Vinodh'),
(113, 'qwq'),
(114, 'Vicky');

-- --------------------------------------------------------

--
-- Table structure for table `race`
--

CREATE TABLE IF NOT EXISTS `race` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `racing_number` int(11) unsigned DEFAULT NULL,
  `racing_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `racing_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=333 ;

--
-- Dumping data for table `race`
--

INSERT INTO `race` (`id`, `racing_number`, `racing_time`, `racing_date`) VALUES
(1, 123, '12:00', '10.08.2012'),
(5, 22, '12:30', '15.09.2012'),
(7, 16, '07:45', '15.09.2012'),
(300, 3, '09:00', '21.09.2012'),
(306, 1, '06:00', '20.09.2012'),
(312, 124, '00:15', '27.09.2012'),
(313, 1244, '00:14', '29.09.2012'),
(314, 1234, '02:00', '14.09.2012'),
(316, 12, '08:00', '27.09.2012'),
(317, 121, '08:00', '21.09.2012'),
(318, 85, '06:00', '19.09.2012'),
(319, 543, '09:25', '19.09.2012'),
(330, 37, '09:00', '28.09.2012'),
(332, 35, '08:00', '20.09.2012');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
