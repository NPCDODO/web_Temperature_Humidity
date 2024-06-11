-- phpMyAdmin SQL Dump
-- version 5.2.1deb1+jammy2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 07, 2024 at 10:18 AM
-- Server version: 10.6.16-MariaDB-0ubuntu0.22.04.1
-- PHP Version: 8.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Dataset`
--

-- --------------------------------------------------------

--
-- Table structure for table `dataset`
--

CREATE TABLE `dataset` (
  `id` int(20) NOT NULL,
  `time` datetime NOT NULL DEFAULT '2024-06-07 00:00:00' ON UPDATE current_timestamp(),
  `device_id` varchar(20) DEFAULT NULL,
  `key` text NOT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dataset`
--

INSERT INTO `dataset` (`id`, `time`, `device_id`, `key`, `data`) VALUES
(1, '2024-06-07 00:00:00', '001', 'Temperature', '28'),
(2, '2024-06-07 00:00:00', '001', 'Humidity', '60'),
(3, '2024-06-07 00:00:00', '002', 'Temperature', '28'),
(4, '2024-06-07 00:00:00', '002', 'Humidity', '68'),
(5, '2024-06-07 00:00:00', '003', 'Temperature', '30'),
(6, '2024-06-07 00:00:00', '003', 'Humidity', '55'),
(7, '2024-06-07 00:00:00', '004', 'Temperature', '39'),
(8, '2024-06-07 00:00:00', '004', 'Humidty', '68'),
(9, '2024-06-07 00:00:00', '005', 'Temperature', '20'),
(10, '2024-06-07 00:00:00', '005', 'Humidty', '70'),
(11, '2024-06-07 00:01:00', '001', 'Temperature', '28'),
(12, '2024-06-07 00:01:00', '001', 'Humidity', '60'),
(13, '2024-06-07 00:01:00', '002', 'Temperature', '28'),
(14, '2024-06-07 00:01:00', '002', 'Humidity', '68'),
(15, '2024-06-07 00:01:00', '003', 'Temperature', '30'),
(16, '2024-06-07 00:01:00', '003', 'Humidity', '55'),
(17, '2024-06-07 00:01:00', '004', 'Temperature', '39'),
(18, '2024-06-07 00:01:00', '004', 'Humidty', '68'),
(19, '2024-06-07 00:01:00', '005', 'Temperature', '20'),
(20, '2024-06-07 00:01:00', '005', 'Humidty', '70'),
(21, '2024-06-07 00:02:00', '001', 'Temperature', '28'),
(22, '2024-06-07 00:02:00', '001', 'Humidity', '60'),
(23, '2024-06-07 00:02:00', '002', 'Temperature', '28'),
(24, '2024-06-07 00:02:00', '002', 'Humidity', '68'),
(25, '2024-06-07 00:02:00', '003', 'Temperature', '30'),
(26, '2024-06-07 00:02:00', '003', 'Humidity', '55'),
(27, '2024-06-07 00:02:00', '004', 'Temperature', '39'),
(28, '2024-06-07 00:02:00', '004', 'Humidty', '68'),
(29, '2024-06-07 00:02:00', '005', 'Temperature', '20'),
(30, '2024-06-07 00:02:00', '005', 'Humidty', '70'),
(31, '2024-06-07 00:03:00', '001', 'Temperature', '28'),
(32, '2024-06-07 00:03:00', '001', 'Humidity', '60'),
(33, '2024-06-07 00:03:00', '002', 'Temperature', '28'),
(34, '2024-06-07 00:03:00', '002', 'Humidity', '68'),
(35, '2024-06-07 00:03:00', '003', 'Temperature', '30'),
(36, '2024-06-07 00:03:00', '003', 'Humidity', '55'),
(37, '2024-06-07 00:03:00', '004', 'Temperature', '39'),
(38, '2024-06-07 00:03:00', '004', 'Humidty', '68'),
(39, '2024-06-07 00:03:00', '005', 'Temperature', '20'),
(40, '2024-06-07 00:03:00', '005', 'Humidty', '70'),
(41, '2024-06-07 00:04:00', '001', 'Temperature', '28'),
(42, '2024-06-07 00:04:00', '001', 'Humidity', '60'),
(43, '2024-06-07 00:04:00', '002', 'Temperature', '28'),
(44, '2024-06-07 00:04:00', '002', 'Humidity', '68'),
(45, '2024-06-07 00:04:00', '003', 'Temperature', '30'),
(46, '2024-06-07 00:04:00', '003', 'Humidity', '55'),
(47, '2024-06-07 00:04:00', '004', 'Temperature', '39'),
(48, '2024-06-07 00:04:00', '004', 'Humidty', '68'),
(49, '2024-06-07 00:04:00', '005', 'Temperature', '20'),
(50, '2024-06-07 00:04:00', '005', 'Humidty', '70'),
(51, '2024-06-07 00:05:00', '001', 'Temperature', '28'),
(52, '2024-06-07 00:05:00', '001', 'Humidity', '60'),
(53, '2024-06-07 00:05:00', '002', 'Temperature', '28'),
(54, '2024-06-07 00:05:00', '002', 'Humidity', '68'),
(55, '2024-06-07 00:05:00', '003', 'Temperature', '30'),
(56, '2024-06-07 00:05:00', '003', 'Humidity', '55'),
(57, '2024-06-07 00:05:00', '004', 'Temperature', '39'),
(58, '2024-06-07 00:05:00', '004', 'Humidty', '68'),
(59, '2024-06-07 00:05:00', '005', 'Temperature', '20'),
(60, '2024-06-07 00:05:00', '005', 'Humidty', '70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dataset`
--
ALTER TABLE `dataset`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dataset`
--
ALTER TABLE `dataset`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
