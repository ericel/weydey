-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 04, 2017 at 08:53 PM
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
-- Table structure for table `weydey_downloads`
--

CREATE TABLE IF NOT EXISTS `weydey_downloads` (
  `id` int(11) unsigned NOT NULL,
  `username` varchar(100) NOT NULL,
  `fileID` varchar(100) NOT NULL,
  `filename` varchar(225) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `weydey_downloads`
--

INSERT INTO `weydey_downloads` (`id`, `username`, `fileID`, `filename`, `created_at`, `updated_at`) VALUES
(6, 'adjoines', 'e34355d91ae', '2face - True Love', '2017-05-01 20:12:49', '2017-05-01 20:12:49'),
(7, 'adjoines', 'e34355d91ae', '2face - True Love', '2017-05-01 20:12:57', '2017-05-01 20:12:57'),
(8, 'adjoines', 'e34355d91ae', '2face - True Love', '2017-05-01 20:13:07', '2017-05-01 20:13:07'),
(9, 'adjoines', 'e34355d91ae', '2face - True Love', '2017-05-01 20:13:14', '2017-05-01 20:13:14'),
(10, 'adjoines', 'e34355d91ae', '2face - True Love', '2017-05-01 20:13:19', '2017-05-01 20:13:19'),
(11, 'adjoines', 'e34355d91ae', '2face - True Love', '2017-05-01 20:13:25', '2017-05-01 20:13:25'),
(12, 'ericel123', 'c380b766ad9', '2Face - See Me So', '2017-05-03 22:43:25', '2017-05-03 22:43:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `weydey_downloads`
--
ALTER TABLE `weydey_downloads`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `weydey_downloads`
--
ALTER TABLE `weydey_downloads`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
