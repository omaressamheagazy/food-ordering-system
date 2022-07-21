-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2022 at 04:05 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_rest`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adm_id` int(222) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `username` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adm_id`, `FullName`, `username`, `password`, `email`, `date`) VALUES
(17, 'omar essam', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'omaressamhegazy6@gmail.com', '2022-06-30 15:11:26'),
(18, 'mohammed amr', 'meko', '81dc9bdb52d04dc20036dbd8313ed055', 'mohamedamr@gmail.com', '2022-07-03 20:45:25');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `image`) VALUES
(57, 'Desserts', '62ba4152bf354.jpg'),
(58, 'Nasi', '62ba41dae619c.jpg'),
(61, 'Drinks', '62c200161b783.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `dishes`
--

CREATE TABLE `dishes` (
  `d_id` int(222) NOT NULL,
  `cat_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `favourite` varchar(3) NOT NULL DEFAULT 'no',
  `slogan` varchar(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dishes`
--

INSERT INTO `dishes` (`d_id`, `cat_id`, `title`, `favourite`, `slogan`, `price`, `img`) VALUES
(14, 0, 'Nasi kerbua with ayam', '0', 'Nasi', '12.00', '62b56d592e2f2.png'),
(22, 58, 'Nasi kerbua with ayam', '0', 'Nasi kerbua with ayam', '15.00', '62bb1d7c64ebb.jpg'),
(31, 56, 'Waffel', 'yes', 'cheese cake waffle', '13.00', '62c1c6ec629d6.jpg'),
(34, 57, 'Nasi', 'no', 'Nasi', '15.00', '62c44ea607ae2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `remark`
--

CREATE TABLE `remark` (
  `id` int(11) NOT NULL,
  `frm_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remark` mediumtext NOT NULL,
  `remarkDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `remark`
--

INSERT INTO `remark` (`id`, `frm_id`, `status`, `remark`, `remarkDate`) VALUES
(62, 32, 'in process', 'hi', '2018-04-18 09:35:52'),
(63, 32, 'closed', 'cc', '2018-04-18 09:36:46'),
(64, 32, 'in process', 'fff', '2018-04-18 10:01:37'),
(65, 32, 'closed', 'its delv', '2018-04-18 10:08:55'),
(66, 34, 'in process', 'on a way', '2018-04-18 10:56:32'),
(67, 35, 'closed', 'ok', '2018-04-18 10:59:08'),
(68, 37, 'in process', 'on the way!', '2018-04-18 11:50:06'),
(69, 37, 'rejected', 'if admin cancel for any reason this box is for remark only for buter perposes', '2018-04-18 11:51:19'),
(70, 37, 'closed', 'delivered success', '2018-04-18 11:51:50'),
(71, 39, 'closed', 'due to bad', '2022-06-27 05:04:33'),
(72, 39, 'closed', 'sd', '2022-06-27 08:04:09'),
(73, 39, 'closed', 'sd', '2022-06-27 08:04:23'),
(74, 40, 'closed', 'hj', '2022-06-28 00:08:45'),
(75, 55, 'in process', 'your order has been accepeted', '2022-06-28 00:10:41'),
(76, 39, 'in process', 'sorry for delay', '2022-06-30 17:41:52'),
(77, 39, 'in process', 'thank', '2022-06-30 17:54:29'),
(78, 40, 'in process', 'gd', '2022-07-03 21:28:28'),
(79, 40, 'closed', 'Thank you for order from Nasi resturaunt', '2022-07-04 12:00:15'),
(80, 40, 'in process', 'wait for us', '2022-07-04 12:05:55'),
(81, 40, 'rejected', 'Sorry, your chosen item is out of stock', '2022-07-04 12:06:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(222) NOT NULL,
  `username` varchar(222) NOT NULL,
  `f_name` varchar(222) NOT NULL,
  `l_name` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `address` text NOT NULL,
  `status` int(222) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `username`, `f_name`, `l_name`, `email`, `phone`, `password`, `address`, `status`, `date`) VALUES
(32, 'fak7a', 'loui', 'Al-rahbi', 'nds949405@gmail.com', '6232125458', 'ffd35a715be41b0c3b97fa25acfd5b57', 'badri col phase 1', 1, '2022-06-30 13:05:39'),
(35, 'Omar', 'Omar', 'Essam', 'elprinceomaressam@gmail.com', '914924043223', 'e10adc3949ba59abbe56e057f20f883e', 'NO', 1, '2022-06-30 12:44:24'),
(36, 'loui_1', 'Omar', 'Essam', 'omaressamhegazy9@gmail.com', '9041240385', 'e10adc3949ba59abbe56e057f20f883e', 'ds', 1, '2022-07-04 10:04:38');

-- --------------------------------------------------------

--
-- Table structure for table `users_orders`
--

CREATE TABLE `users_orders` (
  `o_id` int(222) NOT NULL,
  `u_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `quantity` int(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(222) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_orders`
--

INSERT INTO `users_orders` (`o_id`, `u_id`, `title`, `quantity`, `price`, `status`, `date`) VALUES
(37, 31, 'jklmno', 5, '17.99', 'closed', '2018-04-18 15:51:50'),
(38, 31, 'Red Robins Chick on a Stick', 2, '34.99', NULL, '2018-04-18 15:52:34'),
(40, 35, 'Nasi kerbua with ayam', 1, '15.00', 'rejected', '2022-07-04 12:06:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adm_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `remark`
--
ALTER TABLE `remark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `users_orders`
--
ALTER TABLE `users_orders`
  ADD PRIMARY KEY (`o_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adm_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `dishes`
--
ALTER TABLE `dishes`
  MODIFY `d_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `remark`
--
ALTER TABLE `remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users_orders`
--
ALTER TABLE `users_orders`
  MODIFY `o_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
