<?php

namespace HashGenerator\Controller;

use HashGenerator\Model\Constants;

class BaseController {
	
	protected $params;
	
	protected function __construct() {
		$this->params = array('version' => Constants::getVersion(),
							  'publishDate' => Constants::getPublishDate());
	}
	
	protected function mergeParameters(array $params) {
		return array_merge($this->params, $params);
	}
	
}