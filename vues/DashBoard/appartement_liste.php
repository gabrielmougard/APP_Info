<head>
    <meta charset="UTF-8">
    <title>Appartements Pieces</title>
    <link rel="stylesheet" href="public/css/appartement_style2.css">
</head>

<?php include "vues/templates/header.php" ?>

<body>

<div class="conteneur_appart">
    <?php
    for ($i = 0; $i < count($appartement); $i++) { ?>

        <div class="appart">
        <?php
            echo'<input id="'.$i.'" type="checkbox">';
            echo'<label for="'.$i.'">';
            ?>
                <h1><?php echo $appartement[$i][1]?></h1>
                <img src="public/images/maison1.jpg" class="maison">
                <nav class="liste_piece">
                    <ul class ="liste_piece">
                        <?php
                        for ($j = 0; $j < count($piece[$i]); $j++) {
                            echo '<li>
                            <a href="index.php?cible=dashboard&fonction=capteurs&idPiece=' . $piece[$i][$j][0] . '">'
                                . $piece[$i][$j][1] . '</a></li>';
                        }
                        ?>
                    </ul>
                </nav>
            </label>
</div><?php }?>


<!--
<div class="Conteneur">
    <ul class="clearfix">
        <?php
/*
        for ($i = 0; $i < count($appartement); $i++) {
            echo '<li class="1stLevel"><a href="">' . $appartement[$i][1] . '</a>'; //$appartement[$i][0] = id appart
                echo '<ul>';
                    for ($j = 0; $j < count($piece[$i]); $j++) {
                        //echo '<li class="2ndLevel"><a href="http://localhost/APP_Info/plateformeV3/index.php?cible=dashboard&amp;fonction=capteur&amp;idAppartement='.$appartement[$i][0].'&amp;idPiece='.$piece[$i][$j][0].'">'. $piece[$i][$j][1] .'</a></li>';
                        echo '<li class="2ndLevel"><a href="index.php?cible=dashboard&fonction=capteurs&idPiece=' . $piece[$i][$j][0] . '">' . $piece[$i][$j][1] . '</a></li>';
                    }
                echo '</ul>';
            echo '</li>';
        }
*/
?>
    </ul>
</div>
-->
</body>

<?php include "vues/templates/Footer.php" ?>
</html>
