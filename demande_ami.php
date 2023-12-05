<?php

$user = 'root';
$password = ''; //To be completed if you have set a password to root
 //To be completed to connect to a database. The database must exist.
$port = NULL; //Default must be NULL to use default port
$valid_form=false;

$verif1=false; //Email 1 existe dans auteur ?
$verif2=false; //Email 2 existe dans auteur ?
$verif3=false; //Demande d'ami existe déjà ?
$verif4=false; //Les 2 emails sont-ils identiques ?
$verif5=false; //Les 2 utilisateurs sont-ils déjà amis ?

$message="";
$database = 'ECE_IN';
$mysqli = new mysqli('localhost', $user, $password, $database, $port);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
else{
    echo '<p>Connection OK '. $mysqli->host_info.'</p>';
    echo '<p>Server '.$mysqli->server_info.'</p>';
    echo '<p>Initial charset: '.$mysqli->character_set_name().'</p>';

    $email1=isset($_POST["e1"])? $_POST["e1"] : ""; 
    $email2=isset($_POST["e2"])? $_POST["e2"] : ""; 
     if($email1==""||$email2==""){
        $valid_form=false;
        $message.="Un des champs requis est vide.<br>";
        
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
    
    if($valid_form){
        $user1=$mysqli->query("select email_auteur from auteur where email_auteur='$email1'");
        $user2=$mysqli->query("select email_auteur from auteur where email_auteur='$email2'");
        $demande=$mysqli->query("select * from demande_ami where email_ami_1='$email1' and email_ami_2='$email2' or email_ami_2='$email1' and email_ami_1='$email2'");
        $amitie=$mysqli->query("select * from amitie where email_ami_1='$email1' and email_ami_2='$email2' or email_ami_2='$email1' and email_ami_1='$email2'");
        
        $verif1=($user1->num_rows > 0)?true:false;
        $verif2=($user2->num_rows > 0)?true:false;
        $verif3=($demande->num_rows > 0)?false:true;
        //$verif4=($email1==$email2)?false:true;

        //Equivalent
        if($email1==$email2){
            $verif4=false;
        }
        else{
            $verif4=true;
        }
        $verif5=($amitie->num_rows > 0)?false:true;

        if($verif1&&$verif2&&$verif3&&$verif4&&$verif5){
            while($row = $user1->fetch_assoc()) {
                $message.= "e1 " . $row["email_auteur"]. "<br>";
            }
            while($row = $user2->fetch_assoc()) {
                $message.= "e2 " . $row["email_auteur"]. "<br>";
            }
            $mysqli->query("INSERT INTO Demande_ami VALUES ('$email1','$email2')");
            $message.="La demande d'ami a bien été faite.<br>";
            
        }
        if(!$verif1){
            $message.="Email du 1er auteur non trouvé dans la BDD ou erreur dans la requete SQL.<br>";
        }
        if(!$verif2){
            $message.="Email du 2nd auteur non trouvé dans la BDD ou erreur dans la requete SQL.<br>";
        }
        if($verif1&&$verif2&&!$verif3){
            $message.="Les 2 emails existent mais la demande d'ami a déjà été faite. Attendez qu'elle soit acceptée.<br>";
        }
        if($verif1&&$verif2&&!$verif4){
            $message.="Les 2 emails sont identiques.<br>";
        }
        if($verif1&&$verif2&&!$verif5){
            $message.="Les 2 emails existent, mais les utilisateurs correspondants sont déjà amis.<br>";
        }
    
    

        //$mysqli->query("INSERT INTO Administrateur (email_admin, mot_de_passe, nom, prenom, num_telephone) VALUES('mgentieu02@gmail.com', 'volcan1', 'Gentieu', 'Martin', 0695973078)");

        
        
    }
    
    echo $message;
}

$mysqli->close();


?>