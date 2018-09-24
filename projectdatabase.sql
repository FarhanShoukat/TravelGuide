-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2018 at 07:58 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `attraction`
--

CREATE TABLE `attraction` (
  `Name` varchar(50) NOT NULL,
  `Destination` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attraction`
--

INSERT INTO `attraction` (`Name`, `Destination`) VALUES
('Minar-e-Pakistan, Circular Rd', 'Lahore, Pakistan'),
('Badshahi Mosque', 'Lahore, Pakistan'),
('Lahore Fort', 'Lahore, Pakistan'),
('Shalimar Gardens', 'Lahore, Pakistan'),
('Wazir Khan Mosque', 'Lahore, Pakistan');

-- --------------------------------------------------------

--
-- Table structure for table `businessclaimrequest`
--

CREATE TABLE `businessclaimrequest` (
  `User` varchar(50) NOT NULL,
  `Business` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `businessclaimrequest`
--

INSERT INTO `businessclaimrequest` (`User`, `Business`) VALUES
('l154292@lhr.nu.edu.pk', 'Luxus Grand Hotel');

-- --------------------------------------------------------

--
-- Table structure for table `businessowner`
--

CREATE TABLE `businessowner` (
  `User` varchar(50) NOT NULL,
  `Business` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `businessowner`
--

INSERT INTO `businessowner` (`User`, `Business`) VALUES
('farhanshoukat0412@gmail.com', 'Luxus Grand Hotel'),
('har@fast.co', 'Friends Cafe\' & Fine Dining Restaurant');

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `Name` varchar(100) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`Name`, `Phone`, `Email`, `Message`) VALUES
('Farhan Shoukat', '3084569845', 'farhanshoukat0412@gmail.com', 'Some Message'),
('Farhan Shoukat', '03084569845', 'farhanshoukat0412@gmail.com', 'checking if working');

-- --------------------------------------------------------

--
-- Table structure for table `destination`
--

CREATE TABLE `destination` (
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `destination`
--

INSERT INTO `destination` (`Name`) VALUES
('Lahore, Pakistan'),
('Murree, Pakistan');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `Title` varchar(100) NOT NULL,
  `Description` varchar(1000) DEFAULT NULL,
  `Address` varchar(100) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Website` varchar(100) DEFAULT NULL,
  `Destination` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`Title`, `Description`, `Address`, `Phone`, `Website`, `Destination`) VALUES
('Hotel One', '', '40/A-2, Mehmood Ali Kasuri Road, Gulberg lll', '04235773181', 'http://www.hotelone.com.pk/', 'Lahore, Pakistan'),
('Hotel Pak Heritage', '', '28 Davis Road', '04236297979', '', 'Lahore, Pakistan'),
('Luxus Grand Hotel', 'Set in an elegant colonial-style building, this upscale hotel is 2 km from Lahore train station and 5 km from the 17th-century, sandstone Badshahi Mosque. The sophisticated rooms offer glass-enclosed bathrooms, and come with free Wi-Fi, flat-screen TVs and safes, as well as minibars, and tea and coffeemaking facilities. Suites add living areas. There\'s 24-hour room service. Valet parking is complimentary. Other amenities include a cafe, an indoor pool, and a cinema with 3 screens.', '4 Egerton Rd. Lahore', '+923201999955', NULL, 'Lahore, Pakistan'),
('Rose Palace Hotel', '', '55-N, Gurumangat Road, Gulberg-II', '03214337172', '', 'Lahore, Pakistan');

-- --------------------------------------------------------

--
-- Table structure for table `hotelrental`
--

CREATE TABLE `hotelrental` (
  `Hotel` varchar(100) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Rental` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hotelrental`
--

INSERT INTO `hotelrental` (`Hotel`, `Title`, `Description`, `Rental`) VALUES
('Luxus Grand Hotel', '', 'test2', 1234),
('Luxus Grand Hotel', 'Deluxe Double Room', '2 guests - breakfast - refundable', 16969),
('Luxus Grand Hotel', 'Deluxe Twin Room', '2 guests - breakfast - refundable', 16969),
('Luxus Grand Hotel', 'Executive Double Room', '2 guests - breakfast - refundable', 20327),
('Luxus Grand Hotel', 'Royal Double Room', '2 guests - breakfast - refundable', 23682),
('Luxus Grand Hotel', 'Royal Suite', '2 guests - breakfast', 19488);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `User` varchar(50) NOT NULL,
  `Facility` varchar(100) NOT NULL,
  `FacilityType` int(11) NOT NULL,
  `Rating` int(11) NOT NULL,
  `Review` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`User`, `Facility`, `FacilityType`, `Rating`, `Review`) VALUES
('109871419884111', 'Luxus Grand Hotel', 0, 5, 'my review from fcebook account'),
('111444773059766', 'Friends Cafe\' & Fine Dining Restaurant', 1, 3, ''),
('111444773059766', 'Luxus Grand Hotel', 0, 4, ''),
('114228939448424', 'Luxus Grand Hotel', 0, 2, ''),
('farhanshoukat0412@gmail.com', 'Luxus Grand Hotel', 0, 4, 'good place'),
('har@fast.co', 'Al-Nakhal Arabian Cuisine', 1, 3, 'good place'),
('har@fast.co', 'Friends Cafe\' & Fine Dining Restaurant', 1, 4, ''),
('har@fast.co', 'Luxus Grand Hotel', 0, 5, 'Loved the place'),
('l154292@lhr.nu.edu.pk', 'Friends Cafe\' & Fine Dining Restaurant', 1, 5, 'Loved the place');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `Title` varchar(100) NOT NULL,
  `Description` varchar(1000) DEFAULT NULL,
  `Address` varchar(100) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Website` varchar(100) DEFAULT NULL,
  `Destination` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`Title`, `Description`, `Address`, `Phone`, `Website`, `Destination`) VALUES
('Al-Nakhal Arabian Cuisine', NULL, 'Near Shaukat Khanum Hospital, Khayaban-e-Firdousi', '+924235314401', 'http://www.alnakhal.com.pk/', 'Lahore, Pakistan'),
('Friends Cafe\' & Fine Dining Restaurant', '', 'Society Office, Block R 1 Phase 2 Johar Town', '03008291570', '', 'Lahore, Pakistan');

-- --------------------------------------------------------

--
-- Table structure for table `restaurantdeal`
--

CREATE TABLE `restaurantdeal` (
  `Restaurant` varchar(100) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurantdeal`
--

INSERT INTO `restaurantdeal` (`Restaurant`, `Title`, `Description`, `Price`) VALUES
('Friends Cafe\' & Fine Dining Restaurant', 'Cheese Fries', '', 495),
('Friends Cafe\' & Fine Dining Restaurant', 'Dynamite Chickens', '', 399),
('Friends Cafe\' & Fine Dining Restaurant', 'Dynamite Pawns', '', 589),
('Friends Cafe\' & Fine Dining Restaurant', 'Fish & Chips', '', 499),
('Friends Cafe\' & Fine Dining Restaurant', 'Fries Basket', '', 290),
('Friends Cafe\' & Fine Dining Restaurant', 'High Fire Wings', '', 489),
('Friends Cafe\' & Fine Dining Restaurant', 'Texas Fries', '', 499);

-- --------------------------------------------------------

--
-- Table structure for table `travelinformation`
--

CREATE TABLE `travelinformation` (
  `TravelCompany` varchar(100) NOT NULL,
  `Source` varchar(50) NOT NULL,
  `Destination` varchar(50) NOT NULL,
  `Type` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `travelinformation`
--

INSERT INTO `travelinformation` (`TravelCompany`, `Source`, `Destination`, `Type`, `Date`, `Time`, `Price`) VALUES
('PIA', 'Lahore, Pakistan', 'Murree, Pakistan', 0, '2018-04-25', '07:00:00', 20000),
('Saudia Airlines', 'Lahore, Pakistan', 'Murree, Pakistan', 0, '2018-04-25', '07:00:00', 18000),
('Saudia Airlines', 'Lahore, Pakistan', 'Murree, Pakistan', 0, '2018-04-27', '08:00:00', 18000),
('Bilal Travel Bus Service', 'Lahore, Pakistan', 'Murree, Pakistan', 1, '2018-05-03', '12:00:00', 8000),
('Niazi Express', 'Lahore, Pakistan', 'Murree, Pakistan', 1, '2018-05-04', '12:00:00', 7000),
('Daewoo Express', 'Lahore, Pakistan', 'Murree, Pakistan', 1, '2018-05-01', '13:00:00', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Name` varchar(50) NOT NULL COMMENT 'user name',
  `Email` varchar(50) NOT NULL COMMENT 'user email. also user id',
  `Password` varchar(50) DEFAULT NULL COMMENT 'user password'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='table representing user data';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Name`, `Email`, `Password`) VALUES
('Open Graph Test User', '109594273244696', NULL),
('Farhan Shoukat', '109871419884111', NULL),
('Haris Muneer', '111444773059766', NULL),
('Ali Test', '114228939448424', NULL),
('Farhan Shoukat', '804239509774377', NULL),
('Farhan Shoukat', 'farhanshoukat0412@gmail.com', 'Farh04'),
('Haris Muneer', 'har@fast.co', 'Haris123'),
('Farhan Shoukat', 'l154292@lhr.nu.edu.pk', 'Farhan04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attraction`
--
ALTER TABLE `attraction`
  ADD KEY `Destination` (`Destination`);

--
-- Indexes for table `businessclaimrequest`
--
ALTER TABLE `businessclaimrequest`
  ADD PRIMARY KEY (`User`);

--
-- Indexes for table `businessowner`
--
ALTER TABLE `businessowner`
  ADD PRIMARY KEY (`User`);

--
-- Indexes for table `destination`
--
ALTER TABLE `destination`
  ADD PRIMARY KEY (`Name`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`Title`),
  ADD KEY `Destination` (`Destination`);

--
-- Indexes for table `hotelrental`
--
ALTER TABLE `hotelrental`
  ADD PRIMARY KEY (`Title`,`Hotel`),
  ADD KEY `Hotel` (`Hotel`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`User`,`Facility`,`FacilityType`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`Title`),
  ADD KEY `Destination` (`Destination`);

--
-- Indexes for table `restaurantdeal`
--
ALTER TABLE `restaurantdeal`
  ADD PRIMARY KEY (`Restaurant`,`Title`);

--
-- Indexes for table `travelinformation`
--
ALTER TABLE `travelinformation`
  ADD KEY `Source` (`Source`),
  ADD KEY `Destination` (`Destination`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attraction`
--
ALTER TABLE `attraction`
  ADD CONSTRAINT `attraction_ibfk_1` FOREIGN KEY (`Destination`) REFERENCES `destination` (`Name`);

--
-- Constraints for table `businessclaimrequest`
--
ALTER TABLE `businessclaimrequest`
  ADD CONSTRAINT `businessclaimrequest_ibfk_1` FOREIGN KEY (`User`) REFERENCES `user` (`Email`);

--
-- Constraints for table `businessowner`
--
ALTER TABLE `businessowner`
  ADD CONSTRAINT `businessowner_ibfk_1` FOREIGN KEY (`User`) REFERENCES `user` (`Email`);

--
-- Constraints for table `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `hotel_ibfk_1` FOREIGN KEY (`Destination`) REFERENCES `destination` (`Name`);

--
-- Constraints for table `hotelrental`
--
ALTER TABLE `hotelrental`
  ADD CONSTRAINT `hotelrental_ibfk_1` FOREIGN KEY (`Hotel`) REFERENCES `hotel` (`Title`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`User`) REFERENCES `user` (`Email`);

--
-- Constraints for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD CONSTRAINT `restaurant_ibfk_1` FOREIGN KEY (`Destination`) REFERENCES `destination` (`Name`);

--
-- Constraints for table `restaurantdeal`
--
ALTER TABLE `restaurantdeal`
  ADD CONSTRAINT `restaurantdeal_ibfk_1` FOREIGN KEY (`Restaurant`) REFERENCES `restaurant` (`Title`);

--
-- Constraints for table `travelinformation`
--
ALTER TABLE `travelinformation`
  ADD CONSTRAINT `travelinformation_ibfk_1` FOREIGN KEY (`Source`) REFERENCES `destination` (`Name`),
  ADD CONSTRAINT `travelinformation_ibfk_2` FOREIGN KEY (`Destination`) REFERENCES `destination` (`Name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
