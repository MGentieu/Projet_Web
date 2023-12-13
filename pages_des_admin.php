<?php  
session_start();
$message="Bonjour ".$_SESSION['prenom_admin']." ".$_SESSION['nom_admin']."<br>";
$message.="Voici la liste des utilisateurs:<br>";
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
//$message="";
$database = 'ECE_IN';
$mysqli = new mysqli($serveur, $user, $password, $database, $port);

if ($mysqli->connect_error) {
    echo "Erreur de connexion à la base de données.<br>";
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
else{
	$auteurs=$mysqli->query("select * from auteur A join correspondance_pseudo_email C on A.email_auteur=C.email_auteur ");
	if($auteurs->num_rows>0){
		$message.="<table border='1'>";
		while($row=$auteurs->fetch_assoc()){
			if($row['est_dans_le_reseau']==1){
				$message.="<tr id='ligne_verte' bgColor='#55FF55'>";
				$message.="<td width='20%'>".$row['pseudo']."</td>";
				$message.="<td width='30%'>".$row['email_auteur']."</td>";
				$message.="<td width='19%'>".$row['nom']."</td>";
				$message.="<td width='19%'>".$row['prenom']."</td>";
				$message.="<td width='12%'><button type='submit' name='ajout_auteur' value='".$row['email_auteur']."'>Supprimer du réseau"."</td></tr>";
				$message.="</tr>";
			}	
			else{
				$message.="<tr id='ligne_rouge' bgColor='#BB1212'>";
				$message.="<td>".$row['pseudo']."</td>";
				$message.="<td>".$row['email_auteur']."</td>";
				$message.="<td>".$row['nom']."</td>";
				$message.="<td>".$row['prenom']."</td>";

				$message.="<td><button type='submit' name='suppr_auteur' value='".$row['email_auteur']."'>Ajouter au réseau"."</td></tr>";
				$message.="</tr>";
			}
		}
		$message.="</table>";
	}
	else{
		$message.="Il n'y a aucun utilisateur enregistré dans la base.<br>";
	}
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page des admins</title>
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
        
        <div class="admins" id="liste_auteurs">
        	<p><center>
        	<?php 
				echo $message;
			?>
			</center></p>
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