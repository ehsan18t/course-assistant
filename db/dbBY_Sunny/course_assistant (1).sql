-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2022 at 06:14 PM
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
-- Table structure for table `assessments`
--

CREATE TABLE `assessments` (
  `assess_id` int(11) NOT NULL,
  `expected_marks` decimal(5,2) DEFAULT NULL,
  `total_marks` decimal(5,2) DEFAULT NULL,
  `obtained_marks` decimal(5,2) DEFAULT NULL,
  `type` varchar(15) NOT NULL,
  `count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(20) NOT NULL,
  `credit` int(11) NOT NULL,
  `section` varchar(2) DEFAULT NULL,
  `auto_add_to_group` tinyint(1) NOT NULL,
  `expected_marks` decimal(5,2) DEFAULT NULL,
  `total_marks` decimal(5,2) DEFAULT NULL,
  `obtained_marks` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `courses_has_assessments`
--

CREATE TABLE `courses_has_assessments` (
  `c_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `assess_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `course_code` varchar(30) NOT NULL,
  `course_name` varchar(30) NOT NULL,
  `course_des` varchar(300) DEFAULT NULL,
  `file_link` varchar(100) NOT NULL,
  `post_admin` varchar(50) NOT NULL,
  `domain` varchar(20) NOT NULL,
  `p_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`course_code`, `course_name`, `course_des`, `file_link`, `post_admin`, `domain`, `p_id`, `date`) VALUES
('CSE3211', 'CSE3211', 'Lab Files Updated', 'splash.jpg ', 'ssutradhar201084@bscse.uiu.ac.bd', 'bscse.uiu.ac.bd', 14, '2022-01-12 16:45:56'),
('ENG112', 'ENG112', 'Dsa to Biology', 'Stat-205-D (3).xlsx ', 'ssutradhar201084@bscse.uiu.ac.bd', 'bscse.uiu.ac.bd', 21, '2022-01-12 16:49:57'),
('Demo', 'Demo Theory', 'Lab Files Updated', 'crudapp.zip  ', 'ssutradhar201084@bscse.uiu.ac.bd', 'bscse.uiu.ac.bd', 22, '2022-01-12 16:53:14'),
('AI ', 'AI theroy', 'Demo Lorem', 'data.sql    ', 'ssutradhar201084@bscse.uiu.ac.bd', 'bscse.uiu.ac.bd', 23, '2022-01-12 16:53:06'),
('CP2021', 'Competitive  Programming', 'Some Notes For Beginner ', 'B. Integers Shop.cpp ', 'ssutradhar201084@bscse.uiu.ac.bd', 'bscse.uiu.ac.bd', 24, '2022-01-12 17:13:43');

-- --------------------------------------------------------

--
-- Table structure for table `trimesters`
--

CREATE TABLE `trimesters` (
  `t_id` int(11) NOT NULL,
  `t_name` varchar(20) NOT NULL,
  `is_running` tinyint(1) NOT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `fees` decimal(8,2) DEFAULT NULL,
  `scholarship` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trimesters_has_courses`
--

CREATE TABLE `trimesters_has_courses` (
  `u_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `f_name` varchar(30) NOT NULL,
  `l_name` varchar(30) NOT NULL,
  `profile_pic_url` varchar(300) DEFAULT NULL,
  `university` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `u_id` int(11) NOT NULL,
  `domain` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`f_name`, `l_name`, `profile_pic_url`, `university`, `department`, `email`, `u_id`, `domain`, `password`, `date`) VALUES
('Rahul', 'Sutradhar', 'http://localhost/course-assistant-main/uploads/61de6a7e9cd9e2.48829508.jpg', 'United International University', 'CSE', 'ssutradhar201084@bscse.uiu.ac.bd', 1, 'bscse.uiu.ac.bd', '123456', '2022-01-12 05:43:26'),
('Demo', 'Sutradhar', 'img/avater.png', 'United International University', 'EEE', 'sunny.sutradhar.84@bsceee.uiu.ac.bd', 2, 'bsceee.uiu.ac.bd', '12346', '2022-01-12 08:40:19'),
('Temp', 'Dhar', 'img/avater.png', 'United International University', 'CSE', 'temp@bscse.uiu.ac.bd', 3, 'bscse.uiu.ac.bd', '123456', '2022-01-12 11:57:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assessments`
--
ALTER TABLE `assessments`
  ADD PRIMARY KEY (`assess_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `courses_has_assessments`
--
ALTER TABLE `courses_has_assessments`
  ADD PRIMARY KEY (`assess_id`,`c_id`),
  ADD KEY `fk_c_a_cid` (`c_id`),
  ADD KEY `fk_c_a_uid` (`u_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`p_id`),
  ADD UNIQUE KEY `p_id` (`p_id`);

--
-- Indexes for table `trimesters`
--
ALTER TABLE `trimesters`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `trimesters_has_courses`
--
ALTER TABLE `trimesters_has_courses`
  ADD PRIMARY KEY (`u_id`,`c_id`,`t_id`),
  ADD KEY `fk_t_c_tid` (`t_id`),
  ADD KEY `fk_t_c_cid` (`c_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `u_id` (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses_has_assessments`
--
ALTER TABLE `courses_has_assessments`
  ADD CONSTRAINT `fk_c_a_assess_id` FOREIGN KEY (`assess_id`) REFERENCES `assessments` (`assess_id`),
  ADD CONSTRAINT `fk_c_a_cid` FOREIGN KEY (`c_id`) REFERENCES `courses` (`c_id`),
  ADD CONSTRAINT `fk_c_a_uid` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`);

--
-- Constraints for table `trimesters_has_courses`
--
ALTER TABLE `trimesters_has_courses`
  ADD CONSTRAINT `fk_t_c_cid` FOREIGN KEY (`c_id`) REFERENCES `courses` (`c_id`),
  ADD CONSTRAINT `fk_t_c_tid` FOREIGN KEY (`t_id`) REFERENCES `trimesters` (`t_id`),
  ADD CONSTRAINT `fk_t_c_uid` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
