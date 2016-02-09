<?php

namespace HashGenerator\Test;

use HashGenerator\Controller\BaseController;
use HashGenerator\Model\Constants;

class DummyController extends BaseController {

	public function __construct() {
		parent::__construct();
	}
	
	public function mergeParameters(array $array) {
		return parent::mergeParameters($array);
	}

}

class BaseControllerTest extends \PHPUnit_Framework_TestCase {

	protected $constants;
	protected $dummyController;
	
	protected function setUp() {
		$this->constants = new Constants();
		$this->dummyController = new DummyController();
	}
	
	public function testDefaultParams() {
		$array = $this->dummyController->mergeParameters(array());
		
		$this->assertEquals($this->constants->getVersion(), $array['version']);
		$this->assertEquals($this->constants->getPublishDate(), $array['publishDate']);
	}
	
}