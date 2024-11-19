<?php
session_start();

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    header("Location: connexion.php");
    exit;
}

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") 
    // Récupération de l'immatriculation du formulaire
    if(isset($_POST['immatriculation'])) {
        $immatriculation = $_POST['immatriculation'];
*
    $conn = mysqli_connect("localhost", "root", "", "garagesio");

    // Vérification de la connexion
    if (!$conn) {
        die("Erreur de connexion à la base de données : " . mysqli_connect_error());
    }
 
    $sql = "SELECT * FROM vehicule WHERE immatriculation='$immatriculation'";

    // Exécution de la requête SQL
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Le véhicule a été trouvé, donc nous pouvons le supprimer
        $delete_query = "DELETE FROM vehicule WHERE immatriculation='$immatriculation'";
        if (mysqli_query($conn, $delete_query)) {
            echo "Véhicule supprimé avec succès.";
        } else {
            echo "Erreur lors de la suppression du véhicule : " . mysqli_error($conn);
        }
    } else {
        echo "Aucun véhicule trouvé avec cette immatriculation.";
    }

    mysqli_close($conn);
}
?>


