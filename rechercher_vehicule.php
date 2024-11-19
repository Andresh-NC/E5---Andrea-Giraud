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

// Initialisation de la requête SQL et gestion des paramètres
$sql = "SELECT v.*, m.Nom_marque, mo.Nom_modele, c.Nom_couleur
        FROM vehicule v
        LEFT JOIN marque m ON v.ID_marque = m.ID
        LEFT JOIN categorie mo ON v.ID_modele = mo.ID
        LEFT JOIN couleur c ON v.ID_couleur = c.ID";

// Ajoutez une clause WHERE si une recherche est effectuée
$params = [];
$whereConditions = [];

if (isset($_POST['rechercher'])) {
    // Recherche par immatriculation (si renseignée)
    if (!empty($_POST['immatriculation'])) {
        $immatriculation = htmlspecialchars($_POST['immatriculation']);
        $whereConditions[] = "v.Immatriculation = ?";
        $params[] = $immatriculation;
    }

    // Si des conditions de recherche sont ajoutées, on les intègre dans la requête
    if (count($whereConditions) > 0) {
        $sql .= " WHERE " . implode(" AND ", $whereConditions);
    }
}

// Préparation et exécution de la requête uniquement si une recherche a été effectuée
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de la Recherche</title>
    <link rel="stylesheet" href="rechercher_vehicule.css">
</head>
<body>
    <section>
        <h1>Résultats de la Recherche</h1>
        <?php if (!empty($results)): ?>
            <table border="1">
                <thead>
                    <tr>
                        <th>Immatriculation</th>
                        <th>Date de première mise en circulation</th>
                        <th>Prix</th>
                        <th>Nombre de chevaux</th>
                        <th>Description</th>
                        <th>Marque</th>
                        <th>Catégorie</th>
                        <th>Couleur</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $vehicule): ?>
                        <tr>
                            <td><?= htmlspecialchars($vehicule['Immatriculation']) ?></td>
                            <td><?= htmlspecialchars($vehicule['Date_premiere_mise_en_circulation']) ?></td>
                            <td><?= htmlspecialchars($vehicule['Prix']) ?> CFP</td>
                            <td><?= htmlspecialchars($vehicule['Nombre_chevaux']) ?></td>
                            <td><?= htmlspecialchars($vehicule['Description']) ?></td>
                            <td><?= htmlspecialchars($vehicule['Nom_marque']) ?></td>
                            <td><?= htmlspecialchars($vehicule['Nom_modele']) ?></td>
                            <td><?= htmlspecialchars($vehicule['Nom_couleur']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucun véhicule trouvé.</p>
        <?php endif; ?>
    </section>
</body>
</html>
