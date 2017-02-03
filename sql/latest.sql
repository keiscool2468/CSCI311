-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 03, 2017 at 02:54 PM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.0.13-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `HKscouting`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_groups`
--

CREATE TABLE `admin_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_groups`
--

INSERT INTO `admin_groups` (`id`, `name`, `description`) VALUES
(1, 'webmaster', 'Webmaster'),
(2, 'admin', 'Administrator'),
(3, 'manager', 'Manager'),
(4, 'staff', 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `admin_login_attempts`
--

CREATE TABLE `admin_login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`) VALUES
(1, '127.0.0.1', 'webmaster', '$2y$08$/X5gzWjesYi78GqeAv5tA.dVGBVP7C1e1PzqnYCVe5s1qhlDIPPES', NULL, NULL, NULL, NULL, NULL, NULL, 1451900190, 1485934843, 1, 'Webmaster', ''),
(2, '127.0.0.1', 'admin', '$2y$08$7Bkco6JXtC3Hu6g9ngLZDuHsFLvT7cyAxiz1FzxlX5vwccvRT7nKW', NULL, NULL, NULL, NULL, NULL, NULL, 1451900228, 1484731155, 1, 'Admin', ''),
(3, '127.0.0.1', 'manager', '$2y$08$snzIJdFXvg/rSHe0SndIAuvZyjktkjUxBXkrrGdkPy1K6r5r/dMLa', NULL, NULL, NULL, NULL, NULL, NULL, 1451900430, 1484731176, 1, 'Manager', ''),
(4, '127.0.0.1', 'staff', '$2y$08$NigAXjN23CRKllqe3KmjYuWXD5iSRPY812SijlhGeKfkrMKde9da6', NULL, NULL, NULL, NULL, NULL, NULL, 1451900439, 1485398033, 1, 'Staff', '');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users_groups`
--

CREATE TABLE `admin_users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_users_groups`
--

INSERT INTO `admin_users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scout_advanced_signature`
--

CREATE TABLE `scout_advanced_signature` (
  `id` int(11) NOT NULL,
  `record_book_number` int(11) NOT NULL,
  `A1a` varchar(255) DEFAULT NULL,
  `A1b` varchar(255) DEFAULT NULL,
  `A1c` varchar(255) DEFAULT NULL,
  `A2ai` varchar(255) DEFAULT NULL,
  `A2aii` varchar(255) DEFAULT NULL,
  `A2b` varchar(255) DEFAULT NULL,
  `A2c` varchar(255) DEFAULT NULL,
  `A3a` varchar(255) DEFAULT NULL,
  `A3b` varchar(255) DEFAULT NULL,
  `A3c` varchar(255) DEFAULT NULL,
  `A4a` varchar(255) DEFAULT NULL,
  `A4b` varchar(255) DEFAULT NULL,
  `A5a` varchar(255) DEFAULT NULL,
  `A5b` varchar(255) DEFAULT NULL,
  `A5c` varchar(255) DEFAULT NULL,
  `A6a` varchar(255) DEFAULT NULL,
  `A6b` varchar(255) DEFAULT NULL,
  `A6c` varchar(255) DEFAULT NULL,
  `B1ai` varchar(255) DEFAULT NULL,
  `B1aii` varchar(255) DEFAULT NULL,
  `B1aiii` varchar(255) DEFAULT NULL,
  `B1aiv` varchar(255) DEFAULT NULL,
  `B2a` varchar(255) DEFAULT NULL,
  `B2bi` varchar(255) DEFAULT NULL,
  `B2bii` varchar(255) DEFAULT NULL,
  `B2biii` varchar(255) DEFAULT NULL,
  `B2biv` varchar(255) DEFAULT NULL,
  `B2bv` varchar(255) DEFAULT NULL,
  `B2bvi` varchar(255) DEFAULT NULL,
  `B3a` varchar(255) DEFAULT NULL,
  `B4a` varchar(255) DEFAULT NULL,
  `B4ai` varchar(255) DEFAULT NULL,
  `B4aii` varchar(255) DEFAULT NULL,
  `C1a` varchar(255) DEFAULT NULL,
  `C1b` varchar(255) DEFAULT NULL,
  `C1c` varchar(255) DEFAULT NULL,
  `C1d` varchar(255) DEFAULT NULL,
  `C1chop` varchar(255) DEFAULT NULL,
  `C2ai` varchar(255) DEFAULT NULL,
  `C2aii` varchar(255) DEFAULT NULL,
  `C2aiii` varchar(255) DEFAULT NULL,
  `C3ai` varchar(255) DEFAULT NULL,
  `C3aii` varchar(255) DEFAULT NULL,
  `D1a` varchar(255) DEFAULT NULL,
  `D2ai` varchar(255) DEFAULT NULL,
  `D2aii` varchar(255) DEFAULT NULL,
  `D2bi` varchar(255) DEFAULT NULL,
  `D2bii` varchar(255) DEFAULT NULL,
  `D3ai` varchar(255) DEFAULT NULL,
  `D3aii` varchar(255) DEFAULT NULL,
  `E1` varchar(255) DEFAULT NULL,
  `issue_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `scout_advanced_times`
--

CREATE TABLE `scout_advanced_times` (
  `id` int(11) NOT NULL,
  `record_book_number` int(11) NOT NULL,
  `A1a` datetime DEFAULT NULL,
  `A1b` datetime DEFAULT NULL,
  `A1c` datetime DEFAULT NULL,
  `A2ai` datetime DEFAULT NULL,
  `A2aii` datetime DEFAULT NULL,
  `A2b` datetime DEFAULT NULL,
  `A2c` datetime DEFAULT NULL,
  `A3a` datetime DEFAULT NULL,
  `A3b` datetime DEFAULT NULL,
  `A3c` datetime DEFAULT NULL,
  `A4a` datetime DEFAULT NULL,
  `A4b` datetime DEFAULT NULL,
  `A5a` datetime DEFAULT NULL,
  `A5b` datetime DEFAULT NULL,
  `A5c` datetime DEFAULT NULL,
  `A6a` datetime DEFAULT NULL,
  `A6b` datetime DEFAULT NULL,
  `A6c` datetime DEFAULT NULL,
  `B1ai` datetime DEFAULT NULL,
  `B1aii` datetime DEFAULT NULL,
  `B1aiii` datetime DEFAULT NULL,
  `B1aiv` datetime DEFAULT NULL,
  `B2a` datetime DEFAULT NULL,
  `B2bi` datetime DEFAULT NULL,
  `B2bii` datetime DEFAULT NULL,
  `B2biii` datetime DEFAULT NULL,
  `B2biv` datetime DEFAULT NULL,
  `B2bv` datetime DEFAULT NULL,
  `B2bvi` datetime DEFAULT NULL,
  `B3a` datetime DEFAULT NULL,
  `B4a` datetime DEFAULT NULL,
  `B4ai` datetime DEFAULT NULL,
  `B4aii` datetime DEFAULT NULL,
  `C1a` datetime DEFAULT NULL,
  `C1b` datetime DEFAULT NULL,
  `C1c` datetime DEFAULT NULL,
  `C1d` datetime DEFAULT NULL,
  `C1chop` datetime DEFAULT NULL,
  `C2ai` datetime DEFAULT NULL,
  `C2aii` datetime DEFAULT NULL,
  `C2aiii` datetime DEFAULT NULL,
  `C3ai` datetime DEFAULT NULL,
  `C3aii` datetime DEFAULT NULL,
  `D1a` datetime DEFAULT NULL,
  `D2ai` datetime DEFAULT NULL,
  `D2aii` datetime DEFAULT NULL,
  `D2bi` datetime DEFAULT NULL,
  `D2bii` datetime DEFAULT NULL,
  `D3ai` datetime DEFAULT NULL,
  `D3aii` datetime DEFAULT NULL,
  `E1` datetime DEFAULT NULL,
  `issue_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `scout_chief_signatures`
--

CREATE TABLE `scout_chief_signatures` (
  `id` int(11) NOT NULL,
  `record_book_number` int(11) NOT NULL,
  `A1a` varchar(255) NOT NULL,
  `A1b` varchar(255) NOT NULL,
  `A1c` varchar(255) NOT NULL,
  `A2a` varchar(255) NOT NULL,
  `A2b` varchar(255) NOT NULL,
  `A2c` varchar(255) NOT NULL,
  `A3a` varchar(255) NOT NULL,
  `A3b` varchar(255) NOT NULL,
  `A4a` varchar(255) NOT NULL,
  `A4b` varchar(255) NOT NULL,
  `A5a` varchar(255) NOT NULL,
  `A5b` varchar(255) NOT NULL,
  `A6a` varchar(255) NOT NULL,
  `A6b` varchar(255) NOT NULL,
  `B1a` varchar(255) NOT NULL,
  `B1b` varchar(255) NOT NULL,
  `B2a` varchar(255) NOT NULL,
  `B2bi` varchar(255) NOT NULL,
  `B2bii` varchar(255) NOT NULL,
  `B2biii` varchar(255) NOT NULL,
  `B2biv` varchar(255) NOT NULL,
  `B2bv` varchar(255) NOT NULL,
  `B2bvi` varchar(255) NOT NULL,
  `B3a` varchar(255) NOT NULL,
  `B4a` varchar(255) NOT NULL,
  `B4bi` varchar(255) NOT NULL,
  `B4bii` varchar(255) NOT NULL,
  `B4biii` varchar(255) NOT NULL,
  `C1a` varchar(255) NOT NULL,
  `C1b` varchar(255) NOT NULL,
  `C1c` varchar(255) NOT NULL,
  `C1chop` varchar(255) NOT NULL,
  `C2a` varchar(255) NOT NULL,
  `C2bi` varchar(255) NOT NULL,
  `C2bii` varchar(255) NOT NULL,
  `C2biii` varchar(255) NOT NULL,
  `C3a` varchar(255) NOT NULL,
  `C3bi` varchar(255) NOT NULL,
  `C3bii` varchar(255) NOT NULL,
  `C3biii` varchar(255) NOT NULL,
  `D1a` varchar(255) NOT NULL,
  `D2a` varchar(255) NOT NULL,
  `D2bi` varchar(255) NOT NULL,
  `D2bii` varchar(255) NOT NULL,
  `D3a` varchar(255) NOT NULL,
  `D3b` varchar(255) NOT NULL,
  `E1` varchar(255) NOT NULL,
  `E2` varchar(255) NOT NULL,
  `nomination` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scout_chief_times`
--

CREATE TABLE `scout_chief_times` (
  `id` int(11) NOT NULL,
  `record_book_number` int(11) NOT NULL,
  `A1a` datetime NOT NULL,
  `A1b` datetime NOT NULL,
  `A1c` datetime NOT NULL,
  `A2a` datetime NOT NULL,
  `A2b` datetime NOT NULL,
  `A2c` datetime NOT NULL,
  `A3a` datetime NOT NULL,
  `A3b` datetime NOT NULL,
  `A4a` datetime NOT NULL,
  `A4b` datetime NOT NULL,
  `A5a` datetime NOT NULL,
  `A5b` datetime NOT NULL,
  `A6a` datetime NOT NULL,
  `A6b` datetime NOT NULL,
  `B1a` datetime NOT NULL,
  `B1b` datetime NOT NULL,
  `B2a` datetime NOT NULL,
  `B2bi` datetime NOT NULL,
  `B2bii` datetime NOT NULL,
  `B2biii` datetime NOT NULL,
  `B2biv` datetime NOT NULL,
  `B2bv` datetime NOT NULL,
  `B2bvi` datetime NOT NULL,
  `B3a` datetime NOT NULL,
  `B4a` datetime NOT NULL,
  `B4bi` datetime NOT NULL,
  `B4bii` datetime NOT NULL,
  `B4biii` datetime NOT NULL,
  `C1a` datetime NOT NULL,
  `C1b` datetime NOT NULL,
  `C1c` datetime NOT NULL,
  `C1chop` datetime NOT NULL,
  `C2a` datetime NOT NULL,
  `C2bi` datetime NOT NULL,
  `C2bii` datetime NOT NULL,
  `C2biii` datetime NOT NULL,
  `C3a` datetime NOT NULL,
  `C3bi` datetime NOT NULL,
  `C3bii` datetime NOT NULL,
  `C3biii` datetime NOT NULL,
  `D1a` datetime NOT NULL,
  `D2a` datetime NOT NULL,
  `D2bi` datetime NOT NULL,
  `D2bii` datetime NOT NULL,
  `D3a` datetime NOT NULL,
  `D3b` datetime NOT NULL,
  `E1` datetime NOT NULL,
  `E2` datetime NOT NULL,
  `nomination` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scout_membership_signatures`
--

CREATE TABLE `scout_membership_signatures` (
  `id` int(11) NOT NULL,
  `record_book_number` int(11) NOT NULL,
  `1` varchar(255) DEFAULT NULL,
  `2` varchar(255) DEFAULT NULL,
  `3` varchar(255) DEFAULT NULL,
  `4` varchar(255) DEFAULT NULL,
  `5` varchar(255) DEFAULT NULL,
  `6` varchar(255) DEFAULT NULL,
  `7` varchar(255) DEFAULT NULL,
  `8` varchar(255) DEFAULT NULL,
  `9` varchar(255) DEFAULT NULL,
  `10` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scout_membership_times`
--

CREATE TABLE `scout_membership_times` (
  `id` int(11) NOT NULL,
  `record_book_number` int(11) NOT NULL,
  `1` datetime DEFAULT NULL,
  `2` datetime DEFAULT NULL,
  `3` datetime DEFAULT NULL,
  `4` datetime DEFAULT NULL,
  `5` datetime DEFAULT NULL,
  `6` datetime DEFAULT NULL,
  `7` datetime DEFAULT NULL,
  `8` datetime DEFAULT NULL,
  `9` datetime DEFAULT NULL,
  `10` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scout_pathfinder_signatures`
--

CREATE TABLE `scout_pathfinder_signatures` (
  `id` int(11) NOT NULL,
  `record_book_number` int(11) NOT NULL,
  `A1a` varchar(255) DEFAULT NULL,
  `A1b` varchar(255) DEFAULT NULL,
  `A1c` varchar(255) DEFAULT NULL,
  `A1d` varchar(255) DEFAULT NULL,
  `A2a` varchar(255) DEFAULT NULL,
  `A2b` varchar(255) DEFAULT NULL,
  `A2c` varchar(255) DEFAULT NULL,
  `A3a` varchar(255) DEFAULT NULL,
  `A3b` varchar(255) DEFAULT NULL,
  `A4a` varchar(255) DEFAULT NULL,
  `A4bi` varchar(255) DEFAULT NULL,
  `A4bii` varchar(255) DEFAULT NULL,
  `A4biii` varchar(255) DEFAULT NULL,
  `A5a` varchar(255) DEFAULT NULL,
  `A5b` varchar(255) DEFAULT NULL,
  `A6a` varchar(255) DEFAULT NULL,
  `A6bi` varchar(255) DEFAULT NULL,
  `A6bii` varchar(255) DEFAULT NULL,
  `A6biii` varchar(255) DEFAULT NULL,
  `B1a` varchar(255) DEFAULT NULL,
  `B2a` varchar(255) DEFAULT NULL,
  `B3a` varchar(255) DEFAULT NULL,
  `B4a` varchar(255) DEFAULT NULL,
  `B4b` varchar(255) DEFAULT NULL,
  `C1a` varchar(255) DEFAULT NULL,
  `C1b` varchar(255) DEFAULT NULL,
  `C2a` varchar(255) DEFAULT NULL,
  `D1a` varchar(255) DEFAULT NULL,
  `D2a` varchar(255) DEFAULT NULL,
  `issue_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scout_pathfinder_times`
--

CREATE TABLE `scout_pathfinder_times` (
  `id` int(11) NOT NULL,
  `record_book_number` int(11) NOT NULL,
  `A1a` datetime DEFAULT NULL,
  `A1b` datetime DEFAULT NULL,
  `A1c` datetime DEFAULT NULL,
  `A1d` datetime DEFAULT NULL,
  `A2a` datetime DEFAULT NULL,
  `A2b` datetime DEFAULT NULL,
  `A2c` datetime DEFAULT NULL,
  `A3a` datetime DEFAULT NULL,
  `A3b` datetime DEFAULT NULL,
  `A4a` datetime DEFAULT NULL,
  `A4bi` datetime DEFAULT NULL,
  `A4bii` datetime DEFAULT NULL,
  `A4biii` datetime DEFAULT NULL,
  `A5a` datetime DEFAULT NULL,
  `A5b` datetime DEFAULT NULL,
  `A6a` datetime DEFAULT NULL,
  `A6bi` datetime DEFAULT NULL,
  `A6bii` datetime DEFAULT NULL,
  `A6biii` datetime DEFAULT NULL,
  `B1a` datetime DEFAULT NULL,
  `B2a` datetime DEFAULT NULL,
  `B3a` datetime DEFAULT NULL,
  `B4a` datetime DEFAULT NULL,
  `B4b` datetime DEFAULT NULL,
  `C1a` datetime DEFAULT NULL,
  `C1b` datetime DEFAULT NULL,
  `C2a` datetime DEFAULT NULL,
  `D1a` datetime DEFAULT NULL,
  `D2a` datetime DEFAULT NULL,
  `issue_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scout_personal_particulars`
--

CREATE TABLE `scout_personal_particulars` (
  `id` int(11) NOT NULL,
  `chinese_name` varchar(255) NOT NULL,
  `english_name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `age` int(2) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `hkid` varchar(4) NOT NULL,
  `record_book_number` varchar(12) NOT NULL,
  `date_of_investiture` date NOT NULL,
  `region` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `group_number` int(4) NOT NULL,
  `chinese_address` varchar(255) NOT NULL,
  `english_address` varchar(255) NOT NULL,
  `contact_number` int(8) NOT NULL,
  `email_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scout_standard_signatures`
--

CREATE TABLE `scout_standard_signatures` (
  `id` int(11) NOT NULL,
  `record_book_number` int(11) NOT NULL,
  `A1a` varchar(255) DEFAULT NULL,
  `A1b` varchar(255) DEFAULT NULL,
  `A1c` varchar(255) DEFAULT NULL,
  `A1d` varchar(255) DEFAULT NULL,
  `A1e` varchar(255) DEFAULT NULL,
  `A2a` varchar(255) DEFAULT NULL,
  `A2b` varchar(255) DEFAULT NULL,
  `A2c` varchar(255) DEFAULT NULL,
  `A2d` varchar(255) DEFAULT NULL,
  `A3a` varchar(255) DEFAULT NULL,
  `A3b` varchar(255) DEFAULT NULL,
  `A3c` varchar(255) DEFAULT NULL,
  `A4a` varchar(255) DEFAULT NULL,
  `A4b` varchar(255) DEFAULT NULL,
  `A4ci` varchar(255) DEFAULT NULL,
  `A4cii` varchar(255) DEFAULT NULL,
  `A5a` varchar(255) DEFAULT NULL,
  `A6a` varchar(255) DEFAULT NULL,
  `A6b` varchar(255) DEFAULT NULL,
  `A6ci` varchar(255) DEFAULT NULL,
  `A6cii` varchar(255) DEFAULT NULL,
  `B1ai` varchar(255) DEFAULT NULL,
  `B1aii` varchar(255) DEFAULT NULL,
  `B2a` varchar(255) DEFAULT NULL,
  `B2bii` varchar(255) DEFAULT NULL,
  `B2biii` varchar(255) DEFAULT NULL,
  `B2biv` varchar(255) DEFAULT NULL,
  `B2bv` varchar(255) DEFAULT NULL,
  `B2bvi` varchar(255) DEFAULT NULL,
  `B3a` varchar(255) DEFAULT NULL,
  `B4a` varchar(255) DEFAULT NULL,
  `B4bi` varchar(255) DEFAULT NULL,
  `B4bii` varchar(255) DEFAULT NULL,
  `C1a` varchar(255) DEFAULT NULL,
  `C1b` varchar(255) DEFAULT NULL,
  `C1c` varchar(255) DEFAULT NULL,
  `C1d` varchar(255) DEFAULT NULL,
  `C2a` varchar(255) DEFAULT NULL,
  `C3a` varchar(255) DEFAULT NULL,
  `D1a` varchar(255) DEFAULT NULL,
  `D2ai` varchar(255) DEFAULT NULL,
  `D2aii` varchar(255) DEFAULT NULL,
  `D3ai` varchar(255) DEFAULT NULL,
  `D3aii` varchar(255) DEFAULT NULL,
  `E1a` varchar(255) DEFAULT NULL,
  `issue_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scout_standard_times`
--

CREATE TABLE `scout_standard_times` (
  `id` int(11) NOT NULL,
  `record_book_number` int(11) NOT NULL,
  `A1a` datetime DEFAULT NULL,
  `A1b` datetime DEFAULT NULL,
  `A1c` datetime DEFAULT NULL,
  `A1d` datetime DEFAULT NULL,
  `A1e` datetime DEFAULT NULL,
  `A2a` datetime DEFAULT NULL,
  `A2b` datetime DEFAULT NULL,
  `A2c` datetime DEFAULT NULL,
  `A2d` datetime DEFAULT NULL,
  `A3a` datetime DEFAULT NULL,
  `A3b` datetime DEFAULT NULL,
  `A3c` datetime DEFAULT NULL,
  `A4a` datetime DEFAULT NULL,
  `A4b` datetime DEFAULT NULL,
  `A4ci` datetime DEFAULT NULL,
  `A4cii` datetime DEFAULT NULL,
  `A5a` datetime DEFAULT NULL,
  `A6a` datetime DEFAULT NULL,
  `A6b` datetime DEFAULT NULL,
  `A6ci` datetime DEFAULT NULL,
  `A6cii` datetime DEFAULT NULL,
  `B1ai` datetime DEFAULT NULL,
  `B1aii` datetime DEFAULT NULL,
  `B2a` datetime DEFAULT NULL,
  `B2bii` datetime DEFAULT NULL,
  `B2biii` datetime DEFAULT NULL,
  `B2biv` datetime DEFAULT NULL,
  `B2bv` datetime DEFAULT NULL,
  `B2bvi` datetime DEFAULT NULL,
  `B3a` datetime DEFAULT NULL,
  `B4a` datetime DEFAULT NULL,
  `B4bi` datetime DEFAULT NULL,
  `B4bii` datetime DEFAULT NULL,
  `C1a` datetime DEFAULT NULL,
  `C1b` datetime DEFAULT NULL,
  `C1c` datetime DEFAULT NULL,
  `C1d` datetime DEFAULT NULL,
  `C2a` datetime DEFAULT NULL,
  `C3a` datetime DEFAULT NULL,
  `D1a` datetime DEFAULT NULL,
  `D2ai` datetime DEFAULT NULL,
  `D2aii` datetime DEFAULT NULL,
  `D3ai` datetime DEFAULT NULL,
  `D3aii` datetime DEFAULT NULL,
  `E1a` datetime DEFAULT NULL,
  `issue_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'member', '$2y$08$kkqUE2hrqAJtg.pPnAhvL.1iE7LIujK5LZ61arONLpaBBWh/ek61G', NULL, 'member@member.com', NULL, NULL, NULL, NULL, 1451903855, 1451905011, 1, 'Member', 'One', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_groups`
--
ALTER TABLE `admin_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_login_attempts`
--
ALTER TABLE `admin_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_users_groups`
--
ALTER TABLE `admin_users_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scout_advanced_signature`
--
ALTER TABLE `scout_advanced_signature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scout_advanced_times`
--
ALTER TABLE `scout_advanced_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scout_chief_signatures`
--
ALTER TABLE `scout_chief_signatures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scout_chief_times`
--
ALTER TABLE `scout_chief_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scout_membership_signatures`
--
ALTER TABLE `scout_membership_signatures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scout_membership_times`
--
ALTER TABLE `scout_membership_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scout_pathfinder_signatures`
--
ALTER TABLE `scout_pathfinder_signatures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scout_pathfinder_times`
--
ALTER TABLE `scout_pathfinder_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scout_personal_particulars`
--
ALTER TABLE `scout_personal_particulars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `scout_standard_signatures`
--
ALTER TABLE `scout_standard_signatures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scout_standard_times`
--
ALTER TABLE `scout_standard_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_groups`
--
ALTER TABLE `admin_groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `admin_login_attempts`
--
ALTER TABLE `admin_login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `admin_users_groups`
--
ALTER TABLE `admin_users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `scout_advanced_signature`
--
ALTER TABLE `scout_advanced_signature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `scout_advanced_times`
--
ALTER TABLE `scout_advanced_times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `scout_chief_signatures`
--
ALTER TABLE `scout_chief_signatures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `scout_chief_times`
--
ALTER TABLE `scout_chief_times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `scout_membership_signatures`
--
ALTER TABLE `scout_membership_signatures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `scout_membership_times`
--
ALTER TABLE `scout_membership_times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `scout_pathfinder_signatures`
--
ALTER TABLE `scout_pathfinder_signatures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `scout_pathfinder_times`
--
ALTER TABLE `scout_pathfinder_times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `scout_personal_particulars`
--
ALTER TABLE `scout_personal_particulars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `scout_standard_signatures`
--
ALTER TABLE `scout_standard_signatures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `scout_standard_times`
--
ALTER TABLE `scout_standard_times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
