-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 16, 2023 at 03:00 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobs`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobapplication`
--

CREATE TABLE `jobapplication` (
  `application_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `job_seeker_id` int(11) DEFAULT NULL,
  `resume_id` int(11) NOT NULL,
  `application_status` enum('pending','rejected','accepted') DEFAULT NULL,
  `submission_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobapplication`
--

INSERT INTO `jobapplication` (`application_id`, `job_id`, `job_seeker_id`, `resume_id`, `application_status`, `submission_date`) VALUES
(22, 17, 32, 25, 'pending', '2023-06-16');

-- --------------------------------------------------------

--
-- Table structure for table `jobposting`
--

CREATE TABLE `jobposting` (
  `job_id` int(11) NOT NULL,
  `recruiter_id` int(11) DEFAULT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `job_description` varchar(7000) DEFAULT NULL,
  `qualifications` varchar(255) DEFAULT NULL,
  `job_location` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobposting`
--

INSERT INTO `jobposting` (`job_id`, `recruiter_id`, `job_title`, `job_description`, `qualifications`, `job_location`) VALUES
(13, NULL, NULL, NULL, NULL, NULL),
(16, NULL, NULL, NULL, NULL, NULL),
(17, 31, 'Web Developer', 'we are looking for a passionate web developer', 'BSCS/4 year experience', 'ISLAMABAD');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `reportId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `report_txt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`reportId`, `userId`, `report_txt`) VALUES
(5, NULL, NULL),
(6, NULL, 'i was stuck'),
(10, NULL, NULL),
(13, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `resume`
--

CREATE TABLE `resume` (
  `resume_id` int(11) NOT NULL,
  `job_seeker` int(11) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resume`
--

INSERT INTO `resume` (`resume_id`, `job_seeker`, `file_name`, `file_path`) VALUES
(25, 32, '648c245cdc795_648755f2ea274_64864529c467b_KashanHumayunCV(1).pdf', 'cv_files/648c5bb568f4d_648c245cdc795_648755f2ea274_64864529c467b_KashanHumayunCV(1).pdf');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(1000) NOT NULL,
  `user_email` varchar(1500) NOT NULL,
  `user_ph_no` bigint(20) NOT NULL,
  `user_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_password`, `user_email`, `user_ph_no`, `user_role`) VALUES
(1, 'kashan', '$2y$10$gs0BMyOkUVdp6VLwgVtrDe7AWiduD1sqLoET8UokwcNPNTtDjM/wm', 'kashan@gmail.com', 12345678910, 'admin'),
(7, 'nick123', '$2y$10$te6oMFRvPogZnG6Hyj3gg.OEZFMqIMrP9pyx4dMXDo19fi3FOnDBq', 'nick1@yahoo.com', 9001882991, 'admin'),
(8, 'nick2', '$2y$10$c9E9fTzD3u4SKBuls5U1hul3drdHEeQm5/ssW9TP3Xs1/OadPTa.m', 'nick2@yahoo.com', 90018829912, 'admin'),
(31, 'Ismail Ahmed', '$2y$10$VN2wkQUSWxhNidhFbL6R/OgbGa3ymuw5r3wAmzyfn/RRYqll45G9.', 'ismail@gmail.com', 9354834733432, 'recruiter'),
(32, 'Abdullah Ali Dewan', '$2y$10$wC6irDflDXTLYFaDF3/v6.AHCXvyB1kBaswiUBILHaKnMWMFI2V8a', 'abdullah@gmail.com', 3490531694, 'job_seeker');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobapplication`
--
ALTER TABLE `jobapplication`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `fk_jobapplication_user` (`job_seeker_id`),
  ADD KEY `jobapplication_ibfk_1` (`job_id`),
  ADD KEY `FK_jobapplication_resume` (`resume_id`);

--
-- Indexes for table `jobposting`
--
ALTER TABLE `jobposting`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `fk_recruiter_user` (`recruiter_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`reportId`),
  ADD KEY `report_ibfk_1` (`userId`);

--
-- Indexes for table `resume`
--
ALTER TABLE `resume`
  ADD PRIMARY KEY (`resume_id`),
  ADD KEY `resume_ibfk_1` (`job_seeker`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobapplication`
--
ALTER TABLE `jobapplication`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `jobposting`
--
ALTER TABLE `jobposting`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `reportId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `resume`
--
ALTER TABLE `resume`
  MODIFY `resume_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jobapplication`
--
ALTER TABLE `jobapplication`
  ADD CONSTRAINT `FK_jobapplication_resume` FOREIGN KEY (`resume_id`) REFERENCES `resume` (`resume_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_jobapplication_jobposting` FOREIGN KEY (`job_id`) REFERENCES `jobposting` (`job_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_jobapplication_user` FOREIGN KEY (`job_seeker_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jobapplication_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `jobposting` (`job_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jobapplication_ibfk_2` FOREIGN KEY (`job_seeker_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `jobposting`
--
ALTER TABLE `jobposting`
  ADD CONSTRAINT `fk_recruiter_user` FOREIGN KEY (`recruiter_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jobposting_ibfk_1` FOREIGN KEY (`recruiter_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `resume`
--
ALTER TABLE `resume`
  ADD CONSTRAINT `resume_ibfk_1` FOREIGN KEY (`job_seeker`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
