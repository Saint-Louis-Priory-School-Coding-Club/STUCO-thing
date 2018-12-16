-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2018 at 05:52 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stuco`
--

-- --------------------------------------------------------

--
-- Table structure for table `bcomments`
--

CREATE TABLE `bcomments` (
  `id` int(11) NOT NULL,
  `title` varchar(191) NOT NULL,
  `author` varchar(191) NOT NULL,
  `content` text NOT NULL,
  `date` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(191) NOT NULL,
  `author` varchar(191) NOT NULL,
  `date` int(11) NOT NULL,
  `content` text NOT NULL,
  `upvote` int(11) NOT NULL DEFAULT '0',
  `downvote` int(11) NOT NULL DEFAULT '0',
  `reports` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `author`, `date`, `content`, `upvote`, `downvote`, `reports`) VALUES
(1, 'Sup', 'Me', 1544904486, 'I like to spell pizza like a sauce!', 1, 0, 0),
(2, 'test', 'sup', 1544909202, 'hello', 0, 0, 0),
(3, 'ARCH', 'sadfkas', 1544909330, 'lkafjsdlkf', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ctask`
--

CREATE TABLE `ctask` (
  `id` int(11) NOT NULL,
  `title` varchar(191) NOT NULL,
  `author` varchar(191) NOT NULL,
  `solution` text NOT NULL,
  `date` varchar(191) NOT NULL,
  `suggestion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctask`
--

INSERT INTO `ctask` (`id`, `title`, `author`, `solution`, `date`, `suggestion_id`) VALUES
(1, 'Bonfire', 'STUCO Member', 'That is a wonderful suggestion, we will indeed have a bonfire within the next couple of years! Sorry it took so long to respond.', '1544904460', 1);

-- --------------------------------------------------------

--
-- Table structure for table `suggestion`
--

CREATE TABLE `suggestion` (
  `id` int(11) NOT NULL,
  `title` varchar(191) NOT NULL,
  `author` varchar(191) NOT NULL,
  `content` text NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suggestion`
--

INSERT INTO `suggestion` (`id`, `title`, `author`, `content`, `date`) VALUES
(1, 'Bonfire', 'Tariq', 'I think that we should have a bonfire because that would be pretty sick!', 1543783566);

-- --------------------------------------------------------

--
-- Table structure for table `tcomments`
--

CREATE TABLE `tcomments` (
  `id` int(11) NOT NULL,
  `title` varchar(191) NOT NULL,
  `author` varchar(191) NOT NULL,
  `content` text NOT NULL,
  `date` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `flname` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `userdata` text NOT NULL,
  `profile` varchar(191) NOT NULL DEFAULT 'http://stuco.build/profile.png',
  `stuco` int(11) NOT NULL DEFAULT '0',
  `admin` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `flname`, `email`, `password`, `userdata`, `profile`, `stuco`, `admin`) VALUES
(1, 'Tariq Jassim', 'tjassim@stlprioryschool.org', '13dd4a9323285f63b3b506425f25acbba68876022801460a9995c0621dbe4af3', 'active=1,prevstuco=0,createdon=1544935314', 'http://stuco.build/profile.png', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bcomments`
--
ALTER TABLE `bcomments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ctask`
--
ALTER TABLE `ctask`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suggestion`
--
ALTER TABLE `suggestion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tcomments`
--
ALTER TABLE `tcomments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bcomments`
--
ALTER TABLE `bcomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ctask`
--
ALTER TABLE `ctask`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suggestion`
--
ALTER TABLE `suggestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tcomments`
--
ALTER TABLE `tcomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
