-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 23, 2023 at 04:08 AM
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
-- Table structure for table `ci_event`
--

CREATE TABLE `ci_event` (
  `EVENT_ID` int(11) NOT NULL,
  `DESCRIPTION` varchar(64) NOT NULL,
  `EVENT_DTTM` datetime NOT NULL,
  `EVT_STATUS_FLG` enum('OPEN','CLOSED') NOT NULL,
  `LONG_DESC` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_event`
--

INSERT INTO `ci_event` (`EVENT_ID`, `DESCRIPTION`, `EVENT_DTTM`, `EVT_STATUS_FLG`, `LONG_DESC`) VALUES
(21, 'June 24 - Night of Prayer', '2022-06-24 19:30:00', 'OPEN', 'Speaker: Ptr. Bong '),
(25, 'TEST', '2022-06-22 13:02:00', 'OPEN', 'TEST'),
(27, 'fda', '2022-06-22 14:20:00', 'OPEN', 'fdas');

-- --------------------------------------------------------

--
-- Table structure for table `ci_event_attendee`
--

CREATE TABLE `ci_event_attendee` (
  `EVENT_ID` int(11) NOT NULL,
  `MEMBER_ID` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_event_attendee`
--

INSERT INTO `ci_event_attendee` (`EVENT_ID`, `MEMBER_ID`) VALUES
(21, 'JILREGAB005'),
(21, 'JILREGAD004'),
(21, 'JILREGCG005'),
(21, 'JILREGEM004'),
(21, 'JILREGQJ006'),
(25, 'JILREGAB005'),
(25, 'JILREGCG005'),
(25, 'JILREGEM004'),
(25, 'JILREGQJ006');

-- --------------------------------------------------------

--
-- Table structure for table `ci_evt_non_member`
--

CREATE TABLE `ci_evt_non_member` (
  `EVENT_ID` int(11) NOT NULL,
  `FIRST_NAME` varchar(64) NOT NULL,
  `LAST_NAME` varchar(64) NOT NULL,
  `CONTACT_NUMBER` varchar(32) NOT NULL,
  `NETWORK` varchar(32) NOT NULL,
  `ADDRESS` varchar(254) NOT NULL,
  `GENDER` enum('MALE','FEMALE') NOT NULL,
  `FIRST_TIMER_FLG` enum('YES','NO') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_evt_non_member`
--

INSERT INTO `ci_evt_non_member` (`EVENT_ID`, `FIRST_NAME`, `LAST_NAME`, `CONTACT_NUMBER`, `NETWORK`, `ADDRESS`, `GENDER`, `FIRST_TIMER_FLG`) VALUES
(25, 'Test', 'Try', '(111) 111-1111', 'YAN', 'Test', 'MALE', 'YES'),
(25, 'asdasdad', 'Sasas', '(111) 111-1111', 'MEN', '123123', 'MALE', 'NO'),
(25, 'assadasdad', 'asdadasdad', '(111) 111-1111', 'YAN', '123123 Regina', 'MALE', 'NO'),
(25, 'asdasd', 'asdada', '(112) 333-3333', 'KIDDOS', '4123', 'MALE', 'YES'),
(25, 'aaaaaa`', 'assdd', '(444) 444-4444', 'WOMEN', '1233', 'MALE', 'NO'),
(25, 'ee', 'e', '(133) 333-3311', 'WOMEN', '12313', 'MALE', 'NO'),
(25, 'aadddd', 'asdddd', '(199) 999-9999', 'WOMEN', '9999', 'MALE', 'YES'),
(25, 'laksjdlaksjd', 'alskdjaklsdj', '(999) 999-9990', 'CYN', 'askdasd', 'FEMALE', 'YES'),
(25, 'kjaskjsd', 'oakj', '(009) 988-9440', 'WOMEN', 'asddd', 'MALE', 'YES'),
(25, 'aslkajsldkj', 'asdlkasd', '(009) 099-0909', 'WOMEN', 'asdadasd', 'MALE', 'YES'),
(27, 'fdsa', 'dsa', '(306) 234-2456', 'WOMEN', '2834 Parliament Avenue', 'MALE', 'NO'),
(21, 'Test', 'Test', '(306) 201-5554', 'CYN', '2834 Parliament Avenue', 'MALE', 'YES'),
(21, 'fds', 'fdsa', '(306) 201-5554', 'KIDDOS', '2834 Parliament Avenue', 'MALE', 'NO'),
(27, 'fdas', 'fads', '(306) 234-2456', 'KIDDOS', '12-2834 Parliament Avenue', 'MALE', 'NO'),
(27, 'Test', 'Test', '(306) 555-1111', 'MEN', '12-2834 Parliament Avenue', 'FEMALE', 'NO'),
(27, 'fda', 'fdsa', '(306) 201-5554', 'CYN', '12-2834 Parliament Avenue', 'MALE', 'NO'),
(27, 'asdf', 'asdf', '(306) 123-4512', 'KIDDOS', '2834 Parliament Avenue', 'MALE', 'NO'),
(27, 'rew', '24', '(306) 123-4512', 'KIDDOS', '12-2834 Parliament Avenue', 'MALE', 'NO'),
(27, 'seta', 'rewa', '(306) 201-5554', 'KIDDOS', '2834 Parliament Avenue', 'MALE', 'NO'),
(27, 'fdas', 'afds', '(306) 201-5554', 'CYN', '2834 Parliament Avenue', 'MALE', 'NO'),
(27, 'Alert', 'Test', '(306) 123-4512', 'CYN', '132 Rundleridge Road NE', 'MALE', 'NO'),
(27, 'asdf', 'fda', '(306) 201-5554', 'CYN', '2834 Parliament Avenue', 'MALE', 'NO'),
(27, 'ds', 'gdsag', '(306) 111-3333', 'CYN', '12-2834 Parliament Avenue', 'FEMALE', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `ci_member`
--

CREATE TABLE `ci_member` (
  `MEMBER_ID` varchar(11) NOT NULL,
  `FIRST_NAME` varchar(64) NOT NULL,
  `LAST_NAME` varchar(64) NOT NULL,
  `CONTACT_NUMBER` varchar(32) NOT NULL,
  `EMAIL` varchar(32) NOT NULL,
  `BIRTHDATE` date NOT NULL,
  `NETWORK` varchar(32) NOT NULL,
  `ADDRESS` varchar(254) NOT NULL,
  `GENDER` enum('MALE','FEMALE') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_member`
--

INSERT INTO `ci_member` (`MEMBER_ID`, `FIRST_NAME`, `LAST_NAME`, `CONTACT_NUMBER`, `EMAIL`, `BIRTHDATE`, `NETWORK`, `ADDRESS`, `GENDER`) VALUES
('JILREGAB005', 'Aljon', 'Botawan', '(306) 201-5554', 'arbotawan@gmail.com', '2021-11-30', 'YAN', '132 Rundleridge Road NE', 'MALE'),
('JILREGAD004', 'Amiel', 'De Los Reyes', '(306) 201-5554', 'amielxvr@gmail.com', '2022-01-21', 'YAN', '12-2834 Parliament Avenue N', 'MALE'),
('JILREGCG005', 'CJ', 'Gimena', '(306) 000-1111', 'gimenacj@gmail.com', '2022-01-21', 'CYN', 'dun sa east ang layoa', 'MALE'),
('JILREGEM004', 'Erika', 'Molano', '(306) 123-4567', 'erika.molano@colliers.com', '2022-01-21', 'YAN', 'Ung malapit sa sheldon', 'FEMALE'),
('JILREGQJ006', 'Joycelyn', 'Quijano', '(306) 555-1111', 'joyceqdr@yahoo.com', '2022-01-21', 'WOMEN', '132 Rundleridge Road NE', 'FEMALE');

-- --------------------------------------------------------

--
-- Table structure for table `ci_ministry`
--

CREATE TABLE `ci_ministry` (
  `MINISTRY_ID` int(11) NOT NULL,
  `ABBREVIATION` varchar(64) NOT NULL,
  `DESCRIPTION` varchar(64) NOT NULL,
  `MINISTRY_DESCRIPTION` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_ministry`
--

INSERT INTO `ci_ministry` (`MINISTRY_ID`, `ABBREVIATION`, `DESCRIPTION`, `MINISTRY_DESCRIPTION`) VALUES
(1, 'MAN', 'Multimedia Arts Network', 'TEST DESCRIPTION '),
(2, 'SAN', 'Services Auxiliary Network', 'hahahahahahahah'),
(3, 'WAN', 'Worship and Arts Network', 'TEST DESCRIPTION 1 gahahahha');

-- --------------------------------------------------------

--
-- Table structure for table `ci_ministry_mem`
--

CREATE TABLE `ci_ministry_mem` (
  `MINISTRY_ID` int(11) NOT NULL,
  `MEMBER_ID` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_ministry_mem`
--

INSERT INTO `ci_ministry_mem` (`MINISTRY_ID`, `MEMBER_ID`) VALUES
(1, '00000000003'),
(1, 'JILREGAB005'),
(1, 'JILREGAD004'),
(1, 'JILREGCG005'),
(1, 'JILREGQJ006'),
(2, '00000000003'),
(2, 'JILREGAB005'),
(2, 'JILREGCG005'),
(2, 'JILREGQJ006'),
(3, '00000000002'),
(3, 'JILREGEM004'),
(9, '00000000002'),
(9, 'JILREGAD004'),
(22, 'JILREGAD004'),
(22, 'JILREGEM004'),
(23, '00000000002'),
(24, '00000000002'),
(24, 'JILREGEM004');

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
-- Indexes for table `ci_event`
--
ALTER TABLE `ci_event`
  ADD PRIMARY KEY (`EVENT_ID`);

--
-- Indexes for table `ci_event_attendee`
--
ALTER TABLE `ci_event_attendee`
  ADD PRIMARY KEY (`EVENT_ID`,`MEMBER_ID`);

--
-- Indexes for table `ci_member`
--
ALTER TABLE `ci_member`
  ADD PRIMARY KEY (`MEMBER_ID`);

--
-- Indexes for table `ci_ministry`
--
ALTER TABLE `ci_ministry`
  ADD PRIMARY KEY (`MINISTRY_ID`);

--
-- Indexes for table `ci_ministry_mem`
--
ALTER TABLE `ci_ministry_mem`
  ADD PRIMARY KEY (`MINISTRY_ID`,`MEMBER_ID`);

--
-- Indexes for table `ci_user`
--
ALTER TABLE `ci_user`
  ADD PRIMARY KEY (`USER_EMAIL`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ci_event`
--
ALTER TABLE `ci_event`
  MODIFY `EVENT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `ci_ministry`
--
ALTER TABLE `ci_ministry`
  MODIFY `MINISTRY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `ci_ministry_mem`
--
ALTER TABLE `ci_ministry_mem`
  MODIFY `MINISTRY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
