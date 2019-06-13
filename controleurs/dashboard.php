<?php
/**
 * Le contrôleur :
 * - définit le contenu des variables à afficher
 * - identifie et appelle la vue
 */
/**
 * Contrôleur des dashboard appartement/pièces/capteurs
 */

include('modeles/requetes.dashboard.php');
include ('modeles/requetes.utilisateurs.php');
include('modeles/requetes.chauffage.php');
include('modeles/requetes.header.php');
include('modeles/requetes.gestionStock.php');
include('modeles/requetes.logs.php');


if (!isset($_GET['fonction']) || empty($_GET['fonction'])) {

    $function = "accueil";
} else {
    $function = $_GET['fonction'];
}
session_start();
$switch=false;


$nav = "";

switch (getTypeUser($bdd,$_SESSION['id'])){
    default:
        break;
    case 0: //Administrateur

        $nav = "<li id=\"nav-listeUtilisateur\"><a href=\"index.php?cible=dashboard&fonction=listeUtilisateurs\">[ADMIN] Liste Utilisateurs</a></li>";


        $nav = "<li id=\"nav-listeUtilisateur\"><a href=\"index.php?cible=dashboard&fonction=listeUtilisateurs\">[ADMIN] Liste Utilisateurs</a></li>

                ";
        break;

    case 1: //Utilisateur = cas par défaut
        $nav="";
        break;
    case 2: //Gestionnaire
        $nav = "<li id=\"nav-ChauffageGestionnaire\"><a href=\"index.php?cible=dashboard&fonction=chauffageGestionnaire\">[GESTIONNAIRE] Chauffage</a></li>

                ";
        break;
    case 3: //Gestion Stock
        $nav = "<li id=\"nav-GestionStock\"><a href=\"index.php?cible=dashboard&fonction=gestionStock\">[GESTION STOCK] Gestion Stock</a></li>

                ";
        break;
}

switch ($function) {
    case 'testLogs':
        $data=recupLogsBrut();
        $data_tab=decoupeLogsBrut($data);

        break;
    case 'appartementPiece':
        $switch = true;
        if (isset ($_POST['supprIdAppart'])){
            supprAppartement($bdd,$_POST['supprIdAppart']);
        }
        if(isset($_POST['supprIdPiece'])){
            supprPiece($bdd,$_POST['supprIdPiece']);
        }
        if(isset($_POST['adresse'])&& isset($_POST['superficie'])){
            ajouterAppartement($bdd,$_POST['adresse'],$_POST['superficie'],$_SESSION['id']);
        }
        if(isset($_POST['nom'])&& isset($_POST['idAppartement'])&& isset($_POST['numSerie'])){
            ajouterPiece($bdd,$_POST['nom'],$_POST['idAppartement'],$_POST['numSerie']);
        }
        $appartement = appartementProprietaire($bdd, $_SESSION['id']);
        $idAppartUser = recupIdAppartUser($bdd, $_SESSION['id']);
        $piece =[];
        for ($i=0;$i<count($appartement);$i++){
            $piece[] =  piecesAppartement($bdd, $idAppartUser[$i][0]);
        }
        $vue='DashBoard/appartement_liste.php';
        break;
    case 'capteurs':
        $switch=true;
        //$composants=[];
        //$infosType=[];
        //$valeurs=[];
        // On a l'id de la piece en variable
        if (isset ($_GET['sppridComposant'])) {
            supprComposant($bdd, $_GET['sppridComposant']);
        }
        if(isset($_GET['idPiece'])){
            $cemac = recupIdCemacs($bdd, $_GET['idPiece']);

            if ($cemac!=[]){
                $composants = recupIdComposants($bdd, $cemac[0]['idCemac']);
                $infosType = [];
                $valeurs = [];
                for ($i = 0; $i < count($composants); $i++) { //Pour chaque composants on va chercher chercher
                    $valeurs[] = recupValHexaCapteur($bdd, $composants[$i]['idComposant']); //Sa valeur en héxa

                    $infosType[]= recupInfoComplementaire($bdd, $composants[$i][0]); // Ainsi que des information sur le composant(unité/grandeur physique)

                }
                if($valeurs!=[]){
                    $valeurs[] = parcourirValeurs($valeurs, $infosType);
                }
            }
            else{
                $composants=[];
            }
        }



        $vue='DashBoard/capteurs.php';
        break;
    case 'login':
        $switch=true;
        break;

    case 'update_database':
        $switch = true;
        //$capteurId = $_GET['capteurId'];
        //$newValue = $_GET['newValue'];
        //$numComposant = $_GET['numComposant'];
        $vue = false; // Ne regénère plus de vue
        envoieTrameDansBDD($bdd, 1, 1, 1);
        uplink(1);
        break;

    case 'ajouterComposant':
        break;

    case 'supprComposant':
        $switch = true;

        $vue = False;
        break;

    case 'logout':
        $switch=true;
        break;
    case 'catalogue':
        $switch=true;
        break;

    case 'tableau de bord':
        $switch=true;
        break;
    case 'statistiques':
        $switch=true;
        include('modeles/requetes.statistiques.php');

        if(isset($_SESSION['id'])){
            if(!empty($_SESSION['id']) ){
                $appart=recupAppartementFromId($bdd,$_SESSION['id']);
                $piece=array();
                $composants=array();
                $trame=array();
                if(isset($_GET['appartSelect']) & !empty($_GET['appartSelect'])) {
                    $piece=recupPieceFromAppart($bdd,$_GET['appartSelect']);
                    if (isset($_GET['pieceSelect']) & !empty($_GET['pieceSelect'])) {
                        $composants=recupComposantFromPiece($bdd,$_GET['pieceSelect']);
                        foreach ($composants as $key=>$values){
                            $trameTemp=array($values[1]);
                            $trameTemp=array_merge($trameTemp,recupTrameFromComposant($bdd,$values[0]));
                            $trame=array_merge($trame,[$trameTemp]);


                        }

                    }
                }
            }
        }



        $vue='Statistic/statistic.php';

        break;
    case 'compte':

        if(isset($_SESSION['id'])) {
            $nom = recupNom($_SESSION['id'], $bdd);
            $prenom = recupPrenom($_SESSION['id'], $bdd);
            $email = recupEmail($_SESSION['id'], $bdd);
        }
        $switch=true;

        $vue = 'Compte/compte.php';
        break;

    case 'modifCompte':
        $nom=recupNom($_SESSION['id'], $bdd);
        $prenom=recupPrenom($_SESSION['id'],$bdd);
        $email=recupEmail($_SESSION['id'],$bdd);
        $etat = true;


       if (isset($_POST['nom']) and isset($_POST['prenom']) and isset($_POST['email'])) {

         if (empty($_POST['nom']) or empty($_POST['prenom']) or empty($_POST['email'])){
                $etat = false;
                $alerte = "Renseigner les champs vides";
                echo $alerte;
            }

            //Email
            if (!email($_POST['email'])) {
                $etat = false;
                $alerte = "Email invalide";
                echo $alerte;
            }

            $retour = false;
            if ($etat) {
                echo "etat true";
                update($_SESSION['id'], $bdd, $_POST['nom'], $_POST['prenom'], $_POST['email']);
                $retour = true;
            }

            if ($retour) {
                echo "Modifications réussies";
               header("Location: http://localhost/APP_Info-master/index.php?cible=dashboard&fonction=compte");
            } else {
                echo "Les modifications n'ont pas fonctionné";
                $vue = 'Compte/modifCompte.php';
            }
        }

        $switch=true;
        $vue = 'Compte/modifCompte.php';
        break;


    case 'modifMdp':

        $etat = true;
        if (!empty($_POST['newPassword']) and !empty($_POST['confirmPassword'])) {

            if (!password($_POST['newPassword'])) {
                $etat = false;
                $alerte = "Mot de passe incorrect ";
                echo $alerte;
            }

            if (!estUnMotDePasse($_POST['newPassword'])) {
                $etat = false;
                $alerte = "Ce n'est pas un mot de passe";
                echo $alerte;
            }

            if ($_POST['newPassword'] !== $_POST['confirmPassword']) {
                $etat = false;
                $alerte = "Mot de passe non similaires";
                echo $alerte;
            }

            $retour = false;
            if ($etat) {
                echo "etat true";
                updatePassword($_SESSION['id'], $bdd, $_POST['newPassword']);
                $retour = true;
            }

            if ($retour) {
                echo "Modifications réussies";
                header("Location: http://localhost/APP_Info-master/index.php?cible=dashboard&fonction=compte");
            } else {
                echo "Les modifications n'ont pas fonctionnées";
                $vue = 'Compte/modifCompte.php';
            }
        }

        $switch=true;
        $vue = 'Compte/modifMdp.php';
        break;


    case 'communaute':
        break;
    
    case 'statistic':
        $vue = 'Statistic/statistic';
        break;
    case 'listeUtilisateurs':
        if (estUnAdministrateur($bdd,$_SESSION['id'])){ //On verifie que c'est un admin
            $switch = true;
            $utilisateurs=recupUtilisateurs($bdd);
            $vue = 'Admin/listeUtilisateurs.php';
        }
        break;
    case 'chauffage':
        if (isset ($_POST['modifTempUser'])){
            modifierTempUser($bdd,$_POST['modifTempUser']);
        }
        $switch = true;
        $tempGest=recupTemperatureMaxGestionnaire($bdd);
        $tempUser=recupTemperatureMaxUtilisateur($bdd);
        $vue = 'Chauffage/chauffageUtilisateur.php';
        break;
    case 'chauffageGestionnaire':
        if (estUnGestionnaire($bdd,$_SESSION['id'])){
            if (isset ($_POST['modifTempGes'])){
                modifierTempGest($bdd,$_POST['modifTempGes']);
            }
            $switch = true;
            $tempGest=recupTemperatureMaxGestionnaire($bdd);
            $vue = 'Chauffage/chauffageGestionnaire.php';
        }
    break;
    case 'gestionStock':
        if (estUnGestionStock($bdd,$_SESSION['id'])){ // On verifie que c'est un un respo
            if (isset ($_POST['datasheet'])&&isset ($_POST['nom']) &&isset ($_POST['prix'])&&isset ($_POST['reference'])){ // Ajout catalogue
                ajoutCatalogue($bdd,$_POST['datasheet'],$_POST['nom'],$_POST['prix'],$_POST['reference']);
            }
            if (isset ($_POST['nomType'])&&isset ($_POST['valeur']) &&isset ($_POST['grandeurPhysique'])){ // Ajout catalogue
                ajoutTypeCapteur($bdd,$_POST['nomType'],$_POST['valeur'],$_POST['grandeurPhysique']);
            }
            if (isset ($_POST['numComposant'])&&isset ($_POST['idCatalogue']) &&isset ($_POST['idTypeCapteur'])){ // Ajout catalogue
                ajoutComposant($bdd,$_POST['numComposant'],$_POST['idCatalogue'],$_POST['idTypeCapteur']);
            }

            $typeComposantsExistant = recupTypeComposantExistant($bdd);
            $nomCatalogue = recupNomCatalogue($bdd);
            $catalogue = recupCatalogue($bdd);
            $composantsExistant = recupComposantExistant($bdd);

        }   $switch = true;
        $vue = 'GestionStock/GestionStock.php';
        break;

    case 'livechart':
        $switch = true;
        header("Content-type: text/json");
        $x = time()*1000;
        $y = rand(0,100);
        $ret = array($x,$y);
        echo json_encode($ret);
        $vue = "Statistic/statistic.php";
        break;

//$ret = array($x,$y);
}

if(!$switch){
    $vue='error404.php';
    $alerte="Erreur 404 : la page recherchée n'existe pas.";
    echo $alerte;
}
include('vues/'. $vue);
