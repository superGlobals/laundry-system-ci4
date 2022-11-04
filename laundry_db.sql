-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2022 at 12:50 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activity_log`
--

CREATE TABLE `tbl_activity_log` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `action` varchar(255) NOT NULL,
  `activity_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_activity_log`
--

INSERT INTO `tbl_activity_log` (`id`, `name`, `action`, `activity_date`) VALUES
(1, 'Squidward', 'Add New Laundry Service', '2022-11-03 20:46:27'),
(2, 'Squidward', 'Add New Laundry Service', '2022-11-03 20:54:47'),
(3, 'Squidward', 'Add New Laundry Service', '2022-11-03 21:06:07'),
(4, 'Squidward', 'Add New Laundry Service', '2022-11-03 21:40:59'),
(5, 'Squidward', 'Add New Laundry Service', '2022-11-03 21:41:32'),
(6, 'Squidward', 'Add New Laundry Service', '2022-11-03 21:56:53'),
(7, 'Squidward', 'Add New Laundry Service', '2022-11-03 22:24:11'),
(8, 'Squidward', 'Add New Laundry Service', '2022-11-04 07:56:56'),
(9, 'Squidward', 'Add New Laundry Service', '2022-11-04 07:57:32'),
(10, 'Squidward', 'Add New Laundry Service', '2022-11-04 08:10:06'),
(11, 'Squidward', 'Add New Laundry Service', '2022-11-04 08:27:36'),
(12, 'Squidward', 'Add New Laundry Service', '2022-11-04 08:32:47');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customers`
--

CREATE TABLE `tbl_customers` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customers`
--

INSERT INTO `tbl_customers` (`id`, `customer_id`, `firstname`, `middlename`, `lastname`, `gender`, `email`, `password`, `contact`, `address`, `profile`, `date_added`) VALUES
(4, 'CID-DFCC1', 'qwe', 'w', 'qwe', 'male', 'qwe@email.com', '$2y$10$dN.R.OTjW0vbaBZupDk7Ne2t6aWY8oCz63bICPUE4oQZ7NQAAkl/O', 1232, 'qwe', 'user_male.jpg', '2022-11-04 19:08:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_laundry_service`
--

CREATE TABLE `tbl_laundry_service` (
  `id` int(11) NOT NULL,
  `laundry_service_name` varchar(100) NOT NULL,
  `laundry_service_price` float NOT NULL,
  `laundry_service_status` varchar(30) NOT NULL,
  `laundry_service_image` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_laundry_service`
--

INSERT INTO `tbl_laundry_service` (`id`, `laundry_service_name`, `laundry_service_price`, `laundry_service_status`, `laundry_service_image`, `date_added`) VALUES
(10, 'wash, dry and fold', 101, 'available', '1667520606_3ab583804b4c11986128.png', '2022-11-04 08:10:06'),
(11, 'qe', 2, 'not_available', 'no_image.jpg', '2022-11-04 08:27:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supply`
--

CREATE TABLE `tbl_supply` (
  `id` int(11) NOT NULL,
  `supply_id` varchar(50) NOT NULL,
  `supply_name` varchar(100) NOT NULL,
  `supply_qty` int(11) NOT NULL,
  `supply_image` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_supply`
--

INSERT INTO `tbl_supply` (`id`, `supply_id`, `supply_name`, `supply_qty`, `supply_image`, `date_added`) VALUES
(4, 'SID-344EE', 'qwe', 22, '1667475025_413d985a352111f38069.jpeg', '2022-11-03 19:30:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

CREATE TABLE `tbl_transaction` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `laundry_service_id` int(11) NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  `transaction_payment_type` varchar(100) NOT NULL,
  `customer_total_bill` float NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`id`, `transaction_id`, `laundry_service_id`, `customer_id`, `transaction_payment_type`, `customer_total_bill`, `date_added`) VALUES
(0, 'TID-97C6DDF', 10, 'qwe', 'cash', 0, '2022-11-04 11:29:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `contact` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `position` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `user_id`, `firstname`, `middlename`, `lastname`, `contact`, `address`, `position`, `email`, `password`, `profile`, `date_added`) VALUES
(6, 'UID-F36BE', 'squidward', 'a', 'tentacles', 123, 'bikini bottom', 'admin', 'squidward@email.com', '$2y$10$O20cMI.LQPJEnsH9c8w6W.t7Q834YpqzymzIUUVwrS/fEX6iXBv3G', 'user_male.jpg', '2022-11-03 14:03:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_activity_log`
--
ALTER TABLE `tbl_activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`,`activity_date`);

--
-- Indexes for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`,`firstname`,`middlename`,`lastname`),
  ADD KEY `email` (`email`,`contact`,`address`,`date_added`),
  ADD KEY `gender` (`gender`);

--
-- Indexes for table `tbl_laundry_service`
--
ALTER TABLE `tbl_laundry_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laundry_service_name` (`laundry_service_name`,`laundry_service_price`,`laundry_service_status`,`date_added`);

--
-- Indexes for table `tbl_supply`
--
ALTER TABLE `tbl_supply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supply_id` (`supply_id`,`supply_name`,`date_added`);

--
-- Indexes for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  ADD KEY `transaction_id` (`transaction_id`,`laundry_service_id`,`customer_id`,`transaction_payment_type`,`date_added`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `firstname` (`firstname`,`middlename`,`lastname`),
  ADD KEY `position` (`position`,`email`,`date_added`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_activity_log`
--
ALTER TABLE `tbl_activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_laundry_service`
--
ALTER TABLE `tbl_laundry_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_supply`
--
ALTER TABLE `tbl_supply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
