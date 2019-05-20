<?php

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="public/css/style_inscription.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Connexion</title>

</head>

<body>

<form id="form-forgotPassword" action="index.php?cible=authentification&fonction=forgotPassword" method="post">
    	<h2 classe=creer_compte>Indiquez votre mot de passe</h2>
    	<p class="email">
            <input type="email" name="email" class="form-control" required placeholder="E-mail" style="border: none;"></p>
        <p class="connecter"><button type="submit">Reinitialiser mon mot de passe</button></p>
</form>
<p class="dejacompte"><a href="index.php?cible=authentification&fonction=connexion" style="color: #8eca78ff">Connexion</a></p>

</body>

</html>