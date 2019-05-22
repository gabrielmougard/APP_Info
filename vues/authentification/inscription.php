<?php

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />

    <link rel="stylesheet" href='public/css/style_inscription.css' />
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/header.css">
    <link rel="stylesheet" href="public/css/accueil.css">
    <link rel="stylesheet" href="public/css/Footer.css">

    <link rel="stylesheet" href='public/css/style_inscription.css' />
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/header.css">
    <link rel="stylesheet" href="public/css/accueil.css">
    <link rel="stylesheet" href="public/css/Footer.css">
    <link rel="stylesheet" href="public/css/style_boutons.css">
    <title>Inscription</title>

</head>

<body>
    

<h1 class=bienvenue>Bienvenue sur Quiescis !</h1>
<h2 classe=creer_compte>Créez votre compte Quiescis gratuitement pour commencer</h2>


<form id="form-inscription" action="index.php?cible=authentification&fonction=inscription" method="post">


    	<p class="nom">
    		<input type="nom" name="name" class="form-control" required placeholder="Nom" autofocus style="border:none;">
    	</p>

        <p class="prenom">
            <input type="prenom" name="firstname" class="form-control" required placeholder="Prenom" autofocus style="border:none;">
        </p>

    	<p class="email">
    		<input type="email" name="email" class="form-control" required placeholder="E-mail" style="border: none;">
        </p>

    	<p class="mdp">
    		<input type="password" name="password" class="form-control" required placeholder="Mot de passe" style="border:none;">
    	</p>

    	<p class="remdp">
            <input type="password" name="confirmPassword" class="form-control" required placeholder="Répéter le mot de passe"style="border:none;">
        </p>

    	<p class="accepte">
            <input type="checkbox" name="CGU" value="true" >J'ai lu et j'accepte la politique de l'entreprise
        </p>

    	<p class="inscrire"> <button type="submit"> S'inscrire</button></p> <!--mettre un bouton -->
</form>
    	<p class="dejacompte">Vous avez déjà un compte ? <a href="index.php?cible=authentification&fonction=connexion" style="color: #8eca78ff">Connexion</a></p>
</body>
</html>
