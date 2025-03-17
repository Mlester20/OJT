-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2025 at 07:41 AM
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
-- Table structure for table `academic_services_innovation`
--

CREATE TABLE `academic_services_innovation` (
  `innovation_id` int(11) NOT NULL,
  `name_of_innovation` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `member_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_services_innovation`
--

INSERT INTO `academic_services_innovation` (`innovation_id`, `name_of_innovation`, `description`, `member_id`) VALUES
(5, 'ben', 'test', 12),
(6, 'aAa', 'EWEDWEW', 9),
(7, 'ben and ben', 'lol', 9);

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
-- Table structure for table `administrative_linkages`
--

CREATE TABLE `administrative_linkages` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `moa_mou` varchar(255) NOT NULL,
  `linkage` varchar(255) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `linkage_type` varchar(50) NOT NULL,
  `linkage_level` enum('International','National','Regional','Municipal/Local') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrative_linkages`
--

INSERT INTO `administrative_linkages` (`id`, `member_id`, `institution`, `moa_mou`, `linkage`, `date_from`, `date_to`, `created_at`, `linkage_type`, `linkage_level`) VALUES
(14, 9, 'adas', 'asda', 'adas', '2025-03-13', '2027-12-20', '2025-03-13 07:22:43', 'international', 'International'),
(15, 9, '', '', '', '0000-00-00', '0000-00-00', '2025-03-13 07:22:44', 'international', 'International'),
(16, 9, '', '', '', '0000-00-00', '0000-00-00', '2025-03-13 07:22:44', 'international', 'International'),
(17, 9, '', '', '', '0000-00-00', '0000-00-00', '2025-03-13 07:22:44', 'international', 'International'),
(18, 9, '', '', '', '0000-00-00', '0000-00-00', '2025-03-13 07:22:44', 'international', 'International'),
(19, 9, '', '', '', '0000-00-00', '0000-00-00', '2025-03-13 07:22:44', 'regional', 'Regional'),
(20, 9, '', '', '', '0000-00-00', '0000-00-00', '2025-03-13 07:22:44', 'municipal', 'Regional');

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
(80, 14, 'Programming Contest', 'Mark Lester', 'IICT', '2025-03-06', '2025-03-07', 'ISUR- Gym', 'International'),
(81, 9, 'Test', 'teste', 'test', '2025-03-13', '2025-03-14', 'test', 'Local'),
(82, 9, 'test', 'test', 'test', '2025-03-13', '2025-03-13', 'test', 'Local'),
(83, 9, 'teset', 'test', 'test', '2025-03-13', '2025-03-13', 'test', 'Local');

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
(3, 'Campus Administration'),
(4, 'Staff');

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
-- Table structure for table `extension_awards`
--

CREATE TABLE `extension_awards` (
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

-- --------------------------------------------------------

--
-- Table structure for table `extension_innovations`
--

CREATE TABLE `extension_innovations` (
  `innovation_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `name_of_innovation` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `extension_innovations`
--

INSERT INTO `extension_innovations` (`innovation_id`, `member_id`, `name_of_innovation`, `description`) VALUES
(21, 12, 'aAa', 'EWEDWEW'),
(22, 9, 'ben and ben', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `extension_linkages`
--

CREATE TABLE `extension_linkages` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `moa_mou` varchar(255) NOT NULL,
  `linkage` varchar(255) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `linkage_type` varchar(50) NOT NULL,
  `linkage_level` enum('International','National','Regional','Municipal/Local') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(6, 12, 'aAa', 'EWEDWEW');

-- --------------------------------------------------------

--
-- Table structure for table `instruction_student_disability`
--

CREATE TABLE `instruction_student_disability` (
  `student_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `program_enrolled` varchar(100) DEFAULT NULL,
  `year_level` varchar(100) DEFAULT NULL,
  `type_of_disability` varchar(255) DEFAULT NULL,
  `campus` varchar(50) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(138, 9, '2025-03-10 15:01:24', 20, 'Oldsite'),
(139, 14, '2025-03-10 16:07:57', 21, 'Newsite'),
(140, 9, '2025-03-10 16:08:09', 20, 'Oldsite'),
(141, 12, '2025-03-11 09:32:51', 36, 'Newsite'),
(142, 9, '2025-03-11 09:36:05', 20, 'Oldsite'),
(143, 12, '2025-03-11 10:44:36', 36, 'Newsite'),
(144, 12, '2025-03-12 08:55:43', 36, 'Newsite'),
(145, 12, '2025-03-12 09:40:46', 36, 'Newsite'),
(146, 12, '2025-03-12 11:40:34', 36, 'Newsite'),
(147, 9, '2025-03-12 11:40:54', 20, 'Oldsite'),
(148, 12, '2025-03-12 12:27:18', 36, 'Newsite'),
(149, 12, '2025-03-13 10:45:31', 36, 'Newsite'),
(150, 9, '2025-03-13 12:51:25', 20, 'Oldsite'),
(151, 9, '2025-03-13 13:01:37', 20, 'Oldsite'),
(152, 12, '2025-03-13 14:34:04', 36, 'Newsite'),
(153, 9, '2025-03-13 14:39:18', 20, 'Oldsite'),
(154, 12, '2025-03-13 14:44:18', 36, 'Newsite'),
(155, 9, '2025-03-13 14:45:30', 20, 'Oldsite'),
(156, 12, '2025-03-13 14:47:59', 36, 'Newsite'),
(157, 12, '2025-03-13 14:50:15', 36, 'Newsite'),
(158, 9, '2025-03-13 15:07:50', 20, 'Oldsite'),
(159, 9, '2025-03-13 15:22:17', 20, 'Oldsite'),
(160, 9, '2025-03-13 15:25:07', 20, 'Oldsite'),
(161, 12, '2025-03-13 15:26:41', 36, 'Newsite'),
(162, 12, '2025-03-13 15:30:01', 36, 'Newsite'),
(163, 12, '2025-03-13 15:32:53', 36, 'Newsite'),
(164, 12, '2025-03-14 10:11:30', 36, 'Newsite'),
(165, 12, '2025-03-14 11:30:30', 36, 'Newsite'),
(166, 9, '2025-03-14 12:16:57', 20, 'Oldsite'),
(167, 12, '2025-03-14 12:24:23', 36, 'Newsite'),
(168, 12, '2025-03-17 10:36:31', 36, 'Newsite'),
(169, 12, '2025-03-17 11:10:58', 36, 'Newsite'),
(170, 12, '2025-03-17 12:56:18', 36, 'Newsite'),
(171, 9, '2025-03-17 13:41:21', 20, 'Oldsite'),
(172, 12, '2025-03-17 14:19:21', 36, 'Newsite');

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
(26, 'Guidance', 'Newsite'),
(27, 'Office of Student Affairs and Services', 'Newsite'),
(28, 'Records', 'Newsite'),
(29, 'Budget', 'Newsite'),
(30, 'Cashiering', 'Newsite'),
(31, 'Human Resource', 'Newsite'),
(32, 'Accounting', 'Newsite'),
(33, 'Medical/Dental', 'Newsite/Oldsite'),
(34, 'SUPPLY', 'Newsite'),
(35, 'Procurement', 'Newsite'),
(36, 'Planning, Management of Information and Services', 'Newsite'),
(37, 'College of Education', 'Newsite'),
(38, 'Supreme Student Council', 'Newsite'),
(39, 'Publication', 'Newsite'),
(40, 'School of Agriculture and Agribusiness', 'Newsite'),
(41, 'Admin Office', 'Newsite'),
(42, 'Extension', 'Newsite'),
(43, 'General Services', 'Oldsite'),
(44, 'Cgrmo', 'Oldsite'),
(45, 'Pif', 'Oldsite'),
(46, 'Sports', 'Oldsite'),
(47, 'Socio Cultural', 'Oldsite');

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
(1, 9, 'Laptop', 'For Interns', 25000.00, '2025-03-05 02:40:56'),
(2, 12, 'Laptop', 'Interns', 15000.00, '2025-03-14 03:27:19');

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
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_services_innovation`
--
ALTER TABLE `academic_services_innovation`
  ADD PRIMARY KEY (`innovation_id`),
  ADD KEY `fk_member_id` (`member_id`);

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
-- Indexes for table `administrative_linkages`
--
ALTER TABLE `administrative_linkages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

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
-- Indexes for table `extension_awards`
--
ALTER TABLE `extension_awards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `extension_innovations`
--
ALTER TABLE `extension_innovations`
  ADD PRIMARY KEY (`innovation_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `extension_linkages`
--
ALTER TABLE `extension_linkages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

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
-- Indexes for table `instruction_student_disability`
--
ALTER TABLE `instruction_student_disability`
  ADD PRIMARY KEY (`student_id`),
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
-- AUTO_INCREMENT for table `academic_services_innovation`
--
ALTER TABLE `academic_services_innovation`
  MODIFY `innovation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- AUTO_INCREMENT for table `administrative_linkages`
--
ALTER TABLE `administrative_linkages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `awards`
--
ALTER TABLE `awards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT for table `extension_awards`
--
ALTER TABLE `extension_awards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `extension_innovations`
--
ALTER TABLE `extension_innovations`
  MODIFY `innovation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `extension_linkages`
--
ALTER TABLE `extension_linkages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `infrastructure_projects`
--
ALTER TABLE `infrastructure_projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `innovations`
--
ALTER TABLE `innovations`
  MODIFY `innovation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `instruction_student_disability`
--
ALTER TABLE `instruction_student_disability`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `member_activitylog`
--
ALTER TABLE `member_activitylog`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

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
  MODIFY `office_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `officials`
--
ALTER TABLE `officials`
  MODIFY `official_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Constraints for table `academic_services_innovation`
--
ALTER TABLE `academic_services_innovation`
  ADD CONSTRAINT `fk_member_id` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

--
-- Constraints for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD CONSTRAINT `activity_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `admin` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `administrative_linkages`
--
ALTER TABLE `administrative_linkages`
  ADD CONSTRAINT `administrative_linkages_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

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
-- Constraints for table `extension_awards`
--
ALTER TABLE `extension_awards`
  ADD CONSTRAINT `extension_awards_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

--
-- Constraints for table `extension_innovations`
--
ALTER TABLE `extension_innovations`
  ADD CONSTRAINT `extension_innovations_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

--
-- Constraints for table `extension_linkages`
--
ALTER TABLE `extension_linkages`
  ADD CONSTRAINT `extension_linkages_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

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
-- Constraints for table `instruction_student_disability`
--
ALTER TABLE `instruction_student_disability`
  ADD CONSTRAINT `instruction_student_disability_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

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
