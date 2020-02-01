<?php

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

// To help the built-in PHP dev server, check if the request was actually for
// something which should probably be served as a static file
if (PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__) {
    return false;
}

//define("__APPROOT__", __DIR__);

require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
// $settings = require __DIR__ . '/../app/settings.php';
// $app = new \Slim\App($settings);

$container = new \DI\Container();
AppFactory::setContainer($container);

$app = AppFactory::create();

// Set up dependencies
require __DIR__ . '/../app/dependencies.php';

// Register middleware
require __DIR__ . '/../app/middleware.php';

// Register routes
require __DIR__ . '/../app/routes.php';

// Run!
$app->run();
