<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 05/04/2019
 * Time: 15:23
 */
include("connexion.php");

// Todo: Mettre bien en commentaire les paramètre des fonction, ce qu'elle retourne et tout ca, on comprend r la

/*ATTENTION


Il faut remplacer le "1" ligne 288 par idUser

cemac il faut ajouter auto incré




*/



// REQUETE POUR APPARTEMENT_LISTE

/**
 * Renvoie tous les appartements du propritéaire identifié en paramètre par son id
 * @param PDO $bdd
 * @param int $idUser
 * @return array[][][] les différentes lignes et colonnes
 */
function appartementProprietaire(PDO $bdd, $idUser){ //Retourne un tableau contenant les Propriétés d'un appartement
    //de l'UTILISATEUR donné en argument
    $statement = $bdd->prepare('SELECT * FROM appartement 
            INNER JOIN role ON appartement.idAppartement=role.idAppart 
            INNER JOIN utilisateurs ON role.idUser=utilisateurs.idUtilisateur
            WHERE role.idUser='.$idUser);
    $statement->execute();
    return $statement->fetchAll();
}

/**
 * renvoie les pièces correspondant à un appartement identifié par son id
 * @param PDO $bdd
 * @param int $idAppartementCourant
 * @return array
 */
function piecesAppartement(PDO $bdd, $idAppartementCourant){ //Retourne un tableau contenant les PIECES
    //des appartement d'un UUILISATEUR donné en argument
    $statement = $bdd->prepare('SELECT * FROM ' . 'piece' .
        ' WHERE ' . 'piece.idAppart=' . $idAppartementCourant);
    $statement->execute();
    return $statement->fetchAll();
}

/**
 * renvoie seulement les id des appartements d'un propriétaire identifié par son id
 * @param PDO $bdd
 * @param $idUser
 * @return array
 */
function recupIdAppartuser(PDO $bdd, $idUser)
{ //Retourne un tableau contenant les idAppartement de l'UTILISATEUR donné en argument

    $statement = $bdd->prepare('SELECT DISTINCT idAppartement FROM appartement 
    INNER JOIN role ON appartement.idAppartement=role.idAppart 
    INNER JOIN utilisateurs ON role.idUser=utilisateurs.idUtilisateur
    WHERE role.idUser=' . $idUser);
    $statement->execute();
    return $statement->fetchAll();
}


//================================REQUETE CAPTEURS=============================================================

/**
 * renvoie l'id du cemac d'une pièce ridentifiée par son id
 * @param PDO $bdd
 * @param $idPiece
 * @return array
 */
function recupIdCemacs(PDO $bdd, $idPiece){ // Retourne Toute les ids cemacs d'un appartement
    $statement = $bdd->prepare('
    SELECT idCemac FROM cemac
    INNER JOIN piece ON piece.idPiece=cemac.idPiece
    WHERE piece.idPiece='.$idPiece);
    $statement->execute();
    return $statement->fetchAll();
}

/**
 * renvoie les id des composants liés à une cemac identifiée par son id
 * @param PDO $bdd
 * @param int $idCemac
 * @return array
 */
function recupIdComposants(PDO $bdd, $idCemac){ // Retourne Toute les composants d'une Cemac
    $statement = $bdd->prepare('
    SELECT idComposant , numComposant FROM composant
    INNER JOIN cemac ON composant.idCemac=cemac.idCemac
    WHERE composant.idCemac='. $idCemac);
    $statement->execute();
    return $statement->fetchAll();
}

/**
 * renvoie la valeur en hexadécimal d'une trame envoyée par un capteur identifié par son id
 * @param PDO $bdd
 * @param int $idComposant
 * @return array
 */
function recupValHexaCapteur(PDO $bdd, $idComposant){ //Retourne la valeur Hexadecimale d'un composant
    $statement = $bdd->prepare('
    SELECT trameenvoi.Val FROM composant
    INNER JOIN trameenvoi ON composant.idComposant=trameenvoi.idComposant
    WHERE composant.idComposant='. $idComposant);
    $statement->execute();
    return $statement->fetchAll();
}

/**
 * renvoie le nom du type de capteur, la grandeur physique associée et la valeur du champ TYP correspondant dans une trame
 * @param PDO $bdd
 * @param $idComposant
 * @return array
 */
function recupInfoComplementaire(PDO $bdd, $idComposant){ //Retourne le nom, clé/valeur et l'unité de la grandeur physique
    $statement = $bdd->prepare('
    SELECT nom,grandeurPhysique,valeur FROM composant
    INNER JOIN typecapteur ON typecapteur.idTypeCapteur=composant.idTypeCapteur
    WHERE composant.idComposant='. $idComposant);
    $statement->execute();
    return $statement->fetchAll();
}
/*
@valeur=1 valeur en hexa
@type=1 type de capteur
*/

/**
 * convertit une valeur d'hexadécimal en fonction du type de capteur auquel correspond la valeur
 * @param $valeur
 * @param $type
 * @return float|int
 */
function convertir($valeur,$type){
    $valeur=hexdec($valeur);
    switch($type){
        case 'a1':
            $valeur=$valeur*80/1023;
            break;
        case 'b2':
            $valeur=$valeur*70/1023;
            break;
        case 'c3':
            $valeur=(1/$valeur)*34009;
            break;
        default:
            $valeur="Null";
            break;
    }
    return $valeur;
}
/*
@valeur=un array de valeurs valeur en hexa
@type=un array de types de capteur
*/
/**
 * récupère les valeursde tous les capteurs d'une pièce et les convertit en valeurs décimales cohérentes.
 * @param $valeur
 * @param $type
 * @return mixed
 */
function parcourirValeurs($valeur, $type){
    for ($i=0; $i<count($valeur);$i++){
        $valeur[$i][0][0]=
            convertir(
                $valeur[$i][0][0],
                $type[$i][0][2]);
    }
    return $valeur;
}

//===============ACTIONNEURS=======================================================

function recupOrdre(PDO $bdd, $num){ // Recupère l'ordre donné à la Cemac
    $statement = $bdd->prepare('SELECT ans 
    FROM trameretour
    INNER JOIN composant ON trameretour.num = composant.numComposant
    WHERE trameretour.num = ' . $num);
    $statement->execute();
    return $statement->fetchAll();
}


function envoieTrameDansBDD(PDO $bdd, $ans,$num,$idComposant){
    $statement = $bdd->prepare('INSERT INTO `trameretour` (`idRetour`, `ans`, `req`, `num`, `chk`, `idComposant`) 
    VALUES (NULL,'.$ans.', NULL, '.$num.', NULL,'.$idComposant.')');
    $statement->execute();
}

function supprComposant(PDO $bdd, $idComposant){ //Supprime un composant
    $statement = $bdd->prepare('DELETE FROM `composant` WHERE `composant`.`idComposant` = '.$idComposant);
    $statement->execute();
}

function supprAppartement(PDO $bdd, $idAppartement){ //Supprime un appartement (mais aussi ses pieces)
    $statement = $bdd->prepare('SELECT idComposant 
                                          FROM composant 
                                          INNER JOIN cemac ON composant.idCemac = cemac.idCemac 
                                          INNER JOIN piece ON piece.idPiece = cemac.idPiece 
                                          INNER JOIN appartement ON piece.idAppart = appartement.idAppartement 
                                          WHERE appartement.idAppartement='.$idAppartement); //Selectionne tout les idComposant de l'appartement
    $statement->execute();
    $idsComposant= $statement->fetchAll();
    for($i=0 ; $i<count($idsComposant); $i++){ // Supprime l'idCemac des composants
        $statement = $bdd->prepare('SELECT trameenvoi.idEnvoi FROM trameenvoi WHERE trameenvoi.idComposant='. $idsComposant[$i]['idComposant']);//Recupere tout les idEnvoi d'un composant
        $statement->execute();
        $idsTrameenvoi = $statement->fetchAll();
        for($j = 0 ; $j< count($idsTrameenvoi);$j++){
            $statement = $bdd->prepare('DELETE FROM `trameenvoi` WHERE `trameenvoi`.`idEnvoi`='.$idsTrameenvoi[$j]['idEnvoi']);//Supprime la trame
            $statement->execute();
        }
        $statement = $bdd->prepare('UPDATE `composant` SET `idCemac` = NULL WHERE `composant`.`idComposant` =  '.$idsComposant[$i]['idComposant']);
        $statement->execute();
    }
    $statement = $bdd->prepare('SELECT idCemac 
                                          FROM cemac 
                                          INNER JOIN piece ON piece.idPiece=cemac.idPiece 
                                          INNER JOIN appartement ON appartement.idAppartement=piece.idAppart 
                                          WHERE appartement.idAppartement='.$idAppartement);//Selectionne tout les idCemac de l'appartement
    $statement->execute();
    $idsCemac= $statement->fetchAll();
    for($i=0 ; $i<count($idsCemac); $i++){ // Supprime l'idCemac des composants
        $statement = $bdd->prepare('DELETE FROM `cemac` WHERE cemac.idCemac='.$idsCemac[$i]['idCemac']); // Supprime la/les Cemac liée à l'appartement
        $statement->execute();
    }
    $statement = $bdd->prepare('DELETE FROM `piece` WHERE `piece`.`idAppart` = '.$idAppartement);// Supprime les pieces
    $statement->execute();
    $statement = $bdd->prepare('DELETE FROM `appartement` WHERE `appartement`.`idAppartement` = '.$idAppartement);// Supprime l'appartement
    $statement->execute();
    $statement = $bdd->prepare('DELETE FROM `role` WHERE `role`.`idAppart` ='.$idAppartement); //Supprime le role lié à l'appartemeent
    $statement->execute();
}

function supprPiece(PDO $bdd, $idPiece){
    $statement = $bdd->prepare('SELECT idComposant 
                                          FROM composant 
                                          INNER JOIN cemac ON composant.idCemac = cemac.idCemac 
                                          INNER JOIN piece ON piece.idPiece = cemac.idPiece 
                                          WHERE piece.idPiece = '. $idPiece);
    $statement->execute(); //Selectionne tout les idComposant de la pièce
    $idsComposant= $statement->fetchAll();
    for($i=0 ; $i<count($idsComposant); $i++){
        $statement = $bdd->prepare('SELECT trameenvoi.idEnvoi FROM trameenvoi WHERE trameenvoi.idComposant='. $idsComposant[$i]['idComposant']);//Recupere tout les idEnvoi d'un composant
        $statement->execute();
        $idsTrameenvoi = $statement->fetchAll();
        for($j = 0 ; $j<count($idsTrameenvoi);$j++){
            $statement = $bdd->prepare('DELETE FROM `trameenvoi` WHERE `trameenvoi`.`idEnvoi`='.$idsTrameenvoi[$j]['idEnvoi']);//Supprime la trame
            $statement->execute();
        }
        $statement = $bdd->prepare('UPDATE `composant` SET `idCemac` = NULL WHERE `composant`.`idComposant` =  '.$idsComposant[$i]['idComposant']);// Supprime l'idCemac de tout les composants
        $statement->execute();
    }
    $statement = $bdd->prepare('DELETE FROM `cemac` WHERE `cemac`.`idPiece` = '.$idPiece); // Supprime la/les Cemac liée à l'appartement
    $statement->execute();
    $statement = $bdd->prepare('DELETE FROM `piece` WHERE `piece`.`idPiece`='.$idPiece);//Suppr piece
    $statement->execute();
}

function ajouterAppartement(PDO $bdd, $adresse,$superficie,$idUser){ //Ajoute une ligne Appartement et role
    $idAppartement = affecterIdAppartement($bdd);
    $statement = $bdd->prepare('INSERT INTO `appartement` (`idAppartement`, `adresse`, `superficie`) VALUES ("'.$idAppartement.'","'.$adresse.'","'.$superficie.'" ) ');
    $statement->execute();
    $statement = $bdd->prepare(' INSERT INTO `role` (`idRole`, `principal`, `secondaire`, `idAppart`, `idUser`) VALUES (Null, 1, 0,"'.$idAppartement.'","'.$idUser.'" )    ');
    $statement->execute();
} //Soit on met l'id Appartement directement dans role soit on va chercher le dernier idAppartement

function affecterIdAppartement(PDO $bdd){ //On créer un idAppartement et on vérifie qu'il n'existe pas
    $statement = $bdd->prepare('SELECT idAppartement FROM appartement ');
    $statement->execute();
    $tab =$statement->fetchAll();
    while ($a=1){
        $val = rand();

        if(in_array($val,$tab)){
        }
        else{
            return $val;
            $a=2;
        }
    }
}


function ajouterPiece(PDO $bdd, $nom, $idAppartement,$numSerie){ //Ajoute piece et cemac
    $idPiece= affecterIdPiece($bdd);
    $statement = $bdd->prepare('   INSERT INTO `piece` (`idPiece`, `nom`, `idAppart`) VALUES ("'.$idPiece.'", "'.$nom.'","'.$idAppartement.'")    ');
    $statement->execute();;
    $statement = $bdd->prepare('   INSERT INTO `cemac` (`idCemac`, `numeroSerie`, `idPiece`) VALUES (Null,"'.$numSerie.'","'.$idPiece.'")    ');
    $statement->execute();
}
function affecterIdPiece(PDO $bdd){ //On créer un idAppartement et on vérifie qu'il n'existe pas
    $statement = $bdd->prepare('SELECT idPiece FROM piece ');
    $statement->execute();
    $tab =$statement->fetchAll();
    while ($a=1){
        $val = rand();

        if(in_array($val,$tab)){
        }
        else{
            return $val;
            $a=2;
        }
    }
}


?>