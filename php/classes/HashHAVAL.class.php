<?php

/**
 * Description of HashHAVAL
 *
 * @author Daniel
 * 
 * Class which handles all operations for the HAVAL
 * hashing family
 */
class HashHAVAL {
    
    public function getHAVAL128($input) {
        return hash('haval128,5', $input);
    }
    
    public function getHAVAL160($input) {
        return hash('haval160,5', $input);
    }
    
    public function getHAVAL192($input) {
        return hash('haval192,5', $input);
    }
    
    public function getHAVAL224($input) {
        return hash('haval224,5', $input);
    }
    
    public function getHAVAL256($input) {
        return hash('haval256,5', $input);
    }
    
}
