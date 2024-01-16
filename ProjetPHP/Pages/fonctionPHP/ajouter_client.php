<?php
    include_once "../../Outils/Biblio.php";
    $connexion = connexion();

    if (!empty($_POST) && !empty($_POST['name-insc']) && !empty($_POST['firstname-insc']) && !empty($_POST['address-insc']) && !empty($_POST['mail-insc']) && !empty($_POST['type_client']) && !empty($_POST['mdp_insc']) && !empty($_POST['confirm_mdp-insc'])) {
        $name = strtoupper($_POST['name-insc']);
        $firstname = $_POST['firstname-insc'];
        $address = $_POST['address-insc'];
        $mail = $_POST['mail-insc'];
        $type_client = $_POST['type_client'];
        $mdp = $_POST['mdp_insc'];
        $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT); 
        if ($_POST['mdp_insc'] === $_POST['confirm_mdp-insc']) {
            

            $existingEmailQuery = "SELECT COUNT(*) as count FROM clients WHERE mail = '$mail'";
            $existingEmailResult = mysqli_query($connexion, $existingEmailQuery);
            $existingEmailRow = mysqli_fetch_assoc($existingEmailResult);
            $emailCount = $existingEmailRow['count'];

            if (preg_match('/\d/', $name)) {
                session_start();
                $_SESSION['nom_nombre'] = true;
                $url = '../Accueil_non_connecte.php?mail=' . $mail . '&firstname=' . $firstname . '&address=' . $address . '&type_client=' . $type_client;
                header('Location: ' .$url );   
                exit();  
            } 
            if (preg_match('/\d/', $firstname)) {
                session_start();
                $_SESSION['prenom_nombre'] = true;
                $url = '../Accueil_non_connecte.php?mail=' . $mail . '&name=' . $name . '&address=' . $address . '&type_client=' . $type_client;
                header('Location: ' .$url );   
                exit();  
            } 
            if ($emailCount > 0) {
                echo "L'adresse e-mail est déjà utilisée. Veuillez en choisir une autre.";
                session_start();
                $_SESSION['client_mail_utilisé'] = true;
                $url = '../Accueil_non_connecte.php?name=' . $name . '&firstname=' . $firstname . '&address=' . $address . '&type_client=' . $type_client;
                header('Location: ' .$url );   
                exit();
            } else {
                $nv_client = "INSERT INTO clients (nom, prenom, adresse, mail, id_type_client, mot_de_passe) VALUES ('$name', '$firstname', '$address', '$mail', '$type_client','$hashedPassword')";
                $go_nv_client = mysqli_query($connexion, $nv_client);         

                if ($go_nv_client) {
                    echo "Nouveau client ajouté avec succès.";
                    session_start();
                    $_SESSION['client_ajoute'] = true;
                    $url = '../Accueil_non_connecte.php?name=' . $name . '&firstname=' . $firstname ;
                    header('Location: ' .$url );   
                    exit();
                } else {
                    echo "Erreur lors de l'ajout du client : " . mysqli_error($connexion);
                }
            }
        } else {    
            session_start();
            $_SESSION['mdp_non_identique'] = true;
            $url = '../Accueil_non_connecte.php?name=' . $name . '&firstname=' . $firstname . '&address=' . $address . '&type_client=' . $type_client . '&mail=' . $mail;
            header('Location: ' .$url );   
            exit();
        }
    }
?>
