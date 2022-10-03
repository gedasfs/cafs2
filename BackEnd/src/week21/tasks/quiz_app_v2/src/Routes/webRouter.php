<?php

use Slim\Routing\RouteCollectorProxy;

use  App\Controllers\QuizController;


$app->get('/', [QuizController::class, 'index']);

$app->group('/quizzes', function (RouteCollectorProxy $group) {
    $group->get('/{quizName}', [QuizController::class, 'prepare']);
    $group->post('/{quizName}/{questionId}', [QuizController::class, 'start']);
});