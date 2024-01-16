<?php
        include_once "../../../Outils/Biblio.php";
        $connexion = connexion();
        session_start();
        $_SESSION['id_client'] = 1;
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../Index_style.css" rel="stylesheet">
        <title>Admin | Nouveau véhicule</title>
    </head>
    <body>
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
    <?php
    if (isset($_SESSION['Insertion_voiture']) && $_SESSION['Insertion_voiture']) {
        echo "<script>alert('Le vehicule a été ajouté avec succès');</script>";
        $_SESSION['Insertion_voiture'] = false;
    }
    ?>
        <div class="elite">
            <h4>Details du véhicule</h4>
            <form action="../../fonctionPHP/upload.php?admin=1" method="POST" enctype="multipart/form-data">
                <div class="PICL">
                    <p>Immatriculation du véhicule: </p>
                    <input id="input_immatriculation"type="text" name="immatriculation" autocomplete="off" required>
                    <p>Compteur: </p>
                    <input id="input_compteur" type="text" name="compteur" autocomplete="off" required>
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
                            xhr.open("GET", "../../fonctionPHP/get_modeles.php?marque=" + selectedMarque, true);

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
        </div>
    </body>
    </html>