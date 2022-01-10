-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2021 at 09:35 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbec`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` varchar(5) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `cellNumber` varchar(255) NOT NULL,
  `Address` text NOT NULL,
  `Position` varchar(255) NOT NULL,
  `About` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `Name`, `Email`, `Password`, `cellNumber`, `Address`, `Position`, `About`) VALUES
('1', 'Nico', 'email@test.com', 'admin', '0866564', 'GG', 'Admin', 'Nothing here                                                                                                                                                                                                                                                                                                                    '),
('qq', 'qq', 'QQ@gmail.com', 'qq', 'qq', 'QQ', 'qq', 'qq');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `userID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `cellNumber` varchar(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`userID`, `name`, `email`, `password`, `address`, `cellNumber`, `status`) VALUES
(22, 'gg', 'gg@gg.com', 'gg', 'gg', 'gg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `c_order`
--

CREATE TABLE `c_order` (
  `orderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `total` double NOT NULL,
  `status` text DEFAULT 'Unpaid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `productDescription` text DEFAULT NULL,
  `productImage` text DEFAULT NULL,
  `productPrice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productName`, `productDescription`, `productImage`, `productPrice`) VALUES
(1, 'Frog', 'Size A3 594mm x 420mm', '1.jpg', 150),
(2, '2', 'Size A3 594mm x 420mm', '2.jpg', 150),
(3, '3', 'Size A3 594mm x 420mm', '3.jpg', 150),
(4, '4', 'Size A3 594mm x 420mm', '4.jpg', 200),
(5, '5', 'Size A3 594mm x 420mm', '5.jpg', 200),
(6, '6', 'Size A3 594mm x 420mm', '6.jpg', 200),
(7, '7', 'Size A3 594mm x 420mm', '7.jpg', 100),
(8, '8', 'Size A3 594mm x 420mm', '8.jpg', 100),
(9, '9', 'Size A3 594mm x 420mm', '9.jpg', 200),
(10, '10', 'Size A3 594mm x 420mm', '10.jpg', 200),
(11, '11', 'Size A3 594mm x 420mm', '11.jpg', 150),
(12, '12', 'Size A3 594mm x 420mm', '12.jpg', 175),
(13, '13', 'Size A3 594mm x 420mm', '13.jpg', 175),
(14, '14', 'Size A3 594mm x 420mm', '14.jpg', 200),
(15, '15', 'Size A3 594mm x 420mm', '15.jpg', 175),
(16, '16', 'Size A3 594mm x 420mm', '16.jpg', 175),
(17, '17', 'Size A3 594mm x 420mm', '17.jpg', 200),
(18, '18', 'Size A3 594mm x 420mm', '18.jpg', 200),
(19, '19', 'Size A3 594mm x 420mm', '19.jpg', 100),
(20, '20', 'Size A3 594mm x 420mm', '20.jpg', 125),
(21, '21', 'Size A3 594mm x 420mm', '21.jpg', 100),
(22, '22', 'Size A3 594mm x 420mm', '22.jpg', 175),
(23, '23', 'Size A3 594mm x 420mm', '23.jpg', 150),
(24, '24', 'Size A3 594mm x 420mm', '24.jpg', 125),
(25, '25', 'Size A3 594mm x 420mm', '25.jpg', 150),
(26, '26', 'Size A3 594mm x 420mm', '26.jpg', 175),
(27, '27', 'Size A3 594mm x 420mm', '27.jpg', 150),
(28, '28', 'Size A3 594mm x 420mm', '28.jpg', 150),
(29, '29', 'Size A3 594mm x 420mm', '29.jpg', 200),
(30, '30', 'Size A3 594mm x 420mm', '30.jpg', 200),
(31, '31', 'Size A3 594mm x 420mm', '31.jpg', 175),
(32, '32', 'Size A3 594mm x 420mm', '32.jpg', 150),
(33, '33', 'Size A3 594mm x 420mm', '33.jpg', 150),
(34, '34', 'Size A3 594mm x 420mm', '34.jpg', 100),
(35, '35', 'Size A3 594mm x 420mm', '35.jpg', 100),
(36, '36', 'Size A3 594mm x 420mm', '36.jpg', 150),
(37, '37', 'Size A3 594mm x 420mm', '37.jpg', 200),
(38, '38', 'Size A3 594mm x 420mm', '38.jpg', 125),
(39, '39', 'Size A3 594mm x 420mm', '39.jpg', 200);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `c_order`
--
ALTER TABLE `c_order`
  ADD PRIMARY KEY (`orderID`,`productID`) USING BTREE,
  ADD KEY `FK_productID` (`productID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `FK_userID` (`userID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `c_order`
--
ALTER TABLE `c_order`
  ADD CONSTRAINT `FK_orderID` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`),
  ADD CONSTRAINT `FK_productID` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_userID` FOREIGN KEY (`userID`) REFERENCES `customer` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
