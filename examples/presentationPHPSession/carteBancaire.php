<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 25/03/19
 * Time: 11:01
 */

function isInDb($numCb,$crypto) {


    //la valeur enregistrée est : numCb = 123456789
    //                            crypto = 999


    try{
        $bdd = new PDO('mysql:host=localhost:3306;dbname=carteBancaire;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch(Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $query = "SELECT numCarte,crypto FROM cartebancaires WHERE numCarte = :numCarte AND crypto = :crypto";
    $data = $bdd->prepare($query);
    $data->bindValue(":numCarte",$numCb);
    $data->bindValue(":crypto",$crypto);
    $data->execute();

    $count = count($data->fetchAll(PDO::FETCH_ASSOC));
    if ($count == 1) {
        return true;
    }
    else {
        return false;
    }

}


if(isInDb($_POST['numCb'],$_POST['crypto'])) {
    echo "achat effectué";
}
else {
    echo "mauvais identifiants";
}