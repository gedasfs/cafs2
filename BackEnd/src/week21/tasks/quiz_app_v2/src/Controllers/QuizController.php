<?php

namespace App\Controllers;

use Slim\Views\PhpRenderer;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Repositories\QuizRepository;
use App\Classes\Card;

class QuizController
{
    private $viewHandler;
    private $quizRep;

    public function __construct(PhpRenderer $viewHandler, QuizRepository $quizRep)
    {
        $this->viewHandler = $viewHandler;
        $this->quizRep = $quizRep;
    }

    public function index(Request $request, Response $response, $args) : Response
    {
        $quizList = $this->quizRep->getQuizList();
        $viewVars = [
            'quizList' => $quizList
        ];

        return $this->viewHandler->render($response, 'index.phtml', $viewVars);
    }

    public function prepare(Request $request, Response $response, $args) : Response
    {
        $quizName = $args['quizName'];

        $this->quizRep->setQuizData($quizName);
        $quizData = $this->quizRep->getQuizData();

        extract($quizData);

        $viewVars = [
            'name' => $name,
            'description' => $description,
            'quizFilename' => $quizFilename
        ];

        return $this->viewHandler->render($response, 'quiz.phtml', $viewVars);
    }

    public function start(Request $request, Response $response, $args)
    {
        $quizName = $args['quizName'];
        $questionId = $args['questionId'];

        // if ($questionId != 0) {
        //     $_SESSION[$quizName] = 
        // }
        
        $this->quizRep->setQuizData($quizName);
        $quizData = $this->quizRep->getQuizData();

        $questions = $quizData['questions'][$questionId];
        $totalQ = count($quizData['questions']);
        $currQ = $questionId + 1;       // due to array indexing (starts from 0) -> +1 is needed to show correct current question No.
        
        $responseData['data'] = Card::buildCardContent($questions, $totalQ, $currQ, $quizName);
        $response->getBody()->write($responseData['data']);

        return $response->withHeader('Content-Type', 'text/html')->withStatus(200);
    }
}