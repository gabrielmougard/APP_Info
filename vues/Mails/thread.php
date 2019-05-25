<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 24/05/19
 * Time: 15:46
 */
?>
<link rel="stylesheet" type="text/css" href="public/css/inbox.css">
<script type="text/javascript" src="js/jquery.js"></script>
<link rel="stylesheet" href="public/css/header.css">
<link rel="stylesheet" href="public/css/navigationBurger2.css" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<body>
<div class="conteneur_header">
    <div class="bloc">
        <?php include "vues/templates/navigationBurger.php"?>
    </div>
    <div class="bloc">
        <img src="public/images/background.png" alt="logo" class="logo">
    </div>

    <div class="bloc">
        <a href="index.php?cible=inbox&fonction=mails&p=1&uid=<?php echo $_SESSION['id']?>" class="m-link"><i class="fa fa-envelope" aria-hidden="true"></i> Messagerie </a>
        <a href="index.php?cible=authentification&fonction=logout" class="m-link"><i class="fas fa-sign-out-alt"></i> Se déconnecter </a>
    </div>
</div>

<?php
//var_dump($res);
for ($i = 0; $i < count($res); $i++) {

    echo '<div id="msg">';
    echo '<a href="index.php?cible=inbox&fonction=mails&p=1&uid='.$_GET["idUser"].'">← Boite de Reception</a>';
    echo '<table>';
	echo '<tr>';
	echo '<td>De : <strong>'. $res[$i]["emailUser"] .'</strong></td><td>Email : <strong>'. $res[$i]["emailUser"] .'</strong></td><td>Objet : <strong>'. $res[$i]["subject"] .'</strong></td>';
    echo '</tr>';
    echo '</table>';
    echo '<pre>'.$res[$i]["contenu"].'</pre>';
    for ($j = 0; $j < substr_count( $res[$i]["contenu"], "\n" )+4; $j++) {
        //echo substr_count( $res[$i]["contenu"], "\n");
        echo '<br>';
    }

    echo '<a class="remove btn danger" href="index.php">Effacer</a>';
    echo '<a class="remove btn info" href="index.php?cible=inbox&fonction=msg&new=false&idUser='.$_GET['idUser'].'&idTicket='.$_GET["idTicket"].'">Répondre</a>';
    echo '</div>';
}
?>


</body>

<script type="text/javascript">

    $('.remove').click(function(){
        var agree=confirm("Etes vous sûr ?");
        if (agree) {
            return true;
        }else {
            return false;
        }
    });

</script>
