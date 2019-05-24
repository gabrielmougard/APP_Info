<?php
/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 23/05/2019
 * Time: 19:34
 */
include("connexion.php");

function recupTemperatureMaxGestionnaire($bdd){
    $statement = $bdd->prepare('SELECT systeme_chauffage.tempMaxGestionnaire FROM `systeme_chauffage`');
    $statement->execute();
    return $statement->fetchAll()[0][0];
}

function recupTemperatureMaxUtilisateur($bdd){
    $statement = $bdd->prepare('SELECT systeme_chauffage.tempMaxUtilisateur FROM `systeme_chauffage`');
    $statement->execute();
    return $statement->fetchAll()[0][0];
}

function modifierTempUser($bdd,$temp){
    if (valeurUtilisateurValide($bdd,$temp)){
        $statement = $bdd->prepare('UPDATE `systeme_chauffage` SET `tempMaxUtilisateur` = '.$temp.' WHERE `systeme_chauffage`.`idChauffage` = 1');
        $statement->execute();
    }
}

function valeurUtilisateurValide($bdd,$tempUtilisateur){
    $statement = $bdd->prepare('SELECT systeme_chauffage.tempMaxGestionnaire FROM `systeme_chauffage`');
    $statement->execute();
    $ges = $statement->fetchAll()[0][0];
    if($tempUtilisateur <= $ges){
        return true;
    }
    else{
        return false;
    }
}

function modifierTempGest($bdd,$temp){
    $statement = $bdd->prepare('UPDATE `systeme_chauffage` SET `tempMaxGestionnaire` = '.$temp.' WHERE `systeme_chauffage`.`idChauffage` = 1');
    $statement->execute();
    $statement = $bdd->prepare('SELECT systeme_chauffage.tempMaxGestionnaire FROM `systeme_chauffage`');
    $statement->execute();
    $tempUtil = $statement->fetchAll()[0][0];
    if ($tempUtil > $temp){
        $statement = $bdd->prepare('UPDATE `systeme_chauffage` SET `tempMaxUtilisateur` = '.$temp.' WHERE `systeme_chauffage`.`idChauffage` = 1');
        $statement->execute();
    }

}


