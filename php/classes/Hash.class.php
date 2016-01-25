<?php

require_once('Functions.class.php');

/**
 * Description of Hash.class.php
 *
 * @author Daniel
 * 
 * Class which contains which specific algorithms that can be used.
 */
class Hash {
    
	// private $functions;
	
    private $defaultAlgorithm;
    
    private $allowedAlgorithms;
    
    public function __construct() {
    	$this->defaultAlgorithm = "sha256";
    	
    	$this->allowedAlgorithms = array("fnv132" => "FNV132", "fnv1a32" => "FNV1A32", "fnv164" => "FNV164", "fnv1a64" => "FNV1A64", 
    									 "haval128,5" => "HAVAL128,5", "haval160,5" => "HAVAL160,5", "haval192,5" => "HAVAL192,5", 
    									 "haval224,5" => "HAVAL224,5", "haval256,5" => "HAVAL256,5", 
    									 "md2" => "MD2", "md4" => "MD4", "md5" => "MD5", 
    									 "ripemd128" => "RIPEMD128", "ripemd160" => "RIPEMD160", "ripemd256" => "RIPEMD256", 
    									 "ripemd320" => "RIPEMD320", 
    									 "sha1" => "SHA1", "sha256" => "SHA256", "sha384" => "SHA384", "sha512" => "SHA512", 
    									 "snefru" => "Snefru", 
    									 "tiger128,3" => "Tiger128,3", "tiger160,3" => "Tiger160,3", "tiger192,3" => "Tiger192,3", 
    									 "whirlpool" => "Whirlpool");
    	
    	// $this->functions = new Functions();
    	
    	$implementedAlgorithms = hash_algos();
    	foreach (array_keys($this->allowedAlgorithms) as $allowedAlgorithm) {
    		if (!in_array($allowedAlgorithm, $implementedAlgorithms)) {
    			unset($this->allowedAlgorithms[$allowedAlgorithm]);
    		}
    	}
    }
    
    public function getDefaultAlgorithm() {
        return $this->defaultAlgorithm;
    }
    
    public function getAllowedAlgorithms() {
    	return $this->allowedAlgorithms;
    }
    
    public function getHash($input, $algorithm) {
        if (array_key_exists(strtolower($algorithm), $this->allowedAlgorithms)) {
        	return hash($algorithm, $input);
        }
        return hash($this->defaultAlgorithm, $input);
    }
    
}
