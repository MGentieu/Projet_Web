-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : jeu. 14 déc. 2023 à 10:29
-- Version du serveur : 5.7.39
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ece_in`
--

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

CREATE TABLE `formation` (
  `Ecole` varchar(255) NOT NULL,
  `Diplome` varchar(255) NOT NULL,
  `DomaineEtudes` varchar(255) NOT NULL,
  `DataDebut` date NOT NULL,
  `DateFin` date NOT NULL,
  `Resultat` varchar(255) NOT NULL,
  `mailusers` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`Ecole`, `Diplome`, `DomaineEtudes`, `DataDebut`, `DateFin`, `Resultat`, `mailusers`) VALUES
('rrnjefnerreg', 'gregr', 'rggre', '2023-12-05', '2023-12-07', 'rege', ''),
('a', 'a', 'a', '2024-01-18', '2023-12-13', 'a', 'a'),
('f', 'f', 'f', '2023-12-13', '2023-12-06', 'f', 'f'),
('lllllll', 'lllmmm', 'm', '2023-12-05', '2023-12-29', 'k', 'k'),
('grooooooosssseeee', 'puttttteeee', 'de', '2023-12-15', '2023-12-29', 'matière de con', 'matière de con');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`mailusers`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
