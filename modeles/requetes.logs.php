<?php
/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 03/06/2019
 * Time: 11:20
 */


function getTramesBatchv2() {
    $raw = recupLogsBrutShort();

    $intermediaire = decoupeLogsBrut($raw);
    //var_dump($intermediaire);
    $res = array();


    for ($i=0; $i < count($intermediaire); $i++) {
        $t = decodageTrameLiveChart(strrev($intermediaire[$i]));
        array_push($res,$t);
    }

    return $res;

}



function recupLogsBrutShort(){

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



function decoupeLogsBrut($data){

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
    $statement->bindValue(':val', $val);
    $statement->bindValue(':tim', $tim);
    $statement->bindValue(':num', $num);
    $statement->bindValue(':iComposant', $idComposant);
    $statement->execute();
    $statement->commit();
}
function insertTrame($bdd,$trame){
    for($i=0;$i<sizeof($trame);$i++) {
        $arraytrame = array();
        $arraytrame = decodageTrame($trame[$i]);
        try {
            $isUnique = true;
            $tim = '' . $arraytrame[8] . '-' . $arraytrame[9] . '-' . $arraytrame[10] . ' ' . $arraytrame[11] . ':' . $arraytrame[12] . ':' . $arraytrame[13] . '';
            $sth = $bdd->prepare("SELECT idCemac FROM cemac WHERE numeroSerie=:cemac");
            $sth->bindValue(':cemac', $arraytrame[1]);
            $sth->execute();
            $result = $sth->fetchAll();
            $cemac = isset($result[0]["idCemac"]) ? $result[0]["idCemac"] : null;
            $sth = $bdd->prepare('SELECT DISTINCT idComposant FROM composant 
INNER JOIN typecapteur ON composant.idTypeCapteur=typecapteur.idTypeCapteur 
WHERE typecapteur.valeur=:typeCapteur AND composant.idCemac=:cemac AND composant.numComposant=:numComposant');
            $sth->bindValue(':cemac', $cemac);
            $sth->bindValue(':typeCapteur', $arraytrame[3]);
            $sth->bindValue(':numComposant', $arraytrame[4]);
            $sth->execute();
            $result = $sth->fetchAll();
            $idComposant = isset($result[0]["idComposant"]) ? $result[0]["idComposant"] : null;
            $sth = $bdd->prepare("SELECT * FROM trameenvoi WHERE tim=:tim");
            $sth->bindValue(':tim', $tim);
            $sth->execute();
            $result = $sth->fetchAll();
            $trameBdd = isset($result[0]) ? $result[0] : null;
            if ($trameBdd == null OR empty($trameBdd)) {
                $isUnique = false;
            }
            if ($isUnique) {
                creerTrameEnvoi($bdd, $arraytrame[5], $tim, $arraytrame[4], $idComposant);
                if($i==sizeof($trame)-1){
                    return true;
                }
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }
}