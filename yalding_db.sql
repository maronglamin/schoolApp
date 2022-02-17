-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2022 at 04:39 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(1, 'Grade 7 circle', 25, 1),
(2, 'Grade 7 Square', 30, 1),
(3, 'Grade 8 circle', 20, 1),
(4, 'Grade 8 Square', 30, 1),
(5, 'Grade 9 circle', 27, 1),
(6, 'Grade 9 Square', 30, 1),
(8, 'SEVEN A', 40, 0),
(9, 'SEVEN B', 40, 0),
(10, 'EIGHT A ', 40, 0),
(11, 'EIGHT B ', 40, 0),
(12, 'NINE A ', 40, 0),
(13, 'NINE B', 40, 0);

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
(5, 19, 1, 1),
(6, 19, 2, 1),
(7, 29, 8, 0),
(8, 21, 8, 1),
(9, 21, 9, 1),
(10, 21, 10, 0),
(11, 29, 9, 0),
(12, 21, 11, 0),
(13, 21, 12, 0),
(14, 21, 13, 0),
(15, 20, 8, 0),
(16, 20, 9, 0);

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
  `grades_score` text DEFAULT NULL,
  `app_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enroll_student`
--

INSERT INTO `enroll_student` (`table_id`, `user_id`, `applied_id`, `check_date`, `class_id`, `grades_score`, `app_status`) VALUES
(9, 1, 17, '2022-02-12', '1', NULL, 1),
(10, 2, 18, '2022-02-12', '2', NULL, 1),
(11, 3, 33, '2022-01-03', '8', NULL, 1),
(12, 4, 34, '2022-01-03', '8', NULL, 1),
(13, 5, 35, '2022-01-03', '8', NULL, 1),
(14, 6, 36, '2022-01-03', '8', NULL, 1),
(15, 7, 37, '2022-01-03', '8', NULL, 1),
(16, 8, 38, '2022-01-03', '8', NULL, 1),
(17, 9, 39, '2022-01-03', '8', NULL, 1),
(18, 10, 40, '2022-01-03', '8', NULL, 1),
(19, 11, 41, '2022-01-03', '8', NULL, 1),
(20, 12, 42, '2022-01-03', '8', NULL, 1),
(21, 13, 43, '2022-01-03', '9', NULL, 1),
(22, 14, 44, '2022-01-03', '9', NULL, 1),
(23, 15, 45, '2022-01-03', '9', NULL, 1),
(24, 16, 46, '2022-01-03', '9', NULL, 1),
(25, 17, 47, '2022-01-03', '9', NULL, 1),
(26, 18, 48, '2022-01-03', '9', NULL, 1),
(27, 19, 49, '2022-01-03', '9', NULL, 1),
(28, 20, 50, '2022-01-03', '9', NULL, 1),
(29, 21, 51, '2022-01-03', '9', NULL, 1);

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
(4, 'Second', '2022-01-03', 0),
(5, 'SECOND TERM ', '2022-01-03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `publish_grades`
--

CREATE TABLE `publish_grades` (
  `record_id` int(11) NOT NULL,
  `term_published` int(11) NOT NULL,
  `date_published` timestamp NOT NULL DEFAULT current_timestamp(),
  `published` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `table_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `term_one_test_one` varchar(25) DEFAULT NULL,
  `term_one_test_two` varchar(25) DEFAULT NULL,
  `term_one_exam` varchar(25) DEFAULT NULL,
  `term_two_test_one` varchar(25) DEFAULT NULL,
  `term_two_test_two` varchar(25) DEFAULT NULL,
  `term_two_exam` varchar(25) DEFAULT NULL,
  `term_three_test_one` varchar(15) DEFAULT NULL,
  `term_three_test_two` varchar(15) DEFAULT NULL,
  `term_three_exams` varchar(15) DEFAULT NULL,
  `score_status` tinyint(4) NOT NULL DEFAULT 0,
  `published` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`table_id`, `teacher_id`, `subject_id`, `class_id`, `student_id`, `term_one_test_one`, `term_one_test_two`, `term_one_exam`, `term_two_test_one`, `term_two_test_two`, `term_two_exam`, `term_three_test_one`, `term_three_test_two`, `term_three_exams`, `score_status`, `published`) VALUES
(6, 29, 18, 8, 4, '25', '20', '39', '22', '21', '49', NULL, NULL, NULL, 0, 0),
(7, 29, 18, 8, 6, '14', '21', '32', '15', '25', '35', NULL, NULL, NULL, 0, 0),
(8, 29, 18, 8, 8, '24', '22', '15', '14', '24', '25', NULL, NULL, NULL, 0, 0),
(9, 29, 18, 8, 12, '25', '21', '21', '24', '12', '15', NULL, NULL, NULL, 0, 0),
(10, 29, 18, 8, 5, '18', '25', '14', '25', '22', '13', NULL, NULL, NULL, 0, 0),
(11, 29, 18, 8, 7, '25', '21', '35', '23', '21', '44', NULL, NULL, NULL, 0, 0),
(12, 29, 18, 8, 11, '15', '21', '35', '23', '25', '38', NULL, NULL, NULL, 0, 0),
(13, 29, 18, 9, 14, '25', '21', '23', '25', '12', '50', NULL, NULL, NULL, 0, 0),
(14, 29, 18, 9, 16, '15', '12', '13', '25', '12', '35', NULL, NULL, NULL, 0, 0),
(15, 29, 18, 9, 18, '25', '12', '32', '15', '24', '32', NULL, NULL, NULL, 0, 0),
(16, 29, 18, 9, 20, '15', '12', '31', '24', '25', '21', NULL, NULL, NULL, 0, 0),
(17, 29, 18, 9, 13, '23', '25', '32', '23', '25', '21', NULL, NULL, NULL, 0, 0),
(18, 29, 18, 9, 15, '21', '23', '50', '12', '23', '39', NULL, NULL, NULL, 0, 0),
(19, 29, 18, 9, 19, '12', '23', '25', '15', '24', '15', NULL, NULL, NULL, 0, 0),
(20, 29, 18, 9, 21, '23', '25', '38', '21', '24', '45', NULL, NULL, NULL, 0, 0),
(21, 29, 18, 9, 17, '21', '23', '25', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(22, 20, 14, 8, 4, '12', '21', '38', '23', '23', '47', NULL, NULL, NULL, 0, 0);

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
(11, 'ENGLISH LANGUAGE'),
(12, 'MATHEMATICS'),
(13, 'G/SCIENCE'),
(14, 'SOCIAL AND ENVIRONMENTAL STUDIES'),
(15, 'AGRICULTURAL SCIENCE'),
(16, 'PHYSICAL EDUCATION '),
(17, 'RELIGIOUS STUDIES'),
(18, 'COMPUTER STUDIES'),
(19, 'ARTS AND CRAFTS'),
(20, 'FRENCH ');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subject`
--

CREATE TABLE `teacher_subject` (
  `table_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `status_del` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_subject`
--

INSERT INTO `teacher_subject` (`table_id`, `subject_id`, `teacher_id`, `class_id`, `status_del`) VALUES
(4, 11, 30, 8, 0),
(5, 11, 30, 9, 0),
(6, 11, 30, 10, 0),
(7, 11, 30, 11, 0),
(8, 11, 30, 12, 0),
(9, 11, 30, 13, 0),
(10, 12, 24, 8, 0),
(11, 12, 24, 9, 0),
(12, 12, 24, 10, 0),
(13, 12, 24, 11, 0),
(14, 12, 24, 12, 0),
(15, 12, 24, 13, 0),
(16, 13, 22, 8, 0),
(17, 13, 24, 9, 0),
(18, 13, 22, 10, 0),
(19, 13, 22, 11, 0),
(20, 13, 22, 12, 0),
(21, 13, 22, 13, 0),
(22, 14, 20, 8, 0),
(23, 14, 20, 9, 0),
(24, 14, 20, 10, 0),
(25, 14, 20, 10, 1),
(26, 14, 20, 11, 0),
(27, 14, 20, 12, 0),
(28, 14, 20, 13, 0),
(29, 15, 25, 8, 0),
(30, 15, 25, 9, 0),
(31, 15, 25, 10, 0),
(32, 15, 25, 11, 0),
(33, 15, 25, 12, 0),
(34, 15, 25, 13, 0),
(35, 17, 26, 8, 0),
(36, 17, 26, 9, 0),
(37, 17, 26, 10, 0),
(38, 17, 26, 11, 0),
(39, 17, 26, 12, 0),
(40, 17, 26, 13, 0),
(41, 18, 29, 8, 0),
(42, 18, 29, 9, 0),
(43, 18, 21, 10, 0),
(44, 18, 21, 11, 0),
(45, 18, 21, 12, 0),
(46, 18, 21, 13, 0),
(47, 19, 23, 8, 0),
(48, 19, 23, 9, 0),
(49, 19, 23, 10, 0),
(50, 19, 23, 10, 1),
(51, 19, 23, 11, 0),
(52, 19, 23, 12, 0),
(53, 19, 23, 13, 0),
(54, 20, 28, 8, 0),
(55, 20, 28, 9, 0),
(56, 20, 28, 10, 0),
(57, 20, 28, 12, 0);

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
(5, 4, '11325', '1300', '2022-02-12', 5, '2');

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
  `last_login` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `join_date` timestamp NULL DEFAULT current_timestamp(),
  `change_password` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `permission` tinyint(4) NOT NULL DEFAULT 1,
  `deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `user_name`, `password`, `user_role`, `gender`, `tele`, `mobile`, `stud_parent_name`, `address`, `pschool`, `eth`, `date_of_birth`, `stud_place_birth`, `file_one`, `file_2`, `last_login`, `join_date`, `change_password`, `status`, `permission`, `deleted`) VALUES
(1, 'Koma admin', 'admin@yalding.edu.gm', 'koma', '$2y$10$QA.1Z0u9kZ7oZFjzKeb4Le0pea6U5y.n1IzE4TphrG8CWLk5FPozi', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-17 16:26:27', '2021-05-29 09:34:13', 1, 0, 1, 0),
(17, 'Yaya Bah', 'ybah@yalding.gm', 'ybah', '$2y$10$qmf8rEYlNbLqUSac4M0qFOpex9ty5WNt5si1HrOqTPhdJkcNlSjh.', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-16 13:57:37', '2022-02-12 13:48:05', 0, 1, 1, 0),
(18, 'Alasan Barry', 'abarry@yalding.gm', 'abarry', '$2y$10$iMWmtpLrjvLUVvoRvKoFEOUXix.B60DJszTaFsP5evjxRc.qoAfDm', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-17 16:25:44', '2022-02-12 13:48:35', 0, 1, 1, 0),
(20, 'Foday jabbie', 'fjabbie@yalding.gm', 'fjabbie', '$2y$10$/ik7sA6bXIwldkhld3JGleWTkoZu7JgoK8d1PftPhNVBQQgPGts7e', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 15:52:37', '2022-02-12 14:12:20', 1, 0, 1, 0),
(21, 'Baba Koma ', 'bkoma@yalding.gm', 'bkoma', '$2y$10$RIEfwWWdI6vXQDU/5Dy/a.CoZD80Xzz0ZAGlm03byOykp1rzjIyKC', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 15:27:27', '2022-02-12 14:13:02', 1, 0, 1, 0),
(22, 'Modou Sowe ', 'msowe@yalding.gm', 'msowe', '$2y$10$ijTFje5aqcnL5EVYLNa.9ecM0lTJIIO5OS8qAf.xWwcmTpNuBdcnS', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 14:14:36', 0, 0, 1, 0),
(23, 'Yusupha Colley', 'ycolley@yalding.gm', 'ycolley ', '$2y$10$kIzw5FHFMomoKcl7T6.Ite5tJiAapVS278MI2AgDniOdN2nxkYIcm', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 14:15:04', 0, 0, 1, 0),
(24, 'Alieu Cham ', 'acham@yalding.gm', 'acham ', '$2y$10$NiqpYFYTBMmTbICnW/IvUeZ7T8BmC6B21CSXvp8WLh4g.mC3Sa/eG', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 14:18:09', 0, 0, 1, 0),
(25, 'Salifu Jallow', 'sjallow@yalding.gm', 'sjallow', '$2y$10$fkjWmSEIIZYasMhymW4bge6IhAUJf.oyEVPk727IMD.IW7vEQgOBa', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 14:19:15', 0, 0, 1, 0),
(26, 'Lamin Conta', 'lconta@yalding.gm', 'lconta', '$2y$10$5SZDFVaXBImlIRu2n6xO3ePGyWETImT7MwiaAlR7d0brgcHSl9Mwi', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 14:20:04', 0, 0, 1, 0),
(27, 'Omar Moses Demba', 'omdemba@yalding.gm', 'omdemba', '$2y$10$4KnYVrO5CIJfQ7RQFF0n8OCy9XSoblhfyfmKgay273HUiLRejtHa2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 14:20:34', 0, 0, 1, 0),
(28, 'Aly Bah', 'abah@yalding.gm', 'abah', '$2y$10$aRqYCgHV0sQcf4262ANiVu/LZ6UmuXO5MHVX1KNdtFyOHxvjibCBC', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 14:21:17', 0, 0, 1, 0),
(29, 'Masaneh Kinteh', 'mkinteh@yalding.gm', 'mkinteh', '$2y$10$JTZQIUZ2G6afSgMf4YgunebPzuyMdJrCIpN2OdGb3mXcFW.D/wRZO', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 15:45:07', '2022-02-12 14:21:59', 1, 0, 1, 0),
(30, 'Saikou Saidykhan ', 'ssaidykhan@yalding.gm', 'ssaidykhan', '$2y$10$nkKMY9HThWxl8yt7liuoOeRp.9hOHmMWnKffIMFILV2WZPNNrRRWS', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 14:23:29', 0, 0, 1, 0),
(33, 'Balamin Jawla', 'bjawla2021@yalding.gm', 'bjawla2021', '$2y$10$IFZCTnKBYB2r0xkoRYN8iutQgcAKZEbwbGWdagMmmJmGWWqWSjRwm', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 15:18:29', '2022-02-12 15:04:59', 0, 1, 1, 0),
(34, 'Bubacarr Sonko', 'bsonko2021@yalding.gm', 'bsonko2021', '$2y$10$xlqDOwf4jxkvuCRy99zMCOCKQLVcufCCMhnKvfKeEbnlWi443wese', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-16 09:10:38', '2022-02-12 15:05:34', 0, 1, 1, 0),
(35, 'Bubacarr Jabbie', 'bjabbie2021@yalding.gm', 'bjabbie2021', '$2y$10$iSM5a15PsKu80Gm04qo2aueJR3GpeGwZ.YXZs5PLZdYkOcbt7cEHi', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 15:18:52', '2022-02-12 15:06:33', 0, 1, 1, 0),
(36, 'Yusupha Baldeh', 'ybaldeh2021@yalding.gm', 'ybaldeh2021', '$2y$10$HE3cipXO4pZa2ABAS3YFEuV49/kmqiJNoAi5bKJd6/kIOlWn5xD12', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 15:19:14', '2022-02-12 15:07:14', 0, 1, 1, 0),
(37, 'Malamin Drammeh ', 'mldrammeh2021@yalding.gm', 'mldrammeh2021', '$2y$10$0PXJHkscHVWvfDNQlyYDMuEFoZYD8a8xth51xHFMeCDRB9QFZWc72', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 15:19:27', '2022-02-12 15:07:55', 0, 1, 1, 0),
(38, 'Adama Bah', 'abah2021@yalding.gm', 'abah2021', '$2y$10$K0Q2h2vsu1Rvw6u.dcTLKetfgGHXYct7psEG/NyD90SUYuozzEx0m', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 15:19:38', '2022-02-12 15:08:41', 0, 1, 1, 0),
(39, 'Awa BAh', 'awabah2021@yalding.gm', 'awabah2021', '$2y$10$00CgwN7AfpzvhrC3CzZ4deBgpfgP8As5uoqeO.cUnOq0OSlhAK/g.', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 15:19:49', '2022-02-12 15:09:22', 0, 1, 1, 0),
(40, 'Fatoumata Camara', 'fcamara2021@yalding.gm', 'fcamara2021', '$2y$10$DFMx8m50zIhTK7IWis/dI.s23TNX6YfjeLbUoakjY30ER4r.TstNW', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 15:19:58', '2022-02-12 15:09:58', 0, 1, 1, 0),
(41, 'Awa Juwara', 'awajuwara2021@yalding.gm', 'awajuwa2021', '$2y$10$LpPtDPnWbdXgvx67GDn.iuLc1acQAMeyS9cR1zwLQuGx8O7SvLd2a', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 15:20:10', '2022-02-12 15:10:43', 0, 1, 1, 0),
(42, 'Fatoumataa Jula Bojang', 'fjulabojang2021@yalding.gm', 'fjulabojang2021', '$2y$10$iGFJfiAo9GbgbQbdkk734Oq9AhCxx3yqwtaIJvIcn/KCzm.tMuLbu', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 15:20:20', '2022-02-12 15:11:31', 0, 1, 1, 0),
(43, 'Muhammed S Hydara', 'mshydara2021@yalding.gm', 'mshydara2021', '$2y$10$pjdcmxs3Wwvo9KNUl6YJ.e2qWYw9sIugDDswHiqAoz/H0KZU.OCQS', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 15:20:32', '2022-02-12 15:12:15', 0, 1, 1, 0),
(44, 'Lamin Njie', 'lnjie2021@yalding.gm', 'lnjie2021', '$2y$10$wFDNeOdoX7jQ2LEAgFdnauHQ8UgJF/kv/fdKmSUSYqxi7M//l0fPS', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 15:20:43', '2022-02-12 15:13:01', 0, 1, 1, 0),
(45, 'Baye Lowe', 'blowe2021@yalding.gm', 'blowe2021', '$2y$10$k7shTI6rZGNkCKfbqjV.KOhtNdlSUKtlbtzoinMzqfqgb65MY6rlS', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 15:20:51', '2022-02-12 15:13:39', 0, 1, 1, 0),
(46, 'Modou Lamin Susso ', 'mlsusso2021@yalding.gm', 'mlsusso2021', '$2y$10$7ClFtS6ArgV1Q0.6sdEYSuHc41CLXBf.gNoSoa4yitAFMoz1ISHTm', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 15:21:00', '2022-02-12 15:14:22', 0, 1, 1, 0),
(47, 'Kumba Jonga', 'kjonga2021@yalding.gm', 'kjonga2021', '$2y$10$4aKaYwG94ZE57gR91DrZkuYeCf/ycuxZ5UkxIqYna8VhcVkSGMjkW', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 15:21:09', '2022-02-12 15:14:56', 0, 1, 1, 0),
(48, 'Isatou Darboe', 'idarboe2021@yalding.gm', 'idarboe2021', '$2y$10$zYn/LjAKsuQUhyvg21jpw.csSNeiXzSdvOqswtxu9zgofsWvZRZ9i', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 15:21:18', '2022-02-12 15:15:37', 0, 1, 1, 0),
(49, 'Mama Njie', 'mnjie2021@yalding.gm', 'mnjie2021', '$2y$10$vwPnbNJWJYyIucyV.c6xlewsIKny3dc6.3W1.zqdWK65cT9673AFu', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 15:21:26', '2022-02-12 15:16:24', 0, 1, 1, 0),
(50, 'Awa Bojang', 'awabojang2021@yalding.gm', 'awabojang2021', '$2y$10$NKqo13yaAzruT96NFUclTOP8sxY5bfktDbZO.KNrjuW4V018g3HAi', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 15:21:35', '2022-02-12 15:16:58', 0, 1, 1, 0),
(51, 'Bintou Minteh ', 'bminteh2021@yalding.gm', 'bminteh2021', '$2y$10$xv59P6If3Oy6w61p80jpF.pxe9XdpHnIZgrrI3pWtQDv2aJd8fOde', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-12 15:21:44', '2022-02-12 15:17:41', 0, 1, 1, 0);

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
-- Indexes for table `publish_grades`
--
ALTER TABLE `publish_grades`
  ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`table_id`);

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
-- Indexes for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
  ADD PRIMARY KEY (`table_id`);

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
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `class_teacher`
--
ALTER TABLE `class_teacher`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `enroll_student`
--
ALTER TABLE `enroll_student`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `payment_records`
--
ALTER TABLE `payment_records`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `publish_grades`
--
ALTER TABLE `publish_grades`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=297;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `start_enrollment`
--
ALTER TABLE `start_enrollment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subject_junior`
--
ALTER TABLE `subject_junior`
  MODIFY `subj_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `termly_paid_records`
--
ALTER TABLE `termly_paid_records`
  MODIFY `paid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
