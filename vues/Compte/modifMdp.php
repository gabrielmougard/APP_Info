<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modifier son mot de passe</title>
    <link rel="stylesheet" href="public/css/compte.css">
</head>

<?php include 'vues/templates/header.php'?>

<body>
<form id="form-monCompote" action="index.php?cible=dashboard&fonction=modifMdp" method="post">

    <!--   <h2>Mot de passe actuel</h2>
       <p class="ActuelMdp">
           <input type="password" name="password" class="form-control" required placeholder="Mot de passe actuel" style="border:none;">
       </p>
   -->
    <h2>Nouveau mot de passe</h2>
    <p class="nvMdp">
        <input type="password" name="newPassword" class="form-control" required placeholder="Nouveau mot de passe"style="border:none;">
    </p>

    <h2>Répéter le mot de passe</h2>
    <p class="remdp">
        <input type="password" name="confirmPassword" class="form-control" required placeholder="Répéter le mot de passe"style="border:none;">
    </p>

    <button type="submit"> Confirmer les modifications </button> <!--mettre un bouton -->
</form>

</body>
</html>

<?php include "vues/templates/Footer.php" ?>