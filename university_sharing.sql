-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mag 02, 2018 alle 16:59
-- Versione del server: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `university_sharing`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `book`
--

CREATE TABLE IF NOT EXISTS `book` (
`ID` int(11) NOT NULL,
  `Author` varchar(255) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` varchar(4096) NOT NULL,
  `PageNum` int(11) NOT NULL,
  `Edition` varchar(50) NOT NULL,
  `ISBN` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `book`
--

INSERT INTO `book` (`ID`, `Author`, `Title`, `Description`, `PageNum`, `Edition`, `ISBN`) VALUES
(1, 'Andrew S. Tanenbaum', 'Computer Networks', 'Computer Networks, 5/e is appropriate for Computer Networking or Introduction to Networking courses at both the undergraduate and graduate level in Computer Science, Electrical Engineering, CIS, MIS, and Business Departments.	Tanenbaum takes a structured approach to explaining how networks work from the inside out. He starts with an explanation of the physical layer of networking, computer hardware and transmission systems; then works his way up to network applications. Tanenbaum''s in-depth application coverage includes email; the domain name system; the World Wide Web (both client- and server-side); and multimedia (including voice over IP, Internet radio video on demand, video conferencing, and streaming media. Each chapter follows a consistent approach: Tanenbaum presents key principles, then illustrates them utilizing real-world example networks that run through the entire book—the Internet, and wireless networks, including Wireless LANs, broadband wireless and Bluetooth. The Fifth Edition includes a chapter devoted exclusively to network security. The textbook is supplemented by a Solutions Manual, as well as a Website containing PowerPoint slides, art in various forms, and other tools for instruction, including a protocol simulator whereby students can develop and test their own network protocols.', 896, 'Pearson, 5th edition', '8871926404'),
(2, 'L D Landau', 'Mechanics: Volume 1', 'Devoted to the foundation of mechanics, namely classical Newtonian mechanics, the subject is based mainly on Galileo''s principle of relativity and Hamilton''s principle of least action. The exposition is simple and leads to the most complete direct means of solving problems in mechanics.\r\n\r\nThe final sections on adiabatic invariants have been revised and augmented. In addition a short biography of L D Landau has been inserted.', 224, 'Butterworth-Heinemann; 3 edizione (1 gennaio 1976)', '0750628960');

-- --------------------------------------------------------

--
-- Struttura della tabella `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`ID` int(11) NOT NULL,
  `Faculty` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `city`
--

CREATE TABLE IF NOT EXISTS `city` (
`ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Province` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
`ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `insertion`
--

CREATE TABLE IF NOT EXISTS `insertion` (
`ID` int(11) NOT NULL,
  `user_offerer` varchar(255) NOT NULL,
  `material_offered` int(11) NOT NULL,
  `date_of_pubblication` date NOT NULL,
  `place` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `material`
--

CREATE TABLE IF NOT EXISTS `material` (
`ID` int(11) NOT NULL,
  `Type` varchar(255) DEFAULT NULL,
  `Category` int(11) NOT NULL,
  `Book` int(11) DEFAULT NULL,
  `Note` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `note`
--

CREATE TABLE IF NOT EXISTS `note` (
`ID` int(11) NOT NULL,
  `Description` text NOT NULL,
  `Professor` varchar(255) NOT NULL,
  `Year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `province`
--

CREATE TABLE IF NOT EXISTS `province` (
`ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Region` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `city` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`username`, `email`, `password`, `name`, `surname`, `gender`, `date_of_birth`, `city`) VALUES
('aled96', 'prova@lapo.grasso', 'prova1', 'Alessio', 'De Luca', 'male', '1996-05-16', NULL),
('lapo', 'marco.lapolla5@gmail.com', 'password', 'Marco', 'Lapolla', 'male', '1996-10-30', NULL),
('lapo5', 'marco.lapolla5555@gmail.com', 'password', 'Marco', 'Lapolla', 'male', '2000-01-01', NULL),
('sf', 'cfacs@asf.ac', 'aleeee', 'qe', 'csd', 'male', '2000-01-01', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `insertion`
--
ALTER TABLE `insertion`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `note`
--
ALTER TABLE `note`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`username`), ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `insertion`
--
ALTER TABLE `insertion`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
