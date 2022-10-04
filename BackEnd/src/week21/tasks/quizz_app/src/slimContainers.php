<?php

use DI\Container;
use Slim\Factory\AppFactory;
use Slim\Views\PhpRenderer;

// Setup container
$container = new Container();

// Register components on container
// $container->set('view', function() {
//     return new PhpRenderer(ROOT_PATH . env('TEMPLATES_PATH'));
// });


AppFactory::setContainer($container);