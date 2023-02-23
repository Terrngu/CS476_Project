-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 23, 2023 at 04:04 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jil_reg_mis`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_user`
--

CREATE TABLE `ci_user` (
  `FULL_NAME` varchar(64) NOT NULL,
  `USER_EMAIL` varchar(64) NOT NULL,
  `USER_PASS` varchar(512) NOT NULL,
  `ACTIVE_STAT_FLG` enum('A','I') NOT NULL,
  `ACCESS_ROLE_FLG` enum('SUPER','ADMIN','USER') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_user`
--

INSERT INTO `ci_user` (`FULL_NAME`, `USER_EMAIL`, `USER_PASS`, `ACTIVE_STAT_FLG`, `ACCESS_ROLE_FLG`) VALUES
('Admin', 'adminuser@jilregina.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'A', 'ADMIN'),
('Super Admin', 'superadmin@jilregina.com', '889a3a791b3875cfae413574b53da4bb8a90d53e', 'A', 'SUPER');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_user`
--
ALTER TABLE `ci_user`
  ADD PRIMARY KEY (`USER_EMAIL`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
