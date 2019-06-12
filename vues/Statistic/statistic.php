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

    <!-- lien pour les icones -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css" integrity="sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y" crossorigin="anonymous">

    <!-- livechart -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="http://code.highcharts.com/modules/exporting.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.js"></script>
    <script src="http://code.highcharts.com/modules/export-data.js"></script>


</head>

<script>
    var chartThermo; // global
    var chartLum;
    var chartPres;

    //console.log(document.getElementsByName('sensorBut'));
    //var sensorBut = document.getElementsByName('sensorBut');

    /**
     * Request data from the server, add it to the graph and set a timeout to request data
     */

    function requestDataThermo() {
        $.ajax({
            url: 'http://localhost/APP_Info-master/live-chart-thermo.php', //03
            success: function(point) {
                var series = chartThermo.series[0],
                    shift = series.data.length > 20; //shift if the series if longer than 20

                //add the point
                chartThermo.series[0].addPoint(point,true,shift);

                // call it again after one second
                setTimeout(requestDataThermo, 500);
            },
            cache: false
        });
    }

    function requestDataLum() {
        $.ajax({
            url: 'http://localhost/APP_Info-master/live-chart-lum.php', //05
            success: function(point) {
                var series = chartLum.series[0],
                    shift = series.data.length > 20; //shift if the series if longer than 20

                //add the point
                chartLum.series[0].addPoint(point,true,shift);

                // call it again after one second
                setTimeout(requestDataLum, 500);
            },
            cache: false
        });
    }

    function requestDataPresence() {
        $.ajax({
            url: 'http://localhost/APP_Info-master/live-chart-presence.php', //07
            success: function(point) {
                var series = chartPres.series[0],
                    shift = series.data.length > 20; //shift if the series if longer than 20

                //add the point
                chartPres.series[0].addPoint(point,true,shift);

                // call it again after one second
                setTimeout(requestDataPresence, 500);
            },
            cache: false
        });
    }


    document.addEventListener('DOMContentLoaded', function() { //sinon 'DOMContentLoaded'

        chartThermo = Highcharts.chart('container1', {
            chart: {
                type: 'spline',
                events: {
                    load: requestDataThermo
                }
            },
            title: {
                text: 'Relevé du thermomètre (en °C)'
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 150,
                maxZoom: 20*1000
            },
            yAxis: {
                minPadding: 0.2,
                maxPadding: 0.2,
                title: {
                    text: 'degrés celsius (°C)',
                    margin: 80
                }
            },
            series: [{
                name: 'température en fonction du temps',
                data: []
            }]
        });

        chartLum = Highcharts.chart('container2', {
            chart: {
                type: 'spline',
                events: {
                    load: requestDataLum
                }
            },
            title: {
                text: 'Relevé du capteur de luminosité (en lux)'
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 150,
                maxZoom: 20*1000
            },
            yAxis: {
                minPadding: 0.2,
                maxPadding: 0.2,
                title: {
                    text: 'lux',
                    margin: 80
                }
            },
            series: [{
                name: 'luminosité en fonction du temps',
                data: []
            }]
        });

        chartPres = Highcharts.chart('container3', {
            chart: {
                type: 'spline',
                events: {
                    load: requestDataPresence
                }
            },
            title: {
                text: 'Relevé du capteur de présence (en mètres)'
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 150,
                maxZoom: 20*1000
            },
            yAxis: {
                minPadding: 0.2,
                maxPadding: 0.2,
                title: {
                    text: 'mètres (m)',
                    margin: 80
                }
            },
            series: [{
                name: 'proximité en fonction du temps',
                data: []
            }]
        });

    });


</script>




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
            echo '<a href="http://localhost/APP_Info-master/index.php?cible=dashboard&fonction=statistiques&appartSelect='.$value[0].'"><button>' . $value[1] . '</button></a>';
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
        echo '<a href="http://localhost/APP_Info-master/index.php?cible=dashboard&fonction=statistiques&appartSelect='.$_GET['appartSelect'].'&pieceSelect='.$value[0].'"><button >' . $value[1] . '</button></a>';
    }
    ?>
</div>

<div class="conteneur_stat">

    <div class="bloc1">
        <h1 id="releve"> Relevés statistiques en temps réel</h1>
        <div class="piece">
            <?php
            foreach($composants as $key=>$value) {
                echo "<button name='sensorBut' id='$value[1]' onclick='changer(this.id)'> $value[1] </button>";
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
                            text: '',
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

<div id="container1" style="width: 1110px; height: 400px; margin: 0 auto;"></div>
<div id="container2" style="width: 1110px; height: 400px; margin: 0 auto;"></div>
<div id="container3" style="width: 1110px; height: 400px; margin: 0 auto;"></div>

</body>

<?php include "vues/templates/Footer.php" ?>
</html>