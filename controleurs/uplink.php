<?php

$instruction= isset($_GET['instruction'])? $_GET['instruction']:'0';

/*
switch ($instruction){
    case '0000':
        $CHK='3C6';
        break;

    case '0001':
        $CHK='3C7';
        break;

    case '0002':
        $CHK='3C8';
        break;
}
*/
$trame='1997D2a01000'.$instruction.'55';

//TRA =1 (Hex: 1=0x31)
//OBJ = 007D Numéro équipe (Hex: 0=0x30, 7=0x37, 0x44)
//REQ = 2 en ecriture pour le moteur (Hex: 2=0x32)
//TYPE = a code ASCII pour le moteur (Hex: a=0x61)
//NUM = 01 (Hex: 0=0x30,1=0x31)
//VAL = 0000 POUR SHUTDOWN / 0001 POUR LE SENS HORAIRE / 0002 POUR SENS ANTI HORAIRE (Hex: 0=0x30,1=0x31,0=0x32)
//CHK= Addition de Tout les code en Hex passé en ASCII: 3C6 pour SHUTDOWN / 3C7 SENS HORAIRE / 3C8 SENS ANTI HORAIRE

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://projets-tomcat.isep.fr:8080/appService/?ACTION=COMMAND&TEAM=007D&TRAME=".$trame);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$data=curl_exec($ch);
curl_close($ch);

echo json_encode($data);