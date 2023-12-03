<?php

$user = 'root';
$password = ''; //To be completed if you have set a password to root
 //To be completed to connect to a database. The database must exist.
$port = NULL; //Default must be NULL to use default port
$valid_form=false;
$verif1=false; //L'email existe-t-il déjà?
$verif2=false; //Le pseudo existe-t-il déjà?
$message="";
$database = 'ECE_IN';
$mysqli = new mysqli('127.0.0.1', $user, $password, $database, $port);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
else{
    $nom=isset($_POST["nom"])? $_POST["nom"] : ""; 
    $prenom=isset($_POST["prenom"])? $_POST["prenom"] : ""; 
    $pseudo=isset($_POST["pseudo"])? $_POST["pseudo"] : ""; 
    //$age=isset($_POST["Age"])? $_POST["Age"] : ""; 
    $email=isset($_POST["email"])? $_POST["email"] : "";
    $mdp=isset($_POST["mdp"])? $_POST["mdp"] : "";
    $descr=isset($_POST["descr"])? $_POST["descr"] : "";
    $num_tel=isset($_POST["phone"])? $_POST["phone"] : "";
    echo '<p>Connection OK '. $mysqli->host_info.'</p>';
    echo '<p>Server '.$mysqli->server_info.'</p>';
    echo '<p>Initial charset: '.$mysqli->character_set_name().'</p>';

    if($nom==""||$pseudo==""||$prenom==""||$email==""||$mdp==""||$num_tel==""){
        $valid_form=false;
        $message.="Un des champs requis est vide.<br>";
        //echo $message;
    }
    else{
        $valid_form=true;   
    }
    if($nom==""){
        $message.="Le champ nom est vide.<br>";
    }
    if($prenom==""){
        $message.="Le champ prenom est vide.<br>";
    }
    if($pseudo==""){
        $message.="Le champ peudo est vide.<br>";
    }
    if($email==""){
        $message.="Le champ email est vide.<br>";
    }
    if($mdp==""){
        $message.="Le champ indiquant le mot de passe est vide.<br>";
    }
    if($num_tel==""){
        $message.="Le champ indiquant le numéro de téléphone est vide.<br>";
    }
    if($valid_form){
        
        $user_test=$mysqli->query("select email_auteur from auteur where email_auteur='$email'");
        $user_test2=$mysqli->query("select pseudo from correspondance_pseudo_email where pseudo='$pseudo'");
        $verif1=($user_test->num_rows > 0)?false:true;
        $verif2=($user_test2->num_rows > 0)?false:true;
        if($verif1&&$verif2){
            $mysqli->query("INSERT INTO Auteur (email_auteur, id_im_de_fond, mot_de_passe, nom, prenom, num_telephone, Description) VALUES ('$email', 145201, '$mdp', '$nom', '$prenom', '$num_tel', '$descr')");


            $mysqli->query("INSERT INTO `correspondance_pseudo_email` (`pseudo`, `email_auteur`) 
            VALUES('$pseudo','$email')");
            $message.="L'utilisateur a bien été rajouté'.<br>";
        }
        if(!$verif1){
            $message.="L'email est déjà utilisé par quelqu'un d'autre.<br>";
        }
        if(!$verif2){
            $message.="Le pseudo est déjà utilisé par quelqu'un d'autre.<br>";
        }

    } 
    echo $message; 
}

$mysqli->close();


?>