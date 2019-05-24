<head>
    <meta charset="UTF-8">
    <title>Datasheet</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/style_catalogue.css">
</head>

<?php include "vues/templates/header.php" ?>

<body>
    <p> <?php echo 'Référence : '?> <br> <?php echo "". $infosProduit[0][1]; ?> </p>
    <p> <?php echo 'Datasheet : '?> <br> <?php echo "". $infosProduit[0][0]; ?> </p>


</body>

<?php include "vues/templates/footer.php" ?>
