<?php
$filePathBase = 'data/';
$ext = 'json';
$response = [];

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $receivedJson = file_get_contents('php://input');
    
        $receivedData = json_decode($receivedJson, true);
        $writtenDataFiles = [];
    
        foreach ($receivedData['results'] as $user) {
            $userFilePath = sprintf('%s%s.%s', $filePathBase, $user['login']['uuid'], $ext);
            file_put_contents($userFilePath, json_encode($user));
            $writtenDataFiles[] = $userFilePath;
        }

        
        if (count($writtenDataFiles) === 0) {
            throw new Exception('Data was not saved', 500);
        }

        $response = [
            'error' => false,
            'statusCode' => 201,
            'responseMsg' => 'Users created successfully',
            'responseContent' => $writtenDataFiles,
            'contentType' => 'application/json',
        ];
    } else {
        throw new Exception('Request method not post', 405);
    }  
} catch (Exception $e) {
    $response = [
        'error' => true,
        'statusCode' => $e->getCode(),
        'responseMsg' => $e->getMessage(),
        'responseContent' => null,
        'contentType' => null,
    ];
} finally {
    echo json_encode($response);
}