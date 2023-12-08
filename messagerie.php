<?php

session_start();

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
if(isset($_SESSION['ep'])){
    $message.="<br>Salut ".$_SESSION['ep']."<br>";
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
            while($row = $conversations->fetch_assoc()){
                $message.="La conversation nommée : '".$row['nom_conv']."'<br>";
            }
        }
        else{
            $message.="Vous ne participez à aucune conversation.<br>";
        }

        echo $message; 
    }

    $mysqli->close();
}
else{
    session_destroy();
    header("Location: accueil.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Messagerie</title>
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
</head>
<body>
    <div class="wrapper">


        <div class="gauche">
            <h1>ECE In: Social Media Professionel <br> 
                <br> de l'ECE Paris</h1>
        </div>

        <div class="droite">
        <div class="logoece"><img src="images/ecebaniere.jpg" alt="logo de ECE" width="200px" height="70px"></div>
        </div>
        
        
        
        <div _d="titre"></div>

        <div class="menu">
            
                
            
            <div id="logo">
                <a href="accueil.php" class="action-button animate blue">Accueil</a>
                <a href="monreseau.php" class="action-button animate blue">Réseau</a>
                <a href="vous.php" class="action-button animate blue">Vous</a>
                <a href="notification.php" class="action-button animate blue">Notification</a>
                <a href="messagerie.php" class="action-button animate green">Messagerie</a>
                <a href="emploi.php" class="action-button animate blue">Emploi</a>
            </div>

        </div>
        

        <div class="leftcolumn">

            
    	</div>
        

        <div class="rightcolumn">
            <p>ECE In est une platforme de réseau social...
                <br>
                <?php  
                    echo $message;
                ?>
            </p>
        </div>
        <div class="rightestcolumn">
            <p class="logout"><a id="exit" href="#" class="action-button animate red">Quitter</a></p>
            
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