<!DOCTYPE html>
<html>
    <head>
        <title>COVID-19 data using MySQL</title>
        <link rel="stylesheet" href="main.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.min.js"></script>
    </head>
    <body>
        <header>
            <div id="logo">MySQL</div>
            <ul>
                <a href="#covid-19-data"><li>COVID-19 Data</li></a>
                <a href="#info"><li>Info</li></a>
                <a href="#cc"><li>CC</li></a>
            </ul>
        </header>
        <section id="covid-19-data">
            <canvas id="covidChart" width="300" height="200"></canvas>
        </section>
        <section id="info">
        </section>
        <section id="cc">
        </section>
    </body>

    <script>
        var canvas = document.getElementById('covidChart');
        var covidChart = new Chart(canvas, {
            type: 'bar',
            data: {
                labels: ['Red', 'Black', 'Yellow'],
                datasets: [{
                    label: 'number of cases',
                    data: [15, 20, 31], //The data goes here.
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</html>