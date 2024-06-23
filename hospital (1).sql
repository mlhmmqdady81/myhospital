-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2016 at 07:36 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `clinic`
--

CREATE TABLE `clinic` (
  `ID` int(3) NOT NULL,
  `name` varchar(10) COLLATE utf16_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `clinic`
--

INSERT INTO `clinic` (`ID`, `name`) VALUES
(4, 'ss'),
(5, 'ss'),
(6, 'ss'),
(7, 'ss'),
(8, 'ss'),
(10, 'dfgfdg');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `ID` int(5) NOT NULL,
  `Name` varchar(30) COLLATE utf16_unicode_ci NOT NULL,
  `Specialization` varchar(20) COLLATE utf16_unicode_ci NOT NULL,
  `Telephonenumber` varchar(20) COLLATE utf16_unicode_ci NOT NULL,
  `Email` varchar(30) COLLATE utf16_unicode_ci NOT NULL,
  `ClinicID` int(3) DEFAULT NULL,
  `Password` varchar(50) COLLATE utf16_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`ID`, `Name`, `Specialization`, `Telephonenumber`, `Email`, `ClinicID`, `Password`) VALUES
(1, 'd', 'd', 'd', 'd@d.c', 10, 'd@d.c'),
(2, 'c', 'c', 'c', 'c@w.c', 6, 'c');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `ID` int(10) NOT NULL,
  `Name` varchar(20) COLLATE utf16_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf16_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`ID`, `Name`, `password`) VALUES
(2, 'aa', 'aa');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `ID` int(11) NOT NULL,
  `Name` varchar(20) COLLATE utf16_unicode_ci NOT NULL,
  `NationalityID` varchar(60) COLLATE utf16_unicode_ci NOT NULL,
  `Telephonenumber` varchar(10) COLLATE utf16_unicode_ci NOT NULL,
  `City` varchar(20) COLLATE utf16_unicode_ci NOT NULL,
  `Email` varchar(30) COLLATE utf16_unicode_ci NOT NULL,
  `comments` varchar(300) COLLATE utf16_unicode_ci NOT NULL,
  `MedicalHistory` varchar(300) COLLATE utf16_unicode_ci NOT NULL,
  `Password` varchar(50) COLLATE utf16_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`ID`, `Name`, `NationalityID`, `Telephonenumber`, `City`, `Email`, `comments`, `MedicalHistory`, `Password`) VALUES
(2, 'w', 'w', 'w', 'w', 'w@ww.hjk', ' w', 'w', 'w');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `SID` int(10) NOT NULL,
  `SDate` date NOT NULL,
  `DoctorID` int(11) NOT NULL,
  `PitientID` int(11) NOT NULL,
  `Note` varchar(300) COLLATE utf16_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`SID`, `SDate`, `DoctorID`, `PitientID`, `Note`) VALUES
(2, '2016-04-13', 2, 2, ' sadasd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clinic`
--
ALTER TABLE `clinic`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ClinicID` (`ClinicID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`SID`),
  ADD KEY `DoctorID` (`DoctorID`),
  ADD KEY `PitientID` (`PitientID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clinic`
--
ALTER TABLE `clinic`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `SID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`ClinicID`) REFERENCES `clinic` (`ID`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`DoctorID`) REFERENCES `doctor` (`ID`),
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`PitientID`) REFERENCES `patient` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
