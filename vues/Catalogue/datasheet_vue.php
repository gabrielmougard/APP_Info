<head>
    <meta charset="UTF-8">
    <title>Catalogue</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/style_catalogue.css">
</head>

<?php include "vues/templates/header.php" ?>

<body>

    <?php
    <p> <?php echo 'Datasheet : ' . $infosProduit[0][0]; ?> </p>
    <p> <?php echo 'Référence : ' . $infosProduit[0][1]; ?> </p>

</body>

<?php include "vues/templates/footer.php" ?>
