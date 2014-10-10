<?php

/**
 * Description of HashSHA
 *
 * @author Daniel
 * 
 * Class which handles all operations for the
 * Tiger hashing family
 */
class HashTiger {
    
    public function getTiger128Hash($input) {
        return hash('tiger128,3', $input);
    }
    
    public function getTiger160Hash($input) {
        return hash('tiger160,3', $input);
    }
    
    public function getTiger192Hash($input) {
        return hash('tiger192,3', $input);
    }
    
}
