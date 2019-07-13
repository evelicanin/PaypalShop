-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2019 at 11:04 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paypal_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'WEBSITE BOOKS'),
(2, 'BOOTSTRAP TUTORIALS'),
(3, 'CMS BOOKS'),
(4, 'PHP BOOKS'),
(12, 'jQUERY BOOKS');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `date_insert` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message_seen` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `phone`, `subject`, `message`, `date_insert`, `message_seen`) VALUES
(1, 'edis', 'velicanin.edis@gmail.com', '+38762104575', 'Test message', 'This is a test message !!!In a single collection, Font Awesome is a pictographic language of web-related actions.', '2016-02-14 10:39:09', 1),
(2, 'edis', 'velicanin.edis@gmail.com', '+38762104575', 'Test message', 'This is a test message !!!', '2016-02-14 10:41:20', 1),
(3, 'edis', 'edistizu@gmail.com', '+38762346645', 'Test message 2', 'This is another test message !!!', '2016-02-14 10:41:54', 1),
(4, 'edis', 'edistizu@gmail.com', '+38762346645', 'Testing redirect', 'Does it work?', '2016-02-14 10:43:31', 1),
(5, 'edis', 'edistizu@gmail.com', '+38762104575', 'Last test message', 'This is the last test', '2016-02-14 10:45:20', 0),
(6, 'edis', 'edistizu@gmail.com', '+38762104575', 'another test', 'is it working now?', '2016-02-14 10:47:04', 0),
(7, 'edis', 'edistizu@gmail.com', '+38762104575', 'It works', 'Now everything works', '2016-02-14 10:47:50', 0),
(8, 'edis', '	 edistizu@gmail.com', '+38762104575', 'no shit', 'fakat radi', '2016-02-14 22:34:45', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_amount`, `order_transaction`, `order_status`, `order_currency`) VALUES
(66, 33.99, '123456', 'Completed', 'USA'),
(67, 399, '123460', 'Completed', 'USA');

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
  `product_image` varchar(255) NOT NULL,
  `hot_product` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_category_id`, `product_price`, `product_quantity`, `product_description`, `short_desc`, `product_image`, `hot_product`) VALUES
(21, 'How to build a Website from scratch', 3, 99.99, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', 'This is a test product short description', 'image_2.jpg', 0),
(22, 'Learn Javascript for Dummies', 1, 100.99, 3, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\\\\\\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', 'This is a test product short description', 'BAKLAVA.jpg', 0),
(25, 'Learn PHP', 4, 399, 7, 'This is a perfect book for everyone trying to learn PHP. It contains multiple examples of application development from scratch. You will learn how to create a database, connect to the database, create a front and back interface for your application as well as creating a login system.', 'A great book about PHP fundamentals', 'image_6.jpg', 1),
(28, 'LARAVEL 5.2', 4, 499.99, 4, 'This is a tutorial about all the new LARAVEL features for the 5.2 version exclusive for you.', 'All about the latest LARAVEL release exclusive for you.', 'image_8.jpg', 1),
(30, 'How to build a CMS', 3, 29.99, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 'image_1.jpg', 0),
(31, 'jQUERY FOR DUMMIES', 12, 123, 2, 'I you are a dummy, buy this book. If not, buy something more complicated.', 'This is a book for dummies', 'image_7.jpg', 1),
(32, 'BOOTSTRAP 3.0', 2, 33.99, 2, 'Contains all the new features of BOOTSTRAP 3.0 version.\\r\\nSimply download a CSS file and replace the one in Bootstrap. No messing around with hex \\r\\nChanges are contained in just two LESS or SASS files, enabling modification and ensuring forward compatibility.', 'All about the lastest bootstrap version.', 'image_3.jpg', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `product_id`, `order_id`, `product_price`, `product_title`, `product_quantity`) VALUES
(42, 32, 66, 33.99, 'BOOTSTRAP 3.0', 1),
(43, 25, 67, 399, 'Learn PHP', 1);

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `slide_id` int(11) NOT NULL,
  `slide_title` varchar(255) NOT NULL,
  `slide_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`slide_id`, `slide_title`, `slide_image`) VALUES
(4, 'Test : adding a new slide', 'image_5.jpg'),
(5, 'test adding a new slide', 'image_3.jpg'),
(6, 'TEST SLIDE', 'image_2.jpg'),
(7, 'ANOTHER TEST SLIDE', 'image_1.jpg'),
(11, 'test adding a new slide', 'image_7.jpg'),
(12, 'test', 'image_8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`) VALUES
(1, 'rico', 'rico@hotmail.com', '123'),
(5, 'edis', 'velicanin.edis@gmail.com', 'edis'),
(6, 'tizu', 'edistizu@gmail.com', 'tizu'),
(11, 'fazla', 'fazla@gmail.com', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
