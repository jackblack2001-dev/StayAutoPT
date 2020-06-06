-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 06-Jun-2020 às 15:56
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
  `Card_Image` int(11) DEFAULT NULL,
  `CreatedCar` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedCar` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `cars`
--

INSERT INTO `cars` (`License_Plate`, `Stand_Id`, `Kms`, `Year`, `Type_Gear`, `Brand`, `Model`, `Type_Fuel`, `Price`, `Description`, `State`, `Views`, `Card_Image`, `CreatedCar`, `UpdatedCar`) VALUES
('56-hj-45', 1, 65, 2005, 1, 'Astron', 'Martin', 1, 18, 'tfhfhfgfg', 1, 0, NULL, '2020-05-28 15:38:10', NULL),
('66-66-66', 1, 2147483647, 1966, 1, 'carroça', 'velha', 1, 10000000, 'é um carro meuito velho que merece respeito', 1, 1, NULL, '2020-05-05 11:11:12', '2020-05-12 18:34:35'),
('A5-55-GG', 1, 100000, 1999, 0, 'Null', 'Not null', 0, 12000, 'GG master', 2, 0, NULL, '2020-03-11 07:36:16', '2020-05-12 17:51:51'),
('A5-66-GG', 1, 100000, 1999, 0, 'Null', 'sfgh', 0, 12000, 'GG master', 2, 0, NULL, '2020-03-21 12:26:00', '2020-05-12 17:51:46'),
('B4-66-34', 1, 1020110, 2001, 1, 'Opel', 'Corsa', 1, 8000, 'fd sfase fsdfs faes gf', 2, 0, NULL, '2020-05-05 10:32:52', '2020-05-12 18:29:14'),
('bx-88-f5', 1, 200000, 1988, 1, 'Opel', 'Carrinha bonita', 1, 80000, 'fkduyghnsdoi fgysdouf', 1, 0, NULL, '2020-05-29 11:12:43', NULL),
('GG-86-L5', 1, 1020110, 2010, 2, 'Astron', 'Martin', 1, 999999999, 'Este carro é demasiado caro para o teu bolso', 1, 0, NULL, '2020-05-05 10:34:50', '2020-05-12 18:29:05'),
('GH-76-6K', 1, 0, 2020, 1, 'Ford', 'Focus RXT Defenitive Version Master Id', 1, 999, 'Este modelo e muito fixe', 2, 1, NULL, '2020-05-05 10:51:23', '2020-05-12 18:34:42'),
('LL-HH-YY', 1, 999000, 1992, 1, 'jaguar', 'jx220', 1, 6660, 'Um carro da Decada de 90a que conta com uma elegancia que só mesmo a jauguar sabe dar aos seus carros', 1, 658, NULL, '2020-05-29 13:02:31', '2020-06-01 16:36:08'),
('LQ-66-97', 1, 100000, 1997, 1, 'Fiat', 'Uno Turbo mk1', 1, 3000, 'Um fiat Uno em otimas condições, equipado com um turbo GT 2056', 1, 0, NULL, '2020-05-30 13:53:13', NULL),
('TT-TT-TT', 1, 2147483647, 1920, 1, 'carroça', 'Carrinha bonita', 2, 121212121212, 'MUITO ANTIGA', 1, 0, NULL, '2020-05-29 11:27:15', NULL),
('X5-Y6-Z7', 1, 0, 2020, 1, 'Ford', 'Lindo', 1, 99000, 'É um carro novo artilhado de tecnologia', 1, 0, NULL, '2020-05-29 11:34:15', NULL),
('YH-3F-5T', 1, 100000, 2005, 1, 'Volkswagen', 'Golfo', 1, 2000, 'Um carro de Cidade que é prefeito para todos os amantes de carros', 1, 0, NULL, '2020-05-29 12:56:23', NULL);

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
(65, 'LQ-66-97', '5ed256b3644d89.96825300.jpg', 1, '2020-05-30 13:53:38', NULL),
(66, 'LQ-66-97', '5ed38a63b9a8b6.60494233.jpg', 1, '2020-05-31 11:43:50', NULL),
(67, 'LQ-66-97', '5ed38a61686b27.61287047.jpg', 1, '2020-05-31 11:43:50', NULL),
(68, 'LQ-66-97', '5ed38a5f0d7742.91070018.jpg', 1, '2020-05-31 11:43:50', NULL),
(69, 'LQ-66-97', '5ed38a5c7f1f41.50093124.jpg', 1, '2020-05-31 11:43:50', NULL),
(70, 'LQ-66-97', '5ed38a59209583.40787161.jpg', 1, '2020-05-31 11:43:50', NULL);

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
(1, 1, 'card_c:card_p:card_n:card_nc', 4, 4);

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
(6, 1, 1, 'Lindo muito Lindo', '<h1><a href=\"https://www.facebook.com/photo.php?fbid=1053665681447611&amp;set=a.346639062150280&amp;type=3&amp;theater\" target=\"_blank\"><img alt=\"Lindo a Caturra\" src=\"https://scontent.fopo1-1.fna.fbcdn.net/v/t31.0-8/s960x960/29663178_1053665681447611_1282819308269979957_o.jpg?_nc_cat=100&amp;_nc_sid=110474&amp;_nc_ohc=KEY71hrq86EAX8Cg9qV&amp;_nc_ht=scontent.fopo1-1.fna&amp;_nc_tp=7&amp;oh=07b83c6ed31322c402f66192c4714066&amp;oe=5F00538F\" style=\"float:left; height:300px; margin-bottom:10px; margin-top:10px; width:300px\" /></a>O lindo &eacute; um passarinho</h1>\r\n\r\n<p><code>Sabem qual &eacute; a melhor coisa a cerca do lindo?</code></p>\r\n\r\n<div style=\"background:#eeeeee; border:1px solid #cccccc; padding:5px 10px\">&Eacute; que o&nbsp;<span class=\"marker\">Lindo</span>&nbsp;&eacute; um passarinho que&nbsp;<em>gosta muito de sementes</em>&nbsp;</div>\r\n\r\n<p><var>O lindo &eacute; muito Kawai UwU</var>&nbsp;</p>\r\n', 1, '2020-06-05 12:43:51', '2020-06-05 19:13:28');

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
  `Banner` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Badge` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedStand` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedStand` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `stands`
--

INSERT INTO `stands` (`Stand_Id`, `User_Id`, `Phone`, `Adress`, `Locality`, `Name`, `Views`, `Banner`, `Badge`, `CreatedStand`, `UpdatedStand`) VALUES
(1, 1, '938366677', 'Rua do Arco ', 'Viseu', 'Initial D the Ultimate Stand', 1, '5edb9e9748b630.89603209.jpg', '5edb9ead0e1a70.11502605.jpg', '0000-00-00 00:00:00', '2020-06-06 14:50:22'),
(2, 5, '889377722', 'Rua das Ruas 101', 'Viseu', 'CarrosCarinhos', 0, NULL, NULL, '0000-00-00 00:00:00', NULL);

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
  `createdAccount` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAccount` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`User_Id`, `Name`, `Email`, `Phone`, `Profile`, `Password`, `Banner`, `Badge`, `createdAccount`, `updateAccount`) VALUES
(1, 'David Coelho', 'ddsc2001@gmail.com', '996683254', 2, '$2y$10$rpwpf9UXeqxu/jgo7JB1TexZWwK7rFhAm4esZDojP.vJE9M/asHs6', '5ed0e974784653.70049562.jpg', '5ed0f51b3a8d55.32124935.jpg', '2019-04-10 12:15:24', '2020-05-29 12:42:19'),
(2, 'admin', 'admin@admin.com', '938366677', 0, '$2y$10$CDhswNyixY8rYpzRpJdqkeXqL0gi5EmB1pKkaJrhwkCj1VKG5Aq26', '5ec7ae0ea5e6f3.54048202.jpg', '5ec7ae88280104.83625511.jpg', '2020-03-18 07:51:04', '2020-05-22 11:50:48'),
(3, 'Teste', 'teste@teste.com', '983564721', 1, '$2y$10$Rw8aadCvBUI8PpzRaLS/Wu9hj3jpC1teg2zwL/11NKRqrgnl3l4JG', NULL, NULL, '2020-05-09 12:06:38', '2020-05-15 11:14:24'),
(4, 'Armindo Pereira', 'AP1980@gmail.com', '958674321', 1, '$2y$10$Rw8aadCvBUI8PpzRaLS/Wu9hj3jpC1teg2zwL/11NKRqrgnl3l4JG', NULL, NULL, '2020-05-13 13:17:38', '2020-05-10 16:38:17'),
(5, 'Joes nada', 'joes@nada.pt', '383559557', 2, '$2y$10$fVF3m.LmTtfZU1X2mQIJeOYhJBXBJiZPsnswAlMdJ8yQR/BTxPi16', NULL, NULL, '2020-05-18 15:16:14', '2020-05-18 15:25:34'),
(6, 'JO MAMA', 'Jomama@gmail.com', '968677745', 2, '$2y$10$wbDUd/a/dqqrpT2jP8vYReDanDXPLEIwJ3o4br7VYlM.N/c8AJ2ee', '5ec7bd53dd3640.88202760.jpg', '5ec7d42be28f41.84078220.jpg', '2020-05-21 15:29:55', '2020-05-22 14:32:15');

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
-- AUTO_INCREMENT for table `cars_images`
--
ALTER TABLE `cars_images`
  MODIFY `Id_Image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `config_stands`
--
ALTER TABLE `config_stands`
  MODIFY `Id_CS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `News_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `User_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
