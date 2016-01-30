<?php

require "../vendor/autoload.php";
use \Slim\App;

$app = new App();

$app->get('/', function ($request, $response, $args) {
	echo "Hello World";
});

$app->run();

?>