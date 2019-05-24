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



<body>
<?php
//var_dump($res);
for ($i = 0; $i < count($res); $i++) {

    echo '<div id="msg">';
    echo '<a href="index.php?cible=inbox&fonction=mails&p=1&uid=">← Boite de Reception</a>';
    echo '<table>';
	echo '<tr>';
	echo '<td>De : <strong>'. $res[$i]["emailUser"] .'</strong></td><td>Email : <strong>'. $res[$i]["emailUser"] .'</strong></td>';
    echo '</tr>';
    echo '</table>';
    echo '<pre>'.$res[$i]["contenu"].'</pre>';
    echo '<br><br>';
    echo '<a class="remove btn danger" href="?remove=<?php echo $id; ?>">Effacer</a>';
    echo '<a class="remove btn info" href="index.php?cible=inbox&fonction=msg&new=false">Répondre</a>';
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