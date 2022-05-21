-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 09, 2022 at 11:25 PM
-- Server version: 5.7.38
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `syeds3_NJPizzeria`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(100) NOT NULL,
  `userId` int(11) NOT NULL,
  `addedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartId`, `productId`, `quantity`, `userId`, `addedDate`) VALUES
(60, 12, 1, 2, '2022-05-07 18:53:04'),
(59, 16, 1, 2, '2022-05-07 18:53:02');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categorieId` int(12) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `dateadded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categorieId`, `name`, `description`, `dateadded`) VALUES
(1, 'PIZZA', 'Get your favorite pizza at NJ Pizzeria', '2022-04-17 18:16:28'),
(2, 'SECIALITY PIZZA', 'Get your favorite speciality pizza from NJ Pizzeria', '2022-04-17 18:17:14'),
(3, 'PASTA', 'Get your favorite pasta from NJ Pizzeria', '2022-04-17 18:17:43'),
(4, 'SIDES ORDERS', 'Get a side order with your pizza at NJ Pizzeria', '2021-03-17 18:19:10'),
(5, 'SALAD', 'Get a salad to compliment your pizza craving at NJ Pizzeria', '2022-04-18 07:55:28'),
(6, 'BEVERAGES', 'Get a beverage with your pizza at NJ Pizzeria', '2022-04-17 21:58:58');

-- --------------------------------------------------------

--
-- Table structure for table `deliverydetails`
--

CREATE TABLE `deliverydetails` (
  `id` int(21) NOT NULL,
  `orderId` int(21) NOT NULL,
  `deliveryname` varchar(35) NOT NULL,
  `deliveryPhoneNumber` bigint(25) NOT NULL,
  `deliveryTime` int(200) NOT NULL COMMENT 'Time in minutes',
  `dateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `id` int(21) NOT NULL,
  `orderId` int(21) NOT NULL,
  `productId` int(21) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`id`, `orderId`, `productId`, `quantity`) VALUES
(17, 7, 1, 1),
(18, 7, 11, 1),
(19, 7, 18, 1),
(20, 7, 20, 1),
(21, 8, 30, 1),
(22, 8, 27, 1),
(23, 8, 19, 1),
(24, 8, 22, 1),
(25, 9, 29, 1),
(26, 9, 24, 1),
(27, 9, 8, 1),
(28, 9, 7, 1),
(29, 10, 28, 1),
(30, 10, 20, 1),
(31, 10, 11, 1),
(32, 10, 16, 1),
(33, 11, 19, 1),
(34, 11, 27, 1),
(35, 11, 17, 1),
(36, 11, 16, 1),
(37, 12, 30, 1),
(38, 12, 20, 1),
(39, 12, 11, 1),
(40, 12, 15, 1),
(41, 13, 16, 1),
(42, 13, 4, 1),
(43, 14, 27, 1),
(44, 14, 20, 1),
(45, 14, 30, 1),
(46, 15, 21, 1),
(47, 15, 6, 1),
(48, 15, 18, 1),
(49, 16, 13, 1),
(50, 16, 3, 1),
(51, 16, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(21) NOT NULL,
  `userId` int(21) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zipCode` int(21) NOT NULL,
  `phoneNumber` bigint(21) NOT NULL,
  `amount` int(200) NOT NULL,
  `payment` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=cash on delivery, \r\n1=online ',
  `orderStatus` enum('0','1','2','3','4','5','6') NOT NULL DEFAULT '0' COMMENT '0=Order Placed.\r\n1=Order Confirmed.\r\n2=Preparing your Order.\r\n3=Your order is on the way!\r\n4=Order Delivered.\r\n5=Order Denied.\r\n6=Order Cancelled.',
  `orderDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `userId`, `address`, `zipCode`, `phoneNumber`, `amount`, `payment`, `orderStatus`, `orderDate`) VALUES
(7, 2, '27 example street', 70030, 1231231234, 27, '0', '0', '2022-05-07 18:35:55'),
(8, 2, '1 normal ave', 70031, 1111112222, 16, '0', '0', '2022-05-07 18:36:44'),
(9, 2, '9 oak street', 77021, 9732212020, 24, '0', '0', '2022-05-07 18:39:55'),
(10, 1, '12 normal ave', 70021, 9734561292, 22, '0', '0', '2022-05-07 18:41:35'),
(11, 1, '6 love lane', 70032, 5516662001, 20, '0', '0', '2022-05-07 18:42:21'),
(12, 1, '3 tree street', 70032, 1231231111, 23, '0', '0', '2022-05-07 18:43:29'),
(13, 10, '27 testing street', 70012, 1231231239, 12, '0', '0', '2022-05-08 12:25:18'),
(14, 10, '9 forexample street', 80012, 5516662001, 10, '0', '0', '2022-05-08 12:28:15'),
(15, 10, '3 demo lande', 73321, 9996662000, 19, '0', '0', '2022-05-08 12:29:18'),
(16, 10, '123 remove street', 80321, 1231231236, 22, '0', '0', '2022-05-08 12:44:22');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(12) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` decimal(4,2) NOT NULL,
  `description` text NOT NULL,
  `categorieId` int(12) NOT NULL,
  `img` text,
  `madeDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `name`, `price`, `description`, `categorieId`, `img`, `madeDate`) VALUES
(25, 'Tuna Salad', '4.00', 'Tuna with lettuce, tomato, onion, cucumber, and olives then topped with vinegar and oil', 5, 'tunas.jpg', '2022-04-17 21:47:51'),
(24, 'Pizza Fries', '4.00', 'Deep fried french fries topped with tomato sauce and cheese', 4, 'pfries.jpg', '2022-04-17 21:47:07'),
(23, 'Jalapeno Poppers', '4.00', 'Small bites of jelapeno, riccota cheese and bread', 4, 'jalapenopoppers.jpg', '2022-04-17 21:46:21'),
(22, 'Garlic Bread', '6.00', 'Bread that is baked with garlic parmesan', 4, 'garlicbread.jpg', '2022-04-17 21:45:34'),
(21, 'Plain Breadsticks', '6.00', ' Classic Breadsticks ', 4, 'breadsticks.jpg', '2022-04-17 21:44:44'),
(20, 'Garlic Knox', '4.00', 'Bread that is shaped as knox and baked with garlic parmesan', 4, 'garlicknox.jpg', '2022-04-17 21:41:49'),
(19, 'Mozzarella Sticks', '4.00', 'Deep fried mozzarella sticks', 4, 'mozzarellasticks.jpg', '2022-04-17 21:40:58'),
(18, 'Lasagna', '7.00', 'Classic lasagna that is layered with pasta, cheese, and beef', 3, 'lasagna.jpg', '2022-04-17 21:39:49'),
(17, 'Cheese Ravioli', '6.00', 'Amazing ravioli stuffed with 4 mix cheese', 3, 'cheeseravioli.jpg', '2022-04-17 21:38:13'),
(16, 'Baked Penne Vodka', '6.00', 'Penne vodka that is baked to perfection', 3, 'bakedpennevodka.jpg', '2022-04-17 21:37:21'),
(15, 'Chicken Fettuccine Alfredo', '6.00', 'Classic chicken alfredo made in alfredo sauce with fettuccine pasta', 3, 'cfettuccinealfredo.jpg', '2022-04-17 21:36:36'),
(14, 'Pasta with Meatballs', '6.00', 'Pasta with delicious meatballs made from beef', 3, 'pastameatball.jpg', '2022-04-17 21:35:31'),
(13, 'Spagetti Marinara', '6.00', 'The classic spahetti with marinara', 3, 'spagettimarinara.jpg', '2022-04-17 21:34:37'),
(12, 'Barbecue Chicken Pizza', '11.00', 'A pizza topped with barbecue chicken', 2, 'bbqchickenp.jpg', '2022-04-17 21:29:41'),
(11, 'Buffalo Chicken Pizza', '11.00', 'A pizza topped with buffalo chicken', 2, 'buffalochickenp.jpg', '2022-04-17 21:28:49'),
(10, 'Deep Dish Pizza', '10.00', 'The classic deep dish pizza made with mozzerlla cheese and topped with tomato sauce', 2, 'deepdishp.jpg', '2022-04-17 21:28:06'),
(9, 'Penne Vodka Pizza', '10.00', 'A pizza that is topped with penne vodka', 2, 'pennevodkap.jpg', '2022-04-17 21:27:21'),
(8, 'Hawaiian Pizza', '9.00', 'A pizza that is topped with pineapple and ham', 2, 'hawaiianp.jpg', '2022-04-17 21:26:31'),
(7, 'Margherita Pizza', '9.00', 'The most popular Marghertia pizza made with tomato sauce and mozzerella cheese', 2, 'margheritap.jpg', '2022-04-17 21:25:42'),
(5, 'White Pizza', '7.00', 'A pizza with riccota cheese and garlish in herbs', 1, 'whitep.jpg', '2022-04-17 21:23:48'),
(6, 'Vegetarian Pizza', '6.00', 'A vegetarian pizza that is topped with vegetables', 1, 'vegetarianp.jpg', '2022-04-17 21:24:38'),
(4, 'Pepperoine Pizza', '6.00', 'Classic peperoine pizza', 1, 'pepperoinep.jpg', '2022-04-17 21:23:05'),
(3, 'Sicilian Cheese Pizza', '6.00', 'A pizza that is extremely delicious', 1, 'siciliancp.jpg', '2022-04-17 21:22:07'),
(1, 'Cheese Pizza', '5.00', 'A plain pizza', 1, 'cheesep.jpg', '2022-04-17 21:03:26'),
(2, 'Gluten Free Pizza', '6.00', 'The first ever gluten free pizza', 1, 'glutenfp.jpg', '2022-04-17 21:20:58'),
(26, 'Crispy Chicken Salad', '5.00', 'Crispy chicken with with lettuce, tomato, onion, cucumber, and olives then topped with oil', 5, 'ccsalad.jpg', '2022-04-17 21:48:44'),
(27, 'Greek Salad', '4.00', 'A salad with lettuce, tomato, onion, cucumber, and olives', 5, 'greeks.jpg', '2022-04-17 21:49:36'),
(28, 'Water Bottle', '1.00', 'A water bottle', 6, 'waterbottle.jpg', '2022-04-17 21:50:20'),
(29, 'Ice Tea', '2.00', 'Fresh ice tea made by tea and lemons', 6, 'icetea.jpg', '2022-04-17 22:01:33'),
(30, 'Strawberry Lemonade', '2.00', 'Freshly squeeze lemons with starberry puree', 6, 'strawberryl.jpg', '2022-04-17 22:02:50'),
(38, 'test', '1.00', 'testing', 1, 'NewProduct.jpg', '2022-05-08 12:51:39');

--
-- Triggers `product`
--
DELIMITER $$
CREATE TRIGGER `Populate Img` BEFORE INSERT ON `product` FOR EACH ROW SET NEW.`Img` = CASE WHEN NEW.Img IS NULL THEN 'NewProduct.jpg' ELSE NEW.Img END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(21) NOT NULL,
  `username` varchar(21) NOT NULL,
  `firstName` varchar(21) NOT NULL,
  `lastName` varchar(21) NOT NULL,
  `email` varchar(35) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `userType` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=user\r\n1=admin',
  `password` varchar(255) NOT NULL,
  `joinDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstName`, `lastName`, `email`, `phone`, `userType`, `password`, `joinDate`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@gmail.com', 1111111111, '1', 'admin', '2021-04-11 11:40:58'),
(2, 'user', 'user', 'user', 'user@gmail.com', 2222222222, '0', 'user', '2021-04-11 11:40:58'),
(10, 'test', 'test', 'demo', 'test@gmail.com', 1231231111, '0', 'test', '2022-05-07 18:44:54'),
(11, 'testing', 'test', 'demo', 'test@demo.com', 1231233312, '0', 'test', '2022-05-07 19:08:57'),
(12, 'est', 'test', 'fr', 'fr@test.com', 1231231230, '0', 'frtest', '2022-05-08 12:49:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categorieId`);
ALTER TABLE `categories` ADD FULLTEXT KEY `name` (`name`,`description`);

--
-- Indexes for table `deliverydetails`
--
ALTER TABLE `deliverydetails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orderId` (`orderId`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categorieId` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `deliverydetails`
--
ALTER TABLE `deliverydetails`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
