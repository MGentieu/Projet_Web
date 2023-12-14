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

if (isset($_POST['enter_auteur'])){ 
    
    $email_pseudo=isset($_POST["ep"])? $_POST["ep"] : ""; 
    $mdp=isset($_POST["mdp"])? $_POST["mdp"] : "";

    if($email_pseudo=='r'&&$mdp=='r'){
        $_SESSION['ep']="Lambda";
        $password = isset($_POST["mdp_bdd"])? $_POST["mdp_bdd"] : "";
        $_SESSION['mdp_bdd']=$password;
        header("Location: accueil.php");
        $mysqli->close();
        exit();
    }
                
    $user = 'root';
    $serveur='localhost';
    $password = isset($_POST["mdp_bdd"])? $_POST["mdp_bdd"] : "";
    $_SESSION['mdp_bdd']=$password;
    //$password = 'root'; 
    $port = NULL; //Default must be NULL to use default port
    $valid_form=false;
    $verif_email=false;
    $verif_pseudo=false;
    //$verif_connexion=false;
    $message="";
    $database = 'ECE_IN';
    $mysqli = new mysqli($serveur, $user, $password, $database, $port);

    if ($mysqli->connect_error) {
        echo "Erreur de connexion à la base de données.<br>";
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }
    else{
        $email_pseudo=isset($_POST["ep"])? $_POST["ep"] : ""; 
        $mdp=isset($_POST["mdp"])? $_POST["mdp"] : ""; 
        
        echo '<p>Connection OK '. $mysqli->host_info.'</p>';
        echo '<p>Server '.$mysqli->server_info.'</p>';
        echo '<p>Initial charset: '.$mysqli->character_set_name().'</p>';

        if($email_pseudo==""||$mdp==""){
            $valid_form=false;
            $message.="Un des champs requis est vide.<br>";
            //echo $message;
        }
        else{
            $valid_form=true;   
        }
        if($email_pseudo==""){
            $message.="L'email ou le pseudo n'est pas indiqué.<br>";
        }
        if($mdp==""){
            $message.="Le mot de passe n'est pas indiqué.<br>";
        }
        
        if($valid_form){

            $result1=$mysqli->query("select email_auteur,est_dans_le_reseau from auteur where email_auteur='$email_pseudo'");
            $result2=$mysqli->query("select * from correspondance_pseudo_email where pseudo='$email_pseudo'");
            $verif_email=($result1->num_rows > 0)? true:false;
            $verif_pseudo=($result2->num_rows > 0)? true:false;
            if($verif_email||$verif_pseudo||$email_pseudo=='r'){
                
                
                if($verif_email){
                    $row1 = $result1->fetch_assoc();
                    $message.= "email " . $row1["email_auteur"]."<br>";
                    $passw=$mysqli->query("select mot_de_passe from auteur where email_auteur='$email_pseudo' and mot_de_passe='$mdp'");
                    if($passw->num_rows >0&&$row1['est_dans_le_reseau']==1){
                        $pseudo=$mysqli->query("select * from correspondance_pseudo_email where email_auteur='$email_pseudo'");
                        if($pseudo->num_rows > 0){
                            $mypseudo=$pseudo->fetch_assoc();
                            //$message.= "L'utilisateur est maintenant connecté! " ."<br>";

                            $_SESSION['ep']=$mypseudo['pseudo'];
                            $_SESSION['emailauteur']=$email_pseudo;
                            header("Location: accueil.php");
                            exit();
                        }
                        $message.= "L'utilisateur est maintenant connecté! " ."<br>";
                        session_start();
                        //$_SESSION['info'] = "Ceci est une information depuis PHP";
                        header("Location: accueil.php");
                        $mysqli->close();
                        exit();
                    }
                    else{
                        $message.= "Mauvais mot de passe! Ou l'utilisateur n'est pas dans le réseau." ."<br>";
                    }

                }
                
                if($verif_pseudo){
                    $row2 = $result2->fetch_assoc();
                    $message.="pseudo " . $row2["pseudo"]." - email " . $row2["email_auteur"]. "<br>";
                    $email_correspondant=$row2["email_auteur"];
                    $passw=$mysqli->query("select mot_de_passe,est_dans_le_reseau from auteur where email_auteur='$email_correspondant' and mot_de_passe='$mdp'");
                    if($passw->num_rows > 0){
                        $message.= "L'utilisateur est maintenant connecté! " ."<br>";
                        $row3=$passw->fetch_assoc();
                        if($row3['est_dans_le_reseau']==1){
                            $_SESSION['ep']=$row2['pseudo'];
                            $_SESSION['emailauteur']=$email_correspondant;
                                                //session_s]tart();
                        //$_SESSION['info'] = "Ceci est une information depuis PHP";
                        }
                        else{
                            $message.="L'utilisateur n'a pas le droit d'accéder au réseau.<br>";
                        }
                        
                        header("Location: accueil.php");
                        $mysqli->close();
                        exit();
                    }
                    else{
                        $message.= "Mauvais mot de passe! " ."<br>";
                    }
                }
                
                
                
                
            
            }
            else{
                $message.="Pseudo ou email non présent dans la base de données. <br>";
            }
             

        } 
        echo $message; 
    }

    $mysqli->close();
    

    
}

if (isset($_POST['enter_admin'])){ 
    $admin=(isset($_POST['em_admin']))?$_POST['em_admin']:"";
    $mdp=isset($_POST["mdp"])? $_POST["mdp"] : "";
    if($admin!=""&&$mdp!=""){ 
        //$_SESSION['ep'] = $_POST['ep']; 
        //$_SESSION['name'] = "Yolo";
        $user = 'root';
        $serveur='localhost';
        $password = isset($_POST["mdp_bdd"])? $_POST["mdp_bdd"] : "";
        $_SESSION['mdp_bdd']=$password;
        //$password = 'root'; 
        $port = NULL; //Default must be NULL to use default port
        //$valid_form=false;
        //$verif_email=false;
        //$verif_pseudo=false;
        //$verif_connexion=false;
        $message="";
        $database = 'ECE_IN';
        $mysqli = new mysqli($serveur, $user, $password, $database, $port);

        if ($mysqli->connect_error) {
            echo "Erreur de connexion à la base de données.<br>";
            die('Connect Error (' . $mysqli->connect_errno . ') '
                    . $mysqli->connect_error);
        }
        else{
            $match=$mysqli->query("select * from administrateur where email_admin='$admin' and mot_de_passe='$mdp'");
            if($match->num_rows>0){
                $row=$match->fetch_assoc();
                $_SESSION['prenom_admin']=$row['prenom'];
                $_SESSION['nom_admin']=$row['nom'];
                $_SESSION['mail_admin']=$row['email_admin'];
                header("Location: pages_des_admin.php");
                $mysqli->close();
                exit();
            }
            
        }
        
    } 
    $mysqli->close();
    header("Location: accueil.php");
    exit();      
}

function loginForm() { 
    
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
    <title>Accueil</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    
    <link href="ecein.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <style type="text/css">
        
        #footer {
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: lightcyan;
        }
        #map {  
            width: auto
            float: right;
            height: 90px;
            position: relative;
            background-color: lightcyan; 
}

         #carrousel {
        position: relative;
       align-items: center;
    }
        #carrousel ul{
    list-style: none;
}
    #carrousel ul li{
    position: absolute;
    top: 0;
    left: 0;
}   

    </style>

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
        }, 3000); 
    } 

    slideImg();   
});


    </script>


</head>
<body>
    
    
    <div class="wrapper">


        <div class="gauche" style="color: teal;">
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
                <a href="accueil.php" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px;background-color: #20B2AA;">Accueil</button></a> 
                <a href="monreseau.php" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px;background-color: #188385;">Mon réseau</button></a>
                <a href="vous.php" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px;background-color: #188385;">Vous</button></a>
                <a href="notification.php" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px;background-color: #188385;">Notification</button></a>
                <a href="messagerie.php" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px;background-color: #188385;">Messagerie</button></a>
                <a href="emploi.php" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px;background-color: #188385;">Emploi</button>
                </p></a>
            </div>

        </div>
        

        <div class="leftcolumn">
            <div id="carrousel">

            
                <ul>
                    <li><img src="images/france1.jpg" width="210" height="380" /></li>
                    <li><img src="images/france2.jpg" width="210" height="380" /></li>
                    <li><img src="images/france3.jpg" width="210" height="380" /></li>
                    <li><img src="images/france4.jpg" width="210" height="380" /></li>
                    <li><img src="images/france5.jpg" width="210" height="380" /></li>
                    <li><img src="images/france6.jpg" width="210" height="380" /></li>
                    <li><img src="images/france7.jpg" width="210" height="380" /></li>
                </ul>
                <input type="button" id="prev" value="Précédent">
                <input type="button" id="next" value="Suivant">
            
        </div>
        </div>
        

        <div class="rightcolumn" style="overflow:scroll;">
            <p>ECE In est une platforme de réseau social...
                <br>
            </p>
        </div>
        <div class="rightestcolumn">
           
            <p class="logout" style="text-align: center;"><br>
                <a id="exit" href="#" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px;background-color: #E74C3C; font-size: 2em;">Quitter</button></a>
            </p>
        </div>

        <div id="footer">

             <strong align='center'> ECE In <br> 75015 Paris </strong> 
    
        </div>
        
       <div  id="map">
        
            <a href="https://www.google.com/maps/place/6+Rue+Sextius+Michel,+75015+Paris/@48.8533916,2.2818063,15z/data=!4m6!3m5!1s0x47e6701b461cfb0b:0x826182e3c9eae061!8m2!3d48.85132!4d2.2886082!16s%2Fg%2F11tgf3tdc9?entry=ttu" target="_blank">
            <img src="map.jpg" alt="map" height="90px" width="190px" float="right">
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
