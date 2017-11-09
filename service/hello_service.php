<?php

$apiKey = filter_input(INPUT_GET, 'api_key');
$jsonData = array();
header('Content-type: application/json');
if (isset($apiKey)) {
    $firstName = filter_input(INPUT_GET, 'firstName',
            FILTER_SANITIZE_SPECIAL_CHARS);
    $lastName = filter_input(INPUT_GET, 'lastName',
            FILTER_SANITIZE_SPECIAL_CHARS);
    if (isset($firstName) && isset($lastName) && !empty($firstName) && !empty($lastName)) {
        $jsonData['status'] = 1;
        $jsonData['data'] = $apiKey;
        $jsonData['message'] = 'Hello ' . $firstName . ' ' . $lastName;
    } else {
        $jsonData['status'] = 0;
        $jsonData['data'] = $apiKey;
        $jsonData['message'] = 'Failed to parse data';
    }
    echo json_encode($jsonData);
} else {
    $jsonData['status'] = 2;
    $jsonData['message'] = 'API Key not recognized';
    echo json_encode($jsonData);
}
