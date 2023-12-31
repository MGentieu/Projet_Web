-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 17 déc. 2023 à 16:00
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13



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
) ;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`email_admin`, `mot_de_passe`, `nom`, `prenom`, `num_telephone`) VALUES
('mgentieu02@edu.ece.fr', 'volcan1', 'Gentieu', 'Martin', 695973078),
('danae.collard@edu.ece.fr', 'Danae08', 'Collard', 'Danaé', 671410348),
('theo.mettez@edu.ece.fr', 'Theo01', 'Mettez', 'Théo', 648527954),
('hergentieu98@edu.ece.fr', 'siece2', 'Gentily', 'Hervé', 648527954),
('maxime.schneider@ece.prof.fr', 'electros', 'Schneider', 'Maxime', 705542413);

-- --------------------------------------------------------

--
-- Structure de la table `amitie`
--

DROP TABLE IF EXISTS `amitie`;
CREATE TABLE IF NOT EXISTS `amitie` (
  `email_ami_1` varchar(50) NOT NULL,
  `email_ami_2` varchar(50) NOT NULL,
  KEY `FK2` (`email_ami_2`)
) ;

--
-- Déchargement des données de la table `amitie`
--

INSERT INTO `amitie` (`email_ami_1`, `email_ami_2`) VALUES
('danae.collard@edu.ece.fr', 'hergentieu98@edu.ece.fr'),
('hergentieu98@edu.ece.fr', 'theo.mettez@edu.ece.fr'),
('mgentieu02@edu.ece.fr', 'hergentieu98@edu.ece.fr'),
('theo.mettez@edu.ece.fr', 'mgentieu02@edu.ece.fr'),
('danae.collard@edu.ece.fr', 'mgentieu02@edu.ece.fr'),
('theo.mettez@edu.ece.fr', 'danae.collard@edu.ece.fr');

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
  `est_dans_le_reseau` tinyint(1) NOT NULL,
  `domaine` varchar(80) NOT NULL,
  PRIMARY KEY (`email_auteur`),
  KEY `FK1` (`id_im_de_fond`)
) ;

--
-- Déchargement des données de la table `auteur`
--

INSERT INTO `auteur` (`email_auteur`, `mot_de_passe`, `nom`, `prenom`, `num_telephone`, `Description`, `id_im_de_fond`, `est_dans_le_reseau`, `domaine`) VALUES
('mgentieu02@edu.ece.fr', 'volcan1', 'Gentieu', 'Martin', 695973078, 'Moi je suis Ingenieur Numérique', 145201, 1, 'info'),
('hergentieu98@edu.ece.fr', 'siece2', 'Gentily', 'Hervé', 648527954, 'Moi je suis Ingenieur Aeronautique', 145202, 0, 'aero'),
('theo.mettez@edu.ece.fr', 'Theo01', 'Mettez', 'Théo', 648527954, 'Moi je suis Ingenieur dans la Finance', 145203, 1, 'finance'),
('danae.collard@edu.ece.fr', 'Danae08', 'Collard', 'Danaé', 671410348, 'Moi je suis Pilote de ligne', 145204, 1, 'pilotage'),
('hector.gentieu@edu.ece.fr', 'nullos', 'Gentieu', 'Hector', 652347841, 'Je suis un gros escroc!', 145205, 0, 'pilotage'),
('valere.delin@edu.ece.fr', 'WeshWesh', 'Delin', 'Valere', 105058464, 'Je prévois de travailler dans l\'ecologie.', 145206, 1, 'finance'),
('franklin.pinto@edu.ece.fr', 'shrek', 'Pinto', 'Franklin', 798683215, 'Je souhaite travailler dans le  big data.', 145207, 1, 'info'),
('arthur.gervais@edu.ece.fr', 'gaming', 'Gervais', 'Arthur', 652858874, 'Je travaille dans la cybersécurité.', 145208, 0, 'info');

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
) ;

--
-- Déchargement des données de la table `candidature`
--

INSERT INTO `candidature` (`reference_offre`, `email_auteur`, `date_candidature`) VALUES
('STG235-ECE', 'mgentieu02@edu.ece.fr', '2023-12-05'),
('STG245-AIRBUS', 'hergentieu98@edu.ece.fr', '2023-10-07'),
('STG255-BNP', 'theo.mettez@edu.ece.fr', '0000-00-00'),
('STG265-AIRFRANCE', 'danae.collard@edu.ece.fr', '2023-11-10');

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
) ;

--
-- Déchargement des données de la table `commentaire_evenement`
--

INSERT INTO `commentaire_evenement` (`id_evenement`, `email_auteur`, `date_commentaire`, `heure_commentaire`, `texte_commentaire`) VALUES
(1, 'mgentieu02@edu.ece.fr', '2023-11-09', '07:24:16', 'J\'ai hâte d\'y participer'),
(1, 'hergentieu98@edu.ece.fr', '2023-10-09', '13:26:33', 'Ça a l\'air trop bien!'),
(2, 'theo.mettez@edu.ece.fr', '2023-09-09', '19:16:32', 'Fantastique'),
(2, 'danae.collard@edu.ece.fr', '2023-08-09', '17:13:52', 'Quelle organisation!'),
(3, 'hergentieu98@edu.ece.fr', '2023-10-09', '13:26:33', 'Ça a l\'air trop bien!'),
(3, 'theo.mettez@edu.ece.fr', '2023-09-09', '19:16:32', 'Fantastique'),
(4, 'mgentieu02@edu.ece.fr', '2023-11-09', '07:24:16', 'J\'ai hâte d\'y participer'),
(4, 'danae.collard@edu.ece.fr', '2023-08-09', '17:13:52', 'Quelle organisation!');

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
) ;

--
-- Déchargement des données de la table `commentaire_photo`
--

INSERT INTO `commentaire_photo` (`id_photo`, `email_auteur`, `date_commentaire`, `heure_commentaire`, `texte_commentaire`) VALUES
(1, 'mgentieu02@edu.ece.fr', '2023-11-09', '09:24:16', 'Belle photo en effet.'),
(1, 'hergentieu98@edu.ece.fr', '2023-10-09', '14:45:31', 'Magnifique!'),
(1, 'theo.mettez@edu.ece.fr', '2023-09-09', '20:16:32', 'Qu\'est-ce que tu ressembles à ton père!'),
(1, 'danae.collard@edu.ece.fr', '2023-08-09', '18:33:52', 'Le paysage est superbe.');

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
) ;

--
-- Déchargement des données de la table `commentaire_video`
--

INSERT INTO `commentaire_video` (`id_video`, `email_auteur`, `date_commentaire`, `heure_commentaire`, `texte_commentaire`) VALUES
(1, 'mgentieu02@edu.ece.fr', '2023-11-09', '09:24:16', 'Belle vidéo en effet.'),
(1, 'hergentieu98@edu.ece.fr', '2024-01-01', '19:16:32', 'Impressionnant!'),
(1, 'theo.mettez@edu.ece.fr', '2023-09-09', '20:16:32', 'Sur cette vidéo la ressemblance est frappante!'),
(1, 'danae.collard@edu.ece.fr', '2023-08-09', '18:33:52', 'Le paysage est superbe.');

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

DROP TABLE IF EXISTS `conversation`;
CREATE TABLE IF NOT EXISTS `conversation` (
  `id_conv` int NOT NULL AUTO_INCREMENT,
  `date_creation` date NOT NULL,
  `nom_conv` varchar(40) NOT NULL,
  PRIMARY KEY (`id_conv`)
) ;

--
-- Déchargement des données de la table `conversation`
--

INSERT INTO `conversation` (`id_conv`, `date_creation`, `nom_conv`) VALUES
(1, '2023-11-08', 'Les Gentioux'),
(2, '2012-08-06', 'promo2026'),
(3, '2017-03-11', 'TDS02');

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
) ;

--
-- Déchargement des données de la table `correspondance_pseudo_email`
--

INSERT INTO `correspondance_pseudo_email` (`pseudo`, `email_auteur`) VALUES
('MGentieu', 'mgentieu02@edu.ece.fr'),
('HerGentily', 'hergentieu98@edu.ece.fr'),
('Théooo', 'theo.mettez@edu.ece.fr'),
('Danao', 'danae.collard@edu.ece.fr'),
('HGentieu', 'hector.gentieu@edu.ece.fr'),
('Valeres actuelles', 'valere.delin@edu.ece.fr'),
('Shrek lover', 'franklin.pinto@edu.ece.fr'),
('AGervais', 'arthur.gervais@edu.ece.fr');

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
) ;

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
) ;

--
-- Déchargement des données de la table `entite`
--

INSERT INTO `entite` (`siret`, `nom_entite`, `type_entite`, `lieu_siege`) VALUES
(11122233300015, 'ECE', 'Ecole d\'ingénieur', 'Paris'),
(11122233300016, 'AIRBUS', 'Base de Airbus', 'Toulouse'),
(11122233300017, 'BNP', 'Banque', 'Paris'),
(11122233300018, 'AIRFRANCE', 'Aéroport', 'Roissy');

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
) ;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`id_evenement`, `email_auteur`, `alt`, `url`, `date_debut`, `heure_debut`, `date_fin`, `heure_fin`, `date_post`, `heure_post`, `texte_post`) VALUES
(1, 'mgentieu02@edu.ece.fr', 'salon_entreprise', 'salon.jpg', '2023-05-15', '16:29:59', '2023-05-17', '18:29:59', '2023-04-20', '11:30:05', 'Venez assister au salon des entreprises.'),
(2, 'hergentieu98@edu.ece.fr', 'remise_diplome', 'diplome.jpg', '2023-07-11', '18:29:59', '2023-07-11', '22:29:59', '2023-06-20', '11:30:05', 'Venez assister à la remise des diplomes.'),
(3, 'theo.mettez@edu.ece.fr', 'information_rentrée', 'rentree.jpg', '2023-09-01', '13:59:59', '2023-09-01', '15:59:59', '2023-08-20', '11:30:05', 'Venez assister à l\'amphithéatre d\'information de rentrée.'),
(4, 'danae.collard@edu.ece.fr', 'noël', 'noel.jpg', '2023-12-22', '18:29:59', '2023-12-22', '22:29:59', '2023-12-05', '11:30:05', 'Venez assister au repas de Noël de l\'école.');

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;

CREATE TABLE `formation` (
  `Ecole` varchar(255) NOT NULL,
  `DateDebut` date NOT NULL, -- Correction ici
  `DateFin` date NOT NULL,
  `mailusers` varchar(255) NOT NULL
);

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`Ecole`, `DateDebut`, `DateFin`, `mailusers`) VALUES
('CIV', '2023-12-22', '2023-12-22', 'theo.mettez@edu.ece.fr'),
('ECE', '2024-03-08', '2023-12-21', 'theo.mettez@edu.ece.fr'),
('ECE', '2024-03-08', '2023-12-21', 'theo.mettez@edu.ece.fr'),
('ECE', '2024-03-08', '2023-12-21', 'theo.mettez@edu.ece.fr'),
('ECE', '2024-03-08', '2023-12-21', 'theo.mettez@edu.ece.fr'),
('ECE', '2024-03-08', '2023-12-21', 'theo.mettez@edu.ece.fr'),
('ECE', '2024-03-08', '2023-12-21', 'theo.mettez@edu.ece.fr'),
('ECE', '2024-03-08', '2023-12-21', 'theo.mettez@edu.ece.fr'),
('ECE', '2024-03-08', '2023-12-21', 'theo.mettez@edu.ece.fr'),
('ECE', '2024-03-08', '2023-12-21', 'theo.mettez@edu.ece.fr'),
(' dx', '2023-12-22', '2023-12-07', 'theo.mettez@edu.ece.fr'),
('decedc', '2023-12-22', '2023-12-14', 'theo.mettez@edu.ece.fr');

COMMIT;

--
-- Structure de la table `image_de_fond`
--

DROP TABLE IF EXISTS `image_de_fond`;
CREATE TABLE IF NOT EXISTS `image_de_fond` (
  `id_im_de_fond` decimal(6,0) NOT NULL,
  `alt` varchar(40) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_im_de_fond`)
) ;

--
-- Déchargement des données de la table `image_de_fond`
--

INSERT INTO `image_de_fond` (`id_im_de_fond`, `alt`, `url`) VALUES
(145201, 'Image d\'informatique', 'images/numerique.png'),
(145202, 'Image d\'aéronautique', 'images/aeronautique.png'),
(145203, 'Image d\'argent', 'images/finance.png'),
(145204, 'Image de AirFrance', 'images/airfrance.png'),
(145205, 'Image d\'escroc', 'images/escroc.png'),
(145206, 'Image d\'ecologie', 'images/ecologie.png'),
(145207, 'Image de big data', 'images/bigdata.png'),
(145208, 'Image de Cybersecurite', 'images/cybersecurite.png');

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
) ;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_conv`, `email_auteur`, `numero`, `date_envoi`, `heure_envoi`, `Contenu`) VALUES
(1, 'mgentieu02@edu.ece.fr', 1, '2023-11-10', '21:34:58', 'Salut Hector, tu vas bien?'),
(1, 'hergentieu98@edu.ece.fr', 2, '2023-11-10', '21:40:58', 'Salut Martin, je vais super et toi? !'),
(2, 'theo.mettez@edu.ece.fr', 1, '2023-11-10', '20:22:58', 'Bonjour à tous, vous savez si on a des devoirs pour demain?'),
(2, 'danae.collard@edu.ece.fr', 2, '2023-11-10', '20:45:58', 'Salut Theo, non je ne crois.'),
(3, 'hergentieu98@edu.ece.fr', 1, '2023-11-10', '23:12:58', 'Hello, qui va au repas de Noël prevu le 22 décembre?'),
(3, 'theo.mettez@edu.ece.fr', 2, '2023-11-10', '23:19:58', 'Salut, je pense y aller avec un ami.'),
(3, 'danae.collard@edu.ece.fr', 2, '2023-11-10', '23:19:58', 'Moi, je ne peux pas y aller, je vais en Normandie...');

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
  `type` varchar(80) NOT NULL,
  `domaine` varchar(80) NOT NULL,
  `url` varchar(100) NOT NULL,
  PRIMARY KEY (`reference_offre`),
  KEY `FK1` (`siret`)
) ;

--
-- Déchargement des données de la table `offre_emploi`
--

INSERT INTO `offre_emploi` (`reference_offre`, `nom_offre`, `duree`, `date_debut`, `remuneration`, `Description`, `siret`, `type`, `domaine`, `url`) VALUES
('STG235-ECE', 'Developpeur informatique', '4 mois', '2024-04-01', 2000, 'Poste de developpeur informatique sur le campus Eiffel 1', 11122233300015, 'stage', 'info', 'images/ecebaniere.jpg'),
('STG245-AIRBUS', 'Ingenieur en maintenance aeronautique', '3 mois', '2024-01-01', 1500, 'Poste d\'ingenieur en maintenance aeronautique à Toulouse.', 11122233300016, 'stage', 'aero', 'images/airbus.png'),
('STG255-BNP', 'Conseiller bancaire', '2 mois', '2024-02-01', 1600, 'Poste de Conseiller bancaire à la BNP de Bir Hakeim', 11122233300017, 'stage', 'finance', 'images/bnp.png'),
('STG265-AIRFRANCE', 'Personnel Complémentaire de bord', '3 mois', '2024-07-01', 1700, 'Poste de Personnel Complémentaire de bord basé à l\'aeroport de Roissy CDG', 11122233300018, 'stage', 'pilotage', 'images/af.png'),
('APPR245-SID', 'Apprenti au sein du SID', '2 ans', '2024-09-05', 1500, 'Poste d\'apprenti au sein de la cellule cybersécurité du Service d\'Infrastructure de la Défense.', 11009001600053, 'apprentissage', 'info', 'images/sid.png'),
('CDD784-DGA', 'Développeur fullstack', '3 mois', '2024-02-01', 1900, 'Poste de développeur dont la mission sera de développer un site intranet afin de supporter le personnel du camp de Saclay.', 11009001600053, 'cdd', 'info', 'images/dga.png'),
('CDI456-CDISCOUNT', 'Développeur Backend', 'indéterminée', '2024-03-01', 2700, 'Poste chez Cdiscount à Bordeaux. Gestion des serveurs et de la maintenance du site.', 42405982200333, 'cdi', 'info', 'images/cdiscount.png'),
('APPR621-THALES', 'Apprenti ingénieur aéronautique', '2 ans', '2024-09-02', 1300, 'Poste d\'apprenti ingénieur dans la section spécialisée en aéronautique et mécanique de Thalès.', 55205902401909, 'apprentissage', 'aero', 'images/thales.png'),
('APPR451-SG', 'Apprenti conseiller bancaire', '2 ans', '2025-09-01', 1550, 'Poste d\'apprenti conseiller bancaire au sein de la Société Générale ayant pour but d\'évaluer la rentabilité de certains marchés.', 55212022200013, 'apprentissage', 'finance', 'images/sg.png'),
('APPR666-AIRF', 'Apprenti pilote', '2 ans', '2024-02-01', 1500, 'Poste d\'apprenti pilote au sein de Air France', 55204300275008, 'apprentissage', 'pilotage', 'images/af.png'),
('CDD231-AIRBUS', 'Poste d\'expert robotique', '2 à 3 ans', '2024-09-03', 4000, 'Poste d\'ingénieur spécialisé en systèmes embarqués ayant pour but de designer des circuits PCB pour les avions A-350.', 38347481400100, 'cdd', 'aero', 'images/airbus.png'),
('CDD589-PG', 'Expert comptable', '6 mois', '2024-01-01', 2200, 'Poste de comptable chez Procter & Gamble. Potentielle débouchée vers un CDI.', 39154357600097, 'cdd', 'finance', 'images/pg.png'),
('CDD912-EMIR', 'Copilote', '4 mois', '2024-04-06', 3000, 'Poste de copilote au sein de la compagnie EMIRATES', 55212045200013, 'cdd', 'pilotage', 'images/emir.png'),
('CDI888-BP', 'Banquier', 'indéterminée', '2024-02-01', 4500, 'Poste de Banquier chez la banque postale. Minimum 5 ans d\'expérience dans le secteur requis.', 42110064575006, 'cdi', 'finance', 'images/bp.png'),
('CDI167-SAFR', 'Ingénieur mécanique des fluides', 'indéterminée', '2025-01-02', 5000, 'Ingénieur en mécanique des fluides chargé de de designer des nouveaux modèles d\'avions', 56208290975015, 'cdi', 'aero', 'images/safran.png'),
('CDI375-BOEING', 'Pilote de ligne', 'indéterminée', '2024-06-01', 4500, 'Poste de pilote de ligne chez Boeing', 47867926900017, 'cdi', 'pilotage', 'images/boeing.png');

-- --------------------------------------------------------

DROP TABLE IF EXISTS `photo_profile`;
CREATE TABLE `photo_profile` (
  `photo` varchar(255) NOT NULL,
  `email_users` varchar(255) NOT NULL
) ;
COMMIT;
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
) ;

--
-- Déchargement des données de la table `partage_evenement`
--

INSERT INTO `partage_evenement` (`id_evenement`, `email_auteur`, `date_partage`, `heure_partage`, `texte_partage`) VALUES
(1, 'theo.mettez@edu.ece.fr', '2023-04-25', '19:15:29', 'Je partage le post pour cet événement car j\'invite ceux que ça intéresse à y participer aussi.'),
(2, 'mgentieu02@edu.ece.fr', '2023-06-24', '19:15:29', 'Venez feliciter les diplomés avec nous et leur dire au revoir!'),
(3, 'danae.collard@edu.ece.fr', '2023-08-27', '19:15:29', 'Toutes les informations dont vous avez besoin seront abordées lors de cet evênement.'),
(4, 'hergentieu98@edu.ece.fr', '2023-12-09', '19:15:29', 'Rejoignez-nous au repas de Noel!'),
(4, 'theo.mettez@edu.ece.fr', '2023-12-10', '19:15:29', 'Encore une belle occasion de faire la fête!');

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
) ;

--
-- Déchargement des données de la table `partage_photo`
--

INSERT INTO `partage_photo` (`id_photo`, `email_auteur`, `date_partage`, `heure_partage`, `texte_partage`) VALUES
(1, 'danae.collard@edu.ece.fr', '2023-12-22', '19:15:29', 'Je partage cette photo de Martin car elle est superbe.'),
(1, 'hergentieu98@edu.ece.fr', '2023-12-22', '19:15:29', 'Je partage cette photo de Martin car elle est superbe.'),
(2, 'danae.collard@edu.ece.fr', '2023-12-22', '19:15:29', 'Je partage cette photo d\'Hector car elle est superbe.'),
(2, 'theo.collard@edu.ece.fr', '2023-12-22', '19:15:29', 'Je partage cette photo d\'Hector car elle est superbe.'),
(3, 'hergentieu98@edu.ece.fr', '2023-12-22', '19:15:29', 'Je partage cette photo de Théo car elle est superbe.'),
(4, 'mgentieu02@edu.ece.fr', '2023-12-22', '19:15:29', 'Je partage cette photo de Danaé car elle est superbe.'),
(4, 'theo.mettez@edu.ece.fr', '2023-12-22', '19:15:29', 'Je partage cette photo dde Danaé car elle est superbe.');

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
) ;

--
-- Déchargement des données de la table `partage_video`
--

INSERT INTO `partage_video` (`id_video`, `email_auteur`, `date_partage`, `heure_partage`, `texte_partage`) VALUES
(1, 'hergentieu98@edu.ece.fr', '2023-10-05', '19:15:29', 'Je partage cette vidéo de Martin car c\'est impressionnant.'),
(2, 'danae.collard@edu.ece.fr', '2023-11-21', '19:15:29', 'Je partage cette vidéo de Théo car le monde est fou.');

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
) ;

--
-- Déchargement des données de la table `participation`
--

INSERT INTO `participation` (`id_conv`, `email_auteur`) VALUES
(1, 'hergentieu98@edu.ece.fr'),
(1, 'mgentieu02@edu.ece.fr'),
(2, 'danae.collard@edu.ece.fr'),
(2, 'hergentieu98@edu.ece.fr'),
(2, 'mgentieu02@edu.ece.fr'),
(2, 'theo.mettez@edu.ece.fr'),
(3, 'danae.collard@edu.ece.fr'),
(3, 'mgentieu02@edu.ece.fr'),
(3, 'theo.mettez@edu.ece.fr');

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
) ;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`id_photo`, `email_auteur`, `alt`, `url`, `date_prise`, `heure_prise`, `date_post`, `heure_post`, `texte_post`) VALUES
(1, 'mgentieu02@edu.ece.fr', 'arc_de_triomphe', 'images/arctriomphe.png', '2023-07-14', '11:25:59', '2023-08-01', '19:25:59', 'l\'arc de Triomphe en bleu blanc rouge pour le 14 juillet.'),
(2, 'hergentieu98@edu.ece.fr', 'sacre_coeur', 'images/sacrecoeur.png', '2023-08-22', '15:25:59', '2023-09-11', '19:25:59', 'Superbe photo du sacré coeur.'),
(3, 'theo.mettez@edu.ece.fr', 'notre_dame', 'images/notredame.png', '2023-10-27', '17:25:59', '2023-11-16', '19:25:59', 'Photo prise le mois dernier.'),
(4, 'danae.collard@edu.ece.fr', 'toureiffel', 'images/toureiffel.png', '2023-09-05', '14:25:59', '2023-09-05', '19:25:59', 'Petite visite de la Tour Eiffel aujourd\'hui!');

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
) ;

--
-- Déchargement des données de la table `reaction_evenement`
--

INSERT INTO `reaction_evenement` (`id_evenement`, `email_auteur`, `date_reaction`, `reac_positive`) VALUES
(1, 'hergentieu98@edu.ece.fr', '2023-04-23', 1),
(1, 'danae.collard@edu.ece.fr', '2023-04-27', 1),
(2, 'theo.mettez@edu.ece.fr', '2023-06-27', 1),
(2, 'mgentieu02@edu.ece.fr', '2023-06-25', 1),
(3, 'danae.collard@edu.ece.fr', '2023-08-21', 1),
(3, 'hergentieu98@edu.ece.fr', '2023-08-22', 1),
(4, 'theo.mettez@edu.ece.fr', '2023-12-07', 1),
(4, 'mgentieu02@edu.ece.fr', '2023-12-06', 1);

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
) ;

--
-- Déchargement des données de la table `reaction_photo`
--

INSERT INTO `reaction_photo` (`id_photo`, `email_auteur`, `date_reaction`, `reac_positive`) VALUES
(1, 'theo.mettez@edu.ece.fr', '2023-12-01', 1),
(1, 'hergentieu98@edu.ece.fr', '2023-12-01', 1),
(2, 'danae.collard@edu.ece.fr', '2023-12-01', 1),
(2, 'mgentieu02@edu.ece.fr', '2023-12-01', 0),
(3, 'hergentieu98@edu.ece.fr', '2023-12-01', 1),
(3, 'danae.collard@edu.ece.fr', '2023-12-01', 1),
(4, 'hergentieu98@edu.ece.fr', '2023-12-01', 1),
(4, 'theo.mettez@edu.ece.fr', '2023-12-01', 1);

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
) ;

--
-- Déchargement des données de la table `reaction_video`
--

INSERT INTO `reaction_video` (`id_video`, `email_auteur`, `date_reaction`, `reac_positive`) VALUES
(1, 'theo.mettez@edu.ece.fr', '2023-12-01', 1),
(1, 'hergentieu98@edu.ece.fr', '2023-12-01', 1),
(1, 'danae.collard@edu.ece.fr', '2023-12-01', 1),
(2, 'mgentieu02@edu.ece.fr', '2023-12-01', 1),
(2, 'hergentieu98@edu.ece.fr', '2023-12-01', 1),
(2, 'danae.collard@edu.ece.fr', '2023-12-01', 1);

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
) ;

--
-- Déchargement des données de la table `video`
--

INSERT INTO `video` (`id_video`, `email_auteur`, `alt`, `url`, `date_prise`, `heure_prise`, `date_post`, `heure_post`, `texte_post`) VALUES
(1, 'mgentieu02@edu.ece.fr', 'video1', 'quartier.mov', '2023-09-14', '16:25:59', '2023-10-03', '19:25:59', 'Je vous présente mon quartier'),
(2, 'theo.mettez@edu.ece.fr', 'video2', 'monde.mov', '2023-11-15', '16:12:59', '2023-11-16', '19:25:59', 'Regardez ce monde!');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
