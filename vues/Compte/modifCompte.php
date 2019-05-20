<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mon Compte</title>
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

    <!--   <h2>Mot de passe actuel</h2>
       <p class="ActuelMdp">
           <input type="password" name="password" class="form-control" required placeholder="Mot de passe actuel" style="border:none;">
       </p>

       <h2>Nouveau mot de passe</h2>
       <p class="nvMdp">
           <input type="password" name="newPassword" class="form-control" required placeholder="Nouveau mot de passe"style="border:none;">
       </p>

       <h2>Répéter le mot de passe</h2>
       <p class="remdp">
           <input type="password" name="confirmPassword" class="form-control" required placeholder="Répéter le mot de passe"style="border:none;">
       </p>
   -->
    <button type="submit"> Confirmer les modifications </button> <!--mettre un bouton -->
</form>

</body>
</html>

<?php include "vues/templates/Footer.php" ?>