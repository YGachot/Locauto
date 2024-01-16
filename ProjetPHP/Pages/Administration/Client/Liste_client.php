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
    <title>Admin | Liste des clients</title>
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
                <th>Id du client</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Adresse</th>
                <th>Mail</th>
                <th>Type de client</th>
                <th>Acceder aux locations du client</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $requete_client = 
            "SELECT clients.* , type_client.*
            FROM clients
            JOIN type_client USING(id_type_client)
            WHERE clients.nom = '".$_POST['selection_client']."'";
            $requete_client_res = mysqli_query($connexion,$requete_client);
            while ($ligne_client = mysqli_fetch_array($requete_client_res)) {
                ?>
                <tr>
                    <td><?php echo $ligne_client['id_client']?></td>
                    <td><?php echo $ligne_client['nom'] ?></td>
                    <td><?php echo $ligne_client['prenom']?></td>
                    <td><?php echo $ligne_client['adresse'] ?></td>
                    <td><?php echo $ligne_client['mail']?></td>
                    <td><?php echo $ligne_client['type_client_libelle'] ?></td>
                    <td>
                        <form action="Liste_location.php" method="post">
                            <input type="hidden" name="id_client" value=" <?php echo $ligne_client['id_client'] ?>">
                            <input type="submit" value="Accéder aux locations du client">
                        </form>
                    </td>
                </tr>
                <?php
            }
        ?>      
        </tbody>
    </table>
</body>
</html>