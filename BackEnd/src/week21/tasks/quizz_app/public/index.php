<?php

session_start();


define('ROOT_PATH', dirname(__DIR__));

$envFilePath = ROOT_PATH . '/.env';

if (file_exists($envFilePath)) {
    define('ENV', parse_ini_file($envFilePath));
} else {
    throw new Exception('Env file not found');
}

use Slim\Factory\AppFactory;


require_once ROOT_PATH . '/vendor/autoload.php';

require_once ROOT_PATH . '/src/slimContainers.php';

// Instantiate App
$app = AppFactory::create();

// Add middlewares
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// Add routes
require_once ROOT_PATH . '/src/routes/webRouter.php';


$app->run();