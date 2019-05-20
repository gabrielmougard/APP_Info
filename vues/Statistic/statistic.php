<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Statistiques </title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/header.css">
    <link rel="stylesheet" href="public/css/statistic.css">

    <script src="public/js/plotly/plotly.js"></script>
    <script src="public/js/statistiques.js"></script>

    <! -- lien pour les icones -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css" integrity="sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y" crossorigin="anonymous">

</head>

<?php include "vues/templates/header.php" ?>

<body>
<script>var tram = <?php echo json_encode($trame); ?>;
    //alert(tram[0][1][1]);</script>

<script>var trameGraph=[];
    //console.log(trameGraph);
    var val=[];
    var time=[]
    //console.log(time)


</script>



<div class="conteneur_stat2">

    <div class="conteneur_stat2_2">
        <?php
        foreach($appart as $key=>$value) {
            echo '<a href="http://localhost/APP_Info/index.php?cible=dashboard&fonction=statistiques&appartSelect='.$value[0].'"><button>' . $value[1] . '</button></a>';
        }
        ?>
    </div>

    <div class="conteneur_stat2_2">
        <h2> </h2>
    </div>

</div>

<div class="conteneur_comp">
    <?php

    foreach($piece as $key=>$value) {
        echo '<a href="http://localhost/APP_Info/index.php?cible=dashboard&fonction=statistiques&appartSelect='.$_GET['appartSelect'].'&pieceSelect='.$value[0].'"><button >' . $value[1] . '</button></a>';
    }

    ?>
</div>

<div class="conteneur_stat">

    <div class="bloc1">
        <h1 id="releve"> Relevés statistiques en temps réel</h1>
        <div class="piece">
            <?php

            foreach($composants as $key=>$value) {
                echo "<button id='$value[1]' onclick='changer(this.id)'> $value[1] </button>";
            }?>
        </div>
    </div>

    <div class="bloc1">
        <h3>Graphique:</h3>
        <div id="myDiv" style="width:600px;height:250px;">
            <script id="Graph">
                myDiv = document.getElementById('myDiv');
                trace={
                    x: time,
                    y: val,
                    type: 'scatter',
                    fill: 'tozeroy',
                    mode: 'none'};
                data=[trace];
                layout={
                    xaxis:{
                        title:{
                            text: 'Temps',
                            font: {
                                family: 'Lato',
                                size: 18,
                                color: '#666666'
                            }
                        }
                    },
                    yaxis:{
                        title:{
                            text: '°C',
                            font: {
                                family: 'Lato',
                                size: 18,
                                color: '#666666',
                                rotate: 90
                            }
                        }
                    }
                };
                Plotly.newPlot( myDiv, data,layout);
            </script>

        </div>
    </div>

</div>

</body>

<?php include "vues/templates/Footer.php" ?>
</html>