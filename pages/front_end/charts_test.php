<?php
    $array = array(12, 19, 3, 5, 2, 3, 2,3,1,2,4,5);
    $color = array('Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange');
    $json = json_encode($array);
    $json2 = json_encode($color);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
    <title>Document</title>
</head>
<body>
    <canvas id="myChart" width="100" height="25"></canvas>
<script>
const ctx = document.getElementById('myChart');
const myChart = new Chart(ctx, {
    //type: 'pie',
    type: 'bar',
    data: {
        //the number of labels must match the number of elements inside the data attribute in the datasets structure
        //labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        labels: <?php echo $json2; ?>,
        datasets: [{
            label: '# of Votes',
            /*
            this is how u can specify x and y axes
            data: [{x:'2016-12-25', y:20}, {x:'2016-12-26', y:10}]
            */
            data: <?php echo $json; ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            title: {
                // title for the chart
                display: true,//show
                text: 'Color votes',
                font: {//font attributes
                        size: 40
                    }
            },
            legend: {
                labels: {
                font: {
                        size: 20
                    }
            },
            }
        }
    }
});
</script>
</body>
</html>