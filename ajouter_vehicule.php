<?php
session_start();

// Vérification si le formulaire a été soumis
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $Immatriculation = $_POST['Immatriculation'];
    $ID_marque = $_POST['ID_marque'];
    $ID_modele = $_POST['ID_modele'];
    $ID_couleur = $_POST['ID_couleur'];
    $Date_premiere_mise_en_circulation = $_POST['Date_premiere_mise_en_circulation'];
    $Prix = $_POST['Prix'];
    $Date_rentree_garage = $_POST['Date_rentree_garage'];
    $Nombre_chevaux = $_POST['Nombre_chevaux'];
    $Description = $_POST['Description'];

    // Connexion à la base de données
    $conn = mysqli_connect("localhost", "root", "", "garagesio");

    // Vérification de la connexion
    if(!$conn) {
        die("Erreur de connexion à la base de données : " . mysqli_connect_error());
    }

    // Requête SQL pour ajouter le véhicule
    $sql = "INSERT INTO vehicule (ID_modele, ID_couleur, Immatriculation, Date_premiere_mise_en_circulation, Prix, Date_rentree_garage, Nombre_chevaux, Description, ID_marque)
            VALUES ('$ID_modele', '$ID_couleur', '$Immatriculation', '$Date_premiere_mise_en_circulation', '$Prix', '$Date_rentree_garage', '$Nombre_chevaux', '$Description', '$ID_marque')";

   // Exécution de la requête SQL et affichage d'un pop-up
   if(mysqli_query($conn, $sql)) {
        echo "Véhicule ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout du véhicule : " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
