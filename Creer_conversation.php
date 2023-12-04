<?php

$user = 'root';
$password = ''; //To be completed if you have set a password to root
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

$date = "2012-08-06";
$date_actuelle=date("Y-m-d",strtotime($date2));

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
else{
    $nom=isset($_POST["nom"])? $_POST["nom"] : ""; 
    $email=isset($_POST["em"])? $_POST["em"] : ""; 

    echo '<p>Connection OK '. $mysqli->host_info.'</p>';
    echo '<p>Server '.$mysqli->server_info.'</p>';
    echo '<p>Initial charset: '.$mysqli->character_set_name().'</p>';

    if($nom==""||$email==""){
        $valid_form=false;
        $message.="Un des champs est vide.<br>";
        //echo $message;
    }
    else{
        $valid_form=true;   
    }
    if($nom==""){
        $message.="Le nom du créateur n'est pas indiqué.<br>";
    }
    if($email==""){
        $message.="L' email n'est pas indiqué.<br>";
    }
    
    if($valid_form){

        $max=$mysqli->query("SELECT distinct MAX(id_conv) FROM `conversation`");
        if($max->num_rows > 0){
            $verif2=true;
            $row = $max->fetch_assoc();
            $new_id=$row['MAX(id_conv)']+1;   
        }

        $user_test=$mysqli->query("select email_auteur from auteur where email_auteur='$email'");
        $verif1=($user_test->num_rows > 0)?true:false;

        if($verif1&&$verif2){
            $mysqli->query("INSERT INTO `conversation` (`id_conv`, `date_creation`, `nom_conv`) VALUES ('$new_id', '$date_actuelle', '$nom')");

            $mysqli->query("INSERT INTO `participation` (`id_conv`, `email_auteur`) VALUES
            ('$new_id', '$email')");

            
            $message.="La conversation a bien été créée'.<br>";
        }
        if(!$verif1){
            $message.="L'email n'est pas inscrit dans le réseau.<br>";
        }
        

    } 
    echo $message; 
}

$mysqli->close();


?>