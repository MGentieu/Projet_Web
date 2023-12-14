<?php  

$user = 'root';
$password = ''; 
$port = 3306; // Utiliser le port par défaut (par exemple, 3306 pour MySQL)
$valid_form = false;
$verif_email = false;
$verif_pseudo = false;
$message = "";
$database = 'unioneuropeenne';

$mysqli = new mysqli('5.7.36', $user, $password, $database, $port);

if ($mysqli->connect_error) {
    die("La connexion à la base de données a échoué : " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valider et nettoyer les données si nécessaire

    // Utilisation de requête préparée pour éviter l'injection SQL
    $sql = "INSERT INTO unioneuropeenne (country, id, capital, area, dateAdhesion, population, currency, gdp, unemployment, flag) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        // Liaison des paramètres
        $stmt->bind_param("ssssssssss", $country, $id, $capital, $area, $dateAdhesion, $population, $currency, $gdp, $unemployment, $flag);

        // Récupération des données du formulaire
        $country = $_POST["country"];
        $id = $_POST["id"];
        $capital = $_POST["capital"];
        $area = $_POST["area"];
        $dateAdhesion = $_POST["dateAdhesion"];
        $population = $_POST["population"];
        $currency = $_POST["currency"];
        $gdp = $_POST["gdp"];
        $unemployment = $_POST["unemployment"];
        $flag = $_POST["flag"];

        // Exécution de la requête préparée
        if ($stmt->execute()) {
            echo "Les données ont été insérées avec succès.";
        } else {
            echo "Erreur lors de l'insertion des données : " . $stmt->error;
        }

        // Fermeture du statement
        $stmt->close();
    } else {
        echo "Erreur de préparation de la requête : " . $mysqli->error;
    }
}

// Fermeture de la connexion à la base de données
$mysqli->close();

?>