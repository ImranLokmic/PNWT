-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2021 at 10:02 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `food` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `food`, `code`, `price`, `image`) VALUES
(1, 'Fanta', 'soft', 'SFNT', 3.00, 'productimages/drinks/soft/fanta.jpg'),
(2, 'Whiskey Neat', 'alch', 'AWHSKY', 7.00, 'productimages/drinks/alcohol/whiskey.jpg'),
(3, 'Barbecue Ribs', 'bbq', 'BRBS', 20.00, 'productimages/bbq/ribs.jpg'),
(4, 'French Fries', 'app', 'AFRS', 5.00, 'productimages/appetisers/frenchfries.jpg'),
(5, 'Spaghetti Bolognese', 'pasta', 'SPGBLG', 17.00, 'productimages/pasta/bolognese.jpg'),
(6, 'Margaritha', 'pizza', 'PMRG', 14.00, 'productimages/pizza/margaritha.jpg'),
(7, 'Cesar Salad', 'salad', 'SCSR', 11.00, 'productimages/salads/cesarsalad.jpg'),
(8, 'New York Strip', 'steaks', 'SNYS', 35.00, 'productimages/steaks/newyorkstrip.jpg'),
(9, 'Coca-Cola', 'soft', 'SCCL', 3.00, 'productimages/drinks/soft/cola.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
