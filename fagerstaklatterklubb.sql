-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 28 okt 2015 kl 06:59
-- Serverversion: 5.5.46-0ubuntu0.14.04.2
-- PHP-version: 5.5.9-1ubuntu4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `fagerstaklatterklubb`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `group_permission`
--

CREATE TABLE IF NOT EXISTS `group_permission` (
  `group_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  KEY `group_permission_ibfk_1` (`group_id`),
  KEY `group_permission_ibfk_2` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `login_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(16) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`login_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumpning av Data i tabell `login`
--

INSERT INTO `login` (`login_id`, `user_name`, `created`) VALUES
(1, 'admin', '2015-10-27 00:51:49'),
(2, 'admin', '2015-10-27 00:52:36'),
(3, 'admin', '2015-10-27 00:55:29'),
(4, 'admin', '2015-10-27 00:56:49'),
(5, 'admin', '2015-10-27 08:40:31'),
(6, 'admin', '2015-10-27 10:03:09'),
(7, 'admin', '2015-10-27 10:03:47'),
(8, 'admin', '2015-10-27 10:05:33'),
(9, 'admin', '2015-10-27 10:06:51'),
(10, 'admin', '2015-10-27 16:03:39'),
(11, 'admin', '2015-10-27 16:04:36'),
(12, 'admin', '2015-10-27 16:05:24'),
(13, 'admin', '2015-10-27 16:05:31'),
(14, 'admin', '2015-10-27 16:06:48'),
(15, 'admin', '2015-10-27 18:19:51'),
(16, 'admin', '2015-10-27 18:34:07'),
(17, 'admin', '2015-10-27 18:38:59'),
(18, 'admin', '2015-10-27 18:39:58'),
(19, 'admin', '2015-10-27 19:09:38'),
(20, 'admin', '2015-10-27 19:09:51'),
(21, 'admin', '2015-10-27 20:53:49'),
(22, 'admin', '2015-10-27 20:54:23'),
(23, 'admin', '2015-10-27 21:04:45'),
(24, 'admin', '2015-10-27 21:06:39'),
(25, 'admin', '2015-10-27 21:07:22'),
(26, 'admin', '2015-10-27 21:46:33'),
(27, 'admin', '2015-10-27 22:43:29'),
(28, 'admin', '2015-10-27 22:44:50'),
(29, 'admin', '2015-10-27 22:52:08'),
(30, 'admin', '2015-10-27 23:12:24'),
(31, 'admin', '2015-10-27 23:12:45'),
(32, 'admin', '2015-10-27 23:24:26'),
(33, 'admin', '2015-10-28 06:02:43'),
(34, 'admin', '2015-10-28 06:33:19'),
(35, 'admin', '2015-10-28 06:35:29'),
(36, 'admin', '2015-10-28 06:46:47');

-- --------------------------------------------------------

--
-- Tabellstruktur `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `page_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `header` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `content` text COLLATE utf8_swedish_ci NOT NULL,
  `author_name` varchar(30) COLLATE utf8_swedish_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=39 ;

--
-- Dumpning av Data i tabell `page`
--

INSERT INTO `page` (`page_id`, `header`, `content`, `author_name`, `slug`, `created`, `modified`) VALUES
(17, 'På gång', 'Det här är startsidan', 'admin', 'pa-gang', '2015-10-27 17:31:55', '2015-10-28 06:58:45'),
(36, 'Det här är en annan sida', 'Jajamensan', 'admin', 'det-har-ar-en-annan-sida', '2015-10-27 22:12:48', '2015-10-28 06:58:58');

-- --------------------------------------------------------

--
-- Tabellstruktur `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `permission_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_description` varchar(50) NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) COLLATE utf8_swedish_ci NOT NULL,
  `user_firstname` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `user_surname` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `user_token_hash` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=97 ;

--
-- Dumpning av Data i tabell `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_firstname`, `user_surname`, `user_password`, `user_token_hash`, `created`) VALUES
(96, 'admin', 'Super', 'Admin', '$2y$10$bk5fcfw4Vffoetp6JOvjhuT5xH/d.nfrISYp3vfq3uOCVmzLEmxCS', 'b49bccd4a611d330ec0836a791fcf35c274c0b64d3afb3dc776f4a4ea89132a38d544fc6058299ebe2ace6a1a2f237d9d42e640d3d51426805902cfa6a907ff5', '2015-10-27 00:50:41');

-- --------------------------------------------------------

--
-- Tabellstruktur `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `group_permission`
--
ALTER TABLE `group_permission`
  ADD CONSTRAINT `group_permission_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_permission_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`permission_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriktioner för tabell `user_group`
--
ALTER TABLE `user_group`
  ADD CONSTRAINT `user_group_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `user_group_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `group` (`group_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
