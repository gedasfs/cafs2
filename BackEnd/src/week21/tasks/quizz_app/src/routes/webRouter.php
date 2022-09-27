<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Classes\Card;
use App\Controllers\QuizzController;

// $app->get('/', [QuizzController::class, 'show']);

$app->get('/', function (Request $request, Response $response, $args) {

    $quizzList = file_get_contents(ROOT_PATH . env('QUIZZ_LISTNAMES_PATH'));
    $quizzList = json_decode($quizzList, true);

    $viewVars = [
        'quizzList' => $quizzList
    ];

    return $this->get('view')->render($response, 'index.phtml', $viewVars);
})->setName('index');



$app->get('/quizzes/{quizzName}', function (Request $request, Response $response, $args) {

    $quizzName = $args['quizzName'];

    if (isset($_COOKIE['quizzName']) && $_COOKIE['quizzName'] == $quizzName) {
        $userId = $_COOKIE['userId'];

        $userProgressFilePath = sprintf('%s/%s/%s.json', ROOT_PATH, env('QUIZZ_USERS_PROGRESS_PATH'), $userId);
        $userPreviousSessionData = json_decode(file_get_contents($userProgressFilePath), true);
        $userPreviousSessionData['nextQuizzQNo'] = $_COOKIE['quizzQ'] + 1;

        $_SESSION['quizzData'] = $userPreviousSessionData;

        $viewVars = $userPreviousSessionData;


        $view = $this->get('view');
        return $view->render($response, 'quizzContinue.phtml', $viewVars);
    }

    $quizzFilePath = sprintf('%s/%s/%s.json', ROOT_PATH, env('QUIZZ_QUESTIONS_PATH'), $quizzName);
    
    if(!file_exists($quizzFilePath)) {
        throw new Exception('Quizz file not found.', 404);
    }

    $quizzData = file_get_contents($quizzFilePath);
    $quizzData = json_decode($quizzData, true);

    $quizzData['quizzName'] = $quizzName;
    
    $_SESSION['quizzData'] = $quizzData;
    $_SESSION['quizzData']['totalQuestions'] = count($quizzData['questions']);
    
    
    $viewVars = $quizzData;
    $view = $this->get('view');
    return $view->render($response, 'quizz.phtml', $viewVars);
});


$app->post('/quizzes/{quizzName}/{qNo:[0-9]+}', function (Request $request, Response $response, $args) {
    
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
            $answerNo = $_POST['radio'];

            $_SESSION['quizzData']['questions'][$prevQNo - 1]['a'] = $answerNo;

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
});


$app->post('/quizzes/{quizzName}/{qNo:finish}', function (Request $request, Response $response, $args) {
    
    $prevQNo = $_SESSION['quizzData']['totalQuestions'];
    $answerNo = $_POST['radio'];
    $_SESSION['quizzData']['questions'][$prevQNo - 1]['a'] = $answerNo;

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

});

$app->get('/quizzes/{quizzName}/results', function (Request $request, Response $response, $args) {
    $quizzName = $args['quizzName'];
    $name = $_SESSION['quizzData']['name'];
    $totalPossiblePoints = $_SESSION['quizzData']['totalPossiblePoints'];
    $totalPoints = $_SESSION['quizzData']['totalPoints'];
    $viewVars = [
        'name' => $name, 
        'totalPoints' => $totalPoints,
        'totalPossiblePoints' => $totalPossiblePoints
    ];

    $view = $this->get('view');
    return $view->render($response, 'quizzResults.phtml', $viewVars);
});


// redirects
$app->redirect('/quizzes[/]', '/', 301);