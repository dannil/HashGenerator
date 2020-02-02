<?php

namespace HashGenerator\Controller;

use HashGenerator\Model\Hash;

use Psr\Container\ContainerInterface as ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

// use Slim\Container;
use Slim\Views\Twig;
use RKA\Session;

class IndexController {
	
	private $container;
	
	private $view;
	private $session;
	private $logger;
	
	private $hash;
	
	public function __construct(ContainerInterface $container) {
        //print_r($container);
        
        var_dump($container);
	    
		$this->container = $container;
		
		$this->view = $this->container->get('view');
		$this->session = $this->container->get('session');
		$this->logger = $this->container->get('logger');
		
		$this->hash = new Hash();
	}
	
	public function index(Request $request, Response $response) {
		$hashInput = $this->session->get('hashInput', '');
		$usedAlgorithm = $this->session->get('usedAlgorithm', $this->hash->getDefault());
		$hashedString = $this->session->get('hashedString', '');
		
		$params = array('hashInput' => $hashInput, 
			 			'algorithms' => $this->hash->getAllowed(), 
						'usedAlgorithm' => $usedAlgorithm,
						'hashedString' => $hashedString);
		
		$this->view->render($response, 'index.twig', $params);
		return $response;
	}
	
	public function hash(Request $request, Response $response) {
		$body = $request->getParsedBody();
		
		$hashInput = $body['hashInput'];
		$usedAlgorithm = $body['usedAlgorithm'];
		$hashedString = $this->hash->getHash($hashInput, $usedAlgorithm);
		
		// For security purposes this is commented; only use for debug
		//$this->logger->info("[" . $usedAlgorithm . "] " . $hashInput . ' --> ' . $hashedString);
		
		$this->session->set('hashInput', $hashInput);
		$this->session->set('usedAlgorithm', $usedAlgorithm);
		$this->session->set('hashedString', $hashedString);
		
		$url = $this->container->get('router')->pathFor('index');
		return $response->withStatus(302)->withHeader('Location', $url);
	}
	
}

?>
