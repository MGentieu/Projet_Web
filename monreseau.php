<?php

session_start();


$message="";
$message2="";
if(isset($_SESSION['ep'])){
    $message.="<p><br><strong>Bonjour ".$_SESSION['ep'].", voici la liste de vos amis :</strong></p><br>";
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
        $email_pseudo=$_SESSION['emailauteur']; 
        $SQL="SELECT AF.nom,AF.prenom,AF.id_im_de_fond,IM.url FROM auteur AF JOIN image_de_fond IM ON AF.id_im_de_fond=IM.id_im_de_fond
        WHERE AF.email_auteur IN(SELECT DISTINCT A.email_auteur FROM auteur A WHERE A.email_auteur IN(SELECT A1.email_ami_1 FROM amitie A1 WHERE A1.email_ami_2='$email_pseudo') or A.email_auteur IN(SELECT A2.email_ami_2 FROM amitie A2 WHERE A2.email_ami_1='$email_pseudo'))";
        $amitie=$mysqli->query($SQL);


        if($amitie->num_rows >0){
            $message.="<form action='monreseau.php' method='post' bgColor='teal'><table bgColor='teal' class='table' align='center' style='color: black;' width='400'>";

            $message.="<tr bgColor='teal' style='color: white;' align='center'> <td colspan='3' align='center' style='color: white;'>Liste des amis</td></tr>";

            while($row = $amitie->fetch_assoc()){
                //$message.="La conversation nommée : '".$row['nom_conv']."'<br>";
                $message.="<tr bgColor='lightcyan'><td name='email_auteur'>".$row['prenom']."</td>";
                $message.="<td>".$row['nom']."</td>";
                $message.="<td><img src='" . $row['url'] . "' alt='Image de fond' height='50px' width='80px' type='submit' name='valid_ami' value='".$row['id_im_de_fond']."' class='button-style'></td></tr>";
            }

            $message.="</table></form>";
        }
        else{
            $message.="Vous n'avez aucuns amis<br>";
        }
        $message.="<br><br>";
        $message.="<form action='demande_ami.php' method='post' bgColor='teal'><table bgColor='teal' class='table' align='center' style='color: black;' width='400'>";
        $message.="<tr bgColor='teal' style='color: white;'> <td colspan='3' align='center' style='color: white;'>Trouver des amis</td></tr>";
        $message.="<tr bgColor='lightcyan'><td>Email d'une personne</td>";
        $message.="<td><input type='text' name='email_auteur'></td>";
        $message.="<td><button type='submit' name='id_im_de_fond' value='id_im_de_fond' class='button-style'>Créer l'amitie</button></td></tr>";
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

if(isset($_POST['valid_ami'])){
    $myId = $_POST['valid_ami'];
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
    
    header("Location: profil.php");
    exit();

}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mon réseau</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> 
    <link href="ecein.css" rel="stylesheet" type="text/css" />
    <!-- Bibliothèque jQuery --> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js">
        
    </script> <!-- Dernier JavaScript compilé --> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#exit").click(function () { 
                var exit = confirm("Voulez-vous vraiment mettre fin à la session ?"); 
                if (exit == true) { 
                    window.location = "quitter.php?logout=true"; 
                } 
            });
        });
    </script>
</head>
<body>
    <div class="wrapper" style="overflow:scroll;">


        <div class="gauche" >
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
                <a href="monreseau.php" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px;background-color: #20B2AA;">Mon réseau</button></a>
                <a href="vous.php" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px;background-color: #188385;">Vous</button></a>
                <a href="notification.php" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px;background-color: #188385;">Notification</button></a>
                <a href="messagerie.php" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px;background-color: #188385;">Messagerie</button></a>
                <a href="emploi.php" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px;background-color: #188385;">Emploi</button>
                </p></a>

            </div>

        </div>
        

        <div class="leftcolumn">
        
        </div>
        

        <div class="rightcolumn" style="overflow:scroll;">
            <p style="text-align:center;">        
                <?php echo $message; ?>    
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