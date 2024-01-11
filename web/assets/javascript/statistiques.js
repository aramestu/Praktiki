import Chart from 'chart.js/auto';

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

const pie = document.getElementById('myPieChart').getContext('2d');
const myPieChart = new Chart(pie, {
    type: 'pie',
    data: {
        labels: ['gain du casino', 'gain des joueurs'],
        datasets: [{
            data: [<?php echo $PourcentageGainCasino ?>, <?php echo $PourcentageGainJoueur ?>],
backgroundColor: ['#f50036', '#eeb500'],
}]
},
options: {
    responsive: true,
        maintainAspectRatio: false,
        width: 300,
        height: 300
}
});

const barData = {
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
});
