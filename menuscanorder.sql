-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： mysql-service:3306
-- 生成日期： 2024-10-20 10:17:47
-- 服务器版本： 8.0.40
-- PHP 版本： 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `menuscanorder`
--

-- --------------------------------------------------------

--
-- 表的结构 `Account`
--

CREATE TABLE `Account` (
  `id` int NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `Account`
--

INSERT INTO `Account` (`id`, `password`) VALUES
(1, 'test3'),
(2, 't'),
(3, '1'),
(4, '1'),
(5, '1'),
(10, '1');

-- --------------------------------------------------------

--
-- 表的结构 `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` int UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('ci_session:4d51fba669ef4717f228c33fcaec921d53f4585d', '10.111.216.82', 4294967295, 0x5f5f63695f6c6173745f726567656e65726174657c693a313732393431363937343b5f63695f70726576696f75735f75726c7c733a33383a22687474703a2f2f34332e3135372e3235312e3130373a33303138302f696e6465782e7068702f223b),
('ci_session:97503b4372e7e1a4a86cd720209fa0ba18861051', '10.111.216.82', 4294967295, 0x5f5f63695f6c6173745f726567656e65726174657c693a313732393431363937343b5f63695f70726576696f75735f75726c7c733a33383a22687474703a2f2f34332e3135372e3235312e3130373a33303138302f696e6465782e7068702f223b6572726f727c733a31343a224e6f74204c6f6767656420696e2e223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226f6c64223b7d),
('ci_session:be0971b3808b5a4b0e4650b20f44eb769dac1b4c', '10.111.216.82', 4294967295, 0x5f5f63695f6c6173745f726567656e65726174657c693a313732393431363337383b5f63695f70726576696f75735f75726c7c733a34393a22687474703a2f2f34332e3135372e3235312e3130373a33303138302f696e6465782e7068702f736f72742f726573756c74223b69734c6f67676564496e7c623a313b69647c733a313a2231223b726f6c657c733a373a226d616e61676572223b),
('ci_session:f4373d9b6aeb0e85cf9c6642aa9da079c9dce8e7', '10.111.216.79', 4294967295, 0x5f5f63695f6c6173745f726567656e65726174657c693a313732393431353536383b5f63695f70726576696f75735f75726c7c733a34323a22687474703a2f2f34332e3135372e3235312e3130373a33303138302f696e6465782e7068702f736f7274223b69734c6f67676564496e7c623a313b69647c733a313a2231223b726f6c657c733a373a226d616e61676572223b6572726f727c733a33373a224e6f2076616c69642073706563696669636174696f6e20696e20746865207265636f72642e223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226f6c64223b7d);

-- --------------------------------------------------------

--
-- 表的结构 `Employee`
--

CREATE TABLE `Employee` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('manager','stock clerk') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `Employee`
--

INSERT INTO `Employee` (`id`, `name`, `role`) VALUES
(1, '管理员', 'manager'),
(2, '1', 'stock clerk'),
(3, '1', 'stock clerk'),
(4, '111', 'manager'),
(5, '1', 'manager'),
(10, '1', 'manager');

-- --------------------------------------------------------

--
-- 表的结构 `Item`
--

CREATE TABLE `Item` (
  `specification` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `place` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type` enum('screw','pipe','iron core','copper wire') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `stock_number` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `Item`
--

INSERT INTO `Item` (`specification`, `place`, `type`, `stock_number`) VALUES
('D', '', 'pipe', 114),
('H', '9', 'screw', 0);

-- --------------------------------------------------------

--
-- 表的结构 `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2024-04-21-025936', 'App\\Database\\Migrations\\CreateItemTable', 'default', 'App', 1729330123, 1),
(2, '2024-04-21-031320', 'App\\Database\\Migrations\\CreateAccountTable', 'default', 'App', 1729330123, 1),
(3, '2024-04-21-031815', 'App\\Database\\Migrations\\CreateEmployeeTable', 'default', 'App', 1729330123, 1),
(4, '2024-04-21-032424', 'App\\Database\\Migrations\\CreateStockChangeHistoryTable', 'default', 'App', 1729330123, 1),
(5, '2024-04-21-034333', 'App\\Database\\Migrations\\CreatePlaceChangeHistoryTable', 'default', 'App', 1729330124, 1);

-- --------------------------------------------------------

--
-- 表的结构 `Place_change_history`
--

CREATE TABLE `Place_change_history` (
  `record_id` int UNSIGNED NOT NULL,
  `id` int NOT NULL,
  `specification` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `approve` enum('yes','no') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'no',
  `time` timestamp NOT NULL,
  `old_position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `new_position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `Place_change_history`
--

INSERT INTO `Place_change_history` (`record_id`, `id`, `specification`, `approve`, `time`, `old_position`, `new_position`) VALUES
(1, 2, 'H', 'no', '2024-10-20 08:24:50', '', '9');

-- --------------------------------------------------------

--
-- 表的结构 `Stock_change_history`
--

CREATE TABLE `Stock_change_history` (
  `record_id` int UNSIGNED NOT NULL,
  `id` int NOT NULL,
  `specification` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `approve` enum('yes','no','waiting') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'waiting',
  `time` timestamp NOT NULL,
  `stock_change` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `Stock_change_history`
--

INSERT INTO `Stock_change_history` (`record_id`, `id`, `specification`, `approve`, `time`, `stock_change`) VALUES
(1, 2, 'H', 'no', '2024-10-20 08:24:50', 9),
(2, 2, 'H', 'no', '2024-10-20 08:25:31', 111),
(3, 2, 'H', 'no', '2024-10-20 08:25:54', 1),
(4, 2, 'H', 'no', '2024-10-20 08:27:13', 55),
(6, 2, 'D', 'no', '2024-10-20 08:58:17', 111),
(7, 2, 'D', 'no', '2024-10-20 09:00:39', 1),
(8, 2, 'D', 'yes', '2024-10-20 09:05:19', 1),
(9, 2, 'D', 'waiting', '2024-10-20 09:07:42', 1);

--
-- 转储表的索引
--

--
-- 表的索引 `Account`
--
ALTER TABLE `Account`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- 表的索引 `Employee`
--
ALTER TABLE `Employee`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `Item`
--
ALTER TABLE `Item`
  ADD PRIMARY KEY (`specification`) USING BTREE;

--
-- 表的索引 `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `Place_change_history`
--
ALTER TABLE `Place_change_history`
  ADD PRIMARY KEY (`record_id`) USING BTREE,
  ADD KEY `Place_change_history_id_foreign` (`id`) USING BTREE,
  ADD KEY `Place_change_history_specification_foreign` (`specification`) USING BTREE;

--
-- 表的索引 `Stock_change_history`
--
ALTER TABLE `Stock_change_history`
  ADD PRIMARY KEY (`record_id`) USING BTREE,
  ADD KEY `Stock_change_history_id_foreign` (`id`) USING BTREE,
  ADD KEY `Stock_change_history_specification_foreign` (`specification`) USING BTREE;

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `Account`
--
ALTER TABLE `Account`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用表AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `Place_change_history`
--
ALTER TABLE `Place_change_history`
  MODIFY `record_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `Stock_change_history`
--
ALTER TABLE `Stock_change_history`
  MODIFY `record_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 限制导出的表
--

--
-- 限制表 `Employee`
--
ALTER TABLE `Employee`
  ADD CONSTRAINT `Employee_id_foreign` FOREIGN KEY (`id`) REFERENCES `Account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `Place_change_history`
--
ALTER TABLE `Place_change_history`
  ADD CONSTRAINT `Place_change_history_id_foreign` FOREIGN KEY (`id`) REFERENCES `Account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Place_change_history_specification_foreign` FOREIGN KEY (`specification`) REFERENCES `Item` (`specification`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `Stock_change_history`
--
ALTER TABLE `Stock_change_history`
  ADD CONSTRAINT `Stock_change_history_id_foreign` FOREIGN KEY (`id`) REFERENCES `Account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Stock_change_history_specification_foreign` FOREIGN KEY (`specification`) REFERENCES `Item` (`specification`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
