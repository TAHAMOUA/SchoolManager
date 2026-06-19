-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2026 at 04:36 PM
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
-- Database: `school_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `affectation`
--

CREATE TABLE `affectation` (
  `id_affectation` int(11) NOT NULL,
  `date_affectation` date DEFAULT curdate(),
  `id_enseignant` int(11) NOT NULL,
  `id_classe` int(11) NOT NULL,
  `id_matiere` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `affectation`
--

INSERT INTO `affectation` (`id_affectation`, `date_affectation`, `id_enseignant`, `id_classe`, `id_matiere`) VALUES
(1, '2025-09-01', 1, 1, 1),
(2, '2025-09-01', 2, 1, 2),
(3, '2025-09-02', 3, 2, 3),
(4, '2025-09-02', 4, 3, 4),
(5, '2025-09-03', 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `classe`
--

CREATE TABLE `classe` (
  `id_classe` int(11) NOT NULL,
  `nom_classe` varchar(50) NOT NULL,
  `niveau` varchar(50) NOT NULL,
  `capacite_max` int(11) NOT NULL CHECK (`capacite_max` > 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classe`
--

INSERT INTO `classe` (`id_classe`, `nom_classe`, `niveau`, `capacite_max`) VALUES
(1, '1BAC-SM', '1ère Bac', 30),
(2, '2BAC-SM', '2ème Bac', 30),
(3, 'TC-SCI', 'Tronc Commun', 35);

-- --------------------------------------------------------

--
-- Table structure for table `eleve`
--

CREATE TABLE `eleve` (
  `id_eleve` int(11) NOT NULL,
  `matricule` varchar(20) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `date_naissance` date DEFAULT NULL,
  `sexe` enum('M','F') DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eleve`
--

INSERT INTO `eleve` (`id_eleve`, `matricule`, `nom`, `prenom`, `date_naissance`, `sexe`, `adresse`, `telephone`, `email`) VALUES
(1, 'ELV001', 'Alaoui', 'Youssef', '2008-05-12', 'M', 'Beni Mellal', '0612345678', 'youssef@example.com'),
(2, 'ELV002', 'Karimi', 'Salma', '2007-09-21', 'F', 'Casablanca', '0623456789', 'salma@example.com'),
(3, 'ELV003', 'Idrissi', 'Amine', '2008-01-15', 'M', 'Fes', '0634567890', 'amine@example.com'),
(4, 'ELV004', 'Bennani', 'Sara', '2007-11-30', 'F', 'Rabat', '0645678901', 'sara@example.com'),
(5, 'ELV005', 'Tazi', 'Omar', '2008-03-08', 'M', 'Marrakech', '0656789012', 'omar@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `enseignant`
--

CREATE TABLE `enseignant` (
  `id_enseignant` int(11) NOT NULL,
  `matricule` varchar(20) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `specialite` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enseignant`
--

INSERT INTO `enseignant` (`id_enseignant`, `matricule`, `nom`, `prenom`, `email`, `telephone`, `specialite`) VALUES
(1, 'ENS001', 'Benali', 'Ahmed', 'ahmed.benali@school.ma', '0661111111', 'Mathématiques'),
(2, 'ENS002', 'Lahlou', 'Fatima', 'fatima.lahlou@school.ma', '0662222222', 'Français'),
(3, 'ENS003', 'El Fassi', 'Khalid', 'khalid.elfassi@school.ma', '0663333333', 'Physique'),
(4, 'ENS004', 'Amrani', 'Nadia', 'nadia.amrani@school.ma', '0664444444', 'Informatique');

-- --------------------------------------------------------

--
-- Table structure for table `enseigner`
--

CREATE TABLE `enseigner` (
  `id_enseignant` int(11) NOT NULL,
  `id_matiere` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enseigner`
--

INSERT INTO `enseigner` (`id_enseignant`, `id_matiere`) VALUES
(1, 1),
(1, 3),
(2, 2),
(3, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `inscription`
--

CREATE TABLE `inscription` (
  `id_inscription` int(11) NOT NULL,
  `annee_scolaire` varchar(9) NOT NULL,
  `date_inscription` date DEFAULT curdate(),
  `id_eleve` int(11) NOT NULL,
  `id_classe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inscription`
--

INSERT INTO `inscription` (`id_inscription`, `annee_scolaire`, `date_inscription`, `id_eleve`, `id_classe`) VALUES
(1, '2025-2026', '2025-09-01', 1, 1),
(2, '2025-2026', '2025-09-01', 2, 1),
(3, '2025-2026', '2025-09-02', 3, 2),
(4, '2025-2026', '2025-09-03', 4, 3),
(5, '2025-2026', '2025-09-03', 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `matiere`
--

CREATE TABLE `matiere` (
  `id_matiere` int(11) NOT NULL,
  `nom_matiere` varchar(100) NOT NULL,
  `coefficient` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matiere`
--

INSERT INTO `matiere` (`id_matiere`, `nom_matiere`, `coefficient`) VALUES
(1, 'Mathématiques', 7),
(2, 'Français', 3),
(3, 'Physique', 5),
(4, 'Informatique', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `affectation`
--
ALTER TABLE `affectation`
  ADD PRIMARY KEY (`id_affectation`),
  ADD UNIQUE KEY `id_enseignant` (`id_enseignant`,`id_classe`,`id_matiere`),
  ADD KEY `id_classe` (`id_classe`),
  ADD KEY `id_matiere` (`id_matiere`);

--
-- Indexes for table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id_classe`);

--
-- Indexes for table `eleve`
--
ALTER TABLE `eleve`
  ADD PRIMARY KEY (`id_eleve`),
  ADD UNIQUE KEY `matricule` (`matricule`);

--
-- Indexes for table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id_enseignant`),
  ADD UNIQUE KEY `matricule` (`matricule`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `enseigner`
--
ALTER TABLE `enseigner`
  ADD PRIMARY KEY (`id_enseignant`,`id_matiere`),
  ADD KEY `id_matiere` (`id_matiere`);

--
-- Indexes for table `inscription`
--
ALTER TABLE `inscription`
  ADD PRIMARY KEY (`id_inscription`),
  ADD UNIQUE KEY `id_eleve` (`id_eleve`,`annee_scolaire`),
  ADD KEY `id_classe` (`id_classe`);

--
-- Indexes for table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`id_matiere`),
  ADD UNIQUE KEY `nom_matiere` (`nom_matiere`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `affectation`
--
ALTER TABLE `affectation`
  MODIFY `id_affectation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `classe`
--
ALTER TABLE `classe`
  MODIFY `id_classe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `eleve`
--
ALTER TABLE `eleve`
  MODIFY `id_eleve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `id_enseignant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inscription`
--
ALTER TABLE `inscription`
  MODIFY `id_inscription` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `matiere`
--
ALTER TABLE `matiere`
  MODIFY `id_matiere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `affectation`
--
ALTER TABLE `affectation`
  ADD CONSTRAINT `affectation_ibfk_1` FOREIGN KEY (`id_enseignant`) REFERENCES `enseignant` (`id_enseignant`) ON UPDATE CASCADE,
  ADD CONSTRAINT `affectation_ibfk_2` FOREIGN KEY (`id_classe`) REFERENCES `classe` (`id_classe`) ON UPDATE CASCADE,
  ADD CONSTRAINT `affectation_ibfk_3` FOREIGN KEY (`id_matiere`) REFERENCES `matiere` (`id_matiere`) ON UPDATE CASCADE;

--
-- Constraints for table `enseigner`
--
ALTER TABLE `enseigner`
  ADD CONSTRAINT `enseigner_ibfk_1` FOREIGN KEY (`id_enseignant`) REFERENCES `enseignant` (`id_enseignant`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enseigner_ibfk_2` FOREIGN KEY (`id_matiere`) REFERENCES `matiere` (`id_matiere`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `inscription_ibfk_1` FOREIGN KEY (`id_eleve`) REFERENCES `eleve` (`id_eleve`) ON UPDATE CASCADE,
  ADD CONSTRAINT `inscription_ibfk_2` FOREIGN KEY (`id_classe`) REFERENCES `classe` (`id_classe`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
