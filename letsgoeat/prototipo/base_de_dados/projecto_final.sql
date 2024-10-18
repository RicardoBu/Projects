-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2024 at 10:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projecto_final`
--

-- --------------------------------------------------------

--
-- Table structure for table `encomendas`
--

CREATE TABLE `encomendas` (
  `encomendaID` int(3) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `apelido` varchar(30) NOT NULL,
  `data_nascimento` date NOT NULL,
  `morada_envio` varchar(100) NOT NULL,
  `preco_total_encomenda` int(5) NOT NULL,
  `email` varchar(40) NOT NULL,
  `nome_produto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `encomendas`
--

INSERT INTO `encomendas` (`encomendaID`, `nome`, `apelido`, `data_nascimento`, `morada_envio`, `preco_total_encomenda`, `email`, `nome_produto`) VALUES
(20, 'Ana', 'Apelido3', '2005-05-05', 'Morada da Ana', 36, 'utilizador@email.pt', 'Salmao grelhado, Sardinhas assadas, Caril de peixe e camarao'),
(21, 'rui', 'ruiapelido', '2003-03-03', 'Morada do rui', 16, 'utilizador@email.pt', 'Frango assado com batata-doce , Bife de Alcatra com Molho Crem'),
(22, 'Alfredo', 'Alfredes', '1999-09-09', 'Morada do Alfredo', 23, 'utilizador@email.pt', 'Arroz de coelho e lentilhas, Frango grelhado com Massa Alfr, Peixe Cozido(pescada)'),
(25, 'Outro utilizador', 'Outro apelido', '2000-10-10', 'Morada do outro utilizador', 16, 'outroutilizador@email.pt', 'Carne Louca no Pão, Espetadas de Peixe'),
(27, 'm,lx.ñ-', '.`çacs-¨X', '2001-01-01', 'gddfgd', 26, 'utilizador@email.pt', 'Robalo grelhado, Salmao grelhado'),
(28, 'm,lx.ñ-', '.`çacs-¨X', '2001-01-01', 'gddfgd', 39, 'utilizador@email.pt', 'Almôndegas de Peru c/ molho cr, Frango assado com batata-doce , Robalo grelhado, Salmao grelhado'),
(29, 'Nome', 'Apelido', '2006-07-07', 'Morada de envio', 22, 'utilizador@email.pt', 'Espetadas de Peixe');

-- --------------------------------------------------------

--
-- Table structure for table `pedidos_temp`
--

CREATE TABLE `pedidos_temp` (
  `id` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `produtos_selecionados` text DEFAULT NULL,
  `quantidade` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produtos`
--

CREATE TABLE `produtos` (
  `produtoID` int(3) NOT NULL,
  `quantidade` int(3) NOT NULL,
  `preco` int(5) NOT NULL,
  `nome_produto` varchar(30) NOT NULL,
  `tipo_comida` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produtos`
--

INSERT INTO `produtos` (`produtoID`, `quantidade`, `preco`, `nome_produto`, `tipo_comida`) VALUES
(1, 8, 7, 'Almôndegas de Peru c/ molho cr', 'Carne'),
(2, 7, 6, 'Frango assado com batata-doce ', 'Carne'),
(3, 9, 5, 'Carne Louca no Pão', 'Carne'),
(4, 9, 10, 'Bife de Alcatra com Molho Crem', 'Carne'),
(5, 9, 9, 'Arroz de coelho e lentilhas', 'Carne'),
(6, 9, 8, 'Frango grelhado com Massa Alfr', 'Carne'),
(7, 8, 6, 'Peixe Cozido(pescada)', 'Peixe'),
(8, 6, 11, 'Espetadas de Peixe', 'Peixe'),
(9, 7, 12, 'Robalo grelhado', 'Peixe'),
(10, 7, 14, 'Salmao grelhado', 'Peixe'),
(11, 8, 10, 'Sardinhas assadas', 'Peixe'),
(12, 7, 12, 'Caril de peixe e camarao', 'Peixe'),
(13, 15, 10, 'Cabidela', 'Carne');

-- --------------------------------------------------------

--
-- Table structure for table `produtos_encomenda`
--

CREATE TABLE `produtos_encomenda` (
  `id` int(11) NOT NULL,
  `encomendaID` int(11) DEFAULT NULL,
  `produtoID` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produtos_encomenda`
--

INSERT INTO `produtos_encomenda` (`id`, `encomendaID`, `produtoID`, `quantidade`, `preco`) VALUES
(1, 20, 10, 1, 14.00),
(2, 20, 11, 1, 10.00),
(3, 20, 12, 1, 12.00),
(4, 21, 2, 1, 6.00),
(5, 21, 4, 1, 10.00),
(6, 22, 5, 1, 9.00),
(7, 22, 6, 1, 8.00),
(8, 22, 7, 1, 6.00),
(13, 25, 3, 1, 5.00),
(14, 25, 8, 1, 11.00),
(17, 27, 9, 1, 12.00),
(18, 27, 10, 1, 14.00),
(19, 28, 1, 1, 7.00),
(20, 28, 2, 1, 6.00),
(21, 28, 9, 1, 12.00),
(22, 28, 10, 1, 14.00),
(23, 29, 8, 2, 22.00);

-- --------------------------------------------------------

--
-- Table structure for table `utilizadores`
--

CREATE TABLE `utilizadores` (
  `utilizadorID` int(3) NOT NULL,
  `email` varchar(40) NOT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `comp_admin` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilizadores`
--

INSERT INTO `utilizadores` (`utilizadorID`, `email`, `senha`, `comp_admin`) VALUES
(5, 'admin@email.pt', '$2y$10$x6oj6CptkF8Ix/wJjYp4rutm.D.hwJJLP8Ym1/jRT2frCspNgi8ui', '1'),
(6, 'utilizador@email.pt', '$2y$10$6JBKqiDdzNiXfFJUNNVja.eBy43z0V6G/NucQu4J1A5AFeFB7Uq..', '0'),
(7, 'outroutilizador@email.pt', '$2y$10$apLbRvunyl5WPH1kxhjj5elAb5JENjgb/vwycSTURKAg1CED86K8y', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `encomendas`
--
ALTER TABLE `encomendas`
  ADD PRIMARY KEY (`encomendaID`),
  ADD KEY `fk_email` (`email`);

--
-- Indexes for table `pedidos_temp`
--
ALTER TABLE `pedidos_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`produtoID`),
  ADD UNIQUE KEY `nome_produto` (`nome_produto`);

--
-- Indexes for table `produtos_encomenda`
--
ALTER TABLE `produtos_encomenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `encomendaID` (`encomendaID`),
  ADD KEY `produtoID` (`produtoID`);

--
-- Indexes for table `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`utilizadorID`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `encomendas`
--
ALTER TABLE `encomendas`
  MODIFY `encomendaID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pedidos_temp`
--
ALTER TABLE `pedidos_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `produtoID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `produtos_encomenda`
--
ALTER TABLE `produtos_encomenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `utilizadorID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produtos_encomenda`
--
ALTER TABLE `produtos_encomenda`
  ADD CONSTRAINT `produtos_encomenda_ibfk_1` FOREIGN KEY (`encomendaID`) REFERENCES `encomendas` (`encomendaID`),
  ADD CONSTRAINT `produtos_encomenda_ibfk_2` FOREIGN KEY (`produtoID`) REFERENCES `produtos` (`produtoID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
