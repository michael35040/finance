-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2014 at 05:32 AM
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
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL,
  `units` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `locked` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `loan` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `rate` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `approved` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `accounts`
--

TRUNCATE TABLE `accounts`;
--
-- Dumping data for table `accounts`
--


-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

DROP TABLE IF EXISTS `assets`;
CREATE TABLE IF NOT EXISTS `assets` (
  `uid` int(11) NOT NULL,
  `symbol` varchar(10) NOT NULL COMMENT 'ticker',
  `name` varchar(63) NOT NULL,
  `date` date NOT NULL COMMENT 'listed on',
  `owner` varchar(63) NOT NULL,
  `fee` decimal(65,30) NOT NULL COMMENT 'fee surcharge %',
  `issued` int(11) NOT NULL COMMENT 'shares issued ie 20k',
  `dividend` decimal(65,30) NOT NULL,
  `url` varchar(63) NOT NULL COMMENT 'webpage',
  `type` varchar(63) NOT NULL COMMENT 'shares or commodity',
  `rating` int(11) NOT NULL COMMENT '4 stars or white',
  `description` varchar(999) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `symbol` (`symbol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

--
-- Truncate table before insert `error`
--

TRUNCATE TABLE `error`;
--
-- Dumping data for table `error`
--



-- --------------------------------------------------------

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `uid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'unique transaction id',
  `id` int(10) unsigned NOT NULL COMMENT 'user id',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `transaction` varchar(10) NOT NULL COMMENT 'buy sell transfer',
  `symbol` varchar(10) NOT NULL,
  `quantity` int(64) NOT NULL COMMENT 'local-id-bid',
  `price` decimal(65,30) NOT NULL COMMENT 'or amount transfered',
  `commission` decimal(65,30) NOT NULL COMMENT 'commission',
  `total` decimal(65,30) NOT NULL COMMENT 'history-id-bid/ask or local-id-ask \r\n\r\nor transafer-id',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='id, transaction, symbol, \r\n\r\nshares, \r\n\r\nprice' ;

--
-- Truncate table before insert `history`
--

TRUNCATE TABLE `history`;
--
-- Dumping data for table `history`
--


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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

--
-- Truncate table before insert `login`
--

TRUNCATE TABLE `login`;
--
-- Dumping data for table `login`
--


-- --------------------------------------------------------

--
-- Table structure for table `orderbook`
--

DROP TABLE IF EXISTS `orderbook`;
CREATE TABLE IF NOT EXISTS `orderbook` (
  `uid` int(9) NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `symbol` varchar(10) NOT NULL,
  `side` varchar(1) NOT NULL COMMENT 'a:ask or b:bid',
  `type` varchar(6) NOT NULL COMMENT 'limit or market',
  `price` decimal(65,30) NOT NULL,
  `locked` int(11) NOT NULL COMMENT 'if bid order fund amount that is locked',
  `quantity` int(11) NOT NULL COMMENT 'size quantity of order',
  `id` int(9) NOT NULL COMMENT 'user id',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

--
-- Truncate table before insert `orderbook`
--

TRUNCATE TABLE `orderbook`;
--
-- Dumping data for table `orderbook`
--


-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `date` varchar(255) NOT NULL,
  `open` decimal(65,30) NOT NULL,
  `high` decimal(65,30) NOT NULL,
  `low` decimal(65,30) NOT NULL,
  `price` decimal(65,30) NOT NULL COMMENT 'close',
  `size` int(11) unsigned NOT NULL COMMENT 'volume',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;

--
-- Truncate table before insert `orders`
--

TRUNCATE TABLE `orders`;
-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

DROP TABLE IF EXISTS `portfolio`;
CREATE TABLE IF NOT EXISTS `portfolio` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `id` int(10) NOT NULL COMMENT 'user id',
  `symbol` varchar(10) NOT NULL,
  `quantity` int(65) NOT NULL,
  `locked` int(65) NOT NULL,
  `price` decimal(65,30) NOT NULL COMMENT 'avg buy price',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

--
-- Truncate table before insert `portfolio`
--

TRUNCATE TABLE `portfolio`;
--
-- Dumping data for table `portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `trades`
--

DROP TABLE IF EXISTS `trades`;
CREATE TABLE IF NOT EXISTS `trades` (
  `uid` int(9) NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `symbol` varchar(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` decimal(65,30) NOT NULL,
  `quantity` int(11) NOT NULL,
  `commission` decimal(65,30) NOT NULL,
  `total` decimal(65,30) NOT NULL,
  `type` varchar(10) NOT NULL,
  `buyer` int(9) NOT NULL COMMENT 'user id',
  `seller` int(9) NOT NULL COMMENT 'user id',
  `askorderuid` int(9) NOT NULL,
  `bidorderuid` int(9) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

--
-- Truncate table before insert `trades`
--

TRUNCATE TABLE `trades`;
--
-- Dumping data for table `trades`
--



-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'user id',
  `username` varchar(63) NOT NULL,
  `email` varchar(63) NOT NULL,
  `password` char(128) NOT NULL,
  `phone` int(15) NOT NULL,
  `registered` int(15) NOT NULL,
  `last_login` int(15) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `fails` int(1) NOT NULL DEFAULT '0' COMMENT '# of failed login attempts \r\n\r\nsince last success',
  `active` int(1) NOT NULL DEFAULT '0' COMMENT '0-inactive or 1-active',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--
INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone`, `registered`, `last_login`, `ip`, `fails`, `active`) VALUES
(1, 'a', 'a@a', '$2a$11$ZIiqSdMJtMeW4xWTTQl7zueNNfjw1w.qpoJ03E5AGRfSttU7GJQn2', 1, 1414334245, 2147483647, '::1', 0, 1),
(2, 'b', 'b@b', '$2a$11$lorocz4ub9L3hy27HldufufXp3P6Z0lGb7YEO4ya3jx77SZTCtz7C', 1, 1414334258, 2147483647, '::1', 0, 1);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
