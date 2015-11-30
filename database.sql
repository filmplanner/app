-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2015 at 01:10 AM
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
  `duration` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `image`, `duration`) VALUES
(1, 'Spectre', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/spectreposter5.jpg', 168),
(2, 'The Hunger Games: Mockingjay - Part 2', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/THG_Mockingjay2-OFFICIAL-DEF.jpg', 156),
(3, 'The Good Dinosaur (Nederlandse versie)', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/thegooddinosaur2.jpg', 111),
(4, 'Burnt', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/burnt_poster.jpg', 118),
(5, 'De Club van Sinterklaas &amp; de Verdwenen Schoentjes', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/de_club_van_sinterklaas_amp_de_verdwenen_schoentjes_poster.jpg', 78),
(6, 'The Good Dinosaur (Originele versie)', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/thegooddinosaur2.jpg', 118),
(7, 'Regression', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/regression1.jpg', 125),
(8, 'Hotel Transsylvanië 2 (Nederlandse versie)', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/hotel_transsylvanie_poster2.jpg', 99),
(9, 'The Martian', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/the_martianposter.jpg', 158),
(10, 'Fashion Chicks', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/fashionchicksposter1.jpg', 111),
(11, 'Solace', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/solaceposter.jpg', 119),
(12, 'The Last Witch Hunter', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/thelastwitchhunter2.jpg', 123),
(13, 'Paranormal Activity: The Ghost Dimension', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/Pactivity_ghostdim2.jpg', 105),
(14, 'Tamasha', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/Tamasha First Look.jpg', 156),
(15, 'The Gift (2015)', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/the_giftposter.jpg', 125),
(16, 'Sleeping With Other People', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/sleepingwithotherpeople1.jpg', 119),
(17, 'Prem Ratan Dhan Payo', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/Premposter.jpg', 187),
(18, 'Keet &amp; Koen: De Speurtocht Naar Bassie &amp; Adriaan', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/keetenkoen1.jpg', 89),
(19, 'Hallo Bungalow', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/hallo_bungalow.jpg', 112),
(20, 'Sneak Preview', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/PAT13-1293BEventsSneakposter350x494px.jpg', 137),
(21, 'Dugun Dernek 2', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/Dugun2.jpg', 129),
(22, 'Krampus', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/Krampusposter.jpg', 115),
(23, 'Bridge of Spies', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/bridgeofspies1b.jpg', 157),
(24, 'Er Ist Wieder Da', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/eristposter.jpg', 126),
(25, 'Ja, Ik Wil!', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/jaikwil2.jpg', 111),
(26, 'No Escape', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/no_escape_poster.jpg', 118),
(27, 'The Intern', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/theintern1b.jpg', 137),
(28, 'By The Sea', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/bythesea2.jpg', 138),
(29, 'Son Of Saul', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/sonofsaul2.jpg', 123),
(30, 'Maryland', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/marylandposter.jpg', 117),
(31, 'The Program', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/theprogramposter1.jpg', 115),
(32, 'Steve Jobs', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/SJB_Netherlands.jpg', 137),
(33, 'Black Mass', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/blackmass2.jpg', 137),
(34, 'Sicario', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/sicario1.jpg', 137),
(35, 'Le Tout Nouveau Testament', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/letoutnouveautestament1.jpg', 123),
(36, 'Ronaldo World Premiere', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/Ronaldo Belgium-Holland[1].jpg', 148),
(37, 'Scouts Guide To The Zombie Apocalypse', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/zombie.jpg', 104),
(38, 'Selma', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/selma6382.jpg', 158),
(39, 'Pan (Nederlandse versie)', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/pan_nlposter.jpg', 126),
(40, 'Pan (Originele versie)', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/panintposter2.jpg', 126),
(41, 'Ali Baba ve 7 Cuceler', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/alibabaposter.jpg', 125),
(42, 'Kafes', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/posterkafes.jpg', 128),
(43, 'Everest', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/everest2.jpg', 136),
(44, 'The Second Best Exotic Marigold Hotel', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/the_second_best_exotic_marigold_hotel_638.jpg', 139),
(45, 'Monty Python and the Holy Grail - 40th Anniversary', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/montyposter2.jpg', 112),
(46, 'The Imitation Game', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/imitationgameoscar638.jpg', 130),
(47, 'Youth', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/youth1.jpg', 140),
(48, 'A Perfect Day', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/aperfectday1.jpg', 121),
(49, 'Far From The Madding Crowd', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/farfromthemaddingcrowd1.jpg', 135),
(50, 'Suite Francaise', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/suitefrancaise638.jpg', 122),
(51, 'Minions (Nederlandse versie)', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/minionsnl4.jpg', 106),
(52, 'Binnenstebuiten', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/binnenstebuiten_670x945.jpg', 116),
(53, 'Holland, Natuur In De Delta', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/hollandnatuurindedelta1.jpg', 105),
(54, 'Still Alice', 'https://media.pathe.nl/nocropthumb/180x254/gfx_content/posters/stillalice638.jpg', 129);

-- --------------------------------------------------------

--
-- Table structure for table `shows`
--

CREATE TABLE IF NOT EXISTS `shows` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theater_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(5) NOT NULL,
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
