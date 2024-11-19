<?php
$conn = mysqli_connect("localhost", "root", "", "garagesio");

if (!$conn) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

// Demande de l'immatriculation du véhicule
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    // Récupérer l'immatriculation saisie
    $Immatriculation = $_POST['Immatriculation'];
    
    // Requête pour obtenir les informations du véhicule
    $sql = "SELECT * FROM vehicule WHERE Immatriculation = '$Immatriculation'";
    $result = mysqli_query($conn, $sql);

    // Vérifier si la requête a échoué
    if (!$result) {
        die("Erreur lors de l'exécution de la requête : " . mysqli_error($conn));
    }

    // Vérifier si le véhicule existe
    if (mysqli_num_rows($result) > 0) {
        $vehicule = mysqli_fetch_assoc($result);
    } else {
        echo "Aucun véhicule trouvé avec cette immatriculation.";
    }
}

// Mise à jour des informations du véhicule
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $Immatriculation = $_POST['Immatriculation'];
    $ID_marque = $_POST['ID_marque'];
    $ID_modele = $_POST['ID_modele'];
    $ID_couleur = $_POST['ID_couleur'];
    $Date_premiere_mise_en_circulation = $_POST['Date_premiere_mise_en_circulation'];
    $Prix = $_POST['Prix'];
    $Date_rentree_garage = $_POST['Date_rentree_garage'];
    $Nombre_chevaux = $_POST['Nombre_chevaux'];
    $Description = $_POST['Description'];

    // Requête de mise à jour
    $sql = "UPDATE vehicule SET ID_marque='$ID_marque', ID_modele='$ID_modele', ID_couleur='$ID_couleur', 
            Date_premiere_mise_en_circulation='$Date_premiere_mise_en_circulation', Prix='$Prix', 
            Date_rentree_garage='$Date_rentree_garage', Nombre_chevaux='$Nombre_chevaux', 
            Description='$Description' WHERE Immatriculation='$Immatriculation'";

    if (mysqli_query($conn, $sql)) {
        echo "Véhicule modifié avec succès.";
    } else {
        echo "Erreur lors de la modification du véhicule : " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un véhicule</title>
    <link rel="stylesheet" href="modifier_vehicule.css">
</head>
<body>
<header>
        <h1>Modifier les données d'un véhicule</h1>
        <div class=menutoggle onclick="toggleMenu();">
        </div>
        <ul class="navbar">
            <li><a href="ajouter_vehicule.html" class="btn-reser" onclick="toggleMenu();">Ajouter un véhicule</a></li>
            <li><a href="supprimer_vehicule.html" class="btn-reser" onclick="toggleMenu();">Supprimer un véhicule</a></li>
            <li><a href="rechercher_vehicule.html" class="btn-reser" onclick="toggleMenu();">Rechercher un véhicule</a></li>
            <li><a href="voirlocation.php" class="btn-reser" onclick="toggleMenu();">Historique de locations</a></li>
        </ul>
    </header>

    <!-- Formulaire pour saisir l'immatriculation -->
    <form method="post">
        <label for="Immatriculation">Immatriculation du véhicule :</label>
        <input type="text" id="Immatriculation" name="Immatriculation" required>
        <button type="submit" name="search">Rechercher</button>
    </form>

    <?php if (isset($vehicule)) : ?>
        <!-- Affichage du formulaire de modification avec les données actuelles -->
        <form method="post">
            <input type="hidden" name="Immatriculation" value="<?php echo $vehicule['Immatriculation']; ?>">
            
            <label for="ID_marque">Marque :</label>
            <input type="text" id="ID_marque" name="ID_marque" value="<?php echo $vehicule['ID_marque']; ?>" required><br><br>

            <label for="ID_modele">Catégorie :</label>
            <input type="text" id="ID_modele" name="ID_modele" value="<?php echo $vehicule['ID_modele']; ?>" required><br><br>

            <label for="ID_couleur">Couleur :</label>
            <input type="text" id="ID_couleur" name="ID_couleur" value="<?php echo $vehicule['ID_couleur']; ?>" required><br><br>

            <label for="Date_premiere_mise_en_circulation">Date de première mise en circulation :</label>
            <input type="date" id="Date_premiere_mise_en_circulation" name="Date_premiere_mise_en_circulation" value="<?php echo $vehicule['Date_premiere_mise_en_circulation']; ?>" required><br><br>

            <label for="Prix">Prix :</label>
            <input type="number" id="Prix" name="Prix" value="<?php echo $vehicule['Prix']; ?>" required><br><br>

            <label for="Date_rentree_garage">Date de rentrée en garage :</label>
            <input type="date" id="Date_rentree_garage" name="Date_rentree_garage" value="<?php echo $vehicule['Date_rentree_garage']; ?>" required><br><br>

            <label for="Nombre_chevaux">Nombre de chevaux :</label>
            <input type="number" id="Nombre_chevaux" name="Nombre_chevaux" value="<?php echo $vehicule['Nombre_chevaux']; ?>" required><br><br>

            <label for="Description">Description :</label>
            <textarea id="Description" name="Description" rows="4" required><?php echo $vehicule['Description']; ?></textarea><br><br>

            <button type="submit" name="update">Modifier</button>
        </form>
    <?php endif; ?>
</body>
</html>