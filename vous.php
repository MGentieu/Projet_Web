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

if(!isset($_SESSION['ep'])){
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
                    <a img="#">
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
            <!-- java  : une fois cliquer on va demander de remplir un formulaire et apres jquery ou php ca enregistre la donnée et ca la stoc pour venir la recuperer avec le h ref puisque on sotck par ordre chrono
            -->
            <form action="formation_cv.php" method="post">
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
                        <td colspan ="2" > <input type="submit" name="ajoutformation" value ="Ajouter une formation"> </td>
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
