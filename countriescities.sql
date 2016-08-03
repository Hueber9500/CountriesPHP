-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2016 at 04:30 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `countriescities`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--
-- Creation: Jun 29, 2016 at 12:55 AM
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `countryID` int(10) unsigned NOT NULL,
  `population` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `countryID` (`countryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `countryID`, `population`) VALUES
(27, 'Sofia', 1, 1500000),
(28, 'Paris', 4, 16000000),
(29, 'Munich', 3, 653234),
(30, 'Berlin', 3, 112354535);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--
-- Creation: Jun 29, 2016 at 12:53 AM
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(1, 'Bulgaria'),
(2, 'Greece'),
(3, 'Germany'),
(4, 'France'),
(5, 'UK'),
(6, 'Switzerland'),
(7, 'Italy'),
(8, 'Spain'),
(9, 'Sweden'),
(10, 'Norway');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`countryID`) REFERENCES `countries` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
