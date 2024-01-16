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
    <title>Admin | Nouveau client</title>
</head>
<body>
    <?php
        if (isset($_SESSION['client_ajoute_admin']) && $_SESSION['client_ajoute_admin']) {
            echo "<script>alert('Client ajouté avec succès');</script>";
            $_SESSION['client_ajoute_admin'] = false;
        }
        if(isset($_SESSION['client_mail_utilisé_admin']) && $_SESSION['client_mail_utilisé_admin']) {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('name_client_admin').value ='".$_GET['name']."'
                document.getElementById('firstname_client_admin').value ='".$_GET['firstname']."'
                document.getElementById('adresse_client_admin').value ='".$_GET['address']."'
                var wrong = document.getElementById('wrong_email')
                wrong.classList.add('activate_wrong_email')
            })</script>";
            $_SESSION['client_mail_utilisé_admin'] = false;
        }
        if(isset($_SESSION['nom_nombre_admin']) && $_SESSION['nom_nombre_admin']) {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('mail_client_admin').value ='".$_GET['mail']."'
                document.getElementById('firstname_client_admin').value ='".$_GET['firstname']."'
                document.getElementById('adresse_client_admin').value ='".$_GET['address']."'
                var wrong = document.getElementById('wrong_name')
                wrong.classList.add('activate_wrong_email')
            })</script>";
            $_SESSION['nom_nombre_admin'] = false;
        }
        if(isset($_SESSION['prenom_nombre_admin']) && $_SESSION['prenom_nombre_admin']) {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('mail_client_admin').value ='".$_GET['mail']."'
                document.getElementById('name_client_admin').value ='".$_GET['name']."'
                document.getElementById('adresse_client_admin').value ='".$_GET['address']."'
                var wrong = document.getElementById('wrong_firstname')
                wrong.classList.add('activate_wrong_email')
            })</script>";
            $_SESSION['prenom_nombre_admin'] = false;
        }
    ?>
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
    <h1 id="titreNC">Nouveau client</h1>
    <div class="container_client">
    <form  action="../../fonctionPHP/ajouter_client_admin.php" method="post">
        <div class="input_insertion_client">
            <input type="text" id="name_client_admin" name="name" required spellcheck="false" placeholder="Nom">
        </div>
        <p id="wrong_name" class="wrong_email">Nom invalide</p>
        <div class="input_insertion_client">
            <input type="text" id="firstname_client_admin" name="firstname" required spellcheck="false" placeholder="Prénom">
        </div>
        <p id="wrong_firstname" class="wrong_email">Prénom invalide</p>
        <div class="input_insertion_client">
            <input type="text" id="adresse_client_admin" name="address" required spellcheck="false" placeholder="Adresse">
        </div>
        <div class="input_insertion_client">
            <input type="email" id="mail_client_admin" name="mail" required spellcheck="false" placeholder="E-mail">
        </div>
        <p id="wrong_email" class="wrong_email">Adresse mail déjà utilisée</p>
        <div class="input_insertion_client">
            <input type="password" name="mdp" required spellcheck="false" placeholder="Mot de passe">
        </div>
        <div class="input_insertion_client">
        <select name="type_client" required>
            <option value="" hidden selected>Choisissez le type du client</option>
            <?php
            $req_type_client = "SELECT * FROM type_client";
            $req_type_client_res = mysqli_query($connexion, $req_type_client);
            while ($ligne_type_client = mysqli_fetch_array($req_type_client_res)) {
                echo '<option value="' . $ligne_type_client['id_type_client'] . '"> ' . $ligne_type_client['type_client_libelle'] . ' </option>';
            }
            ?>
        </select>
        </div>
    <input id="btn_inscription_client" type="submit" value="Inscription">
    </form>
    </div> 
</body>
</html>