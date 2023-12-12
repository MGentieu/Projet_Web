<?php

session_start();
$user = 'root';
$password = (isset($_SESSION['mdp_bdd']))?$_SESSION['mdp_bdd']:''; //To be completed if you have set a password to root
 //To be completed to connect to a database. The database must exist.
$port = NULL; //Default must be NULL to use default port
$valid_form=false;
$verif1=false; // L'utilisateur existe-t-il ?
$verif2=false; // Juste pour vérifier qu'on a bien trouvé un nouvel identifiant de conversation.
$new_id=0;
$message="";
$database = 'ECE_IN';
$mysqli = new mysqli('127.0.0.1', $user, $password, $database, $port);

date_default_timezone_set('Europe/Paris');
$today = getdate(); //On obtient la date et l'heure.
print_r($today);
$date2="";
$date2.=$today['year']."-".$today['mon']."-".$today['mday'];
echo "<br><br>";
echo $date2;

//$date = "2012-08-06";
$date_actuelle=date("Y-m-d",strtotime($date2));

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
else{
    $nom=isset($_POST["nom_conv"])? $_POST["nom_conv"] : ""; 
    $pseudo=(isset($_SESSION['ep']))?$_SESSION['ep']:""; 

    echo '<p>Connection OK '. $mysqli->host_info.'</p>';
    echo '<p>Server '.$mysqli->server_info.'</p>';
    echo '<p>Initial charset: '.$mysqli->character_set_name().'</p>';

    if($nom==""||$pseudo==""){
        $valid_form=false;
        $message.="Un des champs est vide.<br>";
        //echo $message;
    }
    else{
        $valid_form=true;   
    }
    /*
    if($nom==""){
        $message.="Le nom du créateur n'est pas indiqué.<br>";
    }
    if($email==""){
        $message.="L' email n'est pas indiqué.<br>";
    }
    */
    
    if($valid_form){

        

        $correspondance=$mysqli->query("select email_auteur from correspondance_pseudo_email where pseudo='$pseudo'");
        if($correspondance->num_rows>0){
            $row=$correspondance->fetch_assoc();
            $email=$row['email_auteur'];
            //$user_test=$mysqli->query("select email_auteur from auteur where email_auteur='$email'");
            //$verif1=($user_test->num_rows > 0)?true:false;

            
            $mysqli->query("INSERT INTO `conversation` (`date_creation`, `nom_conv`) VALUES ('$date_actuelle', '$nom')");
            $max=$mysqli->query("SELECT distinct MAX(id_conv) FROM `conversation`");
                if($max->num_rows > 0){
                    $verif2=true;
                    $row = $max->fetch_assoc();
                    $new_id=$row['MAX(id_conv)'];   
                }
            $mysqli->query("INSERT INTO `participation` (`id_conv`, `email_auteur`) VALUES
            ('$new_id', '$email')");

            
            
        }
        
    } 
    //echo $message; 
}

$mysqli->close();
header("Location: messagerie.php");
exit();

?>