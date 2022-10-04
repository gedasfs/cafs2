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

    public function quiz(Request $request, Response $response, $args)
    {
        $quizName = $args['quizName'];
        $questionId = (int) $args['questionId'];

        if ($questionId != 0) {
            // put everything into session
            $userAnswer = (int) $_POST['radio'];
            // var_dump($_SESSION);
            $_SESSION['quiz']['questions'][$questionId -1]['a'] = $userAnswer;
            $_SESSION['quiz']['currQNo'] = $questionId;

            $userFilename = $_SESSION['quiz']['userId'] ?? null;
            
            if ($userFilename) {
                
                setcookie('userId', $_SESSION['quiz']['userId'], (time() + 300));
                setcookie('quizName', $_SESSION['quiz']['quizFilename'], (time() + 300));
                
                $userFilePath = sprintf('%s%s%s.json', ROOT_PATH, $_ENV['QUIZZ_USERS_PROGRESS_PATH'], $userFilename);
                file_put_contents($userFilePath, json_encode($_SESSION['quiz']));
            }
        } else {
            if (isset($_COOKIE['quizName']) && $_COOKIE['quizName'] == $quizName) {
                $userFilename = $_COOKIE['userId'];

                $userFilePath = sprintf('%s%s%s.json', ROOT_PATH, $_ENV['QUIZZ_USERS_PROGRESS_PATH'], $userFilename);
                $quizData = json_decode(file_get_contents($userFilePath), true);

                $_SESSION['quiz'] = $quizData;

            } else {
                $this->quizRep->setQuizData($quizName);
                $quizData = $this->quizRep->getQuizData();
    
                $_SESSION['quiz'] = $quizData;
                $_SESSION['quiz']['currQNo'] = $questionId;
                
                do {
                    $userFilename = generateRandomString(5);
                    $userFilePath = sprintf('%s%s%s.json', ROOT_PATH, $_ENV['QUIZZ_USERS_PROGRESS_PATH'], $userFilename);
                } while (file_exists($userFilePath));
    
                $_SESSION['quiz']['userId'] = $userFilename;
            }
        }
       var_dump($_SESSION);
        $currQNoToShow = $_SESSION['quiz']['currQNo'] + 1;         // due to array indexing (starts from 0) -> +1 is needed to show correct current question No. in question page
        $totalQCount = $_SESSION['quiz']['totalQCount'];
        
        if ($questionId == $totalQCount) {

            $totalPoints = array_sum(array_column($_SESSION['quiz']['questions'], 'possiblePoints'));
            $totalCorrectPoints = 0;

            foreach ($_SESSION['quiz']['questions'] as $question) {
                if ($question['a'] == $question['c']) {
                    $totalCorrectPoints += $question['possiblePoints'];
                }
            }

            $responseData['html'] = sprintf('Congrats. Your results: %s points (out of %s)', $totalCorrectPoints, $totalPoints);
            // write the finish page into the responseData
            $responseData['totalQCount'] = $_SESSION['quiz']['totalQCount'];

            unset($_SESSION['quiz']);
            unset($_COOKIES['quizName']);
            setcookie('userId', $_SESSION['quiz']['userId'], (time() - 1));
            setcookie('quizName', $_SESSION['quiz']['quizFilename'], (time() - 1));
        } else {
            $currQNo = $_SESSION['quiz']['currQNo'];
            $question = $_SESSION['quiz']['questions'][$currQNo];
            $responseData['html'] = Card::buildCardContent($question, $totalQCount, $currQNoToShow, $quizName);
            $responseData['session'] = $_SESSION;
            $responseData['post'] = $_POST['radio'] ?? null;
        }
        $response->getBody()->write(json_encode($responseData));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}