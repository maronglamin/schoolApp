-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 07, 2022 at 06:54 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yalding_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `class_grade`
--

CREATE TABLE `class_grade` (
  `class_id` int(11) NOT NULL,
  `grade_name` varchar(20) NOT NULL,
  `class_size` int(11) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_grade`
--

INSERT INTO `class_grade` (`class_id`, `grade_name`, `class_size`, `deleted`) VALUES
(1, 'Grade 7 circle', 25, 0),
(2, 'Grade 7 Square', 30, 0),
(3, 'Grade 8 circle', 20, 0),
(4, 'Grade 8 Square', 30, 0),
(5, 'Grade 9 circle', 27, 0),
(6, 'Grade 9 Square', 30, 0);

-- --------------------------------------------------------

--
-- Table structure for table `class_teacher`
--

CREATE TABLE `class_teacher` (
  `table_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `removed_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_teacher`
--

INSERT INTO `class_teacher` (`table_id`, `teacher_id`, `class_id`, `removed_status`) VALUES
(1, 7, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `enroll_student`
--

CREATE TABLE `enroll_student` (
  `table_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `applied_id` int(11) NOT NULL,
  `check_date` varchar(75) NOT NULL,
  `class_id` varchar(25) DEFAULT NULL,
  `app_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enroll_student`
--

INSERT INTO `enroll_student` (`table_id`, `user_id`, `applied_id`, `check_date`, `class_id`, `app_status`) VALUES
(5, 1100, 8, '2022-01-02', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_records`
--

CREATE TABLE `payment_records` (
  `record_id` int(11) NOT NULL,
  `pay_type` varchar(25) NOT NULL,
  `pay_date` varchar(25) NOT NULL,
  `open_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_records`
--

INSERT INTO `payment_records` (`record_id`, `pay_type`, `pay_date`, `open_status`) VALUES
(1, 'first term', '2022-01-03', 0),
(2, 'Second Term', '2022-01-31', 0),
(3, 'first term', '2022-01-01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `start_enrollment`
--

CREATE TABLE `start_enrollment` (
  `id` int(11) NOT NULL,
  `date_open` timestamp NOT NULL DEFAULT current_timestamp(),
  `opened` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `start_enrollment`
--

INSERT INTO `start_enrollment` (`id`, `date_open`, `opened`) VALUES
(1, '2021-12-18 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject_junior`
--

CREATE TABLE `subject_junior` (
  `subj_no` int(11) NOT NULL,
  `subj_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_junior`
--

INSERT INTO `subject_junior` (`subj_no`, `subj_name`) VALUES
(1, 'English Language'),
(2, 'Mathematics'),
(3, 'General Science'),
(5, 'Agricultural sceince'),
(6, 'French');

-- --------------------------------------------------------

--
-- Table structure for table `termly_paid_records`
--

CREATE TABLE `termly_paid_records` (
  `paid_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `receipt_no` varchar(25) NOT NULL,
  `amount_paid` varchar(10) NOT NULL,
  `date_paid` varchar(25) NOT NULL,
  `term_paid` int(11) NOT NULL,
  `comp_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `termly_paid_records`
--

INSERT INTO `termly_paid_records` (`paid_id`, `student_id`, `receipt_no`, `amount_paid`, `date_paid`, `term_paid`, `comp_status`) VALUES
(1, 1100, '1001654', '8000', '2022-01-03', 1, '1'),
(2, 1100, '1001655', '8000', '2022-01-31', 2, '2'),
(4, 1100, '1001656', '4000', '2022-01-01', 3, '2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_name` varchar(150) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_role` varchar(75) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `tele` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `stud_parent_name` varchar(50) DEFAULT NULL,
  `address` varchar(15) DEFAULT NULL,
  `pschool` varchar(50) DEFAULT NULL,
  `eth` varchar(15) DEFAULT NULL,
  `date_of_birth` varchar(50) DEFAULT NULL,
  `stud_place_birth` varchar(100) DEFAULT NULL,
  `file_one` text DEFAULT NULL,
  `file_2` text DEFAULT NULL,
  `join_date` timestamp NULL DEFAULT current_timestamp(),
  `last_login` timestamp NULL DEFAULT NULL,
  `change_password` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `permission` tinyint(4) NOT NULL DEFAULT 1,
  `deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `user_name`, `password`, `user_role`, `gender`, `tele`, `mobile`, `stud_parent_name`, `address`, `pschool`, `eth`, `date_of_birth`, `stud_place_birth`, `file_one`, `file_2`, `join_date`, `last_login`, `change_password`, `status`, `permission`, `deleted`) VALUES
(1, 'comma admin', 'admin@yalding.edu.gm', 'koma', '$2y$10$r/my/Q2j9Deqa6DC3o.z4eK/jkWHRHC6dQm1ik2S4ZL9fHvre8Bva', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-29 09:34:13', '2022-01-06 23:19:37', 1, 0, 1, 0),
(7, 'Modou Lamin Marong', 'mlm123@gmail.com', 'afang', '$2y$10$8b./b1SiUVvcM3YKwriAa.gvwa6UuWGo3tiWH1/hY7CXt1TgMcwNi', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-11-28 18:42:40', NULL, 1, 0, 1, 0),
(8, 'student full name', 'mlm@rev.edu.gm', 'student', '$2y$10$Wa9/xT9jIH2H1zWFy0EW/uWc.DNoGPHYkfDvwe2MV7fmw/9otrC8G', '3', '1', '5823008', '5823008', 'p name', 'Brikama', 'manduar lower basic school', 'banjul', '2021-12-04', 'Manduar', '/photos/2021-12-18 12:25-bird.jpg', '/photos/2021-12-18 12:25-butter.jpg', '2021-11-28 21:53:42', NULL, 1, 1, 1, 0),
(9, 'Modou Lamin Marong', 'email@email.com', 'afanglamin', '$2y$10$KNrQZYyNzqaklX92l.8n5.QdrTu4bXjSLF.RYzrWeJk/MpIm1xRb.', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-12-18 04:15:14', NULL, 1, 0, 1, 0),
(10, 'test', 'test@gmail.com', 'test', '$2y$10$KQQJ3v9nRiJGd2sALD2THOfT6Xb77NE..ncmjvhSkj1bwW7T1BDwG', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-12-18 04:17:01', NULL, 0, 0, 1, 0),
(11, 'st2', 'st2@g.com', 'st2', '$2y$10$TWuNhFYyPgqdNZJXh0War.7ht.1bmu98c.I60rsMShuaJZyBqu.n.', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-12-25 11:51:09', NULL, 0, 0, 1, 0),
(12, 'Sheikh secka', 'marong@database.gm', 'usertest', '$2y$10$T4HfMndPnUW2GgC.LQsom.Qpjb4TBd6V3VlwyxJw0sGBNcbZarn3C', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-12-26 13:42:04', NULL, 0, 0, 1, 0),
(13, 'name', 'name@m.com', 'username', '$2y$10$vjaY8SEn8RHaCAtJlJgzD.1uGb1NHHZD9cRf15wLb1cjNIyPqUAYK', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-12-26 13:48:17', NULL, 0, 0, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class_grade`
--
ALTER TABLE `class_grade`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `class_teacher`
--
ALTER TABLE `class_teacher`
  ADD PRIMARY KEY (`table_id`);

--
-- Indexes for table `enroll_student`
--
ALTER TABLE `enroll_student`
  ADD PRIMARY KEY (`table_id`);

--
-- Indexes for table `payment_records`
--
ALTER TABLE `payment_records`
  ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `start_enrollment`
--
ALTER TABLE `start_enrollment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_junior`
--
ALTER TABLE `subject_junior`
  ADD PRIMARY KEY (`subj_no`);

--
-- Indexes for table `termly_paid_records`
--
ALTER TABLE `termly_paid_records`
  ADD PRIMARY KEY (`paid_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class_grade`
--
ALTER TABLE `class_grade`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `class_teacher`
--
ALTER TABLE `class_teacher`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `enroll_student`
--
ALTER TABLE `enroll_student`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_records`
--
ALTER TABLE `payment_records`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `start_enrollment`
--
ALTER TABLE `start_enrollment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subject_junior`
--
ALTER TABLE `subject_junior`
  MODIFY `subj_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `termly_paid_records`
--
ALTER TABLE `termly_paid_records`
  MODIFY `paid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
