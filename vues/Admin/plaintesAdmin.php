<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="public/css/stylePlaintes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Liste des plaintes</title>
</head>

<?php include "vues/templates/header.php" ?>


<body>
    <p><input type="recherche" name="recherche" class="form-control" required placeholder="Rechercher"></p>

    <div class="objet">
        <p class="plainteAdmin">Numéro de plainte</p>
        <p class="plainteAdmin">Type de plainte</p>
        <p class="plainteAdmin"><a href="">Contacter un technicien</a></p>
        <i class="fa fa-trash poubelle plainteAdmin fa-3x" aria-hidden="true"></i>
    </div>

</body>
</html>