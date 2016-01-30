<?php

namespace HashGenerator\Controller;


use Slim\Views\Twig;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class HomeController {
	
	public function hello(Request $request, Response $response, $args) {
		echo "Hello Daniel!";
		
		return $response;
	}
	
}

?>