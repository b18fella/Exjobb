<!DOCTYPE html>
<html>
    <head>
        <title>COVID-19 data using MySQL</title>
        <link rel="stylesheet" href="../main.css">
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
            <script>
                function getData(region) {
                    var request = new XMLHttpRequest();

                    request.open("GET", "databaseConnection.php?query=" + region, true);
                    request.send();
                }
            </script>
            <form action="index.php" method="post">
                <select name="WHO_region">
                    <option onclick="getData('EMRO');" name='WHO_region'>Eastern Mediterranean Region</option>
                    <option onclick="getData('EURO');" name='WHO_region'>European Region</option>
                    <option onclick="getData('WPRO');" value="AFRO" name='WHO_region'>African Region</option>
                    <option onclick="getData('WPRO');" name='WHO_region'>Western Pacific Region</option>
                    <option onclick="getData('AMRO');" name='WHO_region'>Region of the Americas</option>
                    <option onclick="getData('SEARO');" name='WHO_region'>South-East Asia Region</option>
                    <option onclick="getData('ALL');" name='WHO_region'>All regions</option>
                </select>
            </form>
            <div id="covidDataContainer">
                <canvas id="covidChart"></canvas>
            </div>
        </section>
        <section id="info">
        </section>
        <section id="cc">
        </section>
    </body>
    <script type='text/javascript'>
    var canvas = document.getElementById('covidChart');
    var covidChart = new Chart(canvas, {
        type: 'line', //Type of chart, in this case, bar chart.
        data: {
            labels: "Test",
            datasets: [{
                label: 'Testing', //Label on top of the chart.
                data: ['1111'], //The data goes here.
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