-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2024 at 07:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `23189618`
--
CREATE DATABASE IF NOT EXISTS `23189618` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `23189618`;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `ID` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `groundName` varchar(255) DEFAULT NULL,
  `bookingDate` date NOT NULL,
  `bookingName` varchar(255) NOT NULL,
  `confirmationStatus` varchar(255) NOT NULL DEFAULT 'Yet_to_confirm',
  `bookedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `confirmedAt` timestamp NULL DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`ID`, `userId`, `groundName`, `bookingDate`, `bookingName`, `confirmationStatus`, `bookedAt`, `confirmedAt`, `category`) VALUES
(5, 5, 'Annapurna Cricket Field (अन्नपूर्ण क्रिकेट फिल्ड)', '2024-06-15', 'solomon Dai', 'confirmed', '2024-06-15 15:22:54', '2024-06-15 15:23:13', 'GroundBooking'),
(6, 5, 'Buddha Cricket Arena (बुद्ध क्रिकेट एरेना)', '2024-06-21', 'sam Bahadur', 'canceled', '2024-06-15 15:23:56', '2024-06-15 17:45:37', 'GroundBooking'),
(7, 2, 'Buddha Cricket Arena (बुद्ध क्रिकेट एरेना)', '2024-06-15', 'Booking test', 'Yet_to_confirm', '2024-06-15 16:04:52', NULL, 'GroundBooking'),
(8, 6, 'Himalayan Cricket Arena (हिमालयन क्रिकेट एरेना)', '2024-06-16', 'hjdkkd', 'Yet_to_confirm', '2024-06-16 03:18:27', NULL, 'GroundBooking'),
(9, 8, 'Himalayan Cricket Arena (हिमालयन क्रिकेट एरेना)', '2024-06-18', 'a', 'Yet_to_confirm', '2024-06-18 05:10:04', NULL, 'GroundBooking');

-- --------------------------------------------------------

--
-- Table structure for table `ground`
--

CREATE TABLE `ground` (
  `ID` int(11) NOT NULL,
  `groundName` varchar(255) NOT NULL,
  `price` decimal(20,0) NOT NULL,
  `time` varchar(10) NOT NULL,
  `width` varchar(20) NOT NULL,
  `length` varchar(20) NOT NULL,
  `lights` enum('Available','Not-Available') NOT NULL,
  `scoreboard` enum('Available','Not-Available') NOT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ground`
--

INSERT INTO `ground` (`ID`, `groundName`, `price`, `time`, `width`, `length`, `lights`, `scoreboard`, `createdAt`) VALUES
(11, 'Himalayan Cricket Arena (हिमालयन क्रिकेट एरेना)', 1500, '10Am-12pm', '100 meter', '100 meter', 'Available', '', '2024-06-15 15:18:51'),
(12, 'Annapurna Cricket Field (अन्नपूर्ण क्रिकेट फिल्ड)', 2000, '5pm-7pm', '150 meter', '100 meter', '', '', '2024-06-15 15:21:55'),
(13, 'Buddha Cricket Arena (बुद्ध क्रिकेट एरेना)', 1000, '12pm-1pm', '70 meter', '50 meter', 'Available', 'Available', '2024-06-15 15:22:36');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `ID` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `tranningId` int(11) DEFAULT NULL,
  `enrollDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`ID`, `userId`, `tranningId`, `enrollDate`) VALUES
(2, 5, 2, '2024-06-15 15:55:55'),
(3, 2, 2, '2024-06-15 16:11:19'),
(4, 6, 1, '2024-06-16 03:18:43');

-- --------------------------------------------------------

--
-- Table structure for table `training`
--

CREATE TABLE `training` (
  `ID` int(11) NOT NULL,
  `trainingDurations` varchar(255) NOT NULL,
  `tranningTime` varchar(50) NOT NULL,
  `startingDate` date NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training`
--

INSERT INTO `training` (`ID`, `trainingDurations`, `tranningTime`, `startingDate`, `description`, `createdAt`) VALUES
(1, '3 week Training ', '5Pm-6PM', '2024-06-29', 'Have Fun Guys', '2024-06-15 08:51:39'),
(2, '6 week Training', '6Am-8Am', '2024-10-24', 'None', '2024-06-15 15:55:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(10) DEFAULT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `sex` enum('Male','Female','Other') DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `userType` varchar(255) NOT NULL DEFAULT 'user',
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `name`, `email`, `address`, `phoneNumber`, `dateOfBirth`, `sex`, `password`, `userType`, `createdAt`) VALUES
(1, 'Admin', 'admin@gmail.com', '', '.', '0000-00-00', 'Male', '$2y$10$WPJK540dpQRxZLv8gJZBEu0LcFaiSQLC7bYOBkD3SqYB6wGxFZ5B2', 'admin', '2024-06-15 07:48:52'),
(2, 'Bibek Sapkota', 'sapkotabibek004@gmail.com', 'Kapan, kathmandu', '9863027811', '2004-01-21', 'Male', '$2y$10$R5qE44kzO/78RpHO6kRNAOTzAfsBgVdg4cGq3tNnII2/6pV.byPXa', 'user', '2024-06-15 07:37:29'),
(5, 'solomon silwal', 'soloman@gmail.com', 'dhapasi', '9841085405', '2009-06-09', 'Male', '$2y$10$ZAxMnduvyVgO5WNTsUM.1OxWV.8bjCwCLggtnTHGgFvjoknz5TVAS', 'user', '2024-06-15 15:20:06'),
(6, 'Shubham', 'dai@gmsil.com', 'kjks', '080788', '2024-06-04', 'Male', '$2y$10$O/bDZFwMfvjmHENVRGzXLuRVj9DoHz90J0EJpDbG2EjbKnswXDk5G', 'user', '2024-06-16 03:17:12'),
(7, 'pradip basnet', 'basnetpradip324@gmail.com', 'damak', '9817036614', '2024-06-06', 'Male', '$2y$10$RgZZO.q3qrfLnMOFWRCSne3pQ3LaJnUsUeMAuI5sopiR71kAVmbbS', 'user', '2024-06-18 03:45:43'),
(8, 'sakshyam kumar acharya', 'sakshyam@gmail.com', 'Kapan, kathmandu', '9841154066', '2024-08-05', 'Male', '$2y$10$u6EYz4JymIbE9YV5KbMZ1ezpocyQp6o/WEt.yVOnxo/wxFNqSse.W', 'user', '2024-06-18 05:07:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `ground`
--
ALTER TABLE `ground`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userId` (`userId`),
  ADD KEY `tranningId` (`tranningId`);

--
-- Indexes for table `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ground`
--
ALTER TABLE `ground`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `training`
--
ALTER TABLE `training`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`ID`);

--
-- Constraints for table `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `registration_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `registration_ibfk_2` FOREIGN KEY (`tranningId`) REFERENCES `training` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
