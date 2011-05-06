-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 14, 2011 at 11:01 PM
-- Server version: 5.0.92
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wwwgowhg_roipos`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) collate utf8_bin NOT NULL default '0',
  `ip_address` varchar(16) collate utf8_bin NOT NULL default '0',
  `user_agent` varchar(150) collate utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL default '0',
  `user_data` text collate utf8_bin NOT NULL,
  PRIMARY KEY  (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ci_sessions`
--


-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `doctor_id` varchar(50) NOT NULL,
  `store_id` varchar(50) NOT NULL,
  `firstname` varchar(50) default NULL,
  `lastname` varchar(50) default NULL,
  `address` varchar(100) default NULL,
  `address2` varchar(100) default NULL,
  `city` varchar(50) default NULL,
  `state` varchar(2) default NULL,
  `zip` varchar(10) default NULL,
  `email` varchar(100) default NULL,
  `phone` varchar(12) default NULL,
  `phone2` varchar(12) default NULL,
  `phone3` varchar(12) default NULL,
  `examtype` varchar(10) default NULL,
  `recalldate` date NOT NULL default '0000-00-00',
  `examdate` date NOT NULL default '0000-00-00',
  `examdue` date NOT NULL default '0000-00-00',
  `lastcontact` date default NULL,
  `clientstatus` tinyint(1) NOT NULL default '1',
  `dob` date default '1900-01-01',
  `insurance` varchar(255) default NULL,
  `insurance_id` varchar(50) default NULL,
  `notes` varchar(1024) default NULL,
  `lastpurchasedate` date default NULL,
  `lastpurchaseamount` float(8,2) default NULL,
  `unique_id` int(11) NOT NULL,
  `suffix` varchar(10) default NULL,
  `client_id` varchar(100) NOT NULL,
  `carrier` varchar(50) default NULL,
  `employer` varchar(100) default NULL,
  PRIMARY KEY  (`client_id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `store_id` (`store_id`),
  KEY `carrier` (`carrier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`doctor_id`, `store_id`, `firstname`, `lastname`, `address`, `address2`, `city`, `state`, `zip`, `email`, `phone`, `phone2`, `phone3`, `examtype`, `recalldate`, `examdate`, `examdue`, `lastcontact`, `clientstatus`, `dob`, `insurance`, `insurance_id`, `notes`, `lastpurchasedate`, `lastpurchaseamount`, `unique_id`, `suffix`, `client_id`, `carrier`, `employer`) VALUES
('Seaward', '35ottumwa', 'billy', 'bob', '1234 house', '', 'des moines', 'IA', '50317', '', '5152445611', '', '', 'undefined', '0000-00-00', '2010-12-13', '0000-00-00', '0000-00-00', 1, '1900-01-01', NULL, NULL, 'test record', NULL, NULL, 0, NULL, 'bilbob12132010133445-45434', NULL, NULL),
('SHundt', '23eyemartsouth', 'Billybob', 'Jones', '555 Street', 'Apt. C', 'Anytown', 'KS', '12345', '', '555-244-561', '', '', 'Contacts', '0000-00-00', '2010-10-09', '2011-10-09', '2010-10-09', 1, '0000-00-00', NULL, '', '', '2010-09-16', 0.00, 0, NULL, 'BilJon09162010132228-26246', NULL, NULL),
('SHundt', '23eyemartsouth', 'Billybob', 'Jones', '555 Street', 'Apt. C', 'Anytown', 'KS', '12345', '', '555-244-561', '', '', 'Contacts', '0000-00-00', '2010-10-09', '2011-10-09', '2010-10-09', 1, '0000-00-00', NULL, '', '', '2010-09-16', 0.00, 0, NULL, 'BilJon09162010132228-68517', NULL, NULL),
('BLANK', '34onehour', 'firstname', 'lastname', 'address', 'address2', 'city', 'IA', 'zip', 'example@example.com', 'phone', 'phone2', 'phone3', 'undefined', '0000-00-00', '2010-10-09', '2011-10-09', '2010-10-09', 1, '1900-01-01', NULL, NULL, 'notes', '2010-09-16', 0.00, 0, NULL, 'firlas09162010055602-78072', NULL, NULL),
('KBrost', '34onehour', 'John', 'Doe', '1234 Street', 'Apt A', 'Des Moines', 'IA', '50315', 'mytestclient@gmail.com', '5152445611', '5152445611', '', 'glasses', '0000-00-00', '2010-10-09', '2011-10-09', '2010-10-09', 1, '1971-12-12', NULL, '123456789', 'for the test client', NULL, 150.00, 0, NULL, 'JohDoe09142010115423-85308', NULL, NULL),
('KBrost', '23eyemartsouth', 'Patrick', 'Farrell', '123 ABC Street', '# 5053', 'Des Moines', 'IA', '50321', 'pat@mytestsite.com', '5152445611', '', '', 'Contacts', '0000-00-00', '2011-02-28', '2012-02-28', '2011-02-28', 1, '0000-00-00', NULL, 'example', '', '2010-10-06', 0.00, 0, NULL, 'PatFar10062010151624-94635', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clients_temp`
--

CREATE TABLE IF NOT EXISTS `clients_temp` (
  `unique_id` int(11) NOT NULL auto_increment,
  `doctor_id` varchar(50) NOT NULL,
  `store_id` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL default 'empty',
  `lastname` varchar(50) NOT NULL default 'empty',
  `address` varchar(100) NOT NULL default '',
  `address2` varchar(100) default NULL,
  `city` varchar(50) default NULL,
  `state` varchar(2) default NULL,
  `zip` varchar(10) default NULL,
  `email` varchar(100) default NULL,
  `phone` varchar(12) default NULL,
  `phone2` varchar(12) default NULL,
  `phone3` varchar(12) default NULL,
  `examtype` varchar(10) default NULL,
  `recalldate` date default '0000-00-00',
  `examdate` date NOT NULL default '0000-00-00',
  `examdue` date default '0000-00-00',
  `lastcontact` date default '0000-00-00',
  `clientstatus` tinyint(1) NOT NULL default '1',
  `dob` date default '0000-00-00',
  `insurance` varchar(255) default NULL,
  `insurance_id` varchar(50) default NULL,
  `notes` varchar(1024) default NULL,
  `lastpurchasedate` date default NULL,
  `lastpurchaseamount` decimal(8,2) default '0.00',
  `suffix` varchar(10) NOT NULL default '',
  `client_id` varchar(100) NOT NULL,
  PRIMARY KEY  (`unique_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `clients_temp`
--


-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `company_name` varchar(255) default NULL,
  `admin_email` varchar(255) default NULL,
  `allow_registration` tinyint(1) NOT NULL default '0',
  `recall_default` tinyint(2) default '20'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`company_name`, `admin_email`, `allow_registration`, `recall_default`) VALUES
('Real Optics Inc.', 'doughesseltine@gmail.com', 0, 20);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE IF NOT EXISTS `doctors` (
  `doctor_id` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `license` varchar(50) NOT NULL,
  `expiredate` date NOT NULL,
  `address` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `active` tinyint(4) NOT NULL default '1',
  PRIMARY KEY  (`doctor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `firstname`, `lastname`, `title`, `phone`, `email`, `license`, `expiredate`, `address`, `address2`, `city`, `state`, `zip`, `active`) VALUES
('14', '', 'Lansink', 'Dr.', '', '', '', '0000-00-00', '', '', '', '', '', 1),
('BHaag', 'B', 'Haag', '', '', '', '', '0000-00-00', '', '', '', 'IA', '', 1),
('flast', 'first', 'last', '', '', '', '', '0000-00-00', '', '', '', '', '', 1),
('Hanson', '', 'Hanson', '', '', '', '', '0000-00-00', '', '', '', 'IA', '', 1),
('JaneSnodgrass', 'Jane', 'Snodgrass', '', '515-224-1317', '', '', '0000-00-00', '8801 University Ave #20A', '', 'Clive', 'IA', '50325', 1),
('KBrost', 'K', 'Brost', '', '', '', '', '0000-00-00', '', '', '', 'IA', '', 1),
('KirkMeints', 'Kirk', 'Meints', '', '', '', '', '0000-00-00', '', '', 'Des Moines', 'IA', '50317', 1),
('RichardNelson', 'Richard', 'Nelson', '', '712-792-4878', '', 'n/a', '0000-00-00', '214 W 5th St', '', 'Carroll', 'IA', '51401', 1),
('Seaward', '', 'Seaward', '', '', '', '', '0000-00-00', '', '', '', 'IA', '', 1),
('SHundt', 'S', 'Hundt', '', '', '', '', '0000-00-00', '', '', '', 'IA', '', 1),
('SMaxwell', 'S', 'Maxwell', '', '', '', '', '0000-00-00', '', '', '', 'IA', '', 1),
('SOlson', 'S', 'Olson', '', '', '', '', '0000-00-00', '', '', '', 'IA', '', 0),
('Tempel', '', 'Tempel', '', '', '', '', '0000-00-00', '', '', '', 'IA', '', 1),
('TSchultz', 'T', 'Schulz', '', '', '', '', '0000-00-00', '', '', '', 'IA', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE IF NOT EXISTS `exams` (
  `exam_id` int(11) NOT NULL auto_increment,
  `client_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `examdate` date NOT NULL,
  `examtype` int(11) NOT NULL,
  PRIMARY KEY  (`exam_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1454 ;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`exam_id`, `client_id`, `doctor_id`, `examdate`, `examtype`) VALUES
(1386, 5012, 0, '2010-09-08', 3),
(1387, 5013, 0, '0000-00-00', 3),
(1388, 5014, 0, '0005-09-05', 3),
(1389, 5015, 0, '0000-00-00', 3),
(1390, 5016, 0, '0009-05-06', 3),
(1391, 5017, 0, '0000-00-00', 3),
(1392, 5018, 0, '0005-07-09', 3),
(1393, 5019, 0, '0005-07-09', 3),
(1394, 5020, 0, '0005-07-09', 3),
(1395, 5021, 0, '0008-09-07', 3),
(1396, 5022, 0, '0004-11-09', 3),
(1397, 5023, 0, '0000-00-00', 3),
(1398, 5024, 0, '0002-02-08', 3),
(1399, 5025, 0, '0002-02-08', 3),
(1400, 5026, 0, '0000-00-00', 3),
(1401, 5027, 0, '0009-07-06', 3),
(1402, 5028, 0, '0000-00-00', 3),
(1403, 5029, 0, '0000-00-00', 3),
(1404, 5030, 0, '0008-11-08', 3),
(1405, 5031, 0, '0001-12-08', 3),
(1406, 5032, 0, '0008-05-08', 3),
(1407, 5033, 0, '0000-00-00', 3),
(1408, 5034, 0, '0008-02-08', 3),
(1409, 5035, 0, '0000-00-00', 3),
(1410, 5036, 0, '0001-08-08', 3),
(1411, 5037, 0, '0000-00-00', 3),
(1412, 5038, 0, '0000-00-00', 3),
(1413, 5039, 0, '0000-00-00', 3),
(1414, 5040, 0, '0000-00-00', 3),
(1415, 5041, 0, '0000-00-00', 3),
(1416, 5042, 0, '0000-00-00', 3),
(1417, 5043, 0, '0001-06-05', 3),
(1418, 5044, 0, '0000-00-00', 3),
(1419, 5045, 0, '0000-00-00', 3),
(1420, 5046, 0, '0000-00-00', 3),
(1421, 5047, 0, '0000-00-00', 3),
(1422, 5048, 0, '0006-08-09', 3),
(1423, 5049, 0, '0000-00-00', 3),
(1424, 5050, 0, '0007-09-09', 3),
(1425, 5051, 0, '0000-00-00', 3),
(1426, 5052, 0, '0000-00-00', 3),
(1427, 5053, 0, '0004-03-08', 3),
(1428, 5054, 0, '0000-00-00', 3),
(1429, 5055, 0, '2011-02-06', 3),
(1430, 5056, 0, '0001-08-09', 3),
(1431, 5057, 0, '0000-00-00', 3),
(1432, 5058, 0, '0000-00-00', 3),
(1433, 5059, 0, '0000-00-00', 3),
(1434, 5060, 0, '0000-00-00', 3),
(1435, 5061, 0, '0000-00-00', 3),
(1436, 5062, 0, '0000-00-00', 3),
(1437, 5063, 0, '2012-06-05', 3),
(1438, 5064, 0, '0000-00-00', 3),
(1439, 5065, 0, '0000-00-00', 3),
(1440, 5066, 0, '0000-00-00', 3),
(1441, 5067, 0, '0000-00-00', 3),
(1442, 5068, 0, '0000-00-00', 3),
(1443, 5069, 0, '0000-00-00', 3),
(1444, 5070, 0, '0003-03-09', 3),
(1445, 5071, 0, '0004-05-05', 3),
(1446, 5072, 0, '0001-06-09', 3),
(1447, 5073, 0, '0000-00-00', 3),
(1448, 5074, 0, '0007-11-09', 3),
(1449, 5075, 0, '0000-00-00', 3),
(1450, 5076, 0, '0000-00-00', 3),
(1451, 5077, 0, '0000-00-00', 3),
(1452, 5078, 0, '0000-00-00', 3),
(1453, 5079, 0, '2010-09-07', 3);

-- --------------------------------------------------------

--
-- Table structure for table `examtype`
--

CREATE TABLE IF NOT EXISTS `examtype` (
  `examtype_id` varchar(20) NOT NULL default '0',
  `examtype` varchar(25) default NULL,
  PRIMARY KEY  (`examtype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `examtype`
--

INSERT INTO `examtype` (`examtype_id`, `examtype`) VALUES
('Both', 'Glasses & Contacts'),
('Contacts', 'Contacts'),
('ExamOnly', 'Exam Only'),
('Glasses', 'Glasses'),
('undefined', 'undefined');

-- --------------------------------------------------------

--
-- Table structure for table `frames`
--

CREATE TABLE IF NOT EXISTS `frames` (
  `id` int(11) NOT NULL auto_increment,
  `division_id` int(11) NOT NULL,
  `name` varchar(25) default NULL,
  `cost_price` float default NULL,
  `retail_price` float default NULL,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id_2` (`id`,`division_id`),
  KEY `id` (`id`,`division_id`),
  KEY `division_id` (`division_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `frames`
--

INSERT INTO `frames` (`id`, `division_id`, `name`, `cost_price`, `retail_price`, `active`) VALUES
(1, 1, 'lux-div1-frame1', 12.34, 45.67, 1),
(2, 2, 'cool frame', 99, 200, 1),
(3, 3, 'mfg2-div1-frame1', 12.34, 45.67, 1),
(4, 1, 'lux-div1-frame3', 333, 444, 1),
(5, 4, 'Test', 300, 100, 1),
(6, 4, 'test 3', 300, 100, 1),
(7, 4, 'Melissa', 300, 100, 1),
(8, 4, 'Doug', 300, 100, 1),
(9, 4, 'Jennifer', 300, 100, 1),
(10, 3, 'mfg2-div1-frame2', 50, 100, 1),
(11, 5, 'mfg2-div2-frame1', 75, 125, 1),
(12, 3, 'mfg2-div1-frame3', 200, 300, 1),
(13, 5, 'mfg2-div2-frame2', 222, 333, 1),
(14, 5, 'mfg2-div2-frame3', 333, 444, 1),
(15, 5, 'mfg2-div2-frame4', 19.99, 55.55, 1),
(16, 3, 'mfg2-div1-frame4', 250, 500, 1);

-- --------------------------------------------------------

--
-- Table structure for table `frame_colors`
--

CREATE TABLE IF NOT EXISTS `frame_colors` (
  `id` int(11) NOT NULL auto_increment,
  `color` varchar(25) default NULL,
  `frame_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `color` (`color`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `frame_colors`
--

INSERT INTO `frame_colors` (`id`, `color`, `frame_id`, `active`) VALUES
(1, 'Black', 1, 1),
(2, 'Silver', 2, 1),
(3, 'Green', 1, 1),
(4, 'orange', 1, 1),
(5, 'Blue', 1, 1),
(6, 'Onyz', 1, 1),
(7, 'silver', 3, 1),
(8, 'Green', 3, 1),
(9, 'yellow', 3, 1),
(10, 'green', 4, 1),
(11, 'Black', 5, 1),
(12, 'Blue', 6, 1),
(13, 'Brown', 6, 1),
(14, 'Brown', 7, 1),
(15, 'Bronze', 8, 1),
(16, 'Pink', 9, 1),
(17, 'Orange', 3, 1),
(18, 'Blue', 10, 1),
(19, 'pink', 10, 1),
(20, 'red', 11, 1),
(21, 'chrome', 12, 1),
(22, 'green', 11, 1),
(23, 'black', 13, 1),
(24, 'yellow', 13, 1),
(25, 'orange', 14, 1),
(26, 'Skyblue', 14, 1),
(27, 'Red', 13, 1),
(28, 'silver', 14, 1),
(29, 'brown', 15, 1),
(30, 'Bright Green', 3, 1),
(31, 'Orange', 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `frame_divisions`
--

CREATE TABLE IF NOT EXISTS `frame_divisions` (
  `id` int(11) NOT NULL auto_increment,
  `manufacturer_id` int(11) NOT NULL,
  `division` varchar(25) NOT NULL,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`,`division`),
  UNIQUE KEY `manufacturer_id_2` (`manufacturer_id`,`division`),
  KEY `manufacturer_id` (`manufacturer_id`,`division`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `frame_divisions`
--

INSERT INTO `frame_divisions` (`id`, `manufacturer_id`, `division`, `active`) VALUES
(1, 1, 'lux-div1', 1),
(2, 1, 'lux-div2', 1),
(3, 2, 'mfg2-div1', 1),
(4, 3, 'Gucci', 1),
(5, 2, 'mfg2-div2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `frame_inventory`
--

CREATE TABLE IF NOT EXISTS `frame_inventory` (
  `id` int(11) NOT NULL auto_increment,
  `frame_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `store_id` varchar(50) NOT NULL,
  `eye_size_min` int(11) NOT NULL,
  `bridge_size` int(11) NOT NULL,
  `temple_size` int(11) NOT NULL,
  `date_in` date default NULL COMMENT 'date added to inventory',
  `date_out` date default NULL COMMENT 'date removed from inventory',
  `active` tinyint(4) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `store_id` (`store_id`),
  KEY `frame_inventory_ibfk_1` (`frame_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `frame_inventory`
--

INSERT INTO `frame_inventory` (`id`, `frame_id`, `color_id`, `store_id`, `eye_size_min`, `bridge_size`, `temple_size`, `date_in`, `date_out`, `active`) VALUES
(1, 1, 1, '34onehour', 36, 12, 115, '2010-10-20', NULL, 1),
(2, 4, 10, '34onehour', 39, 13, 130, '2010-10-20', NULL, 1),
(3, 4, 10, '34onehour', 39, 13, 130, '2010-10-20', NULL, 1),
(4, 5, 11, '34onehour', 52, 18, 135, '2010-12-13', NULL, 1),
(5, 6, 12, '34onehour', 50, 15, 135, '2010-12-13', NULL, 1),
(6, 6, 13, '34onehour', 48, 15, 135, '2010-12-13', NULL, 1),
(7, 7, 14, '34onehour', 52, 14, 135, '2010-12-13', NULL, 1),
(8, 8, 15, '34onehour', 52, 20, 140, '2010-12-13', NULL, 1),
(9, 8, 15, '34onehour', 54, 20, 140, '2010-12-13', NULL, 1),
(10, 9, 16, '34onehour', 50, 20, 140, '2010-12-13', NULL, 1),
(11, 3, 7, '34onehour', 35, 12, 115, '2011-03-02', NULL, 1),
(12, 3, 8, '34onehour', 35, 12, 115, '2011-03-02', NULL, 1),
(13, 3, 9, '34onehour', 35, 12, 115, '2011-03-02', NULL, 1),
(14, 3, 17, '34onehour', 35, 12, 115, '2011-03-02', NULL, 1),
(15, 10, 18, '34onehour', 41, 18, 130, '2011-03-02', NULL, 1),
(16, 10, 19, '34onehour', 48, 19, 145, '2011-03-02', NULL, 1),
(17, 11, 20, '34onehour', 48, 19, 145, '2011-03-02', NULL, 1),
(18, 3, 7, '34onehour', 35, 12, 115, '2011-03-02', NULL, 1),
(19, 10, 18, '34onehour', 35, 12, 120, '2011-03-02', NULL, 1),
(20, 12, 21, '34onehour', 35, 12, 115, '2011-03-02', NULL, 1),
(21, 11, 22, '34onehour', 35, 12, 115, '2011-03-02', NULL, 1),
(22, 13, 23, '34onehour', 35, 12, 115, '2011-03-02', NULL, 1),
(23, 13, 24, '34onehour', 39, 12, 120, '2011-03-02', NULL, 1),
(24, 14, 25, '34onehour', 35, 12, 115, '2011-03-02', NULL, 1),
(25, 14, 26, '34onehour', 39, 13, 140, '2011-03-02', NULL, 1),
(26, 13, 23, '34onehour', 37, 13, 115, '2011-03-02', NULL, 1),
(27, 13, 24, '34onehour', 40, 16, 130, '2011-03-02', NULL, 1),
(28, 13, 27, '34onehour', 42, 19, 135, '2011-03-02', NULL, 1),
(29, 13, 27, '34onehour', 43, 19, 135, '2011-03-02', NULL, 1),
(30, 14, 25, '34onehour', 35, 12, 115, '2011-03-02', NULL, 1),
(31, 14, 26, '34onehour', 35, 14, 125, '2011-03-02', NULL, 1),
(32, 14, 28, '34onehour', 35, 14, 145, '2011-03-02', NULL, 1),
(33, 14, 25, '34onehour', 35, 14, 130, '2011-03-02', NULL, 1),
(34, 15, 29, '34onehour', 35, 17, 130, '2011-03-02', NULL, 1),
(35, 3, 9, '34onehour', 36, 12, 120, '2011-03-15', NULL, 1),
(36, 3, 30, '34onehour', 36, 14, 120, '2011-03-15', NULL, 1),
(37, 16, 31, '34onehour', 36, 14, 120, '2011-03-15', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `frame_manufacturers`
--

CREATE TABLE IF NOT EXISTS `frame_manufacturers` (
  `id` int(11) NOT NULL auto_increment,
  `manufacturer` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `manufacturer` (`manufacturer`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `frame_manufacturers`
--

INSERT INTO `frame_manufacturers` (`id`, `manufacturer`, `active`) VALUES
(1, 'Luxottica', 1),
(2, 'mfg2', 1),
(3, 'Safilo', 1);

-- --------------------------------------------------------

--
-- Table structure for table `insurance`
--

CREATE TABLE IF NOT EXISTS `insurance` (
  `insurance_id` int(11) NOT NULL auto_increment,
  `carrier` varchar(25) default NULL,
  `date_filed` date default NULL,
  `auth_number` varchar(25) default NULL,
  `id_num` varchar(25) default NULL,
  `dob` date default NULL,
  PRIMARY KEY  (`insurance_id`),
  KEY `insurance_id` (`insurance_id`),
  KEY `carrier` (`carrier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `insurance`
--


-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(11) NOT NULL auto_increment,
  `client_id` varchar(100) NOT NULL,
  `order_id` int(11) default NULL,
  `invoice_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `frame_price` float NOT NULL,
  `lens_price` float default NULL,
  `treatment_price` float default NULL,
  `coating_price` float default NULL,
  `discount` float default NULL,
  `labfee` float default NULL,
  `subtotal` float NOT NULL,
  `tax` float default NULL,
  `total` float NOT NULL,
  `deposit` float default NULL,
  `status` varchar(25) default NULL,
  `paid_in_full` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`),
  KEY `order_id` (`order_id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `invoices`
--


-- --------------------------------------------------------

--
-- Table structure for table `invoice_status`
--

CREATE TABLE IF NOT EXISTS `invoice_status` (
  `id` int(11) NOT NULL auto_increment,
  `status` varchar(25) NOT NULL,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `invoice_status`
--

INSERT INTO `invoice_status` (`id`, `status`, `active`) VALUES
(1, 'Pending', 1),
(2, 'In Process', 1),
(3, 'On Hold', 1),
(4, 'Cancelled', 1),
(5, 'Void', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ledger`
--

CREATE TABLE IF NOT EXISTS `ledger` (
  `ledger_id` int(11) NOT NULL auto_increment,
  `invoice_id` int(11) default NULL,
  `client_id` varchar(100) default NULL,
  `debit` float default NULL,
  `credit` float default NULL,
  `trans_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `balance` float NOT NULL,
  PRIMARY KEY  (`ledger_id`),
  KEY `ledger_id` (`ledger_id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ledger`
--


-- --------------------------------------------------------

--
-- Table structure for table `lens_brands`
--

CREATE TABLE IF NOT EXISTS `lens_brands` (
  `id` int(11) NOT NULL auto_increment,
  `type_id` int(11) NOT NULL COMMENT 'id from Lens_types',
  `brand` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `brand` (`brand`),
  KEY `lens_brands_ibfk_1` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `lens_brands`
--


-- --------------------------------------------------------

--
-- Table structure for table `lens_coatings`
--

CREATE TABLE IF NOT EXISTS `lens_coatings` (
  `id` int(11) NOT NULL auto_increment,
  `coating` varchar(25) NOT NULL,
  `cost_price` float NOT NULL,
  `retail_price` float NOT NULL,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `coating` (`coating`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `lens_coatings`
--

INSERT INTO `lens_coatings` (`id`, `coating`, `cost_price`, `retail_price`, `active`) VALUES
(1, 'Lensguard', 10, 20, 1),
(2, 'Roll & Polish', 5, 10, 1),
(3, 'UV400', 25, 50, 1),
(4, 'TINT', 15, 30, 1),
(5, 'AR Coating', 12.25, 25.25, 1),
(6, '-None', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lens_colors`
--

CREATE TABLE IF NOT EXISTS `lens_colors` (
  `id` int(11) NOT NULL auto_increment,
  `color` varchar(25) NOT NULL,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `color` (`color`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `lens_colors`
--

INSERT INTO `lens_colors` (`id`, `color`, `active`) VALUES
(1, 'Blue', 1),
(2, 'Red', 1),
(3, 'Green', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lens_designs`
--

CREATE TABLE IF NOT EXISTS `lens_designs` (
  `id` int(11) NOT NULL auto_increment,
  `brand_id` int(11) NOT NULL COMMENT 'id from Lens_brands',
  `design` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `design` (`design`),
  KEY `lens_designs_ibfk_1` (`brand_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `lens_designs`
--


-- --------------------------------------------------------

--
-- Table structure for table `lens_materials`
--

CREATE TABLE IF NOT EXISTS `lens_materials` (
  `id` int(11) NOT NULL auto_increment,
  `design_id` int(11) NOT NULL COMMENT 'id from Lens_designs',
  `material` varchar(50) NOT NULL,
  `retail_price` float NOT NULL,
  `cost_price` float NOT NULL,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `material` (`material`),
  KEY `lens_materials_ibfk_1` (`design_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `lens_materials`
--


-- --------------------------------------------------------

--
-- Table structure for table `lens_treatments`
--

CREATE TABLE IF NOT EXISTS `lens_treatments` (
  `id` int(11) NOT NULL auto_increment,
  `treatment` varchar(50) NOT NULL,
  `cost_price` float NOT NULL,
  `retail_price` float NOT NULL,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `treatment` (`treatment`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `lens_treatments`
--


-- --------------------------------------------------------

--
-- Table structure for table `lens_types`
--

CREATE TABLE IF NOT EXISTS `lens_types` (
  `id` int(11) NOT NULL auto_increment,
  `type` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `lens_types`
--

INSERT INTO `lens_types` (`id`, `type`, `active`) VALUES
(1, 'Single Vision', 1),
(2, 'Bifocal', 1),
(3, 'Trifocal', 1),
(4, 'Progressive', 1),
(5, 'Specialty', 1);

-- --------------------------------------------------------

--
-- Table structure for table `list_bridge_sizes`
--

CREATE TABLE IF NOT EXISTS `list_bridge_sizes` (
  `size` float NOT NULL,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`size`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_bridge_sizes`
--

INSERT INTO `list_bridge_sizes` (`size`, `active`) VALUES
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `list_carriers`
--

CREATE TABLE IF NOT EXISTS `list_carriers` (
  `id` int(11) NOT NULL auto_increment,
  `carrier` varchar(50) NOT NULL,
  `discount_type` varchar(10) NOT NULL,
  `discount_amount` float NOT NULL,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `carrier` (`carrier`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `list_carriers`
--

INSERT INTO `list_carriers` (`id`, `carrier`, `discount_type`, `discount_amount`, `active`) VALUES
(1, 'BCBS', '', 0, 1),
(2, 'Avesis', '', 0, 1),
(3, 'EyeMed', '', 0, 1),
(4, 'Spectera', '', 0, 1),
(5, 'United Health Care', '', 0, 1),
(6, 'VSP', '', 0, 1),
(7, 'Etna', '', 0, 1),
(8, 'American Administrators', '', 0, 1),
(9, 'Coventry', '', 0, 1),
(10, 'Davis', '', 0, 1),
(11, 'First Administrators', '', 0, 1),
(12, 'Iowa Labors', '', 0, 1),
(13, 'Title XIX', '', 0, 1),
(14, 'Midlands Choice', '', 0, 1),
(15, 'Plumbers and Steamfitters', '', 0, 1),
(16, 'Principal', '', 0, 1),
(17, 'Superior', '', 0, 1),
(18, 'Tricare', '', 0, 1),
(19, 'UHC Rivervalley', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `list_diag_codes`
--

CREATE TABLE IF NOT EXISTS `list_diag_codes` (
  `diag_code` varchar(10) NOT NULL,
  `diagnosis` varchar(100) NOT NULL,
  `active` tinyint(1) default '1',
  PRIMARY KEY  (`diag_code`),
  KEY `diag_code` (`diag_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_diag_codes`
--

INSERT INTO `list_diag_codes` (`diag_code`, `diagnosis`, `active`) VALUES
('', ' ', 1),
(' {NONE}', '', 1),
('367.0', '367.0 diag', 1),
('367.1', '367.1 diag', 1),
('367.20', '367.20 diag', 1),
('367.4', '367.5 diag', 1);

-- --------------------------------------------------------

--
-- Table structure for table `list_discounts`
--

CREATE TABLE IF NOT EXISTS `list_discounts` (
  `description` varchar(100) NOT NULL,
  `discount_id` varchar(10) NOT NULL,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`discount_id`),
  KEY `discount_id` (`discount_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_discounts`
--

INSERT INTO `list_discounts` (`description`, `discount_id`, `active`) VALUES
('95% off in May', 'MAY01', 1),
('Newspaper coupon', 'NEWS5', 1),
('Great TV discount', 'TV01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `list_divisions`
--

CREATE TABLE IF NOT EXISTS `list_divisions` (
  `division` varchar(25) NOT NULL,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`division`),
  KEY `division` (`division`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_divisions`
--

INSERT INTO `list_divisions` (`division`, `active`) VALUES
('Eye-Mart', 1),
('One Hour', 1),
('Vogue', 1),
('Younkers', 1);

-- --------------------------------------------------------

--
-- Table structure for table `list_lens_bases`
--

CREATE TABLE IF NOT EXISTS `list_lens_bases` (
  `id` int(11) NOT NULL auto_increment,
  `base` varchar(5) NOT NULL,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `base` (`base`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `list_lens_bases`
--

INSERT INTO `list_lens_bases` (`id`, `base`, `active`) VALUES
(1, '', 1),
(2, 'Up', 1),
(3, 'Down', 1),
(4, 'In', 1),
(5, 'Out', 1);

-- --------------------------------------------------------

--
-- Table structure for table `list_lens_colors`
--

CREATE TABLE IF NOT EXISTS `list_lens_colors` (
  `color` varchar(25) NOT NULL,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`color`),
  KEY `color` (`color`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_lens_colors`
--

INSERT INTO `list_lens_colors` (`color`, `active`) VALUES
('Blue', 1),
('Green', 1),
('Red', 1);

-- --------------------------------------------------------

--
-- Table structure for table `list_lens_pd`
--

CREATE TABLE IF NOT EXISTS `list_lens_pd` (
  `distance` float NOT NULL,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`distance`),
  KEY `distance` (`distance`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_lens_pd`
--

INSERT INTO `list_lens_pd` (`distance`, `active`) VALUES
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1);

-- --------------------------------------------------------

--
-- Table structure for table `list_lens_shapes`
--

CREATE TABLE IF NOT EXISTS `list_lens_shapes` (
  `id` int(11) NOT NULL auto_increment,
  `shape` varchar(25) NOT NULL,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `shape` (`shape`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `list_lens_shapes`
--

INSERT INTO `list_lens_shapes` (`id`, `shape`, `active`) VALUES
(1, 'Egg', 1),
(2, 'Oval', 1),
(3, 'Round', 1),
(4, 'Square', 1),
(5, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `list_lens_sizes`
--

CREATE TABLE IF NOT EXISTS `list_lens_sizes` (
  `id` int(11) NOT NULL auto_increment,
  `size` float default NULL,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `size` (`size`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `list_lens_sizes`
--

INSERT INTO `list_lens_sizes` (`id`, `size`, `active`) VALUES
(1, -10, 1),
(2, -8, 1),
(3, -6, 1),
(4, -4, 1),
(5, -2, 1),
(6, 0, 1),
(7, 2, 1),
(8, 4, 1),
(9, 6, 1),
(10, 8, 1),
(11, 10, 1),
(12, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `list_lens_treatments`
--

CREATE TABLE IF NOT EXISTS `list_lens_treatments` (
  `id` int(11) NOT NULL auto_increment,
  `treatment` varchar(25) NOT NULL,
  `price` float default NULL,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `treatment` (`treatment`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `list_lens_treatments`
--


-- --------------------------------------------------------

--
-- Table structure for table `list_order_type`
--

CREATE TABLE IF NOT EXISTS `list_order_type` (
  `order_type` varchar(25) NOT NULL,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`order_type`),
  KEY `order_type` (`order_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_order_type`
--

INSERT INTO `list_order_type` (`order_type`, `active`) VALUES
('New', 1),
('Remake', 1);

-- --------------------------------------------------------

--
-- Table structure for table `list_remake_reasons`
--

CREATE TABLE IF NOT EXISTS `list_remake_reasons` (
  `reason` varchar(25) NOT NULL,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`reason`),
  KEY `reason` (`reason`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_remake_reasons`
--

INSERT INTO `list_remake_reasons` (`reason`, `active`) VALUES
(' ', 1),
('Dispencer Error', 1),
('Dr. Error', 1),
('Lab Error', 1);

-- --------------------------------------------------------

--
-- Table structure for table `list_temple_lengths`
--

CREATE TABLE IF NOT EXISTS `list_temple_lengths` (
  `temple_length` float NOT NULL,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`temple_length`),
  KEY `temple_length` (`temple_length`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_temple_lengths`
--

INSERT INTO `list_temple_lengths` (`temple_length`, `active`) VALUES
(1.5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) NOT NULL auto_increment,
  `ip_address` varchar(40) collate utf8_bin NOT NULL,
  `time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=163 ;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `time`) VALUES
(21, '99.198.2.133', '2009-11-02 15:28:25'),
(34, '75.162.23.201', '2009-12-02 10:02:41'),
(57, '97.119.67.184', '2010-01-19 10:48:57'),
(58, '97.119.67.184', '2010-01-19 10:49:41'),
(59, '97.119.67.184', '2010-01-19 10:51:13'),
(69, '207.191.223.137', '2010-01-24 21:46:24'),
(70, '207.191.223.137', '2010-01-24 21:46:34'),
(71, '75.170.160.11', '2010-01-27 10:59:42'),
(72, '75.170.160.11', '2010-01-27 10:59:59'),
(73, '75.170.160.11', '2010-01-27 11:00:27'),
(98, '75.253.62.180', '2010-04-13 15:21:28'),
(99, '75.253.62.180', '2010-04-13 15:21:41'),
(100, '75.253.62.180', '2010-04-13 15:21:56'),
(156, '173.27.208.156', '2010-06-14 01:16:53'),
(157, '173.27.208.156', '2010-06-14 01:17:04'),
(158, '173.27.208.156', '2010-06-14 01:17:48'),
(159, '174.30.94.43', '2010-10-17 14:35:06'),
(160, '174.30.94.43', '2010-10-17 14:35:36'),
(161, '202.56.7.163', '2011-03-01 18:03:22');

-- --------------------------------------------------------

--
-- Table structure for table `marketing`
--

CREATE TABLE IF NOT EXISTS `marketing` (
  `marketing_id` int(11) NOT NULL auto_increment,
  `client_id` varchar(100) default NULL,
  `user_id` int(11) default NULL,
  `new` tinyint(1) default '1',
  `source_code` varchar(25) default NULL,
  `source` varchar(255) default NULL,
  PRIMARY KEY  (`marketing_id`),
  KEY `marketing_id` (`marketing_id`),
  KEY `client_id` (`client_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `marketing`
--


-- --------------------------------------------------------

--
-- Table structure for table `mas90data`
--

CREATE TABLE IF NOT EXISTS `mas90data` (
  `customer_number` varchar(25) NOT NULL,
  `customer_name` varchar(25) NOT NULL,
  `address1` varchar(50) default NULL,
  `address2` varchar(50) default NULL,
  `address3` varchar(50) default NULL,
  `city` varchar(50) default NULL,
  `state` varchar(5) default NULL,
  `zipcode` varchar(10) default NULL,
  `phone` varchar(15) default NULL,
  `propercase` bit(1) NOT NULL,
  `namesplit` bit(1) NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `modified` tinyint(1) NOT NULL default '0',
  `date_archived` date NOT NULL default '1900-01-01',
  `date_modified` date NOT NULL default '1900-01-01',
  PRIMARY KEY  (`customer_number`),
  KEY `customer_number` (`customer_number`),
  KEY `customer_number_2` (`customer_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mas90data`
--


-- --------------------------------------------------------

--
-- Table structure for table `mas90trans`
--

CREATE TABLE IF NOT EXISTS `mas90trans` (
  `record_id` int(11) NOT NULL auto_increment,
  `customer_number` varchar(25) default NULL,
  `period` date default NULL,
  `amount` double(8,2) NOT NULL,
  PRIMARY KEY  (`record_id`),
  KEY `customer_number` (`customer_number`),
  KEY `customer_number_2` (`customer_number`,`period`,`amount`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mas90trans`
--


-- --------------------------------------------------------

--
-- Table structure for table `mas90_temp`
--

CREATE TABLE IF NOT EXISTS `mas90_temp` (
  `customer_number` varchar(25) NOT NULL,
  `customer_name` varchar(25) default NULL,
  `address1` varchar(50) default NULL,
  `address2` varchar(50) default NULL,
  `address3` varchar(50) default NULL,
  `city` varchar(50) default NULL,
  `state` varchar(5) default NULL,
  `zipcode` varchar(10) default NULL,
  `phone` varchar(15) default NULL,
  `period` date NOT NULL,
  `amount` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mas90_temp`
--


-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL auto_increment,
  `client_id` varchar(100) NOT NULL,
  `dispencer_id` varchar(50) default NULL,
  `store_id` varchar(50) NOT NULL,
  `invoice_id` int(11) default NULL,
  `order_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `order_type` varchar(25) NOT NULL,
  `insurance` varchar(50) default NULL,
  `insurance_id` varchar(50) default NULL,
  `tray_num` int(11) default NULL,
  `doctor_id` varchar(50) default NULL,
  `other_doctor` varchar(50) default NULL,
  `due_date` date default NULL,
  `complete_date` date default NULL,
  `delivered_date` date default NULL,
  `remake_reason` varchar(25) default NULL,
  `paid_in_full` tinyint(1) NOT NULL default '0',
  `segment_decentration` varchar(255) default NULL,
  `segment_height_l` float default NULL,
  `segment_height_r` float default NULL,
  `segment_width_l` float default NULL,
  `segment_width_r` float default NULL,
  `lens_color` varchar(25) default NULL,
  `lens_size_a` float default NULL,
  `lens_size_b` float default NULL,
  `lens_size_ed` float default NULL,
  `lens_shape` int(11) default NULL,
  `type_id` int(11) default NULL,
  `design_id` int(11) default NULL,
  `material_id` int(11) default NULL,
  `treatment_id` int(11) default NULL,
  `coating_id` int(11) default NULL,
  `bridge_size` float default NULL,
  `temple_length` float default NULL,
  `add_l` float default NULL,
  `add_r` float default NULL,
  `lens_id` int(11) default NULL,
  `special_instructions` varchar(1024) default NULL,
  `pd_near_l` float default NULL,
  `pd_near_r` float default NULL,
  `pd_far_l` float default NULL,
  `pd_far_r` float default NULL,
  `diag_code` varchar(10) default NULL,
  `frame_id` int(11) default NULL,
  `frame_color` varchar(25) default NULL,
  PRIMARY KEY  (`order_id`),
  KEY `order_id` (`order_id`,`invoice_id`),
  KEY `remake_reason` (`remake_reason`),
  KEY `doctor_id` (`doctor_id`),
  KEY `client_id` (`client_id`),
  KEY `store_id` (`store_id`),
  KEY `order_type` (`order_type`),
  KEY `frame_id` (`frame_id`),
  KEY `diag_code` (`diag_code`),
  KEY `type_id` (`type_id`),
  KEY `design_id` (`design_id`),
  KEY `material_id` (`material_id`),
  KEY `treatment_id` (`treatment_id`),
  KEY `coating_id` (`coating_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `client_id`, `dispencer_id`, `store_id`, `invoice_id`, `order_date`, `order_type`, `insurance`, `insurance_id`, `tray_num`, `doctor_id`, `other_doctor`, `due_date`, `complete_date`, `delivered_date`, `remake_reason`, `paid_in_full`, `segment_decentration`, `segment_height_l`, `segment_height_r`, `segment_width_l`, `segment_width_r`, `lens_color`, `lens_size_a`, `lens_size_b`, `lens_size_ed`, `lens_shape`, `type_id`, `design_id`, `material_id`, `treatment_id`, `coating_id`, `bridge_size`, `temple_length`, `add_l`, `add_r`, `lens_id`, `special_instructions`, `pd_near_l`, `pd_near_r`, `pd_far_l`, `pd_far_r`, `diag_code`, `frame_id`, `frame_color`) VALUES
(1, 'PatFar10062010151624-94635', '', '34onehour', NULL, '2011-03-30 00:00:00', 'New', NULL, 'example', NULL, 'KBrost', '', NULL, NULL, NULL, ' ', 0, NULL, 20, 20, NULL, NULL, '1', 3, 1, 1, NULL, NULL, 8, 5, NULL, 5, 1, 1, 1, 1, 4, 'notes', 2, 2, 2, 2, '367.0', 13, NULL),
(2, 'PatFar10062010151624-94635', '', '34onehour', NULL, '2011-03-30 00:00:00', 'New', NULL, 'example', NULL, 'KBrost', '', NULL, NULL, NULL, ' ', 0, NULL, 20, 20, NULL, NULL, '1', 3, 1, 1, NULL, NULL, 8, 5, NULL, 5, 1, 1, 1, 1, 4, 'notes', 2, 2, 2, 2, '367.0', 10, NULL),
(3, 'PatFar10062010151624-94635', '', '34onehour', NULL, '2011-03-30 00:00:00', 'New', NULL, 'example', NULL, 'KBrost', '', NULL, NULL, NULL, ' ', 0, NULL, 20, 20, NULL, NULL, '1', 3, 1, 1, NULL, NULL, 8, 5, NULL, 5, 1, 1, 1, 1, 4, 'notes', 2, 2, 2, 2, '367.0', 14, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders_treatments`
--

CREATE TABLE IF NOT EXISTS `orders_treatments` (
  `id` int(11) NOT NULL auto_increment,
  `order_id` int(11) NOT NULL,
  `treatment_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `treatment_id` (`treatment_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `orders_treatments`
--


-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `page_id` int(11) NOT NULL auto_increment,
  `page_name` varchar(25) NOT NULL,
  `page_title` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL default '1',
  `page_rank` tinyint(2) default NULL,
  PRIMARY KEY  (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `page_name`, `page_title`, `active`, `page_rank`) VALUES
(2, 'main/about', 'About', 0, 10),
(5, 'reports', 'Reports', 1, 7),
(6, 'main/support', 'Support', 1, 13),
(7, 'main/search', 'Home', 1, 1),
(11, 'main/search', 'Client Search', 1, 3),
(13, 'inventory', 'Inventory Menu', 1, 11),
(15, 'invoice', 'Invoices Menu', 0, 12);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL auto_increment,
  `role_id` int(11) NOT NULL,
  `data` text collate utf8_bin,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `permissions`
--


-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) NOT NULL default '0',
  `name` varchar(30) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `parent_id`, `name`) VALUES
(1, 0, 'User'),
(2, 0, 'Admin'),
(3, 0, 'Guest'),
(6, 1, 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL default '1',
  `lab_fee` float default NULL,
  `lab_fee_type` char(1) default 'F' COMMENT 'F = Flat fee, P = Percent',
  `sphere_min` float NOT NULL,
  `sphere_max` float NOT NULL,
  `sphere_increment` float NOT NULL,
  `sphere_decimals` int(11) NOT NULL,
  `sphere_signed` tinyint(4) NOT NULL,
  `sphere_default` varchar(50) NOT NULL,
  `sphere_blank` tinyint(4) NOT NULL,
  `cylinder_min` float NOT NULL,
  `cylinder_max` float NOT NULL,
  `cylinder_increment` float NOT NULL,
  `cylinder_decimals` int(11) NOT NULL,
  `cylinder_signed` tinyint(4) NOT NULL,
  `cylinder_default` varchar(50) NOT NULL,
  `cylinder_blank` tinyint(4) NOT NULL,
  `add_min` float NOT NULL,
  `add_max` float NOT NULL,
  `add_increment` float NOT NULL,
  `add_decimals` int(11) NOT NULL,
  `add_signed` tinyint(4) NOT NULL,
  `add_default` varchar(50) NOT NULL,
  `add_blank` tinyint(4) NOT NULL,
  `prism_min` float NOT NULL,
  `prism_max` float NOT NULL,
  `prism_increment` float NOT NULL,
  `prism_decimals` int(11) NOT NULL,
  `prism_signed` tinyint(4) NOT NULL,
  `prism_default` varchar(50) NOT NULL,
  `prism_blank` tinyint(4) NOT NULL,
  `axis_min` float NOT NULL,
  `axis_max` float NOT NULL,
  `axis_increment` float NOT NULL,
  `axis_decimals` int(11) NOT NULL,
  `axis_signed` tinyint(4) NOT NULL,
  `axis_default` varchar(50) NOT NULL,
  `axis_blank` tinyint(4) NOT NULL,
  `bridge_min` float NOT NULL,
  `bridge_max` float NOT NULL,
  `bridge_increment` float NOT NULL,
  `bridge_decimals` int(11) NOT NULL,
  `bridge_signed` tinyint(4) NOT NULL,
  `bridge_default` float NOT NULL,
  `bridge_blank` tinyint(4) NOT NULL,
  `eye_size_min` float NOT NULL,
  `eye_size_max` float NOT NULL,
  `eye_size_increment` float NOT NULL,
  `eye_size_decimals` int(11) NOT NULL,
  `eye_size_signed` tinyint(4) NOT NULL,
  `eye_size_default` float NOT NULL,
  `eye_size_blank` tinyint(4) NOT NULL,
  `pd_min` float NOT NULL,
  `pd_max` float NOT NULL,
  `pd_increment` float NOT NULL,
  `pd_decimals` int(11) NOT NULL,
  `pd_signed` tinyint(4) NOT NULL,
  `pd_default` varchar(50) NOT NULL,
  `pd_blank` tinyint(4) NOT NULL,
  `temple_length_min` float NOT NULL,
  `temple_length_max` float NOT NULL,
  `temple_length_increment` int(11) NOT NULL,
  `temple_length_decimals` int(11) NOT NULL,
  `temple_length_signed` tinyint(4) NOT NULL,
  `temple_length_default` varchar(50) NOT NULL,
  `temple_length_blank` tinyint(4) NOT NULL,
  `segment_height_min` float NOT NULL,
  `segment_height_max` float NOT NULL,
  `segment_height_increment` int(11) NOT NULL,
  `segment_height_decimals` int(11) NOT NULL,
  `segment_height_signed` tinyint(4) NOT NULL,
  `segment_height_default` varchar(50) NOT NULL,
  `segment_height_blank` tinyint(4) NOT NULL,
  `lens_a_min` float NOT NULL,
  `lens_a_max` float NOT NULL,
  `lens_a_increment` int(11) NOT NULL,
  `lens_a_decimals` int(11) NOT NULL,
  `lens_a_signed` tinyint(4) NOT NULL,
  `lens_a_default` varchar(50) NOT NULL,
  `lens_a_blank` tinyint(4) NOT NULL,
  `lens_b_min` float NOT NULL,
  `lens_b_max` float NOT NULL,
  `lens_b_increment` int(11) NOT NULL,
  `lens_b_decimals` int(11) NOT NULL,
  `lens_b_signed` tinyint(4) NOT NULL,
  `lens_b_default` varchar(50) NOT NULL,
  `lens_b_blank` tinyint(4) NOT NULL,
  `lens_ed_min` float NOT NULL,
  `lens_ed_max` float NOT NULL,
  `lens_ed_increment` float NOT NULL,
  `lens_ed_decimals` int(11) NOT NULL,
  `lens_ed_signed` tinyint(4) NOT NULL,
  `lens_ed_default` varchar(50) NOT NULL,
  `lens_ed_blank` tinyint(4) NOT NULL,
  `lens_gradient_min` float NOT NULL,
  `lens_gradient_max` float NOT NULL,
  `lens_gradient_increment` float NOT NULL,
  `lens_gradient_decimals` int(11) NOT NULL,
  `lens_gradient_signed` tinyint(4) NOT NULL,
  `lens_gradient_default` varchar(50) NOT NULL,
  `lens_gradient_blank` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `lab_fee`, `lab_fee_type`, `sphere_min`, `sphere_max`, `sphere_increment`, `sphere_decimals`, `sphere_signed`, `sphere_default`, `sphere_blank`, `cylinder_min`, `cylinder_max`, `cylinder_increment`, `cylinder_decimals`, `cylinder_signed`, `cylinder_default`, `cylinder_blank`, `add_min`, `add_max`, `add_increment`, `add_decimals`, `add_signed`, `add_default`, `add_blank`, `prism_min`, `prism_max`, `prism_increment`, `prism_decimals`, `prism_signed`, `prism_default`, `prism_blank`, `axis_min`, `axis_max`, `axis_increment`, `axis_decimals`, `axis_signed`, `axis_default`, `axis_blank`, `bridge_min`, `bridge_max`, `bridge_increment`, `bridge_decimals`, `bridge_signed`, `bridge_default`, `bridge_blank`, `eye_size_min`, `eye_size_max`, `eye_size_increment`, `eye_size_decimals`, `eye_size_signed`, `eye_size_default`, `eye_size_blank`, `pd_min`, `pd_max`, `pd_increment`, `pd_decimals`, `pd_signed`, `pd_default`, `pd_blank`, `temple_length_min`, `temple_length_max`, `temple_length_increment`, `temple_length_decimals`, `temple_length_signed`, `temple_length_default`, `temple_length_blank`, `segment_height_min`, `segment_height_max`, `segment_height_increment`, `segment_height_decimals`, `segment_height_signed`, `segment_height_default`, `segment_height_blank`, `lens_a_min`, `lens_a_max`, `lens_a_increment`, `lens_a_decimals`, `lens_a_signed`, `lens_a_default`, `lens_a_blank`, `lens_b_min`, `lens_b_max`, `lens_b_increment`, `lens_b_decimals`, `lens_b_signed`, `lens_b_default`, `lens_b_blank`, `lens_ed_min`, `lens_ed_max`, `lens_ed_increment`, `lens_ed_decimals`, `lens_ed_signed`, `lens_ed_default`, `lens_ed_blank`, `lens_gradient_min`, `lens_gradient_max`, `lens_gradient_increment`, `lens_gradient_decimals`, `lens_gradient_signed`, `lens_gradient_default`, `lens_gradient_blank`) VALUES
(1, 25, 'F', -20, 20, 0.25, 2, 1, '0', 1, -20, 20, 0.25, 2, 1, '0', 1, 0.75, 4, 0.25, 2, 1, '0', 3, 0, 10, 0.25, 2, 1, '0', 1, 0, 180, 1, 0, 0, '90', 1, 12, 25, 1, 0, 0, 0, 1, 35, 70, 1, 0, 0, 0, 1, 20, 40, 1, 0, 0, '30', 1, 115, 165, 5, 0, 0, '0', 1, 10, 40, 1, 0, 0, '20', 1, 34, 70, 1, 0, 0, '', 1, 20, 50, 1, 0, 0, '', 1, 34, 75, 1, 0, 0, '', 1, 10, 80, 10, 0, 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `state_abbr` varchar(2) NOT NULL,
  `state` varchar(50) NOT NULL,
  PRIMARY KEY  (`state_abbr`),
  KEY `state_abbr` (`state_abbr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`state_abbr`, `state`) VALUES
('AK', 'ALASKA'),
('AL', 'ALABAMA'),
('AR', 'ARKANSAS'),
('AZ', 'ARIZONA'),
('CA', 'CALIFORNIA'),
('CO', 'COLORADO'),
('CT', 'CONNECTICUT'),
('DC', 'DISTRICT OF COLUMBIA'),
('DE', 'DELAWARE'),
('FL', 'FLORIDA'),
('GA', 'GEORGIA'),
('HI', 'HAWAII'),
('IA', 'IOWA'),
('ID', 'IDAHO'),
('IL', 'ILLINOIS'),
('IN', 'INDIANA'),
('KS', 'KANSAS'),
('KY', 'KENTUCKY'),
('LA', 'LOUISIANA'),
('MA', 'MASSACHUSETTS'),
('MD', 'MARYLAND'),
('ME', 'MAINE'),
('MI', 'MICHIGAN'),
('MN', 'MINNESOTA'),
('MO', 'MISSOURI'),
('MS', 'MISSISSIPPI'),
('MT', 'MONTANA'),
('NC', 'NORTH CAROLINA'),
('ND', 'NORTH DAKOTA'),
('NE', 'NEBRASKA'),
('NH', 'NEW HAMPSHIRE'),
('NJ', 'NEW JERSEY'),
('NM', 'NEW MEXICO'),
('NV', 'NEVADA'),
('NY', 'NEW YORK'),
('OH', 'OHIO'),
('OK', 'OKLAHOMA'),
('OR', 'OREGON'),
('PA', 'PENNSYLVANIA'),
('RI', 'RHODE ISLAND'),
('SC', 'SOUTH CAROLINA'),
('SD', 'SOUTH DAKOTA'),
('TN', 'TENNESSEE'),
('TX', 'TEXAS'),
('UT', 'UTAH'),
('VA', 'VIRGINIA'),
('VT', 'VERMONT'),
('WA', 'WASHINGTON'),
('WI', 'WISCONSIN'),
('WV', 'WEST VIRGINIA'),
('WY', 'WYOMING');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE IF NOT EXISTS `stores` (
  `store_id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `manager` int(6) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `division` varchar(25) default NULL,
  PRIMARY KEY  (`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`store_id`, `name`, `phone`, `manager`, `email`, `address`, `city`, `state`, `zip`, `division`) VALUES
('11vogueingersoll', 'Ingersoll Vogue', '', 0, 'ingersollvogue@realopticsinc.com', '2405 Ingersoll Ave.', 'Des Moines', 'IA', '50312', NULL),
('12younkersvalleywest', 'Younkers Vision - Valley West Mall', '', 0, '', '', 'West Des Moines', 'IA', '', NULL),
('14voguekaliedescope', 'Kaliedescope Vogue', '', 0, 'kscope@realopticsinc.com', '', 'Des Moines', 'IA', '', NULL),
('16voguehickman', 'Hickman Vogue', '', 0, 'hickman@realopticsinc.com', '', 'Urbandale', 'IA', '', NULL),
('17vogueames', 'Ames Vogue', 'n/a', 0, 'n/a', 'n/a', 'Ames', 'IA', 'n/a', NULL),
('18winterset', 'Winterset', '', 0, '', '', 'Winterset', 'IA', '', NULL),
('19voguecarroll', 'Carroll Vogue Vision', '', 0, '', '', '', '', '', NULL),
('21vogueindianhills', 'Vogue Indian Hills', '', 0, '', '', 'West Des Moines', 'IA', '', NULL),
('23eyemartsouth', 'South Eyemart', 'n/a', 0, 'n/a', 'n/a', 'Des Moines', 'IA', 'n/a', NULL),
('24vogueleetown', 'Leetown Vogue', '', 0, '', '', 'Des Moines', 'IA', '50317', NULL),
('25younkersmerlehay', 'Merle Hay', '', 0, '', '', 'Des Moines', 'IA', '', NULL),
('30eyemartnorth', 'North Eyemart', 'n/a', 0, 'n/a', 'n/a', 'Des Moines', 'IA', 'n/a', NULL),
('31vogueindianola', 'Indianola', '', 0, '', '', '', '', '', NULL),
('33eyemartankeny', 'Ankeny', 'n/a', 0, 'n/a', 'n/a', 'Ankeny', 'IA', 'n/a', NULL),
('34onehour', 'One Hour', '', 0, '', '', '', '', '', NULL),
('35ottumwa', 'Ottumwa', '', 0, '', '', 'Ottumwa', 'IA', '', NULL),
('36FtDodge', 'Ft. Dodge', '', 0, '', '', 'Ft. Dodge', 'IA', '', NULL),
('37eyemartames', 'Ames Eye Mart', '', 0, '', '', '', '', '', NULL),
('39eyemartwaterloo', 'Waterloo', '', 0, '', '', '', '', '', NULL),
('40eyemartmasoncity', 'Mason City', '', 0, '', '', 'Mason City', 'IA', '', NULL),
('42eyemartcr', 'Cedar Rapids Eyemart', '', 0, '', '', 'Cedar Rapids', 'IA', '', NULL),
('Undefined', 'Undefined - Store needs set', 'n/a', 0, 'n/a', 'n/a', 'n/a', 'n/', 'n/a', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE IF NOT EXISTS `temp` (
  `client_id` int(6) unsigned NOT NULL auto_increment,
  `doctor_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `firstname` varchar(50) default NULL,
  `lastname` varchar(50) default NULL,
  `address` varchar(100) default NULL,
  `address2` varchar(100) default NULL,
  `city` varchar(50) default NULL,
  `state` varchar(2) default NULL,
  `zip` varchar(10) default NULL,
  `email` varchar(100) default NULL,
  `phone` varchar(12) default NULL,
  `phone2` varchar(12) default NULL,
  `phone3` varchar(12) default NULL,
  `examtype` varchar(10) default NULL,
  `recalldate` date NOT NULL default '0000-00-00',
  `examdate` date NOT NULL default '0000-00-00',
  `examdue` date NOT NULL default '0000-00-00',
  `lastcontact` date default NULL,
  `clientstatus` tinyint(1) NOT NULL default '1',
  `dob` date default '1900-01-01',
  `insurance` varchar(255) default NULL,
  `insurance_id` varchar(50) default NULL,
  `notes` varchar(1024) default NULL,
  `lastpurchasedate` date default NULL,
  `lastpurchaseamount` float(8,2) default NULL,
  PRIMARY KEY  (`client_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38669 ;

--
-- Dumping data for table `temp`
--


-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `user_id` int(11) NOT NULL,
  `client_id` varchar(100) NOT NULL,
  `store_id` varchar(50) NOT NULL,
  `doctor_id` varchar(50) NOT NULL,
  `timestamp` datetime NOT NULL,
  `trans_id` varchar(25) NOT NULL default '',
  `Detail1` varchar(254) default NULL,
  `Detail2` varchar(254) default NULL,
  `examtype` varchar(10) default 'Glasses',
  PRIMARY KEY  (`trans_id`),
  KEY `user_id` (`user_id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `store_id` (`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--


-- --------------------------------------------------------

--
-- Table structure for table `transcodes`
--

CREATE TABLE IF NOT EXISTS `transcodes` (
  `trans_id` varchar(25) NOT NULL,
  `description` varchar(255) default NULL,
  PRIMARY KEY  (`trans_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transcodes`
--

INSERT INTO `transcodes` (`trans_id`, `description`) VALUES
('appt.cancelled', 'Cancelled appointment'),
('appt.scheduled', 'Scheduled Appointment'),
('contact.phone', 'Phone contact'),
('contact.recallreturned', 'Recall card returned undeliverable'),
('contact.visit', 'Visited store'),
('exam', 'Eye Exam'),
('purchase', 'Purchased merchandise'),
('recall', 'Recall card sent');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `role_id` int(11) NOT NULL default '1',
  `username` varchar(25) collate utf8_bin NOT NULL,
  `password` varchar(34) collate utf8_bin NOT NULL,
  `email` varchar(100) collate utf8_bin NOT NULL,
  `banned` tinyint(1) NOT NULL default '0',
  `ban_reason` varchar(255) collate utf8_bin default NULL,
  `newpass` varchar(34) collate utf8_bin default NULL,
  `newpass_key` varchar(32) collate utf8_bin default NULL,
  `newpass_time` datetime default NULL,
  `last_ip` varchar(40) collate utf8_bin NOT NULL,
  `last_login` datetime NOT NULL default '0000-00-00 00:00:00',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `store_id` varchar(50) character set latin1 NOT NULL,
  `active` tinyint(4) NOT NULL default '1',
  `dispencer_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `store_id` (`store_id`),
  KEY `username` (`username`),
  KEY `username_2` (`username`),
  KEY `username_3` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=78 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `email`, `banned`, `ban_reason`, `newpass`, `newpass_key`, `newpass_time`, `last_ip`, `last_login`, `created`, `modified`, `store_id`, `active`, `dispencer_id`) VALUES
(1, 2, 'admin', '$1$LG21kfrQ$NfEF9gVTiCntCDvW5X4nU.', 'webmaster@realopticsinc.com', 1, NULL, '', '', '2009-10-23 12:06:26', '75.170.193.148', '2009-10-09 16:45:16', '2008-11-30 04:56:32', '2010-09-16 11:01:12', 'undefined', 1, 4567),
(4, 2, 'doug', '$1$U5edNOVT$Mw3iq8H.RwaSbGg3k81.m1', 'doughesseltine@gmail.com', 0, NULL, NULL, NULL, NULL, '173.17.59.160', '2011-04-14 21:57:47', '2009-07-19 02:16:31', '2011-04-14 21:57:47', '34onehour', 1, 1234),
(16, 2, 'chrisnpg', '$1$ct0icAr.$jyd.HnYxtwwuUC/4qSi21/', 'chrisnpg@gmail.com', 0, NULL, NULL, NULL, NULL, '173.27.215.227', '2010-10-03 12:35:40', '2009-09-14 11:08:22', '2011-02-28 20:48:34', '37eyemartames', 0, 5678),
(61, 2, 'patf', '$1$/UxaFQYb$B4nfgP9iinsdPu0BF7/Tn/', 'farrell.patrick.o@gmail.com', 0, NULL, NULL, NULL, NULL, '173.20.230.165', '2010-12-13 13:48:02', '2010-01-18 13:07:43', '2010-12-13 13:48:02', '34onehour', 1, 333),
(74, 1, 'manas', '$1$t73.yi0.$V/LMxMi9OsM9KExFY3h8H/', 'manas.sust@gmail.com', 0, NULL, NULL, NULL, NULL, '119.30.38.87', '2011-04-07 19:00:02', '2010-09-16 02:33:24', '2011-04-07 19:00:02', '42eyemartcr', 0, 8901),
(76, 1, 'demo', '$1$cTX8xfWH$kIbov4YZxu1MeV7..bZOK0', 'doughesseltine+demo@gmail.com', 0, NULL, NULL, NULL, NULL, '184.59.24.58', '2011-04-01 15:50:11', '2011-02-28 20:48:55', '2011-04-14 21:35:13', '37eyemartames', 0, NULL),
(77, 1, 'albert', '$1$x26aFAm4$fmhO2MrsPxeLQykC3IR9B1', 'albertmaranian@gmail.com', 0, NULL, NULL, NULL, NULL, '125.60.240.196', '2011-04-14 22:32:29', '2011-04-14 22:29:02', '2011-04-14 22:32:29', '37eyemartames', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_autologin`
--

CREATE TABLE IF NOT EXISTS `user_autologin` (
  `key_id` char(32) collate utf8_bin NOT NULL,
  `user_id` mediumint(8) NOT NULL default '0',
  `user_agent` varchar(150) collate utf8_bin NOT NULL,
  `last_ip` varchar(40) collate utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user_autologin`
--

INSERT INTO `user_autologin` (`key_id`, `user_id`, `user_agent`, `last_ip`, `last_login`) VALUES
('001c06a4f307d6ad78ab21ab8a6c6866', 47, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.7) Gecko/20091221 Firefox/3.5.7', '65.101.164.209', '2010-02-10 16:02:16'),
('031285f92b67465d3cb922e22103e4cc', 67, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; FunWebProducts; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30', '75.221.103.105', '2010-05-04 19:39:55'),
('09843c9aef6a73af1b67121d9c440736', 39, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; GTB6.4; .NET CLR 2.0.50727; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729)', '75.167.127.177', '2010-03-11 00:05:43'),
('16dd67f51f99fa138c9453de5956bf61', 55, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2.2) Gecko/20100316 Firefox/3.6.2 (.NET CLR 3.5.30729)', '71.214.254.145', '2010-04-02 16:27:58'),
('19fc2d2425a814d54e8a4db933c3ba97', 47, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3', '67.41.106.27', '2010-04-30 15:17:01'),
('276cdeb32765491a66aa6a3e8626e1de', 47, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.7) Gecko/20091221 Firefox/3.5.7', '67.41.242.20', '2010-01-18 16:19:11'),
('27c1cd126e87b928c89ce5d80edf9c48', 64, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729; As', '97.127.139.114', '2010-03-01 17:13:29'),
('28efe234d04ca765cac571a6b01637d4', 61, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; WOW64; Trident/4.0; SLCC1; .NET CLR 2.0.50727; Media Center PC 5.0; .NET CLR 3.5.21022; .NET CLR 3', '75.162.9.11', '2010-05-24 15:36:30'),
('2ef7688c75f8a7d14e3038373f32951b', 47, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3 ( .NET CLR 3.5.30729)', '65.101.173.78', '2010-06-18 16:04:32'),
('3668a40f4ebbc0ad5ecdce86e75121bb', 61, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; WOW64; Trident/4.0; SLCC1; .NET CLR 2.0.50727; Media Center PC 5.0; .NET CLR 3.5.21022; .NET CLR 3', '174.30.99.177', '2010-10-06 15:10:50'),
('3a3ce14d9301b74a3cdb1713646ff5b1', 76, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; InfoPath.2; .NET CLR 2.0.50727; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729; .NET4.0C; .NET4.0E; MS', '12.52.96.239', '2011-03-09 14:54:32'),
('3d67f5756a23f5484dbd19dfbc4c9bd1', 61, 'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.2.9) Gecko/20100824 Firefox/3.6.9 ( .NET CLR 3.5.30729; .NET4.0C)', '174.30.99.177', '2010-10-07 15:57:39'),
('3e552a4b71a25bee6bdd7ef58b01fd81', 47, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2.2) Gecko/20100316 Firefox/3.6.2', '71.32.164.218', '2010-03-26 22:02:17'),
('41b5513cd66aa653c045f66d77b160cf', 61, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; WOW64; Trident/4.0; SLCC1; .NET CLR 2.0.50727; Media Center PC 5.0; .NET CLR 3.5.21022; .NET CLR 3', '174.30.94.43', '2010-10-15 11:08:48'),
('4b345a6fc86acac47918064d43d7e9d4', 4, 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_5; en-US) AppleWebKit/534.7 (KHTML, like Gecko) RockMelt/0.8.36.116 Chrome/7.0.517.44 Safari/534.7', '173.17.58.30', '2010-12-13 13:25:03'),
('4c39d4feeb775860eb43c0afa95bd8de', 20, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Trident/4.0; .NET CLR 1.1.4322)', '71.214.210.95', '2010-05-22 18:56:37'),
('4dbcee93d6c930920b0db3aa521b2c2c', 4, 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.70 Safari/533.4', '173.17.58.30', '2010-06-28 02:42:21'),
('559e81ce5a7d89ec1ccb19f1359b6e21', 17, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; WOW64; Trident/4.0; SLCC1; .NET CLR 2.0.50727; Media Center PC 5.0; .NET CLR 3.5.21022; .NET CLR 3', '75.162.24.150', '2009-11-17 22:18:41'),
('57ca33b8df9f885cc3928189983b6369', 39, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; GTB6.4; .NET CLR 2.0.50727; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729)', '75.167.127.132', '2010-06-01 20:45:07'),
('5c3e9670956f0c48764ac4d51996899e', 61, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0; FunWebProducts; SLCC1; .NET CLR 2.0.50727; Media Center PC 5.0; .NET CLR 3.5.30729; .', '174.30.94.43', '2010-10-15 12:48:22'),
('5e53c77c38a4f7977f4809f5b4c8f24d', 64, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; .NET CLR 1.1.4322)', '97.127.137.228', '2010-02-18 20:04:55'),
('686cda0f28013fec51c563f242a50d1e', 39, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; GTB6.4; .NET CLR 2.0.50727; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729)', '75.167.127.132', '2010-04-20 20:42:39'),
('6b5825522d2a7be1a315fcb16ffba3e6', 72, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2) Gecko/20100115 Firefox/3.6 GTB7.1', '113.199.220.65', '2010-09-14 06:04:56'),
('6c9cb7d780b7d8dc7940f920b99d2233', 47, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2.2) Gecko/20100316 Firefox/3.6.2', '67.41.106.236', '2010-04-02 15:50:11'),
('70ac827e845055bc6a0c436dd872914c', 25, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; .NET CLR 1.1.4322)', '75.170.159.63', '2010-05-18 14:28:51'),
('720f49d76396ea5c7329eeb8c8590bb4', 47, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2) Gecko/20100115 Firefox/3.6', '71.32.164.218', '2010-03-23 16:43:15'),
('750fe854dcd3255b215193301b0a1f03', 47, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.8) Gecko/20100202 Firefox/3.5.8', '71.34.176.11', '2010-03-04 21:25:36'),
('7f3a345cd8f57e783e2c1a8220ca099b', 62, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; GTB6.3; .NET CLR 1.1.4322)', '67.41.105.122', '2010-01-20 17:47:10'),
('8299ae682565b05248da4f1c424d912c', 35, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; .NET CLR 1.1.4322)', '71.38.171.103', '2009-11-04 22:14:10'),
('86ebcf5c590648c4554a6414e242fdbb', 67, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; GTB6.3; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Med', '65.123.182.76', '2010-04-20 22:46:26'),
('8c0e48e8649f7de7a7e67fcd3e41c9c3', 67, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Cente', '75.220.245.88', '2010-03-08 16:46:09'),
('8f79b5042f943d40d2b212b6f0c63d95', 48, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.5) Gecko/20091102 Firefox/3.5.5', '67.41.63.21', '2009-12-08 15:16:35'),
('962547c01a3be85e54ae85ac0daac660', 47, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2.4) Gecko/20100611 Firefox/3.6.4 ( .NET CLR 3.5.30729)', '70.58.182.75', '2010-06-25 15:04:04'),
('9b29c73dfb5ba952dea6cc243a296ade', 55, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; GTB6.4; .NET CLR 1.1.4322; IEMB3; IEMB3)', '71.214.254.145', '2010-04-12 18:39:05'),
('9f8e3105e9bc95e754ebf2cf6482f677', 61, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; WOW64; Trident/4.0; SLCC1; .NET CLR 2.0.50727; Media Center PC 5.0; .NET CLR 3.5.21022; .NET CLR 3', '173.20.230.165', '2010-12-13 13:07:25'),
('a38216d31b79eadf519dac039947db4b', 72, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/534.3 (KHTML, like Gecko) Chrome/6.0.472.55 Safari/534.3', '113.199.220.65', '2010-09-14 05:32:56'),
('a6bf86dbff0b9f24d7bcfadb6719c207', 47, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.8) Gecko/20100202 Firefox/3.5.8', '71.32.164.218', '2010-03-12 15:48:46'),
('aef7711cd48434396662e20a3c26737c', 20, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Trident/4.0; .NET CLR 1.1.4322)', '71.214.237.187', '2010-04-06 21:22:58'),
('b26f3af7fc0c9304db55ea8129069e08', 61, 'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.2.10) Gecko/20100914 Firefox/3.6.10 ( .NET CLR 3.5.30729; .NET4.0C)', '173.20.230.165', '2010-12-13 13:48:02'),
('c3c17a938ce029d1b55c5c33a8fe4fe0', 35, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; .NET CLR 1.1.4322)', '71.214.221.233', '2009-12-04 18:37:27'),
('c7ab03eeef7ba1afdf33b9f4989b99cb', 47, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3', '174.30.83.68', '2010-05-21 17:06:44'),
('c9c3bb042d9ac93c1977ff580ef65123', 25, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; .NET CLR 1.1.4322)', '75.170.157.1', '2010-03-09 21:09:37'),
('d04d773ba941430a20d787c3fdc32d81', 47, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3', '71.32.161.231', '2010-05-10 18:08:59'),
('d3213af345ac3c41327faf9e3c0fd614', 39, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729)', '75.167.127.177', '2010-03-18 21:38:25'),
('d41a6128390a36bbf253708db392ffbc', 61, 'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 ( .NET CLR 3.5.30729; .NET4.0C)', '174.30.99.177', '2010-09-20 10:55:34'),
('d6e28500e1fdacc5e9b3451eadc8b802', 4, 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; en-us) AppleWebKit/533.18.1 (KHTML, like Gecko) Version/5.0.2 Safari/533.18.5', '173.17.58.30', '2010-10-20 07:19:54'),
('d8cb6deff2cad8d9b753cb9f36dc14e3', 17, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; WOW64; Trident/4.0; SLCC1; .NET CLR 2.0.50727; Media Center PC 5.0; .NET CLR 3.5.21022; .NET CLR 3', '75.162.30.71', '2009-12-28 21:48:19'),
('e3ca00d525260beb9fa3c2f64bc730b6', 72, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/534.3 (KHTML, like Gecko) Chrome/6.0.472.55 Safari/534.3', '113.199.158.73', '2010-09-14 23:51:08'),
('e8b650ac80b75c03d3227dd4a959c771', 4, 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.6; en-US; rv:1.9.1.7) Gecko/20091221 Firefox/3.5.7', '173.17.58.30', '2010-10-07 14:22:55'),
('f384035ee0f039b90e319e105324ad3d', 67, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; FunWebProducts; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30', '65.123.182.76', '2010-04-20 22:47:01'),
('f3b8c478bc4c58bc4d04536dad174540', 55, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3 (.NET CLR 3.5.30729)', '71.214.254.145', '2010-04-06 17:31:18'),
('f3caab92ac70a21ec8390cb00adcce21', 67, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; FunWebProducts; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30', '75.220.20.70', '2010-04-08 16:15:56'),
('f831ff2a78aff2ec1e18b777880a150d', 47, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6', '67.41.242.224', '2010-01-05 17:27:34');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE IF NOT EXISTS `user_profile` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) collate utf8_bin default NULL,
  `website` varchar(255) collate utf8_bin default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=75 ;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_id`, `country`, `website`) VALUES
(71, 74, NULL, NULL),
(72, 75, NULL, NULL),
(73, 76, NULL, NULL),
(74, 77, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_temp`
--

CREATE TABLE IF NOT EXISTS `user_temp` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(255) collate utf8_bin NOT NULL,
  `password` varchar(34) collate utf8_bin NOT NULL,
  `email` varchar(100) collate utf8_bin NOT NULL,
  `activation_key` varchar(50) collate utf8_bin NOT NULL,
  `last_ip` varchar(40) collate utf8_bin NOT NULL,
  `created` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user_temp`
--

INSERT INTO `user_temp` (`id`, `username`, `password`, `email`, `activation_key`, `last_ip`, `created`, `store_id`) VALUES
(1, 'temp1', '$1$065X6lX7$A8eUDtN7CtoWC0.ejGf.9/', 'temp1@email.com', 'b7b04502f20f6977db1a31dc091316ff', '216.81.180.225', '2010-04-26 17:39:46', 0),
(2, 'temp2', '$1$U5DIrRLQ$.UBe05nEfLceCJFiAx6ZR/', 'temp2@email.com', 'ca378932fe79765e3cbd03647bee4bbf', '216.81.180.225', '2010-04-26 17:40:14', 0),
(3, 'temp3', '$1$qhn51Arf$9ELSIG6gG70ChJ3btP3yb.', 'temp3@email.com', '7a07733706a231422db5bfc779d5b47f', '216.81.180.225', '2010-04-26 17:41:02', 0),
(4, 'temp4', '$1$K8ASNjyz$SN2kEmGbW6vvgaL5.itMs0', 'temp4@email.com', '9282a619746a8493aaf93072c70221e2', '216.81.180.225', '2010-04-26 17:41:27', 0),
(5, 'temp5', '$1$ABiipZ20$L3XL77etKPyueEgqkKDmg0', 'temp5@email.com', '40159714e114db68c150e94f4bc4f5b1', '216.81.180.225', '2010-04-26 17:41:54', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`carrier`) REFERENCES `list_carriers` (`carrier`);

--
-- Constraints for table `frames`
--
ALTER TABLE `frames`
  ADD CONSTRAINT `frames_ibfk_1` FOREIGN KEY (`division_id`) REFERENCES `frame_divisions` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `frame_divisions`
--
ALTER TABLE `frame_divisions`
  ADD CONSTRAINT `frame_divisions_ibfk_1` FOREIGN KEY (`manufacturer_id`) REFERENCES `frame_manufacturers` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `frame_inventory`
--
ALTER TABLE `frame_inventory`
  ADD CONSTRAINT `frame_inventory_ibfk_1` FOREIGN KEY (`frame_id`) REFERENCES `frames` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `frame_inventory_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `stores` (`store_id`) ON UPDATE CASCADE;

--
-- Constraints for table `insurance`
--
ALTER TABLE `insurance`
  ADD CONSTRAINT `insurance_ibfk_1` FOREIGN KEY (`carrier`) REFERENCES `list_carriers` (`carrier`) ON UPDATE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON UPDATE CASCADE;

--
-- Constraints for table `ledger`
--
ALTER TABLE `ledger`
  ADD CONSTRAINT `ledger_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON UPDATE CASCADE;

--
-- Constraints for table `lens_brands`
--
ALTER TABLE `lens_brands`
  ADD CONSTRAINT `lens_brands_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `lens_types` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `lens_designs`
--
ALTER TABLE `lens_designs`
  ADD CONSTRAINT `lens_designs_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `lens_brands` (`type_id`) ON UPDATE CASCADE;

--
-- Constraints for table `lens_materials`
--
ALTER TABLE `lens_materials`
  ADD CONSTRAINT `lens_materials_ibfk_1` FOREIGN KEY (`design_id`) REFERENCES `lens_designs` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `marketing`
--
ALTER TABLE `marketing`
  ADD CONSTRAINT `marketing_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `marketing_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`remake_reason`) REFERENCES `list_remake_reasons` (`reason`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_11` FOREIGN KEY (`treatment_id`) REFERENCES `lens_treatments` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_12` FOREIGN KEY (`coating_id`) REFERENCES `lens_coatings` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`store_id`) REFERENCES `stores` (`store_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_5` FOREIGN KEY (`order_type`) REFERENCES `list_order_type` (`order_type`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_6` FOREIGN KEY (`frame_id`) REFERENCES `frames` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_7` FOREIGN KEY (`diag_code`) REFERENCES `list_diag_codes` (`diag_code`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_8` FOREIGN KEY (`type_id`) REFERENCES `lens_types` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `orders_treatments`
--
ALTER TABLE `orders_treatments`
  ADD CONSTRAINT `orders_treatments_ibfk_1` FOREIGN KEY (`treatment_id`) REFERENCES `lens_treatments` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_treatments_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON UPDATE CASCADE;
