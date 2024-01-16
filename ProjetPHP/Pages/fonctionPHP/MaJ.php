<?php
include_once "../../Outils/Biblio.php";
$connexion = connexion();
session_start();

$id_louer = $_POST['maj_louer']; 
$compteur = $_POST['compteur']; 


$req_id_lieu = "SELECT id_lieu_arrivee FROM louer WHERE id_louer = $id_louer";
$resultat_id_lieu = mysqli_query($connexion, $req_id_lieu);
$ligne_id_lieu = mysqli_fetch_array($resultat_id_lieu);
$id_lieu = $ligne_id_lieu['id_lieu_arrivee'];

$req_update_louer = "UPDATE louer SET compteur_fin = $compteur WHERE id_louer = $id_louer";
mysqli_query($connexion, $req_update_louer);

$req_update_voitures = "UPDATE voitures SET compteur = $compteur, id_lieu = $id_lieu WHERE immatriculation IN (SELECT immatriculation FROM louer WHERE id_louer = $id_louer)";
mysqli_query($connexion, $req_update_voitures);


if ($req_update_voitures) {
    $_SESSION['MaJ'] = true;
    header('Location:../Administration/Admin_accueil.php?lieu=' . $id_lieu . '&compteur=' . $compteur . '&id_louer=' . $id_louer);
    exit();
}
?>