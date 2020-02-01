<?php

use Psr\Container\ContainerInterface;

// DIC configuration

$container = $app->getContainer();

// -----------------------------------------------------------------------------
// Service providers
// -----------------------------------------------------------------------------

// Settings
$settings = require __DIR__ . '/../app/settings.php';
$container->set('settings', function(ContainerInterface $container) {
    return $settings;
});

// Twig
$container->set('view', function(ContainerInterface $container) {
    $settings = $c->get('settings');
    $view = new \Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);

    // Add extensions
    $view->addExtension(new Slim\Views\TwigExtension($c->get('router'), $c->get('request')->getUri()));
    $view->addExtension(new Twig_Extension_Debug());
    
    // Add global variables
    $view->getEnvironment()->addGlobal('version', HashGenerator\Model\Constants::getVersion());
    $view->getEnvironment()->addGlobal('publishDate', HashGenerator\Model\Constants::getPublishDate());

    return $view;
});

// cache
$container->set('cache', function(ContainerInterface $container) {
	return new \Slim\HttpCache\CacheProvider();
});

$container->set('session', function(ContainerInterface $container) {
	return new \RKA\Session();
});

// -----------------------------------------------------------------------------
// Service factories
// -----------------------------------------------------------------------------

// monolog
$container->set('logger', function(ContainerInterface $container) {
    $settings = $c->get('settings');
    $logger = new \Monolog\Logger($settings['logger']['name']);
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['logger']['path'], \Monolog\Logger::DEBUG));
    return $logger;
});

// -----------------------------------------------------------------------------
// Action factories
// -----------------------------------------------------------------------------

// $container['HashGenerator\Controller\IndexController'] = function ($c) {
//     return new HashGenerator\Controller\IndexController($c->get('view'), $c->get('session'), $c->get('logger'));
// };

$container->set('HashGenerator\Controller\IndexController', function(ContainerInterface $container) {
	return new HashGenerator\Controller\IndexController($c);
});

