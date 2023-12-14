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
	if ($TypeHebergement == "Economie") {
    $prix = (70 + 35 * ($NombreAdultes + $NombreEnfants - 1)) * ($DateDepart - $DateArrive);
    echo $prix;
}
// Calculer les coûts
   $prixAdulte = 100;
   $chargeAdulteSupplementaire = 75;
   $prixEnfant = 80;
   $chargeEnfantSupplementaire = 50;

   $coutTotal = $prixAdulte + ($NombreAdultes - 1) * $chargeAdulteSupplementaire +
                $prixEnfant + ($NombreEnfants - 1) * $chargeEnfantSupplementaire;

   // Afficher les coûts
   echo "Le coût total pour le logement est de : $coutTotal € par jour.";

   $coutPetitDejAdulte = 12.50;
   $coutPetitDejEnfant = 7.50;

   $coutTotalPetitDej = $coutPetitDejAdulte * $NombreAdultes + $coutPetitDejEnfant * $NombreEnfants;

   echo "Le coût total pour le petit déjeuner est de : $coutTotalPetitDej €.";

   $coutTotalFinal = $coutTotal + $coutTotalPetitDej;

   // Appliquer les rabais en fonction de la fidélité du client
   if ($Fid == "Fidelite") {
       // Rabais de 2.5% pour la fidélité
       $rabaisFidelite = 0.025 * $coutTotalFinal;
       $coutTotalFinal -= $rabaisFidelite;
       echo "Vous avez un rabais de fidélité de 2.5% : -$rabaisFidelite €.<br>";
   } elseif ($Fid == "VIP") {
       // Rabais de 8% pour les clients VIP
       $rabaisVIP = 0.08 * $coutTotalFinal;
       $coutTotalFinal -= $rabaisVIP;
       echo "Félicitations ! Vous avez un rabais VIP de 8% : -$rabaisVIP €.<br>";
   } else {
       echo "Vous êtes un client régulier sans rabais.<br>";
   }

   // Afficher le coût total final après les rabais
   echo "Le coût total de votre séjour est de : $coutTotalFinal € par jour.";
}





?>