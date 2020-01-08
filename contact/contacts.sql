-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2020 at 01:39 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contacts`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contactid` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `mobile` bigint(14) NOT NULL,
  `email` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contactid`, `fullname`, `mobile`, `email`, `photo`, `userid`) VALUES
(40, 'Jackie', 9999999999, 'jackie@gmail.com', 'uploads/GOKU.jpg', 4),
(41, 'Jerry', 9123456781, 'jerry@gmail.com', 'uploads/Jerry.png', 4),
(42, 'Kai', 9888122222, 'kai@gmail.com', 'uploads/242881359kai.jpg', 4),
(43, 'Kungfu', 9111111111, 'kungfu@gmail.com', 'uploads/1352904011kungFu.jpg', 4),
(44, 'Mesa', 988818811, 'mesa@gmail.com', 'uploads/4779199746mesabear.jpg', 4),
(46, 'jerry', 999999999, 'jerry@gmail.com', 'uploads/Jerry.png', 5),
(47, 'tom', 99999777777, 'tom@gmail.com', 'uploads/8508412483Tom.png', 5),
(48, 'kai', 9888888888, 'kai@gmmail.com', 'uploads/kai.jpg', 5),
(49, 'mesa bear', 9461234567, 'mesabear@gmail.com', 'uploads/4779199746mesabear.jpg', 5),
(51, 'Shizuka', 899999999999, 'shizuka@gmail.com', 'uploads/8567621775562978547shizuka.jpg', 5),
(53, 'Despecable', 988888888, 'despecable@gmail.com', 'uploads/43516686474744911997despecable.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `mobile` bigint(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `username`, `password`, `fullname`, `mobile`) VALUES
(1, 'navneet@gmail.com', '1234', 'Navneet', 9779069212),
(3, 'goku@gmail.com', 'goku', 'GOKU', 9779069212),
(4, 'tweety@gmail.com', 'tweety', 'Tweety', 981111111),
(5, 'tom@gmail.com', 'tom', 'Tom', 9779069213),
(6, 'tina@gmail.com', 'tina', 'Tina', 977912345),
(7, 'jack@gmail.com', 'jack', 'Jack', 912345678),
(8, 'kai@gmail.com', 'kai', 'Kai', 9123456789),
(9, 'franklin@gmail.com', 'franklin', 'Franklin', 9123456789),
(10, 'shinchan@gmail.com', 'shinchan', 'Shinchan', 9123456789),
(11, 'abc@gmail.com', 'abc', 'ABC', 9234566778);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contactid`),
  ADD KEY `foreign_key` (`userid`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contactid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `foreign_key` FOREIGN KEY (`userid`) REFERENCES `signup` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
