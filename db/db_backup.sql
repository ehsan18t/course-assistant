-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2022 at 03:06 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

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
  `course_id` int(11) NOT NULL,
  `asses_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assessments`
--

INSERT INTO `assessments` (`assess_id`, `expected_marks`, `total_marks`, `obtained_marks`, `type`, `count`, `course_id`, `asses_name`) VALUES
(1, '10.00', '10.00', '9.00', 'CT', 2, 1, 'CT !'),
(2, '10.00', '10.00', '3.00', 'CT', 2, 1, 'CT 2'),
(3, '28.00', '30.00', '30.00', 'MID', 1, 1, 'Mid Exam'),
(4, '40.00', '40.00', '30.00', 'FINAL', 1, 2, 'Final Exam'),
(5, '39.00', '40.00', '38.00', 'FINAL', 1, 1, 'Final Exam'),
(6, '30.00', '30.00', '30.00', 'MID', 1, 2, 'Mid Exam');

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
(1, 4, 'hi', 'test@bscse.uiu.ac.bd', '2022-01-25 08:17:18'),
(2, 3, 'Comment 45', 'ahsan@bscse.uiu.ac.bd', '2022-01-25 11:44:18');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `c_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_code` varchar(10) NOT NULL,
  `credit` int(11) NOT NULL,
  `section` varchar(2) DEFAULT NULL,
  `expected_marks` decimal(5,2) DEFAULT 0.00,
  `total_marks` decimal(5,2) DEFAULT 0.00,
  `obtained_marks` decimal(5,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`c_id`, `t_id`, `c_name`, `c_code`, `credit`, `section`, `expected_marks`, `total_marks`, `obtained_marks`) VALUES
(1, 3, 'Test', 'T 2134', 3, 'B', '77.00', '80.00', '74.00'),
(2, 3, 'Test 2', 'T 2133', 3, 'A', '70.00', '70.00', '60.00'),
(3, 4, 'Test 2', 'T 2134', 3, 'B', '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `msg_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `msg`, `sender`, `receiver`, `group_id`, `msg_time`) VALUES
(1, 'Hi', 1, 2, NULL, '2022-01-25 05:44:52'),
(2, 'hlw', 2, 1, NULL, '2022-01-25 05:45:07'),
(3, 'Hi\r\n', 1, NULL, 1, '2022-01-25 05:54:23'),
(4, 'Hlw', 2, NULL, 1, '2022-01-25 05:54:48'),
(5, 'HI\r\n', 1, NULL, 2, '2022-01-25 05:56:08'),
(6, 'hi\r\n', 2, NULL, 1, '2022-01-25 05:56:27');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`user_id`, `course_id`, `group_id`) VALUES
(1, 1, 1),
(2, 3, 1),
(1, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `course_code` varchar(30) NOT NULL,
  `course_name` varchar(300) NOT NULL,
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
('CSE 3522', 'Database Management Systems Lab', 'My notes of dbms lab. All the commands that are covered are included. All the best.', 'request.sql   ', 'test@bscse.uiu.ac.bd', 'bscse.uiu.ac.bd', 3, '2022-01-25 01:34:52'),
('CSE 2118', 'Advanced Object Oriented Programming Laboratory', 'Course outline of AOOP.', '011201122.pdf ', 'test@bscse.uiu.ac.bd', 'bscse.uiu.ac.bd', 4, '2022-01-25 01:34:45');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rating_email` varchar(50) NOT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  `domain` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rating_email`, `points`, `domain`) VALUES
('ahsan@bscse.uiu.ac.bd', 10, 'bscse.uiu.ac.bd'),
('demo@bscse.uiu.ac.bd', 10, 'bscse.uiu.ac.bd');

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
(1, 'MATH 2205', 'Probability and Statistics', 'I need notes of Probability and Statistics. If someone has please help by sharing it. Thank you', 'files/011201122.pdf', '2022-01-25 07:38:22', 'demo@bscse.uiu.ac.bd', 'bscse.uiu.ac.bd', 'ahsan@bscse.uiu.ac.bd'),
(2, 'Test 2', 'T568', 'TRest', 'files/App ideas.txt', '2022-01-25 11:42:43', 'ahsan@bscse.uiu.ac.bd', 'bscse.uiu.ac.bd', 'test@bscse.uiu.ac.bd');

-- --------------------------------------------------------

--
-- Table structure for table `study_group`
--

CREATE TABLE `study_group` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(100) DEFAULT NULL,
  `open_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `close_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `study_group`
--

INSERT INTO `study_group` (`group_id`, `group_name`, `open_date`, `close_date`) VALUES
(1, 'T 2134 [B]  Study Group ', '2022-01-25 05:54:14', '2022-06-25 00:54:14'),
(2, 'T 2133 [A]  Study Group ', '2022-01-25 05:55:49', '2022-06-25 00:55:49');

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
(1, 'Trimester 1', 1, 0, '2020-12-31 18:00:00', '2021-04-13 18:00:00', NULL, NULL, '3.33', '4.00'),
(2, 'Trimester 2', 1, 0, '2021-05-03 18:00:00', '2021-09-06 18:00:00', NULL, NULL, '3.67', '4.00'),
(3, 'Trimester 3', 1, 1, '2021-10-20 18:00:00', '2022-01-28 18:00:00', NULL, NULL, '3.67', '4.00'),
(4, 'Test', 2, 1, '2021-01-05 18:00:00', '2021-04-13 18:00:00', NULL, NULL, NULL, NULL);

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
('Ahsan', 'Khan', '61ef542de13271.99869805.png', 'United International University', 'CSE', 'ahsan@bscse.uiu.ac.bd', 1, 'bscse.uiu.ac.bd', '123456', '2022-01-25 01:36:45'),
('Ahsan', ' Khan', '61ef58fb7faa20.65503415.png', 'United International University', 'CSE', 'demo@bscse.uiu.ac.bd', 3, 'bscse.uiu.ac.bd', '123456', '2022-01-25 01:57:15'),
('Test', 'User 1', '61ef540715f261.08547696.png', 'United International University', 'CSE', 'test@bscse.uiu.ac.bd', 2, 'bscse.uiu.ac.bd', '123456', '2022-01-25 01:36:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assessments`
--
ALTER TABLE `assessments`
  ADD PRIMARY KEY (`assess_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `fk_trimester` (`t_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `fk_group` (`group_id`),
  ADD KEY `fk_sender` (`sender`),
  ADD KEY `fk_receiver` (`receiver`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD KEY `fk_participants_user` (`user_id`),
  ADD KEY `fk_participants_group` (`group_id`),
  ADD KEY `fk_participants_course` (`course_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`p_id`),
  ADD UNIQUE KEY `p_id` (`p_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_email`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `study_group`
--
ALTER TABLE `study_group`
  ADD PRIMARY KEY (`group_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assessments`
--
ALTER TABLE `assessments`
  MODIFY `assess_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `study_group`
--
ALTER TABLE `study_group`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trimesters`
--
ALTER TABLE `trimesters`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `fk_trimester` FOREIGN KEY (`t_id`) REFERENCES `trimesters` (`t_id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_group` FOREIGN KEY (`group_id`) REFERENCES `study_group` (`group_id`),
  ADD CONSTRAINT `fk_receiver` FOREIGN KEY (`receiver`) REFERENCES `users` (`u_id`),
  ADD CONSTRAINT `fk_sender` FOREIGN KEY (`sender`) REFERENCES `users` (`u_id`);

--
-- Constraints for table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `fk_participants_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`c_id`),
  ADD CONSTRAINT `fk_participants_group` FOREIGN KEY (`group_id`) REFERENCES `study_group` (`group_id`),
  ADD CONSTRAINT `fk_participants_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`u_id`);

--
-- Constraints for table `trimesters`
--
ALTER TABLE `trimesters`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
