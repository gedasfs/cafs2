<?php
define('ROOT_PATH', dirname(__DIR__));


$envFilePath = ROOT_PATH . '/.env';

if (file_exists($envFilePath)) {
    define('ENV', parse_ini_file($envFilePath));
} else {
    throw new Exception('Env file not found');
}

require_once ROOT_PATH . '/src/helpers.php';
require ROOT_PATH . '/vendor/autoload.php';

use Slim\Factory\AppFactory;



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