-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 09, 2020 at 10:33 AM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kladionica`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

DROP TABLE IF EXISTS `korisnici`;
CREATE TABLE IF NOT EXISTS `korisnici` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `username`, `password`, `admin`) VALUES
(1, 'marko', '202cb962ac59075b964b07152d234b70', 1),
(2, 'mirko', '202cb962ac59075b964b07152d234b70', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

DROP TABLE IF EXISTS `tiket`;
CREATE TABLE IF NOT EXISTS `tiket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `datum_vreme` datetime NOT NULL,
  `uplata` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`id`, `user_id`, `datum_vreme`, `uplata`) VALUES
(1, 2, '2020-01-08 23:16:02', 111),
(2, 2, '2020-01-08 23:50:20', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `tiket_list`
--

DROP TABLE IF EXISTS `tiket_list`;
CREATE TABLE IF NOT EXISTS `tiket_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tiket_id` int(11) NOT NULL,
  `utakmica_id` int(11) NOT NULL,
  `kvota` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tiket_list`
--

INSERT INTO `tiket_list` (`id`, `tiket_id`, `utakmica_id`, `kvota`) VALUES
(1, 1, 2, 2),
(2, 1, 1, 1),
(3, 2, 3, 2),
(4, 2, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `timovi`
--

DROP TABLE IF EXISTS `timovi`;
CREATE TABLE IF NOT EXISTS `timovi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv_tima` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timovi`
--

INSERT INTO `timovi` (`id`, `naziv_tima`) VALUES
(1, 'Crvena Zvezda'),
(2, 'Partizan'),
(3, 'Vojvodina'),
(4, 'Proleter'),
(5, 'Rad'),
(6, 'Vozdovac'),
(7, 'Macva'),
(8, 'Cukaricki'),
(9, 'Metalac');

-- --------------------------------------------------------

--
-- Table structure for table `utakmica`
--

DROP TABLE IF EXISTS `utakmica`;
CREATE TABLE IF NOT EXISTS `utakmica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tim1` int(11) NOT NULL,
  `tim2` int(11) NOT NULL,
  `kvota1` double NOT NULL,
  `kvota2` double NOT NULL,
  `kvotax` double NOT NULL,
  `rezultat` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utakmica`
--

INSERT INTO `utakmica` (`id`, `tim1`, `tim2`, `kvota1`, `kvota2`, `kvotax`, `rezultat`) VALUES
(1, 1, 2, 1.1, 1.5, 2, 2),
(2, 4, 6, 1.2, 2.2, 3.6, 1),
(3, 6, 7, 3.03, 4.2, 2, 2),
(4, 9, 8, 2.2, 2.2, 2.2, 3),
(5, 1, 9, 1.1, 1.5, 2, 3),
(6, 1, 3, 1.2, 2.2, 3.6, 3),
(7, 1, 8, 1.1, 1.5, 2, 2),
(8, 4, 5, 1.1, 1.5, 2, 2),
(9, 2, 6, 1.1, 1.5, 2, 2),
(10, 3, 6, 1.1, 1.5, 2, 2),
(11, 2, 5, 1.1, 1.5, 2, 3),
(12, 2, 6, 1.1, 1.5, 1, 2),
(13, 4, 7, 1.1, 1.5, 2, 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
