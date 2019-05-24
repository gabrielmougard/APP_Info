<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 07/05/19
 * Time: 14:17
 */

// Ignore Warnings
error_reporting(E_ALL & ~E_NOTICE & ~8192);


?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inbox System</title>
<link rel="stylesheet" type="text/css" href="public/css/inbox.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<script type="text/javascript" src="public/js/jquery.js"></script>
</head>

<body>

<script type="text/javascript">
    $("body").prepend('<div id="loading"><img src="public/images/loading.gif" alt="Loading.." title="Loading.." /></div>');

$(window).load(function(){
    $("#inbox, #msg").fadeIn("slow");
    $("#loading").fadeOut("slow");
});

</script>

<!-- button for sending new email to the admin community -->
<div class="round-button"><div class="round-button-circle"><a href="index.php?cible=inbox&fonction=msg&new=true&idUser=<?php echo $_SESSION["id"]?>" class="round-button"><i class="far fa-comment-dots"></i></a></div></div>

<div id="inbox">

    <table>

        <tr>
            <th>N° Ticket</th>
            <th>Email</th>
            <th>Objet</th>
            <th>Envoyé</th>
            <th>Vu</th>

        </tr>

        <?php
        $rows = $_SESSION['threadList'];
        $get_total = count($rows);

        while(!empty($rows)){ //tant que rows n'est pas vide
            $row = array_pop($rows);
            $id = $row["idMessage"];
            $idTicket = $row["idTicket"];
            $email = $row["emailUser"];

            if(strlen($row["subject"]) >= 50){
                $subject = substr($row["subject"],0,50)."..";
            }else {
                $subject = $row['subject'];
            }

            $message = $row['contenu'];


            if($row['ouvert'] == '1'){
                $open = '<img src="img/open.png" alt="Opened" title="Opened" />';
            }else {
                $open = '<img src="img/not_open.png" alt="Opened" title="Opened" />';
            }

            echo '<tr class="border_bottom">';

            echo '<td><a href="index.php?cible=inbox&fonction=thread&idUser='.$_SESSION["id"].'&idMsg='.$id.'&idTicket='.$idTicket.'">'.$idTicket.'</a></td>';
            echo '<td><a href="index.php?cible=inbox&fonction=thread&idUser='.$_SESSION["id"].'&idMsg='.$id.'&idTicket='.$idTicket.'">'.$email.'</a></td>';
            echo '<td><a href="index.php?cible=inbox&fonction=thread&idUser='.$_SESSION["id"].'&idMsg='.$id.'&idTicket='.$idTicket.'">'.$subject.'</a></td>';
            echo '<td><a href="index.php?cible=inbox&fonction=thread&idUser='.$_SESSION["id"].'&idMsg='.$id.'&idTicket='.$idTicket.'">'.$date.'-'.$time.'</a></td>';
            echo '<td><a href="index.php?cible=inbox&fonction=thread&idUser='.$_SESSION["id"].'&idMsg='.$id.'&idTicket='.$idTicket.'">'.$open.'</a></td>';

            echo '</tr>';

        }

        if ($p == $_SESSION['maxPages'] - 1) {
            echo '<tr><td width="100%">Il n\'y a plus de messages pour le moment, revenez plus tard !</td></tr>';
        }


        ?>

    </table>

    <?php if($get_total > $_SESSION["limit"]){ ?>

        <div id="pages">

            <?php
            for($i=1; $i<$_SESSION["maxPages"]; $i++){
                echo ($i == $_GET['p']) ? '<a class="btn active">'.$i.'</a>' : '<a class="btn" href="index.php?cible=inbox&fonction=mails&uid='.$_SESSION['userId'].'&p='.$i.'">'.$i.'</a>';
            }
            ?>

        </div>

    <?php } ?>

</div>
</body>
