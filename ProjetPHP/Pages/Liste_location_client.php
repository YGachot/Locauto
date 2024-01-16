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
    <title>Mes locations</title>
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

    <div class="meslocations">
    <?php
    $id_client = $_SESSION['id_client'];
    $req_location = "SELECT louer.*, voitures.*, ville_garage_depart.ville AS ville_depart, ville_garage_arrivee.ville AS ville_arrivee, modeles.*, marque.*
    FROM louer
    JOIN voitures ON louer.immatriculation = voitures.immatriculation
    JOIN ville_garage AS ville_garage_depart ON louer.id_lieu_depart = ville_garage_depart.id_lieu
    JOIN ville_garage AS ville_garage_arrivee ON louer.id_lieu_arrivee = ville_garage_arrivee.id_lieu
    JOIN modeles USING(id_modele)
    JOIN marque USING(id_marque)
    WHERE louer.id_client = $id_client";
    $req_res = mysqli_query($connexion, $req_location);
    $a = 1;
    while ($ligne = mysqli_fetch_array($req_res)) {
        echo "<span id='location_" .$a. "'> " . $a . ". Location de " . $ligne['marque'] . " " . $ligne['modele'] . " du " . $ligne['date_depart'] . " au " . $ligne['date_arrivee'] . " de " . $ligne['ville_depart'] . " à " . $ligne['ville_arrivee']. ". <br>Immatriculation: " . $ligne['immatriculation'] ."</span>";
        echo "<br>";
        $a = $a + 1;
        $id_louer = $ligne['id_louer'];
        $date_recherche_arrivee = $ligne['date_arrivee'];
        $date_recherche_depart = $ligne['date_depart'];
        $req_optn = "SELECT choix_option.* , options.*
        FROM choix_option
        JOIN options ON choix_option.id_options = options.id_options
        WHERE id_louer = ' $id_louer '";
        $req_optn_res = mysqli_query($connexion,$req_optn);
        ?>
            <span> Les options choisis sont :
            <?php
            while ($ligne_optn = mysqli_fetch_array($req_optn_res)) {
                echo "<br>";
                echo "<span> " . $ligne_optn['options'] . " </span>";
            }
            ?>
            </span>
            <?php
            $date = date('Y-m-d');
            if (strtotime($date_recherche_arrivee) <= strtotime($date)) {
                $status = 'Terminée';
            }
            elseif (strtotime($date_recherche_depart) > strtotime($date)) {
                $status = 'Pas encore commencée';
            }
            else {
                $status = 'En cours';
            }
            ?>
            <br>
            <span>Statut de la location : <?php echo $status ?></span>
            <br>
            <br>
        <?php
    }
    ?>
    <script src="Accueil_connecte.js"></script>
    </div>
</body>
</html>