-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 18, 2023 at 12:20 PM
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
-- Database: `tests`
--

-- --------------------------------------------------------

--
-- Table structure for table `Events`
--

CREATE TABLE `Events` (
  `event_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `owner_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Events`
--

INSERT INTO `Events` (`event_id`, `title`, `description`, `start_date`, `end_date`, `owner_id`) VALUES
(1, 'Event 1', 'Description for Event 1', '2023-09-20 10:00:00', '2023-09-20 14:00:00', 1),
(2, 'Event 2', 'Description for Event 2', '2023-09-21 15:00:00', '2023-09-21 18:00:00', 2),
(3, 'Event 3', 'Description for Event 3', '2023-09-22 09:00:00', '2023-09-22 12:00:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `Roles`
--

CREATE TABLE `Roles` (
  `role_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Roles`
--

INSERT INTO `Roles` (`role_id`, `name`) VALUES
(2, 'Admin'),
(1, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `Tickets`
--

CREATE TABLE `Tickets` (
  `ticket_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL CHECK (`quantity` >= 0),
  `status` varchar(20) DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Tickets`
--

INSERT INTO `Tickets` (`ticket_id`, `event_id`, `price`, `quantity`, `status`) VALUES
(1, 1, 20.00, 100, 'Available'),
(2, 2, 15.00, 50, 'Available'),
(3, 3, 25.00, 75, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `UserRoles`
--

CREATE TABLE `UserRoles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `UserRoles`
--

INSERT INTO `UserRoles` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `balance` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `username`, `password`, `balance`) VALUES
(1, 'user1', 'password1', 100.00),
(2, 'user2', 'password2', 50.00),
(3, 'user3', 'password3', 75.00);

-- --------------------------------------------------------

--
-- Table structure for table `UserTickets`
--

CREATE TABLE `UserTickets` (
  `user_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `UserTickets`
--

INSERT INTO `UserTickets` (`user_id`, `ticket_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Events`
--
ALTER TABLE `Events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `Tickets`
--
ALTER TABLE `Tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `UserRoles`
--
ALTER TABLE `UserRoles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `UserTickets`
--
ALTER TABLE `UserTickets`
  ADD PRIMARY KEY (`user_id`,`ticket_id`),
  ADD KEY `ticket_id` (`ticket_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Events`
--
ALTER TABLE `Events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Roles`
--
ALTER TABLE `Roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Tickets`
--
ALTER TABLE `Tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Events`
--
ALTER TABLE `Events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `Users` (`user_id`);

--
-- Constraints for table `Tickets`
--
ALTER TABLE `Tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `Events` (`event_id`);

--
-- Constraints for table `UserRoles`
--
ALTER TABLE `UserRoles`
  ADD CONSTRAINT `userroles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `userroles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `Roles` (`role_id`);

--
-- Constraints for table `UserTickets`
--
ALTER TABLE `UserTickets`
  ADD CONSTRAINT `usertickets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `usertickets_ibfk_2` FOREIGN KEY (`ticket_id`) REFERENCES `Tickets` (`ticket_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
