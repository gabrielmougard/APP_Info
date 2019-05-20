function trameComposant(arrayTrame,composant){
    var val=0;
    var time=0;
    var arrayTemp=[];
    var result=[];
    var long=arrayTrame.length;
    var insideLong;
    var comp=0;
    if(arrayTrame.length!=0) {
        for (i = 0; i < long; i++) {
            if (arrayTrame[i][0] === composant) {
                insideLong=arrayTrame[i].length;
                for (j = 1; j < insideLong; j++) {
                    val = parseInt(arrayTrame[i][j][0], 10);
                    time = parseInt(arrayTrame[i][j][1], 10);
                    arrayTemp = [val,time];
                    result.push(arrayTemp);
                    comp+=1;

                }
            }
        }
    }
    return result;

}

function valGraph(arrayJs) {
    var result=[];
    for (i = 0; i < arrayJs.length; i++) {
        result.push(arrayJs[i][0])
    }
    return result;
}

function timeGraph(arrayJs) {
    var result=[];

    for (i = 0; i < arrayJs.length; i++) {
        result.push(arrayJs[i][1])
    }
    return result;
}


function changer(composant) {
    console.log(composant);
    trameGraph=trameComposant(tram,composant);
    val=valGraph(trameGraph);
    time=timeGraph(trameGraph);
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

    return ;
}