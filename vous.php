<?php

// Pour demarer la session et les liées entre elles

session_start();
echo"<meta charset='utf-8'>";
$emailauteur="";


if (isset($_GET['logout'])){ 

    //Message de sortie simple 
    $logout_message = "On a quitté<br>";
    $myfile = fopen(__DIR__ . "/currentUser.html", "w") or die("Impossible d'ouvrir le fichier!" . __DIR__ . "/currentUser.html"); 
    fwrite($myfile, $logout_message); 
    fclose($myfile); 
    session_destroy(); 
    sleep(1); 

    //Rediriger l'utilisateur 
    header("Location: accueil.php"); 
    exit();
}

if(!isset($_SESSION['ep'])){
    session_destroy();
    header("Location: accueil.php");
    exit();
}

// Déclaration des varibales
$emailauteur="";
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
        $sql = "INSERT INTO `formation`(`Ecole`, `Diplome`, `DomaineEtudes`, `DataDebut`, `DateFin`, `Resultat`, `mailusers`) VALUES ('$ecole', '$diplome', '$domaineDetudes', '$dateDebut', '$dateFin', '$res', '$emailauteur')";
        $result = mysqli_query($db_handle, $sql);
        if (!$result) 
        {
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
            $("#ajoutformation").click(function () {
                $("li").empty(); // Cette ligne supprime le contenu de l'élément <a>
            });
        });
    </script>
</head>
<body>
    <h1>ECE Paris Ecole d'Ingénieurs</h1>
    <a>helo</a>
    <br><br>
    <button id="button4">Basculer l'image</button>
</body>
</html>
    </script>
    <style type="text/css">
        form 
        {
            text-align:left;
        }
        /* Pour éviter aux blocs du formulaire d'etre collé*/
        tr
        {
            padding: 3px;
        }
        td{
            padding: 3px;
        }
         input[type="submit"] 
        {
      background-color: #188385;
      color: white;
      padding: 9px;
      border-radius: 5px;
      border: none;
      /*Permet d'afficher une main a la place de la flèche quad on passe sur le bouton*/
      cursor: pointer;
      }
    #titrecolmid
    {            
        width: auto;
        height: 33px;
        background-color: #188385;
        text-align: center;
        color:white;
        padding: 9px;

        }
        #wrapperr{
            height: auto;
            width: auto;
            background-color:#20B2AA ;
            align-content: center;
            align-items: center;
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
                <a href="vous.php" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px;background-color: #20B2AA;">Vous</button></a>
                <a href="notification.php" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px;background-color: #188385;">Notification</button></a>
                <a href="messagerie.php" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px;background-color: #188385;">Messagerie</button></a>
                <a href="emploi.php" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px;background-color: #188385;">Emploi</button>
                </p></a>
            </div>

        </div>
        

        <div class="leftcolumn" style="overflow:scroll;width: 20%;">
            <div >
                <img id ="photoProfil"src ="images/france1.jpg" alt = "Photo de profil" height="70" width="70">
            </div>
            <p>Formations</p>
            <ul>
                <!-- Rendre cliquable les formation pour les supprimer -->
                    <?php 

                            //obligé pour lier les php de cette page ou sinon rien ne s'affiche
                            //session_start();
                            echo"<meta charset='utf-8'>";

                            //essayer de l'afficher avec un alerte
                            $message2="";

                            // Définie la base de donnée
                            $db = "ece_in";

                            // Définie la connexion à la base de donnée
                            $db_handle = mysqli_connect('localhost','root',$password);


                            // On va trouver la BD au bon endroit (serveur)à l'aide des deux variables definie précèdement et on le definie comme suit
                            $db_found = mysqli_select_db($db_handle,$db);
                            /*$SQL="SELECT Ecole, DataDebut, DateFin FROM formation WHERE mailusers LIKE '%"."$emailauteur"."%"."'";*/
                            $SQL = "SELECT Ecole, DataDebut, DateFin FROM formation WHERE mailusers LIKE '%" . $emailauteur . "%'ORDER BY DataDebut DESC";
                            /*$SQL="SELECT Ecole, DataDebut, DateFin FROM formation WHERE mailusers LIKE '%"."$emailauteur"."%"."''AND DataDebut ORDER BY DESC";*/
                            //Requete sql qui compte le nombre de foramtion de l'auteur 
                            //Une boucle for pour afficher le bon nombre de formation
                            $result = mysqli_query($db_handle, $SQL);
                            // Le bloc de code à l'intérieur de la boucle s'exécute pour chaque ligne de résultat
                            while ($data = mysqli_fetch_assoc($result)) 
                            {
                            $message2.="<li>". "École : " . $data['Ecole'] /* photo si temps*/."<br>";
                            $message2.= "Date de début : " .$data['DataDebut']."<br>" ."Date de fin :" .$data['DateFin']. "<br>"."</li><br>";
                            echo $message2;
                            }
                        ?>        
        </div>
        <div class="rightcolumn" style="overflow:scroll;">
            <div id = "titrecolmid">
                <!--Pour ecrire en gars balise <b<>-->
            <p><b>Ajoutez vos formations, vos projet et créer votre CV automatiquement avec ECE in !</b></p> 
            </div>
        <div id="wrapperr" style="overflow:scroll;">
            <form action="" method="post">
                <table border="0.3" border radius ="10px" >
                    <tr>
                        <td color ="white">École : </td>
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
                        <td colspan = "2"><input type = "date" name = "dateFin"> </td>
                    </tr>
                    <tr>
                        <td>Résultat obtenu : </td>
                        <td> <input type = "text" name = "res"> </td>
                    </tr>
                    <tr >

                        <td> <input id="ajoutformation" type="submit" name = "ajoutformation" value = "Ajouter une formation"> </td>

                        <td><input type="submit" name="consulterformation" value="Générer un CV"></td>
                    </tr>
                </table>
            </form>
        </div>
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
