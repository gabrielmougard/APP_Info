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
                    $r = array();
                    array_push($r,$res2);
                    array_push($r,$length);
                    return $r;
                } else {
                    $r = array();
                    array_push($r,$res1);
                    array_push($r,$length);
                    return $r;
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

function creerTrameEnvoi($bdd,$data_tab){
    $statement = $bdd->prepare('INSERT INTO `trameenvoi` (`idEnvoi`, `val`, `tim`, `req`, `num`, `chk`, `idComposant`) 
                                VALUES (NULL, NULL, CURRENT_TIMESTAMP, NULL, NULL, NULL, NULL)');
    $statement->execute();
}






