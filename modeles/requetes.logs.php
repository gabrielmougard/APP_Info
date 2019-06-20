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
    curl_setopt($ch, CURLOPT_URL, "http://projets-tomcat.isep.fr:8080/appService/?ACTION=GETLOG&TEAM=997D");
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

    $nouveauRepere=strlen($raw); //taille du log actualisé
    //echo "NouveauRepere=";
    //var_dump($nouveauRepere);
    //echo "</br>";
    $ancienRepere=recupRepere($bdd,$pieceSelect); //Taille des logs déjà traité
    /*if($ancienRepere==$nouveauRepere){
        echo "Logs non actualisé ou identique<br />" ;
    }
    else{
        echo "On va traiter les nouveaux logs<br />";
    }*/
    $rawRecent=substr($raw,$ancienRepere); // Retire les logs déjà traité
    //echo $rawRecent;
    $intermediaire= decoupeLogsBrut($rawRecent);//Découpe les logs en trames


    //echo "Intermediaire découpe log=";
    //var_dump($intermediaire);
    //echo "</br>";

    $res = array(); // On va mettre les trames dans ce tableau
    foreach ($intermediaire as $value) {
        //var_dump(decodageTrame($value));
        array_push($res, decodageTrame($value)); // value = interme[i]
    }
    //    //res est un array d'array de strings qui correspondent à chaque champ

    foreach($res as $trame){
        //var_dump($trame);
        //echo "<br>";
        insertTrame($bdd,$trame);
    }

    //echo("pieceSelect=");
    //var_dump($pieceSelect);
    //echo("nouveau repere=");
    //var_dump($nouveauRepere);
    insererRepereDansBDD($bdd,$pieceSelect,$nouveauRepere);

}

function recupLogsBrut()
{
    $data = file_get_contents("http://projets-tomcat.isep.fr:8080/appService/?ACTION=GETLOG&TEAM=997D");
    //echo "Donnée brute:<br />";
    //echo("$data");
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
    $liste=array();
    for ($i=0;$i<strlen($data)-33;$i++){
        if ($data[$i].$data[$i+1].$data[$i+2].$data[$i+3].$data[$i+4] == "1997D"){
            $liste[$i]=$data[$i].$data[$i+1].$data[$i+2].$data[$i+3].$data[$i+4].$data[$i+5].$data[$i+6].$data[$i+7].$data[$i+8].$data[$i+9].$data[$i+10].$data[$i+11].$data[$i+12].$data[$i+13].$data[$i+14].$data[$i+15].$data[$i+16].$data[$i+17].$data[$i+18].$data[$i+19].$data[$i+20].$data[$i+21].$data[$i+22].$data[$i+23].$data[$i+24].$data[$i+25].$data[$i+26].$data[$i+27].$data[$i+28].$data[$i+29].$data[$i+30].$data[$i+31].$data[$i+32];
            $i+=33;
        }
    }
    //var_dump($liste);
    return $liste;
}
/*
function decoupeLogsBrut($data)
{
    $liste = array();
    for ($i = 0; $i < $data; $i++) {
        if ($data[$i] . $data[$i + 1] . $data[$i + 2] . $data[$i + 3] . $data[$i + 4] == "1997D") {
            //echo $data[$i].$data[$i+1].$data[$i+2].$data[$i+3].$data[$i+4];
            //echo "<br>";

            $liste[$i] = $data[$i] . $data[$i + 1] . $data[$i + 2] . $data[$i + 3] . $data[$i + 4] . $data[$i + 5] . $data[$i + 6] . $data[$i + 7] . $data[$i + 8] . $data[$i + 9] . $data[$i + 10] . $data[$i + 11] . $data[$i + 12] . $data[$i + 13] . $data[$i + 14] . $data[$i + 15] . $data[$i + 16] . $data[$i + 17] . $data[$i + 18] . $data[$i + 19] . $data[$i + 20] . $data[$i + 21] . $data[$i + 22] . $data[$i + 23] . $data[$i + 24] . $data[$i + 25] . $data[$i + 26] . $data[$i + 27] . $data[$i + 28] . $data[$i + 29] . $data[$i + 30] . $data[$i + 31] . $data[$i + 32];
            $i += 33;
        }

    }
}
*/
    function decodageTrame($trame)
    {
        return list($typeTrame, $numObjetCemac, $typeRequete, $typeCapteur, $numCapteur, $valeur, $numTrame, $checksum, $year, $month, $day, $hour, $min, $sec) =
            sscanf($trame, "%1s%4s%1s%1s%2s%4s%4s%2s%4s%2s%2s%2s%2s%2s");
    }

    function decodageTrameLiveChart($trame)
    {
        return list($numObjetCemac, $typeRequete, $typeCapteur, $numCapteur, $valeur, $numTrame, $checksum, $year, $month, $day, $hour, $min, $sec) =
            sscanf($trame, "%4s%1s%1s%2s%4s%4s%2s%4s%2s%2s%2s%2s%2s");
    }

    function traiterTrame($trameDecode)
    {
    }

    function supprTrameDoublons($bdd, $data)
    {
    }

    function creerTrameEnvoi($bdd, $val, $tim, $num, $idComposant)
    {
        $statement = $bdd->prepare('INSERT INTO `trameenvoi` (val, tim, num, idComposant) 
                                VALUES (:val, :tim, :num, :idComposant)');
        $statement->bindValue(':val', $val);
        $statement->bindValue(':tim', $tim);
        $statement->bindValue(':num', $num);
        $statement->bindValue(':idComposant', $idComposant);
        $statement->execute();
        //$statement->commit();
    }

    function insertTrame($bdd, $trame)
    {
        $listeGain = array('1' => 0.068,
            '2' => 0.1,
            '0' => 1);

        try {
            //Créer le tim
            $tim = $trame[8] . '-' . $trame[9] . '-' . $trame[10] . ' ' . $trame[11] . ':' . $trame[12] . ':' . $trame[13] . '';

            //Chercher idComposant
            $sth = $bdd->prepare("SELECT idCemac FROM cemac WHERE numeroSerie=:cemac");
            $sth->bindValue(':cemac', $trame[1]);
            $sth->execute();
            $result = $sth->fetchAll();

            $cemac = isset($result[0]["idCemac"]) ? $result[0]["idCemac"] : null;

            $sth = $bdd->prepare('SELECT DISTINCT idComposant FROM composant 
            INNER JOIN typecapteur ON composant.idTypeCapteur=typecapteur.idTypeCapteur 
            WHERE typecapteur.valeur=:typeCapteur AND composant.idCemac=:cemac');
            $sth->bindValue(':cemac', $cemac);
            $sth->bindValue(':typeCapteur', $trame[3]);
            $sth->execute();
            $result = $sth->fetchAll();
            $idComposant = isset($result[0]["idComposant"]) ? $result[0]["idComposant"] : null;

            //0=>Capteur luminosité
            //1=>capteur temp
            //2=> infrarouge

            $sth = $bdd->prepare('SELECT DISTINCT idTypeCapteur FROM composant  
            WHERE idComposant=:idComposant ');
            $sth->bindValue(':idComposant',$idComposant);
            $sth->execute();
            $result = $sth->fetchAll();
            $typecapteur = isset($result[0]["idTypeCapteur"]) ? $result[0]["idTypeCapteur"] : null;

            //ajout
            $valeur=$listeGain[$typecapteur]*hexdec($trame[5]);
            creerTrameEnvoi($bdd, $valeur, $tim, $trame[3], $idComposant);
            return true;

        } catch (Exception $e) {
            return false;
        }

    }


    function recupRepere($bdd, $pieceSelect)
    {
        $sth = $bdd->prepare("SELECT repere FROM cemac WHERE idPiece=:num");
        $sth->bindValue(':num', $pieceSelect);
        $sth->execute();
        $result = $sth->fetchAll();
        return intval($result[0][0]);
    }

    function insererRepereDansBDD($bdd, $pieceSelect, $nouveauRepere)
    {
        $sth = $bdd->prepare("UPDATE cemac SET repere= :nouveauRepere WHERE idPiece= :num");
        $sth->bindValue(':num', $pieceSelect);
        $sth->bindValue(':nouveauRepere', $nouveauRepere);
        $sth->execute();
    }
