-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 14, 2024 at 03:11 PM
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
-- Database: `invenio`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory_item`
--

CREATE TABLE `inventory_item` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `bl5` decimal(10,3) DEFAULT NULL,
  `bl6` decimal(10,3) DEFAULT NULL,
  `bl7` decimal(10,3) DEFAULT NULL,
  `bl9` decimal(10,3) DEFAULT NULL,
  `sp5` decimal(10,3) DEFAULT NULL,
  `sp6` decimal(10,3) DEFAULT NULL,
  `sp7` decimal(10,3) DEFAULT NULL,
  `sp9` decimal(10,3) DEFAULT NULL,
  `wl5` decimal(10,3) DEFAULT NULL,
  `wl6` decimal(10,3) DEFAULT NULL,
  `wl7` decimal(10,3) DEFAULT NULL,
  `wl9` decimal(10,3) DEFAULT NULL,
  `ld8` decimal(10,3) DEFAULT NULL,
  `ld9` decimal(10,3) DEFAULT NULL,
  `ld11` decimal(10,3) DEFAULT NULL,
  `dld` decimal(10,3) DEFAULT NULL,
  `pp` decimal(10,3) DEFAULT NULL,
  `cups50` decimal(10,3) DEFAULT NULL,
  `cups60` decimal(10,3) DEFAULT NULL,
  `cups80` decimal(10,3) DEFAULT NULL,
  `cups100` decimal(10,3) DEFAULT NULL,
  `cups150` decimal(10,3) DEFAULT NULL,
  `cups210` decimal(10,3) DEFAULT NULL,
  `cups250` decimal(10,3) DEFAULT NULL,
  `bd5` decimal(10,3) DEFAULT NULL,
  `bd6` decimal(10,3) DEFAULT NULL,
  `bd7` decimal(10,3) DEFAULT NULL,
  `cp5` decimal(10,3) DEFAULT NULL,
  `cp6` decimal(10,3) DEFAULT NULL,
  `cp7` decimal(10,3) DEFAULT NULL,
  `cp9` decimal(10,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_unit`
--

CREATE TABLE `inventory_unit` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `bl5_unit` varchar(10) DEFAULT NULL,
  `bl6_unit` varchar(10) DEFAULT NULL,
  `bl7_unit` varchar(10) DEFAULT NULL,
  `bl9_unit` varchar(10) DEFAULT NULL,
  `sp5_unit` varchar(10) DEFAULT NULL,
  `sp6_unit` varchar(10) DEFAULT NULL,
  `sp7_unit` varchar(10) DEFAULT NULL,
  `sp9_unit` varchar(10) DEFAULT NULL,
  `wl5_unit` varchar(10) DEFAULT NULL,
  `wl6_unit` varchar(10) DEFAULT NULL,
  `wl7_unit` varchar(10) DEFAULT NULL,
  `wl9_unit` varchar(10) DEFAULT NULL,
  `ld8_unit` varchar(10) DEFAULT NULL,
  `ld9_unit` varchar(10) DEFAULT NULL,
  `ld11_unit` varchar(10) DEFAULT NULL,
  `dld_unit` varchar(10) DEFAULT NULL,
  `pp_unit` varchar(10) DEFAULT NULL,
  `cups50_unit` varchar(10) DEFAULT NULL,
  `cups60_unit` varchar(10) DEFAULT NULL,
  `cups80_unit` varchar(10) DEFAULT NULL,
  `cups100_unit` varchar(10) DEFAULT NULL,
  `cups150_unit` varchar(10) DEFAULT NULL,
  `cups210_unit` varchar(10) DEFAULT NULL,
  `cups250_unit` varchar(10) DEFAULT NULL,
  `bd5_unit` varchar(10) DEFAULT NULL,
  `bd6_unit` varchar(10) DEFAULT NULL,
  `bd7_unit` varchar(10) DEFAULT NULL,
  `cp5_unit` varchar(10) DEFAULT NULL,
  `cp6_unit` varchar(10) DEFAULT NULL,
  `cp7_unit` varchar(10) DEFAULT NULL,
  `cp9_unit` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `moreinventory_item`
--

CREATE TABLE `moreinventory_item` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `py6` decimal(10,2) DEFAULT NULL,
  `py8` decimal(10,2) DEFAULT NULL,
  `py9` decimal(10,2) DEFAULT NULL,
  `py11` decimal(10,2) DEFAULT NULL,
  `3x4yzl` decimal(10,2) DEFAULT NULL,
  `4x5yzl` decimal(10,2) DEFAULT NULL,
  `3x4wzl` decimal(10,2) DEFAULT NULL,
  `4x5wzl` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `moreinventory_unit`
--

CREATE TABLE `moreinventory_unit` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `payal6_unit` varchar(255) DEFAULT NULL,
  `payal8_unit` varchar(255) DEFAULT NULL,
  `payal9_unit` varchar(255) DEFAULT NULL,
  `payal11_unit` varchar(255) DEFAULT NULL,
  `3x4yzl_unit` varchar(255) DEFAULT NULL,
  `4x5yzl_unit` varchar(255) DEFAULT NULL,
  `3x4wzl_unit` varchar(255) DEFAULT NULL,
  `4x5wzl_unit` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `moresales_item`
--

CREATE TABLE `moresales_item` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `py6` decimal(10,2) DEFAULT NULL,
  `py8` decimal(10,2) DEFAULT NULL,
  `py9` decimal(10,2) DEFAULT NULL,
  `py11` decimal(10,2) DEFAULT NULL,
  `3x4yzl` decimal(10,2) DEFAULT NULL,
  `4x5yzl` decimal(10,2) DEFAULT NULL,
  `3x4wzl` decimal(10,2) DEFAULT NULL,
  `4x5wzl` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `moresales_unit`
--

CREATE TABLE `moresales_unit` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `payal6_unit` varchar(255) DEFAULT NULL,
  `payal8_unit` varchar(255) DEFAULT NULL,
  `payal9_unit` varchar(255) DEFAULT NULL,
  `payal11_unit` varchar(255) DEFAULT NULL,
  `3x4yzl_unit` varchar(255) DEFAULT NULL,
  `4x5yzl_unit` varchar(255) DEFAULT NULL,
  `3x4wzl_unit` varchar(255) DEFAULT NULL,
  `4x5wzl_unit` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `query`
--

CREATE TABLE `query` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `query_text` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_item`
--

CREATE TABLE `sales_item` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `bl5` decimal(10,3) DEFAULT NULL,
  `bl6` decimal(10,3) DEFAULT NULL,
  `bl7` decimal(10,3) DEFAULT NULL,
  `bl9` decimal(10,3) DEFAULT NULL,
  `sp5` decimal(10,3) DEFAULT NULL,
  `sp6` decimal(10,3) DEFAULT NULL,
  `sp7` decimal(10,3) DEFAULT NULL,
  `sp9` decimal(10,3) DEFAULT NULL,
  `wl5` decimal(10,3) DEFAULT NULL,
  `wl6` decimal(10,3) DEFAULT NULL,
  `wl7` decimal(10,3) DEFAULT NULL,
  `wl9` decimal(10,3) DEFAULT NULL,
  `ld8` decimal(10,3) DEFAULT NULL,
  `ld9` decimal(10,3) DEFAULT NULL,
  `ld11` decimal(10,3) DEFAULT NULL,
  `dld` decimal(10,3) DEFAULT NULL,
  `pp` decimal(10,3) DEFAULT NULL,
  `cups50` decimal(10,3) DEFAULT NULL,
  `cups60` decimal(10,3) DEFAULT NULL,
  `cups80` decimal(10,3) DEFAULT NULL,
  `cups100` decimal(10,3) DEFAULT NULL,
  `cups150` decimal(10,3) DEFAULT NULL,
  `cups210` decimal(10,3) DEFAULT NULL,
  `cups250` decimal(10,3) DEFAULT NULL,
  `bd5` decimal(10,3) DEFAULT NULL,
  `bd6` decimal(10,3) DEFAULT NULL,
  `bd7` decimal(10,3) DEFAULT NULL,
  `cp5` decimal(10,3) DEFAULT NULL,
  `cp6` decimal(10,3) DEFAULT NULL,
  `cp7` decimal(10,3) DEFAULT NULL,
  `cp9` decimal(10,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_unit`
--

CREATE TABLE `sales_unit` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `bl5_unit` varchar(10) DEFAULT NULL,
  `bl6_unit` varchar(10) DEFAULT NULL,
  `bl7_unit` varchar(10) DEFAULT NULL,
  `bl9_unit` varchar(10) DEFAULT NULL,
  `sp5_unit` varchar(10) DEFAULT NULL,
  `sp6_unit` varchar(10) DEFAULT NULL,
  `sp7_unit` varchar(10) DEFAULT NULL,
  `sp9_unit` varchar(10) DEFAULT NULL,
  `wl5_unit` varchar(10) DEFAULT NULL,
  `wl6_unit` varchar(10) DEFAULT NULL,
  `wl7_unit` varchar(10) DEFAULT NULL,
  `wl9_unit` varchar(10) DEFAULT NULL,
  `ld8_unit` varchar(10) DEFAULT NULL,
  `ld9_unit` varchar(10) DEFAULT NULL,
  `ld11_unit` varchar(10) DEFAULT NULL,
  `dld_unit` varchar(10) DEFAULT NULL,
  `pp_unit` varchar(10) DEFAULT NULL,
  `cups50_unit` varchar(10) DEFAULT NULL,
  `cups60_unit` varchar(10) DEFAULT NULL,
  `cups80_unit` varchar(10) DEFAULT NULL,
  `cups100_unit` varchar(10) DEFAULT NULL,
  `cups150_unit` varchar(10) DEFAULT NULL,
  `cups210_unit` varchar(10) DEFAULT NULL,
  `cups250_unit` varchar(10) DEFAULT NULL,
  `bd5_unit` varchar(10) DEFAULT NULL,
  `bd6_unit` varchar(10) DEFAULT NULL,
  `bd7_unit` varchar(10) DEFAULT NULL,
  `cp5_unit` varchar(10) DEFAULT NULL,
  `cp6_unit` varchar(10) DEFAULT NULL,
  `cp7_unit` varchar(10) DEFAULT NULL,
  `cp9_unit` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `updates`
--

CREATE TABLE `updates` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `update_text` text NOT NULL,
  `readtext` tinyint(4) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `showupdates` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `verification_status` int(11) DEFAULT 0,
  `tokenn` varchar(255) DEFAULT NULL,
  `role` text NOT NULL,
  `access` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory_item`
--
ALTER TABLE `inventory_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_unit`
--
ALTER TABLE `inventory_unit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `moreinventory_item`
--
ALTER TABLE `moreinventory_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moreinventory_unit`
--
ALTER TABLE `moreinventory_unit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `moresales_item`
--
ALTER TABLE `moresales_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moresales_unit`
--
ALTER TABLE `moresales_unit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `query`
--
ALTER TABLE `query`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sales_item`
--
ALTER TABLE `sales_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_unit`
--
ALTER TABLE `sales_unit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `updates`
--
ALTER TABLE `updates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory_item`
--
ALTER TABLE `inventory_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_unit`
--
ALTER TABLE `inventory_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `moreinventory_item`
--
ALTER TABLE `moreinventory_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `moreinventory_unit`
--
ALTER TABLE `moreinventory_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `moresales_item`
--
ALTER TABLE `moresales_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `moresales_unit`
--
ALTER TABLE `moresales_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `query`
--
ALTER TABLE `query`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_item`
--
ALTER TABLE `sales_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_unit`
--
ALTER TABLE `sales_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `updates`
--
ALTER TABLE `updates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory_unit`
--
ALTER TABLE `inventory_unit`
  ADD CONSTRAINT `inventory_unit_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `inventory_item` (`id`);

--
-- Constraints for table `moreinventory_unit`
--
ALTER TABLE `moreinventory_unit`
  ADD CONSTRAINT `moreinventory_unit_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `moreinventory_item` (`id`);

--
-- Constraints for table `moresales_unit`
--
ALTER TABLE `moresales_unit`
  ADD CONSTRAINT `moresales_unit_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `moresales_item` (`id`);

--
-- Constraints for table `query`
--
ALTER TABLE `query`
  ADD CONSTRAINT `query_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales_unit`
--
ALTER TABLE `sales_unit`
  ADD CONSTRAINT `sales_unit_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `sales_item` (`id`);

--
-- Constraints for table `updates`
--
ALTER TABLE `updates`
  ADD CONSTRAINT `updates_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
