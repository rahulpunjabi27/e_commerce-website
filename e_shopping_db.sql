-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 17, 2020 at 07:40 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_shopping_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Formal Shirts'),
(2, 'Casual Shirt'),
(3, 'official Shirt\'s');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_amount` float NOT NULL,
  `order_transaction` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `order_currency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_amount`, `order_transaction`, `order_status`, `order_currency`) VALUES
(4, 2135.06, '123456789', 'complete', 'US'),
(5, 2135.06, '123456789', 'complete', 'US'),
(6, 255.99, '123456789', 'complete', 'US'),
(11, 1010, '123456789', 'complete', 'US'),
(12, 1010, '123456789', 'complete', 'US'),
(13, 999, '123456789', 'complete', 'US');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `product_price` float NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_description` text NOT NULL,
  `short_desc` text NOT NULL,
  `product_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_category_id`, `product_price`, `product_quantity`, `product_description`, `short_desc`, `product_image`) VALUES
(2, 'Dot Formal Shirt', 1, 999, 3, 'Highlights:\\\\\\\\r\\\\\\\\n\\\\\\\\r\\\\\\\\nFabric: High Quality Fabron(Soft Feel)\\\\\\\\r\\\\\\\\nStyle: Formal\\\\\\\\r\\\\\\\\nFit: Smart Fit\\\\\\\\r\\\\\\\\n\\\\\\\\r\\\\\\\\n\\\\\\\\r\\\\\\\\n\\\\\\\\r\\\\\\\\nDelivery 7 Working Days.', 'Fabric: High Quality Fabron(Soft Feel)\\\\\\\\r\\\\\\\\nStyle: Formal\\\\\\\\r\\\\\\\\nFit: Smart Fit', 'formalShirt.jpg'),
(3, 'Casual Shirt', 2, 11, 3, 'New Arrival Autumn Men Shirt 2019 Unique Design Fake two pieces Stylish Mens Dress Shirt Long Sleeve Casual Slim Fit Male Shirts', 'New Arrival Autumn Men Shirt 2019 Unique Design Fake two pieces Stylish Mens Dress Shirt Long Sleeve Casual Slim Fit Male Shirts', 'image1.jpg'),
(4, 'Official Shirt  ', 3, 999, 5, 'Men\'s Top Quality Executive Shirts, Mens Official Shirts, Made in Bangladesh shirts ', 'Men\'s Top Quality Executive Shirts, Mens Official Shirts, Made in Bangladesh shirts ', 'Men-s-Top-Quality-Executive-Shirts-Mens.jpg_350x350.jpg'),
(5, 'Official Shirt  ', 3, 999, 2, 'oem dress shirt official shirts for men', 'oem dress shirt official shirts for men', 'oem-dress-shirt-official-shirts-for-men.jpg_350x350.jpg'),
(7, 'Casual Shirt', 2, 1000, 3, 'ETA:USA 7-15 working days,others 2-4 weeks,according to the destination country.\r\nWe ship worldwide. \r\nAvailable Size: \r\nAvailable Color: \r\nFabric: \r\nSize M-- Shoulder width: 42cm,Bust: 96cm, Lenght:68cm Sleeve Length: 62cm\r\nSize L-- Shoulder width: 43cm,Bust: 100cm, Lenght:71cm Sleeve Length: 63cm\r\nSize XL-- Shoulder width: 44cm,Bust: 104cm, Lenght:72cm Sleeve Length: 64cm\r\nSize XXL-- Shoulder width: 45cm, Bust:108cm, Lenght: 74cm Sleeve Length: 65cm\r\nWe will ship the items within 24-48 hours after you Payment.', 'Man Shirts New 2018 Fashion Male Casual Dress Shirt Slim Fit Men\'s Shirt Long Sleeve Casual-Shirt Men Clothes', '58d273d9cf72b87e14e9f89e-large.jpg'),
(8, 'Casual Shirt', 2, 2000, 6, 'it Type: Regular Fit\r\n100% High-grade Cotton Fabrics: Good capability of tenderness, air permeability and moisture absorption feels soft and comfy.\r\nSuitable for: Sports, Casual, Business Work, Date, Party, Perfect gift for families, friends and boyfriend\r\nSlim Fit , Fabric: 100% Cotton , Full Sleeve ,Casual Shirts\r\nHigh Quality Fabric and Stitching\r\nWash Instruction: Handwash in cold water NO BLEACH, Low iron and tumble dry on low heat', 'IndoPrimo Men’s Cotton Casual Shirt For Men Full Sleeves', 'images.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_price` float NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `product_id`, `order_id`, `product_price`, `product_title`, `product_quantity`) VALUES
(2, 1, 7, 255.99, 'product1', 2),
(3, 1, 8, 255.99, 'product1', 1),
(4, 1, 9, 255.99, 'product1', 3),
(6, 2, 11, 999, 'Dot Formal Shirt', 1),
(7, 3, 12, 11, 'Casual Shirt', 1),
(8, 2, 13, 999, 'Dot Formal Shirt', 1);

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `slide_id` int(11) NOT NULL,
  `slide_title` varchar(255) NOT NULL,
  `slide_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`slide_id`, `slide_title`, `slide_image`) VALUES
(11, 'test function', 'download.jpg'),
(12, 'new Design', 'download (1).jpg'),
(14, 'banner1', 'banner1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`slide_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
