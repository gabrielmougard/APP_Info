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

    $idCemac = recupIdCemacs($bdd, $_GET['idPiece'])[0][0];
    $idCemac = intval($idCemac);
    $rep = ajouterComposant($bdd, $_GET['numero_serie'], $idCemac);
    $decalage = $decalage + 1;

    //On définit les variable pour afficher le nouveau composant
    $cemac = recupIdCemacs($bdd, $_GET['idPiece']);
    $composants = recupIdComposants($bdd, $cemac[0][0]);
    $idComposant = intval(recupIdComposantNumSerie($bdd, $_GET['numero_serie'])[0][0]);
    $idAfficher = count($composants) + $decalage;

    if ($rep === 2) {
        echo "
        <div class='Composant'>";?>
        <a href="index.php?cible=dashboard&fonction=capteurs&idPiece=<?php echo $_GET['idPiece']?>&sppridComposant=<?php echo $idComposant ?>"><button class=\"croix\">X</button></a>
        <?php echo"
        <input id=" . $idAfficher . " type='checkbox'>
        <label for=" . $idAfficher . ">
        <h1> " . recupInfoComplementaire($bdd, $idComposant)[0][0] . "</h1> <!--Nom du composant-->
        <img src='public/images/CapteurDefaut.jpg' class='maison'> <!--A inclure dans le switch pour avoir une image correspondante-->        ";
        switch (recupValHexaCapteur($bdd, $idComposant)[0]["Val"]) {
            case NULL: //Cas de l'actionneur
                echo "
                <ul>
                    <li><i id = 'flechehaut".$idAfficher."' class='fa fa-arrow-up fa-2x' aria-hidden='true'></i><p>En montée</p></li>
                    <li><i id = 'pause" . $idAfficher . "' class='fa fa-pause fa-2x' aria-hidden='true'></i><p>A l'arrêt</p></li>
                    <li><i id = 'flechebas" . $idAfficher . "' class='fa fa-arrow-down fa-2x' aria-hidden='true'></i><p>En decente</p></li>
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
        ?>
        <script> //Javascript NE FONCTIONNE PAS


            <?php
            for ($i = 0; $i < $idAfficher; $i++) { //Parcourt de la liste de composants
            if (intval(recupValHexaCapteur($bdd, $idComposant)) !== NULL) { // Si Null on sait que c'est un actionneur et non capteur
                continue;
            }
            ?>
            var capteurId = <?php echo $composants[$idAfficher]['idComposant'];?>;
            var numComposant = <?php echo $composants[$idAfficher]['numComposant'];?>;

            var a = document.getElementById("flechehaut"+<?php echo $idAfficher ?>);
            var b = document.getElementById("pause"+<?php echo $idAfficher ?>);
            var c = document.getElementById("flechebas"+<?php echo $idAfficher ?>);

            var newValeurHaut = 32;
            var newValeurPause = 30;
            var newValeurBas = 31;

            a.addEventListener('click', function() {
                fetch(`./index.php?cible=dashboard&fonction=update_database&capteurId=${capteurId}&newValue=${newValeurHaut}&numComposant=${numComposant}`)
                    .then(function(response) {
                        response.text()
                    });
            });
            b.addEventListener('click', function() {
                fetch(`./index.php?cible=dashboard&fonction=update_database&capteurId=${capteurId}&newValue=${newValeurPause}&numComposant=${numComposant}`)
                    .then(function(response) {
                        response.text()
                    });
            });
            c.addEventListener('click', function() {
                fetch(`./index.php?cible=dashboard&fonction=update_database&capteurId=${capteurId}&newValue=${newValeurBas}&numComposant=${numComposant}`)
                    .then(function(response) {
                        response.text()
                    });
            });
            <?php
            }// Fin boucle for
            ?>
        </script>
        <?php
    }//fin if
    else {
        echo("Le numéro saisi ne correspond à aucun composant valide");
    }
}

