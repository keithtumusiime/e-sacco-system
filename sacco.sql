-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2018 at 08:42 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sacco`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `customerID` varchar(100) NOT NULL,
  `accountName` varchar(100) NOT NULL,
  `accountNumber` int(80) NOT NULL,
  `openingDate` datetime NOT NULL,
  `accountBalance` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` varchar(50) NOT NULL,
  `full_names` varchar(80) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `join_date` datetime NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL,
  `activation_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

CREATE TABLE `interests` (
  `id` int(255) NOT NULL,
  `earn_date` datetime NOT NULL,
  `amount` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `id` int(11) NOT NULL,
  `customerid` varchar(100) NOT NULL,
  `amount` int(50) NOT NULL,
  `guarantor1` mediumtext NOT NULL,
  `action1` varchar(100) NOT NULL,
  `guarantor2` varchar(100) NOT NULL,
  `action2` varchar(100) NOT NULL,
  `rate` int(100) NOT NULL,
  `period` int(100) NOT NULL,
  `reason` mediumtext NOT NULL,
  `adminAction` varchar(100) NOT NULL,
  `balance` int(100) NOT NULL,
  `interest` int(255) NOT NULL,
  `loan_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loans_interests`
--

CREATE TABLE `loans_interests` (
  `id` int(255) NOT NULL,
  `date` datetime NOT NULL,
  `customerID` varchar(255) NOT NULL,
  `account_number` int(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `interest` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loan_clearing`
--

CREATE TABLE `loan_clearing` (
  `id` int(100) NOT NULL,
  `loan_customerID` varchar(100) NOT NULL,
  `loan_date` datetime NOT NULL,
  `opening_balance` int(100) NOT NULL,
  `amount_borrowed` int(100) NOT NULL,
  `interest` int(100) NOT NULL,
  `total` int(100) NOT NULL,
  `paid` int(100) NOT NULL,
  `balance` int(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `admin_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(200) NOT NULL,
  `customerID` varchar(80) NOT NULL,
  `username` varchar(80) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(255) NOT NULL,
  `from` varchar(255) NOT NULL,
  `to` varchar(255) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(100) NOT NULL,
  `customerID` varchar(20) NOT NULL,
  `accountNumber` int(100) NOT NULL,
  `transactionDate` datetime NOT NULL,
  `transactionAmount` double NOT NULL,
  `transaction_type` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `approval_date` datetime NOT NULL,
  `balance` int(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `interests`
--
ALTER TABLE `interests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans_interests`
--
ALTER TABLE `loans_interests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_clearing`
--
ALTER TABLE `loan_clearing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `interests`
--
ALTER TABLE `interests`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loans_interests`
--
ALTER TABLE `loans_interests`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_clearing`
--
ALTER TABLE `loan_clearing`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
