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
siret Numeric(14) NOT NULL,
date_candidature DATE NOT NULL,
PRIMARY KEY (reference_offre, siret),
constraint FK1 foreign key (reference_offre) references Offre_emploi(reference_offre),
constraint FK2 foreign key (siret) references Entite(siret)
) ;

CREATE TABLE Photo (
id_photo Numeric(6) NOT NULL primary key,
email_auteur VARCHAR(50) NOT NULL,
alt VARCHAR(50),
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

