-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2013 at 02:14 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ssd`
--

-- --------------------------------------------------------

--
-- Table structure for table `course_info`
--

CREATE TABLE IF NOT EXISTS `course_info` (
  `course_ID` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_time` varchar(255) NOT NULL,
  `teacher` varchar(255) NOT NULL,
  `rating` int(11) unsigned NOT NULL DEFAULT '2',
  `rateCount` int(10) unsigned NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Record course information ';

-- --------------------------------------------------------

--
-- Table structure for table `current_posts`
--

CREATE TABLE IF NOT EXISTS `current_posts` (
  `fb_ID` varchar(20) NOT NULL,
  `post_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `send_course_ID` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `recieve_course_ID` varchar(20) DEFAULT 'none',
  `PostID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`PostID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='the information at the mainPage' AUTO_INCREMENT=34 ;

--
-- Dumping data for table `current_posts`
--

INSERT INTO `current_posts` (`fb_ID`, `post_time`, `send_course_ID`, `state`, `recieve_course_ID`, `PostID`) VALUES
('123456789123456', '2013-06-03 14:58:20', 'B1234567', 'ready', 'none', 1),
('123456789569874', '2013-06-03 12:51:15', 'M8975428', 'ready', 'none', 18),
('123456789569874', '2013-05-25 09:42:15', 'B1234567', 'ready', 'B7654321', 32),
('123456789569874', '2013-05-25 13:33:06', 'B1234567', 'ready', 'B7654321', 33);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_name` varchar(20) NOT NULL,
  `fb_ID` varchar(20) NOT NULL,
  `right_point` int(11) NOT NULL DEFAULT '1',
  `ratedCourses` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`fb_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Record users'' information';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_name`, `fb_ID`, `right_point`, `ratedCourses`) VALUES
('詹肥肥', '123456789123456', 2, 'B1234567,B7654321'),
('詹肥肥3號', '123456789981234', 3, NULL),
('詹肥肥2號', '123456789987654', 1, 'B1234567,B1234888');

-- --------------------------------------------------------

--
-- Table structure for table `user_post_log`
--

CREATE TABLE IF NOT EXISTS `user_post_log` (
  `fb_ID` varchar(255) NOT NULL,
  `complete_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PostID` varchar(255) NOT NULL,
  `state` varchar(20) NOT NULL,
  PRIMARY KEY (`fb_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Record users'' log that was posted before';

--
-- Dumping data for table `user_post_log`
--

INSERT INTO `user_post_log` (`fb_ID`, `complete_time`, `PostID`, `state`) VALUES
('123456789123456', '2013-05-09 07:15:26', '1', 'ready');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
