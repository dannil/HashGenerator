<?php

/**
 * Description of Hash
 *
 * @author Daniel
 * 
 * Class which contains which specific algorithms that can be used
 */
class Hash {
    
    private $defaultAlgorithm;
    
    private $mdArray;
    private $ripemdArray;
    private $shaArray;
    private $tigerArray;
    private $whirlpoolArray;
    private $allArrays;
    
    public function __construct() {
        $this->defaultAlgorithm = "sha256";
        
        $this->mdArray = array("md5" => "MD5");
        $this->ripemdArray = array("ripemd128" => "RIPEMD128", "ripemd160" => "RIPEMD160", "ripemd256" => "RIPEMD256", "ripemd320" => "RIPEMD320");
        $this->shaArray = array("sha1" => "SHA1", "sha256" => "SHA256", "sha384" => "SHA384", "sha512" => "SHA512");
        $this->tigerArray = array("tiger128" => "Tiger128", "tiger160" => "Tiger160", "tiger192" => "Tiger192");
        $this->whirlpoolArray = array("whirlpool" => "Whirlpool");
        $this->allArrays = array($this->mdArray, $this->ripemdArray, $this->shaArray, $this->tigerArray, $this->whirlpoolArray);
    }
    
    /* Credits to Tim (http://stackoverflow.com/users/698511/tim) */
    function array_key_exists_r($key, $array) {
        if (array_key_exists($key, $array)) {
            return true;
        }
        foreach ($array as $a) {
            if (!is_array($a)) {
                continue;
            }
            if (array_key_exists($key, $a)) {
                return true;
            }
        }
        return false;
    }
    
    public function getDefaultAlgorithm() {
        return $this->defaultAlgorithm;
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
    
    public function getWhirlpoolArray() {
        return $this->whirlpoolArray;
    }
    
    public function getAllArrays() {
        return $this->allArrays;
    }
    
    public function getHash($input, $algorithm) {
        if ($this->array_key_exists_r($algorithm, $this->allArrays)) {
            if (array_key_exists($algorithm, $this->mdArray)) {
                return $this->getMDHash($input, $algorithm);
            }
            if (array_key_exists($algorithm, $this->ripemdArray)) {
                return $this->getRIPEMDHash($input, $algorithm);
            }
            if (array_key_exists($algorithm, $this->shaArray)) {
                return $this->getSHAHash($input, $algorithm);
            }
            if (array_key_exists($algorithm, $this->tigerArray)) {
                return $this->getTigerHash($input, $algorithm);
            }
            if (array_key_exists($algorithm, $this->whirlpoolArray)) {
                return $this->getWhirlpoolHash($input, $algorithm);
            }
        } else {
            die("Invalid algorithm");
        }
    }
    
    public function getMDHash($input, $algorithm) {
        require_once('../classes/HashMD.class.php');
        $hashObj = new HashMD();
        switch ($algorithm) {
            case "md5":
                return $hashObj->getMD5Hash($input);
        }
    }

    public function getRIPEMDHash($input, $algorithm) {
        require_once('../classes/HashRIPEMD.class.php');
        $hashObj = new HashRIPEMD();
        switch ($algorithm) {
            case "ripemd128":
                return $hashObj->getRIPEMD128Hash($input);
            case "ripemd160":
                return $hashObj->getRIPEMD160Hash($input);
            case "ripemd256":
                return $hashObj->getRIPEMD256Hash($input);
            case "ripemd320":
                return $hashObj->getRIPEMD320Hash($input);
        }
    }
    
    public function getSHAHash($input, $algorithm) {
        require_once('../classes/HashSHA.class.php');
        $hashObj = new HashSHA();
        switch ($algorithm) {
            case "sha1":
                return $hashObj->getSHA1Hash($input);
            case "sha256":
                return $hashObj->getSHA256Hash($input);
            case "sha384":
                return $hashObj->getSHA384Hash($input);
            case "sha512":
                return $hashObj->getSHA512Hash($input);
        }
    }
    
    public function getTigerHash($input, $algorithm) {
        require_once('../classes/HashTiger.class.php');
        $hashObj = new HashTiger();
        switch ($algorithm) {
            case "tiger128":
                return $hashObj->getTiger128Hash($input);
            case "tiger160":
                return $hashObj->getTiger160Hash($input);
            case "tiger192":
                return $hashObj->getTiger192Hash($input);
        }
    }
    
    public function getWhirlpoolHash($input, $algorithm) {
        require_once('../classes/HashWhirlpool.class.php');
        $hashObj = new HashWhirlpool();
        switch ($algorithm) {
            case "whirlpool":
                return $hashObj->getWhirlpoolHash($input);
        }
    }
    
}
