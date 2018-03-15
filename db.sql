-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 15, 2018 at 11:58 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_members`
--

CREATE TABLE `blog_members` (
  `memberID` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_members`
--

INSERT INTO `blog_members` (`memberID`, `username`, `password`, `email`, `role`) VALUES
(2, 'pal', 'palash', 'pal@pal.com', 2),
(3, 'admin', 'admin', 'admin@admin.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `postID` int(11) UNSIGNED NOT NULL,
  `memberID` int(11) NOT NULL,
  `postTitle` varchar(255) DEFAULT NULL,
  `postDesc` text,
  `postCont` text,
  `postDate` datetime DEFAULT NULL,
  `thumbnail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`postID`, `memberID`, `postTitle`, `postDesc`, `postCont`, `postDate`, `thumbnail`) VALUES
(6, 3, 'Photo1', '<p>BMW</p>', '<p>BMW123</p>\r\n<p>&nbsp;</p>\r\n<p>wgsgd</p>\r\n<p>gwgsdf</p>\r\n<p>&nbsp;</p>\r\n<p>efsgvsvs</p>\r\n<p>grs</p>', '2018-03-02 20:21:32', 'uploads/BMW-4-series-gran-coupe-images-and-videos-1920x1200-11.jpg.asset.1487328156349.jpg'),
(7, 3, 'Demo 2', '<p>Home page description</p>', '<p>Specific page description</p>', '2018-03-04 13:41:16', 'uploads/photo.png'),
(8, 3, 'Admin Post 3', '<p>This is a description.</p>', '<p>This is the main content. It will only be visible in viewpost.php page.</p>', '2018-03-15 15:52:32', 'uploads/Screenshot from 2018-03-15 15-56-06.png'),
(9, 2, 'User Post1', '<p>User Desc 1</p>', '<p>User Content</p>', '2018-03-15 16:10:45', 'uploads/Screenshot from 2018-03-15 15-55-36.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_members`
--
ALTER TABLE `blog_members`
  ADD PRIMARY KEY (`memberID`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`postID`),
  ADD KEY `FK_MEM` (`memberID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_members`
--
ALTER TABLE `blog_members`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `postID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD CONSTRAINT `FK_MEM` FOREIGN KEY (`memberID`) REFERENCES `blog_members` (`memberID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
