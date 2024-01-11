<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Page</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="VBox">
    <canvas id="test"></canvas>
</div>

<script>
    const pie = document.getElementById('test').getContext('2d');
    const myPieChart = new Chart(pie, {
        type: 'pie',
        data: {
            labels: ['Stage', 'Alternance', 'Rien'],
            datasets: [{
                data: [0.3,0.3,0.3],
                backgroundColor: ['#f50036', '#eeb500', '#aef']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            width: 300,
            height: 300
        }
    });
</script>
</body>
</html>
