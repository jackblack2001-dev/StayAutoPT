-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 21-Maio-2020 às 01:01
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sap_pt`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cars`
--

CREATE TABLE `cars` (
  `License_Plate` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Stand_Id` int(11) NOT NULL,
  `Kms` int(11) NOT NULL,
  `Year` year(4) NOT NULL,
  `Type_Gear` int(11) NOT NULL,
  `Brand` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Model` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `Type_Fuel` int(11) NOT NULL,
  `Price` double NOT NULL,
  `Description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `State` int(11) NOT NULL DEFAULT '1',
  `Views` int(11) DEFAULT '0',
  `CreatedCar` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedCar` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `cars`
--

INSERT INTO `cars` (`License_Plate`, `Stand_Id`, `Kms`, `Year`, `Type_Gear`, `Brand`, `Model`, `Type_Fuel`, `Price`, `Description`, `State`, `Views`, `CreatedCar`, `UpdatedCar`) VALUES
('66-66-66', 1, 2147483647, 1966, 1, 'carroça', 'velha', 1, 10000000, 'é um carro meuito velho que merece respeito', 1, 1, '2020-05-05 11:11:12', '2020-05-12 18:34:35'),
('A5-55-GG', 1, 100000, 1999, 0, 'Null', 'Not null', 0, 12000, 'GG master', 2, 0, '2020-03-11 07:36:16', '2020-05-12 17:51:51'),
('A5-66-GG', 1, 100000, 1999, 0, 'Null', 'sfgh', 0, 12000, 'GG master', 2, 0, '2020-03-21 12:26:00', '2020-05-12 17:51:46'),
('B4-66-34', 1, 1020110, 2001, 1, 'Opel', 'Corsa', 1, 8000, 'fd sfase fsdfs faes gf', 2, 0, '2020-05-05 10:32:52', '2020-05-12 18:29:14'),
('GG-86-L5', 1, 1020110, 2010, 2, 'Astron', 'Martin', 1, 999999999, 'Este carro é demasiado caro para o teu bolso', 1, 0, '2020-05-05 10:34:50', '2020-05-12 18:29:05'),
('GH-76-6K', 1, 0, 2020, 1, 'Ford', 'Focus RXT Defenitive Version Master Id', 1, 999, 'Este modelo e muito fixe', 2, 1, '2020-05-05 10:51:23', '2020-05-12 18:34:42');

-- --------------------------------------------------------

--
-- Estrutura da tabela `news`
--

CREATE TABLE `news` (
  `News_Id` int(11) NOT NULL,
  `Stand_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Text` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `State` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `stands`
--

CREATE TABLE `stands` (
  `Stand_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Adress` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `Locality` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Views` int(11) DEFAULT NULL,
  `ItemsOrder` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'card_nc',
  `CreatedStand` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedStand` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `stands`
--

INSERT INTO `stands` (`Stand_Id`, `User_Id`, `Phone`, `Adress`, `Locality`, `Name`, `Views`, `ItemsOrder`, `CreatedStand`, `UpdatedStand`) VALUES
(1, 1, '889377722', 'Avenida da belgica 101', 'Viseu', 'Carros&Familia LDA', 1, 'card_n:card_c', '0000-00-00 00:00:00', '2020-05-20 16:20:54'),
(2, 5, '889377722', 'Rua das Ruas 101', 'Viseu', 'CarrosCarinhos', 0, 'card_nc', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `stand_ban`
--

CREATE TABLE `stand_ban` (
  `Stand_ban` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Stand_id` int(11) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Duration` datetime DEFAULT NULL,
  `Type_ban` int(11) NOT NULL,
  `Description` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `State` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `User_Id` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `Phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Profile` int(11) NOT NULL,
  `Password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `createdAccount` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAccount` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`User_Id`, `Name`, `Email`, `Phone`, `Profile`, `Password`, `createdAccount`, `updateAccount`) VALUES
(1, 'David Coelho', 'ddsc2001@gmail.com', '123456789', 2, '$2y$10$rpwpf9UXeqxu/jgo7JB1TexZWwK7rFhAm4esZDojP.vJE9M/asHs6', '2019-04-10 12:15:24', '2020-05-20 11:45:58'),
(2, 'admin', 'admin@admin.com', '938366677', 0, '$2y$10$CDhswNyixY8rYpzRpJdqkeXqL0gi5EmB1pKkaJrhwkCj1VKG5Aq26', '2020-03-18 07:51:04', '2020-05-15 11:52:30'),
(3, 'Teste', 'teste@teste.com', '983564721', 1, '$2y$10$Rw8aadCvBUI8PpzRaLS/Wu9hj3jpC1teg2zwL/11NKRqrgnl3l4JG', '2020-05-09 12:06:38', '2020-05-15 11:14:24'),
(4, 'Armindo Pereira', 'AP1980@gmail.com', '958674321', 1, '$2y$10$Rw8aadCvBUI8PpzRaLS/Wu9hj3jpC1teg2zwL/11NKRqrgnl3l4JG', '2020-05-13 13:17:38', '2020-05-10 16:38:17'),
(5, 'Joes nada', 'joes@nada.pt', '383559557', 2, '$2y$10$fVF3m.LmTtfZU1X2mQIJeOYhJBXBJiZPsnswAlMdJ8yQR/BTxPi16', '2020-05-18 15:16:14', '2020-05-18 15:25:34');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_ban`
--

CREATE TABLE `users_ban` (
  `User_ban` int(11) NOT NULL,
  `User_ban_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Description` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `Type_Ban` int(11) NOT NULL,
  `State` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`License_Plate`),
  ADD KEY `cars_stands` (`Stand_Id`),
  ADD KEY `Brands` (`Brand`),
  ADD KEY `Models` (`Model`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`News_Id`),
  ADD KEY `News_Stand_Id` (`Stand_Id`),
  ADD KEY `News_User_Id` (`User_Id`);

--
-- Indexes for table `stands`
--
ALTER TABLE `stands`
  ADD PRIMARY KEY (`Stand_Id`),
  ADD KEY `stands_users` (`User_Id`),
  ADD KEY `Names` (`Name`);

--
-- Indexes for table `stand_ban`
--
ALTER TABLE `stand_ban`
  ADD PRIMARY KEY (`Stand_ban`),
  ADD KEY `Stand_Id` (`Stand_id`),
  ADD KEY `UI` (`User_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_Id`),
  ADD UNIQUE KEY `Names` (`Name`),
  ADD KEY `Email` (`Email`);

--
-- Indexes for table `users_ban`
--
ALTER TABLE `users_ban`
  ADD PRIMARY KEY (`User_ban`),
  ADD KEY `User_ban_Id` (`User_ban_id`),
  ADD KEY `User_Id` (`User_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `News_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stands`
--
ALTER TABLE `stands`
  MODIFY `Stand_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stand_ban`
--
ALTER TABLE `stand_ban`
  MODIFY `Stand_ban` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_ban`
--
ALTER TABLE `users_ban`
  MODIFY `User_ban` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_stands` FOREIGN KEY (`Stand_Id`) REFERENCES `stands` (`Stand_Id`);

--
-- Limitadores para a tabela `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `News_Stand_Id` FOREIGN KEY (`Stand_Id`) REFERENCES `stands` (`Stand_Id`),
  ADD CONSTRAINT `News_User_Id` FOREIGN KEY (`User_Id`) REFERENCES `users` (`User_Id`);

--
-- Limitadores para a tabela `stands`
--
ALTER TABLE `stands`
  ADD CONSTRAINT `stands_users` FOREIGN KEY (`User_Id`) REFERENCES `users` (`User_Id`);

--
-- Limitadores para a tabela `stand_ban`
--
ALTER TABLE `stand_ban`
  ADD CONSTRAINT `Stand_Id` FOREIGN KEY (`Stand_id`) REFERENCES `stands` (`Stand_Id`),
  ADD CONSTRAINT `UI` FOREIGN KEY (`User_Id`) REFERENCES `users` (`User_Id`);

--
-- Limitadores para a tabela `users_ban`
--
ALTER TABLE `users_ban`
  ADD CONSTRAINT `User_Id` FOREIGN KEY (`User_id`) REFERENCES `users` (`User_Id`),
  ADD CONSTRAINT `User_ban_Id` FOREIGN KEY (`User_ban_id`) REFERENCES `users` (`User_Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
