<?php
/**
 * Created by PhpStorm.
 * User: Mila
 * Date: 07/05/2019
 * Time: 13:33
 */
include("connexion.php");
function nomPrixAllProduits(PDO $bdd){ //Retourne le catalogue avec tout ses produits (PDO)
    $statement = $bdd->prepare('SELECT nom, prix FROM catalogue');
    $statement->execute();
    return $statement->fetchAll();
}

function datasheetProduit(PDO $bdd, $idCatalogueCourant) { //Retourne la datasheet et la référence du produit (PDO, int)
    $statement = $bdd->prepare('SELECT datasheet, reference FROM ' . 'catalogue' .
        ' WHERE ' . 'catalogue.idCatalogue=' . $idCatalogueCourant);
    $statement->execute();
    return $statement->fetchAll();

}
function getIdAllProduits(PDO $bdd) { //Retourne les id des produits
    $statement = $bdd->prepare('SELECT idCatalogue FROM ' . 'catalogue');
    $statement->execute();
    return $statement->fetchAll();
}
?>