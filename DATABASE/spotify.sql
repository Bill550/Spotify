-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2020 at 11:17 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spotify`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `artist` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `artworkPath` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `title`, `artist`, `genre`, `artworkPath`) VALUES
(1, 'Singles', 1, 6, 'Assets/Images/artwork/jimmyKhan.jpg'),
(2, 'Pindi Aye', 2, 11, 'Assets/Images/artwork/Pindiboys.jpg'),
(3, 'Falling', 3, 5, 'Assets/Images/artwork/Falling.jpg'),
(4, 'Climate Change', 4, 11, 'Assets/Images/artwork/pitbull.jpg'),
(5, 'Havana', 6, 8, 'Assets/Images/artwork/Havana.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `name`) VALUES
(1, 'Jimmy Khan'),
(2, 'Pindi Boys'),
(3, 'Trevor Daniel'),
(4, 'Pitbull'),
(6, 'Camila Cabello');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Contemporary R&B'),
(2, 'POP'),
(3, 'HipHop'),
(4, 'Rock '),
(5, 'Dubstep'),
(6, 'Country '),
(7, 'Techno'),
(8, 'Jazz'),
(9, 'Electronic '),
(10, 'folk '),
(11, 'Rapper'),
(12, 'Instrumental'),
(13, 'Heavy Metal'),
(14, 'Rhythm And Blues'),
(15, 'Soul ');

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `owner` varchar(50) NOT NULL,
  `dateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`id`, `name`, `owner`, `dateCreated`) VALUES
(1, 'my 1st playlist', 'MuhammadBilal005', '2020-04-29 00:00:00'),
(2, '2nd playlist', 'MuhammadBilal005', '2020-04-29 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `playlistsongs`
--

CREATE TABLE `playlistsongs` (
  `id` int(11) NOT NULL,
  `songId` int(11) NOT NULL,
  `playlistId` int(11) NOT NULL,
  `playlistOrder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `playlistsongs`
--

INSERT INTO `playlistsongs` (`id`, `songId`, `playlistId`, `playlistOrder`) VALUES
(1, 4, 1, 1),
(8, 6, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `artist` int(11) NOT NULL,
  `album` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `duration` varchar(8) NOT NULL,
  `path` varchar(500) NOT NULL,
  `albumOrder` int(11) NOT NULL,
  `plays` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `title`, `artist`, `album`, `genre`, `duration`, `path`, `albumOrder`, `plays`) VALUES
(1, 'Haye Dil Bechara', 1, 1, 6, '02:26', 'Assets/music/Haye Dil Bechara.mp3', 1, 28),
(2, 'Pindi Aye', 2, 2, 11, '06:57', 'Assets/music/Pindi Aye (feat. Hashim Nawaz, Khawar Malik, Fadi, Osama Com Laude, Hamzee, Shuja Shah & Zeeru).mp3', 2, 35),
(3, 'Falling', 3, 3, 5, '02:39', 'Assets/music/Trevor Daniel - Falling.mp3', 3, 30),
(4, 'We Are Strong', 4, 4, 11, '03:38', 'Assets/music/Pitbull - We Are Strong.mp3', 1, 50),
(5, 'Havana', 6, 5, 8, '03:38', 'Assets/music/Camila Cabello - Havana.mp3', 5, 26),
(6, 'Pitbull - Rain Over Me ft. Marc Anthony', 4, 4, 8, '03:53', 'Assets/music/Pitbull - Rain Over Me ft. Marc Anthony.mp3', 2, 18),
(9, 'Pitbull, Fifth Harmony - Por Favor (Official Video)', 4, 4, 14, '03:33', 'Assets/music/Pitbull, Fifth Harmony - Por Favor (Official Video).mp3', 3, 14),
(10, 'Pitbull - Greenlight (Official Video) ft. Flo Rida  LunchMoney Lewis', 4, 4, 2, '04:26', 'Assets/music/Pitbull - Greenlight (Official Video) ft. Flo Rida  LunchMoney Lewis.mp3', 4, 24),
(11, 'Pitbull - Feel This Moment ft. Christina Aguilera', 4, 4, 13, '03:49', 'Assets/music/Pitbull - Feel This Moment ft. Christina Aguilera.mp3', 5, 19),
(12, 'Pitbull - Don\'t Stop The Party (Super Clean Version) ft. TJR', 4, 4, 4, '03:26', 'Assets/music/Pitbull - Don\'t Stop The Party (Super Clean Version) ft. TJR.mp3', 6, 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `signUpDate` datetime NOT NULL,
  `profilePic` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Username`, `FirstName`, `LastName`, `Email`, `Password`, `signUpDate`, `profilePic`) VALUES
(1, 'MuhammadBilal005', 'Muhammad', 'Bilal', 'Bilalsohail550@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2020-03-08 00:00:00', 'Assets/images/Profile-Pics/profile-user.png'),
(2, 'bill92005', 'Billo', 'Billy', 'Bill@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2020-03-08 00:00:00', 'Assets/images/Profile-Pics/profile-user.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlistsongs`
--
ALTER TABLE `playlistsongs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
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
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `playlistsongs`
--
ALTER TABLE `playlistsongs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
