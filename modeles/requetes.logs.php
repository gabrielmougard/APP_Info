<?php
/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 03/06/2019
 * Time: 11:20
 */
include ('connexion.php');

function getTramesBatchv2() {
    $raw = recupLogsBrutShort();


    $intermediaire = decoupeLogsBrutShort($raw);
    //var_dump($intermediaire);
    $res = array();


    for ($i=0; $i < count($intermediaire); $i++) {
        $t = decodageTrameLiveChart(strrev($intermediaire[$i]));
        array_push($res,$t);
    }

    return $res;

}



function recupLogsBrutShort()
{

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, "http://projets-tomcat.isep.fr:8080/appService/?ACTION=GETLOG&TEAM=007D");
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

    $data = curl_exec($ch);
    curl_close($ch);


    //$data=file_get_contents("http://projets-tomcat.isep.fr:8080/appService/?ACTION=GETLOG&TEAM=007D");
    //echo "Donnée brute:<br />";
    //echo("$data");
    //get the last 1000 characters of $raw ( ~ the last 30 trames )
    $n = 1000;
    $start = strlen($data) - $n;
    $reduced = '';

    for ($x = $start; $x < strlen($data); $x++) {

        // Appending characters to the new string
        $reduced .= $data[$x];
    }

    return $reduced;
}

function getTramesFromRepere($bdd,$pieceSelect){
    $raw = recupLogsBrut();
    $nouveauRepere=strlen($raw);

    $ancienRepere=recupRepere($bdd,$pieceSelect);
    $rawRecent=substr($raw,$ancienRepere);
    $intermediaire= decoupeLogsBrut($rawRecent);
    $res = array();
    foreach ($intermediaire as $value) {
        array_push($res, decodageTrame($value));
    }
    //res est un array d'array de strings qui correspondent à chaque champ
    foreach($res as $trame){
        //trame est un array de string qui correspondent aux champs
        insertTrame($bdd,$trame);
    }

    echo("pieceSelect=");
    var_dump($pieceSelect);
    echo("nouveau repere=");
    var_dump($nouveauRepere);
    insererRepereDansBDD($bdd,$pieceSelect,$nouveauRepere);

    echo("pieceSelect=");
    var_dump($_GET['pieceSelect']);
    echo("nouveau repere=");
    var_dump(strval($nouveauRepere));
    insererRepereDansBDD($bdd,$pieceSelect,$nouveauRepere);
   // insererRepereDansBDD($bdd,$_GET['pieceSelect'],strval($nouveauRepere));
}

function recupLogsBrut(){
    $data=file_get_contents("http://projets-tomcat.isep.fr:8080/appService/?ACTION=GETLOG&TEAM=007D");
    echo "Donnée brute:<br />";
    echo("$data");
    return $data;
}

function decoupeLogsBrutShort($data){

        //usually decoupeLogsBrut is always 1000 in length
        //$data_tab = str_split($data,33);

        //var_dump($data);
        $rev = strrev($data);


        //var_dump(str_split($rev,33));
        return str_split($rev,33);
        //echo "Tabular Data:<br />";
        //var_dump(decodageTrame($data_tab[1]) );
        //return $data_tab;
    }

function decoupeLogsBrut($data){
    $data_tab = str_split($data,33);
    echo "Tabular Data:<br />";
        var_dump(decodageTrame($data_tab[1]) );
    return $data_tab;
}

function decodageTrame($trame){
    return list($numObjetCemac, $typeRequete, $typeCapteur, $numCapteur, $valeur, $numTrame, $checksum, $year, $month, $day, $hour, $min, $sec) =
        sscanf($trame,"%4s%1s%1s%2s%4s%4s%2s%4s%2s%2s%2s%2s%2s");
}

function decodageTrameLiveChart($trame){
    return list($numObjetCemac, $typeRequete, $typeCapteur, $numCapteur, $valeur, $numTrame, $checksum, $year, $month, $day, $hour, $min, $sec) =
        sscanf($trame,"%4s%1s%1s%2s%4s%4s%2s%4s%2s%2s%2s%2s%2s");
}

function traiterTrame($trameDecode){
}

function supprTrameDoublons($bdd,$data){
}

function creerTrameEnvoi($bdd,$val,$tim,$num,$idComposant){
    $statement = $bdd->prepare('INSERT INTO `trameenvoi` (val, tim, num, idComposant) 
                                VALUES (:val, :tim, :num, :idComposant)');
    echo("val=");
    var_dump($val);
    echo("time=");
    var_dump($tim);
    echo ("number=");
    var_dump($num);
    echo ("idcomposant=");
    var_dump($idComposant);
    $statement->bindValue(':val', $val);
    $statement->bindValue(':tim', $tim);
    $statement->bindValue(':num', $num);
    $statement->bindValue(':idComposant', $idComposant);
    $statement->execute();
    //$statement->commit();
}
function insertTrame($bdd,$trame){
echo ("phase 1");
        try {
            $isUnique = true;
            $tim = '' . $trame[7] . '-' . $trame[8] . '-' . $trame[9] . ' ' . $trame[10] . ':' . $trame[11] . ':' . $trame[12] . '';
            $sth = $bdd->prepare("SELECT idCemac FROM cemac WHERE numeroSerie=:cemac");
            $sth->bindValue(':cemac', $trame[1]);
            $sth->execute();
            $result = $sth->fetchAll();
            echo ("format de temps généré");
            //vérifier qu'on a un résultat.
            //if(isset($result[0]["idCemac"]){
            // $result[0]["idCemac"]
        //}
            //else
            // null;
            $cemac = isset($result[0]["idCemac"]) ? $result[0]["idCemac"] : null;

//trouver l'id du composant correspondant aux informations de la trame.
            $sth = $bdd->prepare('SELECT DISTINCT idComposant FROM composant 
INNER JOIN typecapteur ON composant.idTypeCapteur=typecapteur.idTypeCapteur 
WHERE typecapteur.valeur=:typeCapteur AND composant.idCemac=:cemac AND composant.numComposant=:numComposant');
            $sth->bindValue(':cemac', $cemac);
            $sth->bindValue(':typeCapteur', $trame[3]);
            $sth->bindValue(':numComposant', $trame[4]);
            $sth->execute();
            $result = $sth->fetchAll();

            $idComposant = isset($result[0]["idComposant"]) ? $result[0]["idComposant"] : null;
            echo("idComposant trouvé ");

            //trouver la trame dans la base de donnée dont le champs time correspond à celui dans la trame mis au format de la bdd(SI elle existe)
            $sth = $bdd->prepare("SELECT tim FROM trameenvoi WHERE tim=:tim AND idComposant=:idComp");
            $sth->bindValue(':tim', $tim);
            $sth->bindValue(':idComp', $idComposant);
            $sth->execute();
            $result = $sth->fetchAll();
            echo("trameBDD=");
            var_dump($result[0]);
            $trameBdd = isset($result[0]) ? $result[0] : null;
            //si trameBDD est set alors on a affaire à un doublon
            if($trameBdd!=null){
                $isUnique=false;
            }
            if($isUnique){
                creerTrameEnvoi($bdd, $trame[5], $tim, $trame[4], $idComposant);
                echo ("envoyé");
                return true;

            }
            //sinon on crée la trame
            else {
                echo("pas envoyé");
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
}

function recupRepere($bdd,$pieceSelect){
    $sth = $bdd->prepare("SELECT repere FROM cemac WHERE idPiece=:num");
    $sth->bindValue(':num',$pieceSelect);
    $sth->execute();
    $result = $sth->fetchAll();
    return intval($result[0][0]);
}

function insererRepereDansBDD($bdd,$pieceSelect,$nouveauRepere){
    $sth = $bdd->prepare("UPDATE cemac SET repere= :nouveauRepere WHERE idPiece= :num");
    $sth->bindValue(':num',$pieceSelect);
    $sth->bindValue(':nouveauRepere',$nouveauRepere);
    $sth->execute();
}



