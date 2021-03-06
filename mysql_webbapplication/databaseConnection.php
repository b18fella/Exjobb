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
        $queryResult = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);
        echo json_encode($queryResult);
    } else {
        echo "These was no data";
    }

    $databaseConnection->close();
?>