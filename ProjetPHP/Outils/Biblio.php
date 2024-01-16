<?php
/* *************************************** *
* bibliothèque de fonctions PHP *
* *************************************** */
/* méthode générique de connexion à la BDD */
function connexion() {
    require_once "Access.php";
    // connexion persistante
    $connexion = mysqli_connect(SERVEUR, LOGIN, MDP, BD) ;
    return $connexion;
}
?>