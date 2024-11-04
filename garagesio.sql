-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 23 oct. 2024 à 23:49
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `garagesio`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `adresse_mail` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `couleur`
--

DROP TABLE IF EXISTS `couleur`;
CREATE TABLE IF NOT EXISTS `couleur` (
  `ID` int NOT NULL,
  `Nom_couleur` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `couleur`
--

INSERT INTO `couleur` (`ID`, `Nom_couleur`) VALUES
(1, 'Rouge'),
(2, 'Noir'),
(3, 'Bleu'),
(4, 'Blanc'),
(5, 'Vert'),
(6, 'Gris');

-- --------------------------------------------------------

--
-- Structure de la table `garagistes`
--

DROP TABLE IF EXISTS `garagistes`;
CREATE TABLE IF NOT EXISTS `garagistes` (
  `idg` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `MDP` varchar(255) NOT NULL,
  PRIMARY KEY (`idg`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `garagistes`
--

INSERT INTO `garagistes` (`idg`, `email`, `MDP`) VALUES
(1, 'admin@gmail.com', 'admin12345');

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

DROP TABLE IF EXISTS `marque`;
CREATE TABLE IF NOT EXISTS `marque` (
  `ID` int NOT NULL,
  `Nom_marque` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `marque`
--

INSERT INTO `marque` (`ID`, `Nom_marque`) VALUES
(0, 'Audi'),
(1, 'RAM'),
(2, 'Fiat'),
(3, 'Ford'),
(4, 'Jeep'),
(5, 'Renault'),
(6, 'Suzuki'),
(7, 'Volkswagen');

-- --------------------------------------------------------

--
-- Structure de la table `modele`
--

DROP TABLE IF EXISTS `modele`;
CREATE TABLE IF NOT EXISTS `modele` (
  `ID` int NOT NULL,
  `ID_marque` int DEFAULT NULL,
  `Nom_modele` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_marque` (`ID_marque`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `modele`
--

INSERT INTO `modele` (`ID`, `ID_marque`, `Nom_modele`) VALUES
(1, 0, 'Petites voitures'),
(2, 0, 'Voitures compactes'),
(3, 0, 'Grosses voitures'),
(4, 0, 'SUV'),
(5, 0, 'Voitures de sport'),
(6, 0, 'Grandes voitures familiales'),
(7, 1, 'Petites voitures'),
(8, 1, 'Voitures compactes'),
(9, 1, 'Grosses voitures'),
(10, 1, 'SUV'),
(11, 1, 'Voitures de sport'),
(12, 1, 'Grandes voitures familiales'),
(13, 2, 'Petites voitures'),
(14, 2, 'Voitures compactes'),
(15, 2, 'Grosses voitures'),
(16, 2, 'SUV'),
(17, 2, 'Voitures de sport'),
(18, 2, 'Grandes voitures familiales'),
(19, 3, 'Petites voitures'),
(20, 3, 'Voitures compactes'),
(21, 3, 'Grosses voitures'),
(22, 3, 'SUV'),
(23, 3, 'Voitures de sport'),
(24, 3, 'Grandes voitures familiales'),
(25, 4, 'Petites voitures'),
(26, 4, 'Voitures compactes'),
(27, 4, 'Grosses voitures'),
(28, 4, 'SUV'),
(29, 4, 'Voitures de sport'),
(30, 4, 'Grandes voitures familiales'),
(31, 5, 'Petites voitures'),
(32, 5, 'Voitures compactes'),
(33, 5, 'Grosses voitures'),
(34, 5, 'SUV'),
(35, 5, 'Voitures de sport'),
(36, 5, 'Grandes voitures familiales'),
(37, 6, 'Petites voitures'),
(38, 6, 'Voitures compactes'),
(39, 6, 'Grosses voitures'),
(40, 6, 'SUV'),
(41, 6, 'Voitures de sport'),
(42, 6, 'Grandes voitures familiales'),
(43, 7, 'Petites voitures'),
(44, 7, 'Voitures compactes'),
(45, 7, 'Grosses voitures'),
(46, 7, 'SUV'),
(47, 7, 'Voitures de sport'),
(48, 7, 'Grandes voitures familiales');

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

DROP TABLE IF EXISTS `vehicule`;
CREATE TABLE IF NOT EXISTS `vehicule` (
  `ID` int NOT NULL,
  `ID_modele` int DEFAULT NULL,
  `ID_couleur` int DEFAULT NULL,
  `Immatriculation` varchar(20) DEFAULT NULL,
  `Date_premiere_mise_en_circulation` date DEFAULT NULL,
  `Prix` decimal(10,2) DEFAULT NULL,
  `Date_rentree_garage` date DEFAULT NULL,
  `Nombre_chevaux` int DEFAULT NULL,
  `Description` text,
  `ID_marque` int DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_modele` (`ID_modele`),
  KEY `ID_couleur` (`ID_couleur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`ID`, `ID_modele`, `ID_couleur`, `Immatriculation`, `Date_premiere_mise_en_circulation`, `Prix`, `Date_rentree_garage`, `Nombre_chevaux`, `Description`, `ID_marque`) VALUES
(0, 2, 2, '298457NC', '2013-06-17', '1885000.00', '2023-08-11', 147, 'La Ford Fiesta, compacte et polyvalente, offre une conduite dynamique et des fonctionnalités innovantes, en faisant un choix idéal pour la ville et les déplacements quotidiens.', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
