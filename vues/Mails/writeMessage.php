<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 06/05/19
 * Time: 08:40
 */
?>
<?php include "vues/templates/header.php" ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Quiescis - contact support</title>
    <link rel="stylesheet" type="text/css" href="public/css/contact.css">

</head>

<body>
<?php

var_dump($new);

?>

<div class="container">
    <form id="contact" action="index.php?cible=inbox&fonction=add&idUser=<?php $_GET["idUser"]?>" method="post">
        <h3>Démarrer un fil de discussion</h3>
        <h4>Nous vous répondons dans les 24h !</h4>
        <textarea style="height: 40px" name="subject" placeholder="Entrez l'objet de la plainte..." tabindex="2" required></textarea>
        <textarea name="content" placeholder="Entrez votre mesage de plainte...." tabindex="5" required></textarea>
        </fieldset>
        <fieldset>
            <button name="submit" type="submit" id="contact-submit" data-submit="...Envoie">Envoyer</button>
        </fieldset>
        <input type="hidden" name="new" value=<?php echo $new?> />
        <?php
        if(isset($_GET["idTicket"])) {
            echo '<input type="hidden" name="idTicket" value='.$_GET["idTicket"].'/>';
        }
        ?>
    </form>


</div>
</body>
<?php include "vues/templates/Footer.php" ?>