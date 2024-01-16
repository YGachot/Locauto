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
        <title>Louer mon véhicule</title>
    </head>
    <body>
    <?php
    if (isset($_SESSION['Insertion_voiture']) && $_SESSION['Insertion_voiture']) {
        echo "<script>alert('Le vehicule a été ajouté avec succès');</script>";
        $_SESSION['Insertion_voiture'] = false;
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
            <div class="elite">
                <h4>Details de votre véhicule</h4>
                <form action="fonctionPHP/upload.php?admin=0" method="POST" enctype="multipart/form-data">
                    <div class="PICL">
                        <p>Immatriculation du véhicule: </p>
                        <input id="input_immatriculation"type="text" name="immatriculation" required>
                        <p>Compteur: </p>
                        <input id="input_compteur" type="text" name="compteur" required>
                        <p>Photo du véhicule: </p>
                        <input id="input_photo" type="file" name="imageFile" required>
                        <br>
                        <select name="lieu" id="insertion_lieu" required>
                            <option value="" hidden selected>Choisissez votre lieu de dépot</option>
                            <?php
                            $req_lieu = "SELECT * FROM ville_garage";
                            $req_lieu_res = mysqli_query($connexion, $req_lieu);
                            while ($ligne_lieu = mysqli_fetch_array($req_lieu_res)) {
                                echo '<option value="' . $ligne_lieu['id_lieu'] . '"> ' . $ligne_lieu['ville'] . ' </option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="catmarmo">
                        <select name="categorie" id="insertion_categorie" required>
                            <option value="" hidden selected>Categorie de votre véhicule</option>
                            <?php
                            $req_categorie = "SELECT * FROM categories";
                            $req_categorie_res = mysqli_query($connexion, $req_categorie);
                            while ($ligne_categorie = mysqli_fetch_array($req_categorie_res)) {
                                echo '<option value="' . $ligne_categorie['id_categorie'] . '"> ' . $ligne_categorie['categorie'] . ' </option>';
                            }
                            ?>
                        </select>
                        <br>
                        <select name="marque" id="insertion_marque" required onchange="updateModeles()">
                            <option value="" hidden selected>Choisissez votre marque de véhicule</option>
                            <?php
                            $req_marque = "SELECT * FROM marque";
                            $req_marque_res = mysqli_query($connexion, $req_marque);
                            while ($ligne_marque = mysqli_fetch_array($req_marque_res)) {
                                echo '<option value="' . $ligne_marque['id_marque'] . '"> ' . $ligne_marque['marque'] . ' </option>';
                            }
                            ?>
                        </select>
                        <br>
                        <select name="modele" id="insertion_modele" required>
                            <option value="" hidden selected>Choisissez votre modele de véhicule</option>
                        </select>
                        <script>
                            function updateModeles() {
                                var marqueSelect = document.getElementById("insertion_marque");
                                var modeleSelect = document.getElementById("insertion_modele");
                                var selectedMarque = marqueSelect.value;

                                // Création de l'objet XMLHttpRequest
                                var xhr = new XMLHttpRequest();

                                // Configuration de la requête AJAX
                                xhr.open("GET", "fonctionPHP/get_modeles.php?marque=" + selectedMarque, true);

                                // Gestion de la réponse de la requête
                                xhr.onreadystatechange = function() {
                                    if (xhr.readyState === XMLHttpRequest.DONE) {
                                        if (xhr.status === 200) {
                                            // Réponse de la requête reçue avec succès
                                            var modeles = JSON.parse(xhr.responseText);

                                            // Effacer les options actuelles du select modele
                                            modeleSelect.innerHTML = "";

                                            // Ajouter les nouvelles options du select modele
                                            for (var i = 0; i < modeles.length; i++) {
                                                var modeleOption = document.createElement("option");
                                                modeleOption.value = modeles[i].id_modele;
                                                modeleOption.textContent = modeles[i].modele;
                                                modeleSelect.appendChild(modeleOption);
                                            }
                                        } else {
                                            // Erreur lors de la requête AJAX
                                            console.error("Erreur lors de la requête AJAX");
                                        }
                                    }
                                };

                                // Envoyer la requête AJAX
                                xhr.send();
                            }
                        </script>
                        <br>
                        <select name="etat" id="insertion_etat" required>
                            <option value="" hidden selected>Etat de votre véhicule</option>
                            <?php
                            $req_etat = "SELECT * FROM etat_vehicule";
                            $req_etat_res = mysqli_query($connexion, $req_etat);
                            while ($ligne_etat = mysqli_fetch_array($req_etat_res)) {
                                echo '<option value="' . $ligne_etat['id_etat'] . '"> ' . $ligne_etat['etat'] . ' </option>';
                            }
                            ?>
                        </select>
                    </div>
                    <input id="btn_ajout_voiture" type="submit" value="Ajouter la voiture">
                </form>
                <script src="Accueil_connecte.js"></script>
            </div>
    </body>
    </html>