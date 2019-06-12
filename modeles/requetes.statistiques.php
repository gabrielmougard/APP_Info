<?php
//================================REQUETES STATISTIQUES=============================================================

/**
 * renvoie les pièces correspondant à un appartement identifié par son id
 * @param PDO $bdd
 * @param int $idAppartementCourant
 * @return array
 */
function recupPieceFromAppart(PDO $bdd, $idAppartement){
    //des appartement d'un UUILISATEUR donné en argument
    $statement = $bdd->prepare('SELECT DISTINCT idPiece,nom FROM piece 
INNER JOIN appartement ON piece.idAppart=:idAppartement');
    $statement->bindValue(':idAppartement',$idAppartement);
    $statement->execute();
    return $statement->fetchAll();
}

/**
 * renvoie les appartements d'un utilisateur identifiée par son email
 * @param PDO $bdd
 * @param varchar $email
 * @return array
 */
function recupAppartementFromId(PDO $bdd, $id){ //Retourne un tableau contenant les Propriétés d'un appartement


    $statement = $bdd->prepare('SELECT DISTINCT idAppartement,adresse FROM appartement 
            INNER JOIN role ON appartement.idAppartement=role.idAppart 
            INNER JOIN utilisateurs ON role.idUser=:idUtilisateur');
    $statement->bindValue(':idUtilisateur',$id);
    $statement->execute();
    return $statement->fetchAll();
}
/**
 * renvoie l'id du cemac d'un utilisateur identifiée par son id
 * @param PDO $bdd
 * @param varchar $email
 * @return array
 */
function recupComposantFromPiece(PDO $bdd, $idPiece){

    $statement = $bdd->prepare('
    SELECT DISTINCT idCemac FROM cemac WHERE idPiece=:idPiece');
    $statement->bindValue(':idPiece',$idPiece);
    $statement->execute();
    $cemacs=$statement->fetchAll();

    $composant=array();
    foreach($cemacs as $key=>$value) {
        foreach($cemacs["$key"] as $key2=>$value2) {
            $sth = $bdd->prepare('SELECT DISTINCT idComposant FROM composant WHERE idCemac=:idCemac');
            $sth->bindValue(':idCemac',$value2);
            $sth->execute();
            $composant=array_merge($composant,$sth->fetchAll());
        }
    }
    $composant=uniqueArray($composant);


    $result=array();
    foreach ($composant as $key=>$value){
        $sth = $bdd->prepare('SELECT DISTINCT nom FROM typecapteur 
INNER JOIN composant ON typecapteur.idTypeCapteur=composant.idTypeCapteur 
WHERE idComposant=:idComposant');
        $sth->bindValue(':idComposant',$value[0]);
        $sth->execute();
        $nom=$sth->fetchAll();
        $array=array($value[0],$nom[0][0]);
        array_push($result,$array);
    }


    //$res = array();
    //array_push($res, $composant);
    //array_push($res, $result);

    return $result;
}

/**
 * renvoie les 10 dernière trame d'un composant
 * @param PDO $bdd
 * @param int $idComposant
 * @return array
 */
function recupTrameFromComposant(PDO $bdd, $idComposant){

    //var_dump($idComposant);

    $sth = $bdd->prepare('SELECT DISTINCT val,tim FROM trameenvoi WHERE trameenvoi.idComposant= :idComposant 
ORDER BY tim LIMIT 10');
    $sth->bindValue(':idComposant',$idComposant);
    $sth->execute();
    return $sth->fetchAll();
}

