<?php

use Slim\Factory\AppFactory;


require __DIR__ . '/../vendor/autoload.php';

// Instantiate App
$app = AppFactory::create();

// Add error middleware
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// Add routes
require_once __DIR__ . '/../src/routes/apiRouter.php';


// $errorHandler = $errorMiddleware->getDefaultErrorHandler();
// $errorHandler->forceContentType('application/json');

$app->run();