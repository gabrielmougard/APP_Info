<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modifier son compte</title>
    <link rel="stylesheet" href="public/css/compte.css">
</head>

<?php include 'vues/templates/header.php'?>

<body>
<form id="form-monCompote" action="index.php?cible=dashboard&fonction=modifCompte" method="post">

    <h2>Nom</h2>
    <p class="nom">
        <input type="Nom" name="nom" class="form-control" value="<?php echo $nom[0][0]?>" autofocus style="border:none;">
    </p>

    <h2>Prénom</h2>
    <p class="prenom">
        <input type="Prenom" name="prenom" class="form-control" value="<?php echo $prenom[0][0]?>" autofocus style="border:none;">
    </p>

    <h2>Email</h2>
    <p class="email">
        <input type="email" name="email" class="form-control" value="<?php echo $email[0][0]?>" style="border: none;">
    </p>


    <button type="submit"> Confirmer les modifications </button> <!--mettre un bouton -->
</form>

</body>
</html>

<?php include "vues/templates/Footer.php" ?>