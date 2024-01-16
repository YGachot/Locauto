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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Locauto | Accueil</title>
</head>
<body>
    <div class="Corps_page">
        <?php
            if (isset($_SESSION['connexion_ok']) && $_SESSION['connexion_ok']) {
                $_SESSION['connexion_ok'] = false;
            }
            if (isset($_SESSION['client_ajoute']) && $_SESSION['client_ajoute']) {

                $name_inscription_start = $_GET['name'];
                $firstname_inscription_start = $_GET['firstname'];
                echo "<script>alert('Bienvenue parmi nous, " . $name_inscription_start . " " . $firstname_inscription_start . ". Veuillez cliquer sur connexion pour finaliser votre arrivée.');</script>";
                $_SESSION['client_ajoute'] = false;
            }
            if (isset($_SESSION['client_connecte']) && $_SESSION['client_connecte']) {
                $recup_test = $_GET['try_connect'];

                if ($recup_test == 1) {
                    echo 
                    "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('connexion-button').click()
                        var wrong = document.getElementById('wrong_password')
                        wrong.classList.add('activate_wrong_email')
                    })
                    </script>";
                    $_SESSION['client_connecte'] = false;
                }

                if ($recup_test == 2) {
                    echo 
                    "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('connexion-button').click()
                        var wrong = document.getElementById('wrong_id')
                        wrong.classList.add('activate_wrong_email')
                    })
                    </script>";
                    $_SESSION['client_connecte'] = false;
                }
            }
            if(isset($_SESSION['client_mail_utilisé']) && $_SESSION['client_mail_utilisé']) {
                echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('inscription-button').click()
                    document.getElementById('nom-insc').value ='".$_GET['name']."'
                    document.getElementById('firstname-insc').value ='".$_GET['firstname']."'
                    document.getElementById('address-insc').value ='".$_GET['address']."'
                    var radioValue = '" .$_GET['type_client']. "'
                    var radioElement = document.querySelector('input[name=\"type_client\"][value=\"' + radioValue + '\"]');
                    console.log(radioElement)
                    radioElement.checked = true
                    var wrong = document.getElementById('wrong_email')
                    wrong.classList.add('activate_wrong_email')
                })</script>";
                $_SESSION['client_mail_utilisé'] = false;
            }
            if(isset($_SESSION['nom_nombre']) && $_SESSION['nom_nombre']) {
                echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('inscription-button').click()
                    document.getElementById('mail-insc').value ='".$_GET['mail']."'
                    document.getElementById('firstname-insc').value ='".$_GET['firstname']."'
                    document.getElementById('address-insc').value ='".$_GET['address']."'
                    var radioValue = '" .$_GET['type_client']. "'
                    var radioElement = document.querySelector('input[name=\"type_client\"][value=\"' + radioValue + '\"]');
                    console.log(radioElement)
                    radioElement.checked = true
                    var wrong = document.getElementById('wrong_name')
                    wrong.classList.add('activate_wrong_email')
                })</script>";
                $_SESSION['nom_nombre'] = false;
            }
            if(isset($_SESSION['prenom_nombre']) && $_SESSION['prenom_nombre']) {
                echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('inscription-button').click()
                    document.getElementById('mail-insc').value ='".$_GET['mail']."'
                    document.getElementById('nom-insc').value ='".$_GET['name']."'
                    document.getElementById('address-insc').value ='".$_GET['address']."'
                    var radioValue = '" .$_GET['type_client']. "'
                    var radioElement = document.querySelector('input[name=\"type_client\"][value=\"' + radioValue + '\"]');
                    console.log(radioElement)
                    radioElement.checked = true
                    var wrong = document.getElementById('wrong_firstname')
                    wrong.classList.add('activate_wrong_email')
                })</script>";
                $_SESSION['prenom_nombre'] = false;
            }
            if(isset($_SESSION['mdp_non_identique']) && $_SESSION['mdp_non_identique']) {
                echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('inscription-button').click()
                    document.getElementById('mail-insc').value ='".$_GET['mail']."'
                    document.getElementById('nom-insc').value ='".$_GET['name']."'
                    document.getElementById('address-insc').value ='".$_GET['address']."'
                    document.getElementById('firstname-insc').value ='".$_GET['firstname']."'
                    var radioValue = '" .$_GET['type_client']. "'
                    var radioElement = document.querySelector('input[name=\"type_client\"][value=\"' + radioValue + '\"]');
                    console.log(radioElement)
                    radioElement.checked = true
                    var wrong = document.getElementById('wrong_mdp')
                    wrong.classList.add('activate_wrong_email')
                })</script>";
                $_SESSION['mdp_non_identique'] = false;
            }
        ?>
        <div class="bande-stick">
            <div id="imglogo_container">
                <img id="imglogo" src="https://cdn.discordapp.com/attachments/1020008766479020033/1108003914403545160/logo_voiture.jpg">
            </div>
        </div>
        <div id="menu_hamburger" class="menu_hamburger">
            <a href="#" id="close_button" class="close_button"><img id="imgbtnclsmh"src="https://cdn.discordapp.com/attachments/1020008766479020033/1107932479207252030/close_window_24px.png"/></a>
            <ul>
                <li><a href="#" id="faire_louer"><img id="imggarage" src="https://cdn.discordapp.com/attachments/1020008766479020033/1107932500128444416/garage_24px.png"/><br>Faire louer mon véhicule</a></li>
                <li><a href="#" id="carte_garage"><img id="imglocation" src="https://cdn.discordapp.com/attachments/1020008766479020033/1107932523817873458/location_24px.png"/><br>Carte de nos garages</a></li>
                <li><a href="#" id="liste_vehicule"><img id="imgvoiture" src="https://cdn.discordapp.com/attachments/1020008766479020033/1107932448202952764/car_24px.png"/><br>Liste de nos véhicules</a></li>
                <li><a href="#" id="a_propos_de_nous"><img id="imgaproposdenous" src="https://cdn.discordapp.com/attachments/1020008766479020033/1107943203350528040/people_24px.png"/><br>A propos de nous</a></li>
                <li><a href="#" id="nous_contacter"><img id="imgtelephone" src="https://cdn.discordapp.com/attachments/1020008766479020033/1107942744900501535/phone_24px.png"/><br>Nous contacter</a></li>
            </ul>
        </div>
        <a href="#" id="open_menu_hamburger">
            <span class="open_menu_hamburger_btn">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </a>
        <div class="flex-item">
            <p id="inscription-button" class="goto" >Inscription</p>
        </div>
        <div class="inscription_popup" id="inscription_popup">
            <div class="inscription-back" id="inscription-back">
                <div class="inscription-container" id="inscription-container">
                    <a href="#" id="inscription-close"><img id="imgbtnblsinscription"src="https://cdn.discordapp.com/attachments/1020008766479020033/1107932479207252030/close_window_24px.png"/></a>
                    <h2>Inscription</h2>
                    <form id="inscription_form" class="form" action="fonctionPHP/ajouter_client.php" method="post" onsubmit="return validerFormulaireInscription()" >
                        <div class="input-field">
                            <input type="text" name="name-insc" autocomplete="off" required spellcheck="false" id="nom-insc" class="inputF">
                            <label id="label">Nom:</label>
                        </div>
                        <p id="wrong_name" class="wrong_email">Nom invalide</p>
                        <div class="input-field">
                            <input type="text" name="firstname-insc" autocomplete="off" required spellcheck="false" id="firstname-insc" class="inputF">
                            <label id="label">Prénom:</label>
                        </div>
                        <p id="wrong_firstname" class="wrong_email">Prénom invalide</p>
                        <div class="input-field">
                            <input type="text" name="address-insc" autocomplete="off" required spellcheck="false" id="address-insc" class="inputF">
                            <label id="label">Adresse:</label>
                        </div>
                        <div class="input-field">
                            <input type="email" name="mail-insc" autocomplete="off" required spellcheck="false" id="mail-insc" class="inputF">
                            <label id="label">E-mail:</label>
                        </div>
                        <p id="wrong_email" class="wrong_email">Adresse mail déjà utilisée</p>
                        <div class="input-field">
                            <input type="password" name="mdp_insc" autocomplete="off" required spellcheck="false" id="mdp-insc" class="inputF">
                            <label id="label"for="mdp">Mot de passe:</label>
                        </div>
                        <p id="wrong_mdp" class="wrong_email">Vos mot de passe ne correspondent pas </p>
                        <div class="input-field">
                            <input type="password" name="confirm_mdp-insc" autocomplete="off" required spellcheck="false" id="confirm-mdp-insc" class="inputF">
                            <label id="label">Confirmer mot de passe:</label>
                        </div>
                        <ul id="menu-accordeon">
                            <li><a href="#">Type de client</a>
                                <ul>
                                <?php
                                    $requete_type_client = "SELECT type_client_libelle FROM type_client WHERE type_client_libelle <> 'Administration'";
                                    $resultat_type_client = mysqli_query($connexion, $requete_type_client);
                                    $i=1;
                                    while ($ligne_type_client = mysqli_fetch_array($resultat_type_client)) {
                                    echo '<li><label class="type-insc"><input type="radio" name="type_client" value='.$i.' required>'.$ligne_type_client['type_client_libelle'].'</label></li>';
                                    $i+=1;
                                    }
                                ?>
                                </ul>
                            </li>
                        </ul>
                    </ul>
                    <a href="#" id="deja_un_compte">Vous avez déjà un compte? Se connecter</a>
                    <input type="submit" value="Inscription" id="sinscrire">
                    </form>
                </div>      
            </div>
        </div>
        <div class="flex-item">
            <p id="connexion-button" class="goto" >Connexion</p>
        </div>
        <div class="connexion_popup" id="connexion_popup">
            <div class="connexion-back" id="connexion-back">
                <div class="connexion-container" id="connexion-container">
                    <a href="#" id="connexion-close"><img src="https://cdn.discordapp.com/attachments/1020008766479020033/1107932479207252030/close_window_24px.png"/></a>
                    <h2>Connexion</h2>
                    <form class="form" action="fonctionPHP/connecte_client.php" method="post">
                        <div class="input-field">
                            <input id="mail-conn" class="input" type="text" name="email" required spellcheck="false">
                            <label id="label">E-mail:</label>
                        </div>
                        <p id="wrong_id" class="wrong_email">Utilisateur incconu</p>
                        <div class="input-field">
                            <input id="mdp-conn" class="input "type="password" name="password" required spellcheck="false">
                            <label id="label">Mot de passe:</label>
                        </div>
                        <p id="wrong_password" class="wrong_email">Mot de passe incorrect</p>
                    <a href="#" id="pas_un_compte">Vous n'avez pas de compte? S'inscrire</a>
                    <input type="submit" value="Se connecter" id="seconnecter">
                    </form>
                </div>
            </div>
        </div>
        <div class="container_option_location">
            <h1>Accueil</h1>
            <div class="gauche_droite">
                <div class="gauche">
                    <div id="lieu_depart" class="content_location">
                        <p>Lieu de départ:</p>
                        <select name="lieu_depart"><option hidden selected>Choisissez votre lieu de départ</option>
                            <?php
                                $req_lieu = "SELECT ville FROM ville_garage";
                                $res_req_lieu = mysqli_query($connexion, $req_lieu);
                                $a = 1;
                                while ($ligne_req_lieu = mysqli_fetch_array($res_req_lieu)) {
                                    echo '<option value="' . $a . '"> ' . $ligne_req_lieu['ville'] . ' </option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div id="date_depart" class="content_location_time">
                        <p>Date et heure de départ:</p>
                        <input type="date" name="date_depart" min="<?php echo date('Y-m-d'); ?>" max="2024-12-31">
                            <input type="time" name="heure_depart" list="limittimelist" autocomplete="off">
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
                                            $timer_h = $timer_h + "1";
                                        }
                                        if ($timer_h >= 10) {
                                            echo "<option value='" . $timer_h . ":" . $timer_min . "'>";
                                            $timer_min = "30";
                                            echo "<option value='" . $timer_h . ":" . $timer_min . "'>";
                                            $timer_min = "00";
                                            $timer_h = $timer_h + "1";
                                        }
                                    }
                                ?>  
                            </datalist>
                    </div>
                </div>
                <div class="droite">
                    <div id="lieu_arrivee" class="content_location">
                        <p>Lieu de retour:</p>
                        <select name="lieu_arrivee"><option hidden selected>Choisissez votre lieu de retour</option>
                            <?php
                                $req_lieu = "SELECT ville FROM ville_garage";
                                $res_req_lieu = mysqli_query($connexion, $req_lieu);
                                $a = 1;
                                while ($ligne_req_lieu = mysqli_fetch_array($res_req_lieu)) {
                                    echo '<option value="' . $a . '"> ' . $ligne_req_lieu['ville'] . ' </option>';
                                } 
                            ?>
                        </select>
                    </div>
                    <div id="date_arrivee" class="content_location_time">
                        <p>Date et heure de retour:</p>
                        <input type="date" name="date_arrivee" min="<?php echo date('Y-m-d'); ?>" max="2024-12-31">
                        <input type="time" name="heure_arrivee" list="limittimelist" autocomplete="off">
                    </div>      
                </div>
            </div>
            <input type="button" value="Voir les véhicules" id="vehicule_opt_location">
        </div>
    </div>
    <script src="fonctionJS/Accueil_non_connecte.js"></script>
</body>
</html>
