<?php
// Connexion à la base de données
$host = 'localhost';
$db = 'garagesio';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérification de la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom_client = htmlspecialchars($_POST['nom_client']);
    $prenom_client = htmlspecialchars($_POST['prenom_client']);
    $date_debut_location = htmlspecialchars($_POST['date_debut_location']);
    $date_fin_location = htmlspecialchars($_POST['date_fin_location']);
    $immatriculation = htmlspecialchars($_POST['immatriculation']);
    $marque = htmlspecialchars($_POST['marque']);
    $modele = htmlspecialchars($_POST['modele']);

    // Requête pour insérer la nouvelle location dans la base de données
    $sql = "INSERT INTO locations (nom_client, prenom_client, date_debut_location, date_fin_location, immatriculation, marque, modele)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom_client, $prenom_client, $date_debut_location, $date_fin_location, $immatriculation, $marque, $modele]);

    echo "<p>La location a été enregistrée avec succès.</p>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Location de Véhicule</title>
    <link rel="stylesheet" href="location_form.css">
</head>
<body>
    <div class="location-form">
        <h1>Location de Véhicule</h1>
        <form method="post" action="">
            <label for="nom_client">Nom du client :</label>
            <input type="text" id="nom_client" name="nom_client" required>

            <label for="prenom_client">Prénom du client :</label>
            <input type="text" id="prenom_client" name="prenom_client" required>

            <label for="date_debut_location">Date de début de location :</label>
            <input type="date" id="date_debut_location" name="date_debut_location" required>

            <label for="date_fin_location">Date de fin de location :</label>
            <input type="date" id="date_fin_location" name="date_fin_location" required>

            <label for="immatriculation">Immatriculation :</label>
            <input type="text" id="immatriculation" name="immatriculation" required>

            <label for="marque">Marque :</label>
            <input type="text" id="marque" name="marque" required>

            <label for="modele">Catégorie :</label>
            <input type="text" id="modele" name="modele" required>

            <button type="submit">Enregistrer la location</button>
        </form>
    </div>
</body>
</html>
