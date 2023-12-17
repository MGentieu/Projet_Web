<?php
// Pour demarer la session et la lier aux autres, ceci permet d'utiliser les variables globals.
session_start();
$emailauteur="";

//Permet d'appliquer les styles css.
echo"<meta charset='utf-8'>";
if (isset($_GET['logout']))
{ 

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

if(!isset($_SESSION['ep']))
{
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

// Si on appuie sur le bouton ajouter on execute.
if(isset($_POST["ajoutformation"]))
//Rq : ici on n'affiche pas d'erreur si la base de donné est introuvable car ca fonctionne et que c'est plus ergonomique pour le client. 
{
    // Récupére les données de la page vous.php
    $ecole = isset($_POST["ecole"])?$_POST["ecole"]:"";
    $dateDebut = isset($_POST["dateDebut"])?$_POST["dateDebut"]:"";
    $dateFin = isset($_POST["dateFin"])?$_POST["dateFin"]:"";
    $emailauteur = $_SESSION['emailauteur'];
    /*
    $diplome = isset($_POST["diplome"])?$_POST["diplome"]:"";
    $domaineDetudes= isset($_POST["domaineDetudes"])?$_POST["domaineDetudes"]:"";
    $res = isset($_POST["res"])?$_POST["res"]:"";
    */
    echo "Ecole: $ecole<br>";
echo "Date de début: $dateDebut<br>";
echo "Date de fin: $dateFin<br>";
    // Regarde si les données essentiels sont bien saisis et si oui les ajoutes
    if($ecole!=""&&$dateDebut!=""&&$dateFin!="")
    { 
        $sql = "INSERT INTO `formation`(`Ecole`, `DateDebut`, `DateFin`, `mailusers`) VALUES ('$ecole', '$dateDebut', '$dateFin', '$emailauteur')";

        // Result contient le tableau de valeur retourné par la requete sql.
        $result = mysqli_query($db_handle, $sql);

        //Ici on supprime cela pour la meme raison que prècedement
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
        if($dateDebut=="")
        {
            $message.="Pas de date de début mentionnée.<br>";
        }
        if($dateFin=="")
        {
            $message.="Pas de date de fin mentionnée.<br>";
        }
        /*
        if($res=="")
        {
            $message.="Pas de res mentionné.<br>";
        }
        */
        /*
        if($diplome=="")
        {
            $message.="Pas de diplôme mentionné.<br>";
        }
        
        if($domaineDetudes=="")
        {
            $message.="Pas de domaine d'études mentionné.<br>";
        }
        */
        echo "$message";
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

        $(document).ready(function() 
        {
            $("#exit").click(function () 
            { 
                var exit = confirm("Voulez-vous vraiment mettre fin à la session ?"); 
                if (exit == true) 
                { 
                    window.location = "quitter.php?logout=true"; 
                } 
            });
        });

    </script>

    <style type="text/css">

        /*Presente les formations à gauche*/
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

        /* Selecteur CSS qui permet de sélectionner tout les input de cette page et d'y appliquer les atttribues css suivant : */
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

        /*Permet de mettre un arrière plan derrière le formulaire.*/
        #wrapperr
        {
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
            <h2>ECE In: Social Media Professionel <br> de l'ECE Paris</h2>
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
                <?php 
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

                            if(isset($_POST["ajoutformation"]))

                            {

                                $SQL = "SELECT DISTINCT Ecole, DateDebut, DateFin FROM formation WHERE mailusers LIKE '%" . $emailauteur . "%'ORDER BY DateDebut DESC";

                                // Result contient le tableau de valeur retourné par la requete sql.
                                $result = mysqli_query($db_handle, $SQL);

                                // Le bloc de code à l'intérieur de la boucle s'exécute pour chaque ligne de résultat
                                while ($data = mysqli_fetch_assoc($result)) 
                                {
                                    $message2 .= "<li>" . "École : " . $data['Ecole'] . "<br>";
                                    $message2 .= "Date de début : " . $data['DateDebut'] . "<br>" . "Date de fin :" . $data['DateFin'] . "<br>" . "</li><br>";
                                    echo $message2;
                                }

                            }
                            mysqli_close($db_handle);
                        ?>        
            </ul>       
        </div>


        <!-- Permet de scroller dans le div-->
        <div class="rightcolumn" style="overflow:scroll;">

            <div id = "titrecolmid">
                <!--Pour ecrire en gars on utilise la balise <b>-->
            <p><b>Ajoutez vos formations, vos projet et créer votre CV automatiquement avec ECE in !</b></p> 
            </div>

        <div id="wrapperr" style="overflow:scroll;">

            <!-- Formulaire permettant de remplir ses formations -->

            <form action="vous.php" method="post">

                <table border="0.3" border radius ="10px" >

                    <tr>
                        <td> École : </td>
                        <td> <input type = "text" name = "ecole"> </td>
                    </tr>
                    <!--
                        <td>Diplôme : </td>
                        <td> <input type = "text" name = "diplome"> </td>
                    </tr>
                    <tr>
                        <td>Domaine d'études : </td>
                        <td> <input type = "text" name = "domaineDetudes"> </td>
                    </tr>
                    <tr>
                    <tr>
                        <td>Résultat obtenu : </td>
                        <td> <input type = "text" name = "res"> </td>
                    </tr>
                    -->
                    <tr>
                        <td>Date de début : </td>
                        <td> <input type = "date" name = "dateDebut"> </td>
                    </tr>

                    <tr>
                        <td>Date de fin : </td>
                        <td><input type = "date" name = "dateFin"> </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" name = "ajoutformation" value = "Ajouter une formation">
                        </td>
                    </tr>

                </table>

            </form>

            <!-- Formulaire permettant de remplir ou changer sa photo de profils-->

            <form action="vous.php" method="post" enctype="multipart/form-data">

                <table>
                <tr>
                    
                    <td>
                        Photo :
                    </td>
                    
                    <td>
                            <input type="file" name="photo">
                    </td>

                </tr>
                <tr>
                    <td colspan="2" align="center" ><input type="submit" name = "photoo" value = "Ajouter une photo">
                    </td>
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
    
<div class="fond-second-plan"></div>

</body>
</html>
