-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2022 at 09:45 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

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
  `count` int(11) DEFAULT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `c_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `credit` int(11) NOT NULL,
  `section` varchar(2) DEFAULT NULL,
  `auto_add_to_group` tinyint(1) NOT NULL,
  `expected_marks` decimal(5,2) DEFAULT NULL,
  `total_marks` decimal(5,2) DEFAULT NULL,
  `obtained_marks` decimal(5,2) DEFAULT NULL,
  `c_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`c_id`, `t_id`, `c_name`, `credit`, `section`, `auto_add_to_group`, `expected_marks`, `total_marks`, `obtained_marks`, `c_code`) VALUES
(5, 20, 'Data Structure/Data Structure and Algorithms I', 3, 'A', 0, '90.00', '100.00', '88.00', 'CSE 2215'),
(6, 20, 'Data Structure Laboratory/Data Structure and Algorithms I Laboratory', 1, 'A', 0, '90.00', '100.00', '87.00', 'CSE 2216'),
(7, 20, 'Database Management Systems', 3, 'A', 0, '90.00', '100.00', '86.00', 'CSE 3521'),
(8, 20, 'Database Management Systems Laboratory', 1, 'B', 0, '90.00', '100.00', '88.00', 'CSE 3522'),
(10, 20, 'Test Test Test', 2, 'A', 0, '12.00', '100.00', '90.00', 'CSE233');

-- --------------------------------------------------------

--
-- Table structure for table `massages`
--

CREATE TABLE `massages` (
  `msg_id` int(11) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
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
('CSE3211', 'CSE3211', 'Lab Files Updated', 'splash.jpg ', 'ssutradhar201084@bscse.uiu.ac.bd', 'bscse.uiu.ac.bd', 14, '2022-01-12 10:45:56'),
('ENG112', 'ENG112', 'Dsa to Biology', 'Stat-205-D (3).xlsx ', 'ssutradhar201084@bscse.uiu.ac.bd', 'bscse.uiu.ac.bd', 21, '2022-01-12 10:49:57'),
('Demo', 'Demo Theory', 'Lab Files Updated', 'crudapp.zip  ', 'ssutradhar201084@bscse.uiu.ac.bd', 'bscse.uiu.ac.bd', 22, '2022-01-12 10:53:14'),
('AI ', 'AI theroy', 'Demo Lorem', 'data.sql    ', 'ssutradhar201084@bscse.uiu.ac.bd', 'bscse.uiu.ac.bd', 23, '2022-01-12 10:53:06'),
('CP2021', 'Competitive  Programming', 'Some Notes For Beginner ', 'B. Integers Shop.cpp ', 'ssutradhar201084@bscse.uiu.ac.bd', 'bscse.uiu.ac.bd', 24, '2022-01-12 11:13:43'),
('CSE 1722', 'Test Course', 'This is some description to test the feature. Just making it long without any reason. lol thanks for reading and wasting your time.', '', 'ahsan@bscse.uiu.ac.bd', 'bscse.uiu.ac.bd', 25, '2022-01-13 14:43:59');

-- --------------------------------------------------------

--
-- Table structure for table `study_group`
--

CREATE TABLE `study_group` (
  `group_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `group_name` varchar(100) DEFAULT NULL,
  `open_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `close_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trimesters`
--

CREATE TABLE `trimesters` (
  `t_id` int(11) NOT NULL,
  `t_name` varchar(20) NOT NULL,
  `u_id` int(11) NOT NULL,
  `is_running` tinyint(1) NOT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `fees` decimal(8,2) DEFAULT NULL,
  `scholarship` int(11) DEFAULT NULL,
  `cgpa` decimal(3,2) DEFAULT NULL,
  `expected_cgpa` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trimesters`
--

INSERT INTO `trimesters` (`t_id`, `t_name`, `u_id`, `is_running`, `start_date`, `end_date`, `fees`, `scholarship`, `cgpa`, `expected_cgpa`) VALUES
(15, '201 - Spring 2020', 12, 0, '2020-01-17 18:00:00', '2020-04-16 18:00:00', NULL, NULL, '3.83', '4.00'),
(16, '202 - Summer 2020', 12, 0, '2020-04-30 18:00:00', '2020-09-13 18:00:00', NULL, NULL, '3.67', '4.00'),
(17, '203 - Fall 2020', 12, 0, '2020-09-22 18:00:00', '2021-01-04 18:00:00', NULL, NULL, '3.42', '3.67'),
(20, '211 - Spring 2021', 12, 0, '2021-01-06 18:00:00', '2021-04-21 18:00:00', NULL, NULL, '3.67', '3.67');

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
('Ahsan', 'Khan', '61dfe555d1e003.28100721.png', 'United International University', 'CSE', 'ahsan@bscse.uiu.ac.bd', 12, 'bscse.uiu.ac.bd', '123456', '2022-01-13 08:39:49'),
('demo', 'user', 'avatar.png', 'uiu', 'cse', 'demouser@bscse.uiu.ac.bd', 1, '@bscse.uiu.ac.bd', '123456', '2022-01-13 08:25:04'),
('Rahul', 'Sutradhar', '61df2346db42a6.79430499.png', 'United International University', 'CSE', 'ssutradhar201084@bscse.uiu.ac.bd', 3, 'bscse.uiu.ac.bd', '123456', '2022-01-13 08:18:51'),
('Demo', 'Sutradhar', 'avater.png', 'United International University', 'EEE', 'sunny.sutradhar.84@bsceee.uiu.ac.bd', 4, 'bsceee.uiu.ac.bd', '12346', '2022-01-13 08:25:15'),
('Temp', 'Dhar', 'avater.png', 'United International University', 'CSE', 'temp@bscse.uiu.ac.bd', 5, 'bscse.uiu.ac.bd', '123456', '2022-01-13 08:25:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_has_massages`
--

CREATE TABLE `user_has_massages` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `msg_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD PRIMARY KEY (`c_id`),
  ADD UNIQUE KEY `c_code` (`c_code`),
  ADD UNIQUE KEY `c_code_2` (`c_code`),
  ADD KEY `fk_trimester` (`t_id`);

--
-- Indexes for table `massages`
--
ALTER TABLE `massages`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `fk_group` (`group_id`),
  ADD KEY `fk_sender` (`sender`),
  ADD KEY `fk_receiver` (`receiver`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`p_id`),
  ADD UNIQUE KEY `p_id` (`p_id`);

--
-- Indexes for table `study_group`
--
ALTER TABLE `study_group`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `fk_course` (`course_id`);

--
-- Indexes for table `trimesters`
--
ALTER TABLE `trimesters`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `fk_user` (`u_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `u_id` (`u_id`);

--
-- Indexes for table `user_has_massages`
--
ALTER TABLE `user_has_massages`
  ADD PRIMARY KEY (`msg_id`,`group_id`,`user_id`),
  ADD KEY `fk_relational_group` (`group_id`),
  ADD KEY `fk_relational_user` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `massages`
--
ALTER TABLE `massages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `study_group`
--
ALTER TABLE `study_group`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trimesters`
--
ALTER TABLE `trimesters`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `fk_trimester` FOREIGN KEY (`t_id`) REFERENCES `trimesters` (`t_id`);

--
-- Constraints for table `massages`
--
ALTER TABLE `massages`
  ADD CONSTRAINT `fk_group` FOREIGN KEY (`group_id`) REFERENCES `study_group` (`group_id`),
  ADD CONSTRAINT `fk_receiver` FOREIGN KEY (`receiver`) REFERENCES `users` (`u_id`),
  ADD CONSTRAINT `fk_sender` FOREIGN KEY (`sender`) REFERENCES `users` (`u_id`);

--
-- Constraints for table `study_group`
--
ALTER TABLE `study_group`
  ADD CONSTRAINT `fk_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`c_id`);

--
-- Constraints for table `trimesters`
--
ALTER TABLE `trimesters`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`);

--
-- Constraints for table `user_has_massages`
--
ALTER TABLE `user_has_massages`
  ADD CONSTRAINT `fk_relational_group` FOREIGN KEY (`group_id`) REFERENCES `study_group` (`group_id`),
  ADD CONSTRAINT `fk_relational_massages` FOREIGN KEY (`msg_id`) REFERENCES `massages` (`msg_id`),
  ADD CONSTRAINT `fk_relational_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`u_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
