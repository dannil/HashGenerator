<?php

namespace HashGenerator\Test;

use HashGenerator\Model\Constants;

use PHPUnit\Framework\TestCase;

class ConstantsTest extends TestCase {
	
	public function testGetVersion() {
		$this->assertNotNull(Constants::getVersion());
	}

	public function testGetPublishDate() {
		$this->assertNotNull(Constants::getPublishDate());
	}


}
