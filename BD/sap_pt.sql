-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 26-Jun-2020 às 17:44
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
  `Description` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `State` int(11) NOT NULL DEFAULT '1',
  `Views` int(11) DEFAULT '0',
  `Card_Image` int(11) DEFAULT NULL,
  `CreatedCar` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedCar` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `cars`
--

INSERT INTO `cars` (`License_Plate`, `Stand_Id`, `Kms`, `Year`, `Type_Gear`, `Brand`, `Model`, `Type_Fuel`, `Price`, `Description`, `State`, `Views`, `Card_Image`, `CreatedCar`, `UpdatedCar`) VALUES
('49-56-RI', 13, 200000, 2001, 1, 'Renault', 'Clio', 1, 600, '<p>Este &eacute; um carro carro mais dedicado a cidade...</p>\r\n\r\n<p>Please by Patiente i dont have Vtec ;_;</p>\r\n', 1, 1, NULL, '2020-06-26 08:32:45', '2020-06-26 09:45:38'),
('56-hj-45', 1, 65, 2005, 1, 'Astron', 'Martin', 1, 1000, 'tfhfhfgfg', 2, 43, NULL, '2020-05-28 15:38:10', '2020-06-26 12:54:18'),
('66-66-66', 13, 2147483647, 1966, 2, 'carroça', 'velha', 1, 500, '<p>&eacute; um carro meuito velho que merece respeito</p>\r\n', 2, 3, NULL, '2020-05-05 11:11:12', '2020-06-26 09:45:38'),
('7BAY345', 14, 40000, 1980, 1, 'Porsche', '911 carrera 4', 1, 20000, '<p>Porsche 911 carrera 4 equipado com um Turbo, em vermelho;</p>\r\n\r\n<ul>\r\n	<li>jantes de liga leve;</li>\r\n	<li>como novo;</li>\r\n</ul>\r\n', 1, 17, NULL, '2020-06-26 08:46:06', '2020-06-26 13:14:15'),
('A5-55-GG', 1, 100000, 1999, 0, 'Fiat', 'Not null', 2, 12000, 'GG master', 2, 43, NULL, '2020-03-11 07:36:16', '2020-06-26 12:54:18'),
('A5-66-GG', 12, 100000, 1999, 0, 'Fiat', 'sfgh', 2, 12000, 'GG master', 2, 6, NULL, '2020-03-21 12:26:00', '2020-06-25 22:34:50'),
('AE-86-TY', 1, 300000, 1986, 1, 'Toyota', 'AE 86 Panda TwinTurbo', 1, 4500, '<p>&eacute; um carro que embora tenha a sua idade &eacute; lendario pela sua dirigiblidade nas curvas</p>\r\n', 1, 1043, NULL, '2020-06-09 20:46:04', '2020-06-26 12:54:18'),
('B4-66-34', 1, 1020110, 2001, 1, 'Opel', 'Corsa', 1, 8000, 'fd sfase fsdfs faes gf', 2, 43, NULL, '2020-05-05 10:32:52', '2020-06-26 12:54:18'),
('B4-66-52', 1, 0, 2010, 3, 'Koenigsegg', 'Regera', 1, 10000000, '<p>O mais velos carro e mais leve com 1.500 cv que supera a tesla e com uma aerodinamica ava&ccedil;aladora&nbsp;</p>\r\n', 1, 43, NULL, '2020-06-25 16:54:58', '2020-06-26 12:54:18'),
('bx-88-f5', 1, 200000, 1988, 1, 'Opel', 'Corsa', 1, 500, '<p>&Eacute; um carro que embora seja de baixo custo, anda como tudo!</p>\r\n', 1, 43, NULL, '2020-05-29 11:12:43', '2020-06-26 12:54:18'),
('DK-11-22', 13, 550000, 1998, 1, 'Mazda', 'Miata Dorifto Version', 1, 99000, '<p>Kansei Dorifto?!?!?</p>\r\n', 1, 2, NULL, '2020-06-09 21:02:11', '2020-06-26 09:45:38'),
('ERHI08J', 12, 70000, 1970, 1, 'Ford', 'Escort', 1, 22000, '<p>Este &eacute; um carro que embora sendo antigo ganha fama pelo seu desempenho no rally, muito utilizado nesta disicplina, &eacute; bastante conhecido pelas suas lindas curvas, alinhadas com a sua otima capacidade de resposta, este &eacute; um carro para qualquer amante de automoveis</p>\r\n\r\n<ul>\r\n	<li>motor em otimo estado</li>\r\n	<li>carro&ccedil;aria como nova</li>\r\n	<li>Inclui um Turbo 2cm3</li>\r\n</ul>\r\n', 1, 0, NULL, '2020-06-26 08:25:40', NULL),
('F5-34-GH', 14, 303000, 2012, 1, 'Seat', 'Ibiza', 1, 2500, '<p>Vendo trator a diesel&nbsp;</p>\r\n', 1, 17, NULL, '2020-06-26 08:59:56', '2020-06-26 13:14:15'),
('GG-86-L5', 1, 1020110, 2010, 2, 'Astron', 'Martin', 1, 100, 'Este carro é demasiado caro para o teu bolso', 2, 43, NULL, '2020-05-05 10:34:50', '2020-06-26 12:54:18'),
('GH-76-6K', 1, 0, 2020, 1, 'Ford', 'Focus RXT Defenitive Version Master Id', 1, 999, 'Este modelo e muito fixe', 2, 44, NULL, '2020-05-05 10:51:23', '2020-06-26 12:54:18'),
('HH-JJ-EE', 12, 80000, 1999, 1, 'Fiat', 'Punto', 1, 2000, '<p>&eacute; um carro com muita garra, mesmo para a sua idade</p>\r\n', 1, 6, NULL, '2020-06-24 23:05:59', '2020-06-25 22:34:50'),
('JD-TT-33', 1, 500000, 2018, 2, 'Fiat', 'Punto', 2, 6000, '<p>&eacute; um carro de treta</p>\r\n', 0, 43, NULL, '2020-06-24 18:11:24', '2020-06-26 12:54:18'),
('JJ-4G-34', 14, 666000, 2012, 1, 'Fiat', '500', 2, 200, '<p>POR FAVOR N&Atilde;O COMPRE ESTE CARRO</p>\r\n', 1, 17, NULL, '2020-06-26 08:55:59', '2020-06-26 13:14:15'),
('LL-HH-YY', 1, 1000000, 1992, 1, 'jaguar', 'jx220', 1, 5000, '<p>Um carro da Decada de 90a que conta com uma elegancia que s&oacute; mesmo a jauguar sabe dar aos seus carros</p>\r\n\r\n<p>Este Carro &eacute; uma Beleza e eu gosto muito dele!</p>\r\n\r\n<ul>\r\n	<li>Peneus a prova de bala;</li>\r\n	<li>Um parachoques que realmente para choques;</li>\r\n	<li>Uma lataria modificada para melhor performance;</li>\r\n	<li>Motor TwinTurbo;</li>\r\n</ul>\r\n', 1, 701, NULL, '2020-05-29 13:02:31', '2020-06-26 12:54:18'),
('LQ-66-97', 1, 100000, 1997, 1, 'Fiat', 'Uno Turbo mk1', 1, 3000, 'Um fiat Uno em otimas condições, equipado com um turbo GT 2056', 1, 43, NULL, '2020-05-30 13:53:13', '2020-06-26 12:54:18'),
('RF-TY-34', 14, 60000, 1998, 1, 'Nissan', 'GTR', 1, 30000, '<p>Este &eacute; o iconico carro igual ao do filme de corridas que do nada passou a ser uma serie de a&ccedil;&atilde;o</p>\r\n', 1, 17, NULL, '2020-06-26 08:51:06', '2020-06-26 13:14:15'),
('RR-TY-55', 13, 300000, 1994, 1, 'Rover', 'Serie 400', 1, 1500, '<p>Esta &eacute; a vers&atilde;o que vem com extras. portanto tem:</p>\r\n\r\n<ul>\r\n	<li>teto de abrir;</li>\r\n	<li>espelhos retrovisores aquecidos;</li>\r\n	<li>espelhos eletricos;</li>\r\n	<li>jantes especiais;</li>\r\n</ul>\r\n', 1, 1, NULL, '2020-06-26 08:38:28', '2020-06-26 09:45:38'),
('S4-44-GG', 12, 800000, 1999, 1, 'Nissan', 'Silvia', 1, 88000, '<p>Um nissan silvia em condi&ccedil;&otilde;es exelentes, ja tem a revisao feita, e tem umas curvas... UI!</p>\r\n', 1, 16, NULL, '2020-06-17 17:44:34', '2020-06-25 22:34:50'),
('TT-TT-TT', 1, 2147483647, 1920, 1, 'carroça', 'Carrinha bonita', 2, 2500, 'MUITO ANTIGA', 2, 43, NULL, '2020-05-29 11:27:15', '2020-06-26 12:54:18'),
('X5-Y6-Z7', 1, 0, 2020, 1, 'Ford', 'Lindo', 1, 200, 'É um carro novo artilhado de tecnologia', 2, 43, NULL, '2020-05-29 11:34:15', '2020-06-26 12:54:18'),
('YH-3F-5T', 1, 100000, 2005, 1, 'Volkswagen', 'Golfo', 1, 2000, 'Um carro de Cidade que é prefeito para todos os amantes de carros', 1, 43, NULL, '2020-05-29 12:56:23', '2020-06-26 12:54:18');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cars_favourits`
--

CREATE TABLE `cars_favourits` (
  `Favourits_Car_Id` int(11) NOT NULL,
  `License_Plate` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `User_id` int(11) NOT NULL,
  `State` int(11) NOT NULL,
  `CreatedFavourits` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedFavourits` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `cars_favourits`
--

INSERT INTO `cars_favourits` (`Favourits_Car_Id`, `License_Plate`, `User_id`, `State`, `CreatedFavourits`, `UpdatedFavourits`) VALUES
(11, '56-hj-45', 6, 0, '2020-06-22 17:54:51', '2020-06-22 17:55:01'),
(12, '56-hj-45', 5, 1, '2020-06-23 11:40:14', '2020-06-23 11:47:41'),
(13, 'bx-88-f5', 5, 0, '2020-06-23 12:30:25', '2020-06-23 12:34:49'),
(14, 'S4-44-GG', 1, 1, '2020-06-23 12:37:58', '2020-06-23 17:13:45'),
(15, 'YH-3F-5T', 6, 0, '2020-06-23 12:39:15', '2020-06-23 12:39:22'),
(16, 'DK-11-22', 1, 1, '2020-06-23 15:19:03', NULL),
(17, 'S4-44-GG', 11, 1, '2020-06-23 17:21:24', NULL),
(18, 'HH-JJ-EE', 1, 1, '2020-06-25 21:41:28', NULL),
(19, 'AE-86-TY', 11, 1, '2020-06-25 22:43:57', NULL),
(20, '7BAY345', 20, 0, '2020-06-26 09:57:50', '2020-06-26 11:01:20'),
(21, 'AE-86-TY', 20, 1, '2020-06-26 10:56:04', '2020-06-26 12:52:12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cars_images`
--

CREATE TABLE `cars_images` (
  `Id_Image` int(11) NOT NULL,
  `License_Plate` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `state` int(10) NOT NULL DEFAULT '1',
  `CreatedCar_Image` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedCar_Image` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `cars_images`
--

INSERT INTO `cars_images` (`Id_Image`, `License_Plate`, `Name`, `state`, `CreatedCar_Image`, `UpdatedCar_Image`) VALUES
(55, 'B4-66-34', '5ed0f587eec600.59169524.png', 1, '2020-05-29 12:52:20', NULL),
(56, 'B4-66-34', '5ed0f585604517.76169720.png', 1, '2020-05-29 12:52:20', NULL),
(57, 'B4-66-34', '5ed0f582d55cb0.34199945.jpg', 0, '2020-05-29 12:52:20', '2020-05-29 12:52:41'),
(58, 'YH-3F-5T', '5ed0f834ccb399.65196700.jpg', 1, '2020-05-29 12:56:36', NULL),
(59, 'LL-HH-YY', '5ed0f9d52fbaa4.85364579.jpg', 1, '2020-05-29 13:02:31', NULL),
(60, 'LL-HH-YY', '5ed0f9d205dac2.97663791.jpg', 1, '2020-05-29 13:02:31', NULL),
(61, 'LL-HH-YY', '5ed0f9ceaec4e3.66446989.jpg', 1, '2020-05-29 13:02:31', NULL),
(62, 'LL-HH-YY', '5ed0f9cab30a25.83814418.jpg', 1, '2020-05-29 13:02:31', NULL),
(63, 'LL-HH-YY', '5ed0f9c6b190d2.39308753.jpg', 1, '2020-05-29 13:02:31', NULL),
(64, 'LQ-66-97', '5ed256b58421a5.77400033.jpg', 1, '2020-05-30 13:53:20', NULL),
(65, 'LQ-66-97', '5ed256b3644d89.96825300.jpg', 0, '2020-05-30 13:53:38', '2020-06-18 14:30:23'),
(66, 'LQ-66-97', '5ed38a63b9a8b6.60494233.jpg', 0, '2020-05-31 11:43:50', '2020-06-18 14:30:32'),
(67, 'LQ-66-97', '5ed38a61686b27.61287047.jpg', 1, '2020-05-31 11:43:50', NULL),
(68, 'LQ-66-97', '5ed38a5f0d7742.91070018.jpg', 1, '2020-05-31 11:43:50', NULL),
(69, 'LQ-66-97', '5ed38a5c7f1f41.50093124.jpg', 1, '2020-05-31 11:43:50', NULL),
(70, 'LQ-66-97', '5ed38a59209583.40787161.jpg', 1, '2020-05-31 11:43:50', NULL),
(71, 'AE-86-TY', '5edfe6d925e0e0.27835617.jpg', 1, '2020-06-09 20:46:08', NULL),
(72, 'AE-86-TY', '5edfe6d5986fb8.55745289.jpg', 1, '2020-06-09 20:46:12', NULL),
(73, 'AE-86-TY', '5edfe6d2518f80.10233644.jpg', 0, '2020-06-09 20:46:14', '2020-06-18 12:54:49'),
(74, 'AE-86-TY', '5edfe6ce951650.61961062.jpg', 0, '2020-06-09 20:46:17', '2020-06-18 13:19:19'),
(75, 'AE-86-TY', '5edfe6cb376310.94278732.jpg', 1, '2020-06-09 20:46:20', NULL),
(76, 'DK-11-22', '5edfeabcdc9864.05212487.jpg', 0, '2020-06-09 21:02:11', '2020-06-18 12:44:11'),
(77, 'DK-11-22', '5edfeab94d6f26.25395520.jpg', 1, '2020-06-09 21:02:11', NULL),
(78, 'DK-11-22', '5edfeaaf839791.87095009.jpg', 1, '2020-06-09 21:02:11', NULL),
(79, 'DK-11-22', '5edfeaac3eac24.56781861.jpg', 1, '2020-06-09 21:02:11', NULL),
(80, 'DK-11-22', '5edfeaa9655b73.40193178.jpg', 0, '2020-06-09 21:02:11', '2020-06-18 12:44:11'),
(81, 'S4-44-GG', '5eea473e3f1309.64243700.jpg', 1, '2020-06-17 17:44:34', NULL),
(82, 'S4-44-GG', '5eea473b3dec10.74801988.jpg', 1, '2020-06-17 17:44:34', NULL),
(83, 'S4-44-GG', '5eea4737a6c179.01726700.jpg', 1, '2020-06-17 17:44:34', NULL),
(84, 'S4-44-GG', '5eea4734cf5d26.35946464.jpg', 0, '2020-06-17 17:44:34', '2020-06-18 12:46:48'),
(85, 'S4-44-GG', '5eea472971c218.27227568.jpg', 0, '2020-06-17 17:44:34', '2020-06-22 12:11:35'),
(86, 'AE-86-TY', '5eeb5ef0da05e3.40849880.jpg', 0, '2020-06-18 13:32:48', '2020-06-18 14:28:25'),
(87, '56-hj-45', '5eeb69585bc817.30990359.png', 1, '2020-06-18 14:17:12', NULL),
(88, 'bx-88-f5', '5eeb6b253b15e1.66520063.jpg', 1, '2020-06-18 14:24:53', NULL),
(89, 'bx-88-f5', '5eeb6b2fe1a609.32867694.jpg', 1, '2020-06-18 14:25:03', NULL),
(90, 'bx-88-f5', '5eeb6b3bc95588.05787559.jpg', 1, '2020-06-18 14:25:15', NULL),
(91, 'bx-88-f5', '5eeb6b4b3f3824.23176111.jpg', 1, '2020-06-18 14:25:31', NULL),
(92, 'bx-88-f5', '5eeb6b5c280771.94973638.jpg', 1, '2020-06-18 14:25:48', NULL),
(93, 'AE-86-TY', '5eeb6c0127cb18.91433023.jpg', 1, '2020-06-18 14:28:33', NULL),
(94, 'JD-TT-33', '5ef3893a43ede9.60527644.png', 1, '2020-06-24 18:11:24', NULL),
(95, 'JD-TT-33', '5ef38935e2f474.38916440.png', 1, '2020-06-24 18:11:24', NULL),
(96, 'JD-TT-33', '5ef3892df3af27.38308363.png', 1, '2020-06-24 18:11:24', NULL),
(97, 'JD-TT-33', '5ef389260b7191.29442597.png', 1, '2020-06-24 18:11:24', NULL),
(98, 'JD-TT-33', '5ef38922eb5378.20845954.png', 0, '2020-06-24 18:11:24', '2020-06-24 18:12:08'),
(99, 'HH-JJ-EE', '5ef3ce461ef434.75829208.jpg', 1, '2020-06-24 23:05:59', NULL),
(100, 'HH-JJ-EE', '5ef3ce438fed41.27627165.jpg', 1, '2020-06-24 23:05:59', NULL),
(101, 'HH-JJ-EE', '5ef3ce409ac1b8.93078735.jpg', 1, '2020-06-24 23:05:59', NULL),
(102, 'HH-JJ-EE', '5ef3ce3cb28732.10223971.jpg', 1, '2020-06-24 23:05:59', NULL),
(103, 'HH-JJ-EE', '5ef3ce38353038.19992468.jpg', 1, '2020-06-24 23:05:59', NULL),
(104, 'B4-66-52', '5ef4c8cf423937.45599586.jpg', 1, '2020-06-25 16:54:58', NULL),
(105, 'B4-66-52', '5ef4c8b0536fa3.22171147.jpg', 1, '2020-06-25 16:54:58', NULL),
(106, 'B4-66-52', '5ef4c8a99b6b55.55599014.jpg', 1, '2020-06-25 16:54:58', NULL),
(107, 'B4-66-52', '5ef4c88a3ef3a0.77118411.jpg', 1, '2020-06-25 16:54:58', NULL),
(108, 'B4-66-52', '5ef4c8845e7780.15053550.jpg', 1, '2020-06-25 16:54:58', NULL),
(109, 'ERHI08J', '5ef5a2f16aaeb3.60148532.jpg', 1, '2020-06-26 08:25:40', NULL),
(110, 'ERHI08J', '5ef5a2eea5a847.89793321.jpg', 1, '2020-06-26 08:25:40', NULL),
(111, 'ERHI08J', '5ef5a2ebd8b0d1.36566615.jpg', 1, '2020-06-26 08:25:40', NULL),
(112, 'ERHI08J', '5ef5a2e962cc70.12993907.jpg', 1, '2020-06-26 08:25:40', NULL),
(113, 'ERHI08J', '5ef5a2e6ba37e3.65075804.png', 1, '2020-06-26 08:25:40', NULL),
(114, '49-56-RI', '5ef5a49bda9f03.19485277.jpg', 1, '2020-06-26 08:32:46', NULL),
(115, '49-56-RI', '5ef5a498786175.76678522.jpg', 1, '2020-06-26 08:32:46', NULL),
(116, '49-56-RI', '5ef5a495111504.72731888.jpg', 1, '2020-06-26 08:32:46', NULL),
(117, '49-56-RI', '5ef5a491214513.53259318.jpg', 1, '2020-06-26 08:32:46', NULL),
(118, '49-56-RI', '5ef5a48e0807a5.45227314.jpg', 1, '2020-06-26 08:32:46', NULL),
(119, 'RR-TY-55', '5ef5a5e16dacc9.92552970.jpg', 1, '2020-06-26 08:38:28', NULL),
(120, 'RR-TY-55', '5ef5a5df024ef8.25493496.jpg', 1, '2020-06-26 08:38:28', NULL),
(121, 'RR-TY-55', '5ef5a5dbad3bc0.20314920.jpg', 1, '2020-06-26 08:38:28', NULL),
(122, 'RR-TY-55', '5ef5a5d90fb821.51225480.jpg', 1, '2020-06-26 08:38:28', NULL),
(123, 'RR-TY-55', '5ef5a5d650d104.18786654.jpg', 1, '2020-06-26 08:38:28', NULL),
(124, '7BAY345', '5ef5a7bd57f0d0.64850578.jpg', 1, '2020-06-26 08:46:06', NULL),
(125, '7BAY345', '5ef5a7bb077678.46787465.png', 1, '2020-06-26 08:46:06', NULL),
(126, '7BAY345', '5ef5a7b8ad3268.98265020.jpg', 1, '2020-06-26 08:46:06', NULL),
(127, '7BAY345', '5ef5a7b6776ff7.09478917.jpg', 1, '2020-06-26 08:46:06', NULL),
(128, '7BAY345', '5ef5a7b383f329.24698217.jpg', 1, '2020-06-26 08:46:06', NULL),
(129, 'RF-TY-34', '5ef5a8e89bcb63.78216628.jpg', 1, '2020-06-26 08:51:06', NULL),
(130, 'RF-TY-34', '5ef5a8e512ca58.96971603.jpg', 1, '2020-06-26 08:51:06', NULL),
(131, 'RF-TY-34', '5ef5a8e2252375.92946219.jpg', 1, '2020-06-26 08:51:06', NULL),
(132, 'RF-TY-34', '5ef5a8dfc89478.35171567.jpg', 1, '2020-06-26 08:51:06', NULL),
(133, 'RF-TY-34', '5ef5a8dd7e6f72.22722847.jpg', 1, '2020-06-26 08:51:06', NULL),
(134, 'JJ-4G-34', '5ef5aa0d703492.17910032.jpg', 1, '2020-06-26 08:55:59', NULL),
(135, 'JJ-4G-34', '5ef5aa0a63f604.50539082.jpg', 1, '2020-06-26 08:55:59', NULL),
(136, 'JJ-4G-34', '5ef5aa0783b834.09992994.png', 1, '2020-06-26 08:55:59', NULL),
(137, 'JJ-4G-34', '5ef5aa04ee2562.97597174.jpg', 1, '2020-06-26 08:55:59', NULL),
(138, 'JJ-4G-34', '5ef5aa026e3aa9.08185684.jpg', 1, '2020-06-26 08:55:59', NULL),
(139, 'JJ-4G-34', '5ef5a9ffb6f844.82121542.jpg', 1, '2020-06-26 08:55:59', NULL),
(140, 'F5-34-GH', '5ef5aafb3bbb98.54759066.jpg', 1, '2020-06-26 08:59:56', NULL),
(141, 'F5-34-GH', '5ef5aaf8d7d686.33360817.jpg', 1, '2020-06-26 08:59:56', NULL),
(142, 'F5-34-GH', '5ef5aaf64e6c16.57349053.jpg', 1, '2020-06-26 08:59:56', NULL),
(143, 'F5-34-GH', '5ef5aaf3eb44e4.07171723.jpg', 1, '2020-06-26 08:59:56', NULL),
(144, 'F5-34-GH', '5ef5aaf1805538.81031340.jpg', 1, '2020-06-26 08:59:56', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `config_stands`
--

CREATE TABLE `config_stands` (
  `Id_CS` int(11) NOT NULL,
  `Stand_Id` int(11) NOT NULL,
  `ItemsOrder` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'card_nc',
  `Id_News` int(11) NOT NULL DEFAULT '0',
  `NumCarN` int(11) NOT NULL DEFAULT '5'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `config_stands`
--

INSERT INTO `config_stands` (`Id_CS`, `Stand_Id`, `ItemsOrder`, `Id_News`, `NumCarN`) VALUES
(1, 1, 'card_nc:card_n', 6, 4),
(2, 12, 'card_n:card_nc', 0, 3),
(3, 13, 'card_nc', 0, 1),
(4, 14, 'card_nc', 0, 5),
(5, 15, 'card_nc', 0, 5),
(6, 16, 'card_nc', 0, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `locations`
--

CREATE TABLE `locations` (
  `local_id` int(11) NOT NULL,
  `name_location` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `locations`
--

INSERT INTO `locations` (`local_id`, `name_location`) VALUES
(1, 'Abrantes'),
(2, 'Agualva-Cacém'),
(3, 'Águeda'),
(4, 'Albergaria-a-Velha'),
(5, 'Albufeira'),
(6, 'Alcácer do Sal'),
(7, 'Alcobaça	'),
(8, 'Alfena'),
(9, 'Almada'),
(10, 'Almeirim'),
(11, 'Alverca do Ribatejo'),
(12, 'Amadora'),
(13, 'Amarante'),
(14, 'Amora'),
(15, 'Anadia'),
(16, 'Angra do Heroísmo'),
(17, 'Aveiro'),
(18, 'Barcelos'),
(19, 'Barreiro'),
(20, 'Beja'),
(21, 'Borba'),
(22, 'Braga'),
(23, 'Bragança'),
(24, 'Caldas da Rainha'),
(25, 'Câmara de Lobos'),
(26, 'Caniço'),
(27, 'Cantanhede'),
(28, 'Cartaxo'),
(29, 'Castelo Branco'),
(30, 'Chaves'),
(31, 'Coimbra'),
(32, 'Costa da Caparica'),
(33, 'Covilhã'),
(34, 'Elvas'),
(35, 'Entroncamento'),
(36, 'Ermesinde'),
(37, 'Esmoriz'),
(38, 'Espinho'),
(39, 'Esposende'),
(40, 'Estarreja'),
(41, 'Estremoz'),
(42, 'Évora'),
(43, 'Fafe'),
(44, 'Faro'),
(45, 'Fátima'),
(46, 'Felgueiras'),
(47, 'Figueira da Foz	'),
(48, 'Fiães'),
(49, 'Freamunde'),
(50, 'Funchal'),
(51, 'Fundão'),
(52, 'Gafanha da Nazaré'),
(53, 'Gandra'),
(54, 'Gondomar'),
(55, 'Gouveia'),
(56, 'Guarda'),
(57, 'Guimarães'),
(58, 'Horta'),
(59, 'Ílhavo'),
(60, 'Lagoa Açores'),
(61, 'Lagoa Faro'),
(62, 'Lagos'),
(63, 'Lamego'),
(64, 'Leiria'),
(65, 'Lisboa'),
(66, 'Lixa'),
(67, 'Loulé'),
(68, 'Loures'),
(69, 'Lourosa'),
(70, 'Macedo de Cavaleiros'),
(71, 'Machico'),
(72, 'Maia'),
(73, 'Mangualde'),
(74, 'Marco de Canaveses'),
(75, 'Marinha Grande'),
(76, 'Matosinhos'),
(77, 'Mealhada'),
(78, 'Mêda'),
(79, 'Miranda do Douro '),
(80, 'Mirandela'),
(81, 'Montemor-o-Novo'),
(82, 'Montijo'),
(83, 'Moura'),
(84, 'Odivelas'),
(85, 'Olhão da Restauração	'),
(86, 'Oliveira de Azeméis'),
(87, 'Oliveira do Bairro'),
(88, 'Oliveira do Hospital'),
(89, 'Ourém'),
(90, 'Ovar'),
(91, 'Paços de Ferreira'),
(92, 'Paredes'),
(93, 'Penafiel'),
(94, 'Peniche'),
(95, 'Peso da Régua'),
(96, 'Pinhel'),
(97, 'Pombal'),
(98, 'Ponta Delgada'),
(99, 'Ponte de Sor'),
(100, 'Portalegre'),
(101, 'Portimão'),
(102, 'Porto'),
(103, 'Póvoa de Santa Iria'),
(104, 'Póvoa de Varzim'),
(105, 'Praia da Vitória'),
(106, 'Quarteira'),
(107, 'Queluz'),
(108, 'Rebordosa'),
(109, 'Reguengos de Monsaraz'),
(110, 'Ribeira Grande	d'),
(111, 'Rio Maior'),
(112, 'Rio Tinto'),
(113, 'Sabugal'),
(114, 'Sacavém'),
(115, 'Samora Correia'),
(116, 'Santa Comba Dão'),
(117, 'Santa Cruz'),
(118, 'Santa Maria da Feira'),
(119, 'Santana'),
(120, 'Santarém'),
(122, 'Santiago do Cacém'),
(123, 'Santo Tirso'),
(124, 'São João da Madeira'),
(125, 'São Mamede de Infesta'),
(126, 'São Pedro do Sul'),
(127, 'Lordelo'),
(128, 'Seia'),
(129, 'Seixal'),
(130, 'Senhora da Hora'),
(131, 'Serpa'),
(132, 'Setúbal'),
(133, 'Silves'),
(134, 'Sines'),
(135, 'Tarouca'),
(136, 'Tavira'),
(137, 'Tomar'),
(138, 'Tondela'),
(139, 'Torres Novas'),
(140, 'Torres Vedras'),
(141, 'Trancoso'),
(142, 'Trofa'),
(143, 'Valbom'),
(144, 'Vale de Cambra'),
(145, 'Valença'),
(146, 'Valongo'),
(147, 'Valpaços'),
(148, 'Vendas Novas'),
(149, 'Viana do Castelo'),
(150, 'Vila Baleira'),
(151, 'Vila do Conde'),
(152, 'Vila Franca de Xira'),
(153, 'Vila Nova de Famalicão'),
(154, 'Vila Nova de Foz Côa'),
(155, 'Vila Nova de Gaia	'),
(156, 'Vila Nova de Santo André'),
(159, 'Vila Real'),
(160, 'Vila Real de Santo António'),
(161, 'Viseu'),
(162, 'Vizela');

-- --------------------------------------------------------

--
-- Estrutura da tabela `messages`
--

CREATE TABLE `messages` (
  `Message_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Receiver_Id` int(11) NOT NULL,
  `License_Plate` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Message` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `Neg_Price` int(11) DEFAULT NULL,
  `Accept_Neg_Price` int(11) NOT NULL DEFAULT '0',
  `Viewed` int(11) NOT NULL DEFAULT '0',
  `CreatedMessage` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `messages`
--

INSERT INTO `messages` (`Message_Id`, `User_Id`, `Receiver_Id`, `License_Plate`, `Title`, `Message`, `Neg_Price`, `Accept_Neg_Price`, `Viewed`, `CreatedMessage`) VALUES
(1, 6, 1, 'AE-86-TY', 'quero desesperadamente este carro', '<p>este carro e e muito importante para mim o belhote</p>\r\n', 1000, 0, 1, '2020-06-15 16:28:16'),
(2, 4, 1, 'AE-86-TY', 'Quero este carrinho', '<p>Gostava de comprar este carro, por favor, se aceitar, de passar no seu stand na proxima ter&ccedil;a, para fazer-mos negocio</p>\r\n', 0, 0, 1, '2020-06-17 17:14:04'),
(3, 4, 1, '56-hj-45', 'Que carro LindUwU', '<p>Este Carro &eacute; muito LindUwU, eu gostava de ir ai busca-lo, para poder lhe por mas m&atilde;UwUs em cima</p>\r\n', 1, 0, 1, '2020-06-18 17:14:43'),
(4, 1, 6, 'AE-86-TY', 'Proposta de Preço muito baixa', '<p>Muito boa tarde senhor/a JO MAMA, o pre&ccedil;o que propos e demasiado baixo, vendo pelo pre&ccedil;o anunciado.</p>\n\n<p>&nbsp;</p>\n\n<p>Cumprimentos, David Coelho</p>\n', NULL, 0, 1, '2020-06-19 15:47:42'),
(10, 1, 6, 'AE-86-TY', 'dsf', '<p>dsf</p>\n', NULL, 0, 1, '2020-06-19 16:06:00'),
(11, 1, 6, 'AE-86-TY', 'Preço muito baixo', '<p>LOL Estas a gosar com a minha cara&nbsp;</p>\n', NULL, 0, 1, '2020-06-19 16:12:13'),
(12, 6, 1, 'AE-86-TY', 'não por acaso não estava', '<p>Mas prontos vou a outro lado :\\</p>\n', NULL, 0, 1, '2020-06-22 10:24:10'),
(13, 5, 1, 'AE-86-TY', 'Este carro e muito lindo', '<p>Gostaria meito de ter este carro</p>\r\n', 4000, 0, 1, '2020-06-22 12:13:18'),
(14, 1, 5, 'AE-86-TY', 'Oferta interesante', '<p>Gostei da proposta, por favor temos de maracar uma data para o senhor ca vir</p>\n', NULL, 1, 1, '2020-06-22 12:16:32'),
(15, 1, 6, 'DK-11-22', 'aqueredito em ti Davi', '<p>o davi isto ta muitu giro eu sei que consegues acabar isto hoje eu aqueredito em ti.</p>\r\n\r\n<p>mas mesmo asim ainda te faltao muitas coisas mas eu sei que consegues acabar hoje :] va eu prometo que nao te chateio:`)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;por:Mois&egrave;s</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; esquerito com carinho</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;a nao sei porque eque tens um carro chamado toyota lindo</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n', 0, 0, 1, '2020-06-22 16:20:55'),
(16, 11, 5, 'S4-44-GG', 'Queria este carro', '<p>Eu gosto muito deste carro, significa muito para mim, e gostava de me encontrar consigo para o ver</p>\r\n', 0, 0, 1, '2020-06-23 17:40:23'),
(17, 5, 11, 'S4-44-GG', 'Sim, pode vir com muito gosto', '<p>Ola senhor Edu Silva, podemos sim senhor marcar, se desejar ate ja para amanha, pode passar aqui pelo stand para ver o carro</p>\n', NULL, 0, 1, '2020-06-23 17:45:21'),
(18, 1, 5, 'S4-44-GG', 'Gosto muito deste carro', '<p>Quero este carro para mim</p>\r\n', 0, 0, 1, '2020-06-24 23:12:25'),
(19, 5, 1, 'S4-44-GG', 'Não não queres', '<p>Este carro &eacute; muito para ti</p>\n', NULL, 0, 1, '2020-06-24 23:12:59'),
(20, 1, 5, 'S4-44-GG', 'ola', '<p>ola</p>\r\n', 0, 0, 1, '2020-06-25 16:29:32'),
(21, 5, 1, 'S4-44-GG', 'ola', '<p><em>ola</em></p>\n\n<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\">\n	<tbody>\n		<tr>\n			<td>pre&ccedil;o base&nbsp;</td>\n			<td>8000</td>\n		</tr>\n		<tr>\n			<td>lucro</td>\n			<td>70000</td>\n		</tr>\n		<tr>\n			<td>impostos</td>\n			<td>10000</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>&nbsp;</p>\n', NULL, 0, 1, '2020-06-25 16:31:59'),
(22, 20, 3, '7BAY345', 'Gostaria de me encontrar com sigo ', '<p>Gostei do carro e do pre&ccedil;o podemonos encontrar</p>\r\n', 0, 0, 0, '2020-06-26 10:20:46'),
(23, 20, 1, 'AE-86-TY', 'Gostaria ', '<p>Acho o carro antigo demais para o pre&ccedil;o</p>\r\n', 4000, 0, 1, '2020-06-26 12:54:18');

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
  `State` int(11) NOT NULL DEFAULT '1',
  `CreatedNews` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedNews` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `news`
--

INSERT INTO `news` (`News_Id`, `Stand_Id`, `User_Id`, `Title`, `Text`, `State`, `CreatedNews`, `UpdatedNews`) VALUES
(1, 1, 1, 'Ola', '<pre>\r\nHoje foi feito um grande passo</pre>\r\n\r\n<p>Agora os utilizadores podem realizar os mais bonitos textos, recorrendo apenas a esta sublime editor de texto</p>\r\n\r\n<blockquote>\r\n<p>Um grande passo foi dado, Tudo gra&ccedil;as ao programador</p>\r\n</blockquote>\r\n\r\n<p><s>Vamos ver se isto realmente funciona!</s></p>\r\n', 1, '2020-06-04 20:44:39', '2020-06-04 21:03:14'),
(2, 1, 1, 'Noticia que não quer calar', '<pre>\r\nHoje foi feito um grande passo</pre>\r\n\r\n<p>Agora os utilizadores podem realizar os mais bonitos textos, recorrendo apenas a esta sublime editor de texto</p>\r\n\r\n<blockquote>\r\n<p>Um grande passo foi dado, Tudo gra&ccedil;as ao programador</p>\r\n</blockquote>\r\n\r\n<p><s>Vamos ver se isto realmente funciona!</s></p>\r\n', 1, '2020-06-04 20:44:55', '2020-06-05 10:47:21'),
(3, 1, 1, 'Lindo', '<pre>\r\nHoje foi feito um grande passo</pre>\r\n\r\n<p>Agora os utilizadores podem realizar os mais bonitos textos, recorrendo apenas a esta sublime editor de texto</p>\r\n\r\n<blockquote>\r\n<p>Um grande passo foi dado, Tudo gra&ccedil;as ao programador</p>\r\n</blockquote>\r\n\r\n<p><s>Vamos ver se isto realmente funciona!</s></p>\r\n', 1, '2020-06-04 20:45:40', '2020-06-05 10:46:28'),
(4, 1, 1, 'Primeira notícia do Site', '<pre>\r\nHoje foi feito um grande passo</pre>\r\n\r\n<p>Agora os utilizadores podem realizar os mais bonitos textos, recorrendo apenas a esta sublime editor de texto</p>\r\n\r\n<blockquote>\r\n<p>Um grande passo foi dado, Tudo gra&ccedil;as ao programador</p>\r\n</blockquote>\r\n\r\n<p><s>Vamos ver se isto realmente funciona!</s></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><cite>teste para ver se o editar not&iacute;cias funcemina</cite></p>\r\n', 1, '2020-06-04 20:48:13', '2020-06-06 14:51:18'),
(5, 1, 1, 'Uma notícia Interessante', '<h3><span class=\"marker\">OLA QUE LINDO</span></h3>\r\n\r\n<div style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: 1px solid rgb(204, 204, 204); padding: 5px 10px;\"><span style=\"background-color:#ffff00\"><em>este bloco tem historia</em></span></div>\r\n', 1, '2020-06-05 00:23:37', NULL),
(6, 1, 1, 'Lindo muito Lindo', '<h1><a href=\"https://www.facebook.com/photo.php?fbid=1053665681447611&amp;set=a.346639062150280&amp;type=3&amp;theater\" target=\"_blank\"><img alt=\"Lindo a Caturra\" src=\"https://scontent.fopo1-1.fna.fbcdn.net/v/t31.0-8/s960x960/29663178_1053665681447611_1282819308269979957_o.jpg?_nc_cat=100&amp;_nc_sid=110474&amp;_nc_ohc=KEY71hrq86EAX8Cg9qV&amp;_nc_ht=scontent.fopo1-1.fna&amp;_nc_tp=7&amp;oh=07b83c6ed31322c402f66192c4714066&amp;oe=5F00538F\" style=\"float:left; height:300px; margin-bottom:10px; margin-top:10px; width:300px\" /></a>O lindo &eacute; um passarinho</h1>\r\n\r\n<p><code>Sabem qual &eacute; a melhor coisa a cerca do lindo?</code></p>\r\n\r\n<div style=\"background:#eeeeee; border:1px solid #cccccc; padding:5px 10px\">&Eacute; que o&nbsp;<span class=\"marker\">Lindo</span>&nbsp;&eacute; um passarinho que&nbsp;<em>gosta muito de sementes</em>&nbsp;</div>\r\n\r\n<p><var>O lindo &eacute; muito Kawai UwU</var>&nbsp;</p>\r\n', 1, '2020-06-05 12:43:51', '2020-06-05 19:13:28'),
(7, 12, 5, 'Jo Mama esta pronto para Servir!', '<p>Agora em Viseu, Jo Mamas CarsNjo esta pronto para lhe entregar os mais fabulos carros da HotWeels</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>UwU</p>\r\n', 1, '2020-06-09 20:01:12', NULL),
(8, 1, 1, 'Um carro decente', '<p>Estou a procura de um carro decente, ent&atilde;o pe&ccedil;o a quem ve isto que me ajude a encontrar um carro decente para que a minha procura termine...</p>\r\n\r\n<p>Um carro decente tem de ter:</p>\r\n\r\n<ol>\r\n	<li>Uma granda duma traseira;</li>\r\n	<li>Ser facilmente manubravel;</li>\r\n	<li>Ter um motor que goste de ser poxado;&nbsp;</li>\r\n	<li>Ser,&nbsp;<strong>de forma obrigatoria um Toyota AE86 Spring Panda TwinTurbo</strong></li>\r\n</ol>\r\n\r\n<p>Boa procura Rapazes UwU</p>\r\n', 1, '2020-06-16 11:57:33', '2020-06-24 10:21:36');

-- --------------------------------------------------------

--
-- Estrutura da tabela `search_data_car`
--

CREATE TABLE `search_data_car` (
  `Search_Id` int(11) NOT NULL,
  `Min_Year` year(4) DEFAULT NULL,
  `Max_Year` year(4) DEFAULT NULL,
  `Min_Price` int(11) DEFAULT NULL,
  `Max_Price` int(11) DEFAULT NULL,
  `Min_Kms` int(11) DEFAULT NULL,
  `Max_Kms` int(11) DEFAULT NULL,
  `Type_Fuel` int(11) DEFAULT NULL,
  `Type_Gear` int(11) DEFAULT NULL,
  `Locality` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `search_data_car`
--

INSERT INTO `search_data_car` (`Search_Id`, `Min_Year`, `Max_Year`, `Min_Price`, `Max_Price`, `Min_Kms`, `Max_Kms`, `Type_Fuel`, `Type_Gear`, `Locality`) VALUES
(1, 2010, 2018, 12000, 13000, 0, 10000, 1, 1, 161),
(2, 1980, 2000, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1980, 2000, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1920, 2000, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 1920, 2000, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 161),
(7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 161),
(12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 161),
(13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 161),
(14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 161),
(15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 1930, 1953, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, NULL, NULL, 500, 1000, NULL, NULL, NULL, NULL, NULL),
(18, 1980, 1990, NULL, NULL, NULL, NULL, 1, 1, 161),
(19, 1921, 2020, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `stands`
--

CREATE TABLE `stands` (
  `Stand_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Adress` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `Locality` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Views` int(11) DEFAULT NULL,
  `CreatedStand` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedStand` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `stands`
--

INSERT INTO `stands` (`Stand_Id`, `User_Id`, `Phone`, `Adress`, `Locality`, `Name`, `Views`, `CreatedStand`, `UpdatedStand`) VALUES
(1, 1, '938366677', 'Rua do Arco ', 161, 'Initial D the Ultimate Stand', 73, '0000-00-00 00:00:00', '2020-06-26 13:11:10'),
(12, 5, '998877123', 'Rua da Avenida das meninas duvidosas', 122, 'Jomamas Place', 111, '2020-06-09 15:35:46', '2020-06-26 10:46:12'),
(13, 6, '1578495623', 'Rua ao pe do rio tejo', 100, 'Lindo Stand a beira mar', 10, '2020-06-09 20:54:32', '2020-06-25 22:35:16'),
(14, 3, '939393861', 'Rua da tia maria 2a', 20, 'Stand do tio João', 56, '2020-06-10 16:14:57', '2020-06-26 12:58:11'),
(15, 8, '968574123', 'Rua das andorinhas', 126, 'Auto São Pedro do Sul', 29, '2020-06-17 15:49:52', '2020-06-26 08:51:40'),
(16, 10, '478965321', 'Rua dos Olas', 42, 'Stand dos OLAS', 0, '2020-06-17 16:04:56', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `stands_badges`
--

CREATE TABLE `stands_badges` (
  `Id_Badge` int(11) NOT NULL,
  `Stand_Id` int(11) NOT NULL,
  `Badge_Name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `State` int(11) NOT NULL DEFAULT '1',
  `CreatedBadge` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ReplacedBadge` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `stands_badges`
--

INSERT INTO `stands_badges` (`Id_Badge`, `Stand_Id`, `Badge_Name`, `State`, `CreatedBadge`, `ReplacedBadge`) VALUES
(1, 14, '5ee0f8ee586141.01755193.png', 0, '2020-06-10 16:14:57', '2020-06-10 16:48:18'),
(2, 14, '5ee100c24e5ca0.74676692.png', 0, '2020-06-10 16:48:18', '2020-06-10 16:49:01'),
(3, 14, '5ee100ed5868c1.51108115.png', 0, '2020-06-10 16:49:01', '2020-06-12 15:04:02'),
(4, 1, '5ee23c85c6f707.47465178.jpg', 0, '2020-06-11 15:21:02', '2020-06-11 16:12:51'),
(5, 12, '5ee0c2218b7569.09176653.png', 0, '2020-06-11 15:53:40', '2020-06-24 23:08:25'),
(6, 13, '5ee0a68c8d45f5.53760519.jpg', 0, '2020-06-11 15:57:08', '2020-06-11 16:12:28'),
(7, 13, '5ee249dc1a1761.99656861.png', 1, '2020-06-11 16:12:28', NULL),
(8, 1, '5ee249f39fabb6.95333648.jpg', 0, '2020-06-11 16:12:51', '2020-06-11 16:12:59'),
(9, 1, '5ee249fb267e18.10231165.jpg', 0, '2020-06-11 16:12:59', '2020-06-16 11:58:32'),
(10, 14, '5ee38b52948682.80332148.jpg', 0, '2020-06-12 15:04:02', '2020-06-25 22:55:36'),
(11, 1, '5ee8a5d8ed7c28.31760675.png', 0, '2020-06-16 11:58:32', '2020-06-16 11:58:40'),
(12, 1, '5ee8a5e054b3e4.77901322.jpg', 1, '2020-06-16 11:58:40', NULL),
(13, 15, '5eea2ceba11555.92512764.png', 0, '2020-06-17 15:50:20', '2020-06-17 15:50:30'),
(14, 15, '5eea2ce225c714.69904560.png', 1, '2020-06-17 15:50:34', NULL),
(15, 16, '5eea30ee4bc007.41495304.png', 1, '2020-06-17 16:05:54', NULL),
(16, 12, '5ef3ced9d3a1f6.75320733.jpg', 1, '2020-06-24 23:08:25', NULL),
(17, 14, '5ef51d58a1d834.08246521.jpg', 1, '2020-06-25 22:55:36', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `stands_banners`
--

CREATE TABLE `stands_banners` (
  `Id_Banner` int(11) NOT NULL,
  `Stand_Id` int(11) NOT NULL,
  `Banner_Name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `State` int(11) NOT NULL DEFAULT '1',
  `CreatedBanner` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ReplacedBanner` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `stands_banners`
--

INSERT INTO `stands_banners` (`Id_Banner`, `Stand_Id`, `Banner_Name`, `State`, `CreatedBanner`, `ReplacedBanner`) VALUES
(1, 1, '5edfe208417006.79172465.jpg', 0, '2020-06-11 15:16:17', '2020-06-11 16:13:06'),
(2, 12, '5edf9e3cd438d8.26344527.jpg', 0, '2020-06-11 15:54:50', '2020-06-12 15:01:13'),
(3, 13, '5ee0a742913c26.28381578.jpg', 0, '2020-06-11 15:55:57', '2020-06-11 16:02:48'),
(4, 14, '5ee23d26492143.33528727.jpg', 0, '2020-06-11 15:58:41', '2020-06-12 15:04:27'),
(5, 13, '5ee24947b15476.81667676.jpg', 0, '2020-06-11 16:09:59', '2020-06-11 16:12:11'),
(6, 13, '5ee249cbbb6b19.30438747.jpg', 0, '2020-06-11 16:12:11', '2020-06-12 15:02:55'),
(7, 1, '5ee24a02169ba8.77559402.png', 0, '2020-06-11 16:13:06', '2020-06-11 16:13:37'),
(8, 1, '5ee24a214b0aa7.83974348.jpg', 0, '2020-06-11 16:13:37', '2020-06-12 14:59:11'),
(9, 1, '5ee38a2f0d7c04.26600194.png', 0, '2020-06-12 14:59:11', '2020-06-12 15:04:58'),
(10, 12, '5ee38aa9069ef7.02008432.png', 0, '2020-06-12 15:01:13', '2020-06-24 23:07:49'),
(11, 13, '5ee38b0fb4d215.05094237.jpg', 1, '2020-06-12 15:02:55', NULL),
(12, 14, '5ee38b6b764c96.78375973.png', 0, '2020-06-12 15:04:27', '2020-06-25 22:55:12'),
(13, 1, '5ee38b8ada2260.24139323.jpg', 0, '2020-06-12 15:04:58', '2020-06-15 10:27:01'),
(14, 1, '5ee73ee5c536d4.01328283.jpg', 0, '2020-06-15 10:27:01', '2020-06-16 11:44:47'),
(15, 1, '5ee8a29f5c12a8.13052214.jpg', 0, '2020-06-16 11:44:47', '2020-06-16 11:45:05'),
(16, 1, '5ee8a2b1d30ba5.40181944.jpg', 1, '2020-06-16 11:45:05', NULL),
(17, 15, 'cfxbvdfg', 0, '2020-06-17 15:56:38', '2020-06-17 15:56:58'),
(18, 15, '5eea2f3a56eb73.14065580.jpg', 1, '2020-06-17 15:56:58', NULL),
(19, 12, '5ef3ceb55c6ed0.23698476.jpg', 1, '2020-06-24 23:07:49', NULL),
(20, 14, '5ef51d407b4fd3.87056896.jpg', 1, '2020-06-25 22:55:12', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `stands_favourits`
--

CREATE TABLE `stands_favourits` (
  `Favourits_Stand_Id` int(11) NOT NULL,
  `Stand_Id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `State` int(11) NOT NULL,
  `CreatedFavourits` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedFavourits` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `stands_favourits`
--

INSERT INTO `stands_favourits` (`Favourits_Stand_Id`, `Stand_Id`, `User_id`, `State`, `CreatedFavourits`, `UpdatedFavourits`) VALUES
(2, 12, 4, 1, '2020-06-16 19:57:12', '2020-06-16 20:17:39'),
(3, 1, 4, 1, '2020-06-16 20:19:57', '2020-06-16 20:26:36'),
(4, 1, 5, 1, '2020-06-17 10:42:23', NULL),
(5, 15, 4, 0, '2020-06-17 16:41:11', '2020-06-17 16:41:13'),
(6, 13, 5, 1, '2020-06-22 11:59:35', '2020-06-22 12:00:40'),
(7, 12, 1, 0, '2020-06-23 14:47:06', '2020-06-23 16:10:35'),
(8, 14, 1, 0, '2020-06-23 14:50:05', '2020-06-23 16:10:30'),
(9, 15, 1, 1, '2020-06-23 15:17:16', '2020-06-23 16:11:08'),
(10, 13, 1, 1, '2020-06-24 23:13:47', NULL),
(11, 1, 11, 1, '2020-06-25 17:45:15', '2020-06-25 22:43:31'),
(12, 1, 20, 1, '2020-06-25 23:30:52', '2020-06-26 12:52:20'),
(13, 14, 20, 0, '2020-06-26 09:58:36', '2020-06-26 11:01:47'),
(14, 14, 2, 1, '2020-06-26 10:59:55', NULL);

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
  `Banner` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Badge` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IsActivated` int(11) NOT NULL DEFAULT '0',
  `createdAccount` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAccount` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`User_Id`, `Name`, `Email`, `Phone`, `Profile`, `Password`, `Banner`, `Badge`, `IsActivated`, `createdAccount`, `updateAccount`) VALUES
(1, 'David Coelho', 'ddsc2001@gmail.com', '996683254', 2, '$2y$10$rpwpf9UXeqxu/jgo7JB1TexZWwK7rFhAm4esZDojP.vJE9M/asHs6', '5ed0e974784653.70049562.jpg', '5ef21069e6b5e5.69205300.jpg', 1, '2019-04-10 12:15:24', '2020-06-24 22:08:43'),
(2, 'admin', 'admin@admin.com', '938366677', 0, '$2y$10$CDhswNyixY8rYpzRpJdqkeXqL0gi5EmB1pKkaJrhwkCj1VKG5Aq26', '5ef2383d346541.82763623.jpg', '5ec7ae88280104.83625511.jpg', 0, '2020-03-18 07:51:04', '2020-06-23 18:13:33'),
(3, 'Teste', 'teste@teste.com', '983564721', 2, '$2y$10$Rw8aadCvBUI8PpzRaLS/Wu9hj3jpC1teg2zwL/11NKRqrgnl3l4JG', NULL, NULL, 0, '2020-05-09 12:06:38', '2020-06-10 16:09:29'),
(4, 'Armindo Pereira', 'AP1980@gmail.com', '958674321', 1, '$2y$10$Rw8aadCvBUI8PpzRaLS/Wu9hj3jpC1teg2zwL/11NKRqrgnl3l4JG', NULL, NULL, 0, '2020-05-13 13:17:38', '2020-05-10 16:38:17'),
(5, 'Joes nada', 'joes@nada.pt', '383559557', 2, '$2y$10$VhZn6PK4LqvFDiG2J3RTc.CRBVegA31AhhQwxS9KUwAyH0IPnoZ0G', '5eea4b73ec08b1.27591457.jpg', '5eea4b41680fb7.71924925.png', 0, '2020-05-18 15:16:14', '2020-06-17 17:57:23'),
(6, 'JO MAMA', 'Jomama@gmail.com', '968677745', 2, '$2y$10$wbDUd/a/dqqrpT2jP8vYReDanDXPLEIwJ3o4br7VYlM.N/c8AJ2ee', '5ec7bd53dd3640.88202760.jpg', '5edfe87244de24.54975540.jpg', 0, '2020-05-21 15:29:55', '2020-06-09 20:52:18'),
(7, 'Jose Jorge Serafin João', 'jjsj@gmail.com', '598623741', 1, '$2y$10$AI4yOujcor2REVfT/K3bA.ZDZ3nDPRw44oe/0tDITG9pLunLToZaa', NULL, NULL, 0, '2020-06-17 15:09:43', NULL),
(8, 'Jorge Paiva', 'StandSPS@gmail.com', '983564712', 2, '$2y$10$OTLn6.QiAcUIVxmf1cU/newwfLTEecYFt6pZPhemANkFtkr1MWU3W', NULL, NULL, 0, '2020-06-17 15:14:08', NULL),
(9, 'Ola Adeus', '132@gmail.com', '123465798', 2, '$2y$10$bOk39fj3aejHQF/0VuwUg.35nFxvTbcS.6s6tWpzAmdBY9vFEaOFC', NULL, NULL, 0, '2020-06-17 15:58:44', NULL),
(10, 'ola', 'ola@ola.com', '123456789', 2, '$2y$10$ftiqMIyEBa7oWEkhxFGLTOwtr0Jc7VuXCBqMk7nVSCgT6b6Oa87HW', NULL, NULL, 0, '2020-06-17 16:00:41', NULL),
(11, 'Edu Silva', 'EduSilva@gmail.com', '369852147', 1, '$2y$10$rDd8IL0RvR9IsbN7ze7LAOAUbyBrUP5xAc/x5TZXNRAKbK6p1PB0.', '5ef22b884ab0e0.50079538.jpg', '5ef22b6c213cd4.92197352.jpg', 0, '2020-06-23 17:17:22', '2020-06-23 17:54:01'),
(20, 'Jack Black', 'ddsc2001.fifa12@gmail.com', '938355522', 1, '$2y$10$3oJ86KQJylyO.ni1.6wGneuq3baOVwGRmqZPRW3g.Q5Mtd4d.kKqO', NULL, NULL, 1, '2020-06-24 20:50:48', '2020-06-26 12:53:27');

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
  ADD KEY `Models` (`Model`),
  ADD KEY `card_image` (`Card_Image`);

--
-- Indexes for table `cars_favourits`
--
ALTER TABLE `cars_favourits`
  ADD PRIMARY KEY (`Favourits_Car_Id`);

--
-- Indexes for table `cars_images`
--
ALTER TABLE `cars_images`
  ADD PRIMARY KEY (`Id_Image`),
  ADD KEY `License_plate` (`License_Plate`),
  ADD KEY `Name` (`Name`);

--
-- Indexes for table `config_stands`
--
ALTER TABLE `config_stands`
  ADD PRIMARY KEY (`Id_CS`),
  ADD KEY `standid` (`Stand_Id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`Message_Id`),
  ADD KEY `MUS` (`User_Id`),
  ADD KEY `MUR` (`Receiver_Id`),
  ADD KEY `MCI` (`License_Plate`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`News_Id`),
  ADD KEY `News_Stand_Id` (`Stand_Id`),
  ADD KEY `News_User_Id` (`User_Id`);

--
-- Indexes for table `search_data_car`
--
ALTER TABLE `search_data_car`
  ADD PRIMARY KEY (`Search_Id`);

--
-- Indexes for table `stands`
--
ALTER TABLE `stands`
  ADD PRIMARY KEY (`Stand_Id`),
  ADD KEY `stands_users` (`User_Id`),
  ADD KEY `Names` (`Name`);

--
-- Indexes for table `stands_badges`
--
ALTER TABLE `stands_badges`
  ADD PRIMARY KEY (`Id_Badge`),
  ADD KEY `SIB` (`Stand_Id`);

--
-- Indexes for table `stands_banners`
--
ALTER TABLE `stands_banners`
  ADD PRIMARY KEY (`Id_Banner`),
  ADD KEY `SIS` (`Stand_Id`),
  ADD KEY `NameSIS` (`Banner_Name`);

--
-- Indexes for table `stands_favourits`
--
ALTER TABLE `stands_favourits`
  ADD PRIMARY KEY (`Favourits_Stand_Id`),
  ADD KEY `FSI` (`Stand_Id`),
  ADD KEY `USI` (`User_id`);

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
-- AUTO_INCREMENT for table `cars_favourits`
--
ALTER TABLE `cars_favourits`
  MODIFY `Favourits_Car_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `cars_images`
--
ALTER TABLE `cars_images`
  MODIFY `Id_Image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `config_stands`
--
ALTER TABLE `config_stands`
  MODIFY `Id_CS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `Message_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `News_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `search_data_car`
--
ALTER TABLE `search_data_car`
  MODIFY `Search_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `stands`
--
ALTER TABLE `stands`
  MODIFY `Stand_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `stands_badges`
--
ALTER TABLE `stands_badges`
  MODIFY `Id_Badge` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `stands_banners`
--
ALTER TABLE `stands_banners`
  MODIFY `Id_Banner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `stands_favourits`
--
ALTER TABLE `stands_favourits`
  MODIFY `Favourits_Stand_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `stand_ban`
--
ALTER TABLE `stand_ban`
  MODIFY `Stand_ban` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  ADD CONSTRAINT `card_image` FOREIGN KEY (`Card_Image`) REFERENCES `cars_images` (`Id_Image`),
  ADD CONSTRAINT `cars_stands` FOREIGN KEY (`Stand_Id`) REFERENCES `stands` (`Stand_Id`);

--
-- Limitadores para a tabela `cars_images`
--
ALTER TABLE `cars_images`
  ADD CONSTRAINT `License_plate` FOREIGN KEY (`License_Plate`) REFERENCES `cars` (`License_Plate`);

--
-- Limitadores para a tabela `config_stands`
--
ALTER TABLE `config_stands`
  ADD CONSTRAINT `standid` FOREIGN KEY (`Stand_Id`) REFERENCES `stands` (`Stand_Id`);

--
-- Limitadores para a tabela `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `MCI` FOREIGN KEY (`License_Plate`) REFERENCES `cars` (`License_Plate`),
  ADD CONSTRAINT `MUR` FOREIGN KEY (`Receiver_Id`) REFERENCES `users` (`User_Id`),
  ADD CONSTRAINT `MUS` FOREIGN KEY (`User_Id`) REFERENCES `users` (`User_Id`);

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
-- Limitadores para a tabela `stands_badges`
--
ALTER TABLE `stands_badges`
  ADD CONSTRAINT `SIB` FOREIGN KEY (`Stand_Id`) REFERENCES `stands` (`Stand_Id`);

--
-- Limitadores para a tabela `stands_banners`
--
ALTER TABLE `stands_banners`
  ADD CONSTRAINT `SIS` FOREIGN KEY (`Stand_Id`) REFERENCES `stands` (`Stand_Id`);

--
-- Limitadores para a tabela `stands_favourits`
--
ALTER TABLE `stands_favourits`
  ADD CONSTRAINT `FSI` FOREIGN KEY (`Stand_Id`) REFERENCES `stands` (`Stand_Id`),
  ADD CONSTRAINT `USI` FOREIGN KEY (`User_id`) REFERENCES `users` (`User_Id`);

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
