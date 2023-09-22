-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2023 at 03:59 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datasense`
--

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `int` int(11) NOT NULL,
  `shopName` varchar(200) NOT NULL,
  `OwnerName` varchar(100) NOT NULL,
  `phoneNo` varchar(13) NOT NULL,
  `latitude` decimal(10,6) NOT NULL,
  `longitude` decimal(10,6) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0 as InActive \r\n1 as Active',
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`int`, `shopName`, `OwnerName`, `phoneNo`, `latitude`, `longitude`, `status`, `createdAt`) VALUES
(1, 'teashop', 'sudha', '8940695959', 11.046544, 76.851799, 1, '2023-09-22 16:22:57'),
(2, 'fruits shop', 'sakthi', '9876543210', 11.024747, 76.898041, 1, '2023-09-22 16:41:07'),
(3, 'banana shop', 'babu', '9876543210', 11.004230, 77.024323, 1, '2023-09-22 17:00:43'),
(4, 'Jwellery shop karur', 'anu', '9898989878', 11.019878, 78.084855, 1, '2023-09-22 17:02:57'),
(5, 'PROZONE MALL', 'PROZONE MALL', '8012801208', 11.054774, 76.991536, 1, '2023-09-22 17:07:08'),
(6, 'Bike shop Chennai', 'mark', '7898789890', 13.083694, 80.270186, 1, '2023-09-22 19:14:52'),
(7, 'car shop Delhi', 'aalbin', '9890099009', 28.627393, 77.171695, 1, '2023-09-22 19:17:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`int`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `int` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
