<?php
    include_once "../../Outils/Biblio.php";
    $connexion = connexion();

    $immatriculation = $_POST['immatriculation'];

    $req_suppr_vehicule = "DELETE FROM voitures WHERE immatriculation = '" . $immatriculation . "'";
    $req_suppr_vehicule_res = mysqli_query($connexion, $req_suppr_vehicule);


    if ($req_suppr_vehicule_res) {
        session_start();
        $_SESSION['suppr_vehicule'] = true;
        header('LOCATION: ../Administration/Admin_accueil.php');
        exit();
    } else {
        echo "bug";
    }
?>