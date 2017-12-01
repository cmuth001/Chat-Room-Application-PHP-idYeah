-- phpMyAdmin SQL Dump
-- version 4.4.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 01, 2017 at 10:43 AM
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
(1, 'general', 'all general messages', 'cmuth001@odu.edu', '2017-12-01 06:19:58', 0, 0),
(2, 'random', 'random messages', 'cmuth001@odu.edu', '2017-11-24 19:49:27', 0, 0),
(64, 'privateChannel', 'testing....', 'cmuth001@odu.edu', '2017-11-20 21:10:56', 1, 0),
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
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

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
(31, 64, 'mater@rsprings.gov', 'p1', 0, 0, '2017-11-23 00:31:09'),
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
(58, 1, 'a@b.c', 'hi admins', 0, 0, '2017-11-29 22:40:06'),
(59, 1, 'chinga@cars.com', 'oik', 0, 0, '2017-11-30 15:34:06'),
(60, 1, 'skand001@odu.edu', 'testing', 0, 0, '2017-11-30 19:50:13'),
(61, 1, 'abc@b.c', 'hello', 0, 0, '2017-12-01 02:14:45'),
(62, 1, 'npabb001@odu.edu', 'okay', 0, 0, '2017-12-01 15:38:40');

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
) ENGINE=InnoDB AUTO_INCREMENT=541 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `channel_message_reaction`
--

INSERT INTO `channel_message_reaction` (`id`, `message_id`, `user_email`, `emoji_id`, `createdon`) VALUES
(311, 25, 'mater@rsprings.gov', 2, '2017-11-23 03:56:00'),
(313, 46, 'cmuth001@odu.edu', 1, '2017-11-24 21:49:23'),
(316, 44, 'cmuth001@odu.edu', 1, '2017-11-24 22:21:57'),
(383, 19, 'cmuth001@odu.edu', 1, '2017-11-24 23:49:15'),
(384, 20, 'cmuth001@odu.edu', 2, '2017-11-24 23:49:16'),
(385, 21, 'cmuth001@odu.edu', 1, '2017-11-24 23:49:18'),
(386, 22, 'cmuth001@odu.edu', 2, '2017-11-24 23:49:19'),
(387, 23, 'cmuth001@odu.edu', 1, '2017-11-24 23:49:20'),
(388, 24, 'cmuth001@odu.edu', 2, '2017-11-24 23:49:21'),
(392, 28, 'cmuth001@odu.edu', 1, '2017-11-24 23:49:31'),
(393, 29, 'cmuth001@odu.edu', 2, '2017-11-24 23:49:32'),
(447, 41, 'cmuth001@odu.edu', 2, '2017-11-25 00:25:55'),
(461, 4, 'mater@rsprings.gov', 2, '2017-11-26 04:11:17'),
(471, 41, 'mater@rsprings.gov', 1, '2017-11-26 04:18:19'),
(472, 19, 'mater@rsprings.gov', 1, '2017-11-26 04:18:46'),
(476, 31, 'mater@rsprings.gov', 1, '2017-11-26 08:26:23'),
(493, 42, 'cmuth001@odu.edu', 2, '2017-11-27 21:31:31'),
(494, 47, 'cmuth001@odu.edu', 1, '2017-11-28 20:58:55'),
(506, 45, 'cmuth001@odu.edu', 2, '2017-11-28 21:00:09'),
(513, 10, 'mater@rsprings.gov', 2, '2017-11-28 21:00:34'),
(517, 45, 'mater@rsprings.gov', 1, '2017-11-29 15:12:57'),
(520, 23, 'mater@rsprings.gov', 2, '2017-11-30 17:33:32'),
(538, 48, 'abc@b.c', 2, '2017-12-01 02:18:37'),
(540, 25, 'cmuth001@odu.edu', 1, '2017-12-01 06:15:58');

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
  `dm_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `direct_message`
--

INSERT INTO `direct_message` (`directmsg_id`, `from_email`, `to_email`, `direct_message`, `textOrCode`, `dm_timestamp`) VALUES
(1, 'mater@rsprings.gov', 'chinga@cars.com', 'okay checking', 0, '2017-11-26 16:21:34'),
(2, 'mater@rsprings.gov', 'chinga@cars.com', '1', 0, '2017-11-26 16:22:21'),
(3, 'mater@rsprings.gov', 'chinga@cars.com', '2', 0, '2017-11-26 16:22:22'),
(4, 'mater@rsprings.gov', 'chinga@cars.com', '3', 0, '2017-11-26 16:22:23'),
(5, 'mater@rsprings.gov', 'chinga@cars.com', '4', 0, '2017-11-26 16:22:24'),
(6, 'cmuth001@odu.edu', 'mater@rsprings.gov', '5', 0, '2017-11-26 16:23:16'),
(7, 'cmuth001@odu.edu', 'mater@rsprings.gov', '6', 0, '2017-11-26 16:23:17'),
(8, 'cmuth001@odu.edu', 'mater@rsprings.gov', '7', 0, '2017-11-26 16:23:20'),
(9, 'cmuth001@odu.edu', 'mater@rsprings.gov', '8', 0, '2017-11-26 16:23:21'),
(10, 'cmuth001@odu.edu', 'mater@rsprings.gov', '9', 0, '2017-11-26 16:23:22'),
(11, 'mater@rsprings.gov', 'cmuth001@odu.edu', '5-1', 0, '2017-11-26 16:24:07'),
(12, 'mater@rsprings.gov', 'cmuth001@odu.edu', '6-1', 0, '2017-11-26 16:24:12'),
(13, 'mater@rsprings.gov', 'cmuth001@odu.edu', '7-1', 0, '2017-11-26 16:24:15'),
(14, 'mater@rsprings.gov', 'cmuth001@odu.edu', '8-1', 0, '2017-11-26 16:24:17'),
(15, 'mater@rsprings.gov', 'cmuth001@odu.edu', 'https://vignette.wikia.nocookie.net/disney/images/c/c0/Mack.png', 2, '2017-11-26 16:52:04'),
(16, 'mater@rsprings.gov', 'cmuth001@odu.edu', 'okay', 0, '2017-11-26 17:47:00'),
(17, 'mater@rsprings.gov', 'cmuth001@odu.edu', 'http://www.cs.odu.edu/~jbrunelle/cs518/chick.png', 2, '2017-11-26 17:47:19'),
(18, 'mater@rsprings.gov', 'cmuth001@odu.edu', 'asda', 0, '2017-11-26 17:47:47'),
(19, 'mater@rsprings.gov', 'cmuth001@odu.edu', 'asdasd', 1, '2017-11-26 17:50:30'),
(20, 'mater@rsprings.gov', 'cmuth001@odu.edu', 'okay', 0, '2017-11-27 04:30:42'),
(21, 'mater@rsprings.gov', 'porsche@rsprings.gov', 'okay ', 0, '2017-11-27 04:33:40'),
(22, 'cmuth001@odu.edu', 'cmuth001@odu.edu', 'l', 0, '2017-11-27 21:10:02'),
(23, 'mater@rsprings.gov', 'kachow@rusteze.com', 'a', 0, '2017-11-29 09:00:31'),
(25, 'a@b.c', 'cmuth001@odu.edu', 'hey hai admin !', 0, '2017-11-29 22:39:54'),
(26, 'cmuth001@odu.edu', 'skand001@odu.edu', 'Hey man! How are you?', 0, '2017-11-30 19:46:14'),
(27, 'cmuth001@odu.edu', 'skand001@odu.edu', 'Heard that you''ve checked into a mental asylum??', 0, '2017-11-30 19:46:30'),
(28, 'skand001@odu.edu', 'cmuth001@odu.edu', 'It''s true, man', 0, '2017-11-30 19:49:27'),
(29, 'skand001@odu.edu', 'cmuth001@odu.edu', 'I''m crazy and I know it', 0, '2017-11-30 19:49:34'),
(30, 'skand001@odu.edu', 'kachow@rusteze.com', 'I''m your fan!', 0, '2017-11-30 19:53:23'),
(33, 'abc@b.c', 'hornet@rsprings.gov', 'hey there', 0, '2017-12-01 02:14:55'),
(34, 'abc@b.c', 'cmuth001@odu.edu', 'hey', 0, '2017-12-01 02:15:01'),
(35, 'abc@b.c', 'a@b.c', 'hey', 0, '2017-12-01 02:15:10'),
(36, 'abc@b.c', 'lalaland@lalalan.com', 'hi', 0, '2017-12-01 02:16:44');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gravatar`
--

INSERT INTO `gravatar` (`id`, `email`, `path`, `timestamp`) VALUES
(1, 'cmuth001@odu.edu', 'https://www.gravatar.com/avatar/6cc9724a530a26f625b93e6d7962bbea', '2017-11-01 04:00:00'),
(3, 'a@b.c', 'https://www.gravatar.com/avatar/5d60d4e28066df254d5452f92c910092?s=40&r=g', '2017-11-29 22:39:20'),
(4, 'chinga@cars.com', 'https://www.gravatar.com/avatar/2a4237a9a1676a06923482291c63de8f', '2017-11-30 15:36:14'),
(5, 'npabb001@odu.edu', 'https://www.gravatar.com/avatar/3f7a4cd53ba01ed46c816c5cefc5c8db', '2017-11-30 16:01:03'),
(6, 'google@rajnikanth.com', 'https://www.gravatar.com/avatar/2d674f6cbaf8e0ccf20a276cb9ca0cdd?s=40&r=g', '2017-11-30 19:56:45'),
(7, 'abc@b.c', 'https://www.gravatar.com/avatar/11bcd7634809ab9cfc56419cf8023712?s=40&r=g', '2017-12-01 02:13:01');

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
-- Table structure for table `registration_request`
--

CREATE TABLE IF NOT EXISTS `registration_request` (
  `Request_ID` int(11) NOT NULL,
  `FName` varchar(30) NOT NULL,
  `MName` varchar(20) NOT NULL,
  `LName` varchar(30) NOT NULL,
  `Interested_in` varchar(255) NOT NULL,
  `org_id` int(11) NOT NULL DEFAULT '1',
  `organization` varchar(50) DEFAULT NULL,
  `work_email` varchar(255) NOT NULL,
  `person_email` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Clinical_pset` varchar(50) NOT NULL,
  `Zipcode_pset` int(6) DEFAULT NULL,
  `Contact` varchar(12) NOT NULL,
  `Certifications` varchar(255) DEFAULT NULL,
  `edu_level` varchar(255) NOT NULL,
  `Jobtitle` varchar(50) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Pending',
  `date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration_request`
--

INSERT INTO `registration_request` (`Request_ID`, `FName`, `MName`, `LName`, `Interested_in`, `org_id`, `organization`, `work_email`, `person_email`, `Address`, `Clinical_pset`, `Zipcode_pset`, `Contact`, `Certifications`, `edu_level`, `Jobtitle`, `role`, `status`, `date`) VALUES
(113, 'Wendell', 'Turner', 'Poulsen', '', 1, NULL, 'wtpoulsen@msn.com', 'wtpoulsen@msn.com', '8394 Circle Drive  Virginia Hayes 23072', '', 23072, '7577194313', 'Other', 'Other', 'Practice Manager, Staff Physician', 'Preceptor', 'Invited', '0000-00-00 00:00:00'),
(115, 'tat', '', 'tat', '', 1, NULL, 'tanurjit@gmail.com', 'tanurjit@gmail.com', 'new address is', '', 5, '', 'C', 'MS', 'NJ', 'Preceptor', 'Approved', '0000-00-00 00:00:00'),
(116, 'tat', '', 'tat', '', 1, NULL, 'ttriv002@odu.edus', 'ttriv002@odu.edus', '456  District Of Columbia 456 23508', '', 23508, '123123123', 'Acute Care NPAdult NPAdult-Gerontology Acute Care NP', 'Masters of Science in Nursing', 'JOB TITLE', 'Preceptor', 'Invited', '0000-00-00 00:00:00'),
(117, 'Grant', '', 'Atkins', '', 1, NULL, 'grant7129@gmail.com', 'grant7129@gmail.com', '2777 Something Road Virginia Virginia Beach 23455', '', 23454, '5112165114', 'Adult NPAdult Health CNS', 'RN- Baccalaureate Degree', 'Elderly Care Nurse', 'Preceptor', 'Invited', '0000-00-00 00:00:00'),
(119, 'Grant', '', 'Atkins', 'Becoming a Preceptor', 1, NULL, 'gratki001@odu.edu', 'gatki001@odu.edu', '2777 Golf StreetVirginiaVirginia Beach23455', '', 123456, '', 'nursing cert', 'highest education2', 'job title', 'Preceptor', 'Invited', '0000-00-00 00:00:00'),
(120, 'khjk', 'jkhjk', 'jhkhjk', 'Others', 1, NULL, 'ttriv002@odu.edu', 'ttriv002@odu.edu', '45546Alaska45654645', '', 54645, '5456454564', 'Adult NP', 'RN- Baccalaureate Degree', '456', 'Preceptor', 'Approved', '0000-00-00 00:00:00'),
(121, 'Ethlyn', '', 'Gibson', '', 1, NULL, 'ethlyn.gibson@rivhs.com', 'ethlyn.gibson@rivhs.com', '', '', NULL, '', NULL, 'Doctor of Nursing Practice, Nursing Administration', '', 'Preceptor', 'Invited', '0000-00-00 00:00:00'),
(122, 'Carissa', '', 'Lam', '', 1, NULL, 'cjblosse@sentara.com', 'cjblosse@sentara.com', '', '', NULL, '', NULL, '', '', 'Preceptor', 'Invited', '0000-00-00 00:00:00'),
(123, 'Deborah', '', 'Croy', '', 1, NULL, 'bdcroy@suddenlink.net', 'bdcroy@suddenlink.net', '', '', NULL, '', NULL, '', '', 'Preceptor', 'Invited', '0000-00-00 00:00:00'),
(124, 'test', 'sd', 'test2', '', 1, NULL, 'ttriv002@odu.edu', 'ttriv002@odu.edu', 'sds  Colorado dsd 4555', '', 4555, '5244656464', 'Adult NP', 'Masters of Science in Nursing', 'faculty', 'Preceptor', 'Invited', '0000-00-00 00:00:00'),
(125, 'pete', 'g', 'hill', 'Becoming a Preceptor', 1, NULL, 'petehillnp@verizon.net', 'petehillnp@verizon.net', '800 shenandoah avenueVirginiaelkton22827', '', 22827, '5402989900', 'Family NP', 'Select Educational Level', 'executive director', 'Preceptor', 'Approved', '0000-00-00 00:00:00'),
(126, 'Jamie', 'A', 'Holland', '', 1, NULL, 'jholl005@odu.edu', 'jholl005@odu.edu', '3820 Long Ship Ct  Virginia Virginia Beach 23455', 'OA', 23455, '7572914876', 'Adult-Gerontology CNS', 'Masters of Science in Nursing', 'DNP student', 'Preceptor', 'Invited', '0000-00-00 00:00:00'),
(127, '', '', '', '', 1, NULL, '', '', '', '', 0, '', '', '', '', NULL, 'Pending', '0000-00-00 00:00:00'),
(128, 'Patricia ', 'L', 'Cafaro ', '', 1, NULL, 'pcafaro@odu.edu', 'pcafaro@odu.edu', '1200 East Broad Street, West Hospital, 10th Floor, Pulmonary Medicine  Virginia Richmond 23298-5861', 'O', 23298, '8048284968', 'Family NP', 'Doctor of Nursing Practice', 'Adult Asthma Prog Clinical Director, Bronchial The', 'Preceptor', 'Invited', '0000-00-00 00:00:00'),
(129, 'Grant', 'C', 'Atkins', 'Becoming a Preceptor', 1, NULL, 'gatki001@odu.edu', 'gatki001@odu.edu', '6214 Valley RoadVirginiaVirginia Beach23454', '', 23454, '7576174119', 'Other', 'Masters of Science in Nursing', 'Research Assistant', 'Preceptor', 'Approved', '0000-00-00 00:00:00'),
(130, 'Valerie', 'L', 'King', 'Advanced Practice Nursing ProgramsFamily Nurse Practitioner', 1, NULL, 'valerie_king@uml.edu', 'valerie_king@uml.edu', 'University of Massachusetts Lowell MassachusettsLowell01824', '', 1824, '9788461120', 'Family NP', 'Doctor of Nursing Practice', 'Coordinator of MS NP program. (I am interested in ', NULL, 'Pending', '0000-00-00 00:00:00'),
(131, 'Valerie', 'L', 'King', 'Advanced Practice Nursing ProgramsFamily Nurse Practitioner', 1, NULL, 'valerie_king@uml.edu', 'valerie_king@uml.edu', 'University of Massachusetts Lowell MassachusettsLowell01824', '', 1824, '9788461120', 'Family NP', 'Doctor of Nursing Practice', 'Coordinator of MS NP program. (I am interested in ', NULL, 'Pending', '0000-00-00 00:00:00'),
(132, 'Valerie', 'L', 'King', 'Advanced Practice Nursing ProgramsFamily Nurse Practitioner', 1, NULL, 'valerie_king@uml.edu', 'valerie_king@uml.edu', 'University of Massachusetts Lowell MassachusettsLowell01824', '', 1824, '9788461120', 'Family NP', 'Doctor of Nursing Practice', 'Coordinator of MS NP program. (I am interested in ', NULL, 'Pending', '0000-00-00 00:00:00'),
(133, 'Brenda', '', 'McNeil', 'Advanced Practice Nursing ProgramsFamily Nurse Practitioner', 1, NULL, 'brenda.mcneil@uconn.edu', 'brenda.mcneil@uconn.edu', '231 Glennbrook Road U-4026ConnecticutStorrs06269', '', 6269, '8602451983', 'Family NP', 'Doctor of Nursing Practice', 'Assistant Clinical Professor', NULL, 'Pending', '0000-00-00 00:00:00'),
(134, 'Lynette', '', 'Hamlin', 'Others', 1, NULL, 'lynette.hamlin@usuhs.edu', 'lynette.hamlin@usuhs.edu', 'Uniformed Services University of the Health SciencesMarylandBethesda20814', '', 20814, '3012950733', 'Certified Nurse Midwife', 'PhD in Nursing', 'Associate Dean for Faculty Affairs', NULL, 'Pending', '0000-00-00 00:00:00'),
(135, 'Tammy ', 'J', 'Maloney ', '', 1, NULL, 'tamal23452@hotmail.com', 'tamal23452@hotmail.com', '433 Hopkins Road  Virginia Virginia Beach 23452', 'NH', 23452, '7579693971', 'Family NP', 'Doctor of Nursing Practice', 'nurse practitioner', 'Preceptor', 'Invited', '0000-00-00 00:00:00'),
(141, 'CHANDRASEKHAR', 'REDDY', 'MUTHYALA', 'Telehealth', 0, 'Texas State University', 'cmuth001@odu.edu', 'cmuth001@odu.edu', '1055 W 48TH STREETVirginiaNORFOLK23508', '', 23508, '111111111', 'Acute Care NP', 'Select Educational Level', 'testing', NULL, 'Pending', '0000-00-00 00:00:00'),
(142, 'CHANDRASEKHAR', 'REDDY', 'MUTHYALA', 'Telehealth', 1, 'NULL', 'cmuth001@odu.edu', 'cmuth001@odu.edu', '1055 W 48TH STREETVirginiaNORFOLK23508', '', 23508, '111111111', 'Acute Care NP', 'Select Educational Level', 'testing', NULL, 'Pending', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=546 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `threaded_messages`
--

INSERT INTO `threaded_messages` (`thread_id`, `message_id`, `user_email`, `message`, `textOrCode`, `createdon`) VALUES
(452, 21, 'mater@rsprings.gov', '', 0, '2017-11-23 03:03:33'),
(453, 21, 'mater@rsprings.gov', '', 0, '2017-11-23 03:03:46'),
(454, 21, 'mater@rsprings.gov', 'asaddasf', 1, '2017-11-23 03:04:25'),
(455, 21, 'mater@rsprings.gov', '', 0, '2017-11-23 03:04:47'),
(456, 21, 'mater@rsprings.gov', '', 0, '2017-11-23 03:13:53'),
(457, 21, 'mater@rsprings.gov', 'hey', 0, '2017-11-23 03:14:10'),
(458, 21, 'mater@rsprings.gov', 'sdfsdf', 1, '2017-11-23 03:14:22'),
(459, 21, 'mater@rsprings.gov', 'dfd', 0, '2017-11-23 03:14:31'),
(460, 21, 'mater@rsprings.gov', 'asdasd', 0, '2017-11-23 03:15:56'),
(461, 21, 'mater@rsprings.gov', 'asdsa', 0, '2017-11-23 03:18:25'),
(462, 21, 'mater@rsprings.gov', 'asdada', 0, '2017-11-23 03:26:27'),
(463, 21, 'mater@rsprings.gov', '1234', 0, '2017-11-23 03:26:34'),
(464, 21, 'mater@rsprings.gov', 'asfsdf', 1, '2017-11-23 03:28:45'),
(465, 44, 'mater@rsprings.gov', 'okay', 0, '2017-11-23 03:36:31'),
(466, 44, 'mater@rsprings.gov', 'lets chat here from now due', 0, '2017-11-23 03:36:44'),
(467, 44, 'mater@rsprings.gov', 'ok buddy ', 0, '2017-11-23 03:36:51'),
(468, 44, 'mater@rsprings.gov', 'hello', 0, '2017-11-23 03:36:59'),
(469, 44, 'mater@rsprings.gov', 'i am here', 0, '2017-11-23 03:37:07'),
(470, 44, 'mater@rsprings.gov', 'this is my live chat ', 0, '2017-11-23 03:37:18'),
(471, 44, 'mater@rsprings.gov', 'going here', 0, '2017-11-23 03:37:23'),
(472, 44, 'mater@rsprings.gov', 'interested people can join ', 0, '2017-11-23 03:37:35'),
(473, 44, 'mater@rsprings.gov', 'nice to chat with you guys', 0, '2017-11-23 03:37:54'),
(474, 44, 'mater@rsprings.gov', '.timeStamp{\r\n  margin-left: 8px !important;\r\n  opacity: 0.6 !important;\r\n  font-size: 1.2vh;\r\n}', 1, '2017-11-23 03:38:14'),
(475, 30, 'mater@rsprings.gov', '.profile-pic1 {     max-width: 200px;     max-height: 200px;     display: block; } .file-upload {     display: none; } /*end of Image upload css*/ .channelMembersLink{ 	padding-right: 5px !important; 	padding-left: 10px !important; } .channelMembersUl{ 	margin-left: 7%; 	overflow-y: auto;     height: 450%; } .helpPage{ 	position: absolute; 	z-index: 100; 	margin-top: 30%; }  #threadContainer{ 	border-radius: 0px; } .threadHeading{ 	border-radius: 0px !important; 	padding-top: 5% !important; 	padding-bottom: 5% !important; } .thread_wrapper{ 	height: 64%;     overflow-y: auto; } .rightThread{ 	margin-left: 0px;    padding: 5px 5px;   background-color: white;   /*border-radius: 10px;*/      } #threadContainerBody{ 	padding: 0px; }', 0, '2017-11-23 03:48:04'),
(476, 30, 'mater@rsprings.gov', '.profile-pic1 {\r\n    max-width: 200px;\r\n    max-height: 200px;\r\n    display: block;\r\n}\r\n.file-upload {\r\n    display: none;\r\n}\r\n/*end of Image upload css*/\r\n.channelMembersLink{\r\n	padding-right: 5px !important;\r\n	padding-left: 10px !important;\r\n}\r\n.channelMembersUl{\r\n	margin-left: 7%;\r\n	overflow-y: auto;\r\n    height: 450%;\r\n}\r\n.helpPage{\r\n	position: absolute;\r\n	z-index: 100;\r\n	margin-top: 30%;\r\n}\r\n\r\n#threadContainer{\r\n	border-radius: 0px;\r\n}\r\n.threadHeading{\r\n	border-radius: 0px !important;\r\n	padding-top: 5% !important;\r\n	padding-bottom: 5% !important;\r\n}\r\n.thread_wrapper{\r\n	height: 64%;\r\n    overflow-y: auto;\r\n}\r\n.rightThread{\r\n	margin-left: 0px; \r\n  padding: 5px 5px;\r\n  background-color: white;\r\n  /*border-radius: 10px;*/\r\n    \r\n}\r\n#threadContainerBody{\r\n	padding: 0px;\r\n}', 1, '2017-11-23 03:48:13'),
(477, 30, 'mater@rsprings.gov', 'ok', 0, '2017-11-23 03:53:06'),
(478, 30, 'mater@rsprings.gov', 'let see', 0, '2017-11-23 03:53:16'),
(479, 45, 'mater@rsprings.gov', 'a', 0, '2017-11-23 03:54:03'),
(480, 45, 'mater@rsprings.gov', 's', 0, '2017-11-23 03:54:04'),
(481, 45, 'mater@rsprings.gov', 'd', 0, '2017-11-23 03:54:05'),
(482, 45, 'mater@rsprings.gov', 'f', 0, '2017-11-23 03:54:05'),
(483, 45, 'mater@rsprings.gov', 'g', 0, '2017-11-23 03:54:06'),
(484, 45, 'mater@rsprings.gov', 'h', 0, '2017-11-23 03:54:06'),
(485, 45, 'mater@rsprings.gov', 'j', 0, '2017-11-23 03:54:06'),
(486, 25, 'mater@rsprings.gov', 'asdaf', 0, '2017-11-23 03:55:17'),
(487, 25, 'mater@rsprings.gov', 'sdfa', 0, '2017-11-23 03:55:20'),
(488, 25, 'mater@rsprings.gov', 'asdas', 0, '2017-11-23 03:55:45'),
(489, 25, 'mater@rsprings.gov', 'asda', 0, '2017-11-23 03:55:46'),
(490, 47, 'mater@rsprings.gov', 'hey buddy', 0, '2017-11-23 03:56:32'),
(491, 25, 'mater@rsprings.gov', 'daaawwww', 0, '2017-11-23 04:01:17'),
(492, 45, 'mater@rsprings.gov', '', 0, '2017-11-23 19:19:10'),
(493, 4, 'mater@rsprings.gov', '.right {\r\n  margin-left: 0px; \r\n  padding: 5px 5px;\r\n  background-color: white;\r\n  border-bottom: 2px solid #ccc;\r\n}', 1, '2017-11-23 19:33:51'),
(494, 4, 'mater@rsprings.gov', 'asdfaf', 0, '2017-11-23 19:33:59'),
(495, 41, 'cmuth001@odu.edu', '', 0, '2017-11-24 20:34:27'),
(496, 41, 'mater@rsprings.gov', 'lets comment on this', 0, '2017-11-25 20:47:32'),
(497, 41, 'mater@rsprings.gov', '', 0, '2017-11-26 03:43:03'),
(498, 41, 'mater@rsprings.gov', '1', 0, '2017-11-26 05:06:26'),
(499, 41, 'mater@rsprings.gov', '2', 0, '2017-11-26 05:06:27'),
(500, 41, 'mater@rsprings.gov', '3', 0, '2017-11-26 05:06:28'),
(501, 41, 'mater@rsprings.gov', '4', 0, '2017-11-26 05:06:29'),
(502, 41, 'mater@rsprings.gov', '5', 0, '2017-11-26 05:06:30'),
(503, 41, 'mater@rsprings.gov', '6', 0, '2017-11-26 05:06:31'),
(504, 41, 'mater@rsprings.gov', '7', 0, '2017-11-26 05:06:31'),
(505, 41, 'mater@rsprings.gov', '7', 0, '2017-11-26 05:06:32'),
(506, 41, 'mater@rsprings.gov', '8', 0, '2017-11-26 05:06:33'),
(507, 41, 'mater@rsprings.gov', '88', 0, '2017-11-26 05:06:35'),
(508, 41, 'mater@rsprings.gov', '9', 0, '2017-11-26 05:06:36'),
(509, 41, 'mater@rsprings.gov', '0', 0, '2017-11-26 05:06:36'),
(510, 41, 'mater@rsprings.gov', 'q', 0, '2017-11-26 05:08:48'),
(511, 42, 'mater@rsprings.gov', 'fdg', 0, '2017-11-26 05:10:25'),
(512, 42, 'mater@rsprings.gov', 'hey', 0, '2017-11-26 05:10:39'),
(513, 41, 'mater@rsprings.gov', 'd', 0, '2017-11-26 05:12:34'),
(514, 41, 'mater@rsprings.gov', 'Demo script2', 0, '2017-11-26 05:12:40'),
(515, 19, 'mater@rsprings.gov', '1', 0, '2017-11-26 05:15:20'),
(516, 19, 'mater@rsprings.gov', '23', 0, '2017-11-26 05:15:23'),
(517, 19, 'mater@rsprings.gov', '4', 0, '2017-11-26 05:15:24'),
(518, 19, 'mater@rsprings.gov', '5', 0, '2017-11-26 05:15:25'),
(519, 19, 'mater@rsprings.gov', '6', 0, '2017-11-26 05:15:26'),
(520, 19, 'mater@rsprings.gov', '7', 0, '2017-11-26 05:15:27'),
(521, 19, 'mater@rsprings.gov', '7', 0, '2017-11-26 05:15:28'),
(522, 19, 'mater@rsprings.gov', '7', 0, '2017-11-26 05:15:29'),
(523, 19, 'mater@rsprings.gov', '7', 0, '2017-11-26 05:15:29'),
(524, 19, 'mater@rsprings.gov', '7', 0, '2017-11-26 05:15:30'),
(525, 19, 'mater@rsprings.gov', '7', 0, '2017-11-26 05:15:31'),
(526, 19, 'mater@rsprings.gov', '7', 0, '2017-11-26 05:15:32'),
(527, 25, 'mater@rsprings.gov', '1', 0, '2017-11-26 05:16:24'),
(528, 25, 'mater@rsprings.gov', '', 0, '2017-11-26 05:17:11'),
(529, 46, 'mater@rsprings.gov', '1', 0, '2017-11-26 05:19:21'),
(530, 46, 'mater@rsprings.gov', '2', 0, '2017-11-26 05:19:22'),
(531, 46, 'mater@rsprings.gov', '3', 0, '2017-11-26 05:19:32'),
(532, 46, 'mater@rsprings.gov', '4', 0, '2017-11-26 05:19:34'),
(533, 46, 'mater@rsprings.gov', '5', 0, '2017-11-26 05:19:35'),
(534, 46, 'npabb001@odu.edu', 'hello', 0, '2017-11-30 17:05:19'),
(535, 23, 'npabb001@odu.edu', 'okay', 0, '2017-11-30 17:07:34'),
(536, 46, 'npabb001@odu.edu', 'okay', 0, '2017-11-30 17:19:39'),
(537, 46, 'npabb001@odu.edu', 'okay', 0, '2017-11-30 17:26:18'),
(538, 47, 'npabb001@odu.edu', 'okay', 0, '2017-11-30 17:26:46'),
(539, 47, 'cmuth001@odu.edu', 'okay', 0, '2017-11-30 17:28:16'),
(540, 23, 'cmuth001@odu.edu', 'yup', 0, '2017-11-30 17:29:48'),
(541, 48, 'abc@b.c', 'looks good', 0, '2017-12-01 02:17:03'),
(542, 48, 'cmuth001@odu.edu', 'ok', 0, '2017-12-01 06:18:01'),
(543, 48, 'cmuth001@odu.edu', 'ok', 0, '2017-12-01 06:18:52'),
(544, 48, 'cmuth001@odu.edu', 'ok', 0, '2017-12-01 06:18:54'),
(545, 49, 'cmuth001@odu.edu', 'ok', 0, '2017-12-01 06:19:25');

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
('a@b.c', 1, '2017-11-29 22:39:20', 0),
('a@b.c', 2, '2017-11-29 22:39:20', 0),
('abc@b.c', 1, '2017-12-01 02:13:01', 0),
('abc@b.c', 2, '2017-12-01 02:13:01', 0),
('chinga@cars.com', 1, '2017-10-27 01:36:18', 0),
('chinga@cars.com', 2, '2017-10-27 01:36:18', 0),
('chinga@cars.com', 64, '2017-10-31 06:42:25', 0),
('chinga@cars.com', 72, '2017-11-23 19:50:57', 0),
('cmuth001@odu.edu', 1, '2017-10-31 01:48:07', 0),
('cmuth001@odu.edu', 2, '2017-10-31 01:48:07', 0),
('cmuth001@odu.edu', 64, '2017-10-31 06:42:25', 0),
('cmuth001@odu.edu', 67, '2017-11-21 17:03:34', 0),
('cmuth001@odu.edu', 72, '2017-11-23 19:45:39', 0),
('google@rajnikanth.com', 1, '2017-11-30 19:56:45', 0),
('google@rajnikanth.com', 2, '2017-11-30 19:56:45', 0),
('hornet@rsprings.gov', 1, '2017-10-27 01:36:40', 0),
('hornet@rsprings.gov', 2, '2017-10-27 01:36:40', 0),
('hornet@rsprings.gov', 64, '2017-10-31 15:25:22', 0),
('kachow@rusteze.com', 1, '2017-10-27 01:37:01', 0),
('kachow@rusteze.com', 2, '2017-10-27 01:37:23', 0),
('kachow@rusteze.com', 64, '2017-10-31 15:18:37', 0),
('lalaland@lalalan.com', 1, '2017-11-21 17:58:57', 0),
('lalaland@lalalan.com', 2, '2017-11-21 17:58:57', 0),
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
('a@b.c', 'Tester', 'Tester', 'Available', 0, '0', 'bio', 'asdf', 1234567890, 'skype id', '2017-11-29 23:28:08'),
('abc@b.c', 'assd', 'assd', 'Available', 0, '0', 'bio', 'diana', 1234567890, 'skype id', '2017-12-01 02:19:23'),
('chinga@cars.com', 'Chick Hicks', 'Chick Hicks', 'Available', 0, '0', '', '@chick', 0, '', '2017-11-30 15:27:59'),
('cmuth001@odu.edu', 'chandu muthyala', 'cmuth001', 'Interested in web-programming', 0, '0', '', '@cmuth001', 0, '', '2017-12-01 02:31:34'),
('google@rajnikanth.com', 'Thalaiva', 'Thalaiva', 'Available', 0, '0', 'bio', 'firebolt', 1234567890, 'skype id', '2017-11-30 19:56:45'),
('hornet@rsprings.gov', 'Doc Hudson', 'Doc Hudson', 'Available', 0, '1', '', '@doc', 0, '', '2017-11-29 09:13:16'),
('kachow@rusteze.com', 'Lightning McQueen', 'Lightning McQueen', 'Available', 0, '1', '', '@mcqueen', 0, '', '2017-11-29 09:13:18'),
('lalaland@lalalan.com', 'lolalala', 'lolalala', 'Available', 0, '1', 'bio', 'firetron', 1234567890, 'skype id', '2017-11-29 09:13:20'),
('mack@odu.edu', 'mack', 'mack', 'Available', 0, '1', 'bio', 'asdf', 1234567890, 'skype id', '2017-11-29 09:13:22'),
('mater@rsprings.gov', 'Tow Mater', 'Tow Mater', 'Available', 0, '1', '', '@mater', 0, '', '2017-11-29 09:13:23'),
('mchandrasekharreddym@gmail.com', 'chandu', 'chandu', 'Available', 0, '1', 'bio', 'asdf', 0, 'skype id', '2017-11-29 09:13:25'),
('npabb001@odu.edu', 'Vamsi', 'Vamsi', 'Available', 0, '2', '', 'Neutral@123', 0, '', '2017-11-30 17:26:29'),
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
-- Indexes for table `registration_request`
--
ALTER TABLE `registration_request`
  ADD PRIMARY KEY (`Request_ID`),
  ADD KEY `org_id` (`org_id`);

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
  MODIFY `cmessage_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `channel_message_reaction`
--
ALTER TABLE `channel_message_reaction`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=541;
--
-- AUTO_INCREMENT for table `direct_message`
--
ALTER TABLE `direct_message`
  MODIFY `directmsg_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `emojis`
--
ALTER TABLE `emojis`
  MODIFY `emoji_id` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gravatar`
--
ALTER TABLE `gravatar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `invite_user`
--
ALTER TABLE `invite_user`
  MODIFY `invite_id` bigint(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `registration_request`
--
ALTER TABLE `registration_request`
  MODIFY `Request_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=143;
--
-- AUTO_INCREMENT for table `threaded_messages`
--
ALTER TABLE `threaded_messages`
  MODIFY `thread_id` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=546;
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
