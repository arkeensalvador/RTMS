-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2024 at 10:06 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `agency`
--

CREATE TABLE `agency` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agency_name` varchar(255) NOT NULL,
  `abbrev` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agency`
--

INSERT INTO `agency` (`id`, `agency_name`, `abbrev`) VALUES
(4, 'Philippine Council for Agriculture, Aquatic, and natural Resources Research and Development', 'PCAARRD'),
(5, 'Bulacan Agricultural State College', 'BASC'),
(6, 'Central Luzon State University', 'CLSU'),
(7, 'Pampanga State Agricultural University', 'PSAU'),
(8, 'Tarlac Agricultural University', 'TAU'),
(9, 'Aurora State College of Technology', 'ASCOT'),
(10, 'Bataan Peninsula State University', 'BPSU'),
(11, 'Nueva Ecija University of Science and Technology', 'NEUST'),
(12, 'President Ramon Magsaysay State University', 'PRMSU'),
(13, 'Department of Agriculture - Agricultural Training Institute 3', 'DA-ATI - Region 3'),
(14, 'Department of Agrarian Reform 3', 'DAR - Region 3'),
(15, 'Department of Science and Technology - Region 3', 'DOST - Region 3'),
(16, 'Philippine Carabao Center', 'PCC'),
(17, 'National Economic and Development Authority', 'NEDA'),
(18, 'Department of Environment and Natural Resources - Ecosystems Research and Development Bureau and Watershed Water Resources Research Center', 'DENR-ERDB-WWRC'),
(19, 'Philippine Center for Postharvest Research and Mechanization', 'PhilMech'),
(20, 'Philippine Rice Research Institute', 'PhilRice'),
(21, 'Nation Irrigation Administration - Region 3', 'NIA - Region 3'),
(22, 'Provincial Local Government Unit - Bataan', 'PLGU - Bataan'),
(23, 'Provincial Local Government Unit - Nueva Ecija', 'PLGU - Nueva Ecija'),
(24, 'Provincial Local Government Unit - Tarlac', 'PLGU - Tarlac'),
(25, 'Provincial Local Government Unit - Aurora', 'PLGU - Aurora'),
(26, 'Provincial Local Government Unit - Bulacan', 'PLGU - Bulacan'),
(27, 'Provincial Local Government Unit - Pampanga', 'PLGU - Pampanga'),
(28, 'Provincial Local Government Unit - Zambales', 'PLGU - Zambales'),
(29, 'Department of Budget and Management - Region 3', 'DBM - Region 3'),
(30, 'Department of Agriculture – Bureau of Agricultural Research', 'DA-BAR'),
(31, 'Department of Agriculture - Regional Field Office Region 3', 'DA-RFO - Region 3'),
(32, 'Bureau of Fisheries and Aquatic Resources Region 3', 'BFAR - Region 3');

-- --------------------------------------------------------

--
-- Table structure for table `awards_recipients`
--

CREATE TABLE `awards_recipients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `awards_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `best_paper`
--

CREATE TABLE `best_paper` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `best_paper` varchar(255) NOT NULL,
  `best_paper_year` varchar(255) NOT NULL,
  `best_paper_fa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `best_paper_evaluators`
--

CREATE TABLE `best_paper_evaluators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `best_paper_id` varchar(255) NOT NULL,
  `evaluator_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `best_poster`
--

CREATE TABLE `best_poster` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `agency` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `best_poster_evaluators`
--

CREATE TABLE `best_poster_evaluators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `best_poster_id` varchar(255) NOT NULL,
  `evaluator_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `budgets`
--

CREATE TABLE `budgets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `programID` varchar(255) DEFAULT NULL,
  `projectID` varchar(255) DEFAULT NULL,
  `sub_projectID` varchar(255) DEFAULT NULL,
  `approved_budget` varchar(255) NOT NULL,
  `budget_year` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `budgets`
--

INSERT INTO `budgets` (`id`, `programID`, `projectID`, `sub_projectID`, `approved_budget`, `budget_year`, `created_at`, `updated_at`) VALUES
(1, 'ea539bafc6', NULL, NULL, '23123121', '1', '2024-01-18 06:25:06', NULL),
(2, 'ea539bafc6', NULL, NULL, '12323223', '2', '2024-01-18 06:25:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cbg_awards`
--

CREATE TABLE `cbg_awards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `awards_type` varchar(255) NOT NULL,
  `awards_agency` varchar(255) NOT NULL,
  `awards_date` varchar(255) NOT NULL,
  `awards_title` varchar(255) NOT NULL,
  `awards_recipients` varchar(255) NOT NULL,
  `awards_sponsor` varchar(255) NOT NULL,
  `awards_event` varchar(255) NOT NULL,
  `awards_place` varchar(255) NOT NULL,
  `awards_ceremony` varchar(255) NOT NULL,
  `certificate` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cbg_contributions`
--

CREATE TABLE `cbg_contributions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `con_name` varchar(255) NOT NULL,
  `con_amount` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cbg_equipments`
--

CREATE TABLE `cbg_equipments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `equipments_type` varchar(255) NOT NULL,
  `equipments_name` varchar(255) NOT NULL,
  `equipments_total` varchar(255) NOT NULL,
  `equipments_sof` varchar(255) NOT NULL,
  `equipments_agency` varchar(255) NOT NULL,
  `equipments_details` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cbg_initiatives`
--

CREATE TABLE `cbg_initiatives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ini_initiates` varchar(255) NOT NULL,
  `ini_agency` varchar(255) DEFAULT NULL,
  `ini_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cbg_meetings`
--

CREATE TABLE `cbg_meetings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meeting_type` varchar(255) NOT NULL,
  `meeting_venue` varchar(255) NOT NULL,
  `meeting_date` varchar(255) NOT NULL,
  `meeting_host` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cbg_trainings`
--

CREATE TABLE `cbg_trainings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trainings_type` varchar(255) NOT NULL,
  `trainings_sof` varchar(255) NOT NULL,
  `trainings_agency` varchar(255) NOT NULL,
  `trainings_title` varchar(255) NOT NULL,
  `trainings_expenditures` varchar(255) NOT NULL,
  `trainings_start` varchar(255) NOT NULL,
  `trainings_research_center` varchar(255) NOT NULL,
  `trainings_no_participants` varchar(255) NOT NULL,
  `trainings_venue` varchar(255) NOT NULL,
  `trainings_remarks` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_imgs`
--

CREATE TABLE `equipment_imgs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `equipment_id` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `uploader_agency` varchar(255) NOT NULL,
  `programID` varchar(255) DEFAULT NULL,
  `projectID` varchar(255) DEFAULT NULL,
  `subprojectID` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_01_07_073615_create_tagged_table', 1),
(2, '2014_01_07_073615_create_tags_table', 1),
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 1),
(6, '2016_06_29_073615_create_tag_groups_table', 1),
(7, '2016_06_29_073615_update_tags_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2020_03_13_083515_add_description_to_tags_table', 1),
(11, '2023_04_03_030014_create_programs_table', 1),
(12, '2023_04_03_033130_agency', 1),
(13, '2023_04_04_074632_create_personnels_table', 1),
(14, '2023_06_19_024440_projects', 1),
(15, '2023_06_26_035132_researchers', 1),
(16, '2023_07_06_030954_create_files_table', 1),
(17, '2023_07_10_023245_rdmc_activities', 1),
(18, '2023_07_11_062408_rdmc_linkages', 1),
(19, '2023_07_11_073657_rdmc_dbinfosys', 1),
(20, '2023_07_13_031501_strategic_activities', 1),
(22, '2023_07_18_062251_results_ttm', 1),
(23, '2023_07_18_074650_results_tpa', 1),
(24, '2023_07_24_014647_cbg_trainings', 1),
(25, '2023_07_24_035559_cbg_awards', 1),
(26, '2023_07_25_064029_cbg_equipments', 1),
(27, '2023_09_05_061406_subprojects', 1),
(28, '2023_10_28_040703_cbg_meetings', 1),
(29, '2023_10_31_050347_cbg_contributions', 1),
(30, '2023_10_31_071732_cbg_initiatives', 1),
(31, '2023_10_31_082639_policy_prc', 1),
(32, '2023_10_31_082701_policy_formulated', 1),
(33, '2023_11_01_083203_best_paper', 1),
(34, '2023_11_01_095307_rdmc_regional', 1),
(35, '2023_11_02_065554_rdmc_regional_participants', 1),
(37, '2023_11_13_061940_rdru_tech_deployed', 1),
(38, '2023_11_13_072510_rdru_tech_initiatives', 1),
(39, '2023_11_14_014820_strategic_programs', 1),
(41, '2023_11_20_081524_templates', 1),
(42, '2023_11_24_005918_create_notifications_table', 1),
(43, '2023_12_04_064123_budget', 1),
(44, '2023_12_05_060345_best_poster', 1),
(45, '2023_12_14_021004_best_paper_evaluators', 1),
(46, '2023_12_14_072311_best_poster_evaluators', 1),
(47, '2023_12_15_080348_create_strat_program_list_imgs_table', 1),
(48, '2023_12_18_015956_create_strat_collab_imgs_table', 1),
(49, '2023_12_18_032608_create_strat_tech_list_imgs_table', 1),
(50, '2023_12_20_022048_create_awards_recipients_table', 1),
(51, '2023_12_20_073255_create_trainings_imgs_table', 1),
(52, '2023_12_21_063948_create_equipment_imgs_table', 1),
(53, '2024_01_08_064435_project_budget', 1),
(54, '2024_01_10_022000_sub_project_budget', 1),
(55, '2023_11_14_070101_strategic_collaborative_list', 2),
(56, '2023_11_13_011509_strategic_tech_list', 3),
(57, '2023_07_18_023336_results_ttp', 4);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personnels`
--

CREATE TABLE `personnels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `staff_name` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'staff',
  `programID` varchar(255) DEFAULT NULL,
  `projectID` varchar(255) DEFAULT NULL,
  `subprojectID` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policy_formulated`
--

CREATE TABLE `policy_formulated` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `policy_type` varchar(255) NOT NULL,
  `policy_agency` varchar(255) NOT NULL,
  `policy_date` varchar(255) NOT NULL,
  `policy_author` varchar(255) NOT NULL,
  `policy_co_author` varchar(255) NOT NULL,
  `policy_beneficiary` varchar(255) NOT NULL,
  `policy_implementer` varchar(255) NOT NULL,
  `policy_proponent` varchar(255) NOT NULL,
  `policy_issues` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policy_prc`
--

CREATE TABLE `policy_prc` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prc_title` varchar(255) NOT NULL,
  `prc_agency` varchar(255) NOT NULL,
  `prc_author` varchar(255) NOT NULL,
  `prc_issues` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `programID` varchar(255) NOT NULL,
  `fund_code` varchar(255) DEFAULT NULL,
  `program_title` text NOT NULL,
  `program_status` varchar(255) NOT NULL,
  `program_category` varchar(255) NOT NULL,
  `funding_agency` varchar(255) NOT NULL,
  `collaborating_agency` varchar(255) NOT NULL,
  `implementing_agency` varchar(255) NOT NULL,
  `research_center` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `program_leader` varchar(255) NOT NULL,
  `program_description` text NOT NULL,
  `amount_released` varchar(255) NOT NULL,
  `form_of_development` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `programID`, `fund_code`, `program_title`, `program_status`, `program_category`, `funding_agency`, `collaborating_agency`, `implementing_agency`, `research_center`, `duration`, `program_leader`, `program_description`, `amount_released`, `form_of_development`, `keywords`, `created_at`, `updated_at`) VALUES
(1, 'ea539bafc6', '12321231', 'test', 'Completed', 'Development', '[\"PCAARRD\"]', '[\"PCAARRD\"]', '[\"CLSU\"]', '[\"test\"]', '01/18/2024 to 01/31/2024', '1', 'test', '35446344', 'Local', '[\"test\"]', '2024-01-18 06:25:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `programID` varchar(255) DEFAULT NULL,
  `project_fund_code` varchar(255) DEFAULT NULL,
  `project_category` varchar(255) NOT NULL,
  `project_status` varchar(255) NOT NULL,
  `project_agency` varchar(255) NOT NULL,
  `project_collaborating_agency` varchar(255) NOT NULL,
  `project_implementing_agency` varchar(255) NOT NULL,
  `project_research_center` varchar(255) NOT NULL,
  `project_funding_grant` varchar(255) NOT NULL,
  `project_title` text NOT NULL,
  `project_leader` varchar(255) NOT NULL,
  `project_duration` varchar(255) NOT NULL,
  `project_description` text NOT NULL,
  `project_amount_released` varchar(255) NOT NULL,
  `project_form_of_development` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `programID`, `project_fund_code`, `project_category`, `project_status`, `project_agency`, `project_collaborating_agency`, `project_implementing_agency`, `project_research_center`, `project_funding_grant`, `project_title`, `project_leader`, `project_duration`, `project_description`, `project_amount_released`, `project_form_of_development`, `keywords`, `created_at`, `updated_at`) VALUES
(1, 'ea539bafc6', '12321321', 'Research', 'Ongoing', '[\"PCAARRD\",\"DENR-ERDB-WWRC\"]', '[\"DA-ATI - Region 3\"]', '[\"CLSU\",\"NEUST\"]', '[\"test\"]', 'Multi-year', 'test1', '1', '01/18/2024 to 01/31/2024', 'test1', '155446', 'Local', '[\"test\"]', '2024-01-18 06:25:44', '2024-01-18 06:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `project_budget`
--

CREATE TABLE `project_budget` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `projectID` varchar(255) NOT NULL,
  `approved_budget` varchar(255) NOT NULL,
  `grant_type` varchar(255) NOT NULL,
  `budget_year` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_budget`
--

INSERT INTO `project_budget` (`id`, `projectID`, `approved_budget`, `grant_type`, `budget_year`, `created_at`, `updated_at`) VALUES
(1, '1', '123123', 'Multi-year', '1', '2024-01-18 06:25:44', '2024-01-18 06:33:00'),
(2, '1', '32323', 'Multi-year', '2', '2024-01-18 06:25:44', '2024-01-18 06:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `rdmc_activities`
--

CREATE TABLE `rdmc_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `donor` varchar(255) NOT NULL,
  `activity_type` varchar(255) NOT NULL,
  `activity_title` longtext NOT NULL,
  `shared_amount` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rdmc_dbinfosys`
--

CREATE TABLE `rdmc_dbinfosys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dbinfosys_category` varchar(255) NOT NULL,
  `dbinfosys_type` varchar(255) NOT NULL,
  `dbinfosys_title` varchar(255) NOT NULL,
  `dbinfosys_date_created` varchar(255) NOT NULL,
  `dbinfosys_purpose` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rdmc_dbinfosys`
--

INSERT INTO `rdmc_dbinfosys` (`id`, `dbinfosys_category`, `dbinfosys_type`, `dbinfosys_title`, `dbinfosys_date_created`, `dbinfosys_purpose`, `created_at`, `updated_at`) VALUES
(1, 'Database', 'Developed', 'rtms', '2024-01-18', 'hold the records', '2024-01-18 06:55:45', NULL),
(2, 'Information System', 'Developed', 'rtms', '2024-01-18', 'to have a monitoring system', '2024-01-18 06:56:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rdmc_linkages`
--

CREATE TABLE `rdmc_linkages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `form_of_development` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `nature_of_assistance` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rdmc_linkages`
--

INSERT INTO `rdmc_linkages` (`id`, `type`, `year`, `form_of_development`, `address`, `nature_of_assistance`, `created_at`, `updated_at`) VALUES
(1, 'Developed', '2014', 'Local', 'test', 'test', '2024-01-18 06:53:48', '2024-01-18 06:54:02'),
(2, 'Maintained', '2021', 'Local', 'test', 'test', '2024-01-18 06:53:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rdmc_regional`
--

CREATE TABLE `rdmc_regional` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `regional_category` varchar(255) NOT NULL,
  `regional_title` varchar(255) NOT NULL,
  `regional_implementing_agency` varchar(255) NOT NULL,
  `regional_researchers` varchar(255) NOT NULL,
  `regional_recommendations` longtext NOT NULL,
  `regional_winners` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rdmc_regional`
--

INSERT INTO `rdmc_regional` (`id`, `regional_category`, `regional_title`, `regional_implementing_agency`, `regional_researchers`, `regional_recommendations`, `regional_winners`, `created_at`, `updated_at`) VALUES
(1, 'Research', 'test', '[\"CLSU\"]', '[\"2\",\"3\"]', 'test', '213123', '2024-01-18 19:40:04', '2024-01-18 21:56:29');

-- --------------------------------------------------------

--
-- Table structure for table `rdmc_regional_participants`
--

CREATE TABLE `rdmc_regional_participants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rp_type` varchar(255) NOT NULL,
  `rp_agency` varchar(255) NOT NULL,
  `rp_no` varchar(255) NOT NULL,
  `rp_remarks` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rdru_tech_deployed`
--

CREATE TABLE `rdru_tech_deployed` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rdru_tech_title` varchar(255) NOT NULL,
  `rdru_tech_type` varchar(255) NOT NULL,
  `rdru_tech_sof` varchar(255) NOT NULL,
  `rdru_tech_agency` varchar(255) NOT NULL,
  `rdru_tech_status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rdru_tech_initiatives`
--

CREATE TABLE `rdru_tech_initiatives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rdru_tech_ini_title` varchar(255) NOT NULL,
  `rdru_tech_ini_type` varchar(255) NOT NULL,
  `rdru_tech_ini_status` varchar(255) NOT NULL,
  `rdru_tech_ini_agency` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `researchers`
--

CREATE TABLE `researchers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL DEFAULT 'profile_pictures/default-profile-picture.png',
  `emp_status` varchar(255) NOT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `agency` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `researchers`
--

INSERT INTO `researchers` (`id`, `first_name`, `middle_name`, `last_name`, `sex`, `profile_picture`, `emp_status`, `contact`, `email`, `agency`, `created_at`, `updated_at`) VALUES
(1, 'Marlon', 'A', 'Naagas', 'Male', 'profile_pictures/default-profile-picture.png', 'Regular', '12312312332', 'naagas.marlon@clsu.edu.ph', 'CLSU', NULL, NULL),
(2, 'Mary Camille', 'Dela Cruz', 'Rabang', 'Female', 'profile_pictures/default-profile-picture.png', 'Project', '12312312354', 'marycamillerabang@gmail.com', 'CLSU', '2024-01-18 19:41:26', '2024-01-18 19:41:26'),
(3, 'Joel', 'S', 'Manaloto', 'Male', 'profile_pictures/default-profile-picture.png', 'Project', '12312312332', 'manaloto.joel@clsu2.edu.ph', 'CLSU', '2024-01-18 19:41:26', '2024-01-18 19:41:26');

-- --------------------------------------------------------

--
-- Table structure for table `results_tpa`
--

CREATE TABLE `results_tpa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tpa_title` varchar(255) NOT NULL,
  `tpa_date` varchar(255) NOT NULL,
  `tpa_details` longtext NOT NULL,
  `tpa_remarks` longtext NOT NULL,
  `tpa_approaches` varchar(255) NOT NULL,
  `tpa_researchers` varchar(255) NOT NULL,
  `tpa_agency` varchar(255) NOT NULL,
  `is_others` varchar(255) DEFAULT NULL,
  `tpa_activity` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `results_ttm`
--

CREATE TABLE `results_ttm` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ttm_title` varchar(255) NOT NULL,
  `ttm_type` varchar(255) NOT NULL,
  `ttm_status` varchar(255) NOT NULL,
  `ttm_agency` varchar(255) NOT NULL,
  `ttm_sof` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `results_ttp`
--

CREATE TABLE `results_ttp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ttp_type` varchar(255) NOT NULL,
  `ttp_title` varchar(255) NOT NULL,
  `ttp_budget` varchar(255) NOT NULL,
  `ttp_sof` varchar(255) NOT NULL,
  `ttp_proponent` varchar(255) DEFAULT NULL,
  `ttp_researchers` varchar(255) DEFAULT NULL,
  `ttp_implementing_agency` varchar(255) NOT NULL,
  `ttp_date` varchar(255) NOT NULL,
  `ttp_priorities` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `results_ttp`
--

INSERT INTO `results_ttp` (`id`, `ttp_type`, `ttp_title`, `ttp_budget`, `ttp_sof`, `ttp_proponent`, `ttp_researchers`, `ttp_implementing_agency`, `ttp_date`, `ttp_priorities`, `created_at`, `updated_at`) VALUES
(1, 'Packaged', 'test packaged', '4690222', '[\"PCAARRD\"]', 'PCAARRD', 'null', '[\"CLSU\",\"TAU\",\"PRMSU\"]', '01/02/2020 to 09/20/2023', 'Livestock - Itik Pinas', '2024-01-19 08:31:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `strategic_activities`
--

CREATE TABLE `strategic_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `strategic_program` varchar(255) NOT NULL,
  `strategic_title` varchar(255) NOT NULL,
  `strategic_start` varchar(255) NOT NULL,
  `strategic_end` varchar(255) NOT NULL,
  `strategic_researcher` varchar(255) NOT NULL,
  `strategic_implementing_agency` varchar(255) NOT NULL,
  `strategic_funding_agency` varchar(255) NOT NULL,
  `strategic_budget` varchar(255) NOT NULL,
  `strategic_commodities` varchar(255) NOT NULL,
  `strategic_consortium_role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `strategic_collaborative_list`
--

CREATE TABLE `strategic_collaborative_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `str_collab_type` varchar(255) NOT NULL,
  `str_collab_program` varchar(255) DEFAULT NULL,
  `str_collab_project` varchar(255) NOT NULL,
  `str_collab_imp_agency` varchar(255) NOT NULL,
  `str_collab_agency` varchar(255) NOT NULL,
  `str_collab_date` varchar(255) NOT NULL,
  `str_collab_budget` varchar(255) NOT NULL,
  `str_collab_sof` varchar(255) NOT NULL,
  `str_collab_roc` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `strategic_collaborative_list`
--

INSERT INTO `strategic_collaborative_list` (`id`, `str_collab_type`, `str_collab_program`, `str_collab_project`, `str_collab_imp_agency`, `str_collab_agency`, `str_collab_date`, `str_collab_budget`, `str_collab_sof`, `str_collab_roc`, `created_at`, `updated_at`) VALUES
(1, 'Agency-led', 'Accelerated R&D Program for Capacity Building of Research and Development Institutions and Industrial Competitiveness: Niche Centers in the Regions for R&D (Nicer) Program: Sweet Potato R&D Center', 'Optimization of Sweet potato Clean Planting Materials (SP-CPM) Production in Central Luzon', '[\"CLSU\",\"TAU\",\"PRMSU\"]', '[\"PSAU\",\"ASCOT\"]', '10/01/2019 to 03/01/2022', '25000000', '[\"PCAARRD\"]', 'Lead Program Implementor', '2024-01-19 06:30:49', '2024-01-19 06:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `strategic_program_list`
--

CREATE TABLE `strategic_program_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `str_p_type` varchar(255) NOT NULL,
  `str_p_title` varchar(255) NOT NULL,
  `str_p_researchers` varchar(255) NOT NULL,
  `str_p_imp_agency` varchar(255) NOT NULL,
  `str_p_collab_agency` varchar(255) NOT NULL,
  `str_p_date` varchar(255) NOT NULL,
  `str_p_budget` varchar(255) NOT NULL,
  `str_p_sof` varchar(255) NOT NULL,
  `str_p_regional` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `strategic_program_list`
--

INSERT INTO `strategic_program_list` (`id`, `str_p_type`, `str_p_title`, `str_p_researchers`, `str_p_imp_agency`, `str_p_collab_agency`, `str_p_date`, `str_p_budget`, `str_p_sof`, `str_p_regional`, `created_at`, `updated_at`) VALUES
(1, 'Proposals', 'test', 'test', '[\"CLSU\"]', '[\"PCAARRD\"]', '01/18/2024 to 01/31/2024', '12312321312', '[\"PRMSU\"]', 'test', '2024-01-18 07:00:32', NULL),
(2, 'Approved', 'test2', 'test2', '[\"BASC\"]', '[\"NEUST\"]', '01/18/2024 to 01/31/2024', '211232123', '[\"DENR-ERDB-WWRC\"]', 'tesdt', '2024-01-18 07:03:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `strategic_tech_list`
--

CREATE TABLE `strategic_tech_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tech_type` varchar(255) NOT NULL,
  `tech_title` varchar(255) NOT NULL,
  `tech_agency` varchar(255) NOT NULL,
  `tech_researchers` varchar(255) NOT NULL,
  `tech_impact` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `strategic_tech_list`
--

INSERT INTO `strategic_tech_list` (`id`, `tech_type`, `tech_title`, `tech_agency`, `tech_researchers`, `tech_impact`, `created_at`, `updated_at`) VALUES
(1, 'Research', 'test research', 'CLSU', '[\"Mary Camille Dela Cruz Rabang\",\"Joel S Manaloto\"]', 'test description', '2024-01-19 00:07:19', '2024-01-19 08:09:02'),
(2, 'Development', 'test development', 'CLSU', '[\"Marlon A Naagas\",\"Joel S Manaloto\"]', 'tsst', '2024-01-19 00:09:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `strat_collab_imgs`
--

CREATE TABLE `strat_collab_imgs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `strategic_collab_id` varchar(255) NOT NULL,
  `filename` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `strat_program_list_imgs`
--

CREATE TABLE `strat_program_list_imgs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `strategic_programs_list_id` varchar(255) NOT NULL,
  `filename` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `strat_tech_list_imgs`
--

CREATE TABLE `strat_tech_list_imgs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `strategic_tech_id` varchar(255) NOT NULL,
  `filename` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `strat_tech_list_imgs`
--

INSERT INTO `strat_tech_list_imgs` (`id`, `strategic_tech_id`, `filename`, `created_at`, `updated_at`) VALUES
(1, '1', 'strategic_tech_imgs/1705651698502356188027_949087426362141_7009893764745344667_n.jpg', '2024-01-19 00:08:18', '2024-01-19 00:08:18');

-- --------------------------------------------------------

--
-- Table structure for table `sub_projects`
--

CREATE TABLE `sub_projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `programID` varchar(255) DEFAULT NULL,
  `projectID` varchar(255) NOT NULL,
  `sub_project_fund_code` varchar(255) DEFAULT NULL,
  `sub_project_category` varchar(255) NOT NULL,
  `sub_project_status` varchar(255) NOT NULL,
  `sub_project_agency` varchar(255) NOT NULL,
  `sub_project_collaborating_agency` varchar(255) NOT NULL,
  `sub_project_implementing_agency` varchar(255) NOT NULL,
  `sub_project_research_center` varchar(255) NOT NULL,
  `sub_project_funding_grant` varchar(255) NOT NULL,
  `sub_project_title` text NOT NULL,
  `sub_project_leader` varchar(255) NOT NULL,
  `sub_project_duration` varchar(255) NOT NULL,
  `sub_project_description` text NOT NULL,
  `sub_project_amount_released` varchar(255) NOT NULL,
  `sub_project_form_of_development` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_projects`
--

INSERT INTO `sub_projects` (`id`, `programID`, `projectID`, `sub_project_fund_code`, `sub_project_category`, `sub_project_status`, `sub_project_agency`, `sub_project_collaborating_agency`, `sub_project_implementing_agency`, `sub_project_research_center`, `sub_project_funding_grant`, `sub_project_title`, `sub_project_leader`, `sub_project_duration`, `sub_project_description`, `sub_project_amount_released`, `sub_project_form_of_development`, `keywords`, `created_at`, `updated_at`) VALUES
(1, 'ea539bafc6', '1', NULL, 'Research', 'Terminated', '[\"PLGU - Aurora\"]', '[\"CLSU\"]', '[\"PhilMech\"]', '[\"test\"]', 'Multi-year', 'test2131', '2', '01/19/2024 to 01/31/2024', 'tesdt123123', '234658', 'Local', '[\"21312\"]', '2024-01-19 06:12:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_project_budget`
--

CREATE TABLE `sub_project_budget` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `projectID` varchar(255) NOT NULL,
  `sub_projectID` varchar(255) NOT NULL,
  `approved_budget` varchar(255) NOT NULL,
  `grant_type` varchar(255) NOT NULL,
  `budget_year` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_project_budget`
--

INSERT INTO `sub_project_budget` (`id`, `projectID`, `sub_projectID`, `approved_budget`, `grant_type`, `budget_year`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '1234', 'Multi-year', '1', '2024-01-19 06:12:06', NULL),
(2, '1', '1', '233424', 'Multi-year', '2', '2024-01-19 06:12:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tagging_tagged`
--

CREATE TABLE `tagging_tagged` (
  `id` int(10) UNSIGNED NOT NULL,
  `taggable_id` int(10) UNSIGNED NOT NULL,
  `taggable_type` varchar(125) NOT NULL,
  `tag_name` varchar(125) NOT NULL,
  `tag_slug` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tagging_tags`
--

CREATE TABLE `tagging_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(125) NOT NULL,
  `name` varchar(125) NOT NULL,
  `suggest` tinyint(1) NOT NULL DEFAULT 0,
  `count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `tag_group_id` int(10) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tagging_tag_groups`
--

CREATE TABLE `tagging_tag_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(125) NOT NULL,
  `name` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trainings_imgs`
--

CREATE TABLE `trainings_imgs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `training_id` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `agencyID` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'Guest',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `agencyID`, `profile_picture`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@gmail.com', '1', 'profile_pictures/Administrator_profile_picture.png', 'Admin', NULL, '$2y$10$i82bYSFWPtNuKksq9Hks4ueLE.ddfxFAfOhEbOR87PlcoSCOMcouG', NULL, NULL, '2024-01-04 02:25:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agency`
--
ALTER TABLE `agency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `awards_recipients`
--
ALTER TABLE `awards_recipients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `best_paper`
--
ALTER TABLE `best_paper`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `best_paper_evaluators`
--
ALTER TABLE `best_paper_evaluators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `best_poster`
--
ALTER TABLE `best_poster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `best_poster_evaluators`
--
ALTER TABLE `best_poster_evaluators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `budgets`
--
ALTER TABLE `budgets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cbg_awards`
--
ALTER TABLE `cbg_awards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cbg_contributions`
--
ALTER TABLE `cbg_contributions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cbg_equipments`
--
ALTER TABLE `cbg_equipments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cbg_initiatives`
--
ALTER TABLE `cbg_initiatives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cbg_meetings`
--
ALTER TABLE `cbg_meetings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cbg_trainings`
--
ALTER TABLE `cbg_trainings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment_imgs`
--
ALTER TABLE `equipment_imgs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `personnels`
--
ALTER TABLE `personnels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `policy_formulated`
--
ALTER TABLE `policy_formulated`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `policy_prc`
--
ALTER TABLE `policy_prc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `programs_programid_unique` (`programID`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_budget`
--
ALTER TABLE `project_budget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rdmc_activities`
--
ALTER TABLE `rdmc_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rdmc_dbinfosys`
--
ALTER TABLE `rdmc_dbinfosys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rdmc_linkages`
--
ALTER TABLE `rdmc_linkages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rdmc_regional`
--
ALTER TABLE `rdmc_regional`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rdmc_regional_participants`
--
ALTER TABLE `rdmc_regional_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rdru_tech_deployed`
--
ALTER TABLE `rdru_tech_deployed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rdru_tech_initiatives`
--
ALTER TABLE `rdru_tech_initiatives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `researchers`
--
ALTER TABLE `researchers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `researchers_email_unique` (`email`);

--
-- Indexes for table `results_tpa`
--
ALTER TABLE `results_tpa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results_ttm`
--
ALTER TABLE `results_ttm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results_ttp`
--
ALTER TABLE `results_ttp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `strategic_activities`
--
ALTER TABLE `strategic_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `strategic_collaborative_list`
--
ALTER TABLE `strategic_collaborative_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `strategic_program_list`
--
ALTER TABLE `strategic_program_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `strategic_tech_list`
--
ALTER TABLE `strategic_tech_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `strat_collab_imgs`
--
ALTER TABLE `strat_collab_imgs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `strat_program_list_imgs`
--
ALTER TABLE `strat_program_list_imgs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `strat_tech_list_imgs`
--
ALTER TABLE `strat_tech_list_imgs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_projects`
--
ALTER TABLE `sub_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_project_budget`
--
ALTER TABLE `sub_project_budget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tagging_tagged`
--
ALTER TABLE `tagging_tagged`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tagging_tagged_taggable_id_index` (`taggable_id`),
  ADD KEY `tagging_tagged_taggable_type_index` (`taggable_type`),
  ADD KEY `tagging_tagged_tag_slug_index` (`tag_slug`);

--
-- Indexes for table `tagging_tags`
--
ALTER TABLE `tagging_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tagging_tags_slug_index` (`slug`),
  ADD KEY `tagging_tags_tag_group_id_foreign` (`tag_group_id`);

--
-- Indexes for table `tagging_tag_groups`
--
ALTER TABLE `tagging_tag_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tagging_tag_groups_slug_index` (`slug`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainings_imgs`
--
ALTER TABLE `trainings_imgs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agency`
--
ALTER TABLE `agency`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `awards_recipients`
--
ALTER TABLE `awards_recipients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `best_paper`
--
ALTER TABLE `best_paper`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `best_paper_evaluators`
--
ALTER TABLE `best_paper_evaluators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `best_poster`
--
ALTER TABLE `best_poster`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `best_poster_evaluators`
--
ALTER TABLE `best_poster_evaluators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `budgets`
--
ALTER TABLE `budgets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cbg_awards`
--
ALTER TABLE `cbg_awards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cbg_contributions`
--
ALTER TABLE `cbg_contributions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cbg_equipments`
--
ALTER TABLE `cbg_equipments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cbg_initiatives`
--
ALTER TABLE `cbg_initiatives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cbg_meetings`
--
ALTER TABLE `cbg_meetings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cbg_trainings`
--
ALTER TABLE `cbg_trainings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipment_imgs`
--
ALTER TABLE `equipment_imgs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personnels`
--
ALTER TABLE `personnels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `policy_formulated`
--
ALTER TABLE `policy_formulated`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policy_prc`
--
ALTER TABLE `policy_prc`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `project_budget`
--
ALTER TABLE `project_budget`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rdmc_activities`
--
ALTER TABLE `rdmc_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rdmc_dbinfosys`
--
ALTER TABLE `rdmc_dbinfosys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rdmc_linkages`
--
ALTER TABLE `rdmc_linkages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rdmc_regional`
--
ALTER TABLE `rdmc_regional`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rdmc_regional_participants`
--
ALTER TABLE `rdmc_regional_participants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rdru_tech_deployed`
--
ALTER TABLE `rdru_tech_deployed`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rdru_tech_initiatives`
--
ALTER TABLE `rdru_tech_initiatives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `researchers`
--
ALTER TABLE `researchers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `results_tpa`
--
ALTER TABLE `results_tpa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `results_ttm`
--
ALTER TABLE `results_ttm`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `results_ttp`
--
ALTER TABLE `results_ttp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `strategic_activities`
--
ALTER TABLE `strategic_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `strategic_collaborative_list`
--
ALTER TABLE `strategic_collaborative_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `strategic_program_list`
--
ALTER TABLE `strategic_program_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `strategic_tech_list`
--
ALTER TABLE `strategic_tech_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `strat_collab_imgs`
--
ALTER TABLE `strat_collab_imgs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `strat_program_list_imgs`
--
ALTER TABLE `strat_program_list_imgs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `strat_tech_list_imgs`
--
ALTER TABLE `strat_tech_list_imgs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_projects`
--
ALTER TABLE `sub_projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_project_budget`
--
ALTER TABLE `sub_project_budget`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tagging_tagged`
--
ALTER TABLE `tagging_tagged`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tagging_tags`
--
ALTER TABLE `tagging_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tagging_tag_groups`
--
ALTER TABLE `tagging_tag_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainings_imgs`
--
ALTER TABLE `trainings_imgs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tagging_tags`
--
ALTER TABLE `tagging_tags`
  ADD CONSTRAINT `tagging_tags_tag_group_id_foreign` FOREIGN KEY (`tag_group_id`) REFERENCES `tagging_tag_groups` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
