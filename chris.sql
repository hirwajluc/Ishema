-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 02, 2017 at 03:51 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chris`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(25) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `account` varchar(15) NOT NULL,
  `created_at` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `address`, `phone`, `email`, `username`, `password`, `account`, `created_at`) VALUES
(3, 'Mukiza Alan', 'Nyarugenge', '', 'email@email.com', 'mukiza', '202cb962ac59075b964b07152d234b70', '230578814707836', '2016-12-31'),
(4, 'Mukama Roger', 'Gasabo', '', 'myemail@email.com', 'mukama', '202cb962ac59075b964b07152d234b70', '230491412205062', '2016-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `member` varchar(15) NOT NULL,
  `input` varchar(20) NOT NULL DEFAULT '0',
  `output` varchar(20) NOT NULL DEFAULT '0',
  `balance` varchar(20) NOT NULL,
  `reason` varchar(250) NOT NULL,
  `done_at` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `member`, `input`, `output`, `balance`, `reason`, `done_at`) VALUES
(4, '230578814707836', '4000', '0', '4000', 'Payment', '2016-12-31'),
(5, '230578814707836', '3000', '0', '7000', 'Payment', '2016-12-31'),
(6, '230491412205062', '5000', '0', '5000', 'Payment', '2016-12-31'),
(7, '230491412205062', '56000', '0', '61000', 'Payment', '2016-12-31'),
(8, '230491412205062', '0', '30000', '31000', 'Loan', '2016-12-31'),
(9, '230491412205062', '0', '40000', '-9000', 'Loan', '2016-12-31'),
(10, '230491412205062', '10000', '0', '1000', 'Payment', '2016-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `function` varchar(30) NOT NULL,
  `names` varchar(30) NOT NULL,
  `created_at` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `function`, `names`, `created_at`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 'admin', 'Chris', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`account`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
