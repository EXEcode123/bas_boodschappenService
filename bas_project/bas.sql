-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2023 at 03:17 PM
-- Server version: 8.0.28
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bas`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikelen`
--

CREATE TABLE `artikelen` (
  `artId` int NOT NULL,
  `artOmschrijving` varchar(12) NOT NULL,
  `artInkoop` decimal(3,2) NOT NULL,
  `artVerkoop` decimal(3,2) NOT NULL,
  `artVoorraad` int NOT NULL,
  `artMinVoorraad` int NOT NULL,
  `artMaxVoorraad` int NOT NULL,
  `artLocatie` int NOT NULL,
  `levId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `artikelen`
--

INSERT INTO `artikelen` (`artId`, `artOmschrijving`, `artInkoop`, `artVerkoop`, `artVoorraad`, `artMinVoorraad`, `artMaxVoorraad`, `artLocatie`, `levId`) VALUES
(1, 'Ham', '3.00', '2.10', 23, 15, 200, 1, 1),
(2, 'Koffie', '5.00', '3.50', 40, 20, 300, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inkooporders`
--

CREATE TABLE `inkooporders` (
  `inkOrdId` int NOT NULL,
  `artId` int NOT NULL,
  `levId` int NOT NULL,
  `inkOrdDatum` date NOT NULL,
  `inkOrdBestAantal` int NOT NULL,
  `inkOrdStatus` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `inkooporders`
--

INSERT INTO `inkooporders` (`inkOrdId`, `artId`, `levId`, `inkOrdDatum`, `inkOrdBestAantal`, `inkOrdStatus`) VALUES
(1, 1, 1, '2023-05-09', 200, 50);

-- --------------------------------------------------------

--
-- Table structure for table `klanten`
--

CREATE TABLE `klanten` (
  `klantId` int NOT NULL,
  `klantNaam` varchar(20) NOT NULL,
  `klantEmail` varchar(30) NOT NULL,
  `klantAdres` varchar(30) NOT NULL,
  `klantPostcode` varchar(6) NOT NULL,
  `klantWoonplaats` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `klanten`
--

INSERT INTO `klanten` (`klantId`, `klantNaam`, `klantEmail`, `klantAdres`, `klantPostcode`, `klantWoonplaats`) VALUES
(1, 'Fedor Bruggeling', '9006011@student.zadkine.nl', 'Jan ligthartstraat 250', '3083AM', 'Rotterdam'),
(2, 'Klaas kaas', 'klaas@kaas.nl', 'Kaasbuurt 34', '3232KX', 'Kaasstad'),
(3, 'Jan Janssen', 'jjansen@email.com', 'Boerenweide 20', '2720XC', 'Zoetermeer');

-- --------------------------------------------------------

--
-- Table structure for table `leveranciers`
--

CREATE TABLE `leveranciers` (
  `levId` int NOT NULL,
  `levNaam` varchar(15) NOT NULL,
  `levContact` varchar(20) NOT NULL,
  `levEmail` varchar(30) NOT NULL,
  `levAdres` varchar(30) NOT NULL,
  `levPostcode` varchar(6) NOT NULL,
  `levWoonplaats` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `leveranciers`
--

INSERT INTO `leveranciers` (`levId`, `levNaam`, `levContact`, `levEmail`, `levAdres`, `levPostcode`, `levWoonplaats`) VALUES
(1, 'Bas huismerk', '06 123456789', 'huismerk@bas.nl', 'baslaan 24', '3023HJ', 'Rotterdam'),
(2, 'Goudse Kaas', '06 289238', 'goudsekaas@gmail.com', 'Kaasstraat', '4255KX', 'Gouda');

-- --------------------------------------------------------

--
-- Table structure for table `verkooporders`
--

CREATE TABLE `verkooporders` (
  `verkOrdId` int NOT NULL,
  `klantId` int NOT NULL,
  `artId` int NOT NULL,
  `verkOrdDatum` date NOT NULL,
  `verkOrdBestAantal` int NOT NULL,
  `verkOrdStatus` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `verkooporders`
--

INSERT INTO `verkooporders` (`verkOrdId`, `klantId`, `artId`, `verkOrdDatum`, `verkOrdBestAantal`, `verkOrdStatus`) VALUES
(2, 1, 1, '2023-05-17', 10, 3),
(3, 1, 2, '2023-05-11', 4, 2),
(4, 1, 1, '2023-06-01', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikelen`
--
ALTER TABLE `artikelen`
  ADD PRIMARY KEY (`artId`),
  ADD KEY `fk_Artikelen_Leveranciers1_idx` (`levId`);

--
-- Indexes for table `inkooporders`
--
ALTER TABLE `inkooporders`
  ADD PRIMARY KEY (`inkOrdId`,`artId`,`levId`),
  ADD KEY `fk_Artikelen_has_Leveranciers_Leveranciers1_idx` (`levId`),
  ADD KEY `fk_Artikelen_has_Leveranciers_Artikelen1_idx` (`artId`);

--
-- Indexes for table `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`klantId`);

--
-- Indexes for table `leveranciers`
--
ALTER TABLE `leveranciers`
  ADD PRIMARY KEY (`levId`);

--
-- Indexes for table `verkooporders`
--
ALTER TABLE `verkooporders`
  ADD PRIMARY KEY (`verkOrdId`,`artId`,`klantId`),
  ADD KEY `fk_Klanten_has_Artikelen_Artikelen1_idx` (`artId`),
  ADD KEY `fk_Klanten_has_Artikelen_Klanten1_idx` (`klantId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikelen`
--
ALTER TABLE `artikelen`
  MODIFY `artId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inkooporders`
--
ALTER TABLE `inkooporders`
  MODIFY `inkOrdId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `klanten`
--
ALTER TABLE `klanten`
  MODIFY `klantId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leveranciers`
--
ALTER TABLE `leveranciers`
  MODIFY `levId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `verkooporders`
--
ALTER TABLE `verkooporders`
  MODIFY `verkOrdId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artikelen`
--
ALTER TABLE `artikelen`
  ADD CONSTRAINT `fk_Artikelen_Leveranciers1` FOREIGN KEY (`levId`) REFERENCES `leveranciers` (`levId`);

--
-- Constraints for table `inkooporders`
--
ALTER TABLE `inkooporders`
  ADD CONSTRAINT `fk_Artikelen_has_Leveranciers_Artikelen1` FOREIGN KEY (`artId`) REFERENCES `artikelen` (`artId`),
  ADD CONSTRAINT `fk_Artikelen_has_Leveranciers_Leveranciers1` FOREIGN KEY (`levId`) REFERENCES `leveranciers` (`levId`);

--
-- Constraints for table `verkooporders`
--
ALTER TABLE `verkooporders`
  ADD CONSTRAINT `fk_Klanten_has_Artikelen_Artikelen1` FOREIGN KEY (`artId`) REFERENCES `artikelen` (`artId`),
  ADD CONSTRAINT `fk_Klanten_has_Artikelen_Klanten1` FOREIGN KEY (`klantId`) REFERENCES `klanten` (`klantId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
