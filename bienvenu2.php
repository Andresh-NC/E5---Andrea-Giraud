<?php
    session_start();
    // Vérifier si l'utilisateur est connecté, sinon le rediriger vers la page de connexion
    if(!isset($_SESSION['email'])){
        header("Location: creercompte.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
</head>
<body>
    <h1>Bienvenue sur votre espace, <?php echo $_SESSION['email']; ?></h1>
    <p>Vous êtes maintenant connecté à votre espace.</p>
    <p>Vous pouvez modifier votre mot de passe une fois connecté.</p>
    <a href="Accueil.html">Se déconnecter</a>
</body>
</html>
