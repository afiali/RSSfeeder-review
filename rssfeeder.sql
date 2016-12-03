-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2016 at 05:51 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rssfeeder`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL,
  `date_pub` date NOT NULL,
  `channel_id` int(11) NOT NULL,
  `voting_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `channel`
--

CREATE TABLE `channel` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `link` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `channel`
--

INSERT INTO `channel` (`id`, `title`, `link`, `description`, `category`) VALUES
(3, 'Star2.com » Music', 'http://www.star2.com/category/entertainment/music/feed/', 'Malaysia lifestyle, entertainment, culture, food, travel, health, family, living', 'music'),
(6, 'Star2.com » Movies', 'http://www.star2.com/category/entertainment/movies/feed/', 'the star main highlight about movie', 'movie'),
(7, 'Star2.com » Recipes', 'http://www.star2.com/category/food/recipes/feed/', 'Malaysia lifestyle, entertainment, culture, food, travel, health, family, living', 'recipes'),
(8, 'Star2.com » Style', 'http://www.star2.com/category/style/feed/', 'Malaysia lifestyle, entertainment, culture, food, travel, health, family, living', 'style'),
(9, 'Star2.com » Books', 'http://www.star2.com/category/culture/books/feed/', 'Malaysia lifestyle, entertainment, culture, food, travel, health, family, living', 'books'),
(10, 'Star2.com » Arts', 'http://www.star2.com/category/culture/arts/feed/', 'Malaysia lifestyle, entertainment, culture, food, travel, health, family, living', 'arts'),
(11, 'Star2.com » Fitness', 'http://www.star2.com/category/health/fitness/feed/', 'Malaysia lifestyle, entertainment, culture, food, travel, health, family, living', 'fitness'),
(12, 'Star2.com » Design', 'http://www.star2.com/category/culture/design/feed/', 'Malaysia lifestyle, entertainment, culture, food, travel, health, family, living', 'design');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `date_time` datetime NOT NULL,
  `comment` longtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `creon` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `gender`, `creon`) VALUES
(1, 'afi', 'ali', 'afi@ali.com', 'f021c5ef6d26265c6ccc8e438be88000', 60123456789, 'Male', '2016-11-09'),
(7, 'nusrah', 'anuar', 'reader.revweb@gmail.com', 'f021c5ef6d26265c6ccc8e438be88000', 60123456789, 'Female', '2016-11-14');

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `channel`
--
ALTER TABLE `channel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `channel`
--
ALTER TABLE `channel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
