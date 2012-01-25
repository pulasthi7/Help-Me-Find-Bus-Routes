-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 25, 2012 at 07:40 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `busroute`
--

-- --------------------------------------------------------

--
-- Table structure for table `halt`
--

CREATE TABLE IF NOT EXISTS `halt` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `alias` varchar(10) NOT NULL,
  `special` tinyint(1) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `halt`
--


-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE IF NOT EXISTS `route` (
  `id` int(11) NOT NULL,
  `number` varchar(6) NOT NULL,
  `start_id` int(11) NOT NULL,
  `end_id` int(11) NOT NULL,
  KEY `end_id` (`end_id`),
  KEY `start_id` (`start_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `route`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `route`
--
ALTER TABLE `route`
  ADD CONSTRAINT `route_ibfk_1` FOREIGN KEY (`start_id`) REFERENCES `halt` (`id`),
  ADD CONSTRAINT `route_ibfk_2` FOREIGN KEY (`end_id`) REFERENCES `halt` (`id`);
