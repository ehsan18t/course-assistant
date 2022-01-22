-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2022 at 05:56 PM
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
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `r_id` int(11) NOT NULL,
  `r_course_code` varchar(255) NOT NULL,
  `r_course_name` varchar(255) NOT NULL,
  `r_course_des` varchar(255) NOT NULL,
  `r_course_link` varchar(255) NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp(),
  `helper_id` varchar(50) NOT NULL,
  `domain` varchar(50) NOT NULL,
  `request_admin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`r_id`, `r_course_code`, `r_course_name`, `r_course_des`, `r_course_link`, `dt`, `helper_id`, `domain`, `request_admin`) VALUES
(2, 'CSE 221', 'DATABASE', 'I beed some files', 'files/Mickey-Mouse.jpg', '2022-01-21 16:09:13', 'ahsan@bscse.uiu.ac.bd', 'bscse.uiu.ac.bd', 'ssutradhar201084@bscse.uiu.ac.bd'),
(3, 'ALGO', 'Alogrithms', 'I need some files', 'files/user.txt', '2022-01-21 18:14:40', 'ssutradhar201084@bscse.uiu.ac.bd', 'bscse.uiu.ac.bd', 'ahsan@bscse.uiu.ac.bd'),
(4, 'Math221', 'Math MAin', 'I need some files', 'files/ahsan.jpg', '2022-01-21 20:57:30', 'ssutradhar201084@bscse.uiu.ac.bd', 'bscse.uiu.ac.bd', 'ahsan@bscse.uiu.ac.bd'),
(5, 'Algo', 'Alogrithm theory', 'I need some files', 'files/Mickey-Mouse.jpg', '2022-01-21 22:42:19', 'ssutradhar201084@bscse.uiu.ac.bd', 'bscse.uiu.ac.bd', 'ssutradhar201084@bscse.uiu.ac.bd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`r_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
