<?php
/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 24/05/2019
 * Time: 16:26
 */



function recupTypeComposantExistant(PDO $bdd){
    $statement = $bdd->prepare('SELECT * FROM `typecapteur`');
    $statement->execute();
    return $statement->fetchAll();
}

function recupComposantExistant(PDO $bdd){
    $statement = $bdd->prepare('SELECT * FROM `typecapteur`');
    $statement->execute();
    return $statement->fetchAll();
}

function recupNomCatalogue(PDO $bdd){
    $statement = $bdd->prepare('SELECT nom FROM `catalogue`');
    $statement->execute();
    return $statement->fetchAll();
}

function recupCatalogue(PDO $bdd){
    $statement = $bdd->prepare('SELECT idCatalogue, nom, prix, reference FROM `catalogue`');
    $statement->execute();
    return $statement->fetchAll();
}

function ajoutCatalogue(PDO $bdd,$datasheet,$nom,$prix,$reference){ //Supprime un composant
    $statement = $bdd->prepare(' INSERT INTO `catalogue` (`idCatalogue`, `datasheet`, `nom`, `prix`, `reference`) VALUES (NULL,\''.$datasheet.'\',\''.$nom.'\',\''.$prix.'\',\''.$reference.'\' )  ');
    $statement->execute();
}

function ajoutTypeCapteur(PDO $bdd, $nom, $valeur, $grandeurPhysique){ //Supprime un composant
    $statement = $bdd->prepare(' INSERT INTO `typecapteur` (`idTypeCapteur`, `nom`, `valeur`, `grandeurPhysique`) VALUES (NULL,\''.$nom.'\',\''.$valeur.'\',\''.$grandeurPhysique.'\' )  ');
    $statement->execute();
}

function ajoutComposant(PDO $bdd,$numComposant,$idCatalogue,$idTypeCapteur){
    $statement = $bdd->prepare('INSERT INTO `composant` (`idComposant`, `etatComposant`, `numComposant`, `idCemac`, `idCatalogue`, `idTypeCapteur`) VALUES (NULL, \'0\', \''.$numComposant.'\', NULL, \''.$idCatalogue.'\', \''.$idTypeCapteur.'\') ');
    $statement->execute();
}