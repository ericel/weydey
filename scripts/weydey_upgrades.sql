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
-- Table structure for table `weydey_upgrades`
--

CREATE TABLE IF NOT EXISTS `weydey_upgrades` (
  `id` int(11) unsigned NOT NULL,
  `txn_id` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `payer_email` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL DEFAULT '49',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `weydey_upgrades`
--

INSERT INTO `weydey_upgrades` (`id`, `txn_id`, `username`, `payer_email`, `amount`, `created_at`, `updated_at`) VALUES
(2, '2HK122170L462370A', 'adjoines', 'ericel123new@gmail.com', '49', '2017-05-03 10:25:51', '2017-05-03 10:25:51'),
(3, '62W72640N6589691A', 'adjoines', 'ericel123new@gmail.com', '49', '2017-05-03 10:30:51', '2017-05-03 10:30:51'),
(4, '33C531617E790115R', 'adjoines - Weytindey Annual Subscription', 'ericel123new@gmail.com', '49', '2017-05-03 20:16:31', '2017-05-03 20:16:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `weydey_upgrades`
--
ALTER TABLE `weydey_upgrades`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `weydey_upgrades`
--
ALTER TABLE `weydey_upgrades`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
