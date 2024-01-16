<?php
include_once "../../Outils/Biblio.php";
$connexion = connexion();

$date_depart = $_POST['date_depart'];
$date_arrivee = $_POST['date_arrivee'];
$compteur_debut = $_POST['compteur_debut'];
$immatriculation = $_POST['immatriculation'];
$id_client = $_POST['id_client'];
$id_lieu_depart = $_POST['id_lieu_depart'];
$id_lieu_arrivee = $_POST['id_lieu_arrivee'];
$option_1 = $_POST['option_1'];
$option_2 = $_POST['option_2'];
$option_3 = $_POST['option_3'];


$sql = "INSERT INTO louer (date_depart, date_arrivee, compteur_debut, compteur_fin, immatriculation, id_client, id_lieu_depart, id_lieu_arrivee) VALUES ('$date_depart', '$date_arrivee', '$compteur_debut', '0', '$immatriculation', '$id_client', '$id_lieu_depart', '$id_lieu_arrivee')";
$result = mysqli_query($connexion, $sql);

$sql_id_louer = "SELECT id_louer FROM louer WHERE id_client = " . $id_client . " AND immatriculation = '" . $immatriculation . "' AND date_depart = '" . $date_depart . "'";
$sql_id_louer_res = mysqli_query($connexion,$sql_id_louer);

while ($row = mysqli_fetch_array($sql_id_louer_res)) {
    $id_louer = $row['id_louer'];}


if ($option_1 == 1) {
    // Insertion des valeurs dans la table choix_option
    $sql_insert_option_1 = "INSERT INTO choix_option (id_louer, id_options) VALUES ('$id_louer' , '$option_1')";
    $result_insert_option_1 = mysqli_query($connexion, $sql_insert_option_1);
    if (!$result_insert_option_1) {
        echo "Erreur lors de l'insertion de l'option : " . mysqli_error($connexion);
    }
}

if ($option_2 == 2) {
    // Insertion des valeurs dans la table choix_option
    $sql_insert_option_2 = "INSERT INTO choix_option (id_louer, id_options) VALUES ('$id_louer' , '$option_2')";
    $result_insert_option_2 = mysqli_query($connexion, $sql_insert_option_2);
    if (!$result_insert_option_2) {
        echo "Erreur lors de l'insertion de l'option : " . mysqli_error($connexion);
    }
}

if ($option_3 == 3) {
    // Insertion des valeurs dans la table choix_option
    $sql_insert_option_3 = "INSERT INTO choix_option (id_louer, id_options) VALUES ('$id_louer' , '$option_3')";
    $result_insert_option_3 = mysqli_query($connexion, $sql_insert_option_3);
    if (!$result_insert_option_3) {
        echo "Erreur lors de l'insertion de l'option : " . mysqli_error($connexion);
    }
}

if ($result) {
    session_start();
    $_SESSION['location_ajoutee'] = true;
    if ($_SESSION['admin'] == true) {
        $url = '../Administration/Insertion/Location.php';
        header('Location: ' .$url );   
        exit();
    } else {
        $url = '../Accueil_connecte.php';
        header('Location: ' .$url );   
        exit();
    }
} else {
    echo "Erreur lors de l'insertion : " . mysqli_error($connexion);
}

?>  