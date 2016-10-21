<?php

namespace HashGenerator\Controller;

use HashGenerator\Controller\BaseController;
use HashGenerator\Model\Hash;

use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use Slim\App;
use Slim\Views\Twig;
use RKA\Session;

class IndexController extends BaseController {
	
	private $view;
	private $session;
	private $logger;
	
	private $hash;
	
	public function __construct(Twig $view, Session $session, LoggerInterface $logger) {
		parent::__construct();
		
		$this->view = $view;
		$this->logger = $logger;
		$this->session = $session;
		
		$this->hash = new Hash();
	}
	
	public function index(Request $request, Response $response) {
		$hashInput = $this->session->get('hashInput', '');
		$usedAlgorithm = $this->session->get('usedAlgorithm', '');
		$hashedString = $this->session->get('hashedString', '');
		
		$params = array('hashInput' => $hashInput, 
			 			'algorithms' => $this->hash->getAllowed(), 
						'usedAlgorithm' => $usedAlgorithm,
						'hashedString' => $hashedString);
		
		$params = parent::mergeParameters($params);
		
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

		// Change to a dynamic path in the future
		return $response->withRedirect('/HashGenerator/public', 302);
	}
	
}

?>