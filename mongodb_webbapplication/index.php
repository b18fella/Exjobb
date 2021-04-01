<?php
    include 'databaseConnection.php';
?>
<!DOCTYPE html>
<html>
<head>
        <title>COVID-19 data using MongoDB</title>
        <link rel="stylesheet" href="../main.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.min.js"></script>

    </head>
    <body>
        <header>
            <div id="logo">MongoDB</div>
            <ul>
                <a href="#covid-19-data"><li>COVID-19 Data</li></a>
                <a href="#info"><li>Info</li></a>
                <a href="#cc"><li>CC</li></a>
            </ul>
        </header>
        <section id="covid-19-data">
            <?php
                $WHO_region;
                $dates = array();
                $newCases = array();
                $cumulativeCases = array();
                $newDeaths = array();
                $cumulativeDeaths = array();

                if ($_POST['WHO_region'] == 'ALL' || !isset($_POST['WHO_region'])) {
                    $querie = new MongoDB\Driver\Query([]);
                } else if (isset($_POST['WHO_region'])) {
                    $querie = new MongoDB\Driver\Query(['WHO_region' => $_POST['WHO_region']]);
                }
                
                    

                    $result = $databaseConnection->executeQuery("coviddata.globalcoviddata", $querie);
                    $querieResultArray = $result->toArray();

                    $i = 0;

                    foreach ($querieResultArray as $row) {
                        $dates[$i] = $row->Date_reported;
                        $newCases[$i] = $row->New_cases;
                        $cumulativeCases[$i] = $row->Cumulative_cases;
                        $newDeaths[$i] = $row->New_deaths;
                        $cumulativeDeaths[$i] = $row->Cumulative_deaths;

                        $i++;
                    }
            ?>
            <form action="index.php" method="post">
                <select name="WHO_region">
                    <option value="EMRO" name='WHO_region'>Eastern Mediterranean Region</option>
                    <option value="EURO" name='WHO_region'>European Region</option>
                    <option value="AFRO" name='WHO_region'>African Region</option>
                    <option value="WPRO" name='WHO_region'>Western Pacific Region</option>
                    <option value="AMRO" name='WHO_region'>Region of the Americas</option>
                    <option value="SEARO" name='WHO_region'>South-East Asia Region</option>
                    <option value="ALL" name='WHO_region'>All regions</option>
                </select>
                <input type="submit" name="submit" value="Submit">
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
    <?php
        echo "<script type='text/javascript'>
        var canvas = document.getElementById('covidChart');
        var covidChart = new Chart(canvas, {
            type: 'line', //Type of chart, in this case, bar chart.
            data: {
                labels: " . json_encode($dates) . ",
                datasets: [{
                    label: 'Number of cases in', //Label on top of the chart.
                    data: " . json_encode($cumulativeCases) . ", //The data goes here.
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
    </script>";
    ?>
</html>