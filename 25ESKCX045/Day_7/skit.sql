-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2026 at 04:05 PM
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
-- Database: `skit`
--

-- --------------------------------------------------------

--
-- Table structure for table `skit`
--

CREATE TABLE `skit` (
  `sn` int(3) NOT NULL,
  `name` varchar(15) NOT NULL,
  `email` varchar(25) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skit`
--

INSERT INTO `skit` (`sn`, `name`, `email`, `phone`, `dob`, `gender`, `Time`) VALUES
(1, 'kamal', 'kamaljethwani100@gmail.co', '1234567890', '2026-07-01', 'male', '2026-07-07 08:01:58'),
(2, 'leela', 'leelawala@gmail.com', '', '2007-02-26', '', '2026-07-07 08:15:52'),
(3, 'land ke', 'landwala@gmail.com', '', '2007-02-26', '', '2026-07-07 08:44:35'),
(4, 'Amit Jetwani', 'amitjetwani2000@gmail.com', '', '2008-02-07', '', '2026-07-07 09:47:00'),
(5, 'Amit Jetwani', 'amitjetwani2000@gmail.com', '8000886061', '2008-02-07', '', '2026-07-07 09:48:00'),
(6, 'Amit Jetwani', 'amitjetwani2000@gmail.com', '8000886061', '2008-02-07', '', '2026-07-07 10:06:53'),
(7, 'Amit Jetwani', 'amitjetwani2000@gmail.com', '8000886061', '2008-02-07', '', '2026-07-07 10:14:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `skit`
--
ALTER TABLE `skit`
  ADD PRIMARY KEY (`sn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `skit`
--
ALTER TABLE `skit`
  MODIFY `sn` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
