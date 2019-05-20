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
        if (isset ($_GET['idComposant'])){

        }
        else{
            $switch=true;
            //$piece = piecesAppartement($bdd,);
            //$appartement = appartementProprietaire($bdd, $_COOKIE['idUser']);     //BESOIN DU COOKIE ID USER
            //$piece = piecesAppartement($bdd,1); //1 = test
            $_SESSION['id'] = $_GET['id'];
            $appartement = appartementProprietaire($bdd, $_GET['id']); 
            $idAppartUser = recupIdAppartUser($bdd, $_GET['id']); 
            $piece =[];
            for ($i=0;$i<count($appartement);$i++){
                $piece[] =  piecesAppartement($bdd, $idAppartUser[$i][0]);
            }
        }

        $vue='DashBoard/appartement_liste.php';
        break;

    case 'capteurs':
        $switch=true;
        // On a l'id de la piece en variable
        //$piece[] =  piecesAppartement($bdd, $idAppartUser[$i][0]);
        if (isset ($_GET['idComposant'])) {
            supprComposant($bdd, $_GET['idComposant']);
            $cemac = recupIdCemacs($bdd, $_GET['idPiece']);
            $composants = recupIdComposants($bdd, $cemac[0][0]);
            $valeurs = [];
            $infosType = [];
            for ($i = 0; $i < count($composants); $i++) { //Pour chaque composants on va chercher chercher
                $valeurs[] = recupValHexaCapteur($bdd, $composants[$i][0][0]); //Sa valeur en héxa
                $infosType[] = recupInfoComplementaire($bdd, $composants[$i][0][0]); // Ainsi que des information sur le composant(unité/grandeur physique)
            }
            $valeurs = parcourirValeurs($valeurs, $infosType);
        }
        else {
            $cemac = recupIdCemacs($bdd, $_GET['idPiece']);
            $composants = recupIdComposants($bdd, $cemac[0][0]);
            $valeurs = [];
            $infosType = [];
            for ($i = 0; $i < count($composants); $i++) { //Pour chaque composants on va chercher chercher
                $valeurs[] = recupValHexaCapteur($bdd, $composants[$i][0][0]); //Sa valeur en héxa
                $infosType[] = recupInfoComplementaire($bdd, $composants[$i][0][0]); // Ainsi que des information sur le composant(unité/grandeur physique)
            }
            $valeurs = parcourirValeurs($valeurs, $infosType);
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

        if(isset($_SESSION['email']) OR isset($_COOKIE['email'])){
            if(!empty($_SESSION['email']) ){
                $composants=recupComposant();
                foreach ($composants as $key=>$values){

                }
            }
            if(!empty($_COOKIE['email']) ){

            }
        }
        $appart=recupAppartementFromEmail($bdd,'reljgrljerg@gmail.com');
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
                    //var_dump($trameTemp);

                }

            }
        }



        var_dump($trame);
        $vue='Statistic/statistic.php';

        break;
    case 'compte':

        $vue = 'Compte/compte';
        break;
    case 'communaute':
        break;
    
    case 'statistic':
        $vue = 'Statistic/statistic';
        break;



}

if(!$switch){
    $vue='error404.php';
    $alerte="Erreur 404 : la page recherchée n'existe pas.";
    echo $alerte;
}
include('vues/'. $vue);
