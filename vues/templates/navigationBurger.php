
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Navigation Exemple</title>
    <link rel="stylesheet" href="navigationBurger2.css" />

</head>
<body>

<div class="menu">
    <input id="burger" type="checkbox">
    <label for="burger">
    <i class="fa fa-bars fa-2x" id="hamburger" aria-hidden="true"></i>
    <!--<i class="fa fa-bars fa-2x" id="hamburger" aria-hidden="true"></i>-->
        <nav>
            <ul>
                <li id="nav-TableauDeBord"><a href="index.php?cible=dashboard&fonction=appartementPiece&id=<?php echo $_SESSION['id']?>">Tableau de bord</a></li>
                <li id="nav-Statistiques"><a href="index.php?cible=dashboard&fonction=statistiques">Statistiques</a></li>
                <li id="nav-Catalogue"><a href="index.php?cible=catalogue&fonction=catalogue">Catalogue</a></li>
                <li id="nav-MonCompte"><a href="index.php?cible=dashboard&fonction=compte">Mon compte</a></li>
                <li id="nav-Communaute"><a href="communaute.html">Communauté</a></li>
            </ul>
        </nav>
    </label>
</div>

</body>
</html>