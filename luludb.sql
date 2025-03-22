-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2025 at 04:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `luludb`
--

-- --------------------------------------------------------

--
-- Table structure for table `usertbl`
--

CREATE TABLE `usertbl` (
  `userID` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `Birthday` date NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Contact` varchar(255) NOT NULL,
  `Photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usertbl`
--

INSERT INTO `usertbl` (`userID`, `Email`, `Password`, `FirstName`, `LastName`, `Gender`, `Birthday`, `Address`, `Contact`, `Photo`) VALUES
(1, 'hanni@gmail.com', 'hanni123', 'Hanni', 'Pham', 'Female', '2025-03-04', 'Korea', '0987123131', '67d8d62e562eb_Xhs_id__4296879199.jpg'),
(3, 'minji@gmail.com', 'min123', 'Kim', 'Minji', 'Female', '2025-03-07', 'Korea', '09234242', '67d8da4f743d2_Xhs_id__4296879199.jpg'),
(4, 'sss@gmail.com', '123', 'ss', 'ssss', 'Female', '2025-03-07', 'ASDAD09', '0993284234', '67d917737f5ca_Xhs_id__4296879199.jpg'),
(5, 'askd@gmail.com', '123', 'asdadsad', 'sdfs', 'Male', '2025-03-07', 'korea', '092837427342', '67d9238a00eac_Xhs_id__4296879199.jpg'),
(6, 'user@gmail.com', '123', 'User', 'User', 'Male', '2025-03-05', 'aaosdka', '0938784534', '67d92597aa005_Xhs_id__4296879199.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usertbl`
--
ALTER TABLE `usertbl`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usertbl`
--
ALTER TABLE `usertbl`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
