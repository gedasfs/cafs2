<?php

use Middlewares\TrailingSlash;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

// https://slimframework.com/docs/v4/cookbook/route-patterns.html
$app->add(new TrailingSlash(FALSE));

// // https://www.slimframework.com/docs/v4/concepts/middleware.html
// $beforeMiddleware = function (Request $request, RequestHandler $handler) {
//     $response = $handler->handle($request);
//     $existingContent = (string) $response->getBody();

//     $response = new Response();
//     $response->getBody()->write('BEFORE' . "\n" . $existingContent);

//     return $response;
// };

// $afterMiddleware = function ($request, $handler) {
//     $response = $handler->handle($request);
//     $response->getBody()->write("\n" . 'AFTER');
//     return $response;
// };

// $app->add($beforeMiddleware);
// $app->add($afterMiddleware);