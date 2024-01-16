<?php
    include_once "../../Outils/Biblio.php";
    $connexion = connexion();
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../Index_style.css" rel="stylesheet">
    <title>Admin | Acccueil</title>
</head>
<body>
    <?php
    if (isset($_SESSION['suppr_vehicule']) && $_SESSION['suppr_vehicule']) {
        echo "<script>alert('Le vehicule a été supprimé avec succès');</script>";
        $_SESSION['suppr_vehicule'] = false;
    }
    if (isset($_SESSION['suppr_client']) && $_SESSION['suppr_client']) {
        echo "<script>alert('Le client a été supprimé avec succès');</script>";
        $_SESSION['suppr_client'] = false;
    }
    if (isset($_SESSION['suppr_locations']) && $_SESSION['suppr_locations']) {
        echo "<script>alert('La location a été supprimée avec succès');</script>";
        $_SESSION['suppr_locations'] = false;
    }
    ?>
    <div class="bande-stick">
        <div id="imglogo_container">
            <img id="imglogo" src="https://cdn.discordapp.com/attachments/1020008766479020033/1108003914403545160/logo_voiture.jpg">
        </div>
        <a href="../deconnexion.php" ><p class="goto" id="deconnexion_admin">Se deconnecter</p></a>
    </div>
    <script>
        document.getElementById('imglogo_container').addEventListener('click', function(e) {
            window.location.href = "Admin_accueil.php";
         });
    </script>
    <div class="affichage">
        <h5>Affichage</h5>
        <div class="hist_client">
            <form action="Client/Liste_client.php" method="post">
                <input type="search" name="selection_client" id="selection_client" required autocomplete="off"></select>
                <br>
                <div class="btninfosclient">
                    <input type="submit" value="Acceder aux infos du client"></div>
            </form>
        </div>
        <div class="list_vehicule">
            <form action="Vehicule/Liste_vehicule_admin.php" method="post">
                <label><input type="radio" name="selection_type_liste" class="selection_type_liste" value="disponible" required>Vehicules disponibles</label>
                <br>
                <label><input type="radio" name="selection_type_liste" class="selection_type_liste" value="non_disponible" required>Vehicules non disponibles</label>
                <br>
                <label><input type="radio" name="selection_type_liste" class="selection_type_liste" value="tous" required>Tous les véhicules</label>
                <br>
                <div class="btnconsultervehicules">
                <input type="submit" value="Consulter les vehicules"></div>
            </form>
        </div>
        <div class="location">
            <form action="Locations/Liste_location.php" method="post">
                <label><input type="radio" name="selection_type_location" class="selection_type_location" value="encours" required>Locations en cours</label>
                <br>
                <label><input type="radio" name="selection_type_location" class="selection_type_location" value="termine" required>Locations terminées</label>
                <br>
                <label><input type="radio" name="selection_type_location" class="selection_type_location" value="avenir" required>Locations à venir</label>
                <br>
                <label><input type="radio" name="selection_type_location" class="selection_type_location" value="toutes" required>Toutes les locations</label>
                <br>
                <div class="consulterloc">
                <input type="submit" value="Consulter les locations"></div>
            </form>
        </div>
    </div>
    <div class="suppression">
    <h5>Suppression</h5>
        <div class="suppr_client">
            <form action="../fonctionPHP/suppr_client.php" method="post">
                <select name="id_client" required>
                <option value="" hidden selected>Selection identifiant du client</option>
                    <?php
                        $req_client = "SELECT * FROM clients WHERE mail <> 'Admin@locauto.com'";
                        $req_client_res = mysqli_query($connexion, $req_client);
                        while ($ligne_client = mysqli_fetch_array($req_client_res)) {
                            echo '<option value="' . $ligne_client['id_client'] . '"> ' . $ligne_client['mail'] . ' </option>';
                        }
                    ?>
                </select>
                <br>
                <input type="submit" value="Supprimer le client">
            </form>
        </div>
        <div class="suppr_vehicule">
            <form action="../fonctionPHP/suppr_vehicule.php" method="post">
                <select name="immatriculation" required>
                <option value="" hidden selected>Selection immatriculation du véhicule</option>
                    <?php
                        $req_vehicule = "SELECT * FROM voitures";
                        $req_vehicule_res = mysqli_query($connexion, $req_vehicule);
                        while ($ligne_vehicule = mysqli_fetch_array($req_vehicule_res)) {
                            echo '<option value="' . $ligne_vehicule['immatriculation'] . '"> ' . $ligne_vehicule['immatriculation'] . ' </option>';
                        }
                    ?>
                </select>
                <br>
                <input type="submit" value="Supprimer le vehicule">
            </form>
        </div>
        <div class="suppr_location">
            <form action="../fonctionPHP/suppr_location.php" method="post">
                <select name="id_louer" required>
                <option value="" hidden selected>Selection de l'id de la location</option>
                    <?php
                        $req_louer = "SELECT * FROM louer";
                        $req_louer_res = mysqli_query($connexion, $req_louer);
                        while ($ligne_louer = mysqli_fetch_array($req_louer_res)) {
                            echo '<option value="' . $ligne_louer['id_louer'] . '"> ' . $ligne_louer['id_louer'] . ' </option>';
                        }
                    ?>
                </select>
                <br>
                <input type="submit" value="Supprimer la location">
            </form>
        </div>
    </div>
    <div class="insertion">
        <h5>Insertion</h5>
        <a href="Insertion/Vehicule.php"><button id="btnNV">Nouveau vehicule</button></a>
        <a href="Insertion/Client.php"><button id="btnNC">Nouveau client</button></a>
        <a href="Insertion/Location.php"><button id="btnNL">Nouvelle location</button></a>
    </div>
    <div class="MaJ">
        <h5>Mise à jour</h5>
        <form action="../fonctionPHP/Maj.php" method="post">
            <select name="maj_louer" required>
                <option value="" hidden selected>Selection de l'immatriculation de la voiture à mettre à jour</option>
                    <?php
                        $req_immat_maj = "SELECT voitures.*, louer.*, clients.*
                        FROM louer 
                        JOIN voitures USING(immatriculation)
                        JOIN clients ON louer.id_client = clients.id_client
                        WHERE CURRENT_DATE >= louer.date_arrivee 
                        AND compteur_fin = 0";
                        $req_immat_maj_res = mysqli_query($connexion, $req_immat_maj);
                        while ($ligne_immat_maj = mysqli_fetch_array($req_immat_maj_res)) {
                            echo '<option value="' . $ligne_immat_maj['id_louer'] . '"> ' . $ligne_immat_maj['immatriculation'] . ' loué par M./MM. ' . $ligne_immat_maj['nom'] . ' rendu le ' . $ligne_immat_maj['date_arrivee'] . '</option>';
                        }
      
                    ?>
                </select>
            <input id="btn_maj_compteur" type="text" required name="compteur" placeholder="Compteur au retour du vehicule" autocomplete="off">
            <input id="maj_vehicule" type="submit" value="Mettre à jour le véhicule">
        </form>
        <?php
        if (isset($_SESSION['MaJ']) && $_SESSION['MaJ']) {
            $req_id_louer = "SELECT immatriculation FROM louer WHERE id_louer = ".$_GET['id_louer'];
            $resultat_id_louer = mysqli_query($connexion, $req_id_louer);
            $ligne_id_louer = mysqli_fetch_array($resultat_id_louer);
            $id_louer = $ligne_id_louer['immatriculation'];

            $req_id_lieu = "SELECT ville_garage.*, louer.* FROM louer JOIN ville_garage ON louer.id_lieu_arrivee = ville_garage.id_lieu WHERE id_louer = ".$_GET['id_louer'];
            $resultat_id_lieu = mysqli_query($connexion, $req_id_lieu);
            $ligne_id_lieu = mysqli_fetch_array($resultat_id_lieu);
            $id_lieu = $ligne_id_lieu['ville'];
            
            echo "<p id='texte_maj_vehicule'> La voiture d'immatriculation " . $id_louer . " à bien été mise à jour.<br>Nouveau compteur = " . $_GET['compteur'] . ". Nouveau garage: " . $id_lieu ."</p> " ;
            $_SESSION['MaJ'] = false;
        }
        ?>
    </div>
    <script src="../fonctionJS/Administration.js"></script>
</body>
</html>