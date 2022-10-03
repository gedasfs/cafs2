<?php

// session_start();

define('ROOT_PATH', dirname(__DIR__));

require_once ROOT_PATH . '/vendor/autoload.php';


$dotenv = Dotenv\Dotenv::createImmutable(ROOT_PATH);
$dotenv->load();

use Slim\Factory\AppFactory;
use Slim\Views\PhpRenderer;
use Psr\Container\ContainerInterface;


$builder = new \DI\ContainerBuilder();

$builder->addDefinitions([
    PhpRenderer::class => function (ContainerInterface $c) {
        $view = new PhpRenderer(ROOT_PATH . $_ENV['TEMPLATES_PATH']);
        return $view;
    },
]);

$container = $builder->build();

AppFactory::setContainer($container);


$app = AppFactory::create();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

require_once ROOT_PATH . '/src/Routes/webRouter.php';

$app->run();
