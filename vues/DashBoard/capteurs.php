<head>
    <meta charset="UTF-8">
    <title>Capteurs</title>
    <link rel="stylesheet" href="public/css/capteurs.css">

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.js"></script>
</head>

<?php include "vues/templates/header.php" ?>

<body>

<div class="conteneur_Cemac">
    <?php
    for ($i = 0; $i < count($composants); $i++) { //Faire un conteneur pour chaque composant?>

        <div class="Composant">
            <a href="./index.php?cible=dashboard&fonction=capteurs&idPiece=<?php echo $_GET['idPiece']?>&sppridComposant=<?php echo $composants[$i][0] ?>"><button class="croix">X</button></a>
            <input id="<?php echo $i;?>" type="checkbox">
            <label for="<?php echo $i;?>">

        <h1><?php echo $infosType[$i][0][0] //Nom du capteur ?></h1>
        <img src="public/images/CapteurDefaut.jpg" class="maison"> <!--A inclure dans le switch pour avoir une image correspondante-->

        <?php
        if (empty($valeurs[$i][0][0])){
            ?>
                <!--<nav class="liste_valeurs">-->
                <ul>
                    <li><i id="flechehaut" class="fa fa-arrow-up fa-2x" aria-hidden="true"></i>
                        <p>En montée</p>
                    </li>
                    <li><i id="pause" class="fa fa-pause fa-2x" aria-hidden="true"></i>
                        <p>A l'arrêt</p>
                    </li>
                    <li><i id="flechebas" class="fa fa-arrow-down fa-2x" aria-hidden="true"></i>
                        <p>En decente</p>
                    </li>
                </ul>
                <!--</nav>-->
            </label>
        </div>
    <?php
            }
            else{//Cas du capteur
                ?>
                <nav class="liste_valeurs">
                <ul class ="liste_valeurs">
                <?php
                //for ($j = 0; $j < count($valeurs[$i]); $j++) {
                    echo '<li>'. $valeurs[$i][0]["Val"] . ' '.$infosType[$i][0][1].'</li>';
                //}
                ?>
                </ul>
                </nav>
                </label>
                </div>
            <?php

        } //Fin Switch?>

        <?php
    }?>
    </div>
<?php
include "vues/templates/Footer.php";
    include("ajouterComposantPopUp.php");
     ?>

</body>
<script>
    var buttonhaut = document.getElementById('flechehaut');


    console.log(buttonhaut);
    buttonhaut.addEventListener('click',function ()
    {
     $.ajax({

         url: "http://localhost/APP_Info-master/index.php?cible=uplink",

         data: {
             instruction : 1
         },

         success:function (data) {

             alert(data);
         }
     });
    })
</script>
</html>

