-- phpMyAdmin SQL Dump
-- version 4.4.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 09, 2017 at 05:31 PM
-- Server version: 10.0.19-MariaDB-1~trusty-log
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/ `web_programming_db` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `web_programming_db`;
--
-- Database: `web-programming_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `display_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`, `user_name`, `display_name`) VALUES
('cmuth001@odu.edu', '@cmuth001', 'chandu_muthyala', 'chandu_muthyala'),
('npabb001@odu.edu', 'Neutral@123', 'vamsi', 'vamsi'),
('skand001@odu.edu', 'She3ple!', 'yashkandukuri', 'whaike');

-- --------------------------------------------------------

--
-- Table structure for table `channels`
--

CREATE TABLE IF NOT EXISTS `channels` (
  `channel_id` int(20) NOT NULL,
  `channel_name` varchar(200) NOT NULL,
  `purpose` varchar(500) NOT NULL,
  `created_by_user_email` varchar(50) NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `access_specifiers` tinyint(1) NOT NULL DEFAULT '0',
  `isArchive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `channels`
--

INSERT INTO `channels` (`channel_id`, `channel_name`, `purpose`, `created_by_user_email`, `createdon`, `access_specifiers`, `isArchive`) VALUES
(1, 'general', 'all general messages', 'cmuth001@odu.edu', '2017-12-09 01:56:45', 0, 0),
(2, 'random', 'random messages', 'cmuth001@odu.edu', '2017-11-24 19:49:27', 0, 0),
(64, 'privateChannel', 'testing....', 'cmuth001@odu.edu', '2017-12-05 05:59:56', 1, 0),
(66, 'public channel testi', 'testing 1', 'npabb001@odu.edu', '2017-11-02 11:23:54', 0, 0),
(67, 'new private channel-2', 'testing new private channel-2', 'mater@rsprings.gov', '2017-11-05 08:12:20', 1, 0),
(72, 'newpaginationChannel', '', 'mater@rsprings.gov', '2017-11-23 19:45:39', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `channel_messages`
--

CREATE TABLE IF NOT EXISTS `channel_messages` (
  `cmessage_id` int(10) NOT NULL,
  `channel_id` int(10) NOT NULL,
  `cuser_email` varchar(20) CHARACTER SET latin1 NOT NULL,
  `channel_message` text CHARACTER SET latin1 NOT NULL,
  `has_thread` tinyint(4) NOT NULL DEFAULT '0',
  `textOrCode` tinyint(1) NOT NULL DEFAULT '0',
  `cmsg_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `channel_messages`
--

INSERT INTO `channel_messages` (`cmessage_id`, `channel_id`, `cuser_email`, `channel_message`, `has_thread`, `textOrCode`, `cmsg_timestamp`) VALUES
(4, 1, 'mater@rsprings.gov', '1', 1, 0, '2017-11-23 19:33:51'),
(5, 1, 'mater@rsprings.gov', '2', 0, 0, '2017-11-22 23:14:21'),
(6, 1, 'mater@rsprings.gov', '3', 0, 0, '2017-11-22 23:14:24'),
(7, 1, 'mater@rsprings.gov', '4', 0, 0, '2017-11-22 23:14:26'),
(8, 1, 'mater@rsprings.gov', '5', 0, 0, '2017-11-22 23:14:28'),
(9, 1, 'mater@rsprings.gov', '6', 0, 0, '2017-11-22 23:14:30'),
(10, 1, 'mater@rsprings.gov', '7', 0, 0, '2017-11-22 23:14:31'),
(11, 1, 'mater@rsprings.gov', '8', 0, 0, '2017-11-22 23:14:34'),
(12, 1, 'mater@rsprings.gov', '9', 0, 0, '2017-11-22 23:14:35'),
(13, 1, 'mater@rsprings.gov', '10', 0, 0, '2017-11-22 23:14:39'),
(14, 1, 'mater@rsprings.gov', '11', 0, 0, '2017-11-22 23:14:45'),
(15, 1, 'mater@rsprings.gov', '12', 0, 0, '2017-11-22 23:14:47'),
(16, 1, 'mater@rsprings.gov', '13', 0, 0, '2017-11-22 23:14:49'),
(17, 1, 'mater@rsprings.gov', '14', 0, 0, '2017-11-22 23:14:51'),
(18, 1, 'mater@rsprings.gov', '15', 0, 0, '2017-11-22 23:14:54'),
(19, 1, 'mater@rsprings.gov', '16', 1, 0, '2017-11-26 05:15:20'),
(20, 1, 'mater@rsprings.gov', '17', 0, 0, '2017-11-22 23:14:58'),
(21, 1, 'mater@rsprings.gov', '18', 1, 0, '2017-11-23 03:03:33'),
(22, 1, 'mater@rsprings.gov', '19', 0, 0, '2017-11-22 23:15:03'),
(23, 1, 'mater@rsprings.gov', '20', 1, 0, '2017-11-30 17:07:34'),
(24, 1, 'mater@rsprings.gov', '21', 0, 0, '2017-11-22 23:28:24'),
(25, 1, 'mater@rsprings.gov', '22', 1, 0, '2017-11-23 03:55:17'),
(28, 1, 'mater@rsprings.gov', '23', 0, 0, '2017-11-22 23:57:38'),
(29, 1, 'mater@rsprings.gov', '24', 0, 0, '2017-11-22 23:58:05'),
(30, 1, 'mater@rsprings.gov', '25', 1, 0, '2017-11-23 03:48:04'),
(32, 64, 'mater@rsprings.gov', 'p2', 0, 0, '2017-11-23 00:37:55'),
(33, 64, 'mater@rsprings.gov', 'p3', 0, 0, '2017-11-23 00:37:58'),
(34, 64, 'mater@rsprings.gov', 'p4', 0, 0, '2017-11-23 00:38:00'),
(35, 64, 'mater@rsprings.gov', 'p5', 0, 0, '2017-11-23 00:38:05'),
(36, 64, 'mater@rsprings.gov', 'p6', 0, 0, '2017-11-23 00:38:08'),
(37, 64, 'mater@rsprings.gov', 'p7', 0, 0, '2017-11-23 00:38:12'),
(38, 64, 'mater@rsprings.gov', 'p7', 0, 0, '2017-11-23 00:38:15'),
(39, 64, 'mater@rsprings.gov', 'p9', 0, 0, '2017-11-23 00:38:20'),
(40, 64, 'mater@rsprings.gov', 'p10', 0, 0, '2017-11-23 00:38:24'),
(41, 1, 'mater@rsprings.gov', '$admin = admin();\r\n$ThreadContainer='''';', 1, 1, '2017-11-24 20:34:27'),
(42, 1, 'mater@rsprings.gov', '', 1, 3, '2017-11-26 05:10:25'),
(44, 1, 'mater@rsprings.gov', 'okay', 1, 0, '2017-11-23 03:36:31'),
(45, 1, 'mater@rsprings.gov', '.profile-pic1 {     max-width: 200px;     max-height: 200px;     display: block; } .file-upload {     display: none; } /*end of Image upload css*/ .channelMembersLink{ 	padding-right: 5px !important; 	padding-left: 10px !important; } .channelMembersUl{ 	margin-left: 7%; 	overflow-y: auto;     height: 450%; } .helpPage{ 	position: absolute; 	z-index: 100; 	margin-top: 30%; }  #threadContainer{ 	border-radius: 0px; } .threadHeading{ 	border-radius: 0px !important; 	padding-top: 5% !important; 	padding-bottom: 5% !important; } .thread_wrapper{ 	height: 64%;     overflow-y: auto; } .rightThread{ 	margin-left: 0px;    padding: 5px 5px;   background-color: white;   /*border-radius: 10px;*/      } #threadContainerBody{ 	padding: 0px; }', 1, 0, '2017-11-23 03:54:03'),
(46, 1, 'mater@rsprings.gov', '.profile-pic1 {\r\n    max-width: 200px;\r\n    max-height: 200px;\r\n    display: block;\r\n}\r\n.file-upload {\r\n    display: none;\r\n}\r\n/*end of Image upload css*/\r\n.channelMembersLink{\r\n	padding-right: 5px !important;\r\n	padding-left: 10px !important;\r\n}\r\n.channelMembersUl{\r\n	margin-left: 7%;\r\n	overflow-y: auto;\r\n    height: 450%;\r\n}\r\n.helpPage{\r\n	position: absolute;\r\n	z-index: 100;\r\n	margin-top: 30%;\r\n}\r\n\r\n#threadContainer{\r\n	border-radius: 0px;\r\n}\r\n.threadHeading{\r\n	border-radius: 0px !important;\r\n	padding-top: 5% !important;\r\n	padding-bottom: 5% !important;\r\n}\r\n.thread_wrapper{\r\n	height: 64%;\r\n    overflow-y: auto;\r\n}\r\n.rightThread{\r\n	margin-left: 0px; \r\n  padding: 5px 5px;\r\n  background-color: white;\r\n  /*border-radius: 10px;*/\r\n    \r\n}\r\n#threadContainerBody{\r\n	padding: 0px;\r\n}', 1, 1, '2017-11-26 05:19:21'),
(47, 1, 'mater@rsprings.gov', '', 1, 3, '2017-11-23 03:56:32'),
(48, 1, 'mater@rsprings.gov', 'https://i.pinimg.com/736x/70/32/bb/7032bbee082daf62708332df63af9c5b--two-hearts-sweet-hearts.jpg', 1, 2, '2017-12-01 02:17:03'),
(49, 1, 'mater@rsprings.gov', '', 1, 3, '2017-12-01 06:19:25'),
(50, 1, 'mater@rsprings.gov', '.textMessage{\r\n  margin-left: 55px;\r\n  font-family: "Comic Sans MS", cursive, sans-serif;\r\n  word-wrap: break-word;\r\n}', 0, 1, '2017-11-23 19:35:13'),
(52, 1, 'cmuth001@odu.edu', 'zxcv', 0, 0, '2017-11-24 20:09:22'),
(53, 1, 'mater@rsprings.gov', ' https://vignette.wikia.nocookie.net/disney/images/c/c0/Mack.png', 0, 2, '2017-11-26 06:33:08'),
(55, 1, 'mater@rsprings.gov', ' https://vignette.wikia.nocookie.net/disney/images/c/c0/Mack.png/revision/latest?cb=20151213154902', 0, 0, '2017-11-29 08:20:47'),
(59, 1, 'chinga@cars.com', 'oik', 0, 0, '2017-11-30 15:34:06'),
(60, 1, 'skand001@odu.edu', 'testing', 0, 0, '2017-11-30 19:50:13'),
(63, 66, 'npabb001@odu.edu', 'Yo', 0, 0, '2017-12-01 18:29:41'),
(64, 2, 'npabb001@odu.edu', 'Lets rock', 1, 0, '2017-12-08 00:39:27'),
(65, 1, 'cmuth001@odu.edu', '', 0, 3, '2017-12-05 07:06:15'),
(66, 1, 'cmuth001@odu.edu', 'https://vignette.wikia.nocookie.net/disney/images/c/c0/Mack.png/revision/latest?cb=20151213154902', 0, 0, '2017-12-05 07:48:48'),
(67, 1, 'cmuth001@odu.edu', 'https://vignette.wikia.nocookie.net/disney/images/c/c0/Mack.png/revision/latest?cb=20151213154902', 0, 0, '2017-12-05 07:49:49'),
(68, 1, 'cmuth001@odu.edu', 'https://vignette.wikia.nocookie.net/disney/images/c/c0/Mack.png/revision/latest?cb=20151213154902', 0, 2, '2017-12-05 07:50:43'),
(69, 1, 'cmuth001@odu.edu', 'http://www.cs.odu.edu/~jbrunelle/cs518/chick.png', 0, 2, '2017-12-05 07:51:36'),
(70, 1, 'cmuth001@odu.edu', 'https://avatars1.githubusercontent.com/u/31876237?v=4', 0, 2, '2017-12-05 07:59:03'),
(81, 1, 'cmuth001@odu.edu', '', 0, 3, '2017-12-05 16:58:41'),
(83, 1, 'cmuth001@odu.edu', '', 1, 3, '2017-12-08 00:39:06'),
(84, 1, 'cmuth001@odu.edu', '', 0, 3, '2017-12-05 16:59:30'),
(85, 1, 'cmuth001@odu.edu', '', 0, 3, '2017-12-05 16:59:46'),
(86, 1, 'cmuth001@odu.edu', '', 0, 3, '2017-12-05 17:01:21'),
(89, 1, 'cmuth001@odu.edu', '', 0, 3, '2017-12-05 17:17:06'),
(90, 1, 'cmuth001@odu.edu', '', 0, 3, '2017-12-05 17:34:35'),
(91, 1, 'cmuth001@odu.edu', '', 0, 3, '2017-12-05 17:40:40'),
(92, 1, 'cmuth001@odu.edu', '', 0, 3, '2017-12-05 17:41:51'),
(94, 2, 'cmuth001@odu.edu', '', 0, 3, '2017-12-05 19:19:44'),
(96, 1, 'cmuth001@odu.edu', 'https://vignette.wikia.nocookie.net/disney/images/c/c0/Mack.png/revision/latest?cb=20151213154902', 0, 2, '2017-12-05 19:43:06'),
(98, 2, 'cmuth001@odu.edu', 'asdas', 0, 0, '2017-12-08 00:42:49'),
(99, 1, 'a@b.c', 'okay i am in', 0, 0, '2017-12-08 01:07:56'),
(100, 2, 'a@b.c', 'lets party ', 0, 0, '2017-12-08 01:08:07'),
(101, 2, 'a@b.c', 'okay', 0, 0, '2017-12-08 01:14:15'),
(102, 1, 'cmuth001@odu.edu', '', 1, 3, '2017-12-09 16:41:47'),
(103, 2, 'mater@rsprings.gov', 'Assignment-1.docx', 0, 3, '2017-12-09 05:13:29'),
(104, 1, 'mater@rsprings.gov', '', 0, 3, '2017-12-09 05:21:58'),
(105, 1, 'mater@rsprings.gov', '', 0, 3, '2017-12-09 05:23:42'),
(106, 1, 'mater@rsprings.gov', 'Assignment-4.pdf', 0, 3, '2017-12-09 05:26:36'),
(107, 1, 'mater@rsprings.gov', 'Assignment-4.pdf', 0, 4, '2017-12-09 05:27:07'),
(108, 2, 'mater@rsprings.gov', 'Assignment-1.docx', 0, 4, '2017-12-09 05:36:14'),
(109, 2, 'mater@rsprings.gov', '', 0, 3, '2017-12-09 05:36:31'),
(110, 2, 'mater@rsprings.gov', 'https://vignette.wikia.nocookie.net/disney/images/c/c0/Mack.png/revision/latest?cb=20151213154902', 0, 2, '2017-12-09 05:36:42'),
(111, 1, 'mater@rsprings.gov', 'asd.php', 0, 4, '2017-12-09 16:49:39');

-- --------------------------------------------------------

--
-- Table structure for table `channel_message_reaction`
--

CREATE TABLE IF NOT EXISTS `channel_message_reaction` (
  `id` bigint(100) NOT NULL,
  `message_id` int(20) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `emoji_id` bigint(100) NOT NULL DEFAULT '0',
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=564 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `channel_message_reaction`
--

INSERT INTO `channel_message_reaction` (`id`, `message_id`, `user_email`, `emoji_id`, `createdon`) VALUES
(547, 64, 'cmuth001@odu.edu', 1, '2017-12-08 00:42:26'),
(548, 81, 'cmuth001@odu.edu', 1, '2017-12-08 00:42:32'),
(549, 83, 'cmuth001@odu.edu', 1, '2017-12-08 00:42:33'),
(550, 84, 'cmuth001@odu.edu', 1, '2017-12-08 00:42:35'),
(551, 94, 'cmuth001@odu.edu', 1, '2017-12-08 00:42:45'),
(553, 64, 'a@b.c', 1, '2017-12-08 01:08:17'),
(555, 84, 'mater@rsprings.gov', 1, '2017-12-09 03:44:25'),
(556, 64, 'mater@rsprings.gov', 1, '2017-12-09 03:46:16');

-- --------------------------------------------------------

--
-- Table structure for table `direct_message`
--

CREATE TABLE IF NOT EXISTS `direct_message` (
  `directmsg_id` int(10) NOT NULL,
  `from_email` varchar(20) NOT NULL,
  `to_email` varchar(20) NOT NULL,
  `direct_message` varchar(2000) NOT NULL,
  `textOrCode` tinyint(1) NOT NULL DEFAULT '0',
  `dm_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `direct_message`
--

INSERT INTO `direct_message` (`directmsg_id`, `from_email`, `to_email`, `direct_message`, `textOrCode`, `dm_timestamp`) VALUES
(112, 'mater@rsprings.gov', 'a@b.c', 'Assignment-1.docx', 3, '2017-12-09 05:06:18'),
(113, 'mater@rsprings.gov', 'a@b.c', 'Assignment-1.docx', 4, '2017-12-09 05:27:24');

-- --------------------------------------------------------

--
-- Table structure for table `emojis`
--

CREATE TABLE IF NOT EXISTS `emojis` (
  `emoji_id` bigint(100) NOT NULL,
  `unicode` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emojis`
--

INSERT INTO `emojis` (`emoji_id`, `unicode`) VALUES
(1, 'like'),
(2, 'dislike');

-- --------------------------------------------------------

--
-- Table structure for table `gravatar`
--

CREATE TABLE IF NOT EXISTS `gravatar` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `path` varchar(200) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gravatar`
--

INSERT INTO `gravatar` (`id`, `email`, `path`, `timestamp`) VALUES
(1, 'cmuth001@odu.edu', 'https://www.gravatar.com/avatar/6cc9724a530a26f625b93e6d7962bbea', '2017-11-01 04:00:00'),
(4, 'chinga@cars.com', 'https://www.gravatar.com/avatar/2a4237a9a1676a06923482291c63de8f', '2017-11-30 15:36:14'),
(5, 'npabb001@odu.edu', 'https://www.gravatar.com/avatar/3f7a4cd53ba01ed46c816c5cefc5c8db', '2017-11-30 16:01:03');

-- --------------------------------------------------------

--
-- Table structure for table `invite_user`
--

CREATE TABLE IF NOT EXISTS `invite_user` (
  `invite_id` bigint(100) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `channel_id` int(20) NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loginActivityLog`
--

CREATE TABLE IF NOT EXISTS `loginActivityLog` (
  `logId` bigint(255) NOT NULL,
  `logEmail` varchar(50) NOT NULL,
  `LogInTime` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loginActivityLog`
--

INSERT INTO `loginActivityLog` (`logId`, `logEmail`, `LogInTime`) VALUES
(1, 'a@b.c', '2017-12-01 00:00:00'),
(2, 'a@b.c', '2017-12-01 00:00:00'),
(3, 'a@b.c', '2017-12-02 05:00:00'),
(4, 'a@b.c', '2017-12-03 02:00:00'),
(5, 'a@b.c', '2017-12-01 04:00:00'),
(6, 'a@b.c', '2017-12-02 00:00:00'),
(7, 'cmuth001@odu.edu', '2017-12-06 03:32:07'),
(8, 'cmuth001@odu.edu', '2017-12-07 03:33:37'),
(9, 'cmuth001@odu.edu', '2017-12-07 03:40:07'),
(10, 'a@b.c', '2017-12-07 10:31:39'),
(11, 'a@b.c', '2017-10-04 00:00:00'),
(12, 'a@b.c', '2017-11-08 00:00:00'),
(13, 'cmuth001@odu.edu', '2017-12-07 15:56:35'),
(14, 'a@b.c', '2017-12-07 17:34:14'),
(15, 'cmuth001@odu.edu', '2017-12-07 19:07:50'),
(16, 'a@b.c', '2017-12-07 20:06:53'),
(17, 'cmuth001@odu.edu', '2017-12-07 20:25:06'),
(18, 'cmuth001@odu.edu', '2017-12-08 00:52:00'),
(19, 'cmuth001@odu.edu', '2017-12-08 00:55:12'),
(20, 'mater@rsprings.gov', '2017-12-08 11:37:32'),
(21, 'cmuth001@odu.edu', '2017-12-08 20:35:10'),
(22, 'mater@rsprings.gov', '2017-12-08 22:44:08'),
(23, 'mater@rsprings.gov', '2017-12-09 11:36:55');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int(10) NOT NULL,
  `message` varchar(10000) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `message`, `timestamp`) VALUES
(3, 'message-1', '2017-10-06 06:52:32'),
(4, 'message-1', '2017-10-06 06:52:32'),
(5, 'message-2', '2017-10-06 06:52:32'),
(10, 'whatsup', '2017-10-06 06:52:32'),
(13, 'I am hungry', '2017-10-06 18:15:59'),
(14, 'asa', '2017-10-06 20:08:28');

-- --------------------------------------------------------

--
-- Table structure for table `modes`
--

CREATE TABLE IF NOT EXISTS `modes` (
  `mode_id` int(10) NOT NULL,
  `mode_txt` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `user_email` varchar(50) NOT NULL,
  `status_txt` varchar(100) NOT NULL,
  `status_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `threaded_messages`
--

CREATE TABLE IF NOT EXISTS `threaded_messages` (
  `thread_id` bigint(100) NOT NULL,
  `message_id` int(100) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `textOrCode` tinyint(1) NOT NULL DEFAULT '0',
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=555 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `threaded_messages`
--

INSERT INTO `threaded_messages` (`thread_id`, `message_id`, `user_email`, `message`, `textOrCode`, `createdon`) VALUES
(547, 83, 'cmuth001@odu.edu', 'ok', 0, '2017-12-08 00:39:06'),
(548, 83, 'cmuth001@odu.edu', 'got it', 0, '2017-12-08 00:39:10'),
(549, 83, 'cmuth001@odu.edu', 'awesome', 0, '2017-12-08 00:39:13'),
(550, 64, 'cmuth001@odu.edu', 'find something to it', 0, '2017-12-08 00:39:27'),
(551, 64, 'cmuth001@odu.edu', 'awee', 0, '2017-12-08 00:39:31'),
(552, 64, 'cmuth001@odu.edu', 'test1', 0, '2017-12-08 00:39:34'),
(553, 64, 'a@b.c', 'awesome buddy', 0, '2017-12-08 01:08:28'),
(554, 102, 'mater@rsprings.gov', 'l', 0, '2017-12-09 16:41:47');

-- --------------------------------------------------------

--
-- Table structure for table `userChannels`
--

CREATE TABLE IF NOT EXISTS `userChannels` (
  `user_email` varchar(50) NOT NULL,
  `channel_id` int(10) NOT NULL,
  `join_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `starred` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userChannels`
--

INSERT INTO `userChannels` (`user_email`, `channel_id`, `join_time`, `starred`) VALUES
('a@b.c', 1, '2017-12-01 05:00:00', 0),
('a@b.c', 2, '2017-12-01 05:00:00', 0),
('chinga@cars.com', 1, '2017-10-27 01:36:18', 0),
('chinga@cars.com', 2, '2017-10-27 01:36:18', 0),
('chinga@cars.com', 64, '2017-10-31 06:42:25', 0),
('cmuth001@odu.edu', 1, '2017-10-31 01:48:07', 0),
('cmuth001@odu.edu', 2, '2017-10-31 01:48:07', 0),
('cmuth001@odu.edu', 64, '2017-10-31 06:42:25', 0),
('cmuth001@odu.edu', 67, '2017-11-21 17:03:34', 0),
('cmuth001@odu.edu', 72, '2017-11-23 19:45:39', 0),
('hornet@rsprings.gov', 1, '2017-10-27 01:36:40', 0),
('hornet@rsprings.gov', 2, '2017-10-27 01:36:40', 0),
('hornet@rsprings.gov', 64, '2017-10-31 15:25:22', 0),
('kachow@rusteze.com', 1, '2017-10-27 01:37:01', 0),
('kachow@rusteze.com', 2, '2017-10-27 01:37:23', 0),
('kachow@rusteze.com', 64, '2017-10-31 15:18:37', 0),
('mack@odu.edu', 1, '2017-11-21 22:46:18', 0),
('mack@odu.edu', 2, '2017-11-21 22:46:18', 0),
('mater@rsprings.gov', 1, '2017-10-27 01:37:41', 0),
('mater@rsprings.gov', 2, '2017-10-27 01:37:41', 0),
('mater@rsprings.gov', 64, '2017-10-31 15:27:04', 0),
('mater@rsprings.gov', 67, '2017-11-05 08:12:20', 0),
('mater@rsprings.gov', 72, '2017-11-23 19:45:39', 0),
('npabb001@odu.edu', 1, '2017-10-27 01:38:00', 0),
('npabb001@odu.edu', 2, '2017-10-27 01:38:00', 0),
('npabb001@odu.edu', 66, '2017-11-02 11:23:54', 0),
('porsche@rsprings.gov', 1, '2017-10-27 01:38:22', 0),
('porsche@rsprings.gov', 2, '2017-10-27 01:38:22', 0),
('skand001@odu.edu', 1, '2017-10-27 01:38:42', 0),
('skand001@odu.edu', 2, '2017-10-27 01:38:42', 0),
('topsecret@agent.org', 1, '2017-10-27 01:38:58', 0),
('topsecret@agent.org', 2, '2017-10-27 01:38:58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `email` varchar(50) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `display_name` varchar(20) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Available',
  `mode_id` int(10) NOT NULL DEFAULT '0',
  `display_pic` varchar(200) NOT NULL DEFAULT '0' COMMENT '0=gravatar,1=local pic',
  `description` varchar(200) NOT NULL DEFAULT 'bio',
  `password` varchar(20) NOT NULL,
  `phone_no` int(13) NOT NULL DEFAULT '1234567890',
  `skype_id` varchar(20) NOT NULL DEFAULT 'skype id',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `user_name`, `display_name`, `status`, `mode_id`, `display_pic`, `description`, `password`, `phone_no`, `skype_id`, `timestamp`) VALUES
('a@b.c', 'abc', 'abc', 'Available', 0, '0', 'bio', 'asdf', 1234567890, 'skype id', '2017-12-07 07:29:25'),
('chinga@cars.com', 'Chick Hicks', 'Chick Hicks', 'Available', 0, '0', '', '@chick', 0, '', '2017-11-30 15:27:59'),
('cmuth001@odu.edu', 'chandu muthyala', 'cmuth001', 'Interested in web-programming', 0, '0', '', '@cmuth001', 0, '', '2017-12-09 01:56:35'),
('hornet@rsprings.gov', 'Doc Hudson', 'Doc Hudson', 'Available', 0, '1', '', '@doc', 0, '', '2017-11-29 09:13:16'),
('kachow@rusteze.com', 'Lightning McQueen', 'Lightning McQueen', 'Available', 0, '1', '', '@mcqueen', 0, '', '2017-11-29 09:13:18'),
('mack@odu.edu', 'mack', 'mack', 'Available', 0, '1', 'bio', 'asdf', 1234567890, 'skype id', '2017-11-29 09:13:22'),
('mater@rsprings.gov', 'Tow Mater', 'Tow Mater', 'Available', 0, '0', '', '@mater', 0, '', '2017-12-09 05:41:21'),
('npabb001@odu.edu', 'Vamsi', 'Vamsi', 'Available', 0, '0', '', 'Neutral@123', 0, '', '2017-12-01 18:25:43'),
('porsche@rsprings.gov', 'Sally Carrera', 'Sally Carrera', 'Available', 0, '1', '', '@sally', 0, '', '2017-11-29 09:13:28'),
('skand001@odu.edu', 'yashkandukuri', 'whaike', 'Available', 0, '1', '', 'She3ple!', 0, '', '2017-11-29 09:13:29'),
('topsecret@agent.org', 'Finn McMissile', 'Finn McMissile', 'Available', 0, '1', '', '@mcmissile', 0, '', '2017-11-29 09:13:31');

-- --------------------------------------------------------

--
-- Table structure for table `workspace`
--

CREATE TABLE IF NOT EXISTS `workspace` (
  `ws_id` int(20) NOT NULL,
  `ws_name` varchar(20) NOT NULL,
  `ws_url` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `channels`
--
ALTER TABLE `channels`
  ADD PRIMARY KEY (`channel_id`),
  ADD KEY `channel_id` (`channel_id`),
  ADD KEY `created_by_user_email` (`created_by_user_email`),
  ADD KEY `created_by_user_email_2` (`created_by_user_email`);

--
-- Indexes for table `channel_messages`
--
ALTER TABLE `channel_messages`
  ADD PRIMARY KEY (`cmessage_id`),
  ADD KEY `cuser_email` (`cuser_email`),
  ADD KEY `cuser_email_2` (`cuser_email`),
  ADD KEY `channel_id` (`channel_id`),
  ADD KEY `channel_id_2` (`channel_id`),
  ADD KEY `channel_id_3` (`channel_id`);

--
-- Indexes for table `channel_message_reaction`
--
ALTER TABLE `channel_message_reaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_id` (`message_id`),
  ADD KEY `user_email` (`user_email`),
  ADD KEY `emoji_id` (`emoji_id`);

--
-- Indexes for table `direct_message`
--
ALTER TABLE `direct_message`
  ADD PRIMARY KEY (`directmsg_id`),
  ADD KEY `from_email` (`from_email`,`to_email`),
  ADD KEY `to_email` (`to_email`);

--
-- Indexes for table `emojis`
--
ALTER TABLE `emojis`
  ADD PRIMARY KEY (`emoji_id`);

--
-- Indexes for table `gravatar`
--
ALTER TABLE `gravatar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `invite_user`
--
ALTER TABLE `invite_user`
  ADD PRIMARY KEY (`invite_id`),
  ADD KEY `user_email` (`user_email`),
  ADD KEY `user_email_2` (`user_email`),
  ADD KEY `channel_id` (`channel_id`);

--
-- Indexes for table `loginActivityLog`
--
ALTER TABLE `loginActivityLog`
  ADD PRIMARY KEY (`logId`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `modes`
--
ALTER TABLE `modes`
  ADD PRIMARY KEY (`mode_id`),
  ADD KEY `mode_id` (`mode_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD KEY `user_email` (`user_email`);

--
-- Indexes for table `threaded_messages`
--
ALTER TABLE `threaded_messages`
  ADD PRIMARY KEY (`thread_id`),
  ADD KEY `message_id` (`message_id`),
  ADD KEY `user_email` (`user_email`),
  ADD KEY `message_id_2` (`message_id`),
  ADD KEY `user_email_2` (`user_email`);

--
-- Indexes for table `userChannels`
--
ALTER TABLE `userChannels`
  ADD PRIMARY KEY (`user_email`,`channel_id`),
  ADD KEY `user_id` (`user_email`),
  ADD KEY `user_id_2` (`user_email`),
  ADD KEY `channel_id` (`channel_id`),
  ADD KEY `channel_id_2` (`channel_id`),
  ADD KEY `channel_id_3` (`channel_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`),
  ADD KEY `email` (`email`),
  ADD KEY `mode_id` (`mode_id`),
  ADD KEY `email_2` (`email`);

--
-- Indexes for table `workspace`
--
ALTER TABLE `workspace`
  ADD PRIMARY KEY (`ws_id`),
  ADD KEY `ws_id` (`ws_id`),
  ADD KEY `ws_id_2` (`ws_id`),
  ADD KEY `ws_id_3` (`ws_id`),
  ADD KEY `ws_id_4` (`ws_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `channels`
--
ALTER TABLE `channels`
  MODIFY `channel_id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `channel_messages`
--
ALTER TABLE `channel_messages`
  MODIFY `cmessage_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=112;
--
-- AUTO_INCREMENT for table `channel_message_reaction`
--
ALTER TABLE `channel_message_reaction`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=564;
--
-- AUTO_INCREMENT for table `direct_message`
--
ALTER TABLE `direct_message`
  MODIFY `directmsg_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT for table `emojis`
--
ALTER TABLE `emojis`
  MODIFY `emoji_id` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gravatar`
--
ALTER TABLE `gravatar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `invite_user`
--
ALTER TABLE `invite_user`
  MODIFY `invite_id` bigint(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `loginActivityLog`
--
ALTER TABLE `loginActivityLog`
  MODIFY `logId` bigint(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `threaded_messages`
--
ALTER TABLE `threaded_messages`
  MODIFY `thread_id` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=555;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`);

--
-- Constraints for table `channels`
--
ALTER TABLE `channels`
  ADD CONSTRAINT `channels_ibfk_1` FOREIGN KEY (`created_by_user_email`) REFERENCES `users` (`email`) ON UPDATE CASCADE;

--
-- Constraints for table `channel_messages`
--
ALTER TABLE `channel_messages`
  ADD CONSTRAINT `channel_messages_ibfk_1` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`channel_id`),
  ADD CONSTRAINT `channel_messages_ibfk_2` FOREIGN KEY (`cuser_email`) REFERENCES `users` (`email`);

--
-- Constraints for table `channel_message_reaction`
--
ALTER TABLE `channel_message_reaction`
  ADD CONSTRAINT `channel_message_reaction_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`),
  ADD CONSTRAINT `channel_message_reaction_ibfk_2` FOREIGN KEY (`emoji_id`) REFERENCES `emojis` (`emoji_id`);

--
-- Constraints for table `direct_message`
--
ALTER TABLE `direct_message`
  ADD CONSTRAINT `direct_message_ibfk_1` FOREIGN KEY (`to_email`) REFERENCES `users` (`email`) ON UPDATE CASCADE,
  ADD CONSTRAINT `direct_message_ibfk_2` FOREIGN KEY (`from_email`) REFERENCES `users` (`email`) ON UPDATE CASCADE;

--
-- Constraints for table `gravatar`
--
ALTER TABLE `gravatar`
  ADD CONSTRAINT `gravatar_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`);

--
-- Constraints for table `invite_user`
--
ALTER TABLE `invite_user`
  ADD CONSTRAINT `invite_user_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`),
  ADD CONSTRAINT `invite_user_ibfk_2` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`channel_id`);

--
-- Constraints for table `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`);

--
-- Constraints for table `threaded_messages`
--
ALTER TABLE `threaded_messages`
  ADD CONSTRAINT `threaded_messages_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `channel_messages` (`cmessage_id`),
  ADD CONSTRAINT `threaded_messages_ibfk_2` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`);

--
-- Constraints for table `userChannels`
--
ALTER TABLE `userChannels`
  ADD CONSTRAINT `userChannels_ibfk_1` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`channel_id`),
  ADD CONSTRAINT `userChannels_ibfk_2` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
