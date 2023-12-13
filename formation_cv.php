<?php
// Pour demarer la session et les liées entre elles
session_start();
echo"<meta charset='utf-8'>";

// Déclaration des varibales
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
	// Regarde si les données essentiels sont bien saisis et si oui les ajoutes
	if($ecole!=""&&$diplome!=""&&$domaineDetudes!=""&&$dateDebut!=""&&$dateFin!=""&&$res!="")
	{
		// Insert dans la base de donnée ece_in et dans la relation formation ce qui à été remplis dans le formulaire 
	$sql = "INSERT INTO `formation`(`Ecole`, `Diplome`, `DomaineEtudes`, `DataDebut`, `DateFin`, `Resultat`) VALUES ('$ecole','$diplome','$domaineDetudes','$dateDebut','$dateFin','$res')";
	$result = mysqli_query($db_handle, $sql);
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
// Sinon rien
else
{
	
}

// ferme la connexion
	mysqli_close($db_handle)
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ajout d'une formation</title>
</head>
<body>
	<div id="test">
		<p>
			<center>
			<?php 
				echo $message;
				// Définie la base de donnée
				$db = "ece_in";

				// Définie la connexion à la base de donnée
				$db_handle = mysqli_connect('localhost','root',$password);

				// On va trouver la BD au bon endroit (serveur)à l'aide des deux variables definie précèdement et on le definie comme suit
				$db_found = mysqli_select_db($db_handle,$db);
				$sql = "SELECT Ecole FROM formation WHERE Ecole LIKE '%CIV%'";
				$result = mysqli_query($db_handle, $sql);
				$data = mysqli_fetch_assoc($result);
			    echo "École : " . $data['Ecole'] . "<br>";
			?>
			</center>
		</p>
	</div>

</body>
</html>

<!--dans le html page vous.php dans un div mettre message echo pour afficher le messager appender dans le code php-->


<!--

if($ecole==""||$diplome==""||$domaineDetudes==""||$dateDebut==""||$dateFin==""||$res=="")
{
	$valid_form=false;
}
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

if($valid_form)
{
		if($db_found)
		{
			$sql = "INSERT INTO `formation`(`Ecole`, `Diplome`, `DomaineEtudes`, `DataDebut`, `DateFin`, `Resultat`) VALUES ('$ecole','$diplome','$domaineDetudes','$dateDebut ','$dateFin','$res')";
			$result = mysqli_query($db_handle, $sql);
		                // Vérifiez si la requete a réussi
			ici on va quitter la page formation_cv.php et revenir ecire dans vous.php en html p
			$message.="On a rajouté une formation.<br>";
		}
		else
		{
			$message.="Erreur lors de la connexion à la BDD.<br>";
		}
}
-->

