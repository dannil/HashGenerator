<?php
// DIC configuratio

$container = $app->getContainer();

// -----------------------------------------------------------------------------
// Service providers
// -----------------------------------------------------------------------------

// Twig
$container['view'] = function ($c) {
    $settings = $c->get('settings');
    $view = new \Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);

    // Add extensions
    $view->addExtension(new Slim\Views\TwigExtension($c->get('router'), $c->get('request')->getUri()));
    $view->addExtension(new Twig_Extension_Debug());
    
    // Add global variables
    $view->getEnvironment()->addGlobal('version', HashGenerator\Model\Constants::getVersion());
    $view->getEnvironment()->addGlobal('publishDate', HashGenerator\Model\Constants::getPublishDate());

    return $view;
};

// cache
$container['cache'] = function () {
	return new \Slim\HttpCache\CacheProvider();
};

$container['session'] = function () {
	return new \RKA\Session();
};

// -----------------------------------------------------------------------------
// Service factories
// -----------------------------------------------------------------------------

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings');
    $logger = new \Monolog\Logger($settings['logger']['name']);
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['logger']['path'], \Monolog\Logger::DEBUG));
    return $logger;
};

// -----------------------------------------------------------------------------
// Action factories
// -----------------------------------------------------------------------------

// $container['HashGenerator\Controller\IndexController'] = function ($c) {
//     return new HashGenerator\Controller\IndexController($c->get('view'), $c->get('session'), $c->get('logger'));
// };

$container['HashGenerator\Controller\IndexController'] = function ($c) {
	return new HashGenerator\Controller\IndexController($c);
};

