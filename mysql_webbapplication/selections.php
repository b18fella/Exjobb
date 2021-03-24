<?php
    include 'databaseConnection.php';

    if (isset($_POST['WHO_region'])) {
        $sqlQuery = "SELECT Cumulative_cases FROM globalcoviddata WHERE WHO_region =" . $_POST['WHO_region'];

        $queryResult = $databaseConnection->query($sqlQuery);

        while ($row = $queryResult->fetch_assoc()) {

        }
    }
?>

