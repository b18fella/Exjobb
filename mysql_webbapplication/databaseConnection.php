<?php
    //Declare the database info.
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $databaseName = "coviddata";

    //Create the connection.
    $databaseConnection = new mysqli($serverName, $userName, $password, $databaseName);

    //Check the connection.
    if ($databaseConnection->connect_error) { die("Connection error: " . $databaseConnection->connect_error); }
    
    $WHO_region = $_GET['query'];
    $sqlQuery = "SELECT * FROM globalcoviddata WHERE WHO_region = '$WHO_region';";
    $queryResult = $databaseConnection->query($sqlQuery);

    if (mysqli_num_rows($queryResult) > 0) {
        $data = new stdClass();
        $datasets = new stdClass();
        $resultArray = array();
        $country = '';
        while ($row = $queryResult->fetch_assoc()) {
            if ($country !== $row['Country']) {
                $resultArray[$row['Country']] = array();
                $country = $row['Country'];
            }
            $resultArray[$row['Country']][] = array(
                'Date_reported' => $row['Date_reported'],
                'Cumulative_cases' => $row['Cumulative_cases'],
                'Cumulative_deaths' => $row['Cumulative_deaths']
            );
        }
        $dates = array();
        $cases = array();
        foreach ($resultArray as $resultArrayRow => $value) {
            $datasets->label = key($resultArray);
            foreach ($value as $key => $valueRow) {
                $cases[] = $valueRow['Cumulative_cases'];
                $dates[] = $valueRow['Date_reported'];
            }
            $datasets->data = $cases;
        }
        $data->labels = $dates;
        $data->datasets = array($datasets);

        echo json_encode($data);
    } else {
        echo "These was no data";
    }

    $databaseConnection->close();
?>