-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2018 at 05:46 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

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
(1, 'Lunch Schedule', 'Tariq', 1541092058, 'We have redone the lunch schedule to include free money. Your welcome.', 1684, 3, 0),
(2, 'Corn Dog Day', 'Not Tariq', 1541098477, 'We have changed corn dog day to be only once a year because of the rising cost of corndogs\r\n', 14, 764, 434),
(3, 'STUCO Riots', 'Mr. Bussen ', 1541107436, 'There has been a recent rise of riots in priory on the subject of STUCO because of their recent decision to make corn dog day less common. From now on, any person who is not participating in at least one riot a week will be subject to an ISS. ', 9986, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `title` varchar(191) NOT NULL,
  `author` varchar(191) NOT NULL,
  `content` text NOT NULL,
  `date` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `title`, `author`, `content`, `date`, `post_id`) VALUES
(1, 'FIRST', 'John', 'FIRST TO COMMENT.', 1541109595, 1),
(2, 'I WANT NAMES!', 'Anonymous', 'This is too good to be true, I want names of all of the STUCO members that voted for this. What is their end goal here? These are the things we need answered!', 1541108671, 1),
(3, 'Good Job', 'Nick', 'This is why we elected you guys. Keep up the good work!', 1541108719, 1),
(4, 'Again', 'Anonymous', 'Does anyone remember the last time that STUCO did something good with the lunches (corndogs). Remember how that ended? That\'s right, very poorly. So it\'s only a matter of time before this ends the same way. I won\'t be made a fool of again!', 1541109373, 1),
(5, 'STUCO IS THE BEST', 'Fredrick', 'I love it when STUCO goes out of their way to benefit us, the people who really matter. Love you guys!', 1541109551, 1),
(6, 'FREE MONEY', 'Jimmy', 'This is a much needed change to the lunch schedule and I am glad that you guys finally realized it. This really adds a big selling point for visitors.', 1541108598, 1),
(7, 'SCREW YOU GUYS', 'Anonymous', 'I loved the corndogs, even if it was only once every three weeks. That was the best day. NONE OF YOU GUYS ARE GETTING RE-ELECTED!', 1541109772, 0),
(8, 'SCEW YOU', 'Anonymous', 'I loved corndog day, even if was only once a month, that was my favorite day. NONE OF YOU GUYS ARE GETTING RE-ELECTED!', 1541109840, 2),
(9, 'Good Job Mr. Bussen', 'George', 'I love your down to earth-ness Mr. Bussen', 1541109900, 3),
(10, 'test', 'test', 't', 1541117668, 4),
(11, 'test', 'the', 'system', 1541117768, 7);

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
(1, 'Bonfire', 'STUCO Member', 'Thank you for suggesting this Tariq. Although we would have preferred that you did not use such vulgar language next time. But, none the less, there will be a bonfire next Saturday at 6:00 P.M. so be there (or be square!)', '1542514358', 11);

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
(1, 'Title0', 'Author0', 'Content0', 1542504646),
(2, 'Title1', 'Author1', 'Content1', 1542504646),
(3, 'Title2', 'Author2', 'Content2', 1542504646),
(4, 'Title3', 'Author3', 'Content3', 1542504646),
(5, 'Title4', 'Author4', 'Content4', 1542504646),
(6, 'Title5', 'Author5', 'Content5', 1542504646),
(7, 'Title6', 'Author6', 'Content6', 1542504646),
(8, 'Title7', 'Author7', 'Content7', 1542504646),
(9, 'Title8', 'Author8', 'Content8', 1542504646),
(10, 'Title9', 'Author9', 'Content9', 1542504646),
(11, 'Bonfire', 'Tariq', 'I think that we should have a bonfire or two next trimester because everyone likes fire! If anyone disagree\'s with me then they can burn in hell because I am always right and everyone else is always wrong. Please upvote this so STUCO see\'s it.', 1541389526);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `profile` varchar(191) NOT NULL DEFAULT 'http://stuco.build/profile.png',
  `stuco` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `profile`, `stuco`) VALUES
(1, 'email@site.com', 'name1', '858e0cd5f5c73a0f2a6cc992fe5a2ccf9ab43c4fe19a060aac47454823f5c71c', 'http://stuco.build/profile.png', 1),
(2, 'email@example.site', 'name', '858e0cd5f5c73a0f2a6cc992fe5a2ccf9ab43c4fe19a060aac47454823f5c71c', 'http://stuco.build/profile.png', 0),
(3, 'email@test.com', 'test', 'ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb', 'http://stuco.build/profile.png', 0),
(4, 'tjassim@stlprioryschool.org', 'tjassim', '858e0cd5f5c73a0f2a6cc992fe5a2ccf9ab43c4fe19a060aac47454823f5c71c', 'http://stuco.build/profile.png', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ctask`
--
ALTER TABLE `ctask`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suggestion`
--
ALTER TABLE `suggestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
