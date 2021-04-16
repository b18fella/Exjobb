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
        $firstCountry = true;
        while ($row = $queryResult->fetch_assoc()) {
            if ($country !== $row['Country']) {
                if ($firstCountry && $country === '') {
                    $resultArray['Date_reported'] = array();
                } else {
                    $firstCountry = false;
                }
                $resultArray[$row['Country']][] = array();
                $country = $row['Country'];
            }
            if ($firstCountry) {
                $resultArray['Date_reported'][] = $row['Date_reported'];
            }
            $resultArray[$row['Country']][] = array(
                'Cumulative_cases' => $row['Cumulative_cases'],
                'Cumulative_deaths' => $row['Cumulative_deaths']
            );
        }

        echo json_encode($resultArray);
    } else {
        echo "These was no data";
    }

    $databaseConnection->close();
?>