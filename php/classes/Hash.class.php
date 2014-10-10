<?php

namespace Hash;

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
    
    public function getHash($input, $algorithm) {
        if (in_array_r($algorithm, $allArrays)) {
            if (in_array($algorithm, $mdArray)) {
                return $this->getMDHash($input, $algorithm);
            }
            if (in_array($algorithm, $ripemdArray)) {
                return $this->getRIPEMDHash($input, $algorithm);
            }
            if (in_array($algorithm, $shaArray)) {
                return $this->getSHAHAsh($input, $algorithm);
            }
        }
    }
    
    public function getMDArray() {
        return $this->mdArray;
    }
    
    public function getMDHash($input, $algorithm) {
        $hashFamily = new HashMD();
        switch ($algorithm) {
            case "MD5":
                return $hashFamily->getMD5Hash($input);
        }
    }
    
    public function getRIPEMDArray() {
        return $this->ripemdArray;
    }
    
    public function getRIPEMDHash($input, $algorithm) {
        $hashFamily = new HashRIPEMD();
        switch ($algorithm) {
            case "RIPEMD128":
                return $hashFamily->getRIPEMD128Hash($input);
            case "RIPEMD160":
                return $hashFamily->getRIPEMD160Hash($input);
            case "RIPEMD256":
                return $hashFamily->getRIPEMD256Hash($input);
            case "RIPEMD320":
                return $hashFamily->getRIPEMD320Hash($input);
        }
    }
    
    public function getSHAArray() {
        return $this->shaArray;
    }
    
    public function getSHAHash($input, $algorithm) {
        $hashFamily = new HashSHA();
        switch ($algorithm) {
            case "SHA1":
                return $hashFamily->getSHA1Hash($input);
            case "SHA256":
                return $hashFamily->getSHA256Hash($input);
            case "SHA384":
                return $hashFamily->getSHA384Hash($input);
            case "SHA512":
                return $hashFamily->getSHA512Hash($input);
        }
    }
    
    public function getTigerArray() {
        return $this->tigerArray;
    }
    
    public function getAllArrays() {
        return $this->allArrays;
    }
    
}
