<?php

// Pour demarer la session et les liées entre elles

session_start();
echo"<meta charset='utf-8'>";

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

if(!isset($_SESSION['ep'])){
    session_destroy();
    header("Location: accueil.php");
    exit();
}

// Déclaration des varibales
$message="";
$password=$_SESSION['mdp_bdd'];
$valid_form=true;

// Définie la base de donnée
$db = "ece_in";

// Définie la connexion à la base de donnée
$db_handle = mysqli_connect('localhost','root',$password);

// On va trouver la BD au bon endroit (serveur)à l'aide des deux variables definie précèdement et on le definie comme suit
$db_found = mysqli_select_db($db_handle,$db);

// Si on appuie sur le bouton ajouter on execute :
if(isset($_POST["ajoutformation"]))
{
    // Récupére les données de la page vous
    $ecole = isset($_POST["ecole"])?$_POST["ecole"]:"";
    $diplome = isset($_POST["diplome"])?$_POST["diplome"]:"";
    $domaineDetudes= isset($_POST["domaineDetudes"])?$_POST["domaineDetudes"]:"";
    $dateDebut = isset($_POST["dateDebut"])?$_POST["dateDebut"]:"";
    $dateFin = isset($_POST["dateFin"])?$_POST["dateFin"]:"";
    $res = isset($_POST["res"])?$_POST["res"]:"";
    $emailauteur = $_SESSION['emailauteur'];

    // Regarde si les données essentiels sont bien saisis et si oui les ajoutes
    if($ecole!=""&&$diplome!=""&&$domaineDetudes!=""&&$dateDebut!=""&&$dateFin!=""&&$res!="")
    {
    // Insert dans la base de donnée ece_in et dans la relation formation ce qui à été remplis dans le formulaire 
    /*$sql = "INSERT INTO `formation`(`Ecole`, `Diplome`, `DomaineEtudes`, `DataDebut`, `DateFin`, `Resultat`) VALUES ('$ecole','$diplome','$domaineDetudes','$dateDebut','$dateFin','$res')";
    $result = mysqli_query($db_handle, $sql);*/
    
    $sql = "INSERT INTO `formation`(`Ecole`, `Diplome`, `DomaineEtudes`, `DataDebut`, `DateFin`, `Resultat`, `mailusers`) VALUES ('$ecole', '$diplome', '$domaineDetudes', '$dateDebut', '$dateFin', '$res', '{$_SESSION['emailauteur']}')";
    $result = mysqli_query($db_handle, $sql);
    if (!$result) {
    echo "Erreur: " . mysqli_error($db_handle);
}
    }

    
    else
    {
        if($ecole=="")
        {
            $message.="Pas d'école mentionnée.<br>";
        }
        if($diplome=="")
        {
            $message.="Pas de diplôme mentionné.<br>";
        }
        if($domaineDetudes=="")
        {
            $message.="Pas de domaine d'études mentionné.<br>";
        }
        if($dateDebut=="")
        {
            $message.="Pas de date de début mentionnée.<br>";
        }
        if($dateFin=="")
        {
            $message.="Pas de date de fin mentionnée.<br>";
        }
        if($res=="")
        {
            $message.="Pas de res mentionné.<br>";
        }
        if($_SESSION['emailauteur']=="")
        {
            $message.="Pas de emailauteur mentionné.<br>";
        }
    }
    
}
// ferme la connexion
mysqli_close($db_handle)


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vous</title>
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
        form {
            text-align: left;
        }
    </style>
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
                <a href="vous.php" class="action-button animate green">Vous</a>
                <a href="notification.php" class="action-button animate blue">Notification</a>
                <a href="messagerie.php" class="action-button animate blue">Messagerie</a>
                <a href="emploi.php" class="action-button animate blue">Emploi</a>
            </div>

        </div>
        

        <div class="leftcolumn">
            <div >
                <img id ="photoProfil"src ="images/france1.jpg" alt = "Photo de profil" height="70" width="70">
            </div>
            <p>Formations</p>
            <ul>
                <!-- Rendre cliquable les formation pour les supprimer -->
                <li>
                    <a>
                        <?php 

                            //obligé pour lier les php de cette page ou sinon rien ne s'affiche
                            session_start();
                            echo"<meta charset='utf-8'>";

                            //essayer de l'afficher avec un alerte
                            /*echo $message;*/
                            // Définie la base de donnée
                            $db = "ece_in";

                            // Définie la connexion à la base de donnée
                            $db_handle = mysqli_connect('localhost','root',$password);

                            // On va trouver la BD au bon endroit (serveur)à l'aide des deux variables definie précèdement et on le definie comme suit
                            $db_found = mysqli_select_db($db_handle,$db);
                            $sql = "SELECT Ecole,dateDebut,dateFin FROM formation WHERE Ecole LIKE '%CIV%'";
                            $result = mysqli_query($db_handle, $sql);
                            $data = mysqli_fetch_assoc($result);
                            /* Plus tard on remplacera par un code qui s'écrir lui meme a partir de php et on appliquara la bonne requete sql pour tout afficher de l'utilisateur*/
                            echo "École : " . $data['Ecole'] /* photo si temps*/."<br>";
                            echo "Date de début : " .$data['DateDebut'] ."Date de fin :" .$data['DateFin']. "<br>";
                        ?>
                    </a>
                </li>
                <li>
                    <a img="#">
                </li>
                <li>
                    <a img="#">
                </li>
                <li>
                    <a img="#">
                </li>
            </ul>
            
            <form action="" method="post">
                <table border="0.5" >
                    <tr>
                        <td>École : </td>
                        <td> <input type = "text" name = "ecole"> </td>
                    </tr>
                    <tr>
                        <td>Diplôme : </td>
                        <td> <input type = "text" name = "diplome"> </td>
                    </tr>
                    <tr>
                        <td>Domaine d'études : </td>
                        <td> <input type = "text" name = "domaineDetudes"> </td>
                    </tr>
                    <tr>
                        <td>Date de début : </td>
                        <td> <input type = "date" name = "dateDebut"> </td>
                    </tr>
                    <tr>
                        <td>Date de fin : </td>
                        <td> <input type = "date" name = "dateFin"> </td>
                    </tr>
                    <tr>
                        <td>Résultat obtenu : </td>
                        <td> <input type = "text" name = "res"> </td>
                    </tr>
                    <tr >
                        <td colspan ="2" > <input type="submit" name = "ajoutformation" value = "Ajouter une formation"> </td>
                    </tr>
                </table>
                
            </form>
        </div>
 
        <div class="rightcolumn">
            <p>ECE In est une platforme de réseau social...
                <br>
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
