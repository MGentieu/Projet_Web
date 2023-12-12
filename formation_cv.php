<?php
//Pour demarer la session
session_start();
echo"<meta charset='utf-8'>";
?>

<<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<?php

$ecole = isset($_POST["ecole"])?$_POST["ecole"]:"";
$diplome = isset($_POST["diplome"])?$_POST["diplome"]:"";
$domaineDetudes= isset($_POST["domaineDetudes"])?$_POST["domaineDetudes"]:"";
$dateDebut = isset($_POST["dateDebut"])?$_POST["dateDebut"]:"";
$dateFin = isset($_POST["dateFin"])?$_POST["dateFin"]:"";
$res = isset($_POST["res"])?$_POST["res"]:"";

// Définie la base de donnée
$db = "ece_in";
// Définie la connexion à la base de donnée
$db_handle = mysqli_connect('localhost','root','root');
// On va trouver la BD au bon endroit (serveur)à l'aide des deux variables definie précèdement et on le definie comme suit
$db_found = mysqli_select_db($db_handle,$db);
// Si on appuie sur le bouton ajouter on execute :
if(isset($_POST["ajoutformation"]))
{
		if($db_found)
		{
			$sql = "INSERT INTO `formation`(`Ecole`, `Diplome`, `DomaineEtudes`, `DataDebut`, `DateFin`, `Resultat`) VALUES ('$ecole','$diplome','$domaineDetudes','$dateDebut ','$dateFin','$res')";
			$result = mysqli_query($db_handle, $sql);
		                // Vérifiez si la requete a réussi
			/* ici on va quitter la page formation_cv.php et revenir ecire dans vous.php en html p*/

		}
		else
		{

		}

}
// ferme la connexion
	mysqli_close($db_handle)
?>

</body>
</html>

