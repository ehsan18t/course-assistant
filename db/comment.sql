-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2022 at 05:56 AM
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
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `comment_admin` varchar(50) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `post_id`, `comment`, `comment_admin`, `datetime`) VALUES
(2, 0, 'THis is demo comment', 'ssutradhar201084@bscse.uiu.ac.bd', '2022-01-24 01:47:51'),
(9, 0, 'THis is demo comment', 'ssutradhar201084@bscse.uiu.ac.bd', '2022-01-24 01:57:48'),
(10, 0, 'THis is demo comment', 'ssutradhar201084@bscse.uiu.ac.bd', '2022-01-24 01:58:49'),
(11, 25, 'THis is demo comment', 'ssutradhar201084@bscse.uiu.ac.bd', '2022-01-24 02:08:22'),
(12, 25, 'THis is demo comment', 'ssutradhar201084@bscse.uiu.ac.bd', '2022-01-24 02:08:37'),
(13, 25, 'THis is demo comment', 'ssutradhar201084@bscse.uiu.ac.bd', '2022-01-24 02:11:14'),
(14, 23, 'This is another demo comment', 'ahsan@bscse.uiu.ac.bd', '2022-01-24 10:11:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
