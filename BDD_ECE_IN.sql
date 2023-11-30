DROP DATABASE IF EXISTS ECE_IN;
CREATE DATABASE ECE_IN ;
USE ECE_IN ;
DROP TABLE IF EXISTS Auteur ;
DROP TABLE IF EXISTS Administrateur ;
DROP TABLE IF EXISTS Image_de_fond ;
DROP TABLE IF EXISTS Correspondance_pseudo_email;
DROP TABLE IF EXISTS Conversation ;
DROP TABLE IF EXISTS Conversation ;
DROP TABLE IF EXISTS Participation ;
DROP TABLE IF EXISTS Message ;
DROP TABLE IF EXISTS Amitie ;
DROP TABLE IF EXISTS Entite ;
DROP TABLE IF EXISTS Offre_emploi ;
DROP TABLE IF EXISTS Candidature ;
DROP TABLE IF EXISTS Photo ;
DROP TABLE IF EXISTS Video ;
DROP TABLE IF EXISTS Evenement ;
DROP TABLE IF EXISTS Reaction_photo ;
DROP TABLE IF EXISTS Reaction_video ;
DROP TABLE IF EXISTS Reaction_evenement ;
DROP TABLE IF EXISTS Commentaire_photo ;
DROP TABLE IF EXISTS Commentaire_video ;
DROP TABLE IF EXISTS Commentaire_evenement ;
DROP TABLE IF EXISTS Partage_photo ;
DROP TABLE IF EXISTS Partage_video ;
DROP TABLE IF EXISTS Partage_evenement ;

CREATE TABLE Administrateur (
email_admin VARCHAR(50) NOT NULL primary key ,
mot_de_passe VARCHAR(30) NOT NULL ,
nom VARCHAR(30) NOT NULL ,
prenom VARCHAR(30) NOT NULL ,
num_telephone Numeric(10) NOT NULL
) ;

CREATE TABLE Image_de_fond (
id_im_de_fond Numeric(6) NOT NULL primary key ,
alt VARCHAR(40),
url VARCHAR(100)
) ;


CREATE TABLE Auteur (
email_auteur VARCHAR(50) NOT NULL primary key ,
mot_de_passe VARCHAR(30) NOT NULL ,
nom VARCHAR(30) NOT NULL ,
prenom VARCHAR(30) NOT NULL ,
num_telephone Numeric(10) NOT NULL,
Description VARCHAR(300) ,
id_im_de_fond Numeric(6),
constraint FK1 foreign key (id_im_de_fond) references Image_de_fond(id_im_de_fond)
) ;

CREATE TABLE Correspondance_pseudo_email (
pseudo VARCHAR(30) NOT NULL primary key,
email_auteur VARCHAR(50) NOT NULL ,
constraint FK1 foreign key (email_auteur) references Auteur(email_auteur)
) ;

CREATE TABLE Conversation (
id_conv Numeric(6) NOT NULL primary key ,
date_creation DATE NOT NULL,
nom_conv VARCHAR(40) NOT NULL
) ;

CREATE TABLE Participation (
id_conv Numeric(6) NOT NULL,
email_auteur VARCHAR(50) NOT NULL,
PRIMARY KEY (id_conv, email_auteur),
constraint FK1 foreign key (id_conv) references Conversation(id_conv),
constraint FK2 foreign key (email_auteur) references Auteur(email_auteur)
) ;

CREATE TABLE Message (
id_conv Numeric(6) NOT NULL,
email_auteur VARCHAR(50) NOT NULL,
numero Numeric(6) NOT NULL,
date_envoi DATE NOT NULL,
heure_envoi Time NOT NULL,
Contenu VARCHAR(200),
PRIMARY KEY (id_conv, email_auteur, numero),
constraint FK1 foreign key (id_conv) references Conversation(id_conv),
constraint FK2 foreign key (email_auteur) references Auteur(email_auteur)
) ;

CREATE TABLE Amitie (
email_ami_1 VARCHAR(50) NOT NULL,
email_ami_2 VARCHAR(50) NOT NULL,
PRIMARY KEY (email_ami_1, email_ami_2),
constraint FK1 foreign key (email_ami_1) references Auteur(email_auteur),
constraint FK2 foreign key (email_ami_2) references Auteur(email_auteur)
) ;

CREATE TABLE Entite(
siret Numeric(14) NOT NULL primary key ,
nom_entite VARCHAR(40) NOT NULL,
type_entite VARCHAR(40) NOT NULL,
lieu_siege VARCHAR(40) NOT NULL
) ;

CREATE TABLE Offre_emploi(
reference_offre VARCHAR(25) NOT NULL primary key ,
nom_offre VARCHAR(60) NOT NULL,
duree VARCHAR(30) NOT NULL,
date_debut DATE NOT NULL,
remuneration Numeric(10) NOT NULL,
Description VARCHAR(200) NOT NULL,
siret Numeric(14) NOT NULL,
constraint FK1 foreign key (siret) references Entite(siret)
) ;

CREATE TABLE Candidature(
reference_offre VARCHAR(25) NOT NULL ,
email_auteur VARCHAR(50) NOT NULL,
date_candidature DATE NOT NULL,
PRIMARY KEY (reference_offre, email_auteur),
constraint FK1 foreign key (reference_offre) references Offre_emploi(reference_offre),
constraint FK2 foreign key (email_auteur) references Auteur(email_auteur)
) ;

CREATE TABLE Photo (
id_photo Numeric(6) NOT NULL primary key,
email_auteur VARCHAR(50) NOT NULL,
alt VARCHAR(50),
url VARCHAR(100) NOT NULL,
date_prise DATE NOT NULL,
heure_prise Time NOT NULL,
date_post DATE NOT NULL,
heure_post Time NOT NULL,
texte_post VARCHAR(150),
constraint FK1 foreign key (email_auteur) references Auteur(email_auteur)
) ;

CREATE TABLE Video (
id_video Numeric(6) NOT NULL primary key,
email_auteur VARCHAR(50) NOT NULL,
alt VARCHAR(50),
url VARCHAR(100) NOT NULL,
date_prise DATE NOT NULL,
heure_prise Time NOT NULL,
date_post DATE NOT NULL,
heure_post Time NOT NULL,
texte_post VARCHAR(150),
constraint FK1 foreign key (email_auteur) references Auteur(email_auteur)
) ;

CREATE TABLE Evenement (
id_evenement Numeric(6) NOT NULL primary key,
email_auteur VARCHAR(50) NOT NULL,
alt VARCHAR(50),
url VARCHAR(100) NOT NULL,
date_debut DATE NOT NULL,
heure_debut Time NOT NULL,
date_fin DATE NOT NULL,
heure_fin Time NOT NULL,
date_post DATE NOT NULL,
heure_post Time NOT NULL,
texte_post VARCHAR(150),
constraint FK1 foreign key (email_auteur) references Auteur(email_auteur)
) ;

CREATE TABLE Reaction_photo (
id_photo Numeric(6) NOT NULL,
email_auteur VARCHAR(50) NOT NULL,
date_reaction DATE NOT NULL,
reac_positive Bool NOT NULL,
PRIMARY KEY (id_photo, email_auteur),
constraint FK1 foreign key (id_photo) references Photo(id_photo),
constraint FK2 foreign key (email_auteur) references Auteur(email_auteur)
) ;

CREATE TABLE Reaction_video (
id_video Numeric(6) NOT NULL,
email_auteur VARCHAR(50) NOT NULL,
date_reaction DATE NOT NULL,
reac_positive Bool NOT NULL,
PRIMARY KEY (id_video, email_auteur),
constraint FK1 foreign key (id_video) references Video(id_video),
constraint FK2 foreign key (email_auteur) references Auteur(email_auteur)
) ;

CREATE TABLE Reaction_evenement (
id_evenement Numeric(6) NOT NULL,
email_auteur VARCHAR(50) NOT NULL,
date_reaction DATE NOT NULL,
reac_positive Bool NOT NULL,
PRIMARY KEY (id_evenement, email_auteur),
constraint FK1 foreign key (id_evenement) references Evenement(id_evenement),
constraint FK2 foreign key (email_auteur) references Auteur(email_auteur)
) ;

CREATE TABLE Commentaire_photo (
id_photo Numeric(6) NOT NULL,
email_auteur VARCHAR(50) NOT NULL,
date_commentaire DATE NOT NULL,
heure_commentaire Time NOT NULL,
texte_commentaire VARCHAR(150) NOT NULL,
PRIMARY KEY (id_photo, email_auteur),
constraint FK1 foreign key (id_photo) references Photo(id_photo),
constraint FK2 foreign key (email_auteur) references Auteur(email_auteur)
) ;

CREATE TABLE Commentaire_video (
id_video Numeric(6) NOT NULL,
email_auteur VARCHAR(50) NOT NULL,
date_commentaire DATE NOT NULL,
heure_commentaire Time NOT NULL,
texte_commentaire VARCHAR(150) NOT NULL,
PRIMARY KEY (id_video, email_auteur),
constraint FK1 foreign key (id_video) references Video(id_video),
constraint FK2 foreign key (email_auteur) references Auteur(email_auteur)
) ;

CREATE TABLE Commentaire_evenement (
id_evenement Numeric(6) NOT NULL,
email_auteur VARCHAR(50) NOT NULL,
date_commentaire DATE NOT NULL,
heure_commentaire Time NOT NULL,
texte_commentaire VARCHAR(150) NOT NULL,
PRIMARY KEY (id_evenement, email_auteur),
constraint FK1 foreign key (id_evenement) references Evenement(id_evenement),
constraint FK2 foreign key (email_auteur) references Auteur(email_auteur)
) ;

CREATE TABLE Partage_photo (
id_photo Numeric(6) NOT NULL,
email_auteur VARCHAR(50) NOT NULL,
date_partage DATE NOT NULL,
heure_partage Time NOT NULL,
texte_partage VARCHAR(150) NOT NULL,
PRIMARY KEY (id_photo, email_auteur),
constraint FK1 foreign key (id_photo) references Photo(id_photo),
constraint FK2 foreign key (email_auteur) references Auteur(email_auteur)
) ;

CREATE TABLE Partage_video (
id_video Numeric(6) NOT NULL,
email_auteur VARCHAR(50) NOT NULL,
date_partage DATE NOT NULL,
heure_partage Time NOT NULL,
texte_partage VARCHAR(150) NOT NULL,
PRIMARY KEY (id_video, email_auteur),
constraint FK1 foreign key (id_video) references Video(id_video),
constraint FK2 foreign key (email_auteur) references Auteur(email_auteur)
) ;


CREATE TABLE Partage_evenement (
id_evenement Numeric(6) NOT NULL,
email_auteur VARCHAR(50) NOT NULL,
date_partage DATE NOT NULL,
heure_partage Time NOT NULL,
texte_partage VARCHAR(150) NOT NULL,
PRIMARY KEY (id_evenement, email_auteur),
constraint FK1 foreign key (id_evenement) references Evenement(id_evenement),
constraint FK2 foreign key (email_auteur) references Auteur(email_auteur)
) ;


INSERT INTO Image_de_fond (id_im_de_fond,alt,url) VALUES
(145201,"Image de Paris","Paris.png");

INSERT INTO Auteur (email_auteur,id_im_de_fond,mot_de_passe,nom,prenom,num_telephone,Description) VALUES
("hgentieu97@gmail.com",145201,"volcan1","Gentieu","Hector",0620212425,"J'aime les pommes");
INSERT INTO Auteur (email_auteur,id_im_de_fond,mot_de_passe,nom,prenom,num_telephone,Description) VALUES 
("hergentieu98@gmail.com",145201,"siecle2","Gentieu","Hervé",0624212066,"J'aime les poires");

INSERT INTO Administrateur (email_admin,mot_de_passe,nom,prenom,num_telephone) VALUES
("mgentieu02@gmail.com","volcan1","Gentieu","Martin",0695973078);

INSERT INTO Amitie VALUES ("hgentieu97@gmail.com","hergentieu02@gmail.com");

INSERT INTO `photo` (`id_photo`, `email_auteur`, `alt`, `url`, `date_prise`, `heure_prise`, `date_post`, `heure_post`, `texte_post`) 
VALUES ('1', 'hgentieu97@gmail.com', 'photo_sympa', 'machin.png', '2023-11-15', '16:25:59', '2023-11-16', '19:25:59', 'Superbe photo d\'un machin.');


INSERT INTO `video` (`id_video`, `email_auteur`, `alt`, `url`, `date_prise`, `heure_prise`, `date_post`, `heure_post`, `texte_post`) 
VALUES ('1', 'hgentieu97@gmail.com', 'photo_sympa', 'machin.mov', '2023-11-15', '16:25:59', '2023-11-16', '19:25:59', 'Superbe video');

INSERT INTO `evenement` (`id_evenement`, `email_auteur`, `alt`, `url`, `date_debut`, `heure_debut`, `date_fin`, `heure_fin`, `date_post`, `heure_post`, `texte_post`) 
VALUES ('1', 'hgentieu97@gmail.com', 'photo_sympa', 'Evenement.jpg', '2023-11-15', '16:25:59', '2023-11-16', '19:25:59', '2023-11-13', '11:30:05', 'Venez assister à la conférence sur les chaussettes trouées.');

INSERT INTO `entite` (`siret`, `nom_entite`, `type_entite`, `lieu_siege`) 
VALUES ('11122233300015', 'ECE', 'Ecole d\'ingénieur', 'Paris');

INSERT INTO `conversation` (`id_conv`, `date_creation`, `nom_conv`) 
VALUES ('1', '2023-11-08', 'Les Gentioux');

INSERT INTO `participation` (`id_conv`, `email_auteur`) 
VALUES ('1', 'hgentieu97@gmail.com');
INSERT INTO `participation` (`id_conv`, `email_auteur`) 
VALUES ('1', 'hergentieu98@gmail.com');


INSERT INTO `message` (`id_conv`, `email_auteur`, `numero`, `date_envoi`, `heure_envoi`, `Contenu`) 
VALUES ('1', 'hergentieu98@gmail.com', '1', '2023-11-10', '21:34:58', 'Salut Hector !');

INSERT INTO `offre_emploi` (`reference_offre`, `nom_offre`, `duree`, `date_debut`, `remuneration`, `Description`, `siret`) 
VALUES ('STG235-ECE', 'Poste de balayeur', '6 mois', '2023-12-01', '1500', 'Poste de Balayeur sur le campus Eiffel 1', '11122233300015');

INSERT INTO `candidature` (`reference_offre`, `email_auteur`, `date_candidature`) 
VALUES ('STG235-ECE', 'hgentieu97@gmail.com', '2023-12-05');

INSERT INTO `correspondance_pseudo_email` (`pseudo`, `email_auteur`) 
VALUES ('HGentieu', 'hgentieu97@gmail.com');
INSERT INTO `correspondance_pseudo_email` (`pseudo`, `email_auteur`) 
VALUES ('HerGentieu', 'hergentieu98@gmail.com');

INSERT INTO `reaction_photo` (`id_photo`, `email_auteur`, `date_reaction`, `reac_positive`) 
VALUES ('1', 'hergentieu98@gmail.com', '2024-01-01', '1');

INSERT INTO `reaction_video` (`id_video`, `email_auteur`, `date_reaction`, `reac_positive`) 
VALUES ('1', 'hergentieu98@gmail.com', '2024-01-01', '1');

INSERT INTO `reaction_evenement` (`id_evenement`, `email_auteur`, `date_reaction`, `reac_positive`) 
VALUES ('1', 'hergentieu98@gmail.com', '2024-01-01', '1');

INSERT INTO `commentaire_photo` (`id_photo`, `email_auteur`, `date_commentaire`, `heure_commentaire`, `texte_commentaire`) 
VALUES ('1', 'hergentieu98@gmail.com', '2024-01-01', '19:16:32', 'Belle photo en effet');

INSERT INTO `commentaire_video` (`id_video`, `email_auteur`, `date_commentaire`, `heure_commentaire`, `texte_commentaire`) 
VALUES ('1', 'hergentieu98@gmail.com', '2024-01-01', '19:16:32', 'Belle vidéo en effet');

INSERT INTO `commentaire_evenement` (`id_evenement`, `email_auteur`, `date_commentaire`, `heure_commentaire`, `texte_commentaire`) 
VALUES ('1', 'hergentieu98@gmail.com', '2023-11-09', '19:16:32', 'J\'ai hâte d\'y participer');

INSERT INTO `partage_photo` (`id_photo`, `email_auteur`, `date_partage`, `heure_partage`, `texte_partage`) 
VALUES ('1', 'hergentieu98@gmail.com', '2023-12-22', '19:15:29', 'Je partager cette photo d\'Hector car elle est superbe.');

INSERT INTO `partage_video` (`id_video`, `email_auteur`, `date_partage`, `heure_partage`, `texte_partage`) 
VALUES ('1', 'hergentieu98@gmail.com', '2023-12-22', '19:15:29', 'Je partage cette vidéo d\'Hector car elle est amusante.');

INSERT INTO `partage_evenement` (`id_evenement`, `email_auteur`, `date_partage`, `heure_partage`, `texte_partage`) 
VALUES ('1', 'hergentieu98@gmail.com', '2023-12-22', '19:15:29', 'Je partage le post pour cet événement car j\'invite ceux que ça intéresse à y participer aussi.');


