<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Header </title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/header.css">
    <link rel="stylesheet" href="public/css/navigationBurger2.css" />


    <! -- lien pour les icones -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css" integrity="sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y" crossorigin="anonymous">

</head>

<body>
<header>
    <div class="conteneur_header">
        <div class="bloc">
            <?php include "navigationBurger.php"?>
        </div>
        <div class="bloc">
            <img src="public/images/background.png" alt="logo" class="logo">
        </div>

        <div class="bloc">
            <a href="#" class="m-link"><i class="fa fa-envelope" aria-hidden="true"></i> Messagerie </a>
            <a href="index.php?cible=dashboard&fonction=logout" class="m-link"><i class="fas fa-sign-out-alt"></i> Se déconnecter </a>
        </div>
    </div>
</header>
</body>
</html>