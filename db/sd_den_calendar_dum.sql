-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2022 at 06:54 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sd_den_calendar`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  `patient_name` varchar(255) NOT NULL,
  `patient_tel` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`id`, `title`, `detail`, `start`, `end`, `color`, `patient_name`, `patient_tel`) VALUES
(21, 'test', 'tststsststddddddddddddddddddddddddddddddddddddddddd', '2022-04-04 11:01:39', '2022-04-04 16:30:39', '#000080', 'ศรายุทธ นวะศรี', '0980877876'),
(31, 'นพ.ทดสอบหมอ  หมอทดสอบ', 'sdsvsdvsdvs', '2022-04-27 15:14:00', '2022-04-27 17:14:00', '#000080', 'ssssss', '0981234123'),
(32, 'นพ.ทดสอบหมอ  หมอทดสอบ', 'aaaaasadasdasd', '2022-04-27 16:16:00', '2022-04-27 19:16:00', '#66CC33', 'sarayuth', '0981234567');

-- --------------------------------------------------------

--
-- Table structure for table `kname`
--

CREATE TABLE `kname` (
  `kumnum_id` int(11) NOT NULL,
  `kumnum_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kname`
--

INSERT INTO `kname` (`kumnum_id`, `kumnum_name`) VALUES
(1, 'นพ.'),
(2, 'นาย'),
(3, 'นาง');

-- --------------------------------------------------------

--
-- Table structure for table `procedures`
--

CREATE TABLE `procedures` (
  `procedure_id` int(11) NOT NULL,
  `procedure_name` varchar(50) NOT NULL,
  `color` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `procedures`
--

INSERT INTO `procedures` (`procedure_id`, `procedure_name`, `color`) VALUES
(1, 'ตรวจฟันและให้คำปรึกษา', '#FFCC00'),
(2, 'อุดฟัน', '#FF3300'),
(3, 'ถอนฟัน', '#CC33FF'),
(4, 'ผ่าฟันคุด', '#66CC33'),
(5, 'รักษารากฟัน', '#996600'),
(6, 'ฟันปลอมฐานพลาสติก/โลหะ', '#6699FF'),
(7, 'อุดปิดฟันห่าง', '#666666'),
(8, 'เคลือบหลุมร่องฟัน', '#000080'),
(9, 'เคลือบฟลูออไรด์', '#FF69B4'),
(10, 'เอ็กซเรย์ฟัน', '#000000'),
(13, 'ครอบฟัน', '#2F4F4F'),
(14, 'test', '#000000'),
(15, 'test2', '#39a02c');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `cid` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `user_level` varchar(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `pname`, `firstname`, `lastname`, `cid`, `address`, `email`, `tel`, `user_level`, `date`) VALUES
(16, 'admin@nueng', 'e10adc3949ba59abbe56e057f20f883e', 'นาย', 'sarayuth', 'navasri', '1400900249352', 'Somdet', 'test@gmail.com', '0870877876', 'admin', '2022-04-27 04:39:58'),
(18, 'user@nueng', 'e10adc3949ba59abbe56e057f20f883e', 'นพ.', 'ทดสอบหมอ', 'หมอทดสอบ', '12345678910', 'Somdet', 'test@gmail.com', '0812345678', 'user', '2022-04-27 04:40:17'),
(21, 'test', 'e10adc3949ba59abbe56e057f20f883e', 'นาย', 'sarayuth', 'navasri', '1234567891234567', 'Somdet', 'test@gmail.com', '0870877876', 'user', '2022-04-27 04:13:47'),
(30, 'u1', 'e10adc3949ba59abbe56e057f20f883e', 'นาย', 'sarayuth1', 'navasri1', '12345678910', 'somdet', 'test@gmail.com', '0812345678', 'user', '2022-04-27 03:43:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kname`
--
ALTER TABLE `kname`
  ADD PRIMARY KEY (`kumnum_id`);

--
-- Indexes for table `procedures`
--
ALTER TABLE `procedures`
  ADD PRIMARY KEY (`procedure_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `kname`
--
ALTER TABLE `kname`
  MODIFY `kumnum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `procedures`
--
ALTER TABLE `procedures`
  MODIFY `procedure_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
