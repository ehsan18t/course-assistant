-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2022 at 04:19 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course_assistant`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `f_name` varchar(30) NOT NULL,
  `l_name` varchar(30) NOT NULL,
  `u_name` varchar(100) NOT NULL,
  `d_name` varchar(100) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `domain` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`f_name`, `l_name`, `u_name`, `d_name`, `user_name`, `domain`, `password`, `date`) VALUES
('Demo', 'User', 'United International University', 'Computer Science Engineering ', 'demoUser@bscse.uiu.ac.bd', 'bscse.uiu.ac.bd', '123456', '2022-01-06 15:17:40'),
('Sunny', 'Sutradhar', 'United International University', 'Computer Science Engineering ', 'ssutradhar201084@bscse.uiu.ac.bd', 'bscse.uiu.ac.bd', '123456789', '2022-01-06 08:12:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
