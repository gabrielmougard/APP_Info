<?php 

session_start();
?>
<!DOCTYPE=html>
<html>
    <head>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- Import shoelace.css -->
        <link rel="stylesheet" href="https://cdn.shoelace.style/1.0.0-beta24/shoelace.css">
       

    </head>
    <body>
<?php

$total = 0;


foreach($_SESSION['panier'] as $value) {
    switch($value) {
        case '1':
            echo "Sabre laser vert x1 - 699,99€";?>
            <br>
            <?php
            $total += 699.99;
            break;
        case '2':
            echo "Sabre laser bleu x1 - 799,99€";?>
            <br>
            <?php
            $total += 799.99;
            break;
        case '3':
            echo "Sabre laser rouge x1 - 1999,99€";?>
            <br>
            <?php
            $total += 1999.99;
            break;
    
    }

}

echo "____________________________________";
?>
<br>
<br>
<?php
echo "Total : " . $total . "€";

$_SESSION['total'] = $total;  

?>

<div style="text-align:center;">
    <button type="button" class="button-success" onclick="window.location.href = 'fin.php';">Valider panier !</button>
    <button type="button" class="button-info" onclick="window.location.href = 'index.php';">J'achète encore !</button>
</div>



