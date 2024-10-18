-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2024 at 11:12 PM
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
-- Database: `casopracticophp`
--

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `ID` int(6) NOT NULL,
  `Email` int(50) NOT NULL,
  `Nome` varchar(20) NOT NULL,
  `Apelido` varchar(20) NOT NULL,
  `Profissao` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`ID`, `Email`, `Nome`, `Apelido`, `Profissao`) VALUES
(27, 0, 'moñkl', 'mk', 'mkal'),
(30, 0, 'Outro nome', 'Outro apelido', 'Outra profissao');

-- --------------------------------------------------------

--
-- Table structure for table `marcacoes`
--

CREATE TABLE `marcacoes` (
  `ID` int(6) NOT NULL,
  `Utilizador` varchar(30) NOT NULL,
  `Hora` varchar(100) NOT NULL,
  `Data da consulta` varchar(100) NOT NULL,
  `Descricao` varchar(300) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `marcacoes`
--

INSERT INTO `marcacoes` (`ID`, `Utilizador`, `Hora`, `Data da consulta`, `Descricao`, `Email`) VALUES
(14, 'segundoemail@email.pt', '18:00', '2024-09-10', 'Consulta', 'segundoemail@email.pt'),
(15, 'primeiroemail@email.pt', '15:00', '2024-09-12', 'Consulta', 'topadmin@email.pt'),
(16, 'primeiroemail@email.pt', '19:00', '2024-09-12', 'Consulta\r\n', 'primeiroemail@email.pt'),
(17, 'segundoemail@email.pt', '18:00', '2024-09-13', 'Consulta\r\n', 'segundoemail@email.pt'),
(18, 'iomñl,', '17:00', '2024-11-01', 'bhunljk.m,.', 'topadmin@email.pt'),
(19, 'Primeiro Utilizador', '14:00', '2024-10-01', 'nijcklmas.d', 'topadmin@email.pt'),
(20, 'Segundo Utilizador', '18:00', '2024-10-31', 'njk.m,..', 'segundoemail@email.pt'),
(21, 'nñmkl.,', '18:00', '2024-10-15', 'nuimñkl,.', 'primeiroemail@email.pt');

-- --------------------------------------------------------

--
-- Table structure for table `noticias`
--

CREATE TABLE `noticias` (
  `ID` int(6) NOT NULL,
  `Titulo` varchar(50) NOT NULL,
  `Conteudo` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `noticias`
--

INSERT INTO `noticias` (`ID`, `Titulo`, `Conteudo`) VALUES
(2644, 'The 6 Best Cloud Based POS Systems Reviewed for 20', 'An on-premise implementation might work for some businesses, but most benefit from the flexibility and convenience of cloud-based POS solutions.'),
(2645, 'Threat Actors Exploit Microsoft Sway to Host QR Co', 'Threat actors are abusing Microsoft Sway to host QR Code phishing campaigns.'),
(2646, 'Controversial California AI Law Moves Forward with', 'SB-1047 would provide whistleblower protections and oversight for companies developing generative AI capable of “critical harm.”'),
(2647, 'Is a Virtual Contact Center Viable for Busy Compan', 'Discover why a virtual contact center is a no-brainer for cutting costs, enhancing customer experiences, and letting agents work remotely.'),
(2648, 'Contact Centers: The Complete Guide for Beginners', 'Learn everything you need to know about contact centers, from terminology and features to enterprise capabilities and deployment types. '),
(2649, 'Volt Typhoon Hackers Exploit Zero-Day Vulnerabilit', 'There are approximately 163 devices worldwide that are still exposed to attack via the CVE-2024-39717 vulnerability.'),
(2650, 'Get Secure Cloud Storage on a 2TB Lifetime Plan Wi', 'This secure storage platform uses open source code, zero-knowledge file systems, and end-to-end encryption to keep your online data truly private.'),
(2651, 'Google Gemini Cheat Sheet (Formerly Google Bard): ', 'Everything you need to know to get started with Gemini, Google’s generative AI.'),
(2652, 'NordVPN vs Proton VPN (2024): Which VPN Should You', 'While Proton VPN’s strong focus on privacy is enticing, NordVPN’s fast-performing and all-around\nVPN service is the better overall package between the two.\n'),
(2653, 'Don’t Leave Your Digital Security to Chance: Get N', 'Norton 360 Standard offers award-winning protection for your digital life — malware defense, cloud backup, and a VPN — for just $17.99 for a 15-month plan.'),
(2654, 'The 6 Best Cloud Based POS Systems Reviewed for 20', 'An on-premise implementation might work for some businesses, but most benefit from the flexibility and convenience of cloud-based POS solutions.'),
(2655, 'Threat Actors Exploit Microsoft Sway to Host QR Co', 'Threat actors are abusing Microsoft Sway to host QR Code phishing campaigns.'),
(2656, 'Controversial California AI Law Moves Forward with', 'SB-1047 would provide whistleblower protections and oversight for companies developing generative AI capable of “critical harm.”'),
(2657, 'Is a Virtual Contact Center Viable for Busy Compan', 'Discover why a virtual contact center is a no-brainer for cutting costs, enhancing customer experiences, and letting agents work remotely.'),
(2658, ' Hackers Exploit Zero-Day Vulnerabilit', ' 163 devices worldwide that are still exposed to attack via the CVE-2024-39717 vulnerability.');

-- --------------------------------------------------------

--
-- Table structure for table `projectos`
--

CREATE TABLE `projectos` (
  `ID` int(6) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Dados do Projecto` varchar(150) NOT NULL,
  `Tecnologia Usada` varchar(150) NOT NULL,
  `Tempo de Conclusao` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `projectos`
--

INSERT INTO `projectos` (`ID`, `Email`, `Dados do Projecto`, `Tecnologia Usada`, `Tempo de Conclusao`) VALUES
(12, 'terceiroemail@email.pt', 'vmioaeñcl,', 'mkvl,aeñ-c', 'mkl,vañc.ds'),
(13, 'primeiroemail@email.pt', 'Outro projecto', 'Uvas', '1 hora');

-- --------------------------------------------------------

--
-- Table structure for table `utilizadores`
--

CREATE TABLE `utilizadores` (
  `ID` int(6) NOT NULL,
  `Admin` varchar(30) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Senha` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `utilizadores`
--

INSERT INTO `utilizadores` (`ID`, `Admin`, `Email`, `Senha`) VALUES
(9, 'topadmin', 'topadmin@email.pt', '$2y$10$WPPVVr0tfpbJ75IXTOROTeaoi8UBx/vs5Yd1s0c7WVjluWLwr4Dp6'),
(12, 'sim', 'primeiroemail@email.pt', '$2y$10$qRXbqtx.5L7InC.g3G1bP.tyeCEMGNQ5r7ggwRWc0BOhg4dCdn7Qy'),
(15, 'nao', 'segundoemail@email.pt', '$2y$10$a2gUpFkXFJ2.wMegIX1uN.0HzWGZfgqdIpjdzT1hItplPYAIWESwa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `marcacoes`
--
ALTER TABLE `marcacoes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `projectos`
--
ALTER TABLE `projectos`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `marcacoes`
--
ALTER TABLE `marcacoes`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `noticias`
--
ALTER TABLE `noticias`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2663;

--
-- AUTO_INCREMENT for table `projectos`
--
ALTER TABLE `projectos`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
