<?php

session_start();


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vous</title>
<link href="ecein.css" rel="stylesheet" type="text/css" />
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
            <input type="button" name="ajoutformation" value ="Ajouter une formation">
            
        </div>
        

        <div class="rightcolumn">
            <p>ECE In est une platforme de réseau social...
                <br>
            </p>
        </div>
        <div class="rightestcolumn">
            
            
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
