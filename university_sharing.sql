-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Creato il: Mag 02, 2018 alle 15:10
-- Versione del server: 5.7.22-0ubuntu0.16.04.1
-- Versione PHP: 7.0.28-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `university_sharing`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Book`
--

CREATE TABLE `Book` (
  `ID` int(11) NOT NULL,
  `Author` varchar(255) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Edition` varchar(50) NOT NULL,
  `ISBN` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `Category`
--

CREATE TABLE `Category` (
  `ID` int(11) NOT NULL,
  `Faculty` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `City`
--

CREATE TABLE `City` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Province` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `Faculty`
--

CREATE TABLE `Faculty` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `Insertion`
--

CREATE TABLE `Insertion` (
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
-- Struttura della tabella `Material`
--

CREATE TABLE `Material` (
  `ID` int(11) NOT NULL,
  `Type` varchar(255) DEFAULT NULL,
  `Category` int(11) NOT NULL,
  `Book` int(11) DEFAULT NULL,
  `Note` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `Note`
--

CREATE TABLE `Note` (
  `ID` int(11) NOT NULL,
  `Description` text NOT NULL,
  `Professor` varchar(255) NOT NULL,
  `Year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `Province`
--

CREATE TABLE `Province` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Region` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `User`
--

CREATE TABLE `User` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `city` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `User`
--

INSERT INTO `User` (`username`, `email`, `password`, `name`, `surname`, `genre`, `date_of_birth`, `city`) VALUES
('lapo', 'marco.lapolla5@gmail.com', 'password', 'Marco', 'Lapolla', 'male', '1996-10-30', NULL),
('lapo5', 'marco.lapolla5555@gmail.com', 'password', 'Marco', 'Lapolla', 'male', '2000-01-01', NULL);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Book`
--
ALTER TABLE `Book`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `City`
--
ALTER TABLE `City`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `Faculty`
--
ALTER TABLE `Faculty`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indici per le tabelle `Insertion`
--
ALTER TABLE `Insertion`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `Material`
--
ALTER TABLE `Material`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `Note`
--
ALTER TABLE `Note`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `Province`
--
ALTER TABLE `Province`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `Book`
--
ALTER TABLE `Book`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `Category`
--
ALTER TABLE `Category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `City`
--
ALTER TABLE `City`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `Faculty`
--
ALTER TABLE `Faculty`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `Insertion`
--
ALTER TABLE `Insertion`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `Material`
--
ALTER TABLE `Material`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `Note`
--
ALTER TABLE `Note`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `Province`
--
ALTER TABLE `Province`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
