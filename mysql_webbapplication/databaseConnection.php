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
            $datasets[] = $row['New_cases'];
            $datasets[] = $row['Cumulative_cases'];
        }

        echo json_encode($data);
    } else {
        echo "These was no data";
    }

    $databaseConnection->close();
?>