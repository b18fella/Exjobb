<?php
    $databaseConnection = new MongoDB\Driver\Manager();

    if ($_GET['query'] == 'ALL') {
        $mongoQuery = new MongoDB\Driver\Query([], ['sort' => ['Date_reported' => 1]]);
        $queryResult = $databaseConnection->executeQuery('coviddata.singledocument', $mongoQuery);
    } else {
        $mongoCommand = new MongoDB\Driver\Command([
            'aggregate' => 'singledocument',
            'pipeline' => [
                ['$unwind' => '$data'],
                [ '$match' => [
                    'data.WHO_region' => $_GET['query']
                    ]
                ],
                [ '$group' => [
                    '_id' => null,
                    'data' => [
                        '$push' => [
                            'Date_reported' => '$data.Date_reported',
                            'WHO_region' => '$data.WHO_region',
                            'Country' => '$data.country',
                            'Cumulative_cases' => '$data.Cumulative_cases'
                        ]
                    ]
                ]]
            ],
            'explain' => false]
        );

        $queryResult = $databaseConnection->executeCommand('coviddata', $mongoCommand);
    }
    
    $queryResult = $queryResult->toArray();

    echo json_encode($queryResult);
?>