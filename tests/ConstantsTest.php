<?php

require __DIR__ . '/../application/includes/Constants.php';

class ConstantsTest extends PHPUnit_Framework_TestCase {

	public function testGetVersion() {
		$this->assertNotNull(Constants::getVersion());
	}

	public function testGetPublishDate() {
		$this->assertNotNull(Constants::getPublishDate());
	}


}