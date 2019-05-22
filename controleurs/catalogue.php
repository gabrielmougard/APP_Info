<?php
include('modeles/requetes.catalogue.php');

if (!isset($_GET['fonction']) || empty($_GET['fonction'])) {

    $function = "accueil";
} else {
    $function = $_GET['fonction'];
}
session_start();
$switch=false;

switch ($function) {
    case 'catalogue':
        //$piece = piecesAppartement($bdd,);
        //$appartement = appartementProprietaire($bdd, $_COOKIE['idUser']);     //BESOIN DU COOKIE ID USER
        //$piece = piecesAppartement($bdd,1); //1 = test
        $produits = nomPrixAllProduits($bdd);
        $allId = getIdAllProduits($bdd);
        $vue = 'Catalogue/catalogue_vue.php';
        break;

    case 'datasheet':
        // On a l'id du produit en variable
        if (isset($_GET[''])) {
            $infosProduit = datasheetProduit($bdd, 1);
            $vue='Catalogue/datasheet_vue.php';
        }
     break;

}

include'vues/'. $vue;

?>