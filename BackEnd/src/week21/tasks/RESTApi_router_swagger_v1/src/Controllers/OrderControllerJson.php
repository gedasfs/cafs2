<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class OrderControllerJson extends BaseController
{
    
    public function retrieve(Request $request, Response $response, array $args) : Response
    {
        $orderId = strtolower($args['orderId']);

        if (preg_match('/[^_\-0-9]/i', $orderId)) {

            $responseData = $this->buildResponseData(400, 'Invalid order id supplied');
            $payload = $this->transformData($responseData, 'json');
            
            return $this->outputResponse($response, $payload, $responseData['statusCode']);
        }


        $orderFilePath = sprintf('%s/%s/%s.json', ROOT_PATH, env('ORDERS_DATA_FOLDER_PATH'), $orderId);

        if (!file_exists($orderFilePath))
        {
            $responseData = $this->buildResponseData(404, 'Order not found');
            $payload = $this->transformData($responseData, 'json');
            
            return $this->outputResponse($response, $payload, $responseData['statusCode']);
        }

        $savedOrderInfo = file_get_contents($orderFilePath);
        $savedOrderInfo = json_decode($savedOrderInfo, true);

        $responseData = $this->buildResponseData(200, 'successful operation', $savedOrderInfo);
        $payload = $this->transformData($responseData, 'json');

        return $this->outputResponse($response, $payload, $responseData['statusCode']);
    }


    public function store(Request $request, Response $response, array $args, ?string $orderId = null) : Response
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

        $orderInfo = $request->getBody();
        $orderInfo = json_decode($orderInfo, true);
        $orderInfo['createdAt'] = date('Y-m-d H:i:s');
        $orderId = $orderId ? $orderId : strtolower($orderInfo['id']);


        $filePath = sprintf('%s/%s/%s.json', ROOT_PATH, env('ORDERS_DATA_FOLDER_PATH'), $orderId);
        
        if (file_exists($filePath))
        {
            $responseData = $this->buildResponseData(409, 'Order already exists');
            $payload = $this->transformData($responseData, 'json');
            
            return $this->outputResponse($response, $payload, $responseData['statusCode']);
        }

        $writeResult = file_put_contents($filePath, json_encode($orderInfo));

        if (!$writeResult) {
            $responseData = $this->buildResponseData(500, 'Data could not be saved');
            $payload = $this->transformData($responseData, 'json');
            
            return $this->outputResponse($response, $payload, $responseData['statusCode']);
        }

        $responseData = $this->buildResponseData(201, 'successful operation', $orderInfo);
        $payload = $this->transformData($responseData, 'json');
        return $this->outputResponse($response, $payload, $responseData['statusCode']);
    }


    public function update(Request $request, Response $response, array $args) : Response
    {   
        $orderId = strtolower($args['orderId']);

        if (preg_match('/[^_\-0-9]/i', $orderId)) {

            $responseData = $this->buildResponseData(400, 'Invalid order id supplied');
            $payload = $this->transformData($responseData, 'json');
            
            return $this->outputResponse($response, $payload, $responseData['statusCode']);
        }


        $filePath = sprintf('%s/%s/%s.json', ROOT_PATH, env('ORDERS_DATA_FOLDER_PATH'), $orderId);

        if (!file_exists($filePath))
        {   
            // create user if user does not exists
            $this->store($request, $response, $args, $orderId);
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


        $orderInfo = $request->getBody();
        $orderInfo = json_decode($orderInfo, true);
        $orderInfo['updatedAt'] = date('Y-m-d H:i:s');

        if (!isset($orderInfo['createdAt'])) {
            $savedOrderInfo = json_decode(file_get_contents($filePath), true);

            $orderInfo['createdAt'] = $savedOrderInfo['createdAt'];
        }
        
        $writeResult = file_put_contents($filePath, json_encode($orderInfo));

        if (!$writeResult) {
            $responseData = $this->buildResponseData(500, 'Data could not be saved');
            $payload = $this->transformData($responseData, 'json');
            
            return $this->outputResponse($response, $payload, $responseData['statusCode']);
        }

        $responseData = $this->buildResponseData(200, 'successful operation', $orderInfo);
        $payload = $this->transformData($responseData, 'json');
        return $this->outputResponse($response, $payload, $responseData['statusCode']);
    }


    public function delete(Request $request, Response $response, array $args) : Response
    {
        $orderId = strtolower($args['orderId']);

        if (preg_match('/[^a-z_\-0-9]/i', $orderId)) {

            $responseData = $this->buildResponseData(400, 'Invalid order id supplied');
            $payload = $this->transformData($responseData, 'json');
            
            return $this->outputResponse($response, $payload, $responseData['statusCode']);
        }


        $filePath = sprintf('%s/%s/%s.json', ROOT_PATH, env('ORDERS_DATA_FOLDER_PATH'), $orderId);

        if (!file_exists($filePath))
        {
            $responseData = $this->buildResponseData(404, 'Order not found');
            $payload = $this->transformData($responseData, 'json');
            
            return $this->outputResponse($response, $payload, $responseData['statusCode']);
        }

        $deleteResult = unlink($filePath);

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