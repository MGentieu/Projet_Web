<?php

$user = 'root';
$password = ''; //To be completed if you have set a password to root
 //To be completed to connect to a database. The database must exist.
$port = NULL; //Default must be NULL to use default port
$verif=false;
/*$mysqli2=  new mysqli('127.0.0.1', $user, $password, '',$port);


if ($mysqli2->connect_error) {
    die('Connect Error (' . $mysqli2->connect_errno . ') '
            . $mysqli2->connect_error);
}
else{
    $mysqli2->query("DROP DATABASE IF EXISTS TEST_ECE_IN");
    $mysqli2->query("CREATE DATABASE TEST_ECE_IN");
    $mysqli2->query("USE ECE_IN") ;
}
$mysqli2->close();
*/

$database = 'ECE_IN';
$mysqli = new mysqli('127.0.0.1', $user, $password, $database, $port);

if ($mysqli->connect_error||$verif) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
else{
    echo '<p>Connection OK '. $mysqli->host_info.'</p>';
    echo '<p>Server '.$mysqli->server_info.'</p>';
    echo '<p>Initial charset: '.$mysqli->character_set_name().'</p>';

    $mysqli->query("DROP TABLE IF EXISTS Demande_ami") ;
    $mysqli->query("CREATE TABLE Demande_ami (
    email_ami_1 VARCHAR(50) NOT NULL,
    email_ami_2 VARCHAR(50) NOT NULL,
    PRIMARY KEY (email_ami_1, email_ami_2),
    constraint FK1 foreign key (email_ami_1) references Auteur(email_auteur),
    constraint FK2 foreign key (email_ami_2) references Auteur(email_auteur)
    )");

    $mysqli->query("INSERT INTO Demande_ami VALUES ('hgentieu97@gmail.com','ericdampierregmail.com')");

    //$mysqli->query("DROP TABLE IF EXISTS test1");
    //$mysqli->query("DROP DATABASE IF EXISTS TEST_ECE_IN");
    //$mysqli->query("CREATE DATABASE TEST_ECE_IN");
    //$mysqli->query("USE ECE_IN") ;
    //$mysqli->query("CREATE TABLE test_table_requet_php(id INT)");
    //$mysqli->query("DROP TABLE IF EXISTS Administrateur");
    /*
    $mysqli->query("CREATE TABLE Administrateur (
    email_admin VARCHAR(50) NOT NULL primary key ,
    mot_de_passe VARCHAR(30) NOT NULL ,
    nom VARCHAR(30) NOT NULL ,
    prenom VARCHAR(30) NOT NULL ,
    num_telephone Numeric(10) NOT NULL
    ) ");

    $mysqli->query("INSERT INTO Administrateur (email_admin,mot_de_passe,nom,prenom,num_telephone)
    VALUES('mgentieu02@gmail.com','volcan1','Gentieu','Martin',0695973078)");

    //$mysqli->query("INSERT INTO Administrateur (email_admin, mot_de_passe, nom, prenom, num_telephone) VALUES('mgentieu02@gmail.com', 'volcan1', 'Gentieu', 'Martin', 0695973078)");
    */

    /*
    CREATE TABLE Administrateur (
    email_admin VARCHAR(50) NOT NULL primary key ,
    mot_de_passe VARCHAR(30) NOT NULL ,
    nom VARCHAR(30) NOT NULL ,
    prenom VARCHAR(30) NOT NULL ,
    num_telephone Numeric(10) NOT NULL
    ) ;
    */
    

    echo "<p>La table a bien été créée.</p>";
}

$mysqli->close();


?>