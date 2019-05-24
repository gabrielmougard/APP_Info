
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Navigation Exemple</title>
    <link rel="stylesheet" href="public/css/navigationBurger2.css" />

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
                <li id="nav-Chauffage"><a href="index.php?cible=dashboard&fonction=chauffage">Chauffage</a></li>
                <li id="nav-Catalogue"><a href="index.php?cible=catalogue&fonction=catalogue">Catalogue</a></li>
                <li id="nav-Statistiques"><a href="index.php?cible=dashboard&fonction=statistiques">Statistiques</a></li>
                <li id="nav-MonCompte"><a href="index.php?cible=dashboard&fonction=compte">Mon compte</a></li>
                <li id="nav-FAQ"><a href="#">FAQ</a></li>
                <?php echo $nav;?>
            </ul>
        </nav>
    </label>
</div>

</body>
</html>