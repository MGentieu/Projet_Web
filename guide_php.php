<?php

//Récupérer des informations:
//Dans un document html, avec un formulaire, vous devez écrire :
//	<form action="nom_du_fichier.php" method="post">

$user = 'root';
$password = ''; 
$port = NULL; 
$database = 'ECE_IN'; //vous devez avoir créé la BDD ece_in pour que ça marche.
$mysqli = new mysqli('127.0.0.1', $user, $password, $database, $port); //Crée une connexion

if ($mysqli->connect_error) { // Vérifie si la connexion a été établie.
    echo "Erreur de connexion à la base de données.<br>";
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}

else{ //La connexion a été établie

}