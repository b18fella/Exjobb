<?php
    $databaseConnection = new MongoDB\Driver\Manager();

    if ($_GET['query'] == 'ALL') {
        $mongoCommand = new MongoDB\Driver\Query([]);
    } else {
        $mongoCommand = new MongoDB\Driver\Query(['WHO_region' => $_GET['query']]);
    }

    $queryResult = $databaseConnection->executeQuery('coviddata.globalcoviddata', $mongoCommand);
    $queryResult = $queryResult->toArray();


    echo json_encode($queryResult);
?>