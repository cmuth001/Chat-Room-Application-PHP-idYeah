-- phpMyAdmin SQL Dump
-- version 4.4.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 21, 2017 at 12:28 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `channels`
--

INSERT INTO `channels` (`channel_id`, `channel_name`, `purpose`, `created_by_user_email`, `createdon`, `access_specifiers`, `isArchive`) VALUES
(1, 'general', 'all general messages', 'cmuth001@odu.edu', '2017-11-21 04:31:26', 0, 0),
(2, 'random', 'random messages', 'cmuth001@odu.edu', '2017-11-21 04:42:32', 0, 0),
(64, 'privateChannel', 'testing....', 'cmuth001@odu.edu', '2017-11-20 21:10:56', 1, 0),
(66, 'public channel testi', 'testing 1', 'npabb001@odu.edu', '2017-11-02 11:23:54', 0, 0),
(67, 'new private channel-2', 'testing new private channel-2', 'mater@rsprings.gov', '2017-11-05 08:12:20', 1, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=305 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `channel_messages`
--

INSERT INTO `channel_messages` (`cmessage_id`, `channel_id`, `cuser_email`, `channel_message`, `has_thread`, `textOrCode`, `cmsg_timestamp`) VALUES
(253, 1, 'cmuth001@odu.edu', 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d1/Icons8_flat_businessman.svg/1024px-Icons8_flat_businessman.svg.png', 1, 2, '2017-11-18 16:32:35'),
(254, 1, 'cmuth001@odu.edu', '', 0, 3, '2017-11-18 16:43:33'),
(255, 1, 'cmuth001@odu.edu', 'aad\\', 0, 0, '2017-11-18 20:40:43'),
(256, 1, 'cmuth001@odu.edu', 'dasd', 0, 0, '2017-11-18 20:40:45'),
(257, 1, 'cmuth001@odu.edu', 'asdas', 0, 0, '2017-11-18 20:40:46'),
(259, 1, 'cmuth001@odu.edu', 'asd', 0, 0, '2017-11-18 20:40:48'),
(263, 1, 'cmuth001@odu.edu', 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d1/Icons8_flat_businessman.svg/1024px-Icons8_flat_businessman.svg.png', 0, 2, '2017-11-18 21:47:34'),
(264, 1, 'cmuth001@odu.edu', 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d1/Icons8_flat_businessman.svg/1024px-Icons8_flat_businessman.svg', 0, 0, '2017-11-18 21:47:47'),
(265, 1, 'cmuth001@odu.edu', 'https://vignette2.wikia.nocookie.net/disney/images/1/1e/Chick_Hicks.png/revision/latest?cb=20151222135632', 0, 0, '2017-11-18 21:48:35'),
(266, 1, 'cmuth001@odu.edu', 'https://files.slack.com/files-pri/T5T5XF45R-F7U6C9YG0/chick.png', 0, 2, '2017-11-18 21:50:01'),
(267, 1, 'cmuth001@odu.edu', 'if(isset($_POST[''deleteMessage'']))\r\n{\r\n	$messageId = intval($_POST[''deleteMessage'']);\r\n	echo $messageId;\r\n	$threadMessageSql = "DELETE FROM threaded_messages WHERE message_id=''$messageId''";\r\n	$channekMessageDeleteSql = "DELETE FROM channel_messages WHERE cmessage_id=''$messageId''";\r\n	if (mysqli_query($conn, $threadMessageSql)) {       \r\n        echo "''$threadMessageSql''thread messages deleted !!!";\r\n    }else{\r\n        echo "failed deleting thread messages !!!";\r\n    }\r\n    if (mysqli_query($conn, $channekMessageDeleteSql)) {       \r\n        echo "''$threadMessageSql''channel  message deleted !!!";\r\n    }else{\r\n        echo "failed deleting channel message !!!";\r\n    }\r\n}', 0, 1, '2017-11-18 21:58:40'),
(268, 1, 'cmuth001@odu.edu', '', 1, 3, '2017-11-19 20:02:32'),
(270, 64, 'cmuth001@odu.edu', 'test1', 0, 0, '2017-11-19 20:45:09'),
(271, 1, 'cmuth001@odu.edu', 'Testing', 0, 0, '2017-11-19 20:48:33'),
(272, 1, 'cmuth001@odu.edu', 'Something all of us must remember always.', 0, 3, '2017-11-19 20:50:31'),
(273, 1, 'cmuth001@odu.edu', 'for all of us! let your swords stay sharp!', 0, 3, '2017-11-19 20:51:55'),
(274, 2, 'cmuth001@odu.edu', 'test1', 0, 0, '2017-11-19 21:09:03'),
(275, 1, 'cmuth001@odu.edu', 'who is chatting  with my login :P ', 0, 0, '2017-11-19 21:17:37'),
(276, 1, 'cmuth001@odu.edu', 'if possible test everything ', 0, 0, '2017-11-19 21:18:18'),
(277, 1, 'cmuth001@odu.edu', '', 0, 3, '2017-11-19 21:23:56'),
(278, 1, 'cmuth001@odu.edu', '', 0, 3, '2017-11-19 21:24:10'),
(279, 1, 'cmuth001@odu.edu', 'var x = 5;      // Declare x, give it the value of 5\r\nvar y = x + 2;', 1, 1, '2017-11-19 22:28:38'),
(280, 1, 'npabb001@odu.edu', 'http://qav2.cs.odu.edu/chandu/web-programming/index.php?channel=1#scrollBottom', 1, 0, '2017-11-20 07:07:09'),
(282, 1, 'mater@rsprings.gov', '', 0, 3, '2017-11-20 05:43:10'),
(283, 1, 'mater@rsprings.gov', 'http://www.gettyimages.in/gi-resources/images/Homepage/Hero/US/MAR2016/prestige-587705839_full.jpg', 0, 2, '2017-11-20 05:55:10'),
(284, 1, 'mater@rsprings.gov', 'https://media.giphy.com/channel_assets/reactions/k2ybPvSfRQuK.gif', 0, 2, '2017-11-20 05:55:51'),
(285, 1, 'mater@rsprings.gov', 'hello', 1, 0, '2017-11-20 05:58:13'),
(286, 1, 'mater@rsprings.gov', 'https://m.popkey.co/e55307/ygwM0.gif', 1, 2, '2017-11-20 16:43:51'),
(291, 2, 'mater@rsprings.gov', 'hello testing for rating', 0, 0, '2017-11-20 08:41:15'),
(292, 2, 'mater@rsprings.gov', 'okay', 0, 0, '2017-11-20 08:41:40'),
(293, 1, 'mater@rsprings.gov', 'let me comment', 0, 0, '2017-11-20 16:55:55'),
(294, 1, 'mater@rsprings.gov', 'sdfsd', 0, 0, '2017-11-20 16:56:08'),
(295, 1, 'chinga@cars.com', 'my first message for rating :P', 0, 0, '2017-11-20 16:58:41'),
(297, 1, 'chinga@cars.com', '', 0, 3, '2017-11-20 16:59:34'),
(298, 2, 'chinga@cars.com', '', 0, 3, '2017-11-20 17:00:28'),
(299, 1, 'mater@rsprings.gov', 'https://m.popkey.co/e55307/ygwM0.gif', 0, 2, '2017-11-20 19:32:15'),
(300, 1, 'mater@rsprings.gov', '# Python 3: Fibonacci series up to n\r\n>>> def fib(n):\r\n>>>     a, b = 0, 1\r\n>>>     while a < n:\r\n>>>         print(a, end='' '')\r\n>>>         a, b = b, a+b\r\n>>>     print()\r\n>>> fib(1000)', 0, 1, '2017-11-20 19:45:03'),
(301, 1, 'mater@rsprings.gov', 'def fib(n):\r\n>>>     a, b = 0, 1\r\n>>>     while a < n:\r\n>>>         print(a, end='' '')\r\n>>>         a, b = b, a+b\r\n>>>     print()', 1, 1, '2017-11-20 21:50:14'),
(302, 1, 'mater@rsprings.gov', '9615*5961946594', 1, 1, '2017-11-20 21:24:24'),
(304, 2, 'cmuth001@odu.edu', 'https://m.popkey.co/e55307/ygw <!-- M0.gif', 0, 2, '2017-11-20 21:31:42');

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
) ENGINE=InnoDB AUTO_INCREMENT=296 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `channel_message_reaction`
--

INSERT INTO `channel_message_reaction` (`id`, `message_id`, `user_email`, `emoji_id`, `createdon`) VALUES
(264, 267, 'skand001@odu.edu', 1, '2017-11-19 19:17:46'),
(266, 269, 'skand001@odu.edu', 2, '2017-11-19 19:23:02'),
(267, 270, 'cmuth001@odu.edu', 2, '2017-11-19 20:45:23'),
(268, 273, 'skand001@odu.edu', 1, '2017-11-19 20:52:36'),
(270, 279, 'cmuth001@odu.edu', 1, '2017-11-20 06:37:43'),
(271, 280, 'npabb001@odu.edu', 1, '2017-11-20 06:37:45'),
(272, 282, 'mater@rsprings.gov', 1, '2017-11-20 06:37:46'),
(274, 280, 'mater@rsprings.gov', 1, '2017-11-20 06:38:33'),
(275, 283, 'mater@rsprings.gov', 1, '2017-11-20 06:38:40'),
(276, 280, 'cmuth001@odu.edu', 1, '2017-11-20 06:57:03'),
(277, 282, 'cmuth001@odu.edu', 1, '2017-11-20 06:57:04'),
(278, 283, 'cmuth001@odu.edu', 1, '2017-11-20 06:57:07'),
(279, 271, 'cmuth001@odu.edu', 1, '2017-11-20 07:08:44'),
(280, 272, 'cmuth001@odu.edu', 1, '2017-11-20 07:08:46'),
(281, 273, 'cmuth001@odu.edu', 2, '2017-11-20 07:08:48'),
(282, 275, 'cmuth001@odu.edu', 2, '2017-11-20 07:08:50'),
(283, 276, 'cmuth001@odu.edu', 2, '2017-11-20 07:08:52'),
(284, 277, 'cmuth001@odu.edu', 1, '2017-11-20 07:08:55'),
(285, 286, 'mater@rsprings.gov', 1, '2017-11-20 16:43:34'),
(286, 284, 'mater@rsprings.gov', 1, '2017-11-20 16:55:12'),
(287, 294, 'chinga@cars.com', 1, '2017-11-20 16:59:50'),
(288, 293, 'chinga@cars.com', 2, '2017-11-20 16:59:51'),
(289, 274, 'chinga@cars.com', 1, '2017-11-20 17:00:38'),
(290, 291, 'chinga@cars.com', 1, '2017-11-20 17:00:40'),
(291, 292, 'chinga@cars.com', 1, '2017-11-20 17:00:41'),
(292, 297, 'cmuth001@odu.edu', 1, '2017-11-20 19:46:47'),
(293, 302, 'mater@rsprings.gov', 1, '2017-11-20 21:42:57'),
(294, 300, 'mater@rsprings.gov', 1, '2017-11-21 03:01:44'),
(295, 299, 'mater@rsprings.gov', 2, '2017-11-21 03:01:50');

-- --------------------------------------------------------

--
-- Table structure for table `direct_message`
--

CREATE TABLE IF NOT EXISTS `direct_message` (
  `directmsg_id` int(10) NOT NULL,
  `from_email` varchar(20) NOT NULL,
  `to_email` varchar(20) NOT NULL,
  `direct_message` varchar(2000) NOT NULL,
  `dm_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=443 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `threaded_messages`
--

INSERT INTO `threaded_messages` (`thread_id`, `message_id`, `user_email`, `message`, `textOrCode`, `createdon`) VALUES
(422, 253, 'cmuth001@odu.edu', 'gjhgjk', 0, '2017-11-18 16:32:35'),
(425, 268, 'cmuth001@odu.edu', 'asdsadfsdf', 0, '2017-11-19 20:02:32'),
(426, 279, 'cmuth001@odu.edu', 'var x = 5;      // Declare x, give it the value of 5\r\nvar y = x + 2;\r\n', 1, '2017-11-19 22:28:38'),
(427, 279, 'npabb001@odu.edu', 'hello', 0, '2017-11-20 00:37:46'),
(428, 279, 'npabb001@odu.edu', 'http://qav2.cs.odu.edu/chandu/web-programming/index.php?channel=1#scrollBottom', 0, '2017-11-20 00:38:03'),
(429, 285, 'mater@rsprings.gov', 'sadfsfsdf', 0, '2017-11-20 05:58:13'),
(430, 280, 'cmuth001@odu.edu', '1', 0, '2017-11-20 07:07:09'),
(431, 280, 'cmuth001@odu.edu', '2', 0, '2017-11-20 07:07:12'),
(432, 280, 'cmuth001@odu.edu', '3', 0, '2017-11-20 07:07:18'),
(433, 280, 'cmuth001@odu.edu', '4', 0, '2017-11-20 07:07:25'),
(434, 280, 'cmuth001@odu.edu', '5', 0, '2017-11-20 07:07:28'),
(435, 280, 'cmuth001@odu.edu', '6', 0, '2017-11-20 07:07:31'),
(436, 280, 'cmuth001@odu.edu', '7', 0, '2017-11-20 07:07:35'),
(437, 286, 'mater@rsprings.gov', 'He is amazing', 0, '2017-11-20 16:43:51'),
(438, 285, 'mater@rsprings.gov', 'checking rating ....', 0, '2017-11-20 16:55:41'),
(439, 302, 'mater@rsprings.gov', '', 1, '2017-11-20 21:24:24'),
(440, 301, 'cmuth001@odu.edu', '', 1, '2017-11-20 21:50:14'),
(441, 301, 'cmuth001@odu.edu', 'dadsad', 0, '2017-11-20 21:57:32'),
(442, 301, 'cmuth001@odu.edu', 'asdada', 1, '2017-11-20 21:57:53');

-- --------------------------------------------------------

--
-- Table structure for table `userChannels`
--

CREATE TABLE IF NOT EXISTS `userChannels` (
  `user_email` varchar(50) NOT NULL,
  `channel_id` int(10) NOT NULL,
  `channel_name` varchar(200) NOT NULL DEFAULT 'empty',
  `isPublic` tinyint(1) NOT NULL DEFAULT '0',
  `join_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `starred` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userChannels`
--

INSERT INTO `userChannels` (`user_email`, `channel_id`, `channel_name`, `isPublic`, `join_time`, `starred`) VALUES
('chinga@cars.com', 1, 'general', 0, '2017-10-27 01:36:18', 0),
('chinga@cars.com', 2, 'random', 0, '2017-10-27 01:36:18', 0),
('chinga@cars.com', 64, 'privateChannel', 1, '2017-10-31 06:42:25', 0),
('chinga@cars.com', 66, 'public channel testi', 0, '2017-11-02 11:23:54', 0),
('chinga@cars.com', 67, 'empty', 0, '2017-11-05 08:12:59', 0),
('cmuth001@odu.edu', 1, 'general', 0, '2017-10-31 01:48:07', 0),
('cmuth001@odu.edu', 2, 'random', 0, '2017-10-31 01:48:07', 0),
('cmuth001@odu.edu', 64, 'privateChannel', 1, '2017-10-31 06:42:25', 0),
('hornet@rsprings.gov', 1, 'general', 0, '2017-10-27 01:36:40', 0),
('hornet@rsprings.gov', 2, 'random', 0, '2017-10-27 01:36:40', 0),
('hornet@rsprings.gov', 64, 'empty', 0, '2017-10-31 15:25:22', 0),
('kachow@rusteze.com', 1, 'general', 0, '2017-10-27 01:37:01', 0),
('kachow@rusteze.com', 2, 'random', 0, '2017-10-27 01:37:23', 0),
('kachow@rusteze.com', 64, 'empty', 0, '2017-10-31 15:18:37', 0),
('mater@rsprings.gov', 1, 'general', 0, '2017-10-27 01:37:41', 0),
('mater@rsprings.gov', 2, 'random', 0, '2017-10-27 01:37:41', 0),
('mater@rsprings.gov', 64, 'empty', 0, '2017-10-31 15:27:04', 0),
('mater@rsprings.gov', 67, 'new private channel-2', 1, '2017-11-05 08:12:20', 0),
('npabb001@odu.edu', 1, 'general', 0, '2017-10-27 01:38:00', 0),
('npabb001@odu.edu', 2, 'random', 0, '2017-10-27 01:38:00', 0),
('npabb001@odu.edu', 66, 'public channel testi', 0, '2017-11-02 11:23:54', 0),
('porsche@rsprings.gov', 1, 'general', 0, '2017-10-27 01:38:22', 0),
('porsche@rsprings.gov', 2, 'random', 0, '2017-10-27 01:38:22', 0),
('skand001@odu.edu', 1, 'general', 0, '2017-10-27 01:38:42', 0),
('skand001@odu.edu', 2, 'random', 0, '2017-10-27 01:38:42', 0),
('topsecret@agent.org', 1, 'general', 0, '2017-10-27 01:38:58', 0),
('topsecret@agent.org', 2, 'random', 0, '2017-10-27 01:38:58', 0);

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
  `display_pic` varchar(50) NOT NULL DEFAULT 'no pic',
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
('chinga@cars.com', 'Chick Hicks', 'Chick Hicks', 'Available', 0, '', '', '@chick', 0, '', '2017-10-29 23:05:07'),
('cmuth001@odu.edu', 'chandu muthyala', 'cmuth001', 'Interested in web-programming', 0, '', '', '@cmuth001', 0, '', '2017-10-29 23:11:54'),
('hornet@rsprings.gov', 'Doc Hudson', 'Doc Hudson', 'Available', 0, '', '', '@doc', 0, '', '2017-10-29 23:05:07'),
('kachow@rusteze.com', 'Lightning McQueen', 'Lightning McQueen', 'Available', 0, '', '', '@mcqueen', 0, '', '2017-10-29 23:05:07'),
('mater@rsprings.gov', 'Tow Mater', 'Tow Mater', 'Available', 0, '', '', '@mater', 0, '', '2017-10-29 23:05:07'),
('mchandrasekharreddym@gmail.com', 'chandu', 'chandu', 'Available', 0, 'no pic', 'bio', 'asdf', 0, 'skype id', '2017-10-29 23:05:07'),
('npabb001@odu.edu', 'Vamsi', 'Vamsi', 'Available', 0, '', '', 'Neutral@123', 0, '', '2017-10-29 23:05:07'),
('porsche@rsprings.gov', 'Sally Carrera', 'Sally Carrera', 'Available', 0, '', '', '@sally', 0, '', '2017-10-29 23:05:07'),
('skand001@odu.edu', 'yashkandukuri', 'whaike', 'Available', 0, '', '', 'She3ple!', 0, '', '2017-10-29 23:05:07'),
('topsecret@agent.org', 'Finn McMissile', 'Finn McMissile', 'Available', 0, '', '', '@mcmissile', 0, '', '2017-10-29 23:05:07');

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
  MODIFY `channel_id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `channel_messages`
--
ALTER TABLE `channel_messages`
  MODIFY `cmessage_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=305;
--
-- AUTO_INCREMENT for table `channel_message_reaction`
--
ALTER TABLE `channel_message_reaction`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=296;
--
-- AUTO_INCREMENT for table `emojis`
--
ALTER TABLE `emojis`
  MODIFY `emoji_id` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
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
-- AUTO_INCREMENT for table `threaded_messages`
--
ALTER TABLE `threaded_messages`
  MODIFY `thread_id` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=443;
--
-- Constraints for dumped tables
--

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
