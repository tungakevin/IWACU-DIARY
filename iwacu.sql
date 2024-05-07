-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2024 at 08:06 PM
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
-- Database: `iwacu`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderid` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `status` varchar(15) DEFAULT 'pending',
  `userid` int(11) NOT NULL,
  `dateofcreation` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderid`, `pid`, `quantity`, `status`, `userid`, `dateofcreation`) VALUES
(8, 1, 3, 'pending', 1, '2024-04-06 13:02:17'),
(9, 1, 3, 'pending', 1, '2024-04-06 13:02:49'),
(10, 1, 78, 'pending', 1, '2024-04-06 13:03:43'),
(11, 1, 8, 'pending', 2, '2024-04-06 13:20:11'),
(12, 1, 12, 'pending', 3, '2024-04-16 12:31:45'),
(13, 1, 21, 'pending', 3, '2024-04-16 12:56:19'),
(15, 1, 22, 'pending', 3, '2024-04-17 01:09:03'),
(16, 1, 4, 'approved', 3, '2024-05-07 00:00:00'),
(18, 1, 67, 'pending', 26, '2024-05-07 19:00:39');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `productname` varchar(23) DEFAULT NULL,
  `companyname` varchar(23) NOT NULL,
  `unitprice` float DEFAULT NULL,
  `quantity` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `productname`, `companyname`, `unitprice`, `quantity`) VALUES
(1, 'Amata', 'Iwacu Dairly', 350, 219);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(18) DEFAULT NULL,
  `address` varchar(23) NOT NULL,
  `phonenumber` varchar(15) DEFAULT NULL,
  `passwordofuser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `address`, `phonenumber`, `passwordofuser`) VALUES
(1, 'david', 'tumba', '7899', 999),
(2, 'keza', 'byumba', '78000', 111),
(3, 'gakunzi', 'butare', '780484257', 2244),
(4, 'james Gashugi', 'musanze', '7879', 2233),
(6, 'derrick', 'rwanda', NULL, 22334),
(13, 'david', 'byumba', '788554', 12344),
(14, 'ange', 'huye', '73999847', 99887),
(21, 'daniel', 'musanze', '2147483647', 3345),
(22, 'aimee', 'nyamasheke', '0738339506', 56735),
(23, 'sdfg', 'asdtfyg', '+250788650889', 7898),
(24, 'roger', 'ngoma', '+250788880034', 66554),
(25, 'phiona', 'kigali', '+250733876421', 22345),
(26, 'peter', 'cyuve', '0887793', 9988);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `phonenumber` (`phonenumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
