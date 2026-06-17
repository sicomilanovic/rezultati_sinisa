-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2026 at 04:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sport`
--

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `id` int(11) NOT NULL,
  `home_team` int(11) NOT NULL,
  `away_team` int(11) NOT NULL,
  `home_score` int(11) DEFAULT 0,
  `away_score` int(11) DEFAULT 0,
  `match_date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`id`, `home_team`, `away_team`, `home_score`, `away_score`, `match_date`, `user_id`) VALUES
(1, 1, 2, 2, 1, '2026-06-01', NULL),
(2, 3, 4, 3, 3, '2026-06-02', NULL),
(3, 5, 6, 1, 2, '2026-06-03', NULL),
(4, 2, 3, 0, 2, '2026-06-04', NULL),
(5, 1, 4, 1, 1, '2026-06-05', NULL),
(6, 5, 2, 55, 4, '2026-06-09', NULL),
(7, 1, 1, 4, 1, '2026-06-09', NULL),
(8, 1, 3, 2, 1, '2026-06-09', 6);

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `goals` int(11) DEFAULT 0,
  `assists` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `team_id`, `name`, `goals`, `assists`) VALUES
(1, 1, 'Pavkov', 5, 2),
(2, 2, 'Ricardo', 7, 3),
(3, 3, 'Lewandowski', 12, 5),
(4, 4, 'Bellingham', 9, 6),
(5, 5, 'Haaland', 15, 3),
(6, 6, 'Kane', 11, 4);

-- --------------------------------------------------------

--
-- Table structure for table `predictions`
--

CREATE TABLE `predictions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `match_id` int(11) DEFAULT NULL,
  `pick` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `correct` tinyint(4) DEFAULT 0,
  `round_id` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `predictions`
--

INSERT INTO `predictions` (`id`, `user_id`, `match_id`, `pick`, `created_at`, `correct`, `round_id`) VALUES
(1, 6, 8, '1', '2026-06-09 10:37:25', 0, 1),
(2, 6, 3, '2', '2026-06-09 10:42:04', 0, 1),
(3, 6, 2, '1', '2026-06-09 10:42:08', 0, 1),
(4, 6, 4, 'X', '2026-06-09 10:45:08', 0, 1),
(5, 6, 8, '1', '2026-06-09 10:45:08', 1, 1),
(6, 6, 2, '1', '2026-06-09 10:45:08', 0, 1),
(7, 6, 1, '1', '2026-06-09 10:45:08', 1, 1),
(8, 6, 6, '1', '2026-06-09 10:45:08', 1, 1),
(9, 6, 4, 'X', '2026-06-09 10:49:20', 0, 1),
(10, 6, 8, '1', '2026-06-09 10:49:20', 1, 1),
(11, 6, 2, '1', '2026-06-09 10:49:20', 0, 1),
(12, 6, 1, '1', '2026-06-09 10:49:20', 1, 1),
(13, 6, 6, '1', '2026-06-09 10:49:20', 1, 1),
(14, 6, 1, '1', '2026-06-09 10:50:22', 1, 1),
(15, 6, 2, '1', '2026-06-09 10:50:22', 0, 1),
(16, 6, 3, '1', '2026-06-09 10:50:22', 0, 1),
(17, 6, 7, '1', '2026-06-09 10:50:22', 1, 1),
(18, 6, 4, '1', '2026-06-09 10:50:22', 0, 1),
(19, 1, 8, 'X', '2026-06-09 10:51:54', 0, 1),
(20, 1, 6, 'X', '2026-06-09 10:51:54', 0, 1),
(21, 1, 3, 'X', '2026-06-09 10:51:54', 0, 1),
(22, 1, 7, 'X', '2026-06-09 10:51:54', 0, 1),
(23, 1, 4, 'X', '2026-06-09 10:51:54', 0, 1),
(24, 1, 1, '1', '2026-06-09 11:10:42', 1, 1),
(25, 1, 5, '1', '2026-06-09 11:10:42', 0, 1),
(26, 1, 2, '1', '2026-06-09 11:10:42', 0, 1),
(27, 1, 6, '1', '2026-06-09 11:10:42', 1, 1),
(28, 1, 4, '1', '2026-06-09 11:10:42', 0, 1),
(29, 1, 8, '1', '2026-06-09 11:11:24', 1, 1),
(30, 1, 6, '1', '2026-06-09 11:11:24', 1, 1),
(31, 1, 4, '1', '2026-06-09 11:11:24', 0, 1),
(32, 1, 3, '1', '2026-06-09 11:11:24', 0, 1),
(33, 1, 1, 'X', '2026-06-09 11:11:24', 0, 1),
(34, 1, 2, '1', '2026-06-09 11:19:19', 0, 1),
(35, 1, 4, '1', '2026-06-09 11:19:19', 0, 1),
(36, 1, 5, '1', '2026-06-09 11:19:19', 0, 1),
(37, 1, 3, '1', '2026-06-09 11:19:19', 0, 1),
(38, 1, 1, '1', '2026-06-09 11:19:19', 1, 1),
(39, 1, 2, '1', '2026-06-09 11:19:19', 0, 1),
(40, 1, 4, '1', '2026-06-09 11:19:19', 0, 1),
(41, 1, 5, '1', '2026-06-09 11:19:19', 0, 1),
(42, 1, 3, '1', '2026-06-09 11:19:19', 0, 1),
(43, 1, 1, '1', '2026-06-09 11:19:19', 1, 1),
(44, 1, 1, '1', '2026-06-09 11:19:35', 1, 1),
(45, 1, 3, '1', '2026-06-09 11:19:35', 0, 1),
(46, 1, 6, '1', '2026-06-09 11:19:35', 1, 1),
(47, 1, 5, '1', '2026-06-09 11:19:35', 0, 1),
(48, 1, 4, '1', '2026-06-09 11:19:35', 0, 1),
(49, 1, 1, '1', '2026-06-09 11:19:35', 1, 1),
(50, 1, 3, '1', '2026-06-09 11:19:35', 0, 1),
(51, 1, 6, '1', '2026-06-09 11:19:35', 1, 1),
(52, 1, 5, '1', '2026-06-09 11:19:35', 0, 1),
(53, 1, 4, '1', '2026-06-09 11:19:35', 0, 1),
(54, 1, 1, '1', '2026-06-09 11:22:44', 1, 1),
(55, 1, 6, '1', '2026-06-09 11:22:44', 1, 1),
(56, 1, 5, '1', '2026-06-09 11:22:44', 0, 1),
(57, 1, 2, '1', '2026-06-09 11:22:44', 0, 1),
(58, 1, 8, '1', '2026-06-09 11:22:44', 1, 1),
(59, 1, 1, '1', '2026-06-09 11:22:44', 1, 1),
(60, 1, 6, '1', '2026-06-09 11:22:44', 1, 1),
(61, 1, 5, '1', '2026-06-09 11:22:44', 0, 1),
(62, 1, 2, '1', '2026-06-09 11:22:44', 0, 1),
(63, 1, 8, '1', '2026-06-09 11:22:44', 1, 1),
(64, 1, 1, '2', '2026-06-09 11:27:11', 0, 1),
(65, 1, 4, '1', '2026-06-09 11:27:11', 0, 1),
(66, 1, 2, '1', '2026-06-09 11:27:11', 0, 1),
(67, 1, 8, '2', '2026-06-09 11:27:11', 0, 1),
(68, 1, 3, '1', '2026-06-09 11:27:11', 0, 1),
(69, 1, 1, '2', '2026-06-09 11:27:11', 0, 1),
(70, 1, 4, '1', '2026-06-09 11:27:11', 0, 1),
(71, 1, 2, '1', '2026-06-09 11:27:11', 0, 1),
(72, 1, 8, '2', '2026-06-09 11:27:11', 0, 1),
(73, 1, 3, '1', '2026-06-09 11:27:11', 0, 1),
(74, 1, 3, '1', '2026-06-09 11:28:44', 0, 1),
(75, 1, 5, '2', '2026-06-09 11:28:44', 0, 1),
(76, 1, 8, '2', '2026-06-09 11:28:44', 0, 1),
(77, 1, 1, '1', '2026-06-09 11:28:44', 1, 1),
(78, 1, 2, '1', '2026-06-09 11:28:44', 0, 1),
(79, 1, 3, '1', '2026-06-09 11:28:44', 0, 1),
(80, 1, 5, '2', '2026-06-09 11:28:44', 0, 1),
(81, 1, 8, '2', '2026-06-09 11:28:44', 0, 1),
(82, 1, 1, '1', '2026-06-09 11:28:44', 1, 1),
(83, 1, 2, '1', '2026-06-09 11:28:44', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `logo`) VALUES
(1, 'Crvena Zvezda', 'https://upload.wikimedia.org/wikipedia/sr/3/3d/%D0%A4%D0%9A_%D0%A6%D1%80%D0%B2%D0%B5%D0%BD%D0%B0_%D0%B7%D0%B2%D0%B5%D0%B7%D0%B4%D0%B0_%28%D0%BB%D0%BE%D0%B3%D0%BE%29.svg'),
(2, 'Partizan', 'https://upload.wikimedia.org/wikipedia/en/e/ed/FK_Partizan.svg'),
(3, 'Barcelona', 'https://upload.wikimedia.org/wikipedia/en/4/47/FC_Barcelona_%28crest%29.svg'),
(4, 'Real Madrid', 'https://upload.wikimedia.org/wikipedia/en/5/56/Real_Madrid_CF.svg'),
(5, 'Manchester City', 'https://upload.wikimedia.org/wikipedia/en/e/eb/Manchester_City_FC_badge.svg'),
(6, 'Bayern Munich', 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8d/FC_Bayern_M%C3%BCnchen_logo_%282024%29.svg/1280px-FC_Bayern_M%C3%BCnchen_logo_%282024%29.svg.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(7, 'milanovicsico@gmail.com', '$2y$10$Z1ssDZJ0E2srSpaeuC9OG.ltBhl9/qU5NOwbCRvKZ7oVZsRMtcRwO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `home_team` (`home_team`),
  ADD KEY `away_team` (`away_team`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `predictions`
--
ALTER TABLE `predictions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `predictions`
--
ALTER TABLE `predictions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `matches_ibfk_1` FOREIGN KEY (`home_team`) REFERENCES `teams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `matches_ibfk_2` FOREIGN KEY (`away_team`) REFERENCES `teams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `players_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
