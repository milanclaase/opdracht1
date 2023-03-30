-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 29 mrt 2023 om 14:05
-- Serverversie: 5.7.31
-- PHP-versie: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `BowlingInfo`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Contact`
--

DROP TABLE IF EXISTS `Contact`;
CREATE TABLE IF NOT EXISTS `Contact` (
  `Id` int(11) NOT NULL,
  `PersoonId` int(11) NOT NULL,
  `Mobiel` varchar(20) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `PersoonId` (`PersoonId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `Contact`
--

INSERT INTO `Contact` (`Id`, `PersoonId`, `Mobiel`, `Email`) VALUES
(1, 1, '0612365478', 'm.jamil@gmail.com'),
(2, 2, '0637264532', 'a.ruijter@gmail.com'),
(3, 3, '0639451238', 'h.odijk@gmail.com'),
(4, 4, '0693234612', 'd.van.wakeren@gmail.com'),
(5, 5, '0693234684', 'w.van.de.grift@gmail.com');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Persoon`
--

DROP TABLE IF EXISTS `Persoon`;
CREATE TABLE IF NOT EXISTS `Persoon` (
  `Id` int(11) NOT NULL,
  `TypePersoonId` int(11) NOT NULL,
  `Voornaam` varchar(50) DEFAULT NULL,
  `Tussenvoegsel` varchar(50) DEFAULT NULL,
  `Achternaam` varchar(50) DEFAULT NULL,
  `Roepnaam` varchar(50) DEFAULT NULL,
  `IsVolwassen` tinyint(1) DEFAULT NULL,
  `DatumAangemaakt` datetime DEFAULT NULL,
  `DatumGewijzigd` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `TypePersoonId` (`TypePersoonId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `Persoon`
--

INSERT INTO `Persoon` (`Id`, `TypePersoonId`, `Voornaam`, `Tussenvoegsel`, `Achternaam`, `Roepnaam`, `IsVolwassen`, `DatumAangemaakt`, `DatumGewijzigd`) VALUES
(1, 1, 'Mazin', NULL, 'Jamil', 'Mazin', 1, '2020-01-01 00:15:07', '2020-01-01 00:09:58'),
(2, 1, 'Arjan', 'De', 'Ruijter', 'Arjan', 1, '2020-01-01 00:04:30', '2020-01-01 00:10:52'),
(3, 1, 'Hans', NULL, 'Odijk', 'Hans', 1, '2020-01-01 00:04:18', '2020-01-01 00:07:10'),
(4, 1, 'Dennis', 'Van', 'Wakeren', 'Dennis', 1, '2020-01-01 00:04:41', '2020-01-01 00:01:55'),
(5, 2, 'Wilco', 'Van de', 'Grift', 'Wilco', 1, '2020-01-01 00:13:48', '2020-01-01 00:08:29'),
(6, 3, 'Tom', NULL, 'Sanders', 'Tom', 0, '2020-01-01 00:01:03', '2020-01-01 00:16:19'),
(7, 3, 'Andrew', NULL, 'Sanders', 'Andrew', 0, '2020-01-01 00:05:25', '2020-01-01 00:14:37'),
(8, 3, 'Julian', NULL, 'Kaldenheuvel', 'Julian', 1, '2020-01-01 00:02:09', '2020-01-01 00:03:21');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `TypePersoon`
--

DROP TABLE IF EXISTS `TypePersoon`;
CREATE TABLE IF NOT EXISTS `TypePersoon` (
  `Id` int(11) NOT NULL,
  `Naam` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `TypePersoon`
--

INSERT INTO `TypePersoon` (`Id`, `Naam`) VALUES
(1, 'Klant'),
(2, 'Medewerker'),
(3, 'Gast');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
