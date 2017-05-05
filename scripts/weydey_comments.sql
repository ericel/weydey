-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 04, 2017 at 08:51 PM
-- Server version: 5.5.51-38.2
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ericele_weytindey`
--

-- --------------------------------------------------------

--
-- Table structure for table `weydey_comments`
--

CREATE TABLE IF NOT EXISTS `weydey_comments` (
  `id` int(11) unsigned NOT NULL,
  `fileID` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `fileComment` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `weydey_comments`
--

INSERT INTO `weydey_comments` (`id`, `fileID`, `username`, `fileComment`, `created_at`, `updated_at`) VALUES
(6, 'de2c35a52e7', 'adjoines', 'About P-Square - Personally', '2017-04-18 20:39:00', '2017-04-18 20:39:00'),
(7, '6ff44e857c3', 'adjoines', 'Mr. Ibu the original', '2017-04-18 21:22:45', '2017-04-18 21:22:45'),
(9, 'b53bd3c903b', 'adjoines', 'I don’t care who you are\nWhere you from or what you do\nJust as long as you chasing money\nDo what’s right, never give up on it', '2017-04-19 17:16:52', '2017-04-19 17:16:52'),
(10, '9fd5475ef97', 'ericel123new', 'Traps we fall for! I close my eyes , and whatever I end up with becomes my choice :)', '2017-04-25 13:13:21', '2017-04-25 13:13:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `weydey_comments`
--
ALTER TABLE `weydey_comments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `weydey_comments`
--
ALTER TABLE `weydey_comments`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
