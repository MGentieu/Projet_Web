<?php
session_start();
if (isset($_GET['logout'])){ 
//Message de sortie simple 
    $logout_message = "On a quitté<br>";
    $myfile = fopen(__DIR__ . "/currentUser.html", "a") or die("Impossible d'ouvrir le fichier!" . __DIR__ . "/currentUser.html"); 
    fwrite($myfile, $logout_message); 
    fclose($myfile); 
    session_destroy(); 
    sleep(1); 
    header("Location: accueil.php"); 
    exit();
    //Rediriger l'utilisateur 
} 

if (isset($_POST['enter'])){ 
    if($_POST['ep'] != ""){ 
        $_SESSION['ep'] = stripslashes(htmlspecialchars($_POST['ep'])); 
        //$_SESSION['name'] = "Yolo";
    } 
    else{ 
        echo '<span class="error">Veuillez saisir votre mail</span>'; 
    } 
}

function loginForm() { 
    //echo '<div id="loginform"> <p>Veuillez saisir votre nom pour continuer!</p> <form action="chat.php" method="post"> <label for="name">Nom: </label> <input type="text" name="name" id="name" /> <input type="submit" name="enter" id="enter" value="Soumettre" /> </form> </div>'; 
    /*
    $contenu_html="";
    $contenu_html.="<p><center>"; 
    $contenu_html.="<form action = 'connexion_admin.php' method='post'>";
    $contenu_html.="<table border='1'>";
    $contenu_html.="<tr><td>Identifiant (Mail) : </td><td> <input type = 'text' name = 'ep'></td></tr>";
    $contenu_html.="<tr><td>Mot de passe : </td><td> <input type = 'password' name = 'mdp'></td></tr>";
    $contenu_html.="</table><input type='submit' name='enter' value='Connexion'></form>";
    $contenu_html.="</center></p>";
    */
    //echo "Bonjour";
    if(file_exists("connexion_reseau.html") && filesize("connexion_reseau.html") > 0){ 
        $contents = file_get_contents("connexion_reseau.html"); 
        echo $contents; 
    } 
} 

?>


<?php  
    if(!isset($_SESSION['ep'])){
        loginForm();
    }
    else{?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Emploi</title>
    <link href="ecein.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
   

    <script type="text/javascript">
        
        $(document).ready(function() {
    var $carrousel = $('#carrousel'), 
        $img = $('#carrousel img'), 
        indexImg = $img.length - 1, 
        i = 0, 
        k = indexImg,
        j = i + 1,
        $currentImg = $img.eq(i),
        $prevImg = $img.eq(k),
        $nextImg = $img.eq(j);

    $img.css('display', 'none');
    //$prevImg.css('display', 'block');
    $currentImg.css('display', 'block');
    //$nextImg.css('display', 'block'); 
    
    $('#next').click(function(){ 
        i++; 
        j++;
        k++;
        if (i > indexImg) {
            i = 0;
        }
        if (k > indexImg) {
            k = 0;
        }
        if (j > indexImg) {
            j = 0;
        }
        
        $img.css('display', 'none'); 
        //$prevImg = $img.eq(k); 
        //$prevImg.css('display', 'block');
        $currentImg = $img.eq(i); 
        $currentImg.css('display', 'block');
        //$nextImg = $img.eq(j); 
        //$nextImg.css('display', 'block');
    });

    $('#prev').click(function(){ // image précédente
        i--;
        k--;
        j--;
        if (i < 0) {
            i = indexImg;
        }
        if (k < 0) {
            k = indexImg;
        }
        if (j < 0) {
            j = indexImg;
        }
        
        $img.css('display', 'none');
        //$prevImg = $img.eq(k); 
        //$prevImg.css('display', 'block');
        $currentImg = $img.eq(i); 
        $currentImg.css('display', 'block');
        //$nextImg = $img.eq(j); 
        //$nextImg.css('display', 'block');
    });

    $("#exit").click(function () { 
                var exit = confirm("Voulez-vous vraiment mettre fin à la session ?"); 
                if (exit == true) { 
                    window.location = "accueil.php?logout=true"; 
                } 
            });

    function slideImg(){
        setTimeout(function(){ 
            i++; 
            j++;
            k++;
            if (i > indexImg) {
                i = 0;
            }
            if (k > indexImg) {
                k = 0;
            }
            if (j > indexImg) {
                j = 0;
            }
            $img.css('display', 'none');
            //$prevImg = $img.eq(k); 
            //$prevImg.css('display', 'block');
            $currentImg = $img.eq(i); 
            $currentImg.css('display', 'block');
            //$nextImg = $img.eq(j); 
            //$nextImg.css('display', 'block');
            slideImg(); 
        }, 1000); 
    } 

    slideImg();   
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
                <a href="accueil.php" class="action-button animate green">Accueil</a>
                <a href="monreseau.php" class="action-button animate blue">Réseau</a>
                <a href="vous.php" class="action-button animate blue">Vous</a>
                <a href="notification.php" class="action-button animate blue">Notification</a>
                <a href="messagerie.php" class="action-button animate blue">Messagerie</a>
                <a href="emploi.php" class="action-button animate blue">Emploi</a>
            </div>

        </div>
        

        <div class="leftcolumn" id="carrousel">

            
                <ul>
                    <li><img src="images/france1.jpg" width="100" height="100" /></li>
                    <li><img src="images/france2.jpg" width="100" height="100" /></li>
                    <li><img src="images/france3.jpg" width="100" height="100" /></li>
                    <li><img src="images/france4.jpg" width="100" height="100" /></li>
                    <li><img src="images/france5.jpg" width="100" height="100" /></li>
                    <li><img src="images/france6.jpg" width="100" height="100" /></li>
                    <li><img src="images/france7.jpg" width="100" height="100" /></li>
                </ul>
                <input type="button" id="prev" value="Précédent" onclick="change_color1()">
                <input type="button" id="next" value="Suivant" onclick="change_color1()">
            
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
        
       <div  id="map">
        
            <a href="https://www.google.com/maps/place/6+Rue+Sextius+Michel,+75015+Paris/@48.8533916,2.2818063,15z/data=!4m6!3m5!1s0x47e6701b461cfb0b:0x826182e3c9eae061!8m2!3d48.85132!4d2.2886082!16s%2Fg%2F11tgf3tdc9?entry=ttu" target="_blank">
            <img src="map.jpg" alt="map" height="90px" width="190px">
            </a>
        
        </div>

        
        </div>
    </div>
    
<div class="fond-second-plan">

</div>


</body>

</html>
<?php  
}
?>
