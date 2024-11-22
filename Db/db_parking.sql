-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2024 at 08:10 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_parking`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(60) NOT NULL,
  `admin_email` varchar(60) NOT NULL,
  `admin_password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'aaa', 'aa12@gmail.com', 'Aa@12345');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `booking_id` int(11) NOT NULL,
  `booking_date` varchar(100) NOT NULL,
  `booking_status` int(11) NOT NULL DEFAULT 0,
  `booking_fordate` varchar(100) NOT NULL,
  `booking_amount` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `slot_id` int(11) NOT NULL,
  `booking_intime` varchar(100) NOT NULL,
  `booking_outtime` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`booking_id`, `booking_date`, `booking_status`, `booking_fordate`, `booking_amount`, `user_id`, `slot_id`, `booking_intime`, `booking_outtime`) VALUES
(7, '2024-10-08', 2, '2024-10-08', '100', 1, 23, '13:04:50', '15:11:35'),
(8, '2024-10-15', 0, '2024-10-16', '20', 1, 28, '', ''),
(9, '2024-10-15', 0, '2024-10-17', '20', 1, 28, '', ''),
(10, '2024-10-15', 2, '2024-10-15', '20', 1, 28, '10:08:18', ''),
(11, '2024-10-15', 1, '2024-10-15', '50', 1, 23, '15:49:17', ''),
(12, '2024-10-26', 0, '2024-10-26', '50', 1, 23, '', ''),
(13, '2024-10-26', 2, '2024-10-26', '50', 1, 27, '11:43:50', ''),
(14, '2024-10-26', 1, '2024-10-26', '20', 1, 28, '11:46:14', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaint`
--

CREATE TABLE `tbl_complaint` (
  `complaint_id` int(11) NOT NULL,
  `complaint_title` varchar(90) NOT NULL,
  `complaint_content` varchar(100) NOT NULL,
  `complaint_status` int(11) NOT NULL DEFAULT 0,
  `complaint_date` varchar(90) NOT NULL,
  `complaint_reply` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_complaint`
--

INSERT INTO `tbl_complaint` (`complaint_id`, `complaint_title`, `complaint_content`, `complaint_status`, `complaint_date`, `complaint_reply`, `user_id`, `owner_id`) VALUES
(1, 'hjj', 'fgvfbhf', 1, '2024-10-11', 'mhjm', 1, 0),
(2, 'ghhe', 'egrtgrh', 0, '2024-10-11', '', 2, 0),
(4, 'rgth', 'thytj', 1, '2024-10-11', 'nmn', 0, 1),
(5, 'ss', 'sde', 0, '2024-10-26', '', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE `tbl_district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`district_id`, `district_name`) VALUES
(1, 'Idukki'),
(2, 'Kottayam'),
(4, 'Alappuzha'),
(5, 'Kozhikode');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_owner`
--

CREATE TABLE `tbl_owner` (
  `owner_id` int(11) NOT NULL,
  `owner_name` varchar(90) NOT NULL,
  `owner_email` varchar(90) NOT NULL,
  `owner_contact` varchar(90) NOT NULL,
  `owner_password` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_owner`
--

INSERT INTO `tbl_owner` (`owner_id`, `owner_name`, `owner_email`, `owner_contact`, `owner_password`) VALUES
(1, 'ccc', 'cc12@gmail.com', '6123456700', 'Cc@123456'),
(2, 'ggg', 'gg12@gmail.com', '7654321906', 'Gg@34567'),
(3, 'hhh', 'hh12@gmail.com', '9012345678', 'Hh@56789');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_place`
--

CREATE TABLE `tbl_place` (
  `place_id` int(11) NOT NULL,
  `place_name` varchar(80) NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_place`
--

INSERT INTO `tbl_place` (`place_id`, `place_name`, `district_id`) VALUES
(1, 'Thodupuzha', 1),
(2, 'Pala', 2),
(3, 'Kavalam', 4),
(4, 'Ambalappuzha', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_plot`
--

CREATE TABLE `tbl_plot` (
  `plot_id` int(11) NOT NULL,
  `plot_address` varchar(90) NOT NULL,
  `plot_photo` varchar(200) NOT NULL,
  `place_id` int(11) NOT NULL,
  `plot_status` int(11) NOT NULL DEFAULT 0,
  `plot_proof` varchar(200) NOT NULL,
  `plot_date` varchar(90) NOT NULL,
  `bike_fee` varchar(90) NOT NULL,
  `car_fee` varchar(90) NOT NULL,
  `owner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_plot`
--

INSERT INTO `tbl_plot` (`plot_id`, `plot_address`, `plot_photo`, `place_id`, `plot_status`, `plot_proof`, `plot_date`, `bike_fee`, `car_fee`, `owner_id`) VALUES
(1, 'Near private bus stand ,Thodupuzha', '18246172_v986-bg-10.jpg', 1, 0, '38680618_8664875.jpg', '2024-10-02', '20', '50', 1),
(2, 'Near Temple road,pala', 'Screenshot 2023-11-26 160141.png', 2, 0, 'Screenshot 2023-11-26 160147.png', '2024-10-02', '20', '50', 2),
(3, 'abc', 'Screenshot 2023-11-24 104129.png', 4, 0, 'Screenshot 2023-11-26 160207.png', '2024-10-02', '20', '50', 3),
(4, 'vbc', 'Screenshot 2023-11-26 160402.png', 1, 0, 'Screenshot 2023-11-26 160420.png', '2024-10-02', '20', '50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review`
--

CREATE TABLE `tbl_review` (
  `review_id` int(11) NOT NULL,
  `review_datetime` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_rating` varchar(90) NOT NULL,
  `user_review` varchar(90) NOT NULL,
  `plot_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_review`
--

INSERT INTO `tbl_review` (`review_id`, `review_datetime`, `user_id`, `user_rating`, `user_review`, `plot_id`) VALUES
(2, '2024-10-11 17:14:46', 1, '5', 'Good Service', 1),
(3, '2024-10-14 21:22:12', 1, '5', 'Hi', 1),
(8, '2024-10-14 21:40:07', 1, '3', 'huii', 1),
(9, '2024-10-14 21:41:12', 1, '3', 'ddf', 1),
(10, '2024-10-15 10:11:23', 1, '5', 'good', 2),
(11, '2024-10-26 11:47:19', 1, '5', 'Good', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slot`
--

CREATE TABLE `tbl_slot` (
  `slot_id` int(11) NOT NULL,
  `plot_id` int(11) NOT NULL,
  `slot_status` int(11) NOT NULL DEFAULT 0,
  `slot_count` varchar(300) NOT NULL,
  `slottype_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_slot`
--

INSERT INTO `tbl_slot` (`slot_id`, `plot_id`, `slot_status`, `slot_count`, `slottype_id`) VALUES
(23, 1, 0, '50', 1),
(24, 1, 0, '70', 2),
(25, 4, 0, '70', 1),
(26, 4, 0, '50', 2),
(27, 2, 0, '3', 1),
(28, 2, 0, '90', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slottype`
--

CREATE TABLE `tbl_slottype` (
  `slottype_id` int(11) NOT NULL,
  `slottype_name` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_slottype`
--

INSERT INTO `tbl_slottype` (`slottype_id`, `slottype_name`) VALUES
(1, 'Car'),
(2, 'Bike');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(80) NOT NULL,
  `user_email` varchar(80) NOT NULL,
  `user_contact` varchar(80) NOT NULL,
  `user_password` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_email`, `user_contact`, `user_password`) VALUES
(1, 'bbb', 'bb12@gmail.com', '6721345679', 'Bb@123456'),
(2, 'ddd', 'dd12@gmail.com', '8934127800', 'Dd@12345'),
(3, 'eee', 'ee12@gmail.com', '7812345678', '456'),
(4, 'fff', 'ff12@gmail.com', '7812345600', '789');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `tbl_district`
--
ALTER TABLE `tbl_district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `tbl_owner`
--
ALTER TABLE `tbl_owner`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `tbl_place`
--
ALTER TABLE `tbl_place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `tbl_plot`
--
ALTER TABLE `tbl_plot`
  ADD PRIMARY KEY (`plot_id`);

--
-- Indexes for table `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `tbl_slot`
--
ALTER TABLE `tbl_slot`
  ADD PRIMARY KEY (`slot_id`);

--
-- Indexes for table `tbl_slottype`
--
ALTER TABLE `tbl_slottype`
  ADD PRIMARY KEY (`slottype_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_district`
--
ALTER TABLE `tbl_district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_owner`
--
ALTER TABLE `tbl_owner`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_place`
--
ALTER TABLE `tbl_place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_plot`
--
ALTER TABLE `tbl_plot`
  MODIFY `plot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_review`
--
ALTER TABLE `tbl_review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_slot`
--
ALTER TABLE `tbl_slot`
  MODIFY `slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_slottype`
--
ALTER TABLE `tbl_slottype`
  MODIFY `slottype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
