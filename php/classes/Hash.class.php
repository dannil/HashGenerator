<?php

/**
 * Description of Hash
 *
 * @author Daniel
 * 
 * Class which contains which specific algorithms that can be used
 */
class Hash {
    
    private $mdArray;
    private $ripemdArray;
    private $shaArray;
    private $tigerArray;
    private $allArrays;
    
    public function __construct() {
        $this->mdArray = array("MD5");
        $this->ripemdArray = array("RIPEMD128", "RIPEMD160", "RIPEMD256", "RIPEMD320");
        $this->shaArray = array("SHA1", "SHA256", "SHA384", "SHA512");
        $this->tigerArray = array("Tiger128", "Tiger160", "Tiger192");
        $this->allArrays = array($this->mdArray, $this->ripemdArray, $this->shaArray, $this->tigerArray);
    }
    
    public function getMDArray() {
        return $this->mdArray;
    }
    
    public function getRIPEMDArray() {
        return $this->ripemdArray;
    }
    
    public function getSHAArray() {
        return $this->shaArray;
    }
    
    public function getTigerArray() {
        return $this->tigerArray;
    }
    
    public function getAllArrays() {
        return $this->allArrays;
    }
    
}
