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

// Récupération des informations des véhicules
$sql = "SELECT v.Immatriculation, v.Date_premiere_mise_en_circulation, v.Prix, v.Nombre_chevaux, v.Description,
                m.Nom_marque, mo.Nom_modele, c.Nom_couleur
        FROM vehicule v
        LEFT JOIN marque m ON v.ID_marque = m.ID
        LEFT JOIN categorie mo ON v.ID_modele = mo.ID
        LEFT JOIN couleur c ON v.ID_couleur = c.ID";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$vehicules = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue des Véhicules</title>
    <link rel="stylesheet" href="catalogue.css">
</head>
<body>
    <section class="catalogue">
        <h1>Catalogue des Véhicules</h1>
        <div class="vehicules-container">
            <?php foreach ($vehicules as $vehicule): ?>
                <div class="vehicule-card">
                    <h2><?= htmlspecialchars($vehicule['Nom_marque']) . " " . htmlspecialchars($vehicule['Nom_modele']) ?></h2>
                    <p><strong>Immatriculation:</strong> <?= htmlspecialchars($vehicule['Immatriculation']) ?></p>
                    <p><strong>Date de mise en circulation:</strong> <?= htmlspecialchars($vehicule['Date_premiere_mise_en_circulation']) ?></p>
                    <p><strong>Couleur:</strong> <?= htmlspecialchars($vehicule['Nom_couleur']) ?></p>
                    <p><strong>Prix:</strong> <?= htmlspecialchars($vehicule['Prix']) ?> CFP</p>
                    <p><strong>Puissance:</strong> <?= htmlspecialchars($vehicule['Nombre_chevaux']) ?> CV</p>
                    <p><strong>Description:</strong> <?= htmlspecialchars($vehicule['Description']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</body>
</html>
