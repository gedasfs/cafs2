<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Views\PhpRenderer;

class QuizzController
{
    private $view;

    public function __construct(PhpRenderer $renderer)
    {
        $this->view = $renderer;
    }

    public function show(Request $request, Response $response, $args)
    {
        $quizzList = file_get_contents(ROOT_PATH . env('QUIZZ_LISTNAMES_PATH'));
        $quizzList = json_decode($quizzList, true);

        $viewVars = [
            'quizzList' => $quizzList
        ];

        return $this->view->render($response, ROOT_PATH . '/resources/views/index.phtml', $viewVars);
    }
}