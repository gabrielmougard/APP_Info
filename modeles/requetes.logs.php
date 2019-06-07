<?php
/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 03/06/2019
 * Time: 11:20
 */


function getTramesBatch()
{

    $raw = recupLogsBrut();
    $intermediaire = decoupeLogsBrut($raw);
    $res = array();

    foreach ($intermediaire as $value) {
        array_push($res, decodageTrame($value));
    }

    $length = count($res);
    $timestampFirstIt = array();
    $timestampSecondIt = array();
    $max = 0;
    $startSecondIt = 0;
    $res1 = array();
    $res2 = array();

    for ($i = $length-1; $i >= 0; $i--) {


        $curr = array_slice($res[$i - 1], 8);
        //echo "curr";
        //var_dump($curr);


        for ($j = $i - 1; $j >= 0; $j--) {
            $prev = array_slice($res[$j], 8);
            if ($curr == $prev) {
                array_push($timestampFirstIt, $prev);
                array_push($res1,$res[$j]);
            } else {

                $max = count($res1);
                $startSecondIt = $j;
                break;
            }
        }

        $curr = array_slice($res[$startSecondIt],8);
        array_push($res2, $res[$startSecondIt]);

        for ($j = $startSecondIt - 1; $j >= 0; $j--) {
            $prev = array_slice($res[$j], 8);
            if ($curr == $prev) {
                array_push($timestampSecondIt, $prev);
                array_push($res2,$res[$j]);
            } else {

                if (count($res2) > $max) {
                    return $res2;
                } else {
                    return $res1;
                }
            }
        }

    }
}


function recupLogsBrut(){
    $data=file_get_contents("http://projets-tomcat.isep.fr:8080/appService/?ACTION=GETLOG&TEAM=007D");
    echo "Donnée brute:<br />";
    echo("$data");
    return $data;

/*
    $trame = $data_tab[1];
// décodage avec des substring
    $t = substr($trame,0,1);
    $o = substr($trame,1,4);
// …
// décodage avec sscanf
    list($t, $o, $r, $c, $n, $v, $a, $x, $year, $month, $day, $hour, $min, $sec) =
        sscanf($trame,"%1s%4s%1s%1s%2s%4s%4s%2s%4s%2s%2s%2s%2s%2s");
    echo("<br />$t,$o,$r,$c,$n,$v,$a,$x,$year,$month,$day,$hour,$min,$sec<br />");
*/
}

function decoupeLogsBrut($data){
    $data_tab = str_split($data,33);
    echo "Tabular Data:<br />";
        var_dump(decodageTrame($data_tab[1]) );
    return $data_tab;
}

function decodageTrame($trame){
    return list($typeTrame, $numObjetCemac, $typeRequete, $typeCapteur, $numCapteur, $valeur, $numTrame, $checksum, $year, $month, $day, $hour, $min, $sec) =
        sscanf($trame,"%1s%4s%1s%1s%2s%4s%4s%2s%4s%2s%2s%2s%2s%2s");
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




