<?php

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Monolog\Logger;

use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Interfaces\RouterInterface;

// To help the built-in PHP dev server, check if the request was actually for
// something which should probably be served as a static file
if (PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__) {
    return false;
}

//define("__APPROOT__", __DIR__);

require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../app/settings.php';
// $app = new \Slim\App($settings);

// $container = new \DI\Container();
// AppFactory::setContainer($container);

// $app = AppFactory::create();

$containerBuilder = new ContainerBuilder();

// configure PHP-DI here
$containerBuilder->addDefinitions([
    'settings' => $settings,
    Twig::class => function (ContainerInterface $c) {
        $settings = $c->get('settings');
        $view = new \Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);
        
        // Add extensions
        $view->addExtension(new Slim\Views\TwigExtension($c->get('router'), $c->get('request')->getUri()));
        $view->addExtension(new Twig_Extension_Debug());
        
        // Add global variables
        $view->getEnvironment()->addGlobal('version', HashGenerator\Model\Constants::getVersion());
        $view->getEnvironment()->addGlobal('publishDate', HashGenerator\Model\Constants::getPublishDate());
    },
    RouterInterface::class => function (ContainerInterface $c) {
        
    },
    Logger::class => function(ContainerInterface $c) {
        $settings = $c->get('settings');
        $logger = new \Monolog\Logger($settings['logger']['name']);
        $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
        $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['logger']['path'], \Monolog\Logger::DEBUG));
        return $logger;
    }
]);

AppFactory::setContainer($containerBuilder->build());
$app = AppFactory::create();

// Set up dependencies
require __DIR__ . '/../app/dependencies.php';

// Register middleware
require __DIR__ . '/../app/middleware.php';

// Register routes
require __DIR__ . '/../app/routes.php';

print_r("Hello!");

// Run!
$app->run();
