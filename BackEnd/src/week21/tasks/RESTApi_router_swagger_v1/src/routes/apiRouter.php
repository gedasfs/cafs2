<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteCollectorProxy;

use App\Controllers\UserControllerJson;
use App\Controllers\OrderControllerJson;


// 'Json file saving' based api
$app->group('/api/v1', function (RouteCollectorProxy $group) {
    $group->group('/store/orders', function (RouteCollectorProxy $group) {
        $group->get('/{orderId}', [OrderControllerJson::class, 'retrieve']);
        $group->post('', [OrderControllerJson::class, 'store']);
        $group->delete('/{orderId}', [OrderControllerJson::class, 'delete']);
    });
    
    
    $group->group('/users', function (RouteCollectorProxy $group) {
        $group->get('/{username}', [UserControllerJson::class, 'retrieve']);
        $group->post('', [UserControllerJson::class, 'store']);
        $group->put('/{username}', [UserControllerJson::class, 'update']);
        $group->delete('/{username}', [UserControllerJson::class, 'delete']);
    });
});