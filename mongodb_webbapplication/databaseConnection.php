<?php
    $databaseConnection = new MongoDB\Driver\Manager();

    if ($_GET['query'] == 'ALL') {
        $mongoQuery = new MongoDB\Driver\Query([]);
    } else {
        $mongoQuery = new MongoDB\Driver\Query(['WHO_region' => $_GET['query']], ['sort' => ['Date_reported' => 1]]);
    }

    $queryResult = $databaseConnection->executeQuery('coviddata.globalcoviddata', $mongoQuery);
    $queryResult = $queryResult->toArray();


    echo json_encode($queryResult);
?>