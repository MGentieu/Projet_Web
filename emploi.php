<?php

session_start();


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
                <div class="row">
                    <div class="col-sm-6" style="background-color: #96D8E8; height: 190px;">
                        <p style="text-align:center">
                            <a href="#"><img src="images/google-logo.png" height="190" width="390"></a>
                        </p>
                    </div>
                    <div class="col-sm-6" style="background-color: #96D8E8; height: 190px;">
                        <p style="color: black; text-align: left; margin: 10px;">
                            Stage de 6 mois chez Google :<br>
                            Développement de sites web pour faire valoir l'entreprise.<br>
                            <ul>
                                <li style="text-align:left">Connaissances appronfondies en développement fullstack</li>
                                <li style="text-align:left">Minimum 3 ans d'expérience</li>
                                <li style="text-align:left">Sait gérer une équipe de projet</li>
                            </ul>
                            <form action="emploi.php" method="post">
                                <button type="submit" name="candidater" value="Google">Candidater</button>
                            </form>
                        </p>
                    </div>
                </div>
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