<?php
session_start();
$host = 'localhost';
$db = 'garagesio';
$user = 'root';
$pass = '';

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérification de la soumission du formulaire
if (isset($_POST['bouton-valider'])) {
    // Sécurisation des entrées utilisateur
    $email = htmlspecialchars($_POST['email']);
    $MDP = htmlspecialchars($_POST['mdp']);

    // Préparation de la requête SQL pour récupérer les informations de l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM garagistes WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($MDP,$email)) {
        $_SESSION['email'] = $email['email'];
        $_SESSION['MDP'] = $email['MDP'];
    }

        // Redirection vers la page de tableau de bord
        header("Location: garagiste-dashboard.php");
        exit();
    } else {
        // Message d'erreur en cas d'échec de la connexion
        $erreur = "Email ou mot de passe incorrect.";
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="connexion.css">
</head>
<body>
    <section>
        <h1>Connexion</h1>
        <?php 
            // Affichage du message d'erreur si défini
            if (isset($erreur)) {
                echo "<p class='Erreur'>" . $erreur . "</p>";
            }
        ?>
        <form action="" method="POST">
            <label for="email">Adresse Mail</label>
            <input type="email" name="email" required>
            <label for="mdp">Mot de Passe</label>
            <input type="password" name="mdp" required>
            <input type="submit" value="Valider" name="bouton-valider">
        </form>
    </section>
</body>
</html>
