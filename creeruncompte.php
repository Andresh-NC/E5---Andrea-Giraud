<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['adresse_email']);
    $password = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
    $role = 'clients'; // ou 'garagiste' selon le contexte

    // Vérifier si l'email existe déjà
    $stmt = $pdo->prepare("SELECT * FROM clients WHERE adresse_mail = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        echo "Cet email est déjà utilisé.";
    } else {
        // Insérer les informations dans la base de données
        $stmt = $pdo->prepare("INSERT INTO clients (nom, prenom, adresse_email, mdp) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$nom, $prenom, $adresse_email, $mdp, $role])) {
            echo "Inscription réussie. <a href='bienvenu2.php'>Connectez-vous ici</a>.";
        } else {
            echo "Erreur lors de l'inscription.";
        }
    }
}
?>