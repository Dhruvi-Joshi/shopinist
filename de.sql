-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2023 at 02:46 PM
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
-- Database: `de`
--

-- --------------------------------------------------------

--
-- Table structure for table `cancelorder`
--

CREATE TABLE `cancelorder` (
  `id` int(50) NOT NULL,
  `orderid` int(50) NOT NULL,
  `status` varchar(200) NOT NULL,
  `reason` varchar(200) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ckeckout`
--

CREATE TABLE `ckeckout` (
  `id` int(11) NOT NULL,
  `userid` int(20) NOT NULL,
  `shopid` int(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `pno` int(10) NOT NULL,
  `email` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `price` int(20) NOT NULL,
  `order_status` varchar(20) NOT NULL,
  `servicetype` varchar(30) NOT NULL,
  `paymentmode` varchar(20) NOT NULL,
  `time` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ckeckout`
--

INSERT INTO `ckeckout` (`id`, `userid`, `shopid`, `name`, `pno`, `email`, `address`, `price`, `order_status`, `servicetype`, `paymentmode`, `time`) VALUES
(23, 17, 21, 'rahul shah', 1235345745, 'rahul@gmail.com', '123,conic app,jamanagar', 60, 'In process', 'home delivery', 'cod', '2023-06-26');

-- --------------------------------------------------------

--
-- Table structure for table `creg`
--
-- Error reading structure for table de.creg: #1932 - Table 'de.creg' doesn't exist in engine
-- Error reading data for table de.creg: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `de`.`creg`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `cregister`
--

CREATE TABLE `cregister` (
  `no` int(11) NOT NULL,
  `profile` varchar(25) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pno` int(10) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `cpass` varchar(20) NOT NULL,
  `addr` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `time` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cregister`
--

INSERT INTO `cregister` (`no`, `profile`, `fname`, `email`, `pno`, `user`, `pass`, `cpass`, `addr`, `gender`, `time`) VALUES
(17, 'fix.png', 'rahul shah', 'rahul@gmail.com', 1235345745, 'rahul', 'rahul', 'rahul', '123,conic app,jamanagar', 'male', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `feed_name` varchar(50) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `customer_id`, `shop_id`, `feed_name`, `feedback`, `date`) VALUES
(7, 17, 21, 'rahul shah', 'give fast delivary', '2023-06-26');

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `shop_id` int(10) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`id`, `customer_id`, `shop_id`, `time`) VALUES
(31, 17, 21, '2023-06-26 12:43:46');

-- --------------------------------------------------------

--
-- Table structure for table `ordered`
--

CREATE TABLE `ordered` (
  `id` int(80) NOT NULL,
  `orderid` int(50) NOT NULL,
  `product_id` int(30) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordered`
--

INSERT INTO `ordered` (`id`, `orderid`, `product_id`, `quantity`, `price`) VALUES
(37, 23, 46, 4, 15);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(20) NOT NULL,
  `shop_id` int(50) NOT NULL,
  `name` varchar(70) NOT NULL,
  `price` int(50) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `details` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `shop_id`, `name`, `price`, `photo`, `details`) VALUES
(46, 21, 'meggi', 15, 'pro4.jpg', '15 RS. 2 extra masala free');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(20) NOT NULL,
  `customer_id` int(20) NOT NULL,
  `shop_id` int(20) NOT NULL,
  `rating` int(20) NOT NULL,
  `feedback` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `customer_id`, `shop_id`, `rating`, `feedback`) VALUES
(15, 17, 21, 4, 'good');

-- --------------------------------------------------------

--
-- Table structure for table `sregister`
--

CREATE TABLE `sregister` (
  `no` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `bdate` date NOT NULL,
  `mail` varchar(30) NOT NULL,
  `mno` int(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `type` varchar(30) NOT NULL,
  `sname` varchar(20) NOT NULL,
  `autho` varchar(50) NOT NULL,
  `smail` varchar(30) NOT NULL,
  `slogo` varchar(50) NOT NULL,
  `sphoto` varchar(50) NOT NULL,
  `sdescr` varchar(50) NOT NULL,
  `nation` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `dist` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `addr` varchar(50) NOT NULL,
  `pin` int(8) NOT NULL,
  `aname` varchar(30) NOT NULL,
  `ano` int(15) NOT NULL,
  `online` varchar(20) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `cpass` varchar(20) NOT NULL,
  `qrimage` varchar(50) NOT NULL,
  `time` varchar(10) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sregister`
--

INSERT INTO `sregister` (`no`, `name`, `bdate`, `mail`, `mno`, `gender`, `type`, `sname`, `autho`, `smail`, `slogo`, `sphoto`, `sdescr`, `nation`, `state`, `dist`, `city`, `addr`, `pin`, `aname`, `ano`, `online`, `user`, `pass`, `cpass`, `qrimage`, `time`) VALUES
(21, 'rajesh patel', '1994-05-03', 'rajesh@gmail.com', 2147483647, 'Male', 'provision', 'aashtha store', 'myntra.png', 'aashtha123@gmail.com', 'logo6.jpg', 'shop8.JPG', 'provisional items', 'india', 'GUJARAT', 'jamnagar', 'Jamnagar', '303,saru road,abc chokdi,jamnagar', 361008, 'aashtha provison store', 354734, '56573436474', 'astha', 'astha', 'astha', '1687783101.png', '2023-06-26');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `no` int(200) NOT NULL,
  `customer_id` int(50) NOT NULL,
  `product_id` int(50) NOT NULL,
  `shop_id` int(50) NOT NULL,
  `time` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cancelorder`
--
ALTER TABLE `cancelorder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ckeckout`
--
ALTER TABLE `ckeckout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cregister`
--
ALTER TABLE `cregister`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordered`
--
ALTER TABLE `ordered`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sregister`
--
ALTER TABLE `sregister`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cancelorder`
--
ALTER TABLE `cancelorder`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ckeckout`
--
ALTER TABLE `ckeckout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `cregister`
--
ALTER TABLE `cregister`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `ordered`
--
ALTER TABLE `ordered`
  MODIFY `id` int(80) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sregister`
--
ALTER TABLE `sregister`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `no` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
