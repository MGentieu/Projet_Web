DROP DATABASE IF EXISTS ECE_IN;
CREATE DATABASE ECE_IN ;
USE ECE_IN ;
DROP TABLE IF EXISTS Auteur ;
DROP TABLE IF EXISTS Administrateur ;
DROP TABLE IF EXISTS Image_de_fond ;

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

INSERT INTO Image_de_fond (id_im_de_fond,alt,url) VALUES
(145201,"Image de Paris","Paris.png");

