<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

$app->get('/', function (Request $request, Response $response, $args) {

    // $renderer = new PhpRenderer(ROOT_PATH . env('TEMPLATES_PATH'));

    // return $renderer->render($response, 'home.phtml', $args);


    // return $this->view->render($response, 'home.phtml');


    $view = $this->get('view');

    return $view->render($response, 'home.phtml');
})->setName('home');