<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/06/19
 * Time: 14:44
 */

include('modeles/requetes.logs.php');


header("Content-type: text/json");

//recupération des paramètres en URL
$typeCapteur = '07';
//



$lastRes = getTramesBatchv2(); //retourne 29 trames completes (les dernières)
//var_dump($lastRes);


//choose the right trame (iterate through $lastRes)

foreach ($lastRes as $trame) {
    if ($trame[2] == $typeCapteur) {
        $y = (1.0/hexdec($trame[4]))*600;
        break;
    }
}

$x = time()*1000; //time
//$y = rand(0,100); //value

//send json
$ret = array($x,$y);
echo json_encode($ret);