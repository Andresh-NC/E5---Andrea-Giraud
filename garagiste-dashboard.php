<?php
//Démarrage de la session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace garagiste</title>
    <link rel="stylesheet" href="garagiste_dashboard.css">
</head>

<header>
    <h2>Bienvenue dans l'espace garagiste</h2>
</header>

<body>
<div class="button-section">
<button onclick="window.location.href='ajouter_vehicule.html'">Ajouter un Véhicule</button>
<button onclick="window.location.href='supprimer_vehicule.html'">Supprimer un véhicule</button>
<button onclick="window.location.href='modifier_vehicule.php'">Modifier un véhicule</button>
<button onclick="window.location.href='rechercher_vehicule.html'">Rechercher un véhicule</button>
<button onclick="window.location.href='historique_rdv.html'">Consulter l'historique de location</button>

</div>
</body>
</html>