-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2019 at 11:51 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `egov`
--

-- --------------------------------------------------------

--
-- Table structure for table `agencies`
--

CREATE TABLE `agencies` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `agency` varchar(100) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `ministry_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `ministry_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department`, `ministry_id`) VALUES
(1, 'Debt Management Office', 1),
(2, 'Revenue Mobilization and Generation', 1),
(3, 'Budget and Planning', 1),
(4, 'Human relationship and Administrations', 1),
(5, 'Finance and Account', 1),
(6, 'Monetary Funds', 2),
(7, 'Treasury', 2),
(8, 'Grants & Research', 2),
(9, 'Salary Payments', 2),
(10, 'Commercial Civil Litigations', 3),
(11, 'Public Prosecutions', 3),
(12, 'Judicial and advisory services', 3),
(13, 'Legislative Drafting', 3),
(14, 'Staff Administrations and welfare', 4),
(15, 'Service Validation and Quality Control', 4),
(16, 'Road Construction and Highways', 5),
(17, 'Quality Control & assurance ', 5),
(18, 'Project planning and Designs', 5),
(19, 'Electrical Designs and Installation', 5),
(20, 'Tertiary Education', 6),
(21, 'Basic Education and High school', 6),
(22, 'Technology and Service Education', 6),
(23, 'Education Planning, Research & Development', 6),
(24, 'Funding and scholarship Board', 6),
(25, 'Veterinary Service', 7),
(26, 'Fisheries and Poultry', 7),
(27, 'Diary & livestock', 7),
(28, 'Food and cash Crops', 7),
(29, 'Farm Tools, Equipment and Implements', 7),
(30, 'Planning and Research, data management', 7),
(31, 'Land and related matters', 8),
(32, 'Physical Town Planning', 8),
(33, 'Architectural design', 8),
(34, 'Quantity surveying', 8),
(35, 'Surveying and Geo â€“informatics', 8);

-- --------------------------------------------------------

--
-- Table structure for table `ministries`
--

CREATE TABLE `ministries` (
  `id` int(11) NOT NULL,
  `ministry` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ministries`
--

INSERT INTO `ministries` (`id`, `ministry`) VALUES
(1, 'MINISTRY OF FINANCE'),
(2, 'OFFICE OF THE ACCOUNTANT GENERAL'),
(3, 'MINISTRY OF JUSTICE'),
(4, 'OSUN STATE CIVIL SERVICE COMMISSIONS '),
(5, 'MINISTRY OF WORKS AND TRANSPORTS'),
(6, 'MINITRY OF EDUCATION, SCIENCE AND TECHNOLOGY'),
(7, 'MINITRY OF AGRICUTURE AND RURAL DEVELOPMENT'),
(8, 'MINITRY OF LANDS AND URBAN DEVELOPMENT');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `prj_file` varchar(100) DEFAULT NULL,
  `ministry_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `agency_id` int(11) DEFAULT NULL,
  `reporter` int(11) DEFAULT NULL,
  `resolve` varchar(5) NOT NULL DEFAULT 'NO',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `due_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `prj_file`, `ministry_id`, `department_id`, `agency_id`, `reporter`, `resolve`, `created_at`, `due_at`, `updated_at`) VALUES
(9, 'tekndakj sd', 'kjsf k s df wclkw ', 'upload/Copy of HNG Tech ISA.docx', 3, 11, NULL, 2, 'YES', '2019-11-30 15:42:02', '2019-11-30 17:42:02', '2019-11-30 15:42:02'),
(10, 'test title', 'test description', 'upload/Copy of HNG Tech ISA.docx', 1, 1, NULL, 1, 'NO', '2019-11-30 18:47:08', '2019-11-30 20:47:08', '2019-11-30 18:47:08');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `rep_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `report_id` varchar(11) NOT NULL,
  `report` text,
  `time_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `reporter` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`rep_id`, `project_id`, `report_id`, `report`, `time_created`, `reporter`) VALUES
(4, 9, '847465POP', 'Test Report details123', '2019-12-02 16:02:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'Officer'),
(2, 'Director'),
(3, 'Permanent Secretary'),
(4, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` int(11) NOT NULL,
  `status_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `status_name`) VALUES
(1, 'ACTIVE'),
(2, 'BLOCKED');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `sex` varchar(100) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT 'avatar.png',
  `staff_id` varchar(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `ministry_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `agency_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `full_name`, `username`, `email`, `password`, `phone`, `sex`, `avatar`, `staff_id`, `role_id`, `ministry_id`, `department_id`, `agency_id`, `status_id`, `created_at`, `updated_at`) VALUES
(1, 'Adelugba Emmanuel', 'bringforthjoy', 'adelugba.emma@gmail.com', '$2y$10$2fBc91CFoUmMXRPEsG1ce.m9QHEtUYny.Cch19xPSRpwMWCvE3OLC', '07067969400', 'MALE', 'avatar.png', 'OS0001', 4, 3, 11, NULL, 1, '2019-11-30 12:48:39', '2019-11-30 12:48:39'),
(2, 'Omoloye Saheed', NULL, 'saomoloye@gmail.com', '$2y$10$Mr207BAeI/phPCjkmfO.teiCtefJjX7nHSrLw/iTgBNP3GpEqO1Xa', '08065543563', 'Male', 'avatar.png', 'OS2121', 1, 1, 1, NULL, 1, '2019-12-02 12:07:27', '2019-12-02 12:07:27'),
(3, 'Saheed Omoloye', NULL, 'ps@egov.com', '$2y$10$al/Lx8OlwpvTW2Kaqfm9eONInsl3RcHGHe.YZSrB.5Qy391azVdl.', '09099009090', 'Male', 'avatar.png', 'OS1212', 3, 3, 10, NULL, 1, '2019-12-02 12:43:52', '2019-12-02 12:43:52'),
(4, 'Saheed Omoloye', NULL, 'admin@egov.com', '$2y$10$OjarXv2jjFHkdrhRUV7i3OjjCiOsz0DFt2DD8hrRi3xVm1hn7qwGS', '09099009090', 'Female', 'avatar.png', 'OS3342', 4, 5, 16, NULL, 1, '2019-12-02 12:47:10', '2019-12-02 12:47:10'),
(5, 'Omoloye Saheed', NULL, 'director@egov.com', '$2y$10$iaxbt6XZkZuAsYmX8rUHX.MHBRv1lL456K/WhrRUc5mV9qckZWZVO', '09000889898', 'Male', 'avatar.png', 'OS4342', 2, 6, 20, NULL, 1, '2019-12-02 12:49:12', '2019-12-02 12:49:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agencies`
--
ALTER TABLE `agencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `ministry_id` (`ministry_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ministry_id` (`ministry_id`);

--
-- Indexes for table `ministries`
--
ALTER TABLE `ministries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reporter` (`reporter`),
  ADD KEY `ministry_id` (`ministry_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `agency_id` (`agency_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`rep_id`),
  ADD KEY `reporter` (`reporter`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `ministry_id` (`ministry_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `agency_id` (`agency_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `status_id` (`status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agencies`
--
ALTER TABLE `agencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `ministries`
--
ALTER TABLE `ministries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `rep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agencies`
--
ALTER TABLE `agencies`
  ADD CONSTRAINT `agencies_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `agencies_ibfk_2` FOREIGN KEY (`ministry_id`) REFERENCES `ministries` (`id`);

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`ministry_id`) REFERENCES `ministries` (`id`);

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`reporter`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `projects_ibfk_2` FOREIGN KEY (`ministry_id`) REFERENCES `ministries` (`id`),
  ADD CONSTRAINT `projects_ibfk_3` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `projects_ibfk_4` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`id`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`reporter`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `reports_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`ministry_id`) REFERENCES `ministries` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`id`),
  ADD CONSTRAINT `users_ibfk_4` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `users_ibfk_5` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
