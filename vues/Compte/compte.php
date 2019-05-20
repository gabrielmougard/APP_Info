<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mon Compte</title>
    <link rel="stylesheet" href="public/css/compte.css">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/header.css">
    <link rel="stylesheet" href="public/css/navigationBurger2.css" />
</head>

<?php include 'vues/templates/header.php'?>

<body>

<h2>Nom</h2>
<p class="nom">
    <?php echo $nom[0][0]?>
</p>

<h2>Prénom</h2>
<p class="prenom">
    <?php echo $prenom[0][0]?>
</p>

<h2>Email</h2>
<p class="email">
    <?php echo $email[0][0]?>
</p>

<h2>Mot de passe</h2>
<p class="Mdp">
    *********
</p>

<a class="modif" href="index.php?cible=dashboard&fonction=modifCompte"> Modifier </a>


</body>
</html>

<?php include "vues/templates/Footer.php" ?>