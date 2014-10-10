<?php

namespace Hash;

/**
 * Description of HashRIPEMD
 *
 * @author Daniel
 * 
 * Class which handles all operations for the RIPEMD
 * (RACE Integrity Primitives Evaluation Message Digest) hashing family
 */
class HashRIPEMD {
    
    public function getRIPEMD128Hash($input) {
        return hash('ripemd128', $input);
    }
    
    public function getRIPEMD160Hash($input) {
        return hash('ripemd160', $input);
    }
    
    public function getRIPEMD256Hash($input) {
        return hash('ripemd256', $input);
    }
    
    public function getRIPEMD320Hash($input) {
        return hash('ripemd320', $input);
    }
    
}
