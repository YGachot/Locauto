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
    <title>Admin | Liste véhicule</title>

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
    <?php
    if ($_POST['selection_type_liste'] == 'tous') { ?>
        <table>
            <thead>
                <tr>
                    <th>Immatriculation</th>
                    <th>Marque</th>
                    <th>Modele</th>
                    <th>Propriétaire</th>
                    <th>Garage</th>
                    <th>Type de vehicule</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $req_vehicule = "SELECT * FROM voitures 
                JOIN clients USING(id_client) 
                JOIN ville_garage USING(id_lieu) 
                JOIN categories USING(id_categorie) 
                JOIN modeles USING(id_modele)
                JOIN marque USING(id_marque)
                ORDER BY marque ASC, modele ASC ";
                $req_vehicule_res = mysqli_query($connexion,$req_vehicule);
                while ($ligne = mysqli_fetch_array($req_vehicule_res)) { 
                    ?>
                    <tr>
                        <td> <?php echo $ligne['immatriculation'] ?></td>
                        <td> <?php echo $ligne['marque'] ?></td>
                        <td> <?php echo $ligne['modele'] ?></td>
                        <td> <?php echo $ligne['nom']. " " .$ligne['prenom']?></td>
                        <td> <?php echo $ligne['ville'] ?></td>
                        <td> <?php echo $ligne['categorie'] ?></td>
                        <td> <img src="../../images/<?php echo $ligne['images'] ?>"></td>
                    </tr>
            </tbody>
            <?php
            }
            ?>
        </table>
    <?php
    }
    ?>
    <?php
    if ($_POST['selection_type_liste'] == 'disponible') { ?>
        <table>
            <thead>
                <tr>
                    <th>Immatriculation</th>
                    <th>Marque</th>
                    <th>Modele</th>
                    <th>Propriétaire</th>
                    <th>Garage</th>
                    <th>Type de vehicule</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $req_vehicule_dispo = 
                "SELECT * , voitures.immatriculation AS voituresimmat FROM voitures
                JOIN clients USING(id_client) 
                JOIN ville_garage USING(id_lieu) 
                JOIN categories USING(id_categorie)
                JOIN modeles USING(id_modele)
                JOIN marque USING(id_marque) 
                LEFT JOIN louer ON voitures.immatriculation = louer.immatriculation
                WHERE (CURRENT_DATE NOT BETWEEN louer.date_depart AND louer.date_arrivee) OR louer.immatriculation IS NULL 
                ORDER BY marque ASC, modele ASC ";
                $req_vehicule_dispo_res = mysqli_query($connexion,$req_vehicule_dispo);
                while ($ligne_dispo = mysqli_fetch_array($req_vehicule_dispo_res)) { 
                    ?>
                    <tr>
                        <td> <?php echo $ligne_dispo['voituresimmat'] ?></td>
                        <td> <?php echo $ligne_dispo['marque'] ?></td>
                        <td> <?php echo $ligne_dispo['modele'] ?></td>
                        <td> <?php echo $ligne_dispo['nom']. " " .$ligne_dispo['prenom']?></td>
                        <td> <?php echo $ligne_dispo['ville'] ?></td>
                        <td> <?php echo $ligne_dispo['categorie'] ?></td>
                        <td> <img src="../../images/<?php echo $ligne_dispo['images'] ?>"></td>
                    </tr>
            </tbody>
            <?php
            }
            ?>
        </table>
    <?php
    }
    ?>
    <?php
    if ($_POST['selection_type_liste'] == 'non_disponible') { ?>
        <table>
            <thead>
                <tr>
                    <th>Immatriculation</th>
                    <th>Marque</th>
                    <th>Modele</th>
                    <th>Propriétaire</th>
                    <th>Garage</th>
                    <th>Type de vehicule</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $req_vehicule_non_dispo = 
                "SELECT * FROM voitures 
                JOIN clients USING(id_client) 
                JOIN ville_garage USING(id_lieu) 
                JOIN categories USING(id_categorie) 
                JOIN modeles USING(id_modele)
                JOIN marque USING(id_marque)
                LEFT JOIN louer ON voitures.immatriculation = louer.immatriculation
                WHERE (CURRENT_DATE BETWEEN louer.date_depart AND louer.date_arrivee)
                ORDER BY marque ASC, modele ASC ";
                $req_vehicule_non_dispo_res = mysqli_query($connexion,$req_vehicule_non_dispo);
                while ($ligne_non_dispo = mysqli_fetch_array($req_vehicule_non_dispo_res)) { 
                    ?>
                    <tr>
                        <td> <?php echo $ligne_non_dispo['immatriculation'] ?></td>
                        <td> <?php echo $ligne_non_dispo['marque'] ?></td>
                        <td> <?php echo $ligne_non_dispo['modele'] ?></td>
                        <td> <?php echo $ligne_non_dispo['nom']. " " .$ligne_non_dispo['prenom']?></td>
                        <td> <?php echo $ligne_non_dispo['ville'] ?></td>
                        <td> <?php echo $ligne_non_dispo['categorie'] ?></td>
                        <td> <img src="../../images/<?php echo $ligne_non_dispo['images'] ?>"></td>
                    </tr>
            </tbody>
            <?php
            }
            ?>
        </table>
    <?php
    }
    ?>
</body>
</html>