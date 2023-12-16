<?php

session_start();
if (isset($_GET['logout'])){ 
//Message de sortie simple 
    $user = 'root';
    $serveur='localhost';
    $password=(isset($_SESSION['mdp_bdd']))?$_SESSION['mdp_bdd']:'';
    $port = NULL;

    $database = 'ECE_IN';
    $mysqli = new mysqli($serveur, $user, $password, $database, $port);

    if ($mysqli->connect_error) {
        echo "Erreur de connexion à la base de données.<br>";
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }
    else{
        $myEmail=$_SESSION['emailauteur'];
        $reac1=$_COOKIE['post1'];
        $reac2=$_COOKIE['post2'];
        $id1=isset($_SESSION['id_postAuteur1'])?$_SESSION['id_postAuteur1']:-1000;
        $id2=isset($_SESSION['id_postAmi1'])?$_SESSION['id_postAmi1']:-1000;
        if(isset($_SESSION['id_postAuteur1'])){
            $sql="SELECT SUM(reac_positive) FROM `reaction_photo` WHERE id_photo=$id1";
            $somme=$mysqli->query($sql);
            $incremente=0;
            $reac=0;
            if($somme->num_rows>0){
                $sommeTotale=$somme->fetch_assoc();
                $incremente=$reac1-$sommeTotale['SUM(reac_positive)'];
            }
            $sql = "SELECT reac_positive FROM `reaction_photo` R WHERE R.id_photo = '" . $row['id_photo'] . "' AND R.email_auteur = '$myEmail'";
            $result=$mysqli->query($sql);
            if($result->num_rows>0){
                $reacTotale=$somme->fetch_assoc();
                $reac=$reacTotale['reac_positive'];
            }
            
            $final=(($incremente>=2)*1)+(($incremente<=-2)*(-1))+min(1,max(-1,($reac+$incremente)*($incremente>-2&&$incremente<2)));
            $sql="UPDATE `reaction_photo` SET `reac_positive` = '$final' WHERE CONCAT(`reaction_photo`.`id_photo`) = $id1 AND `reaction_photo`.`email_auteur` = '$myEmail'";
            $mysqli->query($sql);
        }
        if(isset($_SESSION['id_postAmi1'])){
            $sql="SELECT SUM(reac_positive) FROM `reaction_photo` WHERE id_photo=$id2";
            $somme=$mysqli->query($sql);
            $incremente=0;
            $reac=0;
            if($somme->num_rows>0){
                $sommeTotale=$somme->fetch_assoc();
                $incremente=$reac2-$sommeTotale['SUM(reac_positive)'];
            }
            $sql = "SELECT reac_positive FROM `reaction_photo` R WHERE R.id_photo = '" . $row['id_photo'] . "' AND R.email_auteur = '$myEmail'";
            $result=$mysqli->query($sql);
            if($result->num_rows>0){
                $reacTotale=$somme->fetch_assoc();
                $reac=$reacTotale['reac_positive'];
            }
            
            $final=(($incremente>=2)*1)+(($incremente<=-2)*(-1))+min(1,max(-1,($reac+$incremente)*($incremente>-2&&$incremente<2)));
            $sql="UPDATE `reaction_photo` SET `reac_positive` = '$final' WHERE CONCAT(`reaction_photo`.`id_photo`) = $id2 AND `reaction_photo`.`email_auteur` = '$myEmail'";
            $mysqli->query($sql);
        }
        
    }
    $logout_message = "On a quitté<br>";
    $myfile = fopen(__DIR__ . "/currentUser.html", "w") or die("Impossible d'ouvrir le fichier!" . __DIR__ . "/currentUser.html"); 
    $mysqli->close();
    fwrite($myfile, $logout_message); 
    fclose($myfile); 
    session_destroy(); 
    sleep(1); 
    header("Location: accueil.php"); 
    exit();
    //Rediriger l'utilisateur 
}
?>