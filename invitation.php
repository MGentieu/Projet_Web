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
    $ep=isset($_POST["pseudo_em"])? $_POST["pseudo_em"] : ""; 
    //$pseudo=(isset($_SESSION['ep']))?$_SESSION['ep']:""; 

    //echo '<p>Connection OK '. $mysqli->host_info.'</p>';
    //echo '<p>Server '.$mysqli->server_info.'</p>';
    //echo '<p>Initial charset: '.$mysqli->character_set_name().'</p>';

    if($nom!=""||){

    }
    
}
$mysqli->close();
header("Location: chat.php");
exit();

if (isset($_POST['inviter'])){ 
	if($_POST['pseudo_em'] != ""){ 
		//$_SESSION['ep'] = stripslashes(htmlspecialchars($_POST['ep'])); 
		//$_SESSION['name'] = "Yolo";
		$user;
	} 
	
} 



?>