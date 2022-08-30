<?php

$urlApi = 'https://randomuser.me/api/';
$urlServer = 'nginx/week18/tasks/cURL/server.php';

try {
    // Api request
    $curlOptions = [
        CURLOPT_URL => $urlApi,
        CURLOPT_RETURNTRANSFER => true,
    ];

    $ch = curl_init();
    curl_setopt_array($ch, $curlOptions);

    // To Do: check response code, type, etc.

    $apiResponseJson = curl_exec($ch);
    $apiResponse = json_decode($apiResponseJson, true);

    if (isset($apiResponse['error'])) {
        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        throw new Exception($apiResponse['error'], $responseCode);
        
    }

    // -----------------------------------------------------

    // Server request
    $curlOptions = [
        CURLOPT_URL => $urlServer,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLINFO_HEADER_OUT => true,
        CURLOPT_POSTFIELDS => $apiResponseJson,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($apiResponseJson)
        ]
    ];

    $ch = curl_init();
    curl_setopt_array($ch, $curlOptions);

    $serverResponse = curl_exec($ch);
    curl_close($ch);

    // To Do: check response type

    $responseData = json_decode($serverResponse, true);

    if (isset($responseData['error']) && $responseData['error'] === true) {
        throw new Exception($responseData['responseMsg'], $responseData['statusCode']);
    }

    var_dump($responseData);
} catch (Exception $e) {
    curl_close($ch);
    echo sprintf('Something went wrong. "%s" (%s)', $e->getMessage(), $e->getCode());
}