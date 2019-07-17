-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2019 at 10:21 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skyhint`
--

-- --------------------------------------------------------

--
-- Table structure for table `acc_category`
--

CREATE TABLE `acc_category` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `main_cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acc_category`
--

INSERT INTO `acc_category` (`id`, `cat_name`, `main_cat`) VALUES
(1, 'Fixed Assets', 1),
(2, 'Current Assets', 1),
(3, 'Long Term Liability', 2),
(4, 'Current Liability', 2),
(5, 'Expenses', 3),
(6, 'Revenue', 3);

-- --------------------------------------------------------

--
-- Table structure for table `acc_expense`
--

CREATE TABLE `acc_expense` (
  `id` int(11) NOT NULL,
  `exp_date` date NOT NULL,
  `tran_id` int(11) NOT NULL,
  `tran_payment` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `staff_contact` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `acc_main_cat`
--

CREATE TABLE `acc_main_cat` (
  `id` int(11) NOT NULL,
  `main_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acc_main_cat`
--

INSERT INTO `acc_main_cat` (`id`, `main_name`) VALUES
(1, 'Assets'),
(2, 'Liability'),
(3, 'Equity');

-- --------------------------------------------------------

--
-- Table structure for table `acc_name`
--

CREATE TABLE `acc_name` (
  `id` int(11) NOT NULL,
  `acc_name` varchar(100) NOT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acc_name`
--

INSERT INTO `acc_name` (`id`, `acc_name`, `category`) VALUES
(1, 'Others', 5),
(2, 'Utilities', 5),
(3, 'Stationery & Books', 5),
(4, 'Meals & Entertainment', 5),
(5, 'Postage', 5),
(6, 'Accomodation', 5),
(7, 'Advertising & Marketing', 5),
(8, 'Salaries', 5),
(9, 'Toll & Parking', 5),
(10, 'Mileage & Transport', 5),
(11, 'Rent', 5),
(12, 'Maintenance', 5),
(13, 'Allowance', 5),
(14, 'Cash', 2),
(15, 'Maybank', 2),
(16, 'CIMB', 2),
(17, 'Client Fees', 6),
(18, 'Client Debtors', 2),
(19, 'KWSP', 5),
(20, 'PERKESO', 5),
(21, 'Payables / Accruals', 4);

-- --------------------------------------------------------

--
-- Table structure for table `acc_transaction`
--

CREATE TABLE `acc_transaction` (
  `id` int(11) NOT NULL,
  `tran_date` date NOT NULL,
  `debit` int(11) NOT NULL,
  `credit` int(11) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `medium` tinyint(2) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `assoc_staff` int(11) NOT NULL,
  `assoc_client` int(11) NOT NULL,
  `assoc_tran` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `trash` tinyint(1) NOT NULL,
  `trashed_by` int(11) NOT NULL,
  `trashed_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `summary` text NOT NULL,
  `invoice_date` date NOT NULL,
  `due_date` date NOT NULL,
  `client_id` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `discount` decimal(11,2) NOT NULL,
  `gst` decimal(11,2) NOT NULL,
  `note` text NOT NULL,
  `invoice_pic` int(11) NOT NULL,
  `quotation_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `trash` tinyint(1) NOT NULL,
  `token` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `summary`, `invoice_date`, `due_date`, `client_id`, `status`, `discount`, `gst`, `note`, `invoice_pic`, `quotation_id`, `created_by`, `created_at`, `updated_at`, `trash`, `token`) VALUES
(100, 'Invoice to ISME', '2019-01-01', '0000-00-00', 1, 1, '0.00', '0.00', '', 0, 0, 47, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, ''),
(101, '', '2019-03-25', '0000-00-00', 2, 1, '0.00', '0.00', 'Payment can be made payable to Skyhint Design Enterprise (Bank Islam 03018010168780) \nIf you have any inquiry, please contact us at 018 900 3080', 0, 0, 47, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '8e167bb541b7c58e66b3');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_item`
--

CREATE TABLE `invoice_item` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_cat` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `quantity` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_item`
--

INSERT INTO `invoice_item` (`id`, `invoice_id`, `product_cat`, `product_id`, `description`, `price`, `quantity`) VALUES
(1, 101, 15, 7, 'Bayaran untuk kerja-kerja perkhidmatan pembangunan laman sesawang persidangan NUCC 2019\nTermasuk (inclusive):\n- tapak (server) laman\n- maintenance & update sehingga selesai persidangan', '500.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_note`
--

CREATE TABLE `invoice_note` (
  `id` int(11) NOT NULL,
  `note_name` varchar(200) NOT NULL,
  `note_text` text NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `trash` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_note`
--

INSERT INTO `invoice_note` (`id`, `note_name`, `note_text`, `created_at`, `created_by`, `updated_at`, `trash`) VALUES
(1, 'Basic Note', '1. Installation process after 70% deposit paid by customer\r\n2. Payment can be made payable to FIQEL HOME DECO SDN BHD (CIMB 8009204170)\r\n3. Balance of payment need to do on the same day or within 2 days after installation\r\n4. If you have any inquiry, please contact us at:\r\n012 990 2262 (FIQEL HOME DECO)', '2018-07-13 07:43:58', 31, '2018-07-18 18:43:23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_cat` int(11) NOT NULL,
  `product_code` varchar(200) NOT NULL,
  `unit_measure` varchar(100) NOT NULL,
  `price_perunit` decimal(11,2) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `trash` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `product_cat`, `product_code`, `unit_measure`, `price_perunit`, `status`, `created_at`, `updated_at`, `created_by`, `trash`) VALUES
(7, 'Website Page', 1, '', '', '500.00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(200) NOT NULL,
  `unit_measure` varchar(100) NOT NULL,
  `price_perunit` decimal(11,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=active, 0= not active',
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `trash` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `category_name`, `unit_measure`, `price_perunit`, `status`, `created_by`, `created_at`, `updated_at`, `trash`) VALUES
(15, 'Website Design', 'srvs', '500.00', 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acc_category`
--
ALTER TABLE `acc_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acc_expense`
--
ALTER TABLE `acc_expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acc_main_cat`
--
ALTER TABLE `acc_main_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acc_name`
--
ALTER TABLE `acc_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acc_transaction`
--
ALTER TABLE `acc_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_item`
--
ALTER TABLE `invoice_item`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_cat` (`product_cat`),
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `invoice_note`
--
ALTER TABLE `invoice_note`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acc_category`
--
ALTER TABLE `acc_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `acc_expense`
--
ALTER TABLE `acc_expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `acc_main_cat`
--
ALTER TABLE `acc_main_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `acc_name`
--
ALTER TABLE `acc_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `acc_transaction`
--
ALTER TABLE `acc_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT for table `invoice_item`
--
ALTER TABLE `invoice_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `invoice_note`
--
ALTER TABLE `invoice_note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice_item`
--
ALTER TABLE `invoice_item`
  ADD CONSTRAINT `invoice_item_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`),
  ADD CONSTRAINT `invoice_item_ibfk_2` FOREIGN KEY (`product_cat`) REFERENCES `product_category` (`id`),
  ADD CONSTRAINT `invoice_item_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
