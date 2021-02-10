-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2021 at 10:10 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dsf`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(255) NOT NULL,
  `request_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `time` timestamp(4) NOT NULL DEFAULT current_timestamp(4)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `request_id`, `user_id`, `comment`, `user_name`, `image`, `time`) VALUES
(59, 23, 8, 'wait for request accept', 'Saads Rouf', ' 5dc81765d54e03.76196265.png', '2019-11-16 00:49:11.0828'),
(60, 23, 2, 'ok', 'Saad Sabit', ' 5dc7fa49d4e067.23406453.jpg', '2019-11-16 00:49:16.6085'),
(61, 21, 8, 'hi', 'Saads Rouf', ' 5dc81765d54e03.76196265.png', '2019-11-28 03:51:55.8483'),
(62, 40, 2, 'hi', 'Saad Sabit', ' 5dc7fa49d4e067.23406453.jpg', '2019-12-13 17:31:29.2246'),
(63, 40, 8, 'hello', 'Saads Rouf', ' 5dc81765d54e03.76196265.png', '2019-12-13 17:31:58.5541'),
(64, 40, 2, 'hello', 'Saad Sabit', ' 5dc7fa49d4e067.23406453.jpg', '2019-12-20 07:13:30.7426'),
(65, 40, 8, 'hi', 'Saads Rouf', ' 5dc81765d54e03.76196265.png', '2019-12-20 07:13:36.1283'),
(66, 21, 19, 'hello', 'MAJOR MD.  MOIN UDDIN', ' profile2.png', '2020-01-06 04:46:30.5791');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `dept` varchar(100) NOT NULL,
  `phone` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `first_name`, `last_name`, `dept`, `phone`) VALUES
(1, 'SKBA', 'Aurnab', 'Requisition', '01700000001'),
(2, 'Sajjad', 'Alam', 'IT', '0111111112'),
(3, 'Nurul', 'Amin', 'Furniture', '0111111113'),
(4, 'Ambika', 'Sarkar', 'IT', '0111111114'),
(5, 'Haider', 'Ali', 'IT', '0111111115');

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

CREATE TABLE `fields` (
  `id` int(11) NOT NULL,
  `label` varchar(100) NOT NULL,
  `component_name` varchar(100) NOT NULL,
  `form_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`id`, `label`, `component_name`, `form_id`) VALUES
(1, 'IT Problem', 'text-area', 1),
(2, 'Room Number', 'text-box', 0),
(3, 'Floor', 'text-box', 0),
(4, 'Problem Details', 'text-area', 0),
(6, 'Building no./Name', 'text-box', 0),
(8, 'Furniture Problem', 'combo-box', 2),
(9, 'Electric Problem', 'combo-box', 3),
(10, 'Priority', 'combo-box', 0),
(11, 'Required Date', 'date', 0),
(37, 'it1', 'text-box', 1),
(48, 'zzz', 'text-box', 1),
(49, 'asdasd', 'text-area', 8),
(53, 'Name of Faculty/Staff:', 'text-box', 10),
(54, 'Designation with School/Dept./Instt.:', 'text-box', 10),
(55, 'Contact No.:', 'text-box', 10),
(56, 'Contact Point*: (from where you intend to board on the Microbus)', 'text-box', 10),
(57, 'test1', 'date', 11),
(58, 'shaeen', 'text-box', 3);

-- --------------------------------------------------------

--
-- Table structure for table `field_types`
--

CREATE TABLE `field_types` (
  `fieldid` int(255) NOT NULL,
  `field_type` varchar(100) NOT NULL,
  `field_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `field_types`
--

INSERT INTO `field_types` (`fieldid`, `field_type`, `field_name`) VALUES
(1, 'text-box', 'Text Box'),
(2, 'text-area', 'Text Area'),
(3, 'combo-box', 'Drop Down'),
(4, 'date', 'Date');

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `form_id` int(100) NOT NULL,
  `form_name` varchar(100) NOT NULL,
  `visible` int(1) NOT NULL DEFAULT 4,
  `type_name` varchar(100) NOT NULL,
  `publish` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`form_id`, `form_name`, `visible`, `type_name`, `publish`) VALUES
(1, 'IT', 1, 'IT', '2'),
(2, 'Furniture', 1, 'Furniture', '2'),
(3, 'Electrics', 1, 'Electrics', '2'),
(4, 'Requisition', 1, 'Requisition', '2'),
(10, 'UIU TRANSPORTATION SERVICE', 4, 'Application', '2'),
(11, 'test', 1, 'IT', '');

-- --------------------------------------------------------

--
-- Table structure for table `form_types`
--

CREATE TABLE `form_types` (
  `id` int(255) NOT NULL,
  `type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_types`
--

INSERT INTO `form_types` (`id`, `type_name`) VALUES
(1, 'IT'),
(2, 'Furniture'),
(3, 'Electrics'),
(4, 'Requisition'),
(5, 'Faculty Member'),
(6, 'Student'),
(7, 'Application');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_temp`
--

CREATE TABLE `password_reset_temp` (
  `email` varchar(250) NOT NULL,
  `key` varchar(250) NOT NULL,
  `expDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `password_reset_temp`
--

INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`) VALUES
('sabit.cseuiu@gmail.com', '768e78024aa8fdb9b8fe87be86f647454f56f7a9b0', '2019-11-28 13:56:45');

-- --------------------------------------------------------

--
-- Table structure for table `problem`
--

CREATE TABLE `problem` (
  `dropdown_id` int(100) NOT NULL,
  `form_id` int(11) NOT NULL,
  `option_name` varchar(100) NOT NULL,
  `label` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `problem`
--

INSERT INTO `problem` (`dropdown_id`, `form_id`, `option_name`, `label`) VALUES
(1, 1, 'PC', 'IT Problem'),
(2, 1, 'Telephone', 'IT Problem'),
(3, 1, 'Printer', 'IT Problem'),
(4, 1, 'Photocopy Machine', 'IT Problem'),
(5, 1, 'Advertising Monitor', 'IT Problem'),
(6, 1, 'Router', 'IT Problem'),
(7, 2, 'Table', 'Furniture Problem'),
(8, 2, 'Chair', 'Furniture Problem'),
(9, 2, 'Bookshelf', 'Furniture Problem'),
(10, 2, 'Locker', 'Furniture Problem'),
(11, 2, 'Sofa', 'Furniture Problem'),
(12, 3, 'Light', 'Electric Problem'),
(13, 3, 'Switch', 'Electric Problem'),
(14, 3, 'Fan', 'Electric Problem'),
(15, 3, 'AC', 'Electric Problem'),
(16, 0, 'Low', 'Priority'),
(17, 0, 'Normal', 'Priority'),
(18, 0, 'High', 'Priority'),
(19, 0, 'Urgent', 'Priority'),
(20, 0, 'None', 'None'),
(21, 0, 'N/A', 'N/A'),
(31, 11, 'gg1', 'g2'),
(32, 11, 'gg2', 'g2'),
(33, 11, 'gg3', 'g2'),
(34, 12, 'male', 'gender'),
(35, 12, 'female', 'gender'),
(36, 22, 'asdasd', 'asdad'),
(62, 41, 'asdasd', 'asd'),
(63, 17, 'wewef', 'brand'),
(64, 5, 'dasd', 'czcs'),
(65, 5, 'sdasd', 'czcs'),
(66, 7, 'rwrer', 'asdasd');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `requiest_id` int(255) NOT NULL,
  `service_receiver_id` int(255) NOT NULL,
  `form_id` int(50) NOT NULL,
  `date_time` datetime(4) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `form_type` varchar(100) NOT NULL,
  `employee_id` int(255) NOT NULL,
  `updated_on` datetime(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`requiest_id`, `service_receiver_id`, `form_id`, `date_time`, `status`, `form_type`, `employee_id`, `updated_on`) VALUES
(21, 8, 2, '2019-10-03 00:00:00.0000', 0, 'Furniture', 0, '2020-01-06 20:23:04.0000'),
(22, 7, 3, '2019-10-07 00:00:00.0000', 0, 'Electrics', 0, '0000-00-00 00:00:00.0000'),
(23, 8, 1, '2019-10-20 00:00:00.0000', 3, 'IT', 1, '2019-11-21 12:12:12.0000'),
(31, 8, 3, '0000-00-00 00:00:00.0000', 0, 'Electrics', 0, '0000-00-00 00:00:00.0000'),
(32, 8, 1, '2019-11-21 14:24:31.0000', 2, 'IT', 2, '2019-11-21 14:24:31.0000'),
(34, 8, 4, '2019-11-24 10:08:14.0000', 4, 'Requisition', 0, '0000-00-00 00:00:00.0000'),
(35, 8, 1, '2019-11-25 17:02:30.0000', 0, 'IT', 0, '0000-00-00 00:00:00.0000'),
(36, 8, 1, '2019-11-25 17:04:32.0000', 2, 'IT', 1, '2019-12-05 12:04:00.0000'),
(37, 8, 1, '2019-12-05 12:11:23.0000', 1, 'IT', 2, '2019-12-05 12:20:23.0000'),
(38, 8, 1, '2019-12-05 12:21:02.0000', 1, 'IT', 1, '2019-12-05 12:34:16.0000'),
(39, 8, 1, '2019-12-05 12:24:29.0000', 0, 'IT', 0, '2020-01-05 14:27:08.0000'),
(41, 8, 10, '2020-01-15 21:58:51.0000', 0, 'Application', 0, '2020-01-16 00:33:54.0000');

-- --------------------------------------------------------

--
-- Table structure for table `request_type_date`
--

CREATE TABLE `request_type_date` (
  `type_date_id` int(255) NOT NULL,
  `type_date_label` varchar(100) NOT NULL,
  `type_date_requestid` int(255) NOT NULL,
  `type_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_type_date`
--

INSERT INTO `request_type_date` (`type_date_id`, `type_date_label`, `type_date_requestid`, `type_date`) VALUES
(2, 'Required Date', 20, '2019-10-23 18:00:00.000000'),
(3, 'Required Date', 21, '2019-10-04 18:00:00.000000'),
(4, 'Required Date', 22, '2019-10-01 18:00:00.000000'),
(5, 'Required Date', 23, '2019-10-21 18:00:00.000000'),
(9, 'Required Date', 31, '2019-11-29 18:00:00.000000'),
(10, 'Required Date', 32, '2019-11-28 18:00:00.000000'),
(12, 'Required Date', 34, '2019-11-20 18:00:00.000000'),
(13, 'Required Date', 35, '2019-11-25 18:00:00.000000'),
(14, 'Required Date', 36, '2019-11-26 18:00:00.000000'),
(15, 'Required Date', 37, '2019-12-05 18:00:00.000000'),
(16, 'Required Date', 38, '2019-12-06 18:00:00.000000'),
(17, 'Required Date', 39, '2019-12-09 18:00:00.000000'),
(18, 'Required Date', 40, '2019-12-13 18:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `request_type_dropdown`
--

CREATE TABLE `request_type_dropdown` (
  `type_dropdown_id` int(255) NOT NULL,
  `type_dropdown_label` varchar(100) NOT NULL,
  `type_dropdown_value` varchar(100) NOT NULL,
  `type_dropdown_requestid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_type_dropdown`
--

INSERT INTO `request_type_dropdown` (`type_dropdown_id`, `type_dropdown_label`, `type_dropdown_value`, `type_dropdown_requestid`) VALUES
(7, 'Priority', 'Normal', 20),
(8, 'b', 'b1', 20),
(9, 'Furniture Problem', 'Bookshelf', 21),
(10, 'Priority', 'High', 21),
(17, 'IT Problem', 'Advertising Monitor', 23),
(18, 'Priority', 'Normal', 23),
(19, 'Electric Problem', 'Fan', 22),
(20, 'Priority', 'Low', 22),
(21, 'Electric Problem', 'AC', 31),
(22, 'Priority', 'High', 31),
(23, 'IT Problem', 'Router', 32),
(24, 'Priority', 'Urgent', 32),
(27, 'Priority', 'Low', 34),
(28, 'IT Problem', 'Photocopy Machine', 35),
(29, 'Priority', 'Normal', 35),
(30, 'IT Problem', 'Telephone', 36),
(31, 'Priority', 'High', 36),
(32, 'IT Problem', 'Printer', 37),
(33, 'Priority', 'Normal', 37),
(34, 'IT Problem', 'PC', 38),
(35, 'Priority', 'Low', 38),
(36, 'IT Problem', 'Advertising Monitor', 39),
(37, 'Priority', 'High', 39),
(38, 'Priority', 'Normal', 40);

-- --------------------------------------------------------

--
-- Table structure for table `request_type_text`
--

CREATE TABLE `request_type_text` (
  `type_text_id` int(255) NOT NULL,
  `type_text_label` varchar(100) NOT NULL,
  `type_text_value` varchar(100) NOT NULL,
  `type_text_requestid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_type_text`
--

INSERT INTO `request_type_text` (`type_text_id`, `type_text_label`, `type_text_value`, `type_text_requestid`) VALUES
(2, 'Problem Details', 'Pc not working', 20),
(4, 'Problem Details', 'broken', 21),
(5, 'Problem Details', 'Fan not working', 22),
(6, 'Problem Details', 'fasdf', 23),
(10, 'Problem Details', 'ac not powering on', 31),
(13, 'Problem Details', 'asd', 34),
(14, 'Problem Details', 'sdf', 35),
(15, 'Problem Details', 'sdf', 36),
(16, 'Problem Details', 'asd', 37),
(17, 'Problem Details', 'sad', 38),
(18, 'Problem Details', 'qwe', 39),
(19, 'Problem Details', 'Need vehicle service', 40);

-- --------------------------------------------------------

--
-- Table structure for table `request_type_textbox`
--

CREATE TABLE `request_type_textbox` (
  `type_textbox_id` int(255) NOT NULL,
  `type_textbox_label` varchar(100) NOT NULL,
  `type_textbox_value` text NOT NULL,
  `type_textbox_requestid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_type_textbox`
--

INSERT INTO `request_type_textbox` (`type_textbox_id`, `type_textbox_label`, `type_textbox_value`, `type_textbox_requestid`) VALUES
(13, 'Room Number', '123', 20),
(14, 'Floor', '1st', 20),
(15, 'Building no./Name', 'BBA', 20),
(17, 'Room Number', '412', 21),
(18, 'Floor', '4th', 21),
(19, 'Building no./Name', 'CSE', 21),
(20, 'Room Number', '405', 22),
(21, 'Floor', '4th', 22),
(22, 'Building no./Name', 'EEE', 22),
(23, 'Room Number', '511', 23),
(24, 'Floor', '5th', 23),
(25, 'Building no./Name', 'ENG', 23),
(26, 'it1', '123', 23),
(27, 'zzz', '123', 23),
(39, 'Room Number', '515', 31),
(40, 'Floor', '5th', 31),
(41, 'Building no./Name', '3', 31),
(42, 'Room Number', '415', 32),
(43, 'Floor', '4th', 32),
(44, 'Building no./Name', '411', 32),
(45, 'it1', 'das', 32),
(46, 'zzz', 'ad', 32),
(50, 'Room Number', '231', 34),
(51, 'Floor', '123', 34),
(52, 'Building no./Name', '123', 34),
(53, 'Room Number', '123', 35),
(54, 'Floor', '3rd', 35),
(55, 'Building no./Name', 'dfsdf', 35),
(56, 'it1', 'sdf', 35),
(57, 'zzz', 'sfd', 35),
(58, 'Room Number', '231', 36),
(59, 'Floor', 'asd', 36),
(60, 'Building no./Name', 'da', 36),
(61, 'it1', 'fs', 36),
(62, 'zzz', 'sdf', 36),
(63, 'Room Number', '412', 37),
(64, 'Floor', '4th', 37),
(65, 'Building no./Name', '2', 37),
(66, 'it1', 'asdad', 37),
(67, 'zzz', 'asd', 37),
(68, 'Room Number', '123', 38),
(69, 'Floor', '123', 38),
(70, 'Building no./Name', '12', 38),
(71, 'it1', 'asd', 38),
(72, 'zzz', 'asd', 38),
(73, 'Room Number', '213', 39),
(74, 'Floor', '123', 39),
(75, 'Building no./Name', '123', 39),
(76, 'it1', '1eeq', 39),
(77, 'zzz', 'qwe', 39),
(78, 'Room Number', '412', 40),
(79, 'Floor', '5th', 40),
(80, 'Building no./Name', '1', 40),
(81, 'Name of Faculty/Staff:', 'sabit', 40),
(82, 'Designation with School/Dept./Instt.:', 'lecturer', 40),
(83, 'Contact No.:', '01671763399', 40),
(84, 'Contact Point*: (from where you intend to board on the Microbus)', 'Mirpur', 40),
(85, 'Name of Faculty/Staff:', 'Saad', 41),
(86, 'Designation with School/Dept./Instt.:', 'Lecturer ', 41),
(87, 'Contact No.:', '01671763399', 41),
(88, 'Contact Point*: (from where you intend to board on the Microbus)', 'Mirpur-12', 41);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `status`) VALUES
(1, 'email', 0),
(2, 'sms', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(255) NOT NULL,
  `subscription_key` varchar(100) NOT NULL,
  `package` tinyint(1) NOT NULL DEFAULT 1,
  `exp_date` datetime(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `subscription_key`, `package`, `exp_date`) VALUES
(27, '533e76d521', 3, '2020-12-20 00:00:00.0000');

-- --------------------------------------------------------

--
-- Table structure for table `twilio`
--

CREATE TABLE `twilio` (
  `id` int(11) NOT NULL,
  `sid` varchar(100) NOT NULL,
  `auth` varchar(100) NOT NULL,
  `number` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `twilio`
--

INSERT INTO `twilio` (`id`, `sid`, `auth`, `number`) VALUES
(1, 'SAC749259b3e525dda143d7d2f4897f9256s', 'sd1c8e9e736b1e945896c9640286f9521s', '+1848225897199');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` char(11) NOT NULL,
  `role` int(1) NOT NULL DEFAULT 0,
  `designation` varchar(50) NOT NULL,
  `floor` varchar(100) NOT NULL,
  `room` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `service` varchar(100) DEFAULT NULL,
  `trn_date` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `phone`, `role`, `designation`, `floor`, `room`, `first_name`, `last_name`, `image_name`, `service`, `trn_date`) VALUES
(1, 'admin@gmail.com', '$2y$10$YUG6ejDWQwBaUUG5m8Bxr.KSHEfJlhYV.Rb4FtG6ew.o/jll25tYe', '01671763399', 3, '5', '4th', '412', 'Admin', 'Admin', '5dc7fa49d4e067.23406453.jpg', '', '0000-00-00 00:00:00.000000'),
(2, 'sabit@gmail.com', '$2y$10$SX9N9R0ohkgoVuROxc9a.ONYJ7q5SK.e36DBYS5aM1sJ.1.hYXexe', '987654345', 2, '3', '2nd', '222', 'Saad', 'Sabit', '5dc7fa49d4e067.23406453.jpg', 'Requisition', '0000-00-00 00:00:00.000000'),
(7, 'haider@gmail.com', '$2y$10$jcEYNsDx84I.6JArIBCcxev84uEREG35hPkFK4NpktudSkk1BPr6a', '1122334455', 1, '2', '2nd', '234', 'Haider', 'Ali', 'profile2.png', 'Faculty Member', '0000-00-00 00:00:00.000000'),
(8, 'sabit.cseuiu@gmail.com', '$2y$10$LYKiIMQdn49RBAR4Ij7ABu6BH4zYlPdNuIfQKsO/0PSrrSIo3VHBy', '01671763399', 1, '2', '3rd', '345', 'Saads', 'Rouf', '5dc81765d54e03.76196265.png', 'Faculty Member', '0000-00-00 00:00:00.000000'),
(9, 'ambika@gmail.com', '$2y$10$A6hTPG6dVpIvkWzkm6kdUOiKveSGjwnCAj0lnvY4uS9mVlAyHUdtq', '33445000', 2, '1', '1st', '112', 'Ambika', 'Sarkar', 'profile2.png', 'Furniture', '0000-00-00 00:00:00.000000'),
(10, 'skba@gmail.com', '$2y$10$YTqxIGMJ4Qx1oh10/RrSC.v0T3i./XXvtyuSznol//E3MpvFezuN6', '53453456', 1, '1', '1st', '123', 'Sheikh', 'Aurnab', 'profile2.png', 'Faculty Member', '0000-00-00 00:00:00.000000'),
(15, 'swakkhar@cse.uiu.ac.bd', '$2y$10$saPb1MP30KBuRYOxdD5dU.2ueF4miQhR92IV.W0bsoFsmptGrH0nK', '', 1, '2', '', '', 'SWAKKHAR', 'SHATABDA', 'profile2.png', 'Faculty Member', '0000-00-00 00:00:00.000000'),
(16, 'salekul@cse.uiu.ac.bd', '$2y$10$jHpS1g/zTaknZORvnMA2T.ss2l1C3xI726ndflO7L8q/foN.9xkv.', '', 1, '2', '', '', 'SALEKUL', 'ISLAM', 'profile2.png', '', '0000-00-00 00:00:00.000000'),
(17, 'imam@cse.uiu.ac.bd', '$2y$10$kaZW42MpykFeKN8pxUXmZOXcvnH3vsQ5CwzxTEvUbUJ77f/OG.W9S', '', 1, '2', '', '', 'MOHAMMAD IMAM', 'HOSSAIN', 'profile2.png', '', '0000-00-00 00:00:00.000000'),
(18, 'samad@admin.uiu.ac.bd', '$2y$10$m4n508ds2vMcxrlQ3TgOg.O1wMm8drO//8r388rntZGgghswzebAG', '', 2, '', '', '', 'MOHAMMAD MOINUS', 'SAMAD KHAN', 'profile2.png', 'IT', '0000-00-00 00:00:00.000000'),
(19, 'moinkw@admin.uiu.ac.bd', '$2y$10$wJsfUUJa9LGMtNStwconZu8ZmsUVkvPVCveIABFUNvLD2hmNe3lxW', '', 2, '', '', '', 'MAJOR MD. ', 'MOIN UDDIN', 'profile2.png', 'Furniture', '0000-00-00 00:00:00.000000'),
(20, 'monir@cse.uiu.ac.bd', '$2y$10$oNtT0UD9CLTA0Sd5WHka7eClzikAkeYJuOzEIpRKYa68AqoQbJBMa', '', 2, '3', '4th', '412', 'MIR MOHAMMAD ', 'MONIR', '5dc81765d54e03.76196265.png', 'Application', '0000-00-00 00:00:00.000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fields`
--
ALTER TABLE `fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `field_types`
--
ALTER TABLE `field_types`
  ADD PRIMARY KEY (`fieldid`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`form_id`);

--
-- Indexes for table `form_types`
--
ALTER TABLE `form_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `problem`
--
ALTER TABLE `problem`
  ADD PRIMARY KEY (`dropdown_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`requiest_id`);

--
-- Indexes for table `request_type_date`
--
ALTER TABLE `request_type_date`
  ADD PRIMARY KEY (`type_date_id`);

--
-- Indexes for table `request_type_dropdown`
--
ALTER TABLE `request_type_dropdown`
  ADD PRIMARY KEY (`type_dropdown_id`);

--
-- Indexes for table `request_type_text`
--
ALTER TABLE `request_type_text`
  ADD PRIMARY KEY (`type_text_id`);

--
-- Indexes for table `request_type_textbox`
--
ALTER TABLE `request_type_textbox`
  ADD PRIMARY KEY (`type_textbox_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `twilio`
--
ALTER TABLE `twilio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fields`
--
ALTER TABLE `fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `field_types`
--
ALTER TABLE `field_types`
  MODIFY `fieldid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `form_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `form_types`
--
ALTER TABLE `form_types`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `problem`
--
ALTER TABLE `problem`
  MODIFY `dropdown_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `requiest_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `request_type_date`
--
ALTER TABLE `request_type_date`
  MODIFY `type_date_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `request_type_dropdown`
--
ALTER TABLE `request_type_dropdown`
  MODIFY `type_dropdown_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `request_type_text`
--
ALTER TABLE `request_type_text`
  MODIFY `type_text_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `request_type_textbox`
--
ALTER TABLE `request_type_textbox`
  MODIFY `type_textbox_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `twilio`
--
ALTER TABLE `twilio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
