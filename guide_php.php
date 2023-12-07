<?php

//Récupérer des informations:
//Dans un document html, avec un formulaire, vous devez écrire :
//	<form action="nom_du_fichier.php" method="post">

$user = 'root';
$password = ''; //Sur Wampp. Si vous êtes sur Mamp, écrivez plutôt $password='root';
$port = NULL; 
$database = 'ECE_IN'; //vous devez avoir créé la BDD ece_in pour que ça marche.
$mysqli = new mysqli('127.0.0.1', $user, $password, $database, $port); //Crée une connexion

if ($mysqli->connect_error) { // Vérifie si la connexion a été établie.
    echo "Erreur de connexion à la base de données.<br>"; //Message d'erreur.
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}

else{ //La connexion a été établie

    //Exemples de requetes de selection.
    //N'oubliez pas les petites guillemets '' entre les variables dans les requetes.
    $result1=$mysqli->query("select email_auteur from auteur where email_auteur='$email_pseudo'");
    $result2=$mysqli->query("select * from correspondance_pseudo_email where pseudo='$email_pseudo'");
    //Comme en python, les valeurs de retour sont similaires à des dictionnaires.
    //chaque ligne retournée de la sélection comporte des colonnes (une colonne par attribut) dont on pourra accéder aux valeurs grâces à des clefs, d'où la similarité avec les dictionnaires.


    if($result1->num_rows > 0){ //Si la sélection a retourné au moins une ligne.
        while($row = $result1->fetch_assoc()) { //Tant que l'on peut récupérer une ligne
            $message.= "e1 " . $row["email_auteur"]. "<br>"; //La clef "email_auteur" permet d'accéder à la valeur contenu dans l'attribut email_auteur.
        }

        //Exemple de requête d'insertion : 
        $mysqli->query("INSERT INTO Demande_ami VALUES ('$email1','$email2')");
        //Le principe est le même que pour les requêtes de sélection.
    
    }
    
}

$mysqli->close(); //À NE JAMAIS OUBLIER!
