-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2024 at 03:49 AM
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
-- Database: `db_enrollment`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_year`
--

CREATE TABLE `academic_year` (
  `year_ID` int(11) NOT NULL,
  `year_from` int(11) NOT NULL,
  `year_to` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=Inactive, 1=Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_year`
--

INSERT INTO `academic_year` (`year_ID`, `year_from`, `year_to`, `status`, `created_at`) VALUES
(15, 2023, 2024, 1, '2024-03-26 17:46:20'),
(16, 2000, 2001, 0, '2024-03-26 18:17:11'),
(17, 2001, 2002, 0, '2024-03-26 18:35:27');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_ID` int(11) NOT NULL,
  `dept_ID` int(11) NOT NULL,
  `course_name` varchar(150) NOT NULL,
  `course_desc` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_ID`, `dept_ID`, `course_name`, `course_desc`, `created_at`) VALUES
(9, 16, 'College of Criminal Justice Education', 'Sample', '2024-03-27 09:44:23'),
(14, 19, 'Information Technology', 'Sample', '2024-03-27 10:34:36'),
(15, 19, 'Computer Science', 'Sample', '2024-03-27 10:34:53'),
(16, 20, 'BS Elementary Education', 'Sample', '2024-03-27 10:35:18'),
(17, 22, 'Accountancy', 'Sample', '2024-03-27 10:35:34');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_ID` int(11) NOT NULL,
  `year_ID` int(11) NOT NULL,
  `dept_name` varchar(255) NOT NULL,
  `motto` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_ID`, `year_ID`, `dept_name`, `motto`, `created_at`) VALUES
(16, 15, 'College of Criminology', 'dsadads', '2024-03-27 08:06:50'),
(19, 15, 'College of Computer Studies', 'Sample', '2024-03-27 08:49:34'),
(20, 15, 'College of Teacher Education', 'Sample2', '2024-03-27 08:49:43'),
(22, 15, 'College of Business Administration', 'Sample', '2024-03-27 09:41:41');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `enroll_ID` int(11) NOT NULL,
  `semester_ID` int(11) NOT NULL,
  `stud_ID` int(11) NOT NULL,
  `course_ID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`enroll_ID`, `semester_ID`, `stud_ID`, `course_ID`, `created_at`) VALUES
(5, 11, 16, 9, '2024-04-01 15:57:33'),
(6, 11, 17, 9, '2024-04-01 16:05:04');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `instructor_ID` int(11) NOT NULL,
  `year_ID` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `suffix` varchar(15) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `contact` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `emp_ID` varchar(15) NOT NULL,
  `dept_ID` int(11) NOT NULL,
  `position` varchar(50) NOT NULL,
  `emp_status` varchar(50) NOT NULL,
  `hired_date` date NOT NULL,
  `contract_end` date NOT NULL,
  `degrees_held` text NOT NULL,
  `major_study` varchar(255) NOT NULL,
  `image` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verification_code` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`instructor_ID`, `year_ID`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `birthdate`, `contact`, `email`, `address`, `emp_ID`, `dept_ID`, `position`, `emp_status`, `hired_date`, `contract_end`, `degrees_held`, `major_study`, `image`, `password`, `verification_code`, `created_at`) VALUES
(1, 0, '', '', '', '', '', '0000-00-00', '0', 'instructor@gmail.com', '', '', 0, '', '', '0000-00-00', '0000-00-00', '', '', 'user.jpg', '', 0, '2024-03-26 09:04:13'),
(7, 15, 'Erwins', '', 'Son', '', 'Male', '1981-02-03', '9359428225', 'sonerwin8ss@gmail.com', 'Medellin', '1233121', 16, 'Sample', 'Full-Time', '2024-03-06', '2024-03-07', 'Samples', 'Samples', '1711554481.jpg', '$2y$10$ZwjELQjjrMQ/19ZMoLB49OYL6oVPaTS7OsU3MLOQ16tVItTSa.QNC', 0, '2024-03-27 15:48:01'),
(8, 15, 'dsadsad', 'dad', 'adsad', 'ada', 'Male', '1987-02-10', '9359428962', 'sonerwin8ds@gmail.com', 'Medellindsada', '222333', 16, 'ss', 'Full-Time', '2024-03-06', '2024-03-07', 'dsadsa', 'dadad', 'user.jpg', '$2y$10$1rL.HZ547Xco2D6qqRKYpeph5qDfVwitB859f157th03oXrPgZnZi', 0, '2024-03-27 15:49:52'),
(9, 15, 'dsa', 'dadsad', 'adsad', 'sada', 'Male', '1987-03-04', '9359428923', 'sonerwin8dsa2@gmail.com', 'Medellindsa', '34324242', 19, 'dsadada', 'Full-Time', '2024-03-08', '2024-03-15', 'dsada', 'dsad', 'user.jpg', '$2y$10$oNhEIvqSPHUIO/VgvkPLZ.r.M5d8N8kjgmflknfR9.bpdUKo7y0Za', 0, '2024-03-27 15:54:32'),
(10, 15, 'Erwin', 'Kani', 'Son', 'Kani', 'Female', '1987-02-03', '9359422233', 'sonerwin8@gmail.com', 'Medellin', '11223344', 16, 'Kani', 'Part-Time', '2024-02-28', '2024-02-29', 'Kani', 'Kani', '1711559614.jpg', '$2y$10$5orKDEeqQv9tl10BFAlF5OnCgod4./xkpVCtZjwe0SNUBFZwhNGsG', 0, '2024-03-27 15:55:34'),
(13, 15, 'John', '', 'John', '', 'Male', '1977-03-02', '9359423232', 'students@gmail.com', 'John', '3321324', 16, 'dsadad', 'Full-Time', '2024-03-06', '2024-03-14', 'dsa', 'dsadas', 'user.jpg', '$2y$10$/9xzDqnipYZimGtANmPJoOgSGHzuO2uPp0i2GZMSSSCwpMcRURbdO', 0, '2024-03-27 17:29:05'),
(14, 15, 'as', 'dsad', 'adadas', 'dasdas', 'Male', '1990-01-30', '9912084623', 'studentds@gmail.com', 'Medellin', '0', 16, 'dsada', 'Part-Time', '2024-03-07', '2024-03-08', 'dsadad', 'sada', '1711561150.jpg', '$2y$10$9wiprYWFYLr0RtRYStN.SuUiUa4i5UgOY9uQd2JMHiASz0hc4OUNq', 0, '2024-03-27 17:39:10');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `level_ID` int(11) NOT NULL,
  `level` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`level_ID`, `level`, `created_at`) VALUES
(1, 'First Year', '2024-03-27 13:22:08'),
(5, 'Second Year', '2024-03-27 13:32:07'),
(7, 'Fourth Year', '2024-03-27 13:39:38'),
(8, 'Third Year', '2024-03-27 14:40:46');

-- --------------------------------------------------------

--
-- Table structure for table `log_history`
--

CREATE TABLE `log_history` (
  `log_Id` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `login_datetime` datetime NOT NULL,
  `logout_datetime` datetime NOT NULL,
  `logout_remarks` int(11) NOT NULL DEFAULT 0 COMMENT '0=Logged out successfully, 1=Unable to logout last login'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `log_history`
--

INSERT INTO `log_history` (`log_Id`, `user_Id`, `login_datetime`, `logout_datetime`, `logout_remarks`) VALUES
(81, 66, '2024-01-07 14:22:11', '2024-01-07 14:25:59', 0),
(82, 87, '2024-01-07 14:26:03', '2024-01-07 14:27:24', 0),
(83, 66, '2024-01-07 14:29:23', '2024-01-07 14:30:38', 0),
(84, 66, '2024-01-13 22:23:59', '0000-00-00 00:00:00', 1),
(85, 66, '2024-01-16 04:25:09', '2024-01-16 04:47:29', 0),
(86, 66, '2024-01-21 20:19:30', '2024-01-21 20:30:41', 0),
(87, 66, '2024-01-23 10:09:20', '2024-01-23 10:19:37', 0),
(88, 66, '2024-01-26 00:11:49', '2024-01-26 00:13:53', 0),
(89, 87, '2024-01-26 00:14:00', '2024-01-26 00:24:31', 0),
(90, 66, '2024-01-26 01:27:20', '2024-01-26 01:44:31', 0),
(91, 87, '2024-01-26 02:16:16', '2024-01-26 02:26:16', 0),
(92, 66, '2024-01-26 02:30:25', '2024-01-26 02:40:21', 0),
(93, 66, '2024-01-26 02:41:46', '2024-01-26 02:46:28', 0),
(94, 87, '2024-01-26 02:46:55', '2024-01-26 02:50:37', 0),
(95, 66, '2024-01-26 02:50:44', '2024-01-26 02:54:37', 0),
(96, 66, '2024-01-29 22:01:51', '2024-01-29 22:03:54', 0),
(97, 66, '2024-01-30 22:52:57', '2024-01-30 23:28:58', 0),
(98, 66, '2024-01-31 03:22:04', '2024-01-31 03:51:11', 0),
(99, 87, '2024-01-31 03:51:16', '2024-01-31 03:54:17', 0),
(100, 66, '2024-03-26 14:13:11', '2024-03-26 14:17:29', 0),
(101, 66, '2024-03-26 14:22:37', '2024-03-26 14:39:22', 0),
(102, 66, '2024-03-26 14:48:28', '2024-03-26 15:14:45', 0);

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semester_ID` int(11) NOT NULL,
  `year_ID` int(11) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `sem_status` int(11) NOT NULL DEFAULT 0 COMMENT '0=Inactive, 1=Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semester_ID`, `year_ID`, `semester`, `sem_status`, `created_at`) VALUES
(10, 15, 'Second Semester', 0, '2024-03-27 09:50:42'),
(11, 15, 'First Semester', 1, '2024-03-27 09:50:58'),
(13, 15, 'Summer', 0, '2024-03-27 10:33:14');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `stud_ID` int(11) NOT NULL,
  `stud_type` varchar(30) NOT NULL,
  `student_ID` varchar(20) NOT NULL,
  `year_ID` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `suffix` varchar(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `GWA` varchar(10) NOT NULL,
  `year_level_ID` int(11) NOT NULL,
  `course_ID` int(11) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `school_address` varchar(255) NOT NULL,
  `citizenship` varchar(50) NOT NULL,
  `emergency_contact_name` varchar(100) NOT NULL,
  `relationship_to_student` varchar(50) NOT NULL,
  `emergency_contact` varchar(20) NOT NULL,
  `parent_name` varchar(50) NOT NULL,
  `parent_relationship` varchar(50) NOT NULL,
  `parent_contact` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `documents` varchar(255) NOT NULL,
  `student_status` int(11) NOT NULL DEFAULT 0 COMMENT '0=Pending, 1=Verified',
  `payment` varchar(255) NOT NULL,
  `is_enrolled` int(11) NOT NULL DEFAULT 0 COMMENT '0=No, 1=Yes',
  `verification_code` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`stud_ID`, `stud_type`, `student_ID`, `year_ID`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `birthdate`, `address`, `contact`, `email`, `GWA`, `year_level_ID`, `course_ID`, `school_name`, `school_address`, `citizenship`, `emergency_contact_name`, `relationship_to_student`, `emergency_contact`, `parent_name`, `parent_relationship`, `parent_contact`, `password`, `image`, `documents`, `student_status`, `payment`, `is_enrolled`, `verification_code`, `created_at`) VALUES
(16, 'Old Student', '222333', 15, 'sdsa', 'dasd', 'Dasd', 'DasdDasd', 'Male', '1993-02-02', 'Dasd', '9359343434', 'sonerwi3232n8@gmail.com', '232', 1, 9, '', '', 'Dasd', 'Dasd', 'Dasd', '9509972084', 'Dasd', 'Dasd', '9509972084', '$2y$10$6Hnevk6y20ky7NgIKar41e0Wgu48d4YD/Q0FFtuyhW/NC5buWFXGy', 'user.jpg', 'file_6605c1f6c8d79.jpg,file_6605c1f6c900f.jpg,file_6605c1f6c923d.jpg,file_6605c1f6c9539.jpg', 1, 'file_660ac3154850e.jpg,file_660ac315487ef.jpg,file_660ac31548a2f.jpg', 1, 0, '2024-03-28 19:16:06'),
(17, 'New Student', '333', 15, 'deg', 'Deg', 'Deg', 'Deg', 'Male', '1985-02-27', 'Deg', '9356565656', 'sonerwin8e32432@gmail.com', '454', 1, 9, 'Deg', 'Deg', 'Deg', 'Deg', 'Deg', '9509972084', 'Deg', 'Deg', '9509972084', '$2y$10$FWXjQwpu0aKqLI45yzikf.LQMbh/I84BjVLaTgw0I580PKXr2IG42', 'user.jpg', 'file_6605c26794f3b.jpeg,file_6605c26795226.jpeg,file_6605c26795540.jpeg,file_6605c26795811.jpeg', 0, '', 1, 0, '2024-03-28 19:17:21'),
(18, 'Old Student', '24442', 15, 'Leste', 'Leste', 'Leste', 'Leste', 'Male', '1984-01-09', 'Leste', '9359422289', 'sonerwin8dsds@gmail.com', '23', 1, 9, '', '', 'Leste', 'Leste', 'Leste', '9509972084', 'Leste', 'Leste', '9509972084', '$2y$10$k6xWSEYR9xQ5zwnOdkkBUurXnCZqoAb/yxjxYT/bLYZHyO87EmXMi', 'user.jpg', 'file_660672dec5d11.jpeg,file_660672dec5ff2.jpeg,file_660672dec628a.jpeg,file_660672dec652d.jpeg', 0, '', 0, 0, '2024-03-29 07:50:54'),
(19, 'New Student', '5665', 15, 'Kamot', 'Kamot', 'Kamot', 'Kamot', 'Male', '1994-02-01', 'Kamot', '9359254656', 'sonerwin8434343@gmail.com', '232', 7, 9, 'Kamot', 'Kamot', 'Kamot', 'Kamot', 'Kamot', '9509972084', 'Kamot', 'Kamot', '9509972084', '$2y$10$oGunu9GS1MTmVleScnn2ZOQrygFu6MX97qcBKL2K33j1dE.nU8Ky2', 'user.jpg', 'file_66067359e9fc2.jpeg,file_66067359ea2b4.jpeg,file_66067359ea519.jpeg,file_66067359ea7ee.jpeg', 0, '', 0, 0, '2024-03-29 07:52:58');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sub_ID` int(11) NOT NULL,
  `semester_ID` int(11) NOT NULL,
  `course_ID` int(11) NOT NULL,
  `level_ID` int(11) NOT NULL,
  `sub_no` varchar(15) NOT NULL,
  `descriptive_title` varchar(255) NOT NULL,
  `units` int(11) NOT NULL,
  `offer_code` varchar(50) NOT NULL,
  `days` varchar(10) NOT NULL,
  `time` time NOT NULL,
  `room` varchar(30) NOT NULL,
  `instructor_ID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sub_ID`, `semester_ID`, `course_ID`, `level_ID`, `sub_no`, `descriptive_title`, `units`, `offer_code`, `days`, `time`, `room`, `instructor_ID`, `created_at`) VALUES
(3, 11, 9, 1, 'dsad', 'sadada', 34, 'dsada', '', '00:00:00', '', 8, '2024-03-29 06:10:31'),
(4, 11, 9, 1, '1234', '1234', 1234, '1234', '', '00:00:00', '', 8, '2024-03-29 06:26:56'),
(5, 11, 9, 1, '1234', '1234', 1234, '1234', '', '00:00:00', '', 14, '2024-03-29 06:50:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_Id` int(11) NOT NULL,
  `user_type` int(11) DEFAULT 0 COMMENT '0=Staff, 1=Administrator',
  `firstname` varchar(100) DEFAULT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `suffix` varchar(100) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `birthplace` varchar(100) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `civilstatus` varchar(20) DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `house_no` varchar(50) DEFAULT NULL,
  `street_name` varchar(100) DEFAULT NULL,
  `purok` varchar(50) DEFAULT NULL,
  `zone` varchar(50) DEFAULT NULL,
  `barangay` varchar(50) DEFAULT NULL,
  `municipality` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `verification_code` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_Id`, `user_type`, `firstname`, `middlename`, `lastname`, `suffix`, `birthdate`, `birthplace`, `gender`, `civilstatus`, `occupation`, `religion`, `email`, `contact`, `house_no`, `street_name`, `purok`, `zone`, `barangay`, `municipality`, `province`, `region`, `password`, `image`, `verification_code`, `created_at`) VALUES
(66, 1, 'Admin', '', 'Admin', 'Admin', '1995-03-02', 'Bisan asa', 'Male', 'Single', 'Admin', 'Iglesia Ni Cristo', 'admin@gmail.com', '9359428244', 'Dsas', 'Admin', 'Admin', 'Dsa', 'Admin', 'Admin', 'Sample', 'Admins', '$2y$10$5XGY1T5p8seTQw42A0uHS.ahFXAkz4Y279UGS9rh/Q3.605G6WqDC', '1711563590.jpg', NULL, '2022-11-24 16:00:00'),
(72, 0, 'Userdss', 'User', 'User', 'Jr', '2022-12-21', 'gfdgfdg', 'Male', 'Married', 'gfdgfdgd', 'Buddhist', 'user@gmail.com', '9359428232', 'gfdg', 'fdg', 'gdfgdg', 'gfdg', 'dfgd', 'fdgdg', 'fdg', 'dfgds', '0192023a7bbd73250516f069df18b500', '2.jpg', 295016, '2022-12-26 16:00:00'),
(86, 0, 'SampleSample Sample', 'Sample Sample Sample', 'Sample Sample', 'Sample', '2008-02-27', 'Samplef Fsdfsd', 'Male', 'Single', 'Sampleff Fsdfds', 'Evangelical Christianity', 'adminfdsfsfs@gmail.com', '9123456789', 'Fdfds Fdsf', 'Fsfsdfsdds ', 'Sf Fsdff', 'Fsdfsdfsdfs Fdsf Sfs', 'Fdsfd Fsfs Fs', 'Fdsfds', 'Fsdffdsf', 'Sdfsd', '0192023a7bbd73250516f069df18b500', 'pexels-photo-2379005.jpeg', 0, '2023-12-18 11:19:29'),
(87, 0, 'Lestesd', 'Leste', 'Leste', 'Leste', '1986-02-26', 'Leste', 'Female', 'Widow/ER', 'Leste', 'Iglesia Ni Cristo', 'sonerwin12@gmail.com', '9123456789', 'Leste', 'Leste', 'Leste', 'Leste', 'Leste', 'Leste', '', 'Leste', '0192023a7bbd73250516f069df18b500', 'pexels-photo-1855582.jpeg', 192273, '2023-12-18 11:22:55'),
(88, 0, 'Lestes', 'Leste', 'Leste', 'Leste', '1989-03-02', 'Leste', 'Male', 'Single', 'Leste', 'Jehovah\'s Witnesses', 'sonerLestewin8@gmail.com', '9359428963', 'Leste', 'Leste', 'LesteLeste', 'Leste', 'Leste', 'Leste', 'Medellin', 'Leste', '5bb3fd0bd3e6c36990367456eee83314', '3.jpg', NULL, '2024-01-30 19:21:25'),
(89, 0, 'Staffkoss', 'Staffko', 'Staffko', '', '1985-02-27', 'Staffko', 'Male', 'Single', 'Staffko', 'Iglesia Ni Cristo', 'sonerwin8Staffko@gmail.com', '9359422222', 'Staffko', 'Staffko', 'Staffko', 'Staffko', 'Staffko', 'Staffko', 'Staffkos', 'Staffko', '5bb3fd0bd3e6c36990367456eee83314', '1711610268.jpeg', NULL, '2024-01-30 19:24:41'),
(92, 1, 'dddd', 'Dddd', 'Dddd', 'Dddd', '1992-01-27', 'Dddd', 'Male', 'Single', 'Dddd', 'Roman Catholic', 'sonerwinewqdas8@gmail.com', '9359422323', 'Dddd', 'DdddDdddDddd', 'Dddd', 'Dddd', 'DdddDddd', 'Dddd', 'Dddd', 'Dddd', '$2y$10$z.z19SvAyQ7Ek2ntIerHnOAeLVbb46YSmzzuOANMDFCwPR2IzxRFG', NULL, NULL, '2024-03-28 06:49:04'),
(93, 1, 'dddddddww', 'Dddddddww', 'Dddddddww', 'DddddddwwDddddddww', '1986-02-27', 'cadsad', 'Male', 'Single', 'dsad', 'Iglesia Ni Cristo', 'sonerwin8dsdsadsa@gmail.com', '9359232323', 'sad', 'sadad', 'adsad', 'asd', 'asdas', 'dsadas', 'Mdaedellin', 'dsa', '$2y$10$Mx3LZxfinp9ailwKVTiqBOW7/ehLVcGmvn7cVXQZ7QuOwSFf/UhC.', 'user.jpg', NULL, '2024-03-28 06:51:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_year`
--
ALTER TABLE `academic_year`
  ADD PRIMARY KEY (`year_ID`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_ID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_ID`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`enroll_ID`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`instructor_ID`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`level_ID`);

--
-- Indexes for table `log_history`
--
ALTER TABLE `log_history`
  ADD PRIMARY KEY (`log_Id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semester_ID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`stud_ID`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sub_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_year`
--
ALTER TABLE `academic_year`
  MODIFY `year_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `enroll_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `instructor_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `level_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `log_history`
--
ALTER TABLE `log_history`
  MODIFY `log_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semester_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `stud_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `sub_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
