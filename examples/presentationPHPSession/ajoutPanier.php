<?php

session_start();

if(empty($_SESSION['panier'])) {
    $_SESSION['panier'] = array();  
}

array_push($_SESSION['panier'],$_GET['idArticle']);
?>

<h3 style="text-align: center;">Votre produit a bien été ajouté au panier !</h3>
<br>
<a href="resumePanier.php" style="text-align: center;">Cliquez ici pour voir votre panier !</a>