<?php
session_start();

$m3="";


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
                            
                            
                            $mysqli->close();
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
                        $mysqli->close();
                        header("Location: accueil.php");                       
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
    else{

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


            //Post de l'auteur
            $sql="SELECT * FROM `photo` WHERE email_auteur='$myEmail' ORDER BY RAND() LIMIT 1";
            $postAuteur=$mysqli->query($sql);
            if($postAuteur->num_rows>0){

                $row=$postAuteur->fetch_assoc();
                $reacid=$row['id_photo'];
                $sql="SELECT SUM(reac_positive) FROM `reaction_photo` WHERE id_photo=$reacid";
                $reaction=$mysqli->query($sql);
                $valCookie1=0;
                if($reaction->num_rows>0){
                    $ligneReac=$reaction->fetch_assoc();
                    $valCookie1=$ligneReac['SUM(reac_positive)'];
                }
                setcookie("post1",$valCookie1,time()+3600,"/");
                $sql = "SELECT * FROM `reaction_photo` R WHERE R.id_photo = '" . $row['id_photo'] . "' AND R.email_auteur = '$myEmail'";
                $_SESSION['id_postAuteur1']=$reacid;
                
                $like=0;
                $dislike=0;
                $reaction=$mysqli->query($sql);
                if($reaction->num_rows>0){
                    $ligneReac=$reaction->fetch_assoc();
                    $like=($ligneReac['reac_positive']==1)?1:0;
                    $dislike=($ligneReac['reac_positive']==-1)?1:0;
                }
                //$_SESSION['post1like']=$like;
                //$_SESSION['post1like']=$like;
                $m3.='<div class="col-sm-6"> 
                    <div class="thumbnail"> 
                        <a href="'.$row['url'].'" target="_blank"> 
                            <img src="'.$row['url'].'" alt="'.$row['alt'].'" style="width:50%"> 
                            <div class="caption"> 
                                <p>'.$row['texte_post'].'</p> 
                            </div> 
                        </a> 
                    </div>';
                    
                $m3.="<button id='1".$row['id_photo'].$row['email_auteur']."' type='button' name=".$row['id_photo']." value=".$like." onclick=jaime(this) ";
                if($like==1){
                    $m3.="style='background-color:blue;'";
                }
                $m3.=">Like</button>";
                $m3.="<button id='2".$row['id_photo'].$row['email_auteur']."' type='button' name=".$row['id_photo']." value=".$dislike." onclick=jaimepas(this) ";
                if($dislike==1){
                    $m3.="style='background-color:blue;'";
                }
                $m3.=">Dislike</button>";
                    
                
                $m3.="<span style='border: 1px solid black; padding: 3px;' id=".$row['id_photo'].">".$_COOKIE['post1']."</span>";
                //$m3.="<span style='border: 1px solid black; padding: 3px;' id=".$row['id_photo'].">0</span>";   
                $m3.='</div>';
            }
            //Post d'un ami :
            $sql="SELECT * FROM `photo` P WHERE P.email_auteur in (SELECT AF.email_auteur FROM auteur AF WHERE AF.email_auteur in(SELECT DISTINCT A.email_auteur FROM auteur A WHERE A.email_auteur IN(SELECT A1.email_ami_1 FROM `amitie` A1 WHERE A1.email_ami_2='$myEmail') or A.email_auteur IN(SELECT A2.email_ami_2 FROM `amitie` A2 WHERE A2.email_ami_1='$myEmail'))) ORDER BY RAND() LIMIT 1";
            $postAmi=$mysqli->query($sql);
            if($postAmi->num_rows>0){
                
                $row=$postAmi->fetch_assoc();
                $reacid=$row['id_photo'];
                $sql="SELECT SUM(reac_positive) FROM `reaction_photo` WHERE id_photo=$reacid";
                $reaction=$mysqli->query($sql);
                $valCookie2=0;
                if($reaction->num_rows>0){
                    $ligneReac=$reaction->fetch_assoc();
                    $valCookie2=$ligneReac['SUM(reac_positive)'];
                }
                setcookie("post2",$valCookie2,time()+3600,"/");

                
                
                $sql = "SELECT * FROM `reaction_photo` R WHERE R.id_photo = '" . $row['id_photo'] . "' AND R.email_auteur = '$myEmail'";
                $_SESSION['id_postAmi1']=$row['id_photo'];
                $like=0;
                $dislike=0;
                $reaction=$mysqli->query($sql);
                if($reaction->num_rows>0){
                    $ligneReac=$reaction->fetch_assoc();
                    $like=($ligneReac['reac_positive']==1)?1:0;
                    $dislike=($ligneReac['reac_positive']==-1)?1:0;
                }
                $m3.='<div class="col-sm-6"> 
                    <div class="thumbnail"> 
                        <a href="'.$row['url'].'" target="_blank"> 
                            <img src="'.$row['url'].'" alt="'.$row['alt'].'" style="width:50%"> 
                            <div class="caption"> 
                                <p>'.$row['texte_post'].'</p> 
                            </div> 
                        </a> 
                    </div>'; 
                $m3.="<button id='1".$row['id_photo'].$row['email_auteur']."' type='button' name=".$row['id_photo']." value=".$like." onclick=jaime(this) ";
                if($like==1){
                    $m3.="style='background-color:blue;'";
                }
                $m3.=">Like</button>";
                    
                $m3.="<button id='2".$row['id_photo'].$row['email_auteur']."' type='button' name=".$row['id_photo']." value=".$dislike." onclick=jaimepas(this) ";
                if($dislike==1){
                    $m3.="style='background-color:blue;'";
                }
                $m3.=">Dislike</button>";
                $m3.="<span style='border: 1px solid black; padding: 3px;' id=".$row['id_photo'].">".$_COOKIE['post2']."</span>";
                //$m3.="<span style='border: 1px solid black; padding: 3px;' id=".$row['id_photo'].">0</span>"; 
                $m3.='</div>';
            }
        }
        ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accueil</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <link href="ecein.css" rel="stylesheet" type="text/css" />
    <!-- Bibliothèque jQuery --> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js">
        
    </script> <!-- Dernier JavaScript compilé --> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
        function getCookie(valeur){
            if(valeur==1){
                //el.innerHTML=span_value;
                return "post1";
            }
            if(valeur==2){
                //el.innerHTML=span_value;
                return "post2";
            }
        }
        function jaime(el){
            var id=el.id;
            var val=el.value;
            
            var span_id=el.name;
            var span_el=document.getElementById(el.name);
            var span_value = parseInt(span_el.innerHTML);
            var cookie_name=getCookie(span_id);
            
            if(val==0||val=='0'){
                    el.value=1;
                    
                    span_value++;
                    var new_id="2"+id.substring(1);
                    var new_el= document.getElementById(new_id);
                    if(new_el.value==1){
                        new_el.value=0;
                        new_el.style.backgroundColor="white";
                        span_value++;
                    }
                    
                    el.style.backgroundColor="blue";
            }
            else{
                    el.value=0;
                    span_value--;
                    el.style.backgroundColor="white";
            }
            span_el.innerHTML=span_value;

            document.cookie = cookie_name+"="+span_value+"; expires=" + new Date(new Date().getTime() + 3600 * 1000).toUTCString() + "; path=/";

        }
        
        function jaimepas(el){
            var id=el.id;
            var val=el.value;
            var span_id=el.name;
            var span_el=document.getElementById(el.name);
            var span_value = parseInt(span_el.innerHTML);
            var cookie_name=getCookie(span_id);;
            if(val==0||val=='0'){
                    el.value=1;
                    el.style.backgroundColor="blue";
                    span_value--;
                    var new_id="1"+id.substring(1);
                    var new_el= document.getElementById(new_id);
                    if(new_el.value==1){
                        new_el.value=0;
                        new_el.style.backgroundColor="white";
                        span_value--;
                    }
                    
            }
            else{
                    el.value=0;
                    span_value++;
                    el.style.backgroundColor="white";
            }
            span_el.innerHTML=span_value;
            document.cookie = cookie_name+"="+span_value+"; expires=" + new Date(new Date().getTime() + 3600 * 1000).toUTCString() + "; path=/";
        }    

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
            <div id="myCarousel" class="carousel slide" data-ride="carousel"> 
            <!-- Indicators --> 
            <ol class="carousel-indicators"> 
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li> 
                <li data-target="#myCarousel" data-slide-to="1"></li> 
                <li data-target="#myCarousel" data-slide-to="2"></li> 
                <li data-target="#myCarousel" data-slide-to="3"></li> 
            </ol> 

            <!-- Wrapper pour les images --> 
            <div class="carousel-inner"> 
                <div class="item active"> 
                    <img src="images/salon.png" alt="Paris" style="width:250px; height:250px ;"> 
                    <div class="carousel-caption"> 
                        <h3>Salon des étudiants</h3> 
                        <p>Venez vous renseignez!</p> 
                    </div> 
                </div> 
                <div class="item">
                    <img src="images/diplome.png" style="width:250px; height:250px">
                    <div class="carousel-caption">
                        <h3>Diplômes</h3>
                        <p>La remise des diplomes</p>       
                    </div>
                </div>

                <div class="item">
                    <img src="images/rentree.png" style="width:250px; height:250px">
                    <div class="carousel-caption">
                        <h3>Rentrée scolaire</h3>
                        <p>amphi d'informations</p>     
                    </div>
                </div>

                <div class="item">
                    <img src="images/noel.png" style="width:250px; height:250px">
                    <div class="carousel-caption">
                        <h3>Noël</h3>
                        <p>Le repas de noël</p>        
                    </div>
                </div>
            </div>
            
        </div>
        <br>
        <h2>Évenements de l'année</h2>
        </div>
        

        <div class="rightcolumn" style="overflow:scroll;">
            <p>ECE In est une platforme de réseau social qui vous permet d'avoir accès aux informations importantes au sein de l'école. Vous pouvez également vous faire des amis et discuter avec eux en privé ou dans des conversations de groupe. Enfin, la platforme vous propose un panel d'offres d'emploi dans le domaine qui vous plaît, pour lesquelles vous pouvez candidater. 
                <br>
            </p>
            <div class="row">
                <?php  
                echo $m3;
                ?>
                
            </div>

            <div class="row"></div>
        </div>
        <div class="rightestcolumn">
           
            <p class="logout" style="text-align: center;"><br>
                <a id="exit" href="#" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px;background-color: #E74C3C; font-size: 2em;">Quitter</button></a>
            </p>
            <p style="text-align: center;"><br>
                <a id="publi_photo" href="#" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px; background-color: teal; font-size: 1em;">Publier une photo</button></a>
            </p>
            <p style="text-align: center;"><br>
                <a id="publi_video" href="#" style="color: #FFF;"><button type="button" class="btn btn-primary" style="width:180px; background-color: teal; font-size: 1em;">Publier une vidéo</button></a>
            </p>
            
        </div>

        <div id="footer">

             <strong align='center'> ECE In <br> 75015 Paris <br>
                <a href="mailto:scolarite@ece.fr">Contactez l'ECE</a></strong> 
    
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
