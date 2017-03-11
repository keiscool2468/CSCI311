-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- 主機: localhost
-- 產生時間： 2017 年 02 月 16 日 01:26
-- 伺服器版本: 5.7.17-0ubuntu0.16.04.1
-- PHP 版本： 7.0.13-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `HKscouting`
--

-- --------------------------------------------------------

--
-- 資料表結構 `admin_groups`
--

CREATE TABLE `admin_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `admin_groups`
--

INSERT INTO `admin_groups` (`id`, `name`, `description`) VALUES
(1, 'webmaster', 'Webmaster'),
(2, 'Leader', 'Leader'),
(3, 'Scout', 'Scout'),
(4, 'Sea Scout', 'Sea Scout'),
(5, 'Air Scout', 'Air Scout');

-- --------------------------------------------------------

--
-- 資料表結構 `admin_login_attempts`
--

CREATE TABLE `admin_login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `admin_users`
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
-- 資料表的匯出資料 `admin_users`
--

INSERT INTO `admin_users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`) VALUES
(1, '127.0.0.1', 'webmaster', '$2y$08$/X5gzWjesYi78GqeAv5tA.dVGBVP7C1e1PzqnYCVe5s1qhlDIPPES', NULL, NULL, NULL, NULL, NULL, NULL, 1451900190, 1487179481, 1, 'Webmaster', 'webmaster'),
(2, '127.0.0.1', 'admin', '$2y$08$7Bkco6JXtC3Hu6g9ngLZDuHsFLvT7cyAxiz1FzxlX5vwccvRT7nKW', NULL, NULL, NULL, NULL, NULL, NULL, 1451900228, 1484731155, 1, 'Admin', ''),
(5, '127.0.0.1', 'keiscool2468', '$2y$08$XYCmeX5MCHLtZrIG4rfD8OYDmGaVvhtgO5sC5yBjLgW1/Cf45do0y', NULL, NULL, NULL, NULL, NULL, NULL, 1486525701, 1486525729, 1, 'Li', 'Chak Shing'),
(6, '127.0.0.1', 'jack', '$2y$08$ZzjKCMOVLBrLWfDtEXk8VuyAku7Te9ojaniNSvGqRrgQnofcvm6zy', NULL, NULL, NULL, NULL, NULL, NULL, 1486628711, NULL, 1, 'jack', 'jack'),
(7, '127.0.0.1', 'rose', '$2y$08$LLPnNpuCJA.jmREJmQVmoOycGuiYUw.dqQooVIl.BGMg7y0aOS6Ma', NULL, '', NULL, NULL, NULL, NULL, 1486650088, NULL, 1, 'rose', 'rose'),
(8, '127.0.0.1', 'sam', '$2y$08$UxH1NkIwib1ovr.nqvfQk.BEDJUDIkDnBPaIRiWIuAegnFvyx9hRK', NULL, '', NULL, NULL, NULL, NULL, 1486650225, NULL, 1, 'sam', 'sam'),
(9, '127.0.0.1', 'ram', '$2y$08$ipPLDE1W3hopgPOWFpzFzOnZqAcroOM/K9VL85BxC/nVMbc48o.UK', NULL, NULL, NULL, NULL, NULL, NULL, 1486651292, NULL, 1, 'ram', 'ram'),
(10, '127.0.0.1', 'ivan', '$2y$08$8RCpt6m86SLKVHTfehhp3.Xur3oKLVWtu.ASF1e0SToT2fZU7LPw6', NULL, NULL, NULL, NULL, NULL, NULL, 1486651413, NULL, 0, 'ivan', 'ivan'),
(11, '127.0.0.1', 'bigbuz', '$2y$08$YxaHjIm7L4g.C0NhfdZPjOQZsDaSpkwVoiJVEN3z74uWwZ9uLcjW.', NULL, NULL, NULL, NULL, NULL, NULL, 1487130867, NULL, 1, 'big', 'bus');

-- --------------------------------------------------------

--
-- 資料表結構 `admin_users_groups`
--

CREATE TABLE `admin_users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `admin_users_groups`
--

INSERT INTO `admin_users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 5, 3),
(6, 6, 3),
(7, 7, 2),
(8, 8, 3),
(9, 9, 3),
(10, 10, 3),
(11, 11, 5);

-- --------------------------------------------------------

--
-- 資料表結構 `award_groups`
--

CREATE TABLE `award_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `award_groups`
--

INSERT INTO `award_groups` (`id`, `name`, `description`) VALUES
(1, 'menbership', 'Membership Award'),
(2, 'pathfinder', 'Pathfinder Award'),
(3, 'standard', 'Standard Award'),
(4, 'advanced', 'Advanced Award'),
(5, 'chief', 'Chief Scout Award');

-- --------------------------------------------------------

--
-- 資料表結構 `award_users_groups`
--

CREATE TABLE `award_users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `award_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'members', 'General User');

-- --------------------------------------------------------

--
-- 資料表結構 `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `scout_advanced_awards`
--

CREATE TABLE `scout_advanced_awards` (
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
-- 資料表結構 `scout_award_update_records`
--

CREATE TABLE `scout_award_update_records` (
  `id` int(11) NOT NULL,
  `record_book_number` int(11) NOT NULL,
  `award_id` mediumint(8) NOT NULL,
  `field` varchar(255) NOT NULL,
  `leader_user_name` varchar(255) NOT NULL,
  `update_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 資料表結構 `scout_chief_awards`
--

CREATE TABLE `scout_chief_awards` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 資料表結構 `scout_membership_awards`
--

CREATE TABLE `scout_membership_awards` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 資料表結構 `scout_pathfinder_awards`
--

CREATE TABLE `scout_pathfinder_awards` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 資料表結構 `scout_personal_particulars`
--

CREATE TABLE `scout_personal_particulars` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `scout_type` varchar(255) NOT NULL,
  `chinese_name` varchar(255) NOT NULL,
  `english_name` varchar(255) NOT NULL,
  `date_of_birth` varchar(10) NOT NULL,
  `age` int(2) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `hkid` varchar(4) NOT NULL,
  `record_book_number` varchar(12) NOT NULL,
  `date_of_investiture` varchar(10) NOT NULL,
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
-- 資料表結構 `scout_personal_particulars_update_records`
--

CREATE TABLE `scout_personal_particulars_update_records` (
  `id` int(11) NOT NULL,
  `record_book_number` int(11) NOT NULL,
  `field` varchar(255) NOT NULL,
  `from` varchar(255) NOT NULL,
  `to` varchar(255) NOT NULL,
  `leader_user_name` varchar(255) NOT NULL,
  `update_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 資料表結構 `scout_standard_awards`
--

CREATE TABLE `scout_standard_awards` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 資料表結構 `users`
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
-- 資料表的匯出資料 `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'member', '$2y$08$kkqUE2hrqAJtg.pPnAhvL.1iE7LIujK5LZ61arONLpaBBWh/ek61G', NULL, 'member@member.com', NULL, NULL, NULL, NULL, 1451903855, 1451905011, 1, 'Member', 'One', NULL, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1);

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `admin_groups`
--
ALTER TABLE `admin_groups`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `admin_login_attempts`
--
ALTER TABLE `admin_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `admin_users_groups`
--
ALTER TABLE `admin_users_groups`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `award_groups`
--
ALTER TABLE `award_groups`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `award_users_groups`
--
ALTER TABLE `award_users_groups`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `scout_advanced_awards`
--
ALTER TABLE `scout_advanced_awards`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `scout_award_update_records`
--
ALTER TABLE `scout_award_update_records`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `scout_chief_awards`
--
ALTER TABLE `scout_chief_awards`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `scout_membership_awards`
--
ALTER TABLE `scout_membership_awards`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `scout_pathfinder_awards`
--
ALTER TABLE `scout_pathfinder_awards`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `scout_personal_particulars`
--
ALTER TABLE `scout_personal_particulars`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `scout_personal_particulars_update_records`
--
ALTER TABLE `scout_personal_particulars_update_records`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `scout_standard_awards`
--
ALTER TABLE `scout_standard_awards`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `admin_groups`
--
ALTER TABLE `admin_groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用資料表 AUTO_INCREMENT `admin_login_attempts`
--
ALTER TABLE `admin_login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- 使用資料表 AUTO_INCREMENT `admin_users_groups`
--
ALTER TABLE `admin_users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- 使用資料表 AUTO_INCREMENT `award_groups`
--
ALTER TABLE `award_groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用資料表 AUTO_INCREMENT `award_users_groups`
--
ALTER TABLE `award_users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用資料表 AUTO_INCREMENT `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `scout_advanced_awards`
--
ALTER TABLE `scout_advanced_awards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `scout_award_update_records`
--
ALTER TABLE `scout_award_update_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `scout_chief_awards`
--
ALTER TABLE `scout_chief_awards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `scout_membership_awards`
--
ALTER TABLE `scout_membership_awards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `scout_pathfinder_awards`
--
ALTER TABLE `scout_pathfinder_awards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `scout_personal_particulars`
--
ALTER TABLE `scout_personal_particulars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `scout_personal_particulars_update_records`
--
ALTER TABLE `scout_personal_particulars_update_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `scout_standard_awards`
--
ALTER TABLE `scout_standard_awards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用資料表 AUTO_INCREMENT `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
