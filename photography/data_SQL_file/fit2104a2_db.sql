-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2021 at 10:02 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fit2104a2_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `product_id`) VALUES
(1, 'souvernir', 8784);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) NOT NULL,
  `client_Firstname` varchar(150) NOT NULL,
  `client_Surname` varchar(150) NOT NULL,
  `client_Address` varchar(200) NOT NULL,
  `client_Phone` int(10) NOT NULL,
  `client_Email` varchar(320) NOT NULL,
  `client_Subscribe` tinyint(1) NOT NULL,
  `client_Other_information` varchar(320) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `client_Firstname`, `client_Surname`, `client_Address`, `client_Phone`, `client_Email`, `client_Subscribe`, `client_Other_information`) VALUES
(1, 'Patrick ', 'mangi', '11/6 boadle road,Bundoora,3083', 406286601, 'mangi.patrick@yahoo.fr', 0, 'Nothing for now');

-- --------------------------------------------------------

--
-- Table structure for table `photo_shoot`
--

CREATE TABLE `photo_shoot` (
  `id` int(10) NOT NULL,
  `client_id` int(10) NOT NULL,
  `photo_shoot_name` varchar(100) NOT NULL,
  `photo_shoot_desc` varchar(300) NOT NULL,
  `photo_shoot_quote` int(10) NOT NULL,
  `photo_shoot_dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `photo_shoot_other_information` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `photo_shoot`
--

INSERT INTO `photo_shoot` (`id`, `client_id`, `photo_shoot_name`, `photo_shoot_desc`, `photo_shoot_quote`, `photo_shoot_dateTime`, `photo_shoot_other_information`) VALUES
(1, 1, 'birthday', 'for my birthday', 1500, '2021-09-11 05:08:00', 'needs to be professional');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_upc` int(10) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_upc`, `product_price`, `product_category`) VALUES
(8784, 'tennis ball', 1214521, 100, 'souvenir');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `product_image_filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `product_id`, `product_image_filename`) VALUES
(1, 8784, 'tennis.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(320) NOT NULL,
  `email` varchar(320) NOT NULL,
  `password` varchar(320) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category` (`product_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photo_shoot`
--
ALTER TABLE `photo_shoot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photoshoot_clients` (`client_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productimage_products` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225424;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25254;

--
-- AUTO_INCREMENT for table `photo_shoot`
--
ALTER TABLE `photo_shoot`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245754;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8785;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147852;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21452480;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `products_category` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `photo_shoot`
--
ALTER TABLE `photo_shoot`
  ADD CONSTRAINT `photoshoot_clients` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `productimage_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
