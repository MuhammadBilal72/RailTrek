-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 20, 2024 at 08:20 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `railtrek`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `source` int(11) NOT NULL,
  `destination` int(11) NOT NULL,
  `route` int(11) NOT NULL,
  `schedule` int(11) NOT NULL,
  `seats` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `booking_time` varchar(100) NOT NULL,
  `booking_date` varchar(100) NOT NULL,
  `status` enum('active','cancelled') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `user`, `source`, `destination`, `route`, `schedule`, `seats`, `price`, `booking_time`, `booking_date`, `status`, `created_at`) VALUES
(1, 1, 5, 9, 1, 7, 2, 80, '02:20 PM', '2024-05-21', 'active', '2024-05-20 01:56:21');

-- --------------------------------------------------------

--
-- Table structure for table `RollingStock`
--

CREATE TABLE `RollingStock` (
  `id` int(11) NOT NULL,
  `type` enum('carriage','baggageCar','dieselRailcar','locomotive') DEFAULT NULL,
  `series` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `seats` int(11) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `RollingStock`
--

INSERT INTO `RollingStock` (`id`, `type`, `series`, `name`, `seats`, `stock`, `created_at`, `updated_at`) VALUES
(1, 'carriage', '1928', 'B1', 36, 20, '2024-05-18 10:14:30', '2024-05-18 10:28:31'),
(2, 'carriage', '1928', 'B2', 36, 20, '2024-05-18 10:14:30', '2024-05-18 10:28:31'),
(3, 'carriage', '1928', 'B3', 36, 20, '2024-05-18 10:14:30', '2024-05-18 10:28:31'),
(4, 'carriage', '1930', 'C6', 48, 20, '2024-05-18 10:14:30', '2024-05-18 10:28:31'),
(5, 'carriage', '1930', 'C9', 48, 20, '2024-05-18 10:14:30', '2024-05-18 10:28:31'),
(6, 'carriage', '1952', 'C12', 52, 20, '2024-05-18 10:14:30', '2024-05-18 10:28:31'),
(7, 'baggageCar', '1910', 'CD1', 12, 20, '2024-05-18 10:14:30', '2024-05-18 10:28:31'),
(8, 'baggageCar', '1910', 'CD2', 12, 20, '2024-05-18 10:14:30', '2024-05-18 10:28:31'),
(9, 'dieselRailcar', 'AN56.2', '', 56, 20, '2024-05-18 10:14:30', '2024-05-18 10:28:31'),
(10, 'dieselRailcar', 'AN56.4', '', 56, 20, '2024-05-18 10:14:30', '2024-05-18 10:28:31'),
(11, 'locomotive', '', 'Cavour', NULL, 20, '2024-05-18 10:14:30', '2024-05-18 10:28:31'),
(12, 'locomotive', '', 'Vittorio Emanuele', NULL, 20, '2024-05-18 10:14:30', '2024-05-18 10:28:31'),
(13, 'locomotive', '', 'Garibaldi', NULL, 20, '2024-05-18 10:14:30', '2024-05-18 10:28:31');

-- --------------------------------------------------------

--
-- Table structure for table `Routes`
--

CREATE TABLE `Routes` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `start_station_id` int(11) DEFAULT NULL,
  `end_station_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Routes`
--

INSERT INTO `Routes` (`id`, `name`, `start_station_id`, `end_station_id`, `created_at`, `updated_at`) VALUES
(1, 'Route 1', 1, 10, '2024-05-18 10:15:23', '2024-05-18 10:15:23'),
(2, 'Route 2', 10, 1, '2024-05-18 10:15:23', '2024-05-18 10:15:23');

-- --------------------------------------------------------

--
-- Table structure for table `Schedules`
--

CREATE TABLE `Schedules` (
  `id` int(11) NOT NULL,
  `train_id` int(11) DEFAULT NULL,
  `route_id` int(11) DEFAULT NULL,
  `departure_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `arrival_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Schedules`
--

INSERT INTO `Schedules` (`id`, `train_id`, `route_id`, `departure_time`, `arrival_time`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-05-20 05:00:00', '2024-05-20 08:00:00', '2024-05-18 08:00:00', '2024-05-20 01:01:16'),
(2, 1, 2, '2024-05-20 15:00:00', '2024-05-20 18:00:00', '2024-05-18 18:00:00', '2024-05-20 01:01:32'),
(3, 2, 1, '2024-05-20 06:00:00', '2024-05-20 09:00:00', '2024-05-18 09:00:00', '2024-05-20 01:01:42'),
(4, 2, 2, '2024-05-20 14:00:00', '2024-05-20 17:00:00', '2024-05-18 17:00:00', '2024-05-20 01:02:02'),
(5, 3, 1, '2024-05-20 07:00:00', '2024-05-20 10:00:00', '2024-05-18 10:00:00', '2024-05-20 01:02:09'),
(6, 3, 2, '2024-05-20 12:00:00', '2024-05-20 15:00:00', '2024-05-18 15:00:00', '2024-05-20 01:02:16'),
(7, 4, 1, '2024-05-20 08:00:00', '2024-05-20 11:00:00', '2024-05-18 11:00:00', '2024-05-20 01:02:28'),
(8, 4, 2, '2024-05-20 07:00:00', '2024-05-20 10:00:00', '2024-05-18 10:00:00', '2024-05-20 01:02:36'),
(9, 5, 1, '2024-05-20 15:00:00', '2024-05-20 18:00:00', '2024-05-18 18:00:00', '2024-05-20 01:02:53'),
(10, 5, 2, '2024-05-20 09:00:00', '2024-05-20 12:00:00', '2024-05-18 09:00:00', '2024-05-20 01:03:22'),
(11, 6, 1, '2024-05-20 04:00:00', '2024-05-20 07:00:00', '2024-05-18 07:00:00', '2024-05-20 01:03:29'),
(12, 6, 2, '2024-05-20 04:00:00', '2024-05-20 07:00:00', '2024-05-18 07:00:00', '2024-05-20 01:03:38');

-- --------------------------------------------------------

--
-- Table structure for table `Stations`
--

CREATE TABLE `Stations` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Stations`
--

INSERT INTO `Stations` (`id`, `name`, `location`, `created_at`, `updated_at`) VALUES
(1, 'Torre Spaventa', 'Km 0.000', '2024-05-18 10:15:09', '2024-05-18 10:15:09'),
(2, 'Prato Terra', 'Km 2.700', '2024-05-18 10:15:09', '2024-05-18 10:15:09'),
(3, 'Rocca Pietrosa', 'Km 7.580', '2024-05-18 10:15:09', '2024-05-18 10:15:09'),
(4, 'Villa Pietrosa', 'Km 12.680', '2024-05-18 10:15:09', '2024-05-18 10:15:09'),
(5, 'Villa Santa Maria', 'Km 16.900', '2024-05-18 10:15:09', '2024-05-18 10:15:09'),
(6, 'Pietra Santa Maria', 'Km 23.950', '2024-05-18 10:15:09', '2024-05-18 10:15:09'),
(7, 'Castro Marino', 'Km 31.500', '2024-05-18 10:15:09', '2024-05-18 10:15:09'),
(8, 'Porto Spigola', 'Km 39.500', '2024-05-18 10:15:09', '2024-05-18 10:15:09'),
(9, 'Porto San Felice', 'Km 46.000', '2024-05-18 10:15:09', '2024-05-18 10:15:09'),
(10, 'Villa San Felice', 'Km 54.680', '2024-05-18 10:15:09', '2024-05-18 10:15:09');

-- --------------------------------------------------------

--
-- Table structure for table `Tickets`
--

CREATE TABLE `Tickets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `seat_number` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `booking_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `TrainComposition`
--

CREATE TABLE `TrainComposition` (
  `id` int(11) NOT NULL,
  `train_id` int(11) DEFAULT NULL,
  `rolling_stock_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `TrainComposition`
--

INSERT INTO `TrainComposition` (`id`, `train_id`, `rolling_stock_id`, `position`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2024-05-18 10:14:56', '2024-05-18 10:14:56'),
(2, 1, 2, 2, '2024-05-18 10:14:56', '2024-05-18 10:14:56'),
(3, 1, 3, 3, '2024-05-18 10:14:56', '2024-05-18 10:14:56'),
(4, 1, 11, 4, '2024-05-18 10:14:56', '2024-05-18 10:14:56'),
(5, 2, 4, 1, '2024-05-18 10:14:56', '2024-05-18 10:14:56'),
(6, 2, 5, 2, '2024-05-18 10:14:56', '2024-05-18 10:14:56'),
(7, 2, 6, 3, '2024-05-18 10:14:56', '2024-05-18 10:14:56'),
(8, 2, 12, 4, '2024-05-18 10:14:56', '2024-05-18 10:14:56'),
(9, 3, 7, 1, '2024-05-18 10:14:56', '2024-05-18 10:14:56'),
(10, 3, 8, 2, '2024-05-18 10:14:56', '2024-05-18 10:14:56'),
(11, 3, 9, 3, '2024-05-18 10:14:56', '2024-05-18 10:14:56'),
(12, 3, 13, 4, '2024-05-18 10:14:56', '2024-05-18 10:14:56'),
(13, 4, 10, 1, '2024-05-18 10:14:56', '2024-05-18 10:14:56'),
(14, 4, 11, 2, '2024-05-18 10:14:56', '2024-05-18 10:14:56'),
(15, 4, 12, 3, '2024-05-18 10:14:56', '2024-05-18 10:14:56'),
(16, 4, 13, 4, '2024-05-18 10:14:56', '2024-05-18 10:14:56'),
(17, 5, 1, 1, '2024-05-18 10:14:56', '2024-05-18 10:14:56'),
(18, 5, 3, 2, '2024-05-18 10:14:56', '2024-05-18 10:14:56'),
(19, 5, 4, 3, '2024-05-18 10:14:56', '2024-05-18 10:14:56'),
(20, 5, 12, 4, '2024-05-18 10:14:56', '2024-05-18 10:14:56'),
(21, 6, 2, 1, '2024-05-18 10:14:56', '2024-05-18 10:14:56'),
(22, 6, 5, 2, '2024-05-18 10:14:56', '2024-05-18 10:14:56'),
(23, 6, 6, 3, '2024-05-18 10:14:56', '2024-05-18 10:14:56'),
(24, 6, 13, 4, '2024-05-18 10:14:56', '2024-05-18 10:14:56');

-- --------------------------------------------------------

--
-- Table structure for table `Trains`
--

CREATE TABLE `Trains` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Trains`
--

INSERT INTO `Trains` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Historic Train 1', '2024-05-18 10:14:42', '2024-05-18 10:14:42'),
(2, 'Historic Train 2', '2024-05-18 10:14:42', '2024-05-18 10:14:42'),
(3, 'Historic Train 3', '2024-05-18 10:14:42', '2024-05-18 10:14:42'),
(4, 'Historic Train 4', '2024-05-18 10:14:42', '2024-05-18 10:14:42'),
(5, 'Weekday Train 1', '2024-05-18 10:14:42', '2024-05-18 10:14:42'),
(6, 'Weekday Train 2', '2024-05-18 10:14:42', '2024-05-18 10:14:42');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` enum('user','admin','operator') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `fullname`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'John Doe Ben', 'john@gmail.com', 'john@123', 'user', '2024-05-19 22:08:17', '2024-05-19 22:49:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `RollingStock`
--
ALTER TABLE `RollingStock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Routes`
--
ALTER TABLE `Routes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `start_station_id` (`start_station_id`),
  ADD KEY `end_station_id` (`end_station_id`);

--
-- Indexes for table `Schedules`
--
ALTER TABLE `Schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `train_id` (`train_id`),
  ADD KEY `route_id` (`route_id`);

--
-- Indexes for table `Stations`
--
ALTER TABLE `Stations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Tickets`
--
ALTER TABLE `Tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `schedule_id` (`schedule_id`);

--
-- Indexes for table `TrainComposition`
--
ALTER TABLE `TrainComposition`
  ADD PRIMARY KEY (`id`),
  ADD KEY `train_id` (`train_id`),
  ADD KEY `rolling_stock_id` (`rolling_stock_id`);

--
-- Indexes for table `Trains`
--
ALTER TABLE `Trains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`fullname`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `RollingStock`
--
ALTER TABLE `RollingStock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `Routes`
--
ALTER TABLE `Routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Schedules`
--
ALTER TABLE `Schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `Stations`
--
ALTER TABLE `Stations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `Tickets`
--
ALTER TABLE `Tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `TrainComposition`
--
ALTER TABLE `TrainComposition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `Trains`
--
ALTER TABLE `Trains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Routes`
--
ALTER TABLE `Routes`
  ADD CONSTRAINT `routes_ibfk_1` FOREIGN KEY (`start_station_id`) REFERENCES `Stations` (`id`),
  ADD CONSTRAINT `routes_ibfk_2` FOREIGN KEY (`end_station_id`) REFERENCES `Stations` (`id`);

--
-- Constraints for table `Schedules`
--
ALTER TABLE `Schedules`
  ADD CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`train_id`) REFERENCES `Trains` (`id`),
  ADD CONSTRAINT `schedules_ibfk_2` FOREIGN KEY (`route_id`) REFERENCES `Routes` (`id`);

--
-- Constraints for table `Tickets`
--
ALTER TABLE `Tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`schedule_id`) REFERENCES `Schedules` (`id`);

--
-- Constraints for table `TrainComposition`
--
ALTER TABLE `TrainComposition`
  ADD CONSTRAINT `traincomposition_ibfk_1` FOREIGN KEY (`train_id`) REFERENCES `Trains` (`id`),
  ADD CONSTRAINT `traincomposition_ibfk_2` FOREIGN KEY (`rolling_stock_id`) REFERENCES `RollingStock` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
