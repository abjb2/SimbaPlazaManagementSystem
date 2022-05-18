-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2022 at 01:29 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simbaplaza`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
                              `admin_id` int(10) NOT NULL,
                              `admin_username` varchar(30) NOT NULL,
                              `admin_password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`admin_id`, `admin_username`, `admin_password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
                           `booking_id` int(10) NOT NULL,
                           `title` varchar(5) NOT NULL,
                           `firstname` text NOT NULL,
                           `lastname` text NOT NULL,
                           `email` varchar(50) NOT NULL,
                           `phone` varchar(15) NOT NULL,
                           `roomtype` varchar(15) NOT NULL,
                           `floor` varchar(15) NOT NULL,
                           `checkin` date NOT NULL,
                           `checkout` date NOT NULL,
                           `nodays` int(11) NOT NULL,
                           `booking_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
                           `payment_id` int(11) NOT NULL,
                           `title` varchar(5) NOT NULL,
                           `firstname` varchar(30) NOT NULL,
                           `lastname` varchar(30) NOT NULL,
                           `email` varchar(50) NOT NULL,
                           `phone` varchar(15) NOT NULL,
                           `roomtype` varchar(30) NOT NULL,
                           `floor` varchar(30) NOT NULL,
                           `checkin` date NOT NULL,
                           `checkout` date NOT NULL,
                           `nodays` int(11) NOT NULL,
                           `roomprice` double(8,2) NOT NULL,
  `deposit` double(8,2) NOT NULL,
  `booking_total` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `title`, `firstname`, `lastname`, `email`, `phone`, `roomtype`, `floor`, `checkin`, `checkout`, `nodays`, `roomprice`, `deposit`, `booking_total`) VALUES
(15, 'Mrs.', 'Shamsa', 'Abubakar', 'abubakarshamsa4@gmail.com', '0722721648', '2 Bedroom', '2nd Floor', '2022-04-28', '2022-04-28', 0, 102.00, 50.00, 50.00),
(16, 'Mr.', 'Abeid', 'Mohamed', 'maskauto@hotmail.com', '0722410175', '1 Bedroom', '2nd Floor', '2022-05-05', '2022-05-05', 0, 51.00, 50.00, 50.00);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
                         `room_id` int(10) UNSIGNED NOT NULL,
                         `room_type` varchar(15) NOT NULL,
                         `room_floor` varchar(15) NOT NULL,
                         `room_availability` varchar(15) NOT NULL,
                         `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_type`, `room_floor`, `room_availability`, `client_id`) VALUES
(7, '1 Bedroom', '1st Floor', 'Free', 0),
(8, '2 Bedroom', '1st Floor', 'Free', NULL),
(9, '3 Bedroom', '1st Floor', 'Free', NULL),
(10, '4 Bedroom', '1st Floor', 'Free', 0),
(11, '1 Bedroom', '2nd Floor', 'Free', 0),
(12, '2 Bedroom', '2nd Floor', 'Free', 0),
(13, '3 Bedroom', '2nd Floor', 'Free', NULL),
(14, '4 Bedroom', '2nd Floor', 'Free', NULL),
(15, '1 Bedroom', '3rd Floor', 'Free', NULL),
(16, '2 Bedroom', '3rd Floor', 'Free', NULL),
(17, '3 Bedroom', '3rd Floor', 'Free', NULL),
(18, '4 Bedroom', '3rd Floor', 'Free', NULL),
(20, '1 Bedroom', '4th Floor', 'Free', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
    ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
    ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
    ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
    ADD PRIMARY KEY (`room_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
    MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
    MODIFY `booking_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
    MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
    MODIFY `room_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
