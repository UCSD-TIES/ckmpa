-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 04, 2012 at 09:01 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `coastkeeper`
--

-- --------------------------------------------------------

--
-- Table structure for table `coastkeeper_datasheet`
--

CREATE TABLE IF NOT EXISTS `coastkeeper_datasheet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `coastkeeper_datasheet`
--

INSERT INTO `coastkeeper_datasheet` (`id`, `name`) VALUES
(1, 'Coastkeeper Datasheet');

-- --------------------------------------------------------

--
-- Table structure for table `coastkeeper_datasheet_category`
--

CREATE TABLE IF NOT EXISTS `coastkeeper_datasheet_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coastkeeper_datasheet_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `coastkeeper_datasheet_category`
--

INSERT INTO `coastkeeper_datasheet_category` (`id`, `coastkeeper_datasheet_id`, `name`) VALUES
(1, 1, 'Beach Uses'),
(2, 1, 'Ocean Uses'),
(3, 1, 'General Pollution Issues');

-- --------------------------------------------------------

--
-- Table structure for table `coastkeeper_datasheet_entry`
--

CREATE TABLE IF NOT EXISTS `coastkeeper_datasheet_entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coastkeeper_datasheet_category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `use_report` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `coastkeeper_datasheet_entry`
--

INSERT INTO `coastkeeper_datasheet_entry` (`id`, `coastkeeper_datasheet_category_id`, `name`, `use_report`) VALUES
(1, 1, 'Resting Leisure', 0),
(2, 1, 'Active or Sporting Leisure', 0),
(3, 1, 'Walking or Running', 0),
(4, 1, 'Picnic or Grilling', 0),
(5, 1, 'Domestic Animals', 0),
(6, 2, 'Surfing or Swimming', 0),
(7, 2, 'ACTIVE Shore Fishing', 0),
(8, 2, 'Recreational Boating', 0),
(9, 2, 'Commercial Boating', 0),
(10, 2, 'ACTIVE Commercial Boating', 0),
(11, 2, 'ACTIVE Recreational Boat Fishing', 0),
(12, 2, 'Diving', 0),
(13, 2, 'Kelp Harvesting', 0),
(14, 3, 'Runoff', 1),
(15, 3, 'Open Dumpster', 0),
(16, 3, 'Cigarette Butts', 0),
(17, 3, 'Animal Droppings', 0),
(18, 3, 'Litter', 0);

-- --------------------------------------------------------

--
-- Table structure for table `coastkeeper_location`
--

CREATE TABLE IF NOT EXISTS `coastkeeper_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `coastkeeper_datasheet_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `coastkeeper_location`
--

INSERT INTO `coastkeeper_location` (`id`, `name`, `coastkeeper_datasheet_id`) VALUES
(1, 'Matlahuayl SMR', 1),
(2, 'South La Jolla SMR', 1);

-- --------------------------------------------------------

--
-- Table structure for table `coastkeeper_patrol`
--

CREATE TABLE IF NOT EXISTS `coastkeeper_patrol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coastkeeper_volunteer_id` int(11) NOT NULL,
  `coastkeeper_partner_id` int(11) DEFAULT NULL,
  `coastkeeper_location_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `finished` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `coastkeeper_patrol_entry`
--

CREATE TABLE IF NOT EXISTS `coastkeeper_patrol_entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coastkeeper_patrol_id` int(11) NOT NULL,
  `coastkeeper_section_id` int(11) NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `coastkeeper_patrol_tally`
--

CREATE TABLE IF NOT EXISTS `coastkeeper_patrol_tally` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coastkeeper_patrol_entry_id` int(11) NOT NULL,
  `coastkeeper_datasheet_entry_id` int(11) NOT NULL,
  `tally` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `coastkeeper_section`
--

CREATE TABLE IF NOT EXISTS `coastkeeper_section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coastkeeper_location_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `coastkeeper_section`
--

INSERT INTO `coastkeeper_section` (`id`, `coastkeeper_location_id`, `name`) VALUES
(1, 1, 'Scripps Pier to Tower 31'),
(2, 1, 'Tower 31 to Boat Launch'),
(3, 1, 'Boat Launch to Coastal Access'),
(4, 1, 'Coast Walk Lookout'),
(5, 1, 'Point La Jolla / Bridge Club'),
(6, 2, 'Palomar Street'),
(7, 2, 'Costa and Chelsea Viewpoint'),
(8, 2, 'Hermosa Park'),
(9, 2, 'Forward Street Viewpoint'),
(10, 2, 'Calumet Park'),
(11, 2, 'Tourmaline Surf Park'),
(12, 2, 'Tourmaline to Diamond Street Beach Walk');

-- --------------------------------------------------------

--
-- Table structure for table `coastkeeper_volunteer`
--

CREATE TABLE IF NOT EXISTS `coastkeeper_volunteer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `is_admin` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `coastkeeper_volunteer`
--

INSERT INTO `coastkeeper_volunteer` (`id`, `first_name`, `last_name`, `username`, `password`, `is_admin`) VALUES
(1, 'Jeff', 'Schell', 'jeffschell', 'ae2b1fca515949e5d54fb22b8ed95575', 1),
(2, 'David', 'Drabik', 'daviddrabik', 'ae2b1fca515949e5d54fb22b8ed95575', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
