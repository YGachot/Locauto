<?php
    include_once "../../Outils/Biblio.php";
    $connexion = connexion();

    $id_client = $_POST['id_client'];
    // Supprimer les enregistrement des vehicules ajoutés par le client
    $req_suppr_voitures = "DELETE FROM voitures WHERE id_client = " . $id_client;
    $req_suppr_voitures_res = mysqli_query($connexion, $req_suppr_voitures);

    // Supprimer les enregistrements dans la table "louer" correspondanat aux locations du client
    $req_suppr_choix_options = "DELETE FROM choix_option WHERE id_louer IN (SELECT id_louer FROM louer WHERE id_client = " . $id_client. ")";
    $req_suppr_choix_options_res = mysqli_query($connexion, $req_suppr_choix_options);

    // Supprimer les enregistrements dans la table "louer" correspondant au client
    $req_suppr_louer = "DELETE FROM louer WHERE id_client = " . $id_client;
    $req_suppr_louer_res = mysqli_query($connexion, $req_suppr_louer);

    // Supprimer le client
    $req_suppr_client = "DELETE FROM clients WHERE id_client = " . $id_client;
    $req_suppr_client_res = mysqli_query($connexion, $req_suppr_client);

    if ($req_suppr_client_res) {
        session_start();
        $_SESSION['suppr_client'] = true;
        header('LOCATION:../Administration/Admin_accueil.php');
        exit();
    } else {
        echo "Une erreur s'est produite lors de la suppression du client.";
    }
?>
