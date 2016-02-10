<?php

namespace HashGenerator\Controller;

use HashGenerator\Model\Constants;

class BaseController {
	
	protected $params;
	
	protected function __construct() {
		$constants = new Constants();
		$this->params = array('version' => $constants->getVersion(),
							  'publishDate' => $constants->getPublishDate());
	}
	
	protected function mergeParameters(array $params) {
		return array_merge($this->params, $params);
	}
	
}