<!DOCTYPE html>
<html>
    <head>
        <title>COVID-19 data using MySQL</title>
        <link rel="stylesheet" href="../main.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
                var data;
                $(document).ready(function() {
                    $("select").on('change', function() {
                        $.ajax({
                            url: 'databaseConnection.php?query=' + this.value,
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                console.log(data);
                                var canvas = document.getElementById('covidChart');
                                var covidChart = new Chart(canvas, {
                                    type: 'line', //Type of chart, in this case, bar chart.
                                    data: data,
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
                            },
                            error: function(request, status, error) {
                                console.error(error);
                            }
                        });
                    });
                });
            </script>
            <form action="index.php" method="post">
                <select name="WHO_region">
                    <option value="EMRO" name='WHO_region'>Eastern Mediterranean Region</option>
                    <option value="EURO" name='WHO_region'>European Region</option>
                    <option value="WPRO" name='WHO_region'>African Region</option>
                    <option value="WPRO" name='WHO_region'>Western Pacific Region</option>
                    <option value="AMRO" name='WHO_region'>Region of the Americas</option>
                    <option value="SEARO" name='WHO_region'>South-East Asia Region</option>
                    <option value="ALL" name='WHO_region'>All regions</option>
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
</html>