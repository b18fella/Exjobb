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
        while ($row = $queryResult->fetch_assoc()) {
            $datasets[$row['Country']]['Date_reported'][] = $row['Date_reported'];
            $datasets[$row['Country']]['New_cases'][] = $row['New_cases'];
            $datasets[$row['Country']]['Cumulative_cases'][] = $row['Cumulative_cases'];
            $datasets[$row['Country']]['New_deaths'][] = $row['New_deaths'];
            $datasets[$row['Country']]['Cumulative_deaths'][] = $row['Cumulative_deaths'];
        }

        echo json_encode($datasets);
    } else {
        echo "These was no data";
    }

    $databaseConnection->close();
?>