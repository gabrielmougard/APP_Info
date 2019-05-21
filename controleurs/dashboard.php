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


if (!isset($_GET['fonction']) || empty($_GET['fonction'])) {

    $function = "accueil";
} else {
    $function = $_GET['fonction'];
}
session_start();
$switch=false;

switch ($function) {
    case 'appartementPiece':
            $switch = true;

            if (isset ($_POST['supprIdAppart'])){
                supprAppartement($bdd,$_POST['supprIdAppart']);
            }
            if(isset($_POST['supprIdPiece'])){
                supprPiece($bdd,$_POST['supprIdPiece']);
            }
            if(isset($_POST['adresse'])&& isset($_POST['superficie'])){
                ajouterAppartement($bdd,$_POST['adresse'],$_POST['superficie'],1); // Remplacer 1
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
        // On a l'id de la piece en variable
        if (isset ($_GET['idComposant'])) {
            supprComposant($bdd, $_GET['idComposant']);
        }
        if(isset($_GET['idPiece'])){
            $cemac = recupIdCemacs($bdd, $_GET['idPiece']);
            if ($cemac!=[]){
                $composants = recupIdComposants($bdd, $cemac[0][0]);
                $valeurs = [];
                $infosType = [];
                for ($i = 0; $i < count($composants); $i++) { //Pour chaque composants on va chercher chercher
                    $valeurs[] = recupValHexaCapteur($bdd, $composants[$i][0][0]); //Sa valeur en héxa
                    $infosType[] = recupInfoComplementaire($bdd, $composants[$i][0][0]); // Ainsi que des information sur le composant(unité/grandeur physique)
                }
                $valeurs = parcourirValeurs($valeurs, $infosType);
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
        $capteurId = $_GET['capteurId'];
        $newValue = $_GET['newValue'];
        $numComposant = $_GET['numComposant'];
        $vue = false; // Ne regénère plus de vue
        envoieTrameDansBDD($bdd, $newValue, $numComposant, $capteurId);
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

        $vue = 'Compte/compte';
        $nom=recupNom(1, $bdd);
        $prenom=recupPrenom(1,$bdd);
        $email=recupEmail(1,$bdd);
        $switch=true;

        $vue = 'Compte/compte';
        break;

    case 'modifCompte':
        $nom=recupNom(1, $bdd);
        $prenom=recupPrenom(1,$bdd);
        $email=recupEmail(1,$bdd);
        $etat = true;

        if (isset($_POST['nom']) and isset($_POST['prenom']) and isset($_POST['email'])) {

            //Verification des donnees rentree
            /*  if($_POST['password'] !== $password){
                  $etat = false;
                  $alerte = "Ce n'est pas votre mot de passe actuel";
                  echo $alerte;
              }

              if (!estUnMotDePasse($_POST['newpassword'])) {
                  $etat = false;
                  $alerte = "Ce n'est pas un mot de passe";
                  echo $alerte;

              }
              if ($_POST['newpassword'] !== $_POST['confirmPassword']) {
                  $etat = false;
                  $alerte = "Mot de passe non similaires";
                  echo $alerte;
              }
*/
            //Email
            if (!email($_POST['email'])) {
                $etat = false;
                $alerte = "Email invalide";
                echo $alerte;
            }

            $retour = false;

            if ($etat) {
                echo "etat true";
                update(1, $bdd, $_POST['nom'], $_POST['prenom'], $_POST['email']);
                $retour = true;
            }

            if ($retour) {
                echo "Modifications réussies";
                header("Location: http://localhost:63342/APP_Info/index.php?cible=dashboard&fonction=compte");
            } else {
                echo "Les modifications n'ont pas fonctionnées";
                $vue = 'Compte/modifCompte';
            }
        }
        $switch=true;
        $vue = 'Compte/modifCompte.php';
        break;

    case 'communaute':
        break;
    
    case 'statistic':
        $vue = 'Statistic/statistic';
        break;
    case 'listeUtilisateurs':
        if (estUnAdministrateur($bdd,1)) { // Test
            $switch = true;
        }
        $utilisateurs=recupUtilisateurs($bdd);
        $vue = 'admin/listeUtilisateurs.php';
        break;
}

if(!$switch){
    $vue='error404.php';
    $alerte="Erreur 404 : la page recherchée n'existe pas.";
    echo $alerte;
}
include('vues/'. $vue);
