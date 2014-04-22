-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 22, 2014 at 12:14 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mydb`
--
CREATE DATABASE IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mydb`;

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE IF NOT EXISTS `achievements` (
  `id` mediumint(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `achievements`
--

INSERT INTO `achievements` (`id`, `title`, `description`, `image`) VALUES
(1, 'Your First Recipe', 'Create your first recipe.', 'achievement1.png'),
(3, 'Getting The Hang Of This', 'Create a total of 5 recipes.', 'achievement2.png'),
(4, 'Would You Like Frosting?', 'Create a total of 10 recipes.', 'achievement3.png'),
(5, 'What A Beautiful Cupcake!', 'Create 50 recipes', 'achievement4.png'),
(6, 'Fancy Cake', 'Create 100 recipes', 'achievement5.png'),
(7, 'Look At Those Layers!', 'Create 200 recipes', 'achievement6.png'),
(8, 'Even Your Mom Would Be Proud..', 'Create 400 recipes', 'achievement7.png'),
(9, 'Can You Cater My Wedding?', 'Create 800 recipes', 'achievement8.png'),
(10, 'My First Clip', 'Clip your first recipe. ', 'achievement9.png');

-- --------------------------------------------------------

--
-- Table structure for table `achievement_conditions`
--

CREATE TABLE IF NOT EXISTS `achievement_conditions` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `achievement_id` mediumint(3) NOT NULL,
  `type` enum('count','bool') NOT NULL,
  `object` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `achievement_conditions`
--

INSERT INTO `achievement_conditions` (`id`, `achievement_id`, `type`, `object`, `value`) VALUES
(1, 1, 'count', 'recipes', '1'),
(2, 3, 'count', 'recipes', '5'),
(3, 4, 'count', 'recipes', '10'),
(4, 5, 'count', 'recipes', '50'),
(5, 6, 'count', 'recipes', '100'),
(6, 7, 'count', 'recipes', '200'),
(7, 8, 'count', 'recipes', '400'),
(8, 9, 'count', 'recipes', '800'),
(9, 10, 'count', 'clips', '1');

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address_1` varchar(45) DEFAULT NULL,
  `address_2` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `zip` varchar(45) DEFAULT NULL,
  `lat` decimal(12,9) DEFAULT NULL,
  `long` decimal(12,9) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `authentications`
--

CREATE TABLE IF NOT EXISTS `authentications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `provider` varchar(50) DEFAULT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `access_token` text,
  `secret` text,
  `expires` int(11) DEFAULT '0',
  `refresh_token` varchar(255) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` text,
  `image` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `clips`
--

CREATE TABLE IF NOT EXISTS `clips` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `object_id` int(10) unsigned NOT NULL,
  `value` text,
  `created_on` timestamp NULL DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

CREATE TABLE IF NOT EXISTS `fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `templates_id` int(10) unsigned NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`,`templates_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE IF NOT EXISTS `ingredients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`, `value`, `image`, `description`) VALUES
(1, 'flour', 'Flour', 'flour.png', NULL),
(2, 'awesome', 'awesome', NULL, NULL),
(3, 'greatness', 'greatness', NULL, NULL),
(4, 'sugar', 'Sugar', 'sugar.png', NULL),
(5, 'corn', 'Corn', 'corn.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `objects`
--

CREATE TABLE IF NOT EXISTS `objects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `categories_id` int(11) DEFAULT NULL,
  `templates_id` int(10) unsigned DEFAULT NULL,
  `images` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `tags` text COMMENT 'each tag as a string concat by comma''s',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`,`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `objects`
--

INSERT INTO `objects` (`id`, `user_id`, `categories_id`, `templates_id`, `images`, `name`, `tags`, `created_on`, `modified_on`) VALUES
(13, 2, NULL, NULL, NULL, 'hry', 'test', '2014-03-26 18:10:24', NULL),
(14, 2, NULL, NULL, NULL, 'Crab Cake', 'cake, yummy, awesome', '2014-03-29 19:31:16', NULL),
(15, 0, NULL, NULL, NULL, 'Donuts', 'yummy, great, donut', '2014-04-06 16:43:54', NULL),
(16, 2, NULL, NULL, NULL, 'Donuts', 'yummy, great, donut', '2014-04-06 16:46:01', NULL),
(17, 2, NULL, NULL, NULL, 'Donuts with Sugar', 'yummy, great, donut', '2014-04-06 16:46:44', NULL),
(18, 2, NULL, NULL, NULL, 'French Bread', 'yummy, good', '2014-04-07 21:11:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `objects_has_fields`
--

CREATE TABLE IF NOT EXISTS `objects_has_fields` (
  `object_id` int(10) unsigned NOT NULL,
  `fields_id` int(10) unsigned NOT NULL,
  `value` text,
  PRIMARY KEY (`object_id`,`fields_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `object_images`
--

CREATE TABLE IF NOT EXISTS `object_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` int(10) unsigned NOT NULL,
  `users_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `extension` varchar(45) DEFAULT NULL,
  `size` varchar(45) DEFAULT NULL,
  `image_blob` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `object_images`
--

INSERT INTO `object_images` (`id`, `object_id`, `users_id`, `name`, `extension`, `size`, `image_blob`) VALUES
(1, 13, 2, '13', 'jpg', NULL, NULL),
(2, 18, 2, '18', 'jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `object_ingredients`
--

CREATE TABLE IF NOT EXISTS `object_ingredients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantity` decimal(7,2) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `object_ingredients`
--

INSERT INTO `object_ingredients` (`id`, `quantity`, `unit`, `ingredient_id`, `object_id`) VALUES
(1, '2.00', 'cups', 1, 14),
(2, '1.00', 'cup', 2, 14),
(3, '3.00', 'Tablespoons', 3, 14),
(4, '2.00', 'cups', 1, 16),
(5, '2.00', 'cups', 4, 17),
(6, '2.00', 'cups', 1, 18),
(7, '3.00', 'tablespoons', 5, 18),
(8, '1.00', 'pinch', 4, 18);

-- --------------------------------------------------------

--
-- Table structure for table `object_tags`
--

CREATE TABLE IF NOT EXISTS `object_tags` (
  `object_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`object_id`,`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `object_tags`
--

INSERT INTO `object_tags` (`object_id`, `tag_id`, `group_id`) VALUES
(8, 2, 2),
(8, 3, 2),
(8, 4, 2),
(9, 5, 3),
(9, 6, 3),
(10, 7, 4),
(10, 8, 4),
(14, 9, 5),
(14, 10, 5),
(14, 11, 5),
(15, 12, 6),
(15, 13, 6),
(15, 14, 6),
(16, 15, 7),
(16, 16, 7),
(16, 17, 7),
(17, 18, 8),
(17, 19, 8),
(17, 20, 8),
(18, 21, 9),
(18, 22, 9);

-- --------------------------------------------------------

--
-- Table structure for table `ranks`
--

CREATE TABLE IF NOT EXISTS `ranks` (
  `id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ranks`
--

INSERT INTO `ranks` (`id`, `title`, `description`) VALUES
(1, 'Short Order Chef', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `value` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `value`) VALUES
(1, 'what', 'what'),
(2, 'what', 'what'),
(3, ' why', ' why'),
(4, ' where', ' where'),
(5, 'test', 'test'),
(6, ' mctest', ' mctest'),
(7, 'tag', 'tag'),
(8, ' tagger', ' tagger'),
(9, 'cake', 'cake'),
(10, ' yummy', ' yummy'),
(11, ' awesome', ' awesome'),
(12, 'yummy', 'yummy'),
(13, ' great', ' great'),
(14, ' donut', ' donut'),
(15, 'yummy', 'yummy'),
(16, ' great', ' great'),
(17, ' donut', ' donut'),
(18, 'yummy', 'yummy'),
(19, ' great', ' great'),
(20, ' donut', ' donut'),
(21, 'yummy', 'yummy'),
(22, ' good', ' good');

-- --------------------------------------------------------

--
-- Table structure for table `tag_groups`
--

CREATE TABLE IF NOT EXISTS `tag_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tag_groups`
--

INSERT INTO `tag_groups` (`id`, `name`, `created_on`) VALUES
(1, 'hey', '2014-03-14 23:01:23'),
(2, 'hey', '2014-03-14 23:01:44'),
(3, 'test', '2014-03-24 21:25:19'),
(4, 'heyyyyyyy', '2014-03-24 22:19:12'),
(5, 'Crab Cake', '2014-03-29 19:31:16'),
(6, 'Donuts', '2014-04-06 16:43:54'),
(7, 'Donuts', '2014-04-06 16:46:01'),
(8, 'Donuts with Sugar', '2014-04-06 16:46:44'),
(9, 'French Bread', '2014-04-07 21:11:15');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE IF NOT EXISTS `templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `home_id` int(11) NOT NULL,
  `uuid` int(11) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `rank` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `avatar` varchar(255) DEFAULT NULL,
  `current_lat` decimal(12,9) DEFAULT NULL,
  `current_long` decimal(12,9) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `uuid_UNIQUE` (`uuid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `home_id`, `uuid`, `email`, `password`, `firstname`, `lastname`, `rank`, `avatar`, `current_lat`, `current_long`, `created_on`) VALUES
(1, 0, NULL, '', NULL, 'kevin', '', 1, NULL, NULL, NULL, NULL),
(2, 0, NULL, 'kevinak941@gmail.com', '0cc175b9c0f1b6a831c399e269772661', 'John', 'Catch', 1, '2.jpg', NULL, NULL, NULL),
(3, 0, NULL, 'a', 'a', 'Santa', 'Claws', 1, NULL, NULL, NULL, NULL),
(4, 0, NULL, 'aa', '0cc175b9c0f1b6a831c399e269772661', 'John', 'Cash', 1, NULL, NULL, NULL, NULL),
(5, 0, NULL, 'newguy', '0cc175b9c0f1b6a831c399e269772661', 'Market', 'Guy', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_achievements`
--

CREATE TABLE IF NOT EXISTS `user_achievements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_friends`
--

CREATE TABLE IF NOT EXISTS `user_friends` (
  `users_id_1` int(11) NOT NULL,
  `users_id_2` int(11) NOT NULL,
  `are_friends` tinyint(1) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`users_id_1`,`users_id_2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_stats`
--

CREATE TABLE IF NOT EXISTS `user_stats` (
  `user_id` int(11) NOT NULL,
  `recipes` mediumint(6) NOT NULL DEFAULT '0',
  `clips` mediumint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_stats`
--

INSERT INTO `user_stats` (`user_id`, `recipes`, `clips`) VALUES
(0, 0, 0),
(2, 1, 0),
(4, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
