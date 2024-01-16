<?php
    include_once "../../Outils/Biblio.php";
    $connexion = connexion();

    if (!empty($_POST) && !empty($_POST['name']) && !empty($_POST['firstname']) && !empty($_POST['address']) && !empty($_POST['mail']) && !empty($_POST['type_client']) && !empty($_POST['mdp'])) {
        $name = strtoupper($_POST['name']);
        $firstname = $_POST['firstname'];
        $address = $_POST['address'];
        $mail = $_POST['mail'];
        $type_client = $_POST['type_client'];
        $mdp = $_POST['mdp'];
        $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT); 
        
        $existingEmailQuery = "SELECT COUNT(*) as count FROM clients WHERE mail = '$mail'";
        $existingEmailResult = mysqli_query($connexion, $existingEmailQuery);
        $existingEmailRow = mysqli_fetch_assoc($existingEmailResult);
        $emailCount = $existingEmailRow['count'];

        if (preg_match('/\d/', $name)) {
            session_start();
            $_SESSION['nom_nombre_admin'] = true;
            $url = '../Administration/Insertion/Client.php?mail=' . $mail . '&firstname=' . $firstname . '&address=' . $address . '&type_client=' . $type_client;
            header('Location: ' .$url );   
            exit();  
        } 
        if (preg_match('/\d/', $firstname)) {
            session_start();
            $_SESSION['prenom_nombre_admin'] = true;
            $url = '../Administration/Insertion/Client.php?mail=' . $mail . '&name=' . $name . '&address=' . $address . '&type_client=' . $type_client;
            header('Location: ' .$url );   
            exit();  
        } 
        if ($emailCount > 0) {
            echo "L'adresse e-mail est déjà utilisée. Veuillez en choisir une autre.";
            session_start();
            $_SESSION['client_mail_utilisé_admin'] = true;
            $url = '../Administration/Insertion/Client.php?name=' . $name . '&firstname=' . $firstname . '&address=' . $address . '&type_client=' . $type_client;
            header('Location: ' .$url );   
            exit();
        } else {
            $nv_client = "INSERT INTO clients (nom, prenom, adresse, mail, id_type_client, mot_de_passe) VALUES ('$name', '$firstname', '$address', '$mail', '$type_client','$hashedPassword')";
            $go_nv_client = mysqli_query($connexion, $nv_client);         

            if ($go_nv_client) {
                echo "Nouveau client ajouté avec succès.";
                session_start();
                $_SESSION['client_ajoute_admin'] = true;
                $url = '../Administration/Insertion/Client.php?name=' . $name . '&firstname=' . $firstname ;
                header('Location: ' .$url );   
                exit();
            } else {
                echo "Erreur lors de l'ajout du client : " . mysqli_error($connexion);
            }
        }
    }
?>
