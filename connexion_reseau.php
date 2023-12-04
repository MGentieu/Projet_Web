<?php

$user = 'root';
$password = 'root'; //To be completed if you have set a password to root
 //To be completed to connect to a database. The database must exist.
$port = NULL; //Default must be NULL to use default port
$valid_form=false;
$verif_email=false;
$verif_pseudo=false;
//$verif_connexion=false;
$message="";
$database = 'ECE_IN';
$mysqli = new mysqli('localhost', $user, $password, $database, $port);

if ($mysqli->connect_error) {
    echo "Erreur de connexion à la base de données.<br>";
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
else{
    $email_pseudo=isset($_POST["ep"])? $_POST["ep"] : ""; 
    $mdp=isset($_POST["mdp"])? $_POST["mdp"] : ""; 
    
    echo '<p>Connection OK '. $mysqli->host_info.'</p>';
    echo '<p>Server '.$mysqli->server_info.'</p>';
    echo '<p>Initial charset: '.$mysqli->character_set_name().'</p>';

    if($email_pseudo==""||$mdp==""){
        $valid_form=false;
        $message.="Un des champs requis est vide.<br>";
        //echo $message;
    }
    else{
        $valid_form=true;   
    }
    if($email_pseudo==""){
        $message.="L'email ou le pseudo n'est pas indiqué.<br>";
    }
    if($mdp==""){
        $message.="Le mot de passe n'est pas indiqué.<br>";
    }
    
    if($valid_form){

        $result1=$mysqli->query("select email_auteur from auteur where email_auteur='$email_pseudo'");
        $result2=$mysqli->query("select * from correspondance_pseudo_email where pseudo='$email_pseudo'");
        $verif_email=($result1->num_rows > 0)? true:false;
        $verif_pseudo=($result2->num_rows > 0)? true:false;
        if($verif_email||$verif_pseudo){
            
            
            if($verif_email){
                $row1 = $result1->fetch_assoc();
                $message.= "email " . $row1["email_auteur"]."<br>";
                $passw=$mysqli->query("select mot_de_passe from auteur where email_auteur='$email_pseudo' and mot_de_passe='$mdp'");
                if($passw->num_rows > 0){
                    $message.= "L'utilisateur est maintenant connecté! " ."<br>";
                    session_start();
                    $_SESSION['info'] = "Ceci est une information depuis PHP";
                    header("Location: accueil.php");
                    exit();
                }
                else{
                    $message.= "Mauvais mot de passe! " ."<br>";
                }

            }
            if($verif_pseudo){
                $row2 = $result2->fetch_assoc();
                $message.="pseudo " . $row2["pseudo"]." - email " . $row2["email_auteur"]. "<br>";
                $email_correspondant=$row2["email_auteur"];
                $passw=$mysqli->query("select mot_de_passe from auteur where email_auteur='$email_correspondant' and mot_de_passe='$mdp'");
                if($passw->num_rows > 0){
                    $message.= "L'utilisateur est maintenant connecté! " ."<br>";
                    session_start();
                    $_SESSION['info'] = "Ceci est une information depuis PHP";
                    header("Location: accueil.php");
                    exit();
                }
                else{
                    $message.= "Mauvais mot de passe! " ."<br>";
                }
            }
            
            
        
        }
        else{
            $message.="Pseudo ou email non présent dans la base de données. <br>";
        }
         

    } 
    echo $message; 
}

$mysqli->close();


?>