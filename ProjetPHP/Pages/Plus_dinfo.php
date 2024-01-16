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
    <title>Caractéristiques du véhicule</title>
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
    $immatriculation = str_replace( '%', ' ', $_GET['immatriculation'] );
    $req = ' SELECT voitures.*, etat_vehicule.etat , categories.categorie  , ville_garage.ville , clients.nom , clients.prenom , categories.prix, modeles.*, marque.*
            FROM voitures 
            JOIN etat_vehicule USING(id_etat) 
            JOIN categories USING(id_categorie) 
            JOIN ville_garage USING(id_lieu)
            JOIN clients USING(id_client)
            JOIN modeles USING(id_modele)
            JOIN marque USING(id_marque)
            WHERE immatriculation = "'.$immatriculation.'" ';
    $req = mysqli_query($connexion, $req);
    while ($ligne = mysqli_fetch_array($req)) {
        ?>
        <div class="plusdinfo_container">
            <h1>Caractéristiques du véhicule :</h1>
            <?php
                echo "<p id='marque'>Marque : ".$ligne['marque']. "</p>";
                echo "<br>";
                echo "<p id='modele'>Modèle : " .$ligne['modele']. "</p>";
                echo "<br>";
                echo "<p id='categorie'>Catégorie : " .$ligne['categorie']. "</p>";
                echo "<br>";
                echo "<p id='compteur'>Km au compteur : " .$ligne['compteur']. "</p>";
                echo "<br>";
                echo "<p id='immatriculation'>Immatriculation : " .$ligne['immatriculation']. "</p>";
                echo "<br>";
                $compteur = $ligne['compteur'];
                echo "<p id='etat'>État :</p>";
                echo "<p id='nomdegats'>" .$ligne['etat']. "</p>";
                echo "<br>";
                echo "<p id='ville'>Localisation : " .$ligne ['ville']. " </p>";
                echo "<br>";
                echo "<p id='prenomnom'>Location par : " .$ligne['prenom']." ".$ligne['nom']. "</p>";
                echo "<br>";
            ?>
        </div>
        <?php
        $prix = $ligne['prix'] ;
        $categorie = $ligne['categorie'] ;
    }
    if ($_GET['trie']==1) {
        $req_option = 'SELECT * FROM options';
        $req_option_res = mysqli_query($connexion,$req_option);
        ?>
        <button id="paiement_button">Acceder au paiement</button>
        <div class="labeloptions">
        <p>Options supplémentaires :</p>
        <?php
        $i=0;
                while ($ligne_option = mysqli_fetch_array($req_option_res) and $i < 3) {?>
                    <label><input type="checkbox" id="checkbox_option_<?php echo $ligne_option['id_options'] ?>"><?php echo $ligne_option['options'] ?></label>
                    <?php
                    $i = $i + 1;
            }
    }
    ?>
        </div>
        <div class="paiement_popup" id="paiement_popup">
            <div class="paiement_back" id="paiement_back">
                <div class="paiement_container" id="paiement_container">
                    <a href="#" id="paiement_close"><img id="imgbtnpaiement"src="https://cdn.discordapp.com/attachments/1020008766479020033/1107932479207252030/close_window_24px.png"/></a>
                    <h1>Récapitulatif du paiement</h1>
                    <?php
                    $difdate = $_GET['dif_date'];
                    $prix_jour = $prix * $difdate;
                    echo '<div id="prix_initial" data-prix_initial="' . $prix_jour . '"></div>';
                    ?>
                    <p class="content_paiement_prix" id="prix"> <?php echo $categorie ?> : <?php echo $prix ?> € à la journée x <?php echo $difdate ?> jours = <?php echo $prix_jour ?> €</p>
                    <?php 
                    $req_option2 = 'SELECT * FROM options';
                    $req_option_res2 = mysqli_query($connexion,$req_option2);
                    while ($ligne_option2 = mysqli_fetch_array($req_option_res2)) {?>
                        <p class="content_paiement" id="prix_option_<?php echo $ligne_option2['id_options'] ?>"><?php echo $ligne_option2['options'] ?> + <?php echo $ligne_option2['prix']?> € </p>
                        <?php
                        echo '<div id="option_' . $ligne_option2['id_options'] . '" data-option_' . $ligne_option2['id_options'] . '="' . $ligne_option2['prix'] . '"></div>';
                        if ($_GET['lieu_dif'] == 1) {
                            $req_lieu_dif = 'SELECT * FROM options WHERE id_options = 4';
                            $req_lieu_dif_res = mysqli_query($connexion, $req_lieu_dif);
                            $ligne_lieu_dif = mysqli_fetch_array($req_lieu_dif_res);
                            echo '<p class="content_paiement" id="prix_option_lieu">' . $ligne_lieu_dif['options'] . ' + ' . $ligne_lieu_dif['prix'] . ' €</p>';
                            echo '<div id="prix_lieu_dif" data-prix_lieu_dif="' . $ligne_lieu_dif['prix'] . '"></div>';
                        }
                        if ($_GET['date_depart'] == 0) {
                            $req_date_depart = 'SELECT * FROM options WHERE id_options = 5';
                            $req_date_depart_res = mysqli_query($connexion, $req_date_depart);
                            $ligne_date_depart = mysqli_fetch_array($req_date_depart_res);
                            echo '<p class="content_paiement" id="prix_option_date_depart">' . $ligne_date_depart['options'] . ' - ' . $ligne_date_depart['prix'] . ' €</p>';
                            echo '<div id="prix_dimanche" data-prix_dimanche="' . $ligne_date_depart['prix'] . '"></div>';
                        }
                    }
                    $id_client = $_SESSION['id_client'];
                    ?>
                    <p id="total"></p>
                    <button id="button_insert_location">Effectuer le paiement</button>
                    <script>
                    // Attacher un gestionnaire d'événements au clic du bouton
                    document.getElementById('button_insert_location').addEventListener('click', function() {
                        // Récupérer les données passées en paramètres GET de l'URL
                        var urlParams = new URLSearchParams(window.location.search);
                        var date_depart = urlParams.get('datedepart');
                        var date_arrivee = urlParams.get('datearrivee');
                        var compteur_debut = <?php echo $compteur ?>;
                        var immatriculation = "<?php echo $immatriculation ?>"; // Ajoutez des guillemets autour de la valeur
                        var id_client = <?php echo $id_client ?>;
                        var id_lieu_depart = urlParams.get('idlieudepart');
                        var id_lieu_arrivee = urlParams.get('idlieuarrivee');

                        var checkbox1 = document.getElementById('checkbox_option_1')
                        var checkbox2 = document.getElementById('checkbox_option_2')
                        var checkbox3 = document.getElementById('checkbox_option_3')

                        // Soumettre le formulaire pour déclencher l'insertion en PHP
                        var form = document.createElement('form');
                        form.method = 'POST';
                        form.action = 'fonctionPHP/insertion_louer.php'; // Remplacez 'votre_script_php.php' par le chemin vers votre script PHP
                        document.body.appendChild(form);

                        if (checkbox1.checked) {
                                var option_1 = '1';
                                var input_option_1 = document.createElement('input')
                                input_option_1.type = 'hidden'
                                input_option_1.name = 'option_1'
                                input_option_1.value = option_1
                                form.appendChild(input_option_1)
                            }
                        else {
                            var option_1 = '0';
                            var input_option_1 = document.createElement('input')
                            input_option_1.type = 'hidden'
                            input_option_1.name = 'option_1'
                            input_option_1.value = option_1
                            form.appendChild(input_option_1)
                        }

                        if (checkbox2.checked) {
                                var option_2 = '2';
                                var input_option_2 = document.createElement('input')
                                input_option_2.type = 'hidden'
                                input_option_2.name = 'option_2'
                                input_option_2.value = option_2
                                form.appendChild(input_option_2)
                            }
                        else {
                            var option_2 = '0';
                            var input_option_2 = document.createElement('input')
                            input_option_2.type = 'hidden'
                            input_option_2.name = 'option_2'
                            input_option_12value = option_2
                            form.appendChild(input_option_2)
                        }

                        if (checkbox3.checked) {
                                var option_3 = '3';
                                var input_option_3 = document.createElement('input')
                                input_option_3.type = 'hidden'
                                input_option_3.name = 'option_3'
                                input_option_3.value = option_3
                                form.appendChild(input_option_3)
                            }
                        else {
                            var option_3 = '0';
                            var input_option_3 = document.createElement('input')
                            input_option_3.type = 'hidden'
                            input_option_3.name = 'option_3'
                            input_option_3.value = option_3
                            form.appendChild(input_option_3)
                        }
                        // Ajouter des champs cachés contenant les valeurs à insérer
                        var inputDateDepart = document.createElement('input');
                        inputDateDepart.type = 'hidden';
                        inputDateDepart.name = 'date_depart';
                        inputDateDepart.value = date_depart;
                        form.appendChild(inputDateDepart);

                        var inputDateArrivee = document.createElement('input');
                        inputDateArrivee.type = 'hidden';
                        inputDateArrivee.name = 'date_arrivee';
                        inputDateArrivee.value = date_arrivee;
                        form.appendChild(inputDateArrivee);

                        var inputCompteurDebut = document.createElement('input');
                        inputCompteurDebut.type = 'hidden';
                        inputCompteurDebut.name = 'compteur_debut';
                        inputCompteurDebut.value = compteur_debut;
                        form.appendChild(inputCompteurDebut);

                        var inputImmatriculation = document.createElement('input');
                        inputImmatriculation.type = 'hidden';
                        inputImmatriculation.name = 'immatriculation';
                        inputImmatriculation.value = immatriculation;
                        form.appendChild(inputImmatriculation);

                        var inputIdClient = document.createElement('input');
                        inputIdClient.type = 'hidden';
                        inputIdClient.name = 'id_client';
                        inputIdClient.value = id_client;
                        form.appendChild(inputIdClient);

                        var inputIdLieuDepart = document.createElement('input');
                        inputIdLieuDepart.type = 'hidden';
                        inputIdLieuDepart.name = 'id_lieu_depart';
                        inputIdLieuDepart.value = id_lieu_depart;
                        form.appendChild(inputIdLieuDepart);

                        var inputIdLieuArrivee = document.createElement('input');
                        inputIdLieuArrivee.type = 'hidden';
                        inputIdLieuArrivee.name = 'id_lieu_arrivee';
                        inputIdLieuArrivee.value = id_lieu_arrivee;
                        form.appendChild(inputIdLieuArrivee);

                        form.submit();
                    });
                    </script>
                 </div>      
            </div>
        </div>
    <script src="fonctionJS/Plus_dinfo.js"></script>
    <script src="Accueil_connecte.js"></script> 
</body>
</html>