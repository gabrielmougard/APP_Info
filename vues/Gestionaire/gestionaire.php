<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Gestionaire </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="public/css/header.css">
    <link rel="stylesheet" href="public/css/gestionaire.css">
    <link rel="stylesheet" href="public/css/dashboard_style.css">


    <! -- lien pour les icones -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css" integrity="sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y" crossorigin="anonymous">

</head>

<?php include "vues/templates/header.php" ?>

<body>
    <div class="conteneur_gestionaire">
        <div class="bloc1">
            <h2>Chauffage</h2>
            <label class="switch"><input type="checkbox"><span class="slider"></span></label>
        </div>
        <div class="bloc1">
            <h2>Temperature max </h2>
            <p><input type="temperature" name="temperature" class="form-control" required placeholder="°C"style="border:none;"></p>
        </div>
    </div>

</body>

<?php include "vues/templates/Footer.php" ?>

</html>