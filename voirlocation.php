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

// Requête pour récupérer toutes les locations
$sql = "SELECT * FROM locations";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$locations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voir les Locations</title>
    <link rel="stylesheet" href="voirlocation.css">
</head>
<body>
<header>
        <div class=menutoggle onclick="toggleMenu();">
        </div>
        <ul class="navbar">
            <li><a href="ajouter_vehicule.html" class="btn-reser" onclick="toggleMenu();">Ajouter un véhicule</a></li>
            <li><a href="supprimer_vehicule.html" class="btn-reser" onclick="toggleMenu();">Supprimer un véhicule</a></li>
            <li><a href="modifier_vehicule.php" class="btn-reser" onclick="toggleMenu();">Modifier un véhicule</a></li>
            <li><a href="rechercher_vehicule.html" class="btn-reser" onclick="toggleMenu();">Rechercher un véhicule</a></li>
        </ul>
    </header>

    <section>
        <h1>Historique des Locations</h1>
        <?php if (!empty($locations)): ?>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID Location</th>
                        <th>Nom du Client</th>
                        <th>Prénom du Client</th>
                        <th>Date de Début</th>
                        <th>Date de Fin</th>
                        <th>Immatriculation</th>
                        <th>Marque</th>
                        <th>Modèle</th>
                        <th>Nombre de Jours</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($locations as $location): ?>
                        <tr>
                            <td><?= htmlspecialchars($location['ID_location']) ?></td>
                            <td><?= htmlspecialchars($location['nom_client']) ?></td>
                            <td><?= htmlspecialchars($location['prenom_client']) ?></td>
                            <td><?= htmlspecialchars($location['date_debut_location']) ?></td>
                            <td><?= htmlspecialchars($location['date_fin_location']) ?></td>
                            <td><?= htmlspecialchars($location['immatriculation']) ?></td>
                            <td><?= htmlspecialchars($location['marque']) ?></td>
                            <td><?= htmlspecialchars($location['modele']) ?></td>
                            <td><?= htmlspecialchars($location['nombre_jours_location']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucune location trouvée.</p>
        <?php endif; ?>
    </section>
</body>
</html>
