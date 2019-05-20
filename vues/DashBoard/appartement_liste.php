<head>
    <meta charset="UTF-8">
    <title>Appartements Pieces</title>
    <link rel="stylesheet" href="public/css/appartement_style2.css">
</head>

<?php include "vues/templates/header.php" ?>

<body>

<div class="conteneur_appart">
    <?php
    for ($i = 0; $i < count($appartement); $i++) {?>
        <div class="appart">
            <?php
            echo'<input class="checkbox" id="'.$i.'" type="checkbox">';
            echo'<label for="'.$i.'">';
            ?>
            <form action="index.php?cible=dashboard&fonction=appartementPiece" method="post" >
                <input type="hidden" name="supprIdAppart" value="<?php echo($appartement[$i]['idAppartement'])?>">
                <button class="croix">X</button>
            </form>
            <h1><?php echo $appartement[$i][1]?></h1>
            <img src="public/images/maison1.jpg" class="maison">
            <nav class="liste_piece">
                <ul class ="liste_piece">
                    <?php
                    for ($j = 0; $j < count($piece[$i]); $j++) {

                        echo '<li>
                            <a href="index.php?cible=dashboard&fonction=capteurs&idPiece=' . $piece[$i][$j][0] . '">'  . $piece[$i][$j][1] . '</a>';?>
                        <form action="index.php?cible=dashboard&fonction=appartementPiece" method="post" >
                            <input type="hidden" name="supprIdPiece" value="<?php echo($piece[$i][$j]['idPiece'])?>">
                            <button class="croix">X</button>
                        </form>
                        <?php '</li>';
                    }
                    ?>
                    <li>
                        <h2>Ajouter une Piece</h2>
                        <form action="index.php?cible=dashboard&fonction=appartementPiece" method="post">
                            Nom de la piece:<br>
                            <input type="text" name="nom"><br>
                            Numéro de série Cemac:<br>
                            <input type="text" name="numSerie"><br>
                            <input type="hidden" name="idAppartement" value="<?php echo($appartement[$i]['idAppartement']);?>">
                            <input type="submit" value="Valider">
                        </form>
                    </li>
                </ul>
            </nav>
            </label>
        </div>
    <?php }?>
    <div>
        <h1>Ajouter un Appartement</h1>
        <form action="index.php?cible=dashboard&fonction=appartementPiece" method="post">
            Adresse:<br>
            <input type="text" name="adresse"><br>
            Superficie:<br>
            <input type="number" name="superficie">
            <input type="submit" value="Valider">
        </form>
    </div>
</body>

<?php include "vues/templates/Footer.php" ?>
</html>