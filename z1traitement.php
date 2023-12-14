<?php

session_start();
echo"<meta charset='utf-8'>";

// Si le bouton est appuyer faire:

if(isset($_POST["button1"]))

{
	// On récupère les valeurs saisis
	$message="";
	$Nom = isset($_POST["nom"])?$_POST["nom"]:"";
	$DateArrive = isset($_POST["DateArrive"])?$_POST["DateArrive"]:"";
	$DateDepart = isset($_POST["DateDepart"])?$_POST["DateDepart"]:"";
	$NombreAdultes = isset($_POST["nombreAdultes"])?$_POST["nombreAdultes"]:"";
	$NombreEnfants = isset($_POST["nombreEnfants"])?$_POST["nombreEnfants"]:"";
	$TypeHebergement = isset($_POST["Th"])?$_POST["Th"]:"";
	$PetitDej = isset($_POST["Pd"])?$_POST["Pd"]:"";
	$Fid = isset($_POST["F"])?$_POST["F"]:"";

	if($Nom=="")
	        {
	            $message.="Pas de Nom.<br>";
	        }
	if($DateArrive=="")
	        {
	            $message.="Pas de date d'arrivé.<br>";
	        }
	if($NombreAdultes=="")
	        {
	            $message.="Pas de Nombre d'adultes.<br>";
	        }
	if($NombreEnfants=="")
	        {
	            $message.="Pas de nombre d'enfants.<br>";
	        }
	if($TypeHebergement=="")
	        {
	            $message.="Pas de type d'hebergement.<br>";
	        }
	if($PetitDej=="")
	        {
	            $message.="Pas de petit déjeuner.<br>";
	        }
	if($Fid=="")
	        {
	            $message.="Pas de Fidélité.<br>";
	        }
	        echo $message;
	if(($DateDepart)<=($DateArrive))
	{
		echo "Date de depart avant la date d'arrivé revoyez vos dates ! <br>";
	}

}



?>