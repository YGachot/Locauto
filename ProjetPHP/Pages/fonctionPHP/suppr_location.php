<?php
    include_once "../../Outils/Biblio.php";
    $connexion = connexion();

    $id_louer = $_POST['id_louer'];

    $req_suppr_choix_options = "DELETE FROM choix_option WHERE id_louer = '" . $id_louer . "'";
    $req_suppr_choix_options_res = mysqli_query($connexion, $req_suppr_choix_options);


    $req_suppr_louer = "DELETE FROM louer WHERE id_louer = " . $id_louer;
    $req_suppr_louer_res = mysqli_query($connexion, $req_suppr_louer);

    if ($req_suppr_louer_res) {
        session_start();
        $_SESSION['suppr_locations'] = true ;
        header('LOCATION: ../Administration/Admin_accueil.php');
        exit();
    } else {
        echo "bug";
    }
?>