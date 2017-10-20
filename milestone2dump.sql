-- phpMyAdmin SQL Dump
-- version 4.4.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 17, 2017 at 03:49 AM
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
-- Table structure for table `channels`
--

CREATE TABLE IF NOT EXISTS `channels` (
  `channel_id` int(20) NOT NULL,
  `channel_name` varchar(20) NOT NULL,
  `purpose` varchar(50) NOT NULL,
  `created_by_user_email` varchar(20) NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `access_specifiers` tinyint(1) NOT NULL,
  `channel_starred` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `channels`
--

INSERT INTO `channels` (`channel_id`, `channel_name`, `purpose`, `created_by_user_email`, `createdon`, `access_specifiers`, `channel_starred`) VALUES
(1, 'milestone-1', 'mileStone one tasks...', 'cmuth001@odu.edu', '2017-10-16 14:40:04', 1, 0),
(2, 'milestone-2', 'mileStone Two tasks...', 'cmuth001@odu.edu', '2017-10-16 14:40:16', 1, 0),
(3, 'general', 'General ideas...', 'cmuth001@odu.edu', '2017-10-01 04:00:00', 0, 0),
(4, 'random', 'Random ideas...', 'cmuth001@odu.edu', '2017-10-17 07:30:36', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `channel_messages`
--

CREATE TABLE IF NOT EXISTS `channel_messages` (
  `cmessage_id` int(10) NOT NULL,
  `channel_id` int(10) NOT NULL,
  `cuser_email` varchar(20) CHARACTER SET latin1 NOT NULL,
  `channel_message` text CHARACTER SET latin1 NOT NULL,
  `cmsg_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `channel_messages`
--

INSERT INTO `channel_messages` (`cmessage_id`, `channel_id`, `cuser_email`, `channel_message`, `cmsg_timestamp`) VALUES
(60, 1, 'chandu_muthyala', 'hai', '2017-10-09 02:58:54'),
(61, 2, 'chandu_muthyala', 'Mid way report...', '2017-10-09 02:59:53'),
(62, 2, 'chandu_muthyala', 'hi', '2017-10-09 03:40:17'),
(63, 2, 'chandu_muthyala', 'hhh', '2017-10-09 03:40:27'),
(64, 2, 'chandu_muthyala', 'I''m happy !!!', '2017-10-09 04:25:50'),
(65, 1, 'chandu_muthyala', 'Dinchak Pooja :P ', '2017-10-10 02:52:09'),
(66, 2, 'chandu_muthyala', 'hiiiii', '2017-10-10 22:02:37'),
(67, 2, 'chandu_muthyala', 'yfy', '2017-10-10 22:03:32'),
(68, 1, 'chandu_muthyala', '<!-- hello-->', '2017-10-10 22:42:49'),
(69, 1, 'chandu_muthyala', 'hi varsha', '2017-10-11 15:28:57'),
(70, 2, 'chandu_muthyala', 'this is channel 2', '2017-10-11 15:29:15'),
(71, 1, 'chandu_muthyala', 'hi nandit', '2017-10-12 04:26:02'),
(72, 1, '', 'hi', '2017-10-14 04:58:18'),
(73, 1, 'chandu_muthyala', 'hello', '2017-10-15 01:39:36'),
(74, 2, 'chandu_muthyala', 'hi bro', '2017-10-15 01:41:14'),
(75, 1, 'chandu_muthyala', 'hi', '2017-10-16 03:07:04'),
(76, 2, 'chandu_muthyala', '<!-- hello -->', '2017-10-16 14:56:06'),
(77, 0, 'chandu_muthyala', '&lt;!-- hello --&gt;', '2017-10-16 20:10:25'),
(78, 1, 'chandu_muthyala', '&lt;!-- hello --&gt;', '2017-10-16 20:10:54'),
(79, 1, 'chandu_muthyala', '&lt;a&gt;hello&lt;/a&gt;', '2017-10-16 20:11:11'),
(80, 1, 'chandu_muthyala', 'Im there !', '2017-10-16 20:11:50'),
(81, 1, 'chandu_muthyala', 'I''m here', '2017-10-16 20:15:24'),
(82, 1, 'chandu_muthyala', '<a>', '2017-10-16 20:21:26'),
(83, 1, 'chandu_muthyala', 'hey ... I''m here', '2017-10-16 20:21:41'),
(84, 1, 'chandu_muthyala', '"\\ = / < > ! @ # $ % & * ( ) _ - + +"', '2017-10-16 20:22:13'),
(85, 1, 'chandu_muthyala', '@lt', '2017-10-16 20:22:22'),
(86, 1, 'chandu_muthyala', 'Jane & ''Tarzan''', '2017-10-16 20:23:18'),
(87, 1, 'chandu_muthyala', '[\\x00\\x0A\\x0D\\x1A\\x22\\x27\\x5C]', '2017-10-16 20:24:55'),
(88, 2, 'chandu_muthyala', '<!-- hello -->', '2017-10-16 20:49:28'),
(89, 2, 'chandu_muthyala', '~!@#$%&^&**()_+{}":?:>M<', '2017-10-16 20:51:06'),
(90, 2, 'chandu_muthyala', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa222222222222222222222222222222222222222222222qqqqqqqqqqqqqqqqqqqqqqqqqqqqaaaaaaaaaaaaaaxxxxx', '2017-10-16 20:56:05'),
(91, 2, 'chandu_muthyala', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa222222222222222222222222222222222222222222222qqqqqaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa222222222222222222222222222222222222222222222qqqqqaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa222222222222222222222222222222222222222222222qqqqqaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa222222222222222222222222222222222222222222222qqqqqgggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg', '2017-10-16 20:56:32'),
(92, 2, 'chandu_muthyala', 'hey ', '2017-10-16 21:06:26'),
(93, 2, 'chandu_muthyala', 'hello', '2017-10-16 21:07:21'),
(94, 1, 'chandu_muthyala', 'this is awsome', '2017-10-16 21:07:38'),
(95, 1, 'chandu_muthyala', 'yup', '2017-10-16 22:29:04'),
(96, 2, 'chandu_muthyala', 'hi ''m', '2017-10-16 23:27:45'),
(97, 1, 'chandu_muthyala', 'hello', '2017-10-17 02:34:49'),
(98, 1, 'chandu_muthyala', 'Yoo', '2017-10-17 06:25:32');

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
-- Table structure for table `register`
--

CREATE TABLE IF NOT EXISTS `register` (
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `display_name` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`email`, `password`, `user_name`, `display_name`) VALUES
('mater@rsprings.gov', '@mater', 'Tow Mater', 'Tow Mater'),
('porsche@rsprings.gov', '@sally', 'Sally Carrera', 'Sally Carrera'),
('hornet@rsprings.gov', '@doc', 'Doc Hudson', 'Doc Hudson'),
('topsecret@agent.org', '@mcmissile', 'Finn McMissile', 'Finn McMissile'),
('kachow@rusteze.com', '@mcqueen', 'Lightning McQueen', 'Lightning McQueen'),
('chinga@cars.com', '@chick', 'Chick Hicks', 'Chick Hicks'),
('cmuth001@odu.edu', '@cmuth001', 'chandu_muthyala', 'chandu_muthyala'),
('npabb001@odu.edu', 'Neutral@123', 'vamsi', 'vamsi'),
('skand001@odu.edu', 'She3ple!', 'yashkandukuri', 'whaike');

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
-- Table structure for table `userChannels`
--

CREATE TABLE IF NOT EXISTS `userChannels` (
  `id` int(10) NOT NULL,
  `user_email` varchar(20) NOT NULL,
  `channel_id` int(10) NOT NULL,
  `channel_name` varchar(20) NOT NULL,
  `join_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `starred` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userChannels`
--

INSERT INTO `userChannels` (`id`, `user_email`, `channel_id`, `channel_name`, `join_time`, `starred`) VALUES
(1, 'mater@rsprings.gov', 1, 'milestone-1', '2017-10-17 07:19:19', 0),
(2, 'chinga@cars.com', 1, 'milestone-1', '2017-10-17 07:19:22', 0),
(3, 'cmuth001@odu.edu', 1, 'milestone-1', '2017-10-17 07:19:25', 0),
(4, 'cmuth001@odu.edu', 2, 'milestone-2', '2017-10-17 07:19:31', 0),
(5, 'mater@rsprings.gov', 2, 'milestone-2', '2017-10-17 07:19:35', 0),
(6, 'skand001@odu.edu', 1, 'milestone-1', '2017-10-17 07:26:40', 0),
(7, 'npabb001@odu.edu', 2, 'milestone-2', '2017-10-17 07:26:46', 0),
(8, 'skand001@odu.edu', 3, 'general', '2017-10-01 04:00:00', 0),
(9, 'cmuth001@odu.edu', 3, 'general', '2017-10-17 07:33:55', 0),
(10, 'skand001@odu.edu', 4, 'random', '2017-10-08 04:00:00', 0),
(11, 'npabb001@odu.edu', 4, 'random', '2017-10-01 04:00:00', 0),
(12, 'npabb001@odu.edu', 3, 'general', '2017-10-01 04:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `email` varchar(50) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `display_name` varchar(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  `mode_id` int(10) NOT NULL,
  `display_pic` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phone_no` int(13) NOT NULL,
  `skype_id` varchar(20) NOT NULL,
  `time_zone` datetime(6) NOT NULL,
  `ws_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `user_name`, `display_name`, `status`, `mode_id`, `display_pic`, `description`, `password`, `phone_no`, `skype_id`, `time_zone`, `ws_id`) VALUES
('cmuth001@odu.edu', 'cmuth001', 'chandu_muthyala', 'always be happy ', 1, 'my pic', 'do well', '@cmuth001', 757546418, 'cmuth001', '2017-09-26 00:00:00.000000', 1),
('mater@rsprings.gov', 'Tow Mater', 'Tow Mater', 'something interesting ', 1, 'my pic', 'this is so interesting', '@mater', 1757546418, 'asdf', '2017-09-26 00:00:00.000000', 1);

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
-- Indexes for table `channels`
--
ALTER TABLE `channels`
  ADD PRIMARY KEY (`channel_id`),
  ADD KEY `channel_id` (`channel_id`),
  ADD KEY `created_by_user_email` (`created_by_user_email`);

--
-- Indexes for table `channel_messages`
--
ALTER TABLE `channel_messages`
  ADD PRIMARY KEY (`cmessage_id`),
  ADD KEY `cuser_email` (`cuser_email`),
  ADD KEY `cuser_email_2` (`cuser_email`);

--
-- Indexes for table `direct_message`
--
ALTER TABLE `direct_message`
  ADD PRIMARY KEY (`directmsg_id`),
  ADD KEY `from_email` (`from_email`,`to_email`),
  ADD KEY `to_email` (`to_email`);

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
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD KEY `user_email` (`user_email`);

--
-- Indexes for table `userChannels`
--
ALTER TABLE `userChannels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_email`),
  ADD KEY `user_id_2` (`user_email`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`),
  ADD KEY `email` (`email`),
  ADD KEY `mode_id` (`mode_id`),
  ADD KEY `ws_id` (`ws_id`);

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
-- AUTO_INCREMENT for table `channel_messages`
--
ALTER TABLE `channel_messages`
  MODIFY `cmessage_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `userChannels`
--
ALTER TABLE `userChannels`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `channels`
--
ALTER TABLE `channels`
  ADD CONSTRAINT `channels_ibfk_1` FOREIGN KEY (`created_by_user_email`) REFERENCES `users` (`email`) ON UPDATE CASCADE;

--
-- Constraints for table `direct_message`
--
ALTER TABLE `direct_message`
  ADD CONSTRAINT `direct_message_ibfk_1` FOREIGN KEY (`to_email`) REFERENCES `users` (`email`) ON UPDATE CASCADE,
  ADD CONSTRAINT `direct_message_ibfk_2` FOREIGN KEY (`from_email`) REFERENCES `users` (`email`) ON UPDATE CASCADE;

--
-- Constraints for table `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
