-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 30, 2021 at 09:38 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `globetask`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_name` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `dob` varchar(11) NOT NULL,
  `doj` varchar(11) NOT NULL,
  `blood_group` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `address` text NOT NULL,
  `id_proof` varchar(100) DEFAULT NULL,
  `proofimg` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `updated` datetime DEFAULT NULL,
  `insert_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_name`, `designation`, `dob`, `doj`, `blood_group`, `email`, `phone`, `address`, `id_proof`, `proofimg`, `status`, `updated`, `insert_date`) VALUES
(1, 'sateesh', 'php developer', '11-12-1996', '02-02-2019', 'b+ve', 'sateesh@gmail.com', '7410258963', 'palasa srikakulam ap', NULL, '1640794727.jpeg', 1, NULL, '2021-12-28 23:33:10'),
(2, 'ajay', 'engineer', '21-08-1992', '05-03-2017', 'a+ve', 'ajay@gmail.com', '7410258963', 'patancheru hyderabad', NULL, '1640794727.jpeg', 1, NULL, '2021-12-29 19:23:32'),
(3, 'sateesh', 'software engineer', '2021-12-30', '2021-12-31', 'b+ve', 'sat@gmail.com', '7410258963', 'hyderabad', '1', '1640794727.jpeg', 1, NULL, '2021-12-29 21:48:47'),
(4, 'ravi', 'team lead', '2003-06-11', '2021-12-29', 'aVe-', 'ravi@gmail.com', '7410258963', 'srikakulam ap', '2', '1640794867.jpeg', 1, NULL, '2021-12-29 21:51:07'),
(5, 'prabhakar', 'data analyst', '1995-12-31', '2019-05-11', 'o+Ve', 'prabhakar@gmail.com', '7896541230', 'kphb colony 3rd phase', '3', '1640794960.jpeg', 1, NULL, '2021-12-29 21:52:40'),
(6, 'rajesh', 'programmer', '1997-12-16', '2020-12-11', 'o-ve', 'rajesh@gmail.com', '9630258741', 'vizianagaram andhra pradesh', '1', '1640795017.jpeg', 1, NULL, '2021-12-29 21:53:37'),
(7, 'ramesh', 'mentor', '2002-02-25', '2019-02-20', 'ab+ve', 'ramesh@gmail.com', '8520147963', 'bobbili vizianagaram andhra pradesh', '2', '1640795079.jpeg', 1, NULL, '2021-12-29 21:54:39'),
(8, 'jeevan', 'software tester', '1996-08-15', '2017-08-20', 'o+ve', 'jeevan@gmail.com', '9874563210', 'viziangaram kottavalasa ap', '3', '1640795133.jpeg', 1, NULL, '2021-12-29 21:55:33'),
(9, 'ashok', 'software engineer', '1995-05-15', '2017-01-02', 'ab-ve', 'ashok@gmail.com', '6541230987', 'icchapur andhra pradesh', '1', '1640795182.jpeg', 0, '2021-12-30 13:47:54', '2021-12-29 21:56:22'),
(10, 'vignesh', 'store keeper', '1995-11-14', '2018-07-15', 'a-ve', 'vignesg@gmail.com', '8412697130', 'amudalavalasa srikakulam ap', '2', '1640795267.jpeg', 1, NULL, '2021-12-29 21:57:47'),
(11, 'revathi', 'hr', '1997-03-23', '2020-04-05', 'a+ve', 'revathi@gmail.com', '9601235874', 'pathatekkali vishkapatnam', '3', '1640795337.jpeg', 1, NULL, '2021-12-29 21:58:57'),
(12, 'uma', 'hr department md', '1995-01-02', '2019-05-07', 'o-ve', 'uma@gmail.com', '7456981230', 'proddutur kapada', '1', '1640795404.jpeg', 1, NULL, '2021-12-29 22:00:04'),
(13, 'sundar', 'angular developer', '1995-08-21', '2015-05-02', 'ab+ve', 'sundar@gmail.com', '9652874103', 'kakinda west godavari ap', '3', '1640795469.jpeg', 1, NULL, '2021-12-29 22:01:09'),
(14, 'hemanth', 'php developer', '1995-07-15', '2017-03-06', 'b-ve', 'hemanth@gmail.com', '9874563210', 'rajam rajastan', '2', '1640795521.jpeg', 1, NULL, '2021-12-29 22:02:01'),
(15, 'parvathi', 'software analyst', '2000-04-04', '2020-02-05', 'b+ve', 'parvathi@gmail.com', '7896541320', 'pendurthi andhra pradesh', '3', '1640795597.jpeg', 1, '2021-12-30 00:00:33', '2021-12-29 22:03:17'),
(16, 'subbalaxmi', 'programmer', '1994-09-01', '2019-06-07', 'b+ve', 'subbalaxmi@gmail.com', '6541230987', 'pondur srikakulam ap', '1', '1640795658.jpeg', 1, NULL, '2021-12-29 22:04:18'),
(17, 'rakesh', 'planner', '1995-05-25', '2018-01-05', 'a-ve', 'rakesh@gmail.com', '9630258741', 'vizianagaram andhra pradesh', '2', '1640795709.jpeg', 1, '2021-12-30 13:56:45', '2021-12-29 22:05:09'),
(18, 'chetana', 'java developer', '1997-12-08', '2019-02-05', 'ab-ve', 'chetana@gmail.com', '7458963210', 'delhi india', '1', '1640795782.jpeg', 1, NULL, '2021-12-29 22:06:22'),
(19, 'rajulu', 'nodejs developer', '1997-05-15', '2019-04-01', 'b+ve', 'rajulu@gmail.com', '9561023784', 'pune india', '2', '1640795841.jpeg', 1, '2021-12-30 13:51:48', '2021-12-29 22:07:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` int(11) NOT NULL COMMENT '1=>super admin,2=>admin,3=>user',
  `name` varchar(100) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `address` varchar(200) NOT NULL,
  `gender` int(11) NOT NULL COMMENT '1=>male,2=>female,3=>others',
  `date_of_birth` date NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile_picture` varchar(64) DEFAULT NULL,
  `signature` varchar(64) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `updated` datetime DEFAULT NULL,
  `insert_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `mobile`, `email`, `address`, `gender`, `date_of_birth`, `password`, `profile_picture`, `signature`, `status`, `updated`, `insert_date`) VALUES
(1, 1, 'Super Admin', '9999999999', 'superadmin@gmail.com', 'palasa srikakulam andhra pradesh', 1, '2021-12-01', 'a01610228fe998f515a72dd730294d87', '1640797559.jpeg', '1640797559.png', 1, '2021-12-30 10:21:37', '2021-12-28 12:50:30'),
(2, 2, 'Admin', '8888888888', 'admin@gmail.com', 'kphb hyderabad telangna', 2, '2021-12-02', 'a01610228fe998f515a72dd730294d87', '1640852169432.png', '1640852169.jpeg', 1, '2021-12-30 13:46:21', '2021-12-28 12:50:30'),
(3, 3, 'sateesh', '7993609859', 'sangaru.satti@gmail.com', 'palasa srikakulam ', 1, '2000-08-21', 'a01610228fe998f515a72dd730294d87', '1640793666.png', '1640793665.png', 1, '2021-12-30 13:37:43', '2021-12-28 17:07:16'),
(4, 3, 'ndnd', '7993609859', 'sangaru.sateesh@gmail.com', 'rssrsrsrh', 1, '2021-12-16', '', NULL, NULL, 1, '2021-12-30 10:41:20', '2021-12-28 17:09:55'),
(5, 3, 'ravik', '7896541230', 'ravik@gmail.com', 'srikakulam andhra pradesh', 1, '1996-05-21', '', '1640839230625.png', '1640839230.jpeg', 1, '2021-12-30 10:21:49', '2021-12-29 23:30:31'),
(6, 3, 'sample@gmail.com', '7896541230', 'sample@gmail.com', 'dilsuknagar hyderabad', 2, '1994-12-02', '', NULL, NULL, 1, '2021-12-30 10:43:29', '2021-12-30 10:42:20'),
(7, 3, 'test', '9874563210', 'test@gmail.com', 'thane mumbai maharastra', 1, '1993-08-15', '', NULL, NULL, 1, '2021-12-30 10:43:25', '2021-12-30 10:43:14'),
(8, 3, 'madhu', '9630852147', 'madhu@gmail.com', 'kota rajastan', 2, '1997-05-21', '', NULL, NULL, 1, '2021-12-30 10:46:25', '2021-12-30 10:44:20'),
(9, 3, 'satya', '6985231470', 'satya@gmail.com', 'kolkata west bengal', 2, '1998-05-04', '', NULL, NULL, 1, '2021-12-30 10:46:23', '2021-12-30 10:45:15'),
(10, 3, 'satyachin', '7539142806', 'satyachin@gmail.com', 'vishakapatnam andhra pradesh', 1, '1995-12-05', '', NULL, NULL, 1, '2021-12-30 10:46:20', '2021-12-30 10:46:10'),
(11, 3, 'samba', '9876543210', 'samba@gmail.com', 'leh j&k india', 1, '1998-12-05', '', NULL, NULL, 1, '2021-12-30 10:48:19', '2021-12-30 10:47:19'),
(12, 3, 'yogi', '7893210456', 'yogi@gmail.com', 'vizianagaram andhra pradesh', 2, '1997-02-14', '', NULL, NULL, 1, '2021-12-30 10:48:17', '2021-12-30 10:48:08'),
(13, 3, 'rajulu', '7410258963', 'rajulu@gmail.com', 'palasa srikakulam ap', 2, '1995-09-15', '', '1640841736951.png', '1640841736.png', 1, '2021-12-30 13:43:41', '2021-12-30 10:52:16'),
(14, 3, 'sem', '9841702635', 'sem@gmail.com', 'kphb hyderabad', 1, '2000-05-15', '', NULL, NULL, 0, NULL, '2021-12-30 13:31:04'),
(15, 3, 'sem', '9841702635', 'sem1@gmail.com', 'kphb hyderabad', 1, '2000-05-15', '', NULL, NULL, 1, '2021-12-30 13:44:52', '2021-12-30 13:31:21'),
(16, 3, 'sem', '9841702635', 'sem12@gmail.com', 'kphb hyderabad', 1, '2000-05-15', '', NULL, NULL, 1, '2021-12-30 13:44:50', '2021-12-30 13:34:27'),
(18, 3, 'sem', '9841702635', 'sem1234@gmail.com', 'kphb hyderabad', 1, '2000-05-15', '', NULL, NULL, 1, '2021-12-30 13:52:17', '2021-12-30 13:36:46'),
(19, 3, 'testing', '789654132', 'testing@gmail.com', 'testing softwares', 2, '2000-05-15', '', '1640852075818.jpeg', '1640852075.png', 0, '2021-12-30 13:45:03', '2021-12-30 13:44:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
