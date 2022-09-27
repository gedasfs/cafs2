<?php

use DI\Container;
use Slim\Views\PhpRenderer;
use Slim\Factory\AppFactory;

// Setup container
$container = new Container();

// Register components on container
// $container->set('view', function() {
//     return new PhpRenderer(ROOT_PATH . env('TEMPLATES_PATH'));
// });


AppFactory::setContainer($container);