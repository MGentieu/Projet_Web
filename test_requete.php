<?php

$user = 'root';
$password = ''; //To be completed if you have set a password to root
$database = 'TEST_ECE_IN'; //To be completed to connect to a database. The database must exist.
$port = NULL; //Default must be NULL to use default port
$verif=false;
$mysqli2=  new mysqli('127.0.0.1', $user, $password, '',$port);
$mysqli = new mysqli('127.0.0.1', $user, $password, $database, $port);

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

if ($mysqli->connect_error||$verif) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
else{
    echo '<p>Connection OK '. $mysqli->host_info.'</p>';
    echo '<p>Server '.$mysqli->server_info.'</p>';
    echo '<p>Initial charset: '.$mysqli->character_set_name().'</p>';

    //$mysqli->query("DROP TABLE IF EXISTS test1");
    //$mysqli->query("DROP DATABASE IF EXISTS TEST_ECE_IN");
    //$mysqli->query("CREATE DATABASE TEST_ECE_IN");
    //$mysqli->query("USE ECE_IN") ;
    //$mysqli->query("CREATE TABLE test_table_requet_php(id INT)");
    $mysqli->query("DROP TABLE IF EXISTS Administrateur");
    
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