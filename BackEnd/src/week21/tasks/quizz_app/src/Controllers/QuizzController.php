<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

use App\Classes\Card;

class QuizzController
{

    private $viewHandler;

    public function __construct()
    {
        $this->viewHandler = new PhpRenderer(ROOT_PATH . env('TEMPLATES_PATH'));
    }

    public function index(Request $request, Response $response, $args)
    {
        $quizzList = file_get_contents(ROOT_PATH . env('QUIZZ_LISTNAMES_PATH'));
        $quizzList = json_decode($quizzList, true);

        $viewVars = [
            'quizzList' => $quizzList
        ];

        return $this->viewHandler->render($response, 'index.phtml', $viewVars);
    }

    public function start(Request $request, Response $response, $args)
    {   
        $quizzName = $args['quizzName'];

        // if rerturning after quizz was closed unfinished
        if (isset($_COOKIE['quizzName']) && $_COOKIE['quizzName'] == $quizzName) {
            $userId = $_COOKIE['userId'];

            // get saved data from previous session and populate the current session with previous data
            $userProgressFilePath = sprintf('%s/%s/%s.json', ROOT_PATH, env('QUIZZ_USERS_PROGRESS_PATH'), $userId);
            $userPreviousSessionData = json_decode(file_get_contents($userProgressFilePath), true);
            $userPreviousSessionData['nextQuizzQNo'] = $_COOKIE['quizzQ'] + 1;

            $_SESSION['quizzData'] = $userPreviousSessionData;

            $viewVars = $userPreviousSessionData;

            return $this->viewHandler->render($response, 'quizzContinue.phtml', $viewVars);
        }

        // populate the current session with data from file (no answer results)
        $quizzFilePath = sprintf('%s/%s/%s.json', ROOT_PATH, env('QUIZZ_QUESTIONS_PATH'), $quizzName);
        
        if(!file_exists($quizzFilePath)) {
            throw new \Exception('Quizz file not found.', 404);
        }

        $quizzData = file_get_contents($quizzFilePath);
        $quizzData = json_decode($quizzData, true);

        $quizzData['quizzName'] = $quizzName;
        
        $_SESSION['quizzData'] = $quizzData;
        $_SESSION['quizzData']['totalQuestions'] = count($quizzData['questions']);
        
        $viewVars = $quizzData;
        return $this->viewHandler->render($response, 'quizz.phtml', $viewVars);
    }

    public function proccessIntermadiate(Request $request, Response $response, $args)
    {
        $quizzName = $args['quizzName'];
        $qNo = $args['qNo'];
        
        $showQuestionNo = $qNo - 1;
        $prevQNo = $qNo - 1;
        

        if ($qNo == 1) {

            do {
                $userId = generateRandomString(5);
                $userProgressFilePath = sprintf('%s%s/%s.json', ROOT_PATH, env('QUIZZ_USERS_PROGRESS_PATH'), $userId);
            } while (file_exists($userProgressFilePath));

            file_put_contents($userProgressFilePath, json_encode($_SESSION['quizzData']));

            $_SESSION['quizzData']['userId'] = $userId;

        } elseif ($qNo > 1) {
            
            if (isset($_POST['continue']) && $_POST['continue'] == true) {

            } else {
                $answerValue = $_POST['radio'];

                $_SESSION['quizzData']['questions'][$prevQNo - 1]['a'] = $answerValue;

                $userId = $_SESSION['quizzData']['userId'];
                $userProgressFilePath = sprintf('%s%s/%s.json', ROOT_PATH, env('QUIZZ_USERS_PROGRESS_PATH'), $userId);

                file_put_contents($userProgressFilePath , json_encode($_SESSION['quizzData']));
            }
            
        }

        setcookie('userId', $_SESSION['quizzData']['userId'], time() + env('PROGRESS_COOKIE_LIFETIME'));
        setcookie('quizzName', $quizzName, time() + env('PROGRESS_COOKIE_LIFETIME'));
        setcookie('quizzQ', $prevQNo, time() + env('PROGRESS_COOKIE_LIFETIME'));
        
        // build question section
        $questionHtmlContent = Card::buildCardContent(
            $_SESSION['quizzData']['questions'][$showQuestionNo],
            $_SESSION['quizzData']['totalQuestions'],
            $qNo,
            $quizzName
        );
        
        $responseData['data'] = $questionHtmlContent;
        $response->getBody()->write($responseData['data']);

        return $response
            ->withHeader('Content-Type', 'text/plain')
            ->withStatus(200);
    }

    public function proccessFinish(Request $request, Response $response, $args)
    {
        $prevQNo = $_SESSION['quizzData']['totalQuestions'];
        $answerValue = $_POST['radio'];

        // get last answer
        $_SESSION['quizzData']['questions'][$prevQNo - 1]['a'] = $answerValue;
    
        foreach ($_SESSION['quizzData']['questions'] as &$question) {
            if ($question['a'] == $question['c']) {
                $question['p'] = $question['possiblePoints'];
            }
        }
    
        $totalPossiblePoints = array_sum(array_column($_SESSION['quizzData']['questions'], 'possiblePoints'));
        $_SESSION['quizzData']['totalPossiblePoints'] = $totalPossiblePoints;
    
        $sumCorrectPoints = array_sum(array_column($_SESSION['quizzData']['questions'], 'p'));
        $_SESSION['quizzData']['totalPoints'] = $sumCorrectPoints;
    
    
        $quizzName = $args['quizzName'];
        $responseData['data'] = sprintf('/quizzes/%s/results', $quizzName);
        
        // delete previously saved data
        $userProgressFilePath = sprintf('%s%s/%s.json', ROOT_PATH, env('QUIZZ_USERS_PROGRESS_PATH'),  $_SESSION['quizzData']['userId']);
        unlink($userProgressFilePath);
        unset($_SESSION['quizzData']['userId']);
        setcookie('userId', '', time() - 3600);
        setcookie('quizzName', '', time() - 3600);
        setcookie('quizzQ', '', time() - 3600);
    
        $response->getBody()->write($responseData['data']);
        return $response
            ->withHeader('Content-Type', 'text/plain')
            ->withStatus(200);
    }

    public function results(Request $request, Response $response, $args)
    {
        $quizzName = $args['quizzName'];
        $name = $_SESSION['quizzData']['name'];
        $totalPossiblePoints = $_SESSION['quizzData']['totalPossiblePoints'];
        $totalPoints = $_SESSION['quizzData']['totalPoints'];
        $viewVars = [
            'name' => $name, 
            'totalPoints' => $totalPoints,
            'totalPossiblePoints' => $totalPossiblePoints
        ];

        return $this->viewHandler->render($response, 'quizzResults.phtml', $viewVars);
    }
}