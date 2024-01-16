<?php
    include_once "../Outils/Biblio.php";
    $connexion = connexion();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="Index_style.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Locauto | Accueil</title>
</head>
<body>
    <?php
    session_start();
    if (isset($_SESSION['location_ajoutee']) && $_SESSION['location_ajoutee']) {
        echo "<script>alert('Merci pour votre commande, la location a été ajoutée')</script>";
        $_SESSION['location_ajoutee'] = false;
    }
    $req_nom_prenom = "SELECT * FROM clients WHERE id_client = ".$_SESSION['id_client'];
    $resultat_nom_prenom = mysqli_query($connexion, $req_nom_prenom);
    $ligne_nom_prenom = mysqli_fetch_array($resultat_nom_prenom);
    $nom = $ligne_nom_prenom['nom'];
    $prenom = $ligne_nom_prenom['prenom'];

    $_SESSION['id_menu_droite'] = $nom. " " .$prenom ; 
    ?>
    <div class="Corps_page">
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
        <div class="container_option_location">
            <h1>Accueil</h1>
            <form action="Liste_triee.php" method="post" onsubmit="return verif_date()">
                <div class="gauche_droite">
                    <div class="gauche">
                        <div id="lieu_depart" class="content_location">
                            <p>Lieu de départ:</p>
                            <select name="lieu_depart" id="lieu_depart" required>
                                <option value="" hidden selected>Choisissez votre lieu de départ</option>
                                <?php
                                    $req_lieu = "SELECT ville FROM ville_garage";
                                    $res_req_lieu = mysqli_query($connexion, $req_lieu);
                                    $a = 1;
                                    while ($ligne_req_lieu = mysqli_fetch_array($res_req_lieu)) {
                                        echo '<option value="' . $a . '"> ' . $ligne_req_lieu['ville'] . ' </option>';
                                        $a = $a + 1;
                                    }
                                ?>
                            </select>
                        </div>
                        <div id="date_depart" class="content_location_time">
                            <p>Date et heure de départ:</p>
                            <input type="date" name="date_depart" min="<?php echo date('Y-m-d'); ?>" max="2024-12-31" id="date_depart_value" required>
                            <input type="time" name="heure_depart" list="limittimelist" autocomplete="off" required>
                            <datalist id="limittimelist">
                                <?php 
                                    $timer_h = "6";
                                    $timer_min = "00" ;
                                    while ($timer_h < 21) {
                                        if ($timer_h < 10) {
                                            echo "<option value='0" . $timer_h . ":" . $timer_min . "'>";
                                            $timer_min = "30";
                                            echo "<option value='0" . $timer_h . ":" . $timer_min . "'>";
                                            $timer_min = "00";
                                            $timer_h = $timer_h + 1;
                                        }
                                        if ($timer_h >= 10) {
                                            echo "<option value='" . $timer_h . ":" . $timer_min . "'>";
                                            $timer_min = "30";
                                            echo "<option value='" . $timer_h . ":" . $timer_min . "'>";
                                            $timer_min = "00";
                                            $timer_h = $timer_h + 1;
                                        }
                                    }
                                ?>  
                            </datalist>
                        </div>
                    </div>
                    <div class="droite">
                        <div id="lieu_arrivee" class="content_location">
                            <p>Lieu de retour:</p>
                            <select name="lieu_arrivee" id="lieu_arrivee" required>
                                <option value="" hidden selected>Choisissez votre lieu de retour</option>
                                <?php
                                    $req_lieu = "SELECT ville FROM ville_garage";
                                    $res_req_lieu = mysqli_query($connexion, $req_lieu);
                                    $a = 1;
                                    while ($ligne_req_lieu = mysqli_fetch_array($res_req_lieu)) {
                                        echo '<option value="' . $a . '"> ' . $ligne_req_lieu['ville'] . ' </option>';
                                        $a = $a + 1;
                                    } 
                                ?>
                            </select>
                        </div>
                        <div id="date_arrivee" class="content_location_time">
                            <p>Date et heure de retour:</p>
                            <input type="date" name="date_arrivee" min="<?php echo date('Y-m-d'); ?>" max="2024-12-31" id="date_arrivee_value" required>
                            <input type="time" name="heure_arrivee" list="limittimelist" autocomplete="off" required>
                        </div>     
                    </div>
                </div>
                <input type="submit" value="Voir les véhicules" id="vehicule_opt_location">
            </form>
        </div>
        <script src="Accueil_connecte.js"></script>
    </div>
</body>
</html>
