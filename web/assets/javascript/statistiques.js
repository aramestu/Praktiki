//import Chart from 'chart.js/auto';

/*const ctx = document.getElementById("myChart").getContext("2d");
const myChart = new Chart(ctx, {
    type: "line",
    data: {
        labels: [
            "Lundi",
            "Mardi",
            "Mercredi",
            "Jeudi",
            "Vendredi",
            "Samedi",
            "Dimanche",
        ],
        datasets: [{
            label: "frequentation de la semaine",
            data: [
                <?php foreach ($frequentation as $jour => $nombreJoueurs): ?>
<?php echo $nombreJoueurs; ?>,
<?php endforeach; ?>
],
backgroundColor: "rgba(11,59,159,0.6)",
}],
},
});*/

document.addEventListener("DOMContentLoaded", function () {

    let style = getComputedStyle(document.body);
    let stageColor = style.getPropertyValue('--pastelPurple');
    let alternanceColor = style.getPropertyValue('--pastelOrange');

    function calculerPourcentage(chiffre, somme) {
        return (chiffre * 100) / somme;
    }

    function calculerPourcentage3(stage, alternance, rien) {
        const somme = stage + alternance + rien;
        return [calculerPourcentage(stage, somme), calculerPourcentage(alternance, somme), calculerPourcentage(rien, somme)];
    }

    // Récupérer le contenu de la div avec l'id "jsp"
    var listeTexte = document.getElementById("values").textContent;

    // Convertir le contenu en objet JavaScript
    var liste = JSON.parse(listeTexte);

    let stage = 0;
    let alternance = 0;
    let rien = 0;

    // Je commence à 1 pour ne pas avoir le nom
    let taille = liste.length;
    if (taille !== 0) {
        let lastList = liste[taille - 1];

        stage = lastList["nbStage"];
        alternance = lastList["nbAlternance"];
        rien = lastList["nbRien"];
        let sum = stage + alternance + rien;

        stage = (stage * 100) / sum;
        alternance = (alternance * 100) / sum;
        rien = (rien * 100) / sum;

    }

    // Diagramme Fromage
    const pie = document.getElementById('dg1').getContext('2d');
    const myPieChart = new Chart(pie, {
        type: 'pie',
        data: {
            labels: ['Stage', 'Alternance', 'Rien'],
            datasets: [{
                data: [stage, alternance, rien],
                backgroundColor: [stageColor, alternanceColor, '#aef']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            width: 300,
            height: 300,
            plugins: {
                title: {
                    display: true,
                    text: 'Proportion pour l\'année universitaire actuelle',
                    fontSize: 16
                }
            }
        }
    });


    let sumA = 0;
    let sumS = 0;
    let sumR = 0;

    for (let i = 0; i < liste.length; i++) {
        sumS = sumS + liste[i]["nbStage"];
        sumA = sumA + liste[i]["nbAlternance"];
        sumR = sumR + liste[i]["nbRien"];
    }
    let tab = calculerPourcentage3(sumS, sumA, sumR);
    let pourcentageS = tab[0];
    let pourcentageA = tab[1];
    let pourcentageR = tab[2];


    // Diagramme Baton
    const barData = {
        labels: ['Stage', 'Alternance', 'Rien'],
        datasets: [{
            label: 'Pourcentage',
            data: [pourcentageS, pourcentageA, pourcentageR],
            backgroundColor: [stageColor, alternanceColor, '#aef']
        }]
    };

    const barCtx = document.getElementById('dg2').getContext('2d');
    const myHorizontalBarChart = new Chart(barCtx, {
        type: 'bar',
        data: barData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    let nomTab = [];
    let tabStage = [];
    let tabAlternance = [];
    let tabRien = [];
    let tabTemp = [];
    for(let i = 0; i < liste.length; i++){
        nomTab.push(liste[i]["nomAnneeUniversitaire"]);
        tabTemp = calculerPourcentage3(liste[i]["nbStage"], liste[i]["nbAlternance"], liste[i]["nbRien"]);
        tabStage.push(tabTemp[0]);
        tabAlternance.push(tabTemp[1]);
        tabRien.push(tabTemp[2]);
    }




    // Diagramme courbe
    // Données pour la première courbe
    const courbeStage = {
        label: 'Stage',
        data: tabStage,
        borderColor: 'blue',
        borderWidth: 2,
        fill: false, // Pour ne pas remplir l'espace sous la courbe
    };

    // Données pour la deuxième courbe
    const courbeAlternance = {
        label: 'Alternance',
        data: tabAlternance,
        borderColor: 'red',
        borderWidth: 2,
        fill: false,
    };

    // Données pour la deuxième courbe
    const courbeRien = {
        label: 'Rien',
        data: tabRien,
        borderColor: 'red',
        borderWidth: 2,
        fill: false,
    };

    const lineData = {
        labels: nomTab,
        datasets: [courbeStage, courbeAlternance, courbeRien],
    };

    const lineCtx = document.getElementById('dg3').getContext('2d');
    const myLineChart = new Chart(lineCtx, {
        type: 'line',
        data: lineData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    beginAtZero: true,
                },
                y: {
                    beginAtZero: true,
                },
            },
        },
    });


    /*const pieGlobal = document.getElementById('dg2').getContext('2d');
    const myPieChartGlobal = new Chart(pieGlobal, {
        type: 'bar',
        data: {
            datasets: [{
                data: [pourcentageS, pourcentageA, pourcentageR],
                backgroundColor: ['#f50036', '#eeb500', '#aef']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            width: 300,
            height: 300,
            plugins: {
                datalabels: {
                    display: false, // Vous pouvez définir cette propriété à true si vous souhaitez afficher des étiquettes sur les barres
                }
            },
            title: {
                display: true,
                text: 'Proportion depuis le début sans compter l\'année actuelle',
                fontSize: 16
            }
        }
    });*/





});

/*const barData = {
    labels: ['Deuxieme', 'Premier', 'Troisieme'],
    datasets: [{
        label: 'gains',
        data: [<?php echo $deuxieme[1] ?>, <?php echo $premier[1] ?>, <?php echo $troisieme[1] ?>],
backgroundColor: '#f50036',
}],
};

const barCtx = document.getElementById('myHorizontalBarChart').getContext('2d');
const myHorizontalBarChart = new Chart(barCtx, {
    type: 'bar',
    data: barData,
});*/
