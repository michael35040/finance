-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2014 at 02:30 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bank`
--
CREATE DATABASE IF NOT EXISTS `bank` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bank`;

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

DROP TABLE IF EXISTS `assets`;
CREATE TABLE IF NOT EXISTS `assets` (
  `uid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'unique assets id',
  `symbol` varchar(10) NOT NULL COMMENT 'ticker',
  `name` varchar(63) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'listed on',
  `issued` int(11) NOT NULL COMMENT 'shares issued ie 20k',
  `type` varchar(63) NOT NULL COMMENT 'shares or commodity',
  `fee` decimal(65,30) DEFAULT NULL COMMENT 'listing fee of exchange',
  `userid` int(10) DEFAULT NULL COMMENT 'user id',
  `url` varchar(63) DEFAULT NULL COMMENT 'webpage',
  `rating` int(11) DEFAULT NULL COMMENT '4 stars or white',
  `description` varchar(999) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `symbol` (`symbol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `assets`
--

TRUNCATE TABLE `assets`;
-- --------------------------------------------------------

--
-- Table structure for table `error`
--

DROP TABLE IF EXISTS `error`;
CREATE TABLE IF NOT EXISTS `error` (
  `uid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'unique error id',
  `id` int(10) unsigned NOT NULL COMMENT 'user id',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(100) NOT NULL COMMENT 'short description',
  `description` varchar(255) NOT NULL COMMENT 'longer description',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `error`
--

TRUNCATE TABLE `error`;
-- --------------------------------------------------------

--
-- Table structure for table `ledger`
--

DROP TABLE IF EXISTS `ledger`;
CREATE TABLE IF NOT EXISTS `ledger` (
  `uid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'unique ledger id',
  `type` varchar(63) NOT NULL COMMENT 'trade, transfer, deposit, withdraw',
  `user1` int(10) NOT NULL AUTO_INCREMENT COMMENT 'userid',
  `user2` int(10) NOT NULL AUTO_INCREMENT COMMENT 'userid',
  `a` varchar(10) NOT NULL COMMENT 'asset_a',
  `1a` int(65) NOT NULL COMMENT 'user1 asset_a',
  `2a` int(65) NOT NULL COMMENT 'user2 asset_a',
  `b` varchar(10) NOT NULL COMMENT 'asset_b',
  `1b` int(65) NOT NULL COMMENT 'user1 asset_b',
  `2b` int(65) NOT NULL COMMENT 'user2 asset_b',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'listed on',
  `notes` varchar(999) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `ledger`
--

TRUNCATE TABLE `ledger`;
-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `uid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `id` int(10) NOT NULL COMMENT 'user id',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(15) NOT NULL,
  `success_fail` varchar(1) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `login`
--

TRUNCATE TABLE `login`;
-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `id` int(10) NOT NULL COMMENT 'userid',
  `notice` varchar(255) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1 open or 0 close',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `notification`;
--

TRUNCATE TABLE `notification`;
-- --------------------------------------------------------

--
-- Table structure for table `orderbook`
--     bigint(20) unsigned NOT NULL DEFAULT '0',  


DROP TABLE IF EXISTS `orderbook`;
CREATE TABLE IF NOT EXISTS `orderbook` (
  `uid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `symbol` varchar(10) NOT NULL,
  `side` varchar(1) NOT NULL COMMENT 'a:ask or b:bid',
  `type` varchar(6) NOT NULL COMMENT 'limit or market',
  `price` bigint(20) unsigned NOT NULL,
  `total` bigint(20) unsigned NOT NULL COMMENT 'if bid order fund amount that is locked',
  `quantity` int(65) NOT NULL COMMENT 'size quantity of order',
  `id` int(9) NOT NULL COMMENT 'user id',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `orderbook`
--

TRUNCATE TABLE `orderbook`;
-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'user id',
  `email` varchar(63) NOT NULL,
  `fname` varchar(63) NOT NULL,
  `lname` varchar(63) NOT NULL,
  `birth` date NOT NULL,
  `address` varchar(63) NOT NULL,
  `city` varchar(63) NOT NULL,
  `region` varchar(63) NOT NULL,
  `zip` int(20) NOT NULL,
  `phone` int(20) NOT NULL,
  `question` varchar(63) NOT NULL,
  `answer` varchar(63) NOT NULL,
  `password` char(128) NOT NULL,
  `registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NULL DEFAULT NULL,
  `ip` varchar(15) NOT NULL,
  `fails` int(1) NOT NULL DEFAULT '0' COMMENT 'failed login attempts',
  `active` int(1) NOT NULL DEFAULT '0' COMMENT '0 inactive or 1 active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `fname`, `lname`, `birth`, `address`, `city`, `region`, `zip`, `phone`, `question`, `answer`, `password`, `registered`, `last_login`, `ip`, `fails`, `active`) VALUES
('a@pulwar.com', 'a', 'pulwar', '2014-05-04', 'pulwar st 12 po #box 123', 'CityofPulwar', 'IA', 111112, 12, 'What?', 'Yeah!', '$2a$11$mSIPrGz706xUee70qha1NeWEZ/CR/.ufGS1uzTzr5wsQHApBx6Vz2', '2014-11-07 07:00:00', '2014-12-01 18:02:25', '143.85.101.19', 0, 1);

-- --------------------------------------------------------


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
