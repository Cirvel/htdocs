-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2023 at 01:52 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lithematics`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_contact`
--

CREATE TABLE `admin_contact` (
  `contact_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'Poster',
  `title` varchar(50) NOT NULL,
  `post_type` enum('suggestion','report','bug') NOT NULL,
  `content` text NOT NULL,
  `date_posted` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_contact`
--

INSERT INTO `admin_contact` (`contact_id`, `user_id`, `title`, `post_type`, `content`, `date_posted`) VALUES
(1, 3, '@moderator', '', '\'Barry Aberforth Cunningham III\' is violating the rules by: \r\nSimply swearing, this is obviously a christian website.', '2023-11-24');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'Poster',
  `mod_id` int(11) NOT NULL COMMENT 'Receiver',
  `content` text NOT NULL,
  `date_posted` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `user_id`, `mod_id`, `content`, `date_posted`) VALUES
(1, 3, 1, 'Thank you for the mod', '2023-11-24'),
(2, 2, 5, 'AMERICA, H*CK YEAH!', '2023-11-24'),
(3, 2, 4, 'Hmmm... Tasty.', '2023-11-24'),
(4, 2, 1, 'This mod is mid', '2023-11-24'),
(6, 3, 3, 'Every day, Shogun 2 show its weakness yet again.\r\n', '2023-11-24');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genre_id` int(11) NOT NULL,
  `genre_name` varchar(50) NOT NULL,
  `genre_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genre_id`, `genre_name`, `genre_desc`) VALUES
(1, 'Roblox', 'Sandbox, platform-based multiplayer game.\r\n'),
(2, 'Minecraft', 'Sandbox, survival, and PVP multiplayer game.\r\n'),
(3, 'Total War: Shogun 2', 'Real-Time Strategy game based on medieval Japan.'),
(4, 'Totally Accurate Battle Simulator', 'Pit colour-coded armies into fighting each other.'),
(5, 'Ravenfield', 'Red and Blue soldiers fight each other in modern military era with automatics and tanks.'),
(6, 'Ancient Warfare 3', 'Sandbox simulation game, with different era from stone age to futuristic warfare.');

-- --------------------------------------------------------

--
-- Table structure for table `modfile`
--

CREATE TABLE `modfile` (
  `mod_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'Creator',
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `date_updated` date NOT NULL DEFAULT current_timestamp(),
  `downloads` int(11) NOT NULL,
  `favorites` int(11) NOT NULL,
  `upvotes` int(11) NOT NULL,
  `downvotes` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `genre_id` int(11) NOT NULL,
  `icon` text NOT NULL COMMENT 'Library Display',
  `thumbnail` text NOT NULL COMMENT 'Modpage Display',
  `download_file` text NOT NULL COMMENT 'Will be Zipped',
  `hidden` tinyint(1) NOT NULL COMMENT 'Visible to owner only'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modfile`
--

INSERT INTO `modfile` (`mod_id`, `user_id`, `date_created`, `date_updated`, `downloads`, `favorites`, `upvotes`, `downvotes`, `title`, `description`, `genre_id`, `icon`, `thumbnail`, `download_file`, `hidden`) VALUES
(1, 1, '2023-11-24', '2023-11-24', 0, 0, 0, 0, 'Napoleon Assets', 'Reenact napoleon\'s great victories with these assets for your roblox studio.', 1, '1.png', '1.png', '1.rar', 0),
(2, 3, '2023-11-24', '2023-11-24', 0, 0, 0, 0, 'Western Japan', 'Partake in this raging conflict of a mod and rule Japan with an iron fist!', 3, '2.jpg', '2.jpg', '2.rar', 0),
(3, 3, '2023-11-24', '2023-11-24', 0, 0, 0, 0, 'Suppression Fire Fix', 'Previously, units hit by suppression fire would, believe it or not; speeds up instead of slowing down, this mod changes that.', 3, '3.jpg', '3.jpg', '3.zip', 0),
(4, 3, '2023-11-24', '2023-11-24', 0, 0, 0, 0, 'Better Food Mod', 'This mod turns your boring foods into an absolute gourmet, 1.18.2 only!\r\n', 2, '4.png', '4.png', '4.rar', 0),
(5, 2, '2023-11-24', '2023-11-24', 0, 0, 0, 0, 'Picatiny Guns mod v1.2', 'Minecraft mod, this simply add guns to your old arsenal.', 2, '5.png', '5.png', '5.rar', 0);

-- --------------------------------------------------------

--
-- Table structure for table `opinion`
--

CREATE TABLE `opinion` (
  `opinion_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'Critics',
  `mod_id` int(11) NOT NULL COMMENT 'Receiver',
  `type` enum('download','favorite','upvote','downvote') NOT NULL,
  `date_critic` date NOT NULL DEFAULT current_timestamp(),
  `enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `opinion`
--

INSERT INTO `opinion` (`opinion_id`, `user_id`, `mod_id`, `type`, `date_critic`, `enabled`) VALUES
(1, 1, 1, 'upvote', '2023-11-24', 1),
(2, 1, 1, 'downvote', '2023-11-24', 0),
(3, 1, 1, 'favorite', '2023-11-24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(35) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `bio` text NOT NULL,
  `date_register` date NOT NULL DEFAULT current_timestamp(),
  `address` text NOT NULL,
  `picture` text NOT NULL,
  `level` enum('admin','mod','basic') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `nickname`, `bio`, `date_register`, `address`, `picture`, `level`) VALUES
(1, 'admin', 'admin', 'masagitu2212@gmail.com', 'Jean-Louise-Le-Petit Oui-Oui-Dubois', 'I am an admin in this website, please enjoy your stay.', '2023-11-24', 'Mugen Route, Maris\r\n', '1-admin.png', 'admin'),
(2, 'moderator', 'moderator', 'youngsters2@gmail.com', 'Barry Aberforth Cunningham III', 'Respect the damn rules!', '2023-11-24', 'Liz Road, Mondon\r\n', '2-moderator.png', 'mod'),
(3, 'user', 'user', 'kaiserlich@gmail.com', 'Frederick Meister', 'Royales marine aye aye', '2023-11-24', 'Hermann Goering Strasse, Ferlin', '3-user.png', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_contact`
--
ALTER TABLE `admin_contact`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `mod_id` (`mod_id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `modfile`
--
ALTER TABLE `modfile`
  ADD PRIMARY KEY (`mod_id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Indexes for table `opinion`
--
ALTER TABLE `opinion`
  ADD PRIMARY KEY (`opinion_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `mod_id` (`mod_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_contact`
--
ALTER TABLE `admin_contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `modfile`
--
ALTER TABLE `modfile`
  MODIFY `mod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `opinion`
--
ALTER TABLE `opinion`
  MODIFY `opinion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_contact`
--
ALTER TABLE `admin_contact`
  ADD CONSTRAINT `admin_contact_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`mod_id`) REFERENCES `modfile` (`mod_id`);

--
-- Constraints for table `modfile`
--
ALTER TABLE `modfile`
  ADD CONSTRAINT `modfile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `modfile_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`genre_id`);

--
-- Constraints for table `opinion`
--
ALTER TABLE `opinion`
  ADD CONSTRAINT `opinion_ibfk_1` FOREIGN KEY (`mod_id`) REFERENCES `modfile` (`mod_id`),
  ADD CONSTRAINT `opinion_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
