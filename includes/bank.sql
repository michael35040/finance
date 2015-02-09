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
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(10) NOT NULL,
  `units` bigint(20) unsigned NOT NULL DEFAULT '0',
  `loan` bigint(20) unsigned NOT NULL DEFAULT '0',
  `rate` decimal(65,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `approved` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `accounts`
--

TRUNCATE TABLE `accounts`;
--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `units`, `loan`, `rate`, `approved`) VALUES
(1, '0', '0', '0.000000000000000000000000000000', 1);



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
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `uid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'unique transaction id',
  `id` int(10) unsigned NOT NULL COMMENT 'user id',
  `ouid` int(10) unsigned NOT NULL COMMENT 'original uid from other tables',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `transaction` varchar(10) NOT NULL COMMENT 'buy sell transfer',
  `counterparty` int(10) unsigned DEFAULT NULL COMMENT 'user id',
  `symbol` varchar(10) NOT NULL,
  `quantity` int(64) NOT NULL COMMENT 'local-id-bid',
  `price` bigint(20) unsigned NOT NULL COMMENT 'or amount transfered',
  `commission` bigint(20) unsigned NOT NULL COMMENT 'commission',
  `total` bigint(20) unsigned NOT NULL COMMENT 'history-id-bid/ask or local-id-ask \r\n\r\nor transafer-id',
`reference` varchar(64) NULL DEFAULT NULL COMMENT 'bid or ask uid or hash to group a trade of 4 entries',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `history`
--

TRUNCATE TABLE `history`;

-- --------------------------------------------------------
-- 
-- Table structure for table `ledger`
-- 
DROP TABLE IF EXISTS `ledger`;
CREATE TABLE IF NOT EXISTS `ledger` (
`uid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'unique id',
`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`category` varchar(32) NOT NULL COMMENT 'trade, transfer, deposit, withdraw',
`user` int(9) NOT NULL COMMENT 'payee user id',
`symbol` varchar(10) NOT NULL COMMENT 'asset symbol',
`amount` int(20) NOT NULL COMMENT 'positive or negative sign',
`reference` varchar(64) NOT NULL COMMENT 'bid or ask uid or hash to group a trade of 4 entries',
`xuser` int(9) NOT NULL COMMENT 'counter payer user id',
`xsymbol` varchar(10) NOT NULL COMMENT 'FOR COST counter symbol',
`xamount` int(20) NOT NULL COMMENT 'FOR COST counter positive or negative sign',
`xreference` varchar(32) NOT NULL COMMENT 'bid or ask uid or hash to group a trade of 4 entries',
`askuid` int(10) NULL DEFAULT NULL COMMENT 'if trade link to ask',
`biduid` int(10) NULL DEFAULT NULL COMMENT 'if trade link to bid',
`status` varchar(32) NOT NULL COMMENT '1-open/pending, 0-closed/cleared/completed, 2-canceled',
`note` varchar(32) NULL DEFAULT NULL COMMENT 'if canceled-reason',
PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
-- 
-- Truncate table before insert `ledger`
-- 
TRUNCATE TABLE `ledger`;
-- --------------------------------------------------------

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
  `status` varchar(10) NOT NULL COMMENT '1-open/pending, 0-closed/cleared/completed, 2-canceled',
  `original` int(20) unsigned NOT NULL COMMENT 'original quantity',
`reference` varchar(64) NULL DEFAULT NULL COMMENT 'bid or ask uid or hash to group a trade of 4 entries',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `orderbook`
--

TRUNCATE TABLE `orderbook`;
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
  `price` bigint(20) unsigned NOT NULL COMMENT 'avg buy price',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `portfolio`
--

TRUNCATE TABLE `portfolio`;
-- --------------------------------------------------------

--
-- Table structure for table `storage`
--

DROP TABLE IF EXISTS `storage`;
CREATE TABLE IF NOT EXISTS `storage` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `symbol` varchar(10) NOT NULL,
  `depository` varchar(63) NOT NULL,
  `description` varchar(63) NOT NULL,
  `asw` decimal(65,30) NOT NULL,
  `purity` decimal(65,30) NOT NULL,
  `country` varchar(63) NOT NULL,
  `year` int(9) NOT NULL,
  `weight` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


--
-- Truncate table before insert `storage`
--

TRUNCATE TABLE `storage`;
-- --------------------------------------------------------

--
-- Table structure for table `trades`
--

DROP TABLE IF EXISTS `trades`;
CREATE TABLE IF NOT EXISTS `trades` (
  `uid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `symbol` varchar(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` bigint(20) unsigned NOT NULL COMMENT 'price',
  `quantity` int(63) NOT NULL,
  `commission` bigint(20) unsigned NOT NULL COMMENT 'commission',
  `total` bigint(20) unsigned NOT NULL COMMENT 'total',
  `type` varchar(10) NOT NULL,
  `buyer` int(10) NOT NULL COMMENT 'user id',
  `seller` int(10) NOT NULL COMMENT 'user id',
  `askorderuid` int(10) NOT NULL,
  `bidorderuid` int(10) NOT NULL,
  `reference` varchar(64) NULL DEFAULT NULL COMMENT 'bid or ask uid or hash to group a trade of 4 entries',

  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `trades`
--

TRUNCATE TABLE `trades`;
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

--
-- Table structure for table `voting`
--

DROP TABLE IF EXISTS `voting`;
CREATE TABLE IF NOT EXISTS `voting`(
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `symbol` varchar(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'time initiated',
  `question` varchar(63) NOT NULL,
  `total` int(10) NOT NULL COMMENT 'public shares',
  `status` varchar(63) NOT NULL COMMENT 'open or closed',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `voting`
--

TRUNCATE TABLE `voting`;
-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

DROP TABLE IF EXISTS `votes`;
CREATE TABLE IF NOT EXISTS `votes`(
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `votinguid` int(10) NOT NULL COMMENT 'same as voting uid',
  `symbol` varchar(10) NOT NULL,
  `userid` int(10) NOT NULL COMMENT 'user id',
  `count` int(10) NOT NULL COMMENT 'shares owned',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'time voted',
  `vote` varchar(63) NOT NULL COMMENT 'yes or no',

  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `votes`
--

TRUNCATE TABLE `votes`;
-- --------------------------------------------------------



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
