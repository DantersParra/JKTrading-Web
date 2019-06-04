-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: sql201.epizy.com
-- Generation Time: May 26, 2019 at 02:39 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `epiz_23919426_jktrading`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE IF NOT EXISTS `activity_log` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `action` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL,
  PRIMARY KEY (`activity_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`activity_id`, `userID`, `action`, `time`) VALUES
(1, 3, 'User Logged in', '2019/05/20 at 02:49:41pm'),
(2, 3, 'Inserted new Item Type', '2019/05/20 at 02:50:00am'),
(3, 3, 'Insert new inventory stock info', '2019/05/20 at 02:50:10pm'),
(4, 3, 'logged out', '2019/05/20 at 02:50:17am'),
(5, 19, 'User Logged in', '2019/05/20 at 02:50:22pm'),
(6, 19, 'logged out', '2019/05/20 at 02:50:45am'),
(7, 3, 'User Logged in', '2019/05/20 at 02:50:53pm'),
(8, 3, 'logged out', '2019/05/20 at 02:51:06am'),
(9, 19, 'User Logged in', '2019/05/20 at 02:51:11pm'),
(10, 19, 'logged out', '2019/05/20 at 02:52:13am'),
(11, 19, 'User Logged in', '2019/05/20 at 03:01:03pm'),
(12, 19, 'logged out', '2019/05/20 at 03:01:44am'),
(13, 3, 'User Logged in', '2019/05/20 at 03:02:03pm'),
(14, 3, 'logged out', '2019/05/20 at 03:03:56am'),
(15, 19, 'User Logged in', '2019/05/20 at 03:03:59pm'),
(16, 19, 'logged out', '2019/05/20 at 03:04:11am'),
(17, 3, 'User Logged in', '2019/05/20 at 03:04:14pm'),
(18, 3, 'Insert new inventory stock info', '2019/05/20 at 03:04:39pm'),
(19, 3, 'logged out', '2019/05/20 at 03:04:52am'),
(20, 19, 'User Logged in', '2019/05/20 at 03:04:55pm'),
(21, 19, 'logged out', '2019/05/20 at 03:05:39am'),
(22, 3, 'User Logged in', '2019/05/20 at 03:05:43pm'),
(23, 3, 'changed item info', '2019/05/20 at 03:05:59am'),
(24, 3, 'changed item info', '2019/05/20 at 03:05:59am'),
(25, 3, 'changed item info', '2019/05/20 at 03:05:59am'),
(26, 3, 'changed item info', '2019/05/20 at 03:06:00am'),
(27, 3, 'logged out', '2019/05/20 at 03:22:04am'),
(28, 3, 'User Logged in', '2019/05/20 at 03:39:06pm'),
(29, 3, 'Inserted new Item Type', '2019/05/20 at 03:42:00am'),
(30, 3, 'Insert new inventory stock info', '2019/05/20 at 03:42:52pm'),
(31, 19, 'User Logged in', '2019/05/20 at 03:42:54pm'),
(32, 3, 'logged out', '2019/05/20 at 03:44:32am'),
(33, 17, 'User Logged in', '2019/05/20 at 03:44:38pm'),
(34, 19, 'logged out', '2019/05/20 at 03:47:41am'),
(35, 20, 'User Logged in', '2019/05/20 at 03:47:47pm'),
(36, 17, 'logged out', '2019/05/20 at 03:49:54am'),
(37, 3, 'User Logged in', '2019/05/20 at 03:50:00pm'),
(38, 3, 'Inserted new Item Type', '2019/05/20 at 03:51:48am'),
(39, 3, 'Insert new inventory stock info', '2019/05/20 at 03:52:05pm'),
(40, 3, 'Moved items to recycle bin', '2019/05/20 at 04:05:26pm'),
(41, 3, 'Moved items to recycle bin', '2019/05/20 at 04:09:06pm'),
(42, 3, 'Removed items from recycle bin at ', '2019/05/20 at 04:09:09pm'),
(43, 3, 'logged out', '2019/05/20 at 04:12:50am'),
(44, 3, 'User Logged in', '2019/05/20 at 04:12:57pm'),
(45, 20, 'logged out', '2019/05/20 at 04:13:28am'),
(46, 19, 'User Logged in', '2019/05/20 at 04:13:35pm'),
(47, 19, 'logged out', '2019/05/20 at 04:15:01am'),
(48, 3, 'Updated inventory stock info', '2019/05/20 at 04:15:15pm'),
(49, 21, 'User Logged in', '2019/05/20 at 04:15:24pm'),
(50, 3, 'logged out', '2019/05/20 at 04:21:49am'),
(51, 3, 'User Logged in', '2019/05/24 at 01:59:03am'),
(52, 3, 'logged out', '2019/05/23 at 02:00:01pm');

-- --------------------------------------------------------

--
-- Table structure for table `b1_onhand_inventory`
--

CREATE TABLE IF NOT EXISTS `b1_onhand_inventory` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(50) NOT NULL,
  `item_unit` varchar(50) NOT NULL,
  `shelf_life` int(11) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `safety_lvl` int(11) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `b1_onhand_inventory`
--

INSERT INTO `b1_onhand_inventory` (`type_id`, `item_name`, `item_unit`, `shelf_life`, `item_qty`, `safety_lvl`) VALUES
(1, 'Soda ', 'Bottle', 2, -1, 99),
(2, 'Rice ', 'Sack', 7, 0, 100);

-- --------------------------------------------------------

--
-- Table structure for table `b2_onhand_inventory`
--

CREATE TABLE IF NOT EXISTS `b2_onhand_inventory` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(50) NOT NULL,
  `item_unit` varchar(50) NOT NULL,
  `shelf_life` int(244) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `safety_lvl` int(11) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `b2_onhand_inventory`
--

INSERT INTO `b2_onhand_inventory` (`type_id`, `item_name`, `item_unit`, `shelf_life`, `item_qty`, `safety_lvl`) VALUES
(1, 'Soda ', 'Bottle', 2, 0, 99),
(2, 'Rice ', 'Sack', 7, 0, 100);

-- --------------------------------------------------------

--
-- Table structure for table `b3_onhand_inventory`
--

CREATE TABLE IF NOT EXISTS `b3_onhand_inventory` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(50) NOT NULL,
  `item_unit` varchar(50) NOT NULL,
  `shelf_life` int(244) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `safety_lvl` int(11) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `b3_onhand_inventory`
--

INSERT INTO `b3_onhand_inventory` (`type_id`, `item_name`, `item_unit`, `shelf_life`, `item_qty`, `safety_lvl`) VALUES
(1, 'Soda ', 'Bottle', 2, 0, 99),
(2, 'Rice ', 'Sack', 7, 0, 100);

-- --------------------------------------------------------

--
-- Table structure for table `commissary_dmgrecbin`
--

CREATE TABLE IF NOT EXISTS `commissary_dmgrecbin` (
  `branch_id` int(11) NOT NULL,
  `ritem_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `ritem_stock` int(11) NOT NULL,
  `remarks` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commissary_dmgrecbin`
--

INSERT INTO `commissary_dmgrecbin` (`branch_id`, `ritem_id`, `type_id`, `ritem_stock`, `remarks`) VALUES
(1, 1, 1, 10, 'sira na'),
(1, 1, 1, 1, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `commissary_inventory`
--

CREATE TABLE IF NOT EXISTS `commissary_inventory` (
  `citem_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `citem_ever` int(11) NOT NULL COMMENT 'safety level of number of stock',
  `citem_stock` int(11) NOT NULL,
  `dateReceived_item` datetime NOT NULL,
  `dateModified_item` datetime NOT NULL,
  `expired_flag` int(11) NOT NULL COMMENT '0- Not Expired 1- Expired',
  `expectedExpiry_date` datetime NOT NULL,
  PRIMARY KEY (`citem_id`),
  KEY `type_id` (`type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `commissary_recbin`
--

CREATE TABLE IF NOT EXISTS `commissary_recbin` (
  `citem_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `citem_ever` int(11) NOT NULL,
  `citem_stock` int(11) NOT NULL,
  `expectedExpiry_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `com_onhand_inventory`
--

CREATE TABLE IF NOT EXISTS `com_onhand_inventory` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(50) NOT NULL,
  `item_unit` varchar(50) NOT NULL,
  `shelf_life` int(244) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `safety_lvl` int(11) NOT NULL,
  KEY `type_id` (`type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `com_onhand_inventory`
--

INSERT INTO `com_onhand_inventory` (`type_id`, `item_name`, `item_unit`, `shelf_life`, `item_qty`, `safety_lvl`) VALUES
(1, 'Soda ', 'Bottle', 2, 0, 99),
(2, 'Rice ', 'Sack', 7, 0, 100);

-- --------------------------------------------------------

--
-- Table structure for table `item_type`
--

CREATE TABLE IF NOT EXISTS `item_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(50) NOT NULL,
  `item_unit` varchar(50) NOT NULL COMMENT 'kg / gallon / box / bottle',
  `shelf_life` int(244) NOT NULL COMMENT 'shelf life value is in days',
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `item_type`
--

INSERT INTO `item_type` (`type_id`, `item_name`, `item_unit`, `shelf_life`) VALUES
(1, 'Soda ', 'Bottle', 2),
(2, 'Rice ', 'Sack', 7);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE IF NOT EXISTS `order_details` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `dateOrdered` datetime NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `request_id`, `type_id`, `order_quantity`, `dateOrdered`) VALUES
(1, 1, 1, 100, '2019-05-20 15:44:09'),
(2, 2, 1, 100, '2019-05-20 15:47:04'),
(3, 3, 1, 50, '2019-05-20 15:47:55'),
(4, 4, 1, 5, '2019-05-20 15:52:42'),
(5, 4, 2, 10, '2019-05-20 15:52:42'),
(6, 5, 1, 1, '2019-05-20 16:09:48');

-- --------------------------------------------------------

--
-- Table structure for table `order_request`
--

CREATE TABLE IF NOT EXISTS `order_request` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `request_status` varchar(50) NOT NULL,
  `request_orderedby` varchar(50) NOT NULL COMMENT 'comes from branch id of user',
  `dateOrdered` datetime NOT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `order_request`
--

INSERT INTO `order_request` (`request_id`, `request_status`, `request_orderedby`, `dateOrdered`) VALUES
(1, 'Received Delivery', '1', '2019-05-20 15:44:09'),
(2, 'Processing', '1', '2019-05-20 15:47:04'),
(3, 'Processing', '2', '2019-05-20 15:47:55'),
(4, 'Delivered', '2', '2019-05-20 15:52:42'),
(5, 'Received', '2', '2019-05-20 16:09:48');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_inventory`
--

CREATE TABLE IF NOT EXISTS `restaurant_inventory` (
  `ritem_id` int(11) NOT NULL,
  `expectedExpiry_date` datetime NOT NULL,
  `branch_id` varchar(50) NOT NULL,
  `type_id` int(11) NOT NULL,
  `ritem_ever` int(11) NOT NULL COMMENT 'safety level',
  `ritem_stock` int(11) NOT NULL,
  `dateReceived_item` datetime NOT NULL,
  `expired_flag` int(11) NOT NULL,
  KEY `type_id` (`type_id`),
  KEY `branch_id` (`branch_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurant_inventory`
--

INSERT INTO `restaurant_inventory` (`ritem_id`, `expectedExpiry_date`, `branch_id`, `type_id`, `ritem_ever`, `ritem_stock`, `dateReceived_item`, `expired_flag`) VALUES
(1, '2019-05-23 03:46:44', '1', 1, 50, -1, '2019-05-20 15:46:44', 0);

-- --------------------------------------------------------

--
-- Table structure for table `resto_branch`
--

CREATE TABLE IF NOT EXISTS `resto_branch` (
  `branch_id` varchar(50) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `branch_address` text NOT NULL,
  `branch_description` text NOT NULL,
  PRIMARY KEY (`branch_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resto_branch`
--

INSERT INTO `resto_branch` (`branch_id`, `branch_name`, `branch_address`, `branch_description`) VALUES
('1', 'SeolHwa', 'Paseo', 'Cafe'),
('2', 'Pork Heroes', 'Paseo', 'Samngyup'),
('3', 'The Cook', 'Paseo', 'Samngyup'),
('4', 'Commissary', 'Sta Rosa Estates, Sta Rosa Laguna', 'Main office and producer of goods');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE IF NOT EXISTS `user_account` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `branch_id` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `isActive` int(11) NOT NULL COMMENT '0-not active 1-active',
  `userLevel` int(10) NOT NULL COMMENT '0-branch 1-commissary 2-owner',
  `isOnline` int(11) NOT NULL COMMENT '0 - not online 1-online',
  PRIMARY KEY (`userID`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`userID`, `username`, `password`, `branch_id`, `department`, `name`, `isActive`, `userLevel`, `isOnline`) VALUES
(3, 'bigboss             ', '747bda46b83d0f642ccb846d9a8c1cbe', '4', 'main  ', 'big bosss', 1, 2, 0),
(19, 'branch1', '5f4699b7a4a800988dabe770f2749ace', '1', 'none', 'branch1', 1, 0, 0),
(18, 'owner2', 'b1e3677cd7c6f633e6c08037583c846f', '4', 'Commissary', 'owner2', 1, 1, 0),
(26, 'new', '22af645d1859cb5ca6da0c484f1f37ea', '4', 'none', 'new', 1, 2, 0),
(17, 'owner1', '4ef5ba0c918c537fadba2ada54e3dd68', '4', 'Commissary', 'owner1', 1, 1, 0),
(20, 'branch2', '41802a56984b22c73932f4c0111f2122', '2', 'none', 'branch2', 1, 0, 0),
(21, 'branch3', '43f43bc66d949a499151c41d4b2448c2', '3', 'none', 'branch3', 1, 0, 0),
(27, 'towel', '226f863b64bf6f0ac880a84f13fb09a5', '4', 'none', 'towel', 1, 2, 0),
(28, 'pillow', '028dbbfa273d4b792baf487492f43a5d', '4', 'none', 'pillow', 1, 2, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
