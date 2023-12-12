<?php  
session_start();

$user = 'root';
$password = (isset($_SESSION['mdp_bdd']))?$_SESSION['mdp_bdd']:''; //To be completed if you have set a password to root
$email="";
$myId=$_SESSION['idConv'];
$myEmail=$_SESSION['ep'];
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
    if($ep==""){
        $mysqli->close();
        header("Location: chat.php");
        exit();
    }
    else{
        //$pseudo=(isset($_SESSION['ep']))?$_SESSION['ep']:"";
        $correspondance=$mysqli->query("select email_auteur from correspondance_pseudo_email where pseudo='$ep' or email_auteur='$ep'");
        $correspondance2=$mysqli->query("select email_auteur from correspondance_pseudo_email where pseudo='$myEmail'"); 
        if($correspondance->num_rows>0 && $correspondance2->num_rows>0){
            $row=$correspondance->fetch_assoc();
            $row2=$correspondance2->fetch_assoc();
            $email=$row['email_auteur'];
            $myEmail=$row2['email_auteur'];
            $match=$mysqli->query("select * from amitie where (email_ami_1='$myEmail' and email_ami_2='$email') or (email_ami_2='$myEmail' and email_ami_1='$email')");
            if($match->num_rows>0){
                //$row=$match->fetch_assoc();
                $match=$mysqli->query("select email_auteur from participation where email_auteur='$email' and id_conv='$myId'");
                if($match->num_rows>0){
                    echo "L'ami participe déjà à la conversation.<br>";
                    //$mysqli->close();
                    //header("Location: chat.php");
                    //exit();
                }
                else{
                    $mysqli->query("INSERT INTO `participation` (`id_conv`, `email_auteur`) VALUES
                ('$myId', '$email')");
                }
                
            }
            else{
                echo "Pas de match dans la table amitié.<br>";
            }
            
        }
        else{
            echo "Pas de correspondance<br>";
        }
    }

    
}
$mysqli->close();
//header("Location: chat.php");
//exit();




?>