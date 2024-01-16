<?php
        include_once "../../../Outils/Biblio.php";
        $connexion = connexion();
        session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../Index_style.css" rel="stylesheet">
    <title>Admin | Nouvelle location</title>
</head>
<body>
    <?php
    if (isset($_SESSION['location_ajoutee']) && $_SESSION['location_ajoutee']) {
        echo "<script>alert('Merci pour votre commande, la location a été ajoutée')</script>";
        $_SESSION['location_ajoutee'] = false;
    }
    ?>
    <div class="bande-stick">
        <div id="imglogo_container">
            <img id="imglogo" src="https://cdn.discordapp.com/attachments/1020008766479020033/1108003914403545160/logo_voiture.jpg">
        </div>
        <a href="../../deconnexion.php" ><p class="goto" id="deconnexion_admin">Se deconnecter</p></a>
        <script>
            document.getElementById('imglogo_container').addEventListener('click', function(e) {
                console.log('coucou');
                window.location.href = "../Admin_accueil.php";
            });
        </script>
    </div>
    <form action="Liste_triee.php" method="post" >
        <div class="container_option_location">
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
         
            <select id="Select_id_client" name="mail_client" required>
            <option value="" hidden selected>Selection identifiant du client</option>
                <?php
                    $req_client = "SELECT * FROM clients WHERE mail <> 'Admin@locauto.com'";
                    $req_client_res = mysqli_query($connexion, $req_client);
                    while ($ligne_client = mysqli_fetch_array($req_client_res)) {
                        echo '<option value="' . $ligne_client['id_client'] . '"> ' . $ligne_client['mail'] . ' </option>';
                    }
                ?>
            </select> 
            <input type="submit" value="Voir les véhicules" id="vehicule_opt_location">
        </div>
    </form>
</body>
</html>