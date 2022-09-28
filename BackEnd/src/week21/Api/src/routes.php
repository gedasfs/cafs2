<?php

use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Controllers\JsonController;
use App\Controllers\Api;

$app->get('/', function(Request $request, Response $response) {
    $response->getBody()->write('Hello World.');

    // $response->getBody()->write(file_get_contents(ROOT_PATH . '/views/index.html'));

    return $response;
});

// https://www.slimframework.com/docs/v4/objects/routing.html#container-resolution
$app->get('/json', JsonController::class . ':someRandomResponse');

$app->get('/api/documentation', function(Request $request, Response $response) {
    $response->getBody()->write(file_get_contents(ROOT_PATH . '/views/api/documentation.html'));

    return $response;
});

$app->group('/api/v1', function(RouteCollectorProxy $group) {
    $group->group('/store', function(RouteCollectorProxy $group) {
        $group->post('/orders', [Api\V1\StoreController::class, 'placeOrder']);
        $group->get('/order/{orderId', [Api\V1\StoreController::class, 'getOrder']);
        $group->delete('/orders/{orderId', [Api\V1\StoreController::class, 'deleteOrder']);
    });

    $group->group('/users', function(RouteCollectorProxy $group) {
        $group->post('', [Api\V1\UserController::class, 'store']);
        $group->get('/{username}', [Api\V1\UserController::class, 'find']);
        $group->put('/{username}', [Api\V1\UserController::class, 'update']);
        $group->delete('/{username}', [Api\V1\UserController::class, 'delete']);
    });
});