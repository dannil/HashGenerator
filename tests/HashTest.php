<?php

require __DIR__ . '/../application/includes/Hash.php';

class HashTest extends PHPUnit_Framework_TestCase {
	
	protected $hash;
	
	protected function setUp() {
		$this->hash = new Hash();
	}
	
	public function testGetDefault() {
		$this->assertEquals("sha256", $this->hash->getDefault());
	}
	
	public function testGetAllowed() {
		$this->assertNotNull($this->hash->getAllowed());
	}
	
	public function testGetHashSHA1() {
		$this->assertEquals("6adfb183a4a2c94a2f92dab5ade762a47889a5a1", $this->hash->getHash("helloworld", "sha1"));
	}
	
	public function testGetHashMD5() {
		$this->assertEquals("fc5e038d38a57032085441e7fe7010b0", $this->hash->getHash("helloworld", "md5"));
	}
	
	public function testGetHashInvalidAlgorithm() {
		// Test that the hash function defaults to SHA256 in case of invalid algorithm
		$this->assertEquals($this->hash->getHash("helloworld", "sha256"), $this->hash->getHash("helloworld", "NONEXISTINGALGORITHM"));
	}
	
}