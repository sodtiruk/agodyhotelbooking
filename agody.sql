-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2023 at 10:37 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agody_hotel`
--
CREATE DATABASE IF NOT EXISTS `agody_hotel` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `agody_hotel`;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` int(10) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `account_role` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `firstname`, `lastname`, `username`, `password`, `email`, `tel`, `account_role`, `create_at`) VALUES
(10, 'Sutthirak', 'Sutsaenya', 'lucky', '$2y$10$lMWg5oamzOjPZNOKDyb8ae0fnPsh1gMVeFqpHGSmgbm/fLdrDXsCu', 'sodtiruk22@gmail.com', '0983331399', 'admin', '2023-03-08 18:43:33'),
(11, 'Hee', 'rod', 'modem1112233', '$2y$10$vQYH6/Gy2pPVnJ65csBt8uhs24osxoJ05gI8VearOC.RGVqAW8the', 'modemvip45@gmail.com', '0111111111', 'user', '2023-03-08 20:14:00'),
(12, 'asdasd', 'sadasd', 'modem112233', '$2y$10$4Gjq9pMjBh39wH9NyGnI5uiKg0oeMQDyh52Jt82JRTkRGBSwkavri', 'modemvip45@gmail.com', '0222222222', 'user', '2023-03-08 20:17:08'),
(13, 'tao', 'taoo', 'tao', '$2y$10$fCCb9949aV999e7ULQPQN.zhgh3G1UYldPeg3cD0khMMK9SptS5wm', 'tao@gafakfas.com', '0123456789', 'user', '2023-03-09 00:34:26'),
(14, 'Shunagon', 'Iantrasuwin', 'Nug', '$2y$10$DLYpan7YX.hNAHv2SZS5bOlKyblhqaJtOOfYJ7AgSFSSHmlU0Af.e', 'sintrasuwan@gmail.com', '0912345678', 'user', '2023-03-09 00:35:07'),
(15, 'tao', 'tao', 'taoo', '$2y$10$ZQdGeqrBVbHWftjQISjvb.bqvzA2UpBkcC77KOyedrLkW.2s5sJFi', 'tao@gmail.coo', '0123456789', 'user', '2023-03-09 00:35:45'),
(16, 'tao', 'taooo', 'tao1', '$2y$10$DJu/q3LRJFlEkbUOMoNKJ.6U4KSk2yWOmkv3UcvcKf.wxvDPT/zhW', 'tao@gmail.com', '0123456789', 'user', '2023-03-09 00:41:25'),
(17, 'Sutthirak', 'Sutsaenya', 'test', '$2y$10$gRk.1vlVoO3zFmIBSyXlquxp5S6.U47qVY064VynOro0eUfbqhC7K', 'sodtiruk33@gmail.com', '0999999999', 'user', '2023-03-09 17:57:31'),
(18, 'till', 'techit', 'till', '$2y$10$SGu4gXJtLPi65G.BJstLT.rIjfMXKuV/AvYO7cdYBKXJSaq/2kEQq', 'yaha@yahe.com', '0925599444', 'user', '2023-03-10 14:06:50'),
(19, 'd', 'd', 'luckysi', '$2y$10$/gA.LaP/A23jGcpVhSGjN.pG2JTElx/4EA/VRTGSBs4gJxycBzGb6', 'duendy2008@gmail.com', '0941318893', 'user', '2023-03-11 00:08:40'),
(20, 'Nalin', 'Jinnangam', 'NilinLin', '$2y$10$kBTwBhFa.zpiS2qXx4M0zOq2gyTqOLM95tluG7cZDtW4NyuAf.6ZW', 'bealoliaom@gmail.com', '0642126212', 'user', '2023-03-13 14:33:31'),
(21, 'till', 'tete', 'techit1of1', '$2y$10$Wps43/Zz13EKiV4f0jbbI.zU53Kl9d/yiqdr2K4W47/rhKswJBozW', 'yaha@yahe.com', '0925599444', 'user', '2023-03-14 14:52:42');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `account_id` int(10) NOT NULL,
  `comment_info` text DEFAULT NULL,
  `ratting` int(1) NOT NULL,
  `comment_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `account_id`, `comment_info`, `ratting`, `comment_at`) VALUES
(2, 10, 'สุดยอดเจ๊งมากเลย', 4, '2023-03-15 15:12:49'),
(20, 18, 'เว็บจองง่ายสะดวกมากเลย ไม่เคยใช้เว็บไหนดีกว่านี้มาก่อน', 5, '2023-03-16 07:43:46'),
(21, 10, 'ไง', 5, '2023-03-16 15:11:41');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(10) NOT NULL,
  `roomid` int(3) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `roles` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `salary` double(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `roomid`, `firstname`, `lastname`, `roles`, `image`, `salary`) VALUES
(4, 1, 'asdsad', 'sadsad', 'แม่บ้าน', 'employeesimg/lovepik-female-staff-member-picture_501182266.jpg', 2000.00);

-- --------------------------------------------------------

--
-- Table structure for table `reserve`
--

CREATE TABLE `reserve` (
  `reserveid` int(10) NOT NULL,
  `roomid` int(3) NOT NULL,
  `account_id` int(10) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `resered_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomid` int(3) NOT NULL,
  `priceperday` double(10,2) NOT NULL,
  `image` text NOT NULL,
  `information` text NOT NULL,
  `upload_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomid`, `priceperday`, `image`, `information`, `upload_at`) VALUES
(1, 600.00, 'productimg/49612_large_202110191217122.jpeg', '1 ห้องน้ำ 1 เตียงแบบคู่ ', '2023-03-10 12:42:32'),
(2, 1000.00, 'productimg/type-l-05.jpg', '1 ห้องน้ำ 2 เตียงเดี่ยว ฟรีไวไฟ', '2023-03-09 13:55:36'),
(3, 1000.00, 'productimg/slide_1_sp.jpg', 'ห้องติดแม่น้ำวิวธรรมชาติ', '2023-03-10 12:25:37'),
(4, 700.00, 'productimg/BpoVbUmMbmjW4Fny68c9.jpg', '1 ห้องน้ำ 1 เตียงแบบคู่ ', '2023-03-09 13:58:10'),
(5, 1200.00, 'productimg/16300_ext_01_th_0.jpg', '2 เตียง ห้องสไตล์ญี่ปุ่น', '2023-03-10 12:21:58'),
(6, 650.00, 'productimg/โรงแรม-เกษร-บูทีค-2.jpeg', '1 เตียง 1 ห้องน้ำ ', '2023-03-09 14:00:11'),
(7, 2500.00, 'productimg/deluxe_room2.jpg', '1 เตียงใหญ่ ฟรีไวไฟ', '2023-03-10 12:23:23'),
(8, 800.00, 'productimg/l_6558_15002754801549470163.jpg', '1 ห้องน้ำ 1 เตียงแบบคู่ ฟรีไวไฟรวม', '2023-03-09 14:03:49'),
(9, 1000.00, 'productimg/185179747.jpg', '1 เตียงแบบคู่ ฟรีไวไฟ ที่ตั้งอยู่ในเมือง', '2023-03-09 14:54:23'),
(10, 950.00, 'productimg/_DSC7163.jpg', 'ห้องสไตล์มินิมอล ', '2023-03-10 12:24:45'),
(11, 1100.00, 'productimg/1580916943Kq1uMAS2UX.jpeg', 'ห้องธีมมืด ติดกับธรรมชาติ ', '2023-03-09 15:02:24'),
(500, 2000.00, 'productimg/test.jpg', 'ผมไม่ว่าง ขอนอนก่อนนะครับ', '2023-03-09 15:03:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `roomid` (`roomid`);

--
-- Indexes for table `reserve`
--
ALTER TABLE `reserve`
  ADD PRIMARY KEY (`reserveid`),
  ADD KEY `roomid` (`roomid`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reserve`
--
ALTER TABLE `reserve`
  MODIFY `reserveid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`roomid`) REFERENCES `room` (`roomid`);

--
-- Constraints for table `reserve`
--
ALTER TABLE `reserve`
  ADD CONSTRAINT `reserve_ibfk_1` FOREIGN KEY (`roomid`) REFERENCES `room` (`roomid`),
  ADD CONSTRAINT `reserve_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
