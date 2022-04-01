-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour album
CREATE DATABASE IF NOT EXISTS `album` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `album`;

-- Listage de la structure de la table album. albums
CREATE TABLE IF NOT EXISTS `albums` (
  `AlbumId` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ArtistId` int(11) DEFAULT NULL,
  PRIMARY KEY (`AlbumId`),
  KEY `IFK_AlbumArtistId` (`ArtistId`),
  CONSTRAINT `FK_F4E2474FBE651800` FOREIGN KEY (`ArtistId`) REFERENCES `artists` (`ArtistId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table album. artists
CREATE TABLE IF NOT EXISTS `artists` (
  `ArtistId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ArtistId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table album. customers
CREATE TABLE IF NOT EXISTS `customers` (
  `CustomerId` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `City` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `State` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PostalCode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SupportRepId` int(11) DEFAULT NULL,
  PRIMARY KEY (`CustomerId`),
  KEY `IFK_CustomerSupportRepId` (`SupportRepId`),
  CONSTRAINT `FK_62534E212A9E686A` FOREIGN KEY (`SupportRepId`) REFERENCES `employees` (`EmployeeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table album. doctrine_migration_versions
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table album. employees
CREATE TABLE IF NOT EXISTS `employees` (
  `EmployeeId` int(11) NOT NULL AUTO_INCREMENT,
  `LastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FirstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `BirthDate` datetime DEFAULT NULL,
  `HireDate` datetime DEFAULT NULL,
  `Address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `City` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `State` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PostalCode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ReportsTo` int(11) DEFAULT NULL,
  PRIMARY KEY (`EmployeeId`),
  KEY `IFK_EmployeeReportsTo` (`ReportsTo`),
  CONSTRAINT `FK_BA82C30054E08D1` FOREIGN KEY (`ReportsTo`) REFERENCES `employees` (`EmployeeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table album. genres
CREATE TABLE IF NOT EXISTS `genres` (
  `GenreId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`GenreId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table album. invoices
CREATE TABLE IF NOT EXISTS `invoices` (
  `InvoiceId` int(11) NOT NULL AUTO_INCREMENT,
  `InvoiceDate` datetime NOT NULL,
  `BillingAddress` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `BillingCity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `BillingState` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `BillingCountry` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `BillingPostalCode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Total` decimal(10,2) NOT NULL,
  `CustomerId` int(11) DEFAULT NULL,
  PRIMARY KEY (`InvoiceId`),
  KEY `IFK_InvoiceCustomerId` (`CustomerId`),
  CONSTRAINT `FK_6A2F2F95BE22D475` FOREIGN KEY (`CustomerId`) REFERENCES `customers` (`CustomerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table album. invoice_items
CREATE TABLE IF NOT EXISTS `invoice_items` (
  `InvoiceLineId` int(11) NOT NULL AUTO_INCREMENT,
  `UnitPrice` decimal(10,2) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `InvoiceId` int(11) DEFAULT NULL,
  `TrackId` int(11) DEFAULT NULL,
  PRIMARY KEY (`InvoiceLineId`),
  KEY `IFK_InvoiceLineInvoiceId` (`InvoiceId`),
  KEY `IFK_InvoiceLineTrackId` (`TrackId`),
  CONSTRAINT `FK_DCC4B9F8AE3BCDCC` FOREIGN KEY (`TrackId`) REFERENCES `tracks` (`TrackId`),
  CONSTRAINT `FK_DCC4B9F8BF8A5EF2` FOREIGN KEY (`InvoiceId`) REFERENCES `invoices` (`InvoiceId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table album. media_types
CREATE TABLE IF NOT EXISTS `media_types` (
  `MediaTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`MediaTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table album. playlists
CREATE TABLE IF NOT EXISTS `playlists` (
  `PlaylistId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`PlaylistId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table album. playlist_track
CREATE TABLE IF NOT EXISTS `playlist_track` (
  `PlaylistId` int(11) NOT NULL,
  `TrackId` int(11) NOT NULL,
  PRIMARY KEY (`PlaylistId`,`TrackId`),
  KEY `IDX_75FFE1E52F7AEDBD` (`PlaylistId`),
  KEY `IDX_75FFE1E5AE3BCDCC` (`TrackId`),
  CONSTRAINT `FK_75FFE1E52F7AEDBD` FOREIGN KEY (`PlaylistId`) REFERENCES `playlists` (`PlaylistId`),
  CONSTRAINT `FK_75FFE1E5AE3BCDCC` FOREIGN KEY (`TrackId`) REFERENCES `tracks` (`TrackId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table album. tracks
CREATE TABLE IF NOT EXISTS `tracks` (
  `TrackId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Composer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Milliseconds` int(11) NOT NULL,
  `Bytes` int(11) DEFAULT NULL,
  `UnitPrice` decimal(10,2) NOT NULL,
  `AlbumId` int(11) DEFAULT NULL,
  `MediaTypeId` int(11) DEFAULT NULL,
  `GenreId` int(11) DEFAULT NULL,
  PRIMARY KEY (`TrackId`),
  KEY `IFK_TrackGenreId` (`GenreId`),
  KEY `IFK_TrackMediaTypeId` (`MediaTypeId`),
  KEY `IFK_TrackAlbumId` (`AlbumId`),
  CONSTRAINT `FK_246D2A2E86B5F39D` FOREIGN KEY (`GenreId`) REFERENCES `genres` (`GenreId`),
  CONSTRAINT `FK_246D2A2E8FE5365C` FOREIGN KEY (`MediaTypeId`) REFERENCES `media_types` (`MediaTypeId`),
  CONSTRAINT `FK_246D2A2E945E136F` FOREIGN KEY (`AlbumId`) REFERENCES `albums` (`AlbumId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
