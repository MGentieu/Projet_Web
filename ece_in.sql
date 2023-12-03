-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 03 déc. 2023 à 21:50
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

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
-- Structure de la table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `email_admin` varchar(50) NOT NULL,
  `mot_de_passe` varchar(30) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `num_telephone` decimal(10,0) NOT NULL,
  PRIMARY KEY (`email_admin`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`email_admin`, `mot_de_passe`, `nom`, `prenom`, `num_telephone`) VALUES
('mgentieu02@edu.ece.fr', 'volcan1', 'Gentieu', 'Martin', 695973078);

-- --------------------------------------------------------

--
-- Structure de la table `amitie`
--

DROP TABLE IF EXISTS `amitie`;
CREATE TABLE IF NOT EXISTS `amitie` (
  `email_ami_1` varchar(50) NOT NULL,
  `email_ami_2` varchar(50) NOT NULL,
  PRIMARY KEY (`email_ami_1`,`email_ami_2`),
  KEY `FK2` (`email_ami_2`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `amitie`
--

INSERT INTO `amitie` (`email_ami_1`, `email_ami_2`) VALUES
('ericdampierre@edu.ece.fr', 'hergentieu98@edu.ece.fr'),
('hergentieu98@edu.ece.fr', 'hgentieu97@edu.ece.fr'),
('hgentieu97@edu.ece.fr', 'ericdampierre@edu.ece.fr');

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

DROP TABLE IF EXISTS `auteur`;
CREATE TABLE IF NOT EXISTS `auteur` (
  `email_auteur` varchar(50) NOT NULL,
  `mot_de_passe` varchar(30) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `num_telephone` decimal(10,0) NOT NULL,
  `Description` varchar(300) DEFAULT NULL,
  `id_im_de_fond` decimal(6,0) DEFAULT NULL,
  PRIMARY KEY (`email_auteur`),
  KEY `FK1` (`id_im_de_fond`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `auteur`
--

INSERT INTO `auteur` (`email_auteur`, `mot_de_passe`, `nom`, `prenom`, `num_telephone`, `Description`, `id_im_de_fond`) VALUES
('hgentieu97@edu.ece.fr', 'volcan1', 'Gentieu', 'Hector', 620212425, 'J\'aime les pommes', 145201),
('hergentieu98@edu.ece.fr', 'siecle2', 'Gentieu', 'Hervé', 624212066, 'J\'aime les poires', 145201),
('ericdampierre@edu.ece.fr', 'Mec_generique', 'Dampierre', 'Eric', 607080910, 'qui me demande?', 145201);

-- --------------------------------------------------------

--
-- Structure de la table `candidature`
--

DROP TABLE IF EXISTS `candidature`;
CREATE TABLE IF NOT EXISTS `candidature` (
  `reference_offre` varchar(25) NOT NULL,
  `email_auteur` varchar(50) NOT NULL,
  `date_candidature` date NOT NULL,
  PRIMARY KEY (`reference_offre`,`email_auteur`),
  KEY `FK2` (`email_auteur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `candidature`
--

INSERT INTO `candidature` (`reference_offre`, `email_auteur`, `date_candidature`) VALUES
('STG235-ECE', 'hgentieu97@edu.ece.fr', '2023-12-05');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire_evenement`
--

DROP TABLE IF EXISTS `commentaire_evenement`;
CREATE TABLE IF NOT EXISTS `commentaire_evenement` (
  `id_evenement` decimal(6,0) NOT NULL,
  `email_auteur` varchar(50) NOT NULL,
  `date_commentaire` date NOT NULL,
  `heure_commentaire` time NOT NULL,
  `texte_commentaire` varchar(150) NOT NULL,
  PRIMARY KEY (`id_evenement`,`email_auteur`),
  KEY `FK2` (`email_auteur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commentaire_evenement`
--

INSERT INTO `commentaire_evenement` (`id_evenement`, `email_auteur`, `date_commentaire`, `heure_commentaire`, `texte_commentaire`) VALUES
(1, 'hergentieu98@edu.ece.fr', '2023-11-09', '19:16:32', 'J\'ai hâte d\'y participer');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire_photo`
--

DROP TABLE IF EXISTS `commentaire_photo`;
CREATE TABLE IF NOT EXISTS `commentaire_photo` (
  `id_photo` decimal(6,0) NOT NULL,
  `email_auteur` varchar(50) NOT NULL,
  `date_commentaire` date NOT NULL,
  `heure_commentaire` time NOT NULL,
  `texte_commentaire` varchar(150) NOT NULL,
  PRIMARY KEY (`id_photo`,`email_auteur`),
  KEY `FK2` (`email_auteur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commentaire_photo`
--

INSERT INTO `commentaire_photo` (`id_photo`, `email_auteur`, `date_commentaire`, `heure_commentaire`, `texte_commentaire`) VALUES
(1, 'hergentieu98@edu.ece.fr', '2024-01-01', '19:16:32', 'Belle photo en effet');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire_video`
--

DROP TABLE IF EXISTS `commentaire_video`;
CREATE TABLE IF NOT EXISTS `commentaire_video` (
  `id_video` decimal(6,0) NOT NULL,
  `email_auteur` varchar(50) NOT NULL,
  `date_commentaire` date NOT NULL,
  `heure_commentaire` time NOT NULL,
  `texte_commentaire` varchar(150) NOT NULL,
  PRIMARY KEY (`id_video`,`email_auteur`),
  KEY `FK2` (`email_auteur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commentaire_video`
--

INSERT INTO `commentaire_video` (`id_video`, `email_auteur`, `date_commentaire`, `heure_commentaire`, `texte_commentaire`) VALUES
(1, 'hergentieu98@edu.ece.fr', '2024-01-01', '19:16:32', 'Belle vidéo en effet');

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

DROP TABLE IF EXISTS `conversation`;
CREATE TABLE IF NOT EXISTS `conversation` (
  `id_conv` decimal(6,0) NOT NULL,
  `date_creation` date NOT NULL,
  `nom_conv` varchar(40) NOT NULL,
  PRIMARY KEY (`id_conv`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `conversation`
--

INSERT INTO `conversation` (`id_conv`, `date_creation`, `nom_conv`) VALUES
(1, '2023-11-08', 'Les Gentioux');

-- --------------------------------------------------------

--
-- Structure de la table `correspondance_pseudo_email`
--

DROP TABLE IF EXISTS `correspondance_pseudo_email`;
CREATE TABLE IF NOT EXISTS `correspondance_pseudo_email` (
  `pseudo` varchar(30) NOT NULL,
  `email_auteur` varchar(50) NOT NULL,
  PRIMARY KEY (`pseudo`),
  KEY `FK1` (`email_auteur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `correspondance_pseudo_email`
--

INSERT INTO `correspondance_pseudo_email` (`pseudo`, `email_auteur`) VALUES
('HGentieu', 'hgentieu97@edu.ece.fr'),
('HerGentieu', 'hergentieu98@edu.ece.fr'),
('ED', 'ericdampierre@edu.ece.fr');

-- --------------------------------------------------------

--
-- Structure de la table `demande_ami`
--

DROP TABLE IF EXISTS `demande_ami`;
CREATE TABLE IF NOT EXISTS `demande_ami` (
  `email_ami_1` varchar(50) NOT NULL,
  `email_ami_2` varchar(50) NOT NULL,
  PRIMARY KEY (`email_ami_1`,`email_ami_2`),
  KEY `FK2` (`email_ami_2`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `entite`
--

DROP TABLE IF EXISTS `entite`;
CREATE TABLE IF NOT EXISTS `entite` (
  `siret` decimal(14,0) NOT NULL,
  `nom_entite` varchar(40) NOT NULL,
  `type_entite` varchar(40) NOT NULL,
  `lieu_siege` varchar(40) NOT NULL,
  PRIMARY KEY (`siret`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `entite`
--

INSERT INTO `entite` (`siret`, `nom_entite`, `type_entite`, `lieu_siege`) VALUES
(11122233300015, 'ECE', 'Ecole d\'ingénieur', 'Paris');

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `id_evenement` decimal(6,0) NOT NULL,
  `email_auteur` varchar(50) NOT NULL,
  `alt` varchar(50) DEFAULT NULL,
  `url` varchar(100) NOT NULL,
  `date_debut` date NOT NULL,
  `heure_debut` time NOT NULL,
  `date_fin` date NOT NULL,
  `heure_fin` time NOT NULL,
  `date_post` date NOT NULL,
  `heure_post` time NOT NULL,
  `texte_post` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_evenement`),
  KEY `FK1` (`email_auteur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`id_evenement`, `email_auteur`, `alt`, `url`, `date_debut`, `heure_debut`, `date_fin`, `heure_fin`, `date_post`, `heure_post`, `texte_post`) VALUES
(1, 'hgentieu97@edu.ece.fr', 'photo_sympa', 'Evenement.jpg', '2023-11-15', '16:25:59', '2023-11-16', '19:25:59', '2023-11-13', '11:30:05', 'Venez assister à la conférence sur les chaussettes trouées.');

-- --------------------------------------------------------

--
-- Structure de la table `image_de_fond`
--

DROP TABLE IF EXISTS `image_de_fond`;
CREATE TABLE IF NOT EXISTS `image_de_fond` (
  `id_im_de_fond` decimal(6,0) NOT NULL,
  `alt` varchar(40) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_im_de_fond`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `image_de_fond`
--

INSERT INTO `image_de_fond` (`id_im_de_fond`, `alt`, `url`) VALUES
(145201, 'Image de Paris', 'Paris.png');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id_conv` decimal(6,0) NOT NULL,
  `email_auteur` varchar(50) NOT NULL,
  `numero` decimal(6,0) NOT NULL,
  `date_envoi` date NOT NULL,
  `heure_envoi` time NOT NULL,
  `Contenu` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_conv`,`email_auteur`,`numero`),
  KEY `FK2` (`email_auteur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_conv`, `email_auteur`, `numero`, `date_envoi`, `heure_envoi`, `Contenu`) VALUES
(1, 'hergentieu98@edu.ece.fr', 1, '2023-11-10', '21:34:58', 'Salut Hector !');

-- --------------------------------------------------------

--
-- Structure de la table `offre_emploi`
--

DROP TABLE IF EXISTS `offre_emploi`;
CREATE TABLE IF NOT EXISTS `offre_emploi` (
  `reference_offre` varchar(25) NOT NULL,
  `nom_offre` varchar(60) NOT NULL,
  `duree` varchar(30) NOT NULL,
  `date_debut` date NOT NULL,
  `remuneration` decimal(10,0) NOT NULL,
  `Description` varchar(200) NOT NULL,
  `siret` decimal(14,0) NOT NULL,
  PRIMARY KEY (`reference_offre`),
  KEY `FK1` (`siret`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `offre_emploi`
--

INSERT INTO `offre_emploi` (`reference_offre`, `nom_offre`, `duree`, `date_debut`, `remuneration`, `Description`, `siret`) VALUES
('STG235-ECE', 'Poste de balayeur', '6 mois', '2023-12-01', 1500, 'Poste de Balayeur sur le campus Eiffel 1', 11122233300015);

-- --------------------------------------------------------

--
-- Structure de la table `partage_evenement`
--

DROP TABLE IF EXISTS `partage_evenement`;
CREATE TABLE IF NOT EXISTS `partage_evenement` (
  `id_evenement` decimal(6,0) NOT NULL,
  `email_auteur` varchar(50) NOT NULL,
  `date_partage` date NOT NULL,
  `heure_partage` time NOT NULL,
  `texte_partage` varchar(150) NOT NULL,
  PRIMARY KEY (`id_evenement`,`email_auteur`),
  KEY `FK2` (`email_auteur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `partage_evenement`
--

INSERT INTO `partage_evenement` (`id_evenement`, `email_auteur`, `date_partage`, `heure_partage`, `texte_partage`) VALUES
(1, 'hergentieu98@edu.ece.fr', '2023-12-22', '19:15:29', 'Je partage le post pour cet événement car j\'invite ceux que ça intéresse à y participer aussi.');

-- --------------------------------------------------------

--
-- Structure de la table `partage_photo`
--

DROP TABLE IF EXISTS `partage_photo`;
CREATE TABLE IF NOT EXISTS `partage_photo` (
  `id_photo` decimal(6,0) NOT NULL,
  `email_auteur` varchar(50) NOT NULL,
  `date_partage` date NOT NULL,
  `heure_partage` time NOT NULL,
  `texte_partage` varchar(150) NOT NULL,
  PRIMARY KEY (`id_photo`,`email_auteur`),
  KEY `FK2` (`email_auteur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `partage_photo`
--

INSERT INTO `partage_photo` (`id_photo`, `email_auteur`, `date_partage`, `heure_partage`, `texte_partage`) VALUES
(1, 'hergentieu98@edu.ece.fr', '2023-12-22', '19:15:29', 'Je partager cette photo d\'Hector car elle est superbe.');

-- --------------------------------------------------------

--
-- Structure de la table `partage_video`
--

DROP TABLE IF EXISTS `partage_video`;
CREATE TABLE IF NOT EXISTS `partage_video` (
  `id_video` decimal(6,0) NOT NULL,
  `email_auteur` varchar(50) NOT NULL,
  `date_partage` date NOT NULL,
  `heure_partage` time NOT NULL,
  `texte_partage` varchar(150) NOT NULL,
  PRIMARY KEY (`id_video`,`email_auteur`),
  KEY `FK2` (`email_auteur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `partage_video`
--

INSERT INTO `partage_video` (`id_video`, `email_auteur`, `date_partage`, `heure_partage`, `texte_partage`) VALUES
(1, 'hergentieu98@edu.ece.fr', '2023-12-22', '19:15:29', 'Je partage cette vidéo d\'Hector car elle est amusante.');

-- --------------------------------------------------------

--
-- Structure de la table `participation`
--

DROP TABLE IF EXISTS `participation`;
CREATE TABLE IF NOT EXISTS `participation` (
  `id_conv` decimal(6,0) NOT NULL,
  `email_auteur` varchar(50) NOT NULL,
  PRIMARY KEY (`id_conv`,`email_auteur`),
  KEY `FK2` (`email_auteur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `participation`
--

INSERT INTO `participation` (`id_conv`, `email_auteur`) VALUES
(1, 'hergentieu98@edu.ece.fr'),
(1, 'hgentieu97@edu.ece.fr');

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `id_photo` decimal(6,0) NOT NULL,
  `email_auteur` varchar(50) NOT NULL,
  `alt` varchar(50) DEFAULT NULL,
  `url` varchar(100) NOT NULL,
  `date_prise` date NOT NULL,
  `heure_prise` time NOT NULL,
  `date_post` date NOT NULL,
  `heure_post` time NOT NULL,
  `texte_post` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_photo`),
  KEY `FK1` (`email_auteur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`id_photo`, `email_auteur`, `alt`, `url`, `date_prise`, `heure_prise`, `date_post`, `heure_post`, `texte_post`) VALUES
(1, 'hgentieu97@edu.ece.fr', 'photo_sympa', 'machin.png', '2023-11-15', '16:25:59', '2023-11-16', '19:25:59', 'Superbe photo d\'un machin.');

-- --------------------------------------------------------

--
-- Structure de la table `reaction_evenement`
--

DROP TABLE IF EXISTS `reaction_evenement`;
CREATE TABLE IF NOT EXISTS `reaction_evenement` (
  `id_evenement` decimal(6,0) NOT NULL,
  `email_auteur` varchar(50) NOT NULL,
  `date_reaction` date NOT NULL,
  `reac_positive` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_evenement`,`email_auteur`),
  KEY `FK2` (`email_auteur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `reaction_evenement`
--

INSERT INTO `reaction_evenement` (`id_evenement`, `email_auteur`, `date_reaction`, `reac_positive`) VALUES
(1, 'hergentieu98@edu.ece.fr', '2024-01-01', 1);

-- --------------------------------------------------------

--
-- Structure de la table `reaction_photo`
--

DROP TABLE IF EXISTS `reaction_photo`;
CREATE TABLE IF NOT EXISTS `reaction_photo` (
  `id_photo` decimal(6,0) NOT NULL,
  `email_auteur` varchar(50) NOT NULL,
  `date_reaction` date NOT NULL,
  `reac_positive` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_photo`,`email_auteur`),
  KEY `FK2` (`email_auteur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `reaction_photo`
--

INSERT INTO `reaction_photo` (`id_photo`, `email_auteur`, `date_reaction`, `reac_positive`) VALUES
(1, 'hergentieu98@edu.ece.fr', '2024-01-01', 1);

-- --------------------------------------------------------

--
-- Structure de la table `reaction_video`
--

DROP TABLE IF EXISTS `reaction_video`;
CREATE TABLE IF NOT EXISTS `reaction_video` (
  `id_video` decimal(6,0) NOT NULL,
  `email_auteur` varchar(50) NOT NULL,
  `date_reaction` date NOT NULL,
  `reac_positive` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_video`,`email_auteur`),
  KEY `FK2` (`email_auteur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `reaction_video`
--

INSERT INTO `reaction_video` (`id_video`, `email_auteur`, `date_reaction`, `reac_positive`) VALUES
(1, 'hergentieu98@edu.ece.fr', '2024-01-01', 1);


-- --------------------------------------------------------

--
-- Structure de la table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `id_video` decimal(6,0) NOT NULL,
  `email_auteur` varchar(50) NOT NULL,
  `alt` varchar(50) DEFAULT NULL,
  `url` varchar(100) NOT NULL,
  `date_prise` date NOT NULL,
  `heure_prise` time NOT NULL,
  `date_post` date NOT NULL,
  `heure_post` time NOT NULL,
  `texte_post` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_video`),
  KEY `FK1` (`email_auteur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `video`
--

INSERT INTO `video` (`id_video`, `email_auteur`, `alt`, `url`, `date_prise`, `heure_prise`, `date_post`, `heure_post`, `texte_post`) VALUES
(1, 'hgentieu97@edu.ece.fr', 'photo_sympa', 'machin.mov', '2023-11-15', '16:25:59', '2023-11-16', '19:25:59', 'Superbe video');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
