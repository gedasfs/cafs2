<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class JsonController
{
    // https://www.slimframework.com/docs/v4/objects/response.html#returning-json
    public function someRandomResponse(Request $request, Response $response) : Response
    {
        $data = ['name' => 'Rob', 'age' => 40];

        $payload = json_encode($data);

        $response->getBody()->write($payload);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}