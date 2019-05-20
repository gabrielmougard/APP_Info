<?php

/**
 * Le contrôleur :
 * - définit le contenu des variables à afficher
 * - identifie et appelle la vue
 */ 

/**
 * Contrôleur de l'authentification de l'utilisateur
 */

// on inclut le fichier modèle contenant les appels à la BDD
include('modeles/requetes.utilisateurs.php');

// si la fonction n'est pas définie, on choisit d'afficher l'accueil
if (!isset($_GET['fonction']) || empty($_GET['fonction'])) {

    $function = "accueil";
} else {
    $function = $_GET['fonction'];
}
session_start();

$switch=false;

switch ($function) {

    case 'inscription':
        // login d'un nouvel utilisateur
        $alerte = false;
        $incrit = false;
        $switch = true;
        $etat = true;
        // Cette partie du code est appelée si le formulaire a été posté
        if (isset($_POST['username']) and isset($_POST['password']) and isset($_POST['confirmPassword']) and isset($_POST['email'])) {

            //Username
            if (empty($_POST['username'])) {
                $etat = false;
                $alerte = "Indiquez votre Nom";
                echo $alerte;

            }
            //Mot de passe
            if (empty($_POST['password']) or !password($_POST['password'])) {
                $etat = false;
                $alerte = "Mot de passe incorrect ";
                echo $alerte;

            }
            if (!estUnMotDePasse($_POST['password'])) {
                $etat = false;
                $alerte = "Ce n'est pas un mot de passe";
                echo $alerte;

            }
            if ($_POST['password'] !== $_POST['confirmPassword']) {
                $etat = false;
                $alerte = "Mot de passe non similaires";
                echo $alerte;

            }

            //Email
            if (empty($_POST['email']) or !email($_POST['email'])) {
                $etat = false;
                $alerte = "Email invalide";
                echo $alerte;
            }

            if (!existeEmail($bdd, $_POST['email'])) {
                $etat = false;
                $alerte = "Email déjà utilisé";
                echo $alerte;
            }

            //CGU
            if (!isset($_POST['CGU'])) {
                $etat = false;
                $alerte = "Vous n'avez pas accepter les Conditions Générales D'utilisation";
                echo $alerte;
            }

            $retour = false;

            if ($etat) {

                $retour = inscription($bdd, $_POST['username'], $_POST['email'], $_POST['password'], true);
            }
            if ($retour) {
                $inscrit = "Inscription réussie";
                $vue = 'authentification/verifiezMail';
            } else {
                $inscrit = "L'inscription dans la BDD n'a pas fonctionné";
                $vue = 'authentification/inscription';
            }

        } else {
            $vue = 'authentification/inscription';
        }

        break;

    case 'connexion':

        //cookie identification
        if (isset($_COOKIE["email"]) && isset($_COOKIE["password"])) {
            $conn = connexionWithoutHash($bdd, $_COOKIE["email"], $_COOKIE["password"]);
            if ($conn["connected"]) {
                header("Location: http://localhost/APP_Info-master/index.php?cible=dashboard&fonction=appartementPiece&id=".$conn["id"]);
            }
        }

        //


        $liste = recupereTousUtilisateurs($bdd);
        $switch = true;
        $alerte = false;
        $etat = true;

        //Si il n'y a pas d'utilisateur dans la bdd
        if (empty($liste)) {
            $alerte = "Aucun utilisateur inscrit pour le moment";
            $vue = 'authentification/accueil';
        }



        if (isset($_POST['email']) and isset($_POST['password'])) {

            //Email
            if (empty($_POST['email']) or !email($_POST['email'])) {
                $etat = false;
                $alerte = "Email invalide";
                echo $alerte;
            }

            //Password
            if (empty($_POST['password'])) {
                $etat = false;
                $alerte = "Mot de passe incorrect ";
                echo $alerte;

            }
            if (!estUnMotDePasse($_POST['password'])) {
                $etat = false;
                $alerte = "Ce n'est pas un mot de passe";
                echo $alerte;

            }

            //RememberME
            $remember = false;
            if (!isset($_POST['remember_me'])) {
                $remember = true;
            }

            $retour = false;
            if ($etat) {
                $conn = connexion($bdd, $_POST['email'], $_POST['password'], $remember);
                $retour = $conn["connected"];
            }

            if ($retour) {

                $_SESSION['id'] = $conn["id"];
                header("Location: http://localhost/APP_Info-master/index.php?cible=dashboard&fonction=appartementPiece&id=".$conn["id"]);


            } else {
                $alerte = 'Erreur de champs';
                $vue = 'authentification/login';
            }

        }
        else {
            $vue = 'authentification/login';
        }
        break;


        case 'logout':
            $switch = true;
            $vue = 'authentification/accueil';
            if (session_status() == PHP_SESSION_ACTIVE) {
                $IdUtilisateur = session_id();
                logOut($IdUtilisateur);
            }
            break;
    // si aucune fonction ne correspond au paramètre function passé en GET
    //$vue = "erreur404";
    //$title = "error404";
    //$message = "Erreur 404 : la page recherchée n'existe pas.";


    case 'forgotPassword':

        $switch = true;
        $alerte = false;

        if (isset($_POST['email'])) {
            if (!empty($_POST['email'])) {
                if (!existeEmail($bdd, $_POST['email'])) {//existeEmail($bdd, $_POST['email'])

                    $emailMdpOublie = $_POST['email'];
                    passwordOublie($bdd, $emailMdpOublie);
                    $vue = 'authentification/verifiezMail';
                } else {
                    $alerte = 'Aucun email indiquer';
                    echo $alerte;
                    $vue = 'authentification/forgotPassword';
                }
            } else {
                $alerte = 'Aucun email indiquer';
                echo $alerte;
                $vue = 'authentification/forgotPassword';
            }
        }

        else {
            $vue = 'authentification/forgotPassword';
        }
        break;

    case 'confirmInscription':

        if (isset($_GET['code']) and !empty($_GET['code'])) {
            $token = $_GET['code'];
            if (tokenEmailVerificationOK($bdd, $_GET['email'], $token)) {
            
                $vue = 'authentification/confirmInscription';
                $switch = true;
            } else {
                echo "Token faux";
                $vue = 'error404';
            }

        } else {

            $vue = 'authentification/confirmInscription';
        }

        break;

    case 'accueil':
        $switch = true;
        $vue = 'authentification/accueil';
        break;

}




if(!$switch){
    $vue='error404';
    $alerte="Erreur 404 : la page recherchée n'existe pas.";
    echo $alerte;
}
// si aucune fonction ne correspond au paramètre function passé en GET
//$vue = "erreur404";
//$title = "error404";
//$message = "Erreur 404 : la page recherchée n'existe pas.";
    //include('vues/templates/header.php');
    include 'vues/' . $vue . '.php';
    //include('vues/templates/footer.php');
