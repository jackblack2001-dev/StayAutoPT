-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Abr-2020 às 22:53
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sap_pt`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cars`
--

CREATE TABLE `cars` (
  `License_Plate` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Stand_Id` int(11) NOT NULL,
  `Kms` int(11) NOT NULL,
  `Year` date NOT NULL,
  `Type_Gear` int(11) NOT NULL,
  `Brand` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Model` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `Type_Fuel` int(11) NOT NULL,
  `Price` double NOT NULL,
  `Description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `State` int(11) NOT NULL DEFAULT 1,
  `Views` int(11) DEFAULT 0,
  `CreatedCar` datetime NOT NULL DEFAULT current_timestamp(),
  `UpdatedCar` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `cars`
--

INSERT INTO `cars` (`License_Plate`, `Stand_Id`, `Kms`, `Year`, `Type_Gear`, `Brand`, `Model`, `Type_Fuel`, `Price`, `Description`, `State`, `Views`, `CreatedCar`, `UpdatedCar`) VALUES
('A4-15-FF', 1, 100000, '1999-01-01', 0, 'Ford', 'Focus', 0, 12000, 'É um carro muito bom e confiavel', 1, 0, '2020-03-21 12:26:00', '2020-03-21 12:30:52');

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
  `CreatedStand` datetime NOT NULL DEFAULT current_timestamp(),
  `UpdatedStand` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `stands`
--

INSERT INTO `stands` (`Stand_Id`, `User_Id`, `Phone`, `Adress`, `Locality`, `Name`, `Views`, `CreatedStand`, `UpdatedStand`) VALUES
(1, 1, '889377722', 'Avenida da belgica 101', 'Viseu', 'Carros&Familia LDA', 0, '0000-00-00 00:00:00', NULL);

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
  `createdAccount` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAccount` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`User_Id`, `Name`, `Email`, `Phone`, `Profile`, `Password`, `createdAccount`, `updateAccount`) VALUES
(1, 'David Coelho', 'ddsc2001@gmail.com', '938366677', 2, '$2y$10$rpwpf9UXeqxu/jgo7JB1TexZWwK7rFhAm4esZDojP.vJE9M/asHs6', '0000-00-00 00:00:00', NULL),
(2, 'admin', 'admin@admin.com', '000000000', 2, '$2y$10$CDhswNyixY8rYpzRpJdqkeXqL0gi5EmB1pKkaJrhwkCj1VKG5Aq26', '2020-03-18 07:51:04', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`License_Plate`),
  ADD KEY `cars_stands` (`Stand_Id`);

--
-- Índices para tabela `stands`
--
ALTER TABLE `stands`
  ADD PRIMARY KEY (`Stand_Id`),
  ADD KEY `stands_users` (`User_Id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_Id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `stands`
--
ALTER TABLE `stands`
  MODIFY `Stand_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `User_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_stands` FOREIGN KEY (`Stand_Id`) REFERENCES `stands` (`Stand_Id`);

--
-- Limitadores para a tabela `stands`
--
ALTER TABLE `stands`
  ADD CONSTRAINT `stands_users` FOREIGN KEY (`User_Id`) REFERENCES `users` (`User_Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
