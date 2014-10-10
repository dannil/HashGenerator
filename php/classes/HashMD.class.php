<?php

/**
 * Description of HashMD
 *
 * @author Daniel
 * 
 * Class which handles all operations for the MD
 * (Message-Digest) hashing family
 */
class HashMD {
    
    public function getMD5Hash($input) {
        return hash('md5', $input);
    }
    
}
