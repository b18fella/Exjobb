<?php
    include 'databaseConnection.php';

    if (isset($_POST['WHO_region'])) {
        $sqlQuery = "SELECT Cumulative_cases FROM globalcoviddata WHERE country =" . $_POST['WHO_region'];

        $queryResult = $databaseConnection->query($sqlQuery);

        while ($row = $queryResult->fetch_assoc()) {
            
        }
    }
?>

