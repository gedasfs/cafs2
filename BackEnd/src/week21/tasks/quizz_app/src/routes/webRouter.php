<?php

use App\Controllers\QuizzController;


$app->get('/', [QuizzController::class, 'index']);
$app->get('/quizzes/{quizzName}', [QuizzController::class, 'start']);
$app->post('/quizzes/{quizzName}/{qNo:[0-9]+}', [QuizzController::class, 'proccessIntermadiate']);
$app->post('/quizzes/{quizzName}/{qNo:finish}', [QuizzController::class, 'proccessFinish']);
$app->get('/quizzes/{quizzName}/results', [QuizzController::class, 'results']);

// redirects
$app->redirect('/quizzes[/]', '/', 301);