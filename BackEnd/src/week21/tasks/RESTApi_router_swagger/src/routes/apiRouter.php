<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteCollectorProxy;


$responseData = [
    'ok' => true,
    'statusCode' => 200,
    'msg' => 'successful operation',
    'data' => [],
];

$app->group('/api/v1', function (RouteCollectorProxy $group) use ($responseData) {
    $group->group('/store/orders', function (RouteCollectorProxy $group) use ($responseData) {
        $group->get('/{orderId}', function (Request $request, Response $response, array $args) use($responseData) {
    
            $orderId = $args['orderId'];
    
            if (!is_numeric($orderId)) {
                $responseData['ok'] = false;
                $responseData['statusCode'] = 400;
                $responseData['msg'] = 'Invalid ID supplied';
            } else if ($orderId != 1) {
                $responseData['ok'] = false;
                $responseData['statusCode'] = 404;
                $responseData['msg'] = 'Order not found';
            } else {
                $responseData['data'] = [
                    'id' => $args['orderId'],
                ];
            }
    
            $payload = json_encode($responseData);
    
            $response->getBody()->write($payload);
    
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus($responseData['statusCode']);
        });
    

        $group->post('', function (Request $request, Response $response, array $args) use ($responseData) {
    
            // if order creation ok
            $responseData['data'] = [
                'id' => 1,      // created order id
            ];
    
            $payload = json_encode($responseData);
    
            $response->getBody()->write($payload);
    
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus($responseData['statusCode']);
        });
    

        $group->delete('/{orderId}', function (Request $request, Response $response, array $args) use ($responseData) {
    
            $orderId = $args['orderId'];
    
            if (!is_numeric($orderId)) {
                $responseData['ok'] = false;
                $responseData['statusCode'] = 400;
                $responseData['msg'] = 'Invalid ID supplied';
            } else if ($orderId != 1) {
                $responseData['ok'] = false;
                $responseData['statusCode'] = 404;
                $responseData['msg'] = 'Order not found';
            }
    
            $payload = json_encode($responseData);
    
            $response->getBody()->write($payload);
    
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus($responseData['statusCode']);
        });
    });
    
    
    $group->group('/users', function (RouteCollectorProxy $group) use ($responseData) {
        $group->get('/{username}', function (Request $request, Response $response, array $args) use ($responseData) {
    
            $username = $args['username'];

            if (!preg_match('/[a-z]+/', $username)) {
                $responseData['ok'] = false;
                $responseData['statusCode'] = 400;
                $responseData['msg'] = 'Invalid username supplied';
            } else if ($username != 'name') {
                $responseData['ok'] = false;
                $responseData['statusCode'] = 404;
                $responseData['msg'] = 'User not found';
            } else {
                $responseData['data'] = [
                    'id' => 1,
                    'username' => $username,
                ];
            }

            $payload = json_encode($responseData);
    
            $response->getBody()->write($payload);
    
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus($responseData['statusCode']);
        });
    

        $group->post('', function (Request $request, Response $response, array $args) use ($responseData) {
    
            // if user creation ok
            $responseData['data'] = [
                'id' => 1,      // created order id
                'username' => 'user name'
            ];
    
            $payload = json_encode($responseData);
    
            $response->getBody()->write($payload);
    
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus($responseData['statusCode']);
        });
    

        $group->put('/{username}', function (Request $request, Response $response, array $args) use ($responseData) {
            $username = $args['username'];

            if (!preg_match('/[a-z]+/', $username)) {
                $responseData['ok'] = false;
                $responseData['statusCode'] = 400;
                $responseData['msg'] = 'Invalid username supplied';
            } else if ($username != 'name') {
                $responseData['ok'] = false;
                $responseData['statusCode'] = 404;
                $responseData['msg'] = 'User not found';
            } else {
                $responseData['data'] = [
                    'id' => 1,
                    'username' => $username,
                ];
            }

            $payload = json_encode($responseData);
    
            $response->getBody()->write($payload);
    
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus($responseData['statusCode']);
        });
    

        $group->delete('/{username}', function (Request $request, Response $response, array $args) use ($responseData) {
    
            $username = $args['username'];

            if (!preg_match('/[a-z]+/', $username)) {
                $responseData['ok'] = false;
                $responseData['statusCode'] = 400;
                $responseData['msg'] = 'Invalid username supplied';
            } else if ($username != 'name') {
                $responseData['ok'] = false;
                $responseData['statusCode'] = 404;
                $responseData['msg'] = 'User not found';
            }

            $payload = json_encode($responseData);
    
            $response->getBody()->write($payload);
    
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus($responseData['statusCode']);
        });
    });
});