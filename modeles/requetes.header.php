<?php
/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 24/05/2019
 * Time: 12:09
 */

function utilisateurEstGestionnaire($bdd,$idUser){
    $statement = $bdd->prepare('SELECT utilisateurs.idType
                                          FROM utilisateurs
                                          WHERE idUtilisateur='.$idUser);
    $statement->execute();
    $val = $statement->fetchAll();
    if ($val[0]['idType'] === "2"){
        return true;
    }
}

function getTypeUser($bdd,$idUser){
    $statement = $bdd->prepare('SELECT utilisateurs.idType
                                          FROM utilisateurs
                                          WHERE idUtilisateur='.$idUser);
    $statement->execute();
    return $statement->fetchAll()[0]['idType'];
}


/*
function estUnAdministrateur(PDO $bdd,$idUser){
    $statement = $bdd->prepare('SELECT utilisateurs.idType
                                          FROM utilisateurs
                                          WHERE idUtilisateur='.$idUser);
    $statement->execute();
    $val = $statement->fetchAll();
    if ($val[0]['idType'] === "0"){
        return true;
    }
    return false;
}
*/