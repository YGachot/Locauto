<?php
include_once "../../Outils/Biblio.php";
$connexion = connexion();
session_start();

$client = $_SESSION['id_client'];
$immatriculation = $_POST['immatriculation'];
$compteur = $_POST['compteur'];
$categorie = $_POST['categorie'];
$lieu = $_POST['lieu'];
$marque = $_POST['marque'];
$modele = $_POST['modele'];
$etat = $_POST['etat'];

$existingImmatQuery = "SELECT COUNT(*) as count FROM voitures WHERE immatriculation = '$immatriculation'";
$existingImmatResult = mysqli_query($connexion, $existingImmatQuery);
$existingImmatRow = mysqli_fetch_assoc($existingImmatResult);
$immatCount = $existingImmatRow['count'];

if ($immatCount > 0) {
    echo "L'immatriculation est déjà utilisée. Veuillez en choisir une autre.";
} else {
    if(isset($_FILES['imageFile'])) {
        $file = $_FILES['imageFile'];
        if($file['error'] === UPLOAD_ERR_OK) {
            $fileName = $marque."-".$modele."-".$immatriculation.".jpg";
            $tmpFilePath = $file['tmp_name'];
            $destinationPath = '../images/' . $fileName;
            if(move_uploaded_file($tmpFilePath, $destinationPath)) {
                echo 'L\'image a été téléchargée avec succès.';
            } else {
                echo 'Une erreur est survenue lors du téléchargement de l\'image.';
            }
        } else {
            echo 'Une erreur est survenue lors du téléchargement de l\'image.';
        }
    }
    $req_insertion = 
    "INSERT INTO voitures (immatriculation, id_modele, images, compteur, id_categorie, id_lieu, id_etat, id_client) VALUES ('$immatriculation', '$modele', '$fileName', '$compteur', '$categorie', '$lieu', '$etat', '$client')";
    $go_req_insertion = mysqli_query($connexion,$req_insertion);
    if ($go_req_insertion) {
        echo "Nouvelle voiture ajoutée avec succès.";
        session_start();
        $_SESSION['Insertion_voiture'] = true;
        if ($_GET['admin'] == 1) {
            header('Location:../Administration/Insertion/Vehicule.php');
            exit();
        } else {
            header('Location:../Faire_louer.php');
            exit(); 
        }
    } else {
        echo "Erreur lors de l'ajout de la voiture : " . mysqli_error($connexion);
    }
}