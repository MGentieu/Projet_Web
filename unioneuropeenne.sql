-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 21 mai 2023 à 19:26
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tpnote2`
--

-- --------------------------------------------------------

--
-- Structure de la table `unioneuropeenne`
--

DROP TABLE IF EXISTS `unioneuropeenne`;
CREATE TABLE IF NOT EXISTS `unioneuropeenne` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Pays` varchar(255) NOT NULL,
  `Capitale` varchar(255) NOT NULL,
  `Superficie` int(11) NOT NULL,
  `DateAdhesion` int(11) NOT NULL,
  `Population` decimal(10,2) NOT NULL,
  `Devise` varchar(255) NOT NULL,
  `PIB` decimal(10,2) NOT NULL,
  `TauxChomage` decimal(10,2) NOT NULL,
  `Drapeau` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `unioneuropeenne`
--

INSERT INTO `unioneuropeenne` (`ID`, `Pays`, `Capitale`, `Superficie`, `DateAdhesion`, `Population`, `Devise`, `PIB`, `TauxChomage`, `Drapeau`) VALUES
(1, 'Allemagne', 'Berlin', 357167, 1957, '83.02', 'Euro', '3344.00', '3.00', 'EU/DEU.png'),
(2, 'Autriche', 'Vienne', 83879, 1995, '8.86', 'Euro', '385.70', '4.50', 'EU/AUT.png'),
(3, 'Belgique', 'Bruxelles', 30528, 1957, '11.47', 'Euro', '459.80', '5.50', 'EU/BEL.png'),
(4, 'Bulgarie', 'Sofia', 110899, 2007, '7.00', 'Lev', '50.40', '4.50', 'EU/BGR.png'),
(5, 'Chypre', 'Nicosie', 9251, 2004, '0.88', 'Euro', '20.73', '3.90', 'EU/CYP.png'),
(6, 'Croatie', 'Zaghreb', 56594, 2013, '4.08', 'Kuna', '48.60', '7.30', 'EU/HRV.png'),
(7, 'Danemark', 'Copenhague', 42915, 1973, '5.81', 'Couronne danoise', '300.69', '2.20', 'EU/DNK.png'),
(8, 'Espagne', 'Madrid', 505991, 1986, '46.93', 'Euro', '1202.20', '13.90', 'EU/ESP.png'),
(9, 'Estonie', 'Talinn', 45227, 2004, '1.32', 'Euro', '23.00', '4.10', 'EU/EST.png'),
(10, 'Finlande', 'Helsinki', 338434, 1995, '5.52', 'Euro', '234.50', '6.70', 'EU/FIN.png'),
(11, 'France', 'Paris', 632734, 1957, '67.03', 'Euro', '2353.00', '8.40', 'EU/FRA.png'),
(12, 'Grece', 'Athenes', 131957, 1981, '10.72', 'Euro', '187.50', '18.50', 'EU/GRC.png'),
(13, 'Hongrie', 'Budapest', 93024, 2004, '9.77', 'Forint', '133.80', '3.40', 'EU/HUN.png'),
(14, 'Irlande', 'Dublin', 69797, 1973, '4.90', 'Euro', '347.20', '4.80', 'EU/IRL.png'),
(15, 'Italie', 'Rome', 302073, 1957, '60.36', 'Euro', '1672.40', '9.70', 'EU/ITA.png'),
(16, 'Lituanie', 'Riga', 64573, 2004, '1.92', 'Euro', '29.15', '6.40', 'EU/LTU.png'),
(17, 'Lettonie', 'Vilnius', 65300, 2004, '2.79', 'Euro', '41.80', '5.80', 'EU/LVA.png'),
(18, 'Luxembourg', 'Luxembourg', 2586, 1957, '0.61', 'Euro', '55.30', '5.50', 'EU/LUX.png'),
(19, 'Malte', 'La Valette', 316, 2004, '0.49', 'Euro', '12.40', '3.40', 'EU/MLT.png'),
(20, 'Pays-Bas', 'Amsterdam', 41540, 1957, '17.28', 'Euro', '702.60', '3.30', 'EU/NLD.png'),
(21, 'Pologne', 'Varsovie', 312679, 2004, '37.97', 'Zloty polonais', '496.50', '3.30', 'EU/POL.png'),
(22, 'Portugal', 'Lisbonne', 92212, 1986, '10.28', 'Euro', '201.61', '6.60', 'EU/PRT.png'),
(23, 'Republique tcheque', 'Prague', 78866, 2004, '10.65', 'Couronne tcheque', '207.77', '2.00', 'EU/CZE.png'),
(24, 'Roumanie', 'Bucarest', 238391, 2007, '19.40', 'Leu', '202.80', '3.90', 'EU/ROU.png'),
(25, 'Royaume-Uni', 'Londres', 242495, 1973, '66.44', 'Livre sterling', '2294.40', '3.80', 'EU/GBR.png'),
(26, 'Slovaquie', 'Bratislava', 49036, 2004, '5.45', 'Euro', '84.99', '5.70', 'EU/SVK.png'),
(27, 'Slovenie', 'Ljubljana', 20273, 2004, '2.08', 'Euro', '43.20', '4.40', 'EU/SVN.png'),
(28, 'Suede', 'Stockholm', 438576, 1995, '10.23', 'Couronne suedoise', '462.10', '6.20', 'EU/SWE.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
