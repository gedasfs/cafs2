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

    // $view = $this->get('view');
    return $this->get('view')->render($response, 'index.phtml', $viewVars);
})->setName('index');



$app->get('/quizzes/{quizzName}', function (Request $request, Response $response, $args) {

    $quizzName = $args['quizzName'];

    $quizzFilePath = sprintf('%s/%s/%s.json', ROOT_PATH, env('QUIZZ_QUESTIONS_PATH'), $quizzName);
    
    if(!file_exists($quizzFilePath)) {
        throw new Exception('Quizz file not found.', 404);
    }

    $quizzData = file_get_contents($quizzFilePath);
    $quizzData = json_decode($quizzData, true);

    $quizzData['quizzName'] = $quizzName;
    
    $_SESSION['quizzData'] = $quizzData;
    $_SESSION['quizzData']['totalQuestions'] = count($quizzData['questions']);
    // $_SESSION['quizzData']['currQuestion'] = 1;
    // $_SESSION['quizzData']['totalPoints'] = array_sum(array_column($quizzData['questions'], 'points'));
    // $_SESSION['quizzData']['totalCorrects'] = 0;
    
    
    $viewVars = $quizzData;
    $view = $this->get('view');
    return $view->render($response, 'quizz.phtml', $viewVars);
});


$app->post('/quizzes/{quizzName}/{qNo:[0-9]+}', function (Request $request, Response $response, $args) {
    
    $quizzName = $args['quizzName'];
    $qNo = $args['qNo'];
    
    $showQuestionNo = $qNo - 1;
    

    if ($qNo > 1) {
        $prevQNo = $qNo - 1;
        $answerNo = $_POST['radio'];

        $_SESSION['quizzData']['questions'][$prevQNo - 1]['a'] = $answerNo;
    }

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

    foreach ($_SESSION['quizzData']['questions'] as $qNo => &$question) {
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

    // var_dump($_SESSION);
    // exit;

    $view = $this->get('view');
    return $view->render($response, 'quizzResults.phtml', $viewVars);
});


// redirects
$app->redirect('/quizzes[/]', '/', 301);