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
    if($WHO_region == 'ALL') {
        $sqlQuery = "SELECT * FROM globalcoviddata ORDER BY Date_reported, Country;";
    } else {
        $sqlQuery = "SELECT * FROM globalcoviddata WHERE WHO_region = '$WHO_region' ORDER BY Date_reported, Country;";
    }
    
    $queryResult = $databaseConnection->query($sqlQuery);

    if (mysqli_num_rows($queryResult) > 0) {
        $resultArray = array();
        $resultArray['Regions'] = array(
            "EMRO" => array(),
            "EURO" => array(),
            "AFRO" => array(),
            "WPRO" => array(),
            "AMRO" => array(),
            "SEARO" => array(),
            "Other" => array()
        );
        $country = '';
        $firstCountry = true;
        $result = array();
        while ($row = $queryResult->fetch_assoc()) {
            $result[] = $row;
            /*if ($country !== $row['Country']) {
                if ($firstCountry && $country === '') {
                    $resultArray['Date_reported'] = array();
                } else {
                    $firstCountry = false;
                }
                $resultArray['Regions'][$row['WHO_region']][$row['Country']] = array();
                $country = $row['Country'];
            }
            if ($firstCountry) {
                $resultArray['Date_reported'][] = $row['Date_reported'];
            }
            $resultArray['Regions'][$row['WHO_region']][$row['Country']][] = array(
                'Cumulative_cases' => $row['Cumulative_cases'],
                'Cumulative_deaths' => $row['Cumulative_deaths']
            );*/
        }

        echo json_encode($result);
    } else {
        echo "These was no data";
    }

    $databaseConnection->close();
?>