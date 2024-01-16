<?php
    include_once "../Outils/Biblio.php";
    $connexion = connexion();
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="Index_style.css" rel="stylesheet">
    <title>Liste de nos véhicules</title>
</head>
<body>
<div class="bande-stick">
    <div id="imglogo_container">
        <img id="imglogo" src="https://cdn.discordapp.com/attachments/1020008766479020033/1108003914403545160/logo_voiture.jpg">
    </div>
</div>
        <div id="menu_hamburger" class="menu_hamburger">
            <a href="#" id="close_button" class="close_button"><img id="imgbtnclsmh"src="https://cdn.discordapp.com/attachments/1020008766479020033/1107932479207252030/close_window_24px.png"/></a>
            <ul>
                <li><a href="Faire_louer.php" id="faire_louer"><img id="imggarage" src="https://cdn.discordapp.com/attachments/1020008766479020033/1107932500128444416/garage_24px.png"/><br>Faire louer mon véhicule</a></li>
                <li><a href="Carte.php" id="carte_garage"><img id="imglocation" src="https://cdn.discordapp.com/attachments/1020008766479020033/1107932523817873458/location_24px.png"/><br>Carte de nos garages</a></li>
                <li><a href="Liste_non_triee.php" id="liste_vehicule"><img id="imgvoiture" src="https://cdn.discordapp.com/attachments/1020008766479020033/1107932448202952764/car_24px.png"/><br>Liste de nos véhicules</a></li>
                <li><a href="A_propos_de_nous.php"><img id="imgaproposdenous" src="https://cdn.discordapp.com/attachments/1020008766479020033/1107943203350528040/people_24px.png"/><br>A propos de nous</a></li>
                <li><a href="nous_contacter.php"><img id="imgtelephone" src="https://cdn.discordapp.com/attachments/1020008766479020033/1107942744900501535/phone_24px.png"/><br>Nous contacter</a></li>
            </ul>
        </div>
        <div class="info_client">
            <nav>
                <ul>
                    <li>
                        <a href="" title="test"><?php echo $_SESSION['id_menu_droite'] ?></a>
                        <ul>
                            <li>
                                <form action="deconnexion.php">
                                    <a><input id="deconnexion" type="submit" value="Se deconnecter"></a>
                                </form>
                            </li>
                            <li>
                                <a href="Liste_location_client.php"><button id="btn_liste_location">Mes locations</button></a> 
                            </li>
                        </ul>
                    </li>    
                </ul>  
            </nav>        
        </div>
        <a href="#" id="open_menu_hamburger">
            <span class="open_menu_hamburger_btn">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </a>
    <?php

    $req = "SELECT voitures.*, marque.*, modeles.*
    FROM voitures
    JOIN modeles USING(id_modele)
    JOIN marque USING(id_marque)
    WHERE voitures.immatriculation NOT IN (
        SELECT immatriculation
        FROM louer
        WHERE (date_depart <= '".$_POST['date_depart']."' AND date_arrivee >= '".$_POST['date_arrivee']."')
           OR (date_arrivee >= '".$_POST['date_depart']."' AND date_depart <= '".$_POST['date_depart']."')
    )
    AND voitures.id_lieu = ".$_POST['lieu_depart'];

    if ($_POST['lieu_depart'] != $_POST['lieu_arrivee']) {
        $lieu_dif = 1;
    }
    else {
        $lieu_dif = 0;
    }
    echo '<div id="lieu-dif" data-lieu-dif="' . $lieu_dif . '"></div>';

    echo '<div id="id_lieu_depart" data-id_lieu_depart="' . $_POST['lieu_depart'] . '"></div>';
    echo '<div id="id_lieu_arrivee" data-id_lieu_arrivee="' . $_POST['lieu_arrivee'] . '"></div>';

    $date_depart = $_POST['date_depart'];
    echo '<div id="date_dep" data-date-dep="' . $date_depart .'"></div>';

    $date_arrivee = $_POST['date_arrivee'];
    echo '<div id="date_arr" data-date-arr="' . $date_arrivee .'"></div>';

    $resultat_liste_tri = mysqli_query($connexion, $req);
    ?>
    <div class = "liste_voiture_triee">
    <?php
    while ($ligne_tri_liste = mysqli_fetch_array($resultat_liste_tri)) {
        $immatriculation = str_replace(' ', '%', $ligne_tri_liste['immatriculation']);
        echo "<div class='voiture_triee' data-immatriculation='" . $immatriculation . "'>";
        echo "<br>";
        echo "<p class='content_liste_triee'>" . $ligne_tri_liste['immatriculation'] . "</p>";
        echo "<br>";
        echo "<p class='content_liste_triee'>" . $ligne_tri_liste['marque'] . "</p>";
        echo "<br>";        
        echo "<p class='content_liste_triee'>" . $ligne_tri_liste['modele'] . "</p>";
        echo "<br>";
        echo "<img class='content_liste_triee' src='images/" . $ligne_tri_liste['images'] . "'>";
        echo "</div>";
    }
    ?>
    </div>
    <script src="fonctionJS/Liste_triee.js"></script>
    <script src="Accueil_connecte.js"></script>
</body>
</html>