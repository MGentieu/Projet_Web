<?php

session_start();
//$_SESSION['idConv']=-1;

function load_conv($el) { 

    echo "<br>L'id de conversation choisi est : ".$el."<br>"; 
} 

if (isset($_GET['logout'])){ 
//Message de sortie simple 
    $logout_message = "On a quitté<br>";
    $myfile = fopen(__DIR__ . "/currentUser.html", "w") or die("Impossible d'ouvrir le fichier!" . __DIR__ . "/currentUser.html"); 
    fwrite($myfile, $logout_message); 
    fclose($myfile); 
    session_destroy(); 
    sleep(1); 
    header("Location: accueil.php"); 
    exit();
    //Rediriger l'utilisateur 
}

$message="";
$message2="";
if(isset($_SESSION['ep'])){
    $message.="<p><br><strong>Bonjour ".$_SESSION['ep'].", voici vos conversations :</strong></p><br>";
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
        $pseudo=$_SESSION['ep']; 
        $SQL="SELECT DISTINCT P.id_conv,C.nom_conv FROM participation P JOIN conversation C JOIN correspondance_pseudo_email CPE ON P.id_conv=C.id_conv AND P.email_auteur=CPE.email_auteur WHERE CPE.pseudo='$pseudo'";
        $conversations=$mysqli->query($SQL);
        
        if($conversations->num_rows >0){
            $message.="<form action='messagerie.php' method='post' bgColor='teal'><table bgColor='teal' class='table' align='center' style='color: black;' width='400'>";
            $message.="<tr bgColor='teal' style='color: white;'> <th colspan='3' align='center' style='color: white;'>Liste des conversations</th></tr>";
            while($row = $conversations->fetch_assoc()){
                //$message.="La conversation nommée : '".$row['nom_conv']."'<br>";
                $message.="<tr bgColor='lightcyan'><td name='Conv_Id'>".$row['id_conv']."</td>";
                $message.="<td>".$row['nom_conv']."</td>";
                $message.="<td><button type='submit' name='valid_conv' value='".$row['id_conv']."' class='button-style'>Accéder à la conversation"."</td></tr>";
            }

            $message.="</table></form>";
        }
        else{
            $message.="Vous ne participez à aucune conversation.<br>";
        }
        $message.="<br><br>";
        $message.="<form action='Creer_conversation.php' method='post' bgColor='teal'><table bgColor='teal' class='table' align='center' style='color: black;' width='400'>";
        $message.="<tr bgColor='teal' style='color: white;'> <th colspan='3' align='center' style='color: white;'>Creer une conversation :</th></tr>";
        $message.="<tr bgColor='lightcyan'><td>Nom de la conversation</td>";
        $message.="<td><input type='text' name='nom_conv'></td>";
        $message.="<td><button type='submit' name='creer_conv' value='creer_conv' class='button-style'>Créer la conversation</button></td></tr>";
        $message.="</table></form>";

        //echo $message; 
    }

    $mysqli->close();
}
else{
    session_destroy();
    header("Location: accueil.php");
    exit();
}

if(isset($_POST['valid_conv'])){
    $myId = $_POST['valid_conv'];
    $_SESSION['idConv']=$myId;
    $message2 = "Bouton appuyé. Id de la conv = ".$myId."<br>";
    $nameFile = $myId.".html";
    $filepath = __DIR__ . "/".$nameFile;  // Correction du chemin du fichier
    $_SESSION['namefile']=$nameFile;
    $_SESSION['filepath']=$filepath;
    /*
    $myfile = fopen($filepath, "a") or die("Impossible d'ouvrir le fichier " . $filepath);
    fwrite($myfile, $message2);
    fclose($myfile);
    */
    
    header("Location: chat.php");
    exit();

}

/*
if(isset($_POST['creer_conv'])){
    $nom_conv=(isset($_POST['nom_conv']))?$_POST['nom_conv']:"";
    if($nom_conv!=""){

    }
    else{

    }

    /*
    $myfile = fopen($filepath, "a") or die("Impossible d'ouvrir le fichier " . $filepath);
    fwrite($myfile, $message2);
    fclose($myfile);
    
    
    header("Location: messagerie.php");
    exit();

}
*/


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Messagerie</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="ecein.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#exit").click(function () { 
                var exit = confirm("Voulez-vous vraiment mettre fin à la session ?"); 
                if (exit == true) { 
                    window.location = "accueil.php?logout=true"; 
                } 
            });
        });
        
            
        

    </script>

    <style type="text/css">
        
        .button-style {
    color: white;
    border-radius: 5px;
    background-color: #20B2AA;
    border-bottom: 3px solid #008B8B;
}

    </style>
</head>
<body>
    <div class="wrapper" style="overflow:scroll;">


        <div class="gauche">
            <h2>ECE In: Social Media Professionel <br> 
                 de l'ECE Paris</h2>
        </div>

        <div class="droite">
        <div class="logoece"><img src="images/ecebaniere.jpg" alt="logo de ECE" width="200px" height="70px"></div>
        </div>
        
        
        
        <div _d="titre"></div>

        <div class="menu">
            
                
            
            <div id="logo">
                <p style="text-align: center;">
                <a href="accueil.php" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px;background-color: #188385;">Accueil</button></a> 
                <a href="monreseau.php" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px;background-color: #188385;">Mon réseau</button></a>
                <a href="vous.php" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px;background-color: #188385;">Vous</button></a>
                <a href="notification.php" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px;background-color: #188385;">Notification</button></a>
                <a href="messagerie.php" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px;background-color: #20B2AA;">Messagerie</button></a>
                <a href="emploi.php" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px;background-color: #188385;">Emploi</button>
                </p></a>
            </div>

        </div>
        

        <div class="leftcolumn">
            <?php
            echo $_COOKIE['test1'].'<br>'.$_COOKIE['test2'];
            ?>
            <br><br><br>
            <p style="text-align:center">
                <a href="#"><img src="images/teams.png" height='200' width='200'></a>
            </p>
    	</div>
        

        <div class="rightcolumn" style="overflow:scroll;">
            <p>
                <?php  
                    echo $message;
                    //echo $message2;
                ?>
            </p>
        </div>
        <div class="rightestcolumn">
            <p class="logout" style="text-align: center;"><br>
                <a id="exit" href="#" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px;background-color: #E74C3C; font-size: 2em;">Quitter</button></a>
            </p>
            
        </div>

        <div id="footer">
            <footer>
             <strong> ECE In <br> 75015 Paris </strong>      
            </footer> 
        
        
        </div>
    </div>
    
<div class="fond-second-plan">

</div>


</body>
</html>