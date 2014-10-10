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
    
    public function getHash($input, $algorithm) {
        if (in_array_r($algorithm, $this->allArrays)) {
            if (in_array($algorithm, $this->mdArray)) {
                return $this->getMDHash($input, $algorithm);
            }
            if (in_array($algorithm, $this->ripemdArray)) {
                return $this->getRIPEMDHash($input, $algorithm);
            }
            if (in_array($algorithm, $this->shaArray)) {
                return $this->getSHAHash($input, $algorithm);
            }
        } else {
            die("Invalid algorithm");
        }
    }
    
    public function getMDHash($input, $algorithm) {
        require_once('../classes/HashMD.class.php');
        $hashFamily = new HashMD();
        switch ($algorithm) {
            case "MD5":
                return $hashFamily->getMD5Hash($input);
        }
    }

    public function getRIPEMDHash($input, $algorithm) {
        require_once('../classes/HashRIPEMD.class.php');
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
    
    public function getSHAHash($input, $algorithm) {
        require_once('../classes/HashSHA.class.php');
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
    
}
