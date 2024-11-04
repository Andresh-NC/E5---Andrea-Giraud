<?php
    $conn = mysqli_connect("localhost","root","","garagesio");

    //Vérifier la connexion à la base de données
    if(!$conn) {
        die("Erreur de la connexion à la base de données : " . mysqli_connect_error())
    }

    //Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        //Récupérer les données du formulaire
        $Immatriculation = $_GET['Immatriculation'];
        $ID_marque = $_GET['ID_marque'];
        $ID_modele = $_GET['ID_modele'];
        $ID_couleur = $_GET['ID_couleur'];
        $Date_premiere_mise_en_circulation = $_GET['Date_premiere_mise_en_circulation'];
        $Prix = $_GET['Prix'];
        $Date_rentree_garage = $_GET['Date_rentree_garage'];
        $Nombre_chevaux = $_GET['Nombre_chevaux'];
        $Description = $_GET['Description'];

        $sql = "UPDATE vehicules SET ID_marque='$ID_marque', ID_modele='$ID_modele', ID_couleur='$ID_couleur', Date_premiere_mise_en_circulation='$Date_premiere_mise_en_circulation', Prix='$Prix', Date_rentree_garage='$Date_rentree_garage', Nombre_chevaux='$Nombre_chevaux', Description='$Description' WHERE Immatriculation='$Immatriculation'";

        if (mysqli_query($conn, $sql)) {
            echo "Vehicule modifier avec succes.";
        } else {
            echo "Erreur lors de la modification du véhicule : " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
?>