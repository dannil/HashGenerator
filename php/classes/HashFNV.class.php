<?php

/**
 * Description of HashFNV.class.php
 *
 * @author Daniel
 * 
 * Class which handles all operations for the FNV hashing family.
 */
class HashFNV {
    
    public function getFNV132Hash($input) {
        return hash('fnv132', $input);
    }
    
    public function getFNV1A32Hash($input) {
    	return hash('fnv1a32', $input);
    }
    
    public function getFNV164Hash($input) {
    	return hash('fnv164', $input);
    }
    
    public function getFNV1A64Hash($input) {
    	return hash('fnv1a64', $input);
    }
    
}
