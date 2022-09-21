<?php
define('ROOT_PATH', dirname(__DIR__));

use Slim\Factory\AppFactory;


require ROOT_PATH . '/vendor/autoload.php';

// Instantiate App
$app = AppFactory::create();

// Add error middleware
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// Add routes
require_once ROOT_PATH . '/src/routes/apiRouter.php';
require_once ROOT_PATH . '/src/routes/webRouter.php';


// $errorHandler = $errorMiddleware->getDefaultErrorHandler();
// $errorHandler->forceContentType('application/json');

$app->run();