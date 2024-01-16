<?php
    include_once "../../../Outils/Biblio.php";
    $connexion = connexion();
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../Index_style.css" rel="stylesheet">
    <title>Admin | Liste véhicules</title>
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
    $_SESSION['id_client'] = $_POST['mail_client'];
    $req = "SELECT voitures.*, marque.*, modeles.*
    FROM voitures
    JOIN modeles USING(id_modele)
    JOIN marque USING(id_marque)
    WHERE voitures.immatriculation NOT IN (
        SELECT immatriculation
        FROM louer
        WHERE (date_depart <= '".$_POST['date_depart']."' AND date_arrivee >= '".$_POST['date_arrivee']."')
           OR (date_arrivee >= '".$_POST['date_depart']."' AND date_depart <= '".$_POST['date_depart']."')
    )
    AND voitures.id_lieu = ".$_POST['lieu_depart'];

    if ($_POST['lieu_depart'] != $_POST['lieu_arrivee']) {
        $lieu_dif = 1;
    }
    else {
        $lieu_dif = 0;
    }
    echo '<div id="lieu-dif" data-lieu-dif="' . $lieu_dif . '"></div>';

    echo '<div id="id_lieu_depart" data-id_lieu_depart="' . $_POST['lieu_depart'] . '"></div>';
    echo '<div id="id_lieu_arrivee" data-id_lieu_arrivee="' . $_POST['lieu_arrivee'] . '"></div>';

    $date_depart = $_POST['date_depart'];
    echo '<div id="date_dep" data-date-dep="' . $date_depart .'"></div>';

    $date_arrivee = $_POST['date_arrivee'];
    echo '<div id="date_arr" data-date-arr="' . $date_arrivee .'"></div>';

    $resultat_liste_tri = mysqli_query($connexion, $req);
    ?>
    <div class = "liste_voiture_triee">
    <?php
    while ($ligne_tri_liste = mysqli_fetch_array($resultat_liste_tri)) {
        $immatriculation = str_replace(' ', '%', $ligne_tri_liste['immatriculation']);
        echo "<div class='voiture_triee' data-immatriculation='" . $immatriculation . "'>";
        echo "<br>";
        echo "<p class='content_liste_triee'>" . $ligne_tri_liste['immatriculation'] . "</p>";
        echo "<br>";
        echo "<p class='content_liste_triee'>" . $ligne_tri_liste['marque'] . "</p>";
        echo "<br>";        
        echo "<p class='content_liste_triee'>" . $ligne_tri_liste['modele'] . "</p>";
        echo "<br>";
        echo "<img class='content_liste_triee' src='../../images/" . $ligne_tri_liste['images'] . "'>";
        echo "</div>";
    }
    ?>
    </div>
    <script src="../../fonctionJS/Liste_triee.js"></script>
</body>
</html>