<?php
/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 24/05/2019
 * Time: 13:56
 */
?>
<head>
    <meta charset="UTF-8">
    <title>Chauffage</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="public/css/header.css">
    <link rel="stylesheet" href="public/css/gestionaire.css">
    <link rel="stylesheet" href="public/css/dashboard_style.css">
    <link rel="stylesheet" href="public/css/chauffageGestionnaire.css">
</head>

<?php include "vues/templates/header.php" ?>

<body>

<div class="conteneur_tempMaxGes">
    <div id="tempGest"> Température Gestionnaire : <?php echo $tempGest?> °C</div>
    <form class="modif" action="index.php?cible=dashboard&fonction=chauffageGestionnaire" method="post">

        Chauffage
        <label class="switch"><input type="checkbox"><span class="slider"></span></label><br>
        Modifier la température Gestionnaire:<br>
        <input class="input" type="number" name="modifTempGes"><br><input class="input" type="submit" value="Valider" min="15" max="60">
    </form>
</div>

</body>

<?php include "vues/templates/Footer.php" ?>

</html>