<?php
    include_once "../../../Outils/Biblio.php";
    $connexion = connexion();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../Index_style.css" rel="stylesheet">
    <title>Admin | Liste location</title>
</head>
<body>
    <div class="bande-stick">
        <div id="imglogo_container">
            <img id="imglogo" src="https://cdn.discordapp.com/attachments/1020008766479020033/1108003914403545160/logo_voiture.jpg">
        </div>
        <a href="../../deconnexion.php" ><p class="goto" id="deconnexion_admin">Se deconnecter</p></a>
    </div>
    <script>
        document.getElementById('imglogo_container').addEventListener('click', function(e) {
            console.log('coucou');
            window.location.href = "../Admin_accueil.php";
         });
    </script>
    <table>
        <thead>
            <tr>
                <th>Id de la location</th>
                <th>Immatriculation</th>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Catégorie du véhicule</th>
                <th>Date de départ</th>
                <th>Date de retour</th>
                <th>Lieu de départ</th>
                <th>Lieu de retour</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $id_client = $_POST['id_client'];
            $req_location_client = "SELECT *, ville_garage_depart.ville AS ville_depart, ville_garage_arrivee.ville AS ville_arrivee
            FROM louer
            JOIN voitures ON louer.immatriculation = voitures.immatriculation
            JOIN ville_garage AS ville_garage_depart ON louer.id_lieu_depart = ville_garage_depart.id_lieu
            JOIN ville_garage AS ville_garage_arrivee ON louer.id_lieu_arrivee = ville_garage_arrivee.id_lieu
            JOIN categories ON categories.id_categorie = voitures.id_categorie
            JOIN modeles USING(id_modele)
            JOIN marque USING(id_marque)
            WHERE louer.id_client = $id_client";
            $req_location_client_res = mysqli_query($connexion, $req_location_client);
            while ($ligne = mysqli_fetch_array($req_location_client_res)) {
                ?>
                <tr>
                    <td><?php echo $ligne['id_louer'] ?></td>
                    <td><?php echo $ligne['immatriculation'] ?></td>
                    <td><?php echo $ligne['marque'] ?></td>
                    <td><?php echo $ligne['modele'] ?></td>
                    <td><?php echo $ligne['categorie'] ?></td>
                    <td><?php echo $ligne['date_depart'] ?></td>
                    <td><?php echo $ligne['date_arrivee'] ?></td>
                    <td><?php echo $ligne['ville_depart'] ?></td>
                    <td><?php echo $ligne['ville_arrivee'] ?></td>
                    <?php
                    $date = date('Y-m-d');
                    if (strtotime($ligne['date_arrivee']) < strtotime($date)) {
                        $status = 'Terminée';
                    } elseif (strtotime($ligne['date_depart']) > strtotime($date)) {
                        $status = 'A venir';
                    } else {
                        $status = 'En cours';
                    }
                    ?>
                    <td><?php echo $status ?></td>
                </tr>
            <?php
            }
        ?>
        </tbody>
    </table>
</body>
</html>