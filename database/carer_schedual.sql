-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2019 at 02:39 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mobileschedual`
--

-- --------------------------------------------------------

--
-- Table structure for table `carer_schedual`
--

CREATE TABLE `carer_schedual` (
  `csid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `schedual_time` varchar(225) NOT NULL,
  `schedual_endtime` varchar(225) NOT NULL,
  `schedual_date` varchar(225) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carer_schedual`
--

INSERT INTO `carer_schedual` (`csid`, `uid`, `cid`, `schedual_time`, `schedual_endtime`, `schedual_date`, `create_date`) VALUES
(1, 5, 2, '18:41', '19:10', '02-07-2019', '2019-07-09 18:42:08'),
(2, 5, 1, '18:43', '19:00', '3-7-2019', '2019-07-09 18:43:40'),
(3, 11, 3, '15:01', '15:30', '15-07-2019', '2019-07-15 15:01:43'),
(4, 14, 5, '15:16', '15:35', '16-07-2019', '2019-07-15 15:16:45'),
(5, 11, 3, '15:30', '16:00', '15-07-2019', '2019-07-15 15:30:23'),
(6, 11, 3, '17:43', '18:43', '15-07-2019', '2019-07-15 15:30:45'),
(7, 11, 3, '12:31', '14:31', '15-07-2019', '2019-07-15 15:31:08'),
(8, 11, 3, '11:31', '12:00', '16-07-2019', '2019-07-15 15:31:34'),
(9, 11, 3, '16:31', '17:00', '16-07-2019', '2019-07-15 15:31:44'),
(10, 11, 3, '18:31', '19:00', '16-07-2019', '2019-07-15 15:32:00'),
(13, 11, 3, '17:11', '18:11', '18-07-2019', '2019-07-17 17:12:03'),
(14, 11, 3, '17:14', '18:14', '17-07-2019', '2019-07-17 17:14:58'),
(15, 11, 3, '18:15', '19:15', '18-07-2019', '2019-07-17 17:15:34'),
(16, 14, 3, '17:17', '17:17', '19-07-2019', '2019-07-17 17:17:38'),
(17, 11, 3, '20:19', '21:19', '17-07-2019', '2019-07-17 17:19:22'),
(18, 5, 3, '20:21', '21:21', '18-07-2019', '2019-07-17 17:21:19'),
(19, 11, 3, '17:28', '18:28', '19-07-2019', '2019-07-17 17:28:18'),
(20, 11, 3, '17:28', '17:28', '20-07-2019', '2019-07-17 17:29:00'),
(21, 4, 3, '17:43', '18:43', '15-07-2019', '2019-07-17 17:43:11'),
(22, 14, 3, '17:44', '17:44', '20-07-2019', '2019-07-17 17:44:15'),
(23, 4, 1, '17:45', '18:45', '21-07-2019', '2019-07-17 17:45:58'),
(24, 11, 5, '10:46', '11:46', '21-07-2019', '2019-07-17 17:46:40'),
(25, 11, 3, '17:51', '18:51', '20-07-2019', '2019-07-17 17:51:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carer_schedual`
--
ALTER TABLE `carer_schedual`
  ADD PRIMARY KEY (`csid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carer_schedual`
--
ALTER TABLE `carer_schedual`
  MODIFY `csid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
