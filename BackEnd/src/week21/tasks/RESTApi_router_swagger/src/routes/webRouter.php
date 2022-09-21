<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteCollectorProxy;

$app->get('/', function (Request $request, Response $response, array $args) {
    
    $response->getBody()->write('<a href="api/v1/apidocs">api/v1/apidocs</a>');

    return $response;
});

$app->get('/api/v1/apidocs', function (Request $request, Response $response, array $args) {
    
    $response->getBody()->write(file_get_contents(ROOT_PATH . '/resources/views/api/documentation.html'));

    return $response;
});