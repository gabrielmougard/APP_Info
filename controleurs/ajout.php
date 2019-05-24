<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 24/05/2019
 * Time: 16:14
 */

include ("modeles/requetes.dashboard.php");
$decalage=0;
if(isset($_GET['numero_serie']) and !empty($_GET['numero_serie'])) {
    $idCemac = recupIdCemacs($bdd, $_GET['idPiece'][0][0])[0][0];
    $idCemac = intval($idCemac);
    $rep = ajouterComposant($bdd, $_GET['numero_serie'], $idCemac);
    $decalage = $decalage + 1;

    $cemac = recupIdCemacs($bdd, $_GET['idPiece']);
    $composants = recupIdComposants($bdd, $cemac[0][0]);
    $idComposant = intval(recupIdComposantNumSerie($bdd, $_GET['numero_serie'])[0][0]);
    $idAfficher = count($composants) + $decalage;

    if ($rep === 2) {
        echo "
        <div class='Composant'>
        <input id=" . $idAfficher . " type='checkbox'>
        <label for=" . $idAfficher . ">
        <h1> " . recupInfoComplementaire($bdd, $idComposant)[0][0] . "</h1>
            <a href='/index.php?cible=dashboard&fonction=capteurs&idPiece='" . $_GET['idPiece'] . "&idComposant=" . $idComposant . ">Supprimer ce Composant</a>
        <img src='public/images/maison1.jpg' class='maison'> <!--A inclure dans le switch pour avoir une image correspondante-->

        ";
        switch (recupValHexaCapteur($bdd, $idComposant)) {
            case null: //Cas de l'actionneur
                echo "
                <ul>
                    <li><i id = 'flechehaut'" . $idAfficher . " class='fa fa-arrow-up fa-2x' aria-hidden='true'></i><p>En montée</p></li>
                    <li><i id = 'pause'" . $idAfficher . " class='fa fa-pause fa-2x' aria-hidden='true'></i><p>A l'arrêt</p></li>
                    <li><i id = 'flechebas'" . $idAfficher . " class='fa fa-arrow-down fa-2x' aria-hidden='true'></i><p>En decente</p></li>
                </ul>
                </div>
            ";
                break;
            default: //Cas du capteur
                echo "
                <nav class='liste_valeurs'>
                <ul class ='liste_valeurs'>
                
                    <li>" . intval(recupValHexaCapteur($bdd, $idComposant)) . " " . recupInfoComplementaire($bdd, $idComposant)[0][1] . "</li>
                
                </ul>
                </nav>
                </label>
                </div>
            ";
                break;
        } //Fin Switch

    }//fin if
    else {
        echo("Le numéro saisi ne correspond à aucun composant valide");
    }
}
