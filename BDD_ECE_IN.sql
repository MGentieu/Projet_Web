DROP DATABASE IF EXISTS ECE_IN;
CREATE DATABASE ECE_IN ;
USE ECE_IN ;
DROP TABLE IF EXISTS Auteur ;
DROP TABLE IF EXISTS Administrateur ;
DROP TABLE IF EXISTS Image_de_fond ;
DROP TABLE IF EXISTS Conversation ;
DROP TABLE IF EXISTS Conversation ;
DROP TABLE IF EXISTS Participation ;
DROP TABLE IF EXISTS Message ;
DROP TABLE IF EXISTS Amitie ;

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
pseudo VARCHAR(30) NOT NULL,
mot_de_passe VARCHAR(30) NOT NULL ,
nom VARCHAR(30) NOT NULL ,
num_telephone Numeric(10) NOT NULL,
Description VARCHAR(300) ,
id_im_de_fond Numeric(6),
constraint FK1 foreign key (id_im_de_fond) references Image_de_fond(id_im_de_fond)
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


INSERT INTO Image_de_fond (id_im_de_fond,alt,url) VALUES
(145201,"Image de Paris","Paris.png");

