-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2025 at 08:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pmisgad`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(50) NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `user_id`, `action`, `timestamp`) VALUES
(1, 1, 'Admin Logged in', '2025-02-11 13:16:59'),
(2, 1, 'Admin Logged in', '2025-02-11 14:42:59'),
(3, 1, 'Admin Logged in', '2025-02-11 16:18:44'),
(4, 1, 'Admin Logged in', '2025-02-12 09:16:30'),
(5, 1, 'Admin Logged in', '2025-02-12 14:40:01'),
(6, 1, 'Admin Logged in', '2025-02-12 15:57:53'),
(7, 1, 'Admin Logged in', '2025-02-12 16:14:32'),
(8, 1, 'Admin Logged in', '2025-02-13 07:48:35'),
(9, 1, 'Admin Logged in', '2025-02-13 08:36:18'),
(10, 1, 'Admin Logged in', '2025-02-13 08:41:49'),
(11, 1, 'Admin Logged in', '2025-02-13 08:43:39'),
(12, 1, 'Admin Logged in', '2025-02-13 09:00:39'),
(13, 1, 'Admin Logged in', '2025-02-13 10:35:19'),
(14, 1, 'Admin Logged in', '2025-02-13 11:12:05'),
(15, 1, 'Admin Logged in', '2025-02-13 11:12:57'),
(16, 1, 'Admin Logged in', '2025-02-13 11:41:34'),
(17, 1, 'Admin Logged in', '2025-02-13 12:04:26'),
(18, 1, 'Admin Logged in', '2025-02-13 13:06:38'),
(19, 1, 'Admin Logged in', '2025-02-13 13:08:10'),
(20, 1, 'Admin Logged in', '2025-02-13 13:20:50'),
(21, 1, 'Admin Logged in', '2025-02-13 14:34:01'),
(22, 1, 'Admin Logged in', '2025-02-14 13:07:04'),
(23, 1, 'Admin Logged in', '2025-02-14 13:22:12'),
(24, 1, 'Admin Logged in', '2025-02-14 13:28:02'),
(25, 1, 'Admin Logged in', '2025-02-14 13:43:47'),
(26, 1, 'Admin Logged in', '2025-02-14 13:45:13'),
(27, 1, 'Admin Logged in', '2025-02-14 13:48:06'),
(28, 1, 'Admin Logged in', '2025-02-18 09:01:37'),
(29, 1, 'Admin Logged in', '2025-02-18 10:50:16'),
(30, 1, 'Admin Logged in', '2025-02-18 10:53:10'),
(31, 1, 'Admin Logged in', '2025-02-18 12:28:44'),
(32, 1, 'Admin Logged in', '2025-02-18 12:39:22'),
(33, 1, 'Admin Logged in', '2025-02-18 15:12:16'),
(34, 1, 'Admin Logged in', '2025-02-18 15:24:58'),
(35, 1, 'Admin Logged in', '2025-02-18 15:25:22'),
(36, 1, 'Admin Logged in', '2025-02-19 10:20:16'),
(37, 1, 'Admin Logged in', '2025-02-19 12:22:16');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`, `name`, `username`, `password`, `created_at`) VALUES
(1, 'Mark Lester Raguindin', 'admin', 'admin', '2025-02-03 07:04:51');

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE `awards` (
  `id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `award` varchar(255) DEFAULT NULL,
  `conferred_to` varchar(255) DEFAULT NULL,
  `conferred_by` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `date_ended` date DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `category` enum('International','National','Regional','Local') NOT NULL,
  `year` int(11) GENERATED ALWAYS AS (year(`date`)) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `awards`
--

INSERT INTO `awards` (`id`, `member_id`, `award`, `conferred_to`, `conferred_by`, `date`, `date_ended`, `venue`, `category`) VALUES
(78, 9, 'Test', 'John Doe', 'IICT', '2025-03-03', '2025-03-04', 'Roxas Astrodome', 'International'),
(79, 9, 'dadsa', 'asda', 'asdas', '2025-03-06', '2025-03-07', 'sada', 'International'),
(80, 14, 'Programming Contest', 'Mark Lester', 'IICT', '2025-03-06', '2025-03-07', 'ISUR- Gym', 'International');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `designation_id` int(11) NOT NULL,
  `designation_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`designation_id`, `designation_name`) VALUES
(1, 'Faculty'),
(3, 'Campus Administration');

-- --------------------------------------------------------

--
-- Table structure for table `dynamic_table`
--

CREATE TABLE `dynamic_table` (
  `id` int(11) NOT NULL,
  `col1` varchar(255) NOT NULL,
  `col2` varchar(255) NOT NULL,
  `col3` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sex` enum('Male','Female','Other') NOT NULL,
  `employment_status` varchar(30) NOT NULL,
  `disability_type` varchar(255) DEFAULT NULL,
  `campus` varchar(255) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `member_id` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT year(current_timestamp())
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `name`, `sex`, `employment_status`, `disability_type`, `campus`, `date_created`, `member_id`, `year`) VALUES
(32, 'John Doe', 'Male', 'Testing', 'N/A', 'Roxas', '2025-03-03 05:56:40', 9, 2025);

-- --------------------------------------------------------

--
-- Table structure for table `infrastructure_projects`
--

CREATE TABLE `infrastructure_projects` (
  `project_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `name_of_project` varchar(255) NOT NULL,
  `allocated_budget` decimal(15,2) NOT NULL,
  `project_duration` varchar(100) NOT NULL,
  `date_started` date NOT NULL,
  `expected_completion_date` date NOT NULL,
  `status` enum('Pending','Ongoing','Completed','Cancelled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `innovations`
--

CREATE TABLE `innovations` (
  `innovation_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `name_of_innovation` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `innovations`
--

INSERT INTO `innovations` (`innovation_id`, `member_id`, `name_of_innovation`, `description`) VALUES
(2, 9, 'test', 'test'),
(3, 9, 'test', 'test'),
(4, 9, 'test', 'test'),
(5, 9, 'test', 'teset');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `member_first` varchar(100) DEFAULT NULL,
  `member_last` varchar(100) DEFAULT NULL,
  `member_gender` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `office_id` int(11) DEFAULT NULL,
  `salut_id` int(11) DEFAULT NULL,
  `rank_id` int(11) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `failed_attempts` int(11) DEFAULT 0,
  `last_failed_attempt` timestamp NULL DEFAULT NULL,
  `is_suspended` tinyint(1) DEFAULT 0,
  `role` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `member_first`, `member_last`, `member_gender`, `username`, `password`, `office_id`, `salut_id`, `rank_id`, `designation_id`, `failed_attempts`, `last_failed_attempt`, `is_suspended`, `role`) VALUES
(9, 'Carlito', 'Antolin', 'Male', 'Carlito', '123', 20, 2, 1, 1, 0, NULL, 0, 'user'),
(12, 'Lester', 'Raguindin', 'Male', 'admin', 'admin', 36, 2, 4, 1, 0, NULL, 0, 'admin'),
(14, 'Ryan', 'Suguitan', 'Male', 'ryan', '123', 21, 2, 1, 1, 0, NULL, 0, 'user'),
(15, 'John ', 'Doe', 'Male', 'john', '123', 24, 2, 6, 1, 0, NULL, 0, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `member_activitylog`
--

CREATE TABLE `member_activitylog` (
  `log_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `login_datetime` datetime DEFAULT current_timestamp(),
  `office_id` int(11) NOT NULL,
  `office_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member_activitylog`
--

INSERT INTO `member_activitylog` (`log_id`, `member_id`, `login_datetime`, `office_id`, `office_address`) VALUES
(128, 9, '2025-03-10 10:54:32', 20, 'Oldsite'),
(129, 9, '2025-03-10 10:54:53', 20, 'Oldsite'),
(130, 12, '2025-03-10 10:55:16', 36, 'Newsite'),
(131, 12, '2025-03-10 10:55:29', 36, 'Newsite'),
(132, 12, '2025-03-10 11:01:46', 36, 'Newsite'),
(133, 12, '2025-03-10 11:04:23', 36, 'Newsite'),
(134, 12, '2025-03-10 11:05:06', 36, 'Newsite'),
(135, 9, '2025-03-10 14:49:06', 20, 'Oldsite'),
(136, 12, '2025-03-10 14:54:54', 36, 'Newsite'),
(137, 12, '2025-03-10 14:56:41', 36, 'Newsite'),
(138, 9, '2025-03-10 15:01:24', 20, 'Oldsite');

-- --------------------------------------------------------

--
-- Table structure for table `national_certification_performance`
--

CREATE TABLE `national_certification_performance` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `certification` varchar(255) NOT NULL,
  `date_complete` date NOT NULL,
  `examinees_male` int(11) NOT NULL,
  `examinees_female` int(11) NOT NULL,
  `examinees_total` int(11) GENERATED ALWAYS AS (`examinees_male` + `examinees_female`) STORED,
  `passers_male` int(11) NOT NULL,
  `passers_female` int(11) NOT NULL,
  `passers_total` int(11) GENERATED ALWAYS AS (`passers_male` + `passers_female`) STORED,
  `passing_rate_male` decimal(5,2) NOT NULL,
  `passing_rate_female` decimal(5,2) NOT NULL,
  `passing_rate_total` decimal(5,2) GENERATED ALWAYS AS ((`passers_male` + `passers_female`) / (`examinees_male` + `examinees_female`) * 100) STORED,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `non_academic_staff`
--

CREATE TABLE `non_academic_staff` (
  `staff_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `category` varchar(255) NOT NULL,
  `sub_category` varchar(255) DEFAULT NULL,
  `male_count` int(11) DEFAULT 0,
  `female_count` int(11) DEFAULT 0,
  `total_count` int(11) GENERATED ALWAYS AS (`male_count` + `female_count`) STORED,
  `year` int(11) DEFAULT year(current_timestamp())
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `office_name`
--

CREATE TABLE `office_name` (
  `office_id` int(11) NOT NULL,
  `office_name` varchar(100) NOT NULL,
  `office_address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `office_name`
--

INSERT INTO `office_name` (`office_id`, `office_name`, `office_address`) VALUES
(20, 'College of Criminal Justice Education', 'Oldsite'),
(21, 'Institute of Information and Communication Technology', 'Newsite'),
(22, 'Campus Administration', 'Newsite'),
(23, 'Academic Affairs', 'Newsite'),
(24, 'Research', 'Newsite'),
(25, 'REGISTRAR', 'Newsite'),
(26, 'GUIDANCE', 'Newsite'),
(27, 'Office of Student Affairs and Services', 'Newsite'),
(28, 'RECORDS', 'Newsite'),
(29, 'BUDGET', 'Newsite'),
(30, 'Cashiering', 'Newsite'),
(31, 'Human Resource', 'Newsite'),
(32, 'ACCOUNTING', 'Newsite'),
(33, 'MEDICAL/DENTAL', 'Newsite/Oldsite'),
(34, 'SUPPLY', 'Newsite'),
(35, 'PROCUREMENT', 'Newsite'),
(36, 'Planning, Management of Information and Services', 'Newsite');

-- --------------------------------------------------------

--
-- Table structure for table `officials`
--

CREATE TABLE `officials` (
  `official_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `designation_name` varchar(100) NOT NULL,
  `contact_info` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `officials`
--

INSERT INTO `officials` (`official_id`, `member_id`, `designation`, `designation_name`, `contact_info`) VALUES
(1, 9, 'Faculty', 'John Doe', '09350991034'),
(2, 12, 'Staff', 'Benedict Hernando', '09350991034');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchase_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchase_id`, `member_id`, `item`, `purpose`, `amount`, `purchase_date`) VALUES
(1, 9, 'Laptop', 'For Interns', 25000.00, '2025-03-05 02:40:56');

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE `rank` (
  `rank_id` int(11) NOT NULL,
  `rank` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rank`
--

INSERT INTO `rank` (`rank_id`, `rank`) VALUES
(1, 'Instructor 1'),
(2, 'Instructor 2'),
(3, 'Dean'),
(4, 'Associate Professor V'),
(5, 'Instructor 3'),
(6, 'Assistant Professor 1'),
(7, 'Assistant Professor 3'),
(8, 'Assistant Professor 2');

-- --------------------------------------------------------

--
-- Table structure for table `research_centers`
--

CREATE TABLE `research_centers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nature_of_research` text NOT NULL,
  `collaborating_agencies` text DEFAULT NULL,
  `funding_support` varchar(255) DEFAULT NULL,
  `supported_sdgs` text DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `research_funding`
--

CREATE TABLE `research_funding` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `fund` varchar(255) NOT NULL,
  `no_of_researches_funded` int(11) NOT NULL,
  `no_of_researchers_male` int(11) NOT NULL,
  `no_of_researchers_female` int(11) NOT NULL,
  `no_of_researchers_total` int(11) GENERATED ALWAYS AS (`no_of_researchers_male` + `no_of_researchers_female`) STORED,
  `total_budget` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `research_linkages`
--

CREATE TABLE `research_linkages` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `moa_mou` varchar(255) NOT NULL,
  `linkage` varchar(255) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `linkage_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salut`
--

CREATE TABLE `salut` (
  `salut_id` int(11) NOT NULL,
  `salut` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salut`
--

INSERT INTO `salut` (`salut_id`, `salut`) VALUES
(2, 'Mr'),
(3, 'Ms'),
(4, 'Dean'),
(5, 'Prof'),
(6, 'Doc');

-- --------------------------------------------------------

--
-- Table structure for table `scholarship_grants`
--

CREATE TABLE `scholarship_grants` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `type_of_scholarship` varchar(255) NOT NULL,
  `doctorate_male` int(11) DEFAULT 0,
  `doctorate_female` int(11) DEFAULT 0,
  `doctorate_total` int(11) DEFAULT 0,
  `masters_male` int(11) DEFAULT 0,
  `masters_female` int(11) DEFAULT 0,
  `masters_total` int(11) DEFAULT 0,
  `post_baccalaureate_male` int(11) DEFAULT 0,
  `post_baccalaureate_female` int(11) DEFAULT 0,
  `post_baccalaureate_total` int(11) DEFAULT 0,
  `baccalaureate_male` int(11) DEFAULT 0,
  `baccalaureate_female` int(11) DEFAULT 0,
  `baccalaureate_total` int(11) DEFAULT 0,
  `non_degree_male` int(11) DEFAULT 0,
  `non_degree_female` int(11) DEFAULT 0,
  `non_degree_total` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `category` enum('Faculty','Non-Academic Staff') NOT NULL,
  `year` int(11) DEFAULT year(current_timestamp())
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trainings_conferences`
--

CREATE TABLE `trainings_conferences` (
  `id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `faculty_male` int(11) DEFAULT 0,
  `faculty_female` int(11) DEFAULT 0,
  `faculty_total` int(11) DEFAULT 0,
  `non_academic_male` int(11) DEFAULT 0,
  `non_academic_female` int(11) DEFAULT 0,
  `non_academic_total` int(11) DEFAULT 0,
  `total_male` int(11) DEFAULT 0,
  `total_female` int(11) DEFAULT 0,
  `total` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `member_id`, `file_name`, `file_path`, `upload_date`) VALUES
(1, 12, 'List-of-Completed-Projects-as-of-December-2024.xlsx', '../uploads/List-of-Completed-Projects-as-of-December-2024.xlsx', '2025-03-03 07:28:58'),
(2, 9, 'Administrative_2024.xlsx', '../uploads/Administrative_2024.xlsx', '2025-03-03 08:02:34'),
(3, 9, '(BSAB 1d) NSTP 2 CWTSLTSMS(Second Semester, 2024-2025) _as of Feb172025 (2).xlsx', '../uploads/(BSAB 1d) NSTP 2 CWTSLTSMS(Second Semester, 2024-2025) _as of Feb172025 (2).xlsx', '2025-03-03 08:06:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `dynamic_table`
--
ALTER TABLE `dynamic_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `fk_member` (`member_id`);

--
-- Indexes for table `infrastructure_projects`
--
ALTER TABLE `infrastructure_projects`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `innovations`
--
ALTER TABLE `innovations`
  ADD PRIMARY KEY (`innovation_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`),
  ADD KEY `office_id` (`office_id`),
  ADD KEY `salut_id` (`salut_id`),
  ADD KEY `rank_id` (`rank_id`),
  ADD KEY `designation_id` (`designation_id`);

--
-- Indexes for table `member_activitylog`
--
ALTER TABLE `member_activitylog`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `office_id` (`office_id`);

--
-- Indexes for table `national_certification_performance`
--
ALTER TABLE `national_certification_performance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `non_academic_staff`
--
ALTER TABLE `non_academic_staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `office_name`
--
ALTER TABLE `office_name`
  ADD PRIMARY KEY (`office_id`);

--
-- Indexes for table `officials`
--
ALTER TABLE `officials`
  ADD PRIMARY KEY (`official_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `rank`
--
ALTER TABLE `rank`
  ADD PRIMARY KEY (`rank_id`);

--
-- Indexes for table `research_centers`
--
ALTER TABLE `research_centers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `research_funding`
--
ALTER TABLE `research_funding`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `research_linkages`
--
ALTER TABLE `research_linkages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `salut`
--
ALTER TABLE `salut`
  ADD PRIMARY KEY (`salut_id`);

--
-- Indexes for table `scholarship_grants`
--
ALTER TABLE `scholarship_grants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `trainings_conferences`
--
ALTER TABLE `trainings_conferences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `awards`
--
ALTER TABLE `awards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dynamic_table`
--
ALTER TABLE `dynamic_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `infrastructure_projects`
--
ALTER TABLE `infrastructure_projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `innovations`
--
ALTER TABLE `innovations`
  MODIFY `innovation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `member_activitylog`
--
ALTER TABLE `member_activitylog`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `national_certification_performance`
--
ALTER TABLE `national_certification_performance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `non_academic_staff`
--
ALTER TABLE `non_academic_staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `office_name`
--
ALTER TABLE `office_name`
  MODIFY `office_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `officials`
--
ALTER TABLE `officials`
  MODIFY `official_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rank`
--
ALTER TABLE `rank`
  MODIFY `rank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `research_centers`
--
ALTER TABLE `research_centers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `research_funding`
--
ALTER TABLE `research_funding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `research_linkages`
--
ALTER TABLE `research_linkages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `salut`
--
ALTER TABLE `salut`
  MODIFY `salut_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `scholarship_grants`
--
ALTER TABLE `scholarship_grants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `trainings_conferences`
--
ALTER TABLE `trainings_conferences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD CONSTRAINT `activity_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `admin` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `awards`
--
ALTER TABLE `awards`
  ADD CONSTRAINT `awards_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`) ON DELETE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `fk_member` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`) ON DELETE CASCADE;

--
-- Constraints for table `infrastructure_projects`
--
ALTER TABLE `infrastructure_projects`
  ADD CONSTRAINT `infrastructure_projects_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`) ON DELETE CASCADE;

--
-- Constraints for table `innovations`
--
ALTER TABLE `innovations`
  ADD CONSTRAINT `innovations_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`) ON DELETE CASCADE;

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`office_id`) REFERENCES `office_name` (`office_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `member_ibfk_2` FOREIGN KEY (`salut_id`) REFERENCES `salut` (`salut_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `member_ibfk_3` FOREIGN KEY (`rank_id`) REFERENCES `rank` (`rank_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `member_ibfk_4` FOREIGN KEY (`designation_id`) REFERENCES `designation` (`designation_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `member_activitylog`
--
ALTER TABLE `member_activitylog`
  ADD CONSTRAINT `member_activitylog_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `member_activitylog_ibfk_2` FOREIGN KEY (`office_id`) REFERENCES `office_name` (`office_id`) ON DELETE CASCADE;

--
-- Constraints for table `national_certification_performance`
--
ALTER TABLE `national_certification_performance`
  ADD CONSTRAINT `national_certification_performance_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

--
-- Constraints for table `non_academic_staff`
--
ALTER TABLE `non_academic_staff`
  ADD CONSTRAINT `non_academic_staff_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

--
-- Constraints for table `officials`
--
ALTER TABLE `officials`
  ADD CONSTRAINT `officials_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

--
-- Constraints for table `research_centers`
--
ALTER TABLE `research_centers`
  ADD CONSTRAINT `research_centers_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`) ON DELETE CASCADE;

--
-- Constraints for table `research_funding`
--
ALTER TABLE `research_funding`
  ADD CONSTRAINT `research_funding_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

--
-- Constraints for table `research_linkages`
--
ALTER TABLE `research_linkages`
  ADD CONSTRAINT `research_linkages_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

--
-- Constraints for table `scholarship_grants`
--
ALTER TABLE `scholarship_grants`
  ADD CONSTRAINT `scholarship_grants_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`) ON DELETE CASCADE;

--
-- Constraints for table `trainings_conferences`
--
ALTER TABLE `trainings_conferences`
  ADD CONSTRAINT `trainings_conferences_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

--
-- Constraints for table `uploads`
--
ALTER TABLE `uploads`
  ADD CONSTRAINT `uploads_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
