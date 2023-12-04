<?php

$user = 'root';
$password = ''; //To be completed if you have set a password to root
 //To be completed to connect to a database. The database must exist.
$port = NULL; //Default must be NULL to use default port
$valid_form=false;
$verif_email=false;
$verif_pseudo=false;
//$verif_connexion=false;
$message="";
$database = 'ECE_IN';
$mysqli = new mysqli('127.0.0.1', $user, $password, $database, $port);

if ($mysqli->connect_error) {
    echo "Erreur de connexion à la base de données.<br>";
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
else{
    $em=isset($_POST["ep"])? $_POST["ep"] : ""; 
    $mdp=isset($_POST["mdp"])? $_POST["mdp"] : ""; 
    
    echo '<p>Connection OK '. $mysqli->host_info.'</p>';
    echo '<p>Server '.$mysqli->server_info.'</p>';
    echo '<p>Initial charset: '.$mysqli->character_set_name().'</p>';

    if($em==""||$mdp==""){
        $valid_form=false;
        $message.="Un des champs requis est vide.<br>";
        //echo $message;
    }
    else{
        $valid_form=true;   
    }
    if($em==""){
        $message.="L'email de l'admin n'est pas indiqué.<br>";
    }
    if($mdp==""){
        $message.="Le mot de passe n'est pas indiqué.<br>";
    }
    
    if($valid_form){

        $result=$mysqli->query("select email_admin from administrateur where email_admin='$em'");
        
        $verif_email=($result->num_rows > 0)? true:false;
        if($verif_email){
            
            
            
            $row1 = $result->fetch_assoc();
            $message.= "email " . $row1["email_admin"]."<br>";
            $passw=$mysqli->query("select mot_de_passe from administrateur where email_admin='$em' and mot_de_passe='$mdp'");
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
        else{
            $message.="Email non présent dans la base de données. <br>";
        }
         
    } 
    echo $message; 
}

$mysqli->close();


?>
