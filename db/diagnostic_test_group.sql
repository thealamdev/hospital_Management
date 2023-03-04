-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 26, 2020 at 12:09 PM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `softwkbd_hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `diagnostic_test_group`
--

CREATE TABLE `diagnostic_test_group` (
  `test_id` int(150) NOT NULL,
  `test_title` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `output_format` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hospital_id` bigint(11) DEFAULT '0',
  `branch_id` bigint(20) DEFAULT '0',
  `speciman` varchar(250) COLLATE utf8_unicode_ci DEFAULT '0',
  `specimen_id` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0-inactive 1-active 2-delete',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='0-> pending 1->active 2-> delete';

--
-- Dumping data for table `diagnostic_test_group`
--

INSERT INTO `diagnostic_test_group` (`test_id`, `test_title`, `output_format`, `hospital_id`, `branch_id`, `speciman`, `specimen_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Serology', NULL, 5, 0, 'Blood', 1, 1, '2018-10-29 21:02:32', '2018-10-29 03:02:32'),
(2, 'Biochemistry', NULL, 5, 0, 'Blood', 1, 1, '2018-10-29 21:02:58', '2018-10-29 03:02:58'),
(3, 'Hormone Test', NULL, 5, 0, 'Blood', 1, 1, '2018-10-29 21:03:26', '2018-10-29 03:03:26'),
(4, 'Haematology', NULL, 5, 0, 'Blood', 1, 1, '2018-10-29 21:05:08', '2018-10-29 03:05:08'),
(5, 'Ultrasund', NULL, 5, 0, 'Imaging', 2, 1, '2018-10-29 21:05:41', '2018-10-29 03:05:41'),
(6, 'ECG', NULL, 0, 0, 'Electric Cardiograph', 10, 1, '2018-10-29 21:06:39', '2018-10-29 03:06:39'),
(7, 'Microbiology', NULL, 5, 0, 'Microbiology', 6, 1, '2018-10-29 21:07:51', '2018-10-29 03:07:51'),
(8, 'X-RAY', NULL, 5, 0, 'Radiology', 4, 1, '2018-10-29 21:08:18', '2018-10-29 03:08:18'),
(34, 'Urine', NULL, 5, 0, 'Urine', 3, 1, '2020-09-04 15:55:35', '2020-09-04 09:55:35'),
(35, 'Stool R/E', NULL, 5, 0, 'Stool', 5, 1, '2020-09-04 16:11:35', '2020-09-04 10:11:35'),
(36, 'ECG', NULL, 5, 0, 'ECG', 18, 1, '2020-09-04 16:58:03', '2020-09-04 10:58:03'),
(38, 'Echo', NULL, 5, 0, 'Echocardiogram', 17, 1, '2020-09-01 00:12:33', '2020-08-31 18:12:33'),
(39, '', NULL, 0, 0, 'Urine', 3, 1, '2020-09-26 14:57:13', '2020-09-26 08:57:13'),
(40, '', NULL, 0, 0, 'Urine', 3, 1, '2020-09-26 14:57:14', '2020-09-26 08:57:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diagnostic_test_group`
--
ALTER TABLE `diagnostic_test_group`
  ADD PRIMARY KEY (`test_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diagnostic_test_group`
--
ALTER TABLE `diagnostic_test_group`
  MODIFY `test_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
