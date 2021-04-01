<?php
    $databaseConnection = new MongoDB\Driver\Manager();
    $listDatabases = new MongoDB\Driver\Command(["find" => "globalcoviddata"]);
    $result = $databaseConnection->executeCommand("coviddata", $listDatabases);
    $collections = $result->toArray();

    foreach ($collections as $collection) {
        echo $collection->WHO_region;
    }
?>