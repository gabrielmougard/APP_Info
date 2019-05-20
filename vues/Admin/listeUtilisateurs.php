<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="public/css/stylePlaintes.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Liste des utilisateurs</title>
</head>

<?php include "vues/templates/header.php" ?>

<body>

<p><input type="recherche" name="recherche" class="form-control" required placeholder="Rechercher"></p>

<div class="objet">
    <p class="listeuser">Nom d'utilisateur</p>
    <p class="listeuser">E-mail</p>
    <p class="listeuser">Principal/Secondaire</p>
    <i class="fa fa-user-plus adduser listeuser fa-3x" aria-hidden="true"></i>
</div>
</body>

<?php include "vues/templates/Footer.php" ?>
</html>