<?php
$ = isset($_POST["ecole"])?$_POST["ecole"]:"";
$ = isset($_POST["diplome"])?$_POST["diplome"]:"";
$ = isset($_POST["domaineDetudes"])?$_POST["domaineDetudes"]:"";
$ = isset($_POST["dateDebut"])?$_POST["dateDebut"]:"";
$ = isset($_POST["dateFin"])?$_POST["dateFin"]:"";
$ = isset($_POST["res"])?$_POST["res"]:"";

// Définie la base de donnée
$db = "ece_in";
// Définie la connexion à la base de donnée
$db_handle = mysqli_connect('localhost','root','root');
// On va trouver la BD au bon endroit (serveur)à l'aide des deux variables definie précèdement et on le definie comme suit
$db_found = mysqli_select_db($db_handle,$db);

?>