-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 21, 2015 at 04:13 PM
-- Server version: 5.6.25-0ubuntu0.15.04.1
-- PHP Version: 5.6.4-4ubuntu6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `catalog`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE IF NOT EXISTS `author` (
`id` int(11) NOT NULL,
  `author` char(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `author`) VALUES
(2, 'King');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
`id` int(11) NOT NULL,
  `book` char(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `book`) VALUES
(4, '11/22/63'),
(2, 'Under');

-- --------------------------------------------------------

--
-- Table structure for table `bookauthor`
--

CREATE TABLE IF NOT EXISTS `bookauthor` (
`id` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `id_author` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `bookauthor`
--

INSERT INTO `bookauthor` (`id`, `id_book`, `id_author`) VALUES
(2, 2, 2),
(3, 2, 2),
(4, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `bookgenre`
--

CREATE TABLE IF NOT EXISTS `bookgenre` (
`id` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `id_genre` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `bookgenre`
--

INSERT INTO `bookgenre` (`id`, `id_book`, `id_genre`) VALUES
(2, 2, 2),
(3, 2, 3),
(4, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
`id` int(11) NOT NULL,
  `genre` char(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `genre`) VALUES
(3, 'Advantures'),
(4, 'Fantesy'),
(2, 'Horror');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
`id` int(11) NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `description`, `price`) VALUES
(2, 'Good book', 340),
(3, 'Good', 234),
(4, 'Hello', 125);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UNIQUE` (`author`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UNIQUE` (`book`);

--
-- Indexes for table `bookauthor`
--
ALTER TABLE `bookauthor`
 ADD PRIMARY KEY (`id`), ADD KEY `id_author` (`id_author`), ADD KEY `bookauthor_ibfk_2` (`id_book`);

--
-- Indexes for table `bookgenre`
--
ALTER TABLE `bookgenre`
 ADD PRIMARY KEY (`id`), ADD KEY `id_genre` (`id_genre`), ADD KEY `bookgenre_ibfk_1` (`id_book`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UNIQUE` (`genre`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `bookauthor`
--
ALTER TABLE `bookauthor`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `bookgenre`
--
ALTER TABLE `bookgenre`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookauthor`
--
ALTER TABLE `bookauthor`
ADD CONSTRAINT `bookauthor_ibfk_1` FOREIGN KEY (`id_author`) REFERENCES `author` (`id`),
ADD CONSTRAINT `bookauthor_ibfk_2` FOREIGN KEY (`id_book`) REFERENCES `book` (`id`);

--
-- Constraints for table `bookgenre`
--
ALTER TABLE `bookgenre`
ADD CONSTRAINT `bookgenre_ibfk_1` FOREIGN KEY (`id_book`) REFERENCES `book` (`id`),
ADD CONSTRAINT `bookgenre_ibfk_2` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
