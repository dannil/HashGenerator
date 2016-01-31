<?php

namespace HashGenerator\Controller;

use HashGenerator\Model\Hash;

use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use Slim\Views\Twig;

class IndexController {
	
	private $view;
	private $logger;
	
	private $hash;
	
	public function __construct(Twig $view, LoggerInterface $logger) {
		$this->view = $view;
		$this->logger = $logger;
		
		$this->hash = new Hash();
	}
	
	public function index(Request $request, Response $response) {
		$this->logger->info('Index page loading');
		
		$params = array('algorithms' => $this->hash->getAllowed());
		$this->view->render($response, 'index.twig', $params);
		
		return $response;
	}
	
	public function hash(Request $request, Response $response) {
		$body = $request->getParsedBody();
		
		$hashInput = $body['hashInput'];
		$algorithm = $body['algorithm'];
		
		$hashedString = $this->hash->getHash($hashInput, $algorithm);
		
		$this->logger->info('Hashed ' . $hashInput . ' to ' . $hashedString);
		
		$params = array('hashInput' => $hashInput, 
					 	'algorithms' => $this->hash->getAllowed(), 
						'hashedString' => $hashedString);
		$this->view->render($response, 'index.twig', $params);
		
		//$params = array('test' => 'this is a test');
		//$this->view->render($response, $params);
		
		return $response;
	}
	
}

?>