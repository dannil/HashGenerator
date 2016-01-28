<?php

require __DIR__ . '/../application/includes/Hash.class.php';

class HashTest extends PHPUnit_Framework_TestCase {
	
	protected $hash;
	
	protected function setUp() {
		$this->hash = new Hash();
	}
	
	public function testGetHashSHA1() {
		$this->assertEquals("6adfb183a4a2c94a2f92dab5ade762a47889a5a1", $this->hash->getHash('helloworld', 'sha1'));
	}
	
}