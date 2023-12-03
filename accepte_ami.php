<?php

$user = 'root';
$password = ''; //To be completed if you have set a password to root
 //To be completed to connect to a database. The database must exist.
$port = NULL; //Default must be NULL to use default port
$valid_form=false;
$message="";
$database = 'ECE_IN';
$mysqli = new mysqli('127.0.0.1', $user, $password, $database, $port);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
else{
    $email1=isset($_POST["e1"])? $_POST["e1"] : ""; 
    $email2=isset($_POST["e2"])? $_POST["e2"] : ""; 
    
    echo '<p>Connection OK '. $mysqli->host_info.'</p>';
    echo '<p>Server '.$mysqli->server_info.'</p>';
    echo '<p>Initial charset: '.$mysqli->character_set_name().'</p>';

    if($email1==""||$email2==""){
        $valid_form=false;
        $message.="Un des champs requis est vide.<br>";
        //echo $message;
    }
    else{
        $valid_form=true;   
    }
    if($email1==""){
        $message.="Le 1er email n'est pas indiqué.<br>";
    }
    if($email2==""){
        $message.="Le 2nd email n'est pas indiqué.<br>";
    }
    
    if(!$valid_form){
        echo $message;
    }
    else{

        $result=$mysqli->query("select * from demande_ami where email_ami_1='$email1' and email_ami_2='$email2'");
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $message.= "e1 " . $row["email_ami_1"]. " - e1 " . $row["email_ami_2"]. "<br>";
            }
            $mysqli->query("INSERT INTO Amitie VALUES ('$email1','$email2')");
            $mysqli->query("DELETE FROM Demande_ami WHERE email_ami_1='$email1' AND email_ami_2='$email2'");
        }
        else{
            $message.="Demande d'ami non trouvée. Erreur. <br>";
        }
        
        

        
        echo $message;

    }  
}

$mysqli->close();


?>