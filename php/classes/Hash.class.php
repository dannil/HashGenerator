<?php

require_once('Functions.class.php');

/**
 * Description of Hash
 *
 * @author Daniel
 * 
 * Class which contains which specific algorithms that can be used
 */
class Hash {
    
	private $functions;
	
    private $defaultAlgorithm;
    
    private $allowedAlgorithms;
    
    private $havalArray;
    private $mdArray;
    private $ripemdArray;
    private $shaArray;
    private $snefruArray;
    private $tigerArray;
    private $whirlpoolArray;
    private $allArrays;
    
    public function __construct() {
    	$this->defaultAlgorithm = "sha256";
    	
    	$this->allowedAlgorithms = array("haval128,5" => "HAVAL128,5", "haval160,5" => "HAVAL160,5", "haval192,5" => "HAVAL192,5", "haval224,5" => "HAVAL224,5", "haval256,5" => "HAVAL256,5", 
    			                         "md2" => "MD2", "md4" => "MD4", "md5" => "MD5", 
    									 "ripemd128" => "RIPEMD128", "ripemd160" => "RIPEMD160", "ripemd256" => "RIPEMD256", "ripemd320" => "RIPEMD320",
    									 "sha1" => "SHA1", "sha256" => "SHA256", "sha384" => "SHA384", "sha512" => "SHA512",
    									 "snefru" => "Snefru",
    									 "tiger128,3" => "Tiger128", "tiger160,3" => "Tiger160", "tiger192,3" => "Tiger192",
    									 "whirlpool" => "Whirlpool");
    	
    	$this->havalArray = array();
    	$this->mdArray = array();
    	$this->ripemdArray = array();
    	$this->shaArray = array();
    	$this->snefruArray = array();
    	$this->tigerArray = array();
    	$this->whirlpoolArray = array();
    	
    	$this->functions = new Functions();
    	
    	$algorithms = hash_algos();
    	foreach ($algorithms as $algorithm) {
    		if (array_key_exists($algorithm, $this->allowedAlgorithms)) {
	    		if ($this->functions->strstartswith($algorithm, "haval")) {
	    			$array = array($algorithm => strtoupper($algorithm));
	    			$this->havalArray = array_merge($this->havalArray, $array);
	    		}
	    		if ($this->functions->strstartswith($algorithm, "md")) {
	    			$array = array($algorithm => strtoupper($algorithm));
	    			$this->mdArray = array_merge($this->mdArray, $array);
	    		}
	    		if ($this->functions->strstartswith($algorithm, "ripemd")) {
	    			$array = array($algorithm => strtoupper($algorithm));
	    			$this->ripemdArray = array_merge($this->ripemdArray, $array);
	    		}
	    		if ($this->functions->strstartswith($algorithm, "sha")) {
	    			$array = array($algorithm => strtoupper($algorithm));
	    			$this->shaArray = array_merge($this->shaArray, $array);
	    		}
	    		if ($this->functions->strstartswith($algorithm, "snefru")) {
	    			$array = array($algorithm => ucfirst($algorithm));
	    			$this->snefruArray = array_merge($this->snefruArray, $array);
	    		}
	    		if ($this->functions->strstartswith($algorithm, "tiger")) {
	    			$array = array($algorithm => ucfirst($algorithm));
	    			$this->tigerArray = array_merge($this->tigerArray, $array);
	    		}
	    		if ($this->functions->strstartswith($algorithm, "whirlpool")) {
	    			$array = array($algorithm => ucfirst($algorithm));
	    			$this->whirlpoolArray = array_merge($this->whirlpoolArray, $array);
	    		}
    		}
    	}
    	
    	$this->allArrays = array($this->havalArray, $this->mdArray, $this->ripemdArray, $this->shaArray, $this->snefruArray, $this->tigerArray, $this->whirlpoolArray);
    }
    
    public function getDefaultAlgorithm() {
        return $this->defaultAlgorithm;
    }
    
    public function getHAVALArray() {
        return $this->havalArray;
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
    
    public function getSnefruArray() {
        return $this->snefruArray;
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
        if ($this->functions->array_key_exists_r($algorithm, $this->allArrays)) {
            if (array_key_exists($algorithm, $this->havalArray)) {
                return $this->getHAVALHash($input, $algorithm);
            }
            if (array_key_exists($algorithm, $this->mdArray)) {
                return $this->getMDHash($input, $algorithm);
            }
            if (array_key_exists($algorithm, $this->ripemdArray)) {
                return $this->getRIPEMDHash($input, $algorithm);
            }
            if (array_key_exists($algorithm, $this->shaArray)) {
                return $this->getSHAHash($input, $algorithm);
            }
            if (array_key_exists($algorithm, $this->snefruArray)) {
                return $this->getSnefruHash($input, $algorithm);
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
    
    private function getHAVALHash($input, $algorithm) {
        require_once('../classes/HashHAVAL.class.php');
        $hashObj = new HashHAVAL();
        switch ($algorithm) {
            case "haval128,5":
                return $hashObj->getHAVAL128Hash($input);
            case "haval160,5":
                return $hashObj->getHAVAL160Hash($input);
            case "haval192,5":
                return $hashObj->getHAVAL192Hash($input);
            case "haval224,5":
                return $hashObj->getHAVAL224Hash($input);
            case "haval256,5":
                return $hashObj->getHAVAL256Hash($input);
        }
    }
    
    private function getMDHash($input, $algorithm) {
        require_once('../classes/HashMD.class.php');
        $hashObj = new HashMD();
        switch ($algorithm) {
            case "md2":
                return $hashObj->getMD2Hash($input);
            case "md4":
                return $hashObj->getMD4Hash($input);
            case "md5":
                return $hashObj->getMD5Hash($input);
        }
    }

    private function getRIPEMDHash($input, $algorithm) {
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
    
    private function getSHAHash($input, $algorithm) {
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
    
    private function getSnefruHash($input, $algorithm) {
        require_once('../classes/HashSnefru.class.php');
        $hashObj = new HashSnefru();
        switch ($algorithm) {
            case "snefru":
                return $hashObj->getSnefruHash($input);
            case "snefru256":
            	return $hashObj->getSnefru256Hash($input);
        }
    }
    
    private function getTigerHash($input, $algorithm) {
        require_once('../classes/HashTiger.class.php');
        $hashObj = new HashTiger();
        echo $algorithm;
        switch ($algorithm) {
            case "tiger128,3":
                return $hashObj->getTiger128Hash($input);
                die();
            case "tiger160,3":
                return $hashObj->getTiger160Hash($input);
            case "tiger192,3":
                return $hashObj->getTiger192Hash($input);
        }
    }
    
    private function getWhirlpoolHash($input, $algorithm) {
        require_once('../classes/HashWhirlpool.class.php');
        $hashObj = new HashWhirlpool();
        switch ($algorithm) {
            case "whirlpool":
                return $hashObj->getWhirlpoolHash($input);
        }
    }
    
}
