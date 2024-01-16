<?php

include_once "../../Outils/Biblio.php";
$connexion = connexion();


$selectedMarque = $_GET["marque"];

$req_modeles = "SELECT * FROM modeles WHERE id_marque = " . $selectedMarque;
$req_modeles_res = mysqli_query($connexion, $req_modeles);

$modeles = array();

while ($ligne_modele = mysqli_fetch_array($req_modeles_res)) {
    $modele = array(
        "id_modele" => $ligne_modele["id_modele"],
        "modele" => $ligne_modele["modele"]
    );
    array_push($modeles, $modele);
}

// Renvoyer les modèles sous forme de JSON
echo json_encode($modeles);
?>
