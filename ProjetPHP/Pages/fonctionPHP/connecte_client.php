<?php
    include_once "../../Outils/Biblio.php";
    $connexion = connexion();
    

    if (!empty($_POST) && !empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $requete = "SELECT * FROM clients WHERE mail = '$email'";
        $resultat = mysqli_query($connexion, $requete);    
        if (mysqli_num_rows($resultat) == 1) {
            $utilisateur = mysqli_fetch_assoc($resultat);
            $hashedPassword = $utilisateur['mot_de_passe'];
            if (password_verify($password, $hashedPassword)) {
                echo "bienvenue";
                $req_id_client = "SELECT id_client from clients WHERE mail ='$email'";
                $req_id_client_res = mysqli_query($connexion, $req_id_client);
                $row = mysqli_fetch_assoc($req_id_client_res);
                $id_client = $row['id_client'];
                if ($id_client == 1) {
                    $url = '../Administration/Admin_accueil.php';
                    header('Location:' .$url);
                    exit();
                }
                else {
                    $url = '../Accueil_connecte.php';
                    session_start();
                    $_SESSION['id_client'] = $id_client;
                    header('Location: ' .$url );   
                    exit();
                }
            } else {
                echo "mdp incorrect";
                session_start();
                $_SESSION['client_connecte'] = true;
                $url = '../Accueil_non_connecte.php?try_connect=1' ;
                header('Location: ' .$url );   
                exit();
            }
        } else {
            echo "utilisateur inconnu";
            session_start();
            $_SESSION['client_connecte'] = true;
            $url = '../Accueil_non_connecte.php?try_connect=2' ;
            header('Location: ' .$url );   
            exit();
        }
    }

?>