-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2019 at 07:58 AM
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
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `uid` int(16) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `surname` varchar(225) NOT NULL,
  `password` varchar(255) NOT NULL,
  `personcode` varchar(100) NOT NULL,
  `street1` varchar(225) NOT NULL,
  `street2` varchar(225) NOT NULL,
  `town` varchar(225) NOT NULL,
  `postcode` varchar(225) NOT NULL,
  `addresscode` varchar(225) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `Phone2` varchar(225) NOT NULL,
  `status` char(1) NOT NULL,
  `role` varchar(225) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`uid`, `firstname`, `surname`, `password`, `personcode`, `street1`, `street2`, `town`, `postcode`, `addresscode`, `email`, `phone`, `Phone2`, `status`, `role`, `create_date`, `last_login_time`) VALUES
(1, 'admin', '', '0192023a7bbd73250516f069df18b500', '', '', '', '', '', '', 'komal.panchal27@gmail.com', '9714163678', '', '', 'administrator', '2018-10-12 11:27:08', 1562563248),
(2, 'komal', 'panchal', '', '', 'address1', 'address2', 'Bristol', '390019', '', '', '9714163658', '9714163', '', '', '2019-07-06 17:11:11', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `uid` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
