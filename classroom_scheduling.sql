-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2025 at 07:09 AM
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
-- Database: `classroom_scheduling`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', 'admin12345');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `descriptive_title` varchar(255) NOT NULL,
  `units` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_code`, `descriptive_title`, `units`) VALUES
(5, 'CC 201', 'Introduction to Computing', '3'),
(7, 'CIT 201', 'Discrete Structures', '3'),
(8, 'CC 204', 'Data Structures and Algorithms', '3'),
(9, 'CIT 204', 'Quantitative Methods', '3'),
(10, 'CIT 206', 'Platform Technologies', '3'),
(11, 'CIT 207', 'Object-Oriented Programming', '3'),
(12, 'BA 234', 'Technopreneurship', '3'),
(13, 'CC 207', 'Applications Development &amp; Emerging Technologies', '3'),
(14, 'CC 208', 'Methods of Research in Computing', '3'),
(15, 'CIT 211', 'Systems Integration and Architecture 1', '3'),
(16, 'CIT 212', 'Networking 2 (Advanced Networking)', '3'),
(17, 'CIT 213', 'Human Computer Interaction 2', '3'),
(18, 'CIT 236', 'ST Track 1 (Client Server Technologies and Applications/Web Services and Cloud Computing/Enterprise Cloud)', '3'),
(19, 'CC 209', 'Seminars and Field Study', '3'),
(20, 'CIT 219', 'Thesis Writing for IT 2 (Residency)', '3'),
(21, 'CIT 220', 'Information Assurance and Security 2', '3'),
(22, 'CIT 239', 'ST TRACK 4 (Software Project Management)', '3'),
(23, 'CIT 240', 'ST Track 5 (Open Source Programming)', '3'),
(24, 'CIT 244', 'NIS Track 4 (Introduction to Open Source Operating System)', '3'),
(25, 'CIT 245', 'NIS Track 5 (Introduction to Cyber Forensics)', '3');

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `instructor_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`instructor_id`, `first_name`, `middle_name`, `last_name`, `sex`, `email`, `password`) VALUES
(4, 'Joyce', 'Capillo', 'Limua', 'Female', 'limua@gmail.com', '$2y$10$cy4hCrVfwaFh7dN2D03XEu4AgMpF/nQeCpN1zzFpE4eQyQxFAveEe'),
(6, 'Isauro Jr.', 'Sorongon', 'Sindol', 'Male', 'sindol@gmail.com', '$2y$10$9c.BWXFGC9PtkF/PuStWLOFnWui6ZYSg.J1XIlD8lV5phrMnLtLMi'),
(7, 'Kerwin John', 'Gelbolingo', 'Buenaflor', 'Male', 'buenaflor@gmail.com', '$2y$10$MGpDLS06edveQ6/JJNPRH..YVXmXB7mIb5wynFhTT9Mc3UIHdiAbC'),
(8, 'Lovelyn', 'Favorito', 'Castro', 'Female', 'castro@gmail.com', '$2y$10$8eaZJ36r0NAjf6Q56Q/bZOT2FdLYjvSfSwW4YLrJuJ7bAtTQmhabG'),
(9, 'Shiela Marie', 'Magallanes', 'Catoto', 'Female', 'catoto@gmail.com', '$2y$10$7g1x0fHXbpcTReLLvNVfDe2uryGfg5Qh4L81dkMJyFMbCImHySdfC'),
(10, 'Jonathan', 'Provido', 'Licera', 'Male', 'licera@gmail.com', '$2y$10$JQE535PnO.IeeMLf2ZWeT.uOxz.9OazVgtPZdgNECJN/sPpLKfVya'),
(11, 'Joan', 'Senador', 'Salcedo', 'Female', 'salcedo@gmail.com', '$2y$10$Lu9x0rO2yWKyAoRCRIxrUeIk.jJJPubU3ce8F0X186G4uej09RMkq'),
(13, 'Billy Joe', 'Cenita', 'Lupera', 'Female', 'lupera@gmail.com', '$2y$10$/7s5ttXOd1Rh/O01O3rMgep2umPOvT7Cq7zyEM2ZXfTFSwuTfjoCm'),
(14, 'Grace Lhyn', 'Ronco', 'Legaste', 'Female', 'legaste@gmail.com', '$2y$10$q.B0Q8PFma5sJAk.NhrwUu0GVlIQIkXC8fj7PYmv1rVZhMDch0vo6'),
(15, 'Noe Jhon', 'Noble', 'Sionllo', 'Male', 'sionillo@gmail.com', '$2y$10$AePDxBEGkc1pQh/IezNdXep6OKlz2Wc0YYxT4b.CiFR/2IbmpGDZq'),
(16, 'Mabel', 'Macabanti', 'Satonero', 'Female', 'satonero@gmail.com', '$2y$10$2djK9iXhovtF.qCmQ3JM5.xMs80FzmedoHJWS5nFapqVJELJGCX1y'),
(17, 'Jojo', 'Cordada', 'Garanganao', 'Female', 'garanganao@gmail.com', '$2y$10$tFta0/xeFuz7kktYdrhByOIOLuBF4Rca.80PiraXOcI70bn9IkSDW'),
(18, 'Fritz John', 'Bucane', 'Luis', 'Male', 'luis@gmail.com', '$2y$10$rAFklki8WFlgcV24f.r3AeVSDc7CCZkeFLJW37cGnRuzoXSlXF1Fa'),
(19, 'Romer', 'Parcon', 'Pedroso', 'Male', 'pedroso@gmail.com', '$2y$10$0GVcbElfjCSBj3nNk7ybNOf9iPsFouqveQd/GqOhdEOXx/s3M7YhO'),
(20, 'Shervin', 'Gachallan', 'Gamao', 'Male', 'gamao@gmail.com', '$2y$10$IRzkcC40AQdTQVXFKMAJpuS19e3KBqnV0mRQAqjj5SHkJEsJnl8rS');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `room_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_name`, `room_type`) VALUES
(1, 'Room 5', 'Lecture Room'),
(2, 'Room 6', 'Lecture Room'),
(3, 'Room 7', 'Lecture Room'),
(4, 'Room 8', 'Laboratory'),
(5, 'Room 9', 'Laboratory'),
(6, 'Room 10', 'Laboratory'),
(7, 'Room 11', 'Laboratory');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `schedule_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `day` varchar(255) NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`schedule_id`, `room_id`, `assignment_id`, `day`, `time_start`, `time_end`) VALUES
(32, 2, 46, 'Monday', '08:00:00', '09:00:00'),
(33, 2, 42, 'Monday', '09:00:00', '10:30:00'),
(34, 2, 40, 'Monday', '10:30:00', '12:00:00'),
(35, 2, 43, 'Monday', '14:30:00', '16:30:00'),
(36, 2, 42, 'Tuesday', '09:00:00', '10:30:00'),
(37, 7, 41, 'Tuesday', '10:30:00', '13:30:00'),
(39, 1, 40, 'Tuesday', '14:30:00', '16:00:00'),
(40, 4, 44, 'Wednesday', '07:30:00', '10:30:00'),
(41, 5, 45, 'Wednesday', '10:30:00', '12:30:00'),
(42, 2, 46, 'Wednesday', '13:00:00', '14:00:00'),
(43, 6, 45, 'Thursday', '07:30:00', '10:30:00'),
(44, 4, 37, 'Thursday', '10:30:00', '12:30:00'),
(45, 4, 43, 'Thursday', '13:30:00', '16:30:00'),
(46, 3, 41, 'Friday', '07:30:00', '09:30:00'),
(47, 7, 46, 'Friday', '13:30:00', '16:30:00'),
(48, 4, 37, 'Monday', '07:30:00', '10:30:00'),
(49, 5, 38, 'Monday', '10:30:00', '12:00:00'),
(50, 1, 35, 'Monday', '14:30:00', '16:00:00'),
(51, 1, 33, 'Monday', '16:00:00', '17:30:00'),
(52, 4, 36, 'Tuesday', '07:30:00', '10:30:00'),
(53, 4, 34, 'Tuesday', '10:30:00', '12:30:00'),
(54, 4, 53, 'Tuesday', '13:30:00', '16:30:00'),
(55, 6, 38, 'Wednesday', '07:30:00', '10:30:00'),
(56, 1, 35, 'Wednesday', '13:00:00', '14:30:00'),
(57, 3, 53, 'Wednesday', '14:30:00', '16:30:00'),
(58, 7, 34, 'Thursday', '07:30:00', '10:30:00'),
(59, 2, 33, 'Thursday', '13:00:00', '14:30:00'),
(60, 2, 37, 'Friday', '07:30:00', '09:30:00'),
(61, 3, 36, 'Friday', '10:00:00', '12:00:00'),
(62, 5, 54, 'Monday', '07:30:00', '10:30:00'),
(63, 1, 49, 'Monday', '13:00:00', '14:30:00'),
(64, 7, 50, 'Tuesday', '07:30:00', '10:30:00'),
(65, 1, 49, 'Tuesday', '13:00:00', '14:30:00'),
(66, 3, 52, 'Tuesday', '14:30:00', '16:30:00'),
(67, 2, 47, 'Wednesday', '09:00:00', '10:30:00'),
(68, 4, 50, 'Wednesday', '10:30:00', '12:30:00'),
(69, 4, 51, 'Wednesday', '14:00:00', '17:00:00'),
(70, 3, 48, 'Thursday', '07:30:00', '08:30:00'),
(71, 1, 47, 'Thursday', '09:00:00', '10:30:00'),
(72, 2, 54, 'Thursday', '10:30:00', '12:30:00'),
(73, 3, 51, 'Thursday', '13:00:00', '15:00:00'),
(74, 5, 48, 'Thursday', '16:00:00', '17:00:00'),
(75, 5, 52, 'Friday', '07:30:00', '10:30:00'),
(76, 7, 48, 'Friday', '10:30:00', '13:30:00'),
(77, 7, 64, 'Monday', '10:30:00', '13:30:00'),
(78, 7, 63, 'Monday', '14:00:00', '17:00:00'),
(79, 1, 61, 'Tuesday', '09:00:00', '10:30:00'),
(80, 3, 60, 'Tuesday', '13:00:00', '14:30:00'),
(81, 2, 63, 'Tuesday', '15:00:00', '17:00:00'),
(82, 1, 62, 'Wednesday', '10:30:00', '12:30:00'),
(83, 3, 61, 'Wednesday', '13:00:00', '14:30:00'),
(84, 3, 64, 'Thursday', '11:00:00', '13:00:00'),
(85, 4, 60, 'Friday', '11:00:00', '12:30:00'),
(86, 4, 62, 'Friday', '13:00:00', '16:00:00'),
(87, 1, 55, 'Monday', '11:00:00', '12:30:00'),
(88, 4, 57, 'Monday', '14:00:00', '17:00:00'),
(89, 2, 57, 'Tuesday', '10:30:00', '12:30:00'),
(90, 2, 59, 'Tuesday', '13:00:00', '15:00:00'),
(91, 4, 59, 'Thursday', '07:30:00', '07:30:00'),
(92, 1, 56, 'Thursday', '13:00:00', '14:30:00'),
(93, 3, 58, 'Thursday', '15:00:00', '17:00:00'),
(94, 4, 58, 'Friday', '08:00:00', '11:00:00'),
(95, 5, 56, 'Friday', '13:00:00', '14:30:00'),
(97, 2, 55, 'Friday', '14:30:00', '16:30:00'),
(98, 6, 23, 'Monday', '07:30:00', '10:30:00'),
(99, 6, 21, 'Monday', '13:30:00', '16:30:00'),
(100, 6, 21, 'Tuesday', '10:30:00', '12:30:00'),
(101, 5, 24, 'Wednesday', '07:30:00', '10:30:00'),
(102, 7, 23, 'Wednesday', '10:30:00', '12:30:00'),
(103, 1, 22, 'Wednesday', '14:30:00', '16:00:00'),
(104, 1, 24, 'Thursday', '10:30:00', '12:30:00'),
(105, 1, 22, 'Thursday', '14:30:00', '16:00:00'),
(106, 7, 20, 'Monday', '07:30:00', '10:30:00'),
(107, 6, 19, 'Monday', '10:30:00', '12:30:00'),
(108, 3, 18, 'Monday', '16:00:00', '17:30:00'),
(109, 1, 20, 'Tuesday', '10:30:00', '12:30:00'),
(110, 6, 17, 'Tuesday', '13:30:00', '16:30:00'),
(111, 7, 19, 'Wednesday', '07:30:00', '10:30:00'),
(112, 2, 18, 'Thursday', '09:00:00', '10:30:00'),
(113, 6, 17, 'Thursday', '10:30:00', '12:30:00'),
(114, 3, 30, 'Monday', '11:00:00', '12:30:00'),
(115, 2, 31, 'Monday', '13:00:00', '14:30:00'),
(116, 6, 31, 'Tuesday', '07:30:00', '10:30:00'),
(117, 5, 32, 'Tuesday', '10:30:00', '12:30:00'),
(118, 3, 29, 'Wednesday', '09:30:00', '11:30:00'),
(119, 2, 30, 'Wednesday', '14:30:00', '14:00:00'),
(120, 5, 32, 'Thursday', '07:30:00', '10:30:00'),
(121, 6, 29, 'Thursday', '13:30:00', '16:30:00'),
(122, 3, 14, 'Monday', '13:00:00', '15:00:00'),
(123, 7, 14, 'Tuesday', '13:30:00', '16:30:00'),
(124, 2, 16, 'Wednesday', '07:30:00', '09:00:00'),
(125, 2, 16, 'Thursday', '07:30:00', '09:00:00'),
(128, 3, 25, 'Monday', '09:00:00', '11:00:00'),
(129, 6, 25, 'Wednesday', '13:30:00', '16:30:00'),
(130, 2, 26, 'Wednesday', '14:30:00', '16:00:00'),
(131, 6, 8, 'Wednesday', '10:30:00', '12:30:00'),
(132, 1, 10, 'Wednesday', '07:30:00', '09:00:00'),
(133, 1, 10, 'Thursday', '07:30:00', '09:00:00'),
(134, 7, 11, 'Thursday', '13:30:00', '16:30:00'),
(136, 1, 13, 'Monday', '07:30:00', '09:00:00'),
(137, 1, 13, 'Tuesday', '07:30:00', '09:00:00'),
(138, 1, 60, 'Saturday', '07:30:00', '10:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`section_id`, `section_name`) VALUES
(1, '1-A'),
(2, '1-B'),
(3, '1-C'),
(4, '2-A'),
(5, '2-B'),
(6, '2-C'),
(7, '2-D'),
(8, '3-A'),
(9, '3-B'),
(10, '3-C'),
(11, '4-NIS'),
(12, '4-ST');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `session_type` int(11) NOT NULL,
  `day` varchar(255) NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `section_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `first_name`, `middle_name`, `last_name`, `sex`, `email`, `password`, `section_id`) VALUES
(3, 'Kenneth', 'Alfonso', 'Casaquite', 'Male', 'casaquitekenneth@gmail.com', '$2y$10$Oxp/XmvDznSBfZDrLNWGvOgYyGGUanoTJS6CSJSR6XW7NTREM8F5G', 8),
(4, 'Cathlene', 'Lilam', 'Arana', 'Female', 'arana@gmail.com', '$2y$10$rKuoP9iF5KdJ5N3QUh4J2uzulNkZHtKfPx9//0ssGrsOlPR9Xm7jS', 8),
(5, 'Sean Ivan', 'Andales', 'Gimeno', 'Male', 'gimeno@gmail.com', '$2y$10$epm0F.go6n//zCjlIR4rIekpR29SlQB/PXb4teytFO9iee/CgAthO', 9);

-- --------------------------------------------------------

--
-- Table structure for table `teaching_assignments`
--

CREATE TABLE `teaching_assignments` (
  `assignment_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teaching_assignments`
--

INSERT INTO `teaching_assignments` (`assignment_id`, `course_id`, `instructor_id`, `section_id`) VALUES
(8, 5, 6, 1),
(10, 7, 8, 1),
(11, 5, 6, 2),
(13, 7, 8, 2),
(14, 5, 6, 3),
(16, 7, 9, 3),
(17, 8, 10, 4),
(18, 9, 11, 4),
(19, 10, 4, 4),
(20, 11, 13, 4),
(21, 8, 10, 5),
(22, 9, 9, 5),
(23, 10, 14, 5),
(24, 11, 15, 5),
(25, 8, 10, 6),
(26, 9, 11, 6),
(27, 10, 4, 6),
(28, 11, 13, 6),
(29, 8, 10, 7),
(30, 9, 11, 7),
(31, 10, 14, 7),
(32, 11, 15, 7),
(33, 12, 16, 8),
(34, 13, 14, 8),
(35, 14, 8, 8),
(36, 15, 15, 8),
(37, 16, 17, 8),
(38, 17, 13, 8),
(40, 12, 9, 9),
(41, 13, 18, 9),
(42, 14, 8, 9),
(43, 15, 15, 9),
(44, 16, 17, 9),
(45, 17, 13, 9),
(46, 18, 18, 9),
(47, 12, 9, 10),
(48, 13, 18, 10),
(49, 14, 8, 10),
(50, 15, 18, 10),
(51, 16, 19, 10),
(52, 17, 14, 10),
(53, 18, 4, 8),
(54, 18, 4, 10),
(55, 19, 16, 11),
(56, 20, 8, 11),
(57, 21, 19, 11),
(58, 24, 19, 11),
(59, 25, 17, 11),
(60, 19, 16, 12),
(61, 20, 17, 12),
(62, 21, 19, 12),
(63, 22, 18, 12),
(64, 23, 18, 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`instructor_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `assignments` (`assignment_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `teaching_assignments`
--
ALTER TABLE `teaching_assignments`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `instructor_id` (`instructor_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `section_id` (`section_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `instructor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teaching_assignments`
--
ALTER TABLE `teaching_assignments`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`),
  ADD CONSTRAINT `schedules_ibfk_3` FOREIGN KEY (`assignment_id`) REFERENCES `teaching_assignments` (`assignment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `sessions_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`),
  ADD CONSTRAINT `sessions_ibfk_3` FOREIGN KEY (`section_id`) REFERENCES `sections` (`section_id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`section_id`);

--
-- Constraints for table `teaching_assignments`
--
ALTER TABLE `teaching_assignments`
  ADD CONSTRAINT `teaching_assignments_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`instructor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teaching_assignments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teaching_assignments_ibfk_3` FOREIGN KEY (`section_id`) REFERENCES `sections` (`section_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
