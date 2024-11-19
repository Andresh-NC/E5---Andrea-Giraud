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

// Récupération de la marque recherchée (si fournie)
$searchMarque = isset($_GET['search_marque']) ? $_GET['search_marque'] : '';

// Préparation de la requête SQL avec une clause WHERE facultative
$sql = "SELECT v.Immatriculation, v.Date_premiere_mise_en_circulation, v.Prix, v.Nombre_chevaux, v.Description,
                m.Nom_marque, mo.Nom_modele, c.Nom_couleur
        FROM vehicule v
        LEFT JOIN marque m ON v.ID_marque = m.ID
        LEFT JOIN categorie mo ON v.ID_modele = mo.ID
        LEFT JOIN couleur c ON v.ID_couleur = c.ID";

if (!empty($searchMarque)) {
    $sql .= " WHERE m.Nom_marque LIKE :searchMarque";
}

$stmt = $pdo->prepare($sql);

if (!empty($searchMarque)) {
    $stmt->bindValue(':searchMarque', '%' . $searchMarque . '%');
}

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
    <script>
        function redirectToLocationForm(immatriculation) {
            window.location.href = "location_form.php?immatriculation=" + immatriculation;
        }
    </script>
</head>
<body>
    <header>
        <div class="logo">
            <h1>Garage SIO</h1>
        </div>
        <nav>
            <ul>
                <li><a href="Accueil.html">Accueil</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="prix.html">Prix</a></li>
            </ul>
        </nav>
    </header>

    <!-- Formulaire de recherche -->
    <section class="search-bar">
        <form method="GET" action="catalogue.php">
            <input 
                type="text" 
                name="search_marque" 
                placeholder="Rechercher par marque" 
                value="<?= htmlspecialchars($searchMarque) ?>" 
            />
            <button type="submit">Rechercher</button>
        </form>
    </section>

    <section class="catalogue">
        <h1>Catalogue des Véhicules</h1>
        <div class="vehicules-container">
            <?php if (count($vehicules) > 0): ?>
                <?php foreach ($vehicules as $vehicule): ?>
                    <div class="vehicule-card" onclick="redirectToLocationForm('<?= htmlspecialchars($vehicule['Immatriculation']) ?>')">
                        <h2><?= htmlspecialchars($vehicule['Nom_marque']) ?></h2>
                        <p><strong>Catégorie:</strong> <?= htmlspecialchars($vehicule['Nom_modele']) ?></p>
                        <p><strong>Immatriculation:</strong> <?= htmlspecialchars($vehicule['Immatriculation']) ?></p>
                        <p><strong>Date de mise en circulation:</strong> <?= htmlspecialchars($vehicule['Date_premiere_mise_en_circulation']) ?></p>
                        <p><strong>Couleur:</strong> <?= htmlspecialchars($vehicule['Nom_couleur']) ?></p>
                        <p><strong>Prix:</strong> <?= htmlspecialchars($vehicule['Prix']) ?> CFP</p>
                        <p><strong>Puissance:</strong> <?= htmlspecialchars($vehicule['Nombre_chevaux']) ?> CV</p>
                        <p><strong>Description:</strong> <?= htmlspecialchars($vehicule['Description']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun véhicule trouvé pour la marque "<?= htmlspecialchars($searchMarque) ?>".</p>
            <?php endif; ?>
        </div>
    </section>
</body>
</html>
