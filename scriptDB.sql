-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2023 at 09:38 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iot`
--

-- --------------------------------------------------------

--
-- Table structure for table `composant`
--

CREATE TABLE `composant` (
  `id_composant` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL,
  `quantite` int(11) NOT NULL,
  `etat` varchar(255) NOT NULL,
  `date_achat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `promo` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` text NOT NULL,
  `whyWantProduct` text NOT NULL,
  `composant` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `firstName`, `lastName`, `promo`, `adress`, `email`, `phone`, `whyWantProduct`, `composant`) VALUES
(1, 'ayhem', 'Allouache', '2019', 'boumedien mesbah', 'allprotas@gmail.com', '0669066999', 'reservation', 'asd'),
(2, 'Ayhem', 'Allouache', '', 'boumedien mesbah', 'allprotas@gmail.com', '0669066999', 'rien', 'aness'),
(3, '', '', '', '', '', '', '', 'aness'),
(4, '', '', '', '', '', '', '', 'aness'),
(5, 'AYHEM', 'ALLOUACHE', '2019', 'BEN AZZOUZ', 'a.allouache@esi-sba.dz', '0669066999', 'FAIRE MA SOUTENANCE', 'ecran'),
(6, 'ayhem', 'aasd', 'sad', 'asd', 'aa@gmail.com', '', '', 'aness'),
(7, 'Ayhem', 'Allouache', '2019', 'ben azzouz', 'allprotas@gmail.com', '0669066999', 'rien du tout', 'asd,ali,'),
(8, '', '', '', '', '', '', '', ''),
(9, 'sad', 'das', 'dasd', '', '', '', 'dasdasfassaasfas23235', ''),
(10, 'ayhem', 'allouache', '2019', 'skikda', 'allprotas@gmail.com', '0669066999', 'utilisation personnelle', 'asd,ali,');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`) VALUES
(1, 'ayhem@bk.ru', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `composant`
--
ALTER TABLE `composant`
  ADD PRIMARY KEY (`id_composant`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `composant`
--
ALTER TABLE `composant`
  MODIFY `id_composant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
