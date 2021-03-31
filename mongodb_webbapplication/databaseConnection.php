<?php
    $databaseConnection = new MongoDB\Driver\Manager();
    $listDatabases = new MongoDB\Driver\Command(["listCollections" => 1]);
    $result = $databaseConnection->executeCommand("coviddata", $listDatabases);
    $collections = $result->toArray();
    print_r($collections);
?>