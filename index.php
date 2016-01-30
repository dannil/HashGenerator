<?php

require_once 'vendor/autoload.php';

//require_once 'src\HashGenerator\Controller\HomeController.php';

use HashGenerator\Controller\HomeController;

$app = new \Slim\App();
$container = $app->getContainer();

$container['HashGenerator\Controller\HomeController'] = function ($c) {
	//echo "hello";
    return new HashGenerator\Controller\HomeController();
};

$app->get('/', 'HashGenerator\Controller\HomeController:hello');

$app->run();

?>