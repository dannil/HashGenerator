<?php

namespace HashGenerator\Test;

use HashGenerator\Model\Constants;

class ConstantsTest extends \PHPUnit_Framework_TestCase {

	protected $constants;
	
	protected function setUp() {
		$this->constants = new Constants();
	}
	
	public function testGetVersion() {
		$this->assertNotNull($this->constants->getVersion());
	}

	public function testGetPublishDate() {
		$this->assertNotNull($this->constants->getPublishDate());
	}


}