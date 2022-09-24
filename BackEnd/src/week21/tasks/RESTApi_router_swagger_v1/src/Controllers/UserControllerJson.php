<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserControllerJson extends BaseController
{
    
    public function retrieve(Request $request, Response $response, array $args) : Response
    {
        $username = strtolower($args['username']);

        if (preg_match('/[^a-z_\-0-9]/i', $username)) {

            $responseData = $this->buildResponseData(400, 'Invalid username supplied');
            $payload = $this->transformData($responseData, 'json');
            
            return $this->outputResponse($response, $payload, $responseData['statusCode']);
        }


        $userFilePath = sprintf('%s/%s/%s.json', ROOT_PATH, env('USERS_DATA_FOLDER_PATH'), $username);

        if (!file_exists($userFilePath))
        {
            $responseData = $this->buildResponseData(404, 'User not found');
            $payload = $this->transformData($responseData, 'json');
            
            return $this->outputResponse($response, $payload, $responseData['statusCode']);
        }

        $savedUserInfo = file_get_contents($userFilePath);
        $savedUserInfo = json_decode($savedUserInfo, true);

        $responseData = $this->buildResponseData(200, 'successful operation', $savedUserInfo);
        $payload = $this->transformData($responseData, 'json');

        return $this->outputResponse($response, $payload, $responseData['statusCode']);
    }


    public function store(Request $request, Response $response, array $args, ?string $username = null) : Response
    {   
        
        if (!$this->existsContentTypeInHeaders($request)) {
            $responseData = $this->buildResponseData(500, 'Could not detect incoming content type');
            $payload = $this->transformData($responseData, 'json');
            
            return $this->outputResponse($response, $payload, $responseData['statusCode']);
        }

        if (!$this->isIncomingContTypeSupported($request)) {
            $responseData = $this->buildResponseData(415, 'Unsupported incoming content type');
            $payload = $this->transformData($responseData, 'json');
            
            return $this->outputResponse($response, $payload, $responseData['statusCode']);
        }

        $userInfo = $request->getBody();
        $userInfo = json_decode($userInfo, true);
        $userInfo['createdAt'] = date('Y-m-d H:i:s');
        $username = $username ? $username : strtolower($userInfo['username']);


        $filePath = sprintf('%s/%s/%s.json', ROOT_PATH, env('USERS_DATA_FOLDER_PATH'), $username);
        
        if (file_exists($filePath))
        {
            $responseData = $this->buildResponseData(409, 'Username already exists');
            $payload = $this->transformData($responseData, 'json');
            
            return $this->outputResponse($response, $payload, $responseData['statusCode']);
        }

        $writeResult = file_put_contents($filePath, json_encode($userInfo));

        if (!$writeResult) {
            $responseData = $this->buildResponseData(500, 'Data could not be saved');
            $payload = $this->transformData($responseData, 'json');
            
            return $this->outputResponse($response, $payload, $responseData['statusCode']);
        }

        $responseData = $this->buildResponseData(201, 'successful operation', $userInfo);
        $payload = $this->transformData($responseData, 'json');
        return $this->outputResponse($response, $payload, $responseData['statusCode']);
    }


    public function update(Request $request, Response $response, array $args) : Response
    {   
        $username = strtolower($args['username']);

        if (preg_match('/[^a-z_\-0-9]/i', $username)) {

            $responseData = $this->buildResponseData(400, 'Invalid username supplied');
            $payload = $this->transformData($responseData, 'json');
            
            return $this->outputResponse($response, $payload, $responseData['statusCode']);
        }


        $userFilePath = sprintf('%s/%s/%s.json', ROOT_PATH, env('USERS_DATA_FOLDER_PATH'), $username);

        if (!file_exists($userFilePath))
        {   
            // create user if user does not exists
            $this->store($request, $response, $args, $username);
            return $response;

            // $responseData = $this->buildResponseData(404, 'User not found');
            // $payload = $this->transformData($responseData, 'json');
            
            // return $this->outputResponse($response, $payload, $responseData['statusCode']);
        }
        

        if (!$this->existsContentTypeInHeaders($request)) {
            $responseData = $this->buildResponseData(500, 'Could not detect incoming content type');
            $payload = $this->transformData($responseData, 'json');
            
            return $this->outputResponse($response, $payload, $responseData['statusCode']);
        }


        if (!$this->isIncomingContTypeSupported($request)) {
            $responseData = $this->buildResponseData(415, 'Unsupported incoming content type');
            $payload = $this->transformData($responseData, 'json');
            
            return $this->outputResponse($response, $payload, $responseData['statusCode']);
        }


        $userInfo = $request->getBody();
        $userInfo = json_decode($userInfo, true);
        $userInfo['updatedAt'] = date('Y-m-d H:i:s');

        if (!isset($userInfo['createdAt'])) {
            $savedUserInfo = json_decode(file_get_contents($userFilePath), true);

            $userInfo['createdAt'] = $savedUserInfo['createdAt'];
        }
        
        $writeResult = file_put_contents($userFilePath, json_encode($userInfo));

        if (!$writeResult) {
            $responseData = $this->buildResponseData(500, 'Data could not be saved');
            $payload = $this->transformData($responseData, 'json');
            
            return $this->outputResponse($response, $payload, $responseData['statusCode']);
        }

        $responseData = $this->buildResponseData(200, 'successful operation', $userInfo);
        $payload = $this->transformData($responseData, 'json');
        return $this->outputResponse($response, $payload, $responseData['statusCode']);
    }


    public function delete(Request $request, Response $response, array $args) : Response
    {
        $username = strtolower($args['username']);

        if (preg_match('/[^a-z_\-0-9]/i', $username)) {

            $responseData = $this->buildResponseData(400, 'Invalid username supplied');
            $payload = $this->transformData($responseData, 'json');
            
            return $this->outputResponse($response, $payload, $responseData['statusCode']);
        }


        $userFilePath = sprintf('%s/%s/%s.json', ROOT_PATH, env('USERS_DATA_FOLDER_PATH'), $username);

        if (!file_exists($userFilePath))
        {
            $responseData = $this->buildResponseData(404, 'User not found');
            $payload = $this->transformData($responseData, 'json');
            
            return $this->outputResponse($response, $payload, $responseData['statusCode']);
        }

        $deleteResult = unlink($userFilePath);

        if (!$deleteResult) {
            $responseData = $this->buildResponseData(500, 'Entity could not be deleted');
            $payload = $this->transformData($responseData, 'json');
            
            return $this->outputResponse($response, $payload, $responseData['statusCode']);
        }

        $responseData = $this->buildResponseData(200, 'successful operation');
        $payload = $this->transformData($responseData, 'json');

        return $this->outputResponse($response, $payload, $responseData['statusCode']);
    }
    
    
}