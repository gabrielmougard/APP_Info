<head>
    <meta charset="UTF-8">
    <title>Catalogue</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/style_catalogue.css">
</head>

<?php include "vues/templates/header.php" ?>

<body>
<div class="conteneur_catalogue">
    <?php
    for ($i = 0; $i < count($produits); $i++) { ?>
        <?php $infosProduit=datasheetProduit($bdd,$allId[$i][0]); ?>
        <div class="catalogue">
            <?php
            echo'<label for="'.$i.'">';
            ?>
            <h1><?php echo $produits[$i][0]//nom ?></h1>
            <?php
            if ($infosProduit[0][1]== 123456) {
                $image = "public/images/capteurLuminosite.jpg";

            }
            ?>
            <?php
            if ($infosProduit[0][1] == 789456) {
                $image = "public/images/capteurIR.jpg";

            }
            ?>
            <?php
            if ($infosProduit[0][1] == 654987) {
                $image = "public/images/capteurTemperature.jpg";

            }
            ?>

            <?php print '<img src="'.$image.'"/>'; ?>

            <nav class="liste_produits">
                <ul>
                    <?php
                    echo '<li class="prix"> '. $produits[$i][1] . '€</li>'; //prix


                    echo '<li><a href="index.php?cible=catalogue&fonction=datasheet&reference='.$infosProduit[0][1].'">Voir la fiche technique</a></li>'
                    ?>
                </ul>

            </nav>
        </div>
    <?php } ?>
</body>

<?php include "vues/templates/footer.php" ?>