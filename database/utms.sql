-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2017 at 12:33 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `utms`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `sno` int(10) NOT NULL,
  `member_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `primary_contact` bigint(20) NOT NULL,
  `secondary_contact` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`sno`, `member_name`, `username`, `password`, `primary_contact`, `secondary_contact`, `email`) VALUES
(0, 'Vivek Khurana', 'vkhurana', 'test', 9569793959, 7087105030, 'vkhurana@qasource.com'),
(1, 'Pooja Chadha', 'pchadha', 'test', 9569793959, 95959996, 'pchadha@qasource.com'),
(2, 'Manpreet Singh Gill', 'mgill', 'test', 956979395, 95959996, 'mgill@qasource.com');

-- --------------------------------------------------------

--
-- Table structure for table `team_task`
--

CREATE TABLE `team_task` (
  `sno` int(10) NOT NULL,
  `category` varchar(50) NOT NULL,
  `user_story` varchar(50) NOT NULL,
  `task_id` varchar(50) NOT NULL,
  `task_summary` varchar(800) NOT NULL,
  `status` varchar(20) NOT NULL,
  `task_owner` varchar(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team_task`
--

INSERT INTO `team_task` (`sno`, `category`, `user_story`, `task_id`, `task_summary`, `status`, `task_owner`, `date`) VALUES
(1, 'Dev-Ops', 'US95677', 'TA232665', 'AT - Infrastructure Rave', 'In-Progress', 'Vivek Khurana', '2017-02-26'),
(2, 'Dev-Ops', 'US95677', 'TA254494', 'AT - Ansible', 'Complete', 'Vivek Khurana', '2017-02-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `team_task`
--
ALTER TABLE `team_task`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `team_task`
--
ALTER TABLE `team_task`
  MODIFY `sno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
