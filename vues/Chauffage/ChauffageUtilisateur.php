<?php
/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 23/05/2019
 * Time: 19:40
 */
?>
<head>
    <meta charset="UTF-8">
    <title>Chauffage</title>
    <link rel="stylesheet" href="public/css/chauffageUtilisateur.css">
</head>

<?php include "vues/templates/header.php" ?>

<body>

<div class="conteneur_tempMaxUser">
    <div id="tempUser">Température Utilisateur : <?php echo $tempUser?> °C</div>
    <form action="index.php?cible=dashboard&fonction=chauffage" method="post">
        Modifier la température Utilisateur:<br>
        <input type="number" name="modifTempUser"><br><input type="submit" value="Valider">
    </form>
</div>
<div class="conteneur_tempMaxGes">
    <div id="tempGest"> Température Gestionnaire : <?php echo $tempGest?> °C</div>
</div>

</body>

<?php include "vues/templates/Footer.php" ?>

</html>
