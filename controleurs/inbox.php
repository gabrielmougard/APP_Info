<?php

/**
 * Le contrôleur :
 * - définit le contenu des variables à afficher
 * - identifie et appelle la vue
 */

/**
 * Contrôleur de de la boîte mail utilisateur
 */

// on inclut le fichier modèle contenant les appels à la BDD
include('modeles/requetes.inbox.php');

// si la fonction n'est pas définie, on choisit d'afficher l'accueil
if (!isset($_GET['fonction']) || empty($_GET['fonction'])) {

    $function = "accueil";
} else {
    $function = $_GET['fonction'];
}
session_start();

$switch=false;

$nav = "";
switch ($function) {

    case 'mails':
        $switch = true;
        //affiche la liste des fils (page d'accueil de la inbox)
        // on récupère l'ID de l'utilisateur connecté (stocké dans la SESSION)
        // pour lui afficher ses Mails

        //1) appel au modèle
        $res = retrieveMails($bdd,$_GET["uid"],$_GET["p"]);
        $_SESSION["threadList"] = $res[0];
        $_SESSION["maxPages"] = $res[1];
        $_SESSION["limit"] = $res[2];
        $vue = "Mails/mails";

        break;


    case 'thread':
        $switch = true;

        $id = $_GET["idUser"];
        $idTicket = $_GET["idTicket"];
        //var_dump($idTicket);
        //var_dump($_GET["idMsg"]);
        $res = retrieveDiscussionThread($bdd,$idTicket);
        $vue = "Mails/thread";
        break;

    case 'msg':
        //soit pour démarrer un nouveau fil soit pour répondre à un fil actuel
        $switch = true;

        $new = $_GET["new"];
        //$_SESSION["new"] = $new;

        $vue = "Mails/writeMessage";

        break;

    case 'remove':
        // efface un mail dans les discussions
        $switch = true;

        break;

    case 'add':
        $switch = true;
        //add a message (when clicked to send in the form)
        $data["idUser"] = $_SESSION["id"];
        $data["newMessage"] = $_POST["new"];
        $data["content"] = $_POST["content"];
        $data["subject"] = $_POST["subject"];
        $data["idTicket"] = $_POST["idTicket"];
        $data["ouvert"] = '0';


        //model stuff
        $res = writeMessage($bdd,$data);
        //vue Mails/mails.php : with an alert saying that it has been sent

        if($res) {
            header('Location: http://localhost/APP_Info-master/index.php?cible=inbox&fonction=mails&uid='.$_SESSION['id'].'&p=1');
        }
        else {
            $vue = "Mails/writeMessage";
        }

    // si aucune fonction ne correspond au paramètre function passé en GET
    //$vue = "erreur404";
    //$title = "error404";
    //$message = "Erreur 404 : la page recherchée n'existe pas.";
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