-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2024 at 04:11 AM
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
-- Database: `ajax-database`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `ci_id` int(11) NOT NULL,
  `ci_name` varchar(30) NOT NULL,
  `s_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`ci_id`, `ci_name`, `s_id`) VALUES
(1, 'Bombuflat', 1),
(2, 'Garacharma', 1),
(3, 'Ajjaram', 2),
(4, 'Adoni', 2),
(5, 'Surat', 3),
(6, 'Ahmedabad', 3),
(7, 'Dhule', 4),
(8, 'sindhudurg', 4),
(9, 'Hoshiarpur', 5),
(10, 'Bathinda', 5),
(11, 'Sukkur', 6),
(12, 'Larkana', 6);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`c_id`, `c_name`) VALUES
(1, 'Afghanistan'),
(2, 'India'),
(3, 'Pakistan');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(30) NOT NULL,
  `c_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`s_id`, `s_name`, `c_id`) VALUES
(1, 'Badakhshan', 1),
(2, 'Badgis', 1),
(3, 'Gujarat', 2),
(4, 'Maharashtra', 2),
(5, 'Punjab', 3),
(6, 'Sind', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobileno` varchar(15) NOT NULL,
  `date_of_birth` date NOT NULL,
  `country` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `img_name` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobileno`, `date_of_birth`, `country`, `state`, `city`, `img_name`) VALUES
(1, 'Kunal kudal1', 'kunal132@gmail.com', '8080683184', '2003-06-15', '3', '5', '9', NULL),
(2, 'Neha', 'neha@123gmail.com', '1234567890', '2005-03-12', '2', '3', '5', NULL),
(3, 'sanket1', 'naiksanket492@gmail.com', '1234567899', '2003-06-15', '3', '5', '10', NULL),
(4, 'Rohan Pandit', 'rohan@123gmail.com', '1234567899', '2008-12-23', '1', '1', '2', NULL),
(6, 'ramesh B', 'ramesh23@gmail.com', '1234567899', '2006-11-21', '2', '3', '5', NULL),
(7, 'sonam', 'sonam123@gmail.com', '2346745897', '1999-03-12', '3', '6', '11', NULL),
(8, 'Kunal Sawant', 'neha@123gmail.com', '8080683184', '1999-02-23', '1', '1', '2', NULL),
(9, 'Hrugveda', 'er12@gmail.com', '5676745677', '1995-04-05', '2', '4', '7', NULL),
(11, 'Kunal Sawant', 'er12@gmail.com', '4365475676', '2024-11-05', '2', '3', '5', NULL),
(13, 'sgrsg', 'er12@gmail.com', '8080683184', '1999-03-23', '2', '4', '8', '1925715208.jpg'),
(14, 'sgrsg', 'er12@gmail.com', '8080683184', '1999-03-23', '2', '4', '8', '2106153921.jpg'),
(15, 'sgrsg', 'er12@gmail.com', '8080683184', '1999-03-23', '2', '4', '8', '314567643.jpg'),
(16, 'rfgaggg', 'neha@123gmail.com', '1234567899', '1999-03-21', '2', '4', '8', '1397575933.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
