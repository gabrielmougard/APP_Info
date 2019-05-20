<?php
//
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />

    <link rel="stylesheet" href="public/css/style_inscription.css" />

    <link rel="stylesheet" href="public/css/style_inscription.css" />
    <link rel="stylesheet" href="public/css/style_boutons.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Connexion</title>

</head>

<body>

<form id="form-inscription" action="index.php?cible=authentification&fonction=connexion" method="post">
    	<h1 class=bienvenue>Bienvenue sur Quiescis !</h1>
    	<h2 classe=creer_compte>Connectez vous pour accéder à vos appartements</h2>
    	<p class="email">
            <input type="email" name="email" class="form-control" required placeholder="E-mail" style="border: none;"></p>
    	<p class="mdp">
            <input type="password" name="password" class="form-control" required placeholder="Mot de passe" style="border:none;"></p>
        <p class="remember">
            <input name="remember_me" type="checkbox" value="rememberme">Se souvenir de moi
        <p class="connecter"><button type="submit">Connexion</button></p>
</form>
<p class="forgotPassword"><a href="index.php?cible=authentification&fonction=forgotPassword" style="color: #8eca78ff">Mot de passe oublié </a></p>

</body>

</html>