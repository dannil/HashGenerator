<?php

namespace HashGenerator\Controller;

use HashGenerator\Model\Hash;

use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use Slim\App;
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
		$hashInput = (isset($_SESSION['hashInput']) ? $_SESSION['hashInput'] : '');
		$usedAlgorithm = (isset($_SESSION['usedAlgorithm']) ? $_SESSION['usedAlgorithm'] : $this->hash->getDefault());
		$hashedString = (isset($_SESSION['hashedString']) ? $_SESSION['hashedString'] : '');
		
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
		// $this->logger->info('Hashed ' . $hashInput . ' to ' . $hashedString);
		
		$_SESSION['hashInput'] = $hashInput;
		$_SESSION['usedAlgorithm'] = $usedAlgorithm;
		$_SESSION['hashedString'] = $hashedString;

		// Change to a dynamic path in the future
		return $response->withRedirect('/HashGenerator/public', 302);
	}
	
}

?>