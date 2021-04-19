<?php
    $databaseConnection = new MongoDB\Driver\Manager();

    if ($_GET['query'] == 'ALL') {
        $mongoQuery = new MongoDB\Driver\Query([]);
    } else {
    $mongoQuery = new MongoDB\Driver\Query(['WHO_region' => $_GET['query']]);
    }

    $queryResult = $databaseConnection->executeQuery('coviddata.globalcoviddata', $mongoQuery);
    $queryResult = $queryResult->toArray();

        $resultArray = array();
        $resultArray['Regions'] = array(
            "EMRO" => array(),
            "EURO" => array(),
            "AFRO" => array(),
            "WPRO" => array(),
            "AMRO" => array(),
            "SEARO" => array(),
            "Other" => array()
        );
        $country = '';
        $firstCountry = true;
        foreach ($queryResult as $row) {
            if ($country !== $row->Country) {
                if ($firstCountry && $country === '') {
                    $resultArray['Date_reported'] = array();
                } else {
                    $firstCountry = false;
                }
                $resultArray['Regions'][$row->WHO_region][$row->Country] = array();
                $country = $row->Country;
            }
            if ($firstCountry) {
                $resultArray['Date_reported'][] = $row->Date_reported;
            }
            $resultArray['Regions'][$row->WHO_region][$row->Country][] = array(
                'Cumulative_cases' => $row->Cumulative_cases,
                'Cumulative_deaths' => $row->Cumulative_deaths
            );
        }

        echo json_encode($resultArray);
?>