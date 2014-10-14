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
    
    public function getHAVAL128Hash($input) {
        return hash('haval128,5', $input);
    }
    
    public function getHAVAL160Hash($input) {
        return hash('haval160,5', $input);
    }
    
    public function getHAVAL192Hash($input) {
        return hash('haval192,5', $input);
    }
    
    public function getHAVAL224Hash($input) {
        return hash('haval224,5', $input);
    }
    
    public function getHAVAL256Hash($input) {
        return hash('haval256,5', $input);
    }
    
}
