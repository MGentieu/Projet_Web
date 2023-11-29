DROP DATABASE IF EXISTS BDCOMMANDES;
CREATE DATABASE BDCOMMANDES ;
USE BDCOMMANDES ;
DROP TABLE IF EXISTS Fournisseurs ;
DROP TABLE IF EXISTS Produits ;
DROP TABLE IF EXISTS Commandes ;
CREATE TABLE Fournisseurs (
fno Numeric(6) NOT NULL primary key ,
nom VARCHAR(25) NOT NULL ,
adresse VARCHAR(25) ,
ville VARCHAR(25) NOT NULL
) ;
CREATE TABLE Produits (
pno Numeric(6) NOT NULL primary key ,
design VARCHAR(25) NOT NULL ,
prix Numeric(6,2) NOT NULL ,
poids Numeric(6,2) NOT NULL ,
couleur VARCHAR(25) NOT NULL
) ;
CREATE TABLE Commandes (
cno Numeric(6) NOT NULL primary key ,
fno Numeric(6) NOT NULL ,
pno Numeric(6) NOT NULL,
qute INT(5) NOT NULL ,
constraint FK1 foreign key (fno) references Fournisseurs(fno),
constraint FK2 foreign key (pno) references Produits(pno)
) ;
INSERT INTO FOURNISSEURS (Fno,Nom,Adresse,Ville) VALUES
(10,"Dupont",NULL,"Lille"),(15,"Durand",NULL,"Lille"),
(17,"Lefebvre",NULL,"Lille"),(12,"Jacquet",NULL,"Lyon"),
(14, "Martin",NULL,"Nice"),(13,"Durand",NULL,"Lyon"),
(11,"Martin",NULL,"Amiens"),(19,"Maurice",NULL,"Paris"),
(16,"Dupont",NULL,"Paris");
INSERT INTO PRODUITS (Pno,Design,Prix,Poids,Couleur) VALUES
(102,"fauteuil",1500,9,"rouge"),(103,"bureau",3500,30,"vert"),
(101,"fauteuil",2000,7,"gris"),(105,"armoire", 2500,35,"rouge"),
(104,"bureau",4000,40,"gris"),(107,"caisson",1000,12,"jaune"),
(106,"caisson",1000,12,"gris"),(108,"classeur",1500,20,"bleu");
INSERT INTO COMMANDES VALUES
(1001,17,103,10),(1003,15,103,2),(1005,17,102,1),
(1007,15,108,1),(1011,19,107,12),(1013,13,107,5),
(1017,19,105,3),(1019,14,103,10),(1023,10,102,8),
(1029,17,108,15);