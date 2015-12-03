-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2015 at 01:18 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pathe`
--

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theater_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE IF NOT EXISTS `movies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `image`) VALUES
(1, 'Spectre', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/spectreposter5.jpg'),
(2, 'The Hunger Games: Mockingjay - Part 2', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/THG_Mockingjay2-OFFICIAL-DEF.jpg'),
(3, 'Er Ist Wieder Da', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/eristposter.jpg'),
(4, 'Bridge of Spies', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/bridgeofspies1b.jpg'),
(5, 'De Club van Sinterklaas &amp; de Verdwenen Schoentjes', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/de_club_van_sinterklaas_amp_de_verdwenen_schoentjes_poster.jpg'),
(6, 'The Good Dinosaur (Originele versie)', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/thegooddinosaur2.jpg'),
(7, 'Steve Jobs', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/SJB_Netherlands.jpg'),
(8, 'Pawn Sacrifice', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/pawnsacrifice2.jpg'),
(9, 'By The Sea', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/bythesea2.jpg'),
(10, 'Youth', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/youth1.jpg'),
(11, 'Suffragette', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/suffragettenieuweposter.jpg'),
(12, 'Son Of Saul', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/sonofsaul2.jpg'),
(13, 'Monty Python and the Holy Grail - 40th Anniversary', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/montyposter2.jpg'),
(14, 'Far From The Madding Crowd', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/farfromthemaddingcrowd1.jpg'),
(15, 'Burnt', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/burnt_poster.jpg'),
(16, 'Solace', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/solaceposter.jpg'),
(17, 'Regression', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/regression1.jpg'),
(18, 'The Martian', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/the_martianposter.jpg'),
(19, 'The Last Witch Hunter', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/thelastwitchhunter2.jpg'),
(20, 'Paranormal Activity: The Ghost Dimension', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/Pactivity_ghostdim2.jpg'),
(21, 'The Gift (2015)', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/the_giftposter.jpg'),
(22, 'Tamasha', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/Tamasha First Look.jpg'),
(23, 'Sneak Preview', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/PAT13-1293BEventsSneakposter350x494px.jpg'),
(24, 'Sleeping With Other People', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/sleepingwithotherpeople1.jpg'),
(25, 'Prem Ratan Dhan Payo', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/Premposter.jpg'),
(26, 'The Good Dinosaur (Nederlandse versie)', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/thegooddinosaur2.jpg'),
(27, 'Fashion Chicks', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/fashionchicksposter1.jpg'),
(28, 'Hotel Transsylvanië 2 (Nederlandse versie)', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/hotel_transsylvanie_poster2.jpg'),
(29, 'Keet &amp; Koen: De Speurtocht Naar Bassie &amp; Adriaan', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/keetenkoen1.jpg'),
(30, 'Hallo Bungalow', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/hallo_bungalow.jpg'),
(31, 'Dugun Dernek 2', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/Dugun2.jpg'),
(32, 'The Night Before', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/thenightbefore1.jpg'),
(33, 'Ja, Ik Wil!', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/jaikwil2.jpg'),
(34, 'No Escape', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/no_escape_poster.jpg'),
(35, 'Bon Bini Holland', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/bonbiniholland1.jpg'),
(36, 'Krampus', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/Krampusposter.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE IF NOT EXISTS `results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` text NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shows`
--

CREATE TABLE IF NOT EXISTS `shows` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theater_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start` varchar(5) NOT NULL,
  `end` varchar(5) NOT NULL,
  `duration` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `theaters`
--

CREATE TABLE IF NOT EXISTS `theaters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `theaters`
--

INSERT INTO `theaters` (`id`, `name`, `alias`, `city`) VALUES
(1, 'Pathé Amersfoort', 'amersfoort', 'Amersfoort'),
(2, 'Pathé City', 'city', 'Amsterdam'),
(3, 'Pathé Tuschinski', 'tuschinski', 'Amsterdam'),
(4, 'Pathé Arena', 'arena', 'Amsterdam'),
(5, 'Pathé De Munt', 'demunt', 'Amsterdam'),
(6, 'Pathé Arnhem', 'arnhem', 'Arnhem'),
(7, 'Pathé Breda', 'breda', 'Breda'),
(8, 'Pathé Delft', 'delft', 'Delft'),
(9, 'Pathé Buitenhof', 'buitenhof', 'Den Haag'),
(10, 'Pathé Scheveningen', 'scheveningen', 'Den Haag'),
(11, 'Pathé Spuimarkt', 'spuimarkt', 'Den Haag'),
(12, 'Pathé Eindhoven', 'eindhoven', 'Eindhoven'),
(13, 'Pathé Groningen', 'groningen', 'Groningen'),
(14, 'Pathé Haarlem', 'haarlem', 'Haarlem'),
(15, 'Pathé Helmond', 'helmond', 'Helmond'),
(16, 'Pathé Maastricht', 'maastricht', 'Maastricht'),
(17, 'Pathé Schouwburgplein', 'schouwburgplein', 'Rotterdam'),
(18, 'Pathé De Kuip', 'dekuip', 'Rotterdam'),
(19, 'Pathé Tilburg', 'tilburg', 'Tilburg'),
(20, 'Pathé Rembrandt Utrecht', 'rembrandt', 'Utrecht'),
(21, 'Pathé Zaandam', 'zaandam', 'Zaandam'),
(22, 'Pathé De Kroon', 'zwolle', 'Zwolle');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
