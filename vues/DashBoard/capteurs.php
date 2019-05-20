<head>
    <meta charset="UTF-8">
    <title>Capteurs</title>
    <link rel="stylesheet" href="public/css/capteurs.css">
</head>

<?php include "vues/templates/header.php" ?>

<body>

<div class="conteneur_Cemac">
    <?php
    for ($i = 0; $i < count($composants); $i++) { //Faire un conteneur pour chaque composant ?>

        <div class="Composant">
        <?php
        echo'<input id="'.$i.'" type="checkbox">';
        echo'<label for="'.$i.'">';
        ?>

        <h1><?php echo $infosType[$i][0][0] // ?></h1>
            <a href="./index.php?cible=dashboard&fonction=capteurs&idPiece=<?php echo $_GET['idPiece']?>&idComposant=<?php echo $composants[$i][0] ?>">Supprimer ce Composant</a>
        <img src="public/images/maison1.jpg" class="maison"> <!--A inclure dans le switch pour avoir une image correspondante-->

        <?php
        switch ($valeurs[$i][0][0]){
            case "Null": //Cas de l'actionneur?>
                <ul>
                    <li><i id = "flechehaut<?php echo $i?>" class="fa fa-arrow-up fa-2x" aria-hidden="true"></i><p>En montée</p></li>
                    <li><i id = "pause<?php echo $i?>" class="fa fa-pause fa-2x" aria-hidden="true"></i><p>A l'arrêt</p></li>
                    <li><i id = "flechebas<?php echo $i?>" class="fa fa-arrow-down fa-2x" aria-hidden="true"></i><p>En decente</p></li>
                </ul>
                </div>
            <?php
            break;
            default: //Cas du capteur
                ?>
                <nav class="liste_valeurs">
                <ul class ="liste_valeurs">
                <?php
                for ($j = 0; $j < count($valeurs[$i]); $j++) {
                    echo '<li>'. $valeurs[$i][$j][0] . ' '.$infosType[$i][$j][1].'</li>';
                }
                ?>
                </ul>
                </nav>
                </label>
                </div>
            <?php
            break;
        } //Fin Switch?>

        <?php
    }
    include("ajouterComposantPopUp.php")?>
    <script> //Javascript
        <?php
        for ($i = 0; $i < count($composants); $i++) { //Parcourt de la liste de composants
            if ($valeurs[$i][0][0] !== 'Null') { // Si Null on sait que c'est un actionneur et non capteur
                continue;
            }
            ?>
            var capteurId = <?php echo $composants[$i]['idComposant'];?>;
            var numComposant = <?php echo $composants[$i]['numComposant'];?>;

            var a = document.getElementById("flechehaut"+<?php echo $i ?>);
            var b = document.getElementById("pause"+<?php echo $i ?>);
            var c = document.getElementById("flechebas"+<?php echo $i ?>);

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
</body>

<?php include "vues/templates/Footer.php" ?>

</html>
