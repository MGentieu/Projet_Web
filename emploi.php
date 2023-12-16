<?php

session_start();


if(!isset($_SESSION['ep'])){
    session_destroy();
    header("Location: accueil.php");
    exit();
}
else{
    $m1="";
    $user = 'root';
    $serveur='localhost';
    $password = $_SESSION['mdp_bdd'];
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
        $sql="SELECT * from auteur where email_auteur='$myEmail'";
        $result=$mysqli->query($sql);
        $domaine="null";
        if($result->num_rows>0){
            $row=$result->fetch_assoc();
            $domaine=$row['domaine'];
        }
        $sql="SELECT * from offre_emploi O where O.domaine='$domaine'";
        $result=$mysqli->query($sql);
        

        if($result->num_rows>0){
            $row=$result->fetch_assoc();
            $url=$row['url'];
            $descr=$row['Description'];
            $nom_offre=$row['nom_offre'];
            $ref_offre=$row['reference_offre'];
            $m1.='
                <div class="row">
                    <div class="col-sm-3" style="background-color: #96D8E8; height: 190px;">
                        <p style="text-align:center">
                            <a href="#"><img src="'.$url.'" height="190" width="190"></a>
                        </p>
                    </div>
                    <div class="col-sm-3" style="background-color: #96D8E8; height: 190px;">
                        <h3 style="color: black; text-align: left;">'.$nom_offre.'</h3>
                        <p style="color: black; text-align: left;">
                            '.$descr.'
                        </p>
                        <button id="stage1" value='.$ref_offre.'>Candidater</button>
                    </div>
                </div>';
        }
        else{
            $m1.="Un problème...";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Emploi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="ecein.css" rel="stylesheet" type="text/css" />
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

    <style type="text/css">
        
        #footer {
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: lightcyan;
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
                <a href="messagerie.php" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px;background-color: #188385;">Messagerie</button></a>
                <a href="emploi.php" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px;background-color: #20B2AA;">Emploi</button>
                </p></a>
            </div>

        </div>
        <div class="row" style="margin: 15px 0; padding: 5px;">
            <div class="col-sm-10" style="height:400px; overflow:scroll; float:left; border: 1px solid black;">
                <?php 
                    echo $m1;
                ?>
            </div>
            <div class="col-sm-2" style="height:400px;width :auto float:left; border: 1px solid black;">
                
                <p class="logout" style="text-align: center;"><br>
                    <a id="exit" href="#" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px;background-color: #E74C3C; font-size: 2em;">Quitter</button></a>
                </p>
            </div>
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
<?php
}
?>