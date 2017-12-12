-- phpMyAdmin SQL Dump
-- version 4.4.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 12, 2017 at 11:55 AM
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
('npabb001@odu.edu', 'Neutral@123', 'vamsi', 'vamsi');

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
(1, 'general', 'all general messages', 'cmuth001@odu.edu', '2017-12-12 16:54:47', 0, 0),
(2, 'random', 'random messages', 'cmuth001@odu.edu', '2017-11-24 19:49:27', 0, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `channel_messages`
--

INSERT INTO `channel_messages` (`cmessage_id`, `channel_id`, `cuser_email`, `channel_message`, `has_thread`, `textOrCode`, `cmsg_timestamp`) VALUES
(124, 1, 'cmuth001@odu.edu', ' https://vignette.wikia.nocookie.net/disney/images/c/c0/Mack.png/revision/latest?cb=20151213154902', 1, 0, '2017-12-12 16:32:55'),
(125, 1, 'cmuth001@odu.edu', 'https://vignette.wikia.nocookie.net/disney/images/c/c0/Mack.png/revision/latest?cb=20151213154902', 0, 2, '2017-12-12 08:13:06'),
(126, 1, 'cmuth001@odu.edu', 'https://vignette.wikia.nocookie.net/disney/images/c/c0/Mack.png/revision/latest?cb=20151213154902', 0, 2, '2017-12-12 08:14:05');

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
) ENGINE=InnoDB AUTO_INCREMENT=587 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `channel_message_reaction`
--

INSERT INTO `channel_message_reaction` (`id`, `message_id`, `user_email`, `emoji_id`, `createdon`) VALUES
(585, 124, 'cmuth001@odu.edu', 2, '2017-12-12 16:48:20'),
(586, 125, 'cmuth001@odu.edu', 2, '2017-12-12 16:48:58');

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
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `direct_message`
--

INSERT INTO `direct_message` (`directmsg_id`, `from_email`, `to_email`, `direct_message`, `textOrCode`, `dm_timestamp`) VALUES
(117, 'cmuth001@odu.edu', 'chinga@cars.com', 'https://vignette.wikia.nocookie.net/disney/images/c/c0/Mack.png/revision/latest?cb=20151213154902', 2, '2017-12-12 08:14:24');

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
-- Table structure for table `gitUser`
--

CREATE TABLE IF NOT EXISTS `gitUser` (
  `id` int(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `path` varchar(200) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gitUser`
--

INSERT INTO `gitUser` (`id`, `email`, `path`, `timestamp`) VALUES
(0, 'cmuth001', 'https://avatars0.githubusercontent.com/u/31596312?v=4', '2017-12-11 21:17:54');

-- --------------------------------------------------------

--
-- Table structure for table `gravatar`
--

CREATE TABLE IF NOT EXISTS `gravatar` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `path` varchar(200) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gravatar`
--

INSERT INTO `gravatar` (`id`, `email`, `path`, `timestamp`) VALUES
(1, 'cmuth001@odu.edu', 'https://www.gravatar.com/avatar/6cc9724a530a26f625b93e6d7962bbea', '2017-11-01 04:00:00'),
(4, 'chinga@cars.com', 'https://www.gravatar.com/avatar/2a4237a9a1676a06923482291c63de8f', '2017-11-30 15:36:14'),
(5, 'npabb001@odu.edu', 'https://www.gravatar.com/avatar/3f7a4cd53ba01ed46c816c5cefc5c8db', '2017-11-30 16:01:03'),
(15, 'skand001@odu.edu', 'https://www.gravatar.com/avatar/2fc128b9692b6a54dbdf68fd33eac970?s=40&r=g', '2017-12-12 06:00:32');

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
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=latin1;

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
(23, 'mater@rsprings.gov', '2017-12-09 11:36:55'),
(24, 'cmuth001@odu.edu', '2017-12-09 17:58:35'),
(25, 'mater@rsprings.gov', '2017-12-09 20:49:03'),
(26, 'mater@rsprings.gov', '2017-12-09 20:49:31'),
(27, 'mater@rsprings.gov', '2017-12-10 00:55:10'),
(28, 'mater@rsprings.gov', '2017-12-10 14:00:44'),
(29, 'cmuth001@odu.edu', '2017-12-10 18:46:07'),
(30, 'cmuth001@odu.edu', '2017-12-10 23:33:20'),
(31, 'mater@rsprings.gov', '2017-12-11 11:29:14'),
(33, 'cmuth001', '2017-12-11 16:49:13'),
(34, 'cmuth001', '2017-12-11 16:59:53'),
(35, 'cmuth001', '2017-12-11 17:01:01'),
(36, 'cmuth001', '2017-12-11 17:01:53'),
(37, 'cmuth001', '2017-12-11 17:02:00'),
(38, 'cmuth001', '2017-12-11 17:02:21'),
(39, 'cmuth001', '2017-12-11 17:02:29'),
(40, 'cmuth001', '2017-12-11 17:02:34'),
(41, 'cmuth001', '2017-12-11 17:02:40'),
(42, 'cmuth001', '2017-12-11 17:02:42'),
(43, 'cmuth001', '2017-12-11 17:14:21'),
(44, 'cmuth001', '2017-12-11 18:32:53'),
(45, 'cmuth001@odu.edu', '2017-12-11 18:34:42'),
(46, 'cmuth001@odu.edu', '2017-12-11 20:07:59'),
(47, 'mater@rsprings.gov', '2017-12-11 20:28:37'),
(48, 'skand001@odu.edu', '2017-12-11 20:33:45'),
(49, '', '2017-12-11 20:34:17'),
(50, 'skand001@odu.edu', '2017-12-11 20:58:59'),
(51, 'cmuth001', '2017-12-11 22:44:23'),
(52, 'cmuth001@odu.edu', '2017-12-11 22:46:25'),
(53, 'skand001@odu.edu', '2017-12-11 22:57:48'),
(54, 'skand001@odu.edu', '2017-12-11 23:26:48'),
(55, 'yashkandukuri', '2017-12-11 23:30:50'),
(56, 'yashkandukuri', '2017-12-11 23:31:13'),
(57, 'yashkandukuri', '2017-12-11 23:31:44'),
(58, 'yashkandukuri', '2017-12-11 23:31:52'),
(59, 'yashkandukuri', '2017-12-11 23:34:45'),
(60, 'yashkandukuri', '2017-12-11 23:41:29'),
(61, 'mater@rsprings.gov', '2017-12-12 00:08:33'),
(62, 'mater@rsprings.gov', '2017-12-12 00:09:46'),
(63, 'mater@rsprings.gov', '2017-12-12 00:10:50'),
(64, 'skand001@odu.edu', '2017-12-12 00:11:12'),
(65, 'yashkandukuri', '2017-12-12 00:11:49'),
(66, 'mater@rsprings.gov', '2017-12-12 00:12:09'),
(67, 'mater@rsprings.gov', '2017-12-12 00:14:26'),
(68, 'mater@rsprings.gov', '2017-12-12 00:14:39'),
(69, 'mater@rsprings.gov', '2017-12-12 00:15:18'),
(70, 'mater@rsprings.gov', '2017-12-12 00:16:24'),
(71, 'mater@rsprings.gov', '2017-12-12 00:17:45'),
(72, 'mater@rsprings.gov', '2017-12-12 00:18:38'),
(73, 'mater@rsprings.gov', '2017-12-12 00:21:32'),
(74, 'mater@rsprings.gov', '2017-12-12 00:23:29'),
(75, 'cmuth001@odu.edu', '2017-12-12 00:30:36'),
(76, 'cmuth001@odu.edu', '2017-12-12 00:31:59'),
(77, 'yashkandukuri', '2017-12-12 00:34:04'),
(78, 'skand001@odu.edu', '2017-12-12 00:35:55'),
(79, 'skand001@odu.edu', '2017-12-12 01:03:55'),
(80, 'skand001@odu.edu', '2017-12-12 01:04:27'),
(81, '', '2017-12-12 01:20:01'),
(82, '', '2017-12-12 01:20:19'),
(83, '', '2017-12-12 01:26:18'),
(84, '', '2017-12-12 01:26:57'),
(85, '', '2017-12-12 01:30:24'),
(86, '', '2017-12-12 01:31:44'),
(87, 'cmuth001@odu.edu', '2017-12-12 01:50:55'),
(88, 'cmuth001@odu.edu', '2017-12-12 02:07:31'),
(89, 'npabb001@odu.edu', '2017-12-12 02:23:13'),
(90, 'cmuth001@odu.edu', '2017-12-12 03:07:12'),
(91, 'cmuth001@odu.edu', '2017-12-12 11:32:32');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int(10) NOT NULL,
  `message` varchar(10000) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=559 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `threaded_messages`
--

INSERT INTO `threaded_messages` (`thread_id`, `message_id`, `user_email`, `message`, `textOrCode`, `createdon`) VALUES
(556, 124, 'cmuth001@odu.edu', 'ads', 0, '2017-12-12 16:32:55'),
(557, 124, 'cmuth001@odu.edu', 'adas', 0, '2017-12-12 16:32:58'),
(558, 124, 'cmuth001@odu.edu', 'asdas', 0, '2017-12-12 16:32:59');

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
('chinga@cars.com', 1, '2017-10-27 01:36:18', 0),
('chinga@cars.com', 2, '2017-10-27 01:36:18', 0),
('cmuth001@odu.edu', 1, '2017-10-31 01:48:07', 0),
('cmuth001@odu.edu', 2, '2017-10-31 01:48:07', 0),
('mater@rsprings.gov', 1, '2017-10-27 01:37:41', 0),
('mater@rsprings.gov', 2, '2017-10-27 01:37:41', 0),
('npabb001@odu.edu', 1, '2017-10-27 01:38:00', 0),
('npabb001@odu.edu', 2, '2017-10-27 01:38:00', 0),
('skand001@odu.edu', 1, '2017-12-12 06:00:32', 0),
('skand001@odu.edu', 2, '2017-12-12 06:00:32', 0);

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
  `password` varchar(20) DEFAULT NULL,
  `phone_no` int(13) NOT NULL DEFAULT '1234567890',
  `isSecure` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=default,1=2FA',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `user_name`, `display_name`, `status`, `mode_id`, `display_pic`, `description`, `password`, `phone_no`, `isSecure`, `timestamp`) VALUES
('chinga@cars.com', 'Chick Hicks', 'Chick Hicks', 'Available', 0, '0', '', '@chick', 0, 0, '2017-11-30 15:27:59'),
('cmuth001@odu.edu', 'chandu muthyala', 'cmuth001', 'Interested in web-programming', 0, '0', '', '@cmuth001', 0, 0, '2017-12-12 08:52:35'),
('mater@rsprings.gov', 'Tow Mater', 'Tow Mater', 'Available', 0, '0', '', '@mater', 0, 1, '2017-12-12 06:39:52'),
('npabb001@odu.edu', 'Vamsi', 'Vamsi', 'Available', 0, '0', '', 'Neutral@123', 0, 0, '2017-12-01 18:25:43'),
('skand001@odu.edu', 'Chosen 1', 'Chosen 1', 'Available', 0, '0', 'bio', 'asdf', 1234567890, 0, '2017-12-12 06:05:17');

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
-- Indexes for table `gitUser`
--
ALTER TABLE `gitUser`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `cmessage_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=127;
--
-- AUTO_INCREMENT for table `channel_message_reaction`
--
ALTER TABLE `channel_message_reaction`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=587;
--
-- AUTO_INCREMENT for table `direct_message`
--
ALTER TABLE `direct_message`
  MODIFY `directmsg_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=118;
--
-- AUTO_INCREMENT for table `emojis`
--
ALTER TABLE `emojis`
  MODIFY `emoji_id` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gravatar`
--
ALTER TABLE `gravatar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `invite_user`
--
ALTER TABLE `invite_user`
  MODIFY `invite_id` bigint(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `loginActivityLog`
--
ALTER TABLE `loginActivityLog`
  MODIFY `logId` bigint(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `threaded_messages`
--
ALTER TABLE `threaded_messages`
  MODIFY `thread_id` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=559;
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
