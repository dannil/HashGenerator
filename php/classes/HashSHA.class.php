<?php

/**
 * Description of HashSHA.class.php
 *
 * @author Daniel
 * 
 * Class which handles all operations for the SHA (Secure Hash Algorithm) hashing family.
 */
class HashSHA {
    
    public function getSHA1Hash($input) {
        return hash('sha1', $input);
    }
    
    public function getSHA256Hash($input) {
        return hash('sha256', $input);
    }
    
    public function getSHA384Hash($input) {
        return hash('sha384', $input);
    }
    
    public function getSHA512HASH($input) {
        return hash('sha512', $input);
    }
    
}
