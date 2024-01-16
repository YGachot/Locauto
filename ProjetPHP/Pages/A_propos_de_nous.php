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
    
    <title>À propos de nous</title>
    
    <div class="container_APDN">
        
        <a href="" id=""><img id="QSN" src=""/><br><strong>Qui somme nous ?</strong></a>
        <p id="texteQSN"> Bienvenue sur Locauto, votre partenaire de confiance pour une location automobile de qualité. Nous sommes une entreprise moderne et dynamique proposant une vaste flotte de véhicules récents adaptés à tous les besoins et budgets. Nous nous engageons envers la qualité, la sécurité et la satisfaction de nos clients. Réservez en ligne dès maintenant pour une expérience de location automobile inoubliable avec Locauto.</p>
        
        <a href="" id=""><img id="DCT" src=""/><br><strong>Depuis combien de temps ?</strong></a>
        <p id="texteDCT">Depuis 2010, nous sommes spécialisés dans la location automobile, offrant des services de qualité et une expérience client exceptionnelle. Notre expertise dans le domaine nous permet de répondre à vos besoins de location avec professionnalisme et efficacité.</p>
        
        <a href="" id=""><img id="avecqui" src=""/><br><strong>Avec qui ?</strong></a>
        <p id="texteavecqui">Nous sommes fiers de nos partenaires automobiles de renom, qui contribuent à notre succès dans la location de voitures. Grâce à des marques telles que BMW, Mercedes, Volkswagen, Jaguar et Ford, nous proposons une flotte diversifiée de véhicules de qualité. Chacun de nos partenaires est reconnu pour son savoir-faire, sa fiabilité et son engagement envers l'excellence. Profitez de l'expérience de conduite exceptionnelle offerte par nos partenaires de confiance lors de votre prochaine location de voiture avec nous. </p>
        
        <a href="" id=""><img id="ou" src=""/><br><strong>Où ?</strong></a>
        
        <p id="texteou">Présents dans tout le territoire français, nous couvrons les besoins de location automobile dans plusieurs villes, y compris Paris, Rennes, Lille, Lyon, Marseille, Nice, Ajaccio et Bordeaux. Peu importe où vous vous trouvez, nous sommes là pour vous fournir un service de qualité et une gamme de véhicules adaptés à chaque destination. Que vous ayez besoin d'une voiture pour explorer les rues animées de Paris ou pour parcourir les magnifiques paysages de Nice, notre réseau couvre vos besoins de location dans ces villes et bien d'autres encore.</p>
    </div>
    <script src="Accueil_connecte.js"></script> 
</head>
</html>