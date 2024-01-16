<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="Index_style.css" rel="stylesheet">
    <title>Nous Contacter</title>
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
    
    <div class="container_contact">
        
        <p id="notreaddr">Notre adresse mail :</p>
    
        <a href="https://outlook.live.com/mail/0/"><br><img id="mail" src="https://cdn.discordapp.com/attachments/1017757559953825803/1110138372552413234/mail_48px.png"/></a>
        <a id="addrmail" href="https://outlook.live.com/mail/0/">locautoadministration@gmail.com</a>

        <p id="telephone"><br><br>Téléphone :</p> <p id="numtel">XX.XX.XX.XX.XX</p>
        
        <p id="nosreseaux">Nos réseaux :</p>
            <a href="https://www.instagram.com"><br><img id="insta" src="https://cdn.discordapp.com/attachments/1020008766479020033/1110208530780278784/Instagram_icon.png.png"/></a>
            <a href="https://twitter.com"><br><img id="twitter" src="https://cdn.discordapp.com/attachments/1020008766479020033/1110211040454656061/Logo_of_Twitter.svg.png"/></a>
            <a href="https://fr-fr.facebook.com"><br><img id="facebook" src="https://cdn.discordapp.com/attachments/1020008766479020033/1110211306184785990/Facebook_logo_square.png"/></a>
            <a href="https://www.youtube.com"><br><img id="ytb" src="https://cdn.discordapp.com/attachments/1020008766479020033/1110211586079076402/YouTube_full-color_icon_2017.svg.png"/></a>
            <a href="https://www.tiktok.com/fr/"><br><img id="tiktok" src="https://cdn.discordapp.com/attachments/1020008766479020033/1110212102934777938/5cb78671a7c7755bf004c14b.png"/></a>
    </div>
    <script src="Accueil_connecte.js"></script>

</head>
</html>